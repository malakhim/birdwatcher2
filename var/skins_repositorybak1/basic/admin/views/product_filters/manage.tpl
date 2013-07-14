{script src="js/tabs.js"}

<script type="text/javascript">
//<![CDATA[
	var filter_fields = {ldelim}{rdelim};
	{foreach from=$filter_fields item=filter_field key=key}
	filter_fields['{$key}'] = '{$filter_field.slider}';
	{/foreach}

{literal}
function fn_check_product_filter_type(value, tab_id, id)
{
	$('#' + tab_id).toggleBy(!(value.indexOf('R') == 0) && !(value.indexOf('D') == 0));
	$('[id^=inputs_ranges' + id + ']').toggleBy((value.indexOf('D') == 0));
	$('[id^=dates_ranges' + id + ']').toggleBy(!(value.indexOf('D') == 0));
	$('#round_to_' + id + '_container').toggleBy(!filter_fields[value.replace(/\w+-/, '')]);
	$('#display_count_' + id + '_container').toggleBy(!(value.indexOf('R') == 0) && !(value.indexOf('F') == 0));
}
//]]>
</script>
{/literal}

{capture name="mainbox"}

{include file="views/product_filters/components/product_filters_search_form.tpl" dispatch="product_filters.manage"}

{include file="common_templates/pagination.tpl" object_type="filters"}

{assign var="r_url" value=$config.current_url|escape:url}

<div class="items-container{if ""|fn_check_form_permissions} cm-hide-inputs{/if}" id="manage_filters_list">
{foreach from=$filters item="filter"}
	
	{if $smarty.const.PRODUCT_TYPE == "ULTIMATE" && $filter.company_id && !"COMPANY_ID"|defined}
		{assign var="filter_company_name" value=$filter.company_id|fn_get_company_name"}
		{assign var="filter_name" value="`$filter.filter` (`$lang.vendor`: `$filter_company_name`)"}
	{else}
		{assign var="filter_name" value=$filter.filter}
	{/if}

    {if !"product_filters"|fn_check_company_id:"filter_id":$filter.filter_id}
        {include file="common_templates/object_group.tpl" id=$filter.filter_id text=$filter_name details=$filter.filter_description|unescape href="product_filters.update?filter_id=`$filter.filter_id`&amp;return_url=$r_url" header_text="`$lang.editing_filter`:&nbsp;`$filter.filter`" table="product_filters" object_id_name="filter_id" status=$filter.status  additional_class="cm-hide-inputs"}
    {else}
        {include file="common_templates/object_group.tpl" id=$filter.filter_id text=$filter_name details=$filter.filter_description|unescape href="product_filters.update?filter_id=`$filter.filter_id`&amp;return_url=$r_url" href_delete="product_filters.delete?filter_id=`$filter.filter_id`" rev_delete="pagination_contents" header_text="`$lang.editing_filter`:&nbsp;`$filter.filter`" table="product_filters" object_id_name="filter_id" status=$filter.status}

    {/if}
	
{foreachelse}

	<p class="no-items">{$lang.no_data}</p>

{/foreach}
<!--manage_filters_list--></div>

{include file="common_templates/pagination.tpl" object_type="filters"}

{capture name="tools"}
	{capture name="add_new_picker"}
		{include file="views/product_filters/update.tpl" mode="add" filter=""}
	{/capture}
	{if $smarty.const.PRODUCT_TYPE != "MULTIVENDOR" || (!"COMPANY_ID"|defined && $smarty.const.PRODUCT_TYPE == "MULTIVENDOR")}
	{include file="common_templates/popupbox.tpl" id="add_product_filter" text=$lang.new_filter content=$smarty.capture.add_new_picker link_text=$lang.add_filter act="general"}
	{/if}
{/capture}

{/capture}
{include file="common_templates/mainbox.tpl" title=$lang.product_filters content=$smarty.capture.mainbox tools=$smarty.capture.tools title_extra=$smarty.capture.title_extra select_languages=true}