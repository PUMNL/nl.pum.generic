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
