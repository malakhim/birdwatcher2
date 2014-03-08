<?php /* Smarty version 2.6.18, created on 2014-03-08 23:32:53
         compiled from views/shippings/update.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'defined', 'views/shippings/update.tpl', 16, false),array('modifier', 'fn_url', 'views/shippings/update.tpl', 70, false),array('modifier', 'in_array', 'views/shippings/update.tpl', 138, false),array('modifier', 'escape', 'views/shippings/update.tpl', 150, false),array('modifier', 'explode', 'views/shippings/update.tpl', 154, false),array('modifier', 'fn_get_default_usergroups', 'views/shippings/update.tpl', 159, false),array('modifier', 'count', 'views/shippings/update.tpl', 161, false),array('modifier', 'define', 'views/shippings/update.tpl', 175, false),array('modifier', 'fn_explode_localizations', 'views/shippings/update.tpl', 200, false),array('modifier', 'default', 'views/shippings/update.tpl', 208, false),array('modifier', 'is_array', 'views/shippings/update.tpl', 246, false),array('modifier', 'fn_from_json', 'views/shippings/update.tpl', 247, false),array('modifier', 'lower', 'views/shippings/update.tpl', 250, false),array('modifier', 'empty_tabs', 'views/shippings/update.tpl', 296, false),array('block', 'hook', 'views/shippings/update.tpl', 146, false),array('function', 'script', 'views/shippings/update.tpl', 290, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('name','vendor','icon','delivery_time','weight_limit','rate_calculation','rate_calculation_manual','rate_calculation_realtime','shipping_service','test','weight','test','taxes','usergroups','ttc_usergroups','localization','multiple_selectbox_notice','active','hidden','disabled','status','active','hidden','disabled','status','active','hidden','pending','disabled','new_shipping_method','editing_shipping_method'));
?>
<?php 

				$rname = !empty($resource_name) ? $resource_name : $params['smarty_include_tpl_file'];
				if ($this->compile_check && empty($inline_no_check[$rname]) && $this->is_cached($rname)) {
					if ($this->check_inline_blocks(array (
  'common_templates/tabsbox.tpl' => 1367063753,
))) {
						$_smarty_compile_path = $this->_get_compile_path($rname);
						$this->_compile_resource($rname, $_smarty_compile_path);
						$inline_no_check[$rname] = true;
						include $_smarty_compile_path;
						return;
					}
				}
			 ?>
<?php if (defined('COMPANY_ID') && $this->_tpl_vars['shipping']['shipping_id'] && $this->_tpl_vars['shipping']['company_id'] != @COMPANY_ID): ?>
	<?php $this->assign('hide_fields', true, false); ?>
<?php endif; ?>

<script type="text/javascript">
//<![CDATA[

var shipping_id = '<?php echo $this->_tpl_vars['_REQUEST']['shipping_id']; ?>
';
var selected_section = '<?php echo $this->_tpl_vars['_REQUEST']['selected_section']; ?>
';
var shipping_services = [];

<?php $_from = $this->_tpl_vars['services']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['s']):
?>
shipping_services[<?php echo $this->_tpl_vars['s']['service_id']; ?>
] = [];
shipping_services[<?php echo $this->_tpl_vars['s']['service_id']; ?>
]['module'] = '<?php echo $this->_tpl_vars['s']['module']; ?>
';
shipping_services[<?php echo $this->_tpl_vars['s']['service_id']; ?>
]['code'] = '<?php echo $this->_tpl_vars['s']['code']; ?>
';
<?php endforeach; endif; unset($_from); ?>
<?php echo '

// FIXME: For what we need this code?
/*$(function () {
	$(\'#content_configure\').remove();
});*/
	
function fn_toggle_shipping_type(type)
{
	if (type == \'M\') {
		$(\'#service\').attr(\'disabled\', \'disabled\');
		fn_toggle_configure_tab(\'\');
	} else {
		$(\'#service\').removeAttr(\'disabled\');
		fn_toggle_configure_tab($(\'#service\').val());
	}
}

function fn_toggle_configure_tab(service_id)
{
	if (service_id) {
		var new_href = fn_url(\'shippings.configure?shipping_id=\' + shipping_id + \'&module=\' + shipping_services[service_id][\'module\'] + \'&code=\' + shipping_services[service_id][\'code\']);
		if ($(\'#configure a\').attr(\'href\') != new_href) {
			$(\'#content_configure\').remove();
			$(\'#configure a\').attr(\'href\', new_href);
		}
		$(\'#configure\').show();
	} else {
		$(\'#configure\').hide();
	}
}
'; ?>

//]]>
</script>


<?php ob_start(); ?>

<form action="<?php echo fn_url(""); ?>
" method="post" id="shippings_form" name="shippings_form" enctype="multipart/form-data" class="cm-form-highlight<?php if ($this->_tpl_vars['hide_fields']): ?> cm-hide-inputs<?php endif; ?>">
<input type="hidden" name="shipping_id" value="<?php echo $this->_tpl_vars['_REQUEST']['shipping_id']; ?>
" />

<?php if ($this->_tpl_vars['mode'] == 'update'): ?>
<?php ob_start(); ?>
<div id="content_general">
<?php endif; ?>

<fieldset>
<div class="form-field">
	<label for="ship_descr_shipping" class="cm-required"><?php echo fn_get_lang_var('name', $this->getLanguage()); ?>
:</label>
	<input type="text" name="shipping_data[shipping]" id="ship_descr_shipping" size="30" value="<?php echo $this->_tpl_vars['shipping']['shipping']; ?>
" class="input-text-large main-input" />
</div>

<?php if (! $this->_tpl_vars['hide_fields']): ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/companies/components/company_field.tpl", 'smarty_include_vars' => array('title' => fn_get_lang_var('vendor', $this->getLanguage()),'name' => "shipping_data[company_id]",'id' => "shipping_data_".($this->_tpl_vars['_REQUEST']['shipping_id']),'selected' => $this->_tpl_vars['shipping']['company_id'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php endif; ?>

<div class="form-field">
	<label><?php echo fn_get_lang_var('icon', $this->getLanguage()); ?>
:</label>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/attach_images.tpl", 'smarty_include_vars' => array('image_name' => 'shipping','image_object_type' => 'shipping','image_pair' => $this->_tpl_vars['shipping']['icon'],'no_detailed' => 'Y','hide_titles' => 'Y','image_object_id' => $this->_tpl_vars['_REQUEST']['shipping_id'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>

<div class="form-field">
	<label for="delivery_time"><?php echo fn_get_lang_var('delivery_time', $this->getLanguage()); ?>
:</label>
	<input type="text" name="shipping_data[delivery_time]" id="delivery_time" size="30" value="<?php echo $this->_tpl_vars['shipping']['delivery_time']; ?>
" class="input-text" />
</div>

<div class="form-field">
	<label for="min_weight"><?php echo fn_get_lang_var('weight_limit', $this->getLanguage()); ?>
&nbsp;(<?php echo $this->_tpl_vars['settings']['General']['weight_symbol']; ?>
):</label>
	<input type="text" name="shipping_data[min_weight]" id="min_weight" size="4" value="<?php echo $this->_tpl_vars['shipping']['min_weight']; ?>
" class="input-text" />&nbsp;-&nbsp;<input type="text" name="shipping_data[max_weight]" size="4" value="<?php if ($this->_tpl_vars['shipping']['max_weight'] != "0.00"): ?><?php echo $this->_tpl_vars['shipping']['max_weight']; ?>
<?php endif; ?>" class="input-text" />
</div>

<div class="form-field">
	<label><?php echo fn_get_lang_var('rate_calculation', $this->getLanguage()); ?>
:</label>
	<div class="float-left">
		<div class="select-field">
			<input type="radio" name="shipping_data[rate_calculation]" id="rate_calculation_M" value="M" <?php if ($this->_tpl_vars['shipping']['rate_calculation'] == 'M' || ! $this->_tpl_vars['shipping']['rate_calculation']): ?>checked="checked"<?php endif; ?> onclick="fn_toggle_shipping_type(this.value);" class="radio" />
			<label for="rate_calculation_M"><?php echo fn_get_lang_var('rate_calculation_manual', $this->getLanguage()); ?>
</label>
		</div>
		<div class="select-field">
			<input type="radio" name="shipping_data[rate_calculation]" id="rate_calculation_R" value="R" <?php if ($this->_tpl_vars['shipping']['rate_calculation'] == 'R'): ?>checked="checked"<?php endif; ?> onclick="fn_toggle_shipping_type(this.value);" class="radio" />
			<label for="rate_calculation_R"><?php echo fn_get_lang_var('rate_calculation_realtime', $this->getLanguage()); ?>
</label>
		</div>
	</div>
</div>

<div class="form-field">
	<label for="service"><?php echo fn_get_lang_var('shipping_service', $this->getLanguage()); ?>
:</label>
	<div class="float-left">
		<select name="shipping_data[service_id]" id="service" onchange="fn_toggle_configure_tab(this.value);" <?php if ($this->_tpl_vars['shipping']['rate_calculation'] == 'M' || $this->_tpl_vars['mode'] == 'add'): ?>disabled="disabled"<?php endif; ?>>
			<option	value="">--</option>
			<?php $_from = $this->_tpl_vars['services']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['service']):
?>
				<option	value="<?php echo $this->_tpl_vars['service']['service_id']; ?>
" <?php if ($this->_tpl_vars['shipping']['service_id'] == $this->_tpl_vars['service']['service_id']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['service']['description']; ?>
</option>
			<?php endforeach; endif; unset($_from); ?>
		</select>
		<?php if (! $this->_tpl_vars['hide_fields']): ?>
			&nbsp;&nbsp;<span><?php echo fn_get_lang_var('test', $this->getLanguage()); ?>
</span>: &nbsp;<?php echo fn_get_lang_var('weight', $this->getLanguage()); ?>
 (<?php echo $this->_tpl_vars['settings']['General']['weight_symbol']; ?>
)&nbsp;
			<input id="weight" type="text" class="input-text" size="3" name="weight" value="0" />
			<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/button_popup.tpl", 'smarty_include_vars' => array('but_text' => fn_get_lang_var('test', $this->getLanguage()),'but_href' => "shippings.test?service_id=",'href_extra' => "document.getElementById('service').value + '&weight=' + document.getElementById('weight').value + '&shipping_id=".($this->_tpl_vars['_REQUEST']['shipping_id'])."' + '&' + $('#shippings_form').serialize()",'width' => '500','height' => '230','scrollbars' => 'no','toolbar' => 'no','menubar' => 'no','but_role' => 'text')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<?php endif; ?>
	</div>
</div>

<div class="form-field">
	<label for="products_tax_id"><?php echo fn_get_lang_var('taxes', $this->getLanguage()); ?>
:</label>
	<div class="select-field">
		<?php $_from = $this->_tpl_vars['taxes']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['tax']):
?>
			<input type="checkbox"	name="shipping_data[tax_ids][<?php echo $this->_tpl_vars['tax']['tax_id']; ?>
]" id="shippings_taxes_<?php echo $this->_tpl_vars['tax']['tax_id']; ?>
" <?php if (smarty_modifier_in_array($this->_tpl_vars['tax']['tax_id'], $this->_tpl_vars['shipping']['tax_ids'])): ?>checked="checked"<?php endif; ?> class="checkbox" value="<?php echo $this->_tpl_vars['tax']['tax_id']; ?>
" />
			<label for="shippings_taxes_<?php echo $this->_tpl_vars['tax']['tax_id']; ?>
"><?php echo $this->_tpl_vars['tax']['tax']; ?>
</label>
		<?php endforeach; else: ?>
			&ndash;
		<?php endif; unset($_from); ?>
	</div>
</div>

<?php $this->_tag_stack[] = array('hook', array('name' => "shippings:update")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

<div class="form-field">
	<label><?php echo fn_get_lang_var('usergroups', $this->getLanguage()); ?>
<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('tooltip' => fn_get_lang_var('ttc_usergroups', $this->getLanguage()), )); ?><?php if ($this->_tpl_vars['tooltip']): ?> (<a class="cm-tooltip<?php if ($this->_tpl_vars['params']): ?> <?php echo $this->_tpl_vars['params']; ?>
<?php endif; ?>" title="<?php echo smarty_modifier_escape($this->_tpl_vars['tooltip'], 'html'); ?>
">?</a>)<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>:</label>
	<div class="select-field">
		<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('id' => 'ship_data_usergroup_id', 'name' => "shipping_data[usergroup_ids]", 'usergroups' => $this->_tpl_vars['usergroups'], 'usergroup_ids' => $this->_tpl_vars['shipping']['usergroup_ids'], 'input_extra' => "", 'list_mode' => false, )); ?>
<?php if ($this->_tpl_vars['usergroup_ids'] !== ""): ?>
<?php $this->assign('ug_ids', explode(",", $this->_tpl_vars['usergroup_ids']), false); ?>
<?php endif; ?>

<?php $this->_tag_stack[] = array('hook', array('name' => "usergroups:select_usergroups")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
<input type="hidden" name="<?php echo $this->_tpl_vars['name']; ?>
" value="0" <?php echo $this->_tpl_vars['input_extra']; ?>
/>
<?php $_from = fn_get_default_usergroups(""); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['usergroup']):
?>
	<?php if ($this->_tpl_vars['list_mode']): ?><p><?php endif; ?>
	<input type="checkbox" name="<?php echo $this->_tpl_vars['name']; ?>
[]" id="<?php echo $this->_tpl_vars['id']; ?>
_<?php echo $this->_tpl_vars['usergroup']['usergroup_id']; ?>
"<?php if (( $this->_tpl_vars['ug_ids'] && smarty_modifier_in_array($this->_tpl_vars['usergroup']['usergroup_id'], $this->_tpl_vars['ug_ids']) ) || ( ! $this->_tpl_vars['ug_ids'] && $this->_tpl_vars['usergroup']['usergroup_id'] == @USERGROUP_ALL )): ?> checked="checked"<?php endif; ?> class="checkbox" value="<?php echo $this->_tpl_vars['usergroup']['usergroup_id']; ?>
" <?php echo $this->_tpl_vars['input_extra']; ?>
<?php if (( ! $this->_tpl_vars['ug_ids'] || ( $this->_tpl_vars['ug_ids'] && count($this->_tpl_vars['ug_ids']) == 1 && smarty_modifier_in_array($this->_tpl_vars['usergroup']['usergroup_id'], $this->_tpl_vars['ug_ids']) ) ) && $this->_tpl_vars['usergroup']['usergroup_id'] == @USERGROUP_ALL): ?> disabled="disabled"<?php endif; ?> onclick="fn_switch_default_box(this, '<?php echo $this->_tpl_vars['id']; ?>
', <?php echo @USERGROUP_ALL; ?>
);" />
	<label for="<?php echo $this->_tpl_vars['id']; ?>
_<?php echo $this->_tpl_vars['usergroup']['usergroup_id']; ?>
"><?php echo smarty_modifier_escape($this->_tpl_vars['usergroup']['usergroup']); ?>
</label>
	<?php if ($this->_tpl_vars['list_mode']): ?></p><?php endif; ?>
<?php endforeach; endif; unset($_from); ?>

<?php $_from = $this->_tpl_vars['usergroups']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['usergroup']):
?>
	<?php if ($this->_tpl_vars['list_mode']): ?><p><?php endif; ?>
	<input type="checkbox" name="<?php echo $this->_tpl_vars['name']; ?>
[]" id="<?php echo $this->_tpl_vars['id']; ?>
_<?php echo $this->_tpl_vars['usergroup']['usergroup_id']; ?>
"<?php if ($this->_tpl_vars['ug_ids'] && smarty_modifier_in_array($this->_tpl_vars['usergroup']['usergroup_id'], $this->_tpl_vars['ug_ids'])): ?> checked="checked"<?php endif; ?> class="checkbox" value="<?php echo $this->_tpl_vars['usergroup']['usergroup_id']; ?>
" <?php echo $this->_tpl_vars['input_extra']; ?>
 onclick="fn_switch_default_box(this, '<?php echo $this->_tpl_vars['id']; ?>
', <?php echo @USERGROUP_ALL; ?>
);" />
	<label for="<?php echo $this->_tpl_vars['id']; ?>
_<?php echo $this->_tpl_vars['usergroup']['usergroup_id']; ?>
"><?php echo smarty_modifier_escape($this->_tpl_vars['usergroup']['usergroup']); ?>
</label>
	<?php if ($this->_tpl_vars['list_mode']): ?></p><?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

<?php if (! defined('SMARTY_USERGROUPS_LOADED')): ?>
<?php $this->assign('tmp', define('SMARTY_USERGROUPS_LOADED', true), false); ?>
<script type="text/javascript">
	//<![CDATA[
	<?php echo '
	function fn_switch_default_box(holder, prefix, default_id)
	{
		var p = $(holder).parents(\':not(p):first\');
		var default_box = $(\'input[id^=\' + prefix + \'_\' + default_id + \']\', p);
		var checked_items = $(\'input[id^=\' + prefix + \'_].checkbox:checked\', p).not(default_box).length + holder.checked ? 1 : 0;
		if (checked_items == 0) {
			default_box.attr(\'disabled\', \'disabled\');
			default_box.attr(\'checked\', \'checked\');
		} else {
			default_box.removeAttr(\'disabled\');
		}
	}
	'; ?>

	//]]>
</script>
<?php endif; ?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
	</div>
</div>

<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('data_name' => "shipping_data[localization]", 'data_from' => $this->_tpl_vars['shipping']['localization'], )); ?>
<?php $this->assign('data', fn_explode_localizations($this->_tpl_vars['data_from']), false); ?>

<?php if ($this->_tpl_vars['localizations']): ?>
<?php if (! $this->_tpl_vars['no_div']): ?>
<div class="form-field">
	<label for="<?php echo $this->_tpl_vars['id']; ?>
"><?php echo fn_get_lang_var('localization', $this->getLanguage()); ?>
:</label>
<?php endif; ?>
		<?php if (! $this->_tpl_vars['disabled']): ?><input type="hidden" name="<?php echo $this->_tpl_vars['data_name']; ?>
" value="" /><?php endif; ?>
		<select	name="<?php echo $this->_tpl_vars['data_name']; ?>
[]" multiple="multiple" size="3" id="<?php echo smarty_modifier_default(@$this->_tpl_vars['id'], @$this->_tpl_vars['data_name']); ?>
" class="<?php if ($this->_tpl_vars['disabled']): ?>elm-disabled<?php else: ?>input-text<?php endif; ?>" <?php if ($this->_tpl_vars['disabled']): ?>disabled="disabled"<?php endif; ?>>
			<?php $_from = $this->_tpl_vars['localizations']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['loc']):
?>
			<option	value="<?php echo $this->_tpl_vars['loc']['localization_id']; ?>
" <?php $_from = $this->_tpl_vars['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['p_loc']):
?><?php if ($this->_tpl_vars['p_loc'] == $this->_tpl_vars['loc']['localization_id']): ?>selected="selected"<?php endif; ?><?php endforeach; endif; unset($_from); ?>><?php echo smarty_modifier_escape($this->_tpl_vars['loc']['localization']); ?>
</option>
			<?php endforeach; endif; unset($_from); ?>
		</select>
<?php if (! $this->_tpl_vars['no_div']): ?>
<?php echo fn_get_lang_var('multiple_selectbox_notice', $this->getLanguage()); ?>

</div>
<?php endif; ?>
<?php endif; ?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>

<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('input_name' => "shipping_data[status]", 'id' => 'shipping_data', 'obj' => $this->_tpl_vars['shipping'], )); ?><?php if ($this->_tpl_vars['display'] == 'select'): ?>
<select name="<?php echo $this->_tpl_vars['input_name']; ?>
" <?php if ($this->_tpl_vars['input_id']): ?>id="<?php echo $this->_tpl_vars['input_id']; ?>
"<?php endif; ?>>
	<option value="A" <?php if ($this->_tpl_vars['obj']['status'] == 'A'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('active', $this->getLanguage()); ?>
</option>
	<?php if ($this->_tpl_vars['hidden']): ?>
	<option value="H" <?php if ($this->_tpl_vars['obj']['status'] == 'H'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('hidden', $this->getLanguage()); ?>
</option>
	<?php endif; ?>
	<option value="D" <?php if ($this->_tpl_vars['obj']['status'] == 'D'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('disabled', $this->getLanguage()); ?>
</option>
</select>
<?php elseif ($this->_tpl_vars['display'] == 'text'): ?>
<div class="form-field">
	<label class="cm-required"><?php echo fn_get_lang_var('status', $this->getLanguage()); ?>
:</label>
	<span>
		<?php if ($this->_tpl_vars['obj']['status'] == 'A'): ?>
			<?php echo fn_get_lang_var('active', $this->getLanguage()); ?>

		<?php elseif ($this->_tpl_vars['obj']['status'] == 'H'): ?>
			<?php echo fn_get_lang_var('hidden', $this->getLanguage()); ?>

		<?php elseif ($this->_tpl_vars['obj']['status'] == 'D'): ?>
			<?php echo fn_get_lang_var('disabled', $this->getLanguage()); ?>

		<?php endif; ?>
	</span>
</div>
<?php else: ?>
<div class="form-field">
	<label class="cm-required"><?php echo fn_get_lang_var('status', $this->getLanguage()); ?>
:</label>
	<div class="select-field">
		<?php if ($this->_tpl_vars['items_status']): ?>
			<?php if (! is_array($this->_tpl_vars['items_status'])): ?>
				<?php $this->assign('items_status', fn_from_json($this->_tpl_vars['items_status']), false); ?>
			<?php endif; ?>
			<?php $_from = $this->_tpl_vars['items_status']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['status_cycle'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['status_cycle']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['st'] => $this->_tpl_vars['val']):
        $this->_foreach['status_cycle']['iteration']++;
?>
			<input type="radio" name="<?php echo $this->_tpl_vars['input_name']; ?>
" id="<?php echo $this->_tpl_vars['id']; ?>
_<?php echo smarty_modifier_default(@$this->_tpl_vars['obj_id'], 0); ?>
_<?php echo smarty_modifier_lower($this->_tpl_vars['st']); ?>
" <?php if ($this->_tpl_vars['obj']['status'] == $this->_tpl_vars['st'] || ( ! $this->_tpl_vars['obj']['status'] && ($this->_foreach['status_cycle']['iteration'] <= 1) )): ?>checked="checked"<?php endif; ?> value="<?php echo $this->_tpl_vars['st']; ?>
" class="radio" /><label for="<?php echo $this->_tpl_vars['id']; ?>
_<?php echo smarty_modifier_default(@$this->_tpl_vars['obj_id'], 0); ?>
_<?php echo smarty_modifier_lower($this->_tpl_vars['st']); ?>
"><?php echo $this->_tpl_vars['val']; ?>
</label>
			<?php endforeach; endif; unset($_from); ?>
		<?php else: ?>
		<input type="radio" name="<?php echo $this->_tpl_vars['input_name']; ?>
" id="<?php echo $this->_tpl_vars['id']; ?>
_<?php echo smarty_modifier_default(@$this->_tpl_vars['obj_id'], 0); ?>
_a" <?php if ($this->_tpl_vars['obj']['status'] == 'A' || ! $this->_tpl_vars['obj']['status']): ?>checked="checked"<?php endif; ?> value="A" class="radio" /><label for="<?php echo $this->_tpl_vars['id']; ?>
_<?php echo smarty_modifier_default(@$this->_tpl_vars['obj_id'], 0); ?>
_a"><?php echo fn_get_lang_var('active', $this->getLanguage()); ?>
</label>

		<?php if ($this->_tpl_vars['hidden']): ?>
		<input type="radio" name="<?php echo $this->_tpl_vars['input_name']; ?>
" id="<?php echo $this->_tpl_vars['id']; ?>
_<?php echo smarty_modifier_default(@$this->_tpl_vars['obj_id'], 0); ?>
_h" <?php if ($this->_tpl_vars['obj']['status'] == 'H'): ?>checked="checked"<?php endif; ?> value="H" class="radio" /><label for="<?php echo $this->_tpl_vars['id']; ?>
_<?php echo smarty_modifier_default(@$this->_tpl_vars['obj_id'], 0); ?>
_h"><?php echo fn_get_lang_var('hidden', $this->getLanguage()); ?>
</label>
		<?php endif; ?>

		<?php if ($this->_tpl_vars['obj']['status'] == 'P'): ?>
		<input type="radio" name="<?php echo $this->_tpl_vars['input_name']; ?>
" id="<?php echo $this->_tpl_vars['id']; ?>
_<?php echo smarty_modifier_default(@$this->_tpl_vars['obj_id'], 0); ?>
_p" checked="checked" value="P" class="radio" /><label for="<?php echo $this->_tpl_vars['id']; ?>
_<?php echo smarty_modifier_default(@$this->_tpl_vars['obj_id'], 0); ?>
_p"><?php echo fn_get_lang_var('pending', $this->getLanguage()); ?>
</label>
		<?php endif; ?>

		<input type="radio" name="<?php echo $this->_tpl_vars['input_name']; ?>
" id="<?php echo $this->_tpl_vars['id']; ?>
_<?php echo smarty_modifier_default(@$this->_tpl_vars['obj_id'], 0); ?>
_d" <?php if ($this->_tpl_vars['obj']['status'] == 'D'): ?>checked="checked"<?php endif; ?> value="D" class="radio" /><label for="<?php echo $this->_tpl_vars['id']; ?>
_<?php echo smarty_modifier_default(@$this->_tpl_vars['obj_id'], 0); ?>
_d"><?php echo fn_get_lang_var('disabled', $this->getLanguage()); ?>
</label>
		<?php endif; ?>
	</div>
</div>
<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
</fieldset>

<div class="buttons-container buttons-bg">
	<?php if (! $this->_tpl_vars['hide_for_vendor']): ?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/save_cancel.tpl", 'smarty_include_vars' => array('but_name' => "dispatch[shippings.update_shipping]")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php else: ?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/save_cancel.tpl", 'smarty_include_vars' => array('but_name' => "dispatch[shippings.update_shipping]",'but_role' => 'button_main','hide_first_button' => true,'hide_second_button' => true)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php endif; ?>
</div>

<?php if ($this->_tpl_vars['mode'] == 'update'): ?>
	<input type="hidden" name="selected_section" value="general" />
	<!--content_general--></div>

	<div id="content_configure">
	<!--content_configure--></div>

	<div id="content_shipping_charges">
	<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/shippings/components/rates.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<!--content_shipping_charges--></div>

	<?php $this->_smarty_vars['capture']['tabsbox'] = ob_get_contents(); ob_end_clean(); ?>
	<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('content' => $this->_smarty_vars['capture']['tabsbox'], 'active_tab' => $this->_tpl_vars['_REQUEST']['selected_section'], 'track' => true, )); ?><?php echo smarty_function_script(array('src' => "js/tabs.js"), $this);?>


<?php if (! $this->_tpl_vars['active_tab']): ?>
	<?php $this->assign('active_tab', $this->_tpl_vars['_REQUEST']['selected_section'], false); ?>
<?php endif; ?>

<?php $this->assign('empty_tab_ids', smarty_modifier_empty_tabs($this->_tpl_vars['content']), false); ?>

<?php if ($this->_tpl_vars['navigation']['tabs']): ?>
<div class="tabs cm-j-tabs<?php if ($this->_tpl_vars['track']): ?> cm-track<?php endif; ?>">
	<ul>
	<?php $_from = $this->_tpl_vars['navigation']['tabs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['tabs'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['tabs']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['tab']):
        $this->_foreach['tabs']['iteration']++;
?>
		<?php if (( ! $this->_tpl_vars['tabs_section'] || $this->_tpl_vars['tabs_section'] == $this->_tpl_vars['tab']['section'] ) && ( $this->_tpl_vars['tab']['hidden'] || ! smarty_modifier_in_array($this->_tpl_vars['key'], $this->_tpl_vars['empty_tab_ids']) )): ?>
		<li id="<?php echo $this->_tpl_vars['key']; ?>
<?php echo $this->_tpl_vars['id_suffix']; ?>
" class="<?php if ($this->_tpl_vars['tab']['hidden'] == 'Y'): ?>hidden <?php endif; ?><?php if ($this->_tpl_vars['tab']['js']): ?>cm-js<?php elseif ($this->_tpl_vars['tab']['ajax']): ?>cm-js cm-ajax<?php endif; ?><?php if ($this->_tpl_vars['key'] == $this->_tpl_vars['active_tab']): ?> cm-active<?php endif; ?>"><a <?php if ($this->_tpl_vars['tab']['href']): ?>href="<?php echo fn_url($this->_tpl_vars['tab']['href']); ?>
"<?php endif; ?>><?php echo $this->_tpl_vars['tab']['title']; ?>
</a><?php if ($this->_tpl_vars['key'] == $this->_tpl_vars['active_tab']): ?><?php echo $this->_tpl_vars['active_tab_extra']; ?>
<?php endif; ?></li>
		<?php endif; ?>
	<?php endforeach; endif; unset($_from); ?>
	</ul>
</div>
<div class="cm-tabs-content">
	<?php echo $this->_tpl_vars['content']; ?>

</div>
<?php else: ?>
	<?php echo $this->_tpl_vars['content']; ?>

<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
<?php endif; ?>

</form>

<?php $this->_smarty_vars['capture']['mainbox'] = ob_get_contents(); ob_end_clean(); ?>

<?php if ($this->_tpl_vars['mode'] == 'add'): ?>
	<?php $this->assign('title', fn_get_lang_var('new_shipping_method', $this->getLanguage()), false); ?>
<?php else: ?>
	<?php $this->assign('title', (fn_get_lang_var('editing_shipping_method', $this->getLanguage())).": ".($this->_tpl_vars['shipping']['shipping']), false); ?>
<?php endif; ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/mainbox.tpl", 'smarty_include_vars' => array('title' => $this->_tpl_vars['title'],'content' => $this->_smarty_vars['capture']['mainbox'],'select_languages' => true)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>