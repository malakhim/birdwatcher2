<div id="{$result_ids}">
	<input type="hidden" value="{$selected_companies|@count}" name="selected_companies_count">
	{if !"COMPANY_ID"|defined}
		{assign var="show_add_button" value=true}
	{/if}
	{include file="pickers/companies_picker.tpl" data_id="share" input_name="share_objects[`$object`][`$object_id`]" item_ids=$selected_companies no_js=true positions=false view_mode="list" hide_edit_button=true view_only="COMPANY_ID"|defined multiple=true hidden_field=true show_add_button=$show_add_button no_item_text=$no_item_text}
	
	{if $schema.buttons && (!"COMPANY_ID"|defined || $owner_id == $smarty.const.COMPANY_ID)}
		<div class="buttons-container buttons-bg">
			{include file="buttons/`$schema.buttons.type`.tpl" but_name=$schema.buttons.but_name}
		</div>
	{/if}
<!--{$result_ids}--></div>