<?php /* Smarty version 2.6.18, created on 2013-09-21 12:59:25
         compiled from C:/wamp5/www/dutchme2/skins/basic/customer/blocks/wrappers/onclick_dropdown.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'trim', 'C:/wamp5/www/dutchme2/skins/basic/customer/blocks/wrappers/onclick_dropdown.tpl', 1, false),array('modifier', 'unescape', 'C:/wamp5/www/dutchme2/skins/basic/customer/blocks/wrappers/onclick_dropdown.tpl', 14, false),array('modifier', 'default', 'C:/wamp5/www/dutchme2/skins/basic/customer/blocks/wrappers/onclick_dropdown.tpl', 14, false),array('block', 'hook', 'C:/wamp5/www/dutchme2/skins/basic/customer/blocks/wrappers/onclick_dropdown.tpl', 5, false),)), $this); ?>
<?php  ob_start();  ?><?php if (trim($this->_tpl_vars['content'])): ?>
	<?php $this->assign('dropdown_id', $this->_tpl_vars['block']['snapping_id'], false); ?>
	<div class="dropdown-box <?php if ($this->_tpl_vars['block']['user_class']): ?> <?php echo $this->_tpl_vars['block']['user_class']; ?>
<?php endif; ?><?php if ($this->_tpl_vars['content_alignment'] == 'RIGHT'): ?> float-right<?php elseif ($this->_tpl_vars['content_alignment'] == 'LEFT'): ?> float-left<?php endif; ?>">
		<div id="sw_dropdown_<?php echo $this->_tpl_vars['dropdown_id']; ?>
" class="cm-popup-title cm-combination cm-combo-on <?php if ($this->_tpl_vars['header_class']): ?><?php echo $this->_tpl_vars['header_class']; ?>
<?php endif; ?>">
			<?php $this->_tag_stack[] = array('hook', array('name' => "wrapper:onclick_dropdown_title")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
			<?php if (trim($this->_smarty_vars['capture']['title'])): ?>
				<?php echo $this->_smarty_vars['capture']['title']; ?>

			<?php else: ?>
				<a><?php echo $this->_tpl_vars['title']; ?>
</a>
			<?php endif; ?>
			<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
		</div>
		<div id="dropdown_<?php echo $this->_tpl_vars['dropdown_id']; ?>
" class="cm-popup-box popup-content hidden">
			<?php echo smarty_modifier_default(smarty_modifier_unescape($this->_tpl_vars['content']), "&nbsp;"); ?>

		</div>
	</div>
<?php endif; ?><?php  ob_end_flush();  ?>