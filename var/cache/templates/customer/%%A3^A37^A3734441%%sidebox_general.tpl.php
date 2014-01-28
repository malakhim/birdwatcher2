<?php /* Smarty version 2.6.18, created on 2014-01-28 16:51:10
         compiled from C:/wamp5/www/dutchme2/skins/basic/customer/blocks/wrappers/sidebox_general.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'trim', 'C:/wamp5/www/dutchme2/skins/basic/customer/blocks/wrappers/sidebox_general.tpl', 1, false),array('modifier', 'default', 'C:/wamp5/www/dutchme2/skins/basic/customer/blocks/wrappers/sidebox_general.tpl', 2, false),array('modifier', 'unescape', 'C:/wamp5/www/dutchme2/skins/basic/customer/blocks/wrappers/sidebox_general.tpl', 12, false),array('block', 'hook', 'C:/wamp5/www/dutchme2/skins/basic/customer/blocks/wrappers/sidebox_general.tpl', 4, false),array('function', 'set_id', 'C:/wamp5/www/dutchme2/skins/basic/customer/blocks/wrappers/sidebox_general.tpl', 14, false),)), $this); ?>
<?php  ob_start();  ?><?php ob_start(); ?><?php if (trim($this->_tpl_vars['content'])): ?>
	<div class="<?php echo smarty_modifier_default(@$this->_tpl_vars['sidebox_wrapper'], "sidebox-wrapper"); ?>
 <?php if ($this->_tpl_vars['hide_wrapper']): ?>hidden cm-hidden-wrapper<?php endif; ?><?php if ($this->_tpl_vars['block']['user_class']): ?> <?php echo $this->_tpl_vars['block']['user_class']; ?>
<?php endif; ?><?php if ($this->_tpl_vars['content_alignment'] == 'RIGHT'): ?> float-right<?php elseif ($this->_tpl_vars['content_alignment'] == 'LEFT'): ?> float-left<?php endif; ?>">
		<h3 class="sidebox-title<?php if ($this->_tpl_vars['header_class']): ?> <?php echo $this->_tpl_vars['header_class']; ?>
<?php endif; ?>">
			<?php $this->_tag_stack[] = array('hook', array('name' => "wrapper:sidebox_general_title")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
			<?php if (trim($this->_smarty_vars['capture']['title'])): ?>
				<?php echo $this->_smarty_vars['capture']['title']; ?>

			<?php else: ?>
				<span><?php echo $this->_tpl_vars['title']; ?>
</span>
			<?php endif; ?>
			<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
		</h3>
		<div class="sidebox-body"><?php echo smarty_modifier_default(smarty_modifier_unescape($this->_tpl_vars['content']), "&nbsp;"); ?>
</div>
	</div>
<?php endif; ?><?php $this->_smarty_vars['capture']['template_content'] = ob_get_contents(); ob_end_clean(); ?><?php if (trim($this->_smarty_vars['capture']['template_content'])): ?><?php if ($this->_tpl_vars['auth']['area'] == 'A'): ?><span class="cm-template-box" template="blocks/wrappers/sidebox_general.tpl" id="<?php echo smarty_function_set_id(array('name' => "blocks/wrappers/sidebox_general.tpl"), $this);?>
"><img class="cm-template-icon hidden" src="<?php echo $this->_tpl_vars['images_dir']; ?>
/icons/layout_edit.gif" width="16" height="16" alt="" /><?php echo $this->_smarty_vars['capture']['template_content']; ?>
<!--[/tpl_id]--></span><?php else: ?><?php echo $this->_smarty_vars['capture']['template_content']; ?>
<?php endif; ?><?php endif; ?><?php  ob_end_flush();  ?>