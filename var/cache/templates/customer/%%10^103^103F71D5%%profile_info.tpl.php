<?php /* Smarty version 2.6.18, created on 2014-03-06 15:46:41
         compiled from C:/wamp5/www/dutchme2/skins/basic/customer/blocks/static_templates/profile_info.tpl */ ?>
<?php
fn_preload_lang_vars(array('text_profile_benefits','text_profile_details'));
?>
<?php  ob_start();  ?><?php if ($this->_tpl_vars['controller'] == 'profiles' && $this->_tpl_vars['mode'] == 'add'): ?>
	<div class="account-benefits">
		<?php echo fn_get_lang_var('text_profile_benefits', $this->getLanguage()); ?>

	</div>

<?php elseif ($this->_tpl_vars['controller'] == 'profiles' && $this->_tpl_vars['mode'] == 'update'): ?>
	<div class="account-detail ">
		<?php echo fn_get_lang_var('text_profile_details', $this->getLanguage()); ?>

	</div>
<?php endif; ?><?php  ob_end_flush();  ?>