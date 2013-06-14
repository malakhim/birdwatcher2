<?php /* Smarty version 2.6.18, created on 2013-06-14 13:39:29
         compiled from views/products/components/sorting.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'fn_query_remove', 'views/products/components/sorting.tpl', 20, false),array('modifier', 'fn_get_products_sorting', 'views/products/components/sorting.tpl', 21, false),array('modifier', 'fn_get_products_sorting_orders', 'views/products/components/sorting.tpl', 22, false),array('modifier', 'fn_get_products_views', 'views/products/components/sorting.tpl', 23, false),array('modifier', 'default', 'views/products/components/sorting.tpl', 24, false),array('modifier', 'count', 'views/products/components/sorting.tpl', 43, false),array('modifier', 'replace', 'views/products/components/sorting.tpl', 47, false),array('modifier', 'fn_url', 'views/products/components/sorting.tpl', 47, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('per_page','per_page'));
?>
<?php  ob_start();  ?><?php 

				$rname = !empty($resource_name) ? $resource_name : $params['smarty_include_tpl_file'];
				if ($this->compile_check && empty($inline_no_check[$rname]) && $this->is_cached($rname)) {
					if ($this->check_inline_blocks(array (
  'common_templates/sorting.tpl' => 1367063745,
))) {
						$_smarty_compile_path = $this->_get_compile_path($rname);
						$this->_compile_resource($rname, $_smarty_compile_path);
						$inline_no_check[$rname] = true;
						include $_smarty_compile_path;
						return;
					}
				}
			 ?><div class="sort-container">
<?php if ($this->_tpl_vars['settings']['DHTML']['customer_ajax_based_pagination'] == 'Y'): ?>
	<?php $this->assign('ajax_class', "cm-ajax cm-ajax-force", false); ?>
<?php endif; ?>

<?php $this->assign('curl', fn_query_remove($this->_tpl_vars['config']['current_url'], 'sort_by', 'sort_order', 'result_ids', 'layout'), false); ?>
<?php $this->assign('sorting', fn_get_products_sorting("", 'false'), false); ?>
<?php $this->assign('sorting_orders', fn_get_products_sorting_orders(""), false); ?>
<?php $this->assign('layouts', fn_get_products_views("", false, false), false); ?>
<?php $this->assign('pagination_id', smarty_modifier_default(@$this->_tpl_vars['id'], 'pagination_contents'), false); ?>
<?php $this->assign('avail_sorting', $this->_tpl_vars['settings']['Appearance']['available_product_list_sortings'], false); ?>

<?php if ($this->_tpl_vars['search']['sort_order'] == 'asc'): ?>
	<?php ob_start(); ?>
		<a class="sort-asc"><?php echo $this->_tpl_vars['sorting'][$this->_tpl_vars['search']['sort_by']]['description']; ?>
</a>
	<?php $this->_smarty_vars['capture']['sorting_text'] = ob_get_contents(); ob_end_clean(); ?>
<?php else: ?>
	<?php ob_start(); ?>
		<a class="sort-desc"><?php echo $this->_tpl_vars['sorting'][$this->_tpl_vars['search']['sort_by']]['description']; ?>
</a>
	<?php $this->_smarty_vars['capture']['sorting_text'] = ob_get_contents(); ob_end_clean(); ?>
<?php endif; ?>

<?php if ($this->_tpl_vars['search']['sort_order'] == 'asc'): ?>
	<?php $this->assign('layout_sort_order', 'desc', false); ?>
<?php else: ?>
	<?php $this->assign('layout_sort_order', 'asc', false); ?>
<?php endif; ?>

<?php if (! ( ( count($this->_tpl_vars['category_data']['selected_layouts']) == 1 ) || ( count($this->_tpl_vars['category_data']['selected_layouts']) == 0 && count(fn_get_products_views("", true)) <= 1 ) ) && ! $this->_tpl_vars['hide_layouts']): ?>
<div class="views-icons">
<?php $_from = $this->_tpl_vars['layouts']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['layout'] => $this->_tpl_vars['item']):
?>
<?php if (( $this->_tpl_vars['category_data']['selected_layouts'][$this->_tpl_vars['layout']] ) || ( ! $this->_tpl_vars['category_data']['selected_layouts'] && $this->_tpl_vars['item']['active'] )): ?>
<a class="<?php echo smarty_modifier_replace($this->_tpl_vars['layout'], '_', "-"); ?>
 <?php echo $this->_tpl_vars['ajax_class']; ?>
 <?php if ($this->_tpl_vars['layout'] == $this->_tpl_vars['selected_layout']): ?>active<?php endif; ?>" rev="<?php echo $this->_tpl_vars['pagination_id']; ?>
" href="<?php echo fn_url(($this->_tpl_vars['curl'])."&amp;sort_by=".($this->_tpl_vars['search']['sort_by'])."&amp;sort_order=".($this->_tpl_vars['layout_sort_order'])."&amp;layout=".($this->_tpl_vars['layout'])); ?>
" rel="nofollow" name="layout_callback"></a>
<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
</div>
<?php endif; ?>

<?php if ($this->_tpl_vars['avail_sorting']): ?>
<?php $__parent_tpl_vars = $this->_tpl_vars; ?><script type="text/javascript" class="cm-ajax-force">
//<![CDATA[
<?php echo '
$(function(){
	//Dropdown states
	$(\'.cm-dropdown-title\').hover(
		function () {
			$(this).addClass(\'hover\');
		},function () {
			$(this).removeClass(\'hover\');
	});
	$(\'.cm-dropdown-content\').hide();
	$(\'.cm-dropdown-title\').click(function () {
		var hideDropDown = function(e) {
			var jelm = $(e.target);

			if (e.data.elm.hasClass(\'click\') && !jelm.parents(\'.cm-dropdown-content\').length && !jelm.parents(\'.cm-dropdown-title.click\').length) {
				$(document).unbind(\'mousedown\', hideDropDown);
				e.data.elm.click();
			}
		}
		$(this).toggleClass(\'click\').next(\'.cm-dropdown-content\').slideToggle("fast");

		if ($(this).hasClass(\'click\')) {
			$(document).bind(\'mousedown\', {elm: $(this)}, hideDropDown);
		} else {
			$(document).unbind(\'mousedown\', hideDropDown);
		}
		return false;
	});
});
'; ?>

//]]>
</script>

<div class="dropdown-container">
<?php if ($this->_tpl_vars['search']['sort_order'] == 'asc'): ?>
<?php $this->assign('sort_label', "sort_by_".($this->_tpl_vars['search']['sort_by'])."_desc", false); ?>
<?php else: ?>
<?php $this->assign('sort_label', "sort_by_".($this->_tpl_vars['search']['sort_by'])."_asc", false); ?>
<?php endif; ?>
	<span class="cm-dropdown-title sort-dropdown dropdown-wrap-left"><a class="dropdown-wrap-right"><?php echo fn_get_lang_var($this->_tpl_vars['sort_label'], $this->getLanguage()); ?>
</a></span>
	<ul class="cm-dropdown-content">
		<?php $_from = $this->_tpl_vars['sorting']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['option'] => $this->_tpl_vars['value']):
?>
			<?php if ($this->_tpl_vars['search']['sort_by'] == $this->_tpl_vars['option']): ?>
				<?php $this->assign('sort_order', $this->_tpl_vars['search']['sort_order'], false); ?>
			<?php else: ?>
				<?php if ($this->_tpl_vars['value']['default_order']): ?>
					<?php $this->assign('sort_order', $this->_tpl_vars['value']['default_order'], false); ?>
				<?php else: ?>
					<?php $this->assign('sort_order', 'asc', false); ?>
				<?php endif; ?>
			<?php endif; ?>
			<?php $_from = $this->_tpl_vars['sorting_orders']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['sort_order']):
?>
				<?php if ($this->_tpl_vars['search']['sort_by'] != $this->_tpl_vars['option'] || $this->_tpl_vars['search']['sort_order'] == $this->_tpl_vars['sort_order']): ?>
					<?php $this->assign('sort_label', "sort_by_".($this->_tpl_vars['label_pref']).($this->_tpl_vars['option'])."_".($this->_tpl_vars['sort_order']), false); ?>
					<?php $this->assign('sort_class', "sort-by-".($this->_tpl_vars['class_pref']).($this->_tpl_vars['option'])."-".($this->_tpl_vars['sort_order']), false); ?>
					<?php $this->assign('sort_key', ($this->_tpl_vars['option'])."-".($this->_tpl_vars['sort_order']), false); ?>
					<?php if (! $this->_tpl_vars['avail_sorting'] || $this->_tpl_vars['avail_sorting'][$this->_tpl_vars['sort_key']] == 'Y'): ?>
					<li class="<?php echo $this->_tpl_vars['sort_class']; ?>
"><a class="<?php echo $this->_tpl_vars['ajax_class']; ?>
" rev="<?php echo $this->_tpl_vars['pagination_id']; ?>
" href="<?php echo fn_url(($this->_tpl_vars['curl'])."&amp;sort_by=".($this->_tpl_vars['option'])."&amp;sort_order=".($this->_tpl_vars['sort_order'])); ?>
" rel="nofollow" name="sorting_callback"><?php echo fn_get_lang_var($this->_tpl_vars['sort_label'], $this->getLanguage()); ?>
</a></li>
					<?php endif; ?>
				<?php endif; ?>
			<?php endforeach; endif; unset($_from); ?>
		<?php endforeach; endif; unset($_from); ?>
	</ul>
</div><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
<?php endif; ?>

<?php if ($this->_tpl_vars['pagination']['total_items']): ?>
<?php $this->assign('range_url', fn_query_remove($this->_tpl_vars['curl'], 'items_per_page'), false); ?>
<?php $this->assign('range_url', fn_query_remove($this->_tpl_vars['range_url'], 'page'), false); ?>
<div class="dropdown-container">
<span class="cm-dropdown-title sort-dropdown dropdown-wrap-left"><a class="dropdown-wrap-right"><?php echo $this->_tpl_vars['pagination']['items_per_page']; ?>
 <?php echo fn_get_lang_var('per_page', $this->getLanguage()); ?>
</a></span>
	<ul class="cm-dropdown-content">
		<?php $_from = $this->_tpl_vars['pagination']['product_steps']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['step']):
?>
		<?php if ($this->_tpl_vars['step'] != $this->_tpl_vars['pagination']['items_per_page']): ?>
			<li><a class="<?php echo $this->_tpl_vars['ajax_class']; ?>
" href="<?php echo fn_url(($this->_tpl_vars['range_url'])."&amp;items_per_page=".($this->_tpl_vars['step'])); ?>
" rev="<?php echo $this->_tpl_vars['pagination_id']; ?>
"><?php echo $this->_tpl_vars['step']; ?>
 <?php echo fn_get_lang_var('per_page', $this->getLanguage()); ?>
</a></li>
		<?php endif; ?>
		<?php endforeach; endif; unset($_from); ?>
	</ul>
</div>
<?php endif; ?>
</div><?php  ob_end_flush();  ?>