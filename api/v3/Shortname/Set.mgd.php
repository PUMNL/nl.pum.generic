<?php
// This file declares a managed database record of type "Job".
// The record will be automatically inserted, updated, or deleted from the
// database as appropriate. For more details, see "hook_civicrm_managed" at:
// http://wiki.civicrm.org/confluence/display/CRMDOC42/Hook+Reference
return array (
  0 => 
  array (
    'name' => 'Cron:Fill Shortnames',
    'entity' => 'Job',
    'params' => 
    array (
      'version' => 3,
      'name' => 'Fill Shortnames',
      'description' => 'Define a unique shortname for all individuals without one',
      'run_frequency' => 'Daily',
      'api_entity' => 'Shortname',
      'api_action' => 'set',
      'parameters' => 'id=processall',
    ),
  ),
);