{if $product.recurring_plans}
	<div class="buttons-container">
		{if $quick_view}
			{include file="buttons/button.tpl" but_href="products.view?product_id=`$product.product_id`" but_role="submit" but_text=$lang.rb_edit_subscription}
		{else}
			{include file="buttons/button.tpl" but_onclick="$('#recurring_plans').click(); $.scrollToElm($('#content_recurring_plans'));" but_role="text" but_text=$lang.rb_edit_subscription}
		{/if}
	</div>
	<div class="clear"></div>
{/if}