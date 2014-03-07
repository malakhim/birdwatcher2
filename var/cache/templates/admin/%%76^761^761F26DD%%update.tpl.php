<?php /* Smarty version 2.6.18, created on 2014-03-07 22:31:26
         compiled from addons/bundled_products/views/bundled_products/update.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'fn_url', 'addons/bundled_products/views/bundled_products/update.tpl', 31, false),array('modifier', 'format_price', 'addons/bundled_products/views/bundled_products/update.tpl', 61, false),array('modifier', 'unescape', 'addons/bundled_products/views/bundled_products/update.tpl', 61, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('name','combination_products','recalculate','total_cost','price_for_all','share_discount','apply'));
?>
<?php 

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
			 ?><?php if ($this->_tpl_vars['item']['chain_id']): ?>
	<?php $this->assign('mode', 'update', false); ?>
<?php else: ?>
	<?php $this->assign('mode', 'add', false); ?>
	<?php $this->assign('extra_mode', 'bundled_products', false); ?>
<?php endif; ?>


<?php if ($this->_tpl_vars['item']['product_id']): ?>
	<?php $this->assign('product_id', $this->_tpl_vars['item']['product_id'], false); ?>
<?php else: ?>
	<?php $this->assign('product_id', $this->_tpl_vars['product_id'], false); ?>
<?php endif; ?>

<div id="content_group_bp_<?php echo $this->_tpl_vars['item']['chain_id']; ?>
">

<form action="<?php echo fn_url(""); ?>
" method="post" name="item_update_form_bp_<?php echo $this->_tpl_vars['item']['chain_id']; ?>
" class="cm-form-highlight<?php echo $this->_tpl_vars['hide_inputs']; ?>
" enctype="multipart/form-data">
<input type="hidden" class="cm-no-hide-input" name="fake" value="1" />
<input type="hidden" class="cm-no-hide-input" name="item_id" value="<?php echo $this->_tpl_vars['item']['chain_id']; ?>
" />
<input type="hidden" class="cm-no-hide-input" name="product_id" value="<?php echo $this->_tpl_vars['product_id']; ?>
" />

<div class="cm-tabs-content" id="tabs_content_<?php echo $this->_tpl_vars['id']; ?>
">
	<div id="general_<?php echo $this->_tpl_vars['item']['chain_id']; ?>
">

		<div class="form-field">
			<label for="item_name_bp_<?php echo $this->_tpl_vars['item']['chain_id']; ?>
" class="cm-required"><?php echo fn_get_lang_var('name', $this->getLanguage()); ?>
:</label>
			<input type="text" name="item_data[name]" id="item_name_bp_<?php echo $this->_tpl_vars['item']['chain_id']; ?>
" size="55" value="<?php echo $this->_tpl_vars['item']['name']; ?>
" class="input-text-large main-input" />
		</div>
		<input type="hidden" name="item_data[status]" value="A" />
	</div>
	<fieldset>
		<div id="products_<?php echo $this->_tpl_vars['item']['chain_id']; ?>
" <?php if ($this->_tpl_vars['no_hide_inputs']): ?>class="<?php echo $this->_tpl_vars['no_hide_inputs']; ?>
"<?php endif; ?>>
			<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/subheader.tpl", 'smarty_include_vars' => array('title' => fn_get_lang_var('combination_products', $this->getLanguage()))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			
			<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "pickers/products_picker.tpl", 'smarty_include_vars' => array('data_id' => "objects_".($this->_tpl_vars['item']['chain_id'])."_",'input_name' => "item_data[products]",'item_ids' => $this->_tpl_vars['item']['products_info'],'type' => 'table','aoc' => true,'colspan' => '7')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			
			<ul class="statistic-list">
			<?php if (! $this->_tpl_vars['hide_inputs']): ?>
				<li>
					<strong><a onclick="fn_bundled_products_recalculate('<?php echo $this->_tpl_vars['item']['chain_id']; ?>
');"><?php echo fn_get_lang_var('recalculate', $this->getLanguage()); ?>
</a></strong>
				</li>
			<?php endif; ?>
				<li>
					<em><?php echo fn_get_lang_var('total_cost', $this->getLanguage()); ?>
:</em>
					<strong><?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('value' => $this->_tpl_vars['item']['total_price'], 'span_id' => "total_price_".($this->_tpl_vars['item']['chain_id']), )); ?><?php echo ''; ?><?php if ($this->_tpl_vars['settings']['General']['alternative_currency'] == 'Y'): ?><?php echo ''; ?><?php echo smarty_modifier_unescape(smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['primary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], false)); ?><?php echo ''; ?><?php if ($this->_tpl_vars['secondary_currency'] != $this->_tpl_vars['primary_currency']): ?><?php echo '&nbsp;'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo '('; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true, $this->_tpl_vars['is_integer']); ?><?php echo ''; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo ')'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php echo smarty_modifier_unescape(smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true)); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?></strong>
				</li>
				<li>
					<em><?php echo fn_get_lang_var('price_for_all', $this->getLanguage()); ?>
:</em>
					<strong><?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('value' => $this->_tpl_vars['item']['chain_price'], 'span_id' => "price_for_all_".($this->_tpl_vars['item']['chain_id']), )); ?><?php echo ''; ?><?php if ($this->_tpl_vars['settings']['General']['alternative_currency'] == 'Y'): ?><?php echo ''; ?><?php echo smarty_modifier_unescape(smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['primary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], false)); ?><?php echo ''; ?><?php if ($this->_tpl_vars['secondary_currency'] != $this->_tpl_vars['primary_currency']): ?><?php echo '&nbsp;'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo '('; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true, $this->_tpl_vars['is_integer']); ?><?php echo ''; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo ')'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php echo smarty_modifier_unescape(smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true)); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?></strong>
				</li>
			<?php if (! $this->_tpl_vars['hide_inputs']): ?>
				<li>
					<em><label for="global_discount_<?php echo $this->_tpl_vars['item']['chain_id']; ?>
"><?php echo fn_get_lang_var('share_discount', $this->getLanguage()); ?>
</label>&nbsp;(<?php echo $this->_tpl_vars['currencies'][$this->_tpl_vars['primary_currency']]['symbol']; ?>
):</em>
					<input type="text" class="input-text" size="4" id="global_discount_<?php echo $this->_tpl_vars['item']['chain_id']; ?>
" onkeypress="fn_bundled_products_share_discount(event, '<?php echo $this->_tpl_vars['item']['chain_id']; ?>
');" />&nbsp;<a onclick="fn_bundled_products_apply_discount('<?php echo $this->_tpl_vars['item']['chain_id']; ?>
');"><?php echo fn_get_lang_var('apply', $this->getLanguage()); ?>
</a>
				</li>
			<?php endif; ?>
			</ul>			
		</div>
	</fieldset>
</div>

<div class="buttons-container">	
	<?php if ($this->_tpl_vars['mode'] == 'add'): ?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/save_cancel.tpl", 'smarty_include_vars' => array('but_name' => "dispatch[bundled_products.update]",'cancel_action' => 'close')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php else: ?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/save_cancel.tpl", 'smarty_include_vars' => array('but_name' => "dispatch[bundled_products.update]",'cancel_action' => 'close','hide_first_button' => $this->_tpl_vars['hide_first_button'],'hide_second_button' => $this->_tpl_vars['hide_second_button'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php endif; ?>
</div>

</form>

<script type="text/javascript">
	var customer_index = '<?php echo $this->_tpl_vars['config']['customer_index']; ?>
';
	//fn_bundled_products_recalculate('<?php echo $this->_tpl_vars['item']['chain_id']; ?>
', '<?php echo $this->_tpl_vars['product_id']; ?>
');
</script>

<!--content_group_bp_<?php echo $this->_tpl_vars['item']['chain_id']; ?>
--></div>