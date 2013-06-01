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

fn_register_hooks(
	'update_profile',
	'place_order',
	'edit_place_order',
	'get_users',
	'get_profile_fields',
	'get_user_type_description',
	'pre_promotion_check_coupon',
	'promotion_check_coupon',
	'auth_routines',
	'fill_auth',
	'profile_fields_areas',
	'get_order_info',
	'delete_user',
	'form_cart',
	'get_products_pre',
	'get_products',
	'check_user_type',
	'user_need_login',
	'change_order_status',
	'delete_order',
	'get_user_types',
	'check_user_type_access_rules',
	'get_feedback_data',
	'get_predefined_statuses'
);

?>