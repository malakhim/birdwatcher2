{assign var="url" value=$config.http_location}
<p>{$lang.text_mcpe_notice|replace:"[return_url]":"<span>`$config.current_location`/payments/mcpe_result.php</span>"}</p>
<hr />

<div class="form-field">
	<label for="merchant_id">{$lang.merchant_id}:</label>
	<input type="text" name="payment_data[processor_params][merchant_id]" id="merchant_id" value="{$processor_params.merchant_id}" class="input-text" size="60" />
</div>

<div class="form-field">
	<label for="mode">{$lang.test_live_mode}:</label>
	<select name="payment_data[processor_params][mode]" id="mode">
		<option value="0" {if $processor_params.mode == "0"}selected="selected"{/if}>{$lang.live}</option>
		<option value="1" {if $processor_params.mode == "1"}selected="selected"{/if}>{$lang.test}: {$lang.approved}</option>
		<option value="2" {if $processor_params.mode == "2"}selected="selected"{/if}>{$lang.test}: {$lang.declined}</option>
	</select>
</div>

<div class="form-field">
	<label for="currency">{$lang.currency}:</label>
	<select name="payment_data[processor_params][currency]" id="currency">
		<option value="GBP" {if $processor_params.currency eq "GBP"}selected="selected"{/if}>{$lang.currency_code_gbp}
		<option value="USD" {if $processor_params.currency eq "USD"}selected="selected"{/if}>{$lang.currency_code_usd}
		<option value="EUR" {if $processor_params.currency eq "EUR"}selected="selected"{/if}>{$lang.currency_code_eur}
	</select>
</div>