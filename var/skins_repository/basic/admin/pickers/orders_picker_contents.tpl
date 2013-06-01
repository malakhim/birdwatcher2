<script type="text/javascript">
//<![CDATA[
lang.text_items_added = '{$lang.text_items_added|escape:javascript}';
{if $smarty.request.max_displayed_qty}
var max_displayed_qty = {$smarty.request.max_displayed_qty};
var details_url = "{"orders.manage?order_id="|fn_url}";
{else}
var max_displayed_qty = 0;
{/if}
{if !$smarty.request.extra}
{literal}
	function fn_form_post_add_orders(frm, elm)
	{
		var orders = {};

		if ($('input.cm-item:checked', $(frm)).length > 0) {
			$('input.cm-item:checked', $(frm)).each( function() {
				var id = $(this).val();
				var item = $(this).parent().parent();
				orders[id] = {'status': item.find('td.cm-order-status').text(), 'customer': item.find('td.cm-order-customer').text(), 'timestamp': item.find('td.cm-order-timestamp').text(), 'total': item.find('td.cm-order-total').text()};
			});
			
			$.add_js_item(frm.attr('rev'), orders, 'o', null);
			fn_check_items_qty(frm.attr('rev'))
			$.showNotifications({'data': {'type': 'N', 'title': lang.notice, 'message': lang.text_items_added, 'save_state': false, 'message_state': 'I'}});
		}

		return false;
	}

	function fn_check_items_qty(root_id)
	{
		if (max_displayed_qty <= 0) {
			return;
		}

		var jroot = $('#' + root_id);

		var items = $('.cm-js-item', jroot);
		for (var k = 0; k < items.length; k++) {
			var elm = $(items[k]);
			if (elm.hasClass('cm-clone')) {
				continue;
			}
			if (k > max_displayed_qty) {
				elm.remove();
			}
		}

		if (items.length <= max_displayed_qty) {
			$('#' + root_id + '_details').hide();
		} else {
			var item_ids = $('#o' + root_id + '_ids').val();
			var link = $('#' + root_id + '_details').children('a:first');
			if (link ) {
				link.attr('url', details_url + item_ids);
				$('#' + root_id + '_details').show();
			}
		}

		if (items.length > 1) {
			$('#' + root_id + '_clear').show();
		} else {
			$('#' + root_id + '_clear').hide();
		}
	}
{/literal}
{/if}
//]]>
</script>

{include file="views/orders/components/orders_search_form.tpl" dispatch="orders.picker" extra="<input type=\"hidden\" name=\"result_ids\" value=\"pagination_`$smarty.request.data_id`\"><input type=\"hidden\" name=\"data_id\" value=\"`$smarty.request.data_id`\"><input type=\"hidden\" name=\"extra\" value=\"`$smarty.request.extra`\" />" form_meta="cm-ajax cm-ajax-force"}

<form action="{"`$index_script`?`$smarty.request.extra`"|fn_url}" rev="{$smarty.request.data_id}" method="post" name="add_orders">

{include file="common_templates/pagination.tpl" save_current_page=true div_id="pagination_`$smarty.request.data_id`"}

<table border="0" cellpadding="0" cellspacing="0" width="100%" class="table">
<tr>
	<th class="center" width="1%">
		<input type="checkbox" name="check_all" value="Y" title="{$lang.check_uncheck_all}" class="checkbox cm-check-items" /></th>
	<th width="10%">{$lang.id}</th>
	<th width="15%">{$lang.status}</th>
	<th width="25%">{$lang.customer}</th>
	<th width="25%">{$lang.date}</th>
	<th width="24%" class="right">{$lang.total}</th>
</tr>
{foreach from=$orders item="o"}
<tr {cycle values="class=\"table-row\", "}>
	<td class="center" width="1%">
		<input type="checkbox" name="add_parameter[]" value="{$o.order_id}" class="checkbox cm-item" /></td>
	<td>
		<span>#{$o.order_id}</span></td>
	<td class="cm-order-status"><input type="hidden" name="origin_statuses[{$o.order_id}]" value="{$o.status}" />{include file="common_templates/status.tpl" status=$o.status display="view" name="order_statuses[`$o.order_id`]"}</td>
	<td class="cm-order-customer">{$o.firstname} {$o.lastname}</td>
	<td class="cm-order-timestamp">
		{$o.timestamp|date_format:"`$settings.Appearance.date_format`, `$settings.Appearance.time_format`"}</td>
	<td class="right cm-order-total">
		{include file="common_templates/price.tpl" value=$o.total}</td>
</tr>
{foreachelse}
<tr class="no-items">
	<td colspan="6"><p>{$lang.no_data}</p></td>
</tr>
{/foreach}
</table>

{include file="common_templates/pagination.tpl" div_id="pagination_`$smarty.request.data_id`"}

<div class="buttons-container">
	{include file="buttons/add_close.tpl" but_text=$lang.add_orders but_close_text=$lang.add_orders_and_close is_js=$smarty.request.extra|fn_is_empty}
</div>

</form>