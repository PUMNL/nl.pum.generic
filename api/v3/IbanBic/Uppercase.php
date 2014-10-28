<?php

/**
 * IbanBic.Uppercase API specification (optional)
 * This is used for documentation and validation.
 *
 * @param array $spec description of fields supported by this API call
 * @return void
 * @see http://wiki.civicrm.org/confluence/display/CRM/API+Architecture+Standards
 */
function _civicrm_api3_iban_bic_uppercase_spec(&$spec) {
}

/**
 * IbanBic.Uppercase API
 *
 * @param array $params
 * @return array API result descriptor
 * @see civicrm_api3_create_success
 * @see civicrm_api3_create_error
 * @throws API_Exception
 */
function civicrm_api3_iban_bic_uppercase($params) {
	$fldIban = 'IBAN_nummer';
	$fldBic = 'BIC_Swiftcode';
	$tblName = 'Bank_Information';
	$returnValues = TRUE;
	try {
		$tbl = array(
			$tblName	=> generic_getCustomTableInfo($tblName),
		);
		// continue only if custom group exists
		if (empty($tbl[$tblName]['group_id'])) {
			throw new API_Exception('Custom group \'' . $tblName . '\' not found' , 1001);
		}
		// continue only if custom fields exists
		if (!array_key_exists($fldIban, $tbl[$tblName]['columns'])) {
			throw new API_Exception('Custom field \'' . $fldIban . '\' not found in \'' . $tblName . '\'' , 1002);
		}
		if (!array_key_exists($fldBic, $tbl[$tblName]['columns'])) {
			throw new API_Exception('Custom field \'' . $fldBic . '\' not found in \'' . $tblName . '\'' , 1003);
		}
		// build query
		$sql = '
UPDATE
	' . $tbl[$tblName]['group_table'] . '
SET
	' . $tbl[$tblName]['columns'][$fldIban]['column_name'] . ' = ucase( ' . $tbl[$tblName]['columns'][$fldIban]['column_name'] . '),
	' . $tbl[$tblName]['columns'][$fldBic]['column_name'] . ' = ucase( ' . $tbl[$tblName]['columns'][$fldBic]['column_name'] . ')
WHERE
  ' . $tbl[$tblName]['columns'][$fldIban]['column_name'] . ' REGEXP BINARY \'[a-z]\' OR
  ' . $tbl[$tblName]['columns'][$fldBic]['column_name'] . ' REGEXP BINARY \'[a-z]\'
		';
		
		// execute query
		$dao = CRM_Core_DAO::executeQuery($sql);
		return civicrm_api3_create_success($returnValues, $params);
	} catch(Exception $e) {
		$returnValues = FALSE;
		throw new API_Exception($e->getMessage());
	}
	
}

