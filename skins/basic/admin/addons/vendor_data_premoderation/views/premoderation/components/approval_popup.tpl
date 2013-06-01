<div class="form-field">
	<input type="hidden" name="{$name}[company_id]" value="{$company_id}" />
	<input type="hidden" name="{$name}[product_id]" value="{$product_id}" />
	<input type="hidden" name="{$name}[status]" value="{$status}" />
	<label for="{$name}">{$lang.reason}:</label>
	<textarea name="{$name}[reason_{$status}]" id="{$name}" cols="50" rows="4" class="input-text"></textarea>
</div>

<div class="cm-toggle-button">
	<div class="select-field notify-customer">
		<input type="checkbox" name="{$name}[notify_user_{$status}]" id="notify_user_{$product_id}" value="Y" class="checkbox" checked="checked" />
		<label for="notify_user_{$product_id}">{$lang.notify_vendor_by_email}</label>
	</div>
</div>