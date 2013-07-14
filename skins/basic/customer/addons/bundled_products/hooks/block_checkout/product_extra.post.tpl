{if $cart.products.$key.extra.bundled_products}
	{foreach from=$cart_products item="_product" key="key_conf"}
		{if $cart.products.$key_conf.extra.parent.bundled_products == $key}
			{capture name="is_conf_prod"}1{/capture}
		{/if}
	{/foreach}

	{if $smarty.capture.is_conf_prod}
		<div class="info-block buy-together">
			<span class="light-block-arrow-alt"></span>
			<h2>{$lang.bundled_products}</h2>
			<ul>
				{foreach from=$cart_products item="_product" key="key_conf"}
					{if $cart.products.$key_conf.extra.parent.bundled_products == $key}
						<li>{$_product.product|unescape}</li>
					{/if}
				{/foreach}
			</ul>
		</div>
	{/if}
{/if}