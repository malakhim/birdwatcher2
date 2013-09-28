<?php /* Smarty version 2.6.18, created on 2013-09-28 16:51:54
         compiled from C:/wamp5/www/dutchme2/skins/basic/admin/views/block_manager/render/grid.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'C:/wamp5/www/dutchme2/skins/basic/admin/views/block_manager/render/grid.tpl', 1, false),array('modifier', 'htmlspecialchars_decode', 'C:/wamp5/www/dutchme2/skins/basic/admin/views/block_manager/render/grid.tpl', 2, false),array('modifier', 'unescape', 'C:/wamp5/www/dutchme2/skins/basic/admin/views/block_manager/render/grid.tpl', 2, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('add_grid_block','insert_grid','insert_block','grid_options','delete_grid','grid','insert_grid','insert_block','grid_options','delete_grid'));
?>
<?php  ob_start();  ?><div id="grid_<?php echo $this->_tpl_vars['grid']['grid_id']; ?>
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
<?php  ob_end_flush();  ?>