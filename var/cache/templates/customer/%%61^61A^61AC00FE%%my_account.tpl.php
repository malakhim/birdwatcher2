<?php /* Smarty version 2.6.18, created on 2014-01-28 16:51:10
         compiled from C:/wamp5/www/dutchme2/skins/basic/customer/blocks/my_account.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'fn_url', 'C:/wamp5/www/dutchme2/skins/basic/customer/blocks/my_account.tpl', 4, false),array('modifier', 'escape', 'C:/wamp5/www/dutchme2/skins/basic/customer/blocks/my_account.tpl', 8, false),array('modifier', 'fn_get_comparison_products', 'C:/wamp5/www/dutchme2/skins/basic/customer/blocks/my_account.tpl', 31, false),array('modifier', 'count', 'C:/wamp5/www/dutchme2/skins/basic/customer/blocks/my_account.tpl', 32, false),array('modifier', 'default', 'C:/wamp5/www/dutchme2/skins/basic/customer/blocks/my_account.tpl', 47, false),array('modifier', 'trim', 'C:/wamp5/www/dutchme2/skins/basic/customer/blocks/my_account.tpl', 79, false),array('block', 'hook', 'C:/wamp5/www/dutchme2/skins/basic/customer/blocks/my_account.tpl', 10, false),array('function', 'set_id', 'C:/wamp5/www/dutchme2/skins/basic/customer/blocks/my_account.tpl', 79, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('profile_details','downloads','orders','view_compare_list','apply_for_vendor_account','track_my_order','track_my_order','order_id','email','go','sign_out','sign_in','register','sign_in'));
?>
<?php ob_start(); ?>
<?php ob_start(); ?>
	<a href="<?php echo fn_url("profiles.update"); ?>
"><?php echo $this->_tpl_vars['title']; ?>
</a>
<?php $this->_smarty_vars['capture']['title'] = ob_get_contents(); ob_end_clean(); ?>

<div id="account_info_<?php echo $this->_tpl_vars['block']['snapping_id']; ?>
">
	<?php $this->assign('return_current_url', smarty_modifier_escape($this->_tpl_vars['config']['current_url'], 'url'), false); ?>
	<ul class="account-info">
	<?php $this->_tag_stack[] = array('hook', array('name' => "profiles:my_account_menu")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
		<?php if ($this->_tpl_vars['auth']['user_id']): ?>
			<?php if ($this->_tpl_vars['user_info']['firstname'] || $this->_tpl_vars['user_info']['lastname']): ?>
				<li class="user-name"><?php echo $this->_tpl_vars['user_info']['firstname']; ?>
 <?php echo $this->_tpl_vars['user_info']['lastname']; ?>
</li>
			<?php else: ?>
				<?php if ($this->_tpl_vars['settings']['General']['use_email_as_login'] == 'Y'): ?>
					<li class="user-name"><?php echo $this->_tpl_vars['user_info']['email']; ?>
</li>
				<?php else: ?>
					<li class="user-name"><?php echo $this->_tpl_vars['user_info']['user_login']; ?>
</li>
				<?php endif; ?>
			<?php endif; ?>
			<li><a href="<?php echo fn_url("profiles.update"); ?>
" rel="nofollow" class="underlined"><?php echo fn_get_lang_var('profile_details', $this->getLanguage()); ?>
</a></li>
			<li><a href="<?php echo fn_url("orders.downloads"); ?>
" rel="nofollow" class="underlined"><?php echo fn_get_lang_var('downloads', $this->getLanguage()); ?>
</a></li>
		<?php elseif ($this->_tpl_vars['user_data']['firstname'] || $this->_tpl_vars['user_data']['lastname']): ?>
			<li class="user-name"><?php echo $this->_tpl_vars['user_data']['firstname']; ?>
 <?php echo $this->_tpl_vars['user_data']['lastname']; ?>
</li>
		<?php elseif ($this->_tpl_vars['settings']['General']['use_email_as_login'] == 'Y' && $this->_tpl_vars['user_data']['email']): ?>
			<li class="user-name"><?php echo $this->_tpl_vars['user_data']['email']; ?>
</li>
		<?php elseif ($this->_tpl_vars['settings']['General']['use_email_as_login'] != 'Y' && $this->_tpl_vars['user_data']['user_login']): ?>
			<li class="user-name"><?php echo $this->_tpl_vars['user_data']['user_login']; ?>
</li>
		<?php endif; ?>
		<li><a href="<?php echo fn_url("orders.search"); ?>
" rel="nofollow" class="underlined"><?php echo fn_get_lang_var('orders', $this->getLanguage()); ?>
</a></li>
		<?php $this->assign('compared_products', fn_get_comparison_products(""), false); ?>
		<li><a href="<?php echo fn_url("product_features.compare"); ?>
" rel="nofollow" class="underlined"><?php echo fn_get_lang_var('view_compare_list', $this->getLanguage()); ?>
<?php if ($this->_tpl_vars['compared_products']): ?> (<?php echo count($this->_tpl_vars['compared_products']); ?>
)<?php endif; ?></a></li>
	<?php if ($this->_tpl_vars['addons']['tags']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/tags/hooks/profiles/my_account_menu.post.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php if ($this->_tpl_vars['addons']['gift_registry']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/gift_registry/hooks/profiles/my_account_menu.post.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php if ($this->_tpl_vars['addons']['rma']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/rma/hooks/profiles/my_account_menu.post.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php if ($this->_tpl_vars['addons']['reward_points']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/reward_points/hooks/profiles/my_account_menu.post.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php if ($this->_tpl_vars['addons']['wishlist']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/wishlist/hooks/profiles/my_account_menu.post.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php if ($this->_tpl_vars['addons']['recurring_billing']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/recurring_billing/hooks/profiles/my_account_menu.post.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

	
	<?php if ($this->_tpl_vars['settings']['Suppliers']['apply_for_vendor'] == 'Y' && ! ( $this->_tpl_vars['controller'] == 'companies' && $this->_tpl_vars['mode'] == 'apply_for_vendor' || $this->_tpl_vars['user_info']['company_id'] )): ?>
		<li><a href="<?php echo fn_url("companies.apply_for_vendor?return_previous_url=".($this->_tpl_vars['return_current_url'])); ?>
" rel="nofollow" class="underlined"><?php echo fn_get_lang_var('apply_for_vendor_account', $this->getLanguage()); ?>
</a></li><?php endif; ?>
	
	</ul>

	<?php if ($this->_tpl_vars['settings']['Appearance']['display_track_orders'] == 'Y'): ?>
	<div class="updates-wrapper track-orders" id="track_orders_block_<?php echo $this->_tpl_vars['block']['snapping_id']; ?>
">

	<form action="<?php echo fn_url(""); ?>
" method="get" class="cm-ajax" name="track_order_quick">
	<input type="hidden" name="full_render" value="Y" />
	<input type="hidden" name="result_ids" value="track_orders_block_*" />
	<input type="hidden" name="return_url" value="<?php echo smarty_modifier_default(@$this->_tpl_vars['_REQUEST']['return_url'], @$this->_tpl_vars['config']['current_url']); ?>
" />

	<p class="text-track"><?php echo fn_get_lang_var('track_my_order', $this->getLanguage()); ?>
</p>

	<div class="form-field input-append">
	<label for="track_order_item<?php echo $this->_tpl_vars['block']['snapping_id']; ?>
" class="cm-required hidden"><?php echo fn_get_lang_var('track_my_order', $this->getLanguage()); ?>
</label>
			<input type="text" size="20" class="input-text cm-hint" id="track_order_item<?php echo $this->_tpl_vars['block']['snapping_id']; ?>
" name="track_data" value="<?php echo smarty_modifier_escape(fn_get_lang_var('order_id', $this->getLanguage()), 'html'); ?>
<?php if (! $this->_tpl_vars['auth']['user_id']): ?>/<?php echo smarty_modifier_escape(fn_get_lang_var('email', $this->getLanguage()), 'html'); ?>
<?php endif; ?>" /><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/go.tpl", 'smarty_include_vars' => array('but_name' => "orders.track_request",'alt' => fn_get_lang_var('go', $this->getLanguage()))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<?php if ($this->_tpl_vars['settings']['Image_verification']['use_for_track_orders'] == 'Y'): ?>
			<input type="hidden" name="field_id" value="<?php echo $this->_tpl_vars['block']['snapping_id']; ?>
" />
			<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/image_verification.tpl", 'smarty_include_vars' => array('id' => "track_orders_".($this->_tpl_vars['block']['snapping_id']),'align' => 'left','sidebox' => true)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<?php endif; ?>
	</div>

	</form>

	<!--track_orders_block_<?php echo $this->_tpl_vars['block']['snapping_id']; ?>
--></div>
	<?php endif; ?>

	<div class="buttons-container">
		<?php if ($this->_tpl_vars['auth']['user_id']): ?>
			<a href="<?php echo fn_url("auth.logout?redirect_url=".($this->_tpl_vars['return_current_url'])); ?>
" rel="nofollow" class="account"><?php echo fn_get_lang_var('sign_out', $this->getLanguage()); ?>
</a>
		<?php else: ?>
			<a href="<?php if ($this->_tpl_vars['controller'] == 'auth' && $this->_tpl_vars['mode'] == 'login_form'): ?><?php echo fn_url($this->_tpl_vars['config']['current_url']); ?>
<?php else: ?><?php echo fn_url("auth.login_form?return_url=".($this->_tpl_vars['return_current_url'])); ?>
<?php endif; ?>" <?php if ($this->_tpl_vars['settings']['General']['secure_auth'] != 'Y'): ?> rev="login_block<?php echo $this->_tpl_vars['block']['snapping_id']; ?>
" class="cm-dialog-opener cm-dialog-auto-size account"<?php else: ?>rel="nofollow" class="account"<?php endif; ?>><?php echo fn_get_lang_var('sign_in', $this->getLanguage()); ?>
</a> | <a href="<?php echo fn_url("profiles.add"); ?>
" rel="nofollow" class="account"><?php echo fn_get_lang_var('register', $this->getLanguage()); ?>
</a>
			<?php if ($this->_tpl_vars['settings']['General']['secure_auth'] != 'Y'): ?>
				<div  id="login_block<?php echo $this->_tpl_vars['block']['snapping_id']; ?>
" class="hidden" title="<?php echo fn_get_lang_var('sign_in', $this->getLanguage()); ?>
">
					<div class="login-popup">
						<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/auth/login_form.tpl", 'smarty_include_vars' => array('style' => 'popup','form_name' => "login_popup_form".($this->_tpl_vars['block']['snapping_id']),'id' => "popup".($this->_tpl_vars['block']['snapping_id']))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					</div>
				</div>
			<?php endif; ?>
		<?php endif; ?>
	</div>
<!--account_info_<?php echo $this->_tpl_vars['block']['snapping_id']; ?>
--></div><?php $this->_smarty_vars['capture']['template_content'] = ob_get_contents(); ob_end_clean(); ?><?php if (trim($this->_smarty_vars['capture']['template_content'])): ?><?php if ($this->_tpl_vars['auth']['area'] == 'A'): ?><span class="cm-template-box" template="blocks/my_account.tpl" id="<?php echo smarty_function_set_id(array('name' => "blocks/my_account.tpl"), $this);?>
"><img class="cm-template-icon hidden" src="<?php echo $this->_tpl_vars['images_dir']; ?>
/icons/layout_edit.gif" width="16" height="16" alt="" /><?php echo $this->_smarty_vars['capture']['template_content']; ?>
<!--[/tpl_id]--></span><?php else: ?><?php echo $this->_smarty_vars['capture']['template_content']; ?>
<?php endif; ?><?php endif; ?>