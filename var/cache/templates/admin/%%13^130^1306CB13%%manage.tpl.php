<?php /* Smarty version 2.6.18, created on 2013-09-14 15:57:05
         compiled from views/static_data/manage.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'script', 'views/static_data/manage.tpl', 15, false),array('modifier', 'fn_allow_save_object', 'views/static_data/manage.tpl', 19, false),array('modifier', 'fn_url', 'views/static_data/manage.tpl', 21, false),array('modifier', 'fn_check_view_permissions', 'views/static_data/manage.tpl', 50, false),array('modifier', 'substr_count', 'views/static_data/manage.tpl', 54, false),array('modifier', 'replace', 'views/static_data/manage.tpl', 55, false),array('modifier', 'default', 'views/static_data/manage.tpl', 60, false),array('modifier', 'defined', 'views/static_data/manage.tpl', 67, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('delete_selected','choose_action','or','tools','add'));
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
			 ?><?php echo smarty_function_script(array('src' => "js/tabs.js"), $this);?>


<?php ob_start(); ?>

<div id="static_data_list" class="<?php if (! fn_allow_save_object("", 'static_data', $this->_tpl_vars['section_data']['skip_edition_checking'])): ?> cm-hide-inputs<?php endif; ?>">
<?php if ($this->_tpl_vars['section_data']['multi_level'] == true): ?>
	<form action="<?php echo fn_url(""); ?>
" method="post" name="static_data_tree_form">
	<input name="section" type="hidden" value="<?php echo $this->_tpl_vars['section']; ?>
" />
	<?php if ($this->_tpl_vars['section_data']['owner_object']): ?>	
		<?php $this->assign('request_key', $this->_tpl_vars['section_data']['owner_object']['key'], false); ?>	
		<?php $this->assign('owner_condition', ($this->_tpl_vars['request_key'])."=".($this->_tpl_vars['_REQUEST'][$this->_tpl_vars['request_key']]), false); ?>
		<?php $this->assign('request_value', $this->_tpl_vars['_REQUEST'][$this->_tpl_vars['request_key']], false); ?>

		<input type="hidden" name="<?php echo $this->_tpl_vars['request_key']; ?>
" value="<?php echo $this->_tpl_vars['request_value']; ?>
" />
	<?php else: ?>
		<?php $this->assign('owner_condition', "", false); ?>
	<?php endif; ?>
	
		<div class="items-container multi-level">
			<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/static_data/components/multi_list.tpl", 'smarty_include_vars' => array('items' => $this->_tpl_vars['static_data'],'header' => true)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</div>
<?php else: ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/static_data/components/single_list.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php endif; ?>
<!--static_data_list--></div>

<div class="buttons-container">
	<?php if ($this->_tpl_vars['section_data']['multi_level'] == true): ?>
	<div class="float-left">
		<?php ob_start(); ?>
		<ul>
			<li><a name="dispatch[static_data.m_delete]" class="cm-process-items cm-confirm" rev="static_data_tree_form"><?php echo fn_get_lang_var('delete_selected', $this->getLanguage()); ?>
</a></li>
		</ul>
		<?php $this->_smarty_vars['capture']['tools_list'] = ob_get_contents(); ob_end_clean(); ?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/save.tpl", 'smarty_include_vars' => array('but_name' => "dispatch[static_data.m_update]",'but_role' => 'button_main')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('prefix' => 'main', 'hide_actions' => true, 'tools_list' => $this->_smarty_vars['capture']['tools_list'], 'display' => 'inline', 'link_text' => fn_get_lang_var('choose_action', $this->getLanguage()), )); ?><?php if ($this->_tpl_vars['skip_check_permissions'] || fn_check_view_permissions($this->_tpl_vars['tools_list'])): ?>

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
	</div>
	</form>
	<?php endif; ?>
	<?php ob_start(); ?>
		<?php if (fn_allow_save_object("", 'static_data', $this->_tpl_vars['section_data']['skip_edition_checking'])): ?>
			<?php ob_start(); ?>
				<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/static_data/update.tpl", 'smarty_include_vars' => array('mode' => 'add','static_data' => "")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<?php $this->_smarty_vars['capture']['add_new_picker'] = ob_get_contents(); ob_end_clean(); ?>
			<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/popupbox.tpl", 'smarty_include_vars' => array('id' => 'add_new_section','text' => fn_get_lang_var($this->_tpl_vars['section_data']['add_title'], $this->getLanguage()),'content' => $this->_smarty_vars['capture']['add_new_picker'],'link_text' => fn_get_lang_var($this->_tpl_vars['section_data']['add_button'], $this->getLanguage()),'act' => 'general')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<?php endif; ?>
	<?php $this->_smarty_vars['capture']['tools'] = ob_get_contents(); ob_end_clean(); ?>
</div>

<?php $this->_smarty_vars['capture']['mainbox'] = ob_get_contents(); ob_end_clean(); ?>
<?php if ($this->_tpl_vars['owner_object_name']): ?>
	<?php $this->assign('title', (fn_get_lang_var($this->_tpl_vars['section_data']['mainbox_title'], $this->getLanguage())).": ".($this->_tpl_vars['owner_object_name']), false); ?>
<?php else: ?>
	<?php $this->assign('title', fn_get_lang_var($this->_tpl_vars['section_data']['mainbox_title'], $this->getLanguage()), false); ?>
<?php endif; ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/mainbox.tpl", 'smarty_include_vars' => array('title' => $this->_tpl_vars['title'],'content' => $this->_smarty_vars['capture']['mainbox'],'tools' => $this->_smarty_vars['capture']['tools'],'select_languages' => true)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>