
{assign var="no_hide_input" value="cm-no-hide-input"}


{include file="views/profiles/components/profiles_scripts.tpl"}

{capture name="mainbox"}

{include file="views/profiles/components/users_search_form.tpl" dispatch="profiles.manage"}

<div id="content_manage_users">
<form action="{""|fn_url}" method="post" name="userlist_form" id="userlist_form" class="{if "COMPANY_ID"|defined && $smarty.const.PRODUCT_TYPE != "ULTIMATE"}cm-hide-inputs{/if}">
<input type="hidden" name="fake" value="1" />
<input type="hidden" name="user_type" value="{$smarty.request.user_type}" />

{include file="common_templates/pagination.tpl" save_current_page=true save_current_url=true div_id=$smarty.request.content_id}

{assign var="c_url" value=$config.current_url|fn_query_remove:"sort_by":"sort_order"}

{assign var="rev" value=$smarty.request.content_id|default:"pagination_contents"}

<table cellpadding="0" cellspacing="0" border="0" width="100%" class="table sortable">
<tr>
	<th width="1%" class="center {$no_hide_input}">
		<input type="checkbox" name="check_all" value="Y" title="{$lang.check_uncheck_all}" class="checkbox cm-check-items" /></th>
	<th><a class="cm-ajax{if $search.sort_by == "id"} sort-link-{$search.sort_order}{/if}" href="{"`$c_url`&amp;sort_by=id&amp;sort_order=`$search.sort_order`"|fn_url}" rev={$rev}>{$lang.id}</a></th>
	{if $settings.General.use_email_as_login != "Y"}
	<th width="20%"><a class="cm-ajax{if $search.sort_by == "username"} sort-link-{$search.sort_order}{/if}" href="{"`$c_url`&amp;sort_by=username&amp;sort_order=`$search.sort_order`"|fn_url}" rev={$rev}>{$lang.username}</a></th>
	{/if}
	<th width="20%"><a class="cm-ajax{if $search.sort_by == "name"} sort-link-{$search.sort_order}{/if}" href="{"`$c_url`&amp;sort_by=name&amp;sort_order=`$search.sort_order`"|fn_url}" rev={$rev}>{$lang.name}</a></th>
	<th width="20%"><a class="cm-ajax{if $search.sort_by == "email"} sort-link-{$search.sort_order}{/if}" href="{"`$c_url`&amp;sort_by=email&amp;sort_order=`$search.sort_order`"|fn_url}" rev={$rev}>{$lang.email}</a></th>
	<th width="20%"><a class="cm-ajax{if $search.sort_by == "date"} sort-link-{$search.sort_order}{/if}" href="{"`$c_url`&amp;sort_by=date&amp;sort_order=`$search.sort_order`"|fn_url}" rev={$rev}>{$lang.registered}</a></th>
	<th><a class="cm-ajax{if $search.sort_by == "type"} sort-link-{$search.sort_order}{/if}" href="{"`$c_url`&amp;sort_by=type&amp;sort_order=`$search.sort_order`"|fn_url}" rev={$rev}>{$lang.type}</a></th>
	{hook name="profiles:manage_header"}{/hook}
	<th width="15%"><a class="cm-ajax{if $search.sort_by == "status"} sort-link-{$search.sort_order}{/if}" href="{"`$c_url`&amp;sort_by=status&amp;sort_order=`$search.sort_order`"|fn_url}" rev={$rev}>{$lang.status}</a></th>
	<th>&nbsp;</th>
</tr>
{foreach from=$users item=user}
{if "COMPANY_ID"|defined && $user.company_id != $smarty.const.COMPANY_ID && !"RESTRICTED_ADMIN"|defined && $auth.is_root != 'Y'}
	{assign var="link_text" value=$lang.view}
	{assign var="popup_additional_class" value=""}
{elseif $user.company_id == $smarty.const.COMPANY_ID || ("RESTRICTED_ADMIN"|defined && $user.user_id != $auth.user_id) || $auth.is_root == 'Y'}
	{assign var="link_text" value=""}
	{assign var="popup_additional_class" value="cm-no-hide-input"}
{else}
	{assign var="popup_additional_class" value=""}
	{assign var="link_text" value=""}
{/if}

<tr class="{cycle values="table-row, "}">



	<td class="center {$no_hide_input}">
		<input type="checkbox" name="user_ids[]" value="{$user.user_id}" class="checkbox cm-item" /></td>
	<td><a href="{"profiles.update?user_id=`$user.user_id`&user_type=`$user.user_type`"|fn_url}">&nbsp;<span>{$user.user_id}</span>&nbsp;</a></td>
	{if $settings.General.use_email_as_login != "Y"}
	<td><a href="{"profiles.update?user_id=`$user.user_id`&user_type=`$user.user_type`"|fn_url}">{$user.user_login}</a></td>
	{/if}
	<td>{if $user.firstname || $user.lastname}<a href="{"profiles.update?user_id=`$user.user_id`&user_type=`$user.user_type`"|fn_url}">{$user.lastname} {$user.firstname}</a>{else}-{/if}{include file="views/companies/components/company_name.tpl" company_name=$user.company_name company_id=$user.company_id}</td>
	<td width="25%"><a href="mailto:{$user.email|escape:url}">{$user.email}</a></td>
	<td>{$user.timestamp|date_format:"`$settings.Appearance.date_format`, `$settings.Appearance.time_format`"}</td>
	<td>{if $user.user_type == "A"}{$lang.administrator}{elseif $user.user_type == "V"}{$lang.vendor_administrator}{elseif $user.user_type == "C"}{$lang.customer}{elseif $user.user_type == "P"}{$lang.affiliate}{/if}</td>
	{hook name="profiles:manage_data"}{/hook}
	<td>
		<input type="hidden" name="user_types[{$user.user_id}]" value="{$user.user_type}" />

		{if ($user.is_root == "Y" && ($user.user_type != 'V' || ($smarty.session.auth.user_type != 'A'))) || ($user.user_id == $smarty.session.auth.user_id)}
			{assign var="display" value="text"}
		{else}
			{assign var="display" value=""}
		{/if}

		{include file="common_templates/select_popup.tpl" id=$user.user_id status=$user.status hidden="" update_controller="profiles" notify=true notify_text=$lang.notify_user popup_additional_class=$popup_additional_class display=$display}
	</td>
	<td class="nowrap">
		{capture name="tools_items"}
		{hook name="profiles:list_extra_links"}
			{if $user.user_type == "C"}
				<li><a href="{"orders.manage?user_id=`$user.user_id`"|fn_url}">{$lang.view_all_orders}</a></li>
				{if !"COMPANY_ID"|defined}
				<li><a href="{"profiles.act_as_user?user_id=`$user.user_id`"|fn_url}" target="_blank" >{$lang.act_on_behalf}</a></li>
				{/if}
			{/if}
			{assign var="return_current_url" value=$config.current_url|escape:url}

			{if $user|fn_check_rights_delete_user}
				<li><a class="cm-confirm" href="{"profiles.delete?user_id=`$user.user_id`&amp;redirect_url=`$return_current_url`"|fn_url}">{$lang.delete}</a></li>
			{/if}
		{/hook}
		{/capture}
		{if $smarty.request.user_type}
			{assign var="user_edit_link" value="profiles.update?user_id=`$user.user_id`&user_type=`$smarty.request.user_type`"}
		{else}
			{assign var="user_edit_link" value="profiles.update?user_id=`$user.user_id`&user_type=`$user.user_type`"}
		{/if}
		{include file="common_templates/table_tools_list.tpl" prefix=$user.user_id tools_list=$smarty.capture.tools_items href=$user_edit_link link_text=$link_text}
	</td>
</tr>
{foreachelse}
<tr class="no-items">
	<td colspan="9"><p>{$lang.no_data}</p></td>
</tr>
{/foreach}
</table>

{if $users}
	{include file="common_templates/table_tools.tpl" href="#users"}
{/if}

{include file="common_templates/pagination.tpl" div_id=$smarty.request.content_id}

{if $users}
<div class="buttons-container buttons-bg">
	<div class="float-left">
		{if "COMPANY_ID"|defined && $smarty.request.user_type == "C" && $smarty.const.PRODUCT_TYPE != "ULTIMATE"}
			{capture name="tools_list"}
			<ul>
				{hook name="profiles:list_tools"}
				{/hook}
			</ul>
			{/capture}
			{include file="buttons/button.tpl" but_text=$lang.export_selected but_name="dispatch[profiles.export_range]" but_meta="cm-confirm cm-process-items" but_role="button_main"}
			{include file="common_templates/tools.tpl" prefix="main`$smarty.request.content_id`" hide_actions=true tools_list=$smarty.capture.tools_list display="inline" link_text=$lang.choose_action}
		{else}
			{capture name="tools_list"}
			<ul>
				{hook name="profiles:list_tools"}
					<li><a class="cm-process-items" name="dispatch[profiles.export_range]" rev="userlist_form">{$lang.export_selected}</a></li>
				{/hook}
			</ul>
			{/capture}
			{include file="buttons/button.tpl" but_text=$lang.delete_selected but_name="dispatch[profiles.m_delete]" but_meta="cm-confirm cm-process-items" but_role="button_main"}
			{include file="common_templates/tools.tpl" prefix="main`$smarty.request.content_id`" hide_actions=true tools_list=$smarty.capture.tools_list display="inline" link_text=$lang.choose_action}
		{/if}
	</div>	
</div>
{/if}

{capture name="tools"}
	{if $smarty.request.user_type}
		{if !("COMPANY_ID"|defined && $smarty.const.PRODUCT_TYPE == 'MULTIVENDOR' && $smarty.request.user_type == 'C')}
			{include file="common_templates/tools.tpl" tool_href="profiles.add?user_type=`$smarty.request.user_type`" prefix="top" hide_tools=true link_text=$lang.add_user}
		{/if}
	{else}
		{if $smarty.const.PRODUCT_TYPE == 'PROFESSIONAL' && $settings.Suppliers.enable_suppliers == "Y"}
			{include file="common_templates/tools.tpl" tool_href="companies.add" prefix="bottom" hide_tools=true link_text=$lang.add_supplier}
		{/if}
		{foreach from=$user_types key="_k" item="_p"}
			{if !("COMPANY_ID"|defined && $smarty.const.PRODUCT_TYPE == 'MULTIVENDOR' && ($_k == 'C' || "RESTRICTED_ADMIN"|defined))}
				{include file="common_templates/tools.tpl" tool_href="profiles.add?user_type=`$_k`" prefix="top" hide_tools=true link_text=$lang.$_p}
			{/if}
		{/foreach}
	{/if}
{/capture}

</form>
<!--content_manage_users--></div>

{/capture}

{if $smarty.request.user_type}
	{assign var="_title" value=$smarty.request.user_type|fn_get_user_type_description:true}
{else}
	{assign var="_title" value=$lang.users}
{/if}
{include file="common_templates/mainbox.tpl" title=$_title content=$smarty.capture.mainbox title_extra=$smarty.capture.title_extra tools=$smarty.capture.tools}