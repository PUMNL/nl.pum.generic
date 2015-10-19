<?php

/**
 * Collection of miscellaneous generic functions
 */
 
global $charMod;
 
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
	
	/*
	 * Function to replace all occurances of the elements in array $removeCharAr
	 * within string $data by the (1:1) mapped elements in array $replacementCharAr
	 * Warning: $data may either grow or shrink in size
	 */
	static function generic_charReplacement($data, $skipFilter=FALSE) {
		global $charMod;
		// character replacement definitions
		if (is_null($charMod)) {
			$charMod = self::_generic_charReplacementBuild();
		};
		// step 1: substitition of known characters
		$data = str_replace($charMod['originals'], $charMod['substitutes'], $data); // replace all 'known' special characters by their 'known' replacement strings
		// step 2: removal of all other illegal characters
		if (!$skipFilter) {
			$data = PREG_REPLACE("/[^0-9a-zA-Z \/\-]/i", '', $data); // remove all remaining special characters
		}
		return $data;
	}

	/*
	 * Function that builds (and returns) an associative array containing
	 * - an array of special characters (to be replaced)
	 * - an array (same size) of their replacement strings
	 */
	private static function _generic_charReplacementBuild() {
		$arCharReplacement = array(
			'originals' => array(),
			'substitutes' => array(),
		);
		self::_generic_charReplacementAdd($arCharReplacement, 'áàäãâ',	'a');
		self::_generic_charReplacementAdd($arCharReplacement, 'ÁÀÄÃÂ',	'A');
		self::_generic_charReplacementAdd($arCharReplacement, 'éèëê',	'e');
		self::_generic_charReplacementAdd($arCharReplacement, 'ÉÈËÊ',	'E');
		self::_generic_charReplacementAdd($arCharReplacement, 'íìïî',	'i');
		self::_generic_charReplacementAdd($arCharReplacement, 'ÍÌÏÎ',	'I');
		self::_generic_charReplacementAdd($arCharReplacement, 'óòöõôø',	'o');
		self::_generic_charReplacementAdd($arCharReplacement, 'ÓÒÖÕÔØ',	'O');
		self::_generic_charReplacementAdd($arCharReplacement, 'úùüû',	'u');
		self::_generic_charReplacementAdd($arCharReplacement, 'ÚÙÜÛ',	'U');
		self::_generic_charReplacementAdd($arCharReplacement, 'ýÿ',		'y');
		self::_generic_charReplacementAdd($arCharReplacement, 'ÝŸ',		'Y');
		self::_generic_charReplacementAdd($arCharReplacement, 'æ',		'ae');
		self::_generic_charReplacementAdd($arCharReplacement, 'Æ',		'AE');
		self::_generic_charReplacementAdd($arCharReplacement, 'ñ',		'n');
		self::_generic_charReplacementAdd($arCharReplacement, 'Ñ',		'N');
		self::_generic_charReplacementAdd($arCharReplacement, 'ç',		'c');
		self::_generic_charReplacementAdd($arCharReplacement, 'Ç',		'C');
		return $arCharReplacement;
	}


	/*
	 * Helper function for _charReplaceBuild()
	 * Maps each character in $orgChars to the string in $replacementStr
	 */
	private static function _generic_charReplacementAdd(&$arCharReplacement, $orgChars, $replacementStr) {
		for($i=0; $i<mb_strlen($orgChars); $i++) {
			$arCharReplacement['originals'][] = mb_substr($orgChars, $i, 1);
			$arCharReplacement['substitutes'][] = $replacementStr;
		}
	}
	
	/*
	 * Helper function to supply table- column names for custom fields
	 */
	function generic_getCustomTableInfo($customGroupName) {
		// default return value
		$customTable = array(
			'group_id' => NULL,
			'group_name' => NULL,
			'group_table' => NULL,
			'columns' => array(),
			'sql_columns' => '',
		);
		
		// retrieve table name for custom group
		$sql = 'SELECT id, name, table_name FROM civicrm_custom_group WHERE name = \'' . $customGroupName . '\'';
		$dao = CRM_Core_DAO::executeQuery($sql);
		if (!$dao->N == 1) {
			// leave empty
		} else {
			$dao->fetch();
			$customTable['group_id'] = $dao->id;
			$customTable['group_name'] = $dao->name;
			$customTable['group_table'] = $dao->table_name;
			// retrieve fieldnames for custom fields
			$sql = "SELECT name, label, column_name FROM civicrm_custom_field WHERE custom_group_id = " . $customTable['group_id'];
			$dao = CRM_Core_DAO::executeQuery($sql);
			if ($dao->N >= 1) {
				$sql_cols = array();
				while ($dao->fetch()) {
					$customTable['columns'][$dao->name] = array(
						'name' => $dao->name,
						'label' => $dao->label,
						'column_name' => $dao->column_name,
					);
					$sql_cols[] = $customTable['group_table'] . '.' . $dao->column_name . ' AS \'' . $dao->name . '\'';
				}
			} else {
				// leave columns empty
			}
			if (!empty($sql_cols)) {
				$customTable['sql_columns'] = implode(',' . PHP_EOL, $sql_cols);
			}
		}
		return $customTable;
	}
}