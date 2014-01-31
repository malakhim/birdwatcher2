<?php /* Smarty version 2.6.18, created on 2014-01-31 21:37:44
         compiled from common_templates/styles.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'defined', 'common_templates/styles.tpl', 10, false),array('modifier', 'trim', 'common_templates/styles.tpl', 24, false),array('block', 'hook', 'common_templates/styles.tpl', 20, false),array('function', 'join_css', 'common_templates/styles.tpl', 22, false),array('function', 'set_id', 'common_templates/styles.tpl', 24, false),)), $this); ?>
<?php ob_start(); ?>
<?php ob_start(); ?>
<link href="<?php echo $this->_tpl_vars['config']['skin_path']; ?>
/css/960/reset.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo $this->_tpl_vars['config']['skin_path']; ?>
/css/ui/jqueryui.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo $this->_tpl_vars['config']['skin_path']; ?>
/css/960/960.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo $this->_tpl_vars['config']['skin_path']; ?>
/base.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $this->_tpl_vars['config']['skin_path']; ?>
/styles.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $this->_tpl_vars['config']['skin_path']; ?>
/print.css" rel="stylesheet" media="print" type="text/css" />
<?php if (defined('TRANSLATION_MODE') || defined('CUSTOMIZATION_MODE')): ?>
<link href="<?php echo $this->_tpl_vars['config']['skin_path']; ?>
/design_mode.css" rel="stylesheet" type="text/css" />
<?php endif; ?>
<?php if ($this->_tpl_vars['include_dropdown']): ?>
<link href="<?php echo $this->_tpl_vars['config']['skin_path']; ?>
/dropdown.css" rel="stylesheet" type="text/css" />
<?php endif; ?>
<!--[if lte IE 7]>
<link href="<?php echo $this->_tpl_vars['config']['skin_path']; ?>
/styles_ie.css" rel="stylesheet" type="text/css" />
<![endif]-->

<?php $this->_tag_stack[] = array('hook', array('name' => "index:styles")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php if ($this->_tpl_vars['addons']['bundled_products']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/bundled_products/hooks/index/styles.post.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php if ($this->_tpl_vars['addons']['tags']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/tags/hooks/index/styles.post.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php if ($this->_tpl_vars['addons']['product_configurator']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/product_configurator/hooks/index/styles.post.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php if ($this->_tpl_vars['addons']['news_and_emails']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/news_and_emails/hooks/index/styles.post.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php if ($this->_tpl_vars['addons']['gift_registry']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/gift_registry/hooks/index/styles.post.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php if ($this->_tpl_vars['addons']['gift_certificates']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/gift_certificates/hooks/index/styles.post.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php if ($this->_tpl_vars['addons']['rma']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/rma/hooks/index/styles.post.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php if ($this->_tpl_vars['addons']['bestsellers']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/bestsellers/hooks/index/styles.post.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php if ($this->_tpl_vars['addons']['form_builder']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/form_builder/hooks/index/styles.post.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php if ($this->_tpl_vars['addons']['polls']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/polls/hooks/index/styles.post.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php if ($this->_tpl_vars['addons']['banners']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/banners/hooks/index/styles.post.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php if ($this->_tpl_vars['addons']['discussion']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/discussion/hooks/index/styles.post.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php if ($this->_tpl_vars['addons']['wishlist']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/wishlist/hooks/index/styles.post.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php if ($this->_tpl_vars['addons']['recurring_billing']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/recurring_billing/hooks/index/styles.post.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php if ($this->_tpl_vars['addons']['billibuys']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/billibuys/hooks/index/styles.post.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
<?php $this->_smarty_vars['capture']['styles'] = ob_get_contents(); ob_end_clean(); ?>
<?php echo smarty_function_join_css(array('content' => $this->_smarty_vars['capture']['styles']), $this);?>


<?php $this->_smarty_vars['capture']['template_content'] = ob_get_contents(); ob_end_clean(); ?><?php if (trim($this->_smarty_vars['capture']['template_content'])): ?><?php if ($this->_tpl_vars['auth']['area'] == 'A'): ?><span class="cm-template-box" template="common_templates/styles.tpl" id="<?php echo smarty_function_set_id(array('name' => "common_templates/styles.tpl"), $this);?>
"><img class="cm-template-icon hidden" src="<?php echo $this->_tpl_vars['images_dir']; ?>
/icons/layout_edit.gif" width="16" height="16" alt="" /><?php echo $this->_smarty_vars['capture']['template_content']; ?>
<!--[/tpl_id]--></span><?php else: ?><?php echo $this->_smarty_vars['capture']['template_content']; ?>
<?php endif; ?><?php endif; ?>