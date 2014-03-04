<?php

class Generic_ActivityType {
	
	/*
	 * returns the definitions for generic activity types
	 */
	static function required() {
		return array(
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
		$existingComponents = self::_existingComponents();
		foreach ($required as $activityType) {
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
				$created[] = '"' . $activityType['label'] . '"';
			}
		}
		$message = "Activity Types " . implode(", ", $created) . " successfully created";
		CRM_Utils_System::setUFMessage($message);
	}
	
	private static function _existingComponents() {
		// store existing components in an array from which component_ids can easily be retrieved (components not available through API yet)
		$components = array();
		$qryComponents = 'select id, name from civicrm_component';
		$dao = CRM_Core_DAO::executeQuery($qryComponents);
		while ($dao->fetch()) {
			$components[$dao->name] = $dao->id;
		}
		return $components;
	}
	
}