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
 * Grid class
 */
class Bm_Grid {

	/**
	 * Gets list of grids
	 * @static
	 * @param array $container_ids Identifiers of containers containing the needed grids
	 * @param array $fields array of table column names to be returned
	 * @param string $join Query join; it is treated as a JOIN clause
	 * @param string $condition Query condition; it is treated as a WHERE clause
	 * @return array Array of grids as container_id => array(grid_id => block data)
	 */
	public static function get_list($container_ids, $fields = array('*'), $join = '', $condition = '')
	{
		/**
		 * Prepares params for SQL query before getting grids
		 * @param array $container_ids Identifiers of containers containing the needed grids
		 * @param array $fields array of table column names to be returned
		 * @param string $join Query join; it is treated as a JOIN clause
		 * @param string $condition Query condition; it is treated as a WHERE clause
		 * @param string $lang_code 2 letter language code
		 */
		fn_set_hook('get_grids_pre', $container_ids, $fields, $join, $condition);

		// Try to get location for this dispatch
		$grids = db_get_hash_multi_array(
			"SELECT ?p FROM ?:bm_containers as c "
			. "LEFT JOIN ?:bm_grids as g ON g.container_id = c.container_id ?p"
			. "WHERE c.container_id IN (?n) ?p ORDER BY g.parent_id, g.grid_id ASC",
			array('container_id', 'grid_id'),
			implode(',', $fields),
			$join,
			$container_ids,
			$condition
		);

		/**
		 * Processes grids list after getting it
		 * @param array $grids Array of grids data
		 */
		fn_set_hook('get_grids_post', $grids);

		return $grids;
	}

	/**
	 * Gets grid data by id
	 * @static
	 * @param int $grid_id Grid identifier
	 * @param string $lang_code 2 letter language code
	 * @return array Grid data
	 */
	public static function get_by_id($grid_id, $lang_code = CART_LANGUAGE)
	{
		/**
		 * Prepares params for SQL query before getting grid
		 * @param int $grid_id Grid identifier
		 * @param string $lang_code 2 letter language code
		 */
		fn_set_hook('get_grid_pre', $grid_id, $lang_code);

		// FIXME: We need to add grid_descr to this query
		$grid = db_get_row('SELECT * FROM ?:bm_grids WHERE grid_id = ?i', $grid_id);

		/**
		 * Processes grid data after getting it
		 * @param array $grid Array of grid data
		 * @param string $lang_code 2 letter language code
		 */
		fn_set_hook('get_grid_post', $grid, $lang_code);

		return $grid;
	}

	/**
	 * Gets identifiers of grids from array of grids as container_id => array(grid_id => block data)
	 * @static
	 * @param array $grids Array of grids as container_id => array(grid_id => block data)
	 * @return array Grid identifiers
	 */
	public static function get_ids($grids)
	{
		$grids_ids = array();
		foreach ($grids as $container) {
			$grids_ids = array_merge($grids_ids, array_keys($container));
		}

		return $grids_ids;
	}

	/**
	 * Creates or updates grid
	 * <i>$grid_data</i> must be array in this format
	 * <pre>array (
	 *  grid_id
	 *  container_id
	 *  parent_id
	 *  order
	 *  width - grid 960 param
	 *  suffix - grid 960 param
	 *  prefix - grid 960 param
	 *  omega - grid 960 param
	 *  alpha - grid 960 param
	 *  wrapper - path to wrapper template from skins/SKIN_NAME/customer folder
	 *  content_align - LEFT|RIGHT|FULL_WIDTH, blocks in this grid will be placed as float left, float right or with width 100% in case.
	 *  html_element - name of html element of this grid (div, ul, li, p, etc.)
	 *  clear - If 1 then after this grid will be clear div on rendered page
	 *  user_class
	 * )</pre>
	 * @static
	 * @param array $grid_data Array of grid data
	 * @param array $description Array of grid description data see Bm_Grid::_update_description()
	 * @return int|db_result Grid id if new grid was created, DB result otherwise
	 */
	public static function update($grid_data, $description = array())
	{
		/**
		 * Processes grid data before update it
		 * @param int $grid_data Array of grid data
		 * @param int $description Array of grid description data
		 */
		fn_set_hook('update_grid', $grid_data, $description);

		$grid_id = db_replace_into('bm_grids', $grid_data);
		self::_update_description($grid_id, $description);

		return $grid_id;
	}

	/**
	 * Updates grid description
	 * @static
	 * @param int $grid_id Grid identifier
	 * @param array $description Array of grid description
	 * @return bool True in success, false otherwise
	 */
	private static function _update_description($grid_id, $description)
	{
		if (!empty($grid_id) && isset($description['lang_code']) && isset($description['name'])) {
			$description['grid_id'] = $grid_id;

			/**
			 * Change location description data before update it
			 * @param $description
			 */
			fn_set_hook('update_grid_description', $description, $grid_id);

			db_replace_into('bm_grids_descriptions', $description);

			return true;
		} else {
			return false;
		}
	}

	/**
	 * Removes grid
	 * @param int $grid_id Grid identifier
	 * @return bool True in success, false otherwise
	 */
	public static function remove($grid_id)
	{
		$grids = db_get_hash_array('SELECT b.grid_id, b.parent_id FROM ?:bm_grids as a LEFT JOIN ?:bm_grids as b ON a.container_id = b.container_id WHERE a.grid_id = ?i ORDER BY b.parent_id, b.grid_id ASC', 'grid_id', $grid_id);

		if (!empty ($grids)) {
			$grids = fn_build_hierarchic_tree($grids, 'grid_id');

			foreach ($grids as $grid) {
				self::_remove($grid_id, $grid);
			}

			self::remove_missing();

			return true;
		} else {
			return false;
		}
	}

	/**
	 * @static
	 * @param $start_grid_id
	 * @param $grid
	 * @param bool $delete_grids
	 */
	private static function _remove($start_grid_id, $grid, $delete_grids = false) {
		if (isset($grid['grid_id']) && $start_grid_id == $grid['grid_id']) {
			$delete_grids = true;
		}

		if ($delete_grids) {
			/**
			 * Action before remove grid
			 * @param int $grid_id Grid identifier
			 */
			$grid_id = $grid['grid_id'];
			fn_set_hook('remove_grid', $grid_id);

			db_query('DELETE FROM ?:bm_grids WHERE grid_id = ?i', $grid['grid_id']);
			//db_query('DELETE FROM ?:bm_grids_descriptions WHERE grid_id = ?i', $grid['grid_id']);
		}

		if (!empty($grid['children']) && is_array($grid['children'])) {
			foreach($grid['children'] as $_grid) {
				self::_remove($start_grid_id, $_grid, $delete_grids);
			}
		}
	}

	/**
	 * Performs a cleanup: removes grid related data
	 * @static
	 * @return bool Always true
	 */
	static function remove_missing()
	{
		// Remove missing grids
		db_remove_missing_records('bm_grids', 'container_id', 'bm_containers');

		// Remove missing snappings
		db_remove_missing_records('bm_snapping', 'grid_id', 'bm_grids');

		return true;
	}

	/**
	 * Sets the <i>clear<i/> param as 1 on the grids that must have a clear div after them.
	 * @static
	 * @param array $clear_divs_data
	 * @return bool Always true
	 */
	static function set_clear_divs($clear_divs_data)
	{
		if (!empty($clear_divs_data['containers'])) {
			db_query('UPDATE ?:bm_grids SET clear = 0 WHERE container_id IN (?a)', array_keys($clear_divs_data['containers']));
		}

		if (!empty($clear_divs_data['grids'])) {
			db_query('UPDATE ?:bm_grids SET clear = 1 WHERE grid_id IN (?a)', array_keys($clear_divs_data['grids']));
		}

		return true;
	}
}
?>