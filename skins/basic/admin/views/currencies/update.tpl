{if $currency.currency_code}
	{assign var="id" value=$currency.currency_code}
{else}
	{assign var="id" value="0"}	
{/if}

<div id="content_group{$id}">

<form action="{""|fn_url}" name="update_currency_form_{$id}" method="post" class="cm-form-highlight{if ""|fn_check_form_permissions} cm-hide-inputs{/if}">
<input type="hidden" name="currency_code" value="{$id}" />
<input type="hidden" name="redirect_url" value="{$smarty.request.return_url}" />

<div class="tabs cm-j-tabs">
	<ul>
		<li id="tab_general_{$id}" class="cm-js cm-active"><a>{$lang.general}</a></li>
	</ul>
</div>

<div class="cm-tabs-content" id="content_tab_general_{$id}">
<fieldset>
	<div class="form-field">
		<label class="cm-required" for="description_{$id}">{$lang.name}:</label>
		<input type="text" name="currency_data[description]" value="{$currency.description}" id="description_{$id}" class="input-text" size="18" />
	</div>

	<div class="form-field">
		<label class="cm-required" for="currency_code_{$id}">{$lang.code}:</label>
		<input type="text" name="currency_data[currency_code]" size="8" value="{$currency.currency_code}" id="currency_code_{$id}" class="input-text" onkeyup="var matches = this.value.match(/^(\w*)/gi);  if (matches) this.value = matches;" />
	</div>
	
	{if $id}
	<div class="form-field">
		<label for="is_primary_currency_{$id}">{$lang.primary_currency}:</label>
		<input type="hidden" name="currency_data[coefficient]" value="1" />
		<input type="checkbox" name="currency_data[is_primary]" value="Y" {if $currency.is_primary == "Y"}checked="checked"{/if} onclick="$('.cm-coefficient').attr('disabled', $(this).is(':checked') ? 'disabled' : '')" id="is_primary_currency_{$id}" class="checkbox" />
	</div>
	{/if}

	<div class="form-field">
		<label class="cm-required" for="coefficient_{$id}">{$lang.currency_rate}:</label>
		<input type="text" name="currency_data[coefficient]" size="7" value="{$currency.coefficient}" id="coefficient_{$id}" class="input-text cm-coefficient" {if $currency.is_primary == "Y"}disabled="disabled"{/if} />
	</div>
	
	<div class="form-field">
		<label for="symbol_{$id}">{$lang.currency_sign}:</label>
		<input type="text" name="currency_data[symbol]" size="6" value="{$currency.symbol}" id="symbol_{$id}" class="input-text" />
	</div>
	
{hook name="currencies:autoupdate"}{/hook}

	<div class="form-field">
		<label for="after_{$id}">{$lang.after_sum}:</label>
		<input type="hidden" name="currency_data[after]" value="N" />
		<input type="checkbox" name="currency_data[after]" value="Y" {if $currency.after == "Y"}checked="checked"{/if} id="after_{$id}" class="checkbox" />
	</div>

	{if !$id}
		{include file="common_templates/select_status.tpl" input_name="currency_data[status]" id="add_currency"}
	{/if}

	<div class="form-field">
		<label for="thousands_separator_{$id}">{$lang.ths_sign}:</label>
		<input type="text" name="currency_data[thousands_separator]" size="1" maxlength="1" value="{$currency.thousands_separator}" id="thousands_separator_{$id}" class="input-text" />
	</div>

	<div class="form-field">
		<label for="decimal_separator_{$id}">{$lang.dec_sign}:</label>
		<input type="text" name="currency_data[decimals_separator]" size="1" maxlength="1" value="{$currency.decimals_separator}" id="decimal_separator_{$id}" class="input-text" />
	</div>

	<div class="form-field">
		<label for="decimals_{$id}">{$lang.decimals}:</label>
		<input type="text" name="currency_data[decimals]" size="1" maxlength="2" value="{$currency.decimals}" id="decimals_{$id}" class="input-text" />
	</div>
	</fieldset>
</div>

{if ""|fn_allow_save_object:"":true}
	<div class="buttons-container">
		{include file="buttons/save_cancel.tpl" but_name="dispatch[currencies.update]" cancel_action="close"}
	</div>
{/if}

</form>
<!--content_group{$id}--></div>