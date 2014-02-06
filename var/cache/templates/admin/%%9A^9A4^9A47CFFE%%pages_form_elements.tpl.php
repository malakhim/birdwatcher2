<?php /* Smarty version 2.6.18, created on 2014-02-03 15:24:49
         compiled from addons/form_builder/views/pages/components/pages_form_elements.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'hook', 'addons/form_builder/views/pages/components/pages_form_elements.tpl', 85, false),array('modifier', 'strstr', 'addons/form_builder/views/pages/components/pages_form_elements.tpl', 100, false),array('modifier', 'default', 'addons/form_builder/views/pages/components/pages_form_elements.tpl', 117, false),array('modifier', 'lower', 'addons/form_builder/views/pages/components/pages_form_elements.tpl', 120, false),array('modifier', 'is_array', 'addons/form_builder/views/pages/components/pages_form_elements.tpl', 124, false),array('modifier', 'fn_from_json', 'addons/form_builder/views/pages/components/pages_form_elements.tpl', 125, false),array('modifier', 'fn_url', 'addons/form_builder/views/pages/components/pages_form_elements.tpl', 157, false),array('modifier', 'trim', 'addons/form_builder/views/pages/components/pages_form_elements.tpl', 195, false),array('modifier', 'substr_count', 'addons/form_builder/views/pages/components/pages_form_elements.tpl', 261, false),array('function', 'math', 'addons/form_builder/views/pages/components/pages_form_elements.tpl', 279, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('position_short','name','type','required','status','base','selectbox','radiogroup','multiple_checkboxes','multiple_selectbox','checkbox','input_field','textarea','header','separator','special','date','email','number','phone','countries_list','states_list','file','referer','ip_address','active','hidden','disabled','pending','new','active','disabled','hidden','pending','new','active','disabled','hidden','pending','notify_customer','notify_orders_department','notify_vendor','notify_supplier','position_short','name','base','selectbox','radiogroup','multiple_checkboxes','multiple_selectbox','checkbox','input_field','textarea','header','separator','special','date','email','number','phone','countries_list','states_list','file','referer','ip_address','active','hidden','disabled','status','active','hidden','disabled','status','active','hidden','pending','disabled','position_short','description'));
?>
<?php 

				$rname = !empty($resource_name) ? $resource_name : $params['smarty_include_tpl_file'];
				if ($this->compile_check && empty($inline_no_check[$rname]) && $this->is_cached($rname)) {
					if ($this->check_inline_blocks(array (
  'common_templates/select_status.tpl' => 1367063753,
))) {
						$_smarty_compile_path = $this->_get_compile_path($rname);
						$this->_compile_resource($rname, $_smarty_compile_path);
						$inline_no_check[$rname] = true;
						include $_smarty_compile_path;
						return;
					}
				}
			 ?><?php echo '
<script type="text/javascript">
	//<![CDATA[
	function fn_check_element_type(elm, id, selectable_elements)
	{
		var elem_id = id.replace(\'elm_\', \'box_element_variants_\');
		$(\'#\' + elem_id).toggleBy(selectable_elements.indexOf(elm) == -1);

		// Hide description box for separator
		$(\'#descr_\' + id).toggleBy((elm == \'D\'));
		$(\'#hr_\' + id).toggleBy((elm != \'D\'));

		$(\'#req_\' + id).attr(\'disabled\', (elm == \'D\' || elm == \'H\') ? \'disabled\' : \'\');
	}

	function fn_go_check_element_type()
	{
		if (!window[\'_counter\']) {
			return;
		}
		var c_id = window[\'_counter\'];

		$(\'#elm_add_variants_\' + c_id).trigger(\'change\');

		var new_elms = $(\'#box_element_variants_add_variants_\' + c_id);
		$(\'.cm-elm-variants\', new_elms).each(function() {
			if ($(this).attr(\'id\') != \'box_elm_variants_add_variants_\' + c_id) {
				$(this).remove();
			}
		});
	}
	//]]>
</script>
'; ?>


<hr width="100%" />

<table cellpadding="0" cellspacing="0" border="0" width="100%" class="table">
<tr>
	<th><?php echo fn_get_lang_var('position_short', $this->getLanguage()); ?>
</th>
	<th width="50%"><?php echo fn_get_lang_var('name', $this->getLanguage()); ?>
</th>
	<th><?php echo fn_get_lang_var('type', $this->getLanguage()); ?>
</th>
	<th><?php echo fn_get_lang_var('required', $this->getLanguage()); ?>
</th>
	<th width="15%"><?php echo fn_get_lang_var('status', $this->getLanguage()); ?>
</th>
	<th>&nbsp;</th>
</tr>
<?php $_from = $this->_tpl_vars['elements']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['fe_e'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['fe_e']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['element']):
        $this->_foreach['fe_e']['iteration']++;
?>
<?php $this->assign('num', $this->_foreach['fe_e']['iteration'], false); ?>
<tbody class="cm-row-item">
<tr>
	<td>
		<input type="hidden" name="page_data[form][elements_data][<?php echo $this->_tpl_vars['num']; ?>
][element_id]" value="<?php echo $this->_tpl_vars['element']['element_id']; ?>
" />
		<input class="input-text-short" type="text" size="3" name="page_data[form][elements_data][<?php echo $this->_tpl_vars['num']; ?>
][position]" value="<?php echo $this->_tpl_vars['element']['position']; ?>
" /></td>
	<td>
		<input id="descr_elm_<?php echo $this->_tpl_vars['element']['element_id']; ?>
" class="input-text-long <?php if ($this->_tpl_vars['element']['element_type'] == @FORM_SEPARATOR): ?>hidden<?php endif; ?>" type="text" name="page_data[form][elements_data][<?php echo $this->_tpl_vars['num']; ?>
][description]" value="<?php echo $this->_tpl_vars['element']['description']; ?>
" />
		<hr id="hr_elm_<?php echo $this->_tpl_vars['element']['element_id']; ?>
" width="100%" <?php if ($this->_tpl_vars['element']['element_type'] != @FORM_SEPARATOR): ?>class="hidden"<?php endif; ?> /></td>
	<td>
		<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('element_type' => $this->_tpl_vars['element']['element_type'], 'elm_id' => $this->_tpl_vars['element']['element_id'], )); ?><select id="elm_<?php echo $this->_tpl_vars['elm_id']; ?>
" name="page_data[form][elements_data][<?php echo $this->_tpl_vars['num']; ?>
][element_type]" onchange="fn_check_element_type(this.value, this.id, '<?php echo $this->_tpl_vars['selectable_elements']; ?>
');">
	<optgroup label="<?php echo fn_get_lang_var('base', $this->getLanguage()); ?>
">
	<option value="<?php echo @FORM_SELECT; ?>
" <?php if ($this->_tpl_vars['element_type'] == @FORM_SELECT): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('selectbox', $this->getLanguage()); ?>
</option>
	<option value="<?php echo @FORM_RADIO; ?>
" <?php if ($this->_tpl_vars['element_type'] == @FORM_RADIO): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('radiogroup', $this->getLanguage()); ?>
</option>
	<option value="<?php echo @FORM_MULTIPLE_CB; ?>
" <?php if ($this->_tpl_vars['element_type'] == @FORM_MULTIPLE_CB): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('multiple_checkboxes', $this->getLanguage()); ?>
</option>
	<option value="<?php echo @FORM_MULTIPLE_SB; ?>
" <?php if ($this->_tpl_vars['element_type'] == @FORM_MULTIPLE_SB): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('multiple_selectbox', $this->getLanguage()); ?>
</option>
	<option value="<?php echo @FORM_CHECKBOX; ?>
" <?php if ($this->_tpl_vars['element_type'] == @FORM_CHECKBOX): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('checkbox', $this->getLanguage()); ?>
</option>
	<option value="<?php echo @FORM_INPUT; ?>
" <?php if ($this->_tpl_vars['element_type'] == @FORM_INPUT): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('input_field', $this->getLanguage()); ?>
</option>
	<option value="<?php echo @FORM_TEXTAREA; ?>
" <?php if ($this->_tpl_vars['element_type'] == @FORM_TEXTAREA): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('textarea', $this->getLanguage()); ?>
</option>
	<option value="<?php echo @FORM_HEADER; ?>
" <?php if ($this->_tpl_vars['element_type'] == @FORM_HEADER): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('header', $this->getLanguage()); ?>
</option>
	<option value="<?php echo @FORM_SEPARATOR; ?>
" <?php if ($this->_tpl_vars['element_type'] == @FORM_SEPARATOR): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('separator', $this->getLanguage()); ?>
</option>
	</optgroup>
	<optgroup label="<?php echo fn_get_lang_var('special', $this->getLanguage()); ?>
">
	<?php $this->_tag_stack[] = array('hook', array('name' => "pages:form_elements")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
	<option value="<?php echo @FORM_DATE; ?>
" <?php if ($this->_tpl_vars['element_type'] == @FORM_DATE): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('date', $this->getLanguage()); ?>
</option>
	<option value="<?php echo @FORM_EMAIL; ?>
" <?php if ($this->_tpl_vars['element_type'] == @FORM_EMAIL): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('email', $this->getLanguage()); ?>
</option>
	<option value="<?php echo @FORM_NUMBER; ?>
" <?php if ($this->_tpl_vars['element_type'] == @FORM_NUMBER): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('number', $this->getLanguage()); ?>
</option>
	<option value="<?php echo @FORM_PHONE; ?>
" <?php if ($this->_tpl_vars['element_type'] == @FORM_PHONE): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('phone', $this->getLanguage()); ?>
</option>
	<option value="<?php echo @FORM_COUNTRIES; ?>
" <?php if ($this->_tpl_vars['element_type'] == @FORM_COUNTRIES): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('countries_list', $this->getLanguage()); ?>
</option>
	<option value="<?php echo @FORM_STATES; ?>
" <?php if ($this->_tpl_vars['element_type'] == @FORM_STATES): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('states_list', $this->getLanguage()); ?>
</option>
	<option value="<?php echo @FORM_FILE; ?>
" <?php if ($this->_tpl_vars['element_type'] == @FORM_FILE): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('file', $this->getLanguage()); ?>
</option>
	<option value="<?php echo @FORM_REFERER; ?>
" <?php if ($this->_tpl_vars['element_type'] == @FORM_REFERER): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('referer', $this->getLanguage()); ?>
</option>
	<option value="<?php echo @FORM_IP_ADDRESS; ?>
" <?php if ($this->_tpl_vars['element_type'] == @FORM_IP_ADDRESS): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('ip_address', $this->getLanguage()); ?>
</option>
	<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
	</optgroup>
</select><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?></td>
	<td class="center">
		<input type="hidden" name="page_data[form][elements_data][<?php echo $this->_tpl_vars['num']; ?>
][required]" value="N" />
		<input id="req_elm_<?php echo $this->_tpl_vars['element']['element_id']; ?>
" type="checkbox" <?php if (strstr('HD', $this->_tpl_vars['element']['element_type'])): ?>disabled="disabled"<?php endif; ?> name="page_data[form][elements_data][<?php echo $this->_tpl_vars['num']; ?>
][required]" value="Y" <?php if ($this->_tpl_vars['element']['required'] == 'Y'): ?>checked="checked"<?php endif; ?> class="checkbox" /></td>
	<td>
		<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('id' => $this->_tpl_vars['element']['element_id'], 'prefix' => 'elm', 'status' => $this->_tpl_vars['element']['status'], 'hidden' => "", 'object_id_name' => 'element_id', 'table' => 'form_options', )); ?><?php if ($this->_tpl_vars['display'] == 'text'): ?>
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
<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?></td>
	<td>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/multiple_buttons.tpl", 'smarty_include_vars' => array('only_delete' => 'Y')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></td>
</tr>
<tr id="box_element_variants_<?php echo $this->_tpl_vars['element']['element_id']; ?>
" <?php if (! substr_count($this->_tpl_vars['selectable_elements'], $this->_tpl_vars['element']['element_type'])): ?>class="hidden"<?php endif; ?>>
	<td>&nbsp;</td>
	<td colspan="5">
		<table cellpadding="0" cellspacing="0" border="0" class="table">
		<tr class="cm-first-sibling">
			<th><?php echo fn_get_lang_var('position_short', $this->getLanguage()); ?>
</th>
			<th><?php echo fn_get_lang_var('name', $this->getLanguage()); ?>
</th>
			<th>&nbsp;</th>
		</tr>
		<?php $_from = $this->_tpl_vars['element']['variants']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['vnum'] => $this->_tpl_vars['var']):
?>
		<tr class="cm-first-sibling cm-row-item">
			<td>
				<input type="hidden" name="page_data[form][elements_data][<?php echo $this->_tpl_vars['num']; ?>
][variants][<?php echo $this->_tpl_vars['vnum']; ?>
][element_id]" value="<?php echo $this->_tpl_vars['var']['element_id']; ?>
" />
				<input class="input-text-short" size="3" type="text" name="page_data[form][elements_data][<?php echo $this->_tpl_vars['num']; ?>
][variants][<?php echo $this->_tpl_vars['vnum']; ?>
][position]" value="<?php echo $this->_tpl_vars['var']['position']; ?>
" /></td>
			<td><input class="input-text" type="text" name="page_data[form][elements_data][<?php echo $this->_tpl_vars['num']; ?>
][variants][<?php echo $this->_tpl_vars['vnum']; ?>
][description]" value="<?php echo $this->_tpl_vars['var']['description']; ?>
" /></td>
			<td><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/multiple_buttons.tpl", 'smarty_include_vars' => array('only_delete' => 'Y')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></td>
		</tr>
		<?php endforeach; endif; unset($_from); ?>
		<?php echo smarty_function_math(array('equation' => "x + 1",'assign' => 'vnum','x' => smarty_modifier_default(@$this->_tpl_vars['vnum'], 0)), $this);?>

		<tr id="box_elm_variants_<?php echo $this->_tpl_vars['element']['element_id']; ?>
" class="cm-row-item cm-elm-variants">
			<td><input class="input-text-short" size="3" type="text" name="page_data[form][elements_data][<?php echo $this->_tpl_vars['num']; ?>
][variants][<?php echo $this->_tpl_vars['vnum']; ?>
][position]" /></td>
			<td><input class="input-text" type="text" name="page_data[form][elements_data][<?php echo $this->_tpl_vars['num']; ?>
][variants][<?php echo $this->_tpl_vars['vnum']; ?>
][description]" /></td>
			<td><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/multiple_buttons.tpl", 'smarty_include_vars' => array('item_id' => "elm_variants_".($this->_tpl_vars['element']['element_id']),'tag_level' => '5')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></td>
		</tr>
		</table>
	</td>
</tr>
</tbody>
<?php endforeach; endif; unset($_from); ?>

<?php echo smarty_function_math(array('equation' => "x + 1",'assign' => 'num','x' => smarty_modifier_default(@$this->_tpl_vars['num'], 0)), $this);?>

<tbody class="cm-row-item" id="box_add_elements">
<tr class="no-border">
	<td>
		<input class="input-text-short" size="3" type="text" name="page_data[form][elements_data][<?php echo $this->_tpl_vars['num']; ?>
][position]" value="" /></td>
	<td>
		<input id="descr_elm_add_variants" class="input-text-long" type="text" name="page_data[form][elements_data][<?php echo $this->_tpl_vars['num']; ?>
][description]" value="" />
		<hr id="hr_elm_add_variants" class="hidden" /></td>
	<td>
		<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('element_type' => "", 'elm_id' => 'add_variants', )); ?><select id="elm_<?php echo $this->_tpl_vars['elm_id']; ?>
" name="page_data[form][elements_data][<?php echo $this->_tpl_vars['num']; ?>
][element_type]" onchange="fn_check_element_type(this.value, this.id, '<?php echo $this->_tpl_vars['selectable_elements']; ?>
');">
	<optgroup label="<?php echo fn_get_lang_var('base', $this->getLanguage()); ?>
">
	<option value="<?php echo @FORM_SELECT; ?>
" <?php if ($this->_tpl_vars['element_type'] == @FORM_SELECT): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('selectbox', $this->getLanguage()); ?>
</option>
	<option value="<?php echo @FORM_RADIO; ?>
" <?php if ($this->_tpl_vars['element_type'] == @FORM_RADIO): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('radiogroup', $this->getLanguage()); ?>
</option>
	<option value="<?php echo @FORM_MULTIPLE_CB; ?>
" <?php if ($this->_tpl_vars['element_type'] == @FORM_MULTIPLE_CB): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('multiple_checkboxes', $this->getLanguage()); ?>
</option>
	<option value="<?php echo @FORM_MULTIPLE_SB; ?>
" <?php if ($this->_tpl_vars['element_type'] == @FORM_MULTIPLE_SB): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('multiple_selectbox', $this->getLanguage()); ?>
</option>
	<option value="<?php echo @FORM_CHECKBOX; ?>
" <?php if ($this->_tpl_vars['element_type'] == @FORM_CHECKBOX): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('checkbox', $this->getLanguage()); ?>
</option>
	<option value="<?php echo @FORM_INPUT; ?>
" <?php if ($this->_tpl_vars['element_type'] == @FORM_INPUT): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('input_field', $this->getLanguage()); ?>
</option>
	<option value="<?php echo @FORM_TEXTAREA; ?>
" <?php if ($this->_tpl_vars['element_type'] == @FORM_TEXTAREA): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('textarea', $this->getLanguage()); ?>
</option>
	<option value="<?php echo @FORM_HEADER; ?>
" <?php if ($this->_tpl_vars['element_type'] == @FORM_HEADER): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('header', $this->getLanguage()); ?>
</option>
	<option value="<?php echo @FORM_SEPARATOR; ?>
" <?php if ($this->_tpl_vars['element_type'] == @FORM_SEPARATOR): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('separator', $this->getLanguage()); ?>
</option>
	</optgroup>
	<optgroup label="<?php echo fn_get_lang_var('special', $this->getLanguage()); ?>
">
	<?php $this->_tag_stack[] = array('hook', array('name' => "pages:form_elements")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
	<option value="<?php echo @FORM_DATE; ?>
" <?php if ($this->_tpl_vars['element_type'] == @FORM_DATE): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('date', $this->getLanguage()); ?>
</option>
	<option value="<?php echo @FORM_EMAIL; ?>
" <?php if ($this->_tpl_vars['element_type'] == @FORM_EMAIL): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('email', $this->getLanguage()); ?>
</option>
	<option value="<?php echo @FORM_NUMBER; ?>
" <?php if ($this->_tpl_vars['element_type'] == @FORM_NUMBER): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('number', $this->getLanguage()); ?>
</option>
	<option value="<?php echo @FORM_PHONE; ?>
" <?php if ($this->_tpl_vars['element_type'] == @FORM_PHONE): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('phone', $this->getLanguage()); ?>
</option>
	<option value="<?php echo @FORM_COUNTRIES; ?>
" <?php if ($this->_tpl_vars['element_type'] == @FORM_COUNTRIES): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('countries_list', $this->getLanguage()); ?>
</option>
	<option value="<?php echo @FORM_STATES; ?>
" <?php if ($this->_tpl_vars['element_type'] == @FORM_STATES): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('states_list', $this->getLanguage()); ?>
</option>
	<option value="<?php echo @FORM_FILE; ?>
" <?php if ($this->_tpl_vars['element_type'] == @FORM_FILE): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('file', $this->getLanguage()); ?>
</option>
	<option value="<?php echo @FORM_REFERER; ?>
" <?php if ($this->_tpl_vars['element_type'] == @FORM_REFERER): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('referer', $this->getLanguage()); ?>
</option>
	<option value="<?php echo @FORM_IP_ADDRESS; ?>
" <?php if ($this->_tpl_vars['element_type'] == @FORM_IP_ADDRESS): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('ip_address', $this->getLanguage()); ?>
</option>
	<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
	</optgroup>
</select><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?></td>
	<td class="center">
		<input type="hidden" name="page_data[form][elements_data][<?php echo $this->_tpl_vars['num']; ?>
][required]" value="N" />
		<input id="req_elm_add_variants" type="checkbox" name="page_data[form][elements_data][<?php echo $this->_tpl_vars['num']; ?>
][required]" value="Y" checked="checked" class="checkbox" /></td>
	<td class="center">
		<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('input_name' => "page_data[form][elements_data][".($this->_tpl_vars['num'])."][status]", 'display' => 'select', )); ?><?php if ($this->_tpl_vars['display'] == 'select'): ?>
<select name="<?php echo $this->_tpl_vars['input_name']; ?>
" <?php if ($this->_tpl_vars['input_id']): ?>id="<?php echo $this->_tpl_vars['input_id']; ?>
"<?php endif; ?>>
	<option value="A" <?php if ($this->_tpl_vars['obj']['status'] == 'A'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('active', $this->getLanguage()); ?>
</option>
	<?php if ($this->_tpl_vars['hidden']): ?>
	<option value="H" <?php if ($this->_tpl_vars['obj']['status'] == 'H'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('hidden', $this->getLanguage()); ?>
</option>
	<?php endif; ?>
	<option value="D" <?php if ($this->_tpl_vars['obj']['status'] == 'D'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('disabled', $this->getLanguage()); ?>
</option>
</select>
<?php elseif ($this->_tpl_vars['display'] == 'text'): ?>
<div class="form-field">
	<label class="cm-required"><?php echo fn_get_lang_var('status', $this->getLanguage()); ?>
:</label>
	<span>
		<?php if ($this->_tpl_vars['obj']['status'] == 'A'): ?>
			<?php echo fn_get_lang_var('active', $this->getLanguage()); ?>

		<?php elseif ($this->_tpl_vars['obj']['status'] == 'H'): ?>
			<?php echo fn_get_lang_var('hidden', $this->getLanguage()); ?>

		<?php elseif ($this->_tpl_vars['obj']['status'] == 'D'): ?>
			<?php echo fn_get_lang_var('disabled', $this->getLanguage()); ?>

		<?php endif; ?>
	</span>
</div>
<?php else: ?>
<div class="form-field">
	<label class="cm-required"><?php echo fn_get_lang_var('status', $this->getLanguage()); ?>
:</label>
	<div class="select-field">
		<?php if ($this->_tpl_vars['items_status']): ?>
			<?php if (! is_array($this->_tpl_vars['items_status'])): ?>
				<?php $this->assign('items_status', fn_from_json($this->_tpl_vars['items_status']), false); ?>
			<?php endif; ?>
			<?php $_from = $this->_tpl_vars['items_status']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['status_cycle'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['status_cycle']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['st'] => $this->_tpl_vars['val']):
        $this->_foreach['status_cycle']['iteration']++;
?>
			<input type="radio" name="<?php echo $this->_tpl_vars['input_name']; ?>
" id="<?php echo $this->_tpl_vars['id']; ?>
_<?php echo smarty_modifier_default(@$this->_tpl_vars['obj_id'], 0); ?>
_<?php echo smarty_modifier_lower($this->_tpl_vars['st']); ?>
" <?php if ($this->_tpl_vars['obj']['status'] == $this->_tpl_vars['st'] || ( ! $this->_tpl_vars['obj']['status'] && ($this->_foreach['status_cycle']['iteration'] <= 1) )): ?>checked="checked"<?php endif; ?> value="<?php echo $this->_tpl_vars['st']; ?>
" class="radio" /><label for="<?php echo $this->_tpl_vars['id']; ?>
_<?php echo smarty_modifier_default(@$this->_tpl_vars['obj_id'], 0); ?>
_<?php echo smarty_modifier_lower($this->_tpl_vars['st']); ?>
"><?php echo $this->_tpl_vars['val']; ?>
</label>
			<?php endforeach; endif; unset($_from); ?>
		<?php else: ?>
		<input type="radio" name="<?php echo $this->_tpl_vars['input_name']; ?>
" id="<?php echo $this->_tpl_vars['id']; ?>
_<?php echo smarty_modifier_default(@$this->_tpl_vars['obj_id'], 0); ?>
_a" <?php if ($this->_tpl_vars['obj']['status'] == 'A' || ! $this->_tpl_vars['obj']['status']): ?>checked="checked"<?php endif; ?> value="A" class="radio" /><label for="<?php echo $this->_tpl_vars['id']; ?>
_<?php echo smarty_modifier_default(@$this->_tpl_vars['obj_id'], 0); ?>
_a"><?php echo fn_get_lang_var('active', $this->getLanguage()); ?>
</label>

		<?php if ($this->_tpl_vars['hidden']): ?>
		<input type="radio" name="<?php echo $this->_tpl_vars['input_name']; ?>
" id="<?php echo $this->_tpl_vars['id']; ?>
_<?php echo smarty_modifier_default(@$this->_tpl_vars['obj_id'], 0); ?>
_h" <?php if ($this->_tpl_vars['obj']['status'] == 'H'): ?>checked="checked"<?php endif; ?> value="H" class="radio" /><label for="<?php echo $this->_tpl_vars['id']; ?>
_<?php echo smarty_modifier_default(@$this->_tpl_vars['obj_id'], 0); ?>
_h"><?php echo fn_get_lang_var('hidden', $this->getLanguage()); ?>
</label>
		<?php endif; ?>

		<?php if ($this->_tpl_vars['obj']['status'] == 'P'): ?>
		<input type="radio" name="<?php echo $this->_tpl_vars['input_name']; ?>
" id="<?php echo $this->_tpl_vars['id']; ?>
_<?php echo smarty_modifier_default(@$this->_tpl_vars['obj_id'], 0); ?>
_p" checked="checked" value="P" class="radio" /><label for="<?php echo $this->_tpl_vars['id']; ?>
_<?php echo smarty_modifier_default(@$this->_tpl_vars['obj_id'], 0); ?>
_p"><?php echo fn_get_lang_var('pending', $this->getLanguage()); ?>
</label>
		<?php endif; ?>

		<input type="radio" name="<?php echo $this->_tpl_vars['input_name']; ?>
" id="<?php echo $this->_tpl_vars['id']; ?>
_<?php echo smarty_modifier_default(@$this->_tpl_vars['obj_id'], 0); ?>
_d" <?php if ($this->_tpl_vars['obj']['status'] == 'D'): ?>checked="checked"<?php endif; ?> value="D" class="radio" /><label for="<?php echo $this->_tpl_vars['id']; ?>
_<?php echo smarty_modifier_default(@$this->_tpl_vars['obj_id'], 0); ?>
_d"><?php echo fn_get_lang_var('disabled', $this->getLanguage()); ?>
</label>
		<?php endif; ?>
	</div>
</div>
<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?></td>
	<td><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/multiple_buttons.tpl", 'smarty_include_vars' => array('item_id' => 'add_elements','on_add' => "fn_go_check_element_type();")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></td>
</tr>
<tr id="box_element_variants_add_variants">
	<td>&nbsp;</td>
	<td colspan="5">
		<table cellpadding="0" cellspacing="0" border="0" width="1" class="table">
		<tr class="cm-first-sibling">
			<th><?php echo fn_get_lang_var('position_short', $this->getLanguage()); ?>
</th>
			<th><?php echo fn_get_lang_var('description', $this->getLanguage()); ?>
</th>
			<th>&nbsp;</th>
		</tr>
		<tr id="box_elm_variants_add_variants" class="cm-row-item cm-elm-variants">
			<td><input class="input-text-short" size="3" type="text" name="page_data[form][elements_data][<?php echo $this->_tpl_vars['num']; ?>
][variants][0][position]" /></td>
			<td><input class="input-text" type="text" name="page_data[form][elements_data][<?php echo $this->_tpl_vars['num']; ?>
][variants][0][description]" /></td>
			<td><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/multiple_buttons.tpl", 'smarty_include_vars' => array('item_id' => 'elm_variants_add_variants','tag_level' => '5')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></td>
		</tr>
		</table>
	</td>
</tr>
</tbody>


</table>