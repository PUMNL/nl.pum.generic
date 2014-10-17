<?php

class Generic_OptionGroup_Def {

	// definitions for: Option Group

	static function required() {
		return array(
			array(
				'group_name' => 'case_type',
				'group_title' => 'Case Type',
				'values' => array(
					array(
						'name' => 'housing_support',
						'label' => 'Housing Support',
						'value' => '1',
						'weight' => 10,
						'description' => '<p>Help homeless individuals obtain temporary and long-term housing</p>',
					),
					array(
						'name' => 'adult_day_care_referral',
						'label' => 'Adult Day Care Referral',
						'value' => '2',
						'weight' => 20,
						'description' => '<p>Arranging adult day care for senior individuals</p>',
					),
					array(
						'name' => 'Expertapplication',
						'label' => 'Expertapplication',
						'value' => '3',
						'weight' => 30,
						'description' => '<p>This case is used to document activities related to the application of an (Candidate) Expert</p>',
					),
					array(
						'name' => 'Projectintake',
						'label' => 'Projectintake',
						'value' => '4',
						'weight' => 40,
						'description' => '',
					),
				),
			),
			array(
				'group_name' => 'case_status',
				'group_title' => 'Case Status',
				'values' => array(
					array(
						'name' => 'Open',
						'label' => 'Ongoing',
						'value' => '1',
						'weight' => 10,
						'description' => '',
					),
					array(
						'name' => 'Interview',
						'label' => 'Interview',
						'value' => '10',
						'weight' => 20,
						'description' => '',
					),
					array(
						'name' => 'Fill Out PUM CV',
						'label' => 'Fill Out PUM CV',
						'value' => '11',
						'weight' => 30,
						'description' => '',
					),
					array(
						'name' => 'Final Check Application',
						'label' => 'Final Check Application',
						'value' => '12',
						'weight' => 40,
						'description' => '',
					),
					array(
						'name' => 'Accepted',
						'label' => 'Accepted',
						'value' => '13',
						'weight' => 50,
						'description' => '',
					),
					array(
						'name' => 'Rejected',
						'label' => 'Rejected',
						'value' => '14',
						'weight' => 60,
						'description' => '',
					),
					array(
						'name' => 'Completed',
						'label' => 'Completed',
						'value' => '15',
						'weight' => 70,
						'description' => '',
					),
					array(
						'name' => 'Closed',
						'label' => 'Resolved',
						'value' => '2',
						'weight' => 80,
						'description' => '',
					),
					array(
						'name' => 'Submitted',
						'label' => 'Submitted',
						'value' => '3',
						'weight' => 90,
						'description' => '',
					),
					array(
						'name' => 'Declined',
						'label' => 'Declined',
						'value' => '4',
						'weight' => 100,
						'description' => '',
					),
					array(
						'name' => 'Intake',
						'label' => 'Intake',
						'value' => '5',
						'weight' => 110,
						'description' => '',
					),
					array(
						'name' => 'Matching',
						'label' => 'Matching',
						'value' => '6',
						'weight' => 120,
						'description' => '',
					),
					array(
						'name' => 'Preperation',
						'label' => 'Preperation',
						'value' => '7',
						'weight' => 130,
						'description' => '',
					),
					array(
						'name' => 'Debriefing',
						'label' => 'Debriefing',
						'value' => '8',
						'weight' => 140,
						'description' => '',
					),
					array(
						'name' => 'Asses Expert Application',
						'label' => 'Asses Expert Application',
						'value' => '9',
						'weight' => 150,
						'description' => '',
					),
				),
			),
			array(
				'group_name' => 'case_type_code',
				'group_title' => 'case_type_code',
				'values' => array(
					array(
						'name' => 'Advice',
						'label' => 'Advice',
						'value' => 'A',
						'weight' => 10,
						'description' => '',
					),
					array(
						'name' => 'Business',
						'label' => 'Business',
						'value' => 'B',
						'weight' => 20,
						'description' => '',
					),
					array(
						'name' => 'CTM',
						'label' => 'CTM',
						'value' => 'C',
						'weight' => 30,
						'description' => '',
					),
					array(
						'name' => 'Grant',
						'label' => 'Grant',
						'value' => 'G',
						'weight' => 40,
						'description' => '',
					),
					array(
						'name' => 'PDV',
						'label' => 'PDV',
						'value' => 'P',
						'weight' => 50,
						'description' => '',
					),
					array(
						'name' => 'Acquisitie',
						'label' => 'Acquisitie',
						'value' => 'Q',
						'weight' => 60,
						'description' => '',
					),
					array(
						'name' => 'Remote Coaching',
						'label' => 'Remote Coaching',
						'value' => 'R',
						'weight' => 70,
						'description' => '',
					),
					array(
						'name' => 'Seminar',
						'label' => 'Seminar',
						'value' => 'S',
						'weight' => 80,
						'description' => '',
					),
					array(
						'name' => 'Housing Support',
						'label' => 'Housing Support',
						'value' => 'H',
						'weight' => 90,
						'description' => '',
					),
				),
			),
			array(
				'group_name' => 'Marital Status',
				'group_title' => 'Marital Status',
				'values' => array(
				),
			),
			array(
				'group_name' => 'Legal form of the Organisation',
				'group_title' => 'Legal form of the Organisation',
				'values' => array(
					array(
						'name' => 'Associations',
						'label' => 'Associations',
						'value' => 'Associations',
						'weight' => 10,
						'description' => '',
					),
					array(
						'name' => 'Co_operative',
						'label' => 'Co-operative',
						'value' => 'Co-operative',
						'weight' => 20,
						'description' => '',
					),
					array(
						'name' => 'Limited_Liability_Company',
						'label' => 'Limited Liability Company',
						'value' => 'Limited Liability Company',
						'weight' => 30,
						'description' => '',
					),
					array(
						'name' => 'Non_Profit_Non_Governmental_Org',
						'label' => 'Non-Profit/Non-Governmental Organisation Joint Stock Company',
						'value' => 'Non-Profit/Non-Governmental Organisation Joint Stock Company',
						'weight' => 40,
						'description' => '',
					),
					array(
						'name' => 'Other',
						'label' => 'Other',
						'value' => 'Other',
						'weight' => 50,
						'description' => '',
					),
					array(
						'name' => 'Partnership',
						'label' => 'Partnership',
						'value' => 'Partnership',
						'weight' => 60,
						'description' => '',
					),
					array(
						'name' => 'Sole_proprietorship',
						'label' => 'Sole-proprietorship',
						'value' => 'Sole-proprietorship',
						'weight' => 70,
						'description' => '',
					),
				),
			),
			array(
				'group_name' => 'relative_to_last_year_has_you_ne_20140811155742',
				'group_title' => 'Relative to last year, has you net profit increased, decreased or stayed similar?',
				'values' => array(
					array(
						'name' => 'Decreased',
						'label' => 'Decreased',
						'value' => 'Decreased',
						'weight' => 10,
						'description' => '',
					),
					array(
						'name' => 'Increased',
						'label' => 'Increased',
						'value' => 'Increased',
						'weight' => 20,
						'description' => '',
					),
					array(
						'name' => 'Similar',
						'label' => 'Similar',
						'value' => 'Similar',
						'weight' => 30,
						'description' => '',
					),
				),
			),
			array(
				'group_name' => 'by_how_much_has_it_roughly_incre_20140811155939',
				'group_title' => 'By how much has it roughly increased / decreased?',
				'values' => array(
					array(
						'name' => '100_',
						'label' => '100%',
						'value' => '100%',
						'weight' => 10,
						'description' => '',
					),
					array(
						'name' => '25_50_',
						'label' => '25 - 50%',
						'value' => '25-50%',
						'weight' => 20,
						'description' => '',
					),
					array(
						'name' => '50_75_',
						'label' => '50 - 75%',
						'value' => '50-75%',
						'weight' => 30,
						'description' => '',
					),
					array(
						'name' => '75_100_',
						'label' => '75 - 100%',
						'value' => '75-100%',
						'weight' => 40,
						'description' => '',
					),
					array(
						'name' => 'Less_than_25_',
						'label' => 'Less than 25%',
						'value' => 'Less than 25%',
						'weight' => 50,
						'description' => '',
					),
				),
			),
			array(
				'group_name' => 'how_did_your_company_first_hear__20140812092021',
				'group_title' => 'How did your company first hear about CBI/PUM?',
				'values' => array(
					array(
						'name' => 'From_a_private_sector_support_o',
						'label' => 'From a private sector support organisation in my country (sector associations, consultancy firms etc)',
						'value' => 'From a private sector support organisation in my country (sector associations, consultancy firms etc)',
						'weight' => 10,
						'description' => '',
					),
					array(
						'name' => 'From_a_public_sector_support_or',
						'label' => 'From a public sector support organisation in my country (governments, chamber of commerce etc)',
						'value' => 'From a public sector support organisation in my country (governments, chamber of commerce etc)',
						'weight' => 20,
						'description' => '',
					),
					array(
						'name' => 'From_an_international_developme',
						'label' => 'From an international development organisation',
						'value' => 'From an international development organisation',
						'weight' => 30,
						'description' => '',
					),
					array(
						'name' => 'Other',
						'label' => 'Other',
						'value' => 'Other',
						'weight' => 40,
						'description' => '',
					),
					array(
						'name' => 'Through_a_PUM_seminar',
						'label' => 'Through a PUM seminar',
						'value' => 'Through a PUM seminar',
						'weight' => 50,
						'description' => '',
					),
					array(
						'name' => 'Through_support_from_the_Nether',
						'label' => 'Through support from the Netherlands in the past',
						'value' => 'Through support from the Netherlands in the past',
						'weight' => 60,
						'description' => '',
					),
					array(
						'name' => 'Through_the_embassy',
						'label' => 'Through the embassy',
						'value' => 'Through the embassy',
						'weight' => 70,
						'description' => '',
					),
					array(
						'name' => 'Through_the_internet',
						'label' => 'Through the internet',
						'value' => 'Through the internet',
						'weight' => 80,
						'description' => '',
					),
					array(
						'name' => 'Through_the_local_PUM_Represent',
						'label' => 'Through the local PUM Representative or contact person',
						'value' => 'Through the local PUM Representative or contact person',
						'weight' => 90,
						'description' => '',
					),
				),
			),
			array(
				'group_name' => 'what_is_the_operational_model_of_20140812092903',
				'group_title' => 'What is the operational model of the organisation',
				'values' => array(
					array(
						'name' => 'Distribution_Delivery_of_good_o',
						'label' => 'Distribution: Delivery of good or service to the target audience, whether through traditional transport or infrastructure',
						'value' => 'Distribution: Delivery of good or service to the target audience, whether through traditional transport or infrastructure',
						'weight' => 10,
						'description' => '',
					),
					array(
						'name' => 'Financial_Services_Financial_pr',
						'label' => 'Financial Services: Financial products and services',
						'value' => 'Financial Services: Financial products and services',
						'weight' => 20,
						'description' => '',
					),
					array(
						'name' => 'Processing_Packaging_Processing',
						'label' => 'Processing/Packaging: Processing and or packaging wheat',
						'value' => 'Processing/Packaging: Processing and or packaging wheat',
						'weight' => 30,
						'description' => '',
					),
					array(
						'name' => 'Production_Manufacturing_Produc',
						'label' => 'Production/Manufacturing: Production and/or manufacturing of goods',
						'value' => 'Production/Manufacturing: Production and/or manufacturing of goods',
						'weight' => 40,
						'description' => '',
					),
					array(
						'name' => 'Services_Services_such_as_educa',
						'label' => 'Services: Services such as education, health, communication, transportation, soecial services, tourism, etc.',
						'value' => 'Services: Services such as education, health, communication, transportation, soecial services, tourism, etc.',
						'weight' => 50,
						'description' => '',
					),
					array(
						'name' => 'Wholesale_Retail_Intermediary_o',
						'label' => 'Wholesale/Retail: Intermediary organisation that purchases goods and sells them to new target customers',
						'value' => 'Wholesale/Retail: Intermediary organisation that purchases goods and sells them to new target customers',
						'weight' => 60,
						'description' => '',
					),
				),
			),
			array(
				'group_name' => 'is_your_company_aware_of_any_bus_20140812094930',
				'group_title' => 'Is your company aware of any business support provided by the following type of organisations?  (check box if yes)',
				'values' => array(
					array(
						'name' => 'Government',
						'label' => 'Government',
						'value' => 'Government',
						'weight' => 10,
						'description' => '',
					),
					array(
						'name' => 'International_consultants_compa',
						'label' => 'International consultants/ companies',
						'value' => 'International consultants/ companies',
						'weight' => 20,
						'description' => '',
					),
					array(
						'name' => 'International_donor_organizatio',
						'label' => 'International donor organization',
						'value' => 'International donor organization',
						'weight' => 30,
						'description' => '',
					),
					array(
						'name' => 'Local_consultants_companies',
						'label' => 'Local consultants/ companies',
						'value' => 'Local consultants/ companies',
						'weight' => 40,
						'description' => '',
					),
					array(
						'name' => 'Sector_associations',
						'label' => 'Sector associations',
						'value' => 'Sector associations',
						'weight' => 50,
						'description' => '',
					),
				),
			),
			array(
				'group_name' => 'gentlemen_s_agreement_20140812163331',
				'group_title' => 'Gentlemen\'s Agreement',
				'values' => array(
					array(
						'name' => 'I_Agree',
						'label' => 'I Agree',
						'value' => 'I Agree',
						'weight' => 10,
						'description' => '',
					),
				),
			),
			array(
				'group_name' => 'education_level_20140825212618',
				'group_title' => 'Education level',
				'values' => array(
					array(
						'name' => 'HBO',
						'label' => 'HBO',
						'value' => 'HBO',
						'weight' => 10,
						'description' => '',
					),
					array(
						'name' => 'MBO',
						'label' => 'MBO',
						'value' => 'MBO',
						'weight' => 20,
						'description' => '',
					),
					array(
						'name' => 'WO',
						'label' => 'WO',
						'value' => 'WO',
						'weight' => 30,
						'description' => '',
					),
				),
			),
			array(
				'group_name' => 'expert_status_20140825140612',
				'group_title' => 'Expert status',
				'values' => array(
					array(
						'name' => 'Active',
						'label' => 'Active',
						'value' => 'Active',
						'weight' => 10,
						'description' => '',
					),
					array(
						'name' => 'Candidate',
						'label' => 'Candidate',
						'value' => 'Candidate',
						'weight' => 20,
						'description' => '',
					),
					array(
						'name' => 'Exit',
						'label' => 'Exit',
						'value' => 'Exit',
						'weight' => 30,
						'description' => '',
					),
					array(
						'name' => 'Temporarily_inactive',
						'label' => 'Temporarily inactive',
						'value' => 'Temporarily inactive',
						'weight' => 40,
						'description' => '',
					),
				),
			),
			array(
				'group_name' => 'generic_skilss_20140825142210',
				'group_title' => 'Generic Skilss',
				'values' => array(
					array(
						'name' => 'Acquisition',
						'label' => 'Acquisition',
						'value' => 'Acquisition',
						'weight' => 10,
						'description' => '',
					),
					array(
						'name' => 'Change_Management',
						'label' => 'Change Management',
						'value' => 'Change Management',
						'weight' => 20,
						'description' => '',
					),
					array(
						'name' => 'Entrepeneurial_Skills',
						'label' => 'Entrepeneurial Skills',
						'value' => 'Entrepeneurial Skills',
						'weight' => 30,
						'description' => '',
					),
					array(
						'name' => 'ICT_Skills',
						'label' => 'ICT Skills',
						'value' => 'ICT Skills',
						'weight' => 40,
						'description' => '',
					),
					array(
						'name' => 'Organisational_Skills',
						'label' => 'Organisational Skills',
						'value' => 'Organisational Skills',
						'weight' => 50,
						'description' => '',
					),
					array(
						'name' => 'Project_Management',
						'label' => 'Project Management',
						'value' => 'Project Management',
						'weight' => 60,
						'description' => '',
					),
					array(
						'name' => 'Sales',
						'label' => 'Sales',
						'value' => 'Sales',
						'weight' => 70,
						'description' => '',
					),
					array(
						'name' => 'Teaching',
						'label' => 'Teaching',
						'value' => 'Teaching',
						'weight' => 80,
						'description' => '',
					),
					array(
						'name' => 'Training_Coaching',
						'label' => 'Training & Coaching',
						'value' => 'Training & Coaching',
						'weight' => 90,
						'description' => '',
					),
				),
			),
			array(
				'group_name' => 'agreement_code_of_conduct_20140825215920',
				'group_title' => 'Agreement: Code of Conduct',
				'values' => array(
					array(
						'name' => 'Yes',
						'label' => 'Yes',
						'value' => 'Yes',
						'weight' => 10,
						'description' => '',
					),
				),
			),
			array(
				'group_name' => 'do_you_approve_the_customer__20140824144140',
				'group_title' => 'Do you approve the Customer?',
				'values' => array(
					array(
						'name' => 'No',
						'label' => 'No',
						'value' => 'No',
						'weight' => 10,
						'description' => '',
					),
					array(
						'name' => 'No_check_Anamon',
						'label' => 'No check Anamon',
						'value' => 'No check Anamon',
						'weight' => 20,
						'description' => '',
					),
					array(
						'name' => 'Pending',
						'label' => 'Pending',
						'value' => 'Pending',
						'weight' => 30,
						'description' => '',
					),
					array(
						'name' => 'Yes',
						'label' => 'Yes',
						'value' => 'Yes',
						'weight' => 40,
						'description' => '',
					),
				),
			),
			array(
				'group_name' => 'organisation_type_20140824135638',
				'group_title' => 'Organisation Type',
				'values' => array(
					array(
						'name' => 'Branche_organisation',
						'label' => 'Branche organisation',
						'value' => 'Branche organisation',
						'weight' => 10,
						'description' => '',
					),
					array(
						'name' => 'Chamber_of_commerce_and_Industr',
						'label' => 'Chamber of commerce and Industry',
						'value' => 'Chamber of commerce and Industry',
						'weight' => 20,
						'description' => '',
					),
					array(
						'name' => 'Employers_organisation',
						'label' => 'Employers organisation',
						'value' => 'Employers organisation',
						'weight' => 30,
						'description' => '',
					),
					array(
						'name' => 'Health_Care_organisation_non_co',
						'label' => 'Health Care organisation (non-commercial)',
						'value' => 'Health Care organisation (non-commercial)',
						'weight' => 40,
						'description' => '',
					),
					array(
						'name' => 'Infrastructural_organisation',
						'label' => 'Infrastructural organisation',
						'value' => 'Infrastructural organisation',
						'weight' => 50,
						'description' => '',
					),
					array(
						'name' => 'Institution_of_vocational_organ',
						'label' => 'Institution of vocational organisation (non-commercial)',
						'value' => 'Institution of vocational organisation (non-commercial)',
						'weight' => 60,
						'description' => '',
					),
					array(
						'name' => 'Other_government_non_government',
						'label' => 'Other (government/non-government)',
						'value' => 'Other (government/non-government)',
						'weight' => 70,
						'description' => '',
					),
					array(
						'name' => 'Research_and_or_Development_org',
						'label' => 'Research and/or Development organisation for the benefit of SME',
						'value' => 'Research and/or Development organisation for the benefit of SME',
						'weight' => 80,
						'description' => '',
					),
					array(
						'name' => 'SME_including_Cooperations_priv',
						'label' => 'SME (including Cooperations, private hostpitals/schools, transformation companies)',
						'value' => 'SME',
						'weight' => 90,
						'description' => '',
					),
				),
			),
			array(
				'group_name' => 'roi_of_the_project_has_the_custo_20140824140536',
				'group_title' => 'RoI of the project: Has the customer substantial growth potential',
				'values' => array(
					array(
						'name' => 'No',
						'label' => 'No',
						'value' => 'No',
						'weight' => 10,
						'description' => '',
					),
					array(
						'name' => 'Unknown',
						'label' => 'Unknown',
						'value' => 'Unknown',
						'weight' => 20,
						'description' => '',
					),
					array(
						'name' => 'Yes',
						'label' => 'Yes',
						'value' => 'Yes',
						'weight' => 30,
						'description' => '',
					),
				),
			),
			array(
				'group_name' => 'roi_of_the_project_has_the_custo_20140824140649',
				'group_title' => 'RoI of the project: Has the customer enough investment potential',
				'values' => array(
					array(
						'name' => 'No',
						'label' => 'No',
						'value' => 'No',
						'weight' => 10,
						'description' => '',
					),
					array(
						'name' => 'Unknown',
						'label' => 'Unknown',
						'value' => 'Unknown',
						'weight' => 20,
						'description' => '',
					),
					array(
						'name' => 'Yes',
						'label' => 'Yes',
						'value' => 'Yes',
						'weight' => 30,
						'description' => '',
					),
				),
			),
			array(
				'group_name' => 'conclusion_do_you_want_to_approv_20140824140907',
				'group_title' => 'Conclusion: Do you want to approve this customer?',
				'values' => array(
					array(
						'name' => 'No',
						'label' => 'No',
						'value' => 'No',
						'weight' => 10,
						'description' => '',
					),
					array(
						'name' => 'Pending_additional_information_',
						'label' => 'Pending (additional information required)',
						'value' => 'Pending',
						'weight' => 20,
						'description' => '',
					),
					array(
						'name' => 'Yes',
						'label' => 'Yes',
						'value' => 'Yes',
						'weight' => 30,
						'description' => '',
					),
				),
			),
			array(
				'group_name' => 'conclusion_which_project_activit_20140824141332',
				'group_title' => 'Conclusion: Which project activities do you advise/foresee for this project?',
				'values' => array(
					array(
						'name' => 'Advice',
						'label' => 'Advice',
						'value' => 'Advice',
						'weight' => 10,
						'description' => '',
					),
					array(
						'name' => 'BLP',
						'label' => 'BLP',
						'value' => 'BLP',
						'weight' => 20,
						'description' => '',
					),
					array(
						'name' => 'Grant',
						'label' => 'Grant',
						'value' => 'Grant',
						'weight' => 30,
						'description' => '',
					),
					array(
						'name' => 'Remote_Coaching',
						'label' => 'Remote Coaching',
						'value' => 'Remote Coaching',
						'weight' => 40,
						'description' => '',
					),
				),
			),
			array(
				'group_name' => 'conclusion_which_should_come_fir_20140824141529',
				'group_title' => 'Conclusion: Which should come first?',
				'values' => array(
					array(
						'name' => 'Advice',
						'label' => 'Advice',
						'value' => 'Advice',
						'weight' => 10,
						'description' => '',
					),
					array(
						'name' => 'BLP',
						'label' => 'BLP',
						'value' => 'BLP',
						'weight' => 20,
						'description' => '',
					),
					array(
						'name' => 'Grant',
						'label' => 'Grant',
						'value' => 'Grant',
						'weight' => 30,
						'description' => '',
					),
					array(
						'name' => 'Remote_Coaching',
						'label' => 'Remote Coaching',
						'value' => 'Remote Coaching',
						'weight' => 40,
						'description' => '',
					),
				),
			),
			array(
				'group_name' => 'pum_criteria_does_the_customer_a_20140824143003',
				'group_title' => 'PUM Criteria: Does the Customer and/or the project meet the specific criteria (if these exist for this sector)?',
				'values' => array(
					array(
						'name' => 'No',
						'label' => 'No',
						'value' => 'No',
						'weight' => 10,
						'description' => '',
					),
					array(
						'name' => 'Not_Applicable',
						'label' => 'Not Applicable',
						'value' => 'Not Applicable',
						'weight' => 20,
						'description' => '',
					),
					array(
						'name' => 'Yes',
						'label' => 'Yes',
						'value' => 'Yes',
						'weight' => 30,
						'description' => '',
					),
				),
			),
			array(
				'group_name' => 'project_type_of_work_20140824143328',
				'group_title' => 'Project: Type of Work',
				'values' => array(
					array(
						'name' => 'Dropdown_2_nog_aanleveren',
						'label' => 'Dropdown 2 nog aanleveren',
						'value' => 'Dropdown 2 nog aanleveren',
						'weight' => 10,
						'description' => '',
					),
					array(
						'name' => 'Dropdown_nog_aanleveren',
						'label' => 'Dropdown nog aanleveren',
						'value' => 'Dropdown nog aanleveren',
						'weight' => 20,
						'description' => '',
					),
				),
			),
			array(
				'group_name' => 'language_20140716104058',
				'group_title' => 'Language',
				'values' => array(
					array(
						'name' => 'English_Reading',
						'label' => 'English Reading',
						'value' => 'English Reading',
						'weight' => 10,
						'description' => '',
					),
					array(
						'name' => 'English_Speaking',
						'label' => 'English Speaking',
						'value' => 'English Speaking',
						'weight' => 20,
						'description' => '',
					),
					array(
						'name' => 'English_Writing',
						'label' => 'English Writing',
						'value' => 'English Writing',
						'weight' => 30,
						'description' => '',
					),
					array(
						'name' => 'French',
						'label' => 'French',
						'value' => 'French',
						'weight' => 40,
						'description' => '',
					),
					array(
						'name' => 'German',
						'label' => 'German',
						'value' => 'German',
						'weight' => 50,
						'description' => '',
					),
					array(
						'name' => 'Hindi',
						'label' => 'Hindi',
						'value' => 'Hindi',
						'weight' => 60,
						'description' => '',
					),
					array(
						'name' => 'Papiamento',
						'label' => 'Papiamento',
						'value' => 'Papiamento',
						'weight' => 70,
						'description' => '',
					),
					array(
						'name' => 'Portuguese',
						'label' => 'Portuguese',
						'value' => 'Portuguese',
						'weight' => 80,
						'description' => '',
					),
					array(
						'name' => 'Russian',
						'label' => 'Russian',
						'value' => 'Russian',
						'weight' => 90,
						'description' => '',
					),
					array(
						'name' => 'Sotho',
						'label' => 'Sotho',
						'value' => 'Sotho',
						'weight' => 100,
						'description' => '',
					),
					array(
						'name' => 'Spanish',
						'label' => 'Spanish',
						'value' => 'Spanish',
						'weight' => 110,
						'description' => '',
					),
					array(
						'name' => 'Urdu',
						'label' => 'Urdu',
						'value' => 'Urdu',
						'weight' => 120,
						'description' => '',
					),
				),
			),
			array(
				'group_name' => 'level_432_20140806134147',
				'group_title' => 'Level English Language',
				'values' => array(
					array(
						'name' => 'Fair',
						'label' => 'Fair',
						'value' => 'Fair',
						'weight' => 10,
						'description' => '',
					),
					array(
						'name' => 'Good',
						'label' => 'Good',
						'value' => 'Good',
						'weight' => 20,
						'description' => '',
					),
					array(
						'name' => 'None',
						'label' => 'None',
						'value' => 'None',
						'weight' => 30,
						'description' => '',
					),
					array(
						'name' => 'Very_good',
						'label' => 'Very good',
						'value' => 'Very good',
						'weight' => 40,
						'description' => '',
					),
				),
			),
			array(
				'group_name' => 'assessment_cc_20140409101816',
				'group_title' => 'Assessment CC',
				'values' => array(
					array(
						'name' => 'Approve',
						'label' => 'Approve',
						'value' => 'Approve',
						'weight' => 10,
						'description' => '',
					),
					array(
						'name' => 'Pending',
						'label' => 'Pending',
						'value' => 'Pending',
						'weight' => 20,
						'description' => '',
					),
					array(
						'name' => 'Reject',
						'label' => 'Reject',
						'value' => 'Reject',
						'weight' => 30,
						'description' => '',
					),
				),
			),
			array(
				'group_name' => 'reject_expert_application_20140708150113',
				'group_title' => 'Reject Expert Application',
				'values' => array(
					array(
						'name' => 'Expertise_not_applicable',
						'label' => 'Expertise not applicable',
						'value' => 'Expertise not applicable',
						'weight' => 10,
						'description' => '',
					),
					array(
						'name' => 'Living_abroad',
						'label' => 'Living abroad',
						'value' => 'Living abroad',
						'weight' => 20,
						'description' => '',
					),
					array(
						'name' => 'Not_enough_expertise',
						'label' => 'Not enough expertise',
						'value' => 'Not enough expertise',
						'weight' => 30,
						'description' => '',
					),
					array(
						'name' => 'Not_enough_projects_for_this_ex',
						'label' => 'Not enough projects for this expertise',
						'value' => 'Not enough projects for this expertise',
						'weight' => 40,
						'description' => '',
					),
					array(
						'name' => 'Other_reason_for_rejection',
						'label' => 'Other reason for rejection',
						'value' => 'Other reason for rejection',
						'weight' => 50,
						'description' => '',
					),
					array(
						'name' => 'Too_young',
						'label' => 'Too young',
						'value' => 'Too young',
						'weight' => 60,
						'description' => '',
					),
				),
			),
		);
	}
}
