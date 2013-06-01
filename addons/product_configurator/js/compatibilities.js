//var compatible_classes = {};
var error_message = 0;
var product_class = 0;
var compatible = {};
var group_has_selected = 0;
var current_step_id = 0;
var forbidden_groups = {}; // This variable will be used for hierarchical analysis of compatibilities

//
// Check required product for the step
//
function fn_check_required_products(step_id, show_section)
{
	for (var groups_ in conf[step_id]) {
		selected_product = fn_define_selected_product(step_id, groups_);
		if (conf[step_id][groups_]['required'] == 'Y' && selected_product == false) {
			if (show_section == 'Y') {
				fn_alert(lang.text_required_group_product.replace('[group_name]', conf[step_id][groups_]['name']));
			}
			return false;
		}
	}
	return true;
}

//
// Check whole configurable product for all required groups has selected products
//
function fn_check_all_steps()
{
	for (var step_id in conf) {
		if (fn_check_required_products(step_id, 'N') == false) {
			return false;
		}
	}
	return true;
}

//
// Check if user can go to the section
//
function fn_check_step(new_step_id)
{
	// If we use the "Next" button then find out the new section
	var step_id = current_step_id;
	var get_next = false;
	var i;

	var sections = $('#tabs_configurator > li');
	for (i = 0; i < sections.length; i++) {
		if (!new_step_id) {
			if (get_next == true) {
				new_step_id = sections.eq(i).attr('id');
				get_next = false;
			}
			if (sections.eq(i).attr('id') == step_id) {
				get_next = true;
			}
		}
	}
	var j = sections.eq(i - 1).attr('id');

	// Check whether all required groups have products
	if (fn_check_required_products(step_id, 'Y') == false) {
		return false;
	}

	// if the last section is selected then hide the "Next" button, and show "Add to cart" button
	if (new_step_id == j) {
		$('#next_button').toggleBy(true);
		var sh = fn_check_all_steps();
		$('#pconf_buttons_block').toggleBy(!sh);
	} else {
		$('#next_button').toggleBy(false);
	}

	fn_swith_configurator_tabs(new_step_id);
	current_step_id = new_step_id;
	return true;
}

function fn_swith_configurator_tabs(tab_id)
{
	$('#tabs_configurator > li').each(function()
	{
		$(this).removeClass('cm-active');
		$('#content_' + $(this).attr('id')).hide();
	});

	$('#' + tab_id).addClass('cm-active');
	$('#content_' + tab_id).show();
}

function fn_change_visibillyty(group_id, product_id, enabled){
	if (enabled) {
		$('#group_' + group_id + ' [id*=product_' + product_id + ']:not(.cm-configurator-disabled)').attr('disabled', true);
		$('#group_' + group_id + ' [id*=product_' + product_id + ']:not(.cm-configurator-disabled)').removeAttr('checked');
		$('#group_' + group_id + ' [id*=product_' + product_id + ']:not(.cm-configurator-disabled)').removeAttr('selected');
	} else {
		$('#group_' + group_id + ' [id*=product_' + product_id + ']:not(.cm-configurator-disabled)').removeAttr('disabled');		
	}
}

// ************************************************** C O M P A T I B I L I T I E S ****************************************/
//
// Check all compatibilities
//
function fn_check_all_compatibilities()
{
	for (var step_id in conf) {
		for (var group_id in conf[step_id]) {
			selected_product = fn_define_selected_product(step_id, group_id);
			// If any product is selected then define compatibilities for it
			if (selected_product != false && selected_product.indexOf(':') != -1 && free_rec == 0) {
				do {
					fn_check_compatibilities(group_id, selected_product.substring(0, selected_product.indexOf(':')), conf[step_id][group_id]['type'], false);
					selected_product = selected_product.substr(selected_product.indexOf(':')+1);
				} while (selected_product.indexOf(':') != -1);
			} else if (selected_product != false && free_rec == 0) {
				fn_check_compatibilities(group_id, selected_product, conf[step_id][group_id]['type'], false);
			}
		}
	}
	// Check whether refresh was clicked on thу last step
	var s_section = $('#tabs_configurator > li.cm-active').attr('id');
	if (s_section == step_id) {
		$('#next_button').toggleBy(true);
	}
	var sh = fn_check_all_steps();
	$('#pconf_buttons_block').toggleBy(!sh);
}

function fn_check_compatibilities_process_response(data){
	select_first = true;
	for (var i in data.available) {			
		fn_change_visibillyty(data.available[i].group_id, data.available[i].product_id, false);			
	}
	
	for (var i in data.disavailable) {
		fn_change_visibillyty(data.disavailable[i].group_id, data.disavailable[i].product_id, true);		
	}	

	var sh = fn_check_all_steps();
	$('#pconf_buttons_block').toggleBy(!sh);
}    

//
// Check compatibilities for the selected product, update price and show/hide buttons
//
function fn_check_compatibilities(group_id, product_id, type)
{
	var initial_product_id = [];

	// Define configuration products
	if (type == 'S' && document.getElementById('group_'+group_id).value) {
		initial_product_id = [document.getElementById('group_'+group_id).value];
	} else if (type == 'R' && product_id) {
		initial_product_id = [product_id];
	} else if (type == 'C') {
		for (var k in conf_prod[group_id]) {
			if (document.getElementById('group_' + group_id + '_product_' + k).checked == true) {
				initial_product_id.push(k);
			}
		}
	}

	// Hide selectbox 'details' link if 'none' option selected
	var detail_link_holder = $('#select_' + group_id);
	if (detail_link_holder.length) {
		$('a', detail_link_holder).hide();
		if (type == 'S' && initial_product_id) {
			$('#opener_description_' + group_id + '_' + initial_product_id, detail_link_holder).show();			
		}
	}
	
	// Enable all products in selected group
	$('[id*=group_' + group_id + '_]:not(.cm-configurator-disabled)').removeAttr('disabled');
	$('[id=group_' + group_id + ']:not(.cm-configurator-disabled) option:not(.cm-configurator-disabled)').removeAttr('disabled');
	
	$.ajaxRequest(fn_url(index_script + '?dispatch=products.compability&product_id=' + initial_product_id + '&group_id='+group_id), {
        hidde: true,
        method: 'get',
        callback: fn_check_compatibilities_process_response          
    });
}

//
// This defines the selected product in the current group
//
function fn_define_selected_product(step_id, group_id)
{
	var selected_product = false;
	// Define which product is selected in the group
	if (document.getElementById('group_one_'+group_id)) { // This means that this group contains only one product and is should be selected
		selected_product = document.getElementById('group_one_'+group_id).value;
	} else if (conf[step_id][group_id]['type'] == 'S') {
		selected_product = document.getElementById('group_'+group_id).value;
	} else if (conf[step_id][group_id]['type'] == 'R') {
		var d_form = document.getElementById('group_'+group_id).getElementsByTagName("INPUT");
		for(var elem=0; elem < d_form.length; elem++) {
			if (d_form[elem].type == "radio" && d_form[elem].checked == true) {
				selected_product = d_form[elem].value;
			}
		}
	} else if (conf[step_id][group_id]['type'] == 'C') {
		var d_form = document.getElementById('group_'+group_id).getElementsByTagName("INPUT");
		for(var elem=0; elem < d_form.length; elem++) {
			if (d_form[elem].type == "checkbox" && d_form[elem].checked == true) {
				if (selected_product == false) {
					selected_product = ''
				}
				selected_product += d_form[elem].value + ':';
			}
		}
	}
	return selected_product;
}

$(function () {	
	var id = $('[id*=group_]:checked:first').attr('id');
	if (id != null) {
		re = /group_(\d+)_product_(\d+)/i;
		found = id.match(re);		
		fn_check_compatibilities(found[1], found[2], fn_get_type($('#' + id)));
	}
	
	$('[id*=qty_count]').live('keypress', function(event) {		
		if (event.which == 13)	 {
			return fn_check_all_steps();
		}		  
	});
});

function fn_get_type(element){
	if (element.attr('type') == 'checkbox') {
		return 'C';
	} else if (element.attr('type') == 'radio') {
		return 'R';
	}
	return 'S';
}