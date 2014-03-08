<?php /* Smarty version 2.6.18, created on 2014-03-08 11:26:09
         compiled from C:/wamp5/www/dutchme2/skins/basic/customer/common_templates/breadcrumbs.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'sizeof', 'C:/wamp5/www/dutchme2/skins/basic/customer/common_templates/breadcrumbs.tpl', 3, false),array('modifier', 'fn_url', 'C:/wamp5/www/dutchme2/skins/basic/customer/common_templates/breadcrumbs.tpl', 11, false),array('modifier', 'unescape', 'C:/wamp5/www/dutchme2/skins/basic/customer/common_templates/breadcrumbs.tpl', 11, false),array('modifier', 'strip_tags', 'C:/wamp5/www/dutchme2/skins/basic/customer/common_templates/breadcrumbs.tpl', 11, false),array('modifier', 'escape', 'C:/wamp5/www/dutchme2/skins/basic/customer/common_templates/breadcrumbs.tpl', 11, false),)), $this); ?>
<?php  ob_start();  ?><div id="breadcrumbs_<?php echo $this->_tpl_vars['block']['block_id']; ?>
">

<?php if ($this->_tpl_vars['breadcrumbs'] && sizeof($this->_tpl_vars['breadcrumbs']) > 1): ?>
	<div class="breadcrumbs clearfix">
		<?php echo ''; ?><?php $_from = $this->_tpl_vars['breadcrumbs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['bcn'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['bcn']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['bc']):
        $this->_foreach['bcn']['iteration']++;
?><?php echo ''; ?><?php if ($this->_tpl_vars['key'] != '0'): ?><?php echo '<img src="'; ?><?php echo $this->_tpl_vars['images_dir']; ?><?php echo '/icons/breadcrumbs_arrow.gif" class="bc-arrow" border="0" alt="&gt;" />'; ?><?php endif; ?><?php echo ''; ?><?php if ($this->_tpl_vars['bc']['link']): ?><?php echo '<a href="'; ?><?php echo fn_url($this->_tpl_vars['bc']['link']); ?><?php echo '"'; ?><?php if ($this->_tpl_vars['additional_class']): ?><?php echo ' class="'; ?><?php echo $this->_tpl_vars['additional_class']; ?><?php echo '"'; ?><?php endif; ?><?php echo ''; ?><?php if ($this->_tpl_vars['bc']['nofollow']): ?><?php echo ' rel="nofollow"'; ?><?php endif; ?><?php echo '>'; ?><?php echo smarty_modifier_escape(smarty_modifier_strip_tags(smarty_modifier_unescape($this->_tpl_vars['bc']['title'])), 'html'); ?><?php echo '</a>'; ?><?php else: ?><?php echo '<span>'; ?><?php echo smarty_modifier_escape(smarty_modifier_strip_tags(smarty_modifier_unescape($this->_tpl_vars['bc']['title'])), 'html'); ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php endforeach; endif; unset($_from); ?><?php echo ''; ?>

	</div>
<?php endif; ?>

<!--breadcrumbs_<?php echo $this->_tpl_vars['block']['block_id']; ?>
--></div>
<?php  ob_end_flush();  ?>