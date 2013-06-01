<fieldset>

{"UPS"|fn_get_curl_info}

<div class="form-field">
	<label for="ship_ups_access_key">{$lang.ship_ups_access_key}:</label>
	<input id="ship_ups_access_key" type="text" name="shipping_data[params][access_key]" size="30" value="{$shipping.params.access_key}" class="input-text" />
</div>

<div class="form-field">
	<label for="username">{$lang.username}:</label>
	<input id="username" type="text" name="shipping_data[params][username]" size="30" value="{$shipping.params.username}" class="input-text" />
</div>

<div class="form-field">
	<label for="password">{$lang.password}:</label>
	<input id="password" type="text" name="shipping_data[params][password]" size="30" value="{$shipping.params.password}" class="input-text" />
</div>

<div class="form-field">
	<label for="sw_negotiated_rates">{$lang.use_negotiated_rates}:</label>
	<input type="hidden" name="shipping_data[params][negotiated_rates]" value="N" />
	<input id="sw_negotiated_rates" type="checkbox" name="shipping_data[params][negotiated_rates]" value="Y" {if $shipping.params.negotiated_rates == "Y"}checked="checked"{/if} class="checkbox cm-combination" />
</div>

<div id="negotiated_rates" class="{if $shipping.params.negotiated_rates != "Y"}hidden{/if}">
	<div class="form-field">
		<label for="shipper_number">{$lang.shipper_number}:</label>
		<input id="shipper_number" type="text" name="shipping_data[params][shipper_number]" size="30" value="{$shipping.params.shipper_number}" class="input-text" />
	</div>
</div>

<div class="form-field">
	<label for="test_mode">{$lang.test_mode}:</label>
	<input type="hidden" name="shipping_data[params][test_mode]" value="N" />
	<input id="test_mode" type="checkbox" name="shipping_data[params][test_mode]" value="Y" {if $shipping.params.test_mode == "Y"}checked="checked"{/if} class="checkbox" />
</div>

<div class="form-field">
	<label for="ship_ups_pickup_type">{$lang.ship_ups_pickup_type}:</label>
	<select id="ship_ups_pickup_type" name="shipping_data[params][pickup_type]">
		<option value="01" {if $shipping.params.pickup_type == "01"}selected="selected"{/if}>{$lang.ship_ups_pickup_type_01}</option>
		<option value="03" {if $shipping.params.pickup_type == "03"}selected="selected"{/if}>{$lang.ship_ups_pickup_type_03}</option>
		<option value="06" {if $shipping.params.pickup_type == "06"}selected="selected"{/if}>{$lang.ship_ups_pickup_type_06}</option>
		<option value="07" {if $shipping.params.pickup_type == "07"}selected="selected"{/if}>{$lang.ship_ups_pickup_type_07}</option>
		<option value="11" {if $shipping.params.pickup_type == "11"}selected="selected"{/if}>{$lang.ship_ups_pickup_type_11}</option>
		<option value="19" {if $shipping.params.pickup_type == "19"}selected="selected"{/if}>{$lang.ship_ups_pickup_type_19}</option>
		<option value="20" {if $shipping.params.pickup_type == "20"}selected="selected"{/if}>{$lang.ship_ups_pickup_type_20}</option>
	</select>
</div>

<div class="form-field">
	<label for="package_type">{$lang.package_type}:</label>
	<select id="package_type" name="shipping_data[params][package_type]">
		<option value="01" {if $shipping.params.package_type == "01"}selected="selected"{/if}>{$lang.ship_ups_package_type_01}</option>
		<option value="02" {if $shipping.params.package_type == "02"}selected="selected"{/if}>{$lang.package}</option>
		<option value="03" {if $shipping.params.package_type == "03"}selected="selected"{/if}>{$lang.ship_ups_package_type_03}</option>
		<option value="04" {if $shipping.params.package_type == "04"}selected="selected"{/if}>{$lang.ship_ups_package_type_04}</option>
		<option value="21" {if $shipping.params.package_type == "21"}selected="selected"{/if}>{$lang.ship_ups_package_type_21}</option>
		<option value="24" {if $shipping.params.package_type == "24"}selected="selected"{/if}>{$lang.ship_ups_package_type_24}</option>
		<option value="25" {if $shipping.params.package_type == "25"}selected="selected"{/if}>{$lang.ship_ups_package_type_25}</option>
	</select>
</div>

<div class="form-field">
	<label for="max_weight">{$lang.max_box_weight}:</label>
	<input id="max_weight" type="text" name="shipping_data[params][max_weight_of_box]" size="30" value="{$shipping.params.max_weight_of_box|default:0}" class="input-text" />
</div>

<div class="form-field">
	<label for="width">{$lang.width}:</label>
	<input id="width" type="text" name="shipping_data[params][width]" size="30" value="{$shipping.params.width}" class="input-text" />
</div>

<div class="form-field">
	<label for="height">{$lang.height}:</label>
	<input id="height" type="text" name="shipping_data[params][height]" size="30" value="{$shipping.params.height}" class="input-text" />
</div>

<div class="form-field">
	<label for="length">{$lang.length}:</label>
	<input id="length" type="text" name="shipping_data[params][length]" size="30" value="{$shipping.params.length}" class="input-text" />
</div>

</fieldset>