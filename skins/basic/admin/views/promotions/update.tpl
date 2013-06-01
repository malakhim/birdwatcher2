{script src="js/node_cloning.js"}
{literal}
<script type="text/javascript">
//<![CDATA[
function fn_promotion_add(id, skip_select, type)
{
	var skip_select = skip_select | false;
	var new_group = false;

	var new_id = $('#container_' + id).cloneNode(0, true, true).str_replace('container_', '');

	// Get data array index and increment it
	var e = $('input[name^=promotion_data]:first', $('#container_' + new_id).prev()).clone();
	if (e.length == 0) {
		e = $('input[inp_name^=promotion_data]:first', $('#container_' + new_id).prev()).clone();
	}
	if (e.val() != 'undefined' && e.val() != '') {
		e.val('');
	}

	// We added new group, so we need to get input from parent element or this is the new condition
	if (!e.get(0)) {
		e = $('input[name^=promotion_data]:first', $('#container_' + new_id).parents('li:first')).clone(); // for group

		$('.no-node.no-items', $('#container_' + new_id).parents('ul:first')).hide(); // hide conainer with "no items" text

		// new condition
		if (!e.get(0)) {
			var n = (type == 'condition') ? "promotion_data[conditions][conditions][0][condition]" : "promotion_data[bonuses][0][bonus]";
			e = $('<input type="hidden" name="'+ n +'" value="" />');
		} else {
			new_group = true;
		}
	}
	
	var _name = e.attr('name').length > 0 ? e.attr('name') : e.attr('inp_name');
	var val = parseInt(_name.match(/(.*)\[(\d+)\]/)[2]);
	var name = new_group? _name : _name.replace(/(.*)\[(\d+)\]/, '$1[' + (val + 1) +']');

	e.attr('name', name);
	$('#container_' + new_id).append(e);
	name = name.replace(/\[(\w+)\]$/, '');

	if (new_group) {
		name += '[conditions][1]';
	}

	$('#container_' + new_id).prev().removeClass('cm-last-item'); // remove tree node closure from previous element
	$('#container_' + new_id).addClass('cm-last-item').show(); // add tree node closure to new element
	// Update selector with name with new index
	if (skip_select == false) {
		$('#container_' + new_id + ' select').attr('id', new_id).attr('name', name);

	// Or just return id and name (for group)
	} else {
		$('#container_' + new_id).empty(); // clear node contents
		return {new_id: new_id, name: name};
	}
}

function fn_promotion_add_group(id, zone)
{
	var res = fn_promotion_add(id, true, 'condition');
	{/literal}
	$.ajaxRequest('{"promotions.dynamic?promotion_id=`$smarty.request.promotion_id`&zone="|fn_url:'A':'rel':'&'}' + zone + '&prefix=' + escape(res.name) + '&group=new&elm_id=' + res.new_id, {ldelim}result_ids: 'container_' + res.new_id{rdelim});
	{literal}
}

function fn_promotion_rebuild_mixed_data(value, id, element_id, condition_value, condition_value_name)
{
	var items = window['mixed_data_' + id];
	var opts = '';
	var first_variant = '';

	for (var k in items) {
		if (items[k]['is_group']) {
			for (var l in items[k]['items']) {
				first_variant = '';
				if (l == value) {
					if (items[k]['items'][l]['variants']) {
						var count = 0;
						for (var m in items[k]['items'][l]['variants']) {
							if (!first_variant) {
								first_variant = m;
							}
							opts += '<option value="' + m + '"' + (m == condition_value ? ' selected="selected"' : '') + '>' + items[k]['items'][l]['variants'][m] + '</option>';
							count++;
						}
						if (count < {/literal}{$smarty.const.PRODUCT_FEATURE_VARIANTS_THRESHOLD}{literal}) {
							$('#mixed_ajax_select_' + id).parents('.ajax_select_object').hide();
							$('#mixed_select_' + id).html(opts).show().attr('disabled', '');
							$('#mixed_input_' + id).hide().attr('disabled', true);
							$('#mixed_input_' + id + '_name').hide().attr('disabled', true);
						} else {
							$('#mixed_ajax_select_' + id).data('ajax_content', null);
							$('#mixed_select_' + id).hide().attr('disabled', true);
							$('#mixed_ajax_select_' + id).html('');
							$('#mixed_ajax_select_' + id).parents('.ajax_select_object').show();
							$('.cm-ajax-content-more', $('#scroller_mixed_ajax_select_' + id)).show();
							$('#content_loader_mixed_ajax_select_' + id).attr('rel', '{/literal}{"product_features.get_feature_variants_list&feature_id="|fn_url}{literal}' + l);
							$('#sw_mixed_ajax_select_' + id + '_wrap_').html(items[k]['items'][l]['variants'][first_variant]);
							$('#mixed_input_' + id + '_name').hide().attr('disabled', '');
							$('#mixed_input_' + id + '_name').val(items[k]['items'][l]['variants'][first_variant]);
							$('#mixed_input_' + id).hide().attr('disabled', '');
							$('#mixed_input_' + id).val(first_variant);
							if (condition_value && element_id == l) {
								$('#sw_mixed_ajax_select_' + id + '_wrap_').html(condition_value_name);
								$('#mixed_input_' + id + '_name').val(condition_value_name);
								$('#mixed_input_' + id).val(condition_value);
							}
						}
					} else {
						$('#mixed_input_' + id).val(element_id == l ? condition_value : '').show().attr('disabled', '');
						$('#mixed_select_' + id).hide().attr('disabled', true);
						$('#mixed_ajax_select_' + id).parents('.ajax_select_object').hide();
						$('#mixed_input_' + id + '_name').val('').hide().attr('disabled', true);
					}
				}
			}
		} else {
			if (k == value) {
				if (items[k]['variants']) {
					var count = 0;
					for (var m in items[k]['variants']) {
						if (!first_variant) {
							first_variant = m;
						}
						opts += '<option value="' + m + '"' + (m == condition_value ? ' selected="selected"' : '') + '>' + items[k]['variants'][m] + '</option>';
						count++;
					}
					if (count < {/literal}{$smarty.const.PRODUCT_FEATURE_VARIANTS_THRESHOLD}{literal}) {
						$('#mixed_ajax_select_' + id).parents('.ajax_select_object').hide();
						$('#mixed_select_' + id).html(opts).show().attr('disabled', '');
						$('#mixed_input_' + id).hide().attr('disabled', true);
						$('#mixed_input_' + id + '_name').hide().attr('disabled', true);
					} else {
						$('#mixed_ajax_select_' + id).data('ajax_content', null);
						$('#mixed_select_' + id).hide().attr('disabled', true);
						$('#mixed_ajax_select_' + id).html('');
						$('#mixed_ajax_select_' + id).parents('.ajax_select_object').show();
						$('.cm-ajax-content-more', $('#scroller_mixed_ajax_select_' + id)).show();
						$('#content_loader_mixed_ajax_select_' + id).attr('rel', '{/literal}{"product_features.get_feature_variants_list&feature_id="|fn_url}{literal}' + k);
						$('#sw_mixed_ajax_select_' + id + '_wrap_').html(items[k]['variants'][first_variant]);
						$('#mixed_input_' + id + '_name').hide().attr('disabled', '');
						$('#mixed_input_' + id + '_name').val(items[k]['variants'][first_variant]);
						$('#mixed_input_' + id).hide().attr('disabled', '');
						$('#mixed_input_' + id).val(first_variant);
						if (condition_value && element_id == k) {
							$('#sw_mixed_ajax_select_' + id + '_wrap_').html(condition_value_name);
							$('#mixed_input_' + id + '_name').val(condition_value_name);
							$('#mixed_input_' + id).val(condition_value);
						}
					}
				} else {
					$('#mixed_input_' + id).val(element_id == l ? condition_value : '').show().attr('disabled', '');
					$('#mixed_select_' + id).hide().attr('disabled', true);
					$('#mixed_ajax_select_' + id).parents('.ajax_select_object').hide();
					$('#mixed_input_' + id + '_name').val('').hide().attr('disabled', true);
				}
			}
		}
	}
}

//]]>
</script>
{/literal}



{capture name="mainbox"}

<form action="{""|fn_url}" method="post" name="promotion_form" class="cm-form-highlight {$cm_hide_inputs}" >
<input type="hidden" class="cm-no-hide-input" name="promotion_id" value="{$smarty.request.promotion_id}" />
<input type="hidden" class="cm-no-hide-input" name="selected_section" value="{$smarty.request.selected_section}" />
<input type="hidden" class="cm-no-hide-input" name="promotion_data[zone]" value="{$promotion_data.zone|default:$zone}" />

{capture name="tabsbox"}
<div id="content_details">
<fieldset>
	<div class="form-field">
		<label for="promotion_name" class="cm-required">{$lang.name}:</label>
		<input type="text" name="promotion_data[name]" id="promotion_name" size="25" value="{$promotion_data.name}" class="input-text-large main-input" />
	</div>
	
	<div class="form-field">
		<label for="promotion_det_descr">{$lang.detailed_description}:</label>
		<textarea id="promotion_det_descr" name="promotion_data[detailed_description]" cols="55" rows="8" class="cm-wysiwyg input-textarea-long">{$promotion_data.detailed_description}</textarea>
		
	</div>
	
	<div class="form-field">
		<label for="promotion_sht_descr">{$lang.short_description}:</label>
		<textarea id="promotion_sht_descr" name="promotion_data[short_description]" cols="55" rows="8" class="cm-wysiwyg input-textarea-long">{$promotion_data.short_description}</textarea>
	</div>
	

		
	<div class="form-field">
		<label for="use_avail_period">{$lang.use_avail_period}:</label>
		<div class="select-field float-left nowrap">
			<input type="checkbox" name="avail_period" id="use_avail_period" {if $promotion_data.from_date || $promotion_data.to_date}checked="checked"{/if} value="Y" class="checkbox" onclick="fn_activate_calendar(this);"/>
		</div>
	</div>

	{capture name="calendar_disable"}{if !$promotion_data.from_date && !$promotion_data.to_date}disabled="disabled"{/if}{/capture}
	
	<div class="form-field">
		<label for="date_holder_from">{$lang.avail_from}:</label>
		<input type="hidden" name="promotion_data[from_date]" value="0" />
		{include file="common_templates/calendar.tpl" date_id="date_holder_from" date_name="promotion_data[from_date]" date_val=$promotion_data.from_date|default:$smarty.const.TIME start_year=$settings.Company.company_start_year extra=$smarty.capture.calendar_disable}
	</div>
	
	<div class="form-field">
		<label for="date_holder_to">{$lang.avail_till}:</label>
		<input type="hidden" name="promotion_data[to_date]" value="0" />
		{include file="common_templates/calendar.tpl" date_id="date_holder_to" date_name="promotion_data[to_date]" date_val=$promotion_data.to_date|default:$smarty.const.TIME start_year=$settings.Company.company_start_year extra=$smarty.capture.calendar_disable}
	</div>

	{literal}
	<script language="javascript">
	//<![CDATA[
	function fn_activate_calendar(el)
	{
		var jelm = $(el);
		var checked = jelm.is(':checked');
		
		if (!checked) {
			$('#date_holder_from,#date_holder_to').attr('disabled', true);
			$('img[rev=date_holder_from],img[rev=date_holder_to]').removeClass('cm-external-focus');
		} else {
			$('#date_holder_from,#date_holder_to').attr('disabled', false);
			$('img[rev=date_holder_from],img[rev=date_holder_to]').addClass('cm-external-focus');
		}
	}

	fn_activate_calendar($('#use_avail_period'));
	//]]>
	</script>
	{/literal}

	<div class="form-field">
		<label for="promotion_priority">{$lang.priority}:</label>
		<input type="text" name="promotion_data[priority]" id="promotion_priority" size="25" value="{$promotion_data.priority}" class="input-text-short" />
	</div>
	
	<div class="form-field">
		<label for="promotion_stop">{$lang.stop_other_rules}:</label>
		<input type="hidden" name="promotion_data[stop]" value="N" />
		<input type="checkbox" name="promotion_data[stop]" id="promotion_stop" value="Y" {if $promotion_data.stop == "Y"}checked="checked"{/if} class="checkbox" />
	</div>
	
	{include file="common_templates/select_status.tpl" input_name="promotion_data[status]" id="promotion_data" obj=$promotion_data hidden=true}

</fieldset>
<!--content_details--></div>

<div id="content_conditions">

{include file="views/promotions/components/group.tpl" prefix="promotion_data[conditions]" group=$promotion_data.conditions root=true no_ids=true zone=$promotion_data.zone|default:$zone}

<!--content_conditions--></div>

<div id="content_bonuses">

{include file="views/promotions/components/bonuses_group.tpl" prefix="promotion_data[bonuses]" group=$promotion_data.bonuses zone=$promotion_data.zone|default:$zone}

<!--content_bonuses--></div>

{/capture}
{include file="common_templates/tabsbox.tpl" content=$smarty.capture.tabsbox active_tab=$smarty.request.selected_section track=true}

<div class="buttons-container buttons-bg">

	{include file="buttons/save_cancel.tpl" but_name="dispatch[promotions.update]" hide_first_button=$hide_first_button hide_second_button=$hide_second_button}
</div>
</form>
{/capture}

{if $mode == "add"}
	{assign var="title" value=$lang.new_promotion}
{else}
	{assign var="title" value="`$lang.editing_promotion`:&nbsp;`$promotion_data.name`"}
{/if}
{include file="common_templates/mainbox.tpl" title=$title content=$smarty.capture.mainbox select_languages=true}
