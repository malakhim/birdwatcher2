<?php /* Smarty version 2.6.18, created on 2013-06-14 13:39:28
         compiled from views/products/components/product_filters_advanced_form.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'split', 'views/products/components/product_filters_advanced_form.tpl', 17, false),array('function', 'math', 'views/products/components/product_filters_advanced_form.tpl', 98, false),array('modifier', 'default', 'views/products/components/product_filters_advanced_form.tpl', 34, false),array('modifier', 'sizeof', 'views/products/components/product_filters_advanced_form.tpl', 37, false),array('modifier', 'in_array', 'views/products/components/product_filters_advanced_form.tpl', 43, false),array('modifier', 'fn_text_placeholders', 'views/products/components/product_filters_advanced_form.tpl', 59, false),array('modifier', 'date_format', 'views/products/components/product_filters_advanced_form.tpl', 82, false),array('modifier', 'fn_url', 'views/products/components/product_filters_advanced_form.tpl', 252, false),array('modifier', 'replace', 'views/products/components/product_filters_advanced_form.tpl', 282, false),array('modifier', 'md5', 'views/products/components/product_filters_advanced_form.tpl', 308, false),array('modifier', 'string_format', 'views/products/components/product_filters_advanced_form.tpl', 308, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('none','your_range','calendar','calendar','weekday_abr_0','weekday_abr_1','weekday_abr_2','weekday_abr_3','weekday_abr_4','weekday_abr_5','weekday_abr_6','month_name_abr_1','month_name_abr_2','month_name_abr_3','month_name_abr_4','month_name_abr_5','month_name_abr_6','month_name_abr_7','month_name_abr_8','month_name_abr_9','month_name_abr_10','month_name_abr_11','month_name_abr_12','calendar','calendar','weekday_abr_0','weekday_abr_1','weekday_abr_2','weekday_abr_3','weekday_abr_4','weekday_abr_5','weekday_abr_6','month_name_abr_1','month_name_abr_2','month_name_abr_3','month_name_abr_4','month_name_abr_5','month_name_abr_6','month_name_abr_7','month_name_abr_8','month_name_abr_9','month_name_abr_10','month_name_abr_11','month_name_abr_12','none','yes','no','any','submit','delete','or','reset_filter','advanced_filter','open_action','hide','advanced_filter'));
?>
<?php 

				$rname = !empty($resource_name) ? $resource_name : $params['smarty_include_tpl_file'];
				if ($this->compile_check && empty($inline_no_check[$rname]) && $this->is_cached($rname)) {
					if ($this->check_inline_blocks(array (
  'common_templates/section.tpl' => 1367063745,
))) {
						$_smarty_compile_path = $this->_get_compile_path($rname);
						$this->_compile_resource($rname, $_smarty_compile_path);
						$inline_no_check[$rname] = true;
						include $_smarty_compile_path;
						return;
					}
				}
			 ?><?php if ($this->_tpl_vars['filter_features']): ?>

<?php echo smarty_function_split(array('data' => $this->_tpl_vars['filter_features'],'size' => '3','assign' => 'splitted_filter','preverse_keys' => true), $this);?>


<?php ob_start(); ?>
<input type="hidden" name="advanced_filter" value="Y" />
<?php if ($this->_tpl_vars['_REQUEST']['category_id']): ?>
<input type="hidden" name="category_id" value="<?php echo $this->_tpl_vars['_REQUEST']['category_id']; ?>
" />
<input type="hidden" name="subcats" value="Y" />
<?php endif; ?>

<?php if ($this->_tpl_vars['_REQUEST']['variant_id']): ?>
<input type="hidden" name="variant_id" value="<?php echo $this->_tpl_vars['_REQUEST']['variant_id']; ?>
" />
<?php endif; ?>

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
		<?php if ($this->_tpl_vars['filter']['feature_type'] == 'S' || $this->_tpl_vars['filter']['feature_type'] == 'E' || $this->_tpl_vars['filter']['feature_type'] == 'M'): ?>
		<div class="scroll-y">
			<?php $_from = $this->_tpl_vars['filter']['ranges']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['range']):
?>
				<div class="select-field"><input type="checkbox" class="checkbox" name="<?php if ($this->_tpl_vars['filter']['feature_type'] == 'M'): ?>multiple_<?php endif; ?>variants[]" id="variants_<?php echo $this->_tpl_vars['range']['range_id']; ?>
" value="<?php if ($this->_tpl_vars['filter']['feature_type'] == 'M'): ?><?php echo $this->_tpl_vars['range']['range_id']; ?>
<?php else: ?>[V<?php echo $this->_tpl_vars['range']['range_id']; ?>
]<?php endif; ?>" <?php if (smarty_modifier_in_array("[V".($this->_tpl_vars['range']['range_id'])."]", $this->_tpl_vars['search']['variants']) || smarty_modifier_in_array($this->_tpl_vars['range']['range_id'], $this->_tpl_vars['search']['multiple_variants'])): ?>checked="checked"<?php endif; ?> /><label for="variants_<?php echo $this->_tpl_vars['range']['range_id']; ?>
"><?php echo $this->_tpl_vars['filter']['prefix']; ?>
<?php echo $this->_tpl_vars['range']['range_name']; ?>
<?php echo $this->_tpl_vars['filter']['suffix']; ?>
</label></div>
			<?php endforeach; endif; unset($_from); ?>
		</div>
		<?php elseif ($this->_tpl_vars['filter']['feature_type'] == 'O' || $this->_tpl_vars['filter']['feature_type'] == 'N' || $this->_tpl_vars['filter']['feature_type'] == 'D' || $this->_tpl_vars['filter']['condition_type'] == 'D' || $this->_tpl_vars['filter']['condition_type'] == 'F'): ?>
			<?php if (! $this->_tpl_vars['filter']['slider']): ?>
			<div class="scroll-y">
			<?php endif; ?>
				<?php if ($this->_tpl_vars['filter']['condition_type']): ?>
					<?php $this->assign('el_id', "field_".($this->_tpl_vars['filter']['filter_id']), false); ?>
				<?php else: ?>
					<?php $this->assign('el_id', "feature_".($this->_tpl_vars['filter']['feature_id']), false); ?>
				<?php endif; ?>
				<p<?php if (! $this->_tpl_vars['filter']['slider']): ?> class="select-field"<?php endif; ?>><input type="radio" name="variants[<?php echo $this->_tpl_vars['el_id']; ?>
]" id="no_ranges_<?php echo $this->_tpl_vars['el_id']; ?>
" value="" checked="checked" class="radio" /><label for="no_ranges_<?php echo $this->_tpl_vars['el_id']; ?>
"><?php echo fn_get_lang_var('none', $this->getLanguage()); ?>
</label></p>
				<?php if (! $this->_tpl_vars['filter']['slider']): ?>
					<?php $_from = $this->_tpl_vars['filter']['ranges']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['range']):
?>
						<?php $this->assign('_type', smarty_modifier_default(@$this->_tpl_vars['filter']['field_type'], 'R'), false); ?>
						<div class="select-field"><input type="radio" class="radio" name="variants[<?php echo $this->_tpl_vars['el_id']; ?>
]" id="ranges_<?php echo $this->_tpl_vars['el_id']; ?>
<?php echo $this->_tpl_vars['range']['range_id']; ?>
" value="<?php echo $this->_tpl_vars['_type']; ?>
<?php echo $this->_tpl_vars['range']['range_id']; ?>
" <?php if ($this->_tpl_vars['search']['variants'][$this->_tpl_vars['el_id']] == ($this->_tpl_vars['_type']).($this->_tpl_vars['range']['range_id'])): ?>checked="checked"<?php endif; ?> /><label for="ranges_<?php echo $this->_tpl_vars['el_id']; ?>
<?php echo $this->_tpl_vars['range']['range_id']; ?>
"><?php echo fn_text_placeholders($this->_tpl_vars['range']['range_name']); ?>
</label></div>
					<?php endforeach; endif; unset($_from); ?>
				<?php endif; ?>
			<?php if (! $this->_tpl_vars['filter']['slider']): ?>
			</div>
			<?php endif; ?>
			
			<?php if ($this->_tpl_vars['filter']['condition_type'] != 'F'): ?>
			<p><input type="radio" name="variants[<?php echo $this->_tpl_vars['el_id']; ?>
]" id="select_custom_<?php echo $this->_tpl_vars['el_id']; ?>
" value="O" <?php if ($this->_tpl_vars['search']['variants'][$this->_tpl_vars['el_id']] == 'O'): ?>checked="checked"<?php endif; ?> class="radio" /><label for="select_custom_<?php echo $this->_tpl_vars['el_id']; ?>
"><?php echo fn_get_lang_var('your_range', $this->getLanguage()); ?>
</label></p>
			
			<div class="select-field">
				<?php if ($this->_tpl_vars['filter']['feature_type'] == 'D'): ?>
					<?php if ($this->_tpl_vars['search']['custom_range'][$this->_tpl_vars['filter']['feature_id']]['from'] || $this->_tpl_vars['search']['custom_range'][$this->_tpl_vars['filter']['feature_id']]['to']): ?>
						<?php $this->assign('date_extra', "", false); ?>
					<?php else: ?>
						<?php $this->assign('date_extra', "\"disabled=\"\\disabled\\\"\"", false); ?>
					<?php endif; ?>
					<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('date_id' => "range_".($this->_tpl_vars['el_id'])."_from", 'date_name' => "custom_range[".($this->_tpl_vars['filter']['feature_id'])."][from]", 'date_val' => $this->_tpl_vars['search']['custom_range'][$this->_tpl_vars['filter']['feature_id']]['from'], 'extra' => $this->_tpl_vars['date_extra'], 'start_year' => $this->_tpl_vars['settings']['Company']['company_start_year'], )); ?><?php if ($this->_tpl_vars['settings']['Appearance']['calendar_date_format'] == 'month_first'): ?>
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
					<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('date_id' => "range_".($this->_tpl_vars['el_id'])."_to", 'date_name' => "custom_range[".($this->_tpl_vars['filter']['feature_id'])."][to]", 'date_val' => $this->_tpl_vars['search']['custom_range'][$this->_tpl_vars['filter']['feature_id']]['to'], 'extra' => $this->_tpl_vars['date_extra'], 'start_year' => $this->_tpl_vars['settings']['Company']['company_start_year'], )); ?><?php if ($this->_tpl_vars['settings']['Appearance']['calendar_date_format'] == 'month_first'): ?>
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
					<input type="hidden" name="custom_range[<?php echo $this->_tpl_vars['filter']['feature_id']; ?>
][type]" value="D" />
				<?php else: ?>
					<?php if (! $this->_tpl_vars['filter']['slider']): ?>
						<?php $this->assign('from_value', smarty_modifier_default(@$this->_tpl_vars['search']['custom_range'][$this->_tpl_vars['filter']['feature_id']]['from'], @$this->_tpl_vars['search']['field_range'][$this->_tpl_vars['filter']['field_type']]['from']), false); ?>
						<?php $this->assign('to_value', smarty_modifier_default(@$this->_tpl_vars['search']['custom_range'][$this->_tpl_vars['filter']['feature_id']]['to'], @$this->_tpl_vars['search']['field_range'][$this->_tpl_vars['filter']['field_type']]['to']), false); ?>
					<?php else: ?>
						<?php $this->assign('from_value', smarty_modifier_default(@$this->_tpl_vars['search']['field_range'][$this->_tpl_vars['filter']['field_type']]['from'], @$this->_tpl_vars['filter']['range_values']['min']), false); ?>
						<?php $this->assign('to_value', smarty_modifier_default(@$this->_tpl_vars['search']['field_range'][$this->_tpl_vars['filter']['field_type']]['to'], @$this->_tpl_vars['filter']['range_values']['max']), false); ?>
						<?php if ($this->_tpl_vars['filter']['field_type'] == 'P'): ?>
							<?php $this->assign('cur', smarty_modifier_default(@$this->_tpl_vars['search']['field_range'][$this->_tpl_vars['filter']['field_type']]['cur'], @$this->_tpl_vars['secondary_currency']), false); ?>
							<?php $this->assign('orig_from', $this->_tpl_vars['search']['field_range'][$this->_tpl_vars['filter']['field_type']]['orig_from'], false); ?>
							<?php $this->assign('orig_to', $this->_tpl_vars['search']['field_range'][$this->_tpl_vars['filter']['field_type']]['orig_to'], false); ?>
							<?php $this->assign('orig_cur', $this->_tpl_vars['search']['field_range'][$this->_tpl_vars['filter']['field_type']]['orig_cur'], false); ?>
						<?php endif; ?>
					<?php endif; ?>

					<input type="text" name="<?php if ($this->_tpl_vars['filter']['field_type']): ?>field_range[<?php echo $this->_tpl_vars['filter']['field_type']; ?>
]<?php else: ?>custom_range[<?php echo $this->_tpl_vars['filter']['feature_id']; ?>
]<?php endif; ?>[from]" id="range_<?php echo $this->_tpl_vars['el_id']; ?>
_from" size="3" class="input-text-short<?php if ($this->_tpl_vars['search']['variants'][$this->_tpl_vars['el_id']] != 'O'): ?> disabled<?php endif; ?>" value="<?php echo $this->_tpl_vars['from_value']; ?>
" <?php if ($this->_tpl_vars['search']['variants'][$this->_tpl_vars['el_id']] != 'O'): ?>disabled="disabled"<?php endif; ?> />
					&nbsp;-&nbsp;
					<input type="text" name="<?php if ($this->_tpl_vars['filter']['field_type']): ?>field_range[<?php echo $this->_tpl_vars['filter']['field_type']; ?>
]<?php else: ?>custom_range[<?php echo $this->_tpl_vars['filter']['feature_id']; ?>
]<?php endif; ?>[to]" size="3" class="input-text-short<?php if ($this->_tpl_vars['search']['variants'][$this->_tpl_vars['el_id']] != 'O'): ?> disabled<?php endif; ?>" value="<?php echo $this->_tpl_vars['to_value']; ?>
" id="range_<?php echo $this->_tpl_vars['el_id']; ?>
_to" <?php if ($this->_tpl_vars['search']['variants'][$this->_tpl_vars['el_id']] != 'O'): ?>disabled="disabled"<?php endif; ?> />
					<?php if ($this->_tpl_vars['filter']['field_type'] == 'P'): ?>
						<input type="hidden" name="field_range[<?php echo $this->_tpl_vars['filter']['field_type']; ?>
][cur]" size="3" value="<?php echo $this->_tpl_vars['cur']; ?>
" id="range_<?php echo $this->_tpl_vars['el_id']; ?>
_cur" <?php if ($this->_tpl_vars['search']['variants'][$this->_tpl_vars['el_id']] != 'O'): ?>disabled="disabled"<?php endif; ?> />
						<input type="hidden" name="field_range[<?php echo $this->_tpl_vars['filter']['field_type']; ?>
][orig_from]" size="3" value="<?php echo $this->_tpl_vars['orig_from']; ?>
" id="range_<?php echo $this->_tpl_vars['el_id']; ?>
_orig_from" <?php if ($this->_tpl_vars['search']['variants'][$this->_tpl_vars['el_id']] != 'O'): ?>disabled="disabled"<?php endif; ?> />
						<input type="hidden" name="field_range[<?php echo $this->_tpl_vars['filter']['field_type']; ?>
][orig_to]" size="3"  value="<?php echo $this->_tpl_vars['orig_to']; ?>
" id="range_<?php echo $this->_tpl_vars['el_id']; ?>
_orig_to" <?php if ($this->_tpl_vars['search']['variants'][$this->_tpl_vars['el_id']] != 'O'): ?>disabled="disabled"<?php endif; ?> />
						<input type="hidden" name="field_range[<?php echo $this->_tpl_vars['filter']['field_type']; ?>
][orig_cur]" size="3" value="<?php echo $this->_tpl_vars['orig_cur']; ?>
" id="range_<?php echo $this->_tpl_vars['el_id']; ?>
_orig_cur" <?php if ($this->_tpl_vars['search']['variants'][$this->_tpl_vars['el_id']] != 'O'): ?>disabled="disabled"<?php endif; ?> />
					<?php endif; ?>
				<?php endif; ?>
			</div>
			<?php endif; ?>
			<script type="text/javascript">
			//<![CDATA[
			$(function(){
			$(":radio[name='variants[<?php echo $this->_tpl_vars['el_id']; ?>
]']").change(function() {
				var el_id = '<?php echo $this->_tpl_vars['el_id']; ?>
';
				$('#range_' + el_id + '_from').attr('disabled', this.value !== 'O');
				$('#range_' + el_id + '_from').attr('class', this.value !== 'O' ? 'input-text-short disabled' : 'input-text-short');
				$('#range_' + el_id + '_to').attr('disabled', this.value !== 'O');
				$('#range_' + el_id + '_to').attr('class', this.value !== 'O' ? 'input-text-short disabled' : 'input-text-short');
				<?php if ($this->_tpl_vars['filter']['field_type'] == 'P'): ?>
					$('#range_' + el_id + '_cur').attr('disabled', this.value !== 'O');
					$('#range_' + el_id + '_orig_from').attr('disabled', this.value !== 'O');
					$('#range_' + el_id + '_orig_to').attr('disabled', this.value !== 'O');
					$('#range_' + el_id + '_orig_cur').attr('disabled', this.value !== 'O');
				<?php endif; ?>
				<?php if ($this->_tpl_vars['filter']['feature_type'] == 'D'): ?>
				$('#range_' + el_id + '_from_but').attr('disabled', this.value !== 'O');
				$('#range_' + el_id + '_to_but').attr('disabled', this.value !== 'O');
				<?php endif; ?>
			});
			<?php if ($this->_tpl_vars['filter']['field_type'] == 'P'): ?>
				$('#range_<?php echo $this->_tpl_vars['el_id']; ?>
_to').change(function() {
					$('#range_<?php echo $this->_tpl_vars['el_id']; ?>
_orig_cur').val('');
				});
				$('#range_<?php echo $this->_tpl_vars['el_id']; ?>
_from').change(function() {
					$('#range_<?php echo $this->_tpl_vars['el_id']; ?>
_orig_cur').val('');
				});
			<?php endif; ?>
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
]" id="ranges_<?php echo $this->_tpl_vars['el_id']; ?>
_none" value="" <?php if (! $this->_tpl_vars['search']['ch_filters'][$this->_tpl_vars['el_id']]): ?>checked="checked"<?php endif; ?> />
				<label for="ranges_<?php echo $this->_tpl_vars['el_id']; ?>
_none"><?php echo fn_get_lang_var('none', $this->getLanguage()); ?>
</label>
			</div>
			
			<div class="select-field">
				<input type="radio" class="radio" name="ch_filters[<?php echo $this->_tpl_vars['el_id']; ?>
]" id="ranges_<?php echo $this->_tpl_vars['el_id']; ?>
_yes" value="Y" <?php if ($this->_tpl_vars['search']['ch_filters'][$this->_tpl_vars['el_id']] == 'Y'): ?>checked="checked"<?php endif; ?> />
				<label for="ranges_<?php echo $this->_tpl_vars['el_id']; ?>
_yes"><?php echo fn_get_lang_var('yes', $this->getLanguage()); ?>
</label>
			</div>
			
			<div class="select-field">
				<input type="radio" class="radio" name="ch_filters[<?php echo $this->_tpl_vars['el_id']; ?>
]" id="ranges_<?php echo $this->_tpl_vars['el_id']; ?>
_no" value="N" <?php if ($this->_tpl_vars['search']['ch_filters'][$this->_tpl_vars['el_id']] == 'N'): ?>checked="checked"<?php endif; ?> />
				<label for="ranges_<?php echo $this->_tpl_vars['el_id']; ?>
_no"><?php echo fn_get_lang_var('no', $this->getLanguage()); ?>
</label>
			</div>
			
			<?php if (! $this->_tpl_vars['filter']['condition_type']): ?>
			<div class="select-field">
				<input type="radio" class="radio" name="ch_filters[<?php echo $this->_tpl_vars['el_id']; ?>
]" id="ranges_<?php echo $this->_tpl_vars['el_id']; ?>
_any" value="A" <?php if ($this->_tpl_vars['search']['ch_filters'][$this->_tpl_vars['el_id']] == 'A'): ?>checked="checked"<?php endif; ?> />
				<label for="ranges_<?php echo $this->_tpl_vars['el_id']; ?>
_any"><?php echo fn_get_lang_var('any', $this->getLanguage()); ?>
</label>
			</div>
			<?php endif; ?>
			
		<?php elseif ($this->_tpl_vars['filter']['feature_type'] == 'T'): ?>
			<div class="select-field nowrap">
			<?php echo $this->_tpl_vars['filter']['prefix']; ?>
<input type="text" name="tx_features[<?php echo $this->_tpl_vars['filter']['feature_id']; ?>
]" class="input-text<?php if ($this->_tpl_vars['filter']['prefix'] || $this->_tpl_vars['filter']['suffix']): ?>-medium<?php endif; ?>" value="<?php echo $this->_tpl_vars['search']['tx_features'][$this->_tpl_vars['filter']['feature_id']]; ?>
" /><?php echo $this->_tpl_vars['filter']['suffix']; ?>

			</div>
		<?php endif; ?>
	</td>
<?php endforeach; endif; unset($_from); ?>
</tr>
<?php endforeach; endif; unset($_from); ?>
</table>
<?php $this->_smarty_vars['capture']['filtering'] = ob_get_contents(); ob_end_clean(); ?>

<?php if ($this->_tpl_vars['separate_form']): ?>

<?php ob_start(); ?>
<form action="<?php echo fn_url(""); ?>
" method="get" name="advanced_filter_form">

<?php echo $this->_smarty_vars['capture']['filtering']; ?>


<div class="buttons-container">
	<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('but_name' => "dispatch[".($this->_tpl_vars['_REQUEST']['dispatch'])."]", 'but_text' => fn_get_lang_var('submit', $this->getLanguage()), )); ?>

<?php if ($this->_tpl_vars['but_role'] == 'action'): ?>
	<?php $this->assign('suffix', "-action", false); ?>
	<?php $this->assign('file_prefix', 'action_', false); ?>
<?php elseif ($this->_tpl_vars['but_role'] == 'act'): ?>
	<?php $this->assign('suffix', "-act", false); ?>
	<?php $this->assign('file_prefix', 'action_', false); ?>
<?php elseif ($this->_tpl_vars['but_role'] == 'disabled_big'): ?>
	<?php $this->assign('suffix', "-disabled-big", false); ?>
<?php elseif ($this->_tpl_vars['but_role'] == 'big'): ?>
	<?php $this->assign('suffix', "-big", false); ?>
<?php elseif ($this->_tpl_vars['but_role'] == 'delete'): ?>
	<?php $this->assign('suffix', "-delete", false); ?>
<?php elseif ($this->_tpl_vars['but_role'] == 'tool'): ?>
	<?php $this->assign('suffix', "-tool", false); ?>
<?php else: ?>
	<?php $this->assign('suffix', "", false); ?>
<?php endif; ?>

<?php if ($this->_tpl_vars['but_name'] && $this->_tpl_vars['but_role'] != 'text' && $this->_tpl_vars['but_role'] != 'act' && $this->_tpl_vars['but_role'] != 'delete'): ?> 
	<span <?php if ($this->_tpl_vars['but_id']): ?>id="wrap_<?php echo $this->_tpl_vars['but_id']; ?>
"<?php endif; ?> <?php if ($this->_tpl_vars['but_css']): ?>style="<?php echo $this->_tpl_vars['but_css']; ?>
"<?php endif; ?> class="button-submit<?php echo $this->_tpl_vars['suffix']; ?>
 button-wrap-left"><span <?php if ($this->_tpl_vars['but_css']): ?>style="<?php echo $this->_tpl_vars['but_css']; ?>
"<?php endif; ?> class="button-submit<?php echo $this->_tpl_vars['suffix']; ?>
 button-wrap-right"><input <?php if ($this->_tpl_vars['but_id']): ?>id="<?php echo $this->_tpl_vars['but_id']; ?>
"<?php endif; ?> <?php if ($this->_tpl_vars['but_meta']): ?>class="<?php echo $this->_tpl_vars['but_meta']; ?>
"<?php endif; ?> type="submit" name="<?php echo $this->_tpl_vars['but_name']; ?>
" <?php if ($this->_tpl_vars['but_onclick']): ?>onclick="<?php echo $this->_tpl_vars['but_onclick']; ?>
"<?php endif; ?> value="<?php echo $this->_tpl_vars['but_text']; ?>
" /></span></span>

<?php elseif ($this->_tpl_vars['but_role'] == 'text' || $this->_tpl_vars['but_role'] == 'act' || $this->_tpl_vars['but_role'] == 'edit' || ( $this->_tpl_vars['but_role'] == 'text' && $this->_tpl_vars['but_name'] )): ?> 

	<a class="<?php if ($this->_tpl_vars['but_meta']): ?><?php echo $this->_tpl_vars['but_meta']; ?>
 <?php endif; ?><?php if ($this->_tpl_vars['but_name']): ?>cm-submit-link <?php endif; ?>text-button<?php echo $this->_tpl_vars['suffix']; ?>
"<?php if ($this->_tpl_vars['but_id']): ?> id="<?php echo $this->_tpl_vars['but_id']; ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_name']): ?> name="<?php echo smarty_modifier_replace(smarty_modifier_replace($this->_tpl_vars['but_name'], "[", ":-"), "]", "-:"); ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_href']): ?> href="<?php echo fn_url($this->_tpl_vars['but_href']); ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_onclick']): ?> onclick="<?php echo $this->_tpl_vars['but_onclick']; ?>
 return false;"<?php endif; ?><?php if ($this->_tpl_vars['but_target']): ?> target="<?php echo $this->_tpl_vars['but_target']; ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_rel']): ?> rel="<?php echo $this->_tpl_vars['but_rel']; ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_rev']): ?> rev="<?php echo $this->_tpl_vars['but_rev']; ?>
"<?php endif; ?>><?php echo $this->_tpl_vars['but_text']; ?>
</a>

<?php elseif ($this->_tpl_vars['but_role'] == 'delete'): ?>

	<a <?php if ($this->_tpl_vars['but_id']): ?>id="<?php echo $this->_tpl_vars['but_id']; ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_name']): ?> name="<?php echo smarty_modifier_replace(smarty_modifier_replace($this->_tpl_vars['but_name'], "[", ":-"), "]", "-:"); ?>
"<?php endif; ?> <?php if ($this->_tpl_vars['but_href']): ?>href="<?php echo fn_url($this->_tpl_vars['but_href']); ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_onclick']): ?> onclick="<?php echo $this->_tpl_vars['but_onclick']; ?>
 return false;"<?php endif; ?><?php if ($this->_tpl_vars['but_meta']): ?> class="<?php echo $this->_tpl_vars['but_meta']; ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_target']): ?> target="<?php echo $this->_tpl_vars['but_target']; ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_rel']): ?> rel="<?php echo $this->_tpl_vars['but_rel']; ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_rev']): ?> rev="<?php echo $this->_tpl_vars['but_rev']; ?>
"<?php endif; ?>><span title="<?php echo fn_get_lang_var('delete', $this->getLanguage()); ?>
" class="icon-delete-small"></span></a>

<?php elseif ($this->_tpl_vars['but_role'] == 'icon'): ?> 
	<a <?php if ($this->_tpl_vars['but_id']): ?>id="<?php echo $this->_tpl_vars['but_id']; ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_href']): ?> href="<?php echo fn_url($this->_tpl_vars['but_href']); ?>
"<?php endif; ?> <?php if ($this->_tpl_vars['but_onclick']): ?>onclick="<?php echo $this->_tpl_vars['but_onclick']; ?>
;<?php if (! $this->_tpl_vars['allow_href']): ?> return false;<?php endif; ?>"<?php endif; ?> <?php if ($this->_tpl_vars['but_target']): ?>target="<?php echo $this->_tpl_vars['but_target']; ?>
"<?php endif; ?> <?php if ($this->_tpl_vars['but_rel']): ?> rel="<?php echo $this->_tpl_vars['but_rel']; ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_rev']): ?> rev="<?php echo $this->_tpl_vars['but_rev']; ?>
"<?php endif; ?> class="<?php if ($this->_tpl_vars['but_meta']): ?> <?php echo $this->_tpl_vars['but_meta']; ?>
<?php endif; ?>"><?php echo $this->_tpl_vars['but_text']; ?>
</a>

<?php else: ?> 

	<span class="button<?php echo $this->_tpl_vars['suffix']; ?>
 button-wrap-left" <?php if ($this->_tpl_vars['but_id']): ?>id="<?php echo $this->_tpl_vars['but_id']; ?>
"<?php endif; ?>><span class="button<?php echo $this->_tpl_vars['suffix']; ?>
 button-wrap-right"><a <?php if ($this->_tpl_vars['but_href']): ?>href="<?php echo fn_url($this->_tpl_vars['but_href']); ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_onclick']): ?> onclick="<?php echo $this->_tpl_vars['but_onclick']; ?>
 return false;"<?php endif; ?> <?php if ($this->_tpl_vars['but_target']): ?>target="<?php echo $this->_tpl_vars['but_target']; ?>
"<?php endif; ?> class="<?php if ($this->_tpl_vars['but_meta']): ?><?php echo $this->_tpl_vars['but_meta']; ?>
 <?php endif; ?>" <?php if ($this->_tpl_vars['but_rel']): ?> rel="<?php echo $this->_tpl_vars['but_rel']; ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_rev']): ?>rev="<?php echo $this->_tpl_vars['but_rev']; ?>
"<?php endif; ?>><?php echo $this->_tpl_vars['but_text']; ?>
</a></span></span>

<?php endif; ?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
	&nbsp;<?php echo fn_get_lang_var('or', $this->getLanguage()); ?>
&nbsp;&nbsp;<a class="text-button nobg cm-reset-link"><?php echo fn_get_lang_var('reset_filter', $this->getLanguage()); ?>
</a>
</div>

</form>
<?php $this->_smarty_vars['capture']['section'] = ob_get_contents(); ob_end_clean(); ?>

<?php if ($this->_tpl_vars['search']['variants']): ?>
	<?php $this->assign('_collapse', true, false); ?>
<?php else: ?>
	<?php $this->assign('_collapse', false, false); ?>
<?php endif; ?>
<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('section_title' => fn_get_lang_var('advanced_filter', $this->getLanguage()), 'section_content' => $this->_smarty_vars['capture']['section'], 'collapse' => $this->_tpl_vars['_collapse'], )); ?><?php $this->assign('id', smarty_modifier_string_format(md5($this->_tpl_vars['section_title']), "s_%s"), false); ?>
<?php echo smarty_function_math(array('equation' => "rand()",'assign' => 'rnd'), $this);?>

<?php if ($_COOKIE[$this->_tpl_vars['id']] || $this->_tpl_vars['collapse']): ?>
	<?php $this->assign('collapse', true, false); ?>
<?php else: ?>
	<?php $this->assign('collapse', false, false); ?>
<?php endif; ?>

<div class="section-border<?php if ($this->_tpl_vars['class']): ?> <?php echo $this->_tpl_vars['class']; ?>
<?php endif; ?>" id="ds_<?php echo $this->_tpl_vars['rnd']; ?>
">
	<div  class="section-title cm-combo-<?php if (! $this->_tpl_vars['collapse']): ?>off<?php else: ?>on<?php endif; ?> cm-combination cm-save-state cm-ss-reverse" id="sw_<?php echo $this->_tpl_vars['id']; ?>
">
		<span><?php echo $this->_tpl_vars['section_title']; ?>
</span>
		<span class="section-switch section-switch-on"><?php echo fn_get_lang_var('open_action', $this->getLanguage()); ?>
</span>
		<span class="section-switch section-switch-off"><?php echo fn_get_lang_var('hide', $this->getLanguage()); ?>
</span>
	</div>
	<div id="<?php echo $this->_tpl_vars['id']; ?>
" class="<?php echo smarty_modifier_default(@$this->_tpl_vars['section_body_class'], "section-body"); ?>
 <?php if ($this->_tpl_vars['collapse']): ?>hidden<?php endif; ?>"><?php echo $this->_tpl_vars['section_content']; ?>
</div>
</div><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>

<?php else: ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/subheader.tpl", 'smarty_include_vars' => array('title' => fn_get_lang_var('advanced_filter', $this->getLanguage()))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php echo $this->_smarty_vars['capture']['filtering']; ?>


<?php endif; ?>

<?php elseif ($this->_tpl_vars['search']['features_hash']): ?>
	<input type="hidden" name="features_hash" value="<?php echo $this->_tpl_vars['search']['features_hash']; ?>
" />
<?php endif; ?>

