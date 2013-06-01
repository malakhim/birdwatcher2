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

class Stores_Import_Blocks
{
	private $store_data = array();

	public function __construct($store_data)
	{
		$this->store_data = $store_data;
	}

	public function getXmlLocationsScheme($lang_code = CART_LANGUAGE)
	{
		$locations = $this->_getLocations();
		$descriptions = Bm_SchemesManager::get_dispatch_descriptions();
		$importing_location_text = fn_get_lang_var('es_import_location');

		$new_db = Stores_Import_General::connectToImportedDB($this->store_data);

		if ($new_db != null) {
			$structure = new ExSimpleXmlElement('<?xml version="1.0"?><block_scheme scheme="1.0"></block_scheme>');
			$settings = $structure->addChild('settings');
			$settings->addChild('default_language', $lang_code);
			unset($settings);

			foreach ($locations as $location => $controllers) {
				foreach ($controllers as $controller => $mode) {
					$dispatch = empty($mode) ? $controller : $controller .  '.' . $mode;

					fn_set_progress('echo', $importing_location_text . ': ' . $dispatch, false);

					$xml_location = $structure->addChild('location');
					$xml_location->addAttribute('dispatch', $dispatch);
					$xml_location->addAttribute('is_default', ($location == 'all_pages' ? '1' : '0'));
					$xml_location->addAttribute('lang_code', $lang_code);
					$xml_location->addAttribute('name', fn_get_lang_var($location, $lang_code));

					// FIXME: Bad idea to use in xml enumaration types and non enumerations types in one container
					$xml_translations = $xml_location->addChild('translations');
					$translations_all_pages = db_get_hash_multi_array(
						"SELECT * FROM ?:block_location_descriptions WHERE location = 'all_pages'",
						array('lang_code', 'property', 'description'),
						$location
					);
					$translations = db_get_hash_multi_array(
						"SELECT * FROM ?:block_location_descriptions WHERE location = ?s",
						array('lang_code', 'property', 'description'),
						$location
					);
					$translations = fn_array_merge($translations_all_pages, $translations);

					foreach ($translations as $_lang_code => $translation) {
						$xml_translation = $xml_translations->addChild('translation');
						$xml_translation->addChildCData('meta_keywords', $translation['meta_keywords']);
						$xml_translation->addChildCData('page_title', $translation['page_title']);
						$xml_translation->addChildCData('meta_description', $translation['meta_description']);
						$xml_translation->addChild('name', fn_get_lang_var($location, $_lang_code));
						$xml_translation->addAttribute('lang_code', $_lang_code);
					}

					unset($xml_translations);

					$xml_containers = $xml_location->addChild('containers');

					$xml_containers->appendXML($this->_getDefaultTop($location));

					$central_container = $xml_containers->addChild('container');
					$central_container->addAttribute('position', 'CENTRAL');
					$central_container->addAttribute('width', '16');

					$xml_containers->appendXML($this->_getDefaultBottom($location));

					/* Get 2.2.x blocks structure */
					$groups = db_get_hash_array(
						"SELECT * FROM ?:blocks "
						. "WHERE block_type = 'G' AND status = 'A' AND (location = 'all_pages' OR location = ?s) "
						. "ORDER BY block_id",
						'block_id', $location
					);

					$positions = db_get_hash_array(
						"SELECT * FROM ?:block_positions "
						. "WHERE block_id IN (?n) AND (location = 'all_pages' OR location = ?s) "
						. "ORDER BY position",
						'group_id', array_keys($groups), $location
					);

					$count = 0;
					$central_width = 10;

					foreach ($groups as $group) {
						if ($group['text_id'] != '' && $group['text_id'] != 'product_details' && $group['text_id'] != 'central_content') {
							$container = &$central_container;

							if ($group['text_id'] == 'left' || $group['text_id'] == 'right') {
								$width = 3;
							} elseif ($group['text_id'] == 'central') {
								$width = 10;
							} else {
								$width = 16;
							}

							if ($this->_isGroupEnabled($location, $group)) {
								$this->_addGrid($container, $location, $group, $width, $lang_code);
							} elseif ($group['text_id'] == 'left' || $group['text_id'] == 'right') {
								$central_width = $central_width + 3;
							}

							unset($container);
						}
					}

					// Set central grid width
					foreach ($central_container->grid as $grid) {
						if ($grid['width'] == 10) {
							$grid['width'] = $central_width;
						}
					}

					unset($grid);
				}
			}

			return $structure;
		}
	}

	/**
	 * Returns old locations list of  location => controller => modes format
	 * @return array locations list
	 */
	protected static function _getLocations()
	{
		/*		    [all_pages] => all_pages
		[products] => product_id
		[categories] => category_id
		[pages] => page_id
		[index] => home_page
		[cart] => cart
		[checkout] => checkout
		[order_landing_page] => order_landing_page
		[news] => news_id*/
		return array(
			'all_pages' => array(
				'default' => ''
			),
			'checkout' => array(
				'checkout' => '',
			),
			'products' => array(
				'products' => 'view'
			),
			'categories' => array(
				'categories' => 'view'
			),
			'pages' => array(
				'pages' => 'view'
			),
			'index' => array(
				'index' => 'index'
			),
			'cart' => array(
				'checkout' => 'cart'
			),
			'order_landing_page' => array(
				'checkout' => 'complete'
			),
		);
	}

	/**
	 * Checks that $group enabled on $location
	 *
	 * @return bool True if $group enabled on $location
	 */
	protected function _isGroupEnabled($location, $group)
	{
		if ($group['status'] == 'D') {
			return false;
		}

		$group['disabled_locations'] = explode(',', $group['disabled_locations']);
		return array_search($location, $group['disabled_locations']) === FALSE;
	}

	protected function _addGrid(&$container, $location, $group, $width, $lang_code)
	{
		$properties = unserialize($group['properties']);

		$xml_grid = $container->addChild('grid');
		$xml_grid->addAttribute('width', $width);
		$xml_grid->addAttribute('suffix', '0');
		$xml_grid->addAttribute('prefix', '0');
		@$xml_grid->addAttribute('user_class', '');
		$xml_grid->addAttribute('omega', '0');
		$xml_grid->addAttribute('alpha', '0');
		@$xml_grid->addAttribute('wrapper', $this->_getWrapperByLocation($properties, $location));
		$xml_grid->addAttribute('content_align', $this->_getBlockOrderByLocation($properties, $location));
		$xml_grid->addAttribute('html_element', 'div');
		$xml_grid->addAttribute('clear', (($group['text_id'] == 'top' || $group['text_id'] == 'right' || $group['text_id'] == 'bottom') ? '1' : '0'));

		$sub_groups = db_get_hash_array(
			"SELECT * FROM ?:blocks "
			. "LEFT JOIN ?:block_positions "
				. "ON ?:blocks.block_id = ?:block_positions.block_id AND ?:blocks.location = ?:block_positions.location "
			. "WHERE block_type = 'G' AND status = 'A' AND (?:blocks.location = 'all_pages' OR ?:blocks.location = ?s) "
				. "AND ?:blocks.text_id != 'product_details' AND group_id = ?i ORDER BY ?:blocks.block_id",
			'group_id', $location, $group['block_id']
		);

		if (empty($sub_groups)) {
			$xml_blocks = $xml_grid->addChild('blocks');
			$this->_addBlocks($xml_blocks, $group, $location, $lang_code);
		} else {
			foreach ($sub_groups as $sub_group) {
				$this->_addGrid($xml_grid, $location, $sub_group, $width, $lang_code);
			}
		}
	}

	protected function _getWrapperByLocation($properties, $location = 'all_pages')
	{
		$wrapper = '';

		if (!empty($properties[$location]['wrapper'])) {
			$wrapper = $properties[$location]['wrapper'];
		} elseif (!empty($properties['all_pages']['wrapper'])) {
			$wrapper = $properties['all_pages']['wrapper'];
		}

		return $wrapper;
	}

	protected function _getBlockOrderByLocation($properties, $location = 'all_pages')
	{
		$block_order = '';

		if (!empty($properties[$location]['block_order'])) {
			$block_order = $properties[$location]['block_order'];
		} elseif (!empty($properties['all_pages']['block_order'])) {
			$block_order = $properties['all_pages']['block_order'];
		}

		if ($block_order == 'H') {
			$block_order = 'LEFT';
		} else {
			$block_order = 'FULL_WIDTH';
		}

		return $block_order;
	}

	protected function _addBlocks(&$xml_blocks, $group, $location, $lang_code)
	{
		$blocks = $this->_getOldBlocksByGroup($location, $group['block_id'], $lang_code);

		foreach ($blocks as $block) {
			if (empty($block['text_id']) || $block['text_id'] == 'central_content') {
				$prop = unserialize($block['properties']);
				if (!empty($prop['list_object']) || $block['text_id'] == 'central_content') {
					$func = $this->_returnConvertFunction(!empty($prop['list_object']) ? $prop['list_object'] : 'central_content');
					$xml_block = $xml_blocks->addChild('block');
					$this->_eximBuildNode($xml_block, call_user_func(array($this, $func), $block, $lang_code, $location));
					$this->_buildBlocksTranslations($xml_block, $block);
					$this->_buildBlocksContents($xml_block, $location, $block);
				}
			}
		}
	}

	protected function _getOldBlocksByGroup($location, $group_id, $lang_code)
	{
		$blocks_on_all_pages = db_get_hash_array(
			"SELECT ?:blocks.text_id, ?:block_positions.group_id, ?:blocks.block_id, ?:blocks.location, "
				."?:blocks.disabled_locations, ?:blocks.status, ?:block_descriptions.lang_code, "
				."?:blocks.properties, ?:block_descriptions.description, ?:block_positions.position FROM ?:blocks "
			. "LEFT JOIN ?:block_descriptions "
				. "ON ?:blocks.block_id = ?:block_descriptions.block_id AND ?:block_descriptions.object_type = 'B' "
				."AND ?:block_descriptions.lang_code = ?s "
			. "LEFT JOIN ?:block_positions "
				. "ON ?:blocks.block_id = ?:block_positions.block_id AND ?:blocks.location = ?:block_positions.location "
			. "WHERE block_type = 'B' AND ?:blocks.location = 'all_pages' "
				 . "AND ?:block_positions.group_id =?i ORDER BY ?:block_positions.position ASC",
			'block_id', $lang_code, $group_id
		);

	    $blocks = db_get_hash_array(
			 "SELECT ?:blocks.text_id, ?:block_positions.group_id, ?:blocks.block_id, ?:blocks.location, "
				."?:blocks.disabled_locations, ?:blocks.status, ?:block_descriptions.lang_code, "
				."?:blocks.properties, ?:block_descriptions.description, ?:block_positions.position FROM ?:blocks "
			. "LEFT JOIN ?:block_descriptions "
				. "ON ?:blocks.block_id = ?:block_descriptions.block_id AND ?:block_descriptions.object_type = 'B' "
				."AND ?:block_descriptions.lang_code = ?s "
			. "LEFT JOIN ?:block_positions "
				   . "ON ?:blocks.block_id = ?:block_positions.block_id AND (?:block_positions.location = ?s) AND ?:block_positions.object_id = 0 "
		   . "WHERE block_type = 'B' AND (?:blocks.location = ?s OR ?:blocks.location = 'all_pages') "
					. "AND ?:block_positions.group_id =?i GROUP BY ?:block_positions.block_id ORDER BY ?:block_positions.position ASC",
		   'block_id', $lang_code, $location, $location, $group_id
		);

		$blocks = fn_array_merge($blocks_on_all_pages, $blocks);

		foreach ($blocks as $block_id => $block_data) {
			$is_this_block_in_another_group_on_location = db_get_field (
				"SELECT COUNT(*) FROM ?:block_positions WHERE block_id = ?i AND location = ?s AND group_id <> ?i AND object_id = 0",
				$block_id, $location,  $group_id
			);

			if ($is_this_block_in_another_group_on_location == 1) {
				unset($blocks[$block_id]);
			} else {
				$disabled_locations = explode(',', $block_data['disabled_locations']);

				$position = db_get_field (
					"SELECT position FROM ?:block_positions WHERE block_id = ?i AND location = ?s AND group_id = ?s",
					$block_id, $location,  $group_id
				);

				$blocks[$block_id]['position'] = $position;

				if (array_search($location, $disabled_locations) !== false) {
					$blocks[$block_id]['status'] = 'D';
				}
			}
		}

		return $blocks;
	}

	protected function _returnConvertFunction($list_object)
	{
		$convert_scheme = array(
			'products' => '_convertDynamicObjectBlock',
			'categories' => '_convertDynamicObjectBlock',
			'pages' => '_convertDynamicObjectBlock',
			'product_filters' => '_convertDynamicObjectBlock',
			'payment_methods' => '_convertDynamicObjectBlock',
			'shipping_methods' => '_convertDynamicObjectBlock',
			'tags' => '_convertDynamicObjectBlock',
			'news' => '_convertDynamicObjectBlock',
			'mailing_lists' => '_convertMailingListsBlock',
			'polls' => '_convertDynamicObjectBlock',
			'banners' => '_convertDynamicObjectBlock',
			'vendors' => '_convertDynamicObjectBlock',
			'blocks/feature_comparison.tpl' => '_convertTemplateBlock',
			'blocks/my_account.tpl' => '_convertMyAccountBlock',
			'blocks/products_central_banner.tpl' => '_convertTemplateBlock',
			'blocks/search.tpl' => '_convertTemplateBlock',
			'blocks/shipping_estimation.tpl' => '_convertTemplateBlock',
			'addons/live_help/blocks/livehelp.tpl' => '_convertLiveHelpBlock',
			'addons/affiliate/blocks/affiliate.tpl' => '_convertAffiliateBlock',
			'addons/gift_registry/blocks/giftregistry.tpl' => '_convertGiftRegistryBlock',
			'addons/gift_registry/blocks/giftregistry_key.tpl' => '_convertGiftRegistryKeyBlock',
			'addons/store_locator/blocks/store_locator.tpl' => '_convertTemplateBlock',
			'addons/discussion/blocks/testimonials.tpl' => '_convertTestimonialsBlock',
			'blocks/html_block.tpl' => '_convertHtmlBlock',
			'blocks/unique_html_block.tpl' => '_convertHtmlBlock',
			'blocks/rss_feed.tpl' => '_convertRssBlock'
		);

		return isset($convert_scheme[$list_object]) ? $convert_scheme[$list_object] : '_convertBlock';
	}

	protected function _eximBuildNode(&$node, $values)
	{
		foreach ($values as $key => $value) {
			if (is_array($value)) {
				if (is_int($key)) {
					$key = 'item';
				}

				$_node = $node->addChild($key);
				$this->_eximBuildNode($_node, $value);
			} else {
				if (!empty($key)) {
					 if (!empty($value)) {
						$child = $node->addChild($key);
						$cdata_node = dom_import_simplexml($child);
						$no = $cdata_node->ownerDocument;
						$cdata_node->appendChild($no->createCDATASection($value));
					} else {
						$node->addChild($key, $value);
					}
				}
			}
		}
	}

	protected function _getReplacments()
	{
		return array(
			'products' => array(
				'fillings' => array(
					'popularity' => 'most_popular'
				),
				'templates' => array(
					'blocks/products_text_links.tpl' => 'blocks/products/products_text_links.tpl',
					'blocks/products_links_thumb.tpl' => 'blocks/products/products_links_thumb.tpl',
					'blocks/products_multicolumns.tpl' => 'blocks/products/products_multicolumns.tpl',
					'blocks/products_multicolumns2.tpl' => 'blocks/products/products_multicolumns2.tpl',
					'blocks/products_multicolumns_small.tpl' => 'blocks/products/products_multicolumns_small.tpl',
					'blocks/products.tpl' => 'blocks/products/products.tpl',
					'blocks/products2.tpl' => 'blocks/products/products2.tpl',
					'blocks/products_sidebox_1_item.tpl' => 'blocks/products/products_sidebox_1_item.tpl',
					'blocks/products_small_items.tpl' => 'blocks/products/products_sidebox_1_item.tpl',
					'blocks/products_without_image.tpl' => 'blocks/products/products_without_image.tpl',
					'blocks/products_scroller.tpl' => 'blocks/products/products_scroller.tpl',
					'blocks/products_scroller2.tpl' => 'blocks/products/products_scroller.tpl',
					'blocks/products_scroller3.tpl' => 'blocks/products/products_scroller.tpl',
					'blocks/short_list.tpl' => 'blocks/products/short_list.tpl',
					'blocks/grid_list.tpl' => 'blocks/products/grid_list.tpl',
					'addons/hot_deals_block/blocks/hot_deals.tpl' => 'blocks/products/products_scroller.tpl'
				)
			),
			'categories' => array(
				'fillings' => array(
					'emenu' => 'full_tree_cat',
					'plain' => 'full_tree_cat',
					'dynamic' => 'dynamic_tree_cat',
				),
				'templates' => array(
					'blocks/categories_text_links.tpl' => 'blocks/categories/categories_text_links.tpl',
					'blocks/categories_emenu.tpl' =>  'blocks/categories/categories_dropdown_vertical.tpl',
					'blocks/categories_dynamic.tpl' => 'blocks/categories/categories_text_links.tpl',
					'blocks/categories_plain.tpl' =>  'blocks/categories/categories_dropdown_horizontal.tpl',
					'blocks/categories_multicolumns.tpl' => 'blocks/categories/categories_multicolumn_list.tpl',
				),
			),
			'pages' => array(
				'fillings' => array(
					'dynamic' => 'dynamic_tree_pages',
					'child_pages' => 'full_tree_pages'
				),
				'templates' => array(
					'blocks/pages_text_links.tpl' => 'blocks/pages/pages_text_links.tpl',
					'blocks/pages_dynamic.tpl' =>  'blocks/pages/pages_dropdown.tpl',
					'blocks/pages_child.tpl' => 'blocks/pages/pages_emenu.tpl',
				)
			),
			'product_filters' => array(
				'templates' => array(
					'blocks/product_filters.tpl' => 'blocks/product_filters/original.tpl',
					'blocks/product_filters_extended.tpl' =>  'blocks/product_filters/custom.tpl',
				)
			),
			'mailing_lists' => array(
				'templates' => array(
					'addons/news_and_emails/blocks/subscribe.tpl' => 'addons/news_and_emails/blocks/static_templates/subscribe.tpl',
				)
			),
		);
	}

	protected function _getFillingsSettings()
	{
		return array(
			'newest' => array(
				'period' => 'any_date',
				'last_days' => 1,
				'limit' => 3,
			),
			'filters' => array(
				'filter_id' => 0
			),
			'recent_products' => array(
				'limit' => 3,
			),
			'popularity' => array(
				'limit' => 3,
			),
			'also_bought' => array(
				'limit' => 3,
			),
			'bestsellers' => array(
				'limit' => 3,
			),
			'rating' => array(
				'limit' => 3,
			),
			'dynamic_tree_cat' => array(
				'parent_category_id' => 0
			),
			'full_tree_cat' => array(
				'parent_category_id' => 0
			),
			'dynamic_tree_pages' => array(
				'parent_page_id' => 0
			),
			'full_tree_pages' => array(
				'parent_page_id' => 0
			),
			'tag_cloud' => array(
				'limit' => 3,
			),
			'news_plain' => array(
				'limit' => 3,
			),
		);
	}

	protected function _unsetIfIsset($array, $param)
	{
		if (isset($array[$param])) {
			unset($array[$param]);
		}

		return $array;
	}

	public function getBlockData($block, $lang_code)
	{
		$prop = unserialize($block['properties']);
		if (!empty($prop['list_object']) || $block['text_id'] == 'central_content') {
			$func = $this->_returnConvertFunction($prop['list_object']);

			return call_user_func(array($this, $func), $block, $lang_code);
		}
	}

	protected function _convertProperties($properties)
	{
		if (!empty($properties['list_object'])) {
			$replacments = $this->_getReplacments();
			if (!empty($replacments[$properties['list_object']])) {
				$replacment = $replacments[$properties['list_object']];
				if (!empty($replacment['fillings'][$properties['fillings']])) {
					$properties['fillings'] = $replacment['fillings'][$properties['fillings']];
				}

				if (!empty($replacment['templates'][$properties['appearances']])) {
					$properties['appearances'] = $replacment['templates'][$properties['appearances']];
				}
			}
		}

		return $properties;
	}

	protected function _convertBlock($old_block, $location)
	{
		$properties = $this->_convertProperties(unserialize($old_block['properties']));

		$statuses = $this->_getBlockStatuses($old_block);

		$block = array(
			'name' => $old_block['description'],
			'lang_code' => $old_block['lang_code'],
			'wrapper' => isset($properties['wrapper']) ? $properties['wrapper'] : '',
			'order' => $old_block['position'],
			'status' => empty($statuses['object_ids']) ? $old_block['status'] : $statuses['main_status'],
			'properties' => array(),
			'content' => array(),
			'user_class' => '',
			'statuses' => array(
				$statuses['object_type'] => $statuses['object_ids'],
			),
		);
		
		Stores_Import_General::connectToOriginalDB();
		$block_scheme = Bm_SchemesManager::get_block_scheme($properties['list_object'], array());
		Stores_Import_General::connectToImportedDB($this->store_data);

		if(!empty($block_scheme['templates'][$properties['appearances']]['settings'])) {
			$default_properties = array();

			foreach ($block_scheme['templates'][$properties['appearances']]['settings'] as $name => $value) {
				$default_properties[$name] = isset($value['default_value']) ? $value['default_value'] : '';
			}

			$properties = fn_array_merge($default_properties, $properties);
		}

		if ($old_block['text_id'] == 'central_content') {
			$block['type'] = 'main';
			$block['wrapper'] = $this->_getWrapperByLocation($properties, $location);
		}

		// Clear properties
		$properties = $this->_unsetIfIsset($properties, 'wrapper');
		$properties = $this->_unsetIfIsset($properties, 'list_object');
		$properties = $this->_unsetIfIsset($properties, 'appearances');
		$properties = $this->_unsetIfIsset($properties, 'fillings');
		$properties = $this->_unsetIfIsset($properties, 'width');
		$properties = $this->_unsetIfIsset($properties, 'width_unit');
		$properties = $this->_unsetIfIsset($properties, 'content_type');
		$properties = $this->_unsetIfIsset($properties, 'all_pages');

		$block['properties'] = $properties;

		return $block;
	}

	protected function _buildBlocksTranslations(&$xml_block, $old_block)
	{
		$translations = array();

		$_translations = db_get_array(
			"SELECT * FROM ?:block_descriptions WHERE block_id = ?i AND object_text_id = '' AND object_type  = 'B'",
			$old_block['block_id']
		);

		$xml_translations = $xml_block->addChild('translations');

		foreach ($_translations as $translation) {
			$xml_translation = $xml_translations->addChildCData('translation', $translation['description']);

			$xml_translation->addAttribute('lang_code', $translation['lang_code']);
			unset($xml_translation);
		}
	}

	protected function _getBlockStatuses($old_block)
	{
		$object_ids = array();

		$dynamic_object = db_get_field("SELECT location FROM ?:block_links WHERE block_id = ?i", $old_block['block_id']);
		if (!empty($dynamic_object)) {
			$enabled = db_get_fields("SELECT object_id FROM ?:block_links WHERE block_id = ?i AND enable = 'Y'", $old_block['block_id']);
			$disabled = db_get_fields("SELECT object_id FROM ?:block_links WHERE block_id = ?i AND enable = 'N'", $old_block['block_id']);

			// Some code for optimisation.
			// If we have 0 disabled or enabled objects we can fo not store object ids. We need to set only main status.
			if (version_compare($this->store_data['product_version'], '3', '<')) {
                if (count($enabled) >= count($disabled) || count($disabled)) {
                    $main_status = 'D';
                    $object_ids = $enabled;
                } else {
                    $main_status = 'A';
                    $object_ids = $disabled;
                }
            } else {
                if (count($enabled) >= count($disabled) || count($disabled)) {
                    $main_status = 'A';
                    $object_ids = $disabled;
                } else {
                    $main_status = 'D';
                    $object_ids = $enabled;
                }
            }
            
		} else {
			$main_status = db_get_field("SELECT enable FROM ?:block_links WHERE block_id = ?i", $old_block['block_id']);
			$main_status = ($main_status == 'Y') ? 'A' : 'D';
		}

		return array(
			'main_status' => $main_status,
			'object_type' => $dynamic_object,
			'object_ids' => implode(',', $object_ids)
		);
	}

	protected function _buildBlocksContents(&$xml_block, $location, $old_block)
	{
		$properties = $this->_convertProperties(unserialize($old_block['properties']));

		$xml_contents = $xml_block->addChild('contents');

		$contents = db_get_array(
			"SELECT * FROM ?:block_links WHERE block_id = ?i AND item_ids != '' AND location = ?s AND object_id > 0",
			$old_block['block_id'], $location
		);

		foreach ($contents as $content) {
			if ($content['object_id'] > 0) {
				$xml_item = $xml_contents->addChild('item');
				$xml_item->addChild('object_id', $content['object_id']);
				$xml_content = $xml_item->addChild('content');
				$xml_content_items = $xml_content->addChild('items');
				$xml_content_items->addChildCData('item_ids', $content['item_ids']);
				$xml_content_items->addChildCData('filling', $properties['fillings']);
				$xml_item->addChild('object_type', $content['location']);
			}
		}

		$html_content = db_get_array (
			"SELECT * FROM ?:block_descriptions "
				. "LEFT JOIN ?:block_links ON ?:block_links.block_id = ?:block_descriptions.block_id "
				. "AND ?:block_links.object_id = ?:block_descriptions.object_id "
			. "WHERE ?:block_descriptions.block_id = ?i AND object_text_id = 'block_text'",
			$old_block['block_id']
		);

		foreach ($html_content as $content) {
			$xml_item = $xml_contents->addChild('item');
			$xml_item->addChild('object_id', $content['object_id']);
			$xml_item->addChild('lang_code', $content['lang_code']);
			$xml_content = $xml_item->addChild('content');
			$xml_content->addChildCData('content', $content['description']);
			if ($content['object_id'] > 0) {
				$xml_item->addChild('object_type', $content['location']);
			}
		}

		return $contents;
	}

	protected function _convertDynamicObjectBlock($old_block, $lang_code, $location)
	{
		$properties = $this->_convertProperties(unserialize($old_block['properties']));

		$fillings_settings = $this->_getFillingsSettings();

		$block = $this->_convertBlock($old_block, $location);
		$block = fn_array_merge($block, array(
			'type' => $properties['list_object'],
			'properties' => Array (
				'template' => $properties['appearances'],
			),
			'name' => $old_block['description'],
			'content' => $this->_prepareDynamicObjectContent(
				db_get_field(
					"SELECT item_ids FROM ?:block_links WHERE object_id = 0 AND block_id = ?s", $old_block['block_id']
				),
				$properties
			),
		));

		if (!empty($fillings_settings[$properties['fillings']])) {
			foreach ($fillings_settings[$properties['fillings']] as $setting_name => $default_value) {
				if (isset($properties[$setting_name])) {
					$block['content']['items'][$setting_name] = $properties[$setting_name];
				} else {
					$block['content']['items'][$setting_name] = $default_value;
				}

				$block['properties'] = $this->_unsetIfIsset($block['properties'], $setting_name);
			}
		}

		return $block;
	}

	protected function _prepareDynamicObjectContent($item_ids, $properties)
	{
		return Array(
			'items' => Array (
				'filling' => $properties['fillings'],
				'item_ids' => $item_ids
			)
		);
	}

	protected function _convertAffiliateBlock($old_block, $lang_code, $location)
	{
		$block = array();
		$properties = $this->_convertProperties(unserialize($old_block['properties']));

		$block = $this->_convertBlock($old_block, $location);
		$block = fn_array_merge($block, array(
			'type' => 'affiliate',
			'properties' => Array (
				'template' => 'addons/affiliate/blocks/affiliate.tpl',
			),
		));

		return $block;
	}

	protected function _convertTestimonialsBlock($old_block, $lang_code, $location)
	{
		$block = array();
		$properties = $this->_convertProperties(unserialize($old_block['properties']));
		
		$settings = db_get_field('SELECT options FROM ?:addons WHERE addon = ?s', 'discussion');
		$settings = unserialize($settings);

		$block = $this->_convertBlock($old_block, $location);
		$block = fn_array_merge($block, array(
			'type' => 'testimonials',
			'properties' => Array (
				'template' => 'addons/discussion/blocks/testimonials.tpl',
				'limit' => $settings['home_page_brief_number']
			),
		));

		return $block;
	}

	protected function _convertGiftRegistryBlock($old_block, $lang_code, $location)
	{
		$block = array();
		$properties = $this->_convertProperties(unserialize($old_block['properties']));
		
		$block = $this->_convertBlock($old_block, $location);
		$block = fn_array_merge($block, array(
			'type' => 'gift_registry',
			'properties' => Array (
				'template' => 'addons/gift_registry/blocks/giftregistry.tpl',
			),
		));

		return $block;
	}

	protected function _convertGiftRegistryKeyBlock($old_block, $lang_code, $location)
	{
		$block = array();
		$properties = $this->_convertProperties(unserialize($old_block['properties']));
		
		$block = $this->_convertBlock($old_block, $location);
		$block = fn_array_merge($block, array(
			'type' => 'gift_registry_key',
			'properties' => Array (
				'template' => 'addons/gift_registry/blocks/giftregistry_key.tpl',
			),
		));

		return $block;
	}

	protected function _convertMyAccountBlock($old_block, $lang_code, $location)
	{
		$block = array();
		$properties = $this->_convertProperties(unserialize($old_block['properties']));

		$block = $this->_convertBlock($old_block, $location);
		$block = fn_array_merge($block, array(
			'type' => 'my_account',
			'properties' => Array (
				'template' => $properties['list_object'],
			),
		));

		return $block;
	}

	protected function _convertTemplateBlock($old_block, $lang_code, $location)
	{
		$block = array();
		$properties = $this->_convertProperties(unserialize($old_block['properties']));

		$block = $this->_convertBlock($old_block, $location);
		$block = fn_array_merge($block, array(
			'type' => 'template',
			'properties' => Array (
				'template' => $properties['list_object'],
			),
		));

		return $block;
	}

	protected function _convertMailingListsBlock($old_block, $lang_code, $location)
	{
		$block = array();
		$properties = $this->_convertProperties(unserialize($old_block['properties']));

		$block = $this->_convertBlock($old_block, $location);
		$block = fn_array_merge($block, array(
			'type' => 'template',
			'properties' => Array (
				'template' => 'addons/news_and_emails/blocks/static_templates/subscribe.tpl',
			)
		));

		return $block;
	}

	protected function _convertLiveHelpBlock($old_block, $lang_code, $location)
	{
		$block = array();
		$properties = $this->_convertProperties(unserialize($old_block['properties']));

		$block = $this->_convertBlock($old_block, $location);
		$block = fn_array_merge($block, array(
			'type' => 'live_help',
			'properties' => Array (
				'template' => 'addons/live_help/blocks/livehelp.tpl',
			)
		));

		return $block;
	}

	protected function _convertHtmlBlock($old_block, $lang_code, $location)
	{
		$block = array();
		$properties = $this->_convertProperties(unserialize($old_block['properties']));

		$block = $this->_convertBlock($old_block, $location);

		$content = db_get_field (
			"SELECT description FROM ?:block_descriptions "
			. "WHERE block_id = ?i AND object_text_id = 'block_text' AND object_id = 0 AND lang_code = ?s",
			$old_block['block_id'], $lang_code
		);

		$block = fn_array_merge($block, array(
			'type' => 'html_block',
			'content' => array (
				'content' => $content
			),
			'properties' => Array (
				'template' => 'blocks/html_block.tpl'
			),
		));

		return $block;
	}

	protected function _convertRssBlock($old_block)
	{

	}

	protected function _getDispatchByName($location)
	{
		return $location;
	}

	protected function _getDefaultTop($location)
	{
		if ($location == 'all_pages') {
			$container = simplexml_load_file(DIR_ADDONS . 'exim_store/schemas/block_manager/default_top.xml', 'ExSimpleXmlElement', LIBXML_NOCDATA);
		} else {
			$container = simplexml_load_string('<?xml version="1.0"?><container position="TOP" width="16" user_class=""></container>', 'ExSimpleXmlElement', LIBXML_NOCDATA);
		}

		return $container;
	}

	protected function _getDefaultBottom($location)
	{
		if ($location == 'all_pages') {
			$container = simplexml_load_file(DIR_ADDONS . 'exim_store/schemas/block_manager/default_bottom.xml', 'ExSimpleXmlElement', LIBXML_NOCDATA);
		} else {
			$container = simplexml_load_string('<?xml version="1.0"?><container position="BOTTOM" width="16" user_class=""></container>', 'ExSimpleXmlElement', LIBXML_NOCDATA);
		}

		return $container;
	}
}
