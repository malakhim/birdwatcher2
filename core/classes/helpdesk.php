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

if (!defined('AREA') ) { die('Access denied');}

/**
 *
 * Helpdesk connector class
 *
 */
class Helpdesk {
	
	/**
	 * Returns current license status
	 * @param  string $license_key
	 * @param  string $host_name If host_name was specified, license will be checked
	 * @return bool
	 */
	public static function get_license_information($license_number = '', $extra_fields = array())
	{
		$uc_settings = CSettings::instance()->get_values('Upgrade_center');
		
		if (empty($license_number)) {
			$license_number = $uc_settings['license_number'];
		}
		
		if (empty($license_number)) {
			return 'LICENSE_IS_INVALID';
		}
		
		$token = self::token(true);
		$store_key = self::get_store_key();

		$store_ip = fn_get_ip();
		$store_ip = $store_ip['host'];

		$domains = '';

		
		$request = array(
			'token' => $token,
			'license_number' => $license_number,
			'ver' => PRODUCT_VERSION,
			'product_status' => PRODUCT_STATUS,
			'product_build' => PRODUCT_BUILD,
			'edition' => PRODUCT_TYPE,
			'lang' => CART_LANGUAGE,
			'store_uri' => fn_url('', 'C', 'http'),
			'secure_store_uri' => fn_url('', 'C', 'https'),
			'https_enabled' => (Registry::get('settings.General.secure_checkout') == 'Y' || Registry::get('settings.General.secure_admin') == 'Y' || Registry::get('settings.General.secure_auth') == 'Y') ? 'Y' : 'N',
			'domains' => $domains,
			'store_key' => $store_key,
			'admin_uri' => fn_url('', 'A', 'http'),
			'store_ip' => $store_ip,
		);

		$request = array(
			'Request@action=check_license@api=3' => array_merge($extra_fields, $request),
		);
		
		$request = '<?xml version="1.0" encoding="UTF-8"?>' . fn_array_to_xml($request);
		
		list($header, $data) = fn_https_request('GET', Registry::get('config.updates_server') . '/index.php?dispatch=product_updates.check_available&request=' . urlencode($request), array(), '&', '', '', '', '', '', '', array(), 10);
		
		if (empty($header)) {
			$data = fn_get_contents(Registry::get('config.updates_server') . '/index.php?dispatch=product_updates.check_available&request=' . urlencode($request));
		}
		
		return $data;
	}
	
	/**
	 * Set/Get token auth key
	 * @param  string $generate If generate value is equal to "true", new token will be generated
	 * @return string token value
	 */
	public static function token($generate = false)
	{
		if ($generate) {
			$token = fn_crc32(microtime());
			fn_set_storage_data('hd_request_code', $token);
		} else {
			$token = fn_get_storage_data('hd_request_code');
		}
		
		return $token;
	}

	/**
	 * Get store auth key
	 * 
	 * @return string store key
	 */
	public static function get_store_key()
	{
		$key = Registry::get('settings.store_key');
		$host_path = Registry::get('config.http_host') . Registry::get('config.http_path');

		if (!empty($key)) {
			list($token, $host) = explode(';', $key);
			if ($host != $host_path) {
				unset($key);
			}
		}

		if (empty($key)) {
			// Generate new value
			$key = fn_crc32(microtime());
			$key .= ';' . $host_path;
			CSettings::instance()->update_value('store_key', $key);
		}
		
		return $key;
	}
	
	public static function auth()
	{
		$_SESSION['last_status'] = 'INIT';
		
		self::init_helpdesk_request();
		
		return true;
	}
	
	public static function init_helpdesk_request()
	{
		if (AREA != 'C') {
			$protocol = defined('HTTPS') ? 'https' : 'http';

			$_SESSION['stats'][] = '<img src="' . fn_url('helpdesk_connector.auth', 'A', $protocol) . '" alt="" style="display:none" />';
		}
	}
	
	public static function parse_license_information($data, $auth)
	{
		$updates = $messages = $license = '';
		
		if (!empty($data)) {
			// Check if we can parse server response
			if (strpos($data, '<?xml') !== false) {
				$xml = simplexml_load_string($data);
				$updates = (string) $xml->Updates;
				$messages = $xml->Messages;
				$license = (string) $xml->License;
			} else {
				$license = $data;
			}
		}
					
		if (Registry::get('settings.General.auto_check_updates') == 'Y' && fn_check_user_access($auth['user_id'], 'upgrade_store')) {
			// If upgrades are available
			if ($updates == 'AVAILABLE') {
				$msg = fn_get_lang_var('text_upgrade_available');
				$msg = str_replace('[link]', fn_url('upgrade_center.manage'), $msg);
				fn_set_notification('W', fn_get_lang_var('notice'), $msg, 'S', 'upgrade_center');
			}
		}
		
		fn_helpdesk_process_messages($messages);
		
		if (!empty($data)) {
			$_SESSION['last_status'] = $license;
		}
		
		return array($license, $updates, $messages);
	}
	
	public static function register_license($license_data)
	{
		$request = array(
			'Request@action=register_license@api=2' => array(
				'product_type' => PRODUCT_TYPE,
				'domain' => $_SERVER['HTTP_HOST'],
				'first_name' => $license_data['first_name'],
				'last_name' => $license_data['last_name'],
				'email' => $license_data['email'],
			),
		);
		
		$request = '<?xml version="1.0" encoding="UTF-8"?>' . fn_array_to_xml($request);
		
		list($header, $data) = fn_https_request('GET', Registry::get('config.updates_server') . '/index.php?dispatch=licenses_remote.add&request=' . urlencode($request), array(), '&', '', '', '', '', '', '', array(), 10);
		
		if (empty($header)) {
			$data = fn_get_contents(Registry::get('config.updates_server') . '/index.php?dispatch=licenses_remote.create&request=' . urlencode($request));
		}
		
		$result = $messages = $license = '';
		
		if (!empty($data)) {
			// Check if we can parse server response
			if (strpos($data, '<?xml') !== false) {
				$xml = simplexml_load_string($data);
				$result = (string) $xml->Result;
				$messages = $xml->Messages;
				$license = $xml->License;
			}
		}
		
		fn_helpdesk_process_messages($messages);
		
		return true;
	}
}
?>