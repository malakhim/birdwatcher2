{literal}
<script type="text/javascript">
//<![CDATA[
function fn_calculate_total_shipping_cost() {
	params = [];
	parents = $('#shipping_rates_list');
	radio = $(':radio:checked', parents);

	$.each(radio, function(id, elm) {
		params.push({name: elm.name, value: elm.value});
	});

	url = fn_url('checkout.calculate_total_shipping_cost');

	for (i in params) {
		url += '&' + params[i]['name'] + '=' + escape(params[i]['value']);
	}

	$.ajaxRequest(url, {
		result_ids: 'shipping_rates_list',
		method: 'post'
	});
}
//]]>
</script>
{/literal}


	{if $smarty.const.PRODUCT_TYPE == "MULTIVENDOR"}
		{assign var="lang_vendor_supplier" value=$lang.vendor}
	{else}
		{assign var="lang_vendor_supplier" value=$lang.supplier}
	{/if}

	{if $show_header == true}
		{include file="common_templates/subheader.tpl" title=$lang.select_shipping_method}
	{/if}

	{if !$no_form}
	<form {if $use_ajax}class="cm-ajax"{/if} action="{""|fn_url}" method="post" name="shippings_form">
	<input type="hidden" name="redirect_mode" value="checkout" />
	{if $use_ajax}<input type="hidden" name="result_ids" value="checkout_totals,checkout_steps" />{/if}
	{/if}

	{hook name="checkout:shipping_rates"}

	{if $smarty.const.PRODUCT_TYPE == "MULTIVENDOR" || ($settings.Suppliers.enable_suppliers == "Y" && $settings.Suppliers.display_shipping_methods_separately == "Y")}
	
		{if $display == "show"}
		<div class="step-complete-wrapper">
		{/if}

		<div id="shipping_rates_list">

		{foreach from=$suppliers key=supplier_id item=supplier name="s"}
		<span class="vendor-name">{$lang_vendor_supplier}:&nbsp;{$supplier.company}</span>
		<ul class="bullets-list">
		{foreach from=$supplier.products item="cart_id"}
			{if $supplier_id != 0 || ($supplier_id == 0 && ($supplier.all_edp_no_shipping == true || !($cart_products.$cart_id.is_edp == "Y" && $cart_products.$cart_id.edp_shipping == "N")))}<li>{if $cart_products.$cart_id}{$cart_products.$cart_id.product|unescape}{else}{$cart.products.$cart_id.product_id|fn_get_product_name:$smarty.const.CART_LANGUAGE}{/if}</li>{/if}
		{/foreach}
		</ul>
		{if !$supplier.shipping_failed}
			{if $supplier.rates && !$supplier.all_edp_no_shipping}

				{if $display == "radio"}

				{foreach from=$supplier.rates key="shipping_id" item="rate"}
				<p>
					<input type="radio" class="valign" id="sh_{$supplier_id}_{$shipping_id}" name="shipping_ids[{$supplier_id}]" value="{$shipping_id}" onclick="fn_calculate_total_shipping_cost();" {if isset($cart.shipping.$shipping_id.rates.$supplier_id)}checked="checked"{/if} /><label for="sh_{$supplier_id}_{$shipping_id}" class="valign">{$rate.name} {if $rate.delivery_time}({$rate.delivery_time}){/if} - {if $rate.rate}{include file="common_templates/price.tpl" value=$rate.rate}{if $rate.inc_tax} ({if $rate.taxed_price && $rate.taxed_price != $rate.rate}{include file="common_templates/price.tpl" value=$rate.taxed_price class="nowrap"} {/if}{$lang.inc_tax}){/if}{else}{$lang.free_shipping}{/if}</label>
				</p>
				{/foreach}

				{elseif $display == "select"}

				<p>
				<select id="ssr_{$supplier_id}" name="shipping_ids[{$supplier_id}]" {if $onchange}onchange="{$onchange}"{/if}>
				{foreach from=$supplier.rates key=shipping_id item=rate}
				<option value="{$shipping_id}" {if isset($cart.shipping.$shipping_id.rates.$supplier_id)}selected="selected"{/if}>{$rate.name} {if $rate.delivery_time}({$rate.delivery_time}){/if} - {if $rate.rate}{include file="common_templates/price.tpl" value=$rate.rate}{if $rate.inc_tax} ({if $rate.taxed_price && $rate.taxed_price != $rate.rate}{include file="common_templates/price.tpl" value=$rate.taxed_price class="nowrap"} {/if}{$lang.inc_tax}){/if}{else}{$lang.free_shipping}{/if}</option>
				{/foreach}
				</select>
				</p>

				{elseif $display == "show"}

				{foreach from=$supplier.rates key=shipping_id item=rate}
				{if isset($cart.shipping.$shipping_id.rates.$supplier_id)}<p><strong>{$rate.name} {if $rate.delivery_time}({$rate.delivery_time}){/if} - {if $rate.rate}{include file="common_templates/price.tpl" value=$rate.rate}{if $rate.inc_tax} ({if $rate.taxed_price && $rate.taxed_price != $rate.rate}{include file="common_templates/price.tpl" value=$rate.taxed_price class="nowrap"} {/if}{$lang.inc_tax}){/if}{else}{$lang.free_shipping}{/if}</strong></p>{/if}
				{/foreach}

				{/if}
			{else}
				<p>{if $display == "show"}<strong>{/if}{if $supplier.all_edp_free_shipping || $supplier.all_free_shipping}{$lang.free_shipping}{else}<p>{$lang.no_shipping_required}</p>{/if}{if $display == "show"}</strong>{/if}</p>
			{/if}
		{else}
			{if $smarty.const.PRODUCT_TYPE == "MULTIVENDOR" || $smarty.const.PRODUCT_TYPE == "PROFESSIONAL"}
				{assign var="purge_undeliverable_url" value="checkout.purge_undeliverable"|fn_url}
				<p class="error-text">{if $display == "show"}<strong>{/if}{$lang.remove_undeliverable_products|replace:'<a>':"<a href=$purge_undeliverable_url>"}{if $display == "show"}</strong>{/if}</p>
			{else}
				<p class="error-text">{if $display == "show"}<strong>{/if}{$lang.text_no_shipping_methods}{if $display == "show"}</strong>{/if}</p> 
			{/if}
		{/if}
		{if $smarty.foreach.s.last}<p class="shipping-options-total">{$lang.total}:&nbsp;{include file="common_templates/price.tpl" value=$cart.shipping_cost class="price"}</p>{/if}
		{foreachelse}
		<p>
			{foreach from=$cart_products item="product"}
			{if $product.is_edp == "Y"}
				{assign var="has_edp" value="true"}
			{/if}
			{/foreach}
			{if $has_edp}{$lang.no_shipping_required}{else}{$lang.free_shipping}{/if}
		</p>
		{/foreach}

		<!--shipping_rates_list--></div>

		{if $display == "show"}
		</div>
		{/if}

	{else}{* $settings.Suppliers.display_shipping_methods_separately != "Y"  OR Suppliers disabled*}

	
		{if $supplier_ids|is_array}
			{assign var="_suppliers_ids" value=","|implode:$supplier_ids}
		{elseif $supplier_ids}
			{assign var="_suppliers_ids" value=$supplier_ids}
		{else}
			{assign var="_suppliers_ids" value=""}
		{/if}

		<div class="{if $display == "select"}overflow-hidden form-field shipping-rates{elseif $display == "radio"} shipping-rates-radio{/if}" id="shipping_rates_list" class="shipping-options">
		{if $display == "radio"}

			{foreach from=$shipping_rates key="shipping_id" item="s_rate"}
			<p>
				<input type="radio" class="valign" name="shipping_ids[{$_suppliers_ids}]" value="{$shipping_id}" id="sh_{$shipping_id}" {if $cart.shipping.$shipping_id}checked="checked"{/if} />&nbsp;<label for="sh_{$shipping_id}" class="valign">{$s_rate.name} {if $s_rate.delivery_time}({$s_rate.delivery_time}){/if}  - {if $s_rate.rates|@array_sum}{include file="common_templates/price.tpl" value=$s_rate.rates|@array_sum}{if $s_rate.inc_tax} ({if $s_rate.taxed_price && $s_rate.taxed_price != $s_rate.rates|@array_sum}{include file="common_templates/price.tpl" value=$s_rate.taxed_price class="nowrap"} {/if}{$lang.inc_tax}){/if}{else}{$lang.free_shipping}{/if}</label>
			</p>
			{foreachelse}
				<p>
					{foreach from=$cart_products item="product"}
						{if $product.is_edp == "Y"}
							{assign var="has_edp" value="true"}
						{/if}
					{/foreach}
					{if $has_edp}{$lang.no_shipping_required}{else}{$lang.free_shipping}{/if}
				</p>
			{/foreach}
			
		{elseif $display == "select"}

			<label for="ssr">{$lang.shipping_method}:</label>
	
			<select id="ssr" name="shipping_ids[{$_suppliers_ids}]">
			{foreach from=$shipping_rates key="shipping_id" item="s_rate"}
				<option value="{$shipping_id}" {if $cart.shipping.$shipping_id}selected="selected"{/if}>{$s_rate.name} {if $s_rate.delivery_time}({$s_rate.delivery_time}){/if}  - {if $s_rate.rates|@array_sum}{include file="common_templates/price.tpl" value=$s_rate.rates|@array_sum}{else}{$lang.free_shipping}{/if}</option>
			{/foreach}
			</select>

		{elseif $display == "show"}

			{foreach from=$shipping_rates key="shipping_id" item="s_rate"}
				{if $cart.shipping.$shipping_id}
					{capture name="selected_shipping"}
						{$s_rate.name} {if $s_rate.delivery_time}({$s_rate.delivery_time}){/if}  - {if $s_rate.rates|@array_sum}{include file="common_templates/price.tpl" value=$s_rate.rates|@array_sum}{else}{$lang.free_shipping}{/if}
					{/capture}
				{/if}
			{/foreach}
			{$smarty.capture.selected_shipping}
		{/if}

		<!--shipping_rates_list--></div>

	
	{/if}{* $settings.Suppliers.display_shipping_methods_separately === "Y" *}

	{/hook}

	{if !$no_form}
	<div class="cm-noscript buttons-container center">{include file="buttons/button.tpl" but_name="dispatch[checkout.update_shipping]" but_text=$lang.select}</div>

	</form>
	{/if}

