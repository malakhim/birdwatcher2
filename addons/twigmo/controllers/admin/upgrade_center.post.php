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

	if ($mode == 'upgrade_twigmo') {

		$uc_settings = CSettings::instance()->get_values('Upgrade_center');

		fn_start_scroller();
		fn_echo('<b>' . fn_get_lang_var('twgadmin_upgrade_addon') . '</b><br>');
		fn_echo(fn_get_lang_var('twgadmin_download_twigmo') . '<br>');

		$insall_src_dir = fn_twigmo_download_distr();

		if (!$insall_src_dir) {
			$error_string = fn_get_lang_var('text_uc_cant_download_package');
			fn_echo('<span style="color:red">' . $error_string . '</span><br>');
			fn_set_notification('E', fn_get_lang_var('error'), $error_string);
			fn_stop_scroller();
			return array(CONTROLLER_STATUS_REDIRECT, "addons.update&addon=twigmo");
		}

		fn_uc_ftp_connect($uc_settings);

		$upgrade_dirs = fn_twigmo_get_upgrade_dirs($insall_src_dir);

		fn_echo(fn_get_lang_var('twgadmin_checking_permissions') . '<br>');
		if (!fn_twigmo_check_upgrade_permissions($upgrade_dirs['installed'])) {
			$error_string = fn_get_lang_var('twgadmin_no_files_permissions');
			$error_string = str_replace('[link]', '<a href="' . fn_url('settings.manage&section_id=Upgrade_center') . '">', $error_string);
			$error_string = str_replace('[/link]', '</a>', $error_string);
			fn_echo('<span style="color:red">' . $error_string . '</span><br>');
			fn_set_notification('E', fn_get_lang_var('error'), $error_string);
			fn_stop_scroller();
			return array(CONTROLLER_STATUS_REDIRECT, "addons.update&addon=twigmo");
		}

		// backup files
		fn_echo(fn_get_lang_var('twgadmin_backup_files') . '<br>');
		fn_twigmo_copy_files($upgrade_dirs['installed'], $upgrade_dirs['backup_files']);

		// Execute pre functions
		fn_twigmo_exec_upgrade_func($insall_src_dir, 'pre_upgrade');

		// Get and save current settings
		fn_echo('<br>' . fn_get_lang_var('twgadmin_backup_settings') . '<br>');
		fn_twigmo_backup_settings($upgrade_dirs);

		// Uninstal addon
		fn_echo(fn_get_lang_var('twgadmin_uninstall_addon') . '<br>');
		fn_uninstall_addon('twigmo', false);

 		// Update twigmo files
		fn_echo(fn_get_lang_var('twgadmin_update_files') . '<br>');
		fn_twigmo_update_files($upgrade_dirs);

		// Install
		fn_echo('<br>' . fn_get_lang_var('twgadmin_install_addon') . '<br>');
		fn_install_addon('twigmo', false);

		$_SESSION['twigmo_upgrade'] = array('upgrade_dirs' => $upgrade_dirs, 'insall_src_dir' => $insall_src_dir);
		fn_stop_scroller();
		echo '<br><br>';
		fn_redirect('upgrade_center.upgrade_twigmo.step2');
	}
}

if ($mode == 'upgrade_twigmo' and $action == 'step2' and isset($_SESSION['twigmo_upgrade'])) {
	fn_start_scroller();

	fn_echo(fn_get_lang_var('twgadmin_restore_settings') . '<br>');

	fn_uc_ftp_connect(CSettings::instance()->get_values('Upgrade_center'));

	fn_echo('.');

	$insall_src_dir = $_SESSION['twigmo_upgrade']['insall_src_dir'];
	$upgrade_dirs = fn_twigmo_get_upgrade_dirs($insall_src_dir);

	fn_echo('.');

	// Uninstal addon
	fn_uninstall_addon('twigmo', false);
	fn_echo('.');

	// Install
	fn_install_addon('twigmo', false);
	fn_echo('.');

	// Restore settings
	fn_twigmo_restore_settings($upgrade_dirs, $auth['user_id']);
	fn_echo('.');

	fn_echo('<br><b>' . fn_get_lang_var('upgrade_completed') . '<b><br>');

	unset($_SESSION['twigmo_upgrade']);
	fn_stop_scroller();
	return array(CONTROLLER_STATUS_REDIRECT, "addons.update&addon=twigmo&selected_section=twigmo_addon");
}
?>