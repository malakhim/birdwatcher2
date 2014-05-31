<?php /* Smarty version 2.6.18, created on 2014-03-10 11:21:28
         compiled from views/orders/components/placing_order.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'defined', 'views/orders/components/placing_order.tpl', 41, false),array('block', 'hook', 'views/orders/components/placing_order.tpl', 51, false),array('function', 'join_css', 'views/orders/components/placing_order.tpl', 66, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('please_be_patient'));
?>
<?php  ob_start();  ?><?php 

				$rname = !empty($resource_name) ? $resource_name : $params['smarty_include_tpl_file'];
				if ($this->compile_check && empty($inline_no_check[$rname]) && $this->is_cached($rname)) {
					if ($this->check_inline_blocks(array (
  'common_templates/styles.tpl' => 1367063745,
))) {
						$_smarty_compile_path = $this->_get_compile_path($rname);
						$this->_compile_resource($rname, $_smarty_compile_path);
						$inline_no_check[$rname] = true;
						include $_smarty_compile_path;
						return;
					}
				}
			 ?><html>
<head>
<title><?php echo $this->_tpl_vars['order_action']; ?>
</title>
<?php $__parent_tpl_vars = $this->_tpl_vars; ?><?php 

				$rname = !empty($resource_name) ? $resource_name : $params['smarty_include_tpl_file'];
				if ($this->compile_check && empty($inline_no_check[$rname]) && $this->is_cached($rname)) {
					if ($this->check_inline_blocks(array (
  'addons/billibuys/hooks/index/styles.post.tpl' => 1394371154,
))) {
						$_smarty_compile_path = $this->_get_compile_path($rname);
						$this->_compile_resource($rname, $_smarty_compile_path);
						$inline_no_check[$rname] = true;
						include $_smarty_compile_path;
						return;
					}
				}
			 ?>

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

<?php $this->_tag_stack[] = array('hook', array('name' => "index:styles")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php if ($this->_tpl_vars['addons']['bundled_products']['status'] == 'A'): ?><?php $__parent_tpl_vars = $this->_tpl_vars; ?><link href="<?php echo $this->_tpl_vars['config']['skin_path']; ?>
/addons/bundled_products/styles.css" rel="stylesheet" type="text/css" />
<!--[if lte IE 7]>
<link href="<?php echo $this->_tpl_vars['config']['skin_path']; ?>
/addons/bundled_products/styles_ie.css" rel="stylesheet" type="text/css" />
<![endif]--><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php endif; ?><?php if ($this->_tpl_vars['addons']['tags']['status'] == 'A'): ?><?php $__parent_tpl_vars = $this->_tpl_vars; ?><link href="<?php echo $this->_tpl_vars['config']['skin_path']; ?>
/addons/tags/styles.css" rel="stylesheet" type="text/css" /><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php endif; ?><?php if ($this->_tpl_vars['addons']['product_configurator']['status'] == 'A'): ?><?php $__parent_tpl_vars = $this->_tpl_vars; ?><link href="<?php echo $this->_tpl_vars['config']['skin_path']; ?>
/addons/product_configurator/styles.css" rel="stylesheet" type="text/css" /><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php endif; ?><?php if ($this->_tpl_vars['addons']['news_and_emails']['status'] == 'A'): ?><?php $__parent_tpl_vars = $this->_tpl_vars; ?><link href="<?php echo $this->_tpl_vars['config']['skin_path']; ?>
/addons/news_and_emails/styles.css" rel="stylesheet" type="text/css" /><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php endif; ?><?php if ($this->_tpl_vars['addons']['gift_certificates']['status'] == 'A'): ?><?php $__parent_tpl_vars = $this->_tpl_vars; ?><link href="<?php echo $this->_tpl_vars['config']['skin_path']; ?>
/addons/gift_certificates/styles.css" rel="stylesheet" type="text/css" /><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php endif; ?><?php if ($this->_tpl_vars['addons']['rma']['status'] == 'A'): ?><?php $__parent_tpl_vars = $this->_tpl_vars; ?><link href="<?php echo $this->_tpl_vars['config']['skin_path']; ?>
/addons/rma/styles.css" rel="stylesheet" type="text/css" /><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php endif; ?><?php if ($this->_tpl_vars['addons']['bestsellers']['status'] == 'A'): ?><?php $__parent_tpl_vars = $this->_tpl_vars; ?><link href="<?php echo $this->_tpl_vars['config']['skin_path']; ?>
/addons/bestsellers/styles.css" rel="stylesheet" type="text/css" /><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php endif; ?><?php if ($this->_tpl_vars['addons']['form_builder']['status'] == 'A'): ?><?php $__parent_tpl_vars = $this->_tpl_vars; ?><link href="<?php echo $this->_tpl_vars['config']['skin_path']; ?>
/addons/form_builder/styles.css" rel="stylesheet" type="text/css" /><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php endif; ?><?php if ($this->_tpl_vars['addons']['polls']['status'] == 'A'): ?><?php $__parent_tpl_vars = $this->_tpl_vars; ?><link href="<?php echo $this->_tpl_vars['config']['skin_path']; ?>
/addons/polls/styles.css" rel="stylesheet" type="text/css" /><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php endif; ?><?php if ($this->_tpl_vars['addons']['banners']['status'] == 'A'): ?><?php $__parent_tpl_vars = $this->_tpl_vars; ?><link href="<?php echo $this->_tpl_vars['config']['skin_path']; ?>
/addons/banners/styles.css" rel="stylesheet" type="text/css" /><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php endif; ?><?php if ($this->_tpl_vars['addons']['discussion']['status'] == 'A'): ?><?php $__parent_tpl_vars = $this->_tpl_vars; ?><link href="<?php echo $this->_tpl_vars['config']['skin_path']; ?>
/addons/discussion/styles.css" rel="stylesheet" type="text/css" /><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php endif; ?><?php if ($this->_tpl_vars['addons']['wishlist']['status'] == 'A'): ?><?php $__parent_tpl_vars = $this->_tpl_vars; ?><link href="<?php echo $this->_tpl_vars['config']['skin_path']; ?>
/addons/wishlist/styles.css" rel="stylesheet" type="text/css" /><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php endif; ?><?php if ($this->_tpl_vars['addons']['recurring_billing']['status'] == 'A'): ?><?php $__parent_tpl_vars = $this->_tpl_vars; ?><link href="<?php echo $this->_tpl_vars['config']['skin_path']; ?>
/addons/recurring_billing/styles.css" rel="stylesheet" type="text/css" /><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php endif; ?><?php if ($this->_tpl_vars['addons']['billibuys']['status'] == 'A'): ?><?php $__parent_tpl_vars = $this->_tpl_vars; ?><!-- Latest compiled and minified CSS -->
<!-- <link rel="stylesheet" href="<?php echo $this->_tpl_vars['config']['skin_path']; ?>
/css/bootstrap.min.css" /> -->

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery.js"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>

<link href='http://fonts.googleapis.com/css?family=Nunito:700' rel='stylesheet' type='text/css'>
<link href="<?php echo $this->_tpl_vars['config']['skin_path']; ?>
/addons/billibuys/styles.css" rel="stylesheet" type="text/css" /><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php endif; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
<?php $this->_smarty_vars['capture']['styles'] = ob_get_contents(); ob_end_clean(); ?>
<?php echo smarty_function_join_css(array('content' => $this->_smarty_vars['capture']['styles']), $this);?>


<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
</head>

<body class="clear-body">
	<div class="order-status">
		<?php echo $this->_tpl_vars['order_action']; ?>
. <?php echo fn_get_lang_var('please_be_patient', $this->getLanguage()); ?>
...
	</div>
</body><?php  ob_end_flush();  ?>