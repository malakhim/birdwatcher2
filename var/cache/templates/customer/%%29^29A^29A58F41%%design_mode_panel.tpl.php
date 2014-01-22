<?php /* Smarty version 2.6.18, created on 2014-01-21 22:57:01
         compiled from common_templates/design_mode_panel.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'defined', 'common_templates/design_mode_panel.tpl', 1, false),array('modifier', 'fn_url', 'common_templates/design_mode_panel.tpl', 6, false),array('modifier', 'trim', 'common_templates/design_mode_panel.tpl', 18, false),array('function', 'set_id', 'common_templates/design_mode_panel.tpl', 18, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('customization_mode','translate_mode','switch_to_translation_mode','switch_to_customization_mode'));
?>
<?php  ob_start();  ?><?php ob_start(); ?><div id="design_mode_panel" class="popup <?php if (defined('CUSTOMIZATION_MODE')): ?>customization<?php else: ?>translate<?php endif; ?>-mode" style="<?php if ($_COOKIE['design_mode_panel_offset']): ?><?php echo $_COOKIE['design_mode_panel_offset']; ?>
<?php endif; ?>">
	<div>
		<h1><?php if (defined('CUSTOMIZATION_MODE')): ?><?php echo fn_get_lang_var('customization_mode', $this->getLanguage()); ?>
<?php else: ?><?php echo fn_get_lang_var('translate_mode', $this->getLanguage()); ?>
<?php endif; ?></h1>
	</div>
	<div>
		<form action="<?php echo fn_url(""); ?>
" method="post" name="design_mode_panel_form">
			<input type="hidden" name="design_mode" value="<?php if (defined('CUSTOMIZATION_MODE')): ?>translation_mode<?php else: ?>customization_mode<?php endif; ?>" />
			<input type="hidden" name="current_url" value="<?php echo $this->_tpl_vars['config']['current_url']; ?>
" />
			<input type="submit" name="dispatch[design_mode.update_design_mode]" value="" class="hidden" />
			<?php if (defined('CUSTOMIZATION_MODE')): ?>
				<?php $this->assign('mode_val', fn_get_lang_var('switch_to_translation_mode', $this->getLanguage()), false); ?>
			<?php else: ?>
				<?php $this->assign('mode_val', fn_get_lang_var('switch_to_customization_mode', $this->getLanguage()), false); ?>
			<?php endif; ?>
			<p class="right"><a class="cm-submit" name="dispatch[design_mode.update_design_mode]" rev="design_mode_panel_form"><?php echo $this->_tpl_vars['mode_val']; ?>
</a></p>
		</form>
	</div>
</div><?php $this->_smarty_vars['capture']['template_content'] = ob_get_contents(); ob_end_clean(); ?><?php if (trim($this->_smarty_vars['capture']['template_content'])): ?><?php if ($this->_tpl_vars['auth']['area'] == 'A'): ?><span class="cm-template-box" template="common_templates/design_mode_panel.tpl" id="<?php echo smarty_function_set_id(array('name' => "common_templates/design_mode_panel.tpl"), $this);?>
"><img class="cm-template-icon hidden" src="<?php echo $this->_tpl_vars['images_dir']; ?>
/icons/layout_edit.gif" width="16" height="16" alt="" /><?php echo $this->_smarty_vars['capture']['template_content']; ?>
<!--[/tpl_id]--></span><?php else: ?><?php echo $this->_smarty_vars['capture']['template_content']; ?>
<?php endif; ?><?php endif; ?><?php  ob_end_flush();  ?>