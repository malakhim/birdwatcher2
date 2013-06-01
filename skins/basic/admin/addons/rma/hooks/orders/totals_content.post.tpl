{if $order_info.return}
	<li>
		<em>{$lang.rma_return}:&nbsp;</em>
		<span>{include file="common_templates/price.tpl" value=$order_info.return}</span>
	</li>
{/if}