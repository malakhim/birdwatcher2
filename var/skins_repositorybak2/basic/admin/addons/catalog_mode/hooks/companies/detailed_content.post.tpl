{if $auth.is_root == 'Y' && $smarty.const.PRODUCT_TYPE == "MULTIVENDOR"}
<fieldset>
	{include file="common_templates/subheader.tpl" title=$lang.catalog_mode}
	<div class="form-field">
		<input type="hidden" name="company_data[catalog_mode]" value="N"/>
		<label for="enable_catalog_mode">{$lang.enable_catalog_mode}:</label>
		<input id="enable_catalog_mode" type="checkbox" class="checkbox" {if $company_data.catalog_mode == 'Y'}checked="checked" {/if} name="company_data[catalog_mode]" value="Y">
	</div>
</fieldset>
{/if}