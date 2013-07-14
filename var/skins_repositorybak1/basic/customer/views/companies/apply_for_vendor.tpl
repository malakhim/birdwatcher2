<div class="company">
{include file="views/profiles/components/profiles_scripts.tpl"}

<h1 class="mainbox-title"><span>{$lang.apply_for_vendor_account}</span></h1>

<div class="form-wrap">
	<div class="form-wrap-l"></div>
	<div class="form-wrap-r"></div>
	
<div id="apply_for_vendor_account" > {* content detailed *}

<form action="{"companies.apply_for_vendor"|fn_url}" method="post" name="apply_for_vendor_form">

<div class="form-field">
	<label for="company_description_company" class="cm-required">{$lang.company}</label>
	<input type="text" name="company_data[company]" id="company_description_company" size="32" value="{$company_data.company}" class="input-text" />
</div>

<div class="form-field">
	<label for="company_description">{$lang.description}</label>
	<textarea id="company_description" name="company_data[company_description]" cols="55" rows="5" class="input-textarea-long">{$company_data.company_description}</textarea>
</div>

{if $languages|count > 1}
<div class="form-field">
	<label for="company_language">{$lang.language}</label>
	<select name="company_data[lang_code]" id="company_language">
		{foreach from=$languages item="language" key="lang_code"}
			<option value="{$lang_code}" {if $lang_code == $company_data.lang_code}selected="selected"{/if}>{$language.name}</option>
		{/foreach}
	</select>
</div>
{else}
<input type="hidden" name="company_data[lang_code]" value="{$languages|key}" />
{/if}

{if !$auth.user_id && $settings.Suppliers.create_vendor_administrator_account == "Y"}

	{literal}
	<script type="text/javascript">
	//<![CDATA[

	function fn_toggle_required_fields() {
		var f = $('#company_admin_firstname'); 
		var l = $('#company_admin_lastname'); 
		if ($('#company_request_account_name').val() == '') {
			f.attr('disabled', true); f.addClass('disabled');
			l.attr('disabled', true); l.addClass('disabled');

			$('.cm-profile-field').each(function(index){
				if ($('#' + $(this).attr('for')).children() != null) {
					// Traverse subitems
					$('.' + $(this).attr('for')).attr('disabled', true);
					$('.' + $(this).attr('for')).addClass('disabled');
				}
				$('#' + $(this).attr('for')).attr('disabled', true);
				$('#' + $(this).attr('for')).addClass('disabled');
			});
		} else {
			f.removeAttr('disabled'); f.removeClass('disabled');
			l.removeAttr('disabled'); l.removeClass('disabled');

			$('.cm-profile-field').each(function(index){
				if ($('#' + $(this).attr('for')).children() != null) {
					// Traverse subitems
					$('.' + $(this).attr('for')).removeAttr('disabled');
					$('.' + $(this).attr('for')).removeClass('disabled');
				}
				$('#' + $(this).attr('for')).removeAttr('disabled');
				$('#' + $(this).attr('for')).removeClass('disabled');
			});
		}
	}
	//]]>
	</script>
	{/literal}

	{if $settings.General.use_email_as_login != 'Y'}
		{assign var="disabled_by_default" value=true}
		<div class="form-field" id="company_description_admin">
			<label for="company_request_account_name" class="cm-trim">{$lang.account_name}</label>
			<input type="text" name="company_data[request_account_name]" id="company_request_account_name" size="32" value="{$company_data.request_account_name}" class="input-text" onkeyup="fn_toggle_required_fields();"/>
		</div>
	{else}
		{assign var="disabled_by_default" value=false}
	{/if}
	<div class="form-field shipping-first-name" id="company_description_admin_firstname">
		<label for="company_admin_firstname" class="cm-required">{$lang.first_name}</label>
		<input type="text" name="company_data[admin_firstname]" id="company_admin_firstname" size="32" value="{$company_data.admin_firstname}" class="input-text{if $settings.General.use_email_as_login != 'Y'} disabled" disabled="disabled"{else}"{/if}/>
	</div>
	<div class="form-field shipping-last-name" id="company_description_admin_lastname">
		<label for="company_admin_lastname" class="cm-required">{$lang.last_name}</label>
		<input type="text" name="company_data[admin_lastname]" id="company_admin_lastname" size="32" value="{$company_data.admin_lastname}" class="input-text{if $settings.General.use_email_as_login != 'Y'} disabled" disabled="disabled"{else}"{/if}/>
	</div>

{/if}

{if !$auth.user_id}
	{include file="views/profiles/components/profile_fields.tpl" section="C" title=$lang.contact_information disabled_by_default=$disabled_by_default}
{else}
	{include file="common_templates/subheader.tpl" title=$lang.contact_information}
{/if}

<div class="form-field">
	<label for="company_description_email" class="cm-required cm-email cm-trim">{$lang.email}</label>
	<input type="text" name="company_data[email]" id="company_description_email" size="32" value="{$company_data.email}" class="input-text" />
</div>

<div class="form-field">
	<label for="company_description_phone" class="cm-required">{$lang.phone}</label>
	<input type="text" name="company_data[phone]" id="company_description_phone" size="32" value="{$company_data.phone}" class="input-text" />
</div>

<div class="form-field">
	<label for="company_description_url">{$lang.url}</label>
	<input type="text" name="company_data[url]" id="company_description_url" size="32" value="{$company_data.url}" class="input-text" />
</div>

<div class="form-field">
	<label for="company_description_fax">{$lang.fax}</label>
	<input type="text" name="company_data[fax]" id="company_description_fax" size="32" value="{$company_data.fax}" class="input-text" />
</div>


{if !$auth.user_id}
	{include file="views/profiles/components/profile_fields.tpl" section="B" title=$lang.shipping_address shipping_flag=false disabled_by_default=$disabled_by_default}
{else}
	{include file="common_templates/subheader.tpl" title=$lang.shipping_address} 
{/if}

<div class="form-field ">
	<label for="company_address_address" class="cm-required">{$lang.address}</label>
	<input type="text" name="company_data[address]" id="company_address_address" size="32" value="{$company_data.address}" class="input-text" />
</div>

<div class="form-field">
	<label for="company_address_city" class="cm-required">{$lang.city}</label>
	<input type="text" name="company_data[city]" id="company_address_city" size="32" value="{$company_data.city}" class="input-text" />
</div>

<div class="form-field  shipping-country">
	<label for="company_address_country" class="cm-required cm-country cm-location-shipping">{$lang.country}</label>
	{assign var="_country" value=$company_data.country|default:$settings.General.default_country}
	<select id="company_address_country" name="company_data[country]">
		<option value="">- {$lang.select_country} -</option>
		{foreach from=$countries item=country}
		<option {if $_country == $country.code}selected="selected"{/if} value="{$country.code}">{$country.country}</option>
		{/foreach}
	</select>
</div>

<div class="form-field shipping-state">
	{assign var="country_code" value=$company_data.country|default:$settings.General.default_country}
	{assign var="state_code" value=$company_data.state|default:$settings.General.default_state}
	<label for="company_address_state" class="cm-required cm-state cm-location-shipping">{$lang.state}</label>
	<select id="company_address_state" name="company_data[state]" {if !$states.$country_code}class="hidden"{/if}>
		<option value="">- {$lang.select_state} -</option>
		{* Initializing default states *}
		{if $states.$country_code}
			{foreach from=$states.$country_code item=state}
				<option {if $state_code == $state.code}selected="selected"{/if} value="{$state.code}">{$state.state}</option>
			{/foreach}
		{/if}
	</select>
	<input type="text" id="company_address_state_d" name="company_data[state]" size="32" maxlength="64" value="{$company_data.state}" {if $states.$country_code}disabled="disabled"{/if} class="input-text {if $states.$country_code}hidden{/if} cm-skip-avail-switch" />
	<input type="hidden" id="company_address_state_default" value="{$settings.General.default_state}" />
</div>

<div class="form-field shipping-zip-code">
	<label for="company_address_zipcode" class="cm-required cm-zipcode cm-location-shipping">{$lang.zip_postal_code}</label>
	<input type="text" name="company_data[zipcode]" id="company_address_zipcode" size="32" value="{$company_data.zipcode}" class="input-text" />
</div>

{if $settings.Image_verification.use_for_apply_for_vendor_account == "Y"}
 	{include file="common_templates/image_verification.tpl" id="apply_for_vendor_account" align="left"}
 {/if}

<div class="buttons-container">
	{include file="buttons/button.tpl" but_text=$lang.submit but_name="dispatch[companies.apply_for_vendor]" but_id="but_apply_for_vendor"}
</div>



</form>

	</div>
</div>
</div>{* /apply_for_vendor_account *}