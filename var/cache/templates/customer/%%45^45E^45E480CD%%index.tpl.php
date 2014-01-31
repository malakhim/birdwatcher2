<?php /* Smarty version 2.6.18, created on 2014-01-31 21:37:44
         compiled from index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'lower', 'index.tpl', 2, false),array('modifier', 'escape', 'index.tpl', 8, false),array('modifier', 'unescape', 'index.tpl', 11, false),array('modifier', 'strip_tags', 'index.tpl', 11, false),array('modifier', 'count', 'index.tpl', 13, false),array('modifier', 'defined', 'index.tpl', 24, false),array('function', 'render_location', 'index.tpl', 41, false),array('block', 'hook', 'index.tpl', 54, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="<?php echo smarty_modifier_lower(@CART_LANGUAGE); ?>
">
<head>

<?php echo '<title>'; ?><?php if ($this->_tpl_vars['page_title']): ?><?php echo ''; ?><?php echo smarty_modifier_escape($this->_tpl_vars['page_title'], 'html'); ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php $_from = $this->_tpl_vars['breadcrumbs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['bkt'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['bkt']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['i']):
        $this->_foreach['bkt']['iteration']++;
?><?php echo ''; ?><?php if (! ($this->_foreach['bkt']['iteration'] <= 1)): ?><?php echo ''; ?><?php echo smarty_modifier_escape(smarty_modifier_strip_tags(smarty_modifier_unescape($this->_tpl_vars['i']['title'])), 'html'); ?><?php echo ''; ?><?php if (! ($this->_foreach['bkt']['iteration'] == $this->_foreach['bkt']['total'])): ?><?php echo ' :: '; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php endforeach; endif; unset($_from); ?><?php echo ''; ?><?php if (! $this->_tpl_vars['skip_page_title']): ?><?php echo ''; ?><?php if (count($this->_tpl_vars['breadcrumbs']) > 1): ?><?php echo ' - '; ?><?php endif; ?><?php echo ''; ?><?php echo smarty_modifier_escape($this->_tpl_vars['location_data']['title'], 'html'); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo '</title>'; ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "meta.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<link href="<?php echo $this->_tpl_vars['images_dir']; ?>
/icons/favicon.ico" rel="shortcut icon" />
<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/styles.tpl", 'smarty_include_vars' => array('include_dropdown' => true)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/scripts.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</head>

<body>
<?php if (defined('SKINS_PANEL')): ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "demo_skin_selector.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php endif; ?>
<div class="helper-container">
	<a name="top"></a>	


	<?php echo smarty_function_render_location(array(), $this);?>

	<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/loading_box.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php if (defined('TRANSLATION_MODE')): ?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/translate_box.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php endif; ?>
	<?php if (defined('CUSTOMIZATION_MODE')): ?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/template_editor.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php endif; ?>
	<?php if (defined('CUSTOMIZATION_MODE') || defined('TRANSLATION_MODE')): ?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/design_mode_panel.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php endif; ?>
</div>

<?php $this->_tag_stack[] = array('hook', array('name' => "index:footer")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php if ($this->_tpl_vars['addons']['statistics']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/statistics/hooks/index/footer.post.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php if ($this->_tpl_vars['addons']['google_analytics']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/google_analytics/hooks/index/footer.post.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

</body>

</html>