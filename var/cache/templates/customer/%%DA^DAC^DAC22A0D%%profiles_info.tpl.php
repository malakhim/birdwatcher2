<?php /* Smarty version 2.6.18, created on 2013-09-06 23:07:41
         compiled from views/profiles/components/profiles_info.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'fn_get_profile_fields', 'views/profiles/components/profiles_info.tpl', 17, false),array('modifier', 'fn_get_profile_field_value', 'views/profiles/components/profiles_info.tpl', 27, false),array('modifier', 'replace', 'views/profiles/components/profiles_info.tpl', 29, false),array('modifier', 'trim', 'views/profiles/components/profiles_info.tpl', 57, false),array('function', 'split', 'views/profiles/components/profiles_info.tpl', 18, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('customer_information','billing_address','billing_address','shipping_address','shipping_address','contact_information','contact_information'));
?>
<?php 

				$rname = !empty($resource_name) ? $resource_name : $params['smarty_include_tpl_file'];
				if ($this->compile_check && empty($inline_no_check[$rname]) && $this->is_cached($rname)) {
					if ($this->check_inline_blocks(array (
  'views/profiles/components/profile_fields_info.tpl' => 1367063748,
))) {
						$_smarty_compile_path = $this->_get_compile_path($rname);
						$this->_compile_resource($rname, $_smarty_compile_path);
						$inline_no_check[$rname] = true;
						include $_smarty_compile_path;
						return;
					}
				}
			 ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/subheader.tpl", 'smarty_include_vars' => array('title' => fn_get_lang_var('customer_information', $this->getLanguage()))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php $this->assign('profile_fields', fn_get_profile_fields($this->_tpl_vars['location']), false); ?>
<?php echo smarty_function_split(array('data' => $this->_tpl_vars['profile_fields']['C'],'size' => 2,'assign' => 'contact_fields','simple' => true), $this);?>


<table cellpadding="0" cellspacing="0" border="0" width="100%" class="orders-info">
<tr valign="top">
	<?php if ($this->_tpl_vars['profile_fields']['B']): ?>
		<td width="31%">
			<h5><?php echo fn_get_lang_var('billing_address', $this->getLanguage()); ?>
</h5>
			<div class="orders-field"><?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('fields' => $this->_tpl_vars['profile_fields']['B'], 'title' => fn_get_lang_var('billing_address', $this->getLanguage()), )); ?><?php $_from = $this->_tpl_vars['fields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['field']):
?>

<?php $this->assign('value', fn_get_profile_field_value($this->_tpl_vars['user_data'], $this->_tpl_vars['field']), false); ?>
<?php if ($this->_tpl_vars['value']): ?>
<div class="info-field <?php echo smarty_modifier_replace($this->_tpl_vars['field']['field_name'], '_', "-"); ?>
"><?php echo $this->_tpl_vars['value']; ?>
</div>
<?php endif; ?>
<?php endforeach; endif; unset($_from); ?><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?></div>
		</td>
	<?php endif; ?>
	<?php if ($this->_tpl_vars['profile_fields']['S']): ?>
		<td width="31%">
			<h5><?php echo fn_get_lang_var('shipping_address', $this->getLanguage()); ?>
</h5>
			<div class="orders-field"><?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('fields' => $this->_tpl_vars['profile_fields']['S'], 'title' => fn_get_lang_var('shipping_address', $this->getLanguage()), )); ?><?php $_from = $this->_tpl_vars['fields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['field']):
?>

<?php $this->assign('value', fn_get_profile_field_value($this->_tpl_vars['user_data'], $this->_tpl_vars['field']), false); ?>
<?php if ($this->_tpl_vars['value']): ?>
<div class="info-field <?php echo smarty_modifier_replace($this->_tpl_vars['field']['field_name'], '_', "-"); ?>
"><?php echo $this->_tpl_vars['value']; ?>
</div>
<?php endif; ?>
<?php endforeach; endif; unset($_from); ?><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?></div>
		</td>
	<?php endif; ?>
	<?php if ($this->_tpl_vars['contact_fields']['0']): ?>
		<td width="35%">
			<?php ob_start(); ?>
				<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('fields' => $this->_tpl_vars['contact_fields']['0'], 'title' => fn_get_lang_var('contact_information', $this->getLanguage()), )); ?><?php $_from = $this->_tpl_vars['fields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['field']):
?>

<?php $this->assign('value', fn_get_profile_field_value($this->_tpl_vars['user_data'], $this->_tpl_vars['field']), false); ?>
<?php if ($this->_tpl_vars['value']): ?>
<div class="info-field <?php echo smarty_modifier_replace($this->_tpl_vars['field']['field_name'], '_', "-"); ?>
"><?php echo $this->_tpl_vars['value']; ?>
</div>
<?php endif; ?>
<?php endforeach; endif; unset($_from); ?><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
			<?php $this->_smarty_vars['capture']['contact_information'] = ob_get_contents(); ob_end_clean(); ?>
			<?php if (trim($this->_smarty_vars['capture']['contact_information']) != ""): ?>
				<h5><?php echo fn_get_lang_var('contact_information', $this->getLanguage()); ?>
</h5>
				<div class="orders-field"><?php echo $this->_smarty_vars['capture']['contact_information']; ?>
</div>
			<?php endif; ?>
		</td>
	<?php endif; ?>
</tr>
</table>