<?php /* Smarty version 2.6.18, created on 2014-01-23 12:47:12
         compiled from meta.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'hook', 'meta.tpl', 1, false),array('modifier', 'lower', 'meta.tpl', 6, false),array('modifier', 'html_entity_decode', 'meta.tpl', 7, false),array('modifier', 'default', 'meta.tpl', 7, false),array('modifier', 'trim', 'meta.tpl', 9, false),array('function', 'set_id', 'meta.tpl', 9, false),)), $this); ?>
<?php ob_start(); ?><?php $this->_tag_stack[] = array('hook', array('name' => "index:meta")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
<?php if ($this->_tpl_vars['display_base_href']): ?>
<base href="<?php echo $this->_tpl_vars['config']['current_location']; ?>
/" />
<?php endif; ?>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo @CHARSET; ?>
" />
<meta http-equiv="Content-Language" content="<?php echo smarty_modifier_lower(@CART_LANGUAGE); ?>
" />
<meta name="description" content="<?php echo smarty_modifier_default(html_entity_decode($this->_tpl_vars['meta_description'], @ENT_COMPAT, "UTF-8"), @$this->_tpl_vars['location_data']['meta_description']); ?>
" />
<meta name="keywords" content="<?php echo smarty_modifier_default(@$this->_tpl_vars['meta_keywords'], @$this->_tpl_vars['location_data']['meta_keywords']); ?>
" />
<?php if ($this->_tpl_vars['addons']['seo']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/seo/hooks/index/meta.post.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php $this->_smarty_vars['capture']['template_content'] = ob_get_contents(); ob_end_clean(); ?><?php if (trim($this->_smarty_vars['capture']['template_content'])): ?><?php if ($this->_tpl_vars['auth']['area'] == 'A'): ?><span class="cm-template-box" template="meta.tpl" id="<?php echo smarty_function_set_id(array('name' => "meta.tpl"), $this);?>
"><img class="cm-template-icon hidden" src="<?php echo $this->_tpl_vars['images_dir']; ?>
/icons/layout_edit.gif" width="16" height="16" alt="" /><?php echo $this->_smarty_vars['capture']['template_content']; ?>
<!--[/tpl_id]--></span><?php else: ?><?php echo $this->_smarty_vars['capture']['template_content']; ?>
<?php endif; ?><?php endif; ?>