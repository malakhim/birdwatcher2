<?php
/**
 * @author Bryan Wu
 * @copyright BilliBuys 2013
 * @desc Functions for BilliBuys
 */


if ( !defined('AREA') ) { die('Access denied'); }

function fn_billibuys_update_profile($action, $user_data, $current_user_data){

}

/**
 * Archives the request, ie moves from bb_requests to bb_request_archive
 * @param  Int $request_id
 * @return boolean indicating whether has been successfully archived or not based on whether it was added to archive
 */
function fn_archive_request($request_id){
	//Get request
	$request = db_get_row("SELECT * FROM ?:bb_requests WHERE ?:bb_requests.bb_request_id = ?i",$request_id);

	// Get request details and archive them
	$request_item = db_get_row("SELECT * FROM ?:bb_request_item WHERE bb_request_item_id = ?i",$request['request_item_id']);

	db_query("INSERT INTO ?:bb_request_item_archive ?e",$request_item);

	// Archive actual request
	$id = db_query("INSERT INTO ?:bb_request_archive ?e",$request);

	// If inserted into archive table, return true else return false
	// $id = db_get_field("SELECT LAST_INSERT_ID()");
	if($id){
		db_query("DELETE FROM ?:bb_requests WHERE ?:bb_requests.bb_request_id = ?i",$request_id);
		db_query("DELETE FROM ?:bb_request_item WHERE ?:bb_request_item.bb_request_item_id = ?i",$request_item['bb_request_item_id']);
		return true;
	}else{
		return false;
	}
}

/**
 * Post delete-from-cart script, toggles item_added_to_cart flag to 00 for the request linked to the item that's being deleted from cart
 * @param  array  $cart       The cart
 * @param  int  $cart_id    The ID of the product in the cart
 * @param  boolean $full_erase No idea.
 * @return boolean              Just good practice.
 */
function fn_billibuys_delete_cart_product($cart, $cart_id, $full_erase = true){
	$update_data = Array("item_added_to_cart" => 00);
	db_query('UPDATE ?:bb_requests INNER JOIN ?:bb_bids ON ?:bb_bids.request_id = ?:bb_requests.bb_request_id SET ?u 
		WHERE
			?:bb_requests.user_id = ?i 
			AND 
				?:bb_bids.product_id = ?i',$update_data,$_SESSION['auth']['user_id'],$cart['products'][$cart_id]['product_id']);
	return true;
}

/**
 * Post add-to-cart script, toggles item_added_to_cart flag on the request table for associated request
 * @param  Array $product_data product data
 * @param  Array $cart current cart
 * @param  Array $auth auth array
 * @param  Boolean $update if cart has been updated, this will be true
 * @return boolean Just good practice
 */
function fn_billibuys_post_add_to_cart($product_data, $cart, $auth, $update){
	// Check product_data is in cart
	$product_in_cart = false;
	foreach($cart['products'] as $prod){
		foreach($product_data as $pdata){
			if($pdata['product_id'] == $prod['product_id']){
				$product_in_cart = true;
			}
		}
	}
	// Check product exists for the auction
	$product_in_auction = false;
	foreach($product_data as $pdata){
		$product_in_auction = db_get_field(
		"SELECT ?:bb_requests.bb_request_id
		FROM ?:bb_requests 
		INNER JOIN ?:bb_bids ON ?:bb_requests.bb_request_id = ?:bb_bids.request_id
		WHERE ?:bb_bids.product_id = ?i AND ?:bb_requests.user_id = ?i
		",$pdata['product_id'],$auth['user_id']);
	}
	// If both above are true then add product to cart
	$valid_purchase = false;
	if($product_in_cart && ($product_in_auction && $product_in_auction != NULL && !empty($product_in_auction))){
		$valid_purchase = true;
	}

	if($valid_purchase){
		$update_data = Array(
			"item_added_to_cart" => "1",
		);
	}else{
		$update_data = Array(
			"item_added_to_cart" => "0",
		);
	}
	foreach($product_data as $prod){
		db_query('UPDATE ?:bb_requests INNER JOIN ?:bb_bids ON ?:bb_bids.request_id = ?:bb_requests.bb_request_id SET ?u 
			WHERE 
				?:bb_requests.user_id = ?i 
				AND 
					?:bb_bids.product_id = ?i',$update_data,$auth['user_id'],$prod['product_id']
		);
	}

	return true;
}

/**
 * Sets "item_added_to_cart" to 0 as part of the cart clearing process
 * @param  Array  $cart      The cart
 * @param  boolean $complete  No idea
 * @param  boolean $clear_all Double no idea
 * @return boolean             Returning true just for good practice
 */
function fn_billibuys_clear_cart($cart, $complete = false, $clear_all = false){
	if($cart && is_array($cart) && $cart != null){
		// Iterate through cart's products
		foreach($cart['products'] as $product){
			$user_id = $_SESSION['auth']['user_id'];
			if($user_id){ // Good typing practices? What's that?
				// Set item_added_to_cart to 0 for the request
				$update_data = Array('item_added_to_cart' => 0);
				db_query(
					"UPDATE ?:bb_requests INNER JOIN ?:bb_bids ON ?:bb_requests.bb_request_id = ?:bb_bids.request_id SET ?u WHERE
						?:bb_bids.product_id = ?i AND
						?:bb_bids.price = ?i AND
						?:bb_requests.user_id = ?i",
					$update_data,
					$product['product_id'],
					$product['price'],
					$user_id
				);
			}
			// If user isn't logged in (ie someone accidentally enabled "can have cart without logging in" in admin backend) then this will simply ignore everything
		}
	}
	return true;	
}

function fn_billibuys_order_placement_routines($order_id, $force_notification, $order_info, $_error){
	if(!$_error){
		// Don't archive if order is open?
		foreach($order_info['items'] as $item){
			$request = fn_get_request_by_order($order_info['user_id'],$item['product_id']);
			if(!empty($request)){
				fn_archive_request($request['bb_request_id']);
			}
		}
	}
}

function fn_billibuys_get_product_price_post($product_id, $amount, $auth, &$price){
	$bid_id = $_SESSION['bid_id'];
	$price = db_get_field("SELECT price 
		FROM ?:bb_bids 
		INNER JOIN ?:bb_requests ON
			?:bb_requests.bb_request_id = ?:bb_bids.request_id
		WHERE ?:bb_bids.product_id = ?i AND ?:bb_requests.user_id = ?i
	",$product_id,$auth['user_id']);
}

function fn_get_bid_by_product($product_id,$request_id){
	$bid = db_get_row("SELECT *
			FROM
				?:bb_bids
			WHERE
				?:bb_bids.product_id = $product_id AND ?:bb_bids.request_id = $request_id
			GROUP BY bb_bid_id
		");

	return $bid;
}

/**
 * Gets all the bids for a particular request
 * @param  Array $params At the moment, array containing the request ID
 * @return Array         List of bids on this particular request
 */
function fn_get_bids($params){

	// Filter by fields if field array was specified in $params
	if(isset($params['fields'])){
		$fields = implode($params['fields'],',');
	}else
		$fields = '*';

	$bids = db_get_array("SELECT $fields
		FROM 
			?:bb_bids
		INNER JOIN
			?:product_descriptions ON
				?:product_descriptions.product_id = ?:bb_bids.product_id
		INNER JOIN
			?:user_profiles ON
				?:bb_bids.user_id = ?:user_profiles.user_id
		WHERE 
		 ?:bb_bids.request_id = ?i
		GROUP BY request_id",
			$params['request_id']
		);

	return $bids;
}

function fn_bb_submit_notification($bb_data){
	if(empty($bb_data))
		return false;
	else{
		$keywords = explode(',',$bb_data['keywords']);
		foreach($keywords as $keyword){
			$data = array(
				'notify_string' => $keyword,
				'user_id'		=> $bb_data['auth']['user_id'],
				'ip_address'    => $bb_data['auth']['ip'],
				'timestamp'     => microtime(true)
			);
			db_query('INSERT INTO ?:bb_notifications ?e',$data);
		}
	}
}

function fn_submit_bids($bb_data,$auth){
	//TODO: Check is in vendor/admin and in vendor/admin area
	if(empty($bb_data) || !is_array($bb_data)){
		return false;
	}else{
		//Used to get the request_id
		parse_str($bb_data['redirect_url']);

		//FIXME: $bb_data['request_id'] doesn't exist, need to get the right variable from it
		$request_item = db_get_row("SELECT max_price, allow_over_max_price FROM ?:bb_request_item INNER JOIN ?:bb_requests ON ?:bb_requests.request_item_id = ?:bb_request_item.bb_request_item_id WHERE ?:bb_requests.bb_request_id = ?i",$request_id);

		foreach($bb_data['product_ids'] as $pid){
			$price = $bb_data['products_data'][$pid]['price'] * $bb_data['products_data'][$pid]['amount'] ;
		}

		$mp = $request_item['max_price'];

		// Flag to be set to true if request price > allowed max price
		$over_max = false;

		if($price != NULL && $request_item['max_price'] != 0){
			if($price > 0 && is_numeric($price) && $price != NULL){
				if($request_item['allow_over_max_price'] && $price > ($mp + 0.1 * $mp)){
					// Check price is over by 10%, if not return to original
					$over_max = true;
					$error_msg = $lang['bid_is_over_request_max'].'$'.$mp+0.1*$mp;
				}elseif(!$request_item['allow_over_max_price'] && $price > $mp){
					// Check price is under or equal to max, if not return to original
					$over_max = true;
					$error_msg = $lang['bid_is_over_request_max'].'$'.$mp;
				}
			}else{
				// Throw non-numeric error
				// TODO: This is caught by javascript atm, not PHP but needs to return a value in case an invalid bid is POSTed
				$error_msg = $lang['error_occurred'];
			}
		}else{
			// Throw non-numeric error
			// TODO: This is caught by javascript atm, not PHP but needs to return a value in case an invalid bid is POSTed
			$error_msg = $lang['error_occurred'];
		}

		if($over_max){
			fn_set_notification('E', $lang['error'], $error_msg);
			return false;
		}

		//Search for existing bid
		$existing_bid = db_get_row('SELECT *
			FROM ?:bb_bids
			WHERE ?:bb_bids.user_id = ?i AND ?:bb_bids.request_id = ?i',$auth['user_id'], $request_id
		);

		//Archive existing bid if exists
		if(!empty($existing_bid) || $existing_bid != NULL){
			db_query('DELETE FROM ?:bb_bids WHERE ?:bb_bids.bb_bid_id = ?i',$existing_bid['bb_bid_id']);
			//Delete from bids archive to prevent duplicates
			// Not used atm
			// db_query('DELETE FROM ?:bb_bids_archive WHERE ?:bb_bids_archive.user_id = ?i AND ?:bb_bids_archive.request_id = ?i',$auth['user_id'],$request_id);
			db_query('INSERT INTO ?:bb_bids_archive ?e',$existing_bid);
		}

		//Execute bid
		foreach($bb_data['product_ids'] as $product){
			foreach($bb_data['products_data'] as $pid=>$pdata){
				if($pid == $product){
					$new_bid = Array(
						'request_id' => $request_id,
						'price' => $pdata['price'],
						'user_id' => $auth['user_id'],
						'quantity' => $pdata['amount'],
						'product_id' => $product,
					);
				}
			}
		}
		db_query('INSERT INTO ?:bb_bids ?e',$new_bid);

		//Log event
		//Not working atm
		// fn_log_event('billibuys', 'create', array('bid' => $new_bid));
		// 
		return true;
		}
}

/**
 * Gets all packages (for user if vendor, or all if just admin)
 * @param  Array $auth  The auth array, to use for checking status of user
 * @return Array        List of packages from database
 * DEPRECATED: Using packages addon
 */
function fn_get_packages($auth){

	// Variable initialisation
	$user = $auth['user'];
	$user_type = $auth['user_type'];

	// Set condition for filtering database query
	if($user_type == 'V'){
		$condition = 'user_id = '.$user;
	}else{
		$condition = '1';
	}

	// Get packages
	$data = db_get_array('SELECT * FROM ?:bb_product_packages WHERE ?s',$condition);

	return $data;
}

/**
 * Places a request for an item, so vendors can bid on the request
 * @param  int $user user_id of user that entered request
 * @param  string $post $_POST array
 */
function fn_submit_request($user, $post = ''){
	//Check that this function call is done after a post request
	if(!empty($post)){

		//Do actual insertion of request item name
		//TODO: Return error messages for minimum and max string size
		$id = db_query('INSERT INTO ?:bb_request_item ?e', $post['request']);

		//Get last id of the requested item
		// $id = db_get_field('SELECT last_insert_id()');

		//Same as above, but for the ?:bb_request table
		$data = Array(
			'user_id' => $user,
			'request_item_id' => $id,
			'ip_address' => $_SERVER['REMOTE_ADDR'],
			'timestamp' => microtime(true)
		);
		db_query('INSERT INTO ?:bb_requests ?e',$data);

		//Check if this item is one of those requested for notifications
		//TODO: Body
		$data = db_get_array("SELECT user_id, notify_string FROM ?:bb_notifications WHERE notify_string LIKE ?s", $post['item_name']);
		if($data){
			$email_addr = db_get_field("SELECT email FROM ?:users WHERE user_id = ?i",$data[0]['user_id']);
			foreach($data as $d){
				$item[] = $d['notify_string'];
			}
			fn_send_mail($email_addr,'admin@billibuys.com','A user has placed a request for the item you have!','This is the body');
		}
	}
}

/**
 * Gets all requests that match a %product% search term
 * @author  bryanw
 * @version 1.0.0
 * @param   String    $product search term
 * @return  Array     ['Success'] true or false, error message if false and all matching results if true
 */
function fn_get_requests_by_product_name($product){
	$product = '%'.$product.'%'; // This also covers empty string case
	
	$requests = db_get_array(
		'SELECT * 
		FROM ?:bb_requests 
		INNER JOIN ?:bb_request_item ON 
			?:bb_request_item.bb_request_item_id = ?:bb_requests.request_item_id 
		LEFT OUTER JOIN ?:bb_bids ON
			?:bb_requests.bb_request_id = ?:bb_bids.request_id
		WHERE ?:bb_request_item.description LIKE ?l
		ORDER BY price DESC', $product
	);

	if(!empty($requests))
		$requests['success'] = true;
	else
		$requests = Array(
			'success' => false,
			'message' => 'no_results'
		);
	return $requests;
}


function fn_get_request_by_order($user_id,$product_id){
	$data = db_get_row(
		"SELECT *
		FROM ?:bb_requests
		INNER JOIN ?:bb_bids ON ?:bb_bids.request_id = ?:bb_requests.bb_request_id
		WHERE ?:bb_requests.user_id = ?i AND ?:bb_bids.product_id = ?i
	",$user_id,$product_id);

	return $data;
}

/**
 * Gets details of a single request, based on request_id
 * @param  Array $params  Search parameters
 * @return Array          Array containing request details
 */
function fn_get_request($params){

	// Initialisation
	$params = array_merge(Array(
		'request_id' => 0
		),$params);

	// Filter by fields if field array was specified in $params
	if(isset($params['fields'])){
		$fields = implode($params['fields'],',');
	}else
		$fields = '*';

	$where = array(
		'bb_request_id' => $params['request_id'],
		);

	$data = db_get_row(
		"SELECT $fields
		FROM ?:bb_requests
		INNER JOIN ?:bb_request_item ON 
			?:bb_request_item.bb_request_item_id = ?:bb_requests.request_item_id 
		WHERE ?w
		GROUP BY ?:bb_request_item.bb_request_item_id
		", $where
		);

	return $data;
}

/**
 * Gets all auctions
 * @param  Array $params Array of search criteria
 * @return Array         Array of auction results from database
 * @todo Normalise database functions to work with fn_get_requests_by_product
 */
function fn_get_requests($params = Array()){

	// Initialization
	$params = array_merge(Array(
		'user' => 0,
		'own_auctions' => false,
		),$params);

	if(isset($params['category_id'])){
		$where = Array(
			'request_category_id' => $params['category_id']
		);
	}

	if($params['own_auctions'] == false){
			$query = 'SELECT * 
				FROM ?:bb_requests 
				INNER JOIN ?:bb_request_item ON 
					?:bb_request_item.bb_request_item_id = ?:bb_requests.request_item_id';
			if(isset($where)){
				$query .= ' WHERE ?w';
			}
			$requests = db_get_array($query,$where);
			$requests['success'] = true;
	}else{
		$user = $params['user'];
		if($user !== 0){
			// Get request by this user
			$requests = db_get_array(
				'SELECT * 
				FROM ?:bb_requests 
				INNER JOIN ?:bb_request_item ON 
					?:bb_request_item.bb_request_item_id = ?:bb_requests.request_item_id 
				WHERE user_id = ?i',$user
			);
			$requests['success'] = true;
		}else{
			// Return error message if user not logged in
			$requests = Array(
				'success' => false,
				'message' => 'user_not_logged_in'
			);
		}
	}
	return $requests;
}

/**
 * Gets categories given parameters, or gets all categories if no $params is given
 * @param  Array $params Contains fields and where conditions
 * @return Array         An array of categories that fulfils the conditions
 * @todo Need to add in where conditions
 */
function fn_bb_get_categories($params = Array()){
	// Set default variables
	$fields = "*";

	// Check params and replace default variables if params passes all checks
	if(!empty($params)){
		if(!empty($params['fields'])){
			$fields = implode(",",$params['fields']);
		}
	}

	// Get categories
	$categories = db_get_array("SELECT $fields
		FROM ?:bb_request_categories INNER JOIN ?:bb_request_category_descriptions ON ?:bb_request_categories.bb_request_category_id = ?:bb_request_category_descriptions.bb_request_category_id
		GROUP BY ?:bb_request_categories.bb_request_category_id
	");

	foreach($categories as &$cat){
		$cat['level'] = substr_count($cat['id_path'],'/');
		$cat['position'] = ltrim($cat['position'],'0');
		$cat['product_count'] = fn_get_product_count($cat); // TODO: Normalise this to use it's own column like CS Cart does
	}

	return $categories;
}

/**
 * Gets product count by category
 * @param  Int $category The ID of the category we're looking for
 * @return Int           Number of products in this category
 */
function fn_get_product_count($category){
	$product_count = db_get_field("SELECT COUNT(*) FROM ?:bb_requests WHERE ?:bb_requests.request_category_id = ?i",$category['bb_request_category_id']);

	return $product_count;
}

function fn_bb_add_category($category_data,$auth){
	define(POSITION_INCREMENT,100);

	$_data = $category_data;

	if (isset($_data['position']) && empty($_data['position']) && $_data['position'] != '0' && isset($_data['parent_id'])) {
		$_data['position'] = db_get_field("SELECT max(position) FROM ?:bb_request_categories WHERE parent_id = ?i", $_data['parent_id']);
		$_data['position'] = $_data['position'] + 10;
	}

	if(strlen($_data['category_name']) > 50){
		fn_set_notification('E',fn_get_lang_var('error'),fn_get_lang_var('bb_name_too_long'));
		return false;
	}

	if(strlen($_data['category_description']) > 500){
		fn_set_notification('E',fn_get_lang_var('error'),fn_get_lang_var('bb_description_too_long'));
		return false;		
	}

	// Get highest value of category position and add 100 to that
	$_data['position'] = db_get_field("SELECT position FROM ?:bb_request_categories ORDER BY position DESC") + POSITION_INCREMENT;

	// create new category
	if (empty($category_id)) {
		$create = true;
		$category_id = db_query("INSERT INTO ?:bb_request_categories ?e", $_data);

		if (empty($category_id)) {
			return false;
		}

		// now we need to update 'id_path' field, as we know $category_id
		/* Generate id_path for category */
		$parent_id = intval($_data['parent_category_id']);
		if ($parent_id == 0) {
			$id_path = $category_id;
		} else {
			$id_path = db_get_row("SELECT id_path FROM ?:bb_request_categories WHERE bb_request_category_id = ?i", $parent_id);
			$id_path = $id_path['id_path'] . '/' . $category_id;
		}

		db_query('UPDATE ?:bb_request_categories SET ?u WHERE bb_request_category_id = ?i', array('id_path' => $id_path), $category_id);

		//
		// Adding same category descriptions for all cart languages
		//
		$_data['bb_request_category_id'] =	$category_id;

		foreach ((array)Registry::get('languages') as $_data['lang_code'] => $v) {
			db_query("INSERT INTO ?:bb_request_category_descriptions ?e", $_data);
		}

	// update existing category
	} else {

		/* regenerate id_path for all child categories of the updated category */
		if (isset($category_data['parent_id'])) {
			fn_change_category_parent($category_id, intval($category_data['parent_id']));
		}

		db_query("UPDATE ?:categories SET ?u WHERE category_id = ?i", $_data, $category_id);
		$_data = $category_data;
		db_query("UPDATE ?:category_descriptions SET ?u WHERE category_id = ?i AND lang_code = ?s", $_data, $category_id, $lang_code);
	}

	// Log category add/update
	fn_log_event('categories', !empty($create) ? 'create' : 'update', array(
		'category_id' => $category_id
	));
}

function fn_bb_get_category($category_id){
	$category = db_get_row("SELECT * FROM ?:bb_request_categories INNER JOIN ?:bb_request_category_descriptions ON ?:bb_request_category_descriptions.bb_request_category_id = ?:bb_request_categories.bb_request_category_id WHERE ?:bb_request_categories.bb_request_category_id = ?i",$category_id);
	return $category;
}
/**
 * Deletes category from categories, category_descriptions, does stuff to requests that are under this category - USE WITH CAUTION
 * @author bryanw
 * @param  int $category_id category id
 * @return none              
 */
function fn_bb_delete_category($category_id){
	$where = array("bb_request_category_id"=>$category_id);
	db_query("DELETE FROM ?:bb_request_categories WHERE ?w",$where);
	db_query("DELETE FROM ?:bb_request_category_descriptions WHERE ?w",$where);

	// What to do in the case of bids under this auction? Not allow deletion, revert to category id = 0 or Misc or what?
	 
	// Should this be an outright deletion for speed purposes or should it be archiving?
}


?>