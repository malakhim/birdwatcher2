<?php /* Smarty version 2.6.18, created on 2013-06-14 13:08:07
         compiled from main.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'defined', 'main.tpl', 15, false),array('modifier', 'fn_get_notifications', 'main.tpl', 24, false),array('modifier', 'lower', 'main.tpl', 26, false),array('modifier', 'is_array', 'main.tpl', 58, false),array('modifier', 'reset', 'main.tpl', 59, false),array('modifier', 'fn_revisions_is_active', 'main.tpl', 63, false),array('modifier', 'fn_url', 'main.tpl', 72, false),array('modifier', 'unescape', 'main.tpl', 93, false),array('modifier', 'strip_tags', 'main.tpl', 93, false),array('block', 'notes', 'main.tpl', 52, false),array('block', 'hook', 'main.tpl', 71, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('close','close','note','you_are_editing_revision','active','if_press_save','note','back_to'));
?>
<?php 

				$rname = !empty($resource_name) ? $resource_name : $params['smarty_include_tpl_file'];
				if ($this->compile_check && empty($inline_no_check[$rname]) && $this->is_cached($rname)) {
					if ($this->check_inline_blocks(array (
  'common_templates/notification.tpl' => 1367063753,
))) {
						$_smarty_compile_path = $this->_get_compile_path($rname);
						$this->_compile_resource($rname, $_smarty_compile_path);
						$inline_no_check[$rname] = true;
						include $_smarty_compile_path;
						return;
					}
				}
			 ?><?php if ($this->_tpl_vars['auth']['user_id'] && $this->_tpl_vars['view_mode'] != 'simple' && ! defined('COMPANY_ID')): ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/quick_menu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php endif; ?>

<?php ob_start(); ?>
	<?php if ($this->_tpl_vars['auth']['user_id'] && $this->_tpl_vars['view_mode'] != 'simple'): ?>
		<?php $__parent_tpl_vars = $this->_tpl_vars; ?><?php if (! defined('AJAX_REQUEST')): ?>

<?php ob_start(); ?>
<?php $_from = fn_get_notifications(""); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['message']):
?>
<div class="notification-content<?php if ($this->_tpl_vars['message']['message_state'] == 'I'): ?> cm-auto-hide<?php endif; ?><?php if ($this->_tpl_vars['message']['message_state'] == 'S'): ?> cm-ajax-close-notification<?php endif; ?>" id="notification_<?php echo $this->_tpl_vars['key']; ?>
">
	<div class="notification-<?php echo smarty_modifier_lower($this->_tpl_vars['message']['type']); ?>
">
		<img id="close_notification_<?php echo $this->_tpl_vars['key']; ?>
" class="cm-notification-close hand" src="<?php echo $this->_tpl_vars['images_dir']; ?>
/icons/icon_close.gif" width="13" height="13" border="0" alt="<?php echo fn_get_lang_var('close', $this->getLanguage()); ?>
" title="<?php echo fn_get_lang_var('close', $this->getLanguage()); ?>
" />
		<div class="notification-header-<?php echo smarty_modifier_lower($this->_tpl_vars['message']['type']); ?>
"><?php echo $this->_tpl_vars['message']['title']; ?>
</div>
		<div>
			<?php echo $this->_tpl_vars['message']['message']; ?>

		</div>
	</div>
	
</div>
<?php endforeach; endif; unset($_from); ?>
<?php $this->_smarty_vars['capture']['notification_content'] = ob_get_contents(); ob_end_clean(); ?>

<?php if ($this->_tpl_vars['auth']['user_id'] && $this->_tpl_vars['view_mode'] != 'simple'): ?>
	<?php echo $this->_smarty_vars['capture']['notification_content']; ?>

<?php endif; ?>

<div class="cm-notification-container <?php if (! ( $this->_tpl_vars['auth']['user_id'] && $this->_tpl_vars['view_mode'] != 'simple' )): ?>cm-notification-container-top<?php endif; ?>">
	<?php if (! ( $this->_tpl_vars['auth']['user_id'] && $this->_tpl_vars['view_mode'] != 'simple' )): ?>
		<?php echo $this->_smarty_vars['capture']['notification_content']; ?>

	<?php endif; ?>
</div>

<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
	<?php endif; ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => $this->_tpl_vars['content_tpl'], 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $this->_smarty_vars['capture']['content'] = ob_get_contents(); ob_end_clean(); ?>
<?php $this->_tag_stack[] = array('notes', array('assign' => 'notes')); $_block_repeat=true;smarty_block_notes($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_notes($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

<table cellpadding="0" cellspacing="0" border="0" class="content-table">
<tr valign="top">
	<td width="1px" class="side-menu">
	<div id="right_column">
		<?php if ($this->_tpl_vars['_REQUEST']['rev'] && is_array($this->_tpl_vars['_REQUEST']['rev'])): ?>
			<?php $this->assign('rev_id', reset($this->_tpl_vars['_REQUEST']['rev_id']), false); ?>
			<?php $this->assign('rev', reset($this->_tpl_vars['_REQUEST']['rev']), false); ?>
			<div class="notes">
				<h5><?php echo fn_get_lang_var('note', $this->getLanguage()); ?>
:</h5>
				<?php echo fn_get_lang_var('you_are_editing_revision', $this->getLanguage()); ?>
 <span class="strong">#<?php echo $this->_tpl_vars['rev']; ?>
</span> <?php if ($this->_tpl_vars['rev_id'] && smarty_modifier_fn_revisions_is_active($this->_tpl_vars['rev_id'], $this->_tpl_vars['rev'])): ?>(<?php echo fn_get_lang_var('active', $this->getLanguage()); ?>
) <?php endif; ?><?php echo fn_get_lang_var('if_press_save', $this->getLanguage()); ?>

			</div>
		<?php endif; ?>

		<?php if ($this->_tpl_vars['navigation'] && $this->_tpl_vars['navigation']['dynamic']['sections']): ?>
			<div id="navigation" class="cm-j-tabs">
				<ul>
					<?php $_from = $this->_tpl_vars['navigation']['dynamic']['sections']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['first_level'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['first_level']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['s_id'] => $this->_tpl_vars['m']):
        $this->_foreach['first_level']['iteration']++;
?>
						<?php $this->_tag_stack[] = array('hook', array('name' => "index:dynamic_menu_item")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
						<li class="<?php if ($this->_tpl_vars['m']['js'] == true): ?>cm-js<?php endif; ?><?php if (($this->_foreach['first_level']['iteration'] == $this->_foreach['first_level']['total'])): ?> cm-last-item<?php endif; ?><?php if ($this->_tpl_vars['navigation']['dynamic']['active_section'] == $this->_tpl_vars['s_id']): ?> cm-active<?php endif; ?>"><span><a href="<?php echo fn_url($this->_tpl_vars['m']['href']); ?>
"><?php echo $this->_tpl_vars['m']['title']; ?>
</a></span></li>
						<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
					<?php endforeach; endif; unset($_from); ?>
				</ul>
			</div>
		<?php endif; ?>

		<?php if ($this->_tpl_vars['notes']): ?>
			<?php $_from = $this->_tpl_vars['notes']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['title'] => $this->_tpl_vars['note']):
?>
			<div class="notes">
				<h5><?php if ($this->_tpl_vars['title'] == '_note_'): ?><?php echo fn_get_lang_var('note', $this->getLanguage()); ?>
<?php else: ?><?php echo $this->_tpl_vars['title']; ?>
<?php endif; ?>:</h5>
				<?php echo $this->_tpl_vars['note']; ?>

			</div>
			<?php endforeach; endif; unset($_from); ?>
		<?php endif; ?>
	</div>
	</td>
	<td class="<?php if (! $this->_tpl_vars['auth']['user_id'] || $this->_tpl_vars['view_mode'] == 'simple'): ?>login-page<?php else: ?>content<?php endif; ?>">
		<?php if ($this->_tpl_vars['auth']['user_id'] && $this->_tpl_vars['view_mode'] != 'simple'): ?>
			<div class="mainbox-breadcrumbs">
				<?php if ($this->_tpl_vars['breadcrumbs']): ?>
					<?php $_from = $this->_tpl_vars['breadcrumbs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['f_b'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['f_b']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['b']):
        $this->_foreach['f_b']['iteration']++;
?><a class="back-link" href="<?php echo fn_url($this->_tpl_vars['b']['link']); ?>
"><?php if (($this->_foreach['f_b']['iteration'] <= 1)): ?>&laquo; <?php echo fn_get_lang_var('back_to', $this->getLanguage()); ?>
:&nbsp;<?php endif; ?><?php echo smarty_modifier_strip_tags(smarty_modifier_unescape($this->_tpl_vars['b']['title'])); ?>
</a><?php if (! ($this->_foreach['f_b']['iteration'] == $this->_foreach['f_b']['total'])): ?>&nbsp;|&nbsp;<?php endif; ?><?php endforeach; endif; unset($_from); ?>
				<?php endif; ?>
			</div>
		<?php endif; ?>
		<?php $this->_tag_stack[] = array('hook', array('name' => "index:main_content")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

		<div id="main_column<?php if (! $this->_tpl_vars['auth']['user_id'] || $this->_tpl_vars['view_mode'] == 'simple'): ?>_login<?php endif; ?>" class="clear">
			<?php echo $this->_smarty_vars['capture']['content']; ?>

		<!--main_column<?php if (! $this->_tpl_vars['auth']['user_id'] || $this->_tpl_vars['view_mode'] == 'simple'): ?>_login<?php endif; ?>--></div>
	</td>
<?php if (( $this->_tpl_vars['navigation'] && $this->_tpl_vars['navigation']['dynamic']['sections'] ) || $this->_tpl_vars['notes']): ?>
<?php endif; ?>
</tr>
</table>