<?php /* Smarty version 2.6.18, created on 2014-03-07 13:03:02
         compiled from views/currencies/manage.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'unescape', 'views/currencies/manage.tpl', 1, false),array('modifier', 'trim', 'views/currencies/manage.tpl', 1, false),array('modifier', 'fn_url', 'views/currencies/manage.tpl', 23, false),array('modifier', 'escape', 'views/currencies/manage.tpl', 34, false),array('modifier', 'fn_allow_save_object', 'views/currencies/manage.tpl', 36, false),array('function', 'script', 'views/currencies/manage.tpl', 15, false),array('block', 'hook', 'views/currencies/manage.tpl', 54, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('text_position_updating','currency_rate','currency_sign','editing_currency','no_data','new_currency','add_currency','currencies'));
?>
<?php 

				$rname = !empty($resource_name) ? $resource_name : $params['smarty_include_tpl_file'];
				if ($this->compile_check && empty($inline_no_check[$rname]) && $this->is_cached($rname)) {
					if ($this->check_inline_blocks(array (
  'common_templates/sortable_position_scripts.tpl' => 1367063753,
))) {
						$_smarty_compile_path = $this->_get_compile_path($rname);
						$this->_compile_resource($rname, $_smarty_compile_path);
						$inline_no_check[$rname] = true;
						include $_smarty_compile_path;
						return;
					}
				}
			 ?><?php echo smarty_function_script(array('src' => "js/tabs.js"), $this);?>


<?php ob_start(); ?>
<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('sortable_table' => 'currencies', 'sortable_id_name' => 'currency_code', )); ?><script type="text/javascript">
//<![CDATA[
$(function() <?php echo $this->_tpl_vars['ldelim']; ?>

	var params = <?php echo $this->_tpl_vars['ldelim']; ?>
<?php echo $this->_tpl_vars['rdelim']; ?>
;
		params.text_position_updating = '<?php echo fn_get_lang_var('text_position_updating', $this->getLanguage()); ?>
';
		params.update_sortable_url = '<?php echo fn_url("tools.update_position?table=".($this->_tpl_vars['sortable_table'])."&id_name=".($this->_tpl_vars['sortable_id_name']), 'A', 'rel', '&'); ?>
';
		params.handle_class = '<?php echo $this->_tpl_vars['handle_class']; ?>
';

	var sortable_id = '<?php if ($this->_tpl_vars['sortable_id']): ?>#<?php echo $this->_tpl_vars['sortable_id']; ?>
<?php else: ?><?php endif; ?>';
	
	$(sortable_id + '.cm-sortable').ceSortable(params);
<?php echo $this->_tpl_vars['rdelim']; ?>
);

//]]>
</script><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>

<?php $this->assign('r_url', smarty_modifier_escape($this->_tpl_vars['config']['current_url'], 'url'), false); ?>

<div class="items-container cm-sortable <?php if (! fn_allow_save_object("", "", true)): ?> cm-hide-inputs<?php endif; ?>" id="manage_currencies_list">
<?php $_from = $this->_tpl_vars['currencies_data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['currency']):
?>
	<?php if ($this->_tpl_vars['currency']['is_primary'] == 'Y'): ?>
		<?php $this->assign('_href_delete', "", false); ?>
	<?php else: ?>
		<?php $this->assign('_href_delete', "currencies.delete?currency_code=".($this->_tpl_vars['currency']['currency_code']), false); ?>
	<?php endif; ?>
	<?php $this->assign('currency_details', "<span>".($this->_tpl_vars['currency']['currency_code'])."</span>, ".(fn_get_lang_var('currency_rate', $this->getLanguage())).": <span>".($this->_tpl_vars['currency']['coefficient'])."</span>, ".(fn_get_lang_var('currency_sign', $this->getLanguage())).": <span>".($this->_tpl_vars['currency']['symbol'])."</span>", false); ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/object_group.tpl", 'smarty_include_vars' => array('id' => $this->_tpl_vars['currency']['currency_code'],'text' => $this->_tpl_vars['currency']['description'],'details' => smarty_modifier_unescape($this->_tpl_vars['currency_details']),'href' => "currencies.update?currency_code=".($this->_tpl_vars['currency']['currency_code'])."&amp;return_url=".($this->_tpl_vars['r_url']),'href_delete' => $this->_tpl_vars['_href_delete'],'rev_delete' => 'manage_currencies_list','header_text' => (fn_get_lang_var('editing_currency', $this->getLanguage())).":&nbsp;".($this->_tpl_vars['currency']['description']),'table' => 'currencies','object_id_name' => 'currency_code','status' => $this->_tpl_vars['currency']['status'],'additional_class' => "cm-sortable-row cm-sortable-id-".($this->_tpl_vars['currency']['currency_code']))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php endforeach; else: ?>

	<p class="no-items"><?php echo fn_get_lang_var('no_data', $this->getLanguage()); ?>
</p>

<?php endif; unset($_from); ?>
<!--manage_currencies_list--></div>

<div class="buttons-container">
	<?php ob_start(); ?>
		<?php $this->_tag_stack[] = array('hook', array('name' => "currencies:import_rates")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
	<?php $this->_smarty_vars['capture']['extra_tools'] = ob_get_contents(); ob_end_clean(); ?>
</div>

<?php if (fn_allow_save_object("", "", true)): ?>
	<?php ob_start(); ?>
		<?php ob_start(); ?>
			<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/currencies/update.tpl", 'smarty_include_vars' => array('mode' => 'add','currency' => "")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<?php $this->_smarty_vars['capture']['add_new_picker'] = ob_get_contents(); ob_end_clean(); ?>
		
		<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/popupbox.tpl", 'smarty_include_vars' => array('id' => 'add_new_currency','text' => fn_get_lang_var('new_currency', $this->getLanguage()),'content' => $this->_smarty_vars['capture']['add_new_picker'],'link_text' => fn_get_lang_var('add_currency', $this->getLanguage()),'act' => 'general')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php $this->_smarty_vars['capture']['tools'] = ob_get_contents(); ob_end_clean(); ?>
<?php endif; ?>

<?php $this->_smarty_vars['capture']['mainbox'] = ob_get_contents(); ob_end_clean(); ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/mainbox.tpl", 'smarty_include_vars' => array('title' => fn_get_lang_var('currencies', $this->getLanguage()),'content' => $this->_smarty_vars['capture']['mainbox'],'tools' => $this->_smarty_vars['capture']['tools'],'title_extra' => $this->_smarty_vars['capture']['title_extra'],'select_languages' => true,'extra_tools' => trim($this->_smarty_vars['capture']['extra_tools']))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>