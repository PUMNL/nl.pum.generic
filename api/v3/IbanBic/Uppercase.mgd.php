<?php
// This file declares a managed database record of type "Job".
// The record will be automatically inserted, updated, or deleted from the
// database as appropriate. For more details, see "hook_civicrm_managed" at:
// http://wiki.civicrm.org/confluence/display/CRMDOC42/Hook+Reference
return array (
  0 => 
  array (
    'name' => 'Cron:Set IBAN and BIC to uppercase',
    'entity' => 'Job',
    'params' => 
    array (
      'version' => 3,
      'name' => 'Set IBAN and BIC to uppercase',
      'description' => 'Set existing IBAN and BIC to uppercase where neccessary',
      'run_frequency' => 'Daily',
      'api_entity' => 'IbanBic',
      'api_action' => 'uppercase',
      'parameters' => '',
    ),
  ),
);