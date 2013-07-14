{include file="views/profiles/components/profiles_scripts.tpl"}

{capture name="mainbox"}

{include file="views/companies/components/companies_search_form.tpl" dispatch="companies.manage"}

{if $smarty.const.PRODUCT_TYPE == "MULTIVENDOR" || $smarty.const.PRODUCT_TYPE == "ULTIMATE"}
{assign var="lang_add_vendor_supplier" value=$lang.add_vendor}
{assign var="lang_vendors_suppliers" value=$lang.vendors}
{assign var="lang_view_vendor_supplier_products" value=$lang.view_vendor_products}
{assign var="lang_notify_vendor_suppliers" value=$lang.notify_vendor}
{else}
{assign var="lang_add_vendor_supplier" value=$lang.add_supplier}
{assign var="lang_vendors_suppliers" value=$lang.suppliers}
{assign var="lang_view_vendor_supplier_products" value=$lang.view_supplier_products}
{assign var="lang_notify_vendor_suppliers" value=$lang.notify_supplier}
{/if}

<form action="{$index_script}" method="post" name="companies_form" id="companies_form">
<input type="hidden" name="fake" value="1" />

{include file="common_templates/pagination.tpl" save_current_page=true save_current_url=true}

{assign var="c_url" value=$config.current_url|fn_query_remove:"sort_by":"sort_order"}

<table cellpadding="0" cellspacing="0" border="0" width="100%" class="table sortable">
<tr>
	<th width="1%" class="center">
		<input type="checkbox" name="check_all" value="Y" title="{$lang.check_uncheck_all}" class="checkbox cm-check-items" /></th>
	<th><a class="cm-ajax{if $search.sort_by == "id"} sort-link-{$search.sort_order}{/if}" href="{$c_url}&amp;sort_by=id&amp;sort_order={$search.sort_order}" rev="pagination_contents">{$lang.id}</a></th>
	<th width="25%"><a class="cm-ajax{if $search.sort_by == "company"} sort-link-{$search.sort_order}{/if}" href="{$c_url}&amp;sort_by=company&amp;sort_order={$search.sort_order}" rev="pagination_contents">{$lang.name}</a></th>
	
	<th width="25%"><a class="cm-ajax{if $search.sort_by == "email"} sort-link-{$search.sort_order}{/if}" href="{$c_url}&amp;sort_by=email&amp;sort_order={$search.sort_order}" rev="pagination_contents">{$lang.email}</a></th>
	

	<th width="25%"><a class="cm-ajax{if $search.sort_by == "date"} sort-link-{$search.sort_order}{/if}" href="{$c_url}&amp;sort_by=date&amp;sort_order={$search.sort_order}" rev="pagination_contents">{$lang.registered}</a></th>
	
	<th width="15%"><a class="cm-ajax{if $search.sort_by == "status"} sort-link-{$search.sort_order}{/if}" href="{$c_url}&amp;sort_by=status&amp;sort_order={$search.sort_order}" rev="pagination_contents">{$lang.status}</a></th>
	
	<th>&nbsp;</th>
</tr>
{foreach from=$companies item=company}
<tr {cycle values="class=\"table-row\", "}>
	<td class="center">
		<input type="checkbox" name="company_ids[]" value="{$company.company_id}" class="checkbox cm-item" /></td>
	<td><a href="{"companies.update?company_id=`$company.company_id`"|fn_url}">&nbsp;<span>{$company.company_id}</span>&nbsp;</a></td>
	<td><a href="{"companies.update?company_id=`$company.company_id`"|fn_url}">{$company.company}</a></td>
	
	<td><a href="mailto:{$company.email}">{$company.email}</a></td>
	

	<td>{$company.timestamp|date_format:"`$settings.Appearance.date_format`, `$settings.Appearance.time_format`"}</td>
	
	<td>
		{assign var="notify" value=true}
		{include file="common_templates/select_popup.tpl" id=$company.company_id status=$company.status object_id_name="company_id" hide_for_vendor="COMPANY_ID"|defined update_controller="companies" notify=$notify notify_text=$lang_notify_vendor_suppliers}
	</td>
	
	<td class="nowrap">
		{capture name="tools_items"}
		{hook name="companies:list_extra_links"}
			{assign var="return_current_url" value=$config.current_url|escape:url}
			<li><a href="{"products.manage?company_id=`$company.company_id`"|fn_url}">{$lang_view_vendor_supplier_products}</a></li>
			{if $smarty.const.PRODUCT_TYPE == "MULTIVENDOR" || $smarty.const.PRODUCT_TYPE == "ULTIMATE"}
			<li><a href="{"profiles.manage?company_id=`$company.company_id`"|fn_url}">{$lang.view_vendor_users}</a></li>
			<li><a href="{"orders.manage?company_id=`$company.company_id`"|fn_url}">{$lang.view_vendor_orders}</a></li>
			
			{if !"COMPANY_ID"|defined}
			<li><a href="{"companies.merge?company_id=`$company.company_id`"|fn_url}">{$lang.merge}</a></li>
			{/if}
			
			{/if}
			{if !"COMPANY_ID"|defined}
			<li><a class="cm-confirm" href="{"companies.delete?company_id=`$company.company_id`&amp;redirect_url=`$return_current_url`"|fn_url}">{$lang.delete}</a></li>
			{/if}
		{/hook}
		{/capture}
		{include file="common_templates/table_tools_list.tpl" prefix=$company.company_id tools_list=$smarty.capture.tools_items href="companies.update?company_id=`$company.company_id`"}
	</td>
</tr>
{foreachelse}
<tr class="no-items">
	<td colspan="9"><p>{$lang.no_data}</p></td>
</tr>
{/foreach}
</table>

{if $companies}
	{include file="common_templates/table_tools.tpl" href="#companies" elements_count=$companies|count}

	{if !"COMPANY_ID"|defined}
	{capture name="activate_selected"}
		{include file="views/companies/components/reason_container.tpl" type="activate"}
		<div class="buttons-container">
			{include file="buttons/save_cancel.tpl" but_text=$lang.proceed but_name="dispatch[companies.m_activate]" cancel_action="close" but_meta="cm-process-items"}
		</div>
	{/capture}
	{include file="common_templates/popupbox.tpl" id="activate_selected" text=$lang.activate_selected content=$smarty.capture.activate_selected link_text=$lang.activate_selected}

	{capture name="disable_selected"}
		{include file="views/companies/components/reason_container.tpl" type="disable"}
		<div class="buttons-container">
			{include file="buttons/save_cancel.tpl" but_text=$lang.proceed but_name="dispatch[companies.m_disable]" cancel_action="close" but_meta="cm-process-items"}
		</div>
	{/capture}
	{include file="common_templates/popupbox.tpl" id="disable_selected" text=$lang.disable_selected content=$smarty.capture.disable_selected link_text=$lang.disable_selected}
	{/if}
{/if}

{include file="common_templates/pagination.tpl"}

{if $companies && !"COMPANY_ID"|defined}
<div class="buttons-container buttons-bg">
	<div class="float-left">
		
			{assign var="but_class" value="cm-process-items cm-dialog-opener"}
			{include file="buttons/button.tpl" but_rev="content_activate_selected" but_text=$lang.activate_selected but_meta=$but_class but_role="button_main" but_name=$but_name}
			{include file="buttons/button.tpl" but_rev="content_disable_selected" but_text=$lang.disable_selected but_meta=$but_class but_role="button_main" but_name=$but_name}
		
	</div>
</div>
{/if}

{capture name="tools"}
	{include file="common_templates/tools.tpl" tool_href="companies.add" prefix="top" hide_tools=true link_text=$lang_add_vendor_supplier}
{/capture}

</form>

{/capture}
{include file="common_templates/mainbox.tpl" title=$lang_vendors_suppliers content=$smarty.capture.mainbox title_extra=$smarty.capture.title_extra tools=$smarty.capture.tools}
