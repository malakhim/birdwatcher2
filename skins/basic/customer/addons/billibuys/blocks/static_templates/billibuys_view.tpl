{*<div id="bb_submit_form">
	<br/><br/>
	<form id="create" name="create" method="POST" action="/dutchme2/index.php?dispatch=billibuys.view">
		<label for="item_name">{$lang.bb_enter_item}:</label>
		<input type="text" id="item_name" name="item_name"/>
		<input type="submit" value="submit" name="submit"/>
	</form>
</div>
*}
{literal}
<script src="addons/billibuys/js/view_requests.js" type="text/javascript"></script>
{/literal}
{* DEPRECATED: User will use top nav bar to do all their requesting needs
{if $auth.user_id}
	<a href="{"billibuys.place_request"|fn_url}">{$lang.bb_text_place_request_question}</a>
{else}
	<a href="{"auth.login_form&return_url=billibuys.place_request"|fn_url}">{$lang.bb_text_log_in_to_place_request}</a>
{/if}
*}
<div id="bb_requests">
	{if $requests.success eq 1}
	{include file="common_templates/pagination.tpl"}
		<table cellpadding="0" cellspacing="0" width="100%" border="0" class="bb_table">
			<tr>
				<th>{$lang.title}</th>
				<th>{$lang.time_remaining}</th>
				<th>{$lang.lowest_bid}</th>
				<th class="nobackground"></th>
			</tr>
		{foreach from=$requests item=request}
			{if is_array($request)}
				<tr {cycle values="class=\"table-row\","}>
					<td>{*include file="buttons/button.tpl" but_text=$request.title but_href="billibuys.request&request_id=`$request.bb_request_id`"|fn_url but_role="text"*}{include file="common_templates/image.tpl" image_width="40" image_height="40" images=$request.image show_thumbnail="Y" no_ids=true class="request-list-image"}{$request.title}</td>
					<td>
						{if $request.timestamp.error == 0}
							{if $request.timestamp.msg != 'over_two_weeks'}
								{$request.timestamp.value}&nbsp;{$request.timestamp.unit}
							{else}
								{$lang.two_weeks_plus}
							{/if}
						{else}
							{if $request.timestamp.msg == 'invalid_date'}
								{$lang.invalid_date_format}
							{elseif $request.timestamp.msg == 'nonpositive_value'}
								{$lang.date_nonpositive}
							{/if}
						{/if}
					</td>
					<td>
						{if $request.lowest_bid}
							{$currencies.$primary_currency.symbol}{$request.lowest_bid}
						{else}
							{$lang.bb_no_bids}
						{/if}
					</td>
					<td>
						<table class="bb_subtable">
						<tr>
							<td class="view-cta-button view" id="{$request.bb_request_id}">{$lang.view}</td>
						</tr>
						<tr>
							<td class="view-cta-button bid">{$lang.bid}</td>
						</tr>
					</table>
					</td>

					{*<td>{if $request.current_bid ne ''}${$request.current_bid}{else}{$lang.bb_no_bids}!{/if}</td>*}
					<td>
				</tr>
			{/if}
		{/foreach}
		</table>
		{include file="common_templates/pagination.tpl"}
	{else}

	<!-- Need to add in search results-->
		{if $requests.message eq 'no_results'}
			{$lang.no_current_requests_found}
		{elseif $requests.message eq 'user_not_logged_in'}
			{$lang.please_login}
		{else}
			{$lang.bb_error_occurred}: <a href="mailto:{$settings.Company.company_support_department}">{$settings.Company.company_support_department}</a>
		{/if}
		
	{/if}
</div>

{if $category_title}
	{capture name="title"}<span>{$category_title}</span>{/capture}
{else}
	{capture name="title"}<span>{$lang.view_requests}</span>{/capture}
{/if}
