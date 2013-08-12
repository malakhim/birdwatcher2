{literal}
<script type="text/javascript">
//<![CDATA[
function fn_calculate_total_shipping() {
	params = [];
	parents = $('#shipping_estimation');
	radio = $(':radio:checked', parents);

	$.each(radio, function(id, elm) {
		params.push({name: elm.name, value: elm.value});
	});

	params.push({name: $('#elm_zipcode').attr('name'), value: $('#elm_country').attr('value')});
	params.push({name: $('#elm_state').attr('name'), value: $('#elm_state').attr('value')});
	params.push({name: $('#elm_zipcode').attr('name'), value: $('#elm_zipcode').attr('value')});

	url = fn_url('checkout.shipping_estimation');

	for (i in params) {
		url += '&' + params[i]['name'] + '=' + escape(params[i]['value']);
	}

	$.ajaxRequest(url, {
		result_ids: 'shipping_estimation',
		method: 'post'
	});
}
//]]>
</script>
{/literal}
{if $location == "sidebox"}
	{assign var="prefix" value="sidebox_"}
{/if}
{if $location == "popup"}
	{assign var="buttons_class" value="hidden"}
{else}
	{assign var="buttons_class" value="buttons-container"}
{/if}
{if $additional_id}
	{assign var="class_suffix" value="-`$additional_id`"}
	{assign var="id_suffix" value="_`$additional_id`"}
{/if}

{if $location != "sidebox" && $location != "popup"}

{if $smarty.const.PRODUCT_TYPE == "MULTIVENDOR"}
	{assign var="lang_vendor_supplier" value=$lang.vendor}
{else}
	{assign var="lang_vendor_supplier" value=$lang.supplier}
{/if}

<div id="est_box{$id_suffix}" align="right">
	<div class="estimation-box" align="left">
	<h2>{$lang.calculate_shipping_cost}</h2>
	{/if}
		<div id="shipping_estimation{if $location == "sidebox"}_sidebox{/if}{$id_suffix}">

		{if !$smarty.capture.states_built}
		{include file="views/profiles/components/profiles_scripts.tpl" states=$smarty.const.CART_LANGUAGE|fn_get_all_states:false:true}
		{capture name="states_built"}Y{/capture}
		{/if}
		<script type="text/javascript">
		//<![CDATA[
		var field_groups = {$ldelim}{$rdelim};
		//]]>
		</script>

		<form class="cm-ajax" name="{$prefix}estimation_form{$id_suffix}" action="{""|fn_url}" method="post">
		{if $location == "sidebox"}<input type="hidden" name="location" value="sidebox" />{/if}
		{if $additional_id}<input type="hidden" name="additional_id" value="{$additional_id}" />{/if}
		<input type="hidden" name="result_ids" value="shipping_estimation{if $location == "sidebox"}_sidebox{/if}{$id_suffix},shipping_estimation_buttons" />
		<div class="form-field">
			<label for="{$prefix}elm_country{$id_suffix}" class="cm-country cm-location-estimation{$class_suffix}">{$lang.country}</label>
			<select id="{$prefix}elm_country{$id_suffix}" class="cm-location-estimation{$class_suffix}" name="customer_location[country]">
				<option value="">- {$lang.select_country} -</option>
				{assign var="countries" value=1|fn_get_simple_countries}
				{foreach from=$countries item=country key=ccode}
				<option value="{$ccode}" {if ($cart.user_data.s_country == $ccode) || (!$cart.user_data.s_country && $ccode == $settings.General.default_country)}selected="selected"{/if}>{if $block.properties.positions == "left" || $block.properties.positions == "right"}{$country|truncate:18}{else}{$country}{/if}</option>
				{/foreach}
			</select>
		</div>

		<div class="form-field">
			<label for="{$prefix}elm_state{$id_suffix}" class="cm-state cm-location-estimation{$class_suffix}">{$lang.state}</label>
			<input type="text" class="input-text hidden" id="{$prefix}elm_state{$id_suffix}_d" name="customer_location[state]" size="{if $location != "sidebox"}32{else}20{/if}" maxlength="64" value="{$cart.user_data.s_state}" disabled="disabled" />
			<select id="{$prefix}elm_state{$id_suffix}" name="customer_location[state]">
				<option label="" value="">- {$lang.select_state} -</option>
			</select>
			<input type="hidden" id="{$prefix}elm_state{$id_suffix}_default" value="{$cart.user_data.s_state}" />
		</div>

		<div class="form-field">
			<label for="{$prefix}elm_zipcode{$id_suffix}" {if $location == "sidebox"}class="nowrap"{/if}>{$lang.zip_postal_code}</label>
			<input type="text" class="input-text-medium" id="{$prefix}elm_zipcode{$id_suffix}" name="customer_location[zipcode]" size="{if $location != "sidebox"}25{else}20{/if}" value="{$cart.user_data.s_zipcode}" />
		</div>

		<div class="{$buttons_class}">
			{include file="buttons/button.tpl" but_text=$lang.get_rates but_name="dispatch[checkout.shipping_estimation]" but_role="text" but_id="but_get_rates"}
		</div>

		</form>

		{if $mode == "shipping_estimation" || $smarty.request.show_shippings == "Y"}
		<div class="clear"></div>
			{if !$cart.shipping_failed}
			{if $location == "popup"}
			<div class="cart-shipping-title">{$lang.select_shipping_method}</div>
			{/if}
			<form class="cm-ajax" name="{$prefix}select_shipping_form{$id_suffix}" action="{""|fn_url}" method="post">
			<input type="hidden" name="redirect_mode" value="cart" />
			<input type="hidden" name="result_ids" value="checkout_totals" />

			{hook name="checkout:shipping_estimation"}

			{if $smarty.const.PRODUCT_TYPE == "MULTIVENDOR" || ($settings.Suppliers.enable_suppliers == "Y" && $settings.Suppliers.display_shipping_methods_separately == "Y")}

			{foreach from=$suppliers key=supplier_id item=supplier name="s"}
				<p>
				<strong>{$lang.vendor}:&nbsp;</strong>{$supplier.company|default:$lang.none}
				</p>
				<ul class="bullets-list">
				{foreach from=$supplier.products item="cart_id"}
					{if $supplier_id != 0 || ($supplier_id == 0 && ($supplier.all_edp_no_shipping == true || !($cart_products.$cart_id.is_edp == "Y" && $cart_products.$cart_id.edp_shipping == "N")))}<li>{if $cart_products.$cart_id}{$cart_products.$cart_id.product|unescape}{else}{$cart.products.$cart_id.product_id|fn_get_product_name:$smarty.const.CART_LANGUAGE|escape}{/if}</li>{/if}
				{/foreach}
				</ul>

				{if $supplier.rates && !$supplier.all_edp_no_shipping}
					{foreach from=$supplier.rates key="shipping_id" item="rate"}
					<p>
						<input type="radio" class="valign" id="sh_{$supplier_id}_{$shipping_id}" name="shipping_ids[{$supplier_id}]" value="{$shipping_id}" onclick="fn_calculate_total_shipping();" {if isset($cart.shipping.$shipping_id.rates.$supplier_id)}checked="checked"{/if} /><label for="sh_{$supplier_id}_{$shipping_id}" class="valign">{$rate.name} {if $rate.delivery_time}({$rate.delivery_time}){/if} - {if $rate.rate}{include file="common_templates/price.tpl" value=$rate.rate}{if $rate.inc_tax} ({if $rate.taxed_price && $rate.taxed_price != $rate.rate}{include file="common_templates/price.tpl" value=$rate.taxed_price class="nowrap"} {/if}{$lang.inc_tax}){/if}{else}{$lang.free_shipping}{/if}</label>
					</p>
					{/foreach}

				{else}
					{if $supplier.all_edp_free_shipping || $supplier.all_free_shipping}
						<p>{$lang.free_shipping}</p>
					{else}
						<p>{$lang.no_shipping_required}</p>
					{/if}
				{/if}

			{/foreach}{* from=$suppliers *}
			<p><strong>{$lang.total}:</strong>&nbsp;{include file="common_templates/price.tpl" value=$cart.shipping_cost class="price"}</p>

			{else}{* not MVE or suppliers DISABLED*}

				{if $supplier_ids|is_array}
					{assign var="_suppliers_ids" value=","|implode:$supplier_ids}
				{elseif $supplier_ids}
					{assign var="_suppliers_ids" value=$supplier_ids}
				{else}
					{assign var="_suppliers_ids" value=""}
				{/if}

				{foreach from=$shipping_rates key="shipping_id" item="s_rate"}
				<p>
					<input type="radio" class="valign" name="shipping_ids[{$_suppliers_ids}]" value="{$shipping_id}" id="sh_{$shipping_id}" {if $cart.shipping.$shipping_id}checked="checked"{/if} /><label for="sh_{$shipping_id}" class="valign">{$s_rate.name} {if $s_rate.delivery_time}({$s_rate.delivery_time}){/if}  - {if $s_rate.rates|@array_sum}{include file="common_templates/price.tpl" value=$s_rate.rates|@array_sum}{if $s_rate.inc_tax} ({if $s_rate.taxed_price && $s_rate.taxed_price != $s_rate.rates|@array_sum}{include file="common_templates/price.tpl" value=$s_rate.taxed_price class="nowrap"} {/if}{$lang.inc_tax}){/if}{else}{$lang.free_shipping}{/if}</label>
				</p>
				{/foreach}

			{/if}
		
			{/hook}

			<div class="{$buttons_class}">
				{include file="buttons/button.tpl" but_text=$lang.select but_role="text" but_name="dispatch[checkout.update_shipping]" but_id="but_select_shipping" but_meta="cm-dialog-closer"}
			</div>

			</form>
			{else}
			<p class="error-text">
				{$lang.text_no_shipping_methods}
			</p>
			{/if}

		{/if}
		<!--shipping_estimation{if $location == "sidebox"}_sidebox{/if}{$id_suffix}--></div>
		

{if $location != "sidebox" && $location != "popup"}
	</div>
</div>
{/if}

{if $location == "popup"}
<div class="buttons-container" id="shipping_estimation_buttons">
{if $mode == "shipping_estimation" || $smarty.request.show_shippings == "Y"}
<div class="float-right rates-button">
{include file="buttons/button.tpl" but_text=$lang.recalculate_rates  but_onclick="$('#but_get_rates').click();" but_role="text" but_meta="nobg"}
</div>
{include file="buttons/button.tpl" but_text=$lang.select_shipping_method but_onclick="$('#but_select_shipping').click();"}
{else}
{include file="buttons/button.tpl" but_text=$lang.get_rates  but_onclick="$('#but_get_rates').click();"}
{/if}
{literal}
<script type="text/javascript" class="cm-ajax-force">
//<![CDATA[
$(function(){
	var se_dialog = $('#shipping_estimation_block');
	if (se_dialog.hasClass('ui-dialog-content')) {
		se_dialog.ceDialog('reload');
	}
});
//]]>
</script>
{/literal}
<!--shipping_estimation_buttons--></div>
{/if}