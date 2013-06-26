<?php /* Smarty version 2.6.18, created on 2013-06-26 14:54:02
         compiled from addons/billibuys/views/billibuys/view.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'fn_url', 'addons/billibuys/views/billibuys/view.tpl', 4, false),array('modifier', 'fn_check_form_permissions', 'addons/billibuys/views/billibuys/view.tpl', 5, false),array('function', 'cycle', 'addons/billibuys/views/billibuys/view.tpl', 20, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('create_notification','check_uncheck_all','item','posted','current_bid','place_bid','no_data','billibuys'));
?>
<?php ob_start(); ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/billibuys/views/billibuys/components/billibuys_search_form.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<a href="<?php echo fn_url("admin.php?dispatch=billibuys.notify"); ?>
"><?php echo fn_get_lang_var('create_notification', $this->getLanguage()); ?>
</a>
<form action="<?php echo fn_url(""); ?>
" method="post" name="category_tree_form" class="<?php if (fn_check_form_permissions("")): ?>cm-hide-inputs<?php endif; ?>">

<table cellpadding="0" cellspacing="0" width="100%" border="0" class="table">
	<tr>
		<th width="1%" class="center">
			<input type="checkbox" name="check_all" value="Y" title="<?php echo fn_get_lang_var('check_uncheck_all', $this->getLanguage()); ?>
" class="checkbox cm-check-items" /></td>
		<th><?php echo fn_get_lang_var('item', $this->getLanguage()); ?>
</th>
		<th><?php echo fn_get_lang_var('posted', $this->getLanguage()); ?>
</th>
		<th><?php echo fn_get_lang_var('current_bid', $this->getLanguage()); ?>
</th>
		<th><?php echo fn_get_lang_var('place_bid', $this->getLanguage()); ?>
</th>
	</tr>

	<?php if ($this->_tpl_vars['requests']['success']): ?>
		<?php $_from = $this->_tpl_vars['requests']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['request']):
?>
			<?php if (is_array ( $this->_tpl_vars['request'] )): ?>
				<tr <?php echo smarty_function_cycle(array('values' => "class=\"table-row\","), $this);?>
>
					<td width="1%" class="center">
						<input type="checkbox" name="event_ids[]" value="<?php echo $this->_tpl_vars['request']['bb_bid_id']; ?>
" class="checkbox cm-item" /></td>
					<td><?php echo $this->_tpl_vars['request']['description']; ?>
</td>
					<td><?php echo $this->_tpl_vars['request']['timestamp']; ?>
</td>
					<td><?php if ($this->_tpl_vars['request']['min_amt'] != ''): ?>$<?php echo $this->_tpl_vars['request']['min_amt']; ?>
<?php else: ?>No Bids Yet!<?php endif; ?></td>
					<td>$&nbsp;<input type="text" name="bb_data[<?php echo $this->_tpl_vars['request']['bb_request_id']; ?>
][bid]" size="7" class="input-text-medium" /></td>
				</tr>
			<?php endif; ?>
		<?php endforeach; endif; unset($_from); ?>
	<?php else: ?>
		<tr class="no-items">
			<td colspan="4"><p><?php echo fn_get_lang_var('no_data', $this->getLanguage()); ?>
</p></td>
		</tr>
	<?php endif; ?>
</table>

<div class="buttons-container buttons-bg">
	<div class="float-left">
		<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/save.tpl", 'smarty_include_vars' => array('but_name' => "dispatch[billibuys.view]",'but_role' => 'button_main')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

	</div>
</div>
</form>
<?php $this->_smarty_vars['capture']['mainbox'] = ob_get_contents(); ob_end_clean(); ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/mainbox.tpl", 'smarty_include_vars' => array('title' => fn_get_lang_var('billibuys', $this->getLanguage()),'content' => $this->_smarty_vars['capture']['mainbox'],'title_extra' => $this->_smarty_vars['capture']['title_extra'],'tools' => $this->_smarty_vars['capture']['tools'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>