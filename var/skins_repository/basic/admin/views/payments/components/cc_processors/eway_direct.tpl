<div class="form-field">
	<label for="ew_client_id">{$lang.client_id}:</label>
	<input type="text" name="payment_data[processor_params][client_id]" id="ew_client_id" value="{$processor_params.client_id}" class="input-text"  size="60" />
</div>

<div class="form-field">
	<label for="ew_order_prefix">{$lang.order_prefix}:</label>
	<input type="text" name="payment_data[processor_params][order_prefix]" id="ew_order_prefix" value="{$processor_params.order_prefix}" class="input-text" size="60" />
</div>

<div class="form-field">
	<label for="ew_include_cvn">{$lang.include_cvn}:</label>
	<input type="hidden" name="payment_data[processor_params][include_cvn]" value="false" />
	<input type="checkbox" name="payment_data[processor_params][include_cvn]" id="ew_include_cvn" value="true" {if $processor_params.include_cvn == "true"} checked="checked"{/if} />
	</div>

<div class="form-field">
	<label for="ew_test_mode">{$lang.test_live_mode}:</label>
	<select name="payment_data[processor_params][test]" id="ew_test_mode">
		<option value="Y" {if $processor_params.test == "Y"}selected="selected"{/if}>{$lang.test}</option>
		<option value="N" {if $processor_params.test == "N"}selected="selected"{/if}>{$lang.live}</option>
	</select>
</div>
