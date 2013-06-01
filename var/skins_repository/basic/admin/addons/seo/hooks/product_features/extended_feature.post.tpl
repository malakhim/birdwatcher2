{if "COMPANY_ID"|defined && $smarty.const.PRODUCT_TYPE == 'ULTIMATE' || $smarty.const.PRODUCT_TYPE != 'ULTIMATE'}
<div class="form-field">
	<label for="elm_seo_name_{$id}_{$num}">{$lang.seo_name}:</label>
	<input type="text" name="feature_data[variants][{$num}][seo_name]" id="elm_seo_name_{$id}_{$num}" size="55" value="{if !$empty_string}{$var.seo_name}{/if}" class="input-text-large" />
</div>
{/if}