
<form action="{""|fn_url}" method="post" class="cm-form-highlight" name="import_locations" enctype="multipart/form-data">

<div class="tabs cm-j-tabs">
	<ul>
		<li class="cm-js cm-active"><a>{$lang.general}</a></li>
	</ul>
</div>

<div class="cm-tabs-content">
<fieldset>
	<div class="form-field">
		<label>{$lang.select_file}:</label>
		{include file="common_templates/fileuploader.tpl" var_name="filename[0]"}
	</div>

	<div class="form-field cm-no-hide-input">
		<label for="clean_up_export_{$location_id}">{$lang.clean_up_all_locations_on_import}:</label>
		<input id="clean_up_export_{$location.location_id}" type="checkbox" name="clean_up" value="1" />
	</div>

	<div class="form-field cm-no-hide-input">
		<label for="override_by_dispatch_{$location_id}">{$lang.override_by_dispatch}:</label>
		<input id="override_by_dispatch_{$location.location_id}" type="checkbox" name="override_by_dispatch" value="1" checked="checked" />
	</div>
</fieldset>
</div>

<div class="buttons-container">
	{include file="buttons/save_cancel.tpl" but_text=$lang.import but_name="dispatch[block_manager.import_locations]" cancel_action="close" but_meta="cm-dialog-closer"}
</div>
</form>