<?php

require_once 'generic.relationshiptype.def.inc.php';

class Generic_RelationshipType {
	
	/*
	 * returns the definitions for generic relationship types
	 */
	static function required() {
		return Generic_RelationshipType_Def::required();
	}
	
	/*
	 * returns the definitions for standard civicrm relationship types to keep
	 * ones not listed here (by name_b_a) and not listed in required() will be disabled in the install process
	 */
	static function tolerate() {
		return array(
			'Employer of',
		);
	}
	
	/*
	 * handler for hook_civicrm_install
	 */
	static function install() {
		$required = self::required();
		$tolerate = self::tolerate();
		
		foreach ($required as $relationship) {
			$params = $relationship['params'];
			$tolerate[] = $params['name_b_a'];
		}
		
		// disable relationship types not listed in either required() or tolerate()
		// fetch all relationship types listed in database
		$params = array(
			'version' => 3,
			'sequential' => 1,
			'is_active' => 1,
		);
		$result = civicrm_api('RelationshipType', 'get', $params);
		
		// compare each relationship type in database against the list of ones to keep
		foreach ($result['values'] as $relationshipType) {
			if (in_array($relationshipType['name_b_a'], $tolerate)) {
				// listed: leave 'as is'
			} else {
				// not listed: disable
//				$qryDisable = "UPDATE civicrm_relationship_type SET is_active=0 WHERE name_b_a='" . $relationshipType['name_b_a'] . "'";
//				CRM_Core_DAO::executeQuery($qryDisable);
			}
		}
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
		$needCacheFlush = FALSE;
		foreach ($required as $relationship) {
			
			CRM_Core_Error::debug_log_message('nl.pum.generic processing relationship type ' . $relationship['params']['name_a_b']);
			
			// need to do some management myself first:
			
			// #1: verify if entity already exists and, if so, if it is there as a managed entity
			$sql = '
SELECT
  ifnull(mgd.name, \'-\') as nameMgd,
  rel.name_a_b as nameEntity
FROM
  civicrm_relationship_type rel
  LEFT JOIN civicrm_managed mgd ON mgd.entity_id = rel.id
WHERE
  rel.name_a_b = \'' . $relationship['params']['name_a_b'] . '\'
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
				// #2: cannot create contact_type_a as "All contacts"; only update
				// Error observed in CiviCRM 4.4.5
				if ($relationship['params']['contact_type_a']=='') {
					// if contact_type_a=='' (for 'All contacts') and the entity does not yet exist, an error will occur and the module will report itself installed
					// workaround: first make contact_type_a 'Individual', then update to '' using e.g. .../CiviCRM/clearcache
					$params = array(
						'version' => 3,
						'sequential' => 1,
						'name_a_b' => $relationship['params']['name_a_b'],
					);
					$result = civicrm_api('RelationshipType', 'get', $params);
					if ($result['count']==0) {
						$relationship['params']['contact_type_a'] = 'Individual';
						$needCacheFlush = TRUE;
					}
				}
				
				// #3: cannot create contact_type_b as "All contacts"; only update
				// Error observed in CiviCRM 4.4.5
				if ($relationship['params']['contact_type_b']=='') {
					// if contact_type_b=='' (for 'All contacts') and the entity does not yet exist, an error will occur and the module will report itself installed
					// workaround: first make contact_type_b 'Individual', then update to '' using e.g. .../CiviCRM/clearcache
					$params = array(
						'version' => 3,
						'sequential' => 1,
						'name_a_b' => $relationship['params']['name_a_b'],
					);
					$result = civicrm_api('RelationshipType', 'get', $params);
					if ($result['count']==0) {
						$relationship['params']['contact_type_b'] = 'Individual';
						$needCacheFlush = TRUE;
					}
				}
				
				// List as managed entity
				$entities[] = $relationship;
				$created[] = '"' . $relationship['name'] . '"';
			} // $allow
		}
		$message = "Relationship Type " . implode(", ", $created) . " listed as managed entity";
		CRM_Utils_System::setUFMessage($message);
		
		if ($needCacheFlush) {
			$session = CRM_Core_Session::singleton();
			$session::setStatus('One ore more relationships have not yet been set to ALL CONTACTS. Please run <base url>/civicrm/clearcache now to solve this!', '*** IMPORTANT ***', 'info', array('expires'=>0));
		}
	}
	
}
