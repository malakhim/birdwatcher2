{* This is a comment. Hi Gary! *}

{* Note: These comments will not be shown in the HTML, as they are smarty-only comments *}

{* This page is dispatch=billibuys.request, and all the data is on the page for you to use *}

{* A "capture" allows the system to process everything within the capture box first before displaying it, eg by applying CSS in this case. Check the HTML on the output page! *}
{capture name="mainbox_title"}{$request.title}{/capture}

{* This is a simple foreach loop, with the $request being the array that's looped, item being the placeholder variable for the array variable's value, and key being the placeholder variable for the array variable's key *}
{foreach from=$request item=r key=k}
	{if $k NEQ "title" && $k NEQ "bb request id" && $k NEQ "id"}
		<strong>{$k|@ucwords}</strong>: {$r}<br /> {* {$k|@ucwords} means "execute the php function ucwords($k)" *}
	{/if}
{/foreach}

{* The $lang variable values can be found in addons/billibuys/addon.xml, right at the bottom - You'll recognise them when you see them, though some of these aren't using the billibuys addon language values and use the original cs-cart ones instead (eg price). *}
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
<br />

{include file="buttons/button.tpl" but_text=$lang.place_bid but_href="vendor.php?dispatch=billibuys.place_bid&request_id=`$request.id`"|@fn_url but_role="link"}