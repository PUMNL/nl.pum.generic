<?php
/**
 * CountryActionPlan.Request API
 * This API retrieves all active relationships Country Coordinator and
 * creates a new activity New Country Action Plan Request for each
 * Country Coordinator, scheduled for 31 December of the run year
 * 
 * @author Erik Hommel (CiviCooP) <erik.hommel@civicoop.org>
 * @param array $params
 * @return array API result descriptor
 * @see civicrm_api3_create_success
 * @see civicrm_api3_create_error
 */
function civicrm_api3_country_action_plan_request($params) {
  $country_coordinators = get_active_country_coordinators();
  foreach ($country_coordinators as $country_coordinator) {
    create_cap_activity($country_coordinator['contact_id_b'], $country_coordinator['contact_id_a']);
    $return_values[] = 'Activity created for country coordinator '.$country_coordinator['contact_id_b'];
  }
  return civicrm_api3_create_success($return_values, $params, 'CountryActionPlan', 'Request');
}
/**
 * Function to create cap_activity
 * 
 * @param int $contact_id
 * @param int $country_id
 */
function create_cap_activity($contact_id, $country_id) {
  if (_threepeasContactIsCountry($country_id) == TRUE) {
    $activity_type_id = get_new_cap_request_activity();
    $activity_status_id = get_activity_status_scheduled();
    $new_year = (int) date('Y') + 1;
    $params = array(
      'activity_type_id' => $activity_type_id,
      'activity_subject' => 'New Country Action Plan required for '.$new_year,
      'target_id' => $country_id,
      'assignee_id' => $contact_id,
      'activity_date_time' => date('Y').'-12-31',
      'activity_status_id' => $activity_status_id
    );
    if (check_cap_activity_exists($params) == FALSE) {
      civicrm_api3('Activity', 'Create', $params);
    }
  }
}
/**
 * Function to check if the activity to be created already exists
 * 
 * @param array $activityParams
 * @return boolean
 */
function check_cap_activity_exists($activityParams) {
  $assigneeCheck = FALSE;
  $targetCheck = FALSE;
  $query = getCheckQuery();
  $queryParams = getCheckParams($activityParams);
  $dao = CRM_Core_DAO::executeQuery($query, $queryParams);
  while ($dao->fetch()) {
    if ($dao->record_type_id == 1 && $dao->contact_id == $activityParams['assignee_id']) {
      $assigneeCheck = TRUE;
    }
    if ($dao->record_type_id == 3 && $dao->contact_id == $activityParams['target_id']) {
      $targetCheck = TRUE;
    }
  }
  if ($assigneeCheck == TRUE && $targetCheck == TRUE) {
    return TRUE;
  } else {
    return FALSE;
  }
}
/**
 * Function to build check query
 * 
 * @return string $query
 */
function getCheckQuery() {
  $query = 'SELECT a.id, b.contact_id, b.record_type_id FROM civicrm_activity a
    JOIN civicrm_activity_contact b ON a.id = b.activity_id AND record_type_id in(%1,%2)
    WHERE activity_type_id = %3 AND is_current_revision = %4 AND subject = %5 
    AND status_id = %6 AND activity_date_time = %7 AND (b.contact_id = %8 or b.contact_id = %9)';
  return $query;
}
/**
 * Function to build check query params
 * 
 * @param array $activityParams
 * @return array $queryParams
 */
function getCheckParams($activityParams) {
    $queryParams = array(
    1 => array(1, 'Integer'),
    2 => array(3, 'Integer'),
    3 => array($activityParams['activity_type_id'], 'Integer'),
    4 => array(1, 'Integer'),
    5 => array($activityParams['activity_subject'], 'String'),
    6 => array($activityParams['activity_status_id'], 'Integer'),
    7 => array($activityParams['activity_date_time'], 'String'),
    8 => array($activityParams['assignee_id'], 'Integer'),
    9 => array($activityParams['target_id'], 'Integer'));
    return $queryParams;
}
/**
 * Function to get activity_status_id for scheduled
 * 
 * @return int $activity_status_id
 * @throws API_Exception when no option group activity_status found
 * @throws API_Exception when no option value Scheduled found
 */
function get_activity_status_scheduled() {
  try {
    $option_group_id = civicrm_api3('OptionGroup', 'Getvalue', 
      array('name' => 'activity_status', 'return' => 'id'));
  } catch (CiviCRM_API3_Exception $ex) {
    throw new API_Exception('Could not find option group with name activity_status, '
      . 'error from API OptionGroup Getvalue: '.$ex->getMessage());
  }
  $params = array(
    'option_group_id' => $option_group_id,
    'name' => 'Scheduled',
    'return' => 'value');
  try {
    $activity_status_id = civicrm_api3('OptionValue', 'Getvalue', $params); 
  } catch (CiviCRM_API3_Exception $ex) {
    throw new API_Exception('Could not find option value with name Scheduled, '
      . 'in group activity_status, error from API OptionValue Getvalue: '.$ex->getMessage());
  }
  return $activity_status_id;
}
/**
 * Function to get activity_type_id for new_cap_request
 * 
 * @return int $activity_type_id
 * @throws API_Exception when no option group activity_type found
 * @throws API_Exception when no option value new_cap_request found
 */
function get_new_cap_request_activity() {
  try {
    $option_group_id = civicrm_api3('OptionGroup', 'Getvalue', 
      array('name' => 'activity_type', 'return' => 'id'));
  } catch (CiviCRM_API3_Exception $ex) {
    throw new API_Exception('Could not find option group with name activity_type, '
      . 'error from API OptionGroup Getvalue: '.$ex->getMessage());
  }
  $params = array(
    'option_group_id' => $option_group_id,
    'name' => 'new_cap_request',
    'return' => 'value');
  try {
    $activity_type_id = civicrm_api3('OptionValue', 'Getvalue', $params); 
  } catch (CiviCRM_API3_Exception $ex) {
    throw new API_Exception('Could not find option value with name new_cap_request, '
      . 'in group activity_type, error from API OptionValue Getvalue: '.$ex->getMessage());
  }
  return $activity_type_id;
}
/**
 * Function to get active country coordinators
 * 
 * @return array $country_coordinators['values']
 * @throws API_Exception when api Relationship Get throws an error
 * @throws API_Exception when class CRM_Threepeas_CaseRelationConfig (to retrieve relationship
 *         type id for Country Coordinator)
 */
function get_active_country_coordinators() {
  if (!class_exists('CRM_Threepeas_CaseRelationConfig')) {
    throw new API_Exception('Could not find class CRM_Threepeas_CaseRelationConfig, check if '
      . 'required extension nl.pum.threepeas is installed and enabled');
  }
  $case_relation_config = CRM_Threepeas_CaseRelationConfig::singleton();
  $params = array(
    'is_active' => 1,
    'options' => array('limit' => 99999),
    'relationship_type_id' => $case_relation_config->get_relationship_type_id('country_coordinator'));
  try {
    $country_coordinators = civicrm_api3('Relationship', 'Get', $params);
  } catch (CiviCRM_API3_Exception $ex) {
    throw new API_Exception('Error retrieving Country Coordinators, error from '
      . 'API Relationship Get: '.$ex->getMessage());
  }
  return $country_coordinators['values'];
}