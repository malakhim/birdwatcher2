<fieldset>

{include file="common_templates/subheader.tpl" title=$lang.international_settings}

<div class="form-field">
	<label for="ship_sp_ur_additional_insurance">{$lang.ship_sp_ur_additional_insurance}:</label>
	<input type="hidden" name="shipping_data[params][ur_additional_insurance]" value="N" />
	<input id="ship_sp_ur_additional_insurance" type="checkbox" name="shipping_data[params][ur_additional_insurance]" value="Y" {if $shipping.params.ur_additional_insurance == "Y"}checked="checked"{/if} class="checkbox" />
</div>

<div class="form-field">
	<label for="ship_sp_l_registered_mail">{$lang.ship_sp_l_registered_mail}:</label>
	<input type="hidden" name="shipping_data[params][l_registered_mail]" value="N" />
	<input id="ship_sp_l_registered_mail" type="checkbox" name="shipping_data[params][l_registered_mail]" value="Y" {if $shipping.params.l_registered_mail == "Y"}checked="checked"{/if} class="checkbox" />
</div>

<div class="form-field">
	<label for="ship_sp_l_acknowledgement_of_delivery">{$lang.ship_sp_l_acknowledgement_of_delivery}:</label>
	<input type="hidden" name="shipping_data[params][l_acknowledgement_of_delivery]" value="N" />
	<input id="ship_sp_l_acknowledgement_of_delivery" type="checkbox" name="shipping_data[params][l_acknowledgement_of_delivery]" value="Y" {if $shipping.params.l_acknowledgement_of_delivery == "Y"}checked="checked"{/if} class="checkbox" />
</div>

<div class="form-field">
	<label for="ship_sp_l_personal_delivery">{$lang.ship_sp_l_personal_delivery}:</label>
	<input type="hidden" name="shipping_data[params][l_personal_delivery]" value="N" />
	<input id="ship_sp_l_personal_delivery" type="checkbox" name="shipping_data[params][l_personal_delivery]" value="Y" {if $shipping.params.l_personal_delivery == "Y"}checked="checked"{/if} class="checkbox" />
</div>

<div class="form-field">
	<label for="ship_sp_l_cash_on_delivery">{$lang.ship_sp_l_cash_on_delivery}:</label>
	<input type="hidden" name="shipping_data[params][l_cash_on_delivery]" value="N" />
	<input id="ship_sp_l_cash_on_delivery" type="checkbox" name="shipping_data[params][l_cash_on_delivery]" value="Y" {if $shipping.params.l_cash_on_delivery == "Y"}checked="checked"{/if} class="checkbox" />
</div>

<div class="form-field">
	<label for="ship_sp_pp_additional_insurance">{$lang.ship_sp_pp_additional_insurance}:</label>
	<input type="hidden" name="shipping_data[params][pp_additional_insurance]" value="N" />
	<input id="ship_sp_pp_additional_insurance" type="checkbox" name="shipping_data[params][pp_additional_insurance]" value="Y" {if $shipping.params.pp_additional_insurance == "Y"}checked="checked"{/if} class="checkbox" />
</div>

<div class="form-field">
	<label for="ship_sp_pp_bulky_goods">{$lang.ship_sp_pp_bulky_goods}:</label>
	<input type="hidden" name="shipping_data[params][pp_bulky_goods]" value="N" />
	<input id="ship_sp_pp_bulky_goods" type="checkbox" name="shipping_data[params][pp_bulky_goods]" value="Y" {if $shipping.params.pp_bulky_goods == "Y"}checked="checked"{/if} class="checkbox" />
</div>

<div class="form-field">
	<label for="ship_sp_pp_cash_on_delivery">{$lang.ship_sp_pp_cash_on_delivery}:</label>
	<input type="hidden" name="shipping_data[params][pp_cash_on_delivery]" value="N" />
	<input id="ship_sp_pp_cash_on_delivery" type="checkbox" name="shipping_data[params][pp_cash_on_delivery]" value="Y" {if $shipping.params.pp_cash_on_delivery == "Y"}checked="checked"{/if} class="checkbox" />
</div>

<div class="form-field">
	<label for="ship_sp_pp_manual_processing">{$lang.ship_sp_pp_manual_processing}:</label>
	<input type="hidden" name="shipping_data[params][pp_manual_processing]" value="N" />
	<input id="ship_sp_pp_manual_processing" type="checkbox" name="shipping_data[params][pp_manual_processing]" value="Y" {if $shipping.params.pp_manual_processing == "Y"}checked="checked"{/if} class="checkbox" />
</div>

{include file="common_templates/subheader.tpl" title=$lang.private_customer_settings}

<div class="form-field">
	<label for="ship_sp_pc_manual_handling">{$lang.ship_sp_pc_manual_handling}:</label>
	<input type="hidden" name="shipping_data[params][pc_manual_handling]" value="N" />
	<input id="ship_sp_pc_manual_handling" type="checkbox" name="shipping_data[params][pc_manual_handling]" value="Y" {if $shipping.params.pc_manual_handling == "Y"}checked="checked"{/if} class="checkbox" />
</div>

<div class="form-field">
	<label for="ship_sp_pc_fragile">{$lang.ship_sp_pc_fragile}:</label>
	<input type="hidden" name="shipping_data[params][pc_fragile]" value="N" />
	<input id="ship_sp_pc_fragile" type="checkbox" name="shipping_data[params][pc_fragile]" value="Y" {if $shipping.params.pc_fragile == "Y"}checked="checked"{/if} class="checkbox" />
</div>

<div class="form-field">
	<label for="ship_sp_pc_signature">{$lang.ship_sp_pc_signature}:</label>
	<input type="hidden" name="shipping_data[params][pc_signature]" value="N" />
	<input id="ship_sp_pc_signature" type="checkbox" name="shipping_data[params][pc_signature]" value="Y" {if $shipping.params.pc_signature == "Y"}checked="checked"{/if} class="checkbox" />
</div>

<div class="form-field">
	<label for="ship_sp_pc_assurance">{$lang.ship_sp_pc_assurance}:</label>
	<input type="hidden" name="shipping_data[params][pc_assurance]" value="N" />
	<input id="ship_sp_pc_assurance" type="checkbox" name="shipping_data[params][pc_assurance]" value="Y" {if $shipping.params.pc_assurance == "Y"}checked="checked"{/if} class="checkbox" />
</div>

<div class="form-field">
	<label for="ship_sp_pc_personal">{$lang.ship_sp_pc_personal}:</label>
	<input type="hidden" name="shipping_data[params][pc_personal]" value="N" />
	<input id="ship_sp_pc_personal" type="checkbox" name="shipping_data[params][pc_personal]" value="Y" {if $shipping.params.pc_personal == "Y"}checked="checked"{/if} class="checkbox" />
</div>

<div class="form-field">
	<label for="ship_sp_pc_cash_on_delivery">{$lang.ship_sp_pc_cash_on_delivery}:</label>
	<input type="hidden" name="shipping_data[params][pc_cash_on_delivery]" value="N" />
	<input id="ship_sp_pc_cash_on_delivery" type="checkbox" name="shipping_data[params][pc_cash_on_delivery]" value="Y" {if $shipping.params.pc_cash_on_delivery == "Y"}checked="checked"{/if} class="checkbox" />
</div>

<div class="form-field">
	<label for="max_weight">{$lang.max_box_weight}:</label>
	<input id="max_weight" type="text" name="shipping_data[params][max_weight_of_box]" size="30" value="{$shipping.params.max_weight_of_box|default:0}" class="input-text" />
</div>

</fieldset>