<?php /* Smarty version 2.6.18, created on 2014-03-07 22:41:10
         compiled from views/product_options/manage.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'script', 'views/product_options/manage.tpl', 15, false),array('modifier', 'defined', 'views/product_options/manage.tpl', 79, false),array('modifier', 'fn_get_company_name', 'views/product_options/manage.tpl', 83, false),array('modifier', 'default', 'views/product_options/manage.tpl', 156, false),array('modifier', 'fn_check_view_permissions', 'views/product_options/manage.tpl', 157, false),array('modifier', 'fn_url', 'views/product_options/manage.tpl', 163, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('global','vendor','edit','view','editing_option','no_items','new_option','add_option','apply_to_products','remove_this_item','remove_this_item','global_options'));
?>
<?php 

				$rname = !empty($resource_name) ? $resource_name : $params['smarty_include_tpl_file'];
				if ($this->compile_check && empty($inline_no_check[$rname]) && $this->is_cached($rname)) {
					if ($this->check_inline_blocks(array (
  'buttons/button.tpl' => 1367063752,
))) {
						$_smarty_compile_path = $this->_get_compile_path($rname);
						$this->_compile_resource($rname, $_smarty_compile_path);
						$inline_no_check[$rname] = true;
						include $_smarty_compile_path;
						return;
					}
				}
			 ?><?php echo smarty_function_script(array('src' => "js/tabs.js"), $this);?>

<?php echo '
<script type="text/javascript">
//<![CDATA[
function fn_check_option_type(value, tag_id)
{
	var id = tag_id.replace(\'option_type_\', \'\');
	$(\'#tab_option_variants_\' + id).toggleBy(!(value == \'S\' || value == \'R\' || value == \'C\'));
	$(\'#required_options_\' + id).toggleBy(!(value == \'I\' || value == \'T\' || value == \'F\'));
	$(\'#extra_options_\' + id).toggleBy(!(value == \'I\' || value == \'T\'));
	$(\'#file_options_\' + id).toggleBy(!(value == \'F\'));
	
	if (value == \'C\') {
		var t = $(\'table\', \'#content_tab_option_variants_\' + id);
		$(\'.cm-non-cb\', t).switchAvailability(true); // hide obsolete columns
		$(\'tbody:gt(1)\', t).switchAvailability(true); // hide obsolete rows

	} else if (value == \'S\' || value == \'R\') {
		var t = $(\'table\', \'#content_tab_option_variants_\' + id);
		$(\'.cm-non-cb\', t).switchAvailability(false); // show all columns
		$(\'tbody\', t).switchAvailability(false); // show all rows
		$(\'#box_add_variant_\' + id).show(); // show "add new variants" box
		
	} else if (value == \'I\' || value == \'T\') {
		$(\'#extra_options_\' + id).show(); // show "add new variants" box
	}
}
//]]>
</script>
'; ?>


<?php ob_start(); ?>

<?php if ($this->_tpl_vars['object'] == 'global'): ?>
	<?php $this->assign('select_languages', true, false); ?>
	<?php $this->assign('rev_delete_id', 'pagination_contents', false); ?>
<?php else: ?>
	<?php $this->assign('rev_delete_id', 'product_options_list', false); ?>
<?php endif; ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/pagination.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div class="items-container" id="product_options_list">
<?php $_from = $this->_tpl_vars['product_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['po']):
?>
	<?php if ($this->_tpl_vars['object'] == 'product' && ! $this->_tpl_vars['po']['product_id']): ?>
		<?php $this->assign('details', "(".(fn_get_lang_var('global', $this->getLanguage())).")", false); ?>
		<?php $this->assign('query_product_id', "", false); ?>
	<?php else: ?>
		<?php $this->assign('details', "", false); ?>
		<?php $this->assign('query_product_id', "&product_id=".($this->_tpl_vars['product_id']), false); ?>
	<?php endif; ?>
	
	<?php if ($this->_tpl_vars['object'] == 'product'): ?>
		<?php if (! $this->_tpl_vars['po']['product_id']): ?>
			<?php $this->assign('query_product_id', "&object=".($this->_tpl_vars['object']), false); ?>
		<?php else: ?>
			<?php $this->assign('query_product_id', "&product_id=".($this->_tpl_vars['product_id'])."&object=".($this->_tpl_vars['object']), false); ?>
		<?php endif; ?>
		<?php $this->assign('query_delete_product_id', "&product_id=".($this->_tpl_vars['product_id']), false); ?>
	<?php else: ?>
		<?php $this->assign('query_product_id', "", false); ?>
		<?php $this->assign('query_delete_product_id', "", false); ?>
	<?php endif; ?>

	<?php if (defined('COMPANY_ID') && $this->_tpl_vars['po']['company_id'] != @COMPANY_ID && $this->_tpl_vars['object'] == 'global'): ?>
		<?php $this->assign('skip_delete', true, false); ?>
	<?php endif; ?>
	<?php if ($this->_tpl_vars['po']['company_id'] && ! $this->_tpl_vars['po']['product_id']): ?>
	<?php $this->assign('po_company_name', fn_get_company_name($this->_tpl_vars['po']['company_id']), false); ?>
	<?php $this->assign('po_name', ($this->_tpl_vars['po']['option_name'])." (".(fn_get_lang_var('vendor', $this->getLanguage())).": ".($this->_tpl_vars['po_company_name']).")", false); ?>
	<?php else: ?>
	<?php $this->assign('po_name', $this->_tpl_vars['po']['option_name'], false); ?>
	<?php endif; ?>
	
	<?php if (defined('COMPANY_ID') && $this->_tpl_vars['po']['company_id'] == @COMPANY_ID): ?>
		<?php $this->assign('link_text', fn_get_lang_var('edit', $this->getLanguage()), false); ?>
		<?php $this->assign('additional_class', "cm-no-hide-input", false); ?>
	<?php elseif (defined('COMPANY_ID')): ?>
		<?php $this->assign('link_text', fn_get_lang_var('view', $this->getLanguage()), false); ?>
		<?php $this->assign('additional_class', "", false); ?>
	<?php endif; ?>
	<?php if (defined('COMPANY_ID') && @COMPANY_ID != $this->_tpl_vars['po']['company_id']): ?>
		<?php $this->assign('hide_for_vendor', true, false); ?>
	<?php endif; ?>
	
	
	<?php $this->assign('status', $this->_tpl_vars['po']['status'], false); ?>
	<?php $this->assign('href_delete', "product_options.delete?option_id=".($this->_tpl_vars['po']['option_id']).($this->_tpl_vars['query_delete_product_id']), false); ?>
	

	
	<?php $this->assign('link_class', "text-button-edit", false); ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/object_group.tpl", 'smarty_include_vars' => array('id' => $this->_tpl_vars['po']['option_id'],'id_prefix' => '_product_option_','details' => $this->_tpl_vars['details'],'text' => $this->_tpl_vars['po_name'],'hide_for_vendor' => $this->_tpl_vars['hide_for_vendor'],'status' => $this->_tpl_vars['status'],'table' => 'product_options','object_id_name' => 'option_id','href' => "product_options.update?option_id=".($this->_tpl_vars['po']['option_id']).($this->_tpl_vars['query_product_id']),'href_delete' => $this->_tpl_vars['href_delete'],'rev_delete' => $this->_tpl_vars['rev_delete_id'],'header_text' => (fn_get_lang_var('editing_option', $this->getLanguage())).":&nbsp;".($this->_tpl_vars['po']['option_name']),'skip_delete' => $this->_tpl_vars['skip_delete'],'additional_class' => $this->_tpl_vars['additional_class'],'prefix' => 'product_options')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php endforeach; else: ?>

	<p class="no-items"><?php echo fn_get_lang_var('no_items', $this->getLanguage()); ?>
</p>

<?php endif; unset($_from); ?>
<!--product_options_list--></div>

<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/pagination.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php if (! ( defined('COMPANY_ID') && $this->_tpl_vars['product_data']['shared_product'] == 'Y' && @COMPANY_ID != $this->_tpl_vars['product_data']['company_id'] )): ?>
<div class="buttons-container">
	<?php ob_start(); ?>
		<?php ob_start(); ?>
			<?php if ($this->_tpl_vars['product_data']): ?>
				<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/product_options/update.tpl", 'smarty_include_vars' => array('mode' => 'add','option_id' => '0','company_id' => $this->_tpl_vars['product_data']['company_id'],'disable_company_picker' => true)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<?php else: ?>
				<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/product_options/update.tpl", 'smarty_include_vars' => array('mode' => 'add','option_id' => '0')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<?php endif; ?>
		<?php $this->_smarty_vars['capture']['add_new_picker'] = ob_get_contents(); ob_end_clean(); ?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/popupbox.tpl", 'smarty_include_vars' => array('id' => 'add_new_option','text' => fn_get_lang_var('new_option', $this->getLanguage()),'link_text' => fn_get_lang_var('add_option', $this->getLanguage()),'act' => 'general','content' => $this->_smarty_vars['capture']['add_new_picker'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php $this->_smarty_vars['capture']['tools'] = ob_get_contents(); ob_end_clean(); ?>
		<?php if ($this->_tpl_vars['object'] != 'global'): ?> 
   			<?php echo $this->_smarty_vars['capture']['tools']; ?>
 
		<?php endif; ?>
		<?php if ($this->_tpl_vars['product_options'] && $this->_tpl_vars['object'] == 'global'): ?>
			<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('but_text' => fn_get_lang_var('apply_to_products', $this->getLanguage()), 'but_role' => 'text', 'but_href' => "product_options.apply", )); ?><?php if ($this->_tpl_vars['but_role'] == 'text'): ?>
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
		<?php endif; ?>
	<?php echo $this->_tpl_vars['extra']; ?>

</div>
<?php endif; ?>

<?php $this->_smarty_vars['capture']['mainbox'] = ob_get_contents(); ob_end_clean(); ?>

<?php if ($this->_tpl_vars['object'] == 'product'): ?>
	<?php echo $this->_smarty_vars['capture']['mainbox']; ?>

<?php else: ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/mainbox.tpl", 'smarty_include_vars' => array('title' => fn_get_lang_var('global_options', $this->getLanguage()),'content' => $this->_smarty_vars['capture']['mainbox'],'tools' => $this->_smarty_vars['capture']['tools'],'select_language' => $this->_tpl_vars['select_language'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php endif; ?>