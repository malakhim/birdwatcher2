<fieldset>

<div class="form-field">
	<label for="ship_can_merchant_id">{$lang.ship_can_merchant_id}:</label>
	<input id="ship_can_merchant_id" type="text" name="shipping_data[params][merchant_id]" size="30" value="{$shipping.params.merchant_id}" class="input-text" />
</div>

<div class="form-field">
	<label for="max_weight">{$lang.max_box_weight}:</label>
	<input id="max_weight" type="text" name="shipping_data[params][max_weight_of_box]" size="30" value="{$shipping.params.max_weight_of_box|default:0}" class="input-text" />
</div>

<div class="form-field">
	<label for="ship_length">{$lang.ship_length}:</label>
	<input id="ship_length" type="text" name="shipping_data[params][length]" size="30" value="{$shipping.params.length}" class="input-text" />
</div>

<div class="form-field">
	<label for="ship_width">{$lang.ship_width}:</label>
	<input id="ship_width" type="text" name="shipping_data[params][width]" size="30" value="{$shipping.params.width}" class="input-text" />
</div>

<div class="form-field">
	<label for="ship_height">{$lang.ship_height}:</label>
	<input id="ship_height" type="text" name="shipping_data[params][height]" size="30" value="{$shipping.params.height}" class="input-text" />
</div>
	
</fieldset>