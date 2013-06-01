{** block-description:original **}
{foreach from=$items item="banner" key="key"}
	{if $banner.type == "G" && $banner.main_pair.image_id}
	<div class="ad-container center">
		{if $banner.url != ""}<a href="{$banner.url|fn_url}" {if $banner.target == "B"}target="_blank"{/if}>{/if}
		{include file="common_templates/image.tpl" images=$banner.main_pair object_type="common"}
		{if $banner.url != ""}</a>{/if}
	</div>
	{else}
		<div class="wysiwyg-content">
			{$banner.description|unescape}
		</div>
	{/if}
{/foreach}