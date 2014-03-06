<?php /* Smarty version 2.6.18, created on 2014-03-06 16:42:34
         compiled from top.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'truncate', 'top.tpl', 18, false),array('modifier', 'fn_url', 'top.tpl', 22, false),array('modifier', 'escape', 'top.tpl', 22, false),array('modifier', 'defined', 'top.tpl', 48, false),array('modifier', 'sizeof', 'top.tpl', 71, false),array('modifier', 'substr', 'top.tpl', 75, false),array('modifier', 'fn_strlen', 'top.tpl', 76, false),array('block', 'hook', 'top.tpl', 156, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('view_storefront','search','loading','vendor','dashboard','go','search_tooltip'));
?>
<?php 

				$rname = !empty($resource_name) ? $resource_name : $params['smarty_include_tpl_file'];
				if ($this->compile_check && empty($inline_no_check[$rname]) && $this->is_cached($rname)) {
					if ($this->check_inline_blocks(array (
  'common_templates/quick_search.tpl' => 1367063753,
))) {
						$_smarty_compile_path = $this->_get_compile_path($rname);
						$this->_compile_resource($rname, $_smarty_compile_path);
						$inline_no_check[$rname] = true;
						include $_smarty_compile_path;
						return;
					}
				}
			 ?><div class="header-wrap">
<div id="header">
	<div id="logo">
		<?php $this->assign('name', smarty_modifier_truncate($this->_tpl_vars['settings']['Company']['company_name'], 40, "...", true), false); ?>
		

		
		<a href="<?php echo fn_url($this->_tpl_vars['index_script']); ?>
"><?php echo $this->_tpl_vars['name']; ?>
</a><a href="<?php echo smarty_modifier_escape(fn_url($this->_tpl_vars['config']['http_location'])); ?>
" class="view-storefront-icon" target="_blank" title="<?php echo fn_get_lang_var('view_storefront', $this->getLanguage()); ?>
">&nbsp;</a>
		

	</div>

	<div id="top_quick_links">
		<?php if ($this->_tpl_vars['auth']['user_id']): ?>
		<div class="nowrap">
			<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "top_quick_links.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</div>
		<?php endif; ?>
	</div>

	<div id="top_menu">
	<ul id="alt_menu">
	<?php if ($this->_tpl_vars['auth']['user_id'] && $this->_tpl_vars['navigation']['static']): ?>
	<?php $_from = $this->_tpl_vars['navigation']['static']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['first_level_top'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['first_level_top']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['first_level_title'] => $this->_tpl_vars['m']):
        $this->_foreach['first_level_top']['iteration']++;
?>
	<?php if ($this->_tpl_vars['first_level_title'] == 'administration' || $this->_tpl_vars['first_level_title'] == 'design' || $this->_tpl_vars['first_level_title'] == 'settings'): ?>
		<li<?php if ($this->_tpl_vars['first_level_title'] == $this->_tpl_vars['navigation']['selected_tab']): ?> class="active"<?php endif; ?>>
		<a class="drop <?php echo $this->_tpl_vars['first_level_title']; ?>
"><?php echo fn_get_lang_var($this->_tpl_vars['first_level_title'], $this->getLanguage()); ?>
</a>
			<div class="dropdown-column">
			<div class="dropdown-column-col">
				<ul>
				<?php $_from = $this->_tpl_vars['m']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['sec_level_top'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['sec_level_top']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['second_level_title'] => $this->_tpl_vars['second_level']):
        $this->_foreach['sec_level_top']['iteration']++;
?>
					<li class="<?php if ($this->_tpl_vars['second_level']['subitems']): ?>sub-level <?php endif; ?><?php if ($this->_tpl_vars['second_level_title'] == $this->_tpl_vars['navigation']['subsection']): ?>active<?php endif; ?>"><a href="<?php echo fn_url($this->_tpl_vars['second_level']['href']); ?>
"><?php if ($this->_tpl_vars['second_level']['title']): ?><?php echo $this->_tpl_vars['second_level']['title']; ?>
<?php else: ?><?php echo fn_get_lang_var($this->_tpl_vars['second_level_title'], $this->getLanguage()); ?>
<?php endif; ?></a>
					<?php if ($this->_tpl_vars['second_level']['subitems']): ?>
						<div class="dropdown-second-level<?php if (defined('COMPANY_ID')): ?> drop-left<?php endif; ?>">
						<ul>
						<?php $_from = $this->_tpl_vars['second_level']['subitems']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['subitem_title'] => $this->_tpl_vars['sm']):
?>
							<li<?php if ($this->_tpl_vars['subitem_title'] == $this->_tpl_vars['navigation']['subitem']): ?> class="active"<?php endif; ?>><a href="<?php echo $this->_tpl_vars['sm']['href']; ?>
"><?php echo fn_get_lang_var($this->_tpl_vars['subitem_title'], $this->getLanguage()); ?>
</a></li>
						<?php endforeach; endif; unset($_from); ?>
						</ul>
						</div>
					<?php endif; ?>
				</li>
				<?php endforeach; endif; unset($_from); ?>
				</ul>
				</div>
			</div>
		</li>
	<?php endif; ?>
	<?php endforeach; endif; unset($_from); ?>
	<?php endif; ?>

	</ul>
	</div>

<?php if (@PRODUCT_TYPE == 'MULTIVENDOR' || @PRODUCT_TYPE == 'ULTIMATE'): ?>
	<div class="float-left">
	<?php if (sizeof($this->_tpl_vars['s_companies']) > 1): ?>
		<?php if (defined('TRANSLATION_MODE')): ?>
			<?php $this->assign('company_name', $this->_tpl_vars['s_companies'][$this->_tpl_vars['s_company']]['company'], false); ?>
		<?php else: ?>
			<?php $this->assign('company_name', substr($this->_tpl_vars['s_companies'][$this->_tpl_vars['s_company']]['company'], 0, 40), false); ?>
			<?php if (fn_strlen($this->_tpl_vars['s_companies'][$this->_tpl_vars['s_company']]['company']) > 40): ?>
				<?php $this->assign('company_name', ($this->_tpl_vars['company_name'])."...", false); ?>
			<?php endif; ?>
		<?php endif; ?>
		<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('data_url' => "companies.get_companies_list?show_all=Y&action=href", 'text' => $this->_tpl_vars['company_name'], 'id' => 'top_company_id', )); ?><div class="tools-container inline ajax_select_object" <?php if ($this->_tpl_vars['elements_switcher_id']): ?> id="<?php echo $this->_tpl_vars['elements_switcher_id']; ?>
ajax_select_object"<?php endif; ?>>
	<?php if ($this->_tpl_vars['label']): ?><label><?php echo $this->_tpl_vars['label']; ?>
:</label><?php endif; ?>

	<?php if ($this->_tpl_vars['js_action']): ?>
	<script type="text/javascript">
	//<![CDATA[
		function fn_picker_js_action_<?php echo $this->_tpl_vars['id']; ?>
(elm) {
			<?php echo $this->_tpl_vars['js_action']; ?>

		}
	//]]>
	</script>
	<?php endif; ?> 

	<a id="sw_<?php echo $this->_tpl_vars['id']; ?>
_wrap_" class="select-link <?php if (! $this->_tpl_vars['elements_switcher_id']): ?> cm-combo-on cm-combination<?php endif; ?>"><?php echo $this->_tpl_vars['text']; ?>
</a>

	<div id="<?php echo $this->_tpl_vars['id']; ?>
_wrap_" class="popup-tools cm-popup-box cm-smart-position hidden">
		<div class="select-object-search"><input type="text" value="<?php echo fn_get_lang_var('search', $this->getLanguage()); ?>
..." class="input-text cm-hint cm-ajax-content-input" rev="content_loader_<?php echo $this->_tpl_vars['id']; ?>
" size="16" /></div>
		<div class="ajax-popup-tools" id="scroller_<?php echo $this->_tpl_vars['id']; ?>
">
			<ul class="cm-select-list" id="<?php echo $this->_tpl_vars['id']; ?>
">
				<?php $_from = $this->_tpl_vars['objects']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['object_id'] => $this->_tpl_vars['item']):
?>
					<?php if (defined('TRANSLATION_MODE')): ?>
						<?php $this->assign('name', $this->_tpl_vars['item']['name'], false); ?>
					<?php else: ?>
						<?php $this->assign('name', smarty_modifier_truncate($this->_tpl_vars['item']['name'], 40, "...", true), false); ?>
					<?php endif; ?>

					<li class="<?php echo $this->_tpl_vars['item']['extra_class']; ?>
"><a action="<?php echo $this->_tpl_vars['item']['value']; ?>
" title="<?php echo $this->_tpl_vars['item']['name']; ?>
"><?php echo $this->_tpl_vars['name']; ?>
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
	<?php else: ?>
			<?php echo fn_get_lang_var('vendor', $this->getLanguage()); ?>
: <a href="<?php echo fn_url("companies.update?company_id=".($this->_tpl_vars['s_company'])); ?>
"><?php echo $this->_tpl_vars['s_companies'][$this->_tpl_vars['s_company']]['company']; ?>
</a>
	<?php endif; ?>
	</div>
<?php endif; ?>
	<ul id="menu">
		<li class="dashboard <?php if (! $this->_tpl_vars['navigation']['selected_tab']): ?>dashboard-active<?php endif; ?>">
			<a href="<?php echo fn_url($this->_tpl_vars['index_script']); ?>
" title="<?php echo fn_get_lang_var('dashboard', $this->getLanguage()); ?>
">&nbsp;</a>
		</li>

		<?php if ($this->_tpl_vars['auth']['user_id'] && $this->_tpl_vars['navigation']['static']): ?>
		<?php $_from = $this->_tpl_vars['navigation']['static']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['first_level'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['first_level']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['first_level_title'] => $this->_tpl_vars['m']):
        $this->_foreach['first_level']['iteration']++;
?>
		<?php if ($this->_tpl_vars['first_level_title'] != 'administration' && $this->_tpl_vars['first_level_title'] != 'design' && $this->_tpl_vars['first_level_title'] != 'settings'): ?>
		<li<?php if ($this->_tpl_vars['first_level_title'] == $this->_tpl_vars['navigation']['selected_tab']): ?> class="active"<?php endif; ?>>
			<a class="drop"><?php echo fn_get_lang_var($this->_tpl_vars['first_level_title'], $this->getLanguage()); ?>
</a>
			<div class="dropdown-column">
				<div class="dropdown-column-col">
				<ul>
				<?php $_from = $this->_tpl_vars['m']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['sec_level'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['sec_level']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['second_level_title'] => $this->_tpl_vars['second_level']):
        $this->_foreach['sec_level']['iteration']++;
?>
					<li class="blank <?php echo $this->_tpl_vars['second_level_title']; ?>
<?php if ($this->_tpl_vars['second_level']['subitems']): ?> sub-level<?php endif; ?><?php if ($this->_tpl_vars['second_level_title'] == $this->_tpl_vars['navigation']['subsection'] && $this->_tpl_vars['first_level_title'] == $this->_tpl_vars['navigation']['selected_tab']): ?> active<?php endif; ?>"><a href="<?php echo fn_url($this->_tpl_vars['second_level']['href']); ?>
"><span><?php echo fn_get_lang_var($this->_tpl_vars['second_level_title'], $this->getLanguage()); ?>
</span>
						<?php if (fn_get_lang_var($this->_tpl_vars['second_level']['description'], $this->getLanguage()) != "_".($this->_tpl_vars['second_level_title'])."_menu_description"): ?><?php if ($this->_tpl_vars['settings']['Appearance']['show_menu_descriptions'] == 'Y'): ?><span class="hint"><?php echo fn_get_lang_var($this->_tpl_vars['second_level']['description'], $this->getLanguage()); ?>
</span><?php endif; ?><?php endif; ?></a>
						<?php if ($this->_tpl_vars['second_level']['subitems']): ?>
							<div class="dropdown-second-level">
							<ul>
							<?php $_from = $this->_tpl_vars['second_level']['subitems']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['subitem_title'] => $this->_tpl_vars['sm']):
?>
								<li<?php if ($this->_tpl_vars['subitem_title'] == $this->_tpl_vars['navigation']['subitem']): ?> class="active"<?php endif; ?>><a href="<?php echo $this->_tpl_vars['sm']['href']; ?>
"><?php echo fn_get_lang_var($this->_tpl_vars['subitem_title'], $this->getLanguage()); ?>
</a></li>
							<?php endforeach; endif; unset($_from); ?>
							</ul>
							</div>
						<?php endif; ?>
					</li>
				<?php endforeach; endif; unset($_from); ?>
				</ul>
				</div>
			</div>
		</li>
		<?php endif; ?>
		<?php endforeach; endif; unset($_from); ?>
		<?php endif; ?>
		<li class="search">
			<?php $__parent_tpl_vars = $this->_tpl_vars; ?><?php $this->_tag_stack[] = array('hook', array('name' => "index:global_search")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
	<form id="global_search" method="get" action="<?php echo fn_url(""); ?>
">
		<input type="hidden" name="dispatch" value="search.results" />
		<input type="hidden" name="compact" value="Y" />
		<div>
			<button type="submit" id="search_button"><?php echo fn_get_lang_var('go', $this->getLanguage()); ?>
</button>
			<label for="gs_text"><a><input type="text" class="cm-tooltip cm-autocomplete-off" id="gs_text" name="q" value="<?php echo $this->_tpl_vars['_REQUEST']['q']; ?>
" title="<?php echo fn_get_lang_var('search_tooltip', $this->getLanguage()); ?>
" /></a></label>
		</div>
	</form>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
		</li>
	</ul>
<!--header--></div></div>

<?php echo '
<script type="text/javascript">
//<![CDATA[
$(function() {
	if ($.isMobile()) {
		$("#menu li a").click(function(){
		});
		$("#top_menu li a").click(function(){
		});
		$(\'#header\').css(\'padding-top\', \'15px !important\'); 
	}
});
//]]>
</script>
'; ?>