<?php

class Generic_RelationshipType {
	
	/*
	 * returns the definitions for generic relationship types
	 */
	static function required() {
		return array(
			array(
				'module'	=> 'nl.pum.generic',
				'name'		=> 'Accountholder',
				'entity'	=> 'RelationshipType',
				'params'	=> array(
					'version'				=> 3,
					'name_a_b'				=> 'Accountholder',
					'name_b_a'				=> 'Accountholder for',
					'label_a_b'				=> 'Accountholder',
					'label_b_a'				=> 'Accountholder for',
					'contact_type_a'		=> 'Organization',
					'contact_sub_type_a'	=> '',
					'contact_type_b'		=> 'Individual',
					'contact_sub_type_b'	=> '',
					'description'			=> 'Accountholder relationship',
					'is_active'				=>  1,
				),
			),
			array(
				'module'	=> 'nl.pum.generic',
				'name'		=> 'Anamon',
				'entity'	=> 'RelationshipType',
				'params'	=> array(
					'version'				=> 3,
					'name_a_b'				=> 'Anamon',
					'name_b_a'				=> 'Anamon',
					'label_a_b'				=> 'Anamon',
					'label_b_a'				=> 'Anamon',
					'contact_type_a'		=> 'Individual',
					'contact_sub_type_a'	=> '',
					'contact_type_b'		=> 'Individual',
					'contact_sub_type_b'	=> '',
					'description'			=> 'Anamon relationship',
					'is_active'				=>  1,
				),
			),
			array(
				'module'	=> 'nl.pum.generic',
				'name'		=> 'Aspect advisor',
				'entity'	=> 'RelationshipType',
				'params'	=> array(
					'version'				=> 3,
					'name_a_b'				=> 'Aspect advisor',
					'name_b_a'				=> 'Aspect advisor',
					'label_a_b'				=> 'Aspect advisor',
					'label_b_a'				=> 'Aspect advisor',
					'contact_type_a'		=> 'Individual',
					'contact_sub_type_a'	=> '',
					'contact_type_b'		=> 'Individual',
					'contact_sub_type_b'	=> '',
					'description'			=> 'Aspect advisor relationship',
					'is_active'				=>  1,
				),
			),
			array(
				'module'	=> 'nl.pum.generic',
				'name'		=> 'Country Coordinator',
				'entity'	=> 'RelationshipType',
				'params'	=> array(
					'version'				=> 3,
					'name_a_b'				=> 'Country Coordinator',
					'name_b_a'				=> 'Country Coordinator',
					'label_a_b'				=> 'Country Coordinator',
					'label_b_a'				=> 'Country Coordinator',
					'contact_type_a'		=> 'Individual',
					'contact_sub_type_a'	=> '',
					'contact_type_b'		=> 'Organization',
					'contact_sub_type_b'	=> '',
					'description'			=> 'Country Coordinator relationship',
					'is_active'				=>  1,
				),
			),
			array(
				'module'	=> 'nl.pum.generic',
				'name'		=> 'Customer contact',
				'entity'	=> 'RelationshipType',
				'params'	=> array(
					'version'				=> 3,
					'name_a_b'				=> 'Customer contact',
					'name_b_a'				=> 'Customer contact',
					'label_a_b'				=> 'Customer contact',
					'label_b_a'				=> 'Customer contact',
					'contact_type_a'		=> 'Individual',
					'contact_sub_type_a'	=> '',
					'contact_type_b'		=> 'Organization',
					'contact_sub_type_b'	=> '',
					'description'			=> 'Customer contact relationship',
					'is_active'				=>  1,
				),
			),
			array(
				'module'	=> 'nl.pum.generic',
				'name'		=> 'Customer',
				'entity'	=> 'RelationshipType',
				'params'	=> array(
					'version'				=> 3,
					'name_a_b'				=> 'Customer of',
					'name_b_a'				=> 'Service Provider for',
					'label_a_b'				=> 'Customer of',
					'label_b_a'				=> 'Service Provider for',
					'contact_type_a'		=> 'Organization',
					'contact_sub_type_a'	=> 'Customer',
					'contact_type_b'		=> 'Organization',
					'contact_sub_type_b'	=> '',
					'description'			=> 'Customer relationship',
					'is_active'				=>  1,
				),
			),
			array(
				'module'	=> 'nl.pum.generic',
				'name'		=> 'Employee',
				'entity'	=> 'RelationshipType',
				'params'	=> array(
					'version'				=> 3,
					'name_a_b'				=> 'Employee of',
					'name_b_a'				=> 'Employer of',
					'label_a_b'				=> 'Employee of',
					'label_b_a'				=> 'Employer of',
					'contact_type_a'		=> 'Individual',
					'contact_sub_type_a'	=> '',
					'contact_type_b'		=> 'Organization',
					'contact_sub_type_b'	=> '',
					'description'			=> 'Employee relationship',
					'is_active'				=>  1,
				),
			),
			array(
				'module'	=> 'nl.pum.generic',
				'name'		=> 'Head Office',
				'entity'	=> 'RelationshipType',
				'params'	=> array(
					'version'				=> 3,
					'name_a_b'				=> 'Head Office for',
					'name_b_a'				=> 'Sub Office of',
					'label_a_b'				=> 'Head Office for',
					'label_b_a'				=> 'Sub Office of',
					'contact_type_a'		=> 'Organization',
					'contact_sub_type_a'	=> '',
					'contact_type_b'		=> 'Organization',
					'contact_sub_type_b'	=> '',
					'description'			=> 'Head Office relationship',
					'is_active'				=>  1,
				),
			),
			array(
				'module'	=> 'nl.pum.generic',
				'name'		=> 'Project member',
				'entity'	=> 'RelationshipType',
				'params'	=> array(
					'version'				=> 3,
					'name_a_b'				=> 'Project member',
					'name_b_a'				=> 'Project member',
					'label_a_b'				=> 'Project member',
					'label_b_a'				=> 'Project member',
					'contact_type_a'		=> 'Individual',
					'contact_sub_type_a'	=> '',
					'contact_type_b'		=> 'Organization',
					'contact_sub_type_b'	=> '',
					'description'			=> 'Project member relationship',
					'is_active'				=>  1,
				),
			),
			array(
				'module'	=> 'nl.pum.generic',
				'name'		=> 'Project Officer',
				'entity'	=> 'RelationshipType',
				'params'	=> array(
					'version'				=> 3,
					'name_a_b'				=> 'Project Officer for',
					'name_b_a'				=> 'Project Officer is',
					'label_a_b'				=> 'Project Officer for',
					'label_b_a'				=> 'Project Officer is',
					'contact_type_a'		=> 'Individual',
					'contact_sub_type_a'	=> '',
					'contact_type_b'		=> 'Organization',
					'contact_sub_type_b'	=> '',
					'description'			=> 'Project Officer relationship',
					'is_active'				=>  1,
				),
			),
			array(
				'module'	=> 'nl.pum.generic',
				'name'		=> 'Prospect Expert',
				'entity'	=> 'RelationshipType',
				'params'	=> array(
					'version'				=> 3,
					'name_a_b'				=> 'Prospect Expert for',
					'name_b_a'				=> 'Prospect Expert is',
					'label_a_b'				=> 'Prospect Expert for',
					'label_b_a'				=> 'Prospect Expert is',
					'contact_type_a'		=> 'Individual',
					'contact_sub_type_a'	=> 'Expert',
					'contact_type_b'		=> 'Organization',
					'contact_sub_type_b'	=> 'Customer',
					'description'			=> 'Prospect Expert relationship',
					'is_active'				=>  1,
				),
			),
			array(
				'module'	=> 'nl.pum.generic',
				'name'		=> 'PUM representative',
				'entity'	=> 'RelationshipType',
				'params'	=> array(
					'version'				=> 3,
					'name_a_b'				=> 'PUM representative',
					'name_b_a'				=> 'PUM representative',
					'label_a_b'				=> 'PUM representative',
					'label_b_a'				=> 'PUM representative',
					'contact_type_a'		=> 'Organization',
					'contact_sub_type_a'	=> '',
					'contact_type_b'		=> 'Individual',
					'contact_sub_type_b'	=> '',
					'description'			=> 'PUM representative relationship',
					'is_active'				=>  1,
				),
			),
			array(
				'module'	=> 'nl.pum.generic',
				'name'		=> 'PUM-expert',
				'entity'	=> 'RelationshipType',
				'params'	=> array(
					'version'				=> 3,
					'name_a_b'				=> 'PUM-expert at',
					'name_b_a'				=> 'PUM-expert for',
					'label_a_b'				=> 'PUM-expert at',
					'label_b_a'				=> 'PUM-expert for',
					'contact_type_a'		=> 'Individual',
					'contact_sub_type_a'	=> '',
					'contact_type_b'		=> 'Organization',
					'contact_sub_type_b'	=> '',
					'description'			=> 'PUM-expert relationship',
					'is_active'				=>  1,
				),
			),
			array(
				'module'	=> 'nl.pum.generic',
				'name'		=> 'RCT Manager',
				'entity'	=> 'RelationshipType',
				'params'	=> array(
					'version'				=> 3,
					'name_a_b'				=> 'RCT Manager for',
					'name_b_a'				=> 'Expert of',
					'label_a_b'				=> 'RCT Manager for',
					'label_b_a'				=> 'Expert of',
					'contact_type_a'		=> 'Individual',
					'contact_sub_type_a'	=> '',
					'contact_type_b'		=> 'Individual',
					'contact_sub_type_b'	=> 'Expert',
					'description'			=> 'RCT Manager relationship',
					'is_active'				=>  1,
				),
			),
			array(
				'module'	=> 'nl.pum.generic',
				'name'		=> 'Sector Coordinator',
				'entity'	=> 'RelationshipType',
				'params'	=> array(
					'version'				=> 3,
					'name_a_b'				=> 'Sector Coordinator',
					'name_b_a'				=> 'Sector Coordinator',
					'label_a_b'				=> 'Sector Coordinator',
					'label_b_a'				=> 'Sector Coordinator',
					'contact_type_a'		=> 'Individual',
					'contact_sub_type_a'	=> '',
					'contact_type_b'		=> 'Organization',
					'contact_sub_type_b'	=> '',
					'description'			=> 'Sector Coordinator relationship',
					'is_active'				=>  1,
				),
			),
			array(
				'module'	=> 'nl.pum.generic',
				'name'		=> 'Projectmanager',
				'entity'	=> 'RelationshipType',
				'params'	=> array(
					'version'				=> 3,
					'name_a_b'				=> 'Projectmanager',
					'name_b_a'				=> 'Projectmanager',
					'label_a_b'				=> 'Projectmanager',
					'label_b_a'				=> 'Projectmanager',
					'contact_type_a'		=> 'Organization',
					'contact_sub_type_a'	=> '',
					'contact_type_b'		=> 'Individual',
					'contact_sub_type_b'	=> '',
					'description'			=> 'Projectmanager relationship',
					'is_active'				=>  1,
				),
			),
		);
	}
	
	/*
	 * handler for hook_civicrm_install
	 */
	static function install() {		
	}
	
	/*
	 * handler for hook_civicrm_enable
	 */
	static function enable() {
	}
	
	/*
	 * handler for hook_civicrm_disable
	 */
	static function disable() {
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
		$created = array();
		$required = self::required();
		foreach ($required as $relationship) {
			$entities[] = $relationship;
			$created[] = '"' . $relationship['name'] . '"';
		}
		$message = "Relationship Type " . implode(", ", $created) . " successfully created";
		CRM_Utils_System::setUFMessage($message);
	}
	
}