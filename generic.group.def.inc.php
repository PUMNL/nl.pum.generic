<?php

class Generic_Group_Def {

	// definitions for: Group

	static function required() {
		return array(
			array(
				'module' => 'nl.pum.generic',
				'name' => 'Experts',
				'entity' => 'Group',
				'params' => array(
					'version' => 3,
					'name' => 'Experts',
					'title' => 'Experts',
					'description' => 'Test Group for Experts',
					'is_active' => 1,
					'group_type' => array(
						2 => 1,
					),
				),
			),
			array(
				'module' => 'nl.pum.generic',
				'name' => 'Candidate Expert',
				'entity' => 'Group',
				'params' => array(
					'version' => 3,
					'name' => 'Candidate Expert',
					'title' => 'Candidate Expert',
					'description' => 'Gebruikt voor aanmelding van Experts',
					'is_active' => 1,
					'group_type' => array(
						2 => 1,
					),
				),
			),
			array(
				'module' => 'nl.pum.generic',
				'name' => 'Programme Managers',
				'entity' => 'Group',
				'params' => array(
					'version' => 3,
					'name' => 'Programme Managers',
					'title' => 'Programme Managers',
					'description' => 'Group for Possible Programme Managers',
					'is_active' => 1,
					'group_type' => array(
						2 => 1,
					),
				),
			),
			array(
				'module' => 'nl.pum.generic',
				'name' => 'Sector Coordinators',
				'entity' => 'Group',
				'params' => array(
					'version' => 3,
					'name' => 'Sector Coordinators',
					'title' => 'Sector Coordinators',
					'description' => 'Group for Possible Sector Coordinators',
					'is_active' => 1,
					'group_type' => array(
						2 => 1,
					),
				),
			),
			array(
				'module' => 'nl.pum.generic',
				'name' => 'Country Coordinators',
				'entity' => 'Group',
				'params' => array(
					'version' => 3,
					'name' => 'Country Coordinators',
					'title' => 'Country Coordinators',
					'description' => 'Group for Possible Country Coordinators',
					'is_active' => 1,
					'group_type' => array(
						2 => 1,
					),
				),
			),
			array(
				'module' => 'nl.pum.generic',
				'name' => 'Project Officers',
				'entity' => 'Group',
				'params' => array(
					'version' => 3,
					'name' => 'Project Officers',
					'title' => 'Project Officers',
					'description' => 'Group for Possible Project Officers',
					'is_active' => 1,
					'group_type' => array(
						2 => 1,
					),
				),
			),
			array(
				'module' => 'nl.pum.generic',
				'name' => 'Newsletter_9',
				'entity' => 'Group',
				'params' => array(
					'version' => 3,
					'name' => 'Newsletter_9',
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
				'name' => 'Representatives_10',
				'entity' => 'Group',
				'params' => array(
					'version' => 3,
					'name' => 'Representatives_10',
					'title' => 'Representatives',
					'description' => 'Group of Representatives locally active for PUM',
					'is_active' => 1,
					'group_type' => array(
						2 => 1,
					),
				),
			),
		);
	}
}
