{assign var="b_url" value="`$config.http_location`/`$config.customer_index`?dispatch=checkout.checkout"}
{assign var="n_url" value="`$config.http_location`/`$config.customer_index`?dispatch=payment_notification.notify&payment=emerchantpay"}
{assign var="d_url" value="`$config.http_location`/`$config.customer_index`?dispatch=payment_notification.decline&payment=emerchantpay"}
{assign var="p_url" value="`$config.http_location`/`$config.customer_index`?dispatch=payment_notification.process&payment=emerchantpay"}
<p>{$lang.text_emerchantpay_notice|replace:"[backreturn_url]":$b_url|replace:"[notify_url]":$n_url|replace:"[decline_url]":$d_url|replace:"[process_url]":$p_url}</p>
<hr />

<div class="form-field">
	<label for="client_id">{$lang.client_id}:</label>
	<input type="text" name="payment_data[processor_params][client_id]" id="client_id" value="{$processor_params.client_id}" class="input-text"  size="10" />
</div>

<div class="form-field">
	<label for="form_id">{$lang.form_id}:</label>
	<input type="text" name="payment_data[processor_params][form_id]" id="form_id" value="{$processor_params.form_id}" class="input-text"  size="10" />
</div>

<div class="form-field">
	<label for="payment_form_url">{$lang.payment_form_url}:</label>
	<input type="text" name="payment_data[processor_params][payment_form_url]" id="payment_form_url" value="{$processor_params.payment_form_url}" class="input-text"  size="60" />
</div>

<div class="form-field">
	<label for="secret_key">{$lang.secret_key}:</label>
	<input type="text" name="payment_data[processor_params][secret_key]" id="secret_key" value="{$processor_params.secret_key}" class="input-text"  size="60" />
</div>

<div class="form-field">
	<label for="currency">{$lang.currency}:</label>
	<select name="payment_data[processor_params][currency]" id="currency">
		<option value="USD"{if $processor_params.currency == "USD"} selected="selected"{/if}>{$lang.currency_code_usd}</option>
		<option value="EUR"{if $processor_params.currency == "EUR"} selected="selected"{/if}>{$lang.currency_code_eur}</option>
		<option value="AUD"{if $processor_params.currency == "AUD"} selected="selected"{/if}>{$lang.currency_code_aud}</option>
		<option value="CAD"{if $processor_params.currency == "CAD"} selected="selected"{/if}>{$lang.currency_code_cad}</option>
		<option value="CHF"{if $processor_params.currency == "CHF"} selected="selected"{/if}>{$lang.currency_code_chf}</option>
		<option value="CZK"{if $processor_params.currency == "CZK"} selected="selected"{/if}>{$lang.currency_code_czk}</option>
		<option value="DKK"{if $processor_params.currency == "DKK"} selected="selected"{/if}>{$lang.currency_code_dkk}</option>
		<option value="FRF"{if $processor_params.currency == "FRF"} selected="selected"{/if}>{$lang.currency_code_frf}</option>
		<option value="GBP"{if $processor_params.currency == "GBP"} selected="selected"{/if}>{$lang.currency_code_gbp}</option>
		<option value="HKD"{if $processor_params.currency == "HKD"} selected="selected"{/if}>{$lang.currency_code_hkd}</option>
		<option value="HUF"{if $processor_params.currency == "HUF"} selected="selected"{/if}>{$lang.currency_code_huf}</option>
		<option value="ILS"{if $processor_params.currency == "ILS"} selected="selected"{/if}>{$lang.currency_code_ils}</option>
		<option value="JPY"{if $processor_params.currency == "JPY"} selected="selected"{/if}>{$lang.currency_code_jpy}</option>
		<option value="LTL"{if $processor_params.currency == "LTL"} selected="selected"{/if}>{$lang.currency_code_ltl}</option>
		<option value="LVL"{if $processor_params.currency == "LVL"} selected="selected"{/if}>{$lang.currency_code_lvl}</option>
		<option value="MXN"{if $processor_params.currency == "MXN"} selected="selected"{/if}>{$lang.currency_code_mxn}</option>
		<option value="NOK"{if $processor_params.currency == "NOK"} selected="selected"{/if}>{$lang.currency_code_nok}</option>
		<option value="NZD"{if $processor_params.currency == "NZD"} selected="selected"{/if}>{$lang.currency_code_nzd}</option>
		<option value="PLN"{if $processor_params.currency == "PLN"} selected="selected"{/if}>{$lang.currency_code_pln}</option>
		<option value="RUR"{if $processor_params.currency == "RUR"} selected="selected"{/if}>{$lang.currency_code_rur}</option>
		<option value="SEK"{if $processor_params.currency == "SEK"} selected="selected"{/if}>{$lang.currency_code_sek}</option>
		<option value="SGD"{if $processor_params.currency == "SGD"} selected="selected"{/if}>{$lang.currency_code_sgd}</option>
		<option value="SKK"{if $processor_params.currency == "SKK"} selected="selected"{/if}>{$lang.currency_code_skk}</option>
		<option value="THB"{if $processor_params.currency == "THB"} selected="selected"{/if}>{$lang.currency_code_thb}</option>
		<option value="TRY"{if $processor_params.currency == "TRY"} selected="selected"{/if}>{$lang.currency_code_try}</option>
		<option value="KPW"{if $processor_params.currency == "KPW"} selected="selected"{/if}>{$lang.currency_code_kpw}</option>
		<option value="KRW"{if $processor_params.currency == "KRW"} selected="selected"{/if}>{$lang.currency_code_krw}</option>
		<option value="ZAR"{if $processor_params.currency == "ZAR"} selected="selected"{/if}>{$lang.currency_code_zar}</option>
	</select>
</div>

<div class="form-field">
	<label for="mode">{$lang.test_live_mode}:</label>
	<select name="payment_data[processor_params][mode]" id="mode">
		<option value="TEST" {if $processor_params.mode == "TEST"}selected="selected"{/if}>{$lang.test}</option>
		<option value="LIVE" {if $processor_params.mode == "LIVE"}selected="selected"{/if}>{$lang.live}</option>
	</select>
</div>