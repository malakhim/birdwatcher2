
{if $is_twigmo_location}
	<div class="form-field">
		<label for="block_{$html_id}_hide_header">{$lang.twgadmin_hide_header}:</label>
		<input type="hidden" name="block_data[properties][hide_header]" value="N">
		<input type="checkbox" class="checkbox" name="block_data[properties][hide_header]" value="Y" id="block_{$html_id}_hide_header" {if $block.properties.hide_header && $block.properties.hide_header == "Y"}checked="checked"{/if} >
	</div>
{/if}