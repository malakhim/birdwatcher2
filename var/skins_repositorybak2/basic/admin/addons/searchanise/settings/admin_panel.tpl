<div class="snize" id="snize_container"></div>

{if $addons.searchanise.status != 'D'}
	{""|fn_se_check_import_is_done}
	{assign var="se_company_id" value=""|fn_se_get_company_id}
	{assign var="se_parent_private_key" value=$se_company_id|fn_se_get_parent_private_key:$smarty.const.CART_LANGUAGE}
{/if}

{if $settings.Appearance.calendar_date_format == "month_first"}
	{assign var="date_format" value="%k:%M %m/%d/%Y"}
{else}
	{assign var="date_format" value="%k:%M %d/%m/%Y"}
{/if}

{if "HTTPS"|defined}
	{assign var="se_service_url" value=$smarty.const.SE_SERVICE_URL|replace:'http://':'https://'}
{else}
	{assign var="se_service_url" value=$smarty.const.SE_SERVICE_URL}
{/if}

{if $addons.searchanise.status == 'D'}
<script type="text/javascript">
//<![CDATA[
	SearchaniseAdmin = {ldelim}{rdelim};
	SearchaniseAdmin.host = '{$se_service_url}';
	SearchaniseAdmin.AddonStatus = 'disabled';
//]]>
</script>
<script type="text/javascript" src="{$se_service_url}/js/init.js"></script>
{elseif $smarty.const.PRODUCT_TYPE == 'ULTIMATE'}

	{if !"COMPANY_ID"|defined}{*-root admin-*}
		{if ""|fn_se_is_registered == false}{*-only root admin can register-*}
			<script type="text/javascript">
			//<![CDATA[
				SearchaniseAdmin = {ldelim}{rdelim};
				SearchaniseAdmin.host = '{$se_service_url}';
				SearchaniseAdmin.PrivateKey = '';
				SearchaniseAdmin.ConnectLink = '{"searchanise.signup"|fn_url:'A':'current'}';
				SearchaniseAdmin.AddonStatus = 'enabled';
			//]]>
			</script>
			<script type="text/javascript" src="{$se_service_url}/js/init.js"></script>
		{else}{*-after register we always need select a vendor-*}
			{include file="common_templates/select_company.tpl" hide_title=true}
		{/if}
	{else}{*-vendor selected-*}
		{if ""|fn_se_is_registered == false}{*-only root can register-*}
			<p>
				{$lang.text_se_only_root_can_register}
				<br /><br /><br /><br />
			</p>
		{else}
			<script type="text/javascript">
			//<![CDATA[
				SearchaniseAdmin = {ldelim}{rdelim};
				SearchaniseAdmin.host = '{$se_service_url}';
				SearchaniseAdmin.PrivateKey = '{$se_parent_private_key}';
				SearchaniseAdmin.OptionsLink = '{"searchanise.options"|fn_url:'A':'current'}';
				SearchaniseAdmin.ReSyncLink = '{"searchanise.export"|fn_url:'A':'current'}';
				SearchaniseAdmin.LastRequest = '{"last_request"|fn_se_get_simple_setting|fn_parse_date|date_format:"`$date_format`"}';
				SearchaniseAdmin.LastResync = '{"last_resync"|fn_se_get_simple_setting|fn_parse_date|date_format:"`$date_format`"}';
				SearchaniseAdmin.ConnectLink = '{"searchanise.signup"|fn_url:'A':'current'}';
				SearchaniseAdmin.AddonStatus = 'enabled';

				SearchaniseAdmin.Engines = [];
				{foreach from=$se_company_id|fn_se_get_engines_data item='e'}
				SearchaniseAdmin.Engines.push({ldelim}
						PrivateKey: '{$e.private_key}',
						LangCode: '{$e.lang_code}',
						Name : '{$e.language_name}',
						ExportStatus: '{$e.import_status}'{if $currencies[$secondary_currency]},
						PriceFormat: {ldelim}
							rate : {$currencies[$secondary_currency].coefficient},
							decimals: {$currencies[$secondary_currency].decimals},
							decimals_separator: '{$currencies[$secondary_currency].decimals_separator}',
							thousands_separator: '{$currencies[$secondary_currency].thousands_separator}',
							symbol: '{$currencies[$secondary_currency].symbol}',
							after: {if $currencies[$secondary_currency].after == 'N'}false{else}true{/if}
						{rdelim}{/if}
					{rdelim});
				{/foreach}
			//]]>
			</script>
			<script type="text/javascript" src="{$se_service_url}/js/init.js"></script>
		{/if}
	{/if}

{else}{* $smarty.const.PRODUCT_TYPE != 'ULTIMATE' *}
<script type="text/javascript">
//<![CDATA[
	SearchaniseAdmin = {ldelim}{rdelim};
	SearchaniseAdmin.host = '{$se_service_url}';
	SearchaniseAdmin.PrivateKey = '{$se_parent_private_key}';
	SearchaniseAdmin.OptionsLink = '{"searchanise.options"|fn_url:'A':'current'}';
	SearchaniseAdmin.ReSyncLink = '{"searchanise.export"|fn_url:'A':'current'}';
	SearchaniseAdmin.LastRequest = '{"last_request"|fn_se_get_simple_setting|fn_parse_date|date_format:"`$date_format`"}';
	SearchaniseAdmin.LastResync = '{"last_resync"|fn_se_get_simple_setting|fn_parse_date|date_format:"`$date_format`"}';
	SearchaniseAdmin.ConnectLink = '{"searchanise.signup"|fn_url:'A':'current'}';
	SearchaniseAdmin.AddonStatus = {if $addons.searchanise.status == 'A'}'enabled'{else}'disabled'{/if};

	SearchaniseAdmin.Engines = [];
	{foreach from=$se_company_id|fn_se_get_engines_data item='e'}
	SearchaniseAdmin.Engines.push({ldelim}
			PrivateKey: '{$e.private_key}',
			LangCode: '{$e.lang_code}',
			Name : '{$e.language_name}',
			ExportStatus: '{$e.import_status}'{if $currencies[$secondary_currency]},
			PriceFormat: {ldelim}
				rate : {$currencies[$secondary_currency].coefficient},
				decimals: {$currencies[$secondary_currency].decimals},
				decimals_separator: '{$currencies[$secondary_currency].decimals_separator}',
				thousands_separator: '{$currencies[$secondary_currency].thousands_separator}',
				symbol: '{$currencies[$secondary_currency].symbol}',
				after: {if $currencies[$secondary_currency].after == 'N'}false{else}true{/if}
			{rdelim}{/if}
		{rdelim});
	{/foreach}
//]]>
</script>

<script type="text/javascript" src="{$se_service_url}/js/init.js"></script>
{/if}

{*$se_options|fn_print_r*}
