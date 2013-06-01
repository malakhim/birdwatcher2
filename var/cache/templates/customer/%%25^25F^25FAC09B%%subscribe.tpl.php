<?php /* Smarty version 2.6.18, created on 2013-06-01 19:33:02
         compiled from C:/wamp5/www/dutchme2/skins/basic/customer/addons/news_and_emails/blocks/static_templates/subscribe.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'fn_url', 'C:/wamp5/www/dutchme2/skins/basic/customer/addons/news_and_emails/blocks/static_templates/subscribe.tpl', 18, false),array('modifier', 'escape', 'C:/wamp5/www/dutchme2/skins/basic/customer/addons/news_and_emails/blocks/static_templates/subscribe.tpl', 25, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('stay_connected','stay_connected_notice','email','enter_email','go'));
?>
<?php  ob_start();  ?><?php 

				$rname = !empty($resource_name) ? $resource_name : $params['smarty_include_tpl_file'];
				if ($this->compile_check && empty($inline_no_check[$rname]) && $this->is_cached($rname)) {
					if ($this->check_inline_blocks(array (
  'buttons/go.tpl' => 1367063745,
))) {
						$_smarty_compile_path = $this->_get_compile_path($rname);
						$this->_compile_resource($rname, $_smarty_compile_path);
						$inline_no_check[$rname] = true;
						include $_smarty_compile_path;
						return;
					}
				}
			 ?><?php if ($this->_tpl_vars['addons']['news_and_emails']): ?>
<div class="subscribe-block">
<form action="<?php echo fn_url(""); ?>
" method="post" name="subscribe_form">
<input type="hidden" name="redirect_url" value="<?php echo $this->_tpl_vars['config']['current_url']; ?>
" />
<input type="hidden" name="newsletter_format" value="2" />
<p><span><?php echo fn_get_lang_var('stay_connected', $this->getLanguage()); ?>
</span></p>
<p class="subscribe-notice"><?php echo fn_get_lang_var('stay_connected_notice', $this->getLanguage()); ?>
</p>
<div class="form-field input-append subscribe">
<label class="cm-required cm-email hidden" for="subscr_email<?php echo $this->_tpl_vars['block']['block_id']; ?>
"><?php echo fn_get_lang_var('email', $this->getLanguage()); ?>
</label>
<input type="text" name="subscribe_email" id="subscr_email<?php echo $this->_tpl_vars['block']['block_id']; ?>
" size="20" value="<?php echo smarty_modifier_escape(fn_get_lang_var('enter_email', $this->getLanguage()), 'html'); ?>
" class="cm-hint subscribe-email input-text input-text-menu" />
<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('but_name' => "newsletters.add_subscriber", 'alt' => fn_get_lang_var('go', $this->getLanguage()), )); ?><button title="<?php echo $this->_tpl_vars['alt']; ?>
" class="go-button" type="submit"><?php if ($this->_tpl_vars['but_text']): ?><?php echo $this->_tpl_vars['but_text']; ?>
<?php endif; ?></button>
<input type="hidden" name="dispatch" value="<?php echo $this->_tpl_vars['but_name']; ?>
" /><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
</div>
</form>
</div>
<?php endif; ?><?php  ob_end_flush();  ?>