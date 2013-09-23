<?php /* Smarty version 2.6.18, created on 2013-09-23 17:00:27
         compiled from common_templates/period_selector.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'replace', 'common_templates/period_selector.tpl', 34, false),array('modifier', 'date_format', 'common_templates/period_selector.tpl', 52, false),array('modifier', 'default', 'common_templates/period_selector.tpl', 68, false),array('function', 'math', 'common_templates/period_selector.tpl', 68, false),array('function', 'script', 'common_templates/period_selector.tpl', 123, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('period','all','this_day','this_week','this_month','this_year','yesterday','previous_week','previous_month','previous_year','last_24hours','last_n_days','last_n_days','custom','select_dates','calendar','calendar','weekday_abr_0','weekday_abr_1','weekday_abr_2','weekday_abr_3','weekday_abr_4','weekday_abr_5','weekday_abr_6','month_name_abr_1','month_name_abr_2','month_name_abr_3','month_name_abr_4','month_name_abr_5','month_name_abr_6','month_name_abr_7','month_name_abr_8','month_name_abr_9','month_name_abr_10','month_name_abr_11','month_name_abr_12','calendar','calendar','weekday_abr_0','weekday_abr_1','weekday_abr_2','weekday_abr_3','weekday_abr_4','weekday_abr_5','weekday_abr_6','month_name_abr_1','month_name_abr_2','month_name_abr_3','month_name_abr_4','month_name_abr_5','month_name_abr_6','month_name_abr_7','month_name_abr_8','month_name_abr_9','month_name_abr_10','month_name_abr_11','month_name_abr_12'));
?>
<?php  ob_start();  ?><?php 

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
			 ?><div class="period">
<div class="form-field period-select">
	<label><?php echo fn_get_lang_var('period', $this->getLanguage()); ?>
</label>
	<select name="period" id="period_selects">
		<option value="A" <?php if ($this->_tpl_vars['period'] == 'A' || ! $this->_tpl_vars['period']): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('all', $this->getLanguage()); ?>
</option>
		<optgroup label="=============">
			<option value="D" <?php if ($this->_tpl_vars['period'] == 'D'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('this_day', $this->getLanguage()); ?>
</option>
			<option value="W" <?php if ($this->_tpl_vars['period'] == 'W'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('this_week', $this->getLanguage()); ?>
</option>
			<option value="M" <?php if ($this->_tpl_vars['period'] == 'M'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('this_month', $this->getLanguage()); ?>
</option>
			<option value="Y" <?php if ($this->_tpl_vars['period'] == 'Y'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('this_year', $this->getLanguage()); ?>
</option>
		</optgroup>
		<optgroup label="=============">
			<option value="LD" <?php if ($this->_tpl_vars['period'] == 'LD'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('yesterday', $this->getLanguage()); ?>
</option>
			<option value="LW" <?php if ($this->_tpl_vars['period'] == 'LW'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('previous_week', $this->getLanguage()); ?>
</option>
			<option value="LM" <?php if ($this->_tpl_vars['period'] == 'LM'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('previous_month', $this->getLanguage()); ?>
</option>
			<option value="LY" <?php if ($this->_tpl_vars['period'] == 'LY'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('previous_year', $this->getLanguage()); ?>
</option>
		</optgroup>
		<optgroup label="=============">
			<option value="HH" <?php if ($this->_tpl_vars['period'] == 'HH'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('last_24hours', $this->getLanguage()); ?>
</option>
			<option value="HW" <?php if ($this->_tpl_vars['period'] == 'HW'): ?>selected="selected"<?php endif; ?>><?php echo smarty_modifier_replace(fn_get_lang_var('last_n_days', $this->getLanguage()), "[N]", 7); ?>
</option>
			<option value="HM" <?php if ($this->_tpl_vars['period'] == 'HM'): ?>selected="selected"<?php endif; ?>><?php echo smarty_modifier_replace(fn_get_lang_var('last_n_days', $this->getLanguage()), "[N]", 30); ?>
</option>
		</optgroup>
		<optgroup label="=============">
			<option value="C" <?php if ($this->_tpl_vars['period'] == 'C'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('custom', $this->getLanguage()); ?>
</option>
		</optgroup>
	</select>
</div>


<div class="form-field period-select-date calendar" >
	<label><?php echo fn_get_lang_var('select_dates', $this->getLanguage()); ?>
</label>
	<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('date_id' => 'f_date', 'date_name' => 'time_from', 'date_val' => $this->_tpl_vars['search']['time_from'], 'start_year' => $this->_tpl_vars['settings']['Company']['company_start_year'], 'extra' => "onchange=\"$('#period_selects').val('C');\"", )); ?><?php if ($this->_tpl_vars['settings']['Appearance']['calendar_date_format'] == 'month_first'): ?>
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
	<span class="period-dash">&#8211;</span>
	<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('date_id' => 't_date', 'date_name' => 'time_to', 'date_val' => $this->_tpl_vars['search']['time_to'], 'start_year' => $this->_tpl_vars['settings']['Company']['company_start_year'], 'extra' => "onchange=\"$('#period_selects').val('C');\"", )); ?><?php if ($this->_tpl_vars['settings']['Appearance']['calendar_date_format'] == 'month_first'): ?>
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
</div>

<?php echo smarty_function_script(array('src' => "js/period_selector.js"), $this);?>

<script type="text/javascript">
//<![CDATA[
$(function()<?php echo $this->_tpl_vars['ldelim']; ?>

	$('#<?php echo $this->_tpl_vars['prefix']; ?>
period_selects').cePeriodSelector(<?php echo $this->_tpl_vars['ldelim']; ?>

		from: '<?php echo $this->_tpl_vars['prefix']; ?>
f_date',
		to: '<?php echo $this->_tpl_vars['prefix']; ?>
t_date'
	<?php echo $this->_tpl_vars['rdelim']; ?>
);
<?php echo $this->_tpl_vars['rdelim']; ?>
);
//]]>
</script>
</div><?php  ob_end_flush();  ?>