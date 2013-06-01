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


//
// $Id: func.php 11039 2010-10-27 12:43:28Z klerik $
//

if ( !defined('AREA') ) { die('Access denied'); }

function fn_watermarks_init_companies($params, $companies)
{
	if (PRODUCT_TYPE == 'ULTIMATE') {
		if (defined('COMPANY_ID')) {
			fn_define('WATERMARK_IMAGE_ID', COMPANY_ID);
			fn_define('WATERMARKS_DIR_NAME', 'watermarked/' . COMPANY_ID . '/');
		} else {
			fn_define('WATERMARK_IMAGE_ID', 0);
			fn_define('WATERMARKS_DIR_NAME', 'watermarked/');
		}

	} else {
		fn_define('WATERMARK_IMAGE_ID', 1);
		fn_define('WATERMARKS_DIR_NAME', 'watermarked/');
	}

	fn_define('DIR_WATERMARKS', DIR_IMAGES . WATERMARKS_DIR_NAME);
}

function fn_get_watermark_settings($company_id = null)
{
	$settings = CSettings::instance()->get_value('watermark', '', $company_id);
	$settings = unserialize($settings);

	if (empty($settings)) {
		$settings = array();
	}

	if (!empty($settings['type']) && $settings['type'] == 'G') {
		if (!empty($company_id)) {
			$settings['image_pair'] = fn_get_image_pairs($company_id, 'watermark', 'M');
		} else {
			$settings['image_pair'] = fn_get_image_pairs(WATERMARK_IMAGE_ID, 'watermark', 'M');
		}
	}

	return $settings;
}
function fn_replace_rewrite_condition($file_name, $condition, $comment)
{
	if (!empty($condition)) {
		$condition = "\n" .
			"# $comment\n" .
			"<IfModule mod_rewrite.c>\n" .
			"RewriteEngine on\n".
			$condition .
			"</IfModule>\n" .
			"# /$comment";
	}

	$content = fn_get_contents($file_name);
	if ($content === false) {
		$content = '';
	} elseif (!empty($content)) {
		// remove old instructions
		$data = explode("\n", $content);
		$remove_start = false;
		foreach($data as $k=> $line) {
			if (preg_match("/# $comment/", $line)) {
				$remove_start = true;
			}

			if ($remove_start) {
				unset($data[$k]);
			}

			if (preg_match("/# \/$comment/", $line)) {
				$remove_start = false;
			}
		}
		$content = implode("\n", $data);
	}

	$content .= $condition;
	return fn_put_contents($file_name, $content);
}

function fn_get_apply_watermark_options()
{
	$option_types = array (
		'icons' => array (
			'use_for_product_icons',
			'use_for_category_icons'
		),
		'detailed' => array (
			'use_for_product_detailed',
			'use_for_category_detailed'
		),
	);

	$res = array();
	foreach ($option_types as $type => $options) {
		$res[$type] = db_get_hash_single_array("SELECT name, object_id  FROM ?:settings_objects WHERE name IN (?a)", array('name', 'object_id'), $options);
	}

	return $res;
}

function fn_delete_watermarks($images_types, $watermarks_path = '')
{
	$path_types = array(
		'icons' => array (
			'category',
			'product',
			'thumbnails'
		),
		'detailed' => array (
			'detailed'
		)
	);
	
	$delete_paths = array();
	foreach  ($path_types as $k => $v) {
		if (!empty($images_types[$k])) {
			$delete_paths = array_merge($delete_paths, $path_types[$k]);
		}
	}

	$watermarks_path = !empty($watermarks_path) ? $watermarks_path : DIR_IMAGES . WATERMARKS_DIR_NAME;
	foreach ($delete_paths as $path) {
		fn_rm($watermarks_path . $path, false);
	}

	fn_clear_cache();

	return true;
}


function fn_is_need_watermark($object_type, $is_detailed = true, $company_id = null)
{
	if ($object_type == 'product_option' || $object_type == 'variant_image') {
		$object_type = 'product';
	}

	$image_type = $is_detailed ? 'detailed' : 'icons';
	$option = 'use_for_' . $object_type . '_' . $image_type;

	if (!empty($company_id)) {
		$result = CSettings::instance()->get_value($option, 'watermarks', $company_id);
	} else {
		$result = Registry::get('addons.watermarks.' . $option) == 'Y';
	}

	return $result;
}

function fn_watermarks_generate_thumbnail_pre($real_path)
{
	if (PRODUCT_TYPE == 'ULTIMATE' && !defined('COMPANY_ID')) {
		$pattern = '/^(.*)' . addcslashes(WATERMARKS_DIR_NAME, '/') . '[0-9]+\/(.*)$/';
	} else {
		$pattern = '/^(.*)' . addcslashes(WATERMARKS_DIR_NAME, '/') . '(.*)$/';
	}

	if (preg_match($pattern, $real_path, $matches)) {
		$real_path = $matches[1] . $matches[2];
	}

	return true;
}

function fn_is_watermarks_enabled()
{
	// watermarks are enabled if addon is active
	return true;
}

function fn_watermarks_generate_thumbnail_post($url, $filename)
{
	if (fn_is_watermarks_enabled()) {
		$thumbnail_path = fn_basename(Registry::get('config.thumbnails_path'));
		$image_path_info = fn_pathinfo($filename);
		$image_name = $image_path_info['filename'];

		$company_id = null;
		$object_type = '';

		if (PRODUCT_TYPE == 'ULTIMATE' && !defined('COMPANY_ID')) {
			$key = $image_name . '_company_id';
			Registry::register_cache($key, array('products', 'categories', 'images', 'images_links'));

			if (Registry::is_exist($key) == false) {
				$image_data = db_get_row("SELECT l.* FROM ?:images AS i, ?:images_links AS l WHERE image_path LIKE ?l AND (l.image_id = i.image_id OR detailed_id = i.image_id)", $image_name . '.%');
				$object_type = $image_data['object_type'];

				$company_id = fn_wt_get_image_company_id($image_data);
				Registry::set($key, $company_id);
			} else {
				$company_id = Registry::get($key);
			}

			$watermarked_url = Registry::get('config.images_path') . WATERMARKS_DIR_NAME . $company_id . '/' . $thumbnail_path . '/' . $filename;

			$watermarked_image = DIR_WATERMARKS . $company_id . '/'  . $thumbnail_path . '/' . $filename;

		} else {
			$watermarked_url = Registry::get('config.images_path') . WATERMARKS_DIR_NAME . $thumbnail_path . '/' . $filename;

			$watermarked_image = DIR_WATERMARKS . $thumbnail_path . '/' . $filename;
		}


		if (!is_file($watermarked_image)) {
			$original_image = DIR_THUMBNAILS . $filename;
			
			if (is_file($original_image)) {
				if (empty($object_type)) {
					$object_type = db_get_field("SELECT l.object_type FROM ?:images AS i, ?:images_links AS l WHERE image_path LIKE ?l AND (l.image_id = i.image_id OR detailed_id = i.image_id)", $image_name . '.%');
				}
				fn_add_watermark_file($original_image, $watermarked_image, $object_type, false, $company_id);
			}
		}

		$url = $watermarked_url;
	
	}

	return true;
}

function fn_wt_get_image_company_id($image_data)
{
	if ($image_data['object_type'] == 'category') {
		$company_id = db_get_field("SELECT company_id FROM ?:categories WHERE category_id = ?i", $image_data['object_id']);
	} elseif ($image_data['object_type'] == 'product') {
		$company_id = db_get_field("SELECT company_id FROM ?:products WHERE product_id = ?i", $image_data['object_id']);
	} else {
		// take any company_id
		$company_id = db_get_field("SELECT company_id FROM ?:companies");
	}

	return $company_id;
}

function fn_watermarks_attach_absolute_image_paths($image_data, $object_type, $path, $image_name)
{
	if (fn_is_watermarks_enabled() && !empty($image_data['image_path'])) {
		$is_detailed = ($object_type == 'detailed') ? true : false;
		$original_file = $image_data['absolute_path'];
		$company_id = null;

		if (PRODUCT_TYPE == 'ULTIMATE' && !defined('COMPANY_ID')) {
			if (empty($image_data['object_type'])) {
				$image_data['object_type'] = $object_type;
			}
			$company_id = fn_wt_get_image_company_id($image_data);
			$image_data['http_image_path'] = Registry::get('config.http_images_path') . WATERMARKS_DIR_NAME . $company_id . '/' . $path . '/' . $image_name;
			$image_data['absolute_path'] = DIR_WATERMARKS .$company_id . '/' . $path . '/' . $image_name;
			$image_data['image_path'] = Registry::get('config.images_path') . WATERMARKS_DIR_NAME . $company_id . '/' . $path . '/' . $image_name;
		} else {
			$image_data['http_image_path'] = Registry::get('config.http_images_path') . WATERMARKS_DIR_NAME . $path . '/' . $image_name;
			$image_data['absolute_path'] = DIR_WATERMARKS . $path . '/' . $image_name;
			$image_data['image_path'] = Registry::get('config.images_path') . WATERMARKS_DIR_NAME . $path . '/' . $image_name;
		}

		if (!@is_file($image_data['absolute_path']) && @is_file($original_file)) {
			$watermarked_file = $image_data['absolute_path'];
			fn_add_watermark_file($original_file, $watermarked_file, $image_data['object_type'], $is_detailed, $company_id);
		}
	}

	return true;
}

/**
 * Delete watermarked images before deleteing image pair
 *
 * @param int $image_id Image identifier
 * @param int $pair_id Pair identifier
 * @param string $object_type Object type
 * @param string $path Deleted image path
 * @param string $image_name Deleted image name
 * @return boolean Always true
 */
function fn_watermarks_delete_image($image_id, $pair_id, $object_type, $path, $image_name)
{
	fn_delete_file_thumbnails($image_name, DIR_WATERMARKS);

	return true;
}

function fn_add_watermark_file($original_image, $watermarked_image, $object_type, $is_detailed = false, $company_id = null)
{
	$watermarked_path = dirname($watermarked_image);

	fn_mkdir($watermarked_path);

	if (fn_is_need_watermark($object_type, $is_detailed, $company_id) && fn_watermark_create($original_image, $watermarked_image, $is_detailed, $company_id)) {
		return true;

	} elseif (fn_copy($original_image, $watermarked_image)) {
		return true;

	}

	return false;
}

function fn_watermark_create($original_image, $watermarked_image, $is_detailed = false, $company_id = null)
{

	$w_settings = fn_get_watermark_settings($company_id);

	if (empty($w_settings)) {
		return false;
	}

	list($w_settings['horizontal_position'], $w_settings['vertical_position']) = explode('_', $w_settings['position']);

	list($original_width, $original_height, $original_mime_type) = fn_get_image_size($original_image);

	if (empty($original_width) || empty($original_height)) {
		return false;
	}
	
	if (!$image = fn_create_image_from_file($original_image, $original_mime_type)) {
		return false;
	}

	$dest_x = $dest_y = $watermark_width = $watermark_height = 0;

	if ($w_settings['type'] == 'G') {

		$watermark_image = false;
		if ($is_detailed) {
			if (!empty($w_settings['image_pair']['detailed']['absolute_path']))  {
				$watermark_image = $w_settings['image_pair']['detailed']['absolute_path'];
			}
		} elseif(!empty($w_settings['image_pair']['icon']['absolute_path'])) {
			$watermark_image = $w_settings['image_pair']['icon']['absolute_path'];
		}

		list($watermark_width, $watermark_height, $watermark_mime_type) = fn_get_image_size($watermark_image);

		if (empty($watermark_image) || !$watermark = fn_create_image_from_file($watermark_image, $watermark_mime_type)) {
			return false;
		}

	} else {
		$font_path = DIR_LIB . 'html2pdf/fonts/' . $w_settings['font'] . '.ttf';

		if (!is_file($font_path) || empty($w_settings['text'])) {
			return false;
		}
		
		if ($is_detailed) {
			$font_size = $w_settings['font_size_detailed'];
		} else {
			$font_size = $w_settings['font_size_icon'];
		}

		if (empty($font_size)) {
			return false;
		}

		$ttfbbox = imagettfbbox($font_size, 0, $font_path, $w_settings['text']);
		$watermark_height = abs($ttfbbox[7]);
		$watermark_width = abs($ttfbbox[2]);
	}

	if (empty($watermark_width) || empty($watermark_height)) {
		return false;
	}

	// Paddings
	$delta_x = 3;
	$delta_y = 3;

	$new_wt_width = $watermark_width;
	$new_wt_height = $watermark_height;

	if ($new_wt_width + $delta_x > $original_width) {
		$new_wt_height = $new_wt_height * ($original_width - $delta_x)/ $new_wt_width;
		$new_wt_width = $original_width - $delta_x;
	}

	if ($new_wt_height > $original_height) {
		$new_wt_width = $new_wt_width * ($original_height - $delta_y)/ $new_wt_height;
		$new_wt_height = $original_height - $delta_y;
	}

	if ($w_settings['vertical_position'] == 'top') {
		$dest_y = $delta_y;
	} elseif ($w_settings['vertical_position'] == 'center') {
		$dest_y = (int)(($original_height - $new_wt_height)/ 2);
	} elseif ($w_settings['vertical_position'] == 'bottom') {
		$dest_y = $original_height - $new_wt_height - $delta_y;
	}

	if ($w_settings['horizontal_position'] == 'left') {
		$dest_x =  $delta_x;
	} elseif ($w_settings['horizontal_position'] == 'center') {
		$dest_x = (int)(($original_width - $new_wt_width)/ 2);
	} elseif ($w_settings['horizontal_position'] == 'right') {
		$dest_x = $original_width - $new_wt_width - $delta_x;
	}

	if ($dest_x < 1) {
		$dest_x = 1;
	}

	if ($dest_y < 1) {
		$dest_y = 1;
	}

	if ($w_settings['type'] == 'G') {
		imagecolortransparent($watermark, imagecolorat($watermark, 0, 0));
		if (function_exists('imageantialias')) {
			imageantialias($image, true);
		}
		$result = imagecopyresampled($image, $watermark, $dest_x, $dest_y, 0, 0, $new_wt_width, $new_wt_height, $watermark_width, $watermark_height);
		imagedestroy($watermark);
	} else {
		if ($w_settings['font_color'] == 'white') {
			$font_color = imagecolorallocate($image, 255, 255, 255);
		} elseif ($w_settings['font_color'] == 'black') {
			$font_color = imagecolorallocate($image, 0, 0, 0);
		} elseif ($w_settings['font_color'] == 'gray') {
			$font_color = imagecolorallocate($image, 120, 120, 120);
		} elseif ($w_settings['font_color'] == 'clear_gray') {
			$font_color = imagecolorallocatealpha($image, 120, 120, 120, WATERMARK_FONT_ALPHA);
		}

		$result = imagettftext($image, $font_size, 0, $dest_x, $dest_y + $font_size, $font_color, $font_path, $w_settings['text']);
	}

	if ($result === false) {
		return false;
	}

	fn_rm($watermarked_image);

	$ext = fn_get_image_extension($original_mime_type);

	if ($ext == 'gif') {
		$result = imagegif($image, $watermarked_image);
	} elseif ($ext == 'jpg') {
		$result = imagejpeg($image, $watermarked_image, 85);
	} elseif ($ext == 'png') {
		$result = imagepng($image, $watermarked_image, 8);
	}

	imagedestroy($image);
	return $result;
}

function fn_create_image_from_file($path, $mime_type)
{

	$ext = fn_get_image_extension($mime_type);

	if ($ext == 'gif') {
		$image = imagecreatefromgif($path);
	} elseif ($ext == 'jpg') {
		$image = imagecreatefromjpeg($path);
	} elseif ($ext == 'png') {
		$image = imagecreatefrompng($path);
	} else {
		return false;
	}

	return $image;
}

function fn_watermarks_images_access_info()
{
	$is_applied = false;

	$option_types = fn_get_apply_watermark_options();
	foreach ($option_types as $type => $options) {
		foreach ($options as $name => $option_id) {
			if (Registry::get('addons.watermarks.' . $name) == 'Y') {
				$is_applied = true;
				break;
			}
		}
	}

	if ($is_applied) {
		if (PRODUCT_TYPE == 'ULTIMATE') {
			$img_instr = "# Rewrite watermarks rules\n" .
				"<IfModule mod_rewrite.c>\n" .
				"RewriteEngine on\n" .
				"RewriteCond %{REQUEST_URI} \/images\/(product|category|detailed|thumbnails)\/*\n" .
				"RewriteCond %{REQUEST_FILENAME} -f\n" .
				"RewriteRule .(gif|jpeg|jpg|png)$ " . DIR_ROOT . "/index.php?dispatch=watermark.create [NC]\n" .
				"</IfModule>\n" .
				"# /Rewrite watermarks rules";
		} else  {
			$img_instr = "# Rewrite watermarks rules\n" .
				"<IfModule mod_rewrite.c>\n" .
				"RewriteEngine on\n" .
				"RewriteCond %{REQUEST_URI} \/images\/(product|category|detailed|thumbnails)\/*\n" .
				"RewriteCond %{REQUEST_FILENAME} -f\n" .
				"RewriteRule (.*)$ ./watermarked/$1 [NC]\n" .
				"</IfModule>\n" .
				"# /Rewrite watermarks rules";
		}

		$img_instr = nl2br(htmlentities($img_instr));

		$wt_instr = "# Generate watermarks rules\n" .
			"<IfModule mod_rewrite.c>\n" .
			"RewriteEngine on\n" .
			"RewriteCond %{REQUEST_FILENAME} !-f\n" .
			"RewriteRule .(gif|jpeg|jpg|png)$ " . DIR_ROOT . "/index.php?dispatch=watermark.create [NC]\n" .
			"</IfModule>\n" .
			"# /Generate watermarks rules";
		$wt_instr = nl2br(htmlentities($wt_instr));

		$res = '<h2 class="subheader">' . fn_get_lang_var('wt_images_access_info') . '</h2>' .
			'<p>' . fn_get_lang_var('wt_images_access_description') . '</p>' .
			'<p><code>' . $img_instr . '</code></p>' .
			'<p>' . fn_get_lang_var('wt_watermarks_access_description') . '</p>' .
			'<p><code>' .  $wt_instr . '</code></p>' .
			'<p>' .fn_get_lang_var('wt_access_note') . '</p>';

		return $res;
	}

	return '';
}


function fn_settings_actions_addons_post_watermarks($status)
{
	if ($status == 'D') {
		fn_clear_watermarks();
	}
}

function fn_clear_watermarks() 
{
	fn_set_notification('W', fn_get_lang_var('warning'), fn_get_lang_var('wt_access_warning'));
}

?>