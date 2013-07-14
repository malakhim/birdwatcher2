{assign var="_addon" value=$smarty.request.addon}
{if $separate}
	{script src="js/tabs.js"}
	{script src="js/profiles_scripts.js"}
	<script type="text/javascript">
		//<![CDATA[
		{assign var="states" value=$smarty.const.CART_LANGUAGE|fn_get_all_states:false:true}
		var states = new Array();
		{if $states}
		{foreach from=$states item=country_states key=country_code}
		states['{$country_code}'] = new Array();
		{foreach from=$country_states item=state name="fs"}
		states['{$country_code}']['{$state.code|escape:quotes}'] = '{$state.state|escape:javascript}';
		{/foreach}
		{/foreach}
		{/if}
		//]]>
	</script>
	
	<h1 class="mainbox-title">
		{$addon_name}
	</h1>
{/if}
<div id="content_group{$_addon}">
	<div class="tabs cm-j-tabs {if $subsections|count == 1}hidden{/if}">
		<ul>
			{foreach from=$subsections key="section" item="subs"}
				{assign var="tab_id" value="`$_addon`_`$section`"}
				<li class="cm-js {if $smarty.request.selected_section == $tab_id}cm-active{/if}" id="{$tab_id}"><a>{$subs.description}</a></li>
			{/foreach}
		</ul>
	</div>
	<div class="cm-tabs-content" id="tabs_content_{$_addon}">

		<form action="{""|fn_url}" method="post" name="update_addon_{$_addon}_form" class="cm-form-highlight" enctype="multipart/form-data">
		<input type="hidden" name="addon" value="{$smarty.request.addon}" />
		
		{foreach from=$options key="section" item="field_item"}
		
		{if $subsections.$section.type == "SEPARATE_TAB"}
			{capture name="separate_section"}
		{/if}

		<div id="content_{$_addon}_{$section}" class="settings{if $subsections.$section.type == "SEPARATE_TAB"} cm-hide-save-button{/if}">
			<fieldset>
				{foreach from=$field_item key="name" item="data" name="fe_addons"}
					{include file="common_templates/settings_fields.tpl" item=$data section=$_addon html_id="addon_option_`$_addon`_`$data.name`" html_name="addon_data[options][`$data.object_id`]"}
				{/foreach}
			</fieldset>
		</div>
		
		{if $subsections.$section.type == "SEPARATE_TAB"}
			{/capture}
			{assign var="sep_sections" value=$sep_sections|cat:$smarty.capture.separate_section}
		{/if}
		{/foreach}
		
		<div class="buttons-container{if $separate} buttons-bg{/if} cm-toggle-button">
			{if $separate}
				{include file="buttons/save_cancel.tpl" but_name="dispatch[addons.update]" hide_second_button=true breadcrumbs=$breadcrumbs}
			{else}
				{include file="buttons/save_cancel.tpl" but_name="dispatch[addons.update]" cancel_action="close"}
			{/if}
		</div>

		</form> 

		{$sep_sections}
	</div>

<!--content_group{$_addon}--></div>
