{if $order_info.allow_return}
	{include file="buttons/button.tpl" but_text=$lang.return_registration but_href="rma.create_return?order_id=`$order_info.order_id`" but_role="tool"}
{/if}
{if $order_info.isset_returns}
	{include file="buttons/button.tpl" but_text=$lang.order_returns but_href="rma.returns?order_id=`$order_info.order_id`" but_role="tool"}
{/if}