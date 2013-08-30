<?php /* Smarty version 2.6.18, created on 2013-08-30 13:09:37
         compiled from addons/bundled_products/hooks/checkout/product_info.post.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'addons/bundled_products/hooks/checkout/product_info.post.tpl', 34, false),array('modifier', 'fn_url', 'addons/bundled_products/hooks/checkout/product_info.post.tpl', 36, false),array('modifier', 'format_price', 'addons/bundled_products/hooks/checkout/product_info.post.tpl', 57, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('bundled_products','bundled_products','product','price','quantity','subtotal'));
?>
<?php  ob_start();  ?><?php 

				$rname = !empty($resource_name) ? $resource_name : $params['smarty_include_tpl_file'];
				if ($this->compile_check && empty($inline_no_check[$rname]) && $this->is_cached($rname)) {
					if ($this->check_inline_blocks(array (
  'common_templates/price.tpl' => 1367063745,
))) {
						$_smarty_compile_path = $this->_get_compile_path($rname);
						$this->_compile_resource($rname, $_smarty_compile_path);
						$inline_no_check[$rname] = true;
						include $_smarty_compile_path;
						return;
					}
				}
			 ?><?php if ($this->_tpl_vars['cart']['products'][$this->_tpl_vars['key']]['extra']['bundled_products']): ?>
<?php $_from = $this->_tpl_vars['cart_products']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key_conf'] => $this->_tpl_vars['_product']):
?>
	<?php if ($this->_tpl_vars['cart']['products'][$this->_tpl_vars['key_conf']]['extra']['parent']['bundled_products'] == $this->_tpl_vars['key']): ?>
		<?php ob_start(); ?>1<?php $this->_smarty_vars['capture']['is_conf_prod'] = ob_get_contents(); ob_end_clean(); ?>
	<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>

<?php if ($this->_smarty_vars['capture']['is_conf_prod']): ?>
	<p><a rev="bundled_products_<?php echo $this->_tpl_vars['key']; ?>
" class="cm-dialog-opener cm-dialog-auto-size"><?php echo fn_get_lang_var('bundled_products', $this->getLanguage()); ?>
</a></p>
	<div class="product-options hidden" id="bundled_products_<?php echo $this->_tpl_vars['key']; ?>
" title="<?php echo fn_get_lang_var('bundled_products', $this->getLanguage()); ?>
">
	<table cellpadding="0" cellspacing="0" border="0" width="85%" class="table margin-top cart-configuration">
		<tr>
			<th width="50%"><?php echo fn_get_lang_var('product', $this->getLanguage()); ?>
</th>
			<th width="10%"><?php echo fn_get_lang_var('price', $this->getLanguage()); ?>
</th>
			<th width="10%"><?php echo fn_get_lang_var('quantity', $this->getLanguage()); ?>
</th>
			<th class="right" width="10%"><?php echo fn_get_lang_var('subtotal', $this->getLanguage()); ?>
</th>
		</tr>
		<?php $_from = $this->_tpl_vars['cart_products']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key_conf'] => $this->_tpl_vars['_product']):
?>
		<?php if ($this->_tpl_vars['cart']['products'][$this->_tpl_vars['key_conf']]['extra']['parent']['bundled_products'] == $this->_tpl_vars['key']): ?>
		<tr <?php echo smarty_function_cycle(array('values' => ",class=\"table-row\""), $this);?>
>
			<td>
				<a href="<?php echo fn_url("products.view?product_id=".($this->_tpl_vars['_product']['product_id'])); ?>
" class="underlined"><?php echo $this->_tpl_vars['_product']['product']; ?>
</a><br />
				<?php if ($this->_tpl_vars['_product']['product_options']): ?>
					<?php $_from = $this->_tpl_vars['_product']['product_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['option']):
?>
						<strong><?php echo $this->_tpl_vars['option']['option_name']; ?>
</strong>:&nbsp;
						<?php if ($this->_tpl_vars['option']['option_type'] == 'F'): ?>
							<?php if ($this->_tpl_vars['_product']['extra']['custom_files'][$this->_tpl_vars['option']['option_id']]): ?>
								<?php $_from = $this->_tpl_vars['_product']['extra']['custom_files'][$this->_tpl_vars['option']['option_id']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['po_files'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['po_files']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['file_id'] => $this->_tpl_vars['file']):
        $this->_foreach['po_files']['iteration']++;
?>
									<a href="<?php echo fn_url("checkout.get_custom_file?cart_id=".($this->_tpl_vars['key_conf'])."&amp;file=".($this->_tpl_vars['file_id'])."&amp;option_id=".($this->_tpl_vars['option']['option_id'])); ?>
"><?php echo $this->_tpl_vars['file']['name']; ?>
</a>
									<?php if (! ($this->_foreach['po_files']['iteration'] == $this->_foreach['po_files']['total'])): ?>,&nbsp;<?php endif; ?>
								<?php endforeach; endif; unset($_from); ?>
							<?php endif; ?>
						<?php else: ?>
							<?php echo $this->_tpl_vars['option']['variants'][$this->_tpl_vars['option']['value']]['variant_name']; ?>

						<?php endif; ?>
						<br />
					<?php endforeach; endif; unset($_from); ?>
				<?php endif; ?>
			</td>
			<td class="center">
				<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('value' => $this->_tpl_vars['_product']['price'], )); ?><?php echo ''; ?><?php if ($this->_tpl_vars['settings']['General']['alternative_currency'] == 'Y'): ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['primary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], false); ?><?php echo ''; ?><?php if ($this->_tpl_vars['secondary_currency'] != $this->_tpl_vars['primary_currency']): ?><?php echo '&nbsp;'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo '('; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true, $this->_tpl_vars['is_integer']); ?><?php echo ''; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo ')'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?></td>
			<td class="center">
				<input type="hidden" name="cart_products[<?php echo $this->_tpl_vars['key_conf']; ?>
][product_id]" value="<?php echo $this->_tpl_vars['_product']['product_id']; ?>
" />
				<?php echo $this->_tpl_vars['_product']['amount']; ?>

			</td>
			<td class="right">
				<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('value' => $this->_tpl_vars['_product']['display_subtotal'], )); ?><?php echo ''; ?><?php if ($this->_tpl_vars['settings']['General']['alternative_currency'] == 'Y'): ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['primary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], false); ?><?php echo ''; ?><?php if ($this->_tpl_vars['secondary_currency'] != $this->_tpl_vars['primary_currency']): ?><?php echo '&nbsp;'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo '('; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true, $this->_tpl_vars['is_integer']); ?><?php echo ''; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo ')'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?></td>
			</tr>
		<?php endif; ?>
		<?php endforeach; endif; unset($_from); ?>
		<tr class="table-footer">
			<td colspan="4">&nbsp;</td>
		</tr>
	</table>
</div>
<?php endif; ?>
<?php endif; ?><?php  ob_end_flush();  ?>