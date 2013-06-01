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

function fn_get_seo_company_condition($field, $object_type = '')
{
	$condition = '';

	if (PRODUCT_TYPE == 'ULTIMATE' && defined('SELECTED_COMPANY_ID')) {
		$condition = fn_get_company_condition($field, true, SELECTED_COMPANY_ID);

		// Disable companies in for shared objects
		if (!empty($object_type)) {
			$cache_name = 'seo.seo_object_' . $object_type;
			Registry::register_cache($cache_name, array(), CACHE_LEVEL_STATIC);
	
			if (Registry::is_exist($cache_name) && 0) {
				$allow = Registry::get($cache_name);
			} else {
				$allow = false;
				$seo_objects = fn_get_seo_vars();
				if (!empty($seo_objects[$object_type])) {
					$sharing = fn_get_schema('clone', 'sharing');
					foreach ($sharing as $object) {
						if (strpos($seo_objects[$object_type]['dispatch'], $object['controller']) !== FALSE) {
							$allow = true;
						}
					}
				}
			}

			if ($allow) {
				$condition = '';
			}
		}
	}

	return $condition;
}

function fn_get_seo_join_condition($field)
{
	if (PRODUCT_TYPE == 'ULTIMATE') {
		return " AND ?:seo_names.company_id = $field ";
	}

	return '';
}

/**
 * Function deletes seo name for different objects.
 *
 * @param int $object_id
 * @param string $object_type p - product, c - category, a - page, n - news, m - company
 * @param string $dispatch
 * @return always true )
 */
function fn_delete_seo_name($object_id, $object_type, $dispatch = '')
{
	db_query(
		'DELETE FROM ?:seo_names WHERE object_id = ?i AND type = ?s AND dispatch = ?s ?p',
		$object_id, $object_type, $dispatch, fn_get_seo_company_condition('?:seo_names.company_id', $object_type)
	);

	return true;
}

function fn_seo_delete_product_post($product_id)
{
	return fn_delete_seo_name($product_id, 'p');
}

function fn_seo_delete_company($company_id)
{
	return fn_delete_seo_name($company_id, 'm');
}

function fn_seo_delete_category_post($category_id)
{
	return fn_delete_seo_name($category_id, 'c');
}

function fn_seo_delete_page($page_id)
{
	return fn_delete_seo_name($page_id, 'a');
}

function fn_seo_delete_news($news_id)
{
	return fn_delete_seo_name($news_id, 'n');
}

function fn_create_import_seo_name($object_id, $object_type, $object_name, $product_name, $index = 0, $dispatch = '', $company_id = '', $lang_code = CART_LANGUAGE)
{
	if (empty($object_name)) {
		$object_name = $product_name;
	}

	return fn_create_seo_name($object_id, $object_type, $object_name, $index, $dispatch, $company_id, $lang_code);
}

function fn_create_seo_name($object_id, $object_type, $object_name, $index = 0, $dispatch = '', $company_id = '', $lang_code = CART_LANGUAGE)
{
	$_object_name = fn_generate_name($object_name);
	if (empty($_object_name)) {
		$__name = fn_get_seo_vars($object_type);
		$_object_name = $__name['description'] . '-' . (empty($object_id) ? $dispatch : $object_id);
	}

	$condition = fn_get_seo_company_condition('?:seo_names.company_id', $object_type);

	$exist = db_get_field(
		"SELECT name FROM ?:seo_names WHERE name = ?s AND (object_id != ?i OR type != ?s OR dispatch != ?s OR lang_code != ?s) ?p",
		$_object_name, $object_id, $object_type, $dispatch, $lang_code, $condition
	);

	if (!$exist) {
		$_data = array(
			'name' => $_object_name,
			'type' => $object_type,
			'object_id' => $object_id,
			'dispatch' => $dispatch,
			'lang_code' => $lang_code
		);

		if (PRODUCT_TYPE == 'ULTIMATE') {
			if (!empty($company_id)) {
				$_data['company_id'] = $company_id;
			} elseif (defined('COMPANY_ID')) {
				$_data['company_id'] = COMPANY_ID;
			}

			// Do not create seo names for root
			if (empty($_data['company_id'])) {
				return '';
			}
		}

		db_query("REPLACE INTO ?:seo_names ?e", $_data);
	} else {
		$index++;

		if ($index == 1) {
			$object_name = $object_name . SEO_DELIMITER . fn_strtolower($lang_code);
		} else {
			$object_name = preg_replace("/-\d+$/", "", $object_name) . SEO_DELIMITER . $index;
		}

		$_object_name = fn_create_seo_name($object_id, $object_type, $object_name, $index, $dispatch, $company_id, $lang_code);
	}

	return $_object_name;
}

function fn_get_corrected_seo_lang_code($lang_code)
{
	return (Registry::get('addons.seo.single_url') == 'Y') ? Registry::get('settings.Appearance.customer_default_language') : $lang_code;
}

function fn_seo_get_product_data($product_id, &$field_list, &$join, $auth, $lang_code)
{
	$field_list .= ', ?:seo_names.name as seo_name';

	if (PRODUCT_TYPE == 'ULTIMATE') {
		$company_join = !defined('COMPANY_ID') ? 'AND ?:seo_names.company_id = ?:products.company_id' : 'AND ?:seo_names.company_id = ' . COMPANY_ID;
	} else {
		$company_join = '';
	}

	$join .= db_quote(
		" LEFT JOIN ?:seo_names ON ?:seo_names.object_id = ?i AND ?:seo_names.type = 'p' "
		. "AND ?:seo_names.dispatch = '' AND ?:seo_names.lang_code = ?s $company_join",
		$product_id, fn_get_corrected_seo_lang_code($lang_code)
	);

	return true;
}

function fn_seo_get_products(&$params, &$fields, &$sortings, &$condition, &$join, $sorting, $group_by, $lang_code)
{
	if (isset($params['compact']) && $params['compact'] == 'Y') {
		$condition .= db_quote(' OR ?:seo_names.name LIKE ?s', '%' . preg_replace('/-[a-zA-Z]{1,3}$/i', '', str_ireplace('.html', '', $params['q'])) . '%');
	}

	$lang_condition = db_quote(' AND ?:seo_names.lang_code = ?s', $lang_code);
	$fields[] = '?:seo_names.name as seo_name';
	$join .= db_quote(
		" LEFT JOIN ?:seo_names ON ?:seo_names.object_id = products.product_id AND ?:seo_names.type = 'p' AND ?:seo_names.dispatch = '' ?p",
		$lang_condition . fn_get_seo_company_condition('?:seo_names.company_id')
	);
}

function fn_seo_get_company_data($company_id, &$field_list, &$join, &$condition, $lang_code)
{
	$field_list .= ', ?:seo_names.name as seo_name';
	$join .= db_quote(
		" LEFT JOIN ?:seo_names ON ?:seo_names.object_id = ?i AND ?:seo_names.type = 'm' "
		. "AND ?:seo_names.dispatch = '' AND ?:seo_names.lang_code = ?s ?p",
		$company_id, fn_get_corrected_seo_lang_code($lang_code), fn_get_seo_join_condition('?:companies.company_id')
	);

	return true;
}

function fn_seo_get_companies(&$params, &$fields, &$sortings, &$condition, &$join, $auth, $lang_code)
{
	$fields[] = '?:seo_names.name as seo_name';
	$join .= db_quote(
		" LEFT JOIN ?:seo_names ON ?:seo_names.object_id = ?:companies.company_id "
		. "AND ?:seo_names.type = 'm' AND ?:seo_names.dispatch = '' AND ?:seo_names.lang_code = ?s ?p",
		$lang_code,  fn_get_seo_join_condition('?:companies.company_id')
	);
}

function fn_seo_get_categories($params, $join, $condition, $fields, $group_by, $sortings)
{
	$fields[] = '?:seo_names.name as seo_name';
	$join .= db_quote(
		" LEFT JOIN ?:seo_names ON ?:seo_names.object_id = ?:categories.category_id "
		. "AND ?:seo_names.type = 'c' AND ?:seo_names.dispatch = '' AND ?:seo_names.lang_code = ?s ?p",
		CART_LANGUAGE,  fn_get_seo_join_condition('?:categories.company_id')
	);
}

function fn_seo_get_news($params, &$fields, &$join, $condition, $sorting, $limit, $lang_code)
{
	if (isset($params['compact']) && $params['compact'] == 'Y') {
		$condition .= db_quote(' OR ?:seo_names.name LIKE ?s', '%' . preg_replace('/-[a-zA-Z]{1,3}$/i', '', str_ireplace('.html', '', $params['q'])) . '%');
	}

	$lang_condition = db_quote(' AND ?:seo_names.lang_code = ?s', $lang_code);
	$fields[] = '?:seo_names.name as seo_name';
	$join .= db_quote(
		" LEFT JOIN ?:seo_names ON ?:seo_names.object_id = ?:news.news_id "
		. "AND ?:seo_names.type = 'n' AND ?:seo_names.dispatch = '' ?p",
		$lang_condition . fn_get_seo_join_condition('?:news.company_id')
	);
}

function fn_seo_get_pages($params, $join, $condition, $fields, $group_by, $sortings, $lang_code)
{
	if (isset($params['compact']) && $params['compact'] == 'Y') {
		$condition .= db_quote(' OR ?:seo_names.name LIKE ?s', '%' . preg_replace('/-[a-zA-Z]{1,3}$/i', '', str_ireplace('.html', '', $params['q'])) . '%');
	}

	$lang_condition = db_quote(' AND ?:seo_names.lang_code = ?s', $lang_code);
	$fields[] = '?:seo_names.name as seo_name';
	$join .= db_quote(
		" LEFT JOIN ?:seo_names ON ?:seo_names.object_id = ?:pages.page_id "
		. "AND ?:seo_names.type = 'a' AND ?:seo_names.dispatch = '' ?p",
		$lang_condition . fn_get_seo_join_condition('?:pages.company_id')
	);
}

function fn_seo_get_category_data($category_id, &$field_list, &$join, $lang_code)
{
	$field_list .= ', ?:seo_names.name as seo_name';
	$join .= db_quote(
		" LEFT JOIN ?:seo_names ON ?:seo_names.object_id = ?i AND ?:seo_names.type = 'c' "
		. "AND ?:seo_names.dispatch = '' AND ?:seo_names.lang_code = ?s ?p",
		$category_id, fn_get_corrected_seo_lang_code($lang_code), fn_get_seo_join_condition('?:categories.company_id')
	);
	return true;
}

function fn_seo_get_page_data(&$page_data, $lang_code)
{

	$page_data['seo_name'] = db_get_field(
		"SELECT name FROM ?:seo_names WHERE object_id = ?i AND type = 'a' "
		. " AND ?:seo_names.dispatch = '' AND ?:seo_names.lang_code = ?s ?p",
		$page_data['page_id'], fn_get_corrected_seo_lang_code($lang_code), fn_get_seo_join_condition('?:seo_names.company_id')
	);
	
	return true;
}

function fn_get_seo_vars($type = '')
{
	$seo = array(
		'p' => array(
			'table' => '?:product_descriptions',
			'description' => 'product',
			'dispatch' => 'products.view',
			'item' => 'product_id',
			'condition' => ''
		),
		'c' => array(
			'table' => '?:category_descriptions',
			'description' => 'category',
			'dispatch' => 'categories.view',
			'item' => 'category_id',
			'condition' => ''
		),
		'a' => array(
			'table' => '?:page_descriptions',
			'description' => 'page',
			'dispatch' => 'pages.view',
			'item' => 'page_id',
			'condition' => ''
		),
		'e' => array(
			'table' => '?:product_feature_variant_descriptions',
			'description' => 'variant',
			'dispatch' => 'product_features.view',
			'item' => 'variant_id',
			'condition' => ''
		),
		
		'm' => array(
			'table' => '?:companies',
			'description' => 'company',
			'dispatch' => 'companies.view',
			'item' => 'company_id',
			'condition' => ''
		),
		
		's' => array(
			'table' => '?:seo_names',
			'description' => 'name',
			'dispatch' => '',
			'item' => 'object_id',
			'condition' => fn_get_seo_company_condition('?:seo_names.company_id')
		),
	);

	fn_set_hook('get_seo_vars', $seo);

	return (!empty($type)) ? $seo[$type] : $seo;
}

function fn_get_rewrite_rules()
{
	$customer_index = Registry::get('config.customer_index');
	$current_path = (defined('HTTPS')) ? Registry::get('config.https_path') : Registry::get('config.http_path');

	$prefix = ((Registry::get('addons.seo.seo_language') == 'Y') ? '\/([a-z]+)' : '()');

	$rewrite_rules = array();

	$extension = str_replace('.', '', SEO_FILENAME_EXTENSION);

	fn_set_hook('get_rewrite_rules', $rewrite_rules, $prefix, $extension, $current_path);

	$rewrite_rules['!^' . $current_path . $prefix . '\/(.*\/)?([^\/]+)-page-([0-9]+|full_list)\.(' . $extension . ')$!'] = 'object_name=$matches[3]&page=$matches[4]&sl=$matches[1]&extension=$matches[5]';
	$rewrite_rules['!^' . $current_path . $prefix . '\/(.*\/)?([^\/]+)\.(' . $extension . ')$!'] = 'object_name=$matches[3]&sl=$matches[1]&extension=$matches[4]';

	if (Registry::get('addons.seo.seo_language') == 'Y') {
		$rewrite_rules['!^' . $current_path . $prefix . '\/?$!'] = '$customer_index?sl=$matches[1]';
	}
	if (Registry::get('addons.seo.seo_category_type') != 'file') {
		$rewrite_rules['!^' . $current_path . $prefix . '\/(.*\/)?([^\/]+)\/page-([0-9]+|full_list)(\/)?$!'] = 'object_name=$matches[3]&page=$matches[4]&sl=$matches[1]';
	}

	$rewrite_rules['!^' . $current_path . $prefix . '\/(.*\/)?([^\/?]+)\/?$!'] = 'object_name=$matches[3]&sl=$matches[1]';
	$rewrite_rules['!^' . $current_path . $prefix . '/$!'] = '';

	return $rewrite_rules;
}

function fn_seo_get_route(& $req)
{
	$config = Registry::get('config');
	$seo_settings = Registry::get('addons.seo');
	$current_path = (defined('HTTPS')) ? Registry::get('config.https_path') : Registry::get('config.http_path');

	if ((AREA == 'C') && empty($req['sef_rewrite']) && Registry::get('addons.seo.seo_language') == 'Y' && empty($_REQUEST)) {
		
		fn_init_localization($_REQUEST);
		
		fn_init_language($_REQUEST);

		if (fn_url("", 'C', 'rel', '&amp;', CART_LANGUAGE) != $_SERVER['REQUEST_URI']) {
			// redirect from "www.site.com" to "www.site.com/en/" in case of multilanguage urls.
			fn_define('MODE', '');
			header("HTTP/1.0 301 Moved Permanently");
			fn_redirect(fn_url("", 'C', 'rel', '&amp;', CART_LANGUAGE), true);
		}
	}

	if ((AREA == 'C') && !empty($req['sef_rewrite'])) {

		// Remove web directory from request
		if (!preg_match('!^' . $current_path . '/(' . $config['customer_index'] . ')(.*)$!', $_SERVER['REQUEST_URI'])) {
			$url_pattern = @parse_url($_SERVER['REQUEST_URI']);
			if (empty($url_pattern)) {
				// Unable to parse URL
				$req = array(
					'dispatch' => '_no_page'
				);
				return false;
			}

			$rule_matched = false;
			$rewrite_rules = fn_get_rewrite_rules();
			foreach ($rewrite_rules as $pattern => $query) {
				if (preg_match($pattern, $url_pattern['path'], $matches) || preg_match($pattern, urldecode($query), $matches)) {
					$rule_matched = true;
					$_query = preg_replace("!^.+\?!", '', $query);
					parse_str($_query, $objects);
					$result_values = 'matches';
					$url_query = "";
					foreach ($objects as $key => $value) {
						preg_match('!^.+\[([0-9])+\]$!', $value, $_id);
						$objects[$key] = (substr($value, 0, 1) == '$') ? ${$result_values}[$_id[1]] : $value;
					}

					if (!empty($objects['sl']) && $objects['sl'] == 'gr') {
						$objects['sl'] = 'el';
						//TODO: Remove me 27.10.2012 - this fix for seourls after rename greek code from GR to EL
						if (!empty($_SERVER['REDIRECT_URL'])) {
							$redirect_url = (defined('HTTPS') ? 'https://' . $config['https_host'] : 'http://' . $config['http_host']) . str_replace('/gr/', '/el/', $_SERVER['REDIRECT_URL']);
							fn_define('CART_LANGUAGE', 'EL');
							header("HTTP/1.0 301 Moved Permanently");
							fn_redirect($redirect_url, true);
						}
					}

					// For the locations wich names stored in the table
					if (!empty($objects) && !empty($objects['object_name'])) {

						if (Registry::get('addons.seo.single_url') == 'Y') {
							$objects['sl'] = (Registry::get('addons.seo.seo_language') == 'Y') ? $objects['sl'] : '';
							$objects['sl'] = !empty($req['sl']) ? $req['sl'] : $objects['sl'];
						}
						$lang_cond = db_quote("AND lang_code = ?s", !empty($objects['sl']) ? strtoupper($objects['sl']) : Registry::get('settings.Appearance.' . AREA_NAME . '_default_language'));
						
						$object_type = db_get_field("SELECT type FROM ?:seo_names WHERE name = ?s ?p", $objects['object_name'], fn_get_seo_company_condition('?:seo_names.company_id')); 
						
						$_seo = db_get_row("SELECT * FROM ?:seo_names WHERE name = ?s ?p ?p", $objects['object_name'], fn_get_seo_company_condition('?:seo_names.company_id', $object_type), $lang_cond);

						if (empty($_seo)) {
							$_seo = db_get_row("SELECT * FROM ?:seo_names WHERE name = ?s ?p", $objects['object_name'], fn_get_seo_company_condition('?:seo_names.company_id', $object_type));
						}

						if (empty($_seo) && !empty($objects['extension'])) {
							$_seo = db_get_row("SELECT * FROM ?:seo_names WHERE name = ?s ?p ?p", $objects['object_name'] . '.' . $objects['extension'], fn_get_seo_company_condition('?:seo_names.company_id', $object_type), $lang_cond);
							if (empty($_seo)) {
								$_seo = db_get_row("SELECT * FROM ?:seo_names WHERE name = ?s ?p", $objects['object_name'] . '.' . $objects['extension'], fn_get_seo_company_condition('?:seo_names.company_id', $object_type));
							}
						}

						if (!empty($_seo) && ($_seo['type'] == 's' && !empty($objects['extension']) && strpos($_seo['name'], '.' . $objects['extension']) === false || Registry::get('addons.seo.seo_category_type') == 'file' && $_seo['type'] == 'c' && empty($objects['extension']))) {
							$_seo = array();
							$objects['object_name'] = '_wrong_path_';
						}
						if (!empty($_seo)) {

							if (Registry::get('addons.seo.single_url') != 'Y' && empty($objects['sl'])) {
								$objects['sl'] = $_seo['lang_code'];
							}

							$req['sl'] = strtoupper($objects['sl']);

							if (fn_seo_validate_object($_seo, $url_pattern['path'], $objects) == false) {
								$req = array(
									'dispatch' => '_no_page'
								);
								return false;
							}

							$_seo_vars = fn_get_seo_vars($_seo['type']);
							if ($_seo['type'] == 's') {
								$url_query = 'dispatch=' . $_seo['dispatch'];
								$req['dispatch'] = $_seo['dispatch'];
							} else {
								$page_suffix = (!empty($objects['page'])) ? ('&page=' . $objects['page']) : '';
								$url_query = 'dispatch=' . $_seo_vars['dispatch'] . '&' . $_seo_vars['item'] . '=' . $_seo['object_id'] . $page_suffix;

								$req['dispatch'] = $_seo_vars['dispatch'];
							}
							$req[$_seo_vars['item']] = $_seo['object_id'];
						} elseif (($current_path != $objects['object_name']) || strlen($objects['object_name']) == 2) {
							$req = array(
								'dispatch' => '_no_page'
							);
							return false;
						}

						// For the locations wich names are not in the table
					} elseif (!empty($objects)) {
						if (empty($objects['dispatch'])) {
							if (!empty($req['dispatch'])) {
								$req['dispatch'] = is_array($req['dispatch']) ? key($req['dispatch']) : $req['dispatch'];
								$url_query = 'dispatch=' . $req['dispatch'];
							}
						} else {
							$url_query = 'dispatch=' . $objects['dispatch'];
							$req['dispatch'] = $objects['dispatch'];
						}
						if (!empty($objects['sl'])) {
							$req['sl'] = strtoupper($objects['sl']);
							if (Registry::get('addons.seo.seo_language') == 'Y') {
								$lang_statuses = !empty($_SESSION['auth']['area']) && $_SESSION['auth']['area'] == 'A' ? array('A', 'H') : array('A');
								$check_language = db_get_field("SELECT count(*) FROM ?:languages WHERE lang_code = ?s AND status IN (?a)", $req['sl'], $lang_statuses);
								if ($check_language == 0) {
									$req = array(
										'dispatch' => '_no_page'
									);
									return false;
								}
							}
						}

						// Empty query
					} else {
						$url_query = '';
					}

					if (!empty($objects['page'])) {
						$req['page'] = $objects['page'];
					}

					$_SERVER['REQUEST_URI'] = $config['customer_index'] . '?' . $url_query;
					$_SERVER['QUERY_STRING'] = $url_query . (!empty($_SERVER['QUERY_STRING']) ? '&' . $_SERVER['QUERY_STRING'] : '');
					break;
				}
			}
			if (empty($rule_matched)) {
				$req = array(
					'dispatch' => '_no_page'
				);
				return false;
			}
		}

		unset($req['sef_rewrite']);
		$_SERVER['QUERY_STRING'] = fn_query_remove($_SERVER['QUERY_STRING'], 'sef_rewrite');

		Registry::set('runtime.sef_rewrite', true);
	}
}

function fn_seo_update_object($object_data, $object_id, $type, $lang_code, $generate_for_company_ids = array())
{
	fn_set_hook('seo_update_objects_pre', $object_data, $object_id, $type, $lang_code, $generate_for_company_ids);

	if ((isset($object_data['seo_name']) || !empty($generate_for_company_ids)) && !empty($object_id)) {
		$_object_name = '';

		$seo_vars = fn_get_seo_vars($type);

        if (PRODUCT_TYPE == 'ULTIMATE' && isset($object_data['company_id'])) {
            $object_company_id = $object_data['company_id'];
        } else {
            $object_company_id = '';
		}		

        if (!empty($generate_for_company_ids)) {
            $generate_for_company_ids = array_merge($generate_for_company_ids, array($object_company_id));
		} else {
			$generate_for_company_ids = array($object_company_id);
		}

		$generate_for_company_ids = array_unique($generate_for_company_ids);

        foreach ($generate_for_company_ids as $_company_id) {
        	$company_name = false;

        	if (empty($object_data['seo_name'])) {
        		$object_data['seo_name'] = db_get_field('SELECT name FROM ?:seo_names WHERE object_id = ?i AND company_id = ?i AND type = ?s', $object_id, $_company_id, $type);

        		$company_name = true;
        	}

            if ($object_company_id == $_company_id) {
                if (!empty($object_data['seo_name'])) {
                    $_object_name = $object_data['seo_name'];
                } elseif (!empty($object_data[$seo_vars['description']])) {
                    $_object_name = $object_data[$seo_vars['description']];
                }

            } else {
                $_object_name = db_get_field('SELECT name FROM ?:seo_names WHERE object_id = ?s AND company_id = ?i AND type = ?s', $object_id, $_company_id, $type);

                if (empty($_object_name) && !empty($object_data[$seo_vars['description']])) {
                    $_object_name = $object_data[$seo_vars['description']];
                }
            }

            fn_create_seo_name($object_id, $type, $_object_name, 0, '', $_company_id, fn_get_corrected_seo_lang_code($lang_code));

			if ($company_name) {
				unset($object_data['seo_name']);
			}
        }

	}
}

function fn_seo_update_category_post($category_data, $category_id, $lang_code)
{
    $company_id = db_get_fields('SELECT company_id FROM ?:categories WHERE category_id = ?i', $category_id);

    fn_seo_update_object($category_data, $category_id, 'c', $lang_code, $company_id);
}

function fn_seo_update_product_post($product_data, $product_id, $lang_code)
{
	if (defined('COMPANY_ID')) {
		$product_data['company_id'] = COMPANY_ID;
	}

    if (empty($product_data['categories'])) {
        $product_data['categories'] = db_get_fields('SELECT category_id FROM ?:products_categories WHERE product_id = ?i', $product_id);
        $product_data['categories'] = implode(',', $product_data['categories']);
    }
    $company_ids = db_get_fields('SELECT company_id FROM ?:categories WHERE category_id IN (?a)', explode(',', $product_data['categories']));
    fn_seo_update_object($product_data, $product_id, 'p', $lang_code, $company_ids);
}

function fn_seo_update_company($company_data, $company_id, $lang_code)
{
	fn_seo_update_object($company_data, $company_id, 'm', $lang_code);
}

function fn_seo_update_page_post($page_data, $page_id, $lang_code)
{
	if (defined('COMPANY_ID')) {
		$page_data['company_id'] = COMPANY_ID;
	}

    if (PRODUCT_TYPE == 'ULTIMATE') {
        $company_ids = fn_ult_get_shared_companies($page_id, 'pages');
    } else {
        if (empty($page_data['company_id'])) {
            $company_ids = db_get_fields('SELECT company_id FROM ?:pages WHERE page_id = ?i', $page_id);
        } else {
            $company_ids = array($page_data['company_id']);
        }
    }

    fn_seo_update_object($page_data, $page_id, 'a', $lang_code, $company_ids);
}

/**
 * Adds additional actions after product feature updating
 *
 * @param array $feature_data Feature data
 * @param int $feature_id Feature identifier
 * @param array $deleted_variants Deleted product feature variants identifiers
 * @param string $lang_code 2-letters language code
 */
function fn_seo_update_product_feature_post($feature_data, $feature_id, $deleted_variants, $lang_code)
{
	if ($feature_data['feature_type'] == 'E' && !empty($feature_data['variants'])) {
		foreach ($feature_data['variants'] as $v) {
			if (!empty($v['variant_id'])) {
                if (PRODUCT_TYPE == 'ULTIMATE') {
                    $company_ids = fn_ult_get_shared_companies($feature_id, 'product_features');
                } else {
                    $company_ids = array($feature_data['company_id']);
                }

                fn_seo_update_object($v, $v['variant_id'], 'e', $lang_code, $company_ids);
			}
		}

		if (!empty($deleted_variants)) {
			db_query(
				"DELETE FROM ?:seo_names WHERE object_id IN (?n) AND type = ?s AND dispatch = '' ?p",
				$deleted_variants, 'e', fn_get_seo_company_condition('?:seo_names.company_id')
			);
		}
	} elseif (is_array($feature_data['variants'])) {
		$object_ids = array();
		foreach ($feature_data['variants'] as $variant) {
			if (!empty($variant['variant_id'])) {
				$object_ids[] = $variant['variant_id'];
			}
		}

		db_query(
			"DELETE FROM ?:seo_names WHERE object_id IN (?n) AND type = ?s AND dispatch = '' ?p",
			$object_ids, 'e', fn_get_seo_company_condition('?:seo_names.company_id')
		);
	}
}

function fn_seo_delete_product_feature($feature_id)
{
	$variant_ids = db_get_fields("SELECT variant_id FROM ?:product_feature_variants WHERE feature_id = ?i", $feature_id);

	if (!empty($variant_ids)) {
		db_query(
			"DELETE FROM ?:seo_names WHERE object_id IN (?n) AND type = ?s AND dispatch = '' ?p",
			$variant_ids, 'e', fn_get_seo_company_condition('?:seo_names.company_id')
		);
	}
}

function fn_seo_get_product_feature_variants(&$fields, &$join, &$condition, $group_by, $sorting, $lang_code)
{
	$fields[] = '?:seo_names.name as seo_name';
	$join .= db_quote(
		" LEFT JOIN ?:seo_names ON ?:seo_names.object_id = ?:product_feature_variants.variant_id "
		. "AND ?:seo_names.type = 'e' AND ?:seo_names.dispatch = '' AND ?:seo_names.lang_code = ?s",
		fn_get_corrected_seo_lang_code($lang_code)
	);
}

function fn_seo_get_news_data(&$fields, &$join, &$condition, $lang_code)
{
	$fields[] = '?:seo_names.name as seo_name';
	$join .= db_quote(
		" LEFT JOIN ?:seo_names ON ?:seo_names.object_id = ?:news.news_id AND ?:seo_names.type = 'n' "
		. "AND ?:seo_names.dispatch = '' AND ?:seo_names.lang_code = ?s",
		fn_get_corrected_seo_lang_code($lang_code), fn_get_seo_join_condition('?:news.company_id')
	);
}

function fn_seo_update_news($news_data, $news_id, $lang_code)
{
	if (!empty($news_data['news']) && !empty($news_id)) {
		if (defined('COMPANY_ID')) {
			$news_data['company_id'] = COMPANY_ID;
		}

        if (PRODUCT_TYPE == 'ULTIMATE') {
            $company_ids = fn_ult_get_shared_companies($news_id, 'news');
        } else {
            if (empty($news_data['company_id'])) {
                $company_ids = db_get_fields('SELECT company_id FROM ?:news WHERE news_id = ?i', $news_id);
            } else {
                $company_ids = array($news_data['company_id']);
            }
        }

        fn_seo_update_object($news_data, $news_id, 'n', $lang_code, $company_ids);
	}
}

function fn_seo_validate_object($seo, $path, $objects)
{
	$result = true;
	if (Registry::get('addons.seo.single_url') == 'Y' && $seo['lang_code'] != Registry::get('settings.Appearance.customer_default_language')) {
		return false;
	}

	if (!empty($objects['sl']) && strtoupper($objects['sl']) != $seo['lang_code'] && Registry::get('addons.seo.single_url') != 'Y') {
		return false;
	}

	if (AREA == 'C') {
		$avail_langs = fn_get_simple_languages(!empty($_SESSION['auth']['area']) && $_SESSION['auth']['area'] == 'A');
		$obj_sl = !empty($objects['sl']) ? strtoupper($objects['sl']) : $seo['lang_code'];
		if (!in_array($obj_sl, array_keys($avail_langs))) {
			return false;
		}
	}

	$path = substr($path, strlen((defined('HTTPS') ? Registry::get('config.https_path') : Registry::get('config.http_path'))) + 1); // remove path prefix
	$path = substr_replace($path, '', strrpos($path, $objects['object_name'])); // remove object from path

	if (Registry::get('addons.seo.seo_language') == 'Y') {
		$path = substr($path, 3); // remove language prefix
	}

	$path = rtrim($path, '/'); // remove trailing slash
	// check parent objects
	$vars = fn_get_seo_vars($seo['type']);
	$id_path = '';
	if ($seo['type'] == 'p') {
		if (Registry::get('addons.seo.seo_product_type') == 'product_category') {
			$id_paths = db_get_array("SELECT id_path, c.category_id FROM ?:categories as c LEFT JOIN ?:products_categories as p ON p.category_id = c.category_id WHERE p.product_id = ?i ?p", $seo['object_id'], fn_get_seo_company_condition('c.company_id'));
			$result = false;
			foreach ($id_paths as $id_path) {
				if (fn_seo_validate_parents($path, $id_path['id_path'], 'c', false, $seo['lang_code'])) {
					$_SESSION['current_category_id'] = $id_path['category_id'];
					$result = true;
				}
			}
		} else {
			$result = fn_seo_validate_parents($path, $id_path, 'c', false, $seo['lang_code']);
		}
	} elseif ($seo['type'] == 'c') {
		$id_path = db_get_field("SELECT id_path FROM ?:categories WHERE category_id = ?i AND parent_id != 0", $seo['object_id']);
		$result = (Registry::get('addons.seo.seo_category_type') == 'root_category') ? empty($path) : fn_seo_validate_parents($path, $id_path, 'c', true, $seo['lang_code']);
	} elseif ($seo['type'] == 'a') {
		if (Registry::get('addons.seo.seo_product_type') == 'product_category') {
			$id_path = db_get_field("SELECT id_path FROM ?:pages WHERE page_id = ?i AND parent_id != 0", $seo['object_id']);
		}
		$result = fn_seo_validate_parents($path, $id_path, 'a', true, $seo['lang_code']);
	} elseif ($seo['type'] == 's') {
		if (!empty($path)) {
			$result = false;
		}
	}

	// check for .html extension for the current object
	if ((in_array($seo['type'], array('p', 'a')) && empty($objects['extension'])) || ($seo['type'] == 'c' && Registry::get('addons.seo.seo_category_type') != 'file' && !empty($objects['extension']))) {
		$result = false;
	}

	fn_set_hook('validate_sef_object', $path, $seo, $vars, $result, $objects);

	return $result;
}

function fn_seo_validate_parents($path, $id_path, $parent_type, $trim_last = false, $lang_code = CART_LANGUAGE)
{
	$result = true;

	if (!empty($id_path)) {
		if ($trim_last == true) {
			$id_path = explode('/', $id_path);
			array_pop($id_path);
		}

		$parent_names = explode('/', $path);
		$parent_ids = is_array($id_path) ? $id_path : explode('/', $id_path);

		if (count($parent_ids) == count($parent_names)) {
			$parents = db_get_hash_single_array(
				"SELECT object_id, name FROM ?:seo_names WHERE name IN (?a) AND type = ?s AND lang_code = ?s ?p",
				array('object_id', 'name'), $parent_names, $parent_type, $lang_code, fn_get_seo_company_condition('?:seo_names.company_id')
			);

			foreach ($parent_ids as $k => $id) {
				if (empty($parents[$id]) || $parent_names[$k] != $parents[$id]) {
					$result = false;
					break;
				}
			}
		} else {
			$result = false;
		}
	} elseif (!empty($path)) { // if we have no parents, but some was passed via URL
		$result = false;
	}

	return $result;
}

/**
 * Define whether current page should be indexed
 * 
 * $indexed_dispatches's element structure: 
 * 'dipatch' => array( 'index' => array('param1','param2'),
 * 						'noindex' => array('param3'),
 * 					)
 * the page can be indexed only if the current dispatch is in keys of the $indexed_dispatches array.
 * If so, the page is indexed only if param1 and param2 are the keys of the $_REQUEST array and param3 is not.
 * @param array $request
 * @return bool $index_page  indicate whether indexed or not
 */
function fn_seo_is_indexed_page($request)
{
	if (defined('HTTPS')) {
		return false;
	}

	$indexed_dispatches = array(
		'index.index' => array(),
		'sitemap.view' => array(),
		'products.view' => array('index' => array('product_id')),
		'categories.catalog' => array(),
		'categories.view' => array(
			'index' => array('category_id'),
			'noindex' => array('features_hash')
		),
		'pages.view' => array('index' => array('page_id')),
		'companies.view' => array('index' => array('company_id')),
		'product_features.view' => array(
			'index' => array('variant_id'),
			'noindex' => array('features_hash'),
		),
	);

	fn_set_hook('seo_is_indexed_page', $indexed_dispatches);
	$index_page = false;
	if (isset($indexed_dispatches[CONTROLLER . '.' . MODE]) && is_array($indexed_dispatches[CONTROLLER . '.' . MODE])) {

		$_dispatch = $indexed_dispatches[CONTROLLER . '.' . MODE];

		if (empty($_dispatch['index']) && empty($_dispatch['noindex'])) {
			$index_page = true;
		} else {
			$index_cond = true;
			if (!empty($_dispatch['index']) && is_array($_dispatch['index'])) {
				$index_cond = false;
				if (sizeof(array_intersect($_dispatch['index'], array_keys($request))) == sizeof($_dispatch['index'])) {
					$index_cond = true;
				}
			}

			$noindex_cond = true;
			if (!empty($_dispatch['noindex']) && is_array($_dispatch['noindex'])) {
				$noindex_cond = false;
				if (sizeof(array_intersect($_dispatch['noindex'], array_keys($request))) == 0) {
					$noindex_cond = true;
				}
			}
			$index_page = $index_cond && $noindex_cond;
		}
	}

	return $index_page;
}

/**
 * Create cache for static items
 * @param string $lang_code language code
 * @return boolean always true
 */
function fn_seo_cache_static_create($lang_code = CART_LANGUAGE)
{
	Registry::register_cache('seo', array('seo_names'), $lang_code);
	// Get and cache names for pages, extended features and static names

	$condition = "";
	if (defined('COMPANY_ID')) {
		$condition .= db_quote(" AND company_id=?i", COMPANY_ID);
	}

	if (Registry::is_exist('seo') == false) {
		$cache = array();
		$object_types = array(
			'a' => array('object_id', 'name'),
			's' => array('dispatch', 'name'),
			'e' => array('object_id', 'name'),
			'm' => array('object_id', 'name'),
		);
		fn_set_hook('seo_static_cache', $object_types, $lang_code);
		foreach ($object_types as $k => $v) {
			$names = db_get_hash_single_array("SELECT ?p FROM ?:seo_names WHERE type = ?s AND lang_code = ?s ?p", $v, implode(',', $v), $k, $lang_code, $condition);
			$cache[$k] = $names;
		}
		Registry::set('seo', $cache);
	}
	return true;
}

/**
 * Cache news names
 * @param array $news news
 * @return boolean always true
 */
function fn_seo_get_news_post($news)
{
	if (AREA == 'C') {
		foreach ($news as $k => $n) {
			fn_seo_cache_name('n', $n['news_id'], $n['seo_name'], isset($n['company_id']) ? $n['company_id'] : '', CART_LANGUAGE);
		}
	}

	return true;
}

/**
 * Cache products names
 * @param array $products products
 * @return boolean always true
 */
function fn_seo_get_products_post($products)
{
	if (AREA == 'C' && !empty($products)) {

		$product_ids = array();
		foreach ($products as $k => $product) {
			$product_ids[] = $product['product_id'];
			fn_seo_cache_name('p', $product['product_id'], $product['seo_name'],  isset($product['company_id']) ? $product['company_id'] : '', CART_LANGUAGE);
		}

		if (Registry::get('addons.seo.seo_product_type') == 'product_category') {
			$id_paths = db_get_array("SELECT pc.product_id, c.id_path, pc.link_type FROM ?:products_categories as pc LEFT JOIN ?:categories as c ON pc.category_id = c.category_id WHERE pc.product_id IN (?n) ?p ORDER BY pc.link_type ASC", $product_ids, fn_get_seo_company_condition('c.company_id'));

			foreach ($id_paths as $path) {
				fn_seo_cache_parent_items_path('p', $path['product_id'], $path['id_path']);
			}
		}
	}
	return true;
}

/**
 * Cache categories names
 * @param array $categories categories
 * @return boolean always true
 */
function fn_seo_get_categories_post($categories)
{
	if (AREA == 'C') {
		foreach ($categories as $k => $category) {
			fn_seo_cache_parent_items_path('c', $category['category_id'], $category['id_path']);
			fn_seo_cache_name('c', $category['category_id'], $category['seo_name'], isset($category['company_id']) ? $category['company_id'] : '', CART_LANGUAGE);
		}
	}
	return true;
}

/**
 * Cache categories names and pathes
 * @param array $category_data category data
 * @return boolean always true
 */
function fn_seo_get_category_data_post($category_data)
{
	if (AREA == 'C' && !empty($category_data)) {
		fn_seo_cache_parent_items_path('c', $category_data['category_id'], $category_data['id_path']);
		fn_seo_cache_name('c', $category_data['category_id'], $category_data['seo_name'], isset($category['seo_name']) ? $category['seo_name'] : '', CART_LANGUAGE);
	}
	return true;
}

/**
 * Cache parent items path of names for seo object
 * @param string $object_type object type of seo object
 * @param string $object_id object id of seo object
 * @param string $id_path id path for seo object
 * @return boolean always true
 */
function fn_seo_cache_parent_items_path($object_type, $object_id, $id_path)
{
	static $count_cache_parent_items_path = 0;

	if ($count_cache_parent_items_path < SEO_RUNTIME_CACHE_COUNT) {
		Registry::set("runtime.seo.parent_items." . $object_type . "." . $object_id, $id_path);
		$count_cache_parent_items_path++;
	}
	return true;
}

/**
 * Get parent items path of names for seo object
 * @param string $object_type object type of seo object
 * @param string $object_id object id of seo object
 * @param boolean $is_pop - skip current object name
 * @param string $lang_code language code
 * @return array parent items path of names
 */
function fn_seo_get_parent_items_path($object_type, $object_id, $is_pop = false, $company_id = null, $lang_code = CART_LANGUAGE)
{
	$id_path = Registry::get('runtime.seo.parent_items.' . $object_type . '.' . $object_id);

	if (empty($id_path)) {
		if ($object_type == 'p') {
			$condition = '';
			if (!empty($company_id) && PRODUCT_TYPE == 'ULTIMATE') {
				$condition = db_quote(' AND ?:categories.company_id = ?i', $company_id);
			}
			$id_path = db_get_field(
				"SELECT ?:categories.id_path FROM ?:products_categories "
					. "LEFT JOIN ?:categories ON ?:products_categories.category_id = ?:categories.category_id "
				."WHERE ?:products_categories.product_id = ?i ?p ORDER BY ?:products_categories.link_type DESC LIMIT 1", 
				$object_id, $condition
			);
		} elseif ($object_type == 'c') {
			$id_path = db_get_field("SELECT id_path FROM ?:categories WHERE category_id = ?i", $object_id);
		} elseif ($object_type == 'a') {
			$id_path = db_get_field("SELECT id_path FROM ?:pages WHERE page_id = ?i", $object_id);
		}
		fn_set_hook('seo_get_parent_items_path', $object_type, $object_id, $id_path);
		fn_seo_cache_parent_items_path($object_type, $object_id, $id_path);
	}

	$parent_item_names = array();

	if (!empty($id_path)) {
		$path_ids = explode("/", $id_path);

		if ($is_pop) {
			array_pop($path_ids);
		}

		foreach ($path_ids as $v) {
			$object_type_for_name = ($object_type == 'p') ? 'c' : $object_type;
			$parent_item_names[] = fn_seo_get_name($object_type_for_name, $v, '', $company_id, $lang_code);
		}
		return $parent_item_names;
	}
	return array();
}

/**
 * Cache name for seo object
 * @param string $object_type object type of seo object
 * @param string $object_id object id of seo object
 * @param string $object_name  dispatch of seo object
 * @param string $lang_code language code
 * @return boolean always true
 */
function fn_seo_cache_name($object_type, $object_id, $object_name, $company_id, $lang_code)
{
	static $count_cache_name = 0;

	if ($count_cache_name < SEO_RUNTIME_CACHE_COUNT) {
		Registry::set("runtime.seo." . $lang_code . "." . $object_type . $company_id ."." . $object_id, $object_name);
		$count_cache_name++;
	}
	return true;
}

/**
 * Get name for seo object
 * @param string $object_type object type of seo object
 * @param string $object_id object id of seo object
 * @param string $dispatch  dispatch of seo object
 * @param string $lang_code language code
 * @return string name for seo object
 */
function fn_seo_get_name($object_type, $object_id = 0, $dispatch = '', $company_id = null, $lang_code = CART_LANGUAGE)
{
	$company_id_condition = '';



	if ($company_id == null) {
		$company_id = '';
	}

	$lang_code = fn_get_corrected_seo_lang_code($lang_code);
	$names = Registry::get('runtime.seo.' . $lang_code . '.' . $object_type . $company_id);

	$name = isset($names[$object_id]) ? $names[$object_id] : false;
	$_object_id = !empty($object_id) ? $object_id : $dispatch;

	if (empty($name)) {
		$names = Registry::get('seo');
		$name = (isset($names[$object_type][$_object_id]) && $lang_code == CART_LANGUAGE) ? $names[$object_type][$_object_id] : false;

		if (empty($name) && !($object_type == 's' && $lang_code == CART_LANGUAGE)) {
			$where_params = array(
				'object_id' => $object_id,
				'type' => $object_type,
				'dispatch' => $dispatch,
				'lang_code' => $lang_code,
			);
			$name = db_get_field("SELECT name FROM ?:seo_names WHERE ?w ?p", $where_params, $company_id_condition);

			if (empty($name)) {
				if ($object_type == 's') {
					$alt_name = db_get_field(
						"SELECT name FROM ?:seo_names WHERE object_id = ?i AND type = ?s AND dispatch = ?s ?p",
						$object_id, $object_type, $dispatch, $company_id_condition
					);
					if (!empty($alt_name)) {
						$name = fn_create_seo_name($object_id, $object_type, str_replace('.', '-', $dispatch), 0, $dispatch, $company_id, $lang_code);
					}
				} else {
					$_seo = fn_get_seo_vars($object_type);

					$object_name = '';
					// Get object name from its descriptions
					if (!empty($_seo['table']) && isset($_seo['condition'])) {
						$object_name = db_get_field(
							"SELECT $_seo[description] FROM $_seo[table] WHERE lang_code = ?s AND $_seo[item] = ?i ?p",
							$lang_code, $object_id, $_seo['condition']
						);
					}
					
					$name = fn_create_seo_name($object_id, $object_type, $object_name, 0, $dispatch, $company_id, $lang_code);
				}
			}
		}

		fn_seo_cache_name($object_type, $_object_id, $name, $company_id, $lang_code);
	}

	return $name;
}

/**
 * Check if object was called by direct link and create static cache
 * 
 * @return boolean always true
 */
function fn_seo_check_dispatch()
{
	fn_seo_cache_static_create();
	
	if (AREA == 'C' && !Registry::if_get('runtime.sef_rewrite', false) == true) {
		$url = $_SERVER['REQUEST_URI'];

		parse_str($_SERVER['QUERY_STRING'], $vars);
		if (!empty($vars['dispatch'])) {
			$dispatch = $vars['dispatch'];
			unset($vars['dispatch']);

			// Exclude external redirects
            if (is_array($dispatch)) {
                $dispatch = key($dispatch); // dispatch[products.search]=Search => products.search
            }
			if (strpos($dispatch, '://') !== false) {
				$dispatch = '';
			}

			$seo_url = fn_url($dispatch . '?' . fn_build_query($vars), 'C', 'rel', '&');
			
			$parsed_url = preg_replace('/index.php$/', '', parse_url($url));
			$parsed_seo_url = preg_replace('/index.php$/', '', parse_url($seo_url));

			if ($parsed_seo_url['path'] != $parsed_url['path']) {
				return array(INIT_STATUS_REDIRECT, $seo_url);
			}
		}
	}

	return array(INIT_STATUS_OK);
}

/**
 * Get seo url
 * @param string $url url
 * @param string $area area for area
 * @param string $original_url original url from fn_url
 * @param string $lang_code language code
 * @return string seo url
 */
function fn_seo_url_post(&$url, $area = AREA, $delimeter, $original_url = '', $prefix = 'rel', $company_id_in_url = false, $lang_code = CART_LANGUAGE)
{
	static $seo_settings_cache = array();

	if ($area != 'C') {
		return $url;
	}

	$d = SEO_DELIMITER;
	$url = str_replace('&amp;', '&', $url);
	$parced_query = array();
	$parced_url = parse_url($url);

	$index_script = Registry::get('config.customer_index');
	$http_path = Registry::get('config.http_path');
	$https_path = Registry::get('config.https_path');

    $settings_company_id = empty($company_id_in_url) ? 0 : $company_id_in_url;

    if (isset($seo_settings_cache[$settings_company_id])) {
        $seo_settings = $seo_settings_cache[$settings_company_id];
    } else {
        $seo_settings = CSettings::instance()->get_values('seo', CSettings::ADDON_SECTION, false, $company_id_in_url);
        $seo_settings_cache[$settings_company_id] = $seo_settings;
    }

	$current_path = '';
	if (empty($parced_url['scheme'])) {
		$current_path = (defined('HTTPS')) ? $https_path . '/' : $http_path . '/';
	}

	if (!empty($parced_url['scheme']) && ($parced_url['scheme'] != 'http' && $parced_url['scheme'] != 'https')) {
		return $url;  // This is no http/https url like mailto:, ftp:
	} elseif (!empty($parced_url['scheme'])) {
		if (!empty($parced_url['host']) && ($parced_url['host'] != Registry::get('config.http_host') && $parced_url['host'] != Registry::get('config.https_host'))) {
			if (PRODUCT_TYPE == 'ULTIMATE' && AREA == 'A') {
				$storefront_exist = db_get_row('SELECT company_id, storefront FROM ?:companies WHERE storefront = ?s || secure_storefront = ?s', $parced_url['host']);
				if (empty($storefront_exist)) {
					return $url;  // This is external link
				}
			} else {
				return $url;  // This is external link
			}
		} elseif (!empty($parced_url['path']) && (($parced_url['scheme'] == 'http' && !empty($http_path) && stripos($parced_url['path'], $http_path) === false) || ($parced_url['scheme'] == 'https' && !empty($https_path) && stripos($parced_url['path'], $https_path) === false))) {
			return $url;  // This is external link
		} else {
			if (rtrim($url, '/') == Registry::get('config.http_location') || rtrim($url, '/') == Registry::get('config.https_location')) {
				$url = rtrim($url, '/') . "/" . $index_script;
				$parced_url['path'] = rtrim($parced_url['path'], '/') . "/" . $index_script;
			}
		}
	}

	if (!empty($parced_url['query'])) {
		parse_str($parced_url['query'], $parced_query);
	}
	
	if (!empty($parced_query['lc'])) {
		//if localization parameter is exist we will get language code for this localization.
		$loc_languages = db_get_hash_single_array("SELECT a.lang_code, a.name FROM ?:languages as a LEFT JOIN ?:localization_elements as b ON b.element_type = 'L' AND b.element = a.lang_code WHERE b.localization_id = ?i ORDER BY position", array('lang_code', 'name'), $parced_query['lc']);
		$new_lang_code = (!empty($loc_languages)) ? key($loc_languages) : '';
		$lang_code = (!empty($new_lang_code)) ? $new_lang_code : $lang_code;
	}
	

	if (!empty($parced_url['path']) && empty($parced_url['query']) && $parced_url['path'] == $index_script) {
		$url = $current_path . (($seo_settings['seo_language'] == 'Y') ? fn_strtolower($lang_code) . '/' : '');
		return $url;
	}

	$path = str_replace($index_script, '', $parced_url['path'], $count);

	if ($count == 0) {
		return $url; // This is currently seo link
	}

	$fragment = !empty($parced_url['fragment']) ? '#' . $parced_url['fragment'] : '';

	$link_parts = array(
		'scheme' => !empty($parced_url['scheme']) ? $parced_url['scheme'] . '://' : '',
		'host' => !empty($parced_url['host']) ? $parced_url['host'] : '',
		'path' => $current_path . $path,
		'lang_code' => ($seo_settings['seo_language'] == 'Y') ? fn_strtolower($lang_code) . '/' : '',
		'parent_items_names' => '',
		'name' => '',
		'page' => '',
		'extension' => '',
	);

	if (!empty($parced_query)) {
		if (!empty($parced_query['sl'])) {
			$lang_code = strtoupper($parced_query['sl']);

			if ($seo_settings['single_url'] != 'Y') {
				$unset_lang_code = $parced_query['sl'];
				unset($parced_query['sl']);
			}

			if ($seo_settings['seo_language'] == 'Y') {
				$link_parts['lang_code'] = fn_strtolower($lang_code) . '/';
				$unset_lang_code = isset($parced_query['sl']) ? $parced_query['sl'] : $unset_lang_code;
				unset($parced_query['sl']);
			}
		}

		$lang_code = fn_get_corrected_seo_lang_code($lang_code);
		if (!empty($parced_query['dispatch']) && is_string($parced_query['dispatch'])) {

			if (!empty($original_url) && (stripos($parced_query['dispatch'], '/') !== false || substr($parced_query['dispatch'], -1 * strlen(SEO_FILENAME_EXTENSION)) == SEO_FILENAME_EXTENSION)) {
				$url = $original_url;
				return $url; // This is currently seo link
			}

			// Convert products links
			if ($parced_query['dispatch'] == 'products.view' && !empty($parced_query['product_id'])) {
				if ($seo_settings['seo_product_type'] == 'product_category') {
					$parent_item_names = fn_seo_get_parent_items_path('p', $parced_query['product_id'], false, $company_id_in_url, $lang_code);
					$link_parts['parent_items_names'] = !empty($parent_item_names) ? join('/', $parent_item_names) . "/" : "";
				}

				$link_parts['name'] = fn_seo_get_name('p', $parced_query['product_id'], '', $company_id_in_url, $lang_code);
				$link_parts['extension'] = SEO_FILENAME_EXTENSION;

				fn_seo_parced_query_unset($parced_query, 'product_id');

			// Convert categories links
			} elseif ($parced_query['dispatch'] == 'categories.view' && !empty($parced_query['category_id'])) {
				if ($seo_settings['seo_category_type'] != 'root_category') {
					$parent_item_names = fn_seo_get_parent_items_path('c', $parced_query['category_id'], true, $company_id_in_url, $lang_code);
					$link_parts['parent_items_names'] = !empty($parent_item_names) ? join('/', $parent_item_names) . "/" : "";
				}

				$link_parts['name'] = fn_seo_get_name('c', $parced_query['category_id'], '', $company_id_in_url, $lang_code);

				$page = isset($parced_query['page']) ? $parced_query['page'] : 0;
				if ($seo_settings['seo_category_type'] != 'file') {
					$link_parts['name'] .= '/';
					if (!empty($page) && $page != '1') {
						$link_parts['name'] .= 'page' . $d . $page . '/';
					}
					unset($parced_query['page']);
				} else {
					$link_parts['extension'] = SEO_FILENAME_EXTENSION;
					if (!empty($page) && $page != '1') {
						$link_parts['name'] .= $d . 'page' . $d . $page;
					}
					unset($parced_query['page']);
				}

				fn_seo_parced_query_unset($parced_query, 'category_id');

			//Convert pages links
			} elseif ($parced_query['dispatch'] == 'pages.view' && !empty($parced_query['page_id'])) {

				if ($seo_settings['seo_product_type'] == 'product_category') {
					$parent_item_names = fn_seo_get_parent_items_path('a', $parced_query['page_id'], true, $company_id_in_url, $lang_code);
					$link_parts['parent_items_names'] = !empty($parent_item_names) ? join('/', $parent_item_names) . "/" : "";
				}
				
				$company_id  = db_get_field("SELECT company_id FROM ?:pages WHERE page_id = ?i", $parced_query['page_id']);

				$link_parts['name'] = fn_seo_get_name('a', $parced_query['page_id'], '', $company_id_in_url, $lang_code);
				$link_parts['extension'] = SEO_FILENAME_EXTENSION;

				fn_seo_parced_query_unset($parced_query, 'page_id');

			// Convert extended features links
			} elseif ($parced_query['dispatch'] == 'product_features.view' && !empty($parced_query['variant_id'])) {

				$link_parts['name'] = fn_seo_get_name('e', $parced_query['variant_id'], '', $company_id_in_url, $lang_code);
				$link_parts['extension'] = SEO_FILENAME_EXTENSION;

				fn_seo_parced_query_unset($parced_query, 'variant_id');

			// Convert companies links
			} elseif ($parced_query['dispatch'] == 'companies.view' && !empty($parced_query['company_id'])) {

				$link_parts['name'] = fn_seo_get_name('m', $parced_query['company_id'], '', $company_id_in_url, $lang_code);
				$link_parts['extension'] = SEO_FILENAME_EXTENSION;

				fn_seo_parced_query_unset($parced_query, 'company_id');

			// Other conversions
			} else {
				fn_set_hook('seo_url', $seo_settings, $url, $parced_url, $link_parts, $parced_query, $company_id_in_url, $lang_code);
				// Convert static links
				if (empty($link_parts['name'])) {
					$name = fn_seo_get_name('s', 0, $parced_query['dispatch'], $company_id_in_url, $lang_code);
					if (!empty($name)) {
						$link_parts['name'] = $name;
						fn_seo_parced_query_unset($parced_query);
					} else {
						// for non-rewritten links
						$link_parts['path'] .= $index_script;
						$link_parts['lang_code'] = '';
						if (!empty($unset_lang_code)) {
							$parced_query['sl'] = $unset_lang_code;
						}
					}
				}
			}
		} elseif ($seo_settings['seo_language'] != 'Y' && !empty($unset_lang_code)) {
			$parced_query['sl'] = $unset_lang_code;
		}
	}

	$url = join('', $link_parts);

	// Remove obsolete parameter
	if (!empty($link_parts['name'])) {
		unset($parced_query['company_id']);
	}

	if (!empty($parced_query)) {
		$url .= '?' . http_build_query($parced_query, '', $delimeter) . $fragment;
	}

	return $url;
}

/**
 * Unset some keys in parced_query array
 * @param array $parts_array link parts
 * @param mixed $keys keys for unseting
 * @return string name for seo object
 */
function fn_seo_parced_query_unset(&$parts_array, $keys = array())
{
	$keys = is_array($keys) ? $keys : array($keys);
	$keys[] = 'dispatch';

	foreach ($keys as $v) {
		unset($parts_array[$v]);
	}

	return true;
}

function fn_seo_check_redirect_to_cart($url, $redirect)
{
	if (parse_url($url, PHP_URL_PATH) == fn_url('checkout.checkout') || parse_url($url, PHP_URL_PATH) == fn_url('checkout.cart')) {
		$redirect = false;
	}
}

function fn_seo_compare_dispatch($url1, $url2, &$result)
{
	$url1 = fn_url($url1);
	$url2 = fn_url($url2);

	$pos1 = strpos($url1, '?');
	if ($pos1 !== false) {
		$url1 = substr($url1, 0, $pos1);
	}

	$pos2 = strpos($url2, '?');
	if ($pos2 !== false) {
		$url2 = substr($url2, 0, $pos2);
	}

	$result = ($url1 == $url2);
}

?>