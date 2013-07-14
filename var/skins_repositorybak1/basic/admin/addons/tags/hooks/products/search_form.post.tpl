{if "COMPANY_ID"|defined && $smarty.const.PRODUCT_TYPE == 'ULTIMATE' || $smarty.const.PRODUCT_TYPE != 'ULTIMATE'}
<div class="search-field">
	<label for="elm_tag">{$lang.tag}:</label>
	<input id="elm_tag" type="text" name="tag" value="{$search.tag}" onfocus="this.select();" class="input-text" />
</div>
{/if}