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

if ($mode == 'view') {
	$lang = empty($_REQUEST['lang']) ? CART_LANGUAGE : $_REQUEST['lang'];
	$items_data = $additional_data = $block_data = array();
	if (!empty($_REQUEST['bid']) && !empty($_REQUEST['sid']) && empty($_REQUEST['category_id'])) {
		$block_data = Bm_Block::instance()->get_by_id($_REQUEST['bid'], $_REQUEST['sid'], array(), $lang);
	} else {
		//show rss feed for categories page
		list($items_data, $additional_data) = fn_format_categories_items($_REQUEST);
	}

	if (!empty($block_data['content']['filling']) && $block_data['content']['filling'] == 'products') {

		$params = array (
			'sort_by' => ($block_data['properties']['filling']['products']['rss_sort_by'] == 'U') ? 'updated_timestamp' : 'timestamp',
			'sort_order' => 'desc'
		);

		$max_items = !empty($block_data['properties']['max_item']) ? $block_data['properties']['max_item'] : 5;

		list($products) = fn_get_products($params, $max_items, $lang);
		fn_gather_additional_products_data($products, array('get_icon' => true, 'get_detailed' => true, 'get_options' => false, 'get_discounts' => false));

		$additional_data['title'] = !empty($block_data['properties']['feed_title']) ? $block_data['properties']['feed_title'] : fn_get_lang_var('products') . '::' . fn_get_lang_var('page_title', $lang);
		$additional_data['description'] = !empty($block_data['properties']['feed_description']) ? $block_data['properties']['feed_description'] : $additional_data['title'];
		$additional_data['link'] = fn_url('index.php', 'C', 'http', '', $lang);
		$additional_data['language'] = fn_strtolower($lang);
		$additional_data['lastBuildDate'] = !empty($products[0]['updated_timestamp']) ? $products[0]['updated_timestamp'] : 0;

		$items_data = fn_format_products_items($products, $block_data['properties']['filling']['products'], $lang);
	}

	fn_set_hook('generate_rss_feed', $items_data, $additional_data, $block_data, $lang);

	header('Content-Type: text/xml; charset=utf-8');
	fn_echo(fn_generate_rss($items_data, $additional_data));

	exit;

} elseif ($mode == 'add_to_cart') {
	if (empty($auth['user_id']) && Registry::get('settings.General.allow_anonymous_shopping') != 'Y') {
		fn_redirect("auth.login_form?return_url=" . urlencode($_SERVER['HTTP_REFERER']));
	}

	$cart = & $_SESSION['cart'];

	$lang = empty($_REQUEST['lang']) ? CART_LANGUAGE : $_REQUEST['lang'];

	$product_data = array (
		$_REQUEST['product_id'] => array (
			'product_id' => $_REQUEST['product_id'],
			'amount' => 1
		)
	);

	fn_add_product_to_cart($product_data, $cart, $auth);
	fn_save_cart_content($cart, $auth['user_id']);
	fn_calculate_cart_content($cart, $auth, 'S', true, 'F', true);

	fn_redirect(fn_url('index.php?dispatch=checkout.cart&sl=' . $lang, 'C', 'http', '&amp;', $lang, '', true));
}

?>