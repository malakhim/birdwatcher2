<?php /* Smarty version 2.6.18, created on 2013-07-14 16:49:25
         compiled from common_templates/search.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'fn_url', 'common_templates/search.tpl', 16, false),array('modifier', 'default', 'common_templates/search.tpl', 33, false),array('block', 'hook', 'common_templates/search.tpl', 25, false),array('function', 'math', 'common_templates/search.tpl', 47, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('search','search_products','search','search'));
?>
<?php  ob_start();  ?><?php 

				$rname = !empty($resource_name) ? $resource_name : $params['smarty_include_tpl_file'];
				if ($this->compile_check && empty($inline_no_check[$rname]) && $this->is_cached($rname)) {
					if ($this->check_inline_blocks(array (
  'buttons/magnifier.tpl' => 1367063745,
))) {
						$_smarty_compile_path = $this->_get_compile_path($rname);
						$this->_compile_resource($rname, $_smarty_compile_path);
						$inline_no_check[$rname] = true;
						include $_smarty_compile_path;
						return;
					}
				}
			 ?><div class="search-block">
<form action="<?php echo fn_url(""); ?>
" name="search_form" method="get">
<!-- <input type="hidden" name="subcats" value="Y" />
<input type="hidden" name="status" value="A" />
<input type="hidden" name="pshort" value="Y" />
<input type="hidden" name="pfull" value="Y" />
<input type="hidden" name="pname" value="Y" />
<input type="hidden" name="pkeywords" value="Y" />
<input type="hidden" name="search_performed" value="Y" /> -->

<?php $this->_tag_stack[] = array('hook', array('name' => "search:additional_fields")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

<?php echo ''; ?><?php if ($this->_tpl_vars['settings']['General']['search_objects']): ?><?php echo ''; ?><?php $this->assign('search_title', fn_get_lang_var('search', $this->getLanguage()), false); ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php $this->assign('search_title', fn_get_lang_var('search_products', $this->getLanguage()), false); ?><?php echo ''; ?><?php endif; ?><?php echo '<input type="text" name="q" value="'; ?><?php echo smarty_modifier_default(@$this->_tpl_vars['search']['q'], @$this->_tpl_vars['search_title']); ?><?php echo '" id="search_input'; ?><?php if ($this->_smarty_vars['capture']['search_input_id']): ?><?php echo '_'; ?><?php echo $this->_smarty_vars['capture']['search_input_id']; ?><?php echo ''; ?><?php endif; ?><?php echo '" title="'; ?><?php echo $this->_tpl_vars['search_title']; ?><?php echo '" class="search-input cm-hint"/>'; ?><?php if ($this->_tpl_vars['settings']['General']['search_objects']): ?><?php echo ''; ?><?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('but_name' => "search.results", 'alt' => fn_get_lang_var('search', $this->getLanguage()), )); ?><?php echo '<button title="'; ?><?php echo $this->_tpl_vars['alt']; ?><?php echo '" class="search-magnifier" type="submit"></button><input type="hidden" name="dispatch" value="'; ?><?php echo $this->_tpl_vars['but_name']; ?><?php echo '" />'; ?><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php echo ''; ?><?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('but_name' => "billibuys.view", 'alt' => fn_get_lang_var('search', $this->getLanguage()), )); ?><?php echo '<button title="'; ?><?php echo $this->_tpl_vars['alt']; ?><?php echo '" class="search-magnifier" type="submit"></button><input type="hidden" name="dispatch" value="'; ?><?php echo $this->_tpl_vars['but_name']; ?><?php echo '" />'; ?><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?>


<?php ob_start(); ?><?php echo smarty_function_math(array('equation' => "x + y",'x' => smarty_modifier_default(@$this->_smarty_vars['capture']['search_input_id'], 1),'y' => 1,'assign' => 'search_input_id'), $this);?>
<?php echo $this->_tpl_vars['search_input_id']; ?>
<?php $this->_smarty_vars['capture']['search_input_id'] = ob_get_contents(); ob_end_clean(); ?>
</form>
</div>
<?php  ob_end_flush();  ?>