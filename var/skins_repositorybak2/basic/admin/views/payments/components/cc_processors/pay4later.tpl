{assign var="verified_url" value="payment_notification.notify.verified?payment=pay4later"|fn_url:'C':'http'}
{assign var="refer_url" value="payment_notification.refer?payment=pay4later"|fn_url:'C':'http'}
{assign var="decline_url" value="payment_notification.decline?payment=pay4later"|fn_url:'C':'http'}
{assign var="cancel_url" value="payment_notification.cancel?payment=pay4later"|fn_url:'C':'http'}
{assign var="process_url" value="payment_notification.process?payment=pay4later"|fn_url:'C':'http'}
<p>{$lang.text_pay4later_notice|replace:"[verified_url]":$verified_url|replace:"[decline_url]":$decline_url|replace:"[cancel_url]":$cancel_url|replace:"[refer_url]":$refer_url|replace:"[process_url]":$process_url}</p>
<hr />

<div class="form-field">
	<label for="p4l_merchant_key">{$lang.merchant_key}:</label>
	<input type="text" name="payment_data[processor_params][merchant_key]" id="p4l_merchant_key" value="{$processor_params.merchant_key}" class="input-text" size="60" />
</div>

<div class="form-field">
	<label for="p4l_installation_id">{$lang.installation_id}:</label>
	<input type="text" name="payment_data[processor_params][installation_id]" id="p4l_installation_id" value="{$processor_params.installation_id}" class="input-text" size="60" />
</div>

<div class="form-field">
	<label for="p4l_finance_product_code">{$lang.finance_product_code}:</label>
	<input type="text" name="payment_data[processor_params][finance_product_code]" id="p4l_finance_product_code" value="{$processor_params.finance_product_code|default:'ONIF6'}" class="input-text" size="60" />
</div>

<div class="form-field">
	<label for="p4l_deposit_amount">{$lang.deposit_amount}:</label>
	<input type="text" name="payment_data[processor_params][deposit_amount]" id="p4l_deposit_amount" value="{$processor_params.deposit_amount|default:'0.00'}" class="input-text" size="60" />
</div>

<div class="form-field">
	<label for="p4l_mode">{$lang.test_live_mode}:</label>
	<select name="payment_data[processor_params][mode]" id="p4l_mode">
		<option value="test"{if $processor_params.mode eq "test"} selected="selected"{/if}>{$lang.test}
		<option value="live"{if $processor_params.mode eq "live"} selected="selected"{/if}>{$lang.live}
	</select>
</div>