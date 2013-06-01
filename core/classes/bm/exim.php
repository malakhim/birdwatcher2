<?php

class Bm_Exim extends CompanySingleton {

	/**
	 * @param SimpleXMLElement $xml_filepath
	 * @return bool
	 */
	public function import_from_file($xml_filepath, $params = array('override_by_dispatch' => true))
	{
		$result = false;

		if (file_exists($xml_filepath)) {
			$structure = @simplexml_load_file($xml_filepath, 'ExSimpleXmlElement', LIBXML_NOCDATA);
			$result = $this->import($structure, $params);
		}

		return $result;
	}

	/**
	 * @param $structure
	 * @param array $params 
	 * @return bool
	 */
	public function import($structure, $params = array('override_by_dispatch' => true))
	{
		if ($structure === false) {
			fn_set_notification('E', fn_get_lang_var('error'), fn_get_lang_var('text_unable_to_parse_xml'));

			return false;
		}
		
		if (empty($structure->location)) {
			// We have no locations and cannot proceed
			return false;
		}

		$settings = (array) $structure->settings;
		if (!empty($params['clean_up'])) {
			$location_ids = Bm_Location::instance($this->_company_id)->get_list(array('*'), '', ' ORDER BY is_default DESC', DESCR_SL);
			$location_ids = array_keys($location_ids);

			foreach ($location_ids as $location_id) {
				Bm_Location::instance($this->_company_id)->remove($location_id, true);
			}
		}
		
		foreach ($structure->location as $location) {
			// Create location first
			$location_attrs = $this->_getNodeAttrs($location);
			if ($this->_company_id != null && $this->_company_id > 0) {
				$location_attrs['company_id'] = $this->_company_id;
			}
			
			// Check if location already exists
			$_existing = array();
			$location_existing = false;
			if (!empty($params['override_by_dispatch'])) {
				$_existing = Bm_Location::instance($this->_company_id)->get($location_attrs['dispatch']);
				$location_existing = ($_existing['dispatch'] == $location_attrs['dispatch']) ? true : false;
			}

			// Imported locations cannot be assingned to dynamic objects
			$location_attrs['object_ids'] = '';

			$location_id = Bm_Location::instance($this->_company_id)->update($location_attrs);
			if (!empty($location_attrs['is_default'])) {
				Bm_Location::instance($this->_company_id)->set_default($location_id);
			}

			if (!empty($location_existing)) {
				Bm_Location::instance($this->_company_id)->remove($_existing['location_id']);
			}

			$_default_containers = Bm_Container::instance($this->_company_id)->get_list($location_id);

			foreach ($location->containers->container as $container) {
				$container_attrs = $this->_getNodeAttrs($container);
				$container_attrs['location_id'] = $location_id;
				$container_attrs['container_id'] = $_default_containers[$container_attrs['position']]['container_id'];
				
				Bm_Container::instance($this->_company_id)->update($container_attrs);
				$container_id = $container_attrs['container_id'];

				if (isset($container->grid)) {
					$this->_parseGridStructure($container, $container_id);
				}
			}

			if (!empty($location->translations)) {
                $avail_langs = array_keys(Registry::if_get('languages', array()));
				foreach ($location->translations->translation as $translation) {
                    $translation_lang_code = (string) $translation['lang_code'];
                    if (!in_array($translation_lang_code, $avail_langs)) {
                        continue;
                    }
					
					$location_attrs = array (
						'location_id' => $location_id,
						'lang_code' => $translation_lang_code,
						'meta_description' => (string) $translation->meta_description,
						'meta_keywords' => (string) $translation->meta_keywords,
						'title' => (string) $translation->page_title,
						'name' => (string) $translation->name,
					);

					Bm_Location::instance($this->_company_id)->update($location_attrs);
				}
			}
		}

		return true;
	}

	public function export($location_ids = array(), $params = array(), $lang_code = DESCR_SL)
	{
		/* Exclude unnecessary fields*/
		$except_location_fields = array(
			'location_id',
			'company_id'
		);
		$except_container_fields = array(
			'container_id',
			'location_id',
			'dispatch',
			'is_default',
			'company_id',
			'default'
		);
		$except_grid_fields = array(
			'container_id',
			'location_id',
			'position',
			'grid_id',
			'parent_id',
			'order',
			'children'
		);
		$except_location_fields = array_flip($except_location_fields);
		$except_container_fields = array_flip($except_container_fields);
		$except_grid_fields = array_flip($except_grid_fields);

		$xml_root = new ExSimpleXmlElement('<block_scheme></block_scheme>');
		$xml_root->addAttribute('scheme', '1.0');

		$settings = $xml_root->addChild('settings');
		$settings->addChild('default_language', $lang_code);

		if (empty($location_ids)) {
			$location_ids = Bm_Location::instance($this->_company_id)->get_list(array('*'), '', ' ORDER BY is_default DESC', $lang_code);
			$location_ids = array_keys($location_ids);
		}

		foreach ($location_ids as $location_id) {
			$location = Bm_Location::instance($this->_company_id)->get_by_id($location_id);
			$containers = Bm_Container::instance($this->_company_id)->get_list($location_id);

			$xml_location = $xml_root->addChild('location');
			$location = array_diff_key($location, $except_location_fields);
			foreach ($location as $attr => $value) {
				$xml_location->addAttribute($attr, $value);
			}

			$xml_containers = $xml_location->addChild('containers');

			$xml_translations = $xml_location->addChild('translations');

			$translations = Bm_Location::instance($this->_company_id)->get_all_descriptions($location_id);

			foreach ($translations as $translation) {
				if ($translation['lang_code'] == $lang_code) {
					// We do not needed default language
					continue;
				}

				$xml_translation = $xml_translations->addChild('translation');
				$xml_translation->addChildCData('meta_keywords', $translation['meta_keywords']);
				$xml_translation->addChildCData('page_title', $translation['title']);
				$xml_translation->addChildCData('meta_description', $translation['meta_description']);
				$xml_translation->addChild('name', $translation['name']);
				$xml_translation->addAttribute('lang_code', $translation['lang_code']);
			}
			
			unset($xml_translations);

			foreach ($containers as $position => $container) {
				$grids = Bm_Grid::get_list($container['container_id']);

				$xml_container = $xml_containers->addChild('container');
				foreach ($container as $attr => $value) {
					$xml_container->addAttribute($attr, $value);
				}

				if (!empty($grids) && isset($grids[$container['container_id']])) {
					$grids = $grids[$container['container_id']];
					$grids = fn_build_hierarchic_tree($grids, 'grid_id');

					$container = array_diff_key($container, $except_container_fields);

					$this->_buildGridStructure($xml_container, $grids, $except_grid_fields, $lang_code);
				}
			}
		}

		return $xml_root->asXML();
	}

	public function getUniqueBlockKey($type, $properties, $name)
	{
		$key = array(
			'type' => $type,
			'properties' => $properties,
			'name' => $name
		);

		if ($this->_company_id != null && $this->_company_id > 0) {
			$key['company_id'] = $this->_company_id;
		}

		return md5(serialize($key));
	}

	private function _getNodeAttrs($xml_node, $use_attr_param = true)
	{
		$attrs = array();

		if ($use_attr_param) {
			foreach ($xml_node->attributes() as $attr => $value) {
				$attrs[$attr] = (string) $value;
			}
		} else {
			if ($xml_node->exCount() > 0)  {
				foreach ($xml_node->children() as $child_node) {
					if ($child_node->exCount() > 0) {
						$attrs[$child_node->getName()] = $this->_getNodeAttrs($child_node, false);
					} else {
						$attrs[$child_node->getName()] = (string) $child_node;
					}
				}
			} else {
				$attrs = (string) $xml_node;
			}
			
			if (is_array($attrs) && empty($attrs)) {
				$attrs = '';
			}
		}

		return $attrs;
	}

	private function _parseGridStructure(&$xml_node, $container_id, $parent_id = 0)
	{
		foreach ($xml_node->grid as $grid) {
			if (!empty($grid)) {
				$grid_attrs = $this->_getNodeAttrs($grid);
				$grid_attrs['container_id'] = $container_id;
				$grid_attrs['parent_id'] = $parent_id;
				
				$grid_id = Bm_Grid::update($grid_attrs);
				
				if (isset($grid->grid)) {
					$this->_parseGridStructure($grid, $container_id, $grid_id);
				}

				if (!empty($grid->blocks)) {
					$this->_parseBlockStructure($grid_id, $grid->blocks);
				}
			}
		}
	}

	private function _parseBlockStructure($grid_id, $blocks)
	{
		$unique_blocks = array();
		$langs = Registry::if_get('languages', array());

		$_unique = Bm_Block::instance($this->_company_id)->get_all_unique();

		if (!empty($_unique)) {
			foreach ($_unique as $block_id => $block) {
				$key = $this->getUniqueBlockKey($block['type'], $block['properties'], $block['name']);

				$unique_blocks[$key] = $block_id;
			}
		}
		
		$order = 0;
		foreach ($blocks->block as $block) {
			$block_data = $this->_getNodeAttrs($block, false);
			
			if ($this->_company_id != null && $this->_company_id > 0) {
				$block_data['company_id'] = $this->_company_id;
			}

			$key = $this->getUniqueBlockKey($block_data['type'], $block_data['properties'], $block_data['name']);

			if (isset($unique_blocks[$key])) {
				$block_id = $unique_blocks[$key];
			} else {
				if (isset($block_data['content'])) {
					$block_data['content_data']['content'] = $block_data['content'];
				} else {
					$block_data['content_data']['content'] = array('empty');
				}

				$block_id = Bm_Block::instance($this->_company_id)->update($block_data, $block_data);
			}

			$snapping_data = array(
				'block_id' => $block_id,
				'grid_id' => $grid_id,
				'wrapper' => isset($block_data['wrapper']) ? $block_data['wrapper'] : '',
				'user_class' => isset($block_data['user_class']) ? $block_data['user_class'] : '',
				'order' => isset($block_data['order']) ? $block_data['order'] : $order,
				'status' => !empty($block_data['status']) ? $block_data['status'] : 'A',
			);
			$snapping_id = Bm_Block::instance($this->_company_id)->update_snapping($snapping_data);

			$this->_importDynamicStatuses($snapping_id, $block_data);
			$this->_importContent($block_id, $snapping_id, $block);

			if (!empty($block->translations)) {
				
				foreach ($block->translations->translation as $translation) {
					$lang_code = (string)$translation['lang_code'];

					if (isset($langs[$lang_code])) {
						Bm_Block::instance($this->_company_id)->update(
							array (
								'block_id' => $block_id
							), 
							array (
								'name' => (string) $translation,
								'lang_code' => $lang_code
							)
						);
					}
				}
			}

			$order++;
		}
	}

	/**
	 * Imports block statuses on dynamic obejcts
	 *
	 * @param int $snapping_id Snapping identifier
	 * @param array $block_data Array of product data
	 * @return bool True on success, false otherwise
	 */
	private function _importDynamicStatuses($snapping_id, $block_data)
	{
		if (!empty($block_data['statuses']) && is_array($block_data['statuses'])) {
			foreach($block_data['statuses'] as $object_type => $object_ids) {
				Bm_Block::instance($this->_company_id)->update_statuses(
					array(
						'snapping_id' => $snapping_id,
						'object_type' => $object_type,
						'object_ids' => $object_ids
					)
				);
			}

			return true;
		} else {
			return false;
		}
	}

	private function _importContent($block_id, $snapping_id, $block_data)
	{
		if (isset($block_data->contents)) {
			foreach ($block_data->contents->item as $content) {
				$_content = $this->_getNodeAttrs($content, false);
				$_content['snapping_id'] = $snapping_id;

				$data = array (
					'block_id' => $block_id,
					'type' => (string) $block_data->type,
					'content_data' => $_content
				);

				if (!empty($_content['lang_code'])) {
					$data['content_data']['lang_code'] = $_content['lang_code'];
				}

				Bm_Block::instance($this->_company_id)->update($data);
			}

			return true;
		} else {
			return false;
		}
	}

	private function _buildAttrStructure(&$parent, $attrs)
	{		
		foreach ($attrs as $attr => $value) {
			// items_array is exploded by comma item_ids. So it's not needed.
			if (($attr == 0 && $value == 'empty') || $attr == 'items_array' || $attr == 'items_count') {
				// Skip empty values
				continue;
			}

			if (is_array($value)) {
				$xml_attr = $parent->addChild($attr);
				$this->_buildAttrStructure($xml_attr, $value);

			} else {
				$child = $parent->addChild($attr);
				$node = dom_import_simplexml($child);
				$no = $node->ownerDocument;
				$node->appendChild($no->createCDATASection($value)); 
			}
		}
	}

	private function _buildGridStructure(&$parent, $grids, $except_fields = array(), $lang_code = DESCR_SL)
	{
		$except_block_fields = array_flip(array(
			'block_id',
			'snapping_id',
			'grid_id',
			'company_id'
		));

		foreach ($grids as $grid) {
			$xml_grid = $parent->addChild('grid');
			$blocks = Bm_Block::instance($this->_company_id)->get_list(array('?:bm_snapping.*', '?:bm_blocks.*'), array($grid['grid_id']));

			if (!empty($blocks)) {
				$blocks = $blocks[$grid['grid_id']];
			}
			
			$attrs =  array_diff_key($grid, $except_fields);
			foreach ($attrs as $attr => $value) {
				$xml_grid->addAttribute($attr, $value);
			}

			if (!empty($grid['children'])) {
				$grid['children'] = fn_sort_array_by_key($grid['children'], 'grid_id');
				$this->_buildGridStructure($xml_grid, $grid['children'], $except_fields, $lang_code);
			}

			if (!empty($blocks)) {
				$xml_blocks = $xml_grid->addChild('blocks');

				foreach ($blocks as $block_id => $block) {
					$block_descr = Bm_Block::instance($this->_company_id)->get_full_description($block['block_id']);
					$block = array_merge(Bm_Block::instance($this->_company_id)->get_by_id($block['block_id']), $block);
					$block = array_diff_key($block, $except_block_fields);
					
					$xml_block = $xml_blocks->addChild('block');
					$this->_buildAttrStructure($xml_block, $block);

					$xml_translations = $xml_block->addChild('translations');
					foreach ($block_descr as $_lang_code => $data) {
						if ($_lang_code == $lang_code) {
							// We do not needed default language
							continue;
						}

						$xml_translation = $xml_translations->addChild('translation', $data['name']);
						$xml_translation->addAttribute('lang_code', $_lang_code);
						unset($xml_translation);
					}
					
					$contents = Bm_Block::instance($this->_company_id)->get_all_contents($block_id);
					$xml_contents = $xml_block->addChild('contents');
					foreach ($contents as $content) {
						if (!empty($content['lang_code']) && $content['lang_code'] == $lang_code) {
							continue;
						}

						if (!empty($content['content'])) {
							$this->_buildAttrStructure($xml_contents , array('item' => array_diff_key($content, $except_block_fields)));
						}
					}
				}
			}
		}
	}

	/**
	 * Returns object instance if Bm_Exim class or create it if not exists
	 * @static
	 * @param int $company_id Company identifier
	 * @return Bm_Exim
	 */
	public static function instance($company_id = null, $class_name = 'Bm_Exim')
	{
		return parent::instance($company_id, $class_name);
	}
}

?>