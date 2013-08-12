{if $languages|sizeof > 1}
<div class="select-lang">

{include file="common_templates/select_object.tpl" style="graphic" link_tpl="`$config.current_url`&selected_section=recurring_billing_orders"|fn_link_attach:"descr_sl=" items=$languages selected_id=$smarty.const.DESCR_SL key_name="name" suffix="content" display_icons=true}

</div>
{/if}

{if $item.update_for_all && $settings.Stores.default_state_update_for_all == 'not_active'}
	{assign var="disable_input" value=true}
{/if}

{assign var="statuses" value=$smarty.const.STATUSES_ORDER|fn_get_statuses}

{foreach from=$statuses key="key" item="status"}

<h2 class="subheader">{$lang.status}: {$status.description}</h2>

<div class="form-field">
	{assign var="rb_order_status_email_subject" value="rb_order_status_email_subject_`$status.status`"}
	<label for="rb_order_status_email_subject_{$status.status}" class="left description">{$lang.email_subject}{include file="common_templates/tooltip.tpl" tooltip=$rb_order_status_email_subject}:</label>
	<input id="rb_order_status_email_subject_{$status.status}" class="input-text" {if $disable_input}disabled="disabled"{/if} type="text" value="{$rb_order_status_email_subject|fn_get_lang_var:$smarty.const.DESCR_SL:true}" name="additional_orders_settings[{$rb_order_status_email_subject}]">
	<div class="right update-for-all">
		{include file="buttons/update_for_all.tpl" display=$item.update_for_all object_id=$item.object_id name="update_all_vendors[`$item.object_id`]" hide_element="rb_order_status_email_subject_`$status.status`"}
	</div>
</div>

<div class="form-field">
	{assign var="rb_order_status_email_header" value="rb_order_status_email_header_`$status.status`"}
	<label for="rb_order_status_email_header_{$status.status}" class="left description">{$lang.email_header}{include file="common_templates/tooltip.tpl" tooltip=$rb_order_status_email_header}:</label>
	<textarea id="rb_order_status_email_header_{$status.status}" class="input-textarea-long" {if $disable_input}disabled="disabled"{/if} rows="8" cols="55" name="additional_orders_settings[{$rb_order_status_email_header}]">{$rb_order_status_email_header|fn_get_lang_var:$smarty.const.DESCR_SL:true}</textarea>
	<div class="right update-for-all">
		{include file="buttons/update_for_all.tpl" display=$item.update_for_all object_id=$item.object_id name="update_all_vendors[`$item.object_id`]" hide_element="rb_order_status_email_header_`$status.status`"}
	</div>
</div>

{/foreach}
