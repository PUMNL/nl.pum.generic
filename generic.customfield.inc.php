<?php

require_once 'generic.customfield.def.inc.php';

/*
 * Based on source: https://civicrm.org/blogs/jamie/creating-custom-groups-and-custom-fields-programmatically-your-drupal-module
 */
class Generic_CustomField {
	
	/*
	 * returns the definitions for generic custom fieldsgroups and custom fields
	 */
	static function required() {
		return Generic_CustomField_Def::required();
	}
	
	/*
	 * handler for hook_civicrm_install
	 */
	static function install() {
		$created = array();
		$required = self::required();
		$entitiesTranslation = self::getEntityTranslations();
		
		foreach ($required as $fieldGroup) {
			$customGroupId = NULL;
			
			// verify if group exists
			$params = array(
				'version'		=> 3,
				'sequential'	=> 1,
				'name'			=> $fieldGroup['group_name'],
			);
			$result = civicrm_api('CustomGroup', 'getsingle', $params);
			if (in_array('is_error', $result)) {
				// group not found: $customGroupId remains NULL
			} else {
				// group found: use id
				$customGroupId = $result['id'];
			}
			
			// if group was not found: create it
			if (is_null($customGroupId)) {
				// create group (what does parameter 'extends_entity_column_id' do?)
				if (empty($fieldGroup['entities'])) {
					$extends_column_value = NULL;
				} else {
					$extends_column_value = array();
					foreach($fieldGroup['entities'] as $entity) {
						if (array_key_exists($entity, $entitiesTranslation)) {
							$extends_column_value[] = $entitiesTranslation[$entity];
						} else {
							$extends_column_value[] = $entity;
						}
					}
					$extends_column_value = CRM_Core_DAO::VALUE_SEPARATOR . implode(CRM_Core_DAO::VALUE_SEPARATOR, $extends_column_value) . CRM_Core_DAO::VALUE_SEPARATOR; // ==================== TRANSLATE FIRST
				}
				
				$params = array(
					'version'						=>	3,
					'extends'						=>	$fieldGroup['extends'],
					'extends_entity_column_value'	=>	$extends_column_value,
					'title'							=>	$fieldGroup['group_title'],
					'name'							=>	$fieldGroup['group_name'],
					'style'							=>	$fieldGroup['style'],
					'is_multiple'					=>	$fieldGroup['is_multiple'],
					'help_pre'						=>	$fieldGroup['help_pre'],
					'help_post'						=>	$fieldGroup['help_post'],
					'is_active'						=>	1,
				);
				$result = civicrm_api('CustomGroup', 'Create', $params);
				
				if($result['is_error'] == 1) {
					// group not created: $customGroupId remains NULL
					CRM_Utils_System::setUFMessage('Error creating Custom Group "' . $fieldGroup['group_name'] . '": ' . $result['error_message']);
				} else {
					// group created: retrieve $customGroupId
					$value = array_pop($result['values']);
					$customGroupId = $value['id'];
					$created[] = $fieldGroup['group_title'];
				}
			}
			
			// if group is present: process field definitions
			if (!is_null($customGroupId)) {
				// field group is present: process fields within group
				foreach ($fieldGroup['fieldset'] as $field) {
					// if option_group_name is provided, the field depends on an options list: retrieve its option_group_id
					if ($field['option_group_name'] != '') {
						$params = array(
							'version' => 3,
							'q' => 'civicrm/ajax/rest',
							'sequential' => 1,
							'name' => $field['option_group_name'],
						);
						$result = civicrm_api('OptionGroup', 'getsingle', $params);
						
						if (in_array('is_error', $result)) {
							// option group name provided, but none found
							$optionGroupId = -1;
						} else {
							// option group name provided and found: use id
							$optionGroupId = $result['id'];
						}
					} else {
						// no option group name provided
						$optionGroupId = NULL;
					}
					
					// proceed when option group was found, or when field does not depend on an option group
					if ($optionGroupId === -1) {
						CRM_Utils_System::setUFMessage('Error creating Custom Field "' . $field['label'] . '": could not find Option Group "' . $field['option_group_name'] . '"');
					} else {
						// generate field if it doesn't exist yet
						$params = array(
							'version' => 3,
							'sequential' => 1,
							'custom_group_id' => $customGroupId,
							'name' => $field['name'],
						);
						$result = civicrm_api('CustomField', 'getsingle', $params);
						if (in_array('is_error', $result)) {
							// custom field not found: create it
							$params = array(
								'version'				=>	3,
								'custom_group_id'		=>	$customGroupId,
								'name'					=>	$field['name'],
								'label'					=>	$field['label'],
								'data_type'				=>	$field['data_type'],
								'html_type'				=>	$field['html_type'],
								'text_length'			=>	$field['text_length'],
								'start_date_years'		=>	$field['start_date_years'],
								'end_date_years'		=>	$field['end_date_years'],
								'date_format'			=>	$field['date_format'],
								'time-format'			=>	$field['time_format'],
								'option_group_id'		=>	$optionGroupId,
								'is_active'				=>	1,
								'default_value'			=>	$field['default_value'],
								'is_required'			=>	$field['is_required'],
								'is_view'				=>	$field['is_view'],
								'is_searchable'			=>	$field['is_searchable'],
								'is_search_range'		=>	$field['is_search_range'],
								'weight'				=>	$field['weight'],
								'help_pre'				=>	$field['help_pre'],
								'help_post'				=>	$field['help_post'],
								'attributes'			=>	$field['attributes'],
								'options_per_line'		=>	$field['options_per_line'],
								'note_columns'			=>	$field['note_columns'],
								'note_rows'				=>	$field['note_rows'],
							);
							$result = civicrm_api('CustomField', 'Create', $params);
							/****************************************************************************************************
							 * Observation in CiviCRM 4.4.4:
							 * If $optionGroupId was provided, $result will now contain a DIFFERENT (new) option_group_id (BUG)
							 ****************************************************************************************************/
							if($result['is_error'] == 1) {
								drupal_set_message('Error creating Custom Field "' . $field['label'] . '" in group "' . $fieldGroup['group_name'] . '": ' . $result['error_message']);
							} else {
								// report success?
								// workaround for wrong optionGroupId
								if (is_null($optionGroupId)) {
									// no fix required
								} else {
									$newFieldDetails = array_pop($result['values']);
									$currentOptionGroupId = $newFieldDetails['option_group_id'];
									if ($currentOptionGroupId == $optionGroupId) {
										// ok - bug must have been fixed
									} else {
										// apply datafix
										// 1 - apply correct option_group_id to custom field
										$fieldId = $newFieldDetails['id'];
										$sql = "UPDATE civicrm_custom_field SET option_group_id=" . $optionGroupId . " WHERE id=" . $fieldId;
										$sqlResult = CRM_Core_DAO::executeQuery($sql);
										// 2 - remove unjust option group
										$sql = "DELETE FROM civicrm_option_group WHERE id=" . $currentOptionGroupId;
										$sqlResult = CRM_Core_DAO::executeQuery($sql);
									}
								}
							}
						} else {
							// custom field already exist
							CRM_Utils_System::setUFMessage('Error creating Custom Field "' . $field['label'] . '" in Custom Group "' . $fieldGroup['group_name'] . '": field already exists.');
						}
					
					}

				} // next custom field
			}
			
		} // next custom field group
		
		$message = "Custom field group ".implode(", ", $created)." succesfully created";
		CRM_Utils_System::setUFMessage($message);
		
	}
	
	/*
	 * handler for hook_civicrm_enable
	 */
	static function enable() {
		$required = self::required();
		// set all contact types to enabled
		foreach ($required as $fieldGroup) {
			$params = array(
				'version' => 3,
				'sequential' => 1,
				'name' => $fieldGroup['group_name'],
				);
			$result = civicrm_api('CustomGroup', 'getsingle', $params);
			if (in_array('is_error', $result)) {
				// group not found: cannot enable
			} else {
				// group found: proceed
				$qryEnable = "UPDATE civicrm_custom_group SET is_active = 1 WHERE name = '" . $fieldGroup['group_name'] . "'";
				CRM_Core_DAO::executeQuery($qryEnable);
			}
		}
	}
	
	/*
	 * handler for hook_civicrm_disable
	 */
	static function disable() {
		$required = self::required();
		// set all contact types to disabled
		foreach ($required as $fieldGroup) {
			$params = array(
				'version' => 3,
				'sequential' => 1,
				'name' => $fieldGroup['group_name'],
				);
			$result = civicrm_api('CustomGroup', 'getsingle', $params);
			if (in_array('is_error', $result)) {
				// group not found: cannot disable
			} else {
				// group found: proceed
				$qryDisable = "UPDATE civicrm_custom_group SET is_active = 0 WHERE name = '" . $fieldGroup['group_name'] . "'";
				CRM_Core_DAO::executeQuery($qryDisable);
			}
		}
	}
	
	/*
	 * handler for hook_civicrm_uninstall
	 */
	static function uninstall() {
	}
	
	/*
	 * handler for hook_civicrm_managed
	 */
	static function managed(&$entities) {
	}
	
	/*
	 * builds and returns a list of names used in field group 'used for' (column_value)
	 * and their translations to corresponding values that should be registered in the civicrm_option_group table
	 */
	static function getEntityTranslations() {
		$entitiesTranslation = array();
		self::_getContactTranslations($entitiesTranslation);
		self::_getCaseTypeTranslations($entitiesTranslation);
		self::_getActivityTypeTranslations($entitiesTranslation);
		// etc
		return $entitiesTranslation;
	}
	
	/*
	 * contact type names translate to contact type names when used for 'used for'-column names
	 */
	private static function _getContactTranslations(&$entitiesTranslation) {
		$result = CRM_Contact_BAO_ContactType::contactTypeInfo();
		foreach($result as $contactType) {
			$entitiesTranslation[$contactType['name']] = $contactType['name'];
		}
	}
	
	/*
	 * translation table from case type name to case type value
	 */
	private static function _getCaseTypeTranslations(&$entitiesTranslation) {
		self::_getOptionGroupTranslations('case_type', $entitiesTranslation);
	}
	
	/*
	 * translation table from activity type to activity type value
	 */
	private static function _getActivityTypeTranslations(&$entitiesTranslation) {
		self::_getOptionGroupTranslations('activity_type', $entitiesTranslation);
	}
	
	/*
	 * translation table from option value name to the option values value
	 */
	private static function _getOptionGroupTranslations($optionGroupName, &$entitiesTranslation) {
		/*
		 * sadly this part cannot repy on the API as the 'limit' parameter is not obeyed:
		 * result count for option values will exceed the default 25
		 *
		$params = array(
			'version' => 3,
			'sequential' => 1,
			'name' => $optionGroupName,
		);
		$result = civicrm_api('OptionGroup', 'get', $params);
		if ($result['count']==0) {
			// not found -> won't be able to translate
		} else {
			// found
			$option_group_id = $result['id'];
			// retrieve option values
			$params = array(
				'version' => 3,
				'sequential' => 1,
				'option_group_id' => $option_group_id,
			);
			$result = civicrm_api('OptionValue', 'get', $params);
			if ($result['is_error']==0) {
				// link names to values
				foreach($result['values'] as $optionValue) {
					$entitiesTranslation[$optionValue['label']] = $optionValue['value'];
				}
			} else {
				// no values -> can't add to translation
			}
		}
		 *
		 */
		$qry = 'SELECT ogv.label, ogv.value FROM `civicrm_option_value` AS `ogv`, `civicrm_option_group` as `ogp` WHERE ogv.option_group_id=ogp.id AND ogp.name=\'' . $optionGroupName . '\'';
		$dao = CRM_Core_DAO::executeQuery($qry);
		while ($dao->fetch()) {
			$entitiesTranslation[$dao->label] = $dao->value;
		}
	}
}