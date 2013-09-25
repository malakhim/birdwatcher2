<?php /* Smarty version 2.6.18, created on 2013-09-25 16:55:37
         compiled from views/addons/manage.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'script', 'views/addons/manage.tpl', 1, false),array('modifier', 'fn_get_all_states', 'views/addons/manage.tpl', 5, false),array('modifier', 'escape', 'views/addons/manage.tpl', 11, false),array('modifier', 'defined', 'views/addons/manage.tpl', 24, false),array('modifier', 'fn_url', 'views/addons/manage.tpl', 35, false),array('modifier', 'lower', 'views/addons/manage.tpl', 57, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('install','uninstall','manage','settings','options','no_items','addons'));
?>
<?php echo smarty_function_script(array('src' => "js/tabs.js"), $this);?>

<?php echo smarty_function_script(array('src' => "js/profiles_scripts.js"), $this);?>

<script type="text/javascript">
	//<![CDATA[
	<?php $this->assign('states', fn_get_all_states(@CART_LANGUAGE, false, true), false); ?>
	var states = new Array();
	<?php if ($this->_tpl_vars['states']): ?>
	<?php $_from = $this->_tpl_vars['states']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['country_code'] => $this->_tpl_vars['country_states']):
?>
	states['<?php echo $this->_tpl_vars['country_code']; ?>
'] = new Array();
	<?php $_from = $this->_tpl_vars['country_states']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['fs'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['fs']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['state']):
        $this->_foreach['fs']['iteration']++;
?>
	states['<?php echo $this->_tpl_vars['country_code']; ?>
']['<?php echo smarty_modifier_escape($this->_tpl_vars['state']['code'], 'quotes'); ?>
'] = '<?php echo smarty_modifier_escape($this->_tpl_vars['state']['state'], 'javascript'); ?>
';
	<?php endforeach; endif; unset($_from); ?>
	<?php endforeach; endif; unset($_from); ?>
	<?php endif; ?>
	//]]>
</script>

<?php echo smarty_function_script(array('src' => "js/fileuploader_scripts.js"), $this);?>


<?php ob_start(); ?>

<div class="items-container" id="addons_list">
<?php $_from = $this->_tpl_vars['addons_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['a']):
?>
	<?php if (defined('COMPANY_ID')): ?>
		<?php $this->assign('hide_for_vendor', true, false); ?>
	<?php endif; ?>

	<?php if ($this->_tpl_vars['a']['status'] == 'N'): ?>
		<?php $this->assign('details', "", false); ?>
		<?php $this->assign('non_editable', true, false); ?>  
		<?php $this->assign('status', "", false); ?> 
		<?php if (! defined('COMPANY_ID')): ?>   
			<?php $this->assign('act', 'fake', false); ?>
			<?php ob_start(); ?>
				<a class="lowercase <?php if (! $this->_tpl_vars['a']['js_functions']['install_button']): ?>cm-ajax cm-ajax-force cm-ajax-full-render<?php endif; ?>" href="<?php echo fn_url("addons.install?addon=".($this->_tpl_vars['key'])); ?>
" <?php if ($this->_tpl_vars['a']['js_functions']['install_button']): ?>onclick="<?php echo $this->_tpl_vars['a']['js_functions']['install_button']; ?>
(); return false;"<?php endif; ?> rev="addon_<?php echo $this->_tpl_vars['key']; ?>
,header"><?php echo fn_get_lang_var('install', $this->getLanguage()); ?>
</a>
			<?php $this->_smarty_vars['capture']['links'] = ob_get_contents(); ob_end_clean(); ?>
		<?php endif; ?>
	<?php else: ?>
		<?php $this->assign('details', "", false); ?>
		<?php $this->assign('link_text', "", false); ?>
		<?php $this->assign('status', $this->_tpl_vars['a']['status'], false); ?> 
		<?php if ($this->_tpl_vars['a']['has_options']): ?>
			<?php $this->assign('act', 'edit', false); ?>
			<?php $this->assign('non_editable', false, false); ?>
		<?php else: ?>
			<?php $this->assign('act', 'fake', false); ?>
			<?php $this->assign('non_editable', true, false); ?>
		<?php endif; ?>
		<?php if (! defined('COMPANY_ID')): ?>
			<?php ob_start(); ?>
			<a class="cm-confirm lowercase cm-ajax cm-ajax-force cm-ajax-full-render" href="<?php echo fn_url("addons.uninstall?addon=".($this->_tpl_vars['a']['addon'])); ?>
" rev="addon_<?php echo $this->_tpl_vars['key']; ?>
"><?php echo fn_get_lang_var('uninstall', $this->getLanguage()); ?>
</a>
			<?php $this->_smarty_vars['capture']['links'] = ob_get_contents(); ob_end_clean(); ?>
		<?php endif; ?>
	<?php endif; ?>

	<?php if ($this->_tpl_vars['a']['separate'] && ! $this->_tpl_vars['non_editable']): ?>
		<?php $this->assign('link_text', smarty_modifier_lower(fn_get_lang_var('manage', $this->getLanguage())), false); ?>
	<?php elseif ($this->_tpl_vars['a']['status'] != 'N'): ?>
		<?php $this->assign('link_text', smarty_modifier_lower(fn_get_lang_var('settings', $this->getLanguage())), false); ?>
	<?php else: ?>
		<?php $this->assign('link_text', "&nbsp;", false); ?>
	<?php endif; ?>

	<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/object_group.tpl", 'smarty_include_vars' => array('no_popup' => $this->_tpl_vars['a']['separate'],'id' => $this->_tpl_vars['a']['addon'],'text' => $this->_tpl_vars['a']['name'],'details' => $this->_tpl_vars['a']['description'],'status_rev' => 'header','update_controller' => 'addons','href' => "addons.update?addon=".($this->_tpl_vars['a']['addon']),'href_delete' => "",'rev_delete' => 'addons_list','header_text' => ($this->_tpl_vars['a']['name']).":&nbsp;<span class=\"lowercase\">".(fn_get_lang_var('options', $this->getLanguage()))."</span>",'links' => $this->_smarty_vars['capture']['links'],'non_editable' => $this->_tpl_vars['non_editable'],'row_id' => "addon_".($this->_tpl_vars['key']),'link_text' => $this->_tpl_vars['link_text'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php endforeach; else: ?>

	<p class="no-items"><?php echo fn_get_lang_var('no_items', $this->getLanguage()); ?>
</p>

<?php endif; unset($_from); ?>
<!--addons_list--></div>

<?php $this->_smarty_vars['capture']['mainbox'] = ob_get_contents(); ob_end_clean(); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/mainbox.tpl", 'smarty_include_vars' => array('title' => fn_get_lang_var('addons', $this->getLanguage()),'content' => $this->_smarty_vars['capture']['mainbox'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
