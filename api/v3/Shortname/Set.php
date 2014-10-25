<?php

/**
 * Shortname.Set API specification (optional)
 * This is used for documentation and validation.
 *
 * @param array $spec description of fields supported by this API call
 * @return void
 * @see http://wiki.civicrm.org/confluence/display/CRM/API+Architecture+Standards
 */
function _civicrm_api3_shortname_set_spec(&$spec) {
	$params['id'] = array(
		'title'	=> 'ID of the contact (individual)',
		'type'	=> CRM_Utils_Type::T_INT,
	);
}

/**
 * Shortname.Set API
 *
 * @param array $params
 * 	$id=<contact id> (individuals only), or 'processall'
 * @return array API result descriptor
 * @see civicrm_api3_create_success
 * @see civicrm_api3_create_error
 * @throws API_Exception
 */
function civicrm_api3_shortname_set($params) {
	$countSuccess = 0;
	$countFailure = 0;
	// determine criteria
	$criteria = array();
	if (array_key_exists('id', $params) && !empty($params['id'])) {
		$criteria['id'] = $params['id'];
	} else {
		throw new API_Exception('No parameter \'id\' provided.', 1001);
	}
	
	// get info about the table containing custom field Shortname
	$fldName = 'Shortname';
	$tblName = 'Additional_Data';
	$tbl = array(
		$tblName	=> generic_getCustomTableInfo($tblName),
	);
	// continue only if custom group exists
	if (empty($tbl[$tblName]['group_id'])) {
		throw new API_Exception('Custom group \'' . $tblName . '\' not found' , 1002);
	}
	// continue only if custom field exists
	if (!array_key_exists($fldName, $tbl[$tblName]['columns'])) {
		throw new API_Exception('Custom field \'' . $fldName . '\' not found in \'' . $tblName . '\'' , 1003);
	}
	// continue only is sequence extension is active
	if (!CRM_Generic_Misc::generic_verify_extension('nl.pum.sequence')) {
		throw new API_Exception('Mandatory module nl.pum.sequence is not enabled!', 1004);
	}
	
	
	if (strcasecmp($criteria['id'], 'processall') == 0) {
		// special keyword to query for all individuals that do not have a shortname yet
		$sql = '
SELECT
  dat.id AS \'short_id\',
  con.id,
  con.last_name
FROM
  civicrm_contact con
  LEFT JOIN ' . $tbl['Additional_Data']['group_table'] . ' dat ON dat.entity_id = con.id
WHERE
  con.contact_type = \'Individual\' AND
  dat.' . $tbl['Additional_Data']['columns']['Shortname']['column_name'] . ' IS NULL
		';

	} else {
		// query for a single individual indicated by his/her contact id
		$sql = '
SELECT
  dat.id AS \'short_id\',
  con.id,
  con.last_name
FROM
  civicrm_contact con
  LEFT JOIN ' . $tbl['Additional_Data']['group_table'] . ' dat ON dat.entity_id = con.id
WHERE
  con.contact_type = \'Individual\' AND
  con.id = ' . $criteria['id'] . ' AND
  dat.' . $tbl['Additional_Data']['columns']['Shortname']['column_name'] . ' IS NULL
		';
	}

	// execute query and process each record
	$dao = CRM_Core_DAO::executeQuery($sql);
	if ($dao->N > 0) {
		while($dao->fetch()) {
			if (_apply_new_shortname($dao->id, $dao->short_id, $dao->last_name, $tbl)) {
				$countSuccess++;
			} else {
				$countFailure++;
			}
		}
	}
	
	// results
    $returnValues = array( // OK, return several data rows
		'result_count' => array(
			'success' => $countSuccess,
			'failure' => $countFailure,
		),
    );

    // Spec: civicrm_api3_create_success($values = 1, $params = array(), $entity = NULL, $action = NULL)
    return civicrm_api3_create_success($returnValues, $params, 'NewEntity', 'NewAction');
}

/*
 * processor for a single individual
 */
function _apply_new_shortname($id, $short_id, $last_name, $tbl) {
	try {
		// name part of the shortname
		$shortkey = substr(CRM_Generic_Misc::generic_charReplacement(strtoupper($last_name . 'XXXX')), 0, 4);
		// make sure there is a sequence for the name part
		$sequence = 'short_' . $shortkey;
		if (!CRM_Sequence_Page_PumSequence::ispresent($sequence)) {
			CRM_Sequence_Page_PumSequence::create($sequence, 1, 1, 9999, 1, FALSE);
		}
		// build the numeric parte of the shortname from the sequence
		$shortnum = substr('0000' . CRM_Sequence_Page_PumSequence::nextval($sequence), -4);
		// build the full shortname
		$shortname = $shortkey . $shortnum;
		// build sql to write the shortname to the database
		if (is_null($short_id)) {

			// create a new custom record to hold the shortname
			$sql = '
INSERT INTO
  ' . $tbl['Additional_Data']['group_table'] . '
  (entity_id, ' . $tbl['Additional_Data']['columns']['Shortname']['column_name'] . ')
VALUES
  (' . $id . ', \'' . $shortname . '\')
			';
		
		} else {

			// update an existing custom record with the shortname
			$sql = '
UPDATE
  ' . $tbl['Additional_Data']['group_table'] . '
SET
  ' . $tbl['Additional_Data']['columns']['Shortname']['column_name'] . ' = \'' . $shortname . '\'
WHERE
  id = ' . $short_id . '
			';
			
		}
		// execute sql
		$dao = CRM_Core_DAO::executeQuery($sql);
		return TRUE;
		
	} catch(Exception $e) {
		return FALSE;
	}
}