<?php /* Smarty version 2.6.18, created on 2014-03-06 16:42:25
         compiled from views/addons/update.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'script', 'views/addons/update.tpl', 3, false),array('modifier', 'fn_get_all_states', 'views/addons/update.tpl', 7, false),array('modifier', 'escape', 'views/addons/update.tpl', 13, false),array('modifier', 'count', 'views/addons/update.tpl', 25, false),array('modifier', 'fn_url', 'views/addons/update.tpl', 35, false),array('modifier', 'cat', 'views/addons/update.tpl', 54, false),)), $this); ?>
<?php $this->assign('_addon', $this->_tpl_vars['_REQUEST']['addon'], false); ?>
<?php if ($this->_tpl_vars['separate']): ?>
	<?php echo smarty_function_script(array('src' => "js/tabs.js"), $this);?>

	<?php echo smarty_function_script(array('src' => "js/profiles_scripts.js"), $this);?>

	<script type="text/javascript">
		//<![CDATA[
		<?php $this->assign('states', fn_get_all_states(@CART_LANGUAGE, false, true), false); ?>
		var states = new Array();
		<?php if ($this->_tpl_vars['states']): ?>
		<?php $_from = $this->_tpl_vars['states']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['country_code'] => $this->_tpl_vars['country_states']):
?>
		states['<?php echo $this->_tpl_vars['country_code']; ?>
'] = new Array();
		<?php $_from = $this->_tpl_vars['country_states']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['fs'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['fs']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['state']):
        $this->_foreach['fs']['iteration']++;
?>
		states['<?php echo $this->_tpl_vars['country_code']; ?>
']['<?php echo smarty_modifier_escape($this->_tpl_vars['state']['code'], 'quotes'); ?>
'] = '<?php echo smarty_modifier_escape($this->_tpl_vars['state']['state'], 'javascript'); ?>
';
		<?php endforeach; endif; unset($_from); ?>
		<?php endforeach; endif; unset($_from); ?>
		<?php endif; ?>
		//]]>
	</script>
	
	<h1 class="mainbox-title">
		<?php echo $this->_tpl_vars['addon_name']; ?>

	</h1>
<?php endif; ?>
<div id="content_group<?php echo $this->_tpl_vars['_addon']; ?>
">
	<div class="tabs cm-j-tabs <?php if (count($this->_tpl_vars['subsections']) == 1): ?>hidden<?php endif; ?>">
		<ul>
			<?php $_from = $this->_tpl_vars['subsections']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['section'] => $this->_tpl_vars['subs']):
?>
				<?php $this->assign('tab_id', ($this->_tpl_vars['_addon'])."_".($this->_tpl_vars['section']), false); ?>
				<li class="cm-js <?php if ($this->_tpl_vars['_REQUEST']['selected_section'] == $this->_tpl_vars['tab_id']): ?>cm-active<?php endif; ?>" id="<?php echo $this->_tpl_vars['tab_id']; ?>
"><a><?php echo $this->_tpl_vars['subs']['description']; ?>
</a></li>
			<?php endforeach; endif; unset($_from); ?>
		</ul>
	</div>
	<div class="cm-tabs-content" id="tabs_content_<?php echo $this->_tpl_vars['_addon']; ?>
">

		<form action="<?php echo fn_url(""); ?>
" method="post" name="update_addon_<?php echo $this->_tpl_vars['_addon']; ?>
_form" class="cm-form-highlight" enctype="multipart/form-data">
		<input type="hidden" name="addon" value="<?php echo $this->_tpl_vars['_REQUEST']['addon']; ?>
" />
		
		<?php $_from = $this->_tpl_vars['options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['section'] => $this->_tpl_vars['field_item']):
?>
		
		<?php if ($this->_tpl_vars['subsections'][$this->_tpl_vars['section']]['type'] == 'SEPARATE_TAB'): ?>
			<?php ob_start(); ?>
		<?php endif; ?>

		<div id="content_<?php echo $this->_tpl_vars['_addon']; ?>
_<?php echo $this->_tpl_vars['section']; ?>
" class="settings<?php if ($this->_tpl_vars['subsections'][$this->_tpl_vars['section']]['type'] == 'SEPARATE_TAB'): ?> cm-hide-save-button<?php endif; ?>">
			<fieldset>
				<?php $_from = $this->_tpl_vars['field_item']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['fe_addons'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['fe_addons']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['name'] => $this->_tpl_vars['data']):
        $this->_foreach['fe_addons']['iteration']++;
?>
					<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/settings_fields.tpl", 'smarty_include_vars' => array('item' => $this->_tpl_vars['data'],'section' => $this->_tpl_vars['_addon'],'html_id' => "addon_option_".($this->_tpl_vars['_addon'])."_".($this->_tpl_vars['data']['name']),'html_name' => "addon_data[options][".($this->_tpl_vars['data']['object_id'])."]")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				<?php endforeach; endif; unset($_from); ?>
			</fieldset>
		</div>
		
		<?php if ($this->_tpl_vars['subsections'][$this->_tpl_vars['section']]['type'] == 'SEPARATE_TAB'): ?>
			<?php $this->_smarty_vars['capture']['separate_section'] = ob_get_contents(); ob_end_clean(); ?>
			<?php $this->assign('sep_sections', smarty_modifier_cat($this->_tpl_vars['sep_sections'], $this->_smarty_vars['capture']['separate_section']), false); ?>
		<?php endif; ?>
		<?php endforeach; endif; unset($_from); ?>
		
		<div class="buttons-container<?php if ($this->_tpl_vars['separate']): ?> buttons-bg<?php endif; ?> cm-toggle-button">
			<?php if ($this->_tpl_vars['separate']): ?>
				<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/save_cancel.tpl", 'smarty_include_vars' => array('but_name' => "dispatch[addons.update]",'hide_second_button' => true,'breadcrumbs' => $this->_tpl_vars['breadcrumbs'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<?php else: ?>
				<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/save_cancel.tpl", 'smarty_include_vars' => array('but_name' => "dispatch[addons.update]",'cancel_action' => 'close')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<?php endif; ?>
		</div>

		</form> 

		<?php echo $this->_tpl_vars['sep_sections']; ?>

	</div>

<!--content_group<?php echo $this->_tpl_vars['_addon']; ?>
--></div>