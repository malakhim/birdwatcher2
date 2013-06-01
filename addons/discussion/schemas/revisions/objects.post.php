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


//
// $Id: objects.post.php 7538 2009-05-27 15:55:45Z lexa $
//

if ( !defined('AREA') ) { die('Access denied'); }

//
// Add new tables
//
$schema['category']['database']['discussion'] = array (
	'keys' => array ('thread_id'),
	'main_key' => array('object_id' => '#key', 'object_type' => 'C'),
	'parent' => array (),
	'children' => array (),
	'is_auto' => true,
	'auto_key' => 'thread_id'
);
$schema['product']['database']['discussion'] = array (
	'keys' => array ('thread_id'),
	'main_key' => array('object_id' => '#key', 'object_type' => 'P'),
	'parent' => array (),
	'children' => array (),
	'is_auto' => true,
	'auto_key' => 'thread_id'
);

?>