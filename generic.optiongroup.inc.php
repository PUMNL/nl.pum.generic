<?php

class Generic_OptionGroup {
	
	/*
	 * returns the definitions for generic option groups
	 */
	static function required() {
		return array(
			array(
				'group_name'	=>	'Advice',
				'values'		=>	array(
					array(
						'label'			=> 'Approve',
						'value'			=> 'Approve',
						'weight'		=> 10,
						'description'	=> '',
					),
					array(
						'label'			=> 'Disapprove',
						'value'			=> 'Disapprove',
						'weight'		=> 20,
						'description'	=> '',
					),
				),
			),
			array(
				'group_name'	=>	'Are there commercial consultants with similar expertise available for this project in your region/country?',
				'values'		=>	array(
					array(
						'label'			=> 'Choose',
						'value'			=> 'Choose',
						'weight'		=> 10,
						'description'	=> '',
					),
					array(
						'label'			=> 'Yes',
						'value'			=> 'Yes',
						'weight'		=> 20,
						'description'	=> '',
					),
					array(
						'label'			=> 'No',
						'value'			=> 'No',
						'weight'		=> 30,
						'description'	=> '',
					),
				),
			),
			array(
				'group_name'	=>	'Do you have financial means available to pay for local commercial consultant?',
				'values'		=>	array(
					array(
						'label'			=> 'Choose',
						'value'			=> 'Choose',
						'weight'		=> 10,
						'description'	=> '',
					),
					array(
						'label'			=> 'Yes',
						'value'			=> 'Yes',
						'weight'		=> 20,
						'description'	=> '',
					),
					array(
						'label'			=> 'No',
						'value'			=> 'No',
						'weight'		=> 30,
						'description'	=> '',
					),
				),
			),
			array(
				'group_name'	=>	'English Language',
				'values'		=>	array(
					array(
						'label'			=> 'Native Speaker',
						'value'			=> 'Native Speaker',
						'weight'		=> 10,
						'description'	=> '',
					),
					array(
						'label'			=> 'Fluent',
						'value'			=> 'Fluent',
						'weight'		=> 20,
						'description'	=> '',
					),
					array(
						'label'			=> 'Basic',
						'value'			=> 'Basic',
						'weight'		=> 30,
						'description'	=> '',
					),
					array(
						'label'			=> 'Poor',
						'value'			=> 'Poor',
						'weight'		=> 40,
						'description'	=> '',
					),
				),
			),
			array(
				'group_name'	=>	'Foreign Ownership',
				'values'		=>	array(
					array(
						'label'		=> 'Yes',
						'value'		=> 'Yes',
						'weight'	=> 10,
						'description'	=> '',
					),
					array(
						'label'		=> 'No',
						'value'		=> 'No',
						'weight'	=> 20,
						'description'	=> '',
					),
				),
			),
			array(
				'group_name'	=>	'Franchising Contract',
				'values'		=>	array(
					array(
						'label'			=> 'Yes',
						'value'			=> 'Yes',
						'weight'		=> 20,
						'description'	=> '',
					),
					array(
						'label'			=> 'No',
						'value'			=> 'No',
						'weight'		=> 30,
						'description'	=> '',
					),
				),
			),
			array(
				'group_name'	=>	'Have you received or will you in the near future receive managerial or technical assistance from other organisations?',
				'values'		=>	array(
					array(
						'label'			=> 'Choose',
						'value'			=> 'Choose',
						'weight'		=> 10,
						'description'	=> '',
					),
					array(
						'label'			=> 'Yes',
						'value'			=> 'Yes',
						'weight'		=> 20,
						'description'	=> '',
					),
					array(
						'label'			=> 'No',
						'value'			=> 'No',
						'weight'		=> 30,
						'description'	=> '',
					),
				),
			),
			array(
				'group_name'	=>	'Is your company part of a holding/group of companies?',
				'values'		=>	array(
					array(
						'label'			=> 'Yes',
						'value'			=> 'Yes',
						'weight'		=> 10,
						'description'	=> '',
					),
					array(
						'label'			=> 'No',
						'value'			=> 'No',
						'weight'		=> 20,
						'description'	=> '',
					),
				),
			),
			array(
				'group_name'	=>	'Legal form of the Organisation',
				'values'		=>	array(
					array(
						'label'			=> 'Individual',
						'value'			=> 'Individual',
						'weight'		=> 10,
						'description'	=> '',
					),
					array(
						'label'			=> 'Cooperation',
						'value'			=> 'Cooperation',
						'weight'		=> 20,
						'description'	=> '',
					),
					array(
						'label'			=> 'Limited Liability Company',
						'value'			=> 'Limited Liability Company',
						'weight'		=> 30,
						'description'	=> '',
					),
					array(
						'label'			=> 'Joint Stock Company',
						'value'			=> 'Joint Stock Company',
						'weight'		=> 40,
						'description'	=> '',
					),
					array(
						'label'			=> 'Other',
						'value'			=> 'Other',
						'weight'		=> 50,
						'description'	=> '',
					),
				),
			),
			array(
				'group_name'	=>	'Marital Status',
				'values'		=>	array(
					array(
						'label'			=> 'Married',
						'value'			=> '1',
						'weight'		=> 10,
						'description'	=> '',
					),
					array(
						'label'			=> 'Single',
						'value'			=> '2',
						'weight'		=> 20,
						'description'	=> '',
					),
					array(
						'label'			=> 'Partner',
						'value'			=> '3',
						'weight'		=> 30,
						'description'	=> '',
					),
					array(
						'label'			=> 'Unknown',
						'value'			=> '4',
						'weight'		=> 40,
						'description'	=> '',
					),
					array(
						'label'			=> 'Widowed',
						'value'			=> '5',
						'weight'		=> 50,
						'description'	=> '',
					),
				),
			),
			array(
				'group_name'	=>	'Nationality',
				'values'		=>	array(
				),
			),
			array(
				'group_name'	=>	'case_type',
				'values'		=>	array(
					array(
						'label'			=> 'Expertapplication',
						'value'			=> 'Expertapplication',
						'weight'		=> 10,
						'description'	=> 'Used to manage the expert application',
					),
					array(
						'label'			=> 'Factfindingmission',
						'value'			=> 'Factfindingmission',
						'weight'		=> 20,
						'description'	=> 'A product used to further define the Projectproposal',
					),
					array(
						'label'			=> 'Organise Event',
						'value'			=> 'Organise Event',
						'weight'		=> 30,
						'description'	=> 'Used in "Organise Event"',
						),
					array(
						'label'			=> 'Projectrequest',
						'value'			=> 'Projectrequest',
						'weight'		=> 40,
						'description'	=> 'Used to assess the project request',
						),
					array(
						'label'			=> 'Projectevaluation',
						'value'			=> 'Projectevaluation',
						'weight'		=> 50,
						'description'	=> 'Uses to assess and evaluate complete project',
						),
					array(
						'label'			=> 'Advice',
						'value'			=> 'Advice',
						'weight'		=> 60,
						'description'	=> 'A product used to execute a project of the type: Advice',
						),
					array(
						'label'			=> 'BLP',
						'value'			=> 'BLP',
						'weight'		=> 70,
						'description'	=> 'A product used to execute a project of the type: Business Link Programme',
						),
					array(
						'label'			=> 'HBF',
						'value'			=> 'HBF',
						'weight'		=> 80,
						'description'	=> 'A product used to execute a project of the type: Hans Blankert Fonds',
						),
				),
			),
			array(
				'group_name'	=>	'case_type_code',
				'values'		=>	array(
					array(
						'label'			=> 'Advice',
						'value'			=> 'A',
						'weight'		=> 10,
						'description'	=> '',
					),
					array(
						'label'			=> 'Business',
						'value'			=> 'B',
						'weight'		=> 20,
						'description'	=> '',
					),
					array(
						'label'			=> 'CTM',
						'value'			=> 'C',
						'weight'		=> 30,
						'description'	=> '',
					),
					array(
						'label'			=> 'Grant',
						'value'			=> 'G',
						'weight'		=> 50,
						'description'	=> '',
					),
					array(
						'label'			=> 'PDV',
						'value'			=> 'P',
						'weight'		=> 60,
						'description'	=> '',
					),
					array(
						'label'			=> 'Acquisitie',
						'value'			=> 'Q',
						'weight'		=> 70,
						'description'	=> '',
					),
					array(
						'label'			=> 'Remote Coaching',
						'value'			=> 'R',
						'weight'		=> 80,
						'description'	=> '',
					),
					array(
						'label'			=> 'Seminar',
						'value'			=> 'S',
						'weight'		=> 90,
						'description'	=> '',
					),
					array(
						'label'			=> 'Housing Support',
						'value'			=> 'H',
						'weight'		=> 199,
						'description'	=> '',
					),
				),
			),
		);
	}
	
	/*
	 * handler for hook_civicrm_install
	 */
	static function install() {
		$created = array();
		$required = self::required();
		
		foreach ($required as $optionGroup) {
			$optionGroupId = NULL;
			
			// verify if group exists
			$params = array(
				'version'		=> 3,
				'sequential'	=> 1,
				'title'			=> $optionGroup['group_name'],
			);
			$result = civicrm_api('OptionGroup', 'getsingle', $params);

			if (isset($result['id'])) {
				// optiongroup found: use id
				$optionGroupId = $result['id'];
			} else {
				// optiongroup not found: $optionGroupId remains NULL
			}
		
			// if group was not found: create it
			if (is_null($optionGroupId)) {
				$params = array(
					'version'		=> 3,
					'sequential'	=> 1,
					'name'			=> substr($optionGroup['group_name'],  0, 63),
					'title'			=> $optionGroup['group_name'],
					'is_active'		=> 1,
					'description'	=> 'nl.pum.generic',
				);
				$result = civicrm_api('OptionGroup', 'create', $params);
				
				if($result['is_error'] == 1) {
					// group not created: $optionGroupId remains NULL
					CRM_Utils_System::setUFMessage('Error creating Option Group "' . $optionGroup['group_name'] . '": ' . $result['error_message']);
				} else {
					// group created: retrieve $customGroupId
					$value = array_pop($result['values']);
					$optionGroupId = $value['id'];
					$created[] = $optionGroup['group_name'];
				}
			}
			
			// create optionvalues (if option group exists)
			if (is_null($optionGroupId)) {
				// message was raised earlier, when group was not created - no further action here
			} else {
				foreach ($optionGroup['values'] as $optionValue) {
					// verify if optionvalue exists
					$params = array(
						'version'			=> 3,
						'sequential'		=> 1,
						'option_group_id'	=> $optionGroupId,
						'label'				=> $optionValue['label'],
					);
					$result = civicrm_api('OptionValue', 'getsingle', $params);
					
					if (in_array('is_error', $result)) {
						// create optionvalue
						$params = array(
							'version'			=> 3,
							'sequential'		=> 1,
							'option_group_id'	=> $optionGroupId,
							'label'				=> $optionValue['label'],
							'name'				=> $optionValue['value'],
							'description'		=> $optionValue['description'],
							'is_reserved'		=> TRUE,
							'is_active'			=> TRUE,
						);
						$result = civicrm_api('OptionValue', 'create', $params);
						// result could be checked / reported here
					} else {
						// optiongroup exists - no further action
					}
				}
			}
			
		} // next $optionGroup
		
		$message = "Option group ".implode(", ", $created)." succesfully created";
		CRM_Utils_System::setUFMessage($message);
	}
	
	/*
	 * handler for hook_civicrm_enable
	 */
	static function enable() {
		$required = self::required();
		// set all contact types to enabled
		foreach ($required as $optionGroup) {
			$params = array(
				'version' => 3,
				'sequential' => 1,
				'title' => $optionGroup['group_name'],
				);
			$result = civicrm_api('OptionGroup', 'getsingle', $params);
			if (in_array('is_error', $result)) {
				// optiongroup not found: cannot enable
			} else {
				// optiongroup found: proceed
				$qryEnable = "UPDATE civicrm_option_group SET is_active = 1 WHERE title = '" . $optionGroup['group_name'] . "'";
				CRM_Core_DAO::executeQuery($qryEnable);
			}
		}
	}
	
	/*
	 * handler for hook_civicrm_disable
	 */
	static function disable() {
		$required = self::required();
		// set all contact types to enabled
		foreach ($required as $optionGroup) {
			$params = array(
				'version' => 3,
				'sequential' => 1,
				'title' => $optionGroup['group_name'],
				);
			$result = civicrm_api('OptionGroup', 'getsingle', $params);
			if (in_array('is_error', $result)) {
				// optiongroup not found: cannot disable
			} else {
				// optiongroup found: proceed
				$qryDisable = "UPDATE civicrm_option_group SET is_active = 0 WHERE title = '" . $optionGroup['group_name'] . "'";
				CRM_Core_DAO::executeQuery($qryDisable);
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
	}
	
}