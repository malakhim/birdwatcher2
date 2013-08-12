{assign var="r_url" value="payment_notification.notify?payment=2checkout"|fn_url:'C':'http'}
<p>{$lang.text_2checkout_notice|replace:"[return_url]":$r_url}</p>
<hr />

<div class="form-field">
	<label for="account_number">{$lang.account_number}:</label>
	<input type="text" name="payment_data[processor_params][account_number]" id="account_number" value="{$processor_params.account_number}" class="input-text" size="60" />
</div>

<div class="form-field">
	<label for="secret_word">{$lang.secret_word}:</label>
	<input type="text" name="payment_data[processor_params][secret_word]" id="secret_word" value="{$processor_params.secret_word}" class="input-text" size="60" />
</div>

<div class="form-field">
	<label for="mode">{$lang.test_live_mode}:</label>
	<select name="payment_data[processor_params][mode]" id="mode">
		<option value="test" {if $processor_params.mode == "test"}selected="selected"{/if}>{$lang.test}</option>
		<option value="live" {if $processor_params.mode == "live"}selected="selected"{/if}>{$lang.live}</option>
	</select>
</div>


<fieldset>
{include file="common_templates/subheader.tpl" title=$lang.text_2co_ins}

<div class="form-field">
	<label for="elm_2co_fraud_verification">{$lang.2co_enable_fraud_verification}:</label>
	<input type="hidden" name="payment_data[processor_params][fraud_verification]" value="N" />
    <input type="checkbox" name="payment_data[processor_params][fraud_verification]" id="elm_2co_fraud_verification" value="Y" {if $processor_params.fraud_verification == "Y"}checked="checked"{/if} />
</div>

{assign var="statuses" value=$smarty.const.STATUSES_ORDER|fn_get_statuses:true}

<div class="form-field">
	<label for="elm_2co_fraud_wait">{$lang.2co_fraud_wait}:</label>
	<select name="payment_data[processor_params][fraud_wait]" id="elm_2co_fraud_wait">
		{foreach from=$statuses item="s" key="k"}
		<option value="{$k}" {if $processor_params.fraud_wait == $k || !$processor_params.fraud_wait && $k == 'O'}selected="selected"{/if}>{$s}</option>
		{/foreach}
	</select>
</div>

<div class="form-field">
	<label for="elm_2co_fraud_fail">{$lang.2co_fraud_fail}:</label>
	<select name="payment_data[processor_params][fraud_fail]" id="elm_2co_fraud_fail">
		{foreach from=$statuses item="s" key="k"}
		<option value="{$k}" {if $processor_params.fraud_fail == $k || !$processor_params.fraud_wait && $k == 'D'}selected="selected"{/if}>{$s}</option>
		{/foreach}
	</select>
</div>

</fieldset>