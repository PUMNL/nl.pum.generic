<?php

class Generic_Tag_Def {

	// definitions for: Tag

	static function required() {
		return array(
			array(
				'name' => 'Institutional Donor',
				'description' => 'High-value supporter of our organization.',
				'parent_tag' => NULL,
				'used_for' => 'civicrm_contact',
			),
			array(
				'name' => 'Partner',
				'description' => 'Partner',
				'parent_tag' => NULL,
				'used_for' => 'civicrm_contact',
			),
			array(
				'name' => 'Individual donor',
				'description' => 'A person donating to PUM (one-off, repeating)',
				'parent_tag' => NULL,
				'used_for' => 'civicrm_contact',
			),
			array(
				'name' => 'Sector',
				'description' => 'Sector',
				'parent_tag' => NULL,
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'New customer',
				'description' => 'Customer who has applied for a project',
				'parent_tag' => NULL,
				'used_for' => 'civicrm_contact',
			),
			array(
				'name' => 'Multilateral organisation',
				'description' => 'Organisation receiving funding from various governments investing this in development aid',
				'parent_tag' => 'Institutional Donor',
				'used_for' => 'civicrm_contact',
			),
			array(
				'name' => 'Bank',
				'description' => 'A (development) bank investing in SMEs in developing countries, hiring PUM to grow these SMEs to the next level',
				'parent_tag' => 'Institutional Donor',
				'used_for' => 'civicrm_contact',
			),
			array(
				'name' => 'Lottery',
				'description' => 'A lottery dedicating funds to projects in developing countries',
				'parent_tag' => 'Institutional Donor',
				'used_for' => 'civicrm_contact',
			),
			array(
				'name' => 'Trust',
				'description' => 'Party executing a legacy',
				'parent_tag' => 'Institutional Donor',
				'used_for' => 'civicrm_contact',
			),
			array(
				'name' => 'Foundation',
				'description' => 'Foundation funding PUM-activities ',
				'parent_tag' => 'Partner',
				'used_for' => 'civicrm_contact',
			),
			array(
				'name' => 'NGO',
				'description' => 'NGO funding PUM-activities',
				'parent_tag' => 'Partner',
				'used_for' => 'civicrm_contact',
			),
			array(
				'name' => 'Local government',
				'description' => 'Government or government agency funding PUM-activities in their own country.',
				'parent_tag' => 'Partner',
				'used_for' => 'civicrm_contact',
			),
			array(
				'name' => 'International development agencies',
				'description' => 'Government agency of a donor country funding PUM-activities in others than their own country.  Including local branches.',
				'parent_tag' => 'Partner',
				'used_for' => 'civicrm_contact',
			),
		);
	}
}
