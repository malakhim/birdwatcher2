<?php /* Smarty version 2.6.18, created on 2014-03-07 16:30:03
         compiled from views/currencies/update.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'fn_url', 'views/currencies/update.tpl', 23, false),array('modifier', 'fn_check_form_permissions', 'views/currencies/update.tpl', 23, false),array('modifier', 'is_array', 'views/currencies/update.tpl', 98, false),array('modifier', 'fn_from_json', 'views/currencies/update.tpl', 99, false),array('modifier', 'default', 'views/currencies/update.tpl', 102, false),array('modifier', 'lower', 'views/currencies/update.tpl', 102, false),array('modifier', 'fn_allow_save_object', 'views/currencies/update.tpl', 139, false),array('block', 'hook', 'views/currencies/update.tpl', 63, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('general','name','code','primary_currency','currency_rate','currency_sign','after_sum','active','hidden','disabled','status','active','hidden','disabled','status','active','hidden','pending','disabled','ths_sign','dec_sign','decimals'));
?>
<?php 

				$rname = !empty($resource_name) ? $resource_name : $params['smarty_include_tpl_file'];
				if ($this->compile_check && empty($inline_no_check[$rname]) && $this->is_cached($rname)) {
					if ($this->check_inline_blocks(array (
  'common_templates/select_status.tpl' => 1367063753,
))) {
						$_smarty_compile_path = $this->_get_compile_path($rname);
						$this->_compile_resource($rname, $_smarty_compile_path);
						$inline_no_check[$rname] = true;
						include $_smarty_compile_path;
						return;
					}
				}
			 ?><?php if ($this->_tpl_vars['currency']['currency_code']): ?>
	<?php $this->assign('id', $this->_tpl_vars['currency']['currency_code'], false); ?>
<?php else: ?>
	<?php $this->assign('id', '0', false); ?>	
<?php endif; ?>

<div id="content_group<?php echo $this->_tpl_vars['id']; ?>
">

<form action="<?php echo fn_url(""); ?>
" name="update_currency_form_<?php echo $this->_tpl_vars['id']; ?>
" method="post" class="cm-form-highlight<?php if (fn_check_form_permissions("")): ?> cm-hide-inputs<?php endif; ?>">
<input type="hidden" name="currency_code" value="<?php echo $this->_tpl_vars['id']; ?>
" />
<input type="hidden" name="redirect_url" value="<?php echo $this->_tpl_vars['_REQUEST']['return_url']; ?>
" />

<div class="tabs cm-j-tabs">
	<ul>
		<li id="tab_general_<?php echo $this->_tpl_vars['id']; ?>
" class="cm-js cm-active"><a><?php echo fn_get_lang_var('general', $this->getLanguage()); ?>
</a></li>
	</ul>
</div>

<div class="cm-tabs-content" id="content_tab_general_<?php echo $this->_tpl_vars['id']; ?>
">
<fieldset>
	<div class="form-field">
		<label class="cm-required" for="description_<?php echo $this->_tpl_vars['id']; ?>
"><?php echo fn_get_lang_var('name', $this->getLanguage()); ?>
:</label>
		<input type="text" name="currency_data[description]" value="<?php echo $this->_tpl_vars['currency']['description']; ?>
" id="description_<?php echo $this->_tpl_vars['id']; ?>
" class="input-text" size="18" />
	</div>

	<div class="form-field">
		<label class="cm-required" for="currency_code_<?php echo $this->_tpl_vars['id']; ?>
"><?php echo fn_get_lang_var('code', $this->getLanguage()); ?>
:</label>
		<input type="text" name="currency_data[currency_code]" size="8" value="<?php echo $this->_tpl_vars['currency']['currency_code']; ?>
" id="currency_code_<?php echo $this->_tpl_vars['id']; ?>
" class="input-text" onkeyup="var matches = this.value.match(/^(\w*)/gi);  if (matches) this.value = matches;" />
	</div>
	
	<?php if ($this->_tpl_vars['id']): ?>
	<div class="form-field">
		<label for="is_primary_currency_<?php echo $this->_tpl_vars['id']; ?>
"><?php echo fn_get_lang_var('primary_currency', $this->getLanguage()); ?>
:</label>
		<input type="hidden" name="currency_data[coefficient]" value="1" />
		<input type="checkbox" name="currency_data[is_primary]" value="Y" <?php if ($this->_tpl_vars['currency']['is_primary'] == 'Y'): ?>checked="checked"<?php endif; ?> onclick="$('.cm-coefficient').attr('disabled', $(this).is(':checked') ? 'disabled' : '')" id="is_primary_currency_<?php echo $this->_tpl_vars['id']; ?>
" class="checkbox" />
	</div>
	<?php endif; ?>

	<div class="form-field">
		<label class="cm-required" for="coefficient_<?php echo $this->_tpl_vars['id']; ?>
"><?php echo fn_get_lang_var('currency_rate', $this->getLanguage()); ?>
:</label>
		<input type="text" name="currency_data[coefficient]" size="7" value="<?php echo $this->_tpl_vars['currency']['coefficient']; ?>
" id="coefficient_<?php echo $this->_tpl_vars['id']; ?>
" class="input-text cm-coefficient" <?php if ($this->_tpl_vars['currency']['is_primary'] == 'Y'): ?>disabled="disabled"<?php endif; ?> />
	</div>
	
	<div class="form-field">
		<label for="symbol_<?php echo $this->_tpl_vars['id']; ?>
"><?php echo fn_get_lang_var('currency_sign', $this->getLanguage()); ?>
:</label>
		<input type="text" name="currency_data[symbol]" size="6" value="<?php echo $this->_tpl_vars['currency']['symbol']; ?>
" id="symbol_<?php echo $this->_tpl_vars['id']; ?>
" class="input-text" />
	</div>
	
<?php $this->_tag_stack[] = array('hook', array('name' => "currencies:autoupdate")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

	<div class="form-field">
		<label for="after_<?php echo $this->_tpl_vars['id']; ?>
"><?php echo fn_get_lang_var('after_sum', $this->getLanguage()); ?>
:</label>
		<input type="hidden" name="currency_data[after]" value="N" />
		<input type="checkbox" name="currency_data[after]" value="Y" <?php if ($this->_tpl_vars['currency']['after'] == 'Y'): ?>checked="checked"<?php endif; ?> id="after_<?php echo $this->_tpl_vars['id']; ?>
" class="checkbox" />
	</div>

	<?php if (! $this->_tpl_vars['id']): ?>
		<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('input_name' => "currency_data[status]", 'id' => 'add_currency', )); ?><?php if ($this->_tpl_vars['display'] == 'select'): ?>
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

	<div class="form-field">
		<label for="thousands_separator_<?php echo $this->_tpl_vars['id']; ?>
"><?php echo fn_get_lang_var('ths_sign', $this->getLanguage()); ?>
:</label>
		<input type="text" name="currency_data[thousands_separator]" size="1" maxlength="1" value="<?php echo $this->_tpl_vars['currency']['thousands_separator']; ?>
" id="thousands_separator_<?php echo $this->_tpl_vars['id']; ?>
" class="input-text" />
	</div>

	<div class="form-field">
		<label for="decimal_separator_<?php echo $this->_tpl_vars['id']; ?>
"><?php echo fn_get_lang_var('dec_sign', $this->getLanguage()); ?>
:</label>
		<input type="text" name="currency_data[decimals_separator]" size="1" maxlength="1" value="<?php echo $this->_tpl_vars['currency']['decimals_separator']; ?>
" id="decimal_separator_<?php echo $this->_tpl_vars['id']; ?>
" class="input-text" />
	</div>

	<div class="form-field">
		<label for="decimals_<?php echo $this->_tpl_vars['id']; ?>
"><?php echo fn_get_lang_var('decimals', $this->getLanguage()); ?>
:</label>
		<input type="text" name="currency_data[decimals]" size="1" maxlength="2" value="<?php echo $this->_tpl_vars['currency']['decimals']; ?>
" id="decimals_<?php echo $this->_tpl_vars['id']; ?>
" class="input-text" />
	</div>
	</fieldset>
</div>

<?php if (fn_allow_save_object("", "", true)): ?>
	<div class="buttons-container">
		<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/save_cancel.tpl", 'smarty_include_vars' => array('but_name' => "dispatch[currencies.update]",'cancel_action' => 'close')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</div>
<?php endif; ?>

</form>
<!--content_group<?php echo $this->_tpl_vars['id']; ?>
--></div>