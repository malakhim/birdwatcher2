<?php /* Smarty version 2.6.18, created on 2014-01-28 16:50:09
         compiled from views/pages/components/parent_page_selector.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'views/pages/components/parent_page_selector.tpl', 1, false),array('modifier', 'strpos', 'views/pages/components/parent_page_selector.tpl', 10, false),array('modifier', 'escape', 'views/pages/components/parent_page_selector.tpl', 11, false),array('modifier', 'indent', 'views/pages/components/parent_page_selector.tpl', 11, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('parent_page','root_level','root_page'));
?>
<div class="form-field" id="parent_page_selector">

	<label class="cm-required" for="elm_parent_id"><?php echo fn_get_lang_var('parent_page', $this->getLanguage()); ?>
:</label>
	<?php if (! $this->_tpl_vars['parent_pages']): ?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "pickers/pages_picker.tpl", 'smarty_include_vars' => array('data_id' => 'location_page','input_name' => "page_data[parent_id]",'item_ids' => smarty_modifier_default(@$this->_tpl_vars['page_data']['parent_id'], '0'),'hide_link' => true,'hide_delete_button' => true,'show_root' => true,'default_name' => fn_get_lang_var('root_level', $this->getLanguage()),'display_input_id' => 'elm_parent_id','except_id' => $this->_tpl_vars['page_data']['page_id'],'company_id' => $this->_tpl_vars['page_data']['company_id'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php else: ?>
		<select name="page_data[parent_id]" id="elm_parent_id">
			<option value="0">- <?php echo fn_get_lang_var('root_page', $this->getLanguage()); ?>
 -</option>
			<?php $_from = $this->_tpl_vars['parent_pages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['page']):
?>
			<?php if (( strpos($this->_tpl_vars['page']['id_path'], ($this->_tpl_vars['page_data']['id_path'])."/") === false && $this->_tpl_vars['page_data']['page_id'] != $this->_tpl_vars['page']['page_id'] ) || $this->_tpl_vars['show_all']): ?>
				<option value="<?php echo $this->_tpl_vars['page']['page_id']; ?>
" <?php if ($this->_tpl_vars['page']['page_id'] == $this->_tpl_vars['_REQUEST']['parent_id'] || $this->_tpl_vars['page']['page_id'] == $this->_tpl_vars['page_data']['parent_id']): ?>selected="selected"<?php endif; ?>><?php echo smarty_modifier_indent(smarty_modifier_escape($this->_tpl_vars['page']['page']), $this->_tpl_vars['page']['level'], "&#166;&nbsp;&nbsp;&nbsp;&nbsp;", "&#166;--&nbsp;"); ?>
</option>
			<?php endif; ?>
			<?php endforeach; endif; unset($_from); ?>
		</select>
	<?php endif; ?>
<!--parent_page_selector--></div>