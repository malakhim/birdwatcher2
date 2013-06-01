{* $Id: image.tpl 12943 2011-07-13 10:52:06Z akulakov $ *}
{strip}

{if $capture_image}
	{capture name="image"}
{/if}

{if !$obj_id}
{math equation="rand()" assign="obj_id"}
{/if}

{assign var="flash" value=false}

{if $show_thumbnail != "Y"}
	{if !$image_width}
		{if $images.icon.image_x}
			{assign var="image_width" value=$images.icon.image_x}
		{/if}
		{if $images.icon.image_y}
			{assign var="image_height" value=$images.icon.image_y}
		{/if}
		{if !$image_width || !$image_height}
			{if $images.detailed.image_x}
				{assign var="image_width" value=$images.detailed.image_x}
			{/if}
			{if $images.detailed.image_y}
				{assign var="image_height" value=$images.detailed.image_y}
			{/if}
		{/if}
	{else}
		{if $images.icon.image_x && $images.icon.image_y}
			{math equation="new_x * y / x" new_x=$image_width x=$images.icon.image_x y=$images.icon.image_y format="%d" assign="image_height"}
		{/if}
		{if !$image_height && $images.detailed.image_x && $images.detailed.image_y}
			{math equation="new_x * y / x" new_x=$image_width x=$images.detailed.image_x y=$images.detailed.image_y format="%d" assign="image_height"}
		{/if}
	{/if}
{/if}

{if $max_width && !$image_width}
	{if $images.icon.image_x}
		{assign var="image_width" value=$images.icon.image_x}
	{elseif $images.detailed.image_x}
		{assign var="image_width" value=$images.detailed.image_x}
	{/if}
{/if}

{if $max_height && !$image_height}
	{if $images.icon.image_y}
		{assign var="image_height" value=$images.icon.image_y}
	{elseif $images.detailed.image_y}
		{assign var="image_height" value=$images.detailed.image_y}
	{/if}
{/if}

{if $max_width && $image_width && $image_width > $max_width}
	{assign var="image_width" value=$max_width}
	{math equation="new_x * y / x" new_x=$image_width x=$images.icon.image_x|default:$images.detailed.image_x y=$images.icon.image_y|default:$images.detailed.image_y format="%d" assign="image_height"}
{/if}

{if $max_height && $image_height && $image_height > $max_height}
	{assign var="image_height" value=$max_height}
	{math equation="new_y * x / y" new_y=$image_height y=$images.icon.image_y|default:$images.detailed.image_y x=$images.icon.image_x|default:$images.detailed.image_x format="%d" assign="image_width"}
{/if}

{if $images.icon}
	{assign var="image_id" value=$images.image_id}
{elseif $images.detailed}
	{assign var="image_id" value=$images.detailed_id}
{/if}

{if $show_detailed_link && $images.detailed_id}
<span class="{if !$images.detailed_id || $flash}hidden{/if} {$detailed_link_class} larger-image-wrap center" id="box_det_img_link_{$obj_id}">
	<a class="cm-external-click cm-view-larger-image" rev="det_img_link_{$obj_id}" title="{$lang.view_larger_image}"></a>
</span>
{/if}

{if !$images.icon.is_flash && !$images.detailed.is_flash}
	{if $show_thumbnail == "Y" && ($image_width || $image_height) && $image_id}
		{if $image_width && $image_height}
			{assign var="make_box" value=true}
			{assign var="proportional" value=true}
		{/if}
		{assign var="object_type" value=$object_type|default:"product"}
		{if $images.icon.image_path}
			{assign var="image_path" value=$images.icon.image_path}
		{else}
			{assign var="image_path" value=$images.detailed.image_path}
		{/if}
		
		{assign var="icon_image_path" value=$image_path|unescape|fn_generate_thumbnail:$image_width:$image_height:$make_box|escape}

		{if $absolute_image_path}
			{assign var="icon_image_path" value=$icon_image_path|fn_convert_relative_to_absolute_image_url}
		{/if}

		{if $make_box && !$proportional}
			{assign var="image_height" value=$image_width}
		{elseif $object_type == "detailed_product"}
			{if !$image_height && $image_width}
				{if $images.icon.image_x && $images.icon.image_y}
					{math equation="new_x * y / x" new_x=$image_width x=$images.icon.image_x y=$images.icon.image_y format="%d" assign="image_height"}
				{elseif $images.detailed.image_x && $images.detailed.image_y}
					{math equation="new_x * y / x" new_x=$image_width x=$images.detailed.image_x y=$images.detailed.image_y format="%d" assign="image_height"}
				{/if}
			{elseif !$image_width && $image_height}
				{if $images.icon.image_x && $images.icon.image_y}
					{math equation="new_x * y / x" new_x=$image_height x=$images.icon.image_y y=$images.icon.image_x format="%d" assign="image_width"}
				{elseif $images.detailed.image_x && $images.detailed.image_y}
					{math equation="new_x * y / x" new_x=$image_height x=$images.detailed.image_y y=$images.detailed.image_x format="%d" assign="image_width"}
				{/if}
			{/if}
		{/if}
	{else}
		{assign var="icon_image_path" value=$images.icon.image_path}
		{if !$icon_image_path}
			{if $object_type == "detailed_product" && $images.detailed.image_x}
				{if $settings.Thumbnails.product_details_thumbnail_width}
					{assign var="image_width" value=$settings.Thumbnails.product_details_thumbnail_width}
					{if $make_box && !$proportional}
						{assign var="image_height" value=$image_width}
					{else}
						{math equation="new_x * y / x" new_x=$image_width x=$images.detailed.image_x y=$images.detailed.image_y format="%d" assign="image_height"}
					{/if}
				{/if}
			{/if}
			{assign var="icon_image_path" value=$images.detailed.image_path|unescape|fn_generate_thumbnail:$image_width:$image_height:$make_box|escape}
		{/if}
	{/if}

	{if $show_detailed_link && $images.detailed_id}
		{if $object_type == "detailed_product" && ($settings.Thumbnails.product_detailed_image_width || $settings.Thumbnails.product_detailed_image_height)}
			{assign var="detailed_image_path" value=$images.detailed.image_path|unescape|fn_generate_thumbnail:$settings.Thumbnails.product_detailed_image_width:$settings.Thumbnails.product_detailed_image_height:$make_box|escape}
		{elseif $object_type == "detailed_category" && ($settings.Thumbnails.category_detailed_image_width || $settings.Thumbnails.category_detailed_image_height)}
			{assign var="detailed_image_path" value=$images.detailed.image_path|unescape|fn_generate_thumbnail:$settings.Thumbnails.category_detailed_image_width:$settings.Thumbnails.category_detailed_image_height:$make_box|escape}
		{else}
			{assign var="detailed_image_path" value=$images.detailed.image_path}
		{/if}
	{/if}

	{if $icon_image_path || !$hide_if_no_image}


	{if $detailed_image_path || $wrap_image}
	<a id="det_img_link_{$obj_id}" {if $detailed_image_path && $rel}rel="{$rel}"{/if} {if $rel}rev="{$rel}"{/if} class="{$link_class} {if $detailed_image_path}cm-previewer{/if}" {if $detailed_image_path}href="{$detailed_image_path}" title="{$images.detailed.alt}"{/if}>
	
	{/if}

	{assign var="alt_text" value=$images.icon.alt|default:$images.detailed.alt}
	<img class="{$valign} {$class}"  {if $obj_id && !$no_ids}id="det_img_{$obj_id}"{/if} src="{$config.full_host_name}{$icon_image_path|default:$config.no_image_path}" {if $image_width}width="{$image_width}"{/if} {if $image_height}height="{$image_height}"{/if} alt="{$alt_text}" title="{$alt_text}" {if $image_onclick}onclick="{$image_onclick}"{/if} border="0" />
	
	{if $detailed_image_path || $wrap_image}
	</a>
	{/if}

	{/if}

{else}
	{assign var="flash" value=true}
	{if $images.icon.is_flash}
		{assign var="flash_path" value=$images.icon.image_path}
	{else}
		{assign var="flash_path" value=$images.detailed.image_path}
	{/if}

	{assign var="icon_image_path" value=$flash_path|default:$config.no_image_path}
	{assign var="detailed_image_path" value=$flash_path|default:$config.no_image_path}
	
	{if $show_detailed_link && $images.detailed_id || $wrap_image}
		<a id="det_img_link_{$obj_id}" {if $rel}rel="{$rel}"{/if} {if $rel}rev="{$rel}"{/if} class="{$link_class} swf-thumb {if $show_detailed_link && $images.detailed_id}cm-previewer{/if}" {if $show_detailed_link && $images.detailed_id}href="{$config.full_host_name}{$flash_path|default:$config.no_image_path}"{/if} onclick="return false;">
	{/if}
	
	<span id="{$obj_id}" {if $image_onclick}onmousedown="{$image_onclick}"{/if} class="option-changer {if $_class}{$_class} object-image{/if}" style="{if $image_width}width: {$image_width}px;{/if} {if $image_height}height: {$image_height}px;{/if} position: relative; z-index: 0; margin: 3px {if !($show_detailed_link && $images.detailed_id || $wrap_image)}auto{/if};">
		<span class="option-changer-container" style="{if $image_width}width: {$image_width}px;{/if} {if $image_height}height: {$image_height}px;{/if}">
			<span id="swf_{$obj_id}"></span>
		</span>

		<script type="text/javascript">
			if (typeof swfobject == 'undefined') {ldelim}
				var res = $.get('lib/js/swfobject/swfobject.js', function() {ldelim}
					swfobject.embedSWF("{$config.full_host_name}{$flash_path|default:$config.no_image_path}", "swf_{$obj_id}", "{if $image_width}{$image_width}{else}30{/if}", "{if $image_height}{$image_height}{else}30{/if}", "9.0.0", "lib/js/swfobject/expressInstall.swf"{if $flash_vars} ,{$flash_vars},{else},"",{/if} {literal}{wmode: 'opaque'}{/literal});
				{rdelim});
			{rdelim} else {ldelim}
				swfobject.embedSWF("{$config.full_host_name}{$flash_path|default:$config.no_image_path}", "swf_{$obj_id}", "{if $image_width}{$image_width}{else}30{/if}", "{if $image_height}{$image_height}{else}30{/if}", "9.0.0", "lib/js/swfobject/expressInstall.swf"{if $flash_vars} ,{$flash_vars},{else},"",{/if} {literal}{wmode: 'opaque'}{/literal});
			{rdelim}
    	</script>

		<span class="option-changer-overlay{if $show_detailed_link && $images.detailed_id} cm-external-click{/if}" {if $show_detailed_link && $images.detailed_id}rev="det_img_link_{$obj_id}"{/if}></span>
	</span>
	
	{if $show_detailed_link && $images.detailed_id || $wrap_image}
		</a>
	{/if}
{/if}

{if $capture_image}
	{/capture}
	{capture name="icon_image_path"}
		{$icon_image_path|default:$config.no_image_path}
	{/capture}
	{capture name="detailed_image_path"}
		{$detailed_image_path|default:$config.no_image_path}
	{/capture}
{/if}

{/strip}
