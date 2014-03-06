<?php /* Smarty version 2.6.18, created on 2014-03-06 16:41:01
         compiled from addons/billibuys/views/billibuys/view.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'fn_url', 'addons/billibuys/views/billibuys/view.tpl', 1, false),array('modifier', 'replace', 'addons/billibuys/views/billibuys/view.tpl', 65, false),array('function', 'cycle', 'addons/billibuys/views/billibuys/view.tpl', 39, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('bb_text_place_request_question','bb_text_log_in_to_place_request','item','durat_since_start','delete','two_weeks_plus','invalid_date_format','date_nonpositive','text_no_matching_results_found','please_login','bb_error_occurred','view_requests'));
?>
<?php  ob_start();  ?><?php 

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
			 ?><?php if ($this->_tpl_vars['auth']['user_id']): ?>
	<a href="<?php echo fn_url("billibuys.place_request"); ?>
"><?php echo fn_get_lang_var('bb_text_place_request_question', $this->getLanguage()); ?>
</a>
<?php else: ?>
	<a href="<?php echo fn_url("auth.login_form&return_url=billibuys.place_request"); ?>
"><?php echo fn_get_lang_var('bb_text_log_in_to_place_request', $this->getLanguage()); ?>
</a>
<?php endif; ?>
<div id="bb_requests">
	<?php if ($this->_tpl_vars['requests']['success'] == 1): ?>
		<table cellpadding="0" cellspacing="0" width="100%" border="0" class="table">
			<tr>
				<th><?php echo fn_get_lang_var('item', $this->getLanguage()); ?>
</th>
				<th><?php echo fn_get_lang_var('durat_since_start', $this->getLanguage()); ?>
</th>
							</tr>
		<?php $_from = $this->_tpl_vars['requests']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['request']):
?>
			<?php if (is_array ( $this->_tpl_vars['request'] )): ?>
				<tr <?php echo smarty_function_cycle(array('values' => "class=\"table-row\","), $this);?>
>
					<td><?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('but_text' => $this->_tpl_vars['request']['title'], 'but_href' => fn_url("billibuys.request&request_id=".($this->_tpl_vars['request']['bb_request_id'])), 'but_role' => 'text', )); ?>

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
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?></td>
					<td>
						<?php if ($this->_tpl_vars['request']['timestamp']['error'] == 0): ?>
							<?php if ($this->_tpl_vars['request']['timestamp']['msg'] != 'over_two_weeks'): ?>
								<?php echo $this->_tpl_vars['request']['timestamp']['value']; ?>
&nbsp;<?php echo $this->_tpl_vars['request']['timestamp']['unit']; ?>

							<?php else: ?>
								<?php echo fn_get_lang_var('two_weeks_plus', $this->getLanguage()); ?>

							<?php endif; ?>
						<?php else: ?>
							<?php if ($this->_tpl_vars['request']['timestamp']['msg'] == 'invalid_date'): ?>
								<?php echo fn_get_lang_var('invalid_date_format', $this->getLanguage()); ?>

							<?php elseif ($this->_tpl_vars['request']['timestamp']['msg'] == 'nonpositive_value'): ?>
								<?php echo fn_get_lang_var('date_nonpositive', $this->getLanguage()); ?>

							<?php endif; ?>
						<?php endif; ?>
					</td>
									</tr>
			<?php endif; ?>
		<?php endforeach; endif; unset($_from); ?>
		</table>
	<?php else: ?>
	<!-- Need to add in search results-->
		<?php if ($this->_tpl_vars['requests']['message'] == 'no_results'): ?>
			<?php echo fn_get_lang_var('text_no_matching_results_found', $this->getLanguage()); ?>

		<?php elseif ($this->_tpl_vars['requests']['message'] == 'user_not_logged_in'): ?>
			<?php echo fn_get_lang_var('please_login', $this->getLanguage()); ?>

		<?php else: ?>
			<?php echo fn_get_lang_var('bb_error_occurred', $this->getLanguage()); ?>
: <a href="mailto:<?php echo $this->_tpl_vars['settings']['Company']['company_support_department']; ?>
"><?php echo $this->_tpl_vars['settings']['Company']['company_support_department']; ?>
</a>
		<?php endif; ?>
		
	<?php endif; ?>
</div>

<?php ob_start(); ?><?php echo fn_get_lang_var('view_requests', $this->getLanguage()); ?>
<?php $this->_smarty_vars['capture']['mainbox_title'] = ob_get_contents(); ob_end_clean(); ?><?php  ob_end_flush();  ?>