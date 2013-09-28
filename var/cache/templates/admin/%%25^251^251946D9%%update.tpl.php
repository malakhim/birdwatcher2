<?php /* Smarty version 2.6.18, created on 2013-09-28 16:51:51
         compiled from views/categories/update.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'views/categories/update.tpl', 1, false),array('modifier', 'fn_get_usergroups', 'views/categories/update.tpl', 1, false),array('modifier', 'fn_url', 'views/categories/update.tpl', 25, false),array('modifier', 'fn_check_form_permissions', 'views/categories/update.tpl', 25, false),array('modifier', 'fn_show_picker', 'views/categories/update.tpl', 41, false),array('modifier', 'fn_get_plain_categories_tree', 'views/categories/update.tpl', 48, false),array('modifier', 'strpos', 'views/categories/update.tpl', 50, false),array('modifier', 'indent', 'views/categories/update.tpl', 51, false),array('modifier', 'is_array', 'views/categories/update.tpl', 92, false),array('modifier', 'fn_from_json', 'views/categories/update.tpl', 93, false),array('modifier', 'lower', 'views/categories/update.tpl', 96, false),array('modifier', 'escape', 'views/categories/update.tpl', 129, false),array('modifier', 'explode', 'views/categories/update.tpl', 149, false),array('modifier', 'fn_get_default_usergroups', 'views/categories/update.tpl', 154, false),array('modifier', 'in_array', 'views/categories/update.tpl', 156, false),array('modifier', 'count', 'views/categories/update.tpl', 156, false),array('modifier', 'defined', 'views/categories/update.tpl', 169, false),array('modifier', 'define', 'views/categories/update.tpl', 170, false),array('modifier', 'fn_parse_date', 'views/categories/update.tpl', 210, false),array('modifier', 'date_format', 'views/categories/update.tpl', 210, false),array('modifier', 'fn_explode_localizations', 'views/categories/update.tpl', 246, false),array('modifier', 'fn_get_product_details_views', 'views/categories/update.tpl', 275, false),array('modifier', 'fn_get_products_views', 'views/categories/update.tpl', 292, false),array('modifier', 'empty_tabs', 'views/categories/update.tpl', 344, false),array('block', 'hook', 'views/categories/update.tpl', 152, false),array('function', 'math', 'views/categories/update.tpl', 226, false),array('function', 'script', 'views/categories/update.tpl', 338, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('information','name','location','root_level','location','root_level','description','active','hidden','disabled','status','active','hidden','disabled','status','active','hidden','pending','disabled','images','text_category_icon','text_category_detailed_image','seo_meta_data','page_title','ttc_page_title','meta_description','meta_keywords','availability','usergroups','ttc_usergroups','to_all_subcats','position','creation_date','calendar','calendar','weekday_abr_0','weekday_abr_1','weekday_abr_2','weekday_abr_3','weekday_abr_4','weekday_abr_5','weekday_abr_6','month_name_abr_1','month_name_abr_2','month_name_abr_3','month_name_abr_4','month_name_abr_5','month_name_abr_6','month_name_abr_7','month_name_abr_8','month_name_abr_9','month_name_abr_10','month_name_abr_11','month_name_abr_12','localization','multiple_selectbox_notice','product_details_layout','tt_views_categories_update_product_details_layout','use_custom_layout','product_columns','available_layouts','default_category_layout','new_category','preview','preview_as_admin','editing_category'));
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
			 ?><?php if ($this->_tpl_vars['category_data']['category_id']): ?>
	<?php $this->assign('id', $this->_tpl_vars['category_data']['category_id'], false); ?>
<?php else: ?>
	<?php $this->assign('id', 0, false); ?>
<?php endif; ?>

<?php ob_start(); ?>

<?php ob_start(); ?>

<form action="<?php echo fn_url(""); ?>
" method="post" name="category_update_form" class="cm-form-highlight<?php if (fn_check_form_permissions("")): ?> cm-hide-inputs<?php endif; ?>" enctype="multipart/form-data">
<input type="hidden" name="fake" value="1" />
<input type="hidden" name="category_id" value="<?php echo $this->_tpl_vars['id']; ?>
" />
<input type="hidden" name="selected_section" value="<?php echo $this->_tpl_vars['_REQUEST']['selected_section']; ?>
" />

<div id="content_detailed">
	<fieldset>

	<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/subheader.tpl", 'smarty_include_vars' => array('title' => fn_get_lang_var('information', $this->getLanguage()))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

	<div class="form-field">
		<label for="category" class="cm-required"><?php echo fn_get_lang_var('name', $this->getLanguage()); ?>
:</label>
		<input type="text" name="category_data[category]" id="category" size="55" value="<?php echo $this->_tpl_vars['category_data']['category']; ?>
" class="input-text-large main-input" />
	</div>

	<div class="form-field">
		<?php if (fn_show_picker('categories', @CATEGORY_THRESHOLD)): ?>
			<label class="cm-required" for="location_category_id"><?php echo fn_get_lang_var('location', $this->getLanguage()); ?>
:</label>
			<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "pickers/categories_picker.tpl", 'smarty_include_vars' => array('data_id' => 'location_category','input_name' => "category_data[parent_id]",'item_ids' => smarty_modifier_default(@$this->_tpl_vars['category_data']['parent_id'], '0'),'hide_link' => true,'hide_delete_button' => true,'show_root' => true,'default_name' => fn_get_lang_var('root_level', $this->getLanguage()),'display_input_id' => 'location_category_id','except_id' => $this->_tpl_vars['id'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<?php else: ?>
			<label for="category_data_parent_id"><?php echo fn_get_lang_var('location', $this->getLanguage()); ?>
:</label>
			<select	name="category_data[parent_id]" id="category_data_parent_id">
				<option	value="0" <?php if ($this->_tpl_vars['category_data']['parent_id'] == '0'): ?>selected="selected"<?php endif; ?>>- <?php echo fn_get_lang_var('root_level', $this->getLanguage()); ?>
 -</option>
				<?php $_from = fn_get_plain_categories_tree(0, false); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['categories'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['categories']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['cat']):
        $this->_foreach['categories']['iteration']++;
?>
				
					<?php if (strpos($this->_tpl_vars['cat']['id_path'], ($this->_tpl_vars['category_data']['id_path'])."/") === false && $this->_tpl_vars['cat']['category_id'] != $this->_tpl_vars['id'] || ! $this->_tpl_vars['id']): ?>
						<option	value="<?php echo $this->_tpl_vars['cat']['category_id']; ?>
" <?php if ($this->_tpl_vars['cat']['disabled']): ?>disabled="disabled"<?php endif; ?> <?php if ($this->_tpl_vars['category_data']['parent_id'] == $this->_tpl_vars['cat']['category_id']): ?>selected="selected"<?php endif; ?>><?php echo smarty_modifier_indent($this->_tpl_vars['cat']['category'], $this->_tpl_vars['cat']['level'], "&#166;&nbsp;&nbsp;&nbsp;&nbsp;", "&#166;--&nbsp;"); ?>
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

	<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/subheader.tpl", 'smarty_include_vars' => array('title' => fn_get_lang_var('seo_meta_data', $this->getLanguage()))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

	<div class="form-field">
		<label for="page_title"><?php echo fn_get_lang_var('page_title', $this->getLanguage()); ?>
<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('tooltip' => fn_get_lang_var('ttc_page_title', $this->getLanguage()), )); ?><?php if ($this->_tpl_vars['tooltip']): ?> (<a class="cm-tooltip<?php if ($this->_tpl_vars['params']): ?> <?php echo $this->_tpl_vars['params']; ?>
<?php endif; ?>" title="<?php echo smarty_modifier_escape($this->_tpl_vars['tooltip'], 'html'); ?>
">?</a>)<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>:</label>
		<input type="text" name="category_data[page_title]" id="page_title" size="55" value="<?php echo $this->_tpl_vars['category_data']['page_title']; ?>
" class="input-text-large" />
	</div>

	<div class="form-field">
		<label for="meta_description"><?php echo fn_get_lang_var('meta_description', $this->getLanguage()); ?>
:</label>
		<textarea name="category_data[meta_description]" id="meta_description" cols="55" rows="4" class="input-textarea-long"><?php echo $this->_tpl_vars['category_data']['meta_description']; ?>
</textarea>
	</div>

	<div class="form-field">
		<label for="meta_keywords"><?php echo fn_get_lang_var('meta_keywords', $this->getLanguage()); ?>
:</label>
		<textarea name="category_data[meta_keywords]" id="meta_keywords" cols="55" rows="4" class="input-textarea-long"><?php echo $this->_tpl_vars['category_data']['meta_keywords']; ?>
</textarea>
	</div>
	
	<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/subheader.tpl", 'smarty_include_vars' => array('title' => fn_get_lang_var('availability', $this->getLanguage()))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<div class="form-field">
		<label><?php echo fn_get_lang_var('usergroups', $this->getLanguage()); ?>
<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('tooltip' => fn_get_lang_var('ttc_usergroups', $this->getLanguage()), )); ?><?php if ($this->_tpl_vars['tooltip']): ?> (<a class="cm-tooltip<?php if ($this->_tpl_vars['params']): ?> <?php echo $this->_tpl_vars['params']; ?>
<?php endif; ?>" title="<?php echo smarty_modifier_escape($this->_tpl_vars['tooltip'], 'html'); ?>
">?</a>)<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>:</label>
			<div class="select-field">
				<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('id' => 'ug_id', 'name' => "category_data[usergroup_ids]", 'usergroups' => fn_get_usergroups('C', @DESCR_SL), 'usergroup_ids' => $this->_tpl_vars['category_data']['usergroup_ids'], 'input_extra' => "", 'list_mode' => false, )); ?>
<?php if ($this->_tpl_vars['usergroup_ids'] !== ""): ?>
<?php $this->assign('ug_ids', explode(",", $this->_tpl_vars['usergroup_ids']), false); ?>
<?php endif; ?>

<?php $this->_tag_stack[] = array('hook', array('name' => "usergroups:select_usergroups")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
<input type="hidden" name="<?php echo $this->_tpl_vars['name']; ?>
" value="0" <?php echo $this->_tpl_vars['input_extra']; ?>
/>
<?php $_from = fn_get_default_usergroups(""); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['usergroup']):
?>
	<?php if ($this->_tpl_vars['list_mode']): ?><p><?php endif; ?>
	<input type="checkbox" name="<?php echo $this->_tpl_vars['name']; ?>
[]" id="<?php echo $this->_tpl_vars['id']; ?>
_<?php echo $this->_tpl_vars['usergroup']['usergroup_id']; ?>
"<?php if (( $this->_tpl_vars['ug_ids'] && smarty_modifier_in_array($this->_tpl_vars['usergroup']['usergroup_id'], $this->_tpl_vars['ug_ids']) ) || ( ! $this->_tpl_vars['ug_ids'] && $this->_tpl_vars['usergroup']['usergroup_id'] == @USERGROUP_ALL )): ?> checked="checked"<?php endif; ?> class="checkbox" value="<?php echo $this->_tpl_vars['usergroup']['usergroup_id']; ?>
" <?php echo $this->_tpl_vars['input_extra']; ?>
<?php if (( ! $this->_tpl_vars['ug_ids'] || ( $this->_tpl_vars['ug_ids'] && count($this->_tpl_vars['ug_ids']) == 1 && smarty_modifier_in_array($this->_tpl_vars['usergroup']['usergroup_id'], $this->_tpl_vars['ug_ids']) ) ) && $this->_tpl_vars['usergroup']['usergroup_id'] == @USERGROUP_ALL): ?> disabled="disabled"<?php endif; ?> onclick="fn_switch_default_box(this, '<?php echo $this->_tpl_vars['id']; ?>
', <?php echo @USERGROUP_ALL; ?>
);" />
	<label for="<?php echo $this->_tpl_vars['id']; ?>
_<?php echo $this->_tpl_vars['usergroup']['usergroup_id']; ?>
"><?php echo smarty_modifier_escape($this->_tpl_vars['usergroup']['usergroup']); ?>
</label>
	<?php if ($this->_tpl_vars['list_mode']): ?></p><?php endif; ?>
<?php endforeach; endif; unset($_from); ?>

<?php $_from = $this->_tpl_vars['usergroups']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['usergroup']):
?>
	<?php if ($this->_tpl_vars['list_mode']): ?><p><?php endif; ?>
	<input type="checkbox" name="<?php echo $this->_tpl_vars['name']; ?>
[]" id="<?php echo $this->_tpl_vars['id']; ?>
_<?php echo $this->_tpl_vars['usergroup']['usergroup_id']; ?>
"<?php if ($this->_tpl_vars['ug_ids'] && smarty_modifier_in_array($this->_tpl_vars['usergroup']['usergroup_id'], $this->_tpl_vars['ug_ids'])): ?> checked="checked"<?php endif; ?> class="checkbox" value="<?php echo $this->_tpl_vars['usergroup']['usergroup_id']; ?>
" <?php echo $this->_tpl_vars['input_extra']; ?>
 onclick="fn_switch_default_box(this, '<?php echo $this->_tpl_vars['id']; ?>
', <?php echo @USERGROUP_ALL; ?>
);" />
	<label for="<?php echo $this->_tpl_vars['id']; ?>
_<?php echo $this->_tpl_vars['usergroup']['usergroup_id']; ?>
"><?php echo smarty_modifier_escape($this->_tpl_vars['usergroup']['usergroup']); ?>
</label>
	<?php if ($this->_tpl_vars['list_mode']): ?></p><?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

<?php if (! defined('SMARTY_USERGROUPS_LOADED')): ?>
<?php $this->assign('tmp', define('SMARTY_USERGROUPS_LOADED', true), false); ?>
<script type="text/javascript">
	//<![CDATA[
	<?php echo '
	function fn_switch_default_box(holder, prefix, default_id)
	{
		var p = $(holder).parents(\':not(p):first\');
		var default_box = $(\'input[id^=\' + prefix + \'_\' + default_id + \']\', p);
		var checked_items = $(\'input[id^=\' + prefix + \'_].checkbox:checked\', p).not(default_box).length + holder.checked ? 1 : 0;
		if (checked_items == 0) {
			default_box.attr(\'disabled\', \'disabled\');
			default_box.attr(\'checked\', \'checked\');
		} else {
			default_box.removeAttr(\'disabled\');
		}
	}
	'; ?>

	//]]>
</script>
<?php endif; ?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
				<p><label for="usergroup_to_subcats"><?php echo fn_get_lang_var('to_all_subcats', $this->getLanguage()); ?>
</label>
				<input id="usergroup_to_subcats" type="checkbox" name="category_data[usergroup_to_subcats]" value="Y" /></p>
			</div>
	</div>
	

	<div class="form-field">
		<label for="category_position"><?php echo fn_get_lang_var('position', $this->getLanguage()); ?>
:</label>
		<input type="text" name="category_data[position]" id="category_position" size="10" value="<?php echo $this->_tpl_vars['category_data']['position']; ?>
" class="input-text-short" />
	</div>

	<div class="form-field">
		<label><?php echo fn_get_lang_var('creation_date', $this->getLanguage()); ?>
:</label>
		<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('date_id' => 'category_date', 'date_name' => "category_data[timestamp]", 'date_val' => smarty_modifier_default(@$this->_tpl_vars['category_data']['timestamp'], @TIME), 'start_year' => $this->_tpl_vars['settings']['Company']['company_start_year'], )); ?><?php if ($this->_tpl_vars['settings']['Appearance']['calendar_date_format'] == 'month_first'): ?>
	<?php $this->assign('date_format', "%m/%d/%Y", false); ?>
<?php else: ?>
	<?php $this->assign('date_format', "%d/%m/%Y", false); ?>
<?php endif; ?>

<input type="text" id="<?php echo $this->_tpl_vars['date_id']; ?>
" name="<?php echo $this->_tpl_vars['date_name']; ?>
" class="input-text<?php if ($this->_tpl_vars['date_meta']): ?> <?php echo $this->_tpl_vars['date_meta']; ?>
<?php endif; ?> cm-calendar" value="<?php if ($this->_tpl_vars['date_val']): ?><?php echo smarty_modifier_date_format(fn_parse_date($this->_tpl_vars['date_val']), ($this->_tpl_vars['date_format'])); ?>
<?php endif; ?>" <?php echo $this->_tpl_vars['extra']; ?>
 size="10" />&nbsp;<img src="<?php echo $this->_tpl_vars['images_dir']; ?>
/icons/calendar.png" class="cm-external-focus calendar-but" rev="<?php echo $this->_tpl_vars['date_id']; ?>
" title="<?php echo fn_get_lang_var('calendar', $this->getLanguage()); ?>
" alt="<?php echo fn_get_lang_var('calendar', $this->getLanguage()); ?>
" />

<script type="text/javascript">
//<![CDATA[

var calendar_config = <?php echo $this->_tpl_vars['ldelim']; ?>
<?php echo $this->_tpl_vars['rdelim']; ?>
;
calendar_config = <?php echo $this->_tpl_vars['ldelim']; ?>

			changeMonth: true,
			duration: 'fast',
			changeYear: true,
			numberOfMonths: 1,
			selectOtherMonths: true,
			showOtherMonths: true,
			firstDay: <?php if ($this->_tpl_vars['settings']['Appearance']['calendar_week_format'] == 'sunday_first'): ?>0<?php else: ?>1<?php endif; ?>,
			dayNamesMin: ['<?php echo fn_get_lang_var('weekday_abr_0', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('weekday_abr_1', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('weekday_abr_2', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('weekday_abr_3', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('weekday_abr_4', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('weekday_abr_5', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('weekday_abr_6', $this->getLanguage()); ?>
'],
			monthNamesShort: ['<?php echo fn_get_lang_var('month_name_abr_1', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('month_name_abr_2', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('month_name_abr_3', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('month_name_abr_4', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('month_name_abr_5', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('month_name_abr_6', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('month_name_abr_7', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('month_name_abr_8', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('month_name_abr_9', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('month_name_abr_10', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('month_name_abr_11', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('month_name_abr_12', $this->getLanguage()); ?>
'],
			yearRange: '<?php echo smarty_modifier_default(@$this->_tpl_vars['start_year'], @$this->_tpl_vars['settings']['Company']['company_start_year']); ?>
:<?php echo smarty_function_math(array('equation' => "x+y",'x' => smarty_modifier_default(@$this->_tpl_vars['end_year'], 1),'y' => smarty_modifier_date_format(@TIME, "%Y")), $this);?>
',
			dateFormat: '<?php if ($this->_tpl_vars['settings']['Appearance']['calendar_date_format'] == 'month_first'): ?>mm/dd/yy<?php else: ?>dd/mm/yy<?php endif; ?>'
		<?php echo $this->_tpl_vars['rdelim']; ?>
;

if ($.ua.browser == 'Internet Explorer') <?php echo $this->_tpl_vars['ldelim']; ?>

	$(window).load(function()<?php echo $this->_tpl_vars['ldelim']; ?>

		$('#<?php echo $this->_tpl_vars['date_id']; ?>
').datepicker(calendar_config);
	<?php echo $this->_tpl_vars['rdelim']; ?>
);
<?php echo $this->_tpl_vars['rdelim']; ?>
 else <?php echo $this->_tpl_vars['ldelim']; ?>

	$(function() <?php echo $this->_tpl_vars['ldelim']; ?>

		$('#<?php echo $this->_tpl_vars['date_id']; ?>
').datepicker(calendar_config);
	<?php echo $this->_tpl_vars['rdelim']; ?>
);
<?php echo $this->_tpl_vars['rdelim']; ?>



//]]>
</script><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
	</div>

	<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('data_from' => $this->_tpl_vars['category_data']['localization'], 'data_name' => "category_data[localization]", )); ?>
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
	
	</fieldset>
</div>

<div id="content_layout">
	<fieldset>
	
	<div class="form-field">
		<label for="category_default_layout"><?php echo fn_get_lang_var('product_details_layout', $this->getLanguage()); ?>
<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('tooltip' => fn_get_lang_var('tt_views_categories_update_product_details_layout', $this->getLanguage()), )); ?><?php if ($this->_tpl_vars['tooltip']): ?> (<a class="cm-tooltip<?php if ($this->_tpl_vars['params']): ?> <?php echo $this->_tpl_vars['params']; ?>
<?php endif; ?>" title="<?php echo smarty_modifier_escape($this->_tpl_vars['tooltip'], 'html'); ?>
">?</a>)<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>:</label>
		<select id="category_default_layout" name="category_data[product_details_layout]">
			<?php $_from = fn_get_product_details_views('category'); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['layout'] => $this->_tpl_vars['item']):
?>
				<option <?php if ($this->_tpl_vars['category_data']['product_details_layout'] == $this->_tpl_vars['layout']): ?>selected="selected"<?php endif; ?> value="<?php echo $this->_tpl_vars['layout']; ?>
"><?php echo $this->_tpl_vars['item']; ?>
</option>
			<?php endforeach; endif; unset($_from); ?>
		</select>
	</div>
		
	<div class="form-field">
		<label for="use_custom_templates"><?php echo fn_get_lang_var('use_custom_layout', $this->getLanguage()); ?>
:</label>
		<input type="hidden" value="N" name="category_data[use_custom_templates]"/>
		<input type="checkbox" class="checkbox cm-toggle-checkbox" value="Y" name="category_data[use_custom_templates]" id="use_custom_templates"<?php if ($this->_tpl_vars['category_data']['selected_layouts']): ?> checked="checked"<?php endif; ?> />
	</div>
	
	<div class="form-field">
		<label for="category_product_columns"><?php echo fn_get_lang_var('product_columns', $this->getLanguage()); ?>
:</label>
		<input type="text" name="category_data[product_columns]" id="category_product_columns" size="10" value="<?php echo $this->_tpl_vars['category_data']['product_columns']; ?>
" class="input-text-short cm-toggle-element" <?php if (! $this->_tpl_vars['category_data']['selected_layouts']): ?>disabled="disabled"<?php endif; ?> />
	</div>

	<?php $this->assign('layouts', fn_get_products_views("", false, false), false); ?>
	<div class="form-field">
		<label for="available_layouts"><?php echo fn_get_lang_var('available_layouts', $this->getLanguage()); ?>
:</label>
		<div class="table-filters">
			<div class="scroll-y">
				<?php $_from = $this->_tpl_vars['layouts']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['layout'] => $this->_tpl_vars['item']):
?>
					<div class="select-field"><input type="checkbox" class="checkbox cm-combo-checkbox cm-toggle-element" name="category_data[selected_layouts][<?php echo $this->_tpl_vars['layout']; ?>
]" id="layout_<?php echo $this->_tpl_vars['layout']; ?>
" value="<?php echo $this->_tpl_vars['layout']; ?>
" <?php if (( $this->_tpl_vars['category_data']['selected_layouts'][$this->_tpl_vars['layout']] ) || ( ! $this->_tpl_vars['category_data']['selected_layouts'] && $this->_tpl_vars['item']['active'] )): ?>checked="checked"<?php endif; ?> <?php if (! $this->_tpl_vars['category_data']['selected_layouts']): ?>disabled="disabled"<?php endif; ?> /><label for="layout_<?php echo $this->_tpl_vars['layout']; ?>
"><?php echo $this->_tpl_vars['item']['title']; ?>
</label></div>
				<?php endforeach; endif; unset($_from); ?>
			</div>
		</div>
	</div>
	
	<div class="form-field">
		<label for="category_default_layout"><?php echo fn_get_lang_var('default_category_layout', $this->getLanguage()); ?>
:</label>
		<select id="category_default_layout" class="cm-combo-select cm-toggle-element" name="category_data[default_layout]" <?php if (! $this->_tpl_vars['category_data']['selected_layouts']): ?>disabled="disabled"<?php endif; ?>>
			<?php $_from = $this->_tpl_vars['layouts']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['layout'] => $this->_tpl_vars['item']):
?>
				<?php if (( $this->_tpl_vars['category_data']['selected_layouts'][$this->_tpl_vars['layout']] ) || ( ! $this->_tpl_vars['category_data']['selected_layouts'] && $this->_tpl_vars['item']['active'] )): ?>
					<option <?php if ($this->_tpl_vars['category_data']['default_layout'] == $this->_tpl_vars['layout']): ?>selected="selected"<?php endif; ?> value="<?php echo $this->_tpl_vars['layout']; ?>
"><?php echo $this->_tpl_vars['item']['title']; ?>
</option>
				<?php endif; ?>
			<?php endforeach; endif; unset($_from); ?>
		</select>
	</div>
	
	</fieldset>
</div>

<div id="content_addons">
<?php $this->_tag_stack[] = array('hook', array('name' => "categories:detailed_content")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
<?php if ($this->_tpl_vars['addons']['seo']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/seo/hooks/categories/detailed_content.post.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php if ($this->_tpl_vars['addons']['age_verification']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/age_verification/hooks/categories/detailed_content.post.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php if ($this->_tpl_vars['addons']['discussion']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/discussion/hooks/categories/detailed_content.post.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
</div>

<?php $this->_tag_stack[] = array('hook', array('name' => "categories:tabs_content")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
<?php if ($this->_tpl_vars['addons']['reward_points']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/reward_points/hooks/categories/tabs_content.post.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

<div class="buttons-container cm-toggle-button buttons-bg">
	<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/save_cancel.tpl", 'smarty_include_vars' => array('but_name' => "dispatch[categories.update]")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>

</form>

<?php if ($this->_tpl_vars['id']): ?>
	<?php $this->_tag_stack[] = array('hook', array('name' => "categories:tabs_extra")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
	<?php if ($this->_tpl_vars['addons']['discussion']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/discussion/hooks/categories/tabs_extra.post.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
<?php endif; ?>

<?php $this->_smarty_vars['capture']['tabsbox'] = ob_get_contents(); ob_end_clean(); ?>
<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('content' => $this->_smarty_vars['capture']['tabsbox'], 'group_name' => $this->_tpl_vars['controller'], 'active_tab' => $this->_tpl_vars['_REQUEST']['selected_section'], 'track' => true, )); ?><?php echo smarty_function_script(array('src' => "js/tabs.js"), $this);?>


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

<?php if (! $this->_tpl_vars['id']): ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/mainbox.tpl", 'smarty_include_vars' => array('title' => fn_get_lang_var('new_category', $this->getLanguage()),'content' => $this->_smarty_vars['capture']['mainbox'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php else: ?>
	<?php ob_start(); ?>
		
		<?php $this->assign('view_uri', "categories.view?category_id=".($this->_tpl_vars['id']), false); ?>
		<?php $this->assign('view_uri_escaped', smarty_modifier_escape(fn_url(($this->_tpl_vars['view_uri'])."`&amp;action=preview", 'C', 'http', '&', @DESCR_SL), 'url'), false); ?>
		
		

		
		<a target="_blank" class="tool-link" title="<?php echo fn_url($this->_tpl_vars['view_uri'], 'C', 'http', '&', @DESCR_SL); ?>
" href="<?php echo fn_url($this->_tpl_vars['view_uri'], 'C', 'http', '&', @DESCR_SL); ?>
"><?php echo fn_get_lang_var('preview', $this->getLanguage()); ?>
</a>
		<a target="_blank" class="tool-link" title="<?php echo fn_url($this->_tpl_vars['view_uri'], 'C', 'http', '&', @DESCR_SL); ?>
" href="<?php echo fn_url("profiles.act_as_user?user_id=".($this->_tpl_vars['auth']['user_id'])."&amp;area=C&amp;redirect_url=".($this->_tpl_vars['view_uri_escaped'])); ?>
"><?php echo fn_get_lang_var('preview_as_admin', $this->getLanguage()); ?>
</a>
	<?php $this->_smarty_vars['capture']['preview'] = ob_get_contents(); ob_end_clean(); ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/mainbox.tpl", 'smarty_include_vars' => array('title' => (fn_get_lang_var('editing_category', $this->getLanguage())).":&nbsp;".($this->_tpl_vars['category_data']['category']),'content' => $this->_smarty_vars['capture']['mainbox'],'select_languages' => true)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php endif; ?>