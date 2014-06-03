<?php /* Smarty version 2.6.18, created on 2014-06-03 11:12:04
         compiled from addons/billibuys/views/billibuys/place_bid.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'addons/billibuys/views/billibuys/place_bid.tpl', 1, false),array('modifier', 'fn_url', 'addons/billibuys/views/billibuys/place_bid.tpl', 1, false),array('modifier', 'fn_query_remove', 'addons/billibuys/views/billibuys/place_bid.tpl', 30, false),array('modifier', 'unescape', 'addons/billibuys/views/billibuys/place_bid.tpl', 77, false),array('modifier', 'fn_generate_thumbnail', 'addons/billibuys/views/billibuys/place_bid.tpl', 77, false),array('modifier', 'escape', 'addons/billibuys/views/billibuys/place_bid.tpl', 77, false),array('modifier', 'fn_format_price', 'addons/billibuys/views/billibuys/place_bid.tpl', 111, false),array('modifier', 'fn_check_view_permissions', 'addons/billibuys/views/billibuys/place_bid.tpl', 218, false),array('modifier', 'substr_count', 'addons/billibuys/views/billibuys/place_bid.tpl', 222, false),array('modifier', 'replace', 'addons/billibuys/views/billibuys/place_bid.tpl', 223, false),array('modifier', 'defined', 'addons/billibuys/views/billibuys/place_bid.tpl', 235, false),array('function', 'cycle', 'addons/billibuys/views/billibuys/place_bid.tpl', 52, false),array('function', 'math', 'addons/billibuys/views/billibuys/place_bid.tpl', 71, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('place_bid_instr','position_short','image','name','price','purchased_qty','subtotal_sum','quantity','update_for_all_hid_act','update_for_all_hid_dis','update_for_all_act','update_for_all_dis','no_data','btn_place_bid_txt','select_fields_to_edit','create_product_package','or','tools','add','products'));
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
			 ?><?php ob_start(); ?>

<?php echo '
<script src="addons/billibuys/js/place_bid.js" type="text/javascript"></script>
'; ?>

<?php echo fn_get_lang_var('place_bid_instr', $this->getLanguage()); ?>

<div id="content_manage_products">
<form action="<?php echo fn_url(""); ?>
" method="post" name="manage_products_form">
<input type="hidden" name="request_id" value="<?php echo $this->_tpl_vars['_REQUEST']['request_id']; ?>
" id="request_id"/>

<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/pagination.tpl", 'smarty_include_vars' => array('save_current_page' => true,'save_current_url' => true,'div_id' => $this->_tpl_vars['_REQUEST']['content_id'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php $this->assign('c_url', fn_query_remove($this->_tpl_vars['config']['current_url'], 'sort_by', 'sort_order'), false); ?>

<?php $this->assign('rev', smarty_modifier_default(@$this->_tpl_vars['_REQUEST']['content_id'], 'pagination_contents'), false); ?>

<table cellpadding="0" cellspacing="0" border="0" width="100%" class="table sortable hidden-inputs">
<tr>
	<th class="center"></th>
	<?php if ($this->_tpl_vars['search']['cid'] && $this->_tpl_vars['search']['subcats'] != 'Y'): ?>
	<th><a class="cm-ajax<?php if ($this->_tpl_vars['search']['sort_by'] == 'position'): ?> sort-link-<?php echo $this->_tpl_vars['search']['sort_order']; ?>
<?php endif; ?>" href="<?php echo fn_url(($this->_tpl_vars['c_url'])."&amp;sort_by=position&amp;sort_order=".($this->_tpl_vars['search']['sort_order'])); ?>
" rev=<?php echo $this->_tpl_vars['rev']; ?>
><?php echo fn_get_lang_var('position_short', $this->getLanguage()); ?>
</a></th>
	<?php endif; ?>
	<th width="5%"><span><?php echo fn_get_lang_var('image', $this->getLanguage()); ?>
</span></th>
	<th width="60%"><a class="<?php echo $this->_tpl_vars['ajax_class']; ?>
<?php if ($this->_tpl_vars['search']['sort_by'] == 'product'): ?> sort-link-<?php echo $this->_tpl_vars['search']['sort_order']; ?>
<?php endif; ?>" href="<?php echo fn_url(($this->_tpl_vars['c_url'])."&amp;sort_by=product&amp;sort_order=".($this->_tpl_vars['search']['sort_order'])); ?>
" rev=<?php echo $this->_tpl_vars['rev']; ?>
><?php echo fn_get_lang_var('name', $this->getLanguage()); ?>
</a></th>
	<th width="15%"><a class="cm-ajax<?php if ($this->_tpl_vars['search']['sort_by'] == 'price'): ?> sort-link-<?php echo $this->_tpl_vars['search']['sort_order']; ?>
<?php endif; ?>" href="<?php echo fn_url(($this->_tpl_vars['c_url'])."&amp;sort_by=price&amp;sort_order=".($this->_tpl_vars['search']['sort_order'])); ?>
" rev=<?php echo $this->_tpl_vars['rev']; ?>
><?php echo fn_get_lang_var('price', $this->getLanguage()); ?>
 (<?php echo $this->_tpl_vars['currencies'][$this->_tpl_vars['primary_currency']]['symbol']; ?>
)</a></th>
	<th width="5%"></th>
	<?php if ($this->_tpl_vars['search']['order_ids']): ?>
	<th width="5%"><a class="cm-ajax<?php if ($this->_tpl_vars['search']['sort_by'] == 'p_qty'): ?> sort-link-<?php echo $this->_tpl_vars['search']['sort_order']; ?>
<?php endif; ?>" href="<?php echo fn_url(($this->_tpl_vars['c_url'])."&amp;sort_by=p_qty&amp;sort_order=".($this->_tpl_vars['search']['sort_order'])); ?>
" rev=<?php echo $this->_tpl_vars['rev']; ?>
><?php echo fn_get_lang_var('purchased_qty', $this->getLanguage()); ?>
</a></th>
	<th width="5%"><a class="cm-ajax<?php if ($this->_tpl_vars['search']['sort_by'] == 'p_subtotal'): ?> sort-link-<?php echo $this->_tpl_vars['search']['sort_order']; ?>
<?php endif; ?>" href="<?php echo fn_url(($this->_tpl_vars['c_url'])."&amp;sort_by=p_subtotal&amp;sort_order=".($this->_tpl_vars['search']['sort_order'])); ?>
" rev=<?php echo $this->_tpl_vars['rev']; ?>
><?php echo fn_get_lang_var('subtotal_sum', $this->getLanguage()); ?>
 (<?php echo $this->_tpl_vars['currencies'][$this->_tpl_vars['primary_currency']]['symbol']; ?>
)</a></th>
	<?php endif; ?>
	<th width="5%"><a class="cm-ajax<?php if ($this->_tpl_vars['search']['sort_by'] == 'amount'): ?> sort-link-<?php echo $this->_tpl_vars['search']['sort_order']; ?>
<?php endif; ?>" href="<?php echo fn_url(($this->_tpl_vars['c_url'])."&amp;sort_by=amount&amp;sort_order=".($this->_tpl_vars['search']['sort_order'])); ?>
" rev=<?php echo $this->_tpl_vars['rev']; ?>
><?php echo fn_get_lang_var('quantity', $this->getLanguage()); ?>
</a></th>
</tr>
<?php $_from = $this->_tpl_vars['products']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['product']):
?>

<tr class="<?php echo smarty_function_cycle(array('values' => "table-row,"), $this);?>
 <?php echo $this->_tpl_vars['hide_inputs_if_shared_product']; ?>
">
	<td class="center">
   		<input type="radio" name="product_ids[]" value="<?php echo $this->_tpl_vars['product']['product_id']; ?>
" class="checkbox cm-item" /></td>
	<?php if ($this->_tpl_vars['search']['cid'] && $this->_tpl_vars['search']['subcats'] != 'Y'): ?>
	<td>
		<input type="text" name="products_data[<?php echo $this->_tpl_vars['product']['product_id']; ?>
][position]" size="3" value="<?php echo $this->_tpl_vars['product']['position']; ?>
" class="input-text-short" /></td>
	<?php endif; ?>
	<td class="product-image-table">
	<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('image' => smarty_modifier_default(@$this->_tpl_vars['product']['main_pair']['icon'], @$this->_tpl_vars['product']['main_pair']['detailed']), 'image_id' => $this->_tpl_vars['product']['main_pair']['image_id'], 'image_width' => 50, 'object_type' => $this->_tpl_vars['object_type'], 'href' => fn_url("products.update?product_id=".($this->_tpl_vars['product']['product_id'])), )); ?><?php echo ''; ?><?php if (! $this->_tpl_vars['image_width']): ?><?php echo ''; ?><?php if ($this->_tpl_vars['image']['image_x']): ?><?php echo ''; ?><?php $this->assign('image_width', $this->_tpl_vars['image']['image_x'], false); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php if ($this->_tpl_vars['image']['image_y']): ?><?php echo ''; ?><?php $this->assign('image_height', $this->_tpl_vars['image']['image_y'], false); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php if ($this->_tpl_vars['image']['image_x'] && $this->_tpl_vars['image']['image_y']): ?><?php echo ''; ?><?php echo smarty_function_math(array('equation' => "new_x * y / x",'new_x' => $this->_tpl_vars['image_width'],'x' => $this->_tpl_vars['image']['image_x'],'y' => $this->_tpl_vars['image']['image_y'],'format' => "%d",'assign' => 'image_height'), $this);?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php if (! $this->_tpl_vars['image']['is_flash']): ?><?php echo ''; ?><?php if ($this->_tpl_vars['image']['image_x'] || $this->_tpl_vars['href']): ?><?php echo '<a href="'; ?><?php echo smarty_modifier_default(smarty_modifier_default(@$this->_tpl_vars['href'], @$this->_tpl_vars['image']['image_path']), @$this->_tpl_vars['config']['no_image_path']); ?><?php echo '" '; ?><?php if (! $this->_tpl_vars['href']): ?><?php echo 'target="_blank"'; ?><?php endif; ?><?php echo '>'; ?><?php endif; ?><?php echo '<img '; ?><?php if ($this->_tpl_vars['image_id']): ?><?php echo 'id="image_'; ?><?php echo $this->_tpl_vars['object_type']; ?><?php echo '_'; ?><?php echo $this->_tpl_vars['image_id']; ?><?php echo '"'; ?><?php endif; ?><?php echo ' src="'; ?><?php echo smarty_modifier_escape(fn_generate_thumbnail(smarty_modifier_unescape(smarty_modifier_default(@$this->_tpl_vars['image']['image_path'], @$this->_tpl_vars['config']['no_image_path'])), $this->_tpl_vars['image_width'], $this->_tpl_vars['image_height'])); ?><?php echo '" '; ?><?php if ($this->_tpl_vars['image_width']): ?><?php echo 'width="'; ?><?php echo $this->_tpl_vars['image_width']; ?><?php echo '"'; ?><?php endif; ?><?php echo ' '; ?><?php if ($this->_tpl_vars['image_height']): ?><?php echo 'height="'; ?><?php echo $this->_tpl_vars['image_height']; ?><?php echo '"'; ?><?php endif; ?><?php echo ' alt="'; ?><?php echo $this->_tpl_vars['image']['alt']; ?><?php echo '" title="'; ?><?php echo $this->_tpl_vars['image']['alt']; ?><?php echo '" border="0" />'; ?><?php if ($this->_tpl_vars['image']['image_x'] || $this->_tpl_vars['href']): ?><?php echo '</a>'; ?><?php endif; ?><?php echo ''; ?><?php else: ?><?php echo '<object '; ?><?php if ($this->_tpl_vars['image_id']): ?><?php echo 'id="image_'; ?><?php echo $this->_tpl_vars['object_type']; ?><?php echo '_'; ?><?php echo $this->_tpl_vars['image_id']; ?><?php echo '"'; ?><?php endif; ?><?php echo ' classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,0,0" '; ?><?php if ($this->_tpl_vars['image_width']): ?><?php echo 'width="'; ?><?php echo $this->_tpl_vars['image_width']; ?><?php echo '"'; ?><?php endif; ?><?php echo ' '; ?><?php if ($this->_tpl_vars['image_height']): ?><?php echo 'height="'; ?><?php echo $this->_tpl_vars['image_height']; ?><?php echo '"'; ?><?php endif; ?><?php echo '><param name="movie" value="'; ?><?php echo smarty_modifier_default(@$this->_tpl_vars['image']['image_path'], @$this->_tpl_vars['config']['no_image_path']); ?><?php echo '" /><param name="quality" value="high" /><param name="wmode" value="transparent" /><param name="allowScriptAccess" value="sameDomain" /><embed src="'; ?><?php echo smarty_modifier_default(@$this->_tpl_vars['image']['image_path'], @$this->_tpl_vars['config']['no_image_path']); ?><?php echo '" quality="high" wmode="transparent" '; ?><?php if ($this->_tpl_vars['image_width']): ?><?php echo 'width="'; ?><?php echo $this->_tpl_vars['image_width']; ?><?php echo '"'; ?><?php endif; ?><?php echo ' '; ?><?php if ($this->_tpl_vars['image_height']): ?><?php echo 'height="'; ?><?php echo $this->_tpl_vars['image_height']; ?><?php echo '"'; ?><?php endif; ?><?php echo ' allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" /></object>'; ?><?php endif; ?><?php echo ''; ?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
		</td>
	<td>
		<div class="float-left">
				<input type="hidden" name="products_data[<?php echo $this->_tpl_vars['product']['product_id']; ?>
][product]" value="<?php echo $this->_tpl_vars['product']['product']; ?>
" <?php if ($this->_tpl_vars['no_hide_input_if_shared_product']): ?> class="<?php echo $this->_tpl_vars['no_hide_input_if_shared_product']; ?>
"<?php endif; ?> />
				<a href="<?php echo fn_url("products.update?product_id=".($this->_tpl_vars['product']['product_id'])); ?>
" class="strong<?php if ($this->_tpl_vars['product']['status'] == 'N'): ?> manage-root-item-disabled<?php endif; ?>"><?php echo smarty_modifier_unescape($this->_tpl_vars['product']['product']); ?>
 
					</div>
		<div class="float-right">
		</div>
	</td>
	<td<?php if ($this->_tpl_vars['no_hide_input_if_shared_product']): ?> class="<?php echo $this->_tpl_vars['no_hide_input_if_shared_product']; ?>
"<?php endif; ?>>
		<div class="product-price">
			<input type="text" name="products_data[<?php echo $this->_tpl_vars['product']['product_id']; ?>
][price]" size="6" value="<?php echo fn_format_price($this->_tpl_vars['product']['price'], $this->_tpl_vars['primary_currency'], null, false); ?>
" class="input-text" />
			<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('display' => $this->_tpl_vars['show_update_for_all'], 'object_id' => 'price', 'name' => "update_all_vendors[price]", )); ?><?php if ($this->_tpl_vars['display']): ?>
	<?php if ($this->_tpl_vars['hide_element']): ?>
		<?php $this->assign('title_act', fn_get_lang_var('update_for_all_hid_act', $this->getLanguage()), false); ?>
		<?php $this->assign('title_dis', fn_get_lang_var('update_for_all_hid_dis', $this->getLanguage()), false); ?>
	<?php else: ?>
		<?php $this->assign('title_act', fn_get_lang_var('update_for_all_act', $this->getLanguage()), false); ?>
		<?php $this->assign('title_dis', fn_get_lang_var('update_for_all_dis', $this->getLanguage()), false); ?>
	<?php endif; ?>
	<?php if ($this->_tpl_vars['settings']['Stores']['default_state_update_for_all'] == 'active'): ?>
		<?php $this->assign('title', $this->_tpl_vars['title_act'], false); ?>
		<?php $this->assign('visible', 'visible', false); ?>
	<?php else: ?>
		<?php $this->assign('title', $this->_tpl_vars['title_dis'], false); ?>
	<?php endif; ?>
	<a class="cm-update-for-all-icon <?php echo $this->_tpl_vars['visible']; ?>
" title="<?php echo $this->_tpl_vars['title']; ?>
" title_act="<?php echo $this->_tpl_vars['title_act']; ?>
" title_dis="<?php echo $this->_tpl_vars['title_dis']; ?>
" rev="<?php echo $this->_tpl_vars['object_id']; ?>
" <?php if ($this->_tpl_vars['hide_element']): ?>hide_element="<?php echo $this->_tpl_vars['hide_element']; ?>
"<?php endif; ?>></a>
	<input type="hidden" class="cm-no-hide-input" id="hidden_update_all_vendors_<?php echo $this->_tpl_vars['object_id']; ?>
" name="<?php echo $this->_tpl_vars['name']; ?>
" value="Y" <?php if ($this->_tpl_vars['settings']['Stores']['default_state_update_for_all'] == 'not_active'): ?>disabled="disabled"<?php endif; ?> />
<?php else: ?>
&nbsp;
<?php endif; ?> 
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
		</div>
	</td>
	<td>
		</td>
	<?php if ($this->_tpl_vars['search']['order_ids']): ?>
	<td><?php echo $this->_tpl_vars['product']['purchased_qty']; ?>
</td>
	<td><?php echo $this->_tpl_vars['product']['purchased_subtotal']; ?>
</td>
	<?php endif; ?>
	<td>
				<input type="text" name="products_data[<?php echo $this->_tpl_vars['product']['product_id']; ?>
][amount]" size="6" value="<?php echo $this->_tpl_vars['product']['amount']; ?>
" class="input-text-short" />
			</td>

</tr>
<?php endforeach; else: ?>
<tr class="no-items">
	<td colspan="<?php if ($this->_tpl_vars['search']['cid'] && $this->_tpl_vars['search']['subcats'] != 'Y'): ?>12<?php else: ?>11<?php endif; ?>"><p><?php echo fn_get_lang_var('no_data', $this->getLanguage()); ?>
</p></td>
</tr>
<?php endif; unset($_from); ?>
</table>

<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/pagination.tpl", 'smarty_include_vars' => array('div_id' => $this->_tpl_vars['_REQUEST']['content_id'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php if ($this->_tpl_vars['products']): ?>
	<div class="buttons-container buttons-bg">
		<div class="float-left">
			<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/save_cancel.tpl", 'smarty_include_vars' => array('but_text' => fn_get_lang_var('btn_place_bid_txt', $this->getLanguage()),'but_name' => "dispatch[billibuys.m_place_bid]",'hide_second_button' => true,'cancel_action' => 'close')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</div>
	</div>
<?php endif; ?>

<div class="buttons-container">

</div>

<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/popupbox.tpl", 'smarty_include_vars' => array('id' => 'select_fields_to_edit','text' => fn_get_lang_var('select_fields_to_edit', $this->getLanguage()),'content' => $this->_smarty_vars['capture']['select_fields_to_edit'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php ob_start(); ?>
	<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('tool_href' => $this->_tpl_vars['create_product_href'], 'prefix' => 'top', 'link_text' => fn_get_lang_var('create_product_package', $this->getLanguage()), 'hide_tools' => true, )); ?><?php if ($this->_tpl_vars['skip_check_permissions'] || fn_check_view_permissions($this->_tpl_vars['tools_list'])): ?>

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
<?php $this->_smarty_vars['capture']['tools'] = ob_get_contents(); ob_end_clean(); ?>

</form>
<!--content_manage_products--></div>



<?php $this->_smarty_vars['capture']['mainbox'] = ob_get_contents(); ob_end_clean(); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/mainbox.tpl", 'smarty_include_vars' => array('title' => fn_get_lang_var('products', $this->getLanguage()),'content' => $this->_smarty_vars['capture']['mainbox'],'title_extra' => $this->_smarty_vars['capture']['title_extra'],'tools' => $this->_smarty_vars['capture']['tools'],'select_languages' => true)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>