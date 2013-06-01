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

class Tests_MockObject {
	/**
	 * Not required param that contents objects of test
	 * @var type
	 */
	public $objects;

	/**
	 * Function that executes before all tests.
	 * In this function you must create objects that will be used by test manager in tests.
	 * !! You must always run parent construct.
	 */
	function __construct()
	{


	}

	/**
	 * Function that executes after test.
	 * !! You must always run parent destruct.
	 */
	function __destruct()
	{
		if (is_array($this->objects)) {
			foreach ($this->objects as $key=>$object){
				if (is_object($object)) {
					unset($this->objects[$key]);
				}
			}
		}
	}

	function is_int($test_case, $result)
	{
		return is_int($result['return']);
	}
}
?>
