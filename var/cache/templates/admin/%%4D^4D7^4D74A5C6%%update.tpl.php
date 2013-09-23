<?php /* Smarty version 2.6.18, created on 2013-09-23 17:38:43
         compiled from views/statuses/update.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'lower', 'views/statuses/update.tpl', 15, false),array('modifier', 'fn_url', 'views/statuses/update.tpl', 19, false),array('modifier', 'fn_check_form_permissions', 'views/statuses/update.tpl', 19, false),array('modifier', 'default', 'views/statuses/update.tpl', 20, false),array('modifier', 'fn_get_statuses', 'views/statuses/update.tpl', 77, false),array('function', 'html_options', 'views/statuses/update.tpl', 84, false),array('function', 'html_checkboxes', 'views/statuses/update.tpl', 87, false),array('function', 'script', 'views/statuses/update.tpl', 93, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('general','name','status','email_subject','email_header'));
?>
<?php 

				$rname = !empty($resource_name) ? $resource_name : $params['smarty_include_tpl_file'];
				if ($this->compile_check && empty($inline_no_check[$rname]) && $this->is_cached($rname)) {
					if ($this->check_inline_blocks(array (
  'common_templates/colorpicker.tpl' => 1367063753,
))) {
						$_smarty_compile_path = $this->_get_compile_path($rname);
						$this->_compile_resource($rname, $_smarty_compile_path);
						$inline_no_check[$rname] = true;
						include $_smarty_compile_path;
						return;
					}
				}
			 ?><?php $this->assign('st', smarty_modifier_lower($this->_tpl_vars['_REQUEST']['status']), false); ?>

<div id="content_group<?php echo $this->_tpl_vars['st']; ?>
">

<form action="<?php echo fn_url(""); ?>
" method="post" name="update_status_<?php echo $this->_tpl_vars['st']; ?>
_form" class="cm-form-highlight<?php if (fn_check_form_permissions("")): ?> cm-hide-inputs<?php endif; ?>">
<input type="hidden" name="type" value="<?php echo smarty_modifier_default(@$this->_tpl_vars['type'], 'O'); ?>
" />
<input type="hidden" name="status" value="<?php echo $this->_tpl_vars['_REQUEST']['status']; ?>
" />

<div class="tabs cm-j-tabs">
	<ul>
		<li class="cm-js cm-active"><a><?php echo fn_get_lang_var('general', $this->getLanguage()); ?>
</a></li>
	</ul>
</div>

<div class="cm-tabs-content">
<fieldset>
	<div class="form-field">
		<label for="description_<?php echo $this->_tpl_vars['st']; ?>
" class="cm-required"><?php echo fn_get_lang_var('name', $this->getLanguage()); ?>
:</label>
		<input type="text" size="70" id="description_<?php echo $this->_tpl_vars['st']; ?>
" name="status_data[description]" value="<?php echo $this->_tpl_vars['status_data']['description']; ?>
" class="input-text-large main-input" />
	</div>

	<?php if ($this->_tpl_vars['mode'] != 'add'): ?>
		<div class="form-field">
			<label for="status_<?php echo $this->_tpl_vars['st']; ?>
" class="cm-required"><?php echo fn_get_lang_var('status', $this->getLanguage()); ?>
:</label>			
				<input type="hidden" name="status_data[status]" value="<?php echo $this->_tpl_vars['status_data']['status']; ?>
" />
				<span><?php echo $this->_tpl_vars['status_data']['status']; ?>
</span>
		</div>
	<?php endif; ?>

	<div class="form-field">
		<label for="email_subj_<?php echo $this->_tpl_vars['st']; ?>
"><?php echo fn_get_lang_var('email_subject', $this->getLanguage()); ?>
:</label>
		<input type="text" size="40" name="status_data[email_subj]" id="email_subj_<?php echo $this->_tpl_vars['st']; ?>
" value="<?php echo $this->_tpl_vars['status_data']['email_subj']; ?>
" class="input-text-large" />
	</div>

	<div class="form-field">
		<label for="email_header_<?php echo $this->_tpl_vars['st']; ?>
"><?php echo fn_get_lang_var('email_header', $this->getLanguage()); ?>
:</label>
		<textarea id="email_header_<?php echo $this->_tpl_vars['st']; ?>
" name="status_data[email_header]" class="cm-wysiwyg input-textarea-long"><?php echo $this->_tpl_vars['status_data']['email_header']; ?>
</textarea>
		
	</div>

	<?php $_from = $this->_tpl_vars['status_params']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['name'] => $this->_tpl_vars['data']):
?>
		<div class="form-field">
			<label for="status_param_<?php echo $this->_tpl_vars['st']; ?>
_<?php echo $this->_tpl_vars['name']; ?>
"><?php echo fn_get_lang_var($this->_tpl_vars['data']['label'], $this->getLanguage()); ?>
:</label>
			<?php if ($this->_tpl_vars['data']['not_default'] == true && $this->_tpl_vars['status_data']['is_default'] === 'Y'): ?>
				<?php $this->assign('var', $this->_tpl_vars['status_data']['params'][$this->_tpl_vars['name']], false); ?>
				<?php $this->assign('lbl', $this->_tpl_vars['data']['variants'][$this->_tpl_vars['var']], false); ?>
				<span><?php echo fn_get_lang_var($this->_tpl_vars['lbl'], $this->getLanguage()); ?>
</span>
			
			<?php elseif ($this->_tpl_vars['data']['type'] == 'select'): ?>
				<select id="status_param_<?php echo $this->_tpl_vars['st']; ?>
_<?php echo $this->_tpl_vars['name']; ?>
" name="status_data[params][<?php echo $this->_tpl_vars['name']; ?>
]">
					<?php $_from = $this->_tpl_vars['data']['variants']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['v_name'] => $this->_tpl_vars['v_data']):
?>
					<option value="<?php echo $this->_tpl_vars['v_name']; ?>
" <?php if ($this->_tpl_vars['status_data']['params'][$this->_tpl_vars['name']] == $this->_tpl_vars['v_name']): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var($this->_tpl_vars['v_data'], $this->getLanguage()); ?>
</option>
					<?php endforeach; endif; unset($_from); ?>
				</select>
			
			<?php elseif ($this->_tpl_vars['data']['type'] == 'checkbox'): ?>
				<input type="hidden" name="status_data[params][<?php echo $this->_tpl_vars['name']; ?>
]" value="N" />
				<input type="checkbox" name="status_data[params][<?php echo $this->_tpl_vars['name']; ?>
]" id="status_param_<?php echo $this->_tpl_vars['st']; ?>
_<?php echo $this->_tpl_vars['name']; ?>
" value="Y" <?php if ($this->_tpl_vars['status_data']['params'][$this->_tpl_vars['name']] == 'Y' || ( ! $this->_tpl_vars['status_data'] && $this->_tpl_vars['data']['default_value'] == 'Y' )): ?> checked="checked"<?php endif; ?> class="checkbox" />

			<?php elseif ($this->_tpl_vars['data']['type'] == 'status'): ?>
				<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('status' => $this->_tpl_vars['status_data']['params'][$this->_tpl_vars['name']], 'display' => 'select', 'name' => "status_data[params][".($this->_tpl_vars['name'])."]", 'status_type' => $this->_tpl_vars['data']['status_type'], 'select_id' => "status_param_".($this->_tpl_vars['st'])."_".($this->_tpl_vars['name']), )); ?><?php if (! $this->_tpl_vars['order_status_descr']): ?>
	<?php if (! $this->_tpl_vars['status_type']): ?><?php $this->assign('status_type', @STATUSES_ORDER, false); ?><?php endif; ?>
	<?php $this->assign('order_status_descr', fn_get_statuses($this->_tpl_vars['status_type'], true), false); ?>
<?php endif; ?>

<?php echo ''; ?><?php if ($this->_tpl_vars['display'] == 'view'): ?><?php echo ''; ?><?php echo $this->_tpl_vars['order_status_descr'][$this->_tpl_vars['status']]; ?><?php echo ''; ?><?php elseif ($this->_tpl_vars['display'] == 'select'): ?><?php echo ''; ?><?php echo smarty_function_html_options(array('name' => $this->_tpl_vars['name'],'options' => $this->_tpl_vars['order_status_descr'],'selected' => $this->_tpl_vars['status'],'id' => $this->_tpl_vars['select_id']), $this);?><?php echo ''; ?><?php elseif ($this->_tpl_vars['display'] == 'checkboxes'): ?><?php echo '<div>'; ?><?php echo smarty_function_html_checkboxes(array('name' => $this->_tpl_vars['name'],'options' => $this->_tpl_vars['order_status_descr'],'selected' => $this->_tpl_vars['status'],'columns' => smarty_modifier_default(@$this->_tpl_vars['columns'], 4)), $this);?><?php echo '</div>'; ?><?php endif; ?><?php echo ''; ?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>

			<?php elseif ($this->_tpl_vars['data']['type'] == 'color'): ?>
				<?php $__parent_tpl_vars = $this->_tpl_vars; ?><?php echo smarty_function_script(array('src' => "lib/js/colorpicker/js/colorpicker.js"), $this);?>


<script type="text/javascript" class="cm-ajax-force">
//<![CDATA[
<?php echo '
$.loadCss([\'/lib/js/colorpicker/css/colorpicker.css\']);
$(function(){
	$(\'.cm-colorpicker\').each(function() {
		var elm = $(this);
		var id_inut = elm.attr(\'id\').replace(/select_/, \'\');
		var color_input = $(\'#\' + id_inut);

		if (elm.parents(\'.cm-hide-inputs\').length == 0) {
			elm.ColorPicker(
			{
				onSubmit: function(hsb, hex, rgb, el) {
					$(el).css(\'background-color\', \'#\' + hex);
					color_input.val(hex);
					$(el).ColorPickerHide();
				},
				onShow: function (ev) {
					var cal = $(\'#\' + $(this).data(\'colorpickerId\'));
					cal.css({\'z-index\': 1010});
				},
				onBeforeShow: function () {
					$(this).ColorPickerSetColor(color_input.val());
				}
			});
		};

		color_input.bind(\'keyup\', function() {
			var  color = $(this).val();
			elm.ColorPickerSetColor(color);
			elm.css(\'background-color\', \'#\' + color);
		});
		// hide picker on escape
		$(document).keydown(function(e) {
			if (e.keyCode == 27) {
				elm.ColorPickerHide();
			}
		});
	});
});
'; ?>

//]]>
</script><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
				<div class="cm-colorpicker" id="select_status_param_<?php echo $this->_tpl_vars['st']; ?>
_<?php echo $this->_tpl_vars['name']; ?>
" style="background-color: #<?php echo $this->_tpl_vars['status_data']['params'][$this->_tpl_vars['name']]; ?>
"></div><input type="text" size="10" name="status_data[params][<?php echo $this->_tpl_vars['name']; ?>
]" id="status_param_<?php echo $this->_tpl_vars['st']; ?>
_<?php echo $this->_tpl_vars['name']; ?>
" value="<?php echo $this->_tpl_vars['status_data']['params'][$this->_tpl_vars['name']]; ?>
" class="input-text" />

			<?php endif; ?>
		</div>
	<?php endforeach; endif; unset($_from); ?>
</fieldset>
</div>


<div class="buttons-container">
	<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/save_cancel.tpl", 'smarty_include_vars' => array('but_name' => "dispatch[statuses.update]",'cancel_action' => 'close')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>

</form>
<!--content_group<?php echo $this->_tpl_vars['st']; ?>
--></div>