<?php /* Smarty version 2.6.18, created on 2013-09-21 20:04:13
         compiled from views/payments/manage.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'script', 'views/payments/manage.tpl', 15, false),array('modifier', 'fn_url', 'views/payments/manage.tpl', 24, false),array('modifier', 'escape', 'views/payments/manage.tpl', 39, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('text_position_updating','editing_payment','no_data','new_payments','add_payment','payment_methods'));
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
			 ?><?php echo smarty_function_script(array('src' => "js/tabs.js"), $this);?>


<?php ob_start(); ?>

<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('sortable_table' => 'payments', 'sortable_id_name' => 'payment_id', )); ?><script type="text/javascript">
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

<script type="text/javascript">
//<![CDATA[
var processor_descriptions = [];
<?php $_from = $this->_tpl_vars['payment_processors']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['p']):
?>
processor_descriptions[<?php echo $this->_tpl_vars['p']['processor_id']; ?>
] = '<?php echo smarty_modifier_escape($this->_tpl_vars['p']['description'], 'javascript'); ?>
';
<?php endforeach; endif; unset($_from); ?>
<?php echo '
function fn_switch_processor(payment_id, processor_id)
{
	$(\'#tab_conf_\' + payment_id).toggleBy(processor_id == 0);
	if (processor_id != 0) {
		'; ?>

		$('#tab_conf_' + payment_id + ' a').attr('href', '<?php echo fn_url("payments.processor?payment_id=", 'A', 'rel', '&'); ?>
' + payment_id + '&processor_id=' + processor_id);
		<?php echo '
		$(\'#content_tab_conf_\' + payment_id).remove();
		$(\'#elm_payment_tpl_\' + payment_id).attr(\'disabled\', \'disabled\');
		if (processor_descriptions[processor_id]) {
			$(\'#elm_processor_description_\' + payment_id).html(processor_descriptions[processor_id]).show();
		} else {
			$(\'#elm_processor_description_\' + payment_id).hide();
		}
	} else {
		$(\'#elm_payment_tpl_\' + payment_id).removeAttr(\'disabled\');
		$(\'#elm_processor_description_\' + payment_id).hide();
	}
}
'; ?>

//]]>
</script>

<div class="items-container cm-sortable" id="payments_list">
<?php $this->assign('skip_delete', false, false); ?>
<?php $_from = $this->_tpl_vars['payments']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['pf'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['pf']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['payment']):
        $this->_foreach['pf']['iteration']++;
?>


	<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/object_group.tpl", 'smarty_include_vars' => array('id' => $this->_tpl_vars['payment']['payment_id'],'text' => $this->_tpl_vars['payment']['payment'],'status' => $this->_tpl_vars['payment']['status'],'href' => "payments.update?payment_id=".($this->_tpl_vars['payment']['payment_id']),'object_id_name' => 'payment_id','table' => 'payments','href_delete' => "payments.delete?payment_id=".($this->_tpl_vars['payment']['payment_id']),'rev_delete' => 'payments_list','skip_delete' => $this->_tpl_vars['skip_delete'],'header_text' => (fn_get_lang_var('editing_payment', $this->getLanguage())).": ".($this->_tpl_vars['payment']['payment']),'additional_class' => "cm-sortable-row cm-sortable-id-".($this->_tpl_vars['payment']['payment_id']))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	
<?php endforeach; else: ?>

	<p class="no-items"><?php echo fn_get_lang_var('no_data', $this->getLanguage()); ?>
</p>

<?php endif; unset($_from); ?>
<!--payments_list--></div>

<div class="buttons-container">
	<?php ob_start(); ?>
		<?php ob_start(); ?>
			<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/payments/update.tpl", 'smarty_include_vars' => array('mode' => 'add','payment' => "",'hide_for_vendor' => false)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<?php $this->_smarty_vars['capture']['add_new_picker'] = ob_get_contents(); ob_end_clean(); ?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/popupbox.tpl", 'smarty_include_vars' => array('id' => 'add_new_payments','text' => fn_get_lang_var('new_payments', $this->getLanguage()),'content' => $this->_smarty_vars['capture']['add_new_picker'],'link_text' => fn_get_lang_var('add_payment', $this->getLanguage()),'act' => 'general')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php $this->_smarty_vars['capture']['tools'] = ob_get_contents(); ob_end_clean(); ?>
</div>

<?php $this->_smarty_vars['capture']['mainbox'] = ob_get_contents(); ob_end_clean(); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/mainbox.tpl", 'smarty_include_vars' => array('title' => fn_get_lang_var('payment_methods', $this->getLanguage()),'content' => $this->_smarty_vars['capture']['mainbox'],'tools' => $this->_smarty_vars['capture']['tools'],'select_languages' => true)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>