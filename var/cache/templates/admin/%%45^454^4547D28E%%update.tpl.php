<?php /* Smarty version 2.6.18, created on 2014-03-07 22:41:10
         compiled from views/product_options/update.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'views/product_options/update.tpl', 1, false),array('modifier', 'defined', 'views/product_options/update.tpl', 24, false),array('modifier', 'fn_url', 'views/product_options/update.tpl', 31, false),array('modifier', 'escape', 'views/product_options/update.tpl', 61, false),array('modifier', 'strpos', 'views/product_options/update.tpl', 63, false),array('modifier', 'unescape', 'views/product_options/update.tpl', 159, false),array('modifier', 'is_array', 'views/product_options/update.tpl', 277, false),array('modifier', 'fn_from_json', 'views/product_options/update.tpl', 278, false),array('modifier', 'lower', 'views/product_options/update.tpl', 281, false),array('block', 'hook', 'views/product_options/update.tpl', 191, false),array('function', 'math', 'views/product_options/update.tpl', 327, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('general','variants','name','position','inventory','tt_views_product_options_update_inventory','vendor','type','selectbox','radiogroup','checkbox','text','textarea','file','selectbox','radiogroup','checkbox','text','textarea','file','description','comment','comment_hint','required','tt_views_product_options_update_required','missing_variants_handling','display_message','hide_option_completely','regexp','tt_views_product_options_update_regexp','regexp_hint','inner_hint','tt_views_product_options_update_inner_hint','incorrect_filling_message','tt_views_product_options_update_incorrect_filling_message','allowed_extensions','allowed_extensions_hint','max_uploading_file_size','max_uploading_file_size_hint','multiupload','position_short','name','modifier','type','weight_modifier','type','status','expand_collapse_list','expand_collapse_list','expand_collapse_list','expand_collapse_list','update_for_all_hid_act','update_for_all_hid_dis','update_for_all_act','update_for_all_dis','active','hidden','disabled','status','active','hidden','disabled','status','active','hidden','pending','disabled','expand_collapse_list','expand_collapse_list','expand_collapse_list','expand_collapse_list','extra','icon','earned_point_modifier','type','points_lower','active','hidden','disabled','status','active','hidden','disabled','status','active','hidden','pending','disabled','expand_collapse_list','expand_collapse_list','expand_collapse_list','expand_collapse_list','extra','icon','earned_point_modifier','type','points_lower','create'));
?>
<?php 

				$rname = !empty($resource_name) ? $resource_name : $params['smarty_include_tpl_file'];
				if ($this->compile_check && empty($inline_no_check[$rname]) && $this->is_cached($rname)) {
					if ($this->check_inline_blocks(array (
  'addons/reward_points/hooks/product_options/edit_product_options.post.tpl' => 1367063840,
))) {
						$_smarty_compile_path = $this->_get_compile_path($rname);
						$this->_compile_resource($rname, $_smarty_compile_path);
						$inline_no_check[$rname] = true;
						include $_smarty_compile_path;
						return;
					}
				}
			 ?><?php if ($this->_tpl_vars['option_data']['option_id']): ?>
	<?php $this->assign('id', $this->_tpl_vars['option_data']['option_id'], false); ?>
<?php else: ?>
	<?php $this->assign('id', 0, false); ?>
<?php endif; ?>




<?php if (defined('COMPANY_ID') && $this->_tpl_vars['id'] && $this->_tpl_vars['option_data']['company_id'] != @COMPANY_ID): ?>
	<?php $this->assign('cm_hide_inputs', "cm-hide-inputs", false); ?>
<?php endif; ?>


<div id="content_group_product_option_<?php echo $this->_tpl_vars['id']; ?>
">

<form action="<?php echo fn_url(""); ?>
" method="post" name="option_form_<?php echo $this->_tpl_vars['id']; ?>
" class="form-highlight cm-disable-empty-files <?php echo $this->_tpl_vars['cm_hide_inputs']; ?>
" enctype="multipart/form-data">
<input type="hidden" name="option_id" value="<?php echo $this->_tpl_vars['id']; ?>
" class="<?php echo $this->_tpl_vars['cm_no_hide_input']; ?>
" />
<?php if ($this->_tpl_vars['_REQUEST']['product_id']): ?>
<input class="cm-no-hide-input" type="hidden" name="option_data[product_id]" value="<?php echo $this->_tpl_vars['_REQUEST']['product_id']; ?>
" />

<?php endif; ?>

<div class="tabs cm-j-tabs">
	<ul>
		<li id="tab_option_details_<?php echo $this->_tpl_vars['id']; ?>
" class="cm-js cm-active"><a><?php echo fn_get_lang_var('general', $this->getLanguage()); ?>
</a></li>
		<?php if ($this->_tpl_vars['option_data']['option_type'] == 'S' || $this->_tpl_vars['option_data']['option_type'] == 'R' || $this->_tpl_vars['option_data']['option_type'] == 'C' || ! $this->_tpl_vars['option_data']): ?>
			<li id="tab_option_variants_<?php echo $this->_tpl_vars['id']; ?>
" class="cm-js"><a><?php echo fn_get_lang_var('variants', $this->getLanguage()); ?>
</a></li>
		<?php endif; ?>
	</ul>
</div>
<div class="cm-tabs-content" id="tabs_content_<?php echo $this->_tpl_vars['id']; ?>
">
	<div id="content_tab_option_details_<?php echo $this->_tpl_vars['id']; ?>
">
	<fieldset>
		<div class="form-field">
			<input class="cm-no-hide-input" type="hidden" value="<?php echo $this->_tpl_vars['object']; ?>
" name="object">
			<label for="name_<?php echo $this->_tpl_vars['id']; ?>
" class="cm-required"><?php echo fn_get_lang_var('name', $this->getLanguage()); ?>
:</label>
			<input type="text" name="option_data[option_name]" id="name_<?php echo $this->_tpl_vars['id']; ?>
" value="<?php echo $this->_tpl_vars['option_data']['option_name']; ?>
" class="input-text-large main-input" />
		</div>

		<div class="form-field">
			<label for="position_<?php echo $this->_tpl_vars['id']; ?>
"><?php echo fn_get_lang_var('position', $this->getLanguage()); ?>
:</label>
			<input type="text" name="option_data[position]" id="position_<?php echo $this->_tpl_vars['id']; ?>
" value="<?php echo $this->_tpl_vars['option_data']['position']; ?>
" size="3" class="input-text-short" />
		</div>

		<div class="form-field">
			<label for="inventory_<?php echo $this->_tpl_vars['id']; ?>
"><?php echo fn_get_lang_var('inventory', $this->getLanguage()); ?>
<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('tooltip' => fn_get_lang_var('tt_views_product_options_update_inventory', $this->getLanguage()), )); ?><?php if ($this->_tpl_vars['tooltip']): ?> (<a class="cm-tooltip<?php if ($this->_tpl_vars['params']): ?> <?php echo $this->_tpl_vars['params']; ?>
<?php endif; ?>" title="<?php echo smarty_modifier_escape($this->_tpl_vars['tooltip'], 'html'); ?>
">?</a>)<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>:</label>
			<input type="hidden" name="option_data[inventory]" value="N" />
			<?php if (strpos('SRC', $this->_tpl_vars['option_data']['option_type']) !== false): ?>
				<input type="checkbox" name="option_data[inventory]" id="inventory_<?php echo $this->_tpl_vars['id']; ?>
" value="Y" <?php if ($this->_tpl_vars['option_data']['inventory'] == 'Y'): ?>checked="checked"<?php endif; ?> class="checkbox" />
			<?php else: ?>
				&nbsp;-&nbsp;
			<?php endif; ?>
		</div>
		
		<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/companies/components/company_field.tpl", 'smarty_include_vars' => array('title' => fn_get_lang_var('vendor', $this->getLanguage()),'name' => "option_data[company_id]",'id' => "option_data_".($this->_tpl_vars['id']),'selected' => smarty_modifier_default(@$this->_tpl_vars['option_data']['company_id'], @$this->_tpl_vars['company_id']),'disable_company_picker' => $this->_tpl_vars['disable_company_picker'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>


		<div class="form-field">
			<label for="option_type_<?php echo $this->_tpl_vars['id']; ?>
"><?php echo fn_get_lang_var('type', $this->getLanguage()); ?>
:</label>
			<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('name' => "option_data[option_type]", 'value' => $this->_tpl_vars['option_data']['option_type'], 'display' => 'select', 'tag_id' => "option_type_".($this->_tpl_vars['id']), 'check' => true, )); ?><?php echo ''; ?><?php if ($this->_tpl_vars['display'] == 'view'): ?><?php echo ''; ?><?php if ($this->_tpl_vars['value'] == 'S'): ?><?php echo ''; ?><?php echo fn_get_lang_var('selectbox', $this->getLanguage()); ?><?php echo ''; ?><?php elseif ($this->_tpl_vars['value'] == 'R'): ?><?php echo ''; ?><?php echo fn_get_lang_var('radiogroup', $this->getLanguage()); ?><?php echo ''; ?><?php elseif ($this->_tpl_vars['value'] == 'C'): ?><?php echo ''; ?><?php echo fn_get_lang_var('checkbox', $this->getLanguage()); ?><?php echo ''; ?><?php elseif ($this->_tpl_vars['value'] == 'I'): ?><?php echo ''; ?><?php echo fn_get_lang_var('text', $this->getLanguage()); ?><?php echo ''; ?><?php elseif ($this->_tpl_vars['value'] == 'T'): ?><?php echo ''; ?><?php echo fn_get_lang_var('textarea', $this->getLanguage()); ?><?php echo ''; ?><?php elseif ($this->_tpl_vars['value'] == 'F'): ?><?php echo ''; ?><?php echo fn_get_lang_var('file', $this->getLanguage()); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php if ($this->_tpl_vars['value']): ?><?php echo ''; ?><?php if ($this->_tpl_vars['value'] == 'S' || $this->_tpl_vars['value'] == 'R'): ?><?php echo ''; ?><?php $this->assign('app_types', 'SR', false); ?><?php echo ''; ?><?php elseif ($this->_tpl_vars['value'] == 'I' || $this->_tpl_vars['value'] == 'T'): ?><?php echo ''; ?><?php $this->assign('app_types', 'IT', false); ?><?php echo ''; ?><?php elseif ($this->_tpl_vars['value'] == 'C'): ?><?php echo ''; ?><?php $this->assign('app_types', 'C', false); ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php $this->assign('app_types', 'F', false); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php $this->assign('app_types', "", false); ?><?php echo ''; ?><?php endif; ?><?php echo '<select id="'; ?><?php echo $this->_tpl_vars['tag_id']; ?><?php echo '" name="'; ?><?php echo $this->_tpl_vars['name']; ?><?php echo '" '; ?><?php if ($this->_tpl_vars['check']): ?><?php echo 'onchange="fn_check_option_type(this.value, this.id);"'; ?><?php endif; ?><?php echo '>'; ?><?php if (! $this->_tpl_vars['app_types'] || ( $this->_tpl_vars['app_types'] && strpos($this->_tpl_vars['app_types'], 'S') !== false )): ?><?php echo '<option value="S" '; ?><?php if ($this->_tpl_vars['value'] == 'S'): ?><?php echo 'selected="selected"'; ?><?php endif; ?><?php echo '>'; ?><?php echo fn_get_lang_var('selectbox', $this->getLanguage()); ?><?php echo '</option>'; ?><?php endif; ?><?php echo ''; ?><?php if (! $this->_tpl_vars['app_types'] || ( $this->_tpl_vars['app_types'] && strpos($this->_tpl_vars['app_types'], 'R') !== false )): ?><?php echo '<option value="R" '; ?><?php if ($this->_tpl_vars['value'] == 'R'): ?><?php echo 'selected="selected"'; ?><?php endif; ?><?php echo '>'; ?><?php echo fn_get_lang_var('radiogroup', $this->getLanguage()); ?><?php echo '</option>'; ?><?php endif; ?><?php echo ''; ?><?php if (! $this->_tpl_vars['app_types'] || ( $this->_tpl_vars['app_types'] && strpos($this->_tpl_vars['app_types'], 'C') !== false )): ?><?php echo '<option value="C" '; ?><?php if ($this->_tpl_vars['value'] == 'C'): ?><?php echo 'selected="selected"'; ?><?php endif; ?><?php echo '>'; ?><?php echo fn_get_lang_var('checkbox', $this->getLanguage()); ?><?php echo '</option>'; ?><?php endif; ?><?php echo ''; ?><?php if (! $this->_tpl_vars['app_types'] || ( $this->_tpl_vars['app_types'] && strpos($this->_tpl_vars['app_types'], 'I') !== false )): ?><?php echo '<option value="I" '; ?><?php if ($this->_tpl_vars['value'] == 'I'): ?><?php echo 'selected="selected"'; ?><?php endif; ?><?php echo '>'; ?><?php echo fn_get_lang_var('text', $this->getLanguage()); ?><?php echo '</option>'; ?><?php endif; ?><?php echo ''; ?><?php if (! $this->_tpl_vars['app_types'] || ( $this->_tpl_vars['app_types'] && strpos($this->_tpl_vars['app_types'], 'T') !== false )): ?><?php echo '<option value="T" '; ?><?php if ($this->_tpl_vars['value'] == 'T'): ?><?php echo 'selected="selected"'; ?><?php endif; ?><?php echo '>'; ?><?php echo fn_get_lang_var('textarea', $this->getLanguage()); ?><?php echo '</option>'; ?><?php endif; ?><?php echo ''; ?><?php if (! $this->_tpl_vars['app_types'] || ( $this->_tpl_vars['app_types'] && strpos($this->_tpl_vars['app_types'], 'F') !== false )): ?><?php echo '<option value="F" '; ?><?php if ($this->_tpl_vars['value'] == 'F'): ?><?php echo 'selected="selected"'; ?><?php endif; ?><?php echo '>'; ?><?php echo fn_get_lang_var('file', $this->getLanguage()); ?><?php echo '</option>'; ?><?php endif; ?><?php echo '</select>'; ?><?php endif; ?><?php echo ''; ?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
		</div>
		
		<div class="form-field">
			<label for="description_<?php echo $this->_tpl_vars['id']; ?>
"><?php echo fn_get_lang_var('description', $this->getLanguage()); ?>
:</label>
			<textarea id="description_<?php echo $this->_tpl_vars['id']; ?>
" name="option_data[description]" cols="55" rows="8" class="cm-wysiwyg input-textarea-long"><?php echo $this->_tpl_vars['option_data']['description']; ?>
</textarea>
			
		</div>
		
		<div class="form-field">
			<label for="comment_<?php echo $this->_tpl_vars['id']; ?>
"><?php echo fn_get_lang_var('comment', $this->getLanguage()); ?>
:</label>
			<input type="text" name="option_data[comment]" id="comment_<?php echo $this->_tpl_vars['id']; ?>
" value="<?php echo $this->_tpl_vars['option_data']['comment']; ?>
" class="input-text-large" />
			<p class="description"><?php echo fn_get_lang_var('comment_hint', $this->getLanguage()); ?>
</p>
		</div>
		
		<div class="form-field">
			<label for="file_required_<?php echo $this->_tpl_vars['id']; ?>
"><?php echo fn_get_lang_var('required', $this->getLanguage()); ?>
<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('tooltip' => fn_get_lang_var('tt_views_product_options_update_required', $this->getLanguage()), )); ?><?php if ($this->_tpl_vars['tooltip']): ?> (<a class="cm-tooltip<?php if ($this->_tpl_vars['params']): ?> <?php echo $this->_tpl_vars['params']; ?>
<?php endif; ?>" title="<?php echo smarty_modifier_escape($this->_tpl_vars['tooltip'], 'html'); ?>
">?</a>)<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>:</label>
			<input type="hidden" name="option_data[required]" value="N" /><input type="checkbox" id="file_required_<?php echo $this->_tpl_vars['id']; ?>
" name="option_data[required]" value="Y" <?php if ($this->_tpl_vars['option_data']['required'] == 'Y'): ?>checked="checked"<?php endif; ?> class="checkbox" />
		</div>
		
		<?php if (! $this->_tpl_vars['option_data']['option_type'] || strpos('SRC', $this->_tpl_vars['option_data']['option_type']) !== false): ?>
			<div class="form-field">
				<label for="file_required_<?php echo $this->_tpl_vars['id']; ?>
"><?php echo fn_get_lang_var('missing_variants_handling', $this->getLanguage()); ?>
:</label>
				<?php if (strpos('SRC', $this->_tpl_vars['option_data']['option_type']) !== false): ?>
					<select name="option_data[missing_variants_handling]">
						<option value="M" <?php if ($this->_tpl_vars['option_data']['missing_variants_handling'] == 'M'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('display_message', $this->getLanguage()); ?>
</option>
						<option value="H" <?php if ($this->_tpl_vars['option_data']['missing_variants_handling'] == 'H'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('hide_option_completely', $this->getLanguage()); ?>
</option>
					</select>
				<?php else: ?>
					&nbsp;-&nbsp;
				<?php endif; ?>
			</div>
		<?php endif; ?>
		
		<div id="extra_options_<?php echo $this->_tpl_vars['id']; ?>
" <?php if ($this->_tpl_vars['option_data']['option_type'] != 'I' && $this->_tpl_vars['option_data']['option_type'] != 'T'): ?>class="hidden"<?php endif; ?>>
			<div class="form-field">
				<label for="regexp_<?php echo $this->_tpl_vars['id']; ?>
"><?php echo fn_get_lang_var('regexp', $this->getLanguage()); ?>
<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('tooltip' => fn_get_lang_var('tt_views_product_options_update_regexp', $this->getLanguage()), )); ?><?php if ($this->_tpl_vars['tooltip']): ?> (<a class="cm-tooltip<?php if ($this->_tpl_vars['params']): ?> <?php echo $this->_tpl_vars['params']; ?>
<?php endif; ?>" title="<?php echo smarty_modifier_escape($this->_tpl_vars['tooltip'], 'html'); ?>
">?</a>)<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>:</label>
				<input type="text" name="option_data[regexp]" id="regexp_<?php echo $this->_tpl_vars['id']; ?>
" value="<?php echo smarty_modifier_unescape($this->_tpl_vars['option_data']['regexp']); ?>
" class="input-text-large" />
				<p class="description"><?php echo fn_get_lang_var('regexp_hint', $this->getLanguage()); ?>
</p>
			</div>
			
			<div class="form-field">
				<label for="inner_hint_<?php echo $this->_tpl_vars['id']; ?>
"><?php echo fn_get_lang_var('inner_hint', $this->getLanguage()); ?>
<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('tooltip' => fn_get_lang_var('tt_views_product_options_update_inner_hint', $this->getLanguage()), )); ?><?php if ($this->_tpl_vars['tooltip']): ?> (<a class="cm-tooltip<?php if ($this->_tpl_vars['params']): ?> <?php echo $this->_tpl_vars['params']; ?>
<?php endif; ?>" title="<?php echo smarty_modifier_escape($this->_tpl_vars['tooltip'], 'html'); ?>
">?</a>)<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>:</label>
				<input type="text" name="option_data[inner_hint]" id="inner_hint_<?php echo $this->_tpl_vars['id']; ?>
" value="<?php echo $this->_tpl_vars['option_data']['inner_hint']; ?>
" class="input-text-large" />
			</div>
			
			<div class="form-field">
				<label for="incorrect_message_<?php echo $this->_tpl_vars['id']; ?>
"><?php echo fn_get_lang_var('incorrect_filling_message', $this->getLanguage()); ?>
<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('tooltip' => fn_get_lang_var('tt_views_product_options_update_incorrect_filling_message', $this->getLanguage()), )); ?><?php if ($this->_tpl_vars['tooltip']): ?> (<a class="cm-tooltip<?php if ($this->_tpl_vars['params']): ?> <?php echo $this->_tpl_vars['params']; ?>
<?php endif; ?>" title="<?php echo smarty_modifier_escape($this->_tpl_vars['tooltip'], 'html'); ?>
">?</a>)<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>:</label>
				<input type="text" name="option_data[incorrect_message]" id="incorrect_message_<?php echo $this->_tpl_vars['id']; ?>
" value="<?php echo $this->_tpl_vars['option_data']['incorrect_message']; ?>
" class="input-text-large" />
			</div>
		</div>
		
		<div id="file_options_<?php echo $this->_tpl_vars['id']; ?>
" <?php if ($this->_tpl_vars['option_data']['option_type'] != 'F'): ?>class="hidden"<?php endif; ?>>
			<div class="form-field">
				<label for="allowed_extensions_<?php echo $this->_tpl_vars['id']; ?>
"><?php echo fn_get_lang_var('allowed_extensions', $this->getLanguage()); ?>
:</label>
				<input type="text" name="option_data[allowed_extensions]" id="allowed_extensions_<?php echo $this->_tpl_vars['id']; ?>
" value="<?php echo $this->_tpl_vars['option_data']['allowed_extensions']; ?>
" class="input-text-large" />
				<p class="description"><?php echo fn_get_lang_var('allowed_extensions_hint', $this->getLanguage()); ?>
</p>
			</div>
			<div class="form-field">
				<label for="max_uploading_file_size_<?php echo $this->_tpl_vars['id']; ?>
"><?php echo fn_get_lang_var('max_uploading_file_size', $this->getLanguage()); ?>
:</label>
				<input type="text" name="option_data[max_file_size]" id="max_uploading_file_size_<?php echo $this->_tpl_vars['id']; ?>
" value="<?php echo $this->_tpl_vars['option_data']['max_file_size']; ?>
" class="input-text-large" />
				<p class="description"><?php echo fn_get_lang_var('max_uploading_file_size_hint', $this->getLanguage()); ?>
</p>
			</div>
			<div class="form-field">
				<label for="multiupload_<?php echo $this->_tpl_vars['id']; ?>
"><?php echo fn_get_lang_var('multiupload', $this->getLanguage()); ?>
:</label>
				<input type="hidden" name="option_data[multiupload]" value="N" /><input type="checkbox" id="multiupload_<?php echo $this->_tpl_vars['id']; ?>
" name="option_data[multiupload]" value="Y" <?php if ($this->_tpl_vars['option_data']['multiupload'] == 'Y'): ?>checked="checked"<?php endif; ?> class="checkbox" />
			</div>
		</div>
		
		<?php $this->_tag_stack[] = array('hook', array('name' => "product_options:properties")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
		<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
	</fieldset>
	<!--content_tab_option_details_<?php echo $this->_tpl_vars['id']; ?>
--></div>

 	<div class="hidden" id="content_tab_option_variants_<?php echo $this->_tpl_vars['id']; ?>
">
 	<fieldset>
		<table cellpadding="0" cellspacing="0" class="table">
		<tbody>
		<tr class="first-sibling">
			<th class="cm-non-cb<?php if ($this->_tpl_vars['option_data']['option_type'] == 'C'): ?> hidden<?php endif; ?>"><?php echo fn_get_lang_var('position_short', $this->getLanguage()); ?>
</th>
			<th class="cm-non-cb<?php if ($this->_tpl_vars['option_data']['option_type'] == 'C'): ?> hidden<?php endif; ?>"><?php echo fn_get_lang_var('name', $this->getLanguage()); ?>
</th>
			<th><?php echo fn_get_lang_var('modifier', $this->getLanguage()); ?>
&nbsp;/&nbsp;<?php echo fn_get_lang_var('type', $this->getLanguage()); ?>
</th>
			<th><?php echo fn_get_lang_var('weight_modifier', $this->getLanguage()); ?>
&nbsp;/&nbsp;<?php echo fn_get_lang_var('type', $this->getLanguage()); ?>
</th>
			<th class="cm-non-cb<?php if ($this->_tpl_vars['option_data']['option_type'] == 'C'): ?> hidden<?php endif; ?>"><?php echo fn_get_lang_var('status', $this->getLanguage()); ?>
</th>
			<th><img src="<?php echo $this->_tpl_vars['images_dir']; ?>
/plus_minus.gif" width="13" height="12" border="0" name="plus_minus" id="on_st_<?php echo $this->_tpl_vars['id']; ?>
" alt="<?php echo fn_get_lang_var('expand_collapse_list', $this->getLanguage()); ?>
" title="<?php echo fn_get_lang_var('expand_collapse_list', $this->getLanguage()); ?>
" class="hand cm-combinations-options-<?php echo $this->_tpl_vars['id']; ?>
" /><img src="<?php echo $this->_tpl_vars['images_dir']; ?>
/minus_plus.gif" width="13" height="12" border="0" name="minus_plus" id="off_st_<?php echo $this->_tpl_vars['id']; ?>
" alt="<?php echo fn_get_lang_var('expand_collapse_list', $this->getLanguage()); ?>
" title="<?php echo fn_get_lang_var('expand_collapse_list', $this->getLanguage()); ?>
" class="hand hidden cm-combinations-options-<?php echo $this->_tpl_vars['id']; ?>
" /></th>
			<th class="cm-non-cb<?php if ($this->_tpl_vars['option_data']['option_type'] == 'C'): ?> hidden<?php endif; ?>">&nbsp;</th>
		</tr>
		</tbody>
		<?php $_from = $this->_tpl_vars['option_data']['variants']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['fe_v'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['fe_v']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['vr']):
        $this->_foreach['fe_v']['iteration']++;
?>
		<?php $this->assign('num', $this->_foreach['fe_v']['iteration'], false); ?>
		<tbody class="hover cm-row-item" id="option_variants_<?php echo $this->_tpl_vars['id']; ?>
_<?php echo $this->_tpl_vars['num']; ?>
">
		<tr>
			<td class="cm-non-cb<?php if ($this->_tpl_vars['option_data']['option_type'] == 'C'): ?> hidden<?php endif; ?>">
				<input type="text" name="option_data[variants][<?php echo $this->_tpl_vars['num']; ?>
][position]" value="<?php echo $this->_tpl_vars['vr']['position']; ?>
" size="3" class="input-text-short" /></td>
			<td class="cm-non-cb<?php if ($this->_tpl_vars['option_data']['option_type'] == 'C'): ?> hidden<?php endif; ?>">
				<input type="text" name="option_data[variants][<?php echo $this->_tpl_vars['num']; ?>
][variant_name]" value="<?php echo $this->_tpl_vars['vr']['variant_name']; ?>
" class="input-text-medium main-input" /></td>
			<td class="nowrap <?php if (defined('COMPANY_ID') && $this->_tpl_vars['shared_product'] == 'Y'): ?> cm-no-hide-input<?php endif; ?>">
				<input type="text" name="option_data[variants][<?php echo $this->_tpl_vars['num']; ?>
][modifier]" value="<?php echo $this->_tpl_vars['vr']['modifier']; ?>
" size="5" class="input-text" />&nbsp;/&nbsp;<select name="option_data[variants][<?php echo $this->_tpl_vars['num']; ?>
][modifier_type]">
					<option value="A" <?php if ($this->_tpl_vars['vr']['modifier_type'] == 'A'): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['currencies'][$this->_tpl_vars['primary_currency']]['symbol']; ?>
</option>
					<option value="P" <?php if ($this->_tpl_vars['vr']['modifier_type'] == 'P'): ?>selected="selected"<?php endif; ?>>%</option>
				</select>
				<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('display' => $this->_tpl_vars['show_update_for_all'], 'object_id' => $this->_tpl_vars['vr']['variant_id'], 'name' => "update_all_vendors[".($this->_tpl_vars['num'])."]", )); ?><?php if ($this->_tpl_vars['display']): ?>
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
			</td>
			<td class="nowrap">
				<input type="text" name="option_data[variants][<?php echo $this->_tpl_vars['num']; ?>
][weight_modifier]" value="<?php echo $this->_tpl_vars['vr']['weight_modifier']; ?>
" size="5" class="input-text" />&nbsp;/&nbsp;<select name="option_data[variants][<?php echo $this->_tpl_vars['num']; ?>
][weight_modifier_type]">
					<option value="A" <?php if ($this->_tpl_vars['vr']['weight_modifier_type'] == 'A'): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['settings']['General']['weight_symbol']; ?>
</option>
					<option value="P" <?php if ($this->_tpl_vars['vr']['weight_modifier_type'] == 'P'): ?>selected="selected"<?php endif; ?>>%</option>
				</select>
			</td>
			<td class="cm-non-cb<?php if ($this->_tpl_vars['option_data']['option_type'] == 'C'): ?> hidden<?php endif; ?>">
				<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('input_name' => "option_data[variants][".($this->_tpl_vars['num'])."][status]", 'display' => 'select', 'obj' => $this->_tpl_vars['vr'], )); ?><?php if ($this->_tpl_vars['display'] == 'select'): ?>
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
			<td class="nowrap">
				<img src="<?php echo $this->_tpl_vars['images_dir']; ?>
/plus.gif" width="14" height="9" border="0" name="plus_minus" id="on_extra_option_variants_<?php echo $this->_tpl_vars['id']; ?>
_<?php echo $this->_tpl_vars['num']; ?>
" alt="<?php echo fn_get_lang_var('expand_collapse_list', $this->getLanguage()); ?>
" title="<?php echo fn_get_lang_var('expand_collapse_list', $this->getLanguage()); ?>
" class="hand cm-combination-options-<?php echo $this->_tpl_vars['id']; ?>
" /><img src="<?php echo $this->_tpl_vars['images_dir']; ?>
/minus.gif" width="14" height="9" border="0" name="minus_plus" id="off_extra_option_variants_<?php echo $this->_tpl_vars['id']; ?>
_<?php echo $this->_tpl_vars['num']; ?>
" alt="<?php echo fn_get_lang_var('expand_collapse_list', $this->getLanguage()); ?>
" title="<?php echo fn_get_lang_var('expand_collapse_list', $this->getLanguage()); ?>
" class="hand hidden cm-combination-options-<?php echo $this->_tpl_vars['id']; ?>
" /><a id="sw_extra_option_variants_<?php echo $this->_tpl_vars['id']; ?>
_<?php echo $this->_tpl_vars['num']; ?>
" class="cm-combination-options-<?php echo $this->_tpl_vars['id']; ?>
"><?php echo fn_get_lang_var('extra', $this->getLanguage()); ?>
</a>
				<input type="hidden" name="option_data[variants][<?php echo $this->_tpl_vars['num']; ?>
][variant_id]" value="<?php echo $this->_tpl_vars['vr']['variant_id']; ?>
" class="<?php echo $this->_tpl_vars['cm_no_hide_input']; ?>
" />
			 </td>
			 <td class="right cm-non-cb<?php if ($this->_tpl_vars['option_data']['option_type'] == 'C'): ?> hidden<?php endif; ?>">
				<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/multiple_buttons.tpl", 'smarty_include_vars' => array('item_id' => "option_variants_".($this->_tpl_vars['id'])."_".($this->_tpl_vars['num']),'tag_level' => '3','only_delete' => 'Y')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			</td>
		</tr>
		<tr id="extra_option_variants_<?php echo $this->_tpl_vars['id']; ?>
_<?php echo $this->_tpl_vars['num']; ?>
" class="cm-ex-op hidden">
			<td colspan="7">
				<?php $this->_tag_stack[] = array('hook', array('name' => "product_options:edit_product_options")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
				<div class="form-field cm-non-cb<?php if ($this->_tpl_vars['option_data']['option_type'] == 'C'): ?> hidden<?php endif; ?>">
					<label><?php echo fn_get_lang_var('icon', $this->getLanguage()); ?>
:</label>
					<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/attach_images.tpl", 'smarty_include_vars' => array('image_name' => 'variant_image','image_key' => $this->_tpl_vars['num'],'hide_titles' => true,'no_detailed' => true,'image_object_type' => 'variant_image','image_type' => 'V','image_pair' => $this->_tpl_vars['vr']['image_pair'],'prefix' => $this->_tpl_vars['id'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				</div>
				<?php if ($this->_tpl_vars['addons']['reward_points']['status'] == 'A'): ?><?php $__parent_tpl_vars = $this->_tpl_vars; ?><div class="form-field">
	<label for="point_modifier_<?php echo $this->_tpl_vars['id']; ?>
"><?php echo fn_get_lang_var('earned_point_modifier', $this->getLanguage()); ?>
&nbsp;/&nbsp;<?php echo fn_get_lang_var('type', $this->getLanguage()); ?>
:</label>
	<input type="text" id="point_modifier_<?php echo $this->_tpl_vars['id']; ?>
" name="option_data[variants][<?php echo $this->_tpl_vars['num']; ?>
][point_modifier]" value="<?php echo $this->_tpl_vars['vr']['point_modifier']; ?>
" size="5" class="input-text" />&nbsp;/&nbsp;<select name="option_data[variants][<?php echo $this->_tpl_vars['num']; ?>
][point_modifier_type]">
		<option value="A" <?php if ($this->_tpl_vars['vr']['point_modifier_type'] == 'A'): ?>selected="selected"<?php endif; ?>>(<?php echo fn_get_lang_var('points_lower', $this->getLanguage()); ?>
)</option>
		<option value="P" <?php if ($this->_tpl_vars['vr']['point_modifier_type'] == 'P'): ?>selected="selected"<?php endif; ?>>(%)</option>
	</select>
</div><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php endif; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
				
			</td>
		</tr>
		</tbody>
		<?php endforeach; endif; unset($_from); ?>

		<?php echo smarty_function_math(array('equation' => "x + 1",'assign' => 'num','x' => smarty_modifier_default(@$this->_tpl_vars['num'], 0)), $this);?>
<?php $this->assign('vr', "", false); ?>
		<tbody class="hover cm-row-item <?php if ($this->_tpl_vars['option_data']['option_type'] == 'C'): ?>hidden<?php endif; ?>" id="box_add_variant_<?php echo $this->_tpl_vars['id']; ?>
">
		<tr>
			<td class="cm-non-cb<?php if ($this->_tpl_vars['option_data']['option_type'] == 'C'): ?> hidden<?php endif; ?>">
				<input type="text" name="option_data[variants][<?php echo $this->_tpl_vars['num']; ?>
][position]" value="" size="3" class="input-text-short" /></td>
			<td class="cm-non-cb<?php if ($this->_tpl_vars['option_data']['option_type'] == 'C'): ?> hidden<?php endif; ?>">
				<input type="text" name="option_data[variants][<?php echo $this->_tpl_vars['num']; ?>
][variant_name]" value="" class="input-text-medium main-input" /></td>
			<td>
				<input type="text" name="option_data[variants][<?php echo $this->_tpl_vars['num']; ?>
][modifier]" value="" size="5" class="input-text" />&nbsp;/
				<select name="option_data[variants][<?php echo $this->_tpl_vars['num']; ?>
][modifier_type]">
					<option value="A"><?php echo $this->_tpl_vars['currencies'][$this->_tpl_vars['primary_currency']]['symbol']; ?>
</option>
					<option value="P">%</option>
				</select>
			</td>
			<td>
				<input type="text" name="option_data[variants][<?php echo $this->_tpl_vars['num']; ?>
][weight_modifier]" value="" size="5" class="input-text" />&nbsp;/&nbsp;<select name="option_data[variants][<?php echo $this->_tpl_vars['num']; ?>
][weight_modifier_type]">
					<option value="A"><?php echo $this->_tpl_vars['settings']['General']['weight_symbol']; ?>
</option>
					<option value="P">%</option>
				</select>
			</td>
			<td class="cm-non-cb<?php if ($this->_tpl_vars['option_data']['option_type'] == 'C'): ?> hidden<?php endif; ?>">
				<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('input_name' => "option_data[variants][".($this->_tpl_vars['num'])."][status]", 'display' => 'select', )); ?><?php if ($this->_tpl_vars['display'] == 'select'): ?>
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
			<td>
				<img src="<?php echo $this->_tpl_vars['images_dir']; ?>
/plus.gif" width="14" height="9" border="0" name="plus_minus" id="on_extra_option_variants_<?php echo $this->_tpl_vars['id']; ?>
_<?php echo $this->_tpl_vars['num']; ?>
" alt="<?php echo fn_get_lang_var('expand_collapse_list', $this->getLanguage()); ?>
" title="<?php echo fn_get_lang_var('expand_collapse_list', $this->getLanguage()); ?>
" class="hand cm-combination-options-<?php echo $this->_tpl_vars['id']; ?>
" /><img src="<?php echo $this->_tpl_vars['images_dir']; ?>
/minus.gif" width="14" height="9" border="0" name="minus_plus" id="off_extra_option_variants_<?php echo $this->_tpl_vars['id']; ?>
_<?php echo $this->_tpl_vars['num']; ?>
" alt="<?php echo fn_get_lang_var('expand_collapse_list', $this->getLanguage()); ?>
" title="<?php echo fn_get_lang_var('expand_collapse_list', $this->getLanguage()); ?>
" class="hand hidden cm-combination-options-<?php echo $this->_tpl_vars['id']; ?>
" /><a id="sw_extra_option_variants_<?php echo $this->_tpl_vars['id']; ?>
_<?php echo $this->_tpl_vars['num']; ?>
" class="cm-combination-options-<?php echo $this->_tpl_vars['id']; ?>
"><?php echo fn_get_lang_var('extra', $this->getLanguage()); ?>
</a>
			</td>
			<td class="right cm-non-cb<?php if ($this->_tpl_vars['option_data']['option_type'] == 'C'): ?> hidden<?php endif; ?>">
				<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/multiple_buttons.tpl", 'smarty_include_vars' => array('item_id' => "add_variant_".($this->_tpl_vars['id']),'tag_level' => '2')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			</td>
		</tr>
		<tr id="extra_option_variants_<?php echo $this->_tpl_vars['id']; ?>
_<?php echo $this->_tpl_vars['num']; ?>
" class="cm-ex-op hidden">
			<td colspan="7">
				<?php $this->_tag_stack[] = array('hook', array('name' => "product_options:edit_product_options")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
				<div class="form-field cm-non-cb">
					<label><?php echo fn_get_lang_var('icon', $this->getLanguage()); ?>
:</label>
					<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/attach_images.tpl", 'smarty_include_vars' => array('image_name' => 'variant_image','image_key' => $this->_tpl_vars['num'],'hide_titles' => true,'no_detailed' => true,'image_object_type' => 'variant_image','image_type' => 'V','prefix' => $this->_tpl_vars['id'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				</div>
				<?php if ($this->_tpl_vars['addons']['reward_points']['status'] == 'A'): ?><?php $__parent_tpl_vars = $this->_tpl_vars; ?><div class="form-field">
	<label for="point_modifier_<?php echo $this->_tpl_vars['id']; ?>
"><?php echo fn_get_lang_var('earned_point_modifier', $this->getLanguage()); ?>
&nbsp;/&nbsp;<?php echo fn_get_lang_var('type', $this->getLanguage()); ?>
:</label>
	<input type="text" id="point_modifier_<?php echo $this->_tpl_vars['id']; ?>
" name="option_data[variants][<?php echo $this->_tpl_vars['num']; ?>
][point_modifier]" value="<?php echo $this->_tpl_vars['vr']['point_modifier']; ?>
" size="5" class="input-text" />&nbsp;/&nbsp;<select name="option_data[variants][<?php echo $this->_tpl_vars['num']; ?>
][point_modifier_type]">
		<option value="A" <?php if ($this->_tpl_vars['vr']['point_modifier_type'] == 'A'): ?>selected="selected"<?php endif; ?>>(<?php echo fn_get_lang_var('points_lower', $this->getLanguage()); ?>
)</option>
		<option value="P" <?php if ($this->_tpl_vars['vr']['point_modifier_type'] == 'P'): ?>selected="selected"<?php endif; ?>>(%)</option>
	</select>
</div><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php endif; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
			</td>
		</tr>
		</tbody>
		</table>
	</fieldset>
	<!--content_tab_option_variants_<?php echo $this->_tpl_vars['id']; ?>
--></div>
</div>

<div class="buttons-container">
	<?php if (! $this->_tpl_vars['id']): ?>
		<?php $this->assign('_but_text', fn_get_lang_var('create', $this->getLanguage()), false); ?>
	<?php else: ?>
		
		<?php if (defined('COMPANY_ID') && $this->_tpl_vars['option_data']['option_id'] && $this->_tpl_vars['option_data']['company_id'] != @COMPANY_ID && $this->_tpl_vars['shared_product'] != 'Y'): ?>
			<?php $this->assign('hide_first_button', true, false); ?>
		<?php endif; ?>
		
		<?php $this->assign('_but_text', "", false); ?>
	<?php endif; ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/save_cancel.tpl", 'smarty_include_vars' => array('but_text' => $this->_tpl_vars['_but_text'],'but_name' => "dispatch[product_options.update]",'cancel_action' => 'close','extra' => "",'hide_first_button' => $this->_tpl_vars['hide_first_button'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>

</form>

<!--content_group_product_option_<?php echo $this->_tpl_vars['id']; ?>
--></div>