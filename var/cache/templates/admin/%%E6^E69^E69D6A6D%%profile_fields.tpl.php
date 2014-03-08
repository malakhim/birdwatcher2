<?php /* Smarty version 2.6.18, created on 2014-03-08 11:46:48
         compiled from views/profiles/components/profile_fields.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'fn_url', 'views/profiles/components/profile_fields.tpl', 50, false),array('modifier', 'default', 'views/profiles/components/profile_fields.tpl', 90, false),array('modifier', 'fn_parse_date', 'views/profiles/components/profile_fields.tpl', 124, false),array('modifier', 'date_format', 'views/profiles/components/profile_fields.tpl', 124, false),array('block', 'hook', 'views/profiles/components/profile_fields.tpl', 102, false),array('function', 'math', 'views/profiles/components/profile_fields.tpl', 140, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('text_ship_to_billing','ship_to_another','text_ship_to_billing','select_profile','delete','select_state','select_country','calendar','calendar','weekday_abr_0','weekday_abr_1','weekday_abr_2','weekday_abr_3','weekday_abr_4','weekday_abr_5','weekday_abr_6','month_name_abr_1','month_name_abr_2','month_name_abr_3','month_name_abr_4','month_name_abr_5','month_name_abr_6','month_name_abr_7','month_name_abr_8','month_name_abr_9','month_name_abr_10','month_name_abr_11','month_name_abr_12','address_residential','address_commercial'));
?>
<?php 

				$rname = !empty($resource_name) ? $resource_name : $params['smarty_include_tpl_file'];
				if ($this->compile_check && empty($inline_no_check[$rname]) && $this->is_cached($rname)) {
					if ($this->check_inline_blocks(array (
  'common_templates/calendar.tpl' => 1367063753,
))) {
						$_smarty_compile_path = $this->_get_compile_path($rname);
						$this->_compile_resource($rname, $_smarty_compile_path);
						$inline_no_check[$rname] = true;
						include $_smarty_compile_path;
						return;
					}
				}
			 ?><?php if ($this->_tpl_vars['profile_fields'][$this->_tpl_vars['section']]): ?>

<?php if (! $this->_tpl_vars['nothing_extra']): ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/subheader.tpl", 'smarty_include_vars' => array('title' => $this->_tpl_vars['title'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php endif; ?>

<?php if ($this->_tpl_vars['shipping_flag']): ?>
<div class="select-field">
	<input class="checkbox hidden" id="elm_ship_to_another" type="checkbox" name="ship_to_another" value="Y" <?php if ($this->_tpl_vars['ship_to_another']): ?>checked="checked"<?php endif; ?> />

	<p <?php if ($this->_tpl_vars['ship_to_another']): ?>class="hidden"<?php endif; ?> id="on_sta_notice">
		<?php echo fn_get_lang_var('text_ship_to_billing', $this->getLanguage()); ?>
.&nbsp;<a class="cm-combination dashed cm-hide-with-inputs" onclick="$('#sa').switchAvailability(false); $('#elm_ship_to_another').click(); $.profiles.rebuild_states('shipping');"><?php echo fn_get_lang_var('ship_to_another', $this->getLanguage()); ?>
</a>
	</p>
	<p <?php if (! $this->_tpl_vars['ship_to_another']): ?>class="hidden"<?php endif; ?> id="off_sta_notice">
		<a class="cm-combination dashed cm-hide-with-inputs" onclick="$('#sa').switchAvailability(true); $('#elm_ship_to_another').click();"><?php echo fn_get_lang_var('text_ship_to_billing', $this->getLanguage()); ?>
</a>
	</p>
</div>
<?php elseif ($this->_tpl_vars['section'] == 'S'): ?>
	<?php $this->assign('ship_to_another', true, false); ?>
	<input type="hidden" name="ship_to_another" value="Y" />
<?php endif; ?>

<?php if ($this->_tpl_vars['body_id']): ?>
	<div id="<?php echo $this->_tpl_vars['body_id']; ?>
" <?php if (! $this->_tpl_vars['ship_to_another']): ?>class="hidden"<?php endif; ?>>
<?php endif; ?>

<?php if ($this->_tpl_vars['section'] == 'S' && ! $this->_tpl_vars['ship_to_another']): ?>
	<?php $this->assign('disabled_param', "disabled=\"disabled\"", false); ?>
<?php else: ?>
	<?php $this->assign('disabled_param', "", false); ?>
<?php endif; ?>

<?php if ($this->_tpl_vars['location'] == 'checkout' && $this->_tpl_vars['auth']['user_id'] && $this->_tpl_vars['settings']['General']['user_multiple_profiles'] == 'Y' && ( $this->_tpl_vars['section'] == 'B' || $this->_tpl_vars['section'] == 'S' )): ?> <div class="form-field">
	<label for="elm_profile_id"><?php echo fn_get_lang_var('select_profile', $this->getLanguage()); ?>
:</label>
	<select name="profile_id" id="elm_profile_id" onchange="$.ajaxRequest('<?php echo fn_url("checkout.checkout", 'C', 'rel', '&'); ?>
', <?php echo $this->_tpl_vars['ldelim']; ?>
result_ids: 'checkout_steps, cart_items, checkout_totals', 'user_data[profile_id]': this.value, 'update_step': '<?php echo $this->_tpl_vars['update_step']; ?>
', 'edit_steps[]': '<?php echo $this->_tpl_vars['update_step']; ?>
', 'ship_to_another': '<?php echo $this->_tpl_vars['cart']['ship_to_another']; ?>
'<?php echo $this->_tpl_vars['rdelim']; ?>
);" class="select-expanded">
		<?php $_from = $this->_tpl_vars['user_profiles']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['user_profile']):
?>
		<option value="<?php echo $this->_tpl_vars['user_profile']['profile_id']; ?>
" <?php if ($this->_tpl_vars['cart']['profile_id'] == $this->_tpl_vars['user_profile']['profile_id']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['user_profile']['profile_name']; ?>
</option>
	<?php endforeach; endif; unset($_from); ?>
	</select>
	<?php if ($this->_tpl_vars['cart']['user_data']['profile_id'] && $this->_tpl_vars['cart']['user_data']['profile_type'] != 'P'): ?>
		<a <?php if ($this->_tpl_vars['use_ajax']): ?>class="cm-ajax"<?php endif; ?> href="<?php echo fn_url("profiles.delete_profile?profile_id=".($this->_tpl_vars['cart']['profile_id'])); ?>
" rev="checkout_steps,cart_items,checkout_totals"><?php echo fn_get_lang_var('delete', $this->getLanguage()); ?>
</a>
	<?php endif; ?>
</div>
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

<div class="form-field">
	<label for="<?php echo $this->_tpl_vars['id_prefix']; ?>
elm_<?php echo $this->_tpl_vars['field']['field_id']; ?>
" class="cm-profile-field <?php if ($this->_tpl_vars['field']['required'] == 'Y'): ?>cm-required<?php endif; ?><?php if ($this->_tpl_vars['field']['field_type'] == 'P'): ?> cm-phone<?php endif; ?><?php if ($this->_tpl_vars['field']['field_type'] == 'Z'): ?> cm-zipcode<?php endif; ?><?php if ($this->_tpl_vars['field']['field_type'] == 'E'): ?> cm-email<?php endif; ?><?php if ($this->_tpl_vars['field']['field_type'] == 'A'): ?> cm-state<?php endif; ?><?php if ($this->_tpl_vars['field']['field_type'] == 'O'): ?> cm-country<?php endif; ?> <?php if ($this->_tpl_vars['field']['field_type'] == 'O' || $this->_tpl_vars['field']['field_type'] == 'A' || $this->_tpl_vars['field']['field_type'] == 'Z'): ?><?php if ($this->_tpl_vars['section'] == 'S'): ?>cm-location-shipping<?php else: ?>cm-location-billing<?php endif; ?><?php endif; ?>"><?php echo $this->_tpl_vars['field']['description']; ?>
:</label>

	<?php if ($this->_tpl_vars['field']['field_type'] == 'L'): ?> 		<select id="<?php echo $this->_tpl_vars['id_prefix']; ?>
elm_<?php echo $this->_tpl_vars['field']['field_id']; ?>
" name="<?php echo $this->_tpl_vars['data_name']; ?>
[<?php echo $this->_tpl_vars['data_id']; ?>
]" <?php echo $this->_tpl_vars['disabled_param']; ?>
>
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
" name="<?php echo $this->_tpl_vars['data_name']; ?>
[<?php echo $this->_tpl_vars['data_id']; ?>
]" <?php echo $this->_tpl_vars['disabled_param']; ?>
>
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
" disabled="disabled" class="input-text hidden cm-skip-avail-switch" />
		<input type="hidden" id="elm_<?php echo $this->_tpl_vars['field']['field_id']; ?>
_default" value="<?php echo $this->_tpl_vars['state_code']; ?>
" />
	
	<?php elseif ($this->_tpl_vars['field']['field_type'] == 'O'): ?>  		<?php $this->assign('_country', smarty_modifier_default(@$this->_tpl_vars['value'], @$this->_tpl_vars['settings']['General']['default_country']), false); ?>
		<select id="<?php echo $this->_tpl_vars['id_prefix']; ?>
elm_<?php echo $this->_tpl_vars['field']['field_id']; ?>
" class="<?php if ($this->_tpl_vars['section'] == 'S'): ?>cm-location-shipping<?php else: ?>cm-location-billing<?php endif; ?>" name="<?php echo $this->_tpl_vars['data_name']; ?>
[<?php echo $this->_tpl_vars['data_id']; ?>
]" <?php echo $this->_tpl_vars['disabled_param']; ?>
>
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
]" value="N" <?php echo $this->_tpl_vars['disabled_param']; ?>
 />
		<input type="checkbox" id="<?php echo $this->_tpl_vars['id_prefix']; ?>
elm_<?php echo $this->_tpl_vars['field']['field_id']; ?>
" name="<?php echo $this->_tpl_vars['data_name']; ?>
[<?php echo $this->_tpl_vars['data_id']; ?>
]" value="Y" <?php if ($this->_tpl_vars['value'] == 'Y'): ?>checked="checked"<?php endif; ?> class="checkbox" <?php echo $this->_tpl_vars['disabled_param']; ?>
 />

	<?php elseif ($this->_tpl_vars['field']['field_type'] == 'T'): ?>  		<textarea class="input-textarea" id="<?php echo $this->_tpl_vars['id_prefix']; ?>
elm_<?php echo $this->_tpl_vars['field']['field_id']; ?>
" name="<?php echo $this->_tpl_vars['data_name']; ?>
[<?php echo $this->_tpl_vars['data_id']; ?>
]" cols="32" rows="3" <?php echo $this->_tpl_vars['disabled_param']; ?>
><?php echo $this->_tpl_vars['value']; ?>
</textarea>
	
	<?php elseif ($this->_tpl_vars['field']['field_type'] == 'D'): ?>  		<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('date_id' => "elm_".($this->_tpl_vars['field']['field_id']), 'date_name' => ($this->_tpl_vars['data_name'])."[".($this->_tpl_vars['data_id'])."]", 'date_val' => $this->_tpl_vars['value'], 'start_year' => '1902', 'end_year' => '0', 'extra' => $this->_tpl_vars['disabled_param'], )); ?><?php if ($this->_tpl_vars['settings']['Appearance']['calendar_date_format'] == 'month_first'): ?>
	<?php $this->assign('date_format', "%m/%d/%Y", false); ?>
<?php else: ?>
	<?php $this->assign('date_format', "%d/%m/%Y", false); ?>
<?php endif; ?>

<input type="text" id="<?php echo $this->_tpl_vars['date_id']; ?>
" name="<?php echo $this->_tpl_vars['date_name']; ?>
" class="input-text<?php if ($this->_tpl_vars['date_meta']): ?> <?php echo $this->_tpl_vars['date_meta']; ?>
<?php endif; ?> cm-calendar" value="<?php if ($this->_tpl_vars['date_val']): ?><?php echo smarty_modifier_date_format(fn_parse_date($this->_tpl_vars['date_val']), ($this->_tpl_vars['date_format'])); ?>
<?php endif; ?>" <?php echo $this->_tpl_vars['extra']; ?>
 size="10" />&nbsp;<img src="<?php echo $this->_tpl_vars['images_dir']; ?>
/icons/calendar.png" class="cm-external-focus calendar-but" rev="<?php echo $this->_tpl_vars['date_id']; ?>
" title="<?php echo fn_get_lang_var('calendar', $this->getLanguage()); ?>
" alt="<?php echo fn_get_lang_var('calendar', $this->getLanguage()); ?>
" />

<script type="text/javascript">
//<![CDATA[

var calendar_config = <?php echo $this->_tpl_vars['ldelim']; ?>
<?php echo $this->_tpl_vars['rdelim']; ?>
;
calendar_config = <?php echo $this->_tpl_vars['ldelim']; ?>

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
').datepicker(calendar_config);
	<?php echo $this->_tpl_vars['rdelim']; ?>
);
<?php echo $this->_tpl_vars['rdelim']; ?>
 else <?php echo $this->_tpl_vars['ldelim']; ?>

	$(function() <?php echo $this->_tpl_vars['ldelim']; ?>

		$('#<?php echo $this->_tpl_vars['date_id']; ?>
').datepicker(calendar_config);
	<?php echo $this->_tpl_vars['rdelim']; ?>
);
<?php echo $this->_tpl_vars['rdelim']; ?>



//]]>
</script><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>

	<?php elseif ($this->_tpl_vars['field']['field_type'] == 'S'): ?>  		<select id="<?php echo $this->_tpl_vars['id_prefix']; ?>
elm_<?php echo $this->_tpl_vars['field']['field_id']; ?>
" name="<?php echo $this->_tpl_vars['data_name']; ?>
[<?php echo $this->_tpl_vars['data_id']; ?>
]" <?php echo $this->_tpl_vars['disabled_param']; ?>
>
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
	
	<?php elseif ($this->_tpl_vars['field']['field_type'] == 'R'): ?>  		<div class="select-field">
		<?php $_from = $this->_tpl_vars['field']['values']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['rfe'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['rfe']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
        $this->_foreach['rfe']['iteration']++;
?>
		<input class="radio" type="radio" id="<?php echo $this->_tpl_vars['id_prefix']; ?>
elm_<?php echo $this->_tpl_vars['field']['field_id']; ?>
_<?php echo $this->_tpl_vars['k']; ?>
" name="<?php echo $this->_tpl_vars['data_name']; ?>
[<?php echo $this->_tpl_vars['data_id']; ?>
]" value="<?php echo $this->_tpl_vars['k']; ?>
" <?php if (( ! $this->_tpl_vars['value'] && ($this->_foreach['rfe']['iteration'] <= 1) ) || $this->_tpl_vars['value'] == $this->_tpl_vars['k']): ?>checked="checked"<?php endif; ?> <?php echo $this->_tpl_vars['disabled_param']; ?>
 /><label for="<?php echo $this->_tpl_vars['id_prefix']; ?>
elm_<?php echo $this->_tpl_vars['field']['field_id']; ?>
_<?php echo $this->_tpl_vars['k']; ?>
"><?php echo $this->_tpl_vars['v']; ?>
</label>
		<?php endforeach; endif; unset($_from); ?>
		</div>

	<?php elseif ($this->_tpl_vars['field']['field_type'] == 'N'): ?>  		<input class="radio valign <?php if (! $this->_tpl_vars['skip_field']): ?><?php echo $this->_tpl_vars['_class']; ?>
<?php else: ?>cm-skip-avail-switch<?php endif; ?>" type="radio" id="<?php echo $this->_tpl_vars['id_prefix']; ?>
elm_<?php echo $this->_tpl_vars['field']['field_id']; ?>
_residential" name="<?php echo $this->_tpl_vars['data_name']; ?>
[<?php echo $this->_tpl_vars['data_id']; ?>
]" value="residential" <?php if (! $this->_tpl_vars['value'] || $this->_tpl_vars['value'] == 'residential'): ?>checked="checked"<?php endif; ?> <?php if (! $this->_tpl_vars['skip_field']): ?><?php echo $this->_tpl_vars['disabled_param']; ?>
<?php endif; ?> /><span class="radio"><?php echo fn_get_lang_var('address_residential', $this->getLanguage()); ?>
</span>
		<input class="radio valign <?php if (! $this->_tpl_vars['skip_field']): ?><?php echo $this->_tpl_vars['_class']; ?>
<?php else: ?>cm-skip-avail-switch<?php endif; ?>" type="radio" id="<?php echo $this->_tpl_vars['id_prefix']; ?>
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
" class="input-text" <?php echo $this->_tpl_vars['disabled_param']; ?>
 />
	<?php endif; ?>
</div>
<?php endforeach; endif; unset($_from); ?>
<?php if ($this->_tpl_vars['body_id']): ?>
</div>
<?php endif; ?>

<?php endif; ?>