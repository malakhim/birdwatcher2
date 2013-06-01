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

$_SESSION['current_path'] = empty($_SESSION['current_path']) ? '' : preg_replace('/^\//', '', $_SESSION['current_path']);
$current_path = & $_SESSION['current_path'];

$_SESSION['msg'] = empty($_SESSION['msg']) ? array() : $_SESSION['msg'];
$msg = & $_SESSION['msg'];

$_SESSION['action_type'] = empty($_SESSION['action_type']) ? array() : $_SESSION['action_type'];
$action_type = & $_SESSION['action_type'];

$dir_skins = fn_get_skin_path('[skins]', 'customer') . '/';

if (empty($_SESSION['show_active_skins_only'])) {
	$_SESSION['show_active_skins_only'] = 'Y';
}

$view->assign('show_active_skins_only', $_SESSION['show_active_skins_only']);

// Disable debug console
$view->debugging = false;
$message = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	if ($mode == 'edit') {
		fn_trusted_vars('file_content');

		if (defined('DEVELOPMENT')) {
			exit;
		}

		$file = fn_basename($_REQUEST['file']);
		$fname = fn_normalize_path($dir_skins . $current_path . $file);
		if (strpos($fname, $dir_skins) !== false && @is_writable($fname) && !in_array(fn_strtolower(fn_get_file_ext($fname)), Registry::get('config.forbidden_file_extensions'))) {
			fn_put_contents($fname, $_REQUEST['file_content']);
			$_msg = fn_get_lang_var('text_file_saved');
			$_msg = str_replace('[file]', $file , $_msg);
			fn_set_notification('N', fn_get_lang_var('notice'), $_msg);
		} else {
			$_msg = fn_get_lang_var('cannot_write_file');
			$_msg = str_replace('[file]', $file , $_msg);
			fn_set_notification('E', fn_get_lang_var('error'), $_msg);
		}

		exit;
	}

	if ($mode == 'upload_file') {
		$uploaded_data = fn_filter_uploaded_data('uploaded_data');
		$pname = fn_normalize_path($dir_skins . $current_path);

		foreach ((array)$uploaded_data as $udata) {
			if (!(strpos($pname, $dir_skins) !== false && @fn_copy($udata['path'], $pname.$udata['name']))) {
				$_msg = fn_get_lang_var('cannot_write_file');
				$_msg = str_replace('[file]', $pname . $udata['name'], $_msg);
				fn_set_notification('E', fn_get_lang_var('error'), $_msg);
			}
		}
		return array(CONTROLLER_STATUS_OK, "template_editor.manage");
	}
}

if ($mode == 'browse') {
	$base_dir = $dir_skins . $current_path;
	$dir = empty($_REQUEST['dir']) ? '' : '/' . $_REQUEST['dir'];
	$tpath = fn_normalize_path($base_dir . $dir);
	
	if (strpos($tpath, $dir_skins) === false) {
		$tpath = $dir_skins;
		$current_path = '';
		$dir = '';
	}

	@clearstatcache();
	if ($dh = @opendir($tpath)) {
		$dirs = array();
		$files = array();

		while (($file = @readdir($dh)) !== false) {
			if ($file == '.') {
				continue;
			}
			if (@is_dir($tpath . '/' .$file)) {

				$skin_type = '';
				if ($tpath == $dir_skins) {
					if (Registry::get('settings.skin_name_customer') == Registry::get('settings.skin_name_admin') && $file == Registry::get('settings.skin_name_admin')) {
						$skin_type = '_ac';
					} elseif ($file == Registry::get('settings.skin_name_customer')) {
						$skin_type = '_c';
					} elseif ($file == Registry::get('settings.skin_name_admin')) {
						$skin_type = '_a';
					}

					if ($_SESSION['show_active_skins_only'] == 'Y' && empty($skin_type)) {
						continue;
					}

				}

				$dirs[$file] = array('name' => $file, 'type' => 'D', 'perms' => fn_display_perms(fileperms($tpath . '/' .$file)), 'skin_type' => $skin_type);
			}

			if (@is_file($tpath . '/' .$file)) {
				$files[$file] = array('name' => $file, 'type' => 'F', 'ext' => fn_get_file_ext($file), 'perms' => fn_display_perms(fileperms($tpath . '/' . $file)));
			}
		}

		ksort($dirs, SORT_STRING);
		ksort($files, SORT_STRING);

		$__cols = fn_array_merge($dirs, $files, false);
		$view->assign('current_path', str_replace(DIR_ROOT, '', $tpath));
		$view->assign('columns', fn_split($__cols, (sizeof($__cols)+1)/2, false));

		$current_path .= empty($dir) ? '' : ($dir.'/');
		$current_path = fn_normalize_path($current_path);

		Registry::get('ajax')->assign('current_path', str_replace(DIR_ROOT, '', $tpath));
		Registry::get('ajax')->assign('show_legend', !empty($current_path));
		@closedir($dh);

		Registry::get('ajax')->assign('files_list', $view->display('views/template_editor/components/file_list.tpl', false));
		Registry::get('ajax')->assign('directory_data', fn_array_merge($dirs, $files));
	}
	exit;

} elseif ($mode == 'delete_file') {

	$file = fn_basename($_REQUEST['file']);
	$fname = fn_normalize_path($dir_skins . $current_path . $file);
	$fn_name = @is_dir($fname) ? 'fn_rm': 'unlink';
	$object = @is_dir($fname) ? 'directory' : 'file';

	if (!in_array(fn_strtolower(fn_get_file_ext($file)), Registry::get('config.forbidden_file_extensions'))) {
		if (strpos($fname, $dir_skins) !== false && @$fn_name($fname)) {
			$msg = fn_get_lang_var("text_{$object}_deleted");
			$action_type = '';
			$msg_type = 'N';
			$msg_title = fn_get_lang_var('notice');
		} else {
			$action_type = 'error';
			$msg = fn_get_lang_var("text_cannot_delete_{$object}");
			$msg_type = 'E';
			$msg_title = fn_get_lang_var('error');
		}
		fn_set_notification($msg_type, $msg_title, str_replace("[{$object}]", $file, $msg));
	} else {
		fn_set_notification('E', fn_get_lang_var('error'), fn_get_lang_var('you_have_no_permissions'));
	}

	Registry::get('ajax')->assign('action_type',  $action_type);
	exit;
} elseif ($mode == 'rename_file') {

	$file = fn_basename($_REQUEST['file']);
	$rename_to = fn_basename($_REQUEST['rename_to']);
	$pname = fn_normalize_path($dir_skins . $current_path);
	$object = @is_dir($pname.$file) ? 'directory' : 'file';
	$ext_from = fn_get_file_ext($file);
	$ext_to = fn_get_file_ext($rename_to);

	if (in_array(fn_strtolower($ext_from), Registry::get('config.forbidden_file_extensions')) || in_array(fn_strtolower($ext_to), Registry::get('config.forbidden_file_extensions'))) {
		$action_type = 'error';
		$msg = fn_get_lang_var('text_forbidden_file_extension');
		$msg = str_replace('[ext]', $ext_to, $msg);
		$msg_type = 'E';
		$msg_title = fn_get_lang_var('error');
	} elseif (strpos($pname, $dir_skins) !== false && @fn_rename($pname.$file, $pname.$rename_to)) {
		$msg = fn_get_lang_var("text_{$object}_renamed");
		$action_type = '';
		$msg_type = 'N';
		$msg_title = fn_get_lang_var('notice');
	} else {
		$action_type = 'error';
		$msg = fn_get_lang_var("text_cannot_rename_{$object}");
		$msg_type = 'E';
		$msg_title = fn_get_lang_var('error');
	}

	$msg = str_replace("[{$object}]", $file, $msg);
	$msg = str_replace("[to_{$object}]", $rename_to, $msg);
	fn_set_notification($msg_type, $msg_title, $msg);
	Registry::get('ajax')->assign('action_type',  $action_type);
	exit;
} elseif ($mode == 'create_file') {

	$pathinfo = fn_pathinfo($_REQUEST['file']);
	$file = $pathinfo['basename'];
	$pname = fn_normalize_path($dir_skins . $current_path);
	$ext = $pathinfo['extension'];

	if (in_array(fn_strtolower($ext), Registry::get('config.forbidden_file_extensions')) || empty($file)) {
		$action_type = 'error';
		$msg = fn_get_lang_var('text_forbidden_file_extension');
		$msg = str_replace('[ext]', $ext, $msg);
		$msg_type = 'E';
		$msg_title = fn_get_lang_var('error');
		
	} elseif (strpos($pname, $dir_skins) !== false && @touch($pname.$file)) {
		@chmod($pname.$file, DEFAULT_FILE_PERMISSIONS);
		$msg = fn_get_lang_var('text_file_created');
		$action_type = '';
		$msg_type = 'N';
		$msg_title = fn_get_lang_var('notice');
		
	} else {
		$action_type = 'error';
		$msg = fn_get_lang_var('text_cannot_create_file');
		$msg_type = 'E';
		$msg_title = fn_get_lang_var('error');
	}

	fn_set_notification($msg_type, $msg_title, str_replace('[file]', $file, $msg));
	$ajax->assign('action_type',  $action_type);
	exit;
} elseif ($mode == 'create_directory') {

	$file = fn_basename($_REQUEST['file']);
	$pname = fn_normalize_path($dir_skins . $current_path);
	if (strpos($pname, $dir_skins) !== false && @fn_mkdir($pname.$file)) {
		$msg = fn_get_lang_var('text_directory_created');
		$action_type = '';
		$msg_type = 'N';
		$msg_title = fn_get_lang_var('notice');
		
	} else {
		$action_type = 'error';
		$msg = fn_get_lang_var('text_cannot_create_directory');
		$msg_type = 'E';
		$msg_title = fn_get_lang_var('error');
	}

	fn_set_notification($msg_type, $msg_title, str_replace('[directory]', $file, $msg));
	Registry::get('ajax')->assign('action_type',  $action_type);
	exit;
} elseif ($mode == 'chmod') {

	$file = fn_basename($_REQUEST['file']);
	$fname = fn_normalize_path($dir_skins . $current_path . $file);
	if (!empty($_REQUEST['r']) && $_REQUEST['r'] == 'Y') {
		$res = fn_rchmod($fname, octdec($_REQUEST['perms']));
	} else {
		$res = @chmod($fname, octdec($_REQUEST['perms']));
	}
	
	if ($res) {
		$msg = fn_get_lang_var('text_permissions_changed');
		$msg_type = 'N';
		$msg_title = fn_get_lang_var('notice');
	} else {
		$msg = fn_get_lang_var('error_permissions_not_changed');
		$msg_type = 'E';
		$msg_title = fn_get_lang_var('error');
	}

	fn_set_notification($msg_type, $msg_title, $msg);
	Registry::get('ajax')->assign('action_type',  $res ? '': 'error');
	exit;
} elseif ($mode == 'get_file') {

	$file = fn_basename($_REQUEST['file']);

	if (!in_array(fn_strtolower(fn_get_file_ext($file)), Registry::get('config.forbidden_file_extensions'))) {
		$pname = fn_normalize_path($dir_skins . $current_path);
		fn_get_file($pname . $file);
	}

	exit;
} elseif ($mode == 'edit') {
	$file = fn_basename($_REQUEST['file']);
	$fname = fn_normalize_path($dir_skins . $current_path . $file);

	if (!in_array(fn_strtolower(fn_get_file_ext($fname)), Registry::get('config.forbidden_file_extensions'))) {
		if (fn_get_image_size($fname)) {
			$ajax->assign('img', Registry::get('config.http_location') . str_replace(DIR_ROOT, '', $fname));
		} else {
			$ajax->assign('content', fn_get_contents($fname));
		}
	} else {
		fn_set_notification('E', fn_get_lang_var('error'), fn_get_lang_var('you_have_no_permissions'));
	}

	exit;
} elseif ($mode == 'restore') {

	$copied = false;
	$file = fn_basename($_REQUEST['file']);
	$c_name = fn_normalize_path($dir_skins . $current_path . $file);

	$b_path = fn_normalize_path($current_path);

	// First, try to restore object from the base repository
	$arr = explode('/', $b_path);
	$arr[0] = 'basic';
	$b_path = implode('/', $arr);
	$b_name = fn_normalize_path(DIR_SKINS . $b_path . $file);

	$o_name = str_replace('/skins/', '/var/skins_repository/', $b_name);
	$object_base = is_file($o_name) ? 'file' : (is_dir($o_name) ? 'directory' : '');
	if (!empty($object_base)) {
		$copied = fn_copy($o_name, $c_name);
	}

	$o_name = str_replace('/skins/', '/var/skins_repository/', $c_name);
	$object_scheme = is_file($o_name) ? 'file' : (is_dir($o_name) ? 'directory' : '');
	if (!empty($object_scheme)) {
		$copied = fn_copy($o_name, $c_name);
	}

	$object = is_file($c_name) ? 'file' : (is_dir($c_name) ? 'directory' : '');
	if ($copied == true) {
		$msg = fn_get_lang_var("text_{$object}_restored");
		$action_type = '';
		$msg_type = 'N';
		$msg_title = fn_get_lang_var('notice');
		
	} else {
		$action_type = 'error';
		$msg = fn_get_lang_var("text_cannot_restore_{$object}");
		$msg_type = 'E';
		$msg_title = fn_get_lang_var('error');
	}

	fn_set_notification($msg_type, $msg_title, str_replace("[{$object}]", $file, $msg));
	Registry::get('ajax')->assign('action_type',  $action_type);
	Registry::get('ajax')->assign('force_redirection', fn_url('template_editor.manage'));
	Registry::get('ajax')->assign('non_ajax_notifications', true);
	
	exit;

} elseif ($mode == 'active_skins') {
	
	$_SESSION['show_active_skins_only'] = !empty($_REQUEST['show_active_skins_only']) ? 'Y' : 'N';
	exit;
}

// ----------------------------------- function definitions ----------------------
function fn_display_perms($mode)
{
	if (defined('IS_WINDOWS')) {
		return '';
	}

	$owner = array();
	$group = array();
	$world = array();

	// Determine permissions
	$owner["read"] = ($mode & 00400) ? 'r' : '-';
	$owner["write"] = ($mode & 00200) ? 'w' : '-';
	$owner["execute"] = ($mode & 00100) ? 'x' : '-';
	$group["read"] = ($mode & 00040) ? 'r' : '-';
	$group["write"] = ($mode & 00020) ? 'w' : '-';
	$group["execute"] = ($mode & 00010) ? 'x' : '-';
	$world["read"] = ($mode & 00004) ? 'r' : '-';
	$world["write"] = ($mode & 00002) ? 'w' : '-';
	$world["execute"] = ($mode & 00001) ? 'x' : '-';

	// Adjust for SUID, SGID and sticky bit
	if ($mode & 0x800) {
		$owner["execute"] = ($owner['execute']=='x') ? 's' : 'S';
	}
	if ($mode & 0x400) {
		$group["execute"] = ($group['execute']=='x') ? 's' : 'S';
	}
	if ($mode & 0x200) {
		$world["execute"] = ($world['execute']=='x') ? 't' : 'T';
	}

	$s=sprintf("%1s%1s%1s", $owner['read'], $owner['write'], $owner['execute']);
	$s.=sprintf("%1s%1s%1s", $group['read'], $group['write'], $group['execute']);
	$s.=sprintf("%1s%1s%1s", $world['read'], $world['write'], $world['execute']);
	return trim($s);
}

//
// Recursively remove directory (or just a file)
//
function fn_rchmod($source, $perms = DEFAULT_DIR_PERMISSIONS)
{
    // Simple copy for a file
    if (is_file($source)) {
		$res = @chmod($source, $perms);
        return $res;
    }

    // Loop through the folder
	if (is_dir($source)) {
		$dir = dir($source);
		while (false !== $entry = $dir->read()) {
			// Skip pointers
			if ($entry == '.' || $entry == '..') {
				continue;
			}
	 		if (fn_rchmod($source . '/' . $entry, $perms) == false) {
				return false;
			}
		}
		// Clean up
		$dir->close();
		return @chmod($source, $perms);
	} else {
		return false;
	}
}

?>