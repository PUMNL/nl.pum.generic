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
			
			CRM_Core_Error::debug_log_message('nl.pum.generic processing group ' . $group['name']);
			
			// need to do some management myself first:
			// verify if entity already exists and, if so, if it is there as a managed entity
			$sql = '
SELECT
  ifnull(mgd.name, \'-\') as nameMgd,
  grp.name as nameEntity
FROM
  civicrm_group grp
  LEFT JOIN civicrm_managed mgd ON mgd.entity_id = grp.id
WHERE
  grp.name = \'' . $group['params']['name'] . '\'
			';
			$dao = CRM_Core_DAO::executeQuery($sql);
			$allow = TRUE;
			if ($dao->N == 1) {
				$result = $dao->fetch();
				if ($dao->nameMgd == '-') {
					// entity name exists, but not as a managed entity
					$allow = FALSE;
				}
			}
			
			if ($allow) {
				$entities[] = $group;
				$created[] = $group['name'];
			}
		}
		$message = "Groups " . implode(", ", $created) . " listed as managed entity";
		CRM_Utils_System::setUFMessage($message);
	}
	
}
