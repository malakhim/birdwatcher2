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

	fn_trusted_vars("lang_data");

	$suffix = '';
	
	if ($mode == 'update_design_mode') {
		CSettings::instance()->update_value($_REQUEST['design_mode'], ($action == $_REQUEST['design_mode'] ? 'Y' : 'N'));

		if (!empty($_REQUEST['disable_mode'])) {
			CSettings::instance()->update_value($_REQUEST['disable_mode'], 'N');
		}
		fn_rm(DIR_CACHE_TEMPLATES . 'customer');
		fn_rm(DIR_CACHE_TEMPLATES . 'admin');

		$suffix = '.design_mode';
	}

	if ($mode == 'update_logos') {
		$logos = fn_filter_uploaded_data('logotypes');

		$areas = fn_get_manifest_definition();

		fn_save_logo_alt($areas, (defined('COMPANY_ID') ? COMPANY_ID : 0));

		// Update customer logotype
		if (!empty($logos)) {
			foreach ($logos as $type => $logo) {
				$area = $areas[$type];
				$manifest = parse_ini_file(DIR_ROOT . '/' . Registry::get('customer_skin_path') . '/' . SKIN_MANIFEST, true);

				$skin_path = fn_get_skin_path('[skins]/[skin]', $area['skin']);

				$filename = $skin_path . '/' . $area['path'] . '/images/' . $logo['name'];

				if (fn_copy($logo['path'], $filename)) {
					list($w, $h, ) = fn_get_image_size($filename);

					$manifest[$area['name']]['filename'] = $logo['name'];
					$manifest[$area['name']]['width'] = $w;
					$manifest[$area['name']]['height'] = $h;

					fn_write_ini_file($skin_path . '/' . SKIN_MANIFEST, $manifest);
				} else {
					$text = fn_get_lang_var('text_cannot_create_file');
					$text = str_replace('[file]', $filename, $text);
					fn_set_notification('E', fn_get_lang_var('error'), $text);
				}
				@unlink($logo['path']);
			}
		}
		$suffix = '.logos';
	}

	return array(CONTROLLER_STATUS_OK, "site_layout" . $suffix);
}

if ($mode == 'logos') {

	$skin_path = fn_get_skin_path('[relative]', 'customer');
	
	$path = array(
		'skin_name_customer' => $skin_path,
		'skin_name_admin' => 'skins',
	);
	
	$view->assign('path', $path);
	$view->assign('manifest_definition', fn_get_manifest_definition());
	$view->assign('manifests', array(
		'customer' => fn_get_manifest('customer'),
		'admin' => $view->get_var('manifest')
	));

} elseif ($mode == 'design_mode') {


}

?>