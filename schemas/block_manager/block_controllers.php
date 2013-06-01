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

$schema = array (
	'products' => array (
		'view' => 'products'
	),
	'categories' => array(
	 	'view' => 'categories'
	 ),
	'pages' => 'pages',
	'index' => 'index',
	'checkout' => array (
		'cart' => 'cart',
		'checkout' => 'checkout',
		'summary' => 'checkout',
		'customer_info' => 'checkout',
		'complete' => 'order_landing_page'
	)
);

?>