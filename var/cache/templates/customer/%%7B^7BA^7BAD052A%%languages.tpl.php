<?php /* Smarty version 2.6.18, created on 2013-06-01 19:32:59
         compiled from C:/wamp5/www/dutchme2/skins/basic/customer/blocks/languages.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'fn_link_attach', 'C:/wamp5/www/dutchme2/skins/basic/customer/blocks/languages.tpl', 1, false),array('modifier', 'count', 'C:/wamp5/www/dutchme2/skins/basic/customer/blocks/languages.tpl', 16, false),array('modifier', 'lower', 'C:/wamp5/www/dutchme2/skins/basic/customer/blocks/languages.tpl', 20, false),array('modifier', 'default', 'C:/wamp5/www/dutchme2/skins/basic/customer/blocks/languages.tpl', 29, false),array('modifier', 'unescape', 'C:/wamp5/www/dutchme2/skins/basic/customer/blocks/languages.tpl', 38, false),array('modifier', 'fn_url', 'C:/wamp5/www/dutchme2/skins/basic/customer/blocks/languages.tpl', 43, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('change_language','select_descr_lang'));
?>
<?php  ob_start();  ?><?php 

				$rname = !empty($resource_name) ? $resource_name : $params['smarty_include_tpl_file'];
				if ($this->compile_check && empty($inline_no_check[$rname]) && $this->is_cached($rname)) {
					if ($this->check_inline_blocks(array (
  'common_templates/select_object.tpl' => 1367063745,
))) {
						$_smarty_compile_path = $this->_get_compile_path($rname);
						$this->_compile_resource($rname, $_smarty_compile_path);
						$inline_no_check[$rname] = true;
						include $_smarty_compile_path;
						return;
					}
				}
			 ?><div id="languages_<?php echo $this->_tpl_vars['block']['block_id']; ?>
">
	<?php if ($this->_tpl_vars['languages'] && count($this->_tpl_vars['languages']) > 1): ?>
	<?php if ($this->_tpl_vars['dropdown_limit'] > 0 && count($this->_tpl_vars['languages']) <= $this->_tpl_vars['dropdown_limit']): ?>
		<div class="select-wrap languages">
			<?php $_from = $this->_tpl_vars['languages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['code'] => $this->_tpl_vars['language']):
?>
				<a href="<?php echo fn_link_attach($this->_tpl_vars['config']['current_url'], "sl=".($this->_tpl_vars['language']['lang_code'])); ?>
" title="<?php echo fn_get_lang_var('change_language', $this->getLanguage()); ?>
" class="<?php if (@DESCR_SL == $this->_tpl_vars['code']): ?>active-element<?php endif; ?>"><i class="flag flag-<?php echo smarty_modifier_lower($this->_tpl_vars['code']); ?>
"></i><?php if ($this->_tpl_vars['format'] == 'name'): ?><?php echo $this->_tpl_vars['language']['name']; ?>
<?php endif; ?></a>
			<?php endforeach; endif; unset($_from); ?>
		</div>
	<?php else: ?>
		<?php if ($this->_tpl_vars['format'] == 'name'): ?>
			<?php $this->assign('key_name', 'name', false); ?>
		<?php else: ?>
			<?php $this->assign('key_name', "", false); ?>
		<?php endif; ?>
		<div class="select-wrap"><?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('style' => 'graphic', 'suffix' => 'language', 'link_tpl' => fn_link_attach($this->_tpl_vars['config']['current_url'], "sl="), 'items' => $this->_tpl_vars['languages'], 'selected_id' => @CART_LANGUAGE, 'display_icons' => true, 'key_name' => $this->_tpl_vars['key_name'], 'language_var_name' => 'sl', )); ?><?php $this->assign('language_text', smarty_modifier_default(@$this->_tpl_vars['text'], fn_get_lang_var('select_descr_lang', $this->getLanguage())), false); ?>

<?php if ($this->_tpl_vars['style'] == 'graphic'): ?>
	<?php if ($this->_tpl_vars['text']): ?><?php echo $this->_tpl_vars['text']; ?>
:<?php endif; ?>
	
	<?php if ($this->_tpl_vars['display_icons'] == true): ?>
	<i class="flag flag-<?php echo smarty_modifier_lower($this->_tpl_vars['selected_id']); ?>
 cm-external-click" rev="sw_select_<?php echo $this->_tpl_vars['selected_id']; ?>
_wrap_<?php echo $this->_tpl_vars['suffix']; ?>
" ></i>
	<?php endif; ?>
	
	<a class="select-link cm-combo-on cm-combination" id="sw_select_<?php echo $this->_tpl_vars['selected_id']; ?>
_wrap_<?php echo $this->_tpl_vars['suffix']; ?>
"><span><?php echo $this->_tpl_vars['items'][$this->_tpl_vars['selected_id']][$this->_tpl_vars['key_name']]; ?>
<?php if ($this->_tpl_vars['items'][$this->_tpl_vars['selected_id']]['symbol']): ?> (<?php echo smarty_modifier_unescape($this->_tpl_vars['items'][$this->_tpl_vars['selected_id']]['symbol']); ?>
)<?php endif; ?></span></a>

	<div id="select_<?php echo $this->_tpl_vars['selected_id']; ?>
_wrap_<?php echo $this->_tpl_vars['suffix']; ?>
" class="select-popup cm-popup-box cm-smart-position hidden">
		<ul class="cm-select-list flags">
			<?php $_from = $this->_tpl_vars['items']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['id'] => $this->_tpl_vars['item']):
?>
				<li><a rel="nofollow" name="<?php echo $this->_tpl_vars['id']; ?>
" href="<?php echo fn_url(($this->_tpl_vars['link_tpl']).($this->_tpl_vars['id'])); ?>
" class="<?php if ($this->_tpl_vars['display_icons'] == true): ?>item-link<?php endif; ?> <?php if ($this->_tpl_vars['selected_id'] == $this->_tpl_vars['id']): ?>active<?php endif; ?>">
					<?php if ($this->_tpl_vars['display_icons'] == true): ?>
						<i class="flag flag-<?php echo smarty_modifier_lower($this->_tpl_vars['id']); ?>
"></i>
					<?php endif; ?>
					<?php echo smarty_modifier_unescape($this->_tpl_vars['item'][$this->_tpl_vars['key_name']]); ?>
<?php if ($this->_tpl_vars['item']['symbol']): ?> (<?php echo smarty_modifier_unescape($this->_tpl_vars['item']['symbol']); ?>
)<?php endif; ?></a></li>
			<?php endforeach; endif; unset($_from); ?>
		</ul>
	</div>
<?php else: ?>
	<?php if ($this->_tpl_vars['text']): ?><label for="id_<?php echo $this->_tpl_vars['var_name']; ?>
"><?php echo $this->_tpl_vars['text']; ?>
:</label><?php endif; ?>
	<select id="id_<?php echo $this->_tpl_vars['var_name']; ?>
" name="<?php echo $this->_tpl_vars['var_name']; ?>
" onchange="$.redirect(this.value);" class="valign">
		<?php $_from = $this->_tpl_vars['items']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['id'] => $this->_tpl_vars['item']):
?>
			<option value="<?php echo fn_url(($this->_tpl_vars['link_tpl']).($this->_tpl_vars['id'])); ?>
" <?php if ($this->_tpl_vars['id'] == $this->_tpl_vars['selected_id']): ?>selected="selected"<?php endif; ?>><?php echo smarty_modifier_unescape($this->_tpl_vars['item'][$this->_tpl_vars['key_name']]); ?>
</option>
		<?php endforeach; endif; unset($_from); ?>
	</select>
<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?></div>
	<?php endif; ?>
<?php endif; ?>

<!--languages_<?php echo $this->_tpl_vars['block']['block_id']; ?>
--></div><?php  ob_end_flush();  ?>