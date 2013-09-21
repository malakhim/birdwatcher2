<?php /* Smarty version 2.6.18, created on 2013-09-21 19:31:47
         compiled from views/menus/manage.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'trim', 'views/menus/manage.tpl', 1, false),array('modifier', 'escape', 'views/menus/manage.tpl', 5, false),array('modifier', 'fn_url', 'views/menus/manage.tpl', 15, false),array('function', 'script', 'views/menus/manage.tpl', 1, false),array('block', 'hook', 'views/menus/manage.tpl', 27, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('editing_menu','manage_items','no_data','new_menu','add_menu','menus'));
?>
<?php echo smarty_function_script(array('src' => "js/tabs.js"), $this);?>


<?php ob_start(); ?>

<?php $this->assign('r_url', smarty_modifier_escape($this->_tpl_vars['config']['current_url'], 'url'), false); ?>

<div class="items-container" id="manage_tabs_list">

<?php $_from = $this->_tpl_vars['menus']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['menu']):
?>
		<?php $this->assign('_href_delete', "menus.delete?menu_id=".($this->_tpl_vars['menu']['menu_id']), false); ?>		
		<?php $this->assign('dialog_name', (fn_get_lang_var('editing_menu', $this->getLanguage())).":&nbsp;".($this->_tpl_vars['menu']['name']), false); ?>
		<?php $this->assign('name', $this->_tpl_vars['menu']['name'], false); ?>
		<?php $this->assign('edit_link', "menus.update?menu_data[menu_id]=".($this->_tpl_vars['menu']['menu_id'])."&amp;return_url=".($this->_tpl_vars['r_url']), false); ?>
		<?php ob_start(); ?>			
			<a href="<?php echo fn_url("static_data.manage&section=A&menu_id=".($this->_tpl_vars['menu']['menu_id'])); ?>
"><?php echo fn_get_lang_var('manage_items', $this->getLanguage()); ?>
</a> |
		<?php $this->_smarty_vars['capture']['items_link'] = ob_get_contents(); ob_end_clean(); ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/object_group.tpl", 'smarty_include_vars' => array('id' => $this->_tpl_vars['menu']['menu_id'],'text' => $this->_tpl_vars['name'],'href' => $this->_tpl_vars['edit_link'],'href_delete' => $this->_tpl_vars['_href_delete'],'rev_delete' => 'pagination_contents','header_text' => $this->_tpl_vars['dialog_name'],'table' => 'menus','object_id_name' => 'menu_id','status' => $this->_tpl_vars['menu']['status'],'tool_items' => $this->_smarty_vars['capture']['items_link'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php endforeach; else: ?>

	<p class="no-items"><?php echo fn_get_lang_var('no_data', $this->getLanguage()); ?>
</p>

<?php endif; unset($_from); ?>
<!--manage_tabs_list--></div>

<div class="buttons-container">
	<?php ob_start(); ?>
		<?php $this->_tag_stack[] = array('hook', array('name' => "currencies:import_rates")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
	<?php $this->_smarty_vars['capture']['extra_tools'] = ob_get_contents(); ob_end_clean(); ?>
</div>

<?php ob_start(); ?>		
	<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/popupbox.tpl", 'smarty_include_vars' => array('act' => 'general','id' => 'add_menu','text' => fn_get_lang_var('new_menu', $this->getLanguage()),'link_text' => fn_get_lang_var('add_menu', $this->getLanguage()),'href' => "menus.update",'opener_ajax_class' => "cm-ajax",'link_class' => "cm-ajax-force",'content' => "")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $this->_smarty_vars['capture']['tools'] = ob_get_contents(); ob_end_clean(); ?>

<?php $this->_smarty_vars['capture']['mainbox'] = ob_get_contents(); ob_end_clean(); ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/mainbox.tpl", 'smarty_include_vars' => array('title' => fn_get_lang_var('menus', $this->getLanguage()),'content' => $this->_smarty_vars['capture']['mainbox'],'tools' => $this->_smarty_vars['capture']['tools'],'title_extra' => $this->_smarty_vars['capture']['title_extra'],'select_languages' => true,'extra_tools' => trim($this->_smarty_vars['capture']['extra_tools']))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>