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
		$required = self::required();
		
		foreach ($required as $optionGroup) {
			$optionGroupId = NULL;
			
			// verify if group exists
			$params = array(
				'version'		=> 3,
				'sequential'	=> 1,
				'name'			=> $optionGroup['group_name'],
			);
			$result = civicrm_api('OptionGroup', 'getsingle', $params);

			if (isset($result['id'])) {
				// optiongroup found: use id
				$optionGroupId = $result['id'];
			} else {
				// optiongroup not found: $optionGroupId remains NULL
			}
		
			// if group was not found: create it
			if (is_null($optionGroupId)) {
				$params = array(
					'version'		=> 3,
					'sequential'	=> 1,
					'name'			=> $optionGroup['group_name'],
					'title'			=> $optionGroup['group_title'],
					'is_active'		=> 1,
					'description'	=> 'nl.pum.generic',
				);
				$result = civicrm_api('OptionGroup', 'create', $params);
				
				if($result['is_error'] == 1) {
					// group not created: $optionGroupId remains NULL
					CRM_Utils_System::setUFMessage('Error creating Option Group "' . $optionGroup['group_name'] . '": ' . $result['error_message']);
				} else {
					// group created: retrieve $customGroupId
					$value = array_pop($result['values']);
					$optionGroupId = $value['id'];
					$created[] = $optionGroup['group_name'];
				}
			}
			
			// create optionvalues (if option group exists)
			if (is_null($optionGroupId)) {
				// message was raised earlier, when group was not created - no further action here
			} else {
				foreach ($optionGroup['values'] as $optionValue) {
					// verify if optionvalue exists
					$params = array(
						'version'			=> 3,
						'sequential'		=> 1,
						'option_group_id'	=> $optionGroupId,
						'name'				=> $optionValue['name'],
					);
					$result = civicrm_api('OptionValue', 'getsingle', $params);
					
					if (in_array('is_error', $result)) {
						// create optionvalue
						$params = array(
							'version'			=> 3,
							'sequential'		=> 1,
							'option_group_id'	=> $optionGroupId,
							'name'				=> $optionValue['name'],
							'label'				=> $optionValue['label'],
							'value'				=> $optionValue['value'],
							'description'		=> $optionValue['description'],
							'is_reserved'		=> TRUE,
							'is_active'			=> TRUE,
						);
						$result = civicrm_api('OptionValue', 'create', $params);
						// result could be checked / reported here
					} else {
						// optiongroup exists - no further action
					}
				}
			}
			
		} // next $optionGroup
		
		$message = "Option group ".implode(", ", $created)." succesfully created";
		CRM_Utils_System::setUFMessage($message);
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