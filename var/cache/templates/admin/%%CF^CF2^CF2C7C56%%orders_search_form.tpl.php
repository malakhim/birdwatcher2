<?php /* Smarty version 2.6.18, created on 2013-09-23 17:00:39
         compiled from views/orders/components/orders_search_form.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'fn_url', 'views/orders/components/orders_search_form.tpl', 17, false),array('modifier', 'default', 'views/orders/components/orders_search_form.tpl', 74, false),array('modifier', 'fn_check_view_permissions', 'views/orders/components/orders_search_form.tpl', 75, false),array('modifier', 'fn_get_statuses', 'views/orders/components/orders_search_form.tpl', 121, false),array('modifier', 'escape', 'views/orders/components/orders_search_form.tpl', 193, false),array('block', 'hook', 'views/orders/components/orders_search_form.tpl', 103, false),array('function', 'html_options', 'views/orders/components/orders_search_form.tpl', 128, false),array('function', 'html_checkboxes', 'views/orders/components/orders_search_form.tpl', 131, false),array('function', 'math', 'views/orders/components/orders_search_form.tpl', 219, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('customer','search','search','email','total','search','remove_this_item','remove_this_item','tax_exempt','yes','no','order_status','period','order_id','invoice_id','has_invoice','credit_memo_id','has_credit_memo','shipping','payment_methods','new_orders','ordered_products','customer_files','tt_views_orders_components_orders_search_form_customer_files','gift_cert_code','purchased','used','close'));
?>
<?php 

				$rname = !empty($resource_name) ? $resource_name : $params['smarty_include_tpl_file'];
				if ($this->compile_check && empty($inline_no_check[$rname]) && $this->is_cached($rname)) {
					if ($this->check_inline_blocks(array (
  'common_templates/section.tpl' => 1367063753,
))) {
						$_smarty_compile_path = $this->_get_compile_path($rname);
						$this->_compile_resource($rname, $_smarty_compile_path);
						$inline_no_check[$rname] = true;
						include $_smarty_compile_path;
						return;
					}
				}
			 ?><?php ob_start(); ?>

<form action="<?php echo fn_url(""); ?>
" name="orders_search_form" method="get" class="<?php echo $this->_tpl_vars['form_meta']; ?>
">

<?php if ($this->_tpl_vars['_REQUEST']['redirect_url']): ?>
<input type="hidden" name="redirect_url" value="<?php echo $this->_tpl_vars['_REQUEST']['redirect_url']; ?>
" />
<?php endif; ?>
<?php if ($this->_tpl_vars['selected_section'] != ""): ?>
<input type="hidden" id="selected_section" name="selected_section" value="<?php echo $this->_tpl_vars['selected_section']; ?>
" />
<?php endif; ?>

<?php echo $this->_tpl_vars['extra']; ?>


<table cellpadding="10" cellspacing="0" border="0" class="search-header">
<tr>
	<td class="nowrap search-field">
		<label for="cname"><?php echo fn_get_lang_var('customer', $this->getLanguage()); ?>
:</label>
		<div class="break">
			<input type="text" name="cname" id="cname" value="<?php echo $this->_tpl_vars['search']['cname']; ?>
" size="30" class="search-input-text" />
			<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('search' => 'Y', 'but_name' => $this->_tpl_vars['dispatch'], )); ?><input type="hidden" name="dispatch" value="<?php echo $this->_tpl_vars['but_name']; ?>
" />
<input type="image" src="<?php echo $this->_tpl_vars['images_dir']; ?>
/search_go.gif" class="search-go" alt="<?php echo fn_get_lang_var('search', $this->getLanguage()); ?>
" title="<?php echo fn_get_lang_var('search', $this->getLanguage()); ?>
" /><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
		</div>
	</td>
	<td class="search-field">
		<label for="email"><?php echo fn_get_lang_var('email', $this->getLanguage()); ?>
:</label>
		<div class="break">
			<input type="text" name="email" id="email" value="<?php echo $this->_tpl_vars['search']['email']; ?>
" size="30" class="input-text" />
		</div>
	</td>
	<td class="nowrap search-field">
		<label for="total_from"><?php echo fn_get_lang_var('total', $this->getLanguage()); ?>
&nbsp;(<?php echo $this->_tpl_vars['currencies'][$this->_tpl_vars['primary_currency']]['symbol']; ?>
):</label>
		<div class="break">
			<input type="text" name="total_from" id="total_from" value="<?php echo $this->_tpl_vars['search']['total_from']; ?>
" size="3" class="input-text-price" />&nbsp;&ndash;&nbsp;<input type="text" name="total_to" value="<?php echo $this->_tpl_vars['search']['total_to']; ?>
" size="3" class="input-text-price" />
		</div>
	</td>
	<td class="buttons-container">
		<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('but_text' => fn_get_lang_var('search', $this->getLanguage()), 'but_name' => "dispatch[".($this->_tpl_vars['dispatch'])."]", 'but_role' => 'submit', )); ?><?php if ($this->_tpl_vars['but_role'] == 'text'): ?>
	<?php $this->assign('class', "text-link", false); ?>
<?php elseif ($this->_tpl_vars['but_role'] == 'delete'): ?>
	<?php $this->assign('class', "text-button-delete", false); ?>
<?php elseif ($this->_tpl_vars['but_role'] == 'add'): ?>
	<?php $this->assign('class', "text-button text-button-add", false); ?>
<?php elseif ($this->_tpl_vars['but_role'] == 'reload'): ?>
	<?php $this->assign('class', "text-button text-button-reload", false); ?>
<?php elseif ($this->_tpl_vars['but_role'] == 'delete_item'): ?>
	<?php $this->assign('class', "text-button-delete-item", false); ?>
<?php elseif ($this->_tpl_vars['but_role'] == 'edit'): ?>
	<?php $this->assign('class', "text-button-edit", false); ?>
<?php elseif ($this->_tpl_vars['but_role'] == 'tool'): ?>
	<?php $this->assign('class', "tool-link", false); ?>
<?php elseif ($this->_tpl_vars['but_role'] == 'link'): ?>
	<?php $this->assign('class', "text-button-link", false); ?>
<?php elseif ($this->_tpl_vars['but_role'] == 'simple'): ?>
	<?php $this->assign('class', "text-button-simple", false); ?>
<?php else: ?>
	<?php $this->assign('class', "", false); ?>
<?php endif; ?>

<?php if ($this->_tpl_vars['but_name']): ?><?php $this->assign('r', $this->_tpl_vars['but_name'], false); ?><?php else: ?><?php $this->assign('r', $this->_tpl_vars['but_href'], false); ?><?php endif; ?>
<?php $this->assign('method', smarty_modifier_default(@$this->_tpl_vars['method'], 'POST'), false); ?>
<?php if (fn_check_view_permissions($this->_tpl_vars['r'], $this->_tpl_vars['method'])): ?>

<?php if ($this->_tpl_vars['but_name'] || $this->_tpl_vars['but_role'] == 'submit' || $this->_tpl_vars['but_role'] == 'button_main' || $this->_tpl_vars['but_type'] || $this->_tpl_vars['but_role'] == 'big'): ?> 
	<span <?php if ($this->_tpl_vars['but_css']): ?>style="<?php echo $this->_tpl_vars['but_css']; ?>
"<?php endif; ?> class="submit-button<?php if ($this->_tpl_vars['but_role'] == 'big'): ?>-big<?php endif; ?><?php if ($this->_tpl_vars['but_role'] == 'button_main'): ?> cm-button-main<?php endif; ?> <?php echo $this->_tpl_vars['but_meta']; ?>
"><input <?php if ($this->_tpl_vars['but_id']): ?>id="<?php echo $this->_tpl_vars['but_id']; ?>
"<?php endif; ?> <?php if ($this->_tpl_vars['but_meta']): ?>class="<?php echo $this->_tpl_vars['but_meta']; ?>
"<?php endif; ?> type="<?php echo smarty_modifier_default(@$this->_tpl_vars['but_type'], 'submit'); ?>
"<?php if ($this->_tpl_vars['but_name']): ?> name="<?php echo $this->_tpl_vars['but_name']; ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_onclick']): ?> onclick="<?php echo $this->_tpl_vars['but_onclick']; ?>
;<?php if (! $this->_tpl_vars['allow_href']): ?> return false;<?php endif; ?>"<?php endif; ?> value="<?php echo $this->_tpl_vars['but_text']; ?>
" <?php if ($this->_tpl_vars['tabindex']): ?>tabindex="<?php echo $this->_tpl_vars['tabindex']; ?>
"<?php endif; ?> <?php if ($this->_tpl_vars['but_rev']): ?> rev="<?php echo $this->_tpl_vars['but_rev']; ?>
"<?php endif; ?> <?php if ($this->_tpl_vars['but_disabled']): ?>disabled="disabled"<?php endif; ?> /></span>

<?php elseif ($this->_tpl_vars['but_role'] && $this->_tpl_vars['but_role'] != 'submit' && $this->_tpl_vars['but_role'] != 'action' && $this->_tpl_vars['but_role'] != "advanced-search" && $this->_tpl_vars['but_role'] != 'button'): ?> 
	<a <?php if ($this->_tpl_vars['but_id']): ?>id="<?php echo $this->_tpl_vars['but_id']; ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_href']): ?> href="<?php echo fn_url($this->_tpl_vars['but_href']); ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_onclick']): ?> onclick="<?php echo $this->_tpl_vars['but_onclick']; ?>
;<?php if (! $this->_tpl_vars['allow_href']): ?> return false;<?php endif; ?>"<?php endif; ?><?php if ($this->_tpl_vars['but_target']): ?> target="<?php echo $this->_tpl_vars['but_target']; ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_rev']): ?> rev="<?php echo $this->_tpl_vars['but_rev']; ?>
"<?php endif; ?> class="<?php echo $this->_tpl_vars['class']; ?>
<?php if ($this->_tpl_vars['but_meta']): ?> <?php echo $this->_tpl_vars['but_meta']; ?>
<?php endif; ?>"><?php if ($this->_tpl_vars['but_role'] == 'delete_item'): ?><img src="<?php echo $this->_tpl_vars['images_dir']; ?>
/icons/icon_delete.gif" width="12" height="18" border="0" alt="<?php echo fn_get_lang_var('remove_this_item', $this->getLanguage()); ?>
" title="<?php echo fn_get_lang_var('remove_this_item', $this->getLanguage()); ?>
" class="valign" /><?php else: ?><?php echo $this->_tpl_vars['but_text']; ?>
<?php endif; ?></a>

<?php elseif ($this->_tpl_vars['but_role'] == 'action' || $this->_tpl_vars['but_role'] == "advanced-search"): ?> 
	<a <?php if ($this->_tpl_vars['but_id']): ?>id="<?php echo $this->_tpl_vars['but_id']; ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_href']): ?> href="<?php echo fn_url($this->_tpl_vars['but_href']); ?>
"<?php endif; ?> <?php if ($this->_tpl_vars['but_onclick']): ?>onclick="<?php echo $this->_tpl_vars['but_onclick']; ?>
;<?php if (! $this->_tpl_vars['allow_href']): ?> return false;<?php endif; ?>"<?php endif; ?> <?php if ($this->_tpl_vars['but_target']): ?>target="<?php echo $this->_tpl_vars['but_target']; ?>
"<?php endif; ?> <?php if ($this->_tpl_vars['but_rev']): ?> rev="<?php echo $this->_tpl_vars['but_rev']; ?>
"<?php endif; ?> class="button<?php if ($this->_tpl_vars['but_meta']): ?> <?php echo $this->_tpl_vars['but_meta']; ?>
<?php endif; ?>"><?php echo $this->_tpl_vars['but_text']; ?>
<?php if ($this->_tpl_vars['but_role'] == 'action'): ?>&nbsp;<img src="<?php echo $this->_tpl_vars['images_dir']; ?>
/icons/but_arrow.gif" width="8" height="7" border="0" alt=""/><?php endif; ?></a>
	
<?php elseif ($this->_tpl_vars['but_role'] == 'button'): ?>
	<input <?php if ($this->_tpl_vars['but_id']): ?>id="<?php echo $this->_tpl_vars['but_id']; ?>
"<?php endif; ?> <?php if ($this->_tpl_vars['but_meta']): ?>class="<?php echo $this->_tpl_vars['but_meta']; ?>
"<?php endif; ?> type="button" <?php if ($this->_tpl_vars['but_onclick']): ?>onclick="<?php echo $this->_tpl_vars['but_onclick']; ?>
;<?php if (! $this->_tpl_vars['allow_href']): ?> return false;<?php endif; ?>"<?php endif; ?> value="<?php echo $this->_tpl_vars['but_text']; ?>
" <?php if ($this->_tpl_vars['tabindex']): ?>tabindex="<?php echo $this->_tpl_vars['tabindex']; ?>
"<?php endif; ?> <?php if ($this->_tpl_vars['but_rev']): ?> rev="<?php echo $this->_tpl_vars['but_rev']; ?>
"<?php endif; ?> />

<?php elseif ($this->_tpl_vars['but_role'] == 'icon'): ?> 
	<a <?php if ($this->_tpl_vars['but_id']): ?>id="<?php echo $this->_tpl_vars['but_id']; ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_href']): ?> href="<?php echo fn_url($this->_tpl_vars['but_href']); ?>
"<?php endif; ?> <?php if ($this->_tpl_vars['but_onclick']): ?>onclick="<?php echo $this->_tpl_vars['but_onclick']; ?>
;<?php if (! $this->_tpl_vars['allow_href']): ?> return false;<?php endif; ?>"<?php endif; ?> <?php if ($this->_tpl_vars['but_target']): ?>target="<?php echo $this->_tpl_vars['but_target']; ?>
"<?php endif; ?> <?php if ($this->_tpl_vars['but_rev']): ?> rev="<?php echo $this->_tpl_vars['but_rev']; ?>
"<?php endif; ?> class="<?php if ($this->_tpl_vars['but_meta']): ?> <?php echo $this->_tpl_vars['but_meta']; ?>
<?php endif; ?>"><?php echo $this->_tpl_vars['but_text']; ?>
</a>

<?php elseif (! $this->_tpl_vars['but_role']): ?> 
	<input <?php if ($this->_tpl_vars['but_id']): ?>id="<?php echo $this->_tpl_vars['but_id']; ?>
"<?php endif; ?> class="default-button<?php if ($this->_tpl_vars['but_meta']): ?> <?php echo $this->_tpl_vars['but_meta']; ?>
<?php endif; ?>" type="submit" onclick="<?php echo $this->_tpl_vars['but_onclick']; ?>
;<?php if (! $this->_tpl_vars['allow_href']): ?> return false;<?php endif; ?>" value="<?php echo $this->_tpl_vars['but_text']; ?>
" <?php if ($this->_tpl_vars['but_rev']): ?> rev="<?php echo $this->_tpl_vars['but_rev']; ?>
"<?php endif; ?> />
<?php endif; ?>

<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
	</td>
</tr>
</table>

<?php ob_start(); ?>

<?php $this->_tag_stack[] = array('hook', array('name' => "orders:advanced_search")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>

<div class="search-field">
	<label for="tax_exempt"><?php echo fn_get_lang_var('tax_exempt', $this->getLanguage()); ?>
:</label>
	<select name="tax_exempt" id="tax_exempt">
		<option value="">--</option>
		<option value="Y" <?php if ($this->_tpl_vars['search']['tax_exempt'] == 'Y'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('yes', $this->getLanguage()); ?>
</option>
		<option value="N" <?php if ($this->_tpl_vars['search']['tax_exempt'] == 'N'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('no', $this->getLanguage()); ?>
</option>
	</select>
</div>

<?php if ($this->_tpl_vars['incompleted_view']): ?>
	<input type="hidden" name="status" value="<?php echo @STATUS_INCOMPLETED_ORDER; ?>
" />
<?php else: ?>
<div class="search-field">
	<label><?php echo fn_get_lang_var('order_status', $this->getLanguage()); ?>
:</label>
	<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('status' => $this->_tpl_vars['search']['status'], 'display' => 'checkboxes', 'name' => 'status', )); ?><?php if (! $this->_tpl_vars['order_status_descr']): ?>
	<?php if (! $this->_tpl_vars['status_type']): ?><?php $this->assign('status_type', @STATUSES_ORDER, false); ?><?php endif; ?>
	<?php $this->assign('order_status_descr', fn_get_statuses($this->_tpl_vars['status_type'], true), false); ?>
<?php endif; ?>

<?php echo ''; ?><?php if ($this->_tpl_vars['display'] == 'view'): ?><?php echo ''; ?><?php echo $this->_tpl_vars['order_status_descr'][$this->_tpl_vars['status']]; ?><?php echo ''; ?><?php elseif ($this->_tpl_vars['display'] == 'select'): ?><?php echo ''; ?><?php echo smarty_function_html_options(array('name' => $this->_tpl_vars['name'],'options' => $this->_tpl_vars['order_status_descr'],'selected' => $this->_tpl_vars['status'],'id' => $this->_tpl_vars['select_id']), $this);?><?php echo ''; ?><?php elseif ($this->_tpl_vars['display'] == 'checkboxes'): ?><?php echo '<div>'; ?><?php echo smarty_function_html_checkboxes(array('name' => $this->_tpl_vars['name'],'options' => $this->_tpl_vars['order_status_descr'],'selected' => $this->_tpl_vars['status'],'columns' => smarty_modifier_default(@$this->_tpl_vars['columns'], 4)), $this);?><?php echo '</div>'; ?><?php endif; ?><?php echo ''; ?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
</div>
<?php endif; ?>

<div class="search-field">
	<label><?php echo fn_get_lang_var('period', $this->getLanguage()); ?>
:</label>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/period_selector.tpl", 'smarty_include_vars' => array('period' => $this->_tpl_vars['search']['period'],'form_name' => 'orders_search_form')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>

<?php if (@PRODUCT_TYPE == 'MULTIVENDOR' || @PRODUCT_TYPE == 'ULTIMATE'): ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/select_supplier_vendor.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php endif; ?>

<div class="search-field">
	<label for="order_id"><?php echo fn_get_lang_var('order_id', $this->getLanguage()); ?>
:</label>
	<input type="text" name="order_id" id="order_id" value="<?php echo $this->_tpl_vars['search']['order_id']; ?>
" size="10" class="input-text" />
</div>

<div class="search-field">
	<label for="inv_id"><?php echo fn_get_lang_var('invoice_id', $this->getLanguage()); ?>
:</label>
	<input type="text" name="invoice_id" id="inv_id" value="<?php echo $this->_tpl_vars['search']['invoice_id']; ?>
" size="10" class="input-text" />
</div>

<div class="search-field">
	<label for="has_invoice"><?php echo fn_get_lang_var('has_invoice', $this->getLanguage()); ?>
:</label>
	<input type="checkbox" name="has_invoice" id="has_invoice" value="Y" class="checkbox"<?php if ($this->_tpl_vars['search']['has_invoice']): ?> checked="checked"<?php endif; ?> />
</div>

<div class="search-field">
	<label for="crmemo_id"><?php echo fn_get_lang_var('credit_memo_id', $this->getLanguage()); ?>
:</label>
	<input type="text" name="credit_memo_id" id="crmemo_id" value="<?php echo $this->_tpl_vars['search']['credit_memo_id']; ?>
" size="10" class="input-text" />
</div>

<div class="search-field">
	<label for="has_credit_memo"><?php echo fn_get_lang_var('has_credit_memo', $this->getLanguage()); ?>
:</label>
	<input type="checkbox" name="has_credit_memo" id="has_credit_memo" value="Y" class="checkbox"<?php if ($this->_tpl_vars['search']['has_credit_memo']): ?> checked="checked"<?php endif; ?> />
</div>

<div class="search-field">
	<label><?php echo fn_get_lang_var('shipping', $this->getLanguage()); ?>
:</label>
	<?php echo smarty_function_html_checkboxes(array('name' => 'shippings','options' => $this->_tpl_vars['shippings'],'selected' => $this->_tpl_vars['search']['shippings'],'columns' => 4), $this);?>

</div>

<div class="search-field">
	<label><?php echo fn_get_lang_var('payment_methods', $this->getLanguage()); ?>
:</label>
	<?php echo smarty_function_html_checkboxes(array('name' => 'payments','options' => $this->_tpl_vars['payments'],'selected' => $this->_tpl_vars['search']['payments'],'columns' => 4), $this);?>

</div>

<div class="search-field">
	<label for="a_uid"><?php echo fn_get_lang_var('new_orders', $this->getLanguage()); ?>
:</label>
	<input type="checkbox" name="admin_user_id" id="a_uid" value="<?php echo $this->_tpl_vars['auth']['user_id']; ?>
" class="checkbox" <?php if ($this->_tpl_vars['search']['admin_user_id']): ?>checked="checked"<?php endif; ?> />
</div>

<div class="search-field">
	<label><?php echo fn_get_lang_var('ordered_products', $this->getLanguage()); ?>
:</label>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "pickers/search_products_picker.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>

<div class="search-field">
	<label for="custom_files"><?php echo fn_get_lang_var('customer_files', $this->getLanguage()); ?>
<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('tooltip' => fn_get_lang_var('tt_views_orders_components_orders_search_form_customer_files', $this->getLanguage()), )); ?><?php if ($this->_tpl_vars['tooltip']): ?> (<a class="cm-tooltip<?php if ($this->_tpl_vars['params']): ?> <?php echo $this->_tpl_vars['params']; ?>
<?php endif; ?>" title="<?php echo smarty_modifier_escape($this->_tpl_vars['tooltip'], 'html'); ?>
">?</a>)<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>:</label>
	<input type="checkbox" name="custom_files" id="custom_files" value="Y" class="checkbox" <?php if ($this->_tpl_vars['search']['custom_files']): ?>checked="checked"<?php endif; ?> />
</div>

<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

<?php $this->_tag_stack[] = array('hook', array('name' => "orders:search_form")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
<?php if ($this->_tpl_vars['addons']['gift_certificates']['status'] == 'A'): ?><?php $__parent_tpl_vars = $this->_tpl_vars; ?><div class="search-field">
	<label for="gift_cert_code"><?php echo fn_get_lang_var('gift_cert_code', $this->getLanguage()); ?>
:</label>
	<input type="text" name="gift_cert_code" id="gift_cert_code" value="<?php echo $this->_tpl_vars['search']['gift_cert_code']; ?>
" size="30" class="input-text" />
	<select name="gift_cert_in">
		<option value="B|U">--</option>
		<option value="B" <?php if ($this->_tpl_vars['search']['gift_cert_in'] == 'B'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('purchased', $this->getLanguage()); ?>
</option>
		<option value="U" <?php if ($this->_tpl_vars['search']['gift_cert_in'] == 'U'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('used', $this->getLanguage()); ?>
</option>
	</select>
</div><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php endif; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

<?php $this->_smarty_vars['capture']['advanced_search'] = ob_get_contents(); ob_end_clean(); ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/advanced_search.tpl", 'smarty_include_vars' => array('content' => $this->_smarty_vars['capture']['advanced_search'],'dispatch' => $this->_tpl_vars['dispatch'],'view_type' => 'orders')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

</form>

<?php $this->_smarty_vars['capture']['section'] = ob_get_contents(); ob_end_clean(); ?>

<div class="search-form-wrap">
<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('section_content' => $this->_smarty_vars['capture']['section'], )); ?><?php echo smarty_function_math(array('equation' => "rand()",'assign' => 'rnd'), $this);?>

<div class="clear" id="ds_<?php echo $this->_tpl_vars['rnd']; ?>
">
	<div class="section-border">
		<?php echo $this->_tpl_vars['section_content']; ?>

		<?php if ($this->_tpl_vars['section_state']): ?>
			<p align="right">
				<a href="<?php echo fn_url(($this->_tpl_vars['index_script'])."?".($_SERVER['QUERY_STRING'])."&amp;close_section=".($this->_tpl_vars['key'])); ?>
" class="underlined"><?php echo fn_get_lang_var('close', $this->getLanguage()); ?>
</a>
			</p>
		<?php endif; ?>
	</div>
</div><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
</div>