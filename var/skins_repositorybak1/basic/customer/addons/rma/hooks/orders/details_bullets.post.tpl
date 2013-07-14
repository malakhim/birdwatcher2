{if $order_info.allow_return}
	<li><a href="{"rma.create_return?order_id=`$order_info.order_id`"|fn_url}" class="return">{$lang.return_registration}</a></li>
{/if}
{if $order_info.isset_returns}
	<li><a href="{"rma.returns?order_id=`$order_info.order_id`"|fn_url}" class="return">{$lang.order_returns}</a></li>
{/if}