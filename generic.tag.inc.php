<?php

require_once 'generic.tag.def.inc.php';

class Generic_Tag {
	
	/*
	 * returns the definitions for generic tags
	 *
	 * used_for values are based on option values "tags_used_for"
	 *
	 */
	static function required() {
		return Generic_Tag_Def::required();
	}
	
	/*
	 * handler for hook_civicrm_install
	 */
	static function install() {
		$created = array();
		$required = self::required();
/*		$usedForAr = array();
		
		// collect option values for 'tag_used_for': build translations for 'used_for' parameters
		// step 1: retrieve option_group_id
		$params = array(
			'version' => 3,
			'sequential' => 1,
			'name' => 'tag_used_for',
		);
		$result = civicrm_api('OptionGroup', 'get', $params);
		if (!in_array('id', $result)) {
			// cannot build translations
		} else {
			// options group found -> now retrieve its values
			$optionGroupId = $result['id'];
			// step 2: retrieve values (build name to value translations)
			$params = array(
				'version' => 3,
				'sequential' => 1,
				'option_group_id' => $optionGroupId,
			);
			$result = civicrm_api('OptionValue', 'get', $params);
			if (!in_array('count', $result)) {
				// cannot build translations
			} else {
				// store translations
				$optionValues = $result['values'];
				foreach ($optionValues as $opt) {
					$usedForAr[$opt['name']] = $opt['value'];
				}
			}
		}
*/		
		// process required tags
		foreach ($required as $tag) {
			$parentId = -1; // assume required parent_id cannot be found (would prevent tag creation)

			// verify if tag exists
			$params = array(
				'version' => 3,
				'sequential' => 1,
				'name' => $tag['name'],
			);
			$result = civicrm_api('Tag', 'getsingle', $params);
			if (in_array('is_error', $result)) {
				// tag not found: create tag
				// lookup parent_tag if not null
				if (is_null($tag['parent_tag'])) {
					$parentId = NULL;
				} else {
					$params = array(
						'version' => 3,
						'sequential' => 1,
						'name' => $tag['parent_tag'],
					);
					$result = civicrm_api('Tag', 'getsingle', $params);
					if (in_array('is_error', $result)) {
						$parentId = -1;
					} else {
						$parentId = $result['id'];
					}
				}	
				
				// actual tag creation
				if ($parentId != -1) {
					// allow tag creation
					$params = array(
						'version'		=> 3,
						'sequential'	=> 1,
						'parent_id'		=> $parentId,
						'name'			=> $tag['name'],
						'description'	=> $tag['description'],
						'used_for'		=> $tag['used_for'],
						'is_reserved'	=> TRUE,
					);
					$result = civicrm_api('Tag', 'create', $params);
					
					if ($result['is_error'] == 1) {
						// tag not created
						CRM_Utils_System::setUFMessage('Error creating Tag "' . $tag['name'] . '": ' . $result['error_message']);
					} else {
						// tag created
						$created[] = $tag['name'];
					}
				}
			} else {
				// tag already exists: no action
			}
		}
		
		$message = "Tag ".implode(", ", $created)." succesfully created";
		CRM_Utils_System::setUFMessage($message);
	}
	
	/*
	 * handler for hook_civicrm_enable
	 */
	static function enable() {
		$required = self::required();
		// set all contact types to enabled
		foreach ($required as $tag) {
			$params = array(
				'version' => 3,
				'sequential' => 1,
				'name' => $tag['name'],
				);
			$result = civicrm_api('Tag', 'getsingle', $params);
			if (in_array('is_error', $result)) {
				// tag not found: cannot enable
			} else {
				// tag found: proceed
				$qryEnable = "UPDATE civicrm_tag SET is_selectable = 1 WHERE name = '" . $tag['name'] . "'";
				CRM_Core_DAO::executeQuery($qryEnable);
			}
		}
	}
	
	/*
	 * handler for hook_civicrm_disable
	 */
	static function disable() {
		$required = self::required();
		// set all contact types to enabled
		foreach ($required as $tag) {
			$params = array(
				'version' => 3,
				'sequential' => 1,
				'name' => $tag['name'],
				);
			$result = civicrm_api('Tag', 'getsingle', $params);
			if (in_array('is_error', $result)) {
				// tag not found: cannot disable
			} else {
				// tag found: proceed
				$qryDisable = "UPDATE civicrm_tag SET is_selectable = 0 WHERE name = '" . $tag['name'] . "'";
				CRM_Core_DAO::executeQuery($qryDisable);
			}
		}
	}
	
	/*
	 * handler for hook_civicrm_uninstall
	 */
	static function uninstall() {
	}
	
	/*
	 * handler for hook_civicrm_managed
	 */
	static function managed(&$entities) {
	}
	
}