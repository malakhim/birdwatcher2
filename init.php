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

// Require configuration
require(DIR_ROOT . '/config.php');

if (isset($_REQUEST['version'])) {
	die(PRODUCT_NAME . ': version <b>' . PRODUCT_VERSION . ' ' . PRODUCT_TYPE . (PRODUCT_STATUS != '' ? (' (' . PRODUCT_STATUS . ')') : '') . (PRODUCT_BUILD != '' ? (' ' . PRODUCT_BUILD) : '') . '</b>');
}

if (isset($_REQUEST['check_https'])) {
	die(defined('HTTPS') ? 'OK' : '');
}

define('CHARSET', 'utf-8');

// Include core functions/classes
require(DIR_CORE . 'db/' . $config['db_type'] . '.php');
require(DIR_CORE . 'fn.database.php');
require(DIR_CORE . 'fn.users.php');
require(DIR_CORE . 'fn.catalog.php');
require(DIR_CORE . 'fn.cms.php');
require(DIR_CORE . 'fn.cart.php');
require(DIR_CORE . 'fn.locations.php');
require(DIR_CORE . 'fn.common.php');
require(DIR_CORE . 'fn.fs.php');
require(DIR_CORE . 'fn.requests.php');
require(DIR_CORE . 'fn.images.php');
require(DIR_CORE . 'fn.init.php');
require(DIR_CORE . 'fn.control.php');
require(DIR_CORE . 'fn.search.php');
require(DIR_CORE . 'fn.promotions.php');
require(DIR_CORE . 'fn.log.php');
require(DIR_CORE . 'fn.companies.php');
require(DIR_CORE . 'fn.addons.php'); 

if (in_array(PRODUCT_TYPE, array('PROFESSIONAL', 'MULTIVENDOR', 'ULTIMATE'))) {
    require(DIR_CORE . 'editions/fn.pro_functions.php');
}
if (in_array(PRODUCT_TYPE, array('MULTIVENDOR', 'ULTIMATE'))) {
    require(DIR_CORE . 'editions/fn.mve_functions.php');
}
if (PRODUCT_TYPE == 'ULTIMATE') {
    require(DIR_CORE . 'editions/fn.ult_functions.php');
}

require(DIR_LIB . 'smarty/Smarty.class.php');
require(DIR_LIB . 'smarty/Smarty_Compiler.class.php');

fn_define('SMARTY_CUSTOM_PLUGINS', DIR_CORE . 'smarty_plugins');
fn_define('SMARTY_CUSTOM_CLASS', DIR_CORE . '/classes/smarty_engine/core.php');

spl_autoload_register('fn_auto_load_class');

fn_define('AREA_NAME', 'customer');
fn_define('ACCOUNT_TYPE', 'customer');

// Used for the javascript to be able to hide the Loading box when a downloadable file (pdf, etc.) is ready  
//setcookie('page_unload', 'N', '0', !empty($config['current_path'])? $config['current_path'] : '/');

// Set configuration options from config.php to registry
Registry::set('config', $config);
unset($config);

// Check if software is installed
if (Registry::get('config.db_host') == '%DB_HOST%') {
	die(PRODUCT_NAME . ' is <b>not installed</b>. Please click here to start the installation process: <a href="install/">[install]</a>');
}

// Connect to database
$db_conn = db_initiate(Registry::get('config.db_host'), Registry::get('config.db_user'), Registry::get('config.db_password'), Registry::get('config.db_name'));

if (!$db_conn) {
	fn_error(debug_backtrace(), 'Cannot connect to the database server', false);
}

if (defined('MYSQL5')) {
	db_query("set @@sql_mode = ''");
}

register_shutdown_function(array('Registry', 'save'));

// define lifetime for the cache data
date_default_timezone_set('UTC'); // setting temporary timezone to avoid php warnings

fn_init_stack(
	array('fn_init_cache_level', array('time', 'static', 'day')),
	array('fn_init_ua'),
	array('fn_init_ajax'),

	array('fn_init_sess_name'),
	array('fn_init_session'),
	array('fn_init_selected_company_id', &$_REQUEST),
	array('fn_init_dirs_variables'),
	array('fn_check_cache', $_REQUEST),
	array('fn_init_settings'),
	array('fn_init_addons'),
	array('fn_get_route'),
	
	array('fn_init_localization', &$_REQUEST),
	
	array('fn_init_language', &$_REQUEST),
	array('fn_init_currency', &$_REQUEST),
	array('fn_init_cache_level', array('locale', 'dispatch')),
	array('fn_init_company', $_REQUEST),
	array('fn_init_addon_options'),
	array('fn_init_full_path', $_REQUEST),
	array('fn_init_skin', &$_REQUEST),
	array('fn_init_templater'),
	array('fn_init_company_description'),
	array('fn_close_notifications', &$_REQUEST),
	array('fn_init_user'),
	array('fn_init_cache_level', array('user', 'locale_auth')),
	array('fn_set_templater_params'),
	array('fn_init_search')
);

// Run INIT
fn_init($_REQUEST);

?>