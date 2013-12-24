<?php

if ( !defined('AREA') ) { die('Access denied'); }

$schema['controllers']['billibuys'] = array (
	'modes' => array(
		'view' => true,
		'notify' => true,
		'categories_manage'=> false
	),
	'permissions' => true
);

?>