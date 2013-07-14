<p>
{if $dist_filename}
Snapshot of the clear installation was not found. Please restore "{$dist_filename}".
{else}
{if $creation_time}Snapshot date: {$creation_time|date_format:"`$settings.Appearance.date_format` `$settings.Appearance.time_format`"}.{/if}
 <a href="{"`$controller`.create_snapshot"|fn_url}">Make a fresh snapshot</a>
{/if}
</p>

{literal}
<style type="text/css">
	.snapshot-added {
		background-color: #A8DA20 !important;
	}
	.snapshot-changed {
		background-color: #ffb636 !important;
	}
	.snapshot-deleted {
		background-color: #ff6666 !important;
	}
</style>
{/literal}

<div class="items-container multi-level">
	{if $changes_tree}
		{include file="views/`$controller`/components/changes_tree.tpl" header="1" parent_id=0 show_all=true expand=true}
	{else}
		<p class="no-items">{$lang.no_items}</p>
	{/if}
</div>

{if $db_diff}
<h2>Database structure changes:</h2>
<pre style="height: 400px;" class="diff-container">{$db_diff|unescape}</pre>
{/if}

<h2>Database data changes:</h2>

{** include fileuploader **}
{*include file="common_templates/file_browser.tpl"*}
{** /include fileuploader **}

<form action="{""|fn_url}" method="post" name="data_compare_form" enctype="multipart/form-data">
	<div class="form-field">
		<label for="name_db" >DB name:</label>
		<input type="text" name="compare_data[db_name]" id="name_db" value="" class="input-text-large main-input" />
	</div>
	<div class="form-field">
		<label for="type_base_file">{$lang.file}:</label>
		{if $compare_data.file_path}
			<b>{$compare_data.file_path}</b> ({$compare_data.file_size|formatfilesize})
		{/if}
		{include file="common_templates/fileuploader.tpl" var_name="base_file"}
	</div>
	<div class="buttons-container cm-toggle-button">
	    {include file="buttons/button.tpl" but_text=$lang.compare but_role="button_main" but_name="dispatch[tools.view_changes]"}
	</div>
</form>

<pre style="height: 400px;" class="diff-container">{$db_d_diff|unescape}</pre>

{if $changes_tree || $db_diff || $db_d_diff}
<div style="margin: 30px 20px 20px 7px;">
<table cellpadding="0" cellspacing="0" border="0" width="30%">
<tr>
	<td><span class="snapshot-added" style="padding: 5px;">Added</span></td>
	<td><span class="snapshot-changed" style="padding: 5px;">Changed</span></td>
	<td><span class="snapshot-deleted" style="padding: 5px;">Deleted</span></td>
</tr>
</table>
</div>
{/if}

<script type="text/javascript">
//<![CDATA[
	$(function () {ldelim}
		$('#on_changes_{$changes_tree|key}').click();
	{rdelim}
	);
//]]>
</script>