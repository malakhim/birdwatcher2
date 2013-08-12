{include file="common_templates/subheader.tpl" title=$lang.general}

<div class="form-field">
	<label for="product_weight">{$lang.weight} ({$settings.General.weight_symbol}):</label>
	<input type="text" name="product_data[weight]" id="product_weight" size="10" value="{$product_data.weight|default:"0"}" class="input-text-medium" />
</div>

<div class="form-field">
	<label for="product_free_shipping">{$lang.free_shipping}:</label>
	<input type="hidden" name="product_data[free_shipping]" value="N" />
	<input type="checkbox" name="product_data[free_shipping]" id="product_free_shipping" value="Y" {if $product_data.free_shipping == "Y"}checked="checked"{/if} class="checkbox" />
</div>

<div class="form-field">
	<label for="product_shipping_freight">{$lang.shipping_freight} ({$currencies.$primary_currency.symbol}):</label>
	<input type="text" name="product_data[shipping_freight]" id="product_shipping_freight" size="10" value="{$product_data.shipping_freight|default:"0.00"}" class="input-text-medium" />
</div>

<div class="form-field">
	<label for="product_items_in_box">{$lang.items_in_box}:</label>
	<input type="text" name="product_data[min_items_in_box]" id="product_items_in_box" size="5" value="{$product_data.min_items_in_box|default:"0"}" class="input-text" onkeyup="fn_product_shipping_settings(this);" />
	&nbsp;-&nbsp;
	<input type="text" name="product_data[max_items_in_box]" size="5" value="{$product_data.max_items_in_box|default:"0"}" class="input-text" onkeyup="fn_product_shipping_settings(this);" />
	
	{if $product_data.min_items_in_box > 0 || $product_data.max_items_in_box}
		{assign var="box_settings" value=true}
	{/if}
</div>

<div class="form-field">
	<label for="product_box_length">{$lang.box_length}:</label>
	<input type="text" name="product_data[box_length]" id="product_box_length" size="10" value="{$product_data.box_length|default:"0"}" class="input-text-medium shipping-dependence" {if !$box_settings}disabled="disabled"{/if} />
</div>

<div class="form-field">
	<label for="product_box_width">{$lang.box_width}:</label>
	<input type="text" name="product_data[box_width]" id="product_box_width" size="10" value="{$product_data.box_width|default:"0"}" class="input-text-medium shipping-dependence" {if !$box_settings}disabled="disabled"{/if} />
</div>

<div class="form-field">
	<label for="product_box_height">{$lang.box_height}:</label>
	<input type="text" name="product_data[box_height]" id="product_box_height" size="10" value="{$product_data.box_height|default:"0"}" class="input-text-medium shipping-dependence" {if !$box_settings}disabled="disabled"{/if} />
</div>

<script type="text/javascript">
//<![CDATA[
{literal}
function fn_product_shipping_settings(elm)
{
	var jelm = $(elm);
	var available = false;
	
	$('input', jelm.parent()).each(function() {
		if (parseInt($(this).val()) > 0) {
			available = true;
		}
	});
	
	$('input.shipping-dependence').attr('disabled', (available ? false : true));
	
}

{/literal}
//]]>
</script>