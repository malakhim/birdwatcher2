<fieldset>

<div class="form-field">
	<label for="user_key">{$lang.authentication_key}:</label>
	<input id="user_key" type="text" name="shipping_data[params][user_key]" size="30" value="{$shipping.params.user_key}" class="input-text" />
</div>

<div class="form-field">
	<label for="user_key_password">{$lang.authentication_password}:</label>
	<input id="user_key_password" type="text" name="shipping_data[params][user_key_password]" size="30" value="{$shipping.params.user_key_password}" class="input-text" />
</div>

<div class="form-field">
	<label for="account_number">{$lang.account_number}:</label>
	<input id="account_number" type="text" name="shipping_data[params][account_number]" size="30" value="{$shipping.params.account_number}" class="input-text" />
</div>

<div class="form-field">
	<label for="ship_fedex_meter_number">{$lang.ship_fedex_meter_number}:</label>
	<input id="ship_fedex_meter_number" type="text" name="shipping_data[params][meter_number]" size="30" value="{$shipping.params.meter_number}" class="input-text" />
</div>

<div class="form-field">
	<label for="test_mode">{$lang.test_mode}:</label>
	<input type="hidden" name="shipping_data[params][test_mode]" value="N" />
	<input id="test_mode" type="checkbox" name="shipping_data[params][test_mode]" value="Y" {if $shipping.params.test_mode == "Y"}checked="checked"{/if} class="checkbox" />
</div>

<div class="form-field">
	<label for="package_type">{$lang.package_type}:</label>
	<select id="package_type" name="shipping_data[params][package_type]">
		<option value="YOUR_PACKAGING" {if $shipping.params.package_type == "YOUR_PACKAGING"}selected="selected"{/if}>{$lang.ship_fedex_package_type_your_packaging}</option>
		<option value="FEDEX_BOX" {if $shipping.params.package_type == "FEDEX_BOX"}selected="selected"{/if}>{$lang.ship_fedex_package_type_fedex_box}</option>
		<option value="FEDEX_10KG_BOX" {if $shipping.params.package_type == "FEDEX_10KG_BOX"}selected="selected"{/if}>{$lang.ship_fedex_package_type_fedex_10kg_box}</option>
		<option value="FEDEX_25KG_BOX" {if $shipping.params.package_type == "FEDEX_25KG_BOX"}selected="selected"{/if}>{$lang.ship_fedex_package_type_fedex_25kg_box}</option>
		<option value="FEDEX_ENVELOPE" {if $shipping.params.package_type == "FEDEX_ENVELOPE"}selected="selected"{/if}>{$lang.ship_fedex_package_type_fedex_envelope}</option>
		<option value="FEDEX_PAK" {if $shipping.params.package_type == "FEDEX_PAK"}selected="selected"{/if}>{$lang.ship_fedex_package_type_fedex_pak}</option>
		<option value="FEDEX_TUBE" {if $shipping.params.package_type == "FEDEX_TUBE"}selected="selected"{/if}>{$lang.ship_fedex_package_type_fedex_tube}</option>
	</select>
</div>

<div class="form-field">
	<label for="ship_fedex_drop_off_type">{$lang.ship_fedex_drop_off_type}:</label>
	<select id="ship_fedex_drop_off_type" name="shipping_data[params][drop_off_type]">
		<option value="REGULAR_PICKUP" {if $shipping.params.drop_off_type == "REGULAR_PICKUP"}selected="selected"{/if}>{$lang.ship_fedex_drop_off_type_regular_pickup}</option>
		<option value="REQUEST_COURIER" {if $shipping.params.drop_off_type == "REQUEST_COURIER"}selected="selected"{/if}>{$lang.ship_fedex_drop_off_type_request_courier}</option>
		<option value="STATION" {if $shipping.params.drop_off_type == "STATION"}selected="selected"{/if}>{$lang.ship_fedex_drop_off_type_station}</option>
	</select>
</div>

<div class="form-field">
	<label for="max_weight">{$lang.max_box_weight}:</label>
	<input id="max_weight" type="text" name="shipping_data[params][max_weight_of_box]" size="30" value="{$shipping.params.max_weight_of_box|default:0}" class="input-text" />
</div>

<div class="form-field">
	<label for="ship_fedex_height">{$lang.ship_fedex_height}:</label>
	<input id="ship_fedex_height" type="text" name="shipping_data[params][height]" size="30" value="{$shipping.params.height}" class="input-text" />
</div>

<div class="form-field">
	<label for="ship_fedex_width">{$lang.ship_fedex_width}:</label>
	<input id="ship_fedex_width" type="text" name="shipping_data[params][width]" size="30" value="{$shipping.params.width}" class="input-text" />
</div>

<div class="form-field">
	<label for="ship_fedex_length">{$lang.ship_fedex_length}:</label>
	<input id="ship_fedex_length" type="text" name="shipping_data[params][length]" size="30" value="{$shipping.params.length}" class="input-text" />
</div>

{if $code == 'SMART_POST'}
{include file="common_templates/subheader.tpl" title=$lang.ship_fedex_smart_post}

<div class="form-field">
	<label for="package_type">{$lang.ship_fedex_indicia}:</label>
	<select id="package_type" name="shipping_data[params][indicia]">
		<option value="PRESORTED_STANDARD" {if $shipping.params.indicia == "PRESORTED_STANDARD"}selected="selected"{/if}>{$lang.ship_fedex_indicia_presorted_standard}</option>
		<option value="PARCEL_SELECT" {if $shipping.params.indicia == "PARCEL_SELECT"}selected="selected"{/if}>{$lang.ship_fedex_indicia_parcel_select}</option>
		<option value="MEDIA_MAIL" {if $shipping.params.indicia == "MEDIA_MAIL"}selected="selected"{/if}>{$lang.ship_fedex_indicia_media_mail}</option>
		<option value="PRESORTED_BOUND_PRINTED_MATTER" {if $shipping.params.indicia == "PRESORTED_BOUND_PRINTED_MATTER"}selected="selected"{/if}>{$lang.ship_fedex_indicia_presorted_bound_printed_matter}</option>
	</select>
</div>

<div class="form-field">
	<label for="package_type">{$lang.ship_fedex_ancillary_endorsement}:</label>
	<select id="package_type" name="shipping_data[params][ancillary_endorsement]">
		<option value="" {if $shipping.params.ancillary_endorsement == ""}selected="selected"{/if}>{$lang.none}</option>
		<option value="ADDRESS_CORRECTION" {if $shipping.params.ancillary_endorsement == "ADDRESS_CORRECTION"}selected="selected"{/if}>{$lang.ship_fedex_ancillary_endorsement_address_correction}</option>
		<option value="CARRIER_LEAVE_IF_NO_RESPONSE" {if $shipping.params.ancillary_endorsement == "CARRIER_LEAVE_IF_NO_RESPONSE"}selected="selected"{/if}>{$lang.ship_fedex_ancillary_endorsement_carrier_leave_if_no_response}</option>
		<option value="CHANGE_SERVICE" {if $shipping.params.ancillary_endorsement == "CHANGE_SERVICE"}selected="selected"{/if}>{$lang.ship_fedex_ancillary_endorsement_change_service}</option>
		<option value="FORWARDING_SERVICE" {if $shipping.params.ancillary_endorsement == "FORWARDING_SERVICE"}selected="selected"{/if}>{$lang.ship_fedex_ancillary_endorsement_forwarding_service}</option>
		<option value="RETURN_DELIVERY" {if $shipping.params.ancillary_endorsement == "RETURN_DELIVERY"}selected="selected"{/if}>{$lang.ship_fedex_ancillary_endorsement_return_delivery}</option>
	</select>
</div>

<div class="form-field">
	<label for="test_mode">{$lang.ship_fedex_special_services}:</label>
	<input type="hidden" name="shipping_data[params][special_services]" value="N" />
	<input id="test_mode" type="checkbox" name="shipping_data[params][special_services]" value="Y" {if $shipping.params.special_services == "Y"}checked="checked"{/if} class="checkbox" />
</div>

<div class="form-field">
	<label for="ship_fedex_length">{$lang.ship_fedex_hub_id}:</label>
	<input id="ship_fedex_length" type="text" name="shipping_data[params][hub_id]" size="30" value="{$shipping.params.hub_id}" class="input-text-medium" />
</div>

<div class="form-field">
	<label for="ship_fedex_length">{$lang.ship_fedex_customer_manifest_id}:</label>
	<input id="ship_fedex_length" type="text" name="shipping_data[params][customer_manifest_id]" size="30" value="{$shipping.params.customer_manifest_id}" class="input-text-medium" />
</div>
{/if}

</fieldset>