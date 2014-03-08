<?php /* Smarty version 2.6.18, created on 2014-03-08 11:24:15
         compiled from views/shipments/components/new_shipment.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'fn_url', 'views/shipments/components/new_shipment.tpl', 7, false),array('modifier', 'fn_check_view_permissions', 'views/shipments/components/new_shipment.tpl', 42, false),array('modifier', 'unescape', 'views/shipments/components/new_shipment.tpl', 43, false),array('modifier', 'default', 'views/shipments/components/new_shipment.tpl', 43, false),array('modifier', 'fn_get_statuses', 'views/shipments/components/new_shipment.tpl', 111, false),array('function', 'cycle', 'views/shipments/components/new_shipment.tpl', 40, false),array('function', 'math', 'views/shipments/components/new_shipment.tpl', 48, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('general','packages','product','quantity','deleted_product','sku','no_products_for_shipment','options','shipping_method','tracking_number','carrier','usps','ups','fedex','australia_post','dhl','chp','comments','order_status','do_not_change','text_order_status_notification','send_shipment_notification_to_customer','text_shipping_packages_info','package','weight','shipping_method'));
?>
<script type="text/javascript">
//<![CDATA[
	var packages = [];
//]]>
</script>

<form action="<?php echo fn_url(""); ?>
" method="post" name="shipments_form">
<input type="hidden" name="shipment_data[order_id]" value="<?php echo $this->_tpl_vars['order_info']['order_id']; ?>
" />

<?php $_from = $this->_tpl_vars['order_info']['shipping']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['shipping_id'] => $this->_tpl_vars['shipping']):
?>
	<?php if ($this->_tpl_vars['shipping']['packages_info']['packages']): ?>
		<?php $this->assign('has_packages', true, false); ?>
	<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>

<?php if ($this->_tpl_vars['has_packages']): ?>
	<div class="tabs cm-j-tabs">
		<ul>
			<li id="tab_general" class="cm-js cm-active"><a><?php echo fn_get_lang_var('general', $this->getLanguage()); ?>
</a></li>
			<li id="tab_packages_info" class="cm-js"><a><?php echo fn_get_lang_var('packages', $this->getLanguage()); ?>
</a></li>
		</ul>
	</div>
<?php endif; ?>

<div class="cm-tabs-content" id="tabs_content">
	<div id="content_tab_general">

		<table cellpadding="0" cellspacing="0" border="0" width="100%" class="table">
		<tr>
			<th><?php echo fn_get_lang_var('product', $this->getLanguage()); ?>
</th>
			<th width="5%"><?php echo fn_get_lang_var('quantity', $this->getLanguage()); ?>
</th>
		</tr>

		<?php $this->assign('shipment_products', false, false); ?>

		<?php $_from = $this->_tpl_vars['order_info']['items']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['product']):
?>
			<?php if ($this->_tpl_vars['product']['shipment_amount'] > 0): ?>
			<?php $this->assign('shipment_products', true, false); ?>
			
			<tr <?php echo smarty_function_cycle(array('values' => "class=\"table-row\", ",'name' => 'class_cycle'), $this);?>
>
				<td>
					<?php $this->assign('may_display_product_update_link', fn_check_view_permissions("products.update"), false); ?>
					<?php if ($this->_tpl_vars['may_display_product_update_link'] && ! $this->_tpl_vars['product']['deleted_product']): ?><a href="<?php echo fn_url("products.update?product_id=".($this->_tpl_vars['product']['product_id'])); ?>
"><?php endif; ?><?php echo smarty_modifier_default(smarty_modifier_unescape($this->_tpl_vars['product']['product']), fn_get_lang_var('deleted_product', $this->getLanguage())); ?>
<?php if ($this->_tpl_vars['may_display_product_update_link']): ?></a><?php endif; ?>
					<?php if ($this->_tpl_vars['product']['product_code']): ?><p><?php echo fn_get_lang_var('sku', $this->getLanguage()); ?>
:&nbsp;<?php echo $this->_tpl_vars['product']['product_code']; ?>
</p><?php endif; ?>
					<?php if ($this->_tpl_vars['product']['product_options']): ?><div class="options-info"><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/options_info.tpl", 'smarty_include_vars' => array('product_options' => $this->_tpl_vars['product']['product_options'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></div><?php endif; ?>
				</td>
				<td class="center" nowrap="nowrap">
						<?php echo smarty_function_math(array('equation' => "amount + 1",'amount' => $this->_tpl_vars['product']['shipment_amount'],'assign' => 'loop_amount'), $this);?>

						<?php if ($this->_tpl_vars['loop_amount'] <= 100): ?>
							<select id="shipment_data_<?php echo $this->_tpl_vars['key']; ?>
" class="cm-shipments-product" name="shipment_data[products][<?php echo $this->_tpl_vars['key']; ?>
]">
								<option value="0">0</option>
							<?php unset($this->_sections['amount']);
$this->_sections['amount']['name'] = 'amount';
$this->_sections['amount']['start'] = (int)1;
$this->_sections['amount']['loop'] = is_array($_loop=$this->_tpl_vars['loop_amount']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['amount']['show'] = true;
$this->_sections['amount']['max'] = $this->_sections['amount']['loop'];
$this->_sections['amount']['step'] = 1;
if ($this->_sections['amount']['start'] < 0)
    $this->_sections['amount']['start'] = max($this->_sections['amount']['step'] > 0 ? 0 : -1, $this->_sections['amount']['loop'] + $this->_sections['amount']['start']);
else
    $this->_sections['amount']['start'] = min($this->_sections['amount']['start'], $this->_sections['amount']['step'] > 0 ? $this->_sections['amount']['loop'] : $this->_sections['amount']['loop']-1);
if ($this->_sections['amount']['show']) {
    $this->_sections['amount']['total'] = min(ceil(($this->_sections['amount']['step'] > 0 ? $this->_sections['amount']['loop'] - $this->_sections['amount']['start'] : $this->_sections['amount']['start']+1)/abs($this->_sections['amount']['step'])), $this->_sections['amount']['max']);
    if ($this->_sections['amount']['total'] == 0)
        $this->_sections['amount']['show'] = false;
} else
    $this->_sections['amount']['total'] = 0;
if ($this->_sections['amount']['show']):

            for ($this->_sections['amount']['index'] = $this->_sections['amount']['start'], $this->_sections['amount']['iteration'] = 1;
                 $this->_sections['amount']['iteration'] <= $this->_sections['amount']['total'];
                 $this->_sections['amount']['index'] += $this->_sections['amount']['step'], $this->_sections['amount']['iteration']++):
$this->_sections['amount']['rownum'] = $this->_sections['amount']['iteration'];
$this->_sections['amount']['index_prev'] = $this->_sections['amount']['index'] - $this->_sections['amount']['step'];
$this->_sections['amount']['index_next'] = $this->_sections['amount']['index'] + $this->_sections['amount']['step'];
$this->_sections['amount']['first']      = ($this->_sections['amount']['iteration'] == 1);
$this->_sections['amount']['last']       = ($this->_sections['amount']['iteration'] == $this->_sections['amount']['total']);
?>
								<option value="<?php echo $this->_sections['amount']['index']; ?>
" <?php if ($this->_sections['amount']['last']): ?>selected="selected"<?php endif; ?>><?php echo $this->_sections['amount']['index']; ?>
</option>
							<?php endfor; endif; ?>
							</select>
						<?php else: ?>
							<input id="shipment_data_<?php echo $this->_tpl_vars['key']; ?>
" type="text" class="input-text" size="3" name="shipment_data[products][<?php echo $this->_tpl_vars['key']; ?>
]" value="<?php echo $this->_tpl_vars['product']['shipment_amount']; ?>
" />&nbsp;of&nbsp;<?php echo $this->_tpl_vars['product']['shipment_amount']; ?>

						<?php endif; ?>
				</td>
			</tr>
			<?php endif; ?>
		<?php endforeach; endif; unset($_from); ?>

		<?php if (! $this->_tpl_vars['shipment_products']): ?>
			<tr>
				<td colspan="2"><?php echo fn_get_lang_var('no_products_for_shipment', $this->getLanguage()); ?>
</td>
			</tr>
		<?php endif; ?>

		</table>

		<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/subheader.tpl", 'smarty_include_vars' => array('title' => fn_get_lang_var('options', $this->getLanguage()))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

		<fieldset>
			<div class="form-field">
				<label for="shipping_name"><?php echo fn_get_lang_var('shipping_method', $this->getLanguage()); ?>
:</label>
				<select	name="shipment_data[shipping_id]" id="shipping_name">
					<?php $_from = $this->_tpl_vars['shippings']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['shipping']):
?>
						<option	value="<?php echo $this->_tpl_vars['shipping']['shipping_id']; ?>
"><?php echo $this->_tpl_vars['shipping']['shipping']; ?>
</option>
					<?php endforeach; endif; unset($_from); ?>
				</select>
			</div>
			
			<div class="form-field">
				<label for="tracking_number"><?php echo fn_get_lang_var('tracking_number', $this->getLanguage()); ?>
:</label>
				<input type="text" name="shipment_data[tracking_number]" id="tracking_number" size="10" value="" class="input-text-medium" />
			</div>
			
			<div class="form-field">
				<label for="carrier_key"><?php echo fn_get_lang_var('carrier', $this->getLanguage()); ?>
:</label>
				<select id="carrier_key" name="shipment_data[carrier]">
					<option value="">--</option>
					<option value="USP"><?php echo fn_get_lang_var('usps', $this->getLanguage()); ?>
</option>
					<option value="UPS"><?php echo fn_get_lang_var('ups', $this->getLanguage()); ?>
</option>
					<option value="FDX"><?php echo fn_get_lang_var('fedex', $this->getLanguage()); ?>
</option>
					<option value="AUP"><?php echo fn_get_lang_var('australia_post', $this->getLanguage()); ?>
</option>
					<option value="DHL"><?php echo fn_get_lang_var('dhl', $this->getLanguage()); ?>
</option>
					<option value="CHP"><?php echo fn_get_lang_var('chp', $this->getLanguage()); ?>
</option>
				</select>
			</div>
			
			<div class="form-field">
				<label for="shipment_comments"><?php echo fn_get_lang_var('comments', $this->getLanguage()); ?>
:</label>
				<textarea id="shipment_comments" name="shipment_data[comments]" cols="55" rows="8" class="input-textarea-long"></textarea>
			</div>
			
			<div class="form-field">
				<label for="order_status"><?php echo fn_get_lang_var('order_status', $this->getLanguage()); ?>
:</label>
				<select id="order_status" name="shipment_data[order_status]">
					<option value=""><?php echo fn_get_lang_var('do_not_change', $this->getLanguage()); ?>
</option>
					<?php $_from = fn_get_statuses(@STATUSES_ORDER, true); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['status']):
?>
						<option value="<?php echo $this->_tpl_vars['key']; ?>
"><?php echo $this->_tpl_vars['status']; ?>
</option>
					<?php endforeach; endif; unset($_from); ?>
				</select>
				<p class="description">
					<?php echo fn_get_lang_var('text_order_status_notification', $this->getLanguage()); ?>

				</p>
			</div>
		</fieldset>

		<div class="cm-toggle-button">
			<div class="select-field notify-customer">
				<input type="checkbox" name="notify_user" id="shipment_notify_user" value="Y" class="checkbox" />
				<label for="shipment_notify_user"><?php echo fn_get_lang_var('send_shipment_notification_to_customer', $this->getLanguage()); ?>
</label>
			</div>
		</div>
	</div>
	
	<?php if ($this->_tpl_vars['has_packages']): ?>
		<div id="content_tab_packages_info">
			<span class="packages-info"><?php echo fn_get_lang_var('text_shipping_packages_info', $this->getLanguage()); ?>
</span>
			<?php $this->assign('package_num', '1', false); ?>

			<?php $_from = $this->_tpl_vars['order_info']['shipping']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['shipping_id'] => $this->_tpl_vars['shipping']):
?>
				<?php $_from = $this->_tpl_vars['shipping']['packages_info']['packages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['package_id'] => $this->_tpl_vars['package']):
?>
					<?php $this->assign('allowed', true, false); ?>
					
					<?php ob_start(); ?>
					<div class="package-container">
																		
						<script type="text/javascript">
						//<![CDATA[
							packages['package_<?php echo $this->_tpl_vars['shipping_id']; ?>
<?php echo $this->_tpl_vars['package_id']; ?>
'] = [];
						//]]>
						</script>
						<h3>
						<?php echo fn_get_lang_var('package', $this->getLanguage()); ?>
 <?php echo $this->_tpl_vars['package_num']; ?>
 <?php if ($this->_tpl_vars['package']['shipping_params']): ?>(<?php echo $this->_tpl_vars['package']['shipping_params']['box_length']; ?>
 x <?php echo $this->_tpl_vars['package']['shipping_params']['box_width']; ?>
 x <?php echo $this->_tpl_vars['package']['shipping_params']['box_height']; ?>
)<?php endif; ?>						</h3>
						<ul>
						<?php $_from = $this->_tpl_vars['package']['products']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['cart_id'] => $this->_tpl_vars['amount']):
?>
							<script type="text/javascript">
							//<![CDATA[
								packages['package_<?php echo $this->_tpl_vars['shipping_id']; ?>
<?php echo $this->_tpl_vars['package_id']; ?>
']['<?php echo $this->_tpl_vars['cart_id']; ?>
'] = '<?php echo $this->_tpl_vars['amount']; ?>
';
							//]]>
							</script>
							<?php if ($this->_tpl_vars['order_info']['items'][$this->_tpl_vars['cart_id']]): ?>
								<li><span><?php echo $this->_tpl_vars['amount']; ?>
</span> x <?php echo $this->_tpl_vars['order_info']['items'][$this->_tpl_vars['cart_id']]['product']; ?>
 <?php if ($this->_tpl_vars['order_info']['items'][$this->_tpl_vars['cart_id']]['product_options']): ?>(<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/options_info.tpl", 'smarty_include_vars' => array('product_options' => $this->_tpl_vars['order_info']['items'][$this->_tpl_vars['cart_id']]['product_options'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>)<?php endif; ?></li>
							<?php else: ?>
								<?php $this->assign('allowed', false, false); ?>
							<?php endif; ?>
						<?php endforeach; endif; unset($_from); ?>
						</ul>
						<span class="strong"><?php echo fn_get_lang_var('weight', $this->getLanguage()); ?>
:</span> <?php echo $this->_tpl_vars['package']['weight']; ?>
<br />
						<span class="strong"><?php echo fn_get_lang_var('shipping_method', $this->getLanguage()); ?>
:</span> <?php echo $this->_tpl_vars['shipping']['shipping']; ?>

					</div>
										<?php $this->_smarty_vars['capture']['package_container'] = ob_get_contents(); ob_end_clean(); ?>
					
					<?php if ($this->_tpl_vars['allowed']): ?>
						<?php echo $this->_smarty_vars['capture']['package_container']; ?>

					<?php endif; ?>
					
					<?php echo smarty_function_math(array('equation' => "num + 1",'num' => $this->_tpl_vars['package_num'],'assign' => 'package_num'), $this);?>

				<?php endforeach; endif; unset($_from); ?>
			<?php endforeach; endif; unset($_from); ?>
		</div>
	<?php endif; ?>
</div>

<div class="buttons-container">
	<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/save_cancel.tpl", 'smarty_include_vars' => array('create' => true,'but_name' => "dispatch[shipments.add]",'cancel_action' => 'close')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>


</form>

<?php echo '
<script type="text/javascript">
//<![CDATA[
	function fn_calculate_packages()
	{
		var products = [];
		
		$(\'.cm-shipments-package:checked\').each(function(id, elm) {
			jelm = $(elm);
			id = jelm.attr(\'id\');
			
			for (var i in packages[id]) {
				if (typeof(products[i]) == \'undefined\') {
					products[i] = parseInt(packages[id][i]);
				} else {
					products[i] += parseInt(packages[id][i]);
				}
			}
		});
		
		// Set the values of the ship products to 0. We will change the values to the correct variants after
		$(\'.cm-shipments-product\').each(function() {
			$(this).val(0);
		});
		
		if (products.length > 0) {
			for (var i in products) {
				$(\'#shipment_data_\' + i).val(products[i]);
			}
		}
	}
	$(function() {
		$(\'.cm-shipments-package\').bind(\'change\', fn_calculate_packages);
	});
//]]>
</script>
'; ?>