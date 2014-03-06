<?php /* Smarty version 2.6.18, created on 2014-03-06 20:02:59
         compiled from views/products/components/product_subscribers.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'fn_url', 'views/products/components/product_subscribers.tpl', 17, false),array('modifier', 'escape', 'views/products/components/product_subscribers.tpl', 34, false),array('modifier', 'fn_check_view_permissions', 'views/products/components/product_subscribers.tpl', 65, false),array('modifier', 'substr_count', 'views/products/components/product_subscribers.tpl', 69, false),array('modifier', 'replace', 'views/products/components/product_subscribers.tpl', 70, false),array('modifier', 'default', 'views/products/components/product_subscribers.tpl', 75, false),array('modifier', 'defined', 'views/products/components/product_subscribers.tpl', 82, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('check_uncheck_all','email','delete','no_data','add_subscribers_from_users','delete_selected','choose_action','or','tools','add','email','new_subscribers','add_subscriber'));
?>
<?php 

				$rname = !empty($resource_name) ? $resource_name : $params['smarty_include_tpl_file'];
				if ($this->compile_check && empty($inline_no_check[$rname]) && $this->is_cached($rname)) {
					if ($this->check_inline_blocks(array (
  'common_templates/tools.tpl' => 1367063753,
))) {
						$_smarty_compile_path = $this->_get_compile_path($rname);
						$this->_compile_resource($rname, $_smarty_compile_path);
						$inline_no_check[$rname] = true;
						include $_smarty_compile_path;
						return;
					}
				}
			 ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/products/components/search_product_subscribers.tpl", 'smarty_include_vars' => array('dispatch' => "products.update")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<form action="<?php echo fn_url(""); ?>
" method="post" name="subscribers_form">

<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/pagination.tpl", 'smarty_include_vars' => array('save_current_page' => true,'div_id' => 'product_subscribers')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<table cellpadding="0" cellspacing="0" border="0" width="100%" class="table">
<tr>
	<th class="center" width="1%">
		<input type="checkbox" name="check_all" value="Y" title="<?php echo fn_get_lang_var('check_uncheck_all', $this->getLanguage()); ?>
" class="checkbox cm-check-items" /></th>
	<th width="50%"><?php echo fn_get_lang_var('email', $this->getLanguage()); ?>
</th>
	<th>&nbsp;</th>
</tr>
<?php $_from = $this->_tpl_vars['product_subscribers']['subscribers']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['s']):
?>
<tbody class="hover">
<tr>
	<td class="center">
   		<input type="checkbox" name="subscriber_ids[]" value="<?php echo $this->_tpl_vars['s']['subscriber_id']; ?>
" class="checkbox cm-item" /></td>
	<td><input type="hidden" name="subscribers[<?php echo $this->_tpl_vars['s']['subscriber_id']; ?>
][email]" value="<?php echo $this->_tpl_vars['s']['email']; ?>
" />
		<a href="mailto:<?php echo smarty_modifier_escape($this->_tpl_vars['s']['email'], 'url'); ?>
"><?php echo $this->_tpl_vars['s']['email']; ?>
</a></td>
		<input type="hidden" name="product_id" value="<?php echo $this->_tpl_vars['product_id']; ?>
" />
	<td class="nowrap">
		<?php ob_start(); ?>
		<li><a class="cm-confirm" href="<?php echo fn_url("products.update&product_id=".($this->_tpl_vars['product_id'])."&selected_section=subscribers&deleted_subscription_id=".($this->_tpl_vars['s']['subscriber_id'])); ?>
"><?php echo fn_get_lang_var('delete', $this->getLanguage()); ?>
</a></li>
		<?php $this->_smarty_vars['capture']['tools_items'] = ob_get_contents(); ob_end_clean(); ?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/table_tools_list.tpl", 'smarty_include_vars' => array('prefix' => $this->_tpl_vars['s']['subscriber_id'],'tools_list' => $this->_smarty_vars['capture']['tools_items'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</td>
</tr>
</tbody>
<?php endforeach; else: ?>
<tr class="no-items">
	<td colspan="5"><p><?php echo fn_get_lang_var('no_data', $this->getLanguage()); ?>
</p></td>
</tr>
<?php endif; unset($_from); ?>
</table>

<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/pagination.tpl", 'smarty_include_vars' => array('div_id' => 'product_subscribers')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "pickers/users_picker.tpl", 'smarty_include_vars' => array('data_id' => 'subscr_user','picker_for' => 'subscribers','extra_var' => "dispatch=products.update&product_id=".($this->_tpl_vars['product_id'])."&selected_section=subscribers",'but_text' => fn_get_lang_var('add_subscribers_from_users', $this->getLanguage()),'view_mode' => 'button')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

</form>

<div class="buttons-container buttons-bg">
	<?php if ($this->_tpl_vars['product_subscribers']['subscribers']): ?>
	<div class="float-left">
		<?php ob_start(); ?>
		<ul>
			<li><a name="dispatch[products.update]" class="cm-process-items cm-confirm" rev="subscribers_form"><?php echo fn_get_lang_var('delete_selected', $this->getLanguage()); ?>
</a></li>
		</ul>
		<?php $this->_smarty_vars['capture']['tools_list'] = ob_get_contents(); ob_end_clean(); ?>
		<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('prefix' => 'subscribers', 'hide_actions' => true, 'tools_list' => $this->_smarty_vars['capture']['tools_list'], 'display' => 'inline', 'link_text' => fn_get_lang_var('choose_action', $this->getLanguage()), )); ?><?php if ($this->_tpl_vars['skip_check_permissions'] || fn_check_view_permissions($this->_tpl_vars['tools_list'])): ?>

<?php if ($this->_tpl_vars['tools_list'] && $this->_tpl_vars['prefix'] == 'main' && ! $this->_tpl_vars['only_popup']): ?> <?php echo fn_get_lang_var('or', $this->getLanguage()); ?>
 <?php endif; ?>

<?php if (substr_count($this->_tpl_vars['tools_list'], "<li") == 1): ?>
	<?php echo smarty_modifier_replace($this->_tpl_vars['tools_list'], "<ul>", "<ul class=\"cm-tools-list tools-list\">"); ?>

<?php else: ?>
	<div class="tools-container<?php if ($this->_tpl_vars['display']): ?> <?php echo $this->_tpl_vars['display']; ?>
<?php endif; ?>">
		<?php if (! $this->_tpl_vars['hide_tools'] && $this->_tpl_vars['tools_list']): ?>
		<div class="tools-content<?php if ($this->_tpl_vars['display']): ?> <?php echo $this->_tpl_vars['display']; ?>
<?php endif; ?>">
			<a class="cm-combo-on cm-combination <?php if ($this->_tpl_vars['override_meta']): ?><?php echo $this->_tpl_vars['override_meta']; ?>
<?php else: ?>select-button<?php endif; ?><?php if ($this->_tpl_vars['link_meta']): ?> <?php echo $this->_tpl_vars['link_meta']; ?>
<?php endif; ?>" id="sw_tools_list_<?php echo $this->_tpl_vars['prefix']; ?>
"><?php echo smarty_modifier_default(@$this->_tpl_vars['link_text'], fn_get_lang_var('tools', $this->getLanguage())); ?>
</a>
			<div id="tools_list_<?php echo $this->_tpl_vars['prefix']; ?>
" class="cm-tools-list popup-tools hidden cm-popup-box cm-smart-position">
					<?php echo $this->_tpl_vars['tools_list']; ?>

			</div>
		</div>
		<?php endif; ?>
		<?php if (! $this->_tpl_vars['hide_actions']): ?>
			<?php if (! ( defined('COMPANY_ID') && ! fn_check_view_permissions($this->_tpl_vars['tool_href']) )): ?>
				<span class="action-add">
					<a<?php if ($this->_tpl_vars['tool_id']): ?> id="<?php echo $this->_tpl_vars['tool_id']; ?>
"<?php endif; ?><?php if ($this->_tpl_vars['tool_href']): ?> href="<?php echo fn_url($this->_tpl_vars['tool_href']); ?>
"<?php endif; ?><?php if ($this->_tpl_vars['tool_onclick']): ?> onclick="<?php echo $this->_tpl_vars['tool_onclick']; ?>
; return false;"<?php endif; ?>><?php echo smarty_modifier_default(@$this->_tpl_vars['link_text'], fn_get_lang_var('add', $this->getLanguage())); ?>
</a>
				</span>
			<?php endif; ?>
		<?php endif; ?>
	</div>
<?php endif; ?>

<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
	</div>
	<?php endif; ?>
	<div class="float-right">
		<?php ob_start(); ?>
		<form action="<?php echo fn_url("products.update&product_id=".($this->_tpl_vars['product_id'])."&selected_section=subscribers"); ?>
" method="post" name="subscribers_form_0" class="cm-form-highlight">
		
		<div class="cm-tabs-content" id="content_tab_user_details">
			<fieldset>
				<div class="form-field">
					<label for="users_email" class="cm-required cm-email"><?php echo fn_get_lang_var('email', $this->getLanguage()); ?>
:</label>
					<input type="text" name="add_users_email" id="users_email" value="" class="input-text-large main-input" />
					<input type="hidden" name="add_users[0]" id="users_id" value="0" class="" />
				</div>
			</fieldset>
		</div>

		<div class="buttons-container">
			<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/save_cancel.tpl", 'smarty_include_vars' => array('but_name' => "dispatch[products.update]",'create' => true,'cancel_action' => 'close')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</div>

		</form>
		<?php $this->_smarty_vars['capture']['new_email_picker'] = ob_get_contents(); ob_end_clean(); ?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/popupbox.tpl", 'smarty_include_vars' => array('id' => 'add_new_subscribers','text' => fn_get_lang_var('new_subscribers', $this->getLanguage()),'content' => $this->_smarty_vars['capture']['new_email_picker'],'link_text' => fn_get_lang_var('add_subscriber', $this->getLanguage()),'act' => 'general')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</div>
</div>