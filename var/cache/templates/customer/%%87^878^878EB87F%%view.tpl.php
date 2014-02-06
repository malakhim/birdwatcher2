<?php /* Smarty version 2.6.18, created on 2014-02-03 15:24:07
         compiled from views/pages/view.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'trim', 'views/pages/view.tpl', 2, false),array('modifier', 'unescape', 'views/pages/view.tpl', 3, false),array('block', 'hook', 'views/pages/view.tpl', 2, false),)), $this); ?>
<div class="wysiwyg-content">
	<?php if ($this->_tpl_vars['addons']['polls']['status'] == 'A'): ?><?php ob_start(); $this->_in_capture[] = 'ec900a4e059a0f93ab44a359c4d137c9';
$_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/polls/hooks/pages/page_content.override.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
$this->_tpl_vars['addon_content'] = ob_get_contents(); ob_end_clean(); array_pop($this->_in_capture); if (!empty($this->_scripts['ec900a4e059a0f93ab44a359c4d137c9'])) { echo implode("\n", $this->_scripts['ec900a4e059a0f93ab44a359c4d137c9']); unset($this->_scripts['ec900a4e059a0f93ab44a359c4d137c9']); }
 ?><?php else: ?><?php $this->assign('addon_content', "", false); ?><?php endif; ?><?php if (trim($this->_tpl_vars['addon_content'])): ?><?php echo $this->_tpl_vars['addon_content']; ?>
<?php else: ?><?php if ($this->_tpl_vars['addons']['form_builder']['status'] == 'A'): ?><?php ob_start(); $this->_in_capture[] = '6b65ef970fd12f8f8130c83cc7d18336';
$_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/form_builder/hooks/pages/page_content.override.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
$this->_tpl_vars['addon_content'] = ob_get_contents(); ob_end_clean(); array_pop($this->_in_capture); if (!empty($this->_scripts['6b65ef970fd12f8f8130c83cc7d18336'])) { echo implode("\n", $this->_scripts['6b65ef970fd12f8f8130c83cc7d18336']); unset($this->_scripts['6b65ef970fd12f8f8130c83cc7d18336']); }
 ?><?php else: ?><?php $this->assign('addon_content', "", false); ?><?php endif; ?><?php if (trim($this->_tpl_vars['addon_content'])): ?><?php echo $this->_tpl_vars['addon_content']; ?>
<?php else: ?><?php $this->_tag_stack[] = array('hook', array('name' => "pages:page_content")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
	<?php echo smarty_modifier_unescape($this->_tpl_vars['page']['description']); ?>

	<?php if ($this->_tpl_vars['addons']['tags']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/tags/hooks/pages/page_content.post.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php endif; ?><?php endif; ?>
	<?php ob_start(); ?><?php echo $this->_tpl_vars['page']['page']; ?>
<?php $this->_smarty_vars['capture']['mainbox_title'] = ob_get_contents(); ob_end_clean(); ?>
</div>
	
<?php $this->_tag_stack[] = array('hook', array('name' => "pages:page_extra")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
<?php if ($this->_tpl_vars['addons']['discussion']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/discussion/hooks/pages/page_extra.post.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>