{if $order_info.points_info.reward}
	<li>
		<em>{$lang.points}:</em>
		<span>{$order_info.points_info.reward}&nbsp;{$lang.points_lower}</span>
	</li>
{/if}

{if $order_info.points_info.in_use}
	<li>
		<em>{$lang.points_in_use}&nbsp;({$order_info.points_info.in_use.points}&nbsp;{$lang.points_lower}):</em>
		<span>{include file="common_templates/price.tpl" value=$order_info.points_info.in_use.cost}</span>
	</li>
{/if}