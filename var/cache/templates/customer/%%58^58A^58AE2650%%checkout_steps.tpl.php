<?php /* Smarty version 2.6.18, created on 2013-09-03 09:47:34
         compiled from views/checkout/components/checkout_steps.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'views/checkout/components/checkout_steps.tpl', 26, false),array('function', 'script', 'views/checkout/components/checkout_steps.tpl', 57, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('continue','continue','continue','continue','continue','continue','continue','continue','continue','continue','continue','continue'));
?>
<?php 

				$rname = !empty($resource_name) ? $resource_name : $params['smarty_include_tpl_file'];
				if ($this->compile_check && empty($inline_no_check[$rname]) && $this->is_cached($rname)) {
					if ($this->check_inline_blocks(array (
  'views/profiles/components/profiles_scripts.tpl' => 1367063748,
))) {
						$_smarty_compile_path = $this->_get_compile_path($rname);
						$this->_compile_resource($rname, $_smarty_compile_path);
						$inline_no_check[$rname] = true;
						include $_smarty_compile_path;
						return;
					}
				}
			 ?><?php if ($this->_tpl_vars['settings']['General']['checkout_style'] != 'multi_page'): ?>
	<?php $this->assign('ajax_form', "cm-ajax", false); ?>
	<?php $this->assign('ajax_form_force', "cm-ajax-force", false); ?>
<?php else: ?>
	<?php $this->assign('ajax_form', "", false); ?>
	<?php $this->assign('ajax_form_force', "", false); ?>
<?php endif; ?>

<?php $__parent_tpl_vars = $this->_tpl_vars; ?><script type="text/javascript">
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

<?php if ($this->_tpl_vars['settings']['General']['checkout_style'] != 'multi_page'): ?>
	<div class="checkout-steps cm-save-fields clearfix" id="checkout_steps">
		<?php if ($this->_tpl_vars['completed_steps']['step_one'] == true): ?><?php $this->assign('complete', true, false); ?><?php $this->assign('_text', fn_get_lang_var('continue', $this->getLanguage()), false); ?><?php else: ?><?php $this->assign('complete', false, false); ?><?php $this->assign('_text', fn_get_lang_var('continue', $this->getLanguage()), false); ?><?php endif; ?>
		<?php if ($this->_tpl_vars['edit_step'] == 'step_one'): ?><?php $this->assign('edit', true, false); ?><?php else: ?><?php $this->assign('edit', false, false); ?><?php endif; ?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/checkout/components/steps/step_one.tpl", 'smarty_include_vars' => array('step' => 'one','complete' => $this->_tpl_vars['complete'],'edit' => $this->_tpl_vars['edit'],'but_text' => $this->_tpl_vars['_text'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

		<?php if ($this->_tpl_vars['profile_fields']['B'] || $this->_tpl_vars['profile_fields']['S']): ?>
			<?php if ($this->_tpl_vars['completed_steps']['step_two'] == true): ?><?php $this->assign('complete', true, false); ?><?php $this->assign('_text', fn_get_lang_var('continue', $this->getLanguage()), false); ?><?php else: ?><?php $this->assign('complete', false, false); ?><?php $this->assign('_text', fn_get_lang_var('continue', $this->getLanguage()), false); ?><?php endif; ?>
			<?php if ($this->_tpl_vars['edit_step'] == 'step_two'): ?><?php $this->assign('edit', true, false); ?><?php else: ?><?php $this->assign('edit', false, false); ?><?php endif; ?>
			<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/checkout/components/steps/step_two.tpl", 'smarty_include_vars' => array('step' => 'two','complete' => $this->_tpl_vars['complete'],'edit' => $this->_tpl_vars['edit'],'but_text' => $this->_tpl_vars['_text'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<?php endif; ?>

		<?php if ($this->_tpl_vars['completed_steps']['step_three'] == true): ?><?php $this->assign('complete', true, false); ?><?php $this->assign('_text', fn_get_lang_var('continue', $this->getLanguage()), false); ?><?php else: ?><?php $this->assign('complete', false, false); ?><?php $this->assign('_text', fn_get_lang_var('continue', $this->getLanguage()), false); ?><?php endif; ?>
		<?php if ($this->_tpl_vars['edit_step'] == 'step_three'): ?><?php $this->assign('edit', true, false); ?><?php else: ?><?php $this->assign('edit', false, false); ?><?php endif; ?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/checkout/components/steps/step_three.tpl", 'smarty_include_vars' => array('step' => 'three','complete' => $this->_tpl_vars['complete'],'edit' => $this->_tpl_vars['edit'],'but_text' => $this->_tpl_vars['_text'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

		<?php if ($this->_tpl_vars['completed_steps']['step_four'] == true): ?><?php $this->assign('complete', true, false); ?><?php else: ?><?php $this->assign('complete', false, false); ?><?php endif; ?>
		<?php if ($this->_tpl_vars['edit_step'] == 'step_four'): ?><?php $this->assign('edit', true, false); ?><?php else: ?><?php $this->assign('edit', false, false); ?><?php endif; ?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/checkout/components/steps/step_four.tpl", 'smarty_include_vars' => array('step' => 'four','edit' => $this->_tpl_vars['edit'],'complete' => $this->_tpl_vars['complete'],'but_text' => $this->_tpl_vars['_text'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

		<?php echo '
		<script type="text/javascript" language="javascript">
		//<![CDATA[
		$(function(){
			var container = {};
			container = $(\'.error-box-container\');
			
			if (!container.length) {
				container = $(\'.notification-content\');
			}
			if (container.length) {
				$.scrollToElm(container);
			} else {
				$.scrollToElm($(\'.step-container-active\'));
			}
		});
		//]]>
		</script>
		'; ?>

	<!--checkout_steps--></div>
<?php else: ?>
	<?php echo $this->_smarty_vars['capture']['checkout_error_content']; ?>

	
	<?php if ($this->_tpl_vars['edit_step'] == 'step_one'): ?>
		<?php if ($this->_tpl_vars['completed_steps']['step_one'] == true): ?><?php $this->assign('complete', true, false); ?><?php $this->assign('_text', fn_get_lang_var('continue', $this->getLanguage()), false); ?><?php else: ?><?php $this->assign('complete', false, false); ?><?php $this->assign('_text', fn_get_lang_var('continue', $this->getLanguage()), false); ?><?php endif; ?>
		<?php if ($this->_tpl_vars['edit_step'] == 'step_one'): ?><?php $this->assign('edit', true, false); ?><?php else: ?><?php $this->assign('edit', false, false); ?><?php endif; ?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/checkout/components/steps/step_one.tpl", 'smarty_include_vars' => array('complete' => $this->_tpl_vars['complete'],'edit' => $this->_tpl_vars['edit'],'but_text' => $this->_tpl_vars['_text'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		
	<?php elseif ($this->_tpl_vars['edit_step'] == 'step_two'): ?>
		<?php if ($this->_tpl_vars['completed_steps']['step_two'] == true): ?><?php $this->assign('complete', true, false); ?><?php $this->assign('_text', fn_get_lang_var('continue', $this->getLanguage()), false); ?><?php else: ?><?php $this->assign('complete', false, false); ?><?php $this->assign('_text', fn_get_lang_var('continue', $this->getLanguage()), false); ?><?php endif; ?>
		<?php if ($this->_tpl_vars['edit_step'] == 'step_two'): ?><?php $this->assign('edit', true, false); ?><?php else: ?><?php $this->assign('edit', false, false); ?><?php endif; ?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/checkout/components/steps/step_two.tpl", 'smarty_include_vars' => array('complete' => $this->_tpl_vars['complete'],'edit' => $this->_tpl_vars['edit'],'but_text' => $this->_tpl_vars['_text'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			
	<?php elseif ($this->_tpl_vars['edit_step'] == 'step_three'): ?>
		<?php if ($this->_tpl_vars['completed_steps']['step_three'] == true): ?><?php $this->assign('complete', true, false); ?><?php $this->assign('_text', fn_get_lang_var('continue', $this->getLanguage()), false); ?><?php else: ?><?php $this->assign('complete', false, false); ?><?php $this->assign('_text', fn_get_lang_var('continue', $this->getLanguage()), false); ?><?php endif; ?>
		<?php if ($this->_tpl_vars['edit_step'] == 'step_three'): ?><?php $this->assign('edit', true, false); ?><?php else: ?><?php $this->assign('edit', false, false); ?><?php endif; ?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/checkout/components/steps/step_three.tpl", 'smarty_include_vars' => array('complete' => $this->_tpl_vars['complete'],'edit' => $this->_tpl_vars['edit'],'but_text' => $this->_tpl_vars['_text'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		
	<?php elseif ($this->_tpl_vars['edit_step'] == 'step_four'): ?>
		<?php if ($this->_tpl_vars['completed_steps']['step_four'] == true): ?><?php $this->assign('complete', true, false); ?><?php else: ?><?php $this->assign('complete', false, false); ?><?php endif; ?>
		<?php if ($this->_tpl_vars['edit_step'] == 'step_four'): ?><?php $this->assign('edit', true, false); ?><?php else: ?><?php $this->assign('edit', false, false); ?><?php endif; ?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/checkout/components/steps/step_four.tpl", 'smarty_include_vars' => array('edit' => $this->_tpl_vars['edit'],'complete' => $this->_tpl_vars['complete'],'but_text' => $this->_tpl_vars['_text'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php endif; ?>
<?php endif; ?>