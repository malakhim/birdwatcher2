<?php /* Smarty version 2.6.18, created on 2013-09-21 19:33:01
         compiled from views/block_manager/components/block_content.tpl */ ?>
<?php echo ''; ?><?php if ($this->_tpl_vars['block_scheme']['content']): ?><?php echo ''; ?><?php $_from = $this->_tpl_vars['block_scheme']['content']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['name'] => $this->_tpl_vars['setting_data']):
?><?php echo ''; ?><?php if ($this->_tpl_vars['setting_data']['type'] != 'function'): ?><?php echo ''; ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/block_manager/components/setting_element.tpl", 'smarty_include_vars' => array('option' => $this->_tpl_vars['setting_data'],'name' => ($this->_tpl_vars['name']),'block' => $this->_tpl_vars['block'],'html_id' => "block_".($this->_tpl_vars['block']['block_id'])."_content_".($this->_tpl_vars['name']),'html_name' => "block_data[content][".($this->_tpl_vars['name'])."]",'editable' => $this->_tpl_vars['editable'],'value' => $this->_tpl_vars['block']['content'][$this->_tpl_vars['name']])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php endforeach; endif; unset($_from); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?>