<?php

/**
 * PumCaseNumber.Get API specification (optional)
 * This is used for documentation and validation.
 *
 * @param array $spec description of fields supported by this API call
 * @return void
 * @see http://wiki.civicrm.org/confluence/display/CRM/API+Architecture+Standards
 */
function _civicrm_api3_pum_case_number_get_spec(&$spec) {
    $spec['case_id'] = array(
		'title'			=> 'Case id',
		'type'			=> 'integer',
		'api.required'	=> 1,
	);
}

/**
 * PumCaseNumber.Get API
 *
 * @param array $params
 * @return array API result descriptor
 * @see civicrm_api3_create_success
 * @see civicrm_api3_create_error
 * @throws API_Exception
 */
function civicrm_api3_pum_case_number_get($params) {
	$caseId = $params['case_id'];
	$tbl = array(
		'PUM_Case_number'  => _getCustomTableInfo('PUM_Case_number'),
	);
	$sql = 'select * from ' . $tbl['PUM_Case_number']['group_table'] . ' where entity_id=' . $caseId;
	$dao = CRM_Core_DAO::executeQuery($sql);
	
	if($dao->N == 1) {
		$dao->fetch();
		$result = array(
			array(
				'sequence' => $dao->case_sequence,
				'type'     => $dao->case_type,
				'country'  => $dao->case_country,
			),
		);
	} else {
		$result = array(
			array(
				'sequence' => '',
				'type'     => '',
				'country'  => '',
			),
		);
	}
	
	return civicrm_api3_create_success($result, $params);
}

