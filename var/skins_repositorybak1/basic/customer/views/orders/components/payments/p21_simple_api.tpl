<div class="form-field">
	<label for="dateofbirth" class="cm-required">{$lang.date_of_birth}:</label>
	{include file="common_templates/calendar.tpl" date_id="date_of_birth" date_name="payment_info[date_of_birth]" date_val=$cart.payment_info.date_of_birth|default:$user_data.birthday start_year="1902" end_year="0"}
</div>
<div class="form-field">
	<label for="last4ssn" class="cm-required">{$lang.last4ssn}:</label>
	<input id="last4ssn" maxlength="4" size="35" type="text" name="payment_info[last4ssn]" value="{$cart.payment_info.last4ssn}" class="input-text-medium cm-autocomplete-off" />
</div>
<div class="form-field">
	<label for="phone_number" class="cm-required cm-regexp">{$lang.phone}:</label>
	<input id="phone_number" size="35" type="text" name="payment_info[phone]" value="{$cart.payment_info.phone|default:$user_data.b_phone|default:$user_data.phone}" class="input-text cm-autocomplete-off" />
</div>
<div class="form-field">
	<label for="passport_number" class="">{$lang.passport_number}:</label>
	<input id="passport_number" size="35" type="text" name="payment_info[passport_number]" value="{$cart.payment_info.passport_number}" class="input-text cm-autocomplete-off" />
</div>
<div class="form-field">
	<label for="drlicense_number" class="">{$lang.drlicense_number}:</label>
	<input id="drlicense_number" size="35" type="text" name="payment_info[drlicense_number]" value="{$cart.payment_info.drlicense_number}" class="input-text cm-autocomplete-off" />
</div>
<div class="form-field">
	<label for="routingcode" class="cm-required">{$lang.routing_code}:</label>
	<input id="routingcode" maxlength="9" size="35" type="text" name="payment_info[routing_code]" value="{$cart.payment_info.routing_code}" class="input-text cm-autocomplete-off" />
</div>
<div class="form-field">
	<label for="accountnr" class="cm-required">{$lang.account_number}:</label>
	<input id="accountnr" maxlength="20" size="35" type="text" name="payment_info[account_number]" value="{$cart.payment_info.account_number}" class="input-text cm-autocomplete-off" />
</div>
<div class="form-field">
	<label for="checknr" class="cm-required">{$lang.check_number}:</label>
	<input id="checknr" maxlength="10" size="35" type="text" name="payment_info[check_number]" value="{$cart.payment_info.check_number}" class="input-text cm-autocomplete-off" />
</div>
<div class="form-field">
	<label for="p21agree" class="cm-required">{$lang.p21agree} (<a class="cm-tooltip" title="{$lang.p21agree_tooltip}">?</a>):</label>
	<input id="p21agree" maxlength="8" size="35" type="text" name="payment_info[mm_agree]" value="{$cart.payment_info.mm_agree}" class="input-text cm-autocomplete-off" />
</div>

<script type="text/javascript">
//<![CDATA[
{literal}
regexp['phone_number'] = {
	regexp: "^([0-9]{3}[ ]{1}[0-9]{3}[ ]{1}[0-9]{4})$"{/literal}, message: "{$lang.error_validator_phone_number|escape:'javascript'}"
{literal}
};
{/literal}
//]]>
</script>