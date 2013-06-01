<?
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

class Tests_Unit {
	/**
	 * Константы типов тестируемых сущностей
	 * Это может быть просто функция, метод статического класса или метод объекта.
	 */
	const _FUNCTION = 0;
	const _STATIC = 1;
	const _OBJECT = 2;

	/**
	 * Если тестируемая функция не вернула ни одного значения то выводиться этот текст.
	 */
	const NO_RETURN = "sdiufha87fhk23jhd897hwksjdh";
	const NO_STATUS = "wqeidfjq283jddklsjaksljd";

	/**
	 * Функции подготовленные к тестированию
	 * @var array
	 */
	private $functions = array();
	/**
	 * Статические методы подготовленные к тестированию
	 * @var array
	 */
	private $statics = array();
	/**
	 * Методы объектов подготовленные к тестированию
	 * @var array
	 */
	private $objects = array();

	/**
	 * Объект окружения, если есть.
	 * определяется в схеме в параметре mock_object, как название класса который нужно создать
	 * @var null
	 */
	private $mock_object = null;

	/**
	 * Array of user storage data
	 * @var array
	 */
	private $storage;

	public function __construct($tests_case)
	{
		if (isset($tests_case['objects'])) {
			$this->objects = $tests_case['objects'];
		}

		if (isset($tests_case['statics'])) {
			$this->statics = $tests_case['statics'];
		}

		if (isset($tests_case['functions'])) {
			$this->functions = $tests_case['functions'];
		}

		if (isset($tests_case['mock_object'])) {
			$this->mock_object = new $tests_case['mock_object'];
		}
	}

	public function run ()
	{
		$log = Array();

		foreach ($this->functions as $test_case){
			if (isset($test_case['name'])) {
				$log['functions'][$test_case['name']]['tests'][] = $this->_process_function($test_case['name'], $test_case, self::_FUNCTION);
			}
		}

		foreach ($this->statics as $class_name => $methods){
			if (!isset($log[$class_name])) {
				$log[$class_name] = $this->_process_static($class_name, $methods);
			} else {
				$log[$class_name] = array_merge($log[$class_name], $this->_process_static($class_name, $methods));
			}
		}

		foreach ($this->objects as $class_name => $methods){
			if (!isset($log[$class_name])) {
				$log[$class_name] = $this->_process_object($class_name, $methods);
			} else {
				$log[$class_name] = fn_array_merge($log[$class_name], $this->_process_object($class_name, $methods));
			}
		}

		if ($this->mock_object != null) {
			unset($this->mock_object);
		}

		return $log;
	}

	private function _process_function($name, $test_case, $type)
	{
		if (!empty($test_case['in'])) {
			foreach($test_case['in'] as $k => $v){
				$test_case['in'][$k] = $this->_get_from_storage($v);
			}
		}

		$return = $this->_run_function($name, $test_case, $type);

		return array(
			'case' => $test_case,
			'post_in' => $return['post_in'],
			'result' => $return['return'],
			'status' => $return['status'],
		);
	}

	private function _process_static($class_name, $methods)
	{
		$log = array();

		foreach($methods as $test_case){
			if (isset($test_case['name'])) {
				$log[$test_case['name']]['tests'][] = $this->_process_function(array($class_name, $test_case['name']), $test_case, self::_STATIC);
				$log[$test_case['name']]['static'] = true;
			}
		}

		return $log;
	}

	private function _process_object($class_name, $methods)
	{
		$log = array();

		if (isset($this->mock_object->objects[$class_name])) {
			$object = $this->mock_object->objects[$class_name];
		} else {
			$object = new $class_name;
		}

		foreach($methods as $test_case){
			if (isset($test_case['name'])) {
				$log[$test_case['name']]['tests'][] = $this->_process_function(array($object, $test_case['name']), $test_case, self::_OBJECT);
			}
		}

		return $log;
	}

	private function _generate_args($in)
	{
		$args = array();
		foreach($in as $k => $v){
			$args[] = '&$arg'.$k;
		}
		return implode(',', $args);
	}

	private function _run_function($function_name, $test_case, $type)
	{
		// Initialisation
		$result = array(
			'return' => self::NO_RETURN
		);
		// Create variables for references
		if (isset($test_case['in'])) {
			foreach($test_case['in'] as $k => $v){
				$mask = 'arg'.$k;
				$$mask = $v;
			}
			$in = $this->_generate_args($test_case['in']);
		} else {
			$in = '';
		}

		if (isset($test_case['registry'])) {
			$this->_set_registry($test_case['registry']);
		}

		// Run functions
		switch ($type) {
			case self::_FUNCTION:
				if (function_exists($function_name)) {
					eval ('$result["return"] = call_user_func_array($function_name, array(' . $in . '));');
				}
				break;

			case self::_STATIC:
			case self::_OBJECT:
				if (method_exists($function_name[0], $function_name[1])) {
					eval ('$result["return"] = call_user_func_array($function_name, array(' . $in . '));');
				}
				break;
		}

		// Format output
		$result['post_in'] = array();
		if (isset($test_case['in'])) {
			foreach($test_case['in'] as $k => $v){
				$mask = 'arg'.$k;
				$result['post_in'][] = $$mask;
			}
		}

		if (!empty($test_case['place_return_to'])) {
			$this->_put_to_storage($test_case['place_return_to'], $result['return']);
		}

		$result['status'] = $this->_generate_status($result, $test_case);

		return $result;
	}

	private function _generate_status($result, $test_case) {
		$status = array (
			'in' => Tests_Unit::NO_STATUS,
			'out' => Tests_Unit::NO_STATUS,
			'general' => Tests_Unit::NO_STATUS,
			'user' => Tests_Unit::NO_STATUS,
		);

		if (isset($test_case['out'])) {
			$status['out'] = $this->_compare($result['return'], $test_case['out']);
			$status['general'] = $status['out'];
		}

		if (isset($test_case['post_in'])) {
			$status['in'] = $this->_compare($result['post_in'], $test_case['post_in']);
			if ($status['out'] !== Tests_Unit::NO_STATUS) {
				$status['general'] = $status['out'];
			} else {
				$status['general'] = $status['in'];
			}
		}

		if (isset($test_case['user_func']) && method_exists($this->mock_object, $test_case['user_func'])) {
			$result['status'] = $status;
			$status['user'] = call_user_func_array(array($this->mock_object, $test_case['user_func']), array($test_case, $result));

			if ($status['general'] != Tests_Unit::NO_STATUS) {
				$status['general'] = $status['general'] && $status['user'];
			} else {
				$status['general'] = $status['user'];
			}

		}

		return $status;
	}

	private function _set_registry($registry) {
		foreach ($registry as $key=>$value) {
			Registry::set($key, $value);
		}
	}

	private function _compare($a, $b){
		if (is_array($a) && is_array($b)) {
			return ($a == $b) ? true : false;
		} elseif (is_object($a)){
			return (md5(serialize($a)) == md5((string)$b)) ? true : false;
		} else {
			return (md5((string)$a) == md5((string)$b)) ? true : false;
		}
	}

	/**
	 * @param $key
	 * @param $value
	 */
	private function _put_to_storage($key, $value)
	{
		$this->storage[$key] = $value;
	}

	/**
	 * @param $variable
	 * @return mixed|null
	 */
	private function _get_from_storage($variable)
	{
		if (is_string($variable) && preg_match('/#TV_(.*?)$/', $variable, $match)) {
			if (!empty($match[1]) && isset($this->storage[$match[1]])) {
				return $this->storage[$match[1]];
			}
		}

		return $variable;
	}
}

function fn_test_has_status($status){
	return $status != Tests_Unit::NO_STATUS;
}

function fn_test_has_return($status){
	return $status != Tests_Unit::NO_RETURN;
}
?>