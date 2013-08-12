{include file="views/products/components/search_product_subscribers.tpl" dispatch="products.update"}

<form action="{""|fn_url}" method="post" name="subscribers_form">

{include file="common_templates/pagination.tpl" save_current_page=true div_id="product_subscribers"}

<table cellpadding="0" cellspacing="0" border="0" width="100%" class="table">
<tr>
	<th class="center" width="1%">
		<input type="checkbox" name="check_all" value="Y" title="{$lang.check_uncheck_all}" class="checkbox cm-check-items" /></th>
	<th width="50%">{$lang.email}</th>
	<th>&nbsp;</th>
</tr>
{foreach from=$product_subscribers.subscribers item="s"}
<tbody class="hover">
<tr>
	<td class="center">
   		<input type="checkbox" name="subscriber_ids[]" value="{$s.subscriber_id}" class="checkbox cm-item" /></td>
	<td><input type="hidden" name="subscribers[{$s.subscriber_id}][email]" value="{$s.email}" />
		<a href="mailto:{$s.email|escape:url}">{$s.email}</a></td>
		<input type="hidden" name="product_id" value="{$product_id}" />
	<td class="nowrap">
		{capture name="tools_items"}
		<li><a class="cm-confirm" href="{"products.update&product_id=`$product_id`&selected_section=subscribers&deleted_subscription_id=`$s.subscriber_id`"|fn_url}">{$lang.delete}</a></li>
		{/capture}
		{include file="common_templates/table_tools_list.tpl" prefix=$s.subscriber_id tools_list=$smarty.capture.tools_items}
	</td>
</tr>
</tbody>
{foreachelse}
<tr class="no-items">
	<td colspan="5"><p>{$lang.no_data}</p></td>
</tr>
{/foreach}
</table>

{include file="common_templates/pagination.tpl" div_id="product_subscribers"}

{include file="pickers/users_picker.tpl" data_id="subscr_user" picker_for="subscribers" extra_var="dispatch=products.update&product_id=`$product_id`&selected_section=subscribers" but_text=$lang.add_subscribers_from_users view_mode="button"}

</form>

<div class="buttons-container buttons-bg">
	{if $product_subscribers.subscribers}
	<div class="float-left">
		{capture name="tools_list"}
		<ul>
			<li><a name="dispatch[products.update]" class="cm-process-items cm-confirm" rev="subscribers_form">{$lang.delete_selected}</a></li>
		</ul>
		{/capture}
		{include file="common_templates/tools.tpl" prefix="subscribers" hide_actions=true tools_list=$smarty.capture.tools_list display="inline" link_text=$lang.choose_action}
	</div>
	{/if}
	<div class="float-right">
		{capture name="new_email_picker"}
		<form action="{"products.update&product_id=`$product_id`&selected_section=subscribers"|fn_url}" method="post" name="subscribers_form_0" class="cm-form-highlight">
		
		<div class="cm-tabs-content" id="content_tab_user_details">
			<fieldset>
				<div class="form-field">
					<label for="users_email" class="cm-required cm-email">{$lang.email}:</label>
					<input type="text" name="add_users_email" id="users_email" value="" class="input-text-large main-input" />
					<input type="hidden" name="add_users[0]" id="users_id" value="0" class="" />
				</div>
			</fieldset>
		</div>

		<div class="buttons-container">
			{include file="buttons/save_cancel.tpl" but_name="dispatch[products.update]" create=true cancel_action="close"}
		</div>

		</form>
		{/capture}
		{include file="common_templates/popupbox.tpl" id="add_new_subscribers" text=$lang.new_subscribers content=$smarty.capture.new_email_picker link_text=$lang.add_subscriber act="general"}
	</div>
</div>