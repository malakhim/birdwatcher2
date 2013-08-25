<?php
/**
 * @author Bryan Wu
 * @copyright BilliBuys 2013
 * @desc Functions for BilliBuys
 * TODO: Need to figure out how to set to vendor area
 */


if ( !defined('AREA') ) { die('Access denied'); }

function fn_billibuys_get_product_price_pre($product_id, $amount, $auth){
	
}

function fn_get_bid_by_product($product_id,$request_id){
	$bid = db_get_row("
			SELECT *
			FROM
				?:bb_bids
			WHERE
				?:bb_bids.product_id = $product_id AND ?:bb_bids.request_item_id = $request_id
			GROUP BY bb_item_id
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

	$bids = db_get_array("
		SELECT $fields
		FROM 
			?:bb_bids
		INNER JOIN
			?:product_descriptions ON
				?:product_descriptions.product_id = ?:bb_bids.product_id
		INNER JOIN
			?:user_profiles ON
				?:bb_bids.user_id = ?:user_profiles.user_id
		WHERE 
			?:bb_bids.request_item_id = ?i
		GROUP BY request_item_id",
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
	if(empty($bb_data)){
		return false;
	}else{
		//Search for existing bid
		$existing_bid = db_get_row('
			SELECT *
			FROM ?:bb_bids
			WHERE ?:bb_bids.user_id = ?i AND ?:bb_bids.request_item_id = ?i',$auth['user_id'], $bb_data['request_id']
		);

		// var_dump($existing_bid);die;

		//Archive existing bid if exists
		if(!empty($existing_bid)){
			db_query('DELETE FROM ?:bb_bids WHERE ?:bb_bids.bb_item_id = ?i',$existing_bid['bb_item_id']);
			unset($existing_bid['bb_item_id']);
			db_query('DELETE FROM ?:bb_bids_archive WHERE ?:bb_bids_archive.user_id = ?i AND ?:bb_bids_archive.request_item_id = ?i',$auth['user_id'],$bb_data['request_id']);
			db_query('INSERT INTO ?:bb_bids_archive ?e',$existing_bid);
		}

		//Execute bid
		foreach($bb_data['product_ids'] as $product){
			foreach($bb_data['products_data'] as $pid=>$pdata){
				if($pid == $product){
					$new_bid = Array(
						'request_item_id' => $bb_data['request_id'],
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
		db_query('INSERT INTO ?:bb_request_item ?e', $post['request']);

		//Get last id of the requested item
		$id = db_get_field('SELECT last_insert_id()');

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
 * Gets all requests that match a %product
 * @author  bryanw
 * @version 1.0.0
 * @param   String    $product search term
 * @return  Array     ['Success'] true or false, error message if false and all matching results if true
 */
function fn_get_requests_by_product($product){
	$product = '%'.$product.'%'; // This also covers empty string case
	
	$requests = db_get_array(
		'SELECT * 
		FROM ?:bb_requests 
		INNER JOIN ?:bb_request_item ON 
			?:bb_request_item.bb_request_item_id = ?:bb_requests.request_item_id 
		LEFT OUTER JOIN ?:bb_bids ON
			?:bb_request_item.bb_request_item_id = ?:bb_bids.request_item_id
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

	$data = db_get_row(
		"SELECT $fields
		FROM ?:bb_requests
		INNER JOIN ?:bb_request_item ON 
			?:bb_request_item.bb_request_item_id = ?:bb_requests.request_item_id 
		WHERE ?:bb_requests.bb_request_id = ?i
		GROUP BY ?:bb_request_item.bb_request_item_id
		", $params['request_id']
		);

	return $data;
}

/**
 * Gets all auctions
 * @param  Array $params Array of search criteria
 * @return Array         Array of auction results from database
 * @todo Normalise database functions to work with fn_get_requests_by_product
 */
function fn_get_requests($params){

	// Initialization
	$params = array_merge(Array(
		'user' => 0,
		'own_auctions' => false
		),$params);

	if($params['own_auctions'] == false){
			$requests = db_get_array('
				SELECT * 
				FROM ?:bb_requests 
				INNER JOIN ?:bb_request_item ON 
					?:bb_request_item.bb_request_item_id = ?:bb_requests.request_item_id'
			);
			$requests['success'] = true;
	}else{
		$user = $params['user'];
		if($user !== 0){
			// Get request by this user
			$requests = db_get_array('
				SELECT * 
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

?>