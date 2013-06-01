<?php /* Smarty version 2.6.18, created on 2013-06-01 19:33:02
         compiled from C:/wamp5/www/dutchme2/skins/basic/customer/blocks/static_templates/copyright.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'C:/wamp5/www/dutchme2/skins/basic/customer/blocks/static_templates/copyright.tpl', 2, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('powered_by','product_link','copyright_shopping_cart'));
?>
<?php  ob_start();  ?><p class="bottom-copyright">&copy; <?php if (smarty_modifier_date_format(@TIME, "%Y") != $this->_tpl_vars['settings']['Company']['company_start_year']): ?><?php echo $this->_tpl_vars['settings']['Company']['company_start_year']; ?>
-<?php endif; ?><?php echo smarty_modifier_date_format(@TIME, "%Y"); ?>
 <?php echo $this->_tpl_vars['settings']['Company']['company_name']; ?>
. &nbsp;<?php echo fn_get_lang_var('powered_by', $this->getLanguage()); ?>
 <a class="bottom-copyright" href="<?php echo fn_get_lang_var('product_link', $this->getLanguage()); ?>
" target="_blank"><?php echo fn_get_lang_var('copyright_shopping_cart', $this->getLanguage()); ?>
</a>
</p><?php  ob_end_flush();  ?>