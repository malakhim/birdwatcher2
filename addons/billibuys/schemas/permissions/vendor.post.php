<?php

if ( !defined('AREA') ) { die('Access denied'); }

// Restrict menu items for vendor backend
// Format is mode => enable or disable permission, then flag for all schema for this controller

$schema['controllers']['shipments'] = array (
	'modes' => array(
			'manage' => array('permissions' => false),
		),
	'permissions' => true
);

$schema['controllers']['billibuys'] = array (
	'modes' => array(
			'categories_manage' => array('permissions' => false),
		),
	'permissions' => true
);

$schema['controllers']['product_features'] = array (
	'modes' => array(
			'manage' => array('permissions' => false),
		),
	'permissions' => true
);

$schema['controllers']['product_filters'] = array (
	'modes' => array(
			'manage' => array('permissions' => false),
		),
	'permissions' => true
);

$schema['controllers']['product_options'] = array (
	'modes' => array(
			'manage' => array('permissions' => false),
		),
	'permissions' => true
);

$schema['controllers']['profiles'] = array (
	'modes' => array(
			'manage' => array('permissions' => false),
		),
	'permissions' => true
);

$schema['controllers']['pages'] = array (
	'modes' => array(
			'manage' => array('permissions' => false),
		),
	'permissions' => true
);

$schema['controllers']['shippings'] = array (
	'modes' => array(
			'manage' => array('permissions' => false),
		),
	'permissions' => true
);

$schema['controllers']['taxes'] = array (
	'modes' => array(
			'manage' => array('permissions' => false),
		),
	'permissions' => true
);

$schema['controllers']['states'] = array (
	'modes' => array(
			'manage' => array('permissions' => false),
		),
	'permissions' => true
);

$schema['controllers']['countries'] = array (
	'modes' => array(
			'manage' => array('permissions' => false),
		),
	'permissions' => true
);

$schema['controllers']['destinations'] = array (
	'modes' => array(
			'manage' => array('permissions' => false),
		),
	'permissions' => true
);

$schema['controllers']['pages'] = array (
	'modes' => array(
			'manage' => array('permissions' => false),
		),
	'permissions' => true
);

$schema['controllers']['companies'] = array (
	'modes' => array(
			'manage' => array('permissions' => false),
		),
	'permissions' => true
);

?>