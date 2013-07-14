<fieldset>

<div class="form-field">
	<label for="ship_dhl_system_id">{$lang.ship_dhl_system_id}:</label>
	<input id="ship_dhl_system_id" type="text" name="shipping_data[params][system_id]" size="30" value="{$shipping.params.system_id}" class="input-text" />
</div>

<div class="form-field">
	<label for="password">{$lang.password}:</label>
	<input id="password" type="text" name="shipping_data[params][password]" size="30" value="{$shipping.params.password}" class="input-text" />

</div>

<div class="form-field">
	<label for="account_number">{$lang.account_number}:</label>
	<input id="account_number" type="text" name="shipping_data[params][account_number]" size="30" value="{$shipping.params.account_number}" class="input-text" />
</div>

<div class="form-field">
	<label for="ship_dhl_ship_key">{$lang.ship_dhl_ship_key}:</label>
	<input id="ship_dhl_ship_key" type="text" name="shipping_data[params][ship_key]" size="30" value="{$shipping.params.ship_key}" class="input-text" />
</div>

<div class="form-field">
	<label for="ship_dhl_intl_ship_key">{$lang.ship_dhl_intl_ship_key}:</label>
	<input id="ship_dhl_intl_ship_key" type="text" name="shipping_data[params][intl_ship_key]" size="30" value="{$shipping.params.intl_ship_key}" class="input-text" />
</div>

<div class="form-field">
	<label for="test_mode">{$lang.test_mode}:</label>
	<input type="hidden" name="shipping_data[params][test_mode]" value="N" />
	<input id="test_mode" type="checkbox" name="shipping_data[params][test_mode]" value="Y" {if $shipping.params.test_mode == "Y"}checked="checked"{/if} class="checkbox" />
</div>

<div class="form-field">
	<label for="max_weight">{$lang.max_box_weight}:</label>
	<input id="max_weight" type="text" name="shipping_data[params][max_weight_of_box]" size="30" value="{$shipping.params.max_weight_of_box|default:0}" class="input-text" />
</div>

<div class="form-field">
	<label for="ship_dhl_length">{$lang.ship_dhl_length}:</label>
	<input id="ship_dhl_length" type="text" name="shipping_data[params][length]" size="30" value="{$shipping.params.length}" class="input-text" />
</div>

<div class="form-field">
	<label for="ship_dhl_width">{$lang.ship_dhl_width}:</label>
	<input id="ship_dhl_width" type="text" name="shipping_data[params][width]" size="30" value="{$shipping.params.width}" class="input-text" />
</div>

<div class="form-field">
	<label for="ship_dhl_height">{$lang.ship_dhl_height}:</label>
	<input id="ship_dhl_height" type="text" name="shipping_data[params][height]" size="30" value="{$shipping.params.height}" class="input-text" />
</div>

<div class="form-field">
	<label for="ship_dhl_shipment_type">{$lang.ship_dhl_shipment_type}:</label>
	<select id="ship_dhl_shipment_type" name="shipping_data[params][shipment_type]">
		<option value="L" {if $shipping.params.shipment_type == "L"}selected="selected"{/if}>{$lang.letter}</option>
		<option value="P" {if $shipping.params.shipment_type == "P"}selected="selected"{/if}>{$lang.package}</option>
	</select>
</div>

<div class="form-field">
	<label for="ship_dhl_additional_protection">{$lang.ship_dhl_additional_protection}:</label>
	<select id="ship_dhl_additional_protection" name="shipping_data[params][additional_protection]">
		<option value="NR" {if $shipping.params.additional_protection == "NR"}selected="selected"{/if}>{$lang.ship_dhl_additional_protection_nr}</option>
		<option value="AP" {if $shipping.params.additional_protection == "AP"}selected="selected"{/if}>{$lang.ship_dhl_additional_protection_ap}</option>
	</select>
</div>

<div class="form-field">
	<label for="ship_dhl_ship_hazardous">{$lang.ship_dhl_ship_hazardous}:</label>
	<input type="hidden" name="shipping_data[params][ship_hazardous]" value="N" />
	<input id="ship_dhl_ship_hazardous" type="checkbox" name="shipping_data[params][ship_hazardous]" value="Y" {if $shipping.params.ship_hazardous == "Y"}checked="checked"{/if} class="checkbox" />
</div>

{include file="common_templates/subheader.tpl" title=$lang.cash_on_delivery}

<div class="form-field">
	<label for="ship_dhl_cod_payment">{$lang.ship_dhl_cod_payment}:</label>
	<input type="hidden" name="shipping_data[params][cod_payment]" value="N" />
	<input id="ship_dhl_cod_payment" type="checkbox" name="shipping_data[params][cod_payment]" value="Y" {if $shipping.params.cod_payment == "Y"}checked="checked"{/if} class="checkbox" />
</div>

<div class="form-field">
	<label for="ship_dhl_cod_method">{$lang.ship_dhl_cod_method}:</label>
	<select id="ship_dhl_cod_method" name="shipping_data[params][cod_method]">
		<option value="M" {if $shipping.params.cod_method == "M"}selected="selected"{/if}>{$lang.ship_dhl_cod_method_m}</option>
		<option value="P" {if $shipping.params.cod_method == "P"}selected="selected"{/if}>{$lang.ship_dhl_cod_method_p}</option>
	</select>
</div>

<div class="form-field">
	<label for="ship_dhl_cod_value">{$lang.ship_dhl_cod_value}:</label>
	<input id="ship_dhl_cod_value" type="text" name="shipping_data[params][cod_value]" size="30" value="{$shipping.params.cod_value}" class="input-text" />
</div>

</fieldset>