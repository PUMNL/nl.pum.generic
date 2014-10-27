<?php

class Generic_Tag_Def {

	// definitions for: Tag

	static function required() {
		return array(
			array(
				'name' => 'Customer',
				'description' => 'nl.pum.generic - Customer of PUM',
				'parent_tag' => NULL,
				'used_for' => 'civicrm_contact',
			),
			array(
				'name' => 'Partner',
				'description' => 'nl.pum.generic - Partner',
				'parent_tag' => NULL,
				'used_for' => 'civicrm_contact',
			),
			array(
				'name' => 'Expert',
				'description' => 'nl.pum.generic - Expert',
				'parent_tag' => NULL,
				'used_for' => 'civicrm_contact',
			),
			array(
				'name' => 'Sector',
				'description' => 'Sector',
				'parent_tag' => NULL,
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'Current customer',
				'description' => 'nl.pum.generic - Current customer',
				'parent_tag' => 'Customer',
				'used_for' => 'civicrm_contact',
			),
			array(
				'name' => 'Former Customer',
				'description' => 'nl.pum.generic - Done projects with PUM in the past',
				'parent_tag' => 'Customer',
				'used_for' => 'civicrm_contact',
			),
			array(
				'name' => 'Prospect Customer',
				'description' => 'nl.pum.generic - Customer who has applied for a project',
				'parent_tag' => 'Customer',
				'used_for' => 'civicrm_contact',
			),
			array(
				'name' => 'Rejected Customer',
				'description' => 'nl.pum.generic - Customer who has applied for a project but has been turned down',
				'parent_tag' => 'Customer',
				'used_for' => 'civicrm_contact',
			),
			array(
				'name' => 'Suspect Customer',
				'description' => 'nl.pum.generic - Customer interested in PUM or vice versa',
				'parent_tag' => 'Customer',
				'used_for' => 'civicrm_contact',
			),
			array(
				'name' => 'New Customer',
				'description' => 'Customer who has applied for a project',
				'parent_tag' => 'Customer',
				'used_for' => 'civicrm_contact',
			),
			array(
				'name' => 'Current Partner',
				'description' => 'nl.pum.generic - Current Partner',
				'parent_tag' => 'Partner',
				'used_for' => 'civicrm_contact',
			),
			array(
				'name' => 'Former Partner',
				'description' => 'nl.pum.generic - Former Partner of PUM',
				'parent_tag' => 'Partner',
				'used_for' => 'civicrm_contact',
			),
			array(
				'name' => 'Hot Prospect Partner',
				'description' => 'nl.pum.generic - Hot prospect partner',
				'parent_tag' => 'Partner',
				'used_for' => 'civicrm_contact',
			),
			array(
				'name' => 'Lost Contact Partner',
				'description' => 'nl.pum.generic - Lost Contact Partner',
				'parent_tag' => 'Partner',
				'used_for' => 'civicrm_contact',
			),
			array(
				'name' => 'Prospect Partner',
				'description' => 'nl.pum.generic - Partner very interested in PUM or vice versa',
				'parent_tag' => 'Partner',
				'used_for' => 'civicrm_contact',
			),
			array(
				'name' => 'Suspect Partner',
				'description' => 'nl.pum.generic - Partner interested in PUM or vice versa',
				'parent_tag' => 'Partner',
				'used_for' => 'civicrm_contact',
			),
			array(
				'name' => 'Candidate Expert',
				'description' => 'nl.pum.generic - Person who has applied to PUM',
				'parent_tag' => 'Expert',
				'used_for' => 'civicrm_contact',
			),
			array(
				'name' => 'Former Expert',
				'description' => 'nl.pum.generic - Expert who used to work for PUM',
				'parent_tag' => 'Expert',
				'used_for' => 'civicrm_contact',
			),
			array(
				'name' => 'Hotel services',
				'description' => 'AOE Hotel services',
				'parent_tag' => 'HOSPITALITY, LARGE HOTELS',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'Front office services',
				'description' => 'AOE Front office services',
				'parent_tag' => 'HOSPITALITY, LARGE HOTELS',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'Housekeeping services',
				'description' => 'AOE Housekeeping services',
				'parent_tag' => 'HOSPITALITY, LARGE HOTELS',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'Food & beverages services/restaurant/bar',
				'description' => 'AOE Food & beverages services/restaurant/bar',
				'parent_tag' => 'HOSPITALITY, LARGE HOTELS',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'Food & beverages services/kitchen',
				'description' => 'AOE Food & beverages services/kitchen',
				'parent_tag' => 'HOSPITALITY, LARGE HOTELS',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'Spa, sports & leisure services',
				'description' => 'AOE Spa, sports & leisure services',
				'parent_tag' => 'HOSPITALITY, LARGE HOTELS',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'Building maintenance',
				'description' => 'AOE Building maintenance',
				'parent_tag' => 'HOSPITALITY, LARGE HOTELS',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'Kitchen maintenance',
				'description' => 'AOE Kitchen maintenance',
				'parent_tag' => 'HOSPITALITY, LARGE HOTELS',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'Events management',
				'description' => 'AOE Events management',
				'parent_tag' => 'HOSPITALITY, LARGE HOTELS',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'Hospitality training/coaching',
				'description' => 'AOE Hospitality training/coaching',
				'parent_tag' => 'HOSPITALITY, LARGE HOTELS',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'Facility management',
				'description' => 'AOE Facility management',
				'parent_tag' => 'HOSPITALITY, LARGE HOTELS',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'ICT systems for hotels',
				'description' => 'AOE ICT systems for hotels',
				'parent_tag' => 'HOSPITALITY, LARGE HOTELS',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'Hotel management',
				'description' => 'AOE Hotel management',
				'parent_tag' => 'HOSPITALITY, LARGE HOTELS',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'HOSPITALITY, LARGE HOTELS',
				'description' => 'SECTOR Hospitality, large hotels',
				'parent_tag' => 'Sector',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'HOSPITALITY, SMALL HOTELS',
				'description' => 'SECTOR Hospitality, small hotels ',
				'parent_tag' => 'Sector',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'RESTAURANTS, CATERING & EVENTS',
				'description' => 'SECTOR Restaurants, catering &amp; events ',
				'parent_tag' => 'Sector',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'TOURISM & RECREATIONAL SERVICES',
				'description' => 'SECTOR Tourism &amp; recreational services  ',
				'parent_tag' => 'Sector',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'METAL CONSTRUCTION, MAINTENANCE & REPAIR',
				'description' => 'SECTOR Metal construction, maintenance &amp; repair ',
				'parent_tag' => 'Sector',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'METAL PROCESSING',
				'description' => 'SECTOR Metal processing',
				'parent_tag' => 'Sector',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'AIRCRAFT MAINTENANCE & SHIPBUILDING & REPAIR',
				'description' => 'SECTOR Aircraft maintenance &amp; shipbuilding &amp; repair ',
				'parent_tag' => 'Sector',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'VOCATIONAL EDUCATION & TRAINING',
				'description' => 'SECTOR Vocational Education & Training',
				'parent_tag' => 'Sector',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'TIMBER PROCESSING',
				'description' => 'SECTOR Timber processing',
				'parent_tag' => 'Sector',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'FURNITURE MANUFACTURING AND SHOPFITTING',
				'description' => 'SECTOR Furniture manufacturing and shopfitting ',
				'parent_tag' => 'Sector',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'TRANSPORT & LOGISTICS',
				'description' => 'SECTOR Transport &amp; Logistics ',
				'parent_tag' => 'Sector',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'WHOLESALE, BUSINESS TO BUSINESS',
				'description' => 'SECTOR Wholesale, business to business ',
				'parent_tag' => 'Sector',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'RETAIL, BUSINESS TO CONSUMER',
				'description' => 'SECTOR Retail, business to consumer',
				'parent_tag' => 'Sector',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'TEXTILES INDUSTRY AND CONSUMER GOODS',
				'description' => 'SECTOR Textiles industry and consumer goods ',
				'parent_tag' => 'Sector',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'LEATHER INDUSTRY AND CONSUMER GOODS',
				'description' => 'SECTOR Leather industry and consumer goods ',
				'parent_tag' => 'Sector',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'ANIMAL FEED PRODUCTION',
				'description' => 'SECTOR Animal Feed Production',
				'parent_tag' => 'Sector',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'BEEKEEPING',
				'description' => 'SECTOR Beekeeping ',
				'parent_tag' => 'Sector',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'DAIRY PROCESSING & PRODUCTS',
				'description' => 'SECTOR Dairy Processing & Products',
				'parent_tag' => 'Sector',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'FISHERIES AND FISH PROCESSING',
				'description' => 'SECTOR Fisheries and fish processing ',
				'parent_tag' => 'Sector',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'PIG FARMING',
				'description' => 'SECTOR Pig farming',
				'parent_tag' => 'Sector',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'POULTRY FARMING',
				'description' => 'SECTOR Poultry farming ',
				'parent_tag' => 'Sector',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'RUMINANT (CATTLE, SHEEP, GOATS, CAMELS, HORSES ETC.)',
				'description' => 'SECTOR Ruminant (cattle, sheep, goats, camels, horses etc.) farming',
				'parent_tag' => 'Sector',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'PRINTING, CROSS MEDIA & PUBLISHING',
				'description' => 'SECTOR Printing, cross media & publishing',
				'parent_tag' => 'Sector',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'PACKAGING',
				'description' => 'SECTOR Packaging',
				'parent_tag' => 'Sector',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'PAPER & BOARD PRODUCTS',
				'description' => 'SECTOR Paper & Board products',
				'parent_tag' => 'Sector',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'HEALTH CARE SERVICES',
				'description' => 'SECTOR Health care services',
				'parent_tag' => 'Sector',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'TRADE UNIONS',
				'description' => 'SECTOR Trade Unions',
				'parent_tag' => 'Sector',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'GOVERNMENT SERVICES',
				'description' => 'SECTOR Government Services',
				'parent_tag' => 'Sector',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'OILS (EDIBLE & FATS)',
				'description' => 'SECTOR Oils (Edible & Fats)',
				'parent_tag' => 'Sector',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'MEAT PROCESSING',
				'description' => 'SECTOR Meat Processing',
				'parent_tag' => 'Sector',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'FOOD PROCESSING',
				'description' => 'SECTOR Food Processing',
				'parent_tag' => 'Sector',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'BEVERAGES PRODUCTION',
				'description' => 'SECTOR Beverages Production',
				'parent_tag' => 'Sector',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'BAKERY, PASTRY & CONFECTIONARY',
				'description' => 'SECTOR Barkery, pastry & Confectionairy',
				'parent_tag' => 'Sector',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'Small hotel/B&B services',
				'description' => 'AOE Small hotel/B&B services',
				'parent_tag' => 'HOSPITALITY, SMALL HOTELS',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'Housekeeping services (small hotels)',
				'description' => 'AOE Housekeeping services',
				'parent_tag' => 'HOSPITALITY, SMALL HOTELS',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'Front office services (small hotels)',
				'description' => 'AOE Front office services',
				'parent_tag' => 'HOSPITALITY, SMALL HOTELS',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'Food & beverages services/kitchen (small hotels)',
				'description' => 'AOE Food & beverages services/kitchen',
				'parent_tag' => 'HOSPITALITY, SMALL HOTELS',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'Sports & leisure services',
				'description' => 'AOE Sports & leisure services',
				'parent_tag' => 'HOSPITALITY, SMALL HOTELS',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'Building maintenance (small hotels)',
				'description' => 'AOE Building maintenance',
				'parent_tag' => 'HOSPITALITY, SMALL HOTELS',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'Kitchen maintenance (small hotels)',
				'description' => 'AOE Kitchen maintenance',
				'parent_tag' => 'HOSPITALITY, SMALL HOTELS',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'Small hotel management',
				'description' => 'AOE Small hotel management',
				'parent_tag' => 'HOSPITALITY, SMALL HOTELS',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'Restaurant, management services',
				'description' => 'AOE Restaurant, management services',
				'parent_tag' => 'RESTAURANTS, CATERING & EVENTS',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'Restaurant, menu engineering',
				'description' => 'AOE Restaurant, menu engineering',
				'parent_tag' => 'RESTAURANTS, CATERING & EVENTS',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'Restaurant, management kitchen',
				'description' => 'AOE Restaurant, management kitchen',
				'parent_tag' => 'RESTAURANTS, CATERING & EVENTS',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'Restaurant, cooking, western/asian/pizza',
				'description' => 'AOE Restaurant, cooking, western/asian/pizza',
				'parent_tag' => 'RESTAURANTS, CATERING & EVENTS',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'Restaurant, stock/food safety, HACCP',
				'description' => 'AOE Restaurant, stock/food safety, HACCP',
				'parent_tag' => 'RESTAURANTS, CATERING & EVENTS',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'Education/training; curriculum/train the trainer',
				'description' => 'AOE Education/training; curriculum/train the trainer',
				'parent_tag' => 'RESTAURANTS, CATERING & EVENTS',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'Catering, management and marketing',
				'description' => 'AOE Catering, management and marketing',
				'parent_tag' => 'RESTAURANTS, CATERING & EVENTS',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'Catering, kitchen, food & beverages, food safety',
				'description' => 'AOE Catering, kitchen, food & beverages, food safety',
				'parent_tag' => 'RESTAURANTS, CATERING & EVENTS',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'Events, organisation, logistics, (E)-marketing',
				'description' => 'AOE Events, organisation, logistics, (E)-marketing',
				'parent_tag' => 'RESTAURANTS, CATERING & EVENTS',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'Meetings, incentives, conferences. exhibitions (MICE)',
				'description' => 'AOE Meetings, incentives, conferences. exhibitions (MICE)',
				'parent_tag' => 'RESTAURANTS, CATERING & EVENTS',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'Travel agent (incoming/outgoing)',
				'description' => 'AOE Travel agent (incoming/outgoing)',
				'parent_tag' => 'TOURISM & RECREATIONAL SERVICES',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'Travel agent, E-marketing, dynamic packaging',
				'description' => 'AOE Travel agent, E-marketing, dynamic packaging',
				'parent_tag' => 'TOURISM & RECREATIONAL SERVICES',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'Travel agent (incoming/outgoing), management',
				'description' => 'AOE Travel agent (incoming/outgoing), management',
				'parent_tag' => 'TOURISM & RECREATIONAL SERVICES',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'Tour operator, marketing',
				'description' => 'AOE Tour operator, marketing',
				'parent_tag' => 'TOURISM & RECREATIONAL SERVICES',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'Tour operator, management, logistics',
				'description' => 'AOE Tour operator, management, logistics',
				'parent_tag' => 'TOURISM & RECREATIONAL SERVICES',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'Tourist Board, tourism strategy/policy',
				'description' => 'AOE Tourist Board, tourism strategy/policy',
				'parent_tag' => 'TOURISM & RECREATIONAL SERVICES',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'Tourist Board, training, PR',
				'description' => 'AOE Tourist Board, training, PR',
				'parent_tag' => 'TOURISM & RECREATIONAL SERVICES',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'Processing raw materials',
				'description' => 'AOE Processing raw materials',
				'parent_tag' => 'METAL CONSTRUCTION, MAINTENANCE & REPAIR',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'Manufacturing finishing products',
				'description' => 'AOE Manufacturing finishing products',
				'parent_tag' => 'METAL CONSTRUCTION, MAINTENANCE & REPAIR',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'Machine parts, spare parts',
				'description' => 'AOE Design, manufacturing, maintenance of',
				'parent_tag' => 'METAL CONSTRUCTION, MAINTENANCE & REPAIR',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'Machines, equipment',
				'description' => 'AOE Design, manufacturing, maintenance of',
				'parent_tag' => 'METAL CONSTRUCTION, MAINTENANCE & REPAIR',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'Vehicles, vessels',
				'description' => 'AOE Design, manufacturing, maintenance of',
				'parent_tag' => 'METAL CONSTRUCTION, MAINTENANCE & REPAIR',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'Structures',
				'description' => 'AOE Design, manufacturing, maintenance of',
				'parent_tag' => 'METAL CONSTRUCTION, MAINTENANCE & REPAIR',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'Mechanisation',
				'description' => 'AOE Design, manufacturing, maintenance of',
				'parent_tag' => 'METAL CONSTRUCTION, MAINTENANCE & REPAIR',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'Quality assurance metal construction',
				'description' => 'AOE Quality assurance metal construction',
				'parent_tag' => 'METAL CONSTRUCTION, MAINTENANCE & REPAIR',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'Workshop management',
				'description' => 'AOE Workshop management',
				'parent_tag' => 'METAL CONSTRUCTION, MAINTENANCE & REPAIR',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'Workshop management Metal processing',
				'description' => 'AOE Workshop management Metal processing',
				'parent_tag' => 'METAL PROCESSING',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'Metal processing equipment maintenance',
				'description' => 'AOE Metal processing equipment maintenance',
				'parent_tag' => 'METAL PROCESSING',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'Metal processing equipment operations',
				'description' => 'AOE Metal processing equipment operations',
				'parent_tag' => 'METAL PROCESSING',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'Melting',
				'description' => 'AOE Product (cast iron, steel, non-ferrous metal) processing:',
				'parent_tag' => 'METAL PROCESSING',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'Refining',
				'description' => 'AOE Product (cast iron, steel, non-ferrous metal) processing:',
				'parent_tag' => 'METAL PROCESSING',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'Sand and die casting',
				'description' => 'AOE Product (cast iron, steel, non-ferrous metal) processing:',
				'parent_tag' => 'METAL PROCESSING',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'Casting',
				'description' => 'AOE Product (cast iron, steel, non-ferrous metal) processing:',
				'parent_tag' => 'METAL PROCESSING',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'Heat treatment',
				'description' => 'AOE Product (cast iron, steel, non-ferrous metal) processing:',
				'parent_tag' => 'METAL PROCESSING',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'Hot/cold rolling',
				'description' => 'AOE Product (cast iron, steel, non-ferrous metal) processing:',
				'parent_tag' => 'METAL PROCESSING',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'Forging',
				'description' => 'AOE Product (cast iron, steel, non-ferrous metal) processing:',
				'parent_tag' => 'METAL PROCESSING',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'Extruding',
				'description' => 'AOE Product (cast iron, steel, non-ferrous metal) processing:',
				'parent_tag' => 'METAL PROCESSING',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'Drawing',
				'description' => 'AOE Product (cast iron, steel, non-ferrous metal) processing:',
				'parent_tag' => 'METAL PROCESSING',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'Surface treatment',
				'description' => 'AOE Product (cast iron, steel, non-ferrous metal) processing:',
				'parent_tag' => 'METAL PROCESSING',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'Product processing Metallurgy and alloying',
				'description' => 'AOE Product (cast iron, steel, non-ferrous metal) processing:',
				'parent_tag' => 'METAL PROCESSING',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'Workshop management equipment making',
				'description' => 'AOE Workshop management equipment making',
				'parent_tag' => 'METAL MACHINE ENGINEERING &amp; CONSTRUCTION- SYSTEM',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'Quality assurance metal construction (2)',
				'description' => 'Quality assurance metal construction',
				'parent_tag' => 'METAL MACHINE ENGINEERING &amp; CONSTRUCTION- SYSTEM',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'Agriculture equipment',
				'description' => 'AOE Product (making equipment for) :',
				'parent_tag' => 'METAL MACHINE ENGINEERING &amp; CONSTRUCTION- SYSTEM',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'Textile equipment',
				'description' => 'AOE Product (making equipment for) :',
				'parent_tag' => 'METAL MACHINE ENGINEERING &amp; CONSTRUCTION- SYSTEM',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'Pulp & paper equipment',
				'description' => 'AOE Product (making equipment for) :',
				'parent_tag' => 'METAL MACHINE ENGINEERING &amp; CONSTRUCTION- SYSTEM',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'Chemical equipment',
				'description' => 'AOE Product (making equipment for) :',
				'parent_tag' => 'METAL MACHINE ENGINEERING &amp; CONSTRUCTION- SYSTEM',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'Food equipment',
				'description' => 'AOE Product (making equipment for) :',
				'parent_tag' => 'METAL MACHINE ENGINEERING &amp; CONSTRUCTION- SYSTEM',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'Packaging equipment',
				'description' => 'AOE Product (making equipment for) :',
				'parent_tag' => 'METAL MACHINE ENGINEERING &amp; CONSTRUCTION- SYSTEM',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'Internal transport equipment',
				'description' => 'AOE Product (making equipment for) :',
				'parent_tag' => 'METAL MACHINE ENGINEERING &amp; CONSTRUCTION- SYSTEM',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'Boiler equipment',
				'description' => 'AOE Product (making equipment for) :',
				'parent_tag' => 'METAL MACHINE ENGINEERING &amp; CONSTRUCTION- SYSTEM',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'Heat exchanges equipment',
				'description' => 'AOE Product (making equipment for) :',
				'parent_tag' => 'METAL MACHINE ENGINEERING &amp; CONSTRUCTION- SYSTEM',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'Pressure vessels equipment',
				'description' => 'AOE Product (making equipment for) :',
				'parent_tag' => 'METAL MACHINE ENGINEERING &amp; CONSTRUCTION- SYSTEM',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'Heating/cooling equipment',
				'description' => 'AOE Product (making equipment for) :',
				'parent_tag' => 'METAL MACHINE ENGINEERING &amp; CONSTRUCTION- SYSTEM',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'Welding equipment',
				'description' => 'AOE Product (making equipment for) :',
				'parent_tag' => 'METAL MACHINE ENGINEERING &amp; CONSTRUCTION- SYSTEM',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'Workshop management (2)',
				'description' => 'AOE Workshop management',
				'parent_tag' => 'AIRCRAFT MAINTENANCE & SHIPBUILDING & REPAIR',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'Small aircraft maintenance',
				'description' => 'AOE Small aircraft maintenance',
				'parent_tag' => 'AIRCRAFT MAINTENANCE & SHIPBUILDING & REPAIR',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'Ship design (sea and river going vessels)',
				'description' => 'AOE Ship design (sea and river going vessels)',
				'parent_tag' => 'AIRCRAFT MAINTENANCE & SHIPBUILDING & REPAIR',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'Ship construction (metal, wood, polyesthers)',
				'description' => 'AOE Ship construction (metal, wood, polyesthers)',
				'parent_tag' => 'AIRCRAFT MAINTENANCE & SHIPBUILDING & REPAIR',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'Ship maintenance',
				'description' => 'AOE Ship maintenance',
				'parent_tag' => 'AIRCRAFT MAINTENANCE & SHIPBUILDING & REPAIR',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'Assistance in developing new curricula',
				'description' => 'AOE Assistance in developing new curricula ',
				'parent_tag' => 'VOCATIONAL EDUCATION & TRAINING',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'Assistance in adapting existing curricula',
				'description' => 'AOE Assistance in adapting existing curricula',
				'parent_tag' => 'VOCATIONAL EDUCATION & TRAINING',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'Help in reconstructing curricula',
				'description' => 'AOE Help in reconstructing curricula',
				'parent_tag' => 'VOCATIONAL EDUCATION & TRAINING',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'Implementation of new studies',
				'description' => 'AOE Implementation of new studies ',
				'parent_tag' => 'VOCATIONAL EDUCATION & TRAINING',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'Advise on methodology',
				'description' => 'AOE Advise on methodology ',
				'parent_tag' => 'VOCATIONAL EDUCATION & TRAINING',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'Advise on how to teach (theories/practical skills, etc.)',
				'description' => 'AOE Advise on how to teach (theories/practical skills, etc.) ',
				'parent_tag' => 'VOCATIONAL EDUCATION & TRAINING',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'Advise on design/managing new programmes',
				'description' => 'AOE Advise on design/managing new programmes ',
				'parent_tag' => 'VOCATIONAL EDUCATION & TRAINING',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'Advise on design/managing new laboratories',
				'description' => 'AOE Advise on design/managing new laboratories ',
				'parent_tag' => 'VOCATIONAL EDUCATION & TRAINING',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'Assistance in the development of teaching materials',
				'description' => 'AOE Assistance in the development of teaching materials ',
				'parent_tag' => 'VOCATIONAL EDUCATION & TRAINING',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'Train-the-trainers/teach-the-teachers programmes',
				'description' => 'AOE Train-the-trainers/teach-the-teachers programmes ',
				'parent_tag' => 'VOCATIONAL EDUCATION & TRAINING',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'Restructuring (management) of school organisation',
				'description' => 'AOE (Re)structuring (management) of school organisation',
				'parent_tag' => 'VOCATIONAL EDUCATION & TRAINING',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'Training of management of educational instituteS',
				'description' => 'AOE Training of management of educational instituteS ',
				'parent_tag' => 'VOCATIONAL EDUCATION & TRAINING',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'Setting up a new department',
				'description' => 'AOE Setting up a new department ',
				'parent_tag' => 'VOCATIONAL EDUCATION & TRAINING',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'Setting up a new programme',
				'description' => 'AOE Setting up a new programme ',
				'parent_tag' => 'VOCATIONAL EDUCATION & TRAINING',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'Setting up a multimedia centre, a library',
				'description' => 'AOE Setting up a multimedia centre, a library ',
				'parent_tag' => 'VOCATIONAL EDUCATION & TRAINING',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'Introducing an automation system, E-learning, etc.',
				'description' => 'AOE Introducing an automation system, E-learning, etc. ',
				'parent_tag' => 'VOCATIONAL EDUCATION & TRAINING',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
			array(
				'name' => 'Education/training; problem based learning',
				'description' => 'AOE Education/training; problem based learning',
				'parent_tag' => 'VOCATIONAL EDUCATION & TRAINING',
				'used_for' => 'civicrm_contact,civicrm_activity,civicrm_case',
			),
		);
	}
}