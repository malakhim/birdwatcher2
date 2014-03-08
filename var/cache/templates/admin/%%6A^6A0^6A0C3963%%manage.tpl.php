<?php /* Smarty version 2.6.18, created on 2014-03-08 11:46:40
         compiled from views/profiles/manage.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'views/profiles/manage.tpl', 22, false),array('modifier', 'fn_url', 'views/profiles/manage.tpl', 59, false),array('modifier', 'defined', 'views/profiles/manage.tpl', 59, false),array('modifier', 'fn_query_remove', 'views/profiles/manage.tpl', 65, false),array('modifier', 'default', 'views/profiles/manage.tpl', 67, false),array('modifier', 'fn_get_company_name', 'views/profiles/manage.tpl', 116, false),array('modifier', 'date_format', 'views/profiles/manage.tpl', 120, false),array('modifier', 'lower', 'views/profiles/manage.tpl', 150, false),array('modifier', 'is_array', 'views/profiles/manage.tpl', 154, false),array('modifier', 'fn_from_json', 'views/profiles/manage.tpl', 155, false),array('modifier', 'trim', 'views/profiles/manage.tpl', 225, false),array('modifier', 'fn_check_rights_delete_user', 'views/profiles/manage.tpl', 300, false),array('modifier', 'unserialize', 'views/profiles/manage.tpl', 304, false),array('modifier', 'fn_check_view_permissions', 'views/profiles/manage.tpl', 369, false),array('modifier', 'substr_count', 'views/profiles/manage.tpl', 395, false),array('modifier', 'replace', 'views/profiles/manage.tpl', 396, false),array('modifier', 'fn_get_user_type_description', 'views/profiles/manage.tpl', 605, false),array('function', 'script', 'views/profiles/manage.tpl', 52, false),array('function', 'cycle', 'views/profiles/manage.tpl', 97, false),array('block', 'hook', 'views/profiles/manage.tpl', 81, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('check_uncheck_all','id','username','name','email','registered','type','status','view','vendor','supplier','administrator','vendor_administrator','customer','affiliate','notify_user','active','hidden','disabled','pending','new','active','disabled','hidden','pending','new','active','disabled','hidden','pending','notify_customer','notify_orders_department','notify_vendor','notify_supplier','view_all_orders','act_on_behalf','delete','points','no_data','select_all','unselect_all','export_selected','remove_this_item','remove_this_item','choose_action','or','tools','add','export_selected','delete_selected','remove_this_item','remove_this_item','choose_action','or','tools','add','add_user','or','tools','add','add_supplier','or','tools','add','or','tools','add','users'));
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
			 ?>
<?php $this->assign('no_hide_input', "cm-no-hide-input", false); ?>


<?php $__parent_tpl_vars = $this->_tpl_vars; ?><script type="text/javascript">
//<![CDATA[

var default_country = '<?php echo smarty_modifier_escape($this->_tpl_vars['settings']['General']['default_country'], 'javascript'); ?>
';
<?php echo '
var zip_validators = {
	US: {
		regex: /^(\\d{5})(-\\d{4})?$/,
		format: \'01342 (01342-5678)\'
	},
	CA: {
		regex: /^(\\w{3} ?\\w{3})$/,
		format: \'K1A OB1 (K1AOB1)\'
	},
	RU: {
		regex: /^(\\d{6})?$/,
		format: \'123456\'
	}
}
'; ?>


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
']['__<?php echo smarty_modifier_escape($this->_tpl_vars['state']['code'], 'quotes'); ?>
'] = '<?php echo smarty_modifier_escape($this->_tpl_vars['state']['state'], 'javascript'); ?>
';
<?php endforeach; endif; unset($_from); ?>
<?php endforeach; endif; unset($_from); ?>
<?php endif; ?>

//]]>
</script>
<?php echo smarty_function_script(array('src' => "js/profiles_scripts.js"), $this);?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>

<?php ob_start(); ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/profiles/components/users_search_form.tpl", 'smarty_include_vars' => array('dispatch' => "profiles.manage")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div id="content_manage_users">
<form action="<?php echo fn_url(""); ?>
" method="post" name="userlist_form" id="userlist_form" class="<?php if (defined('COMPANY_ID') && @PRODUCT_TYPE != 'ULTIMATE'): ?>cm-hide-inputs<?php endif; ?>">
<input type="hidden" name="fake" value="1" />
<input type="hidden" name="user_type" value="<?php echo $this->_tpl_vars['_REQUEST']['user_type']; ?>
" />

<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/pagination.tpl", 'smarty_include_vars' => array('save_current_page' => true,'save_current_url' => true,'div_id' => $this->_tpl_vars['_REQUEST']['content_id'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php $this->assign('c_url', fn_query_remove($this->_tpl_vars['config']['current_url'], 'sort_by', 'sort_order'), false); ?>

<?php $this->assign('rev', smarty_modifier_default(@$this->_tpl_vars['_REQUEST']['content_id'], 'pagination_contents'), false); ?>

<table cellpadding="0" cellspacing="0" border="0" width="100%" class="table sortable">
<tr>
	<th width="1%" class="center <?php echo $this->_tpl_vars['no_hide_input']; ?>
">
		<input type="checkbox" name="check_all" value="Y" title="<?php echo fn_get_lang_var('check_uncheck_all', $this->getLanguage()); ?>
" class="checkbox cm-check-items" /></th>
	<th><a class="cm-ajax<?php if ($this->_tpl_vars['search']['sort_by'] == 'id'): ?> sort-link-<?php echo $this->_tpl_vars['search']['sort_order']; ?>
<?php endif; ?>" href="<?php echo fn_url(($this->_tpl_vars['c_url'])."&amp;sort_by=id&amp;sort_order=".($this->_tpl_vars['search']['sort_order'])); ?>
" rev=<?php echo $this->_tpl_vars['rev']; ?>
><?php echo fn_get_lang_var('id', $this->getLanguage()); ?>
</a></th>
	<?php if ($this->_tpl_vars['settings']['General']['use_email_as_login'] != 'Y'): ?>
	<th width="20%"><a class="cm-ajax<?php if ($this->_tpl_vars['search']['sort_by'] == 'username'): ?> sort-link-<?php echo $this->_tpl_vars['search']['sort_order']; ?>
<?php endif; ?>" href="<?php echo fn_url(($this->_tpl_vars['c_url'])."&amp;sort_by=username&amp;sort_order=".($this->_tpl_vars['search']['sort_order'])); ?>
" rev=<?php echo $this->_tpl_vars['rev']; ?>
><?php echo fn_get_lang_var('username', $this->getLanguage()); ?>
</a></th>
	<?php endif; ?>
	<th width="20%"><a class="cm-ajax<?php if ($this->_tpl_vars['search']['sort_by'] == 'name'): ?> sort-link-<?php echo $this->_tpl_vars['search']['sort_order']; ?>
<?php endif; ?>" href="<?php echo fn_url(($this->_tpl_vars['c_url'])."&amp;sort_by=name&amp;sort_order=".($this->_tpl_vars['search']['sort_order'])); ?>
" rev=<?php echo $this->_tpl_vars['rev']; ?>
><?php echo fn_get_lang_var('name', $this->getLanguage()); ?>
</a></th>
	<th width="20%"><a class="cm-ajax<?php if ($this->_tpl_vars['search']['sort_by'] == 'email'): ?> sort-link-<?php echo $this->_tpl_vars['search']['sort_order']; ?>
<?php endif; ?>" href="<?php echo fn_url(($this->_tpl_vars['c_url'])."&amp;sort_by=email&amp;sort_order=".($this->_tpl_vars['search']['sort_order'])); ?>
" rev=<?php echo $this->_tpl_vars['rev']; ?>
><?php echo fn_get_lang_var('email', $this->getLanguage()); ?>
</a></th>
	<th width="20%"><a class="cm-ajax<?php if ($this->_tpl_vars['search']['sort_by'] == 'date'): ?> sort-link-<?php echo $this->_tpl_vars['search']['sort_order']; ?>
<?php endif; ?>" href="<?php echo fn_url(($this->_tpl_vars['c_url'])."&amp;sort_by=date&amp;sort_order=".($this->_tpl_vars['search']['sort_order'])); ?>
" rev=<?php echo $this->_tpl_vars['rev']; ?>
><?php echo fn_get_lang_var('registered', $this->getLanguage()); ?>
</a></th>
	<th><a class="cm-ajax<?php if ($this->_tpl_vars['search']['sort_by'] == 'type'): ?> sort-link-<?php echo $this->_tpl_vars['search']['sort_order']; ?>
<?php endif; ?>" href="<?php echo fn_url(($this->_tpl_vars['c_url'])."&amp;sort_by=type&amp;sort_order=".($this->_tpl_vars['search']['sort_order'])); ?>
" rev=<?php echo $this->_tpl_vars['rev']; ?>
><?php echo fn_get_lang_var('type', $this->getLanguage()); ?>
</a></th>
	<?php $this->_tag_stack[] = array('hook', array('name' => "profiles:manage_header")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
	<th width="15%"><a class="cm-ajax<?php if ($this->_tpl_vars['search']['sort_by'] == 'status'): ?> sort-link-<?php echo $this->_tpl_vars['search']['sort_order']; ?>
<?php endif; ?>" href="<?php echo fn_url(($this->_tpl_vars['c_url'])."&amp;sort_by=status&amp;sort_order=".($this->_tpl_vars['search']['sort_order'])); ?>
" rev=<?php echo $this->_tpl_vars['rev']; ?>
><?php echo fn_get_lang_var('status', $this->getLanguage()); ?>
</a></th>
	<th>&nbsp;</th>
</tr>
<?php $_from = $this->_tpl_vars['users']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['user']):
?>
<?php if (defined('COMPANY_ID') && $this->_tpl_vars['user']['company_id'] != @COMPANY_ID && ! defined('RESTRICTED_ADMIN') && $this->_tpl_vars['auth']['is_root'] != 'Y'): ?>
	<?php $this->assign('link_text', fn_get_lang_var('view', $this->getLanguage()), false); ?>
	<?php $this->assign('popup_additional_class', "", false); ?>
<?php elseif ($this->_tpl_vars['user']['company_id'] == @COMPANY_ID || ( defined('RESTRICTED_ADMIN') && $this->_tpl_vars['user']['user_id'] != $this->_tpl_vars['auth']['user_id'] ) || $this->_tpl_vars['auth']['is_root'] == 'Y'): ?>
	<?php $this->assign('link_text', "", false); ?>
	<?php $this->assign('popup_additional_class', "cm-no-hide-input", false); ?>
<?php else: ?>
	<?php $this->assign('popup_additional_class', "", false); ?>
	<?php $this->assign('link_text', "", false); ?>
<?php endif; ?>

<tr class="<?php echo smarty_function_cycle(array('values' => "table-row, "), $this);?>
">



	<td class="center <?php echo $this->_tpl_vars['no_hide_input']; ?>
">
		<input type="checkbox" name="user_ids[]" value="<?php echo $this->_tpl_vars['user']['user_id']; ?>
" class="checkbox cm-item" /></td>
	<td><a href="<?php echo fn_url("profiles.update?user_id=".($this->_tpl_vars['user']['user_id'])."&user_type=".($this->_tpl_vars['user']['user_type'])); ?>
">&nbsp;<span><?php echo $this->_tpl_vars['user']['user_id']; ?>
</span>&nbsp;</a></td>
	<?php if ($this->_tpl_vars['settings']['General']['use_email_as_login'] != 'Y'): ?>
	<td><a href="<?php echo fn_url("profiles.update?user_id=".($this->_tpl_vars['user']['user_id'])."&user_type=".($this->_tpl_vars['user']['user_type'])); ?>
"><?php echo $this->_tpl_vars['user']['user_login']; ?>
</a></td>
	<?php endif; ?>
	<td><?php if ($this->_tpl_vars['user']['firstname'] || $this->_tpl_vars['user']['lastname']): ?><a href="<?php echo fn_url("profiles.update?user_id=".($this->_tpl_vars['user']['user_id'])."&user_type=".($this->_tpl_vars['user']['user_type'])); ?>
"><?php echo $this->_tpl_vars['user']['lastname']; ?>
 <?php echo $this->_tpl_vars['user']['firstname']; ?>
</a><?php else: ?>-<?php endif; ?><?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('company_name' => $this->_tpl_vars['user']['company_name'], 'company_id' => $this->_tpl_vars['user']['company_id'], )); ?><?php if (@PRODUCT_TYPE == 'MULTIVENDOR' || @PRODUCT_TYPE == 'ULTIMATE'): ?>
<?php $this->assign('lang_vendor_supplier', fn_get_lang_var('vendor', $this->getLanguage()), false); ?>
<?php else: ?>
<?php $this->assign('lang_vendor_supplier', fn_get_lang_var('supplier', $this->getLanguage()), false); ?>
<?php endif; ?>

<?php if ($this->_tpl_vars['company_name']): ?>
 (<?php echo $this->_tpl_vars['lang_vendor_supplier']; ?>
: <?php echo $this->_tpl_vars['company_name']; ?>
)
<?php elseif ($this->_tpl_vars['company_id']): ?>
 (<?php echo $this->_tpl_vars['lang_vendor_supplier']; ?>
: <?php echo fn_get_company_name($this->_tpl_vars['company_id']); ?>
)
<?php endif; ?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?></td>
	<td width="25%"><a href="mailto:<?php echo smarty_modifier_escape($this->_tpl_vars['user']['email'], 'url'); ?>
"><?php echo $this->_tpl_vars['user']['email']; ?>
</a></td>
	<td><?php echo smarty_modifier_date_format($this->_tpl_vars['user']['timestamp'], ($this->_tpl_vars['settings']['Appearance']['date_format']).", ".($this->_tpl_vars['settings']['Appearance']['time_format'])); ?>
</td>
	<td><?php if ($this->_tpl_vars['user']['user_type'] == 'A'): ?><?php echo fn_get_lang_var('administrator', $this->getLanguage()); ?>
<?php elseif ($this->_tpl_vars['user']['user_type'] == 'V'): ?><?php echo fn_get_lang_var('vendor_administrator', $this->getLanguage()); ?>
<?php elseif ($this->_tpl_vars['user']['user_type'] == 'C'): ?><?php echo fn_get_lang_var('customer', $this->getLanguage()); ?>
<?php elseif ($this->_tpl_vars['user']['user_type'] == 'P'): ?><?php echo fn_get_lang_var('affiliate', $this->getLanguage()); ?>
<?php endif; ?></td>
	<?php $this->_tag_stack[] = array('hook', array('name' => "profiles:manage_data")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
	<td>
		<input type="hidden" name="user_types[<?php echo $this->_tpl_vars['user']['user_id']; ?>
]" value="<?php echo $this->_tpl_vars['user']['user_type']; ?>
" />

		<?php if (( $this->_tpl_vars['user']['is_root'] == 'Y' && ( $this->_tpl_vars['user']['user_type'] != 'V' || ( $_SESSION['auth']['user_type'] != 'A' ) ) ) || ( $this->_tpl_vars['user']['user_id'] == $_SESSION['auth']['user_id'] )): ?>
			<?php $this->assign('display', 'text', false); ?>
		<?php else: ?>
			<?php $this->assign('display', "", false); ?>
		<?php endif; ?>

		<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('id' => $this->_tpl_vars['user']['user_id'], 'status' => $this->_tpl_vars['user']['status'], 'hidden' => "", 'update_controller' => 'profiles', 'notify' => true, 'notify_text' => fn_get_lang_var('notify_user', $this->getLanguage()), 'popup_additional_class' => $this->_tpl_vars['popup_additional_class'], 'display' => $this->_tpl_vars['display'], )); ?><?php if ($this->_tpl_vars['display'] == 'text'): ?>
	<span class="view-status">
		<?php if ($this->_tpl_vars['status'] == 'A'): ?>
			<?php echo fn_get_lang_var('active', $this->getLanguage()); ?>

		<?php elseif ($this->_tpl_vars['status'] == 'H'): ?>
			<?php echo fn_get_lang_var('hidden', $this->getLanguage()); ?>

		<?php elseif ($this->_tpl_vars['status'] == 'D'): ?>
			<?php echo fn_get_lang_var('disabled', $this->getLanguage()); ?>

		<?php elseif ($this->_tpl_vars['status'] == 'P'): ?>
			<?php echo fn_get_lang_var('pending', $this->getLanguage()); ?>

		<?php elseif ($this->_tpl_vars['status'] == 'N'): ?>
			<?php echo fn_get_lang_var('new', $this->getLanguage()); ?>

		<?php endif; ?>
	</span>
<?php else: ?>
	<?php $this->assign('prefix', smarty_modifier_default(@$this->_tpl_vars['prefix'], 'select'), false); ?>
	<div class="select-popup-container <?php echo $this->_tpl_vars['popup_additional_class']; ?>
">
		<?php if (! $this->_tpl_vars['hide_for_vendor']): ?>
		<div <?php if ($this->_tpl_vars['id']): ?>id="sw_<?php echo $this->_tpl_vars['prefix']; ?>
_<?php echo $this->_tpl_vars['id']; ?>
_wrap"<?php endif; ?> class="<?php if ($this->_tpl_vars['statuses'][$this->_tpl_vars['status']]['color']): ?>selected-status-base<?php else: ?>selected-status status-<?php if ($this->_tpl_vars['suffix']): ?><?php echo $this->_tpl_vars['suffix']; ?>
-<?php endif; ?><?php echo smarty_modifier_lower($this->_tpl_vars['status']); ?>
<?php endif; ?><?php if ($this->_tpl_vars['id']): ?> cm-combo-on cm-combination<?php endif; ?>">
			<a <?php if ($this->_tpl_vars['id']): ?>class="cm-combo-on<?php if (! $this->_tpl_vars['popup_disabled']): ?> cm-combination<?php endif; ?>"<?php endif; ?>>
		<?php endif; ?>
			<?php if ($this->_tpl_vars['items_status']): ?>
				<?php if (! is_array($this->_tpl_vars['items_status'])): ?>
					<?php $this->assign('items_status', fn_from_json($this->_tpl_vars['items_status']), false); ?>
				<?php endif; ?>
				<?php echo $this->_tpl_vars['items_status'][$this->_tpl_vars['status']]; ?>

			<?php else: ?>
				<?php if ($this->_tpl_vars['status'] == 'A'): ?>
					<?php echo fn_get_lang_var('active', $this->getLanguage()); ?>

				<?php elseif ($this->_tpl_vars['status'] == 'D'): ?>
					<?php echo fn_get_lang_var('disabled', $this->getLanguage()); ?>

				<?php elseif ($this->_tpl_vars['status'] == 'H'): ?>
					<?php echo fn_get_lang_var('hidden', $this->getLanguage()); ?>

				<?php elseif ($this->_tpl_vars['status'] == 'P'): ?>
					<?php echo fn_get_lang_var('pending', $this->getLanguage()); ?>

				<?php elseif ($this->_tpl_vars['status'] == 'N'): ?>
					<?php echo fn_get_lang_var('new', $this->getLanguage()); ?>

				<?php endif; ?>
			<?php endif; ?>
		<?php if (! $this->_tpl_vars['hide_for_vendor']): ?>
			</a>
			<?php if ($this->_tpl_vars['statuses'][$this->_tpl_vars['status']]['color']): ?>
			<span class="selected-status-icon" style="background-color: #<?php echo $this->_tpl_vars['statuses'][$this->_tpl_vars['status']]['color']; ?>
">&nbsp;</span>
			<?php endif; ?>

		</div>
		<?php endif; ?>
		<?php if ($this->_tpl_vars['id'] && ! $this->_tpl_vars['hide_for_vendor']): ?>
			<?php $this->assign('_update_controller', smarty_modifier_default(@$this->_tpl_vars['update_controller'], 'tools'), false); ?>
			<?php if ($this->_tpl_vars['table'] && $this->_tpl_vars['object_id_name']): ?><?php ob_start(); ?>&amp;table=<?php echo $this->_tpl_vars['table']; ?>
&amp;id_name=<?php echo $this->_tpl_vars['object_id_name']; ?>
<?php $this->_smarty_vars['capture']['_extra'] = ob_get_contents(); ob_end_clean(); ?><?php endif; ?>
			<div id="<?php echo $this->_tpl_vars['prefix']; ?>
_<?php echo $this->_tpl_vars['id']; ?>
_wrap" class="popup-tools cm-popup-box cm-smart-position hidden">
				<div class="status-scroll-y">
				<ul class="cm-select-list">
				<?php if ($this->_tpl_vars['items_status']): ?>
					<?php $_from = $this->_tpl_vars['items_status']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['st'] => $this->_tpl_vars['val']):
?>
					<li><a class="<?php if ($this->_tpl_vars['confirm']): ?>cm-confirm <?php endif; ?>status-link-<?php echo smarty_modifier_lower($this->_tpl_vars['st']); ?>
 <?php if ($this->_tpl_vars['status'] == $this->_tpl_vars['st']): ?>cm-active<?php else: ?>cm-ajax<?php endif; ?>"<?php if ($this->_tpl_vars['status_rev']): ?> rev="<?php echo $this->_tpl_vars['status_rev']; ?>
"<?php endif; ?> href="<?php echo fn_url(($this->_tpl_vars['_update_controller']).".update_status?id=".($this->_tpl_vars['id'])."&amp;status=".($this->_tpl_vars['st']).($this->_smarty_vars['capture']['_extra']).($this->_tpl_vars['extra'])); ?>
" onclick="return fn_check_object_status(this, '<?php echo smarty_modifier_lower($this->_tpl_vars['st']); ?>
', '<?php if ($this->_tpl_vars['statuses']): ?><?php echo smarty_modifier_default(@$this->_tpl_vars['statuses'][$this->_tpl_vars['st']]['color'], ''); ?>
<?php endif; ?>');" name="update_object_status_callback"><?php echo $this->_tpl_vars['val']; ?>
</a></li>
					<?php endforeach; endif; unset($_from); ?>
				<?php else: ?>
					<li><a class="<?php if ($this->_tpl_vars['confirm']): ?>cm-confirm <?php endif; ?>status-link-a <?php if ($this->_tpl_vars['status'] == 'A'): ?>cm-active<?php else: ?>cm-ajax<?php endif; ?>"<?php if ($this->_tpl_vars['status_rev']): ?> rev="<?php echo $this->_tpl_vars['status_rev']; ?>
"<?php endif; ?> href="<?php echo fn_url(($this->_tpl_vars['_update_controller']).".update_status?id=".($this->_tpl_vars['id'])."&amp;table=".($this->_tpl_vars['table'])."&amp;id_name=".($this->_tpl_vars['object_id_name'])."&amp;status=A".($this->_tpl_vars['dynamic_object'])); ?>
" onclick="return fn_check_object_status(this, 'a', '');" name="update_object_status_callback"><?php echo fn_get_lang_var('active', $this->getLanguage()); ?>
</a></li>
					<li><a class="<?php if ($this->_tpl_vars['confirm']): ?>cm-confirm <?php endif; ?>status-link-d <?php if ($this->_tpl_vars['status'] == 'D'): ?>cm-active<?php else: ?>cm-ajax<?php endif; ?>"<?php if ($this->_tpl_vars['status_rev']): ?> rev="<?php echo $this->_tpl_vars['status_rev']; ?>
"<?php endif; ?> href="<?php echo fn_url(($this->_tpl_vars['_update_controller']).".update_status?id=".($this->_tpl_vars['id'])."&amp;table=".($this->_tpl_vars['table'])."&amp;id_name=".($this->_tpl_vars['object_id_name'])."&amp;status=D".($this->_tpl_vars['dynamic_object'])); ?>
" onclick="return fn_check_object_status(this, 'd', '');" name="update_object_status_callback"><?php echo fn_get_lang_var('disabled', $this->getLanguage()); ?>
</a></li>
					<?php if ($this->_tpl_vars['hidden']): ?>
					<li><a class="<?php if ($this->_tpl_vars['confirm']): ?>cm-confirm <?php endif; ?>status-link-h <?php if ($this->_tpl_vars['status'] == 'H'): ?>cm-active<?php else: ?>cm-ajax<?php endif; ?>"<?php if ($this->_tpl_vars['status_rev']): ?> rev="<?php echo $this->_tpl_vars['status_rev']; ?>
"<?php endif; ?> href="<?php echo fn_url(($this->_tpl_vars['_update_controller']).".update_status?id=".($this->_tpl_vars['id'])."&amp;table=".($this->_tpl_vars['table'])."&amp;id_name=".($this->_tpl_vars['object_id_name'])."&amp;status=H".($this->_tpl_vars['dynamic_object'])); ?>
" onclick="return fn_check_object_status(this, 'h', '');" name="update_object_status_callback"><?php echo fn_get_lang_var('hidden', $this->getLanguage()); ?>
</a></li>
					<?php endif; ?>
					
					<?php if ($this->_tpl_vars['status'] == 'N'): ?>
					<li><a class="<?php if ($this->_tpl_vars['confirm']): ?>cm-confirm <?php endif; ?>status-link-p <?php if ($this->_tpl_vars['status'] == 'P'): ?>cm-active<?php else: ?>cm-ajax<?php endif; ?>"<?php if ($this->_tpl_vars['status_rev']): ?> rev="<?php echo $this->_tpl_vars['status_rev']; ?>
"<?php endif; ?> href="<?php echo fn_url(($this->_tpl_vars['_update_controller']).".update_status?id=".($this->_tpl_vars['id'])."&amp;table=".($this->_tpl_vars['table'])."&amp;id_name=".($this->_tpl_vars['object_id_name'])."&amp;status=P".($this->_tpl_vars['dynamic_object'])); ?>
" onclick="return fn_check_object_status(this, 'p', '');" name="update_object_status_callback"><?php echo fn_get_lang_var('pending', $this->getLanguage()); ?>
</a></li>
					<?php endif; ?>
				<?php endif; ?>
				</ul>
				</div>
				<?php ob_start(); ?>
				<?php if ($this->_tpl_vars['notify']): ?>
					<li class="select-field">
						<input type="checkbox" name="__notify_user" id="<?php echo $this->_tpl_vars['prefix']; ?>
_<?php echo $this->_tpl_vars['id']; ?>
_notify" value="Y" class="checkbox" checked="checked" onclick="$('input[name=__notify_user]').attr('checked', this.checked);" />
						<label for="<?php echo $this->_tpl_vars['prefix']; ?>
_<?php echo $this->_tpl_vars['id']; ?>
_notify"><?php echo smarty_modifier_default(@$this->_tpl_vars['notify_text'], fn_get_lang_var('notify_customer', $this->getLanguage())); ?>
</label>
					</li>
				<?php endif; ?>
				<?php if ($this->_tpl_vars['notify_department']): ?>
					<li class="select-field notify-department">
						<input type="checkbox" name="__notify_department" id="<?php echo $this->_tpl_vars['prefix']; ?>
_<?php echo $this->_tpl_vars['id']; ?>
_notify_department" value="Y" class="checkbox" checked="checked" onclick="$('input[name=__notify_department]').attr('checked', this.checked);" />
						<label for="<?php echo $this->_tpl_vars['prefix']; ?>
_<?php echo $this->_tpl_vars['id']; ?>
_notify_department"><?php echo fn_get_lang_var('notify_orders_department', $this->getLanguage()); ?>
</label>
					</li>
				<?php endif; ?>
				
				<?php if ($this->_tpl_vars['notify_supplier']): ?>
					<li class="select-field notify-department">
						<input type="checkbox" name="__notify_supplier" id="<?php echo $this->_tpl_vars['prefix']; ?>
_<?php echo $this->_tpl_vars['id']; ?>
_notify_supplier" value="Y" class="checkbox" checked="checked" onclick="$('input[name=__notify_supplier]').attr('checked', this.checked);" />
						<label for="<?php echo $this->_tpl_vars['prefix']; ?>
_<?php echo $this->_tpl_vars['id']; ?>
_notify_supplier"><?php if (@PRODUCT_TYPE == 'MULTIVENDOR' || @PRODUCT_TYPE == 'ULTIMATE'): ?><?php echo fn_get_lang_var('notify_vendor', $this->getLanguage()); ?>
<?php else: ?><?php echo fn_get_lang_var('notify_supplier', $this->getLanguage()); ?>
<?php endif; ?></label>
					</li>
				<?php endif; ?>
				
				<?php $this->_smarty_vars['capture']['list_items'] = ob_get_contents(); ob_end_clean(); ?>
				
				<?php if (trim($this->_smarty_vars['capture']['list_items'])): ?>
				<ul class="cm-select-list select-list-tools">
					<?php echo $this->_smarty_vars['capture']['list_items']; ?>

				</ul>
				<?php endif; ?>
			</div>
			<?php if (! $this->_smarty_vars['capture']['avail_box']): ?>
			<script type="text/javascript">
			//<![CDATA[
			<?php echo '
			function fn_check_object_status(obj, status, color) 
			{
				if ($(obj).hasClass(\'cm-active\')) {
					$(obj).removeClass(\'cm-ajax\');
					return false;
				}
				fn_update_object_status(obj, status, color);
				return true;
			}
			function fn_update_object_status_callback(data, params) 
			{
				if (data.return_status && params.obj) {
					var color = data.color ? data.color : \'\';
					fn_update_object_status(params.obj, data.return_status.toLowerCase(), color);
				}
			}
			function fn_update_object_status(obj, status, color)
			{
				var upd_elm_id = $(obj).parents(\'.cm-popup-box:first\').attr(\'id\');
				var upd_elm = $(\'#\' + upd_elm_id);
				upd_elm.hide();
				$(obj).attr(\'href\', fn_query_remove($(obj).attr(\'href\'), [\'notify_user\', \'notify_department\']));
				if ($(\'input[name=__notify_user]:checked\', upd_elm).length) {
					$(obj).attr(\'href\', $(obj).attr(\'href\') + \'&notify_user=Y\');
				}
				if ($(\'input[name=__notify_department]:checked\', upd_elm).length) {
					$(obj).attr(\'href\', $(obj).attr(\'href\') + \'&notify_department=Y\');
				}
				
				if ($(\'input[name=__notify_supplier]:checked\', upd_elm).length) {
					$(obj).attr(\'href\', $(obj).attr(\'href\') + \'&notify_supplier=Y\');
				}
				
				$(\'.cm-select-list li a\', upd_elm).removeClass(\'cm-active\').addClass(\'cm-ajax\');
				$(\'.status-link-\' + status, upd_elm).addClass(\'cm-active\');
				$(\'#sw_\' + upd_elm_id + \' a\').text($(\'.status-link-\' + status, upd_elm).text());
				if (color) {
					$(\'#sw_\' + upd_elm_id).removeAttr(\'class\').addClass(\'selected-status-base \' + $(\'#sw_\' + upd_elm_id + \' a\').attr(\'class\'));
					$(\'#sw_\' + upd_elm_id).children(\'.selected-status-icon:first\').css(\'background-color\', \'#\' + color);
				} else {
					'; ?>

					$('#sw_' + upd_elm_id).removeAttr('class').addClass('selected-status status-<?php if ($this->_tpl_vars['suffix']): ?><?php echo $this->_tpl_vars['suffix']; ?>
-<?php endif; ?>' + status + ' ' + $('#sw_' + upd_elm_id + ' a').attr('class'));
					<?php echo '
				}
			}
			'; ?>

			//]]>
			</script>
			<?php ob_start(); ?>Y<?php $this->_smarty_vars['capture']['avail_box'] = ob_get_contents(); ob_end_clean(); ?>
			<?php endif; ?>
		<?php endif; ?>
	</div>
<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
	</td>
	<td class="nowrap">
		<?php ob_start(); ?>
		<?php $this->_tag_stack[] = array('hook', array('name' => "profiles:list_extra_links")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
			<?php if ($this->_tpl_vars['user']['user_type'] == 'C'): ?>
				<li><a href="<?php echo fn_url("orders.manage?user_id=".($this->_tpl_vars['user']['user_id'])); ?>
"><?php echo fn_get_lang_var('view_all_orders', $this->getLanguage()); ?>
</a></li>
				<?php if (! defined('COMPANY_ID')): ?>
				<li><a href="<?php echo fn_url("profiles.act_as_user?user_id=".($this->_tpl_vars['user']['user_id'])); ?>
" target="_blank" ><?php echo fn_get_lang_var('act_on_behalf', $this->getLanguage()); ?>
</a></li>
				<?php endif; ?>
			<?php endif; ?>
			<?php $this->assign('return_current_url', smarty_modifier_escape($this->_tpl_vars['config']['current_url'], 'url'), false); ?>

			<?php if (fn_check_rights_delete_user($this->_tpl_vars['user'])): ?>
				<li><a class="cm-confirm" href="<?php echo fn_url("profiles.delete?user_id=".($this->_tpl_vars['user']['user_id'])."&amp;redirect_url=".($this->_tpl_vars['return_current_url'])); ?>
"><?php echo fn_get_lang_var('delete', $this->getLanguage()); ?>
</a></li>
			<?php endif; ?>
		<?php if ($this->_tpl_vars['addons']['reward_points']['status'] == 'A'): ?><?php $__parent_tpl_vars = $this->_tpl_vars; ?><?php if ($this->_tpl_vars['user']['user_type'] == 'C'): ?>
	<li><a href="<?php echo fn_url("reward_points.userlog?user_id=".($this->_tpl_vars['user']['user_id'])); ?>
"><?php echo fn_get_lang_var('points', $this->getLanguage()); ?>
 (<?php if ($this->_tpl_vars['user']['points']): ?><?php echo unserialize($this->_tpl_vars['user']['points']); ?>
<?php else: ?>0<?php endif; ?>)</a></li>
<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php endif; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
		<?php $this->_smarty_vars['capture']['tools_items'] = ob_get_contents(); ob_end_clean(); ?>
		<?php if ($this->_tpl_vars['_REQUEST']['user_type']): ?>
			<?php $this->assign('user_edit_link', "profiles.update?user_id=".($this->_tpl_vars['user']['user_id'])."&user_type=".($this->_tpl_vars['_REQUEST']['user_type']), false); ?>
		<?php else: ?>
			<?php $this->assign('user_edit_link', "profiles.update?user_id=".($this->_tpl_vars['user']['user_id'])."&user_type=".($this->_tpl_vars['user']['user_type']), false); ?>
		<?php endif; ?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/table_tools_list.tpl", 'smarty_include_vars' => array('prefix' => $this->_tpl_vars['user']['user_id'],'tools_list' => $this->_smarty_vars['capture']['tools_items'],'href' => $this->_tpl_vars['user_edit_link'],'link_text' => $this->_tpl_vars['link_text'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</td>
</tr>
<?php endforeach; else: ?>
<tr class="no-items">
	<td colspan="9"><p><?php echo fn_get_lang_var('no_data', $this->getLanguage()); ?>
</p></td>
</tr>
<?php endif; unset($_from); ?>
</table>

<?php if ($this->_tpl_vars['users']): ?>
	<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('href' => "#users", )); ?><?php if ($this->_tpl_vars['elements_count'] != 1): ?>

<div class="table-tools">
	<a href="<?php echo $this->_tpl_vars['href']; ?>
" name="check_all" class="cm-check-items cm-on underlined"><?php echo fn_get_lang_var('select_all', $this->getLanguage()); ?>
</a>|
	<a href="<?php echo $this->_tpl_vars['href']; ?>
" name="check_all" class="cm-check-items cm-off underlined"><?php echo fn_get_lang_var('unselect_all', $this->getLanguage()); ?>
</a>
</div>

<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
<?php endif; ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/pagination.tpl", 'smarty_include_vars' => array('div_id' => $this->_tpl_vars['_REQUEST']['content_id'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php if ($this->_tpl_vars['users']): ?>
<div class="buttons-container buttons-bg">
	<div class="float-left">
		<?php if (defined('COMPANY_ID') && $this->_tpl_vars['_REQUEST']['user_type'] == 'C' && @PRODUCT_TYPE != 'ULTIMATE'): ?>
			<?php ob_start(); ?>
			<ul>
				<?php $this->_tag_stack[] = array('hook', array('name' => "profiles:list_tools")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
				<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
			</ul>
			<?php $this->_smarty_vars['capture']['tools_list'] = ob_get_contents(); ob_end_clean(); ?>
			<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('but_text' => fn_get_lang_var('export_selected', $this->getLanguage()), 'but_name' => "dispatch[profiles.export_range]", 'but_meta' => "cm-confirm cm-process-items", 'but_role' => 'button_main', )); ?><?php if ($this->_tpl_vars['but_role'] == 'text'): ?>
	<?php $this->assign('class', "text-link", false); ?>
<?php elseif ($this->_tpl_vars['but_role'] == 'delete'): ?>
	<?php $this->assign('class', "text-button-delete", false); ?>
<?php elseif ($this->_tpl_vars['but_role'] == 'add'): ?>
	<?php $this->assign('class', "text-button text-button-add", false); ?>
<?php elseif ($this->_tpl_vars['but_role'] == 'reload'): ?>
	<?php $this->assign('class', "text-button text-button-reload", false); ?>
<?php elseif ($this->_tpl_vars['but_role'] == 'delete_item'): ?>
	<?php $this->assign('class', "text-button-delete-item", false); ?>
<?php elseif ($this->_tpl_vars['but_role'] == 'edit'): ?>
	<?php $this->assign('class', "text-button-edit", false); ?>
<?php elseif ($this->_tpl_vars['but_role'] == 'tool'): ?>
	<?php $this->assign('class', "tool-link", false); ?>
<?php elseif ($this->_tpl_vars['but_role'] == 'link'): ?>
	<?php $this->assign('class', "text-button-link", false); ?>
<?php elseif ($this->_tpl_vars['but_role'] == 'simple'): ?>
	<?php $this->assign('class', "text-button-simple", false); ?>
<?php else: ?>
	<?php $this->assign('class', "", false); ?>
<?php endif; ?>

<?php if ($this->_tpl_vars['but_name']): ?><?php $this->assign('r', $this->_tpl_vars['but_name'], false); ?><?php else: ?><?php $this->assign('r', $this->_tpl_vars['but_href'], false); ?><?php endif; ?>
<?php $this->assign('method', smarty_modifier_default(@$this->_tpl_vars['method'], 'POST'), false); ?>
<?php if (fn_check_view_permissions($this->_tpl_vars['r'], $this->_tpl_vars['method'])): ?>

<?php if ($this->_tpl_vars['but_name'] || $this->_tpl_vars['but_role'] == 'submit' || $this->_tpl_vars['but_role'] == 'button_main' || $this->_tpl_vars['but_type'] || $this->_tpl_vars['but_role'] == 'big'): ?> 
	<span <?php if ($this->_tpl_vars['but_css']): ?>style="<?php echo $this->_tpl_vars['but_css']; ?>
"<?php endif; ?> class="submit-button<?php if ($this->_tpl_vars['but_role'] == 'big'): ?>-big<?php endif; ?><?php if ($this->_tpl_vars['but_role'] == 'button_main'): ?> cm-button-main<?php endif; ?> <?php echo $this->_tpl_vars['but_meta']; ?>
"><input <?php if ($this->_tpl_vars['but_id']): ?>id="<?php echo $this->_tpl_vars['but_id']; ?>
"<?php endif; ?> <?php if ($this->_tpl_vars['but_meta']): ?>class="<?php echo $this->_tpl_vars['but_meta']; ?>
"<?php endif; ?> type="<?php echo smarty_modifier_default(@$this->_tpl_vars['but_type'], 'submit'); ?>
"<?php if ($this->_tpl_vars['but_name']): ?> name="<?php echo $this->_tpl_vars['but_name']; ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_onclick']): ?> onclick="<?php echo $this->_tpl_vars['but_onclick']; ?>
;<?php if (! $this->_tpl_vars['allow_href']): ?> return false;<?php endif; ?>"<?php endif; ?> value="<?php echo $this->_tpl_vars['but_text']; ?>
" <?php if ($this->_tpl_vars['tabindex']): ?>tabindex="<?php echo $this->_tpl_vars['tabindex']; ?>
"<?php endif; ?> <?php if ($this->_tpl_vars['but_rev']): ?> rev="<?php echo $this->_tpl_vars['but_rev']; ?>
"<?php endif; ?> <?php if ($this->_tpl_vars['but_disabled']): ?>disabled="disabled"<?php endif; ?> /></span>

<?php elseif ($this->_tpl_vars['but_role'] && $this->_tpl_vars['but_role'] != 'submit' && $this->_tpl_vars['but_role'] != 'action' && $this->_tpl_vars['but_role'] != "advanced-search" && $this->_tpl_vars['but_role'] != 'button'): ?> 
	<a <?php if ($this->_tpl_vars['but_id']): ?>id="<?php echo $this->_tpl_vars['but_id']; ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_href']): ?> href="<?php echo fn_url($this->_tpl_vars['but_href']); ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_onclick']): ?> onclick="<?php echo $this->_tpl_vars['but_onclick']; ?>
;<?php if (! $this->_tpl_vars['allow_href']): ?> return false;<?php endif; ?>"<?php endif; ?><?php if ($this->_tpl_vars['but_target']): ?> target="<?php echo $this->_tpl_vars['but_target']; ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_rev']): ?> rev="<?php echo $this->_tpl_vars['but_rev']; ?>
"<?php endif; ?> class="<?php echo $this->_tpl_vars['class']; ?>
<?php if ($this->_tpl_vars['but_meta']): ?> <?php echo $this->_tpl_vars['but_meta']; ?>
<?php endif; ?>"><?php if ($this->_tpl_vars['but_role'] == 'delete_item'): ?><img src="<?php echo $this->_tpl_vars['images_dir']; ?>
/icons/icon_delete.gif" width="12" height="18" border="0" alt="<?php echo fn_get_lang_var('remove_this_item', $this->getLanguage()); ?>
" title="<?php echo fn_get_lang_var('remove_this_item', $this->getLanguage()); ?>
" class="valign" /><?php else: ?><?php echo $this->_tpl_vars['but_text']; ?>
<?php endif; ?></a>

<?php elseif ($this->_tpl_vars['but_role'] == 'action' || $this->_tpl_vars['but_role'] == "advanced-search"): ?> 
	<a <?php if ($this->_tpl_vars['but_id']): ?>id="<?php echo $this->_tpl_vars['but_id']; ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_href']): ?> href="<?php echo fn_url($this->_tpl_vars['but_href']); ?>
"<?php endif; ?> <?php if ($this->_tpl_vars['but_onclick']): ?>onclick="<?php echo $this->_tpl_vars['but_onclick']; ?>
;<?php if (! $this->_tpl_vars['allow_href']): ?> return false;<?php endif; ?>"<?php endif; ?> <?php if ($this->_tpl_vars['but_target']): ?>target="<?php echo $this->_tpl_vars['but_target']; ?>
"<?php endif; ?> <?php if ($this->_tpl_vars['but_rev']): ?> rev="<?php echo $this->_tpl_vars['but_rev']; ?>
"<?php endif; ?> class="button<?php if ($this->_tpl_vars['but_meta']): ?> <?php echo $this->_tpl_vars['but_meta']; ?>
<?php endif; ?>"><?php echo $this->_tpl_vars['but_text']; ?>
<?php if ($this->_tpl_vars['but_role'] == 'action'): ?>&nbsp;<img src="<?php echo $this->_tpl_vars['images_dir']; ?>
/icons/but_arrow.gif" width="8" height="7" border="0" alt=""/><?php endif; ?></a>
	
<?php elseif ($this->_tpl_vars['but_role'] == 'button'): ?>
	<input <?php if ($this->_tpl_vars['but_id']): ?>id="<?php echo $this->_tpl_vars['but_id']; ?>
"<?php endif; ?> <?php if ($this->_tpl_vars['but_meta']): ?>class="<?php echo $this->_tpl_vars['but_meta']; ?>
"<?php endif; ?> type="button" <?php if ($this->_tpl_vars['but_onclick']): ?>onclick="<?php echo $this->_tpl_vars['but_onclick']; ?>
;<?php if (! $this->_tpl_vars['allow_href']): ?> return false;<?php endif; ?>"<?php endif; ?> value="<?php echo $this->_tpl_vars['but_text']; ?>
" <?php if ($this->_tpl_vars['tabindex']): ?>tabindex="<?php echo $this->_tpl_vars['tabindex']; ?>
"<?php endif; ?> <?php if ($this->_tpl_vars['but_rev']): ?> rev="<?php echo $this->_tpl_vars['but_rev']; ?>
"<?php endif; ?> />

<?php elseif ($this->_tpl_vars['but_role'] == 'icon'): ?> 
	<a <?php if ($this->_tpl_vars['but_id']): ?>id="<?php echo $this->_tpl_vars['but_id']; ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_href']): ?> href="<?php echo fn_url($this->_tpl_vars['but_href']); ?>
"<?php endif; ?> <?php if ($this->_tpl_vars['but_onclick']): ?>onclick="<?php echo $this->_tpl_vars['but_onclick']; ?>
;<?php if (! $this->_tpl_vars['allow_href']): ?> return false;<?php endif; ?>"<?php endif; ?> <?php if ($this->_tpl_vars['but_target']): ?>target="<?php echo $this->_tpl_vars['but_target']; ?>
"<?php endif; ?> <?php if ($this->_tpl_vars['but_rev']): ?> rev="<?php echo $this->_tpl_vars['but_rev']; ?>
"<?php endif; ?> class="<?php if ($this->_tpl_vars['but_meta']): ?> <?php echo $this->_tpl_vars['but_meta']; ?>
<?php endif; ?>"><?php echo $this->_tpl_vars['but_text']; ?>
</a>

<?php elseif (! $this->_tpl_vars['but_role']): ?> 
	<input <?php if ($this->_tpl_vars['but_id']): ?>id="<?php echo $this->_tpl_vars['but_id']; ?>
"<?php endif; ?> class="default-button<?php if ($this->_tpl_vars['but_meta']): ?> <?php echo $this->_tpl_vars['but_meta']; ?>
<?php endif; ?>" type="submit" onclick="<?php echo $this->_tpl_vars['but_onclick']; ?>
;<?php if (! $this->_tpl_vars['allow_href']): ?> return false;<?php endif; ?>" value="<?php echo $this->_tpl_vars['but_text']; ?>
" <?php if ($this->_tpl_vars['but_rev']): ?> rev="<?php echo $this->_tpl_vars['but_rev']; ?>
"<?php endif; ?> />
<?php endif; ?>

<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
			<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('prefix' => "main".($this->_tpl_vars['_REQUEST']['content_id']), 'hide_actions' => true, 'tools_list' => $this->_smarty_vars['capture']['tools_list'], 'display' => 'inline', 'link_text' => fn_get_lang_var('choose_action', $this->getLanguage()), )); ?><?php if ($this->_tpl_vars['skip_check_permissions'] || fn_check_view_permissions($this->_tpl_vars['tools_list'])): ?>

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
		<?php else: ?>
			<?php ob_start(); ?>
			<ul>
				<?php $this->_tag_stack[] = array('hook', array('name' => "profiles:list_tools")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
					<li><a class="cm-process-items" name="dispatch[profiles.export_range]" rev="userlist_form"><?php echo fn_get_lang_var('export_selected', $this->getLanguage()); ?>
</a></li>
				<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
			</ul>
			<?php $this->_smarty_vars['capture']['tools_list'] = ob_get_contents(); ob_end_clean(); ?>
			<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('but_text' => fn_get_lang_var('delete_selected', $this->getLanguage()), 'but_name' => "dispatch[profiles.m_delete]", 'but_meta' => "cm-confirm cm-process-items", 'but_role' => 'button_main', )); ?><?php if ($this->_tpl_vars['but_role'] == 'text'): ?>
	<?php $this->assign('class', "text-link", false); ?>
<?php elseif ($this->_tpl_vars['but_role'] == 'delete'): ?>
	<?php $this->assign('class', "text-button-delete", false); ?>
<?php elseif ($this->_tpl_vars['but_role'] == 'add'): ?>
	<?php $this->assign('class', "text-button text-button-add", false); ?>
<?php elseif ($this->_tpl_vars['but_role'] == 'reload'): ?>
	<?php $this->assign('class', "text-button text-button-reload", false); ?>
<?php elseif ($this->_tpl_vars['but_role'] == 'delete_item'): ?>
	<?php $this->assign('class', "text-button-delete-item", false); ?>
<?php elseif ($this->_tpl_vars['but_role'] == 'edit'): ?>
	<?php $this->assign('class', "text-button-edit", false); ?>
<?php elseif ($this->_tpl_vars['but_role'] == 'tool'): ?>
	<?php $this->assign('class', "tool-link", false); ?>
<?php elseif ($this->_tpl_vars['but_role'] == 'link'): ?>
	<?php $this->assign('class', "text-button-link", false); ?>
<?php elseif ($this->_tpl_vars['but_role'] == 'simple'): ?>
	<?php $this->assign('class', "text-button-simple", false); ?>
<?php else: ?>
	<?php $this->assign('class', "", false); ?>
<?php endif; ?>

<?php if ($this->_tpl_vars['but_name']): ?><?php $this->assign('r', $this->_tpl_vars['but_name'], false); ?><?php else: ?><?php $this->assign('r', $this->_tpl_vars['but_href'], false); ?><?php endif; ?>
<?php $this->assign('method', smarty_modifier_default(@$this->_tpl_vars['method'], 'POST'), false); ?>
<?php if (fn_check_view_permissions($this->_tpl_vars['r'], $this->_tpl_vars['method'])): ?>

<?php if ($this->_tpl_vars['but_name'] || $this->_tpl_vars['but_role'] == 'submit' || $this->_tpl_vars['but_role'] == 'button_main' || $this->_tpl_vars['but_type'] || $this->_tpl_vars['but_role'] == 'big'): ?> 
	<span <?php if ($this->_tpl_vars['but_css']): ?>style="<?php echo $this->_tpl_vars['but_css']; ?>
"<?php endif; ?> class="submit-button<?php if ($this->_tpl_vars['but_role'] == 'big'): ?>-big<?php endif; ?><?php if ($this->_tpl_vars['but_role'] == 'button_main'): ?> cm-button-main<?php endif; ?> <?php echo $this->_tpl_vars['but_meta']; ?>
"><input <?php if ($this->_tpl_vars['but_id']): ?>id="<?php echo $this->_tpl_vars['but_id']; ?>
"<?php endif; ?> <?php if ($this->_tpl_vars['but_meta']): ?>class="<?php echo $this->_tpl_vars['but_meta']; ?>
"<?php endif; ?> type="<?php echo smarty_modifier_default(@$this->_tpl_vars['but_type'], 'submit'); ?>
"<?php if ($this->_tpl_vars['but_name']): ?> name="<?php echo $this->_tpl_vars['but_name']; ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_onclick']): ?> onclick="<?php echo $this->_tpl_vars['but_onclick']; ?>
;<?php if (! $this->_tpl_vars['allow_href']): ?> return false;<?php endif; ?>"<?php endif; ?> value="<?php echo $this->_tpl_vars['but_text']; ?>
" <?php if ($this->_tpl_vars['tabindex']): ?>tabindex="<?php echo $this->_tpl_vars['tabindex']; ?>
"<?php endif; ?> <?php if ($this->_tpl_vars['but_rev']): ?> rev="<?php echo $this->_tpl_vars['but_rev']; ?>
"<?php endif; ?> <?php if ($this->_tpl_vars['but_disabled']): ?>disabled="disabled"<?php endif; ?> /></span>

<?php elseif ($this->_tpl_vars['but_role'] && $this->_tpl_vars['but_role'] != 'submit' && $this->_tpl_vars['but_role'] != 'action' && $this->_tpl_vars['but_role'] != "advanced-search" && $this->_tpl_vars['but_role'] != 'button'): ?> 
	<a <?php if ($this->_tpl_vars['but_id']): ?>id="<?php echo $this->_tpl_vars['but_id']; ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_href']): ?> href="<?php echo fn_url($this->_tpl_vars['but_href']); ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_onclick']): ?> onclick="<?php echo $this->_tpl_vars['but_onclick']; ?>
;<?php if (! $this->_tpl_vars['allow_href']): ?> return false;<?php endif; ?>"<?php endif; ?><?php if ($this->_tpl_vars['but_target']): ?> target="<?php echo $this->_tpl_vars['but_target']; ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_rev']): ?> rev="<?php echo $this->_tpl_vars['but_rev']; ?>
"<?php endif; ?> class="<?php echo $this->_tpl_vars['class']; ?>
<?php if ($this->_tpl_vars['but_meta']): ?> <?php echo $this->_tpl_vars['but_meta']; ?>
<?php endif; ?>"><?php if ($this->_tpl_vars['but_role'] == 'delete_item'): ?><img src="<?php echo $this->_tpl_vars['images_dir']; ?>
/icons/icon_delete.gif" width="12" height="18" border="0" alt="<?php echo fn_get_lang_var('remove_this_item', $this->getLanguage()); ?>
" title="<?php echo fn_get_lang_var('remove_this_item', $this->getLanguage()); ?>
" class="valign" /><?php else: ?><?php echo $this->_tpl_vars['but_text']; ?>
<?php endif; ?></a>

<?php elseif ($this->_tpl_vars['but_role'] == 'action' || $this->_tpl_vars['but_role'] == "advanced-search"): ?> 
	<a <?php if ($this->_tpl_vars['but_id']): ?>id="<?php echo $this->_tpl_vars['but_id']; ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_href']): ?> href="<?php echo fn_url($this->_tpl_vars['but_href']); ?>
"<?php endif; ?> <?php if ($this->_tpl_vars['but_onclick']): ?>onclick="<?php echo $this->_tpl_vars['but_onclick']; ?>
;<?php if (! $this->_tpl_vars['allow_href']): ?> return false;<?php endif; ?>"<?php endif; ?> <?php if ($this->_tpl_vars['but_target']): ?>target="<?php echo $this->_tpl_vars['but_target']; ?>
"<?php endif; ?> <?php if ($this->_tpl_vars['but_rev']): ?> rev="<?php echo $this->_tpl_vars['but_rev']; ?>
"<?php endif; ?> class="button<?php if ($this->_tpl_vars['but_meta']): ?> <?php echo $this->_tpl_vars['but_meta']; ?>
<?php endif; ?>"><?php echo $this->_tpl_vars['but_text']; ?>
<?php if ($this->_tpl_vars['but_role'] == 'action'): ?>&nbsp;<img src="<?php echo $this->_tpl_vars['images_dir']; ?>
/icons/but_arrow.gif" width="8" height="7" border="0" alt=""/><?php endif; ?></a>
	
<?php elseif ($this->_tpl_vars['but_role'] == 'button'): ?>
	<input <?php if ($this->_tpl_vars['but_id']): ?>id="<?php echo $this->_tpl_vars['but_id']; ?>
"<?php endif; ?> <?php if ($this->_tpl_vars['but_meta']): ?>class="<?php echo $this->_tpl_vars['but_meta']; ?>
"<?php endif; ?> type="button" <?php if ($this->_tpl_vars['but_onclick']): ?>onclick="<?php echo $this->_tpl_vars['but_onclick']; ?>
;<?php if (! $this->_tpl_vars['allow_href']): ?> return false;<?php endif; ?>"<?php endif; ?> value="<?php echo $this->_tpl_vars['but_text']; ?>
" <?php if ($this->_tpl_vars['tabindex']): ?>tabindex="<?php echo $this->_tpl_vars['tabindex']; ?>
"<?php endif; ?> <?php if ($this->_tpl_vars['but_rev']): ?> rev="<?php echo $this->_tpl_vars['but_rev']; ?>
"<?php endif; ?> />

<?php elseif ($this->_tpl_vars['but_role'] == 'icon'): ?> 
	<a <?php if ($this->_tpl_vars['but_id']): ?>id="<?php echo $this->_tpl_vars['but_id']; ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_href']): ?> href="<?php echo fn_url($this->_tpl_vars['but_href']); ?>
"<?php endif; ?> <?php if ($this->_tpl_vars['but_onclick']): ?>onclick="<?php echo $this->_tpl_vars['but_onclick']; ?>
;<?php if (! $this->_tpl_vars['allow_href']): ?> return false;<?php endif; ?>"<?php endif; ?> <?php if ($this->_tpl_vars['but_target']): ?>target="<?php echo $this->_tpl_vars['but_target']; ?>
"<?php endif; ?> <?php if ($this->_tpl_vars['but_rev']): ?> rev="<?php echo $this->_tpl_vars['but_rev']; ?>
"<?php endif; ?> class="<?php if ($this->_tpl_vars['but_meta']): ?> <?php echo $this->_tpl_vars['but_meta']; ?>
<?php endif; ?>"><?php echo $this->_tpl_vars['but_text']; ?>
</a>

<?php elseif (! $this->_tpl_vars['but_role']): ?> 
	<input <?php if ($this->_tpl_vars['but_id']): ?>id="<?php echo $this->_tpl_vars['but_id']; ?>
"<?php endif; ?> class="default-button<?php if ($this->_tpl_vars['but_meta']): ?> <?php echo $this->_tpl_vars['but_meta']; ?>
<?php endif; ?>" type="submit" onclick="<?php echo $this->_tpl_vars['but_onclick']; ?>
;<?php if (! $this->_tpl_vars['allow_href']): ?> return false;<?php endif; ?>" value="<?php echo $this->_tpl_vars['but_text']; ?>
" <?php if ($this->_tpl_vars['but_rev']): ?> rev="<?php echo $this->_tpl_vars['but_rev']; ?>
"<?php endif; ?> />
<?php endif; ?>

<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
			<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('prefix' => "main".($this->_tpl_vars['_REQUEST']['content_id']), 'hide_actions' => true, 'tools_list' => $this->_smarty_vars['capture']['tools_list'], 'display' => 'inline', 'link_text' => fn_get_lang_var('choose_action', $this->getLanguage()), )); ?><?php if ($this->_tpl_vars['skip_check_permissions'] || fn_check_view_permissions($this->_tpl_vars['tools_list'])): ?>

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
		<?php endif; ?>
	</div>	
</div>
<?php endif; ?>

<?php ob_start(); ?>
	<?php if ($this->_tpl_vars['_REQUEST']['user_type']): ?>
		<?php if (! ( defined('COMPANY_ID') && @PRODUCT_TYPE == 'MULTIVENDOR' && $this->_tpl_vars['_REQUEST']['user_type'] == 'C' )): ?>
			<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('tool_href' => "profiles.add?user_type=".($this->_tpl_vars['_REQUEST']['user_type']), 'prefix' => 'top', 'hide_tools' => true, 'link_text' => fn_get_lang_var('add_user', $this->getLanguage()), )); ?><?php if ($this->_tpl_vars['skip_check_permissions'] || fn_check_view_permissions($this->_tpl_vars['tools_list'])): ?>

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
		<?php endif; ?>
	<?php else: ?>
		<?php if (@PRODUCT_TYPE == 'PROFESSIONAL' && $this->_tpl_vars['settings']['Suppliers']['enable_suppliers'] == 'Y'): ?>
			<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('tool_href' => "companies.add", 'prefix' => 'bottom', 'hide_tools' => true, 'link_text' => fn_get_lang_var('add_supplier', $this->getLanguage()), )); ?><?php if ($this->_tpl_vars['skip_check_permissions'] || fn_check_view_permissions($this->_tpl_vars['tools_list'])): ?>

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
		<?php endif; ?>
		<?php $_from = $this->_tpl_vars['user_types']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['_k'] => $this->_tpl_vars['_p']):
?>
			<?php if (! ( defined('COMPANY_ID') && @PRODUCT_TYPE == 'MULTIVENDOR' && ( $this->_tpl_vars['_k'] == 'C' || defined('RESTRICTED_ADMIN') ) )): ?>
				<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('tool_href' => "profiles.add?user_type=".($this->_tpl_vars['_k']), 'prefix' => 'top', 'hide_tools' => true, 'link_text' => fn_get_lang_var($this->_tpl_vars['_p'], $this->getLanguage()), )); ?><?php if ($this->_tpl_vars['skip_check_permissions'] || fn_check_view_permissions($this->_tpl_vars['tools_list'])): ?>

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
			<?php endif; ?>
		<?php endforeach; endif; unset($_from); ?>
	<?php endif; ?>
<?php $this->_smarty_vars['capture']['tools'] = ob_get_contents(); ob_end_clean(); ?>

</form>
<!--content_manage_users--></div>

<?php $this->_smarty_vars['capture']['mainbox'] = ob_get_contents(); ob_end_clean(); ?>

<?php if ($this->_tpl_vars['_REQUEST']['user_type']): ?>
	<?php $this->assign('_title', fn_get_user_type_description($this->_tpl_vars['_REQUEST']['user_type'], true), false); ?>
<?php else: ?>
	<?php $this->assign('_title', fn_get_lang_var('users', $this->getLanguage()), false); ?>
<?php endif; ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/mainbox.tpl", 'smarty_include_vars' => array('title' => $this->_tpl_vars['_title'],'content' => $this->_smarty_vars['capture']['mainbox'],'title_extra' => $this->_smarty_vars['capture']['title_extra'],'tools' => $this->_smarty_vars['capture']['tools'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>