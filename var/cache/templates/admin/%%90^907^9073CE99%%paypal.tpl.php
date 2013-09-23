<?php /* Smarty version 2.6.18, created on 2013-09-21 20:13:41
         compiled from views/payments/components/cc_processors/paypal.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'fn_get_statuses', 'views/payments/components/cc_processors/paypal.tpl', 60, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('account','paypal_item_name','currency','currency_code_cad','currency_code_eur','currency_code_gbp','currency_code_usd','currency_code_jpy','currency_code_aud','currency_code_nzd','currency_code_chf','currency_code_hkd','currency_code_sgd','currency_code_sek','currency_code_dkk','currency_code_pln','currency_code_nok','currency_code_huf','currency_code_czk','currency_code_ils','currency_code_mxn','currency_code_brl','currency_code_myr','currency_code_php','currency_code_twd','currency_code_thb','currency_code_try','test_live_mode','test','live','order_prefix','see_demo','text_paypal_status_map','refunded','completed','pending','canceled_reversal','created','denied','expired','reversed','processed','voided'));
?>
<div class="form-field">
	<label for="account"><?php echo fn_get_lang_var('account', $this->getLanguage()); ?>
:</label>
	<input type="text" name="payment_data[processor_params][account]" id="account" value="<?php echo $this->_tpl_vars['processor_params']['account']; ?>
" class="input-text" />
</div>

<div class="form-field">
	<label for="item_name"><?php echo fn_get_lang_var('paypal_item_name', $this->getLanguage()); ?>
:</label>
	<input type="text" name="payment_data[processor_params][item_name]" id="item_name" value="<?php echo $this->_tpl_vars['processor_params']['item_name']; ?>
" class="input-text" />
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
		<option value="HKD" <?php if ($this->_tpl_vars['processor_params']['currency'] == 'HKD'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('currency_code_hkd', $this->getLanguage()); ?>
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
		<option value="ILS" <?php if ($this->_tpl_vars['processor_params']['currency'] == 'ILS'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('currency_code_ils', $this->getLanguage()); ?>
</option>
		<option value="MXN" <?php if ($this->_tpl_vars['processor_params']['currency'] == 'MXN'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('currency_code_mxn', $this->getLanguage()); ?>
</option>
		<option value="BRL" <?php if ($this->_tpl_vars['processor_params']['currency'] == 'BRL'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('currency_code_brl', $this->getLanguage()); ?>
</option>
		<option value="MYR" <?php if ($this->_tpl_vars['processor_params']['currency'] == 'MYR'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('currency_code_myr', $this->getLanguage()); ?>
</option>
		<option value="PHP" <?php if ($this->_tpl_vars['processor_params']['currency'] == 'PHP'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('currency_code_php', $this->getLanguage()); ?>
</option>
		<option value="TWD" <?php if ($this->_tpl_vars['processor_params']['currency'] == 'TWD'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('currency_code_twd', $this->getLanguage()); ?>
</option>
		<option value="THB" <?php if ($this->_tpl_vars['processor_params']['currency'] == 'THB'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('currency_code_thb', $this->getLanguage()); ?>
</option>
		<option value="TRY" <?php if ($this->_tpl_vars['processor_params']['currency'] == 'TRY'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('currency_code_try', $this->getLanguage()); ?>
</option>
	</select>
</div>

<div class="form-field">
	<label for="mode"><?php echo fn_get_lang_var('test_live_mode', $this->getLanguage()); ?>
:</label>
	<select name="payment_data[processor_params][mode]" id="mode">
		<option value="test" <?php if ($this->_tpl_vars['processor_params']['mode'] == 'test'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('test', $this->getLanguage()); ?>
</option>
		<option value="live" <?php if ($this->_tpl_vars['processor_params']['mode'] == 'live'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('live', $this->getLanguage()); ?>
</option>
	</select>
</div>

<div class="form-field">
	<label for="order_prefix"><?php echo fn_get_lang_var('order_prefix', $this->getLanguage()); ?>
:</label>
	<input type="text" name="payment_data[processor_params][order_prefix]" id="order_prefix" value="<?php echo $this->_tpl_vars['processor_params']['order_prefix']; ?>
" class="input-text" />
</div>

<p>
<?php echo fn_get_lang_var('see_demo', $this->getLanguage()); ?>
: <a href="http://www.paypal-marketing.com/html/partner/portal/standard.html">http://www.paypal-marketing.com/html/partner/portal/standard.html</a>
</p>

<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/subheader.tpl", 'smarty_include_vars' => array('title' => fn_get_lang_var('text_paypal_status_map', $this->getLanguage()))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php $this->assign('statuses', fn_get_statuses(@STATUSES_ORDER, true), false); ?>

<div class="form-field">
	<label for="elm_paypal_refunded"><?php echo fn_get_lang_var('refunded', $this->getLanguage()); ?>
:</label>
	<select name="payment_data[processor_params][statuses][refunded]" id="elm_paypal_refunded">
		<?php $_from = $this->_tpl_vars['statuses']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['s']):
?>
		<option value="<?php echo $this->_tpl_vars['k']; ?>
" <?php if (( isset ( $this->_tpl_vars['processor_params']['statuses']['refunded'] ) && $this->_tpl_vars['processor_params']['statuses']['refunded'] == $this->_tpl_vars['k'] ) || ( ! isset ( $this->_tpl_vars['processor_params']['statuses']['refunded'] ) && $this->_tpl_vars['k'] == 'I' )): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['s']; ?>
</option>
		<?php endforeach; endif; unset($_from); ?>
	</select>
</div>

<div class="form-field">
	<label for="elm_paypal_completed"><?php echo fn_get_lang_var('completed', $this->getLanguage()); ?>
:</label>
	<select name="payment_data[processor_params][statuses][completed]" id="elm_paypal_completed">
		<?php $_from = $this->_tpl_vars['statuses']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['s']):
?>
		<option value="<?php echo $this->_tpl_vars['k']; ?>
" <?php if (( isset ( $this->_tpl_vars['processor_params']['statuses']['completed'] ) && $this->_tpl_vars['processor_params']['statuses']['completed'] == $this->_tpl_vars['k'] ) || ( ! isset ( $this->_tpl_vars['processor_params']['statuses']['completed'] ) && $this->_tpl_vars['k'] == 'P' )): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['s']; ?>
</option>
		<?php endforeach; endif; unset($_from); ?>
	</select>
</div>

<div class="form-field">
	<label for="elm_paypal_pending"><?php echo fn_get_lang_var('pending', $this->getLanguage()); ?>
:</label>
	<select name="payment_data[processor_params][statuses][pending]" id="elm_paypal_pending">
		<?php $_from = $this->_tpl_vars['statuses']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['s']):
?>
		<option value="<?php echo $this->_tpl_vars['k']; ?>
" <?php if (( isset ( $this->_tpl_vars['processor_params']['statuses']['pending'] ) && $this->_tpl_vars['processor_params']['statuses']['pending'] == $this->_tpl_vars['k'] ) || ( ! isset ( $this->_tpl_vars['processor_params']['statuses']['pending'] ) && $this->_tpl_vars['k'] == 'O' )): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['s']; ?>
</option>
		<?php endforeach; endif; unset($_from); ?>
	</select>
</div>

<div class="form-field">
	<label for="elm_paypal_canceled_reversal"><?php echo fn_get_lang_var('canceled_reversal', $this->getLanguage()); ?>
:</label>
	<select name="payment_data[processor_params][statuses][canceled_reversal]" id="elm_paypal_canceled_reversal">
		<?php $_from = $this->_tpl_vars['statuses']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['s']):
?>
		<option value="<?php echo $this->_tpl_vars['k']; ?>
" <?php if (( isset ( $this->_tpl_vars['processor_params']['statuses']['canceled_reversal'] ) && $this->_tpl_vars['processor_params']['statuses']['canceled_reversal'] == $this->_tpl_vars['k'] ) || ( ! isset ( $this->_tpl_vars['processor_params']['statuses']['canceled_reversal'] ) && $this->_tpl_vars['k'] == 'I' )): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['s']; ?>
</option>
		<?php endforeach; endif; unset($_from); ?>
	</select>
</div>

<div class="form-field">
	<label for="elm_paypal_created"><?php echo fn_get_lang_var('created', $this->getLanguage()); ?>
:</label>
	<select name="payment_data[processor_params][statuses][created]" id="elm_paypal_created">
		<?php $_from = $this->_tpl_vars['statuses']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['s']):
?>
		<option value="<?php echo $this->_tpl_vars['k']; ?>
" <?php if (( isset ( $this->_tpl_vars['processor_params']['statuses']['created'] ) && $this->_tpl_vars['processor_params']['statuses']['created'] == $this->_tpl_vars['k'] ) || ( ! isset ( $this->_tpl_vars['processor_params']['statuses']['created'] ) && $this->_tpl_vars['k'] == 'O' )): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['s']; ?>
</option>
		<?php endforeach; endif; unset($_from); ?>
	</select>
</div>

<div class="form-field">
	<label for="elm_paypal_denied"><?php echo fn_get_lang_var('denied', $this->getLanguage()); ?>
:</label>
	<select name="payment_data[processor_params][statuses][denied]" id="elm_paypal_denied">
		<?php $_from = $this->_tpl_vars['statuses']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['s']):
?>
		<option value="<?php echo $this->_tpl_vars['k']; ?>
" <?php if (( isset ( $this->_tpl_vars['processor_params']['statuses']['denied'] ) && $this->_tpl_vars['processor_params']['statuses']['denied'] == $this->_tpl_vars['k'] ) || ( ! isset ( $this->_tpl_vars['processor_params']['statuses']['denied'] ) && $this->_tpl_vars['k'] == 'I' )): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['s']; ?>
</option>
		<?php endforeach; endif; unset($_from); ?>
	</select>
</div>

<div class="form-field">
	<label for="elm_paypal_expired"><?php echo fn_get_lang_var('expired', $this->getLanguage()); ?>
:</label>
	<select name="payment_data[processor_params][statuses][expired]" id="elm_paypal_expired">
		<?php $_from = $this->_tpl_vars['statuses']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['s']):
?>
		<option value="<?php echo $this->_tpl_vars['k']; ?>
" <?php if (( isset ( $this->_tpl_vars['processor_params']['statuses']['expired'] ) && $this->_tpl_vars['processor_params']['statuses']['expired'] == $this->_tpl_vars['k'] ) || ( ! isset ( $this->_tpl_vars['processor_params']['statuses']['expired'] ) && $this->_tpl_vars['k'] == 'F' )): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['s']; ?>
</option>
		<?php endforeach; endif; unset($_from); ?>
	</select>
</div>

<div class="form-field">
	<label for="elm_paypal_reversed"><?php echo fn_get_lang_var('reversed', $this->getLanguage()); ?>
:</label>
	<select name="payment_data[processor_params][statuses][reversed]" id="elm_paypal_reversed">
		<?php $_from = $this->_tpl_vars['statuses']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['s']):
?>
		<option value="<?php echo $this->_tpl_vars['k']; ?>
" <?php if (( isset ( $this->_tpl_vars['processor_params']['statuses']['reversed'] ) && $this->_tpl_vars['processor_params']['statuses']['reversed'] == $this->_tpl_vars['k'] ) || ( ! isset ( $this->_tpl_vars['processor_params']['statuses']['reversed'] ) && $this->_tpl_vars['k'] == 'I' )): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['s']; ?>
</option>
		<?php endforeach; endif; unset($_from); ?>
	</select>
</div>

<div class="form-field">
	<label for="elm_paypal_processed"><?php echo fn_get_lang_var('processed', $this->getLanguage()); ?>
:</label>
	<select name="payment_data[processor_params][statuses][processed]" id="elm_paypal_processed">
		<?php $_from = $this->_tpl_vars['statuses']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['s']):
?>
		<option value="<?php echo $this->_tpl_vars['k']; ?>
" <?php if (( isset ( $this->_tpl_vars['processor_params']['statuses']['processed'] ) && $this->_tpl_vars['processor_params']['statuses']['processed'] == $this->_tpl_vars['k'] ) || ( ! isset ( $this->_tpl_vars['processor_params']['statuses']['processed'] ) && $this->_tpl_vars['k'] == 'P' )): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['s']; ?>
</option>
		<?php endforeach; endif; unset($_from); ?>
	</select>
</div>

<div class="form-field">
	<label for="elm_paypal_voided"><?php echo fn_get_lang_var('voided', $this->getLanguage()); ?>
:</label>
	<select name="payment_data[processor_params][statuses][voided]" id="elm_paypal_voided">
		<?php $_from = $this->_tpl_vars['statuses']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['s']):
?>
		<option value="<?php echo $this->_tpl_vars['k']; ?>
" <?php if (( isset ( $this->_tpl_vars['processor_params']['statuses']['voided'] ) && $this->_tpl_vars['processor_params']['statuses']['voided'] == $this->_tpl_vars['k'] ) || ( ! isset ( $this->_tpl_vars['processor_params']['statuses']['voided'] ) && $this->_tpl_vars['k'] == 'O' )): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['s']; ?>
</option>
		<?php endforeach; endif; unset($_from); ?>
	</select>
</div>