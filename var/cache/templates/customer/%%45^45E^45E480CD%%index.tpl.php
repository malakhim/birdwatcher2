<?php /* Smarty version 2.6.18, created on 2013-08-29 15:31:50
         compiled from index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'lower', 'index.tpl', 16, false),array('modifier', 'escape', 'index.tpl', 23, false),array('modifier', 'unescape', 'index.tpl', 26, false),array('modifier', 'strip_tags', 'index.tpl', 26, false),array('modifier', 'count', 'index.tpl', 28, false),array('modifier', 'html_entity_decode', 'index.tpl', 52, false),array('modifier', 'default', 'index.tpl', 52, false),array('modifier', 'fn_seo_is_indexed_page', 'index.tpl', 54, false),array('modifier', 'sizeof', 'index.tpl', 58, false),array('modifier', 'fn_link_attach', 'index.tpl', 60, false),array('modifier', 'fn_url', 'index.tpl', 60, false),array('modifier', 'defined', 'index.tpl', 87, false),array('modifier', 'fn_generate_security_hash', 'index.tpl', 204, false),array('modifier', 'fn_query_remove', 'index.tpl', 247, false),array('modifier', 'strpos', 'index.tpl', 248, false),array('block', 'hook', 'index.tpl', 46, false),array('function', 'join_css', 'index.tpl', 102, false),array('function', 'script', 'index.tpl', 121, false),array('function', 'render_location', 'index.tpl', 289, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('cannot_buy','no_products_selected','error_no_items_selected','delete_confirmation','text_out_of_stock','in_stock','items','text_required_group_product','notice','warning','loading','none','text_are_you_sure_to_proceed','text_invalid_url','text_cart_changed','error_validator_email','error_validator_confirm_email','error_validator_phone','error_validator_integer','error_validator_multiple','error_validator_password','error_validator_required','error_validator_zipcode','error_validator_message','text_page_loading','view_cart','checkout','product_added_to_cart','products_added_to_cart','product_added_to_wl','product_added_to_cl','close','error','error_ajax','text_changes_not_saved','text_data_changed','bundled_products_fill_the_mandatory_fields','loading','customization_mode','translate_mode','switch_to_translation_mode','switch_to_customization_mode'));
?>
<?php 

				$rname = !empty($resource_name) ? $resource_name : $params['smarty_include_tpl_file'];
				if ($this->compile_check && empty($inline_no_check[$rname]) && $this->is_cached($rname)) {
					if ($this->check_inline_blocks(array (
  'addons/google_analytics/hooks/index/footer.post.tpl' => 1367063834,
))) {
						$_smarty_compile_path = $this->_get_compile_path($rname);
						$this->_compile_resource($rname, $_smarty_compile_path);
						$inline_no_check[$rname] = true;
						include $_smarty_compile_path;
						return;
					}
				}
			 ?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="<?php echo smarty_modifier_lower(@CART_LANGUAGE); ?>
">
<head>

<?php echo '<title>'; ?><?php if ($this->_tpl_vars['page_title']): ?><?php echo ''; ?><?php echo smarty_modifier_escape($this->_tpl_vars['page_title'], 'html'); ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php $_from = $this->_tpl_vars['breadcrumbs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['bkt'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['bkt']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['i']):
        $this->_foreach['bkt']['iteration']++;
?><?php echo ''; ?><?php if (! ($this->_foreach['bkt']['iteration'] <= 1)): ?><?php echo ''; ?><?php echo smarty_modifier_escape(smarty_modifier_strip_tags(smarty_modifier_unescape($this->_tpl_vars['i']['title'])), 'html'); ?><?php echo ''; ?><?php if (! ($this->_foreach['bkt']['iteration'] == $this->_foreach['bkt']['total'])): ?><?php echo ' :: '; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php endforeach; endif; unset($_from); ?><?php echo ''; ?><?php if (! $this->_tpl_vars['skip_page_title']): ?><?php echo ''; ?><?php if (count($this->_tpl_vars['breadcrumbs']) > 1): ?><?php echo ' - '; ?><?php endif; ?><?php echo ''; ?><?php echo smarty_modifier_escape($this->_tpl_vars['location_data']['title'], 'html'); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo '</title>'; ?>

<?php $__parent_tpl_vars = $this->_tpl_vars; ?><?php 

				$rname = !empty($resource_name) ? $resource_name : $params['smarty_include_tpl_file'];
				if ($this->compile_check && empty($inline_no_check[$rname]) && $this->is_cached($rname)) {
					if ($this->check_inline_blocks(array (
  'addons/seo/hooks/index/meta.post.tpl' => 1367063841,
))) {
						$_smarty_compile_path = $this->_get_compile_path($rname);
						$this->_compile_resource($rname, $_smarty_compile_path);
						$inline_no_check[$rname] = true;
						include $_smarty_compile_path;
						return;
					}
				}
			 ?><?php $this->_tag_stack[] = array('hook', array('name' => "index:meta")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
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
<?php if ($this->_tpl_vars['addons']['seo']['status'] == 'A'): ?><?php $__parent_tpl_vars = $this->_tpl_vars; ?><?php if (! smarty_modifier_fn_seo_is_indexed_page($this->_tpl_vars['_REQUEST'])): ?>
<meta name="robots" content="noindex<?php if (@HTTPS === true): ?>,nofollow<?php endif; ?>" />
<?php endif; ?>

<?php if (sizeof($this->_tpl_vars['languages']) > 1): ?>
<?php $_from = $this->_tpl_vars['languages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['language']):
?>
<link title="<?php echo $this->_tpl_vars['language']['name']; ?>
" dir="rtl" type="text/html" rel="alternate" charset="<?php echo @CHARSET; ?>
" hreflang="<?php echo smarty_modifier_lower($this->_tpl_vars['language']['lang_code']); ?>
" href="<?php echo fn_url(fn_link_attach($this->_tpl_vars['config']['current_url'], "sl=".($this->_tpl_vars['language']['lang_code']))); ?>
" />
<?php endforeach; endif; unset($_from); ?>
<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php endif; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
<link href="<?php echo $this->_tpl_vars['images_dir']; ?>
/icons/favicon.ico" rel="shortcut icon" />
<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('include_dropdown' => true, )); ?><?php 

				$rname = !empty($resource_name) ? $resource_name : $params['smarty_include_tpl_file'];
				if ($this->compile_check && empty($inline_no_check[$rname]) && $this->is_cached($rname)) {
					if ($this->check_inline_blocks(array (
  'addons/recurring_billing/hooks/index/styles.post.tpl' => 1367063839,
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
/addons/news_and_emails/styles.css" rel="stylesheet" type="text/css" /><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php endif; ?><?php if ($this->_tpl_vars['addons']['gift_registry']['status'] == 'A'): ?><?php $__parent_tpl_vars = $this->_tpl_vars; ?><link href="<?php echo $this->_tpl_vars['config']['skin_path']; ?>
/addons/gift_registry/styles.css" rel="stylesheet" type="text/css" /><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php endif; ?><?php if ($this->_tpl_vars['addons']['gift_certificates']['status'] == 'A'): ?><?php $__parent_tpl_vars = $this->_tpl_vars; ?><link href="<?php echo $this->_tpl_vars['config']['skin_path']; ?>
/addons/gift_certificates/styles.css" rel="stylesheet" type="text/css" /><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php endif; ?><?php if ($this->_tpl_vars['addons']['rma']['status'] == 'A'): ?><?php $__parent_tpl_vars = $this->_tpl_vars; ?><link href="<?php echo $this->_tpl_vars['config']['skin_path']; ?>
/addons/rma/styles.css" rel="stylesheet" type="text/css" /><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php endif; ?><?php if ($this->_tpl_vars['addons']['bestsellers']['status'] == 'A'): ?><?php $__parent_tpl_vars = $this->_tpl_vars; ?><link href="<?php echo $this->_tpl_vars['config']['skin_path']; ?>
/addons/bestsellers/styles.css" rel="stylesheet" type="text/css" /><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php endif; ?><?php if ($this->_tpl_vars['addons']['form_builder']['status'] == 'A'): ?><?php $__parent_tpl_vars = $this->_tpl_vars; ?><link href="<?php echo $this->_tpl_vars['config']['skin_path']; ?>
/addons/form_builder/styles.css" rel="stylesheet" type="text/css" /><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php endif; ?><?php if ($this->_tpl_vars['addons']['polls']['status'] == 'A'): ?><?php $__parent_tpl_vars = $this->_tpl_vars; ?><link href="<?php echo $this->_tpl_vars['config']['skin_path']; ?>
/addons/polls/styles.css" rel="stylesheet" type="text/css" /><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php endif; ?><?php if ($this->_tpl_vars['addons']['banners']['status'] == 'A'): ?><?php $__parent_tpl_vars = $this->_tpl_vars; ?><link href="<?php echo $this->_tpl_vars['config']['skin_path']; ?>
/addons/banners/styles.css" rel="stylesheet" type="text/css" /><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php endif; ?><?php if ($this->_tpl_vars['addons']['discussion']['status'] == 'A'): ?><?php $__parent_tpl_vars = $this->_tpl_vars; ?><link href="<?php echo $this->_tpl_vars['config']['skin_path']; ?>
/addons/discussion/styles.css" rel="stylesheet" type="text/css" /><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php endif; ?><?php if ($this->_tpl_vars['addons']['wishlist']['status'] == 'A'): ?><?php $__parent_tpl_vars = $this->_tpl_vars; ?><link href="<?php echo $this->_tpl_vars['config']['skin_path']; ?>
/addons/wishlist/styles.css" rel="stylesheet" type="text/css" /><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php endif; ?><?php if ($this->_tpl_vars['addons']['recurring_billing']['status'] == 'A'): ?><?php $__parent_tpl_vars = $this->_tpl_vars; ?><link href="<?php echo $this->_tpl_vars['config']['skin_path']; ?>
/addons/recurring_billing/styles.css" rel="stylesheet" type="text/css" /><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php endif; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
<?php $this->_smarty_vars['capture']['styles'] = ob_get_contents(); ob_end_clean(); ?>
<?php echo smarty_function_join_css(array('content' => $this->_smarty_vars['capture']['styles']), $this);?>


<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
<?php $__parent_tpl_vars = $this->_tpl_vars; ?><?php 

				$rname = !empty($resource_name) ? $resource_name : $params['smarty_include_tpl_file'];
				if ($this->compile_check && empty($inline_no_check[$rname]) && $this->is_cached($rname)) {
					if ($this->check_inline_blocks(array (
  'addons/recurring_billing/hooks/index/scripts.post.tpl' => 1367063839,
))) {
						$_smarty_compile_path = $this->_get_compile_path($rname);
						$this->_compile_resource($rname, $_smarty_compile_path);
						$inline_no_check[$rname] = true;
						include $_smarty_compile_path;
						return;
					}
				}
			 ?>

<?php echo smarty_function_script(array('src' => "lib/js/jquery/jquery.min.js"), $this);?>

<?php echo smarty_function_script(array('src' => "lib/js/jqueryui/jquery-ui.custom.min.js"), $this);?>

<?php echo smarty_function_script(array('src' => "lib/js/tools/tooltip.min.js"), $this);?>

<?php echo smarty_function_script(array('src' => "lib/js/appear/jquery.appear-1.1.1.js"), $this);?>


<?php echo smarty_function_script(array('src' => "js/editors/".($this->_tpl_vars['settings']['Appearance']['default_wysiwyg_editor']).".editor.js"), $this);?>


<?php echo smarty_function_script(array('src' => "js/core.js"), $this);?>

<?php echo smarty_function_script(array('src' => "js/ajax.js"), $this);?>

<script type="text/javascript">
//<![CDATA[
var index_script = '<?php echo smarty_modifier_escape($this->_tpl_vars['index_script'], 'javascript'); ?>
';
var current_path = '<?php echo smarty_modifier_escape($this->_tpl_vars['config']['current_path'], 'javascript'); ?>
';
var changes_warning = '<?php echo smarty_modifier_escape($this->_tpl_vars['settings']['Appearance']['changes_warning'], 'javascript'); ?>
';

var lang = <?php echo $this->_tpl_vars['ldelim']; ?>

	cannot_buy: '<?php echo smarty_modifier_escape(fn_get_lang_var('cannot_buy', $this->getLanguage()), 'javascript'); ?>
',
	no_products_selected: '<?php echo smarty_modifier_escape(fn_get_lang_var('no_products_selected', $this->getLanguage()), 'javascript'); ?>
',
	error_no_items_selected: '<?php echo smarty_modifier_escape(fn_get_lang_var('error_no_items_selected', $this->getLanguage()), 'javascript'); ?>
',
	delete_confirmation: '<?php echo smarty_modifier_escape(fn_get_lang_var('delete_confirmation', $this->getLanguage()), 'javascript'); ?>
',
	text_out_of_stock: '<?php echo smarty_modifier_escape(fn_get_lang_var('text_out_of_stock', $this->getLanguage()), 'javascript'); ?>
',
	in_stock: '<?php echo smarty_modifier_escape(fn_get_lang_var('in_stock', $this->getLanguage()), 'javascript'); ?>
',
	items: '<?php echo smarty_modifier_escape(fn_get_lang_var('items', $this->getLanguage()), 'javascript'); ?>
',
	text_required_group_product: '<?php echo smarty_modifier_escape(fn_get_lang_var('text_required_group_product', $this->getLanguage()), 'javascript'); ?>
',
	notice: '<?php echo smarty_modifier_escape(fn_get_lang_var('notice', $this->getLanguage()), 'javascript'); ?>
',
	warning: '<?php echo smarty_modifier_escape(fn_get_lang_var('warning', $this->getLanguage()), 'javascript'); ?>
',
	loading: '<?php echo smarty_modifier_escape(fn_get_lang_var('loading', $this->getLanguage()), 'javascript'); ?>
',
	none: '<?php echo smarty_modifier_escape(fn_get_lang_var('none', $this->getLanguage()), 'javascript'); ?>
',
	text_are_you_sure_to_proceed: '<?php echo smarty_modifier_escape(fn_get_lang_var('text_are_you_sure_to_proceed', $this->getLanguage()), 'javascript'); ?>
',
	text_invalid_url: '<?php echo smarty_modifier_escape(fn_get_lang_var('text_invalid_url', $this->getLanguage()), 'javascript'); ?>
',
	text_cart_changed: '<?php echo smarty_modifier_escape(fn_get_lang_var('text_cart_changed', $this->getLanguage()), 'javascript'); ?>
',
	error_validator_email: '<?php echo smarty_modifier_escape(fn_get_lang_var('error_validator_email', $this->getLanguage()), 'javascript'); ?>
',
	error_validator_confirm_email: '<?php echo smarty_modifier_escape(fn_get_lang_var('error_validator_confirm_email', $this->getLanguage()), 'javascript'); ?>
',
	error_validator_phone: '<?php echo smarty_modifier_escape(fn_get_lang_var('error_validator_phone', $this->getLanguage()), 'javascript'); ?>
',
	error_validator_integer: '<?php echo smarty_modifier_escape(fn_get_lang_var('error_validator_integer', $this->getLanguage()), 'javascript'); ?>
',
	error_validator_multiple: '<?php echo smarty_modifier_escape(fn_get_lang_var('error_validator_multiple', $this->getLanguage()), 'javascript'); ?>
',
	error_validator_password: '<?php echo smarty_modifier_escape(fn_get_lang_var('error_validator_password', $this->getLanguage()), 'javascript'); ?>
',
	error_validator_required: '<?php echo smarty_modifier_escape(fn_get_lang_var('error_validator_required', $this->getLanguage()), 'javascript'); ?>
',
	error_validator_zipcode: '<?php echo smarty_modifier_escape(fn_get_lang_var('error_validator_zipcode', $this->getLanguage()), 'javascript'); ?>
',
	error_validator_message: '<?php echo smarty_modifier_escape(fn_get_lang_var('error_validator_message', $this->getLanguage()), 'javascript'); ?>
',
	text_page_loading: '<?php echo smarty_modifier_escape(fn_get_lang_var('text_page_loading', $this->getLanguage()), 'javascript'); ?>
',
	view_cart: '<?php echo smarty_modifier_escape(fn_get_lang_var('view_cart', $this->getLanguage()), 'javascript'); ?>
',
	checkout: '<?php echo smarty_modifier_escape(fn_get_lang_var('checkout', $this->getLanguage()), 'javascript'); ?>
',
	product_added_to_cart: '<?php echo smarty_modifier_escape(fn_get_lang_var('product_added_to_cart', $this->getLanguage()), 'javascript'); ?>
',
	products_added_to_cart: '<?php echo smarty_modifier_escape(fn_get_lang_var('products_added_to_cart', $this->getLanguage()), 'javascript'); ?>
',
	product_added_to_wl: '<?php echo smarty_modifier_escape(fn_get_lang_var('product_added_to_wl', $this->getLanguage()), 'javascript'); ?>
',
	product_added_to_cl: '<?php echo smarty_modifier_escape(fn_get_lang_var('product_added_to_cl', $this->getLanguage()), 'javascript'); ?>
',
	close: '<?php echo smarty_modifier_escape(fn_get_lang_var('close', $this->getLanguage()), 'javascript'); ?>
',
	error: '<?php echo smarty_modifier_escape(fn_get_lang_var('error', $this->getLanguage()), 'javascript'); ?>
',
	error_ajax: '<?php echo smarty_modifier_escape(fn_get_lang_var('error_ajax', $this->getLanguage()), 'javascript'); ?>
',
	text_changes_not_saved: '<?php echo smarty_modifier_escape(fn_get_lang_var('text_changes_not_saved', $this->getLanguage()), 'javascript'); ?>
',
	text_data_changed: '<?php echo smarty_modifier_escape(fn_get_lang_var('text_data_changed', $this->getLanguage()), 'javascript'); ?>
'
<?php echo $this->_tpl_vars['rdelim']; ?>


var currencies = <?php echo $this->_tpl_vars['ldelim']; ?>

	'primary': <?php echo $this->_tpl_vars['ldelim']; ?>

		'decimals_separator': '<?php echo smarty_modifier_escape($this->_tpl_vars['currencies'][$this->_tpl_vars['primary_currency']]['decimals_separator'], 'javascript'); ?>
',
		'thousands_separator': '<?php echo smarty_modifier_escape($this->_tpl_vars['currencies'][$this->_tpl_vars['primary_currency']]['thousands_separator'], 'javascript'); ?>
',
		'decimals': '<?php echo smarty_modifier_escape($this->_tpl_vars['currencies'][$this->_tpl_vars['primary_currency']]['decimals'], 'javascript'); ?>
',
		'coefficient': '<?php echo smarty_modifier_escape($this->_tpl_vars['currencies'][$this->_tpl_vars['primary_currency']]['coefficient'], 'javascript'); ?>
'
	<?php echo $this->_tpl_vars['rdelim']; ?>
,
	'secondary': <?php echo $this->_tpl_vars['ldelim']; ?>

		'decimals_separator': '<?php echo smarty_modifier_escape($this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']]['decimals_separator'], 'javascript'); ?>
',
		'thousands_separator': '<?php echo smarty_modifier_escape($this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']]['thousands_separator'], 'javascript'); ?>
',
		'decimals': '<?php echo smarty_modifier_escape($this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']]['decimals'], 'javascript'); ?>
',
		'coefficient': '<?php echo $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']]['coefficient']; ?>
'
	<?php echo $this->_tpl_vars['rdelim']; ?>

<?php echo $this->_tpl_vars['rdelim']; ?>
;

var default_editor = '<?php echo $this->_tpl_vars['settings']['Appearance']['default_wysiwyg_editor']; ?>
';
var default_previewer = '<?php echo $this->_tpl_vars['settings']['Appearance']['default_image_previewer']; ?>
';

var cart_language = '<?php echo @CART_LANGUAGE; ?>
';
var default_language = '<?php echo @DEFAULT_LANGUAGE; ?>
';
var images_dir = '<?php echo $this->_tpl_vars['images_dir']; ?>
';
var skin_name = '<?php echo $this->_tpl_vars['settings']['skin_name_customer']; ?>
';
var notice_displaying_time = <?php if ($this->_tpl_vars['settings']['Appearance']['notice_displaying_time']): ?><?php echo $this->_tpl_vars['settings']['Appearance']['notice_displaying_time']; ?>
<?php else: ?>0<?php endif; ?>;
var cart_prices_w_taxes = <?php if (( $this->_tpl_vars['settings']['Appearance']['cart_prices_w_taxes'] == 'Y' && defined('CHECKOUT') ) || ( $this->_tpl_vars['settings']['Appearance']['show_prices_taxed_clean'] == 'Y' && ! defined('CHECKOUT') )): ?>true<?php else: ?>false<?php endif; ?>;
var translate_mode = <?php if (defined('TRANSLATION_MODE')): ?>true<?php else: ?>false<?php endif; ?>;
var regexp = new Array();

<?php if ($this->_tpl_vars['config']['tweaks']['anti_csrf']): ?>
	// CSRF form protection key
	var security_hash = '<?php echo fn_generate_security_hash(""); ?>
';
<?php endif; ?>


$(function()<?php echo $this->_tpl_vars['ldelim']; ?>

	$.runCart('C');
<?php echo $this->_tpl_vars['rdelim']; ?>
);
//]]>
</script>
<?php $this->_tag_stack[] = array('hook', array('name' => "index:scripts")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
<?php if ($this->_tpl_vars['addons']['bundled_products']['status'] == 'A'): ?><?php $__parent_tpl_vars = $this->_tpl_vars; ?><?php echo smarty_function_script(array('src' => "addons/bundled_products/js/func.js"), $this);?>


<script type="text/javascript">
//<![CDATA[
	lang['bundled_products_fill_the_mandatory_fields'] = '<?php echo fn_get_lang_var('bundled_products_fill_the_mandatory_fields', $this->getLanguage()); ?>
';
//]]>
</script><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php endif; ?><?php if ($this->_tpl_vars['addons']['news_and_emails']['status'] == 'A'): ?><?php $__parent_tpl_vars = $this->_tpl_vars; ?><?php echo smarty_function_script(array('src' => "addons/news_and_emails/js/func.js"), $this);?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php endif; ?><?php if ($this->_tpl_vars['addons']['reward_points']['status'] == 'A'): ?><?php $__parent_tpl_vars = $this->_tpl_vars; ?><?php echo smarty_function_script(array('src' => "addons/reward_points/js/func.js"), $this);?>

<script type="text/javascript">
//<![CDATA[
var price_in_points_with_discounts = '<?php echo $this->_tpl_vars['addons']['reward_points']['price_in_points_with_discounts']; ?>
';
var points_with_discounts = '<?php echo $this->_tpl_vars['addons']['reward_points']['points_with_discounts']; ?>
';

// Extend core function
fn_register_hooks('reward_points', ['check_exceptions']);

//]]>
</script><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php endif; ?><?php if ($this->_tpl_vars['addons']['banners']['status'] == 'A'): ?><?php $__parent_tpl_vars = $this->_tpl_vars; ?><?php echo smarty_function_script(array('src' => "addons/banners/js/slider.js"), $this);?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php endif; ?><?php if ($this->_tpl_vars['addons']['recurring_billing']['status'] == 'A'): ?><?php $__parent_tpl_vars = $this->_tpl_vars; ?><?php if (@CONTROLLER != 'checkout'): ?>
<?php echo smarty_function_script(array('src' => "addons/recurring_billing/js/func.js"), $this);?>

<script type="text/javascript">

// Extend core function
fn_register_hooks('recurring_billing', ['check_exceptions']);

</script>
<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php endif; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
</head>

<body>
<?php if (defined('SKINS_PANEL')): ?>
<?php $__parent_tpl_vars = $this->_tpl_vars; ?><?php $this->assign('area', @AREA, false); ?>
<?php $this->assign('area_name', @AREA_NAME, false); ?>
<?php $this->assign('l', "text_".($this->_tpl_vars['area_name'])."_skin", false); ?>
<?php $this->assign('c_url', fn_url(fn_query_remove($this->_tpl_vars['config']['current_url'], 'demo_skin')), false); ?>
<?php if (strpos($this->_tpl_vars['c_url'], "?") === false): ?>
	<?php $this->assign('c_url', ($this->_tpl_vars['c_url'])."?", false); ?>
<?php endif; ?>

<ul class="demo-site-panel clearfix">
	<li class="dp-title">DEMO SITE PANEL</li>
	<li class="dp-label"><?php echo fn_get_lang_var($this->_tpl_vars['l'], $this->getLanguage()); ?>
:</li>
	<li>
		<select name="demo_skin[<?php echo $this->_tpl_vars['area']; ?>
]" onchange="$.redirect('<?php echo fn_link_attach($this->_tpl_vars['c_url'], "demo_skin[".($this->_tpl_vars['area'])."]="); ?>
' + this.value);">
		<?php $_from = $this->_tpl_vars['demo_skin']['available_skins']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['s']):
?>
			<option value="<?php echo $this->_tpl_vars['k']; ?>
" <?php if ($this->_tpl_vars['demo_skin']['selected'][$this->_tpl_vars['area']] == $this->_tpl_vars['k']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['s']['description']; ?>
</option>
		<?php endforeach; endif; unset($_from); ?>
		</select>
	</li>
	<li class="dp-area">
		
		<select name="area" onchange="$.redirect(this.value);">
			<option value="<?php echo $this->_tpl_vars['config']['admin_index']; ?>
" <?php if ($this->_tpl_vars['area'] == 'A'): ?>selected="selected"<?php endif; ?>>Administration panel</option>
			<option value="<?php echo $this->_tpl_vars['config']['customer_index']; ?>
" <?php if ($this->_tpl_vars['area'] == 'C'): ?>selected="selected"<?php endif; ?>>Storefront</option>
		</select>
		
		

	</li>
	<li class="dp-area dp-label">Area:</li>
</ul><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
<?php endif; ?>
<div class="helper-container">
	<a name="top"></a>	


	<?php echo smarty_function_render_location(array(), $this);?>

	<?php $__parent_tpl_vars = $this->_tpl_vars; ?>

<div id="ajax_loading_box" class="ajax-loading-box"><div id="ajax_loading_message" class="ajax-inner-loading-box"><?php echo fn_get_lang_var('loading', $this->getLanguage()); ?>
</div></div>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
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
		<?php $__parent_tpl_vars = $this->_tpl_vars; ?><div id="design_mode_panel" class="popup <?php if (defined('CUSTOMIZATION_MODE')): ?>customization<?php else: ?>translate<?php endif; ?>-mode" style="<?php if ($_COOKIE['design_mode_panel_offset']): ?><?php echo $_COOKIE['design_mode_panel_offset']; ?>
<?php endif; ?>">
	<div>
		<h1><?php if (defined('CUSTOMIZATION_MODE')): ?><?php echo fn_get_lang_var('customization_mode', $this->getLanguage()); ?>
<?php else: ?><?php echo fn_get_lang_var('translate_mode', $this->getLanguage()); ?>
<?php endif; ?></h1>
	</div>
	<div>
		<form action="<?php echo fn_url(""); ?>
" method="post" name="design_mode_panel_form">
			<input type="hidden" name="design_mode" value="<?php if (defined('CUSTOMIZATION_MODE')): ?>translation_mode<?php else: ?>customization_mode<?php endif; ?>" />
			<input type="hidden" name="current_url" value="<?php echo $this->_tpl_vars['config']['current_url']; ?>
" />
			<input type="submit" name="dispatch[design_mode.update_design_mode]" value="" class="hidden" />
			<?php if (defined('CUSTOMIZATION_MODE')): ?>
				<?php $this->assign('mode_val', fn_get_lang_var('switch_to_translation_mode', $this->getLanguage()), false); ?>
			<?php else: ?>
				<?php $this->assign('mode_val', fn_get_lang_var('switch_to_customization_mode', $this->getLanguage()), false); ?>
			<?php endif; ?>
			<p class="right"><a class="cm-submit" name="dispatch[design_mode.update_design_mode]" rev="design_mode_panel_form"><?php echo $this->_tpl_vars['mode_val']; ?>
</a></p>
		</form>
	</div>
</div><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
	<?php endif; ?>
</div>

<?php $this->_tag_stack[] = array('hook', array('name' => "index:footer")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php if ($this->_tpl_vars['addons']['statistics']['status'] == 'A'): ?><?php $__parent_tpl_vars = $this->_tpl_vars; ?><script type="text/javascript">
//<![CDATA[
$(function()<?php echo $this->_tpl_vars['ldelim']; ?>

	$.ajaxRequest('<?php echo fn_url("statistics.collect", 'C', 'rel', '&'); ?>
', <?php echo $this->_tpl_vars['ldelim']; ?>

		method: 'post',
		data: <?php echo $this->_tpl_vars['ldelim']; ?>

			've[url]': location.href,
			've[title]': document.title,
			've[browser_version]': $.ua.version,
			've[browser]': $.ua.browser,
			've[os]': $.ua.os,
			've[client_language]': $.ua.language,
			've[referrer]': document.referrer,
			've[screen_x]': (screen.width || null),
			've[screen_y]': (screen.height || null),
			've[color]': (screen.colorDepth || screen.pixelDepth || null),
			've[time_begin]': <?php echo @MICROTIME; ?>

		<?php echo $this->_tpl_vars['rdelim']; ?>
,
		hidden: true
	<?php echo $this->_tpl_vars['rdelim']; ?>
);
<?php echo $this->_tpl_vars['rdelim']; ?>
);
//]]>
</script>

<noscript>
<?php ob_start(); ?>statistics.collect?ve[url]=<?php echo smarty_modifier_escape(@REAL_URL, 'url'); ?>
&amp;ve[title]=<?php if ($this->_tpl_vars['page_title']): ?><?php echo smarty_modifier_escape($this->_tpl_vars['page_title'], 'url'); ?>
<?php else: ?><?php echo smarty_modifier_escape($this->_tpl_vars['location_data']['page_title'], 'url'); ?>
<?php $_from = $this->_tpl_vars['breadcrumbs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['bkt'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['bkt']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['i']):
        $this->_foreach['bkt']['iteration']++;
?><?php if (($this->_foreach['bkt']['iteration']-1) == 1): ?> - <?php endif; ?><?php if (! ($this->_foreach['bkt']['iteration'] <= 1)): ?><?php echo smarty_modifier_escape($this->_tpl_vars['i']['title'], 'url'); ?>
<?php if (! ($this->_foreach['bkt']['iteration'] == $this->_foreach['bkt']['total'])): ?> :: <?php endif; ?><?php endif; ?><?php endforeach; endif; unset($_from); ?><?php endif; ?>&amp;ve[referrer]=<?php echo smarty_modifier_escape($_SERVER['HTTP_REFERER'], 'url'); ?>
&amp;ve[time_begin]=<?php echo @MICROTIME; ?>
<?php $this->_smarty_vars['capture']['statistics_link'] = ob_get_contents(); ob_end_clean(); ?>
<object data="<?php echo fn_url($this->_smarty_vars['capture']['statistics_link']); ?>
" width="0" height="0"></object>
</noscript><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php endif; ?><?php if ($this->_tpl_vars['addons']['google_analytics']['status'] == 'A'): ?><?php $__parent_tpl_vars = $this->_tpl_vars; ?><script type="text/javascript">
//<![CDATA[
	var _gaq = _gaq || [];
	_gaq.push(["_setAccount", "<?php echo $this->_tpl_vars['addons']['google_analytics']['tracking_code']; ?>
"]);
	_gaq.push(["_trackPageview"]);
	
	(function() <?php echo $this->_tpl_vars['ldelim']; ?>

		var ga = document.createElement("script");
		ga.src = ("https:" == document.location.protocol ? "https://ssl" : "http://www") + ".google-analytics.com/ga.js";
		ga.setAttribute("async", "true");
		document.documentElement.firstChild.appendChild(ga);
	<?php echo $this->_tpl_vars['rdelim']; ?>
)();
//]]>
</script><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php endif; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

</body>

</html>