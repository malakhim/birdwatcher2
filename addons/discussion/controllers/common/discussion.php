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

	$discussion_settings = Registry::get('addons.discussion');
	$discussion_object_types = fn_get_discussion_objects();

	Registry::set('discussion_settings', $discussion_settings);

	$suffix = '';
	if ($mode == 'add') {
		$suffix = '&selected_section=discussion';
		if (AREA == 'C') {
			if (Registry::get('settings.Image_verification.use_for_discussion') == 'Y' && fn_image_verification('discussion', empty($_REQUEST['verification_answer']) ? '' : $_REQUEST['verification_answer']) == false) {
				fn_save_post_data();
				return array(CONTROLLER_STATUS_REDIRECT, $_REQUEST['redirect_url'] . $suffix);
			}
		}

		$post_data = $_REQUEST['post_data'];

		if (!empty($post_data['thread_id'])) {
			$object = fn_discussion_get_object_by_thread($post_data['thread_id']);
			if (empty($object)) {
				fn_set_notification('E', fn_get_lang_var('error'), fn_get_lang_var('cant_find_thread'));
				return array(CONTROLLER_STATUS_REDIRECT, $_REQUEST['redirect_url'] . $suffix);
			}
			$object_name = $discussion_object_types[$object['object_type']];
			$object_data = fn_get_discussion_object_data($object['object_id'], $object['object_type']);
			$ip = fn_get_ip();
			$post_data['ip_address'] = $ip['host'];
			$post_data['status'] = 'A';

			// Check if post is permitted from this IP address
			if (AREA != 'A' && !empty($discussion_settings[$object_name . '_post_ip_check']) && $discussion_settings[$object_name . '_post_ip_check'] == 'Y') {
				$is_exists = db_get_field("SELECT COUNT(*) FROM ?:discussion_posts WHERE thread_id = ?i AND ip_address = ?s", $post_data['thread_id'], $ip['host']);
				if (!empty($is_exists)) {
					fn_set_notification('E', fn_get_lang_var('error'), fn_get_lang_var('error_already_posted'));

					return array(CONTROLLER_STATUS_REDIRECT, $_REQUEST['redirect_url'] . $suffix);
				}
			}

			// Check if post needs to be approved
			if (AREA != 'A' && !empty($discussion_settings[$object_name . '_post_approval'])) {
				if ($discussion_settings[$object_name . '_post_approval'] == 'any' || ($discussion_settings[$object_name . '_post_approval'] == 'anonymous' && empty($auth['user_id']))) {
					fn_set_notification('W', fn_get_lang_var('text_thank_you_for_post'), fn_get_lang_var('text_post_pended'));
					$post_data['status'] = 'D';
				}
			}


			$_data = fn_check_table_fields($post_data, 'discussion_posts');
			$_data['timestamp'] = TIME;
			$_data['user_id'] = $auth['user_id'];

			$post_data['post_id'] = db_query("INSERT INTO ?:discussion_posts ?e", $_data);

			$_data = fn_check_table_fields($post_data, 'discussion_messages');
			db_query("REPLACE INTO ?:discussion_messages ?e", $_data);

			$_data = fn_check_table_fields($post_data, 'discussion_rating');
			db_query("REPLACE INTO ?:discussion_rating ?e", $_data);

			$view_mail->assign('object_data', $object_data);
			$view_mail->assign('post_data', $post_data);
			$view_mail->assign('object_name', $object_name);
			$view_mail->assign('subject', fn_get_lang_var('discussion_title_' . $discussion_object_types[$object['object_type']]) . ' - ' . fn_get_lang_var($discussion_object_types[$object['object_type']]));

			// For orders - set notification to admin and vendors or customer
			if ($object['object_type'] == 'O') {

				$order_info = db_get_row("SELECT email, company_id, lang_code FROM ?:orders WHERE order_id = ?i", $object['object_id']);

				$company = fn_get_company_placement_info($order_info['company_id']);
				Registry::get('view_mail')->assign('company_placement_info', $company);

				if (AREA == 'C') {
					//Send to admin
					$view_mail->assign('url', fn_url("orders.details?order_id=$object[object_id]", 'A', 'http', '&', null, true));
					fn_send_mail(Registry::get('settings.Company.company_orders_department'), array('email' => $order_info['email'], 'name' => $post_data['name']), 'addons/discussion/notification_subj.tpl', 'addons/discussion/notification.tpl', '', Registry::get('settings.Appearance.admin_default_language'));

					//Send to vendor
					if (!empty($order_info['company_id']) && !empty($discussion_settings[$object_name . '_notify_vendor']) && $discussion_settings[$object_name . '_notify_vendor'] == 'Y') {
						$view_mail->assign('url', fn_url("orders.details?order_id=$object[object_id]", 'V', 'http', '&', null, true));
						fn_send_mail($company['company_orders_department'], array('email' => $order_info['email'], 'name' => $post_data['name']), 'addons/discussion/notification_subj.tpl', 'addons/discussion/notification.tpl', '', fn_get_company_language($order_info['company_id']));
					}

				} elseif (AREA == 'A') {
					$email_from = $company['company_orders_department'];
					$view_mail->assign('url', fn_url("orders.details?order_id=$object[object_id]", 'C', 'http', '&', null, true));
					fn_send_mail($order_info['email'], array('email' => $company['company_orders_department'], 'name' => $company['company_name']), 'addons/discussion/notification_subj.tpl', 'addons/discussion/notification.tpl', '', $order_info['lang_code']);
				}
			} elseif (!empty($discussion_settings[$object_name . '_notification_email']) || (!empty($discussion_settings[$object_name . '_notify_vendor']) && $discussion_settings[$object_name . '_notify_vendor'] == 'Y')) {

				$company_id = 0;
				if (PRODUCT_TYPE == 'MULTIVENDOR') {
					if ($object_name == 'product') {
						$company_id = db_get_field("SELECT company_id FROM ?:products WHERE product_id = ?i", $object['object_id']);
					} elseif ($object_name == 'page') {
						$company_id = db_get_field("SELECT company_id FROM ?:pages WHERE page_id = ?i", $object['object_id']);
					} elseif ($object_name == 'company') {
						$company_id = $object['object_id'];
					}
				}

				$company = fn_get_company_placement_info($company_id);
				Registry::get('view_mail')->assign('company_placement_info', $company);

				$url = "discussion_manager.manage?object_type=$object[object_type]&post_id=$post_data[post_id]";
				$email_from = Registry::get('settings.Company.company_site_administrator');
				if (!empty($email_from)) {

					if (!empty($discussion_settings[$object_name . '_notification_email'])) {
						$view_mail->assign('url', fn_url($url, 'A', 'http', '&', null, true));
						fn_send_mail($discussion_settings[$object_name . '_notification_email'], $email_from, 'addons/discussion/notification_subj.tpl', 'addons/discussion/notification.tpl', '', Registry::get('settings.Appearance.admin_default_language'));
					}

					//Send to vendor
					if (!empty($company_id) && !empty($discussion_settings[$object_name . '_notify_vendor']) && $discussion_settings[$object_name . '_notify_vendor'] == 'Y') {

						$url = ($object_name == 'company' ? 'companie' : $object_name) . "s.update?$object_name" . "_id=$object[object_id]&selected_section=discussion";
						$view_mail->assign('url', fn_url($url, 'V', 'http', '&', null, true));
						fn_send_mail($company['company_site_administrator'], $email_from, 'addons/discussion/notification_subj.tpl', 'addons/discussion/notification.tpl', '', fn_get_company_language($company_id));
					}
				}
			}

		}
	}

	if ($mode == 'update') {
		if (AREA == 'A' && !empty($_REQUEST['posts']) && is_array($_REQUEST['posts'])) {
			$threads = db_get_hash_single_array("SELECT post_id, thread_id FROM ?:discussion_posts WHERE post_id IN (?n)", array('post_id', 'thread_id'), array_keys($_REQUEST['posts']));
			$messages_exist = db_get_fields("SELECT post_id FROM ?:discussion_messages WHERE post_id IN (?n)", array_keys($_REQUEST['posts']));
			$rating_exist = db_get_fields("SELECT post_id FROM ?:discussion_rating WHERE post_id IN (?n)", array_keys($_REQUEST['posts']));

			foreach ($_REQUEST['posts'] as $p_id => $data) {
				db_query("UPDATE ?:discussion_posts SET ?u WHERE post_id = ?i", $data, $p_id);
				if (in_array($p_id, $messages_exist)) {
					db_query("UPDATE ?:discussion_messages SET ?u WHERE post_id = ?i", $data, $p_id);
				} else {
					$data['thread_id'] = $threads[$p_id];
					$data['post_id'] = $p_id;
					db_query("INSERT INTO ?:discussion_messages ?e", $data);
				}

				if (in_array($p_id, $rating_exist)) {
					db_query("UPDATE ?:discussion_rating SET ?u WHERE post_id = ?i", $data, $p_id);
				} else {
					$data['thread_id'] = $threads[$p_id];
					$data['post_id'] = $p_id;
					db_query("INSERT INTO ?:discussion_rating ?e", $data);
				}
			}
		}
	}

	if ($mode == 'delete') {
		if (AREA == 'A' && !empty($_REQUEST['delete_posts']) && is_array($_REQUEST['delete_posts'])) {
			foreach ($_REQUEST['delete_posts'] as $p_id => $v) {
				db_query("DELETE FROM ?:discussion_messages WHERE post_id = ?i", $p_id);
				db_query("DELETE FROM ?:discussion_rating WHERE post_id = ?i", $p_id);
				db_query("DELETE FROM ?:discussion_posts WHERE post_id = ?i", $p_id);
			}
		}
	}

	$redirect_url = "discussion_manager.manage";
	if (!empty($_REQUEST['redirect_url'])) {
		$redirect_url = $_REQUEST['redirect_url'] . $suffix;
	}

	return array(CONTROLLER_STATUS_OK, $redirect_url);
}

if ($mode == 'view') {
	$data = fn_discussion_get_object_by_thread($_REQUEST['thread_id']);
	if (empty($data)) {
		return array(CONTROLLER_STATUS_NO_PAGE);
	}

	if (AREA != 'A') {
		// Check if user has an access for this thread
		if (fn_is_accessible_discussion($data, $auth) == false) {
			return array(CONTROLLER_STATUS_DENIED);
		}

		if ($data['object_type'] == 'E' && !empty($_REQUEST['post_id'])) {
			$post_pos = db_get_field("SELECT COUNT(*) FROM ?:discussion_posts WHERE thread_id = ?i AND post_id >= ?i AND status = 'A' ORDER BY timestamp DESC", $_REQUEST['thread_id'], $_REQUEST['post_id']);
			if (!empty($post_pos)) {
				$sets = Registry::get('addons.discussion');
				$discussion_object_types = fn_get_discussion_objects();
				$items_per_page = $sets[$discussion_object_types[$data['object_type']] . '_posts_per_page'];
				$page = ceil($post_pos / $items_per_page);
				if ((empty($_REQUEST['page']) && $page != 1) || (!empty($_REQUEST['page']) && $page != $_REQUEST['page'])) {
					$_REQUEST['page'] = $page;
				}
				$_SESSION['discussion_post_id'] = $_REQUEST['post_id'];
				return array(CONTROLLER_STATUS_REDIRECT, fn_query_remove(Registry::get('config.current_url'), 'page', 'post_id'));
			}
		}
	}

	$show_discussion_crumb = true;
	if ($data['object_type'] == 'E') { // testimonials
		$show_discussion_crumb = false;
	}

	$discussion_object_data = fn_get_discussion_object_data($data['object_id'], $data['object_type']);

	fn_add_breadcrumb($discussion_object_data['description'], $discussion_object_data['url']);

	if ($show_discussion_crumb && AREA != 'A') {
		fn_add_breadcrumb(fn_get_lang_var('discussion'));
	}

	if (!empty($_SESSION['discussion_post_id'])) {
		$view->assign('current_post_id', $_SESSION['discussion_post_id']);
		unset($_SESSION['discussion_post_id']);
	}

	$view->assign('object_id', $data['object_id']);
	$view->assign('title', $discussion_object_data['description']);
	$view->assign('object_type', $data['object_type']);
}

function fn_discussion_get_object_by_thread($thread_id)
{
	static $cache = array();

	if (empty($cache[$thread_id])) {
		$cache[$thread_id] = db_get_row("SELECT object_type, object_id, type FROM ?:discussion WHERE thread_id = ?i", $thread_id);
	}

	return $cache[$thread_id];
}

?>