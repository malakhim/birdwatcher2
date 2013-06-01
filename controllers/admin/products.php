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

$_REQUEST['product_id'] = empty($_REQUEST['product_id']) ? 0 : $_REQUEST['product_id'];

if (PRODUCT_TYPE == 'MULTIVENDOR') {
	if (isset($_REQUEST['product_ids']) && !fn_company_products_check($_REQUEST['product_ids'])) {
		return array(CONTROLLER_STATUS_DENIED);
	}

	if (isset($_REQUEST['product_id']) && !fn_company_products_check($_REQUEST['product_id'])) {
		return array(CONTROLLER_STATUS_DENIED);
	}
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$suffix = '';

	// Define trusted variables that shouldn't be stripped
	fn_trusted_vars (
		'product_data',
		'override_products_data',
		'product_files_descriptions',
		'add_product_files_descriptions',
		'products_data',
		'product_file'
	);

	//
	// Apply Global Option
	//
	if ($mode == 'apply_global_option') {
		if ($_REQUEST['global_option']['link'] == 'N') {
			fn_clone_product_options(0, $_REQUEST['product_id'], $_REQUEST['global_option']['id']);
		} else {
			db_query("REPLACE INTO ?:product_global_option_links (option_id, product_id) VALUES(?i, ?i)", $_REQUEST['global_option']['id'], $_REQUEST['product_id']);


		}
		$suffix = ".update?product_id=$_REQUEST[product_id]";
	}
	//
	// Create/update product
	//
	if ($mode == 'update') {
		if (!empty($_REQUEST['product_data']['product'])) {

			fn_companies_filter_company_product_categories($_REQUEST, $_REQUEST['product_data']);
			if (empty($_REQUEST['product_data']['categories'])) {
				fn_set_notification('W', fn_get_lang_var('warning'), fn_get_lang_var('category_is_empty'));
				return array(CONTROLLER_STATUS_REDIRECT, "products." . (!empty($_REQUEST['product_id']) ? ("update&product_id=" . $_REQUEST['product_id']) : "add"));
			}
			$product_id = fn_update_product($_REQUEST['product_data'], $_REQUEST['product_id'], DESCR_SL);

			$_main_category = db_get_row("SELECT category_id, position FROM ?:products_categories WHERE product_id = ?i AND link_type = 'M'", $product_id);
			$_add_categories = db_get_array("SELECT category_id, position FROM ?:products_categories WHERE product_id = ?i ORDER BY category_id", $product_id);					

			$add_categories = Array();
			foreach($_add_categories as $_category) {
				$add_categories[] = $_category['category_id'];
				$add_categories_positions[$_category['category_id']] = $_category['position'];					
			}
			$prev_cat = $add_categories;
				
			if (!empty($_REQUEST['product_data']['categories'])) {
				$add_categories = explode(',', $_REQUEST['product_data']['categories']);
				$main_category = (!empty($_REQUEST['product_data']['main_category'])) ? $_REQUEST['product_data']['main_category'] : $add_categories[0];				
			} else {
				$main_category = $_main_category['category_id'];				
			}

			db_query("DELETE FROM ?:products_categories WHERE product_id = ?i", $product_id);
			fn_update_product_count($prev_cat);
			$new_ids = $add_categories;
			$_data = array (
				'product_id' => $product_id,
				'link_type' => 'A',
			);

			foreach ($add_categories as $c_id) {
				$_data['category_id'] = $c_id;
				if (isset($add_categories_positions[$c_id])) {
					$_data['position'] = $add_categories_positions[$c_id];					
				} else {
					$_data['position'] = 0;
				}
				db_query("INSERT INTO ?:products_categories ?e", $_data);
			}
			fn_update_product_count($new_ids);

			db_query("UPDATE ?:products_categories SET link_type = 'M' WHERE product_id = ?i AND category_id = ?i", $product_id, $main_category);

			// Update main images pair
			fn_attach_image_pairs('product_main', 'product', $product_id, DESCR_SL);

			// Update additional images
			fn_attach_image_pairs('product_additional', 'product', $product_id, DESCR_SL);

			// Adding new additional images
			fn_attach_image_pairs('product_add_additional', 'product', $product_id, DESCR_SL);
			

		}

		if (!empty($_REQUEST['product_id'])) {
			if (!empty($_REQUEST['add_users'])) {
				// Updating product subscribers
				$users = db_get_array("SELECT user_id, email FROM ?:users WHERE user_id IN (?n)", $_REQUEST['add_users']);

				if (!empty($users)) {
					foreach ($users as $user) {
						$subscription_id = db_get_field("SELECT subscription_id FROM ?:product_subscriptions WHERE product_id = ?i AND email = ?s", $_REQUEST['product_id'], $user['email']);
                        if (empty($subscription_id)) {
                            $subscription_id = db_query("INSERT INTO ?:product_subscriptions ?e", array('product_id' => $_REQUEST['product_id'], 'user_id' => $user['user_id'], 'email' => $user['email']));
                        } else {
                            db_query("REPLACE INTO ?:product_subscriptions ?e", array('subscription_id' => $subscription_id, 'product_id' => $_REQUEST['product_id'], 'user_id' => $user['user_id'], 'email' => $user['email']));
                        }
					}
				} elseif (!empty($_REQUEST['add_users_email'])) {
					if (!db_get_field("SELECT subscription_id FROM ?:product_subscriptions WHERE product_id = ?i AND email = ?s", $_REQUEST['product_id'], $_REQUEST['add_users_email'])) {
						db_query("INSERT INTO ?:product_subscriptions ?e", array('product_id' => $_REQUEST['product_id'], 'user_id' => 0, 'email' => $_REQUEST['add_users_email']));
					} else {
						$msg = fn_get_lang_var('warning_subscr_email_exists');
						$msg = str_replace('[email]', $_REQUEST['add_users_email'], $msg);
						fn_set_notification('E', fn_get_lang_var('error'), $msg);
					}
				}
			} elseif (!empty($_REQUEST['subscriber_ids'])) {
				db_query("DELETE FROM ?:product_subscriptions WHERE subscription_id IN (?n)", $_REQUEST['subscriber_ids']);
			}

			return array(CONTROLLER_STATUS_OK, "products.update&product_id=" . $_REQUEST['product_id'] . "&selected_section=subscribers");
		}

		$suffix = ".update?product_id=$product_id" . (!empty($_REQUEST['product_data']['block_id']) ? "&selected_block_id=" . $_REQUEST['product_data']['block_id'] : "");
	}

	//
	// Processing mulitple addition of new product elements
	//
	if ($mode == 'm_add') {

		if (is_array($_REQUEST['products_data'])) {
			$p_ids = array();
			foreach ($_REQUEST['products_data'] as $k => $v) {
				if (!empty($v['product']) && !empty($v['main_category'])) {  // Checking for required fields for new product
					fn_companies_filter_company_product_categories($_REQUEST, $v);
					$p_id = fn_update_product($v);
					if (!empty($p_id)) {
						$p_ids[] = $p_id;

						// Adding association with main category for product
						$_data = array (
							'product_id' => $p_id,
							'link_type' => 'M',
							'category_id' => $v['main_category'],
							'position' => $v['position'],
						);
						db_query("INSERT INTO ?:products_categories ?e", $_data);
						fn_update_product_count(array($v['main_category']));

						unset($_data);
					}
				}
			}

			if (!empty($p_ids)) {
				fn_set_notification('N', fn_get_lang_var('notice'), fn_get_lang_var('text_products_added'));
			}
		}
		$suffix = ".manage" . (empty($p_ids) ? "" : "?pid[]=" . implode('&pid[]=', $p_ids));
	}

	//
	// Processing multiple updating of product elements
	//
	if ($mode == 'm_update') {
		// Update multiple products data
		if (!empty($_REQUEST['products_data'])) {

			if (PRODUCT_TYPE == 'MULTIVENDOR' && !fn_company_products_check(array_keys($_REQUEST['products_data']))) {
				return array(CONTROLLER_STATUS_DENIED);
			}

			// Update images
			fn_attach_image_pairs('product_main', 'product', 0, DESCR_SL);

			foreach ($_REQUEST['products_data'] as $k => $v) {
				if (!empty($v['product'])) { // Checking for required fields for new product
					fn_companies_filter_company_product_categories($_REQUEST, $v);
					fn_update_product($v, $k, DESCR_SL);
					$main_category_id = db_get_field("SELECT category_id FROM ?:products_categories WHERE product_id = ?i AND link_type = 'M'", $k);
					if (!empty($v['categories'])) {
						$secondary_category_ids = db_get_fields("SELECT category_id FROM ?:products_categories WHERE product_id = ?i", $k);
						@sort($secondary_category_ids, SORT_NUMERIC);
						if (!empty($v['categories'])) {
							$v['categories'] = explode(',', $v['categories']);
							sort($v['categories'], SORT_NUMERIC);
							if (empty($v['main_category'])) {
								$v['main_category'] = $v['categories'][0];
							}
						}
						if ($v['categories'] != $secondary_category_ids) {
							$delete_ids = array_diff((array)$secondary_category_ids, (array)$v['categories']);
							db_query("DELETE FROM ?:products_categories WHERE product_id = ?i AND category_id IN (?n)", $k, $delete_ids);
							fn_update_product_count($delete_ids);
							$new_ids = array_diff((array)$v['categories'], (array)$secondary_category_ids);
							$_data = array (
								'product_id' => $k,
								'link_type' => 'A',
							);
							foreach ($new_ids as $c_id) {
								// check if main category already exists
								$is_ex = db_get_field("SELECT COUNT(*) FROM ?:products_categories WHERE product_id = ?i AND category_id = ?i", $k, $c_id);
								if (!empty($is_ex)) {
									continue;
								}
								$_data['category_id'] = $c_id;
								if (!empty($c_id)) {
									db_query("INSERT INTO ?:products_categories ?e", $_data);
								}
							}
							fn_update_product_count($new_ids);
						}

						if ($v['main_category'] != $main_category_id) {
							db_query("UPDATE ?:products_categories SET link_type = 'A' WHERE product_id = ?i AND category_id = ?i", $k, $main_category_id);
							db_query("UPDATE ?:products_categories SET link_type = 'M' WHERE product_id = ?i AND category_id = ?i", $k, $v['main_category']);
						}
					}

					// Updating products position in category
					if (isset($v['position']) && !empty($_REQUEST['category_id'])) {
						db_query("UPDATE ?:products_categories SET position = ?i WHERE category_id = ?i AND product_id = ?i", $v['position'], $_REQUEST['category_id'], $k);
					}
				}
			}
		}
		$suffix = ".manage";
	}

	//
	// Processing global updating of product elements
	//

	if ($mode == 'global_update') {

		fn_global_update_products($_REQUEST['update_data']);

		$suffix = '.global_update';

	}

	//
	// Override multiple products with the one value
	//
	if ($mode == 'm_override') {
		// Update multiple products data
		if (!empty($_SESSION['product_ids'])) {

			if (PRODUCT_TYPE == 'MULTIVENDOR' && !fn_company_products_check($_SESSION['product_ids'])) {
				return array(CONTROLLER_STATUS_DENIED);
			}

			$product_data = !empty($_REQUEST['override_products_data']) ? $_REQUEST['override_products_data'] : array();
			if (isset($product_data['avail_since'])) {
				$product_data['avail_since'] = fn_parse_date($product_data['avail_since']);
			}
			if (isset($product_data['timestamp'])) {
				$product_data['timestamp'] = fn_parse_date($product_data['timestamp']);
			}

			fn_define('KEEP_UPLOADED_FILES', true);
			foreach ($_SESSION['product_ids'] as $_o => $p_id) {

				fn_companies_filter_company_product_categories($_REQUEST, $product_data);
				// Update product
				fn_update_product($product_data, $p_id, DESCR_SL);
				$main_category_id = db_get_field("SELECT category_id FROM ?:products_categories WHERE product_id = ?i AND link_type = 'M'", $p_id);
				// Updating product association with secondary categories
				if (!empty($product_data['categories'])) {
					$secondary_category_ids = db_get_fields("SELECT category_id FROM ?:products_categories WHERE product_id = ?i", $p_id);
					$delete_ids = array_diff((array)$secondary_category_ids, (array)$product_data['categories']);
					db_query("DELETE FROM ?:products_categories WHERE product_id = ?i", $p_id);
					fn_update_product_count($delete_ids);
					$_data = array (
						'product_id' => $p_id
					);

					$_cids = explode(',', $product_data['categories']);

					if (empty($product_data['main_category'])) {
						$product_data['main_category'] = $_cids[0];
					}

					foreach ($_cids as $c_id) {
						if ($product_data['main_category'] == $c_id) {
							$_data['link_type'] = 'M';
						} else {
							$_data['link_type'] = 'A';
						}
						$_data['category_id'] = $c_id;
						db_query("REPLACE INTO ?:products_categories ?e", $_data);
					}
					fn_update_product_count($_cids);
				}
				// Updating images
				fn_attach_image_pairs('product_main', 'product', $p_id, DESCR_SL);
			}
		}
	}


	//
	// Processing deleting of multiple product elements
	//
	if ($mode == 'm_delete') {
		if (isset($_REQUEST['product_ids'])) {
			foreach ($_REQUEST['product_ids'] as $v) {
				fn_delete_product($v);
			}
		}
		unset($_SESSION['product_ids']);
		fn_set_notification('N', fn_get_lang_var('notice'), fn_get_lang_var('text_products_have_been_deleted'));
		$suffix = ".manage";
	}

	//
	// Processing deleting of multiple product subscriptions
	//
	if ($mode == 'm_delete_subscr') {
		if (isset($_REQUEST['product_ids'])) {
			db_query("DELETE FROM ?:product_subscriptions WHERE product_id IN (?n)", $_REQUEST['product_ids']);
		}
		unset($_SESSION['product_ids']);
		$suffix = ".p_subscr";
	}

	//
	// Processing clonning of multiple product elements
	//
	if ($mode == 'm_clone') {
		$p_ids = array();
		if (!empty($_REQUEST['product_ids'])) {
			foreach ($_REQUEST['product_ids'] as $v) {
				$pdata = fn_clone_product($v);
				$p_ids[] = $pdata['product_id'];
			}

			fn_set_notification('N', fn_get_lang_var('notice'), fn_get_lang_var('text_products_cloned'));
		}
		$suffix = ".manage?pid[]=" . implode('&pid[]=', $p_ids);
		unset($_REQUEST['redirect_url'], $_REQUEST['page']); // force redirection
	}

	//
	// Storing selected fields for using in m_update mode
	//
	if ($mode == 'store_selection') {

		if (!empty($_REQUEST['product_ids'])) {
			$_SESSION['product_ids'] = $_REQUEST['product_ids'];
			$_SESSION['selected_fields'] = $_REQUEST['selected_fields'];

			unset($_REQUEST['redirect_url']);

			$suffix = ".m_update";
		} else {
			$suffix = ".manage";
		}
	}

	//
	// Add edp files to the product
	//
	if ($mode == 'update_file') {

		$_file_id = empty($_REQUEST['file_id']) ? 0 : $_REQUEST['file_id'];

		$uploaded_data = fn_filter_uploaded_data('base_file');
		$uploaded_preview_data = fn_filter_uploaded_data('file_preview');

		if (!empty($_file_id) || !empty($uploaded_data[$_file_id])) {

			db_query("UPDATE ?:products SET is_edp = 'Y' WHERE product_id = ?i", $_REQUEST['product_id']);


			$revisions = Registry::get('revisions');

			if (!empty($revisions['objects']['product']['tables'])) {
				$revision_subdir = '_rev';
			} else {
				$revision_subdir = '';
			}

			$_dir_name = substr(DIR_DOWNLOADS, 0, -1) . $revision_subdir . '/' . $_REQUEST['product_id'];
			if (!fn_mkdir($_dir_name)) {
				$msg = str_replace('[directory]', $_dir_name, fn_get_lang_var('text_cannot_create_directory'));
				fn_set_notification('E', fn_get_lang_var('error'), $msg);
			}

			$product_file = $_REQUEST['product_file'];

			if (!empty($uploaded_data[$_file_id])) {
				$product_file['file_name'] = empty($product_file['file_name']) ? $uploaded_data[$_file_id]['name'] : $product_file['file_name'];
			}

			// Remove old file before uploading a new one
			if (!empty($_file_id)) {
				$dir = DIR_DOWNLOADS . $_REQUEST['product_id'];
				$old_file = db_get_row('SELECT file_path, preview_path FROM ?:product_files WHERE product_id = ?i AND file_id = ?i', $_REQUEST['product_id'], $_file_id);

				if (!empty($uploaded_data) && !empty($old_file['file_path'])) {
					unlink($dir . '/' . $old_file['file_path']);
				}

				if (!empty($uploaded_preview_data) && !empty($old_file['preview_path'])) {
					unlink($dir . '/' . $old_file['preview_path']);
				}
			}

			// Update file data
			if (empty($_file_id)) {
				$product_file['product_id'] = $_REQUEST['product_id'];
				$product_file['file_id'] = $file_id = db_query('INSERT INTO ?:product_files ?e', $product_file);

				foreach ((array)Registry::get('languages') as $product_file['lang_code'] => $v) {
					db_query('INSERT INTO ?:product_file_descriptions ?e', $product_file);
				}
			} else {
				db_query('UPDATE ?:product_files SET ?u WHERE file_id = ?i', $product_file, $_file_id);
				db_query('UPDATE ?:product_file_descriptions SET ?u WHERE file_id = ?i AND lang_code = ?s', $product_file, $_file_id, DESCR_SL);
				$file_id = $_file_id;
			}


			// Copy base file
			if (!empty($uploaded_data[$_file_id])) {
				fn_copy_product_files($file_id, $uploaded_data[$_file_id], $_REQUEST['product_id']);
			}

			// Copy preview file
			if (!empty($uploaded_preview_data[$_file_id])) {
				fn_copy_product_files($file_id, $uploaded_preview_data[$_file_id], $_REQUEST['product_id'], 'preview');
			}
		}

		$suffix = ".update?product_id=$_REQUEST[product_id]";
	}

	if ($mode == 'export_range') {
		if (!empty($_REQUEST['product_ids'])) {
			if (empty($_SESSION['export_ranges'])) {
				$_SESSION['export_ranges'] = array();
			}

			if (empty($_SESSION['export_ranges']['products'])) {
				$_SESSION['export_ranges']['products'] = array('pattern_id' => 'products');
			}

			$_SESSION['export_ranges']['products']['data'] = array('product_id' => $_REQUEST['product_ids']);

			unset($_REQUEST['redirect_url']);
			return array(CONTROLLER_STATUS_REDIRECT, "exim.export?section=products&pattern_id=" . $_SESSION['export_ranges']['products']['pattern_id']);
		}
	}

	return array(CONTROLLER_STATUS_OK, "products$suffix");
}

//
// 'Management' page
//
if ($mode == 'manage' || $mode == 'p_subscr') {
	unset($_SESSION['product_ids']);
	unset($_SESSION['selected_fields']);

	$params = $_REQUEST;
	$params['only_short_fields'] = true;
	$params['extend'][] = 'companies';


	if ($mode == 'p_subscr') {
		$params['get_subscribers'] = true;
		fn_add_breadcrumb(fn_get_lang_var('products'), "products.manage");
	}

	list($products, $search, $product_count) = fn_get_products($params, Registry::get('settings.Appearance.admin_products_per_page'), DESCR_SL);
	fn_gather_additional_products_data($products, array('get_icon' => true, 'get_detailed' => true, 'get_options' => false, 'get_discounts' => false));

	$view->assign('products', $products);
	$view->assign('search', $search);

	if (!empty($_REQUEST['redirect_if_one']) && $product_count == 1) {
		return array(CONTROLLER_STATUS_REDIRECT, "products.update?product_id={$products[0]['product_id']}");
	}

	$selected_fields = array(
		array(
			'name' => '[data][popularity]',
			'text' => fn_get_lang_var('popularity')
		),
		array(
			'name' => '[data][status]',
			'text' => fn_get_lang_var('status'),
			'disabled' => 'Y'
		),
		array(
			'name' => '[data][product]',
			'text' => fn_get_lang_var('product_name'),
			'disabled' => 'Y'
		),
		array(
			'name' => '[data][price]',
			'text' => fn_get_lang_var('price')
		),
		array(
			'name' => '[data][list_price]',
			'text' => fn_get_lang_var('list_price')
		),
		array(
			'name' => '[data][short_description]',
			'text' => fn_get_lang_var('short_description')
		),
		array(
			'name' => '[categories]',
			'text' => fn_get_lang_var('categories')
		),
		array(
			'name' => '[data][full_description]',
			'text' => fn_get_lang_var('full_description')
		),
		array(
			'name' => '[data][search_words]',
			'text' => fn_get_lang_var('search_words')
		),
		array(
			'name' => '[data][meta_keywords]',
			'text' => fn_get_lang_var('meta_keywords')
		),
		array(
			'name' => '[data][meta_description]',
			'text' => fn_get_lang_var('meta_description')
		),
		
		array(
			'name' => '[data][usergroup_ids]',
			'text' => fn_get_lang_var('usergroups')
		),
		
		array(
			'name' => '[main_pair]',
			'text' => fn_get_lang_var('image_pair')
		),
		array(
			'name' => '[data][min_qty]',
			'text' => fn_get_lang_var('min_order_qty')
		),
		array(
			'name' => '[data][max_qty]',
			'text' => fn_get_lang_var('max_order_qty')
		),
		array(
			'name' => '[data][qty_step]',
			'text' => fn_get_lang_var('quantity_step')
		),
		array(
			'name' => '[data][list_qty_count]',
			'text' => fn_get_lang_var('list_quantity_count')
		),
		array(
			'name' => '[data][product_code]',
			'text' => fn_get_lang_var('product_code')
		),
		array(
			'name' => '[data][weight]',
			'text' => fn_get_lang_var('weight')
		),
		array(
			'name' => '[data][shipping_freight]',
			'text' => fn_get_lang_var('shipping_freight')
		),
		array(
			'name' => '[data][is_edp]',
			'text' => fn_get_lang_var('downloadable')
		),
		array(
			'name' => '[data][edp_shipping]',
			'text' => fn_get_lang_var('edp_enable_shipping')
		),
		array(
			'name' => '[data][free_shipping]',
			'text' => fn_get_lang_var('free_shipping')
		),
		array(
			'name' => '[data][feature_comparison]',
			'text' => fn_get_lang_var('feature_comparison')
		),
		array(
			'name' => '[data][zero_price_action]',
			'text' => fn_get_lang_var('zero_price_action')
		),
		array(
			'name' => '[data][taxes]',
			'text' => fn_get_lang_var('taxes')
		),
		array(
			'name' => '[data][features]',
			'text' => fn_get_lang_var('features')
		),
		array(
			'name' => '[data][page_title]',
			'text' => fn_get_lang_var('page_title')
		),
		array(
			'name' => '[data][timestamp]',
			'text' => fn_get_lang_var('creation_date')
		),
		array(
			'name' => '[data][amount]',
			'text' => fn_get_lang_var('quantity')
		),
		array(
			'name' => '[data][avail_since]',
			'text' => fn_get_lang_var('available_since')
		),
		array(
			'name' => '[data][out_of_stock_actions]',
			'text' => fn_get_lang_var('out_of_stock_actions')
		),
		
		array(
			'name' => '[data][localization]',
			'text' => fn_get_lang_var('localization')
		),
		
		array(
			'name' => '[data][details_layout]',
			'text' => fn_get_lang_var('product_details_layout')
		),
		array(
			'name' => '[data][min_items_in_box]',
			'text' => fn_get_lang_var('minimum_items_in_box')
		),
		array(
			'name' => '[data][max_items_in_box]',
			'text' => fn_get_lang_var('maximum_items_in_box')
		),
		array(
			'name' => '[data][box_length]',
			'text' => fn_get_lang_var('box_length')
		),
		array(
			'name' => '[data][box_width]',
			'text' => fn_get_lang_var('box_width')
		),
		array(
			'name' => '[data][box_height]',
			'text' => fn_get_lang_var('box_height')
		),
	);

	if (Registry::get('settings.General.inventory_tracking') == "Y") {
		$selected_fields[] = array(
			'name' => '[data][tracking]',
			'text' => fn_get_lang_var('inventory')
		);
	}

	if (PRODUCT_TYPE == 'PROFESSIONAL' && Registry::get('settings.Suppliers.enable_suppliers') == 'Y') {
		$selected_fields[] = array(
			'name' => '[data][company_id]',
			'text' => fn_get_lang_var('supplier')
		);
	}

	if (PRODUCT_TYPE == 'MULTIVENDOR') {
		$selected_fields[] = array(
			'name' => '[data][company_id]',
			'text' => fn_get_lang_var('vendor')
		);
	}

	$view->assign('selected_fields', $selected_fields);
	
	$filter_params = array(
		'get_fields' => true,
		'get_variants' => true,
		'short' => true
	);
	list($filters) = fn_get_product_filters($filter_params);
	$view->assign('filter_items', $filters);
	unset($filters);

	
	$feature_params = array(
		'get_fields' => true,
		'plain' => true,
		'variants' => true,
		'exclude_group' => true,
		'exclude_filters' => true
	);
	list($features) = fn_get_product_features($feature_params);
	$view->assign('feature_items', $features);
	unset($features);

	$view->assign('product_count', $product_count);
	fn_paginate((isset($_REQUEST['page']) ? $_REQUEST['page'] : 1), $product_count, Registry::get('settings.Appearance.admin_products_per_page'));
}
//
// 'Global update' page
//
if ($mode == 'global_update') {
	fn_add_breadcrumb(fn_get_lang_var('products'), "products.manage");
//
// 'Add new product' page
//
} elseif ($mode == 'add') {

	$view->assign('taxes', fn_get_taxes());

	fn_add_breadcrumb(fn_get_lang_var('products'), "products.manage.reset_view");
	fn_add_breadcrumb(fn_get_lang_var('search_results'), "products.manage.last_view");

	// [Page sections]
	Registry::set('navigation.tabs', array (
		'detailed' => array (
			'title' => fn_get_lang_var('general'),
			'js' => true
		),
		'images' => array (
			'title' => fn_get_lang_var('images'),
			'js' => true
		),
		'qty_discounts' => array (
			'title' => fn_get_lang_var('qty_discounts'),
			'js' => true
		),
		'addons' => array (
			'title' => fn_get_lang_var('addons'),
			'js' => true
		),
	));
	// [/Page sections]

//
// 'Multiple products addition' page
//
} elseif ($mode == 'm_add') {

//
// 'product update' page
//
} elseif ($mode == 'update') {
	$selected_section = (empty($_REQUEST['selected_section']) ? 'detailed' : $_REQUEST['selected_section']);

	// Get current product data
	$product_data = fn_get_product_data($_REQUEST['product_id'], $auth, DESCR_SL, '', true, true, true, true, false, true, false);

	if (!empty($_REQUEST['deleted_subscription_id'])) {
		db_query("DELETE FROM ?:product_subscriptions WHERE subscription_id = ?i", $_REQUEST['deleted_subscription_id']);
	}

	if (empty($product_data)) {
		return array(CONTROLLER_STATUS_NO_PAGE);
	}
	
	if (PRODUCT_TYPE == 'ULTIMATE' && !empty($product_data['shared_product']) && $product_data['shared_product'] = 'Y') {
		$product_data = fn_get_product_data($_REQUEST['product_id'], $auth, DESCR_SL, '', true, true, true, true, false, true, true);
	}

	fn_add_breadcrumb(fn_get_lang_var('products'), "products.manage.reset_view");

	fn_add_breadcrumb(fn_get_lang_var('search_results'), "products.manage.last_view");

	fn_add_breadcrumb(fn_get_lang_var('category') . ': ' . fn_get_category_name($product_data['main_category']), "products.manage.reset_view?cid=$product_data[main_category]");

	$taxes = fn_get_taxes();
	arsort($product_data['category_ids']);
	
	if (PRODUCT_TYPE == 'MULTIVENDOR') {
	if (defined('AJAX_REQUEST')) {
		$company_id = isset($_REQUEST['product_data']['company_id']) ? $_REQUEST['product_data']['company_id'] : 0;
		$company_data = fn_get_company_data($company_id, DESCR_SL, false);
		if (!empty($company_data['categories'])) {
			$params = array (
				'simple' => false,
				'company_ids' => $company_id,
			);
			list($cat_ids, ) = fn_get_categories($params);
			$cat_ids = array_keys($cat_ids);
			//Assign available category ids to be displayed after admin changes product owner.
			$product_data['category_ids'] = array_intersect($product_data['category_ids'], $cat_ids);
		}
		//Assign received company_id to product data for the correct company categories to be displayed in the picker.
		$product_data['company_id'] = $company_id;
		$view->assign('product_data', $product_data);
		$view->display('views/products/update.tpl');
		exit;
	}
	}
	
	$view->assign('product_data', $product_data);
	$view->assign('taxes', $taxes);

	$product_options = fn_get_product_options($_REQUEST['product_id'], DESCR_SL);
	if (!empty($product_options)) {
		$has_inventory = false;
		foreach ($product_options as $p) {
			if ($p['inventory'] == 'Y') {
				$has_inventory = true;
				break;
			}
		}
		$view->assign('has_inventory', $has_inventory);
	}
	$view->assign('product_options', $product_options);
	list($global_options) = fn_get_product_global_options();
	$view->assign('global_options', $global_options);

	// If the product is electronnicaly distributed, get the assigned files
	$view->assign('product_files', fn_get_product_files($_REQUEST['product_id']));

	// Get product subscribers
	$product_subscribers_params = array (
		'email' => !empty($_REQUEST['email']) ? $_REQUEST['email'] : '',
		'page' => isset($_REQUEST['page']) ? $_REQUEST['page'] : 1
	);
	$view->assign('product_subscribers', fn_get_product_subscribers($_REQUEST['product_id'], $product_subscribers_params));

	// [Page sections]
	$tabs = array (
		'detailed' => array (
			'title' => fn_get_lang_var('general'),
			'js' => true
		),
		'images' => array (
			'title' => fn_get_lang_var('images'),
			'js' => true
		),
		'options' => array (
			'title' => fn_get_lang_var('options'),
			'js' => true
		),
		'shippings' => array (
			'title' => fn_get_lang_var('shipping_properties'),
			'js' => true
		),
		'qty_discounts' => array (
			'title' => fn_get_lang_var('qty_discounts'),
			'js' => true
		),
		'files' => array (
			'title' => fn_get_lang_var('files'),
			'js' => true
		),
		'subscribers' => array (
			'title' => fn_get_lang_var('subscribers'),
			'js' => true
		),
	);
		
	$tabs['addons'] = array (
		'title' => fn_get_lang_var('addons'),
		'js' => true
	);

	// If we have some additional product fields, lets add a tab for them
	if (!empty($product_data['product_features'])) {
		$tabs['features'] = array(
			'title' => fn_get_lang_var('features'),
			'js' => true
		);
	}

	// [Product tabs]
	// block manager is disabled for vendors.
	if (!((PRODUCT_TYPE == 'MULTIVENDOR' && defined('SELECTED_COMPANY_ID') && SELECTED_COMPANY_ID != 'all') 
		|| (PRODUCT_TYPE == 'ULTIMATE' && !defined('COMPANY_ID')))) {
		$dynamic_object = Bm_SchemesManager::get_dynamic_object($_REQUEST['dispatch'], AREA);
		if (!empty($dynamic_object)) {
			if (AREA == 'A' && MODE != 'add' && !empty($_REQUEST[$dynamic_object['key']])) {
				$params = 'dynamic_object[object_type]=' . $dynamic_object['object_type'] . '&';
				$params .= 'dynamic_object[object_id]=' . $_REQUEST[$dynamic_object['key']] . '&';
				$params .= $dynamic_object['key'] . '=' . $_REQUEST[$dynamic_object['key']];

				$tabs['product_tabs'] = array(
					'title' => fn_get_lang_var('product_tabs'),
					'href' => 'tabs.manage_in_tab?' . $params,
					'ajax' => true,				
				);
			}
		}
	}
	// [/Product tabs]
	Registry::set('navigation.tabs', $tabs);
	// [/Page sections]
	
//
// 'Mulitple products updating' page
//
} elseif ($mode == 'm_update') {

	if (empty($_SESSION['product_ids']) || empty($_SESSION['selected_fields']) || empty($_SESSION['selected_fields']['object']) || $_SESSION['selected_fields']['object'] != 'product') {
		return array(CONTROLLER_STATUS_REDIRECT, "products.manage");
	}

	fn_add_breadcrumb(fn_get_lang_var('products'), "products.manage");

	$product_ids = $_SESSION['product_ids'];

	if (PRODUCT_TYPE == 'MULTIVENDOR' && !fn_company_products_check($product_ids)) {
		return array(CONTROLLER_STATUS_DENIED);
	}

	$selected_fields = $_SESSION['selected_fields'];

	$field_groups = array (
		'A' => array ( // inputs
			'product' => 'products_data',
			'product_code' => 'products_data',
			'page_title' => 'products_data',
		),

		'B' => array ( // short inputs
			'price' => 'products_data',
			'list_price' => 'products_data',
			'amount' => 'products_data',
			'min_qty' => 'products_data',
			'max_qty' => 'products_data',
			'weight' => 'products_data',
			'shipping_freight' => 'products_data',
			'box_height' => 'products_data',
			'box_length' => 'products_data',
			'box_width' => 'products_data',
			'min_items_in_box' => 'products_data',
			'max_items_in_box' => 'products_data',
			'qty_step' => 'products_data',
			'list_qty_count' => 'products_data',
			'popularity' => 'products_data'
		),

		'C' => array ( // checkboxes
			'is_edp' => 'products_data',
			'edp_shipping' => 'products_data',
			'free_shipping' => 'products_data',
			'feature_comparison' => 'products_data'
		),

		'D' => array ( // textareas
			'short_description' => 'products_data',
			'full_description' => 'products_data',
			'meta_keywords' => 'products_data',
			'meta_description' => 'products_data',
			'search_words' => 'products_data',
		),
		'T' => array( // dates
			'timestamp' => 'products_data',
			'avail_since' => 'products_data',
		),
		'S' => array ( // selectboxes
			'out_of_stock_actions' => array (
				'name' => 'products_data',
				'variants' => array (
					'N' => 'none',
					'B' => 'buy_in_advance',
					'S' => 'sign_up_for_notification'
				),
			),
			'status' => array (
				'name' => 'products_data',
				'variants' => array (
					'A' => 'active',
					'D' => 'disabled',
					'H' => 'hidden'
				),
			),
			'tracking' => array (
				'name' => 'products_data',
				'variants' => array (
					'O' => 'track_with_options',
					'B' => 'track_without_options',
					'D' => 'dont_track'
				),
			),
			'zero_price_action' => array (
				'name' => 'products_data',
				'variants' => array (
					'R' => 'zpa_refuse',
					'P' => 'zpa_permit',
					'A' => 'zpa_ask_price'
				),
			),
		),
		'E' => array ( // categories
			'categories' => 'products_data'
		),
		
		'L' => array( // miltiple selectbox (localization)
			'localization' => array(
				'name' => 'localization'
			),
		),
		
		'W' => array( // Product details layout
			'details_layout' => 'products_data'
		)
	);

	$data = array_keys($selected_fields['data']);
	$get_main_pair = false;
	$get_taxes = false;
	$get_features = false;

	$fields2update = $data;

	// Process fields that are not in products or product_descriptions tables
	if (!empty($selected_fields['categories']) && $selected_fields['categories'] == 'Y') {
		$fields2update[] = 'categories';
	}
	if (!empty($selected_fields['main_pair']) && $selected_fields['main_pair'] == 'Y') {
		$get_main_pair = true;
		$fields2update[] = 'main_pair';
	}
	if (!empty($selected_fields['data']['taxes']) && $selected_fields['data']['taxes'] == 'Y') {
		$view->assign('taxes', fn_get_taxes());
		$fields2update[] = 'taxes';
		$get_taxes = true;
	}
	if (!empty($selected_fields['data']['features']) && $selected_fields['data']['features'] == 'Y') {
		$fields2update[] = 'features';
		$get_features = true;

		// get features for categories of selected products only
		$id_paths = db_get_fields("SELECT ?:categories.id_path FROM ?:products_categories LEFT JOIN ?:categories ON ?:categories.category_id = ?:products_categories.category_id WHERE product_id IN (?n)", $product_ids);

		$_params = array(
			'variants' => true,
			'category_ids' => array_unique(explode('/', implode('/', $id_paths)))
		);

		list($all_product_features) = fn_get_product_features($_params, 0, DESCR_SL);

		$view->assign('all_product_features', $all_product_features);
	}

	foreach ($product_ids as $value) {
		$products_data[$value] = fn_get_product_data($value, $auth, DESCR_SL, '?:products.*, ?:product_descriptions.*', false, $get_main_pair, $get_taxes, false, false, $get_features, true);
	}

	$filled_groups = array();
	$field_names = array();

	foreach ($fields2update as $k => $field) {
		if ($field == 'main_pair') {
			$desc = 'image_pair';
		} elseif ($field == 'tracking') {
			$desc = 'inventory';
		} elseif ($field == 'edp_shipping') {
			$desc = 'downloadable_shipping';
		} elseif ($field == 'is_edp') {
			$desc = 'downloadable';
		} elseif ($field == 'timestamp') {
			$desc = 'creation_date';
		} elseif ($field == 'categories') {
			$desc = 'categories';
		} elseif ($field == 'status') {
			$desc = 'status';
		} elseif ($field == 'avail_since') {
			$desc = 'available_since';
		} elseif ($field == 'min_qty') {
			$desc = 'min_order_qty';
		} elseif ($field == 'max_qty') {
			$desc = 'max_order_qty';
		} elseif ($field == 'qty_step') {
			$desc = 'quantity_step';
		} elseif ($field == 'list_qty_count') {
			$desc = 'list_quantity_count';
		} elseif ($field == 'usergroup_ids') {
			$desc = 'usergroups';
		} elseif ($field == 'details_layout') {
			$desc = 'product_details_layout';
		} elseif ($field == 'max_items_in_box') {
			$desc = 'maximum_items_in_box';
		} elseif ($field == 'min_items_in_box') {
			$desc = 'minimum_items_in_box';
		} elseif ($field == 'amount') {
			$desc = 'quantity';
		} else {
			$desc = $field;
		}

		if (!empty($field_groups['A'][$field])) {
			$filled_groups['A'][$field] = fn_get_lang_var($desc);
			continue;
		} elseif (!empty($field_groups['B'][$field])) {
			$filled_groups['B'][$field] = fn_get_lang_var($desc);
			continue;
		} elseif (!empty($field_groups['C'][$field])) {
			$filled_groups['C'][$field] = fn_get_lang_var($desc);
			continue;
		} elseif (!empty($field_groups['D'][$field])) {
			$filled_groups['D'][$field] = fn_get_lang_var($desc);
			continue;
		} elseif (!empty($field_groups['S'][$field])) {
			$filled_groups['S'][$field] = fn_get_lang_var($desc);
			continue;
		} elseif (!empty($field_groups['T'][$field])) {
			$filled_groups['T'][$field] = fn_get_lang_var($desc);
			continue;
		} elseif (!empty($field_groups['E'][$field])) {
			$filled_groups['E'][$field] = fn_get_lang_var($desc);
			continue;
		} elseif (!empty($field_groups['L'][$field])) {
			$filled_groups['L'][$field] = fn_get_lang_var($desc);
			continue;
		} elseif (!empty($field_groups['W'][$field])) {
			$filled_groups['W'][$field] = fn_get_lang_var($desc);
			continue;
		}

		$field_names[$field] = fn_get_lang_var($desc);
	}


	ksort($filled_groups, SORT_STRING);

	$view->assign('field_groups', $field_groups);
	$view->assign('filled_groups', $filled_groups);

	$view->assign('field_names', $field_names);
	$view->assign('products_data', $products_data);

//
// Delete product
//
} elseif ($mode == 'delete') {

	if (!empty($_REQUEST['product_id'])) {
		$result = fn_delete_product($_REQUEST['product_id']);
		if ($result) {
			fn_set_notification('N', fn_get_lang_var('notice'), fn_get_lang_var('text_product_has_been_deleted'));
		} else {
			return array(CONTROLLER_STATUS_REDIRECT, "products.update?product_id=$_REQUEST[product_id]");
		}
	}
	return array(CONTROLLER_STATUS_REDIRECT, "products.manage");

} elseif ($mode == 'delete_subscr') {

	if (!empty($_REQUEST['product_id'])) {
		db_query("DELETE FROM ?:product_subscriptions WHERE product_id = ?i", $_REQUEST['product_id']);
	}
	return array(CONTROLLER_STATUS_REDIRECT, "products.p_subscr");

} elseif ($mode == 'getfile') {

	if (!empty($_REQUEST['file_id'])) {
		$revisions = Registry::get('revisions');

		if (!empty($revisions['objects']['product']['tables'])) {
			$revision_subdir = '_rev';
		} else {
			$revision_subdir = '';
		}

		if (empty($_REQUEST['file_type'])) {
			$column = 'file_path';
		} else {
			$column = 'preview_path';
		}

		$file_path = db_get_row("SELECT $column, product_id FROM ?:product_files WHERE file_id = ?i", $_REQUEST['file_id']);
		if (PRODUCT_TYPE == 'MULTIVENDOR' && !fn_company_products_check($file_path['product_id'], true)) {
				return array(CONTROLLER_STATUS_DENIED);
		}
		fn_get_file(DIR_DOWNLOADS . $file_path['product_id'] . '/' . $file_path[$column]);
	}

} elseif ($mode == 'clone') {
	if (!empty($_REQUEST['product_id'])) {
		$pid = $_REQUEST['product_id'];
		$pdata = fn_clone_product($pid);
		if (!empty($pdata['product_id'])) {
			$pid = $pdata['product_id'];
			fn_set_notification('N', fn_get_lang_var('notice'), fn_get_lang_var('text_product_cloned'));
		}

		return array(CONTROLLER_STATUS_REDIRECT, "products.update?product_id=$pid");
	}

} elseif ($mode == 'delete_file') {

	if (!empty($_REQUEST['file_id'])) {
		$files_path = fn_delete_product_file($_REQUEST['file_id']);

		$_files = fn_get_product_files($files_path['product_id']);
		if (empty($_files)) {
			$view->display('views/products/components/products_update_files.tpl');
		}
	}
	exit;
}

?>