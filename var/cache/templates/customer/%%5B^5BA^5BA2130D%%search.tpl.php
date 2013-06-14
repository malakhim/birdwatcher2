<?php /* Smarty version 2.6.18, created on 2013-06-14 13:39:28
         compiled from views/products/search.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'fn_get_products_views', 'views/products/search.tpl', 16, false),array('block', 'hook', 'views/products/search.tpl', 27, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('search_results','advanced_search','products_found','text_no_matching_products_found'));
?>
<div id="products_search_<?php echo $this->_tpl_vars['block']['block_id']; ?>
">

<?php if ($this->_tpl_vars['search']): ?>
	<?php $this->assign('_title', fn_get_lang_var('search_results', $this->getLanguage()), false); ?>
	<?php $this->assign('_collapse', true, false); ?>
<?php else: ?>
	<?php $this->assign('_title', fn_get_lang_var('advanced_search', $this->getLanguage()), false); ?>
	<?php $this->assign('_collapse', false, false); ?>
<?php endif; ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/products/components/products_search_form.tpl", 'smarty_include_vars' => array('dispatch' => "products.search",'collapse' => $this->_tpl_vars['_collapse'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php if ($this->_tpl_vars['search']): ?>
	<?php if ($this->_tpl_vars['products']): ?>
		<?php $this->assign('title_extra', (fn_get_lang_var('products_found', $this->getLanguage())).":&nbsp;<strong>".($this->_tpl_vars['product_count'])."</strong>", false); ?>
		<?php $this->assign('layouts', fn_get_products_views("", false, 0), false); ?>
		<?php if ($this->_tpl_vars['category_data']['product_columns']): ?>
			<?php $this->assign('product_columns', $this->_tpl_vars['category_data']['product_columns'], false); ?>
		<?php else: ?>
			<?php $this->assign('product_columns', $this->_tpl_vars['settings']['Appearance']['columns_in_products_list'], false); ?>
		<?php endif; ?>
		
		<?php if ($this->_tpl_vars['layouts'][$this->_tpl_vars['selected_layout']]['template']): ?>
			<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['layouts'][$this->_tpl_vars['selected_layout']]['template']), 'smarty_include_vars' => array('columns' => ($this->_tpl_vars['product_columns']))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<?php endif; ?>
	<?php else: ?>
		<?php $this->_tag_stack[] = array('hook', array('name' => "products:search_results_no_matching_found")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
			<p class="no-items"><?php echo fn_get_lang_var('text_no_matching_products_found', $this->getLanguage()); ?>
</p>
		<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
	<?php endif; ?>

<?php endif; ?>

<!--products_search_<?php echo $this->_tpl_vars['block']['block_id']; ?>
--></div>

<?php $this->_tag_stack[] = array('hook', array('name' => "products:search_results_mainbox_title")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
<?php ob_start(); ?><span class="float-right"><?php echo $this->_tpl_vars['title_extra']; ?>
</span><?php echo $this->_tpl_vars['_title']; ?>
<?php $this->_smarty_vars['capture']['mainbox_title'] = ob_get_contents(); ob_end_clean(); ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>