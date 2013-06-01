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

$schema['products']['content']['items']['fillings']['bestsellers'] = array (
	'params' => array (
		'bestsellers' => true,
		'sales_amount_from' => 1,
		'sort_by' => 'sales_amount',
		'sort_order' => 'desc',
		'request' => array (
			'cid' => '%CATEGORY_ID'
		)
	),
);

?>