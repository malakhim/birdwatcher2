<?php /* Smarty version 2.6.18, created on 2014-03-07 22:41:11
         compiled from views/products/components/products_update_file_details.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'fn_url', 'views/products/components/products_update_file_details.tpl', 15, false),array('modifier', 'md5', 'views/products/components/products_update_file_details.tpl', 40, false),array('modifier', 'formatfilesize', 'views/products/components/products_update_file_details.tpl', 42, false),array('modifier', 'cat', 'views/products/components/products_update_file_details.tpl', 47, false),array('modifier', 'escape', 'views/products/components/products_update_file_details.tpl', 59, false),array('modifier', 'count', 'views/products/components/products_update_file_details.tpl', 81, false),array('modifier', 'default', 'views/products/components/products_update_file_details.tpl', 99, false),array('modifier', 'defined', 'views/products/components/products_update_file_details.tpl', 101, false),array('modifier', 'number_format', 'views/products/components/products_update_file_details.tpl', 119, false),array('function', 'script', 'views/products/components/products_update_file_details.tpl', 44, false),array('block', 'hook', 'views/products/components/products_update_file_details.tpl', 70, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('general','name','position','file','upload_another_file','local','local','remove_this_item','remove_this_item','remove_this_item','remove_this_item','text_select_file','upload_another_file','local','server','url','preview','bytes','none','upload_another_file','local','local','remove_this_item','remove_this_item','remove_this_item','remove_this_item','text_select_file','upload_another_file','local','server','url','activation_mode','manually','immediately','after_full_payment','max_downloads','license_agreement','agreement_required','yes','no','readme'));
?>
<?php 

				$rname = !empty($resource_name) ? $resource_name : $params['smarty_include_tpl_file'];
				if ($this->compile_check && empty($inline_no_check[$rname]) && $this->is_cached($rname)) {
					if ($this->check_inline_blocks(array (
  'common_templates/fileuploader.tpl' => 1367063753,
))) {
						$_smarty_compile_path = $this->_get_compile_path($rname);
						$this->_compile_resource($rname, $_smarty_compile_path);
						$inline_no_check[$rname] = true;
						include $_smarty_compile_path;
						return;
					}
				}
			 ?><form action="<?php echo fn_url(""); ?>
" method="post" class="cm-form-highlight <?php echo $this->_tpl_vars['hide_inputs']; ?>
" name="files_form_<?php echo $this->_tpl_vars['product_file']['file_id']; ?>
" enctype="multipart/form-data">
<input type="hidden" name="product_id" value="<?php echo $this->_tpl_vars['product_id']; ?>
" />
<input type="hidden" name="selected_section" value="files" />
<input type="hidden" name="file_id" value="<?php echo $this->_tpl_vars['product_file']['file_id']; ?>
" />

<div class="tabs cm-j-tabs">
	<ul>
		<li id="tab_details_<?php echo $this->_tpl_vars['product_file']['file_id']; ?>
" class="cm-js cm-active"><a><?php echo fn_get_lang_var('general', $this->getLanguage()); ?>
</a></li>
	</ul>
</div>

<div class="cm-tabs-content" id="tabs_content_<?php echo $this->_tpl_vars['product_file']['file_id']; ?>
">
	<div id="content_tab_details_<?php echo $this->_tpl_vars['product_file']['file_id']; ?>
">

		<div class="form-field">
			<label for="name_<?php echo $this->_tpl_vars['product_file']['file_id']; ?>
" class="cm-required"><?php echo fn_get_lang_var('name', $this->getLanguage()); ?>
:</label>
			<input type="text" name="product_file[file_name]" id="name_<?php echo $this->_tpl_vars['product_file']['file_id']; ?>
" value="<?php echo $this->_tpl_vars['product_file']['file_name']; ?>
" class="input-text-large main-input" />
		</div>

		<div class="form-field">
			<label for="position_<?php echo $this->_tpl_vars['product_file']['file_id']; ?>
"><?php echo fn_get_lang_var('position', $this->getLanguage()); ?>
:</label>
			<input type="text" name="product_file[position]" id="position_<?php echo $this->_tpl_vars['product_file']['file_id']; ?>
" value="<?php echo $this->_tpl_vars['product_file']['position']; ?>
" size="3" class="input-text-short" />
		</div>

		<div class="form-field">
			<label for="type_<?php echo md5("base_file[".($this->_tpl_vars['product_file']['file_id'])."]"); ?>
" <?php if (! $this->_tpl_vars['product_file']): ?>class="cm-required"<?php endif; ?>><?php echo fn_get_lang_var('file', $this->getLanguage()); ?>
:</label>
			<?php if ($this->_tpl_vars['product_file']['file_path']): ?>
				<a href="<?php echo fn_url("products.getfile?file_id=".($this->_tpl_vars['product_file']['file_id'])); ?>
"><?php echo $this->_tpl_vars['product_file']['file_path']; ?>
</a> (<?php echo smarty_modifier_formatfilesize($this->_tpl_vars['product_file']['file_size']); ?>
)
			<?php endif; ?>
			<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('var_name' => "base_file[".($this->_tpl_vars['product_file']['file_id'])."]", )); ?><?php echo smarty_function_script(array('src' => "js/fileuploader_scripts.js"), $this);?>

<?php echo smarty_function_script(array('src' => "js/node_cloning.js"), $this);?>


<?php $this->assign('id_var_name', md5(smarty_modifier_cat($this->_tpl_vars['prefix'], $this->_tpl_vars['var_name'])), false); ?>

<script type="text/javascript">
//<![CDATA[
	var id_var_name = "<?php echo $this->_tpl_vars['id_var_name']; ?>
";
	var label_id = "<?php echo $this->_tpl_vars['label_id']; ?>
";

	if (typeof(custom_labels) == "undefined") <?php echo $this->_tpl_vars['ldelim']; ?>

		custom_labels = <?php echo $this->_tpl_vars['ldelim']; ?>
<?php echo $this->_tpl_vars['rdelim']; ?>
;
	<?php echo $this->_tpl_vars['rdelim']; ?>

	
	custom_labels[id_var_name] = <?php echo $this->_tpl_vars['ldelim']; ?>
<?php echo $this->_tpl_vars['rdelim']; ?>
;
	custom_labels[id_var_name]['upload_another_file'] = <?php if ($this->_tpl_vars['multiupload'] == 'Y'): ?><?php if ($this->_tpl_vars['upload_another_file_text']): ?>'<?php echo smarty_modifier_escape($this->_tpl_vars['upload_another_file_text'], 'javascript'); ?>
'<?php else: ?>'<?php echo smarty_modifier_escape(fn_get_lang_var('upload_another_file', $this->getLanguage()), 'javascript'); ?>
'<?php endif; ?><?php else: ?>'<?php echo smarty_modifier_escape(fn_get_lang_var('local', $this->getLanguage()), 'javascript'); ?>
'<?php endif; ?>;
	custom_labels[id_var_name]['upload_file'] = <?php if ($this->_tpl_vars['upload_file_text']): ?>'<?php echo smarty_modifier_escape($this->_tpl_vars['upload_file_text'], 'javascript'); ?>
'<?php else: ?>'<?php echo smarty_modifier_escape(fn_get_lang_var('local', $this->getLanguage()), 'javascript'); ?>
'<?php endif; ?>;
//]]>
</script>

<div class="fileuploader">
<input type="hidden" id="<?php echo $this->_tpl_vars['label_id']; ?>
" value="<?php if ($this->_tpl_vars['images']): ?><?php echo $this->_tpl_vars['id_var_name']; ?>
<?php endif; ?>" />

<?php $_from = $this->_tpl_vars['images']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['image_id'] => $this->_tpl_vars['image']):
?>
	<div class="upload-file-section cm-uploaded-image" id="message_<?php echo $this->_tpl_vars['id_var_name']; ?>
_<?php echo $this->_tpl_vars['image']['file']; ?>
" title="">
		<p class="cm-fu-file">
			<?php $this->_tag_stack[] = array('hook', array('name' => "fileuploader:links")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
				<?php if ($this->_tpl_vars['image']['location'] == 'cart'): ?>
					<?php $this->assign('delete_link', ($this->_tpl_vars['controller']).".delete_file?cart_id=".($this->_tpl_vars['id'])."&amp;option_id=".($this->_tpl_vars['po']['option_id'])."&amp;file=".($this->_tpl_vars['image_id'])."&amp;redirect_mode=cart", false); ?>
					<?php $this->assign('download_link', ($this->_tpl_vars['controller']).".get_custom_file?cart_id=".($this->_tpl_vars['id'])."&amp;option_id=".($this->_tpl_vars['po']['option_id'])."&amp;file=".($this->_tpl_vars['image_id']), false); ?>
				<?php endif; ?>
			<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
			<?php if ($this->_tpl_vars['image']['is_image']): ?>
				<a href="<?php echo fn_url($this->_tpl_vars['image']['detailed']); ?>
"><img src="<?php echo fn_url($this->_tpl_vars['image']['thumbnail']); ?>
" border="0" /></a><br />
			<?php endif; ?>
			
			<?php $this->_tag_stack[] = array('hook', array('name' => "fileuploader:uploaded_files")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
				<?php if ($this->_tpl_vars['delete_link']): ?><a class="cm-ajax" href="<?php echo fn_url($this->_tpl_vars['delete_link']); ?>
"><?php endif; ?><?php if (! ( $this->_tpl_vars['po']['required'] == 'Y' && count($this->_tpl_vars['images']) == 1 )): ?><img src="<?php echo $this->_tpl_vars['images_dir']; ?>
/icons/icon_delete.gif" width="12" height="18" border="0" hspace="3" id="clean_selection_<?php echo $this->_tpl_vars['id_var_name']; ?>
_<?php echo $this->_tpl_vars['image']['file']; ?>
" alt="<?php echo fn_get_lang_var('remove_this_item', $this->getLanguage()); ?>
" title="<?php echo fn_get_lang_var('remove_this_item', $this->getLanguage()); ?>
" onclick="fileuploader.clean_selection(this.id); <?php if ($this->_tpl_vars['multiupload'] != 'Y'): ?>fileuploader.toggle_links('<?php echo $this->_tpl_vars['id_var_name']; ?>
', 'show');<?php endif; ?> fileuploader.check_required_field('<?php echo $this->_tpl_vars['id_var_name']; ?>
', '<?php echo $this->_tpl_vars['label_id']; ?>
');" class="hand valign" /><?php endif; ?><?php if ($this->_tpl_vars['delete_link']): ?></a><?php endif; ?><span><?php if ($this->_tpl_vars['download_link']): ?><a href="<?php echo fn_url($this->_tpl_vars['download_link']); ?>
"><?php endif; ?><?php echo $this->_tpl_vars['image']['name']; ?>
<?php if ($this->_tpl_vars['download_link']): ?></a><?php endif; ?></span>
			<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
		</p>
	</div>
<?php endforeach; endif; unset($_from); ?>

<div class="nowrap" id="file_uploader_<?php echo $this->_tpl_vars['id_var_name']; ?>
">
	<div class="upload-file-section" id="message_<?php echo $this->_tpl_vars['id_var_name']; ?>
" title="">
		<p class="cm-fu-file hidden"><img src="<?php echo $this->_tpl_vars['images_dir']; ?>
/icons/icon_delete.gif" width="12" height="18" border="0" hspace="3" id="clean_selection_<?php echo $this->_tpl_vars['id_var_name']; ?>
" alt="<?php echo fn_get_lang_var('remove_this_item', $this->getLanguage()); ?>
" title="<?php echo fn_get_lang_var('remove_this_item', $this->getLanguage()); ?>
" onclick="fileuploader.clean_selection(this.id); <?php if ($this->_tpl_vars['multiupload'] != 'Y'): ?>fileuploader.toggle_links(this.id, 'show');<?php endif; ?> fileuploader.check_required_field('<?php echo $this->_tpl_vars['id_var_name']; ?>
', '<?php echo $this->_tpl_vars['label_id']; ?>
');" class="hand valign" /><span></span></p>
		<?php if ($this->_tpl_vars['multiupload'] != 'Y'): ?><p class="cm-fu-no-file <?php if ($this->_tpl_vars['images']): ?>hidden<?php endif; ?>"><?php echo fn_get_lang_var('text_select_file', $this->getLanguage()); ?>
</p><?php endif; ?>
	</div>
	
	<?php echo '<div class="select-field upload-file-links '; ?><?php if ($this->_tpl_vars['multiupload'] != 'Y' && $this->_tpl_vars['images']): ?><?php echo 'hidden'; ?><?php endif; ?><?php echo '" id="link_container_'; ?><?php echo $this->_tpl_vars['id_var_name']; ?><?php echo '"><input type="hidden" name="file_'; ?><?php echo $this->_tpl_vars['var_name']; ?><?php echo '" value="'; ?><?php if ($this->_tpl_vars['image_name']): ?><?php echo ''; ?><?php echo $this->_tpl_vars['image_name']; ?><?php echo ''; ?><?php endif; ?><?php echo '" id="file_'; ?><?php echo $this->_tpl_vars['id_var_name']; ?><?php echo '" '; ?><?php if ($this->_tpl_vars['image']): ?><?php echo 'class="cm-image-field"'; ?><?php endif; ?><?php echo ' /><input type="hidden" name="type_'; ?><?php echo $this->_tpl_vars['var_name']; ?><?php echo '" value="'; ?><?php if ($this->_tpl_vars['image_name']): ?><?php echo 'local'; ?><?php endif; ?><?php echo '" id="type_'; ?><?php echo $this->_tpl_vars['id_var_name']; ?><?php echo '" '; ?><?php if ($this->_tpl_vars['image']): ?><?php echo 'class="cm-image-field"'; ?><?php endif; ?><?php echo ' /><div class="upload-file-local"><input type="file" name="file_'; ?><?php echo $this->_tpl_vars['var_name']; ?><?php echo '" id="_local_'; ?><?php echo $this->_tpl_vars['id_var_name']; ?><?php echo '" onchange="fileuploader.show_loader(this.id); '; ?><?php if ($this->_tpl_vars['multiupload'] == 'Y'): ?><?php echo 'fileuploader.check_image(this.id);'; ?><?php endif; ?><?php echo ' fileuploader.check_required_field(\''; ?><?php echo $this->_tpl_vars['id_var_name']; ?><?php echo '\', \''; ?><?php echo $this->_tpl_vars['label_id']; ?><?php echo '\');" onclick="$(this).removeAttr(\'value\');" value="" '; ?><?php if ($this->_tpl_vars['image']): ?><?php echo 'class="cm-image-field"'; ?><?php endif; ?><?php echo ' /><a id="local_'; ?><?php echo $this->_tpl_vars['id_var_name']; ?><?php echo '">'; ?><?php if ($this->_tpl_vars['images']): ?><?php echo ''; ?><?php echo smarty_modifier_default(@$this->_tpl_vars['upload_another_file_text'], fn_get_lang_var('upload_another_file', $this->getLanguage())); ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php echo smarty_modifier_default(@$this->_tpl_vars['upload_file_text'], fn_get_lang_var('local', $this->getLanguage())); ?><?php echo ''; ?><?php endif; ?><?php echo '</a></div>&nbsp;&nbsp;|&nbsp;&nbsp;'; ?><?php if (! ( $this->_tpl_vars['hide_server'] || defined('COMPANY_ID') || defined('RESTRICTED_ADMIN') )): ?><?php echo '<a onclick="fileuploader.show_loader(this.id);" id="server_'; ?><?php echo $this->_tpl_vars['id_var_name']; ?><?php echo '">'; ?><?php echo fn_get_lang_var('server', $this->getLanguage()); ?><?php echo '</a>&nbsp;&nbsp;|&nbsp;&nbsp;'; ?><?php endif; ?><?php echo '<a onclick="fileuploader.show_loader(this.id);" id="url_'; ?><?php echo $this->_tpl_vars['id_var_name']; ?><?php echo '">'; ?><?php echo fn_get_lang_var('url', $this->getLanguage()); ?><?php echo '</a>'; ?><?php if ($this->_tpl_vars['hidden_name']): ?><?php echo '<input type="hidden" name="'; ?><?php echo $this->_tpl_vars['hidden_name']; ?><?php echo '" value="'; ?><?php echo $this->_tpl_vars['hidden_value']; ?><?php echo '">'; ?><?php endif; ?><?php echo '</div>'; ?>

</div>

</div><!--fileuploader--><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
		</div>

		<div class="form-field">
			<label for="type_<?php echo md5("file_preview[".($this->_tpl_vars['product_file']['file_id'])."]"); ?>
"><?php echo fn_get_lang_var('preview', $this->getLanguage()); ?>
:</label>
			<?php if ($this->_tpl_vars['product_file']['preview_path']): ?>
				<a href="<?php echo fn_url("products.getfile?file_id=".($this->_tpl_vars['product_file']['file_id'])."&amp;file_type=preview"); ?>
"><?php echo $this->_tpl_vars['product_file']['preview_path']; ?>
</a> (<?php echo number_format($this->_tpl_vars['product_file']['preview_size'], 0, "", ' '); ?>
&nbsp;<?php echo fn_get_lang_var('bytes', $this->getLanguage()); ?>
)
			<?php elseif ($this->_tpl_vars['product_file']): ?>
				<?php echo fn_get_lang_var('none', $this->getLanguage()); ?>

			<?php endif; ?>
			<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('var_name' => "file_preview[".($this->_tpl_vars['product_file']['file_id'])."]", )); ?><?php echo smarty_function_script(array('src' => "js/fileuploader_scripts.js"), $this);?>

<?php echo smarty_function_script(array('src' => "js/node_cloning.js"), $this);?>


<?php $this->assign('id_var_name', md5(smarty_modifier_cat($this->_tpl_vars['prefix'], $this->_tpl_vars['var_name'])), false); ?>

<script type="text/javascript">
//<![CDATA[
	var id_var_name = "<?php echo $this->_tpl_vars['id_var_name']; ?>
";
	var label_id = "<?php echo $this->_tpl_vars['label_id']; ?>
";

	if (typeof(custom_labels) == "undefined") <?php echo $this->_tpl_vars['ldelim']; ?>

		custom_labels = <?php echo $this->_tpl_vars['ldelim']; ?>
<?php echo $this->_tpl_vars['rdelim']; ?>
;
	<?php echo $this->_tpl_vars['rdelim']; ?>

	
	custom_labels[id_var_name] = <?php echo $this->_tpl_vars['ldelim']; ?>
<?php echo $this->_tpl_vars['rdelim']; ?>
;
	custom_labels[id_var_name]['upload_another_file'] = <?php if ($this->_tpl_vars['multiupload'] == 'Y'): ?><?php if ($this->_tpl_vars['upload_another_file_text']): ?>'<?php echo smarty_modifier_escape($this->_tpl_vars['upload_another_file_text'], 'javascript'); ?>
'<?php else: ?>'<?php echo smarty_modifier_escape(fn_get_lang_var('upload_another_file', $this->getLanguage()), 'javascript'); ?>
'<?php endif; ?><?php else: ?>'<?php echo smarty_modifier_escape(fn_get_lang_var('local', $this->getLanguage()), 'javascript'); ?>
'<?php endif; ?>;
	custom_labels[id_var_name]['upload_file'] = <?php if ($this->_tpl_vars['upload_file_text']): ?>'<?php echo smarty_modifier_escape($this->_tpl_vars['upload_file_text'], 'javascript'); ?>
'<?php else: ?>'<?php echo smarty_modifier_escape(fn_get_lang_var('local', $this->getLanguage()), 'javascript'); ?>
'<?php endif; ?>;
//]]>
</script>

<div class="fileuploader">
<input type="hidden" id="<?php echo $this->_tpl_vars['label_id']; ?>
" value="<?php if ($this->_tpl_vars['images']): ?><?php echo $this->_tpl_vars['id_var_name']; ?>
<?php endif; ?>" />

<?php $_from = $this->_tpl_vars['images']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['image_id'] => $this->_tpl_vars['image']):
?>
	<div class="upload-file-section cm-uploaded-image" id="message_<?php echo $this->_tpl_vars['id_var_name']; ?>
_<?php echo $this->_tpl_vars['image']['file']; ?>
" title="">
		<p class="cm-fu-file">
			<?php $this->_tag_stack[] = array('hook', array('name' => "fileuploader:links")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
				<?php if ($this->_tpl_vars['image']['location'] == 'cart'): ?>
					<?php $this->assign('delete_link', ($this->_tpl_vars['controller']).".delete_file?cart_id=".($this->_tpl_vars['id'])."&amp;option_id=".($this->_tpl_vars['po']['option_id'])."&amp;file=".($this->_tpl_vars['image_id'])."&amp;redirect_mode=cart", false); ?>
					<?php $this->assign('download_link', ($this->_tpl_vars['controller']).".get_custom_file?cart_id=".($this->_tpl_vars['id'])."&amp;option_id=".($this->_tpl_vars['po']['option_id'])."&amp;file=".($this->_tpl_vars['image_id']), false); ?>
				<?php endif; ?>
			<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
			<?php if ($this->_tpl_vars['image']['is_image']): ?>
				<a href="<?php echo fn_url($this->_tpl_vars['image']['detailed']); ?>
"><img src="<?php echo fn_url($this->_tpl_vars['image']['thumbnail']); ?>
" border="0" /></a><br />
			<?php endif; ?>
			
			<?php $this->_tag_stack[] = array('hook', array('name' => "fileuploader:uploaded_files")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
				<?php if ($this->_tpl_vars['delete_link']): ?><a class="cm-ajax" href="<?php echo fn_url($this->_tpl_vars['delete_link']); ?>
"><?php endif; ?><?php if (! ( $this->_tpl_vars['po']['required'] == 'Y' && count($this->_tpl_vars['images']) == 1 )): ?><img src="<?php echo $this->_tpl_vars['images_dir']; ?>
/icons/icon_delete.gif" width="12" height="18" border="0" hspace="3" id="clean_selection_<?php echo $this->_tpl_vars['id_var_name']; ?>
_<?php echo $this->_tpl_vars['image']['file']; ?>
" alt="<?php echo fn_get_lang_var('remove_this_item', $this->getLanguage()); ?>
" title="<?php echo fn_get_lang_var('remove_this_item', $this->getLanguage()); ?>
" onclick="fileuploader.clean_selection(this.id); <?php if ($this->_tpl_vars['multiupload'] != 'Y'): ?>fileuploader.toggle_links('<?php echo $this->_tpl_vars['id_var_name']; ?>
', 'show');<?php endif; ?> fileuploader.check_required_field('<?php echo $this->_tpl_vars['id_var_name']; ?>
', '<?php echo $this->_tpl_vars['label_id']; ?>
');" class="hand valign" /><?php endif; ?><?php if ($this->_tpl_vars['delete_link']): ?></a><?php endif; ?><span><?php if ($this->_tpl_vars['download_link']): ?><a href="<?php echo fn_url($this->_tpl_vars['download_link']); ?>
"><?php endif; ?><?php echo $this->_tpl_vars['image']['name']; ?>
<?php if ($this->_tpl_vars['download_link']): ?></a><?php endif; ?></span>
			<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
		</p>
	</div>
<?php endforeach; endif; unset($_from); ?>

<div class="nowrap" id="file_uploader_<?php echo $this->_tpl_vars['id_var_name']; ?>
">
	<div class="upload-file-section" id="message_<?php echo $this->_tpl_vars['id_var_name']; ?>
" title="">
		<p class="cm-fu-file hidden"><img src="<?php echo $this->_tpl_vars['images_dir']; ?>
/icons/icon_delete.gif" width="12" height="18" border="0" hspace="3" id="clean_selection_<?php echo $this->_tpl_vars['id_var_name']; ?>
" alt="<?php echo fn_get_lang_var('remove_this_item', $this->getLanguage()); ?>
" title="<?php echo fn_get_lang_var('remove_this_item', $this->getLanguage()); ?>
" onclick="fileuploader.clean_selection(this.id); <?php if ($this->_tpl_vars['multiupload'] != 'Y'): ?>fileuploader.toggle_links(this.id, 'show');<?php endif; ?> fileuploader.check_required_field('<?php echo $this->_tpl_vars['id_var_name']; ?>
', '<?php echo $this->_tpl_vars['label_id']; ?>
');" class="hand valign" /><span></span></p>
		<?php if ($this->_tpl_vars['multiupload'] != 'Y'): ?><p class="cm-fu-no-file <?php if ($this->_tpl_vars['images']): ?>hidden<?php endif; ?>"><?php echo fn_get_lang_var('text_select_file', $this->getLanguage()); ?>
</p><?php endif; ?>
	</div>
	
	<?php echo '<div class="select-field upload-file-links '; ?><?php if ($this->_tpl_vars['multiupload'] != 'Y' && $this->_tpl_vars['images']): ?><?php echo 'hidden'; ?><?php endif; ?><?php echo '" id="link_container_'; ?><?php echo $this->_tpl_vars['id_var_name']; ?><?php echo '"><input type="hidden" name="file_'; ?><?php echo $this->_tpl_vars['var_name']; ?><?php echo '" value="'; ?><?php if ($this->_tpl_vars['image_name']): ?><?php echo ''; ?><?php echo $this->_tpl_vars['image_name']; ?><?php echo ''; ?><?php endif; ?><?php echo '" id="file_'; ?><?php echo $this->_tpl_vars['id_var_name']; ?><?php echo '" '; ?><?php if ($this->_tpl_vars['image']): ?><?php echo 'class="cm-image-field"'; ?><?php endif; ?><?php echo ' /><input type="hidden" name="type_'; ?><?php echo $this->_tpl_vars['var_name']; ?><?php echo '" value="'; ?><?php if ($this->_tpl_vars['image_name']): ?><?php echo 'local'; ?><?php endif; ?><?php echo '" id="type_'; ?><?php echo $this->_tpl_vars['id_var_name']; ?><?php echo '" '; ?><?php if ($this->_tpl_vars['image']): ?><?php echo 'class="cm-image-field"'; ?><?php endif; ?><?php echo ' /><div class="upload-file-local"><input type="file" name="file_'; ?><?php echo $this->_tpl_vars['var_name']; ?><?php echo '" id="_local_'; ?><?php echo $this->_tpl_vars['id_var_name']; ?><?php echo '" onchange="fileuploader.show_loader(this.id); '; ?><?php if ($this->_tpl_vars['multiupload'] == 'Y'): ?><?php echo 'fileuploader.check_image(this.id);'; ?><?php endif; ?><?php echo ' fileuploader.check_required_field(\''; ?><?php echo $this->_tpl_vars['id_var_name']; ?><?php echo '\', \''; ?><?php echo $this->_tpl_vars['label_id']; ?><?php echo '\');" onclick="$(this).removeAttr(\'value\');" value="" '; ?><?php if ($this->_tpl_vars['image']): ?><?php echo 'class="cm-image-field"'; ?><?php endif; ?><?php echo ' /><a id="local_'; ?><?php echo $this->_tpl_vars['id_var_name']; ?><?php echo '">'; ?><?php if ($this->_tpl_vars['images']): ?><?php echo ''; ?><?php echo smarty_modifier_default(@$this->_tpl_vars['upload_another_file_text'], fn_get_lang_var('upload_another_file', $this->getLanguage())); ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php echo smarty_modifier_default(@$this->_tpl_vars['upload_file_text'], fn_get_lang_var('local', $this->getLanguage())); ?><?php echo ''; ?><?php endif; ?><?php echo '</a></div>&nbsp;&nbsp;|&nbsp;&nbsp;'; ?><?php if (! ( $this->_tpl_vars['hide_server'] || defined('COMPANY_ID') || defined('RESTRICTED_ADMIN') )): ?><?php echo '<a onclick="fileuploader.show_loader(this.id);" id="server_'; ?><?php echo $this->_tpl_vars['id_var_name']; ?><?php echo '">'; ?><?php echo fn_get_lang_var('server', $this->getLanguage()); ?><?php echo '</a>&nbsp;&nbsp;|&nbsp;&nbsp;'; ?><?php endif; ?><?php echo '<a onclick="fileuploader.show_loader(this.id);" id="url_'; ?><?php echo $this->_tpl_vars['id_var_name']; ?><?php echo '">'; ?><?php echo fn_get_lang_var('url', $this->getLanguage()); ?><?php echo '</a>'; ?><?php if ($this->_tpl_vars['hidden_name']): ?><?php echo '<input type="hidden" name="'; ?><?php echo $this->_tpl_vars['hidden_name']; ?><?php echo '" value="'; ?><?php echo $this->_tpl_vars['hidden_value']; ?><?php echo '">'; ?><?php endif; ?><?php echo '</div>'; ?>

</div>

</div><!--fileuploader--><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
		</div>

		<div class="form-field">
			<label for="activation_<?php echo $this->_tpl_vars['product_file']['file_id']; ?>
"><?php echo fn_get_lang_var('activation_mode', $this->getLanguage()); ?>
:</label>
			<select name="product_file[activation_type]" id="activation_<?php echo $this->_tpl_vars['product_file']['file_id']; ?>
">
				<option value="M" <?php if ($this->_tpl_vars['product_file']['activation_type'] == 'M'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('manually', $this->getLanguage()); ?>
</option>
				<option value="I" <?php if ($this->_tpl_vars['product_file']['activation_type'] == 'I'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('immediately', $this->getLanguage()); ?>
</option>
				<option value="P" <?php if ($this->_tpl_vars['product_file']['activation_type'] == 'P'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('after_full_payment', $this->getLanguage()); ?>
</option>
			</select>
		</div>

		<div class="form-field">
			<label for="max_downloads_<?php echo $this->_tpl_vars['product_file']['file_id']; ?>
"><?php echo fn_get_lang_var('max_downloads', $this->getLanguage()); ?>
:</label>
			<input type="text" name="product_file[max_downloads]" id="max_downloads_<?php echo $this->_tpl_vars['product_file']['file_id']; ?>
" value="<?php echo $this->_tpl_vars['product_file']['max_downloads']; ?>
" size="3" class="input-text-short" />
		</div>

		<div class="form-field">
			<label for="license_<?php echo $this->_tpl_vars['product_file']['file_id']; ?>
"><?php echo fn_get_lang_var('license_agreement', $this->getLanguage()); ?>
:</label>
			<textarea id="license_<?php echo $this->_tpl_vars['product_file']['file_id']; ?>
" name="product_file[license]" cols="55" rows="8" class="cm-wysiwyg input-textarea-long"><?php echo $this->_tpl_vars['product_file']['license']; ?>
</textarea>
			
		</div>

		<div class="form-field">
			<label><?php echo fn_get_lang_var('agreement_required', $this->getLanguage()); ?>
:</label>
			<div class="select-field float-left nowrap">
				<input type="radio" name="product_file[agreement]" id="agreement_<?php echo $this->_tpl_vars['product_file']['file_id']; ?>
_y" <?php if ($this->_tpl_vars['product_file']['agreement'] == 'Y' || ! $this->_tpl_vars['product_file']): ?>checked="checked"<?php endif; ?> value="Y" class="radio" />
				<label for="agreement_<?php echo $this->_tpl_vars['product_file']['file_id']; ?>
_y"><?php echo fn_get_lang_var('yes', $this->getLanguage()); ?>
</label>
				<input type="radio" name="product_file[agreement]" id="agreement_<?php echo $this->_tpl_vars['product_file']['file_id']; ?>
_n" <?php if ($this->_tpl_vars['product_file']['agreement'] == 'N'): ?>checked="checked"<?php endif; ?> value="N" class="radio" />
				<label for="agreement_<?php echo $this->_tpl_vars['product_file']['file_id']; ?>
_n"><?php echo fn_get_lang_var('no', $this->getLanguage()); ?>
</label>
			</div>
		</div>

		<div class="form-field">
			<label for="readme_<?php echo $this->_tpl_vars['product_file']['file_id']; ?>
"><?php echo fn_get_lang_var('readme', $this->getLanguage()); ?>
:</label>
			<textarea id="readme_<?php echo $this->_tpl_vars['product_file']['file_id']; ?>
" name="product_file[readme]" cols="55" rows="8" class="cm-wysiwyg input-textarea-long"><?php echo $this->_tpl_vars['product_file']['readme']; ?>
</textarea>
			
		</div>
		<?php $this->_tag_stack[] = array('hook', array('name' => "product_files:properties")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
		<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
	</div>
</div>

<div class="buttons-container">
	<?php if ($this->_tpl_vars['product_file']): ?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/save_cancel.tpl", 'smarty_include_vars' => array('but_name' => "dispatch[products.update_file]",'cancel_action' => 'close','hide_first_button' => $this->_tpl_vars['hide_inputs'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php else: ?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/save_cancel.tpl", 'smarty_include_vars' => array('create' => true,'but_name' => "dispatch[products.update_file]",'cancel_action' => 'close')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php endif; ?>
</div>

</form>