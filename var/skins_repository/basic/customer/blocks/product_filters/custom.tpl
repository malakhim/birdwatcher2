{** block-description:custom **}

{if $items}
{assign var="fh" value=$smarty.request.features_hash}
{foreach from=$items item="filter" name="filters"}
	{if $filter.slider}
		{assign var="filter_uid" value="`$block.block_id`_`$filter.filter_id`"}
		{include file="blocks/product_filters/components/product_filter_slider.tpl" filter_uid=$filter_uid id="content_product_more_filters_`$filter_uid`" filter=$filter dynamic=false allow_ajax=false extra_class="cm-custom-filter"}
	{else}
		<ul class="product-filters" id="content_product_more_filters_{$block.block_id}_{$filter.filter_id}">
		{foreach from=$filter.ranges name="ranges" item="range"}
			<li>
				{strip}
				{if $range.selected == true}
					{$range.range_name|fn_text_placeholders}
				{else}
					<a href="{if $filter.feature_type == "E" && !$filter.simple_link}{"product_features.view?variant_id=`$range.range_id`"|fn_url}{else}{assign var="filter_features_hash" value=""|fn_add_range_to_url_hash:$range:$filter.field_type}{"products.search?features_hash=`$filter_features_hash`&amp;variant_id=`$range.range_id`"|fn_url}{/if}"{if $filter.feature_type != "E"} rel="nofollow"{/if}>{$range.range_name|fn_text_placeholders}</a>
				{/if}
				{/strip}
			</li>
		{/foreach}
		</ul>
	{/if}
{/foreach}
{/if}
