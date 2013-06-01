{if $order_info.return}
<tr>
	<td><strong>{$lang.rma_return}:&nbsp;</strong></td>
	<td><strong>{include file="common_templates/price.tpl" value=$order_info.return}</strong></td>
</tr>
{/if}