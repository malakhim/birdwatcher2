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

if (!defined('AREA')) { die('Access denied'); }

// use default cs-cart session id if possible
fn_define('SKIP_SESSION_VALIDATION', true);

define('DEFAULT_ADMIN_EMAIL', 'admin@example.com', true);

// addon version
define('TWIGMO_VERSION', '2.4');

define('TWIGMO_UPGRADE_DIR', DIR_ROOT . '/var/twigmo/');
define('TWIGMO_UPGRADE_VERSION_FILE', 'version_info.txt');
define('TWIGMO_UPGRADE_SERVER', 'http://twigmo.com/download/');
define('TWG_CHECK_UPDATES_SCRIPT', 'http://twigmo.com/svc2/check_updates.php');

// skins.js
define('TWIGMO_SKINS_CONFIG_URL', ((defined('HTTPS')) ? 'https://' : 'http://') . 'twigmo.com/download/skins2/');

// Use https for customer area
define('TWIGMO_USE_HTTPS', 'A'); // A - auto, Y - yes, N - no

fn_define('TWIGMO_IS_NATIVE_APP', !empty($_REQUEST['is_native_app']));

fn_define('TWIGMO_SERVICE_URL', 'http://twigmo.com/svc/index.php?dispatch=api.post');

if (Registry::get('addons.twigmo.status') == 'A') {
	Registry::set('addons.twigmo.service_username', '');
	Registry::set('addons.twigmo.service_password', '');

	Registry::set('addons.twigmo.storefront_scripts_url', ((defined('HTTPS')) ? 'https://' : 'http://').'twigmo.com/m/');

	$block_types = array('products', 'categories', 'pages', 'html_block');

	if (Registry::get('addons.banners.status') == 'A') {
		$block_types[] = 'banners';
	}

	Registry::set('addons.twigmo.block_types', $block_types);

	Registry::set('addons.twigmo.list_objects', array('blocks/html_block.tpl'));

	Registry::set('addons.twigmo.cart_image_size', array('width' => 96, 'height' => 96));
	Registry::set('addons.twigmo.catalog_image_size', array('width' => 100, 'height' => 100));
	Registry::set('addons.twigmo.prewiew_image_size', array('width' => 130, 'height' => 120));
	Registry::set('addons.twigmo.big_image_size', array('width' => 800, 'height' => 800));

	Registry::set('addons.twigmo.checkout_processors', array('Google checkout', 'Amazon checkout', 'PayPal Express Checkout'));
}

if (file_exists(DIR_ADDONS . 'twigmo/local_conf.php')) {
	include(DIR_ADDONS . 'twigmo/local_conf.php');
}

?>
