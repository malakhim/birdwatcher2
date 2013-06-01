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

{script src="js/fileuploader_scripts.js"}

{capture name="mainbox"}

<div class="items-container" id="addons_list">
{foreach from=$addons_list item="a" key="key"}
	{if "COMPANY_ID"|defined}
		{assign var="hide_for_vendor" value=true}
	{/if}

	{if $a.status == "N"}
		{assign var="details" value=""}
		{assign var="non_editable" value=true}  
		{assign var="status" value=""} 
		{if !"COMPANY_ID"|defined}   
			{assign var="act" value="fake"}
			{capture name="links"}
				<a class="lowercase {if !$a.js_functions.install_button}cm-ajax cm-ajax-force cm-ajax-full-render{/if}" href="{"addons.install?addon=`$key`"|fn_url}" {if $a.js_functions.install_button}onclick="{$a.js_functions.install_button}(); return false;"{/if} rev="addon_{$key},header">{$lang.install}</a>
			{/capture}
		{/if}
	{else}
		{assign var="details" value=""}
		{assign var="link_text" value=""}
		{assign var="status" value=$a.status} 
		{if $a.has_options}
			{assign var="act" value="edit"}
			{assign var="non_editable" value=false}
		{else}
			{assign var="act" value="fake"}
			{assign var="non_editable" value=true}
		{/if}
		{if !"COMPANY_ID"|defined}
			{capture name="links"}
			<a class="cm-confirm lowercase cm-ajax cm-ajax-force cm-ajax-full-render" href="{"addons.uninstall?addon=`$a.addon`"|fn_url}" rev="addon_{$key}">{$lang.uninstall}</a>
			{/capture}
		{/if}
	{/if}

	{if $a.separate && !$non_editable}
		{assign var="link_text" value=$lang.manage|lower}
	{elseif $a.status != "N"}
		{assign var="link_text" value=$lang.settings|lower}
	{else}
		{assign var="link_text" value="&nbsp;"}
	{/if}

	{include no_popup=$a.separate file="common_templates/object_group.tpl" id=$a.addon text=$a.name details=$a.description status_rev="header" update_controller="addons" href="addons.update?addon=`$a.addon`" href_delete="" rev_delete="addons_list" header_text="`$a.name`:&nbsp;<span class=\"lowercase\">`$lang.options`</span>" links=$smarty.capture.links non_editable=$non_editable row_id="addon_`$key`" link_text=$link_text}
{foreachelse}

	<p class="no-items">{$lang.no_items}</p>

{/foreach}
<!--addons_list--></div>

{/capture}
{include file="common_templates/mainbox.tpl" title=$lang.addons content=$smarty.capture.mainbox}

