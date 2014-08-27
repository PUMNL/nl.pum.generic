<?php

/**
 * Collection of upgrade steps
 */
class CRM_Generic_Upgrader extends CRM_Generic_Upgrader_Base {

  // By convention, functions that look like "function upgrade_NNNN()" are
  // upgrade tasks. They are executed in order (like Drupal's hook_update_N).

  
  public function install() {
    $this->upgrade_1001();
    $this->upgrade_1002();
    $this->upgrade_1004();
    $this->upgrade_1005();
  }

  /**
   * Example: Run an external SQL script when the module is uninstalled
   *
  public function uninstall() {
   $this->executeSqlFile('sql/myuninstall.sql');
  }

  /**
   * Example: Run a simple query when a module is enabled
   *
  public function enable() {
    CRM_Core_DAO::executeQuery('UPDATE foo SET is_active = 1 WHERE bar = "whiz"');
  }

  /**
   * Example: Run a simple query when a module is disabled
   *
  public function disable() {
    CRM_Core_DAO::executeQuery('UPDATE foo SET is_active = 0 WHERE bar = "whiz"');
  }

  /**
   * Upgrade 1001 - initiating sequences for
   * 1: main activities and DSA payments
   * 2: payment lines
   */
  public function upgrade_1001() {
	$this->ctx->log->info('Applying update 1001 (initiating sequences)');
    if (!_generic_verify_sequencer()) {
		CRM_Core_Error::fatal("Mandatory module nl.pum.sequencer is not enabled!");
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
  public function upgrade_1002() {
	$this->ctx->log->info('Applying update 1002 (add custom group PUM_Case_number)');
	$this->executeCustomDataFile('xml/1002_install_custom_group.xml');
	return TRUE;
  }

  /**
    * Upgrade 1004 - alter table civicrm_dsa_compose
    */
  public function upgrade_1004() {
    $this->ctx->log->info('Applying update 1004 (create table civicrm_case_pum)');
    // create table
    $this->executeSqlFile('sql/civicrm_case_pum_1004.sql');
    return TRUE;
  }
  
  /**
   * Upgrade 1005 - additional option group 'case type code' and initial case numbering
   */
  public function upgrade_1005() {
	$this->ctx->log->info('Applying update 1005 (add PUM project numbering)');
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
  public function upgrade_1006() {
	$this->ctx->log->info('Applying update 1006 (initiating sequence)');
    if (!_generic_verify_sequencer()) {
		CRM_Core_Error::fatal("Mandatory module nl.pum.sequencer is not enabled!");
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
   * Example: Run a couple simple queries
   *
   * @return TRUE on success
   * @throws Exception
   *
  public function upgrade_4200() {
    $this->ctx->log->info('Applying update 4200');
    CRM_Core_DAO::executeQuery('UPDATE foo SET bar = "whiz"');
    CRM_Core_DAO::executeQuery('DELETE FROM bang WHERE willy = wonka(2)');
    return TRUE;
  } // */


  /**
   * Example: Run an external SQL script
   *
   * @return TRUE on success
   * @throws Exception
  public function upgrade_4201() {
    $this->ctx->log->info('Applying update 4201');
    // this path is relative to the extension base dir
    $this->executeSqlFile('sql/upgrade_4201.sql');
    return TRUE;
  } // */


  /**
   * Example: Run a slow upgrade process by breaking it up into smaller chunk
   *
   * @return TRUE on success
   * @throws Exception
  public function upgrade_4202() {
    $this->ctx->log->info('Planning update 4202'); // PEAR Log interface

    $this->addTask(ts('Process first step'), 'processPart1', $arg1, $arg2);
    $this->addTask(ts('Process second step'), 'processPart2', $arg3, $arg4);
    $this->addTask(ts('Process second step'), 'processPart3', $arg5);
    return TRUE;
  }
  public function processPart1($arg1, $arg2) { sleep(10); return TRUE; }
  public function processPart2($arg3, $arg4) { sleep(10); return TRUE; }
  public function processPart3($arg5) { sleep(10); return TRUE; }
  // */


  /**
   * Example: Run an upgrade with a query that touches many (potentially
   * millions) of records by breaking it up into smaller chunks.
   *
   * @return TRUE on success
   * @throws Exception
  public function upgrade_4203() {
    $this->ctx->log->info('Planning update 4203'); // PEAR Log interface

    $minId = CRM_Core_DAO::singleValueQuery('SELECT coalesce(min(id),0) FROM civicrm_contribution');
    $maxId = CRM_Core_DAO::singleValueQuery('SELECT coalesce(max(id),0) FROM civicrm_contribution');
    for ($startId = $minId; $startId <= $maxId; $startId += self::BATCH_SIZE) {
      $endId = $startId + self::BATCH_SIZE - 1;
      $title = ts('Upgrade Batch (%1 => %2)', array(
        1 => $startId,
        2 => $endId,
      ));
      $sql = '
        UPDATE civicrm_contribution SET foobar = whiz(wonky()+wanker)
        WHERE id BETWEEN %1 and %2
      ';
      $params = array(
        1 => array($startId, 'Integer'),
        2 => array($endId, 'Integer'),
      );
      $this->addTask($title, 'executeSql', $sql, $params);
    }
    return TRUE;
  } // */
  
  static function _setMainActivityNumber($dao_qry_result_line) {
  	$arFld = array();
	$arVal = array();
	if (is_null($dao_qry_result_line->entity_id) && (!is_null($dao_qry_result_line->case_id))) {
		$arFld[]='entity_id';
		$arVal[]=$dao_qry_result_line->case_id;
	}
	if (is_null($dao_qry_result_line->case_country) && (!is_null($dao_qry_result_line->country))) {
		$arFld[]='case_country';
		$arVal[]='\'' . $dao_qry_result_line->country . '\'';
	}
	if (is_null($dao_qry_result_line->case_type) && (!is_null($dao_qry_result_line->type_code))) {
		$arFld[]='case_type';
		$arVal[]='\'' . $dao_qry_result_line->type_code . '\'';
	}
	if (count($arFld)>0) {
		if (is_null($dao_qry_result_line->case_sequence)) {
			$arFld[]='case_sequence';
			$arVal[]=CRM_Sequence_Page_PumSequence::nextval('main_activity');
		}
		if (is_null($dao_qry_result_line->pum_id)) {
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
