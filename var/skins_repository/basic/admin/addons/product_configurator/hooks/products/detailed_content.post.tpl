<fieldset>
	{include file="common_templates/subheader.tpl" title=$lang.product_configurator}
	<div class="form-field">
		<label for="product_product_type">{$lang.configurable}:</label>
		<input type="hidden" name="product_data[product_type]" value="" />
		<input type="checkbox" name="product_data[product_type]" id="product_product_type" value="C" {if $product_data.product_type == "C" || $smarty.request.product_type == "C"}checked="checked"{/if} class="checkbox" />
	</div>
</fieldset>