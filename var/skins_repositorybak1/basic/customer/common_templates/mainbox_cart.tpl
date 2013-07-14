{* $Id: mainbox_cart.tpl 10291 2010-08-02 07:33:30Z angel $ *}
{if $anchor}
<a name="{$anchor}"></a>
{/if}
<div>
	<div class="mainbox-cart-body" {if $mainbox_id}id="{$mainbox_id}"{/if}>{$content}{if $mainbox_id}<!--{$mainbox_id}-->{/if}</div>
</div>