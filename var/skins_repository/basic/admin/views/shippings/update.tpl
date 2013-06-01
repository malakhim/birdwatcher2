
{if "COMPANY_ID"|defined && $shipping.shipping_id && $shipping.company_id != $smarty.const.COMPANY_ID}
	{assign var="hide_fields" value=true}
{/if}

<script type="text/javascript">
//<![CDATA[

var shipping_id = '{$smarty.request.shipping_id}';
var selected_section = '{$smarty.request.selected_section}';
var shipping_services = [];

{foreach from=$services item="s"}
shipping_services[{$s.service_id}] = [];
shipping_services[{$s.service_id}]['module'] = '{$s.module}';
shipping_services[{$s.service_id}]['code'] = '{$s.code}';
{/foreach}
{literal}

// FIXME: For what we need this code?
/*$(function () {
	$('#content_configure').remove();
});*/
	
function fn_toggle_shipping_type(type)
{
	if (type == 'M') {
		$('#service').attr('disabled', 'disabled');
		fn_toggle_configure_tab('');
	} else {
		$('#service').removeAttr('disabled');
		fn_toggle_configure_tab($('#service').val());
	}
}

function fn_toggle_configure_tab(service_id)
{
	if (service_id) {
		var new_href = fn_url('shippings.configure?shipping_id=' + shipping_id + '&module=' + shipping_services[service_id]['module'] + '&code=' + shipping_services[service_id]['code']);
		if ($('#configure a').attr('href') != new_href) {
			$('#content_configure').remove();
			$('#configure a').attr('href', new_href);
		}
		$('#configure').show();
	} else {
		$('#configure').hide();
	}
}
{/literal}
//]]>
</script>


{capture name="mainbox"}

<form action="{""|fn_url}" method="post" id="shippings_form" name="shippings_form" enctype="multipart/form-data" class="cm-form-highlight{if $hide_fields} cm-hide-inputs{/if}">
<input type="hidden" name="shipping_id" value="{$smarty.request.shipping_id}" />

{if $mode == "update"}
{capture name="tabsbox"}
<div id="content_general">
{/if}

<fieldset>
<div class="form-field">
	<label for="ship_descr_shipping" class="cm-required">{$lang.name}:</label>
	<input type="text" name="shipping_data[shipping]" id="ship_descr_shipping" size="30" value="{$shipping.shipping}" class="input-text-large main-input" />
</div>

{if !$hide_fields}
{include file="views/companies/components/company_field.tpl" title=$lang.vendor name="shipping_data[company_id]" id="shipping_data_`$smarty.request.shipping_id`" selected=$shipping.company_id}
{/if}

<div class="form-field">
	<label>{$lang.icon}:</label>
	{include file="common_templates/attach_images.tpl" image_name="shipping" image_object_type="shipping" image_pair=$shipping.icon no_detailed="Y" hide_titles="Y" image_object_id=$smarty.request.shipping_id}
</div>

<div class="form-field">
	<label for="delivery_time">{$lang.delivery_time}:</label>
	<input type="text" name="shipping_data[delivery_time]" id="delivery_time" size="30" value="{$shipping.delivery_time}" class="input-text" />
</div>

<div class="form-field">
	<label for="min_weight">{$lang.weight_limit}&nbsp;({$settings.General.weight_symbol}):</label>
	<input type="text" name="shipping_data[min_weight]" id="min_weight" size="4" value="{$shipping.min_weight}" class="input-text" />&nbsp;-&nbsp;<input type="text" name="shipping_data[max_weight]" size="4" value="{if $shipping.max_weight != "0.00"}{$shipping.max_weight}{/if}" class="input-text" />
</div>

<div class="form-field">
	<label>{$lang.rate_calculation}:</label>
	<div class="float-left">
		<div class="select-field">
			<input type="radio" name="shipping_data[rate_calculation]" id="rate_calculation_M" value="M" {if $shipping.rate_calculation == "M" || ! $shipping.rate_calculation}checked="checked"{/if} onclick="fn_toggle_shipping_type(this.value);" class="radio" />
			<label for="rate_calculation_M">{$lang.rate_calculation_manual}</label>
		</div>
		<div class="select-field">
			<input type="radio" name="shipping_data[rate_calculation]" id="rate_calculation_R" value="R" {if $shipping.rate_calculation == "R"}checked="checked"{/if} onclick="fn_toggle_shipping_type(this.value);" class="radio" />
			<label for="rate_calculation_R">{$lang.rate_calculation_realtime}</label>
		</div>
	</div>
</div>

<div class="form-field">
	<label for="service">{$lang.shipping_service}:</label>
	<div class="float-left">
		<select name="shipping_data[service_id]" id="service" onchange="fn_toggle_configure_tab(this.value);" {if $shipping.rate_calculation == "M" || $mode == 'add'}disabled="disabled"{/if}>
			<option	value="">--</option>
			{foreach from=$services item=service}
				<option	value="{$service.service_id}" {if $shipping.service_id == $service.service_id}selected="selected"{/if}>{$service.description}</option>
			{/foreach}
		</select>
		{if !$hide_fields}
			&nbsp;&nbsp;<span>{$lang.test}</span>: &nbsp;{$lang.weight} ({$settings.General.weight_symbol})&nbsp;
			<input id="weight" type="text" class="input-text" size="3" name="weight" value="0" />
			{include file="buttons/button_popup.tpl" but_text=$lang.test but_href="shippings.test?service_id=" href_extra="document.getElementById('service').value + '&weight=' + document.getElementById('weight').value + '&shipping_id=`$smarty.request.shipping_id`' + '&' + $('#shippings_form').serialize()" width="500" height="230" scrollbars="no" toolbar="no" menubar="no" but_role="text"}
		{/if}
	</div>
</div>

<div class="form-field">
	<label for="products_tax_id">{$lang.taxes}:</label>
	<div class="select-field">
		{foreach from=$taxes item="tax"}
			<input type="checkbox"	name="shipping_data[tax_ids][{$tax.tax_id}]" id="shippings_taxes_{$tax.tax_id}" {if $tax.tax_id|in_array:$shipping.tax_ids}checked="checked"{/if} class="checkbox" value="{$tax.tax_id}" />
			<label for="shippings_taxes_{$tax.tax_id}">{$tax.tax}</label>
		{foreachelse}
			&ndash;
		{/foreach}
	</div>
</div>

{hook name="shippings:update"}
{/hook}

<div class="form-field">
	<label>{$lang.usergroups}:</label>
	<div class="select-field">
		{include file="common_templates/select_usergroups.tpl" id="ship_data_usergroup_id" name="shipping_data[usergroup_ids]" usergroups=$usergroups usergroup_ids=$shipping.usergroup_ids input_extra="" list_mode=false}
	</div>
</div>

{include file="views/localizations/components/select.tpl" data_name="shipping_data[localization]" data_from=$shipping.localization}

{include file="common_templates/select_status.tpl" input_name="shipping_data[status]" id="shipping_data" obj=$shipping}
</fieldset>

<div class="buttons-container buttons-bg">
	{if !$hide_for_vendor}
		{include file="buttons/save_cancel.tpl" but_name="dispatch[shippings.update_shipping]"}
	{else}
		{include file="buttons/save_cancel.tpl" but_name="dispatch[shippings.update_shipping]" but_role="button_main" hide_first_button=true hide_second_button=true}
	{/if}
</div>

{if $mode == "update"}
	<input type="hidden" name="selected_section" value="general" />
	<!--content_general--></div>

	<div id="content_configure">
	<!--content_configure--></div>

	<div id="content_shipping_charges">
	{include file="views/shippings/components/rates.tpl"}
	<!--content_shipping_charges--></div>

	{/capture}
	{include file="common_templates/tabsbox.tpl" content=$smarty.capture.tabsbox active_tab=$smarty.request.selected_section track=true}
{/if}

</form>

{/capture}{*mainbox*}


{if $mode == "add"}
	{assign var="title" value=$lang.new_shipping_method}
{else}
	{assign var="title" value="`$lang.editing_shipping_method`: `$shipping.shipping`"}
{/if}
{include file="common_templates/mainbox.tpl" title=$title content=$smarty.capture.mainbox select_languages=true}
