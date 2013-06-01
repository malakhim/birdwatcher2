{if "COMPANY_ID"|defined && $smarty.const.PRODUCT_TYPE == 'ULTIMATE' || $smarty.const.PRODUCT_TYPE != 'ULTIMATE'}
	{if $addons.tags.tags_for_pages == "Y"}
		{include file="addons/tags/views/tags/components/object_tags.tpl" object=$page_data input_name="page_data"}
	{/if}
{/if}