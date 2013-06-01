<?php
/***************************************************************************
*                                                                          *
*   (c) 2004 Vladimir V. Kalynyak, Alexey V. Vinokurov, Ilya M. Shalnev    *
*                                                                          *
* This  is  commercial  software,  only  users  who have purchased a valid *
* license  and  accept  to the terms of the  License Agreement can install *
* and use this program.                                                    *
*                                                                          *
****************************************************************************
* PLEASE READ THE FULL TEXT  OF THE SOFTWARE  LICENSE   AGREEMENT  IN  THE *
* "copyright.txt" FILE PROVIDED WITH THIS DISTRIBUTION PACKAGE.            *
****************************************************************************/


if ( !defined('AREA') ) { die('Access denied'); }

// Add new tables
$schema['pages']['database']['form_options'] = array (
	'keys' => array ('element_id'),
	'parent' => array (
		'table' => 'pages',
		'key' => 'page_id',
	),
	'children' => array (
		array (
			'table' => 'form_descriptions',
			'key' => 'element_id',
			'child_key' => 'object_id'
		)
	),
	'is_auto' => true,
	'auto_key' => 'element_id'
);

$schema['pages']['database']['form_descriptions'] = array (
	'keys' => array ('object_id', 'lang_code'),
	'parent' => array (
		'table' => 'form_options',
		'key' => 'element_id',
		'child_key' => 'object_id'
	),
	'children' => array (),
	'is_auto' => false,
);

// Extend children
$schema['pages']['database']['pages']['children'][] = array(
	'table' => 'form_options',
	'key' => 'page_id'
);

?>