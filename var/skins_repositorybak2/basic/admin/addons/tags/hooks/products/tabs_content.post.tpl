{if "COMPANY_ID"|defined && $smarty.const.PRODUCT_TYPE == 'ULTIMATE' || $smarty.const.PRODUCT_TYPE != 'ULTIMATE'}
	{if $addons.tags.tags_for_products == "Y"}
		{include file="addons/tags/views/tags/components/object_tags.tpl" object=$product_data input_name="product_data"}
	{/if}
{/if}