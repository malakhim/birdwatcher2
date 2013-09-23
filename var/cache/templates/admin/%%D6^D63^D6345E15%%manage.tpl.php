<?php /* Smarty version 2.6.18, created on 2013-09-23 17:38:43
         compiled from views/statuses/manage.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'lower', 'views/statuses/manage.tpl', 1, false),array('function', 'script', 'views/statuses/manage.tpl', 1, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('editing_status','no_items','new_status','add_status'));
?>
<?php echo smarty_function_script(array('src' => "js/tabs.js"), $this);?>


<?php ob_start(); ?>

<div class="items-container" id="statuses_list">
<?php $_from = $this->_tpl_vars['statuses']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['s']):
?>
	<?php if ($this->_tpl_vars['s']['is_default'] !== 'Y'): ?>
		<?php $this->assign('cur_href_delete', "statuses.delete?status=".($this->_tpl_vars['s']['status'])."&type=".($this->_tpl_vars['type']), false); ?>
	<?php else: ?>
		<?php $this->assign('cur_href_delete', "", false); ?>
	<?php endif; ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/object_group.tpl", 'smarty_include_vars' => array('id' => smarty_modifier_lower($this->_tpl_vars['s']['status']),'text' => $this->_tpl_vars['s']['description'],'href' => "statuses.update?status=".($this->_tpl_vars['s']['status'])."&type=".($this->_tpl_vars['type']),'href_delete' => $this->_tpl_vars['cur_href_delete'],'rev_delete' => 'statuses_list','header_text' => (fn_get_lang_var('editing_status', $this->getLanguage())).":&nbsp;".($this->_tpl_vars['s']['description']))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php endforeach; else: ?>

	<p class="no-items"><?php echo fn_get_lang_var('no_items', $this->getLanguage()); ?>
</p>

<?php endif; unset($_from); ?>
<!--statuses_list--></div>

<div class="buttons-container">
	<?php ob_start(); ?>
		<?php ob_start(); ?>
			<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/statuses/update.tpl", 'smarty_include_vars' => array('mode' => 'add')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<?php $this->_smarty_vars['capture']['add_new_picker'] = ob_get_contents(); ob_end_clean(); ?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/popupbox.tpl", 'smarty_include_vars' => array('id' => 'add_new_status','action' => "statuses.add",'text' => fn_get_lang_var('new_status', $this->getLanguage()),'content' => $this->_smarty_vars['capture']['add_new_picker'],'link_text' => fn_get_lang_var('add_status', $this->getLanguage()),'act' => 'general')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php $this->_smarty_vars['capture']['tools'] = ob_get_contents(); ob_end_clean(); ?>
</div>

<?php $this->_smarty_vars['capture']['mainbox'] = ob_get_contents(); ob_end_clean(); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/mainbox.tpl", 'smarty_include_vars' => array('title' => $this->_tpl_vars['title'],'content' => $this->_smarty_vars['capture']['mainbox'],'tools' => $this->_smarty_vars['capture']['tools'],'select_languages' => true)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>