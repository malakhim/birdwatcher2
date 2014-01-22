<?php /* Smarty version 2.6.18, created on 2014-01-22 11:26:15
         compiled from views/menus/components/block_settings.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'fn_url', 'views/menus/components/block_settings.tpl', 13, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('no_menus','manage_menus'));
?>
<?php  ob_start();  ?><?php if ($this->_tpl_vars['option']['values']): ?>
	<label for="<?php echo $this->_tpl_vars['html_id']; ?>
"<?php if ($this->_tpl_vars['option']['required']): ?> class="cm-required"<?php endif; ?>><?php if ($this->_tpl_vars['option']['option_name']): ?><?php echo fn_get_lang_var($this->_tpl_vars['option']['option_name'], $this->getLanguage()); ?>
<?php else: ?><?php echo fn_get_lang_var($this->_tpl_vars['name'], $this->getLanguage()); ?>
<?php endif; ?>:</label>

	<select id="<?php echo $this->_tpl_vars['html_id']; ?>
" name="<?php echo $this->_tpl_vars['html_name']; ?>
">
	<?php $_from = $this->_tpl_vars['option']['values']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
		<option value="<?php echo $this->_tpl_vars['k']; ?>
" <?php if ($this->_tpl_vars['value'] && $this->_tpl_vars['value'] == $this->_tpl_vars['k'] || ! $this->_tpl_vars['value'] && $this->_tpl_vars['option']['default_value'] == $this->_tpl_vars['k']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['v']; ?>
</option>
	<?php endforeach; endif; unset($_from); ?>
	</select>	
<?php else: ?>
	<?php echo fn_get_lang_var('no_menus', $this->getLanguage()); ?>

<?php endif; ?>
<div>
	<a href="<?php echo fn_url("menus.manage"); ?>
"><?php echo fn_get_lang_var('manage_menus', $this->getLanguage()); ?>
</a>
</div><?php  ob_end_flush();  ?>