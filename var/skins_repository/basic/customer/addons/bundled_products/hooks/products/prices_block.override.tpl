{if $product.chains && $smarty.request.dispatch != "wishlist.view"}
	{foreach from=$product.chains key="key" item="chain"}
		{if !(!$auth.user_id && $settings.General.allow_anonymous_shopping == "P")}
		<strong>
			<p>{$lang.total_list_price}:&nbsp;<span style="text-decoration: line-through">{include file="common_templates/price.tpl" value=$chain.total_price}</span></p>
			<p>{$lang.price_for_all}:&nbsp;{include file="common_templates/price.tpl" value=$chain.chain_price}</p>
		</strong>
		{else}
		<p class="price">{$lang.sign_in_to_view_price}</p>
		{/if}
	{/foreach}
{/if}