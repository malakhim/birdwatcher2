{$lang.processor_description_p21}
<hr/>

<div class="form-field">
	<label for="merchant_id">{$lang.merchant_id}:</label>
	<input type="text" name="payment_data[processor_params][merchant_id]" id="merchant_id" value="{$processor_params.merchant_id}" class="input-text" size="60" />
</div>

<div class="form-field">
	<label for="password">{$lang.password}:</label>
	<input type="password" name="payment_data[processor_params][password]" id="password" value="{$processor_params.password}" class="input-text"  size="60" />
</div>

<div class="form-field">
	<label for="ip_address">{$lang.ip_address}:</label>
	<input type="text" name="payment_data[processor_params][ip_address]" id="ip_address" value="{$processor_params.ip_address}" class="input-text"  size="60" />
</div>

<div class="form-field">
	<label for="company">{$lang.company}:</label>
	<input type="text" name="payment_data[processor_params][company]" id="company" value="{$processor_params.company}" class="input-text"  size="60" />
</div>