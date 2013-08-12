{assign var="discussion" value=$order_info.order_id|fn_get_discussion:"O"}
{if $addons.discussion.order_initiate == "Y" && !$discussion}
	<li><a href="{"orders.initiate_discussion?order_id=`$order_info.order_id`"|fn_url}" class="orders-communication-start">{$lang.start_communication}</a></li>
{/if}