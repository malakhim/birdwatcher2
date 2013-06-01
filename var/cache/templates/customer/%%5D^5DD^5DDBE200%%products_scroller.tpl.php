<?php /* Smarty version 2.6.18, created on 2013-06-01 19:33:01
         compiled from C:/wamp5/www/dutchme2/skins/basic/customer/blocks/products/products_scroller.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'math', 'C:/wamp5/www/dutchme2/skins/basic/customer/blocks/products/products_scroller.tpl', 30, false),array('function', 'script', 'C:/wamp5/www/dutchme2/skins/basic/customer/blocks/products/products_scroller.tpl', 92, false),array('modifier', 'fn_url', 'C:/wamp5/www/dutchme2/skins/basic/customer/blocks/products/products_scroller.tpl', 52, false),array('modifier', 'unescape', 'C:/wamp5/www/dutchme2/skins/basic/customer/blocks/products/products_scroller.tpl', 59, false),array('modifier', 'truncate', 'C:/wamp5/www/dutchme2/skins/basic/customer/blocks/products/products_scroller.tpl', 59, false),array('modifier', 'escape', 'C:/wamp5/www/dutchme2/skins/basic/customer/blocks/products/products_scroller.tpl', 59, false),array('modifier', 'urlencode', 'C:/wamp5/www/dutchme2/skins/basic/customer/blocks/products/products_scroller.tpl', 66, false),array('modifier', 'default', 'C:/wamp5/www/dutchme2/skins/basic/customer/blocks/products/products_scroller.tpl', 102, false),array('modifier', 'count', 'C:/wamp5/www/dutchme2/skins/basic/customer/blocks/products/products_scroller.tpl', 116, false),array('modifier', 'sizeof', 'C:/wamp5/www/dutchme2/skins/basic/customer/blocks/products/products_scroller.tpl', 133, false),)), $this); ?>
<?php
fn_preload_lang_vars(array('quick_view'));
?>
<?php 

				$rname = !empty($resource_name) ? $resource_name : $params['smarty_include_tpl_file'];
				if ($this->compile_check && empty($inline_no_check[$rname]) && $this->is_cached($rname)) {
					if ($this->check_inline_blocks(array (
  'common_templates/scroller_init.tpl' => 1367063745,
))) {
						$_smarty_compile_path = $this->_get_compile_path($rname);
						$this->_compile_resource($rname, $_smarty_compile_path);
						$inline_no_check[$rname] = true;
						include $_smarty_compile_path;
						return;
					}
				}
			 ?>
<?php if ($this->_tpl_vars['scrollers_initialization'] != 'Y'): ?>
<script type="text/javascript">
//<![CDATA[
var scroller_directions = "";
var scrollers_list = [];
//]]>
</script>
<?php ob_start(); ?>Y<?php $this->_smarty_vars['capture']['scrollers_initialization'] = ob_get_contents(); ob_end_clean(); ?>
<?php endif; ?>

<?php $this->assign('obj_prefix', ($this->_tpl_vars['block']['block_id'])."000", false); ?>

<?php $this->assign('delim_width', '50', false); ?>
<?php echo smarty_function_math(array('equation' => "delim_w + image_w",'assign' => 'item_width','image_w' => $this->_tpl_vars['block']['properties']['thumbnail_width'],'delim_w' => $this->_tpl_vars['delim_width']), $this);?>

<?php $this->assign('item_qty', $this->_tpl_vars['block']['properties']['item_quantity'], false); ?>

	<ul id="scroll_list_<?php echo $this->_tpl_vars['block']['block_id']; ?>
" class="jcarousel jcarousel-skin hidden">
		<?php $this->assign('image_h', $this->_tpl_vars['block']['properties']['thumbnail_width'], false); ?>
		<?php $this->assign('text_h', '65', false); ?>
		<?php if ($this->_tpl_vars['block']['properties']['hide_add_to_cart_button'] == 'N'): ?>
		<?php echo smarty_function_math(array('equation' => "text_h + 20",'assign' => 'text_h','text_h' => $this->_tpl_vars['text_h']), $this);?>

		<?php endif; ?>
		<?php if ($this->_tpl_vars['block']['properties']['show_price'] == 'Y'): ?>
		<?php echo smarty_function_math(array('equation' => "text_h + 20",'assign' => 'text_h','text_h' => $this->_tpl_vars['text_h']), $this);?>

		<?php endif; ?>

		<?php echo smarty_function_math(array('equation' => "item_qty + image_h + text_h",'assign' => 'item_height','image_h' => $this->_tpl_vars['image_h'],'text_h' => $this->_tpl_vars['text_h'],'item_qty' => $this->_tpl_vars['item_qty']), $this);?>


		<?php $_from = $this->_tpl_vars['items']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['for_products'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['for_products']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['product']):
        $this->_foreach['for_products']['iteration']++;
?>
			<li>
			<?php $this->assign('obj_id', "scr_".($this->_tpl_vars['block']['block_id'])."000".($this->_tpl_vars['product']['product_id']), false); ?>
			<?php $this->assign('img_object_type', 'product', false); ?>
			<?php ob_start(); $this->_in_capture[] = '81444c5b101b159dfd3996f2f59e6136';
$_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "common_templates/image.tpl", 'smarty_include_vars' => array('image_width' => $this->_tpl_vars['block']['properties']['thumbnail_width'],'image_height' => $this->_tpl_vars['block']['properties']['thumbnail_width'],'images' => $this->_tpl_vars['product']['main_pair'],'no_ids' => true,'object_type' => $this->_tpl_vars['img_object_type'],'show_thumbnail' => 'Y')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
$this->_tpl_vars['object_img'] = ob_get_contents(); ob_end_clean(); array_pop($this->_in_capture); if (!empty($this->_scripts['81444c5b101b159dfd3996f2f59e6136'])) { echo implode("\n", $this->_scripts['81444c5b101b159dfd3996f2f59e6136']); unset($this->_scripts['81444c5b101b159dfd3996f2f59e6136']); }
 ?>
			<div class="jscroll-item" width="<?php echo $this->_tpl_vars['item_width']; ?>
">
				<div class="center product-image" style="height: <?php echo $this->_tpl_vars['image_h']; ?>
px;">
					<a href="<?php echo fn_url("products.view?product_id=".($this->_tpl_vars['product']['product_id'])); ?>
"><?php echo $this->_tpl_vars['object_img']; ?>
</a>
					<?php if ($this->_tpl_vars['block']['properties']['enable_quick_view'] == 'Y'): ?>
					<?php $__parent_tpl_vars = $this->_tpl_vars; ?><script type="text/javascript" class="cm-ajax-force">
//<![CDATA[
$(function()<?php echo $this->_tpl_vars['ldelim']; ?>

	if (!$('#product_quick_view_<?php echo $this->_tpl_vars['product']['product_id']; ?>
').length) <?php echo $this->_tpl_vars['ldelim']; ?>

		$('<div class="hidden" id="product_quick_view_<?php echo $this->_tpl_vars['product']['product_id']; ?>
"></div>').appendTo('body');
		$('#product_quick_view_<?php echo $this->_tpl_vars['product']['product_id']; ?>
').attr('title', '<?php echo smarty_modifier_escape(smarty_modifier_truncate(smarty_modifier_unescape($this->_tpl_vars['product']['product']), 86, "...", true), 'javascript'); ?>
');
	<?php echo $this->_tpl_vars['rdelim']; ?>

<?php echo $this->_tpl_vars['rdelim']; ?>
);
//]]>
</script>
<div class="quick-view">
	<span class="button button-wrap-left">
		<?php $this->assign('current_url', urlencode($this->_tpl_vars['config']['current_url']), false); ?>
		<span class="button button-wrap-right"><a id="opener_product_picker_<?php echo $this->_tpl_vars['product']['product_id']; ?>
" class="cm-dialog-opener cm-dialog-auto-size" rev="product_quick_view_<?php echo $this->_tpl_vars['product']['product_id']; ?>
" href="<?php echo fn_url("products.quick_view?product_id=".($this->_tpl_vars['product']['product_id'])."&prev_url=".($this->_tpl_vars['current_url'])); ?>
"><?php echo fn_get_lang_var('quick_view', $this->getLanguage()); ?>
</a></span>
	</span>
</div><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>
					<?php endif; ?>
				</div>
				<div class="center compact"<?php if ($this->_tpl_vars['block']['properties']['scroller_direction'] == 'up' || $this->_tpl_vars['block']['properties']['scroller_direction'] == 'down'): ?> style="height: <?php echo $this->_tpl_vars['text_h']; ?>
px;"<?php endif; ?>>
					<?php if ($this->_tpl_vars['block']['properties']['hide_add_to_cart_button'] == 'Y'): ?>
						<?php $this->assign('_show_add_to_cart', false, false); ?>
					<?php else: ?>
						<?php $this->assign('_show_add_to_cart', true, false); ?>
					<?php endif; ?>
					<?php if ($this->_tpl_vars['block']['properties']['show_price'] == 'Y'): ?>
						<?php $this->assign('_hide_price', false, false); ?>
					<?php else: ?>
						<?php $this->assign('_hide_price', true, false); ?>
					<?php endif; ?>
					<?php echo ''; ?><?php $_smarty_tpl_vars = $this->_tpl_vars;$this->_smarty_include(array('smarty_include_tpl_file' => "blocks/list_templates/simple_list.tpl", 'smarty_include_vars' => array('product' => $this->_tpl_vars['product'],'show_trunc_name' => true,'show_price' => true,'show_add_to_cart' => $this->_tpl_vars['_show_add_to_cart'],'but_role' => 'text','hide_price' => $this->_tpl_vars['_hide_price'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php echo ''; ?>

				</div>
			</div>
			</li>
		<?php endforeach; endif; unset($_from); ?>
	</ul>

<?php echo smarty_function_script(array('src' => "lib/js/jcarousel/jquery.jcarousel.js"), $this);?>

<?php $__parent_tpl_vars = $this->_tpl_vars; ?><?php if ($this->_tpl_vars['block']['properties']['scroller_direction'] == 'up' || $this->_tpl_vars['block']['properties']['scroller_direction'] == 'left'): ?>
	<?php $this->assign('scroller_direction', 'next', false); ?>
	<?php $this->assign('scroller_event', 'onAfterAnimation', false); ?>
<?php else: ?>
	<?php $this->assign('scroller_direction', 'prev', false); ?>
	<?php $this->assign('scroller_event', 'onBeforeAnimation', false); ?>
<?php endif; ?>
<?php if ($this->_tpl_vars['block']['properties']['scroller_direction'] == 'left' || $this->_tpl_vars['block']['properties']['scroller_direction'] == 'right'): ?>
	<?php $this->assign('scroller_vert', 'false', false); ?>
	<?php echo smarty_function_math(array('equation' => "item_quantity * item_width",'assign' => 'clip_width','item_width' => $this->_tpl_vars['item_width'],'item_quantity' => smarty_modifier_default(@$this->_tpl_vars['block']['properties']['item_quantity'], 1)), $this);?>

	<?php $this->assign('clip_height', $this->_tpl_vars['item_height'], false); ?>
<?php else: ?>
	<?php $this->assign('scroller_vert', 'true', false); ?>
	<?php $this->assign('clip_width', $this->_tpl_vars['item_width'], false); ?>
	<?php echo smarty_function_math(array('equation' => "item_quantity * item_height",'assign' => 'clip_height','item_height' => $this->_tpl_vars['item_height'],'item_quantity' => smarty_modifier_default(@$this->_tpl_vars['block']['properties']['item_quantity'], 1)), $this);?>

<?php endif; ?>

<script type="text/javascript">
//<![CDATA[
$(function() <?php echo $this->_tpl_vars['ldelim']; ?>

	$('#scroll_list_<?php echo $this->_tpl_vars['block']['block_id']; ?>
').show();
	$('#scroll_list_<?php echo $this->_tpl_vars['block']['block_id']; ?>
').jcarousel(<?php echo $this->_tpl_vars['ldelim']; ?>

		vertical: <?php echo $this->_tpl_vars['scroller_vert']; ?>
,
		size: <?php if (count($this->_tpl_vars['items']) > $this->_tpl_vars['block']['properties']['item_quantity']): ?><?php echo smarty_modifier_default(count($this->_tpl_vars['items']), 'null'); ?>
<?php else: ?><?php echo smarty_modifier_default(@$this->_tpl_vars['block']['properties']['item_quantity'], 1); ?>
<?php endif; ?>,
		scroll: <?php if ($this->_tpl_vars['block']['properties']['scroller_direction'] == 'right' || $this->_tpl_vars['block']['properties']['scroller_direction'] == 'down'): ?>-<?php endif; ?><?php echo smarty_modifier_default(@$this->_tpl_vars['block']['properties']['item_quantity'], 1); ?>
,
		animation: '<?php echo $this->_tpl_vars['block']['properties']['speed']; ?>
',
		easing: '<?php echo $this->_tpl_vars['block']['properties']['easing']; ?>
',
		<?php if ($this->_tpl_vars['block']['properties']['not_scroll_automatically'] == 'Y'): ?>
		auto: 0,
		<?php else: ?>
		auto: '<?php echo smarty_modifier_default(@$this->_tpl_vars['block']['properties']['pause_delay'], 0); ?>
',
		<?php endif; ?>
		autoDirection: '<?php echo $this->_tpl_vars['scroller_direction']; ?>
',
		wrap: 'circular',
		initCallback: $.ceScrollerMethods.init_callback,
		itemVisibleOutCallback: <?php echo $this->_tpl_vars['ldelim']; ?>
<?php echo $this->_tpl_vars['scroller_event']; ?>
: $.ceScrollerMethods.in_out_callback<?php echo $this->_tpl_vars['rdelim']; ?>
,
		item_width: <?php echo $this->_tpl_vars['item_width']; ?>
,
		item_height: <?php echo $this->_tpl_vars['item_height']; ?>
,
		clip_width: <?php echo $this->_tpl_vars['clip_width']; ?>
,
		clip_height: <?php echo $this->_tpl_vars['clip_height']; ?>
,
		item_count: <?php echo sizeof($this->_tpl_vars['items']); ?>

	<?php echo $this->_tpl_vars['rdelim']; ?>
);
<?php echo $this->_tpl_vars['rdelim']; ?>
);
//]]>
</script><?php if (isset($__parent_tpl_vars)) { $this->_tpl_vars = $__parent_tpl_vars; unset($__parent_tpl_vars);} ?>