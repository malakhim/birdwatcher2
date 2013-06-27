<?php /* Smarty version 2.6.18, created on 2013-06-27 18:24:22
         compiled from addons/billibuys/views/billibuys/view.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'addons/billibuys/views/billibuys/view.tpl', 21, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('bb_enter_item','item','durat_since_start','current_bid','bb_heading_bid_history','bb_no_bids','bb_text_view_bid_history','bb_text_place_first_bid','bb_place_bid','text_no_matching_results_found','please_login','bb_error_occurred','billibuys'));
?>
<div id="bb_submit_form">
	<br/><br/>
	<form id="create" name="create" method="POST" action="/dutchme2/index.php?dispatch=billibuys.view">
		<label for="item_name"><?php echo fn_get_lang_var('bb_enter_item', $this->getLanguage()); ?>
:</label>
		<input type="text" id="item_name" name="item_name"/>
		<input type="submit" value="submit" name="submit"/>
	</form>
</div>

<div id="bb_requests">
	<?php if ($this->_tpl_vars['requests']['success'] == 1): ?>
		<table cellpadding="0" cellspacing="0" width="100%" border="0" class="table">
			<tr>
				<th><?php echo fn_get_lang_var('item', $this->getLanguage()); ?>
</th>
				<th><?php echo fn_get_lang_var('durat_since_start', $this->getLanguage()); ?>
</th>
				<th><?php echo fn_get_lang_var('current_bid', $this->getLanguage()); ?>
</th>
				<th><?php echo fn_get_lang_var('bb_heading_bid_history', $this->getLanguage()); ?>
</th>
			</tr>
		<?php $_from = $this->_tpl_vars['requests']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['request']):
?>
			<?php if (is_array ( $this->_tpl_vars['request'] )): ?>
				<tr <?php echo smarty_function_cycle(array('values' => "class=\"table-row\","), $this);?>
>
					<td>
						<?php echo $this->_tpl_vars['request']['description']; ?>

					</td>
					<td>
						<?php echo $this->_tpl_vars['request']['timestamp']; ?>
&nbsp;<?php echo $this->_tpl_vars['request']['duration_unit']; ?>

					</td>
					<td>
						<?php if ($this->_tpl_vars['request']['current_bid'] != ''): ?>$<?php echo $this->_tpl_vars['request']['current_bid']; ?>
<?php else: ?><?php echo fn_get_lang_var('bb_no_bids', $this->getLanguage()); ?>
<?php endif; ?>
					</td>
					<td>
						<?php if ($this->_tpl_vars['request']['current_bid'] != ''): ?><?php echo fn_get_lang_var('bb_text_view_bid_history', $this->getLanguage()); ?>
<?php else: ?><?php echo fn_get_lang_var('bb_text_place_first_bid', $this->getLanguage()); ?>
<?php endif; ?>
					</td>
					<td>
						<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/button_popup.tpl", 'smarty_include_vars' => array('but_href' => "vendor.php?auction=".($this->_tpl_vars['request']['bb_bid_id']),'but_text' => fn_get_lang_var('bb_place_bid', $this->getLanguage()),'but_role' => 'text')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
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
<?php ob_start(); ?>
<!-- This is a test -->

<?php $this->_smarty_vars['capture']['mainbox'] = ob_get_contents(); ob_end_clean(); ?>
<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('title' => fn_get_lang_var('billibuys', $this->getLanguage()), 'content' => $this->_smarty_vars['capture']['mainbox'], 'title_extra' => $this->_smarty_vars['capture']['title_extra'], 'tools' => $this->_smarty_vars['capture']['tools'], )); ?>