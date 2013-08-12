
{if !$smarty.request.extra}
<script type="text/javascript">
//<![CDATA[
lang.text_items_added = '{$lang.text_items_added|escape:javascript}';
{literal}
	function fn_form_post_news_form(frm, elm) 
	{
		var news = {};

		if ($('input.cm-item:checked', $(frm)).length > 0) {
			$('input.cm-item:checked', $(frm)).each( function() {
				var id = $(this).val();
				news[id] = $('#news_' + id).text();
			});
			$.add_js_item(frm.attr('rev'), news, 'n', null);

			$.showNotifications({'data': {'type': 'N', 'title': lang.notice, 'message': lang.text_items_added, 'save_state': false, 'message_state': 'I'}});
		}

		return false;
	}
{/literal}
//]]>
</script>
{/if}

<form action="{"`$index_script`?`$smarty.request.extra`"|fn_url}" rev="{$smarty.request.data_id}" method="post" name="news_form">

{include file="common_templates/pagination.tpl" div_id="pagination_`$smarty.request.content_id`"}

<table cellpadding="0" cellspacing="0" border="0" width="100%" class="table">
<tr>
	<th>
		<input type="checkbox" name="check_all" value="Y" class="checkbox cm-check-items" />
	</th>
	<th>{$lang.news}</th>
</tr>

{foreach from=$news item=n}
<tr {cycle values="class=\"table-row\", "}>
	<td>
		<input type="checkbox" name="{$smarty.request.checkbox_name|default:"news_ids"}[]" value="{$n.news_id}" class="checkbox cm-item" />
	</td>
	<td width="100%" id="news_{$n.news_id}">{$n.news}</td>
</tr>
{foreachelse}
<tr class="no-items">
	<td colspan="2"><p>{$lang.no_items}</p></td>
</tr>
{/foreach}
</table>

{include file="common_templates/pagination.tpl" div_id="pagination_`$smarty.request.content_id`"}

{if $news}
<div class="buttons-container">
	{include file="buttons/add_close.tpl" but_text=$lang.add_news but_close_text=$lang.add_news_and_close is_js=$smarty.request.extra|fn_is_empty}
</div>
{/if}
</form>