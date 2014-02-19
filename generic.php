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
            'name'			=> "Expert",
            'parent'		=> "Individual",
			'description'	=> "PUM Expert"
        ),
		array(
            'name'			=> "Customer",
            'parent'		=> "Organization",
			'description'	=> "PUM Customer"
        ),
		array(
            'name'			=> "Partner",
            'parent'		=> "Organization",
			'description'	=> "Partner Organisation"
        ),
		array(
            'name'			=> "Donor",
            'parent'		=> "Organization",
			'description'	=> "Donor Organisation"
        )
    );
    
    /*
     * contactTypes
     */
    $createdContactTypes = array();
    foreach ($requiredContactTypes as $contactType) {
        /*
         * only if Contact Type does not exist yet
		 * and only if parent is available
         */
		try {
			$apiResult = civicrm_api3('ContactType', 'getvalue', array('sequential'=>1, 'json'=>1, 'return'=>'id', 'name'=>$contactType['parent']));
			try {
				civicrm_api3('ContactType', 'Getsingle', array('title' => $contactType['name']));
			} catch (CiviCRM_API3_Exception $e) {
				$contactTypeParams = array(
					'label'         =>  $contactType['name'],
					'name'          =>  $contactType['name'],
					'parent_id'     =>  $apiResult,
					'description'	=>  $contactType['description'],
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
		} catch (CiviCRM_API3_Exception $e) {
			CRM_Utils_System::setUFMessage("Could not create contact subtype {$contactType['name']}: no parent");
		}
    }
    $message = "Contact Subtypes ".implode(", ", $createdContactTypes)." succesfully created";
    CRM_Utils_System::setUFMessage($message);
	
    /*
     * activityTypes
     */
	/*
    $createdActivityTypes = array();
    try {
        $existingActivityTypes = civicrm_api3('ActivityTypes', 'Get');
    } catch (CiviCRM_API3_Exception $e) {
        $existingActivityTypes = array();
    }
    foreach ($requiredActivityTypes as $activityTypeName) {
        /*
         * check if activityType exists
         *x/
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
            } catch (CiviCRM_API3_Exception $e) {
                CRM_Utils_System::setUFMessage("Could not generate activity type $activityTypeName");
            }
        }
    }
    if (!empty($createdActivityTypes)) {
        $message = "Activity Types ".implode(", ", $createdActivityTypes)." successfully created";
        CRM_Utils_System::setUFMessage($message);
    }
	*/
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
	
	/*
	 * Activity Types
	 */
	 $requiredActivityTypes = array(
		array(
			'component' => 'CiviCase',
			'label' => 'Accept or Reject Product by Expert',
			'description' => 'Used in "Factfinding Mission"'
			),
		array(
			'component' => 'CiviCase',
			'label' => 'Add Expert Information',
			'description' => 'Used in "Factfinding Mission". In deze stap vult de Expert zijn beschikbaarheid en key qualifications aan zodat de klant hier straks de meest up to date info over heeft.'
			),
		array(
			'component' => 'CiviCase',
			'label' => 'Add key qualifications and availability to PUM-expert CV',
			'description' => 'Used in "Factfinding Mission"'
			),
		array(
			'component' => 'CiviCase',
			'label' => 'Additional comments by Prof',
			'description' => 'Used in "Factfinding Mission"'
			),
		array(
			'component' => 'CiviCase',
			'label' => 'Approve PUM-expert information by PrOf and send PUM-expert profile to customer',
			'description' => 'Used in "Factfinding Mission"'
			),
		array(
			'component' => 'CiviCase',
			'label' => 'Approve PUM-expert information by SC',
			'description' => 'Used in "Factfinding Mission"'
			),
		array(
			'component' => 'CiviCase',
			'label' => 'Approve PUM-expert information CC',
			'description' => 'Used in "Factfinding Mission"'
			),
		array(
			'component' => 'CiviCase',
			'label' => 'Assess Expert Application',
			'description' => 'Used in "Expertapplication" Assess the Expert Application containing Basic Condition, Additional Information en attached CV.'
			),
		array(
			'component' => 'CiviCase',
			'label' => 'Assess project proposal by anamon',
			'description' => 'Used for "Projectrequest"'
			),
		array(
			'component' => 'CiviCase',
			'label' => 'Assess project proposal by cc',
			'description' => 'Used for "Projectrequest"'
			),
		array(
			'component' => 'CiviCase',
			'label' => 'Assess project proposal by sc',
			'description' => 'Used for "Projectrequest"'
			),
		array(
			'component' => 'CiviCase',
			'label' => 'Book contributors',
			'description' => 'Used in "Organise Event"'
			),
		array(
			'component' => 'CiviCase',
			'label' => 'Book location',
			'description' => 'Used in "Organise Event"'
			),
		array(
			'component' => 'CiviCase',
			'label' => 'Book meeting room',
			'description' => 'Used for "Organise Event"'
			),
		array(
			'component' => 'CiviCase',
			'label' => 'Check agenda participants',
			'description' => 'Used in "Organise Event"'
			),
		array(
			'component' => 'CiviCase',
			'label' => 'Compose programme',
			'description' => 'Used in "Organise Event"'
			),
		array(
			'component' => 'CiviCase',
			'label' => 'Confirm participation',
			'description' => 'Used in "Organise Event"'
			),
		array(
			'component' => 'CiviCase',
			'label' => 'Contact about Customer',
			'description' => ''
			),
		array(
			'component' => 'CiviCase',
			'label' => 'Contact about Expert',
			'description' => ''
			),
		array(
			'component' => 'CiviCase',
			'label' => 'Contact with Customer',
			'description' => ''
			),
		array(
			'component' => 'CiviCase',
			'label' => 'Contact with Expert',
			'description' => ''
			),
		array(
			'component' => 'CiviCase',
			'label' => 'Create concept project plan option',
			'description' => 'Used in "FactfindingMission"'
			),
		array(
			'component' => 'CiviCase',
			'label' => 'Customer assesses PUM-expert profile',
			'description' => 'Used in "Factfinding Mission"'
			),
		array(
			'component' => 'CiviCase',
			'label' => 'Customer enters evaluation form',
			'description' => 'Used in "Factfindingmission"'
			),
		array(
			'component' => 'CiviCase',
			'label' => 'Examine options',
			'description' => 'Used in "Organise Event"'
			),
		array(
			'component' => 'CiviCase',
			'label' => 'Expert to assess projectrequest',
			'description' => 'Used in "Projectrequest"'
			),
		array(
			'component' => 'CiviCase',
			'label' => 'Factfinding missie',
			'description' => ''
			),
		array(
			'component' => 'CiviCase',
			'label' => 'Invite applicant',
			'description' => 'Used in "Expert Application" Uitnodigen van een geinteresseerde expert.'
			),
		array(
			'component' => 'CiviCase',
			'label' => 'Invite participants',
			'description' => 'Used in "Organize Event"'
			),
		array(
			'component' => 'CiviCase',
			'label' => 'Invite to meeting',
			'description' => 'Used for "Organise Event"'
			),
		array(
			'component' => 'CiviCase',
			'label' => 'KIT test',
			'description' => 'Used in Expertapplication'
			),
		array(
			'component' => 'CiviCase',
			'label' => 'Plan activities',
			'description' => 'Used in "Organise Event"'
			),
		array(
			'component' => 'CiviCase',
			'label' => 'PR enters debriefing form',
			'description' => 'Used in "Factfindingmission"'
			),
		array(
			'component' => 'CiviCase',
			'label' => 'Prof assigns briefingdocuments for expert to cc',
			'description' => 'Used in "Factfindingmission"'
			),
		array(
			'component' => 'CiviCase',
			'label' => 'Prof checks and transfers approved budget',
			'description' => 'Used in "Factfinding Mission"'
			),
		array(
			'component' => 'CiviCase',
			'label' => 'Prof enters travel details and requests expert for OK',
			'description' => 'Used for "Factfindingmissie"'
			),
		array(
			'component' => 'CiviCase',
			'label' => 'Prof enters travel details and requests organisation for OK and pick up details',
			'description' => 'Used in "Factfindingmission"'
			),
		array(
			'component' => 'CiviCase',
			'label' => 'Prof requests visa for expert',
			'description' => 'Used in "Factfindingmission"'
			),
		array(
			'component' => 'CiviCase',
			'label' => 'Prof sends travel request to BCD',
			'description' => 'Used in "Factfindingmission"'
			),
		array(
			'component' => 'CiviCase',
			'label' => 'Prof sends visa forms to expert',
			'description' => 'Used in "Factfindingmission"'
			),
		array(
			'component' => 'CiviCase',
			'label' => 'PUM Rep assess Projectrequest',
			'description' => 'Used for "Projectrequest"'
			),
		array(
			'component' => 'CiviCase',
			'label' => 'Report on meeting',
			'description' => 'Used in "Organise Event"'
			),
		array(
			'component' => 'CiviCase',
			'label' => 'SC enters debriefing form',
			'description' => 'Used in "Factfindingmission"'
			),
		array(
			'component' => 'CiviCase',
			'label' => 'Select and match PUM-expert to product',
			'description' => 'Used in "Factfinding Mission"'
			)
	);
	// store existing components in an array from which component_ids can easily be retrieved (components not available through API yet)
	$existingComponents = array();
	$qryComponents = 'select id, name from civicrm_component';
	$dao = CRM_Core_DAO::executeQuery($qryComponents);
	while ($dao->fetch()) {
		$existingComponents[$dao->name] = $dao->id;
	}
	// start processing required activity types
	$activityTypesCreated = array();
	foreach ($requiredActivityTypes as $activityType) {
		if (array_key_exists($activityType['component'], $existingComponents)) {
			$entities[] = array(
				'module'	=> 'nl.pum.generic',
				'name'		=> $activityType['label'],
				'entity'	=> 'ActivityType',
				'params'	=> array(
					'version'		=> 3,
					'name'			=> $activityType['label'],
					'label'			=> $activityType['label'],
					'description'	=> $activityType['description'],
					'component_id'	=> $existingComponents[$activityType['component']],
					'is_active'		=> 1,
					'weight'		=> 0
				)
			);
			$activityTypesCreated[] = $activityType['label'];
		}
	}
	$message = "Activity Types " . implode(", ", $activityTypesCreated) . " successfully created";
    CRM_Utils_System::setUFMessage($message);
    
    return _generic_civix_civicrm_managed($entities);    
}
/**
 *
 * Implementation of hook_civicrm_uninstall
 */
function generic_civicrm_uninstall() {
    return _generic_civix_civicrm_uninstall();
}