{if $addons.directebanking.status == 'A'}
<br />
<a href="{$index_script}?dispatch=directebanking.update&payment_id={$payment_id}">{$lang.create_account_in_directebanking_system}</a>
<br />
{/if}

{assign var="success_url" value="`$config.http_location`/`$config.customer_index`?dispatch=payment_notification.success&payment=directebanking&order_id=-USER_VARIABLE_0-"}
{assign var="abort_url" value="`$config.http_location`/`$config.customer_index`?dispatch=payment_notification.abort&payment=directebanking&order_id=-USER_VARIABLE_0-"}
{assign var="notification_url" value="`$config.http_location`/`$config.customer_index`?dispatch=payment_notification.notification&payment=directebanking&order_id=-USER_VARIABLE_0-"}

<p>{$lang.text_directebanking_notice|replace:"[success_url]":$success_url|replace:"[abort_url]":$abort_url|replace:"[notification_url]":$notification_url}</p>

{*
Set 'Success link' to: <b>[success_url]</b><br />
Set 'Abort link' to: <b>[abort_url]</b><br />
Add new HTTP notifications and set 'Notification URL' to: <b>[notification_url]</b><br />
Activate input check and set 'Hash Algoritm' to the 'SHA1'<br />
*}

<hr />
<div class="form-field">
	<label for="user_id">{$lang.customer_id}:</label>
	<input type="text" name="payment_data[processor_params][user_id]" id="user_id" value="{$processor_params.user_id}" class="input-text" size="60" />
</div>

<div class="form-field">
	<label for="project_id">{$lang.project_id}:</label>
	<input type="text" name="payment_data[processor_params][project_id]" id="project_id" value="{$processor_params.project_id}" class="input-text" size="60" />
</div>

<div class="form-field">
	<label for="language_id">{$lang.language}:</label>
	<select name="payment_data[processor_params][language_id]" id="language_id">
		<option value="DE"{if $processor_params.language_id eq "DE"} selected="selected"{/if}>DE</option>
		<option value="EN"{if $processor_params.language_id eq "EN"} selected="selected"{/if}>EN</option>
		<option value="NL"{if $processor_params.language_id eq "NL"} selected="selected"{/if}>NL</option>
		<option value="FR"{if $processor_params.language_id eq "FR"} selected="selected"{/if}>FR</option>
	</select>
</div>

<div class="form-field">
	<label for="currency_id">{$lang.currency}:</label>
	<select name="payment_data[processor_params][currency_id]" id="currency_id">
		<option value="EUR"{if $processor_params.currency_id eq "EUR"} selected="selected"{/if}>EUR</option>
		<option value="CHF"{if $processor_params.currency_id eq "CHF"} selected="selected"{/if}>CHF</option>
		<option value="GBP"{if $processor_params.currency_id eq "GBP"} selected="selected"{/if}>GBP</option>
	</select>
</div>

<div class="form-field">
	<label for="project_password">{$lang.project_password}:</label>
	<input type="text" name="payment_data[processor_params][project_password]" id="project_password" value="{$processor_params.project_password}" class="input-text" size="60" />
</div>