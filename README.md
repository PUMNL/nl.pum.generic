nl.pum.generic
==============

Generic extension for civicrm

Using API for creation of:
 - Option Groups
 - Custom Field Groups and -Fields
 - Tags
 - Contact Types
 - Case Types

Using Managed Entities for:
 - Groups
 - Relationship Types

 Contains API:
 - Shortnate:get($contactId) - for individuals only
 
Due to a problem in either managed entities or the underlying API, it is not possible (CiviCRM 4.4.5) to create relationship types with contact_type_a='' (for All contacts).
As a workaround these relationship types are first created for 'Individuals' and a notification is provides to use clearcache, which will trigger the entity management once more, correcting the fault.
 
As of release 1001 this extension has a dependency on nl.pum.sequence:
It initialises sequence 'main_activity' (70000 and up, step 1, non-cyclic) and 'payment_line' (1-9999, step 1, cyclic)

As of v1.1 nl.pum.genericsourcereader may be used to (help) build the lists of required entities.

Important note:
---------------
As CiviCRM processes managed entities differently than other entities created in install or upgrade, you may find that custom groups do NOT get linked to their intended relationship types.      


Known errors when disabling:
----------------------------
Notice: Undefined index: name_a_b in civicrm_api3_relationship_type_create() (line nn of C:\wamp\www\drupal\sites\drupalcivi.localhost\modules\contrib\civicrm\api\v3\RelationshipType.php).
Notice: Undefined index: name_b_a in civicrm_api3_relationship_type_create() (line mm of C:\wamp\www\drupal\sites\drupalcivi.localhost\modules\contrib\civicrm\api\v3\RelationshipType.php).
(...)
Notice: Undefined index: label in CRM_Core_OptionValue::addOptionValue() (line ppp of C:\wamp\www\drupal\sites\drupalcivi.localhost\modules\contrib\civicrm\CRM\Core\OptionValue.php).
Notice: Undefined index: name in CRM_Core_OptionValue::addOptionValue() (line qqq of C:\wamp\www\drupal\sites\drupalcivi.localhost\modules\contrib\civicrm\CRM\Core\OptionValue.php).
Notice: Undefined index: label in CRM_Core_OptionValue::addOptionValue() (line rrr of C:\wamp\www\drupal\sites\drupalcivi.localhost\modules\contrib\civicrm\CRM\Core\OptionValue.php).
(...)
