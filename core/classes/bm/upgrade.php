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

class Bm_Upgrade extends CompanySingleton {
	public $old_db;
	public $new_db;

	public function upgrade(){
		$this->connect_to_old_db();

		$groups = db_get_hash_array("SELECT * FROM ?:blocks WHERE block_type = 'G' and location = 'all_pages'", 'block_id');
		$positions = db_get_array("SELECT * FROM ?:block_positions WHERE block_id IN (?n) and location = 'all_pages' ORDER BY position", array_keys($groups));

		$this->connect_to_new_db();

		$location = Bm_Location::instance()->update(array(
			'dispatch' => '',
			'is_default' => 1
		));
		p($location);
//		$containers = Bm_Container::instance()->get_list_by_area($location['location_id'], 'C');
		/*
			Bm_Grid::update(array (
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
			 * ));*/
			foreach($groups as $group) {
				p($group);
				p(unserialize($group['properties']));
			}
	}

	public function clear_tables() {
		db_query("TRUNCATE  `?:bm_blocks`");
		db_query("TRUNCATE  `?:bm_blocks_content`");
		db_query("TRUNCATE  `?:bm_blocks_descriptions`");
		db_query("TRUNCATE  `?:bm_containers`");
		db_query("TRUNCATE  `?:bm_grids`");
		db_query("TRUNCATE  `?:bm_grids_descriptions`");
		db_query("TRUNCATE  `?:bm_locations`");
		db_query("TRUNCATE  `?:bm_locations_descriptions`");
		db_query("TRUNCATE  `?:bm_snapping`");
	}

	private function connect_to_old_db() {
		p($this->new_db);
		p($this->old_db);
	// /	Registry::set('runtime.dbs.main', $this->old_db);
	}

	private function connect_to_new_db() {
		Registry::set('runtime.dbs.main', $this->new_db);
	}

	/**
	 * Returns object instance if Bm_Container class or create it if not exists
	 * @static
	 * @param int $company_id Company identifier
	 * @return Bm_Container
	 */
	public static function instance($old_db_name, $company_id = null)
	{
		$object = parent::instance($company_id, 'Bm_Upgrade');

		$object->new_db = Registry::get('runtime.dbs.main');
		//$object->old_db = db_initiate(Registry::get('config.db_host'), Registry::get('config.db_user'), Registry::get('config.db_password'), $old_db_name);

		return $object;
	}
}