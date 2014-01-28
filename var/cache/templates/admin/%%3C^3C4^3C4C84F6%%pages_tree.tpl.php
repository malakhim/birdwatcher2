<?php /* Smarty version 2.6.18, created on 2014-01-28 16:50:03
         compiled from views/pages/components/pages_tree.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'fn_get_company_name', 'views/pages/components/pages_tree.tpl', 21, false),array('modifier', 'default', 'views/pages/components/pages_tree.tpl', 70, false),array('modifier', 'fn_url', 'views/pages/components/pages_tree.tpl', 76, false),array('modifier', 'lower', 'views/pages/components/pages_tree.tpl', 115, false),array('modifier', 'is_array', 'views/pages/components/pages_tree.tpl', 119, false),array('modifier', 'fn_from_json', 'views/pages/components/pages_tree.tpl', 120, false),array('modifier', 'trim', 'views/pages/components/pages_tree.tpl', 190, false),array('function', 'math', 'views/pages/components/pages_tree.tpl', 70, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('vendor','check_uncheck_all','position_short','expand_collapse_list','expand_collapse_list','expand_collapse_list','expand_collapse_list','name','status','expand_sublist_of_items','expand_sublist_of_items','collapse_sublist_of_items','collapse_sublist_of_items','active','hidden','disabled','pending','new','active','disabled','hidden','pending','new','active','disabled','hidden','pending','notify_customer','notify_orders_department','notify_vendor','notify_supplier','delete','no_data'));
?>
<?php 

				$rname = !empty($resource_name) ? $resource_name : $params['smarty_include_tpl_file'];
				if ($this->compile_check && empty($inline_no_check[$rname]) && $this->is_cached($rname)) {
					if ($this->check_inline_blocks(array (
  'common_templates/select_popup.tpl' => 1367063753,
))) {
						$_smarty_compile_path = $this->_get_compile_path($rname);
						$this->_compile_resource($rname, $_smarty_compile_path);
						$inline_no_check[$rname] = true;
						include $_smarty_compile_path;
						return;
					}
				}
			 ?><?php if (! $this->_tpl_vars['checkbox_name']): ?><?php $this->assign('checkbox_name', 'page_ids', false); ?><?php endif; ?>

<?php if ($this->_tpl_vars['parent_id']): ?><div <?php if (! $this->_tpl_vars['expand_all']): ?>class="hidden"<?php endif; ?> id="page<?php echo $this->_tpl_vars['combination_suffix']; ?>
_<?php echo $this->_tpl_vars['parent_id']; ?>
"><?php endif; ?>
<?php $_from = $this->_tpl_vars['pages_tree']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['page']):
?>

<?php if ($this->_tpl_vars['page']['company_id']): ?>
	<?php $this->assign('company_name', fn_get_company_name($this->_tpl_vars['page']['company_id']), false); ?>
	<?php $this->assign('page_name', ($this->_tpl_vars['page']['page'])." (".(fn_get_lang_var('vendor', $this->getLanguage())).": ".($this->_tpl_vars['company_name']).")", false); ?>
<?php else: ?>
	<?php $this->assign('page_name', $this->_tpl_vars['page']['page'], false); ?>
<?php endif; ?>
<table cellpadding="0" cellspacing="0" border="0" width="100%" class="table table-tree">
<?php if ($this->_tpl_vars['header'] && ! $this->_tpl_vars['hide_header']): ?>
<?php $this->assign('header', "", false); ?>
<tr>
	<th class="center" width="1%">
	<?php if ($this->_tpl_vars['display'] != 'radio'): ?>
		<input type="checkbox" name="check_all" value="Y" title="<?php echo fn_get_lang_var('check_uncheck_all', $this->getLanguage()); ?>
" class="checkbox cm-check-items" />
	<?php endif; ?>
	</th>
	<?php if (! $this->_tpl_vars['picker']): ?>
	<th class="center"><?php echo fn_get_lang_var('position_short', $this->getLanguage()); ?>
</th>
	<?php endif; ?>
	<th width="80%">
		<?php if (! $this->_tpl_vars['hide_show_all'] && ! $this->_tpl_vars['search']['paginate']): ?>
		<div class="float-left">
			<img src="<?php echo $this->_tpl_vars['images_dir']; ?>
/plus_minus.gif" width="13" height="12" border="0" alt="<?php echo fn_get_lang_var('expand_collapse_list', $this->getLanguage()); ?>
" title="<?php echo fn_get_lang_var('expand_collapse_list', $this->getLanguage()); ?>
" id="on_page<?php echo $this->_tpl_vars['combination_suffix']; ?>
" class="hand cm-combinations-pages<?php echo $this->_tpl_vars['combination_suffix']; ?>
<?php if ($this->_tpl_vars['expand_all']): ?> hidden<?php endif; ?>" />
			<img src="<?php echo $this->_tpl_vars['images_dir']; ?>
/minus_plus.gif" width="13" height="12" border="0" alt="<?php echo fn_get_lang_var('expand_collapse_list', $this->getLanguage()); ?>
" title="<?php echo fn_get_lang_var('expand_collapse_list', $this->getLanguage()); ?>
" id="off_page<?php echo $this->_tpl_vars['combination_suffix']; ?>
" class="hand cm-combinations-pages<?php echo $this->_tpl_vars['combination_suffix']; ?>
<?php if (! $this->_tpl_vars['expand_all']): ?> hidden<?php endif; ?>" />
		</div>
		&nbsp;
		<?php endif; ?>
		<?php echo fn_get_lang_var('name', $this->getLanguage()); ?>

	</th>
	<?php if (! $this->_tpl_vars['picker']): ?>
	<th width="15%"><?php echo fn_get_lang_var('status', $this->getLanguage()); ?>
</th>
	<?php endif; ?>
	<?php if (! $this->_tpl_vars['hide_delete_button']): ?><th>&nbsp;</th><?php endif; ?>
</tr>
<?php endif; ?>
<tr <?php if ($this->_tpl_vars['page']['level'] > 0 && ! $this->_tpl_vars['search']['paginate']): ?>class="multiple-table-row"<?php endif; ?>>
	<td class="center" width="1%">
		<?php if ($this->_tpl_vars['display'] == 'radio'): ?>
		<input type="radio" name="<?php echo $this->_tpl_vars['checkbox_name']; ?>
" value="<?php echo $this->_tpl_vars['page']['page_id']; ?>
" class="radio cm-item" />
		<?php else: ?>
		<input type="checkbox" name="<?php echo $this->_tpl_vars['checkbox_name']; ?>
[]" id="delete_checkbox" value="<?php echo $this->_tpl_vars['page']['page_id']; ?>
" class="checkbox cm-item" />
		<?php endif; ?>
	</td>
	<?php if (! $this->_tpl_vars['picker']): ?>
	<td>
		<input type="text" name="pages_data[<?php echo $this->_tpl_vars['page']['page_id']; ?>
][position]" size="3" maxlength="10" value="<?php echo $this->_tpl_vars['page']['position']; ?>
" class="input-text-short" />

	</td>
	<?php endif; ?>
	<td width="80%">
		<?php echo '<div class="float-left" '; ?><?php if (! $this->_tpl_vars['search']['paginate']): ?><?php echo 'style="padding-left: '; ?><?php echo smarty_function_math(array('equation' => "x*14",'x' => smarty_modifier_default(@$this->_tpl_vars['page']['level'], 0)), $this);?><?php echo 'px;"'; ?><?php endif; ?><?php echo '>'; ?><?php if ($this->_tpl_vars['page']['subpages'] || $this->_tpl_vars['page']['has_children']): ?><?php echo ''; ?><?php $this->assign('_dispatch', smarty_modifier_default(@$this->_tpl_vars['dispatch'], "pages.manage"), false); ?><?php echo ''; ?><?php if ($this->_tpl_vars['except_id']): ?><?php echo ''; ?><?php $this->assign('except_url', "&except_id=".($this->_tpl_vars['except_id']), false); ?><?php echo ''; ?><?php endif; ?><?php echo '<img src="'; ?><?php echo $this->_tpl_vars['images_dir']; ?><?php echo '/plus.gif" width="14" height="9" border="0" alt="'; ?><?php echo fn_get_lang_var('expand_sublist_of_items', $this->getLanguage()); ?><?php echo '" title="'; ?><?php echo fn_get_lang_var('expand_sublist_of_items', $this->getLanguage()); ?><?php echo '" id="on_page'; ?><?php echo $this->_tpl_vars['combination_suffix']; ?><?php echo '_'; ?><?php echo $this->_tpl_vars['page']['page_id']; ?><?php echo '" class="hand cm-combination-pages'; ?><?php echo $this->_tpl_vars['combination_suffix']; ?><?php echo ' '; ?><?php if ($this->_tpl_vars['expand_all'] && ! $this->_tpl_vars['hide_show_all']): ?><?php echo 'hidden'; ?><?php endif; ?><?php echo '" '; ?><?php if ($this->_tpl_vars['page']['has_children']): ?><?php echo 'onclick="$.ajaxRequest(\''; ?><?php echo fn_url(($this->_tpl_vars['_dispatch'])."?parent_id=".($this->_tpl_vars['page']['page_id'])."&get_tree=multi_level".($this->_tpl_vars['except_url'])."&display=".($this->_tpl_vars['display'])."&checkbox_name=".($this->_tpl_vars['checkbox_name'])."&combination_suffix=".($this->_tpl_vars['combination_suffix']), 'A', 'rel', '&'); ?><?php echo '\', '; ?><?php echo $this->_tpl_vars['ldelim']; ?><?php echo 'result_ids: \'page'; ?><?php echo $this->_tpl_vars['combination_suffix']; ?><?php echo '_'; ?><?php echo $this->_tpl_vars['page']['page_id']; ?><?php echo '\', caching: true'; ?><?php echo $this->_tpl_vars['rdelim']; ?><?php echo ');"'; ?><?php endif; ?><?php echo ' /><img src="'; ?><?php echo $this->_tpl_vars['images_dir']; ?><?php echo '/minus.gif" width="14" height="9" border="0" alt="'; ?><?php echo fn_get_lang_var('collapse_sublist_of_items', $this->getLanguage()); ?><?php echo '" title="'; ?><?php echo fn_get_lang_var('collapse_sublist_of_items', $this->getLanguage()); ?><?php echo '" id="off_page'; ?><?php echo $this->_tpl_vars['combination_suffix']; ?><?php echo '_'; ?><?php echo $this->_tpl_vars['page']['page_id']; ?><?php echo '" class="hand cm-combination-pages'; ?><?php echo $this->_tpl_vars['combination_suffix']; ?><?php echo ' '; ?><?php if (! $this->_tpl_vars['expand_all'] || $this->_tpl_vars['hide_show_all']): ?><?php echo 'hidden'; ?><?php endif; ?><?php echo '" />'; ?><?php elseif (! $this->_tpl_vars['search']['paginate']): ?><?php echo '<span style="padding-left: 14px;">&nbsp;</span>'; ?><?php endif; ?><?php echo ''; ?><?php if (! $this->_tpl_vars['picker']): ?><?php echo '<a href="'; ?><?php echo fn_url("pages.update?page_id=".($this->_tpl_vars['page']['page_id'])."&amp;come_from=".($this->_tpl_vars['come_from'])); ?><?php echo '" '; ?><?php if ($this->_tpl_vars['page']['status'] == 'N'): ?><?php echo 'class="manage-root-item-disabled"'; ?><?php endif; ?><?php echo ' id="page_title_'; ?><?php echo $this->_tpl_vars['page']['page_id']; ?><?php echo '">'; ?><?php else: ?><?php echo '<span id="page_title_'; ?><?php echo $this->_tpl_vars['page']['page_id']; ?><?php echo '">'; ?><?php endif; ?><?php echo ''; ?><?php echo $this->_tpl_vars['page_name']; ?><?php echo ''; ?><?php if (! $this->_tpl_vars['picker']): ?><?php echo '</a>'; ?><?php else: ?><?php echo '</span>'; ?><?php endif; ?><?php echo ''; ?><?php if ($this->_tpl_vars['page']['page_type']): ?><?php echo ''; ?><?php $this->assign('pt', $this->_tpl_vars['page_types'][$this->_tpl_vars['page']['page_type']], false); ?><?php echo '&nbsp;<span class="small-note lowercase">('; ?><?php echo fn_get_lang_var($this->_tpl_vars['pt']['single'], $this->getLanguage()); ?><?php echo ')</span>'; ?><?php endif; ?><?php echo '</div>'; ?>

	</td>
	<?php if (! $this->_tpl_vars['picker']): ?>
	<td width="15%">

		<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('id' => $this->_tpl_vars['page']['page_id'], 'status' => $this->_tpl_vars['page']['status'], 'hidden' => true, 'object_id_name' => 'page_id', 'table' => 'pages', )); ?><?php if ($this->_tpl_vars['display'] == 'text'): ?>
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
	<?php endif; ?>
	<?php if (! $this->_tpl_vars['hide_delete_button']): ?>
	<td class="nowrap">
		<input type="hidden" name="pages_data[<?php echo $this->_tpl_vars['page']['page_id']; ?>
][parent_id]" size="3" maxlength="10" value="<?php echo $this->_tpl_vars['page']['parent_id']; ?>
" />
		<?php ob_start(); ?>
		<?php if ($this->_tpl_vars['search']['get_tree']): ?>
			<?php $this->assign('multi_level', "&amp;multi_level=Y", false); ?>
		<?php endif; ?>
		<li>

			<a class="cm-confirm" href="<?php echo fn_url("pages.delete?page_type=".($this->_tpl_vars['page']['page_type'])."&amp;page_id=".($this->_tpl_vars['page']['page_id']).($this->_tpl_vars['multi_level'])."&amp;come_from=".($this->_tpl_vars['come_from'])); ?>
">

			<?php echo fn_get_lang_var('delete', $this->getLanguage()); ?>


			</a>

		</li>
		<?php $this->_smarty_vars['capture']['tools_items'] = ob_get_contents(); ob_end_clean(); ?>
		<?php if (! $this->_tpl_vars['picker']): ?>
			<?php $this->assign('_href', "pages.update?page_id=".($this->_tpl_vars['page']['page_id'])."&amp;come_from=".($this->_tpl_vars['come_from']), false); ?>
		<?php endif; ?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/table_tools_list.tpl", 'smarty_include_vars' => array('prefix' => $this->_tpl_vars['promotion']['promotion_id'],'tools_list' => $this->_smarty_vars['capture']['tools_items'],'href' => $this->_tpl_vars['_href'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</td>
	<?php endif; ?>
</tr>
</table>

<?php if ($this->_tpl_vars['page']['subpages'] || $this->_tpl_vars['page']['has_children']): ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/pages/components/pages_tree.tpl", 'smarty_include_vars' => array('pages_tree' => $this->_tpl_vars['page']['subpages'],'parent_id' => $this->_tpl_vars['page']['page_id'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php endif; ?>
<?php endforeach; else: ?>
	<?php if (! $this->_tpl_vars['hide_show_all']): ?>
		<p class="no-items"><?php echo fn_get_lang_var('no_data', $this->getLanguage()); ?>
</p>
	<?php endif; ?>
<?php endif; unset($_from); ?>

<?php if ($this->_tpl_vars['parent_id']): ?><!--page<?php echo $this->_tpl_vars['combination_suffix']; ?>
_<?php echo $this->_tpl_vars['parent_id']; ?>
--></div><?php endif; ?>