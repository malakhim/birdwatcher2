{assign var="id" value=$tab_data.tab_id|default:"0"}

{script src="js/tabs.js"}

{assign var=html_id value="tab_`$id`"}

<script type="text/javascript">
//<![CDATA[
	var html_id = "{$html_id}";
{literal}
	$(function() {
		$('.cm-remove-block').live('click', function(e) {
			if (confirm(lang.text_are_you_sure_to_proceed) != false) {
				var parent = $(this).parent();
				var block_id = parent.find('input[name="block_id"]').attr('value');

				$.ajaxRequest(fn_url('block_manager.block.delete'), {
					data: {block_id: block_id},
					callback: function() {
						parent.remove();
					},
					method: 'post'
				});
			}

			return false;
		});

		$('.cm-add-block').live('click', function(e) {
			/*
				Adding new block functionality
			*/
			var action = $(this).attr('class').match(/bm-action-([a-zA-Z0-9-_]+)/)[1];
			
			if (action == 'new-block') {				
				var block_type = $(this).find('input[name="block_data[type]"]').attr('value');				

				var href = 'block_manager.update_block?';
					href += 'block_data[type]=' + block_type;
					href += '&ajax_update=1';
					href += '&html_id=' + html_id;
					href += '&force_close=' + 1;
					href += '&assign_to=' + 'ajax_update_block_' + html_id;

				var prop_container = 'new_block_' + block_type;
				
				if ($('#' + prop_container).length == 0) {
					// Create properties container
					var contanier = $('<div id="' + prop_container + '"></div>').appendTo('body');
				}

				$('#' + prop_container).ceDialog('open', {href: fn_url(href)});				
			} else if (action == 'existing-block') {
				var block_id = $(this).find('input[name="block_id"]').attr('value');							
				var block_title = $(this).find('.select-block-title').text();

				data = {
					block_data: {
						block_id: $(this).find('input[name="block_id"]').attr('value')
					},
					assign_to: 'ajax_update_block_' + html_id,
					force_close: '1'
				};

				$.ajaxRequest(fn_url('block_manager.update_block'), {
					data: data,
					method: 'post'
				});

				$.ceDialog('get_last').ceDialog('close');
			}
		});
	});

	function fn_form_post_block_0_update_form () {
		$.ceDialog('get_last').ceDialog('close');
		$.ceDialog('get_last').ceDialog('close');
	}
{/literal}
//]]>
</script>

<form action="{""|fn_url}" name="update_product_tab_form_{$id}" method="post" class="cm-form-highlight">
<div id="content_group_{$html_id}">
	<input type="hidden" name="tab_data[tab_id]" value="{$id}" />
	<input type="hidden" name="result_ids" value="content_group_tab_{$id}" />

	<div class="tabs cm-j-tabs">
		<ul>
			<li id="general_{$html_id}" class="cm-js{if $active_tab == "block_general_`$html_id`"} cm-active{/if}"><a>{$lang.general}</a></li>
			
			{if $dynamic_object_scheme && $id > 0}
				<li id="tab_status_{$html_id}" class="cm-js{if $active_tab == "block_status_`$html_id`"} cm-active{/if}"><a>{$lang.status}</a></li>
			{/if}
		</ul>
	</div>
	<div class="cm-tabs-content" id="tabs_content_{$html_id}">
		<div id="content_general_{$html_id}">
			<fieldset>
				<div class="form-field">
					<label class="cm-required" for="description_{$html_id}">{$lang.name}:</label>
					<input type="text" name="tab_data[name]" value="{$tab_data.name}" id="description_{$html_id}" class="input-text" size="18" />
				</div>

				{if !$dynamic_object_scheme}
					{include file="common_templates/select_status.tpl" input_name="tab_data[status]" id="tab_data_`$html_id`" obj=$tab_data}
				{/if}

				<div class="form-field">
					<label for="show_in_popup_{$html_id}">{$lang.show_tab_in_popup}:</label>
					<input type="hidden" name="tab_data[show_in_popup]" value="N" /><input type="checkbox" name="tab_data[show_in_popup]" id="show_in_popup_{$html_id}" {if $tab_data.show_in_popup == "Y"}checked="checked"{/if} value="Y" class="checkbox"/>
				</div>

				{if $tab_data.is_primary !== 'Y' && "block_manager.update_block"|fn_check_view_permissions}
					<div class="form-field">
						<label for="ajax_update_block_{$html_id}" class="cm-required">{$lang.block}:</label>
						{include file="common_templates/popupbox.tpl"
							act="general"
							id="select_block_`$html_id`"
							text=$lang.select_block
							link_text=$lang.select_block
							href="block_manager.block_selection?extra_id=`$tab_data.tab_id`&on_product_tabs=1"
							action="block_manager.block_selection"
							opener_ajax_class="cm-ajax cm-ajax-force"
							content=""
						}

						<div id="ajax_update_block_{$html_id}">
							<input type="hidden" name="block_data[block_id]" id="ajax_update_block_{$html_id}" value="{$tab_data.block_id|default:''}" />
							
							{if $tab_data.block_id > 0}
								{include file="views/block_manager/render/block.tpl" block_data=$block_data external_render=true 
								external_id=$html_id}		
							{else}
							No Block
							{/if}
						<!--ajax_update_block_{$html_id}--></div>
					</div>
				{/if}
			</fieldset>
		</div>
		{if $dynamic_object_scheme && $id > 0}
			<div id="content_tab_status_{$html_id}" >
				<fieldset>
					<div class="form-field">
						<label>{$lang.global_status}:</label>
						<div class="select-field">
							{if $tab_data.status == 'A'}{$lang.active}{else}{$lang.disabled}{/if}
						</div>
					</div>
					<input type="hidden" class="cm-no-hide-input" name="snapping_data[object_type]" value="{$dynamic_object_scheme.object_type}" />
					<div class="form-field">
						<label>{if $tab_data.status == 'A'}{$lang.disable_for}{else}{$lang.enable_for}{/if}:</label>
						{include
							file=$dynamic_object_scheme.picker
							data_id="tab_`$html_id`_product_ids"
							input_name="tab_data[product_ids]"
							item_ids=$tab_data.product_ids
							view_mode="links"
							params_array=$dynamic_object_scheme.picker_params
						}
					</div>
				</fieldset>
			<!--content_tab_status_{$html_id}--></div>
		{/if}
	</div>

<!--content_group_{$html_id}--></div>
<div class="buttons-container">
	{include file="buttons/save_cancel.tpl" but_name="dispatch[tabs.update]" cancel_action="close"}
</div>
</form>