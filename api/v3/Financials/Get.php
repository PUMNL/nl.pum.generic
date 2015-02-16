<?php

/**
 * Financials.Get API specification (optional)
 * This is used for documentation and validation.
 *
 * @param array $spec description of fields supported by this API call
 * @return void
 * @see http://wiki.civicrm.org/confluence/display/CRM/API+Architecture+Standards
 */
function _civicrm_api3_financials_get_spec(&$spec) {
  	$spec['contact_id'] = array(
		'title'			=> 'Contact id',
		'type'			=> 'integer',
		'api.required'	=> 1,
	);
}

/**
 * Financials.Get API
 *
 * @param array $params
 * @return array API result descriptor
 * @see civicrm_api3_create_success
 * @see civicrm_api3_create_error
 * @throws API_Exception
 */
function civicrm_api3_financials_get($params) {
	$filtered_params = _civicrm_api3_financials_get_filter_params($params);
	if (count($filtered_params) == 0) {
		throw new API_Exception('No accepted parameters found', 1001);
	}

	// collect data
	$result = array();
	_civicrm_api3_financials_get_dsa_data($result, $params);
	_civicrm_api3_financials_get_representative_payment_data($result, $filtered_params);
	_civicrm_api3_financials_get_claim_data($result, $filtered_params);

	// sort data
	usort($result, "_civicrm_api3_financials_get_sort_data");
	
	// output
    return civicrm_api3_create_success($result, $params);
}

function _civicrm_api3_financials_get_filter_params($params) {
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

/**
 * function to provide dsa payment details
 */
function _civicrm_api3_financials_get_dsa_data(&$result_ar, $params) {
	if (CRM_Generic_Misc::generic_verify_extension('nl.pum.dsa')) {
		$params_api = array(
			'version' => 3,
			'q' => 'civicrm/ajax/rest',
			'sequential' => 1,
			'contact_id' => $params['contact_id'],
		);
		$result = civicrm_api('Dsa', 'GetFinancials', $params_api);
		
		if ($result['is_error'] == 0) {
			if ($result['count'] > 0) {
				foreach($result['values'] as $key=>$value) {
					$result_ar[] = $value;
				}
			}
		}
	}
}

/**
 * function to provide representative payment details
 */
function _civicrm_api3_financials_get_representative_payment_data(&$result_ar, $params) {
	if (CRM_Generic_Misc::generic_verify_extension('nl.pum.dsa')) {
		$params_api = array(
			'version' => 3,
			'q' => 'civicrm/ajax/rest',
			'sequential' => 1,
			'contact_id' => $params['contact_id'],
		);
		$result = civicrm_api('Representative', 'GetFinancials', $params_api);
		
		if ($result['is_error'] == 0) {
			if ($result['count'] > 0) {
				foreach($result['values'] as $key=>$value) {
					$result_ar[] = $value;
				}
			}
		}
	}
}

/**
 * function to provide claim details
 */
function _civicrm_api3_financials_get_claim_data(&$result_ar, $params) {
	$params_api = array(
		'version' => 3,
		'q' => 'civicrm/ajax/rest',
		'sequential' => 1,
		'contact_id' => $params['contact_id'],
	);
	$result = civicrm_api('Claim', 'GetFinancials', $params_api);
	
	if ($result['is_error'] == 0) {
		if ($result['count'] > 0) {
			foreach($result['values'] as $key=>$value) {
				$result_ar[] = $value;
			}
		}
	}
}

/**
 * function to apply primary, secundary (etc.) sorting on two entries of data
 */
function _civicrm_api3_financials_get_sort_data($a, $b) {
	// primary sort on date
	$result = _civicrm_api3_financials_get_compare($a['date'], $b['date'], 'date', 'desc');
	// secundary sort on reference (i.e. PUM Main activity number)
	if ($result == 0) {
		$result = _civicrm_api3_financials_get_compare($a['reference'], $b['reference'], 'text', 'asc');
	}
	// tertiary sort on type (e.g. 'Claim', 'DSA payment ', 'Representative payment')
	if ($result == 0) {
		$result = _civicrm_api3_financials_get_compare($a['type'], $b['type'], 'text', 'asc');
	}
	// quaternary sort on amount
	if ($result == 0) {
		$result = _civicrm_api3_financials_get_compare($a['amount'], $b['amount'], 'number', 'desc');
	}
	return $result;
}


function _civicrm_api3_financials_get_compare($a_data, $b_data, $type='text', $direction='asc') {
	// cast input data to preferred type before weighing
	$a_cast = NULL;
	$b_cast = NULL;
	switch($type) {
		case 'number':
			$a_cast = (float)$a_data;
			$b_cast = (float)$b_data;
			break;
		case 'date':
			$a_cast = date('Ymd', strtotime($a_data));
			$b_cast = date('Ymd', strtotime($b_data));
			break;
		default:
			// treat as text
			$a_cast = $a_data;
			$b_cast = $b_data;
	}
	// sort order
	if ($direction == 'desc') {
		$order = -1;
	} else {
		$order = 1;
	}
	// weighing
	if (is_null($a_cast) && !is_null($b_cast)) {
		return ($order * -1); // NULL in ASCII equals 0 -> $a_case has sorts lowest
	} elseif (!is_null($a_cast) && is_null($b_cast)) {
		return ($order * 1); // NULL in ASCII equals 0 -> $b_case has sorts lowest
	} elseif ($a_cast == $b_cast) {
		return 0;
	} elseif ($a_cast < $b_cast) {
		return ($order * -1);
	} else {
		return ($order * 1);
	}
}
