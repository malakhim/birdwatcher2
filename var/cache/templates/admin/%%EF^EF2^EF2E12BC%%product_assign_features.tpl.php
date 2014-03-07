<?php /* Smarty version 2.6.18, created on 2014-03-07 22:41:09
         compiled from views/products/components/product_assign_features.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'views/products/components/product_assign_features.tpl', 1, false),array('modifier', 'fn_get_product_feature_variant', 'views/products/components/product_assign_features.tpl', 28, false),array('modifier', 'defined', 'views/products/components/product_assign_features.tpl', 53, false),array('modifier', 'truncate', 'views/products/components/product_assign_features.tpl', 56, false),array('modifier', 'fn_url', 'views/products/components/product_assign_features.tpl', 64, false),array('modifier', 'fn_parse_date', 'views/products/components/product_assign_features.tpl', 105, false),array('modifier', 'date_format', 'views/products/components/product_assign_features.tpl', 105, false),array('modifier', 'floatval', 'views/products/components/product_assign_features.tpl', 140, false),array('function', 'math', 'views/products/components/product_assign_features.tpl', 121, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('none','search','loading','none','enter_other','enter_other','calendar','calendar','weekday_abr_0','weekday_abr_1','weekday_abr_2','weekday_abr_3','weekday_abr_4','weekday_abr_5','weekday_abr_6','month_name_abr_1','month_name_abr_2','month_name_abr_3','month_name_abr_4','month_name_abr_5','month_name_abr_6','month_name_abr_7','month_name_abr_8','month_name_abr_9','month_name_abr_10','month_name_abr_11','month_name_abr_12'));
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
			 ?><?php $_from = $this->_tpl_vars['product_features']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['feature_id'] => $this->_tpl_vars['feature']):
?>
	<?php if ($this->_tpl_vars['feature']['feature_type'] != 'G'): ?>
		<div class="form-field">
			<label for="feature_<?php echo $this->_tpl_vars['feature_id']; ?>
"><?php echo $this->_tpl_vars['feature']['description']; ?>
:</label>
			<div class="select-field">
			<span><?php echo $this->_tpl_vars['feature']['prefix']; ?>
</span>
			<?php if ($this->_tpl_vars['feature']['feature_type'] == 'S' || $this->_tpl_vars['feature']['feature_type'] == 'N' || $this->_tpl_vars['feature']['feature_type'] == 'E'): ?>
				<?php $this->assign('value_selected', false, false); ?>
				<?php if ($this->_tpl_vars['feature']['use_variant_picker']): ?>
					<input type="hidden" name="product_data[product_features][<?php echo $this->_tpl_vars['feature_id']; ?>
]" id="feature_<?php echo $this->_tpl_vars['feature_id']; ?>
" value="<?php echo smarty_modifier_default(@$this->_tpl_vars['selected'], @$this->_tpl_vars['feature']['variant_id']); ?>
" />
					<?php if ($this->_tpl_vars['feature']['variants'][$this->_tpl_vars['feature']['variant_id']]['variant']): ?>
						<?php $this->assign('selected_variant', $this->_tpl_vars['feature']['variants'][$this->_tpl_vars['feature']['variant_id']]['variant'], false); ?>
					<?php elseif ($this->_tpl_vars['feature']['variant_id']): ?>
						<?php $this->assign('selected_variant', fn_get_product_feature_variant($this->_tpl_vars['feature']['variant_id']), false); ?>
						<?php $this->assign('selected_variant', $this->_tpl_vars['selected_variant']['variant'], false); ?>
					<?php else: ?>
						<?php $this->assign('selected_variant', fn_get_lang_var('none', $this->getLanguage()), false); ?>
					<?php endif; ?>
					<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('data_url' => "product_features.get_feature_variants_list&feature_id=".($this->_tpl_vars['feature_id']), 'text' => $this->_tpl_vars['selected_variant'], 'result_elm' => "feature_".($this->_tpl_vars['feature_id']), 'id' => ($this->_tpl_vars['feature_id'])."_selector", 'js_action' => "$('#input_".($this->_tpl_vars['feature_id'])."').toggleBy(($('#feature_".($this->_tpl_vars['feature_id'])."').val() != 'disable_select'));", )); ?><div class="tools-container inline ajax_select_object" <?php if ($this->_tpl_vars['elements_switcher_id']): ?> id="<?php echo $this->_tpl_vars['elements_switcher_id']; ?>
ajax_select_object"<?php endif; ?>>
	<?php if ($this->_tpl_vars['label']): ?><label><?php echo $this->_tpl_vars['label']; ?>
:</label><?php endif; ?>

	<?php if ($this->_tpl_vars['js_action']): ?>
	<script type="text/javascript">
	//<![CDATA[
		function fn_picker_js_action_<?php echo $this->_tpl_vars['id']; ?>
(elm) {
			<?php echo $this->_tpl_vars['js_action']; ?>

		}
	//]]>
	</script>
	<?php endif; ?> 

	<a id="sw_<?php echo $this->_tpl_vars['id']; ?>
_wrap_" class="select-link <?php if (! $this->_tpl_vars['elements_switcher_id']): ?> cm-combo-on cm-combination<?php endif; ?>"><?php echo $this->_tpl_vars['text']; ?>
</a>

	<div id="<?php echo $this->_tpl_vars['id']; ?>
_wrap_" class="popup-tools cm-popup-box cm-smart-position hidden">
		<div class="select-object-search"><input type="text" value="<?php echo fn_get_lang_var('search', $this->getLanguage()); ?>
..." class="input-text cm-hint cm-ajax-content-input" rev="content_loader_<?php echo $this->_tpl_vars['id']; ?>
" size="16" /></div>
		<div class="ajax-popup-tools" id="scroller_<?php echo $this->_tpl_vars['id']; ?>
">
			<ul class="cm-select-list" id="<?php echo $this->_tpl_vars['id']; ?>
">
				<?php $_from = $this->_tpl_vars['objects']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['object_id'] => $this->_tpl_vars['item']):
?>
					<?php if (defined('TRANSLATION_MODE')): ?>
						<?php $this->assign('name', $this->_tpl_vars['item']['name'], false); ?>
					<?php else: ?>
						<?php $this->assign('name', smarty_modifier_truncate($this->_tpl_vars['item']['name'], 40, "...", true), false); ?>
					<?php endif; ?>

					<li class="<?php echo $this->_tpl_vars['item']['extra_class']; ?>
"><a action="<?php echo $this->_tpl_vars['item']['value']; ?>
" title="<?php echo $this->_tpl_vars['item']['name']; ?>
"><?php echo $this->_tpl_vars['name']; ?>
</a></li>
				<?php endforeach; endif; unset($_from); ?>
			<!--<?php echo $this->_tpl_vars['id']; ?>
--></ul>

			<ul>
				<li id="content_loader_<?php echo $this->_tpl_vars['id']; ?>
" class="cm-ajax-content-more small-description" rel="<?php echo fn_url($this->_tpl_vars['data_url']); ?>
" rev="<?php echo $this->_tpl_vars['id']; ?>
" result_elm="<?php echo $this->_tpl_vars['result_elm']; ?>
"><?php echo fn_get_lang_var('loading', $this->getLanguage()); ?>
</li>
			</ul>
		</div>
	</div>
</div><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
					<input type="text" class="input-text input-empty hidden<?php if ($this->_tpl_vars['feature']['feature_type'] == 'N'): ?> cm-value-decimal<?php endif; ?>" name="product_data[add_new_variant][<?php echo $this->_tpl_vars['feature']['feature_id']; ?>
][variant]" id="input_<?php echo $this->_tpl_vars['feature_id']; ?>
" />					
				<?php else: ?>
					<select name="product_data[product_features][<?php echo $this->_tpl_vars['feature_id']; ?>
]" id="feature_<?php echo $this->_tpl_vars['feature_id']; ?>
" onchange="$('#input_<?php echo $this->_tpl_vars['feature_id']; ?>
').toggleBy((this.value != 'disable_select'));">
						<option value="">-<?php echo fn_get_lang_var('none', $this->getLanguage()); ?>
-</option>
						<?php $_from = $this->_tpl_vars['feature']['variants']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['var']):
?>
						<option value="<?php echo $this->_tpl_vars['var']['variant_id']; ?>
" <?php if ($this->_tpl_vars['var']['variant_id'] == $this->_tpl_vars['feature']['variant_id']): ?><?php $this->assign('value_selected', true, false); ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['var']['variant']; ?>
</option>
						<?php endforeach; endif; unset($_from); ?>
						<?php if (! defined('COMPANY_ID')): ?>
						<option value="disable_select">-<?php echo fn_get_lang_var('enter_other', $this->getLanguage()); ?>
-</option>
						<?php endif; ?>
					</select>
					<input type="text" class="input-text input-empty hidden<?php if ($this->_tpl_vars['feature']['feature_type'] == 'N'): ?> cm-value-decimal<?php endif; ?>" name="product_data[add_new_variant][<?php echo $this->_tpl_vars['feature']['feature_id']; ?>
][variant]" id="input_<?php echo $this->_tpl_vars['feature_id']; ?>
" />
				<?php endif; ?>
			<?php elseif ($this->_tpl_vars['feature']['feature_type'] == 'M'): ?>
				<div class="select-field">
					<input type="hidden" name="product_data[product_features][<?php echo $this->_tpl_vars['feature_id']; ?>
]" value="" />
					<?php $_from = $this->_tpl_vars['feature']['variants']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['var']):
?>
						<p><label class="label-html-checkboxes" for="variant_<?php echo $this->_tpl_vars['var']['variant_id']; ?>
"><input type="checkbox" class="html-checkboxes" id="variant_<?php echo $this->_tpl_vars['var']['variant_id']; ?>
" name="product_data[product_features][<?php echo $this->_tpl_vars['feature_id']; ?>
][<?php echo $this->_tpl_vars['var']['variant_id']; ?>
]" <?php if ($this->_tpl_vars['var']['selected']): ?>checked="checked"<?php endif; ?> value="<?php echo $this->_tpl_vars['var']['variant_id']; ?>
" /><?php echo $this->_tpl_vars['var']['variant']; ?>
</label></p>
					<?php endforeach; endif; unset($_from); ?>
					<?php if (! defined('COMPANY_ID')): ?>
					<p><label for="input_<?php echo $this->_tpl_vars['feature_id']; ?>
"><?php echo fn_get_lang_var('enter_other', $this->getLanguage()); ?>
:</label>&nbsp;
					<input type="text" class="input-text" name="product_data[add_new_variant][<?php echo $this->_tpl_vars['feature']['feature_id']; ?>
][variant]" id="feature_<?php echo $this->_tpl_vars['feature_id']; ?>
" />
					</p>
					<?php endif; ?>
				</div>
			<?php elseif ($this->_tpl_vars['feature']['feature_type'] == 'C'): ?>
				<input type="hidden" name="product_data[product_features][<?php echo $this->_tpl_vars['feature_id']; ?>
]" value="N" />
				<input type="checkbox" name="product_data[product_features][<?php echo $this->_tpl_vars['feature_id']; ?>
]" value="Y" id="feature_<?php echo $this->_tpl_vars['feature_id']; ?>
" class="checkbox" <?php if ($this->_tpl_vars['feature']['value'] == 'Y'): ?>checked="checked"<?php endif; ?> />

			<?php elseif ($this->_tpl_vars['feature']['feature_type'] == 'D'): ?>
				<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('date_id' => "date_".($this->_tpl_vars['feature_id']), 'date_name' => "product_data[product_features][".($this->_tpl_vars['feature_id'])."]", 'date_val' => smarty_modifier_default(@$this->_tpl_vars['feature']['value_int'], ""), 'start_year' => $this->_tpl_vars['settings']['Company']['company_start_year'], )); ?><?php if ($this->_tpl_vars['settings']['Appearance']['calendar_date_format'] == 'month_first'): ?>
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

			<?php else: ?>
				<input type="text" name="product_data[product_features][<?php echo $this->_tpl_vars['feature_id']; ?>
]" value="<?php if ($this->_tpl_vars['feature']['feature_type'] == 'O'): ?><?php if ($this->_tpl_vars['feature']['value_int'] != ""): ?><?php echo floatval($this->_tpl_vars['feature']['value_int']); ?>
<?php endif; ?><?php else: ?><?php echo $this->_tpl_vars['feature']['value']; ?>
<?php endif; ?>" id="feature_<?php echo $this->_tpl_vars['feature_id']; ?>
" class="input-text<?php if ($this->_tpl_vars['feature']['feature_type'] == 'O'): ?> cm-value-decimal<?php endif; ?>" />
			<?php endif; ?>
			<span><?php echo $this->_tpl_vars['feature']['suffix']; ?>
</span>
			</div>
		</div>
	<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>

<?php $_from = $this->_tpl_vars['product_features']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['feature_id'] => $this->_tpl_vars['feature']):
?>
	<?php if ($this->_tpl_vars['feature']['feature_type'] == 'G' && $this->_tpl_vars['feature']['subfeatures']): ?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/subheader.tpl", 'smarty_include_vars' => array('title' => $this->_tpl_vars['feature']['description'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/products/components/product_assign_features.tpl", 'smarty_include_vars' => array('product_features' => $this->_tpl_vars['feature']['subfeatures'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>