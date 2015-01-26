<?php

class Generic_Group_Def {

	// definitions for: Group

	static function required() {
		return array(
			array(
				'module' => 'nl.pum.generic',
				'name' => 'Recruitment_Team_13',
				'entity' => 'Group',
				'params' => array(
					'version' => 3,
					'name' => 'Recruitment_Team_13',
					'title' => 'Recruitment Team',
					'description' => '',
					'is_active' => 1,
					'group_type' => array(
						2 => 1,
					),
				),
			),
			array(
				'module' => 'nl.pum.generic',
				'name' => 'PUM_magazine_34',
				'entity' => 'Group',
				'params' => array(
					'version' => 3,
					'name' => 'PUM_magazine_34',
					'title' => 'PUM magazine',
					'description' => '',
					'is_active' => 1,
					'group_type' => array(
						2 => 1,
					),
				),
			),
			array(
				'module' => 'nl.pum.generic',
				'name' => 'Newsletter_35',
				'entity' => 'Group',
				'params' => array(
					'version' => 3,
					'name' => 'Newsletter_35',
					'title' => 'Newsletter',
					'description' => 'Newsletter for our english speaking customers.',
					'is_active' => 1,
					'group_type' => array(
						2 => 1,
					),
				),
			),
			array(
				'module' => 'nl.pum.generic',
				'name' => 'Representatives_36',
				'entity' => 'Group',
				'params' => array(
					'version' => 3,
					'name' => 'Representatives_36',
					'title' => 'Representatives',
					'description' => '',
					'is_active' => 1,
					'group_type' => array(
						2 => 1,
					),
				),
			),
			array(
				'module' => 'nl.pum.generic',
				'name' => 'Active_Expert_48',
				'entity' => 'Group',
				'params' => array(
					'version' => 3,
					'name' => 'Active_Expert_48',
					'title' => 'Active Expert',
					'description' => 'All Experts who are availble for PUM Projects',
					'is_active' => 1,
					'group_type' => array(
						2 => 1,
					),
				),
			),
			array(
				'module' => 'nl.pum.generic',
				'name' => 'Inactive_Expert_49',
				'entity' => 'Group',
				'params' => array(
					'version' => 3,
					'name' => 'Inactive_Expert_49',
					'title' => 'Inactive Expert',
					'description' => 'All Experts who are temporarily not available for PUM Projects',
					'is_active' => 1,
					'group_type' => array(
						2 => 1,
					),
				),
			),
			array(
				'module' => 'nl.pum.generic',
				'name' => 'Rejected_Expert_50',
				'entity' => 'Group',
				'params' => array(
					'version' => 3,
					'name' => 'Rejected_Expert_50',
					'title' => 'Rejected Expert',
					'description' => 'All Experts who are rejected during the Application fase and therefore not available for PUM Projects',
					'is_active' => 1,
					'group_type' => array(
						2 => 1,
					),
				),
			),
			array(
				'module' => 'nl.pum.generic',
				'name' => 'Candidate_Expert_51',
				'entity' => 'Group',
				'params' => array(
					'version' => 3,
					'name' => 'Candidate_Expert_51',
					'title' => 'Candidate Expert',
					'description' => 'All Experts in the application fase.',
					'is_active' => 1,
					'group_type' => array(
						2 => 1,
					),
				),
			),
			array(
				'module' => 'nl.pum.generic',
				'name' => 'Country_Coordinators_53',
				'entity' => 'Group',
				'params' => array(
					'version' => 3,
					'name' => 'Country_Coordinators_53',
					'title' => 'Country Coordinators',
					'description' => '',
					'is_active' => 1,
					'group_type' => array(
						1 => 1,
						2 => 1,
					),
				),
			),
			array(
				'module' => 'nl.pum.generic',
				'name' => 'Project_Officers_54',
				'entity' => 'Group',
				'params' => array(
					'version' => 3,
					'name' => 'Project_Officers_54',
					'title' => 'Project Officers',
					'description' => '',
					'is_active' => 1,
					'group_type' => array(
						1 => 1,
						2 => 1,
					),
				),
			),
			array(
				'module' => 'nl.pum.generic',
				'name' => 'Sector_Coordinators_55',
				'entity' => 'Group',
				'params' => array(
					'version' => 3,
					'name' => 'Sector_Coordinators_55',
					'title' => 'Sector Coordinators',
					'description' => '',
					'is_active' => 1,
					'group_type' => array(
						1 => 1,
						2 => 1,
					),
				),
			),
			array(
				'module' => 'nl.pum.generic',
				'name' => 'Programme_Managers_58',
				'entity' => 'Group',
				'params' => array(
					'version' => 3,
					'name' => 'Programme_Managers_58',
					'title' => 'Programme Managers',
					'description' => '',
					'is_active' => 1,
					'group_type' => array(
						2 => 1,
					),
				),
			),
			array(
				'module' => 'nl.pum.generic',
				'name' => 'Projectmanagers_82',
				'entity' => 'Group',
				'params' => array(
					'version' => 3,
					'name' => 'Projectmanagers_82',
					'title' => 'Projectmanager',
					'description' => '',
					'is_active' => 1,
					'group_type' => array(
						2 => 1,
					),
				),
			),
			array(
				'module' => 'nl.pum.generic',
				'name' => 'Former_Expert_47',
				'entity' => 'Group',
				'params' => array(
					'version' => 3,
					'name' => 'Former_Expert_47',
					'title' => 'Former Expert',
					'description' => '',
					'parent' => 'Experts',
					'is_active' => 1,
				),
			),
		);
	}
}
