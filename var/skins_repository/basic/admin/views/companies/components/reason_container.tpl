<div class="form-field">
	<label>{$lang.reason}:</label>
	<textarea name="action_reason_{$type}" id="action_reason_{$type}" cols="50" rows="4" class="input-text"></textarea>
</div>
{if $smarty.const.PRODUCT_TYPE == "MULTIVENDOR" || $smarty.const.PRODUCT_TYPE == "ULTIMATE"}
<div class="cm-toggle-button">
	<div class="select-field notify-customer">
		<input type="hidden" name="action_notification" value="N" />
		<input type="checkbox" name="action_notification" id="action_notification" value="Y" class="checkbox" checked="checked" {if $mandatory_notification}disabled="disabled"{/if} />
		<label for="action_notification">{$lang.notify_vendors_by_email}</label>
	</div>
</div>
{/if}