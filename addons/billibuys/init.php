<?php

if ( !defined('AREA') ) { die('Access denied'); }

	fn_register_hooks(
		'get_product_price_post',
		'order_placement_routines',
		'post_add_to_cart'
	);

?>