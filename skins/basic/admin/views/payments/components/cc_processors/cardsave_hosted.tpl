<p>{$lang.processor_description_cardsave}</p>
<hr/>

<div class="form-field">
	<label for="merchant_id">{$lang.merchant_id}:</label>
	<input type="text" name="payment_data[processor_params][merchant_id]" id="merchant_id" value="{$processor_params.merchant_id}" class="input-text" size="60" />
</div>

<div class="form-field">
	<label for="access_code">{$lang.preshared_key}:</label>
	<input type="text" name="payment_data[processor_params][access_code]" id="access_code" value="{$processor_params.access_code}" class="input-text" size="60" />
</div>

<div class="form-field">
	<label for="password">{$lang.password}:</label>
	<input type="password" name="payment_data[processor_params][password]" id="password" value="{$processor_params.password}" class="input-text" size="60" />
</div>

<div class="form-field">
	<label for="transaction_type">{$lang.transaction_type}:</label>
	<select name="payment_data[processor_params][transaction_type]" id="transaction_type">
		<option value="SALE" {if $processor_params.transaction_type == "SALE"}selected="selected"{/if}>{$lang.sale}</option>
		<option value="PREAUTH" {if $processor_params.transaction_type == "PREAUTH"}selected="selected"{/if}>{$lang.preauth}</option>
	</select>
</div>

<div class="form-field">
	<label for="currency">{$lang.currency}:</label>
	<select name="payment_data[processor_params][currency]" id="currency">
		<option value="978"{if $processor_params.currency == '978'} selected="selected"{/if}>{$lang.currency_code_eur}</option>
		<option value="840"{if $processor_params.currency == '840'} selected="selected"{/if}>{$lang.currency_code_usd}</option>
		<option value="826"{if $processor_params.currency == '826'} selected="selected"{/if}>{$lang.currency_code_gbp}</option>
	</select>
</div>

<hr/>

<div class="form-field">
	<label for="transaction_type">{$lang.cvv2}&nbsp;{$lang.mandatory}:</label>
	<select name="payment_data[processor_params][cv2_mandatory]" id="cv2_mandatory">
		<option value="true" {if $processor_params.cv2_mandatory == "true"}selected="selected"{/if}>{$lang.yes}</option>
		<option value="false" {if $processor_params.cv2_mandatory == "false"}selected="selected"{/if}>{$lang.no}</option>
	</select>
</div>

<div class="form-field">
	<label for="transaction_type">{$lang.country}&nbsp;{$lang.mandatory}:</label>
	<select name="payment_data[processor_params][country_mandatory]" id="country_mandatory">
		<option value="true" {if $processor_params.country_mandatory == "true"}selected="selected"{/if}>{$lang.yes}</option>
		<option value="false" {if $processor_params.country_mandatory == "false"}selected="selected"{/if}>{$lang.no}</option>
	</select>
</div>

<div class="form-field">
	<label for="transaction_type">{$lang.state}&nbsp;{$lang.mandatory}:</label>
	<select name="payment_data[processor_params][state_mandatory]" id="state_mandatory">
		<option value="true" {if $processor_params.state_mandatory == "true"}selected="selected"{/if}>{$lang.yes}</option>
		<option value="false" {if $processor_params.state_mandatory == "false"}selected="selected"{/if}>{$lang.no}</option>
	</select>
</div>

<div class="form-field">
	<label for="transaction_type">{$lang.city}&nbsp;{$lang.mandatory}:</label>
	<select name="payment_data[processor_params][city_mandatory]" id="city_mandatory">
		<option value="true" {if $processor_params.city_mandatory == "true"}selected="selected"{/if}>{$lang.yes}</option>
		<option value="false" {if $processor_params.city_mandatory == "false"}selected="selected"{/if}>{$lang.no}</option>
	</select>
</div>

<div class="form-field">
	<label for="transaction_type">{$lang.address}&nbsp;{$lang.mandatory}:</label>
	<select name="payment_data[processor_params][address_mandatory]" id="address_mandatory">
		<option value="true" {if $processor_params.address_mandatory == "true"}selected="selected"{/if}>{$lang.yes}</option>
		<option value="false" {if $processor_params.address_mandatory == "false"}selected="selected"{/if}>{$lang.no}</option>
	</select>
</div>

<div class="form-field">
	<label for="transaction_type">{$lang.zip_postal_code}&nbsp;{$lang.mandatory}:</label>
	<select name="payment_data[processor_params][postcode_mandatory]" id="postcode_mandatory">
		<option value="true" {if $processor_params.postcode_mandatory == "true"}selected="selected"{/if}>{$lang.yes}</option>
		<option value="false" {if $processor_params.postcode_mandatory == "false"}selected="selected"{/if}>{$lang.no}</option>
	</select>
</div>