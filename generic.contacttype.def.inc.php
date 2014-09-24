<?php

class Generic_ContactType_Def {

	// definitions for: Contact Type

	static function required() {
		return array(
			array(
				'name' => 'Expert',
				'label' => 'Expert',
				'parent' => 'Individual',
				'description' => 'nl.pum.generic - PUM Expert',
			),
			array(
				'name' => 'Customer',
				'label' => 'Customer',
				'parent' => 'Organization',
				'description' => 'nl.pum.generic - PUM Customer',
			),
			array(
				'name' => 'Donor',
				'label' => 'Donor',
				'parent' => 'Organization',
				'description' => 'nl.pum.generic - Donor Organisation',
			),
			array(
				'name' => 'Partner',
				'label' => 'Partner',
				'parent' => 'Organization',
				'description' => 'nl.pum.generic - Partner Organisation',
			),
			array(
				'name' => 'Country',
				'label' => 'Country',
				'parent' => 'Organization',
				'description' => '',
			),
		);
	}
}
