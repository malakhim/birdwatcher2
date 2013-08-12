<div class="header-wrap">
<div id="header">
	<div id="logo">
		{assign var="name" value=$settings.Company.company_name|truncate:40:"...":true}
		

		
		<a href="{$index_script|fn_url}">{$name}</a><a href="{$config.http_location|fn_url|escape}" class="view-storefront-icon" target="_blank" title="{$lang.view_storefront}">&nbsp;</a>
		

	</div>

	<div id="top_quick_links">
		{if $auth.user_id}
		<div class="nowrap">
			{include file="top_quick_links.tpl"}
		</div>
		{/if}
	</div>

	<div id="top_menu">
	<ul id="alt_menu">
	{if $auth.user_id && $navigation.static}
	{foreach from=$navigation.static key=first_level_title item=m name="first_level_top"}
	{if $first_level_title == "administration" || $first_level_title == "design" || $first_level_title == "settings"}
		<li{if $first_level_title == $navigation.selected_tab} class="active"{/if}>
		<a class="drop {$first_level_title}">{$lang.$first_level_title}</a>
			<div class="dropdown-column">
			<div class="dropdown-column-col">
				<ul>
				{foreach from=$m key=second_level_title item="second_level" name="sec_level_top"}
					<li class="{if $second_level.subitems}sub-level {/if}{if $second_level_title == $navigation.subsection}active{/if}"><a href="{$second_level.href|fn_url}">{if $second_level.title}{$second_level.title}{else}{$lang[$second_level_title]}{/if}</a>
					{if $second_level.subitems}
						<div class="dropdown-second-level{if "COMPANY_ID"|defined} drop-left{/if}">
						<ul>
						{foreach from=$second_level.subitems key=subitem_title item=sm}
							<li{if $subitem_title == $navigation.subitem} class="active"{/if}><a href="{$sm.href}">{$lang[$subitem_title]}</a></li>
						{/foreach}
						</ul>
						</div>
					{/if}
				</li>
				{/foreach}
				</ul>
				</div>
			</div>
		</li>
	{/if}
	{/foreach}
	{/if}

	</ul>
	</div>

{if $smarty.const.PRODUCT_TYPE == "MULTIVENDOR" || $smarty.const.PRODUCT_TYPE == "ULTIMATE"}
	<div class="float-left">
	{if $s_companies|sizeof > 1}
		{if "TRANSLATION_MODE"|defined}
			{assign var="company_name" value=$s_companies.$s_company.company}
		{else}
			{assign var="company_name" value=$s_companies.$s_company.company|substr:0:40}
			{if $s_companies.$s_company.company|fn_strlen > 40}
				{assign var="company_name" value="`$company_name`..."}
			{/if}
		{/if}
		{include file="common_templates/ajax_select_object.tpl" data_url="companies.get_companies_list?show_all=Y&action=href" text=$company_name id="top_company_id"}
	{else}
			{$lang.vendor}: <a href="{"companies.update?company_id=`$s_company`"|fn_url}">{$s_companies.$s_company.company}</a>
	{/if}
	</div>
{/if}
	<ul id="menu">
		<li class="dashboard {if !$navigation.selected_tab}dashboard-active{/if}">
			<a href="{$index_script|fn_url}" title="{$lang.dashboard}">&nbsp;</a>
		</li>

		{if $auth.user_id && $navigation.static}
		{foreach from=$navigation.static key=first_level_title item=m name="first_level"}
		{if $first_level_title != "administration" && $first_level_title != "design" && $first_level_title != "settings"}
		<li{if $first_level_title == $navigation.selected_tab} class="active"{/if}>
			<a class="drop">{$lang.$first_level_title}</a>
			<div class="dropdown-column">
				<div class="dropdown-column-col">
				<ul>
				{foreach from=$m key=second_level_title item="second_level" name="sec_level"}
					<li class="blank {$second_level_title}{if $second_level.subitems} sub-level{/if}{if $second_level_title == $navigation.subsection && $first_level_title == $navigation.selected_tab} active{/if}"><a href="{$second_level.href|fn_url}"><span>{$lang.$second_level_title}</span>
						{if $lang[$second_level.description] != "_`$second_level_title`_menu_description"}{if $settings.Appearance.show_menu_descriptions == "Y"}<span class="hint">{$lang[$second_level.description]}</span>{/if}{/if}</a>
						{if $second_level.subitems}
							<div class="dropdown-second-level">
							<ul>
							{foreach from=$second_level.subitems key=subitem_title item=sm}
								<li{if $subitem_title == $navigation.subitem} class="active"{/if}><a href="{$sm.href}">{$lang[$subitem_title]}</a></li>
							{/foreach}
							</ul>
							</div>
						{/if}
					</li>
				{/foreach}
				</ul>
				</div>
			</div>
		</li>
		{/if}
		{/foreach}
		{/if}
		<li class="search">
			{include file="common_templates/quick_search.tpl"}
		</li>
	</ul>
<!--header--></div></div>

{literal}
<script type="text/javascript">
//<![CDATA[
$(function() {
	if ($.isMobile()) {
		$("#menu li a").click(function(){
		});
		$("#top_menu li a").click(function(){
		});
		$('#header').css('padding-top', '15px !important'); 
	}
});
//]]>
</script>
{/literal}