<?php
/***************************************************************************
 *                                                                          *
 *   (c) 2004 Vladimir V. Kalynyak, Alexey V. Vinokurov, Ilya M. Shalnev    *
 *																	        *
 * This  is  commercial  software,  only  users  who have purchased a valid *
 * license  and  accept  to the terms of the  License Agreement can install *
 * and use this program.                                                    *
 *                                                                          *
 ****************************************************************************
 * PLEASE READ THE FULL TEXT  OF THE SOFTWARE  LICENSE   AGREEMENT  IN  THE *
 * "copyright.txt" FILE PROVIDED WITH THIS DISTRIBUTION PACKAGE.            *
 ****************************************************************************/

/**
 * Location class
 */
class Bm_Location extends CompanySingleton {

	/**
	 * Gets list of locations
	 *
	 * @param array $fields Array of table column names to be returned
	 * @param string $join Query join; it is treated as a JOIN clause
	 * @param string $condition Query condition; it is treated as a WHERE clause
	 * @param string $lang_code 2 letter language code
	 * @return array Array of locations data
	 */
	public function get_list($fields, $join = '', $condition = '', $lang_code = CART_LANGUAGE)
	{
		/**
		 * Prepares params for SQL query before getting locations
		 * @param array $fields array of table column names to be returned
		 * @param string $join Query join; it is treated as a JOIN clause
		 * @param string $condition Query condition; it is treated as a WHERE clause
		 * @param string $lang_code 2 letter language code
		 */
		fn_set_hook('get_locations_pre', $fields, $join, $condition, $lang_code);

		// Try to get location for this dispatch
		$locations = db_get_hash_array(
			"SELECT ?p FROM ?:bm_locations as l "
					. "LEFT JOIN ?:bm_locations_descriptions as d ON d.location_id = l.location_id ?p"
					. "WHERE lang_code = ?s ?p",
			'location_id',
			implode(',', $fields),
			$join,
			$lang_code,
			$this->get_company_condition('l.company_id') . $condition
		);

		/**
		 * Processes locations list after getting it
		 * @param array $locations Array of locations data
		 * @param string $lang_code 2 letter language code
		 */
		fn_set_hook('get_locations_post', $locations, $lang_code);

		return $locations;
	}

	/**
	 * Gets location for current <i>dispatch</i> and <i>lang_code</i>
	 *
	 * @param string $dispatch URL dispatch (controller.mode.action)
	 * @param array $dynamic_object Dynamic object data
	 * @param string $lang_code 2 letter language code
	 * @return array Array of location data
	 */
	public function get($dispatch, $dynamic_object = array(), $lang_code = CART_LANGUAGE)
	{
		/**
		 * Prepares params for SQL query before getting location
		 * @param string $dispatch URL dispatch (controller.mode.action)
		 * @param string $lang_code 2 letter language code
		 */
		fn_set_hook('get_location_pre', $dispatch, $lang_code);

		$dynamic_object_condition = "";
		if (!empty($dynamic_object['object_id'])) {
			$dynamic_object_scheme = Bm_SchemesManager::get_dynamic_object($dispatch, 'C');

			if (!empty($dynamic_object_scheme)) {
				$dynamic_object_condition = db_quote(
					" AND (FIND_IN_SET(?i, l.object_ids) OR l.object_ids = '')",
					$dynamic_object['object_id']
				);
			}
		}

		$dispatch = explode('.', $dispatch);

		while (count($dispatch) > 0) {
			// Try to get location for this dispatch
			$location = current($this->get_list(
				array('*'),
				null,
				db_quote(' AND l.dispatch LIKE ?s ?p ORDER BY l.object_ids DESC LIMIT 1', implode('.', $dispatch), $dynamic_object_condition),
				$lang_code
			));

			if (!empty($location)) {
				break;
			} else {
				array_pop($dispatch);
			}
		}

		// Get default location if there is no location for this dispatch
		if (empty($location)) {
			$location = $this->get_default($lang_code);
		}

		/**
		 * Processes location data after getting it
		 * @param array $location Location data
		 * @param string $lang_code 2 letter language code
		 */
		fn_set_hook('get_location_post', $location, $lang_code);

		return $location;
	}
	/**
	 * Checks that location belongs to company
	 * @param int $location_id Location identifier
	 * @param int $company_id Company identifier
	 * @return bool
	 */
	public static function check_owner($location_id, $company_id) {
		$location = db_get_array('SELECT * FROM ?:bm_locations WHERE location_id = ?i AND company_id=?i', $location_id, $company_id);

		return !empty($location);
	}

	/**
	 * Gets location data by id
	 *
	 * @param int $location_id Location identifier
	 * @param string $lang_code 2 letter language code
	 * @return array Array of locations data
	 */
	public function get_by_id($location_id, $lang_code = CART_LANGUAGE)
	{
		return current($this->get_list(
			array('*'),
			null,
			db_quote(' AND l.location_id = ?i LIMIT 1', $location_id),
			$lang_code
		));
	}

	/**
	 * Gets default location data
	 *
	 * @param string $lang_code 2 letter language code
	 * @return array Array of locations data
	 */
	public function get_default($lang_code = CART_LANGUAGE)
	{
		return current($this->get_list(
			array('*'),
			null,
			' AND l.is_default = 1 LIMIT 1',
			$lang_code
		));
	}

	/**
	 * Sets location with <i>$location_id</i> as default if it exists.
	 * Returns true in success or false if this location does not exist
	 *
	 * @param int $location_id Location identifier
	 * @return bool True in success, false otherwise
	 */
	public function set_default($location_id)
	{
		$location = current($this->get_list(
			array('l.location_id '),
			null,
			db_quote(' AND l.location_id = ?i LIMIT 1', $location_id)
		));

		if (!empty($location)) {
			/**
			 * Actions before setting location as default
			 * @param array $location Location data
			 */
			fn_set_hook('get_location_post', $location);

			db_query('UPDATE ?:bm_locations SET is_default = 0 WHERE 1=1 ?p', $this->get_company_condition('?:bm_locations.company_id'));
			db_query('UPDATE ?:bm_locations SET is_default = 1 WHERE location_id = ?i ?p', $location_id, $this->get_company_condition('?:bm_locations.company_id'));
			return true;
		} else {
			return false;
		}
	}

	/**
	 * Creates or updates location. Returns id of new location or false on fail.
	 * <pre>array (
	 *  location_id - if not exists will be created new record
	 *  dispatch
	 *  description - description data @see BM_Location::_update_description()
	 * )</pre>
	 *
	 * @param array $location_data Array of location data
	 * @return int|db_result Location id if new location was created, DB result otherwise
	 */
	public function update($location_data)
	{
		if (!empty($location_data['is_default']) && $location_data['is_default'] == 'Y') {
			$default = true;
		} else {
			$default = false;
		}

		if (!isset($location_data['company_id']) && $this->_company_id != null && $this->_company_id > 0) {
			$location_data['company_id'] = $this->_company_id;
		}

		// We cannot set the is_default flag
		if (isset($location_data['is_default'])) {
			unset($location_data['is_default']);
		}

		/**
		 * Processes location data before updating it
		 * @param int $location_data Array of location data
		 */
		fn_set_hook('update_location', $location_data);

		$location_id = db_replace_into('bm_locations', $location_data);

		if (!empty($location_data['location_id'])) {
			// Updating location
			$location_id = intval($location_data['location_id']);
			$this->_update_description($location_id, $location_data);

			/**
			 * Actions to be performed after the location is updated
			 * @param int $location_id Location identifier
			 */
			fn_set_hook('location_updated', $location_id);
		} else {
			// Creating location.  We have to create three default containers (top, central, bottom) for this location
			$containers = array();
			foreach (array('TOP', 'CENTRAL', 'BOTTOM') as $position) {
				$containers[] = db_quote('(?i, ?s, ?i)', $location_id, $position, 16);
			}

			db_query('INSERT INTO ?:bm_containers (`location_id`, `position`, `width`) VALUES ' . implode(', ', $containers));

			foreach ((array) Registry::get('languages') as $location_data['lang_code'] => $v) {
				$this->_update_description($location_id, $location_data);
			}

			/**
			 * Actions to be performed after the location is created
			 * @param array $location_id Location identifier
			 */
			fn_set_hook('location_created', $location_id);
		}

		if ($default) {
			$this->set_default($location_id);
		}

		return $location_id;
	}

	/**
	 * Updates description of the location with  <i>$location_id</i>
	 * <i>$description</i> must be array with this keys:
	 * <pre>array (
	 *  lang_code, (requred)
	 *  name, (requred)
	 *  title,
	 *  meta_description,
	 *  meta_keywords,
	 * )</pre>
	 *
	 * @param int $location_id Location identifier
	 * @param array $description Array of description data
	 * @return bool True in success, false otherwise
	 */
	private function _update_description($location_id, $description)
	{
		if (!empty($location_id) && isset($description['name'])) {
			if (!isset($description['lang_code'])) {
				$description['lang_code'] = CART_LANGUAGE;
			}

			$description['location_id'] = $location_id;

			/**
			 * Processes location description before updating it
			 * @param $description
			 */
			fn_set_hook('update_location_description', $location, $dispatch, $lang_code);

			db_replace_into('bm_locations_descriptions', $description);

			return true;
		} else {
			return false;
		}
	}

	/**
	 * Removes non-default location with containers and grids. Set <i>force_removing</i> 
	 * to true to remove default location.
	 *
	 * @param int $location_id Location identifier
	 * @param bool $force_removing Disable default location check
	 * @return bool True in success, false otherwise
	 */
	public function remove($location_id, $force_removing = false)
	{
		if (!empty ($location_id)) {
			$location_data = $this->get_by_id($location_id);
			if (!empty($location_data) && (!$location_data['is_default']) || $force_removing) {
				/**
				 * Actions before removing location
				 * @param int $location_id Location identifier
				 * @param bool $force_removing Disable default location check
				 * @param $description
				 */
				fn_set_hook('remove_location', $location_id, $force_removing);

				db_query('DELETE FROM ?:bm_locations WHERE location_id = ?i', $location_id);
				db_query('DELETE FROM ?:bm_locations_descriptions WHERE location_id = ?i', $location_id);

				Bm_Container::instance()->remove_missing();
				Bm_Grid::remove_missing();

				return true;
			}
		}

		return false;
	}

	/**
	 * Removes non-default location with containers and grids by dispatch.
	 *
	 * @param string $dispatch Location identifier
	 * @return bool True in success, false otherwise
	 */
	public function remove_by_dispatch($dispatch)
	{
		if (!empty ($dispatch)) {
			$location = current($this->get_list(
				array('l.location_id '),
				null,
				db_quote(' AND l.dispatch = ?s LIMIT 1', $dispatch)
			));

			$this->remove($location['location_id']);
		}

		return false;
	}

	/**
	 * Returns descriptions for all languages
	 * 
	 * @param int $location_id Location identifier
	 * @return list of descriptions
	 */
	public function get_all_descriptions($location_id) {
		return db_get_array("SELECT * FROM ?:bm_locations_descriptions WHERE location_id =?i", $location_id);
	}

	/**
	 * Returns object instance if Bm_Location class or create it if not exists
	 * @static
	 * @param int $company_id Company identifier
	 * @return Bm_Location
	 */
	public static function instance($company_id = null, $class_name = 'Bm_Location')
	{
		return parent::instance($company_id, $class_name);
	}
}
?>