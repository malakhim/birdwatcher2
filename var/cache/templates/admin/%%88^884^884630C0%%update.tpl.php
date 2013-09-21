<?php /* Smarty version 2.6.18, created on 2013-09-21 19:31:58
         compiled from views/static_data/update.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'fn_url', 'views/static_data/update.tpl', 23, false),array('modifier', 'strpos', 'views/static_data/update.tpl', 55, false),array('modifier', 'indent', 'views/static_data/update.tpl', 56, false),array('modifier', 'escape', 'views/static_data/update.tpl', 74, false),array('modifier', 'fn_static_data_megabox', 'views/static_data/update.tpl', 96, false),array('modifier', 'fn_explode_localizations', 'views/static_data/update.tpl', 131, false),array('modifier', 'default', 'views/static_data/update.tpl', 139, false),array('modifier', 'fn_allow_save_object', 'views/static_data/update.tpl', 154, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('general','parent_item','root_level','position_short','none','category','all_categories','page','all_pages','static_data_use_item','localization','multiple_selectbox_notice'));
?>
<?php 

				$rname = !empty($resource_name) ? $resource_name : $params['smarty_include_tpl_file'];
				if ($this->compile_check && empty($inline_no_check[$rname]) && $this->is_cached($rname)) {
					if ($this->check_inline_blocks(array (
  'views/localizations/components/select.tpl' => 1367063755,
))) {
						$_smarty_compile_path = $this->_get_compile_path($rname);
						$this->_compile_resource($rname, $_smarty_compile_path);
						$inline_no_check[$rname] = true;
						include $_smarty_compile_path;
						return;
					}
				}
			 ?><?php if ($this->_tpl_vars['mode'] == 'add'): ?>
	<?php $this->assign('id', '0', false); ?>
<?php else: ?>
	<?php $this->assign('id', $this->_tpl_vars['static_data']['param_id'], false); ?>
<?php endif; ?>

<div id="content_group<?php echo $this->_tpl_vars['id']; ?>
">

<form action="<?php echo fn_url(""); ?>
" method="post" name="static_data_form_<?php echo $this->_tpl_vars['id']; ?>
" enctype="multipart/form-data" class="cm-form-highlight">
<input name="section" type="hidden" value="<?php echo $this->_tpl_vars['section']; ?>
" />
<input name="param_id" type="hidden" value="<?php echo $this->_tpl_vars['id']; ?>
" />

<div class="tabs cm-j-tabs">
	<ul>
		<li id="tab_general_<?php echo $this->_tpl_vars['id']; ?>
" class="cm-js cm-active"><a><?php echo fn_get_lang_var('general', $this->getLanguage()); ?>
</a></li>
	</ul>
</div>

<div class="cm-tabs-content" id="content_tab_general_<?php echo $this->_tpl_vars['id']; ?>
">
<fieldset>

	<?php if ($this->_tpl_vars['section_data']['owner_object']): ?>
		<?php $this->assign('param_name', $this->_tpl_vars['section_data']['owner_object']['param'], false); ?>
		<?php $this->assign('request_key', $this->_tpl_vars['section_data']['owner_object']['key'], false); ?>	
		<?php $this->assign('value', $this->_tpl_vars['_REQUEST'][$this->_tpl_vars['request_key']], false); ?>

				
		<input type="hidden" name="static_data[<?php echo $this->_tpl_vars['param_name']; ?>
]" value="<?php echo $this->_tpl_vars['value']; ?>
" class="input-text-large" />
		<input type="hidden" name="<?php echo $this->_tpl_vars['request_key']; ?>
" value="<?php echo $this->_tpl_vars['value']; ?>
" class="input-text-large" />
	<?php endif; ?>

	<?php if ($this->_tpl_vars['section_data']['multi_level']): ?>
	<div class="form-field">
		<label for="parent_<?php echo $this->_tpl_vars['id']; ?>
" class="cm-required"><?php echo fn_get_lang_var('parent_item', $this->getLanguage()); ?>
:</label>
		<select id="parent_<?php echo $this->_tpl_vars['id']; ?>
" name="static_data[parent_id]">
		<option	value="0">- <?php echo fn_get_lang_var('root_level', $this->getLanguage()); ?>
 -</option>
		<?php $_from = $this->_tpl_vars['parent_items']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['i']):
?>
			<?php if (( strpos($this->_tpl_vars['i']['id_path'], ($this->_tpl_vars['static_data']['id_path'])."/") === false || $this->_tpl_vars['static_data']['id_path'] == "" ) && $this->_tpl_vars['i']['param_id'] != $this->_tpl_vars['static_data']['param_id'] || $this->_tpl_vars['mode'] == 'add'): ?>
				<option	value="<?php echo $this->_tpl_vars['i']['param_id']; ?>
" <?php if ($this->_tpl_vars['static_data']['parent_id'] == $this->_tpl_vars['i']['param_id']): ?>selected="selected"<?php endif; ?>><?php echo smarty_modifier_indent($this->_tpl_vars['i']['descr'], $this->_tpl_vars['i']['level'], "&#166;&nbsp;&nbsp;&nbsp;&nbsp;", "&#166;--&nbsp;"); ?>
</option>
			<?php endif; ?>
		<?php endforeach; endif; unset($_from); ?>
		</select>
	</div>
	<?php endif; ?>

	<div class="form-field">
		<label for="descr_<?php echo $this->_tpl_vars['id']; ?>
" class="cm-required"><?php echo fn_get_lang_var($this->_tpl_vars['section_data']['descr'], $this->getLanguage()); ?>
:</label>
		<input type="text" size="40" id="descr_<?php echo $this->_tpl_vars['id']; ?>
" name="static_data[descr]" value="<?php echo $this->_tpl_vars['static_data']['descr']; ?>
" class="input-text-large main-input" />
	</div>
	<?php if ($this->_tpl_vars['section_data']['multi_level']): ?>
	<div class="form-field">
		<label for="position_<?php echo $this->_tpl_vars['id']; ?>
"><?php echo fn_get_lang_var('position_short', $this->getLanguage()); ?>
:</label>
		<input type="text" size="2" id="position_<?php echo $this->_tpl_vars['id']; ?>
" name="static_data[position]" value="<?php echo $this->_tpl_vars['static_data']['position']; ?>
" class="input-text-short" />
	</div>
	<?php endif; ?>
	<div class="form-field">
		<label for="param_<?php echo $this->_tpl_vars['id']; ?>
"><?php echo fn_get_lang_var($this->_tpl_vars['section_data']['param'], $this->getLanguage()); ?>
<?php if ($this->_tpl_vars['section_data']['tooltip']): ?><?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('tooltip' => fn_get_lang_var($this->_tpl_vars['section_data']['tooltip'], $this->getLanguage()), )); ?><?php if ($this->_tpl_vars['tooltip']): ?> (<a class="cm-tooltip<?php if ($this->_tpl_vars['params']): ?> <?php echo $this->_tpl_vars['params']; ?>
<?php endif; ?>" title="<?php echo smarty_modifier_escape($this->_tpl_vars['tooltip'], 'html'); ?>
">?</a>)<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php endif; ?>:</label>
		<input type="text" size="40" id="param_<?php echo $this->_tpl_vars['id']; ?>
" name="static_data[param]" value="<?php echo $this->_tpl_vars['static_data']['param']; ?>
" class="input-text-large" />
	</div>

	<?php if ($this->_tpl_vars['section_data']['icon']): ?>
	<div class="form-field">
		<label><?php echo fn_get_lang_var($this->_tpl_vars['section_data']['icon']['title'], $this->getLanguage()); ?>
:</label>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/attach_images.tpl", 'smarty_include_vars' => array('image_name' => 'static_data_icon','image_object_type' => "static_data_".($this->_tpl_vars['section']),'image_pair' => $this->_tpl_vars['static_data']['icon'],'no_detailed' => 'Y','hide_titles' => 'Y','image_key' => $this->_tpl_vars['id'],'image_object_id' => $this->_tpl_vars['id'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</div>
	<?php endif; ?>

	<?php if ($this->_tpl_vars['section_data']['additional_params']): ?>
	<?php $_from = $this->_tpl_vars['section_data']['additional_params']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['p']):
?>
		<?php if ($this->_tpl_vars['p']['type'] == 'hidden'): ?>	
			<input type="hidden" id="param_<?php echo $this->_tpl_vars['k']; ?>
_<?php echo $this->_tpl_vars['id']; ?>
" name="static_data[<?php echo $this->_tpl_vars['p']['name']; ?>
]" value="<?php echo $this->_tpl_vars['static_data'][$this->_tpl_vars['p']['name']]; ?>
" class="input-text-large" />
		<?php else: ?>
			<div class="form-field">
				<label for="param_<?php echo $this->_tpl_vars['k']; ?>
_<?php echo $this->_tpl_vars['id']; ?>
"><?php echo fn_get_lang_var($this->_tpl_vars['p']['title'], $this->getLanguage()); ?>
<?php if ($this->_tpl_vars['p']['tooltip']): ?><?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('tooltip' => fn_get_lang_var($this->_tpl_vars['p']['tooltip'], $this->getLanguage()), )); ?><?php if ($this->_tpl_vars['tooltip']): ?> (<a class="cm-tooltip<?php if ($this->_tpl_vars['params']): ?> <?php echo $this->_tpl_vars['params']; ?>
<?php endif; ?>" title="<?php echo smarty_modifier_escape($this->_tpl_vars['tooltip'], 'html'); ?>
">?</a>)<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php endif; ?>:</label>
				<?php if ($this->_tpl_vars['p']['type'] == 'checkbox'): ?>
					<input type="hidden" name="static_data[<?php echo $this->_tpl_vars['p']['name']; ?>
]" value="N" />
					<input type="checkbox" id="param_<?php echo $this->_tpl_vars['k']; ?>
_<?php echo $this->_tpl_vars['id']; ?>
" name="static_data[<?php echo $this->_tpl_vars['p']['name']; ?>
]" value="Y" <?php if ($this->_tpl_vars['static_data'][$this->_tpl_vars['p']['name']] == 'Y'): ?>checked="checked"<?php endif; ?> class="checkbox" />
				<?php elseif ($this->_tpl_vars['p']['type'] == 'megabox'): ?>
					<?php $this->assign('_megabox_values', fn_static_data_megabox($this->_tpl_vars['static_data'][$this->_tpl_vars['p']['name']]), false); ?>

					<div class="clear select-field">
						<input type="radio" name="static_data[megabox][type][<?php echo $this->_tpl_vars['p']['name']; ?>
]" id="rb_<?php echo $this->_tpl_vars['id']; ?>
" <?php if (! $this->_tpl_vars['_megabox_values']): ?>checked="checked"<?php endif; ?> value="" onclick="$('#un_<?php echo $this->_tpl_vars['id']; ?>
').attr('disabled', true);" /><label for="rb_<?php echo $this->_tpl_vars['id']; ?>
"><?php echo fn_get_lang_var('none', $this->getLanguage()); ?>
</label>
					</div>
					
					<div class="clear select-field">
						<div class="float-left"><input type="radio" name="static_data[megabox][type][<?php echo $this->_tpl_vars['p']['name']; ?>
]" id="rb_c_<?php echo $this->_tpl_vars['id']; ?>
" <?php if ($this->_tpl_vars['_megabox_values']['types']['C']): ?>checked="checked"<?php endif; ?> value="C" onclick="$('#un_<?php echo $this->_tpl_vars['id']; ?>
').attr('disabled', false);" /><label for="rb_c_<?php echo $this->_tpl_vars['id']; ?>
"><?php echo fn_get_lang_var('category', $this->getLanguage()); ?>
:</label></div><div id="megabox_container_c_<?php echo $this->_tpl_vars['id']; ?>
" class="float-left"><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "pickers/categories_picker.tpl", 'smarty_include_vars' => array('data_id' => "megabox_category_".($this->_tpl_vars['id']),'input_name' => "static_data[".($this->_tpl_vars['p']['name'])."][C]",'item_ids' => $this->_tpl_vars['_megabox_values']['types']['C']['value'],'hide_link' => true,'hide_delete_button' => true,'show_root' => true,'default_name' => fn_get_lang_var('all_categories', $this->getLanguage()),'extra' => "")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></div>
					</div>

					<div class="clear select-field">
						<div class="float-left"><input type="radio" name="static_data[megabox][type][<?php echo $this->_tpl_vars['p']['name']; ?>
]" id="rb_a_<?php echo $this->_tpl_vars['id']; ?>
" <?php if ($this->_tpl_vars['_megabox_values']['types']['A']): ?>checked="checked"<?php endif; ?> value="A" onclick="$('#un_<?php echo $this->_tpl_vars['id']; ?>
').attr('disabled', false);" /><label for="rb_a_<?php echo $this->_tpl_vars['id']; ?>
"><?php echo fn_get_lang_var('page', $this->getLanguage()); ?>
:</label></div><div id="megabox_container_a_<?php echo $this->_tpl_vars['id']; ?>
" class="float-left"><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "pickers/pages_picker.tpl", 'smarty_include_vars' => array('data_id' => "megabox_page_".($this->_tpl_vars['id']),'input_name' => "static_data[".($this->_tpl_vars['p']['name'])."][A]",'item_ids' => $this->_tpl_vars['_megabox_values']['types']['A']['value'],'hide_link' => true,'hide_delete_button' => true,'show_root' => true,'default_name' => fn_get_lang_var('all_pages', $this->getLanguage()),'extra' => "")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></div>
					</div>

					<div class="clear select-field">
						<input type="hidden" name="static_data[megabox][use_item][<?php echo $this->_tpl_vars['p']['name']; ?>
]" value="N" />
						<input type="checkbox" name="static_data[megabox][use_item][<?php echo $this->_tpl_vars['p']['name']; ?>
]" id="un_<?php echo $this->_tpl_vars['id']; ?>
" <?php if ($this->_tpl_vars['_megabox_values']['use_item'] == 'Y'): ?>checked="checked"<?php endif; ?> value="Y" /><label for="un_<?php echo $this->_tpl_vars['id']; ?>
"><?php echo fn_get_lang_var('static_data_use_item', $this->getLanguage()); ?>
</label>
					</div>

				<?php elseif ($this->_tpl_vars['p']['type'] == 'select'): ?>
					<select id="param_<?php echo $this->_tpl_vars['k']; ?>
_<?php echo $this->_tpl_vars['id']; ?>
" name="static_data[<?php echo $this->_tpl_vars['p']['name']; ?>
]">
					<?php $_from = $this->_tpl_vars['p']['values']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['vk'] => $this->_tpl_vars['vv']):
?>
					<option	value="<?php echo $this->_tpl_vars['vk']; ?>
" <?php if ($this->_tpl_vars['static_data'][$this->_tpl_vars['p']['name']] == $this->_tpl_vars['vk']): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var($this->_tpl_vars['vv'], $this->getLanguage()); ?>
</option>
					<?php endforeach; endif; unset($_from); ?>
					</select>
				<?php elseif ($this->_tpl_vars['p']['type'] == 'input'): ?>
					<input type="text" id="param_<?php echo $this->_tpl_vars['k']; ?>
_<?php echo $this->_tpl_vars['id']; ?>
" name="static_data[<?php echo $this->_tpl_vars['p']['name']; ?>
]" value="<?php echo $this->_tpl_vars['static_data'][$this->_tpl_vars['p']['name']]; ?>
" class="input-text-large" />
				<?php endif; ?>
			</div>		
		<?php endif; ?>
	<?php endforeach; endif; unset($_from); ?>
	<?php endif; ?>

	<?php if ($this->_tpl_vars['section_data']['has_localization']): ?>
		<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('data_name' => "static_data[localization]", 'data_from' => $this->_tpl_vars['static_data']['localization'], )); ?>
<?php $this->assign('data', fn_explode_localizations($this->_tpl_vars['data_from']), false); ?>

<?php if ($this->_tpl_vars['localizations']): ?>
<?php if (! $this->_tpl_vars['no_div']): ?>
<div class="form-field">
	<label for="<?php echo $this->_tpl_vars['id']; ?>
"><?php echo fn_get_lang_var('localization', $this->getLanguage()); ?>
:</label>
<?php endif; ?>
		<?php if (! $this->_tpl_vars['disabled']): ?><input type="hidden" name="<?php echo $this->_tpl_vars['data_name']; ?>
" value="" /><?php endif; ?>
		<select	name="<?php echo $this->_tpl_vars['data_name']; ?>
[]" multiple="multiple" size="3" id="<?php echo smarty_modifier_default(@$this->_tpl_vars['id'], @$this->_tpl_vars['data_name']); ?>
" class="<?php if ($this->_tpl_vars['disabled']): ?>elm-disabled<?php else: ?>input-text<?php endif; ?>" <?php if ($this->_tpl_vars['disabled']): ?>disabled="disabled"<?php endif; ?>>
			<?php $_from = $this->_tpl_vars['localizations']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['loc']):
?>
			<option	value="<?php echo $this->_tpl_vars['loc']['localization_id']; ?>
" <?php $_from = $this->_tpl_vars['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['p_loc']):
?><?php if ($this->_tpl_vars['p_loc'] == $this->_tpl_vars['loc']['localization_id']): ?>selected="selected"<?php endif; ?><?php endforeach; endif; unset($_from); ?>><?php echo smarty_modifier_escape($this->_tpl_vars['loc']['localization']); ?>
</option>
			<?php endforeach; endif; unset($_from); ?>
		</select>
<?php if (! $this->_tpl_vars['no_div']): ?>
<?php echo fn_get_lang_var('multiple_selectbox_notice', $this->getLanguage()); ?>

</div>
<?php endif; ?>
<?php endif; ?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
	<?php endif; ?>
</fieldset>
<!--content_tab_general_<?php echo $this->_tpl_vars['id']; ?>
--></div>

<?php if (fn_allow_save_object("", 'static_data', $this->_tpl_vars['section_data']['skip_edition_checking'])): ?>
	<div class="buttons-container">
		<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/save_cancel.tpl", 'smarty_include_vars' => array('but_name' => "dispatch[static_data.update]",'cancel_action' => 'close')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</div>
<?php endif; ?>

</form>
<!--content_group<?php echo $this->_tpl_vars['id']; ?>
--></div>