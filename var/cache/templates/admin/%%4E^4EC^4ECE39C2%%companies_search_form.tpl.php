<?php /* Smarty version 2.6.18, created on 2014-03-08 23:32:29
         compiled from views/companies/components/companies_search_form.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'fn_url', 'views/companies/components/companies_search_form.tpl', 16, false),array('block', 'hook', 'views/companies/components/companies_search_form.tpl', 138, false),array('function', 'math', 'views/companies/components/companies_search_form.tpl', 149, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('name','search','search','email','address','city','country','select_country','state','select_state','status','active','pending','new','disabled','zip_postal_code','phone','url','fax','close'));
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
<form name="companies_search_form" action="<?php echo fn_url(""); ?>
" method="get" class="<?php echo $this->_tpl_vars['form_meta']; ?>
"> 

<?php if ($this->_tpl_vars['_REQUEST']['redirect_url']): ?>
<input type="hidden" name="redirect_url" value="<?php echo $this->_tpl_vars['_REQUEST']['redirect_url']; ?>
" />
<?php endif; ?>

<?php if ($this->_tpl_vars['selected_section'] != ""): ?>
<input type="hidden" id="selected_section" name="selected_section" value="<?php echo $this->_tpl_vars['selected_section']; ?>
" />
<?php endif; ?>

<?php if ($this->_tpl_vars['search']['user_type']): ?>
<input type="hidden" name="user_type" value="<?php echo $this->_tpl_vars['search']['user_type']; ?>
" />
<?php endif; ?>

<?php if ($this->_tpl_vars['company_id']): ?>
<input type="hidden" name="company_id" value="<?php echo $this->_tpl_vars['company_id']; ?>
" />
<?php endif; ?>

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


<table cellpadding="0" cellspacing="0" border="0" class="search-header">
<tr>
	<td class="search-field nowrap">
		<label for="elm_name"><?php echo fn_get_lang_var('name', $this->getLanguage()); ?>
:</label>
		<div class="break">
			<input class="search-input-text" type="text" name="company" id="elm_name" value="<?php echo $this->_tpl_vars['search']['company']; ?>
" />
			<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('search' => 'Y', 'but_name' => $this->_tpl_vars['dispatch'], )); ?><input type="hidden" name="dispatch" value="<?php echo $this->_tpl_vars['but_name']; ?>
" />
<input type="image" src="<?php echo $this->_tpl_vars['images_dir']; ?>
/search_go.gif" class="search-go" alt="<?php echo fn_get_lang_var('search', $this->getLanguage()); ?>
" title="<?php echo fn_get_lang_var('search', $this->getLanguage()); ?>
" /><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
		</div>
	</td>
	<td class="search-field">
		<label for="elm_email"><?php echo fn_get_lang_var('email', $this->getLanguage()); ?>
:</label>
		<div class="break">
			<input class="input-text" type="text" name="email" id="elm_email" value="<?php echo $this->_tpl_vars['search']['email']; ?>
" />
		</div>
	</td>
	<td class="buttons-container">
		<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/search.tpl", 'smarty_include_vars' => array('but_name' => "dispatch[".($this->_tpl_vars['dispatch'])."]",'but_role' => 'submit','method' => 'GET')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</td>
</tr>
</table>

<?php ob_start(); ?>

<table cellpadding="0" cellspacing="0" border="0" width="100%">
<tr valign="top">
	<td>

		<div class="search-field">
			<label for="elm_address"><?php echo fn_get_lang_var('address', $this->getLanguage()); ?>
:</label>
			<input class="input-text" type="text" name="address" id="elm_address" value="<?php echo $this->_tpl_vars['search']['address']; ?>
" />
		</div>
		<div class="search-field">
			<label for="elm_city"><?php echo fn_get_lang_var('city', $this->getLanguage()); ?>
:</label>
			<input class="input-text" type="text" name="city" id="elm_city" value="<?php echo $this->_tpl_vars['search']['city']; ?>
" />
		</div>
		<div class="search-field">
			<label for="srch_country" class="cm-country cm-location-search"><?php echo fn_get_lang_var('country', $this->getLanguage()); ?>
:</label>
			<select id="srch_country" name="country" class="cm-location-search">
				<option value="">- <?php echo fn_get_lang_var('select_country', $this->getLanguage()); ?>
 -</option>
				<?php $_from = $this->_tpl_vars['countries']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['country']):
?>
				<option value="<?php echo $this->_tpl_vars['country']['code']; ?>
" <?php if ($this->_tpl_vars['search']['country'] == $this->_tpl_vars['country']['code']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['country']['country']; ?>
</option>
				<?php endforeach; endif; unset($_from); ?>
			</select>
		</div>

		<div class="search-field">
			<label for="srch_state" class="cm-state cm-location-search"><?php echo fn_get_lang_var('state', $this->getLanguage()); ?>
:</label>
			<input type="text" id="srch_state_d" name="state" maxlength="64" value="<?php echo $this->_tpl_vars['search']['state']; ?>
" disabled="disabled" class="input-text" />
			<select id="srch_state" class="hidden" name="state">
				<option value="">- <?php echo fn_get_lang_var('select_state', $this->getLanguage()); ?>
 -</option>
			</select>
			<input type="hidden" id="srch_state_default" value="<?php echo $this->_tpl_vars['_REQUEST']['state']; ?>
" />
		</div>

		
		<div class="search-field">
			<label for="status"><?php echo fn_get_lang_var('status', $this->getLanguage()); ?>
:</label>
			<select name="status" id="status">
				<option value="">--</option>
				<option value="A" <?php if ($this->_tpl_vars['search']['status'] == 'A'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('active', $this->getLanguage()); ?>
</option>
				<option value="P" <?php if ($this->_tpl_vars['search']['status'] == 'P'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('pending', $this->getLanguage()); ?>
</option>
				<option value="N" <?php if ($this->_tpl_vars['search']['status'] == 'N'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('new', $this->getLanguage()); ?>
</option>
				<option value="D" <?php if ($this->_tpl_vars['search']['status'] == 'D'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('disabled', $this->getLanguage()); ?>
</option>
			</select>
		</div>
		
	</td>
	<td>

		<div class="search-field">
			<label for="elm_zipcode"><?php echo fn_get_lang_var('zip_postal_code', $this->getLanguage()); ?>
:</label>
			<input class="input-text" type="text" name="zipcode" id="elm_zipcode" value="<?php echo $this->_tpl_vars['search']['zipcode']; ?>
" />
		</div>

		<div class="search-field">
			<label for="elm_phone"><?php echo fn_get_lang_var('phone', $this->getLanguage()); ?>
:</label>
			<input class="input-text" type="text" name="phone" id="elm_phone" value="<?php echo $this->_tpl_vars['search']['phone']; ?>
" />
		</div>

		<div class="search-field">
			<label for="elm_url"><?php echo fn_get_lang_var('url', $this->getLanguage()); ?>
:</label>
			<input class="input-text" type="text" name="url" id="elm_url" value="<?php echo $this->_tpl_vars['search']['url']; ?>
" />
		</div>

		<div class="search-field">
			<label for="elm_fax"><?php echo fn_get_lang_var('fax', $this->getLanguage()); ?>
:</label>
			<input class="input-text" type="text" name="fax" id="elm_fax" value="<?php echo $this->_tpl_vars['search']['fax']; ?>
" />
		</div>

	</td>
</tr>
</table>

<?php $this->_tag_stack[] = array('hook', array('name' => "companies:search_form")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

<?php $this->_smarty_vars['capture']['advanced_search'] = ob_get_contents(); ob_end_clean(); ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/advanced_search.tpl", 'smarty_include_vars' => array('content' => $this->_smarty_vars['capture']['advanced_search'],'dispatch' => $this->_tpl_vars['dispatch'],'view_type' => 'companies')));
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