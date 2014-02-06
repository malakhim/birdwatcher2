<?php /* Smarty version 2.6.18, created on 2014-02-03 15:24:07
         compiled from addons/form_builder/hooks/pages/page_content.override.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'addons/form_builder/hooks/pages/page_content.override.tpl', 1, false),array('modifier', 'fn_get_all_states', 'addons/form_builder/hooks/pages/page_content.override.tpl', 1, false),array('modifier', 'unescape', 'addons/form_builder/hooks/pages/page_content.override.tpl', 20, false),array('modifier', 'replace', 'addons/form_builder/hooks/pages/page_content.override.tpl', 49, false),array('modifier', 'fn_url', 'addons/form_builder/hooks/pages/page_content.override.tpl', 49, false),array('modifier', 'md5', 'addons/form_builder/hooks/pages/page_content.override.tpl', 87, false),array('modifier', 'date_format', 'addons/form_builder/hooks/pages/page_content.override.tpl', 147, false),array('modifier', 'fn_get_simple_countries', 'addons/form_builder/hooks/pages/page_content.override.tpl', 196, false),array('modifier', 'escape', 'addons/form_builder/hooks/pages/page_content.override.tpl', 208, false),array('modifier', 'cat', 'addons/form_builder/hooks/pages/page_content.override.tpl', 266, false),array('modifier', 'trim', 'addons/form_builder/hooks/pages/page_content.override.tpl', 297, false),array('modifier', 'count', 'addons/form_builder/hooks/pages/page_content.override.tpl', 299, false),array('modifier', 'fn_needs_image_verification', 'addons/form_builder/hooks/pages/page_content.override.tpl', 343, false),array('modifier', 'uniqid', 'addons/form_builder/hooks/pages/page_content.override.tpl', 346, false),array('block', 'hook', 'addons/form_builder/hooks/pages/page_content.override.tpl', 18, false),array('function', 'split', 'addons/form_builder/hooks/pages/page_content.override.tpl', 118, false),array('function', 'math', 'addons/form_builder/hooks/pages/page_content.override.tpl', 163, false),array('function', 'script', 'addons/form_builder/hooks/pages/page_content.override.tpl', 239, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('continue','delete','select','calendar','calendar','weekday_abr_0','weekday_abr_1','weekday_abr_2','weekday_abr_3','weekday_abr_4','weekday_abr_5','weekday_abr_6','month_name_abr_1','month_name_abr_2','month_name_abr_3','month_name_abr_4','month_name_abr_5','month_name_abr_6','month_name_abr_7','month_name_abr_8','month_name_abr_9','month_name_abr_10','month_name_abr_11','month_name_abr_12','confirm','select_country','select_state','upload_another_file','upload_file','remove_this_item','remove_this_item','remove_this_item','remove_this_item','upload_another_file','upload_file','or','specify_url','image_verification_label','image_verification_body','submit','delete'));
?>
<?php 

				$rname = !empty($resource_name) ? $resource_name : $params['smarty_include_tpl_file'];
				if ($this->compile_check && empty($inline_no_check[$rname]) && $this->is_cached($rname)) {
					if ($this->check_inline_blocks(array (
  'buttons/button.tpl' => 1372320684,
))) {
						$_smarty_compile_path = $this->_get_compile_path($rname);
						$this->_compile_resource($rname, $_smarty_compile_path);
						$inline_no_check[$rname] = true;
						include $_smarty_compile_path;
						return;
					}
				}
			 ?><?php if ($this->_tpl_vars['page']['page_type'] == @PAGE_TYPE_FORM): ?>
	<?php if ($this->_tpl_vars['_REQUEST']['sent'] == 'Y'): ?>

		<?php $this->_tag_stack[] = array('hook', array('name' => "pages:form_sent")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>		
		<?php $this->assign('form_submit_const', @FORM_SUBMIT, false); ?>
		<p><?php echo smarty_modifier_unescape($this->_tpl_vars['page']['form']['general'][$this->_tpl_vars['form_submit_const']]); ?>
</p>
		<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

		<p class="center">
		<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('but_text' => fn_get_lang_var('continue', $this->getLanguage()), 'but_href' => smarty_modifier_default(@$this->_tpl_vars['continue_url'], @$this->_tpl_vars['index_script']), 'but_role' => 'action', )); ?>

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
		</p>
	<?php else: ?>

	<?php echo smarty_modifier_unescape($this->_tpl_vars['page']['description']); ?>

	<p>&nbsp;</p>

<div class="form-wrap form-wrap-default">
	<div class="form-wrap-l"></div>
	<div class="form-wrap-r"></div>
	<form action="<?php echo fn_url(""); ?>
" method="post" name="forms_form" enctype="multipart/form-data">
	<input type="hidden" name="fake" value="1" />
	<input type="hidden" name="page_id" value="<?php echo $this->_tpl_vars['page']['page_id']; ?>
" />

	<?php $_from = $this->_tpl_vars['page']['form']['elements']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['element_id'] => $this->_tpl_vars['element']):
?>

	<?php if ($this->_tpl_vars['element']['element_type'] == @FORM_SEPARATOR): ?>
	<hr width="100%" />
	<?php elseif ($this->_tpl_vars['element']['element_type'] == @FORM_HEADER): ?>

	<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/subheader.tpl", 'smarty_include_vars' => array('title' => $this->_tpl_vars['element']['description'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

	<?php elseif ($this->_tpl_vars['element']['element_type'] != @FORM_IP_ADDRESS && $this->_tpl_vars['element']['element_type'] != @FORM_REFERER): ?>
		<div class="form-field">
			<label for="<?php if ($this->_tpl_vars['element']['element_type'] == @FORM_FILE): ?>type_<?php echo md5("fb_files[".($this->_tpl_vars['element']['element_id'])."]"); ?>
<?php else: ?>elm_<?php echo $this->_tpl_vars['element']['element_id']; ?>
<?php endif; ?>" class="<?php if ($this->_tpl_vars['element']['required'] == 'Y'): ?>cm-required<?php endif; ?><?php if ($this->_tpl_vars['element']['element_type'] == @FORM_EMAIL): ?> cm-email<?php endif; ?><?php if ($this->_tpl_vars['element']['element_type'] == @FORM_PHONE): ?> cm-phone<?php endif; ?><?php if ($this->_tpl_vars['element']['element_type'] == @FORM_EMAIL_CONFIRM): ?> cm-confirm-email<?php endif; ?> <?php if ($this->_tpl_vars['element']['element_type'] == @FORM_COUNTRIES): ?> cm-location-billing cm-country <?php endif; ?> <?php if ($this->_tpl_vars['element']['element_type'] == @FORM_STATES): ?> cm-location-billing cm-state <?php endif; ?> <?php if ($this->_tpl_vars['element']['element_type'] == @FORM_MULTIPLE_CB): ?>cm-multiple-checkboxes<?php endif; ?>"><?php echo $this->_tpl_vars['element']['description']; ?>
</label>

			<?php if ($this->_tpl_vars['element']['element_type'] == @FORM_SELECT): ?>
				<select id="elm_<?php echo $this->_tpl_vars['element']['element_id']; ?>
" name="form_values[<?php echo $this->_tpl_vars['element']['element_id']; ?>
]">
				<option label="" value="">- <?php echo fn_get_lang_var('select', $this->getLanguage()); ?>
 -</option>
				<?php $_from = $this->_tpl_vars['element']['variants']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['var']):
?>
				<option value="<?php echo $this->_tpl_vars['var']['element_id']; ?>
" <?php if ($this->_tpl_vars['form_values'][$this->_tpl_vars['element_id']] == $this->_tpl_vars['var']['element_id']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['var']['description']; ?>
</option>
				<?php endforeach; endif; unset($_from); ?>
				</select>
				
				
			<?php elseif ($this->_tpl_vars['element']['element_type'] == @FORM_RADIO): ?>
				<?php $_from = $this->_tpl_vars['element']['variants']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['rd'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['rd']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['var']):
        $this->_foreach['rd']['iteration']++;
?>
				<input class="radio" <?php if (( ! $this->_tpl_vars['form_values'] && $this->_foreach['rd']['iteration'] == 1 ) || ( $this->_tpl_vars['form_values'][$this->_tpl_vars['element_id']] == $this->_tpl_vars['var']['element_id'] )): ?>checked="checked"<?php endif; ?> type="radio" name="form_values[<?php echo $this->_tpl_vars['element']['element_id']; ?>
]" value="<?php echo $this->_tpl_vars['var']['element_id']; ?>
" />&nbsp;<?php echo $this->_tpl_vars['var']['description']; ?>
&nbsp;&nbsp;
				<?php endforeach; endif; unset($_from); ?>
				
				
			<?php elseif ($this->_tpl_vars['element']['element_type'] == @FORM_CHECKBOX): ?>
				<input type="hidden" name="form_values[<?php echo $this->_tpl_vars['element']['element_id']; ?>
]" value="N" />
				<input id="elm_<?php echo $this->_tpl_vars['element']['element_id']; ?>
" class="checkbox" <?php if ($this->_tpl_vars['form_values'][$this->_tpl_vars['element_id']] == 'Y'): ?>checked="checked"<?php endif; ?> type="checkbox" name="form_values[<?php echo $this->_tpl_vars['element']['element_id']; ?>
]" value="Y" />
				
				
			<?php elseif ($this->_tpl_vars['element']['element_type'] == @FORM_MULTIPLE_SB): ?>
				<select id="elm_<?php echo $this->_tpl_vars['element']['element_id']; ?>
" name="form_values[<?php echo $this->_tpl_vars['element']['element_id']; ?>
][]" multiple="multiple" >
				<?php $_from = $this->_tpl_vars['element']['variants']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['var']):
?>
				<option value="<?php echo $this->_tpl_vars['var']['element_id']; ?>
" <?php if ($this->_tpl_vars['form_values'][$this->_tpl_vars['element_id']] == $this->_tpl_vars['var']['element_id']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['var']['description']; ?>
</option>
				<?php endforeach; endif; unset($_from); ?>
				</select>
				
				
			<?php elseif ($this->_tpl_vars['element']['element_type'] == @FORM_MULTIPLE_CB): ?>
				<?php echo smarty_function_split(array('data' => $this->_tpl_vars['element']['variants'],'size' => '4','assign' => 'splitted_variants'), $this);?>

				<table cellpadding="0" cellspacing="0" border="0">
				<?php $_from = $this->_tpl_vars['splitted_variants']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['variants']):
?>
				<tr>
					<?php $_from = $this->_tpl_vars['variants']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['var']):
?>
					<td>
						<?php if ($this->_tpl_vars['var']): ?><input class="form-checkbox" type="checkbox" <?php if ($this->_tpl_vars['form_values'][$this->_tpl_vars['element_id']] == $this->_tpl_vars['var']['element_id']): ?>checked="checked"<?php endif; ?> id="elm_<?php echo $this->_tpl_vars['element']['element_id']; ?>
_<?php echo $this->_tpl_vars['var']['element_id']; ?>
" name="form_values[<?php echo $this->_tpl_vars['element']['element_id']; ?>
][]" value="<?php echo $this->_tpl_vars['var']['element_id']; ?>
" />&nbsp;<?php echo $this->_tpl_vars['var']['description']; ?>
&nbsp;&nbsp;&nbsp;<?php else: ?>&nbsp;<?php endif; ?>
					</td>
					<?php endforeach; endif; unset($_from); ?>
				</tr>
				<?php endforeach; endif; unset($_from); ?>
				</table>
				
				
			<?php elseif ($this->_tpl_vars['element']['element_type'] == @FORM_INPUT): ?>
				<input id="elm_<?php echo $this->_tpl_vars['element']['element_id']; ?>
" class="input-text" size="50" type="text" name="form_values[<?php echo $this->_tpl_vars['element']['element_id']; ?>
]" value="<?php echo $this->_tpl_vars['form_values'][$this->_tpl_vars['element_id']]; ?>
" />
				
				
			<?php elseif ($this->_tpl_vars['element']['element_type'] == @FORM_TEXTAREA): ?>
				<textarea id="elm_<?php echo $this->_tpl_vars['element']['element_id']; ?>
" class="input-textarea" name="form_values[<?php echo $this->_tpl_vars['element']['element_id']; ?>
]" cols="67" rows="10"><?php echo $this->_tpl_vars['form_values'][$this->_tpl_vars['element_id']]; ?>
</textarea>
				
				
			<?php elseif ($this->_tpl_vars['element']['element_type'] == @FORM_DATE): ?>
				<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('date_name' => "form_values[".($this->_tpl_vars['element']['element_id'])."]", 'date_id' => "elm_".($this->_tpl_vars['element']['element_id']), 'date_val' => $this->_tpl_vars['form_values'][$this->_tpl_vars['element_id']], )); ?><?php if ($this->_tpl_vars['settings']['Appearance']['calendar_date_format'] == 'month_first'): ?>
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
			
				
			<?php elseif ($this->_tpl_vars['element']['element_type'] == @FORM_EMAIL || $this->_tpl_vars['element']['element_type'] == @FORM_NUMBER || $this->_tpl_vars['element']['element_type'] == @FORM_PHONE || $this->_tpl_vars['element']['element_type'] == @FORM_EMAIL_CONFIRM): ?>
				
				
				<?php if ($this->_tpl_vars['element']['element_type'] == @FORM_EMAIL || $this->_tpl_vars['element']['element_type'] == @FORM_EMAIL_CONFIRM): ?>
				<input type="hidden" name="customer_email" value="<?php echo $this->_tpl_vars['element']['element_id']; ?>
" />
				<?php endif; ?>
				<input id="elm_<?php echo $this->_tpl_vars['element']['element_id']; ?>
" class="input-text<?php if ($this->_tpl_vars['element']['element_type'] == @FORM_EMAIL_CONFIRM): ?>-medium<?php endif; ?>" size="50" type="text" name="form_values[<?php echo $this->_tpl_vars['element']['element_id']; ?>
]" value="<?php echo $this->_tpl_vars['form_values'][$this->_tpl_vars['element_id']]; ?>
" />
				
				<?php if ($this->_tpl_vars['element']['element_type'] == @FORM_EMAIL_CONFIRM): ?>
				<?php echo fn_get_lang_var('confirm', $this->getLanguage()); ?>
: <input id="confirm_elm_<?php echo $this->_tpl_vars['element']['element_id']; ?>
" class="input-text-medium" type="text" name="" value="" />
				<?php endif; ?>
				
				
			<?php elseif ($this->_tpl_vars['element']['element_type'] == @FORM_COUNTRIES): ?>
				<select id="elm_<?php echo $this->_tpl_vars['element']['element_id']; ?>
" name="form_values[<?php echo $this->_tpl_vars['element']['element_id']; ?>
]" class="cm-location-billing">
					<option value="">- <?php echo fn_get_lang_var('select_country', $this->getLanguage()); ?>
 -</option>
					<?php $this->assign('countries', fn_get_simple_countries(1), false); ?>
					<?php $_from = $this->_tpl_vars['countries']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ccode'] => $this->_tpl_vars['country']):
?>
					<option value="<?php echo $this->_tpl_vars['ccode']; ?>
" <?php if (( $this->_tpl_vars['form_values'][$this->_tpl_vars['elm_id']] && $this->_tpl_vars['form_values'][$this->_tpl_vars['elm_id']] == $this->_tpl_vars['ccode'] ) || ( ! $this->_tpl_vars['form_values'] && $this->_tpl_vars['ccode'] == $this->_tpl_vars['settings']['General']['default_country'] )): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['country']; ?>
</option>
					<?php endforeach; endif; unset($_from); ?>
				</select>
				
				
			<?php elseif ($this->_tpl_vars['element']['element_type'] == @FORM_STATES): ?>

				<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('states' => fn_get_all_states(@CART_LANGUAGE, false, true), )); ?><script type="text/javascript">
//<![CDATA[

var default_country = '<?php echo smarty_modifier_escape($this->_tpl_vars['settings']['General']['default_country'], 'javascript'); ?>
';

<?php echo '
var zip_validators = {
	US: {
		regex: /^(\\d{5})(-\\d{4})?$/,
		format: \'01342 (01342-5678)\'
	},
	CA: {
		regex: /^(\\w{3} ?\\w{3})$/,
		format: \'K1A OB1 (K1AOB1)\'
	},
	RU: {
		regex: /^(\\d{6})?$/,
		format: \'123456\'
	}
}
'; ?>


var states = new Array();
<?php if ($this->_tpl_vars['states']): ?>
<?php $_from = $this->_tpl_vars['states']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['country_code'] => $this->_tpl_vars['country_states']):
?>
states['<?php echo $this->_tpl_vars['country_code']; ?>
'] = new Array();
<?php $_from = $this->_tpl_vars['country_states']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['fs'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['fs']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['state']):
        $this->_foreach['fs']['iteration']++;
?>
states['<?php echo $this->_tpl_vars['country_code']; ?>
']['__<?php echo smarty_modifier_escape($this->_tpl_vars['state']['code'], 'quotes'); ?>
'] = '<?php echo smarty_modifier_escape($this->_tpl_vars['state']['state'], 'javascript'); ?>
';
<?php endforeach; endif; unset($_from); ?>
<?php endforeach; endif; unset($_from); ?>
<?php endif; ?>

//]]>
</script>
<?php echo smarty_function_script(array('src' => "js/profiles_scripts.js"), $this);?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>

				<select id="elm_<?php echo $this->_tpl_vars['element']['element_id']; ?>
" name="form_values[<?php echo $this->_tpl_vars['element']['element_id']; ?>
]">
					<option label="" value="">- <?php echo fn_get_lang_var('select_state', $this->getLanguage()); ?>
 -</option>
				</select>
				<input type="text" class="input-text hidden" id="elm_<?php echo $this->_tpl_vars['element']['element_id']; ?>
_d" name="form_values[<?php echo $this->_tpl_vars['element']['element_id']; ?>
]" size="32" maxlength="64" value="<?php echo $this->_tpl_vars['form_values'][$this->_tpl_vars['elm_id']]; ?>
" disabled="disabled" />
				<input type="hidden" id="elm_<?php echo $this->_tpl_vars['element']['element_id']; ?>
_default" value="<?php echo $this->_tpl_vars['form_values'][$this->_tpl_vars['elm_id']]; ?>
" />
			
			<?php elseif ($this->_tpl_vars['element']['element_type'] == @FORM_FILE): ?>
				<?php echo smarty_function_script(array('src' => "js/fileuploader_scripts.js"), $this);?>

				<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('var_name' => "fb_files[".($this->_tpl_vars['element']['element_id'])."]", )); ?><?php 

				$rname = !empty($resource_name) ? $resource_name : $params['smarty_include_tpl_file'];
				if ($this->compile_check && empty($inline_no_check[$rname]) && $this->is_cached($rname)) {
					if ($this->check_inline_blocks(array (
  'addons/product_configurator/hooks/fileuploader/uploaded_files.post.tpl' => 1367063836,
))) {
						$_smarty_compile_path = $this->_get_compile_path($rname);
						$this->_compile_resource($rname, $_smarty_compile_path);
						$inline_no_check[$rname] = true;
						include $_smarty_compile_path;
						return;
					}
				}
			 ?><?php echo smarty_function_script(array('src' => "js/fileuploader_scripts.js"), $this);?>

<?php echo smarty_function_script(array('src' => "js/node_cloning.js"), $this);?>


<?php $this->assign('id_var_name', md5(smarty_modifier_cat($this->_tpl_vars['prefix'], $this->_tpl_vars['var_name'])), false); ?>

<script type="text/javascript">
	var id_var_name = "<?php echo $this->_tpl_vars['id_var_name']; ?>
";
	var label_id = "<?php echo $this->_tpl_vars['label_id']; ?>
";
	
	if (typeof(custom_labels) == "undefined") <?php echo $this->_tpl_vars['ldelim']; ?>

		custom_labels = <?php echo $this->_tpl_vars['ldelim']; ?>
<?php echo $this->_tpl_vars['rdelim']; ?>
;
	<?php echo $this->_tpl_vars['rdelim']; ?>

	
	custom_labels[id_var_name] = <?php echo $this->_tpl_vars['ldelim']; ?>
<?php echo $this->_tpl_vars['rdelim']; ?>
;
	custom_labels[id_var_name]['upload_another_file'] = "<?php echo smarty_modifier_default(@$this->_tpl_vars['upload_another_file_text'], fn_get_lang_var('upload_another_file', $this->getLanguage())); ?>
";
	custom_labels[id_var_name]['upload_file'] = "<?php echo smarty_modifier_default(@$this->_tpl_vars['upload_file_text'], fn_get_lang_var('upload_file', $this->getLanguage())); ?>
";
</script>

<div class="fileuploader">
<input type="hidden" id="<?php echo $this->_tpl_vars['label_id']; ?>
" value="<?php if ($this->_tpl_vars['images']): ?><?php echo $this->_tpl_vars['id_var_name']; ?>
<?php endif; ?>" />

<?php $_from = $this->_tpl_vars['images']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['image_id'] => $this->_tpl_vars['image']):
?>
	<div class="upload-file-section cm-uploaded-image" id="message_<?php echo $this->_tpl_vars['id_var_name']; ?>
_<?php echo $this->_tpl_vars['image']['file']; ?>
" title="">
		<p class="cm-fu-file">
			<?php $this->_tag_stack[] = array('hook', array('name' => "fileuploader:links")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
				<?php if ($this->_tpl_vars['image']['location'] == 'cart'): ?>
					<?php $this->assign('delete_link', "checkout.delete_file?cart_id=".($this->_tpl_vars['id'])."&amp;option_id=".($this->_tpl_vars['po']['option_id'])."&amp;file=".($this->_tpl_vars['image_id'])."&amp;redirect_mode=cart", false); ?>
					<?php $this->assign('download_link', "checkout.get_custom_file?cart_id=".($this->_tpl_vars['id'])."&amp;option_id=".($this->_tpl_vars['po']['option_id'])."&amp;file=".($this->_tpl_vars['image_id']), false); ?>
				<?php endif; ?>
			<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
			<?php if ($this->_tpl_vars['image']['is_image']): ?>
				<a href="<?php echo fn_url($this->_tpl_vars['image']['detailed']); ?>
"><img src="<?php echo fn_url($this->_tpl_vars['image']['thumbnail']); ?>
" border="0" /></a><br />
			<?php endif; ?>
			
			<?php if ($this->_tpl_vars['addons']['wishlist']['status'] == 'A'): ?><?php ob_start(); $this->_in_capture[] = '83b6acf0648f541535426f7b17d398b9';
$_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/wishlist/hooks/fileuploader/uploaded_files.override.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
$this->_tpl_vars['addon_content'] = ob_get_contents(); ob_end_clean(); array_pop($this->_in_capture); if (!empty($this->_scripts['83b6acf0648f541535426f7b17d398b9'])) { echo implode("\n", $this->_scripts['83b6acf0648f541535426f7b17d398b9']); unset($this->_scripts['83b6acf0648f541535426f7b17d398b9']); }
 ?><?php else: ?><?php $this->assign('addon_content', "", false); ?><?php endif; ?><?php if (trim($this->_tpl_vars['addon_content'])): ?><?php echo $this->_tpl_vars['addon_content']; ?>
<?php else: ?><?php $this->_tag_stack[] = array('hook', array('name' => "fileuploader:uploaded_files")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
				<?php if ($this->_tpl_vars['delete_link']): ?>
				<a class="cm-ajax" href="<?php echo fn_url($this->_tpl_vars['delete_link']); ?>
"><?php endif; ?><?php if (! ( $this->_tpl_vars['po']['required'] == 'Y' && count($this->_tpl_vars['images']) == 1 )): ?><img src="<?php echo $this->_tpl_vars['images_dir']; ?>
/icons/icon_delete.gif" width="12" height="12" border="0" hspace="3" id="clean_selection_<?php echo $this->_tpl_vars['id_var_name']; ?>
_<?php echo $this->_tpl_vars['image']['file']; ?>
" alt="<?php echo fn_get_lang_var('remove_this_item', $this->getLanguage()); ?>
" title="<?php echo fn_get_lang_var('remove_this_item', $this->getLanguage()); ?>
" onclick="fileuploader.clean_selection(this.id); <?php if ($this->_tpl_vars['multiupload'] != 'Y'): ?>fileuploader.toggle_links('<?php echo $this->_tpl_vars['id_var_name']; ?>
', 'show');<?php endif; ?> fileuploader.check_required_field('<?php echo $this->_tpl_vars['id_var_name']; ?>
', '<?php echo $this->_tpl_vars['label_id']; ?>
');" class="hand valign" /><?php endif; ?><?php if ($this->_tpl_vars['delete_link']): ?></a><?php endif; ?><span class="filename-link"><?php if ($this->_tpl_vars['download_link']): ?><a href="<?php echo fn_url($this->_tpl_vars['download_link']); ?>
"><?php endif; ?><?php echo $this->_tpl_vars['image']['name']; ?>
<?php if ($this->_tpl_vars['download_link']): ?></a><?php endif; ?></span>
			<?php if ($this->_tpl_vars['addons']['product_configurator']['status'] == 'A'): ?><?php $__parent_tpl_vars = $this->_tpl_vars; ?><?php if ($this->_tpl_vars['edit_configuration']): ?>
	<input type="hidden" name="<?php echo $this->_tpl_vars['name']; ?>
[custom_files][uploaded][<?php echo $this->_tpl_vars['image']['file']; ?>
][product_id]" value="<?php echo $this->_tpl_vars['product']['product_id']; ?>
" />
	<input type="hidden" name="<?php echo $this->_tpl_vars['name']; ?>
[custom_files][uploaded][<?php echo $this->_tpl_vars['image']['file']; ?>
][option_id]" value="<?php echo $this->_tpl_vars['po']['option_id']; ?>
" />
	<input type="hidden" name="<?php echo $this->_tpl_vars['name']; ?>
[custom_files][uploaded][<?php echo $this->_tpl_vars['image']['file']; ?>
][name]" value="<?php echo $this->_tpl_vars['image']['name']; ?>
" />
	<input type="hidden" name="<?php echo $this->_tpl_vars['name']; ?>
[custom_files][uploaded][<?php echo $this->_tpl_vars['image']['file']; ?>
][path]" value="<?php echo $this->_tpl_vars['image']['file']; ?>
" />
<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php endif; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php endif; ?>
		</p>
	</div>
<?php endforeach; endif; unset($_from); ?>

<div class="nowrap ie7-inline" id="file_uploader_<?php echo $this->_tpl_vars['id_var_name']; ?>
">
	<div class="upload-file-section" id="message_<?php echo $this->_tpl_vars['id_var_name']; ?>
" title="">
		<p class="cm-fu-file hidden"><img src="<?php echo $this->_tpl_vars['images_dir']; ?>
/icons/icon_delete.gif" width="12" height="12" border="0" hspace="3" id="clean_selection_<?php echo $this->_tpl_vars['id_var_name']; ?>
" alt="<?php echo fn_get_lang_var('remove_this_item', $this->getLanguage()); ?>
" title="<?php echo fn_get_lang_var('remove_this_item', $this->getLanguage()); ?>
" onclick="fileuploader.clean_selection(this.id); <?php if ($this->_tpl_vars['multiupload'] != 'Y'): ?>fileuploader.toggle_links(this.id, 'show');<?php endif; ?> fileuploader.check_required_field('<?php echo $this->_tpl_vars['id_var_name']; ?>
', '<?php echo $this->_tpl_vars['label_id']; ?>
');" class="hand valign" /><span class="filename-link"></span></p>
	</div>
	
	<?php echo '<div class="select-field upload-file-links '; ?><?php if ($this->_tpl_vars['multiupload'] != 'Y' && $this->_tpl_vars['images']): ?><?php echo 'hidden'; ?><?php endif; ?><?php echo '" id="link_container_'; ?><?php echo $this->_tpl_vars['id_var_name']; ?><?php echo '"><input type="hidden" name="file_'; ?><?php echo $this->_tpl_vars['var_name']; ?><?php echo '" value="'; ?><?php if ($this->_tpl_vars['image_name']): ?><?php echo ''; ?><?php echo $this->_tpl_vars['image_name']; ?><?php echo ''; ?><?php endif; ?><?php echo '" id="file_'; ?><?php echo $this->_tpl_vars['id_var_name']; ?><?php echo '" /><input type="hidden" name="type_'; ?><?php echo $this->_tpl_vars['var_name']; ?><?php echo '" value="'; ?><?php if ($this->_tpl_vars['image_name']): ?><?php echo 'local'; ?><?php endif; ?><?php echo '" id="type_'; ?><?php echo $this->_tpl_vars['id_var_name']; ?><?php echo '" /><div class="upload-file-local"><input type="file" name="file_'; ?><?php echo $this->_tpl_vars['var_name']; ?><?php echo '" id="_local_'; ?><?php echo $this->_tpl_vars['id_var_name']; ?><?php echo '" onchange="fileuploader.show_loader(this.id); '; ?><?php if ($this->_tpl_vars['multiupload'] == 'Y'): ?><?php echo 'fileuploader.check_image(this.id);'; ?><?php else: ?><?php echo 'fileuploader.toggle_links(this.id, \'hide\');'; ?><?php endif; ?><?php echo ' fileuploader.check_required_field(\''; ?><?php echo $this->_tpl_vars['id_var_name']; ?><?php echo '\', \''; ?><?php echo $this->_tpl_vars['label_id']; ?><?php echo '\');" onclick="$(this).removeAttr(\'value\');" value="" /><a id="local_'; ?><?php echo $this->_tpl_vars['id_var_name']; ?><?php echo '">'; ?><?php if ($this->_tpl_vars['images']): ?><?php echo ''; ?><?php echo smarty_modifier_default(@$this->_tpl_vars['upload_another_file_text'], fn_get_lang_var('upload_another_file', $this->getLanguage())); ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php echo smarty_modifier_default(@$this->_tpl_vars['upload_file_text'], fn_get_lang_var('upload_file', $this->getLanguage())); ?><?php echo ''; ?><?php endif; ?><?php echo '</a></div>'; ?><?php if ($this->_tpl_vars['allow_url_uploading']): ?><?php echo '&nbsp;'; ?><?php echo fn_get_lang_var('or', $this->getLanguage()); ?><?php echo '&nbsp;<a onclick="fileuploader.show_loader(this.id); '; ?><?php if ($this->_tpl_vars['multiupload'] == 'Y'): ?><?php echo 'fileuploader.check_image(this.id);'; ?><?php else: ?><?php echo 'fileuploader.toggle_links(this.id, \'hide\');'; ?><?php endif; ?><?php echo ' fileuploader.check_required_field(\''; ?><?php echo $this->_tpl_vars['id_var_name']; ?><?php echo '\', \''; ?><?php echo $this->_tpl_vars['label_id']; ?><?php echo '\');" id="url_'; ?><?php echo $this->_tpl_vars['id_var_name']; ?><?php echo '">'; ?><?php echo fn_get_lang_var('specify_url', $this->getLanguage()); ?><?php echo '</a>'; ?><?php endif; ?><?php echo ''; ?><?php if ($this->_tpl_vars['hidden_name']): ?><?php echo '<input type="hidden" name="'; ?><?php echo $this->_tpl_vars['hidden_name']; ?><?php echo '" value="'; ?><?php echo $this->_tpl_vars['hidden_value']; ?><?php echo '">'; ?><?php endif; ?><?php echo '</div>'; ?>

</div>

</div><!--fileuploader--><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
			<?php endif; ?>

			<?php $this->_tag_stack[] = array('hook', array('name' => "pages:form_elements")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
			<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
		</div>
	<?php endif; ?>
	<?php endforeach; endif; unset($_from); ?>
	<?php if ($this->_tpl_vars['settings']['Image_verification']['use_for_form_builder'] == 'Y'): ?>
		<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('id' => "forms_".($this->_tpl_vars['page']['page_id']), )); ?><?php if (fn_needs_image_verification("") == true): ?>	
	<?php $this->assign('is', $this->_tpl_vars['settings']['Image_verification'], false); ?>
	
	<?php $this->assign('id_uniqid', uniqid($this->_tpl_vars['id']), false); ?>
	<div class="captcha form-field">
	<?php if ($this->_tpl_vars['sidebox']): ?>
		<p><img id="verification_image_<?php echo $this->_tpl_vars['id']; ?>
" class="image-captcha valign" src="<?php echo fn_url("image.captcha?verification_id=".($this->_tpl_vars['SESS_ID']).":".($this->_tpl_vars['id'])."&amp;".($this->_tpl_vars['id_uniqid'])."&amp;", 'C', 'rel', '&amp;'); ?>
" alt="" onclick="this.src += 'reload' ;" width="<?php echo $this->_tpl_vars['is']['width']; ?>
" height="<?php echo $this->_tpl_vars['is']['height']; ?>
" /></p>
	<?php endif; ?>
		<label for="verification_answer_<?php echo $this->_tpl_vars['id']; ?>
" class="cm-required"><?php echo fn_get_lang_var('image_verification_label', $this->getLanguage()); ?>
</label>
		<input class="captcha-input-text valign cm-autocomplete-off" type="text" id="verification_answer_<?php echo $this->_tpl_vars['id']; ?>
" name="verification_answer" value= "" />
	<?php if (! $this->_tpl_vars['sidebox']): ?>
		<img id="verification_image_<?php echo $this->_tpl_vars['id']; ?>
" class="image-captcha valign" src="<?php echo fn_url("image.captcha?verification_id=".($this->_tpl_vars['SESS_ID']).":".($this->_tpl_vars['id'])."&amp;".($this->_tpl_vars['id_uniqid'])."&amp;", 'C', 'rel', '&amp;'); ?>
" alt="" onclick="this.src += 'reload' ;"  width="<?php echo $this->_tpl_vars['is']['width']; ?>
" height="<?php echo $this->_tpl_vars['is']['height']; ?>
" />
	<?php endif; ?>
	<p<?php if ($this->_tpl_vars['align']): ?> class="<?php echo $this->_tpl_vars['align']; ?>
"<?php endif; ?>><?php echo fn_get_lang_var('image_verification_body', $this->getLanguage()); ?>
</p>
	</div>
<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
	<?php endif; ?>

	<div class="buttons-container">
		<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('but_role' => 'submit', 'but_text' => fn_get_lang_var('submit', $this->getLanguage()), 'but_name' => "dispatch[pages.send_form]", )); ?>

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
	</div>

	</form>
</div>

	<?php if ($this->_tpl_vars['addons']['polls']['status'] == 'A'): ?><?php ob_start(); $this->_in_capture[] = 'ec900a4e059a0f93ab44a359c4d137c9';
$_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/polls/hooks/pages/page_content.override.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
$this->_tpl_vars['addon_content'] = ob_get_contents(); ob_end_clean(); array_pop($this->_in_capture); if (!empty($this->_scripts['ec900a4e059a0f93ab44a359c4d137c9'])) { echo implode("\n", $this->_scripts['ec900a4e059a0f93ab44a359c4d137c9']); unset($this->_scripts['ec900a4e059a0f93ab44a359c4d137c9']); }
 ?><?php else: ?><?php $this->assign('addon_content', "", false); ?><?php endif; ?><?php if (trim($this->_tpl_vars['addon_content'])): ?><?php echo $this->_tpl_vars['addon_content']; ?>
<?php else: ?><?php $this->_tag_stack[] = array('hook', array('name' => "pages:page_content")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php if ($this->_tpl_vars['addons']['tags']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/tags/hooks/pages/page_content.post.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php endif; ?>
	<?php endif; ?>
<?php endif; ?>