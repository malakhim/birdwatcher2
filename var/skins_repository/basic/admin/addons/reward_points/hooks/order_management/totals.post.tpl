{if $cart.points_info.reward}
	<li>
		<em>{$lang.points}:</em>
		<span>{$cart.points_info.reward}</span>
	</li>
{/if}

{if $cart.points_info.in_use}
	<li>
		<em>{$lang.points_in_use}&nbsp;({$cart.points_info.in_use.points}&nbsp;{$lang.points})&nbsp;<a href="{"order_management.delete_points_in_use"|fn_url}"><img src="{$images_dir}/icons/icon_delete.gif" width="12" height="18" border="0" alt="{$lang.delete}" title="{$lang.delete}" /></a>:</em>
		<span>{include file="common_templates/price.tpl" value=$cart.points_info.in_use.cost}</span>
	</li>
{/if}