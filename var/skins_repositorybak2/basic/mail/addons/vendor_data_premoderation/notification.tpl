{if $status == "Y"}
	{assign var="text_status" value=$lang.approved}
{else}
	{assign var="text_status" value=$lang.disapproved}
{/if}

{include file="letter_header.tpl"}

{$lang.hello},<br /><br />

{if $products|count > 1}
	{if $status == "Y"}
		{$lang.products_approval_status_approved}<br />
	{else}
		{$lang.products_approval_status_disapproved}<br />
	{/if}
	{foreach name="products_list" from=$products item="product"}
		{$smarty.foreach.products_list.iteration}) <a href="{"products.update?product_id=`$product.product_id`"|fn_url:"V":"http"}">{$product.product}</a><br />
	{/foreach}
	
	{if $status == "Y"}
		<br />{$lang.text_shoppers_can_order_products}
	{/if}
	{if $reason}
		<p>{$reason}</p>
	{/if}
{else}
	{assign var="product_name" value=$products.0.product}
	{assign var="product_url" value="products.update?product_id=`$products.0.product_id`"|fn_url:"V":"http"}
	{if $status == "Y"}
		{$lang.product_approval_status_approved|replace:"[product]":"<a href='`$product_url`'>`$product_name`</a>"}
	{else}
		{$lang.product_approval_status_disapproved|replace:"[product]":"<a href='`$product_url`'>`$product_name`</a>"}
	{/if}
	
	{if $reason}
		<p>{$reason}</p>
	{/if}
{/if}

{include file="letter_footer.tpl"}