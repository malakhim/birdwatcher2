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
// Get all news data
//
function fn_get_news($params, $lang_code = CART_LANGUAGE)
{
	$fields = array (
		'?:news.*',
		'descr.news',
		'descr.description'
	);

	// Define sort fields
	$sortings = array (
		'position' => '?:news.position',
		'name' => 'descr.news',
		'date' => '?:news.date',
	);

	$directions = array (
		'asc' => 'asc',
		'desc' => 'desc'
	);

	$limit = $condition = $sorting = '';

	$join = db_quote(" LEFT JOIN ?:news_descriptions as descr ON descr.news_id = ?:news.news_id AND descr.lang_code = ?s", $lang_code);

	$condition .= (AREA == 'A') ? '1 ' : " ?:news.status = 'A'";

	$condition .= fn_get_localizations_condition('?:news.localization');

	// Get additional information about companies
	if (PRODUCT_TYPE == 'ULTIMATE') {
		$fields[] = ' ?:companies.company as company';
		$sortings[] = 'company';
		$join .= db_quote(" LEFT JOIN ?:companies ON ?:companies.company_id = ?:news.company_id");
	}

	if (isset($params['q']) && fn_string_not_empty($params['q'])) {

		$params['q'] = trim($params['q']);
		if ($params['match'] == 'any') {
			$pieces = fn_explode(' ', $params['q']);
			$search_type = ' OR ';
		} elseif ($params['match'] == 'all') {
			$pieces = fn_explode(' ', $params['q']);
			$search_type = ' AND ';
		} else {
			$pieces = array($params['q']);
			$search_type = '';
		}

		$_condition = array ();
		foreach ($pieces as $piece) {
			if (strlen($piece) == 0) {
				continue;
			}
			$tmp = array ();

			$tmp[] = db_quote("descr.news LIKE ?l", "%$piece%");
			$tmp[] = db_quote("descr.description LIKE ?l", "%$piece%");

			$_condition[] = '(' . join(' OR ', $tmp) . ')';
		}

		$_cond = implode($search_type, $_condition);

		if (!empty($_condition)) {
			$condition .= ' AND (' . $_cond . ') ';
		}
	}

	if (!empty($params['limit'])) {
		$limit = db_quote(" LIMIT 0, ?i", $params['limit']);
	}

	if (empty($params['sort_order']) || empty($directions[$params['sort_order']])) {
		$params['sort_order'] = 'desc';
	}

	if (empty($params['sort_by']) || empty($sortings[$params['sort_by']])) {
		$params['sort_by'] = 'date';
	}

	$sorting = $sortings[$params['sort_by']] . ' ' . $directions[$params['sort_order']];

	if (!empty($params['period']) && $params['period'] != 'A') {
		list($params['time_from'], $params['time_to']) = fn_create_periods($params);
		$condition .= db_quote(" AND (?:news.date >= ?i AND ?:news.date <= ?i)", $params['time_from'], $params['time_to']);
	}

	if (!empty($params['item_ids'])) {
		$condition .= db_quote(' AND ?:news.news_id IN (?n)', explode(',', $params['item_ids']));
	}

	fn_set_hook('get_news', $params, $fields, $join, $condition, $sorting, $limit, $lang_code);

	// Used for Extended search
	if (!empty($params['get_conditions'])) {
		return array($fields, $join, $condition);
	}

	if (!empty($params['paginate'])) {
		$params['page'] = empty($params['page']) ? 1 : $params['page'];
		$total = db_get_field("SELECT COUNT(?:news.news_id) FROM ?:news ?p WHERE ?p", $join, $condition);
		$limit = fn_paginate($params['page'], $total, (AREA == 'A')? Registry::get('settings.Appearance.admin_elements_per_page') : Registry::get('settings.Appearance.elements_per_page'));
	}

	$fields = join(', ', $fields);
	$news = db_get_array("SELECT ?p FROM ?:news ?p WHERE ?p ORDER BY ?p ?p", $fields, $join, $condition, $sorting, $limit);

	fn_set_hook('get_news_post', $news);

	return array($news, $params);
}

//
// Get specific news data
//
function fn_get_news_data($news_id, $lang_code = CART_LANGUAGE)
{
	$fields = array (
		'?:news.*',
		'?:news_descriptions.news',
		'?:news.date',
		'?:news_descriptions.description'
	);

	$join = '';
	$condition = (AREA == 'A') ? '' : " AND ?:news.status = 'A' ";

	fn_set_hook('get_news_data', $fields, $join, $condition, $lang_code);

	$news = db_get_row(
		"SELECT " . implode(', ', $fields) . " FROM ?:news "
		. "LEFT JOIN ?:news_descriptions ON ?:news_descriptions.news_id = ?:news.news_id "
		. "AND ?:news_descriptions.lang_code = ?s ?p "
		. "WHERE ?:news.news_id = ?i ?p",
		$lang_code, $join, $news_id, $condition
	);

	return $news;
}

function fn_get_news_name($news_id, $lang_code = CART_LANGUAGE)
{
	if (!empty($news_id)) {
		return db_get_field("SELECT news FROM ?:news_descriptions WHERE news_id = ?i AND lang_code = ?s", $news_id, $lang_code);
	}

	return false;
}

function fn_get_newsletter_name($newsletter_id, $lang_code = CART_LANGUAGE)
{
	if (!empty($newsletter_id)) {
		return db_get_field("SELECT newsletter FROM ?:newsletter_descriptions WHERE newsletter_id = ?i AND lang_code = ?s", $newsletter_id, $lang_code);
	}

	return false;
}

//
// Get all newsletters data
//
function fn_get_newsletters($params = array(), $lang_code = CART_LANGUAGE)
{
	$default_params = array(
		'type' => NEWSLETTER_TYPE_NEWSLETTER,
		'only_available' => true, // hide hidden and not available newsletters. We use 'false' for admin page
	);

	$params = array_merge($default_params, $params);

	$_conditions = array();

	if ($params['only_available']) {
		$_conditions[] = "?:newsletters.status = 'A'";
	}

	if ($params['type']) {
		$_conditions[] = db_quote("?:newsletters.type = ?s", $params['type']);
	}

	if (!empty($_conditions)) {
		$_conditions = implode(' AND ', $_conditions);
	} else {
		$_conditions = '1';
	}

	$limit = '';
	if (!empty($params['paginate'])) {
		$params['page'] = empty($params['page']) ? 1 : $params['page'];
		$total = db_get_field("SELECT COUNT(*) FROM ?:newsletters WHERE ?p", $_conditions);
		$limit = fn_paginate($params['page'], $total, (AREA == 'A')? Registry::get('settings.Appearance.admin_elements_per_page') : Registry::get('settings.Appearance.elements_per_page'));
	}

	$newsletters = db_get_array(
		"SELECT ?:newsletters.newsletter_id, ?:newsletters.status, ?:newsletters.sent_date, "
		. "?:newsletters.status, ?:newsletter_descriptions.newsletter FROM ?:newsletters "
		. "LEFT JOIN ?:newsletter_descriptions ON ?:newsletter_descriptions.newsletter_id=?:newsletters.newsletter_id "
		. "AND ?:newsletter_descriptions.lang_code= ?s "
		. "WHERE ?p ORDER BY ?:newsletters.sent_date DESC, ?:newsletters.status $limit",
		$lang_code, $_conditions
	);

	return $newsletters;
}


//
// Get specific newsletter data
//
function fn_get_newsletter_data($newsletter_id, $lang_code = CART_LANGUAGE)
{
	$status_condition = (AREA == 'A') ? '' : " AND ?:newsletters.status='A' ";

	$newsletter = db_get_row("SELECT * FROM ?:newsletters LEFT JOIN ?:newsletter_descriptions ON ?:newsletter_descriptions.newsletter_id = ?:newsletters.newsletter_id AND ?:newsletter_descriptions.lang_code = ?s WHERE ?:newsletters.newsletter_id = ?i $status_condition", $lang_code, $newsletter_id);

	if (!empty($newsletter)) {
		$newsletter['mailing_lists'] = explode(',', $newsletter['mailing_lists']);
	}

	return $newsletter;
}

//
// Get mailing list data
//
function fn_get_mailing_list_data($list_id, $lang_code = CART_LANGUAGE)
{
	$status_condition = (AREA == 'A') ? '' : " AND m.status = 'A' ";

	return db_get_row("SELECT * FROM ?:mailing_lists m LEFT JOIN ?:common_descriptions d ON m.list_id = d.object_id AND d.lang_code = ?s AND d.object_holder = 'mailing_lists' WHERE m.list_id = ?i $status_condition", $lang_code, $list_id);
}

function fn_news_and_emails_get_discussion_object_data(&$data, $object_id, $object_type)
{
	if ($object_type == 'N') { // news
		$data['description'] = db_get_field("SELECT news FROM ?:news_descriptions WHERE news_id = ?i AND lang_code = ?s", $object_id, CART_LANGUAGE);
		if (AREA == 'A') {
			$data['url'] = "news.update?news_id=$object_id&selected_section=discussion";
		} else {
			$data['url'] = "news?news_id=$object_id";
		}
	}
}

function fn_news_and_emails_get_discussion_objects(&$objects)
{
	$objects['N'] = 'news';
}

function fn_news_and_emails_is_accessible_discussion($data, &$auth, &$access)
{
	if ($data['object_type'] == 'N') {// news
		$access = fn_get_news_data($data['object_id']);
	}
}

function fn_news_and_emails_localization_objects(&$_tables)
{
	$_tables[] = 'news';
}

function fn_news_and_emails_search_init()
{
	fn_search_register_object(
		'news',
		'fn_news_and_email_create_news_condition',
		array(),
		fn_get_lang_var('site_news'),
		'',
		'',
		'news.manage?compact=Y&q=%search%&match=any&content_id=news_content',
		'news.update&news_id=%id%'
	);
}

function fn_news_and_emails_save_log($type, $action, &$data, $user_id, &$content, &$event_type)
{
	if ($type == 'news') {
		$news = db_get_field("SELECT news FROM ?:news_descriptions WHERE news_id = ?i AND lang_code = ?s", $data['news_id'], Registry::get('settings.Appearance.admin_default_language'));
		$content = array (
			'news' => $news . ' (#' . $data['news_id'] . ')',
		);
	}
}

//
// News condition function
//
function fn_news_and_email_create_news_condition($params, $lang_code = CART_LANGUAGE)
{
	$params['get_conditions'] = true;

	list($fields, $join, $condition) = fn_get_news($params, $lang_code);



	$data = array (
		'fields' => $fields,
		'join' => $join,
		'condition' => $condition,
		'table' => '?:news',
		'key' => 'news_id',
		'sort' => 'descr.news',
		'sort_table' => 'news_descriptions'
	);

	return $data;
}

function fn_update_news($news_id, $news_data, $lang_code = CART_LANGUAGE)
{
	// news title required
	if (empty($news_data['news'])) {
		return false;
	}

	$_data = $news_data;
	$_data['date'] = fn_parse_date($news_data['date']);
	if (isset($_data['localization'])) {
		$_data['localization'] = empty($_data['localization']) ? '' : fn_implode_localizations($_data['localization']);
	}

	if (empty($news_id)) {
		$create = true;  
		
		$news_id = $_data['news_id'] = db_query("REPLACE INTO ?:news ?e", $_data);

		if (empty($news_id)) {
			return false;
		}

		// Adding descriptions
		foreach ((array)Registry::get('languages') as $_data['lang_code'] => $v) {
			db_query("INSERT INTO ?:news_descriptions ?e", $_data);
		}

	} else {
		$create = false;

		db_query("UPDATE ?:news SET ?u WHERE news_id = ?i", $_data, $news_id);

		// update news descriptions
		$_data = $news_data;
		db_query("UPDATE ?:news_descriptions SET ?u WHERE news_id = ?i AND lang_code = ?s", $_data, $news_id, $lang_code);
	}

	// Log news update/add
	fn_log_event('news', !empty($create) ? 'create' : 'update', array(
		'news_id' => $news_id
	));

	fn_set_hook('update_news', $news_data, $news_id, $lang_code, $create);

	return $news_id;
}

// if called first time - registers all links in db
// returns newsletter bodies with rewritten links
function fn_rewrite_links($body_txt, $body_html, $newsletter_id, $campaign_id)
{
	$regex = "/href=('|\")((?:http|ftp|https):\/\/[\w-\.]+[?]?[-\w:\+?\/?\.\=%&;~\[\]]+)/ie";
	$url = fn_url('newsletters.track', 'C', 'http', '&');
	$replace_regex = '"href=\\1$url&link=" . fn_register_link("\\2", $newsletter_id, $campaign_id) . "-" . $newsletter_id . "-" . $campaign_id';
	$matches = array();
	$body_txt = preg_replace($regex, $replace_regex, $body_txt);
	$body_html = preg_replace($regex, $replace_regex, $body_html);

	return array($body_txt, $body_html);
}

function fn_register_link($url, $newsletter_id, $campaign_id)
{
	$url = str_replace('&amp;', '&', rtrim($url, '/'));
	$_where = array(
		'newsletter_id' => $newsletter_id,
		'campaign_id' => $campaign_id,
		'url' => $url
	);
	$link = db_get_row("SELECT link_id FROM ?:newsletter_links WHERE ?w", $_where);
	if (empty($link)) {
		$_data = array();
		$_data['url'] = $url;
		$_data['campaign_id'] = $campaign_id;
		$_data['newsletter_id'] = $newsletter_id;
		$_data['clicks'] = 0;

		return db_query("INSERT INTO ?:newsletter_links ?e", $_data);
	} else {
		return $link['link_id'];
	}
}


function fn_send_newsletter($to, $from, $subj, $body, $attachments = array(), $lang_code = CART_LANGUAGE, $reply_to = '', $is_html)
{
	$reply_to = !empty($reply_to) ? $reply_to : Registry::get('settings.Company.company_newsletter_email');
	Registry::get('view_mail')->assign('body', $body);
	Registry::get('view_mail')->assign('subj', $subj);

	$_from = array(
		'email' => !empty($from['from_email']) ? $from['from_email'] : Registry::get('settings.Company.company_newsletter_email'),
		'name' => !empty($from['from_name']) ? $from['from_name'] : Registry::get('settings.Company.company_name')
	);

	return fn_send_mail($to, $_from, 'addons/news_and_emails/newsletter_subj.tpl', 'addons/news_and_emails/newsletter_body.tpl', $attachments, $lang_code, $reply_to, $is_html);
}

/**
* generate unsubscribe link. if list_id=0 and subscriber_id=0 - generate stub key for test email
*
* @param int list_id - mailing list id
* @param int subscriber_id
* @return string unsubscribe_link
*/
function fn_generate_unsubscribe_link($list_id, $subscriber_id)
{
	if ($list_id && $subscriber_id) {
		$unsubscribe_key = db_get_field("SELECT unsubscribe_key FROM ?:user_mailing_lists WHERE subscriber_id = ?i AND list_id = ?i", $subscriber_id, $list_id);
	} else {
		$unsubscribe_key = '0';
	}

	return fn_url("newsletters.unsubscribe?list_id=$list_id&s_id=$subscriber_id&key=$unsubscribe_key", 'C', 'http', '&');
}


/**
* generate activation link. if list_id=0 and subscriber_id=0 - generate stub key for test email
*
* @param int list_id - mailing list id
* @param int subscriber_id
* @return string unsubscribe_link
*/
function fn_generate_activation_link($list_id, $subscriber_id)
{
	if ($list_id && $subscriber_id) {
		$activation_key = db_get_field("SELECT activation_key FROM ?:user_mailing_lists WHERE list_id=?i AND subscriber_id=?i", $list_id, $subscriber_id);
	} else {
		$activation_key = '0';
	}

	return fn_url("newsletters.activate&list_id=$list_id&key=$activation_key&s_id=$subscriber_id", 'C', 'http', '&');
}

/**
* get list of mailing lists
*
* @param array params - search parameters
* @param string lang_code - language code
* @return array
*/
function fn_get_mailing_lists($params = array(), $lang_code = CART_LANGUAGE)
{
	$default_params = array(
		'checkout' => false,
		'registration' => false,
		'sidebar' => false,
		'only_available' => true, // hide hidden and not available newsletters. We use 'false' for admin page
		'limit' => ''
	);

	$params = array_merge($default_params, $params);

	$_conditions = array();
	if ($params['checkout']) {
		$_conditions[] = "?:mailing_lists.show_on_checkout = '1'";
	}

	if ($params['registration']) {
		$_conditions[] = "?:mailing_lists.show_on_registration = '1'";
	}

	if ($params['only_available']) {
		$_conditions[] = "?:mailing_lists.status = 'A'";
	}

	if (!empty($_conditions)) {
		$_conditions = implode(' AND ', $_conditions);
	} else {
		$_conditions = '1';
	}

	$mailing_lists = db_get_hash_array("SELECT * FROM ?:mailing_lists LEFT JOIN ?:common_descriptions ON ?:common_descriptions.object_id = ?:mailing_lists.list_id AND ?:common_descriptions.object_holder = 'mailing_lists' AND ?:common_descriptions.lang_code = ?s WHERE $_conditions", 'list_id', $lang_code);

	return !empty($params['block'])? array($mailing_lists): $mailing_lists;
}

/**
* Save user mailing lists settings.
*
* @param int $subscriber_id
* @param array $user_list_ids
* @param int $format - newsletters format for that user
* @param mixed $confirmed - if passed, subscription status set to passed value, if null, depends on autoresponder
* @param boolean $notify
* @param string $lang_code
*/
function fn_update_subscriptions($subscriber_id, $user_list_ids = array(), $format = NEWSLETTER_FORMAT_TXT, $confirmed = NULL, $force_notification = array(), $lang_code = CART_LANGUAGE)
{
	if (!empty($user_list_ids)) {
		$lists = fn_get_mailing_lists();
		$subscriber = db_get_row("SELECT * FROM ?:subscribers WHERE subscriber_id = ?i", $subscriber_id);

		// to prevent user from subscribing to hidden and disabled mailing lists by manual link edit
		if (AREA != 'A') {
			foreach ($user_list_ids as $k => $l_id) {
				if ($lists[$l_id]['status'] != 'A') {
					unset($user_list_ids[$k]);
				}
			}
		}

		foreach ($user_list_ids as $list_id) {

			$_confirmed = is_array($confirmed) ? $confirmed[$list_id]['confirmed'] : $confirmed;

			$_data = array(
				'subscriber_id' => $subscriber_id,
				'list_id' => $list_id,
				'activation_key' => md5(uniqid(rand())),
				'unsubscribe_key' => md5(uniqid(rand())),
				'email' => $subscriber['email'],
				'timestamp' => TIME,
				'lang_code' => $lang_code,
				'confirmed' => ($_confirmed == NULL) ? (!empty($lists[$list_id]['register_autoresponder']) ? 0 : 1) : ($_confirmed ? 1 : 0),
				'format' => intval($format)
			);

			db_query("REPLACE INTO ?:user_mailing_lists ?e", $_data);

			// send confirmation email for each mailing list
			if (!empty($force_notification['C'])) {
				fn_send_confirmation_email($subscriber_id, $list_id, $subscriber['email'], $format, $lang_code);
			}
		}
	}

	// Delete unchecked mailing lists
	if (!empty($user_list_ids)) {
		$lists_to_delete = db_get_field("SELECT list_id FROM ?:user_mailing_lists WHERE subscriber_id = ?i AND list_id NOT IN (?n)", $subscriber_id, $user_list_ids);
		if (!empty($lists_to_delete)) {
			db_query("DELETE FROM ?:user_mailing_lists WHERE subscriber_id = ?i AND list_id IN (?n)", $subscriber_id, $lists_to_delete);

			// Delete subscriber in customer area if all lists are unchecked
			if (AREA == 'C') {
				$c = db_get_field("SELECT COUNT(*) FROM ?:user_mailing_lists WHERE subscriber_id = ?i", $subscriber_id);

				if (empty($c)) {
					db_query("DELETE FROM ?:subscribers WHERE subscriber_id = ?i", $subscriber_id);
				}
			}
		}
	
	// Delete subscriber in customer area if all lists are unchecked
	} else {
		fn_delete_subscribers(array($subscriber_id), (AREA == 'C'));
	}
}

function fn_delete_subscribers($subscriber_ids, $delete_user = true)
{
	// Only Root can peform this action
	if (!empty($subscriber_ids) && (!defined('COMPANY_ID') || AREA == 'C') ) {
		if ($delete_user == true) {
			db_query("DELETE FROM ?:subscribers WHERE subscriber_id IN (?n)", $subscriber_ids);
		}
		db_query("DELETE FROM ?:user_mailing_lists WHERE subscriber_id IN (?n)", $subscriber_ids);
	}
}

function fn_send_confirmation_email($subscriber_id, $list_id, $email, $format = NEWSLETTER_FORMAT_TXT, $lang_code = CART_LANGUAGE)
{
	static $msg;
	if (empty($msg)) {
		$msg = fn_get_lang_var('sending_email_to');
	}

	$list = fn_get_mailing_list_data($list_id);
	if ($list['register_autoresponder']) {
		$autoresponder = fn_get_newsletter_data($list['register_autoresponder']);

		if ($format == NEWSLETTER_FORMAT_TXT) {
			$body = $autoresponder['body_txt'];
		} else {
			$body = $autoresponder['body_html'];
		}

		$body = fn_render_newsletter($body, array('list_id' => $list_id, 'subscriber_id' => $subscriber_id, 'email' => $email));

		if (AREA == 'A') {
 			fn_echo(str_replace('[email]', $email, $msg) . '<br />');
		}

		fn_send_newsletter($email, $list, $autoresponder['newsletter'], $body, array(), $lang_code, $list['reply_to'], ($format == NEWSLETTER_FORMAT_HTML));
	}
}

function fn_render_newsletter($body, $subscriber)
{
	// prepare placeholder values
	if (!empty($subscriber['list_id']) && !empty($subscriber['subscriber_id'])) {
		$values['%UNSUBSCRIBE_LINK'] = fn_generate_unsubscribe_link($subscriber['list_id'], $subscriber['subscriber_id']);
		$values['%ACTIVATION_LINK'] = fn_generate_activation_link($subscriber['list_id'], $subscriber['subscriber_id']);
	} else {
		$values['%UNSUBSCRIBE_LINK'] = $values['%ACTIVATION_LINK'] = empty($subscriber['user_id']) ? ('[' . fn_get_lang_var('link_message_for_test_letter') . ']') : '';
	}
	$values['%SUBSCRIBER_EMAIL'] = $subscriber['email'];
	$values['%COMPANY_NAME'] = Registry::get('settings.Company.company_name');
	$values['%COMPANY_ADDRESS'] = Registry::get('settings.Company.company_address');
	$values['%COMPANY_PHONE'] = Registry::get('settings.Company.company_phone');

	return strtr($body, $values);

}

function fn_news_and_emails_get_block_locations(&$locations)
{
	$locations['news'] = 'news_id';

	return true;
}

// to send newsletters mail using custom mail server we override
// system mailer. Don't forget to revert mailer back after sending finished!
function fn_override_mailer($restore = false)
{
	static $saved_mailer;

	fn_init_mailer();

	// restore default mailer
	if ($restore && !empty($saved_mailer)) {
		Registry::set('mailer', $saved_mailer);
		unset($saved_mailer);
		return;
	}


	// override default mailer by mailer with newsletter settings
	$mailer_settings = Registry::get('addons.news_and_emails');

	if ($mailer_settings['mailer_send_method'] != 'default') {
		$default_mailer = Registry::get('mailer');
		$saved_mailer = $default_mailer;

		$new_mailer = new Mailer();
		$new_mailer->LE = (defined('IS_WINDOWS')) ? "\r\n" : "\n";
		$new_mailer->PluginDir = DIR_LIB . 'phpmailer/';

		if ($mailer_settings['mailer_send_method'] == 'smtp') {
			$new_mailer->IsSMTP();
			$new_mailer->SMTPAuth = ($mailer_settings['mailer_smtp_auth'] == 'Y') ? true : false;
			$new_mailer->Host = $mailer_settings['mailer_smtp_host'];
			$new_mailer->Username = $mailer_settings['mailer_smtp_username'];
			$new_mailer->Password = $mailer_settings['mailer_smtp_password'];

		} elseif ($mailer_settings['mailer_send_method'] == 'sendmail') {
			$new_mailer->IsSendmail();
			$new_mailer->Sendmail = $mailer_settings['mailer_sendmail_path'];

		} else {
			$new_mailer->IsMail();
		}

		Registry::set('mailer', $new_mailer);
	}
}

function fn_restore_mailer()
{
	fn_override_mailer(true);
}

//
// Generate navigation
//
function fn_newsletters_generate_sections($section)
{
	Registry::set('navigation.dynamic.sections', array (
		'N' => array (
			'title' => fn_get_lang_var('newsletters'),
			'href' => 'newsletters.manage?type=' . NEWSLETTER_TYPE_NEWSLETTER,
		),
		'T' => array (
			'title' => fn_get_lang_var('templates'),
			'href' => 'newsletters.manage?type=' . NEWSLETTER_TYPE_TEMPLATE,
		),
		'A' => array (
			'title' => fn_get_lang_var('autoresponders'),
			'href' => 'newsletters.manage?type=' . NEWSLETTER_TYPE_AUTORESPONDER,
		),
		'C' => array (
			'title' => fn_get_lang_var('campaigns'),
			'href' => 'newsletters.campaigns',
		),
		'mailing_lists' => array (
			'title' => fn_get_lang_var('mailing_lists'),
			'href' => 'mailing_lists.manage',
		),
		'subscribers' => array (
			'title' => fn_get_lang_var('subscribers'),
			'href' => 'subscribers.manage',
		),
	));
	Registry::set('navigation.dynamic.active_section', $section);

	return true;
}

function fn_news_and_emails_sitemap_link_object($link, $object, $value)
{
	if ($object == 'news') {
		$link = htmlentities('news.view?news_id=' . $value);
	}
}

function fn_news_and_emails_seo_is_indexed_page($indexed_dispatches)
{
	$indexed_dispatches['news.view'] = array('index' => array('news_id'));
	$indexed_dispatches['news.list'] = array();
}

function fn_news_and_emails_get_seo_vars($seo)
{
	$seo['n'] = array(
		'table' => '?:news_descriptions',
		'description' => 'news',
		'dispatch' => 'news.view',
		'item' => 'news_id',
		'condition' => ''
	);
}

function fn_news_and_emails_validate_sef_object($path, $seo, $vars, &$result, $objects)
{
	if ($seo['type'] == 'n') {
		$result = empty($objects['extension']) ? false : fn_seo_validate_parents($path, '', 'n', true, $seo['lang_code']);
	}
}

function fn_news_and_emails_seo_url($seo_settings, $url, $parced_url, $link_parts, $parced_query, $company_id_in_url, $lang_code = CART_LANGUAGE) {
	if ($parced_query['dispatch'] == 'news.view' && !empty($parced_query['news_id'])) {
		$company_id  = db_get_field("SELECT company_id FROM ?:news WHERE news_id = ?i", $parced_query['news_id']);

		$link_parts['name'] = fn_seo_get_name('n', $parced_query['news_id'], '', $company_id, $lang_code);
		$link_parts['extension'] = SEO_FILENAME_EXTENSION;

		fn_seo_parced_query_unset($parced_query, 'news_id');
	}
}

function fn_news_and_emails_customer_search_objects($search, $objects) {
	if (AREA == 'A') {
		$objects['news'] = 'Y';
	}
}

function fn_news_and_emails_import_after_process_data($primary_object_id, $v, $pattern, $options, $processed_data, $processing_groups, $skip_db_processing_record)
{
	if ($pattern['section'] == 'subscribers') {
		if (empty($v['list_id'])) {
			fn_set_notification('W', fn_get_lang_var('warning'), fn_get_lang_var('warning_subscribers_import'));
			$skip_db_processing_record = true;
		}
	}
}

function fn_news_and_emails_quick_search_generate_catalog()
{
	// Get news information
	$pos = 0;
	$count = db_get_field('SELECT COUNT(*) FROM ?:news_descriptions ');
	
	while ($pos <= $count) {
		$news = db_get_array('SELECT news_id, news, description, lang_code FROM ?:news_descriptions LIMIT ?i, ?i', $pos, SEARCH_LIMIT);
		
		$pos += SEARCH_LIMIT;
		
		if (!empty($news)) {
			foreach ($news as $item) {
				$news_id = $item['news_id'];
				$lang_code = $item['lang_code'];
				unset($item['news_id'], $item['lang_code']);
				
				foreach ($item as $field => $attr) {
					if (!empty($attr)) {
						fn_quick_search_fill_data($news_id, 'n', $lang_code, $attr);
						
						echo '.';
					}
				}
			}
			
			echo '<br />';
		}
	}
}

function fn_news_and_emails_generate_rss_feed($items_data, $additional_data, $block_data, $lang)
{
	if (!empty($block_data['content']['filling']) && $block_data['content']['filling'] == 'news') {
		$params = array (
			'sort_by' => 'timestamp',
			'period' => 'A',
			'limit' => !empty($block_data['properties']['max_item']) ? $block_data['properties']['max_item'] : 3,
		);

		list($news, ) = fn_get_news($params, $lang);

		$additional_data['title'] = !empty($block_data['properties']['feed_title']) ? $block_data['properties']['feed_title'] : fn_get_lang_var('news') . '::' . fn_get_lang_var('page_title', $lang);
		$additional_data['description'] = !empty($block_data['properties']['feed_description']) ? $block_data['properties']['feed_description'] : $additional_data['title'];
		$additional_data['link'] = fn_url('dispatch=news.list', 'C', 'http', '', $lang);
		$additional_data['language'] = fn_strtolower($lang);
		$additional_data['lastBuildDate'] = $news[0]['date']; //we can use first element because news sorting by data

		$items_data = fn_format_news_items($news, $lang);
	}
}

function fn_format_news_items($news, $lang = CART_LANGUAGE)
{
	$items_data = array();

	foreach ($news as $key => $data) {
		$items_data[$key] = array (
			'title' => '<![CDATA[' . $data['news'] . ']]>',
			'link' => fn_url('index.php?dispatch=news.view&news_id=' . $data['news_id'], 'C', 'http', '&amp;', $lang, '', true),
			'pubDate' => fn_format_rss_time($data['date']),
			'description' => '<![CDATA[' . $data['description'] . ']]>',
		);
	}

	return $items_data;
}

function fn_news_and_emails_get_predefined_statuses($type, $statuses)
{
	if ($type == 'news') {
		$statuses['news'] = array(
			'A' => fn_get_lang_var('active'),
			'D' => fn_get_lang_var('disabled'),
			'S' => fn_get_lang_var('sent')
		);
	}
}
?>