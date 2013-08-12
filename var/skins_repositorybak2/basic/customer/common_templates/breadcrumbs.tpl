<div id="breadcrumbs_{$block.block_id}">

{if $breadcrumbs && $breadcrumbs|@sizeof > 1}
	<div class="breadcrumbs clearfix">
		{strip}
			{foreach from=$breadcrumbs item="bc" name="bcn" key="key"}
				{if $key != "0"}
					<img src="{$images_dir}/icons/breadcrumbs_arrow.gif" class="bc-arrow" border="0" alt="&gt;" />
				{/if}
				{if $bc.link}
					<a href="{$bc.link|fn_url}"{if $additional_class} class="{$additional_class}"{/if}{if $bc.nofollow} rel="nofollow"{/if}>{$bc.title|unescape|strip_tags|escape:"html"}</a>
				{else}
					<span>{$bc.title|unescape|strip_tags|escape:"html"}</span>
				{/if}
			{/foreach}
		{/strip}
	</div>
{/if}

<!--breadcrumbs_{$block.block_id}--></div>
