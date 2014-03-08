<?php /* Smarty version 2.6.18, created on 2014-03-08 11:20:55
         compiled from views/languages/components/langvars_search_form.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'fn_url', 'views/languages/components/langvars_search_form.tpl', 17, false),array('function', 'math', 'views/languages/components/langvars_search_form.tpl', 38, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('search_for_pattern','search','search','close'));
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
" name="langvars_search_form" method="get">

<table cellspacing="0" border="0" class="search-header">
<tr>
	<td class="nowrap search-field">
		<label><?php echo fn_get_lang_var('search_for_pattern', $this->getLanguage()); ?>
:</label>
		<div class="break">
			<input type="text" name="q" size="20" value="<?php echo $this->_tpl_vars['_REQUEST']['q']; ?>
" class="search-input-text" />
			<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('search' => 'Y', 'but_name' => "languages.manage", )); ?><input type="hidden" name="dispatch" value="<?php echo $this->_tpl_vars['but_name']; ?>
" />
<input type="image" src="<?php echo $this->_tpl_vars['images_dir']; ?>
/search_go.gif" class="search-go" alt="<?php echo fn_get_lang_var('search', $this->getLanguage()); ?>
" title="<?php echo fn_get_lang_var('search', $this->getLanguage()); ?>
" /><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>&nbsp;
		</div>
	</td>
	<td class="buttons-container">
		<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/search.tpl", 'smarty_include_vars' => array('but_name' => "dispatch[languages.manage]",'but_role' => 'submit')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</td>
</tr>
</table>

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