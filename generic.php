<?php
require_once 'generic.civix.php';
/**
 * Implementation of hook_civicrm_managed
 * 
 * @author Erik Hommel (erik.hommel@civicoop.org - http://www.civicoop.org)
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 */
function generic_civicrm_managed(&$entities) {
    $relationshipTypesCreated = array();
    $activityTypesCreated = array();
    $groupsCreated = array();
    $contactSubTypesCreated = array();
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

    /*
     * create specific activity types for PUM
     */
    $entities[] = array(
        'module'    => 'nl.pum.generic',
        'name'      => 'First Interview',
        'entity'    => 'ActivityType',
        'params'    => array(
            'version'       => 3,
            'label'         => 'First Interview Expert',
            'name'          => 'First Interview Expert',
            'weight'        => 99,
            'is_active'     => 1,
            'description'   => 'Activity for first selection interview with candidate expert'
        )
    );
    $activityTypesCreated[] = "First Interview Expert";
    $message = "Activity Types ".implode(", ", $activityTypesCreated). " successfully created";
    CRM_Utils_System::setUFMessage($message);
    
    /*
     * create specific contact subtype for PUM
     */
    $entities[] = array(
        'module'    => 'nl.pum.generic',
        'name'      => 'Expert',
        'entity'    => 'ContactType',
        'params'    => array(
            'version'       => 3,
            'label'         => 'Expert',
            'name'          => 'Expert',
            'is_active'     => 1,
            'description'   => 'Contact subtype for PUM Expert',
            'parent_id'     =>  1
        )
    );
    $contactSubTypesCreated[] = "Expert";
    $message = "Contact Subtypes ".implode(", ", $contactSubTypesCreated). " successfully created";
    CRM_Utils_System::setUFMessage($message);
    
    /*
     * create specific option groups for Marital Status and Nationality
     */
    $optionGroupsCreated = array();
    $entities[] = array(
        'module'    =>  'nl.pum.generic',
        'name'      =>  'Marital Status',
        'entity'    =>  'OptionGroup',
        'params'    =>  array(
            'version'       =>  3,
            'title'         =>  "Marital Status",
            'name'          =>  "marital_status",
            'is_reserved'   =>  1
        )
    );
    $optionGroupsCreated[] = "Marital Status";

    $optionGroupsCreated = array();
    $entities[] = array(
        'module'    =>  'nl.pum.generic',
        'name'      =>  'Nationality',
        'entity'    =>  'OptionGroup',
        'params'    =>  array(
            'version'       =>  3,
            'title'         =>  "Nationality",
            'name'          =>  "nationality",
            'is_reserved'   =>  1
        )
    );
    $optionGroupsCreated[] = "Nationality";
    CRM_Utils_System::setUFMessage("Option groups ".implode(", ", $optionGroupsCreated)." successfully created");

    return _generic_civix_civicrm_managed($entities);    
}
