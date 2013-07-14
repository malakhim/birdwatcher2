{** banners section **}

{capture name="mainbox"}

<form action="{""|fn_url}" method="post" name="banners_form" class="cm-form-highlight cm-hide-inputs" enctype="multipart/form-data">
<input type="hidden" name="fake" value="1" />

<table cellpadding="0" cellspacing="0" border="0" width="100%" class="table hidden-inputs">
<tr>
	<th class="center">
		<input type="checkbox" name="check_all" value="Y" class="checkbox cm-check-items cm-no-hide-input" /></th>
	<th>{$lang.banner}</th>
	<th>{$lang.type}</th>
	<th width="100%">{$lang.status}</th>
	<th>&nbsp;</th>
</tr>
{foreach from=$banners item=banner}
<tr {cycle values="class=\"table-row\", "}>
	{if "COMPANY_ID"|defined && $banner.company_id != $smarty.const.COMPANY_ID}
		{assign var="no_hide_input" value=""}
	{else}
		{assign var="no_hide_input" value="cm-no-hide-input"}
	{/if}

	<td class="center">
		<input type="checkbox" name="banner_ids[]" value="{$banner.banner_id}" class="checkbox cm-item {$no_hide_input}" /></td>
	<td width="100%" class="{$no_hide_input}">
		<input type="text" name="banners[{$banner.banner_id}][banner]" value="{$banner.banner}" size="20" class="input-text" /></td>
	<td class="nowrap {$no_hide_input}">{if $banner.type == "G"}{$lang.graphic_banner}{else}{$lang.text_banner}{/if}</td>
	<td >
		{include file="common_templates/select_popup.tpl" id=$banner.banner_id status=$banner.status hidden=true object_id_name="banner_id" table="banners" popup_additional_class=$no_hide_input}
	</td>
	<td class="nowrap {$no_hide_input}">
		{capture name="tools_items"}

		{if !$hide_delete}
		<li><a class="cm-confirm" href="{"banners.delete?banner_id=`$banner.banner_id`"|fn_url}">{$lang.delete}</a></li>
		{/if}
		{/capture}
		{include file="common_templates/table_tools_list.tpl" prefix=$banner.banner_id tools_list=$smarty.capture.tools_items href="banners.update?banner_id=`$banner.banner_id`"}
	</td>
</tr>
{foreachelse}
<tr class="no-items">
	<td colspan="5"><p>{$lang.no_data}</p></td>
</tr>
{/foreach}
</table>

{if $banners}
<div class="buttons-container buttons-bg">
	<div class="float-left">
		{capture name="tools_list"}
		<ul>
			<li><a name="dispatch[banners.delete]" class="cm-process-items cm-confirm" rev="banners_form">{$lang.delete_selected}</a></li>
		</ul>
		{/capture}
		{include file="buttons/save.tpl" but_name="dispatch[banners.m_update]" but_role="button_main"}
		{include file="common_templates/tools.tpl" prefix="main" hide_actions=true tools_list=$smarty.capture.tools_list display="inline" link_text=$lang.choose_action}
	</div>
</div>	
	{/if}
</form>

{capture name="tools"}
	{include file="common_templates/tools.tpl" tool_href="banners.add" prefix="top" hide_tools="true" link_text=$lang.add_banner}
{/capture}

{/capture}
{include file="common_templates/mainbox.tpl" title=$lang.banners content=$smarty.capture.mainbox tools=$smarty.capture.tools select_languages=true}

{** ad section **}