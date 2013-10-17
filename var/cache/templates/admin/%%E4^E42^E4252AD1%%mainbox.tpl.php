<?php /* Smarty version 2.6.18, created on 2013-10-17 18:57:07
         compiled from common_templates/mainbox.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'fn_link_attach', 'common_templates/mainbox.tpl', 1, false),array('modifier', 'default', 'common_templates/mainbox.tpl', 31, false),array('modifier', 'sizeof', 'common_templates/mainbox.tpl', 43, false),array('modifier', 'lower', 'common_templates/mainbox.tpl', 52, false),array('modifier', 'fn_url', 'common_templates/mainbox.tpl', 61, false),array('modifier', 'unescape', 'common_templates/mainbox.tpl', 61, false),array('modifier', 'trim', 'common_templates/mainbox.tpl', 79, false),array('modifier', 'fn_check_view_permissions', 'common_templates/mainbox.tpl', 109, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('select_descr_lang','remove_this_item','remove_this_item'));
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
			 ?><?php if ($this->_tpl_vars['anchor']): ?>
<a name="<?php echo $this->_tpl_vars['anchor']; ?>
"></a>
<?php endif; ?>
<div>

<?php if ($this->_tpl_vars['title_extra'] || $this->_tpl_vars['tools'] || ( $this->_tpl_vars['navigation']['dynamic'] && $this->_tpl_vars['navigation']['dynamic']['actions'] ) || $this->_tpl_vars['select_languages'] || $this->_tpl_vars['extra_tools']): ?>
	<div class="clear mainbox-title-container">
<?php endif; ?>

	<?php if ($this->_tpl_vars['notes']): ?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/help.tpl", 'smarty_include_vars' => array('content' => $this->_tpl_vars['notes'],'id' => $this->_tpl_vars['notes_id'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php endif; ?>

	<?php if ($this->_tpl_vars['tools']): ?><?php echo $this->_tpl_vars['tools']; ?>
<?php endif; ?>

	<h1 class="mainbox-title<?php if ($this->_tpl_vars['title_extra']): ?> float-left<?php endif; ?>">
		<?php echo smarty_modifier_default(@$this->_tpl_vars['title'], "&nbsp;"); ?>

	</h1>

	<?php if ($this->_tpl_vars['title_extra']): ?><div class="title">-&nbsp;</div>
		<?php echo $this->_tpl_vars['title_extra']; ?>

	<?php endif; ?>
<?php if ($this->_tpl_vars['title_extra'] || $this->_tpl_vars['tools'] || $this->_tpl_vars['navigation']['dynamic']['actions'] || $this->_tpl_vars['select_languages'] || $this->_tpl_vars['extra_tools']): ?>
	</div>
<?php endif; ?>

<?php if ($this->_tpl_vars['navigation']['dynamic']['actions'] || $this->_tpl_vars['select_languages'] || $this->_tpl_vars['extra_tools']): ?><div class="extra-tools"><?php endif; ?>

<?php if ($this->_tpl_vars['select_languages'] && sizeof($this->_tpl_vars['languages']) > 1): ?>
<div class="select-lang">

	<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('style' => 'graphic', 'link_tpl' => fn_link_attach($this->_tpl_vars['config']['current_url'], "descr_sl="), 'items' => $this->_tpl_vars['languages'], 'selected_id' => @DESCR_SL, 'key_name' => 'name', 'suffix' => 'content', 'display_icons' => true, )); ?><?php if (sizeof($this->_tpl_vars['items']) > 1): ?>
<div class="tools-container inline <?php echo $this->_tpl_vars['class']; ?>
" <?php if ($this->_tpl_vars['select_container_id']): ?>id="<?php echo $this->_tpl_vars['select_container_id']; ?>
"<?php endif; ?>>
<?php $this->assign('language_text', smarty_modifier_default(@$this->_tpl_vars['text'], fn_get_lang_var('select_descr_lang', $this->getLanguage())), false); ?>

<?php if ($this->_tpl_vars['style'] == 'graphic'): ?>
	<?php if ($this->_tpl_vars['display_icons'] == true): ?>
		<i class="flag flag-<?php echo smarty_modifier_lower($this->_tpl_vars['selected_id']); ?>
 single cm-external-click" rev="sw_select_<?php echo $this->_tpl_vars['selected_id']; ?>
_wrap_<?php echo $this->_tpl_vars['suffix']; ?>
"></i>
	<?php endif; ?>

	<a class="select-link cm-combo-on cm-combination" id="sw_select_<?php echo $this->_tpl_vars['selected_id']; ?>
_wrap_<?php echo $this->_tpl_vars['suffix']; ?>
"><?php echo $this->_tpl_vars['items'][$this->_tpl_vars['selected_id']][$this->_tpl_vars['key_name']]; ?>
<?php if ($this->_tpl_vars['items'][$this->_tpl_vars['selected_id']]['symbol']): ?>&nbsp;(<?php echo $this->_tpl_vars['items'][$this->_tpl_vars['selected_id']]['symbol']; ?>
)<?php endif; ?></a>
	
	<div id="select_<?php echo $this->_tpl_vars['selected_id']; ?>
_wrap_<?php echo $this->_tpl_vars['suffix']; ?>
" class="popup-tools cm-popup-box cm-smart-position hidden">
		<?php if ($this->_tpl_vars['key_name'] == 'company'): ?><input id="filter" class="input-text cm-filter" type="text" style="width: 85%"/><?php endif; ?>
		<ul class="cm-select-list<?php if ($this->_tpl_vars['display_icons'] == true): ?> popup-icons<?php endif; ?>">
			<?php $_from = $this->_tpl_vars['items']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['id'] => $this->_tpl_vars['item']):
?>
				<li><a name="<?php echo $this->_tpl_vars['id']; ?>
" href="<?php echo fn_url(($this->_tpl_vars['link_tpl']).($this->_tpl_vars['id'])); ?>
"><?php if ($this->_tpl_vars['display_icons'] == true): ?><i class="flag flag-<?php echo smarty_modifier_lower($this->_tpl_vars['id']); ?>
"></i><?php endif; ?><?php echo $this->_tpl_vars['item'][$this->_tpl_vars['key_name']]; ?>
<?php if ($this->_tpl_vars['item']['symbol']): ?>&nbsp;(<?php echo smarty_modifier_unescape($this->_tpl_vars['item']['symbol']); ?>
)<?php endif; ?></a></li>
			<?php endforeach; endif; unset($_from); ?>
		</ul>
	</div>
<?php elseif ($this->_tpl_vars['style'] == 'select'): ?>
	<?php if ($this->_tpl_vars['text']): ?><label for="id_<?php echo $this->_tpl_vars['var_name']; ?>
"><?php echo $this->_tpl_vars['text']; ?>
:</label><?php endif; ?>
	<select id="id_<?php echo $this->_tpl_vars['var_name']; ?>
" name="<?php echo $this->_tpl_vars['var_name']; ?>
" onchange="$.redirect(this.value);" class="valign">
		<?php $_from = $this->_tpl_vars['items']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['id'] => $this->_tpl_vars['item']):
?>
			<option value="<?php echo $this->_tpl_vars['link_tpl']; ?>
<?php echo $this->_tpl_vars['id']; ?>
" <?php if ($this->_tpl_vars['id'] == $this->_tpl_vars['selected_id']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['item'][$this->_tpl_vars['key_name']]; ?>
</option>
		<?php endforeach; endif; unset($_from); ?>
	</select>
<?php endif; ?>
</div>
<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>

</div><?php if ($this->_tpl_vars['navigation']['dynamic']['actions'] || $this->_tpl_vars['extra_tools']): ?>&nbsp;&nbsp;<?php endif; ?>
<?php endif; ?>

<?php if (trim($this->_tpl_vars['extra_tools'])): ?>
	<?php echo $this->_tpl_vars['extra_tools']; ?>
<?php if ($this->_tpl_vars['navigation']['dynamic']['actions']): ?><?php endif; ?>
<?php endif; ?>

<?php if ($this->_tpl_vars['navigation']['dynamic']['actions']): ?>
	<?php $_from = $this->_tpl_vars['navigation']['dynamic']['actions']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['actions'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['actions']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['title'] => $this->_tpl_vars['m']):
        $this->_foreach['actions']['iteration']++;
?>
		<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('but_href' => $this->_tpl_vars['m']['href'], 'but_text' => fn_get_lang_var($this->_tpl_vars['title'], $this->getLanguage()), 'but_role' => 'tool', 'but_target' => $this->_tpl_vars['m']['target'], 'but_meta' => $this->_tpl_vars['m']['meta'], 'method' => 'GET', )); ?><?php if ($this->_tpl_vars['but_role'] == 'text'): ?>
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
	<?php endforeach; endif; unset($_from); ?>
<?php endif; ?>

<?php if (trim($this->_smarty_vars['capture']['preview'])): ?>
	<div class="float-right preview-link">
		<?php echo $this->_smarty_vars['capture']['preview']; ?>

	</div>
<?php endif; ?>

<?php if ($this->_tpl_vars['navigation']['dynamic']['actions'] || $this->_tpl_vars['select_languages'] || $this->_tpl_vars['extra_tools']): ?></div><?php endif; ?>

	<div class="mainbox-body" <?php if ($this->_tpl_vars['box_id']): ?>id="<?php echo $this->_tpl_vars['box_id']; ?>
"<?php endif; ?>>
		<?php echo smarty_modifier_default(@$this->_tpl_vars['content'], "&nbsp;"); ?>

	<?php if ($this->_tpl_vars['box_id']): ?><!--<?php echo $this->_tpl_vars['box_id']; ?>
--><?php endif; ?></div>
</div>