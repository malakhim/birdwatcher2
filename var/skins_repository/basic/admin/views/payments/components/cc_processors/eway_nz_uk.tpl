<div class="form-field">
	<label for="gateway">{$lang.gateway}:</label>
	<select name="payment_data[processor_params][gateway]" id="gateway">
		<option value="payment" {if $processor_params.gateway == "payment"}selected="selected"{/if}>{$lang.united_kingdom}</option>
		<option value="nz" {if $processor_params.gateway == "nz"}selected="selected"{/if}>{$lang.new_zealand}</option>
	</select>
</div>

<div class="form-field">
	<label for="customer_id">{$lang.customer_id}:</label>
	<input type="text" name="payment_data[processor_params][customer_id]" id="customer_id" value="{$processor_params.customer_id}" class="input-text" />
</div>

<div class="form-field">
	<label for="username">{$lang.username}:</label>
	<input type="text" name="payment_data[processor_params][username]" id="username" value="{$processor_params.username}" class="input-text" />
</div>
