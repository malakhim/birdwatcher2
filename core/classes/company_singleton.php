<?php 

class CompanySingleton {
	/**
	 * @var array Array of object instances
	 */
	protected static $_instance;

	/**
	 * @var int Company identifier
	 */
	protected $_company_id;

	/**
	 * Returns object instance of this class or create it if it is not exists.
	 * @static
	 * @param int $company_id Company identifier
	 * @param string $class_name Class name to load
	 * @return mixed
	 */
	public static function instance($company_id = null, $class_name = '')
	{
		if (empty(self::$_instance[$class_name])) {
			self::$_instance[$class_name] = new $class_name();
		}

		self::$_instance[$class_name]->set_company($company_id);

		return self::$_instance[$class_name];
	}

	public function set_company($company_id)
	{
		if ($company_id == null && defined('COMPANY_ID')) {
			$this->_company_id = COMPANY_ID;
		} else {
			$this->_company_id = $company_id;
		}
	}

	public function get_company_condition($db_field)
	{
		$company_id = $this->_company_id;

		if ($this->_company_id == null) {
			$company_id = '';
		}

		return fn_get_company_condition($db_field, true, $company_id);
	}

	/**
	 * We Can create object only inside it
	 */
	protected function __construct() {}
}
?>