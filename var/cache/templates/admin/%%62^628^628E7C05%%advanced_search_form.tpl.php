<?php /* Smarty version 2.6.18, created on 2013-09-21 13:03:30
         compiled from views/products/components/advanced_search_form.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'split', 'views/products/components/advanced_search_form.tpl', 15, false),array('function', 'math', 'views/products/components/advanced_search_form.tpl', 84, false),array('modifier', 'default', 'views/products/components/advanced_search_form.tpl', 20, false),array('modifier', 'sizeof', 'views/products/components/advanced_search_form.tpl', 23, false),array('modifier', 'in_array', 'views/products/components/advanced_search_form.tpl', 30, false),array('modifier', 'fn_text_placeholders', 'views/products/components/advanced_search_form.tpl', 47, false),array('modifier', 'fn_parse_date', 'views/products/components/advanced_search_form.tpl', 68, false),array('modifier', 'date_format', 'views/products/components/advanced_search_form.tpl', 68, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('none','your_range','calendar','calendar','weekday_abr_0','weekday_abr_1','weekday_abr_2','weekday_abr_3','weekday_abr_4','weekday_abr_5','weekday_abr_6','month_name_abr_1','month_name_abr_2','month_name_abr_3','month_name_abr_4','month_name_abr_5','month_name_abr_6','month_name_abr_7','month_name_abr_8','month_name_abr_9','month_name_abr_10','month_name_abr_11','month_name_abr_12','calendar','calendar','weekday_abr_0','weekday_abr_1','weekday_abr_2','weekday_abr_3','weekday_abr_4','weekday_abr_5','weekday_abr_6','month_name_abr_1','month_name_abr_2','month_name_abr_3','month_name_abr_4','month_name_abr_5','month_name_abr_6','month_name_abr_7','month_name_abr_8','month_name_abr_9','month_name_abr_10','month_name_abr_11','month_name_abr_12','none','yes','no','any'));
?>
<?php  ob_start();  ?><?php 

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
			 ?><?php echo smarty_function_split(array('data' => $this->_tpl_vars['filter_features'],'size' => '3','assign' => 'splitted_filter','preverse_keys' => true), $this);?>

<table width="100%" cellpadding="0" cellspacing="0" border="0" class="table-filters">
<?php $_from = $this->_tpl_vars['splitted_filter']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['filters_row'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['filters_row']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['filters_row']):
        $this->_foreach['filters_row']['iteration']++;
?>
<tr>
<?php $_from = $this->_tpl_vars['filters_row']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['filter']):
?>
	<th><?php echo smarty_modifier_default(@$this->_tpl_vars['filter']['filter'], @$this->_tpl_vars['filter']['description']); ?>
</th>
<?php endforeach; endif; unset($_from); ?>
</tr>
<tr valign="top"<?php if (( sizeof($this->_tpl_vars['splitted_filter']) > 1 ) && ($this->_foreach['filters_row']['iteration'] <= 1)): ?> class="delim"<?php endif; ?>>
<?php $_from = $this->_tpl_vars['filters_row']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['filter']):
?>
	<td width="33%">
		<?php if ($this->_tpl_vars['filter']['feature_type'] == 'S' || $this->_tpl_vars['filter']['feature_type'] == 'E' || $this->_tpl_vars['filter']['feature_type'] == 'M' || $this->_tpl_vars['filter']['feature_type'] == 'N' && ! $this->_tpl_vars['filter']['filter_id']): ?>
			<div class="scroll-y">
				<?php $this->assign('filter_ranges', smarty_modifier_default(@$this->_tpl_vars['filter']['ranges'], @$this->_tpl_vars['filter']['variants']), false); ?>
				<?php $_from = $this->_tpl_vars['filter_ranges']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['range_id'] => $this->_tpl_vars['range']):
?>
					<div class="select-field"><input type="checkbox" class="checkbox" name="<?php if ($this->_tpl_vars['filter']['feature_type'] == 'M'): ?>multiple_<?php endif; ?>variants[]" id="<?php echo $this->_tpl_vars['prefix']; ?>
variants_<?php echo $this->_tpl_vars['range_id']; ?>
" value="<?php if ($this->_tpl_vars['filter']['feature_type'] == 'M'): ?><?php echo $this->_tpl_vars['range_id']; ?>
<?php else: ?>[V<?php echo $this->_tpl_vars['range_id']; ?>
]<?php endif; ?>" <?php if (smarty_modifier_in_array("[V".($this->_tpl_vars['range_id'])."]", $this->_tpl_vars['search']['variants']) || smarty_modifier_in_array($this->_tpl_vars['range_id'], $this->_tpl_vars['search']['multiple_variants'])): ?>checked="checked"<?php endif; ?> /><label for="variants_<?php echo $this->_tpl_vars['range_id']; ?>
"><?php echo $this->_tpl_vars['filter']['prefix']; ?>
<?php echo $this->_tpl_vars['range']['variant']; ?>
<?php echo $this->_tpl_vars['filter']['suffix']; ?>
</label></div>
				<?php endforeach; endif; unset($_from); ?>
			</div>
		<?php elseif ($this->_tpl_vars['filter']['feature_type'] == 'O' || $this->_tpl_vars['filter']['feature_type'] == 'N' && $this->_tpl_vars['filter']['filter_id'] || $this->_tpl_vars['filter']['feature_type'] == 'D' || $this->_tpl_vars['filter']['condition_type'] == 'D' || $this->_tpl_vars['filter']['condition_type'] == 'F'): ?>
			<?php if (! $this->_tpl_vars['filter']['slider']): ?><div class="scroll-y"><?php endif; ?>
				<?php if ($this->_tpl_vars['filter']['condition_type']): ?>
					<?php $this->assign('el_id', "field_".($this->_tpl_vars['filter']['filter_id']), false); ?>
				<?php else: ?>
					<?php $this->assign('el_id', "feature_".($this->_tpl_vars['filter']['feature_id']), false); ?>
				<?php endif; ?>

				<div class="select-field"><input type="radio" name="variants[<?php echo $this->_tpl_vars['el_id']; ?>
]" id="<?php echo $this->_tpl_vars['prefix']; ?>
no_ranges_<?php echo $this->_tpl_vars['el_id']; ?>
" value="" checked="checked" class="radio" /><label for="<?php echo $this->_tpl_vars['prefix']; ?>
no_ranges_<?php echo $this->_tpl_vars['el_id']; ?>
"><?php echo fn_get_lang_var('none', $this->getLanguage()); ?>
</label></div>
				<?php $this->assign('filter_ranges', smarty_modifier_default(@$this->_tpl_vars['filter']['ranges'], @$this->_tpl_vars['filter']['variants']), false); ?>
				<?php $this->assign('_type', smarty_modifier_default(@$this->_tpl_vars['filter']['field_type'], 'R'), false); ?>
				<?php if (! $this->_tpl_vars['filter']['slider']): ?>
					<?php $_from = $this->_tpl_vars['filter_ranges']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['range_id'] => $this->_tpl_vars['range']):
?>
						<?php $this->assign('range_name', smarty_modifier_default(@$this->_tpl_vars['range']['range_name'], @$this->_tpl_vars['range']['variant']), false); ?>
						<div class="select-field"><input type="radio" class="radio" name="variants[<?php echo $this->_tpl_vars['el_id']; ?>
]" id="<?php echo $this->_tpl_vars['prefix']; ?>
ranges_<?php echo $this->_tpl_vars['el_id']; ?>
<?php echo $this->_tpl_vars['range_id']; ?>
" value="<?php echo $this->_tpl_vars['_type']; ?>
<?php echo $this->_tpl_vars['range_id']; ?>
" <?php if ($this->_tpl_vars['search']['variants'][$this->_tpl_vars['el_id']] == ($this->_tpl_vars['_type']).($this->_tpl_vars['range_id'])): ?>checked="checked"<?php endif; ?> /><label for="<?php echo $this->_tpl_vars['prefix']; ?>
ranges_<?php echo $this->_tpl_vars['el_id']; ?>
<?php echo $this->_tpl_vars['range_id']; ?>
"><?php echo fn_text_placeholders($this->_tpl_vars['range_name']); ?>
</label></div>
					<?php endforeach; endif; unset($_from); ?>
				<?php endif; ?>
			<?php if (! $this->_tpl_vars['filter']['slider']): ?></div><?php endif; ?>
			
			<?php if ($this->_tpl_vars['filter']['condition_type'] != 'F'): ?>
			<p><input type="radio" name="variants[<?php echo $this->_tpl_vars['el_id']; ?>
]" id="<?php echo $this->_tpl_vars['prefix']; ?>
select_custom_<?php echo $this->_tpl_vars['el_id']; ?>
" value="O" <?php if ($this->_tpl_vars['search']['variants'][$this->_tpl_vars['el_id']] == 'O'): ?>checked="checked"<?php endif; ?> class="radio" /><label for="<?php echo $this->_tpl_vars['prefix']; ?>
select_custom_<?php echo $this->_tpl_vars['el_id']; ?>
"><?php echo fn_get_lang_var('your_range', $this->getLanguage()); ?>
</label></p>
			
			<div class="select-field">
				<?php if ($this->_tpl_vars['filter']['feature_type'] == 'D'): ?>
					<?php if ($this->_tpl_vars['search']['custom_range'][$this->_tpl_vars['filter']['feature_id']]['from'] || $this->_tpl_vars['search']['custom_range'][$this->_tpl_vars['filter']['feature_id']]['to']): ?>
						<?php $this->assign('date_extra', "", false); ?>
					<?php else: ?>
						<?php $this->assign('date_extra', "disabled=\"disabled\"", false); ?>
					<?php endif; ?>
					<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('date_id' => ($this->_tpl_vars['prefix'])."range_".($this->_tpl_vars['el_id'])."_from", 'date_name' => "custom_range[".($this->_tpl_vars['filter']['feature_id'])."][from]", 'date_val' => $this->_tpl_vars['search']['custom_range'][$this->_tpl_vars['filter']['feature_id']]['from'], 'extra' => $this->_tpl_vars['date_extra'], 'start_year' => $this->_tpl_vars['settings']['Company']['company_start_year'], )); ?><?php if ($this->_tpl_vars['settings']['Appearance']['calendar_date_format'] == 'month_first'): ?>
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
					<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('date_id' => ($this->_tpl_vars['prefix'])."range_".($this->_tpl_vars['el_id'])."_to", 'date_name' => "custom_range[".($this->_tpl_vars['filter']['feature_id'])."][to]", 'date_val' => $this->_tpl_vars['search']['custom_range'][$this->_tpl_vars['filter']['feature_id']]['to'], 'extra' => $this->_tpl_vars['date_extra'], 'start_year' => $this->_tpl_vars['settings']['Company']['company_start_year'], )); ?><?php if ($this->_tpl_vars['settings']['Appearance']['calendar_date_format'] == 'month_first'): ?>
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
					<input type="hidden" name="custom_range[<?php echo $this->_tpl_vars['filter']['feature_id']; ?>
][type]" value="D" />
				<?php else: ?>
					<?php if (! $this->_tpl_vars['filter']['slider']): ?>
						<?php $this->assign('from_value', smarty_modifier_default(@$this->_tpl_vars['search']['custom_range'][$this->_tpl_vars['filter']['feature_id']]['from'], @$this->_tpl_vars['search']['field_range'][$this->_tpl_vars['filter']['field_type']]['from']), false); ?>
						<?php $this->assign('to_value', smarty_modifier_default(@$this->_tpl_vars['search']['custom_range'][$this->_tpl_vars['filter']['feature_id']]['to'], @$this->_tpl_vars['search']['field_range'][$this->_tpl_vars['filter']['field_type']]['to']), false); ?>
					<?php else: ?>
						<?php $this->assign('from_value', smarty_modifier_default(@$this->_tpl_vars['search']['field_range'][$this->_tpl_vars['filter']['field_type']]['from'], @$this->_tpl_vars['filter']['range_values']['min']), false); ?>
						<?php $this->assign('to_value', smarty_modifier_default(@$this->_tpl_vars['search']['field_range'][$this->_tpl_vars['filter']['field_type']]['to'], @$this->_tpl_vars['filter']['range_values']['max']), false); ?>
					<?php endif; ?>

					<input type="text" name="<?php if ($this->_tpl_vars['filter']['field_type']): ?>field_range[<?php echo $this->_tpl_vars['filter']['field_type']; ?>
]<?php else: ?>custom_range[<?php echo $this->_tpl_vars['filter']['feature_id']; ?>
]<?php endif; ?>[from]" id="<?php echo $this->_tpl_vars['prefix']; ?>
range_<?php echo $this->_tpl_vars['el_id']; ?>
_from" size="3" class="input-text-short" value="<?php echo $this->_tpl_vars['from_value']; ?>
" <?php if ($this->_tpl_vars['search']['variants'][$this->_tpl_vars['el_id']] != 'O'): ?>disabled="disabled"<?php endif; ?> />
					&nbsp;-&nbsp;
					<input type="text" name="<?php if ($this->_tpl_vars['filter']['field_type']): ?>field_range[<?php echo $this->_tpl_vars['filter']['field_type']; ?>
]<?php else: ?>custom_range[<?php echo $this->_tpl_vars['filter']['feature_id']; ?>
]<?php endif; ?>[to]" size="3" class="input-text-short" value="<?php echo $this->_tpl_vars['to_value']; ?>
" id="<?php echo $this->_tpl_vars['prefix']; ?>
range_<?php echo $this->_tpl_vars['el_id']; ?>
_to" <?php if ($this->_tpl_vars['search']['variants'][$this->_tpl_vars['el_id']] != 'O'): ?>disabled="disabled"<?php endif; ?> />
				<?php endif; ?>
			</div>
			<?php endif; ?>
			<script type="text/javascript">
			//<![CDATA[
			$(function() {
				$(":radio[name='variants[<?php echo $this->_tpl_vars['el_id']; ?>
]']").change(function() {
					var el_id = '<?php echo $this->_tpl_vars['el_id']; ?>
';
					$('#<?php echo $this->_tpl_vars['prefix']; ?>
range_' + el_id + '_from').attr('disabled', this.value !== 'O');
					$('#<?php echo $this->_tpl_vars['prefix']; ?>
range_' + el_id + '_to').attr('disabled', this.value !== 'O');
					<?php if ($this->_tpl_vars['filter']['feature_type'] == 'D'): ?>
					$('#<?php echo $this->_tpl_vars['prefix']; ?>
range_' + el_id + '_from_but').attr('disabled', this.value !== 'O');
					$('#<?php echo $this->_tpl_vars['prefix']; ?>
range_' + el_id + '_to_but').attr('disabled', this.value !== 'O');
					<?php endif; ?>
				});
			});
			//]]>
			</script>
		<?php elseif ($this->_tpl_vars['filter']['feature_type'] == 'C' || $this->_tpl_vars['filter']['condition_type'] == 'C'): ?>
			<?php if ($this->_tpl_vars['filter']['condition_type']): ?>
				<?php $this->assign('el_id', $this->_tpl_vars['filter']['field_type'], false); ?>
			<?php else: ?>
				<?php $this->assign('el_id', $this->_tpl_vars['filter']['feature_id'], false); ?>
			<?php endif; ?>
			<div class="select-field">
				<input type="radio" class="radio" name="ch_filters[<?php echo $this->_tpl_vars['el_id']; ?>
]" id="<?php echo $this->_tpl_vars['prefix']; ?>
ranges_<?php echo $this->_tpl_vars['el_id']; ?>
_none" value="" <?php if (! $this->_tpl_vars['search']['ch_filters'][$this->_tpl_vars['el_id']]): ?>checked="checked"<?php endif; ?> />
				<label for="<?php echo $this->_tpl_vars['prefix']; ?>
ranges_<?php echo $this->_tpl_vars['el_id']; ?>
_none"><?php echo fn_get_lang_var('none', $this->getLanguage()); ?>
</label>
			</div>
			
			<div class="select-field">
				<input type="radio" class="radio" name="ch_filters[<?php echo $this->_tpl_vars['el_id']; ?>
]" id="<?php echo $this->_tpl_vars['prefix']; ?>
ranges_<?php echo $this->_tpl_vars['el_id']; ?>
_yes" value="Y" <?php if ($this->_tpl_vars['search']['ch_filters'][$this->_tpl_vars['el_id']] == 'Y'): ?>checked="checked"<?php endif; ?> />
				<label for="<?php echo $this->_tpl_vars['prefix']; ?>
ranges_<?php echo $this->_tpl_vars['el_id']; ?>
_yes"><?php echo fn_get_lang_var('yes', $this->getLanguage()); ?>
</label>
			</div>
			
			<div class="select-field">
				<input type="radio" class="radio" name="ch_filters[<?php echo $this->_tpl_vars['el_id']; ?>
]" id="<?php echo $this->_tpl_vars['prefix']; ?>
ranges_<?php echo $this->_tpl_vars['el_id']; ?>
_no" value="N" <?php if ($this->_tpl_vars['search']['ch_filters'][$this->_tpl_vars['el_id']] == 'N'): ?>checked="checked"<?php endif; ?> />
				<label for="<?php echo $this->_tpl_vars['prefix']; ?>
ranges_<?php echo $this->_tpl_vars['el_id']; ?>
_no"><?php echo fn_get_lang_var('no', $this->getLanguage()); ?>
</label>
			</div>
			
			<?php if (! $this->_tpl_vars['filter']['condition_type']): ?>
			<div class="select-field">
				<input type="radio" class="radio" name="ch_filters[<?php echo $this->_tpl_vars['el_id']; ?>
]" id="<?php echo $this->_tpl_vars['prefix']; ?>
ranges_<?php echo $this->_tpl_vars['el_id']; ?>
_any" value="A" <?php if ($this->_tpl_vars['search']['ch_filters'][$this->_tpl_vars['el_id']] == 'A'): ?>checked="checked"<?php endif; ?> />
				<label for="<?php echo $this->_tpl_vars['prefix']; ?>
ranges_<?php echo $this->_tpl_vars['el_id']; ?>
_any"><?php echo fn_get_lang_var('any', $this->getLanguage()); ?>
</label>
			</div>
			<?php endif; ?>
			
		<?php elseif ($this->_tpl_vars['filter']['feature_type'] == 'T'): ?>
			<div class="select-field nowrap">
				<?php echo $this->_tpl_vars['filter']['prefix']; ?>
<input type="text" name="tx_features[<?php echo $this->_tpl_vars['filter']['feature_id']; ?>
]" class="input-text" value="<?php echo $this->_tpl_vars['search']['tx_features'][$this->_tpl_vars['filter']['feature_id']]; ?>
" /><?php echo $this->_tpl_vars['filter']['suffix']; ?>

			</div>
		<?php endif; ?>
	</td>
<?php endforeach; endif; unset($_from); ?>
</tr>
<?php endforeach; endif; unset($_from); ?>
</table><?php  ob_end_flush();  ?>