<div class="events events-private form-wrap">
	<div class="form-wrap-l"></div>
	<div class="form-wrap-r"></div>
<div class="events-private-wrap">
	<h4>{$lang.get_access_key}</h4>
	<form action="{""|fn_url}" method="post" name="key_request_form">
	<div class="form-field-body">
		<div class="form-field">
			<label for="email" class="cm-email cm-required">{$lang.email}</label>
			<input class="input-text" type="text" id="email" name="email" size="40" value="" />
		</div>
		<span>{$lang.text_get_access_key_notice}</span>
	</div>
	<div class="buttons-container">
		{include file="buttons/button.tpl" but_text=$lang.get_access_key but_name="dispatch[events.request_access_key]"}
	</div>
</form>
</div>
</div>