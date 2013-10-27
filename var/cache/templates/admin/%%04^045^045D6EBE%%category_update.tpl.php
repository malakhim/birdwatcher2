<?php /* Smarty version 2.6.18, created on 2013-10-26 16:11:43
         compiled from addons/billibuys/views/billibuys/category_update.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'addons/billibuys/views/billibuys/category_update.tpl', 1, false),array('modifier', 'fn_get_usergroups', 'addons/billibuys/views/billibuys/category_update.tpl', 1, false),array('modifier', 'fn_url', 'addons/billibuys/views/billibuys/category_update.tpl', 17, false),array('modifier', 'fn_check_form_permissions', 'addons/billibuys/views/billibuys/category_update.tpl', 17, false),array('modifier', 'fn_show_picker', 'addons/billibuys/views/billibuys/category_update.tpl', 33, false),array('modifier', 'fn_bb_get_categories', 'addons/billibuys/views/billibuys/category_update.tpl', 40, false),array('modifier', 'strpos', 'addons/billibuys/views/billibuys/category_update.tpl', 41, false),array('modifier', 'indent', 'addons/billibuys/views/billibuys/category_update.tpl', 42, false),array('modifier', 'is_array', 'addons/billibuys/views/billibuys/category_update.tpl', 81, false),array('modifier', 'fn_from_json', 'addons/billibuys/views/billibuys/category_update.tpl', 82, false),array('modifier', 'lower', 'addons/billibuys/views/billibuys/category_update.tpl', 85, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('general','name','location','root_level','location','root_level','description','active','hidden','disabled','status','active','hidden','disabled','status','active','hidden','pending','disabled','images','text_category_icon','text_category_detailed_image','update_categories'));
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
			 ?><?php ob_start(); ?>

<form action="<?php echo fn_url(""); ?>
" method="post" name="category_update_form" class="cm-form-highlight<?php if (fn_check_form_permissions("")): ?> cm-hide-inputs<?php endif; ?>" enctype="multipart/form-data">
<input type="hidden" name="fake" value="1" />
<input type="hidden" name="category_id" value="<?php echo $this->_tpl_vars['id']; ?>
" />
<input type="hidden" name="selected_section" value="<?php echo $this->_tpl_vars['_REQUEST']['selected_section']; ?>
" />

<div id="content_detailed">
	<fieldset>

	<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/subheader.tpl", 'smarty_include_vars' => array('title' => fn_get_lang_var('general', $this->getLanguage()))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

	<div class="form-field">
		<label for="category" class="cm-required"><?php echo fn_get_lang_var('name', $this->getLanguage()); ?>
:</label>
		<input type="text" name="category_data[category_name]" id="category" size="55" value="<?php echo $this->_tpl_vars['category_data']['category_name']; ?>
" class="input-text-large main-input" />
	</div>

	<div class="form-field">
		<?php if (fn_show_picker('categories', @CATEGORY_THRESHOLD)): ?>
			<label class="cm-required" for="location_category_id"><?php echo fn_get_lang_var('location', $this->getLanguage()); ?>
:</label>
			<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "pickers/categories_picker.tpl", 'smarty_include_vars' => array('data_id' => 'location_category','input_name' => "category_data[parent_category_id]",'item_ids' => smarty_modifier_default(@$this->_tpl_vars['category_data']['parent_category_id'], '0'),'hide_link' => true,'hide_delete_button' => true,'show_root' => true,'default_name' => fn_get_lang_var('root_level', $this->getLanguage()),'display_input_id' => 'location_category_id','except_id' => $this->_tpl_vars['id'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<?php else: ?>
			<label for="category_data_parent_id"><?php echo fn_get_lang_var('location', $this->getLanguage()); ?>
:</label>
			<select	name="category_data[parent_category_id]" id="category_data_parent_id">
				<option	value="0" <?php if ($this->_tpl_vars['category_data']['parent_category_id'] == '0'): ?>selected="selected"<?php endif; ?>>- <?php echo fn_get_lang_var('root_level', $this->getLanguage()); ?>
 -</option>
				<?php $_from = fn_bb_get_categories(0); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['categories'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['categories']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['cat']):
        $this->_foreach['categories']['iteration']++;
?>
					<?php if (strpos($this->_tpl_vars['cat']['id_path'], ($this->_tpl_vars['category_data']['id_path'])."/") === false && $this->_tpl_vars['cat']['bb_request_category_id'] != $this->_tpl_vars['id'] || ! $this->_tpl_vars['id']): ?>
						<option	value="<?php echo $this->_tpl_vars['cat']['bb_request_category_id']; ?>
" <?php if ($this->_tpl_vars['cat']['disabled']): ?>disabled="disabled"<?php endif; ?> <?php if ($this->_tpl_vars['category_data']['parent_category_id'] == $this->_tpl_vars['cat']['bb_request_category_id']): ?>selected="selected"<?php endif; ?>><?php echo smarty_modifier_indent($this->_tpl_vars['cat']['category_name'], $this->_tpl_vars['cat']['level'], "&#166;&nbsp;&nbsp;&nbsp;&nbsp;", "&#166;--&nbsp;"); ?>
</option>
					<?php endif; ?>
				<?php endforeach; endif; unset($_from); ?>
			</select>
		<?php endif; ?>
	</div>

	<div class="form-field">
		<label for="cat_descr"><?php echo fn_get_lang_var('description', $this->getLanguage()); ?>
:</label>
		<textarea id="cat_descr" name="category_data[description]" cols="55" rows="8" class="cm-wysiwyg input-textarea-long"><?php echo $this->_tpl_vars['category_data']['description']; ?>
</textarea>
		
	</div>

	<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('input_name' => "category_data[status]", 'id' => 'category_data', 'obj' => $this->_tpl_vars['category_data'], 'hidden' => true, )); ?><?php if ($this->_tpl_vars['display'] == 'select'): ?>
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
<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>



	<div class="form-field">
		<label><?php echo fn_get_lang_var('images', $this->getLanguage()); ?>
:</label>
		<div class="float-left">
			<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/attach_images.tpl", 'smarty_include_vars' => array('image_name' => 'category_main','image_object_type' => 'category','image_pair' => $this->_tpl_vars['category_data']['main_pair'],'image_object_id' => $this->_tpl_vars['id'],'icon_text' => fn_get_lang_var('text_category_icon', $this->getLanguage()),'detailed_text' => fn_get_lang_var('text_category_detailed_image', $this->getLanguage()),'no_thumbnail' => true)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</div>
	</div>

	</fieldset>
	<div class="buttons-container cm-toggle-button buttons-bg">
	<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/save_cancel.tpl", 'smarty_include_vars' => array('but_name' => "dispatch[billibuys.category_add]",'hide_second_button' => true)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>

</form>
<?php $this->_smarty_vars['capture']['mainbox'] = ob_get_contents(); ob_end_clean(); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/mainbox.tpl", 'smarty_include_vars' => array('title' => fn_get_lang_var('update_categories', $this->getLanguage()),'content' => $this->_smarty_vars['capture']['mainbox'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>