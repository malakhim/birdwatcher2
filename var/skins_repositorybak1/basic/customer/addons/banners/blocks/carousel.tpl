{** block-description:carousel **}

{if $items}
<div class="cm-slider" id="banner_slider_{$block.snapping_id}">
	<div class="cm-slider-window">
		<div class="cm-slide-page-reel">
		{foreach from=$items item="banner" key="key"}
			<div class="cm-slide-page">
			{if $banner.type == "G" && $banner.main_pair.image_id}
				{if $banner.url != ""}<a href="{$banner.url|fn_url}" {if $banner.target == "B"}target="_blank"{/if}>{/if}
				{include file="common_templates/image.tpl" images=$banner.main_pair object_type="common"}
				{if $banner.url != ""}</a>{/if}
			{else}
				<div class="wysiwyg-content">
					{$banner.description|unescape}
				</div>
			{/if}
			</div>
		{/foreach}
		</div>
	</div>
	<div class="cm-paging {if $block.properties.navigation == "D"}cm-paging-dots{/if}">
		{foreach from=$items item="banner" key="key" name="banners"}
		{if $block.properties.navigation == "P"}
			<a rel="{$smarty.foreach.banners.iteration}" href="#">{$smarty.foreach.banners.iteration}</a>
		{else}
			<a rel="{$smarty.foreach.banners.iteration}" href="#">&nbsp;</a>
		{/if}
		{/foreach}
	</div>
</div>
{/if}

{math equation="s*1000" assign="delay" s=$block.properties.delay|default:0}
<script type="text/javascript">
//<![CDATA[
//Slider
$(function(){$ldelim}
	$('#banner_slider_{$block.snapping_id}').bannerSlider(
	{$ldelim}
		delay: {$delay},
		navigation: {if $items|count > 1}'{$block.properties.navigation|default:'N'}'{else}'N'{/if}
	{$rdelim});
{$rdelim});
//]]>
</script>