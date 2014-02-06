<?php /* Smarty version 2.6.18, created on 2014-02-05 11:04:19
         compiled from views/block_manager/update_location.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'fn_url', 'views/block_manager/update_location.tpl', 21, false),array('modifier', 'escape', 'views/block_manager/update_location.tpl', 58, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('general','dispatch','custom','name','page_title','ttc_page_title','meta_description','meta_keywords','default','tt_views_block_manager_update_location_default'));
?>
<?php 

				$rname = !empty($resource_name) ? $resource_name : $params['smarty_include_tpl_file'];
				if ($this->compile_check && empty($inline_no_check[$rname]) && $this->is_cached($rname)) {
					if ($this->check_inline_blocks(array (
  'common_templates/tooltip.tpl' => 1367063753,
))) {
						$_smarty_compile_path = $this->_get_compile_path($rname);
						$this->_compile_resource($rname, $_smarty_compile_path);
						$inline_no_check[$rname] = true;
						include $_smarty_compile_path;
						return;
					}
				}
			 ?><?php if (! $this->_tpl_vars['location']['location_id']): ?>
	<?php $this->assign('html_id', '0', false); ?>
<?php else: ?>
	<?php $this->assign('html_id', $this->_tpl_vars['location']['location_id'], false); ?>
<?php endif; ?>

<form action="<?php echo fn_url(""); ?>
" method="post" class="cm-form-highlight" name="location_<?php echo $this->_tpl_vars['html_id']; ?>
_update_form">
<div id="location_properties_<?php echo $this->_tpl_vars['html_id']; ?>
">
	<input type="hidden" name="result_ids" value="location_properties_<?php echo $this->_tpl_vars['html_id']; ?>
" class="cm-no-hide-input"/>
	<input type="hidden" name="location" value="<?php echo $this->_tpl_vars['location']['location_id']; ?>
" />
	<input type="hidden" name="location_data[location_id]" value="<?php echo $this->_tpl_vars['location']['location_id']; ?>
" />

	<div class="tabs cm-j-tabs">
		<ul>
			<li id="location_general_<?php echo $this->_tpl_vars['html_id']; ?>
" class="cm-js cm-active"><a><?php echo fn_get_lang_var('general', $this->getLanguage()); ?>
</a></li>
			<?php if ($this->_tpl_vars['dynamic_object_scheme']): ?>
				<li id="location_object_<?php echo $this->_tpl_vars['dynamic_object_scheme']['object_type']; ?>
" class="cm-js"><a><?php echo fn_get_lang_var($this->_tpl_vars['dynamic_object_scheme']['object_type'], $this->getLanguage()); ?>
</a></li>
			<?php endif; ?>
		</ul>
	</div>

	<div class="cm-tabs-content" id="tabs_content_location_<?php echo $this->_tpl_vars['html_id']; ?>
">
		<div id="content_location_general_<?php echo $this->_tpl_vars['html_id']; ?>
">
			<fieldset>
				<div class="form-field">
					<label for="location_dispatch_<?php echo $this->_tpl_vars['html_id']; ?>
" class="cm-required"><?php echo fn_get_lang_var('dispatch', $this->getLanguage()); ?>
: </label>
					<select id="location_dispatch_<?php echo $this->_tpl_vars['html_id']; ?>
_select" name="location_data[dispatch]" class="cm-select-with-input-key cm-reload-form">
						<?php $_from = $this->_tpl_vars['dispatch_descriptions']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
							<option value="<?php echo $this->_tpl_vars['k']; ?>
" <?php if ($this->_tpl_vars['location']['dispatch'] == $this->_tpl_vars['k']): ?>selected="selected"<?php $this->assign('selected', 1, false); ?><?php endif; ?>><?php echo $this->_tpl_vars['v']; ?>
</option>
							<?php if ($this->_tpl_vars['location']['dispatch'] == $this->_tpl_vars['k']): ?>
								<?php $this->assign('not_custom_dispatch', '1', false); ?>
							<?php endif; ?>
						<?php endforeach; endif; unset($_from); ?>
						<option value="" <?php if (! $this->_tpl_vars['selected']): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('custom', $this->getLanguage()); ?>
</option>
					</select>
					<input id="location_dispatch_<?php echo $this->_tpl_vars['html_id']; ?>
" class="input-text<?php if ($this->_tpl_vars['not_custom_dispatch']): ?> input-text-disabled<?php endif; ?>" <?php if ($this->_tpl_vars['not_custom_dispatch']): ?>disabled<?php endif; ?> name="location_data[dispatch]" value="<?php echo $this->_tpl_vars['location']['dispatch']; ?>
" />
				</div>
				<div class="form-field">
					<label for="location_name" class="cm-required"><?php echo fn_get_lang_var('name', $this->getLanguage()); ?>
: </label>
					<input id="location_name" class="input-text" name="location_data[name]" value="<?php echo $this->_tpl_vars['location']['name']; ?>
" />
				</div>

				<div class="form-field">
					<label for="location_title"><?php echo fn_get_lang_var('page_title', $this->getLanguage()); ?>
<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('tooltip' => fn_get_lang_var('ttc_page_title', $this->getLanguage()), )); ?><?php if ($this->_tpl_vars['tooltip']): ?> (<a class="cm-tooltip<?php if ($this->_tpl_vars['params']): ?> <?php echo $this->_tpl_vars['params']; ?>
<?php endif; ?>" title="<?php echo smarty_modifier_escape($this->_tpl_vars['tooltip'], 'html'); ?>
">?</a>)<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>: </label>
					<input id="location_title" class="input-text" name="location_data[title]" value="<?php echo $this->_tpl_vars['location']['title']; ?>
" />
				</div>

				<div class="form-field">
					<label for="location_meta_descr"><?php echo fn_get_lang_var('meta_description', $this->getLanguage()); ?>
: </label>
					<textarea id="location_meta_descr" name="location_data[meta_description]" cols="55" rows="8" class="input-textarea-long"><?php echo $this->_tpl_vars['location']['meta_description']; ?>
</textarea>
				</div>

				<div class="form-field">
					<label for="location_meta_key"><?php echo fn_get_lang_var('meta_keywords', $this->getLanguage()); ?>
: </label>
					<textarea id="location_meta_key" name="location_data[meta_keywords]" cols="55" rows="8" class="input-textarea-long"><?php echo $this->_tpl_vars['location']['meta_keywords']; ?>
</textarea>
				</div>

				<div class="form-field">
					<label for="location_is_default"><?php echo fn_get_lang_var('default', $this->getLanguage()); ?>
<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('tooltip' => fn_get_lang_var('tt_views_block_manager_update_location_default', $this->getLanguage()), )); ?><?php if ($this->_tpl_vars['tooltip']): ?> (<a class="cm-tooltip<?php if ($this->_tpl_vars['params']): ?> <?php echo $this->_tpl_vars['params']; ?>
<?php endif; ?>" title="<?php echo smarty_modifier_escape($this->_tpl_vars['tooltip'], 'html'); ?>
">?</a>)<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>: </label>
					<input type="hidden" name="location_data[is_default]" value="N" />
					<input type="checkbox" class="checkbox" name="location_data[is_default]" value="Y" id="location_is_default" <?php if ($this->_tpl_vars['location']['is_default']): ?>checked="checked" disabled="disabled"<?php endif; ?> />
				</div>

			</fieldset>
		</div>
		<?php if ($this->_tpl_vars['dynamic_object_scheme']): ?>
			<div id="content_location_object_<?php echo $this->_tpl_vars['dynamic_object_scheme']['object_type']; ?>
">
				<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => $this->_tpl_vars['dynamic_object_scheme']['picker'], 'smarty_include_vars' => array('data_id' => "location_".($this->_tpl_vars['html_id'])."_object_ids",'input_name' => "location_data[object_ids]",'item_ids' => $this->_tpl_vars['location']['object_ids'],'view_mode' => 'links','params_array' => $this->_tpl_vars['dynamic_object_scheme']['picker_params'],'start_pos' => $this->_tpl_vars['start_position'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			</div>
		<?php endif; ?>
	</div>
<!--location_properties_<?php echo $this->_tpl_vars['html_id']; ?>
--></div>
<div class="buttons-container">
		<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/save_cancel.tpl", 'smarty_include_vars' => array('but_name' => "dispatch[block_manager.update_location]",'cancel_action' => 'close')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</div>
	<?php if (! $this->_tpl_vars['location']['is_default'] && $this->_tpl_vars['location']['location_id'] > 0): ?>
		<div class="botton-picker-remove">
			<a class="cm-confirm" href="<?php echo fn_url("block_manager.delete_location?location_id=".($this->_tpl_vars['location']['location_id'])); ?>
" title="Remove current location"></a>
		</div>
	<?php endif; ?>
</form>