<?php

require_once 'CRM/Core/Page.php';

class CRM_Generic_Page_ImportPUMHistory extends CRM_Core_Page {
  function run() {
    // Example: Set the page-title dynamically; alternatively, declare a static title in xml/Menu/*.xml
    CRM_Utils_System::setTitle(ts('ImportPUMHistory'));

    // Example: Assign a variable for use in a template
    $this->assign('currentTime', date('Y-m-d H:i:s'));

	//Get configuration
	$grp_pumhistory = CRM_Generic_Misc::generic_getCustomTableInfo('pum_history');
	$grp_shortname = CRM_Generic_Misc::generic_getCustomTableInfo('Additional_Data');
	
	//Fetch Shortname
	$sql_shortname = "SELECT * FROM ".$grp_shortname['group_table'];
	$dao_shortname = CRM_Core_DAO::executeQuery($sql_shortname);
		
	while ($dao_shortname->fetch()) {
		$shortname = $dao_shortname->$grp_shortname['columns']['Shortname']['column_name'];
		
		//Set filename and import directory
		$file = 'pum_experience_'.$shortname.'.txt';
		$dir_import = dirname(__FILE__).'/../../../importfiles/';
		$file_import_fullpath = $dir_import.$file;
		
		if(file_exists($file_import_fullpath)) {
			try {
				//Read file contents
				$file_contents = file_get_contents($file_import_fullpath);
				
				if(strpos($file_contents,Chr(10)) != FALSE) {
					$file_contents = str_replace(Chr(10),'<br />',$file_contents);
				} elseif(strpos($file_contents,Chr(13)) != FALSE) {
					$file_contents = str_replace(Chr(13),'<br />',$file_contents);
				}
				
				//Determine if pum_history data is already available, if so skip it
				$sql_checkavailability = "SELECT * FROM ".$grp_pumhistory['group_table']." WHERE entity_id = '".$dao_shortname->entity_id."'";
				$dao_checkavailability = CRM_Core_DAO::executeQuery($sql_checkavailability);
				$dao_checkavailability->fetch();
			
				if ($dao_checkavailability->N > 0) {
					//Do not import anything, data already available
					CRM_Core_Error::debug_log_message($shortname.' skipped, data is already available.');
				} else {
					//Insert data into pum_history field
					$sql = "INSERT INTO ".$grp_pumhistory['group_table']." (entity_id, pum_history) VALUES ('".$dao_shortname->entity_id."','".addslashes($file_contents)."')";
					$dao = CRM_Core_DAO::executeQuery($sql);
				}
			} catch (Exception $e) {
				CRM_Core_Error::debug_log_message($e);
			}
		} else {
			//Skip, no data available for import
		}
	}
	
    parent::run();
  }
}
