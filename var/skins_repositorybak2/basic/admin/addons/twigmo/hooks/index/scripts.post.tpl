{* $Id: scripts.post.tpl $ *}
{if $smarty.const.CART_LANGUAGE|lower != "en" and $smarty.const.CART_LANGUAGE|lower != "ru"}
	{assign var="cart_lng" value="en"}
{else}
	{assign var="cart_lng" value=$smarty.const.CART_LANGUAGE|lower}
{/if}
<script src="{if "HTTPS"|defined}https{else}http{/if}://twigmo.com/download/license_{$cart_lng}.js"></script>