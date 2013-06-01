<div class="form-field">
	<label>{$lang.reason}:</label>
	<textarea name="action_reason_{$type}" id="action_reason_{$type}" cols="50" rows="4" class="input-text"></textarea>
</div>

<div class="cm-toggle-button">
	<div class="select-field notify-customer">
		<input type="checkbox" name="action_notification_{$type}" id="action_notification_{$type}" value="Y" class="checkbox" checked="checked" />
		<label for="action_notification_{$type}">{$lang.notify_vendors_by_email}</label>
	</div>
</div>