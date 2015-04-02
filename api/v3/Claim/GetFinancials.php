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
		'Donor_details_FA'  => _getCustomTableInfo('Donor_details_FA'),	// contains donor (sponsor) code
		'Claiminformation'  => _getCustomTableInfo('Claiminformation'),	// contains custom data for activity Claim
	);

	$sql = '
SELECT
  \'Claim\' type,
  cas.id case_id,
  num.case_sequence,
  num.case_type,
  num.case_country,
  clm.' . $tbl['Claiminformation']['columns']['PUM_Projectnumber_Referencenumber']['column_name'] . ' as reference,
  cas.case_type_id,
  act.id act_id,
  act.activity_type_id,
  act.subject,
  act.activity_date_time,
  act.status_id,
  sta.label status,
  CASE clm.pay_receive_496
  WHEN \'To receive from PUM\' THEN \'D\'
  WHEN \'To be paid to PUM\' THEN \'C\'
  ELSE clm.pay_receive_496
  END payment_type,
  clm.total_expenses_495 total_amount,
  \'\' as invoice_number,
  \'\' as credited_activity_id,
  \'\' as payment_id,
  \'\' as payment_datetime,
  ifnull(NULL, \'\') donor_id,
  ifnull(NULL, \'\') donor_name,
  ifnull(NULL, \'\') donor_code,
  acc.contact_id,
  con.display_name
FROM
  civicrm_activity act,
  ' . $tbl['Claiminformation']['group_table'] . ' clm,
  civicrm_case_activity cac,
  civicrm_activity_contact acc
  LEFT JOIN civicrm_contact con ON con.id = acc.contact_id,
  civicrm_case cas
  LEFT JOIN civicrm_case_pum num ON num.entity_id = cas.id,
  (   SELECT
         ovl2.value,
			ovl2.label
      FROM
         civicrm_option_group ogp2,
         civicrm_option_value ovl2
      WHERE
         ogp2.name = \'activity_status\' AND
         ovl2.option_group_id = ogp2.id
	) sta
WHERE
  clm.entity_id = act.id AND
  act.activity_type_id IN (SELECT
                             ovl1.value
                           FROM
                             civicrm_option_group ogp1,
                             civicrm_option_value ovl1
                           WHERE
                             ogp1.name = \'activity_type\' AND
                             ovl1.option_group_id = ogp1.id AND
                             ovl1.name = \'Claim\') AND
  act.status_id = sta.value AND
  act.is_current_revision = 1 AND
  acc.activity_id = act.id AND
  acc.record_type_id  IN (SELECT
                             ovl3.value
                           FROM
                             civicrm_option_group ogp3,
                             civicrm_option_value ovl3
                           WHERE
                             ogp3.name = \'activity_contacts\' AND
                             ovl3.option_group_id = ogp3.id AND
                             ovl3.name = \'Activity Source\') AND
  acc.contact_id = ' . $params['contact_id'] . ' AND
  cac.activity_id = act.id AND
  cas.id = cac.case_id
ORDER BY
  reference,
  payment_datetime
	';
	
	$oldsql = '
SELECT
  \'DSA payment\' type,
  cas.id case_id,
  num.case_sequence,
  num.case_type,
  num.case_country,
  concat(num.case_sequence, \' \', num.case_type, \' \', num.case_country) as reference,
  cas.case_type_id,
  act.id act_id,
  act.activity_type_id,
  act.subject,
  act.activity_date_time,
  IF(dsa.type = 1, \'D\', \'C\') payment_type,
  (
    dsa.amount_airport +
    dsa.amount_dsa +
    dsa.amount_briefing +
    dsa.amount_transfer +
    dsa.amount_hotel +
    dsa.amount_visa +
    dsa.amount_medical +
    dsa.amount_other +
    dsa.amount_advance
  ) AS total_amount,
  dsa.invoice_number,
  dsa.credited_activity_id,
  dsa.payment_id,
  pay.`timestamp` payment_datetime,
  act.status_id,
  sta.label status,
  ifnull(dsa.donor_id, \'\') donor_id,
  ifnull(dnr.display_name, \'\') donor_name,
  ifnull(' . $tbl['Donor_details_FA']['columns']['Donor_code']['column_name'] . ', \'\') donor_code,
  dsa.contact_id,
  con.display_name
FROM
  civicrm_activity act,
  civicrm_dsa_compose dsa
  LEFT JOIN civicrm_contact dnr ON dnr.id = dsa.donor_id
  LEFT JOIN ' . $tbl['Donor_details_FA']['group_table'] . '
    ON ' . $tbl['Donor_details_FA']['group_table'] . '.entity_id = dnr.id
  LEFT JOIN civicrm_dsa_payment pay ON pay.id = dsa.payment_id
  LEFT JOIN civicrm_contact con ON con.id = dsa.contact_id,
  civicrm_case_activity cac,
  civicrm_case cas
  LEFT JOIN civicrm_case_pum num ON num.entity_id = cas.id,
  (   SELECT
         ovl2.value,
			ovl2.label
      FROM
         civicrm_option_group ogp2,
         civicrm_option_value ovl2
      WHERE
         ogp2.name = \'activity_status\' AND
         ovl2.option_group_id = ogp2.id
	) sta
WHERE
  dsa.activity_id = ifnull(
                      act.original_id,
                      act.id) AND
  act.activity_type_id IN (SELECT
                             ovl1.value
                           FROM
                             civicrm_option_group ogp1,
                             civicrm_option_value ovl1
                           WHERE
                             ogp1.name = \'activity_type\' AND
                             ovl1.option_group_id = ogp1.id AND
                             ovl1.name = \'DSA\') AND
  act.status_id = sta.value AND
  act.is_current_revision = 1 AND
  dsa.contact_id = ' . $params['contact_id'] . ' AND
  cac.activity_id = act.id AND
  cas.id = cac.case_id
ORDER BY
  reference,
  payment_datetime
	';
	
	$dao = CRM_Core_DAO::executeQuery($sql);
	
	return $dao;
}
