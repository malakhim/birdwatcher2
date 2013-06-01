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


if ( !defined('AREA') )	{ die('Access denied');	}

//
// Get image
//
function fn_get_image($image_id, $object_type, $rev_data = array(), $lang_code = CART_LANGUAGE, $get_all_alts = false)
{
	$table = 'images';
	$cond = '';
	$path = $object_type;

	if (!empty($rev_data)) {
		$table = 'rev_images';
		$cond = db_quote(" AND ?:$table.revision = ?s AND ?:$table.revision_id = ?i", $rev_data['revision'], $rev_data['revision_id']);
		$path .= '_rev';
	}

	if (!empty($image_id) && !empty($object_type)) {
		$image_data = db_get_row("SELECT ?:$table.image_id, ?:$table.image_path, ?:common_descriptions.description as alt, ?:$table.image_x, ?:$table.image_y FROM ?:$table LEFT JOIN ?:common_descriptions ON ?:common_descriptions.object_id = ?:$table.image_id AND ?:common_descriptions.object_holder = 'images' AND ?:common_descriptions.lang_code = ?s  WHERE ?:$table.image_id = ?i ?p", $lang_code, $image_id, $cond);
		if ($get_all_alts && count(Registry::get('languages')) > 1) {
			$image_data['alt'] = db_get_hash_single_array('SELECT description, lang_code FROM ?:common_descriptions WHERE object_id = ?i AND object_holder = ?s', array('lang_code', 'description'), $image_data['image_id'], 'images');
		}
	}
	fn_attach_absolute_image_paths($image_data, $object_type);

	return (!empty($image_data) ? $image_data : false);
}

//
// Attach image paths
//
function fn_attach_absolute_image_paths(&$image_data, $object_type)
{
	$image_id = !empty($image_data['images_image_id'])? $image_data['images_image_id'] : $image_data['image_id'];
	$path = $object_type . "/" . floor($image_id / MAX_FILES_IN_DIR);

	if (!empty($image_data['image_path'])) {
		if (fn_get_file_ext($image_data['image_path']) == 'swf') { // FIXME, dirty
			$image_data['is_flash'] = true;
		}
		$image_name = $image_data['image_path'];
		$image_data['http_image_path'] = Registry::get('config.http_images_path') . $path . '/' . $image_name;
		$image_data['absolute_path'] = DIR_IMAGES . $path . '/' . $image_name;
		$image_data['image_path'] = Registry::get('config.images_path') . $path . '/' . $image_name;
	}

	fn_set_hook('attach_absolute_image_paths', $image_data, $object_type, $path, $image_name);

	return $image_data;
}

/**
 * Function creates or updates image
 * 
 * @param mixed $image_data Array with image data
 * @param int $image_id Image ID
 * @param string $image_type Type (object) of image (may be product, category, and so on)
 * @param mixed $rev_data Array with revisions data
 * @param string $lang_code 2 letters language code
 * @return int Updated or inserted image ID. False on failure.
 */
function fn_update_image($image_data, $image_id = 0, $image_type = 'product', $rev_data = array (), $lang_code = CART_LANGUAGE)
{
	$table = 'images_links';
	$itable = 'images';
	$images_path = $image_type . '/';
	$cond = '';
	$_data = array();

	if (!empty($rev_data)) {
		$table = 'rev_images_links';
		$itable = 'rev_images';
		$images_path = $image_type . '_rev/';
		$cond = db_quote(" AND revision = ?s AND revision_id = ?i", $rev_data['revision'], $rev_data['revision_id']);
		$_data['revision'] = $rev_data['revision'];
		$_data['revision_id'] = $rev_data['revision_id'];
	}

	if (empty($image_id)) {
		$max_id = db_get_next_auto_increment_id($itable);
		$img_id_subdir = floor($max_id / MAX_FILES_IN_DIR) . "/";
	} else {
		$img_id_subdir = floor($image_id / MAX_FILES_IN_DIR) . "/";
	}
	$images_path .= $img_id_subdir;

	if (!fn_mkdir(DIR_IMAGES . $images_path)) {
		return false;
	}

	list($_data['image_x'], $_data['image_y'], $mime_type) = fn_get_image_size($image_data['path']);

	// Get the real image type
	$ext = fn_get_image_extension($mime_type);
	if (strpos($image_data['name'], '.') !== false) {
		$image_data['name'] = substr_replace($image_data['name'], $ext, strrpos($image_data['name'], '.') + 1);
	} else {
		$image_data['name'] .= '.' . $ext;
	}

	$fd = fopen($image_data['path'], "rb", true);
	if (!empty($fd)) {
		// Check if image path already set
		$image_path = db_get_field("SELECT image_path FROM ?:$itable WHERE image_id = ?i ?p", $image_id, $cond);

		// Delete image file if already exists
		if ($image_path != $image_data['name'] && empty($rev_data)) {
			fn_delete_file(DIR_IMAGES . $images_path . $image_path);
		}

		// Generate new filename if file with the same name is already exists
		if (file_exists(DIR_IMAGES . $images_path . $image_data['name']) && $image_path != $image_data['name']) {
			$image_data['name'] = substr_replace($image_data['name'], uniqid(time()) . '.', strrpos($image_data['name'], '.'), 1);
		}

		// Clear all existing thumbnails
		fn_delete_file_thumbnails($image_data['name'], DIR_THUMBNAILS . $img_id_subdir);

		$_data['image_path'] = $image_data['name'];
		if (@fn_rename($image_data['path'], DIR_IMAGES . $images_path . $image_data['name']) == false) {
			fn_copy($image_data['path'], DIR_IMAGES . $images_path . $image_data['name']);
			@unlink($image_data['path']);
		}

		fclose($fd);
	}

	$_data['image_size'] = $image_data['size'];
	$_data['image_path'] = empty($_data['image_path']) ? '' : fn_normalize_path($_data['image_path']);

	if (!empty($image_id)) {
		db_query("UPDATE ?:$itable SET ?u WHERE image_id = ?i ?p", $_data, $image_id, $cond);
	} else {
		$image_id = db_query("INSERT INTO ?:$itable ?e", $_data);
	}

	return $image_id;
}

//
// Delete image
//
function fn_delete_image($image_id, $pair_id, $object_type = 'product', $rev_data = array())
{
	if (AREA == 'A' && PRODUCT_TYPE == 'MULTIVENDOR' && defined('COMPANY_ID') && $object_type == 'category') {
		return false;
	}
	
	$table = 'images_links';
	$itable = 'images';
	$cond = '';
	$path = DIR_IMAGES . $object_type . '/';

	if (AREA == 'A' && Registry::is_exist('revisions') && !Registry::get('revisions.working')) {
		$revisions = Registry::get('revisions');
		$_img_data = db_get_row("SELECT object_type, object_id FROM ?:rev_images_links WHERE pair_id = ?i ORDER BY revision DESC LIMIT 1", $pair_id);

		if (!empty($_img_data['object_type']) && !empty($revisions['objects'][$_img_data['object_type']]) && !empty($revisions['objects'][$_img_data['object_type']]['tables'])) {
			$object_data = $revisions['objects'][$_img_data['object_type']];

			if ($object_data['images']) {
				if (empty($rev_data)) {
					$entry = array (
						$object_data['key'] => $_img_data['object_id']
					);

					list($revision, $revision_id) = fn_revisions_get_last($_img_data['object_type'], $entry, 0, $itable);
				} else {
					$revision = $rev_data['revision'];
					$revision_id = $rev_data['revision_id'];
				}
				if (!empty($revision_id)) {
					$table = 'rev_images_links';
					$itable = 'rev_images';
					$cond = db_quote(" AND revision = ?s AND revision_id = ?i", $revision, $revision_id);
					$path = DIR_IMAGES . $object_type . '_rev/';
				}
			}
		}
	}

	$path .= floor($image_id / MAX_FILES_IN_DIR) . "/";

	$_image_file = db_get_field("SELECT image_path FROM ?:$itable WHERE image_id = ?i ?p", $image_id, $cond);

	if (!empty($_image_file)) {

		if (!empty($revision_id)) {
			$use_count = db_get_field("SELECT COUNT(image_path) FROM ?:$itable WHERE image_id = ?i AND image_path = ?s", $image_id, $_image_file);
			if ($use_count == 1) {
				fn_delete_file($path . $_image_file);
			}
		} else {
			fn_delete_file($path . $_image_file);
		}
	}
	$dir_content = fn_get_dir_contents($path, true, true);
	if (empty($dir_content)) {
		fn_rm($path);
	}

	db_query("DELETE FROM ?:$itable WHERE image_id = ?i ?p", $image_id, $cond);
	db_query("DELETE FROM ?:common_descriptions WHERE object_id = ?i AND object_holder = 'images'", $image_id);
	db_query("UPDATE ?:$table SET " . ($object_type == 'detailed' ? 'detailed_id' : 'image_id') . " = '0' WHERE pair_id = ?i ?p", $pair_id, $cond);

	$_ids = db_get_row("SELECT image_id, detailed_id FROM ?:$table WHERE pair_id = ?i ?p", $pair_id, $cond);

	if (empty($_ids['image_id']) && empty($_ids['detailed_id'])) {
		db_query("DELETE FROM ?:$table WHERE pair_id = ?i ?p", $pair_id, $cond);
	}

	/**
	 * Adds  additional actions after deleting image
	 *
	 * @param int $image_id Image identifier
	 * @param int $pair_id Pair identifier
	 * @param string $object_type Object type
	 * @param string $path Deleted image path
	 * @param string $_image_file Deleted image name
	 */
	fn_set_hook('delete_image', $image_id, $pair_id, $object_type, $path, $_image_file);

	return true;
}

//
// Delete thumbnails for a file. Example: fn_delete_file_thumbnails('my_picture.jpg');
//
function fn_delete_file_thumbnails($filename, $dir = '', $recursive = true)
{
	static $gd_settings = array();
	
	if (empty($gd_settings)) {
		$gd_settings = CSettings::instance()->get_values('Thumbnails');
	}
	
	if (empty($dir)) {
		$dir = realpath(DIR_THUMBNAILS);
	}
	
	if ($gd_settings['convert_to'] == 'original') {
		$ext = fn_substr($filename, strpos($filename, '.') + 1);
	} else {
		$ext = $gd_settings['convert_to'];
	}
	
	$filename = fn_substr($filename, 0, strpos($filename, '.'));
	
	fn_rm($dir . '/' . $filename . '.' . $ext);
	
	if ($recursive) {
		$content = fn_get_dir_contents($dir);
		if (!empty($content)) {
			foreach ($content as $subdir) {
				fn_delete_file_thumbnails($filename . '.' . $ext, $dir . '/' . $subdir);
			}
		}
	}
	
	return true;
}


//
// Get image pair(s)
//
function fn_get_image_pairs($object_ids, $object_type, $pair_type, $get_icon = true, $get_detailed = true, $lang_code = CART_LANGUAGE)
{
	$icon_pairs = $detailed_pairs = $pairs_data = array();

	$cond = is_array($object_ids)? db_quote("AND ?:images_links.object_id IN (?n)", $object_ids) : db_quote("AND ?:images_links.object_id = ?i", $object_ids);

	if ($get_icon == true || $get_detailed == true) {
		if ($get_icon == true) {
			$join_cond = "?:images_links.image_id = ?:images.image_id";
			$icon_pairs = db_get_array(
					"SELECT ?:images_links.*, ?:images.image_path, ?:common_descriptions.description AS alt, ?:images.image_x, ?:images.image_y, ?:images.image_id as images_image_id"
					. " FROM ?:images_links"
					. " LEFT JOIN ?:images ON $join_cond"
					. " LEFT JOIN ?:common_descriptions ON ?:common_descriptions.object_id = ?:images.image_id AND ?:common_descriptions.object_holder = 'images' AND ?:common_descriptions.lang_code = ?s"
					. " WHERE ?:images_links.object_type = ?s AND ?:images_links.type = ?s $cond"
					. " ORDER BY ?:images_links.position, ?:images_links.pair_id", 
					$lang_code, $object_type, $pair_type
				);
		}

		if ($get_detailed == true) {
			$join_cond = db_quote("?:images_links.detailed_id = ?:images.image_id");
			$detailed_pairs = db_get_array(
					"SELECT ?:images_links.*, ?:images.image_path, ?:common_descriptions.description AS alt, ?:images.image_x, ?:images.image_y, ?:images.image_id as images_image_id"
					. " FROM ?:images_links"
					. " LEFT JOIN ?:images ON $join_cond"
					. " LEFT JOIN ?:common_descriptions ON ?:common_descriptions.object_id = ?:images.image_id AND ?:common_descriptions.object_holder = 'images' AND ?:common_descriptions.lang_code = ?s"
					. " WHERE ?:images_links.object_type = ?s AND ?:images_links.type = ?s $cond"
					. " ORDER BY ?:images_links.position, ?:images_links.pair_id", 
					$lang_code, $object_type, $pair_type
				);
		}

		foreach ((array)$object_ids as $object_id) {
			$pairs_data[$object_id] = array();
		}

		// Convert the received data to the standard format in order to keep the backward compatibility
		foreach ($icon_pairs as $pair) {
			$_pair = array(
				'pair_id' => $pair['pair_id'],
				'image_id' => $pair['image_id'],
				'detailed_id' => $pair['detailed_id'],
				'position' => $pair['position'],
			);

			if (!empty($pair['images_image_id'])) { //get icon data if exist
				$icon = fn_attach_absolute_image_paths($pair, $object_type);
				$_pair['icon'] = array(
					'image_path' => $icon['image_path'],
					'alt'        => $icon['alt'],
					'image_x'    => $icon['image_x'],
					'image_y'    => $icon['image_y'],
					'http_image_path'  => $icon['http_image_path'],
					'absolute_path'    => $icon['absolute_path'],
					'is_flash' => empty($icon['is_flash'])? 0 : 1,
				);
			}

			$pairs_data[$pair['object_id']][$pair['pair_id']] = $_pair;
		}// -foreach icon_pairs
		
		foreach ($detailed_pairs as $pair) {
			$pair_id = $pair['pair_id'];
			$object_id = $pair['object_id'];

			if (!empty($pairs_data[$object_id][$pair_id]['detailed_id'])) {
				$detailed = fn_attach_absolute_image_paths($pair, 'detailed');
				$pairs_data[$object_id][$pair_id]['detailed'] = array(
					'image_path' => $detailed['image_path'],
					'alt'        => $detailed['alt'],
					'image_x'    => $detailed['image_x'],
					'image_y'    => $detailed['image_y'],
					'http_image_path'  => $detailed['http_image_path'],
					'absolute_path'    => $detailed['absolute_path'],
					'is_flash' => empty($detailed['is_flash'])? 0 : 1,
				);
			} elseif (empty($pairs_data[$object_id][$pair_id]['pair_id'])) {
				$pairs_data[$object_id][$pair_id] = array(
					'pair_id' => $pair['pair_id'],
					'image_id' => $pair['image_id'],
					'detailed_id' => $pair['detailed_id'],
					'position' => $pair['position'],
				);

				if (!empty($pair['images_image_id'])) { //get detailed data if exist
					$detailed = fn_attach_absolute_image_paths($pair, 'detailed');
					$pairs_data[$object_id][$pair_id]['detailed'] = array(
						'image_path' => $detailed['image_path'],
						'alt'        => $detailed['alt'],
						'image_x'    => $detailed['image_x'],
						'image_y'    => $detailed['image_y'],
						'http_image_path'  => $detailed['http_image_path'],
						'absolute_path'    => $detailed['absolute_path'],
						'is_flash' => empty($detailed['is_flash'])? 0 : 1,
					);
				}
			}
		}// -foreach detailed_pairs

	} else {
		$pairs_data = db_get_hash_multi_array("SELECT pair_id, image_id, detailed_id, object_id FROM ?:images_links WHERE object_type = ?s AND type = ?s $cond", array('object_id', 'pair_id'), $object_type, $pair_type);
	}

	if (is_array($object_ids)) {
		return $pairs_data;
	} else {
		if ($pair_type == 'A')  {
			return $pairs_data[$object_ids];
		} else {
			return !empty($pairs_data[$object_ids])? reset($pairs_data[$object_ids]) : array();
		}
	}
}

//
// Create/Update image pairs (icon -> detailed image)
//
function fn_update_image_pairs($icons, $detailed, $pairs_data, $object_id = 0, $object_type = 'product_lists', $object_ids = array (), $parent_object_type = '', $parent_object_id = 0, $update_alt_desc = true, $lang_code = CART_LANGUAGE)
{
	$_otype = !empty($parent_object_type) ? $parent_object_type : $object_type;
	$_otype == 'product' ? $_otype = 'product_lists' : $_otype;

	$pair_ids = $rev_data = array();
	$table = 'images_links';
	$itable = 'images';
	$cond = '';

	if (AREA == 'A' && Registry::is_exist('revisions') && !Registry::get('revisions.working')) {
		$revisions = Registry::get('revisions');

		if (!empty($_otype) && !empty($revisions['objects'][$_otype]) && !empty($revisions['objects'][$_otype]['tables'])) {
			$object_data = $revisions['objects'][$_otype];

			if ($object_data['images']) {
				$entry = array (
					$object_data['key'] => !empty($parent_object_id) ? $parent_object_id : $object_id
				);

				list($revision, $revision_id) = fn_revisions_get_last($_otype, $entry, 0, $table);
				if (!empty($revision_id)) {
					$table = 'rev_images_links';
					$itable = 'rev_images';
					$rev_data = array (
						'revision' => $revision,
						'revision_id' => $revision_id
					);
					$cond = db_quote(" AND revision = ?s AND revision_id = ?i", $revision, $revision_id);
				}
			}
		}
	}

	if (!empty($pairs_data)) {
		foreach ($pairs_data as $k => $p_data) {
			$data = array();
			$pair_id = !empty($p_data['pair_id']) ? $p_data['pair_id'] : 0;
			$o_id = !empty($object_id) ? $object_id : ((!empty($p_data['object_id'])) ? $p_data['object_id'] : 0);

			if ($o_id == 0 && !empty($object_ids[$k])) {
				$o_id = $object_ids[$k];
			} elseif (!empty($object_ids) && empty($object_ids[$k])) {
				continue;
			}

			// Check if main pair is exists
			if (empty($pair_id) && !empty($p_data['type']) && $p_data['type'] == 'M') {
				$pair_data = db_get_row("SELECT pair_id, image_id, detailed_id FROM ?:$table WHERE object_id = ?i AND object_type = ?s AND type = ?s ?p", $o_id, $object_type, $p_data['type'], $cond);
				$pair_id = !empty($pair_data['pair_id']) ? $pair_data['pair_id'] : 0;
			} else {
				$pair_data = db_get_row("SELECT image_id, detailed_id FROM ?:$table WHERE pair_id = ?i ?p", $pair_id, $cond);
				if (empty($pair_data)) {
					$pair_id = 0;
				}
			}

			// Update detailed image
			if (!empty($detailed[$k]) && !empty($detailed[$k]['size'])) {
				if (fn_get_image_size($detailed[$k]['path'])) {
					$data['detailed_id'] = fn_update_image($detailed[$k], !empty($pair_data['detailed_id']) ? $pair_data['detailed_id'] : 0, 'detailed', $rev_data);
				}
			}

			// Update icon
			if (!empty($icons[$k]) && !empty($icons[$k]['size'])) {
				if (fn_get_image_size($icons[$k]['path'])) {
					$data['image_id'] = fn_update_image($icons[$k], !empty($pair_data['image_id']) ? $pair_data['image_id'] : 0, $object_type, $rev_data);
				}
			}

			// Update alt descriptions
			if (((empty($data) && !empty($pair_id)) || !empty($data)) && $update_alt_desc == true) {
				$image_ids = array();
				if (!empty($pair_id)) {
					$image_ids = db_get_row("SELECT image_id, detailed_id FROM ?:$table WHERE pair_id = ?i ?p", $pair_id, $cond);
				}

				$image_ids = fn_array_merge($image_ids, $data);

				$fields = array('detailed', 'image');
				foreach ($fields as $field) {
					if (!empty($image_ids[$field . '_id'])) {
						if (!is_array($p_data[$field . '_alt'])) {
							$_data = array (
								'description' => empty($p_data[$field . '_alt']) ? '' : trim($p_data[$field . '_alt']),
								'object_holder' => 'images'
							);

							// check, if this is new record, create new descriptions for all languages
							$is_exists = db_get_field('SELECT object_id FROM ?:common_descriptions WHERE object_id = ?i AND lang_code = ?s AND object_holder = ?s', $image_ids[$field . '_id'], $lang_code, 'images');
							if (!$is_exists) {
								fn_create_description('common_descriptions', 'object_id', $image_ids[$field . '_id'], $_data);
							} else {
								db_query('UPDATE ?:common_descriptions SET ?u WHERE object_id = ?i AND lang_code = ?s AND object_holder = ?s', $_data, $image_ids[$field . '_id'], $lang_code, 'images');
							}
						} else {
							foreach ($p_data[$field . '_alt'] as $lc => $_v) {
								$_data = array (
									'object_id' => $image_ids[$field . '_id'],
									'description' => empty($_v) ? '' : trim($_v),
									'lang_code' => $lc,
									'object_holder' => 'images'
								);
								db_query("REPLACE INTO ?:common_descriptions ?e", $_data);
							}
						}
					}
				}
			}

			if (empty($data)) {
				continue;
			}

			if (!empty($revision_id)) {
				$data['revision_id'] = $revision_id;
				$data['revision'] = $revision;
			}

			// Pair is exists
			$data['position'] = !empty($p_data['position']) ? $p_data['position'] : 0; // set data position
			if (!empty($pair_id)) {
				db_query("UPDATE ?:$table SET ?u WHERE pair_id = ?i ?p", $data, $pair_id, $cond);
			} else {
				$data['type'] = $p_data['type']; // set link type
				$data['object_id'] = $o_id; // assign pair to object
				$data['object_type'] = $object_type;
				$pair_id = db_query("INSERT INTO ?:$table ?e", $data);
			}
			
			$pairs_data[$k]['pair_id'] = $pair_id;
			
			$pair_ids[] = $pair_id;
		}
	}

	fn_set_hook('update_image_pairs', $pair_ids, $icons, $detailed, $pairs_data, $object_id, $object_type, $object_ids, $update_alt_desc, $lang_code);

	return $pair_ids;
}

function fn_delete_image_pairs($object_id, $object_type, $pair_type = '')
{
	$table = 'images_links';
	$itable = 'images';
	$rev_data = array ();
	$cond = '';

	if (AREA == 'A' && Registry::is_exist('revisions') && !Registry::get('revisions.working')) {
		$revisions = Registry::get('revisions');

		if (!empty($object_type) && !empty($revisions['objects'][$object_type]) && !empty($revisions['objects'][$object_type]['tables'])) {
			$object_data = $revisions['objects'][$object_type];

			if ($object_data['images']) {
				$entry = array (
					$object_data['key'] => $object_id
				);

				list($revision, $revision_id) = fn_revisions_get_last($object_type, $entry, 0, $table);
				if (!empty($revision_id)) {
					$table = 'rev_images_links';
					$itable = 'rev_images';
					$rev_data = array (
						'revision' => $revision,
						'revision_id' => $revision_id
					);
					$cond = db_quote(" AND revision = ?s AND revision_id = ?i", $revision, $revision_id);
				}
			}
		}
	}
	
	if ($pair_type  === 'A') {
		$cond .= db_quote("AND type = 'A'");
	} elseif ($pair_type === 'M') {
		$cond .= db_quote("AND type = 'M'");
	}
	
	$pair_ids = db_get_fields("SELECT pair_id FROM ?:$table WHERE object_id = ?i AND object_type = ?s ?p", $object_id, $object_type, $cond);

	foreach ($pair_ids as $pair_id) {
		fn_delete_image_pair($pair_id, $object_type);
	}

	return true;
}

//
// Delete image pair
//
function fn_delete_image_pair($pair_id, $object_type = 'product', $rev_data = array())
{
	$table = 'images_links';
	$cond = '';

	if (AREA == 'A' && Registry::is_exist('revisions') && !Registry::get('revisions.working')) {
		$revisions = Registry::get('revisions');

		if (!empty($object_type) && !empty($revisions['objects'][$object_type]) && !empty($revisions['objects'][$object_type]['tables'])) {
			$object_data = $revisions['objects'][$object_type];

			if ($object_data['images']) {
				if (empty($rev_data)) {
					$object_id = db_get_field("SELECT object_id FROM ?:rev_images_links WHERE pair_id = ?i ORDER BY revision DESC LIMIT 1", $pair_id);
					$entry = array (
						$object_data['key'] => $object_id
					);

					list($rev_data['revision'], $rev_data['revision_id']) = fn_revisions_get_last($object_type, $entry, 0, $table);
				}
				if (!empty($rev_data['revision_id'])) {
					$table = 'rev_images_links';
					$cond = db_quote(" AND revision = ?s AND revision_id = ?i", $rev_data['revision'], $rev_data['revision_id']);
				}
			}
		}
	}

	if (!empty($pair_id)) {
		$images = db_get_row("SELECT image_id, detailed_id FROM ?:$table WHERE pair_id = ?i ?p", $pair_id, $cond);
		if (!empty($images)) {
			fn_delete_image($images['image_id'], $pair_id, $object_type, $rev_data);
			fn_delete_image($images['detailed_id'], $pair_id, 'detailed', $rev_data);
		}

		fn_set_hook('delete_image_pair', $pair_id, $object_type);

		return true;
	}

	return false;
}

/**
 * Delete all images pairs for object
 */
function fn_clean_image_pairs($object_id, $object_type, $revision = null, $revision_id = null)
{
	$table = 'images_links';
	$itable = 'images';
	$cond = '';
	$rev_data = array ();

	if (AREA == 'A' && Registry::is_exist('revisions') && !Registry::get('revisions.working') && $revision !== null) {
		$revisions = Registry::get('revisions');

		if (!empty($object_type) && !empty($revisions['objects'][$object_type]) && !empty($revisions['objects'][$object_type]['tables'])) {
			$object_data = $revisions['objects'][$object_type];

			if ($object_data['images']) {
				$entry = array (
					$object_data['key'] => $object_id
				);

				$rev_data = db_get_row("SELECT revision, revision_id FROM ?:revisions WHERE object = ?s AND object_id = ?i GROUP BY revision_id", $object_type, $object_id);

				$table = 'rev_images_links';
				$itable = 'rev_images';
				$rev_data = array (
					'revision' => $revision,
					'revision_id' => $revision_id
				);
				$cond = db_quote(" AND revision = ?i AND revision_id = ?i", $revision, $revision_id);
			}
		}
	}

	$pair_data = db_get_hash_array("SELECT pair_id, image_id, detailed_id, type FROM ?:$table WHERE object_id = ?i AND object_type = ?s ?p", 'pair_id', $object_id, $object_type, $cond);

	foreach ($pair_data as $pair_id => $p_data) {
		fn_delete_image_pair($pair_id, $object_type, $rev_data);
	}
}

//
// Clone image pairs
//
function fn_clone_image_pairs($target_object_id, $object_id, $object_type, $action = null, $parent_object_id = 0, $parent_object_type = '', $rev_data = array(), $lang_code = CART_LANGUAGE)
{
	$table = 'images_links';
	$itable = 'images';
	$cond = '';

	if (AREA == 'A' && Registry::is_exist('revisions') && !Registry::get('revisions.working')) {
		if (!empty($rev_data)) {
			$cond = db_quote(" AND revision = ?s AND revision_id = ?i", $rev_data['revision'], $rev_data['revision_id']);
			$table = 'rev_images_links';
			$itable = 'rev_images';
		}
	}

	// Get all pairs
	$pair_data = db_get_hash_array("SELECT pair_id, image_id, detailed_id, type FROM ?:$table WHERE object_id = ?i AND object_type = ?s ?p", 'pair_id', $object_id, $object_type, $cond);

	if (empty($pair_data)) {
		return false;
	}

	$icons = $detailed = $pairs_data = array();

	foreach ($pair_data as $pair_id => $p_data) {
		if (!empty($p_data['image_id'])) {
			$icons[$pair_id] = fn_get_image($p_data['image_id'], $object_type, $rev_data, $lang_code, true);

			if (!empty($icons[$pair_id])) {
				$p_data['image_alt'] = empty($icons[$pair_id]['alt']) ? '' : $icons[$pair_id]['alt'];
				// Image is stored on the filesystem
				if (empty($icons[$pair_id]['image'])) {
					$path = str_replace(Registry::get('config.images_path'), DIR_IMAGES, $icons[$pair_id]['image_path']);
					$icons[$pair_id]['image'] = fn_get_contents($path);
					$name = ($action === null ? $target_object_id . '_' : '') . fn_basename($path);
				} else {
					$name = ($action === null ? $target_object_id . '_' : '') . $object_type . '_image';
				}

				$tmp_name = fn_create_temp_file();
				fn_put_contents($tmp_name, $icons[$pair_id]['image']);

				$icons[$pair_id] = array(
					'path' => $tmp_name,
					'size' => filesize($tmp_name),
					'error' => 0,
					'name' => $name,
				);
			}
		}
		if (!empty($p_data['detailed_id'])) {
			$detailed[$pair_id] = fn_get_image($p_data['detailed_id'], 'detailed', $rev_data, $lang_code, true);
			if (!empty($detailed[$pair_id])) {
				$p_data['detailed_alt'] = empty($detailed[$pair_id]['alt']) ? '' : $detailed[$pair_id]['alt'];

				// Image is stored on the filesystem
				if (empty($detailed[$pair_id]['image'])) {
					$path = str_replace(Registry::get('config.images_path'), DIR_IMAGES, $detailed[$pair_id]['image_path']);
					$detailed[$pair_id]['image'] = fn_get_contents($path);
					$name = ($action === null ? $target_object_id . '_' : '') . fn_basename($path);
				} else {
					$name = ($action === null ? $target_object_id . '_' : '') . '_detailed_image';
				}

				$tmp_name = fn_create_temp_file();
				fn_put_contents($tmp_name, $detailed[$pair_id]['image']);

				$detailed[$pair_id] = array(
					'path' => $tmp_name,
					'size' => filesize($tmp_name),
					'error' => 0,
					'name' => $name,
				);
			}
		}

		$pairs_data = array(
			$pair_id => array(
				'type' => $p_data['type'],
				'image_alt' => (!empty($p_data['image_alt'])) ? $p_data['image_alt'] : '',
				'detailed_alt' => (!empty($p_data['detailed_alt'])) ? $p_data['detailed_alt'] : '',
			)
		);

		if ($action == 'publish') {
			Registry::set('revisions.working', true);
		}

		fn_update_image_pairs($icons, $detailed, $pairs_data, $target_object_id, $object_type, array(), $parent_object_type, $parent_object_id, true, $lang_code);

		if ($action == 'publish') {
			Registry::set('revisions.working', false);
		}
	}
}

// ----------- Utility functions -----------------

//
// Resize image
//
function fn_resize_image($src, &$dest, $new_width = 0, $new_height = 0, $make_box = false, $bg_color = '#ffffff', $save_original = false)
{

	static $notification_set = false;
	static $gd_settings = array();

	if (file_exists($src) && !empty($dest) && (!empty($new_width) || !empty($new_height)) && extension_loaded('gd')) {

		$img_functions = array(
			'png' => function_exists('imagepng'),
			'jpg' => function_exists('imagejpeg'),
			'gif' => function_exists('imagegif'),
		);
		
		if (empty($gd_settings)) {
			$gd_settings = CSettings::instance()->get_values('Thumbnails');
		}

		$dst_width = $new_width;
		$dst_height = $new_height;

		list($width, $height, $mime_type) = fn_get_image_size($src);
		if (empty($width) || empty($height)) {
			return false;
		}

		if ($width < $new_width) {
			$new_width = $width;
		}
		if ($height < $new_height) {
			$new_height = $height;
		}

		if ($dst_height == 0) { // if we passed width only, calculate height
			$new_height = $dst_height = ($height / $width) * $new_width;

		} elseif ($dst_width == 0) { // if we passed height only, calculate width
			$new_width = $dst_width = ($width / $height) * $new_height;

		} else { // we passed width and height, limit image by height! (hm... not sure we need it anymore?)
			if ($new_width * $height / $width > $dst_height) {
				$new_width = $width * $dst_height / $height;
			}
			$new_height = ($height / $width) * $new_width;
			if ($new_height * $width / $height > $dst_width) {
				$new_height = $height * $dst_width / $width;
			}
			$new_width = ($width / $height) * $new_height;
		}

		$w = number_format($new_width, 0, ',', '');
		$h = number_format($new_height, 0, ',', '');

		$ext = fn_get_image_extension($mime_type);

		if (!empty($img_functions[$ext])) {
			if ($make_box) {
				$dst = imagecreatetruecolor($dst_width, $dst_height);
			} else {
				$dst = imagecreatetruecolor($w, $h);
			}
			if (function_exists('imageantialias')) {
				imageantialias($dst, true);
			}
		} elseif ($notification_set == false) {
			$msg = fn_get_lang_var('error_image_format_not_supported');
			$msg = str_replace('[format]', $ext, $msg);
			fn_set_notification('E', fn_get_lang_var('error'), $msg);
			$notification_set = true;
			return false;
		}

		if ($ext == 'gif' && $img_functions[$ext] == true) {
			$new = imagecreatefromgif($src);
		} elseif ($ext == 'jpg' && $img_functions[$ext] == true) {
			$new = imagecreatefromjpeg($src);
		} elseif ($ext == 'png' && $img_functions[$ext] == true) {
			$new = imagecreatefrompng($src);
		} else {
			return false;
		}

		list($r, $g, $b) = (empty($bg_color)) ? fn_parse_rgb('#ffffff') : fn_parse_rgb($bg_color);
		$c = imagecolorallocate($dst, $r, $g, $b);

		if (empty($bg_color) && ($ext == 'png' || $ext == 'gif')) {
			if (function_exists('imagecolorallocatealpha') && function_exists('imagecolortransparent') && function_exists('imagesavealpha') && function_exists('imagealphablending')) {
				$c = imagecolorallocatealpha($dst, 255, 255, 255, 127);
				imagecolortransparent($dst, $c);
				imagesavealpha($dst, true);
				imagealphablending($dst, false);
			}
		}

		if ($make_box) {
			imagefilledrectangle($dst, 0, 0, $dst_width, $dst_height, $c);
			$x = number_format(($dst_width - $w) / 2, 0, ',', '');
			$y = number_format(($dst_height - $h) / 2, 0, ',', '');
		} else {
			imagefilledrectangle($dst, 0, 0, $w, $h, $c);
			$x = 0;
			$y = 0;
		}

		imagecopyresampled($dst, $new, $x, $y, 0, 0, $w, $h, $width, $height);
		
		// Free memory from image
		imagedestroy($new);
		
		if ($gd_settings['convert_to'] == 'original') {
			$convert_to = $ext;
		} else {
			$convert_to = $gd_settings['convert_to'];
		}
		
		if (empty($img_functions[$convert_to])) {
			foreach ($img_functions as $k => $v) {
				if ($v == true) {
					$convert_to = $k;
					break;
				}
			}
		}

		$pathinfo = fn_pathinfo($dest);
		$new_filename = $pathinfo['dirname'] . '/' . $pathinfo['filename'];

		// Remove source thumbnail file
		if (!$save_original) {
			fn_rm($src);
		}

		switch ($convert_to) {
			case 'gif':
				$new_filename .= '.gif';
				imagegif($dst, $new_filename);
				break;
			case 'jpg':
				$new_filename .= '.jpg';
				imagejpeg($dst, $new_filename, $gd_settings['jpeg_quality']);
				break;
			case 'png':
				$new_filename .= '.png';
				imagepng($dst, $new_filename);
				break;
		}
		
		$dest = $new_filename;
		@chmod($dest, DEFAULT_FILE_PERMISSIONS);

		return true;
	}

	return false;
}

//
// Check supported GDlib formats
//
function fn_check_gd_formats()
{
	$avail_formats = array(
		'original' => fn_get_lang_var('same_as_source'),
	);

	if (function_exists('imagegif')) {
		$avail_formats['gif'] = 'GIF';
	}
	if (function_exists('imagejpeg')) {
		$avail_formats['jpg'] = 'JPEG';
	}
	if (function_exists('imagepng')) {
		$avail_formats['png'] = 'PNG';
	}

	return $avail_formats;
}

//
// Get image extension by MIME type
//
function fn_get_image_extension($image_type)
{
	static $image_types = array (
		'image/gif' => 'gif',
		'image/pjpeg' => 'jpg',
		'image/jpeg' => 'jpg',
		'image/png' => 'png',
		'application/x-shockwave-flash' => 'swf',
		'image/psd' => 'psd',
		'image/bmp' => 'bmp',
	);

	return isset($image_types[$image_type]) ? $image_types[$image_type] : false;
}

//
// Getimagesize wrapper
// Returns mime type instead of just image type
// And doesn't return html attributes
function fn_get_image_size($file)
{
	// File is url, get it and store in temporary directory
	if (strpos($file, '://') !== false) {
		$tmp = fn_create_temp_file();

		if (fn_put_contents($tmp, fn_get_contents($file)) == 0) {
			return false;
		}

		$file = $tmp;
	}

	list($w, $h, $t, $a) = @getimagesize($file);

	if (empty($w)) {
		return false;
	}

	$t = image_type_to_mime_type($t);

	return array($w, $h, $t);
}

function fn_attach_image_pairs($name, $object_type, $object_id = 0, $lang_code = CART_LANGUAGE, $object_ids = array (), $parent_object = '', $parent_object_id = 0)
{
	$icons = fn_filter_uploaded_data($name . '_image_icon');
	$detailed = fn_filter_uploaded_data($name . '_image_detailed');
	$pairs_data = !empty($_REQUEST[$name . '_image_data']) ? $_REQUEST[$name . '_image_data'] : array();

	return fn_update_image_pairs($icons, $detailed, $pairs_data, $object_id, $object_type, $object_ids, $parent_object, $parent_object_id, true, $lang_code);
}

function fn_generate_thumbnail($image_path, $width, $height = 0, $make_box = false)
{
	if (empty($image_path)) {
		return '';
	}
	
	if (strpos($image_path, '://') === false) {
		if (strpos($image_path, '/') !== 0) { // relative path
			$image_path = Registry::get('config.current_path') . '/' . $image_path;
		}
		$image_path = (defined('HTTPS') ? ('https://' . Registry::get('config.https_host')) : ('http://' . Registry::get('config.http_host'))) . $image_path;
	}

	$_path = str_replace(Registry::get('config.current_location') . '/', '', $image_path);

	$image_url = explode('/', $_path);
	$image_name = array_pop($image_url);
	$image_dir = array_pop($image_url);
	$image_dir .= '/' . $width . (empty($height) ? '' : '/' . $height);

	if (Registry::get('settings.Thumbnails.convert_to') != 'original') {
		$image_name = preg_replace("/\.[^.]*?$/", "." . Registry::get('settings.Thumbnails.convert_to'), $image_name);
	}

	$filename = $image_dir . '/' . $image_name;
	$real_path = htmlspecialchars_decode(DIR_ROOT . '/' . $_path, ENT_QUOTES);
	$th_path = htmlspecialchars_decode(DIR_THUMBNAILS . $filename, ENT_QUOTES);
	if (!fn_mkdir(DIR_THUMBNAILS . $image_dir)) {
		return '';
	}

	if (!file_exists($th_path)) {
		fn_set_hook('generate_thumbnail_pre', $real_path);

		if (fn_get_image_size($real_path)) {
			$image = fn_get_contents($real_path);
			fn_put_contents($th_path, $image);
			fn_resize_image($th_path, $th_path, $width, $height, $make_box, Registry::get('settings.Thumbnails.thumbnail_background_color'));
			$filename_info = fn_pathinfo($filename);
			$th_path_info = fn_pathinfo($th_path);
			$filename = $filename_info['dirname'] . '/' . $th_path_info['basename'];
		} else {
			return '';
		}
	}

	$url = Registry::get('config.thumbnails_path') . $filename;
	fn_set_hook('generate_thumbnail_post', $url, $filename);

	return $url;
}

function fn_parse_rgb($color)
{
	$r = hexdec(substr($color, 1, 2));
	$g = hexdec(substr($color, 3, 2));
	$b = hexdec(substr($color, 5, 2));
	return array($r, $g, $b);
}

function fn_find_valid_image_path($image_pair, $object_type, $get_flash, $lang_code)
{
	$result = false;

	if (isset($image_pair['icon']['absolute_path']) && is_file($image_pair['icon']['absolute_path'])) {
		if ($get_flash || !isset($image_pair['icon']['is_flash']) || !$image_pair['icon']['is_flash']) {
			// Check if icon is not flash or we need flash too
			$result = $image_pair['icon']['image_path'];
		}
	} 

	if (!$result && !empty($image_pair['image_id'])) {
		// Try to get the product's image.
		$image = fn_get_image($image_pair['image_id'], $object_type, 0, $lang_code);

		if (isset($image['absolute_path']) && is_file($image['absolute_path'])) {
			if ($get_flash || !isset($image['is_flash']) || !$image['is_flash']) {
				$result = $image['image_path'];
			}
		}
	}

	// If everything above failed, try to generate the thumbnail.
	if (!$result && !empty($image_pair['detailed_id'])) {
		$image = fn_get_image($image_pair['detailed_id'], 'detailed', 0, $lang_code);

		if (isset($image['absolute_path']) && is_file($image['absolute_path'])) {
			if (isset($image['is_flash']) && $image['is_flash']) {
				if ($get_flash) {
					// No need to call fn_generate_thumbnail()
					$result = $image['image_path'];
				}
			} else {
				$image = fn_generate_thumbnail($image['image_path'], Registry::get('settings.Thumbnails.product_details_thumbnail_width'), Registry::get('settings.Thumbnails.product_details_thumbnail_height'), false);

				$result = $image;
			}
		}
	}

	/**
	 * Changes the finded image path
	 *
	 * @param string $result Image path or boolean false if path is not finded
	 * @param array $image_pair Image pair data
	 * @param string $object_type Object type
	 * @param boolean $get_flash Flag that determines if path of flash image is needed
	 * @param string $lang_code 2 letters language code
	 */
	fn_set_hook('find_valid_image_path_post', $result, $image_pair, $object_type, $get_flash, $lang_code);

	return $result;
}

function fn_convert_relative_to_absolute_image_url($image_path)
{
	return 'http://' . Registry::get('config.http_host') . $image_path;
}

?>