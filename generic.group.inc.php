<?php

class Generic_Group {
	
	/*
	 * returns the definitions for generic relationship types
	 */
	static function required() {
		return array(
			array(
			'module'    => 'nl.pum.generic',
			'name'      => 'Experts',
			'entity'    => 'Group',
			'params'    => array(
				'version'       => 3,
				'name'          => 'Experts',
				'title'         => 'Experts',
				'description'   => 'Test Group for Experts',
				'is_active'     =>  1,
				'group_type'    =>  array(2 => 1))
			)
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
		foreach ($required as $group) {
			$entities[] = $group;
			$created[] = $group['name'];
		}
		$message = "Groups " . implode(", ", $created) . " successfully created";
		CRM_Utils_System::setUFMessage($message);
	}
	
}