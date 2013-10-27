<?php /* Smarty version 2.6.18, created on 2013-10-24 19:12:11
         compiled from addons/billibuys/views/billibuys/components/categories_tree.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'math', 'addons/billibuys/views/billibuys/components/categories_tree.tpl', 44, false),array('modifier', 'default', 'addons/billibuys/views/billibuys/components/categories_tree.tpl', 44, false),array('modifier', 'fn_url', 'addons/billibuys/views/billibuys/components/categories_tree.tpl', 54, false),array('modifier', 'defined', 'addons/billibuys/views/billibuys/components/categories_tree.tpl', 117, false),array('modifier', 'lower', 'addons/billibuys/views/billibuys/components/categories_tree.tpl', 139, false),array('modifier', 'is_array', 'addons/billibuys/views/billibuys/components/categories_tree.tpl', 143, false),array('modifier', 'fn_from_json', 'addons/billibuys/views/billibuys/components/categories_tree.tpl', 144, false),array('modifier', 'trim', 'addons/billibuys/views/billibuys/components/categories_tree.tpl', 214, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('check_uncheck_all','position_short','expand_collapse_list','expand_collapse_list','expand_collapse_list','expand_collapse_list','name','requests','status','expand_sublist_of_items','expand_sublist_of_items','expand_sublist_of_items','expand_sublist_of_items','collapse_sublist_of_items','collapse_sublist_of_items','disabled','expand_sublist_of_items','expand_sublist_of_items','expand_sublist_of_items','expand_sublist_of_items','collapse_sublist_of_items','collapse_sublist_of_items','expand_sublist_of_items','expand_sublist_of_items','expand_sublist_of_items','expand_sublist_of_items','collapse_sublist_of_items','collapse_sublist_of_items','disabled','manage_products','active','hidden','disabled','pending','new','active','disabled','hidden','pending','new','active','disabled','hidden','pending','notify_customer','notify_orders_department','notify_vendor','notify_supplier','delete'));
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
			 ?><?php if ($this->_tpl_vars['parent_id']): ?>
<div class="hidden" id="cat_<?php echo $this->_tpl_vars['parent_id']; ?>
">
<?php endif; ?>
<?php $_from = $this->_tpl_vars['categories']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['category']):
?>
<?php $this->assign('comb_id', "cat_".($this->_tpl_vars['category']['bb_request_category_id']), false); ?>
<table cellpadding="0" cellspacing="0" border="0" width="100%" class="table table-tree">

<?php if ($this->_tpl_vars['header'] && ! $this->_tpl_vars['parent_id']): ?>
<?php $this->assign('header', "", false); ?>
<tr>
	<th class="center" width="3%">
		<input type="checkbox" name="check_all" value="Y" title="<?php echo fn_get_lang_var('check_uncheck_all', $this->getLanguage()); ?>
" class="checkbox cm-check-items" /></th>
	<th width="5%"><?php echo fn_get_lang_var('position_short', $this->getLanguage()); ?>
</th>
	<th width="57%">
		<?php if ($this->_tpl_vars['show_all'] && ! $this->_tpl_vars['_REQUEST']['b_id']): ?>
		<div class="float-left">
			<img src="<?php echo $this->_tpl_vars['images_dir']; ?>
/plus_minus.gif" width="13" height="12" border="0" alt="<?php echo fn_get_lang_var('expand_collapse_list', $this->getLanguage()); ?>
" title="<?php echo fn_get_lang_var('expand_collapse_list', $this->getLanguage()); ?>
" id="on_cat" class="hand cm-combinations<?php if ($this->_tpl_vars['expand_all']): ?> hidden<?php endif; ?>" />
			<img src="<?php echo $this->_tpl_vars['images_dir']; ?>
/minus_plus.gif" width="13" height="12" border="0" alt="<?php echo fn_get_lang_var('expand_collapse_list', $this->getLanguage()); ?>
" title="<?php echo fn_get_lang_var('expand_collapse_list', $this->getLanguage()); ?>
" id="off_cat" class="hand cm-combinations<?php if (! $this->_tpl_vars['expand_all']): ?> hidden<?php endif; ?>" />
		</div>
		<?php endif; ?>
		&nbsp;<?php echo fn_get_lang_var('name', $this->getLanguage()); ?>
	</th>
	<th class="right" width="15%"><?php echo fn_get_lang_var('requests', $this->getLanguage()); ?>
</th>
	<th width="10%"><?php echo fn_get_lang_var('status', $this->getLanguage()); ?>
</th>
	<th width="10%" class="nowrap">&nbsp;</th>
</tr>
<?php endif; ?>

<?php if ($this->_tpl_vars['category']['disabled']): ?>
<tr <?php if ($this->_tpl_vars['category']['level'] > 0): ?>class="multiple-table-row"<?php endif; ?>>
   	<?php echo smarty_function_math(array('equation' => "x*14",'x' => smarty_modifier_default(@$this->_tpl_vars['category']['level'], '0'),'assign' => 'shift'), $this);?>

	<td class="center" width="3%">&nbsp;</td>
	<td width="5%">&nbsp;</td>
	<td width="57%">
	<?php echo '<span class="strong" style="padding-left: '; ?><?php echo $this->_tpl_vars['shift']; ?><?php echo 'px;">'; ?><?php if ($this->_tpl_vars['category']['has_children'] || $this->_tpl_vars['category']['subcategories']): ?><?php echo ''; ?><?php if ($this->_tpl_vars['show_all']): ?><?php echo '<img src="'; ?><?php echo $this->_tpl_vars['images_dir']; ?><?php echo '/plus.gif" width="14" height="9" border="0" alt="'; ?><?php echo fn_get_lang_var('expand_sublist_of_items', $this->getLanguage()); ?><?php echo '" title="'; ?><?php echo fn_get_lang_var('expand_sublist_of_items', $this->getLanguage()); ?><?php echo '" id="on_'; ?><?php echo $this->_tpl_vars['comb_id']; ?><?php echo '" class="hand cm-combination '; ?><?php if ($this->_tpl_vars['expand_all']): ?><?php echo 'hidden'; ?><?php endif; ?><?php echo '" />'; ?><?php else: ?><?php echo '<img src="'; ?><?php echo $this->_tpl_vars['images_dir']; ?><?php echo '/plus.gif" width="14" height="9" border="0" alt="'; ?><?php echo fn_get_lang_var('expand_sublist_of_items', $this->getLanguage()); ?><?php echo '" title="'; ?><?php echo fn_get_lang_var('expand_sublist_of_items', $this->getLanguage()); ?><?php echo '" id="on_'; ?><?php echo $this->_tpl_vars['comb_id']; ?><?php echo '" class="hand cm-combination" onclick="if (!$(\'#'; ?><?php echo $this->_tpl_vars['comb_id']; ?><?php echo '\').children().get(0)) $.ajaxRequest(\''; ?><?php echo fn_url("categories.manage?category_id=".($this->_tpl_vars['category']['bb_request_category_id']), 'A', 'rel', '&'); ?><?php echo '\', '; ?><?php echo $this->_tpl_vars['ldelim']; ?><?php echo 'result_ids: \''; ?><?php echo $this->_tpl_vars['comb_id']; ?><?php echo '\''; ?><?php echo $this->_tpl_vars['rdelim']; ?><?php echo ')" />'; ?><?php endif; ?><?php echo '<img src="'; ?><?php echo $this->_tpl_vars['images_dir']; ?><?php echo '/minus.gif" width="14" height="9" border="0" alt="'; ?><?php echo fn_get_lang_var('collapse_sublist_of_items', $this->getLanguage()); ?><?php echo '" title="'; ?><?php echo fn_get_lang_var('collapse_sublist_of_items', $this->getLanguage()); ?><?php echo '" id="off_'; ?><?php echo $this->_tpl_vars['comb_id']; ?><?php echo '" class="hand cm-combination'; ?><?php if (! $this->_tpl_vars['expand_all'] || ! $this->_tpl_vars['show_all']): ?><?php echo ' hidden'; ?><?php endif; ?><?php echo '" />&nbsp;'; ?><?php endif; ?><?php echo ''; ?><?php echo $this->_tpl_vars['category']['category']; ?><?php echo ''; ?><?php if ($this->_tpl_vars['category']['status'] == 'N'): ?><?php echo '&nbsp;<span class="small-note">-&nbsp;['; ?><?php echo fn_get_lang_var('disabled', $this->getLanguage()); ?><?php echo ']</span>'; ?><?php endif; ?><?php echo '</span>'; ?>

	</td>
	<td width="15%" class="nowrap right">&nbsp;</td>
	<td width="10%">&nbsp;</td>
	<td width="10%" class="nowrap">&nbsp;</td>
</tr>

<?php else: ?>

<tr <?php if ($this->_tpl_vars['category']['level'] > 0): ?>class="multiple-table-row"<?php endif; ?>>
   	<?php echo smarty_function_math(array('equation' => "x*14",'x' => smarty_modifier_default(@$this->_tpl_vars['category']['level'], '0'),'assign' => 'shift'), $this);?>

	<?php if ($this->_tpl_vars['category']['company_categories']): ?>
		<?php $this->assign('comb_id', "comp_".($this->_tpl_vars['category']['company_id']), false); ?>
		<td class="center" width="3%">
			&nbsp;</td>
		<td width="5%">
			&nbsp;</td>
		<td width="57%">
		<?php echo '<span class="strong" style="padding-left: '; ?><?php echo $this->_tpl_vars['shift']; ?><?php echo 'px;">'; ?><?php if ($this->_tpl_vars['show_all']): ?><?php echo '<img src="'; ?><?php echo $this->_tpl_vars['images_dir']; ?><?php echo '/plus.gif" width="14" height="9" border="0" alt="'; ?><?php echo fn_get_lang_var('expand_sublist_of_items', $this->getLanguage()); ?><?php echo '" title="'; ?><?php echo fn_get_lang_var('expand_sublist_of_items', $this->getLanguage()); ?><?php echo '" id="on_'; ?><?php echo $this->_tpl_vars['comb_id']; ?><?php echo '" class="hand cm-combination '; ?><?php if ($this->_tpl_vars['expand_all']): ?><?php echo 'hidden'; ?><?php endif; ?><?php echo '" />'; ?><?php else: ?><?php echo '<img src="'; ?><?php echo $this->_tpl_vars['images_dir']; ?><?php echo '/plus.gif" width="14" height="9" border="0" alt="'; ?><?php echo fn_get_lang_var('expand_sublist_of_items', $this->getLanguage()); ?><?php echo '" title="'; ?><?php echo fn_get_lang_var('expand_sublist_of_items', $this->getLanguage()); ?><?php echo '" id="on_'; ?><?php echo $this->_tpl_vars['comb_id']; ?><?php echo '" class="hand cm-combination" onclick="if (!$(\'#'; ?><?php echo $this->_tpl_vars['comb_id']; ?><?php echo '\').children().get(0)) $.ajaxRequest(\''; ?><?php echo fn_url("categories.manage?category_id=".($this->_tpl_vars['category']['bb_request_category_id']), 'A', 'rel', '&'); ?><?php echo '\', '; ?><?php echo $this->_tpl_vars['ldelim']; ?><?php echo 'result_ids: \''; ?><?php echo $this->_tpl_vars['comb_id']; ?><?php echo '\''; ?><?php echo $this->_tpl_vars['rdelim']; ?><?php echo ')" />'; ?><?php endif; ?><?php echo '<img src="'; ?><?php echo $this->_tpl_vars['images_dir']; ?><?php echo '/minus.gif" width="14" height="9" border="0" alt="'; ?><?php echo fn_get_lang_var('collapse_sublist_of_items', $this->getLanguage()); ?><?php echo '" title="'; ?><?php echo fn_get_lang_var('collapse_sublist_of_items', $this->getLanguage()); ?><?php echo '" id="off_'; ?><?php echo $this->_tpl_vars['comb_id']; ?><?php echo '" class="hand cm-combination'; ?><?php if (! $this->_tpl_vars['expand_all'] || ! $this->_tpl_vars['show_all']): ?><?php echo ' hidden'; ?><?php endif; ?><?php echo '" />&nbsp;<a href="'; ?><?php echo fn_url("companies.update?company_id=".($this->_tpl_vars['category']['company_id'])); ?><?php echo '">'; ?><?php echo $this->_tpl_vars['category']['category']; ?><?php echo '</a></span>'; ?>

		</td>
		<td width="15%" class="nowrap right">
			&nbsp;</td>
		<td width="10%">
			&nbsp;</td>
		<td width="10%" class="nowrap">
			&nbsp;</td>
	<?php else: ?>
		<td class="center" width="3%">
			<input type="checkbox" name="category_ids[]" value="<?php echo $this->_tpl_vars['category']['bb_request_category_id']; ?>
" class="checkbox cm-item" /></td>
		<td width="5%">
			<input type="text" name="categories_data[<?php echo $this->_tpl_vars['category']['bb_request_category_id']; ?>
][position]" value="<?php echo $this->_tpl_vars['category']['position']; ?>
" size="3" class="input-text-short" /></td>
		<td width="57%">
		<?php echo '<span class="strong" style="padding-left: '; ?><?php echo $this->_tpl_vars['shift']; ?><?php echo 'px;">'; ?><?php if ($this->_tpl_vars['category']['has_children'] || $this->_tpl_vars['category']['subcategories']): ?><?php echo ''; ?><?php if ($this->_tpl_vars['show_all']): ?><?php echo '<img src="'; ?><?php echo $this->_tpl_vars['images_dir']; ?><?php echo '/plus.gif" width="14" height="9" border="0" alt="'; ?><?php echo fn_get_lang_var('expand_sublist_of_items', $this->getLanguage()); ?><?php echo '" title="'; ?><?php echo fn_get_lang_var('expand_sublist_of_items', $this->getLanguage()); ?><?php echo '" id="on_'; ?><?php echo $this->_tpl_vars['comb_id']; ?><?php echo '" class="hand cm-combination '; ?><?php if ($this->_tpl_vars['expand_all']): ?><?php echo 'hidden'; ?><?php endif; ?><?php echo '" />'; ?><?php else: ?><?php echo '<img src="'; ?><?php echo $this->_tpl_vars['images_dir']; ?><?php echo '/plus.gif" width="14" height="9" border="0" alt="'; ?><?php echo fn_get_lang_var('expand_sublist_of_items', $this->getLanguage()); ?><?php echo '" title="'; ?><?php echo fn_get_lang_var('expand_sublist_of_items', $this->getLanguage()); ?><?php echo '" id="on_'; ?><?php echo $this->_tpl_vars['comb_id']; ?><?php echo '" class="hand cm-combination" onclick="if (!$(\'#'; ?><?php echo $this->_tpl_vars['comb_id']; ?><?php echo '\').children().get(0)) $.ajaxRequest(\''; ?><?php echo fn_url("categories.manage?category_id=".($this->_tpl_vars['category']['bb_request_category_id']), 'A', 'rel', '&'); ?><?php echo '\', '; ?><?php echo $this->_tpl_vars['ldelim']; ?><?php echo 'result_ids: \''; ?><?php echo $this->_tpl_vars['comb_id']; ?><?php echo '\''; ?><?php echo $this->_tpl_vars['rdelim']; ?><?php echo ')" />'; ?><?php endif; ?><?php echo '<img src="'; ?><?php echo $this->_tpl_vars['images_dir']; ?><?php echo '/minus.gif" width="14" height="9" border="0" alt="'; ?><?php echo fn_get_lang_var('collapse_sublist_of_items', $this->getLanguage()); ?><?php echo '" title="'; ?><?php echo fn_get_lang_var('collapse_sublist_of_items', $this->getLanguage()); ?><?php echo '" id="off_'; ?><?php echo $this->_tpl_vars['comb_id']; ?><?php echo '" class="hand cm-combination'; ?><?php if (! $this->_tpl_vars['expand_all'] || ! $this->_tpl_vars['show_all']): ?><?php echo ' hidden'; ?><?php endif; ?><?php echo '" />&nbsp;'; ?><?php endif; ?><?php echo '<a href="'; ?><?php echo fn_url("categories.update?category_id=".($this->_tpl_vars['category']['bb_request_category_id'])); ?><?php echo '"'; ?><?php if ($this->_tpl_vars['category']['status'] == 'N'): ?><?php echo ' class="manage-root-item-disabled"'; ?><?php endif; ?><?php echo ''; ?><?php if (! $this->_tpl_vars['category']['subcategories']): ?><?php echo ' style="padding-left: 14px;" class="normal"'; ?><?php endif; ?><?php echo ' >'; ?><?php echo $this->_tpl_vars['category']['category_name']; ?><?php echo ' '; ?><?php echo '</a>'; ?><?php if ($this->_tpl_vars['category']['status'] == 'N'): ?><?php echo '&nbsp;<span class="small-note">-&nbsp;['; ?><?php echo fn_get_lang_var('disabled', $this->getLanguage()); ?><?php echo ']</span>'; ?><?php endif; ?><?php echo '</span>'; ?>

		</td>
		<td width="15%" class="nowrap right">
			<a href="<?php echo fn_url("billibuys.view?category_id=".($this->_tpl_vars['category']['bb_request_category_id'])); ?>
" class="num-items"><?php if (defined('COMPANY_ID')): ?><?php echo fn_get_lang_var('manage_products', $this->getLanguage()); ?>
<?php else: ?><span>&nbsp;<?php echo $this->_tpl_vars['category']['product_count']; ?>
&nbsp;</span><?php endif; ?></a>&nbsp;
					</td>
		<td width="10%">
			<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('id' => $this->_tpl_vars['category']['bb_request_category_id'], 'status' => $this->_tpl_vars['category']['status'], 'hidden' => true, 'object_id_name' => 'bb_request_category_id', 'table' => 'bb_request_categories', )); ?><?php if ($this->_tpl_vars['display'] == 'text'): ?>
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
		<td width="10%" class="nowrap">
			<?php ob_start(); ?>
			<li><a class="cm-confirm" href="<?php echo fn_url("categories.delete?category_id=".($this->_tpl_vars['category']['bb_request_category_id'])); ?>
"><?php echo fn_get_lang_var('delete', $this->getLanguage()); ?>
</a></li>
			<?php $this->_smarty_vars['capture']['tools_items'] = ob_get_contents(); ob_end_clean(); ?>
			<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/table_tools_list.tpl", 'smarty_include_vars' => array('prefix' => $this->_tpl_vars['category']['bb_request_category_id'],'tools_list' => $this->_smarty_vars['capture']['tools_items'],'href' => "billibuys.category_update?category_id=".($this->_tpl_vars['category']['bb_request_category_id']))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</td>
	<?php endif; ?>
</tr>

<?php endif; ?>

</table>
<?php if ($this->_tpl_vars['category']['has_children'] || $this->_tpl_vars['category']['subcategories']): ?>
	<div<?php if (! $this->_tpl_vars['expand_all']): ?> class="hidden"<?php endif; ?> id="<?php echo $this->_tpl_vars['comb_id']; ?>
">
	<?php if ($this->_tpl_vars['category']['subcategories']): ?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/categories/components/categories_tree.tpl", 'smarty_include_vars' => array('categories_tree' => $this->_tpl_vars['category']['subcategories'],'parent_id' => false)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php endif; ?>
	<!--<?php echo $this->_tpl_vars['comb_id']; ?>
--></div>
<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
<?php if ($this->_tpl_vars['parent_id']): ?><!--cat_<?php echo $this->_tpl_vars['parent_id']; ?>
--></div><?php endif; ?>