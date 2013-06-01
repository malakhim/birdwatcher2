{if !$smarty.request.extra}
<script type="text/javascript">
//<![CDATA[
lang.text_items_added = '{$lang.text_items_added|escape:"javascript"}';
lang.options = '{$lang.options|escape:"javascript"}';

{if $smarty.request.display == "options" || $smarty.request.display == "options_amount" || $smarty.request.display == "options_price"}
	lang.no = '{$lang.no|escape:"javascript"}';
	lang.yes = '{$lang.yes|escape:"javascript"}';
	lang.aoc = '{$lang.any_option_combinations|escape:"javascript"}';

{literal}
	var options_routine = {
		disable: function (id, obj) {
			if (obj.checked) {
				$('*:input:not(#' + obj.id + ')', $('#' + id)).attr('disabled', 'disabled');
			} else {
				$('*:input:not(#' + obj.id + ')', $('#' + id)).removeAttr('disabled');
			}
		},
		get_description: function (obj, id) {
			var p = {};
			var d = '';
			var aoc = $('#option_' + id + '_AOC').get(0);
			if (aoc && aoc.checked) {
				d = lang.aoc;
			} else {
				$(':input', $('#opt_' + id)).each( function() {
					var op = this;
					var j_op = $(this);
					
					if (typeof(op.name) == 'string' && op.name == '') {
						return false;
					}

					var option_id = op.name.match(/\[(\d+)\]$/)[1];
					if (op.type == 'checkbox') {
						var variant = (op.checked == false) ? lang.no : lang.yes;
					}
					if (op.type == 'radio' && op.checked == true) {
						var variant = $('#option_description_' + id + '_' + option_id + '_' + op.value).text();
					}
					if (op.type == 'select-one') {
						var variant = op.options[op.selectedIndex].text;
					}
					if ((op.type == 'text' || op.type == 'textarea') && op.value != '') {
						if (j_op.hasClass('cm-hint') && op.value == op.defaultValue) { //FIXME: We should not become attached to cm-hint class
							var variant = '';
						} else {
							var variant = op.value;
						}
					}
					if ((op.type == 'checkbox') || ((op.type == 'text' || op.type == 'textarea') && op.value != '') || (op.type == 'select-one') || (op.type == 'radio' && op.checked == true)) {
						if (op.type == 'checkbox') {
							p[option_id] = (op.checked == false) ? $('#unchecked_' + id + '_option_' + option_id).val() : op.value;
						}else{
							p[option_id] = (j_op.hasClass('cm-hint') && op.value == op.defaultValue) ? '' : op.value; //FIXME: We should not become attached to cm-hint class
						}

						d += (d ? ',  ' : '') + $('#option_description_' + id + '_' + option_id).text() + variant;
					}
				});
			}
			return {path: p, desc: d != '' ? '<strong>' + lang.options + ':  </strong>' + d : ''};
		}

	}
{/literal}
{/if}

{literal}
	function fn_form_post_add_products(frm, elm) 
	{
		var products = {};
		var message = '';

		if ($('input.cm-item:checked', $(frm)).length > 0) {
			$('input.cm-item:checked', $(frm)).each( function() {
				var id = $(this).val();
				{/literal}
				{if $smarty.request.display == "options" || $smarty.request.display == "options_amount" || $smarty.request.display == "options_price"}
					{literal}
						var option = options_routine.get_description(frm, id);
						var options_combination = id;
						
						for(var ind in option.path) {
							options_combination += "_" + ind + "_" + option.path[ind];
						}
						
						products[id] = {};
						products[id].option = option;
						products[id].value = $('#product_' + id).val();
					{/literal}
				{else}
					products[id] = $('#product_' + id).val();
				{/if}
				{literal}
			});
			
			fn_set_hook('transfer_js_items', products);
			$.add_js_item(frm.attr('rev'), products, 'p', message);
			$.showNotifications({'data': {'type': 'N', 'title': lang.notice, 'message': lang.text_items_added, 'save_state': false, 'message_state': 'I'}});
		}
		
		return false;
	}
{/literal}
//]]>
</script>
{/if}

{include file="views/products/components/products_search_form.tpl" dispatch="products.picker" search_extra="<input type=\"hidden\" name=\"result_ids\" value=\"pagination_`$smarty.request.data_id`\">" put_request_vars=true form_meta="cm-ajax" simple_search_form=true}


<form action="{"`$index_script`?`$smarty.request.extra`"|fn_url}" method="post" name="add_products" rev="{$smarty.request.data_id}" enctype="multipart/form-data">

{if $products}
{include file="blocks/list_templates/products_list.tpl" 
show_name=true 
show_sku=true 
show_rating=true 
show_features=true 
show_prod_descr=true 
show_old_price=true 
show_price=true 
show_clean_price=true 
show_list_discount=true 
show_discount_label=true 
show_product_amount=true 
show_product_options=true 
show_qty=true 
show_min_qty=true 
show_product_edp=true 
show_descr=true 
disable_ids="bulk_addition_" 
dont_show_points=true 
bulk_addition=true 
js_product_var=$smarty.request.extra|fn_is_empty
hide_form=true 
bulk_add=true 
hide_layouts=true 
hide_links=true
id="pagination_`$smarty.request.data_id`"
force_ajax=true
}


{else}
<div class="pagination-container" id="pagination_{$smarty.request.data_id}">
	<p class="no-items">{$lang.text_no_matching_results_found}</p>
<!--pagination_{$smarty.request.data_id}--></div>
{/if}


{if $products}
<div class="buttons-container picker">
	<div>
	{include file="buttons/add_close.tpl" but_text=$lang.add_products but_close_text=$lang.add_products_and_close is_js=$smarty.request.extra|fn_is_empty}
	</div>
</div>
{/if}

</form>