<?php /* Smarty version 2.6.18, created on 2013-09-21 19:14:02
         compiled from C:/wamp5/www/dutchme2/skins/basic/customer/blocks/menu/dropdown_horizontal.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'hook', 'C:/wamp5/www/dutchme2/skins/basic/customer/blocks/menu/dropdown_horizontal.tpl', 17, false),array('modifier', 'fn_form_dropdown_object_link', 'C:/wamp5/www/dutchme2/skins/basic/customer/blocks/menu/dropdown_horizontal.tpl', 26, false),array('modifier', 'md5', 'C:/wamp5/www/dutchme2/skins/basic/customer/blocks/menu/dropdown_horizontal.tpl', 27, false),array('modifier', 'count', 'C:/wamp5/www/dutchme2/skins/basic/customer/blocks/menu/dropdown_horizontal.tpl', 29, false),array('modifier', 'fn_check_second_level_child_array', 'C:/wamp5/www/dutchme2/skins/basic/customer/blocks/menu/dropdown_horizontal.tpl', 29, false),array('modifier', 'fn_check_is_active_menu_item', 'C:/wamp5/www/dutchme2/skins/basic/customer/blocks/menu/dropdown_horizontal.tpl', 29, false),array('modifier', 'replace', 'C:/wamp5/www/dutchme2/skins/basic/customer/blocks/menu/dropdown_horizontal.tpl', 105, false),array('function', 'math', 'C:/wamp5/www/dutchme2/skins/basic/customer/blocks/menu/dropdown_horizontal.tpl', 63, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('text_topmenu_view_more','text_topmenu_view_more','text_topmenu_more'));
?>
<?php  ob_start();  ?><?php 

				$rname = !empty($resource_name) ? $resource_name : $params['smarty_include_tpl_file'];
				if ($this->compile_check && empty($inline_no_check[$rname]) && $this->is_cached($rname)) {
					if ($this->check_inline_blocks(array (
  'blocks/topmenu_dropdown.tpl' => 1367063745,
))) {
						$_smarty_compile_path = $this->_get_compile_path($rname);
						$this->_compile_resource($rname, $_smarty_compile_path);
						$inline_no_check[$rname] = true;
						include $_smarty_compile_path;
						return;
					}
				}
			 ?>
<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('items' => $this->_tpl_vars['items'], 'item1_url' => true, 'name' => 'item', 'item_id' => 'param_id', 'childs' => 'subitems', )); ?><?php $this->_tag_stack[] = array('hook', array('name' => "blocks:topmenu_dropdown")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>

<?php if ($this->_tpl_vars['items']): ?>
	<div class="wrap-dropdown-multicolumns">
	    <ul class="dropdown-multicolumns clearfix">
		
		<?php $this->_tag_stack[] = array('hook', array('name' => "blocks:topmenu_dropdown_top_menu")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
		
		<?php $_from = $this->_tpl_vars['items']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['item1'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['item1']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['item1']):
        $this->_foreach['item1']['iteration']++;
?>
			<?php $this->assign('item1_url', fn_form_dropdown_object_link($this->_tpl_vars['item1'], $this->_tpl_vars['block']['type']), false); ?>
			<?php $this->assign('unique_elm_id', md5($this->_tpl_vars['item1_url']), false); ?>
			<?php $this->assign('unique_elm_id', "topmenu_".($this->_tpl_vars['block']['block_id'])."_".($this->_tpl_vars['unique_elm_id']), false); ?>
			<li class="<?php if (! $this->_tpl_vars['item1'][$this->_tpl_vars['childs']]): ?>nodrop<?php elseif (count($this->_tpl_vars['item1'][$this->_tpl_vars['childs']]) >= 6 && ( count($this->_tpl_vars['item1'][$this->_tpl_vars['childs']]) % 6 == 0 || count($this->_tpl_vars['item1'][$this->_tpl_vars['childs']]) % 6 == 5 ) && fn_check_second_level_child_array($this->_tpl_vars['item1'][$this->_tpl_vars['childs']], $this->_tpl_vars['childs'])): ?>fullwidth<?php endif; ?><?php if ($this->_tpl_vars['item1']['active'] || fn_check_is_active_menu_item($this->_tpl_vars['item1'], $this->_tpl_vars['block']['type'])): ?> cm-active<?php endif; ?>">
				<a<?php if ($this->_tpl_vars['item1_url']): ?> href="<?php echo $this->_tpl_vars['item1_url']; ?>
"<?php endif; ?><?php if ($this->_tpl_vars['item1'][$this->_tpl_vars['childs']]): ?> class="drop"<?php endif; ?>><?php echo $this->_tpl_vars['item1'][$this->_tpl_vars['name']]; ?>
</a>

			<?php if ($this->_tpl_vars['item1'][$this->_tpl_vars['childs']]): ?>

				<?php if (! fn_check_second_level_child_array($this->_tpl_vars['item1'][$this->_tpl_vars['childs']], $this->_tpl_vars['childs'])): ?>
				

				<div class="dropdown-1column">

						<div class="col-1 firstcolumn lastcolumn">
							<ul>
							
							<?php $this->_tag_stack[] = array('hook', array('name' => "blocks:topmenu_dropdown_2levels_elements")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
							
							<?php $_from = $this->_tpl_vars['item1'][$this->_tpl_vars['childs']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['item2'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['item2']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['item2']):
        $this->_foreach['item2']['iteration']++;
?>
								<?php $this->assign('item_url2', fn_form_dropdown_object_link($this->_tpl_vars['item2'], $this->_tpl_vars['block']['type']), false); ?>
								<li<?php if ($this->_tpl_vars['item2']['active'] || fn_check_is_active_menu_item($this->_tpl_vars['item2'], $this->_tpl_vars['block']['type'])): ?> class="cm-active"<?php endif; ?>><a<?php if ($this->_tpl_vars['item_url2']): ?> href="<?php echo $this->_tpl_vars['item_url2']; ?>
"<?php endif; ?>><?php echo $this->_tpl_vars['item2'][$this->_tpl_vars['name']]; ?>
</a></li>
							<?php endforeach; endif; unset($_from); ?>
							<?php if ($this->_tpl_vars['item1']['show_more'] && $this->_tpl_vars['item1_url']): ?>
								<li class="alt-link"><a href="<?php echo $this->_tpl_vars['item1_url']; ?>
"><?php echo fn_get_lang_var('text_topmenu_view_more', $this->getLanguage()); ?>
</a></li>
							<?php endif; ?>
							
							<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
							
							</ul> 

						</div>
					</div>
					
				<?php else: ?>
				
				
					<?php $this->assign('subitems_count', count($this->_tpl_vars['item1'][$this->_tpl_vars['childs']]), false); ?>
					<?php echo smarty_function_math(array('assign' => 'divider','equation' => "ceil(x / 6)",'x' => $this->_tpl_vars['subitems_count']), $this);?>

					<?php echo smarty_function_math(array('assign' => 'cols','equation' => "ceil(x / y)",'x' => $this->_tpl_vars['subitems_count'],'y' => $this->_tpl_vars['divider']), $this);?>


					<?php if ($this->_tpl_vars['cols'] == 1): ?>
						<?php $this->assign('dropdown_class', "dropdown-1column", false); ?>
					<?php elseif ($this->_tpl_vars['cols'] == 6): ?>
						<?php $this->assign('dropdown_class', "dropdown-fullwidth", false); ?>
					<?php else: ?>
						<?php $this->assign('dropdown_class', "dropdown-".($this->_tpl_vars['cols'])."columns", false); ?>
					<?php endif; ?>

					<div class="<?php echo $this->_tpl_vars['dropdown_class']; ?>
<?php if (($this->_foreach['item1']['iteration']-1) > 4 && ($this->_foreach['item1']['iteration'] == $this->_foreach['item1']['total'])): ?> drop-left<?php endif; ?>" id="<?php echo $this->_tpl_vars['unique_elm_id']; ?>
">
						<?php $this->_tag_stack[] = array('hook', array('name' => "blocks:topmenu_dropdown_3levels_cols")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
						
						<?php $_from = $this->_tpl_vars['item1'][$this->_tpl_vars['childs']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['item2'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['item2']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['item2']):
        $this->_foreach['item2']['iteration']++;
?>
							<div class="col-1<?php if (($this->_foreach['item2']['iteration']-1) % $this->_tpl_vars['cols'] == 0 || ($this->_foreach['item2']['iteration'] <= 1)): ?> firstcolumn<?php elseif (($this->_foreach['item2']['iteration']-1) % $this->_tpl_vars['cols'] == ( $this->_tpl_vars['cols'] - 1 ) || ($this->_foreach['item2']['iteration'] == $this->_foreach['item2']['total'])): ?> lastcolumn<?php endif; ?>">
								<?php $this->assign('item2_url', fn_form_dropdown_object_link($this->_tpl_vars['item2'], $this->_tpl_vars['block']['type']), false); ?>
								<h3<?php if ($this->_tpl_vars['item2']['active'] || fn_check_is_active_menu_item($this->_tpl_vars['item2'], $this->_tpl_vars['block']['type'])): ?> class="cm-active"<?php endif; ?>><a<?php if ($this->_tpl_vars['item2_url']): ?> href="<?php echo $this->_tpl_vars['item2_url']; ?>
"<?php endif; ?>><?php echo $this->_tpl_vars['item2'][$this->_tpl_vars['name']]; ?>
</a></h3>

								<?php if ($this->_tpl_vars['item2'][$this->_tpl_vars['childs']]): ?>
								<ul>
								<?php $this->_tag_stack[] = array('hook', array('name' => "blocks:topmenu_dropdown_3levels_col_elements")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
								<?php $_from = $this->_tpl_vars['item2'][$this->_tpl_vars['childs']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['item3'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['item3']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['item3']):
        $this->_foreach['item3']['iteration']++;
?>
									<?php $this->assign('item3_url', fn_form_dropdown_object_link($this->_tpl_vars['item3'], $this->_tpl_vars['block']['type']), false); ?>
									<li<?php if ($this->_tpl_vars['item3']['active'] || fn_check_is_active_menu_item($this->_tpl_vars['item3'], $this->_tpl_vars['block']['type'])): ?> class="cm-active"<?php endif; ?>><a<?php if ($this->_tpl_vars['item3_url']): ?> href="<?php echo $this->_tpl_vars['item3_url']; ?>
"<?php endif; ?>><?php echo $this->_tpl_vars['item3'][$this->_tpl_vars['name']]; ?>
</a></li>
								<?php endforeach; endif; unset($_from); ?>
								<?php if ($this->_tpl_vars['item2']['show_more'] && $this->_tpl_vars['item2_url']): ?>
									<li class="alt-link"><a href="<?php echo $this->_tpl_vars['item2_url']; ?>
"><?php echo fn_get_lang_var('text_topmenu_view_more', $this->getLanguage()); ?>
</a></li>
								<?php endif; ?>
								<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
								</ul> 
								<?php endif; ?>
							</div>

							<?php if (($this->_foreach['item2']['iteration']-1) % $this->_tpl_vars['cols'] == ( $this->_tpl_vars['cols'] - 1 ) && ! ($this->_foreach['item2']['iteration'] <= 1) && ! ($this->_foreach['item2']['iteration'] == $this->_foreach['item2']['total'])): ?>
							<div class="clear"></div><!-- Need for ie7 -->
							<?php endif; ?>

						<?php endforeach; endif; unset($_from); ?>

						<?php if ($this->_tpl_vars['item1']['show_more'] && $this->_tpl_vars['item1_url']): ?>
						<div class="dropdown-bottom">
							<a href="<?php echo $this->_tpl_vars['item1_url']; ?>
"><?php echo smarty_modifier_replace(fn_get_lang_var('text_topmenu_more', $this->getLanguage()), "[item]", $this->_tpl_vars['item1'][$this->_tpl_vars['name']]); ?>
</a>
						</div>
						<?php endif; ?>
						
						<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

					</div>

				<?php endif; ?>

			<?php endif; ?>
			</li>
		<?php endforeach; endif; unset($_from); ?>
		
		<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
		</ul>
		<div class="clear"></div>
	</div>
<?php endif; ?>

<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

<?php echo '
<script type="text/javascript">
//<![CDATA[
$(function(){
	// set dropdown menu width
	$(\'.dropdown-1column\').each(function() {
		var p = $(this).parents(\'li:first\');
		if (p.length) {
			$(this).css(\'min-width\', (p.width() + 10) + \'px\');
		}
	});
	var global_offset = $(\'.wrap-dropdown-multicolumns\').offset().top;
	$(\'.dropdown-fullwidth\').each(function(){
		var offset = $(this).parent(\'.fullwidth\').offset().top;
		$(this).css(\'top\', offset - global_offset + 25 + \'px\');
	});
});
//]]>
</script>
'; ?>

<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?><?php  ob_end_flush();  ?>