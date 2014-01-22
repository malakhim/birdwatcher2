<?php /* Smarty version 2.6.18, created on 2014-01-21 22:56:44
         compiled from common_templates/image_verification.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'fn_needs_image_verification', 'common_templates/image_verification.tpl', 1, false),array('modifier', 'uniqid', 'common_templates/image_verification.tpl', 4, false),array('modifier', 'fn_url', 'common_templates/image_verification.tpl', 7, false),array('modifier', 'trim', 'common_templates/image_verification.tpl', 16, false),array('function', 'set_id', 'common_templates/image_verification.tpl', 16, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('image_verification_label','image_verification_body'));
?>
<?php  ob_start();  ?><?php ob_start(); ?><?php if (fn_needs_image_verification("") == true): ?>	
	<?php $this->assign('is', $this->_tpl_vars['settings']['Image_verification'], false); ?>
	
	<?php $this->assign('id_uniqid', uniqid($this->_tpl_vars['id']), false); ?>
	<div class="captcha form-field">
	<?php if ($this->_tpl_vars['sidebox']): ?>
		<p><img id="verification_image_<?php echo $this->_tpl_vars['id']; ?>
" class="image-captcha valign" src="<?php echo fn_url("image.captcha?verification_id=".($this->_tpl_vars['SESS_ID']).":".($this->_tpl_vars['id'])."&amp;".($this->_tpl_vars['id_uniqid'])."&amp;", 'C', 'rel', '&amp;'); ?>
" alt="" onclick="this.src += 'reload' ;" width="<?php echo $this->_tpl_vars['is']['width']; ?>
" height="<?php echo $this->_tpl_vars['is']['height']; ?>
" /></p>
	<?php endif; ?>
		<label for="verification_answer_<?php echo $this->_tpl_vars['id']; ?>
" class="cm-required"><?php echo fn_get_lang_var('image_verification_label', $this->getLanguage()); ?>
</label>
		<input class="captcha-input-text valign cm-autocomplete-off" type="text" id="verification_answer_<?php echo $this->_tpl_vars['id']; ?>
" name="verification_answer" value= "" />
	<?php if (! $this->_tpl_vars['sidebox']): ?>
		<img id="verification_image_<?php echo $this->_tpl_vars['id']; ?>
" class="image-captcha valign" src="<?php echo fn_url("image.captcha?verification_id=".($this->_tpl_vars['SESS_ID']).":".($this->_tpl_vars['id'])."&amp;".($this->_tpl_vars['id_uniqid'])."&amp;", 'C', 'rel', '&amp;'); ?>
" alt="" onclick="this.src += 'reload' ;"  width="<?php echo $this->_tpl_vars['is']['width']; ?>
" height="<?php echo $this->_tpl_vars['is']['height']; ?>
" />
	<?php endif; ?>
	<p<?php if ($this->_tpl_vars['align']): ?> class="<?php echo $this->_tpl_vars['align']; ?>
"<?php endif; ?>><?php echo fn_get_lang_var('image_verification_body', $this->getLanguage()); ?>
</p>
	</div>
<?php endif; ?><?php $this->_smarty_vars['capture']['template_content'] = ob_get_contents(); ob_end_clean(); ?><?php if (trim($this->_smarty_vars['capture']['template_content'])): ?><?php if ($this->_tpl_vars['auth']['area'] == 'A'): ?><span class="cm-template-box" template="common_templates/image_verification.tpl" id="<?php echo smarty_function_set_id(array('name' => "common_templates/image_verification.tpl"), $this);?>
"><img class="cm-template-icon hidden" src="<?php echo $this->_tpl_vars['images_dir']; ?>
/icons/layout_edit.gif" width="16" height="16" alt="" /><?php echo $this->_smarty_vars['capture']['template_content']; ?>
<!--[/tpl_id]--></span><?php else: ?><?php echo $this->_smarty_vars['capture']['template_content']; ?>
<?php endif; ?><?php endif; ?><?php  ob_end_flush();  ?>