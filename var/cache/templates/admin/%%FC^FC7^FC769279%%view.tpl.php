<?php /* Smarty version 2.6.18, created on 2014-03-08 11:24:08
         compiled from views/sales_reports/view.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'script', 'views/sales_reports/view.tpl', 15, false),array('function', 'cycle', 'views/sales_reports/view.tpl', 107, false),array('function', 'math', 'views/sales_reports/view.tpl', 212, false),array('modifier', 'default', 'views/sales_reports/view.tpl', 45, false),array('modifier', 'fn_check_view_permissions', 'views/sales_reports/view.tpl', 46, false),array('modifier', 'fn_url', 'views/sales_reports/view.tpl', 52, false),array('modifier', 'unescape', 'views/sales_reports/view.tpl', 115, false),array('modifier', 'format_price', 'views/sales_reports/view.tpl', 141, false),array('modifier', 'sizeof', 'views/sales_reports/view.tpl', 197, false),array('modifier', 'rand', 'views/sales_reports/view.tpl', 293, false),array('modifier', 'escape', 'views/sales_reports/view.tpl', 310, false),array('modifier', 'empty_tabs', 'views/sales_reports/view.tpl', 405, false),array('modifier', 'in_array', 'views/sales_reports/view.tpl', 411, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('edit_report','remove_this_item','remove_this_item','no_data','table_conditions','total','total','upgrade_flash_player','upgrade_flash_player','upgrade_flash_player','no_data','no_data','reports'));
?>
<?php 

				$rname = !empty($resource_name) ? $resource_name : $params['smarty_include_tpl_file'];
				if ($this->compile_check && empty($inline_no_check[$rname]) && $this->is_cached($rname)) {
					if ($this->check_inline_blocks(array (
  'common_templates/tabsbox.tpl' => 1367063753,
))) {
						$_smarty_compile_path = $this->_get_compile_path($rname);
						$this->_compile_resource($rname, $_smarty_compile_path);
						$inline_no_check[$rname] = true;
						include $_smarty_compile_path;
						return;
					}
				}
			 ?><?php echo smarty_function_script(array('src' => "lib/amcharts/swfobject.js"), $this);?>


<div id="content_<?php echo $this->_tpl_vars['report']['report_id']; ?>
">

<?php ob_start(); ?>

<?php ob_start(); ?>
	<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('but_text' => fn_get_lang_var('edit_report', $this->getLanguage()), 'but_href' => "sales_reports.update_table?report_id=".($this->_tpl_vars['report_id'])."&table_id=".($this->_tpl_vars['table']['table_id']), 'but_role' => 'tool', )); ?><?php if ($this->_tpl_vars['but_role'] == 'text'): ?>
	<?php $this->assign('class', "text-link", false); ?>
<?php elseif ($this->_tpl_vars['but_role'] == 'delete'): ?>
	<?php $this->assign('class', "text-button-delete", false); ?>
<?php elseif ($this->_tpl_vars['but_role'] == 'add'): ?>
	<?php $this->assign('class', "text-button text-button-add", false); ?>
<?php elseif ($this->_tpl_vars['but_role'] == 'reload'): ?>
	<?php $this->assign('class', "text-button text-button-reload", false); ?>
<?php elseif ($this->_tpl_vars['but_role'] == 'delete_item'): ?>
	<?php $this->assign('class', "text-button-delete-item", false); ?>
<?php elseif ($this->_tpl_vars['but_role'] == 'edit'): ?>
	<?php $this->assign('class', "text-button-edit", false); ?>
<?php elseif ($this->_tpl_vars['but_role'] == 'tool'): ?>
	<?php $this->assign('class', "tool-link", false); ?>
<?php elseif ($this->_tpl_vars['but_role'] == 'link'): ?>
	<?php $this->assign('class', "text-button-link", false); ?>
<?php elseif ($this->_tpl_vars['but_role'] == 'simple'): ?>
	<?php $this->assign('class', "text-button-simple", false); ?>
<?php else: ?>
	<?php $this->assign('class', "", false); ?>
<?php endif; ?>

<?php if ($this->_tpl_vars['but_name']): ?><?php $this->assign('r', $this->_tpl_vars['but_name'], false); ?><?php else: ?><?php $this->assign('r', $this->_tpl_vars['but_href'], false); ?><?php endif; ?>
<?php $this->assign('method', smarty_modifier_default(@$this->_tpl_vars['method'], 'POST'), false); ?>
<?php if (fn_check_view_permissions($this->_tpl_vars['r'], $this->_tpl_vars['method'])): ?>

<?php if ($this->_tpl_vars['but_name'] || $this->_tpl_vars['but_role'] == 'submit' || $this->_tpl_vars['but_role'] == 'button_main' || $this->_tpl_vars['but_type'] || $this->_tpl_vars['but_role'] == 'big'): ?> 
	<span <?php if ($this->_tpl_vars['but_css']): ?>style="<?php echo $this->_tpl_vars['but_css']; ?>
"<?php endif; ?> class="submit-button<?php if ($this->_tpl_vars['but_role'] == 'big'): ?>-big<?php endif; ?><?php if ($this->_tpl_vars['but_role'] == 'button_main'): ?> cm-button-main<?php endif; ?> <?php echo $this->_tpl_vars['but_meta']; ?>
"><input <?php if ($this->_tpl_vars['but_id']): ?>id="<?php echo $this->_tpl_vars['but_id']; ?>
"<?php endif; ?> <?php if ($this->_tpl_vars['but_meta']): ?>class="<?php echo $this->_tpl_vars['but_meta']; ?>
"<?php endif; ?> type="<?php echo smarty_modifier_default(@$this->_tpl_vars['but_type'], 'submit'); ?>
"<?php if ($this->_tpl_vars['but_name']): ?> name="<?php echo $this->_tpl_vars['but_name']; ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_onclick']): ?> onclick="<?php echo $this->_tpl_vars['but_onclick']; ?>
;<?php if (! $this->_tpl_vars['allow_href']): ?> return false;<?php endif; ?>"<?php endif; ?> value="<?php echo $this->_tpl_vars['but_text']; ?>
" <?php if ($this->_tpl_vars['tabindex']): ?>tabindex="<?php echo $this->_tpl_vars['tabindex']; ?>
"<?php endif; ?> <?php if ($this->_tpl_vars['but_rev']): ?> rev="<?php echo $this->_tpl_vars['but_rev']; ?>
"<?php endif; ?> <?php if ($this->_tpl_vars['but_disabled']): ?>disabled="disabled"<?php endif; ?> /></span>

<?php elseif ($this->_tpl_vars['but_role'] && $this->_tpl_vars['but_role'] != 'submit' && $this->_tpl_vars['but_role'] != 'action' && $this->_tpl_vars['but_role'] != "advanced-search" && $this->_tpl_vars['but_role'] != 'button'): ?> 
	<a <?php if ($this->_tpl_vars['but_id']): ?>id="<?php echo $this->_tpl_vars['but_id']; ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_href']): ?> href="<?php echo fn_url($this->_tpl_vars['but_href']); ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_onclick']): ?> onclick="<?php echo $this->_tpl_vars['but_onclick']; ?>
;<?php if (! $this->_tpl_vars['allow_href']): ?> return false;<?php endif; ?>"<?php endif; ?><?php if ($this->_tpl_vars['but_target']): ?> target="<?php echo $this->_tpl_vars['but_target']; ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_rev']): ?> rev="<?php echo $this->_tpl_vars['but_rev']; ?>
"<?php endif; ?> class="<?php echo $this->_tpl_vars['class']; ?>
<?php if ($this->_tpl_vars['but_meta']): ?> <?php echo $this->_tpl_vars['but_meta']; ?>
<?php endif; ?>"><?php if ($this->_tpl_vars['but_role'] == 'delete_item'): ?><img src="<?php echo $this->_tpl_vars['images_dir']; ?>
/icons/icon_delete.gif" width="12" height="18" border="0" alt="<?php echo fn_get_lang_var('remove_this_item', $this->getLanguage()); ?>
" title="<?php echo fn_get_lang_var('remove_this_item', $this->getLanguage()); ?>
" class="valign" /><?php else: ?><?php echo $this->_tpl_vars['but_text']; ?>
<?php endif; ?></a>

<?php elseif ($this->_tpl_vars['but_role'] == 'action' || $this->_tpl_vars['but_role'] == "advanced-search"): ?> 
	<a <?php if ($this->_tpl_vars['but_id']): ?>id="<?php echo $this->_tpl_vars['but_id']; ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_href']): ?> href="<?php echo fn_url($this->_tpl_vars['but_href']); ?>
"<?php endif; ?> <?php if ($this->_tpl_vars['but_onclick']): ?>onclick="<?php echo $this->_tpl_vars['but_onclick']; ?>
;<?php if (! $this->_tpl_vars['allow_href']): ?> return false;<?php endif; ?>"<?php endif; ?> <?php if ($this->_tpl_vars['but_target']): ?>target="<?php echo $this->_tpl_vars['but_target']; ?>
"<?php endif; ?> <?php if ($this->_tpl_vars['but_rev']): ?> rev="<?php echo $this->_tpl_vars['but_rev']; ?>
"<?php endif; ?> class="button<?php if ($this->_tpl_vars['but_meta']): ?> <?php echo $this->_tpl_vars['but_meta']; ?>
<?php endif; ?>"><?php echo $this->_tpl_vars['but_text']; ?>
<?php if ($this->_tpl_vars['but_role'] == 'action'): ?>&nbsp;<img src="<?php echo $this->_tpl_vars['images_dir']; ?>
/icons/but_arrow.gif" width="8" height="7" border="0" alt=""/><?php endif; ?></a>
	
<?php elseif ($this->_tpl_vars['but_role'] == 'button'): ?>
	<input <?php if ($this->_tpl_vars['but_id']): ?>id="<?php echo $this->_tpl_vars['but_id']; ?>
"<?php endif; ?> <?php if ($this->_tpl_vars['but_meta']): ?>class="<?php echo $this->_tpl_vars['but_meta']; ?>
"<?php endif; ?> type="button" <?php if ($this->_tpl_vars['but_onclick']): ?>onclick="<?php echo $this->_tpl_vars['but_onclick']; ?>
;<?php if (! $this->_tpl_vars['allow_href']): ?> return false;<?php endif; ?>"<?php endif; ?> value="<?php echo $this->_tpl_vars['but_text']; ?>
" <?php if ($this->_tpl_vars['tabindex']): ?>tabindex="<?php echo $this->_tpl_vars['tabindex']; ?>
"<?php endif; ?> <?php if ($this->_tpl_vars['but_rev']): ?> rev="<?php echo $this->_tpl_vars['but_rev']; ?>
"<?php endif; ?> />

<?php elseif ($this->_tpl_vars['but_role'] == 'icon'): ?> 
	<a <?php if ($this->_tpl_vars['but_id']): ?>id="<?php echo $this->_tpl_vars['but_id']; ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_href']): ?> href="<?php echo fn_url($this->_tpl_vars['but_href']); ?>
"<?php endif; ?> <?php if ($this->_tpl_vars['but_onclick']): ?>onclick="<?php echo $this->_tpl_vars['but_onclick']; ?>
;<?php if (! $this->_tpl_vars['allow_href']): ?> return false;<?php endif; ?>"<?php endif; ?> <?php if ($this->_tpl_vars['but_target']): ?>target="<?php echo $this->_tpl_vars['but_target']; ?>
"<?php endif; ?> <?php if ($this->_tpl_vars['but_rev']): ?> rev="<?php echo $this->_tpl_vars['but_rev']; ?>
"<?php endif; ?> class="<?php if ($this->_tpl_vars['but_meta']): ?> <?php echo $this->_tpl_vars['but_meta']; ?>
<?php endif; ?>"><?php echo $this->_tpl_vars['but_text']; ?>
</a>

<?php elseif (! $this->_tpl_vars['but_role']): ?> 
	<input <?php if ($this->_tpl_vars['but_id']): ?>id="<?php echo $this->_tpl_vars['but_id']; ?>
"<?php endif; ?> class="default-button<?php if ($this->_tpl_vars['but_meta']): ?> <?php echo $this->_tpl_vars['but_meta']; ?>
<?php endif; ?>" type="submit" onclick="<?php echo $this->_tpl_vars['but_onclick']; ?>
;<?php if (! $this->_tpl_vars['allow_href']): ?> return false;<?php endif; ?>" value="<?php echo $this->_tpl_vars['but_text']; ?>
" <?php if ($this->_tpl_vars['but_rev']): ?> rev="<?php echo $this->_tpl_vars['but_rev']; ?>
"<?php endif; ?> />
<?php endif; ?>

<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
<?php $this->_smarty_vars['capture']['extra_tools'] = ob_get_contents(); ob_end_clean(); ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/sales_reports/components/sales_reports_search_form.tpl", 'smarty_include_vars' => array('period' => $this->_tpl_vars['report']['period'],'search' => $this->_tpl_vars['report'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>


<?php if ($this->_tpl_vars['report']): ?>

<?php ob_start(); ?>
<?php if ($this->_tpl_vars['report']['tables']): ?>
<?php $this->assign('table_id', $this->_tpl_vars['table']['table_id'], false); ?>
<?php $this->assign('table_prefix', "table_".($this->_tpl_vars['table_id']), false); ?>
<div id="content_table_<?php echo $this->_tpl_vars['table_id']; ?>
">

<?php if (! $this->_tpl_vars['table']['elements'] || $this->_tpl_vars['table']['empty_values'] == 'Y'): ?>

<p class="no-items"><?php echo fn_get_lang_var('no_data', $this->getLanguage()); ?>
</p>

<?php elseif ($this->_tpl_vars['table']['type'] == 'T'): ?>

<?php if ($this->_tpl_vars['table_conditions'][$this->_tpl_vars['table_id']]): ?>
<p>
	<a id="sw_box_table_conditions_<?php echo $this->_tpl_vars['table_id']; ?>
" class="text-link text-button cm-combination"><?php echo fn_get_lang_var('table_conditions', $this->getLanguage()); ?>
</a>
</p>
<div id="box_table_conditions_<?php echo $this->_tpl_vars['table_id']; ?>
" class="hidden">
	<?php $_from = $this->_tpl_vars['table_conditions'][$this->_tpl_vars['table_id']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['i']):
?>
	<div class="form-field">
	<label><?php echo $this->_tpl_vars['i']['name']; ?>
:</label>
	<?php $_from = $this->_tpl_vars['i']['objects']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['feco'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['feco']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['o']):
        $this->_foreach['feco']['iteration']++;
?>
	<?php if ($this->_tpl_vars['o']['href']): ?><a href="<?php echo fn_url($this->_tpl_vars['o']['href']); ?>
"><?php endif; ?><?php echo $this->_tpl_vars['o']['name']; ?>
<?php if ($this->_tpl_vars['o']['href']): ?></a><?php endif; ?><?php if (! ($this->_foreach['feco']['iteration'] == $this->_foreach['feco']['total'])): ?>, <?php endif; ?>
	<?php endforeach; endif; unset($_from); ?>
	</div>
	<?php endforeach; endif; unset($_from); ?>
</div>
<?php endif; ?>

<?php if ($this->_tpl_vars['table']['interval_id'] != 1): ?>

<table cellpadding="0" cellspacing="0" border="0" width="100%" class="table-fixed">
<tr valign="top">
	<?php echo smarty_function_cycle(array('values' => "",'assign' => ""), $this);?>

	<td width="300">
		<table cellpadding="0" cellspacing="0" border="0" width="100%" class="table">
		<tr>
			<th width="100%"><?php echo $this->_tpl_vars['table']['parameter']; ?>
</th>
		</tr>
		<?php $_from = $this->_tpl_vars['table']['elements']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['element']):
?>
		<tr>
			<td><?php echo smarty_modifier_unescape($this->_tpl_vars['element']['description']); ?>
&nbsp;</td>
		</tr>
		<?php endforeach; endif; unset($_from); ?>
		<tr>
			<td class="right"><?php echo fn_get_lang_var('total', $this->getLanguage()); ?>
:</td>
		</tr>
		</table>
	</td>
	<td>
	<?php echo smarty_function_cycle(array('values' => "",'assign' => ""), $this);?>

	<div id="div_scroll_<?php echo $this->_tpl_vars['table_id']; ?>
" class="scroll-x">
		<table cellpadding="0" cellspacing="0" border="0" class="table no-left-border">
		<tr>
				<?php $_from = $this->_tpl_vars['table']['intervals']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['row']):
?>
				<th>&nbsp;<?php echo $this->_tpl_vars['row']['description']; ?>
&nbsp;</th>
				<?php endforeach; endif; unset($_from); ?>
		</tr>
		<?php $_from = $this->_tpl_vars['table']['elements']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['element']):
?>
		<tr>
		<?php $this->assign('element_hash', $this->_tpl_vars['element']['element_hash'], false); ?>
				<?php $_from = $this->_tpl_vars['table']['intervals']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['row']):
?>
				<?php $this->assign('interval_id', $this->_tpl_vars['row']['interval_id'], false); ?>
				<td class="center">
				<?php if ($this->_tpl_vars['table']['values'][$this->_tpl_vars['element_hash']][$this->_tpl_vars['interval_id']]): ?>
				<?php if ($this->_tpl_vars['table']['display'] != 'product_number' && $this->_tpl_vars['table']['display'] != 'order_number'): ?><?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('value' => $this->_tpl_vars['table']['values'][$this->_tpl_vars['element_hash']][$this->_tpl_vars['interval_id']], )); ?><?php echo ''; ?><?php if ($this->_tpl_vars['settings']['General']['alternative_currency'] == 'Y'): ?><?php echo ''; ?><?php echo smarty_modifier_unescape(smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['primary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], false)); ?><?php echo ''; ?><?php if ($this->_tpl_vars['secondary_currency'] != $this->_tpl_vars['primary_currency']): ?><?php echo '&nbsp;'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo '('; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true, $this->_tpl_vars['is_integer']); ?><?php echo ''; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo ')'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php echo smarty_modifier_unescape(smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true)); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php else: ?><?php echo $this->_tpl_vars['table']['values'][$this->_tpl_vars['element_hash']][$this->_tpl_vars['interval_id']]; ?>
<?php endif; ?>
				<?php else: ?>-<?php endif; ?></td>
				<?php endforeach; endif; unset($_from); ?>
		</tr>
		<?php endforeach; endif; unset($_from); ?>
		<tr>
			<?php $_from = $this->_tpl_vars['table']['totals']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['row']):
?>
			<td class="center">
				<?php if ($this->_tpl_vars['row']): ?>
				<span><?php if ($this->_tpl_vars['table']['display'] != 'product_number' && $this->_tpl_vars['table']['display'] != 'order_number'): ?><?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('value' => $this->_tpl_vars['row'], )); ?><?php echo ''; ?><?php if ($this->_tpl_vars['settings']['General']['alternative_currency'] == 'Y'): ?><?php echo ''; ?><?php echo smarty_modifier_unescape(smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['primary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], false)); ?><?php echo ''; ?><?php if ($this->_tpl_vars['secondary_currency'] != $this->_tpl_vars['primary_currency']): ?><?php echo '&nbsp;'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo '('; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true, $this->_tpl_vars['is_integer']); ?><?php echo ''; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo ')'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php echo smarty_modifier_unescape(smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true)); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php else: ?><?php echo $this->_tpl_vars['row']; ?>
<?php endif; ?></span>
				<?php else: ?>-<?php endif; ?>
			</td>
			<?php endforeach; endif; unset($_from); ?>
		</tr>
		</table>
	</div>
	</td>
</tr>
</table>

<?php else: ?>

<table cellpadding="0" cellspacing="0" border="0" width="500" class="table-fixed">
<tr>
	<?php echo smarty_function_cycle(array('values' => "",'assign' => ""), $this);?>

	<td width="403" valign="top">
		<table cellpadding="0" cellspacing="0" border="0" width="100%" class="table no-bottom-border">
		<tr>
			<th><?php echo $this->_tpl_vars['table']['parameter']; ?>
</th>
		</tr>
		</table>
	</td>
	<td width="100">
		<table cellpadding="0" cellspacing="0" border="0" width="100%" class="table no-left-border no-bottom-border">
		<tr>
			<?php $_from = $this->_tpl_vars['table']['intervals']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['row']):
?>
			<?php $this->assign('interval_id', $this->_tpl_vars['row']['interval_id'], false); ?>
			<?php $this->assign('interval_name', "reports_interval_".($this->_tpl_vars['interval_id']), false); ?>
			<th class="center">&nbsp;<?php echo fn_get_lang_var($this->_tpl_vars['interval_name'], $this->getLanguage()); ?>
&nbsp;</th>
			<?php endforeach; endif; unset($_from); ?>
		</tr>
		</table>
	</td>
</tr>
</table>

<?php $this->assign('elements_count', sizeof($this->_tpl_vars['table']['elements']), false); ?>

<?php if ($this->_tpl_vars['elements_count'] > 14): ?>
<div id="div_scroll_<?php echo $this->_tpl_vars['table_id']; ?>
" class="reports-table-scroll">
<?php endif; ?>

<table cellpadding="0" cellspacing="0" border="0" class="table-fixed" width="500">
<tr valign="top">
	<td width="403" class="max-height no-padding">
		<table cellpadding="0" cellspacing="0" border="0" width="100%" class="table no-top-border">
		<?php $_from = $this->_tpl_vars['table']['elements']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['element']):
?>
		<?php $this->assign('element_hash', $this->_tpl_vars['element']['element_hash'], false); ?>
		<tr>
			<?php $_from = $this->_tpl_vars['table']['intervals']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['row']):
?>
			<?php $this->assign('interval_id', $this->_tpl_vars['row']['interval_id'], false); ?>
			<?php echo smarty_function_math(array('equation' => "round(value_/max_value*100)",'value_' => smarty_modifier_default(@$this->_tpl_vars['table']['values'][$this->_tpl_vars['element_hash']][$this->_tpl_vars['interval_id']], '0'),'max_value' => $this->_tpl_vars['table']['max_value'],'assign' => 'percent_value'), $this);?>

						<?php endforeach; endif; unset($_from); ?>
			<td class="no-padding">
			<table cellpadding="0" cellspacing="0" border="0" width="100%" class="table-fixed">
			<tr>
				<td class="nowrap overflow-hidden" width="233"><?php echo smarty_modifier_unescape($this->_tpl_vars['element']['description']); ?>
&nbsp;</td>
				<td align="right" width="120"><?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('bar_width' => '100px', 'value_width' => $this->_tpl_vars['percent_value'], )); ?><?php echo smarty_function_math(array('equation' => "floor(width / 20) + 1",'assign' => 'color','width' => $this->_tpl_vars['value_width']), $this);?>

<?php if ($this->_tpl_vars['color'] > 5): ?>
	<?php $this->assign('color', '5', false); ?>
<?php endif; ?>
<?php echo '<div class="graph-bar-border"'; ?><?php if ($this->_tpl_vars['bar_width']): ?><?php echo ' style="width: '; ?><?php echo $this->_tpl_vars['bar_width']; ?><?php echo ';"'; ?><?php endif; ?><?php echo ' align="left"><div '; ?><?php if ($this->_tpl_vars['value_width'] > 0): ?><?php echo 'class="graph-bar-'; ?><?php echo $this->_tpl_vars['color']; ?><?php echo '" style="width: '; ?><?php echo $this->_tpl_vars['value_width']; ?><?php echo '%;"'; ?><?php endif; ?><?php echo '>&nbsp;</div></div>'; ?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?></td>
			</tr>
			</table>
			</td>
		</tr>
		<?php endforeach; endif; unset($_from); ?>
		<tr>
			<td class="right"><?php echo fn_get_lang_var('total', $this->getLanguage()); ?>
:</td>
		</tr>
		</table>
	</td>
	<td width="100">
		<?php echo smarty_function_cycle(array('values' => "",'assign' => ""), $this);?>

		<table cellpadding="0" cellspacing="0" border="0" width="100%" class="table no-top-border no-left-border">
		<?php $_from = $this->_tpl_vars['table']['elements']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['element']):
?>
		<tr>
		<?php $this->assign('element_hash', $this->_tpl_vars['element']['element_hash'], false); ?>
				<?php $_from = $this->_tpl_vars['table']['intervals']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['row']):
?>
				<?php $this->assign('interval_id', $this->_tpl_vars['row']['interval_id'], false); ?>
				<td  class="center">
				<?php if ($this->_tpl_vars['table']['values'][$this->_tpl_vars['element_hash']][$this->_tpl_vars['interval_id']]): ?>
				<?php if ($this->_tpl_vars['table']['display'] != 'product_number' && $this->_tpl_vars['table']['display'] != 'order_number'): ?><?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('value' => $this->_tpl_vars['table']['values'][$this->_tpl_vars['element_hash']][$this->_tpl_vars['interval_id']], )); ?><?php echo ''; ?><?php if ($this->_tpl_vars['settings']['General']['alternative_currency'] == 'Y'): ?><?php echo ''; ?><?php echo smarty_modifier_unescape(smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['primary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], false)); ?><?php echo ''; ?><?php if ($this->_tpl_vars['secondary_currency'] != $this->_tpl_vars['primary_currency']): ?><?php echo '&nbsp;'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo '('; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true, $this->_tpl_vars['is_integer']); ?><?php echo ''; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo ')'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php echo smarty_modifier_unescape(smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true)); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php else: ?><?php echo $this->_tpl_vars['table']['values'][$this->_tpl_vars['element_hash']][$this->_tpl_vars['interval_id']]; ?>
<?php endif; ?>
				<?php else: ?>-<?php endif; ?></td>
				<?php endforeach; endif; unset($_from); ?>
		</tr>
		<?php endforeach; endif; unset($_from); ?>
		<tr>
			<?php $_from = $this->_tpl_vars['table']['totals']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['row']):
?>
			<td class="center">
				<?php if ($this->_tpl_vars['row']): ?>
				<span><?php if ($this->_tpl_vars['table']['display'] != 'product_number' && $this->_tpl_vars['table']['display'] != 'order_number'): ?><?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('value' => $this->_tpl_vars['row'], )); ?><?php echo ''; ?><?php if ($this->_tpl_vars['settings']['General']['alternative_currency'] == 'Y'): ?><?php echo ''; ?><?php echo smarty_modifier_unescape(smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['primary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], false)); ?><?php echo ''; ?><?php if ($this->_tpl_vars['secondary_currency'] != $this->_tpl_vars['primary_currency']): ?><?php echo '&nbsp;'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo '('; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true, $this->_tpl_vars['is_integer']); ?><?php echo ''; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo ')'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php echo smarty_modifier_unescape(smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true)); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php else: ?><?php echo $this->_tpl_vars['row']; ?>
<?php endif; ?></span>
				<?php else: ?>-<?php endif; ?>
			</td>
			<?php endforeach; endif; unset($_from); ?>
		</tr>
		</table>
	</td>
</tr>
</table>

<?php if ($this->_tpl_vars['elements_count'] > 14): ?>
</div>
<?php endif; ?>

<?php endif; ?>

<?php elseif ($this->_tpl_vars['table']['type'] == 'P'): ?>
	<div id="<?php echo $this->_tpl_vars['table_prefix']; ?>
pie"><?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('type' => 'pie', 'chart_data' => $this->_tpl_vars['new_array']['pie_data'], 'chart_id' => $this->_tpl_vars['table_prefix'], 'chart_title' => $this->_tpl_vars['table']['description'], 'chart_height' => $this->_tpl_vars['new_array']['pie_height'], )); ?><!-- amchart script-->
	<div id="flashcontent_<?php echo $this->_tpl_vars['chart_id']; ?>
am<?php echo $this->_tpl_vars['type']; ?>
" align="center">
		<span><?php echo fn_get_lang_var('upgrade_flash_player', $this->getLanguage()); ?>
</span>
	</div>
	<?php $this->assign('setting_type', smarty_modifier_default(@$this->_tpl_vars['set_type'], @$this->_tpl_vars['type']), false); ?>
	<?php $this->assign('_uid', rand(0, 10000), false); ?>
	<script type="text/javascript">
		// <![CDATA[
		<?php echo '
		function amChartInited(chart_id)
		{
			var flashMovie = document.getElementById(chart_id);
			flashMovie.setParam(\'labels.label[0].text\', chart_titles[chart_id]);
		}
		if (!chart_titles) {
			var chart_titles = {};
		}
		'; ?>


		var so<?php echo $this->_tpl_vars['_uid']; ?>
 = new SWFObject("<?php echo $this->_tpl_vars['config']['current_path']; ?>
/lib/amcharts/am<?php echo $this->_tpl_vars['type']; ?>
/am<?php echo $this->_tpl_vars['type']; ?>
.swf", "<?php echo $this->_tpl_vars['chart_id']; ?>
am<?php echo $this->_tpl_vars['type']; ?>
", "<?php echo smarty_modifier_default(@$this->_tpl_vars['chart_width'], '650'); ?>
", "<?php echo smarty_modifier_default(@$this->_tpl_vars['chart_height'], '500'); ?>
", "8", "<?php echo smarty_modifier_default(@$this->_tpl_vars['chart_bgcolor'], '#FFFFFF'); ?>
");
		so<?php echo $this->_tpl_vars['_uid']; ?>
.addVariable("path", "<?php echo $this->_tpl_vars['config']['current_path']; ?>
/lib/amcharts/am<?php echo $this->_tpl_vars['type']; ?>
/");
		so<?php echo $this->_tpl_vars['_uid']; ?>
.addVariable("settings_file", escape("<?php echo $this->_tpl_vars['config']['current_path']; ?>
/lib/amcharts/am<?php echo $this->_tpl_vars['type']; ?>
/am<?php echo $this->_tpl_vars['setting_type']; ?>
_settings.xml"));
		so<?php echo $this->_tpl_vars['_uid']; ?>
.addVariable("chart_data", encodeURIComponent('<?php echo smarty_modifier_escape($this->_tpl_vars['chart_data'], 'javascript'); ?>
'));
		so<?php echo $this->_tpl_vars['_uid']; ?>
.addVariable("preloader_color", "#999999");
		so<?php echo $this->_tpl_vars['_uid']; ?>
.addVariable("chart_id", "<?php echo $this->_tpl_vars['chart_id']; ?>
am<?php echo $this->_tpl_vars['type']; ?>
");
		so<?php echo $this->_tpl_vars['_uid']; ?>
.write("flashcontent_<?php echo $this->_tpl_vars['chart_id']; ?>
am<?php echo $this->_tpl_vars['type']; ?>
");
		chart_titles['<?php echo $this->_tpl_vars['chart_id']; ?>
am<?php echo $this->_tpl_vars['type']; ?>
'] = '<span><?php echo smarty_modifier_escape($this->_tpl_vars['chart_title'], 'javascript'); ?>
</span>';

		delete so<?php echo $this->_tpl_vars['_uid']; ?>
;
		// ]]>
	</script>
<!-- end of amchart script --><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><!--<?php echo $this->_tpl_vars['table_prefix']; ?>
pie--></div>

<?php elseif ($this->_tpl_vars['table']['type'] == 'C'): ?>
	<div id="<?php echo $this->_tpl_vars['table_prefix']; ?>
pie"><?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('type' => 'pie', 'set_type' => 'piefl', 'chart_data' => $this->_tpl_vars['new_array']['pie_data'], 'chart_id' => $this->_tpl_vars['table_prefix'], 'chart_title' => $this->_tpl_vars['table']['description'], 'chart_height' => $this->_tpl_vars['new_array']['pie_height'], )); ?><!-- amchart script-->
	<div id="flashcontent_<?php echo $this->_tpl_vars['chart_id']; ?>
am<?php echo $this->_tpl_vars['type']; ?>
" align="center">
		<span><?php echo fn_get_lang_var('upgrade_flash_player', $this->getLanguage()); ?>
</span>
	</div>
	<?php $this->assign('setting_type', smarty_modifier_default(@$this->_tpl_vars['set_type'], @$this->_tpl_vars['type']), false); ?>
	<?php $this->assign('_uid', rand(0, 10000), false); ?>
	<script type="text/javascript">
		// <![CDATA[
		<?php echo '
		function amChartInited(chart_id)
		{
			var flashMovie = document.getElementById(chart_id);
			flashMovie.setParam(\'labels.label[0].text\', chart_titles[chart_id]);
		}
		if (!chart_titles) {
			var chart_titles = {};
		}
		'; ?>


		var so<?php echo $this->_tpl_vars['_uid']; ?>
 = new SWFObject("<?php echo $this->_tpl_vars['config']['current_path']; ?>
/lib/amcharts/am<?php echo $this->_tpl_vars['type']; ?>
/am<?php echo $this->_tpl_vars['type']; ?>
.swf", "<?php echo $this->_tpl_vars['chart_id']; ?>
am<?php echo $this->_tpl_vars['type']; ?>
", "<?php echo smarty_modifier_default(@$this->_tpl_vars['chart_width'], '650'); ?>
", "<?php echo smarty_modifier_default(@$this->_tpl_vars['chart_height'], '500'); ?>
", "8", "<?php echo smarty_modifier_default(@$this->_tpl_vars['chart_bgcolor'], '#FFFFFF'); ?>
");
		so<?php echo $this->_tpl_vars['_uid']; ?>
.addVariable("path", "<?php echo $this->_tpl_vars['config']['current_path']; ?>
/lib/amcharts/am<?php echo $this->_tpl_vars['type']; ?>
/");
		so<?php echo $this->_tpl_vars['_uid']; ?>
.addVariable("settings_file", escape("<?php echo $this->_tpl_vars['config']['current_path']; ?>
/lib/amcharts/am<?php echo $this->_tpl_vars['type']; ?>
/am<?php echo $this->_tpl_vars['setting_type']; ?>
_settings.xml"));
		so<?php echo $this->_tpl_vars['_uid']; ?>
.addVariable("chart_data", encodeURIComponent('<?php echo smarty_modifier_escape($this->_tpl_vars['chart_data'], 'javascript'); ?>
'));
		so<?php echo $this->_tpl_vars['_uid']; ?>
.addVariable("preloader_color", "#999999");
		so<?php echo $this->_tpl_vars['_uid']; ?>
.addVariable("chart_id", "<?php echo $this->_tpl_vars['chart_id']; ?>
am<?php echo $this->_tpl_vars['type']; ?>
");
		so<?php echo $this->_tpl_vars['_uid']; ?>
.write("flashcontent_<?php echo $this->_tpl_vars['chart_id']; ?>
am<?php echo $this->_tpl_vars['type']; ?>
");
		chart_titles['<?php echo $this->_tpl_vars['chart_id']; ?>
am<?php echo $this->_tpl_vars['type']; ?>
'] = '<span><?php echo smarty_modifier_escape($this->_tpl_vars['chart_title'], 'javascript'); ?>
</span>';

		delete so<?php echo $this->_tpl_vars['_uid']; ?>
;
		// ]]>
	</script>
<!-- end of amchart script --><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><!--<?php echo $this->_tpl_vars['table_prefix']; ?>
pie--></div>

<?php elseif ($this->_tpl_vars['table']['type'] == 'B'): ?>
	<div id="div_scroll_<?php echo $this->_tpl_vars['table_id']; ?>
" class="reports-graph-scroll">
		<div id="<?php echo $this->_tpl_vars['table_prefix']; ?>
bar"><?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('type' => 'column', 'chart_data' => $this->_tpl_vars['new_array']['column_data'], 'chart_id' => $this->_tpl_vars['table_prefix'], 'chart_title' => $this->_tpl_vars['table']['description'], 'chart_height' => $this->_tpl_vars['new_array']['column_height'], 'chart_width' => $this->_tpl_vars['new_array']['column_width'], )); ?><!-- amchart script-->
	<div id="flashcontent_<?php echo $this->_tpl_vars['chart_id']; ?>
am<?php echo $this->_tpl_vars['type']; ?>
" align="center">
		<span><?php echo fn_get_lang_var('upgrade_flash_player', $this->getLanguage()); ?>
</span>
	</div>
	<?php $this->assign('setting_type', smarty_modifier_default(@$this->_tpl_vars['set_type'], @$this->_tpl_vars['type']), false); ?>
	<?php $this->assign('_uid', rand(0, 10000), false); ?>
	<script type="text/javascript">
		// <![CDATA[
		<?php echo '
		function amChartInited(chart_id)
		{
			var flashMovie = document.getElementById(chart_id);
			flashMovie.setParam(\'labels.label[0].text\', chart_titles[chart_id]);
		}
		if (!chart_titles) {
			var chart_titles = {};
		}
		'; ?>


		var so<?php echo $this->_tpl_vars['_uid']; ?>
 = new SWFObject("<?php echo $this->_tpl_vars['config']['current_path']; ?>
/lib/amcharts/am<?php echo $this->_tpl_vars['type']; ?>
/am<?php echo $this->_tpl_vars['type']; ?>
.swf", "<?php echo $this->_tpl_vars['chart_id']; ?>
am<?php echo $this->_tpl_vars['type']; ?>
", "<?php echo smarty_modifier_default(@$this->_tpl_vars['chart_width'], '650'); ?>
", "<?php echo smarty_modifier_default(@$this->_tpl_vars['chart_height'], '500'); ?>
", "8", "<?php echo smarty_modifier_default(@$this->_tpl_vars['chart_bgcolor'], '#FFFFFF'); ?>
");
		so<?php echo $this->_tpl_vars['_uid']; ?>
.addVariable("path", "<?php echo $this->_tpl_vars['config']['current_path']; ?>
/lib/amcharts/am<?php echo $this->_tpl_vars['type']; ?>
/");
		so<?php echo $this->_tpl_vars['_uid']; ?>
.addVariable("settings_file", escape("<?php echo $this->_tpl_vars['config']['current_path']; ?>
/lib/amcharts/am<?php echo $this->_tpl_vars['type']; ?>
/am<?php echo $this->_tpl_vars['setting_type']; ?>
_settings.xml"));
		so<?php echo $this->_tpl_vars['_uid']; ?>
.addVariable("chart_data", encodeURIComponent('<?php echo smarty_modifier_escape($this->_tpl_vars['chart_data'], 'javascript'); ?>
'));
		so<?php echo $this->_tpl_vars['_uid']; ?>
.addVariable("preloader_color", "#999999");
		so<?php echo $this->_tpl_vars['_uid']; ?>
.addVariable("chart_id", "<?php echo $this->_tpl_vars['chart_id']; ?>
am<?php echo $this->_tpl_vars['type']; ?>
");
		so<?php echo $this->_tpl_vars['_uid']; ?>
.write("flashcontent_<?php echo $this->_tpl_vars['chart_id']; ?>
am<?php echo $this->_tpl_vars['type']; ?>
");
		chart_titles['<?php echo $this->_tpl_vars['chart_id']; ?>
am<?php echo $this->_tpl_vars['type']; ?>
'] = '<span><?php echo smarty_modifier_escape($this->_tpl_vars['chart_title'], 'javascript'); ?>
</span>';

		delete so<?php echo $this->_tpl_vars['_uid']; ?>
;
		// ]]>
	</script>
<!-- end of amchart script --><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><!--<?php echo $this->_tpl_vars['table_prefix']; ?>
bar--></div>
	</div>
<?php endif; ?>

<!--content_table_<?php echo $this->_tpl_vars['table_id']; ?>
--></div>

<?php else: ?>
	<p class="no-items"><?php echo fn_get_lang_var('no_data', $this->getLanguage()); ?>
</p>
<?php endif; ?>

<?php $this->_smarty_vars['capture']['tabsbox'] = ob_get_contents(); ob_end_clean(); ?>
<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('content' => $this->_smarty_vars['capture']['tabsbox'], 'active_tab' => "table_".($this->_tpl_vars['table_id']), 'track' => true, )); ?><?php echo smarty_function_script(array('src' => "js/tabs.js"), $this);?>


<?php if (! $this->_tpl_vars['active_tab']): ?>
	<?php $this->assign('active_tab', $this->_tpl_vars['_REQUEST']['selected_section'], false); ?>
<?php endif; ?>

<?php $this->assign('empty_tab_ids', smarty_modifier_empty_tabs($this->_tpl_vars['content']), false); ?>

<?php if ($this->_tpl_vars['navigation']['tabs']): ?>
<div class="tabs cm-j-tabs<?php if ($this->_tpl_vars['track']): ?> cm-track<?php endif; ?>">
	<ul>
	<?php $_from = $this->_tpl_vars['navigation']['tabs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['tabs'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['tabs']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['tab']):
        $this->_foreach['tabs']['iteration']++;
?>
		<?php if (( ! $this->_tpl_vars['tabs_section'] || $this->_tpl_vars['tabs_section'] == $this->_tpl_vars['tab']['section'] ) && ( $this->_tpl_vars['tab']['hidden'] || ! smarty_modifier_in_array($this->_tpl_vars['key'], $this->_tpl_vars['empty_tab_ids']) )): ?>
		<li id="<?php echo $this->_tpl_vars['key']; ?>
<?php echo $this->_tpl_vars['id_suffix']; ?>
" class="<?php if ($this->_tpl_vars['tab']['hidden'] == 'Y'): ?>hidden <?php endif; ?><?php if ($this->_tpl_vars['tab']['js']): ?>cm-js<?php elseif ($this->_tpl_vars['tab']['ajax']): ?>cm-js cm-ajax<?php endif; ?><?php if ($this->_tpl_vars['key'] == $this->_tpl_vars['active_tab']): ?> cm-active<?php endif; ?>"><a <?php if ($this->_tpl_vars['tab']['href']): ?>href="<?php echo fn_url($this->_tpl_vars['tab']['href']); ?>
"<?php endif; ?>><?php echo $this->_tpl_vars['tab']['title']; ?>
</a><?php if ($this->_tpl_vars['key'] == $this->_tpl_vars['active_tab']): ?><?php echo $this->_tpl_vars['active_tab_extra']; ?>
<?php endif; ?></li>
		<?php endif; ?>
	<?php endforeach; endif; unset($_from); ?>
	</ul>
</div>
<div class="cm-tabs-content">
	<?php echo $this->_tpl_vars['content']; ?>

</div>
<?php else: ?>
	<?php echo $this->_tpl_vars['content']; ?>

<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>

<?php else: ?>
	<p class="no-items"><?php echo fn_get_lang_var('no_data', $this->getLanguage()); ?>
</p>
<?php endif; ?>
<?php $this->_smarty_vars['capture']['mainbox'] = ob_get_contents(); ob_end_clean(); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/mainbox.tpl", 'smarty_include_vars' => array('title' => fn_get_lang_var('reports', $this->getLanguage()),'content' => $this->_smarty_vars['capture']['mainbox'],'extra_tools' => $this->_smarty_vars['capture']['extra_tools'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<!--content_<?php echo $this->_tpl_vars['report']['report_id']; ?>
--></div>