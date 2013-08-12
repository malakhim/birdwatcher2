<div id="content_configure">

{if $service_template}
{include file="views/shippings/components/services/`$service_template`.tpl"}
{/if}

<div class="buttons-container buttons-bg">
	{include file="buttons/save_cancel.tpl" but_name="dispatch[shippings.update_shipping]"}
</div>

<!--content_configure--></div>