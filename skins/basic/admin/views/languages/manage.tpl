{capture name="mainbox"}

{capture name="tabsbox"}

<div id="content_translations">

{include file="views/languages/components/langvars_search_form.tpl"}

<form action="{""|fn_url}" method="post" name="language_variables_form">
<input type="hidden" name="q" value="{$smarty.request.q}" />
<input type="hidden" name="selected_section" value="{$smarty.request.selected_section}" />

{include file="common_templates/pagination.tpl" save_current_page=true}

<table cellspacing="0" cellpadding="0" border="0" width="100%" class="table">
<tr>
	<th width="1%">
		<input type="checkbox" name="check_all" value="Y" title="{$lang.check_uncheck_all}" class="checkbox cm-check-items" /></th>
	<th width="29%">{$lang.language_variable}</th>
	<th width="60%">{$lang.value}</th>
	<th width="10%">&nbsp;</th>
</tr>
{foreach from=$lang_data item="var" key="key"}
<tr {cycle values="class=\"table-row\", " name="2"} valign="top">
	<td width="1%">
		<input type="checkbox" name="names[]" value="{$var.name}" class="checkbox cm-item" /></td>
	<td width="29%">
		<input type="hidden" name="lang_data[{$key}][name]" value="{$var.name}" />
		<p><span>{$var.name}</span></p></td>
	<td width="60%">
		<textarea name="lang_data[{$key}][value]" cols="55" rows="3" class="input-text">{$var.value}</textarea></td>
	<td width="10%" class="nowrap">

		{capture name="tools_items"}
		<li><a class="cm-confirm" href="{"languages.delete_variable?name=`$var.name``$page`"|fn_url}">

				{$lang.delete}

		</a></li>
		{/capture}
		{include file="common_templates/table_tools_list.tpl" prefix=$var.name tools_list=$smarty.capture.tools_items}
	</td>
</tr>
{foreachelse}
<tr class="no-items">
	<td colspan="4"><p>{$lang.no_data}</p></td>
</tr>
{/foreach}
</table>

{include file="common_templates/pagination.tpl"}

{if $lang_data}
	<div class="buttons-container buttons-bg">
		<div class="float-left">
			{capture name="tools_list"}
			<ul>
				<li><a name="dispatch[languages.m_delete_variables]" class="cm-process-items cm-confirm" rev="language_variables_form">{$lang.delete_selected}</a></li>
			</ul>
			{/capture}
			{include file="buttons/save.tpl" but_name="dispatch[languages.m_update_variables]" but_role="button_main"}
			{include file="common_templates/tools.tpl" prefix="main" hide_actions=true tools_list=$smarty.capture.tools_list display="inline" link_text=$lang.choose_action}
		</div>
		
			{capture name="tools"}
				
					{include file="common_templates/popupbox.tpl" id="add_language" text=$lang.new_language link_text=$lang.add_language content=$smarty.capture.add_language act="general"}
				
				{include file="common_templates/popupbox.tpl" id="add_langvar" text=$lang.new_language_variable link_text=$lang.add_language_variable content=$smarty.capture.add_langvar act="general"}
			{/capture}

	</div>
{/if}
</form>

{capture name="add_langvar"}

<form action="{""|fn_url}" method="post" name="lang_add_var">
<input type="hidden" name="page" value="{$smarty.request.page}" />
<input type="hidden" name="q" value="{$smarty.request.q}" />
<input type="hidden" name="selected_section" value="{$smarty.request.selected_section}" />

<table cellpadding="0" cellspacing="0" border="0" width="100%" class="add-new-table">
<tr class="cm-first-sibling">
	<th width="35%">{$lang.language_variable}</th>
	<th width="64%">{$lang.value}</th>
	<th width="1%">&nbsp;</th>
</tr>
<tr id="box_new_lang_tag" valign="top">
	<td>
		<input type="text" size="30" name="new_lang_data[0][name]" class="input-text" /></td>
	<td>
		<textarea name="new_lang_data[0][value]" cols="48" rows="2" class="input-textarea-long"></textarea></td>
	<td>
		{include file="buttons/multiple_buttons.tpl" item_id="new_lang_tag"}</td>
</tr>
</table>

<div class="buttons-container">
	{include file="buttons/save_cancel.tpl" create=true but_name="dispatch[languages.update_variables]" cancel_action="close"}
</div>

</form>

{/capture}

</div>

<div class="hidden" id="content_languages">


{capture name="add_language"}
	{include file="views/languages/update.tpl" mode="add"}
{/capture}

{* FIXME: HARDCODE checking permissions. We need to divide these two forms by different modes *}
<form action="{""|fn_url}" method="post" name="languages_form" class="{if "COMPANY_ID"|defined}cm-hide-inputs{/if}">
<input type="hidden" name="page" value="{$smarty.request.page}" />
<input type="hidden" name="selected_section" value="{$smarty.request.selected_section}" />

<table cellspacing="0" cellpadding="0" border="0" width="100%" class="table">
<tr class="cm-first-sibling">
	<th class="center" width="1%">
		<input type="checkbox" name="check_all" value="Y" title="{$lang.check_uncheck_all}" class="checkbox cm-check-items" /></th>
	<th>{$lang.language_code}</th>
	<th>{$lang.name}</th>
	<th width="100%">{$lang.status}</th>
	<th>&nbsp;</th>
</tr>
{if $langs|count == 1}
	{assign var="disable_change" value=true}
{/if}
{foreach from=$langs item="language"}
<tr {cycle values="class=\"table-row\", "}>
	<td class="center" width="1%">
		<input type="checkbox" name="lang_codes[]" value="{$language.lang_code}" {if $language.lang_code == $smarty.const.DEFAULT_LANGUAGE}disabled="disabled"{/if} class="checkbox cm-item" /></td>
	<td>
		<input type="hidden" name="update_language[{$language.lang_code}][lang_code]" value="{$language.lang_code}" />
		<span>{$language.lang_code}</span></td>
	<td>
		<input type="text" name="update_language[{$language.lang_code}][name]" value="{$language.name}" maxlength="64" class="input-text" /></td>
	<td>
		{if $disable_change}
			{assign var="lang_id" value=""}
		{else}
			{assign var="lang_id" value=$language.lang_code}
		{/if}
		{include file="common_templates/select_popup.tpl" id=$lang_id prefix="lng" status=$language.status hidden="Y" object_id_name="lang_code" table="languages" update_controller="languages"}
	</td>
	<td class="nowrap">
		{capture name="tools_items"}
		{if $language.lang_code == $smarty.const.DEFAULT_LANGUAGE}
			<li><span class="undeleted-element">{$lang.delete}</span></li>
		{else}
			<li><a class="cm-confirm" href="{"languages.delete_language?lang_code=`$language.lang_code`"|fn_url}">{$lang.delete}</a></li>
		{/if}
		{/capture}
		{include file="common_templates/table_tools_list.tpl" prefix=$language.lang_code tools_list=$smarty.capture.tools_items href="languages.update?lang_code=`$language.lang_code`" link_text=$lang.edit extra_class="cm-dialog-opener text-button-edit cm-ajax-update" link_extra="id='opener_`$language.lang_code`' rev='content_`$language.lang_code`'"}
	</td>
	{capture name="popups"}
		{$smarty.capture.popups}
		<div id="content_{$language.lang_code}" class="hidden" title="{"`$lang.editing_language`: `$language.name`"}"></div>
	{/capture}
</tr>
{/foreach}
</table>


<div class="buttons-container buttons-bg">
	
	<div class="float-left">
		{capture name="tools_list"}
		<ul>
			<li><a name="dispatch[languages.m_delete]" class="cm-process-items cm-confirm" rev="languages_form">{$lang.delete_selected}</a></li>
		</ul>
		{/capture}
		{include file="buttons/save.tpl" but_name="dispatch[languages.m_update]" but_role="button_main"}
		{include file="common_templates/tools.tpl" prefix="main" hide_actions=true tools_list=$smarty.capture.tools_list display="inline" link_text=$lang.choose_action}
	</div>
	
		{capture name="tools"}
			
				{if !"COMPANY_ID"|defined}
					{include file="common_templates/popupbox.tpl" id="add_language" text=$lang.new_language link_text=$lang.add_language content=$smarty.capture.add_language act="general"}
				{/if}
			
			{include file="common_templates/popupbox.tpl" id="add_langvar" text=$lang.new_language_variable link_text=$lang.add_language_variable content=$smarty.capture.add_langvar act="general"}
		{/capture}
</div>

</form>

</div>

{$smarty.capture.popups}

{/capture}
{include file="common_templates/tabsbox.tpl" content=$smarty.capture.tabsbox active_tab=$smarty.request.selected_section track=true}

{/capture}
{include file="common_templates/mainbox.tpl" title=$lang.languages content=$smarty.capture.mainbox tools=$smarty.capture.tools select_languages=true}