<?php

require_once 'Misc.php';

/**
 * Collection of upgrade steps
 */
class CRM_Generic_Upgrader extends CRM_Generic_Upgrader_Base {

  // By convention, functions that look like "function upgrade_NNNN()" are
  // upgrade tasks. They are executed in order (like Drupal's hook_update_N).

  /**
   * Example: Run an external SQL script when the module is installed
   */
  public function install() {
    //$this->executeSqlFile('sql/myinstall.sql');
	Generic_ContactType::install();
	Generic_Group::install();				// mgd
	Generic_RelationshipType::install();	// mgd
	Generic_OptionGroup::install();
	Generic_Tag::install();
	Generic_ActivityType::install();
	Generic_CustomField::install();
	//upgrade process
	CRM_Generic_Upgrader::upgrade_1001(FALSE);
	CRM_Generic_Upgrader::upgrade_1002(FALSE);
	CRM_Generic_Upgrader::upgrade_1004(FALSE);
	CRM_Generic_Upgrader::upgrade_1005(FALSE);
	CRM_Generic_Upgrader::upgrade_1006(FALSE);
	CRM_Generic_Upgrader::upgrade_1007(FALSE);
	CRM_Generic_Upgrader::upgrade_1015(FALSE);
	CRM_Generic_Upgrader::upgrade_1017(FALSE);
	CRM_Generic_Upgrader::upgrade_1018(FALSE);
	// current installer covers updates to 1019
    CRM_Generic_Upgrader::upgrade_1022(FALSE);
  }

  /**
   * Example: Run an external SQL script when the module is uninstalled
   */
  public function uninstall() {
	//$this->executeSqlFile('sql/myuninstall.sql');
	// reversed order
	Generic_CustomField::uninstall();
	Generic_ActivityType::uninstall();
	Generic_Tag::uninstall();
	Generic_OptionGroup::uninstall();
	Generic_RelationshipType::uninstall();
	Generic_Group::uninstall();
	Generic_ContactType::uninstall();
  }

  /**
   * Example: Run a simple query when a module is enabled
   */
  public function enable() {
    //CRM_Core_DAO::executeQuery('UPDATE foo SET is_active = 1 WHERE bar = "whiz"');
	Generic_ContactType::enable();
	Generic_Group::enable();
	Generic_RelationshipType::enable();
	Generic_OptionGroup::enable();
	Generic_Tag::enable();
	Generic_ActivityType::enable();
	Generic_CustomField::enable();
  }

  /**
   * Example: Run a simple query when a module is disabled
   */
  public function disable() {
    //CRM_Core_DAO::executeQuery('UPDATE foo SET is_active = 0 WHERE bar = "whiz"');
	// reversed order
	Generic_CustomField::disable();
	Generic_ActivityType::disable();
	Generic_Tag::disable();
	Generic_OptionGroup::disable();
	Generic_RelationshipType::disable();
	Generic_Group::disable();
	Generic_ContactType::disable();
  }

  /**
   * Upgrade 1001 - initiating sequences for
   * 1: main activities and DSA payments
   * 2: payment lines
   */
  public function upgrade_1001($info=TRUE) {
	if ($info) {
		$this->ctx->log->info('Applying update 1001 (initiating sequences)');
	}
    if (!CRM_Generic_Misc::generic_verify_extension('nl.pum.sequence')) {
		CRM_Core_Error::fatal("Mandatory module nl.pum.sequence is not enabled!");
		return FALSE;
	};
	// sequence for main activities (and for DSA: participants)
	// 7000 to infinite, step 1, no cycle
	$params = array(
		'version' => 3,
		'q' => 'civicrm/ajax/rest',
		'name' => 'main_activity',
		'min_value' => 70000,
		'cur_value' => 70000,
	);
	$result = civicrm_api('Sequence', 'create', $params);
	if ($result['is_error']==1) {
		return FALSE;
	}
	// sequence for payment lines
	// 1 to 9999, cyclic
	$params = array(
		'version' => 3,
		'q' => 'civicrm/ajax/rest',
		'name' => 'payment_line',
		'min_value' => 1,
		'max_value' => 9999,
		'cycle' => 1,
	);
	$result = civicrm_api('Sequence', 'create', $params);
	if ($result['is_error']==1) {
		return FALSE;
	}
	return TRUE;
  }

  /**
   * Upgrade 1002 - add custom goup PUM_Case_number
   */
  public function upgrade_1002($info=TRUE) {
	if ($info) {
		$this->ctx->log->info('Applying update 1002 (add custom group PUM_Case_number)');
	}
	$this->executeCustomDataFile('xml/1002_install_custom_group.xml');
	return TRUE;
  }

  /**
    * Upgrade 1004 - alter table civicrm_case_pum
	*/
  public function upgrade_1004($info=TRUE) {
	if ($info) {
		$this->ctx->log->info('Applying update 1004 (create table civicrm_case_pum)');
	}
    // create table
    $this->executeSqlFile('sql/civicrm_case_pum_1004.sql');
    return TRUE;
  }

  /**
   * Upgrade 1005 - additional option group 'case type code' and initial case numbering
   */
  public function upgrade_1005($info=TRUE) {
	if ($info) {
		$this->ctx->log->info('Applying update 1005 (add PUM project numbering)');
	}
	$sql = '
SELECT cas.id AS case_id,
       ovl1.label,
       ovl2.value AS type_code,
       con.contact_sub_type,
       con.display_name,
       ifnull(cy1.iso_code, cy2.iso_code) AS country,
	   pum.id as pum_id,
       pum.entity_id,
       pum.case_sequence,
       pum.case_type,
       pum.case_country
  FROM civicrm_case cas
       LEFT JOIN civicrm_case_pum pum
              ON pum.entity_id = cas.id,
       civicrm_option_group ogp1,
       civicrm_option_value ovl1,
       civicrm_option_group ogp2,
       civicrm_option_value ovl2,
       civicrm_case_contact ccn,
       civicrm_contact con
       LEFT JOIN civicrm_country cy1
		          ON cy1.name = con.display_name
       LEFT JOIN civicrm_address adr
              ON adr.contact_id = con.id
			       AND adr.is_primary = 1
       LEFT JOIN civicrm_country cy2
		          ON adr.country_id = cy2.id
 WHERE     ogp1.name = \'case_type\'
       AND ovl1.option_group_id = ogp1.id
       AND cas.case_type_id = ovl1.value
       AND ogp2.name = \'case_type_code\'
       AND ovl2.option_group_id = ogp2.id
       AND ovl2.label = ovl1.label
       AND ccn.case_id = cas.id
       AND con.id = ccn.contact_id
       AND con.contact_sub_type IN (\'Customer\', \'Country\')
ORDER BY cas.id
	';
	$dao_find = CRM_Core_DAO::executeQuery($sql);
	while($dao_find->fetch()) {
		$this->_setMainActivityNumber($dao_find);
	}
	return TRUE;
  }

  /**
   * Upgrade 1006 - initiating sequences for
   * 1: main activities and DSA payments
   * 2: payment lines
   */
  public function upgrade_1006($info=TRUE) {
	if ($info) {
		$this->ctx->log->info('Applying update 1006 (initiating sequence)');
	}
    if (!CRM_Generic_Misc::generic_verify_extension('nl.pum.sequence')) {
		CRM_Core_Error::fatal("Mandatory module nl.pum.sequence is not enabled!");
		return FALSE;
	};
	// sequence for invoice numbers
	// 1 to 9999, cyclic
	$params = array(
		'version' => 3,
		'q' => 'civicrm/ajax/rest',
		'name' => 'invoice_number',
		'min_value' => 1,
		'max_value' => 9999,
		'cycle' => 1,
	);
	$result = civicrm_api('Sequence', 'create', $params);
	if ($result['is_error']==1) {
		return FALSE;
	}
	return TRUE;
  }

   /**
   * Upgrade 1007 - initiating sequence for dsa activities (surrogate for main activity)
   */
   public function upgrade_1007($info=TRUE) {
	if ($info) {
		$this->ctx->log->info('Applying update 1007 (initiating sequence)');
	}
    if (!CRM_Generic_Misc::generic_verify_extension('nl.pum.sequence')) {
		CRM_Core_Error::fatal("Mandatory module nl.pum.sequence is not enabled!");
		return FALSE;
	};
	// sequence for main activities (and for DSA: participants)
	// 7000 to infinite, step 1, no cycle (like main activity)
	$params = array(
		'version' => 3,
		'q' => 'civicrm/ajax/rest',
		'name' => 'dsa_activity',
		'min_value' => 70000,
		'cur_value' => 70000,
	);
	$result = civicrm_api('Sequence', 'create', $params);
	if ($result['is_error']==1) {
		return FALSE;
	}
	return TRUE;
  }

  /**
   * Upgrade 1008 - additional custom field
   */
  public function upgrade_1008($info=TRUE) {
	if ($info) {
		$this->ctx->log->info('Applying update 1008 (create additional custom fields)');
	}
    Generic_CustomField::install();
    return TRUE;
  }

  /**
   * Upgrade 1009 - additional custom group and option groups
   */
  public function upgrade_1009($info=TRUE) {
	if ($info) {
		$this->ctx->log->info('Applying update 1009 (additional custom group and option groups)');
	}
	Generic_OptionGroup::install();
    Generic_CustomField::install();
    return TRUE;
  }

  /**
   * Upgrade 1010 - additional activity type
   */
  public function upgrade_1010($info=TRUE) {
	if ($info) {
		$this->ctx->log->info('Applying update 1010 (additional activity type)');
	}
	Generic_ActivityType::install();
	return TRUE;
  }

  /**
   * Upgrade 1011 - additional entities in all areas
   */
  public function upgrade_1011($info=TRUE) {
	if ($info) {
		$this->ctx->log->info('Applying update 1011 (additional entities)');
	}
	Generic_ContactType::install();
	Generic_Group::install();
	Generic_RelationshipType::install();
	Generic_OptionGroup::install();
	Generic_CustomField::install();
	Generic_Tag::install();
	Generic_ActivityType::install();
	return TRUE;
  }

  /**
   * Upgrade 1012 - additional entities in all areas
   */
  public function upgrade_1012($info=TRUE) {
	if ($info) {
		$this->ctx->log->info('Applying update 1012 (fix for custom group targetting)');
	}
	Generic_CustomField::fix_targeting();
	return TRUE;
  }

  /**
   * Upgrade 1013 - additional entities in all areas (template 1.2)
   */
  public function upgrade_1013($info=TRUE) {
	if ($info) {
		$this->ctx->log->info('Applying update 1013 (additional entities for template 1.2)');
	}
	Generic_ContactType::install();
	Generic_Group::install();
	Generic_RelationshipType::install();
	Generic_OptionGroup::install();
	Generic_Tag::install();
	Generic_ActivityType::install();
	Generic_CustomField::install();
	Generic_CustomField::fix_targeting();
	return TRUE;
  }

  /**
   * Upgrade 1014 - additional entities in all areas (template 1.3)
   */
  public function upgrade_1014($info=TRUE) {
	if ($info) {
		$this->ctx->log->info('Applying update 1014 (entities for template 1.3)');
	}
	Generic_ContactType::install();
	Generic_Group::install();
	Generic_RelationshipType::install();
	Generic_OptionGroup::install();
	Generic_Tag::install();
	Generic_ActivityType::install();
	Generic_CustomField::install();
	return TRUE;
  }

  /**
   * Upgrade 1015 - change custom group PUM_Case_number (template 1.4)
   */
  public function upgrade_1015($info=TRUE) {
	if ($info) {
		$this->ctx->log->info('Applying update 1015 (PUM_Case_number)');
	}

	$entitiesTranslation = Generic_CustomField::getEntityTranslations();
	$tgt = array(
			'TravelCase',
			'Advice',
			'Seminar',
			'Business',
			'RemoteCoaching',
			'PDV',
			'CTM',
			'Grant',
	);
	$extends_column_value = array();
	foreach($tgt as $entity) {
		if (array_key_exists($entity, $entitiesTranslation['Case'])) {
			$extends_column_value[] = $entitiesTranslation['Case'][$entity];
		} else {
			$extends_column_value[] = $entity;
		}
	}
	$extends_column_value = CRM_Core_DAO::VALUE_SEPARATOR . implode(CRM_Core_DAO::VALUE_SEPARATOR, $extends_column_value) . CRM_Core_DAO::VALUE_SEPARATOR;

	$params = array(
		'q' => 'civicrm/ajax/rest',
		'sequential' => 1,
		'name' => 'PUM_Case_number',
	);
	$result = civicrm_api3('CustomGroup', 'get', $params);
	$fieldGroup = $result['values'][0];

	$params = array(
		'id'							=>	$fieldGroup['id'],
		'name'							=>	$fieldGroup['name'],
		'title'							=>	$fieldGroup['title'],
		'extends'						=>	$fieldGroup['extends'],
		'extends_entity_column_value'	=>	$extends_column_value,
		'title'							=>	$fieldGroup['group_title'],
		'name'							=>	$fieldGroup['group_name'],
		'style'							=>	$fieldGroup['style'],
		'collapse_display'				=>	$fieldGroup['collapse_display'],
		'collapse_adv_display'			=>	$fieldGroup['collapse_adv_display'],
		'is_multiple'					=>	$fieldGroup['is_multiple'],
		'help_pre'						=>	$fieldGroup['help_pre'],
		'help_post'						=>	$fieldGroup['help_post'],
		'is_active'						=>	$fieldGroup['is_active'],
	);

	$result = civicrm_api3('CustomGroup', 'Create', $params);

	return TRUE;
  }

  /**
   * Upgrade 1016 - reinstall for activitytypes
   */
  public function upgrade_1016($info=TRUE) {
	if ($info) {
		$this->ctx->log->info('Applying update 1016 (reinstall activity types)');
	}
	Generic_ActivityType::install();
	Generic_CustomField::fix_targeting();
	return TRUE;
  }

  /**
   * Upgrade 1017 - add (event) participant status
   */
  public function upgrade_1017($info=TRUE) {
	if ($info) {
		$this->ctx->log->info('Applying update 1017 (add participant status)');
	}
	$params = array(
		'q' => 'civicrm/ajax/rest',
		'sequential' => 1,
		'name' => 'Invited',
		'label' => 'Invited',
		'class' => 'Waiting',
		'is_active' => 1,
		'is_counted' => 0,
		'weight' => 14,
		'visibility_id' => 'Admin',
	);
	$result = civicrm_api3('ParticipantStatusType', 'create', $params);
	return TRUE;
  }

  /**
   * Upgrade 1018 - remove option value Gender->Transgender
   */
  public function upgrade_1018($info=TRUE) {
	if ($info) {
		$this->ctx->log->info('Applying update 1018 (remove option value Gender->Transgender)');
	}
	$result = Generic_OptionGroup::remove_optionvalue('gender', 'Transgender');
	return $result;
  }

  /**
   * Upgrade 1019 - additional custom group and option groups
   */
  public function upgrade_1019($info=TRUE) {
	if ($info) {
		$this->ctx->log->info('Applying update 1019 (additional custom group and option groups)');
	}
	Generic_OptionGroup::install();
    Generic_CustomField::install();
    return TRUE;
  }

  /**
   * Upgrade 1020 - additional custom group pum_history
   */
  public function upgrade_1020($info=TRUE) {
	if ($info) {
		$this->ctx->log->info('Applying update 1020 (additional custom group pum_history)');
	}
	Generic_CustomField::install();
    return TRUE;
  }

  /**
   * Upgrade 1021 - additional custom group pum_history
   */
  public function upgrade_1021($info=TRUE) {
  	if ($info) {
		$this->ctx->log->info('Applying update 1021 (customisation to custom group pum_history)');
	}

	//Check for existing custom groups and remove it
	$params = array(
	  'version' => 3,
  	  'sequential' => 1,
  	  'name' => 'PUM_History',
	);
	$result = civicrm_api('CustomGroup', 'get', $params);
	$this->ctx->log->info($result);

	if ($result['count'] > 0) {
		//Delete custom group
		$params = array(
		  'version' => 3,
		  'sequential' => 1,
		  'id' => $result['values'][0]['id'],
		);
		$result = civicrm_api('CustomGroup', 'delete', $params);
		$this->ctx->log->info($result);
	}

	return TRUE;
  }

  /**
   * Upgrade 1022 - additional custom group pum_history
   */
  public function upgrade_1022($info=TRUE) {
  	if ($info) {
		$this->ctx->log->info('Applying update 1022 (customisation to custom group prins_history)');
	}

	//Check for existing custom groups and remove it
	$params = array(
	  'version' => 3,
  	  'sequential' => 1,
  	  'name' => 'prins_history',
	);
	$result = civicrm_api('CustomGroup', 'get', $params);
	$this->ctx->log->info($result);

	if ($result['count'] > 0) {
		//Delete custom group
		$params = array(
		  'version' => 3,
		  'sequential' => 1,
		  'id' => $result['values'][0]['id'],
		);
		$result = civicrm_api('CustomGroup', 'delete', $params);
		$this->ctx->log->info($result);
	}

	if ($result['is_error'] == 0) {
		//Install new custom group
		$this->executeCustomDataFile('xml/1022_install_custom_group.xml');
	} else {
		return FALSE;
	}

	return TRUE;
  }

  public function upgrade_1023() {
    $case_type = civicrm_api3('OptionGroup', 'getvalue', array('return' => 'id', 'name' => 'case_type'));
    civicrm_api3('OptionValue', 'create', array(
      'option_group_id' => $case_type,
      'name' => 'FactFinding',
      'label' => 'FactFinding',
      'value' => '16',
      'weight' => 51,
      'description' => '<p>A Main Activity of the type FactFinding</p>',
    ));

    $case_type_code = civicrm_api3('OptionGroup', 'getvalue', array('return' => 'id', 'name' => 'case_type_code'));
    civicrm_api3('OptionValue', 'create', array(
      'option_group_id' => $case_type_code,
      'name' => 'FactFinding',
      'label' => 'FactFinding',
      'value' => 'F',
      'weight' => 61,
      'description' => '',
    ));
    return TRUE;
  }

  public function upgrade_1024() {
    $case_types = CRM_Core_DAO::VALUE_SEPARATOR.'15'.CRM_Core_DAO::VALUE_SEPARATOR.'16'.CRM_Core_DAO::VALUE_SEPARATOR;

    CRM_Core_DAO::executeQuery("UPDATE civicrm_option_value SET label = 'PDV/Fact Finding Programme' WHERE `name` = 'PDV Programme' and option_group_id = 2");
    CRM_Core_DAO::executeQuery("UPDATE civicrm_custom_group SET title = 'PDV/Fact Finding Programme'  WHERE `name` = 'PDV_Programme'");
    CRM_Core_DAO::executeQuery("UPDATE civicrm_custom_group SET title = 'PDV/Fact Finding Budget', extends_entity_column_value = '{$case_types}' WHERE `name` = 'PDV_Budget'");
    return true;
  }

  public function upgrade_1025() {
    $customer_data = civicrm_api3('CustomGroup', 'getvalue', array('return' => 'id', 'name' => 'Customers_Data'));
    civicrm_api3('CustomField', 'create', array(
      'name' => 'gender_entrepeneur',
      'label' => 'What is the gender of the entrepreneur?',
      'data_type' => 'int',
      'html_type' => 'Select',
      'default_value' => NULL,
      'is_required' => FALSE,
      'is_view' => FALSE,
      'is_searchable' => FALSE,
      'is_search_range' => FALSE,
      'weight' => 291,
      'help_pre' => NULL,
      'help_post' => NULL,
      'attributes' => NULL,
      'options_per_line' => NULL,
      'text_length' => 255,
      'start_date_years' => NULL,
      'end_date_years' => NULL,
      'date_format' => NULL,
      'time_format' => NULL,
      'note_columns' => 60,
      'note_rows' => 4,
      'option_group_id' => 3, //gender
      'custom_group_id' => $customer_data,
    ));
    civicrm_api3('CustomField', 'create',           array(
      'name' => 'birthyear_entrepeneur',
      'label' => 'What is the year of birth of the entrepreneur?',
      'data_type' => 'int',
      'html_type' => 'Text',
      'default_value' => NULL,
      'is_required' => FALSE,
      'is_view' => FALSE,
      'is_searchable' => FALSE,
      'is_search_range' => FALSE,
      'weight' => 292,
      'help_pre' => NULL,
      'help_post' => NULL,
      'attributes' => NULL,
      'options_per_line' => NULL,
      'text_length' => 255,
      'start_date_years' => NULL,
      'end_date_years' => NULL,
      'date_format' => NULL,
      'time_format' => NULL,
      'note_columns' => 60,
      'note_rows' => 4,
      'option_group_name' => NULL,
      'custom_group_id' => $customer_data,
    ));
    return true;
  }

  /**
   * CRM_Generic_Upgrader::upgrade_1026()
   *
   * Update activity 'Intake Customer by Anamon' to 'Intake Customer by PrOf'
   *
   * @return
   */
  public function upgrade_1026() {
    //Change activity 'Intake Customer by Anamon' to 'Intake Customer by PrOf'
    //first get option value id of activity
    $params_og_id_intakeanamon = array(
      'version' => 3,
      'sequential' => 1,
      'option_group_name' => 'activity_type',
      'label' => 'Intake Customer by Anamon',
      'return' => 'id',
    );
    $ov_id_intakeanamon = civicrm_api('OptionValue', 'getvalue', $params_og_id_intakeanamon);

    //then update activity 'Intake Customer by Anamon' to 'Intake Customer by PrOf'
    $params_ov_update_intakeanamon = array(
      'version' => 3,
      'sequential' => 1,
      'id'=> $ov_id_intakeanamon,
      'label' => 'Intake Customer by PrOf',
      'name' => 'Intake Customer by PrOf'
    );
    $result_ov_update_intakeanamon = civicrm_api('OptionValue', 'update', $params_ov_update_intakeanamon);

    if(!empty($result_ov_update_intakeanamon['is_error']) && $result_ov_update_intakeanamon['is_error'] == 1){
      return FALSE;
    }

    //then change custom group 'Intake Customer by Anamon' to 'Intake Customer by PrOf'
    //first get custom group id
    $params_cg_id_intakeanamon = array(
      'version' => 3,
      'sequential' => 1,
      'title' => 'Intake Customer by Anamon',
      'return' => 'id',
    );
    $cg_id_intakeanamon = civicrm_api('CustomGroup', 'getvalue', $params_cg_id_intakeanamon);

    //then update custom group name 'Intake Customer by Anamon' to 'Intake Customer by PrOf'
    $params_cg_update_intakeanamon = array(
      'version' => 3,
      'sequential' => 1,
      'id'=> $cg_id_intakeanamon,
      'title' => 'Intake Customer by PrOf',
    );
    $result_cg_update_intakeanamon = civicrm_api('CustomGroup', 'update', $params_cg_update_intakeanamon);

    if(!empty($result_cg_update_intakeanamon['is_error']) && $result_cg_update_intakeanamon['is_error'] == 1){
      return FALSE;
    }

    $params_cg_id_doyouapprovecustomer = array(
      'version' => 3,
      'sequential' => 1,
      'title' => 'Do you approve the Customer?',
      'return' => 'id',
    );
    $cg_id_doyouapprovecustomer = civicrm_api('OptionGroup', 'getvalue', $params_cg_id_doyouapprovecustomer);

    $params_cg_update_doyouapprovecustomer = array(
      'version' => 3,
      'sequential' => 1,
      'option_group_id' => $cg_id_doyouapprovecustomer,
      'value' => 'No check Anamon',
      'return' => 'id',
    );
    $result_cg_update_doyouapprovecustomer = civicrm_api('OptionValue', 'getvalue', $params_cg_update_doyouapprovecustomer);

    $params_ov_update_doyouapprovecustomer = array(
      'version' => 3,
      'sequential' => 1,
      'id' => $result_cg_update_doyouapprovecustomer,
      'label' => 'No check PrOf',
      'value' => 'No check PrOf',
    );
    $result_ov_update_doyouapprovecustomer = civicrm_api('OptionValue', 'update', $params_ov_update_doyouapprovecustomer);


    return TRUE;
  }

  /**
   * Upgrade 1027 - add activity Contact with Customer by Rep
   */
  public function upgrade_1027($info=TRUE) {
    if ($info) {
      $this->ctx->log->info('Applying update 1027, reinstall activity types in order to add Contact with Customer by Rep');
    }
    Generic_ActivityType::install();
    Generic_CustomField::fix_targeting();
    return TRUE;
  }

  /**
   * Upgrade 1028 - update weight values of managed entities
   */
  public function upgrade_1028($info=TRUE) {
    if ($info) {
      $this->ctx->log->info('Applying update 1028, fix custom field order');
    }
    $result = array();
    $dao = CRM_Core_DAO::executeQuery("UPDATE `civicrm_custom_group` SET `weight` = 52, `collapse_display` = 1, `collapse_adv_display` = 0 WHERE `name` = 'main_activity_info'");
    if($dao->N == 1) {
      $result['main_activity_info'] = 1;
    } else {
      $result['main_activity_info'] = 0;
    }
    $dao = CRM_Core_DAO::executeQuery("UPDATE `civicrm_custom_group` SET `weight` = 51, `collapse_display` = 0, `collapse_adv_display` = 0 WHERE `name` = 'Add_Keyqualifications'");
    if($dao->N == 1) {
      $result['Add_Keyqualifications'] = 1;
    } else {
      $result['Add_Keyqualifications'] = 0;
    }
    $dao = CRM_Core_DAO::executeQuery("UPDATE `civicrm_custom_group` SET `weight` = 50, `collapse_display` = 0, `collapse_adv_display` = 0 WHERE `name` = 'Acquisition'");
    if($dao->N == 1) {
      $result['Acquisition'] = 1;
    } else {
      $result['Acquisition'] = 0;
    }
    $dao = CRM_Core_DAO::executeQuery("UPDATE `civicrm_custom_group` SET `weight` = 49, `collapse_display` = 0, `collapse_adv_display` = 0 WHERE `name` = 'Activity_Information_by_CC'");
    if($dao->N == 1) {
      $result['Activity_Information_by_CC'] = 1;
    } else {
      $result['Activity_Information_by_CC'] = 0;
    }
    $dao = CRM_Core_DAO::executeQuery("UPDATE `civicrm_custom_group` SET `weight` = 48, `collapse_display` = 0, `collapse_adv_display` = 0 WHERE `name` = 'Additional_Data'");
    if($dao->N == 1) {
      $result['Additional_Data'] = 1;
    } else {
      $result['Additional_Data'] = 0;
    }
    $dao = CRM_Core_DAO::executeQuery("UPDATE `civicrm_custom_group` SET `weight` = 47, `collapse_display` = 0, `collapse_adv_display` = 0 WHERE `name` = 'Advice_Debriefing_CC'");
    if($dao->N == 1) {
      $result['Advice_Debriefing_CC'] = 1;
    } else {
      $result['Advice_Debriefing_CC'] = 0;
    }
    $dao = CRM_Core_DAO::executeQuery("UPDATE `civicrm_custom_group` SET `weight` = 46, `collapse_display` = 0, `collapse_adv_display` = 0 WHERE `name` = 'Advice_Debriefing_PrOf'");
    if($dao->N == 1) {
      $result['Advice_Debriefing_PrOf'] = 1;
    } else {
      $result['Advice_Debriefing_PrOf'] = 0;
    }
    $dao = CRM_Core_DAO::executeQuery("UPDATE `civicrm_custom_group` SET `weight` = 45, `collapse_display` = 0, `collapse_adv_display` = 0 WHERE `name` = 'Advice_Debriefing_SC'");
    if($dao->N == 1) {
      $result['Advice_Debriefing_SC'] = 1;
    } else {
      $result['Advice_Debriefing_SC'] = 0;
    }
    $dao = CRM_Core_DAO::executeQuery("UPDATE `civicrm_custom_group` SET `weight` = 44, `collapse_display` = 0, `collapse_adv_display` = 0 WHERE `name` = 'Assessment_Country_Project_by_CFO'");
    if($dao->N == 1) {
      $result['Assessment_Country_Project_by_CFO'] = 1;
    } else {
      $result['Assessment_Country_Project_by_CFO'] = 0;
    }
    $dao = CRM_Core_DAO::executeQuery("UPDATE `civicrm_custom_group` SET `weight` = 43, `collapse_display` = 0, `collapse_adv_display` = 0 WHERE `name` = 'Assessment_Project_Request_by_Rep'");
    if($dao->N == 1) {
      $result['Assessment_Project_Request_by_Rep'] = 1;
    } else {
      $result['Assessment_Project_Request_by_Rep'] = 0;
    }
    $dao = CRM_Core_DAO::executeQuery("UPDATE `civicrm_custom_group` SET `weight` = 42, `collapse_display` = 0, `collapse_adv_display` = 0 WHERE `name` = 'Bank_Information'");
    if($dao->N == 1) {
      $result['Bank_Information'] = 1;
    } else {
      $result['Bank_Information'] = 0;
    }
    $dao = CRM_Core_DAO::executeQuery("UPDATE `civicrm_custom_group` SET `weight` = 41, `collapse_display` = 0, `collapse_adv_display` = 0 WHERE `name` = 'Briefing_Expert'");
    if($dao->N == 1) {
      $result['Briefing_Expert'] = 1;
    } else {
      $result['Briefing_Expert'] = 0;
    }
    $dao = CRM_Core_DAO::executeQuery("UPDATE `civicrm_custom_group` SET `weight` = 40, `collapse_display` = 1, `collapse_adv_display` = 0 WHERE `name` = 'Business_Data'");
    if($dao->N == 1) {
      $result['Business_Data'] = 1;
    } else {
      $result['Business_Data'] = 0;
    }
    $dao = CRM_Core_DAO::executeQuery("UPDATE `civicrm_custom_group` SET `weight` = 118, `collapse_display` = 0, `collapse_adv_display` = 1 WHERE `name` = 'Condition'");
    if($dao->N == 1) {
      $result['Condition'] = 1;
    } else {
      $result['Condition'] = 0;
    }
    $dao = CRM_Core_DAO::executeQuery("UPDATE `civicrm_custom_group` SET `weight` = 38, `collapse_display` = 0, `collapse_adv_display` = 0 WHERE `name` = 'Contribution'");
    if($dao->N == 1) {
      $result['Contribution'] = 1;
    } else {
      $result['Contribution'] = 0;
    }
    $dao = CRM_Core_DAO::executeQuery("UPDATE `civicrm_custom_group` SET `weight` = 37, `collapse_display` = 0, `collapse_adv_display` = 0 WHERE `name` = 'Cooperation'");
    if($dao->N == 1) {
      $result['Cooperation'] = 1;
    } else {
      $result['Cooperation'] = 0;
    }
    $dao = CRM_Core_DAO::executeQuery("UPDATE `civicrm_custom_group` SET `weight` = 36, `collapse_display` = 0, `collapse_adv_display` = 0 WHERE `name` = 'pumCountry'");
    if($dao->N == 1) {
      $result['pumCountry'] = 1;
    } else {
      $result['pumCountry'] = 0;
    }
    $dao = CRM_Core_DAO::executeQuery("UPDATE `civicrm_custom_group` SET `weight` = 35, `collapse_display` = 0, `collapse_adv_display` = 0 WHERE `name` = 'CTM_Event_information'");
    if($dao->N == 1) {
      $result['CTM_Event_information'] = 1;
    } else {
      $result['CTM_Event_information'] = 0;
    }
    $dao = CRM_Core_DAO::executeQuery("UPDATE `civicrm_custom_group` SET `weight` = 34, `collapse_display` = 1, `collapse_adv_display` = 0 WHERE `name` = 'Customer_dis_agreement_of_Proposed_Expert'");
    if($dao->N == 1) {
      $result['Customer_dis_agreement_of_Proposed_Expert'] = 1;
    } else {
      $result['Customer_dis_agreement_of_Proposed_Expert'] = 0;
    }
    $dao = CRM_Core_DAO::executeQuery("UPDATE `civicrm_custom_group` SET `weight` = 33, `collapse_display` = 0, `collapse_adv_display` = 0 WHERE `name` = 'Customers_Data'");
    if($dao->N == 1) {
      $result['Customers_Data'] = 1;
    } else {
      $result['Customers_Data'] = 0;
    }
    $dao = CRM_Core_DAO::executeQuery("UPDATE `civicrm_custom_group` SET `weight` = 32, `collapse_display` = 0, `collapse_adv_display` = 0 WHERE `name` = 'Donor_details_FA'");
    if($dao->N == 1) {
      $result['Donor_details_FA'] = 1;
    } else {
      $result['Donor_details_FA'] = 0;
    }
    $dao = CRM_Core_DAO::executeQuery("UPDATE `civicrm_custom_group` SET `weight` = 31, `collapse_display` = 0, `collapse_adv_display` = 0 WHERE `name` = 'Education'");
    if($dao->N == 1) {
      $result['Education'] = 1;
    } else {
      $result['Education'] = 0;
    }
    $dao = CRM_Core_DAO::executeQuery("UPDATE `civicrm_custom_group` SET `weight` = 30, `collapse_display` = 1, `collapse_adv_display` = 0 WHERE `name` = 'Event_information'");
    if($dao->N == 1) {
      $result['Event_information'] = 1;
    } else {
      $result['Event_information'] = 0;
    }
    $dao = CRM_Core_DAO::executeQuery("UPDATE `civicrm_custom_group` SET `weight` = 29, `collapse_display` = 0, `collapse_adv_display` = 0 WHERE `name` = 'expert_data'");
    if($dao->N == 1) {
      $result['expert_data'] = 1;
    } else {
      $result['expert_data'] = 0;
    }
    $dao = CRM_Core_DAO::executeQuery("UPDATE `civicrm_custom_group` SET `weight` = 28, `collapse_display` = 0, `collapse_adv_display` = 0 WHERE `name` = 'Flight_details'");
    if($dao->N == 1) {
      $result['Flight_details'] = 1;
    } else {
      $result['Flight_details'] = 0;
    }
    $dao = CRM_Core_DAO::executeQuery("UPDATE `civicrm_custom_group` SET `weight` = 27, `collapse_display` = 0, `collapse_adv_display` = 0 WHERE `name` = 'Focus'");
    if($dao->N == 1) {
      $result['Focus'] = 1;
    } else {
      $result['Focus'] = 0;
    }
    $dao = CRM_Core_DAO::executeQuery("UPDATE `civicrm_custom_group` SET `weight` = 26, `collapse_display` = 0, `collapse_adv_display` = 0 WHERE `name` = 'In_Case_of_Emergency_Contact'");
    if($dao->N == 1) {
      $result['In_Case_of_Emergency_Contact'] = 1;
    } else {
      $result['In_Case_of_Emergency_Contact'] = 0;
    }
    $dao = CRM_Core_DAO::executeQuery("UPDATE `civicrm_custom_group` SET `weight` = 25, `collapse_display` = 0, `collapse_adv_display` = 0 WHERE `name` = 'Intake_Customer_by_Anamon'");
    if($dao->N == 1) {
      $result['Intake_Customer_by_Anamon'] = 1;
    } else {
      $result['Intake_Customer_by_Anamon'] = 0;
    }
    $dao = CRM_Core_DAO::executeQuery("UPDATE `civicrm_custom_group` SET `weight` = 24, `collapse_display` = 0, `collapse_adv_display` = 0 WHERE `name` = 'Intake_Customer_by_CC'");
    if($dao->N == 1) {
      $result['Intake_Customer_by_CC'] = 1;
    } else {
      $result['Intake_Customer_by_CC'] = 0;
    }
    $dao = CRM_Core_DAO::executeQuery("UPDATE `civicrm_custom_group` SET `weight` = 23, `collapse_display` = 0, `collapse_adv_display` = 0 WHERE `name` = 'Intake_Customer_by_SC'");
    if($dao->N == 1) {
      $result['Intake_Customer_by_SC'] = 1;
    } else {
      $result['Intake_Customer_by_SC'] = 0;
    }
    $dao = CRM_Core_DAO::executeQuery("UPDATE `civicrm_custom_group` SET `weight` = 22, `collapse_display` = 0, `collapse_adv_display` = 0 WHERE `name` = 'Intake'");
    if($dao->N == 1) {
      $result['Intake'] = 1;
    } else {
      $result['Intake'] = 0;
    }
    $dao = CRM_Core_DAO::executeQuery("UPDATE `civicrm_custom_group` SET `weight` = 21, `collapse_display` = 0, `collapse_adv_display` = 0 WHERE `name` = 'Languages'");
    if($dao->N == 1) {
      $result['Languages'] = 1;
    } else {
      $result['Languages'] = 0;
    }
    $dao = CRM_Core_DAO::executeQuery("UPDATE `civicrm_custom_group` SET `weight` = 20, `collapse_display` = 0, `collapse_adv_display` = 0 WHERE `name` = 'Medical_Information'");
    if($dao->N == 1) {
      $result['Medical_Information'] = 1;
    } else {
      $result['Medical_Information'] = 0;
    }
    $dao = CRM_Core_DAO::executeQuery("UPDATE `civicrm_custom_group` SET `weight` = 19, `collapse_display` = 0, `collapse_adv_display` = 0 WHERE `name` = 'Passport_Information'");
    if($dao->N == 1) {
      $result['Passport_Information'] = 1;
    } else {
      $result['Passport_Information'] = 0;
    }
    $dao = CRM_Core_DAO::executeQuery("UPDATE `civicrm_custom_group` SET `weight` = 18, `collapse_display` = 0, `collapse_adv_display` = 0 WHERE `name` = 'Payment_Grant'");
    if($dao->N == 1) {
      $result['Payment_Grant'] = 1;
    } else {
      $result['Payment_Grant'] = 0;
    }
    $dao = CRM_Core_DAO::executeQuery("UPDATE `civicrm_custom_group` SET `weight` = 17, `collapse_display` = 0, `collapse_adv_display` = 0 WHERE `name` = 'PDV_Budget'");
    if($dao->N == 1) {
      $result['PDV_Budget'] = 1;
    } else {
      $result['PDV_Budget'] = 0;
    }
    $dao = CRM_Core_DAO::executeQuery("UPDATE `civicrm_custom_group` SET `weight` = 16, `collapse_display` = 0, `collapse_adv_display` = 0 WHERE `name` = 'PDV_Programme'");
    if($dao->N == 1) {
      $result['PDV_Programme'] = 1;
    } else {
      $result['PDV_Programme'] = 0;
    }
    $dao = CRM_Core_DAO::executeQuery("UPDATE `civicrm_custom_group` SET `weight` = 15, `collapse_display` = 1, `collapse_adv_display` = 0 WHERE `name` = 'Projectinformation'");
    if($dao->N == 1) {
      $result['Projectinformation'] = 1;
    } else {
      $result['Projectinformation'] = 0;
    }
    $dao = CRM_Core_DAO::executeQuery("UPDATE `civicrm_custom_group` SET `weight` = 123, `collapse_display` = 1, `collapse_adv_display` = 0 WHERE `name` = 'Interview_Information'");
    if($dao->N == 1) {
      $result['Interview_Information'] = 1;
    } else {
      $result['Interview_Information'] = 0;
    }
    $dao = CRM_Core_DAO::executeQuery("UPDATE `civicrm_custom_group` SET `weight` = 14, `collapse_display` = 1, `collapse_adv_display` = 0 WHERE `name` = 'Reject_Main_Activity_Proposal'");
    if($dao->N == 1) {
      $result['Reject_Main_Activity_Proposal'] = 1;
    } else {
      $result['Reject_Main_Activity_Proposal'] = 0;
    }
    $dao = CRM_Core_DAO::executeQuery("UPDATE `civicrm_custom_group` SET `weight` = 121, `collapse_display` = 1, `collapse_adv_display` = 0, `title` = 'Approval (process) Expert Application' WHERE `name` = 'Approval_process_Expert_Application'");
    if($dao->N == 1) {
      $result['Approval_process_Expert_Application'] = 1;
    } else {
      $result['Approval_process_Expert_Application'] = 0;
    }
    $dao = CRM_Core_DAO::executeQuery("UPDATE `civicrm_custom_group` SET `weight` = 122, `collapse_display` = 1, `collapse_adv_display` = 0, `title` = 'Rejection Expert Application' WHERE `name` = 'Assessment_Expert_Application'");
    if($dao->N == 1) {
      $result['Assessment_Expert_Application'] = 1;
    } else {
      $result['Assessment_Expert_Application'] = 0;
    }
    $dao = CRM_Core_DAO::executeQuery("UPDATE `civicrm_custom_group` SET `weight` = 13, `collapse_display` = 0, `collapse_adv_display` = 0 WHERE `name` = 'Remote_Coaching_Debriefing_CC'");
    if($dao->N == 1) {
      $result['Remote_Coaching_Debriefing_CC'] = 1;
    } else {
      $result['Remote_Coaching_Debriefing_CC'] = 0;
    }
    $dao = CRM_Core_DAO::executeQuery("UPDATE `civicrm_custom_group` SET `weight` = 12, `collapse_display` = 0, `collapse_adv_display` = 0 WHERE `name` = 'Remote_Coaching_Debriefing_PrOf'");
    if($dao->N == 1) {
      $result['Remote_Coaching_Debriefing_PrOf'] = 1;
    } else {
      $result['Remote_Coaching_Debriefing_PrOf'] = 0;
    }
    $dao = CRM_Core_DAO::executeQuery("UPDATE `civicrm_custom_group` SET `weight` = 11, `collapse_display` = 0, `collapse_adv_display` = 0 WHERE `name` = 'Remote_Coaching_Debriefing_SC'");
    if($dao->N == 1) {
      $result['Remote_Coaching_Debriefing_SC'] = 1;
    } else {
      $result['Remote_Coaching_Debriefing_SC'] = 0;
    }
    $dao = CRM_Core_DAO::executeQuery("UPDATE `civicrm_custom_group` SET `weight` = 10, `collapse_display` = 0, `collapse_adv_display` = 0 WHERE `name` = 'Seminar_Debriefing_CC'");
    if($dao->N == 1) {
      $result['Seminar_Debriefing_CC'] = 1;
    } else {
      $result['Seminar_Debriefing_CC'] = 0;
    }
    $dao = CRM_Core_DAO::executeQuery("UPDATE `civicrm_custom_group` SET `weight` = 9, `collapse_display` = 0, `collapse_adv_display` = 0 WHERE `name` = 'Seminar_Debriefing_PrOf'");
    if($dao->N == 1) {
      $result['Seminar_Debriefing_PrOf'] = 1;
    } else {
      $result['Seminar_Debriefing_PrOf'] = 0;
    }
    $dao = CRM_Core_DAO::executeQuery("UPDATE `civicrm_custom_group` SET `weight` = 8, `collapse_display` = 0, `collapse_adv_display` = 0 WHERE `name` = 'Seminar_Debriefing_SC'");
    if($dao->N == 1) {
      $result['Seminar_Debriefing_SC'] = 1;
    } else {
      $result['Seminar_Debriefing_SC'] = 0;
    }
    $dao = CRM_Core_DAO::executeQuery("UPDATE `civicrm_custom_group` SET `weight` = 7, `collapse_display` = 0, `collapse_adv_display` = 0 WHERE `name` = 'Opportunity Outline'");
    if($dao->N == 1) {
      $result['Opportunity Outline'] = 1;
    } else {
      $result['Opportunity Outline'] = 0;
    }
    $dao = CRM_Core_DAO::executeQuery("UPDATE `civicrm_custom_group` SET `weight` = 6, `collapse_display` = 0, `collapse_adv_display` = 0 WHERE `name` = 'Workhistory'");
    if($dao->N == 1) {
      $result['Workhistory'] = 1;
    } else {
      $result['Workhistory'] = 0;
    }
    $dao = CRM_Core_DAO::executeQuery("UPDATE `civicrm_custom_group` SET `weight` = 5, `collapse_display` = 0, `collapse_adv_display` = 0 WHERE `name` = 'Employee_Information'");
    if($dao->N == 1) {
      $result['Employee_Information'] = 1;
    } else {
      $result['Employee_Information'] = 0;
    }
    $dao = CRM_Core_DAO::executeQuery("UPDATE `civicrm_custom_group` SET `weight` = 115, `collapse_display` = 0, `collapse_adv_display` = 1 WHERE `name` = 'Business_Debriefing_SC'");
    if($dao->N == 1) {
      $result['Business_Debriefing_SC'] = 1;
    } else {
      $result['Business_Debriefing_SC'] = 0;
    }
    $dao = CRM_Core_DAO::executeQuery("UPDATE `civicrm_custom_group` SET `weight` = 119, `collapse_display` = 0, `collapse_adv_display` = 1 WHERE `name` = 'Exit_Expert'");
    if($dao->N == 1) {
      $result['Exit_Expert'] = 1;
    } else {
      $result['Exit_Expert'] = 0;
    }
    $dao = CRM_Core_DAO::executeQuery("UPDATE `civicrm_custom_group` SET `weight` = 53, `collapse_display` = 1, `collapse_adv_display` = 0 WHERE `name` = 'PUM_Case_number'");
    if($dao->N == 1) {
      $result['PUM_Case_number'] = 1;
    } else {
      $result['PUM_Case_number'] = 0;
    }
    $dao = CRM_Core_DAO::executeQuery("UPDATE `civicrm_custom_group` SET `weight` = 97, `collapse_display` = 0, `collapse_adv_display` = 0 WHERE `name` = 'Nationality'");
    if($dao->N == 1) {
      $result['Nationality'] = 1;
    } else {
      $result['Nationality'] = 0;
    }
    $dao = CRM_Core_DAO::executeQuery("UPDATE `civicrm_custom_group` SET `weight` = 53, `collapse_display` = 0, `collapse_adv_display` = 0 WHERE `name` = 'Adresgegevens'");
    if($dao->N == 1) {
      $result['Adresgegevens'] = 1;
    } else {
      $result['Adresgegevens'] = 0;
    }
    $dao = CRM_Core_DAO::executeQuery("UPDATE `civicrm_custom_group` SET `weight` = 102, `collapse_display` = 1, `collapse_adv_display` = 0 WHERE `name` = 'visibility_of_main_activity'");
    if($dao->N == 1) {
      $result['visibility_of_main_activity'] = 1;
    } else {
      $result['visibility_of_main_activity'] = 0;
    }
    $dao = CRM_Core_DAO::executeQuery("UPDATE `civicrm_custom_group` SET `weight` = 111, `collapse_display` = 1, `collapse_adv_display` = 1 WHERE `name` = 'travel_data'");
    if($dao->N == 1) {
      $result['travel_data'] = 1;
    } else {
      $result['travel_data'] = 0;
    }
    $dao = CRM_Core_DAO::executeQuery("UPDATE `civicrm_custom_group` SET `weight` = 112, `collapse_display` = 1, `collapse_adv_display` = 0 WHERE `name` = 'travel_parent'");
    if($dao->N == 1) {
      $result['travel_parent'] = 1;
    } else {
      $result['travel_parent'] = 0;
    }
    $dao = CRM_Core_DAO::executeQuery("UPDATE `civicrm_custom_group` SET `weight` = 109, `collapse_display` = 1, `collapse_adv_display` = 0 WHERE `name` = 'info_for_travel_agency'");
    if($dao->N == 1) {
      $result['info_for_travel_agency'] = 1;
    } else {
      $result['info_for_travel_agency'] = 0;
    }
    $dao = CRM_Core_DAO::executeQuery("UPDATE `civicrm_custom_group` SET `weight` = 113, `collapse_display` = 1, `collapse_adv_display` = 0 WHERE `name` = 'Info_for_DSA'");
    if($dao->N == 1) {
      $result['Info_for_DSA'] = 1;
    } else {
      $result['Info_for_DSA'] = 0;
    }
    $dao = CRM_Core_DAO::executeQuery("UPDATE `civicrm_custom_group` SET `weight` = 108, `collapse_display` = 1, `collapse_adv_display` = 1 WHERE `name` = 'travelcase_status'");
    if($dao->N == 1) {
      $result['travelcase_status'] = 1;
    } else {
      $result['travelcase_status'] = 0;
    }
    $dao = CRM_Core_DAO::executeQuery("UPDATE `civicrm_custom_group` SET `weight` = 111, `collapse_display` = 1, `collapse_adv_display` = 1 WHERE `name` = 'pickup'");
    if($dao->N == 1) {
      $result['pickup'] = 1;
    } else {
      $result['pickup'] = 0;
    }
    $dao = CRM_Core_DAO::executeQuery("UPDATE `civicrm_custom_group` SET `weight` = 53, `collapse_display` = 0, `collapse_adv_display` = 0 WHERE `name` = 'Debriefing_Representative'");
    if($dao->N == 1) {
      $result['Debriefing_Representative'] = 1;
    } else {
      $result['Debriefing_Representative'] = 0;
    }
    $dao = CRM_Core_DAO::executeQuery("UPDATE `civicrm_custom_group` SET `weight` = 39, `collapse_display` = 0, `collapse_adv_display` = 0 WHERE `name` = 'Business_Programme'");
    if($dao->N == 1) {
      $result['Business_Programme'] = 1;
    } else {
      $result['Business_Programme'] = 0;
    }
    $dao = CRM_Core_DAO::executeQuery("UPDATE `civicrm_custom_group` SET `weight` = 5, `collapse_display` = 0, `collapse_adv_display` = 0 WHERE `name` = 'Claiminformation'");
    if($dao->N == 1) {
      $result['Claiminformation'] = 1;
    } else {
      $result['Claiminformation'] = 0;
    }
    $dao = CRM_Core_DAO::executeQuery("UPDATE `civicrm_custom_group` SET `weight` = 116, `collapse_display` = 0, `collapse_adv_display` = 1 WHERE `name` = 'Business_Debriefing_CC'");
    if($dao->N == 1) {
      $result['Business_Debriefing_CC'] = 1;
    } else {
      $result['Business_Debriefing_CC'] = 0;
    }
    $dao = CRM_Core_DAO::executeQuery("UPDATE `civicrm_custom_group` SET `weight` = 117, `collapse_display` = 1, `collapse_adv_display` = 0 WHERE `name` = 'Region_of_Responsibility'");
    if($dao->N == 1) {
      $result['Region_of_Responsibility'] = 1;
    } else {
      $result['Region_of_Responsibility'] = 0;
    }
    $dao = CRM_Core_DAO::executeQuery("UPDATE `civicrm_custom_group` SET `weight` = 4, `collapse_display` = 0, `collapse_adv_display` = 0 WHERE `name` = 'pum_donation_group'");
    if($dao->N == 1) {
      $result['pum_donation_group'] = 1;
    } else {
      $result['pum_donation_group'] = 0;
    }
    $dao = CRM_Core_DAO::executeQuery("UPDATE `civicrm_custom_group` SET `weight` = 3, `collapse_display` = 0, `collapse_adv_display` = 0 WHERE `name` = 'pum_business_dsa'");
    if($dao->N == 1) {
      $result['pum_business_dsa'] = 1;
    } else {
      $result['pum_business_dsa'] = 0;
    }
    $dao = CRM_Core_DAO::executeQuery("UPDATE `civicrm_custom_group` SET `weight` = 120, `collapse_display` = 1, `collapse_adv_display` = 0 WHERE `name` = 'PUM_Grant_Donation_Application'");
    if($dao->N == 1) {
      $result['PUM_Grant_Donation_Application'] = 1;
    } else {
      $result['PUM_Grant_Donation_Application'] = 0;
    }
    $dao = CRM_Core_DAO::executeQuery("UPDATE `civicrm_custom_group` SET `weight` = 120, `collapse_display` = 1, `collapse_adv_display` = 0 WHERE `name` = 'testset'");
    if($dao->N == 1) {
      $result['testset'] = 1;
    } else {
      $result['testset'] = 0;
    }
    $dao = CRM_Core_DAO::executeQuery("UPDATE `civicrm_custom_group` SET `weight` = 120, `collapse_display` = 0, `collapse_adv_display` = 0 WHERE `name` = 'Postponed_Exit'");
    if($dao->N == 1) {
      $result['Postponed_Exit'] = 1;
    } else {
      $result['Postponed_Exit'] = 0;
    }
    $dao = CRM_Core_DAO::executeQuery("UPDATE `civicrm_custom_group` SET `weight` = 120, `collapse_display` = 1, `collapse_adv_display` = 0 WHERE `name` = 'business_card_request'");
    if($dao->N == 1) {
      $result['business_card_request'] = 1;
    } else {
      $result['business_card_request'] = 0;
    }
    $dao = CRM_Core_DAO::executeQuery("UPDATE `civicrm_custom_group` SET `weight` = 120, `collapse_display` = 0, `collapse_adv_display` = 1 WHERE `name` = 'prins_history'");
    if($dao->N == 1) {
      $result['prins_history'] = 1;
    } else {
      $result['prins_history'] = 0;
    }
    $dao = CRM_Core_DAO::executeQuery("UPDATE `civicrm_custom_group` SET `weight` = 125, `collapse_display` = 1, `collapse_adv_display` = 0 WHERE `name` = 'doorlooptijden_expert_application'");
    if($dao->N == 1) {
      $result['doorlooptijden_expert_application'] = 1;
    } else {
      $result['doorlooptijden_expert_application'] = 0;
    }
    $dao = CRM_Core_DAO::executeQuery("UPDATE `civicrm_custom_group` SET `weight` = 126, `collapse_display` = 0, `collapse_adv_display` = 1 WHERE `name` = 'rep_payment'");
    if($dao->N == 1) {
      $result['rep_payment'] = 1;
    } else {
      $result['rep_payment'] = 0;
    }
    $dao = CRM_Core_DAO::executeQuery("UPDATE `civicrm_custom_group` SET `weight` = 121, `collapse_display` = 1, `collapse_adv_display` = 0 WHERE `name` = 'Approval_process_Expert_Application'");
    if($dao->N == 1) {
      $result['Approval_process_Expert_Application'] = 1;
    } else {
      $result['Approval_process_Expert_Application'] = 0;
    }
    $dao = CRM_Core_DAO::executeQuery("UPDATE `civicrm_custom_group` SET `weight` = 127, `collapse_display` = 0, `collapse_adv_display` = 0 WHERE `name` = 'BiD_Events'");
    if($dao->N == 1) {
      $result['BiD_Events'] = 1;
    } else {
      $result['BiD_Events'] = 0;
    }
    $dao = CRM_Core_DAO::executeQuery("UPDATE `civicrm_custom_group` SET `weight` = 128, `collapse_display` = 0, `collapse_adv_display` = 0 WHERE `name` = 'Introductiedag'");
    if($dao->N == 1) {
      $result['Introductiedag'] = 1;
    } else {
      $result['Introductiedag'] = 0;
    }
    $dao = CRM_Core_DAO::executeQuery("UPDATE `civicrm_custom_group` SET `weight` = 1, `collapse_display` = 0, `collapse_adv_display` = 0 WHERE `name` = 'group_protect'");
    if($dao->N == 1) {
      $result['group_protect'] = 1;
    } else {
      $result['group_protect'] = 0;
    }
    $dao = CRM_Core_DAO::executeQuery("UPDATE `civicrm_custom_group` SET `weight` = 129, `collapse_display` = 1, `collapse_adv_display` = 0 WHERE `name` = 'Sector'");
    if($dao->N == 1) {
      $result['Sector'] = 1;
    } else {
      $result['Sector'] = 0;
    }
    $dao = CRM_Core_DAO::executeQuery("UPDATE `civicrm_custom_group` SET `weight` = 130, `collapse_display` = 1, `collapse_adv_display` = 0 WHERE `name` = 'Dieetwensen'");
    if($dao->N == 1) {
      $result['Dieetwensen'] = 1;
    } else {
      $result['Dieetwensen'] = 0;
    }
    $dao = CRM_Core_DAO::executeQuery("UPDATE `civicrm_custom_group` SET `weight` = 131, `collapse_display` = 1, `collapse_adv_display` = 1 WHERE `name` = 'Agreement'");
    if($dao->N == 1) {
      $result['Agreement'] = 1;
    } else {
      $result['Agreement'] = 0;
    }
    $dao = CRM_Core_DAO::executeQuery("UPDATE `civicrm_custom_group` SET `weight` = 132, `collapse_display` = 0, `collapse_adv_display` = 1 WHERE `name` = 'Zilver_Expert'");
    if($dao->N == 1) {
      $result['Zilver_Expert'] = 1;
    } else {
      $result['Zilver_Expert'] = 0;
    }
    $dao = CRM_Core_DAO::executeQuery("UPDATE `civicrm_custom_group` SET `weight` = 133, `collapse_display` = 1, `collapse_adv_display` = 0 WHERE `name` = 'Workshops'");
    if($dao->N == 1) {
      $result['Workshops'] = 1;
    } else {
      $result['Workshops'] = 0;
    }

    $this->ctx->log->info(print_r($result,TRUE));

    return TRUE;
  }

	/**
	 * Method to generate or update PUM Case Number
	 *
	 * @param $dao_qry_result_line
	 */
  static function _setMainActivityNumber($dao_qry_result_line) {
  	$arFld = array();
	$arVal = array();
	if (!$dao_qry_result_line->entity_id && $dao_qry_result_line->case_id) {
		$arFld[] = 'entity_id';
		$arVal[] = $dao_qry_result_line->case_id;
	}
	if (!$dao_qry_result_line->case_country && $dao_qry_result_line->country) {
		$arFld[] = 'case_country';
		$arVal[] = '\'' . $dao_qry_result_line->country . '\'';
	}
	if (!$dao_qry_result_line->case_type && $dao_qry_result_line->type_code) {
		$arFld[] = 'case_type';
		$arVal[] = '\'' . $dao_qry_result_line->type_code . '\'';
	}
	if (count($arFld)>0) {
		if (!$dao_qry_result_line->case_sequence) {
			$arFld[] = 'case_sequence';
			$arVal[] = CRM_Sequence_Page_PumSequence::nextval('main_activity');
		}
		if (!$dao_qry_result_line->pum_id) {
			// insert
			$sql_case = 'INSERT INTO civicrm_case_pum (' . implode(', ', $arFld) . ') VALUES (' . implode(', ', $arVal) . ')';
		} else {
			// update
			for ($n=0; $n<count($arFld); $n++) {
				$arFld[$n] .= '=' . $arVal[$n];
			}
			$sql_case = 'UPDATE civicrm_case_pum SET ' . implode(', ', $arFld) . ' WHERE id=' . $dao_qry_result_line->pum_id;
		}
		$dao_case = CRM_Core_DAO::executeQuery($sql_case);
	}
  }

}
