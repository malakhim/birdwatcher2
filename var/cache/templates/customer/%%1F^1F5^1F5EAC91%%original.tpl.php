<?php /* Smarty version 2.6.18, created on 2013-09-21 11:03:04
         compiled from C:/wamp5/www/dutchme2/skins/basic/customer/blocks/product_filters/original.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'strpos', 'C:/wamp5/www/dutchme2/skins/basic/customer/blocks/product_filters/original.tpl', 20, false),array('modifier', 'fn_query_remove', 'C:/wamp5/www/dutchme2/skins/basic/customer/blocks/product_filters/original.tpl', 22, false),array('modifier', 'fn_link_attach', 'C:/wamp5/www/dutchme2/skins/basic/customer/blocks/product_filters/original.tpl', 30, false),array('modifier', 'default', 'C:/wamp5/www/dutchme2/skins/basic/customer/blocks/product_filters/original.tpl', 63, false),array('modifier', 'fn_string_not_empty', 'C:/wamp5/www/dutchme2/skins/basic/customer/blocks/product_filters/original.tpl', 74, false),array('modifier', 'fn_add_range_to_url_hash', 'C:/wamp5/www/dutchme2/skins/basic/customer/blocks/product_filters/original.tpl', 79, false),array('modifier', 'fn_url', 'C:/wamp5/www/dutchme2/skins/basic/customer/blocks/product_filters/original.tpl', 80, false),array('modifier', 'fn_compare_dispatch', 'C:/wamp5/www/dutchme2/skins/basic/customer/blocks/product_filters/original.tpl', 81, false),array('modifier', 'defined', 'C:/wamp5/www/dutchme2/skins/basic/customer/blocks/product_filters/original.tpl', 137, false),array('function', 'math', 'C:/wamp5/www/dutchme2/skins/basic/customer/blocks/product_filters/original.tpl', 69, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('advanced','reset'));
?>
<?php 

				$rname = !empty($resource_name) ? $resource_name : $params['smarty_include_tpl_file'];
				if ($this->compile_check && empty($inline_no_check[$rname]) && $this->is_cached($rname)) {
					if ($this->check_inline_blocks(array (
  'blocks/product_filters/components/product_filter_slider.tpl' => 1367063745,
))) {
						$_smarty_compile_path = $this->_get_compile_path($rname);
						$this->_compile_resource($rname, $_smarty_compile_path);
						$inline_no_check[$rname] = true;
						include $_smarty_compile_path;
						return;
					}
				}
			 ?>
<div id="product_filters_<?php echo $this->_tpl_vars['block']['block_id']; ?>
">
<?php if ($this->_tpl_vars['items'] && ! $this->_tpl_vars['_REQUEST']['advanced_filter']): ?>

<?php if (strpos($_SERVER['QUERY_STRING'], "dispatch=") !== false): ?>
	<?php $this->assign('curl', $this->_tpl_vars['config']['current_url'], false); ?>
	<?php $this->assign('filter_qstring', fn_query_remove($this->_tpl_vars['curl'], 'result_ids', 'full_render', 'filter_id', 'view_all', 'req_range_id', 'advanced_filter', 'features_hash', 'subcats', 'page'), false); ?>
<?php else: ?>
	<?php $this->assign('filter_qstring', "products.search", false); ?>
<?php endif; ?>

<?php $this->assign('reset_qstring', "products.search", false); ?>

<?php if ($this->_tpl_vars['_REQUEST']['category_id'] && $this->_tpl_vars['settings']['General']['show_products_from_subcategories'] == 'Y'): ?>
	<?php $this->assign('filter_qstring', fn_link_attach($this->_tpl_vars['filter_qstring'], "subcats=Y"), false); ?>
	<?php $this->assign('reset_qstring', fn_link_attach($this->_tpl_vars['reset_qstring'], "subcats=Y"), false); ?>
<?php endif; ?>

<?php $this->assign('allow_ajax', true, false); ?>
<?php $this->assign('ajax_div_ids', "product_filters_*,products_search_*,category_products_*,product_features_*,breadcrumbs_*,currencies_*,languages_*", false); ?>

<?php $this->assign('has_selected', false, false); ?>
<?php $_from = $this->_tpl_vars['items']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['filters'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['filters']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['filter']):
        $this->_foreach['filters']['iteration']++;
?>
	<?php if ($this->_tpl_vars['filter']['slider'] || $this->_tpl_vars['filter']['selected_ranges'] || $this->_tpl_vars['filter']['ranges']): ?>
		<?php $this->assign('filter_uid', ($this->_tpl_vars['block']['block_id'])."_".($this->_tpl_vars['filter']['filter_id']), false); ?>
		<?php $this->assign('cookie_name_show_filter', "content_".($this->_tpl_vars['filter_uid']), false); ?>
		<?php if ($this->_tpl_vars['filter']['display'] == 'N'): ?>
						<?php $this->assign('collapse', true, false); ?>
			<?php if ($_COOKIE[$this->_tpl_vars['cookie_name_show_filter']]): ?>
				<?php $this->assign('collapse', false, false); ?>
			<?php endif; ?>
		<?php else: ?>
						<?php $this->assign('collapse', false, false); ?>
			<?php if ($_COOKIE[$this->_tpl_vars['cookie_name_show_filter']]): ?>
				<?php $this->assign('collapse', true, false); ?>
			<?php endif; ?>
		<?php endif; ?>

		<div id="sw_content_<?php echo $this->_tpl_vars['filter_uid']; ?>
" class="filter-wrap cm-combination-filter_<?php echo $this->_tpl_vars['filter_uid']; ?>
 cm-combo-<?php if ($this->_tpl_vars['collapse']): ?>on<?php else: ?>off<?php endif; ?>">
			<i class="toggle-arrow">&nbsp;</i>
			<span class="filter-title cm-save-state <?php if ($this->_tpl_vars['filter']['display'] == 'Y'): ?>cm-ss-reverse<?php endif; ?>"><?php echo $this->_tpl_vars['filter']['filter']; ?>
</span>

			<?php if ($this->_tpl_vars['filter']['slider']): ?>
				<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('filter_uid' => $this->_tpl_vars['filter_uid'], 'id' => "slider_".($this->_tpl_vars['filter_uid']), 'filter' => $this->_tpl_vars['filter'], 'ajax_div_ids' => $this->_tpl_vars['ajax_div_ids'], 'dynamic' => true, 'filter_qstring' => $this->_tpl_vars['filter_qstring'], 'reset_qstring' => $this->_tpl_vars['reset_qstring'], 'allow_ajax' => $this->_tpl_vars['allow_ajax'], )); ?><?php $this->assign('min', $this->_tpl_vars['filter']['range_values']['min'], false); ?>
<?php $this->assign('max', $this->_tpl_vars['filter']['range_values']['max'], false); ?>
<?php $this->assign('left', smarty_modifier_default(@$this->_tpl_vars['filter']['range_values']['left'], @$this->_tpl_vars['min']), false); ?>
<?php $this->assign('right', smarty_modifier_default(@$this->_tpl_vars['filter']['range_values']['right'], @$this->_tpl_vars['max']), false); ?>

<?php if ($this->_tpl_vars['max']-$this->_tpl_vars['min'] <= $this->_tpl_vars['filter']['round_to']): ?>
	<?php $this->assign('disable_slider', true, false); ?>
<?php elseif ($this->_tpl_vars['max']-$this->_tpl_vars['min'] >= ( 4 * $this->_tpl_vars['filter']['round_to'] )): ?>
	<?php echo smarty_function_math(array('equation' => "min + round((max - min) * 0.25 / rto) * rto",'max' => $this->_tpl_vars['max'],'min' => $this->_tpl_vars['min'],'rto' => $this->_tpl_vars['filter']['round_to'],'assign' => 'num_25'), $this);?>

	<?php echo smarty_function_math(array('equation' => "min + round((max - min) * 0.50 / rto) * rto",'max' => $this->_tpl_vars['max'],'min' => $this->_tpl_vars['min'],'rto' => $this->_tpl_vars['filter']['round_to'],'assign' => 'num_50'), $this);?>

	<?php echo smarty_function_math(array('equation' => "min + round((max - min) * 0.75 / rto) * rto",'max' => $this->_tpl_vars['max'],'min' => $this->_tpl_vars['min'],'rto' => $this->_tpl_vars['filter']['round_to'],'assign' => 'num_75'), $this);?>

<?php endif; ?>

<?php if (fn_string_not_empty($this->_tpl_vars['filter']['range_values']['left']) || fn_string_not_empty($this->_tpl_vars['filter']['range_values']['right'])): ?>
	<?php ob_start(); ?>Y<?php $this->_smarty_vars['capture']['has_selected'] = ob_get_contents(); ob_end_clean(); ?>
<?php endif; ?>

<?php if ($this->_tpl_vars['dynamic']): ?>
	<?php $this->assign('filter_slider_hash', fn_add_range_to_url_hash($this->_tpl_vars['_REQUEST']['features_hash'], '###-###', $this->_tpl_vars['filter']['field_type']), false); ?>
	<?php $this->assign('filter_slider_url', fn_url(fn_link_attach($this->_tpl_vars['filter_qstring'], "features_hash=".($this->_tpl_vars['filter_slider_hash']))), false); ?>
	<?php $this->assign('use_ajax', fn_compare_dispatch($this->_tpl_vars['filter_slider_url'], $this->_tpl_vars['config']['current_url']), false); ?>
<?php else: ?>
	<?php $this->assign('filter_slider_hash', fn_add_range_to_url_hash("", '###-###', $this->_tpl_vars['filter']['field_type']), false); ?>
	<?php $this->assign('filter_slider_url', fn_url("products.search?features_hash=".($this->_tpl_vars['filter_slider_hash'])), false); ?>
	<?php $this->assign('use_ajax', false, false); ?>
<?php endif; ?>

<div id="content_<?php echo $this->_tpl_vars['filter_uid']; ?>
" class="price-slider hidden <?php echo $this->_tpl_vars['extra_class']; ?>
">
	<input type="text" class="input-text" id="<?php echo $this->_tpl_vars['id']; ?>
_left" name="left_<?php echo $this->_tpl_vars['id']; ?>
" value="<?php echo $this->_tpl_vars['left']; ?>
"<?php if ($this->_tpl_vars['disable_slider']): ?> disabled="disabled"<?php endif; ?> />
	&nbsp;–&nbsp;
	<input type="text" class="input-text" id="<?php echo $this->_tpl_vars['id']; ?>
_right" name="right_<?php echo $this->_tpl_vars['id']; ?>
" value="<?php echo $this->_tpl_vars['right']; ?>
"<?php if ($this->_tpl_vars['disable_slider']): ?> disabled="disabled"<?php endif; ?> />
	<?php if ($this->_tpl_vars['filter']['field_type'] == 'P'): ?>
		&nbsp;<?php echo $this->_tpl_vars['currencies'][$this->_tpl_vars['secondary_currency']]['symbol']; ?>

	<?php endif; ?>

	<div id="<?php echo $this->_tpl_vars['id']; ?>
" class="cm-range-slider">	<ul>
		<li style="left: 0%;"><i><b><?php echo $this->_tpl_vars['min']; ?>
</b></i></li>
		<?php if ($this->_tpl_vars['num_25']): ?>
			<li style="left: 25%;"><i><b><?php echo $this->_tpl_vars['num_25']; ?>
</b></i></li>
			<li style="left: 50%;"><i><b><?php echo $this->_tpl_vars['num_50']; ?>
</b></i></li>
			<li style="left: 75%;"><i><b><?php echo $this->_tpl_vars['num_75']; ?>
</b></i></li>
		<?php endif; ?>
		<li style="left: 100%;"><i><b><?php echo $this->_tpl_vars['max']; ?>
</b></i></li>
	</ul></div>

	<?php if ($this->_tpl_vars['right'] == $this->_tpl_vars['left']): ?>
		<?php echo smarty_function_math(array('equation' => "left + rto",'left' => $this->_tpl_vars['left'],'rto' => $this->_tpl_vars['filter']['round_to'],'assign' => '_right'), $this);?>

	<?php else: ?>
		<?php $this->assign('_right', $this->_tpl_vars['right'], false); ?>
	<?php endif; ?>
	
	<input type="hidden" id="<?php echo $this->_tpl_vars['id']; ?>
_json" value='{
		"disabled": <?php echo smarty_modifier_default(@$this->_tpl_vars['disable_slider'], 'false'); ?>
,
		"min": <?php echo $this->_tpl_vars['min']; ?>
,
		"max": <?php echo $this->_tpl_vars['max']; ?>
,
		"left": <?php echo $this->_tpl_vars['left']; ?>
,
		"right": <?php echo $this->_tpl_vars['_right']; ?>
,
		"step": <?php echo $this->_tpl_vars['filter']['round_to']; ?>
,
		"url": "<?php echo $this->_tpl_vars['filter_slider_url']; ?>
",
		"type": "<?php echo $this->_tpl_vars['filter']['field_type']; ?>
",
		"currency": "<?php echo @CART_SECONDARY_CURRENCY; ?>
",
		"ajax": <?php if ($this->_tpl_vars['allow_ajax'] && $this->_tpl_vars['use_ajax']): ?>true<?php else: ?>false<?php endif; ?>,
		"result_ids": "<?php echo $this->_tpl_vars['ajax_div_ids']; ?>
"
	}' />
	

</div>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
			<?php else: ?>
				<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "blocks/product_filters/components/product_filter_variants.tpl", 'smarty_include_vars' => array('filter_uid' => $this->_tpl_vars['filter_uid'],'filter' => $this->_tpl_vars['filter'],'ajax_div_ids' => $this->_tpl_vars['ajax_div_ids'],'collapse' => $this->_tpl_vars['collapse'],'filter_qstring' => $this->_tpl_vars['filter_qstring'],'reset_qstring' => $this->_tpl_vars['reset_qstring'],'allow_ajax' => $this->_tpl_vars['allow_ajax'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<?php endif; ?>
		</div>
	<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>

<div class="filters-tools clearfix">
	<div class="float-right"><a <?php if (defined('FILTER_CUSTOM_ADVANCED')): ?>href="<?php echo fn_url("products.search?advanced_filter=Y"); ?>
"<?php else: ?>href="<?php echo fn_url(fn_link_attach($this->_tpl_vars['filter_qstring'], "advanced_filter=Y")); ?>
"<?php endif; ?> rel="nofollow" class="secondary-link lowercase"><?php echo fn_get_lang_var('advanced', $this->getLanguage()); ?>
</a></div>
	<?php if ($this->_smarty_vars['capture']['has_selected']): ?>
	<a href="<?php if ($this->_tpl_vars['_REQUEST']['category_id']): ?><?php $this->assign('use_ajax', true, false); ?><?php echo fn_url("categories.view?category_id=".($this->_tpl_vars['_REQUEST']['category_id'])); ?>
<?php else: ?><?php $this->assign('use_ajax', false, false); ?><?php echo fn_url($this->_tpl_vars['index_script']); ?>
<?php endif; ?>" rel="nofollow" class="reset-filters<?php if ($this->_tpl_vars['allow_ajax'] && $this->_tpl_vars['use_ajax']): ?> cm-ajax cm-ajax-full-render" rev="<?php echo $this->_tpl_vars['ajax_div_ids']; ?>
<?php endif; ?>"><?php echo fn_get_lang_var('reset', $this->getLanguage()); ?>
</a>
	<?php endif; ?>
</div>

<?php endif; ?>
<!--product_filters_<?php echo $this->_tpl_vars['block']['block_id']; ?>
--></div>