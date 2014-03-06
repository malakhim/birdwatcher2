<?php /* Smarty version 2.6.18, created on 2014-03-06 17:03:03
         compiled from common_templates/subheader.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'common_templates/subheader.tpl', 18, false),array('modifier', 'trim', 'common_templates/subheader.tpl', 22, false),array('modifier', 'escape', 'common_templates/subheader.tpl', 23, false),)), $this); ?>
<?php  ob_start();  ?><?php 

				$rname = !empty($resource_name) ? $resource_name : $params['smarty_include_tpl_file'];
				if ($this->compile_check && empty($inline_no_check[$rname]) && $this->is_cached($rname)) {
					if ($this->check_inline_blocks(array (
  'common_templates/tooltip.tpl' => 1367063745,
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
<h2 class="<?php echo smarty_modifier_default(@$this->_tpl_vars['class'], 'subheader'); ?>
">
	<?php echo $this->_tpl_vars['extra']; ?>

	<?php echo $this->_tpl_vars['title']; ?>


	<?php if (trim($this->_tpl_vars['tooltip'])): ?>
		<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('tooltip' => $this->_tpl_vars['tooltip'], )); ?><?php if ($this->_tpl_vars['tooltip']): ?> (<a class="cm-tooltip<?php if ($this->_tpl_vars['params']): ?> <?php echo $this->_tpl_vars['params']; ?>
<?php endif; ?>" title="<?php echo smarty_modifier_escape($this->_tpl_vars['tooltip'], 'html'); ?>
">?</a>)<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
	<?php endif; ?>
</h2><?php  ob_end_flush();  ?>