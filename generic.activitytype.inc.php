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
				),
			array(
				'component' => 'CiviCase',
				'label' => 'All involved assess projectresults',
				'description' => 'Used in "Projectevaluation"'
				),
			array(
				'component' => 'CiviCase',
				'label' => 'Adjust Projectplan',
				'description' => 'Used in "Advice"'
				),
			array(
				'component' => 'CiviCase',
				'label' => 'Projectmanager requests expert to create BLP product',
				'description' => 'Used in "BLP"'
				),
			array(
				'component' => 'CiviCase',
				'label' => 'Assess BLP proposal by CC',
				'description' => 'Used in "BLP"'
				),
			array(
				'component' => 'CiviCase',
				'label' => 'Assess BLP proposal by SC',
				'description' => 'Used in "BLP"'
				),
			array(
				'component' => 'CiviCase',
				'label' => 'Prof send invoice and registration form link to customer',
				'description' => 'Used in "BLP"'
				),
			array(
				'component' => 'CiviCase',
				'label' => 'Prof creates invitation letter for customer',
				'description' => 'Used in "BLP"'
				),
			array(
				'component' => 'CiviCase',
				'label' => 'Prof assembles briefingsmap',
				'description' => 'Used in "BLP"'
				),
			array(
				'component' => 'CiviCase',
				'label' => 'Prof checks and transfers approved budget',
				'description' => 'Used in "BLP"'
				),
			array(
				'component' => 'CiviCase',
				'label' => 'Projectmanager or expert creates product HBF with concept budget'
				,'description' => 'Used in "HBF"'
				),
			array(
				'component' => 'CiviCase',
				'label' => 'Check and assess HBF application',
				'description' => 'Used in "HBF"'
				),
			array(
				'component' => 'CiviCase',
				'label' => 'Transfer the approved budget to projectmanager, expert or PUM Rep',
				'description' => 'Used in "HBF"'
				),
		);
	}
	
	/*
	 * returns the definitions for standard civicrm activity types to keep
	 * ones not listed here and not listed in required() will be disabled in the install process
	 */
	static function tolerate() {
		return array(
			'Open Case',
			'Bulk Email',
			'Change Case Start Date',
			'Change Case Status',
			'Change Case Type',
			'Follow up',
			'Event Registration',
			'Meeting',
		);
	}
	
	/*
	 * handler for hook_civicrm_install
	 */
	static function install() {
		// basically action types are option values as well
		$created = array();
		$required = self::required();
		$tolerate = self::tolerate();
		$existingComponents = self::_existingComponents();
		$componentId = NULL;
				
		// retrieve activity_type group id
		$optionGroupId = self::_getActivityTypeGroupId();
		
		if (is_null($optionGroupId)) {
			// optiongroup not found: cannot proceed
			CRM_Utils_System::setUFMessage('Could not find option group "activity_type" - no activity types processed');
		} else {
			// optiongroup found: use it as option_group_id in option values
			foreach ($required as $activityType) {
				$componentId = NULL;
				$tolerate[] = $activityType['label']; // add $required elements to $tolerate to avoid disabling
				
				// translate component to id (null = 'Contacts OR Cases')
				if (array_key_exists($activityType['component'], $existingComponents)) {
					$componentId = $existingComponents[$activityType['component']];
				}
				
				// verify if optionvalue/activity type exists
				$params = array(
					'version'			=> 3,
					'sequential'		=> 1,
					'option_group_id'	=> $optionGroupId,
					'label'				=> $activityType['label'],
				);
				$result = civicrm_api('OptionValue', 'getsingle', $params);
				
				if (in_array('is_error', $result)) {
					// retrieve current maximum value -> raise 1
					$new_value = round(self::_getMaxValue($optionGroupId)) + 1;

					// create optionvalue for activity type
					$params = array(
						'version'			=> 3,
						'sequential'		=> 1,
						'option_group_id'	=> $optionGroupId,
						'component_id'		=> $componentId,
						'label'				=> $activityType['label'],
						'name'				=> $activityType['label'],
						'value'				=> $new_value,
						'description'		=> 'nl.pum.generic - ' . $activityType['description'],
						'is_reserved'		=> TRUE,
						'is_active'			=> FALSE,
					);
					$result = civicrm_api('OptionValue', 'create', $params);
					// result could be checked / reported here
				} else {
					// optiongroup exists - no further action
				}
				
				// disable activity types not listed in either required() or tolerate()
				// fetch all activity types listed in database
				$params = array(
					'version' => 3,
					'sequential' => 1,
					'option_group_id' => 2,
					'is_active' => 1,
				);
				$result = civicrm_api('OptionValue', 'get', $params);
				// compare each activity type in database against the list of ones to keep
				foreach ($result['values'] as $activityType) {
					if (in_array($activityType['name'], $tolerate)) {
						// listed: leave 'as is'
					} else {
						// not listed: disable
//						$qryDisable = "UPDATE civicrm_option_value SET is_active=0 WHERE option_group_id=" . $optionGroupId . " AND name='" . $activityType['name'] . "'";
//						CRM_Core_DAO::executeQuery($qryDisable);
					}
				}
			}
		}
	}
	
	/*
	 * handler for hook_civicrm_enable
	 */
	static function enable() {
		$required = self::required();
		
		// retrieve activity_type group id
		$optionGroupId = self::_getActivityTypeGroupId();
		
		if (is_null($optionGroupId)) {
			// optiongroup not found: cannot proceed
			CRM_Utils_System::setUFMessage('Could not find option group "activity_type" - no activity types processed');
		} else {
			// optiongroup found: use it as option_group_id in option values
			foreach ($required as $activityType) {
				// set all existing entries to enabled
				$params = array(
					'version' => 3,
					'sequential' => 1,
					'option_group_id' => $optionGroupId,
					'label' => $activityType['label'],
				);
				$result = civicrm_api('OptionValue', 'get', $params);
				if (array_key_exists('id', $result)) {
					$qryEnable = "UPDATE civicrm_option_value SET is_active=1 WHERE option_group_id=" . $optionGroupId . " AND id=" . $result['id'];
					CRM_Core_DAO::executeQuery($qryEnable);
				} else {
					// id not available: nothing to enable
				}
			}
		}
	}
	
	/*
	 * handler for hook_civicrm_disable
	 */
	static function disable() {
		$required = self::required();
		
		// retrieve activity_type group id
		$optionGroupId = self::_getActivityTypeGroupId();
		
		if (is_null($optionGroupId)) {
			// optiongroup not found: cannot proceed
			CRM_Utils_System::setUFMessage('Could not find option group "activity_type" - no activity types processed');
		} else {
			// optiongroup found: use it as option_group_id in option values
			foreach ($required as $activityType) {
				// set all existing entries to disabled
				$params = array(
					'version' => 3,
					'sequential' => 1,
					'option_group_id' => $optionGroupId,
					'label' => $activityType['label'],
				);
				$result = civicrm_api('OptionValue', 'get', $params);
				if (array_key_exists('id', $result)) {
					$qryDisable = "UPDATE civicrm_option_value SET is_active=0 WHERE option_group_id=" . $optionGroupId . " AND id=" . $result['id'];
					CRM_Core_DAO::executeQuery($qryDisable);
				} else {
					// id not available: nothing to enable
				}
			}
		}
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
		/*
		 * In Civi 4.4.4 we appear to end up with multiple versions of the same managed activity types
		 * after a 2nd and 3rd install of the extension.
		 * Conclusion: rather install, enable, disable and uninstall using API
		 */
		/*
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
		*/
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
	
	private static function _getMaxValue($group_id) {
		$max = NULL;
		try {
			$sql= "SELECT MAX(value * 1) as max FROM civicrm_option_value WHERE option_group_id=" . $group_id;
			$daoResult = CRM_Core_DAO::executeQuery($sql);
			$qryResult = $daoResult -> fetch();
			$max = $daoResult->max;
			return round($max);
		} catch (CiviCRM_API3_Exception $e) {
			return NULL;
		}
	}
	
	private static function _getActivityTypeGroupId() {
		// retrieve activity_type group id
		$params = array(
			'version'		=> 3,
			'sequential'	=> 1,
			'name'			=> 'activity_type',
		);
		$result = civicrm_api('OptionGroup', 'getsingle', $params);
		if (in_array('is_error', $result)) {
			// optiongroup not found: cannot proceed
			CRM_Utils_System::setUFMessage('Could not find option group "activity_type" - no activity types processed');
			return NULL;
		} else {
			// optiongroup found: use id (as option_group_id in option values)
			return $result['id'];
		}
	}
}