{if "COMPANY_ID"|defined && $smarty.const.PRODUCT_TYPE == 'ULTIMATE' || $smarty.const.PRODUCT_TYPE != 'ULTIMATE'}
<fieldset>
	{include file="common_templates/subheader.tpl" title=$lang.seo}
	
	<div class="form-field cm-no-hide-input">
		<label for="product_seo_name">{$lang.seo_name}:</label>
		<input type="text" name="product_data[seo_name]" id="product_seo_name" size="55" value="{$product_data.seo_name}" class="input-text-large" />
	</div>
</fieldset>
{/if}