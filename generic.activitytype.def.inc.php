<?php

class Generic_ActivityType_Def {

	// definitions for: Activity Type

	static function required() {
		return array(
			array(
				'name' => 'Create Candidate Expert Account',
				'label' => 'Create Candidate Expert Account',
				'component' => 'CiviCase',
				'description' => '<p>Used in ExpertApplication</p>
',
			),
			array(
				'name' => 'Fill Out PUM CV',
				'label' => 'Fill Out PUM CV',
				'component' => 'CiviCase',
				'description' => '<p>Used in \"Expertapplication\"</p>
',
			),
			array(
				'name' => 'Contact with colleague',
				'label' => 'Contact with colleague',
				'component' => 'CiviCase',
				'description' => '<p>Used in \'Expertapplication\'</p>
',
			),
			array(
				'name' => 'Restrictions',
				'label' => 'Restrictions',
				'component' => NULL,
				'description' => '<p>Activity meant to help matching process with possible restrictions.</p>
',
			),
			array(
				'name' => 'Expert PUM CV changed by Expert',
				'label' => 'Expert PUM CV changed by Expert',
				'component' => NULL,
				'description' => '<p>Activity meant to notify the SC that an Expert has made changes to his CV</p>
',
			),
			array(
				'name' => 'Payment Grant',
				'label' => 'Payment Grant',
				'component' => 'CiviCase',
				'description' => '<p>Used in \'Grant\'</p>
',
			),
			array(
				'name' => 'Grant Information by CC',
				'label' => 'Grant Information by CC',
				'component' => 'CiviCase',
				'description' => '<p>Used in \'Grant\'</p>
',
			),
			array(
				'name' => 'Assessment Grant by GC',
				'label' => 'Assessment Grant by GC',
				'component' => 'CiviCase',
				'description' => '<p>Used in \'Grant\'</p>
',
			),
			array(
				'name' => 'Report',
				'label' => 'Report',
				'component' => 'CiviCase',
				'description' => '<p>Used in de case \'Grant\'</p>
',
			),
			array(
				'name' => 'Contact with Customer',
				'label' => 'Contact with Customer',
				'component' => 'CiviCase',
				'description' => '<p>Used in \'Advice\'</p>
',
			),
			array(
				'name' => 'Contact about Customer',
				'label' => 'Contact about Customer',
				'component' => 'CiviCase',
				'description' => '<p>Used in \'Advice\'</p>
',
			),
			array(
				'name' => 'Intake Customer by CC',
				'label' => 'Intake Customer by CC',
				'component' => 'CiviCase',
				'description' => '<p>Used in \"Projectintake\"</p>
',
			),
			array(
				'name' => 'Intake Customer by SC',
				'label' => 'Intake Customer by SC',
				'component' => 'CiviCase',
				'description' => '<p>Used in \"Projectintake\"</p>
',
			),
			array(
				'name' => 'Intake Customer by Anamon',
				'label' => 'Intake Customer by Anamon',
				'component' => 'CiviCase',
				'description' => '<p>Used in \"Projectintake\"</p>
',
			),
			array(
				'name' => 'Assessment Project Request by Rep',
				'label' => 'Assessment Project Request by Rep',
				'component' => 'CiviCase',
				'description' => '<p>Used in Projectintake</p>
',
			),
			array(
				'name' => 'Conditions',
				'label' => 'Conditions',
				'component' => 'CiviCase',
				'description' => '<p>Used in \'Advice, Seminar\'</p>
',
			),
			array(
				'name' => 'Accept Main Activity Proposal',
				'label' => 'Accept Main Activity Proposal',
				'component' => 'CiviCase',
				'description' => '<p>Used in \'Advice, Seminar, Business\' by Expert</p>
',
			),
			array(
				'name' => 'Reject Main Activity Proposal',
				'label' => 'Reject Main Activity Proposal',
				'component' => 'CiviCase',
				'description' => '<p>Used in \'Advice, Seminar\' by Expert</p>
',
			),
			array(
				'name' => 'Approve Expert by Customer',
				'label' => 'Approve Expert by Customer',
				'component' => 'CiviCase',
				'description' => '<p>Used in \'Advice, Seminar\'</p>
',
			),
			array(
				'name' => 'Briefing Expert',
				'label' => 'Briefing Expert',
				'component' => 'CiviCase',
				'description' => '<p>Used in \'Advice, Seminar\'</p>
',
			),
			array(
				'name' => 'DSA',
				'label' => 'DSA',
				'component' => 'CiviCase',
				'description' => '<p>Use this activity to calculate and prepare DSA payments and creditations. Used in \'Travel Case\'</p>
',
			),
			array(
				'name' => 'Pick Up Information',
				'label' => 'Pick Up Information',
				'component' => 'CiviCase',
				'description' => '<p>Used in \'Travelcase\'</p>
',
			),
			array(
				'name' => 'Letter of Invitation',
				'label' => 'Letter of Invitation',
				'component' => 'CiviCase',
				'description' => '<p>Used in \'Travelcase\'</p>
',
			),
			array(
				'name' => 'Visa documents from Expert',
				'label' => 'Visa documents from Expert',
				'component' => 'CiviCase',
				'description' => '<p>Used in \'Travelcase\'</p>
',
			),
			array(
				'name' => 'Visa Request',
				'label' => 'Visa Request',
				'component' => 'CiviCase',
				'description' => '<p>Used in \'Travelcase\'</p>
',
			),
			array(
				'name' => 'CAP submitted by CC',
				'label' => 'CAP submitted by CC',
				'component' => 'CiviCase',
				'description' => '<p>Used in \'CAP Assessment\'</p>
',
			),
			array(
				'name' => 'Assessment Country Project by CFO',
				'label' => 'Assessment Country Project by CFO',
				'component' => 'CiviCase',
				'description' => '<p>Used in \'CAP Assessment\'</p>
',
			),
			array(
				'name' => 'Assessment Country Project by CEO',
				'label' => 'Assessment Country Project by CEO',
				'component' => 'CiviCase',
				'description' => '<p>Used in \'CAP Assessment\'</p>
',
			),
			array(
				'name' => 'Briefing',
				'label' => 'Briefing',
				'component' => 'CiviCase',
				'description' => '<p>Used in \'PDV\'</p>
',
			),
			array(
				'name' => 'Debriefing',
				'label' => 'Debriefing',
				'component' => 'CiviCase',
				'description' => '<p>Used in \'PDV\'</p>
',
			),
			array(
				'name' => 'PDV Programme',
				'label' => 'PDV Programme',
				'component' => 'CiviCase',
				'description' => '<p>Used in PDV</p>
',
			),
			array(
				'name' => 'CTM Programme',
				'label' => 'CTM Programme',
				'component' => 'CiviCase',
				'description' => '<p>Used in CTM</p>
',
			),
			array(
				'name' => 'CTM Budget approval by CFO',
				'label' => 'CTM Budget approval by CFO',
				'component' => 'CiviCase',
				'description' => '<p>Used in de case \'CTM\'</p>
',
			),
			array(
				'name' => 'Agreements',
				'label' => 'Agreements',
				'component' => 'CiviCase',
				'description' => '<p>Used to summarize what is agreed upon during a number of contacts with potential partners or sponsors</p>
',
			),
			array(
				'name' => 'One pager',
				'label' => 'One pager',
				'component' => 'CiviCase',
				'description' => '',
			),
			array(
				'name' => 'Letter of Inquiry',
				'label' => 'Letter of Inquiry',
				'component' => 'CiviCase',
				'description' => '',
			),
			array(
				'name' => 'Concept Note',
				'label' => 'Concept Note',
				'component' => 'CiviCase',
				'description' => '',
			),
			array(
				'name' => 'Proposal',
				'label' => 'Proposal',
				'component' => 'CiviCase',
				'description' => '',
			),
			array(
				'name' => 'Location',
				'label' => 'Location',
				'component' => 'CiviCase',
				'description' => '<p>Used in \'Organise Events\'</p>
',
			),
			array(
				'name' => 'Catering',
				'label' => 'Catering',
				'component' => 'CiviCase',
				'description' => '<p>Used in \'Organise Events\'</p>
',
			),
			array(
				'name' => 'Invitation',
				'label' => 'Invitation',
				'component' => 'CiviCase',
				'description' => '<p>Used in \'Organise Events\'</p>
',
			),
			array(
				'name' => 'Equipment',
				'label' => 'Equipment',
				'component' => 'CiviCase',
				'description' => '<p>Used in \'Organise Events\'</p>
',
			),
			array(
				'name' => 'Presentation',
				'label' => 'Presentation',
				'component' => 'CiviCase',
				'description' => '<p>Used in \'Organise Events\'</p>
',
			),
			array(
				'name' => 'Reminder',
				'label' => 'Reminder',
				'component' => 'CiviCase',
				'description' => '<p>Used in \'Organise Events\'</p>
',
			),
			array(
				'name' => 'Nameplates',
				'label' => 'Nameplates',
				'component' => 'CiviCase',
				'description' => '<p>Used in \'Organise Events\'</p>
',
			),
			array(
				'name' => 'Participants List',
				'label' => 'Participants List',
				'component' => 'CiviCase',
				'description' => '<p>Used in \'Organise Events\'</p>
',
			),
			array(
				'name' => 'Badges',
				'label' => 'Badges',
				'component' => 'CiviCase',
				'description' => '<p>Used in \'Organise Events\'</p>
',
			),
			array(
				'name' => 'Number of Participants',
				'label' => 'Number of Participants',
				'component' => 'CiviCase',
				'description' => '<p>Used in \'Organise Events\'</p>
',
			),
			array(
				'name' => 'Scenario',
				'label' => 'Scenario',
				'component' => 'CiviCase',
				'description' => '<p>Used in \'Organise Events\'</p>
',
			),
			array(
				'name' => 'Minutes',
				'label' => 'Minutes',
				'component' => 'CiviCase',
				'description' => '<p>Used in \'Organise Events\'</p>
',
			),
			array(
				'name' => 'Checklist',
				'label' => 'Checklist',
				'component' => 'CiviCase',
				'description' => '<p>Used in \'Organise Events\'</p>
',
			),
			array(
				'name' => 'Business card request',
				'label' => 'Business card request',
				'component' => NULL,
				'description' => '<p>Used in webform \'Business Card\'</p>
',
			),
			array(
				'name' => 'Claim',
				'label' => 'Claim',
				'component' => NULL,
				'description' => '<p>Kostendeclaratie voor stafvrijwilligers en vaste staf</p>
',
			),
			array(
				'name' => 'Advice Debriefing CC',
				'label' => 'Advice Debriefing CC',
				'component' => 'CiviCase',
				'description' => '<p>Used in \'Advice\'</p>
',
			),
			array(
				'name' => 'Advice Debriefing SC',
				'label' => 'Advice Debriefing SC',
				'component' => 'CiviCase',
				'description' => '<p>Used in \'Advice\'</p>
',
			),
			array(
				'name' => 'Advice Debriefing PrOf',
				'label' => 'Advice Debriefing PrOf',
				'component' => 'CiviCase',
				'description' => '<p>Used in \'Advice\'</p>
',
			),
			array(
				'name' => 'Advice Debriefing Representative',
				'label' => 'Advice Debriefing Representative',
				'component' => 'CiviCase',
				'description' => '<p>Used in \'Advice\'</p>
',
			),
			array(
				'name' => 'Advice Debriefing Customer',
				'label' => 'Advice Debriefing Customer',
				'component' => 'CiviCase',
				'description' => '<p>Used in \'Advice\'</p>
',
			),
			array(
				'name' => 'Advice Debriefing Expert',
				'label' => 'Advice Debriefing Expert',
				'component' => 'CiviCase',
				'description' => '<p>Used in \'Advice\'</p>
',
			),
			array(
				'name' => 'Seminar Debriefing CC',
				'label' => 'Seminar Debriefing CC',
				'component' => 'CiviCase',
				'description' => '<p>Used in \'Seminar\'</p>
',
			),
			array(
				'name' => 'Seminar Debriefing SC',
				'label' => 'Seminar Debriefing SC',
				'component' => 'CiviCase',
				'description' => '<p>Used in \'Seminar\'</p>
',
			),
			array(
				'name' => 'Seminar Debriefing PrOf',
				'label' => 'Seminar Debriefing PrOf',
				'component' => 'CiviCase',
				'description' => '<p>Used in \'Seminar\'</p>
',
			),
			array(
				'name' => 'Seminar Debriefing Representative',
				'label' => 'Seminar Debriefing Representative',
				'component' => 'CiviCase',
				'description' => '<p>Used in \'Seminar\'</p>
',
			),
			array(
				'name' => 'Seminar Debriefing Customer',
				'label' => 'Seminar Debriefing Customer',
				'component' => 'CiviCase',
				'description' => '<p>Used in \'Seminar\'</p>
',
			),
			array(
				'name' => 'Seminar Debriefing Expert',
				'label' => 'Seminar Debriefing Expert',
				'component' => 'CiviCase',
				'description' => '<p>Used in \'Seminar\'</p>
',
			),
			array(
				'name' => 'Remote Coaching Debriefing CC',
				'label' => 'Remote Coaching Debriefing CC',
				'component' => 'CiviCase',
				'description' => '<p>Used in \'Remote Coaching\'</p>
',
			),
			array(
				'name' => 'Remote Coaching Debriefing SC',
				'label' => 'Remote Coaching Debriefing SC',
				'component' => 'CiviCase',
				'description' => '<p>Used in \'Remote Coaching\'</p>
',
			),
			array(
				'name' => 'Remote Coaching Debriefing PrOf',
				'label' => 'Remote Coaching Debriefing PrOf',
				'component' => 'CiviCase',
				'description' => '<p>Used in \'Remote Coaching\'</p>
',
			),
			array(
				'name' => 'Remote Coaching Debriefing Representative',
				'label' => 'Remote Coaching Debriefing Representative',
				'component' => 'CiviCase',
				'description' => '<p>Used in \'Remote Coaching\'</p>
',
			),
			array(
				'name' => 'Remote Coaching Debriefing Customer',
				'label' => 'Remote Coaching Debriefing Customer',
				'component' => 'CiviCase',
				'description' => '<p>Used in \'Remote Coaching\'</p>
',
			),
			array(
				'name' => 'Remote Coaching Debriefing Expert',
				'label' => 'Remote Coaching Debriefing Expert',
				'component' => 'CiviCase',
				'description' => '<p>Used in \'Remote Coaching\'</p>
',
			),
			array(
				'name' => 'Concept list of participants',
				'label' => 'Concept list of participants',
				'component' => 'CiviCase',
				'description' => '<p>Used in \'Seminar\'</p>
',
			),
			array(
				'name' => 'Business Debriefing Expert',
				'label' => 'Business Debriefing Expert',
				'component' => 'CiviCase',
				'description' => '<p>Used in \'Business\'</p>
',
			),
			array(
				'name' => 'Business Debriefing Customer',
				'label' => 'Business Debriefing Customer',
				'component' => 'CiviCase',
				'description' => '<p>Used in \'Business\'</p>
',
			),
			array(
				'name' => 'Business Debriefing CC',
				'label' => 'Business Debriefing CC',
				'component' => 'CiviCase',
				'description' => '<p>Used in \'Business\'</p>
',
			),
			array(
				'name' => 'Business Debriefing SC',
				'label' => 'Business Debriefing SC',
				'component' => 'CiviCase',
				'description' => '<p>Used in \'Business\'</p>
',
			),
			array(
				'name' => 'Business Debriefing PrOf',
				'label' => 'Business Debriefing PrOf',
				'component' => 'CiviCase',
				'description' => '<p>Used in \'Business\'</p>
',
			),
			array(
				'name' => 'Business Programme',
				'label' => 'Business Programme',
				'component' => 'CiviCase',
				'description' => '<p>Used in \'Business\'</p>
',
			),
			array(
				'name' => 'Request Approval Business Programme SC',
				'label' => 'Request Approval Business Programme SC',
				'component' => 'CiviCase',
				'description' => '<p>Used in \'Business\'</p>
',
			),
			array(
				'name' => 'Request Approval Business Programme CC',
				'label' => 'Request Approval Business Programme CC',
				'component' => 'CiviCase',
				'description' => '<p>Used in \'Business\'</p>
',
			),
			array(
				'name' => 'Acquisition',
				'label' => 'Acquisition',
				'component' => 'CiviCase',
				'description' => '<p>Used in \'Advice\' en \'Seminar\'</p>
',
			),
			array(
				'name' => 'Condition: Customer Contribution.',
				'label' => 'Condition: Customer Contribution',
				'component' => 'CiviCase',
				'description' => '<p>Used in \'Advice, RemoteCoaching, Seminar\'</p>
',
			),
			array(
				'name' => 'Exit Expert',
				'label' => 'Exit Expert',
				'component' => 'CiviCase',
				'description' => '<p>This activity is used on the case ExitExpert and contains custom fields</p>
',
			),
			
		);
	}
}
