
<form action="{""|fn_url}" method="post" class="cm-form-highlight" name="export_locations">

<div class="tabs cm-j-tabs">
	<ul>
		<li class="cm-js cm-active"><a>{$lang.general}</a></li>
	</ul>
</div>

<div class="cm-tabs-content">
<fieldset>
	<div class="form-field cm-no-hide-input">
		<label for="locations_ids">{$lang.locations}:</label>
		<div class="table-filters">
			<div class="scroll-y">
				{foreach from=$locations key="location_id" item="location"}
					<div class="select-field">
						<input id="location_export_{$location.location_id}" type="checkbox" name="location_ids[]" value="{$location.location_id}" checked="checked" class="checkbox cm-item" />
						<label for="location_export_{$location.location_id}">{$location.name}&nbsp;({$location.dispatch})</label>
					</div>
				{/foreach}
			</div>

			<a href="#select_all" name="check_all" class="cm-check-items cm-on underlined">{$lang.select_all}</a>&nbsp;|
			<a href="#unselect_all" name="check_all" class="cm-check-items cm-off underlined">{$lang.unselect_all}</a>
		</div>
	</div>

	<div class="form-field">
		<label for="output">{$lang.output}:</label>
		<select name="output" id="output">
			<option value="D">{$lang.direct_download}</option>
			{if !"COMPANY_ID"|defined}
				<option value="S">{$lang.server}</option>
			{/if}
		</select>
	</div>

	<div class="form-field">
		<label for="filename">{$lang.filename}:</label>
		<input type="text" name="filename" id="filename" size="50" class="input-text-large" value="layouts_{$smarty.const.TIME|date_format:"%m%d%Y"}.xml" />
	</div>

</fieldset>
</div>

<div class="buttons-container">
	{include file="buttons/save_cancel.tpl" but_text=$lang.export but_name="dispatch[block_manager.export_locations]" cancel_action="close" but_meta="cm-dialog-closer"}
</div>
</form>