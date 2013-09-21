<?php /* Smarty version 2.6.18, created on 2013-09-21 19:32:08
         compiled from views/skin_selector/manage.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'defined', 'views/skin_selector/manage.tpl', 4, false),array('modifier', 'fn_url', 'views/skin_selector/manage.tpl', 7, false),array('modifier', 'default', 'views/skin_selector/manage.tpl', 29, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('text_customer_skin','templates_dir','text_admin_skin','templates_dir','skin_selector'));
?>
<?php ob_start(); ?>

<div id="skin_selector_container">
<?php if (defined('DEVELOPMENT')): ?>
	<p class="no-items">Cart is in development mode now and skin selector is unavailable</div>
<?php else: ?>
<form action="<?php echo fn_url(""); ?>
" method="post" class="cm-ajax cm-comet" name="skin_selector_form">
<input type="hidden" name="result_ids" value="skin_selector_container">

<table cellspacing="0" cellpadding="0" border="0" width="100%">
<tr>
	<td valign="top" width="50%">
	<div class="form-field">
		<label for="customer_skin"><?php echo fn_get_lang_var('text_customer_skin', $this->getLanguage()); ?>
:</label>
		<select id="customer_skin" name="skin_data[customer]" onchange="$('#c_screenshot').attr('src', '<?php echo $this->_tpl_vars['config']['current_path']; ?>
/var/skins_repository/'+this.value+'/customer_screenshot.png');">
			<?php $_from = $this->_tpl_vars['available_skins']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['s']):
?>
				<?php if ($this->_tpl_vars['s']['customer'] == 'Y'): ?>
					<option value="<?php echo $this->_tpl_vars['k']; ?>
" <?php if ($this->_tpl_vars['settings']['skin_name_customer'] == $this->_tpl_vars['k']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['s']['description']; ?>
</option>
				<?php endif; ?>
			<?php endforeach; endif; unset($_from); ?>
		</select>
	</div>
	

	<div class="form-field">
		<label><?php echo fn_get_lang_var('templates_dir', $this->getLanguage()); ?>
:</label>
		<?php echo $this->_tpl_vars['customer_path']; ?>

		<div class="break">
			<img class="solid-border" width="300" id="c_screenshot" src="<?php echo $this->_tpl_vars['config']['current_path']; ?>
/var/skins_repository/<?php echo smarty_modifier_default(@$this->_tpl_vars['settings']['skin_name_customer'], 'basic'); ?>
/customer_screenshot.png" />
		</div>
	</div>

	</td>
	<td width="50%">
	
	<div class="form-field">
		<label for="admin_skin"><?php echo fn_get_lang_var('text_admin_skin', $this->getLanguage()); ?>
:</label>
		<select id="admin_skin" name="skin_data[admin]" onchange="$('#a_screenshot').attr('src', '<?php echo $this->_tpl_vars['config']['current_path']; ?>
/var/skins_repository/' + this.value + '/admin_screenshot.png');">
			<?php $_from = $this->_tpl_vars['available_skins']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['s']):
?>
				<?php if ($this->_tpl_vars['s']['admin'] == 'Y'): ?>
					<option value="<?php echo $this->_tpl_vars['k']; ?>
" <?php if ($this->_tpl_vars['settings']['skin_name_admin'] == $this->_tpl_vars['k']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['s']['description']; ?>
</option>
				<?php endif; ?>
			<?php endforeach; endif; unset($_from); ?>
		</select>
	</div>

	<div class="form-field">
		<label><?php echo fn_get_lang_var('templates_dir', $this->getLanguage()); ?>
:</label>
		<?php echo $this->_tpl_vars['admin_path']; ?>

		<div class="break">
			<img class="solid-border" width="300" id="a_screenshot" src="<?php echo $this->_tpl_vars['config']['current_path']; ?>
/var/skins_repository/<?php echo smarty_modifier_default(@$this->_tpl_vars['settings']['skin_name_admin'], 'basic'); ?>
/admin_screenshot.png" />
		</div>
	</div>
	
	</td>
</tr>
</table>


<div class="buttons-container buttons-bg">
	<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/save.tpl", 'smarty_include_vars' => array('but_name' => "dispatch[skin_selector.update]",'but_role' => 'button_main')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>

</form>
<?php endif; ?>

<!--skin_selector_container--></div>
<?php $this->_smarty_vars['capture']['mainbox'] = ob_get_contents(); ob_end_clean(); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/mainbox.tpl", 'smarty_include_vars' => array('title' => fn_get_lang_var('skin_selector', $this->getLanguage()),'content' => $this->_smarty_vars['capture']['mainbox'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>