{if $cart.products.$key.extra.buy_together}
	{foreach from=$cart_products item="_product" key="key_conf"}
		{if $cart.products.$key_conf.extra.parent.buy_together == $key}
			{capture name="is_conf_prod"}1{/capture}
		{/if}
	{/foreach}

	{if $smarty.capture.is_conf_prod}
		<div class="info-block buy-together">
			<span class="light-block-arrow-alt"></span>
			<h2>{$lang.buy_together}</h2>
			<ul>
				{foreach from=$cart_products item="_product" key="key_conf"}
					{if $cart.products.$key_conf.extra.parent.buy_together == $key}
						<li>{$_product.product|unescape}</li>
					{/if}
				{/foreach}
			</ul>
		</div>
	{/if}
{/if}