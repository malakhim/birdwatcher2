<?php /* Smarty version 2.6.18, created on 2014-03-10 11:21:45
         compiled from views/orders/search.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'md5', 'views/orders/search.tpl', 18, false),array('modifier', 'string_format', 'views/orders/search.tpl', 18, false),array('modifier', 'default', 'views/orders/search.tpl', 32, false),array('modifier', 'fn_query_remove', 'views/orders/search.tpl', 35, false),array('modifier', 'escape', 'views/orders/search.tpl', 64, false),array('modifier', 'fn_url', 'views/orders/search.tpl', 77, false),array('modifier', 'fn_get_statuses', 'views/orders/search.tpl', 123, false),array('modifier', 'date_format', 'views/orders/search.tpl', 143, false),array('modifier', 'format_price', 'views/orders/search.tpl', 146, false),array('function', 'math', 'views/orders/search.tpl', 19, false),array('function', 'script', 'views/orders/search.tpl', 49, false),array('function', 'cycle', 'views/orders/search.tpl', 119, false),array('function', 'html_options', 'views/orders/search.tpl', 130, false),array('function', 'html_checkboxes', 'views/orders/search.tpl', 133, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('search_options','open_action','hide','prev_page','next','id','status','customer','date','total','text_no_orders','prev_page','next','orders'));
?>
<?php 

				$rname = !empty($resource_name) ? $resource_name : $params['smarty_include_tpl_file'];
				if ($this->compile_check && empty($inline_no_check[$rname]) && $this->is_cached($rname)) {
					if ($this->check_inline_blocks(array (
  'common_templates/pagination.tpl' => 1367063745,
))) {
						$_smarty_compile_path = $this->_get_compile_path($rname);
						$this->_compile_resource($rname, $_smarty_compile_path);
						$inline_no_check[$rname] = true;
						include $_smarty_compile_path;
						return;
					}
				}
			 ?><?php ob_start(); ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/orders/components/orders_search_form.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $this->_smarty_vars['capture']['section'] = ob_get_contents(); ob_end_clean(); ?>
<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('section_title' => fn_get_lang_var('search_options', $this->getLanguage()), 'section_content' => $this->_smarty_vars['capture']['section'], 'class' => "search-form", )); ?><?php $this->assign('id', smarty_modifier_string_format(md5($this->_tpl_vars['section_title']), "s_%s"), false); ?>
<?php echo smarty_function_math(array('equation' => "rand()",'assign' => 'rnd'), $this);?>

<?php if ($_COOKIE[$this->_tpl_vars['id']] || $this->_tpl_vars['collapse']): ?>
	<?php $this->assign('collapse', true, false); ?>
<?php else: ?>
	<?php $this->assign('collapse', false, false); ?>
<?php endif; ?>

<div class="section-border<?php if ($this->_tpl_vars['class']): ?> <?php echo $this->_tpl_vars['class']; ?>
<?php endif; ?>" id="ds_<?php echo $this->_tpl_vars['rnd']; ?>
">
	<div  class="section-title cm-combo-<?php if (! $this->_tpl_vars['collapse']): ?>off<?php else: ?>on<?php endif; ?> cm-combination cm-save-state cm-ss-reverse" id="sw_<?php echo $this->_tpl_vars['id']; ?>
">
		<span><?php echo $this->_tpl_vars['section_title']; ?>
</span>
		<span class="section-switch section-switch-on"><?php echo fn_get_lang_var('open_action', $this->getLanguage()); ?>
</span>
		<span class="section-switch section-switch-off"><?php echo fn_get_lang_var('hide', $this->getLanguage()); ?>
</span>
	</div>
	<div id="<?php echo $this->_tpl_vars['id']; ?>
" class="<?php echo smarty_modifier_default(@$this->_tpl_vars['section_body_class'], "section-body"); ?>
 <?php if ($this->_tpl_vars['collapse']): ?>hidden<?php endif; ?>"><?php echo $this->_tpl_vars['section_content']; ?>
</div>
</div><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>

<?php $this->assign('c_url', fn_query_remove($this->_tpl_vars['config']['current_url'], 'sort_by', 'sort_order'), false); ?>
<?php if ($this->_tpl_vars['search']['sort_order'] == 'asc'): ?>
<?php $this->assign('sort_sign', "table-asc", false); ?>
<?php else: ?>
<?php $this->assign('sort_sign', "table-desc", false); ?>
<?php endif; ?>
<?php if ($this->_tpl_vars['settings']['DHTML']['customer_ajax_based_pagination'] == 'Y'): ?>
	<?php $this->assign('ajax_class', "cm-ajax", false); ?>

<?php endif; ?>

<?php $__parent_tpl_vars = $this->_tpl_vars; ?><?php $this->assign('id', smarty_modifier_default(@$this->_tpl_vars['id'], 'pagination_contents'), false); ?>
<?php if ($this->_smarty_vars['capture']['pagination_open'] != 'Y'): ?>
	<?php if (( $this->_tpl_vars['settings']['DHTML']['customer_ajax_based_pagination'] == 'Y' || $this->_tpl_vars['force_ajax'] ) && $this->_tpl_vars['pagination']['total_pages'] > 1): ?>
		<?php echo smarty_function_script(array('src' => "lib/js/history/jquery.history.js"), $this);?>

	<?php endif; ?>
	<div class="pagination-container" id="<?php echo $this->_tpl_vars['id']; ?>
">

	<?php if ($this->_tpl_vars['save_current_page']): ?>
	<input type="hidden" name="page" value="<?php echo smarty_modifier_default(@$this->_tpl_vars['search']['page'], @$this->_tpl_vars['_REQUEST']['page']); ?>
" />
	<?php endif; ?>

	<?php if ($this->_tpl_vars['save_current_url']): ?>
	<input type="hidden" name="redirect_url" value="<?php echo $this->_tpl_vars['config']['current_url']; ?>
" />
	<?php endif; ?>
<?php endif; ?>

<?php if ($this->_tpl_vars['pagination']['total_pages'] > 1): ?>
	<?php if ($this->_tpl_vars['settings']['Appearance']['top_pagination'] == 'Y' && $this->_smarty_vars['capture']['pagination_open'] != 'Y' || $this->_smarty_vars['capture']['pagination_open'] == 'Y'): ?>
	<?php $this->assign('current_url', smarty_modifier_escape(fn_query_remove($this->_tpl_vars['config']['current_url'], 'page', 'result_ids')), false); ?>

	<?php if ($this->_tpl_vars['settings']['DHTML']['customer_ajax_based_pagination'] == 'Y' || $this->_tpl_vars['force_ajax']): ?>
		<?php $this->assign('ajax_class', "cm-ajax cm-ajax-force", false); ?>
	<?php else: ?>
		<?php $this->assign('current_url', fn_query_remove($this->_tpl_vars['current_url'], 'is_ajax'), false); ?>
	<?php endif; ?>

	<?php if ($this->_smarty_vars['capture']['pagination_open'] == 'Y'): ?>
	<div class="pagination-bottom">
	<?php endif; ?>
	<div class="pagination cm-pagination-wraper">
		<?php if ($this->_tpl_vars['pagination']['prev_range']): ?>
			<a name="pagination" href="<?php echo fn_url(($this->_tpl_vars['current_url'])."&amp;page=".($this->_tpl_vars['pagination']['prev_range']).($this->_tpl_vars['extra_url'])); ?>
<?php echo $this->_tpl_vars['extra_url']; ?>
" rel="<?php echo $this->_tpl_vars['pagination']['prev_range']; ?>
" class="cm-history prev <?php echo $this->_tpl_vars['ajax_class']; ?>
" rev="<?php echo $this->_tpl_vars['id']; ?>
"><?php echo $this->_tpl_vars['pagination']['prev_range_from']; ?>
 - <?php echo $this->_tpl_vars['pagination']['prev_range_to']; ?>
</a>
		<?php endif; ?>
		<a name="pagination" class="prev <?php if ($this->_tpl_vars['pagination']['prev_page']): ?>cm-history <?php echo $this->_tpl_vars['ajax_class']; ?>
<?php endif; ?>" <?php if ($this->_tpl_vars['pagination']['prev_page']): ?>href="<?php echo fn_url(($this->_tpl_vars['current_url'])."&amp;page=".($this->_tpl_vars['pagination']['prev_page'])); ?>
" rel="<?php echo $this->_tpl_vars['pagination']['prev_page']; ?>
" rev="<?php echo $this->_tpl_vars['id']; ?>
"<?php endif; ?>><i class="text-arrow">&larr;</i>&nbsp;<?php echo fn_get_lang_var('prev_page', $this->getLanguage()); ?>
</a>

		<?php $_from = $this->_tpl_vars['pagination']['navi_pages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['pg']):
?>
			<?php if ($this->_tpl_vars['pg'] != $this->_tpl_vars['pagination']['current_page']): ?>
				<a name="pagination" href="<?php echo fn_url(($this->_tpl_vars['current_url'])."&amp;page=".($this->_tpl_vars['pg']).($this->_tpl_vars['extra_url'])); ?>
" rel="<?php echo $this->_tpl_vars['pg']; ?>
" class="cm-history <?php echo $this->_tpl_vars['ajax_class']; ?>
" rev="<?php echo $this->_tpl_vars['id']; ?>
"><?php echo $this->_tpl_vars['pg']; ?>
</a>
			<?php else: ?>
				<span class="pagination-selected-page"><?php echo $this->_tpl_vars['pg']; ?>
</span>
			<?php endif; ?>
		<?php endforeach; endif; unset($_from); ?>
		<span class="lowercase"><a name="pagination" class="next <?php if ($this->_tpl_vars['pagination']['next_page']): ?>cm-history <?php echo $this->_tpl_vars['ajax_class']; ?>
<?php endif; ?>" <?php if ($this->_tpl_vars['pagination']['next_page']): ?>href="<?php echo fn_url(($this->_tpl_vars['current_url'])."&amp;page=".($this->_tpl_vars['pagination']['next_page']).($this->_tpl_vars['extra_url'])); ?>
" rel="<?php echo $this->_tpl_vars['pagination']['next_page']; ?>
" rev="<?php echo $this->_tpl_vars['id']; ?>
"<?php endif; ?>><?php echo fn_get_lang_var('next', $this->getLanguage()); ?>
&nbsp;<i class="text-arrow">&rarr;</i></a></span>

		<?php if ($this->_tpl_vars['pagination']['next_range']): ?>
			<a name="pagination" href="<?php echo fn_url(($this->_tpl_vars['current_url'])."&amp;page=".($this->_tpl_vars['pagination']['next_range']).($this->_tpl_vars['extra_url'])); ?>
" rel="<?php echo $this->_tpl_vars['pagination']['next_range']; ?>
" class="cm-history next <?php echo $this->_tpl_vars['ajax_class']; ?>
" rev="<?php echo $this->_tpl_vars['id']; ?>
"><?php echo $this->_tpl_vars['pagination']['next_range_from']; ?>
 - <?php echo $this->_tpl_vars['pagination']['next_range_to']; ?>
</a>
		<?php endif; ?>
	</div>
	<?php if ($this->_smarty_vars['capture']['pagination_open'] == 'Y'): ?>
	</div>
	<?php endif; ?>
	<?php else: ?>
	<div class="cm-pagination-wraper"><a name="pagination" href="" rel="<?php echo $this->_tpl_vars['pg']; ?>
" rev="<?php echo $this->_tpl_vars['id']; ?>
" class="hidden"></a></div>
	<?php endif; ?>
<?php endif; ?>

<?php if ($this->_smarty_vars['capture']['pagination_open'] == 'Y'): ?>
	<!--<?php echo $this->_tpl_vars['id']; ?>
--></div>
	<?php ob_start(); ?>N<?php $this->_smarty_vars['capture']['pagination_open'] = ob_get_contents(); ob_end_clean(); ?>
<?php elseif ($this->_smarty_vars['capture']['pagination_open'] != 'Y'): ?>
	<?php ob_start(); ?>Y<?php $this->_smarty_vars['capture']['pagination_open'] = ob_get_contents(); ob_end_clean(); ?>
<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
<table border="0" cellpadding="0" cellspacing="0" width="100%" class="table orders">
<thead>
<tr>
	<th width="7%"><a class="<?php echo $this->_tpl_vars['ajax_class']; ?>
 <?php if ($this->_tpl_vars['search']['sort_by'] == 'order_id'): ?> <?php echo $this->_tpl_vars['sort_sign']; ?>
<?php endif; ?>" href="<?php echo fn_url(($this->_tpl_vars['c_url'])."&amp;sort_by=order_id&amp;sort_order=".($this->_tpl_vars['search']['sort_order'])); ?>
" rev="pagination_contents"><?php echo fn_get_lang_var('id', $this->getLanguage()); ?>
</a></th>
	<th width="14%"><a class="<?php echo $this->_tpl_vars['ajax_class']; ?>
 <?php if ($this->_tpl_vars['search']['sort_by'] == 'status'): ?><?php echo $this->_tpl_vars['sort_sign']; ?>
<?php endif; ?>" href="<?php echo fn_url(($this->_tpl_vars['c_url'])."&amp;sort_by=status&amp;sort_order=".($this->_tpl_vars['search']['sort_order'])); ?>
" rev="pagination_contents"><?php echo fn_get_lang_var('status', $this->getLanguage()); ?>
</a></th>
	<th width="44%"><a class="<?php echo $this->_tpl_vars['ajax_class']; ?>
 <?php if ($this->_tpl_vars['search']['sort_by'] == 'customer'): ?><?php echo $this->_tpl_vars['sort_sign']; ?>
<?php endif; ?>" href="<?php echo fn_url(($this->_tpl_vars['c_url'])."&amp;sort_by=customer&amp;sort_order=".($this->_tpl_vars['search']['sort_order'])); ?>
" rev="pagination_contents"><?php echo fn_get_lang_var('customer', $this->getLanguage()); ?>
</a></th>
	<th width="20%"><a class="<?php echo $this->_tpl_vars['ajax_class']; ?>
 <?php if ($this->_tpl_vars['search']['sort_by'] == 'date'): ?><?php echo $this->_tpl_vars['sort_sign']; ?>
<?php endif; ?>" href="<?php echo fn_url(($this->_tpl_vars['c_url'])."&amp;sort_by=date&amp;sort_order=".($this->_tpl_vars['search']['sort_order'])); ?>
" rev="pagination_contents"><?php echo fn_get_lang_var('date', $this->getLanguage()); ?>
</a></th>
	<th width="15%"><a class="<?php echo $this->_tpl_vars['ajax_class']; ?>
 <?php if ($this->_tpl_vars['search']['sort_by'] == 'total'): ?><?php echo $this->_tpl_vars['sort_sign']; ?>
<?php endif; ?>" href="<?php echo fn_url(($this->_tpl_vars['c_url'])."&amp;sort_by=total&amp;sort_order=".($this->_tpl_vars['search']['sort_order'])); ?>
" rev="pagination_contents"><?php echo fn_get_lang_var('total', $this->getLanguage()); ?>
</a></th>
</tr>
</thead>
<?php $_from = $this->_tpl_vars['orders']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['o']):
?>
<tr <?php echo smarty_function_cycle(array('values' => ",class=\"table-row\""), $this);?>
>
	<td><a href="<?php echo fn_url("orders.details?order_id=".($this->_tpl_vars['o']['order_id'])); ?>
"><strong>#<?php echo $this->_tpl_vars['o']['order_id']; ?>
</strong></a></td>
	<td><?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('status' => $this->_tpl_vars['o']['status'], 'display' => 'view', )); ?><?php if (! $this->_tpl_vars['order_status_descr']): ?>
	<?php if (! $this->_tpl_vars['status_type']): ?><?php $this->assign('status_type', @STATUSES_ORDER, false); ?><?php endif; ?>
	<?php $this->assign('order_status_descr', fn_get_statuses($this->_tpl_vars['status_type'], true), false); ?>
<?php endif; ?>

<?php echo ''; ?><?php if ($this->_tpl_vars['display'] == 'view'): ?><?php echo ''; ?><?php echo $this->_tpl_vars['order_status_descr'][$this->_tpl_vars['status']]; ?><?php echo ''; ?><?php elseif ($this->_tpl_vars['display'] == 'select'): ?><?php echo ''; ?><?php echo smarty_function_html_options(array('name' => $this->_tpl_vars['name'],'options' => $this->_tpl_vars['order_status_descr'],'selected' => $this->_tpl_vars['status'],'id' => $this->_tpl_vars['select_id']), $this);?><?php echo ''; ?><?php elseif ($this->_tpl_vars['display'] == 'checkboxes'): ?><?php echo '<div class="status">'; ?><?php echo smarty_function_html_checkboxes(array('name' => $this->_tpl_vars['name'],'options' => $this->_tpl_vars['order_status_descr'],'selected' => $this->_tpl_vars['status'],'columns' => 4), $this);?><?php echo '</div>'; ?><?php endif; ?><?php echo ''; ?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?></td>
	<td>
		<ul class="no-markers">
			<li><?php echo $this->_tpl_vars['o']['firstname']; ?>
 <?php echo $this->_tpl_vars['o']['lastname']; ?>
</li>
			<li><a href="mailto:<?php echo smarty_modifier_escape($this->_tpl_vars['o']['email'], 'url'); ?>
"><?php echo $this->_tpl_vars['o']['email']; ?>
</a></li>
		</ul>
	</td>
	<td><a href="<?php echo fn_url("orders.details?order_id=".($this->_tpl_vars['o']['order_id'])); ?>
"><?php echo smarty_modifier_date_format($this->_tpl_vars['o']['timestamp'], ($this->_tpl_vars['settings']['Appearance']['date_format']).", ".($this->_tpl_vars['settings']['Appearance']['time_format'])); ?>
</a></td>
	<td><?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('value' => $this->_tpl_vars['o']['total'], )); ?><?php echo ''; ?><?php if ($this->_tpl_vars['settings']['General']['alternative_currency'] == 'Y'): ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['primary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], false); ?><?php echo ''; ?><?php if ($this->_tpl_vars['secondary_currency'] != $this->_tpl_vars['primary_currency']): ?><?php echo '&nbsp;'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo '('; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true, $this->_tpl_vars['is_integer']); ?><?php echo ''; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '<span class="'; ?><?php echo $this->_tpl_vars['class']; ?><?php echo '">'; ?><?php endif; ?><?php echo ')'; ?><?php if ($this->_tpl_vars['class']): ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php echo smarty_modifier_format_price($this->_tpl_vars['value'], $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']], $this->_tpl_vars['span_id'], $this->_tpl_vars['class'], true); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?></td>
</tr>
<?php endforeach; else: ?>
<tr>
	<td colspan="7"><p class="no-items"><?php echo fn_get_lang_var('text_no_orders', $this->getLanguage()); ?>
</p></td>
</tr>
<?php endif; unset($_from); ?>
</table>

<?php $__parent_tpl_vars = $this->_tpl_vars; ?><?php $this->assign('id', smarty_modifier_default(@$this->_tpl_vars['id'], 'pagination_contents'), false); ?>
<?php if ($this->_smarty_vars['capture']['pagination_open'] != 'Y'): ?>
	<?php if (( $this->_tpl_vars['settings']['DHTML']['customer_ajax_based_pagination'] == 'Y' || $this->_tpl_vars['force_ajax'] ) && $this->_tpl_vars['pagination']['total_pages'] > 1): ?>
		<?php echo smarty_function_script(array('src' => "lib/js/history/jquery.history.js"), $this);?>

	<?php endif; ?>
	<div class="pagination-container" id="<?php echo $this->_tpl_vars['id']; ?>
">

	<?php if ($this->_tpl_vars['save_current_page']): ?>
	<input type="hidden" name="page" value="<?php echo smarty_modifier_default(@$this->_tpl_vars['search']['page'], @$this->_tpl_vars['_REQUEST']['page']); ?>
" />
	<?php endif; ?>

	<?php if ($this->_tpl_vars['save_current_url']): ?>
	<input type="hidden" name="redirect_url" value="<?php echo $this->_tpl_vars['config']['current_url']; ?>
" />
	<?php endif; ?>
<?php endif; ?>

<?php if ($this->_tpl_vars['pagination']['total_pages'] > 1): ?>
	<?php if ($this->_tpl_vars['settings']['Appearance']['top_pagination'] == 'Y' && $this->_smarty_vars['capture']['pagination_open'] != 'Y' || $this->_smarty_vars['capture']['pagination_open'] == 'Y'): ?>
	<?php $this->assign('current_url', smarty_modifier_escape(fn_query_remove($this->_tpl_vars['config']['current_url'], 'page', 'result_ids')), false); ?>

	<?php if ($this->_tpl_vars['settings']['DHTML']['customer_ajax_based_pagination'] == 'Y' || $this->_tpl_vars['force_ajax']): ?>
		<?php $this->assign('ajax_class', "cm-ajax cm-ajax-force", false); ?>
	<?php else: ?>
		<?php $this->assign('current_url', fn_query_remove($this->_tpl_vars['current_url'], 'is_ajax'), false); ?>
	<?php endif; ?>

	<?php if ($this->_smarty_vars['capture']['pagination_open'] == 'Y'): ?>
	<div class="pagination-bottom">
	<?php endif; ?>
	<div class="pagination cm-pagination-wraper">
		<?php if ($this->_tpl_vars['pagination']['prev_range']): ?>
			<a name="pagination" href="<?php echo fn_url(($this->_tpl_vars['current_url'])."&amp;page=".($this->_tpl_vars['pagination']['prev_range']).($this->_tpl_vars['extra_url'])); ?>
<?php echo $this->_tpl_vars['extra_url']; ?>
" rel="<?php echo $this->_tpl_vars['pagination']['prev_range']; ?>
" class="cm-history prev <?php echo $this->_tpl_vars['ajax_class']; ?>
" rev="<?php echo $this->_tpl_vars['id']; ?>
"><?php echo $this->_tpl_vars['pagination']['prev_range_from']; ?>
 - <?php echo $this->_tpl_vars['pagination']['prev_range_to']; ?>
</a>
		<?php endif; ?>
		<a name="pagination" class="prev <?php if ($this->_tpl_vars['pagination']['prev_page']): ?>cm-history <?php echo $this->_tpl_vars['ajax_class']; ?>
<?php endif; ?>" <?php if ($this->_tpl_vars['pagination']['prev_page']): ?>href="<?php echo fn_url(($this->_tpl_vars['current_url'])."&amp;page=".($this->_tpl_vars['pagination']['prev_page'])); ?>
" rel="<?php echo $this->_tpl_vars['pagination']['prev_page']; ?>
" rev="<?php echo $this->_tpl_vars['id']; ?>
"<?php endif; ?>><i class="text-arrow">&larr;</i>&nbsp;<?php echo fn_get_lang_var('prev_page', $this->getLanguage()); ?>
</a>

		<?php $_from = $this->_tpl_vars['pagination']['navi_pages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['pg']):
?>
			<?php if ($this->_tpl_vars['pg'] != $this->_tpl_vars['pagination']['current_page']): ?>
				<a name="pagination" href="<?php echo fn_url(($this->_tpl_vars['current_url'])."&amp;page=".($this->_tpl_vars['pg']).($this->_tpl_vars['extra_url'])); ?>
" rel="<?php echo $this->_tpl_vars['pg']; ?>
" class="cm-history <?php echo $this->_tpl_vars['ajax_class']; ?>
" rev="<?php echo $this->_tpl_vars['id']; ?>
"><?php echo $this->_tpl_vars['pg']; ?>
</a>
			<?php else: ?>
				<span class="pagination-selected-page"><?php echo $this->_tpl_vars['pg']; ?>
</span>
			<?php endif; ?>
		<?php endforeach; endif; unset($_from); ?>
		<span class="lowercase"><a name="pagination" class="next <?php if ($this->_tpl_vars['pagination']['next_page']): ?>cm-history <?php echo $this->_tpl_vars['ajax_class']; ?>
<?php endif; ?>" <?php if ($this->_tpl_vars['pagination']['next_page']): ?>href="<?php echo fn_url(($this->_tpl_vars['current_url'])."&amp;page=".($this->_tpl_vars['pagination']['next_page']).($this->_tpl_vars['extra_url'])); ?>
" rel="<?php echo $this->_tpl_vars['pagination']['next_page']; ?>
" rev="<?php echo $this->_tpl_vars['id']; ?>
"<?php endif; ?>><?php echo fn_get_lang_var('next', $this->getLanguage()); ?>
&nbsp;<i class="text-arrow">&rarr;</i></a></span>

		<?php if ($this->_tpl_vars['pagination']['next_range']): ?>
			<a name="pagination" href="<?php echo fn_url(($this->_tpl_vars['current_url'])."&amp;page=".($this->_tpl_vars['pagination']['next_range']).($this->_tpl_vars['extra_url'])); ?>
" rel="<?php echo $this->_tpl_vars['pagination']['next_range']; ?>
" class="cm-history next <?php echo $this->_tpl_vars['ajax_class']; ?>
" rev="<?php echo $this->_tpl_vars['id']; ?>
"><?php echo $this->_tpl_vars['pagination']['next_range_from']; ?>
 - <?php echo $this->_tpl_vars['pagination']['next_range_to']; ?>
</a>
		<?php endif; ?>
	</div>
	<?php if ($this->_smarty_vars['capture']['pagination_open'] == 'Y'): ?>
	</div>
	<?php endif; ?>
	<?php else: ?>
	<div class="cm-pagination-wraper"><a name="pagination" href="" rel="<?php echo $this->_tpl_vars['pg']; ?>
" rev="<?php echo $this->_tpl_vars['id']; ?>
" class="hidden"></a></div>
	<?php endif; ?>
<?php endif; ?>

<?php if ($this->_smarty_vars['capture']['pagination_open'] == 'Y'): ?>
	<!--<?php echo $this->_tpl_vars['id']; ?>
--></div>
	<?php ob_start(); ?>N<?php $this->_smarty_vars['capture']['pagination_open'] = ob_get_contents(); ob_end_clean(); ?>
<?php elseif ($this->_smarty_vars['capture']['pagination_open'] != 'Y'): ?>
	<?php ob_start(); ?>Y<?php $this->_smarty_vars['capture']['pagination_open'] = ob_get_contents(); ob_end_clean(); ?>
<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>

<?php ob_start(); ?><?php echo fn_get_lang_var('orders', $this->getLanguage()); ?>
<?php $this->_smarty_vars['capture']['mainbox_title'] = ob_get_contents(); ob_end_clean(); ?>