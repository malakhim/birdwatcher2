{if $order_info.affiliate.commissions}
	{include file="common_templates/subheader.tpl" title=$lang.affiliate_commissions}
	<table cellpadding="1" cellspacing="1" border="0">
	{foreach from=$order_info.affiliate.commissions item=comm}
	{if $comm.action_id}
	<tr {cycle values="class=\"manage-row\", "}>
		<td><a href="{"aff_statistics.view?action_id=`$comm.action_id`"|fn_url}">#{$comm.action_id} {$comm.title}</a></td>
		<td>{$comm.firstname} {$comm.lastname}</td>
		<td>{include file="common_templates/price.tpl" value=$comm.amount}</td>
	</tr>
	{/if}
	{/foreach}
	</table>
{/if}