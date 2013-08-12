{if 'DEBUG_MODE'|defined}
<div class="bug-report">
	<input type="button" onclick="window.open('bug_report.php','popupwindow','width=700,height=450,toolbar=yes,status=no,scrollbars=yes,resizable=no,menubar=yes,location=no,direction=no');" value="Report a bug" />
</div>
{/if}

<div id="bottom_menu">
	<div class="logo-bottom float-left" title="{$smarty.const.PRODUCT_NAME} {if $smarty.const.PRODUCT_TYPE == "COMMUNITY"}Community Edition{/if}{if $smarty.const.PRODUCT_TYPE == "PROFESSIONAL"}Professional Edition{/if}{if $smarty.const.PRODUCT_TYPE == "MULTIVENDOR"}Multi-Vendor Edition{/if}{if $smarty.const.PRODUCT_TYPE == "ULTIMATE"}Ultimate Edition{/if}">&nbsp;</div>
	{if "tools.store_mode"|fn_check_view_permissions && ($smarty.const.PRODUCT_TYPE != 'ULTIMATE' || $smarty.const.PRODUCT_TYPE == 'ULTIMATE' && "COMPANY_ID"|defined)}
	<div class="float-left" id="store_mode">
		{if $settings.store_mode == "closed"}
			<a class="cm-ajax cm-confirm text-button" rev="store_mode" href="{"tools.store_mode?state=opened"|fn_url}">{$lang.open_store}</a>
		{else}
			<a class="cm-ajax cm-confirm text-button" rev="store_mode" href="{"tools.store_mode?state=closed"|fn_url}">{$lang.close_store}</a>
		{/if}
	<!--store_mode--></div>
	<div class="float-left" id="store_optimization">
		{if $settings.store_optimization == "dev"}
			<a class="cm-ajax cm-confirm text-button" rev="store_optimization" title="{$lang.live_store_description}" href="{"tools.store_optimization?state=live"|fn_url}">{$lang.live_store}</a>
		{else}
			<a class="cm-ajax cm-confirm text-button" rev="store_optimization" title="{$lang.dev_store_description}" href="{"tools.store_optimization?state=dev"|fn_url}">{$lang.dev_store}</a>
		{/if}
	<!--store_optimization--></div>
	{/if}
	{if $auth.user_id}
		
		<div class="float-left">
			{if $languages|sizeof > 1}
			{include file="common_templates/select_object.tpl" style="graphic" link_tpl=$config.current_url|fn_link_attach:"sl=" items=$languages selected_id=$smarty.const.CART_LANGUAGE display_icons=true key_name="name" language_var_name="sl" class="languages"}
			{/if}
			{if $currencies|sizeof > 1}
			{include file="common_templates/select_object.tpl" style="graphic" link_tpl=$config.current_url|fn_link_attach:"currency=" items=$currencies selected_id=$secondary_currency display_icons=false key_name="description"}
			{/if}
		</div>
		
	{/if}
	{if !"COMPANY_ID"|defined}
		<div class="float-left">
			{hook name="index:top"}{/hook}
		</div>
	{/if}
	<div class="float-left">
		{include file="common_templates/last_viewed_items.tpl"}
		<div id="bottom_popup_menu_wrap">
			<a id="sw_last_edited_items" class="cm-combo-on cm-combination" title="{$lang.last_viewed_items}">&nbsp;</a>
		</div>
	</div>
</div>
{if $smarty.request.meta_redirect_url|fn_check_meta_redirect}
	<meta http-equiv="refresh" content="1;url={$smarty.request.meta_redirect_url|fn_check_meta_redirect|fn_url}" />
{/if}

{literal}
<script type="text/javascript">
//<![CDATA[
$(function() {
	if ($.isMobile()) {
		$("#bottom_menu").css("position", "relative");
	}
});
//]]>
</script>
{/literal}
