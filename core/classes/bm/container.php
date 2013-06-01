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

/**
 * Container class
 */

class Bm_Container extends CompanySingleton {
	/**
	 * Gets list of containers
	 *
	 * @param int $location_id Location identifier
	 * @param array $fields Array of table column names to be returned
	 * @param string $join Query join; it is treated as a JOIN clause
	 * @param string $condition Query condition; it is treated as a WHERE clause
	 * @return array Array of containers data as position => data
	 */
	public function get_list($location_id, $fields = array('*'), $join = '', $condition = '')
	{
		// Try to get central container for this location
		$containers = db_get_hash_array(
			"SELECT ?p FROM ?:bm_containers as c ?p WHERE c.location_id = ?i ?p",
			'position',
			implode(',', $fields),
			$join,
			$location_id,
			$condition
		);

		return $containers;
	}

	/**
	 * Gets top and bottom containers from default location
	 * If location with <i>$location_id</i> is default, sets the returned <i>default</i> param as 1
	 *
	 * @param int $location_id Location identifier
	 * @param array $fields Array of table column names to be returned
	 * @param string $join Query join; it is treated as a JOIN clause
	 * @param string $condition Query condition; it is treated as a WHERE clause
	 * @return array Array of containers data as position => data
	 */
	private function _get_default($location_id, $fields = array('*'), $join = '', $condition = '')
	{
		// Get TOP and BOTTTOM from default location
		$default_containers = db_get_hash_array(
			"SELECT ?p, IF (?:bm_containers.location_id != ?i, 0, 1) as `default` FROM ?:bm_containers "
				. "INNER JOIN ?:bm_locations ON ?:bm_containers.location_id = ?:bm_locations.location_id ?p "
			. "WHERE ?:bm_locations.is_default = 1 AND (?:bm_containers.position='TOP' OR ?:bm_containers.position='BOTTOM') ?p",
			'position',
			implode(',', $fields),
			$location_id,
			$join,
			fn_get_company_condition('?:bm_locations.company_id') . $condition
		);

		return $default_containers;
	}

	/**
	 * Gets list of containers from the location with <i>$location_id</i> for admin area,
	 * or top and bottom containers from the default location and center
	 * container from location with <i>$location_id</i> for customer area.
	 *
	 * @param int $location_id Location identifier
	 * @param string $area Area ('A' for admin or 'C' for customer)
	 * @param array $fields Array of table column names to be returned
	 * @param string $join Query join; it is treated as a JOIN clause
	 * @param string $condition Query condition; it is treated as a WHERE clause
	 * @return array Array of containers data as position => data
	 */
	public function get_list_by_area($location_id, $area = AREA, $fields = array('*'), $join = '', $condition = '')
	{
		$containers = $this->_override_by_default(
			$this->get_list($location_id, $fields, $join, $condition),
			$this->_get_default($location_id, $fields, $join, $condition),
			$area
		);

		return $containers;
	}

	/**
	 * Override top and bottom containers with the ones from the default location in customer area; only for the default location in the admin area
	 *
	 * @param array $containers Array of containers data as position => data
	 * @param array $def_containers  Array of containers data from default location as position => data
	 * @param string $area  Area ('A' for admin or 'C' for customer)
	 * @return array Array of containers data as position => data
	 */
	private function _override_by_default($containers, $def_containers, $area)
	{
		$_containers = array();

		foreach($containers as $position => $container) {
			$_containers[$position] = $container;
			if ($area == 'C') {
				// Always override by default containers
				if (!empty($def_containers[$position])) {
					$_containers[$position] = $def_containers[$position];
				}
			} elseif ($area == 'A') {
				// Override by default containers only for default page
				if (isset($def_containers[$position]['default']) && $def_containers[$position]['default'] == 1) {
					$_containers[$position] = $def_containers[$position];
				}
			}
		}

		return $_containers;
	}

	/**
	 * Gets container data by id
	 *
	 * @param $container_id Container identifier
	 * @return array Array of container data
	 */
	public function get_by_id($container_id)
	{
		$container = db_get_row('SELECT * FROM ?:bm_containers WHERE container_id = ?i', $container_id);

		return $container;
	}

	/**
	 * Gets identifiers of containers from array of containers data as position => data
	 *
	 * @param array $containers Array of containers data as position => data
	 * @return array Array of containers ids
	 */
	public function get_ids($containers){
		$container_ids = array();

		if (is_array($containers)) {
			foreach($containers as $container) {
				$container_ids[] = $container['container_id'];
			}
		}

		return $container_ids;
	}

	/**
	 * Creates or updates container.
	 * <i>$container_data</i> must be array with this fields:
	 * <pre>array (
	 *  container_id,
	 *  location_id,
	 *  position (TOP | CENTRAL | BOTTOM),
	 *  width (12 | 16)
	 * )</pre>
	 *
	 * @param array $container_data array of container data
	 * @return int|db_result Container id if new grid was created, DB result otherwise
	 */
	function update($container_data)
	{
		return db_replace_into('bm_containers', $container_data);
	}

	/**
	 * Performs a cleanup: removes container related data
	 *
	 * @return bool Always true
	 */
	function remove_missing()
	{
		// Remove missing blocks
		db_remove_missing_records('bm_containers', 'location_id', 'bm_locations');

		return true;
	}

	/**
	 * Returns object instance if Bm_Container class or create it if not exists
	 * @static
	 * @param int $company_id Company identifier
	 * @return Bm_Container
	 */
	public static function instance($company_id = null, $class_name = 'Bm_Container')
	{
		return parent::instance($company_id, $class_name);
	}
}
?>