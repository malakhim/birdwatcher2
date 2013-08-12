{include file="views/profiles/components/profiles_scripts.tpl"}

{capture name="mainbox"}

{capture name="tabsbox"}
	{assign var="hide_inputs" value=false}

	
	{if !$user_data|fn_allow_save_object:"users" || "COMPANY_ID"|defined && ($smarty.request.user_type == 'C' || $user_data.company_id|fn_string_not_empty && $user_data.company_id != $smarty.const.COMPANY_ID)}
		{assign var="hide_inputs" value=true}
	{/if}
	

	<form name="profile_form" action="{""|fn_url}" method="post" class="cm-form-highlight{if $hide_inputs} cm-hide-inputs{/if}">		
	{if $mode != "add"}
		<input type="hidden" name="user_id" value="{$smarty.request.user_id}" />
	{/if}
	<input type="hidden" class="cm-no-hide-input" name="selected_section" id="selected_section" value="{$selected_section}" />
	<input type="hidden" class="cm-no-hide-input" name="user_type" value="{$smarty.request.user_type}" />

	
	<div id="content_general">
		{hook name="profiles:general_content"}
		<fieldset>
			{include file="views/profiles/components/profiles_account.tpl"}
			{if $smarty.const.PRODUCT_TYPE == "ULTIMATE" && (($smarty.request.user_type && !$smarty.request.user_type|fn_check_user_type_admin_area) || (!$smarty.request.user_type && !$user_data.user_type|fn_check_user_type_admin_area)) || $smarty.const.PRODUCT_TYPE != "ULTIMATE" && ($smarty.request.user_type == "V" || !$smarty.request.user_type && $user_data.user_type == "V")}
				{assign var="exclude_company_id" value="0"}
				{include file="views/companies/components/company_field.tpl" title=$lang.vendor name="user_data[company_id]" selected=$user_data.company_id exclude_company_id=$exclude_company_id}
			{else}
				<input type="hidden" name="user_data[company_id]" id="company_id" value="0">
			{/if}
		</fieldset>
		{/hook}
		
		<fieldset>
		{include file="views/profiles/components/profile_fields.tpl" section="C" title=$lang.contact_information}
		</fieldset>

		{if $settings.General.user_multiple_profiles == "Y" && $mode == "update"}
		<fieldset>
			{include file="common_templates/subheader.tpl" title=$lang.user_profile_info}
			<p class="form-note">{$lang.text_multiprofile_notice}</p>
			{include file="views/profiles/components/multiple_profiles.tpl"}
		</fieldset>
		{/if}

		<fieldset>
		{if $profile_fields.B}
			{include file="views/profiles/components/profile_fields.tpl" section="B" title=$lang.billing_address}
			{include file="views/profiles/components/profile_fields.tpl" section="S" title=$lang.shipping_address body_id="sa" shipping_flag=$profile_fields|fn_compare_shipping_billing}
		{else}
			{include file="views/profiles/components/profile_fields.tpl" section="S" title=$lang.shipping_address shipping_flag=false}
		{/if}
		</fieldset>
	</div>
	
	{if $mode == "update" && ((!$user_data|fn_check_user_type_admin_area && !"COMPANY_ID"|defined) || ($user_data|fn_check_user_type_admin_area && $usergroups && !"COMPANY_ID"|defined && $auth.is_root == 'Y' && ($user_data.company_id != 0 || ($user_data.company_id == 0 && $user_data.is_root != 'Y'))) || ($user_data.user_type == 'V' && "COMPANY_ID"|defined && $auth.is_root == 'Y' && $user_data.user_id != $auth.user_id && $user_data.company_id == $smarty.const.COMPANY_ID))}
	<div id="content_usergroups" class="cm-hide-save-button">
		<table cellpadding="0" cellspacing="0" border="0" width="100%" class="table">
		<tr>
			<th width="50%">{$lang.usergroup}</th>
			<th>{$lang.status}</th>
		</tr>
		{foreach from=$usergroups item=usergroup}
		<tr {cycle values="class=\"table-row\", "}>
			<td><a href="{"usergroups.manage#opener_group`$usergroup.usergroup_id`"|fn_url}">{$usergroup.usergroup}</a></td>
			<td>
				{if $user_data.usergroups[$usergroup.usergroup_id]}
					{assign var="ug_status" value=$user_data.usergroups[$usergroup.usergroup_id].status}
				{else}
					{assign var="ug_status" value="F"}
				{/if}
				{include file="common_templates/select_popup.tpl" id=$usergroup.usergroup_id status=$ug_status hidden="" items_status="profiles"|fn_get_predefined_statuses extra="&amp;user_id=`$user_data.user_id`" update_controller="usergroups" notify=true hide_for_vendor="COMPANY_ID"|defined}
			</td>
		</tr>
		{foreachelse}
		<tr class="no-items">
			<td colspan="2"><p>{$lang.no_items}</p></td>
		</tr>
		{/foreach}
		</table>
	</div>
	{/if}
	
	<div id="content_addons">
		{hook name="profiles:detailed_content"}
		{/hook}
	</div>

	{hook name="profiles:tabs_content"}
	{/hook}

	<p class="select-field notify-customer cm-toggle-button">
		<input type="checkbox" name="notify_customer" value="Y" checked="checked" class="checkbox" id="notify_customer" />
		<label for="notify_customer">{$lang.notify_user}</label>
	</p>

	<div class="buttons-container buttons-bg cm-toggle-button">
		{include file="buttons/save_cancel.tpl" but_name="dispatch[profiles.update]" hide_first_button=$hide_inputs hide_second_button=$hide_inputs}
	</div>

	</form>

	{if $mode != "add"}
		{hook name="profiles:tabs_extra"}
		{/hook}
	{/if}
{/capture}

{include file="common_templates/tabsbox.tpl" content=$smarty.capture.tabsbox group_name=$controller active_tab=$selected_section track=true}

{/capture}
{if $mode == "add"}
	{assign var="_user_desc" value=$user_type|fn_get_user_type_description}
	{assign var="_title" value="`$lang.new_profile` (`$_user_desc`)"}
{else}
	{if $user_data.firstname}
		{assign var="_title" value="`$lang.editing_profile`: `$user_data.firstname` `$user_data.lastname`"}
	{elseif $user_data.b_firstname}
		{assign var="_title" value="`$lang.editing_profile`: `$user_data.b_firstname` `$user_data.b_lastname`"}
	{else}
		{assign var="_title" value="`$lang.editing_profile`: `$user_data.company`"}
	{/if}
	{capture name="extra_tools"}
		{if $user_data.user_type == "C"}
			<a class="tool-link" href="{"orders.manage?user_id=`$user_data.user_id`"|fn_url}">{$lang.view_all_orders}</a>
		{/if}
		{if $user_data.user_type|fn_user_need_login && !"COMPANY_ID"|defined}
			<a class="tool-link" href="{"profiles.act_as_user?user_id=`$user_data.user_id`"|fn_url}" target="_blank">{$lang.act_on_behalf}</a>
		{/if}
	{/capture}
	{include file="common_templates/view_tools.tpl" url="profiles.update?user_id="}
{/if}

{include file="common_templates/mainbox.tpl" title=$_title content=$smarty.capture.mainbox extra_tools=$smarty.capture.extra_tools tools=$smarty.capture.view_tools}