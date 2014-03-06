<?php /* Smarty version 2.6.18, created on 2014-03-06 22:19:03
         compiled from views/block_manager/update_grid.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'views/block_manager/update_grid.tpl', 2, false),array('modifier', 'fn_url', 'views/block_manager/update_grid.tpl', 5, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('general','width','content_alignment','full_width','left','right','prefix','suffix','user_class'));
?>

<?php $this->assign('id', smarty_modifier_default(@$this->_tpl_vars['grid']['grid_id'], 0), false); ?>

<div id="grid_properties_<?php echo $this->_tpl_vars['id']; ?>
">
<form action="<?php echo fn_url(""); ?>
" method="post" class="cm-form-highlight" name="grid_update_form">

<?php if ($this->_tpl_vars['grid']['grid_id']): ?>
	<input type="hidden" name="grid_id" value="<?php echo $this->_tpl_vars['grid']['grid_id']; ?>
" />
<?php endif; ?>

<input type="hidden" name="container_id" value="<?php echo $this->_tpl_vars['params']['container_id']; ?>
" />
<input type="hidden" name="parent_id" value="<?php echo smarty_modifier_default(smarty_modifier_default(@$this->_tpl_vars['params']['parent_id'], @$this->_tpl_vars['grid']['parent_id']), 0); ?>
" />

<div class="tabs cm-j-tabs">
	<ul>
		<li class="cm-js cm-active"><a><?php echo fn_get_lang_var('general', $this->getLanguage()); ?>
</a></li>
	</ul>
</div>

<div class="cm-tabs-content">
<fieldset>
	<div class="form-field cm-no-hide-input">
		<label for="grid_width_<?php echo $this->_tpl_vars['id']; ?>
"><?php echo fn_get_lang_var('width', $this->getLanguage()); ?>
:</label>
		<select id="grid_width_<?php echo $this->_tpl_vars['id']; ?>
" name="width">
			<?php unset($this->_sections['width']);
$this->_sections['width']['name'] = 'width';
$this->_sections['width']['start'] = (int)0;
$this->_sections['width']['loop'] = is_array($_loop=smarty_modifier_default(@$this->_tpl_vars['params']['max_width'], 24)) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['width']['show'] = true;
$this->_sections['width']['max'] = $this->_sections['width']['loop'];
$this->_sections['width']['step'] = 1;
if ($this->_sections['width']['start'] < 0)
    $this->_sections['width']['start'] = max($this->_sections['width']['step'] > 0 ? 0 : -1, $this->_sections['width']['loop'] + $this->_sections['width']['start']);
else
    $this->_sections['width']['start'] = min($this->_sections['width']['start'], $this->_sections['width']['step'] > 0 ? $this->_sections['width']['loop'] : $this->_sections['width']['loop']-1);
if ($this->_sections['width']['show']) {
    $this->_sections['width']['total'] = min(ceil(($this->_sections['width']['step'] > 0 ? $this->_sections['width']['loop'] - $this->_sections['width']['start'] : $this->_sections['width']['start']+1)/abs($this->_sections['width']['step'])), $this->_sections['width']['max']);
    if ($this->_sections['width']['total'] == 0)
        $this->_sections['width']['show'] = false;
} else
    $this->_sections['width']['total'] = 0;
if ($this->_sections['width']['show']):

            for ($this->_sections['width']['index'] = $this->_sections['width']['start'], $this->_sections['width']['iteration'] = 1;
                 $this->_sections['width']['iteration'] <= $this->_sections['width']['total'];
                 $this->_sections['width']['index'] += $this->_sections['width']['step'], $this->_sections['width']['iteration']++):
$this->_sections['width']['rownum'] = $this->_sections['width']['iteration'];
$this->_sections['width']['index_prev'] = $this->_sections['width']['index'] - $this->_sections['width']['step'];
$this->_sections['width']['index_next'] = $this->_sections['width']['index'] + $this->_sections['width']['step'];
$this->_sections['width']['first']      = ($this->_sections['width']['iteration'] == 1);
$this->_sections['width']['last']       = ($this->_sections['width']['iteration'] == $this->_sections['width']['total']);
?>
				<?php $this->assign('index', $this->_sections['width']['index']+1, false); ?>
				<option value="<?php echo $this->_tpl_vars['index']; ?>
" <?php if ($this->_tpl_vars['index'] == $this->_tpl_vars['grid']['width']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['index']; ?>
</option>
			<?php endfor; endif; ?>
		</select>
	</div>

	<div class="form-field cm-no-hide-input">
		<label for="grid_content_align_<?php echo $this->_tpl_vars['id']; ?>
"><?php echo fn_get_lang_var('content_alignment', $this->getLanguage()); ?>
:</label>
		<select id="grid_content_align_<?php echo $this->_tpl_vars['id']; ?>
" name="content_align">
			<option value="FULL_WIDTH" <?php if ($this->_tpl_vars['grid']['content_align'] == 'FULL_WIDTH'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('full_width', $this->getLanguage()); ?>
</option>			
			<option value="LEFT" <?php if ($this->_tpl_vars['grid']['content_align'] == 'LEFT'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('left', $this->getLanguage()); ?>
</option>
			<option value="RIGHT" <?php if ($this->_tpl_vars['grid']['content_align'] == 'RIGHT'): ?>selected="selected"<?php endif; ?>><?php echo fn_get_lang_var('right', $this->getLanguage()); ?>
</option>
		</select>
	</div>

	<div class="form-field cm-no-hide-input">
		<label for="grid_prefix_<?php echo $this->_tpl_vars['id']; ?>
"><?php echo fn_get_lang_var('prefix', $this->getLanguage()); ?>
:</label>
		<select id="grid_prefix_<?php echo $this->_tpl_vars['id']; ?>
" name="prefix">
			<?php unset($this->_sections['prefix']);
$this->_sections['prefix']['name'] = 'prefix';
$this->_sections['prefix']['start'] = (int)0;
$this->_sections['prefix']['loop'] = is_array($_loop=smarty_modifier_default(@$this->_tpl_vars['params']['max_width'], 24)) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['prefix']['show'] = true;
$this->_sections['prefix']['max'] = $this->_sections['prefix']['loop'];
$this->_sections['prefix']['step'] = 1;
if ($this->_sections['prefix']['start'] < 0)
    $this->_sections['prefix']['start'] = max($this->_sections['prefix']['step'] > 0 ? 0 : -1, $this->_sections['prefix']['loop'] + $this->_sections['prefix']['start']);
else
    $this->_sections['prefix']['start'] = min($this->_sections['prefix']['start'], $this->_sections['prefix']['step'] > 0 ? $this->_sections['prefix']['loop'] : $this->_sections['prefix']['loop']-1);
if ($this->_sections['prefix']['show']) {
    $this->_sections['prefix']['total'] = min(ceil(($this->_sections['prefix']['step'] > 0 ? $this->_sections['prefix']['loop'] - $this->_sections['prefix']['start'] : $this->_sections['prefix']['start']+1)/abs($this->_sections['prefix']['step'])), $this->_sections['prefix']['max']);
    if ($this->_sections['prefix']['total'] == 0)
        $this->_sections['prefix']['show'] = false;
} else
    $this->_sections['prefix']['total'] = 0;
if ($this->_sections['prefix']['show']):

            for ($this->_sections['prefix']['index'] = $this->_sections['prefix']['start'], $this->_sections['prefix']['iteration'] = 1;
                 $this->_sections['prefix']['iteration'] <= $this->_sections['prefix']['total'];
                 $this->_sections['prefix']['index'] += $this->_sections['prefix']['step'], $this->_sections['prefix']['iteration']++):
$this->_sections['prefix']['rownum'] = $this->_sections['prefix']['iteration'];
$this->_sections['prefix']['index_prev'] = $this->_sections['prefix']['index'] - $this->_sections['prefix']['step'];
$this->_sections['prefix']['index_next'] = $this->_sections['prefix']['index'] + $this->_sections['prefix']['step'];
$this->_sections['prefix']['first']      = ($this->_sections['prefix']['iteration'] == 1);
$this->_sections['prefix']['last']       = ($this->_sections['prefix']['iteration'] == $this->_sections['prefix']['total']);
?>
				<?php $this->assign('index', $this->_sections['prefix']['index'], false); ?>
				<option value="<?php echo $this->_tpl_vars['index']; ?>
" <?php if ($this->_tpl_vars['index'] == $this->_tpl_vars['grid']['prefix']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['index']; ?>
</option>
			<?php endfor; endif; ?>
		</select>
	</div>

	<div class="form-field cm-no-hide-input">
		<label for="grid_suffix_<?php echo $this->_tpl_vars['id']; ?>
"><?php echo fn_get_lang_var('suffix', $this->getLanguage()); ?>
:</label>
		<select id="grid_suffix_<?php echo $this->_tpl_vars['id']; ?>
" name="suffix">
			<?php unset($this->_sections['suffix']);
$this->_sections['suffix']['name'] = 'suffix';
$this->_sections['suffix']['start'] = (int)0;
$this->_sections['suffix']['loop'] = is_array($_loop=smarty_modifier_default(@$this->_tpl_vars['params']['max_width'], 24)) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['suffix']['show'] = true;
$this->_sections['suffix']['max'] = $this->_sections['suffix']['loop'];
$this->_sections['suffix']['step'] = 1;
if ($this->_sections['suffix']['start'] < 0)
    $this->_sections['suffix']['start'] = max($this->_sections['suffix']['step'] > 0 ? 0 : -1, $this->_sections['suffix']['loop'] + $this->_sections['suffix']['start']);
else
    $this->_sections['suffix']['start'] = min($this->_sections['suffix']['start'], $this->_sections['suffix']['step'] > 0 ? $this->_sections['suffix']['loop'] : $this->_sections['suffix']['loop']-1);
if ($this->_sections['suffix']['show']) {
    $this->_sections['suffix']['total'] = min(ceil(($this->_sections['suffix']['step'] > 0 ? $this->_sections['suffix']['loop'] - $this->_sections['suffix']['start'] : $this->_sections['suffix']['start']+1)/abs($this->_sections['suffix']['step'])), $this->_sections['suffix']['max']);
    if ($this->_sections['suffix']['total'] == 0)
        $this->_sections['suffix']['show'] = false;
} else
    $this->_sections['suffix']['total'] = 0;
if ($this->_sections['suffix']['show']):

            for ($this->_sections['suffix']['index'] = $this->_sections['suffix']['start'], $this->_sections['suffix']['iteration'] = 1;
                 $this->_sections['suffix']['iteration'] <= $this->_sections['suffix']['total'];
                 $this->_sections['suffix']['index'] += $this->_sections['suffix']['step'], $this->_sections['suffix']['iteration']++):
$this->_sections['suffix']['rownum'] = $this->_sections['suffix']['iteration'];
$this->_sections['suffix']['index_prev'] = $this->_sections['suffix']['index'] - $this->_sections['suffix']['step'];
$this->_sections['suffix']['index_next'] = $this->_sections['suffix']['index'] + $this->_sections['suffix']['step'];
$this->_sections['suffix']['first']      = ($this->_sections['suffix']['iteration'] == 1);
$this->_sections['suffix']['last']       = ($this->_sections['suffix']['iteration'] == $this->_sections['suffix']['total']);
?>
				<?php $this->assign('index', $this->_sections['suffix']['index'], false); ?>
				<option value="<?php echo $this->_tpl_vars['index']; ?>
" <?php if ($this->_tpl_vars['index'] == $this->_tpl_vars['grid']['suffix']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['index']; ?>
</option>
			<?php endfor; endif; ?>
		</select>
	</div>

	<div class="form-field cm-no-hide-input">
		<label for="grid_user_class_<?php echo $this->_tpl_vars['id']; ?>
"><?php echo fn_get_lang_var('user_class', $this->getLanguage()); ?>
:</label>
		<input id="grid_user_class_<?php echo $this->_tpl_vars['id']; ?>
" class="input-text" name="user_class" value="<?php echo $this->_tpl_vars['grid']['user_class']; ?>
" />
	</div>

</fieldset>
</div>

<div class="buttons-container">
	<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "buttons/save_cancel.tpl", 'smarty_include_vars' => array('but_name' => "dispatch[block_manager.update_location]",'cancel_action' => 'close','but_meta' => "cm-dialog-closer")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>
</form>
<!--grid_properties_<?php echo $this->_tpl_vars['id']; ?>
--></div>