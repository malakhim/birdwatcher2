{if !$smarty.request.extra}
<script type="text/javascript">
//<![CDATA[
lang.text_items_added = '{$lang.text_items_added|escape:javascript}';
{literal}
	function fn_form_post_add_users_form(frm, elm) 
	{
		var users = {};

		if ($('input.cm-item:checked', $(frm)).length > 0) {

			$('input.cm-item:checked', $(frm)).each( function() {
				var id = $(this).val();
				var item = $(this).parent().siblings();
				users[id] = {'email': item.find('.user-email').text(), 'user_name': item.find('.user-name').text()};
			});

			$.add_js_item(frm.attr('rev'), users, 'u', null);

			$.showNotifications({'data': {'type': 'N', 'title': lang.notice, 'message': lang.text_items_added, 'save_state': false, 'message_state': 'I'}});
		}

		return false;
	}
{/literal}
//]]>
</script>
{/if}

{include file="views/profiles/components/users_search_form.tpl" dispatch="profiles.picker" extra="<input type=\"hidden\" name=\"result_ids\" value=\"pagination_`$smarty.request.data_id`\">" put_request_vars=true form_meta="cm-ajax"}

<form action="{"`$index_script`?`$smarty.request.extra`"|fn_url}" method="post" rev="{$smarty.request.data_id}" name="add_users_form">

{include file="common_templates/pagination.tpl" save_current_page=true div_id="pagination_`$smarty.request.data_id`"}

<table cellpadding="0" cellspacing="0" border="0" width="100%" class="table">
<tr>
	<th width="1%" class="center">
		{if $smarty.request.display == "checkbox"}
		<input type="checkbox" name="check_all" value="Y" title="{$lang.check_uncheck_all}" class="checkbox cm-check-items" /></th>
		{/if}
	<th>{$lang.id}</th>
	{if $settings.General.use_email_as_login != "Y"}
	<th>{$lang.username}</th>
	{/if}
	<th>{$lang.email}</th>
	<th>{$lang.name}</th>
	<th>{$lang.registered}</th>
	<th>{$lang.type}</th>
	<th>{$lang.active}</th>
</tr>
{foreach from=$users item=user}
<tr {cycle values=",class=\"table-row\""}>
	<td class="center">
		{if $smarty.request.display == "checkbox"}
		<input type="checkbox" name="add_users[]" value="{$user.user_id}" class="checkbox cm-item" />
		{elseif $smarty.request.display == "radio"}
		<input type="radio" name="selected_user_id" value="{$user.user_id}" class="radio" />
		{/if}
	</td>
	<td>{$user.user_id}</td>
	{if $settings.General.use_email_as_login != "Y"}
	<td><span>{$user.user_login}</span></td>
	{/if}
	<td><strong class="user-email">{$user.email}</span></td>
	<td><span class="user-name">{if $user.firstname || $user.lastname}{$user.firstname} {$user.lastname}{else}-{/if}</span></td>
	<td>{$user.timestamp|date_format:"`$settings.Appearance.date_format`, `$settings.Appearance.time_format`"}</td>
	<td>{if $user.user_type == "A"}{$lang.administrator}{elseif $user.user_type == "V"}{$lang.vendor_administrator}{elseif $user.user_type == "C"}{$lang.customer}{elseif $user.user_type == "S"}{$lang.supplier}{elseif $user.user_type == "P"}{$lang.affiliate}{/if}</td>
	<td class="center"><img src="{$images_dir}/checkbox_{if $user.active == "N"}un{/if}ticked.gif" width="13" height="13" alt="{$user.active}" /></td>
</tr>
{foreachelse}
<tr class="no-items">
	<td colspan="{if $settings.General.use_email_as_login != "Y"}8{else}7{/if}"><p>{$lang.no_data}</p></td>
</tr>
{/foreach}
</table>

{include file="common_templates/pagination.tpl" div_id="pagination_`$smarty.request.data_id`"}

{hook name="profiles:picker_opts"}
{/hook}

<div class="buttons-container">
	{if $smarty.request.display == "radio"}
		{assign var="but_close_text" value=$lang.choose}
	{else}
		{assign var="but_close_text" value=$lang.add_users_and_close}
		{assign var="but_text" value=$lang.add_users}
	{/if}

	{include file="buttons/add_close.tpl" is_js=$smarty.request.extra|fn_is_empty}
</div>

</form>