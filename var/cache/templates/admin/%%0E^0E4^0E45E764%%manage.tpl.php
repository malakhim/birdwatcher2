<?php /* Smarty version 2.6.18, created on 2014-02-03 15:17:48
         compiled from views/languages/manage.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'fn_url', 'views/languages/manage.tpl', 23, false),array('modifier', 'fn_check_view_permissions', 'views/languages/manage.tpl', 76, false),array('modifier', 'substr_count', 'views/languages/manage.tpl', 80, false),array('modifier', 'replace', 'views/languages/manage.tpl', 81, false),array('modifier', 'default', 'views/languages/manage.tpl', 86, false),array('modifier', 'defined', 'views/languages/manage.tpl', 93, false),array('modifier', 'count', 'views/languages/manage.tpl', 170, false),array('modifier', 'lower', 'views/languages/manage.tpl', 206, false),array('modifier', 'is_array', 'views/languages/manage.tpl', 210, false),array('modifier', 'fn_from_json', 'views/languages/manage.tpl', 211, false),array('modifier', 'trim', 'views/languages/manage.tpl', 281, false),array('modifier', 'empty_tabs', 'views/languages/manage.tpl', 425, false),array('modifier', 'in_array', 'views/languages/manage.tpl', 431, false),array('function', 'cycle', 'views/languages/manage.tpl', 38, false),array('function', 'script', 'views/languages/manage.tpl', 419, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('check_uncheck_all','language_variable','value','delete','no_data','delete_selected','choose_action','or','tools','add','new_language','add_language','new_language_variable','add_language_variable','language_variable','value','check_uncheck_all','language_code','name','status','active','hidden','disabled','pending','new','active','disabled','hidden','pending','new','active','disabled','hidden','pending','notify_customer','notify_orders_department','notify_vendor','notify_supplier','delete','delete','edit','editing_language','delete_selected','choose_action','or','tools','add','new_language','add_language','new_language_variable','add_language_variable','languages'));
?>
<?php 

				$rname = !empty($resource_name) ? $resource_name : $params['smarty_include_tpl_file'];
				if ($this->compile_check && empty($inline_no_check[$rname]) && $this->is_cached($rname)) {
					if ($this->check_inline_blocks(array (
  'common_templates/tabsbox.tpl' => 1367063753,
))) {
						$_smarty_compile_path = $this->_get_compile_path($rname);
						$this->_compile_resource($rname, $_smarty_compile_path);
						$inline_no_check[$rname] = true;
						include $_smarty_compile_path;
						return;
					}
				}
			 ?><?php ob_start(); ?>

<?php ob_start(); ?>

<div id="content_translations">

<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/languages/components/langvars_search_form.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<form action="<?php echo fn_url(""); ?>
" method="post" name="language_variables_form">
<input type="hidden" name="q" value="<?php echo $this->_tpl_vars['_REQUEST']['q']; ?>
" />
<input type="hidden" name="selected_section" value="<?php echo $this->_tpl_vars['_REQUEST']['selected_section']; ?>
" />

<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/pagination.tpl", 'smarty_include_vars' => array('save_current_page' => true)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<table cellspacing="0" cellpadding="0" border="0" width="100%" class="table">
<tr>
	<th width="1%">
		<input type="checkbox" name="check_all" value="Y" title="<?php echo fn_get_lang_var('check_uncheck_all', $this->getLanguage()); ?>
" class="checkbox cm-check-items" /></th>
	<th width="29%"><?php echo fn_get_lang_var('language_variable', $this->getLanguage()); ?>
</th>
	<th width="60%"><?php echo fn_get_lang_var('value', $this->getLanguage()); ?>
</th>
	<th width="10%">&nbsp;</th>
</tr>
<?php $_from = $this->_tpl_vars['lang_data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['var']):
?>
<tr <?php echo smarty_function_cycle(array('values' => "class=\"table-row\", ",'name' => '2'), $this);?>
 valign="top">
	<td width="1%">
		<input type="checkbox" name="names[]" value="<?php echo $this->_tpl_vars['var']['name']; ?>
" class="checkbox cm-item" /></td>
	<td width="29%">
		<input type="hidden" name="lang_data[<?php echo $this->_tpl_vars['key']; ?>
][name]" value="<?php echo $this->_tpl_vars['var']['name']; ?>
" />
		<p><span><?php echo $this->_tpl_vars['var']['name']; ?>
</span></p></td>
	<td width="60%">
		<textarea name="lang_data[<?php echo $this->_tpl_vars['key']; ?>
][value]" cols="55" rows="3" class="input-text"><?php echo $this->_tpl_vars['var']['value']; ?>
</textarea></td>
	<td width="10%" class="nowrap">

		<?php ob_start(); ?>
		<li><a class="cm-confirm" href="<?php echo fn_url("languages.delete_variable?name=".($this->_tpl_vars['var']['name']).($this->_tpl_vars['page'])); ?>
">

				<?php echo fn_get_lang_var('delete', $this->getLanguage()); ?>


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

<?php if ($this->_tpl_vars['lang_data']): ?>
	<div class="buttons-container buttons-bg">
		<div class="float-left">
			<?php ob_start(); ?>
			<ul>
				<li><a name="dispatch[languages.m_delete_variables]" class="cm-process-items cm-confirm" rev="language_variables_form"><?php echo fn_get_lang_var('delete_selected', $this->getLanguage()); ?>
</a></li>
			</ul>
			<?php $this->_smarty_vars['capture']['tools_list'] = ob_get_contents(); ob_end_clean(); ?>
			<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/save.tpl", 'smarty_include_vars' => array('but_name' => "dispatch[languages.m_update_variables]",'but_role' => 'button_main')));
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
		
			<?php ob_start(); ?>
				
					<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/popupbox.tpl", 'smarty_include_vars' => array('id' => 'add_language','text' => fn_get_lang_var('new_language', $this->getLanguage()),'link_text' => fn_get_lang_var('add_language', $this->getLanguage()),'content' => $this->_smarty_vars['capture']['add_language'],'act' => 'general')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				
				<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/popupbox.tpl", 'smarty_include_vars' => array('id' => 'add_langvar','text' => fn_get_lang_var('new_language_variable', $this->getLanguage()),'link_text' => fn_get_lang_var('add_language_variable', $this->getLanguage()),'content' => $this->_smarty_vars['capture']['add_langvar'],'act' => 'general')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<?php $this->_smarty_vars['capture']['tools'] = ob_get_contents(); ob_end_clean(); ?>

	</div>
<?php endif; ?>
</form>

<?php ob_start(); ?>

<form action="<?php echo fn_url(""); ?>
" method="post" name="lang_add_var">
<input type="hidden" name="page" value="<?php echo $this->_tpl_vars['_REQUEST']['page']; ?>
" />
<input type="hidden" name="q" value="<?php echo $this->_tpl_vars['_REQUEST']['q']; ?>
" />
<input type="hidden" name="selected_section" value="<?php echo $this->_tpl_vars['_REQUEST']['selected_section']; ?>
" />

<table cellpadding="0" cellspacing="0" border="0" width="100%" class="add-new-table">
<tr class="cm-first-sibling">
	<th width="35%"><?php echo fn_get_lang_var('language_variable', $this->getLanguage()); ?>
</th>
	<th width="64%"><?php echo fn_get_lang_var('value', $this->getLanguage()); ?>
</th>
	<th width="1%">&nbsp;</th>
</tr>
<tr id="box_new_lang_tag" valign="top">
	<td>
		<input type="text" size="30" name="new_lang_data[0][name]" class="input-text" /></td>
	<td>
		<textarea name="new_lang_data[0][value]" cols="48" rows="2" class="input-textarea-long"></textarea></td>
	<td>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/multiple_buttons.tpl", 'smarty_include_vars' => array('item_id' => 'new_lang_tag')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></td>
</tr>
</table>

<div class="buttons-container">
	<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/save_cancel.tpl", 'smarty_include_vars' => array('create' => true,'but_name' => "dispatch[languages.update_variables]",'cancel_action' => 'close')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>

</form>

<?php $this->_smarty_vars['capture']['add_langvar'] = ob_get_contents(); ob_end_clean(); ?>

</div>

<div class="hidden" id="content_languages">


<?php ob_start(); ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/languages/update.tpl", 'smarty_include_vars' => array('mode' => 'add')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $this->_smarty_vars['capture']['add_language'] = ob_get_contents(); ob_end_clean(); ?>

<form action="<?php echo fn_url(""); ?>
" method="post" name="languages_form" class="<?php if (defined('COMPANY_ID')): ?>cm-hide-inputs<?php endif; ?>">
<input type="hidden" name="page" value="<?php echo $this->_tpl_vars['_REQUEST']['page']; ?>
" />
<input type="hidden" name="selected_section" value="<?php echo $this->_tpl_vars['_REQUEST']['selected_section']; ?>
" />

<table cellspacing="0" cellpadding="0" border="0" width="100%" class="table">
<tr class="cm-first-sibling">
	<th class="center" width="1%">
		<input type="checkbox" name="check_all" value="Y" title="<?php echo fn_get_lang_var('check_uncheck_all', $this->getLanguage()); ?>
" class="checkbox cm-check-items" /></th>
	<th><?php echo fn_get_lang_var('language_code', $this->getLanguage()); ?>
</th>
	<th><?php echo fn_get_lang_var('name', $this->getLanguage()); ?>
</th>
	<th width="100%"><?php echo fn_get_lang_var('status', $this->getLanguage()); ?>
</th>
	<th>&nbsp;</th>
</tr>
<?php if (count($this->_tpl_vars['langs']) == 1): ?>
	<?php $this->assign('disable_change', true, false); ?>
<?php endif; ?>
<?php $_from = $this->_tpl_vars['langs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['language']):
?>
<tr <?php echo smarty_function_cycle(array('values' => "class=\"table-row\", "), $this);?>
>
	<td class="center" width="1%">
		<input type="checkbox" name="lang_codes[]" value="<?php echo $this->_tpl_vars['language']['lang_code']; ?>
" <?php if ($this->_tpl_vars['language']['lang_code'] == @DEFAULT_LANGUAGE): ?>disabled="disabled"<?php endif; ?> class="checkbox cm-item" /></td>
	<td>
		<input type="hidden" name="update_language[<?php echo $this->_tpl_vars['language']['lang_code']; ?>
][lang_code]" value="<?php echo $this->_tpl_vars['language']['lang_code']; ?>
" />
		<span><?php echo $this->_tpl_vars['language']['lang_code']; ?>
</span></td>
	<td>
		<input type="text" name="update_language[<?php echo $this->_tpl_vars['language']['lang_code']; ?>
][name]" value="<?php echo $this->_tpl_vars['language']['name']; ?>
" maxlength="64" class="input-text" /></td>
	<td>
		<?php if ($this->_tpl_vars['disable_change']): ?>
			<?php $this->assign('lang_id', "", false); ?>
		<?php else: ?>
			<?php $this->assign('lang_id', $this->_tpl_vars['language']['lang_code'], false); ?>
		<?php endif; ?>
		<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('id' => $this->_tpl_vars['lang_id'], 'prefix' => 'lng', 'status' => $this->_tpl_vars['language']['status'], 'hidden' => 'Y', 'object_id_name' => 'lang_code', 'table' => 'languages', 'update_controller' => 'languages', )); ?><?php if ($this->_tpl_vars['display'] == 'text'): ?>
	<span class="view-status">
		<?php if ($this->_tpl_vars['status'] == 'A'): ?>
			<?php echo fn_get_lang_var('active', $this->getLanguage()); ?>

		<?php elseif ($this->_tpl_vars['status'] == 'H'): ?>
			<?php echo fn_get_lang_var('hidden', $this->getLanguage()); ?>

		<?php elseif ($this->_tpl_vars['status'] == 'D'): ?>
			<?php echo fn_get_lang_var('disabled', $this->getLanguage()); ?>

		<?php elseif ($this->_tpl_vars['status'] == 'P'): ?>
			<?php echo fn_get_lang_var('pending', $this->getLanguage()); ?>

		<?php elseif ($this->_tpl_vars['status'] == 'N'): ?>
			<?php echo fn_get_lang_var('new', $this->getLanguage()); ?>

		<?php endif; ?>
	</span>
<?php else: ?>
	<?php $this->assign('prefix', smarty_modifier_default(@$this->_tpl_vars['prefix'], 'select'), false); ?>
	<div class="select-popup-container <?php echo $this->_tpl_vars['popup_additional_class']; ?>
">
		<?php if (! $this->_tpl_vars['hide_for_vendor']): ?>
		<div <?php if ($this->_tpl_vars['id']): ?>id="sw_<?php echo $this->_tpl_vars['prefix']; ?>
_<?php echo $this->_tpl_vars['id']; ?>
_wrap"<?php endif; ?> class="<?php if ($this->_tpl_vars['statuses'][$this->_tpl_vars['status']]['color']): ?>selected-status-base<?php else: ?>selected-status status-<?php if ($this->_tpl_vars['suffix']): ?><?php echo $this->_tpl_vars['suffix']; ?>
-<?php endif; ?><?php echo smarty_modifier_lower($this->_tpl_vars['status']); ?>
<?php endif; ?><?php if ($this->_tpl_vars['id']): ?> cm-combo-on cm-combination<?php endif; ?>">
			<a <?php if ($this->_tpl_vars['id']): ?>class="cm-combo-on<?php if (! $this->_tpl_vars['popup_disabled']): ?> cm-combination<?php endif; ?>"<?php endif; ?>>
		<?php endif; ?>
			<?php if ($this->_tpl_vars['items_status']): ?>
				<?php if (! is_array($this->_tpl_vars['items_status'])): ?>
					<?php $this->assign('items_status', fn_from_json($this->_tpl_vars['items_status']), false); ?>
				<?php endif; ?>
				<?php echo $this->_tpl_vars['items_status'][$this->_tpl_vars['status']]; ?>

			<?php else: ?>
				<?php if ($this->_tpl_vars['status'] == 'A'): ?>
					<?php echo fn_get_lang_var('active', $this->getLanguage()); ?>

				<?php elseif ($this->_tpl_vars['status'] == 'D'): ?>
					<?php echo fn_get_lang_var('disabled', $this->getLanguage()); ?>

				<?php elseif ($this->_tpl_vars['status'] == 'H'): ?>
					<?php echo fn_get_lang_var('hidden', $this->getLanguage()); ?>

				<?php elseif ($this->_tpl_vars['status'] == 'P'): ?>
					<?php echo fn_get_lang_var('pending', $this->getLanguage()); ?>

				<?php elseif ($this->_tpl_vars['status'] == 'N'): ?>
					<?php echo fn_get_lang_var('new', $this->getLanguage()); ?>

				<?php endif; ?>
			<?php endif; ?>
		<?php if (! $this->_tpl_vars['hide_for_vendor']): ?>
			</a>
			<?php if ($this->_tpl_vars['statuses'][$this->_tpl_vars['status']]['color']): ?>
			<span class="selected-status-icon" style="background-color: #<?php echo $this->_tpl_vars['statuses'][$this->_tpl_vars['status']]['color']; ?>
">&nbsp;</span>
			<?php endif; ?>

		</div>
		<?php endif; ?>
		<?php if ($this->_tpl_vars['id'] && ! $this->_tpl_vars['hide_for_vendor']): ?>
			<?php $this->assign('_update_controller', smarty_modifier_default(@$this->_tpl_vars['update_controller'], 'tools'), false); ?>
			<?php if ($this->_tpl_vars['table'] && $this->_tpl_vars['object_id_name']): ?><?php ob_start(); ?>&amp;table=<?php echo $this->_tpl_vars['table']; ?>
&amp;id_name=<?php echo $this->_tpl_vars['object_id_name']; ?>
<?php $this->_smarty_vars['capture']['_extra'] = ob_get_contents(); ob_end_clean(); ?><?php endif; ?>
			<div id="<?php echo $this->_tpl_vars['prefix']; ?>
_<?php echo $this->_tpl_vars['id']; ?>
_wrap" class="popup-tools cm-popup-box cm-smart-position hidden">
				<div class="status-scroll-y">
				<ul class="cm-select-list">
				<?php if ($this->_tpl_vars['items_status']): ?>
					<?php $_from = $this->_tpl_vars['items_status']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['st'] => $this->_tpl_vars['val']):
?>
					<li><a class="<?php if ($this->_tpl_vars['confirm']): ?>cm-confirm <?php endif; ?>status-link-<?php echo smarty_modifier_lower($this->_tpl_vars['st']); ?>
 <?php if ($this->_tpl_vars['status'] == $this->_tpl_vars['st']): ?>cm-active<?php else: ?>cm-ajax<?php endif; ?>"<?php if ($this->_tpl_vars['status_rev']): ?> rev="<?php echo $this->_tpl_vars['status_rev']; ?>
"<?php endif; ?> href="<?php echo fn_url(($this->_tpl_vars['_update_controller']).".update_status?id=".($this->_tpl_vars['id'])."&amp;status=".($this->_tpl_vars['st']).($this->_smarty_vars['capture']['_extra']).($this->_tpl_vars['extra'])); ?>
" onclick="return fn_check_object_status(this, '<?php echo smarty_modifier_lower($this->_tpl_vars['st']); ?>
', '<?php if ($this->_tpl_vars['statuses']): ?><?php echo smarty_modifier_default(@$this->_tpl_vars['statuses'][$this->_tpl_vars['st']]['color'], ''); ?>
<?php endif; ?>');" name="update_object_status_callback"><?php echo $this->_tpl_vars['val']; ?>
</a></li>
					<?php endforeach; endif; unset($_from); ?>
				<?php else: ?>
					<li><a class="<?php if ($this->_tpl_vars['confirm']): ?>cm-confirm <?php endif; ?>status-link-a <?php if ($this->_tpl_vars['status'] == 'A'): ?>cm-active<?php else: ?>cm-ajax<?php endif; ?>"<?php if ($this->_tpl_vars['status_rev']): ?> rev="<?php echo $this->_tpl_vars['status_rev']; ?>
"<?php endif; ?> href="<?php echo fn_url(($this->_tpl_vars['_update_controller']).".update_status?id=".($this->_tpl_vars['id'])."&amp;table=".($this->_tpl_vars['table'])."&amp;id_name=".($this->_tpl_vars['object_id_name'])."&amp;status=A".($this->_tpl_vars['dynamic_object'])); ?>
" onclick="return fn_check_object_status(this, 'a', '');" name="update_object_status_callback"><?php echo fn_get_lang_var('active', $this->getLanguage()); ?>
</a></li>
					<li><a class="<?php if ($this->_tpl_vars['confirm']): ?>cm-confirm <?php endif; ?>status-link-d <?php if ($this->_tpl_vars['status'] == 'D'): ?>cm-active<?php else: ?>cm-ajax<?php endif; ?>"<?php if ($this->_tpl_vars['status_rev']): ?> rev="<?php echo $this->_tpl_vars['status_rev']; ?>
"<?php endif; ?> href="<?php echo fn_url(($this->_tpl_vars['_update_controller']).".update_status?id=".($this->_tpl_vars['id'])."&amp;table=".($this->_tpl_vars['table'])."&amp;id_name=".($this->_tpl_vars['object_id_name'])."&amp;status=D".($this->_tpl_vars['dynamic_object'])); ?>
" onclick="return fn_check_object_status(this, 'd', '');" name="update_object_status_callback"><?php echo fn_get_lang_var('disabled', $this->getLanguage()); ?>
</a></li>
					<?php if ($this->_tpl_vars['hidden']): ?>
					<li><a class="<?php if ($this->_tpl_vars['confirm']): ?>cm-confirm <?php endif; ?>status-link-h <?php if ($this->_tpl_vars['status'] == 'H'): ?>cm-active<?php else: ?>cm-ajax<?php endif; ?>"<?php if ($this->_tpl_vars['status_rev']): ?> rev="<?php echo $this->_tpl_vars['status_rev']; ?>
"<?php endif; ?> href="<?php echo fn_url(($this->_tpl_vars['_update_controller']).".update_status?id=".($this->_tpl_vars['id'])."&amp;table=".($this->_tpl_vars['table'])."&amp;id_name=".($this->_tpl_vars['object_id_name'])."&amp;status=H".($this->_tpl_vars['dynamic_object'])); ?>
" onclick="return fn_check_object_status(this, 'h', '');" name="update_object_status_callback"><?php echo fn_get_lang_var('hidden', $this->getLanguage()); ?>
</a></li>
					<?php endif; ?>
					
					<?php if ($this->_tpl_vars['status'] == 'N'): ?>
					<li><a class="<?php if ($this->_tpl_vars['confirm']): ?>cm-confirm <?php endif; ?>status-link-p <?php if ($this->_tpl_vars['status'] == 'P'): ?>cm-active<?php else: ?>cm-ajax<?php endif; ?>"<?php if ($this->_tpl_vars['status_rev']): ?> rev="<?php echo $this->_tpl_vars['status_rev']; ?>
"<?php endif; ?> href="<?php echo fn_url(($this->_tpl_vars['_update_controller']).".update_status?id=".($this->_tpl_vars['id'])."&amp;table=".($this->_tpl_vars['table'])."&amp;id_name=".($this->_tpl_vars['object_id_name'])."&amp;status=P".($this->_tpl_vars['dynamic_object'])); ?>
" onclick="return fn_check_object_status(this, 'p', '');" name="update_object_status_callback"><?php echo fn_get_lang_var('pending', $this->getLanguage()); ?>
</a></li>
					<?php endif; ?>
				<?php endif; ?>
				</ul>
				</div>
				<?php ob_start(); ?>
				<?php if ($this->_tpl_vars['notify']): ?>
					<li class="select-field">
						<input type="checkbox" name="__notify_user" id="<?php echo $this->_tpl_vars['prefix']; ?>
_<?php echo $this->_tpl_vars['id']; ?>
_notify" value="Y" class="checkbox" checked="checked" onclick="$('input[name=__notify_user]').attr('checked', this.checked);" />
						<label for="<?php echo $this->_tpl_vars['prefix']; ?>
_<?php echo $this->_tpl_vars['id']; ?>
_notify"><?php echo smarty_modifier_default(@$this->_tpl_vars['notify_text'], fn_get_lang_var('notify_customer', $this->getLanguage())); ?>
</label>
					</li>
				<?php endif; ?>
				<?php if ($this->_tpl_vars['notify_department']): ?>
					<li class="select-field notify-department">
						<input type="checkbox" name="__notify_department" id="<?php echo $this->_tpl_vars['prefix']; ?>
_<?php echo $this->_tpl_vars['id']; ?>
_notify_department" value="Y" class="checkbox" checked="checked" onclick="$('input[name=__notify_department]').attr('checked', this.checked);" />
						<label for="<?php echo $this->_tpl_vars['prefix']; ?>
_<?php echo $this->_tpl_vars['id']; ?>
_notify_department"><?php echo fn_get_lang_var('notify_orders_department', $this->getLanguage()); ?>
</label>
					</li>
				<?php endif; ?>
				
				<?php if ($this->_tpl_vars['notify_supplier']): ?>
					<li class="select-field notify-department">
						<input type="checkbox" name="__notify_supplier" id="<?php echo $this->_tpl_vars['prefix']; ?>
_<?php echo $this->_tpl_vars['id']; ?>
_notify_supplier" value="Y" class="checkbox" checked="checked" onclick="$('input[name=__notify_supplier]').attr('checked', this.checked);" />
						<label for="<?php echo $this->_tpl_vars['prefix']; ?>
_<?php echo $this->_tpl_vars['id']; ?>
_notify_supplier"><?php if (@PRODUCT_TYPE == 'MULTIVENDOR' || @PRODUCT_TYPE == 'ULTIMATE'): ?><?php echo fn_get_lang_var('notify_vendor', $this->getLanguage()); ?>
<?php else: ?><?php echo fn_get_lang_var('notify_supplier', $this->getLanguage()); ?>
<?php endif; ?></label>
					</li>
				<?php endif; ?>
				
				<?php $this->_smarty_vars['capture']['list_items'] = ob_get_contents(); ob_end_clean(); ?>
				
				<?php if (trim($this->_smarty_vars['capture']['list_items'])): ?>
				<ul class="cm-select-list select-list-tools">
					<?php echo $this->_smarty_vars['capture']['list_items']; ?>

				</ul>
				<?php endif; ?>
			</div>
			<?php if (! $this->_smarty_vars['capture']['avail_box']): ?>
			<script type="text/javascript">
			//<![CDATA[
			<?php echo '
			function fn_check_object_status(obj, status, color) 
			{
				if ($(obj).hasClass(\'cm-active\')) {
					$(obj).removeClass(\'cm-ajax\');
					return false;
				}
				fn_update_object_status(obj, status, color);
				return true;
			}
			function fn_update_object_status_callback(data, params) 
			{
				if (data.return_status && params.obj) {
					var color = data.color ? data.color : \'\';
					fn_update_object_status(params.obj, data.return_status.toLowerCase(), color);
				}
			}
			function fn_update_object_status(obj, status, color)
			{
				var upd_elm_id = $(obj).parents(\'.cm-popup-box:first\').attr(\'id\');
				var upd_elm = $(\'#\' + upd_elm_id);
				upd_elm.hide();
				$(obj).attr(\'href\', fn_query_remove($(obj).attr(\'href\'), [\'notify_user\', \'notify_department\']));
				if ($(\'input[name=__notify_user]:checked\', upd_elm).length) {
					$(obj).attr(\'href\', $(obj).attr(\'href\') + \'&notify_user=Y\');
				}
				if ($(\'input[name=__notify_department]:checked\', upd_elm).length) {
					$(obj).attr(\'href\', $(obj).attr(\'href\') + \'&notify_department=Y\');
				}
				
				if ($(\'input[name=__notify_supplier]:checked\', upd_elm).length) {
					$(obj).attr(\'href\', $(obj).attr(\'href\') + \'&notify_supplier=Y\');
				}
				
				$(\'.cm-select-list li a\', upd_elm).removeClass(\'cm-active\').addClass(\'cm-ajax\');
				$(\'.status-link-\' + status, upd_elm).addClass(\'cm-active\');
				$(\'#sw_\' + upd_elm_id + \' a\').text($(\'.status-link-\' + status, upd_elm).text());
				if (color) {
					$(\'#sw_\' + upd_elm_id).removeAttr(\'class\').addClass(\'selected-status-base \' + $(\'#sw_\' + upd_elm_id + \' a\').attr(\'class\'));
					$(\'#sw_\' + upd_elm_id).children(\'.selected-status-icon:first\').css(\'background-color\', \'#\' + color);
				} else {
					'; ?>

					$('#sw_' + upd_elm_id).removeAttr('class').addClass('selected-status status-<?php if ($this->_tpl_vars['suffix']): ?><?php echo $this->_tpl_vars['suffix']; ?>
-<?php endif; ?>' + status + ' ' + $('#sw_' + upd_elm_id + ' a').attr('class'));
					<?php echo '
				}
			}
			'; ?>

			//]]>
			</script>
			<?php ob_start(); ?>Y<?php $this->_smarty_vars['capture']['avail_box'] = ob_get_contents(); ob_end_clean(); ?>
			<?php endif; ?>
		<?php endif; ?>
	</div>
<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
	</td>
	<td class="nowrap">
		<?php ob_start(); ?>
		<?php if ($this->_tpl_vars['language']['lang_code'] == @DEFAULT_LANGUAGE): ?>
			<li><span class="undeleted-element"><?php echo fn_get_lang_var('delete', $this->getLanguage()); ?>
</span></li>
		<?php else: ?>
			<li><a class="cm-confirm" href="<?php echo fn_url("languages.delete_language?lang_code=".($this->_tpl_vars['language']['lang_code'])); ?>
"><?php echo fn_get_lang_var('delete', $this->getLanguage()); ?>
</a></li>
		<?php endif; ?>
		<?php $this->_smarty_vars['capture']['tools_items'] = ob_get_contents(); ob_end_clean(); ?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/table_tools_list.tpl", 'smarty_include_vars' => array('prefix' => $this->_tpl_vars['language']['lang_code'],'tools_list' => $this->_smarty_vars['capture']['tools_items'],'href' => "languages.update?lang_code=".($this->_tpl_vars['language']['lang_code']),'link_text' => fn_get_lang_var('edit', $this->getLanguage()),'extra_class' => "cm-dialog-opener text-button-edit cm-ajax-update",'link_extra' => "id='opener_".($this->_tpl_vars['language']['lang_code'])."' rev='content_".($this->_tpl_vars['language']['lang_code'])."'")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</td>
	<?php ob_start(); ?>
		<?php echo $this->_smarty_vars['capture']['popups']; ?>

		<div id="content_<?php echo $this->_tpl_vars['language']['lang_code']; ?>
" class="hidden" title="<?php echo (fn_get_lang_var('editing_language', $this->getLanguage())).": ".($this->_tpl_vars['language']['name']); ?>
"></div>
	<?php $this->_smarty_vars['capture']['popups'] = ob_get_contents(); ob_end_clean(); ?>
</tr>
<?php endforeach; endif; unset($_from); ?>
</table>


<div class="buttons-container buttons-bg">
	
	<div class="float-left">
		<?php ob_start(); ?>
		<ul>
			<li><a name="dispatch[languages.m_delete]" class="cm-process-items cm-confirm" rev="languages_form"><?php echo fn_get_lang_var('delete_selected', $this->getLanguage()); ?>
</a></li>
		</ul>
		<?php $this->_smarty_vars['capture']['tools_list'] = ob_get_contents(); ob_end_clean(); ?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/save.tpl", 'smarty_include_vars' => array('but_name' => "dispatch[languages.m_update]",'but_role' => 'button_main')));
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
	
		<?php ob_start(); ?>
			
				<?php if (! defined('COMPANY_ID')): ?>
					<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/popupbox.tpl", 'smarty_include_vars' => array('id' => 'add_language','text' => fn_get_lang_var('new_language', $this->getLanguage()),'link_text' => fn_get_lang_var('add_language', $this->getLanguage()),'content' => $this->_smarty_vars['capture']['add_language'],'act' => 'general')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				<?php endif; ?>
			
			<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/popupbox.tpl", 'smarty_include_vars' => array('id' => 'add_langvar','text' => fn_get_lang_var('new_language_variable', $this->getLanguage()),'link_text' => fn_get_lang_var('add_language_variable', $this->getLanguage()),'content' => $this->_smarty_vars['capture']['add_langvar'],'act' => 'general')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<?php $this->_smarty_vars['capture']['tools'] = ob_get_contents(); ob_end_clean(); ?>
</div>

</form>

</div>

<?php echo $this->_smarty_vars['capture']['popups']; ?>


<?php $this->_smarty_vars['capture']['tabsbox'] = ob_get_contents(); ob_end_clean(); ?>
<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('content' => $this->_smarty_vars['capture']['tabsbox'], 'active_tab' => $this->_tpl_vars['_REQUEST']['selected_section'], 'track' => true, )); ?><?php echo smarty_function_script(array('src' => "js/tabs.js"), $this);?>


<?php if (! $this->_tpl_vars['active_tab']): ?>
	<?php $this->assign('active_tab', $this->_tpl_vars['_REQUEST']['selected_section'], false); ?>
<?php endif; ?>

<?php $this->assign('empty_tab_ids', smarty_modifier_empty_tabs($this->_tpl_vars['content']), false); ?>

<?php if ($this->_tpl_vars['navigation']['tabs']): ?>
<div class="tabs cm-j-tabs<?php if ($this->_tpl_vars['track']): ?> cm-track<?php endif; ?>">
	<ul>
	<?php $_from = $this->_tpl_vars['navigation']['tabs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['tabs'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['tabs']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['tab']):
        $this->_foreach['tabs']['iteration']++;
?>
		<?php if (( ! $this->_tpl_vars['tabs_section'] || $this->_tpl_vars['tabs_section'] == $this->_tpl_vars['tab']['section'] ) && ( $this->_tpl_vars['tab']['hidden'] || ! smarty_modifier_in_array($this->_tpl_vars['key'], $this->_tpl_vars['empty_tab_ids']) )): ?>
		<li id="<?php echo $this->_tpl_vars['key']; ?>
<?php echo $this->_tpl_vars['id_suffix']; ?>
" class="<?php if ($this->_tpl_vars['tab']['hidden'] == 'Y'): ?>hidden <?php endif; ?><?php if ($this->_tpl_vars['tab']['js']): ?>cm-js<?php elseif ($this->_tpl_vars['tab']['ajax']): ?>cm-js cm-ajax<?php endif; ?><?php if ($this->_tpl_vars['key'] == $this->_tpl_vars['active_tab']): ?> cm-active<?php endif; ?>"><a <?php if ($this->_tpl_vars['tab']['href']): ?>href="<?php echo fn_url($this->_tpl_vars['tab']['href']); ?>
"<?php endif; ?>><?php echo $this->_tpl_vars['tab']['title']; ?>
</a><?php if ($this->_tpl_vars['key'] == $this->_tpl_vars['active_tab']): ?><?php echo $this->_tpl_vars['active_tab_extra']; ?>
<?php endif; ?></li>
		<?php endif; ?>
	<?php endforeach; endif; unset($_from); ?>
	</ul>
</div>
<div class="cm-tabs-content">
	<?php echo $this->_tpl_vars['content']; ?>

</div>
<?php else: ?>
	<?php echo $this->_tpl_vars['content']; ?>

<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>

<?php $this->_smarty_vars['capture']['mainbox'] = ob_get_contents(); ob_end_clean(); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/mainbox.tpl", 'smarty_include_vars' => array('title' => fn_get_lang_var('languages', $this->getLanguage()),'content' => $this->_smarty_vars['capture']['mainbox'],'tools' => $this->_smarty_vars['capture']['tools'],'select_languages' => true)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>