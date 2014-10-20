<?php

/**
 * Collection of miscellaneous generic functions
 */
 
class CRM_Generic_Misc {

	static function generic_verify_extension($extName) {
		$extensionParams = array('full_name' => $extName);
		$extensionDefaults = array();
		$extensionPresence = CRM_Core_BAO_Extension::retrieve($extensionParams, $extensionDefaults);
		if (!empty($extensionPresence) && $extensionPresence->is_active == 1) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	
}