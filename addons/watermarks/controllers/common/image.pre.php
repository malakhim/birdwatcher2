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

//
// Delete image
//
if ($mode == 'delete_image') {
	if (AREA == 'A' && !empty($auth['user_id'])) {
		if ($_REQUEST['object_type'] == 'watermark' || $_REQUEST['object_type'] == 'detailed') {

			$images_data =  db_get_row("SELECT image_id, detailed_id FROM ?:images_links WHERE pair_id = ?i AND object_type = ?s", $_REQUEST['pair_id'], 'watermark');

			if (!empty($images_data)) {
				if ($_REQUEST['image_id'] == $images_data['image_id']) {
					$type = 'icons';
				} elseif ($_REQUEST['image_id'] == $images_data['detailed_id']) {
					$type = 'detailed';
				}

				if (!empty($type)) {
					$option_types = fn_get_apply_watermark_options();
					$unset_options = array();
					$is_unset =  false;
					foreach($option_types[$type] as $name => $option_id) {
						$unset_options =  array (
							$option_id => 'N'
						);
						if (CSettings::instance()->get_value($name, '') == 'Y') {
							$is_unset = true;
						}
					}

					if ($is_unset) {
						fn_set_notification('E', fn_get_lang_var('error'), str_replace("[image_type]", fn_get_lang_var('wt_' . $type), fn_get_lang_var('wt_fail_apply_graphic_watermark')));
						fn_update_addon(array('options' => $unset_options));
						fn_delete_watermarks(array($type => true));

					}

				}
			}
		}
	}
}

?>