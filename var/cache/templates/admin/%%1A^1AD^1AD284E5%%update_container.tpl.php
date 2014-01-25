<?php /* Smarty version 2.6.18, created on 2014-01-24 11:00:11
         compiled from views/block_manager/update_container.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'views/block_manager/update_container.tpl', 2, false),array('modifier', 'fn_url', 'views/block_manager/update_container.tpl', 5, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('general','width','user_class'));
?>

<?php $this->assign('id', smarty_modifier_default(@$this->_tpl_vars['container']['container_id'], 0), false); ?>

<div id="container_properties_<?php echo $this->_tpl_vars['id']; ?>
">
<form action="<?php echo fn_url(""); ?>
" method="post" class="cm-form-highlight" name="container_update_form">

<?php if ($this->_tpl_vars['container']['container_id']): ?>
	<input type="hidden" name="container_data[container_id]" value="<?php echo $this->_tpl_vars['container']['container_id']; ?>
" />
<?php endif; ?>

<div class="tabs cm-j-tabs">
	<ul>
		<li class="cm-js cm-active"><a><?php echo fn_get_lang_var('general', $this->getLanguage()); ?>
</a></li>
	</ul>
</div>

<div class="cm-tabs-content">
<fieldset>
	<div class="form-field cm-no-hide-input">
		<label for="container_width_<?php echo $this->_tpl_vars['id']; ?>
"><?php echo fn_get_lang_var('width', $this->getLanguage()); ?>
:</label>
		<select id="container_width_<?php echo $this->_tpl_vars['id']; ?>
" name="container_data[width]">
			<option value="12" <?php if ($this->_tpl_vars['container']['width'] == 12): ?>selected="selected"<?php endif; ?>>12</option>
			<option value="16" <?php if ($this->_tpl_vars['container']['width'] == 16): ?>selected="selected"<?php endif; ?>>16</option>
		</select>
	</div>

	<div class="form-field cm-no-hide-input">
		<label for="container_user_class_<?php echo $this->_tpl_vars['id']; ?>
"><?php echo fn_get_lang_var('user_class', $this->getLanguage()); ?>
:</label>
		<input id="container_user_class_<?php echo $this->_tpl_vars['id']; ?>
" class="input-text" name="container_data[user_class]" value="<?php echo $this->_tpl_vars['container']['user_class']; ?>
" />
	</div>

</fieldset>
</div>

<div class="buttons-container">
	<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/save_cancel.tpl", 'smarty_include_vars' => array('but_name' => "dispatch[block_manager.update_location]",'cancel_action' => 'close','but_meta' => "cm-dialog-closer")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>
</form>
<!--container_properties_<?php echo $this->_tpl_vars['id']; ?>
--></div>