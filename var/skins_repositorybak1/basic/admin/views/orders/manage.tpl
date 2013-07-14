{capture name="mainbox"}

{capture name="extra_tools"}
	{hook name="orders:extra_tools"}
	{if $incompleted_view}
		{include file="buttons/button.tpl" but_text=$lang.view_all_orders but_href="orders.manage" but_role="tool"}
	{else}
		{include file="buttons/button.tpl" but_text=$lang.incompleted_orders but_href="orders.manage?skip_view=Y&status=`$smarty.const.STATUS_INCOMPLETED_ORDER`" but_role="tool"}
	{/if}
	{/hook}
{/capture}

{if $mode == "new"}
	<p>{$lang.text_admin_new_orders}</p>
{/if}

{include file="views/orders/components/orders_search_form.tpl" dispatch="orders.manage"}

<div id="content_manage_orders">
<form action="{""|fn_url}" method="post" target="_self" name="orders_list_form">

{include file="common_templates/pagination.tpl" save_current_page=true save_current_url=true div_id=$smarty.request.content_id}

{assign var="c_url" value=$config.current_url|fn_query_remove:"sort_by":"sort_order"}

{assign var="rev" value=$smarty.request.content_id|default:"pagination_contents"}

<table border="0" cellpadding="0" cellspacing="0" width="100%" class="table sortable">
<tr>
	<th width="1%" class="center">
		<input type="checkbox" name="check_all" value="Y" title="{$lang.check_uncheck_all}" class="checkbox cm-check-items" /></th>
	<th width="5%"><a class="cm-ajax{if $search.sort_by == "order_id"} sort-link-{$search.sort_order}{/if}" href="{"`$c_url`&amp;sort_by=order_id&amp;sort_order=`$search.sort_order`"|fn_url}" rev={$rev}>{$lang.id}</a></th>
	<th width="15%"><a class="cm-ajax{if $search.sort_by == "status"} sort-link-{$search.sort_order}{/if}" href="{"`$c_url`&amp;sort_by=status&amp;sort_order=`$search.sort_order`"|fn_url}" rev={$rev}>{$lang.status}</a></th>
	<th width="25%"><a class="cm-ajax{if $search.sort_by == "customer"} sort-link-{$search.sort_order}{/if}" href="{"`$c_url`&amp;sort_by=customer&amp;sort_order=`$search.sort_order`"|fn_url}" rev={$rev}>{$lang.customer}</a></th>
	<th width="30%"><a class="cm-ajax{if $search.sort_by == "email"} sort-link-{$search.sort_order}{/if}" href="{"`$c_url`&amp;sort_by=email&amp;sort_order=`$search.sort_order`"|fn_url}" rev={$rev}>{$lang.email}</a></th>
	<th><a class="cm-ajax{if $search.sort_by == "date"} sort-link-{$search.sort_order}{/if}" href="{"`$c_url`&amp;sort_by=date&amp;sort_order=`$search.sort_order`"|fn_url}" rev={$rev}>{$lang.date}</a>
	</th>
	<th class="right" width="20%"><a class="cm-ajax{if $search.sort_by == "total"} sort-link-{$search.sort_order}{/if}" href="{"`$c_url`&amp;sort_by=total&amp;sort_order=`$search.sort_order`"|fn_url}" rev={$rev}>{$lang.total}</a></th>
	<th>&nbsp;</th>
</tr>
{if $incompleted_view}
	{assign var="page_title" value=$lang.incompleted_orders}
	{assign var="get_additional_statuses" value=true}
{else}
	{assign var="page_title" value=$lang.orders}
	{assign var="get_additional_statuses" value=false}
{/if}
{assign var="order_status_descr" value=$smarty.const.STATUSES_ORDER|fn_get_statuses:true:$get_additional_statuses:true}
{assign var="extra_status" value=$config.current_url|escape:"url"}
{assign var="order_statuses" value=$smarty.const.STATUSES_ORDER|fn_get_statuses:false:$get_additional_statuses:true}
{foreach from=$orders item="o"}
{hook name="orders:order_row"}
<tr {cycle values="class=\"table-row\", "}>
	<td class="center">
		<input type="checkbox" name="order_ids[]" value="{$o.order_id}" class="checkbox cm-item" /></td>
	<td>
		<a href="{"orders.details?order_id=`$o.order_id`"|fn_url}" class="underlined">&nbsp;#{$o.order_id}&nbsp; {include file="views/companies/components/company_name.tpl" company_name=$o.company_name company_id=$o.company_id}</a>
		{if $order_statuses_data[$o.status].appearance_type == "I" && $o.invoice_id}
			<p class="small-note">{$lang.invoice} #{$o.invoice_id}</p>
		{elseif $order_statuses_data[$o.status].appearance_type == "C" && $o.credit_memo_id}
			<p class="small-note">{$lang.credit_memo} #{$o.credit_memo_id}</p>
		{/if}
	</td>
	<td>
		{if $o.have_suppliers == "Y"}
			{assign var="notify_supplier" value=true}
		{else}
			{assign var="notify_supplier" value=false}
		{/if}
		{include file="common_templates/select_popup.tpl" suffix="o" id=$o.order_id status=$o.status items_status=$order_status_descr update_controller="orders" notify=true notify_department=true notify_supplier=$notify_supplier status_rev="orders_total,`$rev`" extra="&return_url=`$extra_status`"
		statuses=$order_statuses}
	</td>
	<td><span class="strong">{if $o.user_id}<a href="{"profiles.update?user_id=`$o.user_id`"|fn_url}">{/if}{$o.lastname} {$o.firstname}{if $o.user_id}</a>{/if}</span></td>
	<td><a href="mailto:{$o.email|escape:url}">{$o.email}</a></td>
	<td class="nowrap">
		{$o.timestamp|date_format:"`$settings.Appearance.date_format`, `$settings.Appearance.time_format`"}</td>
	<td class="right">
		{include file="common_templates/price.tpl" value=$o.total}</td>
	<td class="nowrap">
		<a class="tool-link" href="{"orders.details?order_id=`$o.order_id`"|fn_url}">{$lang.view}</a>
		{capture name="tools_items"}
		<ul>
			{hook name="orders:list_extra_links"}
			<li><a href="{"order_management.edit?order_id=`$o.order_id`"|fn_url}">{$lang.edit}</a></li>
			{assign var="current_redirect_url" value=$config.current_url|escape:url}
			<li><a class="cm-confirm" href="{"orders.delete?order_id=`$o.order_id`&amp;redirect_url=`$current_redirect_url`"|fn_url}">{$lang.delete}</a></li>
			{/hook}
		</ul>
		{/capture}

		{if $smarty.capture.tools_items|strpos:"<li>"}&nbsp;&nbsp;|
			{include file="common_templates/tools.tpl" prefix=$o.order_id hide_actions=true tools_list=$smarty.capture.tools_items display="inline" link_text=$lang.more link_meta="lowercase"}
		{/if}
	</td>
</tr>
{/hook}
{foreachelse}
<tr class="no-items">
	<td colspan="9"><p>{$lang.no_data}</p></td>
</tr>
{/foreach}
</table>

{if $orders}
	{include file="common_templates/table_tools.tpl" href="#orders"}
{/if}

{include file="common_templates/pagination.tpl" div_id=$smarty.request.content_id}
	
{if $orders}
	<div align="right" class="clear" id="orders_total">
		{hook name="orders:statistic_list"}
		<ul class="statistic-list">
			{if $total_pages > 1 && $search.page != "full_list"}
			<li><span>{$lang.for_this_page_orders}:</span></li>
			<li>
				<em>{$lang.gross_total}:</em>
				<span>{include file="common_templates/price.tpl" value=$display_totals.gross_total}</span>
			</li>
			{if !$incompleted_view}
			<li>
				<em>{$lang.totally_paid}:</em>
				<span>{include file="common_templates/price.tpl" value=$display_totals.totally_paid}</span>
			</li>
			{/if}
			<hr />
			<li><span>{$lang.for_all_found_orders}:</span></li>
			{/if}
			<li>
				<em>{$lang.gross_total}:</em>
				<span>{include file="common_templates/price.tpl" value=$totals.gross_total}</span>
			</li>
			{hook name="orders:totals_stats"}
			{if !$incompleted_view}
			<li class="total">
				<em>{$lang.totally_paid}:</em>
				<span>{include file="common_templates/price.tpl" value=$totals.totally_paid}</span>
			</li>
			{/if}
			{/hook}
		</ul>
		{/hook}
	<!--orders_total--></div>
{/if}

{if $orders}	
<div class="buttons-container buttons-bg">
	<div class="float-left">
		{capture name="tools_list"}
		<ul>
			{if $remove_cc}<li><a class="cm-process-items cm-ajax cm-comet" name="dispatch[orders.remove_cc_info]" rev="orders_list_form">{$lang.remove_cc_info}</a></li>{/if}
			<li><a class="cm-process-items" name="dispatch[orders.export_range]" rev="orders_list_form">{$lang.export_selected}</a></li>
			<li><a class="cm-process-items" name="dispatch[orders.packing_slip]" rev="orders_list_form">{$lang.bulk_print} ({$lang.packing_slip})</a></li>
			<li><a class="cm-process-items" name="dispatch[orders.bulk_print..pdf]" rev="orders_list_form">{$lang.bulk_print} (PDF)</a></li>
			<li><a class="cm-process-items" name="dispatch[orders.products_range]" rev="orders_list_form">{$lang.view_purchased_products}</a></li>
			{hook name="orders:list_tools"}
			{/hook}
			{if !"COMPANY_ID"|defined}
			<li><a class="cm-confirm cm-process-items" name="dispatch[orders.delete_orders]" rev="orders_list_form">{$lang.delete_selected}</a></li>
			{/if}
		</ul>
		{/capture}
		{include file="buttons/button.tpl" but_text=$lang.bulk_print but_name="dispatch[orders.bulk_print]" but_meta="cm-process-items cm-new-window" but_role="button_main"}
		{include file="common_templates/tools.tpl" prefix="main`$smarty.request.content_id`" hide_actions=true tools_list=$smarty.capture.tools_list display="inline" link_text=$lang.choose_action}
	</div>
</div>	
	{/if}
	
	{capture name="tools"}
		{hook name="orders:manage_tools"}
			{include file="common_templates/tools.tpl" tool_href="order_management.new" prefix="bottom" hide_tools="true" link_text=$lang.add_order}
		{/hook}
	{/capture}

</form>
<!--content_manage_orders--></div>
{/capture}
{include file="common_templates/mainbox.tpl" title=$page_title content=$smarty.capture.mainbox title_extra=$smarty.capture.title_extra tools=$smarty.capture.tools extra_tools=$smarty.capture.extra_tools}
