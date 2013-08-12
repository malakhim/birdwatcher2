<div class="form-field">
	<label for="">{$lang.merchant_id}:</label>
	<input type="text" name="payment_data[processor_params][merchant_id]" id="merchant_id" value="{$processor_params.merchant_id}" class="input-text" size="60" />
</div>

<div class="form-field">
	<label for="mac_key">{$lang.mac_key}:</label>
	<input type="text" name="payment_data[processor_params][mac_key]" id="mac_key" value="{$processor_params.mac_key}" class="input-text" size="60" />
</div>

<div class="form-field">
	<label for="currency">{$lang.currency}:</label>
	<select name="payment_data[processor_params][currency]" id="currency">
		<option value="CAD" {if $processor_params.currency == "CAD"}selected="selected"{/if}>{$lang.currency_code_cad}</option>
		<option value="CHF" {if $processor_params.currency == "CHF"}selected="selected"{/if}>{$lang.currency_code_chf}</option>
		<option value="EUR" {if $processor_params.currency == "EUR"}selected="selected"{/if}>{$lang.currency_code_eur}</option>
		<option value="FRF" {if $processor_params.currency == "FRF"}selected="selected"{/if}>{$lang.currency_code_frf}</option>
		<option value="GBP" {if $processor_params.currency == "GBP"}selected="selected"{/if}>{$lang.currency_code_gbp}</option>
		<option value="HKD" {if $processor_params.currency == "HKD"}selected="selected"{/if}>{$lang.currency_code_hkd}</option>
		<option value="JPY" {if $processor_params.currency == "JPY"}selected="selected"{/if}>{$lang.currency_code_jpy}</option>
		<option value="NZD" {if $processor_params.currency == "NZD"}selected="selected"{/if}>{$lang.currency_code_nzd}</option>
		<option value="SGD" {if $processor_params.currency == "SGD"}selected="selected"{/if}>{$lang.currency_code_sgd}</option>
		<option value="USD" {if $processor_params.currency == "USD"}selected="selected"{/if}>{$lang.currency_code_usd}</option>
		<option value="ZAR" {if $processor_params.currency == "ZAR"}selected="selected"{/if}>{$lang.currency_code_zar}</option>
		<option value="AUD" {if $processor_params.currency == "AUD"}selected="selected"{/if}>{$lang.currency_code_aud}</option>
		<option value="WST" {if $processor_params.currency == "WST"}selected="selected"{/if}>{$lang.currency_code_wst}</option>
		<option value="VUV" {if $processor_params.currency == "VUV"}selected="selected"{/if}>{$lang.currency_code_vuv}</option>
		<option value="TOP" {if $processor_params.currency == "TOP"}selected="selected"{/if}>{$lang.currency_code_top}</option>
		<option value="SBD" {if $processor_params.currency == "SBD"}selected="selected"{/if}>{$lang.currency_code_sbd}</option>
		<option value="PNG" {if $processor_params.currency == "PNG"}selected="selected"{/if}>{$lang.currency_code_png}</option>
		<option value="MYR" {if $processor_params.currency == "MYR"}selected="selected"{/if}>{$lang.currency_code_myr}</option>
		<option value="KWD" {if $processor_params.currency == "KWD"}selected="selected"{/if}>{$lang.currency_code_kwd}</option>
		<option value="FJD" {if $processor_params.currency == "FJD"}selected="selected"{/if}>{$lang.currency_code_fjd}</option>
		<option value="DKK" {if $processor_params.currency == "DKK"}selected="selected"{/if}>{$lang.currency_code_dkk}</option>
	</select>
</div>

<div class="form-field">
	<label for="mode">{$lang.test_live_mode}:</label>
	<select name="payment_data[processor_params][mode]" id="mode">
		<option value="live" {if $processor_params.mode == "live"}selected="selected"{/if}>{$lang.live}</option>
		<option value="A" {if $processor_params.mode == "A"}selected="selected"{/if}>{$lang.test}&nbsp;({$lang.processed})</option>
		<option value="D" {if $processor_params.mode == "D"}selected="selected"{/if}>{$lang.test}&nbsp;({$lang.declined})</option>
	</select>
</div>
