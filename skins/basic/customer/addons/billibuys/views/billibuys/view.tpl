<div id="bb_submit_form">
	<br/><br/>
	<form id="create" name="create" method="POST" action="/dutchme2/index.php?dispatch=billibuys.view">
		<label for="item_name">{$lang.bb_enter_item}:</label>
		<input type="text" id="item_name" name="item_name"/>
		<input type="submit" value="submit" name="submit"/>
	</form>
</div>

<div id="bb_requests">
	{if $requests.success eq 1}
		<table cellpadding="0" cellspacing="0" width="100%" border="0" class="table">
			<tr>
				<th>{$lang.item}</th>
				<th>{$lang.durat_since_start}</th>
				<th>{$lang.current_bid}</th>
				<th>{$lang.bb_heading_bid_history}</th>
			</tr>
		{foreach from=$requests item=request}
			{if is_array($request)}
				<tr {cycle values="class=\"table-row\","}>
					<td>
						{$request.description}
					</td>
					<td>
						{$request.timestamp}&nbsp;{$request.duration_unit}
					</td>
					<td>
						{if $request.current_bid ne ''}${$request.current_bid}{else}{$lang.bb_no_bids}{/if}
					</td>
					<td>
						{if $request.current_bid ne ''}{$lang.bb_text_view_bid_history}{else}{$lang.bb_text_place_first_bid}{/if}
					</td>
					<td>
						{include file="buttons/button_popup.tpl" but_href="vendor.php?auction=`$request.bb_bid_id`" but_text=$lang.bb_place_bid but_role="text"}
					</td>
				</tr>
			{/if}
		{/foreach}
		</table>
	{else}
	<!-- Need to add in search results-->
		{if $requests.message eq 'no_results'}
			{$lang.text_no_matching_results_found}
		{elseif $requests.message eq 'user_not_logged_in'}
			{$lang.please_login}
		{else}
			{$lang.bb_error_occurred}: <a href="mailto:{$settings.Company.company_support_department}">{$settings.Company.company_support_department}</a>
		{/if}
		
	{/if}
</div>
{capture name="mainbox"}
<!-- This is a test -->

{/capture}
{include file="common_templates/mainbox.tpl" title=$lang.billibuys content=$smarty.capture.mainbox title_extra=$smarty.capture.title_extra tools=$smarty.capture.tools}