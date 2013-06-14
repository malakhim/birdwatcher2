<?php /* Smarty version 2.6.18, created on 2013-06-14 13:57:33
         compiled from addons/billibuys/views/billibuys/view.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'var_dump', 'addons/billibuys/views/billibuys/view.tpl', 8, false),array('function', 'cycle', 'addons/billibuys/views/billibuys/view.tpl', 22, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('billibuys'));
?>
<?php  ob_start();  ?><div id="bb_submit_form">
	<br/><br/>
	<form id="create" name="create" method="POST" action="/dutchme2/index.php?dispatch=billibuys.view">
		<label for="item_name">Please enter the item you want here:</label>
		<input type="text" id="item_name" name="item_name"/>
		<input type="submit" value="submit" name="submit"/>
	</form>
	<!-- <?php echo var_dump($this->_tpl_vars['requests']); ?>
 -->
</div>


<div id="bb_requests">
	<?php if ($this->_tpl_vars['requests']['success'] == 1): ?>
		<table cellpadding="0" cellspacing="0" width="100%" border="0" class="table">
			<tr>
				<th>Item</th>
				<th>Microseconds since submitted (test)</th>
				<th>Current bid</th>
			</tr>
		<?php $_from = $this->_tpl_vars['requests']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['request']):
?>
			<?php if (is_array ( $this->_tpl_vars['request'] )): ?>
				<tr <?php echo smarty_function_cycle(array('values' => "class=\"table-row\","), $this);?>
>
					<td><?php echo $this->_tpl_vars['request']['description']; ?>
</td>
					<td><?php echo $this->_tpl_vars['request']['timestamp']/60000000; ?>
</td>
					<td><?php if ($this->_tpl_vars['request']['current_bid'] != ''): ?>$<?php echo $this->_tpl_vars['request']['current_bid']; ?>
<?php else: ?>No Bids Yet!<?php endif; ?></td>
				</tr>
			<?php endif; ?>
		<?php endforeach; endif; unset($_from); ?>
		</table>
	<?php else: ?>
		<?php if ($this->_tpl_vars['requests']['message'] == 'no_results'): ?>
			No results found. Please check your search enquiry.
		<?php elseif ($this->_tpl_vars['requests']['message'] == 'user_not_logged_in'): ?>
			Please log in to view your bids!
		<?php else: ?>
			An error has occurred, please contact us at <a href="mailto:webmaster@billibuys.com">webmaster@billibuys.com</a>
		<?php endif; ?>
		
	<?php endif; ?>
</div>
<?php ob_start(); ?>
<!-- This is a test -->

<?php $this->_smarty_vars['capture']['mainbox'] = ob_get_contents(); ob_end_clean(); ?>
<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('title' => fn_get_lang_var('billibuys', $this->getLanguage()), 'content' => $this->_smarty_vars['capture']['mainbox'], 'title_extra' => $this->_smarty_vars['capture']['title_extra'], 'tools' => $this->_smarty_vars['capture']['tools'], )); ?><?php  ob_end_flush();  ?>