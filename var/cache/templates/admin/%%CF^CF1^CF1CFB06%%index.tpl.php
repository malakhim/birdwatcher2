<?php /* Smarty version 2.6.18, created on 2013-07-14 16:49:08
         compiled from views/index/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'views/index/index.tpl', 1, false),array('modifier', 'fn_check_permissions', 'views/index/index.tpl', 16, false),array('modifier', 'fn_url', 'views/index/index.tpl', 27, false),array('modifier', 'format_price', 'views/index/index.tpl', 29, false),array('modifier', 'unescape', 'views/index/index.tpl', 29, false),array('modifier', 'fn_get_statuses', 'views/index/index.tpl', 80, false),array('modifier', 'date_format', 'views/index/index.tpl', 90, false),array('modifier', 'truncate', 'views/index/index.tpl', 109, false),array('modifier', 'defined', 'views/index/index.tpl', 276, false),array('block', 'hook', 'views/index/index.tpl', 20, false),array('function', 'cycle', 'views/index/index.tpl', 133, false),array('function', 'html_options', 'views/index/index.tpl', 143, false),array('function', 'html_checkboxes', 'views/index/index.tpl', 146, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('today','prev','week','prev','month','prev','latest_orders','hide','hide','close','close','order','by','no_items','status','this_day','this_week','this_month','this_year','total_orders','gross_total','totally_paid','category_inventory','total','active','hidden','disabled','product_inventory','total','configurable','in_stock','active','disabled','downloadable','text_out_of_stock','hidden','free_shipping','users','hide','hide','close','close','customers','not_a_member','staff','root_administrators','total','disabled','shortcuts','hide','hide','close','close','manage_products','manage_categories','shipping_methods','payment_methods','general_settings','db_backup_restore','add_inf_page','manage_blocks','send_feedback','feedback_values','dashboard'));
?>
<?php 

				$rname = !empty($resource_name) ? $resource_name : $params['smarty_include_tpl_file'];
				if ($this->compile_check && empty($inline_no_check[$rname]) && $this->is_cached($rname)) {
					if ($this->check_inline_blocks(array (
  'common_templates/subheader_statistic.tpl' => 1367063753,
))) {
						$_smarty_compile_path = $this->_get_compile_path($rname);
						$this->_compile_resource($rname, $_smarty_compile_path);
						$inline_no_check[$rname] = true;
						include $_smarty_compile_path;
						return;
					}
				}
			 ?><?php ob_start(); ?>
<?php $this->assign('show_latest_orders', fn_check_permissions('orders', 'manage', 'admin'), false); ?>
<?php $this->assign('show_orders', fn_check_permissions('sales_reports', 'reports', 'admin'), false); ?>
<?php $this->assign('show_inventory', fn_check_permissions('products', 'manage', 'admin'), false); ?>
<?php $this->assign('show_users', fn_check_permissions('profiles', 'manage', 'admin'), false); ?>
<?php $this->_tag_stack[] = array('hook', array('name' => "index:index")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
<table cellpadding="0" cellspacing="0" border="0" width="100%" class="table-fixed">
<tr valign="top">
<td width="80%">
<?php if ($this->_tpl_vars['show_orders']): ?>
<div class="statistics-box overall">
	<div class="statistics-body">
		<a href="<?php echo fn_url("orders.manage?time_from=".($this->_tpl_vars['date']['today'])."&time_to=".($this->_tpl_vars['date']['TIME'])."&period=C"); ?>
" class="section"><span class="price"><?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('value' => $this->_tpl_vars['orders_stats']['daily_orders']['totals']['total_paid'], )); ?><?php echo ''; ?><?php if ($this->_tpl_vars['settings']['General']['alternative_currency'] == 'Y'): ?><?php echo ''; ?><?php echo smarty_modifier_unescape(smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['primary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], false)); ?><?php echo ''; ?><?php if ($this->_tpl_vars['secondary_currency'] != $this->_tpl_vars['primary_currency']): ?><?php echo '&nbsp;'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo '('; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true, $this->_tpl_vars['is_integer']); ?><?php echo ''; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo ')'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php echo smarty_modifier_unescape(smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true)); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?> </span><u><?php echo fn_get_lang_var('today', $this->getLanguage()); ?>
</u> <span class="block"><?php echo fn_get_lang_var('prev', $this->getLanguage()); ?>
 <?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('value' => $this->_tpl_vars['orders_stats']['daily_orders']['prev_totals']['total_paid'], )); ?><?php echo ''; ?><?php if ($this->_tpl_vars['settings']['General']['alternative_currency'] == 'Y'): ?><?php echo ''; ?><?php echo smarty_modifier_unescape(smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['primary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], false)); ?><?php echo ''; ?><?php if ($this->_tpl_vars['secondary_currency'] != $this->_tpl_vars['primary_currency']): ?><?php echo '&nbsp;'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo '('; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true, $this->_tpl_vars['is_integer']); ?><?php echo ''; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo ')'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php echo smarty_modifier_unescape(smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true)); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?> <span class="percent-<?php if ($this->_tpl_vars['orders_stats']['daily_orders']['totals']['profit'] >= 0): ?>up<?php else: ?>down<?php endif; ?>"><?php if ($this->_tpl_vars['orders_stats']['daily_orders']['totals']['profit']): ?>(<?php if ($this->_tpl_vars['orders_stats']['daily_orders']['totals']['profit'] >= 0): ?>+<?php endif; ?><?php echo $this->_tpl_vars['orders_stats']['daily_orders']['totals']['profit']; ?>
%)<?php endif; ?></span></span></a>
		
		<a href="<?php echo fn_url("orders.manage?time_from=".($this->_tpl_vars['date']['week'])."&time_to=".($this->_tpl_vars['date']['TIME'])."&period=C"); ?>
" class="section"><span class="price"><?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('value' => $this->_tpl_vars['orders_stats']['weekly_orders']['totals']['total_paid'], )); ?><?php echo ''; ?><?php if ($this->_tpl_vars['settings']['General']['alternative_currency'] == 'Y'): ?><?php echo ''; ?><?php echo smarty_modifier_unescape(smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['primary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], false)); ?><?php echo ''; ?><?php if ($this->_tpl_vars['secondary_currency'] != $this->_tpl_vars['primary_currency']): ?><?php echo '&nbsp;'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo '('; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true, $this->_tpl_vars['is_integer']); ?><?php echo ''; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo ')'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php echo smarty_modifier_unescape(smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true)); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?> </span><u><?php echo fn_get_lang_var('week', $this->getLanguage()); ?>
</u> <span class="block"><?php echo fn_get_lang_var('prev', $this->getLanguage()); ?>
 <?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('value' => $this->_tpl_vars['orders_stats']['weekly_orders']['prev_totals']['total_paid'], )); ?><?php echo ''; ?><?php if ($this->_tpl_vars['settings']['General']['alternative_currency'] == 'Y'): ?><?php echo ''; ?><?php echo smarty_modifier_unescape(smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['primary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], false)); ?><?php echo ''; ?><?php if ($this->_tpl_vars['secondary_currency'] != $this->_tpl_vars['primary_currency']): ?><?php echo '&nbsp;'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo '('; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true, $this->_tpl_vars['is_integer']); ?><?php echo ''; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo ')'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php echo smarty_modifier_unescape(smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true)); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?> <span class="percent-<?php if ($this->_tpl_vars['orders_stats']['weekly_orders']['totals']['profit'] >= 0): ?>up<?php else: ?>down<?php endif; ?>"><?php if ($this->_tpl_vars['orders_stats']['weekly_orders']['totals']['profit']): ?>(<?php if ($this->_tpl_vars['orders_stats']['weekly_orders']['totals']['profit'] >= 0): ?>+<?php endif; ?><?php echo $this->_tpl_vars['orders_stats']['weekly_orders']['totals']['profit']; ?>
%)<?php endif; ?></span></span></a>
		
		<a href="<?php echo fn_url("orders.manage?time_from=".($this->_tpl_vars['date']['month'])."&time_to=".($this->_tpl_vars['date']['TIME'])."&period=C"); ?>
" class="section last"><span class="price"><?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('value' => $this->_tpl_vars['orders_stats']['monthly_orders']['totals']['total_paid'], )); ?><?php echo ''; ?><?php if ($this->_tpl_vars['settings']['General']['alternative_currency'] == 'Y'): ?><?php echo ''; ?><?php echo smarty_modifier_unescape(smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['primary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], false)); ?><?php echo ''; ?><?php if ($this->_tpl_vars['secondary_currency'] != $this->_tpl_vars['primary_currency']): ?><?php echo '&nbsp;'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo '('; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true, $this->_tpl_vars['is_integer']); ?><?php echo ''; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo ')'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php echo smarty_modifier_unescape(smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true)); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?> </span><u><?php echo fn_get_lang_var('month', $this->getLanguage()); ?>
</u> <span class="block"><?php echo fn_get_lang_var('prev', $this->getLanguage()); ?>
 <?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('value' => $this->_tpl_vars['orders_stats']['monthly_orders']['prev_totals']['total_paid'], )); ?><?php echo ''; ?><?php if ($this->_tpl_vars['settings']['General']['alternative_currency'] == 'Y'): ?><?php echo ''; ?><?php echo smarty_modifier_unescape(smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['primary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], false)); ?><?php echo ''; ?><?php if ($this->_tpl_vars['secondary_currency'] != $this->_tpl_vars['primary_currency']): ?><?php echo '&nbsp;'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo '('; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true, $this->_tpl_vars['is_integer']); ?><?php echo ''; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo ')'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php echo smarty_modifier_unescape(smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true)); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?> <span class="percent-<?php if ($this->_tpl_vars['orders_stats']['monthly_orders']['totals']['profit'] >= 0): ?>up<?php else: ?>down<?php endif; ?>"><?php if ($this->_tpl_vars['orders_stats']['monthly_orders']['totals']['profit']): ?>(<?php if ($this->_tpl_vars['orders_stats']['monthly_orders']['totals']['profit'] >= 0): ?>+<?php endif; ?><?php echo $this->_tpl_vars['orders_stats']['monthly_orders']['totals']['profit']; ?>
%)<?php endif; ?></span></span></a>
	</div>
</div>
<?php endif; ?>
<?php if ($this->_tpl_vars['show_latest_orders']): ?>
<div class="statistics-box orders">
	<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('title' => fn_get_lang_var('latest_orders', $this->getLanguage()), )); ?><h2>
	<span class="float-right hidden">
		<img src="<?php echo $this->_tpl_vars['images_dir']; ?>
/icons/icon_hide.gif" width="13" height="13" border="0" alt="<?php echo fn_get_lang_var('hide', $this->getLanguage()); ?>
" title="<?php echo fn_get_lang_var('hide', $this->getLanguage()); ?>
" />
		<img src="<?php echo $this->_tpl_vars['images_dir']; ?>
/icons/icon_close.gif" width="13" height="13" border="0" alt="<?php echo fn_get_lang_var('close', $this->getLanguage()); ?>
" title="<?php echo fn_get_lang_var('close', $this->getLanguage()); ?>
" />
	</span>
	<?php echo $this->_tpl_vars['title']; ?>

</h2><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
	<?php $this->assign('order_status_descr', fn_get_statuses(@STATUSES_ORDER, true, true, true), false); ?>
	<div class="statistics-body">
		<?php if ($this->_tpl_vars['latest_orders']): ?>
		<table cellpadding="0" cellspacing="0" border="0" width="100%">
			<?php $this->assign('order_statuses_data', fn_get_statuses(@STATUSES_ORDER, false, $this->_tpl_vars['get_additional_statuses'], true), false); ?>
			<?php $_from = $this->_tpl_vars['latest_orders']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['order']):
?>
			<tr valign="top">
				<td width="17%">
					<?php $this->assign('status_descr', $this->_tpl_vars['order']['status'], false); ?>
					<span class="order-status" style="background-color: #<?php echo $this->_tpl_vars['order_statuses_data'][$this->_tpl_vars['order']['status']]['color']; ?>
"><em><?php echo $this->_tpl_vars['order_status_descr'][$this->_tpl_vars['status_descr']]; ?>
</em></span>
					<p class="order-date"><?php echo smarty_modifier_date_format($this->_tpl_vars['order']['timestamp'], ($this->_tpl_vars['settings']['Appearance']['date_format']).", ".($this->_tpl_vars['settings']['Appearance']['time_format'])); ?>
</p>
				</td>
				<td width="83%" class="order-description">
					<span class="total"><?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('value' => $this->_tpl_vars['order']['total'], )); ?><?php echo ''; ?><?php if ($this->_tpl_vars['settings']['General']['alternative_currency'] == 'Y'): ?><?php echo ''; ?><?php echo smarty_modifier_unescape(smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['primary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], false)); ?><?php echo ''; ?><?php if ($this->_tpl_vars['secondary_currency'] != $this->_tpl_vars['primary_currency']): ?><?php echo '&nbsp;'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo '('; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true, $this->_tpl_vars['is_integer']); ?><?php echo ''; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo ')'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php echo smarty_modifier_unescape(smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true)); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?></span> <a href="<?php echo fn_url("orders.details?order_id=".($this->_tpl_vars['order']['order_id'])); ?>
"><?php echo fn_get_lang_var('order', $this->getLanguage()); ?>
&nbsp;#<?php echo $this->_tpl_vars['order']['order_id']; ?>
</a> <?php echo fn_get_lang_var('by', $this->getLanguage()); ?>
 <?php if ($this->_tpl_vars['order']['user_id']): ?><a href="<?php echo fn_url("profiles.update?user_id=".($this->_tpl_vars['order']['user_id'])); ?>
"><?php endif; ?><?php echo $this->_tpl_vars['order']['firstname']; ?>
 <?php echo $this->_tpl_vars['order']['lastname']; ?>
<?php if ($this->_tpl_vars['order']['user_id']): ?></a><?php endif; ?>
					<div class="product-name">
						<?php ob_start(); ?>
							<?php echo ''; ?><?php $_from = $this->_tpl_vars['order']['items']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['order_items'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['order_items']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['product']):
        $this->_foreach['order_items']['iteration']++;
?><?php echo ''; ?><?php echo $this->_tpl_vars['product']['product']; ?><?php echo ' x '; ?><?php echo $this->_tpl_vars['product']['amount']; ?><?php echo ''; ?><?php if (! ($this->_foreach['order_items']['iteration'] == $this->_foreach['order_items']['total'])): ?><?php echo ', '; ?><?php endif; ?><?php echo ''; ?><?php endforeach; endif; unset($_from); ?><?php echo ''; ?>

						<?php $this->_smarty_vars['capture']['order_products'] = ob_get_contents(); ob_end_clean(); ?>
						<?php echo smarty_modifier_truncate($this->_smarty_vars['capture']['order_products'], 70, "...", true); ?>

					</div>
				</td>
			</tr>
			<?php endforeach; endif; unset($_from); ?>
		</table>
		<?php else: ?>
			<p class="no-items"><?php echo fn_get_lang_var('no_items', $this->getLanguage()); ?>
</p>
		<?php endif; ?>
	</div>
</div>
<?php endif; ?>

<?php if ($this->_tpl_vars['show_orders'] && false): ?> <div class="statistic">
	<table cellpadding="0" cellspacing="0" border="0" width="100%" class="table">
	<tr>
		<th><?php echo fn_get_lang_var('status', $this->getLanguage()); ?>
</th>
		<th class="center"><?php echo fn_get_lang_var('this_day', $this->getLanguage()); ?>
</th>
		<th class="center"><?php echo fn_get_lang_var('this_week', $this->getLanguage()); ?>
</th>
		<th class="center"><?php echo fn_get_lang_var('this_month', $this->getLanguage()); ?>
</th>
		<th class="center"><?php echo fn_get_lang_var('this_year', $this->getLanguage()); ?>
</th>
	</tr>
	<?php $_from = $this->_tpl_vars['order_statuses']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['_status'] => $this->_tpl_vars['status']):
?>
	<tr <?php echo smarty_function_cycle(array('values' => "class=\"table-row\", "), $this);?>
>
		<td><?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('status' => $this->_tpl_vars['_status'], 'display' => 'view', )); ?><?php if (! $this->_tpl_vars['order_status_descr']): ?>
	<?php if (! $this->_tpl_vars['status_type']): ?><?php $this->assign('status_type', @STATUSES_ORDER, false); ?><?php endif; ?>
	<?php $this->assign('order_status_descr', fn_get_statuses($this->_tpl_vars['status_type'], true), false); ?>
<?php endif; ?>

<?php echo ''; ?><?php if ($this->_tpl_vars['display'] == 'view'): ?><?php echo ''; ?><?php echo $this->_tpl_vars['order_status_descr'][$this->_tpl_vars['status']]; ?><?php echo ''; ?><?php elseif ($this->_tpl_vars['display'] == 'select'): ?><?php echo ''; ?><?php echo smarty_function_html_options(array('name' => $this->_tpl_vars['name'],'options' => $this->_tpl_vars['order_status_descr'],'selected' => $this->_tpl_vars['status'],'id' => $this->_tpl_vars['select_id']), $this);?><?php echo ''; ?><?php elseif ($this->_tpl_vars['display'] == 'checkboxes'): ?><?php echo '<div>'; ?><?php echo smarty_function_html_checkboxes(array('name' => $this->_tpl_vars['name'],'options' => $this->_tpl_vars['order_status_descr'],'selected' => $this->_tpl_vars['status'],'columns' => smarty_modifier_default(@$this->_tpl_vars['columns'], 4)), $this);?><?php echo '</div>'; ?><?php endif; ?><?php echo ''; ?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?></td>
		<td class="center"><?php if ($this->_tpl_vars['orders_stats']['daily_orders'][$this->_tpl_vars['_status']]['amount']): ?><a href="<?php echo fn_url("orders.manage?status%5B%5D=".($this->_tpl_vars['_status'])."&amp;period=D"); ?>
"><?php echo $this->_tpl_vars['orders_stats']['daily_orders'][$this->_tpl_vars['_status']]['amount']; ?>
</a><?php else: ?>0<?php endif; ?></td>
		<td class="center"><?php if ($this->_tpl_vars['orders_stats']['weekly_orders'][$this->_tpl_vars['_status']]['amount']): ?><a href="<?php echo fn_url("orders.manage?status%5B%5D=".($this->_tpl_vars['_status'])."&amp;period=W"); ?>
"><?php echo $this->_tpl_vars['orders_stats']['weekly_orders'][$this->_tpl_vars['_status']]['amount']; ?>
</a><?php else: ?>0<?php endif; ?></td>
		<td class="center"><?php if ($this->_tpl_vars['orders_stats']['monthly_orders'][$this->_tpl_vars['_status']]['amount']): ?><a href="<?php echo fn_url("orders.manage?status%5B%5D=".($this->_tpl_vars['_status'])."&amp;period=M"); ?>
"><?php echo $this->_tpl_vars['orders_stats']['monthly_orders'][$this->_tpl_vars['_status']]['amount']; ?>
</a><?php else: ?>0<?php endif; ?></td>
		<td class="center"><?php if ($this->_tpl_vars['orders_stats']['year_orders'][$this->_tpl_vars['_status']]['amount']): ?><a href="<?php echo fn_url("orders.manage?status%5B%5D=".($this->_tpl_vars['_status'])."&amp;period=Y"); ?>
"><?php echo $this->_tpl_vars['orders_stats']['year_orders'][$this->_tpl_vars['_status']]['amount']; ?>
</a><?php else: ?>0<?php endif; ?></td>
	</tr>
	<?php endforeach; endif; unset($_from); ?>
	<tr <?php echo smarty_function_cycle(array('values' => "class=\"table-row\", "), $this);?>
>
		<td><span><?php echo fn_get_lang_var('total_orders', $this->getLanguage()); ?>
</span></td>
		<td class="center"><?php if ($this->_tpl_vars['orders_stats']['daily_orders']['totals']['amount']): ?><a href="<?php echo fn_url("orders.manage?period=D"); ?>
"><?php echo $this->_tpl_vars['orders_stats']['daily_orders']['totals']['amount']; ?>
</a><?php else: ?>0<?php endif; ?></td>
		<td class="center"><?php if ($this->_tpl_vars['orders_stats']['weekly_orders']['totals']['amount']): ?><a href="<?php echo fn_url("orders.manage?period=W"); ?>
"><?php echo $this->_tpl_vars['orders_stats']['weekly_orders']['totals']['amount']; ?>
</a><?php else: ?>0<?php endif; ?></td>
		<td class="center"><?php if ($this->_tpl_vars['orders_stats']['monthly_orders']['totals']['amount']): ?><a href="<?php echo fn_url("orders.manage?period=M"); ?>
"><?php echo $this->_tpl_vars['orders_stats']['monthly_orders']['totals']['amount']; ?>
</a><?php else: ?>0<?php endif; ?></td>
		<td class="center"><?php if ($this->_tpl_vars['orders_stats']['year_orders']['totals']['amount']): ?><a href="<?php echo fn_url("orders.manage?period=Y"); ?>
"><?php echo $this->_tpl_vars['orders_stats']['year_orders']['totals']['amount']; ?>
</a><?php else: ?>0<?php endif; ?></td>
	</tr>
	<tr class="strong">
		<td><?php echo fn_get_lang_var('gross_total', $this->getLanguage()); ?>
</td>
		<td class="center"><?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('value' => smarty_modifier_default(@$this->_tpl_vars['orders_stats']['daily_orders']['totals']['total'], '0'), )); ?><?php echo ''; ?><?php if ($this->_tpl_vars['settings']['General']['alternative_currency'] == 'Y'): ?><?php echo ''; ?><?php echo smarty_modifier_unescape(smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['primary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], false)); ?><?php echo ''; ?><?php if ($this->_tpl_vars['secondary_currency'] != $this->_tpl_vars['primary_currency']): ?><?php echo '&nbsp;'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo '('; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true, $this->_tpl_vars['is_integer']); ?><?php echo ''; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo ')'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php echo smarty_modifier_unescape(smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true)); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?></td>
		<td class="center"><?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('value' => smarty_modifier_default(@$this->_tpl_vars['orders_stats']['weekly_orders']['totals']['total'], '0'), )); ?><?php echo ''; ?><?php if ($this->_tpl_vars['settings']['General']['alternative_currency'] == 'Y'): ?><?php echo ''; ?><?php echo smarty_modifier_unescape(smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['primary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], false)); ?><?php echo ''; ?><?php if ($this->_tpl_vars['secondary_currency'] != $this->_tpl_vars['primary_currency']): ?><?php echo '&nbsp;'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo '('; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true, $this->_tpl_vars['is_integer']); ?><?php echo ''; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo ')'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php echo smarty_modifier_unescape(smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true)); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?></td>
		<td class="center"><?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('value' => smarty_modifier_default(@$this->_tpl_vars['orders_stats']['monthly_orders']['totals']['total'], '0'), )); ?><?php echo ''; ?><?php if ($this->_tpl_vars['settings']['General']['alternative_currency'] == 'Y'): ?><?php echo ''; ?><?php echo smarty_modifier_unescape(smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['primary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], false)); ?><?php echo ''; ?><?php if ($this->_tpl_vars['secondary_currency'] != $this->_tpl_vars['primary_currency']): ?><?php echo '&nbsp;'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo '('; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true, $this->_tpl_vars['is_integer']); ?><?php echo ''; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo ')'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php echo smarty_modifier_unescape(smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true)); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?></td>
		<td class="center"><?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('value' => smarty_modifier_default(@$this->_tpl_vars['orders_stats']['year_orders']['totals']['total'], '0'), )); ?><?php echo ''; ?><?php if ($this->_tpl_vars['settings']['General']['alternative_currency'] == 'Y'): ?><?php echo ''; ?><?php echo smarty_modifier_unescape(smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['primary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], false)); ?><?php echo ''; ?><?php if ($this->_tpl_vars['secondary_currency'] != $this->_tpl_vars['primary_currency']): ?><?php echo '&nbsp;'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo '('; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true, $this->_tpl_vars['is_integer']); ?><?php echo ''; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo ')'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php echo smarty_modifier_unescape(smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true)); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?></td>
	</tr>
	<tr class="strong">
		<td><?php echo fn_get_lang_var('totally_paid', $this->getLanguage()); ?>
</td>
		<td class="center valued-text"><?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('value' => smarty_modifier_default(@$this->_tpl_vars['orders_stats']['daily_orders']['totals']['total_paid'], '0'), )); ?><?php echo ''; ?><?php if ($this->_tpl_vars['settings']['General']['alternative_currency'] == 'Y'): ?><?php echo ''; ?><?php echo smarty_modifier_unescape(smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['primary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], false)); ?><?php echo ''; ?><?php if ($this->_tpl_vars['secondary_currency'] != $this->_tpl_vars['primary_currency']): ?><?php echo '&nbsp;'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo '('; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true, $this->_tpl_vars['is_integer']); ?><?php echo ''; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo ')'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php echo smarty_modifier_unescape(smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true)); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?></td>
		<td class="center valued-text"><?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('value' => smarty_modifier_default(@$this->_tpl_vars['orders_stats']['weekly_orders']['totals']['total_paid'], '0'), )); ?><?php echo ''; ?><?php if ($this->_tpl_vars['settings']['General']['alternative_currency'] == 'Y'): ?><?php echo ''; ?><?php echo smarty_modifier_unescape(smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['primary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], false)); ?><?php echo ''; ?><?php if ($this->_tpl_vars['secondary_currency'] != $this->_tpl_vars['primary_currency']): ?><?php echo '&nbsp;'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo '('; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true, $this->_tpl_vars['is_integer']); ?><?php echo ''; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo ')'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php echo smarty_modifier_unescape(smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true)); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?></td>
		<td class="center valued-text"><?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('value' => smarty_modifier_default(@$this->_tpl_vars['orders_stats']['monthly_orders']['totals']['total_paid'], '0'), )); ?><?php echo ''; ?><?php if ($this->_tpl_vars['settings']['General']['alternative_currency'] == 'Y'): ?><?php echo ''; ?><?php echo smarty_modifier_unescape(smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['primary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], false)); ?><?php echo ''; ?><?php if ($this->_tpl_vars['secondary_currency'] != $this->_tpl_vars['primary_currency']): ?><?php echo '&nbsp;'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo '('; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true, $this->_tpl_vars['is_integer']); ?><?php echo ''; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo ')'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php echo smarty_modifier_unescape(smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true)); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?></td>
		<td class="center valued-text"><?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('value' => smarty_modifier_default(@$this->_tpl_vars['orders_stats']['year_orders']['totals']['total_paid'], '0'), )); ?><?php echo ''; ?><?php if ($this->_tpl_vars['settings']['General']['alternative_currency'] == 'Y'): ?><?php echo ''; ?><?php echo smarty_modifier_unescape(smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['primary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], false)); ?><?php echo ''; ?><?php if ($this->_tpl_vars['secondary_currency'] != $this->_tpl_vars['primary_currency']): ?><?php echo '&nbsp;'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo '('; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true, $this->_tpl_vars['is_integer']); ?><?php echo ''; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo ')'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php echo smarty_modifier_unescape(smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true)); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?></td>
	</tr>

	</table>
</div>
<?php endif; ?>

<?php $this->_tag_stack[] = array('hook', array('name' => "index:extra")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
<?php if ($this->_tpl_vars['addons']['discussion']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/discussion/hooks/index/extra.post.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

</td>

<td width="30px">&nbsp;</td>

<td width="360px">
<?php if ($this->_tpl_vars['show_inventory']): ?>
<div class="statistics-box inventory">
	
	<div class="statistics-body">
		<p class="strong"><?php echo fn_get_lang_var('category_inventory', $this->getLanguage()); ?>
</p>
		<div class="clear">
			<ul>
				<li><?php echo fn_get_lang_var('total', $this->getLanguage()); ?>
:&nbsp;<?php if ($this->_tpl_vars['category_stats']['total']): ?><?php echo $this->_tpl_vars['category_stats']['total']; ?>
<?php else: ?>0<?php endif; ?></li>
				<li><?php echo fn_get_lang_var('active', $this->getLanguage()); ?>
:&nbsp;<?php if ($this->_tpl_vars['category_stats']['status']['A']): ?><?php echo $this->_tpl_vars['category_stats']['status']['A']; ?>
<?php else: ?>0<?php endif; ?></li>
			</ul>
			<ul>
				<li><?php echo fn_get_lang_var('hidden', $this->getLanguage()); ?>
:&nbsp;<?php if ($this->_tpl_vars['category_stats']['status']['H']): ?><?php echo $this->_tpl_vars['category_stats']['status']['H']; ?>
<?php else: ?>0<?php endif; ?></li>
				<li><?php echo fn_get_lang_var('disabled', $this->getLanguage()); ?>
:&nbsp;<?php if ($this->_tpl_vars['category_stats']['status']['D']): ?><?php echo $this->_tpl_vars['category_stats']['status']['D']; ?>
<?php else: ?>0<?php endif; ?></li>
			</ul>
		</div>
		
		<p class="strong product-inventory"><?php echo fn_get_lang_var('product_inventory', $this->getLanguage()); ?>
</p>
		<div class="clear">
			<ul>
				<li><?php echo fn_get_lang_var('total', $this->getLanguage()); ?>
:&nbsp;<?php if ($this->_tpl_vars['product_stats']['total']): ?><a href="<?php echo fn_url("products.manage"); ?>
"><?php echo $this->_tpl_vars['product_stats']['total']; ?>
</a><?php else: ?>0<?php endif; ?></li>
				<?php $this->_tag_stack[] = array('hook', array('name' => "index:inventory")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
				<?php if ($this->_tpl_vars['addons']['product_configurator']['status'] == 'A'): ?><?php $__parent_tpl_vars = $this->_tpl_vars; ?><li><?php echo fn_get_lang_var('configurable', $this->getLanguage()); ?>
:&nbsp;<?php if ($this->_tpl_vars['product_stats']['configurable']): ?><a href="<?php echo fn_url("products.manage?configurable=C"); ?>
"><?php echo $this->_tpl_vars['product_stats']['configurable']; ?>
</a><?php else: ?>0<?php endif; ?></li><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php endif; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
				<li><?php echo fn_get_lang_var('in_stock', $this->getLanguage()); ?>
:&nbsp;<?php if ($this->_tpl_vars['product_stats']['in_stock']): ?><a href="<?php echo fn_url("products.manage?amount_from=1&amp;amount_to=&amp;tracking[]=B&amp;tracking[]=O"); ?>
"><?php echo $this->_tpl_vars['product_stats']['in_stock']; ?>
</a><?php else: ?>0<?php endif; ?></li>
				<li><?php echo fn_get_lang_var('active', $this->getLanguage()); ?>
:&nbsp;<?php if ($this->_tpl_vars['product_stats']['status']['A']): ?><a href="<?php echo fn_url("products.manage?status=A"); ?>
"><?php echo $this->_tpl_vars['product_stats']['status']['A']; ?>
</a><?php else: ?>0<?php endif; ?></li>
				<li><?php echo fn_get_lang_var('disabled', $this->getLanguage()); ?>
:&nbsp;<?php if ($this->_tpl_vars['product_stats']['status']['D']): ?><a href="<?php echo fn_url("products.manage?status=D"); ?>
"><?php echo $this->_tpl_vars['product_stats']['status']['D']; ?>
</a><?php else: ?>0<?php endif; ?></li>
			</ul>
			<ul>
				<li><?php echo fn_get_lang_var('downloadable', $this->getLanguage()); ?>
:&nbsp;<?php if ($this->_tpl_vars['product_stats']['downloadable']): ?><a href="<?php echo fn_url("products.manage?downloadable=Y"); ?>
"><?php echo $this->_tpl_vars['product_stats']['downloadable']; ?>
</a><?php else: ?>0<?php endif; ?></li>
				<li><?php echo fn_get_lang_var('text_out_of_stock', $this->getLanguage()); ?>
:&nbsp;<?php if ($this->_tpl_vars['product_stats']['out_of_stock']): ?><a href="<?php echo fn_url("products.manage?amount_from=&amp;amount_to=0&amp;tracking[]=B&amp;tracking[]=O"); ?>
"><?php echo $this->_tpl_vars['product_stats']['out_of_stock']; ?>
</a><?php else: ?>0<?php endif; ?></li>
				<li><?php echo fn_get_lang_var('hidden', $this->getLanguage()); ?>
:&nbsp;<?php if ($this->_tpl_vars['product_stats']['status']['H']): ?><a href="<?php echo fn_url("products.manage?status=H"); ?>
"><?php echo $this->_tpl_vars['product_stats']['status']['H']; ?>
</a><?php else: ?>0<?php endif; ?></li>

				<li><?php echo fn_get_lang_var('free_shipping', $this->getLanguage()); ?>
:&nbsp;<?php if ($this->_tpl_vars['product_stats']['free_shipping']): ?><a href="<?php echo fn_url("products.manage?free_shipping=Y"); ?>
"><?php echo $this->_tpl_vars['product_stats']['free_shipping']; ?>
</a><?php else: ?>0<?php endif; ?></li>
			</ul>
		</div>
	</div>
</div>
<?php endif; ?>

<?php if (! defined('COMPANY_ID') && ! defined('RESTRICTED_ADMIN')): ?>
<?php if ($this->_tpl_vars['show_users']): ?>
<div class="statistics-box users">
	<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('title' => fn_get_lang_var('users', $this->getLanguage()), )); ?><h2>
	<span class="float-right hidden">
		<img src="<?php echo $this->_tpl_vars['images_dir']; ?>
/icons/icon_hide.gif" width="13" height="13" border="0" alt="<?php echo fn_get_lang_var('hide', $this->getLanguage()); ?>
" title="<?php echo fn_get_lang_var('hide', $this->getLanguage()); ?>
" />
		<img src="<?php echo $this->_tpl_vars['images_dir']; ?>
/icons/icon_close.gif" width="13" height="13" border="0" alt="<?php echo fn_get_lang_var('close', $this->getLanguage()); ?>
" title="<?php echo fn_get_lang_var('close', $this->getLanguage()); ?>
" />
	</span>
	<?php echo $this->_tpl_vars['title']; ?>

</h2><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
	
	<div class="statistics-body clear">
	<ul>
		<li class="customer-users">
			<span><?php echo fn_get_lang_var('customers', $this->getLanguage()); ?>
:</span>
			<em><?php if ($this->_tpl_vars['users_stats']['total']['C']): ?><a href="<?php echo fn_url("profiles.manage?user_type=C"); ?>
"><?php echo $this->_tpl_vars['users_stats']['total']['C']; ?>
</a><?php else: ?>0<?php endif; ?></em>
		</li>

		<?php if ($this->_tpl_vars['usergroups_type']['C']): ?>
		<li>
			<span><?php echo fn_get_lang_var('not_a_member', $this->getLanguage()); ?>
:</span>
			<em><?php if ($this->_tpl_vars['users_stats']['not_members']['C']): ?><a href="<?php echo fn_url("profiles.manage?usergroup_id=0&amp;user_type=C"); ?>
"><?php echo $this->_tpl_vars['users_stats']['not_members']['C']; ?>
</a><?php else: ?>0<?php endif; ?></em>
		</li>
		<?php endif; ?>
		
		<?php $_from = $this->_tpl_vars['usergroups']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['mem_id'] => $this->_tpl_vars['mem_name']):
?>
		<?php if ($this->_tpl_vars['mem_name']['type'] == 'C'): ?>
			<li>
				<span><?php echo $this->_tpl_vars['mem_name']['usergroup']; ?>
:</span>
				<em><?php if ($this->_tpl_vars['users_stats']['usergroup']['C'][$this->_tpl_vars['mem_id']]): ?><a href="<?php echo fn_url("profiles.manage?usergroup_id=".($this->_tpl_vars['mem_id'])); ?>
"><?php echo $this->_tpl_vars['users_stats']['usergroup']['C'][$this->_tpl_vars['mem_id']]; ?>
</a><?php else: ?>0<?php endif; ?></em>
			</li>
		<?php endif; ?>
		<?php endforeach; endif; unset($_from); ?>
		
		<li class="staff-users">
			<span><?php echo fn_get_lang_var('staff', $this->getLanguage()); ?>
:</span>

			
			<?php $this->assign('staff_total', ($this->_tpl_vars['users_stats']['total']['A']+$this->_tpl_vars['users_stats']['total']['V']), false); ?>
			<em><?php if ($this->_tpl_vars['staff_total']): ?><a href="<?php echo fn_url("profiles.manage?user_types[]=A&user_types[]=V"); ?>
"><?php echo $this->_tpl_vars['staff_total']; ?>
</a><?php else: ?>0<?php endif; ?></em>
			
		</li>

		<?php if ($this->_tpl_vars['usergroups_type']['A']): ?>
		<li>
			<span><?php echo fn_get_lang_var('root_administrators', $this->getLanguage()); ?>
:</span>

			
			<?php $this->assign('not_members_total', ($this->_tpl_vars['users_stats']['not_members']['A']+$this->_tpl_vars['users_stats']['not_members']['V']), false); ?>
			<em><?php if ($this->_tpl_vars['not_members_total']): ?><a href="<?php echo fn_url("profiles.manage?usergroup_id=0&amp;user_types[]=A&amp;user_types[]=V"); ?>
"><?php echo $this->_tpl_vars['not_members_total']; ?>
</a><?php else: ?>0<?php endif; ?></em>
			
		</li>
		<?php endif; ?>
		
		<?php $_from = $this->_tpl_vars['usergroups']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['mem_id'] => $this->_tpl_vars['mem_name']):
?>
		<?php if ($this->_tpl_vars['mem_name']['type'] == 'A'): ?>
			<li>
				<span><?php echo $this->_tpl_vars['mem_name']['usergroup']; ?>
:</span>
				<em><?php if ($this->_tpl_vars['users_stats']['usergroup']['A'][$this->_tpl_vars['mem_id']]): ?><a href="<?php echo fn_url("profiles.manage?usergroup_id=".($this->_tpl_vars['mem_id'])); ?>
"><?php echo $this->_tpl_vars['users_stats']['usergroup']['A'][$this->_tpl_vars['mem_id']]; ?>
</a><?php else: ?>0<?php endif; ?></em>
			</li>
		<?php endif; ?>
		<?php endforeach; endif; unset($_from); ?>
		
		<?php $this->_tag_stack[] = array('hook', array('name' => "index:users")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
		<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
		<li class="total-users">
			<span><?php echo fn_get_lang_var('total', $this->getLanguage()); ?>
:</span>
			<em><?php if ($this->_tpl_vars['users_stats']['total_all']): ?><a href="<?php echo fn_url("profiles.manage"); ?>
"><?php echo $this->_tpl_vars['users_stats']['total_all']; ?>
</a><?php else: ?>0<?php endif; ?></em>
		</li>

		<li class="disabled-users">
			<span><?php echo fn_get_lang_var('disabled', $this->getLanguage()); ?>
:</span>
			<em><?php if ($this->_tpl_vars['users_stats']['not_approved']): ?><a href="<?php echo fn_url("profiles.manage?status=D"); ?>
"><?php echo $this->_tpl_vars['users_stats']['not_approved']; ?>
</a><?php else: ?>0<?php endif; ?></em>
		</li>
	</ul>
	</div>
</div>
<?php endif; ?>
<?php $this->assign('show_shippings', fn_check_permissions('shippings', 'manage', 'admin'), false); ?>
<?php $this->assign('show_payments', fn_check_permissions('payments', 'manage', 'admin'), false); ?>
<?php $this->assign('show_settings', fn_check_permissions('settings', 'manage', 'admin'), false); ?>
<?php $this->assign('show_database', fn_check_permissions('database', 'manage', 'admin'), false); ?>
<?php $this->assign('show_add_page', fn_check_permissions('pages', 'manage', 'admin', 'POST'), false); ?>
<?php $this->assign('show_blocks', fn_check_permissions('block_manager', 'manage', 'admin'), false); ?>
<?php if ($this->_tpl_vars['show_inventory'] || $this->_tpl_vars['show_shippings'] || $this->_tpl_vars['show_payments'] || $this->_tpl_vars['show_settings'] || $this->_tpl_vars['show_database'] || $this->_tpl_vars['show_add_page'] || $this->_tpl_vars['show_blocks']): ?>
<div class="statistics-box shortcuts">
	<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('title' => fn_get_lang_var('shortcuts', $this->getLanguage()), )); ?><h2>
	<span class="float-right hidden">
		<img src="<?php echo $this->_tpl_vars['images_dir']; ?>
/icons/icon_hide.gif" width="13" height="13" border="0" alt="<?php echo fn_get_lang_var('hide', $this->getLanguage()); ?>
" title="<?php echo fn_get_lang_var('hide', $this->getLanguage()); ?>
" />
		<img src="<?php echo $this->_tpl_vars['images_dir']; ?>
/icons/icon_close.gif" width="13" height="13" border="0" alt="<?php echo fn_get_lang_var('close', $this->getLanguage()); ?>
" title="<?php echo fn_get_lang_var('close', $this->getLanguage()); ?>
" />
	</span>
	<?php echo $this->_tpl_vars['title']; ?>

</h2><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>

	<div class="statistics-body clear">
		<ul class="arrow-list float-left">
			<?php if ($this->_tpl_vars['show_inventory']): ?><li><a href="<?php echo fn_url("products.manage"); ?>
"><?php echo fn_get_lang_var('manage_products', $this->getLanguage()); ?>
</a></li><?php endif; ?>
			<?php if ($this->_tpl_vars['show_inventory']): ?><li><a href="<?php echo fn_url("categories.manage"); ?>
"><?php echo fn_get_lang_var('manage_categories', $this->getLanguage()); ?>
</a></li><?php endif; ?>
			<?php if ($this->_tpl_vars['show_shippings']): ?><li><a href="<?php echo fn_url("shippings.manage"); ?>
"><?php echo fn_get_lang_var('shipping_methods', $this->getLanguage()); ?>
</a></li><?php endif; ?>
			<?php if ($this->_tpl_vars['show_payments']): ?><li><a href="<?php echo fn_url("payments.manage"); ?>
"><?php echo fn_get_lang_var('payment_methods', $this->getLanguage()); ?>
</a></li><?php endif; ?>
		</ul>

		<ul class="arrow-list float-left">
			<?php if ($this->_tpl_vars['show_settings']): ?><li><a href="<?php echo fn_url("settings.manage"); ?>
"><?php echo fn_get_lang_var('general_settings', $this->getLanguage()); ?>
</a></li><?php endif; ?>
			<?php if ($this->_tpl_vars['show_database']): ?><li><a href="<?php echo fn_url("database.manage"); ?>
"><?php echo fn_get_lang_var('db_backup_restore', $this->getLanguage()); ?>
</a></li><?php endif; ?>
			<?php if ($this->_tpl_vars['show_add_page']): ?><li><a href="<?php echo fn_url("pages.add?parent_id=0"); ?>
"><?php echo fn_get_lang_var('add_inf_page', $this->getLanguage()); ?>
</a></li><?php endif; ?>
			<?php if ($this->_tpl_vars['show_blocks']): ?><li><a href="<?php echo fn_url("block_manager.manage"); ?>
"><?php echo fn_get_lang_var('manage_blocks', $this->getLanguage()); ?>
</a></li><?php endif; ?>
		</ul>
	</div>
</div>
<?php endif; ?>
<?php endif; ?>

</td>
</tr>
</table>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

<?php ob_start(); ?>

	<?php if ($this->_tpl_vars['settings']['General']['feedback_type'] == 'manual' && ! defined('COMPANY_ID') && ! defined('RESTRICTED_ADMIN')): ?>
		<div class="tools-container">
		<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/object_group.tpl", 'smarty_include_vars' => array('link_text' => (fn_get_lang_var('send_feedback', $this->getLanguage()))."&nbsp;&#155;&#155;",'content' => $this->_smarty_vars['capture']['update_block'],'id' => 'feedback','no_table' => true,'header_text' => fn_get_lang_var('feedback_values', $this->getLanguage()),'but_name' => "dispatch[feedback.send]",'href' => "feedback.prepare",'opener_ajax_class' => "cm-ajax",'link_class' => "cm-ajax-force",'picker_meta' => "cm-clear-content",'act' => 'edit')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</div>
	<?php endif; ?>

<?php $this->_smarty_vars['capture']['tools'] = ob_get_contents(); ob_end_clean(); ?>
<?php $this->_smarty_vars['capture']['mainbox'] = ob_get_contents(); ob_end_clean(); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/mainbox.tpl", 'smarty_include_vars' => array('title' => fn_get_lang_var('dashboard', $this->getLanguage()),'content' => $this->_smarty_vars['capture']['mainbox'],'tools' => $this->_smarty_vars['capture']['tools'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>