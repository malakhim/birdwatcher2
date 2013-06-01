{capture name="mainbox"}

{include file="addons/billibuys/views/billibuys/components/billibuys_search_form.tpl"}
<a href="{"billibuys.notify"|fn_url}">{$lang.create_notification}</a>
<form action="{""|fn_url}" method="post" name="category_tree_form" class="{if ""|fn_check_form_permissions}cm-hide-inputs{/if}">

<table cellpadding="0" cellspacing="0" width="100%" border="0" class="table">
	<tr>
		<th width="1%" class="center">
			<input type="checkbox" name="check_all" value="Y" title="{$lang.check_uncheck_all}" class="checkbox cm-check-items" /></td>
		<th>{$lang.item}</th>
		<th>{$lang.posted}</th>
		<th>{$lang.current_bid}</th>
		<th>{$lang.place_bid}</th>
	</tr>

	{if $requests.success}
		{foreach from=$requests item=request}
			{if is_array($request)}
				<tr {cycle values="class=\"table-row\","}>
					<td width="1%" class="center">
						<input type="checkbox" name="event_ids[]" value="{$request.bb_bid_id}" class="checkbox cm-item" /></td>
					<td>{$request.description}</td>
					<td>{$request.timestamp}</td>
					<td>{if $request.min_amt ne ''}${$request.min_amt}{else}No Bids Yet!{/if}</td>
					<td>$&nbsp;<input type="text" name="bb_data[{$request.bb_request_id}][bid]" size="7" class="input-text-medium" /></td>
				</tr>
			{/if}
		{/foreach}
	{else}
		<tr class="no-items">
			<td colspan="4"><p>{$lang.no_data}</p></td>
		</tr>
	{/if}
</table>

<div class="buttons-container buttons-bg">
	<div class="float-left">
		{include file="buttons/save.tpl" but_name="dispatch[billibuys.view]" but_role="button_main"}

	</div>
</div>
</form>
{/capture}

{include file="common_templates/mainbox.tpl" title=$lang.billibuys content=$smarty.capture.mainbox title_extra=$smarty.capture.title_extra tools=$smarty.capture.tools}