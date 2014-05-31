<?php /* Smarty version 2.6.18, created on 2014-03-10 11:21:24
         compiled from orders/invoice.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'fn_get_company_placement_info', 'orders/invoice.tpl', 14, false),array('modifier', 'default', 'orders/invoice.tpl', 26, false),array('modifier', 'replace', 'orders/invoice.tpl', 66, false),array('modifier', 'date_format', 'orders/invoice.tpl', 82, false),array('modifier', 'fn_get_profile_fields', 'orders/invoice.tpl', 115, false),array('modifier', 'fn_fields_from_multi_level', 'orders/invoice.tpl', 121, false),array('modifier', 'escape', 'orders/invoice.tpl', 125, false),array('modifier', 'trim', 'orders/invoice.tpl', 220, false),array('modifier', 'unescape', 'orders/invoice.tpl', 224, false),array('modifier', 'fn_get_company_name', 'orders/invoice.tpl', 230, false),array('modifier', 'floatval', 'orders/invoice.tpl', 236, false),array('modifier', 'nl2br', 'orders/invoice.tpl', 345, false),array('block', 'hook', 'orders/invoice.tpl', 32, false),)), $this); ?>
<?php if ($this->_tpl_vars['order_info']): ?>

<?php $this->assign('order_header', fn_get_lang_var('invoice', $this->getLanguage()), false); ?>

<?php if ($this->_tpl_vars['status_settings']['appearance_type'] == 'I' && $this->_tpl_vars['order_info']['doc_ids'][$this->_tpl_vars['status_settings']['appearance_type']]): ?>
	<?php $this->assign('doc_id_text', (fn_get_lang_var('invoice', $this->getLanguage()))." #".($this->_tpl_vars['order_info']['doc_ids'][$this->_tpl_vars['status_settings']['appearance_type']]), false); ?>
<?php elseif ($this->_tpl_vars['status_settings']['appearance_type'] == 'C' && $this->_tpl_vars['order_info']['doc_ids'][$this->_tpl_vars['status_settings']['appearance_type']]): ?>
	<?php $this->assign('doc_id_text', (fn_get_lang_var('credit_memo', $this->getLanguage()))." #".($this->_tpl_vars['order_info']['doc_ids'][$this->_tpl_vars['status_settings']['appearance_type']]), false); ?>
	<?php $this->assign('order_header', fn_get_lang_var('credit_memo', $this->getLanguage()), false); ?>
<?php elseif ($this->_tpl_vars['status_settings']['appearance_type'] == 'O'): ?>
	<?php $this->assign('order_header', fn_get_lang_var('order_details', $this->getLanguage()), false); ?>
<?php endif; ?>
<?php if (! $this->_tpl_vars['company_placement_info']): ?>
	<?php $this->assign('company_placement_info', fn_get_company_placement_info($this->_tpl_vars['order_info']['company_id']), false); ?>
<?php endif; ?>

<table cellpadding="0" cellspacing="0" border="0" width="100%" class="main-table" style="height: 100%; background-color: #f4f6f8; font-size: 12px; font-family: Arial;">
<tr>
	<td align="center" style="width: 100%; height: 100%;">
	<table cellpadding="0" cellspacing="0" border="0" style=" width: 602px; table-layout: fixed; margin: 24px 0 24px 0;">
	<tr>
		<td style="background-color: #ffffff; border: 1px solid #e6e6e6; margin: 0px auto 0px auto; padding: 0px 44px 0px 46px; text-align: left;">
			<table cellpadding="0" cellspacing="0" border="0" width="100%" style="padding: 27px 0px 0px 0px; border-bottom: 1px solid #868686; margin-bottom: 8px;">
			<tr>
				<td align="left" style="padding-bottom: 3px;" valign="middle"><img src="<?php if ($this->_tpl_vars['manifest']['Mail_logo']['vendor']): ?><?php echo $this->_tpl_vars['config']['images_path']; ?>
<?php else: ?><?php echo $this->_tpl_vars['images_dir']; ?>
/<?php endif; ?><?php echo $this->_tpl_vars['manifest']['Mail_logo']['filename']; ?>
" width="<?php echo $this->_tpl_vars['manifest']['Mail_logo']['width']; ?>
" height="<?php echo $this->_tpl_vars['manifest']['Mail_logo']['height']; ?>
" border="0" alt="<?php echo $this->_tpl_vars['manifest']['Mail_logo']['alt']; ?>
" /></td>
				<td width="100%" valign="bottom" style="text-align: right;  font: bold 26px Arial; text-transform: uppercase;  margin: 0px;"><?php echo smarty_modifier_default(@$this->_tpl_vars['order_header'], fn_get_lang_var('invoice_title', $this->getLanguage())); ?>
</td>
			</tr>
			</table>

			<table cellpadding="0" cellspacing="0" border="0" width="100%">
			<tr valign="top">
				<?php $this->_tag_stack[] = array('hook', array('name' => "orders:invoice_company_info")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
				<td style="width: 50%; padding: 14px 0px 0px 2px; font-size: 12px; font-family: Arial;">
					<h2 style="font: bold 12px Arial; margin: 0px 0px 3px 0px;"><?php echo $this->_tpl_vars['company_placement_info']['company_name']; ?>
</h2>
					<?php echo $this->_tpl_vars['company_placement_info']['company_address']; ?>
<br />
					<?php echo $this->_tpl_vars['company_placement_info']['company_city']; ?>
<?php if ($this->_tpl_vars['company_placement_info']['company_city'] && ( $this->_tpl_vars['company_placement_info']['company_state_descr'] || $this->_tpl_vars['company_placement_info']['company_zipcode'] )): ?>,<?php endif; ?> <?php echo $this->_tpl_vars['company_placement_info']['company_state_descr']; ?>
 <?php echo $this->_tpl_vars['company_placement_info']['company_zipcode']; ?>
<br />
					<?php echo $this->_tpl_vars['company_placement_info']['company_country_descr']; ?>

					<table cellpadding="0" cellspacing="0" border="0">
					<?php if ($this->_tpl_vars['company_placement_info']['company_phone']): ?>
					<tr valign="top">
						<td style="font-size: 12px; font-family: verdana, helvetica, arial, sans-serif; text-transform: uppercase; color: #000000; padding-right: 10px;	white-space: nowrap;"><?php echo fn_get_lang_var('phone1_label', $this->getLanguage()); ?>
:</td>
						<td width="100%" style="font-size: 12px; font-family: Arial;"><?php echo $this->_tpl_vars['company_placement_info']['company_phone']; ?>
</td>
					</tr>
					<?php endif; ?>
					<?php if ($this->_tpl_vars['company_placement_info']['company_phone_2']): ?>
					<tr valign="top">
						<td style="font-size: 12px; font-family: verdana, helvetica, arial, sans-serif; text-transform: uppercase; color: #000000; padding-right: 10px; white-space: nowrap;"><?php echo fn_get_lang_var('phone2_label', $this->getLanguage()); ?>
:</td>
						<td width="100%" style="font-size: 12px; font-family: Arial;"><?php echo $this->_tpl_vars['company_placement_info']['company_phone_2']; ?>
</td>
					</tr>
					<?php endif; ?>
					<?php if ($this->_tpl_vars['company_placement_info']['company_fax']): ?>
					<tr valign="top">
						<td style="font-size: 12px; font-family: verdana, helvetica, arial, sans-serif; text-transform: uppercase; color: #000000; padding-right: 10px; white-space: nowrap;"><?php echo fn_get_lang_var('fax', $this->getLanguage()); ?>
:</td>
						<td width="100%" style="font-size: 12px; font-family: Arial;"><?php echo $this->_tpl_vars['company_placement_info']['company_fax']; ?>
</td>
					</tr>
					<?php endif; ?>
					<?php if ($this->_tpl_vars['company_placement_info']['company_website']): ?>
					<tr valign="top">
						<td style="font-size: 12px; font-family: verdana, helvetica, arial, sans-serif; text-transform: uppercase; color: #000000; padding-right: 10px; white-space: nowrap;"><?php echo fn_get_lang_var('web_site', $this->getLanguage()); ?>
:</td>
						<td width="100%" style="font-size: 12px; font-family: Arial;"><?php echo $this->_tpl_vars['company_placement_info']['company_website']; ?>
</td>
					</tr>
					<?php endif; ?>
					<?php if ($this->_tpl_vars['company_placement_info']['company_orders_department']): ?>
					<tr valign="top">
						<td style="font-size: 12px; font-family: verdana, helvetica, arial, sans-serif; text-transform: uppercase; color: #000000; padding-right: 10px; white-space: nowrap;"><?php echo fn_get_lang_var('email', $this->getLanguage()); ?>
:</td>
						<td width="100%" style="font-size: 12px; font-family: Arial;"><a href="mailto:<?php echo $this->_tpl_vars['company_placement_info']['company_orders_department']; ?>
"><?php echo smarty_modifier_replace(smarty_modifier_replace($this->_tpl_vars['company_placement_info']['company_orders_department'], ",", "<br>"), ' ', ""); ?>
</a></td>
					</tr>
					<?php endif; ?>
					</table>
				</td>
				<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
				<?php $this->_tag_stack[] = array('hook', array('name' => "orders:invoice_order_status_info")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
				<td style="padding-top: 14px;">
					<h2 style="font: bold 17px Tahoma; margin: 0px;"><?php if ($this->_tpl_vars['doc_id_text']): ?><?php echo $this->_tpl_vars['doc_id_text']; ?>
 <br /><?php endif; ?><?php echo fn_get_lang_var('order', $this->getLanguage()); ?>
&nbsp;#<?php echo $this->_tpl_vars['order_info']['order_id']; ?>
</h2>
					<table cellpadding="0" cellspacing="0" border="0">
					<tr valign="top">
						<td style="font-size: 12px; font-family: verdana, helvetica, arial, sans-serif; text-transform: uppercase; color: #000000; padding-right: 10px; white-space: nowrap;"><?php echo fn_get_lang_var('status', $this->getLanguage()); ?>
:</td>
						<td width="100%" style="font-size: 12px; font-family: Arial;"><?php echo $this->_tpl_vars['order_status']['description']; ?>
</td>
					</tr>
					<tr valign="top">
						<td style="font-size: 12px; font-family: verdana, helvetica, arial, sans-serif; text-transform: uppercase; color: #000000; padding-right: 10px; white-space: nowrap;"><?php echo fn_get_lang_var('date', $this->getLanguage()); ?>
:</td>
						<td style="font-size: 12px; font-family: Arial;"><?php echo smarty_modifier_date_format($this->_tpl_vars['order_info']['timestamp'], ($this->_tpl_vars['settings']['Appearance']['date_format']).", ".($this->_tpl_vars['settings']['Appearance']['time_format'])); ?>
</td>
					</tr>
					<tr valign="top">
						<td style="font-size: 12px; font-family: verdana, helvetica, arial, sans-serif; text-transform: uppercase; color: #000000; padding-right: 10px; white-space: nowrap;"><?php echo fn_get_lang_var('payment_method', $this->getLanguage()); ?>
:</td>
						<td style="font-size: 12px; font-family: Arial;"><?php echo smarty_modifier_default(@$this->_tpl_vars['payment_method']['payment'], " - "); ?>
</td>
					</tr>
					<?php if ($this->_tpl_vars['order_info']['shipping']): ?>
					<tr valign="top">
						<td style="font-size: 12px; font-family: verdana, helvetica, arial, sans-serif; text-transform: uppercase; color: #000000; padding-right: 10px; white-space: nowrap;"><?php echo fn_get_lang_var('shipping_method', $this->getLanguage()); ?>
:</td>
						<td style="font-size: 12px; font-family: Arial;">
							<?php $_from = $this->_tpl_vars['order_info']['shipping']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['f_shipp'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['f_shipp']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['shipping']):
        $this->_foreach['f_shipp']['iteration']++;
?>
								<?php echo $this->_tpl_vars['shipping']['shipping']; ?>
<?php if (! ($this->_foreach['f_shipp']['iteration'] == $this->_foreach['f_shipp']['total'])): ?>, <?php endif; ?>
								<?php if ($this->_tpl_vars['shipping']['tracking_number']): ?><?php $this->assign('tracking_number_exists', 'Y', false); ?><?php endif; ?>
							<?php endforeach; endif; unset($_from); ?></td>
					</tr>
					<?php if ($this->_tpl_vars['tracking_number_exists']): ?>
						<tr valign="top">
							<td style="font-size: 12px; font-family: verdana, helvetica, arial, sans-serif; text-transform: uppercase; color: #000000; padding-right: 10px; white-space: nowrap;"><?php echo fn_get_lang_var('tracking_number', $this->getLanguage()); ?>
:</td>
							<td style="font-size: 12px; font-family: Arial;">
								<?php $_from = $this->_tpl_vars['order_info']['shipping']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['f_shipp'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['f_shipp']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['shipping']):
        $this->_foreach['f_shipp']['iteration']++;
?>
									<?php if ($this->_tpl_vars['shipping']['tracking_number']): ?><?php echo $this->_tpl_vars['shipping']['tracking_number']; ?>
<?php if (! ($this->_foreach['f_shipp']['iteration'] == $this->_foreach['f_shipp']['total'])): ?>,<?php endif; ?><?php endif; ?>
								<?php endforeach; endif; unset($_from); ?></td>
						</tr>
					<?php endif; ?>
					<?php endif; ?>
					</table>
				</td>
				<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
			</tr>
			</table>
		
			<?php $this->_tag_stack[] = array('hook', array('name' => "orders:invoice_customer_info")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
			<?php if (! $this->_tpl_vars['profile_fields']): ?>
			<?php $this->assign('profile_fields', fn_get_profile_fields('I'), false); ?>
			<?php endif; ?>
			<?php if ($this->_tpl_vars['profile_fields']): ?>
			<table cellpadding="0" cellspacing="0" border="0" width="100%" style="padding: 32px 0px 24px 0px;">
			<tr valign="top">
				<?php if ($this->_tpl_vars['profile_fields']['C']): ?>
				<?php $this->assign('profields_c', fn_fields_from_multi_level($this->_tpl_vars['profile_fields']['C'], 'field_name', 'field_id'), false); ?>
				<td width="33%" style="font-size: 12px; font-family: Arial;">
					<h3 style="font: bold 17px Tahoma; padding: 0px 0px 3px 1px; margin: 0px;"><?php echo fn_get_lang_var('customer', $this->getLanguage()); ?>
:</h3>
					<p style="margin: 2px 0px 3px 0px;"><?php if ($this->_tpl_vars['profields_c']['title'] && $this->_tpl_vars['order_info']['title_descr']): ?><?php echo $this->_tpl_vars['order_info']['title_descr']; ?>
 <?php endif; ?><?php if ($this->_tpl_vars['profields_c']['firstname']): ?><?php echo $this->_tpl_vars['order_info']['firstname']; ?>
&nbsp;<?php endif; ?><?php if ($this->_tpl_vars['profields_c']['lastname']): ?><?php echo $this->_tpl_vars['order_info']['lastname']; ?>
<?php endif; ?></p>
					<?php if ($this->_tpl_vars['profields_c']['email']): ?><p style="margin: 2px 0px 3px 0px;"><a href="mailto:<?php echo smarty_modifier_escape($this->_tpl_vars['order_info']['email'], 'url'); ?>
"><?php echo $this->_tpl_vars['order_info']['email']; ?>
</a></p><?php endif; ?>
					<?php if ($this->_tpl_vars['profields_c']['phone']): ?><p style="margin: 2px 0px 3px 0px;"><span style="text-transform: uppercase;"><?php echo fn_get_lang_var('phone', $this->getLanguage()); ?>
:</span>&nbsp;<?php echo $this->_tpl_vars['order_info']['phone']; ?>
</p><?php endif; ?>
					<?php if ($this->_tpl_vars['profields_c']['fax'] && $this->_tpl_vars['order_info']['fax']): ?><p style="margin: 2px 0px 3px 0px;"><span style="text-transform: uppercase;"><?php echo fn_get_lang_var('fax', $this->getLanguage()); ?>
:</span>&nbsp;<?php echo $this->_tpl_vars['order_info']['fax']; ?>
</p><?php endif; ?>
					<?php if ($this->_tpl_vars['profields_c']['company'] && $this->_tpl_vars['order_info']['company']): ?><p style="margin: 2px 0px 3px 0px;"><span style="text-transform: uppercase;"><?php echo fn_get_lang_var('company', $this->getLanguage()); ?>
:</span>&nbsp;<?php echo $this->_tpl_vars['order_info']['company']; ?>
</p><?php endif; ?>
					<?php if ($this->_tpl_vars['profields_c']['url'] && $this->_tpl_vars['order_info']['url']): ?><p style="margin: 2px 0px 3px 0px;"><span style="text-transform: uppercase;"><?php echo fn_get_lang_var('url', $this->getLanguage()); ?>
:</span>&nbsp;<?php echo $this->_tpl_vars['order_info']['url']; ?>
</p><?php endif; ?>
					<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "profiles/profiles_extra_fields.tpl", 'smarty_include_vars' => array('fields' => $this->_tpl_vars['profile_fields']['C'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				</td>
				<?php endif; ?>
				<?php if ($this->_tpl_vars['profile_fields']['B']): ?>
				<?php $this->assign('profields_b', fn_fields_from_multi_level($this->_tpl_vars['profile_fields']['B'], 'field_name', 'field_id'), false); ?>
				<td width="34%" style="font-size: 12px; font-family: Arial; <?php if ($this->_tpl_vars['profile_fields']['S']): ?>padding-right: 10px;<?php endif; ?> <?php if ($this->_tpl_vars['profile_fields']['C']): ?>padding-left: 10px;<?php endif; ?>">
					<h3 style="font: bold 17px Tahoma; padding: 0px 0px 3px 1px; margin: 0px;"><?php echo fn_get_lang_var('bill_to', $this->getLanguage()); ?>
:</h3>
					<?php if ($this->_tpl_vars['order_info']['b_firstname'] && $this->_tpl_vars['profields_b']['b_firstname'] || $this->_tpl_vars['order_info']['b_lastname'] && $this->_tpl_vars['profields_b']['b_lastname']): ?>
					<p style="margin: 2px 0px 3px 0px;">
						<?php if ($this->_tpl_vars['profields_b']['b_firstname']): ?><?php echo $this->_tpl_vars['order_info']['b_firstname']; ?>
 <?php endif; ?><?php if ($this->_tpl_vars['profields_b']['b_lastname']): ?><?php echo $this->_tpl_vars['order_info']['b_lastname']; ?>
<?php endif; ?>
					</p>
					<?php endif; ?>
					<?php if ($this->_tpl_vars['order_info']['b_address'] && $this->_tpl_vars['profields_b']['b_address'] || $this->_tpl_vars['order_info']['b_address_2'] && $this->_tpl_vars['profields_b']['b_address_2']): ?>
					<p style="margin: 2px 0px 3px 0px;">
						<?php if ($this->_tpl_vars['profields_b']['b_address']): ?><?php echo $this->_tpl_vars['order_info']['b_address']; ?>
 <?php endif; ?><?php if ($this->_tpl_vars['profields_b']['b_address_2']): ?><br /><?php echo $this->_tpl_vars['order_info']['b_address_2']; ?>
<?php endif; ?>
					</p>
					<?php endif; ?>
					<?php if ($this->_tpl_vars['order_info']['b_city'] && $this->_tpl_vars['profields_b']['b_city'] || $this->_tpl_vars['order_info']['b_state_descr'] && $this->_tpl_vars['profields_b']['b_state'] || $this->_tpl_vars['order_info']['b_zipcode'] && $this->_tpl_vars['profields_b']['b_zipcode']): ?>
					<p style="margin: 2px 0px 3px 0px;">
						<?php if ($this->_tpl_vars['profields_b']['b_city']): ?><?php echo $this->_tpl_vars['order_info']['b_city']; ?>
<?php if ($this->_tpl_vars['profields_b']['b_state']): ?>,<?php endif; ?> <?php endif; ?><?php if ($this->_tpl_vars['profields_b']['b_state']): ?><?php echo $this->_tpl_vars['order_info']['b_state_descr']; ?>
 <?php endif; ?><?php if ($this->_tpl_vars['profields_b']['b_zipcode']): ?><?php echo $this->_tpl_vars['order_info']['b_zipcode']; ?>
<?php endif; ?>
					</p>
					<?php endif; ?>
					<?php if ($this->_tpl_vars['order_info']['b_country_descr'] && $this->_tpl_vars['profields_b']['b_country']): ?>
					<p style="margin: 2px 0px 3px 0px;">
						<?php echo $this->_tpl_vars['order_info']['b_country_descr']; ?>

					</p>
					<?php endif; ?>
					<?php if ($this->_tpl_vars['order_info']['b_phone'] && $this->_tpl_vars['profields_b']['b_phone']): ?>
					<p style="margin: 2px 0px 3px 0px;">
						<?php if ($this->_tpl_vars['profields_b']['b_phone']): ?><?php echo $this->_tpl_vars['order_info']['b_phone']; ?>
 <?php endif; ?>
					</p>
					<?php endif; ?>
					<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "profiles/profiles_extra_fields.tpl", 'smarty_include_vars' => array('fields' => $this->_tpl_vars['profile_fields']['B'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				</td>
				<?php endif; ?>
				<?php if ($this->_tpl_vars['profile_fields']['S']): ?>
				<?php $this->assign('profields_s', fn_fields_from_multi_level($this->_tpl_vars['profile_fields']['S'], 'field_name', 'field_id'), false); ?>
				<td width="33%" style="font-size: 12px; font-family: Arial;">
					<h3 style="font: bold 17px Tahoma; padding: 0px 0px 3px 1px; margin: 0px;"><?php echo fn_get_lang_var('ship_to', $this->getLanguage()); ?>
:</h3>
					<?php if ($this->_tpl_vars['order_info']['s_firstname'] && $this->_tpl_vars['profields_s']['s_firstname'] || $this->_tpl_vars['order_info']['s_lastname'] && $this->_tpl_vars['profields_s']['s_lastname']): ?>
					<p style="margin: 2px 0px 3px 0px;">
						<?php if ($this->_tpl_vars['profields_s']['s_firstname']): ?><?php echo $this->_tpl_vars['order_info']['s_firstname']; ?>
 <?php endif; ?><?php if ($this->_tpl_vars['profields_s']['s_lastname']): ?><?php echo $this->_tpl_vars['order_info']['s_lastname']; ?>
<?php endif; ?>
					</p>
					<?php endif; ?>
					<?php if ($this->_tpl_vars['order_info']['s_address'] && $this->_tpl_vars['profields_s']['s_address'] || $this->_tpl_vars['order_info']['s_address_2'] && $this->_tpl_vars['profields_s']['s_address_2']): ?>
					<p style="margin: 2px 0px 3px 0px;">
						<?php if ($this->_tpl_vars['profields_s']['s_address']): ?><?php echo $this->_tpl_vars['order_info']['s_address']; ?>
 <?php endif; ?><?php if ($this->_tpl_vars['profields_s']['s_address_2']): ?><br /><?php echo $this->_tpl_vars['order_info']['s_address_2']; ?>
<?php endif; ?>
					</p>
					<?php endif; ?>
					<?php if ($this->_tpl_vars['order_info']['s_city'] && $this->_tpl_vars['profields_s']['s_city'] || $this->_tpl_vars['order_info']['s_state_descr'] && $this->_tpl_vars['profields_s']['s_state'] || $this->_tpl_vars['order_info']['s_zipcode'] && $this->_tpl_vars['profields_s']['s_zipcode']): ?>
					<p style="margin: 2px 0px 3px 0px;">
						<?php if ($this->_tpl_vars['profields_s']['s_city']): ?><?php echo $this->_tpl_vars['order_info']['s_city']; ?>
<?php if ($this->_tpl_vars['profields_s']['s_state']): ?>,<?php endif; ?> <?php endif; ?><?php if ($this->_tpl_vars['profields_s']['s_state']): ?><?php echo $this->_tpl_vars['order_info']['s_state_descr']; ?>
 <?php endif; ?><?php if ($this->_tpl_vars['profields_s']['s_zipcode']): ?><?php echo $this->_tpl_vars['order_info']['s_zipcode']; ?>
<?php endif; ?>
					</p>
					<?php endif; ?>
					<?php if ($this->_tpl_vars['order_info']['s_country_descr'] && $this->_tpl_vars['profields_s']['s_country']): ?>
					<p style="margin: 2px 0px 3px 0px;">
						<?php echo $this->_tpl_vars['order_info']['s_country_descr']; ?>

					</p>
					<?php endif; ?>
					<?php if ($this->_tpl_vars['order_info']['s_phone'] && $this->_tpl_vars['profields_s']['s_phone']): ?>
					<p style="margin: 2px 0px 3px 0px;">
						<?php if ($this->_tpl_vars['profields_s']['s_phone']): ?><?php echo $this->_tpl_vars['order_info']['s_phone']; ?>
 <?php endif; ?>
					</p>
					<?php endif; ?>
					<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "profiles/profiles_extra_fields.tpl", 'smarty_include_vars' => array('fields' => $this->_tpl_vars['profile_fields']['S'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				</td>
				<?php endif; ?>
			</tr>
			</table>
			<?php endif; ?>
			<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
					
		
						
			<table width="100%" cellpadding="0" cellspacing="1" style="background-color: #dddddd;">
			<tr>
				<th width="70%" style="background-color: #eeeeee; padding: 6px 10px; white-space: nowrap; font-size: 12px; font-family: Arial;"><?php echo fn_get_lang_var('product', $this->getLanguage()); ?>
</th>
				<th style="background-color: #eeeeee; padding: 6px 10px; white-space: nowrap; font-size: 12px; font-family: Arial;"><?php echo fn_get_lang_var('quantity', $this->getLanguage()); ?>
</th>
				<th style="background-color: #eeeeee; padding: 6px 10px; white-space: nowrap; font-size: 12px; font-family: Arial;"><?php echo fn_get_lang_var('unit_price', $this->getLanguage()); ?>
</th>
				<?php if ($this->_tpl_vars['order_info']['use_discount']): ?>
					<th style="background-color: #eeeeee; padding: 6px 10px; white-space: nowrap; font-size: 12px; font-family: Arial;"><?php echo fn_get_lang_var('discount', $this->getLanguage()); ?>
</th>
				<?php endif; ?>
				<?php if ($this->_tpl_vars['order_info']['taxes'] && $this->_tpl_vars['settings']['General']['tax_calculation'] != 'subtotal'): ?>
					<th style="background-color: #eeeeee; padding: 6px 10px; white-space: nowrap; font-size: 12px; font-family: Arial;"><?php echo fn_get_lang_var('tax', $this->getLanguage()); ?>
</th>
				<?php endif; ?>
				<th style="background-color: #eeeeee; padding: 6px 10px; white-space: nowrap; font-size: 12px; font-family: Arial;"><?php echo fn_get_lang_var('subtotal', $this->getLanguage()); ?>
</th>
			</tr>
			<?php $_from = $this->_tpl_vars['order_info']['items']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['oi']):
?>
			<?php if ($this->_tpl_vars['addons']['product_configurator']['status'] == 'A'): ?><?php ob_start(); $this->_in_capture[] = 'f13c7ce91a9ed0b3631c4fc14f9d56b6';
$_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/product_configurator/hooks/orders/items_list_row.override.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
$this->_tpl_vars['addon_content'] = ob_get_contents(); ob_end_clean(); array_pop($this->_in_capture); if (!empty($this->_scripts['f13c7ce91a9ed0b3631c4fc14f9d56b6'])) { echo implode("\n", $this->_scripts['f13c7ce91a9ed0b3631c4fc14f9d56b6']); unset($this->_scripts['f13c7ce91a9ed0b3631c4fc14f9d56b6']); }
 ?><?php else: ?><?php $this->assign('addon_content', "", false); ?><?php endif; ?><?php if (trim($this->_tpl_vars['addon_content'])): ?><?php echo $this->_tpl_vars['addon_content']; ?>
<?php else: ?><?php if ($this->_tpl_vars['addons']['bundled_products']['status'] == 'A'): ?><?php ob_start(); $this->_in_capture[] = 'ae0be72039de817148a1a4ef6a0918fb';
$_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/bundled_products/hooks/orders/items_list_row.override.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
$this->_tpl_vars['addon_content'] = ob_get_contents(); ob_end_clean(); array_pop($this->_in_capture); if (!empty($this->_scripts['ae0be72039de817148a1a4ef6a0918fb'])) { echo implode("\n", $this->_scripts['ae0be72039de817148a1a4ef6a0918fb']); unset($this->_scripts['ae0be72039de817148a1a4ef6a0918fb']); }
 ?><?php else: ?><?php $this->assign('addon_content', "", false); ?><?php endif; ?><?php if (trim($this->_tpl_vars['addon_content'])): ?><?php echo $this->_tpl_vars['addon_content']; ?>
<?php else: ?><?php $this->_tag_stack[] = array('hook', array('name' => "orders:items_list_row")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
				<?php if (! $this->_tpl_vars['oi']['extra']['parent']): ?>
				<tr>
					<td style="padding: 5px 10px; background-color: #ffffff; font-size: 12px; font-family: Arial;">
						<?php echo smarty_modifier_default(smarty_modifier_unescape($this->_tpl_vars['oi']['product']), fn_get_lang_var('deleted_product', $this->getLanguage())); ?>

						<?php $this->_tag_stack[] = array('hook', array('name' => "orders:product_info")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php if ($this->_tpl_vars['addons']['recurring_billing']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/recurring_billing/hooks/orders/product_info.pre.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?>
						<?php if ($this->_tpl_vars['oi']['product_code']): ?><p style="margin: 2px 0px 3px 0px;"><?php echo fn_get_lang_var('code', $this->getLanguage()); ?>
: <?php echo $this->_tpl_vars['oi']['product_code']; ?>
</p><?php endif; ?>
						<?php if ($this->_tpl_vars['addons']['gift_certificates']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/gift_certificates/hooks/orders/product_info.post.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php if ($this->_tpl_vars['addons']['reward_points']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/reward_points/hooks/orders/product_info.post.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
						<?php if ($this->_tpl_vars['oi']['product_options']): ?><br/><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/options_info.tpl", 'smarty_include_vars' => array('product_options' => $this->_tpl_vars['oi']['product_options'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?>
						<?php if ($this->_tpl_vars['settings']['Suppliers']['enable_suppliers'] == 'Y' && $this->_tpl_vars['oi']['company_id'] && $this->_tpl_vars['settings']['Suppliers']['display_supplier'] == 'Y'): ?>
							<p style="margin: 2px 0px 3px 0px;"><?php echo fn_get_lang_var('supplier', $this->getLanguage()); ?>
: <?php echo fn_get_company_name($this->_tpl_vars['oi']['company_id']); ?>
</p>
						<?php endif; ?>
					</td>
					<td style="padding: 5px 10px; background-color: #ffffff; text-align: center; font-size: 12px; font-family: Arial;"><?php echo $this->_tpl_vars['oi']['amount']; ?>
</td>
					<td style="padding: 5px 10px; background-color: #ffffff; text-align: right; font-size: 12px; font-family: Arial;"><?php if ($this->_tpl_vars['oi']['extra']['exclude_from_calculate']): ?><?php echo fn_get_lang_var('free', $this->getLanguage()); ?>
<?php else: ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/price.tpl", 'smarty_include_vars' => array('value' => $this->_tpl_vars['oi']['original_price'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?></td>
					<?php if ($this->_tpl_vars['order_info']['use_discount']): ?>
					<td style="padding: 5px 10px; background-color: #ffffff; text-align: right; font-size: 12px; font-family: Arial;"><?php if (floatval($this->_tpl_vars['oi']['extra']['discount'])): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/price.tpl", 'smarty_include_vars' => array('value' => $this->_tpl_vars['oi']['extra']['discount'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php else: ?>&nbsp;-&nbsp;<?php endif; ?></td>
					<?php endif; ?>
					<?php if ($this->_tpl_vars['order_info']['taxes'] && $this->_tpl_vars['settings']['General']['tax_calculation'] != 'subtotal'): ?>
						<td style="padding: 5px 10px; background-color: #ffffff; text-align: right; font-size: 12px; font-family: Arial;"><?php if ($this->_tpl_vars['oi']['tax_value']): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/price.tpl", 'smarty_include_vars' => array('value' => $this->_tpl_vars['oi']['tax_value'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php else: ?>&nbsp;-&nbsp;<?php endif; ?></td>
					<?php endif; ?>
		
					<td style="padding: 5px 10px; background-color: #ffffff; text-align: right; white-space: nowrap; font-size: 12px; font-family: Arial;"><b><?php if ($this->_tpl_vars['oi']['extra']['exclude_from_calculate']): ?><?php echo fn_get_lang_var('free', $this->getLanguage()); ?>
<?php else: ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/price.tpl", 'smarty_include_vars' => array('value' => $this->_tpl_vars['oi']['display_subtotal'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?></b>&nbsp;</td>
				</tr>
				<?php endif; ?>
			<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php endif; ?><?php endif; ?>
			<?php endforeach; endif; unset($_from); ?>
			<?php $this->_tag_stack[] = array('hook', array('name' => "orders:extra_list")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
			<?php if ($this->_tpl_vars['addons']['gift_certificates']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/gift_certificates/hooks/orders/extra_list.post.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
			</table>
		
			<?php $this->_tag_stack[] = array('hook', array('name' => "orders:ordered_products")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
			<?php if ($this->_tpl_vars['addons']['rma']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/rma/hooks/orders/ordered_products.post.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
					
						<table cellpadding="0" cellspacing="0" border="0" width="100%">
			<tr>
				<td align="right">
				<table border="0" style="padding: 3px 0px 12px 0px;">
				<tr>
					<td style="text-align: right; white-space: nowrap; font-size: 12px; font-family: Arial;"><b><?php echo fn_get_lang_var('subtotal', $this->getLanguage()); ?>
:</b>&nbsp;</td>
					<td style="text-align: right; white-space: nowrap; font-size: 12px; font-family: Arial;"><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/price.tpl", 'smarty_include_vars' => array('value' => $this->_tpl_vars['order_info']['display_subtotal'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></td>
				</tr>
				<?php if (floatval($this->_tpl_vars['order_info']['discount'])): ?>
				<tr>
					<td style="text-align: right; white-space: nowrap; font-size: 12px; font-family: Arial;"><b><?php echo fn_get_lang_var('including_discount', $this->getLanguage()); ?>
:</b>&nbsp;</td>
					<td style="text-align: right; white-space: nowrap; font-size: 12px; font-family: Arial;">
						<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/price.tpl", 'smarty_include_vars' => array('value' => $this->_tpl_vars['order_info']['discount'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></td>
				</tr>
				<?php endif; ?>

			
				<?php if (floatval($this->_tpl_vars['order_info']['subtotal_discount'])): ?>
				<tr>
					<td style="text-align: right; white-space: nowrap; font-size: 12px; font-family: Arial;"><?php echo fn_get_lang_var('order_discount', $this->getLanguage()); ?>
:</td>
					<td style="text-align: right; white-space: nowrap; font-size: 12px; font-family: Arial;">
						<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/price.tpl", 'smarty_include_vars' => array('value' => $this->_tpl_vars['order_info']['subtotal_discount'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></td>
				</tr>
				<?php endif; ?>

				<?php if ($this->_tpl_vars['order_info']['coupons']): ?>
				<?php $_from = $this->_tpl_vars['order_info']['coupons']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['coupon']):
?>
				<tr>
					<td style="text-align: right; white-space: nowrap; font-size: 12px; font-family: Arial;"><b><?php echo fn_get_lang_var('coupon', $this->getLanguage()); ?>
:</b>&nbsp;</td>
					<td style="text-align: right; white-space: nowrap; font-size: 12px; font-family: Arial;"><?php echo $this->_tpl_vars['key']; ?>
</td>
				</tr>
				<?php endforeach; endif; unset($_from); ?>
				<?php endif; ?>
				<?php if ($this->_tpl_vars['order_info']['taxes']): ?>
				<tr>
					<td style="text-align: right; white-space: nowrap; font-size: 12px; font-family: Arial;"><b><?php echo fn_get_lang_var('taxes', $this->getLanguage()); ?>
:</b>&nbsp;</td>
					<td style="text-align: right; white-space: nowrap; font-size: 12px; font-family: Arial;">&nbsp;</td>
				</tr>
				<?php $_from = $this->_tpl_vars['order_info']['taxes']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['tax_data']):
?>
				<tr>
					<td style="text-align: right; white-space: nowrap; font-size: 12px; font-family: Arial;"><?php echo $this->_tpl_vars['tax_data']['description']; ?>
&nbsp;<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/modifier.tpl", 'smarty_include_vars' => array('mod_value' => $this->_tpl_vars['tax_data']['rate_value'],'mod_type' => $this->_tpl_vars['tax_data']['rate_type'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php if ($this->_tpl_vars['tax_data']['price_includes_tax'] == 'Y' && ( $this->_tpl_vars['settings']['Appearance']['cart_prices_w_taxes'] != 'Y' || $this->_tpl_vars['settings']['General']['tax_calculation'] == 'subtotal' )): ?>&nbsp;<?php echo fn_get_lang_var('included', $this->getLanguage()); ?>
<?php endif; ?><?php if ($this->_tpl_vars['tax_data']['regnumber']): ?>&nbsp;(<?php echo $this->_tpl_vars['tax_data']['regnumber']; ?>
)<?php endif; ?>:&nbsp;</td>
					<td style="text-align: right; white-space: nowrap; font-size: 12px; font-family: Arial;"><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/price.tpl", 'smarty_include_vars' => array('value' => $this->_tpl_vars['tax_data']['tax_subtotal'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></td>
				</tr>
				<?php endforeach; endif; unset($_from); ?>
				<?php endif; ?>
				<?php if ($this->_tpl_vars['order_info']['tax_exempt'] == 'Y'): ?>
				<tr>
					<td style="text-align: right; white-space: nowrap; font-size: 12px; font-family: Arial;"><b><?php echo fn_get_lang_var('tax_exempt', $this->getLanguage()); ?>
</b></td>
					<td style="text-align: right; white-space: nowrap; font-size: 12px; font-family: Arial;">&nbsp;</td>
				</tr>
				<?php endif; ?>
			
				<?php if (floatval($this->_tpl_vars['order_info']['payment_surcharge']) && ! $this->_tpl_vars['take_surcharge_from_vendor']): ?>
				<tr>
					<td style="text-align: right; white-space: nowrap; font-size: 12px; font-family: Arial;"><?php echo smarty_modifier_default(@$this->_tpl_vars['order_info']['payment_method']['surcharge_title'], fn_get_lang_var('payment_surcharge', $this->getLanguage())); ?>
:&nbsp;</td>
					<td style="text-align: right; white-space: nowrap; font-size: 12px; font-family: Arial;"><b><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/price.tpl", 'smarty_include_vars' => array('value' => $this->_tpl_vars['order_info']['payment_surcharge'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></b></td>
				</tr>
				<?php endif; ?>
			
			
				<?php if ($this->_tpl_vars['order_info']['shipping']): ?>
				<tr>
					<td style="text-align: right; white-space: nowrap; font-size: 12px; font-family: Arial;"><b><?php echo fn_get_lang_var('shipping_cost', $this->getLanguage()); ?>
:</b>&nbsp;</td>
					<td style="text-align: right; white-space: nowrap; font-size: 12px; font-family: Arial;"><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/price.tpl", 'smarty_include_vars' => array('value' => $this->_tpl_vars['order_info']['display_shipping_cost'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></td>
				</tr>
				<?php endif; ?>
				<?php $this->_tag_stack[] = array('hook', array('name' => "orders:totals")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
				<?php if ($this->_tpl_vars['addons']['gift_certificates']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/gift_certificates/hooks/orders/totals.post.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php if ($this->_tpl_vars['addons']['reward_points']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/reward_points/hooks/orders/totals.post.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
				
				<tr>
					<td colspan="2"><hr style="border: 0px solid #d5d5d5; border-top-width: 1px;" /></td>
				</tr>
				<tr>
					<td style="text-align: right; white-space: nowrap; font: 15px Tahoma; text-align: right;"><?php echo fn_get_lang_var('total_cost', $this->getLanguage()); ?>
:&nbsp;</td>
					<td style="text-align: right; white-space: nowrap; font: 15px Tahoma; text-align: right;"><strong style="font: bold 17px Tahoma;"><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/price.tpl", 'smarty_include_vars' => array('value' => $this->_tpl_vars['order_info']['total'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></strong></td>
				</tr>
				</table>
				</td>
			</tr>
			</table>
		
					
			<?php if ($this->_tpl_vars['order_info']['notes']): ?>
			<table cellpadding="0" cellspacing="0" border="0" width="100%">
			<tr valign="top">
				<td style="font-size: 12px; font-family: Arial;"><strong><?php echo fn_get_lang_var('notes', $this->getLanguage()); ?>
:</strong></td>
			</tr>
			<tr valign="top">
				<td><div style="overflow-x: auto; clear: both; width: 510px; height: 100%; padding-bottom: 20px; overflow-y: hidden; font-size: 12px; font-family: Arial;"><?php echo smarty_modifier_nl2br($this->_tpl_vars['order_info']['notes']); ?>
</div></td>
			</tr>
			</table>
			<?php endif; ?>
		
			<?php if ($this->_tpl_vars['content'] == 'invoice'): ?>
			<table cellpadding="0" cellspacing="0" border="0" width="100%" align="center">
			<tr>
				<td>
					<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/continue_shopping.tpl", 'smarty_include_vars' => array('but_href' => smarty_modifier_default(@$this->_tpl_vars['continue_url'], @$this->_tpl_vars['index_script']),'but_arrow' => 'on','skin_area' => 'customer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></td>
				<td align="right">
					<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/button_popup.tpl", 'smarty_include_vars' => array('but_text' => fn_get_lang_var('print_invoice', $this->getLanguage()),'but_href' => "orders.print_invoice?order_id=".($this->_tpl_vars['order_info']['order_id']),'width' => '800','height' => '600','skin_area' => 'customer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></td>
			</tr>
			</table>	
			<?php endif; ?>
		<?php endif; ?>
		
		<?php $this->_tag_stack[] = array('hook', array('name' => "orders:invoice")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
		<?php if ($this->_tpl_vars['addons']['barcode']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/barcode/hooks/orders/invoice.post.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
		</td>
	</tr>
	</table>
	</td>
</tr>
</table>