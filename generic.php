<?php

require_once 'generic.civix.php';

require_once 'generic.contacttype.inc.php';
require_once 'generic.activitytype.inc.php';
require_once 'generic.group.inc.php';
require_once 'generic.relationshiptype.inc.php';
require_once 'generic.optiongroup.inc.php';
require_once 'generic.tag.inc.php';
require_once 'generic.customfield.inc.php';

require_once 'CRM/Generic/Misc.php';

/**
 * Implementation of hook_civicrm_config
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_config
 */
function generic_civicrm_config(&$config) {
  _generic_civix_civicrm_config($config);
}

/**
 * Implementation of hook_civicrm_xmlMenu
 *
 * @param $files array(string)
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_xmlMenu
 */
function generic_civicrm_xmlMenu(&$files) {
  _generic_civix_civicrm_xmlMenu($files);
}

/**
 * Implementation of hook_civicrm_install
 *
 * @author Erik Hommel (erik.hommel@civicoop.org - http://www.civicoop.org)
 * @date 2 Dec 2013
 *
 * Enable all non-managed entities required for PUM
 */
function generic_civicrm_install() {
/*	Generic_ContactType::install();
	Generic_Group::install();
	Generic_RelationshipType::install();
	Generic_OptionGroup::install();
	Generic_CustomField::install();
	Generic_Tag::install();
	Generic_ActivityType::install();*/
	return _generic_civix_civicrm_install();
}

/**
 * Implementation of hook_civicrm_uninstall
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_uninstall
 */
function generic_civicrm_uninstall() {
/*	// reversed order
	Generic_ActivityType::uninstall();
	Generic_Tag::uninstall();
	Generic_CustomField::uninstall();
	Generic_OptionGroup::uninstall();
	Generic_RelationshipType::uninstall();
	Generic_Group::uninstall();
	Generic_ContactType::uninstall();*/
	return _generic_civix_civicrm_uninstall();
}

/**
 * Implementation of hook_civicrm_enable
 *
 * @author Erik Hommel (erik.hommel@civicoop.org, http://www.civicoop.org)
 * @date 2 Dec 2013
 *
 * Enable all non-managed entities controlled by this module
 */
function generic_civicrm_enable() {
/*	Generic_ContactType::enable();
	Generic_Group::enable();
	Generic_RelationshipType::enable();
	Generic_OptionGroup::enable();
	Generic_CustomField::enable();
	Generic_Tag::enable();
	Generic_ActivityType::enable();*/
	return _generic_civix_civicrm_enable();
}

/**
 * Implementation of hook_civicrm_disable
 *
 * @author Erik Hommel (erik.hommel@civicoop.org, http://www.civicoop.org)
 * @date 2 Dec 2013
 *
 * Disable all non-managed entities controlled by this module
 */
function generic_civicrm_disable() {
/*	// reversed order
	Generic_ActivityType::disable();
	Generic_Tag::disable();
	Generic_CustomField::disable();
	Generic_OptionGroup::disable();
	Generic_RelationshipType::disable();
	Generic_Group::disable();
	Generic_ContactType::disable();*/
	return _generic_civix_civicrm_disable();
}

/**
 * Implementation of hook_civicrm_upgrade
 *
 * @param $op string, the type of operation being performed; 'check' or 'enqueue'
 * @param $queue CRM_Queue_Queue, (for 'enqueue') the modifiable list of pending up upgrade tasks
 *
 * @return mixed  based on op. for 'check', returns array(boolean) (TRUE if upgrades are pending)
 *                for 'enqueue', returns void
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_upgrade
 */
function generic_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _generic_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implementation of hook_civicrm_managed
 *
 * @author Erik Hommel (erik.hommel@civicoop.org - http://www.civicoop.org)
 * @date 24 Nov 2013
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 */
function generic_civicrm_managed(&$entities) {
	Generic_ContactType::managed($entities);
	Generic_Group::managed($entities);
	Generic_RelationshipType::managed($entities);
	Generic_OptionGroup::managed($entities);
	Generic_CustomField::managed($entities);
	Generic_Tag::managed($entities);
	Generic_ActivityType::managed($entities);
	return _generic_civix_civicrm_managed($entities);
}

/**
 * Implementation of hook_civicrm_caseTypes
 *
 * Generate a list of case-types
 *
 * Note: This hook only runs in CiviCRM 4.4+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function generic_civicrm_caseTypes(&$caseTypes) {
  _generic_civix_civicrm_caseTypes($caseTypes);
}

/**
 * Implementation of hook_civicrm_alterSettingsFolders
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_alterSettingsFolders
 */
function generic_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _generic_civix_civicrm_alterSettingsFolders($metaDataFolders);
}

/**
 * Implementation of hook_civicrm_postProcess
 *
 * Stores added fields in civicrm_case_pum
 */
function generic_civicrm_postProcess( $formName, &$form ) {
//dpm($form, 'Generic - postProcess form data ' . $formName);
	switch($formName) {
		case 'CRM_Case_Form_Case':
			// looking for case_id = 11:
			//$form->_submitValues['contact_select_id'][1] = 229
			//$form->_submitValues['contact'][1] = Belgium

			//$form->_submitValues['case_type_id'] = 2
			//$form->_contactID = 210 (Afghanistan)
			if ($form->_action != CRM_Core_Action::DELETE) {
				$sql = '
	SELECT
		cas.id AS case_id,
		ovl1.label AS case_label,
		ovl1.name AS case_name,
		cod.value AS type_code,
		con.contact_sub_type,
		con.display_name,
		ifnull(cy1.iso_code, cy2.iso_code) AS country,
		pum.id AS pum_id,
		pum.entity_id,
		pum.case_sequence,
		pum.case_type,
		pum.case_country
	FROM
		civicrm_case cas
		LEFT JOIN civicrm_case_pum pum ON pum.entity_id = cas.id,
		civicrm_case_contact ccn,
		civicrm_option_group ogp1,
		civicrm_option_value ovl1
		LEFT JOIN (SELECT ovl2.*
								 FROM civicrm_option_group ogp2,
											civicrm_option_value ovl2
								WHERE ogp2.name = \'case_type_code\' AND
											ovl2.option_group_id = ogp2.id) cod
			ON cod.label = ovl1.label,
		civicrm_contact con
		LEFT JOIN civicrm_country cy1 ON cy1.name = con.display_name
		LEFT JOIN civicrm_address adr
			ON adr.contact_id = con.id AND
				 adr.is_primary = 1
		LEFT JOIN civicrm_country cy2 ON adr.country_id = cy2.id
	WHERE
		cas.case_type_id = \'' . $form->_submitValues['case_type_id'] . '\' AND
		ccn.case_id = cas.id AND
		ccn.contact_id = ' . $form->_currentlyViewedContactId . ' AND
		ogp1.name = \'case_type\' AND
		ovl1.option_group_id = ogp1.id AND
		cas.case_type_id = ovl1.value AND
		con.id = ccn.contact_id
	ORDER BY
		cas.id DESC
	LIMIT 1
				';

				$dao_find = CRM_Core_DAO::executeQuery($sql);
				while ($dao_find->fetch()) {
					if (empty($dao_find->type_code)) {
						// no case_type_code -> do not set main activity number
					} elseif (($dao_find->case_name == 'TravelCase') && (CRM_Generic_Misc::generic_verify_extension('nl.pum.travelcase'))) {
						// nl.pum.travel extension controls main activity number on cases of type TravelCase
					} else {
						CRM_Generic_Upgrader::_setMainActivityNumber($dao_find);
					}
				}
			}
			break;

		case 'CRM_Contact_Form_Contact':
			$type = $form->_contactType;
			$id = $form->_contactId;
			if ($type == 'Individual') {
				$params = array(
					'version' => 3,
					'q' => 'civicrm/ajax/rest',
					'sequential' => 1,
					'id' => $id,
				);
				$result = civicrm_api('Shortname', 'set', $params);
			}
			break;

		default:
//			print_r($formName);
//			exit();
	}

}


/*
 * helper function to supply table- column names for custom fields
 */
function generic_getCustomTableInfo($customGroupName) {
	// default return value
	$customTable = array(
		'group_id' => NULL,
		'group_name' => NULL,
		'group_table' => NULL,
		'columns' => array(),
		'sql_columns' => '',
	);

	// retrieve table name for custom group
	$sql = 'SELECT id, name, table_name FROM civicrm_custom_group WHERE name = \'' . $customGroupName . '\'';
	$dao = CRM_Core_DAO::executeQuery($sql);
	if (!$dao->N == 1) {
		// leave empty
	} else {
		$dao->fetch();
		$customTable['group_id'] = $dao->id;
		$customTable['group_name'] = $dao->name;
		$customTable['group_table'] = $dao->table_name;
		// retrieve fieldnames for custom fields
		$sql = "SELECT name, label, column_name FROM civicrm_custom_field WHERE custom_group_id = " . $customTable['group_id'];
		$dao = CRM_Core_DAO::executeQuery($sql);
		if ($dao->N >= 1) {
			$sql_cols = array();
			while ($dao->fetch()) {
				$customTable['columns'][$dao->name] = array(
					'name' => $dao->name,
					'label' => $dao->label,
					'column_name' => $dao->column_name,
				);
				$sql_cols[] = $customTable['group_table'] . '.' . $dao->column_name . ' AS \'' . $dao->name . '\'';
			}
		} else {
			// leave columns empty
		}
		if (!empty($sql_cols)) {
			$customTable['sql_columns'] = implode(',' . PHP_EOL, $sql_cols);
		}
	}
	return $customTable;
}

function generic_civicrm_summary($contactId, &$content) {
  try {
  	//Get configuration & check if data is available
	$grp_prinshistory = generic_getCustomTableInfo('prins_history');

	if (isset($grp_prinshistory['group_table']) && !is_null($grp_prinshistory['group_table'])) {
		if (CRM_Core_DAO::checkTableExists($grp_prinshistory['group_table']) == TRUE) {
			$sql = "SELECT * FROM ".$grp_prinshistory['group_table']." WHERE entity_id = '".$contactId."'";
		  	$dao = CRM_Core_DAO::executeQuery($sql);
		  	$NumberOfProjects = $dao->N;

			$contactParams = array(
		      'id' => $contactId,
		      'return' => 'contact_sub_type'
		    );
		    $contactData = civicrm_api3('Contact', 'Getvalue', $contactParams);

		    if (isset($contactData) && is_array($contactData) && $NumberOfProjects > 0) {
				foreach ($contactData as $contactSubType) {
			 		if ($contactSubType == 'Expert') {
			 			$template_projects = CRM_Core_Smarty::singleton();
				        $template_projects->assign('NumberOfProjects', $NumberOfProjects);
					    $html_projects = $template_projects->fetch('CRM/Generic/Page/ExpertPUMHistory.tpl');
					    echo $html_projects;
					}
			    }
		    } else {
		    	$template_history = CRM_Core_Smarty::singleton();
				$template_history->assign('HistoryGroupID', $grp_prinshistory['group_id']);
			    $html_hidehistory = $template_history->fetch('CRM/Contact/Page/View/HideHistory.extra.tpl');
			    echo $html_hidehistory;
		    }
    	}
    } else {
		//Import did not run yet
	}
  } catch (CiviCRM_API3_Exception $ex) {
  	 CRM_Core_Error::debug_log_message($ex, FALSE);
  }
}

function generic_civicrm_pageRun(&$page) {
	if ($page instanceof CRM_Contact_Page_View_CustomData) {
		try {
			$prins_historie_gid = civicrm_api3('CustomGroup', 'getvalue', array(
				'name' => 'prins_history',
				'return' => 'id'
			));
			if ($page->_groupId == $prins_historie_gid) {
				$page->assign('editOwnCustomData', false);
				$page->assign('showEdit', false);
				$page->assign('editCustomData', false);
			}
		} catch (Exception $e) {
			// do nothing
		}
	}
}