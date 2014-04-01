<?php
require_once 'generic.civix.php';

require_once 'generic.contacttype.inc.php';
require_once 'generic.activitytype.inc.php';
require_once 'generic.group.inc.php';
require_once 'generic.relationshiptype.inc.php';
require_once 'generic.optiongroup.inc.php';
require_once 'generic.tag.inc.php';
require_once 'generic.customfield.inc.php';

/**
 * Implementation of hook_civicrm_install
 * 
 * @author Erik Hommel (erik.hommel@civicoop.org - http://www.civicoop.org)
 * @date 2 Dec 2013
 * 
 * Enable all non-managed entities required for PUM
 */
function generic_civicrm_install() {
	Generic_ContactType::install();
	Generic_Group::install();
	Generic_RelationshipType::install();
	Generic_OptionGroup::install();
	Generic_CustomField::install();
	Generic_Tag::install();
	Generic_ActivityType::install();
    return _generic_civix_civicrm_install();
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
	Generic_ContactType::enable();
	Generic_Group::enable();
	Generic_RelationshipType::enable();
	Generic_OptionGroup::enable();
	Generic_CustomField::enable();
	Generic_Tag::enable();
	Generic_ActivityType::enable();
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
	// reversed order
	Generic_ActivityType::disable();
	Generic_Tag::disable();
	Generic_CustomField::disable();
	Generic_OptionGroup::disable();
	Generic_RelationshipType::disable();
	Generic_Group::disable();
	Generic_ContactType::disable();
    return _generic_civix_civicrm_disable();
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
 * Implementation of hook_civicrm_uninstall
 */
function generic_civicrm_uninstall() {
	// reversed order
	Generic_ActivityType::uninstall();
	Generic_Tag::uninstall();
	Generic_CustomField::uninstall();
	Generic_OptionGroup::uninstall();
	Generic_RelationshipType::uninstall();
	Generic_Group::uninstall();
	Generic_ContactType::uninstall();
    return _generic_civix_civicrm_uninstall();
}

/**
 * Implementation of hook civicrm_navigationMenu
 * Adds menu menu items for the entities controlled by this extension
 */
function generic_civicrm_navigationMenu(&$params) {
	Generic_ContactType::hook_navigationMenu($params);
/* ** under construction **
    //$maxKey = ( max( array_keys($params) ) );
	$pKey = 18;
	dpm($params, 'navigationMenu parameters');
	$lv1 = NULL;
	$lv2 = NULL;
	foreach ($params as $menuLv1) {
		if ($menuLv1['attributes']['label'] == 'Contacts') {
			$lv1 = $menuLv1['attributes']['navID'];
		}
	}
	if (!is_null($lv1)) {
		foreach ($params[$lv1]['child'] as $menuLv2) {
			if ($menuLv1['attributes']['label'] == 'New Individual') {
				// process individual types
			}
			if ($menuLv1['attributes']['label'] == 'New Household') {
				// process household types
			}
			if ($menuLv1['attributes']['label'] == 'New Organization') {
				// process organization types
				// fetch child -> loop
				// attributes['label'] = <nm> gevonden> -> activate, anders -> add to children
			}
		}
	}
dpm($lv1, 'Menu Level 1');
	/*
	$params[$pKey]['child]] = array (
        'attributes' => array (
            'label'      => 'Programmes, Projects and Products',
            'name'       => 'Programmes, Projects and Products',
            'url'        => null,
            'permission' => null,
            'operator'   => null,
            'separator'  => null,
            'parentID'   => null,
            'navID'      => $maxKey+1,
            'active'     => 1
    ),
        'child' =>  array (
            '1' => array (
                'attributes' => array (
                    'label'      => 'List Programmes',
                    'name'       => 'List Programmes',
                    'url'        => 'civicrm/programmelist',
                    'operator'   => null,
                    'separator'  => 0,
                    'parentID'   => $maxKey+1,
                    'navID'      => 1,
                    'active'     => 1
                ),
                'child' => null
            ), 
        ), 
    );
	*/
}