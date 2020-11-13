<?php

class Generic_ContactType_Def {

  // definitions for: Contact Type

  static function required() {
    return array(
      array(
        'name' => 'Expert',
        'label' => 'Expert',
        'parent' => 'Individual',
        'description' => 'PUM Expert',
      ),
      array(
        'name' => 'Customer',
        'label' => 'Customer',
        'parent' => 'Organization',
        'description' => 'PUM Customer',
      ),
      array(
        'name' => 'Donor',
        'label' => 'Donor',
        'parent' => 'Organization',
        'description' => 'Donor Organisation',
      ),
      array(
        'name' => 'Country',
        'label' => 'Country',
        'parent' => 'Organization',
        'description' => 'Country',
      ),
      array(
        'name' => 'Partners',
        'label' => 'Partner',
        'parent' => 'Organization',
        'description' => 'An organisation that doesn\'t provide funds itself, but is an important key to acquiring funds from others',
      ),
      array(
        'name' => 'Staff_member',
        'label' => 'Staff member',
        'parent' => 'Individual',
        'description' => '',
      ),
      array(
        'name' => 'PUM_team',
        'label' => 'PUM team',
        'parent' => 'Individual',
        'description' => 'Team to add as role in cases',
      )
    );
  }
}
