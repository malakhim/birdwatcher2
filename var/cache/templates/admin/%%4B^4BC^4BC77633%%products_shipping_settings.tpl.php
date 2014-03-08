<?php /* Smarty version 2.6.18, created on 2014-03-08 23:25:02
         compiled from views/products/components/products_shipping_settings.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'views/products/components/products_shipping_settings.tpl', 18, false),array('modifier', 'default', 'views/products/components/products_shipping_settings.tpl', 19, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('general','weight','tt_views_products_components_products_shipping_settings_weight','free_shipping','shipping_freight','items_in_box','tt_views_products_components_products_shipping_settings_items_in_box','box_length','box_width','box_height'));
?>
<?php 

				$rname = !empty($resource_name) ? $resource_name : $params['smarty_include_tpl_file'];
				if ($this->compile_check && empty($inline_no_check[$rname]) && $this->is_cached($rname)) {
					if ($this->check_inline_blocks(array (
  'common_templates/tooltip.tpl' => 1367063753,
))) {
						$_smarty_compile_path = $this->_get_compile_path($rname);
						$this->_compile_resource($rname, $_smarty_compile_path);
						$inline_no_check[$rname] = true;
						include $_smarty_compile_path;
						return;
					}
				}
			 ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/subheader.tpl", 'smarty_include_vars' => array('title' => fn_get_lang_var('general', $this->getLanguage()))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div class="form-field">
	<label for="product_weight"><?php echo fn_get_lang_var('weight', $this->getLanguage()); ?>
 (<?php echo $this->_tpl_vars['settings']['General']['weight_symbol']; ?>
)<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('tooltip' => fn_get_lang_var('tt_views_products_components_products_shipping_settings_weight', $this->getLanguage()), )); ?><?php if ($this->_tpl_vars['tooltip']): ?> (<a class="cm-tooltip<?php if ($this->_tpl_vars['params']): ?> <?php echo $this->_tpl_vars['params']; ?>
<?php endif; ?>" title="<?php echo smarty_modifier_escape($this->_tpl_vars['tooltip'], 'html'); ?>
">?</a>)<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>:</label>
	<input type="text" name="product_data[weight]" id="product_weight" size="10" value="<?php echo smarty_modifier_default(@$this->_tpl_vars['product_data']['weight'], '0'); ?>
" class="input-text-medium" />
</div>

<div class="form-field">
	<label for="product_free_shipping"><?php echo fn_get_lang_var('free_shipping', $this->getLanguage()); ?>
:</label>
	<input type="hidden" name="product_data[free_shipping]" value="N" />
	<input type="checkbox" name="product_data[free_shipping]" id="product_free_shipping" value="Y" <?php if ($this->_tpl_vars['product_data']['free_shipping'] == 'Y'): ?>checked="checked"<?php endif; ?> class="checkbox" />
</div>

<div class="form-field">
	<label for="product_shipping_freight"><?php echo fn_get_lang_var('shipping_freight', $this->getLanguage()); ?>
 (<?php echo $this->_tpl_vars['currencies'][$this->_tpl_vars['primary_currency']]['symbol']; ?>
):</label>
	<input type="text" name="product_data[shipping_freight]" id="product_shipping_freight" size="10" value="<?php echo smarty_modifier_default(@$this->_tpl_vars['product_data']['shipping_freight'], "0.00"); ?>
" class="input-text-medium" />
</div>

<div class="form-field">
	<label for="product_items_in_box"><?php echo fn_get_lang_var('items_in_box', $this->getLanguage()); ?>
<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('tooltip' => fn_get_lang_var('tt_views_products_components_products_shipping_settings_items_in_box', $this->getLanguage()), )); ?><?php if ($this->_tpl_vars['tooltip']): ?> (<a class="cm-tooltip<?php if ($this->_tpl_vars['params']): ?> <?php echo $this->_tpl_vars['params']; ?>
<?php endif; ?>" title="<?php echo smarty_modifier_escape($this->_tpl_vars['tooltip'], 'html'); ?>
">?</a>)<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>:</label>
	<input type="text" name="product_data[min_items_in_box]" id="product_items_in_box" size="5" value="<?php echo smarty_modifier_default(@$this->_tpl_vars['product_data']['min_items_in_box'], '0'); ?>
" class="input-text" onkeyup="fn_product_shipping_settings(this);" />
	&nbsp;-&nbsp;
	<input type="text" name="product_data[max_items_in_box]" size="5" value="<?php echo smarty_modifier_default(@$this->_tpl_vars['product_data']['max_items_in_box'], '0'); ?>
" class="input-text" onkeyup="fn_product_shipping_settings(this);" />
	
	<?php if ($this->_tpl_vars['product_data']['min_items_in_box'] > 0 || $this->_tpl_vars['product_data']['max_items_in_box']): ?>
		<?php $this->assign('box_settings', true, false); ?>
	<?php endif; ?>
</div>

<div class="form-field">
	<label for="product_box_length"><?php echo fn_get_lang_var('box_length', $this->getLanguage()); ?>
:</label>
	<input type="text" name="product_data[box_length]" id="product_box_length" size="10" value="<?php echo smarty_modifier_default(@$this->_tpl_vars['product_data']['box_length'], '0'); ?>
" class="input-text-medium shipping-dependence" <?php if (! $this->_tpl_vars['box_settings']): ?>disabled="disabled"<?php endif; ?> />
</div>

<div class="form-field">
	<label for="product_box_width"><?php echo fn_get_lang_var('box_width', $this->getLanguage()); ?>
:</label>
	<input type="text" name="product_data[box_width]" id="product_box_width" size="10" value="<?php echo smarty_modifier_default(@$this->_tpl_vars['product_data']['box_width'], '0'); ?>
" class="input-text-medium shipping-dependence" <?php if (! $this->_tpl_vars['box_settings']): ?>disabled="disabled"<?php endif; ?> />
</div>

<div class="form-field">
	<label for="product_box_height"><?php echo fn_get_lang_var('box_height', $this->getLanguage()); ?>
:</label>
	<input type="text" name="product_data[box_height]" id="product_box_height" size="10" value="<?php echo smarty_modifier_default(@$this->_tpl_vars['product_data']['box_height'], '0'); ?>
" class="input-text-medium shipping-dependence" <?php if (! $this->_tpl_vars['box_settings']): ?>disabled="disabled"<?php endif; ?> />
</div>

<script type="text/javascript">
//<![CDATA[
<?php echo '
function fn_product_shipping_settings(elm)
{
	var jelm = $(elm);
	var available = false;
	
	$(\'input\', jelm.parent()).each(function() {
		if (parseInt($(this).val()) > 0) {
			available = true;
		}
	});
	
	$(\'input.shipping-dependence\').attr(\'disabled\', (available ? false : true));
	
}

'; ?>

//]]>
</script>