<?php /* Smarty version 2.6.18, created on 2013-09-03 09:47:43
         compiled from orders/order_notification_subj.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'unescape', 'orders/order_notification_subj.tpl', 1, false),)), $this); ?>
<?php echo smarty_modifier_unescape($this->_tpl_vars['company_placement_info']['company_name']); ?>
: <?php echo fn_get_lang_var('order', $this->getLanguage()); ?>
 #<?php echo $this->_tpl_vars['order_info']['order_id']; ?>
 <?php echo $this->_tpl_vars['order_status']['email_subj']; ?>