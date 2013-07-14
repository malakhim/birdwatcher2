{if "COMPANY_ID"|defined && $smarty.const.PRODUCT_TYPE == 'ULTIMATE' || $smarty.const.PRODUCT_TYPE != 'ULTIMATE'}
{include file="common_templates/subheader.tpl" title=$lang.comments_and_reviews}

{include file="addons/discussion/views/discussion_manager/components/allow_discussion.tpl" prefix="category_data" object_id=$category_data.category_id object_type="C" title=$lang.discussion_title_category}
{/if}