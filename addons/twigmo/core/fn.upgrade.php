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


function fn_update_twigmo_options($options, $company_id = null)
{
	$options['logoURL'] = empty($options['logoURL']) ? Registry::get('addons.twigmo.logoURL') : $options['logoURL'];
	$options['faviconURL'] = empty($options['faviconURL']) ? Registry::get('addons.twigmo.faviconURL') : $options['faviconURL'];
	if (!empty($options['version_forced'])) {
		$options['version'] = $options['version_forced'];
		unset($options['version_forced']);
	} elseif (fn_twigmo_is_updated()) {
		$options['version'] = TWIGMO_VERSION;
	}
	$logos = fn_filter_uploaded_data('tw_settings');
	$logo_names = array('logo', 'favicon');
	foreach ($logo_names as $logo_name) {
		if ($logos and !empty($logos[$logo_name])) {
			$logo = $logos[$logo_name];
			$filename = fn_twigmo_get_images_path() . $logo['name'];
			if (!fn_copy($logo['path'], $filename)) {
				$_text = fn_get_lang_var('text_cannot_create_file');
				$text = str_replace('[file]', $filename, $_text);
				fn_set_notification('E', fn_get_lang_var('error'), $text);
			} else {
				$options[$logo_name . 'URL'] = $filename;
			}
			@unlink($logo['path']);
		}
	}

	if (!$section = CSettings::instance()->get_section_by_name('twigmo', CSettings::ADDON_SECTION)) {
		$section = CSettings::instance()->update_section(array(
			'parent_id' =>      0,
			'edition_type' =>   'ROOT,ULT:VENDOR',
			'name' =>           'twigmo',
			'type' =>           'ADDON'
		));
	}

	foreach ($options as $option_name => $option_value) {
		if ($option_name == 'twigmo_license') {
			continue;
		}
		if (!$setting_id = CSettings::instance()->get_id($option_name, 'twigmo')) {
			$setting_id = CSettings::instance()->update(array(
				'name' =>           $option_name,
				'section_id' =>     $section['section_id'],
				'edition_type' =>	'ROOT,ULT:VENDOR',
				'section_tab_id' => 0,
				'type' =>           'A',
				'position' =>       0,
				'is_global' =>      'N',
				'handler' =>        ''
			));
		}
		CSettings::instance()->update_value_by_id($setting_id, $option_value, $company_id ? $company_id : null);
	}
	return;
}


function fn_connect_to_twigmo($email, $password, $user_id)
{
	$user_data = fn_get_user_name($user_id);

	$params = array (
		'dispatch' => 'connect_store.connect',
		'email' => $email,
		'store_name' => Registry::get('config.http_host') . Registry::get('config.http_path'),
		'admin_url' => fn_url('twigmo.post', 'A', Registry::get('settings.General.secure_admin') == 'Y' ? 'https' : 'http'),
		'customer_url' => fn_url('twigmo.post', 'C', fn_twigmo_use_https_for_customer() ? 'https' : 'http'),
		'firstname' => $user_data['firstname'],
		'lastname' => $user_data['$lastname'],
		'password' => md5($password),
		'addon_version' => TWIGMO_VERSION
	);
	$twigmo =& fn_init_twigmo();
	if ($twigmo->sendRequest($params, 'GET') && !empty($twigmo->response_data['access_id'])) {
		// store connected update connection data
		$addon_options = array();
		$addon_options['access_id'] = $twigmo->response_data['access_id'];
		$addon_options['secret_access_key'] = $twigmo->response_data['secret_access_key'];
		$addon_options['email'] = $email;
		$addon_options['password'] = $password;
		fn_update_twigmo_options($addon_options);

		Registry::set('addons.twigmo.access_id', $twigmo->response_data['access_id']);
		Registry::set('addons.twigmo.secret_access_key', $twigmo->response_data['secret_access_key']);
		Registry::set('addons.twigmo.email', $email);
	} else {
		if (!empty($twigmo->errors)) {
			fn_set_notification('E', fn_get_lang_var('error'), implode('<br />', $twigmo->errors));
		} else {
			fn_set_notification('E', fn_get_lang_var('error'), fn_get_lang_var('twgadmin_error_cannot_connect_store'));
		}
	}
	return $twigmo;
}


function fn_twigmo_get_upgrade_dirs($insall_src_dir)
{
	$dirs = array();
	$addon_path = 'twigmo/';
	$full_addon_path = 'addons/twigmo/';
	$repo_path = 'var/skins_repository/basic/';
	$backup_files_path = 'backup_files/';

	$dirs['installed'] = array(
								'addon' => DIR_ADDONS . $addon_path,
								'skin_admin' => fn_get_skin_path('[skins]/[skin]/admin/', 'admin') . $full_addon_path,
								'skins_customer' => array(fn_get_skin_path('[skins]/[skin]/customer/', 'customer') . $full_addon_path)
							);

	$dirs['repo'] = array(
								'addon' => DIR_ADDONS . $addon_path,
								'skin_admin' => fn_get_skin_path('[repo]/basic/admin/') . $full_addon_path,
								'skin_customer' => fn_get_skin_path('[repo]/basic/customer/') . $full_addon_path
							);

	$dirs['distr'] = array(
								'addon' => $insall_src_dir . $full_addon_path,
								'skin_admin' => $insall_src_dir . $repo_path . 'admin/' . $full_addon_path,
								'skin_customer' => $insall_src_dir . $repo_path . 'customer/' . $full_addon_path
							);

	$dirs['backup_root'] = fn_twigmo_get_backup_dir();

	$dirs['backup_files'] = array(
								'addon' => $dirs['backup_root'] . $backup_files_path. $full_addon_path,
								'skin_admin' => $dirs['backup_root'] . $backup_files_path . fn_get_skin_path('[relative]/[skin]/admin/', 'admin') . $full_addon_path,
								'skins_customer' => array($dirs['backup_root'] . $backup_files_path . fn_get_skin_path('[relative]/[skin]/customer/', 'customer') . $full_addon_path)
							);
	$dirs['backup_settings'] = $dirs['backup_root'] . 'backup_settings/';
	$dirs['backup_company_settings'] = array($dirs['backup_settings'] . 'companies/0/');

	if (PRODUCT_TYPE == 'ULTIMATE') {
		$company_ids = fn_get_all_companies_ids();
		$dirs['backup_files']['skins_customer'] = array();
		$dirs['installed']['skins_customer'] = array();
		$dirs['backup_company_settings'] = array();
		foreach ($company_ids as $company_id) {
			$dirs['backup_files']['skins_customer'][$company_id] = $dirs['backup_root'] . $backup_files_path . fn_get_skin_path('[relative]/[skin]/customer/', 'customer', $company_id) . $full_addon_path;
			$dirs['installed']['skins_customer'][$company_id] = fn_get_skin_path('[skins]/[skin]/customer/', 'customer', $company_id) . $full_addon_path;
			$dirs['backup_company_settings'][$company_id] = $dirs['backup_settings'] . 'companies/' . $company_id . '/';
		}
	}
	return $dirs;
}


function fn_twigmo_check_upgrade_permissions($upgrade_dirs, $is_writable = true)
{
	foreach ($upgrade_dirs as $upgrade_dir) {
		if (is_array($upgrade_dir)) {
			$is_writable = fn_twigmo_check_upgrade_permissions($upgrade_dir, $is_writable);
		} else {
			$check_result = array();
			fn_uc_check_files($upgrade_dir, array(), $check_result, '', '');
			$is_writable = empty($check_result);
		}
		if (!$is_writable) {
			break;
		}
	}
	return $is_writable;

}


function fn_twigmo_get_next_version_info()
{
	$version_info = fn_get_contents(TWIGMO_UPGRADE_DIR . TWIGMO_UPGRADE_VERSION_FILE);
	return $version_info ? unserialize($version_info) : array('latest_version' => '', 'next_version' => '', 'description' => '');
}


function fn_twigmo_download_distr()
{
	// Get needed version
	$_version = fn_twigmo_get_next_version_info();
	$version = $_version['next_version'];
	if (!$version) {
		return false;
	}
	$download_file_name = 'twigmo.cs' . preg_replace('/\./', '', preg_replace('/\.[0-9]+$/', 'x', PRODUCT_VERSION)) . '-' . $version . '.tgz';
	$download_file_dir = TWIGMO_UPGRADE_DIR . $version . '/';
	$download_file_path = $download_file_dir . $download_file_name;
	$unpack_path = $download_file_path . '_unpacked';
	fn_rm($download_file_dir);
	fn_mkdir($download_file_dir);
	fn_mkdir($unpack_path);

	$data = fn_get_contents(TWIGMO_UPGRADE_SERVER . $download_file_name);
	if (!fn_is_empty($data)) {
		fn_put_contents($download_file_path, $data);
		$res = fn_decompress_files($download_file_path, $unpack_path);

		if (!$res) {
			fn_set_notification('E', fn_get_lang_var('error'), fn_get_lang_var('text_uc_failed_to decompress_files'));
			return false;
		}
		return $unpack_path . '/';
	} else {
		fn_set_notification('E', fn_get_lang_var('error'), fn_get_lang_var('text_uc_cant_download_package'));
		return false;
	}
}


function fn_twigmo_get_backup_dir()
{
	$_version = fn_twigmo_get_next_version_info();
	$version = $_version['next_version'];
	if (!$version) {
		return false;
	}
	return TWIGMO_UPGRADE_DIR . $version . '/';
}


function fn_twigmo_copy_files($source, $dest)
{
	if (is_array($source)) {
		foreach ($source as $key => $src) {
			fn_twigmo_copy_files($src, $dest[$key]);
		}
	} else {
		fn_uc_copy_files($source, $dest);
	}
	return;
}


function fn_twigmo_remove_directory_content($path)
{
	fn_twigmo_remove_files(fn_get_dir_contents($path, true, true, '', $path));
	return;
}


function fn_twigmo_remove_files($source)
{
	if (is_array($source)) {
		foreach ($source as $src) {
			fn_twigmo_remove_files($src);
		}
	} else {
		fn_uc_rm($source);
	}
	return;
}


function fn_twigmo_exec_upgrade_func($insall_src_dir, $file_name)
{
	$file = $insall_src_dir . '/addons/twigmo/' . $file_name . '.php';
	if (file_exists($file)) {
		require_once($file);
	}
	return;
}


function fn_twigmo_backup_settings($upgrade_dirs)
{
	// Backup addon's settings
	$schema = fn_get_schema('upgrade', 'twigmo_settings', 'php', false);
	$current_settings = Registry::get('addons.twigmo');
	//$schema = fn_get_schema('upgrade', 'twigmo_settings', 'php', false);
	fn_twigmo_write_to_file($upgrade_dirs['backup_settings'] . 'settings_all.bak', $current_settings);
	foreach ($upgrade_dirs['backup_company_settings'] as $company_id => $dir) {
		$saved_settings = array();
		if ($company_id) {
			// Get settings for certain company
			$section = CSettings::instance()->get_section_by_name('twigmo', CSettings::ADDON_SECTION);
			$settings = CSettings::instance()->get_list($section['section_id'], 'main', $company_id);
			if (!empty($settings['main'])) {
				foreach ($settings['main'] as $setting) {
					if (in_array($setting['name'], $schema['saved_settings'])) {
						$saved_settings[$setting['name']] = $setting['value'];
					}
				}
			}
		} else {
			foreach ($schema['saved_settings'] as $setting) {
				if (isset($current_settings[$setting])) {
					$saved_settings[$setting] = $current_settings[$setting];
				}
			}
		}
		fn_twigmo_write_to_file($dir . 'settings.bak', $saved_settings);
	}

	// Backup twigmo blocks
	foreach ($upgrade_dirs['backup_company_settings'] as $company_id => $dir) {
		$location = Bm_Location::instance($company_id)->get('twigmo.post');
		if ($location) {
			$content = Bm_Exim::instance($company_id)->export(array($location['location_id']), array());
			if ($content) {
				fn_twigmo_write_to_file($dir . '/blocks.xml', $content, false);
			}
		}
	}

	// Backup twigmo langvars
	$languages = fn_get_languages();
	foreach ($languages as $language) {
		// Prepare langvars for backup
		$langvars = fn_twigmo_get_all_lang_vars($language['lang_code']);
		$langvars_formated = array();
		foreach ($langvars as $name => $value) {
			$langvars_formated[] = array('name' => $name, 'value' => $value);
		}
		fn_twigmo_write_to_file($upgrade_dirs['backup_settings'] . '/lang_' . $language['lang_code'] . '.bak', $langvars_formated);
	}
	if (PRODUCT_TYPE == 'ULTIMATE') {
		db_export_to_file($upgrade_dirs['backup_settings'] . 'lang_ult.sql', array(db_quote('?:ult_language_values')), 'Y', 'Y', false, false, false);
	}
	return true;
}


function fn_twigmo_restore_settings($upgrade_dirs, $user_id)
{
	// Restore langvars - for all languages except EN and RU
	$languages = fn_get_languages();
	$except_langs = array('EN', 'RU');
	foreach ($languages as $language) {
		$backup_file = $upgrade_dirs['backup_settings'] . 'lang_' . $language['lang_code'] . '.bak';
		if (!in_array($language['lang_code'], $except_langs) and file_exists($backup_file)) {
			fn_update_lang_var(unserialize(fn_get_contents($backup_file)), $language['lang_code']);
		}
	}

	// Restore blocks
	foreach ($upgrade_dirs['backup_company_settings'] as $company_id => $dir) {
		$backup_file = $dir . 'blocks.xml';
		if (file_exists($backup_file)) {
			Bm_Exim::instance($company_id)->import_from_file($backup_file);
		}
	}

	// Restore settings if addon was connected
	$all_settings = unserialize(fn_get_contents($upgrade_dirs['backup_settings'] . 'settings_all.bak'));
	if (!empty($all_settings['access_id'])) {
		// Connect addon
		fn_connect_to_twigmo($all_settings['email'], $all_settings['password'], $user_id);
	}
	// Restore companys settings
	foreach ($upgrade_dirs['backup_company_settings'] as $company_id => $dir) {
		$company_settings = unserialize(fn_get_contents($dir . 'settings.bak'));
		$company_settings['version_forced'] = TWIGMO_VERSION;
		fn_update_twigmo_options($company_settings, $company_id);
	}
	// Restore custom.css files
	foreach ($upgrade_dirs['backup_files']['skins_customer'] as $dir){
		$css_files = fn_get_dir_contents($dir, false, true, 'css');
		foreach ($css_files as $file_name) {
			foreach ($upgrade_dirs['backup_files']['skins_customer'] as $company_id => $dir) {
				if (is_file($dir . $file_name)){
					fn_uc_copy_files($dir . $file_name, $upgrade_dirs['installed']['skins_customer'][$company_id] . $file_name);
				}
			}
		}
	}
    return;
}

function fn_twigmo_update_files($upgrade_dirs)
{
	// Remove all addon's files
	foreach ($upgrade_dirs['repo'] as $dir) {
		fn_twigmo_remove_directory_content($dir);
	}
	// Copy files from distr to repo
	fn_twigmo_copy_files($upgrade_dirs['distr'], $upgrade_dirs['repo']);
	return;
}

?>