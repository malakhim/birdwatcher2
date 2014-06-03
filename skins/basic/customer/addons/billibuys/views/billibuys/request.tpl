{capture name="mainbox_title"}{$request.title}{/capture}

{foreach from=$request item=r key=k}
	{if $k NEQ "title" && $k NEQ "bb request id" && $k NEQ "id" && $k NEQ "timestamp" && $k NEQ "user id"}
		{if $k EQ 'expiry date'}
			<strong>{$k|@ucwords}</strong>: {$expiry}<br />
		{elseif $k EQ 'max price' && $r EQ '0.00'}
			<strong>{$k|@ucwords}</strong>: {$lang.no_max_price}<br />
		{else}
			<strong>{$k|@ucwords}</strong>: {$r}<br />
		{/if}
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
	{if $bids != null & isset($bids)}
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
	{else}
		<tr class="no-items">
			<td colspan="7"><p>{$lang.no_data}</p></td>
		</tr>
	{/if}
</table>
<br />

{if $expired == 0}
	{if $request_user_id != $smarty.session.auth.user_id}
		{include file="buttons/button.tpl" but_text=$lang.place_bid but_href="vendor.php?dispatch=billibuys.place_bid&request_id=`$request.id`"|@fn_url but_role="link"}
	{/if}
{else if $expired > 0}
	{$lang.auction_finished}. <a href="{"billibuys.view"|fn_url}">{$lang.click_here_to_return_to_main_page}</a>
{/if}