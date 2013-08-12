<div class="search-field">
	<label for="configurable">{$lang.configurable}:</label>
	<select name="configurable" id="configurable">
		<option value="">--</option>
		<option value="C" {if $search.configurable == "C"}selected="selected"{/if}>{$lang.yes}</option>
		<option value="P" {if $search.configurable == "P"}selected="selected"{/if}>{$lang.no}</option>
	</select>
</div>