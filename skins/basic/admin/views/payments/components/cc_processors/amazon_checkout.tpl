{* Amazon general settings *}
{assign var="callback_url" value="`$config.https_location`/payments/amazon/amazon_callback.php"}
<p>{$lang.text_amazon_callback_url|replace:"[callback_url]":$callback_url}</p>
<p>{$lang.text_amazon_link_message}</p>
<p>{$lang.text_amazon_uk_warning}</p>
<hr />

<fieldset>
	<div class="form-field">
		<label for="merchant_id">{$lang.merchant_id}:</label>
		<input type="text" name="payment_data[processor_params][merchant_id]" id="merchant_id" value="{$processor_params.merchant_id}" class="input-text" size="60" />
	</div>
	<div class="form-field">
		<label for="aws_access_public_key">{$lang.lbl_amazon_aws_access_public_key}:</label>
		<input type="text" name="payment_data[processor_params][aws_access_public_key]" id="aws_access_public_key" value="{$processor_params.aws_access_public_key}" class="input-text" size="60" />
	</div>
	<div class="form-field">
		<label for="aws_secret_access_key">{$lang.lbl_amazon_aws_access_secret_key}:</label>
		<input type="text" name="payment_data[processor_params][aws_secret_access_key]" id="aws_secret_access_key" value="{$processor_params.aws_secret_access_key}" class="input-text" size="60" />
	</div>
	<div class="form-field">
		<label for="test">{$lang.currency}:</label>
		<select name="payment_data[processor_params][currency]" id="currency">
			<option value="USD" selected="selected">USD</option>
		</select>
	</div>
	<div class="form-field">
		<label for="test">{$lang.lbl_amazon_process_order_on_failure}:</label>
		<select name="payment_data[processor_params][process_on_failure]" id="test">
			<option value="N" {if $processor_params.process_on_failure == "N"}selected="selected"{/if}>{$lang.no}</option>
			<option value="Y" {if $processor_params.process_on_failure == "Y"}selected="selected"{/if}>{$lang.yes}</option>
		</select>
	</div>
	<div class="form-field">
		<label for="test">{$lang.test_live_mode}:</label>
		<select name="payment_data[processor_params][test]" id="test">
			<option value="N" {if $processor_params.test == "N"}selected="selected"{/if}>{$lang.live}</option>
			<option value="Y" {if $processor_params.test == "Y"}selected="selected"{/if}>{$lang.test}</option>
		</select>
	</div>
</fieldset>

{* Amazon button style *}
<fieldset>
{include file="common_templates/subheader.tpl" title=$lang.lbl_amazon_button_style}
	<div class="form-field">
		<label for="background_color">{$lang.lbl_amazon_background_color}:</label>
		<select name="payment_data[processor_params][button_background]" id="background_color">
			<option value="white" {if $processor_params.button_background == "white"}selected="selected"{/if}>{$lang.lbl_amazon_color_white}</option>
			<option value="light" {if $processor_params.button_background == "light"}selected="selected"{/if}>{$lang.lbl_amazon_color_light}</option>
			<option value="dark" {if $processor_params.button_background == "dark"}selected="selected"{/if}>{$lang.lbl_amazon_color_dark}</option>
		</select>
	</div>
	<div class="form-field">
		<label for="button_color">{$lang.lbl_amazon_button_color}:</label>
		<select name="payment_data[processor_params][button_color]" id="button_color">
			<option value="orange" {if $processor_params.button_color == "orange"}selected="selected"{/if}>{$lang.lbl_amazon_color_orange}</option>
			<option value="tan" {if $processor_params.button_color == "tan"}selected="selected"{/if}>{$lang.lbl_amazon_color_tan}</option>
		</select>
	</div>
	<div class="form-field">
		<label for="button_size">{$lang.lbl_amazon_button_size}:</label>
		<select name="payment_data[processor_params][button_size]" id="button_size">
			<option value="x-large" {if $processor_params.button_size == "x-large"}selected="selected"{/if}>{$lang.lbl_amazon_size_xlarge}</option>
			<option value="large" {if $processor_params.button_size == "large"}selected="selected"{/if}>{$lang.lbl_amazon_size_large}</option>
			<option value="medium" {if $processor_params.button_size == "medium"}selected="selected"{/if}>{$lang.lbl_amazon_size_medium}</option>
		</select>
	</div>
</fieldset>