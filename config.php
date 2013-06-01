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

/*
 * Static options
 */

// These constants define when select box with categories list should be replaced with picker
define('CATEGORY_THRESHOLD', 100); // if number of categories less than this value, all categories will be retrieved, otherwise subcategories will be retrieved by ajax
define('CATEGORY_SHOW_ALL', 100);  // if number of categories less than this value, categories tree will be expanded

// These constants define when select box with pages list should be replaced with picker
define('PAGE_THRESHOLD', 40); // if number of pages less than this value, all pages will be retrieved, otherwise subpages will be retrieved by ajax
define('PAGE_SHOW_ALL', 100); // if number of pages less than this value, pages tree will be expanded

// These constants define when select box with product feature variants list should be replaced with picker
define('PRODUCT_FEATURE_VARIANTS_THRESHOLD', 40); // if number of product feature variants less than this value, all product feature variants will be retrieved, otherwise product features variants will be retrieved by ajax

// Maximum number of recently viewed products, stored in session
define('MAX_RECENTLY_VIEWED', 10);

// Filesystem paths
define('DIR_CORE', DIR_ROOT . '/core/');
define('DIR_LIB', DIR_ROOT . '/lib/');
define('DIR_ADDONS', DIR_ROOT . '/addons/');
define('DIR_SKINS',  DIR_ROOT . '/skins/');
define('DIR_PAYMENT_FILES', DIR_ROOT . '/payments/');
define('DIR_SHIPPING_FILES', DIR_ROOT . '/shippings/');
define('DIR_SCHEMAS', DIR_ROOT . '/schemas/');
define('DIR_IMAGES', DIR_ROOT . '/images/');
define('DIR_THUMBNAILS', DIR_IMAGES . 'thumbnails/');
define('DIR_STORES', 'stores/');

// var dirs
/*
define('DIR_DATABASE', DIR_ROOT . '/var/database/');
define('DIR_DOWNLOADS', DIR_ROOT . '/var/downloads/');
define('DIR_UPGRADE', DIR_ROOT . '/var/upgrade/');
define('DIR_EXIM', DIR_ROOT . '/var/exim/');
*/
define('DIR_CACHE_REGISTRY', DIR_ROOT . '/var/cache/registry/');
define('DIR_SKINS_REPOSITORY', DIR_ROOT . '/var/skins_repository/');
define('DIR_CUSTOM_FILES', DIR_ROOT . '/var/custom_files/');

// Default cart language
define('DEFAULT_LANGUAGE', 'EN');

// Week days
define('SUNDAY',    0);
define('MONDAY',    1);
define('TUESDAY',   2);
define('WEDNESDAY', 3);
define('THURSDAY',  4);
define('FRIDAY',    5);
define('SATURDAY',  6);

// statuses definitions
define('STATUSES_ORDER', 'O');
define('STATUS_INCOMPLETED_ORDER', 'N');
define('STATUS_PARENT_ORDER', 'T');

//Login statuses
define('LOGIN_STATUS_USER_NOT_FOUND', '0');
define('LOGIN_STATUS_OK', '1');
define('LOGIN_STATUS_USER_DISABLED', '2');

// usergroup definitions
define('ALLOW_USERGROUP_ID_FROM', 3);
define('ALL_USERGROUPS', -1);
define('USERGROUP_ALL', 0);
define('USERGROUP_GUEST', 1);
define('USERGROUP_REGISTERED', 2);

// Authentication settings
define('USER_PASSWORD_LENGTH', '8');

// SEF urls delimiter
define('SEO_DELIMITER', '-');

// Number of seconds in one hour (for different calculations)
define('SECONDS_IN_HOUR', 60 * 60); // one hour

// Number of seconds in one day (for different calculations)
define('SECONDS_IN_DAY', SECONDS_IN_HOUR * 24); // one day

// Live time for permanent cookies (currency, language, etc...)
define('COOKIE_ALIVE_TIME', SECONDS_IN_DAY * 7); // one week

// Session live time
define('SESSION_ALIVE_TIME', SECONDS_IN_HOUR * 2); // 2 hours

// Sessions storage live time
define('SESSIONS_STORAGE_ALIVE_TIME',  SECONDS_IN_DAY * 7 * 2); // 2 weeks

// Number of seconds after last session update, while user considered as online
define('SESSION_ONLINE', 60 * 5); // 5 minutes

// Number of seconds before installation script will be redirected to itself to avoid server timeouts
define('INSTALL_DB_EXECUTION', SECONDS_IN_HOUR); // 1 hour

// Uncomment this line if you experience problems with mysql5 server (disables strict mode)
//define('MYSQL5', true);

// Uncomment to enable code profiles
// define('PROFILER', true);
// define('PROFILER_SQL', true);
// define('PROFILER_FOR_ADMIN', true);

// Skin description file name
define('SKIN_MANIFEST', 'manifest.ini');

// Controller return statuses
define('CONTROLLER_STATUS_REDIRECT', 302);
define('CONTROLLER_STATUS_OK', 200);
define('CONTROLLER_STATUS_NO_PAGE', 404);
define('CONTROLLER_STATUS_DENIED', 403);
define('CONTROLLER_STATUS_DEMO', 401);

define('INIT_STATUS_FAIL', 0);
define('INIT_STATUS_OK', 1);
define('INIT_STATUS_REDIRECT', 2);
define('INIT_STATUS_NO_PAGE', 3);

// Maximum number of items in "Last edited items" list (administrative area)
define('LAST_EDITED_ITEMS_COUNT', 10);

// Meta description auto generation
define('AUTO_META_DESCRIPTION', true);

// Debug mode (displays report a bug button)
// define('DEBUG_MODE', true);

// Database default tables prefix
define('DEFAULT_TABLE_PREFIX', 'cscart_');

// Product information
define('PRODUCT_NAME', 'CS-Cart');
define('PRODUCT_VERSION', '3.0.6');
define('PRODUCT_STATUS', '');
define('PRODUCT_BUILD', '');

// COMMUNITY|PROFESSIONAL|MULTIVENDOR|ULTIMATE
define('PRODUCT_TYPE', 'MULTIVENDOR');


if (!defined('ACCOUNT_TYPE')) {
    define('ACCOUNT_TYPE', 'customer');
}

//Popularity rating
define('POPULARITY_VIEW', 3);
define('POPULARITY_ADD_TO_CART', 5);
define('POPULARITY_DELETE_FROM_CART', 5);
define('POPULARITY_BUY', 10);

// The number of seconds after which the execution of query is considered to be long
define('LONG_QUERY_TIME', 3);

define('SHIPMENTS_PER_PAGE', 10);

define('MAX_LAST_VIEW_ITEMS', 100);

// Session options
// define('SESS_VALIDATE_IP', true); // link session ID with ip address
define('SESS_VALIDATE_UA', true); // link session ID with user-agent

/*
 * Dynamic options
 */
$config = array();

// List of forbidden file extensions (for uploaded files)
$config['forbidden_file_extensions'] = array (
    'php',
    'php3',
    'pl',
    'com',
    'exe',
    'bat',
    'cgi',
    'htaccess'
);

$config['forbidden_mime_types'] = array (
    'text/x-php',
    'application/octet-stream',
    'text/x-perl',
    'text/x-python',
    'text/x-shellscript'
);

// Locations that can be viewed via secure connection (customer area)
$config['secure_controllers'] = array (
    'checkout',
    'payment_notification',
    'auth',
    'profiles',
    'image_verification',
    'orders',
    'pages'
);

$config['updates_server'] = 'http://updates.cs-cart.com';

// Get local configuration
require(DIR_ROOT . '/config.local.php');

// Define host depending on the current connection
$config['current_host'] = (defined('HTTPS')) ? $config['https_host'] : $config['http_host'];

// Define host directory depending on the current connection
$config['current_path'] = (defined('HTTPS')) ? $config['https_path'] : $config['http_path'];

// Directory for store images on file system
$config['images_path'] = $config['current_path'] . '/images/';
$config['http_images_path'] = $config['http_path'] . '/images/';
$config['thumbnails_path'] = $config['images_path'] . 'thumbnails/';

$config['http_location'] = 'http://' . $config['http_host'] . $config['http_path'];
$config['https_location'] = 'https://' . $config['https_host'] . $config['https_path'];
$config['current_location'] = (defined('HTTPS')) ? $config['https_location'] : $config['http_location'];
