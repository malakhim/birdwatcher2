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


if ( !defined('AREA') ) { die('Access denied'); }

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if ($mode == 'update' && $_REQUEST['addon'] == 'watermarks' && !empty($_REQUEST['wt_settings'])) {
		$wt_settings = $_REQUEST['wt_settings'];

		if (PRODUCT_TYPE == 'ULTIMATE' && !defined('COMPANY_ID')) {
			if (!empty($_REQUEST['wt_settings']['update_all_vendors']) && $companies = fn_get_short_companies()) {
				// update settings for all stores
				$wt_changed = array (
					'icons' => true,
					'detailed' => true
				);


				// to avoid data check for each company update all companies data
				$wt_changed['icons'] = true;
				$wt_changed['detailed'] = true;

				$attached_image_id = 0;
				foreach ($companies as $company_id => $name) {
					$attached_image_id = fn_update_watermark_settings($wt_settings, $company_id, $attached_image_id);
				}

				// clear` all companies directories
				if (!empty($wt_changed)) {
					foreach ($companies as $company_id => $name) {
						$company_wt_path = DIR_IMAGES . 'watermarked/' . $company_id . '/';
						fn_delete_watermarks($wt_changed, $company_wt_path);
					}
				}
			}
		} else {

			$wt_changed = array(); // fix if watermark or watermark rule was changed to update watermarks
			$old_wt_setting = fn_get_watermark_settings();

			// check if settings were changed
			if (empty($old_wt_setting)) {
				$wt_changed['icons'] = true;
				$wt_changed['detailed'] = true;
			} else {
				foreach ($old_wt_setting as $k => $v) {
					if (empty($wt_settings[$k]) || $v != $wt_settings[$k]) {
						if ($k == 'font_size_icon') {
							$wt_changed['icons'] = true;
						} elseif ($k == 'font_size_detailed') {
							$wt_changed['detailed'] = true;
						} else {
							$wt_changed['icons'] = true;
							$wt_changed['detailed'] = true;
							break;
						}
					}
				}
			}

			if (fn_update_watermark_settings($wt_settings)) {
				$wt_changed['icons'] = true;
				$wt_changed['detailed'] = true;
			}

			$watermark_pairs = fn_get_image_pairs(WATERMARK_IMAGE_ID, 'watermark', 'M');

			if (!empty($_REQUEST['addon_data'])) {
				// unset wt option if watermark is not loaded
				$option_types = fn_get_apply_watermark_options();
				$is_unset = false;

				foreach ($option_types as $type => $options) {

					if (PRODUCT_TYPE == 'ULTIMATE' && !defined('COMPANY_ID')) {
						// allow watermarks apply for all vendors
						$wt_changed[$type] = true;
						continue;
					}

					$is_type_unset = false;

					foreach ($options as $name => $option_id) {
						if (empty($_REQUEST['addon_data']['options'][$option_id])) {
							continue;
						}

						if ($wt_settings['type'] == 'G' && $_REQUEST['addon_data']['options'][$option_id] == 'Y') {
							$image_name = ($type == 'icons') ? 'icon' : 'detailed';
							if (empty($watermark_pairs[$image_name]['absolute_path'])) {
								$_REQUEST['addon_data']['options'][$option_id] = 'N';
								$is_unset = true;
								$is_type_unset = true;
							}
						}
						if (CSettings::instance()->get_value($name, '') != $_REQUEST['addon_data']['options'][$option_id]) {
							$wt_changed[$type] = true;
						}
					}

					if ($is_type_unset) {
						fn_set_notification('E', fn_get_lang_var('error'), str_replace("[image_type]", fn_get_lang_var('wt_' . $type), fn_get_lang_var('wt_fail_apply_graphic_watermark')));
					}
				}

				if ($is_unset) {
					fn_update_addon($_REQUEST['addon_data']);
					return array(CONTROLLER_STATUS_REDIRECT, "addons.manage");
				}
			}

			if (!empty($wt_changed)) {
				fn_delete_watermarks($wt_changed);
			}
		}
	}
}

if ($mode == 'update') {

	if ($_REQUEST['addon'] == 'watermarks') {
		$wt_fonts = array(
			'arial'   => 'Arial',
			'arialbd' => 'Arial Bold',
			'georgia' => 'Georgia',
			'symbol'  => 'Symbol',
			'times'   => 'Times New Roman',
			'verdana' => 'Verdana'
		);
		$view->assign('wt_fonts', $wt_fonts);


		$wt_font_sizes = range(5, 50, 5);
		$view->assign('wt_font_sizes', $wt_font_sizes);


		$wt_font_colors = array (
			'white' => 'White',
			'black' => 'Black',
			'gray'  => 'Gray',
			'clear_gray' => 'Clear gray',
		);
		$view->assign('wt_font_colors', $wt_font_colors);

		if (PRODUCT_TYPE == 'ULTIMATE' && !defined('COMPANY_ID')) {
			$wt_settings = array();
		} else {
			$wt_settings = fn_get_watermark_settings();
		}

		$view->assign('wt_settings', $wt_settings);

	}

}
//

function fn_update_watermark_settings($wt_settings, $company_id = null, $attached_image_id = 0)
{
	if (!$setting_id = CSettings::instance()->get_id('watermark', '')) {
		$setting_id = CSettings::instance()->update(array(
			'name' =>           'watermark',
			'section_id' =>     0,
			'section_tab_id' => 0,
			'type' =>           'A', // any not existing type
			'position' =>       0,
			'is_global' =>      'N',
			'handler' =>        ''
		));
	}
	CSettings::instance()->update_value_by_id($setting_id, serialize($wt_settings), $company_id);

	if ($wt_settings['type'] == 'G') {
		$_REQUEST['wt_image_image_data'][0]['image_alt'] = '';
		$_REQUEST['wt_image_image_data'][0]['detailed_alt'] = '';

		$image_id = !empty($company_id) ? $company_id : WATERMARK_IMAGE_ID;

		if (!empty($attached_image_id)) {
			fn_clone_image_pairs($image_id, $attached_image_id, 'watermark');
		} else {
			fn_attach_image_pairs('wt_image', 'watermark', $image_id);
			$attached_image_id = $image_id;
		}	
	}

	return $attached_image_id;
} 

?>