<?php /* Smarty version 2.6.18, created on 2014-06-04 13:44:32
         compiled from addons/seo/views/seo_rules/manage.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'fn_url', 'addons/seo/views/seo_rules/manage.tpl', 17, false),array('modifier', 'fn_html_escape', 'addons/seo/views/seo_rules/manage.tpl', 65, false),array('modifier', 'urlencode', 'addons/seo/views/seo_rules/manage.tpl', 65, false),array('modifier', 'fn_check_view_permissions', 'addons/seo/views/seo_rules/manage.tpl', 89, false),array('modifier', 'substr_count', 'addons/seo/views/seo_rules/manage.tpl', 93, false),array('modifier', 'replace', 'addons/seo/views/seo_rules/manage.tpl', 94, false),array('modifier', 'default', 'addons/seo/views/seo_rules/manage.tpl', 99, false),array('modifier', 'defined', 'addons/seo/views/seo_rules/manage.tpl', 106, false),array('function', 'cycle', 'addons/seo/views/seo_rules/manage.tpl', 55, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('seo_name','url_dispatch_part','controller_description','check_uncheck_all','dispatch_value','seo_name','delete','no_data','delete_selected','choose_action','or','tools','add','new_rule','add_new','new_rule','add_new','seo_rules'));
?>
<?php 

				$rname = !empty($resource_name) ? $resource_name : $params['smarty_include_tpl_file'];
				if ($this->compile_check && empty($inline_no_check[$rname]) && $this->is_cached($rname)) {
					if ($this->check_inline_blocks(array (
  'common_templates/tools.tpl' => 1367063753,
))) {
						$_smarty_compile_path = $this->_get_compile_path($rname);
						$this->_compile_resource($rname, $_smarty_compile_path);
						$inline_no_check[$rname] = true;
						include $_smarty_compile_path;
						return;
					}
				}
			 ?><?php ob_start(); ?>

<form action="<?php echo fn_url(""); ?>
" method="post" name="rule_add_var">
<input type="hidden" name="page" value="<?php echo $this->_tpl_vars['_REQUEST']['page']; ?>
" />

<div class="form-field">
	<label class="cm-required" for="rule_name"><?php echo fn_get_lang_var('seo_name', $this->getLanguage()); ?>
:</label>
	<input type="text" name="name" id="rule_name" value="" class="input-text-large" />
</div>
<div class="form-field">
	<label class="cm-required" for="rule_controller"><?php echo fn_get_lang_var('url_dispatch_part', $this->getLanguage()); ?>
:</label>
	<input type="text" name="controller" id="rule_controller" value="" class="input-text-large" />
	<p class="description"><?php echo fn_get_lang_var('controller_description', $this->getLanguage()); ?>
</p>
</div>

<div class="buttons-container">
	<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/save_cancel.tpl", 'smarty_include_vars' => array('but_name' => "dispatch[seo_rules.add_rule]",'create' => true,'cancel_action' => 'close')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>
</form>

<?php $this->_smarty_vars['capture']['add_seo_rule'] = ob_get_contents(); ob_end_clean(); ?>

<?php ob_start(); ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/seo/views/seo_rules/components/search_form.tpl", 'smarty_include_vars' => array('dispatch' => "seo_rules.manage")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<form action="<?php echo fn_url(""); ?>
" method="post" name="seo_form">

<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/pagination.tpl", 'smarty_include_vars' => array('save_current_page' => true,'save_current_url' => true)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<input type="hidden" name="page" value="<?php echo $this->_tpl_vars['_REQUEST']['page']; ?>
" />
<table cellspacing="0" cellpadding="0" border="0" width="100%" class="table">
<tr>
	<th width="1%">
		<input type="checkbox" name="check_all" value="Y" title="<?php echo fn_get_lang_var('check_uncheck_all', $this->getLanguage()); ?>
" class="checkbox cm-check-items" /></th>
	<th width="35%"><?php echo fn_get_lang_var('dispatch_value', $this->getLanguage()); ?>
</th>
	<th width="64%"><?php echo fn_get_lang_var('seo_name', $this->getLanguage()); ?>
</th>
	<th>&nbsp;</th>
</tr>
<?php $_from = $this->_tpl_vars['seo_data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['var']):
?>
<tr <?php echo smarty_function_cycle(array('values' => "class=\"table-row\", ",'name' => '2'), $this);?>
 valign="top">
	<td>
		<input type="checkbox" name="controllers[]" value="<?php echo $this->_tpl_vars['var']['dispatch']; ?>
" class="checkbox cm-item" /></td>
	<td>
		<input type="hidden" name="seo_data[<?php echo $this->_tpl_vars['key']; ?>
][dispatch]" value="<?php echo $this->_tpl_vars['var']['dispatch']; ?>
" />
		<span><?php echo $this->_tpl_vars['var']['dispatch']; ?>
</span></td>
	<td>
		<input type="text" name="seo_data[<?php echo $this->_tpl_vars['key']; ?>
][name]" value="<?php echo $this->_tpl_vars['var']['name']; ?>
" class="input-text-large" /></td>
	<td class="nowrap">
		<?php ob_start(); ?>
		<?php $this->assign('_dispatch', urlencode(fn_html_escape(($this->_tpl_vars['var']['dispatch']), 1)), false); ?>
		<li><a class="cm-confirm" href="<?php echo fn_url("seo_rules.delete_rule?controller=".($this->_tpl_vars['_dispatch'])); ?>
"><?php echo fn_get_lang_var('delete', $this->getLanguage()); ?>
</a></li>
		<?php $this->_smarty_vars['capture']['tools_items'] = ob_get_contents(); ob_end_clean(); ?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/table_tools_list.tpl", 'smarty_include_vars' => array('prefix' => $this->_tpl_vars['var']['name'],'tools_list' => $this->_smarty_vars['capture']['tools_items'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</td>
</tr>
<?php endforeach; else: ?>
<tr class="no-items">
	<td colspan="4"><p><?php echo fn_get_lang_var('no_data', $this->getLanguage()); ?>
</p></td>
</tr>
<?php endif; unset($_from); ?>
</table>

<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/pagination.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div class="buttons-container buttons-bg">
	<?php if ($this->_tpl_vars['seo_data']): ?>
	<div class="float-left">
		<?php ob_start(); ?>
		<ul>
			<li><a name="dispatch[seo_rules.delete_rules]" class="cm-process-items cm-confirm" rev="seo_form"><?php echo fn_get_lang_var('delete_selected', $this->getLanguage()); ?>
</a></li>
		</ul>
		<?php $this->_smarty_vars['capture']['tools_list'] = ob_get_contents(); ob_end_clean(); ?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/save.tpl", 'smarty_include_vars' => array('but_name' => "dispatch[seo_rules.update_rules]",'but_role' => 'button_main')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('prefix' => 'main', 'hide_actions' => true, 'tools_list' => $this->_smarty_vars['capture']['tools_list'], 'display' => 'inline', 'link_text' => fn_get_lang_var('choose_action', $this->getLanguage()), )); ?><?php if ($this->_tpl_vars['skip_check_permissions'] || fn_check_view_permissions($this->_tpl_vars['tools_list'])): ?>

<?php if ($this->_tpl_vars['tools_list'] && $this->_tpl_vars['prefix'] == 'main' && ! $this->_tpl_vars['only_popup']): ?> <?php echo fn_get_lang_var('or', $this->getLanguage()); ?>
 <?php endif; ?>

<?php if (substr_count($this->_tpl_vars['tools_list'], "<li") == 1): ?>
	<?php echo smarty_modifier_replace($this->_tpl_vars['tools_list'], "<ul>", "<ul class=\"cm-tools-list tools-list\">"); ?>

<?php else: ?>
	<div class="tools-container<?php if ($this->_tpl_vars['display']): ?> <?php echo $this->_tpl_vars['display']; ?>
<?php endif; ?>">
		<?php if (! $this->_tpl_vars['hide_tools'] && $this->_tpl_vars['tools_list']): ?>
		<div class="tools-content<?php if ($this->_tpl_vars['display']): ?> <?php echo $this->_tpl_vars['display']; ?>
<?php endif; ?>">
			<a class="cm-combo-on cm-combination <?php if ($this->_tpl_vars['override_meta']): ?><?php echo $this->_tpl_vars['override_meta']; ?>
<?php else: ?>select-button<?php endif; ?><?php if ($this->_tpl_vars['link_meta']): ?> <?php echo $this->_tpl_vars['link_meta']; ?>
<?php endif; ?>" id="sw_tools_list_<?php echo $this->_tpl_vars['prefix']; ?>
"><?php echo smarty_modifier_default(@$this->_tpl_vars['link_text'], fn_get_lang_var('tools', $this->getLanguage())); ?>
</a>
			<div id="tools_list_<?php echo $this->_tpl_vars['prefix']; ?>
" class="cm-tools-list popup-tools hidden cm-popup-box cm-smart-position">
					<?php echo $this->_tpl_vars['tools_list']; ?>

			</div>
		</div>
		<?php endif; ?>
		<?php if (! $this->_tpl_vars['hide_actions']): ?>
			<?php if (! ( defined('COMPANY_ID') && ! fn_check_view_permissions($this->_tpl_vars['tool_href']) )): ?>
				<span class="action-add">
					<a<?php if ($this->_tpl_vars['tool_id']): ?> id="<?php echo $this->_tpl_vars['tool_id']; ?>
"<?php endif; ?><?php if ($this->_tpl_vars['tool_href']): ?> href="<?php echo fn_url($this->_tpl_vars['tool_href']); ?>
"<?php endif; ?><?php if ($this->_tpl_vars['tool_onclick']): ?> onclick="<?php echo $this->_tpl_vars['tool_onclick']; ?>
; return false;"<?php endif; ?>><?php echo smarty_modifier_default(@$this->_tpl_vars['link_text'], fn_get_lang_var('add', $this->getLanguage())); ?>
</a>
				</span>
			<?php endif; ?>
		<?php endif; ?>
	</div>
<?php endif; ?>

<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
	</div>
	<?php endif; ?>

	<div class="float-right">
		<?php ob_start(); ?>
			<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/popupbox.tpl", 'smarty_include_vars' => array('id' => 'add_seo_rule','text' => fn_get_lang_var('new_rule', $this->getLanguage()),'link_text' => fn_get_lang_var('add_new', $this->getLanguage()),'content' => $this->_smarty_vars['capture']['add_seo_rule'],'act' => 'general')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<?php $this->_smarty_vars['capture']['tools'] = ob_get_contents(); ob_end_clean(); ?>
	
		<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/popupbox.tpl", 'smarty_include_vars' => array('id' => 'add_seo_rule','text' => fn_get_lang_var('new_rule', $this->getLanguage()),'link_text' => fn_get_lang_var('add_new', $this->getLanguage()),'act' => 'general')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</div>
</div>
</form>

<?php $this->_smarty_vars['capture']['mainbox'] = ob_get_contents(); ob_end_clean(); ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/mainbox.tpl", 'smarty_include_vars' => array('title' => fn_get_lang_var('seo_rules', $this->getLanguage()),'content' => $this->_smarty_vars['capture']['mainbox'],'title_extra' => $this->_smarty_vars['capture']['title_extra'],'tools' => $this->_smarty_vars['capture']['tools'],'select_languages' => true)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>