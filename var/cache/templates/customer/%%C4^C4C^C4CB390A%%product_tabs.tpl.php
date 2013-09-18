<?php /* Smarty version 2.6.18, created on 2013-09-16 17:11:15
         compiled from views/tabs/components/product_tabs.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'block', 'views/tabs/components/product_tabs.tpl', 22, false),array('function', 'script', 'views/tabs/components/product_tabs.tpl', 54, false),array('modifier', 'trim', 'views/tabs/components/product_tabs.tpl', 28, false),array('modifier', 'empty_tabs', 'views/tabs/components/product_tabs.tpl', 49, false),array('modifier', 'in_array', 'views/tabs/components/product_tabs.tpl', 58, false),array('modifier', 'fn_url', 'views/tabs/components/product_tabs.tpl', 63, false),)), $this); ?>
<?php 

				$rname = !empty($resource_name) ? $resource_name : $params['smarty_include_tpl_file'];
				if ($this->compile_check && empty($inline_no_check[$rname]) && $this->is_cached($rname)) {
					if ($this->check_inline_blocks(array (
  'common_templates/tabsbox.tpl' => 1367063745,
))) {
						$_smarty_compile_path = $this->_get_compile_path($rname);
						$this->_compile_resource($rname, $_smarty_compile_path);
						$inline_no_check[$rname] = true;
						include $_smarty_compile_path;
						return;
					}
				}
			 ?><?php ob_start(); ?>
	<?php $_from = $this->_tpl_vars['tabs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['tab_id'] => $this->_tpl_vars['tab']):
?>
		<?php if ($this->_tpl_vars['tab']['show_in_popup'] != 'Y' && $this->_tpl_vars['tab']['status'] == 'A'): ?>
			<?php $this->assign('tab_content_capture', "tab_content_capture_".($this->_tpl_vars['tab_id']), false); ?>

			<?php ob_start(); ?>
				<?php if ($this->_tpl_vars['tab']['tab_type'] == 'B'): ?>
					<?php echo smarty_function_block(array('block_id' => $this->_tpl_vars['tab']['block_id'],'dispatch' => "products.view"), $this);?>

				<?php elseif ($this->_tpl_vars['tab']['tab_type'] == 'T'): ?>
					<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => $this->_tpl_vars['tab']['template'], 'smarty_include_vars' => array('product_tab_id' => $this->_tpl_vars['tab']['html_id'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				<?php endif; ?>
			<?php $this->_smarty_vars['capture'][$this->_tpl_vars['tab_content_capture']] = ob_get_contents(); ob_end_clean(); ?>

			<?php if (trim($this->_smarty_vars['capture'][$this->_tpl_vars['tab_content_capture']])): ?>
				<?php if ($this->_tpl_vars['settings']['Appearance']['product_details_in_tab'] == 'N'): ?>
					<h1 class="tab-list-title"><?php echo $this->_tpl_vars['tab']['name']; ?>
</h1>
				<?php endif; ?>
			<?php endif; ?>

			<div id="content_<?php echo $this->_tpl_vars['tab']['html_id']; ?>
" class="wysiwyg-content">
				<?php echo $this->_smarty_vars['capture'][$this->_tpl_vars['tab_content_capture']]; ?>

			</div>
		<?php endif; ?>
	<?php endforeach; endif; unset($_from); ?>
<?php $this->_smarty_vars['capture']['tabsbox'] = ob_get_contents(); ob_end_clean(); ?>

<?php ob_start(); ?>
<?php if ($this->_tpl_vars['settings']['Appearance']['product_details_in_tab'] == 'Y'): ?>
	<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('content' => $this->_smarty_vars['capture']['tabsbox'], )); ?><?php if (! $this->_tpl_vars['active_tab']): ?>
	<?php $this->assign('active_tab', $this->_tpl_vars['_REQUEST']['selected_section'], false); ?>
<?php endif; ?>

<?php if ($this->_tpl_vars['navigation']['tabs']): ?>

<?php $this->assign('empty_tab_ids', smarty_modifier_empty_tabs($this->_tpl_vars['content']), false); ?>
<?php $this->assign('_tabs', false, false); ?>

<?php if ($this->_tpl_vars['top_order_actions']): ?><?php echo $this->_tpl_vars['top_order_actions']; ?>
<?php endif; ?>

<?php echo smarty_function_script(array('src' => "js/tabs.js"), $this);?>

<div class="tabs cm-j-tabs<?php if ($this->_tpl_vars['track']): ?> cm-track<?php endif; ?> clearfix">
	<ul <?php if ($this->_tpl_vars['tabs_section']): ?>id="tabs_<?php echo $this->_tpl_vars['tabs_section']; ?>
"<?php endif; ?>>
	<?php $_from = $this->_tpl_vars['navigation']['tabs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['tabs'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['tabs']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['tab']):
        $this->_foreach['tabs']['iteration']++;
?>
		<?php if (( ( ! $this->_tpl_vars['tabs_section'] && ! $this->_tpl_vars['tab']['section'] ) || ( $this->_tpl_vars['tabs_section'] == $this->_tpl_vars['tab']['section'] ) ) && ! smarty_modifier_in_array($this->_tpl_vars['key'], $this->_tpl_vars['empty_tab_ids'])): ?>
		<?php if (! $this->_tpl_vars['active_tab']): ?>
			<?php $this->assign('active_tab', $this->_tpl_vars['key'], false); ?>
		<?php endif; ?>
		<?php $this->assign('_tabs', true, false); ?>
		<li id="<?php echo $this->_tpl_vars['key']; ?>
" class="<?php if ($this->_tpl_vars['tab']['js']): ?>cm-js<?php elseif ($this->_tpl_vars['tab']['ajax']): ?>cm-js cm-ajax<?php endif; ?><?php if ($this->_tpl_vars['key'] == $this->_tpl_vars['active_tab']): ?> cm-active<?php endif; ?>"><a<?php if ($this->_tpl_vars['tab']['href']): ?> href="<?php echo fn_url($this->_tpl_vars['tab']['href']); ?>
"<?php endif; ?>><?php echo $this->_tpl_vars['tab']['title']; ?>
</a></li>
		<?php endif; ?>
	<?php endforeach; endif; unset($_from); ?>
	</ul>
</div>

<?php if ($this->_tpl_vars['_tabs']): ?>
<div class="cm-tabs-content clearfix" id="tabs_content">
	<?php echo $this->_tpl_vars['content']; ?>

</div>
<?php endif; ?>

<?php if ($this->_tpl_vars['onclick']): ?>
<script type="text/javascript">
//<![CDATA[
	var hndl = <?php echo $this->_tpl_vars['ldelim']; ?>

		'tabs_<?php echo $this->_tpl_vars['tabs_section']; ?>
': <?php echo $this->_tpl_vars['onclick']; ?>

	<?php echo $this->_tpl_vars['rdelim']; ?>

//]]>
</script>
<?php endif; ?>
<?php else: ?>
	<?php echo $this->_tpl_vars['content']; ?>

<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
<?php else: ?>
	<?php echo $this->_smarty_vars['capture']['tabsbox']; ?>

<?php endif; ?>
<?php $this->_smarty_vars['capture']['tabsbox_content'] = ob_get_contents(); ob_end_clean(); ?>