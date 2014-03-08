<?php /* Smarty version 2.6.18, created on 2014-03-08 23:39:05
         compiled from views/profiles/components/multiple_profiles.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'fn_query_remove', 'views/profiles/components/multiple_profiles.tpl', 29, false),array('modifier', 'fn_link_attach', 'views/profiles/components/multiple_profiles.tpl', 29, false),array('modifier', 'fn_url', 'views/profiles/components/multiple_profiles.tpl', 29, false),array('modifier', 'replace', 'views/profiles/components/multiple_profiles.tpl', 59, false),array('modifier', 'default', 'views/profiles/components/multiple_profiles.tpl', 91, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('select_profile','select_profile','delete','or','create_profile','create_profile','profile_name','new','main','main'));
?>
<?php 

				$rname = !empty($resource_name) ? $resource_name : $params['smarty_include_tpl_file'];
				if ($this->compile_check && empty($inline_no_check[$rname]) && $this->is_cached($rname)) {
					if ($this->check_inline_blocks(array (
  'buttons/button.tpl' => 1372320684,
))) {
						$_smarty_compile_path = $this->_get_compile_path($rname);
						$this->_compile_resource($rname, $_smarty_compile_path);
						$inline_no_check[$rname] = true;
						include $_smarty_compile_path;
						return;
					}
				}
			 ?><?php if ($this->_tpl_vars['settings']['General']['user_multiple_profiles'] == 'Y' && $this->_tpl_vars['auth']['user_id']): ?>

<?php if ($this->_tpl_vars['show_title']): ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/subheader.tpl", 'smarty_include_vars' => array('title' => fn_get_lang_var('select_profile', $this->getLanguage()))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php endif; ?>

<?php if (! $this->_tpl_vars['hide_profile_select']): ?>
<div class="form-field select-profile">
	<label><?php echo fn_get_lang_var('select_profile', $this->getLanguage()); ?>
:</label>

	<?php $_from = $this->_tpl_vars['user_profiles']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['pfe'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['pfe']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['up']):
        $this->_foreach['pfe']['iteration']++;
?>
		<?php if ($this->_tpl_vars['up']['profile_id'] == $this->_tpl_vars['profile_id']): ?>
		<strong><?php echo $this->_tpl_vars['up']['profile_name']; ?>
</strong>
		<?php else: ?>
		<a <?php if ($this->_tpl_vars['use_ajax']): ?>class="cm-ajax cm-ajax-force"<?php endif; ?> href="<?php echo fn_url(fn_link_attach(fn_query_remove($this->_tpl_vars['config']['current_url'], 'profile', 'selected_section'), "profile_id=".($this->_tpl_vars['up']['profile_id']))); ?>
" rev="checkout_steps,cart_items,checkout_totals"><?php echo $this->_tpl_vars['up']['profile_name']; ?>
</a>
		<?php endif; ?>
		<?php if (! ($this->_foreach['pfe']['iteration'] == $this->_foreach['pfe']['total'])): ?>&nbsp;|&nbsp;<?php endif; ?>

		<?php if ($this->_tpl_vars['up']['profile_type'] != 'P' && ! $this->_tpl_vars['hide_profile_delete']): ?>
			<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('but_meta' => "cm-confirm", 'but_rev' => "checkout_steps,cart_items,checkout_totals", 'but_role' => 'delete', 'but_text' => "&nbsp;", 'but_href' => "profiles.delete_profile?profile_id=".($this->_tpl_vars['up']['profile_id']), )); ?>

<?php if ($this->_tpl_vars['but_role'] == 'action'): ?>
	<?php $this->assign('suffix', "-action", false); ?>
	<?php $this->assign('file_prefix', 'action_', false); ?>
<?php elseif ($this->_tpl_vars['but_role'] == 'act'): ?>
	<?php $this->assign('suffix', "-act", false); ?>
	<?php $this->assign('file_prefix', 'action_', false); ?>
<?php elseif ($this->_tpl_vars['but_role'] == 'disabled_big'): ?>
	<?php $this->assign('suffix', "-disabled-big", false); ?>
<?php elseif ($this->_tpl_vars['but_role'] == 'big'): ?>
	<?php $this->assign('suffix', "-big", false); ?>
<?php elseif ($this->_tpl_vars['but_role'] == 'delete'): ?>
	<?php $this->assign('suffix', "-delete", false); ?>
<?php elseif ($this->_tpl_vars['but_role'] == 'tool'): ?>
	<?php $this->assign('suffix', "-tool", false); ?>
<?php else: ?>
	<?php $this->assign('suffix', "", false); ?>
<?php endif; ?>

<?php if ($this->_tpl_vars['but_name'] && $this->_tpl_vars['but_role'] != 'text' && $this->_tpl_vars['but_role'] != 'act' && $this->_tpl_vars['but_role'] != 'delete'): ?> 
	<span <?php if ($this->_tpl_vars['but_id']): ?>id="wrap_<?php echo $this->_tpl_vars['but_id']; ?>
"<?php endif; ?> <?php if ($this->_tpl_vars['but_css']): ?>style="<?php echo $this->_tpl_vars['but_css']; ?>
"<?php endif; ?> class="button-submit<?php echo $this->_tpl_vars['suffix']; ?>
 button-wrap-left"><span <?php if ($this->_tpl_vars['but_css']): ?>style="<?php echo $this->_tpl_vars['but_css']; ?>
"<?php endif; ?> class="button-submit<?php echo $this->_tpl_vars['suffix']; ?>
 button-wrap-right"><input <?php if ($this->_tpl_vars['but_id']): ?>id="<?php echo $this->_tpl_vars['but_id']; ?>
"<?php endif; ?> <?php if ($this->_tpl_vars['but_meta']): ?>class="<?php echo $this->_tpl_vars['but_meta']; ?>
"<?php endif; ?> type="submit" name="<?php echo $this->_tpl_vars['but_name']; ?>
" <?php if ($this->_tpl_vars['but_onclick']): ?>onclick="<?php echo $this->_tpl_vars['but_onclick']; ?>
"<?php endif; ?> value="<?php echo $this->_tpl_vars['but_text']; ?>
" /></span></span>

<?php elseif ($this->_tpl_vars['but_role'] == 'text' || $this->_tpl_vars['but_role'] == 'act' || $this->_tpl_vars['but_role'] == 'edit' || ( $this->_tpl_vars['but_role'] == 'text' && $this->_tpl_vars['but_name'] )): ?> 

	<a class="<?php if ($this->_tpl_vars['but_meta']): ?><?php echo $this->_tpl_vars['but_meta']; ?>
 <?php endif; ?><?php if ($this->_tpl_vars['but_name']): ?>cm-submit-link <?php endif; ?>text-button<?php echo $this->_tpl_vars['suffix']; ?>
"<?php if ($this->_tpl_vars['but_id']): ?> id="<?php echo $this->_tpl_vars['but_id']; ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_name']): ?> name="<?php echo smarty_modifier_replace(smarty_modifier_replace($this->_tpl_vars['but_name'], "[", ":-"), "]", "-:"); ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_href']): ?> href="<?php echo fn_url($this->_tpl_vars['but_href']); ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_onclick']): ?> onclick="<?php echo $this->_tpl_vars['but_onclick']; ?>
 return false;"<?php endif; ?><?php if ($this->_tpl_vars['but_target']): ?> target="<?php echo $this->_tpl_vars['but_target']; ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_rel']): ?> rel="<?php echo $this->_tpl_vars['but_rel']; ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_rev']): ?> rev="<?php echo $this->_tpl_vars['but_rev']; ?>
"<?php endif; ?>><?php echo $this->_tpl_vars['but_text']; ?>
</a>

<?php elseif ($this->_tpl_vars['but_role'] == 'delete'): ?>

	<a <?php if ($this->_tpl_vars['but_id']): ?>id="<?php echo $this->_tpl_vars['but_id']; ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_name']): ?> name="<?php echo smarty_modifier_replace(smarty_modifier_replace($this->_tpl_vars['but_name'], "[", ":-"), "]", "-:"); ?>
"<?php endif; ?> <?php if ($this->_tpl_vars['but_href']): ?>href="<?php echo fn_url($this->_tpl_vars['but_href']); ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_onclick']): ?> onclick="<?php echo $this->_tpl_vars['but_onclick']; ?>
 return false;"<?php endif; ?><?php if ($this->_tpl_vars['but_meta']): ?> class="<?php echo $this->_tpl_vars['but_meta']; ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_target']): ?> target="<?php echo $this->_tpl_vars['but_target']; ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_rel']): ?> rel="<?php echo $this->_tpl_vars['but_rel']; ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_rev']): ?> rev="<?php echo $this->_tpl_vars['but_rev']; ?>
"<?php endif; ?>><span title="<?php echo fn_get_lang_var('delete', $this->getLanguage()); ?>
" class="icon-delete-small"></span></a>

<?php elseif ($this->_tpl_vars['but_role'] == 'icon'): ?> 
	<a <?php if ($this->_tpl_vars['but_id']): ?>id="<?php echo $this->_tpl_vars['but_id']; ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_href']): ?> href="<?php echo fn_url($this->_tpl_vars['but_href']); ?>
"<?php endif; ?> <?php if ($this->_tpl_vars['but_onclick']): ?>onclick="<?php echo $this->_tpl_vars['but_onclick']; ?>
;<?php if (! $this->_tpl_vars['allow_href']): ?> return false;<?php endif; ?>"<?php endif; ?> <?php if ($this->_tpl_vars['but_target']): ?>target="<?php echo $this->_tpl_vars['but_target']; ?>
"<?php endif; ?> <?php if ($this->_tpl_vars['but_rel']): ?> rel="<?php echo $this->_tpl_vars['but_rel']; ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_rev']): ?> rev="<?php echo $this->_tpl_vars['but_rev']; ?>
"<?php endif; ?> class="<?php if ($this->_tpl_vars['but_meta']): ?> <?php echo $this->_tpl_vars['but_meta']; ?>
<?php endif; ?>"><?php echo $this->_tpl_vars['but_text']; ?>
</a>

<?php else: ?> 

	<span class="button<?php echo $this->_tpl_vars['suffix']; ?>
 button-wrap-left" <?php if ($this->_tpl_vars['but_id']): ?>id="<?php echo $this->_tpl_vars['but_id']; ?>
"<?php endif; ?>><span class="button<?php echo $this->_tpl_vars['suffix']; ?>
 button-wrap-right"><a <?php if ($this->_tpl_vars['but_href']): ?>href="<?php echo fn_url($this->_tpl_vars['but_href']); ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_onclick']): ?> onclick="<?php echo $this->_tpl_vars['but_onclick']; ?>
 return false;"<?php endif; ?> <?php if ($this->_tpl_vars['but_target']): ?>target="<?php echo $this->_tpl_vars['but_target']; ?>
"<?php endif; ?> class="<?php if ($this->_tpl_vars['but_meta']): ?><?php echo $this->_tpl_vars['but_meta']; ?>
 <?php endif; ?>" <?php if ($this->_tpl_vars['but_rel']): ?> rel="<?php echo $this->_tpl_vars['but_rel']; ?>
"<?php endif; ?><?php if ($this->_tpl_vars['but_rev']): ?>rev="<?php echo $this->_tpl_vars['but_rev']; ?>
"<?php endif; ?>><?php echo $this->_tpl_vars['but_text']; ?>
</a></span></span>

<?php endif; ?>
<?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
		<?php endif; ?>
	<?php endforeach; endif; unset($_from); ?>
	<?php if (! $this->_tpl_vars['skip_create']): ?>
		&nbsp;&nbsp;<?php echo fn_get_lang_var('or', $this->getLanguage()); ?>
&nbsp;&nbsp;&nbsp;<?php if ($this->_tpl_vars['_REQUEST']['profile'] == 'new'): ?><strong><?php echo fn_get_lang_var('create_profile', $this->getLanguage()); ?>
</strong><?php else: ?><a class="lowercase<?php if ($this->_tpl_vars['use_ajax']): ?> cm-ajax cm-ajax-force<?php endif; ?>" href="<?php if ($this->_tpl_vars['create_href']): ?><?php echo fn_url($this->_tpl_vars['create_href']); ?>
<?php else: ?><?php echo fn_url(fn_link_attach(fn_query_remove($this->_tpl_vars['config']['current_url'], 'profile_id', 'selected_section'), "profile=new")); ?>
<?php endif; ?>" rev="checkout_steps,cart_items,checkout_totals"><?php echo fn_get_lang_var('create_profile', $this->getLanguage()); ?>
</a><?php endif; ?>
	<?php endif; ?>
</div>
<?php endif; ?>

<?php if (! $this->_tpl_vars['hide_profile_name']): ?>
<div class="form-field">
	<label for="elm_profile_id" class="cm-required"><?php echo fn_get_lang_var('profile_name', $this->getLanguage()); ?>
:</label>
	<?php if ($this->_tpl_vars['action'] == 'add_profile' || $this->_tpl_vars['no_edit'] != 'Y'): ?>
		<?php $this->assign('profile_name', "- ".(fn_get_lang_var('new', $this->getLanguage()))." -", false); ?>
	<?php else: ?>
		<?php $this->assign('profile_name', fn_get_lang_var('main', $this->getLanguage()), false); ?>
	<?php endif; ?>

	<input type="hidden" name="user_data[profile_id]" value="<?php echo smarty_modifier_default(@$this->_tpl_vars['profile_id'], '0'); ?>
" />
	<input type="text" class="input-text" id="elm_profile_id" name="user_data[profile_name]" size="32" value="<?php echo smarty_modifier_default(@$this->_tpl_vars['user_data']['profile_name'], @$this->_tpl_vars['profile_name']); ?>
" />
</div>
<?php endif; ?>

<?php else: ?>
	<input type="hidden" id="profile_name" name="user_data[profile_name]" value="<?php echo smarty_modifier_default(@$this->_tpl_vars['user_data']['profile_name'], fn_get_lang_var('main', $this->getLanguage())); ?>
" />
<?php endif; ?>