<?php /* Smarty version 2.6.18, created on 2014-03-10 02:13:38
         compiled from buttons/multiple_buttons.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'script', 'buttons/multiple_buttons.tpl', 15, false),array('modifier', 'default', 'buttons/multiple_buttons.tpl', 17, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('add_empty_item','add_empty_item','clone_this_item','clone_this_item','remove_this_item','remove_this_item','remove_this_item','remove_this_item'));
?>
<?php  ob_start();  ?><?php 

				$rname = !empty($resource_name) ? $resource_name : $params['smarty_include_tpl_file'];
				if ($this->compile_check && empty($inline_no_check[$rname]) && $this->is_cached($rname)) {
					if ($this->check_inline_blocks(array (
  'buttons/remove_item.tpl' => 1367063752,
))) {
						$_smarty_compile_path = $this->_get_compile_path($rname);
						$this->_compile_resource($rname, $_smarty_compile_path);
						$inline_no_check[$rname] = true;
						include $_smarty_compile_path;
						return;
					}
				}
			 ?><?php echo smarty_function_script(array('src' => "js/node_cloning.js"), $this);?>


<?php $this->assign('tag_level', smarty_modifier_default(@$this->_tpl_vars['tag_level'], '1'), false); ?>
<?php echo ''; ?><?php if ($this->_tpl_vars['only_delete'] != 'Y'): ?><?php echo '<span class="nowrap cm-clone-node">'; ?><?php if (! $this->_tpl_vars['hide_add']): ?><?php echo ''; ?><?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('but_onclick' => "$('#box_' + this.id).cloneNode(".($this->_tpl_vars['tag_level'])."); ".($this->_tpl_vars['on_add']), 'item_id' => $this->_tpl_vars['item_id'], )); ?><?php echo '<img src="'; ?><?php echo $this->_tpl_vars['images_dir']; ?><?php echo '/icons/icon_add_simple.gif" width="13" height="18" border="0" name="add" id="'; ?><?php echo $this->_tpl_vars['item_id']; ?><?php echo '" alt="'; ?><?php echo fn_get_lang_var('add_empty_item', $this->getLanguage()); ?><?php echo '" title="'; ?><?php echo fn_get_lang_var('add_empty_item', $this->getLanguage()); ?><?php echo '" onclick="'; ?><?php echo $this->_tpl_vars['but_onclick']; ?><?php echo '" class="hand" align="top" />'; ?><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php echo '&nbsp;'; ?><?php endif; ?><?php echo ''; ?><?php if (! $this->_tpl_vars['hide_clone']): ?><?php echo ''; ?><?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('but_onclick' => "$('#box_' + this.id).cloneNode(".($this->_tpl_vars['tag_level']).", true);", 'item_id' => $this->_tpl_vars['item_id'], )); ?><?php echo '<img src="'; ?><?php echo $this->_tpl_vars['images_dir']; ?><?php echo '/icons/icon_clone.gif" width="13" height="18" border="0" name="clone" id="'; ?><?php echo $this->_tpl_vars['item_id']; ?><?php echo '" title="'; ?><?php echo fn_get_lang_var('clone_this_item', $this->getLanguage()); ?><?php echo '" alt="'; ?><?php echo fn_get_lang_var('clone_this_item', $this->getLanguage()); ?><?php echo '" onclick="'; ?><?php echo $this->_tpl_vars['but_onclick']; ?><?php echo '" class="hand" align="top" />'; ?><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php echo '&nbsp;'; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('only_delete' => $this->_tpl_vars['only_delete'], 'but_class' => "cm-delete-row", )); ?><?php echo ''; ?><?php if (! $this->_tpl_vars['simple']): ?><?php echo '<img src="'; ?><?php echo $this->_tpl_vars['images_dir']; ?><?php echo '/icons/icon_delete_disabled.gif" width="12" height="18" border="0" name="remove" id="'; ?><?php echo $this->_tpl_vars['item_id']; ?><?php echo '" alt="'; ?><?php echo fn_get_lang_var('remove_this_item', $this->getLanguage()); ?><?php echo '" title="'; ?><?php echo fn_get_lang_var('remove_this_item', $this->getLanguage()); ?><?php echo '" class="hand'; ?><?php if ($this->_tpl_vars['only_delete'] == 'Y'): ?><?php echo ' hidden'; ?><?php endif; ?><?php echo '" align="top" />'; ?><?php endif; ?><?php echo '<img src="'; ?><?php echo $this->_tpl_vars['images_dir']; ?><?php echo '/icons/icon_delete.gif" width="12" height="18" border="0" name="remove_hidden" id="'; ?><?php echo $this->_tpl_vars['item_id']; ?><?php echo '" alt="'; ?><?php echo fn_get_lang_var('remove_this_item', $this->getLanguage()); ?><?php echo '" title="'; ?><?php echo fn_get_lang_var('remove_this_item', $this->getLanguage()); ?><?php echo '"'; ?><?php if ($this->_tpl_vars['but_onclick']): ?><?php echo ' onclick="'; ?><?php echo $this->_tpl_vars['but_onclick']; ?><?php echo '"'; ?><?php endif; ?><?php echo ' class="hand'; ?><?php if (! $this->_tpl_vars['simple'] && $this->_tpl_vars['only_delete'] != 'Y'): ?><?php echo ' hidden'; ?><?php endif; ?><?php echo ''; ?><?php if ($this->_tpl_vars['but_class']): ?><?php echo ' '; ?><?php echo $this->_tpl_vars['but_class']; ?><?php echo ''; ?><?php endif; ?><?php echo '" align="top" />'; ?><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php echo '&nbsp;</span>'; ?>
<?php  ob_end_flush();  ?>