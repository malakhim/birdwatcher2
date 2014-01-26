<?php /* Smarty version 2.6.18, created on 2014-01-25 16:55:45
         compiled from C:/wamp5/www/dutchme2/skins/basic/admin/views/block_manager/render/container.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'htmlspecialchars_decode', 'C:/wamp5/www/dutchme2/skins/basic/admin/views/block_manager/render/container.tpl', 6, false),array('modifier', 'unescape', 'C:/wamp5/www/dutchme2/skins/basic/admin/views/block_manager/render/container.tpl', 6, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('top_container_not_used','bottom_container_not_used','insert_grid','insert_grid','container_options'));
?>
<?php  ob_start();  ?><div id="container_<?php echo $this->_tpl_vars['container']['container_id']; ?>
" class="container container_<?php echo $this->_tpl_vars['container']['width']; ?>
 <?php if ($this->_tpl_vars['container']['default'] != 1 && $this->_tpl_vars['container']['position'] != 'CENTRAL' && ! $this->_tpl_vars['dynamic_object']): ?>container-lock<?php endif; ?>">
	<?php if ($this->_tpl_vars['container']['default'] != 1 && $this->_tpl_vars['container']['position'] == 'TOP' && ! $this->_tpl_vars['dynamic_object']): ?><p><?php echo fn_get_lang_var('top_container_not_used', $this->getLanguage()); ?>
</p><?php endif; ?>
    <?php if ($this->_tpl_vars['container']['default'] != 1 && $this->_tpl_vars['container']['position'] == 'BOTTOM' && ! $this->_tpl_vars['dynamic_object']): ?><p><?php echo fn_get_lang_var('bottom_container_not_used', $this->getLanguage()); ?>
</p><?php endif; ?>

    <?php if ($this->_tpl_vars['container']['default'] == 1 || $this->_tpl_vars['container']['position'] == 'CENTRAL' || $this->_tpl_vars['dynamic_object']): ?>
        <?php echo smarty_modifier_unescape(htmlspecialchars_decode($this->_tpl_vars['content'])); ?>

    <?php endif; ?>
    
    <div class="clear"></div>
    <div class="grid-control-menu bm-control-menu">
        <?php if ($this->_tpl_vars['container']['default'] == 1 || $this->_tpl_vars['container']['position'] == 'CENTRAL' && ! $this->_tpl_vars['dynamic_object']): ?>
            <div class="cm-tooltip cm-action action-control-menu  bm-action-control-menu" title="<?php echo fn_get_lang_var('insert_grid', $this->getLanguage()); ?>
"></div>
            <div class="bm-drop-menu cm-popup-box">
                <div class="bm-drop-menu-hint"></div>
                <a href="#" class="cm-action bm-action-add-grid"><?php echo fn_get_lang_var('insert_grid', $this->getLanguage()); ?>
</a>
            </div>
        
            <div class="cm-tooltip cm-action action-properties bm-action-properties" title="<?php echo fn_get_lang_var('container_options', $this->getLanguage()); ?>
"></div>
        <?php endif; ?>

        <h4 class="grid-control-title"><?php echo fn_get_lang_var($this->_tpl_vars['container']['position'], $this->getLanguage()); ?>
</h4>
    </div>
<!--container_<?php echo $this->_tpl_vars['container']['container_id']; ?>
--></div>

<hr /><?php  ob_end_flush();  ?>