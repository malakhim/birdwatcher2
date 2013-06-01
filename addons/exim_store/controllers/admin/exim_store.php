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

if ( !defined('AREA') ) { die('Access denied');	}

$step = 1;
$store_data = !empty($_SESSION['store_data']) ? $_SESSION['store_data'] : array('type' => "local");

if (!empty($_REQUEST['store_data'])) {
	$store_data = array_merge($store_data, $_REQUEST['store_data']);
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
	if ($action == 'step_1') {
		$store_data['type'] = 'local';

		if (!empty($_REQUEST['store_data']['path']) && is_dir($_REQUEST['store_data']['path'])) {
			$store_data['path'] = fn_remove_trailing_slash($_REQUEST['store_data']['path']);

			$config = Stores_Import_General::getConfig($_REQUEST['store_data']['path']);
			if ($config !== false) {
				$store_data = fn_array_merge($store_data, $config);
				$step = 2;
			} else {
				fn_set_notification('E', fn_get_lang_var('error'), fn_get_lang_var('es_this_is_not_cart_path'));
			}
		} else {
			fn_set_notification('E', fn_get_lang_var('error'), fn_get_lang_var('es_path_does_not_exist'));
		}

	} elseif ($action == 'success') {
		fn_set_notification('N', fn_get_lang_var('notice'), fn_get_lang_var('es_import_successfully_finished'), 'K');
	}
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if ($action == 'step_2') {
		$step = 3;

		if (empty($store_data['path']) || !is_dir($store_data['path'])) {
			fn_set_notification('E', fn_get_lang_var('error'), fn_get_lang_var('es_path_does_not_exist'));
			$step = 2;
		}

		if (PRODUCT_TYPE == 'ULTIMATE') {
			$http_exist = db_get_row('SELECT company_id, storefront FROM ?:companies WHERE storefront = ?s', $store_data['storefront']);
			$https_exist = db_get_row('SELECT company_id, secure_storefront FROM ?:companies WHERE secure_storefront = ?s', $store_data['secure_storefront']);
		}

		if (!empty($http_exist) || !empty($https_exist)) {
			$step = 2;

			if (!empty($http_exist)) {
				fn_set_notification('E', fn_get_lang_var('error'), fn_get_lang_var('es_storefront_url_already_exists'));
			} else {
				fn_set_notification('E', fn_get_lang_var('error'), fn_get_lang_var('es_secure_storefront_url_already_exists'));
			}
		}

		if (!Stores_Import_General::testDatabaseConnection($store_data)) {
			fn_set_notification('E', fn_get_lang_var('error'), fn_get_lang_var('es_cannot_connect_to_database_server'));
			$step = 2;
		} elseif (!Stores_Import_General::testTablePrefix($store_data)) {
			fn_set_notification('E', fn_get_lang_var('error'), fn_get_lang_var('es_wrong_table_prefix'));
			$step = 2;
		}
	}
}

if ($step == '3') {
	set_time_limit(0);

	$importer = Stores_Import_General::getImporter($store_data);
	if ($importer !== null) {

		if ($importer->import()) {
			fn_clear_cache();

			if (defined('AJAX_REQUEST')) {
				$ajax->assign('non_ajax_notifications', true);
				$ajax->assign('force_redirection', fn_url('exim_store.index.success'));
			}

			return array(CONTROLLER_STATUS_REDIRECT, 'exim_store.index.success');
		}

	} else {
		fn_set_notification('E', fn_get_lang_var('error'), fn_get_lang_var('es_cannot_import_from_this_version'));
	}
}

Registry::set($_SESSION['auth']['this_login'], Registry::if_get($_SESSION['auth']['this_login'], false) ? 'Y' : 'N');

$view->assign('step', $step);
$view->assign('store_data', $store_data);

$_SESSION['import_store_step'] = $step;
$_SESSION['store_data'] = $store_data;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if (defined('AJAX_REQUEST')) {
		exit;
	}
}
