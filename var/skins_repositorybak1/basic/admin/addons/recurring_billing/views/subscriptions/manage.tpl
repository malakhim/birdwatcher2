{capture name="mainbox"}

{include file="addons/recurring_billing/views/subscriptions/components/subscriptions_search_form.tpl" dispatch="subscriptions.manage"}

<form action="{""|fn_url}" method="post" name="subscriptions_list_form">

{include file="common_templates/pagination.tpl" save_current_page=true save_current_url=true}

{assign var="c_url" value=$config.current_url|fn_query_remove:"sort_by":"sort_order"}

<table border="0" cellpadding="0" cellspacing="0" width="100%" class="table sortable">
<tr>
	<th width="1%" class="center">
		<input type="checkbox" name="check_all" value="Y" title="{$lang.check_uncheck_all}" class="checkbox cm-check-items" /></th>
	<th width="5%"><a class="cm-ajax{if $search.sort_by == "subscription_id"} sort-link-{$search.sort_order}{/if}" href="{"`$c_url`&amp;sort_by=subscription_id&amp;sort_order=`$search.sort_order`"|fn_url}" rev="pagination_contents">{$lang.id}</a></th>
	<th width="5%"><a class="cm-ajax{if $search.sort_by == "order_id"} sort-link-{$search.sort_order}{/if}" href="{"$c_url`&amp;sort_by=order_id&amp;sort_order=`$search.sort_order`"|fn_url}" rev="pagination_contents">{$lang.order_id}</a></th>
	<th width="20%"><a class="cm-ajax{if $search.sort_by == "customer"} sort-link-{$search.sort_order}{/if}" href="{"`$c_url`&amp;sort_by=customer&amp;sort_order=`$search.sort_order`"|fn_url}" rev="pagination_contents">{$lang.customer}</a></th>
	<th width="20%"><a class="cm-ajax{if $search.sort_by == "email"} sort-link-{$search.sort_order}{/if}" href="{"`$c_url`&amp;sort_by=email&amp;sort_order=`$search.sort_order`"|fn_url}" rev="pagination_contents">{$lang.email}</a></th>
	<th><a class="cm-ajax{if $search.sort_by == "date"} sort-link-{$search.sort_order}{/if}" href="{"`$c_url`&amp;sort_by=date&amp;sort_order=`$search.sort_order`"|fn_url}" rev="pagination_contents">{$lang.date}</a></th>
	<th class="right" width="20%"><a class="cm-ajax{if $search.sort_by == "start_price"} sort-link-{$search.sort_order}{/if}" href="{"`$c_url`&amp;sort_by=start_price&amp;sort_order=`$search.sort_order`"|fn_url}" rev="pagination_contents">{$lang.start_price}</a></th>
	<th class="right" width="20%"><a class="cm-ajax{if $search.sort_by == "price"} sort-link-{$search.sort_order}{/if}" href="{"`$c_url`&amp;sort_by=price&amp;sort_order=`$search.sort_order`"|fn_url}" rev="pagination_contents">{$lang.rb_price}</a></th>
	<th class="right" width="20%"><a class="cm-ajax{if $search.sort_by == "last_paid"} sort-link-{$search.sort_order}{/if}" href="{"`$c_url`&amp;sort_by=last_paid&amp;sort_order=`$search.sort_order`"|fn_url}" rev="pagination_contents">{$lang.last_order}</a></th>
	<th width="15%"><a class="cm-ajax{if $search.sort_by == "status"} sort-link-{$search.sort_order}{/if}" href="{"`$c_url`&amp;sort_by=status&amp;sort_order=`$search.sort_order`"|fn_url}" rev="pagination_contents">{$lang.status}</a></th>
	<th>&nbsp;</th>
</tr>

{foreach from=$subscriptions item="sub"}
<tr {cycle values="class=\"table-row\", "}>
	<td class="center">
		<input type="checkbox" name="subscription_ids[]" value="{$sub.subscription_id}" class="checkbox cm-item" /></td>
	<td>
		<a href="{"subscriptions.update?subscription_id=`$sub.subscription_id`"|fn_url}" class="underlined">&nbsp;<span>#{$sub.subscription_id}</span>&nbsp;</a></td>
	<td>
		<a href="{"orders.details?order_id=`$sub.order_id`"|fn_url}" class="underlined">&nbsp;<span>#{$sub.order_id}</span>&nbsp;</a></td>
	<td>{if $sub.user_id}<a href="{"profiles.update?user_id=`$sub.user_id`"|fn_url}">{/if}{$sub.lastname} {$sub.firstname}{if $sub.user_id}</a>{/if}</td>
	<td><a href="mailto:{$sub.email|escape:url}">{$sub.email}</a></td>
	<td class="nowrap">
		{$sub.timestamp|date_format:$settings.Appearance.date_format}</td>
	<td class="right">
		{include file="common_templates/price.tpl" value=$sub.start_price}</td>
	<td class="right">
		{include file="common_templates/price.tpl" value=$sub.price}</td>
	<td class="right">
		{$sub.last_timestamp|date_format:$settings.Appearance.date_format}</td>
	<td>
		{include file="common_templates/select_popup.tpl" id=$sub.subscription_id status=$sub.status items_status="recurring_billing"|fn_get_predefined_statuses update_controller="subscriptions" notify=true}
	</td>
	<td class="nowrap">
		<a class="tool-link" href="{"subscriptions.update?subscription_id=`$sub.subscription_id`"|fn_url}">{$lang.view}</a>
		{capture name="tools_items"}
		<ul>
			<li><a href="{"subscriptions.charge?subscription_id=`$sub.subscription_id`"|fn_url}">{$lang.charge}</a></li>
			<li><a class="cm-confirm" href="{"subscriptions.delete?subscription_id=`$sub.subscription_id`"|fn_url}">{$lang.delete}</a></li>
		</ul>
		{/capture}

		{if $smarty.capture.tools_items|strpos:"<li>"}&nbsp;&nbsp;|
			{include file="common_templates/tools.tpl" prefix=$sub.subscription_id hide_actions=true tools_list=$smarty.capture.tools_items display="inline" link_text=$lang.more link_meta="lowercase"}
		{/if}
	</td>
</tr>
{foreachelse}
<tr class="no-items">
	<td colspan="11"><p>{$lang.no_data}</p></td>
</tr>
{/foreach}
</table>

{if $orders}
	{include file="common_templates/table_tools.tpl" href="#subscriptions"}
{/if}

{include file="common_templates/pagination.tpl"}

{if $subscriptions}	
<div class="buttons-container buttons-bg">
	<div class="float-left">
		{capture name="tools_list"}
		<ul>
			<li><a class="cm-confirm cm-process-items" name="dispatch[subscriptions.delete]" rev="subscriptions_list_form">{$lang.delete_selected}</a></li>
		</ul>
		{/capture}
		{include file="buttons/button.tpl" but_text=$lang.process_selected but_name="dispatch[subscriptions.bulk_charge]" but_meta="cm-confirm cm-process-items" but_role="button_main"}
		{include file="common_templates/tools.tpl" prefix="main" hide_actions=true tools_list=$smarty.capture.tools_list display="inline" link_text=$lang.choose_action}
	</div>
</div>
{/if}

</form>
{/capture}
{include file="common_templates/mainbox.tpl" title=$lang.rb_subscriptions content=$smarty.capture.mainbox title_extra=$smarty.capture.title_extra}