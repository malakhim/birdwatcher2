{if "COMPANY_ID"|defined && $smarty.const.PRODUCT_TYPE == 'ULTIMATE' || $smarty.const.PRODUCT_TYPE != 'ULTIMATE'}

{assign var="discussion" value=$order_info.order_id|fn_get_discussion:"O"}

{include file="common_templates/subheader.tpl" title=$lang.discussion}

<div class="form-field">
	<label>{$lang.discussion_title_order}</label>
	<input type="hidden" name="discussion[object_id]" value="{$order_info.order_id}" />
	<input type="hidden" name="discussion[object_type]" value="O" /> 
	<select name="discussion[type]">
		<option {if $discussion.type == "D"}selected="selected"{/if} value="D">{$lang.disabled}</option>
		<option {if $discussion.type == "C"}selected="selected"{/if} value="C">{$lang.enabled}</option>
	</select>
</div>
{/if}