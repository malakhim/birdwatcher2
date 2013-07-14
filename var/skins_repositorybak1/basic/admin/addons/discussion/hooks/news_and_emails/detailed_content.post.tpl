{if "COMPANY_ID"|defined && $smarty.const.PRODUCT_TYPE == 'ULTIMATE' || $smarty.const.PRODUCT_TYPE != 'ULTIMATE'}
{include file="addons/discussion/views/discussion_manager/components/allow_discussion.tpl" prefix="news_data" object_id=$news_data.news_id object_type="N" title=$lang.discussion_title_news non_editable=true}
{/if}