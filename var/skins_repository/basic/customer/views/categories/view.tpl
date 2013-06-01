{hook name="categories:view"}
<div id="category_products_{$block.block_id}">
{if $subcategories or $category_data.description || $category_data.main_pair}
{math equation="ceil(n/c)" assign="rows" n=$subcategories|count c=$columns|default:"2"}
{split data=$subcategories size=$rows assign="splitted_subcategories"}

{if $category_data.description && $category_data.description != ""}
	<div class="compact wysiwyg-content margin-bottom">{$category_data.description|unescape}</div>
{/if}


<div class="clearfix">
	{if $category_data.main_pair}
	<div class="cm-image-wrap image-border float-left margin-bottom">
		{include file="common_templates/image.tpl" show_detailed_link=true images=$category_data.main_pair object_type="detailed_category" no_ids=true rel="category_image" show_thumbnail="Y" image_width=$settings.Thumbnails.category_details_thumbnail_width image_height=$settings.Thumbnails.category_details_thumbnail_height hide_if_no_image=true}
	</div>

	{if $category_data.main_pair.detailed_id}
	{include file="common_templates/previewer.tpl" rel="category_image"}
	{/if}

	{/if}

	{if $subcategories}
	<div class="subcategories">
	{if $subcategories|@count < 6}
		<ul>
	{/if}
	{foreach from=$splitted_subcategories item="ssubcateg"}
		{if $subcategories|count >= 6}
			<div class="subcategories">
				<ul>
		{/if}
			{foreach from=$ssubcateg item=category name="ssubcateg"}
			{if $category.category_id}<li><a href="{"categories.view?category_id=`$category.category_id`"|fn_url}">{$category.category}</a></li>{/if}

		{/foreach}
		{if $subcategories|count >= 6}
				</ul>
			</div>
		{/if}
	{/foreach}
	{if $subcategories|count < 6}
	</ul>
	{/if}
	</div>
	{/if}
</div>
{/if}

{if $smarty.request.advanced_filter}
	{include file="views/products/components/product_filters_advanced_form.tpl" separate_form=true}
{/if}

{if $products}
{assign var="layouts" value=""|fn_get_products_views:false:0}
{if $category_data.product_columns}
	{assign var="product_columns" value=$category_data.product_columns}
{else}
	{assign var="product_columns" value=$settings.Appearance.columns_in_products_list}
{/if}

{if $layouts.$selected_layout.template}
	{include file="`$layouts.$selected_layout.template`" columns=`$product_columns`}
{/if}

{elseif !$subcategories}
<p class="no-items">{$lang.text_no_products}</p>
{/if}
<!--category_products_{$block.block_id}--></div>

{capture name="mainbox_title"}{$category_data.category}{/capture}
{/hook}
