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
// $Id: init.php 6788 2009-01-16 13:29:11Z zeke $
//

if ( !defined('AREA') ) { die('Access denied'); }

fn_register_hooks(
	'gather_additional_product_data_before_discounts',
	'pre_add_to_cart',
	'generate_cart_id',
	'get_cart_product_data_post_options',
	'place_order',
	'get_status_data',
	'buy_together_pre_add_to_cart',
	'buy_together_restricted_product',
	'pre_add_to_wishlist',
	'change_order_status',
	'get_additional_information',
	'get_products',
	'after_options_calculation',
	'get_predefined_statuses'
);

?>