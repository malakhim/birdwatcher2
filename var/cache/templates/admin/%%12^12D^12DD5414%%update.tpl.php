<?php /* Smarty version 2.6.18, created on 2013-09-14 15:57:24
         compiled from views/payments/update.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'defined', 'views/payments/update.tpl', 15, false),array('modifier', 'fn_url', 'views/payments/update.tpl', 27, false),array('modifier', 'unescape', 'views/payments/update.tpl', 68, false),array('modifier', 'escape', 'views/payments/update.tpl', 73, false),array('modifier', 'explode', 'views/payments/update.tpl', 98, false),array('modifier', 'fn_get_default_usergroups', 'views/payments/update.tpl', 103, false),array('modifier', 'in_array', 'views/payments/update.tpl', 105, false),array('modifier', 'count', 'views/payments/update.tpl', 105, false),array('modifier', 'define', 'views/payments/update.tpl', 119, false),array('modifier', 'is_array', 'views/payments/update.tpl', 206, false),array('modifier', 'fn_from_json', 'views/payments/update.tpl', 207, false),array('modifier', 'default', 'views/payments/update.tpl', 210, false),array('modifier', 'lower', 'views/payments/update.tpl', 210, false),array('modifier', 'fn_explode_localizations', 'views/payments/update.tpl', 231, false),array('block', 'hook', 'views/payments/update.tpl', 101, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('general','configure','name','processor','offline','checkout','gateways','template','tt_views_payments_update_template','payment_category','payments_tab1','payments_tab2','payments_tab3','payment_category_note','usergroups','ttc_usergroups','description','surcharge','surcharge_title','tt_views_payments_update_surcharge_title','taxes','tt_views_payments_update_taxes','payment_instructions','active','hidden','disabled','status','active','hidden','disabled','status','active','hidden','pending','disabled','localization','multiple_selectbox_notice','icon'));
?>
<?php 

				$rname = !empty($resource_name) ? $resource_name : $params['smarty_include_tpl_file'];
				if ($this->compile_check && empty($inline_no_check[$rname]) && $this->is_cached($rname)) {
					if ($this->check_inline_blocks(array (
  'views/localizations/components/select.tpl' => 1367063755,
))) {
						$_smarty_compile_path = $this->_get_compile_path($rname);
						$this->_compile_resource($rname, $_smarty_compile_path);
						$inline_no_check[$rname] = true;
						include $_smarty_compile_path;
						return;
					}
				}
			 ?><?php if (defined('COMPANY_ID') && $this->_tpl_vars['payment']['payment_id'] && $this->_tpl_vars['payment']['company_id'] != @COMPANY_ID): ?>
	<?php $this->assign('hide_fields', true, false); ?>
<?php endif; ?>

<?php if ($this->_tpl_vars['mode'] == 'add'): ?>
	<?php $this->assign('id', '0', false); ?>
<?php else: ?>
	<?php $this->assign('id', $this->_tpl_vars['payment']['payment_id'], false); ?>
<?php endif; ?>

<div id="content_group<?php echo $this->_tpl_vars['id']; ?>
">

<form action="<?php echo fn_url(""); ?>
" method="post" name="payments_form_<?php echo $this->_tpl_vars['id']; ?>
" enctype="multipart/form-data" class="cm-form-highlight <?php if ($this->_tpl_vars['hide_fields']): ?> cm-hide-inputs<?php endif; ?>">
<input type="hidden" name="payment_id" value="<?php echo $this->_tpl_vars['id']; ?>
" />

<div class="tabs cm-j-tabs">
	<ul>
		<li id="tab_details_<?php echo $this->_tpl_vars['id']; ?>
" class="cm-js cm-active"><a><?php echo fn_get_lang_var('general', $this->getLanguage()); ?>
</a></li>
		<li id="tab_conf_<?php echo $this->_tpl_vars['id']; ?>
" class="cm-js cm-ajax <?php if (! $this->_tpl_vars['payment']['processor_id']): ?>hidden<?php endif; ?>"><a <?php if ($this->_tpl_vars['payment']['processor_id']): ?>href="<?php echo fn_url("payments.processor?payment_id=".($this->_tpl_vars['id'])); ?>
"<?php endif; ?>><?php echo fn_get_lang_var('configure', $this->getLanguage()); ?>
</a></li>
	</ul>
</div>

<div class="cm-tabs-content" id="tabs_content_<?php echo $this->_tpl_vars['id']; ?>
">
	<div id="content_tab_details_<?php echo $this->_tpl_vars['id']; ?>
">
	<fieldset>
		<div class="form-field">
			<label for="elm_payment_name_<?php echo $this->_tpl_vars['id']; ?>
" class="cm-required"><?php echo fn_get_lang_var('name', $this->getLanguage()); ?>
:</label>
			<input id="elm_payment_name_<?php echo $this->_tpl_vars['id']; ?>
" type="text" name="payment_data[payment]" value="<?php echo $this->_tpl_vars['payment']['payment']; ?>
" class="input-text-large main-input" />
		</div>



		<div class="form-field">
			<label for="elm_payment_processor_<?php echo $this->_tpl_vars['id']; ?>
"><?php echo fn_get_lang_var('processor', $this->getLanguage()); ?>
:</label>
			<select id="elm_payment_processor_<?php echo $this->_tpl_vars['id']; ?>
" name="payment_data[processor_id]" onchange="fn_switch_processor(<?php echo $this->_tpl_vars['id']; ?>
, this.value);">
				<option value=""><?php echo fn_get_lang_var('offline', $this->getLanguage()); ?>
</option>
				<optgroup label="<?php echo fn_get_lang_var('checkout', $this->getLanguage()); ?>
">
					<?php $_from = $this->_tpl_vars['payment_processors']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['processor']):
?>
						<?php if ($this->_tpl_vars['processor']['type'] != 'P'): ?>
							<option value="<?php echo $this->_tpl_vars['processor']['processor_id']; ?>
" <?php if ($this->_tpl_vars['payment']['processor_id'] == $this->_tpl_vars['processor']['processor_id']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['processor']['processor']; ?>
</option>
						<?php endif; ?>
					<?php endforeach; endif; unset($_from); ?>
				</optgroup>
				<optgroup label="<?php echo fn_get_lang_var('gateways', $this->getLanguage()); ?>
">
					<?php $_from = $this->_tpl_vars['payment_processors']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['processor']):
?>
						<?php if ($this->_tpl_vars['processor']['type'] == 'P'): ?>
							<option value="<?php echo $this->_tpl_vars['processor']['processor_id']; ?>
" <?php if ($this->_tpl_vars['payment']['processor_id'] == $this->_tpl_vars['processor']['processor_id']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['processor']['processor']; ?>
</option>
						<?php endif; ?>
					<?php endforeach; endif; unset($_from); ?>
				</optgroup>
			</select>

			<p id="elm_processor_description_<?php echo $this->_tpl_vars['id']; ?>
" class="description <?php if (! $this->_tpl_vars['payment_processors'][$this->_tpl_vars['payment']['processor_id']]['description']): ?>hidden<?php endif; ?>">
			<?php echo smarty_modifier_unescape($this->_tpl_vars['payment_processors'][$this->_tpl_vars['payment']['processor_id']]['description']); ?>

			</p>
		</div>

		<div class="form-field">
			<label for="elm_payment_tpl_<?php echo $this->_tpl_vars['id']; ?>
"><?php echo fn_get_lang_var('template', $this->getLanguage()); ?>
<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('tooltip' => fn_get_lang_var('tt_views_payments_update_template', $this->getLanguage()), )); ?><?php if ($this->_tpl_vars['tooltip']): ?> (<a class="cm-tooltip<?php if ($this->_tpl_vars['params']): ?> <?php echo $this->_tpl_vars['params']; ?>
<?php endif; ?>" title="<?php echo smarty_modifier_escape($this->_tpl_vars['tooltip'], 'html'); ?>
">?</a>)<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>:</label>
			<select id="elm_payment_tpl_<?php echo $this->_tpl_vars['id']; ?>
" name="payment_data[template]" <?php if ($this->_tpl_vars['payment']['processor_id']): ?>disabled="disabled"<?php endif; ?>>
				<?php $_from = $this->_tpl_vars['templates']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['template']):
?>
					<option value="<?php echo $this->_tpl_vars['template']; ?>
" <?php if ($this->_tpl_vars['payment']['template'] == $this->_tpl_vars['template']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['template']; ?>
</option>
				<?php endforeach; endif; unset($_from); ?>
			</select>
		</div>

		<div class="form-field">
			<label for="elm_payment_category_<?php echo $this->_tpl_vars['id']; ?>
"><?php echo fn_get_lang_var('payment_category', $this->getLanguage()); ?>
:</label>
			<select id="elm_payment_category_<?php echo $this->_tpl_vars['id']; ?>
" name="payment_data[payment_category]">
				<option value="tab1" <?php if ($this->_tpl_vars['payment']['payment_category'] == 'tab1'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('payments_tab1', $this->getLanguage()); ?>
</option>
				<option value="tab2" <?php if ($this->_tpl_vars['payment']['payment_category'] == 'tab2'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('payments_tab2', $this->getLanguage()); ?>
</option>
				<option value="tab3" <?php if ($this->_tpl_vars['payment']['payment_category'] == 'tab3'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('payments_tab3', $this->getLanguage()); ?>
</option>
			</select>
			<p class="description">
				<?php echo fn_get_lang_var('payment_category_note', $this->getLanguage()); ?>

			</p>
		</div>

		<div class="form-field">
			<label><?php echo fn_get_lang_var('usergroups', $this->getLanguage()); ?>
<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('tooltip' => fn_get_lang_var('ttc_usergroups', $this->getLanguage()), )); ?><?php if ($this->_tpl_vars['tooltip']): ?> (<a class="cm-tooltip<?php if ($this->_tpl_vars['params']): ?> <?php echo $this->_tpl_vars['params']; ?>
<?php endif; ?>" title="<?php echo smarty_modifier_escape($this->_tpl_vars['tooltip'], 'html'); ?>
">?</a>)<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>:</label>
			<div class="select-field">
				<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('id' => "elm_payment_usergroup_".($this->_tpl_vars['id']), 'name' => "payment_data[usergroup_ids]", 'usergroups' => $this->_tpl_vars['usergroups'], 'usergroup_ids' => $this->_tpl_vars['payment']['usergroup_ids'], 'list_mode' => false, )); ?>
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

		<div class="form-field">
			<label for="elm_payment_description_<?php echo $this->_tpl_vars['id']; ?>
"><?php echo fn_get_lang_var('description', $this->getLanguage()); ?>
:</label>
			<input id="elm_payment_description_<?php echo $this->_tpl_vars['id']; ?>
" type="text" name="payment_data[description]" value="<?php echo $this->_tpl_vars['payment']['description']; ?>
" class="input-text-large" />
		</div>

		<?php $this->_tag_stack[] = array('hook', array('name' => "payments:update")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
		<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

		<div class="form-field">
			<label for="elm_payment_surcharge_<?php echo $this->_tpl_vars['id']; ?>
"><?php echo fn_get_lang_var('surcharge', $this->getLanguage()); ?>
:</label>
			<input id="elm_payment_surcharge_<?php echo $this->_tpl_vars['id']; ?>
" type="text" name="payment_data[p_surcharge]" value="<?php echo $this->_tpl_vars['payment']['p_surcharge']; ?>
" class="input-text-short" size="4" /> % + <input type="text" name="payment_data[a_surcharge]" value="<?php echo $this->_tpl_vars['payment']['a_surcharge']; ?>
" class="input-text-short" size="4" /> <?php echo $this->_tpl_vars['currencies'][$this->_tpl_vars['primary_currency']]['symbol']; ?>

		</div>

		<div class="form-field">
			<label for="elm_payment_surcharge_title_<?php echo $this->_tpl_vars['id']; ?>
"><?php echo fn_get_lang_var('surcharge_title', $this->getLanguage()); ?>
<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('tooltip' => fn_get_lang_var('tt_views_payments_update_surcharge_title', $this->getLanguage()), )); ?><?php if ($this->_tpl_vars['tooltip']): ?> (<a class="cm-tooltip<?php if ($this->_tpl_vars['params']): ?> <?php echo $this->_tpl_vars['params']; ?>
<?php endif; ?>" title="<?php echo smarty_modifier_escape($this->_tpl_vars['tooltip'], 'html'); ?>
">?</a>)<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>:</label>
			<input id="elm_payment_surcharge_title_<?php echo $this->_tpl_vars['id']; ?>
" type="text" name="payment_data[surcharge_title]" value="<?php echo $this->_tpl_vars['payment']['surcharge_title']; ?>
" class="input-text-large" />
		</div>

		<div class="form-field">
		<label><?php echo fn_get_lang_var('taxes', $this->getLanguage()); ?>
<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('tooltip' => fn_get_lang_var('tt_views_payments_update_taxes', $this->getLanguage()), )); ?><?php if ($this->_tpl_vars['tooltip']): ?> (<a class="cm-tooltip<?php if ($this->_tpl_vars['params']): ?> <?php echo $this->_tpl_vars['params']; ?>
<?php endif; ?>" title="<?php echo smarty_modifier_escape($this->_tpl_vars['tooltip'], 'html'); ?>
">?</a>)<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>:</label>
			<div class="select-field">
				<?php $_from = $this->_tpl_vars['taxes']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['tax']):
?>
					<input type="checkbox"	name="payment_data[tax_ids][<?php echo $this->_tpl_vars['tax']['tax_id']; ?>
]" id="elm_payment_taxes_<?php echo $this->_tpl_vars['tax']['tax_id']; ?>
" <?php if (smarty_modifier_in_array($this->_tpl_vars['tax']['tax_id'], $this->_tpl_vars['payment']['tax_ids'])): ?>checked="checked"<?php endif; ?> class="checkbox" value="<?php echo $this->_tpl_vars['tax']['tax_id']; ?>
" />
					<label for="elm_payment_taxes_<?php echo $this->_tpl_vars['tax']['tax_id']; ?>
"><?php echo $this->_tpl_vars['tax']['tax']; ?>
</label>
				<?php endforeach; else: ?>
					&ndash;
				<?php endif; unset($_from); ?>
			</div>
		</div>

		<div class="form-field">
			<label for="elm_payment_instructions_<?php echo $this->_tpl_vars['id']; ?>
"><?php echo fn_get_lang_var('payment_instructions', $this->getLanguage()); ?>
:</label>
			<textarea id="elm_payment_instructions_<?php echo $this->_tpl_vars['id']; ?>
" name="payment_data[instructions]" cols="55" rows="8" class="cm-wysiwyg input-textarea-long"><?php echo $this->_tpl_vars['payment']['instructions']; ?>
</textarea>
			
		</div>

		<?php if ($this->_tpl_vars['mode'] == 'add'): ?>
			<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('input_name' => "payment_data[status]", 'id' => "elm_payment_status_".($this->_tpl_vars['id']), 'obj_id' => $this->_tpl_vars['id'], 'obj' => $this->_tpl_vars['payment'], )); ?><?php if ($this->_tpl_vars['display'] == 'select'): ?>
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
		<?php endif; ?>

		<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('data_name' => "payment_data[localization]", 'id' => "elm_payment_localization_".($this->_tpl_vars['id']), 'data_from' => $this->_tpl_vars['payment']['localization'], )); ?>
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

		<div class="form-field">
			<label><?php echo fn_get_lang_var('icon', $this->getLanguage()); ?>
:</label>
			<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/attach_images.tpl", 'smarty_include_vars' => array('image_name' => 'payment_image','image_key' => $this->_tpl_vars['id'],'image_object_type' => 'payment','image_pair' => $this->_tpl_vars['payment']['icon'],'no_detailed' => 'Y','hide_titles' => 'Y','image_object_id' => $this->_tpl_vars['id'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</div>

		<?php $this->_tag_stack[] = array('hook', array('name' => "payments:properties")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
		<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
	</fieldset>
	<!--content_tab_details_<?php echo $this->_tpl_vars['id']; ?>
--></div>
</div>

<?php if (! $this->_tpl_vars['hide_for_vendor']): ?>
	<div class="buttons-container">
		<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/save_cancel.tpl", 'smarty_include_vars' => array('but_name' => "dispatch[payments.update]",'cancel_action' => 'close')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</div>
<?php endif; ?>

</form>
<!--content_group<?php echo $this->_tpl_vars['id']; ?>
--></div>