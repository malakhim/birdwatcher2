
{if $cart.use_gift_certificates}
	{foreach from=$cart.use_gift_certificates item="ugc" key="ugc_key"}
		<li>
		<span class="strong">{$lang.gift_certificate}</span>
		<span><a href="{"gift_certificates.verify?verify_code=`$ugc_key`"|fn_url}">{$ugc_key}</a>
		({include file="common_templates/price.tpl" value=$ugc.cost}){include file="addons/gift_certificates/views/gift_certificates/components/delete_button.tpl" code=$ugc_key}</span>
		</li>
	{/foreach}
{/if}