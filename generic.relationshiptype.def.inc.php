<?php

class Generic_RelationshipType_Def {

	// definitions for: Relationship Type

	static function required() {
		return array(
			array(
				'module' => 'nl.pum.generic',
				'name' => 'Anamon',
				'entity' => 'RelationshipType',
				'params' => array(
					'version' => 3,
					'name_a_b' => 'Anamon',
					'name_b_a' => 'Anamon',
					'label_a_b' => 'Anamon',
					'label_b_a' => 'Anamon',
					'contact_type_a' => '',
					'contact_sub_type_a' => '',
					'contact_type_b' => 'Individual',
					'contact_sub_type_b' => '',
					'description' => 'Anamon relationship',
					'is_active' => 1,
				),
			),
			array(
				'module' => 'nl.pum.generic',
				'name' => 'Country Coordinator is',
				'entity' => 'RelationshipType',
				'params' => array(
					'version' => 3,
					'name_a_b' => 'Country Coordinator is',
					'name_b_a' => 'Country Coordinator for',
					'label_a_b' => 'Country Coordinator is',
					'label_b_a' => 'Country Coordinator for',
					'contact_type_a' => 'Organization',
					'contact_sub_type_a' => '',
					'contact_type_b' => 'Individual',
					'contact_sub_type_b' => '',
					'description' => 'Country Coordinator for',
					'is_active' => 1,
				),
			),
			array(
				'module' => 'nl.pum.generic',
				'name' => 'Expert',
				'entity' => 'RelationshipType',
				'params' => array(
					'version' => 3,
					'name_a_b' => 'Expert',
					'name_b_a' => 'Expert',
					'label_a_b' => 'Expert',
					'label_b_a' => 'Expert',
					'contact_type_a' => '',
					'contact_sub_type_a' => '',
					'contact_type_b' => 'Individual',
					'contact_sub_type_b' => 'Expert',
					'description' => 'Used for the relationship between sector and Active Expert',
					'is_active' => 1,
				),
			),
			array(
				'module' => 'nl.pum.generic',
				'name' => 'Has authorised',
				'entity' => 'RelationshipType',
				'params' => array(
					'version' => 3,
					'name_a_b' => 'Has authorised',
					'name_b_a' => 'Authorised contact for',
					'label_a_b' => 'Has authorised',
					'label_b_a' => 'Authorised contact for',
					'contact_type_a' => 'Organization',
					'contact_sub_type_a' => '',
					'contact_type_b' => 'Individual',
					'contact_sub_type_b' => '',
					'description' => 'Customer contact relationship',
					'is_active' => 1,
				),
			),
			array(
				'module' => 'nl.pum.generic',
				'name' => 'ICE (In Case of Emergency) call',
				'entity' => 'RelationshipType',
				'params' => array(
					'version' => 3,
					'name_a_b' => 'ICE (In Case of Emergency) call',
					'name_b_a' => 'ICE (In Case of Emergency) for',
					'label_a_b' => 'ICE (In Case of Emergency) call',
					'label_b_a' => 'ICE (In Case of Emergency) for',
					'contact_type_a' => 'Individual',
					'contact_sub_type_a' => 'Expert',
					'contact_type_b' => 'Individual',
					'contact_sub_type_b' => '',
					'description' => '',
					'is_active' => 1,
				),
			),
			array(
				'module' => 'nl.pum.generic',
				'name' => 'Project Officer',
				'entity' => 'RelationshipType',
				'params' => array(
					'version' => 3,
					'name_a_b' => 'Project Officer for',
					'name_b_a' => 'Project Officer is',
					'label_a_b' => 'Project Officer',
					'label_b_a' => 'Project Officer',
					'contact_type_a' => '',
					'contact_sub_type_a' => '',
					'contact_type_b' => 'Individual',
					'contact_sub_type_b' => '',
					'description' => 'Project Officer relationship',
					'is_active' => 1,
				),
			),
			array(
				'module' => 'nl.pum.generic',
				'name' => 'Projectmanager',
				'entity' => 'RelationshipType',
				'params' => array(
					'version' => 3,
					'name_a_b' => 'Projectmanager',
					'name_b_a' => 'Projectmanager',
					'label_a_b' => 'Projectmanager',
					'label_b_a' => 'Projectmanager',
					'contact_type_a' => 'Organization',
					'contact_sub_type_a' => '',
					'contact_type_b' => 'Individual',
					'contact_sub_type_b' => '',
					'description' => 'Projectmanager',
					'is_active' => 1,
				),
			),
			array(
				'module' => 'nl.pum.generic',
				'name' => 'Recruitment Team Member',
				'entity' => 'RelationshipType',
				'params' => array(
					'version' => 3,
					'name_a_b' => 'Recruitment Team Member',
					'name_b_a' => 'Recruitment Team Member',
					'label_a_b' => 'Recruitment Team Member',
					'label_b_a' => 'Recruitment Team Member',
					'contact_type_a' => 'Individual',
					'contact_sub_type_a' => 'Expert',
					'contact_type_b' => 'Individual',
					'contact_sub_type_b' => '',
					'description' => '',
					'is_active' => 1,
				),
			),
			array(
				'module' => 'nl.pum.generic',
				'name' => 'Representative is',
				'entity' => 'RelationshipType',
				'params' => array(
					'version' => 3,
					'name_a_b' => 'Representative is',
					'name_b_a' => 'Representative',
					'label_a_b' => 'Representative is',
					'label_b_a' => 'Representative for',
					'contact_type_a' => 'Organization',
					'contact_sub_type_a' => '',
					'contact_type_b' => 'Individual',
					'contact_sub_type_b' => '',
					'description' => 'PUM Rep',
					'is_active' => 1,
				),
			),
			array(
				'module' => 'nl.pum.generic',
				'name' => 'Sector Coordinator',
				'entity' => 'RelationshipType',
				'params' => array(
					'version' => 3,
					'name_a_b' => 'Sector Coordinator',
					'name_b_a' => 'Sector Coordinator',
					'label_a_b' => 'Sector Coordinator',
					'label_b_a' => 'Sector Coordinator',
					'contact_type_a' => '',
					'contact_sub_type_a' => '',
					'contact_type_b' => 'Individual',
					'contact_sub_type_b' => '',
					'description' => 'Sector Coordinator relationship',
					'is_active' => 1,
				),
			),
			array(
				'module' => 'nl.pum.generic',
				'name' => 'Grant Coordinator',
				'entity' => 'RelationshipType',
				'params' => array(
					'version' => 3,
					'name_a_b' => 'Grant Coordinator',
					'name_b_a' => 'Grant Coordinator',
					'label_a_b' => 'Grant Coordinator',
					'label_b_a' => 'Grant Coordinator',
					'contact_type_a' => '',
					'contact_sub_type_a' => '',
					'contact_type_b' => 'Individual',
					'contact_sub_type_b' => '',
					'description' => 'Grant Coordinator',
					'is_active' => 1,
				),
			),
			array(
				'module' => 'nl.pum.generic',
				'name' => 'CFO',
				'entity' => 'RelationshipType',
				'params' => array(
					'version' => 3,
					'name_a_b' => 'CFO',
					'name_b_a' => 'CFO',
					'label_a_b' => 'CFO',
					'label_b_a' => 'CFO',
					'contact_type_a' => '',
					'contact_sub_type_a' => '',
					'contact_type_b' => 'Individual',
					'contact_sub_type_b' => '',
					'description' => 'CFO',
					'is_active' => 1,
				),
			),
			array(
				'module' => 'nl.pum.generic',
				'name' => 'CEO',
				'entity' => 'RelationshipType',
				'params' => array(
					'version' => 3,
					'name_a_b' => 'CEO',
					'name_b_a' => 'CEO',
					'label_a_b' => 'CEO',
					'label_b_a' => 'CEO',
					'contact_type_a' => '',
					'contact_sub_type_a' => '',
					'contact_type_b' => 'Individual',
					'contact_sub_type_b' => '',
					'description' => 'CEO of PUM, used in CAP',
					'is_active' => 1,
				),
			),
			array(
				'module' => 'nl.pum.generic',
				'name' => 'Partner',
				'entity' => 'RelationshipType',
				'params' => array(
					'version' => 3,
					'name_a_b' => 'Strategic Partner',
					'name_b_a' => 'Strategic Partner',
					'label_a_b' => 'Partner',
					'label_b_a' => 'Partner',
					'contact_type_a' => '',
					'contact_sub_type_a' => '',
					'contact_type_b' => '',
					'contact_sub_type_b' => '',
					'description' => 'PUM Partner',
					'is_active' => 1,
				),
			),
			array(
				'module' => 'nl.pum.generic',
				'name' => 'MT Member is',
				'entity' => 'RelationshipType',
				'params' => array(
					'version' => 3,
					'name_a_b' => 'MT Member is',
					'name_b_a' => 'MT Member',
					'label_a_b' => 'MT Member is',
					'label_b_a' => 'MT Member',
					'contact_type_a' => 'Organization',
					'contact_sub_type_a' => 'Country',
					'contact_type_b' => 'Individual',
					'contact_sub_type_b' => '',
					'description' => 'MT member used in CTM',
					'is_active' => 1,
				),
			),
			array(
				'module' => 'nl.pum.generic',
				'name' => 'Accountholder at PUM',
				'entity' => 'RelationshipType',
				'params' => array(
					'version' => 3,
					'name_a_b' => 'Account Holder',
					'name_b_a' => 'Account Holder',
					'label_a_b' => 'Accountholder at PUM',
					'label_b_a' => 'Accountholder at PUM',
					'contact_type_a' => '',
					'contact_sub_type_a' => '',
					'contact_type_b' => '',
					'contact_sub_type_b' => '',
					'description' => '',
					'is_active' => 1,
				),
			),
			array(
				'module' => 'nl.pum.generic',
				'name' => 'Accountholder at client',
				'entity' => 'RelationshipType',
				'params' => array(
					'version' => 3,
					'name_a_b' => 'Account holder for client',
					'name_b_a' => 'Account holder for client',
					'label_a_b' => 'Accountholder at client',
					'label_b_a' => 'Accountholder at client',
					'contact_type_a' => 'Organization',
					'contact_sub_type_a' => '',
					'contact_type_b' => 'Individual',
					'contact_sub_type_b' => '',
					'description' => '',
					'is_active' => 1,
				),
			),
			array(
				'module' => 'nl.pum.generic',
				'name' => 'Accountholder at partner',
				'entity' => 'RelationshipType',
				'params' => array(
					'version' => 3,
					'name_a_b' => 'Account holder for strategic partner',
					'name_b_a' => 'Account holder for strategic partner',
					'label_a_b' => 'Accountholder at partner',
					'label_b_a' => 'Accountholder at partner',
					'contact_type_a' => 'Individual',
					'contact_sub_type_a' => '',
					'contact_type_b' => 'Organization',
					'contact_sub_type_b' => 'Partners',
					'description' => '',
					'is_active' => 1,
				),
			),
			array(
				'module' => 'nl.pum.generic',
				'name' => 'BD contact at PUM',
				'entity' => 'RelationshipType',
				'params' => array(
					'version' => 3,
					'name_a_b' => 'BD contact at PUM',
					'name_b_a' => 'BD contact at PUM',
					'label_a_b' => 'BD contact at PUM',
					'label_b_a' => 'BD contact at PUM',
					'contact_type_a' => '',
					'contact_sub_type_a' => '',
					'contact_type_b' => 'Individual',
					'contact_sub_type_b' => '',
					'description' => '',
					'is_active' => 1,
				),
			),
			array(
				'module' => 'nl.pum.generic',
				'name' => 'Case Coordinator is',
				'entity' => 'RelationshipType',
				'params' => array(
					'version' => 3,
					'name_a_b' => 'Case Coordinator is',
					'name_b_a' => 'Case Coordinator',
					'label_a_b' => 'Case Coordinator is',
					'label_b_a' => 'Case Coordinator',
					'contact_type_a' => 'Individual',
					'contact_sub_type_a' => '',
					'contact_type_b' => 'Individual',
					'contact_sub_type_b' => '',
					'description' => 'Case Coordinator',
					'is_active' => 1,
				),
			),
			array(
				'module' => 'nl.pum.generic',
				'name' => 'Employee of',
				'entity' => 'RelationshipType',
				'params' => array(
					'version' => 3,
					'name_a_b' => 'Employee of',
					'name_b_a' => 'Employer of',
					'label_a_b' => 'Employee of',
					'label_b_a' => 'Employer of',
					'contact_type_a' => 'Individual',
					'contact_sub_type_a' => '',
					'contact_type_b' => 'Organization',
					'contact_sub_type_b' => '',
					'description' => 'Employment relationship.',
					'is_active' => 1,
				),
			),
			array(
				'module' => 'nl.pum.generic',
				'name' => 'Event Contributor is',
				'entity' => 'RelationshipType',
				'params' => array(
					'version' => 3,
					'name_a_b' => 'Event Contributor is',
					'name_b_a' => 'Event Contributor',
					'label_a_b' => 'Event Contributor is',
					'label_b_a' => 'Event Contributor',
					'contact_type_a' => 'Individual',
					'contact_sub_type_a' => '',
					'contact_type_b' => 'Organization',
					'contact_sub_type_b' => '',
					'description' => 'Used for \"Organise Event\"',
					'is_active' => 1,
				),
			),
			array(
				'module' => 'nl.pum.generic',
				'name' => 'Event External Party is',
				'entity' => 'RelationshipType',
				'params' => array(
					'version' => 3,
					'name_a_b' => 'Event External Party is',
					'name_b_a' => 'Event External Party',
					'label_a_b' => 'Event External Party is',
					'label_b_a' => 'Event External Party',
					'contact_type_a' => '',
					'contact_sub_type_a' => '',
					'contact_type_b' => '',
					'contact_sub_type_b' => '',
					'description' => 'Used for \"Organise Event\"',
					'is_active' => 1,
				),
			),
			array(
				'module' => 'nl.pum.generic',
				'name' => 'Event Manager is',
				'entity' => 'RelationshipType',
				'params' => array(
					'version' => 3,
					'name_a_b' => 'Event Manager is',
					'name_b_a' => 'Event Manager',
					'label_a_b' => 'Event Manager is',
					'label_b_a' => 'Event Manager',
					'contact_type_a' => 'Organization',
					'contact_sub_type_a' => '',
					'contact_type_b' => 'Individual',
					'contact_sub_type_b' => '',
					'description' => 'Used for \"Organise Event\"',
					'is_active' => 1,
				),
			),
			array(
				'module' => 'nl.pum.generic',
				'name' => 'Event Project Member is',
				'entity' => 'RelationshipType',
				'params' => array(
					'version' => 3,
					'name_a_b' => 'Event Project Member is',
					'name_b_a' => 'Event Project Member',
					'label_a_b' => 'Event Project Member is',
					'label_b_a' => 'Event Project Member',
					'contact_type_a' => 'Organization',
					'contact_sub_type_a' => '',
					'contact_type_b' => 'Individual',
					'contact_sub_type_b' => '',
					'description' => 'Used for \"Organise Event\"',
					'is_active' => 1,
				),
			),
			array(
				'module' => 'nl.pum.generic',
				'name' => 'Partner',
				'entity' => 'RelationshipType',
				'params' => array(
					'version' => 3,
					'name_a_b' => 'Strategic Partner',
					'name_b_a' => 'Strategic Partner',
					'label_a_b' => 'Partner',
					'label_b_a' => 'Partner',
					'contact_type_a' => '',
					'contact_sub_type_a' => '',
					'contact_type_b' => '',
					'contact_sub_type_b' => '',
					'description' => 'PUM Partner',
					'is_active' => 1,
				),
			),
			array(
				'module' => 'nl.pum.generic',
				'name' => 'Replacement Policy Officer DGIS at',
				'entity' => 'RelationshipType',
				'params' => array(
					'version' => 3,
					'name_a_b' => 'Replacement Policy Officer DGIS at',
					'name_b_a' => 'Replacement Policy Officer DGIS is',
					'label_a_b' => 'Replacement Policy Officer DGIS at',
					'label_b_a' => 'Replacement Policy Officer DGIS is',
					'contact_type_a' => 'Organization',
					'contact_sub_type_a' => 'Donor',
					'contact_type_b' => 'Individual',
					'contact_sub_type_b' => '',
					'description' => '',
					'is_active' => 1,
				),
			),
			array(
				'module' => 'nl.pum.generic',
				'name' => 'Policy Officer DGIS at',
				'entity' => 'RelationshipType',
				'params' => array(
					'version' => 3,
					'name_a_b' => 'Policy Officer DGIS at',
					'name_b_a' => 'Policy Officer DGIS is',
					'label_a_b' => 'Policy Officer DGIS at',
					'label_b_a' => 'Policy Officer DGIS is',
					'contact_type_a' => 'Organization',
					'contact_sub_type_a' => 'Donor',
					'contact_type_b' => 'Individual',
					'contact_sub_type_b' => '',
					'description' => '',
					'is_active' => 1,
				),
			),
		);
	}
}
