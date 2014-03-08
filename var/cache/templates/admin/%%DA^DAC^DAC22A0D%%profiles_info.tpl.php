<?php /* Smarty version 2.6.18, created on 2014-03-08 11:24:15
         compiled from views/profiles/components/profiles_info.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'fn_get_profile_fields', 'views/profiles/components/profiles_info.tpl', 15, false),array('modifier', 'fn_get_profile_field_value', 'views/profiles/components/profiles_info.tpl', 41, false),array('modifier', 'default', 'views/profiles/components/profiles_info.tpl', 50, false),array('modifier', 'escape', 'views/profiles/components/profiles_info.tpl', 130, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('billing_address','zip_postal_code','shipping_address','address_type','ip_address','phone','fax','company','website','attention','notice_update_customer_details','update_customer_info'));
?>
<?php 

				$rname = !empty($resource_name) ? $resource_name : $params['smarty_include_tpl_file'];
				if ($this->compile_check && empty($inline_no_check[$rname]) && $this->is_cached($rname)) {
					if ($this->check_inline_blocks(array (
  'views/profiles/components/profile_fields_info.tpl' => 1367063755,
))) {
						$_smarty_compile_path = $this->_get_compile_path($rname);
						$this->_compile_resource($rname, $_smarty_compile_path);
						$inline_no_check[$rname] = true;
						include $_smarty_compile_path;
						return;
					}
				}
			 ?><?php $this->assign('profile_fields', fn_get_profile_fields($this->_tpl_vars['location']), false); ?>

<table width="100%" cellpadding="0" cellspacing="0" border="0">
<tr valign="top">
	<td width="<?php if ($this->_tpl_vars['payment_info']): ?>34%<?php else: ?>50%<?php endif; ?>">
		<?php if ($this->_tpl_vars['user_data']['b_firstname'] || $this->_tpl_vars['user_data']['b_lastname'] || $this->_tpl_vars['user_data']['b_address'] || $this->_tpl_vars['user_data']['b_address_2'] || $this->_tpl_vars['user_data']['b_city'] || $this->_tpl_vars['user_data']['b_country_descr'] || $this->_tpl_vars['user_data']['b_state_descr'] || $this->_tpl_vars['user_data']['b_zipcode'] || $this->_tpl_vars['profile_fields']['B']): ?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/subheader.tpl", 'smarty_include_vars' => array('title' => fn_get_lang_var('billing_address', $this->getLanguage()))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<div class="details-block">
			<?php if ($this->_tpl_vars['profile_fields']['B']): ?>
				<?php if ($this->_tpl_vars['user_data']['b_firstname'] || $this->_tpl_vars['user_data']['b_lastname']): ?>
					<p class="strong"><?php echo $this->_tpl_vars['user_data']['b_firstname']; ?>
 <?php echo $this->_tpl_vars['user_data']['b_lastname']; ?>
</p>
				<?php endif; ?>
				<?php if ($this->_tpl_vars['user_data']['b_address']): ?>
					<p><?php echo $this->_tpl_vars['user_data']['b_address']; ?>
</p>
				<?php endif; ?>
				<?php if ($this->_tpl_vars['user_data']['b_address_2']): ?>
					<p><?php echo $this->_tpl_vars['user_data']['b_address_2']; ?>
</p>
				<?php endif; ?>
				<?php if ($this->_tpl_vars['user_data']['b_city'] || $this->_tpl_vars['user_data']['b_state_descr'] || $this->_tpl_vars['user_data']['b_zipcode']): ?>
					<p><?php echo $this->_tpl_vars['user_data']['b_city']; ?>
<?php if ($this->_tpl_vars['user_data']['b_city'] && ( $this->_tpl_vars['user_data']['b_state_descr'] || $this->_tpl_vars['user_data']['b_zipcode'] )): ?>,<?php endif; ?> <?php echo $this->_tpl_vars['user_data']['b_state_descr']; ?>
 <?php echo $this->_tpl_vars['user_data']['b_zipcode']; ?>
</p>
				<?php endif; ?>
				<?php if ($this->_tpl_vars['user_data']['b_country_descr']): ?><p><?php echo $this->_tpl_vars['user_data']['b_country_descr']; ?>
</p><?php endif; ?>
				<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('fields' => $this->_tpl_vars['profile_fields']['B'], )); ?><?php $this->assign('first_field', true, false); ?>
<p>
<?php $_from = $this->_tpl_vars['fields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['fields'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['fields']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['field']):
        $this->_foreach['fields']['iteration']++;
?>
	<?php if (! $this->_tpl_vars['field']['field_name']): ?>
		<?php $this->assign('value', fn_get_profile_field_value($this->_tpl_vars['user_data'], $this->_tpl_vars['field']), false); ?>
		<?php if ($this->_tpl_vars['customer_info']): ?>
			<?php if (! $this->_tpl_vars['first_field']): ?>, <?php endif; ?><span class="additional-fields">
		<?php else: ?>
			<div class="form-field">
		<?php endif; ?>
		<?php $this->assign('first_field', false, false); ?>

			<label><?php echo $this->_tpl_vars['field']['description']; ?>
:</label>
			<?php echo smarty_modifier_default(@$this->_tpl_vars['value'], "-"); ?>


		<?php if ($this->_tpl_vars['customer_info']): ?>
			</span>
		<?php else: ?>
			</div>
		<?php endif; ?>
	<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
</p><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
				<?php if ($this->_tpl_vars['user_data']['b_phone']): ?>
					<p><?php echo $this->_tpl_vars['user_data']['b_phone']; ?>
</p>
				<?php endif; ?>
			<?php endif; ?>
		</div>
		<?php endif; ?>
	</td>
	<td class="details-block-container" width="<?php if ($this->_tpl_vars['payment_info']): ?>34%<?php else: ?>50%<?php endif; ?>">
		<?php if ($this->_tpl_vars['user_data']['s_firstname'] || $this->_tpl_vars['user_data']['s_lastname'] || $this->_tpl_vars['user_data']['s_address'] || $this->_tpl_vars['user_data']['s_address_2'] || $this->_tpl_vars['user_data']['s_city'] || $this->_tpl_vars['user_data']['s_country_descr'] || $this->_tpl_vars['user_data']['s_state_descr'] || fn_get_lang_var('zip_postal_code', $this->getLanguage()) || $this->_tpl_vars['profile_fields']['S']): ?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/subheader.tpl", 'smarty_include_vars' => array('title' => fn_get_lang_var('shipping_address', $this->getLanguage()))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<div class="details-block">
			<?php if ($this->_tpl_vars['profile_fields']['S']): ?>
				<?php if ($this->_tpl_vars['user_data']['s_firstname'] || $this->_tpl_vars['user_data']['s_lastname']): ?>
					<p class="strong"><?php echo $this->_tpl_vars['user_data']['s_firstname']; ?>
 <?php echo $this->_tpl_vars['user_data']['s_lastname']; ?>
</p>
				<?php endif; ?>
				<?php if ($this->_tpl_vars['user_data']['s_address']): ?>
					<p><?php echo $this->_tpl_vars['user_data']['s_address']; ?>
</p>
				<?php endif; ?>
				<?php if ($this->_tpl_vars['user_data']['s_address_2']): ?>
					<p><?php echo $this->_tpl_vars['user_data']['s_address_2']; ?>
</p>
				<?php endif; ?>
				<?php if ($this->_tpl_vars['user_data']['s_city'] || $this->_tpl_vars['user_data']['s_state_descr'] || $this->_tpl_vars['user_data']['s_zipcode']): ?>
					<p><?php echo $this->_tpl_vars['user_data']['s_city']; ?>
<?php if ($this->_tpl_vars['user_data']['s_city'] && ( $this->_tpl_vars['user_data']['s_state_descr'] || $this->_tpl_vars['user_data']['s_zipcode'] )): ?>,<?php endif; ?>  <?php echo $this->_tpl_vars['user_data']['s_state_descr']; ?>
 <?php echo $this->_tpl_vars['user_data']['s_zipcode']; ?>
</p>
				<?php endif; ?>
				<?php if ($this->_tpl_vars['user_data']['s_country_descr']): ?><p><?php echo $this->_tpl_vars['user_data']['s_country_descr']; ?>
</p><?php endif; ?>
				<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('fields' => $this->_tpl_vars['profile_fields']['S'], )); ?><?php $this->assign('first_field', true, false); ?>
<p>
<?php $_from = $this->_tpl_vars['fields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['fields'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['fields']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['field']):
        $this->_foreach['fields']['iteration']++;
?>
	<?php if (! $this->_tpl_vars['field']['field_name']): ?>
		<?php $this->assign('value', fn_get_profile_field_value($this->_tpl_vars['user_data'], $this->_tpl_vars['field']), false); ?>
		<?php if ($this->_tpl_vars['customer_info']): ?>
			<?php if (! $this->_tpl_vars['first_field']): ?>, <?php endif; ?><span class="additional-fields">
		<?php else: ?>
			<div class="form-field">
		<?php endif; ?>
		<?php $this->assign('first_field', false, false); ?>

			<label><?php echo $this->_tpl_vars['field']['description']; ?>
:</label>
			<?php echo smarty_modifier_default(@$this->_tpl_vars['value'], "-"); ?>


		<?php if ($this->_tpl_vars['customer_info']): ?>
			</span>
		<?php else: ?>
			</div>
		<?php endif; ?>
	<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
</p><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
				<?php if ($this->_tpl_vars['user_data']['s_phone']): ?>
					<p><?php echo $this->_tpl_vars['user_data']['s_phone']; ?>
</p>
				<?php endif; ?>
				<?php if ($this->_tpl_vars['user_data']['s_address_type']): ?>
					<p><?php echo fn_get_lang_var('address_type', $this->getLanguage()); ?>
: <?php echo $this->_tpl_vars['user_data']['s_address_type']; ?>
</p>
				<?php endif; ?>
			<?php endif; ?>
		</div>
		<?php endif; ?>
	</td>
</tr>
<?php if ($this->_tpl_vars['user_data']['email'] || $this->_tpl_vars['user_data']['phone'] || $this->_tpl_vars['user_data']['fax'] || $this->_tpl_vars['user_data']['company'] || $this->_tpl_vars['user_data']['url']): ?>
<tr>
	<td colspan="2">
	<div class="details-block clear">
		<?php if ($this->_tpl_vars['user_data']['ip_address']): ?>
			<div class="form-field float-right">
				<label><?php echo fn_get_lang_var('ip_address', $this->getLanguage()); ?>
:</label>
				<?php echo $this->_tpl_vars['user_data']['ip_address']; ?>

			</div>
		<?php endif; ?>
		
		<p class="strong"><?php if ($this->_tpl_vars['user_data']['title_descr']): ?><?php echo $this->_tpl_vars['user_data']['title_descr']; ?>
&nbsp;<?php endif; ?><?php echo $this->_tpl_vars['user_data']['firstname']; ?>
&nbsp;<?php echo $this->_tpl_vars['user_data']['lastname']; ?>
, <a href="mailto:<?php echo smarty_modifier_escape($this->_tpl_vars['user_data']['email'], 'url'); ?>
"><?php echo $this->_tpl_vars['user_data']['email']; ?>
</a></p>
		<div class="clear">
			<div class="left-col">
				<?php if ($this->_tpl_vars['user_data']['phone']): ?>
					<div class="form-field">
						<label><?php echo fn_get_lang_var('phone', $this->getLanguage()); ?>
:</label>
						<span><?php echo $this->_tpl_vars['user_data']['phone']; ?>
</span>
					</div>
				<?php endif; ?>
				<?php if ($this->_tpl_vars['user_data']['fax']): ?>
					<div class="form-field">
						<label><?php echo fn_get_lang_var('fax', $this->getLanguage()); ?>
:</label>
						<span><?php echo $this->_tpl_vars['user_data']['fax']; ?>
</span>
					</div>
				<?php endif; ?>
			</div>
			<div class="float-left">
				<?php if ($this->_tpl_vars['user_data']['company']): ?>
					<div class="form-field">
						<label><?php echo fn_get_lang_var('company', $this->getLanguage()); ?>
:</label>
						<span><?php echo $this->_tpl_vars['user_data']['company']; ?>
</span>
					</div>
				<?php endif; ?>
				<?php if ($this->_tpl_vars['user_data']['url']): ?>
					<div class="form-field">
						<label><?php echo fn_get_lang_var('website', $this->getLanguage()); ?>
:</label>
						<span><?php echo $this->_tpl_vars['user_data']['url']; ?>
</span>
					</div>
				<?php endif; ?>
			</div>
		</div>

		<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('fields' => $this->_tpl_vars['profile_fields']['C'], 'customer_info' => 'Y', )); ?><?php $this->assign('first_field', true, false); ?>
<p>
<?php $_from = $this->_tpl_vars['fields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['fields'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['fields']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['field']):
        $this->_foreach['fields']['iteration']++;
?>
	<?php if (! $this->_tpl_vars['field']['field_name']): ?>
		<?php $this->assign('value', fn_get_profile_field_value($this->_tpl_vars['user_data'], $this->_tpl_vars['field']), false); ?>
		<?php if ($this->_tpl_vars['customer_info']): ?>
			<?php if (! $this->_tpl_vars['first_field']): ?>, <?php endif; ?><span class="additional-fields">
		<?php else: ?>
			<div class="form-field">
		<?php endif; ?>
		<?php $this->assign('first_field', false, false); ?>

			<label><?php echo $this->_tpl_vars['field']['description']; ?>
:</label>
			<?php echo smarty_modifier_default(@$this->_tpl_vars['value'], "-"); ?>


		<?php if ($this->_tpl_vars['customer_info']): ?>
			</span>
		<?php else: ?>
			</div>
		<?php endif; ?>
	<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
</p><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>

		<?php if ($this->_tpl_vars['email_changed']): ?>
			<div class="form-field">
				<label><span class="attention strong"><?php echo fn_get_lang_var('attention', $this->getLanguage()); ?>
</span></label>
				<span class="attention"><?php echo fn_get_lang_var('notice_update_customer_details', $this->getLanguage()); ?>
</span>
			</div>
	
			<div class="select-field">
				<input type="checkbox" name="update_customer_details" id="update_customer_details" value="Y" class="checkbox" />
				<label for="update_customer_details"><?php echo fn_get_lang_var('update_customer_info', $this->getLanguage()); ?>
</label>
			</div>
		<?php endif; ?>
	</div>
	</td>
</tr>
<?php endif; ?>
</table>