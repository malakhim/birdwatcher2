<?php /* Smarty version 2.6.18, created on 2014-01-25 16:30:48
         compiled from C:/wamp5/www/dutchme2/skins/basic/customer/blocks/static_templates/404.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'fn_url', 'C:/wamp5/www/dutchme2/skins/basic/customer/blocks/static_templates/404.tpl', 6, false),array('modifier', 'trim', 'C:/wamp5/www/dutchme2/skins/basic/customer/blocks/static_templates/404.tpl', 48, false),array('function', 'set_id', 'C:/wamp5/www/dutchme2/skins/basic/customer/blocks/static_templates/404.tpl', 48, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('exception_error','exception_title','access_denied_text','page_not_found_text','exception_error_code','access_denied','page_not_found','go_to_the_homepage','go_back'));
?>
<?php  ob_start();  ?><?php ob_start(); ?><div class="exception">
	<span class="exception-code"> <?php echo $this->_tpl_vars['exception_status']; ?>
 <em><?php echo fn_get_lang_var('exception_error', $this->getLanguage()); ?>
</em> </span>
<h1><?php echo fn_get_lang_var('exception_title', $this->getLanguage()); ?>
</h1>
<p>
	<?php if (@HTTPS === true): ?>
		<?php $this->assign('return_url', fn_url($this->_tpl_vars['config']['https_location']), false); ?>
	<?php else: ?>
		<?php $this->assign('return_url', fn_url($this->_tpl_vars['config']['http_location']), false); ?>
	<?php endif; ?>
	
	<?php if ($this->_tpl_vars['exception_status'] == '403'): ?>
		<?php echo fn_get_lang_var('access_denied_text', $this->getLanguage()); ?>

	<?php elseif ($this->_tpl_vars['exception_status'] == '404'): ?>
		<?php echo fn_get_lang_var('page_not_found_text', $this->getLanguage()); ?>

	<?php endif; ?>

</p>
<p><?php echo fn_get_lang_var('exception_error_code', $this->getLanguage()); ?>

	<?php if ($this->_tpl_vars['exception_status'] == '403'): ?>
		<?php echo fn_get_lang_var('access_denied', $this->getLanguage()); ?>

	<?php elseif ($this->_tpl_vars['exception_status'] == '404'): ?>
		<?php echo fn_get_lang_var('page_not_found', $this->getLanguage()); ?>

	<?php endif; ?>
</p>
	<ul>
		<li><a href="<?php echo $this->_tpl_vars['return_url']; ?>
"><?php echo fn_get_lang_var('go_to_the_homepage', $this->getLanguage()); ?>
</a></li>
		<li id="go_back"><a onclick="history.go(-1);"><?php echo fn_get_lang_var('go_back', $this->getLanguage()); ?>
</a></li>
	</ul>
</div>
<script type="text/javascript">
	//<![CDATA[
	<?php echo '
	$(function() {
		$.each($.browser, function(i, val) {
			if ((i == \'opera\') && (val == true)) {
				if (history.length == 0) {
					$(\'#go_back\').hide();
				}
			} else {
				if (history.length == 1) {
					$(\'#go_back\').hide();
				}
			}
		});
	});
	'; ?>

	//]]>
</script><?php $this->_smarty_vars['capture']['template_content'] = ob_get_contents(); ob_end_clean(); ?><?php if (trim($this->_smarty_vars['capture']['template_content'])): ?><?php if ($this->_tpl_vars['auth']['area'] == 'A'): ?><span class="cm-template-box" template="blocks/static_templates/404.tpl" id="<?php echo smarty_function_set_id(array('name' => "blocks/static_templates/404.tpl"), $this);?>
"><img class="cm-template-icon hidden" src="<?php echo $this->_tpl_vars['images_dir']; ?>
/icons/layout_edit.gif" width="16" height="16" alt="" /><?php echo $this->_smarty_vars['capture']['template_content']; ?>
<!--[/tpl_id]--></span><?php else: ?><?php echo $this->_smarty_vars['capture']['template_content']; ?>
<?php endif; ?><?php endif; ?><?php  ob_end_flush();  ?>