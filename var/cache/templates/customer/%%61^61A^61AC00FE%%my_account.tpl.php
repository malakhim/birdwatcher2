<?php /* Smarty version 2.6.18, created on 2013-09-21 19:14:02
         compiled from C:/wamp5/www/dutchme2/skins/basic/customer/blocks/my_account.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'fn_url', 'C:/wamp5/www/dutchme2/skins/basic/customer/blocks/my_account.tpl', 18, false),array('modifier', 'escape', 'C:/wamp5/www/dutchme2/skins/basic/customer/blocks/my_account.tpl', 22, false),array('modifier', 'fn_get_comparison_products', 'C:/wamp5/www/dutchme2/skins/basic/customer/blocks/my_account.tpl', 45, false),array('modifier', 'count', 'C:/wamp5/www/dutchme2/skins/basic/customer/blocks/my_account.tpl', 46, false),array('modifier', 'default', 'C:/wamp5/www/dutchme2/skins/basic/customer/blocks/my_account.tpl', 48, false),array('modifier', 'fn_needs_image_verification', 'C:/wamp5/www/dutchme2/skins/basic/customer/blocks/my_account.tpl', 73, false),array('modifier', 'uniqid', 'C:/wamp5/www/dutchme2/skins/basic/customer/blocks/my_account.tpl', 76, false),array('block', 'hook', 'C:/wamp5/www/dutchme2/skins/basic/customer/blocks/my_account.tpl', 24, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('profile_details','downloads','orders','view_compare_list','my_tags','events','return_requests','my_points','wishlist','rb_subscriptions','apply_for_vendor_account','track_my_order','track_my_order','order_id','email','go','image_verification_label','image_verification_body','sign_out','sign_in','register','sign_in'));
?>
<?php 

				$rname = !empty($resource_name) ? $resource_name : $params['smarty_include_tpl_file'];
				if ($this->compile_check && empty($inline_no_check[$rname]) && $this->is_cached($rname)) {
					if ($this->check_inline_blocks(array (
  'common_templates/image_verification.tpl' => 1367063745,
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
	<?php if ($this->_tpl_vars['addons']['tags']['status'] == 'A'): ?><?php $__parent_tpl_vars = $this->_tpl_vars; ?><li><a href="<?php echo fn_url("tags.summary"); ?>
" rel="nofollow"><?php echo fn_get_lang_var('my_tags', $this->getLanguage()); ?>
</a></li><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php endif; ?><?php if ($this->_tpl_vars['addons']['gift_registry']['status'] == 'A'): ?><?php $__parent_tpl_vars = $this->_tpl_vars; ?><li><a href="<?php echo fn_url("events.search"); ?>
" rel="nofollow"><?php echo fn_get_lang_var('events', $this->getLanguage()); ?>
</a></li><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php endif; ?><?php if ($this->_tpl_vars['addons']['rma']['status'] == 'A'): ?><?php $__parent_tpl_vars = $this->_tpl_vars; ?><li><a href="<?php echo fn_url("rma.returns"); ?>
" rel="nofollow"><?php echo fn_get_lang_var('return_requests', $this->getLanguage()); ?>
</a></li><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php endif; ?><?php if ($this->_tpl_vars['addons']['reward_points']['status'] == 'A'): ?><?php $__parent_tpl_vars = $this->_tpl_vars; ?><?php if ($this->_tpl_vars['auth']['user_id']): ?>
<li><a href="<?php echo fn_url("reward_points.userlog"); ?>
" rel="nofollow"><?php echo fn_get_lang_var('my_points', $this->getLanguage()); ?>
&nbsp;<span>(<?php echo smarty_modifier_default(@$this->_tpl_vars['user_info']['points'], '0'); ?>
)</span></a></li>
<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php endif; ?><?php if ($this->_tpl_vars['addons']['wishlist']['status'] == 'A'): ?><?php $__parent_tpl_vars = $this->_tpl_vars; ?><li><a href="<?php echo fn_url("wishlist.view"); ?>
" rel="nofollow"><?php echo fn_get_lang_var('wishlist', $this->getLanguage()); ?>
<?php if ($this->_tpl_vars['wishlist_count'] > 0): ?> (<?php echo $this->_tpl_vars['wishlist_count']; ?>
)<?php endif; ?></a></li><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php endif; ?><?php if ($this->_tpl_vars['addons']['recurring_billing']['status'] == 'A'): ?><?php $__parent_tpl_vars = $this->_tpl_vars; ?><li><a href="<?php echo fn_url("subscriptions.search"); ?>
" rel="nofollow"><?php echo fn_get_lang_var('rb_subscriptions', $this->getLanguage()); ?>
</a></li><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php endif; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

	
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
<?php endif; ?>" /><?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('but_name' => "orders.track_request", 'alt' => fn_get_lang_var('go', $this->getLanguage()), )); ?><button title="<?php echo $this->_tpl_vars['alt']; ?>
" class="go-button" type="submit"><?php if ($this->_tpl_vars['but_text']): ?><?php echo $this->_tpl_vars['but_text']; ?>
<?php endif; ?></button>
<input type="hidden" name="dispatch" value="<?php echo $this->_tpl_vars['but_name']; ?>
" /><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
		<?php if ($this->_tpl_vars['settings']['Image_verification']['use_for_track_orders'] == 'Y'): ?>
			<input type="hidden" name="field_id" value="<?php echo $this->_tpl_vars['block']['snapping_id']; ?>
" />
			<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('id' => "track_orders_".($this->_tpl_vars['block']['snapping_id']), 'align' => 'left', 'sidebox' => true, )); ?><?php if (fn_needs_image_verification("") == true): ?>	
	<?php $this->assign('is', $this->_tpl_vars['settings']['Image_verification'], false); ?>
	
	<?php $this->assign('id_uniqid', uniqid($this->_tpl_vars['id']), false); ?>
	<div class="captcha form-field">
	<?php if ($this->_tpl_vars['sidebox']): ?>
		<p><img id="verification_image_<?php echo $this->_tpl_vars['id']; ?>
" class="image-captcha valign" src="<?php echo fn_url("image.captcha?verification_id=".($this->_tpl_vars['SESS_ID']).":".($this->_tpl_vars['id'])."&amp;".($this->_tpl_vars['id_uniqid'])."&amp;", 'C', 'rel', '&amp;'); ?>
" alt="" onclick="this.src += 'reload' ;" width="<?php echo $this->_tpl_vars['is']['width']; ?>
" height="<?php echo $this->_tpl_vars['is']['height']; ?>
" /></p>
	<?php endif; ?>
		<label for="verification_answer_<?php echo $this->_tpl_vars['id']; ?>
" class="cm-required"><?php echo fn_get_lang_var('image_verification_label', $this->getLanguage()); ?>
</label>
		<input class="captcha-input-text valign cm-autocomplete-off" type="text" id="verification_answer_<?php echo $this->_tpl_vars['id']; ?>
" name="verification_answer" value= "" />
	<?php if (! $this->_tpl_vars['sidebox']): ?>
		<img id="verification_image_<?php echo $this->_tpl_vars['id']; ?>
" class="image-captcha valign" src="<?php echo fn_url("image.captcha?verification_id=".($this->_tpl_vars['SESS_ID']).":".($this->_tpl_vars['id'])."&amp;".($this->_tpl_vars['id_uniqid'])."&amp;", 'C', 'rel', '&amp;'); ?>
" alt="" onclick="this.src += 'reload' ;"  width="<?php echo $this->_tpl_vars['is']['width']; ?>
" height="<?php echo $this->_tpl_vars['is']['height']; ?>
" />
	<?php endif; ?>
	<p<?php if ($this->_tpl_vars['align']): ?> class="<?php echo $this->_tpl_vars['align']; ?>
"<?php endif; ?>><?php echo fn_get_lang_var('image_verification_body', $this->getLanguage()); ?>
</p>
	</div>
<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
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
--></div>