<?php /* Smarty version 2.6.18, created on 2013-06-14 13:39:28
         compiled from views/products/components/products_search_form.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'fn_get_company_name', 'views/products/components/products_search_form.tpl', 1, false),array('modifier', 'fn_url', 'views/products/components/products_search_form.tpl', 17, false),array('modifier', 'fn_show_picker', 'views/products/components/products_search_form.tpl', 66, false),array('modifier', 'fn_get_plain_categories_tree', 'views/products/components/products_search_form.tpl', 75, false),array('modifier', 'escape', 'views/products/components/products_search_form.tpl', 79, false),array('modifier', 'truncate', 'views/products/components/products_search_form.tpl', 79, false),array('modifier', 'indent', 'views/products/components/products_search_form.tpl', 79, false),array('modifier', 'default', 'views/products/components/products_search_form.tpl', 96, false),array('modifier', 'md5', 'views/products/components/products_search_form.tpl', 151, false),array('modifier', 'string_format', 'views/products/components/products_search_form.tpl', 151, false),array('block', 'hook', 'views/products/components/products_search_form.tpl', 29, false),array('function', 'math', 'views/products/components/products_search_form.tpl', 152, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('find_results_with','any_words','all_words','exact_phrase','search_in','product_name','short_description','full_description','keywords','search_in_category','all_categories','all_categories','search_in_subcategories','advanced_search_options','search_by_vendor','search','loading','search_by_sku','search_by_price','search_by_weight','or','reset','search_options','open_action','hide'));
?>
<?php 

				$rname = !empty($resource_name) ? $resource_name : $params['smarty_include_tpl_file'];
				if ($this->compile_check && empty($inline_no_check[$rname]) && $this->is_cached($rname)) {
					if ($this->check_inline_blocks(array (
  'common_templates/section.tpl' => 1367063745,
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
" name="advanced_search_form" method="get" class="<?php echo $this->_tpl_vars['form_meta']; ?>
">
<input type="hidden" name="search_performed" value="Y" />

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

<?php echo $this->_tpl_vars['search_extra']; ?>

<?php $this->_tag_stack[] = array('hook', array('name' => "products:search_query_input")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
<div class="form-field">
	<label for="match"><?php echo fn_get_lang_var('find_results_with', $this->getLanguage()); ?>
</label>
	<select name="match" id="match" class="valign">
		<option <?php if ($this->_tpl_vars['search']['match'] == 'any'): ?>selected="selected"<?php endif; ?> value="any"><?php echo fn_get_lang_var('any_words', $this->getLanguage()); ?>
</option>
		<option <?php if ($this->_tpl_vars['search']['match'] == 'all'): ?>selected="selected"<?php endif; ?> value="all"><?php echo fn_get_lang_var('all_words', $this->getLanguage()); ?>
</option>
		<option <?php if ($this->_tpl_vars['search']['match'] == 'exact'): ?>selected="selected"<?php endif; ?> value="exact"><?php echo fn_get_lang_var('exact_phrase', $this->getLanguage()); ?>
</option>
	</select>&nbsp;&nbsp;
	<input type="text" name="q" size="38" value="<?php echo $this->_tpl_vars['search']['q']; ?>
" class="input-text-large valign" />
</div>

<div class="form-field">
	<label><?php echo fn_get_lang_var('search_in', $this->getLanguage()); ?>
</label>
	<div class="select-field">
		<label for="pname">
			<input type="hidden" name="pname" value="N" />
			<input type="checkbox" value="Y" <?php if ($this->_tpl_vars['search']['pname'] == 'Y' || ! $this->_tpl_vars['search']['pname']): ?>checked="checked"<?php endif; ?> name="pname" id="pname" class="checkbox" /><?php echo fn_get_lang_var('product_name', $this->getLanguage()); ?>

		</label>

		<label for="pshort">
			<input type="checkbox" value="Y" <?php if ($this->_tpl_vars['search']['pshort'] == 'Y'): ?>checked="checked"<?php endif; ?> name="pshort" id="pshort" class="checkbox" /><?php echo fn_get_lang_var('short_description', $this->getLanguage()); ?>

		</label>

		<label for="pfull">
			<input type="checkbox" value="Y" <?php if ($this->_tpl_vars['search']['pfull'] == 'Y'): ?>checked="checked"<?php endif; ?> name="pfull" id="pfull" class="checkbox" /><?php echo fn_get_lang_var('full_description', $this->getLanguage()); ?>

		</label>

		<label for="pkeywords">
			<input type="checkbox" value="Y" <?php if ($this->_tpl_vars['search']['pkeywords'] == 'Y'): ?>checked="checked"<?php endif; ?> name="pkeywords" id="pkeywords" class="checkbox" /><?php echo fn_get_lang_var('keywords', $this->getLanguage()); ?>

		</label>

		<?php $this->_tag_stack[] = array('hook', array('name' => "products:search_in")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
	</div>
</div>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
<div class="form-field">
	<label><?php echo fn_get_lang_var('search_in_category', $this->getLanguage()); ?>
</label>
	<?php if (fn_show_picker('categories', @CATEGORY_THRESHOLD)): ?>
		<?php if ($this->_tpl_vars['search']['cid']): ?>
			<?php $this->assign('s_cid', $this->_tpl_vars['search']['cid'], false); ?>
		<?php else: ?>
			<?php $this->assign('s_cid', '0', false); ?>
		<?php endif; ?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "pickers/categories_picker.tpl", 'smarty_include_vars' => array('data_id' => 'location_category','input_name' => 'cid','item_ids' => $this->_tpl_vars['s_cid'],'hide_link' => true,'hide_delete_button' => true,'show_root' => true,'default_name' => fn_get_lang_var('all_categories', $this->getLanguage()),'extra' => "")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php else: ?>
	<div class="float-left">		<?php $this->assign('all_categories', fn_get_plain_categories_tree(0, false), false); ?>
		<select	name="cid" class="valign">
			<option	value="0" <?php if ($this->_tpl_vars['category_data']['parent_id'] == '0'): ?>selected<?php endif; ?>>- <?php echo fn_get_lang_var('all_categories', $this->getLanguage()); ?>
 -</option>
			<?php $_from = $this->_tpl_vars['all_categories']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['cat']):
?>
			<option	value="<?php echo $this->_tpl_vars['cat']['category_id']; ?>
" <?php if ($this->_tpl_vars['cat']['disabled']): ?>disabled="disabled"<?php endif; ?><?php if ($this->_tpl_vars['search']['cid'] == $this->_tpl_vars['cat']['category_id']): ?> selected="selected"<?php endif; ?> title="<?php echo smarty_modifier_escape($this->_tpl_vars['cat']['category'], 'html'); ?>
"><?php echo smarty_modifier_indent(smarty_modifier_truncate(smarty_modifier_escape($this->_tpl_vars['cat']['category']), 50, "...", true), $this->_tpl_vars['cat']['level'], "&#166;&nbsp;&nbsp;&nbsp;&nbsp;", "&#166;--&nbsp;"); ?>
</option>
			<?php endforeach; endif; unset($_from); ?>
		</select>
	</div>
	<?php endif; ?>
	<div class="select-field subcategories">
		<label for="subcats">
			<input type="checkbox" value="Y"<?php if ($this->_tpl_vars['search']['subcats'] == 'Y'): ?> checked="checked"<?php endif; ?> name="subcats" id="subcats" class="checkbox" />
			<?php echo fn_get_lang_var('search_in_subcategories', $this->getLanguage()); ?>

		</label>
	</div>
</div>

<?php if (! $this->_tpl_vars['simple_search_form']): ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/subheader.tpl", 'smarty_include_vars' => array('title' => fn_get_lang_var('advanced_search_options', $this->getLanguage()))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php if (@PRODUCT_TYPE == 'MULTIVENDOR' || @PRODUCT_TYPE == 'ULTIMATE'): ?>
	<div class="form-field">
		<input type="hidden" name="company_id" id="company_id" value="<?php echo smarty_modifier_default(@$this->_tpl_vars['search']['company_id'], ''); ?>
" />
		
		<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('label' => fn_get_lang_var('search_by_vendor', $this->getLanguage()), 'data_url' => "companies.get_companies_list?show_all=Y&search=Y", 'text' => fn_get_company_name($this->_tpl_vars['search']['company_id']), 'result_elm' => 'company_id', 'id' => 'company_id_selector', )); ?><div class="tools-container">
	<?php if ($this->_tpl_vars['label']): ?><label><?php echo $this->_tpl_vars['label']; ?>
</label><?php endif; ?>

	<a id="sw_<?php echo $this->_tpl_vars['id']; ?>
_wrap_" class="select-link cm-combo-on cm-combination"><?php echo $this->_tpl_vars['text']; ?>
</a>

	<div id="<?php echo $this->_tpl_vars['id']; ?>
_wrap_" class="popup-tools cm-popup-box cm-smart-position hidden">	
		<input type="text" value="<?php echo fn_get_lang_var('search', $this->getLanguage()); ?>
..." class="input-text cm-hint cm-ajax-content-input" rev="content_loader_<?php echo $this->_tpl_vars['id']; ?>
" size="16" />
		<div class="ajax-popup-tools" id="scroller_<?php echo $this->_tpl_vars['id']; ?>
">
			<ul class="cm-select-list" id="<?php echo $this->_tpl_vars['id']; ?>
">
				<li class="hidden">&nbsp;</li><!-- hidden li element for successfully html validation -->
				<?php $_from = $this->_tpl_vars['objects']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['object_id'] => $this->_tpl_vars['item']):
?>
					<li><a action="<?php echo $this->_tpl_vars['item']['value']; ?>
"><?php echo $this->_tpl_vars['item']['name']; ?>
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
		
	</div>
	<?php endif; ?>
	<div class="form-field">
		<label for="pcode"><?php echo fn_get_lang_var('search_by_sku', $this->getLanguage()); ?>
</label>
		<input type="text" name="pcode" id="pcode" value="<?php echo $this->_tpl_vars['search']['pcode']; ?>
" onfocus="this.select();" class="input-text" size="30" />
	</div>

	<?php $this->assign('have_price_filter', 0, false); ?>
	<?php $_from = $this->_tpl_vars['filter_features']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ff']):
?><?php if ($this->_tpl_vars['ff']['field_type'] == 'P'): ?><?php $this->assign('have_price_filter', 1, false); ?><?php endif; ?><?php endforeach; endif; unset($_from); ?>
	<?php if (! $this->_tpl_vars['have_price_filter']): ?>
	<div class="form-field">
		<label for="price_from"><?php echo fn_get_lang_var('search_by_price', $this->getLanguage()); ?>
&nbsp;(<?php echo $this->_tpl_vars['currencies'][$this->_tpl_vars['primary_currency']]['symbol']; ?>
)</label>
		<input type="text" name="price_from" id="price_from" value="<?php echo $this->_tpl_vars['search']['price_from']; ?>
" onfocus="this.select();" class="input-text" size="30" />&nbsp;-&nbsp;<input type="text" name="price_to" value="<?php echo $this->_tpl_vars['search']['price_to']; ?>
" onfocus="this.select();" class="input-text" size="30" />
	</div>
	<?php endif; ?>

	<div class="form-field">
		<label for="weight_from"><?php echo fn_get_lang_var('search_by_weight', $this->getLanguage()); ?>
&nbsp;(<?php if ($this->_tpl_vars['config']['localization']['weight_symbol']): ?><?php echo $this->_tpl_vars['config']['localization']['weight_symbol']; ?>
<?php else: ?><?php echo $this->_tpl_vars['settings']['General']['weight_symbol']; ?>
<?php endif; ?>)</label>
		<input type="text" name="weight_from" id="weight_from" value="<?php echo $this->_tpl_vars['search']['weight_from']; ?>
" onfocus="this.select();" class="input-text" size="30" />&nbsp;-&nbsp;<input type="text" name="weight_to" value="<?php echo $this->_tpl_vars['search']['weight_to']; ?>
" onfocus="this.select();" class="input-text" size="30" />
	</div>
	
	<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/products/components/product_filters_advanced_form.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	
<?php endif; ?>

<div class="buttons-container">
	<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/search.tpl", 'smarty_include_vars' => array('but_name' => "dispatch[".($this->_tpl_vars['dispatch'])."]")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>&nbsp;<?php echo fn_get_lang_var('or', $this->getLanguage()); ?>
&nbsp;&nbsp;<a class="text-button nobg cm-reset-link"><?php echo fn_get_lang_var('reset', $this->getLanguage()); ?>
</a>
</div>

</form>

<?php $this->_smarty_vars['capture']['section'] = ob_get_contents(); ob_end_clean(); ?>
<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('section_title' => fn_get_lang_var('search_options', $this->getLanguage()), 'section_content' => $this->_smarty_vars['capture']['section'], 'class' => "search-form", )); ?><?php $this->assign('id', smarty_modifier_string_format(md5($this->_tpl_vars['section_title']), "s_%s"), false); ?>
<?php echo smarty_function_math(array('equation' => "rand()",'assign' => 'rnd'), $this);?>

<?php if ($_COOKIE[$this->_tpl_vars['id']] || $this->_tpl_vars['collapse']): ?>
	<?php $this->assign('collapse', true, false); ?>
<?php else: ?>
	<?php $this->assign('collapse', false, false); ?>
<?php endif; ?>

<div class="section-border<?php if ($this->_tpl_vars['class']): ?> <?php echo $this->_tpl_vars['class']; ?>
<?php endif; ?>" id="ds_<?php echo $this->_tpl_vars['rnd']; ?>
">
	<div  class="section-title cm-combo-<?php if (! $this->_tpl_vars['collapse']): ?>off<?php else: ?>on<?php endif; ?> cm-combination cm-save-state cm-ss-reverse" id="sw_<?php echo $this->_tpl_vars['id']; ?>
">
		<span><?php echo $this->_tpl_vars['section_title']; ?>
</span>
		<span class="section-switch section-switch-on"><?php echo fn_get_lang_var('open_action', $this->getLanguage()); ?>
</span>
		<span class="section-switch section-switch-off"><?php echo fn_get_lang_var('hide', $this->getLanguage()); ?>
</span>
	</div>
	<div id="<?php echo $this->_tpl_vars['id']; ?>
" class="<?php echo smarty_modifier_default(@$this->_tpl_vars['section_body_class'], "section-body"); ?>
 <?php if ($this->_tpl_vars['collapse']): ?>hidden<?php endif; ?>"><?php echo $this->_tpl_vars['section_content']; ?>
</div>
</div><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>