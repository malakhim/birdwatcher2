{hook name="companies:catalog"}

{assign var="title" value=$lang.all_vendors}

{if $companies}

{include file="common_templates/pagination.tpl"}

{include file="views/companies/components/sorting.tpl"}

{foreach from=$companies item=company key=key name="companies"}
{assign var="obj_id" value=$company.company_id}
{assign var="obj_id_prefix" value="`$obj_prefix``$obj_id`"}
{include file="common_templates/company_data.tpl" company=$company show_name=true show_descr=true show_rating=true show_logo=true}
<div class="product-container clearfix">
	<div class="float-left product-item-image center">
		{assign var="capture_name" value="logo_`$obj_id`"}
		{$smarty.capture.$capture_name}
		
		{assign var="rating" value="rating_$obj_id"}
		{$smarty.capture.$rating}
	</div>
	
	<div class="vendor-info">
		{assign var="company_name" value="name_`$obj_id`"}
		{$smarty.capture.$company_name}

		<div class="product-descr">
			{assign var="company_descr" value="company_descr_`$obj_id`"}
			{$smarty.capture.$company_descr}
		</div>
	</div>
</div>
{if !$smarty.foreach.companies.last}
<hr />
{/if}
{/foreach}

{include file="common_templates/pagination.tpl"}

{else}
	<p class="no-items">{$lang.no_items}</p>
{/if}

{capture name="mainbox_title"}{$title}{/capture}

{/hook}