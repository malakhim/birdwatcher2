<?php /* Smarty version 2.6.18, created on 2014-03-07 22:31:26
         compiled from common_templates/attach_images.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'defined', 'common_templates/attach_images.tpl', 24, false),array('modifier', 'define', 'common_templates/attach_images.tpl', 25, false),array('modifier', 'explode', 'common_templates/attach_images.tpl', 48, false),array('modifier', 'default', 'common_templates/attach_images.tpl', 49, false),array('modifier', 'fn_url', 'common_templates/attach_images.tpl', 69, false),array('modifier', 'unescape', 'common_templates/attach_images.tpl', 99, false),array('modifier', 'fn_generate_thumbnail', 'common_templates/attach_images.tpl', 99, false),array('modifier', 'escape', 'common_templates/attach_images.tpl', 99, false),array('modifier', 'cat', 'common_templates/attach_images.tpl', 125, false),array('modifier', 'md5', 'common_templates/attach_images.tpl', 125, false),array('modifier', 'count', 'common_templates/attach_images.tpl', 159, false),array('block', 'hook', 'common_templates/attach_images.tpl', 65, false),array('function', 'math', 'common_templates/attach_images.tpl', 93, false),array('function', 'script', 'common_templates/attach_images.tpl', 122, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('text_thumbnail_manual_loading','thumbnail_manual_loading_link','delete_image_pair','thumbnail','delete_image','upload_another_file','local','local','remove_this_item','remove_this_item','remove_this_item','remove_this_item','text_select_file','upload_another_file','local','server','url','alt_text','popup_larger_image','delete_image','upload_another_file','local','local','remove_this_item','remove_this_item','remove_this_item','remove_this_item','text_select_file','upload_another_file','local','server','url','alt_text'));
?>
<?php  ob_start();  ?><?php 

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
			 ?>
<?php if (! defined('SMARTY_ATTACH_IMAGES_LOADED')): ?>
<?php $this->assign('tmp', define('SMARTY_ATTACH_IMAGES_LOADED', true), false); ?>
<script type="text/javascript">
	//<![CDATA[
	<?php echo '
	function fn_delete_image(r, p)
	{
		if (r.deleted == true) {
			$(\'#\' + p.result_ids).replaceWith(\'<img border="0" src="\' + images_dir + \'/no_image.gif" />\');
			$(\'a[rev=\' + p.result_ids + \']\').hide();
		}
	}
	
	function fn_delete_image_pair(r, p)
	{
		if (r.deleted == true) {
			$(\'#\' + p.result_ids).remove();
		}
	}
	'; ?>

	//]]>
</script>
<?php endif; ?>

<?php $this->assign('_plug', explode(".", ""), false); ?>
<?php $this->assign('key', smarty_modifier_default(@$this->_tpl_vars['image_key'], '0'), false); ?>
<?php $this->assign('object_id', smarty_modifier_default(@$this->_tpl_vars['image_object_id'], '0'), false); ?>
<?php $this->assign('name', smarty_modifier_default(@$this->_tpl_vars['image_name'], ""), false); ?>
<?php $this->assign('object_type', smarty_modifier_default(@$this->_tpl_vars['image_object_type'], ""), false); ?>
<?php $this->assign('type', smarty_modifier_default(@$this->_tpl_vars['image_type'], 'M'), false); ?>
<?php $this->assign('pair', smarty_modifier_default(@$this->_tpl_vars['image_pair'], @$this->_tpl_vars['_plug']), false); ?>
<?php $this->assign('suffix', smarty_modifier_default(@$this->_tpl_vars['image_suffix'], ""), false); ?>

<input type="hidden" name="<?php echo $this->_tpl_vars['name']; ?>
_image_data<?php echo $this->_tpl_vars['suffix']; ?>
[<?php echo $this->_tpl_vars['key']; ?>
][pair_id]" value="<?php echo $this->_tpl_vars['pair']['pair_id']; ?>
" class="cm-image-field" />
<input type="hidden" name="<?php echo $this->_tpl_vars['name']; ?>
_image_data<?php echo $this->_tpl_vars['suffix']; ?>
[<?php echo $this->_tpl_vars['key']; ?>
][type]" value="<?php echo smarty_modifier_default(@$this->_tpl_vars['type'], 'M'); ?>
" class="cm-image-field" />
<input type="hidden" name="<?php echo $this->_tpl_vars['name']; ?>
_image_data<?php echo $this->_tpl_vars['suffix']; ?>
[<?php echo $this->_tpl_vars['key']; ?>
][object_id]" value="<?php echo $this->_tpl_vars['object_id']; ?>
" class="cm-image-field" />

<div id="box_attach_images_<?php echo $this->_tpl_vars['name']; ?>
_<?php echo $this->_tpl_vars['key']; ?>
">
	<?php if ($this->_tpl_vars['no_thumbnail'] && ! $this->_tpl_vars['pair']['icon']): ?>
		<?php echo fn_get_lang_var('text_thumbnail_manual_loading', $this->getLanguage()); ?>
&nbsp;<a id="sw_load_thumbnail_<?php echo $this->_tpl_vars['name']; ?>
<?php echo $this->_tpl_vars['suffix']; ?>
<?php echo $this->_tpl_vars['key']; ?>
" class="cm-combination dashed"><?php echo fn_get_lang_var('thumbnail_manual_loading_link', $this->getLanguage()); ?>
</a>
	<?php endif; ?>
	<?php $this->_tag_stack[] = array('hook', array('name' => "attach_images:thumbnail")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
	<div class="clear <?php if ($this->_tpl_vars['no_thumbnail'] && ! $this->_tpl_vars['pair']['icon']): ?>hidden<?php endif; ?>" id="load_thumbnail_<?php echo $this->_tpl_vars['name']; ?>
<?php echo $this->_tpl_vars['suffix']; ?>
<?php echo $this->_tpl_vars['key']; ?>
">
	<?php if ($this->_tpl_vars['delete_pair'] && $this->_tpl_vars['pair']['pair_id']): ?>
		<div class="float-right">
			<a rev="box_attach_images_<?php echo $this->_tpl_vars['name']; ?>
_<?php echo $this->_tpl_vars['key']; ?>
" href="<?php echo fn_url("image.delete_image_pair?pair_id=".($this->_tpl_vars['pair']['pair_id'])."&amp;object_type=".($this->_tpl_vars['object_type'])); ?>
" class="cm-confirm cm-ajax delete" name="delete_image_pair"><?php echo fn_get_lang_var('delete_image_pair', $this->getLanguage()); ?>
</a>
		</div>
	<?php endif; ?>
		<?php if (! $this->_tpl_vars['hide_titles']): ?>
			<p>
				<span class="field-name"><?php echo smarty_modifier_default(@$this->_tpl_vars['icon_title'], fn_get_lang_var('thumbnail', $this->getLanguage())); ?>
</span>
				<?php if ($this->_tpl_vars['icon_text']): ?><span class="small-note"><?php echo $this->_tpl_vars['icon_text']; ?>
</span><?php endif; ?>
				<span class="field-name">:</span>
			</p>
		<?php endif; ?>
		
		<?php if (! $this->_tpl_vars['hide_images']): ?>
			<div class="float-left image">
				<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('image' => $this->_tpl_vars['pair']['icon'], 'image_id' => $this->_tpl_vars['pair']['image_id'], 'image_width' => 85, 'object_type' => $this->_tpl_vars['object_type'], )); ?><?php echo ''; ?><?php if (! $this->_tpl_vars['image_width']): ?><?php echo ''; ?><?php if ($this->_tpl_vars['image']['image_x']): ?><?php echo ''; ?><?php $this->assign('image_width', $this->_tpl_vars['image']['image_x'], false); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php if ($this->_tpl_vars['image']['image_y']): ?><?php echo ''; ?><?php $this->assign('image_height', $this->_tpl_vars['image']['image_y'], false); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php if ($this->_tpl_vars['image']['image_x'] && $this->_tpl_vars['image']['image_y']): ?><?php echo ''; ?><?php echo smarty_function_math(array('equation' => "new_x * y / x",'new_x' => $this->_tpl_vars['image_width'],'x' => $this->_tpl_vars['image']['image_x'],'y' => $this->_tpl_vars['image']['image_y'],'format' => "%d",'assign' => 'image_height'), $this);?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php if (! $this->_tpl_vars['image']['is_flash']): ?><?php echo ''; ?><?php if ($this->_tpl_vars['image']['image_x'] || $this->_tpl_vars['href']): ?><?php echo '<a href="'; ?><?php echo smarty_modifier_default(smarty_modifier_default(@$this->_tpl_vars['href'], @$this->_tpl_vars['image']['image_path']), @$this->_tpl_vars['config']['no_image_path']); ?><?php echo '" '; ?><?php if (! $this->_tpl_vars['href']): ?><?php echo 'target="_blank"'; ?><?php endif; ?><?php echo '>'; ?><?php endif; ?><?php echo '<img '; ?><?php if ($this->_tpl_vars['image_id']): ?><?php echo 'id="image_'; ?><?php echo $this->_tpl_vars['object_type']; ?><?php echo '_'; ?><?php echo $this->_tpl_vars['image_id']; ?><?php echo '"'; ?><?php endif; ?><?php echo ' src="'; ?><?php echo smarty_modifier_escape(fn_generate_thumbnail(smarty_modifier_unescape(smarty_modifier_default(@$this->_tpl_vars['image']['image_path'], @$this->_tpl_vars['config']['no_image_path'])), $this->_tpl_vars['image_width'], $this->_tpl_vars['image_height'])); ?><?php echo '" '; ?><?php if ($this->_tpl_vars['image_width']): ?><?php echo 'width="'; ?><?php echo $this->_tpl_vars['image_width']; ?><?php echo '"'; ?><?php endif; ?><?php echo ' '; ?><?php if ($this->_tpl_vars['image_height']): ?><?php echo 'height="'; ?><?php echo $this->_tpl_vars['image_height']; ?><?php echo '"'; ?><?php endif; ?><?php echo ' alt="'; ?><?php echo $this->_tpl_vars['image']['alt']; ?><?php echo '" title="'; ?><?php echo $this->_tpl_vars['image']['alt']; ?><?php echo '" border="0" />'; ?><?php if ($this->_tpl_vars['image']['image_x'] || $this->_tpl_vars['href']): ?><?php echo '</a>'; ?><?php endif; ?><?php echo ''; ?><?php else: ?><?php echo '<object '; ?><?php if ($this->_tpl_vars['image_id']): ?><?php echo 'id="image_'; ?><?php echo $this->_tpl_vars['object_type']; ?><?php echo '_'; ?><?php echo $this->_tpl_vars['image_id']; ?><?php echo '"'; ?><?php endif; ?><?php echo ' classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,0,0" '; ?><?php if ($this->_tpl_vars['image_width']): ?><?php echo 'width="'; ?><?php echo $this->_tpl_vars['image_width']; ?><?php echo '"'; ?><?php endif; ?><?php echo ' '; ?><?php if ($this->_tpl_vars['image_height']): ?><?php echo 'height="'; ?><?php echo $this->_tpl_vars['image_height']; ?><?php echo '"'; ?><?php endif; ?><?php echo '><param name="movie" value="'; ?><?php echo smarty_modifier_default(@$this->_tpl_vars['image']['image_path'], @$this->_tpl_vars['config']['no_image_path']); ?><?php echo '" /><param name="quality" value="high" /><param name="wmode" value="transparent" /><param name="allowScriptAccess" value="sameDomain" /><embed src="'; ?><?php echo smarty_modifier_default(@$this->_tpl_vars['image']['image_path'], @$this->_tpl_vars['config']['no_image_path']); ?><?php echo '" quality="high" wmode="transparent" '; ?><?php if ($this->_tpl_vars['image_width']): ?><?php echo 'width="'; ?><?php echo $this->_tpl_vars['image_width']; ?><?php echo '"'; ?><?php endif; ?><?php echo ' '; ?><?php if ($this->_tpl_vars['image_height']): ?><?php echo 'height="'; ?><?php echo $this->_tpl_vars['image_height']; ?><?php echo '"'; ?><?php endif; ?><?php echo ' allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" /></object>'; ?><?php endif; ?><?php echo ''; ?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
				<?php if ($this->_tpl_vars['pair']['image_id']): ?>
				<?php if (! ( @PRODUCT_TYPE == 'MULTIVENDOR' && defined('COMPANY_ID') && $this->_tpl_vars['object_type'] == 'category' )): ?>
				<p>
					<a rev="image_<?php echo $this->_tpl_vars['object_type']; ?>
_<?php echo $this->_tpl_vars['pair']['image_id']; ?>
" href="<?php echo fn_url("image.delete_image?pair_id=".($this->_tpl_vars['pair']['pair_id'])."&amp;image_id=".($this->_tpl_vars['pair']['image_id'])."&amp;object_type=".($this->_tpl_vars['object_type'])); ?>
" class="cm-confirm cm-ajax delete cm-delete-image-link" name="delete_image"><?php echo fn_get_lang_var('delete_image', $this->getLanguage()); ?>
</a>
				</p>
				<?php endif; ?>
				<?php endif; ?>
			</div>
		<?php endif; ?>
		<div class="float-left">
		<div class="attach-images-alt">
			<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('var_name' => ($this->_tpl_vars['name'])."_image_icon".($this->_tpl_vars['suffix'])."[".($this->_tpl_vars['key'])."]", 'image' => true, )); ?><?php echo smarty_function_script(array('src' => "js/fileuploader_scripts.js"), $this);?>

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

		<div>
			<?php if (! $this->_tpl_vars['hide_alt']): ?>
			<label class="option_variant_alt_text"><?php echo fn_get_lang_var('alt_text', $this->getLanguage()); ?>
:</label><br />
			<input type="text" class="input-text cm-image-field" id="alt_icon_<?php echo $this->_tpl_vars['name']; ?>
_<?php echo $this->_tpl_vars['key']; ?>
" name="<?php echo $this->_tpl_vars['name']; ?>
_image_data<?php echo $this->_tpl_vars['suffix']; ?>
[<?php echo $this->_tpl_vars['key']; ?>
][image_alt]" value="<?php echo $this->_tpl_vars['pair']['icon']['alt']; ?>
" />
			<?php endif; ?>
		</div>
		</div>
	</div>
	<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

	<?php if (! $this->_tpl_vars['no_detailed']): ?>
	<?php $this->_tag_stack[] = array('hook', array('name' => "attach_images:detailed")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
	<div class="margin-top">
		<?php if (! $this->_tpl_vars['hide_titles']): ?>
			<p>
				<span class="field-name"><?php echo smarty_modifier_default(@$this->_tpl_vars['detailed_title'], fn_get_lang_var('popup_larger_image', $this->getLanguage())); ?>
</span>
				<?php if ($this->_tpl_vars['detailed_text']): ?>
					<span class="small-note"><?php echo $this->_tpl_vars['detailed_text']; ?>
</span>
				<?php endif; ?>
				<span class="field-name">:</span>
			</p>
		<?php endif; ?>
		
		<?php if (! $this->_tpl_vars['hide_images']): ?>
			<div class="float-left image">
				<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('image' => $this->_tpl_vars['pair']['detailed'], 'image_id' => $this->_tpl_vars['pair']['detailed_id'], 'image_width' => 85, 'object_type' => 'detailed', )); ?><?php echo ''; ?><?php if (! $this->_tpl_vars['image_width']): ?><?php echo ''; ?><?php if ($this->_tpl_vars['image']['image_x']): ?><?php echo ''; ?><?php $this->assign('image_width', $this->_tpl_vars['image']['image_x'], false); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php if ($this->_tpl_vars['image']['image_y']): ?><?php echo ''; ?><?php $this->assign('image_height', $this->_tpl_vars['image']['image_y'], false); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php if ($this->_tpl_vars['image']['image_x'] && $this->_tpl_vars['image']['image_y']): ?><?php echo ''; ?><?php echo smarty_function_math(array('equation' => "new_x * y / x",'new_x' => $this->_tpl_vars['image_width'],'x' => $this->_tpl_vars['image']['image_x'],'y' => $this->_tpl_vars['image']['image_y'],'format' => "%d",'assign' => 'image_height'), $this);?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php if (! $this->_tpl_vars['image']['is_flash']): ?><?php echo ''; ?><?php if ($this->_tpl_vars['image']['image_x'] || $this->_tpl_vars['href']): ?><?php echo '<a href="'; ?><?php echo smarty_modifier_default(smarty_modifier_default(@$this->_tpl_vars['href'], @$this->_tpl_vars['image']['image_path']), @$this->_tpl_vars['config']['no_image_path']); ?><?php echo '" '; ?><?php if (! $this->_tpl_vars['href']): ?><?php echo 'target="_blank"'; ?><?php endif; ?><?php echo '>'; ?><?php endif; ?><?php echo '<img '; ?><?php if ($this->_tpl_vars['image_id']): ?><?php echo 'id="image_'; ?><?php echo $this->_tpl_vars['object_type']; ?><?php echo '_'; ?><?php echo $this->_tpl_vars['image_id']; ?><?php echo '"'; ?><?php endif; ?><?php echo ' src="'; ?><?php echo smarty_modifier_escape(fn_generate_thumbnail(smarty_modifier_unescape(smarty_modifier_default(@$this->_tpl_vars['image']['image_path'], @$this->_tpl_vars['config']['no_image_path'])), $this->_tpl_vars['image_width'], $this->_tpl_vars['image_height'])); ?><?php echo '" '; ?><?php if ($this->_tpl_vars['image_width']): ?><?php echo 'width="'; ?><?php echo $this->_tpl_vars['image_width']; ?><?php echo '"'; ?><?php endif; ?><?php echo ' '; ?><?php if ($this->_tpl_vars['image_height']): ?><?php echo 'height="'; ?><?php echo $this->_tpl_vars['image_height']; ?><?php echo '"'; ?><?php endif; ?><?php echo ' alt="'; ?><?php echo $this->_tpl_vars['image']['alt']; ?><?php echo '" title="'; ?><?php echo $this->_tpl_vars['image']['alt']; ?><?php echo '" border="0" />'; ?><?php if ($this->_tpl_vars['image']['image_x'] || $this->_tpl_vars['href']): ?><?php echo '</a>'; ?><?php endif; ?><?php echo ''; ?><?php else: ?><?php echo '<object '; ?><?php if ($this->_tpl_vars['image_id']): ?><?php echo 'id="image_'; ?><?php echo $this->_tpl_vars['object_type']; ?><?php echo '_'; ?><?php echo $this->_tpl_vars['image_id']; ?><?php echo '"'; ?><?php endif; ?><?php echo ' classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,0,0" '; ?><?php if ($this->_tpl_vars['image_width']): ?><?php echo 'width="'; ?><?php echo $this->_tpl_vars['image_width']; ?><?php echo '"'; ?><?php endif; ?><?php echo ' '; ?><?php if ($this->_tpl_vars['image_height']): ?><?php echo 'height="'; ?><?php echo $this->_tpl_vars['image_height']; ?><?php echo '"'; ?><?php endif; ?><?php echo '><param name="movie" value="'; ?><?php echo smarty_modifier_default(@$this->_tpl_vars['image']['image_path'], @$this->_tpl_vars['config']['no_image_path']); ?><?php echo '" /><param name="quality" value="high" /><param name="wmode" value="transparent" /><param name="allowScriptAccess" value="sameDomain" /><embed src="'; ?><?php echo smarty_modifier_default(@$this->_tpl_vars['image']['image_path'], @$this->_tpl_vars['config']['no_image_path']); ?><?php echo '" quality="high" wmode="transparent" '; ?><?php if ($this->_tpl_vars['image_width']): ?><?php echo 'width="'; ?><?php echo $this->_tpl_vars['image_width']; ?><?php echo '"'; ?><?php endif; ?><?php echo ' '; ?><?php if ($this->_tpl_vars['image_height']): ?><?php echo 'height="'; ?><?php echo $this->_tpl_vars['image_height']; ?><?php echo '"'; ?><?php endif; ?><?php echo ' allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" /></object>'; ?><?php endif; ?><?php echo ''; ?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
				<?php if ($this->_tpl_vars['pair']['detailed_id']): ?>
				<?php if (! ( @PRODUCT_TYPE == 'MULTIVENDOR' && defined('COMPANY_ID') && $this->_tpl_vars['object_type'] == 'category' )): ?>
				<p>
					<a rev="image_detailed_<?php echo $this->_tpl_vars['pair']['detailed_id']; ?>
" href="<?php echo fn_url("image.delete_image?pair_id=".($this->_tpl_vars['pair']['pair_id'])."&amp;image_id=".($this->_tpl_vars['pair']['detailed_id'])."&amp;object_type=detailed"); ?>
" class="cm-confirm cm-ajax delete cm-delete-image-link" name="delete_image"><?php echo fn_get_lang_var('delete_image', $this->getLanguage()); ?>
</a>
				</p>
				<?php endif; ?>
				<?php endif; ?>
			</div>
		<?php endif; ?>
		
		<div class="float-left attach-images-alt">
			<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('var_name' => ($this->_tpl_vars['name'])."_image_detailed".($this->_tpl_vars['suffix'])."[".($this->_tpl_vars['key'])."]", )); ?><?php echo smarty_function_script(array('src' => "js/fileuploader_scripts.js"), $this);?>

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
			<?php if (! $this->_tpl_vars['hide_alt']): ?>
			<label for="alt_det_<?php echo $this->_tpl_vars['name']; ?>
_<?php echo $this->_tpl_vars['key']; ?>
"><?php echo fn_get_lang_var('alt_text', $this->getLanguage()); ?>
:</label>
			<input type="text" class="input-text cm-image-field" id="alt_det_<?php echo $this->_tpl_vars['name']; ?>
_<?php echo $this->_tpl_vars['key']; ?>
" name="<?php echo $this->_tpl_vars['name']; ?>
_image_data<?php echo $this->_tpl_vars['suffix']; ?>
[<?php echo $this->_tpl_vars['key']; ?>
][detailed_alt]" value="<?php echo $this->_tpl_vars['pair']['detailed']['alt']; ?>
" />
			<?php endif; ?>
			<?php $this->_tag_stack[] = array('hook', array('name' => "attach_images:options_for_detailed")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
			<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
		</div>

	</div>
	<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
	<?php endif; ?>
</div><?php  ob_end_flush();  ?>