<fieldset>

<div class="form-field">
	<label for="max_weight">{$lang.max_box_weight}:</label>
	<input id="max_weight" type="text" name="shipping_data[params][max_weight_of_box]" size="30" value="{$shipping.params.max_weight_of_box|default:0}" class="input-text" />
</div>

<div class="form-field">
	<label for="ship_width">{$lang.ship_width}:</label>
	<input id="ship_width" type="text" name="shipping_data[params][width]" size="30" value="{$shipping.params.width}" class="input-text" />
</div>

<div class="form-field">
	<label for="ship_height">{$lang.ship_height}:</label>
	<input id="ship_height" type="text" name="shipping_data[params][height]" size="30" value="{$shipping.params.height}" class="input-text" />
</div>

<div class="form-field">
	<label for="ship_length">{$lang.ship_length}:</label>
	<input id="ship_length" type="text" name="shipping_data[params][length]" size="30" value="{$shipping.params.length}" class="input-text" />
</div>

<div class="form-field">
	<label for="ship_aup_use_delivery_confirmation">{$lang.ship_aup_use_delivery_confirmation}:</label>
	<input type="hidden" name="shipping_data[params][use_delivery_confirmation]" value="N" />
	<input id="ship_aup_use_delivery_confirmation" type="checkbox" name="shipping_data[params][use_delivery_confirmation]" value="Y" {if $shipping.params.use_delivery_confirmation == "Y"}checked="checked"{/if} class="checkbox" />
</div>

<div class="form-field">
	<label for="ship_aup_delivery_confirmation_cost">{$lang.ship_aup_delivery_confirmation_cost}:</label>
	<input id="ship_aup_delivery_confirmation_cost" type="text" name="shipping_data[params][delivery_confirmation_cost]" size="30" value="{$shipping.params.delivery_confirmation_cost}" class="input-text" />
</div>

<div class="form-field">
	<label for="ship_aup_delivery_confirmation_international_cost">{$lang.ship_aup_delivery_confirmation_international_cost}:</label>
	<input id="ship_aup_delivery_confirmation_international_cost" type="text" name="shipping_data[params][delivery_confirmation_international_cost]" size="30" value="{$shipping.params.delivery_confirmation_international_cost}" class="input-text" />
</div>

<div class="form-field">
	<label for="ship_aup_rpi_fee">{$lang.ship_aup_rpi_fee}:</label>
	<input id="ship_aup_rpi_fee" type="text" name="shipping_data[params][rpi_fee]" size="30" value="{$shipping.params.rpi_fee}" class="input-text" />
</div>

</fieldset>