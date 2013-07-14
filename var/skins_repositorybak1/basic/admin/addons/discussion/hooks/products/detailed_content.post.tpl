{if "COMPANY_ID"|defined && $smarty.const.PRODUCT_TYPE == 'ULTIMATE' || $smarty.const.PRODUCT_TYPE != 'ULTIMATE'}
<fieldset>
	{include file="common_templates/subheader.tpl" title=$lang.comments_and_reviews}
	{include file="addons/discussion/views/discussion_manager/components/allow_discussion.tpl" prefix="product_data" object_id=$product_data.product_id object_type="P" title=$lang.discussion_title_product non_editable=false}
</fieldset>
{/if}