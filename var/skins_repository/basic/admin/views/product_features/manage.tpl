{script src="js/tabs.js"}

{capture name="mainbox"}

{include file="views/product_features/components/product_features_search_form.tpl" dispatch="product_features.manage"}

{literal}
<script type="text/javascript">
//<![CDATA[
function fn_check_product_feature_type(value, id)
{
	var w = $('#warning_feature_change_' + id);
	($('#tab_variants_' + id).is(':visible') && !(value == 'S' || value == 'M' || value == 'N' || value == 'E')) ? w.show() : w.hide();

	var t = $('#content_tab_variants_' + id);
	$('#tab_variants_' + id).toggleBy(!(value == 'S' || value == 'M' || value == 'N' || value == 'E'));
	// display/hide images
	$('.cm-extended-feature', t).toggleBy(value != 'E');
	if (value != 'E') {
		$('tr[id^=extra_feature_]', t).hide();
		$('img[id^=off_extra_feature_]', t).hide();
		$('img[id^=on_extra_feature_]', t).show();
		$('img[id^=off_st_]', t).hide();
		$('img[id^=on_st_]', t).show();
	}

	if (value == 'N') {
		$('.cm-feature-value', t).addClass('cm-value-decimal');
	} else {
		$('.cm-feature-value', t).removeClass('cm-value-decimal');
	}
}
//]]>
</script>
{/literal}

{include file="common_templates/pagination.tpl"}

{assign var="r_url" value=$config.current_url|escape:url}

<div class="items-container{if ""|fn_check_form_permissions} cm-hide-inputs{/if}" id="update_features_list">
{if $features}

	{if $has_ungroupped}
		<div class="object-group clear no-hover">
			<div class="float-left object-name">
				{$lang.ungroupped_features}
			</div>
		</div>
		
		{foreach from=$features item="p_feature"}
			{if $p_feature.feature_type != "G"}
				
				{if $smarty.const.PRODUCT_TYPE == "ULTIMATE" && $p_feature.company_id && !"COMPANY_ID"|defined}
					{assign var="feature_company_name" value=$p_feature.company_id|fn_get_company_name"}
					{assign var="feature_desc" value="`$p_feature.description` (`$lang.vendor`: `$feature_company_name`)"}
				{else}
					{assign var="feature_desc" value=$p_feature.description}
				{/if}

				{if ! "product_features"|fn_check_company_id:"feature_id":$p_feature.feature_id}
					{include file="common_templates/object_group.tpl" id=$p_feature.feature_id details=$p_feature.feature_description|unescape text=$feature_desc status=$p_feature.status hidden=true href="product_features.update?feature_id=`$p_feature.feature_id`&amp;return_url=$r_url" object_id_name="feature_id" table="product_features" additional_class="cm-hide-inputs" header_text="`$lang.editing_product_feature`:&nbsp;`$p_feature.description`" element="-elements"}
				{else}
					{include file="common_templates/object_group.tpl" id=$p_feature.feature_id details=$p_feature.feature_description|unescape text=$feature_desc status=$p_feature.status hidden=true href="product_features.update?feature_id=`$p_feature.feature_id`&amp;return_url=$r_url" object_id_name="feature_id" table="product_features" href_delete="product_features.delete?feature_id=`$p_feature.feature_id`" rev_delete="pagination_contents" header_text="`$lang.editing_product_feature`:&nbsp;`$p_feature.description`" element="-elements"}
				{/if}
			{/if}
		{/foreach}
	{/if}
	
	{foreach from=$features item="gr_feature"}
		{if $gr_feature.feature_type == "G"}
			{if $smarty.const.PRODUCT_TYPE == "ULTIMATE" && $gr_feature.company_id && !"COMPANY_ID"|defined}
				{assign var="feature_company_name" value=$gr_feature.company_id|fn_get_company_name"}
				{assign var="feature_desc" value="`$gr_feature.description` (`$lang.vendor`: `$feature_company_name`)"}
			{else}
				{assign var="feature_desc" value=$gr_feature.description}
			{/if}

			{if ! "product_features"|fn_check_company_id:"feature_id":$gr_feature.feature_id}
				{include file="common_templates/object_group.tpl" id=$gr_feature.feature_id details=$gr_feature.feature_description|unescape text=$feature_desc status=$gr_feature.status hidden=true href="product_features.update?feature_id=`$gr_feature.feature_id`&amp;return_url=$r_url" object_id_name="feature_id" table="product_features" additional_class="cm-hide-inputs" header_text="`$lang.editing_group`:&nbsp;`$gr_feature.description`"}
			{else}
				{include file="common_templates/object_group.tpl" id=$gr_feature.feature_id details=$gr_feature.feature_description|unescape text=$feature_desc status=$gr_feature.status hidden=true href="product_features.update?feature_id=`$gr_feature.feature_id`&amp;return_url=$r_url" object_id_name="feature_id" table="product_features" href_delete="product_features.delete?feature_id=`$gr_feature.feature_id`" rev_delete="pagination_contents,content_add_new_feature" header_text="`$lang.editing_group`:&nbsp;`$gr_feature.description`"}
			{/if}

	
			{if $gr_feature.subfeatures}
				{foreach from=$gr_feature.subfeatures item="subfeature"}

					{if $smarty.const.PRODUCT_TYPE == "ULTIMATE" && $subfeature.company_id && !"COMPANY_ID"|defined}
						{assign var="feature_company_name" value=$subfeature.company_id|fn_get_company_name"}
						{assign var="feature_desc" value="`$subfeature.description` (`$lang.vendor`: `$feature_company_name`)"}
					{else}
						{assign var="feature_desc" value=$subfeature.description}
					{/if}

					{if ! "product_features"|fn_check_company_id:"feature_id":$subfeature.feature_id}
						{include file="common_templates/object_group.tpl" id=$subfeature.feature_id details=$subfeature.feature_description|unescape text=$feature_desc status=$subfeature.status hidden=true href="product_features.update?feature_id=`$subfeature.feature_id`&amp;return_url=$r_url" object_id_name="feature_id" table="product_features" additional_class="cm-hide-inputs" header_text="`$lang.editing_product_feature`:&nbsp;`$subfeature.description`" element="-elements" update_controller="product_features"}
					{else}
						{include file="common_templates/object_group.tpl" id=$subfeature.feature_id details=$subfeature.feature_description|unescape text=$feature_desc status=$subfeature.status hidden=true href="product_features.update?feature_id=`$subfeature.feature_id`&amp;return_url=$r_url" object_id_name="feature_id" table="product_features" href_delete="product_features.delete?feature_id=`$subfeature.feature_id`" rev_delete="pagination_contents" header_text="`$lang.editing_product_feature`:&nbsp;`$subfeature.description`" element="-elements" update_controller="product_features"}
					{/if}

				{/foreach}
			{/if}
	
		{/if}
	{/foreach}
{else}
	<p class="no-items">{$lang.no_data}</p>
{/if}
<!--update_features_list--></div>

{include file="common_templates/pagination.tpl"}

	{capture name="tools"}
		{capture name="add_new_picker"}
			{include file="views/product_features/update.tpl" feature="" mode="add" is_group=true}
		{/capture}
		{include file="common_templates/popupbox.tpl" id="add_new_group" text=$lang.new_group content=$smarty.capture.add_new_picker link_text=$lang.add_group act="general"}

		{capture name="add_new_picker_2"}
			{include file="views/product_features/update.tpl" feature="" mode="add"}
		{/capture}
		{include file="common_templates/popupbox.tpl" id="add_new_feature" text=$lang.new_feature content=$smarty.capture.add_new_picker_2 link_text=$lang.add_feature act="general"}
	{/capture}

{/capture}
{include file="common_templates/mainbox.tpl" title=$lang.product_features content=$smarty.capture.mainbox tools=$smarty.capture.tools title_extra=$smarty.capture.title_extra select_languages=true}