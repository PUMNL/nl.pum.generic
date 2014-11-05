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
 * @throws API_Exception when class CRM_Threepeas_Config (to retrieve relationship
 *                       type id for Country Coordinator)
 * @throws API_Exception when no activity_type with name new_cap_request
 */
function civicrm_api3_country_action_plan_request($params) {
  $country_coordinators = get_active_country_coordinators();
  foreach ($country_coordinators as $country_coordinator) {
    create_cap_activity($country_coordinator['contact_id_b'], $country_coordinator['contact_id_a']);
    $return_values[] = 'Activity created for country coordinator '.$country_coordinator['contact_id_b'];
  }
  return civicrm_api3_create_success($return_values, $params, 'CountryActionPlan', 'Request');
}

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
      'activity_date_time' => $new_year.'-12-31',
      'activity_status_id' => $activity_status_id
    );
    civicrm_api3('Activity', 'Create', $params);
  }
}
/**
 * Function to get activity_status_id for scheduled
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
 * @return array $country_coordinators['values']
 * @throws API_Exception when api Relationship Get throws an error
 */
function get_active_country_coordinators() {
  if (!class_exists('CRM_Threepeas_Config')) {
    throw new API_Exception('Could not find class CRM_Threepeas_Config, check if '
      . 'required extension nl.pum.threepeas is installed and enabled');
  }
  $threepeas_config = CRM_Threepeas_Config::singleton();
  $params = array(
    'is_active' => 1, 
    'relationship_type_id' => $threepeas_config->countryCoordinatorRelationshipTypeId);
  try {
    $country_coordinators = civicrm_api3('Relationship', 'Get', $params);
  } catch (CiviCRM_API3_Exception $ex) {
    throw new API_Exception('Error retrieving Country Coordinators, error from '
      . 'API Relationship Get: '.$ex->getMessage());
  }
  return $country_coordinators['values'];
}