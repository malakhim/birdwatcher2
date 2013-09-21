<?php /* Smarty version 2.6.18, created on 2013-09-21 19:13:57
         compiled from bottom.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'fn_link_attach', 'bottom.tpl', 1, false),array('modifier', 'defined', 'bottom.tpl', 15, false),array('modifier', 'fn_check_view_permissions', 'bottom.tpl', 23, false),array('modifier', 'fn_url', 'bottom.tpl', 26, false),array('modifier', 'sizeof', 'bottom.tpl', 42, false),array('modifier', 'default', 'bottom.tpl', 45, false),array('modifier', 'lower', 'bottom.tpl', 49, false),array('modifier', 'unescape', 'bottom.tpl', 58, false),array('modifier', 'truncate', 'bottom.tpl', 117, false),array('modifier', 'fn_check_meta_redirect', 'bottom.tpl', 130, false),array('block', 'hook', 'bottom.tpl', 109, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('open_store','close_store','live_store_description','live_store','dev_store_description','dev_store','select_descr_lang','select_descr_lang','users_online','cleanup_history','no_items','last_viewed_items'));
?>
<?php  ob_start();  ?><?php 

				$rname = !empty($resource_name) ? $resource_name : $params['smarty_include_tpl_file'];
				if ($this->compile_check && empty($inline_no_check[$rname]) && $this->is_cached($rname)) {
					if ($this->check_inline_blocks(array (
  'common_templates/last_viewed_items.tpl' => 1367063753,
))) {
						$_smarty_compile_path = $this->_get_compile_path($rname);
						$this->_compile_resource($rname, $_smarty_compile_path);
						$inline_no_check[$rname] = true;
						include $_smarty_compile_path;
						return;
					}
				}
			 ?><?php if (defined('DEBUG_MODE')): ?>
<div class="bug-report">
	<input type="button" onclick="window.open('bug_report.php','popupwindow','width=700,height=450,toolbar=yes,status=no,scrollbars=yes,resizable=no,menubar=yes,location=no,direction=no');" value="Report a bug" />
</div>
<?php endif; ?>

<div id="bottom_menu">
	<div class="logo-bottom float-left" title="<?php echo @PRODUCT_NAME; ?>
 <?php if (@PRODUCT_TYPE == 'COMMUNITY'): ?>Community Edition<?php endif; ?><?php if (@PRODUCT_TYPE == 'PROFESSIONAL'): ?>Professional Edition<?php endif; ?><?php if (@PRODUCT_TYPE == 'MULTIVENDOR'): ?>Multi-Vendor Edition<?php endif; ?><?php if (@PRODUCT_TYPE == 'ULTIMATE'): ?>Ultimate Edition<?php endif; ?>">&nbsp;</div>
	<?php if (fn_check_view_permissions("tools.store_mode") && ( @PRODUCT_TYPE != 'ULTIMATE' || @PRODUCT_TYPE == 'ULTIMATE' && defined('COMPANY_ID') )): ?>
	<div class="float-left" id="store_mode">
		<?php if ($this->_tpl_vars['settings']['store_mode'] == 'closed'): ?>
			<a class="cm-ajax cm-confirm text-button" rev="store_mode" href="<?php echo fn_url("tools.store_mode?state=opened"); ?>
"><?php echo fn_get_lang_var('open_store', $this->getLanguage()); ?>
</a>
		<?php else: ?>
			<a class="cm-ajax cm-confirm text-button" rev="store_mode" href="<?php echo fn_url("tools.store_mode?state=closed"); ?>
"><?php echo fn_get_lang_var('close_store', $this->getLanguage()); ?>
</a>
		<?php endif; ?>
	<!--store_mode--></div>
	<div class="float-left" id="store_optimization">
		<?php if ($this->_tpl_vars['settings']['store_optimization'] == 'dev'): ?>
			<a class="cm-ajax cm-confirm text-button" rev="store_optimization" title="<?php echo fn_get_lang_var('live_store_description', $this->getLanguage()); ?>
" href="<?php echo fn_url("tools.store_optimization?state=live"); ?>
"><?php echo fn_get_lang_var('live_store', $this->getLanguage()); ?>
</a>
		<?php else: ?>
			<a class="cm-ajax cm-confirm text-button" rev="store_optimization" title="<?php echo fn_get_lang_var('dev_store_description', $this->getLanguage()); ?>
" href="<?php echo fn_url("tools.store_optimization?state=dev"); ?>
"><?php echo fn_get_lang_var('dev_store', $this->getLanguage()); ?>
</a>
		<?php endif; ?>
	<!--store_optimization--></div>
	<?php endif; ?>
	<?php if ($this->_tpl_vars['auth']['user_id']): ?>
		
		<div class="float-left">
			<?php if (sizeof($this->_tpl_vars['languages']) > 1): ?>
			<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('style' => 'graphic', 'link_tpl' => fn_link_attach($this->_tpl_vars['config']['current_url'], "sl="), 'items' => $this->_tpl_vars['languages'], 'selected_id' => @CART_LANGUAGE, 'display_icons' => true, 'key_name' => 'name', 'language_var_name' => 'sl', 'class' => 'languages', )); ?><?php if (sizeof($this->_tpl_vars['items']) > 1): ?>
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
			<?php endif; ?>
			<?php if (sizeof($this->_tpl_vars['currencies']) > 1): ?>
			<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('style' => 'graphic', 'link_tpl' => fn_link_attach($this->_tpl_vars['config']['current_url'], "currency="), 'items' => $this->_tpl_vars['currencies'], 'selected_id' => $this->_tpl_vars['secondary_currency'], 'display_icons' => false, 'key_name' => 'description', )); ?><?php if (sizeof($this->_tpl_vars['items']) > 1): ?>
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
			<?php endif; ?>
		</div>
		
	<?php endif; ?>
	<?php if (! defined('COMPANY_ID')): ?>
		<div class="float-left">
			<?php $this->_tag_stack[] = array('hook', array('name' => "index:top")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php if ($this->_tpl_vars['addons']['statistics']['status'] == 'A'): ?><?php $__parent_tpl_vars = $this->_tpl_vars; ?><a href="<?php echo fn_url("statistics.visitors?report=online&amp;section=general"); ?>
" class="users-online" title="<?php echo fn_get_lang_var('users_online', $this->getLanguage()); ?>
"><span><?php echo smarty_modifier_default(@$this->_tpl_vars['users_online'], 0); ?>
</span></a><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php endif; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
		</div>
	<?php endif; ?>
	<div class="float-left">
		<?php $__parent_tpl_vars = $this->_tpl_vars; ?><div class="last-items-content cm-popup-box hidden" id="last_edited_items">
<?php if ($this->_tpl_vars['last_edited_items']): ?>
	<ul>
	<?php $_from = $this->_tpl_vars['last_edited_items']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['lnk']):
?>
		<li><a <?php if ($this->_tpl_vars['lnk']['icon']): ?>class="<?php echo $this->_tpl_vars['lnk']['icon']; ?>
"<?php endif; ?> href="<?php echo fn_url($this->_tpl_vars['lnk']['url']); ?>
" title="<?php echo smarty_modifier_unescape($this->_tpl_vars['lnk']['name']); ?>
"><?php echo smarty_modifier_truncate(smarty_modifier_unescape($this->_tpl_vars['lnk']['name']), 40); ?>
</a></li>
	<?php endforeach; endif; unset($_from); ?>
	</ul>
	<p class="float-right"><a class="cm-ajax text-button-edit" href="<?php echo fn_url("tools.cleanup_history"); ?>
" rev="last_edited_items"><?php echo fn_get_lang_var('cleanup_history', $this->getLanguage()); ?>
</a></p>
<?php else: ?>
	<p><span><?php echo fn_get_lang_var('no_items', $this->getLanguage()); ?>
</span></p>
<?php endif; ?>
<!--last_edited_items--></div><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
		<div id="bottom_popup_menu_wrap">
			<a id="sw_last_edited_items" class="cm-combo-on cm-combination" title="<?php echo fn_get_lang_var('last_viewed_items', $this->getLanguage()); ?>
">&nbsp;</a>
		</div>
	</div>
</div>
<?php if (fn_check_meta_redirect($this->_tpl_vars['_REQUEST']['meta_redirect_url'])): ?>
	<meta http-equiv="refresh" content="1;url=<?php echo fn_url(fn_check_meta_redirect($this->_tpl_vars['_REQUEST']['meta_redirect_url'])); ?>
" />
<?php endif; ?>

<?php echo '
<script type="text/javascript">
//<![CDATA[
$(function() {
	if ($.isMobile()) {
		$("#bottom_menu").css("position", "relative");
	}
});
//]]>
</script>
'; ?>

<?php  ob_end_flush();  ?>