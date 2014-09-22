<?php

require_once 'generic.group.def.inc.php';

class Generic_Group {
	
	/*
	 * returns the definitions for generic relationship types
	 */
	static function required() {
		return Generic_Group_Def::required();
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
