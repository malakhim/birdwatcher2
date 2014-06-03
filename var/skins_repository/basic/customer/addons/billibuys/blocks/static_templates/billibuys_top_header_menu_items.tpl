<span class="top_menu_item" href="{'profiles.update'|fn_url}"><img alt="icon here?" />{$lang.account}</span>
{if $smarty.session.cart.products}
	<span class="top_menu_item" href="{'checkout.cart'|fn_url}"><img alt="icon here?" />{$lang.view_cart}</span>
{/if}