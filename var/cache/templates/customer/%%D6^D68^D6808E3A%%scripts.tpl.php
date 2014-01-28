<?php /* Smarty version 2.6.18, created on 2014-01-28 16:30:47
         compiled from common_templates/scripts.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'script', 'common_templates/scripts.tpl', 3, false),array('function', 'set_id', 'common_templates/scripts.tpl', 97, false),array('modifier', 'escape', 'common_templates/scripts.tpl', 14, false),array('modifier', 'defined', 'common_templates/scripts.tpl', 80, false),array('modifier', 'fn_generate_security_hash', 'common_templates/scripts.tpl', 86, false),array('modifier', 'trim', 'common_templates/scripts.tpl', 97, false),array('block', 'hook', 'common_templates/scripts.tpl', 95, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('cannot_buy','no_products_selected','error_no_items_selected','delete_confirmation','text_out_of_stock','in_stock','items','text_required_group_product','notice','warning','loading','none','text_are_you_sure_to_proceed','text_invalid_url','text_cart_changed','error_validator_email','error_validator_confirm_email','error_validator_phone','error_validator_integer','error_validator_multiple','error_validator_password','error_validator_required','error_validator_zipcode','error_validator_message','text_page_loading','view_cart','checkout','product_added_to_cart','products_added_to_cart','product_added_to_wl','product_added_to_cl','close','error','error_ajax','text_changes_not_saved','text_data_changed'));
?>
<?php ob_start(); ?>
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
<?php if ($this->_tpl_vars['addons']['bundled_products']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/bundled_products/hooks/index/scripts.post.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php if ($this->_tpl_vars['addons']['news_and_emails']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/news_and_emails/hooks/index/scripts.post.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php if ($this->_tpl_vars['addons']['reward_points']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/reward_points/hooks/index/scripts.post.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php if ($this->_tpl_vars['addons']['banners']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/banners/hooks/index/scripts.post.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php if ($this->_tpl_vars['addons']['recurring_billing']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/recurring_billing/hooks/index/scripts.post.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
<?php $this->_smarty_vars['capture']['template_content'] = ob_get_contents(); ob_end_clean(); ?><?php if (trim($this->_smarty_vars['capture']['template_content'])): ?><?php if ($this->_tpl_vars['auth']['area'] == 'A'): ?><span class="cm-template-box" template="common_templates/scripts.tpl" id="<?php echo smarty_function_set_id(array('name' => "common_templates/scripts.tpl"), $this);?>
"><img class="cm-template-icon hidden" src="<?php echo $this->_tpl_vars['images_dir']; ?>
/icons/layout_edit.gif" width="16" height="16" alt="" /><?php echo $this->_smarty_vars['capture']['template_content']; ?>
<!--[/tpl_id]--></span><?php else: ?><?php echo $this->_smarty_vars['capture']['template_content']; ?>
<?php endif; ?><?php endif; ?>