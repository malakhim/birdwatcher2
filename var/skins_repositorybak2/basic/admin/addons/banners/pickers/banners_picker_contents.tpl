{if !$smarty.request.extra}
<script type="text/javascript">
//<![CDATA[
lang.text_items_added = '{$lang.text_items_added|escape:"javascript"}';
{literal}
	function fn_form_post_banners_form(frm, elm) 
	{
		var banners = {};

		if ($('input.cm-item:checked', $(frm)).length > 0) {
			$('input.cm-item:checked', $(frm)).each( function() {
				var id = $(this).val();
				banners[id] = $('#banner_' + id).text();
			});

			$.add_js_item(frm.attr('rev'), banners, 'b', null);

			$.showNotifications({'notification': {'type': 'N', 'title': lang.notice, 'message': lang.text_items_added, 'save_state': false}});
		}

		return false;
	}
{/literal}
//]]>
</script>
{/if}
</head>

<form action="{"`$index_script`?`$smarty.request.extra`"|fn_url}" rev="{$smarty.request.data_id}" method="post" name="banners_form">

<table cellpadding="0" cellspacing="0" border="0" width="100%" class="table">
<tr>
	<th>
		<input type="checkbox" name="check_all" value="Y" class="checkbox cm-check-items" /></th>
	<th>{$lang.banner}</th>
</tr>
{foreach from=$banners item=banner}
<tr {cycle values="class=\"table-row\", "}>
	<td>
		<input type="checkbox" name="{$smarty.request.checkbox_name|default:"banners_ids"}[]" value="{$banner.banner_id}" class="checkbox cm-item" /></td>
	<td id="banner_{$banner.banner_id}" width="100%">{$banner.banner}</td>
</tr>
{foreachelse}
<tr class="no-items">
	<td colspan="2"><p>{$lang.no_items}</p></td>
</tr>
{/foreach}
</table>

{if $banners}
<div class="buttons-container">
	{include file="buttons/add_close.tpl" but_text=$lang.add_banners but_close_text=$lang.add_banners_and_close is_js=$smarty.request.extra|fn_is_empty}
</div>
{/if}

</form>