<?php /* Smarty version 2.6.18, created on 2014-03-08 23:32:54
         compiled from views/shippings/components/rates.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'split', 'views/shippings/components/rates.tpl', 22, false),array('function', 'cycle', 'views/shippings/components/rates.tpl', 53, false),array('modifier', 'fn_url', 'views/shippings/components/rates.tpl', 30, false),array('modifier', 'default', 'views/shippings/components/rates.tpl', 65, false),array('modifier', 'fn_check_company_id', 'views/shippings/components/rates.tpl', 74, false),array('modifier', 'replace', 'views/shippings/components/rates.tpl', 133, false),array('modifier', 'fn_check_view_permissions', 'views/shippings/components/rates.tpl', 315, false),array('modifier', 'substr_count', 'views/shippings/components/rates.tpl', 319, false),array('modifier', 'defined', 'views/shippings/components/rates.tpl', 332, false),array('block', 'hook', 'views/shippings/components/rates.tpl', 49, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('show_rate_for_destination','cost_dependences','check_uncheck_all','products_cost','rate_value','type','more_than','absolute','percent','delete','delete','no_items','more_than','absolute','percent','add_cost_dependences','add_cost_dependences','weight_dependences','check_uncheck_all','products_weight','rate_value','type','per','more_than','absolute','percent','delete','delete','no_items','more_than','absolute','percent','add_weight_dependences','add_weight_dependences','items_dependences','check_uncheck_all','products_amount','rate_value','type','per','item','more_than','items','absolute','percent','delete','delete','no_items','more_than','items','absolute','percent','add_items_dependences','add_items_dependences','delete_selected','choose_action','or','tools','add'));
?>
<?php 

				$rname = !empty($resource_name) ? $resource_name : $params['smarty_include_tpl_file'];
				if ($this->compile_check && empty($inline_no_check[$rname]) && $this->is_cached($rname)) {
					if ($this->check_inline_blocks(array (
  'common_templates/tools.tpl' => 1367063753,
))) {
						$_smarty_compile_path = $this->_get_compile_path($rname);
						$this->_compile_resource($rname, $_smarty_compile_path);
						$inline_no_check[$rname] = true;
						include $_smarty_compile_path;
						return;
					}
				}
			 ?><input type="hidden" name="shipping_id" value="<?php echo $this->_tpl_vars['_REQUEST']['shipping_id']; ?>
" />
<input type="hidden" name="rate_id" value="<?php echo $this->_tpl_vars['rate_data']['rate_id']; ?>
" />
<input type="hidden" name="destination_id" value="<?php echo $this->_tpl_vars['destination_id']; ?>
" />
<input type="hidden" name="selected_section" value="shipping_charges" />

<?php if ($this->_tpl_vars['shipping']['rate_calculation'] == 'M'): ?>

<?php echo smarty_function_split(array('data' => $this->_tpl_vars['destinations'],'size' => '6','assign' => 'splitted_destinations'), $this);?>


<div class="dashed-border">
	<p><?php echo fn_get_lang_var('show_rate_for_destination', $this->getLanguage()); ?>
:</p>
	<?php $_from = $this->_tpl_vars['splitted_destinations']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['sdests']):
?>
	<p>
	<?php $_from = $this->_tpl_vars['sdests']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['destination']):
?>
		<?php if ($this->_tpl_vars['destination']): ?>
			<span class="bull">&bull;</span>&nbsp;<?php if ($this->_tpl_vars['destination_id'] == $this->_tpl_vars['destination']['destination_id']): ?><span><?php echo $this->_tpl_vars['destination']['destination']; ?>
</span><?php else: ?><a href="<?php echo fn_url("shippings.update?shipping_id=".($this->_tpl_vars['_REQUEST']['shipping_id'])."&amp;destination_id=".($this->_tpl_vars['destination']['destination_id'])."&amp;selected_section=shipping_charges"); ?>
"><?php echo $this->_tpl_vars['destination']['destination']; ?>
</a><?php endif; ?>&nbsp;<?php if ($this->_tpl_vars['destination']['rates_defined']): ?>(+)<?php else: ?><?php endif; ?>&nbsp;&nbsp;&nbsp;
		<?php else: ?>
			&nbsp;
		<?php endif; ?>
	<?php endforeach; endif; unset($_from); ?>
	</p>
	<?php endforeach; endif; unset($_from); ?>
</div>

<?php endif; ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/subheader.tpl", 'smarty_include_vars' => array('title' => fn_get_lang_var('cost_dependences', $this->getLanguage()))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<table cellpadding="0" cellspacing="0" width="100%"	border="0" class="table">
<tr class="cm-first-sibling">
	<th>
		<input type="checkbox" name="check_all" value="Y" title="<?php echo fn_get_lang_var('check_uncheck_all', $this->getLanguage()); ?>
" class="checkbox cm-check-items-c" /></th>
	<th><?php echo fn_get_lang_var('products_cost', $this->getLanguage()); ?>
</th>
	<th><?php echo fn_get_lang_var('rate_value', $this->getLanguage()); ?>
</th>
	<th width="100%"><?php echo fn_get_lang_var('type', $this->getLanguage()); ?>
</th>
	<th><?php $this->_tag_stack[] = array('hook', array('name' => "shippings:cost_dependences_head")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
	<th>&nbsp;</th>
</tr>
<?php $_from = $this->_tpl_vars['rate_data']['rate_value']['C']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['rdf'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['rdf']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['rate']):
        $this->_foreach['rdf']['iteration']++;
?>
<tr <?php echo smarty_function_cycle(array('values' => "class=\"table-row\", "), $this);?>
>
	<td>
		<input type="checkbox" name="delete_rate_data[C][<?php echo $this->_tpl_vars['k']; ?>
]" value="Y" <?php if (($this->_foreach['rdf']['iteration'] <= 1)): ?>disabled="disabled"<?php endif; ?> class="checkbox cm-item-c cm-item" /></td>
	<td class="nowrap">
		<?php echo fn_get_lang_var('more_than', $this->getLanguage()); ?>
&nbsp;<?php echo $this->_tpl_vars['currencies'][$this->_tpl_vars['primary_currency']]['symbol']; ?>

		<?php if (($this->_foreach['rdf']['iteration'] <= 1)): ?>
			<input type="hidden" name="rate_data[C][0][amount]" value="0" />0
		<?php else: ?>
			<input type="text" name="rate_data[C][<?php echo $this->_tpl_vars['k']; ?>
][amount]" size="5" value="<?php echo $this->_tpl_vars['k']; ?>
" class="input-text" />
		<?php endif; ?>
	</td>
	<td>
		<input type="text" name="rate_data[C][<?php if (($this->_foreach['rdf']['iteration'] <= 1)): ?>0<?php else: ?><?php echo $this->_tpl_vars['k']; ?>
<?php endif; ?>][value]" size="5" value="<?php echo smarty_modifier_default(@$this->_tpl_vars['rate']['value'], '0'); ?>
" class="input-text" /></td>
	<td>
		<select name="rate_data[C][<?php if (($this->_foreach['rdf']['iteration'] <= 1)): ?>0<?php else: ?><?php echo $this->_tpl_vars['k']; ?>
<?php endif; ?>][type]">
			<option value="F" <?php if ($this->_tpl_vars['rate']['type'] == 'F'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('absolute', $this->getLanguage()); ?>
 (<?php echo $this->_tpl_vars['currencies'][$this->_tpl_vars['primary_currency']]['symbol']; ?>
)</option>
			<option value="P" <?php if ($this->_tpl_vars['rate']['type'] == 'P'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('percent', $this->getLanguage()); ?>
 (%)</option>
		</select></td>
	<td><?php $this->_tag_stack[] = array('hook', array('name' => "shippings:cost_dependences_body")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></td>
	<td class="nowrap">
		<?php ob_start(); ?>
		<?php if (! ($this->_foreach['rdf']['iteration'] <= 1) && fn_check_company_id('shippings', 'shipping_id', $this->_tpl_vars['_REQUEST']['shipping_id'])): ?>
			<li><a class="cm-confirm" href="<?php echo fn_url("shippings.delete_rate_value?rate_type=C&amp;amount=".($this->_tpl_vars['k'])."&amp;shipping_id=".($this->_tpl_vars['_REQUEST']['shipping_id'])."&amp;destination_id=".($this->_tpl_vars['destination_id'])."&amp;rate_id=".($this->_tpl_vars['rate_data']['rate_id'])); ?>
"><?php echo fn_get_lang_var('delete', $this->getLanguage()); ?>
</a></li>
		<?php else: ?>
			<li><span class="undeleted-element"><?php echo fn_get_lang_var('delete', $this->getLanguage()); ?>
</span></li>
		<?php endif; ?>
		<?php $this->_smarty_vars['capture']['tools_items'] = ob_get_contents(); ob_end_clean(); ?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/table_tools_list.tpl", 'smarty_include_vars' => array('prefix' => $this->_foreach['rdf']['iteration'],'tools_list' => $this->_smarty_vars['capture']['tools_items'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</td>
</tr>
<?php endforeach; else: ?>
<tr class="no-items">
	<td colspan="6">
	<input type="hidden" name="rate_data[C][0][amount]" value="0" />
	<input type="hidden" name="rate_data[C][0][value]" value="0" />
	<input type="hidden" name="rate_data[C][0][type]" value="F" />
	<p><?php echo fn_get_lang_var('no_items', $this->getLanguage()); ?>
</p></td>
</tr>
<?php endif; unset($_from); ?>
</table>

<div class="clear">
	<?php if (! $this->_tpl_vars['hide_for_vendor']): ?>
	<?php ob_start(); ?>

	<table cellpadding="0" cellspacing="0" border="0" class="table">
	<tr id="box_upd_rate_celm">
		<td>
			<?php echo fn_get_lang_var('more_than', $this->getLanguage()); ?>
&nbsp;<?php echo $this->_tpl_vars['currencies'][$this->_tpl_vars['primary_currency']]['symbol']; ?>
&nbsp;<input type="text" name="add_rate_data[C][0][amount]" size="5" value="" class="input-text" />
			<input type="text" name="add_rate_data[C][0][value]" size="5" value="" class="input-text" />
			<select name="add_rate_data[C][0][type]">
				<option value="F"><?php echo fn_get_lang_var('absolute', $this->getLanguage()); ?>
 (<?php echo $this->_tpl_vars['currencies'][$this->_tpl_vars['primary_currency']]['symbol']; ?>
)</option>
				<option value="P"><?php echo fn_get_lang_var('percent', $this->getLanguage()); ?>
 (%)</option>
			</select></td>
		<td>
		<?php $this->_tag_stack[] = array('hook', array('name' => "shippings:cost_dependences_new")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
		<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
		</td>
		<td><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/multiple_buttons.tpl", 'smarty_include_vars' => array('item_id' => 'upd_rate_celm')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></td>
	</tr>
	</table>

	<div class="buttons-container">
		<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/save_cancel.tpl", 'smarty_include_vars' => array('create' => true,'but_name' => "dispatch[shippings.update_shipping]",'cancel_action' => 'close')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</div>
	<?php $this->_smarty_vars['capture']['add_new_picker'] = ob_get_contents(); ob_end_clean(); ?>

	<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/popupbox.tpl", 'smarty_include_vars' => array('id' => 'add_cost_dependences','text' => fn_get_lang_var('add_cost_dependences', $this->getLanguage()),'content' => $this->_smarty_vars['capture']['add_new_picker'],'link_text' => fn_get_lang_var('add_cost_dependences', $this->getLanguage()),'act' => 'general')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php endif; ?>
</div>

<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/subheader.tpl", 'smarty_include_vars' => array('title' => fn_get_lang_var('weight_dependences', $this->getLanguage()))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<table cellpadding="0" cellspacing="0" width="100%"	border="0" class="table">
<tr class="cm-first-sibling">
	<th>
		<input type="checkbox" name="check_all" value="Y" title="<?php echo fn_get_lang_var('check_uncheck_all', $this->getLanguage()); ?>
" class="checkbox cm-check-items-w" /></th>
	<th width="150"><?php echo fn_get_lang_var('products_weight', $this->getLanguage()); ?>
</th>
	<th><?php echo fn_get_lang_var('rate_value', $this->getLanguage()); ?>
</th>
	<th><?php echo fn_get_lang_var('type', $this->getLanguage()); ?>
</th>
	<th><?php echo smarty_modifier_replace(fn_get_lang_var('per', $this->getLanguage()), "[object]", $this->_tpl_vars['settings']['General']['weight_symbol']); ?>
</th>
	<th><?php $this->_tag_stack[] = array('hook', array('name' => "shippings:weight_dependences_head")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
	<th width="100%">&nbsp;</th>
</tr>
<?php $_from = $this->_tpl_vars['rate_data']['rate_value']['W']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['rdf'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['rdf']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['rate']):
        $this->_foreach['rdf']['iteration']++;
?>
<tr <?php echo smarty_function_cycle(array('values' => "class=\"table-row\", "), $this);?>
>
	<td>
		<input type="checkbox" name="delete_rate_data[W][<?php echo $this->_tpl_vars['k']; ?>
]" id="delete_checkbox_weight" value="Y" <?php if (($this->_foreach['rdf']['iteration'] <= 1)): ?>disabled="disabled"<?php endif; ?> class="checkbox cm-item-w cm-item" /></td>
	<td class="nowrap">
		<?php echo fn_get_lang_var('more_than', $this->getLanguage()); ?>

		<?php if (($this->_foreach['rdf']['iteration'] <= 1)): ?>
			<input type="hidden" name="rate_data[W][0][amount]" value="0" />0
		<?php else: ?>
			<input type="text" name="rate_data[W][<?php echo $this->_tpl_vars['k']; ?>
][amount]" size="5" value="<?php echo $this->_tpl_vars['k']; ?>
" class="input-text" />
		<?php endif; ?>
		<?php echo $this->_tpl_vars['settings']['General']['weight_symbol']; ?>

	</td>
	<td>
		<input type="text" name="rate_data[W][<?php if (($this->_foreach['rdf']['iteration'] <= 1)): ?>0<?php else: ?><?php echo $this->_tpl_vars['k']; ?>
<?php endif; ?>][value]" size="5" value="<?php echo smarty_modifier_default(@$this->_tpl_vars['rate']['value'], '0'); ?>
" class="input-text" /></td>
	<td>
		<select name="rate_data[W][<?php if (($this->_foreach['rdf']['iteration'] <= 1)): ?>0<?php else: ?><?php echo $this->_tpl_vars['k']; ?>
<?php endif; ?>][type]">
			<option value="F" <?php if ($this->_tpl_vars['rate']['type'] == 'F'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('absolute', $this->getLanguage()); ?>
 (<?php echo $this->_tpl_vars['currencies'][$this->_tpl_vars['primary_currency']]['symbol']; ?>
)</option>
			<option value="P" <?php if ($this->_tpl_vars['rate']['type'] == 'P'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('percent', $this->getLanguage()); ?>
 (%)</option>
		</select></td>
	<td class="center">
		<input type="hidden" name="rate_data[W][<?php if (($this->_foreach['rdf']['iteration'] <= 1)): ?>0<?php else: ?><?php echo $this->_tpl_vars['k']; ?>
<?php endif; ?>][per_unit]" value="N" />
		<input type="checkbox" name="rate_data[W][<?php if (($this->_foreach['rdf']['iteration'] <= 1)): ?>0<?php else: ?><?php echo $this->_tpl_vars['k']; ?>
<?php endif; ?>][per_unit]" value="Y" <?php if ($this->_tpl_vars['rate']['per_unit'] == 'Y'): ?>checked="checked"<?php endif; ?> class="checkbox" /></td>
	<td><?php $this->_tag_stack[] = array('hook', array('name' => "shippings:weight_dependences_body")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></td>
	<td class="nowrap right">
		<?php ob_start(); ?>
		<?php if (! ($this->_foreach['rdf']['iteration'] <= 1) && fn_check_company_id('shippings', 'shipping_id', $this->_tpl_vars['_REQUEST']['shipping_id'])): ?>
			<li><a class="cm-confirm" href="<?php echo fn_url("shippings.delete_rate_value?rate_type=W&amp;amount=".($this->_tpl_vars['k'])."&amp;shipping_id=".($this->_tpl_vars['_REQUEST']['shipping_id'])."&amp;destination_id=".($this->_tpl_vars['destination_id'])."&amp;rate_id=".($this->_tpl_vars['rate_data']['rate_id'])); ?>
"><?php echo fn_get_lang_var('delete', $this->getLanguage()); ?>
</a></li>
		<?php else: ?>
			<li><span class="undeleted-element"><?php echo fn_get_lang_var('delete', $this->getLanguage()); ?>
</span></li>
		<?php endif; ?>
		<?php $this->_smarty_vars['capture']['tools_items'] = ob_get_contents(); ob_end_clean(); ?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/table_tools_list.tpl", 'smarty_include_vars' => array('prefix' => $this->_foreach['rdf']['iteration'],'tools_list' => $this->_smarty_vars['capture']['tools_items'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</td>
</tr>
<?php endforeach; else: ?>
<tr class="no-items">
	<td colspan="7">
	<input type="hidden" name="rate_data[W][0][amount]" value="0" />
	<input type="hidden" name="rate_data[W][0][value]" value="0" />
	<input type="hidden" name="rate_data[W][0][type]" value="F" />
	<p><?php echo fn_get_lang_var('no_items', $this->getLanguage()); ?>
</p></td>
</tr>
<?php endif; unset($_from); ?>
</table>

<div class="clear">
	<?php if (! $this->_tpl_vars['hide_for_vendor']): ?>
	<?php ob_start(); ?>

	<table cellpadding="1" cellspacing="0" border="0" class="table">
	<tr id="box_upd_rate_welm">
		<td>
			<?php echo fn_get_lang_var('more_than', $this->getLanguage()); ?>
&nbsp;<input type="text" name="add_rate_data[W][0][amount]" size="5" value="" class="input-text" />&nbsp;<?php echo $this->_tpl_vars['settings']['General']['weight_symbol']; ?>

			<input type="text" name="add_rate_data[W][0][value]" size="5" value="" class="input-text" />
			<select name="add_rate_data[W][0][type]">
				<option value="F"><?php echo fn_get_lang_var('absolute', $this->getLanguage()); ?>
 (<?php echo $this->_tpl_vars['currencies'][$this->_tpl_vars['primary_currency']]['symbol']; ?>
)</option>
				<option value="P"><?php echo fn_get_lang_var('percent', $this->getLanguage()); ?>
 (%)</option>
			</select>
			<input type="hidden" name="add_rate_data[W][0][per_unit]" value="N" />
			<input type="checkbox" name="add_rate_data[W][0][per_unit]" value="Y" class="checkbox" />
		</td>
		<td>
		<?php $this->_tag_stack[] = array('hook', array('name' => "shippings:weight_dependences_new")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
		<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
		</td>
		<td>
			<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/multiple_buttons.tpl", 'smarty_include_vars' => array('item_id' => 'upd_rate_welm')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></td>
	</tr>
	</table>

	<div class="buttons-container">
		<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/save_cancel.tpl", 'smarty_include_vars' => array('create' => true,'but_name' => "dispatch[shippings.update_shipping]",'cancel_action' => 'close')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</div>
	<?php $this->_smarty_vars['capture']['add_new_picker'] = ob_get_contents(); ob_end_clean(); ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/popupbox.tpl", 'smarty_include_vars' => array('id' => 'add_weight_dependences','text' => fn_get_lang_var('add_weight_dependences', $this->getLanguage()),'content' => $this->_smarty_vars['capture']['add_new_picker'],'link_text' => fn_get_lang_var('add_weight_dependences', $this->getLanguage()),'act' => 'general')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php endif; ?>
</div>

<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/subheader.tpl", 'smarty_include_vars' => array('title' => fn_get_lang_var('items_dependences', $this->getLanguage()))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<table cellpadding="0" cellspacing="0" width="100%"	border="0" class="table">
<tr class="cm-first-sibling">
	<th>
		<input type="checkbox" name="check_all" value="Y" title="<?php echo fn_get_lang_var('check_uncheck_all', $this->getLanguage()); ?>
" class="checkbox cm-check-items-i" /></th>
	<th width="150"><?php echo fn_get_lang_var('products_amount', $this->getLanguage()); ?>
</th>
	<th><?php echo fn_get_lang_var('rate_value', $this->getLanguage()); ?>
</th>
	<th><?php echo fn_get_lang_var('type', $this->getLanguage()); ?>
</th>
	<th><?php echo smarty_modifier_replace(fn_get_lang_var('per', $this->getLanguage()), "[object]", fn_get_lang_var('item', $this->getLanguage())); ?>
</th>
	<th><?php $this->_tag_stack[] = array('hook', array('name' => "shippings:items_dependences_head")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
	<th width="100%">&nbsp;</th>
</tr>
<?php $_from = $this->_tpl_vars['rate_data']['rate_value']['I']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['rdf'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['rdf']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['rate']):
        $this->_foreach['rdf']['iteration']++;
?>
<tr <?php echo smarty_function_cycle(array('values' => "class=\"table-row\", "), $this);?>
>
	<td>
		<input type="checkbox" name="delete_rate_data[I][<?php echo $this->_tpl_vars['k']; ?>
]" id="delete_checkbox_items" value="Y" <?php if (($this->_foreach['rdf']['iteration'] <= 1)): ?>disabled="disabled"<?php endif; ?> class="checkbox cm-item-i cm-item" /></td>
	<td class="nowrap">
		<?php echo fn_get_lang_var('more_than', $this->getLanguage()); ?>

		<?php if (($this->_foreach['rdf']['iteration'] <= 1)): ?>
			<input type="hidden" name="rate_data[I][0][amount]" value="0" />0
		<?php else: ?>
			<input type="text" name="rate_data[I][<?php echo $this->_tpl_vars['k']; ?>
][amount]" size="5" value="<?php echo $this->_tpl_vars['k']; ?>
" class="input-text" />
		<?php endif; ?>
		<?php echo fn_get_lang_var('items', $this->getLanguage()); ?>

	</td>
	<td>
		<input type="text" name="rate_data[I][<?php if (($this->_foreach['rdf']['iteration'] <= 1)): ?>0<?php else: ?><?php echo $this->_tpl_vars['k']; ?>
<?php endif; ?>][value]" size="5" value="<?php echo smarty_modifier_default(@$this->_tpl_vars['rate']['value'], '0'); ?>
" class="input-text" /></td>
	<td>
		<select name="rate_data[I][<?php if (($this->_foreach['rdf']['iteration'] <= 1)): ?>0<?php else: ?><?php echo $this->_tpl_vars['k']; ?>
<?php endif; ?>][type]">
			<option value="F" <?php if ($this->_tpl_vars['rate']['type'] == 'F'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('absolute', $this->getLanguage()); ?>
 (<?php echo $this->_tpl_vars['currencies'][$this->_tpl_vars['primary_currency']]['symbol']; ?>
)</option>
			<option value="P" <?php if ($this->_tpl_vars['rate']['type'] == 'P'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('percent', $this->getLanguage()); ?>
 (%)</option>
		</select></td>
	<td class="center">
		<input type="hidden" name="rate_data[I][<?php if (($this->_foreach['rdf']['iteration'] <= 1)): ?>0<?php else: ?><?php echo $this->_tpl_vars['k']; ?>
<?php endif; ?>][per_unit]" value="N" />
		<input type="checkbox" name="rate_data[I][<?php if (($this->_foreach['rdf']['iteration'] <= 1)): ?>0<?php else: ?><?php echo $this->_tpl_vars['k']; ?>
<?php endif; ?>][per_unit]" value="Y"  <?php if ($this->_tpl_vars['rate']['per_unit'] == 'Y'): ?>checked="checked"<?php endif; ?> class="checkbox" /></td>
	<td><?php $this->_tag_stack[] = array('hook', array('name' => "shippings:items_dependences_body")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></td>
	<td class="nowrap right">
		<?php ob_start(); ?>
		<?php if (! ($this->_foreach['rdf']['iteration'] <= 1) && fn_check_company_id('shippings', 'shipping_id', $this->_tpl_vars['_REQUEST']['shipping_id'])): ?>
			<li><a class="cm-confirm" href="<?php echo fn_url("shippings.delete_rate_value?rate_type=I&amp;amount=".($this->_tpl_vars['k'])."&amp;shipping_id=".($this->_tpl_vars['_REQUEST']['shipping_id'])."&amp;destination_id=".($this->_tpl_vars['destination_id'])."&amp;rate_id=".($this->_tpl_vars['rate_data']['rate_id'])); ?>
"><?php echo fn_get_lang_var('delete', $this->getLanguage()); ?>
</a></li>
		<?php else: ?>
			<li><span class="undeleted-element"><?php echo fn_get_lang_var('delete', $this->getLanguage()); ?>
</span></li>
		<?php endif; ?>
		<?php $this->_smarty_vars['capture']['tools_items'] = ob_get_contents(); ob_end_clean(); ?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/table_tools_list.tpl", 'smarty_include_vars' => array('prefix' => $this->_foreach['rdf']['iteration'],'tools_list' => $this->_smarty_vars['capture']['tools_items'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</td>
</tr>
<?php endforeach; else: ?>
<tr class="no-items">
	<td colspan="7">
	<input type="hidden" name="rate_data[I][0][amount]" value="0" />
	<input type="hidden" name="rate_data[I][0][value]" value="0" />
	<input type="hidden" name="rate_data[I][0][type]" value="F" />
	<p><?php echo fn_get_lang_var('no_items', $this->getLanguage()); ?>
</p></td>
</tr>
<?php endif; unset($_from); ?>
</table>

<div class="clear">
	<?php if (! $this->_tpl_vars['hide_for_vendor']): ?>
	<?php ob_start(); ?>

	<table cellpadding="1" cellspacing="0" border="0" class="table">
	<tr id="box_upd_rate_ielm">
		<td>
			<?php echo fn_get_lang_var('more_than', $this->getLanguage()); ?>
&nbsp;<input type="text" name="add_rate_data[I][0][amount]" size="5" value="" class="input-text" />&nbsp;<?php echo fn_get_lang_var('items', $this->getLanguage()); ?>

			<input type="text" name="add_rate_data[I][0][value]" size="5" value="" class="input-text" />
			<select name="add_rate_data[I][0][type]">
				<option value="F"><?php echo fn_get_lang_var('absolute', $this->getLanguage()); ?>
 (<?php echo $this->_tpl_vars['currencies'][$this->_tpl_vars['primary_currency']]['symbol']; ?>
)</option>
				<option value="P"><?php echo fn_get_lang_var('percent', $this->getLanguage()); ?>
 (%)</option>
			</select>
			<input type="hidden" name="add_rate_data[I][0][per_unit]" value="N" />
			<input type="checkbox" name="add_rate_data[I][0][per_unit]" value="Y" class="checkbox" /></td>
		<td>
		<?php $this->_tag_stack[] = array('hook', array('name' => "shippings:items_dependences_new")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
		<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
		</td>
		<td>
			<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/multiple_buttons.tpl", 'smarty_include_vars' => array('item_id' => 'upd_rate_ielm')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></td>
	</tr>
	</table>

	<div class="buttons-container">
		<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/save_cancel.tpl", 'smarty_include_vars' => array('create' => true,'but_name' => "dispatch[shippings.update_shipping]",'cancel_action' => 'close')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</div>
	<?php $this->_smarty_vars['capture']['add_new_picker'] = ob_get_contents(); ob_end_clean(); ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/popupbox.tpl", 'smarty_include_vars' => array('id' => 'add_items_dependences','text' => fn_get_lang_var('add_items_dependences', $this->getLanguage()),'content' => $this->_smarty_vars['capture']['add_new_picker'],'link_text' => fn_get_lang_var('add_items_dependences', $this->getLanguage()),'act' => 'general')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php endif; ?>
</div>

<div class="buttons-container buttons-bg">
	<?php if (! $this->_tpl_vars['hide_for_vendor']): ?>
	<?php ob_start(); ?>
	<ul>
		<li><a name="dispatch[shippings.delete_rate_values]" class="cm-process-items cm-confirm" rev="shippings_form"><?php echo fn_get_lang_var('delete_selected', $this->getLanguage()); ?>
</a></li>
	</ul>
	<?php $this->_smarty_vars['capture']['tools_list'] = ob_get_contents(); ob_end_clean(); ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/save.tpl", 'smarty_include_vars' => array('but_name' => "dispatch[shippings.update_shipping]",'but_role' => 'button_main')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('prefix' => 'main', 'hide_actions' => true, 'tools_list' => $this->_smarty_vars['capture']['tools_list'], 'display' => 'inline', 'link_text' => fn_get_lang_var('choose_action', $this->getLanguage()), )); ?><?php if ($this->_tpl_vars['skip_check_permissions'] || fn_check_view_permissions($this->_tpl_vars['tools_list'])): ?>

<?php if ($this->_tpl_vars['tools_list'] && $this->_tpl_vars['prefix'] == 'main' && ! $this->_tpl_vars['only_popup']): ?> <?php echo fn_get_lang_var('or', $this->getLanguage()); ?>
 <?php endif; ?>

<?php if (substr_count($this->_tpl_vars['tools_list'], "<li") == 1): ?>
	<?php echo smarty_modifier_replace($this->_tpl_vars['tools_list'], "<ul>", "<ul class=\"cm-tools-list tools-list\">"); ?>

<?php else: ?>
	<div class="tools-container<?php if ($this->_tpl_vars['display']): ?> <?php echo $this->_tpl_vars['display']; ?>
<?php endif; ?>">
		<?php if (! $this->_tpl_vars['hide_tools'] && $this->_tpl_vars['tools_list']): ?>
		<div class="tools-content<?php if ($this->_tpl_vars['display']): ?> <?php echo $this->_tpl_vars['display']; ?>
<?php endif; ?>">
			<a class="cm-combo-on cm-combination <?php if ($this->_tpl_vars['override_meta']): ?><?php echo $this->_tpl_vars['override_meta']; ?>
<?php else: ?>select-button<?php endif; ?><?php if ($this->_tpl_vars['link_meta']): ?> <?php echo $this->_tpl_vars['link_meta']; ?>
<?php endif; ?>" id="sw_tools_list_<?php echo $this->_tpl_vars['prefix']; ?>
"><?php echo smarty_modifier_default(@$this->_tpl_vars['link_text'], fn_get_lang_var('tools', $this->getLanguage())); ?>
</a>
			<div id="tools_list_<?php echo $this->_tpl_vars['prefix']; ?>
" class="cm-tools-list popup-tools hidden cm-popup-box cm-smart-position">
					<?php echo $this->_tpl_vars['tools_list']; ?>

			</div>
		</div>
		<?php endif; ?>
		<?php if (! $this->_tpl_vars['hide_actions']): ?>
			<?php if (! ( defined('COMPANY_ID') && ! fn_check_view_permissions($this->_tpl_vars['tool_href']) )): ?>
				<span class="action-add">
					<a<?php if ($this->_tpl_vars['tool_id']): ?> id="<?php echo $this->_tpl_vars['tool_id']; ?>
"<?php endif; ?><?php if ($this->_tpl_vars['tool_href']): ?> href="<?php echo fn_url($this->_tpl_vars['tool_href']); ?>
"<?php endif; ?><?php if ($this->_tpl_vars['tool_onclick']): ?> onclick="<?php echo $this->_tpl_vars['tool_onclick']; ?>
; return false;"<?php endif; ?>><?php echo smarty_modifier_default(@$this->_tpl_vars['link_text'], fn_get_lang_var('add', $this->getLanguage())); ?>
</a>
				</span>
			<?php endif; ?>
		<?php endif; ?>
	</div>
<?php endif; ?>

<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
	<?php else: ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/save_cancel.tpl", 'smarty_include_vars' => array('but_name' => "dispatch[shippings.update_shipping]",'but_role' => 'button_main','hide_first_button' => true,'hide_second_button' => true)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php endif; ?>
</div>