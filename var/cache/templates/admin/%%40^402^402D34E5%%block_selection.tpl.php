<?php /* Smarty version 2.6.18, created on 2013-09-28 16:53:07
         compiled from views/block_manager/block_selection.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'views/block_manager/block_selection.tpl', 1, false),array('modifier', 'replace', 'views/block_manager/block_selection.tpl', 29, false),array('modifier', 'truncate', 'views/block_manager/block_selection.tpl', 38, false),array('function', 'script', 'views/block_manager/block_selection.tpl', 17, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('manage_existing_block','use_existing_block','create_new_block','delete_block'));
?>
<?php  ob_start();  ?><?php 

				$rname = !empty($resource_name) ? $resource_name : $params['smarty_include_tpl_file'];
				if ($this->compile_check && empty($inline_no_check[$rname]) && $this->is_cached($rname)) {
					if ($this->check_inline_blocks(array (
  'views/block_manager/components/existing_blocks_list.tpl' => 1367063754,
))) {
						$_smarty_compile_path = $this->_get_compile_path($rname);
						$this->_compile_resource($rname, $_smarty_compile_path);
						$inline_no_check[$rname] = true;
						include $_smarty_compile_path;
						return;
					}
				}
			 ?><link href="<?php echo $this->_tpl_vars['config']['skin_path']; ?>
/block_manager.css" rel="stylesheet" type="text/css"/>

<?php echo smarty_function_script(array('src' => "js/tabs.js"), $this);?>


<div class="tabs cm-j-tabs">
	<ul>
		<li id="user_existing_blocks_<?php echo $this->_tpl_vars['grid_id']; ?>
<?php echo $this->_tpl_vars['extra_id']; ?>
" class="cm-js cm-active"><a><?php if ($this->_tpl_vars['_REQUEST']['manage'] && $this->_tpl_vars['_REQUEST']['manage'] == 'Y'): ?><?php echo fn_get_lang_var('manage_existing_block', $this->getLanguage()); ?>
<?php else: ?><?php echo fn_get_lang_var('use_existing_block', $this->getLanguage()); ?>
<?php endif; ?></a></li>
		<li id="create_new_blocks_<?php echo $this->_tpl_vars['grid_id']; ?>
<?php echo $this->_tpl_vars['extra_id']; ?>
" class="cm-js"><a><?php echo fn_get_lang_var('create_new_block', $this->getLanguage()); ?>
</a></li>
	</ul>
</div>

<div class="cm-tabs-content tabs_content_blocks" id="tabs_content_blocks_<?php echo $this->_tpl_vars['grid_id']; ?>
<?php echo $this->_tpl_vars['extra_id']; ?>
">
	<div id="content_create_new_blocks_<?php echo $this->_tpl_vars['grid_id']; ?>
<?php echo $this->_tpl_vars['extra_id']; ?>
">
		<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('manage' => smarty_modifier_default(@$this->_tpl_vars['_REQUEST']['manage'], ""), )); ?><?php $_from = $this->_tpl_vars['block_types']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['new_blocks'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['new_blocks']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['type'] => $this->_tpl_vars['block']):
        $this->_foreach['new_blocks']['iteration']++;
?>
	<div class="select-block select-block-<?php echo smarty_modifier_replace($this->_tpl_vars['block']['type'], '_', "-"); ?>
 cm-add-block bm-action-new-block <?php if ($this->_tpl_vars['manage'] == 'Y'): ?>bm-manage<?php endif; ?>">
		<input type="hidden" name="block_data[type]" value="<?php echo $this->_tpl_vars['type']; ?>
" />
		<input type="hidden" name="block_data[grid_id]" value="<?php echo $this->_tpl_vars['grid_id']; ?>
" />
		
		<div class="select-block-box">
			<div class="select-block-icon"></div>
		</div>
                
		<div class="select-block-description">
			<strong title="<?php echo $this->_tpl_vars['block']['name']; ?>
"><?php echo smarty_modifier_truncate($this->_tpl_vars['block']['name'], 25, "&hellip;", true); ?>
</strong>
			<?php $this->assign('block_description', "block_".($this->_tpl_vars['block']['type'])."_description", false); ?>
			<p><?php echo fn_get_lang_var($this->_tpl_vars['block_description'], $this->getLanguage()); ?>
</p>
		</div>
	</div>
<?php endforeach; endif; unset($_from); ?><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
	<!--content_create_new_blocks--></div>

	<div id="content_user_existing_blocks_<?php echo $this->_tpl_vars['grid_id']; ?>
<?php echo $this->_tpl_vars['extra_id']; ?>
">
		<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('manage' => smarty_modifier_default(@$this->_tpl_vars['_REQUEST']['manage'], ""), )); ?><?php $_from = $this->_tpl_vars['unique_blocks']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['existing_blocks'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['existing_blocks']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['block']):
        $this->_foreach['existing_blocks']['iteration']++;
?>
	<?php if ($this->_tpl_vars['block_types'][$this->_tpl_vars['block']['type']]): ?>
		<div class="select-block select-block-<?php echo smarty_modifier_replace($this->_tpl_vars['block']['type'], '_', "-"); ?>
 cm-add-block bm-action-existing-block <?php if ($this->_tpl_vars['manage'] == 'Y'): ?>bm-manage<?php endif; ?>">
			<input type="hidden" name="block_id" value="<?php echo $this->_tpl_vars['block']['block_id']; ?>
" />
			<input type="hidden" name="grid_id" value="<?php echo smarty_modifier_default(@$this->_tpl_vars['grid_id'], '0'); ?>
" />
			<input type="hidden" name="type" value="<?php echo $this->_tpl_vars['block']['type']; ?>
" />
			<a class="select-block-remove cm-remove-block" title="<?php echo fn_get_lang_var('delete_block', $this->getLanguage()); ?>
"></a>
			<div class="select-block-box">
				<div class="select-block-icon"></div>
			</div>
			<div class="select-block-description">
				<strong title="<?php echo $this->_tpl_vars['block']['name']; ?>
"><?php echo smarty_modifier_truncate($this->_tpl_vars['block']['name'], 25, "&hellip;", true); ?>
</strong>
				<?php $this->assign('block_description', "block_".($this->_tpl_vars['block']['type'])."_description", false); ?>
				<p><?php echo fn_get_lang_var($this->_tpl_vars['block_description'], $this->getLanguage()); ?>
</p>
			</div>
		</div>
	<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
	<!--content_user_existing_blocks--></div>
</div><?php  ob_end_flush();  ?>