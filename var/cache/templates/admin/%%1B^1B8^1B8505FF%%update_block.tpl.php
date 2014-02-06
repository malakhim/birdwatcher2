<?php /* Smarty version 2.6.18, created on 2014-02-03 15:23:22
         compiled from views/block_manager/update_block.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'views/block_manager/update_block.tpl', 15, false),array('modifier', 'fn_url', 'views/block_manager/update_block.tpl', 42, false),array('modifier', 'is_array', 'views/block_manager/update_block.tpl', 91, false),array('modifier', 'str_replace', 'views/block_manager/update_block.tpl', 146, false),array('modifier', 'escape', 'views/block_manager/update_block.tpl', 172, false),array('function', 'script', 'views/block_manager/update_block.tpl', 30, false),array('block', 'hook', 'views/block_manager/update_block.tpl', 132, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('general','content','block_settings','status','name','template','settings','wrapper','user_class','dynamic_content','override_by_this','tt_views_block_manager_update_block_override_by_this','content_changed_for','global_status','active','disabled','disable_for','enable_for'));
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
			 ?><?php $this->assign('id', smarty_modifier_default(@$this->_tpl_vars['block']['block_id'], '0'), false); ?>
<?php $this->assign('snapping_id', smarty_modifier_default(@$this->_tpl_vars['snapping_data']['snapping_id'], '0'), false); ?>
<?php $this->assign('html_id', ($this->_tpl_vars['id'])."_".($this->_tpl_vars['snapping_id'])."_".($this->_tpl_vars['block']['type']), false); ?>

<?php if ($this->_tpl_vars['id'] == 0): ?>
	<?php $this->assign('add_block', true, false); ?>
	<?php $this->assign('hide_status', true, false); ?>
<?php endif; ?>

<?php if ($this->_tpl_vars['_REQUEST']['active_tab']): ?>
	<?php $this->assign('active_tab', $this->_tpl_vars['_REQUEST']['active_tab'], false); ?>
<?php else: ?>
	<?php $this->assign('active_tab', 'block_general', false); ?>
<?php endif; ?>

<?php echo smarty_function_script(array('src' => "js/tabs.js"), $this);?>


<?php if ($this->_tpl_vars['_REQUEST']['dynamic_object']['object_id'] > 0): ?>
	<?php $this->assign('dynamic_object', $this->_tpl_vars['_REQUEST']['dynamic_object'], false); ?>
<?php endif; ?>

<?php ob_start(); ?><?php echo ''; ?><?php if ($this->_tpl_vars['block_scheme']['content']): ?><?php echo ''; ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/block_manager/components/block_content.tpl", 'smarty_include_vars' => array('content_type' => $this->_tpl_vars['block']['properties']['content_type'],'block_scheme' => $this->_tpl_vars['block_scheme'],'block' => $this->_tpl_vars['block'],'editable' => $this->_tpl_vars['editable_content'],'tab_id' => ($this->_tpl_vars['html_id']))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?>
<?php $this->_smarty_vars['capture']['block_content'] = ob_get_contents(); ob_end_clean(); ?>

<form action="<?php echo fn_url(""); ?>
" method="post" class="cm-skip-check-items <?php if ($this->_tpl_vars['dynamic_object']): ?>cm-hide-inputs<?php endif; ?> cm-form-highlight <?php if ($this->_tpl_vars['_REQUEST']['ajax_update']): ?>cm-ajax<?php endif; ?>" name="block_<?php echo $this->_tpl_vars['id']; ?>
_update_form">
<div id="block_properties_<?php echo $this->_tpl_vars['html_id']; ?>
">
	<?php if ($this->_tpl_vars['_REQUEST']['dynamic_object']['object_id'] > 0): ?>
		<input type="hidden" name="dynamic_object[object_id]" value="<?php echo $this->_tpl_vars['_REQUEST']['dynamic_object']['object_id']; ?>
" class="cm-no-hide-input"/>	
		<input type="hidden" name="dynamic_object[object_type]" value="<?php echo $this->_tpl_vars['_REQUEST']['dynamic_object']['object_type']; ?>
" class="cm-no-hide-input"/>	
	<?php endif; ?>
	<input type="hidden" name="block_data[type]" value="<?php echo $this->_tpl_vars['block']['type']; ?>
" class="cm-no-hide-input"/>
	<input type="hidden" name="block_data[block_id]" value="<?php echo $this->_tpl_vars['id']; ?>
" class="cm-no-hide-input"/>
	<input type="hidden" name="block_data[content_data][snapping_id]" value="<?php echo $this->_tpl_vars['snapping_data']['snapping_id']; ?>
" class="cm-no-hide-input"/>	
	<input type="hidden" name="snapping_data[snapping_id]" value="<?php echo $this->_tpl_vars['snapping_data']['snapping_id']; ?>
" class="cm-no-hide-input"/>
	<input type="hidden" name="snapping_data[grid_id]" value="<?php echo $this->_tpl_vars['snapping_data']['grid_id']; ?>
" class="cm-no-hide-input"/>
	<input type="hidden" name="selected_location" value="<?php echo smarty_modifier_default(@$this->_tpl_vars['_REQUEST']['selected_location'], 0); ?>
" class="cm-no-hide-input" />
	<?php if ($this->_tpl_vars['_REQUEST']['assign_to']): ?>
		<input type="hidden" name="assign_to" value="<?php echo $this->_tpl_vars['_REQUEST']['assign_to']; ?>
" class="cm-no-hide-input"/>
	<?php endif; ?>
	<input type="hidden" name="result_ids" value="block_properties_<?php echo $this->_tpl_vars['html_id']; ?>
" class="cm-no-hide-input"/>

	
		<?php if ($this->_tpl_vars['_REQUEST']['r_url']): ?>
		<input type="hidden" name="r_url" value="<?php echo $this->_tpl_vars['_REQUEST']['r_url']; ?>
" class="cm-no-hide-input"/>
	<?php endif; ?>
	<div class="tabs cm-j-tabs cm-track">
		<ul>
			<li id="block_general_<?php echo $this->_tpl_vars['html_id']; ?>
" class="cm-js<?php if ($this->_tpl_vars['active_tab'] == "block_general_".($this->_tpl_vars['html_id'])): ?> cm-active<?php endif; ?>"><a><?php echo fn_get_lang_var('general', $this->getLanguage()); ?>
</a></li>
			<?php if ($this->_smarty_vars['capture']['block_content']): ?><li id="block_contents_<?php echo $this->_tpl_vars['html_id']; ?>
" class="cm-js<?php if ($this->_tpl_vars['active_tab'] == "block_contents_".($this->_tpl_vars['html_id'])): ?> cm-active<?php endif; ?>"><a><?php echo fn_get_lang_var('content', $this->getLanguage()); ?>
</a></li><?php endif; ?>
			<?php if ($this->_tpl_vars['block_scheme']['settings']): ?>
				<li id="block_settings_<?php echo $this->_tpl_vars['html_id']; ?>
" class="cm-js<?php if ($this->_tpl_vars['active_tab'] == "block_settings_".($this->_tpl_vars['html_id'])): ?> cm-active<?php endif; ?>"><a><?php echo fn_get_lang_var('block_settings', $this->getLanguage()); ?>
</a></li>
			<?php endif; ?>
			<?php if ($this->_tpl_vars['dynamic_object_scheme'] && ! $this->_tpl_vars['hide_status']): ?>
				<li id="block_status_<?php echo $this->_tpl_vars['html_id']; ?>
" class="cm-js<?php if ($this->_tpl_vars['active_tab'] == "block_status_".($this->_tpl_vars['html_id'])): ?> cm-active<?php endif; ?>"><a><?php echo fn_get_lang_var('status', $this->getLanguage()); ?>
</a></li>
			<?php endif; ?>
		</ul>
	</div>

	<div class="cm-tabs-content" id="tabs_content_block_<?php echo $this->_tpl_vars['html_id']; ?>
">
		<div id="content_block_general_<?php echo $this->_tpl_vars['html_id']; ?>
">
			<fieldset>
				<div class="form-field <?php if ($this->_tpl_vars['editable_template_name']): ?>cm-no-hide-input<?php endif; ?>">
					<label for="block_<?php echo $this->_tpl_vars['html_id']; ?>
_name" class="cm-required"><?php echo fn_get_lang_var('name', $this->getLanguage()); ?>
:</label>
					<?php if ($this->_tpl_vars['_REQUEST']['html_id'] && $this->_tpl_vars['id'] > 0): ?>
						<?php echo $this->_tpl_vars['block']['name']; ?>

					<?php else: ?>
						<input type="text" name="block_data[description][name]" id="block_<?php echo $this->_tpl_vars['html_id']; ?>
_name" size="25" value="<?php echo $this->_tpl_vars['block']['name']; ?>
" class="input-text main-input" />
					<?php endif; ?>
				</div>
				<?php if ($this->_tpl_vars['block_scheme']['templates']): ?>
					<div class="form-field <?php if ($this->_tpl_vars['editable_template_name']): ?>cm-no-hide-input<?php endif; ?>">
						<label for="block_<?php echo $this->_tpl_vars['html_id']; ?>
_template"><?php echo fn_get_lang_var('template', $this->getLanguage()); ?>
:</label>
						<?php if (is_array($this->_tpl_vars['block_scheme']['templates'])): ?>
							<select id="block_<?php echo $this->_tpl_vars['html_id']; ?>
_template" name="block_data[properties][template]"  class="cm-reload-form">
								<?php $_from = $this->_tpl_vars['block_scheme']['templates']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
									<option value="<?php echo $this->_tpl_vars['k']; ?>
" <?php if ($this->_tpl_vars['block']['properties']['template'] == $this->_tpl_vars['k']): ?>selected="selected"<?php endif; ?>><?php if ($this->_tpl_vars['v']['name']): ?><?php echo $this->_tpl_vars['v']['name']; ?>
<?php else: ?><?php echo $this->_tpl_vars['k']; ?>
<?php endif; ?></option>
								<?php endforeach; endif; unset($_from); ?>
							</select>
						<?php endif; ?>
						<?php if ($this->_tpl_vars['dynamic_object']): ?>
							<input type="hidden" name="block_data[properties][template]" value="<?php echo $this->_tpl_vars['block']['properties']['template']; ?>
" class="cm-no-hide-input" />
						<?php endif; ?>
						<?php if (is_array($this->_tpl_vars['block_scheme']['templates'][$this->_tpl_vars['block']['properties']['template']]['settings'])): ?>
							<a href="#" id="sw_case_settings_<?php echo $this->_tpl_vars['html_id']; ?>
" class="cm-combo-off cm-combination" onclick="return false">
								<?php echo fn_get_lang_var('settings', $this->getLanguage()); ?>

								<span class="combo-arrow"></span>
							</a>
						<?php endif; ?>
					</div>
				<?php endif; ?>
				
				<?php if (is_array($this->_tpl_vars['block_scheme']['templates'][$this->_tpl_vars['block']['properties']['template']]['settings'])): ?>		
					<div id="case_settings_<?php echo $this->_tpl_vars['html_id']; ?>
" class="hidden">
					<?php $_from = $this->_tpl_vars['block_scheme']['templates'][$this->_tpl_vars['block']['properties']['template']]['settings']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['name'] => $this->_tpl_vars['setting_data']):
?>
						<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/block_manager/components/setting_element.tpl", 'smarty_include_vars' => array('option' => $this->_tpl_vars['setting_data'],'name' => ($this->_tpl_vars['name']),'block' => $this->_tpl_vars['block'],'html_id' => "block_".($this->_tpl_vars['html_id'])."_properties_".($this->_tpl_vars['name']),'html_name' => "block_data[properties][".($this->_tpl_vars['name'])."]",'editable' => $this->_tpl_vars['editable_template_name'],'value' => $this->_tpl_vars['block']['properties'][$this->_tpl_vars['name']])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					<?php endforeach; endif; unset($_from); ?>
					</div>
				<?php endif; ?>
				<?php if ($this->_tpl_vars['editable_wrapper']): ?>
					<div class="form-field">
						<label for="block_<?php echo $this->_tpl_vars['html_id']; ?>
_wrapper"><?php echo fn_get_lang_var('wrapper', $this->getLanguage()); ?>
:</label>
						<select name="snapping_data[wrapper]" id="block_<?php echo $this->_tpl_vars['html_id']; ?>
_wrapper">
							<option value="">--</option>
							<?php $_from = $this->_tpl_vars['block_scheme']['wrappers']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['w']):
?>							
								<option value="<?php echo $this->_tpl_vars['k']; ?>
" <?php if ($this->_tpl_vars['block']['wrapper'] == $this->_tpl_vars['k']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['w']['name']; ?>
</option>
							<?php endforeach; endif; unset($_from); ?>
						</select>
					</div>
					<div class="form-field">
						<label for="block_<?php echo $this->_tpl_vars['html_id']; ?>
_user_class"><?php echo fn_get_lang_var('user_class', $this->getLanguage()); ?>
:</label>
						<input type="text" name="snapping_data[user_class]" id="block_<?php echo $this->_tpl_vars['html_id']; ?>
_user_class" size="25" value="<?php echo $this->_tpl_vars['block']['user_class']; ?>
" class="input-text main-input" />
					</div>
				<?php endif; ?>			
				<?php $this->_tag_stack[] = array('hook', array('name' => "block_manager:settings")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
				<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
			</fieldset>
		</div>
		<?php if ($this->_smarty_vars['capture']['block_content']): ?>
			<div id="content_block_contents_<?php echo $this->_tpl_vars['html_id']; ?>
" >
				<fieldset>
				<?php if ($this->_tpl_vars['dynamic_object']['object_id'] > 0): ?>
					<input type="hidden" name="block_data[content_data][object_id]" value="<?php echo $this->_tpl_vars['dynamic_object']['object_id']; ?>
" class="cm-no-hide-input" />
					<input type="hidden" name="block_data[content_data][object_type]" value="<?php echo $this->_tpl_vars['dynamic_object']['object_type']; ?>
" class="cm-no-hide-input" />
				<?php endif; ?>
				<?php if ($this->_tpl_vars['block']['object_id'] > 0): ?>
					<div class="text-tip">				
						<?php $this->assign('url', fn_url(($this->_tpl_vars['dynamic_object_scheme']['customer_dispatch'])."&".($this->_tpl_vars['dynamic_object_scheme']['key'])."=".($this->_tpl_vars['dynamic_object']['object_id']), 'C', 'http', '&', @DESCR_SL), false); ?>
						<?php echo str_replace('[url]', $this->_tpl_vars['url'], fn_get_lang_var('dynamic_content', $this->getLanguage())); ?>

					</div>
				<?php endif; ?>

				<?php echo $this->_smarty_vars['capture']['block_content']; ?>


				<?php ob_start(); ?><?php echo ''; ?><?php $_from = $this->_tpl_vars['changed_content_stat']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['stat']):
?><?php echo ''; ?><?php if ($this->_tpl_vars['stat']['object_type'] != ''): ?><?php echo '<div>'; ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/popupbox.tpl", 'smarty_include_vars' => array('id' => "show_objects_".($this->_tpl_vars['block']['block_id'])."_".($this->_tpl_vars['stat']['object_type']),'text' => fn_get_lang_var($this->_tpl_vars['stat']['object_type'], $this->getLanguage()),'link_text' => ($this->_tpl_vars['stat']['contents_count']),'act' => 'link','href' => "block_manager.show_objects?object_type=".($this->_tpl_vars['stat']['object_type'])."&block_id=".($this->_tpl_vars['block']['block_id']),'opener_ajax_class' => "cm-ajax",'link_class' => "cm-ajax-force",'content' => "")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php echo ' '; ?><?php echo $this->_tpl_vars['stat']['object_type']; ?><?php echo '</div>'; ?><?php endif; ?><?php echo ''; ?><?php endforeach; endif; unset($_from); ?><?php echo ''; ?>
<?php $this->_smarty_vars['capture']['content_stat'] = ob_get_contents(); ob_end_clean(); ?>

				<?php if ($this->_smarty_vars['capture']['content_stat']): ?>
				<div class="form-field">
					<label for="block_<?php echo $this->_tpl_vars['html_id']; ?>
_override_by_this"><?php echo fn_get_lang_var('override_by_this', $this->getLanguage()); ?>
<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('tooltip' => fn_get_lang_var('tt_views_block_manager_update_block_override_by_this', $this->getLanguage()), )); ?><?php if ($this->_tpl_vars['tooltip']): ?> (<a class="cm-tooltip<?php if ($this->_tpl_vars['params']): ?> <?php echo $this->_tpl_vars['params']; ?>
<?php endif; ?>" title="<?php echo smarty_modifier_escape($this->_tpl_vars['tooltip'], 'html'); ?>
">?</a>)<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>:</label>
					<input type="hidden" class="cm-no-hide-input" name="block_data[content_data][override_by_this]" value="N" />
					<input id="block_<?php echo $this->_tpl_vars['html_id']; ?>
_override_by_this" type="checkbox" class="checkbox cm-no-hide-input" name="block_data[content_data][override_by_this]" value="Y" />
				</div>
				<div class="statistics-box">
					<div class="statistics-body">
						<p class="strong"><?php echo fn_get_lang_var('content_changed_for', $this->getLanguage()); ?>
:</p>
						<?php echo $this->_smarty_vars['capture']['content_stat']; ?>

					</div>
				</div>
				<?php endif; ?>
				</fieldset>
			</div>
		<?php endif; ?>
		<?php if ($this->_tpl_vars['block_scheme']['settings']): ?>
			<div id="content_block_settings_<?php echo $this->_tpl_vars['html_id']; ?>
" >
				<fieldset>
					<?php $_from = $this->_tpl_vars['block_scheme']['settings']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['name'] => $this->_tpl_vars['setting_data']):
?>
						<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/block_manager/components/setting_element.tpl", 'smarty_include_vars' => array('option' => $this->_tpl_vars['setting_data'],'name' => ($this->_tpl_vars['name']),'block' => $this->_tpl_vars['block'],'html_id' => "block_".($this->_tpl_vars['html_id'])."_properties_".($this->_tpl_vars['name']),'html_name' => "block_data[properties][".($this->_tpl_vars['name'])."]",'editable' => $this->_tpl_vars['editable_template_name'],'value' => $this->_tpl_vars['block']['properties'][$this->_tpl_vars['name']])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					<?php endforeach; endif; unset($_from); ?>
				</fieldset>
			</div>
		<?php endif; ?>
		<?php if ($this->_tpl_vars['dynamic_object_scheme'] && ! $this->_tpl_vars['hide_status']): ?>
		<div id="content_block_status_<?php echo $this->_tpl_vars['html_id']; ?>
" >
			<fieldset>
				<div class="form-field">
					<label><?php echo fn_get_lang_var('global_status', $this->getLanguage()); ?>
:</label>
					<div class="select-field">
						<?php if ($this->_tpl_vars['block']['status'] == 'A'): ?><?php echo fn_get_lang_var('active', $this->getLanguage()); ?>
<?php else: ?><?php echo fn_get_lang_var('disabled', $this->getLanguage()); ?>
<?php endif; ?>
					</div>
				</div>
				<input type="hidden" class="cm-no-hide-input" name="snapping_data[object_type]" value="<?php echo $this->_tpl_vars['dynamic_object_scheme']['object_type']; ?>
" />
				<div class="form-field cm-no-hide-input">						
					<label><?php if ($this->_tpl_vars['block']['status'] == 'A'): ?><?php echo fn_get_lang_var('disable_for', $this->getLanguage()); ?>
<?php else: ?><?php echo fn_get_lang_var('enable_for', $this->getLanguage()); ?>
<?php endif; ?>:</label>
					<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => $this->_tpl_vars['dynamic_object_scheme']['picker'], 'smarty_include_vars' => array('data_id' => "block_".($this->_tpl_vars['html_id'])."_object_ids_d",'input_name' => "snapping_data[object_ids]",'item_ids' => $this->_tpl_vars['block']['object_ids'],'view_mode' => 'links','params_array' => $this->_tpl_vars['dynamic_object_scheme']['picker_params'],'start_pos' => $this->_tpl_vars['start_position'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				</div>
			</fieldset>
		</div>
		<?php endif; ?>
	</div>
	<!--block_properties_<?php echo $this->_tpl_vars['html_id']; ?>
--></div>
	<div class="buttons-container">
		<?php if ($this->_tpl_vars['add_block']): ?>
			<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/save_cancel.tpl", 'smarty_include_vars' => array('create' => true,'but_name' => "dispatch[block_manager.update_block]",'cancel_action' => 'close')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<?php elseif ($this->_tpl_vars['_REQUEST']['force_close']): ?>
			<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/save_cancel.tpl", 'smarty_include_vars' => array('but_name' => "dispatch[block_manager.update_block]",'cancel_action' => 'close','but_meta' => "cm-submit-closer")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<?php else: ?>
			<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/save_cancel.tpl", 'smarty_include_vars' => array('but_name' => "dispatch[block_manager.update_block]",'cancel_action' => 'close')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<?php endif; ?>
	</div>
</form>