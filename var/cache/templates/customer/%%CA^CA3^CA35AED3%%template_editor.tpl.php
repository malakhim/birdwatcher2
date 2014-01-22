<?php /* Smarty version 2.6.18, created on 2014-01-21 22:57:01
         compiled from common_templates/template_editor.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'script', 'common_templates/template_editor.tpl', 24, false),array('function', 'set_id', 'common_templates/template_editor.tpl', 34, false),array('modifier', 'escape', 'common_templates/template_editor.tpl', 30, false),array('modifier', 'trim', 'common_templates/template_editor.tpl', 34, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('template_editor','templates_tree','save','restore_from_repository','text_page_changed','text_restore_question','text_template_changed'));
?>
<?php ob_start(); ?><div id="template_list_menu"><div></div><ul class="float-left"><li></li></ul></div>

<div id="template_editor_content" title="<?php echo fn_get_lang_var('template_editor', $this->getLanguage()); ?>
" class="hidden">

	<table width="100%" cellpadding="0" cellspacing="0" class="editor-table">
		<tr valign="top" class="max-height">
			<td class="templates-tree max-height">
				<div>
				<h4><?php echo fn_get_lang_var('templates_tree', $this->getLanguage()); ?>
</h4>
				<ul id="template_list"><li></li></ul></div>
			</td>
			<td>
				<textarea id="template_text"></textarea>
			</td>
		</tr>
	</table>

	<div class="buttons-container">
		<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/add_close.tpl", 'smarty_include_vars' => array('is_js' => true,'but_close_text' => fn_get_lang_var('save', $this->getLanguage()),'but_close_onclick' => "fn_save_template();",'but_onclick' => "fn_restore_template();",'but_text' => fn_get_lang_var('restore_from_repository', $this->getLanguage()))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</div>

</div>

<?php echo smarty_function_script(array('src' => "js/design_mode.js"), $this);?>

<?php echo smarty_function_script(array('src' => "lib/editarea/edit_area_loader.js"), $this);?>


<script type="text/javascript">
//<![CDATA[
var current_url = '<?php echo $this->_tpl_vars['config']['current_url']; ?>
';
lang.text_page_changed = '<?php echo smarty_modifier_escape(fn_get_lang_var('text_page_changed', $this->getLanguage()), 'javascript'); ?>
';
lang.text_restore_question = '<?php echo smarty_modifier_escape(fn_get_lang_var('text_restore_question', $this->getLanguage()), 'javascript'); ?>
';
lang.text_template_changed = '<?php echo smarty_modifier_escape(fn_get_lang_var('text_template_changed', $this->getLanguage()), 'javascript'); ?>
';
//]]>
</script><?php $this->_smarty_vars['capture']['template_content'] = ob_get_contents(); ob_end_clean(); ?><?php if (trim($this->_smarty_vars['capture']['template_content'])): ?><?php if ($this->_tpl_vars['auth']['area'] == 'A'): ?><span class="cm-template-box" template="common_templates/template_editor.tpl" id="<?php echo smarty_function_set_id(array('name' => "common_templates/template_editor.tpl"), $this);?>
"><img class="cm-template-icon hidden" src="<?php echo $this->_tpl_vars['images_dir']; ?>
/icons/layout_edit.gif" width="16" height="16" alt="" /><?php echo $this->_smarty_vars['capture']['template_content']; ?>
<!--[/tpl_id]--></span><?php else: ?><?php echo $this->_smarty_vars['capture']['template_content']; ?>
<?php endif; ?><?php endif; ?>