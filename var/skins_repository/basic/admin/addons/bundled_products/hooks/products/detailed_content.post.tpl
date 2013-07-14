<fieldset>

{include file="common_templates/subheader.tpl" title=$lang.bundled_products}

<div class="form-field">
	<label for="bundle">{$lang.use_as_a_bundle}:</label>
	<input type="hidden" name="product_data[bundle]" value="N" />
	<input type="checkbox" name="product_data[bundle]" id="bundle" value="Y" {if $product_data.bundle == "Y"}checked="checked"{/if} class="checkbox" />
</div>

</fieldset>