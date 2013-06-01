{if !$smarty.request.extra}
<script type="text/javascript">
//<![CDATA[
lang.text_items_added = '{$lang.text_items_added|escape:"javascript"}';
{literal}
	function fn_form_post_recurring_plans_form(frm, elm) 
	{
		var recurring_plans = {};

		if ($('input.cm-item:checked', $(frm)).length > 0) {
			$('input.cm-item:checked', $(frm)).each( function() {
				var id = $(this).val();
				recurring_plans[id] = $('#recurring_plan_' + id).text();
			});

			$.add_js_item(frm.attr('rev'), recurring_plans, 'r', null);

			$.showNotifications({'notification': {'type': 'N', 'title': lang.notice, 'message': lang.text_items_added, 'save_state': false}});
		}

		return false;
	}
{/literal}
//]]>
</script>
{/if}

<form action="{"`$index_script`?`$smarty.request.extra`"|fn_url}" method="post" rev="{$smarty.request.data_id}" name="recurring_plans_form">

<table cellpadding="0" cellspacing="0" border="0" width="100%" class="table">
<tr>
	<th>
		<input type="checkbox" name="check_all" value="Y" class="checkbox cm-check-items" /></th>
	<th>{$lang.rb_recurring_plan}</th>
</tr>
{foreach from=$recurring_plans item=recurring_plan}
<tr {cycle values="class=\"table-row\", "}>
	<td>
		<input type="checkbox" name="{$smarty.request.checkbox_name|default:"recurring_plans_ids"}[]" value="{$recurring_plan.plan_id}" class="checkbox cm-item" /></td>
	<td id="recurring_plan_{$recurring_plan.plan_id}" width="100%">{$recurring_plan.name}</td>
</tr>
{foreachelse}
<tr class="no-items">
	<td colspan="2"><p>{$lang.no_items}</p></td>
</tr>
{/foreach}
</table>

{if $recurring_plans}
<div class="buttons-container">
	{include file="buttons/add_close.tpl" but_text=$lang.rb_add_recurring_plans but_close_text=$lang.rb_add_recurring_plans_and_close is_js=$smarty.request.extra|fn_is_empty}
</div>
{/if}

</form>