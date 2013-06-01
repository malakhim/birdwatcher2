{if "COMPANY_ID"|defined && $smarty.const.PRODUCT_TYPE == 'ULTIMATE' || $smarty.const.PRODUCT_TYPE != 'ULTIMATE'}
<fieldset>
	{include file="common_templates/subheader.tpl" title=$lang.comments_and_reviews}
	{include file="addons/discussion/views/discussion_manager/components/allow_discussion.tpl" prefix="page_data" object_id=$page_data.page_id object_type="A" title=$lang.discussion_title_page  non_editable=true}
</fieldset>
{/if}