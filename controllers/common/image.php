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
// Delete image
//
if ($mode == 'delete_image') {
	if (AREA == 'A' && !empty($auth['user_id'])) {
		fn_delete_image($_REQUEST['image_id'], $_REQUEST['pair_id'], $_REQUEST['object_type']);
		if (defined('AJAX_REQUEST')) {
			$ajax->assign('deleted', true);
		} elseif (!empty($_SERVER['HTTP_REFERER'])) {
			return array(CONTROLLER_STATUS_REDIRECT, $_SERVER['HTTP_REFERER']);
		}
	}
	exit;

//
// Delete image pair
//
} elseif ($mode == 'delete_image_pair') {
	if (AREA == 'A' && !empty($auth['user_id'])) {
		fn_delete_image_pair($_REQUEST['pair_id'], $_REQUEST['object_type']);
		if (defined('AJAX_REQUEST')) {
			$ajax->assign('deleted', true);
		}
	}
	exit;
	
} elseif ($mode == 'captcha') {
	require(DIR_LIB . 'captcha/captcha.php');

	$verification_id = $_REQUEST['verification_id'];
	if (empty($verification_id)) {
		$verification_id = 'common';
	}

	$verification_settings = CSettings::instance()->get_values('Image_verification');
	$fonts = array(DIR_LIB . 'captcha/verdana.ttf');

	$c = new PhpCaptcha($verification_id, $fonts, $verification_settings['width'], $verification_settings['height']);

	// Set string length
	$c->SetNumChars($verification_settings['string_length']);

	// Set number of distortion lines
	$c->SetNumLines($verification_settings['lines_number']);

	// Set minimal font size 
	$c->SetMinFontSize($verification_settings['min_font_size']);

	// Set maximal font size 
	$c->SetMaxFontSize($verification_settings['max_font_size']);

	$c->SetGridColour($verification_settings['grid_color']);

	if ($verification_settings['char_shadow'] == 'Y') {
		$c->DisplayShadow(true);
	}

	if ($verification_settings['colour'] == 'Y') {
		$c->UseColour(true);
	}

	if ($verification_settings['string_type'] == 'digits') {
		$c->SetCharSet(array(2,3,4,5,6,8,9));
	} elseif ($verification_settings['string_type'] == 'letters') {
		$c->SetCharSet(range('A','F'));
	} else {
		$c->SetCharSet(fn_array_merge(range('A','F'), array(2,3,4,5,6,8,9), false));
	}

	if (!empty($verification_settings['background_image'])) {
		$c->SetBackgroundImages(DIR_ROOT . '/' . $verification_settings['background_image']);
	}

	$c->Create();
	exit;
} elseif ($mode == 'custom_image') {
	if (empty($_REQUEST['image'])) {
		exit();
	}
	
	$type = empty($_REQUEST['type']) ? 'T' : $_REQUEST['type'];
	
	$image_path = DIR_CUSTOM_FILES . 'sess_data/' . fn_basename($_REQUEST['image']);
	
	if (file_exists($image_path)) {
		$image_info = getimagesize($image_path);
		if (!empty($image_info)) {
			if ($type == 'T') {
				// Output a thumbnail image
				$image_path_thumb = $image_path . '_thumb';
				if (fn_resize_image($image_path, $image_path_thumb, Registry::get('settings.Thumbnails.product_lists_thumbnail_width'), Registry::get('settings.Thumbnails.product_lists_thumbnail_height'), false, Registry::get('settings.Thumbnails.thumbnail_background_color'), true)) {
					$image_path = $image_path_thumb;
				}
			}
			
			header('Content-type: ' . $image_info['mime']);
			readfile($image_path);
			
			exit();
		}
	}
	
	// Not image file. Display spacer instead.
	header('Content-type: image/gif');
	readfile(DIR_SKINS . Registry::get('config.skin_name') . '/customer/images/spacer.gif');
	
	exit();
}

?>