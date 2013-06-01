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


if (!defined('AREA')) { die('Access denied'); }

function fn_get_attachments($object_type, $object_id, $type = 'M', $lang_code = CART_LANGUAGE)
{
	if (AREA == 'A') {
		$data = db_get_array("SELECT ?:attachments.*, ?:attachment_descriptions.description FROM ?:attachments LEFT JOIN ?:attachment_descriptions ON ?:attachments.attachment_id = ?:attachment_descriptions.attachment_id AND lang_code = ?s WHERE object_type = ?s AND object_id = ?i AND type = ?s ORDER BY position", $lang_code, $object_type, $object_id, $type);
	} else {
		$auth = $_SESSION['auth'];

		$ug_cond = ' AND (' . fn_find_array_in_set($auth['usergroup_ids'], 'usergroup_ids', true) . ')';
		$data = db_get_array("SELECT ?:attachments.*, ?:attachment_descriptions.description FROM ?:attachments LEFT JOIN ?:attachment_descriptions ON ?:attachments.attachment_id = ?:attachment_descriptions.attachment_id AND lang_code = ?s WHERE object_type = ?s AND object_id = ?i AND type = ?s AND filesize > 0 ?p AND status = 'A' ORDER BY position", $lang_code, $object_type, $object_id, $type, $ug_cond);
	}

	return $data;
}

function fn_update_attachments($attachment_data, $attachment_id, $object_type, $object_id, $type = 'M', $files = null, $lang_code = DESCR_SL)
{
	$object_id = intval($object_id);
	$directory = DIR_ATTACHMENTS . '/' . $object_type . '/' . $object_id;

	if (!fn_mkdir($directory)) {
		return false;
	}

	if ($files != null) {
		$uploaded_data = $files;
	} else {
		$uploaded_data = fn_filter_uploaded_data('attachment_files');
	}

	if (!empty($attachment_id)) {

		$rec = array (
			'usergroup_ids' => empty($attachment_data['usergroup_ids']) ? '0' : implode(',', $attachment_data['usergroup_ids']),
			'position' => $attachment_data['position']
		);

		db_query("UPDATE ?:attachment_descriptions SET description = ?s WHERE attachment_id = ?i AND lang_code = ?s", $attachment_data['description'], $attachment_id, $lang_code);
		db_query("UPDATE ?:attachments SET ?u WHERE attachment_id = ?i AND object_type = ?s AND object_id = ?i AND type = ?s", $rec, $attachment_id, $object_type, $object_id, $type);

		fn_set_hook('attachment_update_file', $attachment_data, $attachment_id, $object_type, $object_id, $type, $files, $lang_code, $uploaded_data);
	} else {
		$rec = array (
			'object_type' => $object_type,
			'object_id' => $object_id,
			'usergroup_ids' => empty($attachment_data['usergroup_ids']) ? '0' : implode(',', $attachment_data['usergroup_ids']),
			'position' => $attachment_data['position']
		);

		if ($type !== null) {
			$rec['type'] = $type;
		} elseif (!empty($attachment_data['type'])) {
			$rec['type'] = $attachment_data['type'];
		}

		$attachment_id = db_query("INSERT INTO ?:attachments ?e", $rec);

		if ($attachment_id) {
			// Add file description
			foreach ((array)Registry::get('languages') as $lang_code => $v) {
				$rec = array (
					'attachment_id' => $attachment_id,
					'lang_code' => $lang_code,
					'description' => is_array($attachment_data['description']) ? $attachment_data['description'][$lang_code] : $attachment_data['description']
				);

				db_query("INSERT INTO ?:attachment_descriptions ?e", $rec);
			}

			$uploaded_data[$attachment_id] = $uploaded_data[0];
			unset($uploaded_data[0]);
		}

		fn_set_hook('attachment_add_file', $attachment_data, $object_type, $object_id, $type, $files, $attachment_id, $uploaded_data);
	}

	if ($attachment_id && !empty($uploaded_data[$attachment_id]) && $uploaded_data[$attachment_id]['size']) {
		$filename = $uploaded_data[$attachment_id]['name'];

		$old_filename = db_get_field("SELECT filename FROM ?:attachments WHERE attachment_id = ?i", $attachment_id);

		if ($old_filename && is_file($directory . '/' . $old_filename)) {
			unlink($directory . '/' . $old_filename);
		}

		$i = 1;
		while (is_file($directory . '/' . $filename)) {
			$filename = substr_replace($uploaded_data[$attachment_id]['name'], sprintf('%03d', $i) . '.', strrpos($uploaded_data[$attachment_id]['name'], '.'), 1);
			$i++;
		}

		fn_copy($uploaded_data[$attachment_id]['path'], $directory . '/' . $filename);

		if (is_file($directory . '/' . $filename)) {
			$filesize = filesize($directory . '/' . $filename);
			db_query("UPDATE ?:attachments SET filename = ?s, filesize = ?i WHERE attachment_id = ?i", $filename, $filesize, $attachment_id);
		}
	}

	return $attachment_id;
}

function fn_delete_attachments($attachment_ids, $object_type, $object_id)
{
	fn_set_hook('attachment_delete_file', $attachment_ids, $object_type, $object_id);

	$data = db_get_array("SELECT * FROM ?:attachments WHERE attachment_id IN (?n) AND object_type = ?s AND object_id = ?i", $attachment_ids, $object_type, $object_id);

	foreach ($data as $entry) {
		$directory = DIR_ATTACHMENTS . '/' . $entry['object_type'] . '/' . $object_id;

		if ($entry['filename'] && is_file($directory . '/' . $entry['filename'])) {
			unlink($directory . '/' . $entry['filename']);
		}
	}

	db_query("DELETE FROM ?:attachments WHERE attachment_id IN (?n) AND object_type = ?s AND object_id = ?i", $attachment_ids, $object_type, $object_id);
	db_query("DELETE FROM ?:attachment_descriptions WHERE attachment_id IN (?n)", $attachment_ids);

	return true;
}

function fn_get_attachment($attachment_id, $object_type = null, $object_id = null)
{
	if ($object_type === null) {
		$auth = $_SESSION['auth'];

		$ug_cond = ' AND (' . fn_find_array_in_set($auth['usergroup_ids'], 'usergroup_ids', true) . ')';
		$data = db_get_row("SELECT * FROM ?:attachments WHERE attachment_id = ?i ?p AND status = 'A'", $attachment_id, $ug_cond);

		if (!empty($data['filename'])) {
			$directory = DIR_ATTACHMENTS . '/' . $data['object_type'] . '/' . $data['object_id'];
			$data['path'] = $directory . '/' . $data['filename'];
		}

		return $data;
	}

	if (AREA == 'A') {
		$data = db_get_row("SELECT * FROM ?:attachments WHERE attachment_id = ?i", $attachment_id);
	}

	if (!empty($data['filename'])) {
		$directory = DIR_ATTACHMENTS . '/' . $data['object_type'] . '/' . $object_id;
		$data['path'] = $directory . '/' . $data['filename'];
	}

	fn_set_hook('attachments_get_attachment', $data, $attachment_id, $object_type, $object_id);

	return $data;
}

function fn_clone_attachments($object_type, $target_object_id, $object_id)
{
	$data = db_get_array("SELECT * FROM ?:attachments WHERE object_type = ?s AND object_id = ?i", $object_type, $object_id);

	$directory = DIR_ATTACHMENTS . '/' . $object_type . '/' . $target_object_id;

	$i = 1;

	foreach ($data as $entry) {
		$files = array();
		if (!empty($entry['filename'])) {
			$f_name = $directory . '/' . $entry['filename'];

			$files[0] = array (
				'path' => $f_name,
				'size' => filesize($f_name),
				'error' => 0,
				'name' => $entry['filename'],
			);
		}

		$attachment_data = array (
			'attachment_id' => $entry['attachment_id'],
			'usergroup_ids' => implode(',', $entry['usergroup_ids']),
			'position' => $entry['position'],
			'type' => $entry['type'],
			'description' => db_get_hash_single_array("SELECT * FROM ?:attachment_descriptions WHERE attachment_id = ?i", array('lang_code', 'description'), $entry['attachment_id'])
		);

		fn_update_attachments($attachment_data, $entry['attachment_id'], $object_type, $target_object_id, $entry['type'], $files);
	}
}


/**
 * Function clone product's attachments
 *
 * @param int $product_id old product id
 * @param int $pid new product id
 * @return always true
 */
function fn_attachments_clone_product($product_id, $pid)
{
	$add_data = array();
	$attachments = db_get_array("SELECT * FROM ?:attachments WHERE object_type = 'product' AND object_id = ?i", $product_id);

	foreach ($attachments as &$attachment) {
		$attachment_descriptions = db_get_array("SELECT * FROM ?:attachment_descriptions WHERE attachment_id = ?i", $attachment['attachment_id']);

		$attachment['attachment_id'] = 0;
		$attachment['object_id'] = $pid;

		$attachid = db_query("INSERT INTO ?:attachments ?e", $attachment);

		$directory = DIR_ATTACHMENTS . '/product' . '/';

		fn_copy($directory . $product_id, $directory . $pid);

		foreach ($attachment_descriptions as &$descr) {
			$descr['attachment_id'] = $attachid;
			db_query("INSERT INTO ?:attachment_descriptions ?e", $descr);
		}
	}
}

/**
 * Function delete product's attachments
 *
 * @param int $product_id product id
 * @return always true
 */
function fn_attachments_delete_product_post($product_id)
{
	$attachments = db_get_fields("SELECT attachment_id FROM ?:attachments WHERE object_type = 'product' AND object_id = ?i", $product_id);

	fn_rm(DIR_ATTACHMENTS . '/product/' . $product_id);

	foreach ($attachments as $attachment_id) {
		db_query("DELETE FROM ?:attachments WHERE attachment_id = ?i", $attachment_id);
		db_query("DELETE FROM ?:attachment_descriptions WHERE attachment_id = ?i", $attachment_id);
	}
}

?>