<?php /* Smarty version 2.6.18, created on 2013-06-01 19:33:00
         compiled from C:/wamp5/www/dutchme2/skins/basic/customer/blocks/wrappers/mainbox_general.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'trim', 'C:/wamp5/www/dutchme2/skins/basic/customer/blocks/wrappers/mainbox_general.tpl', 1, false),array('modifier', 'unescape', 'C:/wamp5/www/dutchme2/skins/basic/customer/blocks/wrappers/mainbox_general.tpl', 17, false),array('block', 'hook', 'C:/wamp5/www/dutchme2/skins/basic/customer/blocks/wrappers/mainbox_general.tpl', 8, false),)), $this); ?>
<?php  ob_start();  ?><?php if (trim($this->_tpl_vars['content'])): ?>
	<?php if ($this->_tpl_vars['anchor']): ?>
	<a name="<?php echo $this->_tpl_vars['anchor']; ?>
"></a>
	<?php endif; ?>
	<div class="mainbox-container clearfix<?php if ($this->_tpl_vars['details_page']): ?> details-page<?php endif; ?><?php if ($this->_tpl_vars['block']['user_class']): ?> <?php echo $this->_tpl_vars['block']['user_class']; ?>
<?php endif; ?><?php if ($this->_tpl_vars['content_alignment'] == 'RIGHT'): ?> float-right<?php elseif ($this->_tpl_vars['content_alignment'] == 'LEFT'): ?> float-left<?php endif; ?>">
		<?php if ($this->_tpl_vars['title'] || trim($this->_smarty_vars['capture']['title'])): ?>
			<h1 class="mainbox-title">
				<?php $this->_tag_stack[] = array('hook', array('name' => "wrapper:mainbox_general_title")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
				<?php if (trim($this->_smarty_vars['capture']['title'])): ?>
					<?php echo $this->_smarty_vars['capture']['title']; ?>

				<?php else: ?>
					<span><?php echo $this->_tpl_vars['title']; ?>
</span>
				<?php endif; ?>
				<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
			</h1>
		<?php endif; ?>
		<div class="mainbox-body"><?php echo smarty_modifier_unescape($this->_tpl_vars['content']); ?>
</div>
	</div>
<?php endif; ?><?php  ob_end_flush();  ?>