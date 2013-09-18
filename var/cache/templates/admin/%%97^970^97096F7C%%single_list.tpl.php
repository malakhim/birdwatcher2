<?php /* Smarty version 2.6.18, created on 2013-09-14 15:57:05
         compiled from views/static_data/components/single_list.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'cat', 'views/static_data/components/single_list.tpl', 1, false),array('modifier', 'fn_url', 'views/static_data/components/single_list.tpl', 20, false),array('modifier', 'fn_allow_save_object', 'views/static_data/components/single_list.tpl', 33, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('text_position_updating','no_data'));
?>
<?php 

				$rname = !empty($resource_name) ? $resource_name : $params['smarty_include_tpl_file'];
				if ($this->compile_check && empty($inline_no_check[$rname]) && $this->is_cached($rname)) {
					if ($this->check_inline_blocks(array (
  'common_templates/sortable_position_scripts.tpl' => 1367063753,
))) {
						$_smarty_compile_path = $this->_get_compile_path($rname);
						$this->_compile_resource($rname, $_smarty_compile_path);
						$inline_no_check[$rname] = true;
						include $_smarty_compile_path;
						return;
					}
				}
			 ?><?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('sortable_table' => 'static_data', 'sortable_id_name' => 'param_id', )); ?><script type="text/javascript">
//<![CDATA[
$(function() <?php echo $this->_tpl_vars['ldelim']; ?>

	var params = <?php echo $this->_tpl_vars['ldelim']; ?>
<?php echo $this->_tpl_vars['rdelim']; ?>
;
		params.text_position_updating = '<?php echo fn_get_lang_var('text_position_updating', $this->getLanguage()); ?>
';
		params.update_sortable_url = '<?php echo fn_url("tools.update_position?table=".($this->_tpl_vars['sortable_table'])."&id_name=".($this->_tpl_vars['sortable_id_name']), 'A', 'rel', '&'); ?>
';
		params.handle_class = '<?php echo $this->_tpl_vars['handle_class']; ?>
';

	var sortable_id = '<?php if ($this->_tpl_vars['sortable_id']): ?>#<?php echo $this->_tpl_vars['sortable_id']; ?>
<?php else: ?><?php endif; ?>';
	
	$(sortable_id + '.cm-sortable').ceSortable(params);
<?php echo $this->_tpl_vars['rdelim']; ?>
);

//]]>
</script><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>

<div class="items-container cm-sortable">
<?php $_from = $this->_tpl_vars['static_data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['s']):
?>
	<?php if (fn_allow_save_object("", 'static_data', $this->_tpl_vars['section_data']['skip_edition_checking'])): ?>
		<?php $this->assign('href_delete', "static_data.delete?param_id=".($this->_tpl_vars['s']['param_id'])."&amp;section=".($this->_tpl_vars['section']), false); ?>
	<?php else: ?>
		<?php $this->assign('href_delete', "", false); ?>
	<?php endif; ?>

	<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/object_group.tpl", 'smarty_include_vars' => array('id' => $this->_tpl_vars['s']['param_id'],'text' => $this->_tpl_vars['s']['descr'],'status' => $this->_tpl_vars['s']['status'],'hidden' => false,'href' => "static_data.update?param_id=".($this->_tpl_vars['s']['param_id'])."&amp;section=".($this->_tpl_vars['section']),'object_id_name' => 'param_id','table' => 'static_data','href_delete' => $this->_tpl_vars['href_delete'],'rev_delete' => 'static_data_list','header_text' => smarty_modifier_cat(fn_get_lang_var($this->_tpl_vars['section_data']['edit_title'], $this->getLanguage()), ": ".($this->_tpl_vars['s']['descr'])),'link_text' => "",'additional_class' => "cm-sortable-row cm-sortable-id-".($this->_tpl_vars['s']['param_id']))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php endforeach; else: ?>
	<p class="no-items"><?php echo fn_get_lang_var('no_data', $this->getLanguage()); ?>
</p>
<?php endif; unset($_from); ?>
</div>