<?php /* Smarty version 2.6.18, created on 2013-06-01 19:32:59
         compiled from C:/wamp5/www/dutchme2/skins/basic/customer/blocks/menu/text_links.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'C:/wamp5/www/dutchme2/skins/basic/customer/blocks/menu/text_links.tpl', 10, false),array('modifier', 'fn_url', 'C:/wamp5/www/dutchme2/skins/basic/customer/blocks/menu/text_links.tpl', 11, false),)), $this); ?>

<?php if ($this->_tpl_vars['block']['properties']['show_items_in_line'] == 'Y'): ?>
	<?php $this->assign('inline', true, false); ?>
<?php endif; ?>

<?php if ($this->_tpl_vars['items']): ?>
	<ul class="text-links <?php if ($this->_tpl_vars['inline']): ?>text-links-inline<?php endif; ?>">
		<?php $_from = $this->_tpl_vars['items']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['menu']):
?>
			<li class="level-<?php echo smarty_modifier_default(@$this->_tpl_vars['menu']['level'], 0); ?>
<?php if ($this->_tpl_vars['menu']['active']): ?> cm-active<?php endif; ?>">
				<a <?php if ($this->_tpl_vars['menu']['href']): ?>href="<?php echo fn_url($this->_tpl_vars['menu']['href']); ?>
"<?php endif; ?>><?php echo $this->_tpl_vars['menu']['item']; ?>
</a> 
				<?php if ($this->_tpl_vars['menu']['subitems']): ?>
					<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "blocks/menu/text_links.tpl", 'smarty_include_vars' => array('items' => $this->_tpl_vars['menu']['subitems'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				<?php endif; ?>
			</li>
		<?php endforeach; endif; unset($_from); ?>
	</ul>
<?php endif; ?>