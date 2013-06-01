{if $smarty.const.PRODUCT_TYPE == 'ULTIMATE' && 'COMPANY_ID'|defined && $s_companies.$s_company.storefront}
	{assign var='se_async_url' value="http://`$s_companies.$s_company.storefront`/index.php?dispatch=searchanise.async&amp;no_session=Y"}
{elseif $smarty.const.PRODUCT_TYPE != 'ULTIMATE'}
	{assign var='se_async_url' value='searchanise.async?no_session=Y'|fn_url:'C':'current':'&amp;'}
{/if}

{if $settings.store_mode == 'closed'}
	{assign var='se_async_url' value="`$se_async_url`&amp;store_access_key=`$settings.General.store_access_key`"}
{/if}

{if 'HTTPS'|defined}
	{assign var='se_async_url' value=$se_async_url|replace:'http://':'https://'}
{else}
	{assign var='se_async_url' value=$se_async_url}
{/if}

<object data="{$se_async_url}" width="0" height="0"></object>