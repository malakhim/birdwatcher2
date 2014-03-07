<?php /* Smarty version 2.6.18, created on 2014-03-07 22:38:46
         compiled from pickers/categories_picker_contents.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'pickers/categories_picker_contents.tpl', 1, false),array('modifier', 'fn_is_empty', 'pickers/categories_picker_contents.tpl', 1, false),array('modifier', 'escape', 'pickers/categories_picker_contents.tpl', 4, false),array('modifier', 'fn_url', 'pickers/categories_picker_contents.tpl', 30, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('text_items_added','choose','add_categories_and_close','add_categories'));
?>
<?php if (! $this->_tpl_vars['_REQUEST']['extra']): ?>
<script type="text/javascript">
//<![CDATA[
lang.text_items_added = '<?php echo smarty_modifier_escape(fn_get_lang_var('text_items_added', $this->getLanguage()), 'javascript'); ?>
';
var display_type = '<?php echo smarty_modifier_escape($this->_tpl_vars['_REQUEST']['display'], 'javascript'); ?>
';
<?php echo '
	function fn_form_post_categories_form(frm, elm) 
	{
		var categories = {};

		if ($(\'input.cm-item:checked\', $(frm)).length > 0) {
			$(\'input.cm-item:checked\', $(frm)).each( function() {
				var id = $(this).val();
				categories[id] = $(\'#category_\' + id).text();
			});
			$.add_js_item(frm.attr(\'rev\'), categories, \'c\', null);

			if (display_type != \'radio\') {
				$.showNotifications({\'data\': {\'type\': \'N\', \'title\': lang.notice, \'message\': lang.text_items_added, \'save_state\': false, \'message_state\': \'I\'}});
			}
		}

		return false;
	}
'; ?>

//]]>
</script>
<?php endif; ?>

<form action="<?php echo fn_url(($this->_tpl_vars['index_script'])."?".($this->_tpl_vars['_REQUEST']['extra'])); ?>
" rev="<?php echo $this->_tpl_vars['_REQUEST']['data_id']; ?>
" method="post" name="categories_form">

<div class="items-container multi-level"><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/categories/components/categories_tree_simple.tpl", 'smarty_include_vars' => array('header' => true,'checkbox_name' => smarty_modifier_default(@$this->_tpl_vars['_REQUEST']['checkbox_name'], 'categories_ids'),'parent_id' => $this->_tpl_vars['category_id'],'display' => $this->_tpl_vars['_REQUEST']['display'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></div>

<div class="buttons-container">
	<?php if ($this->_tpl_vars['_REQUEST']['display'] == 'radio'): ?>
		<?php $this->assign('but_close_text', fn_get_lang_var('choose', $this->getLanguage()), false); ?>
	<?php else: ?>
		<?php $this->assign('but_close_text', fn_get_lang_var('add_categories_and_close', $this->getLanguage()), false); ?>
		<?php $this->assign('but_text', fn_get_lang_var('add_categories', $this->getLanguage()), false); ?>
	<?php endif; ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/add_close.tpl", 'smarty_include_vars' => array('is_js' => fn_is_empty($this->_tpl_vars['_REQUEST']['extra']))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>

</form>