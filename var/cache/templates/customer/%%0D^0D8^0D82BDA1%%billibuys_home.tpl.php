<?php /* Smarty version 2.6.18, created on 2013-10-18 07:57:16
         compiled from C:/wamp5/www/dutchme2/skins/basic/customer/addons/billibuys/blocks/static_templates/billibuys_home.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'fn_url', 'C:/wamp5/www/dutchme2/skins/basic/customer/addons/billibuys/blocks/static_templates/billibuys_home.tpl', 7, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('bb_looking_for_an_item','bb_let_sellers_come_to_you','bb_i_want','submit','or','bb_looking_for_buyer','bb_select_a_category'));
?>
<?php  ob_start();  ?>
<p class="txt_1"><?php echo fn_get_lang_var('bb_looking_for_an_item', $this->getLanguage()); ?>
?</p>

<p class="txt_1"><?php echo fn_get_lang_var('bb_let_sellers_come_to_you', $this->getLanguage()); ?>
!</p>

<form action="<?php echo fn_url("auth.login_form&return_url=billibuys.place_request"); ?>
" method="GET">
<?php if (! $this->_tpl_vars['auth']['user_id']): ?>
	<input type="hidden" name="dispatch" value="auth.login_form"/>
	<input type="hidden" name="return_url" value="billibuys.place_request" />
<?php else: ?>
	<input type="hidden" name="dispatch" value="billibuys.place_request" />
<?php endif; ?>
	<input type="text" name="request_title" id="i_want" value="<?php echo fn_get_lang_var('bb_i_want', $this->getLanguage()); ?>
..." id="request_title_home" onclick="<?php echo '$(this).val(\'\')'; ?>
"/>
<input type="submit" value="<?php echo fn_get_lang_var('submit', $this->getLanguage()); ?>
" />
</form>
<p class="txt_2"><?php echo fn_get_lang_var('or', $this->getLanguage()); ?>
</p>

<p class="txt_1"><?php echo fn_get_lang_var('bb_looking_for_buyer', $this->getLanguage()); ?>
?</p>

<p class="txt_1"><?php echo fn_get_lang_var('bb_select_a_category', $this->getLanguage()); ?>
:</p><?php  ob_end_flush();  ?>