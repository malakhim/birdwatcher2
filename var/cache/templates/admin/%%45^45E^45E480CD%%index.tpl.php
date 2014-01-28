<?php /* Smarty version 2.6.18, created on 2014-01-28 16:30:42
         compiled from index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'defined', 'index.tpl', 38, false),array('modifier', 'escape', 'index.tpl', 76, false),array('modifier', 'fn_generate_security_hash', 'index.tpl', 155, false),array('modifier', 'fn_query_remove', 'index.tpl', 198, false),array('modifier', 'fn_url', 'index.tpl', 198, false),array('modifier', 'strpos', 'index.tpl', 199, false),array('modifier', 'fn_link_attach', 'index.tpl', 207, false),array('modifier', 'fn_get_notifications', 'index.tpl', 231, false),array('modifier', 'lower', 'index.tpl', 233, false),array('modifier', 'default', 'index.tpl', 265, false),array('modifier', 'unescape', 'index.tpl', 265, false),array('block', 'hook', 'index.tpl', 45, false),array('function', 'join_css', 'index.tpl', 48, false),array('function', 'script', 'index.tpl', 63, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('admin_panel','cannot_buy','no_products_selected','error_no_items_selected','delete_confirmation','text_out_of_stock','items','text_required_group_product','save','close','loading','notice','warning','error','text_are_you_sure_to_proceed','text_invalid_url','error_validator_email','error_validator_confirm_email','error_validator_phone','error_validator_integer','error_validator_multiple','error_validator_password','error_validator_required','error_validator_zipcode','error_validator_message','text_page_loading','error_ajax','text_changes_not_saved','text_data_changed','text_block_trial_notice','text_expired_license','file_browser','editing_block','editing_grid','editing_container','adding_grid','adding_block_to_grid','manage_blocks','editing_block','add_block','loading','close','close','processing'));
?>
<?php 

				$rname = !empty($resource_name) ? $resource_name : $params['smarty_include_tpl_file'];
				if ($this->compile_check && empty($inline_no_check[$rname]) && $this->is_cached($rname)) {
					if ($this->check_inline_blocks(array (
  'common_templates/comet.tpl' => 1367063753,
))) {
						$_smarty_compile_path = $this->_get_compile_path($rname);
						$this->_compile_resource($rname, $_smarty_compile_path);
						$inline_no_check[$rname] = true;
						include $_smarty_compile_path;
						return;
					}
				}
			 ?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<?php $__parent_tpl_vars = $this->_tpl_vars; ?><meta http-equiv="Content-Type" content="text/html; charset=<?php echo @CHARSET; ?>
" />
<meta name="robots" content="noindex" />
<meta name="robots" content="nofollow" /><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
<?php echo '<title>'; ?><?php if ($this->_tpl_vars['page_title']): ?><?php echo ''; ?><?php echo $this->_tpl_vars['page_title']; ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php if ($this->_tpl_vars['navigation']['selected_tab']): ?><?php echo ''; ?><?php echo fn_get_lang_var($this->_tpl_vars['navigation']['selected_tab'], $this->getLanguage()); ?><?php echo ''; ?><?php if ($this->_tpl_vars['navigation']['subsection']): ?><?php echo ' :: '; ?><?php echo fn_get_lang_var($this->_tpl_vars['navigation']['subsection'], $this->getLanguage()); ?><?php echo ''; ?><?php endif; ?><?php echo ' - '; ?><?php endif; ?><?php echo ''; ?><?php echo fn_get_lang_var('admin_panel', $this->getLanguage()); ?><?php echo ''; ?><?php endif; ?><?php echo '</title>'; ?>


<link href="<?php echo $this->_tpl_vars['images_dir']; ?>
/icons/favicon.ico" rel="shortcut icon" />
<?php $__parent_tpl_vars = $this->_tpl_vars; ?><?php ob_start(); ?>

<link href="<?php echo $this->_tpl_vars['config']['skin_path']; ?>
/css/ui/jqueryui.css" rel="stylesheet" type="text/css"/>

<link href="<?php echo $this->_tpl_vars['config']['skin_path']; ?>
/styles.css" rel="stylesheet" type="text/css" />
<?php if (defined('TRANSLATION_MODE') || defined('CUSTOMIZATION_MODE')): ?>
<link href="<?php echo $this->_tpl_vars['config']['skin_path']; ?>
/design_mode.css" rel="stylesheet" type="text/css" />
<?php endif; ?>
<!--[if lte IE 7]>
<link href="<?php echo $this->_tpl_vars['config']['skin_path']; ?>
/styles_ie.css" rel="stylesheet" type="text/css" />
<![endif]-->

<?php $this->_tag_stack[] = array('hook', array('name' => "index:styles")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

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
			 ?><?php echo smarty_function_script(array('src' => "lib/js/jquery/jquery.min.js"), $this);?>

<?php echo smarty_function_script(array('src' => "lib/js/jqueryui/jquery-ui.custom.min.js"), $this);?>


<?php echo smarty_function_script(array('src' => "lib/js/appear/jquery.appear-1.1.1.js"), $this);?>

<?php echo smarty_function_script(array('src' => "lib/js/tools/tooltip.min.js"), $this);?>


<?php echo smarty_function_script(array('src' => "js/editors/".($this->_tpl_vars['settings']['Appearance']['default_wysiwyg_editor']).".editor.js"), $this);?>


<?php echo smarty_function_script(array('src' => "js/core.js"), $this);?>

<?php echo smarty_function_script(array('src' => "js/ajax.js"), $this);?>


<script type="text/javascript">
//<![CDATA[
	var index_script = '<?php echo smarty_modifier_escape($this->_tpl_vars['index_script'], 'javascript'); ?>
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
		items: '<?php echo smarty_modifier_escape(fn_get_lang_var('items', $this->getLanguage()), 'javascript'); ?>
',
		text_required_group_product: '<?php echo smarty_modifier_escape(fn_get_lang_var('text_required_group_product', $this->getLanguage()), 'javascript'); ?>
',
		save: '<?php echo smarty_modifier_escape(fn_get_lang_var('save', $this->getLanguage()), 'javascript'); ?>
',
		close: '<?php echo smarty_modifier_escape(fn_get_lang_var('close', $this->getLanguage()), 'javascript'); ?>
',
		loading: '<?php echo smarty_modifier_escape(fn_get_lang_var('loading', $this->getLanguage()), 'javascript'); ?>
',
		notice: '<?php echo smarty_modifier_escape(fn_get_lang_var('notice', $this->getLanguage()), 'javascript'); ?>
',
		warning: '<?php echo smarty_modifier_escape(fn_get_lang_var('warning', $this->getLanguage()), 'javascript'); ?>
',
		error: '<?php echo smarty_modifier_escape(fn_get_lang_var('error', $this->getLanguage()), 'javascript'); ?>
',
		text_are_you_sure_to_proceed: '<?php echo smarty_modifier_escape(fn_get_lang_var('text_are_you_sure_to_proceed', $this->getLanguage()), 'javascript'); ?>
',
		text_invalid_url: '<?php echo smarty_modifier_escape(fn_get_lang_var('text_invalid_url', $this->getLanguage()), 'javascript'); ?>
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
		error_ajax: '<?php echo smarty_modifier_escape(fn_get_lang_var('error_ajax', $this->getLanguage()), 'javascript'); ?>
',
		text_changes_not_saved: '<?php echo smarty_modifier_escape(fn_get_lang_var('text_changes_not_saved', $this->getLanguage()), 'javascript'); ?>
',
		text_data_changed: '<?php echo smarty_modifier_escape(fn_get_lang_var('text_data_changed', $this->getLanguage()), 'javascript'); ?>
',
		trial_notice: '<?php echo smarty_modifier_escape(fn_get_lang_var('text_block_trial_notice', $this->getLanguage()), 'javascript'); ?>
',
		expired_license: '<?php echo smarty_modifier_escape(fn_get_lang_var('text_expired_license', $this->getLanguage()), 'javascript'); ?>
',
		file_browser: '<?php echo smarty_modifier_escape(fn_get_lang_var('file_browser', $this->getLanguage()), 'javascript'); ?>
',
		editing_block: '<?php echo smarty_modifier_escape(fn_get_lang_var('editing_block', $this->getLanguage()), 'javascript'); ?>
',
		editing_grid: '<?php echo smarty_modifier_escape(fn_get_lang_var('editing_grid', $this->getLanguage()), 'javascript'); ?>
',
		editing_container: '<?php echo smarty_modifier_escape(fn_get_lang_var('editing_container', $this->getLanguage()), 'javascript'); ?>
',
		adding_grid: '<?php echo smarty_modifier_escape(fn_get_lang_var('adding_grid', $this->getLanguage()), 'javascript'); ?>
',
		adding_block_to_grid: '<?php echo smarty_modifier_escape(fn_get_lang_var('adding_block_to_grid', $this->getLanguage()), 'javascript'); ?>
',
		manage_blocks: '<?php echo smarty_modifier_escape(fn_get_lang_var('manage_blocks', $this->getLanguage()), 'javascript'); ?>
',
		editing_block: '<?php echo smarty_modifier_escape(fn_get_lang_var('editing_block', $this->getLanguage()), 'javascript'); ?>
',
		add_block: '<?php echo smarty_modifier_escape(fn_get_lang_var('add_block', $this->getLanguage()), 'javascript'); ?>
'
	<?php echo $this->_tpl_vars['rdelim']; ?>


	var currencies = <?php echo $this->_tpl_vars['ldelim']; ?>

		'primary': <?php echo $this->_tpl_vars['ldelim']; ?>

			'decimals_separator': '<?php echo smarty_modifier_escape($this->_tpl_vars['currencies'][$this->_tpl_vars['primary_currency']]['decimals_separator'], 'javascript'); ?>
',
			'thousands_separator': '<?php echo smarty_modifier_escape($this->_tpl_vars['currencies'][$this->_tpl_vars['primary_currency']]['thousands_separator'], 'javascript'); ?>
',
			'decimals': '<?php echo smarty_modifier_escape($this->_tpl_vars['currencies'][$this->_tpl_vars['primary_currency']]['decimals'], 'javascript'); ?>
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

	var current_path = '<?php echo smarty_modifier_escape($this->_tpl_vars['config']['current_path'], 'javascript'); ?>
';
	var current_location = '<?php echo smarty_modifier_escape($this->_tpl_vars['config']['current_location'], 'javascript'); ?>
';
	var current_url = '<?php echo smarty_modifier_escape($this->_tpl_vars['config']['current_url'], 'javascript'); ?>
';
	var skin_name = '<?php echo $this->_tpl_vars['settings']['skin_name_admin']; ?>
';
	var skin_name_customer = '<?php echo $this->_tpl_vars['settings']['skin_name_customer']; ?>
';
	var customer_skin_path = '<?php echo $this->_tpl_vars['customer_skin_path']; ?>
';
	var images_dir = '<?php echo $this->_tpl_vars['images_dir']; ?>
';
	var notice_displaying_time = <?php if ($this->_tpl_vars['settings']['Appearance']['notice_displaying_time']): ?><?php echo $this->_tpl_vars['settings']['Appearance']['notice_displaying_time']; ?>
<?php else: ?>0<?php endif; ?>;
	var cart_language = '<?php echo @CART_LANGUAGE; ?>
';
	var default_language = '<?php echo @DEFAULT_LANGUAGE; ?>
';
	var cart_prices_w_taxes = <?php if (( $this->_tpl_vars['settings']['Appearance']['cart_prices_w_taxes'] == 'Y' )): ?>true<?php else: ?>false<?php endif; ?>;
	var translate_mode = <?php if (defined('TRANSLATION_MODE')): ?>true<?php else: ?>false<?php endif; ?>;
	var control_buttons_container, control_buttons_floating;
	var defined_company_id = '<?php echo defined('COMPANY_ID'); ?>
';
	var regexp = new Array();
	
	var default_editor = '<?php echo $this->_tpl_vars['settings']['Appearance']['default_wysiwyg_editor']; ?>
';
	var default_previewer = '<?php echo $this->_tpl_vars['settings']['Appearance']['default_image_previewer']; ?>
';
	
	<?php if ($this->_tpl_vars['config']['tweaks']['anti_csrf']): ?>
		// CSRF form protection key
		var security_hash = '<?php echo fn_generate_security_hash(""); ?>
';
	<?php endif; ?>
	
	$(function()<?php echo $this->_tpl_vars['ldelim']; ?>

		$.runCart('A');
	<?php echo $this->_tpl_vars['rdelim']; ?>
);
	
//]]>
</script>

<?php $this->_tag_stack[] = array('hook', array('name' => "index:scripts")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
<?php if ($this->_tpl_vars['addons']['bundled_products']['status'] == 'A'): ?><?php $__parent_tpl_vars = $this->_tpl_vars; ?><?php echo smarty_function_script(array('src' => "addons/bundled_products/js/func.js"), $this);?>


<script type="text/javascript">
// Extend core function
fn_register_hooks('bundled_products', ['add_js_item', 'transfer_js_items']);

</script><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php endif; ?><?php if ($this->_tpl_vars['addons']['news_and_emails']['status'] == 'A'): ?><?php $__parent_tpl_vars = $this->_tpl_vars; ?><?php echo smarty_function_script(array('src' => "addons/news_and_emails/js/func.js"), $this);?>

<script type="text/javascript">

// Extend core function
fn_register_hooks('news_and_emails', ['add_js_item']);

</script><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php endif; ?><?php if ($this->_tpl_vars['addons']['banners']['status'] == 'A'): ?><?php $__parent_tpl_vars = $this->_tpl_vars; ?><?php echo smarty_function_script(array('src' => "addons/banners/js/func.js"), $this);?>

<script type="text/javascript">

// Extend core function
fn_register_hooks('banners', ['add_js_item']);

</script><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php endif; ?><?php if ($this->_tpl_vars['addons']['recurring_billing']['status'] == 'A'): ?><?php $__parent_tpl_vars = $this->_tpl_vars; ?><?php echo smarty_function_script(array('src' => "addons/recurring_billing/js/func.js"), $this);?>

<script type="text/javascript">

// Extend core function
fn_register_hooks('recurring_billing', ['add_js_item']);

</script><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php endif; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
</head>

<body <?php if (! $this->_tpl_vars['auth']['user_id'] || $this->_tpl_vars['view_mode'] == 'simple'): ?>id="simple_view"<?php endif; ?>>
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
	<?php $__parent_tpl_vars = $this->_tpl_vars; ?><div id="ajax_loading_box" class="ajax-loading-box"><div id="ajax_loading_message" class="ajax-inner-loading-box"><?php echo fn_get_lang_var('loading', $this->getLanguage()); ?>
</div></div><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
	<?php if (! ( $this->_tpl_vars['auth']['user_id'] && $this->_tpl_vars['view_mode'] != 'simple' )): ?>
		<?php $__parent_tpl_vars = $this->_tpl_vars; ?><?php if (! defined('AJAX_REQUEST')): ?>

<?php ob_start(); ?>
<?php $_from = fn_get_notifications(""); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['message']):
?>
<div class="notification-content<?php if ($this->_tpl_vars['message']['message_state'] == 'I'): ?> cm-auto-hide<?php endif; ?><?php if ($this->_tpl_vars['message']['message_state'] == 'S'): ?> cm-ajax-close-notification<?php endif; ?>" id="notification_<?php echo $this->_tpl_vars['key']; ?>
">
	<div class="notification-<?php echo smarty_modifier_lower($this->_tpl_vars['message']['type']); ?>
">
		<img id="close_notification_<?php echo $this->_tpl_vars['key']; ?>
" class="cm-notification-close hand" src="<?php echo $this->_tpl_vars['images_dir']; ?>
/icons/icon_close.gif" width="13" height="13" border="0" alt="<?php echo fn_get_lang_var('close', $this->getLanguage()); ?>
" title="<?php echo fn_get_lang_var('close', $this->getLanguage()); ?>
" />
		<div class="notification-header-<?php echo smarty_modifier_lower($this->_tpl_vars['message']['type']); ?>
"><?php echo $this->_tpl_vars['message']['title']; ?>
</div>
		<div>
			<?php echo $this->_tpl_vars['message']['message']; ?>

		</div>
	</div>
	
</div>
<?php endforeach; endif; unset($_from); ?>
<?php $this->_smarty_vars['capture']['notification_content'] = ob_get_contents(); ob_end_clean(); ?>

<?php if ($this->_tpl_vars['auth']['user_id'] && $this->_tpl_vars['view_mode'] != 'simple'): ?>
	<?php echo $this->_smarty_vars['capture']['notification_content']; ?>

<?php endif; ?>

<div class="cm-notification-container <?php if (! ( $this->_tpl_vars['auth']['user_id'] && $this->_tpl_vars['view_mode'] != 'simple' )): ?>cm-notification-container-top<?php endif; ?>">
	<?php if (! ( $this->_tpl_vars['auth']['user_id'] && $this->_tpl_vars['view_mode'] != 'simple' )): ?>
		<?php echo $this->_smarty_vars['capture']['notification_content']; ?>

	<?php endif; ?>
</div>

<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
	<?php endif; ?>
	
	<?php if ($this->_tpl_vars['auth']['user_id'] && $this->_tpl_vars['view_mode'] != 'simple'): ?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "top.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php endif; ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "main.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php if ($this->_tpl_vars['auth']['user_id'] && $this->_tpl_vars['view_mode'] != 'simple'): ?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "bottom.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php endif; ?>
	<?php echo smarty_modifier_unescape(smarty_modifier_default(@$this->_tpl_vars['stats'], "")); ?>

<?php if (defined('TRANSLATION_MODE')): ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/translate_box.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php endif; ?>

<?php $__parent_tpl_vars = $this->_tpl_vars; ?><div id="comet_container" title="<?php echo fn_get_lang_var('processing', $this->getLanguage()); ?>
..."></div><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>

</body>

</html>