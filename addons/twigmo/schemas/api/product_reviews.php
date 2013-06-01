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

$schema = array (
	'table' => 'discussion',
	'object_name' => 'review',
	'key' => array('post_id'),
	'group_by' => 'products.product_id',
	'references' => array (
		'discussion_posts' => array (
			'join_type' => 'LEFT',
			'fields' => array (		
				'thread_id' => array (
					'db_field' => 'thread_id'
				)
			)
		),
		'discussion_rating' => array (
			'join_type' => 'LEFT',
			'fields' => array (		
				'post_id' => array (
					'table' => 'discussion_posts',
					'db_field' => 'post_id'
				)
			)
		),
		'discussion_messages' => array (
			'join_type' => 'LEFT',
			'fields' => array (		
				'post_id' => array (
					'table' => 'discussion_posts',
					'db_field' => 'post_id'
				)
			)
		)
	),	
	'fields' => array (
		'review_id' => array (
			'table' => 'discussion_posts',
			'db_field' => 'post_id'
		),
		'name' => array (
			'table' => 'discussion_posts',
			'db_field' => 'name'
		),
		'rating_value' => array (
			'table' => 'discussion_rating',
			'db_field' => 'rating_value'
		),
		'message' => array (
			'table' => 'discussion_messages',
			'db_field' => 'message'
		),
		'timestamp' => array (
			'table' => 'discussion_posts',
			'db_field' => 'timestamp'
		),
		'user_id' => array (
			'table' => 'discussion_posts',
			'db_field' => 'user_id'
		),
		'status' => array (
			'table' => 'discussion_posts',
			'db_field' => 'status'
		),
	)
);

?>