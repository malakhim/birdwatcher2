{if !$smarty.request.extra}
<script type="text/javascript">
//<![CDATA[
lang.text_items_added = '{$lang.text_items_added|escape:javascript}';
var display_type = '{$smarty.request.display|escape:javascript}';
{literal}
	function fn_form_post_categories_form(frm, elm) 
	{
		var categories = {};

		if ($('input.cm-item:checked', $(frm)).length > 0) {
			$('input.cm-item:checked', $(frm)).each( function() {
				var id = $(this).val();
				categories[id] = $('#category_' + id).text();
			});
			$.add_js_item(frm.attr('rev'), categories, 'c', null);

			if (display_type != 'radio') {
				$.showNotifications({'data': {'type': 'N', 'title': lang.notice, 'message': lang.text_items_added, 'save_state': false, 'message_state': 'I'}});
			}
		}

		return false;
	}
{/literal}
//]]>
</script>
{/if}

<form action="{"`$index_script`?`$smarty.request.extra`"|fn_url}" rev="{$smarty.request.data_id}" method="post" name="categories_form">

{assign var="level" value="0"}
<div class="category-rows">{include file="views/categories/components/categories_tree_simple.tpl" header="1" form_name="discounted_categories_form" checkbox_name=$smarty.request.checkbox_name|default:"categories_ids" parent_id=$category_id display=$smarty.request.display}</div>

<div class="buttons-container picker">
	<div>{if $smarty.request.display == "radio"}
			{assign var="but_close_text" value=$lang.choose}
		{else}
			{assign var="but_close_text" value=$lang.add_categories_and_close}
			{assign var="but_text" value=$lang.add_categories}
		{/if}
		{include file="buttons/add_close.tpl" is_js=$smarty.request.extra|fn_is_empty}</div>
</div>

</form>