{capture name="mainbox"}

<form action="{""|fn_url}" method="post" name="access_restrictions_form" class="cm-form-highlight">
<input type="hidden" name="selected_section" value="{$selected_section}" />

{notes}
	{$lang.text_access_notice}
{/notes}

{capture name="tabsbox"}


{if $selected_section == "ip" || $selected_section == "admin_panel"}
{assign var="value_name" value="ip"}
<div id="content_{$selected_section}">

{include file="common_templates/pagination.tpl" div_id="pagination_$selected_section"}

{assign var="c_url" value=$config.current_url|fn_query_remove:"sort_by":"sort_order"}

<table cellpadding="0" cellspacing="0" border="0" width="100%" class="table sortable">
<tr>
	{hook name="access_restrictions:item_fields_header"}
	<th class="center">
		<input type="checkbox" name="check_all" value="Y" title="{$lang.check_uncheck_all}" class="checkbox cm-check-items" /></th>
	<th><a class="cm-ajax{if $sort_by == "ip"} sort-link-{$sort_order}{/if}" href="{$c_url}&amp;sort_by=ip&amp;sort_order={$sort_order}" rev="pagination_{$selected_section}">{$lang.ips}</a></th>
	<th width="55%"><a class="cm-ajax{if $sort_by == "reason"} sort-link-{$sort_order}{/if}" href="{$c_url}&amp;sort_by=reason&amp;sort_order={$sort_order}" rev="pagination_{$selected_section}">{$lang.reason}</a></th>
	<th><a class="cm-ajax{if $sort_by == "created"} sort-link-{$sort_order}{/if}" href="{$c_url}&amp;sort_by=created&amp;sort_order={$sort_order}" rev="pagination_{$selected_section}">{$lang.created}</a></th>
	<th class="center" width="15%"><a class="cm-ajax{if $sort_by == "status"} sort-link-{$sort_order}{/if}" href="{$c_url}&amp;sort_by=status&amp;sort_order={$sort_order}" rev="pagination_{$selected_section}">{$lang.status}</a></th>
	<th width="5%">&nbsp;</th>
	{/hook}
</tr>
{if $access.$selected_section}
	{include file="addons/access_restrictions/views/access_restrictions/components/items_list.tpl" items=$access.$selected_section}
{else}
	<tr class="no-items">
		<td colspan="5"><p>{$lang.no_items}</p></td>
	</tr>
{/if}
</table>

{if $access.$selected_section}
	{include file="common_templates/table_tools.tpl" href="#access_tabs" visibility="Y"}
{/if}

{include file="common_templates/pagination.tpl" div_id="pagination_$selected_section"}

<div class="buttons-container buttons-bg">
	{if $access.$selected_section}
	<div class="float-left">
		{capture name="tools_list"}
		<ul>
			{if $show_mp}
			<li><a name="dispatch[access_restrictions.make_permanent]" class="cm-process-items cm-confirm" rev="access_restrictions_form">{$lang.make_permanent}</a></li>
			{/if}
			<li><a name="dispatch[access_restrictions.delete]" class="cm-process-items cm-confirm" rev="access_restrictions_form">{$lang.delete_selected}</a></li>
		</ul>
		{/capture}
		{include file="buttons/save.tpl" but_name="dispatch[access_restrictions.m_update]" but_role="button_main"}
		{include file="common_templates/tools.tpl" prefix="main" hide_actions=true tools_list=$smarty.capture.tools_list display="inline" link_text=$lang.choose_action}
	</div>
	{/if}
</div>

</div>

{*************************************************************** Domains **********************************************************}
{elseif $selected_section}
<div id="content_{$selected_section}">

{include file="common_templates/pagination.tpl" div_id="pagination_$selected_section"}

{assign var="c_url" value=$config.current_url|fn_query_remove:"sort_by":"sort_order"}

{if $selected_section == "domain"}
{assign var="value_name" value=$lang.domain}
{elseif $selected_section == "email"}
{assign var="value_name" value=$lang.email}
{elseif $selected_section == "credit_card"}
{assign var="value_name" value=$lang.credit_card_number}
{/if}


<table cellpadding="0" cellspacing="0" border="0" width="100%" class="table sortable">
<tr>
	<th class="center">
		<input type="checkbox" name="check_all" value="Y" title="{$lang.check_uncheck_all}" class="checkbox cm-check-items" /></th>
	<th><a class="cm-ajax{if $sort_by == "value"} sort-link-{$sort_order}{/if}" href="{"`$c_url`&amp;sort_by=value&amp;sort_order=`$sort_order`"|fn_url}" rev="pagination_{$selected_section}">{$value_name}</a></th>
	<th width="100%"><a class="cm-ajax{if $sort_by == "reason"} sort-link-{$sort_order}{/if}" href="{"`$c_url`&amp;sort_by=reason&amp;sort_order=`$sort_order`"|fn_url}" rev="pagination_{$selected_section}">{$lang.reason}</a></th>
	<th><a class="cm-ajax{if $sort_by == "created"} sort-link-{$sort_order}{/if}" href="{"`$c_url`&amp;sort_by=created&amp;sort_order=`$sort_order`"|fn_url}" rev="pagination_{$selected_section}">{$lang.created}</a></th>
	<th class="center"><a class="cm-ajax{if $sort_by == "status"} sort-link-{$sort_order}{/if}" href="{"`$c_url`&amp;sort_by=status&amp;sort_order=`$sort_order`"|fn_url}" rev="pagination_{$selected_section}">{$lang.status}</a></th>
	<th>&nbsp;</th>
</tr>
{if $access.$selected_section}
	{include file="addons/access_restrictions/views/access_restrictions/components/items_list.tpl" items=$access.$selected_section}
{else}
	<tr class="no-items">
		<td colspan="5"><p>{$lang.no_items}</p></td>
	</tr>
{/if}
</table>

{if $access.$selected_section}
	{include file="common_templates/table_tools.tpl" href="#access_tabs" visibility="Y"}
{/if}

{include file="common_templates/pagination.tpl" div_id="pagination_$selected_section"}

<div class="buttons-container buttons-bg">
	{if $access.$selected_section}
	<div class="float-left">
		{capture name="tools_list"}
		<ul>
			<li><a name="dispatch[access_restrictions.delete]" class="cm-process-items cm-confirm" rev="access_restrictions_form">{$lang.delete_selected}</a></li>
		</ul>
		{/capture}
		{include file="buttons/save.tpl" but_name="dispatch[access_restrictions.m_update]" but_role="button_main"}
		{include file="common_templates/tools.tpl" prefix="main" hide_actions=true tools_list=$smarty.capture.tools_list display="inline" link_text=$lang.choose_action}
	</div>
	{/if}
</div>

</div>
{/if}


{/capture}
{include file="common_templates/tabsbox.tpl" content=$smarty.capture.tabsbox active_tab=$selected_section}

</form>
{/capture}


{capture name="tools"}
	{capture name="add_new_picker"}
		{include file="addons/access_restrictions/views/access_restrictions/components/add_items.tpl" object_name=$value_name}
	{/capture}

	{if $selected_section == "domain"}
		{assign var="_text" value=$lang.new_domains}
		{assign var="_link" value=$lang.add_domains}
	{elseif $selected_section == "email"}
		{assign var="_text" value=$lang.new_emails}
		{assign var="_link" value=$lang.add_emails}
	{elseif $selected_section == "credit_card"}
		{assign var="_text" value=$lang.new_credit_card}
		{assign var="_link" value=$lang.add_credit_card}
	{else}
		{assign var="_text" value=$lang.new_ips}
		{assign var="_link" value=$lang.add_ips}		
	{/if}

	{include file="common_templates/popupbox.tpl" id="add_new_section" text=$_text content=$smarty.capture.add_new_picker act="general" link_text=$_link}
{/capture}

{include file="common_templates/mainbox.tpl" title=$lang.store_access content=$smarty.capture.mainbox tools=$smarty.capture.tools select_languages=true}