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

$schema['references']['seo_names'] = array (
	'reference_fields' => array ('object_id' => '#key', 'type' => 'p', 'dispatch' => '', 'lang_code' => '@lang_code',   'company_id' => 'products.company_id'),
	'join_type' => 'LEFT'
);

$schema['export_fields']['SEO name'] = array (
	'table' => 'seo_names',
	'db_field' => 'name',
	'process_put' => array ('fn_create_import_seo_name', '#key', 'p', '#this', '%Product name%', 0, '', '', '@lang_code'),
);

?>