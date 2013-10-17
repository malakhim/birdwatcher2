<?php /* Smarty version 2.6.18, created on 2013-10-17 18:57:05
         compiled from common_templates/select_supplier_vendor.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'fn_get_company_name', 'common_templates/select_supplier_vendor.tpl', 1, false),array('modifier', 'default', 'common_templates/select_supplier_vendor.tpl', 15, false),array('modifier', 'defined', 'common_templates/select_supplier_vendor.tpl', 26, false),array('modifier', 'truncate', 'common_templates/select_supplier_vendor.tpl', 53, false),array('modifier', 'fn_url', 'common_templates/select_supplier_vendor.tpl', 61, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('search_by_vendor','search_by_owner','search_by_supplier','search','loading'));
?>
<?php  ob_start();  ?><?php 

				$rname = !empty($resource_name) ? $resource_name : $params['smarty_include_tpl_file'];
				if ($this->compile_check && empty($inline_no_check[$rname]) && $this->is_cached($rname)) {
					if ($this->check_inline_blocks(array (
  'common_templates/ajax_select_object.tpl' => 1367063753,
))) {
						$_smarty_compile_path = $this->_get_compile_path($rname);
						$this->_compile_resource($rname, $_smarty_compile_path);
						$inline_no_check[$rname] = true;
						include $_smarty_compile_path;
						return;
					}
				}
			 ?><?php $this->assign('id', smarty_modifier_default(@$this->_tpl_vars['id'], 'company_id'), false); ?>
<?php $this->assign('name', smarty_modifier_default(@$this->_tpl_vars['name'], 'company_id'), false); ?>

<?php if (@PRODUCT_TYPE == 'MULTIVENDOR'): ?>
	<?php $this->assign('lang_search_by_vendor_supplier', fn_get_lang_var('search_by_vendor', $this->getLanguage()), false); ?>
<?php elseif (@PRODUCT_TYPE == 'ULTIMATE'): ?>
	<?php $this->assign('lang_search_by_vendor_supplier', fn_get_lang_var('search_by_owner', $this->getLanguage()), false); ?>
<?php elseif (@PRODUCT_TYPE == 'PROFESSIONAL'): ?>
	<?php $this->assign('lang_search_by_vendor_supplier', fn_get_lang_var('search_by_supplier', $this->getLanguage()), false); ?>
<?php endif; ?>

<?php if (! defined('COMPANY_ID')): ?>

<div class="<?php echo smarty_modifier_default(@$this->_tpl_vars['class'], "search-field"); ?>
">
	<input type="hidden" name="<?php echo $this->_tpl_vars['name']; ?>
" id="<?php echo $this->_tpl_vars['id']; ?>
" value="<?php echo smarty_modifier_default(@$this->_tpl_vars['search']['company_id'], ''); ?>
" />
	<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('label' => $this->_tpl_vars['lang_search_by_vendor_supplier'], 'data_url' => "companies.get_companies_list?show_all=Y&search=Y", 'text' => fn_get_company_name($this->_tpl_vars['search']['company_id']), 'result_elm' => $this->_tpl_vars['id'], 'id' => ($this->_tpl_vars['id'])."_selector", )); ?><div class="tools-container inline ajax_select_object" <?php if ($this->_tpl_vars['elements_switcher_id']): ?> id="<?php echo $this->_tpl_vars['elements_switcher_id']; ?>
ajax_select_object"<?php endif; ?>>
	<?php if ($this->_tpl_vars['label']): ?><label><?php echo $this->_tpl_vars['label']; ?>
:</label><?php endif; ?>

	<?php if ($this->_tpl_vars['js_action']): ?>
	<script type="text/javascript">
	//<![CDATA[
		function fn_picker_js_action_<?php echo $this->_tpl_vars['id']; ?>
(elm) {
			<?php echo $this->_tpl_vars['js_action']; ?>

		}
	//]]>
	</script>
	<?php endif; ?> 

	<a id="sw_<?php echo $this->_tpl_vars['id']; ?>
_wrap_" class="select-link <?php if (! $this->_tpl_vars['elements_switcher_id']): ?> cm-combo-on cm-combination<?php endif; ?>"><?php echo $this->_tpl_vars['text']; ?>
</a>

	<div id="<?php echo $this->_tpl_vars['id']; ?>
_wrap_" class="popup-tools cm-popup-box cm-smart-position hidden">
		<div class="select-object-search"><input type="text" value="<?php echo fn_get_lang_var('search', $this->getLanguage()); ?>
..." class="input-text cm-hint cm-ajax-content-input" rev="content_loader_<?php echo $this->_tpl_vars['id']; ?>
" size="16" /></div>
		<div class="ajax-popup-tools" id="scroller_<?php echo $this->_tpl_vars['id']; ?>
">
			<ul class="cm-select-list" id="<?php echo $this->_tpl_vars['id']; ?>
">
				<?php $_from = $this->_tpl_vars['objects']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['object_id'] => $this->_tpl_vars['item']):
?>
					<?php if (defined('TRANSLATION_MODE')): ?>
						<?php $this->assign('name', $this->_tpl_vars['item']['name'], false); ?>
					<?php else: ?>
						<?php $this->assign('name', smarty_modifier_truncate($this->_tpl_vars['item']['name'], 40, "...", true), false); ?>
					<?php endif; ?>

					<li class="<?php echo $this->_tpl_vars['item']['extra_class']; ?>
"><a action="<?php echo $this->_tpl_vars['item']['value']; ?>
" title="<?php echo $this->_tpl_vars['item']['name']; ?>
"><?php echo $this->_tpl_vars['name']; ?>
</a></li>
				<?php endforeach; endif; unset($_from); ?>
			<!--<?php echo $this->_tpl_vars['id']; ?>
--></ul>

			<ul>
				<li id="content_loader_<?php echo $this->_tpl_vars['id']; ?>
" class="cm-ajax-content-more small-description" rel="<?php echo fn_url($this->_tpl_vars['data_url']); ?>
" rev="<?php echo $this->_tpl_vars['id']; ?>
" result_elm="<?php echo $this->_tpl_vars['result_elm']; ?>
"><?php echo fn_get_lang_var('loading', $this->getLanguage()); ?>
</li>
			</ul>
		</div>
	</div>
</div><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
</div>

<?php endif; ?><?php  ob_end_flush();  ?>