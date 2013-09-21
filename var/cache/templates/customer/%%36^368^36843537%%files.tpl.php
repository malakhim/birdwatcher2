<?php /* Smarty version 2.6.18, created on 2013-09-21 19:17:35
         compiled from blocks/product_tabs/files.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'fn_url', 'blocks/product_tabs/files.tpl', 26, false),array('modifier', 'unescape', 'blocks/product_tabs/files.tpl', 31, false),array('modifier', 'formatfilesize', 'blocks/product_tabs/files.tpl', 41, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('filename','filesize','licence_agreement','readme'));
?>
<?php  ob_start();  ?><?php 

				$rname = !empty($resource_name) ? $resource_name : $params['smarty_include_tpl_file'];
				if ($this->compile_check && empty($inline_no_check[$rname]) && $this->is_cached($rname)) {
					if ($this->check_inline_blocks(array (
  'views/products/components/product_files.tpl' => 1367063748,
))) {
						$_smarty_compile_path = $this->_get_compile_path($rname);
						$this->_compile_resource($rname, $_smarty_compile_path);
						$inline_no_check[$rname] = true;
						include $_smarty_compile_path;
						return;
					}
				}
			 ?>
<?php $__parent_tpl_vars = $this->_tpl_vars; ?><?php if ($this->_tpl_vars['files']): ?>
<table cellspacing="1" cellpadding="5" class="table" width="100%">
<tr>
	<th><?php echo fn_get_lang_var('filename', $this->getLanguage()); ?>
</th>
	<th><?php echo fn_get_lang_var('filesize', $this->getLanguage()); ?>
</th>
</tr>
<?php $_from = $this->_tpl_vars['files']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['file']):
?>
<tr>
	<td width="80">
		<a href="<?php echo fn_url("orders.get_file?file_id=".($this->_tpl_vars['file']['file_id'])."&preview=Y"); ?>
"><strong><?php echo $this->_tpl_vars['file']['file_name']; ?>
</strong></a>
		<?php if ($this->_tpl_vars['file']['readme'] || $this->_tpl_vars['file']['license']): ?>
		<ul class="bullets-list">
		<?php if ($this->_tpl_vars['file']['license']): ?>
			<li><a onclick="$('#license_<?php echo $this->_tpl_vars['file']['file_id']; ?>
').toggle(); return false;"><?php echo fn_get_lang_var('licence_agreement', $this->getLanguage()); ?>
</a></li>
			<div class="hidden" id="license_<?php echo $this->_tpl_vars['file']['file_id']; ?>
"><?php echo smarty_modifier_unescape($this->_tpl_vars['file']['license']); ?>
</div>
		<?php endif; ?>
		<?php if ($this->_tpl_vars['file']['readme']): ?>
			<li><a onclick="$('#readme_<?php echo $this->_tpl_vars['file']['file_id']; ?>
').toggle(); return false;"><?php echo fn_get_lang_var('readme', $this->getLanguage()); ?>
</a></li>
			<div class="hidden" id="readme_<?php echo $this->_tpl_vars['file']['file_id']; ?>
"><?php echo smarty_modifier_unescape($this->_tpl_vars['file']['readme']); ?>
</div>
		<?php endif; ?>
		</ul>
		<?php endif; ?>
	</td>
	<td width="20%" valign="top">
		 <strong><?php echo smarty_modifier_formatfilesize($this->_tpl_vars['file']['file_size']); ?>
</strong>
	</td>
<?php endforeach; endif; unset($_from); ?>
</table>
<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php  ob_end_flush();  ?>