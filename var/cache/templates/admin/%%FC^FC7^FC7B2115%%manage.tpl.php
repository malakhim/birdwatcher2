<?php /* Smarty version 2.6.18, created on 2014-01-28 16:32:59
         compiled from views/block_manager/manage.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'script', 'views/block_manager/manage.tpl', 15, false),array('function', 'render_location', 'views/block_manager/manage.tpl', 110, false),array('modifier', 'default', 'views/block_manager/manage.tpl', 18, false),array('modifier', 'htmlspecialchars_decode', 'views/block_manager/manage.tpl', 64, false),array('modifier', 'unescape', 'views/block_manager/manage.tpl', 64, false),array('modifier', 'empty_tabs', 'views/block_manager/manage.tpl', 190, false),array('modifier', 'in_array', 'views/block_manager/manage.tpl', 196, false),array('modifier', 'fn_url', 'views/block_manager/manage.tpl', 197, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('add_grid_block','insert_grid','insert_block','grid_options','delete_grid','grid','insert_grid','insert_block','grid_options','delete_grid','new_location','add_location','block_manager','manage_blocks','export_locations','export_locations','import_locations','import_locations','editing_location','blocks'));
?>
<?php 

				$rname = !empty($resource_name) ? $resource_name : $params['smarty_include_tpl_file'];
				if ($this->compile_check && empty($inline_no_check[$rname]) && $this->is_cached($rname)) {
					if ($this->check_inline_blocks(array (
  'common_templates/tabsbox.tpl' => 1367063753,
))) {
						$_smarty_compile_path = $this->_get_compile_path($rname);
						$this->_compile_resource($rname, $_smarty_compile_path);
						$inline_no_check[$rname] = true;
						include $_smarty_compile_path;
						return;
					}
				}
			 ?><?php echo smarty_function_script(array('src' => "js/block_manager.js"), $this);?>


<script type="text/javascript">
	var selected_location = '<?php echo smarty_modifier_default(@$this->_tpl_vars['location']['location_id'], 0); ?>
';

	var dynamic_object_id = '<?php echo smarty_modifier_default(@$this->_tpl_vars['dynamic_object']['object_id'], 0); ?>
';
	var dynamic_object_type = '<?php echo smarty_modifier_default(@$this->_tpl_vars['dynamic_object_scheme']['object_type'], ''); ?>
';

	var BlockManager = new BlockManager_Class();

<?php echo '
	if (dynamic_object_id > 0) {
		var items = null;
	} else {
		var items = \'.block\';
	}

	$(function() {
		$(\'#content_location_\' + selected_location).appear(function(){
			BlockManager.init(\'.grid\', {
				// UI settings
				connectWith: \'.grid\',
				items: items,
				revert: true,
				placeholder: \'ui-hover-block\',
				opacity: 0.5,
				
				// BlockManager_Class settings
				container_class: \'container\',
				grid_class: \'grid\',
				block_class: \'block\',
				hover_element_class: \'hover-element\'
			});
		});
	});
'; ?>

</script>

<link href="<?php echo $this->_tpl_vars['config']['skin_path']; ?>
/block_manager.css" rel="stylesheet" type="text/css"/>
<?php if ($this->_tpl_vars['dynamic_object']['object_id'] > 0): ?>
	<link href="<?php echo $this->_tpl_vars['config']['skin_path']; ?>
/block_manager_in_tab.css" rel="stylesheet" type="text/css"/>
<?php endif; ?>
<link href="<?php echo $this->_tpl_vars['config']['skin_path']; ?>
/css/960/960.css" rel="stylesheet" type="text/css"/>

<div id="block_window" class="grid-block hidden"></div>
<div id="block_manager_menu" class="grid-menu hidden"></div>
<div id="block_manager_prop" class="grid-prop hidden"></div>

<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('default_class' => "base-grid hidden", 'show_menu' => true, )); ?><div id="grid_<?php echo $this->_tpl_vars['grid']['grid_id']; ?>
" class="<?php echo smarty_modifier_default(@$this->_tpl_vars['default_class'], 'grid'); ?>
 grid_<?php echo $this->_tpl_vars['grid']['width']; ?>
<?php if ($this->_tpl_vars['grid']['prefix']): ?> prefix_<?php echo $this->_tpl_vars['grid']['prefix']; ?>
<?php endif; ?><?php if ($this->_tpl_vars['grid']['suffix']): ?> suffix_<?php echo $this->_tpl_vars['grid']['suffix']; ?>
<?php endif; ?><?php if ($this->_tpl_vars['grid']['alpha']): ?> <?php echo $this->_tpl_vars['grid']['alpha']; ?>
<?php endif; ?><?php if ($this->_tpl_vars['grid']['omega']): ?> <?php echo $this->_tpl_vars['grid']['omega']; ?>
<?php endif; ?> <?php if ($this->_tpl_vars['grid']['content_align'] == 'RIGHT'): ?>bm-right-align<?php elseif ($this->_tpl_vars['grid']['content_align'] == 'LEFT'): ?>bm-left-align<?php else: ?>bm-full-width<?php endif; ?>" >
	<?php echo smarty_modifier_unescape(htmlspecialchars_decode($this->_tpl_vars['content'])); ?>

		<div class="bm-full-menu grid-control-menu bm-control-menu <?php if ($this->_tpl_vars['grid']['width'] <= 2): ?>hidden<?php endif; ?>">
			<?php if ($this->_tpl_vars['container']['default'] == 1 || $this->_tpl_vars['container']['position'] == 'CENTRAL' && ! $this->_tpl_vars['dynamic_object'] || $this->_tpl_vars['show_menu']): ?>
				
				<div class="cm-tooltip cm-action action-control-menu bm-action-control-menu" title="<?php echo fn_get_lang_var('add_grid_block', $this->getLanguage()); ?>
"></div>
				<div class="hidden"></div>
				
				<div class="bm-drop-menu cm-popup-box">
					<div class="bm-drop-menu-hint"></div>
					<a class="cm-action bm-action-add-grid"><?php echo fn_get_lang_var('insert_grid', $this->getLanguage()); ?>
</a>
					<a class="cm-action bm-action-add-block"><?php echo fn_get_lang_var('insert_block', $this->getLanguage()); ?>
</a>
				</div>

				<div class="cm-tooltip cm-action action-properties bm-action-properties" title="<?php echo fn_get_lang_var('grid_options', $this->getLanguage()); ?>
"></div>
				<div class="hidden"></div>

				<div class="cm-tooltip cm-action action-delete bm-action-delete extra" title="<?php echo fn_get_lang_var('delete_grid', $this->getLanguage()); ?>
"></div>
				<div class="hidden"></div>
			<?php endif; ?>
			<h4 class="grid-control-title <?php if ($this->_tpl_vars['grid']['width'] <= 2): ?>hidden<?php endif; ?>"><?php echo fn_get_lang_var('grid', $this->getLanguage()); ?>
&nbsp;<?php echo smarty_modifier_default(@$this->_tpl_vars['grid']['width'], '0'); ?>
</h4>
		</div>
		<?php if ($this->_tpl_vars['container']['default'] == 1 || $this->_tpl_vars['container']['position'] == 'CENTRAL' && ! $this->_tpl_vars['dynamic_object'] || $this->_tpl_vars['show_menu']): ?>
		<div class="bm-compact-menu <?php if ($this->_tpl_vars['grid']['width'] > 2): ?>hidden<?php endif; ?> grid-control-menu bm-control-menu">
			<div class="action-showmenu cm-action action-control-menu bm-action-control-menu">
				<div class="bm-drop-menu cm-popup-box" >
					<div class="bm-drop-menu-hint"></div>
					<a class="cm-action bm-action-add-grid"><?php echo fn_get_lang_var('insert_grid', $this->getLanguage()); ?>
</a>
					<a class="cm-action bm-action-add-block"><?php echo fn_get_lang_var('insert_block', $this->getLanguage()); ?>
</a>
					<a class="cm-action bm-action-properties"><?php echo fn_get_lang_var('grid_options', $this->getLanguage()); ?>
</a>
					<a class="cm-action bm-action-delete"><?php echo fn_get_lang_var('delete_grid', $this->getLanguage()); ?>
</a>
				</div>
			</div>
		</div>
		<?php endif; ?>
<!--grid_<?php echo $this->_tpl_vars['grid']['grid_id']; ?>
--></div>

<?php if ($this->_tpl_vars['grid']['clear']): ?>
	<div class="clear"></div>
<?php endif; ?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "views/block_manager/render/block.tpl", 'smarty_include_vars' => array('default_class' => "base-block hidden",'block_data' => true)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php ob_start(); ?>
<?php ob_start(); ?>

	<div id="content_location_<?php echo $this->_tpl_vars['location']['location_id']; ?>
">
		<?php echo smarty_function_render_location(array('dispatch' => $this->_tpl_vars['location']['dispatch'],'location_id' => $this->_tpl_vars['location']['location_id'],'area' => 'A','lang_code' => $this->_tpl_vars['location']['lang_code']), $this);?>

	</div>
<?php $this->_smarty_vars['capture']['tabsbox'] = ob_get_contents(); ob_end_clean(); ?>

<?php ob_start(); ?>
		<?php if (! $this->_tpl_vars['dynamic_object']['object_id']): ?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/popupbox.tpl", 'smarty_include_vars' => array('id' => 'add_new_location','text' => fn_get_lang_var('new_location', $this->getLanguage()),'link_text' => fn_get_lang_var('add_location', $this->getLanguage()),'act' => 'general','href' => "block_manager.update_location",'opener_ajax_class' => "cm-ajax",'link_class' => "cm-ajax-force",'content' => "")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

		<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/popupbox.tpl", 'smarty_include_vars' => array('id' => 'manage_blocks','text' => fn_get_lang_var('block_manager', $this->getLanguage()),'link_text' => fn_get_lang_var('manage_blocks', $this->getLanguage()),'link_class' => "cm-action bm-action-manage-blocks",'act' => 'general','content' => "",'general_class' => "action-btn")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

		<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/popupbox.tpl", 'smarty_include_vars' => array('id' => 'export_locations_manager','text' => fn_get_lang_var('export_locations', $this->getLanguage()),'link_text' => fn_get_lang_var('export_locations', $this->getLanguage()),'act' => 'general','href' => "block_manager.export_locations",'opener_ajax_class' => "cm-ajax",'link_class' => "cm-ajax-force",'content' => "",'general_class' => "action-btn")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

		<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/popupbox.tpl", 'smarty_include_vars' => array('id' => 'import_locations_manager','text' => fn_get_lang_var('import_locations', $this->getLanguage()),'link_text' => fn_get_lang_var('import_locations', $this->getLanguage()),'act' => 'general','href' => "block_manager.import_locations",'opener_ajax_class' => "cm-ajax",'link_class' => "cm-ajax-force",'content' => "",'general_class' => "action-btn")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php endif; ?>
<?php $this->_smarty_vars['capture']['tools'] = ob_get_contents(); ob_end_clean(); ?>

<?php ob_start(); ?>
		<?php if (! $this->_tpl_vars['dynamic_object']['object_id']): ?>
		<?php ob_start(); ?>
			<div class="text-button-settings"></div>			
		<?php $this->_smarty_vars['capture']['_link_text'] = ob_get_contents(); ob_end_clean(); ?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/popupbox.tpl", 'smarty_include_vars' => array('id' => "tab_location_".($this->_tpl_vars['location']['location_id']),'text' => (fn_get_lang_var('editing_location', $this->getLanguage())).": ".($this->_tpl_vars['location']['name']),'act' => 'edit','picker_meta' => "cm-clear-content",'href' => "block_manager.update_location?location=".($this->_tpl_vars['location']['location_id']),'opener_ajax_class' => "cm-ajax",'link_class' => "cm-ajax-force",'link_text' => $this->_smarty_vars['capture']['_link_text'],'content' => "")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php endif; ?>
<?php $this->_smarty_vars['capture']['active_tab_extra'] = ob_get_contents(); ob_end_clean(); ?>

<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('content' => $this->_smarty_vars['capture']['tabsbox'], 'active_tab' => "location_".($this->_tpl_vars['location']['location_id']), 'active_tab_extra' => $this->_smarty_vars['capture']['active_tab_extra'], )); ?><?php echo smarty_function_script(array('src' => "js/tabs.js"), $this);?>


<?php if (! $this->_tpl_vars['active_tab']): ?>
	<?php $this->assign('active_tab', $this->_tpl_vars['_REQUEST']['selected_section'], false); ?>
<?php endif; ?>

<?php $this->assign('empty_tab_ids', smarty_modifier_empty_tabs($this->_tpl_vars['content']), false); ?>

<?php if ($this->_tpl_vars['navigation']['tabs']): ?>
<div class="tabs cm-j-tabs<?php if ($this->_tpl_vars['track']): ?> cm-track<?php endif; ?>">
	<ul>
	<?php $_from = $this->_tpl_vars['navigation']['tabs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['tabs'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['tabs']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['tab']):
        $this->_foreach['tabs']['iteration']++;
?>
		<?php if (( ! $this->_tpl_vars['tabs_section'] || $this->_tpl_vars['tabs_section'] == $this->_tpl_vars['tab']['section'] ) && ( $this->_tpl_vars['tab']['hidden'] || ! smarty_modifier_in_array($this->_tpl_vars['key'], $this->_tpl_vars['empty_tab_ids']) )): ?>
		<li id="<?php echo $this->_tpl_vars['key']; ?>
<?php echo $this->_tpl_vars['id_suffix']; ?>
" class="<?php if ($this->_tpl_vars['tab']['hidden'] == 'Y'): ?>hidden <?php endif; ?><?php if ($this->_tpl_vars['tab']['js']): ?>cm-js<?php elseif ($this->_tpl_vars['tab']['ajax']): ?>cm-js cm-ajax<?php endif; ?><?php if ($this->_tpl_vars['key'] == $this->_tpl_vars['active_tab']): ?> cm-active<?php endif; ?>"><a <?php if ($this->_tpl_vars['tab']['href']): ?>href="<?php echo fn_url($this->_tpl_vars['tab']['href']); ?>
"<?php endif; ?>><?php echo $this->_tpl_vars['tab']['title']; ?>
</a><?php if ($this->_tpl_vars['key'] == $this->_tpl_vars['active_tab']): ?><?php echo $this->_tpl_vars['active_tab_extra']; ?>
<?php endif; ?></li>
		<?php endif; ?>
	<?php endforeach; endif; unset($_from); ?>
	</ul>
</div>
<div class="cm-tabs-content">
	<?php echo $this->_tpl_vars['content']; ?>

</div>
<?php else: ?>
	<?php echo $this->_tpl_vars['content']; ?>

<?php endif; ?><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>

<?php $this->_smarty_vars['capture']['mainbox'] = ob_get_contents(); ob_end_clean(); ?>

<?php if ($this->_tpl_vars['dynamic_object']['object_id']): ?>
	<?php echo $this->_smarty_vars['capture']['mainbox']; ?>

<?php else: ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/mainbox.tpl", 'smarty_include_vars' => array('title' => fn_get_lang_var('blocks', $this->getLanguage()),'content' => $this->_smarty_vars['capture']['mainbox'],'tools' => $this->_smarty_vars['capture']['tools'],'select_languages' => true)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php endif; ?>