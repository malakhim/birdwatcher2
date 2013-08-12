{hook name="companies:view"}

{assign var="obj_id" value=$company_data.company_id}
{assign var="obj_id_prefix" value="`$obj_prefix``$obj_id`"}
{include file="common_templates/company_data.tpl" company=$company_data show_name=true show_descr=true show_rating=true show_logo=true hide_links=true}

<div class="vendor-main-info clearfix">
	<div class="float-left image-border center">
		{assign var="capture_name" value="logo_`$obj_id`"}
		{$smarty.capture.$capture_name}
	</div>

	<div id="block_company_{$company_data.company_id}" class="vendor-info">
		<h1 class="mainbox-title">{$company_data.company}</h1>
		{assign var="rating" value="rating_`$obj_id`"}{$smarty.capture.$rating}
		&nbsp;

		{if $company_data.company_description}
			<div class="wysiwyg-content">
				{$company_data.company_description|unescape}
			</div>
		{/if}

		{if $company_data.phone}
		<div id="company_phone" class="form-field vendor-list-field">
			<label>{$lang.phone}:</label>
			<span>{$company_data.phone}</span>
		</div>
		{/if}

		{if $company_data.url}
		<div id="company_website" class="form-field vendor-list-field">
			<label>{$lang.website}:</label>
			<span><a href="{$company_data.url}">{$company_data.url}</a></span>
		</div>
		{/if}

		<div id="company_products">
			<br />
			<a href="{"products.search?company_id=`$company_data.company_id`&search_performed=Y"|fn_url}">{$lang.view_vendor_products}</a>
		</div>

	</div>

</div>
{/hook}