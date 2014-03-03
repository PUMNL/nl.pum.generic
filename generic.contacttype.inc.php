<?php

class Generic_ContactType {
	
	/*
	 * returns the definitions for generic contact types
	 */
	static function required() {
		return array(
			array(
				'name'			=> 'Expert',
				'parent'		=> 'Individual',
				'description'	=> 'PUM Expert'
			),
			array(
				'name'			=> 'Customer',
				'parent'		=> 'Organization',
				'description'	=> 'PUM Customer'
			),
			array(
				'name'			=> 'Partner',
				'parent'		=> 'Organization',
				'description'	=> 'Partner Organisation'
			),
			array(
				'name'			=> 'Donor',
				'parent'		=> 'Organization',
				'description'	=> 'Donor Organisation'
			)
		);
	}
	
	/*
	 * handler for hook_civicrm_install
	 */
	static function install() {
		$created = array();
		$required = self::required();
		foreach ($required as $contactType) {
			// only if Contact Type does not exist yet
			// and only if parent is available
			try {
				$apiResult = civicrm_api3('ContactType', 'getvalue', array('sequential'=>1, 'json'=>1, 'return'=>'id', 'name'=>$contactType['parent']));
				try {
					civicrm_api3('ContactType', 'Getsingle', array('title' => $contactType['name']));
				} catch (CiviCRM_API3_Exception $e) {
					$contactTypeParams = array(
						'label'         =>  $contactType['name'],
						'name'          =>  $contactType['name'],
						'parent_id'     =>  $apiResult,
						'description'	=>  $contactType['description'],
						'is_active'     =>  0,
						'is_reserved'   =>  1
					);
					try {
						civicrm_api3('ContactType', 'Create', $contactTypeParams);
						$created[] = $contactType['name'];
					} catch (CiviCRM_API3_Exception $e) {
						CRM_Utils_System::setUFMessage("Could not create contact subtype {$contactType['name']}");
					}    
				}
			} catch (CiviCRM_API3_Exception $e) {
				CRM_Utils_System::setUFMessage("Could not create contact subtype {$contactType['name']}: no parent");
			}
		}
		$message = "Contact Subtypes ".implode(", ", $created)." succesfully created";
		CRM_Utils_System::setUFMessage($message);
	}
	
	/*
	 * handler for hook_civicrm_enable
	 */
	static function enable() {
		$required = self::required();
		// set all contact types to enabled
		foreach ($required as $contactType) {
			$params = array(
				'version' => 3,
				'sequential' => 1,
				'name' => $contactType['name'],
				);
			$result = civicrm_api('ContactType', 'getsingle', $params);
			if (in_array('is_error', $result)) {
				// contact type not found: cannot enable
			} else {
				// contact type found: proceed
				$qryEnable = "UPDATE civicrm_contact_type SET is_active = 1 WHERE name = '" . $contactType['name'] . "'";
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
		foreach ($required as $contactType) {
			$params = array(
				'version' => 3,
				'sequential' => 1,
				'name' => $contactType['name'],
				);
			$result = civicrm_api('ContactType', 'getsingle', $params);
			if (in_array('is_error', $result)) {
				// contact type not found: cannot disable
			} else {
				// contact type found: proceed
				$qryDisable = "UPDATE civicrm_contact_type SET is_active = 0 WHERE name = '" . $contactType['name'] . "'";
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