<?php /* Smarty version 2.6.18, created on 2014-03-07 22:38:38
         compiled from pickers/categories_picker.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'fn_url', 'pickers/categories_picker.tpl', 1, false),array('modifier', 'default', 'pickers/categories_picker.tpl', 15, false),array('modifier', 'is_array', 'pickers/categories_picker.tpl', 27, false),array('modifier', 'explode', 'pickers/categories_picker.tpl', 28, false),array('modifier', 'escape', 'pickers/categories_picker.tpl', 45, false),array('modifier', 'defined', 'pickers/categories_picker.tpl', 48, false),array('modifier', 'fn_check_view_permissions', 'pickers/categories_picker.tpl', 82, false),array('modifier', 'implode', 'pickers/categories_picker.tpl', 198, false),array('function', 'math', 'pickers/categories_picker.tpl', 16, false),array('function', 'script', 'pickers/categories_picker.tpl', 21, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('add_categories','choose','choose','remove_this_item','remove_this_item','add_categories','add_categories','add_categories','remove_this_item','remove_this_item','add_categories','position_short','name','no_items'));
?>
<?php 

				$rname = !empty($resource_name) ? $resource_name : $params['smarty_include_tpl_file'];
				if ($this->compile_check && empty($inline_no_check[$rname]) && $this->is_cached($rname)) {
					if ($this->check_inline_blocks(array (
  'buttons/button.tpl' => 1367063752,
))) {
						$_smarty_compile_path = $this->_get_compile_path($rname);
						$this->_compile_resource($rname, $_smarty_compile_path);
						$inline_no_check[$rname] = true;
						include $_smarty_compile_path;
						return;
					}
				}
			 ?><?php $this->assign('data_id', smarty_modifier_default(@$this->_tpl_vars['data_id'], 'categories_list'), false); ?>
<?php if (! $this->_tpl_vars['rnd']): ?><?php echo smarty_function_math(array('equation' => "rand()",'assign' => 'rnd'), $this);?>
<?php endif; ?>
<?php $this->assign('data_id', ($this->_tpl_vars['data_id'])."_".($this->_tpl_vars['rnd']), false); ?>
<?php $this->assign('view_mode', smarty_modifier_default(@$this->_tpl_vars['view_mode'], 'mixed'), false); ?>
<?php $this->assign('start_pos', smarty_modifier_default(@$this->_tpl_vars['start_pos'], 0), false); ?>

<?php echo smarty_function_script(array('src' => "js/picker.js"), $this);?>


<?php if ($this->_tpl_vars['item_ids'] == ""): ?>
	<?php $this->assign('item_ids', null, false); ?>
<?php endif; ?>

<?php if ($this->_tpl_vars['item_ids'] && ! is_array($this->_tpl_vars['item_ids'])): ?>
	<?php $this->assign('item_ids', explode(",", $this->_tpl_vars['item_ids']), false); ?>
<?php endif; ?>

<?php if ($this->_tpl_vars['view_mode'] != 'blocks'): ?>
<?php ob_start(); ?>
	<?php if ($this->_tpl_vars['view_mode'] != 'list'): ?>
		<?php if ($this->_tpl_vars['multiple'] == true): ?>
			<?php $this->assign('display', 'checkbox', false); ?>
		<?php else: ?>
			<?php $this->assign('display', 'radio', false); ?>
		<?php endif; ?>

		<?php if (! $this->_tpl_vars['extra_url']): ?>
			<?php $this->assign('extra_url', "&amp;get_tree=multi_level", false); ?>
		<?php endif; ?>

		<?php if ($this->_tpl_vars['extra_var']): ?>
			<?php $this->assign('extra_var', smarty_modifier_escape($this->_tpl_vars['extra_var'], 'url'), false); ?>
		<?php endif; ?>

		<?php if (! defined('COMPANY_ID') || @CONTROLLER != 'companies'): ?>
		<?php if (! $this->_tpl_vars['no_container']): ?><div class="<?php if (! $this->_tpl_vars['multiple']): ?>choose-icon<?php else: ?>buttons-container<?php endif; ?>"><?php endif; ?>
			<?php if ($this->_tpl_vars['multiple']): ?>
				<?php $this->assign('_but_text', smarty_modifier_default(@$this->_tpl_vars['but_text'], fn_get_lang_var('add_categories', $this->getLanguage())), false); ?>
				<?php $this->assign('_but_role', 'add', false); ?>
			<?php else: ?>
				<?php $this->assign('_but_text', "<img src=\"".($this->_tpl_vars['images_dir'])."/icons/icon_choose_object.png\" width=\"16\" height=\"16\" border=\"0\" class=\"hand icon-choose\" alt=\"".(fn_get_lang_var('choose', $this->getLanguage()))."\" title=\"".(fn_get_lang_var('choose', $this->getLanguage()))."\" />", false); ?>
				<?php $this->assign('_but_role', 'icon', false); ?>
			<?php endif; ?>

			<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('but_id' => "opener_picker_".($this->_tpl_vars['data_id']), 'but_href' => fn_url("categories.picker?display=".($this->_tpl_vars['display'])."&amp;company_ids=".($this->_tpl_vars['company_ids'])."&amp;picker_for=".($this->_tpl_vars['picker_for'])."&amp;extra=".($this->_tpl_vars['extra_var'])."&amp;checkbox_name=".($this->_tpl_vars['checkbox_name'])."&amp;root=".($this->_tpl_vars['default_name'])."&amp;except_id=".($this->_tpl_vars['except_id'])."&amp;data_id=".($this->_tpl_vars['data_id']).($this->_tpl_vars['extra_url'])), 'but_text' => $this->_tpl_vars['_but_text'], 'but_role' => $this->_tpl_vars['_but_role'], 'but_rev' => "content_".($this->_tpl_vars['data_id']), 'but_meta' => "cm-dialog-opener", )); ?><?php if ($this->_tpl_vars['but_role'] == 'text'): ?>
	<?php $this->assign('class', "text-link", false); ?>
<?php elseif ($this->_tpl_vars['but_role'] == 'delete'): ?>
	<?php $this->assign('class', "text-button-delete", false); ?>
<?php elseif ($this->_tpl_vars['but_role'] == 'add'): ?>
	<?php $this->assign('class', "text-button text-button-add", false); ?>
<?php elseif ($this->_tpl_vars['but_role'] == 'reload'): ?>
	<?php $this->assign('class', "text-button text-button-reload", false); ?>
<?php elseif ($this->_tpl_vars['but_role'] == 'delete_item'): ?>
	<?php $this->assign('class', "text-button-delete-item", false); ?>
<?php elseif ($this->_tpl_vars['but_role'] == 'edit'): ?>
	<?php $this->assign('class', "text-button-edit", false); ?>
<?php elseif ($this->_tpl_vars['but_role'] == 'tool'): ?>
	<?php $this->assign('class', "tool-link", false); ?>
<?php elseif ($this->_tpl_vars['but_role'] == 'link'): ?>
	<?php $this->assign('class', "text-button-link", false); ?>
<?php elseif ($this->_tpl_vars['but_role'] == 'simple'): ?>
	<?php $this->assign('class', "text-button-simple", false); ?>
<?php else: ?>
	<?php $this->assign('class', "", false); ?>
<?php endif; ?>

<?php if ($this->_tpl_vars['but_name']): ?><?php $this->assign('r', $this->_tpl_vars['but_name'], false); ?><?php else: ?><?php $this->assign('r', $this->_tpl_vars['but_href'], false); ?><?php endif; ?>
<?php $this->assign('method', smarty_modifier_default(@$this->_tpl_vars['method'], 'POST'), false); ?>
<?php if (fn_check_view_permissions($this->_tpl_vars['r'], $this->_tpl_vars['method'])): ?>

<?php if ($this->_tpl_vars['but_name'] || $this->_tpl_vars['but_role'] == 'submit' || $this->_tpl_vars['but_role'] == 'button_main' || $this->_tpl_vars['but_type'] || $this->_tpl_vars['but_role'] == 'big'): ?> 
	<span <?php if ($this->_tpl_vars['but_css']): ?>style="<?php echo $this->_tpl_vars['but_css']; ?>
"<?php endif; ?> class="submit-button<?php if ($this->_tpl_vars['but_role'] == 'big'): ?>-big<?php endif; ?><?php if ($this->_tpl_vars['but_role'] == 'button_main'): ?> cm-button-main<?php endif; ?> <?php echo $this->_tpl_vars['but_meta']; ?>
"><input <?php if ($this->_tpl_vars['but_id']): ?>id="<?php echo $this->_tpl_vars['but_id']; ?>
"<?php endif; ?> <?php if ($this->_tpl_vars['but_meta']): ?>class="<?php echo $this->_tpl_vars['but_meta']; ?>
"<?php endif; ?> type="<?php echo smarty_modifier_default(@$this->_tpl_vars['but_type'], 'submit'); ?>
"<?php if ($this->_tpl_vars['but_name']): ?> name="<?php echo $this->_tpl_vars['but_name']; ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_onclick']): ?> onclick="<?php echo $this->_tpl_vars['but_onclick']; ?>
;<?php if (! $this->_tpl_vars['allow_href']): ?> return false;<?php endif; ?>"<?php endif; ?> value="<?php echo $this->_tpl_vars['but_text']; ?>
" <?php if ($this->_tpl_vars['tabindex']): ?>tabindex="<?php echo $this->_tpl_vars['tabindex']; ?>
"<?php endif; ?> <?php if ($this->_tpl_vars['but_rev']): ?> rev="<?php echo $this->_tpl_vars['but_rev']; ?>
"<?php endif; ?> <?php if ($this->_tpl_vars['but_disabled']): ?>disabled="disabled"<?php endif; ?> /></span>

<?php elseif ($this->_tpl_vars['but_role'] && $this->_tpl_vars['but_role'] != 'submit' && $this->_tpl_vars['but_role'] != 'action' && $this->_tpl_vars['but_role'] != "advanced-search" && $this->_tpl_vars['but_role'] != 'button'): ?> 
	<a <?php if ($this->_tpl_vars['but_id']): ?>id="<?php echo $this->_tpl_vars['but_id']; ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_href']): ?> href="<?php echo fn_url($this->_tpl_vars['but_href']); ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_onclick']): ?> onclick="<?php echo $this->_tpl_vars['but_onclick']; ?>
;<?php if (! $this->_tpl_vars['allow_href']): ?> return false;<?php endif; ?>"<?php endif; ?><?php if ($this->_tpl_vars['but_target']): ?> target="<?php echo $this->_tpl_vars['but_target']; ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_rev']): ?> rev="<?php echo $this->_tpl_vars['but_rev']; ?>
"<?php endif; ?> class="<?php echo $this->_tpl_vars['class']; ?>
<?php if ($this->_tpl_vars['but_meta']): ?> <?php echo $this->_tpl_vars['but_meta']; ?>
<?php endif; ?>"><?php if ($this->_tpl_vars['but_role'] == 'delete_item'): ?><img src="<?php echo $this->_tpl_vars['images_dir']; ?>
/icons/icon_delete.gif" width="12" height="18" border="0" alt="<?php echo fn_get_lang_var('remove_this_item', $this->getLanguage()); ?>
" title="<?php echo fn_get_lang_var('remove_this_item', $this->getLanguage()); ?>
" class="valign" /><?php else: ?><?php echo $this->_tpl_vars['but_text']; ?>
<?php endif; ?></a>

<?php elseif ($this->_tpl_vars['but_role'] == 'action' || $this->_tpl_vars['but_role'] == "advanced-search"): ?> 
	<a <?php if ($this->_tpl_vars['but_id']): ?>id="<?php echo $this->_tpl_vars['but_id']; ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_href']): ?> href="<?php echo fn_url($this->_tpl_vars['but_href']); ?>
"<?php endif; ?> <?php if ($this->_tpl_vars['but_onclick']): ?>onclick="<?php echo $this->_tpl_vars['but_onclick']; ?>
;<?php if (! $this->_tpl_vars['allow_href']): ?> return false;<?php endif; ?>"<?php endif; ?> <?php if ($this->_tpl_vars['but_target']): ?>target="<?php echo $this->_tpl_vars['but_target']; ?>
"<?php endif; ?> <?php if ($this->_tpl_vars['but_rev']): ?> rev="<?php echo $this->_tpl_vars['but_rev']; ?>
"<?php endif; ?> class="button<?php if ($this->_tpl_vars['but_meta']): ?> <?php echo $this->_tpl_vars['but_meta']; ?>
<?php endif; ?>"><?php echo $this->_tpl_vars['but_text']; ?>
<?php if ($this->_tpl_vars['but_role'] == 'action'): ?>&nbsp;<img src="<?php echo $this->_tpl_vars['images_dir']; ?>
/icons/but_arrow.gif" width="8" height="7" border="0" alt=""/><?php endif; ?></a>
	
<?php elseif ($this->_tpl_vars['but_role'] == 'button'): ?>
	<input <?php if ($this->_tpl_vars['but_id']): ?>id="<?php echo $this->_tpl_vars['but_id']; ?>
"<?php endif; ?> <?php if ($this->_tpl_vars['but_meta']): ?>class="<?php echo $this->_tpl_vars['but_meta']; ?>
"<?php endif; ?> type="button" <?php if ($this->_tpl_vars['but_onclick']): ?>onclick="<?php echo $this->_tpl_vars['but_onclick']; ?>
;<?php if (! $this->_tpl_vars['allow_href']): ?> return false;<?php endif; ?>"<?php endif; ?> value="<?php echo $this->_tpl_vars['but_text']; ?>
" <?php if ($this->_tpl_vars['tabindex']): ?>tabindex="<?php echo $this->_tpl_vars['tabindex']; ?>
"<?php endif; ?> <?php if ($this->_tpl_vars['but_rev']): ?> rev="<?php echo $this->_tpl_vars['but_rev']; ?>
"<?php endif; ?> />

<?php elseif ($this->_tpl_vars['but_role'] == 'icon'): ?> 
	<a <?php if ($this->_tpl_vars['but_id']): ?>id="<?php echo $this->_tpl_vars['but_id']; ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_href']): ?> href="<?php echo fn_url($this->_tpl_vars['but_href']); ?>
"<?php endif; ?> <?php if ($this->_tpl_vars['but_onclick']): ?>onclick="<?php echo $this->_tpl_vars['but_onclick']; ?>
;<?php if (! $this->_tpl_vars['allow_href']): ?> return false;<?php endif; ?>"<?php endif; ?> <?php if ($this->_tpl_vars['but_target']): ?>target="<?php echo $this->_tpl_vars['but_target']; ?>
"<?php endif; ?> <?php if ($this->_tpl_vars['but_rev']): ?> rev="<?php echo $this->_tpl_vars['but_rev']; ?>
"<?php endif; ?> class="<?php if ($this->_tpl_vars['but_meta']): ?> <?php echo $this->_tpl_vars['but_meta']; ?>
<?php endif; ?>"><?php echo $this->_tpl_vars['but_text']; ?>
</a>

<?php elseif (! $this->_tpl_vars['but_role']): ?> 
	<input <?php if ($this->_tpl_vars['but_id']): ?>id="<?php echo $this->_tpl_vars['but_id']; ?>
"<?php endif; ?> class="default-button<?php if ($this->_tpl_vars['but_meta']): ?> <?php echo $this->_tpl_vars['but_meta']; ?>
<?php endif; ?>" type="submit" onclick="<?php echo $this->_tpl_vars['but_onclick']; ?>
;<?php if (! $this->_tpl_vars['allow_href']): ?> return false;<?php endif; ?>" value="<?php echo $this->_tpl_vars['but_text']; ?>
" <?php if ($this->_tpl_vars['but_rev']): ?> rev="<?php echo $this->_tpl_vars['but_rev']; ?>
"<?php endif; ?> />
<?php endif; ?>

<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>

		<?php if (! $this->_tpl_vars['no_container']): ?></div><?php endif; ?>
		<?php endif; ?>
		<div class="hidden" id="content_<?php echo $this->_tpl_vars['data_id']; ?>
" title="<?php echo smarty_modifier_default(@$this->_tpl_vars['but_text'], fn_get_lang_var('add_categories', $this->getLanguage())); ?>
">
		</div>
		<div class="hidden" id="clone_content_<?php echo $this->_tpl_vars['data_id']; ?>
" title="<?php echo smarty_modifier_default(@$this->_tpl_vars['but_text'], fn_get_lang_var('add_categories', $this->getLanguage())); ?>
">
		</div>
	<?php else: ?>
		<?php $this->assign('display', 'checkbox', false); ?>

		<?php if (! $this->_tpl_vars['extra_url']): ?>
			<?php $this->assign('extra_url', "&amp;get_tree=multi_level", false); ?>
		<?php endif; ?>

		<?php if ($this->_tpl_vars['extra_var']): ?>
			<?php $this->assign('extra_var', smarty_modifier_escape($this->_tpl_vars['extra_var'], 'url'), false); ?>
		<?php endif; ?>

		<?php if (! defined('COMPANY_ID') || @CONTROLLER != 'companies'): ?>
			<?php $this->assign('_but_text', smarty_modifier_default(@$this->_tpl_vars['but_text'], fn_get_lang_var('add_categories', $this->getLanguage())), false); ?>
			<?php $this->assign('_but_role', 'add', false); ?>

			<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('but_id' => "opener_picker_".($this->_tpl_vars['data_id']), 'but_href' => fn_url("categories.picker?display=".($this->_tpl_vars['display'])."&amp;data_id=".($this->_tpl_vars['data_id'])."&amp;company_ids=".($this->_tpl_vars['company_ids']).($this->_tpl_vars['extra_url'])), 'but_text' => $this->_tpl_vars['_but_text'], 'but_role' => $this->_tpl_vars['_but_role'], 'but_rev' => "content_".($this->_tpl_vars['data_id']), 'but_meta' => "cm-dialog-opener", )); ?><?php if ($this->_tpl_vars['but_role'] == 'text'): ?>
	<?php $this->assign('class', "text-link", false); ?>
<?php elseif ($this->_tpl_vars['but_role'] == 'delete'): ?>
	<?php $this->assign('class', "text-button-delete", false); ?>
<?php elseif ($this->_tpl_vars['but_role'] == 'add'): ?>
	<?php $this->assign('class', "text-button text-button-add", false); ?>
<?php elseif ($this->_tpl_vars['but_role'] == 'reload'): ?>
	<?php $this->assign('class', "text-button text-button-reload", false); ?>
<?php elseif ($this->_tpl_vars['but_role'] == 'delete_item'): ?>
	<?php $this->assign('class', "text-button-delete-item", false); ?>
<?php elseif ($this->_tpl_vars['but_role'] == 'edit'): ?>
	<?php $this->assign('class', "text-button-edit", false); ?>
<?php elseif ($this->_tpl_vars['but_role'] == 'tool'): ?>
	<?php $this->assign('class', "tool-link", false); ?>
<?php elseif ($this->_tpl_vars['but_role'] == 'link'): ?>
	<?php $this->assign('class', "text-button-link", false); ?>
<?php elseif ($this->_tpl_vars['but_role'] == 'simple'): ?>
	<?php $this->assign('class', "text-button-simple", false); ?>
<?php else: ?>
	<?php $this->assign('class', "", false); ?>
<?php endif; ?>

<?php if ($this->_tpl_vars['but_name']): ?><?php $this->assign('r', $this->_tpl_vars['but_name'], false); ?><?php else: ?><?php $this->assign('r', $this->_tpl_vars['but_href'], false); ?><?php endif; ?>
<?php $this->assign('method', smarty_modifier_default(@$this->_tpl_vars['method'], 'POST'), false); ?>
<?php if (fn_check_view_permissions($this->_tpl_vars['r'], $this->_tpl_vars['method'])): ?>

<?php if ($this->_tpl_vars['but_name'] || $this->_tpl_vars['but_role'] == 'submit' || $this->_tpl_vars['but_role'] == 'button_main' || $this->_tpl_vars['but_type'] || $this->_tpl_vars['but_role'] == 'big'): ?> 
	<span <?php if ($this->_tpl_vars['but_css']): ?>style="<?php echo $this->_tpl_vars['but_css']; ?>
"<?php endif; ?> class="submit-button<?php if ($this->_tpl_vars['but_role'] == 'big'): ?>-big<?php endif; ?><?php if ($this->_tpl_vars['but_role'] == 'button_main'): ?> cm-button-main<?php endif; ?> <?php echo $this->_tpl_vars['but_meta']; ?>
"><input <?php if ($this->_tpl_vars['but_id']): ?>id="<?php echo $this->_tpl_vars['but_id']; ?>
"<?php endif; ?> <?php if ($this->_tpl_vars['but_meta']): ?>class="<?php echo $this->_tpl_vars['but_meta']; ?>
"<?php endif; ?> type="<?php echo smarty_modifier_default(@$this->_tpl_vars['but_type'], 'submit'); ?>
"<?php if ($this->_tpl_vars['but_name']): ?> name="<?php echo $this->_tpl_vars['but_name']; ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_onclick']): ?> onclick="<?php echo $this->_tpl_vars['but_onclick']; ?>
;<?php if (! $this->_tpl_vars['allow_href']): ?> return false;<?php endif; ?>"<?php endif; ?> value="<?php echo $this->_tpl_vars['but_text']; ?>
" <?php if ($this->_tpl_vars['tabindex']): ?>tabindex="<?php echo $this->_tpl_vars['tabindex']; ?>
"<?php endif; ?> <?php if ($this->_tpl_vars['but_rev']): ?> rev="<?php echo $this->_tpl_vars['but_rev']; ?>
"<?php endif; ?> <?php if ($this->_tpl_vars['but_disabled']): ?>disabled="disabled"<?php endif; ?> /></span>

<?php elseif ($this->_tpl_vars['but_role'] && $this->_tpl_vars['but_role'] != 'submit' && $this->_tpl_vars['but_role'] != 'action' && $this->_tpl_vars['but_role'] != "advanced-search" && $this->_tpl_vars['but_role'] != 'button'): ?> 
	<a <?php if ($this->_tpl_vars['but_id']): ?>id="<?php echo $this->_tpl_vars['but_id']; ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_href']): ?> href="<?php echo fn_url($this->_tpl_vars['but_href']); ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_onclick']): ?> onclick="<?php echo $this->_tpl_vars['but_onclick']; ?>
;<?php if (! $this->_tpl_vars['allow_href']): ?> return false;<?php endif; ?>"<?php endif; ?><?php if ($this->_tpl_vars['but_target']): ?> target="<?php echo $this->_tpl_vars['but_target']; ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_rev']): ?> rev="<?php echo $this->_tpl_vars['but_rev']; ?>
"<?php endif; ?> class="<?php echo $this->_tpl_vars['class']; ?>
<?php if ($this->_tpl_vars['but_meta']): ?> <?php echo $this->_tpl_vars['but_meta']; ?>
<?php endif; ?>"><?php if ($this->_tpl_vars['but_role'] == 'delete_item'): ?><img src="<?php echo $this->_tpl_vars['images_dir']; ?>
/icons/icon_delete.gif" width="12" height="18" border="0" alt="<?php echo fn_get_lang_var('remove_this_item', $this->getLanguage()); ?>
" title="<?php echo fn_get_lang_var('remove_this_item', $this->getLanguage()); ?>
" class="valign" /><?php else: ?><?php echo $this->_tpl_vars['but_text']; ?>
<?php endif; ?></a>

<?php elseif ($this->_tpl_vars['but_role'] == 'action' || $this->_tpl_vars['but_role'] == "advanced-search"): ?> 
	<a <?php if ($this->_tpl_vars['but_id']): ?>id="<?php echo $this->_tpl_vars['but_id']; ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_href']): ?> href="<?php echo fn_url($this->_tpl_vars['but_href']); ?>
"<?php endif; ?> <?php if ($this->_tpl_vars['but_onclick']): ?>onclick="<?php echo $this->_tpl_vars['but_onclick']; ?>
;<?php if (! $this->_tpl_vars['allow_href']): ?> return false;<?php endif; ?>"<?php endif; ?> <?php if ($this->_tpl_vars['but_target']): ?>target="<?php echo $this->_tpl_vars['but_target']; ?>
"<?php endif; ?> <?php if ($this->_tpl_vars['but_rev']): ?> rev="<?php echo $this->_tpl_vars['but_rev']; ?>
"<?php endif; ?> class="button<?php if ($this->_tpl_vars['but_meta']): ?> <?php echo $this->_tpl_vars['but_meta']; ?>
<?php endif; ?>"><?php echo $this->_tpl_vars['but_text']; ?>
<?php if ($this->_tpl_vars['but_role'] == 'action'): ?>&nbsp;<img src="<?php echo $this->_tpl_vars['images_dir']; ?>
/icons/but_arrow.gif" width="8" height="7" border="0" alt=""/><?php endif; ?></a>
	
<?php elseif ($this->_tpl_vars['but_role'] == 'button'): ?>
	<input <?php if ($this->_tpl_vars['but_id']): ?>id="<?php echo $this->_tpl_vars['but_id']; ?>
"<?php endif; ?> <?php if ($this->_tpl_vars['but_meta']): ?>class="<?php echo $this->_tpl_vars['but_meta']; ?>
"<?php endif; ?> type="button" <?php if ($this->_tpl_vars['but_onclick']): ?>onclick="<?php echo $this->_tpl_vars['but_onclick']; ?>
;<?php if (! $this->_tpl_vars['allow_href']): ?> return false;<?php endif; ?>"<?php endif; ?> value="<?php echo $this->_tpl_vars['but_text']; ?>
" <?php if ($this->_tpl_vars['tabindex']): ?>tabindex="<?php echo $this->_tpl_vars['tabindex']; ?>
"<?php endif; ?> <?php if ($this->_tpl_vars['but_rev']): ?> rev="<?php echo $this->_tpl_vars['but_rev']; ?>
"<?php endif; ?> />

<?php elseif ($this->_tpl_vars['but_role'] == 'icon'): ?> 
	<a <?php if ($this->_tpl_vars['but_id']): ?>id="<?php echo $this->_tpl_vars['but_id']; ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_href']): ?> href="<?php echo fn_url($this->_tpl_vars['but_href']); ?>
"<?php endif; ?> <?php if ($this->_tpl_vars['but_onclick']): ?>onclick="<?php echo $this->_tpl_vars['but_onclick']; ?>
;<?php if (! $this->_tpl_vars['allow_href']): ?> return false;<?php endif; ?>"<?php endif; ?> <?php if ($this->_tpl_vars['but_target']): ?>target="<?php echo $this->_tpl_vars['but_target']; ?>
"<?php endif; ?> <?php if ($this->_tpl_vars['but_rev']): ?> rev="<?php echo $this->_tpl_vars['but_rev']; ?>
"<?php endif; ?> class="<?php if ($this->_tpl_vars['but_meta']): ?> <?php echo $this->_tpl_vars['but_meta']; ?>
<?php endif; ?>"><?php echo $this->_tpl_vars['but_text']; ?>
</a>

<?php elseif (! $this->_tpl_vars['but_role']): ?> 
	<input <?php if ($this->_tpl_vars['but_id']): ?>id="<?php echo $this->_tpl_vars['but_id']; ?>
"<?php endif; ?> class="default-button<?php if ($this->_tpl_vars['but_meta']): ?> <?php echo $this->_tpl_vars['but_meta']; ?>
<?php endif; ?>" type="submit" onclick="<?php echo $this->_tpl_vars['but_onclick']; ?>
;<?php if (! $this->_tpl_vars['allow_href']): ?> return false;<?php endif; ?>" value="<?php echo $this->_tpl_vars['but_text']; ?>
" <?php if ($this->_tpl_vars['but_rev']): ?> rev="<?php echo $this->_tpl_vars['but_rev']; ?>
"<?php endif; ?> />
<?php endif; ?>

<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>

		<?php endif; ?>
		<div class="hidden" id="content_<?php echo $this->_tpl_vars['data_id']; ?>
" title="<?php echo smarty_modifier_default(@$this->_tpl_vars['but_text'], fn_get_lang_var('add_categories', $this->getLanguage())); ?>
">
		</div>
	<?php endif; ?>
<?php $this->_smarty_vars['capture']['add_buttons'] = ob_get_contents(); ob_end_clean(); ?>

<?php echo $this->_smarty_vars['capture']['add_buttons']; ?>

<?php endif; ?>

<?php if (! $this->_tpl_vars['extra_var'] && $this->_tpl_vars['view_mode'] != 'button'): ?>
	<?php if ($this->_tpl_vars['multiple']): ?>
		<table cellpadding="0" cellspacing="0" border="0" width="100%" class="table">
		<tr>
			<?php if ($this->_tpl_vars['positions']): ?><th><?php echo fn_get_lang_var('position_short', $this->getLanguage()); ?>
</th><?php endif; ?>
			<th width="100%"><?php echo fn_get_lang_var('name', $this->getLanguage()); ?>
</th>
			<th>&nbsp;</th>
		</tr>
		<tbody id="<?php echo $this->_tpl_vars['data_id']; ?>
"<?php if (! $this->_tpl_vars['item_ids']): ?> class="hidden"<?php endif; ?>>
	<?php else: ?>
		<div id="<?php echo $this->_tpl_vars['data_id']; ?>
" class="<?php if ($this->_tpl_vars['multiple'] && ! $this->_tpl_vars['item_ids']): ?>hidden<?php elseif (! $this->_tpl_vars['multiple']): ?><?php if ($this->_tpl_vars['view_mode'] != 'list'): ?>cm-display-radio<?php endif; ?><?php endif; ?> choose-category">
	<?php endif; ?>
	<?php if ($this->_tpl_vars['multiple']): ?>
		<tr class="hidden">
			<td colspan="<?php if ($this->_tpl_vars['positions']): ?>3<?php else: ?>2<?php endif; ?>">
	<?php endif; ?>
			<input id="<?php if ($this->_tpl_vars['input_id']): ?><?php echo $this->_tpl_vars['input_id']; ?>
<?php else: ?>c<?php echo $this->_tpl_vars['data_id']; ?>
_ids<?php endif; ?>" type="hidden" class="cm-picker-value" name="<?php echo $this->_tpl_vars['input_name']; ?>
" value="<?php if (is_array($this->_tpl_vars['item_ids'])): ?><?php echo implode(",", $this->_tpl_vars['item_ids']); ?>
<?php endif; ?>" <?php echo $this->_tpl_vars['extra']; ?>
 />
	<?php if ($this->_tpl_vars['multiple']): ?>
			</td>
		</tr>
	<?php endif; ?>
		<?php if ($this->_tpl_vars['multiple']): ?>
			<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "pickers/js_category.tpl", 'smarty_include_vars' => array('category_id' => ($this->_tpl_vars['ldelim'])."category_id".($this->_tpl_vars['rdelim']),'holder' => $this->_tpl_vars['data_id'],'hide_input' => $this->_tpl_vars['hide_input'],'input_name' => $this->_tpl_vars['input_name'],'radio_input_name' => $this->_tpl_vars['radio_input_name'],'clone' => true,'hide_link' => $this->_tpl_vars['hide_link'],'hide_delete_button' => $this->_tpl_vars['hide_delete_button'],'position_field' => $this->_tpl_vars['positions'],'position' => '0')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<?php endif; ?>
		<?php if ($this->_tpl_vars['view_mode'] == 'list'): ?>
			<?php $_from = $this->_tpl_vars['item_ids']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['items'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['items']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['c_id']):
        $this->_foreach['items']['iteration']++;
?>
				<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "pickers/js_category.tpl", 'smarty_include_vars' => array('main_category' => $this->_tpl_vars['main_category'],'category_id' => $this->_tpl_vars['c_id'],'holder' => $this->_tpl_vars['data_id'],'hide_input' => $this->_tpl_vars['hide_input'],'input_name' => $this->_tpl_vars['input_name'],'clone' => true,'hide_link' => $this->_tpl_vars['hide_link'],'first_item' => ($this->_foreach['items']['iteration'] <= 1),'view_mode' => 'list')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<?php endforeach; else: ?>
				<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "pickers/js_category.tpl", 'smarty_include_vars' => array('category_id' => "",'holder' => $this->_tpl_vars['data_id'],'hide_input' => $this->_tpl_vars['hide_input'],'input_name' => $this->_tpl_vars['input_name'],'clone' => true,'hide_link' => $this->_tpl_vars['hide_link'],'view_mode' => 'list')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<?php endif; unset($_from); ?>
		<?php else: ?>
			<?php $_from = $this->_tpl_vars['item_ids']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['items'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['items']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['c_id']):
        $this->_foreach['items']['iteration']++;
?>
				<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "pickers/js_category.tpl", 'smarty_include_vars' => array('category_id' => $this->_tpl_vars['c_id'],'holder' => $this->_tpl_vars['data_id'],'hide_input' => $this->_tpl_vars['hide_input'],'input_name' => $this->_tpl_vars['input_name'],'hide_link' => $this->_tpl_vars['hide_link'],'hide_delete_button' => $this->_tpl_vars['hide_delete_button'],'first_item' => ($this->_foreach['items']['iteration'] <= 1),'position_field' => $this->_tpl_vars['positions'],'position' => $this->_foreach['items']['iteration']+$this->_tpl_vars['start_pos'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<?php endforeach; else: ?>
				<?php if (! $this->_tpl_vars['multiple']): ?>
					<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "pickers/js_category.tpl", 'smarty_include_vars' => array('category_id' => "",'holder' => $this->_tpl_vars['data_id'],'hide_input' => $this->_tpl_vars['hide_input'],'input_name' => $this->_tpl_vars['input_name'],'hide_link' => $this->_tpl_vars['hide_link'],'hide_delete_button' => $this->_tpl_vars['hide_delete_button'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				<?php endif; ?>
			<?php endif; unset($_from); ?>
		<?php endif; ?>
	<?php if ($this->_tpl_vars['multiple']): ?>
		</tbody>
		<tbody id="<?php echo $this->_tpl_vars['data_id']; ?>
_no_item"<?php if ($this->_tpl_vars['item_ids']): ?> class="hidden"<?php endif; ?>>
		<tr class="no-items">
			<td colspan="<?php if ($this->_tpl_vars['positions']): ?>3<?php else: ?>2<?php endif; ?>"><p><?php echo smarty_modifier_default(@$this->_tpl_vars['no_item_text'], fn_get_lang_var('no_items', $this->getLanguage())); ?>
</p></td>
		</tr>
		</tbody>
	</table>
	<?php else: ?></div><?php endif; ?>
<?php endif; ?>