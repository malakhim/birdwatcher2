<?php /* Smarty version 2.6.18, created on 2013-06-01 19:33:00
         compiled from C:/wamp5/www/dutchme2/skins/basic/customer/blocks/companies_list.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'fn_url', 'C:/wamp5/www/dutchme2/skins/basic/customer/blocks/companies_list.tpl', 6, false),array('modifier', 'count', 'C:/wamp5/www/dutchme2/skins/basic/customer/blocks/companies_list.tpl', 10, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('view_all'));
?>
<?php  ob_start();  ?>
<?php if ($this->_tpl_vars['items']['companies']): ?>
	<ul>
	<?php $_from = $this->_tpl_vars['items']['companies']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
		<li><a href="<?php echo fn_url("companies.view?company_id=".($this->_tpl_vars['k'])); ?>
"><?php echo $this->_tpl_vars['v']; ?>
</a></li>
	<?php endforeach; endif; unset($_from); ?>
	</ul>

	<?php if (count($this->_tpl_vars['items']['companies']) < $this->_tpl_vars['items']['count']): ?>
		<p class="right">
			<a class="extra-link" href="<?php echo fn_url("companies.catalog"); ?>
"><?php echo fn_get_lang_var('view_all', $this->getLanguage()); ?>
</a>
		</p>
	<?php endif; ?>
<?php endif; ?><?php  ob_end_flush();  ?>