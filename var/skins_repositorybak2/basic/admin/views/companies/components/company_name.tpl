{if $smarty.const.PRODUCT_TYPE == "MULTIVENDOR" || $smarty.const.PRODUCT_TYPE == "ULTIMATE"}
{assign var="lang_vendor_supplier" value=$lang.vendor}
{else}
{assign var="lang_vendor_supplier" value=$lang.supplier}
{/if}

{if $company_name}
 ({$lang_vendor_supplier}: {$company_name})
{elseif $company_id}
 ({$lang_vendor_supplier}: {$company_id|fn_get_company_name})
{/if}
