<?php /* Smarty version 2.6.18, created on 2014-03-08 11:26:25
         compiled from views/profiles/components/profile_fields.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'hook', 'views/profiles/components/profile_fields.tpl', 77, false),array('modifier', 'default', 'views/profiles/components/profile_fields.tpl', 94, false),array('modifier', 'date_format', 'views/profiles/components/profile_fields.tpl', 129, false),array('function', 'math', 'views/profiles/components/profile_fields.tpl', 145, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('email','shipping_same_as_billing','text_billing_same_with_shipping','yes','no','select_state','select_country','calendar','calendar','weekday_abr_0','weekday_abr_1','weekday_abr_2','weekday_abr_3','weekday_abr_4','weekday_abr_5','weekday_abr_6','month_name_abr_1','month_name_abr_2','month_name_abr_3','month_name_abr_4','month_name_abr_5','month_name_abr_6','month_name_abr_7','month_name_abr_8','month_name_abr_9','month_name_abr_10','month_name_abr_11','month_name_abr_12','calendar','calendar','weekday_abr_0','weekday_abr_1','weekday_abr_2','weekday_abr_3','weekday_abr_4','weekday_abr_5','weekday_abr_6','month_name_abr_1','month_name_abr_2','month_name_abr_3','month_name_abr_4','month_name_abr_5','month_name_abr_6','month_name_abr_7','month_name_abr_8','month_name_abr_9','month_name_abr_10','month_name_abr_11','month_name_abr_12','address_residential','address_commercial'));
?>
<?php 

				$rname = !empty($resource_name) ? $resource_name : $params['smarty_include_tpl_file'];
				if ($this->compile_check && empty($inline_no_check[$rname]) && $this->is_cached($rname)) {
					if ($this->check_inline_blocks(array (
  'common_templates/calendar.tpl' => 1367063745,
))) {
						$_smarty_compile_path = $this->_get_compile_path($rname);
						$this->_compile_resource($rname, $_smarty_compile_path);
						$inline_no_check[$rname] = true;
						include $_smarty_compile_path;
						return;
					}
				}
			 ?><?php if ($this->_tpl_vars['show_email']): ?>
	<div class="form-field">
		<label for="<?php echo $this->_tpl_vars['id_prefix']; ?>
elm_email" class="cm-required cm-email"><?php echo fn_get_lang_var('email', $this->getLanguage()); ?>
<i>*</i></label>
		<input type="text" id="<?php echo $this->_tpl_vars['id_prefix']; ?>
elm_email" name="user_data[email]" size="32" value="<?php echo $this->_tpl_vars['user_data']['email']; ?>
" class="input-text <?php echo $this->_tpl_vars['_class']; ?>
" <?php echo $this->_tpl_vars['disabled_param']; ?>
 />
	</div>
<?php else: ?>

<?php if ($this->_tpl_vars['profile_fields'][$this->_tpl_vars['section']]): ?>

<?php if ($this->_tpl_vars['address_flag']): ?>
	<div class="address-switch clearfix">
		<div class="float-left"><span><?php if ($this->_tpl_vars['section'] == 'S'): ?><?php echo fn_get_lang_var('shipping_same_as_billing', $this->getLanguage()); ?>
<?php else: ?><?php echo fn_get_lang_var('text_billing_same_with_shipping', $this->getLanguage()); ?>
<?php endif; ?></span></div>
		<div class="float-right">
			<input class="radio cm-switch-availability cm-switch-inverse cm-switch-visibilty" type="radio" name="copy_address" value="Y" id="sw_<?php echo $this->_tpl_vars['body_id']; ?>
_suffix_yes" <?php if (! $this->_tpl_vars['ship_to_another']): ?>checked="checked"<?php endif; ?> /><label for="sw_<?php echo $this->_tpl_vars['body_id']; ?>
_suffix_yes"><?php echo fn_get_lang_var('yes', $this->getLanguage()); ?>
</label>
			<input class="radio cm-switch-availability cm-switch-visibilty" type="radio" name="copy_address" value="" id="sw_<?php echo $this->_tpl_vars['body_id']; ?>
_suffix_no" <?php if ($this->_tpl_vars['ship_to_another']): ?>checked="checked"<?php endif; ?> /><label for="sw_<?php echo $this->_tpl_vars['body_id']; ?>
_suffix_no"><?php echo fn_get_lang_var('no', $this->getLanguage()); ?>
</label>
		</div>
	</div>
<?php endif; ?>

<?php if (( $this->_tpl_vars['address_flag'] && ! $this->_tpl_vars['ship_to_another'] && ( $this->_tpl_vars['section'] == 'S' || $this->_tpl_vars['section'] == 'B' ) ) || $this->_tpl_vars['disabled_by_default']): ?>
	<?php $this->assign('disabled_param', "disabled=\"disabled\"", false); ?>
	<?php $this->assign('_class', 'disabled', false); ?>
	<?php $this->assign('hide_fields', true, false); ?>
<?php else: ?>
	<?php $this->assign('disabled_param', "", false); ?>
	<?php $this->assign('_class', "", false); ?>
<?php endif; ?>

<div class="clearfix">
<?php if ($this->_tpl_vars['body_id'] || $this->_tpl_vars['grid_wrap']): ?>
	<div id="<?php echo $this->_tpl_vars['body_id']; ?>
" class="<?php if ($this->_tpl_vars['hide_fields']): ?>hidden<?php endif; ?>">
		<div class="<?php echo $this->_tpl_vars['grid_wrap']; ?>
">
<?php endif; ?>

<?php if (! $this->_tpl_vars['nothing_extra']): ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/subheader.tpl", 'smarty_include_vars' => array('title' => $this->_tpl_vars['title'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php endif; ?>

<?php $_from = $this->_tpl_vars['profile_fields'][$this->_tpl_vars['section']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['field']):
?>

<?php if ($this->_tpl_vars['field']['field_name']): ?>
	<?php $this->assign('data_name', 'user_data', false); ?>
	<?php $this->assign('data_id', $this->_tpl_vars['field']['field_name'], false); ?>
	<?php $this->assign('value', $this->_tpl_vars['user_data'][$this->_tpl_vars['data_id']], false); ?>
<?php else: ?>
	<?php $this->assign('data_name', "user_data[fields]", false); ?>
	<?php $this->assign('data_id', $this->_tpl_vars['field']['field_id'], false); ?>
	<?php $this->assign('value', $this->_tpl_vars['user_data']['fields'][$this->_tpl_vars['data_id']], false); ?>
<?php endif; ?>

<?php $this->assign('skip_field', false, false); ?>
<?php if ($this->_tpl_vars['section'] == 'S' || $this->_tpl_vars['section'] == 'B'): ?>
	<?php if ($this->_tpl_vars['section'] == 'S'): ?>
		<?php $this->assign('_to', 'B', false); ?>
	<?php else: ?>
		<?php $this->assign('_to', 'S', false); ?>
	<?php endif; ?>
	<?php if (! $this->_tpl_vars['profile_fields'][$this->_tpl_vars['_to']][$this->_tpl_vars['field']['matching_id']]): ?>
		<?php $this->assign('skip_field', true, false); ?>
	<?php endif; ?>
<?php endif; ?>

<?php $this->_tag_stack[] = array('hook', array('name' => "profiles:profile_fields")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
<div class="form-field <?php echo $this->_tpl_vars['field']['class']; ?>
">
	<?php if ($this->_tpl_vars['pref_field_name'] != $this->_tpl_vars['field']['description'] || $this->_tpl_vars['field']['required'] == 'Y'): ?>
		<label for="<?php echo $this->_tpl_vars['id_prefix']; ?>
elm_<?php echo $this->_tpl_vars['field']['field_id']; ?>
" class="cm-profile-field <?php if ($this->_tpl_vars['field']['required'] == 'Y'): ?>cm-required<?php endif; ?><?php if ($this->_tpl_vars['field']['field_type'] == 'P'): ?> cm-phone<?php endif; ?><?php if ($this->_tpl_vars['field']['field_type'] == 'Z'): ?> cm-zipcode<?php endif; ?><?php if ($this->_tpl_vars['field']['field_type'] == 'E'): ?> cm-email<?php endif; ?><?php if ($this->_tpl_vars['field']['field_type'] == 'A'): ?> cm-state<?php endif; ?><?php if ($this->_tpl_vars['field']['field_type'] == 'O'): ?> cm-country<?php endif; ?> <?php if ($this->_tpl_vars['field']['field_type'] == 'O' || $this->_tpl_vars['field']['field_type'] == 'A' || $this->_tpl_vars['field']['field_type'] == 'Z'): ?><?php if ($this->_tpl_vars['section'] == 'S'): ?>cm-location-shipping<?php else: ?>cm-location-billing<?php endif; ?><?php endif; ?>"><?php echo $this->_tpl_vars['field']['description']; ?>
</label>
	<?php endif; ?>
	<?php if ($this->_tpl_vars['field']['field_type'] == 'L'): ?> 		<select id="<?php echo $this->_tpl_vars['id_prefix']; ?>
elm_<?php echo $this->_tpl_vars['field']['field_id']; ?>
" class="<?php if (! $this->_tpl_vars['skip_field']): ?><?php echo $this->_tpl_vars['_class']; ?>
<?php else: ?>cm-skip-avail-switch<?php endif; ?>" name="<?php echo $this->_tpl_vars['data_name']; ?>
[<?php echo $this->_tpl_vars['data_id']; ?>
]" <?php if (! $this->_tpl_vars['skip_field']): ?><?php echo $this->_tpl_vars['disabled_param']; ?>
<?php endif; ?>>
			<?php $_from = $this->_tpl_vars['titles']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['t']):
?>
			<option <?php if ($this->_tpl_vars['value'] == $this->_tpl_vars['t']['param']): ?>selected="selected"<?php endif; ?> value="<?php echo $this->_tpl_vars['t']['param']; ?>
"><?php echo $this->_tpl_vars['t']['descr']; ?>
</option>
			<?php endforeach; endif; unset($_from); ?>
		</select>

	<?php elseif ($this->_tpl_vars['field']['field_type'] == 'A'): ?>  		<select id="<?php echo $this->_tpl_vars['id_prefix']; ?>
elm_<?php echo $this->_tpl_vars['field']['field_id']; ?>
" class="<?php if (! $this->_tpl_vars['skip_field']): ?><?php echo $this->_tpl_vars['_class']; ?>
<?php endif; ?>" name="<?php echo $this->_tpl_vars['data_name']; ?>
[<?php echo $this->_tpl_vars['data_id']; ?>
]" <?php if (! $this->_tpl_vars['skip_field']): ?><?php echo $this->_tpl_vars['disabled_param']; ?>
<?php endif; ?>>
			<option value="">- <?php echo fn_get_lang_var('select_state', $this->getLanguage()); ?>
 -</option>
						<?php $this->assign('country_code', $this->_tpl_vars['settings']['General']['default_country'], false); ?>
			<?php $this->assign('state_code', smarty_modifier_default(@$this->_tpl_vars['value'], @$this->_tpl_vars['settings']['General']['default_state']), false); ?>
			<?php if ($this->_tpl_vars['states']): ?>
				<?php $_from = $this->_tpl_vars['states'][$this->_tpl_vars['country_code']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['state']):
?>
					<option <?php if ($this->_tpl_vars['state_code'] == $this->_tpl_vars['state']['code']): ?>selected="selected"<?php endif; ?> value="<?php echo $this->_tpl_vars['state']['code']; ?>
"><?php echo $this->_tpl_vars['state']['state']; ?>
</option>
				<?php endforeach; endif; unset($_from); ?>
			<?php endif; ?>
		</select><input type="text" id="elm_<?php echo $this->_tpl_vars['field']['field_id']; ?>
_d" name="<?php echo $this->_tpl_vars['data_name']; ?>
[<?php echo $this->_tpl_vars['data_id']; ?>
]" size="32" maxlength="64" value="<?php echo $this->_tpl_vars['value']; ?>
" disabled="disabled" class="input-text hidden <?php if ($this->_tpl_vars['_class']): ?>disabled<?php endif; ?>"/>
		<input type="hidden" id="<?php echo $this->_tpl_vars['id_prefix']; ?>
elm_<?php echo $this->_tpl_vars['field']['field_id']; ?>
_default" value="<?php echo $this->_tpl_vars['state_code']; ?>
" />

	<?php elseif ($this->_tpl_vars['field']['field_type'] == 'O'): ?>  		<?php $this->assign('_country', smarty_modifier_default(@$this->_tpl_vars['value'], @$this->_tpl_vars['settings']['General']['default_country']), false); ?>
		<select id="<?php echo $this->_tpl_vars['id_prefix']; ?>
elm_<?php echo $this->_tpl_vars['field']['field_id']; ?>
" class="<?php if ($this->_tpl_vars['section'] == 'S'): ?>cm-location-shipping<?php else: ?>cm-location-billing<?php endif; ?> <?php if (! $this->_tpl_vars['skip_field']): ?><?php echo $this->_tpl_vars['_class']; ?>
<?php else: ?>cm-skip-avail-switch<?php endif; ?>" name="<?php echo $this->_tpl_vars['data_name']; ?>
[<?php echo $this->_tpl_vars['data_id']; ?>
]" <?php if (! $this->_tpl_vars['skip_field']): ?><?php echo $this->_tpl_vars['disabled_param']; ?>
<?php endif; ?>>
			<?php $this->_tag_stack[] = array('hook', array('name' => "profiles:country_selectbox_items")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
			<option value="">- <?php echo fn_get_lang_var('select_country', $this->getLanguage()); ?>
 -</option>
			<?php $_from = $this->_tpl_vars['countries']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['country']):
?>
			<option <?php if ($this->_tpl_vars['_country'] == $this->_tpl_vars['country']['code']): ?>selected="selected"<?php endif; ?> value="<?php echo $this->_tpl_vars['country']['code']; ?>
"><?php echo $this->_tpl_vars['country']['country']; ?>
</option>
			<?php endforeach; endif; unset($_from); ?>
			<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
		</select>
	
	<?php elseif ($this->_tpl_vars['field']['field_type'] == 'C'): ?>  		<input type="hidden" name="<?php echo $this->_tpl_vars['data_name']; ?>
[<?php echo $this->_tpl_vars['data_id']; ?>
]" value="N" <?php if (! $this->_tpl_vars['skip_field']): ?><?php echo $this->_tpl_vars['disabled_param']; ?>
<?php endif; ?> />
		<input type="checkbox" id="<?php echo $this->_tpl_vars['id_prefix']; ?>
elm_<?php echo $this->_tpl_vars['field']['field_id']; ?>
" name="<?php echo $this->_tpl_vars['data_name']; ?>
[<?php echo $this->_tpl_vars['data_id']; ?>
]" value="Y" <?php if ($this->_tpl_vars['value'] == 'Y'): ?>checked="checked"<?php endif; ?> class="checkbox <?php if (! $this->_tpl_vars['skip_field']): ?><?php echo $this->_tpl_vars['_class']; ?>
<?php else: ?>cm-skip-avail-switch<?php endif; ?>" <?php if (! $this->_tpl_vars['skip_field']): ?><?php echo $this->_tpl_vars['disabled_param']; ?>
<?php endif; ?> />

	<?php elseif ($this->_tpl_vars['field']['field_type'] == 'T'): ?>  		<textarea class="input-textarea <?php if (! $this->_tpl_vars['skip_field']): ?><?php echo $this->_tpl_vars['_class']; ?>
<?php else: ?>cm-skip-avail-switch<?php endif; ?>" id="<?php echo $this->_tpl_vars['id_prefix']; ?>
elm_<?php echo $this->_tpl_vars['field']['field_id']; ?>
" name="<?php echo $this->_tpl_vars['data_name']; ?>
[<?php echo $this->_tpl_vars['data_id']; ?>
]" cols="32" rows="3" <?php if (! $this->_tpl_vars['skip_field']): ?><?php echo $this->_tpl_vars['disabled_param']; ?>
<?php endif; ?>><?php echo $this->_tpl_vars['value']; ?>
</textarea>
	
	<?php elseif ($this->_tpl_vars['field']['field_type'] == 'D'): ?>  		<?php if (! $this->_tpl_vars['skip_field']): ?>
			<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('date_id' => ($this->_tpl_vars['id_prefix'])."elm_".($this->_tpl_vars['field']['field_id']), 'date_name' => ($this->_tpl_vars['data_name'])."[".($this->_tpl_vars['data_id'])."]", 'date_val' => $this->_tpl_vars['value'], 'start_year' => '1902', 'end_year' => '0', 'extra' => $this->_tpl_vars['disabled_param'], )); ?><?php if ($this->_tpl_vars['settings']['Appearance']['calendar_date_format'] == 'month_first'): ?>
	<?php $this->assign('date_format', "%m/%d/%Y", false); ?>
<?php else: ?>
	<?php $this->assign('date_format', "%d/%m/%Y", false); ?>
<?php endif; ?>

<input type="text" id="<?php echo $this->_tpl_vars['date_id']; ?>
" name="<?php echo $this->_tpl_vars['date_name']; ?>
" class="input-text-medium<?php if ($this->_tpl_vars['date_meta']): ?> <?php echo $this->_tpl_vars['date_meta']; ?>
<?php endif; ?> cm-calendar" value="<?php if ($this->_tpl_vars['date_val']): ?><?php echo smarty_modifier_date_format($this->_tpl_vars['date_val'], ($this->_tpl_vars['date_format'])); ?>
<?php endif; ?>" <?php echo $this->_tpl_vars['extra']; ?>
 size="10" />&nbsp;<a class="cm-external-focus" rev="<?php echo $this->_tpl_vars['date_id']; ?>
"><img src="<?php echo $this->_tpl_vars['images_dir']; ?>
/icons/calendar.png" class="calendar-but valign" title="<?php echo fn_get_lang_var('calendar', $this->getLanguage()); ?>
" alt="<?php echo fn_get_lang_var('calendar', $this->getLanguage()); ?>
" /></a>

<script type="text/javascript">
//<![CDATA[

var config = <?php echo $this->_tpl_vars['ldelim']; ?>
<?php echo $this->_tpl_vars['rdelim']; ?>
;
config = <?php echo $this->_tpl_vars['ldelim']; ?>

			changeMonth: true,
			duration: 'fast',
			changeYear: true,
			numberOfMonths: 1,
			selectOtherMonths: true,
			showOtherMonths: true,
			firstDay: <?php if ($this->_tpl_vars['settings']['Appearance']['calendar_week_format'] == 'sunday_first'): ?>0<?php else: ?>1<?php endif; ?>,
			dayNamesMin: ['<?php echo fn_get_lang_var('weekday_abr_0', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('weekday_abr_1', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('weekday_abr_2', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('weekday_abr_3', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('weekday_abr_4', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('weekday_abr_5', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('weekday_abr_6', $this->getLanguage()); ?>
'],
			monthNamesShort: ['<?php echo fn_get_lang_var('month_name_abr_1', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('month_name_abr_2', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('month_name_abr_3', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('month_name_abr_4', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('month_name_abr_5', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('month_name_abr_6', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('month_name_abr_7', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('month_name_abr_8', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('month_name_abr_9', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('month_name_abr_10', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('month_name_abr_11', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('month_name_abr_12', $this->getLanguage()); ?>
'],
			yearRange: '<?php echo smarty_modifier_default(@$this->_tpl_vars['start_year'], @$this->_tpl_vars['settings']['Company']['company_start_year']); ?>
:<?php echo smarty_function_math(array('equation' => "x+y",'x' => smarty_modifier_default(@$this->_tpl_vars['end_year'], 1),'y' => smarty_modifier_date_format(@TIME, "%Y")), $this);?>
',
			dateFormat: '<?php if ($this->_tpl_vars['settings']['Appearance']['calendar_date_format'] == 'month_first'): ?>mm/dd/yy<?php else: ?>dd/mm/yy<?php endif; ?>'
		<?php echo $this->_tpl_vars['rdelim']; ?>
;

if ($.ua.browser == 'Internet Explorer') <?php echo $this->_tpl_vars['ldelim']; ?>

	$(window).load(function()<?php echo $this->_tpl_vars['ldelim']; ?>

		$('#<?php echo $this->_tpl_vars['date_id']; ?>
').datepicker(config);
	<?php echo $this->_tpl_vars['rdelim']; ?>
);
<?php echo $this->_tpl_vars['rdelim']; ?>
 else <?php echo $this->_tpl_vars['ldelim']; ?>

	$(function()<?php echo $this->_tpl_vars['ldelim']; ?>

		$('#<?php echo $this->_tpl_vars['date_id']; ?>
').datepicker(config);
	});
<?php echo $this->_tpl_vars['rdelim']; ?>

//]]>
</script><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
		<?php else: ?>
			<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('date_id' => ($this->_tpl_vars['id_prefix'])."elm_".($this->_tpl_vars['field']['field_id']), 'date_name' => ($this->_tpl_vars['data_name'])."[".($this->_tpl_vars['data_id'])."]", 'date_val' => $this->_tpl_vars['value'], 'start_year' => '1902', 'end_year' => '0', )); ?><?php if ($this->_tpl_vars['settings']['Appearance']['calendar_date_format'] == 'month_first'): ?>
	<?php $this->assign('date_format', "%m/%d/%Y", false); ?>
<?php else: ?>
	<?php $this->assign('date_format', "%d/%m/%Y", false); ?>
<?php endif; ?>

<input type="text" id="<?php echo $this->_tpl_vars['date_id']; ?>
" name="<?php echo $this->_tpl_vars['date_name']; ?>
" class="input-text-medium<?php if ($this->_tpl_vars['date_meta']): ?> <?php echo $this->_tpl_vars['date_meta']; ?>
<?php endif; ?> cm-calendar" value="<?php if ($this->_tpl_vars['date_val']): ?><?php echo smarty_modifier_date_format($this->_tpl_vars['date_val'], ($this->_tpl_vars['date_format'])); ?>
<?php endif; ?>" <?php echo $this->_tpl_vars['extra']; ?>
 size="10" />&nbsp;<a class="cm-external-focus" rev="<?php echo $this->_tpl_vars['date_id']; ?>
"><img src="<?php echo $this->_tpl_vars['images_dir']; ?>
/icons/calendar.png" class="calendar-but valign" title="<?php echo fn_get_lang_var('calendar', $this->getLanguage()); ?>
" alt="<?php echo fn_get_lang_var('calendar', $this->getLanguage()); ?>
" /></a>

<script type="text/javascript">
//<![CDATA[

var config = <?php echo $this->_tpl_vars['ldelim']; ?>
<?php echo $this->_tpl_vars['rdelim']; ?>
;
config = <?php echo $this->_tpl_vars['ldelim']; ?>

			changeMonth: true,
			duration: 'fast',
			changeYear: true,
			numberOfMonths: 1,
			selectOtherMonths: true,
			showOtherMonths: true,
			firstDay: <?php if ($this->_tpl_vars['settings']['Appearance']['calendar_week_format'] == 'sunday_first'): ?>0<?php else: ?>1<?php endif; ?>,
			dayNamesMin: ['<?php echo fn_get_lang_var('weekday_abr_0', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('weekday_abr_1', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('weekday_abr_2', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('weekday_abr_3', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('weekday_abr_4', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('weekday_abr_5', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('weekday_abr_6', $this->getLanguage()); ?>
'],
			monthNamesShort: ['<?php echo fn_get_lang_var('month_name_abr_1', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('month_name_abr_2', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('month_name_abr_3', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('month_name_abr_4', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('month_name_abr_5', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('month_name_abr_6', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('month_name_abr_7', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('month_name_abr_8', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('month_name_abr_9', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('month_name_abr_10', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('month_name_abr_11', $this->getLanguage()); ?>
', '<?php echo fn_get_lang_var('month_name_abr_12', $this->getLanguage()); ?>
'],
			yearRange: '<?php echo smarty_modifier_default(@$this->_tpl_vars['start_year'], @$this->_tpl_vars['settings']['Company']['company_start_year']); ?>
:<?php echo smarty_function_math(array('equation' => "x+y",'x' => smarty_modifier_default(@$this->_tpl_vars['end_year'], 1),'y' => smarty_modifier_date_format(@TIME, "%Y")), $this);?>
',
			dateFormat: '<?php if ($this->_tpl_vars['settings']['Appearance']['calendar_date_format'] == 'month_first'): ?>mm/dd/yy<?php else: ?>dd/mm/yy<?php endif; ?>'
		<?php echo $this->_tpl_vars['rdelim']; ?>
;

if ($.ua.browser == 'Internet Explorer') <?php echo $this->_tpl_vars['ldelim']; ?>

	$(window).load(function()<?php echo $this->_tpl_vars['ldelim']; ?>

		$('#<?php echo $this->_tpl_vars['date_id']; ?>
').datepicker(config);
	<?php echo $this->_tpl_vars['rdelim']; ?>
);
<?php echo $this->_tpl_vars['rdelim']; ?>
 else <?php echo $this->_tpl_vars['ldelim']; ?>

	$(function()<?php echo $this->_tpl_vars['ldelim']; ?>

		$('#<?php echo $this->_tpl_vars['date_id']; ?>
').datepicker(config);
	});
<?php echo $this->_tpl_vars['rdelim']; ?>

//]]>
</script><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
		<?php endif; ?>

	<?php elseif ($this->_tpl_vars['field']['field_type'] == 'S'): ?>  		<select id="<?php echo $this->_tpl_vars['id_prefix']; ?>
elm_<?php echo $this->_tpl_vars['field']['field_id']; ?>
" class="<?php if (! $this->_tpl_vars['skip_field']): ?><?php echo $this->_tpl_vars['_class']; ?>
<?php else: ?>cm-skip-avail-switch<?php endif; ?>" name="<?php echo $this->_tpl_vars['data_name']; ?>
[<?php echo $this->_tpl_vars['data_id']; ?>
]" <?php if (! $this->_tpl_vars['skip_field']): ?><?php echo $this->_tpl_vars['disabled_param']; ?>
<?php endif; ?>>
			<?php if ($this->_tpl_vars['field']['required'] != 'Y'): ?>
			<option value="">--</option>
			<?php endif; ?>
			<?php $_from = $this->_tpl_vars['field']['values']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
			<option <?php if ($this->_tpl_vars['value'] == $this->_tpl_vars['k']): ?>selected="selected"<?php endif; ?> value="<?php echo $this->_tpl_vars['k']; ?>
"><?php echo $this->_tpl_vars['v']; ?>
</option>
			<?php endforeach; endif; unset($_from); ?>
		</select>
	
	<?php elseif ($this->_tpl_vars['field']['field_type'] == 'R'): ?>  		<div id="<?php echo $this->_tpl_vars['id_prefix']; ?>
elm_<?php echo $this->_tpl_vars['field']['field_id']; ?>
">
			<?php $_from = $this->_tpl_vars['field']['values']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['rfe'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['rfe']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
        $this->_foreach['rfe']['iteration']++;
?>
			<input class="radio valign <?php if (! $this->_tpl_vars['skip_field']): ?><?php echo $this->_tpl_vars['_class']; ?>
<?php else: ?>cm-skip-avail-switch<?php endif; ?> <?php echo $this->_tpl_vars['id_prefix']; ?>
elm_<?php echo $this->_tpl_vars['field']['field_id']; ?>
" type="radio" id="<?php echo $this->_tpl_vars['id_prefix']; ?>
elm_<?php echo $this->_tpl_vars['field']['field_id']; ?>
_<?php echo $this->_tpl_vars['k']; ?>
" name="<?php echo $this->_tpl_vars['data_name']; ?>
[<?php echo $this->_tpl_vars['data_id']; ?>
]" value="<?php echo $this->_tpl_vars['k']; ?>
" <?php if (( ! $this->_tpl_vars['value'] && ($this->_foreach['rfe']['iteration'] <= 1) ) || $this->_tpl_vars['value'] == $this->_tpl_vars['k']): ?>checked="checked"<?php endif; ?> <?php if (! $this->_tpl_vars['skip_field']): ?><?php echo $this->_tpl_vars['disabled_param']; ?>
<?php endif; ?> /><span class="radio"><?php echo $this->_tpl_vars['v']; ?>
</span>
			<?php endforeach; endif; unset($_from); ?>
		</div>

	<?php elseif ($this->_tpl_vars['field']['field_type'] == 'N'): ?>  		<input class="radio valign <?php if (! $this->_tpl_vars['skip_field']): ?><?php echo $this->_tpl_vars['_class']; ?>
<?php else: ?>cm-skip-avail-switch<?php endif; ?> <?php echo $this->_tpl_vars['id_prefix']; ?>
elm_<?php echo $this->_tpl_vars['field']['field_id']; ?>
" type="radio" id="<?php echo $this->_tpl_vars['id_prefix']; ?>
elm_<?php echo $this->_tpl_vars['field']['field_id']; ?>
_residential" name="<?php echo $this->_tpl_vars['data_name']; ?>
[<?php echo $this->_tpl_vars['data_id']; ?>
]" value="residential" <?php if (! $this->_tpl_vars['value'] || $this->_tpl_vars['value'] == 'residential'): ?>checked="checked"<?php endif; ?> <?php if (! $this->_tpl_vars['skip_field']): ?><?php echo $this->_tpl_vars['disabled_param']; ?>
<?php endif; ?> /><span class="radio"><?php echo fn_get_lang_var('address_residential', $this->getLanguage()); ?>
</span>
		<input class="radio valign <?php if (! $this->_tpl_vars['skip_field']): ?><?php echo $this->_tpl_vars['_class']; ?>
<?php else: ?>cm-skip-avail-switch<?php endif; ?> <?php echo $this->_tpl_vars['id_prefix']; ?>
elm_<?php echo $this->_tpl_vars['field']['field_id']; ?>
" type="radio" id="<?php echo $this->_tpl_vars['id_prefix']; ?>
elm_<?php echo $this->_tpl_vars['field']['field_id']; ?>
_commercial" name="<?php echo $this->_tpl_vars['data_name']; ?>
[<?php echo $this->_tpl_vars['data_id']; ?>
]" value="commercial" <?php if ($this->_tpl_vars['value'] == 'commercial'): ?>checked="checked"<?php endif; ?> <?php if (! $this->_tpl_vars['skip_field']): ?><?php echo $this->_tpl_vars['disabled_param']; ?>
<?php endif; ?> /><span class="radio"><?php echo fn_get_lang_var('address_commercial', $this->getLanguage()); ?>
</span>

	<?php else: ?>  		<input type="text" id="<?php echo $this->_tpl_vars['id_prefix']; ?>
elm_<?php echo $this->_tpl_vars['field']['field_id']; ?>
" name="<?php echo $this->_tpl_vars['data_name']; ?>
[<?php echo $this->_tpl_vars['data_id']; ?>
]" size="32" value="<?php echo $this->_tpl_vars['value']; ?>
" class="input-text <?php if (! $this->_tpl_vars['skip_field']): ?><?php echo $this->_tpl_vars['_class']; ?>
<?php else: ?>cm-skip-avail-switch<?php endif; ?>" <?php if (! $this->_tpl_vars['skip_field']): ?><?php echo $this->_tpl_vars['disabled_param']; ?>
<?php endif; ?> />
	<?php endif; ?>

	<?php $this->assign('pref_field_name', $this->_tpl_vars['field']['description'], false); ?>
</div>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
<?php endforeach; endif; unset($_from); ?>

<?php if ($this->_tpl_vars['body_id'] || $this->_tpl_vars['grid_wrap']): ?>
		</div>
	</div>
<?php endif; ?>
</div>

<?php endif; ?>
<?php endif; ?>