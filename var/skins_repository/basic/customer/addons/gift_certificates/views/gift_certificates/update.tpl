<script type="text/javascript">
//<![CDATA[
lang.no_products_defined = '{$lang.text_no_products_defined|escape:"javascript"}';
{literal}
function fn_form_pre_gift_certificates_form()
{
	var max = parseInt((parseFloat(max_amount) / parseFloat(currencies.secondary.coefficient))*100)/100;
	var min = parseInt((parseFloat(min_amount) / parseFloat(currencies.secondary.coefficient))*100)/100;
	var amount_field = $('#gift_cert_amount');
	var alert_msg = '';
	var is_valid = false;
	
	// check if value is valid number
	if (isNaN(amount_field.val())) {
		is_valid = false;
		alert_msg = nan_alert;
	} else {
		var amount = parseFloat(amount_field.val());
		// check if value is correct
		is_valid = ((amount <= max) && (amount >= min)) ? true : false;
		alert_msg = amount_alert;
	}
	
	if(!is_valid){
		amount_field.addClass('cm-failed-field');
		fn_alert(alert_msg);
	}else{
		amount_field.removeClass('cm-failed-field');
	}

	return is_valid;
	
}
{/literal}
$(function(){$ldelim}
    {if $gift_cert_data.send_via == "P"}
        $('#email_block').switchAvailability();
    {else}
        $('#post_block').switchAvailability();
    {/if}

    $('input#send_via_post').live('click', function() {$ldelim}
        $('#email_block').switchAvailability(true); $('#post_block').switchAvailability(false);
    {$rdelim});
    $('input#send_via_email').live('click', function() {$ldelim}
        $('#post_block').switchAvailability(true); $('#email_block').switchAvailability(false);
	{$rdelim});
{$rdelim});
//]]>
</script>
{assign var="min_amount" value=$addons.gift_certificates.min_amount|escape:javascript|fn_format_rate_value:"":$currencies.$secondary_currency.decimals:$currencies.$secondary_currency.decimals_separator:$currencies.$secondary_currency.thousands_separator:$currencies.$secondary_currency.coefficient}
{assign var="max_amount" value=$addons.gift_certificates.max_amount|escape:javascript|fn_format_rate_value:"":$currencies.$secondary_currency.decimals:$currencies.$secondary_currency.decimals_separator:$currencies.$secondary_currency.thousands_separator:$currencies.$secondary_currency.coefficient}

{include file="views/profiles/components/profiles_scripts.tpl"}

<script type="text/javascript">
//<![CDATA[
var text_no_products = '{$lang.text_no_products_defined}';
var max_amount = '{$addons.gift_certificates.max_amount|escape:javascript}';
var min_amount = '{$addons.gift_certificates.min_amount|escape:javascript}';
var amount_alert = '{$lang.text_gift_cert_amount_higher|escape:javascript} {$max_amount|escape:javascript} {$lang.text_gift_cert_amount_less|escape:javascript} {$min_amount|escape:javascript}';
var nan_alert = '{$lang.text_gift_cert_amount_nan}';
//]]>
</script>
{script src="js/profiles_scripts.js"}

{** Gift certificates section **}
<div class="gift form-wrap">
	<div class="form-wrap-l"></div>
	<div class="form-wrap-r"></div>

<form {if $settings.DHTML.ajax_add_to_cart == "Y" && !$no_ajax && $mode != "update"}class="cm-ajax cm-ajax-full-render" {/if}action="{""|fn_url}" method="post" target="_self" name="gift_certificates_form">
{if $mode == "update"}
<input type="hidden" name="gift_cert_id" value="{$gift_cert_id}" />
<input type="hidden" name="type" value="{$type}" />
{/if}

<div class="form-field">
	<label for="gift_cert_recipient" class="cm-required">{$lang.recipients_name}</label>
	<input type="text" id="gift_cert_recipient" name="gift_cert_data[recipient]" class="input-text" size="50" maxlength="255" value="{$gift_cert_data.recipient}" />
</div>

<div class="form-field">
	<label for="gift_cert_sender" class="cm-required">{$lang.purchasers_name}</label>
	<input type="text" id="gift_cert_sender" name="gift_cert_data[sender]" class="input-text" size="50" maxlength="255" value="{$gift_cert_data.sender}" />
</div>

<div class="form-field">
	<label for="radio_at" class="cm-required">{$lang.amount}</label>
	<input type="text" id="gift_cert_amount" name="gift_cert_data[amount]" class="valign input-text-short inp-el" size="5" value="{if $gift_cert_data}{$gift_cert_data.amount|fn_format_rate_value:"":$currencies.$secondary_currency.decimals:".":"":$currencies.$secondary_currency.coefficient}{else}{$addons.gift_certificates.min_amount|fn_format_rate_value:"":$currencies.$secondary_currency.decimals:".":"":$currencies.$secondary_currency.coefficient}{/if}" />
	<span class="valign">{$currencies.$secondary_currency.symbol|unescape}</span>
	<p class="form-field-desc">{$lang.text_gift_cert_amount_higher} {$addons.gift_certificates.max_amount}{$currencies.$secondary_currency.symbol|unescape} {$lang.text_gift_cert_amount_less} {$addons.gift_certificates.min_amount}{$currencies.$secondary_currency.symbol|unescape}</p>
</div>

<div class="form-field">
	<label for="gift_cert_message">{$lang.gift_comment}</label>
	<textarea id="gift_cert_message" name="gift_cert_data[message]" cols="72" rows="4" class="input-textarea" {if $is_text == "Y"}readonly="readonly"{/if}>{$gift_cert_data.message}</textarea>
</div>

<div class="form-field product-options">
	{if $addons.gift_certificates.free_products_allow == "Y"}
		<div class="info-field-body ">
		{include file="pickers/products_picker.tpl" data_id="free_products" item_ids=$gift_cert_data.products input_name="gift_cert_data[products]" type="table" no_item_text=$lang.text_no_products_defined holder_name="gift_certificates" but_role="text" but_text=$lang.gift_add_products no_container = true }
		</div>
	{/if}
</div>

<div class="gift-send">
	<div class="gift-send-left">
		<input type="radio" name="gift_cert_data[send_via]" value="E" {if $mode == "add" || $gift_cert_data.send_via == "E"}checked="checked"{/if} class="radio" id="send_via_email" /><label for="send_via_email" class="valign">{$lang.send_via_email}</label>
	</div>
	<div class="gift-send-left">
		<input type="radio" name="gift_cert_data[send_via]" value="P" {if $gift_cert_data.send_via == "P"}checked="checked"{/if} class="valign radio" id="send_via_post" /><label for="send_via_post" class="radio">{$lang.send_via_postal_mail}</label>
	</div>
	<h2 class="gift-send-right">{$lang.how_to_send}</h2>
</div>

<div class="info-field-body" id="email_block">
	<div class="form-field">
		<label for="gift_cert_email" class="cm-required cm-email">{$lang.email}</label>
		<input type="text" id="gift_cert_email" name="gift_cert_data[email]" class="input-text" size="40" maxlength="128" value="{$gift_cert_data.email}" />
	</div>
	<div class="form-field">
		{if $templates|sizeof > 1}
			<label for="gift_cert_template">{$lang.template}</label>
			<select id="gift_cert_template" name="gift_cert_data[template]">
			{foreach from=$templates item="name" key="file"}
				<option value="{$file}" {if $file == $gift_cert_data.template}selected{/if}>{$name}</option>
			{/foreach}
			</select>
		{else}
			{foreach from=$templates item="name" key="file"}
				<input id="gift_cert_template" type="hidden" name="gift_cert_data[template]" value="{$file}" />
			{/foreach}
		{/if}
	</div>
</div>

<div class="info-field-body" id="post_block">
	
	<div class="form-field">
		<label for="gift_cert_phone">{$lang.phone}</label>
		<input type="text" id="gift_cert_phone" name="gift_cert_data[phone]" class="input-text" size="50" value="{$gift_cert_data.phone}" />
	</div>

	<div class="form-field">
		<label for="gift_cert_address" class="cm-required">{$lang.address}</label>
		<input type="text" id="gift_cert_address" name="gift_cert_data[address]" class="input-text" size="50" value="{$gift_cert_data.address}" />
	</div>

	<div class="form-field address_2">
		<input type="text" id="gift_cert_address_2" name="gift_cert_data[address_2]" class="input-text" size="50" value="{$gift_cert_data.address_2}" />
	</div>

	<div class="form-field">
		<label for="gift_cert_city" class="cm-required">{$lang.city}</label>
		<input type="text" id="gift_cert_city" name="gift_cert_data[city]" class="input-text" size="50" value="{$gift_cert_data.city}" />
	</div>

	<div class="form-field float-left country">
		<label for="gift_cert_country" class="cm-required cm-country cm-location-billing">{$lang.country}</label>
		{assign var="_country" value=$gift_cert_data.country|default:$settings.General.default_country}
		<select id="gift_cert_country" name="gift_cert_data[country]" class="cm-location-billing" >
			<option value="">- {$lang.select_country} -</option>
			{foreach from=$countries item=country}
			<option {if $_country == $country.code}selected="selected"{/if} value="{$country.code}">{$country.country}</option>
			{/foreach}
		</select>
	</div>

	<div class="form-field float-right state">
		<label for="gift_cert_state" class="cm-required cm-state cm-location-billing">{$lang.state}</label>
		<input type="text" id="gift_cert_state_d" name="gift_cert_data[state]" class="input-text hidden" size="50" maxlength="64" value="{$value}" disabled="disabled"  />
		<select id="gift_cert_state" name="gift_cert_data[state]">
			<option value="">- {$lang.select_state} -</option>
			{if $states}
				{foreach from=$states.$_country item=state}
					<option value="{$state.code}">{$state.state}</option>
				{/foreach}
			{/if}
		</select>
		<input type="hidden" id="gift_cert_state_default" value="{$gift_cert_data.state|default:$settings.General.default_state}" />
	</div>

	<div class="form-field zipcode">
		<label for="gift_cert_zipcode" class="cm-required">{$lang.zip_postal_code}</label>
		<input type="text" id="gift_cert_zipcode" name="gift_cert_data[zipcode]" class="input-text input-text-short" size="50" value="{$gift_cert_data.zipcode}" />
	</div>

</div>

<div class="buttons-container">

{if $mode == "add"}
<input type="hidden" name="result_ids" value="cart_status*,wish_list*,account_info*" />
<input type="hidden" name="redirect_url" value="{$config.current_url}" />
	{hook name="gift_certificates:buttons"}
		{include file="buttons/add_to_cart.tpl" but_name="dispatch[gift_certificates.add]" but_role="action"}
	{/hook}
{else}
	{include file="buttons/save.tpl" but_name="dispatch[gift_certificates.update]"}
{/if}
{if $templates}
	<div class="float-right">
	{include file="buttons/button.tpl" but_text=$lang.preview but_name="dispatch[gift_certificates.preview]" but_meta="cm-new-window" but_role="submit"}
	</div>
{/if}
</div>

</form>
</div>
{** / Gift certificates section **}

{capture name="mainbox_title"}{if $mode == "add"}{$lang.purchase_gift_certificate}{else}{$lang.gift_certificate}{/if}{/capture}
