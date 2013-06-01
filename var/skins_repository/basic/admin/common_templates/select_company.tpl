{if !$hide_title}
<h1 class="mainbox-title">
{$lang.$controller}
</h1>
{/if}
<div class="mainbox-body">{$lang.text_select_vendor} - {include file="common_templates/ajax_select_object.tpl" data_url="companies.get_companies_list?show_all=Y&action=href" text=$lang.select id="top_company_id"}</div>
