{if $user.user_type == "P"}
	<li><a href="{"orders.manage?user_id=`$user.user_id`"|fn_url}">{$lang.view_all_orders}</a></li>
	<li><a href="{"profiles.act_as_user?user_id=`$user.user_id`"|fn_url}" target="_blank" >{$lang.act_on_behalf}</a></li>
{/if}