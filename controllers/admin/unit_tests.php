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

if ($mode == 'manage') {
	$view->assign('available_units', Tests_Manager::get_available_units());
}

if ($mode == 'generate_scheme') {
	$class_name = stripslashes($action);

	$test_content = '';

	if (!empty($class_name)) {
		$test_content = Tests_Manager::get_scheme_for_class($class_name);
	}
	foreach(fn_get_dir_contents(DIR_CORE . 'classes', false, true, '', '', true) as $class) {
		$classes[] = fn_path_to_class_name ($class);
	}
	$view->assign('classes', $classes);
	$view->assign('test_content', $test_content);
}

if ($mode == 'run') {
	
	if (isset($_REQUEST['addon']) && !empty($_REQUEST['addon'])) {
		$addon = $_REQUEST['addon'];
	} else {
		$addon = '';
	}
	
	$log = Tests_Manager::run_unit($_REQUEST['unit'], $addon);
	
	$view->assign('test_log', $log);
}

if ($mode == 'test') {
	$units = Tests_Manager::get_available_units();
	$log = array();
	
	foreach ($units['core'] as $unit) {		
		$log = fn_array_merge($log, Tests_Manager::sort_by_status(Tests_Manager::run_unit(fn_basename($unit)), fn_basename($unit)));
	}
	
	foreach ($units['addons'] as $addon => $addon_units) {		
		foreach ($addon_units as $unit) {
			$log = fn_array_merge($log, Tests_Manager::sort_by_status(Tests_Manager::run_unit(fn_basename($unit), $addon), fn_basename($unit), $addon));
		}		
	}
	
	ksort($log, SORT_STRING);
	
	$view->assign('test_log', $log);
}

/*

$tests = glob(DIR_ROOT . '/_tools/tests/test.*.php');

$log = array();

foreach ($tests as $test){
	$tests_scheme = include_once $test;
	$test_manager = new TestManager ($tests_scheme);
	$log[fn_basename($test)] = $test_manager->run();
}

$view->assign('test_modules', $log);
 */
?>
