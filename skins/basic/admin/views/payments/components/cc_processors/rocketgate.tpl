<div class="form-field">
        <label for="login">{$lang.login}:</label>
        <input type="text" name="payment_data[processor_params][login]" id="login" value="{$processor_params.login}" class="input-text" />
</div>

<div class="form-field">
        <label for="transaction_key">{$lang.transaction_key}:</label>
        <input type="text" name="payment_data[processor_params][transaction_key]" id="transaction_key" value="{$processor_params.transaction_key}" class="input-text" />
</div>

<div class="form-field">
        <label for="md5_hash_value">{$lang.md5_hash_value}:</label>
        <input type="text" name="payment_data[processor_params][md5_hash_value]" id="md5_hash_value" value="{$processor_params.md5_hash_value}" class="input-text" />
</div>

<div class="form-field">
        <label for="transaction_type">{$lang.transaction_type}:</label>
        <select name="payment_data[processor_params][transaction_type]" id="transaction_type">
                <option value="P" {if $processor_params.transaction_type == "P"}selected="selected"{/if}>{$lang.authorize_capture}</option>
                <option value="A" {if $processor_params.transaction_type == "A"}selected="selected"{/if}>{$lang.authorize_only}</option>
        </select>
</div>

<div class="form-field">
	<label for="currency">{$lang.currency}:</label>
	<select name="payment_data[processor_params][currency]" id="currency">
		<option value="USD" {if $processor_params.currency == "USD"}selected="selected"{/if}>{$lang.currency_code_usd}</option>
		<option value="GBP" {if $processor_params.currency == "GBP"}selected="selected"{/if}>{$lang.currency_code_gbp}</option>
		<option value="EUR" {if $processor_params.currency == "EUR"}selected="selected"{/if}>{$lang.currency_code_eur}</option>
		<option value="AUD" {if $processor_params.currency == "AUD"}selected="selected"{/if}>{$lang.currency_code_aud}</option>
		<option value="CAD" {if $processor_params.currency == "CAD"}selected="selected"{/if}>{$lang.currency_code_cad}</option>
		<option value="JPY" {if $processor_params.currency == "JPY"}selected="selected"{/if}>{$lang.currency_code_jpy}</option>
	</select>
</div>

<div class="form-field">
	<label for="mode">{$lang.test_live_mode}:</label>
	<select name="payment_data[processor_params][mode]" id="mode">
		<option value="test" {if $processor_params.mode == "test"}selected="selected"{/if}>{$lang.test}</option>
		<option value="live" {if $processor_params.mode == "live"}selected="selected"{/if}>{$lang.live}</option>
	</select>
</div>

<div class="form-field">
	<label for="order_prefix">{$lang.order_prefix}:</label>
	<input type="text" name="payment_data[processor_params][order_prefix]" id="order_prefix" value="{$processor_params.order_prefix}" class="input-text" />
</div>

<hr />

<p>
<b>Testing Info:</b>
This info will return the specified responses in demo mode and will have no effect on live mode where real data is required.
<br/>Refer to the Test_Values_and_Responses.pdf documentation for a complete list of scripted test values and responses.
<br/><br/><b>Test Credit Card Numbers:</b>
<br />Visa#: 4012 8888 8888 1881
<br />MC#: 5105 1051 0510 5100
<br />Discover#: 6011 1111 1111 1117
<br />AMEX#: 3782 822 4631 0005
<br /><br /> Any future date can be used for the expiration date.
<br/><br/><b>Test CVV Numbers:</b>
<br/>No Match: 0001
<br/>Not processed: 0002
<br/>Should have been present: 0003
<br/>Unable to process: 0004
<br/><br/>Any other 3 or 4 digit number can be used for the CVV Code.
<br/><br/><b>Test Zip Codes (AVS tests):</b>
<br/>Street match, Zip No Match: 00001<br/>No Match: 00008
<br>Exact Match: 00015
<br/><br/><a href="http://www.rocketgate.com/" target="_blank">RocketGate</a>
</p>