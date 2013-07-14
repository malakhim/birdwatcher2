{if $gift_cert_data.gift_cert_id}
	{assign var="id" value=$gift_cert_data.gift_cert_id}
{else}
	{assign var="id" value=0}
{/if}

<script type="text/javascript">
//<![CDATA[
{literal}
function fn_form_pre_gift_certificates_form()
{
	var max = parseInt((parseFloat(max_amount) / parseFloat(currencies.secondary.coefficient))*100)/100;
	var min = parseInt((parseFloat(min_amount) / parseFloat(currencies.secondary.coefficient))*100)/100;
	var alert_msg = '';
	var is_valid = false;
	var amount_field = $('#gift_cert_amount');

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
	
	if (!is_valid){
		amount_field.addClass('cm-failed-field');
		fn_alert(alert_msg);
	} else {
		amount_field.removeClass('cm-failed-field');
	}

	return is_valid;
}
function fn_giftcert_form_elements_disable(dsbl, enbl)
{
	if(!$('form[name="gift_certificates_form"]').get(0)){
		return false;
	}
	$(':input', '#'+dsbl).attr('disabled', 'disabled');
	$(':input', '#'+enbl).removeAttr('disabled');
}
//]]>
{/literal}
</script>
{assign var="min_amount" value=$addons.gift_certificates.min_amount|escape:javascript|fn_format_rate_value:"":$currencies.$secondary_currency.decimals:$currencies.$secondary_currency.decimals_separator:$currencies.$secondary_currency.thousands_separator:$currencies.$secondary_currency.coefficient}
{assign var="max_amount" value=$addons.gift_certificates.max_amount|escape:javascript|fn_format_rate_value:"":$currencies.$secondary_currency.decimals:$currencies.$secondary_currency.decimals_separator:$currencies.$secondary_currency.thousands_separator:$currencies.$secondary_currency.coefficient}

{include file="views/profiles/components/profiles_scripts.tpl"}

<script type="text/javascript">
//<![CDATA[
lang.no_products_defined = '{$lang.text_no_products_defined|escape:"javascript"}';
var max_amount = '{$addons.gift_certificates.max_amount|escape:javascript}';
var min_amount = '{$addons.gift_certificates.min_amount|escape:javascript}';
var amount_alert = '{$lang.text_gift_cert_amount_higher|escape:javascript} {$max_amount|escape:javascript} {$lang.text_gift_cert_amount_less|escape:javascript} {$min_amount|escape:javascript}';
var nan_alert = '{$lang.text_gift_cert_amount_nan}';
//]]>
</script>

{** Gift certificates section **}

	{capture name="mainbox"}

	<form action="{""|fn_url}" method="post" target="_self" class="cm-form-highlight" name="gift_certificates_form" enctype="multipart/form-data">
	<input type="hidden" name="gift_cert_id" value="{$id}" />

	{** Page Section **}

	{if $id}
	{capture name="tabsbox"}
	<div id="content_detailed" class="hidden">
	{/if}

	{** /Page Section **}

	{notes}
		{$lang.text_gift_cert_amount_higher}&nbsp;{include file="common_templates/price.tpl" value=$addons.gift_certificates.max_amount}&nbsp;{$lang.text_gift_cert_amount_less}&nbsp;{include file="common_templates/price.tpl" value=$addons.gift_certificates.min_amount}
	{/notes}

		{if $id}
	<fieldset>
		<div class="form-field">
			<label for="gift_cert_code">{$lang.gift_cert_code}:</label>
			<input type="hidden" name="gift_cert_data[gift_cert_code]" id="gift_cert_code" value="{$gift_cert_data.gift_cert_code}" />
			<span>{$gift_cert_data.gift_cert_code}</span>
		</div>

		<div class="form-field">
			<label for="gift_cert_status">{$lang.status}:</label>
			<input type="hidden" name="certificate_status" value="{$gift_cert_data.status}" />
			{include file="common_templates/status.tpl" status=$gift_cert_data.status display="select" name="gift_cert_data[status]" status_type=$smarty.const.STATUSES_GIFT_CERTIFICATE select_id="gift_cert_status"}
		</div>
		{/if}

		{if $smarty.const.PRODUCT_TYPE == "ULTIMATE"}
			{include file="views/companies/components/company_field.tpl" title=$lang.vendor name="gift_cert_data[company_id]" selected=$gift_cert_data.company_id exclude_company_id="0" id="gift_cert_data_company_id"}
		{else}
			<input type="hidden" name="gift_cert_data[company_id]" id="company_id" value="0">
		{/if}

		<div class="form-field">
			<label for="gift_cert_recipient" class="cm-required">{$lang.gift_cert_to}:</label>
			<input type="text" id="gift_cert_recipient" name="gift_cert_data[recipient]"  class="input-text-large main-input" maxlength="255" value="{$gift_cert_data.recipient}" />
		</div>

		<div class="form-field">
			<label for="gift_cert_sender" class="cm-required">{$lang.gift_cert_from}:</label>
			<input type="text" id="gift_cert_sender" name="gift_cert_data[sender]" class="input-text-large" maxlength="255" value="{$gift_cert_data.sender}" />
		</div>

		<div class="form-field">
			<label for="gift_cert_message">{$lang.message}:</label>
			<textarea id="gift_cert_message" name="gift_cert_data[message]" cols="55" rows="6" class="cm-wysiwyg input-textarea-long">{$gift_cert_data.message}</textarea>
		</div>

		<div class="form-field">
			<label class="cm-required" for="gift_cert_amount">{$lang.amount}:</label>
			<table cellpadding="1" cellspacing="1" border="0">
				<tr>
					<td>
						<div id="input_block">
							{if $currencies.$secondary_currency.after != "Y"}{$currencies.$secondary_currency.symbol}{/if}

							<input type="text" id="gift_cert_amount" name="gift_cert_data[amount]" class="input-text inp-el" size="5" value="{if $gift_cert_data}{$gift_cert_data.amount|fn_format_rate_value:"":$currencies.$secondary_currency.decimals:".":"":$currencies.$secondary_currency.coefficient}{else}{$addons.gift_certificates.min_amount|fn_format_rate_value:"":$currencies.$secondary_currency.decimals:".":"":$currencies.$secondary_currency.coefficient}{/if}" />

							{if $currencies.$secondary_currency.after == "Y"}{$currencies.$secondary_currency.symbol}{/if}

							<p class="description">
								{$lang.text_gift_cert_amount_higher}&nbsp;{include file="common_templates/price.tpl" value=$addons.gift_certificates.max_amount}&nbsp;{$lang.text_gift_cert_amount_less}&nbsp;{include file="common_templates/price.tpl" value=$addons.gift_certificates.min_amount}
							</p>
						</div>
					</td>
				<tr>
			</table>
		</div>

		<div class="select-field">
			<input type="radio" name="gift_cert_data[send_via]" value="E" onclick="fn_giftcert_form_elements_disable('post_block', 'email_block');" {if !$id || $gift_cert_data.send_via == "E"}checked="checked"{/if} class="radio" />
			<label for="send_via">{$lang.send_via_email}</label>
		</div>

		<hr />

		<div id="email_block">
			<div class="form-field">
				<label for="gift_cert_email" class="cm-required cm-email">{$lang.email}:</label>
				<input type="text" id="gift_cert_email" name="gift_cert_data[email]" class="input-text-large" maxlength="128" value="{$gift_cert_data.email}" />
			</div>
			<div class="form-field">
				{if $templates|sizeof > 1}
					<label for="gift_cert_template">{$lang.template}:</label>
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

		<div class="select-field">
			<input type="radio" name="gift_cert_data[send_via]" value="P" onclick="fn_giftcert_form_elements_disable('email_block', 'post_block');" {if $gift_cert_data.send_via == "P"}checked="checked"{/if} class="radio" />
			<label for="gift_cert_send_via">{$lang.send_via_postal_mail}</label>
		</div>

		<hr />

		<div id="post_block">
			<div class="form-field">
				<label for="gift_cert_address" class="cm-required">{$lang.address}:</label>
				<input type="text" id="gift_cert_address" name="gift_cert_data[address]" class="input-text-large" value="{$gift_cert_data.address}"  />
			</div>

			<div class="form-field">
				<label for="gift_cert_address_2">{$lang.address_2}:</label>
				<input type="text" id="gift_cert_address_2" name="gift_cert_data[address_2]" class="input-text-large" value="{$gift_cert_data.address_2}" />
			</div>

			<div class="form-field">
				<label for="gift_cert_city" class="cm-required">{$lang.city}:</label>
				<input type="text" id="gift_cert_city" name="gift_cert_data[city]" class="input-text-large" value="{$gift_cert_data.city}" />
			</div>

			<div class="form-field">
				<label for="gift_cert_country" class="cm-required cm-country cm-location-billing">{$lang.country}:</label>
				{assign var="_country" value=$gift_cert_data.country|default:$settings.General.default_country}
				<select id="gift_cert_country" name="gift_cert_data[country]" class="input-text cm-location-billing">
					<option value="">- {$lang.select_country} -</option>
					{foreach from=$countries item=country}
						<option {if $_country == $country.code}selected="selected"{/if} value="{$country.code}">{$country.country}</option>
					{/foreach}
				</select>
			</div>

			<div class="form-field">
				<label for="gift_cert_state" class="cm-required cm-state cm-location-billing">{$lang.state}:</label>
				<input type="text" id="gift_cert_state_d" name="gift_cert_data[state]" class="input-text-medium hidden" maxlength="64" value="{$value}" disabled="disabled"  />
				<select id="gift_cert_state" name="gift_cert_data[state]"  class="input-text" >
					<option value="">- {$lang.select_state} -</option>
					{if $states}
						{foreach from=$states.$_country item=state}
							<option value="{$state.code}">{$state.state}</option>
						{/foreach}
					{/if}
				</select>
				<input type="hidden" id="gift_cert_state_default" value="{$gift_cert_data.state|default:$settings.General.default_state}" />
			</div>

			<div class="form-field">
				<label for="gift_cert_zipcode" class="cm-required">{$lang.zip_postal_code}:</label>
				<input type="text" id="gift_cert_zipcode" name="gift_cert_data[zipcode]" class="input-text-medium" value="{$gift_cert_data.zipcode}"  />
			</div>

			<div class="form-field">
				<label for="gift_cert_phone">{$lang.phone}:</label>
				<input type="text" id="gift_cert_phone" name="gift_cert_data[phone]" class="input-text-medium" value="{$gift_cert_data.phone}" />
			</div>
		</div>
	{if $id}</fieldset>{/if}

		{if $addons.gift_certificates.free_products_allow == "Y"}
		{include file="common_templates/subheader.tpl" title=$lang.free_products}
		{include file="pickers/products_picker.tpl" data_id="free_products" item_ids=$gift_cert_data.products input_name="gift_cert_data[products]" type="table" picker_for="gift_certificates"}
		{/if}
		
		<div class="select-field notify-customer">
			<input type="checkbox" name="notify_user" id="notify_user" value="Y" class="checkbox" />
			<label for="notify_user">{$lang.notify_customer}</label>
		</div>

		<div class="buttons-container buttons-bg">
			{if $id}
				{capture name="tools_list"}
				<ul>
					<li><a name="dispatch[gift_certificates.preview]" class="cm-new-window" rev="gift_certificates_form">{$lang.preview}</a></li>
				</ul>
				{/capture}
			
				{capture name="gift_extra_tools"}
				{include file="common_templates/tools.tpl" prefix="main" hide_actions=true tools_list=$smarty.capture.tools_list display="inline" link_text=$lang.choose_action}
				{/capture}
			{/if}
			
			{include file="buttons/save_cancel.tpl" but_name="dispatch[gift_certificates.update]" but_role="button_main" extra=$smarty.capture.gift_extra_tools}
		</div>

		</form>

	{** Page Section **}
	{if $id}
		</div>
		<div id="content_log" class="hidden">
			{include file="common_templates/pagination.tpl"}

			{assign var="c_url" value=$config.current_url|fn_query_remove:"sort_by":"sort_order"}

			<table cellpadding="0" cellspacing="0" border="0" width="100%" class="table sortable">
			<tr>
				<th><a class="cm-ajax{if $sort_by == "timestamp"} sort-link-{$sort_order}{/if}" href="{"`$c_url`&amp;sort_by=timestamp&amp;sort_order=`$sort_order`"|fn_url}" rev="pagination_contents">{$lang.date}</a></th>
				<th><a class="cm-ajax{if $sort_by == "email"} sort-link-{$sort_order}{/if}" href="{"`$c_url`&amp;sort_by=email&amp;sort_order=`$sort_order`"|fn_url}" rev="pagination_contents">{$lang.email}</a></th>
				<th><a class="cm-ajax{if $sort_by == "name"} sort-link-{$sort_order}{/if}" href="{"`$c_url`&amp;sort_by=name&amp;sort_order=`$sort_order`"|fn_url}" rev="pagination_contents">{$lang.name}</a></th>
				<th><a class="cm-ajax{if $sort_by == "order_id"} sort-link-{$sort_order}{/if}" href="{"`$c_url`&amp;sort_by=order_id&amp;sort_order=`$sort_order`"|fn_url}" rev="pagination_contents">{$lang.order_id}</a></th>
				<th><a class="cm-ajax{if $sort_by == "amount"} sort-link-{$sort_order}{/if}" href="{"`$c_url`&amp;sort_by=amount&amp;sort_order=`$sort_order`"|fn_url}" rev="pagination_contents">{$lang.balance}</a></th>
				<th><a class="cm-ajax{if $sort_by == "debit"} sort-link-{$sort_order}{/if}" href="{"`$c_url`&amp;sort_by=debit&amp;sort_order=`$sort_order`"|fn_url}" rev="pagination_contents">{$lang.gift_cert_debit}</a></th>
			</tr>
			{foreach from=$log item="l"}
			<tr {cycle values="class=\"table-row\", "}>
				<td>{$l.timestamp|date_format:"`$settings.Appearance.date_format`, `$settings.Appearance.time_format`"}</td>
				<td class="nowrap">{if $l.user_id || $l.order_email}<a href="mailto:{if $l.user_id}{$l.email|escape:url}{else}{$l.order_email|escape:url}{/if}" class="underlined">{if $l.user_id}{$l.email}{else}{$l.order_email}{/if}</a>{else}-{/if}</td>
				<td class="nowrap">
					{if $l.user_id}
						<a href="{"profiles.update?user_id=`$l.user_id`"|fn_url}" class="underlined">{$l.firstname} {$l.lastname}</a>
					{elseif $l.order_id}
						{$l.order_firstname} {$l.order_lastname}
					{else}
						-
					{/if}
				</td>
				<td>{if $l.order_id}<a href="{"orders.details?order_id=`$l.order_id`&amp;selected_section=payment_information"|fn_url}" class="underlined">&nbsp;{$l.order_id}&nbsp;</a>{else}-{/if}</td>
				<td>
					{if $addons.gift_certificates.free_products_allow == "Y"}<span>{$lang.amount}:</span>&nbsp;{/if}{include file="common_templates/price.tpl" value=$l.amount}
					{if $l.products && $addons.gift_certificates.free_products_allow == "Y"}
					<p><span>{$lang.free_products}:</span></p>
					<ul>
					{foreach from=$l.products item="product_item"}
						<li>&nbsp;<span>&#187;</span>&nbsp;{$product_item.amount} - {if $product_item.product}<a href="{"products.update?product_id=`$product_item.product_id`"|fn_url}">{$product_item.product|truncate:30:"...":true}</a>{else}{$lang.deleted_product}{/if}</li>
					{/foreach}
					</ul>
					{/if}
				</td>
				<td>
					{if $addons.gift_certificates.free_products_allow == "Y"}<span>{$lang.amount}:</span>&nbsp;{/if}{include file="common_templates/price.tpl" value=$l.debit}
					{if $l.debit_products && $addons.gift_certificates.free_products_allow == "Y"}
					<p><span>{$lang.free_products}:</span></p>
					{foreach from=$l.debit_products item="product_item"}
					<div>
						&nbsp;<span>&#187;</span>&nbsp;{$product_item.amount} - {if $product_item.product}<a href="{"products.update?product_id=`$product_item.product_id`"|fn_url}">{$product_item.product|truncate:30:"...":true}</a>{else}{$lang.deleted_product}{/if}
					</div>
					{/foreach}
					{/if}
				</td>
			</tr>
			{foreachelse}
			<tr class="no-items">
				<td colspan="6"><p>{$lang.no_items}</p></td>
			</tr>
			{/foreach}
			</table>
			{include file="common_templates/pagination.tpl"}
		</div>
		{/capture}
		{include file="common_templates/tabsbox.tpl" content=$smarty.capture.tabsbox active_tab=$smarty.request.selected_section}
	{/if}
	{** /Page Section **}

	<script type="text/javascript">
		//<![CDATA[
		$(function() {$ldelim}
			fn_giftcert_form_elements_disable({if !$id || $gift_cert_data}'select_block', 'input_block'{else}'input_block', 'select_block'{/if});
			fn_giftcert_form_elements_disable({if !$id || $gift_cert_data.send_via == 'E'}'post_block', 'email_block'{else}'email_block', 'post_block'{/if});
		{$rdelim});
		//]]>
	</script>

	{/capture}
	{if !$id}
		{assign var="title" value=$lang.new_certificate}
	{else}
		{assign var="title" value=$lang.editing_certificate|cat:": `$gift_cert_data.gift_cert_code`"}
		{include file="common_templates/view_tools.tpl" url="gift_certificates.update?gift_cert_id="}
	{/if}
	{include file="common_templates/mainbox.tpl" title=$title content=$smarty.capture.mainbox tools=$smarty.capture.view_tools}
{** / Gift certificates section **}
