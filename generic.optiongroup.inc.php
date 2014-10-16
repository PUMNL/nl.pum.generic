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
						$created[] = $optionGroup['group_label'];
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
				$message = 'Option group ' . $optionGroup['group_label'] . ': value(s) ' . implode(', ', $created) . ' succesfully created';
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
	
}