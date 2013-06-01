<div class="login-wrap">
<h1 class="clear">
	<a href="{$index_script|fn_url}" class="float-left">{$settings.Company.company_name|truncate:40:'...':true}</a>
	<span>{$lang.administration_panel}</span>
</h1>
<form action="{$config.current_location}/{$index_script}" method="post" name="main_login_form" class="cm-form-highlight cm-skip-check-items">
<input type="hidden" name="return_url" value="{$smarty.request.return_url|default:$index_script}" />



<div class="login-content">
	<div class="clear-form-field">
		<p><label for="username" class="cm-required {if $settings.General.use_email_as_login == "Y"}cm-email{/if}">{if $settings.General.use_email_as_login == "Y"}{$lang.email}{else}{$lang.username}{/if}:</label></p>
		<input id="username" type="text" name="user_login" size="20" value="{$config.demo_username}" class="input-text cm-focus" tabindex="1" />
	</div>
	<div class="clear-form-field">
		<p><label for="password" class="cm-required">{$lang.password}:</label></p>
		<input type="password" id="password" name="password" size="20" value="{$config.demo_password}" class="input-text" tabindex="2" maxlength="32" />
	</div>
	<div class="buttons-container nowrap">
		<div class="float-left">
			{include file="buttons/sign_in.tpl" but_name="dispatch[auth.login]" but_role="button_main" tabindex="3"}
		</div>

		<div class="float-right">
			<a href="{"auth.recover_password"|fn_url}" class="underlined">{$lang.forgot_password_question}</a>
		</div>
	</div>
</div>
</form>
</div>