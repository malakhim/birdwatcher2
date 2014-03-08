<?php /* Smarty version 2.6.18, created on 2014-03-08 23:37:22
         compiled from views/shippings/components/services/aup.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'views/shippings/components/services/aup.tpl', 5, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('max_box_weight','ship_width','ship_height','ship_length','ship_aup_use_delivery_confirmation','ship_aup_delivery_confirmation_cost','ship_aup_delivery_confirmation_international_cost','ship_aup_rpi_fee'));
?>
<?php  ob_start();  ?><fieldset>

<div class="form-field">
	<label for="max_weight"><?php echo fn_get_lang_var('max_box_weight', $this->getLanguage()); ?>
:</label>
	<input id="max_weight" type="text" name="shipping_data[params][max_weight_of_box]" size="30" value="<?php echo smarty_modifier_default(@$this->_tpl_vars['shipping']['params']['max_weight_of_box'], 0); ?>
" class="input-text" />
</div>

<div class="form-field">
	<label for="ship_width"><?php echo fn_get_lang_var('ship_width', $this->getLanguage()); ?>
:</label>
	<input id="ship_width" type="text" name="shipping_data[params][width]" size="30" value="<?php echo $this->_tpl_vars['shipping']['params']['width']; ?>
" class="input-text" />
</div>

<div class="form-field">
	<label for="ship_height"><?php echo fn_get_lang_var('ship_height', $this->getLanguage()); ?>
:</label>
	<input id="ship_height" type="text" name="shipping_data[params][height]" size="30" value="<?php echo $this->_tpl_vars['shipping']['params']['height']; ?>
" class="input-text" />
</div>

<div class="form-field">
	<label for="ship_length"><?php echo fn_get_lang_var('ship_length', $this->getLanguage()); ?>
:</label>
	<input id="ship_length" type="text" name="shipping_data[params][length]" size="30" value="<?php echo $this->_tpl_vars['shipping']['params']['length']; ?>
" class="input-text" />
</div>

<div class="form-field">
	<label for="ship_aup_use_delivery_confirmation"><?php echo fn_get_lang_var('ship_aup_use_delivery_confirmation', $this->getLanguage()); ?>
:</label>
	<input type="hidden" name="shipping_data[params][use_delivery_confirmation]" value="N" />
	<input id="ship_aup_use_delivery_confirmation" type="checkbox" name="shipping_data[params][use_delivery_confirmation]" value="Y" <?php if ($this->_tpl_vars['shipping']['params']['use_delivery_confirmation'] == 'Y'): ?>checked="checked"<?php endif; ?> class="checkbox" />
</div>

<div class="form-field">
	<label for="ship_aup_delivery_confirmation_cost"><?php echo fn_get_lang_var('ship_aup_delivery_confirmation_cost', $this->getLanguage()); ?>
:</label>
	<input id="ship_aup_delivery_confirmation_cost" type="text" name="shipping_data[params][delivery_confirmation_cost]" size="30" value="<?php echo $this->_tpl_vars['shipping']['params']['delivery_confirmation_cost']; ?>
" class="input-text" />
</div>

<div class="form-field">
	<label for="ship_aup_delivery_confirmation_international_cost"><?php echo fn_get_lang_var('ship_aup_delivery_confirmation_international_cost', $this->getLanguage()); ?>
:</label>
	<input id="ship_aup_delivery_confirmation_international_cost" type="text" name="shipping_data[params][delivery_confirmation_international_cost]" size="30" value="<?php echo $this->_tpl_vars['shipping']['params']['delivery_confirmation_international_cost']; ?>
" class="input-text" />
</div>

<div class="form-field">
	<label for="ship_aup_rpi_fee"><?php echo fn_get_lang_var('ship_aup_rpi_fee', $this->getLanguage()); ?>
:</label>
	<input id="ship_aup_rpi_fee" type="text" name="shipping_data[params][rpi_fee]" size="30" value="<?php echo $this->_tpl_vars['shipping']['params']['rpi_fee']; ?>
" class="input-text" />
</div>

</fieldset><?php  ob_end_flush();  ?>