<?php /* Smarty version 2.6.18, created on 2013-09-01 10:52:54
         compiled from views/products/components/product_options.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'views/products/components/product_options.tpl', 30, false),array('modifier', 'strpos', 'views/products/components/product_options.tpl', 42, false),array('modifier', 'escape', 'views/products/components/product_options.tpl', 43, false),array('modifier', 'defined', 'views/products/components/product_options.tpl', 49, false),array('modifier', 'floatval', 'views/products/components/product_options.tpl', 55, false),array('modifier', 'cat', 'views/products/components/product_options.tpl', 116, false),array('modifier', 'md5', 'views/products/components/product_options.tpl', 116, false),array('modifier', 'fn_url', 'views/products/components/product_options.tpl', 144, false),array('modifier', 'trim', 'views/products/components/product_options.tpl', 147, false),array('modifier', 'count', 'views/products/components/product_options.tpl', 149, false),array('modifier', 'unescape', 'views/products/components/product_options.tpl', 296, false),array('modifier', 'fn_generate_thumbnail', 'views/products/components/product_options.tpl', 296, false),array('modifier', 'fn_convert_relative_to_absolute_image_url', 'views/products/components/product_options.tpl', 299, false),array('block', 'hook', 'views/products/components/product_options.tpl', 55, false),array('function', 'script', 'views/products/components/product_options.tpl', 113, false),array('function', 'math', 'views/products/components/product_options.tpl', 214, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('select_option_above','please_select_one','na','please_select_one','select_option_above','na','upload_another_file','upload_file','remove_this_item','remove_this_item','remove_this_item','remove_this_item','upload_another_file','upload_file','or','specify_url','view_larger_image','nocombination'));
?>
<?php 

				$rname = !empty($resource_name) ? $resource_name : $params['smarty_include_tpl_file'];
				if ($this->compile_check && empty($inline_no_check[$rname]) && $this->is_cached($rname)) {
					if ($this->check_inline_blocks(array (
  'common_templates/image.tpl' => 1367063745,
))) {
						$_smarty_compile_path = $this->_get_compile_path($rname);
						$this->_compile_resource($rname, $_smarty_compile_path);
						$inline_no_check[$rname] = true;
						include $_smarty_compile_path;
						return;
					}
				}
			 ?><?php if (( $this->_tpl_vars['settings']['General']['display_options_modifiers'] == 'Y' && ( $this->_tpl_vars['auth']['user_id'] || ( $this->_tpl_vars['settings']['General']['allow_anonymous_shopping'] != 'P' && ! $this->_tpl_vars['auth']['user_id'] ) ) )): ?>
<?php $this->assign('show_modifiers', true, false); ?>
<?php endif; ?>

<input type="hidden" name="appearance[details_page]" value="<?php echo $this->_tpl_vars['details_page']; ?>
" />
<?php $_from = $this->_tpl_vars['product']['detailed_params']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['param'] => $this->_tpl_vars['value']):
?>
	<input type="hidden" name="additional_info[<?php echo $this->_tpl_vars['param']; ?>
]" value="<?php echo $this->_tpl_vars['value']; ?>
" />
<?php endforeach; endif; unset($_from); ?>

<?php if ($this->_tpl_vars['product_options']): ?>
<?php if ($this->_tpl_vars['obj_prefix']): ?>
	<input type="hidden" name="appearance[obj_prefix]" value="<?php echo $this->_tpl_vars['obj_prefix']; ?>
" />
<?php endif; ?>

<?php if ($this->_tpl_vars['location'] == 'cart' || $this->_tpl_vars['product']['object_id']): ?>
	<input type="hidden" name="<?php echo $this->_tpl_vars['name']; ?>
[<?php echo $this->_tpl_vars['id']; ?>
][object_id]" value="<?php echo smarty_modifier_default(@$this->_tpl_vars['id'], @$this->_tpl_vars['obj_id']); ?>
" />
<?php endif; ?>

<?php if ($this->_tpl_vars['extra_id']): ?>
	<input type="hidden" name="extra_id" value="<?php echo $this->_tpl_vars['extra_id']; ?>
" />
<?php endif; ?>

<div id="opt_<?php echo $this->_tpl_vars['obj_prefix']; ?>
<?php echo $this->_tpl_vars['id']; ?>
">
	<?php $_from = $this->_tpl_vars['product_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['product_options'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['product_options']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['po']):
        $this->_foreach['product_options']['iteration']++;
?>
	
	<?php $this->assign('selected_variant', "", false); ?>
	<div class="form-field<?php if (! $this->_tpl_vars['capture_options_vs_qty']): ?> product-list-field<?php endif; ?> clearfix" id="opt_<?php echo $this->_tpl_vars['obj_prefix']; ?>
<?php echo $this->_tpl_vars['id']; ?>
_<?php echo $this->_tpl_vars['po']['option_id']; ?>
">
		<?php if (! ( strpos('SRC', $this->_tpl_vars['po']['option_type']) !== false && ! $this->_tpl_vars['po']['variants'] && $this->_tpl_vars['po']['missing_variants_handling'] == 'H' )): ?>
		<label for="option_<?php echo $this->_tpl_vars['obj_prefix']; ?>
<?php echo $this->_tpl_vars['id']; ?>
_<?php echo $this->_tpl_vars['po']['option_id']; ?>
" class="<?php if ($this->_tpl_vars['po']['required'] == 'Y'): ?>cm-required<?php endif; ?> <?php if ($this->_tpl_vars['po']['regexp']): ?>cm-regexp<?php endif; ?>"><?php echo $this->_tpl_vars['po']['option_name']; ?>
<?php if ($this->_tpl_vars['po']['description']): ?><?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('tooltip' => $this->_tpl_vars['po']['description'], )); ?><?php if ($this->_tpl_vars['tooltip']): ?> (<a class="cm-tooltip<?php if ($this->_tpl_vars['params']): ?> <?php echo $this->_tpl_vars['params']; ?>
<?php endif; ?>" title="<?php echo smarty_modifier_escape($this->_tpl_vars['tooltip'], 'html'); ?>
">?</a>)<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php endif; ?>:&nbsp;</label>
		<?php if ($this->_tpl_vars['po']['option_type'] == 'S'): ?> 			<?php if ($this->_tpl_vars['po']['variants']): ?>
				<?php if (( $this->_tpl_vars['po']['disabled'] || $this->_tpl_vars['disabled'] ) && ! $this->_tpl_vars['po']['not_required']): ?><input type="hidden" value="" id="option_<?php echo $this->_tpl_vars['obj_prefix']; ?>
<?php echo $this->_tpl_vars['id']; ?>
_<?php echo $this->_tpl_vars['po']['option_id']; ?>
" /><?php endif; ?>
				<select name="<?php echo $this->_tpl_vars['name']; ?>
[<?php echo $this->_tpl_vars['id']; ?>
][product_options][<?php echo $this->_tpl_vars['po']['option_id']; ?>
]" <?php if (! $this->_tpl_vars['po']['disabled'] && ! $this->_tpl_vars['disabled']): ?>id="option_<?php echo $this->_tpl_vars['obj_prefix']; ?>
<?php echo $this->_tpl_vars['id']; ?>
_<?php echo $this->_tpl_vars['po']['option_id']; ?>
"<?php endif; ?> onchange="<?php if ($this->_tpl_vars['product']['options_update']): ?>fn_change_options('<?php echo $this->_tpl_vars['obj_prefix']; ?>
<?php echo $this->_tpl_vars['id']; ?>
', '<?php echo $this->_tpl_vars['id']; ?>
', '<?php echo $this->_tpl_vars['po']['option_id']; ?>
');<?php else: ?> fn_change_variant_image('<?php echo $this->_tpl_vars['obj_prefix']; ?>
<?php echo $this->_tpl_vars['id']; ?>
', '<?php echo $this->_tpl_vars['po']['option_id']; ?>
');<?php endif; ?>" <?php if ($this->_tpl_vars['product']['exclude_from_calculate'] && ! $this->_tpl_vars['product']['aoc'] || $this->_tpl_vars['po']['disabled'] || $this->_tpl_vars['disabled']): ?>disabled="disabled" class="disabled"<?php endif; ?>>
					<?php if ($this->_tpl_vars['product']['options_type'] == 'S'): ?>
						<?php if (! defined('CHECKOUT') || $this->_tpl_vars['po']['disabled'] || $this->_tpl_vars['disabled'] || ( defined('CHECKOUT') && ! $this->_tpl_vars['po']['value'] )): ?>
							<option value=""><?php if ($this->_tpl_vars['po']['disabled'] || $this->_tpl_vars['disabled']): ?><?php echo fn_get_lang_var('select_option_above', $this->getLanguage()); ?>
<?php else: ?><?php echo fn_get_lang_var('please_select_one', $this->getLanguage()); ?>
<?php endif; ?></option>
						<?php endif; ?>
					<?php endif; ?>
					<?php $_from = $this->_tpl_vars['po']['variants']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['vars'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['vars']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['vr']):
        $this->_foreach['vars']['iteration']++;
?>
						<?php if (! ( $this->_tpl_vars['po']['disabled'] || $this->_tpl_vars['disabled'] ) || ( ( $this->_tpl_vars['po']['disabled'] || $this->_tpl_vars['disabled'] ) && $this->_tpl_vars['po']['value'] && $this->_tpl_vars['po']['value'] == $this->_tpl_vars['vr']['variant_id'] )): ?>
							<option value="<?php echo $this->_tpl_vars['vr']['variant_id']; ?>
" <?php if ($this->_tpl_vars['po']['value'] == $this->_tpl_vars['vr']['variant_id']): ?><?php $this->assign('selected_variant', $this->_tpl_vars['vr']['variant_id'], false); ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['vr']['variant_name']; ?>
 <?php if ($this->_tpl_vars['show_modifiers']): ?><?php $this->_tag_stack[] = array('hook', array('name' => "products:options_modifiers")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php if (floatval($this->_tpl_vars['vr']['modifier'])): ?>(<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/modifier.tpl", 'smarty_include_vars' => array('mod_type' => $this->_tpl_vars['vr']['modifier_type'],'mod_value' => $this->_tpl_vars['vr']['modifier'],'display_sign' => true)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>)<?php endif; ?><?php if ($this->_tpl_vars['addons']['reward_points']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/reward_points/hooks/products/options_modifiers.post.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php endif; ?></option>
						<?php endif; ?>
					<?php endforeach; endif; unset($_from); ?>
				</select>
			<?php else: ?>
				<input type="hidden" name="<?php echo $this->_tpl_vars['name']; ?>
[<?php echo $this->_tpl_vars['id']; ?>
][product_options][<?php echo $this->_tpl_vars['po']['option_id']; ?>
]" value="<?php echo $this->_tpl_vars['po']['value']; ?>
" id="option_<?php echo $this->_tpl_vars['obj_prefix']; ?>
<?php echo $this->_tpl_vars['id']; ?>
_<?php echo $this->_tpl_vars['po']['option_id']; ?>
" />
				<span><?php echo fn_get_lang_var('na', $this->getLanguage()); ?>
</span>
			<?php endif; ?>
		<?php elseif ($this->_tpl_vars['po']['option_type'] == 'R'): ?> 			<?php if ($this->_tpl_vars['po']['variants']): ?>
				<ul id="option_<?php echo $this->_tpl_vars['obj_prefix']; ?>
<?php echo $this->_tpl_vars['id']; ?>
_<?php echo $this->_tpl_vars['po']['option_id']; ?>
_group">
					<li class="hidden"><input type="hidden" name="<?php echo $this->_tpl_vars['name']; ?>
[<?php echo $this->_tpl_vars['id']; ?>
][product_options][<?php echo $this->_tpl_vars['po']['option_id']; ?>
]" value="<?php echo $this->_tpl_vars['po']['value']; ?>
" id="option_<?php echo $this->_tpl_vars['obj_prefix']; ?>
<?php echo $this->_tpl_vars['id']; ?>
_<?php echo $this->_tpl_vars['po']['option_id']; ?>
" /></li>
					<?php if (! $this->_tpl_vars['po']['disabled'] && ! $this->_tpl_vars['disabled']): ?>
						<?php $_from = $this->_tpl_vars['po']['variants']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['vars'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['vars']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['vr']):
        $this->_foreach['vars']['iteration']++;
?>
							<li><label id="option_description_<?php echo $this->_tpl_vars['obj_prefix']; ?>
<?php echo $this->_tpl_vars['id']; ?>
_<?php echo $this->_tpl_vars['po']['option_id']; ?>
_<?php echo $this->_tpl_vars['vr']['variant_id']; ?>
" class="option-items"><input type="radio" class="radio" name="<?php echo $this->_tpl_vars['name']; ?>
[<?php echo $this->_tpl_vars['id']; ?>
][product_options][<?php echo $this->_tpl_vars['po']['option_id']; ?>
]" value="<?php echo $this->_tpl_vars['vr']['variant_id']; ?>
" <?php if ($this->_tpl_vars['po']['value'] == $this->_tpl_vars['vr']['variant_id']): ?><?php $this->assign('selected_variant', $this->_tpl_vars['vr']['variant_id'], false); ?>checked="checked"<?php endif; ?> onclick="<?php if ($this->_tpl_vars['product']['options_update']): ?>fn_change_options('<?php echo $this->_tpl_vars['obj_prefix']; ?>
<?php echo $this->_tpl_vars['id']; ?>
', '<?php echo $this->_tpl_vars['id']; ?>
', '<?php echo $this->_tpl_vars['po']['option_id']; ?>
');<?php else: ?> fn_change_variant_image('<?php echo $this->_tpl_vars['obj_prefix']; ?>
<?php echo $this->_tpl_vars['id']; ?>
', '<?php echo $this->_tpl_vars['po']['option_id']; ?>
', '<?php echo $this->_tpl_vars['vr']['variant_id']; ?>
');<?php endif; ?>" <?php if ($this->_tpl_vars['product']['exclude_from_calculate'] && ! $this->_tpl_vars['product']['aoc'] || $this->_tpl_vars['po']['disabled'] || $this->_tpl_vars['disabled']): ?>disabled="disabled"<?php endif; ?> />
							<?php echo $this->_tpl_vars['vr']['variant_name']; ?>
&nbsp;<?php if ($this->_tpl_vars['show_modifiers']): ?><?php $this->_tag_stack[] = array('hook', array('name' => "products:options_modifiers")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php if (floatval($this->_tpl_vars['vr']['modifier'])): ?>(<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/modifier.tpl", 'smarty_include_vars' => array('mod_type' => $this->_tpl_vars['vr']['modifier_type'],'mod_value' => $this->_tpl_vars['vr']['modifier'],'display_sign' => true)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>)<?php endif; ?><?php if ($this->_tpl_vars['addons']['reward_points']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/reward_points/hooks/products/options_modifiers.post.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php endif; ?></label></li>
						<?php endforeach; endif; unset($_from); ?>
					<?php endif; ?>
				</ul>
				<?php if (! $this->_tpl_vars['po']['value'] && $this->_tpl_vars['product']['options_type'] == 'S' && ! ( $this->_tpl_vars['po']['disabled'] || $this->_tpl_vars['disabled'] )): ?><p class="description clear-both"><?php echo fn_get_lang_var('please_select_one', $this->getLanguage()); ?>
</p><?php elseif (! $this->_tpl_vars['po']['value'] && $this->_tpl_vars['product']['options_type'] == 'S' && ( $this->_tpl_vars['po']['disabled'] || $this->_tpl_vars['disabled'] )): ?><p class="description clear-both"><?php echo fn_get_lang_var('select_option_above', $this->getLanguage()); ?>
</p><?php endif; ?>
			<?php else: ?>
				<input type="hidden" name="<?php echo $this->_tpl_vars['name']; ?>
[<?php echo $this->_tpl_vars['id']; ?>
][product_options][<?php echo $this->_tpl_vars['po']['option_id']; ?>
]" value="<?php echo $this->_tpl_vars['po']['value']; ?>
" id="option_<?php echo $this->_tpl_vars['obj_prefix']; ?>
<?php echo $this->_tpl_vars['id']; ?>
_<?php echo $this->_tpl_vars['po']['option_id']; ?>
" />
				<span><?php echo fn_get_lang_var('na', $this->getLanguage()); ?>
</span>
			<?php endif; ?>

		<?php elseif ($this->_tpl_vars['po']['option_type'] == 'C'): ?> 			<?php $_from = $this->_tpl_vars['po']['variants']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['vr']):
?>
			<?php if ($this->_tpl_vars['vr']['position'] == 0): ?>
				<input id="unchecked_option_<?php echo $this->_tpl_vars['obj_prefix']; ?>
<?php echo $this->_tpl_vars['id']; ?>
_<?php echo $this->_tpl_vars['po']['option_id']; ?>
" type="hidden" name="<?php echo $this->_tpl_vars['name']; ?>
[<?php echo $this->_tpl_vars['id']; ?>
][product_options][<?php echo $this->_tpl_vars['po']['option_id']; ?>
]" value="<?php echo $this->_tpl_vars['vr']['variant_id']; ?>
" <?php if ($this->_tpl_vars['po']['disabled'] || $this->_tpl_vars['disabled']): ?>disabled="disabled"<?php endif; ?> />
			<?php else: ?>
				<label class="option-items"><input id="option_<?php echo $this->_tpl_vars['obj_prefix']; ?>
<?php echo $this->_tpl_vars['id']; ?>
_<?php echo $this->_tpl_vars['po']['option_id']; ?>
" type="checkbox" name="<?php echo $this->_tpl_vars['name']; ?>
[<?php echo $this->_tpl_vars['id']; ?>
][product_options][<?php echo $this->_tpl_vars['po']['option_id']; ?>
]" value="<?php echo $this->_tpl_vars['vr']['variant_id']; ?>
" class="checkbox" <?php if ($this->_tpl_vars['po']['value'] == $this->_tpl_vars['vr']['variant_id']): ?>checked="checked"<?php endif; ?> <?php if ($this->_tpl_vars['product']['exclude_from_calculate'] && ! $this->_tpl_vars['product']['aoc'] || $this->_tpl_vars['po']['disabled'] || $this->_tpl_vars['disabled']): ?>disabled="disabled"<?php endif; ?> <?php if ($this->_tpl_vars['product']['options_update']): ?>onclick="fn_change_options('<?php echo $this->_tpl_vars['obj_prefix']; ?>
<?php echo $this->_tpl_vars['id']; ?>
', '<?php echo $this->_tpl_vars['id']; ?>
', '<?php echo $this->_tpl_vars['po']['option_id']; ?>
');"<?php endif; ?>/>
				<?php if ($this->_tpl_vars['show_modifiers']): ?><?php $this->_tag_stack[] = array('hook', array('name' => "products:options_modifiers")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php if (floatval($this->_tpl_vars['vr']['modifier'])): ?>(<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/modifier.tpl", 'smarty_include_vars' => array('mod_type' => $this->_tpl_vars['vr']['modifier_type'],'mod_value' => $this->_tpl_vars['vr']['modifier'],'display_sign' => true)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>)<?php endif; ?><?php if ($this->_tpl_vars['addons']['reward_points']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/reward_points/hooks/products/options_modifiers.post.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php endif; ?></label>
			<?php endif; ?>
			<?php endforeach; else: ?>
				<label class="option-items"><input type="checkbox" class="checkbox" disabled="disabled" />
				<?php if ($this->_tpl_vars['show_modifiers']): ?><?php $this->_tag_stack[] = array('hook', array('name' => "products:options_modifiers")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php if (floatval($this->_tpl_vars['vr']['modifier'])): ?>(<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/modifier.tpl", 'smarty_include_vars' => array('mod_type' => $this->_tpl_vars['vr']['modifier_type'],'mod_value' => $this->_tpl_vars['vr']['modifier'],'display_sign' => true)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>)<?php endif; ?><?php if ($this->_tpl_vars['addons']['reward_points']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/reward_points/hooks/products/options_modifiers.post.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php endif; ?></label>
			<?php endif; unset($_from); ?>

		<?php elseif ($this->_tpl_vars['po']['option_type'] == 'I'): ?> 			<input id="option_<?php echo $this->_tpl_vars['obj_prefix']; ?>
<?php echo $this->_tpl_vars['id']; ?>
_<?php echo $this->_tpl_vars['po']['option_id']; ?>
" type="text" name="<?php echo $this->_tpl_vars['name']; ?>
[<?php echo $this->_tpl_vars['id']; ?>
][product_options][<?php echo $this->_tpl_vars['po']['option_id']; ?>
]" value="<?php echo smarty_modifier_default(@$this->_tpl_vars['po']['value'], @$this->_tpl_vars['po']['inner_hint']); ?>
" <?php if ($this->_tpl_vars['product']['exclude_from_calculate'] && ! $this->_tpl_vars['product']['aoc']): ?>disabled="disabled"<?php endif; ?> class="valign input-text<?php if ($this->_tpl_vars['po']['inner_hint']): ?> cm-hint<?php endif; ?><?php if ($this->_tpl_vars['product']['exclude_from_calculate'] && ! $this->_tpl_vars['product']['aoc']): ?> disabled<?php endif; ?>" <?php if ($this->_tpl_vars['po']['inner_hint']): ?>title="<?php echo $this->_tpl_vars['po']['inner_hint']; ?>
"<?php endif; ?> />
		<?php elseif ($this->_tpl_vars['po']['option_type'] == 'T'): ?> 			<textarea id="option_<?php echo $this->_tpl_vars['obj_prefix']; ?>
<?php echo $this->_tpl_vars['id']; ?>
_<?php echo $this->_tpl_vars['po']['option_id']; ?>
" class="input-textarea-long<?php if ($this->_tpl_vars['po']['inner_hint']): ?> cm-hint<?php endif; ?><?php if ($this->_tpl_vars['product']['exclude_from_calculate'] && ! $this->_tpl_vars['product']['aoc']): ?> disabled<?php endif; ?>" rows="3" name="<?php echo $this->_tpl_vars['name']; ?>
[<?php echo $this->_tpl_vars['id']; ?>
][product_options][<?php echo $this->_tpl_vars['po']['option_id']; ?>
]" <?php if ($this->_tpl_vars['product']['exclude_from_calculate'] && ! $this->_tpl_vars['product']['aoc']): ?>disabled="disabled"<?php endif; ?> <?php if ($this->_tpl_vars['po']['inner_hint']): ?>title="<?php echo $this->_tpl_vars['po']['inner_hint']; ?>
"<?php endif; ?> ><?php echo smarty_modifier_default(@$this->_tpl_vars['po']['value'], @$this->_tpl_vars['po']['inner_hint']); ?>
</textarea>
		<?php elseif ($this->_tpl_vars['po']['option_type'] == 'F'): ?> 			<div class="clearfix">
				<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('images' => $this->_tpl_vars['product']['extra']['custom_files'][$this->_tpl_vars['po']['option_id']], 'var_name' => ($this->_tpl_vars['name'])."[".($this->_tpl_vars['po']['option_id']).($this->_tpl_vars['id'])."]", 'multiupload' => $this->_tpl_vars['po']['multiupload'], 'hidden_name' => ($this->_tpl_vars['name'])."[custom_files][".($this->_tpl_vars['po']['option_id']).($this->_tpl_vars['id'])."]", 'hidden_value' => ($this->_tpl_vars['id'])."_".($this->_tpl_vars['po']['option_id']), 'label_id' => "option_".($this->_tpl_vars['obj_prefix']).($this->_tpl_vars['id'])."_".($this->_tpl_vars['po']['option_id']), 'prefix' => $this->_tpl_vars['obj_prefix'], )); ?><?php 

				$rname = !empty($resource_name) ? $resource_name : $params['smarty_include_tpl_file'];
				if ($this->compile_check && empty($inline_no_check[$rname]) && $this->is_cached($rname)) {
					if ($this->check_inline_blocks(array (
  'addons/product_configurator/hooks/fileuploader/uploaded_files.post.tpl' => 1367063836,
))) {
						$_smarty_compile_path = $this->_get_compile_path($rname);
						$this->_compile_resource($rname, $_smarty_compile_path);
						$inline_no_check[$rname] = true;
						include $_smarty_compile_path;
						return;
					}
				}
			 ?><?php echo smarty_function_script(array('src' => "js/fileuploader_scripts.js"), $this);?>

<?php echo smarty_function_script(array('src' => "js/node_cloning.js"), $this);?>


<?php $this->assign('id_var_name', md5(smarty_modifier_cat($this->_tpl_vars['prefix'], $this->_tpl_vars['var_name'])), false); ?>

<script type="text/javascript">
	var id_var_name = "<?php echo $this->_tpl_vars['id_var_name']; ?>
";
	var label_id = "<?php echo $this->_tpl_vars['label_id']; ?>
";
	
	if (typeof(custom_labels) == "undefined") <?php echo $this->_tpl_vars['ldelim']; ?>

		custom_labels = <?php echo $this->_tpl_vars['ldelim']; ?>
<?php echo $this->_tpl_vars['rdelim']; ?>
;
	<?php echo $this->_tpl_vars['rdelim']; ?>

	
	custom_labels[id_var_name] = <?php echo $this->_tpl_vars['ldelim']; ?>
<?php echo $this->_tpl_vars['rdelim']; ?>
;
	custom_labels[id_var_name]['upload_another_file'] = "<?php echo smarty_modifier_default(@$this->_tpl_vars['upload_another_file_text'], fn_get_lang_var('upload_another_file', $this->getLanguage())); ?>
";
	custom_labels[id_var_name]['upload_file'] = "<?php echo smarty_modifier_default(@$this->_tpl_vars['upload_file_text'], fn_get_lang_var('upload_file', $this->getLanguage())); ?>
";
</script>

<div class="fileuploader">
<input type="hidden" id="<?php echo $this->_tpl_vars['label_id']; ?>
" value="<?php if ($this->_tpl_vars['images']): ?><?php echo $this->_tpl_vars['id_var_name']; ?>
<?php endif; ?>" />

<?php $_from = $this->_tpl_vars['images']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['image_id'] => $this->_tpl_vars['image']):
?>
	<div class="upload-file-section cm-uploaded-image" id="message_<?php echo $this->_tpl_vars['id_var_name']; ?>
_<?php echo $this->_tpl_vars['image']['file']; ?>
" title="">
		<p class="cm-fu-file">
			<?php $this->_tag_stack[] = array('hook', array('name' => "fileuploader:links")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
				<?php if ($this->_tpl_vars['image']['location'] == 'cart'): ?>
					<?php $this->assign('delete_link', "checkout.delete_file?cart_id=".($this->_tpl_vars['id'])."&amp;option_id=".($this->_tpl_vars['po']['option_id'])."&amp;file=".($this->_tpl_vars['image_id'])."&amp;redirect_mode=cart", false); ?>
					<?php $this->assign('download_link', "checkout.get_custom_file?cart_id=".($this->_tpl_vars['id'])."&amp;option_id=".($this->_tpl_vars['po']['option_id'])."&amp;file=".($this->_tpl_vars['image_id']), false); ?>
				<?php endif; ?>
			<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
			<?php if ($this->_tpl_vars['image']['is_image']): ?>
				<a href="<?php echo fn_url($this->_tpl_vars['image']['detailed']); ?>
"><img src="<?php echo fn_url($this->_tpl_vars['image']['thumbnail']); ?>
" border="0" /></a><br />
			<?php endif; ?>
			
			<?php if ($this->_tpl_vars['addons']['wishlist']['status'] == 'A'): ?><?php ob_start(); $this->_in_capture[] = '83b6acf0648f541535426f7b17d398b9';
$_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/wishlist/hooks/fileuploader/uploaded_files.override.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
$this->_tpl_vars['addon_content'] = ob_get_contents(); ob_end_clean(); array_pop($this->_in_capture); if (!empty($this->_scripts['83b6acf0648f541535426f7b17d398b9'])) { echo implode("\n", $this->_scripts['83b6acf0648f541535426f7b17d398b9']); unset($this->_scripts['83b6acf0648f541535426f7b17d398b9']); }
 ?><?php else: ?><?php $this->assign('addon_content', "", false); ?><?php endif; ?><?php if (trim($this->_tpl_vars['addon_content'])): ?><?php echo $this->_tpl_vars['addon_content']; ?>
<?php else: ?><?php $this->_tag_stack[] = array('hook', array('name' => "fileuploader:uploaded_files")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
				<?php if ($this->_tpl_vars['delete_link']): ?>
				<a class="cm-ajax" href="<?php echo fn_url($this->_tpl_vars['delete_link']); ?>
"><?php endif; ?><?php if (! ( $this->_tpl_vars['po']['required'] == 'Y' && count($this->_tpl_vars['images']) == 1 )): ?><img src="<?php echo $this->_tpl_vars['images_dir']; ?>
/icons/icon_delete.gif" width="12" height="12" border="0" hspace="3" id="clean_selection_<?php echo $this->_tpl_vars['id_var_name']; ?>
_<?php echo $this->_tpl_vars['image']['file']; ?>
" alt="<?php echo fn_get_lang_var('remove_this_item', $this->getLanguage()); ?>
" title="<?php echo fn_get_lang_var('remove_this_item', $this->getLanguage()); ?>
" onclick="fileuploader.clean_selection(this.id); <?php if ($this->_tpl_vars['multiupload'] != 'Y'): ?>fileuploader.toggle_links('<?php echo $this->_tpl_vars['id_var_name']; ?>
', 'show');<?php endif; ?> fileuploader.check_required_field('<?php echo $this->_tpl_vars['id_var_name']; ?>
', '<?php echo $this->_tpl_vars['label_id']; ?>
');" class="hand valign" /><?php endif; ?><?php if ($this->_tpl_vars['delete_link']): ?></a><?php endif; ?><span class="filename-link"><?php if ($this->_tpl_vars['download_link']): ?><a href="<?php echo fn_url($this->_tpl_vars['download_link']); ?>
"><?php endif; ?><?php echo $this->_tpl_vars['image']['name']; ?>
<?php if ($this->_tpl_vars['download_link']): ?></a><?php endif; ?></span>
			<?php if ($this->_tpl_vars['addons']['product_configurator']['status'] == 'A'): ?><?php $__parent_tpl_vars = $this->_tpl_vars; ?><?php if ($this->_tpl_vars['edit_configuration']): ?>
	<input type="hidden" name="<?php echo $this->_tpl_vars['name']; ?>
[custom_files][uploaded][<?php echo $this->_tpl_vars['image']['file']; ?>
][product_id]" value="<?php echo $this->_tpl_vars['product']['product_id']; ?>
" />
	<input type="hidden" name="<?php echo $this->_tpl_vars['name']; ?>
[custom_files][uploaded][<?php echo $this->_tpl_vars['image']['file']; ?>
][option_id]" value="<?php echo $this->_tpl_vars['po']['option_id']; ?>
" />
	<input type="hidden" name="<?php echo $this->_tpl_vars['name']; ?>
[custom_files][uploaded][<?php echo $this->_tpl_vars['image']['file']; ?>
][name]" value="<?php echo $this->_tpl_vars['image']['name']; ?>
" />
	<input type="hidden" name="<?php echo $this->_tpl_vars['name']; ?>
[custom_files][uploaded][<?php echo $this->_tpl_vars['image']['file']; ?>
][path]" value="<?php echo $this->_tpl_vars['image']['file']; ?>
" />
<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php endif; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php endif; ?>
		</p>
	</div>
<?php endforeach; endif; unset($_from); ?>

<div class="nowrap ie7-inline" id="file_uploader_<?php echo $this->_tpl_vars['id_var_name']; ?>
">
	<div class="upload-file-section" id="message_<?php echo $this->_tpl_vars['id_var_name']; ?>
" title="">
		<p class="cm-fu-file hidden"><img src="<?php echo $this->_tpl_vars['images_dir']; ?>
/icons/icon_delete.gif" width="12" height="12" border="0" hspace="3" id="clean_selection_<?php echo $this->_tpl_vars['id_var_name']; ?>
" alt="<?php echo fn_get_lang_var('remove_this_item', $this->getLanguage()); ?>
" title="<?php echo fn_get_lang_var('remove_this_item', $this->getLanguage()); ?>
" onclick="fileuploader.clean_selection(this.id); <?php if ($this->_tpl_vars['multiupload'] != 'Y'): ?>fileuploader.toggle_links(this.id, 'show');<?php endif; ?> fileuploader.check_required_field('<?php echo $this->_tpl_vars['id_var_name']; ?>
', '<?php echo $this->_tpl_vars['label_id']; ?>
');" class="hand valign" /><span class="filename-link"></span></p>
	</div>
	
	<?php echo '<div class="select-field upload-file-links '; ?><?php if ($this->_tpl_vars['multiupload'] != 'Y' && $this->_tpl_vars['images']): ?><?php echo 'hidden'; ?><?php endif; ?><?php echo '" id="link_container_'; ?><?php echo $this->_tpl_vars['id_var_name']; ?><?php echo '"><input type="hidden" name="file_'; ?><?php echo $this->_tpl_vars['var_name']; ?><?php echo '" value="'; ?><?php if ($this->_tpl_vars['image_name']): ?><?php echo ''; ?><?php echo $this->_tpl_vars['image_name']; ?><?php echo ''; ?><?php endif; ?><?php echo '" id="file_'; ?><?php echo $this->_tpl_vars['id_var_name']; ?><?php echo '" /><input type="hidden" name="type_'; ?><?php echo $this->_tpl_vars['var_name']; ?><?php echo '" value="'; ?><?php if ($this->_tpl_vars['image_name']): ?><?php echo 'local'; ?><?php endif; ?><?php echo '" id="type_'; ?><?php echo $this->_tpl_vars['id_var_name']; ?><?php echo '" /><div class="upload-file-local"><input type="file" name="file_'; ?><?php echo $this->_tpl_vars['var_name']; ?><?php echo '" id="_local_'; ?><?php echo $this->_tpl_vars['id_var_name']; ?><?php echo '" onchange="fileuploader.show_loader(this.id); '; ?><?php if ($this->_tpl_vars['multiupload'] == 'Y'): ?><?php echo 'fileuploader.check_image(this.id);'; ?><?php else: ?><?php echo 'fileuploader.toggle_links(this.id, \'hide\');'; ?><?php endif; ?><?php echo ' fileuploader.check_required_field(\''; ?><?php echo $this->_tpl_vars['id_var_name']; ?><?php echo '\', \''; ?><?php echo $this->_tpl_vars['label_id']; ?><?php echo '\');" onclick="$(this).removeAttr(\'value\');" value="" /><a id="local_'; ?><?php echo $this->_tpl_vars['id_var_name']; ?><?php echo '">'; ?><?php if ($this->_tpl_vars['images']): ?><?php echo ''; ?><?php echo smarty_modifier_default(@$this->_tpl_vars['upload_another_file_text'], fn_get_lang_var('upload_another_file', $this->getLanguage())); ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php echo smarty_modifier_default(@$this->_tpl_vars['upload_file_text'], fn_get_lang_var('upload_file', $this->getLanguage())); ?><?php echo ''; ?><?php endif; ?><?php echo '</a></div>'; ?><?php if ($this->_tpl_vars['allow_url_uploading']): ?><?php echo '&nbsp;'; ?><?php echo fn_get_lang_var('or', $this->getLanguage()); ?><?php echo '&nbsp;<a onclick="fileuploader.show_loader(this.id); '; ?><?php if ($this->_tpl_vars['multiupload'] == 'Y'): ?><?php echo 'fileuploader.check_image(this.id);'; ?><?php else: ?><?php echo 'fileuploader.toggle_links(this.id, \'hide\');'; ?><?php endif; ?><?php echo ' fileuploader.check_required_field(\''; ?><?php echo $this->_tpl_vars['id_var_name']; ?><?php echo '\', \''; ?><?php echo $this->_tpl_vars['label_id']; ?><?php echo '\');" id="url_'; ?><?php echo $this->_tpl_vars['id_var_name']; ?><?php echo '">'; ?><?php echo fn_get_lang_var('specify_url', $this->getLanguage()); ?><?php echo '</a>'; ?><?php endif; ?><?php echo ''; ?><?php if ($this->_tpl_vars['hidden_name']): ?><?php echo '<input type="hidden" name="'; ?><?php echo $this->_tpl_vars['hidden_name']; ?><?php echo '" value="'; ?><?php echo $this->_tpl_vars['hidden_value']; ?><?php echo '">'; ?><?php endif; ?><?php echo '</div>'; ?>

</div>

</div><!--fileuploader--><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
			</div>
		<?php endif; ?>
		<?php endif; ?>

		<?php if ($this->_tpl_vars['po']['comment']): ?>
			<p class="description clear-both"><?php echo $this->_tpl_vars['po']['comment']; ?>
</p>
		<?php endif; ?>

		<?php if ($this->_tpl_vars['po']['regexp'] && ! $this->_tpl_vars['no_script']): ?>
			<script type="text/javascript">
			//<![CDATA[
				regexp['option_<?php echo $this->_tpl_vars['obj_prefix']; ?>
<?php echo $this->_tpl_vars['id']; ?>
_<?php echo $this->_tpl_vars['po']['option_id']; ?>
'] = <?php echo $this->_tpl_vars['ldelim']; ?>
regexp: "<?php echo smarty_modifier_escape($this->_tpl_vars['po']['regexp'], 'javascript'); ?>
", message: "<?php echo $this->_tpl_vars['po']['incorrect_message']; ?>
"<?php echo $this->_tpl_vars['rdelim']; ?>
;
			//]]>
			</script>
		<?php endif; ?>

		<?php ob_start(); ?>
			<?php if (! $this->_tpl_vars['po']['disabled'] && ! $this->_tpl_vars['disabled']): ?>
				<?php $_from = $this->_tpl_vars['po']['variants']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['var']):
?>
					<?php if ($this->_tpl_vars['var']['image_pair']['image_id']): ?>
						<?php if ($this->_tpl_vars['var']['variant_id'] == $this->_tpl_vars['selected_variant']): ?><?php $this->assign('_class', "product-variant-image-selected", false); ?><?php else: ?><?php $this->assign('_class', "product-variant-image-unselected", false); ?><?php endif; ?>
						<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('class' => "hand ".($this->_tpl_vars['_class'])." object-image", 'show_thumbnail' => 'Y', 'images' => $this->_tpl_vars['var']['image_pair'], 'object_type' => 'product_option', 'image_width' => '50', 'image_height' => '50', 'obj_id' => "variant_image_".($this->_tpl_vars['obj_prefix']).($this->_tpl_vars['id'])."_".($this->_tpl_vars['po']['option_id'])."_".($this->_tpl_vars['var']['variant_id']), 'image_onclick' => "fn_set_option_value('".($this->_tpl_vars['obj_prefix']).($this->_tpl_vars['id'])."', '".($this->_tpl_vars['po']['option_id'])."', '".($this->_tpl_vars['var']['variant_id'])."'); void(0);", )); ?>
<?php echo ''; ?><?php if ($this->_tpl_vars['capture_image']): ?><?php echo ''; ?><?php ob_start(); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php if (! $this->_tpl_vars['obj_id']): ?><?php echo ''; ?><?php echo smarty_function_math(array('equation' => "rand()",'assign' => 'obj_id'), $this);?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php $this->assign('flash', false, false); ?><?php echo ''; ?><?php if ($this->_tpl_vars['show_thumbnail'] != 'Y'): ?><?php echo ''; ?><?php if (! $this->_tpl_vars['image_width']): ?><?php echo ''; ?><?php if ($this->_tpl_vars['images']['icon']['image_x']): ?><?php echo ''; ?><?php $this->assign('image_width', $this->_tpl_vars['images']['icon']['image_x'], false); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php if ($this->_tpl_vars['images']['icon']['image_y']): ?><?php echo ''; ?><?php $this->assign('image_height', $this->_tpl_vars['images']['icon']['image_y'], false); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php if (! $this->_tpl_vars['image_width'] || ! $this->_tpl_vars['image_height']): ?><?php echo ''; ?><?php if ($this->_tpl_vars['images']['detailed']['image_x']): ?><?php echo ''; ?><?php $this->assign('image_width', $this->_tpl_vars['images']['detailed']['image_x'], false); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php if ($this->_tpl_vars['images']['detailed']['image_y']): ?><?php echo ''; ?><?php $this->assign('image_height', $this->_tpl_vars['images']['detailed']['image_y'], false); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php if ($this->_tpl_vars['images']['icon']['image_x'] && $this->_tpl_vars['images']['icon']['image_y']): ?><?php echo ''; ?><?php echo smarty_function_math(array('equation' => "new_x * y / x",'new_x' => $this->_tpl_vars['image_width'],'x' => $this->_tpl_vars['images']['icon']['image_x'],'y' => $this->_tpl_vars['images']['icon']['image_y'],'format' => "%d",'assign' => 'image_height'), $this);?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php if (! $this->_tpl_vars['image_height'] && $this->_tpl_vars['images']['detailed']['image_x'] && $this->_tpl_vars['images']['detailed']['image_y']): ?><?php echo ''; ?><?php echo smarty_function_math(array('equation' => "new_x * y / x",'new_x' => $this->_tpl_vars['image_width'],'x' => $this->_tpl_vars['images']['detailed']['image_x'],'y' => $this->_tpl_vars['images']['detailed']['image_y'],'format' => "%d",'assign' => 'image_height'), $this);?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php if ($this->_tpl_vars['max_width'] && ! $this->_tpl_vars['image_width']): ?><?php echo ''; ?><?php if ($this->_tpl_vars['images']['icon']['image_x']): ?><?php echo ''; ?><?php $this->assign('image_width', $this->_tpl_vars['images']['icon']['image_x'], false); ?><?php echo ''; ?><?php elseif ($this->_tpl_vars['images']['detailed']['image_x']): ?><?php echo ''; ?><?php $this->assign('image_width', $this->_tpl_vars['images']['detailed']['image_x'], false); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php if ($this->_tpl_vars['max_height'] && ! $this->_tpl_vars['image_height']): ?><?php echo ''; ?><?php if ($this->_tpl_vars['images']['icon']['image_y']): ?><?php echo ''; ?><?php $this->assign('image_height', $this->_tpl_vars['images']['icon']['image_y'], false); ?><?php echo ''; ?><?php elseif ($this->_tpl_vars['images']['detailed']['image_y']): ?><?php echo ''; ?><?php $this->assign('image_height', $this->_tpl_vars['images']['detailed']['image_y'], false); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php if ($this->_tpl_vars['max_width'] && $this->_tpl_vars['image_width'] && $this->_tpl_vars['image_width'] > $this->_tpl_vars['max_width']): ?><?php echo ''; ?><?php $this->assign('image_width', $this->_tpl_vars['max_width'], false); ?><?php echo ''; ?><?php echo smarty_function_math(array('equation' => "new_x * y / x",'new_x' => $this->_tpl_vars['image_width'],'x' => smarty_modifier_default(@$this->_tpl_vars['images']['icon']['image_x'], @$this->_tpl_vars['images']['detailed']['image_x']),'y' => smarty_modifier_default(@$this->_tpl_vars['images']['icon']['image_y'], @$this->_tpl_vars['images']['detailed']['image_y']),'format' => "%d",'assign' => 'image_height'), $this);?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php if ($this->_tpl_vars['max_height'] && $this->_tpl_vars['image_height'] && $this->_tpl_vars['image_height'] > $this->_tpl_vars['max_height']): ?><?php echo ''; ?><?php $this->assign('image_height', $this->_tpl_vars['max_height'], false); ?><?php echo ''; ?><?php echo smarty_function_math(array('equation' => "new_y * x / y",'new_y' => $this->_tpl_vars['image_height'],'y' => smarty_modifier_default(@$this->_tpl_vars['images']['icon']['image_y'], @$this->_tpl_vars['images']['detailed']['image_y']),'x' => smarty_modifier_default(@$this->_tpl_vars['images']['icon']['image_x'], @$this->_tpl_vars['images']['detailed']['image_x']),'format' => "%d",'assign' => 'image_width'), $this);?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php if ($this->_tpl_vars['images']['icon']): ?><?php echo ''; ?><?php $this->assign('image_id', $this->_tpl_vars['images']['image_id'], false); ?><?php echo ''; ?><?php elseif ($this->_tpl_vars['images']['detailed']): ?><?php echo ''; ?><?php $this->assign('image_id', $this->_tpl_vars['images']['detailed_id'], false); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php if ($this->_tpl_vars['show_detailed_link'] && $this->_tpl_vars['images']['detailed_id']): ?><?php echo '<span class="'; ?><?php if (! $this->_tpl_vars['images']['detailed_id'] || $this->_tpl_vars['flash']): ?><?php echo 'hidden'; ?><?php endif; ?><?php echo ' '; ?><?php echo $this->_tpl_vars['detailed_link_class']; ?><?php echo ' larger-image-wrap center" id="box_det_img_link_'; ?><?php echo $this->_tpl_vars['obj_id']; ?><?php echo '"><a class="cm-external-click cm-view-larger-image" rev="det_img_link_'; ?><?php echo $this->_tpl_vars['obj_id']; ?><?php echo '" title="'; ?><?php echo fn_get_lang_var('view_larger_image', $this->getLanguage()); ?><?php echo '"></a></span>'; ?><?php endif; ?><?php echo ''; ?><?php if (! $this->_tpl_vars['images']['icon']['is_flash'] && ! $this->_tpl_vars['images']['detailed']['is_flash']): ?><?php echo ''; ?><?php if ($this->_tpl_vars['show_thumbnail'] == 'Y' && ( $this->_tpl_vars['image_width'] || $this->_tpl_vars['image_height'] ) && $this->_tpl_vars['image_id']): ?><?php echo ''; ?><?php if ($this->_tpl_vars['image_width'] && $this->_tpl_vars['image_height']): ?><?php echo ''; ?><?php $this->assign('make_box', true, false); ?><?php echo ''; ?><?php $this->assign('proportional', true, false); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php $this->assign('object_type', smarty_modifier_default(@$this->_tpl_vars['object_type'], 'product'), false); ?><?php echo ''; ?><?php if ($this->_tpl_vars['images']['icon']['image_path']): ?><?php echo ''; ?><?php $this->assign('image_path', $this->_tpl_vars['images']['icon']['image_path'], false); ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php $this->assign('image_path', $this->_tpl_vars['images']['detailed']['image_path'], false); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php $this->assign('icon_image_path', smarty_modifier_escape(fn_generate_thumbnail(smarty_modifier_unescape($this->_tpl_vars['image_path']), $this->_tpl_vars['image_width'], $this->_tpl_vars['image_height'], $this->_tpl_vars['make_box'])), false); ?><?php echo ''; ?><?php if ($this->_tpl_vars['absolute_image_path']): ?><?php echo ''; ?><?php $this->assign('icon_image_path', fn_convert_relative_to_absolute_image_url($this->_tpl_vars['icon_image_path']), false); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php if ($this->_tpl_vars['make_box'] && ! $this->_tpl_vars['proportional']): ?><?php echo ''; ?><?php $this->assign('image_height', $this->_tpl_vars['image_width'], false); ?><?php echo ''; ?><?php elseif ($this->_tpl_vars['object_type'] == 'detailed_product'): ?><?php echo ''; ?><?php if (! $this->_tpl_vars['image_height'] && $this->_tpl_vars['image_width']): ?><?php echo ''; ?><?php if ($this->_tpl_vars['images']['icon']['image_x'] && $this->_tpl_vars['images']['icon']['image_y']): ?><?php echo ''; ?><?php echo smarty_function_math(array('equation' => "new_x * y / x",'new_x' => $this->_tpl_vars['image_width'],'x' => $this->_tpl_vars['images']['icon']['image_x'],'y' => $this->_tpl_vars['images']['icon']['image_y'],'format' => "%d",'assign' => 'image_height'), $this);?><?php echo ''; ?><?php elseif ($this->_tpl_vars['images']['detailed']['image_x'] && $this->_tpl_vars['images']['detailed']['image_y']): ?><?php echo ''; ?><?php echo smarty_function_math(array('equation' => "new_x * y / x",'new_x' => $this->_tpl_vars['image_width'],'x' => $this->_tpl_vars['images']['detailed']['image_x'],'y' => $this->_tpl_vars['images']['detailed']['image_y'],'format' => "%d",'assign' => 'image_height'), $this);?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php elseif (! $this->_tpl_vars['image_width'] && $this->_tpl_vars['image_height']): ?><?php echo ''; ?><?php if ($this->_tpl_vars['images']['icon']['image_x'] && $this->_tpl_vars['images']['icon']['image_y']): ?><?php echo ''; ?><?php echo smarty_function_math(array('equation' => "new_x * y / x",'new_x' => $this->_tpl_vars['image_height'],'x' => $this->_tpl_vars['images']['icon']['image_y'],'y' => $this->_tpl_vars['images']['icon']['image_x'],'format' => "%d",'assign' => 'image_width'), $this);?><?php echo ''; ?><?php elseif ($this->_tpl_vars['images']['detailed']['image_x'] && $this->_tpl_vars['images']['detailed']['image_y']): ?><?php echo ''; ?><?php echo smarty_function_math(array('equation' => "new_x * y / x",'new_x' => $this->_tpl_vars['image_height'],'x' => $this->_tpl_vars['images']['detailed']['image_y'],'y' => $this->_tpl_vars['images']['detailed']['image_x'],'format' => "%d",'assign' => 'image_width'), $this);?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php $this->assign('icon_image_path', $this->_tpl_vars['images']['icon']['image_path'], false); ?><?php echo ''; ?><?php if (! $this->_tpl_vars['icon_image_path']): ?><?php echo ''; ?><?php if ($this->_tpl_vars['object_type'] == 'detailed_product' && $this->_tpl_vars['images']['detailed']['image_x']): ?><?php echo ''; ?><?php if ($this->_tpl_vars['settings']['Thumbnails']['product_details_thumbnail_width']): ?><?php echo ''; ?><?php $this->assign('image_width', $this->_tpl_vars['settings']['Thumbnails']['product_details_thumbnail_width'], false); ?><?php echo ''; ?><?php if ($this->_tpl_vars['make_box'] && ! $this->_tpl_vars['proportional']): ?><?php echo ''; ?><?php $this->assign('image_height', $this->_tpl_vars['image_width'], false); ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php echo smarty_function_math(array('equation' => "new_x * y / x",'new_x' => $this->_tpl_vars['image_width'],'x' => $this->_tpl_vars['images']['detailed']['image_x'],'y' => $this->_tpl_vars['images']['detailed']['image_y'],'format' => "%d",'assign' => 'image_height'), $this);?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php $this->assign('icon_image_path', smarty_modifier_escape(fn_generate_thumbnail(smarty_modifier_unescape($this->_tpl_vars['images']['detailed']['image_path']), $this->_tpl_vars['image_width'], $this->_tpl_vars['image_height'], $this->_tpl_vars['make_box'])), false); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php if ($this->_tpl_vars['show_detailed_link'] && $this->_tpl_vars['images']['detailed_id']): ?><?php echo ''; ?><?php if ($this->_tpl_vars['object_type'] == 'detailed_product' && ( $this->_tpl_vars['settings']['Thumbnails']['product_detailed_image_width'] || $this->_tpl_vars['settings']['Thumbnails']['product_detailed_image_height'] )): ?><?php echo ''; ?><?php $this->assign('detailed_image_path', smarty_modifier_escape(fn_generate_thumbnail(smarty_modifier_unescape($this->_tpl_vars['images']['detailed']['image_path']), $this->_tpl_vars['settings']['Thumbnails']['product_detailed_image_width'], $this->_tpl_vars['settings']['Thumbnails']['product_detailed_image_height'], $this->_tpl_vars['make_box'])), false); ?><?php echo ''; ?><?php elseif ($this->_tpl_vars['object_type'] == 'detailed_category' && ( $this->_tpl_vars['settings']['Thumbnails']['category_detailed_image_width'] || $this->_tpl_vars['settings']['Thumbnails']['category_detailed_image_height'] )): ?><?php echo ''; ?><?php $this->assign('detailed_image_path', smarty_modifier_escape(fn_generate_thumbnail(smarty_modifier_unescape($this->_tpl_vars['images']['detailed']['image_path']), $this->_tpl_vars['settings']['Thumbnails']['category_detailed_image_width'], $this->_tpl_vars['settings']['Thumbnails']['category_detailed_image_height'], $this->_tpl_vars['make_box'])), false); ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php $this->assign('detailed_image_path', $this->_tpl_vars['images']['detailed']['image_path'], false); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php if ($this->_tpl_vars['icon_image_path'] || ! $this->_tpl_vars['hide_if_no_image']): ?><?php echo ''; ?><?php if ($this->_tpl_vars['detailed_image_path'] || $this->_tpl_vars['wrap_image']): ?><?php echo '<a id="det_img_link_'; ?><?php echo $this->_tpl_vars['obj_id']; ?><?php echo '" '; ?><?php if ($this->_tpl_vars['detailed_image_path'] && $this->_tpl_vars['rel']): ?><?php echo 'rel="'; ?><?php echo $this->_tpl_vars['rel']; ?><?php echo '"'; ?><?php endif; ?><?php echo ' '; ?><?php if ($this->_tpl_vars['rel']): ?><?php echo 'rev="'; ?><?php echo $this->_tpl_vars['rel']; ?><?php echo '"'; ?><?php endif; ?><?php echo ' class="'; ?><?php echo $this->_tpl_vars['link_class']; ?><?php echo ' '; ?><?php if ($this->_tpl_vars['detailed_image_path']): ?><?php echo 'cm-previewer'; ?><?php endif; ?><?php echo '" '; ?><?php if ($this->_tpl_vars['detailed_image_path']): ?><?php echo 'href="'; ?><?php echo $this->_tpl_vars['detailed_image_path']; ?><?php echo '" title="'; ?><?php echo $this->_tpl_vars['images']['detailed']['alt']; ?><?php echo '"'; ?><?php endif; ?><?php echo '>'; ?><?php endif; ?><?php echo ''; ?><?php $this->assign('alt_text', smarty_modifier_default(@$this->_tpl_vars['images']['icon']['alt'], @$this->_tpl_vars['images']['detailed']['alt']), false); ?><?php echo '<img class="'; ?><?php echo $this->_tpl_vars['valign']; ?><?php echo ' '; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '"  '; ?><?php if ($this->_tpl_vars['obj_id'] && ! $this->_tpl_vars['no_ids']): ?><?php echo 'id="det_img_'; ?><?php echo $this->_tpl_vars['obj_id']; ?><?php echo '"'; ?><?php endif; ?><?php echo ' src="'; ?><?php echo $this->_tpl_vars['config']['full_host_name']; ?><?php echo ''; ?><?php echo smarty_modifier_default(@$this->_tpl_vars['icon_image_path'], @$this->_tpl_vars['config']['no_image_path']); ?><?php echo '" '; ?><?php if ($this->_tpl_vars['image_width']): ?><?php echo 'width="'; ?><?php echo $this->_tpl_vars['image_width']; ?><?php echo '"'; ?><?php endif; ?><?php echo ' '; ?><?php if ($this->_tpl_vars['image_height']): ?><?php echo 'height="'; ?><?php echo $this->_tpl_vars['image_height']; ?><?php echo '"'; ?><?php endif; ?><?php echo ' alt="'; ?><?php echo $this->_tpl_vars['alt_text']; ?><?php echo '" title="'; ?><?php echo $this->_tpl_vars['alt_text']; ?><?php echo '" '; ?><?php if ($this->_tpl_vars['image_onclick']): ?><?php echo 'onclick="'; ?><?php echo $this->_tpl_vars['image_onclick']; ?><?php echo '"'; ?><?php endif; ?><?php echo ' border="0" />'; ?><?php if ($this->_tpl_vars['detailed_image_path'] || $this->_tpl_vars['wrap_image']): ?><?php echo '</a>'; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php $this->assign('flash', true, false); ?><?php echo ''; ?><?php if ($this->_tpl_vars['images']['icon']['is_flash']): ?><?php echo ''; ?><?php $this->assign('flash_path', $this->_tpl_vars['images']['icon']['image_path'], false); ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php $this->assign('flash_path', $this->_tpl_vars['images']['detailed']['image_path'], false); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php $this->assign('icon_image_path', smarty_modifier_default(@$this->_tpl_vars['flash_path'], @$this->_tpl_vars['config']['no_image_path']), false); ?><?php echo ''; ?><?php $this->assign('detailed_image_path', smarty_modifier_default(@$this->_tpl_vars['flash_path'], @$this->_tpl_vars['config']['no_image_path']), false); ?><?php echo ''; ?><?php if ($this->_tpl_vars['show_detailed_link'] && $this->_tpl_vars['images']['detailed_id'] || $this->_tpl_vars['wrap_image']): ?><?php echo '<a id="det_img_link_'; ?><?php echo $this->_tpl_vars['obj_id']; ?><?php echo '" '; ?><?php if ($this->_tpl_vars['rel']): ?><?php echo 'rel="'; ?><?php echo $this->_tpl_vars['rel']; ?><?php echo '"'; ?><?php endif; ?><?php echo ' '; ?><?php if ($this->_tpl_vars['rel']): ?><?php echo 'rev="'; ?><?php echo $this->_tpl_vars['rel']; ?><?php echo '"'; ?><?php endif; ?><?php echo ' class="'; ?><?php echo $this->_tpl_vars['link_class']; ?><?php echo ' swf-thumb '; ?><?php if ($this->_tpl_vars['show_detailed_link'] && $this->_tpl_vars['images']['detailed_id']): ?><?php echo 'cm-previewer'; ?><?php endif; ?><?php echo '" '; ?><?php if ($this->_tpl_vars['show_detailed_link'] && $this->_tpl_vars['images']['detailed_id']): ?><?php echo 'href="'; ?><?php echo $this->_tpl_vars['config']['full_host_name']; ?><?php echo ''; ?><?php echo smarty_modifier_default(@$this->_tpl_vars['flash_path'], @$this->_tpl_vars['config']['no_image_path']); ?><?php echo '"'; ?><?php endif; ?><?php echo ' onclick="return false;">'; ?><?php endif; ?><?php echo '<span id="'; ?><?php echo $this->_tpl_vars['obj_id']; ?><?php echo '" '; ?><?php if ($this->_tpl_vars['image_onclick']): ?><?php echo 'onmousedown="'; ?><?php echo $this->_tpl_vars['image_onclick']; ?><?php echo '"'; ?><?php endif; ?><?php echo ' class="option-changer '; ?><?php if ($this->_tpl_vars['_class']): ?><?php echo ''; ?><?php echo $this->_tpl_vars['_class']; ?><?php echo ' object-image'; ?><?php endif; ?><?php echo '" style="'; ?><?php if ($this->_tpl_vars['image_width']): ?><?php echo 'width: '; ?><?php echo $this->_tpl_vars['image_width']; ?><?php echo 'px;'; ?><?php endif; ?><?php echo ' '; ?><?php if ($this->_tpl_vars['image_height']): ?><?php echo 'height: '; ?><?php echo $this->_tpl_vars['image_height']; ?><?php echo 'px;'; ?><?php endif; ?><?php echo ' position: relative; z-index: 0; margin: 3px '; ?><?php if (! ( $this->_tpl_vars['show_detailed_link'] && $this->_tpl_vars['images']['detailed_id'] || $this->_tpl_vars['wrap_image'] )): ?><?php echo 'auto'; ?><?php endif; ?><?php echo ';"><span class="option-changer-container" style="'; ?><?php if ($this->_tpl_vars['image_width']): ?><?php echo 'width: '; ?><?php echo $this->_tpl_vars['image_width']; ?><?php echo 'px;'; ?><?php endif; ?><?php echo ' '; ?><?php if ($this->_tpl_vars['image_height']): ?><?php echo 'height: '; ?><?php echo $this->_tpl_vars['image_height']; ?><?php echo 'px;'; ?><?php endif; ?><?php echo '"><span id="swf_'; ?><?php echo $this->_tpl_vars['obj_id']; ?><?php echo '"></span></span><script type="text/javascript">if (typeof swfobject == \'undefined\') '; ?>{<?php echo 'var res = $.get(\'lib/js/swfobject/swfobject.js\', function() '; ?>{<?php echo 'swfobject.embedSWF("'; ?><?php echo $this->_tpl_vars['config']['full_host_name']; ?><?php echo ''; ?><?php echo smarty_modifier_default(@$this->_tpl_vars['flash_path'], @$this->_tpl_vars['config']['no_image_path']); ?><?php echo '", "swf_'; ?><?php echo $this->_tpl_vars['obj_id']; ?><?php echo '", "'; ?><?php if ($this->_tpl_vars['image_width']): ?><?php echo ''; ?><?php echo $this->_tpl_vars['image_width']; ?><?php echo ''; ?><?php else: ?><?php echo '30'; ?><?php endif; ?><?php echo '", "'; ?><?php if ($this->_tpl_vars['image_height']): ?><?php echo ''; ?><?php echo $this->_tpl_vars['image_height']; ?><?php echo ''; ?><?php else: ?><?php echo '30'; ?><?php endif; ?><?php echo '", "9.0.0", "lib/js/swfobject/expressInstall.swf"'; ?><?php if ($this->_tpl_vars['flash_vars']): ?><?php echo ' ,'; ?><?php echo $this->_tpl_vars['flash_vars']; ?><?php echo ','; ?><?php else: ?><?php echo ',"",'; ?><?php endif; ?><?php echo ' '; ?><?php echo '{wmode: \'opaque\'}'; ?><?php echo ');'; ?>}<?php echo ');'; ?>}<?php echo ' else '; ?>{<?php echo 'swfobject.embedSWF("'; ?><?php echo $this->_tpl_vars['config']['full_host_name']; ?><?php echo ''; ?><?php echo smarty_modifier_default(@$this->_tpl_vars['flash_path'], @$this->_tpl_vars['config']['no_image_path']); ?><?php echo '", "swf_'; ?><?php echo $this->_tpl_vars['obj_id']; ?><?php echo '", "'; ?><?php if ($this->_tpl_vars['image_width']): ?><?php echo ''; ?><?php echo $this->_tpl_vars['image_width']; ?><?php echo ''; ?><?php else: ?><?php echo '30'; ?><?php endif; ?><?php echo '", "'; ?><?php if ($this->_tpl_vars['image_height']): ?><?php echo ''; ?><?php echo $this->_tpl_vars['image_height']; ?><?php echo ''; ?><?php else: ?><?php echo '30'; ?><?php endif; ?><?php echo '", "9.0.0", "lib/js/swfobject/expressInstall.swf"'; ?><?php if ($this->_tpl_vars['flash_vars']): ?><?php echo ' ,'; ?><?php echo $this->_tpl_vars['flash_vars']; ?><?php echo ','; ?><?php else: ?><?php echo ',"",'; ?><?php endif; ?><?php echo ' '; ?><?php echo '{wmode: \'opaque\'}'; ?><?php echo ');'; ?>}<?php echo '</script><span class="option-changer-overlay'; ?><?php if ($this->_tpl_vars['show_detailed_link'] && $this->_tpl_vars['images']['detailed_id']): ?><?php echo ' cm-external-click'; ?><?php endif; ?><?php echo '" '; ?><?php if ($this->_tpl_vars['show_detailed_link'] && $this->_tpl_vars['images']['detailed_id']): ?><?php echo 'rev="det_img_link_'; ?><?php echo $this->_tpl_vars['obj_id']; ?><?php echo '"'; ?><?php endif; ?><?php echo '></span></span>'; ?><?php if ($this->_tpl_vars['show_detailed_link'] && $this->_tpl_vars['images']['detailed_id'] || $this->_tpl_vars['wrap_image']): ?><?php echo '</a>'; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php if ($this->_tpl_vars['capture_image']): ?><?php echo ''; ?><?php $this->_smarty_vars['capture']['image'] = ob_get_contents(); ob_end_clean(); ?><?php echo ''; ?><?php ob_start(); ?><?php echo ''; ?><?php echo smarty_modifier_default(@$this->_tpl_vars['icon_image_path'], @$this->_tpl_vars['config']['no_image_path']); ?><?php echo ''; ?><?php $this->_smarty_vars['capture']['icon_image_path'] = ob_get_contents(); ob_end_clean(); ?><?php echo ''; ?><?php ob_start(); ?><?php echo ''; ?><?php echo smarty_modifier_default(@$this->_tpl_vars['detailed_image_path'], @$this->_tpl_vars['config']['no_image_path']); ?><?php echo ''; ?><?php $this->_smarty_vars['capture']['detailed_image_path'] = ob_get_contents(); ob_end_clean(); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?>

<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
					<?php endif; ?>
				<?php endforeach; endif; unset($_from); ?>
			<?php endif; ?>
		<?php $this->_smarty_vars['capture']['variant_images'] = ob_get_contents(); ob_end_clean(); ?>
		<?php if (trim($this->_smarty_vars['capture']['variant_images'])): ?><div class="product-variant-image clear-both"><?php echo $this->_smarty_vars['capture']['variant_images']; ?>
</div><?php endif; ?>
	</div>
	<?php endforeach; endif; unset($_from); ?>
</div>
<?php if ($this->_tpl_vars['product']['show_exception_warning'] == 'Y'): ?>
	<p id="warning_<?php echo $this->_tpl_vars['obj_prefix']; ?>
<?php echo $this->_tpl_vars['id']; ?>
" class="cm-no-combinations<?php if ($this->_tpl_vars['location'] != 'cart'): ?>-<?php echo $this->_tpl_vars['obj_prefix']; ?>
<?php echo $this->_tpl_vars['id']; ?>
<?php endif; ?> price"><?php echo fn_get_lang_var('nocombination', $this->getLanguage()); ?>
</p>
<?php endif; ?>
<?php endif; ?>

<?php if (! $this->_tpl_vars['no_script']): ?>
<script type="text/javascript">
//<![CDATA[
function fn_form_pre_<?php echo smarty_modifier_default(@$this->_tpl_vars['form_name'], "product_form_".($this->_tpl_vars['obj_prefix']).($this->_tpl_vars['id'])); ?>
()
<?php echo $this->_tpl_vars['ldelim']; ?>

<?php if ($this->_tpl_vars['location'] == 'cart'): ?>
	warning_class = '.cm-no-combinations';
<?php else: ?>
	warning_class = '.cm-no-combinations-<?php echo $this->_tpl_vars['obj_prefix']; ?>
<?php echo $this->_tpl_vars['id']; ?>
';
<?php endif; ?>
<?php echo '
	if ($(warning_class).length) {
		$.showNotifications({\'forbidden_combination\': {\'type\': \'W\', \'title\': lang.warning, \'message\': lang.cannot_buy, \'save_state\': false}});
		return false;
	} else {
		
		return true;
	}
'; ?>

<?php echo $this->_tpl_vars['rdelim']; ?>
;

//]]>
</script>
<?php endif; ?>