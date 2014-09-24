<?php

class Generic_ActivityType_Def {

	// definitions for: Activity Type

	static function required() {
		return array(
			array(
				'name' => 'Interview',
				'label' => 'Interview',
				'component' => 'CiviCase',
				'description' => '<p>Used in &#39;Expertapplication&#39;</p>',
			),
			array(
				'name' => 'KIT test',
				'label' => 'KIT test',
				'component' => 'CiviCase',
				'description' => 'nl.pum.generic - Used in Expertapplication',
			),
			array(
				'name' => 'RCT Intake Report',
				'label' => 'RCT Intake Report',
				'component' => 'CiviCase',
				'description' => '<p>Used in &#39;Expertapplication&#39;</p>',
			),
			array(
				'name' => 'Create Candidate Expert Account',
				'label' => 'Create Candidate Expert Account',
				'component' => 'CiviCase',
				'description' => '<p>Used in &#39;Expertapplication&#39;</p>',
			),
			array(
				'name' => 'Fill Out PUM CV',
				'label' => 'Fill Out PUM CV',
				'component' => 'CiviCase',
				'description' => '<p>Used in &#39;Expertapplication&#39;</p>',
			),
			array(
				'name' => 'Contact with colleague',
				'label' => 'Contact with colleague',
				'component' => 'CiviCase',
				'description' => '<p>Use in civicase to log contact with a colleague: &#39;Expertapplication&#39;</p>',
			),
			array(
				'name' => 'Intake Customer by CC',
				'label' => 'Intake Customer by CC',
				'component' => 'CiviCase',
				'description' => '<p>Used in &#39;Projectintake&#39;</p>',
			),
			array(
				'name' => 'Intake Customer by SC',
				'label' => 'Intake Customer by SC',
				'component' => 'CiviCase',
				'description' => '<p>Used in &#39;Projectintake&#39;</p>',
			),
			array(
				'name' => 'Intake Customer by Anamon',
				'label' => 'Intake Customer by Anamon',
				'component' => 'CiviCase',
				'description' => '<p>Used in &#39;Projectintake&#39;</p>',
			),
			array(
				'name' => 'Assessment Project Request by Rep',
				'label' => 'Assessment Project Request by Rep',
				'component' => 'CiviCase',
				'description' => '<p>Used in &#39;Projectintake&#39;</p>',
			),
		);
	}
}
