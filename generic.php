<?php
require_once 'generic.civix.php';
/**
 * Implementation of hook_civicrm_install
 * 
 * @author Erik Hommel (erik.hommel@civicoop.org - http://www.civicoop.org)
 * @date 2 Dec 2013
 * 
 * Generate contact subtype(s), activity type(s) for PUM
 */
function generic_civicrm_install() {
    $requiredContactTypes = array(
        array(
            'name'      =>  "Expert",
            'parent'   =>  1
        )
    );
    $requiredActivityTypes = array("First Interview Expert");
    /*
     * contactTypes
     */
    $createdContactTypes = array();
    foreach ($requiredContactTypes as $contactType) {
        /*
         * only if Contact Type does not exist yet
         */
        try {
            civicrm_api3('ContactType', 'Getsingle', array('title' => $contactType['name']));
        } catch (CiviCRM_API3_Exception $e) {
            $contactTypeParams = array(
                'label'         =>  $contactType['name'],
                'name'          =>  $contactType['name'],
                'parent_id'     =>  $contactType['parent'],
                'is_active'     =>  0,
                'is_reserved'   =>  1
            );
            try {
                civicrm_api3('ContactType', 'Create', $contactTypeParams);
                $createdContactTypes[] = $contactType['name'];
            } catch (CiviCRM_API3_Exception $e) {
                CRM_Utils_System::setUFMessage("Could not create contact subtype {$contactType['name']}");
            }    
        }
    }
    $message = "Contact Subtypes ".implode(", ", $createdContactTypes)." succesfully created";
    CRM_Utils_System::setUFMessage($message);
    /*
     * activityTypes
     */
    $createdActivityTypes = array();
    try {
        $existingActivityTypes = civicrm_api3('ActivityTypes', 'Get');
    } catch (CiviCRM_API3_Exception $e) {
        $existingActivityTypes = array();
    }
    foreach ($requiredActivityTypes as $activityTypeName) {
        /*
         * check if activityType exists
         */
        if (!in_array($activityTypeName, $existingActivityTypes)) {
            $activityTypeParams = array(
                'name'      =>  $activityTypeName,
                'label'     =>  $activityTypeName,
                'weight'    =>  30,
                'is_active' =>  0
            );
            try {
               civicrm_api3('ActivityType', 'Create', $activityTypeParams);
               $createdActivityTypes[] = $activityTypeName;
            }
            catch (CiviCRM_API3_Exception $e) {
                CRM_Utils_System::setUFMessage("Could not generate activity type $activityTypeName");
            }
        }
    }
    if (!empty($createdActivityTypes)) {
        $message = "Activity Types ".implode(", ", $createdActivityTypes)." successfully created";
        CRM_Utils_System::setUFMessage($message);
    }    
    return _generic_civix_civicrm_install();
}
/**
 * Implementation of hook_civicrm_enable
 * 
 * @author Erik Hommel (erik.hommel@civicoop.org, http://www.civicoop.org)
 * @date 2 Dec 2013
 * 
 * Enable activity types and option groups
 */
function generic_civicrm_enable() {
    $requiredActivityTypes = array("First Interview Expert");
    $requiredContactTypes = array("Expert");
    /*
     * set all contact types to enabled
     */
    foreach ($requiredContactTypes as $contactTypeName) {
        $enableContactTypes = 
            "UPDATE civicrm_contact_type SET is_active = 1 WHERE name = '$contactTypeName'";
        CRM_Core_DAO::executeQuery($enableContactTypes);
    }
   /*
     * set all activity types to enabled
     */
    foreach ($requiredActivityTypes as $activityTypeName) {
        $enableActivityTypes = 
            "UPDATE civicrm_option_value SET is_active = 1 WHERE option_group_id = 2 
                AND name = '$activityTypeName'";
        CRM_Core_DAO::executeQuery($enableActivityTypes);
    }
    return _generic_civix_civicrm_enable();
}
/**
 * Implementation of hook_civicrm_disable
 * 
 * @author Erik Hommel (erik.hommel@civicoop.org, http://www.civicoop.org)
 * @date 2 Dec 2013
 * 
 * Disable activity types and option groups
 */
function generic_civicrm_disable() {
    $requiredActivityTypes = array("First Interview Expert");
    $requiredContactTypes = array("Expert");
    /*
     * set all contact types to disabled
     */
    foreach ($requiredContactTypes as $contactTypeName) {
        $disableContactTypes = 
            "UPDATE civicrm_contact_type SET is_active = 0 WHERE name = '$contactTypeName'";
        CRM_Core_DAO::executeQuery($disableContactTypes);
    }
    /*
     * set all activity types to disabled
     */
    foreach ($requiredActivityTypes as $activityTypeLabel) {
        $disableActivityTypes = 
            "UPDATE civicrm_option_value SET is_active = 0 WHERE option_group_id = 2 
                AND label = '$activityTypeLabel'";
        CRM_Core_DAO::executeQuery($disableActivityTypes);
    }
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
    $relationshipTypesCreated = array();
    $groupsCreated = array();
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
    $groupsCreated[] = "Experts";
    $message = "Groups ".implode(", ", $groupsCreated)." successfully created";
    CRM_Utils_System::setUFMessage($message);
    
    /*
     * create specific relationship types for PUM
     */
    $entities[] = array(
        'module'    => 'nl.pum.generic',
        'name'      => 'Country Co-ordinator',
        'entity'    => 'RelationshipType',
        'params'    => array(
            'version'       => 3,
            'name_a_b'      => 'Country Co-ordinator of',
            'name_b_a'      => 'Country Co-ordinator is',
            'label_a_b'     => 'Country Co-ordinator of',
            'label_b_a'     => 'Country Co-ordinator is',
            'contact_type_a'=> 'Individual',
            'contact_type_b'=> 'Organization',
            'description'   => 'Country Co-ordinator relationship',
            'is_active'     =>  1
        )
    );
    $relationshipTypesCreated[] = "Country Co-ordinator";
    
    $entities[] = array(
        'module'    => 'nl.pum.generic',
        'name'      => 'Sector Co-ordinator',
        'entity'    => 'RelationshipType',
        'params'    => array(
            'version'       => 3,
            'name_a_b'      => 'Sector Co-ordinator of',
            'name_b_a'      => 'Sector Co-ordinator is',
            'label_a_b'     => 'Sector Co-ordinator of',
            'label_b_a'     => 'Sector Co-ordinator is',
            'contact_type_a'=> 'Individual',
            'contact_type_b'=> 'Organization',
            'description'   => 'Sector Co-ordinator relationship',
            'is_active'     =>  1
        )
    );
    $relationshipTypesCreated[] = "Sector Co-ordinator";
    
    $entities[] = array(
        'module'    => 'nl.pum.generic',
        'name'      => 'Project Officer',
        'entity'    => 'RelationshipType',
        'params'    => array(
            'version'       => 3,
            'name_a_b'      => 'Project Officer for',
            'name_b_a'      => 'Project Officer is',
            'label_a_b'     => 'Project Officer for',
            'label_b_a'     => 'Project Officer is',
            'contact_type_a'=> 'Individual',
            'contact_type_b'=> 'Organization',
            'description'   => 'Project Officer relationship',
            'is_active'     =>  1
        )
    );
    $relationshipTypesCreated[] = "Project Officer";
    $message = "Relationship Types ".implode(", ", $relationshipTypesCreated)." successfully created";
    CRM_Utils_System::setUFMessage($message);    
    
    return _generic_civix_civicrm_managed($entities);    
}
