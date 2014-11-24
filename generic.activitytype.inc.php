<?php

require_once 'generic.activitytype.def.inc.php';

class Generic_ActivityType {
	
	/*
	 * returns the definitions for generic activity types
	 */
	static function required() {
		return Generic_ActivityType_Def::required();
	}
	
	/*
	 * returns the definitions for standard civicrm activity types to keep
	 * ones not listed here and not listed in required() will be disabled in the install process
	 */
	static function tolerate() {
		return array(
			'Open Case',
			'Bulk Email',
			'Change Case Start Date',
			'Change Case Status',
			'Change Case Type',
			'Follow up',
			'Event Registration',
			'Meeting',
		);
	}
	
	/*
	 * handler for hook_civicrm_install
	 */
	static function install() {
		// basically action types are option values as well
		$created = array();
		$required = self::required();
		$tolerate = self::tolerate();
		$existingComponents = self::_existingComponents();
		$componentId = NULL;
				
		// retrieve activity_type group id
		$optionGroupId = self::_getActivityTypeGroupId();
		
		if (is_null($optionGroupId)) {
			// optiongroup not found: cannot proceed
			CRM_Utils_System::setUFMessage('Could not find option group "activity_type" - no activity types processed');
		} else {
			// optiongroup found: use it as option_group_id in option values
			foreach ($required as $activityType) {
				$componentId = NULL;
				$tolerate[] = $activityType['name']; // add $required elements to $tolerate to avoid disabling
				
				// translate component to id (null = 'Contacts OR Cases')
				if (array_key_exists($activityType['component'], $existingComponents)) {
					$componentId = $existingComponents[$activityType['component']];
				}
				
				// verify if optionvalue/activity type exists
				$params = array(
					'version'			=> 3,
					'sequential'		=> 1,
					'option_group_id'	=> $optionGroupId,
					'name'				=> $activityType['name'],
				);
				$result = civicrm_api('OptionValue', 'getsingle', $params);
				
				if (in_array('is_error', $result)) {
					// retrieve current maximum value -> raise 1
					$new_value = round(self::_getMaxValue($optionGroupId)) + 1;

					// create optionvalue for activity type
					$params = array(
						'version'			=> 3,
						'sequential'		=> 1,
						'option_group_id'	=> $optionGroupId,
						'component_id'		=> $componentId,
						'label'				=> $activityType['label'],
						'name'				=> $activityType['name'],
						'value'				=> $new_value,
						'description'		=> $activityType['description'],
						'is_reserved'		=> TRUE,
						'is_active'			=> FALSE,
					);
					$result = civicrm_api('OptionValue', 'create', $params);
					// result could be checked / reported here
					$created[] = $activityType['name'];
				} else {
					// optiongroup exists - no further action
				}
				
				// disable activity types not listed in either required() or tolerate()
				// fetch all activity types listed in database
				$params = array(
					'version' => 3,
					'sequential' => 1,
					'option_group_id' => 2,
					'is_active' => 1,
				);
				$result = civicrm_api('OptionValue', 'get', $params);
				// compare each activity type in database against the list of ones to keep
				foreach ($result['values'] as $activityType) {
					if (in_array($activityType['name'], $tolerate)) {
						// listed: leave 'as is'
					} else {
						// not listed: disable
//						$qryDisable = "UPDATE civicrm_option_value SET is_active=0 WHERE option_group_id=" . $optionGroupId . " AND name='" . $activityType['name'] . "'";
//						CRM_Core_DAO::executeQuery($qryDisable);
					}
				}
			}
		}
		
		$message = "Activity type ".implode(", ", $created)." succesfully created";
		CRM_Utils_System::setUFMessage($message);
		
	}
	
	/*
	 * handler for hook_civicrm_enable
	 */
	static function enable() {
		$required = self::required();
		
		// retrieve activity_type group id
		$optionGroupId = self::_getActivityTypeGroupId();
		
		if (is_null($optionGroupId)) {
			// optiongroup not found: cannot proceed
			CRM_Utils_System::setUFMessage('Could not find option group "activity_type" - no activity types processed');
		} else {
			// optiongroup found: use it as option_group_id in option values
			foreach ($required as $activityType) {
				// set all existing entries to enabled
				$params = array(
					'version' => 3,
					'sequential' => 1,
					'option_group_id' => $optionGroupId,
					'name' => $activityType['name'],
				);
				$result = civicrm_api('OptionValue', 'get', $params);
				if (array_key_exists('id', $result)) {
					$qryEnable = "UPDATE civicrm_option_value SET is_active=1 WHERE option_group_id=" . $optionGroupId . " AND id=" . $result['id'];
					CRM_Core_DAO::executeQuery($qryEnable);
				} else {
					// id not available: nothing to enable
				}
			}
		}
	}
	
	/*
	 * handler for hook_civicrm_disable
	 */
	static function disable() {
		$required = self::required();
		
		// retrieve activity_type group id
		$optionGroupId = self::_getActivityTypeGroupId();
		
		if (is_null($optionGroupId)) {
			// optiongroup not found: cannot proceed
			CRM_Utils_System::setUFMessage('Could not find option group "activity_type" - no activity types processed');
		} else {
			// optiongroup found: use it as option_group_id in option values
			foreach ($required as $activityType) {
				// set all existing entries to disabled
				$params = array(
					'version' => 3,
					'sequential' => 1,
					'option_group_id' => $optionGroupId,
					'name' => $activityType['name'],
				);
				$result = civicrm_api('OptionValue', 'get', $params);
				if (array_key_exists('id', $result)) {
					$qryDisable = "UPDATE civicrm_option_value SET is_active=0 WHERE option_group_id=" . $optionGroupId . " AND id=" . $result['id'];
					CRM_Core_DAO::executeQuery($qryDisable);
				} else {
					// id not available: nothing to enable
				}
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
		/*
		 * In Civi 4.4.4 we appear to end up with multiple versions of the same managed activity types
		 * after a 2nd and 3rd install of the extension.
		 * Conclusion: rather install, enable, disable and uninstall using API
		 */
		/*
		$created = array();
		$required = self::required();
		$existingComponents = self::_existingComponents();
		foreach ($required as $activityType) {
			if (array_key_exists($activityType['component'], $existingComponents)) {
				$entities[] = array(
					'module'	=> 'nl.pum.generic',
					'name'		=> $activityType['label'],
					'entity'	=> 'ActivityType',
					'params'	=> array(
						'version'		=> 3,
						'name'			=> $activityType['label'],
						'label'			=> $activityType['label'],
						'description'	=> $activityType['description'],
						'component_id'	=> $existingComponents[$activityType['component']],
						'is_active'		=> 1,
						'weight'		=> 0
					)
				);
				$created[] = '"' . $activityType['label'] . '"';
			}
		}
		$message = "Activity Types " . implode(", ", $created) . " successfully created";
		CRM_Utils_System::setUFMessage($message);
		*/
	}
	
	private static function _existingComponents() {
		// store existing components in an array from which component_ids can easily be retrieved (components not available through API yet)
		$components = array();
		$qryComponents = 'select id, name from civicrm_component';
		$dao = CRM_Core_DAO::executeQuery($qryComponents);
		while ($dao->fetch()) {
			$components[$dao->name] = $dao->id;
		}
		return $components;
	}
	
	private static function _getMaxValue($group_id) {
		$max = NULL;
		try {
			$sql= "SELECT MAX(value * 1) as max FROM civicrm_option_value WHERE option_group_id=" . $group_id;
			$daoResult = CRM_Core_DAO::executeQuery($sql);
			$qryResult = $daoResult -> fetch();
			$max = $daoResult->max;
			return round($max);
		} catch (CiviCRM_API3_Exception $e) {
			return NULL;
		}
	}
	
	private static function _getActivityTypeGroupId() {
		// retrieve activity_type group id
		$params = array(
			'version'		=> 3,
			'sequential'	=> 1,
			'name'			=> 'activity_type',
		);
		$result = civicrm_api('OptionGroup', 'getsingle', $params);
		if (in_array('is_error', $result)) {
			// optiongroup not found: cannot proceed
			CRM_Utils_System::setUFMessage('Could not find option group "activity_type" - no activity types processed');
			return NULL;
		} else {
			// optiongroup found: use id (as option_group_id in option values)
			return $result['id'];
		}
	}
}