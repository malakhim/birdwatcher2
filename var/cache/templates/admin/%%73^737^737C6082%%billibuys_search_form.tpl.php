<?php /* Smarty version 2.6.18, created on 2013-10-27 11:18:21
         compiled from addons/billibuys/views/billibuys/components/billibuys_search_form.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'fn_url', 'addons/billibuys/views/billibuys/components/billibuys_search_form.tpl', 16, false),array('modifier', 'fn_parse_date', 'addons/billibuys/views/billibuys/components/billibuys_search_form.tpl', 99, false),array('modifier', 'date_format', 'addons/billibuys/views/billibuys/components/billibuys_search_form.tpl', 99, false),array('modifier', 'default', 'addons/billibuys/views/billibuys/components/billibuys_search_form.tpl', 115, false),array('function', 'math', 'addons/billibuys/views/billibuys/components/billibuys_search_form.tpl', 115, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('item','user','status','awaiting','in_progress','finished','type','public','private','disabled','period','yes','no','calendar','calendar','weekday_abr_0','weekday_abr_1','weekday_abr_2','weekday_abr_3','weekday_abr_4','weekday_abr_5','weekday_abr_6','month_name_abr_1','month_name_abr_2','month_name_abr_3','month_name_abr_4','month_name_abr_5','month_name_abr_6','month_name_abr_7','month_name_abr_8','month_name_abr_9','month_name_abr_10','month_name_abr_11','month_name_abr_12','close'));
?>
<?php 

				$rname = !empty($resource_name) ? $resource_name : $params['smarty_include_tpl_file'];
				if ($this->compile_check && empty($inline_no_check[$rname]) && $this->is_cached($rname)) {
					if ($this->check_inline_blocks(array (
  'common_templates/section.tpl' => 1367063753,
))) {
						$_smarty_compile_path = $this->_get_compile_path($rname);
						$this->_compile_resource($rname, $_smarty_compile_path);
						$inline_no_check[$rname] = true;
						include $_smarty_compile_path;
						return;
					}
				}
			 ?><?php ob_start(); ?>
<form action="<?php echo fn_url(""); ?>
" method="get" name="billibuys_search">

<table cellpadding="0" cellspacing="0" border="0" class="search-header">
<tr>
	<td class="search-field">
		<label for="item"><?php echo fn_get_lang_var('item', $this->getLanguage()); ?>
:</label>
		<div class="break">
			<input class="input-text" name="item" id="item" size="25" type="text" value="<?php echo $this->_tpl_vars['search']['item']; ?>
" />
		</div>
	</td>
	<td class="search-field">
		<label for="user"><?php echo fn_get_lang_var('user', $this->getLanguage()); ?>
:</label>
		<div class="break">
		<input class="input-text" name="user" id="user" size="25" type="text" value="<?php echo $this->_tpl_vars['search']['user']; ?>
" />
		</div>
	</td>
	<td class="buttons-container">
		<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/search.tpl", 'smarty_include_vars' => array('but_name' => "dispatch[billibuys.view]",'but_role' => 'submit')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</td>
</tr>
</table>

<!--
<?php ob_start(); ?>

<table cellpadding="0" cellspacing="0" border="0">
<tr>
	<td>
		<div class="search-field">
			<label for="status"><?php echo fn_get_lang_var('status', $this->getLanguage()); ?>
:</label>
			<select name="status" id="status">
				<option value="">--</option>
				<option <?php if ($this->_tpl_vars['search']['status'] == 'A'): ?>selected="selected"<?php endif; ?> value="A"><?php echo fn_get_lang_var('awaiting', $this->getLanguage()); ?>
</option>
				<option <?php if ($this->_tpl_vars['search']['status'] == 'P'): ?>selected="selected"<?php endif; ?> value="P"><?php echo fn_get_lang_var('in_progress', $this->getLanguage()); ?>
</option>
				<option <?php if ($this->_tpl_vars['search']['status'] == 'F'): ?>selected="selected"<?php endif; ?> value="F"><?php echo fn_get_lang_var('finished', $this->getLanguage()); ?>
</option>
			</select>&nbsp;&nbsp;&nbsp;
		</div>
	</td>
	<td>
		<div class="search-field">
			<label for="type"><?php echo fn_get_lang_var('type', $this->getLanguage()); ?>
:</label>
			<select name="type" id="type">
				<option value="">--</option>
				<option <?php if ($this->_tpl_vars['search']['type'] == 'P'): ?>selected="selected"<?php endif; ?> value="P"><?php echo fn_get_lang_var('public', $this->getLanguage()); ?>
</option>
				<option <?php if ($this->_tpl_vars['search']['type'] == 'U'): ?>selected="selected"<?php endif; ?> value="U"><?php echo fn_get_lang_var('private', $this->getLanguage()); ?>
</option>
				<option <?php if ($this->_tpl_vars['search']['type'] == 'D'): ?>selected="selected"<?php endif; ?> value="D"><?php echo fn_get_lang_var('disabled', $this->getLanguage()); ?>
</option>
			</select>
		</div>
	</td>
</tr>
</table>

<div class="search-field">
	<label><?php echo fn_get_lang_var('period', $this->getLanguage()); ?>
:</label>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/period_selector.tpl", 'smarty_include_vars' => array('period' => $this->_tpl_vars['search']['period'],'form_name' => 'events_search')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>

<?php $_from = $this->_tpl_vars['event_fields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['field']):
?>
<?php $this->assign('f_id', $this->_tpl_vars['field']['field_id'], false); ?>
<div class="search-field">
	<label for="search_fields_<?php echo $this->_tpl_vars['field']['field_id']; ?>
"><?php echo $this->_tpl_vars['field']['description']; ?>
:&nbsp;</label>
	<?php if ($this->_tpl_vars['field']['field_type'] == 'S' || $this->_tpl_vars['field']['field_type'] == 'R'): ?>
		<select name="search_fields[<?php echo $this->_tpl_vars['field']['field_id']; ?>
]" id="search_fields_<?php echo $this->_tpl_vars['field']['field_id']; ?>
">
			<option value=""> -- </option>
			<?php $_from = $this->_tpl_vars['field']['variants']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['var']):
?>
				<option value="<?php echo $this->_tpl_vars['var']['variant_id']; ?>
" <?php if ($this->_tpl_vars['search']['search_fields'][$this->_tpl_vars['f_id']] == $this->_tpl_vars['var']['variant_id']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['var']['description']; ?>
</option>
			<?php endforeach; endif; unset($_from); ?>
		</select>
	<?php elseif ($this->_tpl_vars['field']['field_type'] == 'C'): ?>
	    <select name="search_fields[<?php echo $this->_tpl_vars['field']['field_id']; ?>
]" id="search_fields_<?php echo $this->_tpl_vars['field']['field_id']; ?>
">
			<option value=""> -- </option>
			<option value="Y" <?php if ($this->_tpl_vars['search']['search_fields'][$this->_tpl_vars['f_id']] == 'Y'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('yes', $this->getLanguage()); ?>
</option>
			<option value="N" <?php if ($this->_tpl_vars['search']['search_fields'][$this->_tpl_vars['f_id']] == 'N'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('no', $this->getLanguage()); ?>
</option>
		</select>
	<?php elseif ($this->_tpl_vars['field']['field_type'] == 'I' || $this->_tpl_vars['field']['field_type'] == 'T'): ?>
		<input class="input-text" size="50" type="text" name="search_fields[<?php echo $this->_tpl_vars['field']['field_id']; ?>
]" value="<?php echo $this->_tpl_vars['search']['search_fields'][$this->_tpl_vars['f_id']]; ?>
" id="search_fields_<?php echo $this->_tpl_vars['field']['field_id']; ?>
" />
	<?php elseif ($this->_tpl_vars['field']['field_type'] == 'V'): ?>
		<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('date_id' => "search_date_".($this->_tpl_vars['field']['field_id']), 'date_name' => "search_fields[".($this->_tpl_vars['field']['field_id'])."]", 'date_val' => $this->_tpl_vars['search']['search_fields'][$this->_tpl_vars['f_id']], 'start_year' => '1970', 'end_year' => '5', )); ?><?php if ($this->_tpl_vars['settings']['Appearance']['calendar_date_format'] == 'month_first'): ?>
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
	<?php endif; ?>
</div>
<?php endforeach; endif; unset($_from); ?>

<?php $this->_smarty_vars['capture']['advanced_search'] = ob_get_contents(); ob_end_clean(); ?>
-->
<!--<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/advanced_search.tpl", 'smarty_include_vars' => array('content' => $this->_smarty_vars['capture']['advanced_search'],'dispatch' => "billibuys.view",'view_type' => 'billibuys')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>-->

</form>

<?php $this->_smarty_vars['capture']['section'] = ob_get_contents(); ob_end_clean(); ?>
<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('section_content' => $this->_smarty_vars['capture']['section'], )); ?><?php echo smarty_function_math(array('equation' => "rand()",'assign' => 'rnd'), $this);?>

<div class="clear" id="ds_<?php echo $this->_tpl_vars['rnd']; ?>
">
	<div class="section-border">
		<?php echo $this->_tpl_vars['section_content']; ?>

		<?php if ($this->_tpl_vars['section_state']): ?>
			<p align="right">
				<a href="<?php echo fn_url(($this->_tpl_vars['index_script'])."?".($_SERVER['QUERY_STRING'])."&amp;close_section=".($this->_tpl_vars['key'])); ?>
" class="underlined"><?php echo fn_get_lang_var('close', $this->getLanguage()); ?>
</a>
			</p>
		<?php endif; ?>
	</div>
</div><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>