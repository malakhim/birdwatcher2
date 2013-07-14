<div class="login form-wrap">
	<div class="form-wrap-l"></div>
	<div class="form-wrap-r"></div>
<form name="recoverfrm" action="{""|fn_url}" method="post">
<div class="left">
	<div class="form-field">
		<label class="cm-trim" for="login_id">{$lang.email}</label>
		<input type="text" id="login_id" name="user_email" size="30" value="" class="input-text cm-focus" />
	</div>
	<div class="body-bc login-recovery">
		{include file="buttons/reset_password.tpl" but_name="dispatch[auth.recover_password]"}
	</div>
</div>
</form>
</div>
{capture name="mainbox_title"}{$lang.recover_password}{/capture}