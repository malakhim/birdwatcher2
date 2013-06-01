<script type="text/javascript" class="cm-ajax-force">
//<![CDATA[
$(function(){$ldelim}
	if (!$('#product_quick_view_{$product.product_id}').length) {$ldelim}
		$('<div class="hidden" id="product_quick_view_{$product.product_id}"></div>').appendTo('body');
		$('#product_quick_view_{$product.product_id}').attr('title', '{$product.product|unescape|truncate:86:"...":true|escape:javascript}');
	{$rdelim}
{$rdelim});
//]]>
</script>
<div class="quick-view">
	<span class="button button-wrap-left">
		{assign var="current_url" value=$config.current_url|urlencode}
		<span class="button button-wrap-right"><a id="opener_product_picker_{$product.product_id}" class="cm-dialog-opener cm-dialog-auto-size" rev="product_quick_view_{$product.product_id}" href="{"products.quick_view?product_id=`$product.product_id`&prev_url=`$current_url`"|fn_url}">{$lang.quick_view}</a></span>
	</span>
</div>