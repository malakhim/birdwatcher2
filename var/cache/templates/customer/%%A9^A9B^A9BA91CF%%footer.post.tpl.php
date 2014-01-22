<?php /* Smarty version 2.6.18, created on 2014-01-21 22:56:44
         compiled from addons/statistics/hooks/index/footer.post.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'fn_url', 'addons/statistics/hooks/index/footer.post.tpl', 4, false),array('modifier', 'escape', 'addons/statistics/hooks/index/footer.post.tpl', 26, false),array('modifier', 'trim', 'addons/statistics/hooks/index/footer.post.tpl', 28, false),array('function', 'set_id', 'addons/statistics/hooks/index/footer.post.tpl', 28, false),)), $this); ?>
<?php  ob_start();  ?><?php ob_start(); ?><script type="text/javascript">
//<![CDATA[
$(function()<?php echo $this->_tpl_vars['ldelim']; ?>

	$.ajaxRequest('<?php echo fn_url("statistics.collect", 'C', 'rel', '&'); ?>
', <?php echo $this->_tpl_vars['ldelim']; ?>

		method: 'post',
		data: <?php echo $this->_tpl_vars['ldelim']; ?>

			've[url]': location.href,
			've[title]': document.title,
			've[browser_version]': $.ua.version,
			've[browser]': $.ua.browser,
			've[os]': $.ua.os,
			've[client_language]': $.ua.language,
			've[referrer]': document.referrer,
			've[screen_x]': (screen.width || null),
			've[screen_y]': (screen.height || null),
			've[color]': (screen.colorDepth || screen.pixelDepth || null),
			've[time_begin]': <?php echo @MICROTIME; ?>

		<?php echo $this->_tpl_vars['rdelim']; ?>
,
		hidden: true
	<?php echo $this->_tpl_vars['rdelim']; ?>
);
<?php echo $this->_tpl_vars['rdelim']; ?>
);
//]]>
</script>

<noscript>
<?php ob_start(); ?>statistics.collect?ve[url]=<?php echo smarty_modifier_escape(@REAL_URL, 'url'); ?>
&amp;ve[title]=<?php if ($this->_tpl_vars['page_title']): ?><?php echo smarty_modifier_escape($this->_tpl_vars['page_title'], 'url'); ?>
<?php else: ?><?php echo smarty_modifier_escape($this->_tpl_vars['location_data']['page_title'], 'url'); ?>
<?php $_from = $this->_tpl_vars['breadcrumbs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['bkt'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['bkt']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['i']):
        $this->_foreach['bkt']['iteration']++;
?><?php if (($this->_foreach['bkt']['iteration']-1) == 1): ?> - <?php endif; ?><?php if (! ($this->_foreach['bkt']['iteration'] <= 1)): ?><?php echo smarty_modifier_escape($this->_tpl_vars['i']['title'], 'url'); ?>
<?php if (! ($this->_foreach['bkt']['iteration'] == $this->_foreach['bkt']['total'])): ?> :: <?php endif; ?><?php endif; ?><?php endforeach; endif; unset($_from); ?><?php endif; ?>&amp;ve[referrer]=<?php echo smarty_modifier_escape($_SERVER['HTTP_REFERER'], 'url'); ?>
&amp;ve[time_begin]=<?php echo @MICROTIME; ?>
<?php $this->_smarty_vars['capture']['statistics_link'] = ob_get_contents(); ob_end_clean(); ?>
<object data="<?php echo fn_url($this->_smarty_vars['capture']['statistics_link']); ?>
" width="0" height="0"></object>
</noscript><?php $this->_smarty_vars['capture']['template_content'] = ob_get_contents(); ob_end_clean(); ?><?php if (trim($this->_smarty_vars['capture']['template_content'])): ?><?php if ($this->_tpl_vars['auth']['area'] == 'A'): ?><span class="cm-template-box" template="addons/statistics/hooks/index/footer.post.tpl" id="<?php echo smarty_function_set_id(array('name' => "addons/statistics/hooks/index/footer.post.tpl"), $this);?>
"><img class="cm-template-icon hidden" src="<?php echo $this->_tpl_vars['images_dir']; ?>
/icons/layout_edit.gif" width="16" height="16" alt="" /><?php echo $this->_smarty_vars['capture']['template_content']; ?>
<!--[/tpl_id]--></span><?php else: ?><?php echo $this->_smarty_vars['capture']['template_content']; ?>
<?php endif; ?><?php endif; ?><?php  ob_end_flush();  ?>