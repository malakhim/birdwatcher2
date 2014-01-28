<?php /* Smarty version 2.6.18, created on 2014-01-28 16:50:02
         compiled from views/pages/components/pages_search_form.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'fn_url', 'views/pages/components/pages_search_form.tpl', 17, false),array('modifier', 'fn_show_picker', 'views/pages/components/pages_search_form.tpl', 59, false),array('modifier', 'fn_get_pages_plain_list', 'views/pages/components/pages_search_form.tpl', 64, false),array('modifier', 'escape', 'views/pages/components/pages_search_form.tpl', 65, false),array('modifier', 'indent', 'views/pages/components/pages_search_form.tpl', 65, false),array('function', 'math', 'views/pages/components/pages_search_form.tpl', 96, false),array('block', 'hook', 'views/pages/components/pages_search_form.tpl', 100, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('find_results_with','search','search','any_words','all_words','exact_phrase','type','parent_page','all_pages','all_pages','search_in','page_name','description','subpages','tag','status','active','hidden','disabled','close'));
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
" name="pages_search_form" method="get" class="<?php echo $this->_tpl_vars['form_meta']; ?>
">
<input type="hidden" name="get_tree" value="" />

<?php if ($this->_tpl_vars['put_request_vars']): ?>
<?php $_from = $this->_tpl_vars['_REQUEST']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
<?php if ($this->_tpl_vars['v']): ?>
<input type="hidden" name="<?php echo $this->_tpl_vars['k']; ?>
" value="<?php echo $this->_tpl_vars['v']; ?>
" />
<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
<?php endif; ?>

<?php echo $this->_tpl_vars['extra']; ?>


<table cellspacing="0" border="0" class="search-header">
<tr>
	<td class="nowrap search-field">
		<label><?php echo fn_get_lang_var('find_results_with', $this->getLanguage()); ?>
:</label>
		<div class="break">
			<input type="text" name="q" size="20" value="<?php echo $this->_tpl_vars['search']['q']; ?>
" class="search-input-text" />
			<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('search' => 'Y', 'but_name' => ($this->_tpl_vars['dispatch']), )); ?><input type="hidden" name="dispatch" value="<?php echo $this->_tpl_vars['but_name']; ?>
" />
<input type="image" src="<?php echo $this->_tpl_vars['images_dir']; ?>
/search_go.gif" class="search-go" alt="<?php echo fn_get_lang_var('search', $this->getLanguage()); ?>
" title="<?php echo fn_get_lang_var('search', $this->getLanguage()); ?>
" /><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>&nbsp;
			<select name="match">
				<option value="any" <?php if ($this->_tpl_vars['search']['match'] == 'any'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('any_words', $this->getLanguage()); ?>
</option>
				<option value="all" <?php if ($this->_tpl_vars['search']['match'] == 'all'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('all_words', $this->getLanguage()); ?>
</option>
				<option value="exact" <?php if ($this->_tpl_vars['search']['match'] == 'exact'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('exact_phrase', $this->getLanguage()); ?>
</option>
			</select>
		</div>
	</td>
	<td class="nowrap search-field">
		<label><?php echo fn_get_lang_var('type', $this->getLanguage()); ?>
:</label>
		<div class="break">
			<select name="page_type">
				<option value="">--</option>
				<?php $_from = $this->_tpl_vars['page_types']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['t'] => $this->_tpl_vars['p']):
?>
				<option value="<?php echo $this->_tpl_vars['t']; ?>
" <?php if ($this->_tpl_vars['search']['page_type'] == $this->_tpl_vars['t']): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var($this->_tpl_vars['p']['name'], $this->getLanguage()); ?>
</option>
				<?php endforeach; endif; unset($_from); ?>
			</select>
		</div>
	</td>
	<td class="nowrap search-field">
		<label><?php echo fn_get_lang_var('parent_page', $this->getLanguage()); ?>
:</label>
		<div class="break clear correct-picker-but">
		<?php if (fn_show_picker('pages', @PAGE_THRESHOLD)): ?>
			<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "pickers/pages_picker.tpl", 'smarty_include_vars' => array('data_id' => 'location_page','input_name' => 'parent_id','item_ids' => $this->_tpl_vars['search']['parent_id'],'hide_link' => true,'hide_delete_button' => true,'show_root' => true,'default_name' => fn_get_lang_var('all_pages', $this->getLanguage()),'extra' => "")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<?php else: ?>
			<select	name="parent_id">
				<option	value="">- <?php echo fn_get_lang_var('all_pages', $this->getLanguage()); ?>
 -</option>
				<?php $_from = fn_get_pages_plain_list(""); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['p']):
?>
					<option	value="<?php echo $this->_tpl_vars['p']['page_id']; ?>
" <?php if ($this->_tpl_vars['search']['parent_id'] == $this->_tpl_vars['p']['page_id']): ?>selected="selected"<?php endif; ?>><?php echo smarty_modifier_indent(smarty_modifier_escape($this->_tpl_vars['p']['page']), $this->_tpl_vars['p']['level'], "&#166;&nbsp;&nbsp;&nbsp;&nbsp;", "&#166;--&nbsp;"); ?>
</option>
				<?php endforeach; endif; unset($_from); ?>
			</select>
		<?php endif; ?>
		</div>
	</td>
	<td class="buttons-container">
		<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/search.tpl", 'smarty_include_vars' => array('but_name' => "dispatch[".($this->_tpl_vars['dispatch'])."]",'but_role' => 'submit')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</td>
</tr>
</table>

<?php ob_start(); ?>

<div class="search-field">
	<label><?php echo fn_get_lang_var('search_in', $this->getLanguage()); ?>
:</label>
	<table cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td class="select-field"><input type="checkbox" value="Y" <?php if ($this->_tpl_vars['search']['pname'] == 'Y'): ?>checked="checked"<?php endif; ?> name="pname" id="pname" class="checkbox" /><label for="pname"><?php echo fn_get_lang_var('page_name', $this->getLanguage()); ?>
</label></td>
		<td>&nbsp;&nbsp;&nbsp;</td>

		<td class="select-field"><input type="checkbox" value="Y" <?php if ($this->_tpl_vars['search']['pdescr'] == 'Y'): ?>checked="checked"<?php endif; ?> name="pdescr" id="pdescr" class="checkbox" /><label for="pdescr"><?php echo fn_get_lang_var('description', $this->getLanguage()); ?>
</label></td>
		<td>&nbsp;&nbsp;&nbsp;</td>

		<td class="select-field"><input type="checkbox" value="Y" <?php if ($this->_tpl_vars['search']['subpages'] == 'Y'): ?>checked="checked"<?php endif; ?> name="subpages" class="checkbox" id="subpages" /><label for="subpages"><?php echo fn_get_lang_var('subpages', $this->getLanguage()); ?>
</label></td>
	</tr>
	</table>
</div>
<hr />

<?php if (@PRODUCT_TYPE == 'MULTIVENDOR' || @PRODUCT_TYPE == 'ULTIMATE'): ?>
	<?php echo smarty_function_math(array('equation' => "rand()",'assign' => 'random_value'), $this);?>

	<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/select_supplier_vendor.tpl", 'smarty_include_vars' => array('id' => "company_id_".($this->_tpl_vars['random_value']))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php endif; ?>

<?php $this->_tag_stack[] = array('hook', array('name' => "pages:search_form")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
<?php if ($this->_tpl_vars['addons']['tags']['status'] == 'A'): ?><?php $__parent_tpl_vars = $this->_tpl_vars; ?><div class="search-field">
	<label for="elm_tag"><?php echo fn_get_lang_var('tag', $this->getLanguage()); ?>
:</label>
	<input id="elm_tag" type="text" name="tag" value="<?php echo $this->_tpl_vars['search']['tag']; ?>
" onfocus="this.select();" class="input-text" />
</div><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php endif; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

<div class="search-field">
	<label><?php echo fn_get_lang_var('status', $this->getLanguage()); ?>
:</label>
	<select name="status">
		<option value="">--</option>
		<option value="A" <?php if ($this->_tpl_vars['search']['status'] == 'A'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('active', $this->getLanguage()); ?>
</option>
		<option value="H" <?php if ($this->_tpl_vars['search']['status'] == 'H'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('hidden', $this->getLanguage()); ?>
</option>
		<option value="D" <?php if ($this->_tpl_vars['search']['status'] == 'D'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('disabled', $this->getLanguage()); ?>
</option>
	</select>
</div>

<?php $this->_smarty_vars['capture']['advanced_search'] = ob_get_contents(); ob_end_clean(); ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/advanced_search.tpl", 'smarty_include_vars' => array('content' => $this->_smarty_vars['capture']['advanced_search'],'dispatch' => $this->_tpl_vars['dispatch'],'view_type' => 'pages')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

</form>

<?php $this->_smarty_vars['capture']['section'] = ob_get_contents(); ob_end_clean(); ?>

<div class="search-form-wrap">
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
</div>