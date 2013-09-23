<?php /* Smarty version 2.6.18, created on 2013-09-21 20:04:50
         compiled from views/payments/components/cc_processors/paypal_express.tpl */ ?>
<?php
fn_preload_lang_vars(array('username','password','paypal_authentication_method','certificate','signature','certificate_filename','signature','send_shipping_address','currency','currency_code_cad','currency_code_eur','currency_code_gbp','currency_code_usd','currency_code_jpy','currency_code_aud','currency_code_nzd','currency_code_chf','currency_code_sgd','currency_code_sek','currency_code_dkk','currency_code_pln','currency_code_nok','currency_code_huf','currency_code_czk','test_live_mode','test','live','order_prefix'));
?>
<?php  ob_start();  ?><div class="form-field">
	<label for="username"><?php echo fn_get_lang_var('username', $this->getLanguage()); ?>
:</label>
	<input type="text" name="payment_data[processor_params][username]" id="username" size="24" value="<?php echo $this->_tpl_vars['processor_params']['username']; ?>
" class="input-text"/>
</div>

<div class="form-field">
	<label for="password"><?php echo fn_get_lang_var('password', $this->getLanguage()); ?>
:</label>
	<input type="text" name="payment_data[processor_params][password]" id="password" size="24" value="<?php echo $this->_tpl_vars['processor_params']['password']; ?>
" class="input-text"/>
</div>

<div class="form-field">
	<label><?php echo fn_get_lang_var('paypal_authentication_method', $this->getLanguage()); ?>
:</label>
	<div class="select-field">
		<input id="elm_payment_auth_method_cert" class="radio" type="radio" value="cert" name="payment_data[processor_params][authentication_method]" <?php if ($this->_tpl_vars['processor_params']['authentication_method'] == 'cert' || ! $this->_tpl_vars['processor_params']['authentication_method']): ?> checked="checked"<?php endif; ?>/>
		<label for="elm_payment_auth_method_cert"><?php echo fn_get_lang_var('certificate', $this->getLanguage()); ?>
</label>
		<input id="elm_payment_auth_method_signature" class="radio" type="radio" value="signature" name="payment_data[processor_params][authentication_method]" <?php if ($this->_tpl_vars['processor_params']['authentication_method'] == 'signature'): ?> checked="checked"<?php endif; ?>/>
		<label for="elm_payment_auth_method_signature"><?php echo fn_get_lang_var('signature', $this->getLanguage()); ?>
</label>
	</div>
</div>

<div class="form-field">
	<label for="certificate"><?php echo fn_get_lang_var('certificate_filename', $this->getLanguage()); ?>
:</label>
	<?php echo @DIR_ROOT; ?>
/payments/certificates/<input type="text" name="payment_data[processor_params][certificate]" id="certificate" size="24" value="<?php echo $this->_tpl_vars['processor_params']['certificate']; ?>
" class="input-text" />
</div>

<div class="form-field">
	<label for="signature"><?php echo fn_get_lang_var('signature', $this->getLanguage()); ?>
:</label>
	<input type="text" name="payment_data[processor_params][signature]" id="signature" value="<?php echo $this->_tpl_vars['processor_params']['signature']; ?>
" class="input-text" />
</div>

<div class="form-field">
	<label for="send_adress"><?php echo fn_get_lang_var('send_shipping_address', $this->getLanguage()); ?>
:</label>
	<input type="checkbox" name="payment_data[processor_params][send_adress]" <?php if ($this->_tpl_vars['processor_params']['send_adress'] == 'Y'): ?>checked="checked"<?php endif; ?> id="send_adress" value="Y" />
</div>

<div class="form-field">
	<label for="currency"><?php echo fn_get_lang_var('currency', $this->getLanguage()); ?>
:</label>
	<select name="payment_data[processor_params][currency]" id="currency">
		<option value="CAD" <?php if ($this->_tpl_vars['processor_params']['currency'] == 'CAD'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('currency_code_cad', $this->getLanguage()); ?>
</option>
		<option value="EUR" <?php if ($this->_tpl_vars['processor_params']['currency'] == 'EUR'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('currency_code_eur', $this->getLanguage()); ?>
</option>
		<option value="GBP" <?php if ($this->_tpl_vars['processor_params']['currency'] == 'GBP'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('currency_code_gbp', $this->getLanguage()); ?>
</option>
		<option value="USD" <?php if ($this->_tpl_vars['processor_params']['currency'] == 'USD'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('currency_code_usd', $this->getLanguage()); ?>
</option>
		<option value="JPY" <?php if ($this->_tpl_vars['processor_params']['currency'] == 'JPY'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('currency_code_jpy', $this->getLanguage()); ?>
</option>
		<option value="AUD" <?php if ($this->_tpl_vars['processor_params']['currency'] == 'AUD'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('currency_code_aud', $this->getLanguage()); ?>
</option>
		<option value="NZD" <?php if ($this->_tpl_vars['processor_params']['currency'] == 'NZD'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('currency_code_nzd', $this->getLanguage()); ?>
</option>
		<option value="CHF" <?php if ($this->_tpl_vars['processor_params']['currency'] == 'CHF'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('currency_code_chf', $this->getLanguage()); ?>
</option>
		<option value="SGD" <?php if ($this->_tpl_vars['processor_params']['currency'] == 'SGD'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('currency_code_sgd', $this->getLanguage()); ?>
</option>
		<option value="SEK" <?php if ($this->_tpl_vars['processor_params']['currency'] == 'SEK'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('currency_code_sek', $this->getLanguage()); ?>
</option>
		<option value="DKK" <?php if ($this->_tpl_vars['processor_params']['currency'] == 'DKK'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('currency_code_dkk', $this->getLanguage()); ?>
</option>
		<option value="PLN" <?php if ($this->_tpl_vars['processor_params']['currency'] == 'PLN'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('currency_code_pln', $this->getLanguage()); ?>
</option>
		<option value="NOK" <?php if ($this->_tpl_vars['processor_params']['currency'] == 'NOK'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('currency_code_nok', $this->getLanguage()); ?>
</option>
		<option value="HUF" <?php if ($this->_tpl_vars['processor_params']['currency'] == 'HUF'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('currency_code_huf', $this->getLanguage()); ?>
</option>
		<option value="CZK" <?php if ($this->_tpl_vars['processor_params']['currency'] == 'CZK'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('currency_code_czk', $this->getLanguage()); ?>
</option>
	</select>
</div>

<div class="form-field">
	<label for="mode"><?php echo fn_get_lang_var('test_live_mode', $this->getLanguage()); ?>
:</label>
	<select name="payment_data[processor_params][mode]" id="mode">
		<option value="test" <?php if ($this->_tpl_vars['processor_params']['mode'] == 'test'): ?> selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('test', $this->getLanguage()); ?>
</option>
		<option value="live" <?php if ($this->_tpl_vars['processor_params']['mode'] == 'live'): ?> selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('live', $this->getLanguage()); ?>
</option>
	</select>
</div>

<div class="form-field">
	<label for="order_prefix"><?php echo fn_get_lang_var('order_prefix', $this->getLanguage()); ?>
:</label>
	<input type="text" name="payment_data[processor_params][order_prefix]" id="order_prefix" size="36" value="<?php echo $this->_tpl_vars['processor_params']['order_prefix']; ?>
" class="input-text" />
</div><?php  ob_end_flush();  ?>