<?php

class Generic_Tag {
	
	/*
	 * returns the definitions for generic tags
	 */
	static function required() {
		return array(
			array(
				'name'			=> 'Current customer',
				'description'	=> 'Current customer',
				'parent_tag'	=> 'Customer',
				'used_for'		=> array('Contacts'),
			),
			array(
				'name'			=> 'Former Customer',
				'description'	=> 'Done projects with PUM in the past',
				'parent_tag'	=> 'Customer',
				'used_for'		=> array('Contacts'),
			),
			array(
				'name'			=> 'Prospect Customer',
				'description'	=> 'Customer who has applied for a project',
				'parent_tag'	=> 'Customer',
				'used_for'		=> array('Contacts'),
			),
			array(
				'name'			=> 'Rejected Customer',
				'description'	=> 'Customer who has applied for a project but has been turned down',
				'parent_tag'	=> 'Customer',
				'used_for'		=> array('Contacts'),
			),
			array(
				'name'			=> 'Suspect Customer',
				'description'	=> 'Customer interested in PUM or vice versa',
				'parent_tag'	=> 'Customer',
				'used_for'		=> array('Contacts'),
			),
			array(
				'name'			=> 'Candidate Expert',
				'description'	=> 'Person who has applied to PUM',
				'parent_tag'	=> 'Expert',
				'used_for'		=> array('Contacts'),
			),
			array(
				'name'			=> 'Former Expert',
				'description'	=> 'Expert who used to work for PUM',
				'parent_tag'	=> 'Expert',
				'used_for'		=> array('Contacts'),
			),
			array(
				'name'			=> 'Current Partner',
				'description'	=> 'Current Partner',
				'parent_tag'	=> 'Partner',
				'used_for'		=> array('Contacts'),
			),
			array(
				'name'			=> 'Former Partner',
				'description'	=> 'Former Partner of PUM',
				'parent_tag'	=> 'Partner',
				'used_for'		=> array('Contacts'),
			),
			array(
				'name'			=> 'Hot Prospect Partner',
				'description'	=> 'Hot prospect partner',
				'parent_tag'	=> 'Partner',
				'used_for'		=> array('Contacts'),
			),
			array(
				'name'			=> 'Lost Contact Partner',
				'description'	=> 'Lost Contact Partner',
				'parent_tag'	=> 'Partner',
				'used_for'		=> array('Contacts'),
			),
			array(
				'name'			=> 'Prospect Partner',
				'description'	=> 'Partner very interested in PUM or vice versa',
				'parent_tag'	=> 'Partner',
				'used_for'		=> array('Contacts'),
			),
			array(
				'name'			=> 'Suspect Partner',
				'description'	=> 'Partner interested in PUM or vice versa',
				'parent_tag'	=> 'Partner',
				'used_for'		=> array('Contacts'),
			),
			array(
				'name'			=> 'Customer',
				'description'	=> 'Customer of PUM',
				'parent_tag'	=> NULL,
				'used_for'		=> array('Contacts'),
			),
			array(
				'name'			=> 'Partner',
				'description'	=> 'Partner',
				'parent_tag'	=> NULL,
				'used_for'		=> array('Contacts'),
			),
			array(
				'name'			=> 'Expert',
				'description'	=> 'Expert',
				'parent_tag'	=> NULL,
				'used_for'		=> array('Contacts'),
			),
		);
	}
	
	/*
	 * handler for hook_civicrm_install
	 */
	static function install() {
		$created = array();
		$required = self::required();
		
		foreach ($required as $tag) {
			
			// verify if tag exists
			$params = array(
				'version' => 3,
				'sequential' => 1,
				'name' => $tag['name'],
			);
			$result = civicrm_api('Tag', 'getsingle', $params);
			if (in_array('is_error', $result)) {
				// tag not found: create tag
				// lookup parent_tag if not null
				if (is_null($tag['used_for'])) {
					$parentId = NULL;
				} else {
					$params = array(
						'version' => 3,
						'sequential' => 1,
						'name' => $tag['used_for'],
					);
					$result = civicrm_api('Tag', 'getsingle', $params);
					if (in_array('is_error', $result)) {
						$parentId = -1;
					} else {
						$parentId = $result['id'];
					}
					
					// actual tag creation
					if ($parentId != -1) {
						// allow tag creation
						$params = array(
							'version'		=> 3,
							'sequential'	=> 1,
							'parent_id'		=> $parentId,
							'name'			=> $tag['name'],
							'description'	=> $tag['description'],
							'used_for'		=> $tag['used_for'],
						);
						$result = civicrm_api('Tag', 'create', $params);
						
						if ($result['is_error'] == 1) {
							// tag not created
							CRM_Utils_System::setUFMessage('Error creating Tag "' . $tag['name'] . '": ' . $result['error_message']);
						} else {
							// tag created
							$created[] = $tag['name'];
						}
					}
				}
			} else {
				// tag already exists: no action
			}
		}
		
		$message = "Tag ".implode(", ", $created)." succesfully created";
		CRM_Utils_System::setUFMessage($message);
	}
	
	/*
	 * handler for hook_civicrm_enable
	 */
	static function enable() {
		$required = self::required();
		// set all contact types to enabled
		foreach ($required as $tag) {
			$params = array(
				'version' => 3,
				'sequential' => 1,
				'name' => $tag['name'],
				);
			$result = civicrm_api('Tag', 'getsingle', $params);
			if (in_array('is_error', $result)) {
				// tag not found: cannot enable
			} else {
				// tag found: proceed
				$qryEnable = "UPDATE civicrm_tag SET is_selectable = 1 WHERE name = '" . $tag['name'] . "'";
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
		foreach ($required as $tag) {
			$params = array(
				'version' => 3,
				'sequential' => 1,
				'name' => $tag['name'],
				);
			$result = civicrm_api('Tag', 'getsingle', $params);
			if (in_array('is_error', $result)) {
				// tag not found: cannot disable
			} else {
				// tag found: proceed
				$qryDisable = "UPDATE civicrm_tag SET is_selectable = 0 WHERE name = '" . $tag['name'] . "'";
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