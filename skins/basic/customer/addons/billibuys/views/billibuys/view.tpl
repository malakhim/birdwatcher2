<div id="bb_submit_form">
	<br/><br/>
	<form id="create" name="create" method="POST" action="/dutchme2/index.php?dispatch=billibuys.view">
		<label for="item_name">Please enter the item you want here:</label>
		<input type="text" id="item_name" name="item_name"/>
		<input type="submit" value="submit" name="submit"/>
	</form>
	<!-- {$requests|@var_dump} -->
</div>


<div id="bb_requests">
	{if $requests.success eq 1}
		<table cellpadding="0" cellspacing="0" width="100%" border="0" class="table">
			<tr>
				<th>Item</th>
				<th>Microseconds since submitted (test)</th>
				<th>Current bid</th>
			</tr>
		{foreach from=$requests item=request}
			{if is_array($request)}
				<tr {cycle values="class=\"table-row\","}>
					<td>{$request.description}</td>
					<td>{$request.timestamp/60000000}</td>
					<td>{if $request.current_bid ne ''}${$request.current_bid}{else}No Bids Yet!{/if}</td>
				</tr>
			{/if}
		{/foreach}
		</table>
	{else}
		{if $requests.message eq 'no_results'}
			No results found. Please check your search enquiry.
		{elseif $requests.message eq 'user_not_logged_in'}
			Please log in to view your bids!
		{else}
			An error has occurred, please contact us at <a href="mailto:webmaster@billibuys.com">webmaster@billibuys.com</a>
		{/if}
		
	{/if}
</div>
{capture name="mainbox"}
<!-- This is a test -->

{/capture}
{include file="common_templates/mainbox.tpl" title=$lang.billibuys content=$smarty.capture.mainbox title_extra=$smarty.capture.title_extra tools=$smarty.capture.tools}