{capture name="mainbox"}

<form action="{""|fn_url}" method="post" name="localizations_form"  class="cm-comet cm-ajax">
<input type="hidden" name="result_ids" value="localizations_table" />

<div id="localizations_table">

<table cellpadding="0" cellspacing="0" border="0" width="100%" class="table hidden-inputs">
<tr>
	<th width="1%">
		<input type="checkbox" name="check_all" value="Y" class="cm-check-items checkbox" title="{$lang.check_uncheck_all}" /></th>
	<th width="70%">{$lang.name}</th>
	<th width="10%" class="center">{$lang.default}</th>
	<th width="20%">{$lang.status}</th>
	<th>&nbsp;</th>
</tr>
{foreach from=$localizations item=localization}
<tr {cycle values="class=\"table-row\","}>
	<td align="center">
		<input name="localization_ids[]" type="checkbox" class="checkbox cm-item" value="{$localization.localization_id}" /></td>
	<td>
		<input type="text" name="localizations[{$localization.localization_id}][localization]" size="50" value="{$localization.localization}" class="input-text" /></td>
	<td class="center">
		<input type="radio" name="default_localization" value="{$localization.localization_id}" class="radio" {if $localization.is_default == "Y"}checked="checked"{/if} /></td>
	<td>
		{include file="common_templates/select_popup.tpl" id=$localization.localization_id status=$localization.status object_id_name="localization_id" table="localizations"}</td>
	<td class="nowrap">
		{capture name="tools_items"}
		<li><a class="cm-confirm cm-ajax cm-comet" rev="localizations_table" href="{"localizations.delete?localization_id=`$localization.localization_id`"|fn_url}">{$lang.delete}</a></li>
		{/capture}
		{include file="common_templates/table_tools_list.tpl" prefix=$localization.localization_id tools_list=$smarty.capture.tools_items href="localizations.update?localization_id=`$localization.localization_id`"}
	</td>
</tr>
{foreachelse}
<tr class="no-items">
	<td colspan="5"><p>{$lang.no_data}</p></td>
</tr>
{/foreach}
</table>

{if $localizations}
<div class="buttons-container buttons-bg">
	<div class="float-left">
		{capture name="tools_list"}
		<ul>
			<li><a name="dispatch[localizations.delete]" class="cm-process-items cm-confirm" rev="localizations_form">{$lang.delete_selected}</a></li>
		</ul>
		{/capture}
		{include file="buttons/button.tpl" but_name="dispatch[localizations.m_update]" but_text=$lang.update but_role="button_main" but_meta="cm-no-ajax"}
		{include file="common_templates/tools.tpl" prefix="main" hide_actions=true tools_list=$smarty.capture.tools_list display="inline" link_text=$lang.choose_action}
	</div>
</div>
{/if}

<!--localizations_table--></div>

</form>

{capture name="tools"}
	{include file="common_templates/tools.tpl" tool_href="localizations.add" prefix="top" link_text=$lang.add_localization link_text=$lang.add_localization hide_tools=true}
{/capture}

{/capture}
{include file="common_templates/mainbox.tpl" title=$lang.localizations content=$smarty.capture.mainbox tools=$smarty.capture.tools select_languages=true}