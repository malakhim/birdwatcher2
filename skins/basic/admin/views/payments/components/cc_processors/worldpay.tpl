{assign var="return_url" value="`$config.http_location`/payments/worldpay.php"}
<p>{$lang.text_worldpay_notice|replace:"[return_url]":$return_url}</p>
<hr />

<div class="form-field">
	<label for="account_id">{$lang.installation_id}:</label>
	<input type="text" name="payment_data[processor_params][account_id]" id="account_id" value="{$processor_params.account_id}" class="input-text"  size="60" />
</div>

<div class="form-field">
	<label for="callback_password">{$lang.payment_response_password}:</label>
	<input type="text" name="payment_data[processor_params][callback_password]" id="callback_password" value="{$processor_params.callback_password}" class="input-text"  size="60" />
</div>

<div class="form-field">
	<label for="md5_secret">{$lang.worldpay_secret}:</label>
	<input type="text" name="payment_data[processor_params][md5_secret]" id="md5_secret" value="{$processor_params.md5_secret}" class="input-text"  size="60" />
</div>

<div class="form-field">
	<label for="test">{$lang.test_live_mode}:</label>
	<select name="payment_data[processor_params][test]" id="test">
		<option value="101" {if $processor_params.test == "101"}selected="selected"{/if}>{$lang.test}: {$lang.declined}</option>
		<option value="100" {if $processor_params.test == "100"}selected="selected"{/if}>{$lang.test}: {$lang.approved}</option>
		<option value="0" {if $processor_params.test == "0"}selected="selected"{/if}>{$lang.live}</option>
	</select>
</div>

<div class="form-field">
	<label for="currency">{$lang.currency}:</label>
	<select name="payment_data[processor_params][currency]" id="currency">
		<option value="GBP" {if $processor_params.currency == "GBP"}selected="selected"{/if}>{$lang.currency_code_gbp}</option>
		<option value="EUR" {if $processor_params.currency == "EUR"}selected="selected"{/if}>{$lang.currency_code_eur}</option>
		<option value="USD" {if $processor_params.currency == "USD"}selected="selected"{/if}>{$lang.currency_code_usd}</option>
		<option value="AUD" {if $processor_params.currency == "AUD"}selected="selected"{/if}>{$lang.currency_code_aud}</option>
		<option value="CAD" {if $processor_params.currency == "CAD"}selected="selected"{/if}>{$lang.currency_code_cad}</option>
		<option value="CHF" {if $processor_params.currency == "CHF"}selected="selected"{/if}>{$lang.currency_code_chf}</option>
		<option value="CZK" {if $processor_params.currency == "CZK"}selected="selected"{/if}>{$lang.currency_code_czk}</option>
		<option value="DKK" {if $processor_params.currency == "DKK"}selected="selected"{/if}>{$lang.currency_code_dkk}</option>
		<option value="HKD" {if $processor_params.currency == "HKD"}selected="selected"{/if}>{$lang.currency_code_hkd}</option>
		<option value="HUF" {if $processor_params.currency == "HUF"}selected="selected"{/if}>{$lang.currency_code_huf}</option>
		<option value="JPY" {if $processor_params.currency == "JPY"}selected="selected"{/if}>{$lang.currency_code_jpy}</option>
		<option value="KRW" {if $processor_params.currency == "KRW"}selected="selected"{/if}>{$lang.currency_code_krw}</option>
		<option value="MYR" {if $processor_params.currency == "MYR"}selected="selected"{/if}>{$lang.currency_code_myr}</option>
		<option value="NOK" {if $processor_params.currency == "NOK"}selected="selected"{/if}>{$lang.currency_code_nok}</option>
		<option value="NZD" {if $processor_params.currency == "NZD"}selected="selected"{/if}>{$lang.currency_code_nzd}</option>
		<option value="PLN" {if $processor_params.currency == "PLN"}selected="selected"{/if}>{$lang.currency_code_pln}</option>
		<option value="SEK" {if $processor_params.currency == "SEK"}selected="selected"{/if}>{$lang.currency_code_sek}</option>
		<option value="SGD" {if $processor_params.currency == "SGD"}selected="selected"{/if}>{$lang.currency_code_sgd}</option>
		<option value="SKK" {if $processor_params.currency == "SKK"}selected="selected"{/if}>{$lang.currency_code_skk}</option>
		<option value="THB" {if $processor_params.currency == "THB"}selected="selected"{/if}>{$lang.currency_code_thb}</option>
	</select>
</div>

<div class="form-field">
	<label for="type">{$lang.type}:</label>
 	<select name="payment_data[processor_params][authmode]" id="type">
		<option value="A" {if $processor_params.authmode == "A"}selected="selected"{/if}>{$lang.fullauth}</option>
		<option value="E" {if $processor_params.authmode == "E"}selected="selected"{/if}>{$lang.preauth}</option>
	</select>
</div>