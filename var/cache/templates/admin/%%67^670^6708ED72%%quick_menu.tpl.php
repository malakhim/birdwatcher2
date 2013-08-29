<?php /* Smarty version 2.6.18, created on 2013-08-29 15:31:50
         compiled from common_templates/quick_menu.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'fn_link_attach', 'common_templates/quick_menu.tpl', 1, false),array('modifier', 'escape', 'common_templates/quick_menu.tpl', 18, false),array('modifier', 'unescape', 'common_templates/quick_menu.tpl', 22, false),array('modifier', 'default', 'common_templates/quick_menu.tpl', 22, false),array('modifier', 'sizeof', 'common_templates/quick_menu.tpl', 107, false),array('modifier', 'lower', 'common_templates/quick_menu.tpl', 113, false),array('modifier', 'fn_url', 'common_templates/quick_menu.tpl', 122, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('editing_quick_menu_section','editing_quick_menu_link','select_descr_lang','name','link','position','use_current_link','quick_menu','remove_this_item','edit','remove_this_item','edit','add_link','show_menu_on_mouse_over','add_section','done','edit'));
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
			 ?><script type="text/javascript">
//<![CDATA[

lang.editing_quick_menu_section = '<?php echo smarty_modifier_escape(fn_get_lang_var('editing_quick_menu_section', $this->getLanguage()), 'javascript'); ?>
';
lang.editing_quick_menu_link = '<?php echo smarty_modifier_escape(fn_get_lang_var('editing_quick_menu_link', $this->getLanguage()), 'javascript'); ?>
';

// Init ajax callback (rebuild)
var menu_content = <?php echo smarty_modifier_default(smarty_modifier_unescape($this->_tpl_vars['data']), "''"); ?>
;

<?php echo '
function fn_quick_menu_content_switch_callback()
{
	var container = $(\'#quick_menu_content\');
	var scroll_elm = $(\'.menu-container\', container);
	var elm = $(\'#sw_quick_menu_content\').get(0);
	var w = $.get_window_sizes();
	var offset = container.offset();
	var max_height = offset.top - w.offset_y > w.view_height / 2 ? offset.top - w.offset_y - elm.offsetHeight: w.offset_y + w.view_height - offset.top;
	scroll_elm.css(\'height\', \'\');
	if (container.get(0).offsetHeight > max_height) {
		var diff = container.get(0).offsetHeight - scroll_elm.get(0).offsetHeight;
		scroll_elm.css(\'height\', max_height - diff - 10 + \'px\');
	}
	if (offset.top + container.get(0).offsetHeight > w.offset_y + w.view_height) {
		container.css(\'top\', elm.offsetTop - container.get(0).offsetHeight + 1);
		container.addClass(\'quick-menu-bottom\');
	} else {
		container.css(\'top\', elm.offsetTop + elm.offsetHeight - 1);
		container.removeClass(\'quick-menu-bottom\');
	}
	if (offset.left - elm.offsetWidth <= w.offset_x) {
		container.css(\'left\', 0);
	} else {
		container.css(\'left\', elm.offsetLeft + elm.offsetWidth - container.get(0).offsetWidth);
	}
}
'; ?>


var ajax_callback_data = menu_content;

//]]>
</script>

<?php if ($this->_tpl_vars['settings']['Appearance']['show_quick_menu'] == 'Y'): ?>

<div class="quick-menu-container" <?php if ($_COOKIE['quick_menu_offset']): ?>style="<?php echo $_COOKIE['quick_menu_offset']; ?>
"<?php endif; ?> id="quick_menu">
<?php if ($this->_tpl_vars['settings']['show_menu_mouseover'] == 'Y'): ?>
<script type="text/javascript">
//<![CDATA[
<?php echo '
var quick_menu_timer;
function fn_quick_menu_mouse_action(obj, over)
{
	if ($(\'#quick_menu\').data(\'drag\') != true) {
		if (over && !$(\'#quick_menu_content\').is(\':visible\')) {
			$(obj).click();
		}
		if (!over && $(\'#quick_menu_content\').is(\':visible\')) {
			if ($(\'#quick_menu_content\').data(\'over_defined\') != true) {
				$(\'#quick_menu_content\').add($(\'#quick_menu_content\').contents()).mouseover(function() {
					$(\'#quick_menu_content\').data(\'over\', true);
				});
				$(\'#quick_menu_content\').mouseout(function() {
					$(\'#quick_menu_content\').data(\'over\', false);
					clearTimeout(quick_menu_timer);
					quick_menu_timer = setTimeout(function() {
						if ($(\'#quick_menu_content\').data(\'over\') != true) {
							$(obj).click();
						}
					}, 100);
				});
				$(\'#quick_menu_content\').data(\'over_defined\', true);
			}
			if ($(\'#quick_menu_content\').data(\'over\') != true) {
				setTimeout(function() {
					if ($(\'#quick_menu_content\').data(\'over\') != true) {
						$(obj).click();
					}
				}, 100);
			}
		}
	}
}
'; ?>

//]]>
</script>
<?php endif; ?>
<?php if ($this->_tpl_vars['show_quick_popup']): ?>
	<div id="quick_box" class="hidden">

		<div id="quick_menu_language_selector">
			
			<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('style' => 'graphic', 'link_tpl' => fn_link_attach("tools.get_quick_menu_variant", "descr_sl="), 'items' => $this->_tpl_vars['languages'], 'selected_id' => @DESCR_SL, 'key_name' => 'name', 'suffix' => 'quick_menu', 'display_icons' => true, 'select_container_id' => 'quick_menu_language_selector', )); ?><?php if (sizeof($this->_tpl_vars['items']) > 1): ?>
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

		<form class="cm-ajax" name="quick_menu_form" action="<?php echo fn_url(""); ?>
" method="post">
		<input id="qm_item_id" type="hidden" name="item[id]" value="" />
		<input id="qm_item_parent" type="hidden" name="item[parent_id]" value="0" />
		<input id="qm_descr_sl" type="hidden" name="descr_sl" value="" />
		<input type="hidden" name="result_ids" value="quick_menu" />


		<div class="form-field">
			<label class="cm-required" for="qm_item_name"><?php echo fn_get_lang_var('name', $this->getLanguage()); ?>
:</label>
			<input id="qm_item_name" name="item[name]" class="input-text-large main-input" type="text" value="" size="40"/>
		</div>
		
		<div class="form-field">
			<label class="cm-required" for="qm_item_link"><?php echo fn_get_lang_var('link', $this->getLanguage()); ?>
:</label>
			<input id="qm_item_link" name="item[url]" class="input-text-large" type="text" value="" size="40"/>
		</div>
		
		<div class="form-field">
			<label for="qm_item_position"><?php echo fn_get_lang_var('position', $this->getLanguage()); ?>
:</label>
			<input id="qm_item_position" name="item[position]" class="input-text-short" type="text" value="" size="6"/>
		</div>

		<div class="form-field">
			<a id="qm_current_link" class="underline-dashed"><?php echo fn_get_lang_var('use_current_link', $this->getLanguage()); ?>
</a>
		</div>

		<div class="buttons-container">
			<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/save_cancel.tpl", 'smarty_include_vars' => array('but_name' => "dispatch[tools.update_quick_menu_item.edit]",'cancel_action' => 'close')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</div>

		</form>
	</div>
<?php endif; ?>

	<div class="quick-menu">
		<a id="sw_quick_menu_content" class="cm-combo-<?php if ($this->_tpl_vars['edit_quick_menu'] || $this->_tpl_vars['expand_quick_menu']): ?>off<?php else: ?>on<?php endif; ?> cm-combination"<?php if ($this->_tpl_vars['settings']['show_menu_mouseover'] == 'Y'): ?> onmouseover="fn_quick_menu_mouse_action(this, true);" onmouseout="fn_quick_menu_mouse_action(this, false);"<?php endif; ?>><?php echo fn_get_lang_var('quick_menu', $this->getLanguage()); ?>
</a>
	</div>
	
	<div id="quick_menu_content" class="quick-menu-content cm-popup-box<?php if (! $this->_tpl_vars['edit_quick_menu'] && ! $this->_tpl_vars['expand_quick_menu']): ?> hidden<?php endif; ?>">
		<?php if ($this->_tpl_vars['edit_quick_menu']): ?>
		<div class="menu-container">
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
			<?php $_from = $this->_tpl_vars['quick_menu']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['sect_id'] => $this->_tpl_vars['sect']):
?>
				<tr item="<?php echo $this->_tpl_vars['sect_id']; ?>
" parent_id="0" pos="<?php echo $this->_tpl_vars['sect']['section']['position']; ?>
">
					<td class="nowrap section-header">
						<strong class="cm-qm-name"><?php echo $this->_tpl_vars['sect']['section']['name']; ?>
</span><img src="<?php echo $this->_tpl_vars['images_dir']; ?>
/icons/icon_delete.gif" width="12" height="18" border="0" alt="" title="<?php echo fn_get_lang_var('remove_this_item', $this->getLanguage()); ?>
" class="hand valign cm-delete-section" />
					</td>
					<td class="right"><a class="edit cm-update-item"><?php echo fn_get_lang_var('edit', $this->getLanguage()); ?>
</a></td>
				</tr>
				<?php $_from = $this->_tpl_vars['sect']['subsection']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['subsect']):
?>
				<tr item="<?php echo $this->_tpl_vars['subsect']['menu_id']; ?>
" parent_id="<?php echo $this->_tpl_vars['subsect']['parent_id']; ?>
" pos="<?php echo $this->_tpl_vars['subsect']['position']; ?>
">
					<td class="nowrap">
						<a class="cm-qm-name" href="<?php echo fn_url($this->_tpl_vars['subsect']['url']); ?>
"><?php echo $this->_tpl_vars['subsect']['name']; ?>
</a><img src="<?php echo $this->_tpl_vars['images_dir']; ?>
/icons/icon_delete.gif" width="12" height="18" border="0" alt="" title="<?php echo fn_get_lang_var('remove_this_item', $this->getLanguage()); ?>
" class="hand valign cm-delete-section" />
					</td>
					<td class="right"><a class="edit cm-update-item"><?php echo fn_get_lang_var('edit', $this->getLanguage()); ?>
</a></td>
				</tr>
				<?php endforeach; endif; unset($_from); ?>
				<tr item="<?php echo $this->_tpl_vars['sect_id']; ?>
" parent_id="0" pos="<?php echo $this->_tpl_vars['sect']['section']['position']; ?>
">
					<td colspan="2" class="cm-add-link"><a class="edit cm-add-link"><?php echo fn_get_lang_var('add_link', $this->getLanguage()); ?>
</a></td>
				</tr>
			<?php endforeach; endif; unset($_from); ?>
			</table>
		</div>
		<table border="0" cellpadding="0" cellspacing="0" width="100%" class="quick-menu-edit">
			<tr class="done" colspan="2">
				<td>
					<label for="show_menu_mouseover"><?php echo fn_get_lang_var('show_menu_on_mouse_over', $this->getLanguage()); ?>
:</label>
					<input id="show_menu_mouseover" type="checkbox" name="show_menu_mouseover" value="Y" <?php if ($this->_tpl_vars['settings']['show_menu_mouseover'] == 'Y'): ?>checked="checked"<?php endif; ?> onclick="$.ajaxRequest('<?php echo fn_url("tools.update_quick_menu_handler?enable=", 'A', 'rel', '&'); ?>
' + (this.checked ? this.value : 'N'), <?php echo $this->_tpl_vars['ldelim']; ?>
cache: false, result_ids: 'quick_menu', callback: fn_quick_menu_content_switch_callback<?php echo $this->_tpl_vars['rdelim']; ?>
);" />
				</td>
			</tr>
			<tr class="done">
				<td class="nowrap"><a class="edit cm-add-section"><?php echo fn_get_lang_var('add_section', $this->getLanguage()); ?>
</a></td>
				<td class="right">
					<a class="edit cm-ajax" rev="quick_menu" href="<?php echo fn_url("tools.show_quick_menu"); ?>
" name="quick_menu_content_switch_callback"><?php echo fn_get_lang_var('done', $this->getLanguage()); ?>
</a></td>
			</tr>
		</table>
		<?php else: ?>
		<?php if ($this->_tpl_vars['quick_menu']): ?>
		<div class="menu-container">
			<ul>
			<?php $_from = $this->_tpl_vars['quick_menu']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['sect']):
?>
				<li><span><?php echo $this->_tpl_vars['sect']['section']['name']; ?>
</span></li>
				<?php $_from = $this->_tpl_vars['sect']['subsection']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['subsect']):
?>
				<li><a href="<?php echo fn_url($this->_tpl_vars['subsect']['url']); ?>
"><?php echo $this->_tpl_vars['subsect']['name']; ?>
</a></li>
				<?php endforeach; endif; unset($_from); ?>
			<?php endforeach; endif; unset($_from); ?>
			</ul>
		</div>
		<?php endif; ?>
		<p class="right">
			<a <?php if (! $this->_tpl_vars['expand_quick_menu']): ?>class="edit" onclick="$.getScript(current_path + '/js/quick_menu.js');"<?php else: ?>class="edit cm-ajax" href="<?php echo fn_url("tools.show_quick_menu.edit"); ?>
" rev="quick_menu" name="quick_menu_content_switch_callback"<?php endif; ?>><?php echo fn_get_lang_var('edit', $this->getLanguage()); ?>
</a>
		</p>
		<?php endif; ?>
	</div>
<!--quick_menu--></div>
<?php endif; ?>