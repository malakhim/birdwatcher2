<?php /* Smarty version 2.6.18, created on 2014-03-10 11:52:09
         compiled from common_templates/settings_fields.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'unescape', 'common_templates/settings_fields.tpl', 21, false),array('modifier', 'in_array', 'common_templates/settings_fields.tpl', 31, false),array('modifier', 'escape', 'common_templates/settings_fields.tpl', 31, false),array('modifier', 'md5', 'common_templates/settings_fields.tpl', 49, false),array('modifier', 'fn_get_simple_countries', 'common_templates/settings_fields.tpl', 69, false),array('modifier', 'is_array', 'common_templates/settings_fields.tpl', 103, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('multiple_selectbox_notice','select_country','select_state','browse','selected_fields','available_fields','update_for_all_hid_act','update_for_all_hid_dis','update_for_all_act','update_for_all_dis'));
?>
<?php 

				$rname = !empty($resource_name) ? $resource_name : $params['smarty_include_tpl_file'];
				if ($this->compile_check && empty($inline_no_check[$rname]) && $this->is_cached($rname)) {
					if ($this->check_inline_blocks(array (
  'buttons/update_for_all.tpl' => 1367063753,
))) {
						$_smarty_compile_path = $this->_get_compile_path($rname);
						$this->_compile_resource($rname, $_smarty_compile_path);
						$inline_no_check[$rname] = true;
						include $_smarty_compile_path;
						return;
					}
				}
			 ?><?php if ($this->_tpl_vars['item']['update_for_all'] && $this->_tpl_vars['settings']['Stores']['default_state_update_for_all'] == 'not_active'): ?>
	<?php $this->assign('disable_input', true, false); ?>
<?php endif; ?>

<?php if ($this->_tpl_vars['item']['type'] == 'O'): ?>
	<div><?php echo smarty_modifier_unescape($this->_tpl_vars['item']['info']); ?>
</div>
<?php elseif ($this->_tpl_vars['item']['type'] == 'E'): ?>
	<div><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/".($this->_tpl_vars['_REQUEST']['addon'])."/settings/".($this->_tpl_vars['item']['value']), 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></div>
<?php elseif ($this->_tpl_vars['item']['type'] == 'Z'): ?>
	<div><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/".($this->_tpl_vars['_REQUEST']['addon'])."/settings/".($this->_tpl_vars['item']['value']), 'smarty_include_vars' => array('skip_addon_check' => true)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></div>
<?php elseif ($this->_tpl_vars['item']['type'] == 'H'): ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/subheader.tpl", 'smarty_include_vars' => array('title' => $this->_tpl_vars['item']['description'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php elseif ($this->_tpl_vars['item']['type'] != 'D'): ?>
		<div class="form-field">
		<label for="<?php echo $this->_tpl_vars['html_id']; ?>
" class="left description <?php if ($this->_tpl_vars['highlight'] && smarty_modifier_in_array($this->_tpl_vars['item']['name'], $this->_tpl_vars['highlight'])): ?>highlight<?php endif; ?> <?php if ($this->_tpl_vars['item']['type'] == 'X'): ?>cm-country cm-location-billing<?php elseif ($this->_tpl_vars['item']['type'] == 'W'): ?>cm-state cm-location-billing<?php endif; ?>" ><?php echo smarty_modifier_unescape($this->_tpl_vars['item']['description']); ?>
<?php if ($this->_tpl_vars['item']['tooltip']): ?><?php ob_start(); ?><?php echo $this->_tpl_vars['item']['tooltip']; ?>
<?php $this->_smarty_vars['capture']['tooltip'] = ob_get_contents(); ob_end_clean(); ?><?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('tooltip' => $this->_smarty_vars['capture']['tooltip'], )); ?><?php if ($this->_tpl_vars['tooltip']): ?> (<a class="cm-tooltip<?php if ($this->_tpl_vars['params']): ?> <?php echo $this->_tpl_vars['params']; ?>
<?php endif; ?>" title="<?php echo smarty_modifier_escape($this->_tpl_vars['tooltip'], 'html'); ?>
">?</a>)<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php endif; ?>:
		</label>
		<?php if ($this->_tpl_vars['item']['type'] == 'P'): ?>
			<input id="<?php echo $this->_tpl_vars['html_id']; ?>
" type="password" name="<?php echo $this->_tpl_vars['html_name']; ?>
" size="30" value="<?php echo $this->_tpl_vars['item']['value']; ?>
" class="input-text" <?php if ($this->_tpl_vars['disable_input']): ?>disabled="disabled"<?php endif; ?> />
		<?php elseif ($this->_tpl_vars['item']['type'] == 'T'): ?>
			<textarea id="<?php echo $this->_tpl_vars['html_id']; ?>
" name="<?php echo $this->_tpl_vars['html_name']; ?>
" rows="5" cols="19" class="input-text" <?php if ($this->_tpl_vars['disable_input']): ?>disabled="disabled"<?php endif; ?>><?php echo $this->_tpl_vars['item']['value']; ?>
</textarea>
		<?php elseif ($this->_tpl_vars['item']['type'] == 'C'): ?>
			<input type="hidden" name="<?php echo $this->_tpl_vars['html_name']; ?>
" value="N" <?php if ($this->_tpl_vars['disable_input']): ?>disabled="disabled"<?php endif; ?> />
			<input id="<?php echo $this->_tpl_vars['html_id']; ?>
" type="checkbox" name="<?php echo $this->_tpl_vars['html_name']; ?>
" value="Y" <?php if ($this->_tpl_vars['item']['value'] == 'Y'): ?>checked="checked"<?php endif; ?> class="checkbox" <?php if ($this->_tpl_vars['disable_input']): ?>disabled="disabled"<?php endif; ?> />
		<?php elseif ($this->_tpl_vars['item']['type'] == 'S'): ?>
			<select id="<?php echo $this->_tpl_vars['html_id']; ?>
" name="<?php echo $this->_tpl_vars['html_name']; ?>
" <?php if ($this->_tpl_vars['disable_input']): ?>disabled="disabled"<?php endif; ?>>
				<?php $_from = $this->_tpl_vars['item']['variants']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
					<option value="<?php echo $this->_tpl_vars['k']; ?>
" <?php if ($this->_tpl_vars['item']['value'] == $this->_tpl_vars['k']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['v']; ?>
</option>
				<?php endforeach; endif; unset($_from); ?>
			</select>
		<?php elseif ($this->_tpl_vars['item']['type'] == 'R'): ?>
			<div class="select-field" id="<?php echo $this->_tpl_vars['html_id']; ?>
">
			<?php $_from = $this->_tpl_vars['item']['variants']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
			<input type="radio" name="<?php echo $this->_tpl_vars['html_name']; ?>
" value="<?php echo $this->_tpl_vars['k']; ?>
" <?php if ($this->_tpl_vars['item']['value'] == $this->_tpl_vars['k']): ?>checked="checked"<?php endif; ?> class="radio" id="variant_<?php echo md5($this->_tpl_vars['item']['description']); ?>
_<?php echo md5($this->_tpl_vars['k']); ?>
" <?php if ($this->_tpl_vars['disable_input']): ?>disabled="disabled"<?php endif; ?> />&nbsp;<label for="variant_<?php echo md5($this->_tpl_vars['item']['description']); ?>
_<?php echo md5($this->_tpl_vars['k']); ?>
"><?php echo $this->_tpl_vars['v']; ?>
</label>
			<?php endforeach; endif; unset($_from); ?>
			</div>
		<?php elseif ($this->_tpl_vars['item']['type'] == 'M'): ?>
			<select id="<?php echo $this->_tpl_vars['html_id']; ?>
" name="<?php echo $this->_tpl_vars['html_name']; ?>
[]" multiple="multiple" <?php if ($this->_tpl_vars['disable_input']): ?>disabled="disabled"<?php endif; ?>>
			<?php $_from = $this->_tpl_vars['item']['variants']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
			<option value="<?php echo $this->_tpl_vars['k']; ?>
" <?php if ($this->_tpl_vars['item']['value'][$this->_tpl_vars['k']] == 'Y'): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['v']; ?>
</option>
			<?php endforeach; endif; unset($_from); ?>
			</select>
			<?php echo fn_get_lang_var('multiple_selectbox_notice', $this->getLanguage()); ?>

		<?php elseif ($this->_tpl_vars['item']['type'] == 'N'): ?>
			<div class="select-field" id="<?php echo $this->_tpl_vars['html_id']; ?>
">
				<input type="hidden" name="<?php echo $this->_tpl_vars['html_name']; ?>
" value="N" <?php if ($this->_tpl_vars['disable_input']): ?>disabled="disabled"<?php endif; ?> />
			<?php $_from = $this->_tpl_vars['item']['variants']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
				<input type="checkbox" name="<?php echo $this->_tpl_vars['html_name']; ?>
[]" id="variant_<?php echo md5($this->_tpl_vars['item']['description']); ?>
_<?php echo md5($this->_tpl_vars['k']); ?>
" value="<?php echo $this->_tpl_vars['k']; ?>
" <?php if ($this->_tpl_vars['item']['value'][$this->_tpl_vars['k']] == 'Y'): ?>checked="checked"<?php endif; ?> <?php if ($this->_tpl_vars['disable_input']): ?>disabled="disabled"<?php endif; ?> />&nbsp;<label for="variant_<?php echo md5($this->_tpl_vars['item']['description']); ?>
_<?php echo md5($this->_tpl_vars['k']); ?>
"><?php echo $this->_tpl_vars['v']; ?>
</label>
			<?php endforeach; endif; unset($_from); ?>
			</div>
		<?php elseif ($this->_tpl_vars['item']['type'] == 'X'): ?>
			<select id="<?php echo $this->_tpl_vars['html_id']; ?>
" name="<?php echo $this->_tpl_vars['html_name']; ?>
" <?php if ($this->_tpl_vars['disable_input']): ?>disabled="disabled"<?php endif; ?>>
				<option value="">- <?php echo fn_get_lang_var('select_country', $this->getLanguage()); ?>
 -</option>
				<?php $this->assign('countries', fn_get_simple_countries(""), false); ?>
				<?php $_from = $this->_tpl_vars['countries']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ccode'] => $this->_tpl_vars['country']):
?>
					<option value="<?php echo $this->_tpl_vars['ccode']; ?>
" <?php if ($this->_tpl_vars['ccode'] == $this->_tpl_vars['item']['value']): ?>selected="selected"<?php endif; ?>><?php echo smarty_modifier_escape($this->_tpl_vars['country']); ?>
</option>
				<?php endforeach; endif; unset($_from); ?>
			</select>
		<?php elseif ($this->_tpl_vars['item']['type'] == 'W'): ?>
			<input type="text" id="<?php echo $this->_tpl_vars['html_id']; ?>
_d" name="<?php echo $this->_tpl_vars['html_name']; ?>
" value="<?php echo $this->_tpl_vars['item']['value']; ?>
" size="32" maxlength="64" disabled="disabled" class="hidden input-text" <?php if ($this->_tpl_vars['disable_input']): ?>disabled="disabled"<?php endif; ?> />
			<select id="<?php echo $this->_tpl_vars['html_id']; ?>
" name="<?php echo $this->_tpl_vars['html_name']; ?>
" <?php if ($this->_tpl_vars['disable_input']): ?>disabled="disabled"<?php endif; ?>>
				<option value="">- <?php echo fn_get_lang_var('select_state', $this->getLanguage()); ?>
 -</option>
			</select>
			<input type="hidden" id="<?php echo $this->_tpl_vars['html_id']; ?>
_default" value="<?php echo $this->_tpl_vars['item']['value']; ?>
" />
		<?php elseif ($this->_tpl_vars['item']['type'] == 'F'): ?>
			<input id="file_<?php echo $this->_tpl_vars['html_id']; ?>
" type="text" name="<?php echo $this->_tpl_vars['html_name']; ?>
" value="<?php echo $this->_tpl_vars['item']['value']; ?>
" size="30" class="valign input-text" <?php if ($this->_tpl_vars['disable_input']): ?>disabled="disabled"<?php endif; ?> />&nbsp;<input id="<?php echo $this->_tpl_vars['html_id']; ?>
" type="button" value="<?php echo fn_get_lang_var('browse', $this->getLanguage()); ?>
" class="valign input-text" onclick="fileuploader.init('box_server_upload', this.id);" <?php if ($this->_tpl_vars['disable_input']): ?>disabled="disabled"<?php endif; ?> />
		<?php elseif ($this->_tpl_vars['item']['type'] == 'G'): ?>
			<div class="table-filters" id="<?php echo $this->_tpl_vars['html_id']; ?>
">
				<div class="scroll-y">
					<?php $_from = $this->_tpl_vars['item']['variants']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
						<div class="select-field"><input type="checkbox" class="checkbox cm-combo-checkbox" id="option_<?php echo $this->_tpl_vars['k']; ?>
" name="<?php echo $this->_tpl_vars['html_name']; ?>
[]" value="<?php echo $this->_tpl_vars['k']; ?>
" <?php if ($this->_tpl_vars['item']['value'][$this->_tpl_vars['k']] == 'Y'): ?>checked="checked"<?php endif; ?> <?php if ($this->_tpl_vars['disable_input']): ?>disabled="disabled"<?php endif; ?> /><label for="option_<?php echo $this->_tpl_vars['k']; ?>
"><?php echo $this->_tpl_vars['v']; ?>
</label></div>
					<?php endforeach; endif; unset($_from); ?>
				</div>
			</div>
		<?php elseif ($this->_tpl_vars['item']['type'] == 'K'): ?>
			<select id="<?php echo $this->_tpl_vars['html_id']; ?>
" name="<?php echo $this->_tpl_vars['html_name']; ?>
" class="cm-combo-select" <?php if ($this->_tpl_vars['disable_input']): ?>disabled="disabled"<?php endif; ?>>
				<?php $_from = $this->_tpl_vars['item']['variants']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
					<option value="<?php echo $this->_tpl_vars['k']; ?>
" <?php if ($this->_tpl_vars['item']['value'] == $this->_tpl_vars['k']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['v']; ?>
</option>
				<?php endforeach; endif; unset($_from); ?>
			</select>
		<?php elseif ($this->_tpl_vars['item']['type'] == 'B'): ?>
			<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('addon' => $this->_tpl_vars['section'], 'name' => $this->_tpl_vars['html_name'], 'id' => $this->_tpl_vars['html_id'], 'fields' => $this->_tpl_vars['item']['variants'], 'selected_fields' => $this->_tpl_vars['item']['value'], )); ?><table cellpadding="0" cellspacing="0" border="0" width="100%">
<tr>
	<td width="50%" valign="top">
		<p align="center"><span><?php echo fn_get_lang_var('selected_fields', $this->getLanguage()); ?>
</span></p>
		<label for="left_<?php echo $this->_tpl_vars['id']; ?>
" class="cm-all hidden"></label>
		<select class="input-text expanded" id="left_<?php echo $this->_tpl_vars['id']; ?>
" name="<?php echo $this->_tpl_vars['name']; ?>
[]" multiple="multiple" size="10" >
		<?php if (is_array($this->_tpl_vars['selected_fields'])): ?>
		<?php $_from = $this->_tpl_vars['selected_fields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['field_id'] => $this->_tpl_vars['active']):
?>
			<option value="<?php echo $this->_tpl_vars['field_id']; ?>
"><?php echo $this->_tpl_vars['fields'][$this->_tpl_vars['field_id']]; ?>
</option>
		<?php endforeach; endif; unset($_from); ?>
		<?php endif; ?>
		</select>
		<p>
		<img src="<?php echo $this->_tpl_vars['images_dir']; ?>
/icons/up_icon.gif" width="11" height="11" onclick="$('#left_<?php echo $this->_tpl_vars['id']; ?>
').swapOptions('up');" class="hand" />&nbsp;&nbsp;&nbsp;
		<img src="<?php echo $this->_tpl_vars['images_dir']; ?>
/icons/down_icon.gif" width="11" height="11" onclick="$('#left_<?php echo $this->_tpl_vars['id']; ?>
').swapOptions('down');" class="hand" />
		</p>

	</td>
	<td class="center valign" width="4%">
		<p><img src="<?php echo $this->_tpl_vars['images_dir']; ?>
/icons/to_left_icon.gif" width="11" height="11" onclick="$('#right_<?php echo $this->_tpl_vars['id']; ?>
').moveOptions('#left_<?php echo $this->_tpl_vars['id']; ?>
');" class="hand" /></p>
		<p><img src="<?php echo $this->_tpl_vars['images_dir']; ?>
/icons/to_right_icon.gif" width="11" height="11" onclick="$('#left_<?php echo $this->_tpl_vars['id']; ?>
').moveOptions('#right_<?php echo $this->_tpl_vars['id']; ?>
', <?php echo $this->_tpl_vars['ldelim']; ?>
check_required: true, message: window.lang.error_exim_layout_missed_fields<?php echo $this->_tpl_vars['rdelim']; ?>
);" class="hand" /></p>
	</td>
	<td width="50%" valign="top">
		<p align="center"><span><?php echo fn_get_lang_var('available_fields', $this->getLanguage()); ?>
</span></p>
		<select class="input-text expanded" name="right_<?php echo $this->_tpl_vars['id']; ?>
" id="right_<?php echo $this->_tpl_vars['id']; ?>
" multiple="multiple" size="10">
		<?php $_from = $this->_tpl_vars['fields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['field_id'] => $this->_tpl_vars['field_name']):
?>
			<?php if (! $this->_tpl_vars['selected_fields'][$this->_tpl_vars['field_id']]): ?>
				<option value="<?php echo $this->_tpl_vars['field_id']; ?>
"><?php echo $this->_tpl_vars['field_name']; ?>
</option>
			<?php endif; ?>
		<?php endforeach; endif; unset($_from); ?>
		</select>
	</td>
</tr>
</table><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
		<?php else: ?>
			<input id="<?php echo $this->_tpl_vars['html_id']; ?>
" type="text" name="<?php echo $this->_tpl_vars['html_name']; ?>
" size="30" value="<?php echo $this->_tpl_vars['item']['value']; ?>
" class="input-text<?php if ($this->_tpl_vars['item']['type'] == 'U'): ?> cm-value-integer<?php endif; ?>" <?php if ($this->_tpl_vars['disable_input']): ?>disabled="disabled"<?php endif; ?> />
		<?php endif; ?>
		<div class="right update-for-all">
			<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('display' => $this->_tpl_vars['item']['update_for_all'], 'object_id' => $this->_tpl_vars['item']['object_id'], 'name' => "update_all_vendors[".($this->_tpl_vars['item']['object_id'])."]", 'hide_element' => $this->_tpl_vars['html_id'], )); ?><?php if ($this->_tpl_vars['display']): ?>
	<?php if ($this->_tpl_vars['hide_element']): ?>
		<?php $this->assign('title_act', fn_get_lang_var('update_for_all_hid_act', $this->getLanguage()), false); ?>
		<?php $this->assign('title_dis', fn_get_lang_var('update_for_all_hid_dis', $this->getLanguage()), false); ?>
	<?php else: ?>
		<?php $this->assign('title_act', fn_get_lang_var('update_for_all_act', $this->getLanguage()), false); ?>
		<?php $this->assign('title_dis', fn_get_lang_var('update_for_all_dis', $this->getLanguage()), false); ?>
	<?php endif; ?>
	<?php if ($this->_tpl_vars['settings']['Stores']['default_state_update_for_all'] == 'active'): ?>
		<?php $this->assign('title', $this->_tpl_vars['title_act'], false); ?>
		<?php $this->assign('visible', 'visible', false); ?>
	<?php else: ?>
		<?php $this->assign('title', $this->_tpl_vars['title_dis'], false); ?>
	<?php endif; ?>
	<a class="cm-update-for-all-icon <?php echo $this->_tpl_vars['visible']; ?>
" title="<?php echo $this->_tpl_vars['title']; ?>
" title_act="<?php echo $this->_tpl_vars['title_act']; ?>
" title_dis="<?php echo $this->_tpl_vars['title_dis']; ?>
" rev="<?php echo $this->_tpl_vars['object_id']; ?>
" <?php if ($this->_tpl_vars['hide_element']): ?>hide_element="<?php echo $this->_tpl_vars['hide_element']; ?>
"<?php endif; ?>></a>
	<input type="hidden" class="cm-no-hide-input" id="hidden_update_all_vendors_<?php echo $this->_tpl_vars['object_id']; ?>
" name="<?php echo $this->_tpl_vars['name']; ?>
" value="Y" <?php if ($this->_tpl_vars['settings']['Stores']['default_state_update_for_all'] == 'not_active'): ?>disabled="disabled"<?php endif; ?> />
<?php else: ?>
&nbsp;
<?php endif; ?> 
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
		</div>
	</div>
<?php endif; ?>