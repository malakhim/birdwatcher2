<?php /* Smarty version 2.6.18, created on 2013-09-21 19:33:01
         compiled from views/block_manager/components/setting_element.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'views/block_manager/components/setting_element.tpl', 28, false),array('modifier', 'default', 'views/block_manager/components/setting_element.tpl', 36, false),array('modifier', 'is_array', 'views/block_manager/components/setting_element.tpl', 89, false),array('function', 'html_checkboxes', 'views/block_manager/components/setting_element.tpl', 56, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('filling'));
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
			 ?><?php if ($this->_tpl_vars['option']['force_open']): ?>
<script type="text/javascript">
$(function() <?php echo $this->_tpl_vars['ldelim']; ?>

	$('#additional_<?php echo $this->_tpl_vars['set_id']; ?>
').show();
<?php echo $this->_tpl_vars['rdelim']; ?>
);
</script>
<?php endif; ?>

<?php if (! $this->_tpl_vars['option']['remove_indent']): ?>
<div class="form-field <?php if ($this->_tpl_vars['editable']): ?>cm-no-hide-input<?php endif; ?>">
<?php endif; ?>

<?php if (! $this->_tpl_vars['option']['hide_label']): ?>
	<label for="<?php echo $this->_tpl_vars['html_id']; ?>
"<?php if ($this->_tpl_vars['option']['required']): ?> class="cm-required"<?php endif; ?>><?php if ($this->_tpl_vars['option']['option_name']): ?><?php echo fn_get_lang_var($this->_tpl_vars['option']['option_name'], $this->getLanguage()); ?>
<?php else: ?><?php echo fn_get_lang_var($this->_tpl_vars['name'], $this->getLanguage()); ?>
<?php endif; ?><?php if ($this->_tpl_vars['option']['tooltip']): ?><?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('tooltip' => $this->_tpl_vars['option']['tooltip'], )); ?><?php if ($this->_tpl_vars['tooltip']): ?> (<a class="cm-tooltip<?php if ($this->_tpl_vars['params']): ?> <?php echo $this->_tpl_vars['params']; ?>
<?php endif; ?>" title="<?php echo smarty_modifier_escape($this->_tpl_vars['tooltip'], 'html'); ?>
">?</a>)<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php endif; ?>:</label>
<?php endif; ?>
<?php if ($this->_tpl_vars['option']['type'] == 'checkbox'): ?>
	<input type="hidden" name="<?php echo $this->_tpl_vars['html_name']; ?>
" value="N" />
	<input type="checkbox" class="checkbox" name="<?php echo $this->_tpl_vars['html_name']; ?>
" value="Y" id="<?php echo $this->_tpl_vars['html_id']; ?>
" <?php if ($this->_tpl_vars['value'] && $this->_tpl_vars['value'] == 'Y' || ! $this->_tpl_vars['value'] && $this->_tpl_vars['option']['default_value'] == 'Y'): ?>checked="checked"<?php endif; ?> />
<?php elseif ($this->_tpl_vars['option']['type'] == 'selectbox'): ?>
	<?php $this->assign('value', smarty_modifier_default(@$this->_tpl_vars['value'], @$this->_tpl_vars['option']['default_value']), false); ?>

	<select id="<?php echo $this->_tpl_vars['html_id']; ?>
" name="<?php echo $this->_tpl_vars['html_name']; ?>
" <?php if ($this->_tpl_vars['option']['values_settings']): ?>class="cm-reload-form"<?php endif; ?>>
	<?php $_from = $this->_tpl_vars['option']['values']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
		<option value="<?php echo $this->_tpl_vars['k']; ?>
" <?php if ($this->_tpl_vars['value'] == $this->_tpl_vars['k']): ?>selected="selected"<?php endif; ?>><?php if ($this->_tpl_vars['option']['no_lang']): ?><?php echo $this->_tpl_vars['v']; ?>
<?php else: ?><?php echo fn_get_lang_var($this->_tpl_vars['v'], $this->getLanguage()); ?>
<?php endif; ?></option>
	<?php endforeach; endif; unset($_from); ?>
	</select>

	<?php $this->assign('values_settings', $this->_tpl_vars['option']['values_settings'][$this->_tpl_vars['value']], false); ?>

	<?php if ($this->_tpl_vars['values_settings']): ?>
		<?php $_from = $this->_tpl_vars['values_settings']['settings']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['setting_name'] => $this->_tpl_vars['setting_data']):
?>
			<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/block_manager/components/setting_element.tpl", 'smarty_include_vars' => array('option' => $this->_tpl_vars['setting_data'],'name' => ($this->_tpl_vars['setting_name']),'block' => $this->_tpl_vars['block'],'html_id' => "block_".($this->_tpl_vars['html_id'])."_properties_".($this->_tpl_vars['name'])."_".($this->_tpl_vars['setting_name']),'html_name' => "block_data[properties][".($this->_tpl_vars['name'])."][".($this->_tpl_vars['value'])."][".($this->_tpl_vars['setting_name'])."]",'editable' => $this->_tpl_vars['editable'],'value' => $this->_tpl_vars['block']['properties'][$this->_tpl_vars['name']][$this->_tpl_vars['value']][$this->_tpl_vars['setting_name']])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<?php endforeach; endif; unset($_from); ?>
	<?php endif; ?>
<?php elseif ($this->_tpl_vars['option']['type'] == 'input' || $this->_tpl_vars['option']['type'] == 'input_long'): ?>
	<input id="<?php echo $this->_tpl_vars['html_id']; ?>
" class="input-text<?php if ($this->_tpl_vars['option']['type'] == 'input_long'): ?>-long<?php endif; ?>" name="<?php echo $this->_tpl_vars['html_name']; ?>
" value="<?php if ($this->_tpl_vars['value'] || $this->_tpl_vars['value'] === 0 || $this->_tpl_vars['value'] === '0'): ?><?php echo $this->_tpl_vars['value']; ?>
<?php else: ?><?php echo $this->_tpl_vars['option']['default_value']; ?>
<?php endif; ?>" />

<?php elseif ($this->_tpl_vars['option']['type'] == 'multiple_checkboxes'): ?>

	<?php echo smarty_function_html_checkboxes(array('name' => $this->_tpl_vars['html_name'],'options' => $this->_tpl_vars['option']['values'],'columns' => 4,'selected' => $this->_tpl_vars['value']), $this);?>

<?php elseif ($this->_tpl_vars['option']['type'] == 'text' || $this->_tpl_vars['option']['type'] == 'simple_text'): ?>
	<textarea id="<?php echo $this->_tpl_vars['html_id']; ?>
" name="<?php echo $this->_tpl_vars['html_name']; ?>
" cols="55" rows="8" class="<?php if ($this->_tpl_vars['option']['type'] == 'text'): ?>cm-wysiwyg<?php endif; ?> input-textarea-long"><?php echo $this->_tpl_vars['value']; ?>
</textarea>
	<?php if ($this->_tpl_vars['option']['type'] == 'text'): ?>
				<!--processForm-->
	<?php endif; ?>
<?php elseif ($this->_tpl_vars['option']['type'] == 'picker'): ?> 
	<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => $this->_tpl_vars['option']['picker'], 'smarty_include_vars' => array('checkbox_name' => 'block_items','data_id' => "objects_".($this->_tpl_vars['item']['chain_id'])."_",'input_name' => ($this->_tpl_vars['html_name']),'item_ids' => $this->_tpl_vars['value'],'params_array' => $this->_tpl_vars['option']['picker_params'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php elseif ($this->_tpl_vars['option']['type'] == 'enum'): ?>
	<?php if ($this->_tpl_vars['option']['fillings']): ?>
		<div class="form-field <?php if ($this->_tpl_vars['editable']): ?>cm-no-hide-input<?php endif; ?>">
			<label for="block_<?php echo $this->_tpl_vars['html_id']; ?>
_filling"><?php echo fn_get_lang_var('filling', $this->getLanguage()); ?>
:</label>
			<select id="block_<?php echo $this->_tpl_vars['html_id']; ?>
_filling" name="block_data[content][<?php echo $this->_tpl_vars['name']; ?>
][filling]" class="cm-reload-form">
				<?php $_from = $this->_tpl_vars['option']['fillings']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
					<option value="<?php echo $this->_tpl_vars['k']; ?>
" <?php if ($this->_tpl_vars['block']['content'][$this->_tpl_vars['name']]['filling'] == $this->_tpl_vars['k']): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var($this->_tpl_vars['k'], $this->getLanguage()); ?>
</option>
				<?php endforeach; endif; unset($_from); ?>
			</select>
			<?php $this->assign('filling', $this->_tpl_vars['block']['content'][$this->_tpl_vars['name']]['filling'], false); ?>
		</div>
		<?php if ($this->_tpl_vars['filling'] == 'manually'): ?>
			<div class="form-field <?php if ($this->_tpl_vars['editable']): ?>cm-no-hide-input<?php endif; ?>">
				<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => $this->_tpl_vars['option']['fillings']['manually']['picker'], 'smarty_include_vars' => array('checkbox_name' => 'block_items','data_id' => "objects_".($this->_tpl_vars['item']['chain_id'])."_",'input_name' => ($this->_tpl_vars['html_name'])."[item_ids]",'item_ids' => $this->_tpl_vars['block']['content'][$this->_tpl_vars['name']]['item_ids'],'params_array' => $this->_tpl_vars['option']['fillings']['manually']['picker_params'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			</div>
		<?php endif; ?>
		<?php if (is_array($this->_tpl_vars['option']['fillings'][$this->_tpl_vars['filling']]['settings'])): ?>		
			<?php $_from = $this->_tpl_vars['option']['fillings'][$this->_tpl_vars['filling']]['settings']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['setting_name'] => $this->_tpl_vars['setting_data']):
?>
				<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/block_manager/components/setting_element.tpl", 'smarty_include_vars' => array('option' => $this->_tpl_vars['setting_data'],'name' => ($this->_tpl_vars['setting_name']),'block' => $this->_tpl_vars['block'],'html_id' => "block_".($this->_tpl_vars['html_id'])."_properties_".($this->_tpl_vars['name'])."_".($this->_tpl_vars['setting_name']),'html_name' => "block_data[content][".($this->_tpl_vars['name'])."][".($this->_tpl_vars['setting_name'])."]",'editable' => $this->_tpl_vars['editable'],'value' => $this->_tpl_vars['block']['content'][$this->_tpl_vars['name']][$this->_tpl_vars['setting_name']])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<?php endforeach; endif; unset($_from); ?>
		<?php endif; ?>
	<?php endif; ?>
<?php elseif ($this->_tpl_vars['option']['type'] == 'template'): ?> 
	<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => $this->_tpl_vars['option']['template'], 'smarty_include_vars' => array('value' => $this->_tpl_vars['value'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php endif; ?>

<?php if (! $this->_tpl_vars['option']['remove_indent']): ?>
</div>
<?php endif; ?>