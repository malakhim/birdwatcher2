{foreach from=$tags_summary item="tag"}

<div class="tags-wrap">
		<div class="tag">
			<span class="tag-inner">
			{include file="buttons/button.tpl" but_href="tags.delete?tag_id=`$tag.tag_id`&amp;redirect_url=`$return_current_url`" but_meta="cm-confirm delete-icon" but_role="delete"}
			{$tag.tag} ({$tag.total})
			{assign var="return_current_url" value=$config.current_url|escape:url}
			</span>
		</div>
		{if $tag.products}
			<div class="tags-group">{$lang.products}:</div>
			<ul class="tags-list-container">
			{foreach from=$tag.products item="tag_product" key="tag_product_id"}
				<li>
					{include file="buttons/button.tpl" but_href="tags.delete?tag_id=`$tag.tag_id`&amp;object_type=P&amp;object_id=`$tag_product_id`&amp;redirect_url=`$return_current_url`" but_meta="cm-confirm delete-icon" but_role="delete"}
					<a href="{"products.view?product_id=`$tag_product_id`"|fn_url}">{$tag_product}</a>
				</li>
			{/foreach}
			</ul>
		{/if}
	
		{if $tag.pages}
			<div class="tags-group">{$lang.pages}:</div>
			<ul class="tags-list-container">
			{foreach from=$tag.pages item="tag_page" key="tag_page_id"}
				<li>
					{include file="buttons/button.tpl" but_href="tags.delete?tag_id=`$tag.tag_id`&amp;object_type=A&amp;object_id=`$tag_page_id`&amp;redirect_url=`$return_current_url`" but_meta="cm-confirm delete-icon" but_role="delete"}
					<a href="{"pages.view?page_id=`$tag_page_id`"|fn_url}">{$tag_page}</a>
				</li>
			{/foreach}
			</ul>
		{/if}
	
		{hook name="tags:summary"}{/hook}
</div>
<div class="{cycle values="hidden,hidden,hidden,clear"} tags-clear"></div>

{foreachelse}
	<p class="no-items">{$lang.no_items}</p>
{/foreach}

{capture name="mainbox_title"}{$lang.my_tags_summary}{/capture}