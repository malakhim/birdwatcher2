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

function fn_bundled_products_update_chain($item_id, $product_id, $item_data, $auth, $lang_code = CART_LANGUAGE)
{
	if (empty($product_id) || $product_id == 0) {
		return false;
	}

	$show_notice = true;
	$item_data['product_id'] = $product_id;
	
	if (!empty($item_data['products'])) {
		foreach ($item_data['products'] as $key => $product) {
			// Delete products with empty amount
			if (empty($product['amount']) || intval($product['amount']) == 0) {
				unset($item_data['products'][$key]);
				continue;
			}
			
			$item_data['products'][$key]['modifier'] = floatval($item_data['products'][$key]['modifier']);
			
			$is_restricted = false;
			
			fn_set_hook('bundled_products_restricted_product', $product['product_id'], $auth, $is_restricted, $show_notice);
			
			if ($is_restricted) {
				unset($item_data['products'][$key]);
			}
		}
		
		$item_data['products'] = serialize($item_data['products']);
		
	} else {
		$item_data['products'] = array();
	}
	
	if (!empty($item_data['date_from'])) {
		$item_data['date_from'] = fn_parse_date($item_data['date_from']);
	}
	
	if (!empty($item_data['date_to'])) {
		$item_data['date_to'] = fn_parse_date($item_data['date_to']);
	}
	
	if (empty($item_id) || $item_id == 0) {
		//Create a new chain
		$item_id = db_query("INSERT INTO ?:bundled_products ?e", $item_data);
	
		if (empty($item_id)) {
			return false;
		}
		
		$_data = array();
		$_data['chain_id'] = $item_id;
		$_data['name'] = !empty($item_data['name']) ? $item_data['name'] : '';
		$_data['description'] = !empty($item_data['description']) ? $item_data['description'] : '';
		
		foreach ((array)Registry::get('languages') as $_data['lang_code'] => $v) {
			db_query("INSERT INTO ?:bundled_products_descriptions ?e", $_data);
		}
	
	} else {
		//Update already existing chain
		$_data = array();
		$_data['chain_id'] = $item_id;
		$_data['name'] = !empty($item_data['name']) ? $item_data['name'] : '';
		$_data['description'] = !empty($item_data['description']) ? $item_data['description'] : '';
		
		db_query("UPDATE ?:bundled_products SET ?u WHERE chain_id = ?i", $item_data, $item_id);
		db_query("UPDATE ?:bundled_products_descriptions SET ?u WHERE chain_id = ?i AND lang_code = ?s", $_data, $item_id, $lang_code);
	}
	
	return $item_id;
}

function fn_bundled_products_get_chains($params = array(), $auth = array(), $lang_code = CART_LANGUAGE)
{
	$fields = array(
		'items.chain_id',
		'items.product_id',
		'items.products',
		'items.modifier',
		'items.modifier_type',
		'items.date_from',
		'items.date_to',
		'items.display_in_promotions',
		'items.status',
		'descr.name',
		'descr.description',		
	);

	if (PRODUCT_TYPE == 'ULTIMATE') {
		$fields[] = 'p.company_id';
	}
	
	$conditions = array();

	if (!empty($params['product_id'])) {
		$conditions[] = db_quote('items.product_id = ?i', $params['product_id']);
	}

	if (!empty($params['chain_id'])) {
		$conditions[] = db_quote('items.chain_id = ?i', $params['chain_id']);
	}
	
	if (!empty($params['status'])) {
		$conditions[] = db_quote('items.status = ?s', $params['status']);
	}
	
// 	if (!empty($params['date']) && $params['date']) {
// 		$date = gmmktime(0, 0, 0);
// 		$conditions[] = db_quote('(items.date_from <= ?i AND items.date_to >= ?i)', $date, $date);
// 	}
	
	if (!empty($params['promotions']) && $params['promotions']) {
		$conditions[] = db_quote('items.display_in_promotions = ?s', 'Y');
	}
	
	if (!empty($conditions)) {
		$condition = 'WHERE ' . implode(' AND ', $conditions);
	} else {
		$condition = '';
	}
	
	$fields = implode(', ', $fields);

	$chains = db_get_array("SELECT $fields FROM ?:bundled_products AS items LEFT JOIN ?:products AS p ON p.product_id = items.product_id LEFT JOIN ?:bundled_products_descriptions AS descr ON items.chain_id = descr.chain_id AND descr.lang_code = ?s $condition", $lang_code);
	
	if (!empty($chains)) {
		foreach ($chains as $key => $chain) {
			$chains[$key]['products'] = unserialize($chain['products']);

			if (!empty($params['full_info'])) {
				if ($params['full_info']) {
					if (isset($auth['area']) && $auth['area'] == 'C' && empty($chains[$key]['products'])) {
						unset($chains[$key]);
						
						continue;
					}
					
					$chains[$key]['products_info'] = $chains[$key]['products'];
					$is_valid = true;
					
					$_product = fn_get_product_data($chain['product_id'], $auth, CART_LANGUAGE, '', true, true, true, true);
					
					if (empty($_product)) {
						unset($chains[$key]);
						continue;
					}
					
					fn_gather_additional_product_data($_product, true, true);
		
					$chains[$key]['product_name'] = $_product['product'];
					$chains[$key]['chain_amount'] = ($_product['min_qty'] > 0) ? $_product['min_qty'] : 1;
					$chains[$key]['min_qty'] = $_product['min_qty'] = 1;
					$chains[$key]['price'] = $_product['price'];
					$chains[$key]['list_price'] = $_product['list_price'];
					$chains[$key]['main_pair'] = $_product['main_pair'];
					$chains[$key]['default_options'] = fn_get_default_product_options($_product['product_id']);
					$chains[$key]['product_options'] = $_product['product_options'];
					list($chains[$key]['discount'], $chains[$key]['discounted_price']) = fn_bundled_products_calculate_discount($_product['price'], $chain['modifier'], $chain['modifier_type']);
					$chains[$key]['options_type'] = $_product['options_type'];
					$chains[$key]['exceptions_type'] = $_product['exceptions_type'];
					
					isset($_product['options_update']) ? $chains[$key]['options_update'] = $_product['options_update'] : $chains[$key]['options_update'] = false;
					
					$total_price = $_product['price'];
// 					$total_price = 0;
					$chain_price = $chains[$key]['discounted_price'];
					
					foreach ($chains[$key]['products'] as $hash => $product) {
						if (empty($product['product_id'])) {
							unset($chains[$key]['products'][$hash]);
							unset($chains[$key]['products_info'][$hash]);
							
							continue;
						}
						
						$_product = fn_get_product_data($product['product_id'], $auth, CART_LANGUAGE, '', true, true, true, true);
						
						if (empty($_product)) {
							$is_valid = false;
							break;
						}
						
						if (!empty($product['product_options'])) {
							$_product['selected_options'] = $product['product_options'];
						}
						
						fn_gather_additional_product_data($_product, true, true);
						
						$_product['min_qty'] = ($_product['min_qty'] > 0) ? $_product['min_qty'] : 1;
						
						$chains[$key]['products'][$hash]['product_name'] = $_product['product'];
						$chains[$key]['products'][$hash]['min_qty'] = $_product['min_qty'];
						$chains[$key]['products'][$hash]['price'] = empty($chains[$key]['products'][$hash]['price']) ? $_product['price'] : $chains[$key]['products'][$hash]['price'];
						$chains[$key]['products'][$hash]['list_price'] = $_product['list_price'];
						$chains[$key]['products'][$hash]['main_pair'] = $_product['main_pair'];
						$chains[$key]['products'][$hash]['options_type'] = $_product['options_type'];
						$chains[$key]['products'][$hash]['exceptions_type'] = $_product['exceptions_type'];
						isset($_product['options_update']) ? $chains[$key]['products'][$hash]['options_update'] = $_product['options_update'] : $chains[$key]['products'][$hash]['options_update'] = false;
						
						list($chains[$key]['products'][$hash]['discount'], $chains[$key]['products'][$hash]['discounted_price']) = fn_bundled_products_calculate_discount($_product['price'], empty($product['modifier']) ? 0 : $product['modifier'], empty($product['modifier_type']) ? 'to_fixed' : $product['modifier_type']);
						
						$total_price += $_product['price'] * $product['amount'];
						$chain_price += $chains[$key]['products'][$hash]['discounted_price'] * $product['amount'];
						
						if (!empty($product['product_options'])) {
							$chains[$key]['products'][$hash]['product_options_short'] = $chains[$key]['products'][$hash]['product_options'];
							
							$options = fn_get_selected_product_options_info($product['product_options'], DESCR_SL);
							$chains[$key]['products'][$hash]['product_options'] = $options;
							
						} elseif (!empty($_product['product_options'])) {
							$chains[$key]['products'][$hash]['aoc'] = true; // Allow any option combinations
							$chains[$key]['products'][$hash]['options'] = $_product['product_options'];
						}
						
						$chains[$key]['products_info'][$hash]['price'] = $chains[$key]['products'][$hash]['price'];
						$chains[$key]['products_info'][$hash]['discount'] = $chains[$key]['products'][$hash]['discount'];
						$chains[$key]['products_info'][$hash]['discounted_price'] = $chains[$key]['products'][$hash]['discounted_price'];
					}
				}
				
				if (!$is_valid) {
					unset($chains[$key]);
					continue;
				}
				
				$chains[$key]['total_price'] = $total_price;
				$chains[$key]['chain_price'] = $chain_price;
			}

			if (!empty($params['simple'])) {
				if ($params['simple']) {
					return $chains[$key];
				}
			}
		
		}
	}
	
	return $chains;
}

function fn_bundled_products_delete_chain($chain_id)
{
	$product_id = db_get_field("SELECT product_id FROM ?:bundled_products WHERE chain_id = ?i", $chain_id);
		
	db_query('DELETE FROM ?:bundled_products WHERE chain_id = ?i', $chain_id);
	db_query('DELETE FROM ?:bundled_products_descriptions WHERE chain_id = ?i', $chain_id);
	
	return $product_id;
}

function fn_bundled_products_delete_product_pre($product_id, $status)
{
	$chains = db_get_array('SELECT chain_id, product_id, products FROM ?:bundled_products WHERE product_id = ?i OR products LIKE ?l', $product_id, '%"' . $product_id . '"%');
	
	if (!empty($chains)) {
		foreach ($chains as $chain) {
			$delete = false;
			
			if ($chain['product_id'] == $product_id) {
					$delete = true;
			}
			
			if (!$delete) {
				$products = unserialize($chain['products']);
				foreach ($products as $id => $product) {
					if ($product['product_id'] == $product_id) {
						$delete = true;
						
						break;
					}
				}
			}
			
			if ($delete) {
				fn_bundled_products_delete_chain($chain['chain_id']);
			}
		}
	}
}

function fn_bundled_products_pre_add_to_cart(&$product_data, &$cart, &$auth, $update)
{

	
	if ($update == true) {
		foreach ($product_data as $key => $value) {
			if (!empty($cart['products'][$key]['extra']['bundled_products'])) {
				$product_data[$key]['extra']['bundled_products'] = $cart['products'][$key]['extra']['bundled_products'];
				$product_data[$key]['extra']['buy_id'] = $cart['products'][$key]['extra']['buy_id'];
				$product_data[$key]['extra']['chain'] = $cart['products'][$key]['extra']['chain'];
				$product_data[$key]['extra']['min_qty'] = $cart['products'][$key]['extra']['min_qty'];
				$product_data[$key]['extra']['chain_amount'] = $cart['products'][$key]['extra']['chain_amount'];
				$product_data[$key]['original_amount'] = isset($cart['products'][$key]['original_amount']) ? $cart['products'][$key]['original_amount'] : 0;
				
				if ($value['amount'] < $cart['products'][$key]['extra']['chain_amount']) {
					$product_data[$key]['amount'] = $cart['products'][$key]['extra']['chain_amount'];
				}
				
				if (!empty($value['product_options'])) {
					$product_data[$key]['extra']['product_options'] = $value['product_options'];
				}
				
				$cart_id = fn_generate_cart_id($value['product_id'], $product_data[$key]['extra'], false);
				
				foreach ($cart['products'] as $k => $v) {
					if (isset($v['extra']['parent']['bundled_products']) && $v['extra']['parent']['bundled_products'] == $key) {
						if (isset($v['extra']['min_qty'])) {
							$min_qty = $v['extra']['min_qty'];
							$product_data[$k]['extra']['min_qty'] = $min_qty;
						} else {
							$min_qty = 1;
						}
						
						if (!empty($v['product_options'])) {
							$product_data[$k]['product_options'] = $v['product_options'];
						}
						
						$product_data[$k]['product_id'] = $v['product_id'];
						$product_data[$k]['amount'] = $value['amount'] * $min_qty;
						$product_data[$k]['extra']['parent']['bundled_products'] = $cart_id;
						$product_data[$key]['bundled_products'][$k] = $product_data[$k]['amount'];
						$product_data[$k]['extra']['chain'] = $cart['products'][$k]['extra']['chain'];
					}
				}
			}
		}

	} else {
		
		foreach ($product_data as $key => $value) {
			if (!empty($value['chain'])) {
				// Add a new product chain
				$params['status'] = 'A';
				$params['chain_id'] = $value['chain'];
				$params['simple'] = true;
				$params['full_info'] = true;
				$chain_amount = $value['amount'];
				$chain = fn_bundled_products_get_chains($params, $auth);
				
				if (!empty($chain)) {
					$product_data[$key] = array(
						'product_id' => $chain['product_id'],
						'product_options' => empty($value['product_options']) ? $chain['default_options'] : $value['product_options'],
						'amount' => $value['amount'],
						'original_amount' => $value['amount'],
						'bundled_products' => array(),
						'chain_id' => intval($chain['chain_id']),
					);
					
					$bundled_products = array();
					
					foreach ($chain['products'] as $hash => $product) {
						$product_options = '';
						
						if (!empty($product['product_options_short'])) {
							$product_options = $product['product_options_short'];
						} elseif (isset($product_data[$product['product_id']]['product_options'])) {
							$product_options = $product_data[$product['product_id']]['product_options'];
						}
						
						$product_id = $product['product_id'];
						$product['product_id'] = uniqid();
						
						$product_data[$chain['product_id'] . '_' . $chain['chain_id']]['bundled_products'][$product['product_id']] = $product_options;
						
						$product_data[$product['product_id']] = array(
							'product_id' => $product_id,
							'product_options' => $product_options,
							'amount' => $product['amount'] * $product_data[$key]['amount'],
							'original_amount' => $product['amount'] * $product_data[$key]['amount'],
						);
						
						$product_data[$product['product_id']]['extra'] = empty($product_data[$product_id]['extra']) ? array() : $product_data[$product_id]['extra'];
						$product_data[$product['product_id']]['extra']['chain']['hash'] = $hash;
						$product_data[$product['product_id']]['extra']['chain']['chain_id'] = $value['chain'];
						
						if (!empty($product['options'])) {
							foreach ($product['options'] as $option_id => $option) {
								if ($option['option_type'] == 'F') {
									$product_data[$product['product_id']]['product_options'][$option_id] = $option_id;
								}
							}
						}
						
						unset($product_data[$product_id]);
						
						$bundled_products[$product['product_id']] = $product['amount'];
					}

					
					
					if (!empty($product_data[$key]['bundled_products'])) {
						$product_data[$key]['extra']['bundled_products'] = $product_data[$key]['bundled_products'];
						$product_data[$key]['extra']['chain']['chain_id'] = $value['chain'];
						$product_data[$key]['extra']['min_qty'] = $chain['min_qty'];
						$product_data[$key]['extra']['chain_amount'] = $chain['chain_amount'];
						
						
						if (!empty($product_data[$key]['product_options'])) {
							$product_data[$key]['extra']['product_options'] = $product_data[$key]['product_options'];
						}
						
						$cart_id = fn_generate_cart_id($key, $product_data[$key]['extra'], false);
						
						foreach ($product_data[$key]['bundled_products'] as $_product_id => $_options) {
							$product_data[$_product_id]['extra']['parent']['bundled_products'] = $cart_id;
							$product_data[$_product_id]['extra']['min_qty'] = $bundled_products[$_product_id];
						}
					}
					
					$product_data[$key]['bundled_products'] = $bundled_products;
				}
				
				unset($product_data[$key]['chain'], $product_data[$key]['chain_data']);
			}
		}
		
		fn_set_hook('bundled_products_pre_add_to_cart', $product_data, $cart, $auth, $update);

		foreach ($product_data as $k => $v) {
			if (empty($v['chain_id'])  && !empty($v['extra'])) {
				$_temp = $v;
				if ($v['amount'] > 1 && $chain_amount != 1) {
					$_temp['amount'] = 1 * $chain_amount;
					$_temp['original_amount'] = 1 * $chain_amount;
					$_temp['extra']['min_qty'] = 1 * $chain_amount;
				} else {
					$_temp['amount'] = $v['amount'] * $chain_amount;
					$_temp['original_amount'] = $v['amount'] * $chain_amount;
					$_temp['extra']['min_qty'] = $v['amount'] * $chain_amount;
				}
				foreach ($product_data as $kk => $vv) {
					if ($k != $kk && $vv['product_id'] == $v['product_id'] && !empty($vv['product_options'])) {
// 						$hash = fn_generate_cart_id($v['product_id'], array('product_options' => $vv['product_options']));
						$_temp['product_options'] = $vv['product_options'];
// 						$_temp['extra']['chain']['hash'] = $hash;
						unset($product_data[$kk]);
						
						
						if (!in_array($_temp, $_product_data)) {
							$__key = uniqid();
							$_product_data[$__key] = $_temp;
							$new_keys[$__key] = $__key;
							$del_keys[$k] = $k;
						} else {
							$find_key = array_search($_temp, $_product_data);
							$_product_data[$find_key]['amount'] +=1;
							$_product_data[$find_key]['original_amount'] +=1;
							$_product_data[$find_key]['extra']['min_qty'] +=1;
							
						}
					}
					
				}
			} 
		}
		
		if (!empty($del_keys)) {
			foreach ($del_keys as $del_key) {
				unset($product_data[$del_key]);
				foreach ($product_data as $k => $v) {
					if (!empty($v['chain_id']) && !empty($v['bundled_products'])) {
						unset($product_data[$k]['bundled_products'][$del_key]);
						if (!empty($new_keys)) {
							foreach ($new_keys as $kk => $vv) {
								$product_data[$k]['bundled_products'][$vv] = 1;	
								$product_data[$k]['extra']['bundled_products'][$vv] = '';
							}
						}
						 
					}
				}
			}

		}

		

		foreach ($product_data as $k => $v) { 
			if (!empty($v['chain_id']) && !empty($v['bundled_products'])) {
				$product_data[$k]['extra']['bundled_products'] = $product_data[$k]['bundled_products'];
			}
		}
		
		if (!empty($new_keys)){
			$product_data = array_merge($product_data, $_product_data);
		}
	
		// Regenerate cart_id if needed
		foreach ($product_data as $key => $value) {
			if (!empty($value['bundled_products'])) {
				$cart_id = fn_generate_cart_id($key, $value['extra'], false);
				
				foreach ($value['bundled_products'] as $_product_id => $_options) {
					$product_data[$_product_id]['extra']['parent']['bundled_products'] = $cart_id;
				}
				
				$product_data[$key]['extra']['buy_id'] = $cart_id;
			}
		}
	}

	
	if (AREA != 'A') {
		$product_data = fn_bundled_products_check_products_amount($product_data, $cart);
	}
}

function fn_bundled_products_add_to_cart($cart, $product_id, $cart_id)
{
	if (!empty($cart['products'][$cart_id]['extra']['parent']['bundled_products']) && !isset($cart['products'][$cart['products'][$cart_id]['extra']['parent']['bundled_products']])) {
		$found = false;
		
		foreach ($cart['products'] as $_id => $_product) {
			if (!empty($_product['extra']['buy_id']) && $cart['products'][$cart_id]['extra']['parent']['bundled_products'] == $_product['extra']['buy_id']) {
				$found = true;
				break;
			}
		}
		
		if (!$found) {
			unset($cart['products'][$cart_id]);
			
// 			fn_set_notification('E', fn_get_lang_var('error'), fn_get_lang_var('bundled_products_combination_cannot_be_added'));
			
			$cart['skip_notification'] = true;
		}
	}
}

function fn_bundled_products_generate_cart_id(&$_cid, $extra, $only_selectable = false)
{
	// Buy together product
	if (!empty($extra['chain'])) {
		$_cid[] = 'chain_' . $extra['chain']['chain_id'];
		
	} elseif (!empty($extra['bundled_products']) && is_array($extra['bundled_products'])) {
		foreach ($extra['bundled_products'] as $k => $v) {
			$_cid[] = serialize($v);
		}
	}

	// Product in bundled_products
	if (!empty($extra['parent']['bundled_products'])) {
		$_cid[] = $extra['parent']['bundled_products'];
	}
}

function fn_bundled_products_calculate($items, $auth = array())
{
	$total_price = 0;
	
	$product = fn_get_product_data($items['product_id'], $auth, CART_LANGUAGE, '', true, true, true, true);
	fn_gather_additional_product_data($product, true, true);
	
	$total_price += $product['price'] * $product['min_qty'];
	foreach ($items['item_data']['products'] as $hash => $product) {
		if (!is_integer($hash)) {
			continue;
		}
		
		$_product = fn_get_product_data($product['product_id'], $auth, CART_LANGUAGE, '', true, true, true, true);
		fn_gather_additional_product_data($_product, true, true);
		
		$price = $_product['price'] * $product['amount'];
		
		if (!empty($product['product_options'])) {
			$options = fn_get_selected_product_options_info($product['product_options'], DESCR_SL);
			
			if (!empty($options)) {
				foreach ($options as $option) {
					if ($option['modifier_type'] == 'A') {
						$price += $option['modifier'] * $product['amount'];
					} else {
						$price += ($_product['price'] + $_product['price'] * $option['modifier'] / 100) * $product['amount'];
					}
				}
			}
		}
		
		$total_price += $price;
	}
	
	$discounted_price = $total_price;
	
	switch ($items['discount_type'])
	{
		case 'to_fixed':
			$discounted_price = $items['discount_value'];
			$discount = $total_price - $items['discount_value'];
			break;
			
		case 'by_fixed':
			$discounted_price -= $items['discount_value'];
			$discount = $items['discount_value'];
			break;
			
		case 'to_percentage':
			$discounted_price = ($discounted_price / 100) * $items['discount_value'];
			$discount = $total_price - ($total_price / 100) * $items['discount_value'];
			break;
			
		case 'by_percentage':
			$discounted_price = $discounted_price - (($discounted_price / 100) * $items['discount_value']);
			$discount = ($total_price / 100) * $items['discount_value'];
			break;
	}
	
	if ($discounted_price < 0) {
		$discounted_price = 0;
	}
	
	if ($discount < 0 || $discount > $total_price) {
		$discount = $total_price;
	}
	
	return array(fn_format_price($total_price), fn_format_price($discount), fn_format_price($discounted_price));
}

function fn_bundled_products_calculate_discount($price, $modifier = 0, $modifier_type = 'to_fixed')
{
	$discount = 0;
	
	switch ($modifier_type)
	{
		case 'to_fixed':
			$discount = $price - $modifier;
			break;
			
		case 'by_fixed':
			$discount = $modifier;
			break;
			
		case 'to_percentage':
			$discount = $price - ($price / 100) * $modifier;
			break;
			
		case 'by_percentage':
			$discount = ($price / 100) * $modifier;
			break;
	}
	
	if ($discount > $price) {
		$discount = $price;
	}
	
	$discount = fn_format_price($discount);
	$discounted_price = $price - $discount;
	
	return array($discount, $discounted_price);
}

function fn_bundled_products_calculate_cart(&$cart, &$cart_products)
{

	

	if (isset($cart['products']) && is_array($cart['products'])) {
		foreach ($cart['products'] as $key => $value) {
			if (!empty($value['extra']['bundled_products'])) {
				foreach ($cart_products as $k => $v) {
					if (!empty($cart['products'][$k]['extra']['parent']['bundled_products']) && $cart['products'][$k]['extra']['parent']['bundled_products'] == $key) {
						$cart_products[$key]['subtotal'] += $cart_products[$k]['subtotal'];
						$cart_products[$key]['display_subtotal'] += $cart_products[$k]['display_subtotal'];
						$cart_products[$key]['original_price'] += $cart_products[$k]['original_price'] * $v['amount'];
						$cart_products[$key]['price'] += $cart_products[$k]['price'] * $cart['products'][$k]['extra']['min_qty'];
						$cart_products[$key]['display_price'] += $cart_products[$k]['display_price'] * $cart['products'][$k]['extra']['min_qty'];

						if (!empty($cart_products[$k]['tax_summary'])) {
							if (isset($cart_products[$key]['tax_summary'])) {
								$cart_products[$key]['tax_summary']['included'] += $cart_products[$k]['tax_summary']['included'];
								$cart_products[$key]['tax_summary']['added'] += $cart_products[$k]['tax_summary']['added'];
								$cart_products[$key]['tax_summary']['total'] += $cart_products[$k]['tax_summary']['total'];
							} else {
								$cart_products[$key]['tax_summary']['included'] = $cart_products[$k]['tax_summary']['included'];
								$cart_products[$key]['tax_summary']['added'] = $cart_products[$k]['tax_summary']['added'];
								$cart_products[$key]['tax_summary']['total'] = $cart_products[$k]['tax_summary']['total'];
							}
						}
						
						if (!empty($cart_products[$k]['discount'])) {
							$cart_products[$key]['discount'] = (!empty($cart_products[$key]['discount']) ? $cart_products[$key]['discount'] : 0) + $cart_products[$k]['discount'];
						}
						
						if (!empty($cart_products[$k]['tax_value'])) {
							$cart_products[$key]['tax_value'] = (!empty($cart_products[$key]['tax_value']) ? $cart_products[$key]['tax_value'] : 0) + $cart_products[$k]['tax_value'] * $cart['products'][$k]['extra']['min_qty'];
						}
					}
				}
				$cart['products'][$key]['display_price'] = $cart_products[$key]['display_price'];
			}
		}
	}

	/**
	 * Additional actions after 'Buy together' combinations' products changes
	 *
	 * @param array $cart Array of cart content and user information necessary for purchase
	 * @param array $cart_products Array of new data for products information update
	 */
	fn_set_hook('bundled_products_calculate_cart_post', $cart, $cart_products);
}

function fn_bundled_products_delete_cart_product(&$cart, &$cart_id, $full_erase)
{

	if ($full_erase == false) {
		return false;
	}

	if (!empty($cart['products'][$cart_id]['extra']['bundled_products'])) {
		foreach ($cart['products'] as $key => $item) {
			if (!empty($item['extra']['parent']['bundled_products']) && $item['extra']['parent']['bundled_products'] == $cart_id) {
				unset($cart['products'][$key]);
			}
		}
	}
	
	return true;
}

function fn_bundled_products_check_products_amount(&$product_data, &$cart)
{
	if (!isset($cart['products'])) {
		$cart['products'] = array();
	}
	
	if (!empty($product_data)) {
		foreach ($product_data as $key => $product) {
			if (!empty($product['bundled_products'])) {
				$amount = fn_check_amount_in_stock($product['product_id'], $product['amount'], @$product['product_options'], $key, $is_edp = 'N', $original_amount = 0, $cart);
				
				if ($amount < $product['amount']) {
					$extra_amount = intval($amount / $product['extra']['min_qty']);
					$product_data[$key]['amount'] = $extra_amount * $product['extra']['min_qty'];
					if (isset($cart['products'][$key])) {
						$cart['products'][$key]['amount'] = $product_data[$key]['amount'];
					}
					
					foreach ($product['bundled_products'] as $hash => $amount) {
						if (isset($product_data[$hash])) {
							$product_data[$hash]['amount'] = $extra_amount * $product_data[$hash]['extra']['min_qty'];
							$product_data[$key]['bundled_products'][$hash] = $product_data[$hash]['amount'];
							
							if (isset($cart['products'][$hash])) {
								$cart['products'][$hash]['amount'] = $product_data[$hash]['amount'];
							}
						}
					}
				}
				
				foreach ($product['bundled_products'] as $hash => $amount) {
					if ($product_data[$hash]['amount'] > 0) {
						$allowed_amount = fn_check_amount_in_stock($product_data[$hash]['product_id'], $product_data[$hash]['amount'], empty($product_data[$hash]['product_options']) ? array() : $product_data[$hash]['product_options'], $hash, $is_edp = 'N', $original_amount = 0, $cart);
						
						if ($allowed_amount < $product_data[$hash]['amount']) {
							$extra_amount = intval($allowed_amount / $product_data[$hash]['extra']['min_qty']);
							$product_data[$hash]['amount'] = $extra_amount * $product_data[$hash]['extra']['min_qty'];
							$product_data[$key]['bundled_products'][$hash] = $product_data[$hash]['amount'];
							$product_data[$key]['amount'] = $extra_amount * $product['extra']['min_qty'];
							
							if (isset($cart['products'][$hash])) {
								$cart['products'][$hash]['amount'] = $product_data[$hash]['amount'];
							}
							if (isset($cart['products'][$key])) {
								$cart['products'][$key]['amount'] = $product_data[$key]['amount'];
							}
							
							foreach ($product['bundled_products'] as $_id => $_amount) {
								if ($_id == $hash) {
									continue;
								}
								
								$product_data[$_id]['amount'] = $extra_amount * $product_data[$_id]['extra']['min_qty'];
								if (isset($cart['products'][$_id])) {
									$cart['products'][$_id]['amount'] = $product_data[$_id]['amount'];
								}
							}
						}
					}
				}
				
				if ($product_data[$key]['amount'] <= 0) {
					foreach ($product['bundled_products'] as $hash => $amount) {
						unset($product_data[$hash]);
					}
					unset($product_data[$key]);
// 					fn_set_notification('E', fn_get_lang_var('error'), fn_get_lang_var('bundled_products_combination_cannot_be_added'));
				}
			}
		}
	}
	
	return $product_data;
}

function fn_bundled_products_reorder($order_info, $cart)
{
	foreach ($order_info['items'] as $key => $product) {
		if (isset($product['extra']['chain']['chain_id'])) {
			$params = array(
				'chain_id' => $product['extra']['chain']['chain_id'],
				'simple' => true,
			);
			
			$chain = fn_bundled_products_get_chains($params, $_SESSION['auth']);
			
			if ($chain['date_to'] < time()) {
				unset($order_info['items'][$key]['extra']['bundled_products'], $order_info['items'][$key]['extra']['buy_id'], $order_info['items'][$key]['extra']['chain'], $order_info['items'][$key]['extra']['parent']);
			}
		}
	}
}

function fn_bundled_products_calculate_cart_items(&$cart, &$cart_products, $auth)
{
	if (empty($cart['products'])) {
		return true;
	}
	
	$is_valid = true;
	$check_amount = (Registry::get('settings.General.inventory_tracking') == 'Y' && Registry::get('settings.General.allow_negative_amount') != 'Y') ? true : false;
	foreach ($cart['products'] as $key => $product) {
		if (!empty($product['extra']['bundled_products'])) {
			$allowed = true;
			$_products = array();
			$cart['products'][$key]['original_amount'] = $product['amount'];
			
			// Validate the combination
			$params['chain_id'] = $product['extra']['chain']['chain_id'];
			$params['status'] = 'A';
			$params['full_info'] = true;
			$params['date'] = true;
			$params['simple'] = true;
			
			$chain = fn_bundled_products_get_chains($params, $auth);
			
			if (empty($chain)) {
				$allowed = false;
			}
			
			$_product = fn_get_product_data($product['product_id'], $auth, CART_LANGUAGE, '', false, false, false, false);
			
			if (empty($_product) || ($check_amount && $product['amount'] > $_product['amount'] && $_product['tracking'] != 'D')) {
				$allowed = false;
			}
			
			foreach ($cart['products'] as $k => $v) {
				if (!empty($v['extra']['parent']['bundled_products']) && ($v['extra']['parent']['bundled_products'] == $key || (isset($product['extra']['buy_id']) && $product['extra']['buy_id'] == $v['extra']['parent']['bundled_products']))) {
					$_products[] = $k;
					$cart['products'][$k]['original_amount'] = $v['amount'];
					
					if (isset($product['extra']['buy_id']) && $product['extra']['buy_id'] == $v['extra']['parent']['bundled_products']) {
						$v['extra']['parent']['bundled_products'] = $cart_products[$k]['extra']['parent']['bundled_products'] = $cart['products'][$k]['extra']['parent']['bundled_products'] = $key;
					}
					
					if ($allowed) {
						$_product = fn_get_product_data($v['product_id'], $auth, CART_LANGUAGE, '', false, false, false, false);
						
						if (empty($_product) || ($check_amount && $v['amount'] > $_product['amount']) && !defined('ORDER_MANAGEMENT') && $_product['tracking'] != 'D') {
							fn_set_notification('E', fn_get_lang_var('notice'), str_replace(array('[product]', '[amount]'), array($_product['product'], $v['amount']), fn_get_lang_var('bundled_products_product_was_removed')));
							$allowed = false;
						}
						
						if (AREA != 'A' && MODE != 'place_order') {
							if (isset($chain['products'][$v['extra']['chain']['hash']]['discounted_price'])) {
								$discounted_price = $cart_products[$k]['price'] - $chain['products'][$v['extra']['chain']['hash']]['discount'];
								$discounted_price = $discounted_price < 0 ? 0 : $discounted_price;

								$cart_products[$k]['price'] = $cart_products[$k]['base_price'] = $discounted_price;
							}

							$cart_products[$k]['price'] = ($cart_products[$k]['price'] < 0) ? 0 : $cart_products[$k]['price'];
							$cart_products[$k]['base_price'] = ($cart_products[$k]['base_price'] < 0) ? 0 : $cart_products[$k]['base_price'];
							$cart_products[$k]['original_price'] = $cart_products[$k]['price'];
							$cart_products[$k]['subtotal'] = $cart_products[$k]['price'] * $cart_products[$k]['amount'];
						} elseif (AREA != 'A' && MODE == 'place_order') {
							$cart_products[$k]['discount'] = 0;
							$cart_products[$k]['base_price'] = $cart_products[$k]['price'] - $cart_products[$k]['modifiers_price'];
						}
					}
				}
				
				if (AREA != 'A' && MODE == 'place_order') {
					$cart_products[$key]['base_price'] = $cart_products[$key]['price'] - $cart_products[$key]['modifiers_price'];
				}
				
			}
			
			if (AREA != 'A' && (!$allowed || (count($_products) != count($product['extra']['bundled_products'])))) {
				$_products[] = $key;
				$cart['amount'] -= $product['amount'];
				
				foreach ($_products as $c_key) {
					unset($cart['products'][$c_key]);
					unset($cart_products[$c_key]);
				}
				
				$is_valid = false;
				
			} elseif (AREA != 'A' && MODE != 'place_order') {
				$cart_products[$key]['price'] -= empty($chain['discount']) ? 0 : $chain['discount'];
				
				if ($cart_products[$key]['price'] < 0) {
					$cart_products[$key]['price'] = 0;
				}
				
				$cart_products[$key]['base_price'] -= $chain['discount'];
				$cart_products[$key]['base_price'] = ($cart_products[$key]['base_price'] < 0) ? 0 : $cart_products[$key]['base_price'];
				
				$cart_products[$key]['original_price'] = $cart_products[$key]['price'];
				$cart_products[$key]['subtotal'] = $cart_products[$key]['price'] * $cart_products[$key]['amount'];
				
			} elseif (AREA != 'A' && MODE == 'place_order') {
				$cart_products[$key]['discount'] = 0;
			}
		}
	}
	
	if (!$is_valid) {
// 		fn_set_notification('E', fn_get_lang_var('error'), fn_get_lang_var('bundled_products_combination_cannot_be_added'));
		$cart['skip_notification'] = true;
	}
	
	return $is_valid;
}

function fn_bundled_products_amazon_products($cart_products, $cart)
{
	if (!empty($cart['products'])) {
		foreach ($cart['products'] as $cart_id => $product) {
			if (!empty($product['extra']['bundled_products'])) {
				foreach ($cart['products'] as $_id => $_product) {
					if (isset($_product['extra']['parent']['bundled_products']) && $_product['extra']['parent']['bundled_products'] == $cart_id) {
						$cart_products[$cart_id]['price'] -= $cart_products[$_id]['price'];
					}
				}
			}
		}
	}
}

function fn_bundled_products_get_products_post (&$products, $params)
{
	if (!empty($products)) {
		foreach($products as $k => $v) {
			$_params['product_id'] = $v['product_id'];
			$_params['status'] = 'A';
			$_params['full_info'] = true;
			$_params['date'] = true;
			$products[$k]['chains'] = fn_bundled_products_get_chains($_params, $_SESSION['auth']);
		}
	}

}

function fn_bundled_products_get_product_data_post (&$product_data, $auth, $preview)
{
	if (!empty($product_data['product_id'])) {
		$params['product_id'] = $product_data['product_id'];
		$params['status'] = 'A';
		$params['full_info'] = true;
		$params['date'] = true;
		$chains = db_get_fields('SELECT chain_id FROM ?:bundled_products WHERE product_id=?i AND status=?s', $product_data['product_id'], 'A');
		
		$product_data['chains'] = $chains;
	}	

}

function fn_get_product_description($product_id)
{

	$descr = db_get_field('SELECT full_description FROM ?:product_descriptions WHERE product_id=?i AND lang_code=?s', $product_id, CART_LANGUAGE);

	return $descr;

}

function fn_bundled_products_update_product_pre(&$product_data, $product_id, $lang_code)
{
	if ($product_data['bundle'] == 'Y') {
		$product_data['price'] = db_get_field('SELECT price FROM ?:product_prices WHERE lower_limit=?i AND product_id=?i', 1, $product_id);
		$product_data['tracking'] = 'B';
	}
}

?>