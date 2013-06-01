{notes title=$lang.notice}
	<p>{$lang.export_cron_hint}:<br />
		<span>php /path/to/cart/admin.php --dispatch=exim.cron_export --cron_password={$addons.data_feeds.cron_password}</span>
	</p>
{/notes}

{capture name="mainbox"}

<form action="{""|fn_url}" method="post" name="manage_datafeeds_form">

<table cellpadding="0" cellspacing="0" border="0" width="100%" class="table sortable">
<tr>
	<th width="5%" class="center"><input type="checkbox" name="check_all" value="Y" title="{$lang.check_uncheck_all}" class="checkbox cm-check-items" /></th>
	<th nowrap="nowrap">{$lang.name}</th>
	<th width="15%" nowrap="nowrap">{$lang.export_by_cron}</th>
	<th width="15%" nowrap="nowrap">{$lang.status}</th>
	<th width="10%" nowrap="nowrap">&nbsp;</th>
</tr>
{if $datafeeds}
{foreach from=$datafeeds item=datafeed}
<tr>
	<td class="center">
		<input type="checkbox" name="datafeed_ids[]" value="{$datafeed.datafeed_id}" class="checkbox cm-item" />
	</td>
	
	<td>
		<input type="text" name="datafeed_data[{$datafeed.datafeed_id}][datafeed_name]" size="55" value="{$datafeed.datafeed_name|escape:html}" class="input-text" />
	</td>

	<td class="nowrap">
		<select name="datafeed_data[{$datafeed.datafeed_id}][export_location]">
			<option value=""> -- </option>
			<option value="S" {if $datafeed.export_location == "S"}selected="selected"{/if}>{$lang.server}</option>
			<option value="F" {if $datafeed.export_location == "F"}selected="selected"{/if}>{$lang.ftp}</option>
		</select>
	</td>

	<td align="left">
		{include file="common_templates/select_popup.tpl" id=$datafeed.datafeed_id status=$datafeed.status hidden=false object_id_name="datafeed_id" table="data_feeds"}
	</td>
	
	<td class="nowrap">
		<a class="tool-link" href="{"data_feeds.update?datafeed_id=`$datafeed.datafeed_id`"|fn_url}">{$lang.edit}</a>
		
		{capture name="tools_items"}
			<ul>
				<li><a class="cm-confirm cm-ajax cm-comet" href="{"exim.export_datafeed?datafeed_ids[]=`$datafeed.datafeed_id`&amp;location=L"|fn_url}">{$lang.local_export}</a></li>
				<li><a class="cm-confirm cm-ajax cm-comet" href="{"exim.export_datafeed?datafeed_ids[]=`$datafeed.datafeed_id`&amp;location=S"|fn_url}">{$lang.export_to_server}</a></li>
				<li><a class="cm-confirm cm-ajax cm-comet" href="{"exim.export_datafeed?datafeed_ids[]=`$datafeed.datafeed_id`&amp;location=F"|fn_url}">{$lang.upload_to_ftp}</a></li>
			</ul>
		{/capture}
		{if $smarty.capture.tools_items|strpos:"<li>"}&nbsp;&nbsp;|
			{include file="common_templates/table_tools_list.tpl" prefix=$datafeed.datafeed_id tools_list=$smarty.capture.tools_items link_text=$lang.more link_meta="lowercase"}
		{/if}
	</td>
	
</tr>
{/foreach}
{else}
<tr class="no-items">
	<td colspan="6"><p>{$lang.no_data}</p></td>
</tr>
{/if}
</table>

{if $datafeeds}
	{include file="common_templates/table_tools.tpl" href="#export_datafeeds" visibility="Y"}
{/if}

<div class="buttons-container buttons-bg">
	{if $datafeeds}
	<div class="float-left">
		{capture name="tools_list"}
		<ul>
			<li><a class="cm-confirm cm-process-items" name="dispatch[data_feeds.m_delete]" rev="manage_datafeeds_form">{$lang.delete_selected}</a></li>
		</ul>
		{/capture}
		
		{include file="buttons/save.tpl" but_name="dispatch[data_feeds.m_update]" but_role="button_main"}
		{include file="common_templates/tools.tpl" prefix="main" hide_actions=true tools_list=$smarty.capture.tools_list display="inline" link_text=$lang.choose_action}

		{include file="common_templates/popupbox.tpl" id="select_fields_to_edit" text=$lang.select_fields_to_edit content=$smarty.capture.select_fields_to_edit}
	</div>
	{/if}
</div>	
		

</form>

{capture name="tools"}
	{include file="common_templates/tools.tpl" tool_href="data_feeds.add" prefix="bottom" link_text=$lang.add_datafeed hide_tools=true}
{/capture}

{/capture}
{include file="common_templates/mainbox.tpl" title=$lang.data_feeds content=$smarty.capture.mainbox tools=$smarty.capture.tools select_languages=true}