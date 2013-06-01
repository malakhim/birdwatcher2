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

define('OK_MSG', 'OK');
define('FAIL_MSG', 'FAIL');
define('DB_RECONNECT', '1000');
define('BASE_SKIN', 'basic');
define('DIR_CACHE_TEMPLATES', DIR_ROOT . '/var/cache/templates/');
define('DIR_CACHE_MISC', DIR_ROOT . '/var/cache/misc');
define('CHARSET', 'utf-8');

define('CACHE_LEVEL_TIME', 'time');
define('CACHE_LEVEL_STATIC', 'cache_install');
define('CACHE_LEVEL_DAY', date('z', time()));

set_time_limit(3600);
@ini_set('memory_limit', '64M');

header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
define('DIR_INSTALL', DIR_ROOT . '/install/');
session_start();

$error_msg = $warning_msg = '';
$can_continue = true;

include(DIR_ROOT . '/config.php');

define('DESCR_SL', DEFAULT_LANGUAGE);
define('DEFAULT_LANGUAGE_FILE_CODE', strtolower(DEFAULT_LANGUAGE));

include(DIR_CORE . 'fn.requests.php');
include(DIR_CORE . 'fn.addons.php');
include(DIR_CORE . 'fn.companies.php');
include(DIR_CORE . 'fn.database.php');
include(DIR_CORE . 'fn.fs.php');
include(DIR_CORE . 'fn.cms.php');
include(DIR_CORE . 'fn.common.php');
include(DIR_CORE . 'fn.control.php');
include(DIR_CORE . 'fn.init.php');
include(DIR_CORE . 'fn.users.php');

spl_autoload_register('fn_auto_load_class');

Registry::set('config', $config);

if (defined('CONSOLE')) {
	include(DIR_INSTALL . '/config.install.php');

	$_REQUEST['mode'] = 'requirements';
	$_REQUEST['additional_languages'] = $config['additional_languages'];
	$_REQUEST['demo_catalog'] = $config['demo_catalog'];
	$_REQUEST['new_admin_email'] = $_REQUEST['admin_email'] = $config['admin_email'];
	$_REQUEST['feedback_auto'] = $config['feedback_auto'];
	$_REQUEST['license_number'] = $config['license_number'];
	$_REQUEST['new_skin_name'] = $config['skin_name'];
	$_REQUEST['new_crypt_key'] = $config['crypt_key'];

	$_REQUEST['new_db_host'] = $config['db_host'];
	$_REQUEST['new_db_name'] = $config['db_name'];
	$_REQUEST['new_db_user'] = $config['db_user'];
	$_REQUEST['new_db_password'] = $config['db_password'];
	$_REQUEST['new_db_type'] = $config['db_type'];

	$_REQUEST['new_http_host'] = $config['http_host'];
	$_REQUEST['new_http_dir'] = $config['http_path'];
	$_REQUEST['new_https_host'] = $config['https_host'];
	$_REQUEST['new_https_dir'] = $config['https_path'];
}

						   
$d_type = (empty($_REQUEST['new_db_type']) ? $config['db_type'] : $_REQUEST['new_db_type']);
include(DIR_CORE . 'db/' . $d_type . '.php');

if (empty($_SESSION['sl'])) {
	$_SESSION['sl'] = DEFAULT_LANGUAGE_FILE_CODE;
}

define('CART_LANGUAGE', $_SESSION['sl']);

$descr_sl = empty($_REQUEST['sl']) ? '' : $_REQUEST['sl'];
$installation_languages = fn_get_install_langs('install', $descr_sl);

if (!empty($descr_sl) && !empty($installation_languages[$descr_sl])) {
	$_SESSION['sl'] = $_REQUEST['sl'];
}

if (empty($installation_languages[$_SESSION['sl']])) {
	$_SESSION['sl'] = DEFAULT_LANGUAGE_FILE_CODE;
}

$feedback_auto = !empty($_REQUEST['feedback_auto']) ? $_REQUEST['feedback_auto'] : 'N';

if (empty($_REQUEST['mode'])) {
	$mode = 'license_agreement';
} else {
	if (is_array($_REQUEST['mode'])) {
		$mode = key($_REQUEST['mode']);
	} else {
		$mode = $_REQUEST['mode'];
	}
}

$auth_code = empty($_REQUEST['auth_code']) ? (empty($_SESSION['auth_code']) ? '' : $_SESSION['auth_code']) : $_REQUEST['auth_code'];

if (!empty($auth_code)) {
	$_SESSION['auth_code'] = $auth_code;
}

if ($mode != 'license_agreement' && AUTH_CODE != '' && $auth_code != AUTH_CODE && !defined('CONSOLE')) {
	fn_error_msg(tr('text_auth_code_invalid'), $can_continue, $error_msg);
	$mode = 'license_agreement';
	$next_mode = 'requirements';
	$can_continue = true; // enable "next" button
	return;
} 

if(!empty($_REQUEST['reinstall_mode']) && AUTH_CODE != '' && $auth_code == AUTH_CODE && !defined('CONSOLE')) {
	$mode = $_REQUEST['reinstall_mode'];
}

//reinstall_mode
if ($mode != 'install_db') { // reset parsed files cache
	$_SESSION['parse_sql'] = array();
}

// Show php information
if ($mode == 'phpinfo') {
	phpinfo();
	exit;
}

if ($mode == 'check_license') {
	
	if (db_initiate($config['db_host'], $config['db_user'], $config['db_password'], $config['db_name']) == false) {
		fn_echo(tr('error_database_connect'));
		exit;
	}
	
	$response = Helpdesk::get_license_information($_REQUEST['license'], array('is_install' => true));
	list($license_status) = Helpdesk::parse_license_information($response, array());
	
	$response = array(
		'response_data' => array(
			'license_status' => $license_status,
			'is_ok' => in_array($license_status, array('ACTIVE', 'TRIAL')),
		),
	);
	
	$messages = fn_get_storage_data('hd_messages');
	if (!empty($messages)) {
		$messages = unserialize($messages);
		foreach ($messages as $message_id => $message) {
			$response['notifications'][$message_id] = array(
				'type' => $message['type'],
				'title' => $message['title'],
				'message' => $message['text']
			);
		}
		
		fn_set_storage_data('hd_messages', '');
	}
	
	echo fn_to_json($response);
	exit;
}

// Checking requirements
if ($mode == 'requirements') {

	$next_mode = 'settings';
	$error = false;

	// Checking mysql support
	fn_check_db_support();
	$mysql_error = (IS_MYSQL|IS_MYSQLI) ? false : true;
	$mysql_value = ($mysql_error == false) ? 'ON' : 'OFF';
	$mysql_status = ($mysql_error == false) ? OK_MSG : FAIL_MSG;

	// Checking safe mode
	$safemode_error =  (fn_get_ini_param("safe_mode") == true) ? true : false;
	$safemode_value = ($safemode_error == false) ? 'OFF' : 'ON';
	$safemode_status = ($safemode_error == false) ? OK_MSG : FAIL_MSG;

	// File uploads
	$fileuploads_error = (fn_get_ini_param("file_uploads") == true) ? false : true;
	$fileuploads_value = ($fileuploads_error == false) ? 'ON' : 'OFF';
	$fileuploads_status = ($fileuploads_error == false) ? OK_MSG : FAIL_MSG;

	// Curl support
	$curl_error = (in_array('curl', get_loaded_extensions())) ? false : true;
	$curl_value = ($curl_error == false) ? 'ON' : 'OFF';
	$curl_status = ($curl_error == false) ? OK_MSG : FAIL_MSG;

	// Check for mod_securty enabled
	ob_start();
	phpinfo(INFO_MODULES);
	$_info = ob_get_contents();
	ob_end_clean();

	if (strpos($_info, 'mod_security') !== false) {
		fn_warning_msg(tr('text_mod_security'), $warning_msg);
	}
	
	if ($can_continue == true) {
		$can_continue = !($mysql_error | $safemode_error | $fileuploads_error);
		if ($can_continue == false) {
			fn_error_msg(tr('text_settings_incorrect'), $can_continue, $error_msg);
			if (defined('CONSOLE')) {
				if ($mysql_error) {
					fn_echo(tr('mysql_support') . ': ' . $mysql_value . '. ' . tr('text_mysql_support_notice') . "\n\n");
				}
				if ($safemode_error) {
					fn_echo(tr('safe_mode') . ': ' . $safemode_value . '. ' . tr('text_safe_mode_notice') . "\n\n");
				}
				if ($fileuploads_error) {
					fn_echo(tr('file_uploads') . ': ' . $fileuploads_value . '. ' . tr('text_file_uploads_notice') . "\n\n");
				}
				exit;
			}
		}
	}

	if (defined('CONSOLE')) {
		$mode = 'settings';
	}
}

// Select database/host permissions and check files permissions
if ($mode == 'settings') {

	$next_mode = 'database';

	if ($config['http_host'] == '%HTTP_HOST%') {
		$config['http_host'] = $_SERVER['HTTP_HOST'];
		$_dname = str_replace('\\', '/', dirname($_SERVER['PHP_SELF']));
		$_dname = explode('/', $_dname);
		array_pop($_dname);
		$_dname = implode('/', $_dname);

		$config['http_path'] = ($_dname == '/') ? '' : $_dname;

		$config['https_host'] = $_SERVER['HTTP_HOST'];
		$config['https_path'] = ($_dname == '/') ? '' : $_dname;
		$config['db_host'] = 'localhost';
		$config['db_name'] = 'cart';
		$config['db_user'] = '';
		$config['db_password'] = '';
	}

	if (file_exists(DIR_ROOT . '/config.local.php')) {
		if (!is_writable(DIR_ROOT . '/config.local.php')) {
			fn_error_msg(tr('text_file_not_writable', 'config.local.php'), $can_continue, $error_msg);
		}
	} else {
		fn_error_msg(tr('text_file_not_exists', 'config.local.php'), $can_continue, $error_msg);
	}

	$languages = fn_get_install_langs('database');

	if (!(is_writable(DIR_ROOT . '/images')) ) {
		fn_error_msg(tr('text_directory_not_writable', DIR_ROOT . '/images'), $can_continue, $error_msg);
	}
	if (!(is_writable(DIR_ROOT . '/var')) ) {
		fn_error_msg(tr('text_directory_not_writable', DIR_ROOT . '/var'), $can_continue, $error_msg);
	}
	if (!is_writable(DIR_ROOT . '/skins')) {
		fn_error_msg(tr('text_directory_not_writable', DIR_ROOT . '/skins'), $can_continue, $error_msg);
	}

 
	if (isset($_REQUEST['error'])) {
		if ($_REQUEST['error'] == 'error_database_connect') {
			fn_error_msg(tr('error_database_connect'), $can_continue, $error_msg);
		} elseif ($_REQUEST['error'] == 'error_database_create') {
			fn_error_msg(tr('text_cant_create_database'), $can_continue, $error_msg);
		} elseif ($_REQUEST['error'] == 'empty_email') {
			fn_error_msg(tr('text_incorrect_email'), $can_continue, $error_msg);
		} elseif ($_REQUEST['error'] == 'incorrect_email') {
			fn_error_msg(tr('text_incorrect_email_format'), $can_continue, $error_msg);
		}
		$can_continue = true;
	}

	if (defined('CONSOLE')) {
		if ($can_continue == false) {
			exit;
		}
		$mode = 'database';
	}
}

// Parse config file and installing the database
if ($mode == 'database') {

	$next_mode = 'outlook';

	// Check database connection
	$db_conn = @driver_db_connect($_REQUEST['new_db_host'], $_REQUEST['new_db_user'], $_REQUEST['new_db_password']);
	if (!$db_conn || !empty($db_conn->connect_error)) {
		fn_error_msg(tr('error_database_connect'), $can_continue, $error_msg);
		$err = empty($err) ? 'error_database_connect' : $err;
	} elseif (!@driver_db_select($_REQUEST['new_db_name'])) {
		if (!@driver_db_create($_REQUEST['new_db_name'])) {
			fn_error_msg(tr('text_cant_create_database'), $can_continue, $error_msg);
			$err = empty($err) ? 'error_database_create' : $err;
		}
	}

	// Check if encryption key is not empty
	if (empty($_REQUEST['new_crypt_key'])) {
		fn_error_msg(tr('text_incorrect_secret_key'), $can_continue, $error_msg);
	}

	// Check if encryption key is not empty
	if (empty($_REQUEST['new_admin_email'])) {
		fn_error_msg(tr('text_incorrect_email'), $can_continue, $error_msg);
		$err = empty($err) ? 'empty_email' : $err;
	}

	// Check if encryption key is not empty
	if (!fn_validate_email($_REQUEST['new_admin_email'])) {
		fn_error_msg(tr('text_incorrect_email_format'), $can_continue, $error_msg);
		$err = empty($err) ? 'incorrect_email' : $err;
	}

	if (!empty($err)) {
		$location = 'http://' . str_replace('\\', '/', $_REQUEST['new_http_host']) . str_replace('\\', '/', $_REQUEST['new_http_dir']) . '/install/index.php?mode=settings&error=' . $err;
		fn_redirect($location, true, true);
	}

	// Check files with database structure
	if ($can_continue == true) {
		if (file_exists(DIR_ROOT . '/install/database/scheme.sql')) {
			if (!is_readable(DIR_ROOT . '/install/database/scheme.sql')) {
				fn_error_msg(tr('text_file_not_readable', 'install/database/scheme.sql'), $can_continue, $error_msg);
			}
		} else {
			fn_error_msg(tr('text_file_not_exists', 'install/database/scheme.sql'), $can_continue, $error_msg);
		}
		if (file_exists(DIR_ROOT . '/install/database/data.sql')) {
			if (!is_readable(DIR_ROOT . '/install/database/data.sql')) {
				fn_error_msg(tr('text_file_not_readable', 'install/database/data.sql'), $can_continue, $error_msg);
			}
		} else {
			fn_error_msg(tr('text_file_not_exists', 'install/database/data.sql'), $can_continue, $error_msg);
		}
	}

	$adds = '';

	if (!empty($_REQUEST['demo_catalog']) && $_REQUEST['demo_catalog'] == "Y") {
		$adds = "&demo_catalog=Y";
	}
	if (!empty($_REQUEST['additional_languages']) && is_array($_REQUEST['additional_languages'])) {
		foreach ($_REQUEST['additional_languages'] as $lc) {

			
			$adds .= "&additional_languages[]=$lc";
			
		}
	}

	$adds .= "&admin_email=$_REQUEST[new_admin_email]";
	$adds .= '&feedback_auto=' . $feedback_auto;

	// Parse config file
	if ($can_continue == true) {
		$new_http_host = str_replace('\\', '/', $_REQUEST['new_http_host']);
		$new_https_host = str_replace('\\', '/', $_REQUEST['new_https_host']);
		$new_http_dir = str_replace('\\', '/', $_REQUEST['new_http_dir']);
		$new_https_dir = str_replace('\\', '/', $_REQUEST['new_https_dir']);

		$config_contents = file_get_contents(DIR_ROOT . '/config.local.php');
		if (!empty($config_contents)) {
			if (strstr($config_contents, '$config[\'db_host\'] =')) {
				$config_contents = preg_replace('/^\$config\[\'db_host\'\] =.*;/mi', "\$config['db_host'] = '" . addslashes($_REQUEST['new_db_host']) . "';", $config_contents);
			}
			if (strstr($config_contents, '$config[\'db_name\'] =')) {
				$config_contents = preg_replace('/^\$config\[\'db_name\'\] =.*;/mi', "\$config['db_name'] = '" . addslashes($_REQUEST['new_db_name']) . "';", $config_contents);
			}
			if (strstr($config_contents, '$config[\'db_user\'] =')) {
				$config_contents = preg_replace('/^\$config\[\'db_user\'\] =.*;/mi', "\$config['db_user'] = '" . addslashes($_REQUEST['new_db_user']) . "';", $config_contents);
			}
			if (strstr($config_contents, '$config[\'db_password\'] =')) {
				$config_contents = preg_replace('/^\$config\[\'db_password\'\] =.*;/mi', "\$config['db_password'] = '" . str_replace('$', '\$', addslashes($_REQUEST['new_db_password'])) . "';", $config_contents);
			}
			if (strstr($config_contents, '$config[\'http_host\'] =')) {
				$config_contents = preg_replace('/^\$config\[\'http_host\'\] =.*;/mi', "\$config['http_host'] = '" . $new_http_host . "';", $config_contents);
			}
			if (strstr($config_contents, '$config[\'https_host\'] =')) {
				$config_contents = preg_replace('/^\$config\[\'https_host\'\] =.*;/mi', "\$config['https_host'] = '" . $new_https_host . "';", $config_contents);
			}
			if (strstr($config_contents, '$config[\'http_path\'] =')) {
				$config_contents = preg_replace('/^\$config\[\'http_path\'\] =.*;/mi', "\$config['http_path'] = '" . $new_http_dir . "';", $config_contents);
			}
			if (strstr($config_contents, '$config[\'https_path\'] =')) {
				$config_contents = preg_replace('/^\$config\[\'https_path\'\] =.*;/mi', "\$config['https_path'] = '" . $new_https_dir . "';", $config_contents);
			}
			if (strstr($config_contents, '$config[\'db_type\'] =')) {
				$config_contents = preg_replace('/^\$config\[\'db_type\'\] =.*;/mi', "\$config['db_type'] = '" . $_REQUEST['new_db_type'] . "';", $config_contents);
			}
			if (strstr($config_contents, '$config[\'crypt_key\'] =')) {
				$config_contents = preg_replace('/^\$config\[\'crypt_key\'\] =.*;/mi', "\$config['crypt_key'] = '" . str_replace('$', '\$', addslashes($_REQUEST['new_crypt_key'])) . "';", $config_contents);
			}

			if (fn_put_contents(DIR_ROOT . '/config.local.php', $config_contents) == 0) {
				fn_error_msg(tr('text_file_not_writable', 'config.local.php'), $can_continue, $error_msg);
			}
		} else {
			fn_error_msg(tr('text_file_not_readable', 'config.local.php'), $can_continue, $error_msg);
		}
	}

	if (defined('CONSOLE')) {
		if ($can_continue == false) {
			exit;
		}
		$mode = 'install_db';
	}
}


// Install database data
if ($mode == 'install_db') {

	if (db_initiate($config['db_host'], $config['db_user'], $config['db_password'], $config['db_name']) == false) {
		fn_echo(tr('error_database_connect'));
		exit;
	}

	fn_start_scroller_i();


	if (empty($_REQUEST['no_checking']) && !defined('CONSOLE')) {
		$_SESSION['langs'] = array();
		$tables_exist = db_get_array("SHOW TABLES LIKE '" . TABLE_PREFIX . "%'");
		if (!empty($tables_exist)) {

			$al = '';
			if (!empty($_REQUEST['additional_languages'])) {
				$al = 'additional_languages[]=' . implode('&additional_languages[]=', $_REQUEST['additional_languages']);
			}
			$_txt = addslashes(tr('text_db_has_tables'));
			$demo_catalog = isset($_REQUEST['demo_catalog']) ? ('&demo_catalog=' . $_REQUEST['demo_catalog']) : '';
			$admin_email = isset($_REQUEST['admin_email']) ? ('&admin_email=' . $_REQUEST['admin_email']) : '';
			echo <<<EOT
				<script language='javascript'>
				if (confirm('$_txt')) {
					location.replace("index.php?mode=install_db&no_checking=1$demo_catalog$admin_email&feedback_auto=$feedback_auto&$al");
				} else {
					history.go(-1);
				}
				</script>
EOT;
			exit;
		}
	}

	fn_parse_sql(DIR_INSTALL . 'database/scheme.sql', tr('creating_scheme'));
	fn_parse_sql(DIR_INSTALL . 'database/data.sql', tr('importing_data'));

	if (!empty($_REQUEST['demo_catalog']) && $_REQUEST['demo_catalog'] == 'Y') {
		fn_parse_sql(DIR_INSTALL . 'database/demo.sql', tr('text_creating_demo_catalog'));
		$_SESSION['demo_catalog'] = 'Y';
	} else {
		$_SESSION['demo_catalog'] = 'N';
	}

	if (!empty($_REQUEST['additional_languages']) && is_array($_REQUEST['additional_languages'])) {
		$db_descr_tables = fn_get_description_tables();
		foreach ($_REQUEST['additional_languages'] as $lc) {
			$_lc = strtoupper($lc); // FIXME!!! Don't like this line :)
			if (empty($_SESSION['langs'][$lc])) {
				fn_clone_language($_lc);

				$_SESSION['langs'][$lc] = true;
			}

			fn_parse_sql(DIR_INSTALL . "database/lang_{$lc}.sql", tr('text_installing_additional_language', $_lc));

		}
		

	}

	// Insert root admin
	$user_data = array(
		'user_id' => 1,
		'status' => 'A',
		'user_type' => 'A',
		'is_root' => 'Y',
		'password' => md5('admin'),
		'email' => $_REQUEST['admin_email'],
		'user_login' => 'admin',
		'title' => 'mr',
		'firstname' => 'Admin',
		'lastname' => 'Admin',
		'company' => 'Your company',
		'phone' => '55 55 555 5555',
		'lang_code' => DEFAULT_LANGUAGE,
	);
	$profile = array(
		'title' => 'mr',
		'firstname' => 'John',
		'lastname' => 'Doe',
		'address' => '44 Main street',
		'address_2' => 'test',
		'city' => 'Boston',
		'county' => '',
		'state' => 'MA',
		'country' => 'US',
		'zipcode' => '02134',
		'phone' => '',
	);
	foreach ($profile as $k => $v) {
		$user_data['b_' . $k] = $v;
		$user_data['s_' . $k] = $v;
	}
	db_query("INSERT INTO ?:users ?e", $user_data);
	fn_update_user_profile(1, $user_data, 'add');

	// Update root admin email
	//db_query("UPDATE ?:users SET email = ?s WHERE user_id = 1", $_REQUEST['admin_email']);

	// Update send feedback setting
	if ($feedback_auto == 'Y') {
		db_query("UPDATE ?:settings_objects SET value = ?s WHERE name = ?s", 'auto', 'feedback_type');
	}

	// Update company emails
	$company_emails = array (
		'company_users_department',
		'company_site_administrator',
		'company_orders_department',
		'company_support_department',
		'company_newsletter_email',
	);                    
	db_query("UPDATE ?:settings_objects SET value = ?s WHERE name IN (?a)", $_REQUEST['admin_email'], $company_emails);
 
	// Update forms emails
	// db_query("UPDATE ?:form_options SET value = ?s WHERE element_type = 'J'", $_REQUEST['admin_email']);

	// Update users timestamps
	db_query("UPDATE ?:users SET `last_login` = 0, `timestamp` = ?i", TIME);
    
	if (empty($_REQUEST['demo_catalog']) || !empty($_REQUEST['demo_catalog']) && $_REQUEST['demo_catalog'] != 'Y') {
		db_query("UPDATE ?:companies SET categories = ''");
	}

	if (PRODUCT_TYPE == 'ULTIMATE') {
		$url = $config['http_host'] . $config['http_path'];
		$secure_url = $config['https_host'] . $config['https_path'];
		fn_set_demostore_url($url, $secure_url, 1);

		if (!empty($_REQUEST['demo_catalog']) && $_REQUEST['demo_catalog'] == 'Y') {
			fn_set_demostore_url($url . '/acme', $secure_url . '/acme', 2);
			fn_install_demostore();
		}

		if (isset($_SESSION['demo_catalog']) && $_SESSION['demo_catalog'] == 'Y') {
			// initiate languages list
			$languages = db_get_hash_array("SELECT * FROM ?:languages", 'lang_code');
			Registry::set('languages', $languages);

			$structure = Bm_Exim::instance(1)->export(array(), array(), CART_LANGUAGE);
			$structure = @simplexml_load_string($structure, 'ExSimpleXmlElement', LIBXML_NOCDATA);
			$result = Bm_Exim::instance(2)->import($structure);
		}
	}

	fn_stop_scroller_i();
	if (defined('CONSOLE')) {
		$mode = 'skins';
	} else {
		fn_echo(tr('text_database_installed'));
		exit;
	}
}

if ($mode == 'license_agreement') {

	$next_mode = 'requirements';
}

// Select skin to install
if ($mode == 'outlook') {

	$next_mode = 'skins';

	$skins = fn_get_dir_contents(DIR_INSTALL_SKINS, true);
	sort($skins);
	$skinset = array();
	$first_iteration = true;
	foreach ($skins as $v) {
		if (is_dir(DIR_INSTALL_SKINS . '/' . $v)) {
			$skinset[$v] = @parse_ini_file(DIR_INSTALL_SKINS . '/' . $v . '/' . SKIN_MANIFEST);
		}
	}         
}

// Install skin
if ($mode == 'skins') {

	$next_mode = 'install_addons';

	$new_skin_name = fn_basename($_REQUEST['new_skin_name']);

	if (empty($new_skin_name)) {
		fn_error_msg(tr('text_select_skin'), $can_continue, $error_msg);
	}

	if (defined('CONSOLE')) {
		$mode = 'install_skin';
	}
}


// Install skin
if ($mode == 'install_skin') {

	if (db_initiate($config['db_host'], $config['db_user'], $config['db_password'], $config['db_name']) == false) {
		fn_echo(tr('error_database_connect'));
		exit;
	}

	fn_start_scroller_i();

	fn_install_skin($_REQUEST['new_skin_name']);

	fn_clear_cache();

	fn_stop_scroller_i();

	if (defined('CONSOLE')) {
		$mode = 'install_addons';
	} else {
		fn_echo(tr('text_skin_installed'));
		exit;
	}
} 

// Install addons

if ($mode == 'select_addons') {
	$addons = fn_get_addons();

	$next_mode = 'install_addons'; // silent installation

	if (defined('CONSOLE')) {
		$mode = 'install_addons';
	}

}

// Install addon
if ($mode == 'install_addons') {

	if (db_initiate($config['db_host'], $config['db_user'], $config['db_password'], $config['db_name']) == false) {
		fn_echo(tr('error_database_connect'));
		exit;
	}

	// initiate languages list
	$languages = db_get_hash_array("SELECT * FROM ?:languages", 'lang_code');
	Registry::set('languages', $languages);
	Registry::set('customer_skin_path', DIR_INSTALL_SKINS . '/' . BASE_SKIN);
	
	$install_log = '';
	if (isset($_REQUEST['install_addons'])) {
		$addons = $_REQUEST['install_addons'];
	} else {
		$_addons = fn_get_addons();
		foreach($_addons as $k => $addon) {
			if($addon['checked']) {
				$addons[$addon['name']] = $k;
			}
		}
	}
	$install_demo = (isset($_SESSION['demo_catalog']) && $_SESSION['demo_catalog'] == 'Y') ? true : false;
	foreach($addons as $addon_name=>$addon){
		if(fn_install_addon($addon, false, $install_demo) ){
			$install_log .= $addon_name . tr('addon_installed') . '<br/>';
		}
		// Clear error log
		Registry::set('runtime.database.errors', '');
	}

	$mode = 'license';

	if (defined('CONSOLE')) {
		$mode = 'summary';
	} else {
		$install_log .= tr('text_addons_installed');
	}
} 

// Summary page
if ($mode == 'register_license') {

	if (db_initiate($config['db_host'], $config['db_user'], $config['db_password'], $config['db_name']) == false) {
		fn_echo(tr('error_database_connect'));
		exit;
	}
	
	Helpdesk::register_license($_REQUEST);
	
	$messages = fn_get_storage_data('hd_messages');
	if (!empty($messages)) {
		$messages = unserialize($messages);
		foreach ($messages as $message_id => $message) {
			fn_warning_msg($message['text'], $warning_msg);
		}
		
		fn_set_storage_data('hd_messages', '');
	}
	
	$mode = 'license';
}

if ($mode == 'license') {
	$next_mode = 'summary';
	
	if (defined('CONSOLE')) {
		$mode = 'summary';
	} else {
		if (isset($_SESSION['license_number'])) {
			$license_number = $_SESSION['license_number'];
		} else {
			$license_number = '';
		}
		
		$messages = fn_get_storage_data('hd_messages');
		if (!empty($messages)) {
			$messages = unserialize($messages);
			foreach ($messages as $message_id => $message) {
				fn_warning_msg($message['text'], $warning_msg);
			}
			
			fn_set_storage_data('hd_messages', '');
		}
	}
}
 
// Summary page
if ($mode == 'summary') {

	if (db_initiate($config['db_host'], $config['db_user'], $config['db_password'], $config['db_name']) == false) {
		fn_echo(tr('error_database_connect'));
		exit;
	}
	
	// Set store optimization mode to "live"
	db_query("UPDATE ?:settings_objects SET value = ?s WHERE name = ?s", 'live', 'store_optimization');

	// Save License number if exists
	if (!empty($_REQUEST['cart_license'])) {
		// Update license number
		db_query("UPDATE ?:settings_objects SET value = ?s WHERE name = 'license_number'", $_REQUEST['cart_license']);
	}
	
	$admin_email = db_get_field("SELECT email FROM ?:users WHERE user_login='admin'");

	// Update AUTH cart code
	$config_contents = file_get_contents(DIR_ROOT . '/config.local.php');

	$acode = (AUTH_CODE == '') ? fn_generate_auth_code() : AUTH_CODE;

	$config_contents = preg_replace("/define\('AUTH_CODE',.*\);/i", "define('AUTH_CODE', '$acode');", $config_contents);
	if (fn_put_contents(DIR_ROOT . '/config.local.php', $config_contents) == 0) {
		fn_error_msg(tr('text_file_not_writable', 'config.local.php'), $can_continue, $error_msg);
	}

	if (defined('CONSOLE')) {
		if ($can_continue == true) {
			echo tr(
				'text_summary_notice',
				$acode,
				"http://$config[http_host]$config[http_path]/$config[customer_index]",
				"http://$config[http_host]$config[http_path]/$config[customer_index]",
				"http://$config[http_host]$config[http_path]/$config[admin_index]",
				"http://$config[http_host]$config[http_path]/$config[admin_index]"
			);
		}
	}
}

if (defined('CONSOLE')) {
	exit;
}


// ------------------------ functions definitions --------------------------------

function fn_error_msg($msg, &$can_continue, &$error_msg)
{
	$can_continue = false;
	if (defined('CONSOLE')) {
		echo strip_tags($msg) . "\n\n";
	}

	$error_msg = (!empty($error_msg)) ? $error_msg . "<br /><br />" . $msg : $msg;
}

function fn_warning_msg($msg, &$warning_msg)
{
	if (defined('CONSOLE')) {
		echo strip_tags($msg) . "\n\n";
	}

	$warning_msg = (!empty($warning_msg)) ? $warning_msg . "<br /><br />" . $msg : $msg;
}

function fn_parse_sql($filename, $title)
{
	$title_shown = false;

	$fd = fopen($filename, 'r');
	if ($fd) {
		$_sess_name = fn_basename($filename);
		if (!empty($_SESSION['parse_sql'][$_sess_name])) {
			if ($_SESSION['parse_sql'][$_sess_name] == 'COMPLETED') {
				fclose($fd);
				return true;
			}
			fseek($fd, $_SESSION['parse_sql'][$_sess_name]);
		}

		$rest = '';
		$ret = array();
		$counter = 0;
		while (!feof($fd)) {
			$str = $rest.fread($fd, 16384);
			$rest = fn_parse_queries($ret, $str);

			if (!empty($ret)) {
				if ($title_shown == false) {
					fn_echo($title);
					$title_shown = true;
				}

				foreach ($ret as $query) {
					$counter ++;
					if (strpos($query, 'CREATE TABLE')!==false) {
						preg_match("/" . TABLE_PREFIX . "\w*/i", $query, $matches);
						$table_name = $matches[0];
						if (!defined('CONSOLE')) {
							fn_echo(tr('text_creating_table', $table_name));
						}

					} else {
						if ($counter > 30 && !defined('CONSOLE')) {
							fn_echo(' .');
							$counter = 0;
						}
					}
					db_query($query);

				}
				$ret = array();
			}

			// Break the connection and re-request
			if (time() - TIME > INSTALL_DB_EXECUTION && !defined('CONSOLE')) {
				$pos = ftell($fd);
				$pos = $pos - strlen($rest);
				fclose($fd);
				$_SESSION['parse_sql'][$_sess_name] = $pos;
				$location = $_SERVER['REQUEST_URI'] . '&no_checking=1';
				fn_echo("<meta http-equiv=\"Refresh\" content=\"0;URL=$location\" />");
				die;
			}
		}
		fclose($fd);
		$_SESSION['parse_sql'][$_sess_name] = 'COMPLETED';
		return true;
	}
}

// Start javascript autoscroller
function fn_start_scroller_i()
{
	if (defined('CONSOLE')) {
		return false;
	}
	fn_echo("
		<script language='javascript'>
		parent.document.getElementById('nextbut').disabled = true;
		var button = parent.document.getElementById('next-button-wrap');
		if (!button.className.match(/\bbtn-disabled\b/)){
			button.className += ' btn-disabled';
		}
		loaded = false;
		function refresh() {
			window.scroll(0, 99999);
			if (loaded == false) {
				setTimeout('refresh()', 1000);
			}
		}
		setTimeout('refresh()', 1000);
		</script>
	");
}

// Stop javascript autoscroller
function fn_stop_scroller_i()
{
	if (defined('CONSOLE')) {
		return false;
	}
	fn_echo("
	<script language='javascript'>
		loaded = true;
		parent.document.getElementById('nextbut').disabled = false;
		parent.document.getElementById('next-button-wrap').className = parent.document.getElementById('next-button-wrap').className.replace(/\bbtn-disabled\b/,'');
	</script>
	");
}

function fn_generate_auth_code()
{
	return strtoupper(substr(base64_encode(uniqid(time())), -9, 8));
}

function fn_check_db_support()
{
	$exts  = get_loaded_extensions();
	define('IS_MYSQL', in_array('mysql', $exts));
	define('IS_MYSQLI', in_array('mysqli', $exts));
}

function fn_install_skin_zones($skin_name, $zones, $destination, $silent, $die_on_error = true)
{
	foreach ((array) $zones as $zone) {

		fn_echo(tr('text_installing_' . $zone . '_base_templates'));
		$from = DIR_INSTALL_SKINS . '/' . BASE_SKIN . '/' . $zone;
		if (!fn_copy($from, $destination . '/' . $zone, $silent)) {
			fn_echo(tr('text_copy_error', $from));
			if ($die_on_error) {
				die();
			}
		}

		if ($skin_name != BASE_SKIN) {
			$from = DIR_INSTALL_SKINS . '/' . $skin_name . '/' . $zone;
			if (is_dir($from)) {
				fn_echo(tr('text_installing_scheme'));
				if (!fn_copy($from, $destination . '/' . $zone, $silent)) {
					fn_echo(tr('text_copy_error', $from));
					if ($die_on_error) {
						die();
					}
				}
			}
		}
		
		fn_copy(DIR_INSTALL_SKINS . '/' . $skin_name . '/manifest.ini', $destination . '/manifest.ini', false);
	}
}

function fn_install_skin($skin_name)
{
	$silent = defined('CONSOLE');
	if (!file_exists(DIR_INSTALL_SKINS . '/' . $skin_name . '/' . SKIN_MANIFEST)) {
		die(tr('text_manifest_not_found', DIR_INSTALL_SKINS . '/' . $skin_name));
	}

	$skin_data = parse_ini_file(DIR_INSTALL_SKINS . '/' . $skin_name . '/' . SKIN_MANIFEST);

	CSettings::instance()->update_value('skin_name_customer', $skin_name);
	
	$zones = array ('customer', 'mail');

	$admin_skin = (!empty($skin_data['admin']) && $skin_data['admin'] == 'Y') ? $skin_name : BASE_SKIN;



		fn_install_skin_zones($skin_name, $zones, DIR_SKINS . $skin_name, $silent);



	CSettings::instance()->update_value('skin_name_admin', $admin_skin);

	fn_install_skin_zones($admin_skin, 'admin', DIR_SKINS . $admin_skin, $silent);

}

function tr()
{
	static $texts = array();

	$args = func_get_args();
	$text = array_shift($args);

	if (empty($texts)) {
		$lang_ini_file = DIR_INSTALL . 'lang/' . $_SESSION['sl'] . '.ini';
		if (!is_file($lang_ini_file)) {
			$lang_ini_file = DIR_INSTALL . 'lang/' . DEFAULT_LANGUAGE_FILE_CODE . '.ini';
		}
		$texts = parse_ini_file($lang_ini_file);
		
	}

	$_t = $text;

	$text = htmlspecialchars_decode($texts[$text]);

	if (!empty($args)) {
		if (preg_match_all("/(\[\?\])+/", $text, $m)) {
			$offset = 0;
			foreach ($m[0] as $k => $ph) {
				$text = tr_str_replace($ph, $args[$k], $text, $offset);
			}
		}
	}

	if (defined('CONSOLE')) {
		$new_text = strip_tags($text);
		$br = '<br />';
		if (substr($new_text, -1) == ':') {
			$new_text = substr_replace($new_text, '...', -1);
		}

		if (substr($text, -strlen($br)) == $br) {
			$new_text .= "\n";
		}
		$text = $new_text;
	}

	return $text;
}

function tr_str_replace($needle, $replacement, $subject, &$offset)
{
	$pos = strpos($subject, $needle, $offset);

	$offset = $pos + strlen($replacement);
	return substr_replace($subject, $replacement, $pos, 3);
}

function fn_get_install_langs($type = 'install', $lang = DEFAULT_LANGUAGE_FILE_CODE)
{
	$languages = array();

	if ($type == 'install') {
		$files = fn_get_dir_contents(DIR_INSTALL . 'lang', false, true);
		if (!empty($lang) && in_array($lang . '.ini', $files)) {
			$_SESSION['sl'] = $lang;
		}
		
		if (!empty($files)) {
			foreach ($files as $file) {
				$lang = str_replace('.ini', '', $file);
				$languages[$lang] = tr('lang_' . $lang);
			}
		}
	} else {
		$files = fn_get_dir_contents(DIR_INSTALL . 'database', false, true);
		if (!empty($files)) {
			foreach ($files as $file) {
				if (strpos($file, 'lang_') !== false) {
					$lang = str_replace(array('lang_', '.sql'), '', $file);
					if ($lang  != DEFAULT_LANGUAGE_FILE_CODE) {
						$languages[$lang] = tr('lang_' . $lang);
					}
				}
			}
		}
	}

	asort($languages);
	return $languages;
}

function fn_print()
{
	static $count = 0;
	$args = func_get_args();

	if (!empty($args)) {
		echo "<div align='left' style='font-family: Courier; font-size: 13px;'><pre>";
		foreach ($args as $k => $v) {
			echo "<strong>Debug [$k/$count]:</strong>";
			echo htmlspecialchars(print_r($v, true) . "\n");
		}
		echo "</pre></div>";
	}
	$count++;
}

// Plug to logger
function fn_log_event()
{
	return true;
}

function fn_get_addons() {
	$addons = fn_get_dir_contents(DIR_ADDONS, true, false);

	foreach($addons as $addon) {
		$scheme = Addons_SchemesManager::get_scheme($addon);
		if (!empty($scheme)) {			
			$addons_list[$addon] = array (
				'name' => $scheme->get_name(),
				'description' =>  $scheme->get_description(),
				'filename' => $addon
			);
			$auto_install = $scheme->auto_install_for();
			if (in_array(PRODUCT_TYPE, $auto_install)) {
				$addons_list[$addon]['checked'] = true;
			} else {
				$addons_list[$addon]['checked'] = false;
			}
		} 
	}

	return $addons_list;
}

function fn_install_demostore(){
	global $config;

	$htaccess = file_get_contents(DIR_ROOT . '/acme/.htaccess');
	if ($htaccess !== false) {
		$htaccess = str_replace('{WEB_PATH_TO_YOUR_STORE}', $config['http_path'], $htaccess);
		$htaccess = str_replace('%{SCRIPT_FILENAME}', DIR_ROOT . '/acme', $htaccess);

		if (is_writable(DIR_ROOT . '/acme/.htaccess')) {
			if (!$handle = fopen(DIR_ROOT . '/acme/.htaccess', 'w')) {
				 exit;
			}

			if (fwrite($handle, $htaccess) === FALSE) {
				exit;
			}

			fclose($handle);

		}
	}
}

/**
 * Sets compny urls
 *
 * @param string $url store url
 * @param string $secure_url secure store url
 * @param int $company_id company identifier
 * @return bool Always true
 */
function fn_set_demostore_url($url, $secure_url, $company_id)
{
	$company_data= array (
		'storefront' => fn_clean_url($url),
		'secure_storefront' => fn_clean_url($secure_url)
	);
	db_query('UPDATE ?:companies SET ?u WHERE company_id = ?i', $company_data, $company_id);

	return true;
}
?>
