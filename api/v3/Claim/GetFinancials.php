<?php

/**
 * Claim.GetFinancials API specification (optional)
 * This is used for documentation and validation.
 *
 * @param array $spec description of fields supported by this API call
 * @return void
 * @see http://wiki.civicrm.org/confluence/display/CRM/API+Architecture+Standards
 */
function _civicrm_api3_claim_getfinancials_spec(&$spec) {
	$spec['contact_id'] = array(
		'title'			=> 'Contact id',
		'type'			=> 'integer',
		'api.required'	=> 1,
	);
}

/**
 * Claim.GetFinancials API
 *
 * @param array $params
 * @return array API result descriptor
 * @see civicrm_api3_create_success
 * @see civicrm_api3_create_error
 * @throws API_Exception
 */
function civicrm_api3_claim_getfinancials($params) {
	$filtered_params = _civicrm_api3_claim_getfinancials_filter_params($params);
	if (count($filtered_params) == 0) {
		throw new API_Exception('No accepted parameters found', 1001);
	}

	$dao = _civicrm_api3_claim_getfinancials_dao($filtered_params);
	$result = array();
	while ($dao->fetch()) {
		// collect data
		$result[] = array(
			'type' => $dao->type,
			'reference' => $dao->reference,
			'description' => $dao->subject,
			'payment_type' =>$dao->payment_type,
			'amount' => $dao->total_amount,
			'contact_id' => $dao->contact_id,
			'contact_name' => $dao->display_name,
			'date' => $dao->payment_datetime,
			'status_id' => $dao->status_id,
			'status' => $dao->status,
		);
	}
    return civicrm_api3_create_success($result, $params);
}

function _civicrm_api3_claim_getfinancials_filter_params($params) {
	$required = array(
		'contact_id',
	);
	$result = array();
	foreach($params as $key => $value) {
		if (in_array($key, $required)) {
			$result[$key] = $value;
		}
	}
	return $result;
}

function _civicrm_api3_claim_getfinancials_dao($params) {
	$tbl = array(
		'Donor_details_FA'  => generic_getCustomTableInfo('Donor_details_FA'),	// contains donor (sponsor) code
		'Claiminformation'  => generic_getCustomTableInfo('Claiminformation'),	// contains custom data for activity Claim
	);
	/*	-- merge conflict on: ----
		'Donor_details_FA'  => _getCustomTableInfo('Donor_details_FA'),	// contains donor (sponsor) code
		'Claiminformation'  => _getCustomTableInfo('Claiminformation'),	// contains custom data for activity Claim
	*/
	

	$sql = '
SELECT
  \'Claim\' type,
  \'\' case_id,
  \'\' case_sequence,
  \'\' case_type,
  \'\' case_country,
  clm.' . $tbl['Claiminformation']['columns']['PUM_Projectnumber_Referencenumber']['column_name'] . ' as reference,
  \'\' case_type_id,
  act.id act_id,
  act.activity_type_id,
  act.subject,
  act.activity_date_time,
  act.status_id,
  sta.label status,
  CASE clm.' . $tbl['Claiminformation']['columns']['Pay_Receive']['column_name'] . '
    WHEN \'To receive from PUM\' THEN \'D\'
    WHEN \'To be paid to PUM\' THEN \'C\'
    ELSE clm.' . $tbl['Claiminformation']['columns']['Pay_Receive']['column_name'] . '
  END payment_type,
  clm.' . $tbl['Claiminformation']['columns']['Total_Expenses']['column_name'] . ' total_amount,
  \'\' AS invoice_number,
  \'\' AS credited_activity_id,
  \'\' AS payment_id,
  \'\' AS payment_datetime,
  ifnull(NULL, \'\') donor_id,
  ifnull(NULL, \'\') donor_name,
  ifnull(NULL, \'\') donor_code,
  acc.contact_id,
  con.display_name
FROM
  civicrm_activity act,
  ' . $tbl['Claiminformation']['group_table'] . ' clm,
  civicrm_activity_contact acc,
  civicrm_contact con,
  (SELECT
     ovl2.value,
     ovl2.label
   FROM
     civicrm_option_group ogp2,
     civicrm_option_value ovl2
   WHERE
     ogp2.name = \'activity_status\' AND
     ovl2.option_group_id = ogp2.id) sta
WHERE
  act.activity_type_id IN (SELECT
                             ovl1.value
                           FROM
                             civicrm_option_group ogp1,
                             civicrm_option_value ovl1
                           WHERE
                             ogp1.name = \'activity_type\' AND
                             ovl1.option_group_id = ogp1.id AND
                             ovl1.name = \'Claim\') AND
  act.is_current_revision = 1 AND
  sta.value = act.status_id AND
  clm.entity_id = act.id AND
  acc.activity_id = act.id AND
  con.id = acc.contact_id AND
  acc.record_type_id IN (SELECT
                           ovl3.value
                         FROM
                           civicrm_option_group ogp3,
                           civicrm_option_value ovl3
                         WHERE
                           ogp3.name = \'activity_contacts\' AND
                           ovl3.option_group_id = ogp3.id AND
                           ovl3.name = \'Activity Targets\') AND
   acc.contact_id = ' . $params['contact_id'] . '
	';
	
	$dao = CRM_Core_DAO::executeQuery($sql);
	
	return $dao;
}
