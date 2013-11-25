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
    $customGroupsCreated = array();
    $customFieldsCreated = array();
    /*
     * create custom group Additional Data
     */
    $customGroupParams = array(
        'name'                  =>  "Additional_Data",
        'title'                 =>  "Additional Data",
        'extends'               =>  "Individual",
        'style'                 =>  "Inline",
        'is_active'             =>  0,
        'collapse_adv_display'  =>  1
    );
    try {
        $customGroup = civicrm_api3('CustomGroup', 'Create', $customGroupParams);
    }
    catch (CiviCRM_API3_Exception $e) {
        $message = "Custom group Additional Data NOT created. Error message from API : ";
        $message .= $e->getMessage();
        CRM_Utils_System::setUFMessage($message);
    }
    $customGroupsCreated[] = "Additional Data";

    /*
     * create Custom Field Passport Name
     */
    if (isset($customGroup['id'])) {
        $customFieldParams = array(
            'custom_group_id'   =>  $customGroup['id'],
            'name'              =>  "Passport_Name",
            'label'             =>  "Passport Name",
            'data_type'         =>  "String",
            'html_type'         =>  "Text",
            'is_required'       =>  0,
            'is_searchable'     =>  1,
            'is_active'         =>  0
        );
        try {
            civicrm_api3('CustomField', 'Create', $customFieldParams);
            $customFieldsCreated[] = "Passport Name";
        }
        catch (CiviCRM_API3_Exception $e) {
            $message = "Custom field Passport Name NOT created. Error message from API : ";
            $message .= $e->getMessage();
            CRM_Utils_Systm::setUFMessage($message);
        }
        
        /*
         * create Custom Field Initials
         */
        $customFieldParams = array(
            'custom_group_id'   =>  $customGroup['id'],
            'name'              =>  "Initials",
            'label'             =>  "Initials",
            'data_type'         =>  "String",
            'html_type'         =>  "Text",
            'is_required'       =>  0,
            'is_searchable'     =>  1,
            'is_active'         =>  0
        );
        try {
            civicrm_api3('CustomField', 'Create', $customFieldParams);
            $customFieldsCreated[] = "Initials";
        }
        catch (CiviCRM_API3_Exception $e) {
            $message = "Custom field Initials NOT created. Error message from API : ";
            $message .= $e->getMessage();
            CRM_Utils_Systm::setUFMessage($message);
        }
        
        /*
         * create Custom Field City of Birth
         */
        $customFieldParams = array(
            'custom_group_id'   =>  $customGroup['id'],
            'name'              =>  "City_of_Birth",
            'label'             =>  "City of Birth",
            'data_type'         =>  "String",
            'html_type'         =>  "Text",
            'is_required'       =>  0,
            'is_searchable'     =>  1,
            'is_active'         =>  0
        );
        try {
            civicrm_api3('CustomField', 'Create', $customFieldParams);
            $customFieldsCreated[] = "City of Birth";
        }
        catch (CiviCRM_API3_Exception $e) {
            $message = "Custom field City of Birth NOT created. Error message from API : ";
            $message .= $e->getMessage();
            CRM_Utils_Systm::setUFMessage($message);
        }
                
        /*
         * create Custom Field Prins Unique ID
         */
        $customFieldParams = array(
            'custom_group_id'   =>  $customGroup['id'],
            'name'              =>  "Prinses_Unique_ID",
            'label'             =>  "Prins Unique ID",
            'data_type'         =>  "String",
            'html_type'         =>  "Text",
            'is_required'       =>  0,
            'is_searchable'     =>  1,
            'is_view'           =>  1,
            'is_active'         =>  0
        );
        try {
            civicrm_api3('CustomField', 'Create', $customFieldParams);
            $customFieldsCreated[] = "Prins Unique ID";
        }
        catch (CiviCRM_API3_Exception $e) {
            $message = "Custom field Prins Unique ID NOT created. Error message from API : ";
            $message .= $e->getMessage();
            CRM_Utils_Systm::setUFMessage($message);
        }
        
        /*
         * create Custom Field Registration Date
         */
        $customFieldParams = array(
            'custom_group_id'   =>  $customGroup['id'],
            'name'              =>  "Registration_Date",
            'label'             =>  "Registration Date",
            'data_type'         =>  "Date",
            'html_type'         =>  "Select Date",
            'is_required'       =>  0,
            'is_searchable'     =>  1,
            'is_search_range'   =>  1,
            'start_date_years'  =>  10,
            'end_date_years'    =>  2,
            'date_format'       =>  "dd-mm-yy",
            'is_active'         =>  0
        );
        try {
            civicrm_api3('CustomField', 'Create', $customFieldParams);
            $customFieldsCreated[] = "Registration Date";
        }
        catch (CiviCRM_API3_Exception $e) {
            $message = "Custom field Registration Date NOT created. Error message from API : ";
            $message .= $e->getMessage();
            CRM_Utils_Systm::setUFMessage($message);
        }
        
        /*
         * create Option Group Marital Status (required for Custom Field Marital Status)
         */
        $optionGroupParams = array(
            'name'          =>  "marital_status",
            'title'         =>  "Marital Status",
            'is_reserved'   =>  1,
            'is_active'     =>  0
        );
        try {
            $optionGroup = civicrm_api3('OptionGroup', 'Create', $optionGroupParams);
                
            /*
             * create Custom Field Marital Status
             */
            $customFieldParams = array(
                'custom_group_id'   =>  $customGroup['id'],
                'name'              =>  "Marital_Status",
                'label'             =>  "Marital Status",
                'data_type'         =>  "String",
                'html_type'         =>  "Select",
                'is_required'       =>  0,
                'is_searchable'     =>  1,
                'option_group_id'   =>  $optionGroup['id'],
                'is_active'         =>  0
            );
            try {
                civicrm_api3('CustomField', 'Create', $customFieldParams);
                $customFieldsCreated[] = "Marital Status";
            }
            catch (CiviCRM_API3_Exception $e) {
                $message = "Custom field Marital Status NOT created. Error message from API : ";
                $message .= $e->getMessage();
                CRM_Utils_System::setUFMessage($message);
            }
        }
        catch (CiviCRM_API3_Exception $e) {
            $message = "Option group and custom field for Marital Status NOT created. Error message from API : ";
            $message .= $e->getMessage();
            CRM_Utils_Systm::setUFMessage($message);
        }
        /*
         * create Option Group Nationality (required for Custom Field Nationality)
         */
        $optionGroupParams = array(
            'name'          =>  "nationality",
            'title'         =>  "Nationality",
            'is_reserved'   =>  1,
            'is_active'     =>  0
        );
        try {
            $optionGroup = civicrm_api3('OptionGroup', 'Create', $optionGroupParams);
                
            /*
             * create Custom Field Nationality
             */
            $customFieldParams = array(
                'custom_group_id'   =>  $customGroup['id'],
                'name'              =>  "Nationality",
                'label'             =>  "Nationality",
                'data_type'         =>  "String",
                'html_type'         =>  "Select",
                'is_required'       =>  0,
                'is_searchable'     =>  1,
                'option_group_id'   =>  $optionGroup['id'],
                'is_active'         =>  0
            );
            try {
                civicrm_api3('CustomField', 'Create', $customFieldParams);
                $customFieldsCreated[] = "Nationality";
            }
            catch (CiviCRM_API3_Exception $e) {
                $message = "Custom field Nationality NOT created. Error message from API : ";
                $message .= $e->getMessage();
                CRM_Utils_System::setUFMessage($message);
            }
            
        }
        catch (CiviCRM_API3_Exception $e) {
            $message = "Option group and custom field for Nationality NOT created. Error message from API : ";
            $message .= $e->getMessage();
            CRM_Utils_Systm::setUFMessage($message);
        }
        
        /*
         * create Custom Field Country of Birth
         */
        $customFieldParams = array(
            'custom_group_id'   =>  $customGroup['id'],
            'name'              =>  "Country_of_Birth",
            'label'             =>  "Country of Birth",
            'data_type'         =>  "Country",
            'html_type'         =>  "Select Country",
            'default_value'     =>  1152,
            'is_required'       =>  0,
            'is_searchable'     =>  1,
            'is_active'         =>  0
        );
        try {
            civicrm_api3('CustomField', 'Create', $customFieldParams);
            $customFieldsCreated[] = "Country of Birth";
        }
        catch (CiviCRM_API3_Exception $e) {
            $message = "Custom field Country of Birth NOT created. Error message from API : ";
            $message .= $e->getMessage();
            CRM_Utils_Systm::setUFMessage($message);
        }
        
        
        
    } else {
        $message = "Custom fields for Additional Data NOT created, custom group id not found.";
        CRM_Utils_System::setUFMessage($message);
    }
    $message = "Custom Groups ".implode(", ", $customGroupsCreated)." successfully created";
    CRM_Utils_System::setUFMessage($message);
    $message = "Custom Fields ".implode(", ", $customFieldsCreated)." successfully created";
    CRM_Utils_System::setUFMessage($message);   
    
    return _generic_civix_civicrm_install();
}

/**
 * Implementation of hook_civicrm_uninstall
 */
function generic_civicrm_uninstall() {
    /*
     * uninstall option values and option group Marital Status
     */
    try {
        $optionGroup = civicrm_api3('OptionGroup', 'Getsingle', array('name' => "marital_status"));
    }
    catch (CiviCRM_API3_Exception $e) {
        $message = "Unable to uninstall option group Marital Status. Error message from API : ";
        $message .= $e->getMessage();
        CRM_Utils_System::setUFMessage($message);
    }
    /*
     * first delete all option values for group
     */
    try {
        $optionValues = civicrm_api3('OptionGroup', 'Get', array('option_group_id' => $optionGroup['id']));
        foreach ($optionValues['values'] as $optionValue) {
            try {
                civicrm_api3('OptionValue', 'Delete', array('id' => $optionValue['id']));
            }
            catch (CiviCRM_API3_Exception $e) {
            }
        }
    }
    catch (CiviCRM_API3_Exception $e) {
        $message = "Unable to delete option values for option group Marital Status. Error message from API : ";
        $message .= $e->getMessage();
        CRM_Utils_System::setUFMessage($message);
    }
    /*
     * now uninstall option group 
     */
      
    try {
        civicrm_api3('OptionGroup', 'Delete', array('id' => $optionGroup['id']));
    }
    catch (CiviCRM_API3_Exception $e) {
        $message = "Unable to uninstall option group Marital Status. Error message from API : ";
        $message .= $e->getMessage();
        CRM_Utils_System::setUFMessage($message);
    }
    
    /*
     * uninstall option values and option group Nationality
     */
    try {
        $optionGroup = civicrm_api3('OptionGroup', 'Getsingle', array('name' => "nationality"));
    }
    catch (CiviCRM_API3_Exception $e) {
        $message = "Unable to uninstall option group Nationality. Error message from API : ";
        $message .= $e->getMessage();
        CRM_Utils_System::setUFMessage($message);
    }
    /*
     * first delete all option values for group
     */
    try {
        $optionValues = civicrm_api3('OptionGroup', 'Get', array('option_group_id' => $optionGroup['id']));
        foreach ($optionValues['values'] as $optionValue) {
            try {
                civicrm_api3('OptionValue', 'Delete', array('id' => $optionValue['id']));
            }
            catch (CiviCRM_API3_Exception $e) {
            }
        }
    }
    catch (CiviCRM_API3_Exception $e) {
        $message = "Unable to delete option values for option group Nationality. Error message from API : ";
        $message .= $e->getMessage();
        CRM_Utils_System::setUFMessage($message);
    }
    /*
     * now uninstall option group 
     */
      
    try {
        civicrm_api3('OptionGroup', 'Delete', array('id' => $optionGroup['id']));
    }
    catch (CiviCRM_API3_Exception $e) {
        $message = "Unable to uninstall option group Nationality. Error message from API : ";
        $message .= $e->getMessage();
        CRM_Utils_System::setUFMessage($message);
    }

    /*
     * uninstall custom group and custom fields Additional Data
     */
    try {
        $customGroup = civicrm_api3('CustomGroup', 'Getsingle', array('name' => "Additional_Data"));
    }
    catch (CiviCRM_API3_Exception $e) {
        $message = "Unable to uninstall custom group Additional Data. Error message from API : ";
        $message .= $e->getMessage();
        CRM_Utils_System::setUFMessage($message);
    }
    /*
     * first delete all custom fields for group
     */
    try {
        $customFields = civicrm_api3('CustomField', 'Get', array('custom_group_id' => $customGroup['id']));
        foreach ($customFields['values'] as $customFieldId => $customField) {
            try {
                civicrm_api3('CustomField', 'Delete', array('id' => $customFieldId));
            }
            catch (CiviCRM_API3_Exception $e) {
                $message = "Unable to delete custom field id $customFieldId. Error message from API : ";
                $message .= $e->getMessage();
                CRM_Utils_System::setUFMessage($message);
            }
        }
    }
    catch (CiviCRM_API3_Exception $e) {
        $message = "Unable to delete custom fields for custom group Additional Data. Error message from API : ";
        $message .= $e->getMessage();
        CRM_Utils_System::setUFMessage($message);
    }
      
    try {
        civicrm_api3('CustomGroup', 'Delete', array('id' => $customGroup['id']));
    }
    catch (CiviCRM_API3_Exception $e) {
        $message = "Unable to uninstall custom group Additional Data. Error message from API : ";
        $message .= $e->getMessage();
        CRM_Utils_System::setUFMessage($message);
    }
    CRM_Utils_System::setUFMessage("Custom Group Additiional Data deleted with all its Custom Fields");
    
    return _generic_civix_civicrm_uninstall();
}

/**
 * Implementation of hook_civicrm_enable
 */
function generic_civicrm_enable() {
    $customGroupsEnabled = array();
    $customFieldsEnabled = array();
    /*
     * enable option groups
     */
    try {
        $optionGroup = civicrm_api3('OptionGroup', 'Getsingle', array('name' => "marital_status"));
    }
    catch (CiviCRM_API3_Exception $e) {
        $message = "Unable to enable option group Marital Status. Error message from API : ";
        $message .= $e->getMessage();
        CRM_Utils_System::setUFMessage($message);
    }
    $optionGroupParams = array(
            'id'            =>  $optionGroup['id'],
            'name'          =>  "marital_status",
            'title'         =>  "Marital Status",
            'is_reserved'   =>  1,
            'is_active'     =>  1
        );
    try {
        civicrm_api3('OptionGroup', 'Create', $optionGroupParams);
    }
    catch (CiviCRM_API3_Exception $e) {
    }
    try {
        $optionGroup = civicrm_api3('OptionGroup', 'Getsingle', array('name' => "nationality"));
    }
    catch (CiviCRM_API3_Exception $e) {
        $message = "Unable to enable option group Nationality. Error message from API : ";
        $message .= $e->getMessage();
        CRM_Utils_System::setUFMessage($message);
    }
    $optionGroupParams = array(
            'id'            =>  $optionGroup['id'],
            'name'          =>  "nationality",
            'title'         =>  "Nationality",
            'is_reserved'   =>  1,
            'is_active'     =>  1
        );
    try {
        civicrm_api3('OptionGroup', 'Create', $optionGroupParams);
    }
    catch (CiviCRM_API3_Exception $e) {
    }
    /*
     * enable Custom Group and Custom Fields Additional Data
     */
    try {
        $customGroup = civicrm_api3('CustomGroup', 'Getsingle', array('name' => "Additional_Data"));
    }
    catch (CiviCRM_API3_Exception $e) {
        $message = "Unable to enable custom group Additional Data. Error message from API : ";
        $message .= $e->getMessage();
        CRM_Utils_System::setUFMessage($message);
    }
    $customGroupParams = array(
        'id'                    =>  $customGroup['id'],
        'name'                  =>  "Additional_Data",
        'title'                 =>  "Additional Data",
        'extends'               =>  "Individual",
        'style'                 =>  "Inline",
        'is_active'             =>  1,
        'collapse_adv_display'  =>  1
    );
    try {
        civicrm_api3('CustomGroup', 'Create', $customGroupParams);
        
    }
    catch (CiviCRM_API3_Exception $e) {
        $message = "Unable to enable custom group Additional Data. Error message from API : ";
        $message .= $e->getMessage();
        CRM_Utils_System::setUFMessage($message);
    }
    $customGroupsEnabled[] = "Additional Data";

    try {
        $customFields = civicrm_api3('CustomField', 'Get', array('custom_group_id' => $customGroup['id']));
    }
    catch (CiviCRM_API3_Exception $e) {
        $message = "Unable to enable custom fields for custom group Additional Data. Error message from API : ";
        $message .= $e->getMessage();
        CRM_Utils_System::setUFMessage($message);
    }

    foreach ($customFields['values'] as $customFieldId => $customField) {
        $customFieldParams['id'] = $customFieldId;
        foreach ($customField as $customFieldName => $customValue) {
            $customFieldParams[$customFieldName] = $customValue;
        }
        $customFieldParams['is_active'] = 1;
        try {
            civicrm_api3('CustomField', 'Create', $customFieldParams);
        }
        catch (CiviCRM_API3_Exception $e) {
            $message = "Unable to enable custom field ";
            $message .= $customFieldParams['label']." . Error from API is : ";
            $message .= $e->getMessage();
            CRM_Utils_System::setUFMessage($message);
        }
        $customFieldsEnabled[] = $customFieldParams['label'];
    }
    $message = "Custom Groups ".implode(", ", $customGroupsEnabled)." enabled";
    CRM_Utils_System::setUFMessage($message);
    $message = "Custom Fields ".implode(", ", $customFieldsEnabled)." enabled";
    CRM_Utils_System::setUFMessage($message);
    
    return _generic_civix_civicrm_enable();
}

/**
 * Implementation of hook_civicrm_disable
 */
function generic_civicrm_disable() {
    $customGroupsDisabled = array();
    $customFieldsDisabled = array();
    /*
     * disable option groups
     */
    try {
        $optionGroup = civicrm_api3('OptionGroup', 'Getsingle', array('name' => "marital_status"));
    }
    catch (CiviCRM_API3_Exception $e) {
        $message = "Unable to disable option group Marital Status. Error message from API : ";
        $message .= $e->getMessage();
        CRM_Utils_System::setUFMessage($message);
    }
    $optionGroupParams = array(
            'id'            =>  $optionGroup['id'],
            'name'          =>  "marital_status",
            'title'         =>  "Marital Status",
            'is_reserved'   =>  1,
            'is_active'     =>  0
        );
    try {
        civicrm_api3('OptionGroup', 'Create', $optionGroupParams);
    }
    catch (CiviCRM_API3_Exception $e) {
    }
    try {
        $optionGroup = civicrm_api3('OptionGroup', 'Getsingle', array('name' => "nationality"));
    }
    catch (CiviCRM_API3_Exception $e) {
        $message = "Unable to disable option group Nationality. Error message from API : ";
        $message .= $e->getMessage();
        CRM_Utils_System::setUFMessage($message);
    }
    $optionGroupParams = array(
            'id'            =>  $optionGroup['id'],
            'name'          =>  "nationality",
            'title'         =>  "Nationality",
            'is_reserved'   =>  1,
            'is_active'     =>  0
        );
    try {
        civicrm_api3('OptionGroup', 'Create', $optionGroupParams);
    }
    catch (CiviCRM_API3_Exception $e) {
    }
    /*
     * disable Custom Group and Custom Fields Additional Data
     */
    try {
        $customGroup = civicrm_api3('CustomGroup', 'Getsingle', array('name' => "Additional_Data"));
    }
    catch (CiviCRM_API3_Exception $e) {
        $message = "Unable to disable custom group Additional Data. Error message from API : ";
        $message .= $e->getMessage();
        CRM_Utils_System::setUFMessage($message);
    }
    $customGroupParams = array(
        'id'                    =>  $customGroup['id'],
        'name'                  =>  "Additional_Data",
        'title'                 =>  "Additional Data",
        'extends'               =>  "Individual",
        'style'                 =>  "Inline",
        'is_active'             =>  0,
        'collapse_adv_display'  =>  1
    );
    try {
        civicrm_api3('CustomGroup', 'Create', $customGroupParams);
        
    }
    catch (CiviCRM_API3_Exception $e) {
        $message = "Unable to disable custom group Additional Data. Error message from API : ";
        $message .= $e->getMessage();
        CRM_Utils_System::setUFMessage($message);
    }
    $customGroupsDisabled[] = "Additional Data";

    try {
        $customFields = civicrm_api3('CustomField', 'Get', array('custom_group_id' => $customGroup['id']));
    }
    catch (CiviCRM_API3_Exception $e) {
        $message = "Unable to disable custom fields for custom group Additional Data. Error message from API : ";
        $message .= $e->getMessage();
        CRM_Utils_System::setUFMessage($message);
    }

    foreach ($customFields['values'] as $customFieldId => $customField) {
        $customFieldParams['id'] = $customFieldId;
        foreach ($customField as $customFieldName => $customValue) {
            $customFieldParams[$customFieldName] = $customValue;
        }
        $customFieldParams['is_active'] = 0;
        try {
            civicrm_api3('CustomField', 'Create', $customFieldParams);
        }
        catch (CiviCRM_API3_Exception $e) {
            $message = "Unable to disable custom field ";
            $message .= $customFieldParams['label']." . Error from API is : ";
            $message .= $e->getMessage();
            CRM_Utils_System::setUFMessage($message);
        }
        $customFieldsDisabled[] = $customFieldParams['label'];
    }
    $message = "Custom Groups ".implode(", ", $customGroupsDisabled)." disabled";
    CRM_Utils_System::setUFMessage($message);
    $message = "Custom Fields ".implode(", ", $customFieldsDisabled)." disabled";
    CRM_Utils_System::setUFMessage($message);
    
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
    
    return _generic_civix_civicrm_managed($entities);    
}
