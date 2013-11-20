<?php

require_once 'generic.civix.php';

/**
 * Implementation of hook_civicrm_config
 */
function generic_civicrm_config(&$config) {
  _generic_civix_civicrm_config($config);
}

/**
 * Implementation of hook_civicrm_xmlMenu
 *
 * @param $files array(string)
 */
function generic_civicrm_xmlMenu(&$files) {
  _generic_civix_civicrm_xmlMenu($files);
}

/**
 * Implementation of hook_civicrm_install
 */
function generic_civicrm_install() {
  return _generic_civix_civicrm_install();
}

/**
 * Implementation of hook_civicrm_uninstall
 */
function generic_civicrm_uninstall() {
  return _generic_civix_civicrm_uninstall();
}

/**
 * Implementation of hook_civicrm_enable
 */
function generic_civicrm_enable() {
  return _generic_civix_civicrm_enable();
}

/**
 * Implementation of hook_civicrm_disable
 */
function generic_civicrm_disable() {
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
 */
function generic_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _generic_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implementation of hook_civicrm_managed
 * 
 * @author Erik Hommel (erik.hommel@civicoop.org - http://www.civicoop.org)
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 */
function generic_civicrm_managed(&$entities) {
    /*
     * create specific groups for PUM
     */
    $entities[] = array(
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
    );
    /*
     * create specific relationship types for PUM
     */
    $entities[] = array(
        'module'    => 'nl.pum.generic',
        'name'      => 'Country Co-ordinator',
        'entity'    => 'RelationshipType',
        'params'    => array(
            'version'       => 3,
            'name_a_b'      => 'Contactpersoon of',
            'name_b_a'      => 'Contactperson is',
            'label_a_b'     => 'Contactperson of',
            'label_b_a'     => 'Contactperson is',
            'contact_type_a'=> 'Individual',
            'contact_type_b'=> 'Organization',
            'description'   => 'Country Co-ordinator relationship',
            'is_active'     =>  1
        )
    );
    /*
     * create specific activity types for PUM
     */
    
  return _generic_civix_civicrm_managed($entities);
}
