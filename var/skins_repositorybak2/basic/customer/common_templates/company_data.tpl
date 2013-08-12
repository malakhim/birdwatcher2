{assign var="obj_id" value=$obj_id|default:$company.company_id}

{capture name="name_`$obj_id`"}
	{if $show_name}
		{if $hide_links}<strong>{else}<a href="{"companies.view?company_id=`$company.company_id`"|fn_url}" class="product-title">{/if}{$company.company|unescape}{if $hide_links}</strong>{else}</a>{/if}
	{elseif $show_trunc_name}
		{if $hide_links}<strong>{else}<a href="{"companies.view?company_id=`$company.company_id`"|fn_url}" class="product-title" title="{$company.company|strip_tags}">{/if}{$company.company|unescape|truncate:45:"...":true}{if $hide_links}</strong>{else}</a>{/if}
	{/if}
{/capture}
{if $no_capture}
	{assign var="capture_name" value="name_`$obj_id`"}
	{$smarty.capture.$capture_name}
{/if}

{capture name="rating_`$obj_id`"}
	{hook name="companies:data_block"}
	{/hook}
{/capture}
{if $no_capture}
	{assign var="capture_name" value="rating_`$obj_id`"}
	{$smarty.capture.$capture_name}
{/if}

{capture name="company_descr_`$obj_id`"}
	{if $show_descr}
		{$company.company_description|unescape|strip_tags|truncate:1024}{if !$hide_links && $company.company_description|strlen > 1024} <a href="{"companies.view?company_id=`$company.company_id`"|fn_url}" class="lowercase">{$lang.more}</a>{/if}
	{/if}
{/capture}
{if $no_capture}
	{assign var="capture_name" value="company_descr_`$obj_id`"}
	{$smarty.capture.$capture_name}
{/if}

{capture name="logo_`$obj_id`"}
	{if $show_logo}
		{if !$hide_links}<a href="{"companies.view?company_id=`$company.company_id`"|fn_url}">{/if}
		<span id="compnay_image_{$company.company_id}">
			{if $company.manifest.Customer_logo.vendor}
			<img border="0" width="120" alt="{$company.manifest.Customer_logo.alt}" src="{$config.images_path}{$company.manifest.Customer_logo.filename}" />
			{else}
			<img border="0" width="120" alt="{$company.manifest.Customer_logo.alt}" src="{$config.no_image_path}" />
			{/if}
		</span>			
		{if !$hide_links}</a>{/if}
	{/if}
{/capture}
{if $no_capture}
	{assign var="capture_name" value="logo_`$obj_id`"}
	{$smarty.capture.$capture_name}
{/if}

{hook name="companies:company_data"}{/hook}