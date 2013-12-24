{capture name="mainbox_title"}{$request.title}{/capture}

{foreach from=$request item=r key=k}
	{if $k NEQ "title" && $k NEQ "bb request id" && $k NEQ "id"}
		<strong>{$k|@ucwords}</strong>: {$r}<br />
	{/if}
{/foreach}

<table cellpadding="0" cellspacing="0" width="100%" border="0" class="table">
	<tr>
		<th>{$lang.item}</th>
		<th>{$lang.price}</th>
		<th>{$lang.name}</th>
		<th>{$lang.quantity}</th>
		<th>{$lang.total_price}</th>
		{*<th>{$lang.user}</th>*}
	</tr>
{foreach from=$bids item=bid}
	{if is_array($bid)}
		<tr {cycle values="class=\"table-row\","}>
			<td>{include file="buttons/button.tpl" but_text=$bid.product but_href="products.view&product_id=`$bid.product_id`&request_id=`$_REQUEST.request_id`&bid_id=`$bid.bb_bid_id`"|fn_url but_role="text"}</td>
			<td>{$bid.price}</td>
			<td>{$bid.profile_name}</td>
			<td>{$bid.quantity}</td>
			<td>{$bid.tot_price}</td>
		</tr>
	{/if}
{/foreach}
</table>
{*$bids|@var_dump*}
<br />
{include file="buttons/button.tpl" but_text=$lang.place_bid but_href="vendor.php?dispatch=billibuys.place_bid&request_id=`$request.id`"|@fn_url but_role="link"}