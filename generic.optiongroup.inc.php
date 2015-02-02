<?php

require_once 'generic.optiongroup.def.inc.php';

class Generic_OptionGroup {
	
	/*
	 * returns the definitions for generic option groups
	 */
	static function required() {
		return Generic_OptionGroup_Def::required();
	}
	
	/*
	 * handler for hook_civicrm_install
	 */
	static function install() {
		$created = array();
		$message = '';
		$required = self::required();
		
		// cycle 1:  create option groups
		foreach ($required as $optionGroup) {
			$optionGroupId = NULL;
			
			CRM_Core_Error::debug_log_message('nl.pum.generic option group ' . $optionGroup['group_name']);
			
			// verify if group exists
			$params = array(
				'sequential'	=> 1,
				'name'			=> $optionGroup['group_name'],
			);
			try {
				$result = civicrm_api3('OptionGroup', 'getsingle', $params);
				$optionGroupId = $result['id'];
			} catch (Exception $e) {
				// optiongroup not found: $optionGroupId remains NULL
			}
			
			// if group was not found: create it
			if (is_null($optionGroupId)) {
				$params = array(
					'sequential'	=> 1,
					'name'			=> $optionGroup['group_name'],
					'title'			=> $optionGroup['group_title'],
					'is_active'		=> 1,
					'description'	=> 'nl.pum.generic',
				);
				try {
					$result = civicrm_api3('OptionGroup', 'create', $params);
					// group created: retrieve $customGroupId (perform an intentional new db request)
					$params = array(
						'sequential'	=> 1,
						'name'			=> $optionGroup['group_name'],
					);
					try {
						$result = civicrm_api3('OptionGroup', 'getsingle', $params);
						$optionGroupId = $result['id'];
						$created[] = $optionGroup['group_title'];
					} catch (Exception $e) {
						// optiongroup not found: $optionGroupId remains NULL
					}
				} catch (Exception $e) {
					// group not created: $optionGroupId remains NULL
				}
			}
		} // next $optionGroup

		if (count($created) > 0) {
			$message = "Option group ".implode(", ", $created)." succesfully created";
			CRM_Utils_System::setUFMessage($message);
		}
		
		usleep(1000);
				
		// cycle 2:  create option values
		foreach ($required as $optionGroup) {
			$created = array();
			$optionGroupId = NULL;
			
			CRM_Core_Error::debug_log_message('nl.pum.generic processing option group ' . $optionGroup['group_name'] . ' (continued)');
			
			// verify if group exists
			$params = array(
				'sequential'	=> 1,
				'name'			=> $optionGroup['group_name'],
			);
			try {
				$result = civicrm_api3('OptionGroup', 'getsingle', $params);
				$optionGroupId = $result['id'];
			} catch (Exception $e) {
				// optiongroup not found: $optionGroupId remains NULL
			}
			
			// create optionvalues (if option group exists)
			if (!is_null($optionGroupId)) {
				foreach ($optionGroup['values'] as $optionValue) {
				
					CRM_Core_Error::debug_log_message('nl.pum.generic option value ' . $optionValue['name']);
				
					// verify if option value exists
					$params = array(
						'sequential'		=> 1,
						'option_group_id'	=> $optionGroupId,
						'name'				=> $optionValue['name'],
					);
					try {
						$result = civicrm_api3('OptionValue', 'getsingle', $params);
						// option value found
					} catch (Exception $e) {
						// option value NOT found
						$params = array(
							'sequential'		=> 1,
							'option_group_id'	=> $optionGroupId,
							'label'				=> $optionValue['label'],
							'name'				=> $optionValue['name'],
							'value'				=> $optionValue['value'],
							'weight'			=> $optionValue['weight'],
							'description'		=> $optionValue['description'],
							'is_reserved'		=> TRUE,
							'is_active'			=> TRUE,
						);
						try {
							$result_val = civicrm_api3('OptionValue', 'create', $params);
							$created[] = $optionValue['label'];
						} catch (Exception $e) {
						}
					}
					
					//CRM_Utils_System::setUFMessage($optionValue['name']);
				} // next option value
			}
			
			if (count($created) > 0) {
				$message = 'Option group ' . $optionGroup['group_title'] . ': value(s) ' . implode(', ', $created) . ' succesfully created';
				CRM_Utils_System::setUFMessage($message);
			}
			
		} // next $optionGroup
		
	}
	
	/*
	 * handler for hook_civicrm_enable
	 */
	static function enable() {
		$required = self::required();
		// set all contact types to enabled
		foreach ($required as $optionGroup) {
			$params = array(
				'version' => 3,
				'sequential' => 1,
				'title' => $optionGroup['group_name'],
				);
			$result = civicrm_api('OptionGroup', 'getsingle', $params);
			if (in_array('is_error', $result)) {
				// optiongroup not found: cannot enable
			} else {
				// optiongroup found: proceed
				$qryEnable = "UPDATE civicrm_option_group SET is_active = 1 WHERE name = '" . $optionGroup['group_name'] . "'";
				CRM_Core_DAO::executeQuery($qryEnable);
			}
		}
	}
	
	/*
	 * handler for hook_civicrm_disable
	 */
	static function disable() {
		$required = self::required();
		// set all contact types to enabled
		foreach ($required as $optionGroup) {
			$params = array(
				'version' => 3,
				'sequential' => 1,
				'title' => $optionGroup['group_name'],
				);
			$result = civicrm_api('OptionGroup', 'getsingle', $params);
			if (in_array('is_error', $result)) {
				// optiongroup not found: cannot disable
			} else {
				// optiongroup found: proceed
				$qryDisable = "UPDATE civicrm_option_group SET is_active = 0 WHERE name = '" . $optionGroup['group_name'] . "'";
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
	
	static function remove_optionvalue($option_group_name, $option_value_name) {
		$return = FALSE;
		try {
			// obtain group id
			$params = array(
				'version' => 3,
				'q' => 'civicrm/ajax/rest',
				'sequential' => 1,
				'name' => $option_group_name,
			);
			$result = civicrm_api('OptionGroup', 'get', $params);
			if ($result['count']==0) {
				// option group not found -> option value must be gone too -> act as if successful
				$return = TRUE;
			} else {
				$group_id = $result['values'][0]['id'];
				// obtain value id
				$params = array(
					'version' => 3,
					'q' => 'civicrm/ajax/rest',
					'sequential' => 1,
					'option_group_id' => $group_id,
					'name' => $option_value_name,
				);
				$result = civicrm_api('OptionValue', 'get', $params);
				if ($result['count']==0) {
					// option value not found -> is already gone -> act as if successful
					$return = TRUE;
				} else {
					$value_id = $result['values'][0]['id'];
					// delete option value by id
					$params = array(
						'version' => 3,
						'q' => 'civicrm/ajax/rest',
						'sequential' => 1,
						'id' => $value_id,
					);
					$result = civicrm_api('OptionValue', 'delete', $params);
					if (!array_key_exists('count', $result)) {
						// fail (already gone? should have failed earlier)
						$result = FALSE;
					} elseif ($result['count']==1) {
						// success
						$result = TRUE;
					} else {
						// fail (already gone? should have failed earlier)
						$result = FALSE;
					}
				}
			}
		} catch (Exception $e) {
			$result = FALSE;
		}
		return($return);
	}
	
}