<?php

require_once 'CRM/Core/Page.php';

class CRM_Generic_Page_ImportPUMHistory extends CRM_Core_Page {
  function run() {
    // Example: Set the page-title dynamically; alternatively, declare a static title in xml/Menu/*.xml
    CRM_Utils_System::setTitle(ts('ImportPUMHistory'));

    // Example: Assign a variable for use in a template
    $this->assign('currentTime', date('Y-m-d H:i:s'));

	$access = CRM_Core_Permission::check('administer CiviCRM');
	
	if ($access == TRUE) {
		self::start_import();
 	} else {
 		$this->assign('result', 'Access Denied');
	}
 	
    parent::run();
  }
  
  function start_import() {
  	//Get configuration
	$grp_prinshistory = generic_getCustomTableInfo('prins_history');
	$grp_shortname = generic_getCustomTableInfo('Additional_Data');
	
	CRM_Core_Error::debug_log_message('Processing PUM History Import...');

	if (isset($grp_prinshistory['group_table']) && !empty($grp_prinshistory['group_table']) &&
		isset($grp_shortname['group_table']) &&	!empty($grp_shortname['group_table'])) {
		
		if ((CRM_Core_DAO::checkTableExists($grp_prinshistory['group_table']) == TRUE) &&
			(CRM_Core_DAO::checkTableExists($grp_shortname['group_table']) == TRUE)) {
			//Fetch Shortname
			$sql_shortname = "SELECT * FROM ".$grp_shortname['group_table'];
			$dao_shortname = CRM_Core_DAO::executeQuery($sql_shortname);
			
			$result = "";
			
			while ($dao_shortname->fetch()) {
				$shortname = $dao_shortname->$grp_shortname['columns']['Shortname']['column_name'];
				
				//Set filename and import directory
				$file = 'pum_experience_'.$shortname.'.txt';
				$dir_import = dirname(__FILE__).'/../../../importfiles/';
				$file_import_fullpath = $dir_import.$file;
				
				if (file_exists($file_import_fullpath)) {
					try {
						CRM_Core_Error::debug_log_message('Processing '.$shortname.'...');
						//Read file contents
						$file_contents = trim(file_get_contents($file_import_fullpath));
						
						//Count number or projects
						//File format is an empty line for each new project
						$count_projects = 0;
						$projects_data = explode(Chr(10).Chr(13), $file_contents);
						$count_projects = count($projects_data);
												
						//Determine if prins_history data is already available, if so skip it
						$sql_checkavailability = "SELECT * FROM ".$grp_prinshistory['group_table']." WHERE entity_id = '".$dao_shortname->entity_id."'";
						$dao_checkavailability = CRM_Core_DAO::executeQuery($sql_checkavailability);
						$dao_checkavailability->fetch();
					
						if ($dao_checkavailability->N > 0) {
							//Do not import anything, data already available
							//CRM_Core_Error::debug_log_message($shortname.' skipped, data is already available.');
						} else {
							$result .= $shortname.' - '.$count_projects.'<br/>';
																					
							//Insert data into prins_history field
							foreach ($projects_data as $key => $value) {
								$sql = "INSERT INTO ".$grp_prinshistory['group_table']." (entity_id,".$grp_prinshistory['columns']['prins_history']['column_name'].") VALUES (%1,%2)";
								$dao = CRM_Core_DAO::executeQuery($sql, array(
									1 => array($dao_shortname->entity_id, 'String'),
									2 => array(trim($value), 'String'),
								));
							}
						}
					} catch (Exception $e) {
						CRM_Core_Error::debug_log_message($e);
					}
				} else {
					//Skip, no data available for import
				}
			}
			
			$this->assign('result', 'Import Successful: <br />'.$result);
			CRM_Core_Error::debug_log_message('Import Successful');
		} else {
			$this->assign('result', 'Table does not exist');
			CRM_Core_Error::debug_log_message('Table does not exist');
	 	}	
	} else {
		$this->assign('result', 'Could not retrieve table');
		CRM_Core_Error::debug_log_message('Could not retrieve table');
 	}
  }
}
