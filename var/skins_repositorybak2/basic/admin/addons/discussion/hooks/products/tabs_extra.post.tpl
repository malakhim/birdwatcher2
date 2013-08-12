{if "COMPANY_ID"|defined && $smarty.const.PRODUCT_TYPE == 'ULTIMATE' || $smarty.const.PRODUCT_TYPE != 'ULTIMATE'}
{include file="addons/discussion/views/discussion_manager/components/discussion.tpl"}
{/if}