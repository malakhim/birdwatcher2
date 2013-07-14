<div class="form-field">
	<label for="merchant_id">{$lang.vendor_name}:</label>
	<input type="text" name="payment_data[processor_params][merchant_id]" id="merchant_id" value="{$processor_params.merchant_id}" class="input-text"  size="60" />
</div>

<div class="form-field">
	<label for="mode">{$lang.test_live_mode}:</label>
	<select name="payment_data[processor_params][mode]" id="mode">
		<option value="test"{if $processor_params.mode == 'test'} selected="selected"{/if}>{$lang.test}</option>
		<option value="live"{if $processor_params.mode == 'live'} selected="selected"{/if}>{$lang.live}</option>
	</select>
</div>