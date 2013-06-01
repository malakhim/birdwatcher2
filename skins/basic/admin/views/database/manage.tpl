{capture name="mainbox"}

{capture name="tabsbox"}

{** CREATE BACKUP **}
<div id="content_backup"> 
<form action="{""|fn_url}" method="post" name="backup_form" class="cm-form-highlight cm-comet cm-ajax">
<input type="hidden" name="selected_section" value="backup" />
<input type="hidden" name="result_ids" value="database_management" />

{notes}
	{$lang.multiple_selectbox_notice}
{/notes}

<fieldset>
	<div class="form-field">
		<label for="dbdump_tables">{$lang.select_tables}:</label>
		<select name="dbdump_tables[]" id="dbdump_tables" multiple="multiple" size="10">
			{foreach from=$all_tables item=tbl}
				<option value="{$tbl}"{if $tbl|strpos:$smarty.const.TABLE_PREFIX === 0} selected="selected"{/if}>{$tbl}</option>
			{/foreach}
		</select>
		<p><a onclick="$('#dbdump_tables').selectOptions(true); return false;" class="underlined">{$lang.select_all}</a> / <a onclick="$('#dbdump_tables').selectOptions(false); return false;" class="underlined">{$lang.unselect_all}</a></p>
	</div>
	
	<div class="form-field">
		<label for="dbdump_schema">{$lang.backup_schema}:</label>
		<input type="checkbox" name="dbdump_schema" id="dbdump_schema" value="Y" checked="checked" class="checkbox" />
	</div>
	
	<div class="form-field">
		<label for="dbdump_data">{$lang.backup_data}:</label>
		<input type="checkbox" name="dbdump_data" id="dbdump_data" value="Y" checked="checked" class="checkbox" />
	</div>
	
	<div class="form-field">
		<label for="dbdump_compress">{$lang.compress_dump}:</label>
		<input type="hidden" name="dbdump_compress" value="N" />
		<input type="checkbox" name="dbdump_compress" id="dbdump_compress" value="Y" checked="checked" class="checkbox" />
	</div>
	
	<div class="form-field">
		<label for="dbdump_filename">{$lang.backup_filename}:</label>
		<input type="text" name="dbdump_filename" id="dbdump_filename" size="30" value="dump_{$smarty.now|date_format:"%m%d%Y"}.sql" class="input-text" />
		<p>{$lang.text_backup_filename}</p>
		<p><span>{$backup_dir}</span></p>
	</div>
</fieldset>
	
<div class="buttons-container buttons-bg">
	{include file="buttons/button.tpl" but_text=$lang.backup but_name="dispatch[database.backup]" but_role="button_main"}
</div>
</form>
</div>
{** /CREATE BACKUP **}

{** RESTORE DATABASE **}
<div id="content_restore">
	<form action="{""|fn_url}" method="post" name="upload_data" class="cm-comet" enctype="multipart/form-data">
	<input type="hidden" name="selected_section" value="restore" />

	<fieldset>
	
	<div>{$lang.text_backup_management_notice}</div>
	
	{include file="common_templates/fileuploader.tpl" var_name="sql_dump[0]"}
	
	<div class="buttons-container">
		{include file="buttons/button.tpl" but_text=$lang.upload but_name="dispatch[database.upload]"}
	</div>
	</fieldset>
	</form>
	<form action="{""|fn_url}" method="post" name="restore_form" class="cm-ajax cm-comet" enctype="multipart/form-data">
	<input type="hidden" name="fake" value="1" />
	<input type="hidden" name="selected_section" value="restore" />
	<input type="hidden" name="result_ids" value="database_management" />
	<fieldset>
	<table cellpadding="0" cellspacing="0" border="0" class="table margin-top">
	<tr>
		<th>
			<input type="checkbox" name="check_all" value="Y" title="{$lang.check_uncheck_all}" class="checkbox cm-check-items" /></th>
		<th>{$lang.type}</th>
		<th>{$lang.filename}</th>
		<th>{$lang.filesize}</th>
		<th>&nbsp;</th>
	</tr>
	{foreach from=$backup_files item=file key=name}
	<tr {cycle values="class=\"table-row\", "}>
		<td>
			<input type="checkbox" name="backup_files[]" value="{$name}" class="checkbox cm-item" /></td>
		<td class="center">[{$file.type}]</td>
		<td>
			<a href="{"database.getfile?file=`$name`"|fn_url}"><span>{$name}</span></a></td>
		<td>
			{$file.size|number_format}&nbsp;{$lang.bytes}</td>
		<td class="nowrap">
		{capture name="tools_items"}
		<li><a class="cm-confirm" href="{"database.delete?backup_file=`$name`"|fn_url}">{$lang.delete}</a></li>
		{/capture}
		{include file="common_templates/table_tools_list.tpl" prefix=$name tools_list=$smarty.capture.tools_items href="database.getfile?file=`$name`" link_text=$lang.download}
		</td>
	</tr>
	{foreachelse}
	<tr class="no-items">
		<td colspan="5"><p>{$lang.no_items}</p></td>
	</tr>
	{/foreach}
	</table>

	</fieldset>
	
	{if $backup_files}
		<div class="buttons-container buttons-bg">
			{capture name="tools_list"}
			<ul>
				<li><a name="dispatch[database.delete]" class="cm-process-items cm-confirm" rev="restore_form">{$lang.delete_selected}</a></li>
			</ul>
			{/capture}
			{include file="buttons/button.tpl" but_text=$lang.restore but_name="dispatch[database.restore]" but_meta="cm-process-items cm-confirm" but_role="button_main"}
			{include file="common_templates/tools.tpl" prefix="main" hide_actions=true tools_list=$smarty.capture.tools_list display="inline" link_text=$lang.choose_action}
		</div>
	{/if}
	</form>

</div>
{** /RESTORE DATABASE **}

{** MAINTENANCE **}
<div id="content_maintenance">

<fieldset>

{$lang.current_database_size}: <span>{$database_size|number_format}</span> {$lang.bytes}

</fieldset>

<form action="{""|fn_url}" method="post" class="cm-ajax cm-comet" name="mainainance_form">
<input type="hidden" name="selected_section" value="maintenance" />
<input type="hidden" name="result_ids" value="database_management" />
	<div class="buttons-container buttons-bg">
		{include file="buttons/button.tpl" but_text=$lang.optimize_database but_name="dispatch[database.optimize]" but_role="button_main"}
	</div>
</form>

</div>
{** /MAINTENANCE **}

{/capture}
{include file="common_templates/tabsbox.tpl" content=$smarty.capture.tabsbox}

{/capture}
{include file="common_templates/mainbox.tpl" title=$lang.database content=$smarty.capture.mainbox box_id="database_management"}