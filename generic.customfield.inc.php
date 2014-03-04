<?php

/*
 * Based on source: https://civicrm.org/blogs/jamie/creating-custom-groups-and-custom-fields-programmatically-your-drupal-module
 */
class Generic_CustomField {
	
	const DT_FORMAT_YMD	= 'yy-mm-dd';
	
	/*
	 * returns the definitions for generic custom fieldsgroups and custom fields
	 */
	static function required() {
		return array(
			array(
				'group_name'			=>	'Additional Data',
				'extends'				=>	array('Individual'),
				'entities'				=>	array(NULL),
				'style'					=>	'Inline',
				'is_multiple'			=>	FALSE,
				'help_pre'				=>	'Additional data required by PUM',
				'help_post'				=>	'',
				'collapse_display'		=>	0,
				'collapse_adv_display'	=>	1,
				'fieldset'				=>	array(
					array(
						'label'=>'Facebook Address',
						'data_type'=>'String',
						'html_type'=>'Text',
						'text_length'=>255,
						'start_date_years'=>NULL,
						'end_date_years'=>NULL,
						'date_format'=>NULL,
						'option_group_title'=>NULL,
						'weight'=>10,
					),
					array(
						'label'=>'Prins Unique ID',
						'data_type'=>'String',
						'html_type'=>'Text',
						'text_length'=>25,
						'start_date_years'=>NULL,
						'end_date_years'=>NULL,
						'date_format'=>NULL,
						'option_group_title'=>NULL,
						'weight'=>20,
					),
					array(
						'label'=>'Passport Name',
						'data_type'=>'String',
						'html_type'=>'Text',
						'text_length'=>128,
						'start_date_years'=>NULL,
						'end_date_years'=>NULL,
						'date_format'=>NULL,
						'option_group_title'=>NULL,
						'weight'=>30,
					),
					array(
						'label'=>'Initials',
						'data_type'=>'String',
						'html_type'=>'Text',
						'text_length'=>25,
						'start_date_years'=>NULL,
						'end_date_years'=>NULL,
						'date_format'=>NULL,
						'option_group_title'=>NULL,
						'weight'=>40,
					),
					array(
						'label'=>'Nationality',
						'data_type'=>'String',
						'html_type'=>'Select',
						'text_length'=>255,
						'start_date_years'=>NULL,
						'end_date_years'=>NULL,
						'date_format'=>NULL,
						'option_group_title'=>'Nationality',
						'weight'=>50,
					),
					array(
						'label'=>'City of Birth',
						'data_type'=>'String',
						'html_type'=>'Text',
						'text_length'=>128,
						'start_date_years'=>NULL,
						'end_date_years'=>NULL,
						'date_format'=>NULL,
						'option_group_title'=>NULL,
						'weight'=>60,
					),
					array(
						'label'=>'Country of Birth',
						'data_type'=>'Country',
						'html_type'=>'Select Country',
						'text_length'=>255,
						'start_date_years'=>NULL,
						'end_date_years'=>NULL,
						'date_format'=>NULL,
						'option_group_title'=>NULL,
						'weight'=>70,
					),
					array(
						'label'=>'Marital Status',
						'data_type'=>'String',
						'html_type'=>'Select',
						'text_length'=>255,
						'start_date_years'=>NULL,
						'end_date_years'=>NULL,
						'date_format'=>NULL,
						'option_group_title'=>'Marital Status',
						'weight'=>80,
					),
					array(
						'label'=>'Registration Date',
						'data_type'=>'Date',
						'html_type'=>'Select Date',
						'text_length'=>255,
						'start_date_years'=>10,
						'end_date_years'=>3,
						'date_format'=>self::DT_FORMAT_YMD,
						'option_group_title'=>NULL,
						'weight'=>90,
					),
					array(
						'label'=>'CV',
						'data_type'=>'File',
						'html_type'=>'File',
						'text_length'=>255,
						'start_date_years'=>NULL,
						'end_date_years'=>NULL,
						'date_format'=>NULL,
						'option_group_title'=>NULL,
						'weight'=>100,
					),
					array(
						'label'=>'Skype Name',
						'data_type'=>'String',
						'html_type'=>'Text',
						'text_length'=>255,
						'start_date_years'=>NULL,
						'end_date_years'=>NULL,
						'date_format'=>NULL,
						'option_group_title'=>NULL,
						'weight'=>110,
					),
				),
			),
			array(
				'group_name'			=>	'Assess expert activity',
				'extends'				=>	array('Activity'),
				'entities'				=>	array('Assess Expert Application', 'Interview'),
				'style'					=>	'Inline',
				'is_multiple'			=>	FALSE,
				'help_pre'				=>	'',
				'help_post'				=>	'',
				'collapse_display'		=>	0,
				'collapse_adv_display'	=>	1,
				'fieldset'				=>	array(
					array(
						'label'=>'Approve expert?',
						'data_type'=>'Boolean',
						'html_type'=>'Radio',
						'text_length'=>255,
						'start_date_years'=>NULL,
						'end_date_years'=>NULL,
						'date_format'=>NULL,
						'option_group_title'=>NULL,
						'weight'=>10,
					),
					array(
						'label'=>'Motivation',
						'data_type'=>'Memo',
						'html_type'=>'TextArea',
						'text_length'=>255,
						'start_date_years'=>NULL,
						'end_date_years'=>NULL,
						'date_format'=>NULL,
						'option_group_title'=>NULL,
						'weight'=>20,
					),
				),
			),
			array(
				'group_name'			=>	'Customers Data',
				'extends'				=>	array('Organization'),
				'entities'				=>	array('Customer'),
				'style'					=>	'Tab',
				'is_multiple'			=>	FALSE,
				'help_pre'				=>	'Used for Webform: New Customer.',
				'help_post'				=>	'',
				'collapse_display'		=>	1,
				'collapse_adv_display'	=>	0,
				'fieldset'				=>	array(
					array(
						'label'=>'Foreign Ownership',
						'data_type'=>'String',
						'html_type'=>'CheckBox',
						'text_length'=>255,
						'start_date_years'=>NULL,
						'end_date_years'=>NULL,
						'date_format'=>NULL,
						'option_group_title'=>'Foreign Ownership',
						'weight'=>10,
					),
					array(
						'label'=>'Franchising Contract',
						'data_type'=>'String',
						'html_type'=>'Select',
						'text_length'=>255,
						'start_date_years'=>NULL,
						'end_date_years'=>NULL,
						'date_format'=>NULL,
						'option_group_title'=>'Franchising Contract',
						'weight'=>20,
					),
					array(
						'label'=>'Holding Name',
						'data_type'=>'String',
						'html_type'=>'Text',
						'text_length'=>255,
						'start_date_years'=>NULL,
						'end_date_years'=>NULL,
						'date_format'=>NULL,
						'option_group_title'=>NULL,
						'weight'=>30,
					),
					array(
						'label'=>'In which year was the organisation founded?',
						'data_type'=>'Date',
						'html_type'=>'Select Date',
						'text_length'=>255,
						'start_date_years'=>NULL,
						'end_date_years'=>NULL,
						'date_format'=>self::DT_FORMAT_YMD,
						'option_group_title'=>NULL,
						'weight'=>30,
					),
					array(
						'label'=>'Is your company part of a holding/group of companies?',
						'data_type'=>'String',
						'html_type'=>'Select',
						'text_length'=>255,
						'start_date_years'=>NULL,
						'end_date_years'=>NULL,
						'date_format'=>NULL,
						'option_group_title'=>'Is your company part of a holding/group of companies?',
						'weight'=>40,
					),
					array(
						'label'=>'Legal form of the Organisation',
						'data_type'=>'String',
						'html_type'=>'Select',
						'text_length'=>255,
						'start_date_years'=>NULL,
						'end_date_years'=>NULL,
						'date_format'=>NULL,
						'option_group_title'=>'Legal form of the Organisation',
						'weight'=>50,
					),
					array(
						'label'=>'Location of the holding',
						'data_type'=>'String',
						'html_type'=>'Text',
						'text_length'=>255,
						'start_date_years'=>NULL,
						'end_date_years'=>NULL,
						'date_format'=>NULL,
						'option_group_title'=>NULL,
						'weight'=>60,
					),
					array(
						'label'=>'Number of Employees',
						'data_type'=>'Float',
						'html_type'=>'Text',
						'text_length'=>255,
						'start_date_years'=>NULL,
						'end_date_years'=>NULL,
						'date_format'=>NULL,
						'option_group_title'=>NULL,
						'weight'=>70,
					),
					array(
						'label'=>'Percentage of Foreign Ownership',
						'data_type'=>'Float',
						'html_type'=>'Text',
						'text_length'=>255,
						'start_date_years'=>NULL,
						'end_date_years'=>NULL,
						'date_format'=>NULL,
						'option_group_title'=>NULL,
						'weight'=>80,
					),
					array(
						'label'=>'Percentage of Ownership - Government',
						'data_type'=>'Float',
						'html_type'=>'Text',
						'text_length'=>255,
						'start_date_years'=>NULL,
						'end_date_years'=>NULL,
						'date_format'=>NULL,
						'option_group_title'=>NULL,
						'weight'=>90,
					),
					array(
						'label'=>'Percentage of Ownership - Other',
						'data_type'=>'Float',
						'html_type'=>'Text',
						'text_length'=>255,
						'start_date_years'=>NULL,
						'end_date_years'=>NULL,
						'date_format'=>NULL,
						'option_group_title'=>NULL,
						'weight'=>100,
					),
					array(
						'label'=>'Percentage of Ownership - Private',
						'data_type'=>'Float',
						'html_type'=>'Text',
						'text_length'=>255,
						'start_date_years'=>NULL,
						'end_date_years'=>NULL,
						'date_format'=>NULL,
						'option_group_title'=>NULL,
						'weight'=>110,
					),
					array(
						'label'=>'Please state annual turnover of the last two years (in Euro\'s)',
						'data_type'=>'Money',
						'html_type'=>'Text',
						'text_length'=>255,
						'start_date_years'=>NULL,
						'end_date_years'=>NULL,
						'date_format'=>NULL,
						'option_group_title'=>NULL,
						'weight'=>120,
					),
					array(
						'label'=>'Please state balance sheet total of the last two years (in Euro\'s)',
						'data_type'=>'Money',
						'html_type'=>'Text',
						'text_length'=>255,
						'start_date_years'=>NULL,
						'end_date_years'=>NULL,
						'date_format'=>NULL,
						'option_group_title'=>NULL,
						'weight'=>130,
					),
					array(
						'label'=>'Please state last known balance sheet total (in Euro\'s)',
						'data_type'=>'Money',
						'html_type'=>'Text',
						'text_length'=>255,
						'start_date_years'=>NULL,
						'end_date_years'=>NULL,
						'date_format'=>NULL,
						'option_group_title'=>NULL,
						'weight'=>140,
					),
					array(
						'label'=>'Products and/or Services offered',
						'data_type'=>'String',
						'html_type'=>'Text',
						'text_length'=>255,
						'start_date_years'=>NULL,
						'end_date_years'=>NULL,
						'date_format'=>NULL,
						'option_group_title'=>NULL,
						'weight'=>150,
					),
					array(
						'label'=>'Relationship to Franchiseholder',
						'data_type'=>'String',
						'html_type'=>'Text',
						'text_length'=>255,
						'start_date_years'=>NULL,
						'end_date_years'=>NULL,
						'date_format'=>NULL,
						'option_group_title'=>NULL,
						'weight'=>160,
					),
					array(
						'label'=>'Website address of the holding',
						'data_type'=>'String',
						'html_type'=>'Text',
						'text_length'=>255,
						'start_date_years'=>NULL,
						'end_date_years'=>NULL,
						'date_format'=>NULL,
						'option_group_title'=>NULL,
						'weight'=>170,
					),
					array(
						'label'=>'Where and how are the products of services sold',
						'data_type'=>'String',
						'html_type'=>'Text',
						'text_length'=>255,
						'start_date_years'=>NULL,
						'end_date_years'=>NULL,
						'date_format'=>NULL,
						'option_group_title'=>NULL,
						'weight'=>180,
					),
				),
			),
			array(
				'group_name'			=>	'Interview Information',
				'extends'				=>	array('Case'),
				'entities'				=>	array('Expertapplication'),
				'style'					=>	'Inline',
				'is_multiple'			=>	FALSE,
				'help_pre'				=>	'Used to add Interview Date. Has to be searchable.',
				'help_post'				=>	'',
				'collapse_display'		=>	0,
				'collapse_adv_display'	=>	0,
				'fieldset'				=>	array(
					array(
						'label'=>'Interview Date',
						'data_type'=>'Date',
						'html_type'=>'Select Date',
						'text_length'=>255,
						'start_date_years'=>NULL,
						'end_date_years'=>NULL,
						'date_format'=>self::DT_FORMAT_YMD,
						'option_group_title'=>NULL,
						'weight'=>10,
					),
				),
			),
			array(
				'group_name'			=>	'Key Qualifications',
				'extends'				=>	array('Case'),
				'entities'				=>	array('Factfindingmission'),
				'style'					=>	'Inline',
				'is_multiple'			=>	FALSE,
				'help_pre'				=>	'Used in "Factfinding Mission"; for Key qualifactions of PUM-expert.',
				'help_post'				=>	'',
				'collapse_display'		=>	1,
				'collapse_adv_display'	=>	0,
				'fieldset'				=>	array(
					array(
						'label'=>'Motivation to do this specific project',
						'data_type'=>'String',
						'html_type'=>'Text',
						'text_length'=>255,
						'start_date_years'=>NULL,
						'end_date_years'=>NULL,
						'date_format'=>NULL,
						'option_group_title'=>NULL,
						'weight'=>10,
					),
				),
			),
			array(
				'group_name'			=>	'Projectinformation',
				'extends'				=>	array('Case'),
				'entities'				=>	array('Factfindingmission, Projectrequest'),
				'style'					=>	'Inline',
				'is_multiple'			=>	FALSE,
				'help_pre'				=>	'Projectinformation.',
				'help_post'				=>	'',
				'collapse_display'		=>	1,
				'collapse_adv_display'	=>	0,
				'fieldset'				=>	array(
					array(
						'label'=>'What is the reason for this request for Assistance?',
						'data_type'=>'String',
						'html_type'=>'Text',
						'text_length'=>255,
						'start_date_years'=>NULL,
						'end_date_years'=>NULL,
						'date_format'=>NULL,
						'option_group_title'=>NULL,
						'weight'=>10,
					),
					array(
						'label'=>'Which project activities do you expect the expert to perform?',
						'data_type'=>'String',
						'html_type'=>'Text',
						'text_length'=>255,
						'start_date_years'=>NULL,
						'end_date_years'=>NULL,
						'date_format'=>NULL,
						'option_group_title'=>NULL,
						'weight'=>20,
					),
					array(
						'label'=>'What are the expected results of the project?',
						'data_type'=>'String',
						'html_type'=>'Text',
						'text_length'=>255,
						'start_date_years'=>NULL,
						'end_date_years'=>NULL,
						'date_format'=>NULL,
						'option_group_title'=>NULL,
						'weight'=>30,
					),
					array(
						'label'=>'Have you received or will you in the near future receive managerial or technical assistance from other organisations?',
						'data_type'=>'String',
						'html_type'=>'Select',
						'text_length'=>255,
						'start_date_years'=>NULL,
						'end_date_years'=>NULL,
						'date_format'=>NULL,
						'option_group_title'=>'Have you received or will you in the near future receive managerial or technical assistance from other organisations?',
						'weight'=>40,
					),
					array(
						'label'=>'Specify Name, Activities and Periods',
						'data_type'=>'String',
						'html_type'=>'Text',
						'text_length'=>255,
						'start_date_years'=>NULL,
						'end_date_years'=>NULL,
						'date_format'=>NULL,
						'option_group_title'=>NULL,
						'weight'=>50,
					),
					array(
						'label'=>'Explain why the other organisations cannot assist you with the request',
						'data_type'=>'String',
						'html_type'=>'Text',
						'text_length'=>255,
						'start_date_years'=>NULL,
						'end_date_years'=>NULL,
						'date_format'=>NULL,
						'option_group_title'=>NULL,
						'weight'=>60,
					),
					array(
						'label'=>'Are there commercial consultants with similar expertise available for this project in your region/country?',
						'data_type'=>'String',
						'html_type'=>'Select',
						'text_length'=>255,
						'start_date_years'=>NULL,
						'end_date_years'=>NULL,
						'date_format'=>NULL,
						'option_group_title'=>'Are there commercial consultants with similar expertise available for this project in your region/country?',
						'weight'=>70,
					),
					array(
						'label'=>'Do you have financial means available to pay for local commercial consultant?',
						'data_type'=>'String',
						'html_type'=>'Select',
						'text_length'=>255,
						'start_date_years'=>NULL,
						'end_date_years'=>NULL,
						'date_format'=>NULL,
						'option_group_title'=>'Do you have financial means available to pay for local commercial consultant?',
						'weight'=>80,
					),
					array(
						'label'=>'Additional Comments on Project Proposal',
						'data_type'=>'String',
						'html_type'=>'Text',
						'text_length'=>255,
						'start_date_years'=>NULL,
						'end_date_years'=>NULL,
						'date_format'=>NULL,
						'option_group_title'=>NULL,
						'weight'=>90,
					),
					array(
						'label'=>'Upload documents that support Projectproposal',
						'data_type'=>'File',
						'html_type'=>'File',
						'text_length'=>255,
						'start_date_years'=>NULL,
						'end_date_years'=>NULL,
						'date_format'=>NULL,
						'option_group_title'=>NULL,
						'weight'=>100,
					),
				),
			),
			array(
				'group_name'			=>	'Projectinformation / REP Assessment',
				'extends'				=>	array('Case'),
				'entities'				=>	array('Projectrequest'),
				'style'					=>	'Inline',
				'is_multiple'			=>	FALSE,
				'help_pre'				=>	'',
				'help_post'				=>	'',
				'collapse_display'		=>	1,
				'collapse_adv_display'	=>	0,
				'fieldset'				=>	array(
					array(
						'label'=>'Please provide any additional information you have about the company and/or the project request details (problem definition)*',
						'data_type'=>'String',
						'html_type'=>'Text',
						'text_length'=>255,
						'start_date_years'=>NULL,
						'end_date_years'=>NULL,
						'date_format'=>NULL,
						'option_group_title'=>NULL,
						'weight'=>10,
					),
					array(
						'label'=>'Advice',
						'data_type'=>'String',
						'html_type'=>'Select',
						'text_length'=>255,
						'start_date_years'=>NULL,
						'end_date_years'=>NULL,
						'date_format'=>NULL,
						'option_group_title'=>'Advice',
						'weight'=>20,
					),
					array(
						'label'=>'Motivate advice',
						'data_type'=>'String',
						'html_type'=>'Text',
						'text_length'=>255,
						'start_date_years'=>NULL,
						'end_date_years'=>NULL,
						'date_format'=>NULL,
						'option_group_title'=>NULL,
						'weight'=>30,
					),
					array(
						'label'=>'Attachments/translation',
						'data_type'=>'String',
						'html_type'=>'Text',
						'text_length'=>255,
						'start_date_years'=>NULL,
						'end_date_years'=>NULL,
						'date_format'=>NULL,
						'option_group_title'=>NULL,
						'weight'=>40,
					),
				),
			),
			array(
				'group_name'			=>	'PUM Expert CV',
				'extends'				=>	array('Individual'),
				'entities'				=>	array(NULL),
				'style'					=>	'Tab',
				'is_multiple'			=>	FALSE,
				'help_pre'				=>	'All CV and personal information',
				'help_post'				=>	'',
				'collapse_display'		=>	1,
				'collapse_adv_display'	=>	0,
				'fieldset'				=>	array(
					array(
						'label'=>'Image',
						'data_type'=>'File',
						'html_type'=>'File',
						'text_length'=>255,
						'start_date_years'=>NULL,
						'end_date_years'=>NULL,
						'date_format'=>NULL,
						'option_group_title'=>NULL,
						'weight'=>10,
					),
					array(
						'label'=>'CV from Expert',
						'data_type'=>'File',
						'html_type'=>'File',
						'text_length'=>255,
						'start_date_years'=>NULL,
						'end_date_years'=>NULL,
						'date_format'=>NULL,
						'option_group_title'=>NULL,
						'weight'=>20,
					),
					array(
						'label'=>'Motivation to become an Expert',
						'data_type'=>'String',
						'html_type'=>'Text',
						'text_length'=>255,
						'start_date_years'=>NULL,
						'end_date_years'=>NULL,
						'date_format'=>NULL,
						'option_group_title'=>NULL,
						'weight'=>30,
					),
					array(
						'label'=>'English Language',
						'data_type'=>'String',
						'html_type'=>'Select',
						'text_length'=>255,
						'start_date_years'=>NULL,
						'end_date_years'=>NULL,
						'date_format'=>NULL,
						'option_group_title'=>'English Language',
						'weight'=>40,
					),
				),
			),
			array(
				'group_name'			=>	'REP Assessment',
				'extends'				=>	array('Activity'),
				'entities'				=>	array('Rep assess Projectrequest'),
				'style'					=>	'Inline',
				'is_multiple'			=>	FALSE,
				'help_pre'				=>	'',
				'help_post'				=>	'',
				'collapse_display'		=>	1,
				'collapse_adv_display'	=>	0,
				'fieldset'				=>	array(
					array(
						'label'=>'Was this your contact person within the company?',
						'data_type'=>'String',
						'html_type'=>'Text',
						'text_length'=>255,
						'start_date_years'=>NULL,
						'end_date_years'=>NULL,
						'date_format'=>NULL,
						'option_group_title'=>NULL,
						'weight'=>10,
					),
					array(
						'label'=>'Name of the Contact person, Initial(s), Infix, Surname,',
						'data_type'=>'String',
						'html_type'=>'Text',
						'text_length'=>255,
						'start_date_years'=>NULL,
						'end_date_years'=>NULL,
						'date_format'=>NULL,
						'option_group_title'=>NULL,
						'weight'=>20,
					),
					array(
						'label'=>'Position',
						'data_type'=>'String',
						'html_type'=>'Text',
						'text_length'=>255,
						'start_date_years'=>NULL,
						'end_date_years'=>NULL,
						'date_format'=>NULL,
						'option_group_title'=>NULL,
						'weight'=>30,
					),
					array(
						'label'=>'Are the suggested project dates fixed or can the project be scheduled flexibly?',
						'data_type'=>'String',
						'html_type'=>'Text',
						'text_length'=>255,
						'start_date_years'=>NULL,
						'end_date_years'=>NULL,
						'date_format'=>NULL,
						'option_group_title'=>NULL,
						'weight'=>40,
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
		
		foreach ($required as $fieldGroup) {
			$customGroupId = NULL;
			
			// verify if group exists
			$params = array(
				'version'		=> 3,
				'sequential'	=> 1,
				'title'			=> $fieldGroup['group_name'],
			);
			$result = civicrm_api('CustomGroup', 'getsingle', $params);
			if (in_array('is_error', $result)) {
				// group not found: $customGroupId remains NULL
			} else {
				// group found: use id
				$customGroupId = $result['id'];
			}
			
			// if group was not found: create it
			if (is_null($customGroupId)) {
				// create group (what does parameter 'extends_entity_column_id' do?)
				if (empty($fieldGroup['entities'])) {
					$extends_column_value = NULL;
				} else {
					$extends_column_value = CRM_Core_DAO::VALUE_SEPARATOR . implode(CRM_Core_DAO::VALUE_SEPARATOR, $fieldGroup['entities']) . CRM_Core_DAO::VALUE_SEPARATOR;
				}
				
				$params = array(
					'version'						=>	3,
					'extends'						=>	$fieldGroup['extends'],
					'extends_entity_column_value'	=>	$extends_column_value,
					'title'							=>	$fieldGroup['group_name'],
					'style'							=>	$fieldGroup['style'],
					'is_multiple'					=>	$fieldGroup['is_multiple'],
					'help_pre'						=>	$fieldGroup['help_pre'],
					'help_post'						=>	$fieldGroup['help_post'],
					'is_active'						=>	1,
				);
				$result = civicrm_api('CustomGroup', 'Create', $params);
				
				if($result['is_error'] == 1) {
					// group not created: $customGroupId remains NULL
					CRM_Utils_System::setUFMessage('Error creating Custom Group "' . $fieldGroup['group_name'] . '": ' . $result['error_message']);
				} else {
					// group created: retrieve $customGroupId
					$value = array_pop($result['values']);
					$customGroupId = $value['id'];
					$created[] = $fieldGroup['group_name'];
				}
			}
			
			// if group is present: process field definitions
			if (!is_null($customGroupId)) {
				// field group is present: process fields within group
				foreach ($fieldGroup['fieldset'] as $field) {
					// if option_group_name is provided, the field depends on an options list: retrieve its option_group_id
					if ($field['option_group_title'] != '') {
						$params = array(
							'version' => 3,
							'q' => 'civicrm/ajax/rest',
							'sequential' => 1,
							'title' => $field['option_group_title'],
						);
						$result = civicrm_api('OptionGroup', 'getsingle', $params);
						
						if (in_array('is_error', $result)) {
							// option group name provided, but none found
							$optionGroupId = -1;
						} else {
							// option group name provided and found: use id
							$optionGroupId = $result['id'];
						}
					} else {
						// no option group name provided
						$optionGroupId = NULL;
					}
					
					// proceed when option group was found, or when field does not depend on an option group
					if ($optionGroupId === -1) {
						CRM_Utils_System::setUFMessage('Error creating Custom Field "' . $field['label'] . '": could not find Option Group "' . $field['option_group_title'] . '"');
					} else {
						// generate field if it doesn't exist yet
						$params = array(
							'version' => 3,
							'sequential' => 1,
							'custom_group_id' => $customGroupId,
							'label' => $field['label'],
						);
						$result = civicrm_api('CustomField', 'getsingle', $params);
						if (in_array('is_error', $result)) {
							// custom field not found: create it
							$params = array(
								'version'				=>	3,
								'custom_group_id'		=>	$customGroupId,
								'label'					=>	$field['label'],
								'data_type'				=>	$field['data_type'],
								'html_type'				=>	$field['html_type'],
								'text_length'			=>	$field['text_length'],
								'start_date_years'		=>	$field['start_date_years'],
								'end_date_years'		=>	$field['end_date_years'],
								'date_format'			=>	$field['date_format'],
								'option_group_id'		=>	$optionGroupId,
								'is_active'				=>	1,
							);
							$result = civicrm_api('CustomField', 'Create', $params);
							if($result['is_error'] == 1) {
								drupal_set_message('Error creating Custom Field "' . $field['label'] . '" in group "' . $fieldGroup['group_name'] . '": ' . $result['error_message']);
							} else {
								// report success?
							}
						} else {
							// custom field alredy exist
							CRM_Utils_System::setUFMessage('Error creating Custom Field "' . $field['label'] . '" in Custom Group "' . $fieldGroup['group_name'] . '": field already exists.');
						}
					
					}

				} // next custom field
			}
			
		} // next custom field group
		
		$message = "Custom field group ".implode(", ", $created)." succesfully created";
		CRM_Utils_System::setUFMessage($message);
		
	}
	
	/*
	 * handler for hook_civicrm_enable
	 */
	static function enable() {
		$required = self::required();
		// set all contact types to enabled
		foreach ($required as $fieldGroup) {
			$params = array(
				'version' => 3,
				'sequential' => 1,
				'title' => $fieldGroup['group_name'],
				);
			$result = civicrm_api('CustomGroup', 'getsingle', $params);
			if (in_array('is_error', $result)) {
				// group not found: cannot enable
			} else {
				// group found: proceed
				$qryEnable = "UPDATE civicrm_custom_group SET is_active = 1 WHERE title = '" . $fieldGroup['group_name'] . "'";
				CRM_Core_DAO::executeQuery($qryEnable);
			}
		}
	}
	
	/*
	 * handler for hook_civicrm_disable
	 */
	static function disable() {
		$required = self::required();
		// set all contact types to disabled
		foreach ($required as $fieldGroup) {
			$params = array(
				'version' => 3,
				'sequential' => 1,
				'title' => $fieldGroup['group_name'],
				);
			$result = civicrm_api('CustomGroup', 'getsingle', $params);
			if (in_array('is_error', $result)) {
				// group not found: cannot disable
			} else {
				// group found: proceed
				$qryDisable = "UPDATE civicrm_custom_group SET is_active = 0 WHERE title = '" . $fieldGroup['group_name'] . "'";
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