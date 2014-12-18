<?php

require_once 'generic.contacttype.def.inc.php';

class Generic_ContactType {
	
	/*
	 * returns the definitions for generic contact types
	 */
	static function required() {
		return Generic_ContactType_Def::required();
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
				CRM_Core_Error::debug_log_message('nl.pum.generic processing contact type ' . $contactType['label']);
				$apiResult = civicrm_api3('ContactType', 'getvalue', array('sequential'=>1, 'json'=>1, 'return'=>'id', 'name'=>$contactType['parent']));
				try {
					civicrm_api3('ContactType', 'Getsingle', array('title' => $contactType['name']));
				} catch (CiviCRM_API3_Exception $e) {
					$contactTypeParams = array(
						'label'         =>  $contactType['label'],
						'name'          =>  $contactType['name'],
						'parent_id'     =>  $apiResult,
						'description'	=>  $contactType['description'],
						'is_active'     =>  0,
						'is_reserved'   =>  1
					);
					try {
						civicrm_api3('ContactType', 'Create', $contactTypeParams);
						$created[] = $contactType['name'];
						try {
							$params = array('name'=> $contactType['name']);
							$bao_contactType = CRM_Contact_BAO_ContactType::add($params);
						} catch (CiviCRM_API3_Exception $e) {
							CRM_Utils_System::setUFMessage("Failed to create menu entry 'New " . $contactType['name'] . "'");
						}
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
				'q' => 'civicrm/ajax/rest',
				'sequential' => 1,
				'name' => $contactType['name'],
			);
			$result = civicrm_api('ContactType', 'getsingle', $params);
			if (in_array('is_error', $result)) {
				// contact type not found: cannot enable
			} else {
				// contact type found: proceed
				$id = $result['id'];
				$params = array(
					'version' => 3,
					'q' => 'civicrm/ajax/rest',
					'sequential' => 1,
					'id' => $id,
					'is_active' => 1,
				);
				$result = civicrm_api('ContactType', 'update', $params);
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
				'q' => 'civicrm/ajax/rest',
				'sequential' => 1,
				'name' => $contactType['name'],
			);
			$result = civicrm_api('ContactType', 'getsingle', $params);
			if (in_array('is_error', $result)) {
				// contact type not found: cannot disable
			} else {
				// contact type found: proceed
				$id = $result['id'];
				$params = array(
					'version' => 3,
					'q' => 'civicrm/ajax/rest',
					'sequential' => 1,
					'id' => $id,
					'is_active' => 0,
				);
				$result = civicrm_api('ContactType', 'update', $params);
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
	 * executive foor hook_civicrm_navigationMenu
	 *
	 * Add "New ..." menu entries under "Contacts" for each of the required contact types
	 */
	static function hook_navigationMenu(&$params) {
		/* navigation entries appear present, but not yet active
		 * this function is currently limited to 3 menu levels:
		 * Contacts
		 * 	+- New <parent type>
		 *		+- New <custom type>
		 */
		$required = self::required();
		
		foreach($params as $mainKey=>$value) {
			if ($params[$mainKey]['attributes']['name'] == 'Contacts') {
				// within the Contacts menu: find the custom contact types in the sub menu structure, via their parent types
				foreach ($required as $contactType) {
					foreach($params[$mainKey]['child'] as $childKey=>$value) {
						if ($params[$mainKey]['child'][$childKey]['attributes']['name'] == ('New ' . $contactType['parent'])) {
							foreach($params[$mainKey]['child'][$childKey]['child'] as $typeKey=>$value) {
								if($params[$mainKey]['child'][$childKey]['child'][$typeKey]['attributes']['name'] == ('New ' . $contactType['name'])) {
									$params[$mainKey]['child'][$childKey]['child'][$typeKey]['attributes']['active'] = 1;
								} else {
									// not the requested contact type in nested sub menu
								}
							}
						} else {
							// not the requested parent entry in the Contacts submenu
						}
					}
				}
			} else {
				// not the Contacts entry in main menu
			}
		}
	}
	
}