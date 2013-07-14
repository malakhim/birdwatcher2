<div class="form-field">
	<label for="rb_manual_pay_email_subject" class="left description">{$lang.email_subject}:</label>
	<input id="rb_manual_pay_email_subject" class="input-text" type="text" value="{"rb_manual_pay_email_subject"|fn_get_lang_var:$smarty.const.DESCR_SL:true}" name="additional_notification_settings[rb_manual_pay_email_subject]">
</div>

<div class="form-field">
	<label for="rb_manual_pay_email_header" class="left description">{$lang.email_header}:</label>
	<textarea id="rb_manual_pay_email_header" class="input-textarea-long" rows="8" cols="55" name="additional_notification_settings[rb_manual_pay_email_header]">{"rb_manual_pay_email_header"|fn_get_lang_var:$smarty.const.DESCR_SL:true}</textarea>
</div>
