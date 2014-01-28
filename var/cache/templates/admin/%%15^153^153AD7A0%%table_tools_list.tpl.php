<?php /* Smarty version 2.6.18, created on 2014-01-28 16:50:03
         compiled from common_templates/table_tools_list.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'fn_check_view_permissions', 'common_templates/table_tools_list.tpl', 16, false),array('modifier', 'fn_url', 'common_templates/table_tools_list.tpl', 20, false),array('modifier', 'default', 'common_templates/table_tools_list.tpl', 24, false),array('modifier', 'strpos', 'common_templates/table_tools_list.tpl', 27, false),array('modifier', 'substr_count', 'common_templates/table_tools_list.tpl', 32, false),array('modifier', 'replace', 'common_templates/table_tools_list.tpl', 33, false),array('modifier', 'defined', 'common_templates/table_tools_list.tpl', 45, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('view','edit','more','or','tools','add'));
?>
<?php 

				$rname = !empty($resource_name) ? $resource_name : $params['smarty_include_tpl_file'];
				if ($this->compile_check && empty($inline_no_check[$rname]) && $this->is_cached($rname)) {
					if ($this->check_inline_blocks(array (
  'common_templates/tools.tpl' => 1367063753,
))) {
						$_smarty_compile_path = $this->_get_compile_path($rname);
						$this->_compile_resource($rname, $_smarty_compile_path);
						$inline_no_check[$rname] = true;
						include $_smarty_compile_path;
						return;
					}
				}
			 ?><?php if ($this->_tpl_vars['popup']): ?>
	<?php if ($this->_tpl_vars['skip_check_permissions'] || fn_check_view_permissions($this->_tpl_vars['href'])): ?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/popupbox.tpl", 'smarty_include_vars' => array('id' => $this->_tpl_vars['id'],'text' => $this->_tpl_vars['text'],'link_text' => $this->_tpl_vars['link_text'],'act' => $this->_tpl_vars['act'],'href' => $this->_tpl_vars['href'],'link_class' => $this->_tpl_vars['link_class'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php endif; ?>
<?php elseif ($this->_tpl_vars['href']): ?>
<?php $this->assign('_href', fn_url($this->_tpl_vars['href']), false); ?>
<?php if (! fn_check_view_permissions($this->_tpl_vars['_href'])): ?>
	<?php $this->assign('link_text', fn_get_lang_var('view', $this->getLanguage()), false); ?>
<?php endif; ?>
	<a class="tool-link <?php echo $this->_tpl_vars['extra_class']; ?>
" href="<?php echo $this->_tpl_vars['_href']; ?>
" <?php echo $this->_tpl_vars['link_extra']; ?>
><?php echo smarty_modifier_default(@$this->_tpl_vars['link_text'], fn_get_lang_var('edit', $this->getLanguage())); ?>
</a>
<?php endif; ?>
<?php if ($this->_tpl_vars['skip_check_permissions'] || fn_check_view_permissions($this->_tpl_vars['tools_list'])): ?>
	<?php if (strpos($this->_tpl_vars['tools_list'], "<li")): ?><?php if ($this->_tpl_vars['href']): ?>&nbsp;&nbsp;|<?php elseif ($this->_tpl_vars['separate']): ?>|<?php endif; ?>
		<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('prefix' => $this->_tpl_vars['prefix'], 'hide_actions' => true, 'tools_list' => "<ul>".($this->_tpl_vars['tools_list'])."</ul>", 'display' => 'inline', 'link_text' => fn_get_lang_var('more', $this->getLanguage()), 'link_meta' => 'lowercase', 'skip_check_permissions' => $this->_tpl_vars['skip_check_permissions'], )); ?><?php if ($this->_tpl_vars['skip_check_permissions'] || fn_check_view_permissions($this->_tpl_vars['tools_list'])): ?>

<?php if ($this->_tpl_vars['tools_list'] && $this->_tpl_vars['prefix'] == 'main' && ! $this->_tpl_vars['only_popup']): ?> <?php echo fn_get_lang_var('or', $this->getLanguage()); ?>
 <?php endif; ?>

<?php if (substr_count($this->_tpl_vars['tools_list'], "<li") == 1): ?>
	<?php echo smarty_modifier_replace($this->_tpl_vars['tools_list'], "<ul>", "<ul class=\"cm-tools-list tools-list\">"); ?>

<?php else: ?>
	<div class="tools-container<?php if ($this->_tpl_vars['display']): ?> <?php echo $this->_tpl_vars['display']; ?>
<?php endif; ?>">
		<?php if (! $this->_tpl_vars['hide_tools'] && $this->_tpl_vars['tools_list']): ?>
		<div class="tools-content<?php if ($this->_tpl_vars['display']): ?> <?php echo $this->_tpl_vars['display']; ?>
<?php endif; ?>">
			<a class="cm-combo-on cm-combination <?php if ($this->_tpl_vars['override_meta']): ?><?php echo $this->_tpl_vars['override_meta']; ?>
<?php else: ?>select-button<?php endif; ?><?php if ($this->_tpl_vars['link_meta']): ?> <?php echo $this->_tpl_vars['link_meta']; ?>
<?php endif; ?>" id="sw_tools_list_<?php echo $this->_tpl_vars['prefix']; ?>
"><?php echo smarty_modifier_default(@$this->_tpl_vars['link_text'], fn_get_lang_var('tools', $this->getLanguage())); ?>
</a>
			<div id="tools_list_<?php echo $this->_tpl_vars['prefix']; ?>
" class="cm-tools-list popup-tools hidden cm-popup-box cm-smart-position">
					<?php echo $this->_tpl_vars['tools_list']; ?>

			</div>
		</div>
		<?php endif; ?>
		<?php if (! $this->_tpl_vars['hide_actions']): ?>
			<?php if (! ( defined('COMPANY_ID') && ! fn_check_view_permissions($this->_tpl_vars['tool_href']) )): ?>
				<span class="action-add">
					<a<?php if ($this->_tpl_vars['tool_id']): ?> id="<?php echo $this->_tpl_vars['tool_id']; ?>
"<?php endif; ?><?php if ($this->_tpl_vars['tool_href']): ?> href="<?php echo fn_url($this->_tpl_vars['tool_href']); ?>
"<?php endif; ?><?php if ($this->_tpl_vars['tool_onclick']): ?> onclick="<?php echo $this->_tpl_vars['tool_onclick']; ?>
; return false;"<?php endif; ?>><?php echo smarty_modifier_default(@$this->_tpl_vars['link_text'], fn_get_lang_var('add', $this->getLanguage())); ?>
</a>
				</span>
			<?php endif; ?>
		<?php endif; ?>
	</div>
<?php endif; ?>

<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
	<?php endif; ?>
<?php endif; ?>