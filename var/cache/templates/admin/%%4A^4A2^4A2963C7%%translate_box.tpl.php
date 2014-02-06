<?php /* Smarty version 2.6.18, created on 2014-02-03 15:15:45
         compiled from common_templates/translate_box.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'fn_link_attach', 'common_templates/translate_box.tpl', 1, false),array('modifier', 'sizeof', 'common_templates/translate_box.tpl', 22, false),array('modifier', 'default', 'common_templates/translate_box.tpl', 24, false),array('modifier', 'lower', 'common_templates/translate_box.tpl', 28, false),array('modifier', 'fn_url', 'common_templates/translate_box.tpl', 37, false),array('modifier', 'unescape', 'common_templates/translate_box.tpl', 37, false),array('function', 'script', 'common_templates/translate_box.tpl', 64, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('translate','translate','select_descr_lang','save_translation'));
?>
<?php 

				$rname = !empty($resource_name) ? $resource_name : $params['smarty_include_tpl_file'];
				if ($this->compile_check && empty($inline_no_check[$rname]) && $this->is_cached($rname)) {
					if ($this->check_inline_blocks(array (
  'common_templates/select_object.tpl' => 1367063753,
))) {
						$_smarty_compile_path = $this->_get_compile_path($rname);
						$this->_compile_resource($rname, $_smarty_compile_path);
						$inline_no_check[$rname] = true;
						include $_smarty_compile_path;
						return;
					}
				}
			 ?><div id="translate_link" class="hidden">
	<img src="<?php echo $this->_tpl_vars['images_dir']; ?>
/icons/translate_icon.png" width="16" height="16" border="0" alt="<?php echo fn_get_lang_var('translate', $this->getLanguage()); ?>
" title="<?php echo fn_get_lang_var('translate', $this->getLanguage()); ?>
" onclick="fn_show_translate_box();" />
</div>
<div id="translate_box" class="hidden">

	<div id="translate_box_menu_language_selector" class="float-right">
		
		<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('style' => 'graphic', 'link_tpl' => fn_link_attach("design_mode.get_langvar", "lang_code="), 'items' => $this->_tpl_vars['languages'], 'selected_id' => @CART_LANGUAGE, 'key_name' => 'name', 'suffix' => 'translate_box', 'display_icons' => true, 'select_container_id' => 'translate_box_language_selector', )); ?><?php if (sizeof($this->_tpl_vars['items']) > 1): ?>
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
		
	</div>

	<input id="tbox_descr_sl" type="hidden" name="descr_sl" value="" />
	<input id="trans_val" class="input-text" type="text" value="" size="37" onkeyup="fn_change_phrase();"/>
	<p></p>
	<div id="orig_phrase" class="clear-both"></div>

	<div class="buttons-container">
		<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/save_cancel.tpl", 'smarty_include_vars' => array('but_type' => 'button','but_onclick' => "fn_save_phrase();",'but_text' => fn_get_lang_var('save_translation', $this->getLanguage()),'cancel_action' => 'close')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</div>

</div>
<?php echo smarty_function_script(array('src' => "js/design_mode.js"), $this);?>