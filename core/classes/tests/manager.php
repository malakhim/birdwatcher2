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

class Tests_Manager {
	/**
	 * Return array of available test units
	 * @return type
	 */
	static function get_available_units()
	{
		$addons = array();
		$addons_test = glob(DIR_ROOT . '/addons/*/schemas/tests/test.*.php');

		foreach ($addons_test as $test) {
			preg_match('%.*?/([^/]*?)/schemas/tests/.*\.php$%', $test, $match);
			$addons[$match[1]][] = fn_basename($test);
		}

		return array(
			'core' => glob(DIR_ROOT . '/schemas/tests/test.*.php'),
			'addons' => $addons
		);
	}

	static function run_unit($unit, $addon = '')
	{
		if (!empty($addon)) {
			include_once DIR_ROOT . '/addons/' . addslashes($addon) . '/schemas/tests/' . addslashes($unit);
		} else {
			$tests_scheme = include_once DIR_ROOT . '/schemas/tests/' . addslashes($unit);
		}
		return self::_run_unit($tests_scheme);;
	}

	private static function _run_unit($scheme)
	{
		$log = array();

		$test_manager = new Tests_Unit ($scheme);
		$log = $test_manager->run();
		unset($test_manager);

		return $log;
	}

	static function sort_by_status ($log, $unit, $addon = ''){
		$result_log = array();
		$i = 1;
		foreach ($log as $name => $functions) {
			$result_log = fn_array_merge($result_log, self :: _process_function($functions, $unit, $addon, $name, $i));
		}

		return  $result_log;
	}

	/**
	 *
	 * @param type $log
	 * @param type $unit
	 * @param type $addon
	 * @param type $class
	 * @param type $i Global test counter
	 * @return type
	 */
	private static function _process_function($log, $unit, $addon = '', $class = '', &$i){
		$result_log = array();

		foreach ($log as $function) {
			foreach ($function['tests'] as $k=>$test ) {
				$result_log[$test['status']['general']][$i] = array(
					'class' => $class,
					'function' => $test['case']['name'],
					'status' => $test['status'],
					'unit' => $unit,
					'addon' => $addon
				);
				$i++;
			}
		}

		return  $result_log;
	}

	public function get_scheme_for_class($class_name)
	{
		$scheme = '';

		if (class_exists($class_name)) {
			$rc = new ReflectionClass($class_name);
			$methods = $rc->getMethods();

			$static = array();
			$generic = array();
			foreach($methods as $method) {
				if ($method->isPublic()) {
					if ($method->isStatic()) {
						$static[] = $method;
					} else {
						$generic[] = $method;
					}
				}
			}

			if (!empty($static)) {
				$scheme .= "// Static methods for test\n"
						."\t'statics' => array(\n"
						. "\t\t'{$class_name}' => array(\n";

				$scheme .= self::_get_function_scheme ($static);

				$scheme .= "\t\t),\n\t),\n";
			}

			if (!empty($generic)) {
				$scheme .= "// Object methods for test\n"
						."\t'objects' => array(\n"
						. "\t\t'{$class_name}' => array(\n";

				$scheme .= self::_get_function_scheme ($generic);

				$scheme .= "\t\t),\n\t),\n";
			}
		}

		return $scheme;
	}

	private function _get_function_scheme($functions)
	{
		$scheme = "";
		foreach ($functions as $function){
			$scheme .= self::_get_param_combination($function);
		}

		return $scheme;
	}

	private function _get_param_combination($function)
	{
		$scheme = "";
		//p($function->getParameters());
		//p($function->getNumberOfParameters());
		$params = array();
		$doc = $function->getDocComment();
		foreach($function->getParameters() as $param){
			$value = "";
			if ($param->isDefaultValueAvailable()) {
				$value = $param->getDefaultValue();
			}

			$expression = (
							'/'
							. '@param' // prefix
							. '\s+(\w+)' // var type
							. '\s+(\$' . $param->name . ')' // var name
							. '\s?(.*)?' // description
							. '/i' // regexp params
			);
			preg_match_all($expression, $doc, $m);
			if (isset($m[1][0])) {
				$type = $m[1][0];
			} else {
				$type = '';
			}
			$params[] = fn_array2code_string($value, 0, $type);
		}

		$scheme .= "\t\t\tarray(\n"
				. "\t\t\t\t'name' => '{$function->name}',\n"
				. "\t\t\t\t'in' => array(". implode(', ', $params)."),\n"
				. "\t\t\t),\n";
		return $scheme;
	}
}
?>