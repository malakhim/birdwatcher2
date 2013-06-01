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

class Stores_Import_General
{
	const CONNECTION_NAME = "exim_stores";

	public static function initiateImportedDB($store_data)
	{
		$db_conn = db_initiate(
			$store_data['db_host'],
			$store_data['db_user'],
			$store_data['db_password'],
			$store_data['db_name'],
			Stores_Import_General::CONNECTION_NAME,
			$store_data['table_prefix']
		);

		return $db_conn;
	}

	/**
	 * Connects to database of imported cart
	 *
	 * @static
	 * @return bool True on success, false otherwise
	 */
	public static function connectToImportedDB($store_data)
	{
		return db_connect_to(Stores_Import_General::CONNECTION_NAME, $store_data['db_name']);
	}

	/**
	 * Connects to original database
	 *
	 * @static
	 * @return bool True on success, false otherwise
	 */
	public static function connectToOriginalDB()
	{
		return db_connect_to_main();
	}

	/**
	 * Checks database connection
	 *
	 * @static
	 * @param array $store_data Array of store data
	 * @return bool True on success, false otherwise
	 */
	public static function testDatabaseConnection($store_data)
	{
		$status = false;

		if (!empty($store_data['db_host']) && !empty($store_data['db_user']) && !empty($store_data['db_name']) && !empty($store_data['db_password'])) {
			$new_db = @Stores_Import_General::initiateImportedDB($store_data);

			if ($new_db != null) {
				$status = true;
			}
		}

		Stores_Import_General::connectToOriginalDB();

		return $status;
	}

	/**
	 * Checks that table prefix correct
	 *
	 * @static
	 * @param array $store_data Array of store data
	 * @return bool True on success, false otherwise
	 */
	public function testTablePrefix($store_data)
	{
		$status = false;
		Stores_Import_General::connectToImportedDB($store_data);

		$tables = db_get_array("SHOW TABLES LIKE '" . $store_data['table_prefix'] . "sessions';");

		if (!empty($tables)) {
			$status = true;
		}

		Stores_Import_General::connectToOriginalDB();

		return $status;
	}

	/**
	 * Returns config of cart placed by $cart_path
	 *
	 * @static
	 * @param string $cart_path
	 * @return array|bool Array of store data on success, false otherwise.
	 */
	public static function getConfig($cart_path)
	{
		$cart_path = fn_remove_trailing_slash($cart_path);
		if (file_exists($cart_path . '/config.local.php') && file_exists($cart_path . '/config.php')) {

			// Read settings from config.local.php
			$config_local_php = file_get_contents($cart_path . '/config.local.php');
			$config_local_php =  self::_removePhpComments($config_local_php);

			$config['db_host'] = self::_getVariable('db_host', $config_local_php);
			$config['db_name'] = self::_getVariable('db_name', $config_local_php);
			$config['db_user'] = self::_getVariable('db_user', $config_local_php);
			$config['db_password'] = self::_getVariable('db_password', $config_local_php);
			$config['table_prefix'] = self::_getConstant('TABLE_PREFIX', $config_local_php);

			$config['storefront'] = self::_getVariable('http_host', $config_local_php) . self::_getVariable('http_path', $config_local_php);
			$config['secure_storefront'] = self::_getVariable('https_host', $config_local_php) . self::_getVariable('https_path', $config_local_php);

			// Read settings from config.php
			$config_php = file_get_contents($cart_path . '/config.php');
			$config_php =  self::_removePhpComments($config_php);
			$config['product_type'] = self::_getConstant('PRODUCT_TYPE', $config_php);
			$config['product_version'] = self::_getConstant('PRODUCT_VERSION', $config_php);

			return $config;
		} else {
			return false;
		}
	}

	/**
	 * Removes PHP comments
	 *
	 * @param string $code PHP code
	 * @return string PHP code without comments
	 */
	private static function _removePhpComments($code)
	{
		return preg_replace("%//.*?\n%is", '', preg_replace("%/\*(.*?)\*/\s+%is", '', $code));
	}

	/**
	 * Returns value of some variable from CS-Cart config
	 *
	 * @param string $var_name Variable name
	 * @param string $config CS-Cart config contents
	 * @return string Variable value
	 */
	private static function _getVariable($var_name, $config)
	{
		preg_match("%config\s*?\[\s*?['\"]" . $var_name . "['\"]\s*?\]\s*?=\s*?['\"](.*?)['\"]\s*?;%is", $config, $value);
		return !empty($value[1]) ? $value[1] : "";
	}

	/**
	 * Returns value of some defined constant from CS-Cart config
	 *
	 * @param string $var_name Variable name
	 * @param string $config CS-Cart config contents
	 * @return string Variable value
	 */
	private static function _getConstant($var_name, $config)
	{
		preg_match("%define\s*?\(\s*?['\"]" . $var_name . "['\"]\s*?,\s*?['\"](.*?)['\"]\s*?\)\s*?;%is", $config, $value);
		return !empty($value[1]) ? $value[1] : "";
	}

	/**
	 * Generates name of import like a 224Com301Com
	 *
	 * @param $store_data array of store data
	 * @return mixed|string
	 */
	public function getImportName($store_data)
	{
		$upgrade_name = str_replace('.', '', $store_data['product_version']);
		$upgrade_name .= self::_getAcronym($store_data['product_type']);
		$upgrade_name .= str_replace('.', '', PRODUCT_VERSION);
		$upgrade_name .= self::_getAcronym(PRODUCT_TYPE);

		return $upgrade_name;
	}

	/**
	 * Creates and returns importer object of some of Base children
	 *
	 * @param array $store_data Store data array
	 * @return Stores_Import_Base
	 */
	public static function getImporter($store_data)
	{
		$class_name = 'Stores_Import_' . self::getImportName($store_data);

		if (class_exists($class_name)) {
			return new $class_name($store_data);
		}

		return null;
	}

	/**
	 * Returns 3 letters edition acronym
	 *
	 * @param string $product_type Product type
	 * @return string Acronym
	 */
	private function _getAcronym($product_type)
	{
		$product_types = array(
			'ULTIMATE' => 'Ult',
			'MULTIVENDOR' => 'Mve',
			'COMMUNITY' => 'Com',
			'PROFESSIONAL' => 'Pro',
		);

		return (isset($product_types[$product_type])) ? $product_types[$product_type] : '';
	}
}
