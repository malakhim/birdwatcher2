{* $Id: login_form.tpl 12290 2011-04-19 10:18:07Z bimib $ *}

{assign var="form_name" value=$form_name|default:main_login_form}

{capture name="login"}
{if $id != "checkout" && $style != "popup"}
	<div class="form-wrap-l"></div>
	<div class="form-wrap-r"></div>
{/if}
<form name="{$form_name}" action="{""|fn_url}" method="post">
<input type="hidden" name="form_name" value="{$form_name}" />
<input type="hidden" name="return_url" value="{$smarty.request.return_url|default:$config.current_url}" />
{if $id == "checkout"}
	<div class="checkout-login-form">{include file="common_templates/subheader.tpl" title=$lang.returning_customer}
{/if}
			<div class="form-field">
				<label for="login_{$id}" class="cm-required cm-trim{if $settings.General.use_email_as_login == "Y"} cm-email{/if}">{if $settings.General.use_email_as_login == "Y"}{$lang.email}{else}{$lang.username}{/if}</label>
				<input type="text" id="login_{$id}" name="user_login" size="30" value="{$config.demo_username}" class="input-text" />
			</div>

			<div class="form-field password">
				<label for="psw_{$id}" class="forgot-password-label cm-required">{$lang.password}</label><a href="{"auth.recover_password"|fn_url}" class="forgot-password"  tabindex="5">{$lang.forgot_password_question}</a>
				<input type="password" id="psw_{$id}" name="password" size="30" value="{$config.demo_password}" class="input-text" maxlength="32" />
			</div>

			{if $settings.Image_verification.use_for_login == "Y"}
				{include file="common_templates/image_verification.tpl" id="login_`$form_name`" align="left"}
			{/if}

{if $id == "checkout"}
		</div>
	<div class="clear-both"></div>
	<div class="checkout-buttons clearfix">
{/if}
	{hook name="index:login_buttons"}
		{if $id != "checkout"}
			<div class="{if $style == "popup"}buttons-container{/if}">
		{/if}
			<div class="body-bc clearfix">
				<div class="float-right">
					{include file="buttons/login.tpl" but_name="dispatch[auth.login]" but_role="submit"}
				</div>
				<div class="remember-me-chekbox">
					<label for="remember_me_{$id}" class="valign lowercase"><input class="valign checkbox" type="checkbox" name="remember_me" id="remember_me_{$id}" value="Y" />{$lang.remember_me}</label>
				</div>
			</div>
		{if $id != "checkout"}
			</div>
		{/if}
	{/hook}
{if $id == "checkout"}
	</div>
{/if}

</form>
{/capture}

{if $style == "popup"}
	{$smarty.capture.login}
{else}
	<div{if $controller != "checkout"} class="{if $style != "popup"}form-wrap{/if} login"{/if}>
		{$smarty.capture.login}
	</div>

	{capture name="mainbox_title"}{$lang.sign_in}{/capture}
{/if}
