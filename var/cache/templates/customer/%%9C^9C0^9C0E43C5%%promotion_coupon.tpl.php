<?php /* Smarty version 2.6.18, created on 2014-03-10 11:21:05
         compiled from views/checkout/components/promotion_coupon.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'fn_display_promotion_input_field', 'views/checkout/components/promotion_coupon.tpl', 16, false),array('modifier', 'fn_url', 'views/checkout/components/promotion_coupon.tpl', 17, false),array('modifier', 'trim', 'views/checkout/components/promotion_coupon.tpl', 22, false),array('modifier', 'escape', 'views/checkout/components/promotion_coupon.tpl', 39, false),array('modifier', 'replace', 'views/checkout/components/promotion_coupon.tpl', 66, false),array('modifier', 'unescape', 'views/checkout/components/promotion_coupon.tpl', 92, false),array('block', 'hook', 'views/checkout/components/promotion_coupon.tpl', 22, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('promo_code','promo_code','apply','coupon','delete','text_applied_promotions'));
?>
<?php 

				$rname = !empty($resource_name) ? $resource_name : $params['smarty_include_tpl_file'];
				if ($this->compile_check && empty($inline_no_check[$rname]) && $this->is_cached($rname)) {
					if ($this->check_inline_blocks(array (
  'views/checkout/components/applied_promotions.tpl' => 1367063747,
))) {
						$_smarty_compile_path = $this->_get_compile_path($rname);
						$this->_compile_resource($rname, $_smarty_compile_path);
						$inline_no_check[$rname] = true;
						include $_smarty_compile_path;
						return;
					}
				}
			 ?><div class="cm-tools-list code-input discount-coupon">
	<?php if (fn_display_promotion_input_field($this->_tpl_vars['cart'])): ?>
		<form class="cm-ajax cm-ajax-full-render" name="coupon_code_form<?php echo $this->_tpl_vars['position']; ?>
" action="<?php echo fn_url(""); ?>
" method="post">
			<input type="hidden" name="result_ids" value="checkout*,cart_status*,cart_items" />
			<input type="hidden" name="redirect_mode" value="<?php echo $this->_tpl_vars['location']; ?>
" />
			<input type="hidden" name="redirect_url" value="<?php echo $this->_tpl_vars['config']['current_url']; ?>
" />

			<?php if ($this->_tpl_vars['addons']['gift_certificates']['status'] == 'A'): ?><?php ob_start(); $this->_in_capture[] = '7cdd660e6e828c167470eb85ae6448e6';
$_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/gift_certificates/hooks/checkout/discount_coupons.override.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
$this->_tpl_vars['addon_content'] = ob_get_contents(); ob_end_clean(); array_pop($this->_in_capture); if (!empty($this->_scripts['7cdd660e6e828c167470eb85ae6448e6'])) { echo implode("\n", $this->_scripts['7cdd660e6e828c167470eb85ae6448e6']); unset($this->_scripts['7cdd660e6e828c167470eb85ae6448e6']); }
 ?><?php else: ?><?php $this->assign('addon_content', "", false); ?><?php endif; ?><?php if (trim($this->_tpl_vars['addon_content'])): ?><?php echo $this->_tpl_vars['addon_content']; ?>
<?php else: ?><?php $this->_tag_stack[] = array('hook', array('name' => "checkout:discount_coupons")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
				<div class="form-field input-append">
					<label for="coupon_field<?php echo $this->_tpl_vars['position']; ?>
" class="hidden cm-required"><?php echo fn_get_lang_var('promo_code', $this->getLanguage()); ?>
</label>
					<input type="text" class="input-text cm-hint" id="coupon_field<?php echo $this->_tpl_vars['position']; ?>
" name="coupon_code" size="40" value="<?php echo fn_get_lang_var('promo_code', $this->getLanguage()); ?>
" />
					<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('but_name' => "checkout.apply_coupon", 'alt' => fn_get_lang_var('apply', $this->getLanguage()), )); ?><button title="<?php echo $this->_tpl_vars['alt']; ?>
" class="go-button" type="submit"><?php if ($this->_tpl_vars['but_text']): ?><?php echo $this->_tpl_vars['but_text']; ?>
<?php endif; ?></button>
<input type="hidden" name="dispatch" value="<?php echo $this->_tpl_vars['but_name']; ?>
" /><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
				</div>
			<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php endif; ?>
		</form>
	<?php endif; ?>

	<?php $this->_tag_stack[] = array('hook', array('name' => "checkout:applied_discount_coupons")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
		<?php ob_start(); ?>
			<?php $this->_tag_stack[] = array('hook', array('name' => "checkout:applied_coupons_items")); $_block_repeat=true;smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
				<?php $_from = $this->_tpl_vars['cart']['coupons']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['coupon_code'] => $this->_tpl_vars['coupon']):
?>
				<li>
					<span><?php echo fn_get_lang_var('coupon', $this->getLanguage()); ?>
 "<?php echo $this->_tpl_vars['coupon_code']; ?>
"
					<?php $this->assign('_redirect_url', smarty_modifier_escape($this->_tpl_vars['config']['current_url'], 'url'), false); ?>
					<?php $this->assign('coupon_code', smarty_modifier_escape($this->_tpl_vars['coupon_code'], 'url'), false); ?>
					<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('but_href' => "checkout.delete_coupon?coupon_code=".($this->_tpl_vars['coupon_code'])."&redirect_url=".($this->_tpl_vars['_redirect_url']), 'but_role' => 'delete', 'but_meta' => "cm-ajax cm-ajax-full-render", 'but_rev' => "checkout*,cart_status*,cart_items", )); ?>

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
					</span>
				</li>
				<?php endforeach; endif; unset($_from); ?>
				<?php if ($this->_tpl_vars['applied_promotions']): ?>
				<li>
					<?php $__parent_tpl_vars = $this->_tpl_vars;$this->_tpl_vars = array_merge($this->_tpl_vars, array('location' => $this->_tpl_vars['location'], )); ?><div id="applied_promotions">
	<span class="block strong"><?php echo fn_get_lang_var('text_applied_promotions', $this->getLanguage()); ?>
</span>
	<ul>
	<?php $_from = $this->_tpl_vars['applied_promotions']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['promotion']):
?>
		<li>
			<?php if ($this->_tpl_vars['promotion']['short_description']): ?>
				<a id="sw_promo_description_<?php echo $this->_tpl_vars['promotion']['promotion_id']; ?>
"class="cm-combination"><?php echo smarty_modifier_unescape($this->_tpl_vars['promotion']['name']); ?>
</a>
				<div id="promo_description_<?php echo $this->_tpl_vars['promotion']['promotion_id']; ?>
" class="wysiwyg-content hidden"><?php echo smarty_modifier_unescape($this->_tpl_vars['promotion']['short_description']); ?>
</div>
			<?php else: ?>
				<?php echo smarty_modifier_unescape($this->_tpl_vars['promotion']['name']); ?>

			<?php endif; ?>
		</li>
	<?php endforeach; endif; unset($_from); ?>
	</ul>
<!--applied_promotions--></div><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
				</li>
				<?php endif; ?>
			<?php if ($this->_tpl_vars['addons']['gift_certificates']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/gift_certificates/hooks/checkout/applied_coupons_items.post.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
		<?php $this->_smarty_vars['capture']['promotion_info'] = ob_get_contents(); ob_end_clean(); ?>

		<?php if (trim($this->_smarty_vars['capture']['promotion_info'])): ?>
			<ul class="coupon-items discount-info">
				<li class="light-block-arrow-alt"></li>
				<?php echo $this->_smarty_vars['capture']['promotion_info']; ?>

			</ul>
		<?php endif; ?>
	<?php if ($this->_tpl_vars['addons']['reward_points']['status'] == 'A'): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "addons/reward_points/hooks/checkout/applied_discount_coupons.post.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
</div>