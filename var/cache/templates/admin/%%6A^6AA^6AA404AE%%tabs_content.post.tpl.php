<?php /* Smarty version 2.6.18, created on 2014-02-03 15:24:49
         compiled from addons/form_builder/hooks/pages/tabs_content.post.tpl */ ?>
<?php
fn_preload_lang_vars(array('form_submit_text','email_to','form_is_secure'));
?>
<?php if ($this->_tpl_vars['page_type'] == @PAGE_TYPE_FORM): ?>
<div id="content_build_form">

	<div class="form-field">
		<label for="form_submit_text"><?php echo fn_get_lang_var('form_submit_text', $this->getLanguage()); ?>
:</label>
		<?php $this->assign('form_submit_const', @FORM_SUBMIT, false); ?>
		<textarea id="form_submit_text" class="cm-wysiwyg input-textarea-long" rows="5" cols="50" name="page_data[form][general][<?php echo $this->_tpl_vars['form_submit_const']; ?>
]" rows="5"><?php echo $this->_tpl_vars['form'][$this->_tpl_vars['form_submit_const']]; ?>
</textarea>
		
	</div>

	<div class="form-field">
		<label for="form_recipient" class="cm-required"><?php echo fn_get_lang_var('email_to', $this->getLanguage()); ?>
:</label>
		<?php $this->assign('form_recipient_const', @FORM_RECIPIENT, false); ?>
		<input id="form_recipient" class="input-text" name="page_data[form][general][<?php echo $this->_tpl_vars['form_recipient_const']; ?>
]" value="<?php echo $this->_tpl_vars['form'][$this->_tpl_vars['form_recipient_const']]; ?>
" />
	</div>

	<div class="form-field">
		<label for="form_is_secure"><?php echo fn_get_lang_var('form_is_secure', $this->getLanguage()); ?>
:</label>
		<?php $this->assign('form_secure_const', @FORM_IS_SECURE, false); ?>
		<input type="hidden" name="page_data[form][general][<?php echo @FORM_IS_SECURE; ?>
]" value="N" />
		<input type="checkbox" id="form_is_secure" class="checkbox" value="Y" <?php if ($this->_tpl_vars['form'][$this->_tpl_vars['form_secure_const']] == 'Y'): ?>checked="checked"<?php endif; ?> name="page_data[form][general][<?php echo $this->_tpl_vars['form_secure_const']; ?>
]" />
	</div>

	<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/form_builder/views/pages/components/pages_form_elements.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

</div>
<?php endif; ?>