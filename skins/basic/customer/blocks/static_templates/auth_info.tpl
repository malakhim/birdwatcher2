<div class="login-info">
{if $controller == "auth" && $mode == "login_form"}
	{$lang.text_login_form}
	<a href="{"profiles.add"|fn_url}">{$lang.register_new_account}</a>
{elseif $controller == "auth" && $mode == "recover_password"}
	<h4>{$lang.text_recover_password_title}</h4>
	{$lang.text_recover_password}
{/if}
</div>