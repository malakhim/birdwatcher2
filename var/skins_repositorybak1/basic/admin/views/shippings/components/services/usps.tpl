<fieldset>

{include file="common_templates/subheader.tpl" title=$lang.general_info}

<div class="form-field">
	<label for="ship_usps_username">{$lang.ship_usps_username}:</label>
	<input id="ship_usps_username" type="text" name="shipping_data[params][username]" size="30" value="{$shipping.params.username}" class="input-text" />
</div>

<div class="form-field">
	<label for="test_mode">{$lang.test_mode}:</label>
	<input type="hidden" name="shipping_data[params][test_mode]" value="N" />
	<input id="test_mode" type="checkbox" name="shipping_data[params][test_mode]" value="Y" {if $shipping.params.test_mode == "Y"}checked="checked"{/if} class="checkbox" />
</div>

{include file="common_templates/subheader.tpl" title=$lang.international_usps}

<div class="form-field">
	<label for="ship_usps_mailtype">{$lang.ship_usps_mailtype}:</label>
	<select id="ship_usps_mailtype" name="shipping_data[params][mailtype]">
		<option value="Package" {if $shipping.params.mailtype == "Package"}selected="selected"{/if}>{$lang.package}</option>
		<option value="Postcards or aerogrammes" {if $shipping.params.mailtype == "Postcards or aerogrammes"}selected="selected"{/if}>{$lang.ship_usps_mailtype_postcards_or_aerogrammes}</option>
		<option value="Matter for the blind" {if $shipping.params.mailtype == "Matter for the blind"}selected="selected"{/if}>{$lang.ship_usps_mailtype_matter_for_the_blind}</option>
		<option value="Envelope" {if $shipping.params.mailtype == "Envelope"}selected="selected"{/if}>{$lang.envelope}</option>
	</select>
</div>

<div class="form-field">
	<label for="ship_usps_container">{$lang.ship_usps_container}:</label>
	<select id="ship_usps_container" name="shipping_data[params][container]">
		<option value="" {if $shipping.params.container == ""}selected="selected"{/if}>{$lang.none}</option>
		<option value="RECTANGULAR" {if $shipping.params.container == "RECTANGULAR"}selected="selected"{/if}>{$lang.ship_usps_container_priority_rectangular}</option>
		<option value="NONRECTANGULAR" {if $shipping.params.container == "NONRECTANGULAR"}selected="selected"{/if}>{$lang.ship_usps_container_priority_nonrectangular}</option>
	</select>
</div>

<div class="form-field">
	<label for="ship_usps_intl_package_width">{$lang.ship_usps_intl_package_width}:</label>
	<input id="ship_usps_intl_package_width" type="text" name="shipping_data[params][intl_package_width]" size="30" value="{$shipping.params.intl_package_width|default:0}" class="input-text" />
</div>

<div class="form-field">
	<label for="ship_usps_intl_package_length">{$lang.ship_usps_intl_package_length}:</label>
	<input id="ship_usps_intl_package_length" type="text" name="shipping_data[params][intl_package_length]" size="30" value="{$shipping.params.intl_package_length|default:0}" class="input-text" />
</div>

<div class="form-field">
	<label for="ship_usps_intl_package_height">{$lang.ship_usps_intl_package_height}:</label>
	<input id="ship_usps_intl_package_height" type="text" name="shipping_data[params][intl_package_height]" size="30" value="{$shipping.params.intl_package_height|default:0}" class="input-text" />
</div>

<div class="form-field">
	<label for="ship_usps_intl_package_girth">{$lang.ship_usps_intl_package_girth}:</label>
	<input id="ship_usps_intl_package_girth" type="text" name="shipping_data[params][intl_package_girth]" size="30" value="{$shipping.params.intl_package_girth|default:0}" class="input-text" />
</div>

<div class="form-field">
	<label for="ship_usps_intl_package_size">{$lang.ship_usps_intl_package_size}:</label>
	<select id="ship_usps_intl_package_size" name="shipping_data[params][intl_package_size]">
		<option value="REGULAR" {if $shipping.params.intl_package_size == "REGULAR"}selected="selected"{/if}>{$lang.usps_package_size_regular}</option>
		<option value="LARGE" {if $shipping.params.intl_package_size == "LARGE"}selected="selected"{/if}>{$lang.usps_package_size_large}</option>
	</select>
</div>

<div class="form-field">
	<label>{$lang.extra_services}</label>
	<div class="table-filters">
		<div class="scroll-y">
			<div class="select-field">
				<input type="hidden" name="shipping_data[params][intl_service_registered_mail]" value="N" />
				<input type="checkbox" {if $shipping.params.intl_service_registered_mail == "Y"}checked="checked"{/if} value="Y" name="shipping_data[params][intl_service_registered_mail]" id="intl_service_registered_mail" class="checkbox"><label for="intl_service_registered_mail">{$lang.usps_service_registered_mail}</label>
			</div>
			<div class="select-field">
				<input type="hidden" name="shipping_data[params][intl_service_insurance]" value="N" />
				<input type="checkbox" {if $shipping.params.intl_service_insurance == "Y"}checked="checked"{/if} value="Y" name="shipping_data[params][intl_service_insurance]" id="intl_service_insurance" class="checkbox"><label for="intl_service_insurance">{$lang.usps_service_insurance}</label>
			</div>
			<div class="select-field">
				<input type="hidden" name="shipping_data[params][intl_service_return_receipt]" value="N" />
				<input type="checkbox" {if $shipping.params.intl_service_return_receipt == "Y"}checked="checked"{/if} value="Y" name="shipping_data[params][intl_service_return_receipt]" id="intl_service_return_receipt" class="checkbox"><label for="intl_service_return_receipt">{$lang.usps_service_return_receipt}</label>
			</div>
			<div class="select-field">
				<input type="hidden" name="shipping_data[params][intl_service_pick_up_on_demand]" value="N" />
				<input type="checkbox" {if $shipping.params.intl_service_pick_up_on_demand == "Y"}checked="checked"{/if} value="Y" name="shipping_data[params][intl_service_pick_up_on_demand]" id="intl_service_pick_up_on_demand" class="checkbox"><label for="intl_service_pick_up_on_demand">{$lang.usps_service_pick_up_on_demand}</label>
			</div>
			<div class="select-field">
				<input type="hidden" name="shipping_data[params][intl_service_certificate_of_mailing]" value="N" />
				<input type="checkbox" {if $shipping.params.intl_service_certificate_of_mailing == "Y"}checked="checked"{/if} value="Y" name="shipping_data[params][intl_service_certificate_of_mailing]" id="intl_service_certificate_of_mailing" class="checkbox"><label for="intl_service_certificate_of_mailing">{$lang.usps_service_certificate_of_mailing}</label>
			</div>
            <div class="select-field">
                <input type="hidden" name="shipping_data[params][intl_service_edelivery_confirmation]" value="N" />
                <input type="checkbox" {if $shipping.params.intl_service_edelivery_confirmation == "Y"}checked="checked"{/if} value="Y" name="shipping_data[params][intl_service_edelivery_confirmation]" id="intl_service_edelivery_confirmation" class="checkbox"><label for="intl_service_edelivery_confirmation">{$lang.usps_service_edelivery_confirmation}</label>
            </div>
		</div>
	</div>
</div>

{include file="common_templates/subheader.tpl" title=$lang.domestic_usps}

<div class="form-field">
	<label for="ship_usps_package_size">{$lang.ship_usps_package_size}:</label>
	<select id="ship_usps_package_size" name="shipping_data[params][package_size]">
		<option value="Regular" {if $shipping.params.package_size == "Regular"}selected="selected"{/if}>{$lang.ship_usps_package_size_regular}</option>
		<option value="Large" {if $shipping.params.package_size == "Large"}selected="selected"{/if}>{$lang.ship_usps_package_size_large}</option>
		<option value="Oversize" {if $shipping.params.package_size == "Oversize"}selected="selected"{/if}>{$lang.ship_usps_package_size_oversize}</option>
	</select>
</div>

<div class="form-field">
	<label for="ship_usps_first_class_mail_type">{$lang.ship_usps_first_class_mail_type}:</label>
	<select id="ship_usps_first_class_mail_type" name="shipping_data[params][first_class_mail_type]">
		<option value="LETTER" {if $shipping.params.first_class_mail_type == "LETTER"}selected="selected"{/if}>{$lang.letter}</option>
		<option value="FLAT" {if $shipping.params.first_class_mail_type == "FLAT"}selected="selected"{/if}>{$lang.ship_usps_first_class_mail_type_flat}</option>
		<option value="PARCEL" {if $shipping.params.first_class_mail_type == "PARCEL"}selected="selected"{/if}>{$lang.ship_usps_first_class_mail_type_parcel}</option>
	</select>
</div>

<div class="form-field">
	<label for="ship_usps_machinable">{$lang.ship_usps_machinable}:</label>
	<select id="ship_usps_machinable" name="shipping_data[params][machinable]">
		<option value="True" {if $shipping.params.machinable == "True"}selected="selected"{/if}>{$lang.ship_usps_machinable_true}</option>
		<option value="False" {if $shipping.params.machinable == "False"}selected="selected"{/if}>{$lang.ship_usps_machinable_false}</option>
	</select>
</div>

<div class="form-field">
	<label for="ship_usps_container_priority">{$lang.ship_usps_container_priority}:</label>
	<select id="ship_usps_container_priority" name="shipping_data[params][container_priority]">
		<option value="" {if $shipping.params.container_priority == ""}selected="selected"{/if}>{$lang.none}</option>
		<option value="Flat Rate Envelope" {if $shipping.params.container_priority == "Flat Rate Envelope"}selected="selected"{/if}>{$lang.ship_usps_container_priority_flat_rate_envelope}</option>
		<option value="Flat Rate Box" {if $shipping.params.container_priority == "Flat Rate Box"}selected="selected"{/if}>{$lang.ship_usps_container_priority_flat_rate_box}</option>
		<option value="Rectangular" {if $shipping.params.container_priority == "Rectangular"}selected="selected"{/if}>{$lang.ship_usps_container_priority_rectangular}</option>
		<option value="NonRectangular" {if $shipping.params.container_priority == "NonRectangular"}selected="selected"{/if}>{$lang.ship_usps_container_priority_nonrectangular}</option>
		<option value="SM FLAT RATE BOX" {if $shipping.params.container_priority == "SM FLAT RATE BOX"}selected="selected"{/if}>{$lang.ship_usps_container_priority_sm_flat_rate_box}</option>
		<option value="MD FLAT RATE BOX" {if $shipping.params.container_priority == "MD FLAT RATE BOX"}selected="selected"{/if}>{$lang.ship_usps_container_priority_md_flat_rate_box}</option>
		<option value="LG FLAT RATE BOX" {if $shipping.params.container_priority == "LG FLAT RATE BOX"}selected="selected"{/if}>{$lang.ship_usps_container_priority_lg_flat_rate_box}</option>
		<option value="REGIONALRATEBOXA" {if $shipping.params.container_priority == "REGIONALRATEBOXA"}selected="selected"{/if}>{$lang.ship_usps_container_priority_regional_a_rate_box}</option>
		<option value="REGIONALRATEBOXB" {if $shipping.params.container_priority == "REGIONALRATEBOXB"}selected="selected"{/if}>{$lang.ship_usps_container_priority_regional_b_rate_box}</option>
		<option value="REGIONALRATEBOXC" {if $shipping.params.container_priority == "REGIONALRATEBOXC"}selected="selected"{/if}>{$lang.ship_usps_container_priority_regional_C_rate_box}</option>
	</select>
</div>

<div class="form-field">
	<label for="ship_usps_container_express">{$lang.ship_usps_container_express}:</label>
	<select id="ship_usps_container_express" name="shipping_data[params][container_express]">
		<option value="" {if $shipping.params.container_express == ""}selected="selected"{/if}>{$lang.none}</option>
		<option value="Flat Rate Envelope" {if $shipping.params.container_express == "Flat Rate Envelope"}selected="selected"{/if}>{$lang.ship_usps_container_express_flat_rate_envelope}</option>
	</select>
</div>

<p>{$lang.usps_size}</p>

<div class="form-field">
	<label for="ship_usps_priority_width">{$lang.ship_usps_priority_width}:</label>
	<input id="ship_usps_priority_width" type="text" name="shipping_data[params][priority_width]" size="30" value="{$shipping.params.priority_width}" class="input-text" />
</div>

<div class="form-field">
	<label for="ship_usps_priority_length">{$lang.ship_usps_priority_length}:</label>
	<input id="ship_usps_priority_length" type="text" name="shipping_data[params][priority_length]" size="30" value="{$shipping.params.priority_length}" class="input-text" />
</div>

<div class="form-field">
	<label for="ship_usps_priority_height">{$lang.ship_usps_priority_height}:</label>
	<input id="ship_usps_priority_height" type="text" name="shipping_data[params][priority_height]" size="30" value="{$shipping.params.priority_height}" class="input-text" />
</div>

<div class="form-field">
	<label for="ship_usps_priority_girth">{$lang.ship_usps_priority_girth}:</label>
	<input id="ship_usps_priority_girth" type="text" name="shipping_data[params][priority_girth]" size="30" value="{$shipping.params.priority_girth}" class="input-text" />
</div>

<div class="form-field">
	<label>{$lang.extra_services}</label>
	<div class="table-filters">
		<div class="scroll-y">
			<div class="select-field">
				<input type="hidden" name="shipping_data[params][domestic_service_certified]" value="N" />
				<input type="checkbox" {if $shipping.params.domestic_service_certified == "Y"}checked="checked"{/if} value="Y" name="shipping_data[params][domestic_service_certified]" id="domestic_service_certified" class="checkbox"><label for="domestic_service_certified">{$lang.usps_service_certified}</label>
			</div>
			<div class="select-field">
				<input type="hidden" name="shipping_data[params][domestic_service_insurance]" value="N" />
				<input type="checkbox" {if $shipping.params.domestic_service_insurance == "Y"}checked="checked"{/if} value="Y" name="shipping_data[params][domestic_service_insurance]" id="domestic_service_insurance" class="checkbox"><label for="domestic_service_insurance">{$lang.usps_service_insurance}</label>
			</div>
			<div class="select-field">
				<input type="hidden" name="shipping_data[params][domestic_service_registered_without_insurance]" value="N" />
				<input type="checkbox" {if $shipping.params.domestic_service_registered_without_insurance == "Y"}checked="checked"{/if} value="Y" name="shipping_data[params][domestic_service_registered_without_insurance]" id="domestic_service_registered_without_insurance" class="checkbox"><label for="domestic_service_registered_without_insurance">{$lang.usps_service_registered_without_insurance}</label>
			</div>
			<div class="select-field">
				<input type="hidden" name="shipping_data[params][domestic_service_registered_with_insurance]" value="N" />
				<input type="checkbox" {if $shipping.params.domestic_service_registered_with_insurance == "Y"}checked="checked"{/if} value="Y" name="shipping_data[params][domestic_service_registered_with_insurance]" id="domestic_service_registered_with_insurance" class="checkbox"><label for="domestic_service_registered_with_insurance">{$lang.usps_service_registered_with_insurance}</label>
			</div>
			<div class="select-field">
				<input type="hidden" name="shipping_data[params][domestic_service_collect_on_delivery]" value="N" />
				<input type="checkbox" {if $shipping.params.domestic_service_collect_on_delivery == "Y"}checked="checked"{/if} value="Y" name="shipping_data[params][domestic_service_collect_on_delivery]" id="domestic_service_collect_on_delivery" class="checkbox"><label for="domestic_service_collect_on_delivery">{$lang.usps_service_collect_on_delivery}</label>
			</div>
			<div class="select-field">
				<input type="hidden" name="shipping_data[params][domestic_service_return_receipt_for_merchandise]" value="N" />
				<input type="checkbox" {if $shipping.params.domestic_service_return_receipt_for_merchandise == "Y"}checked="checked"{/if} value="Y" name="shipping_data[params][domestic_service_return_receipt_for_merchandise]" id="domestic_service_return_receipt_for_merchandise" class="checkbox"><label for="domestic_service_return_receipt_for_merchandise">{$lang.usps_service_return_receipt_for_merchandise}</label>
			</div>
			<div class="select-field">
				<input type="hidden" name="shipping_data[params][domestic_service_return_receipt]" value="N" />
				<input type="checkbox" {if $shipping.params.domestic_service_return_receipt == "Y"}checked="checked"{/if} value="Y" name="shipping_data[params][domestic_service_return_receipt]" id="domestic_service_return_receipt" class="checkbox"><label for="domestic_service_return_receipt">{$lang.usps_service_return_receipt}</label>
			</div>
			<div class="select-field">
				<input type="hidden" name="shipping_data[params][domestic_service_certificate_of_mailing_per_individual_article]" value="N" />
				<input type="checkbox" {if $shipping.params.domestic_service_certificate_of_mailing_per_individual_article == "Y"}checked="checked"{/if} value="Y" name="shipping_data[params][domestic_service_certificate_of_mailing_per_individual_article]" id="domestic_service_certificate_of_mailing_per_individual_article" class="checkbox"><label for="domestic_service_certificate_of_mailing_per_individual_article">{$lang.usps_service_certificate_of_mailing_per_individual_article}</label>
			</div>
			<div class="select-field">
				<input type="hidden" name="shipping_data[params][domestic_service_certificate_of_mailing_for_firm_mailing_books]" value="N" />
				<input type="checkbox" {if $shipping.params.domestic_service_certificate_of_mailing_for_firm_mailing_books == "Y"}checked="checked"{/if} value="Y" name="shipping_data[params][domestic_service_certificate_of_mailing_for_firm_mailing_books]" id="domestic_service_certificate_of_mailing_for_firm_mailing_books" class="checkbox"><label for="domestic_service_certificate_of_mailing_for_firm_mailing_books">{$lang.usps_service_certificate_of_mailing_for_firm_mailing_books}</label>
			</div>
			<div class="select-field">
				<input type="hidden" name="shipping_data[params][domestic_service_express_mail_insurance]" value="N" />
				<input type="checkbox" {if $shipping.params.domestic_service_express_mail_insurance == "Y"}checked="checked"{/if} value="Y" name="shipping_data[params][domestic_service_express_mail_insurance]" id="domestic_service_express_mail_insurance" class="checkbox"><label for="domestic_service_express_mail_insurance">{$lang.usps_service_express_mail_insurance}</label>
			</div>
			<div class="select-field">
				<input type="hidden" name="shipping_data[params][domestic_service_delivery_confirmation]" value="N" />
				<input type="checkbox" {if $shipping.params.domestic_service_delivery_confirmation == "Y"}checked="checked"{/if} value="Y" name="shipping_data[params][domestic_service_delivery_confirmation]" id="domestic_service_delivery_confirmation" class="checkbox"><label for="domestic_service_delivery_confirmation">{$lang.usps_service_delivery_confirmation}</label>
			</div>
			<div class="select-field">
				<input type="hidden" name="shipping_data[params][domestic_service_signature_confirmation]" value="N" />
				<input type="checkbox" {if $shipping.params.domestic_service_signature_confirmation == "Y"}checked="checked"{/if} value="Y" name="shipping_data[params][domestic_service_signature_confirmation]" id="domestic_service_signature_confirmation" class="checkbox"><label for="domestic_service_signature_confirmation">{$lang.usps_service_signature_confirmation}</label>
			</div>
			<div class="select-field">
				<input type="hidden" name="shipping_data[params][domestic_service_return_receipt_electronic]" value="N" />
				<input type="checkbox" {if $shipping.params.domestic_service_return_receipt_electronic == "Y"}checked="checked"{/if} value="Y" name="shipping_data[params][domestic_service_return_receipt_electronic]" id="domestic_service_return_receipt_electronic" class="checkbox"><label for="domestic_service_return_receipt_electronic">{$lang.usps_service_return_receipt_electronic}</label>
			</div>
		</div>
	</div>
</div>

</fieldset>