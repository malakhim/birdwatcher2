<?php /* Smarty version 2.6.18, created on 2014-03-07 22:31:26
         compiled from addons/bundled_products/hooks/product_picker/table_column_options.post.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'addons/bundled_products/hooks/product_picker/table_column_options.post.tpl', 17, false),array('modifier', 'format_price', 'addons/bundled_products/hooks/product_picker/table_column_options.post.tpl', 20, false),array('modifier', 'unescape', 'addons/bundled_products/hooks/product_picker/table_column_options.post.tpl', 20, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('by_fixed','to_fixed','by_percentage','to_percentage','by_fixed','to_fixed','by_percentage','to_percentage'));
?>
<?php  ob_start();  ?><?php 

				$rname = !empty($resource_name) ? $resource_name : $params['smarty_include_tpl_file'];
				if ($this->compile_check && empty($inline_no_check[$rname]) && $this->is_cached($rname)) {
					if ($this->check_inline_blocks(array (
  'common_templates/price.tpl' => 1367063753,
))) {
						$_smarty_compile_path = $this->_get_compile_path($rname);
						$this->_compile_resource($rname, $_smarty_compile_path);
						$inline_no_check[$rname] = true;
						include $_smarty_compile_path;
						return;
					}
				}
			 ?><?php if (( $this->_tpl_vars['controller'] == 'bundled_products' || $this->_tpl_vars['extra_mode'] == 'bundled_products' ) && $this->_tpl_vars['product_info']): ?>
	<td>
		<input type="hidden" id="item_price_bp_<?php echo $this->_tpl_vars['item']['chain_id']; ?>
_<?php echo $this->_tpl_vars['delete_id']; ?>
" value="<?php echo smarty_modifier_default(@$this->_tpl_vars['product_info']['price'], 0); ?>
" />
		<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('value' => $this->_tpl_vars['product_info']['price'], )); ?><?php echo ''; ?><?php if ($this->_tpl_vars['settings']['General']['alternative_currency'] == 'Y'): ?><?php echo ''; ?><?php echo smarty_modifier_unescape(smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['primary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], false)); ?><?php echo ''; ?><?php if ($this->_tpl_vars['secondary_currency'] != $this->_tpl_vars['primary_currency']): ?><?php echo '&nbsp;'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo '('; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true, $this->_tpl_vars['is_integer']); ?><?php echo ''; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo ')'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php echo smarty_modifier_unescape(smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true)); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
	</td>
	<td>
		<select name="<?php echo $this->_tpl_vars['input_name']; ?>
[modifier_type]" id="item_modifier_type_bp_<?php echo $this->_tpl_vars['item']['chain_id']; ?>
_<?php echo $this->_tpl_vars['delete_id']; ?>
">
			<option value="by_fixed" <?php if ($this->_tpl_vars['product_info']['modifier_type'] == 'by_fixed'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('by_fixed', $this->getLanguage()); ?>
</option>
			<option value="to_fixed" <?php if ($this->_tpl_vars['product_info']['modifier_type'] == 'to_fixed'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('to_fixed', $this->getLanguage()); ?>
</option>
			<option value="by_percentage" <?php if ($this->_tpl_vars['product_info']['modifier_type'] == 'by_percentage'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('by_percentage', $this->getLanguage()); ?>
</option>
			<option value="to_percentage" <?php if ($this->_tpl_vars['product_info']['modifier_type'] == 'to_percentage'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('to_percentage', $this->getLanguage()); ?>
</option>
		</select>
	</td>
	<td>
		<input type="hidden" class="cm-chain-<?php echo $this->_tpl_vars['item']['chain_id']; ?>
" value="<?php echo $this->_tpl_vars['delete_id']; ?>
" />
		<input type="text" name="<?php echo $this->_tpl_vars['input_name']; ?>
[modifier]" id="item_modifier_bp_<?php echo $this->_tpl_vars['item']['chain_id']; ?>
_<?php echo $this->_tpl_vars['delete_id']; ?>
" size="4" value="<?php echo smarty_modifier_default(@$this->_tpl_vars['product_info']['modifier'], 0); ?>
" class="input-text" />
	</td>
	<td>
		<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('value' => $this->_tpl_vars['product_info']['discounted_price'], 'span_id' => "item_discounted_price_bp_".($this->_tpl_vars['item']['chain_id'])."_".($this->_tpl_vars['delete_id'])."_", )); ?><?php echo ''; ?><?php if ($this->_tpl_vars['settings']['General']['alternative_currency'] == 'Y'): ?><?php echo ''; ?><?php echo smarty_modifier_unescape(smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['primary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], false)); ?><?php echo ''; ?><?php if ($this->_tpl_vars['secondary_currency'] != $this->_tpl_vars['primary_currency']): ?><?php echo '&nbsp;'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo '('; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true, $this->_tpl_vars['is_integer']); ?><?php echo ''; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo ')'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php echo smarty_modifier_unescape(smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true)); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
	</td>
	
<?php elseif (( $this->_tpl_vars['controller'] == 'bundled_products' || $this->_tpl_vars['extra_mode'] == 'bundled_products' ) && $this->_tpl_vars['clone']): ?>
	<td>
		<input type="text" class="hidden" id="item_price_bp_<?php echo $this->_tpl_vars['item']['chain_id']; ?>
_<?php echo $this->_tpl_vars['ldelim']; ?>
bp_id<?php echo $this->_tpl_vars['rdelim']; ?>
" value="<?php echo $this->_tpl_vars['ldelim']; ?>
price<?php echo $this->_tpl_vars['rdelim']; ?>
" />
		<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('span_id' => "item_display_price_bp_".($this->_tpl_vars['item']['chain_id'])."_".($this->_tpl_vars['ldelim'])."bp_id".($this->_tpl_vars['rdelim'])."_", )); ?><?php echo ''; ?><?php if ($this->_tpl_vars['settings']['General']['alternative_currency'] == 'Y'): ?><?php echo ''; ?><?php echo smarty_modifier_unescape(smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['primary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], false)); ?><?php echo ''; ?><?php if ($this->_tpl_vars['secondary_currency'] != $this->_tpl_vars['primary_currency']): ?><?php echo '&nbsp;'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo '('; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true, $this->_tpl_vars['is_integer']); ?><?php echo ''; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo ')'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php echo smarty_modifier_unescape(smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true)); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
	</td>
	<td>
		<select name="<?php echo $this->_tpl_vars['input_name']; ?>
[modifier_type]" id="item_modifier_type_bp_<?php echo $this->_tpl_vars['item']['chain_id']; ?>
_<?php echo $this->_tpl_vars['ldelim']; ?>
bp_id<?php echo $this->_tpl_vars['rdelim']; ?>
">
			<option value="by_fixed"><?php echo fn_get_lang_var('by_fixed', $this->getLanguage()); ?>
</option>
			<option value="to_fixed"><?php echo fn_get_lang_var('to_fixed', $this->getLanguage()); ?>
</option>
			<option value="by_percentage"><?php echo fn_get_lang_var('by_percentage', $this->getLanguage()); ?>
</option>
			<option value="to_percentage"><?php echo fn_get_lang_var('to_percentage', $this->getLanguage()); ?>
</option>
		</select>
	</td>
	<td>
		<input type="text" class="cm-chain-<?php echo $this->_tpl_vars['item']['chain_id']; ?>
 hidden" value="<?php echo $this->_tpl_vars['ldelim']; ?>
bp_id<?php echo $this->_tpl_vars['rdelim']; ?>
" />
		<input type="text" class="hidden" id="<?php echo $this->_tpl_vars['ldelim']; ?>
bp_id<?php echo $this->_tpl_vars['rdelim']; ?>
" value="<?php echo $this->_tpl_vars['item']['chain_id']; ?>
" />
		<input type="text" name="<?php echo $this->_tpl_vars['input_name']; ?>
[modifier]" id="item_modifier_bp_<?php echo $this->_tpl_vars['item']['chain_id']; ?>
_<?php echo $this->_tpl_vars['ldelim']; ?>
bp_id<?php echo $this->_tpl_vars['rdelim']; ?>
" size="4" value="0" class="input-text" />
	</td>
	<td>
		<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('span_id' => "item_discounted_price_bp_".($this->_tpl_vars['item']['chain_id'])."_".($this->_tpl_vars['ldelim'])."bp_id".($this->_tpl_vars['rdelim'])."_", )); ?><?php echo ''; ?><?php if ($this->_tpl_vars['settings']['General']['alternative_currency'] == 'Y'): ?><?php echo ''; ?><?php echo smarty_modifier_unescape(smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['primary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], false)); ?><?php echo ''; ?><?php if ($this->_tpl_vars['secondary_currency'] != $this->_tpl_vars['primary_currency']): ?><?php echo '&nbsp;'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo '('; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true, $this->_tpl_vars['is_integer']); ?><?php echo ''; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo ')'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php echo smarty_modifier_unescape(smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true)); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
	</td>
<?php endif; ?><?php  ob_end_flush();  ?>