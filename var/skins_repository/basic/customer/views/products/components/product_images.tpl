{assign var="th_size" value="30"}

{if $product.main_pair.icon || $product.main_pair.detailed}
	{assign var="image_pair_var" value=$product.main_pair}
{elseif $product.option_image_pairs}
	{assign var="image_pair_var" value=$product.option_image_pairs|reset}
{/if}

{if $image_pair_var.image_id == 0}
	{assign var="image_id" value=$image_pair_var.detailed_id}
{else}
	{assign var="image_id" value=$image_pair_var.image_id}
{/if}

{if !$preview_id}
{assign var="preview_id" value=$product.product_id|uniqid}
{/if}

{assign var="gallery_swf" value="false"}
{foreach from=$product.image_pairs item="image_pair"}
	{if $image_pair.icon.is_flash || $image_pair.detailed_id}
		{assign var="gallery_swf" value="true"}
	{/if}
{/foreach}

{if $gallery_swf}
	{script src="lib/js/swfobject/swfobject.js"}
{/if}

<div class="cm-image-wrap">
{include file="common_templates/image.tpl" obj_id="`$preview_id`_`$image_id`" images=$image_pair_var object_type="detailed_product" show_thumbnail="Y" link_class="cm-image-previewer" image_width=$settings.Thumbnails.product_details_thumbnail_width image_height=$settings.Thumbnails.product_details_thumbnail_height rel="preview[product_images_`$preview_id`]" wrap_image=true}

{foreach from=$product.image_pairs item="image_pair"}
	{if $image_pair}
		{if $image_pair.image_id == 0}
			{assign var="image_id" value=$image_pair.detailed_id}
		{else}
			{assign var="image_id" value=$image_pair.image_id}
		{/if}
		{include file="common_templates/image.tpl" images=$image_pair object_type="detailed_product" link_class="cm-image-previewer hidden" show_thumbnail="Y" detailed_link_class="hidden" obj_id="`$preview_id`_`$image_id`" image_width=$settings.Thumbnails.product_details_thumbnail_width image_height=$settings.Thumbnails.product_details_thumbnail_height rel="preview[product_images_`$preview_id`]" wrap_image=true}
	{/if}
{/foreach}
</div>

{if $product.image_pairs}
	{if $settings.Appearance.thumbnails_gallery == "Y"}
	<input type="hidden" name="no_cache" value="1" />
	{strip}
		<ul class="product-thumbnails center jcarousel-skin" id="images_preview_{$preview_id}">
			{if $image_pair_var}
				<li>
					{if $image_pair_var.image_id == 0}
						{assign var="img_id" value=$image_pair_var.detailed_id}
					{else}
						{assign var="img_id" value=$image_pair_var.image_id}
					{/if}
					{include file="common_templates/image.tpl" images=$image_pair_var object_type="detailed_product" link_class="cm-thumbnails-mini cm-cur-item" image_width=$th_size image_height=$th_size show_thumbnail="Y" show_detailed_link=false make_box=true obj_id="`$preview_id`_`$img_id`_mini" wrap_image=true}
				</li>
			{/if}
			{if $product.image_pairs}
				{foreach from=$product.image_pairs item="image_pair"}
					{if $image_pair}
						<li>
							{if $image_pair.image_id == 0}
								{assign var="img_id" value=$image_pair.detailed_id}
							{else}
								{assign var="img_id" value=$image_pair.image_id}
							{/if}
							{include file="common_templates/image.tpl" images=$image_pair object_type="detailed_product" link_class="cm-thumbnails-mini" image_width=$th_size image_height=$th_size show_thumbnail="Y" show_detailed_link=false make_box=true obj_id="`$preview_id`_`$img_id`_mini" wrap_image=true}
						</li>
					{/if}
				{/foreach}
			{/if}
		</ul>
		{/strip}

		{script src="lib/js/jcarousel/jquery.jcarousel.js"}

	{else}
		<div class="product-thumbnails center" id="images_preview_{$preview_id}" style="width: {$settings.Thumbnails.product_details_thumbnail_width}px;">
		{strip}
			{if $image_pair_var.image_id == 0}
				{assign var="img_id" value=$image_pair_var.detailed_id}
			{else}
				{assign var="img_id" value=$image_pair_var.image_id}
			{/if}
			
			{if $image_pair_var}
				{include file="common_templates/image.tpl" images=$image_pair_var object_type="detailed_product" link_class="cm-thumbnails-mini cm-cur-item" image_width=$th_size image_height=$th_size show_thumbnail="Y" show_detailed_link=false obj_id="`$preview_id`_`$img_id`_mini" make_box=true wrap_image=true}
			{/if}

			{if $product.image_pairs}
				{foreach from=$product.image_pairs item="image_pair"}
					{if $image_pair}
							{if $image_pair.image_id == 0}
								{assign var="img_id" value=$image_pair.detailed_id}
							{else}
								{assign var="img_id" value=$image_pair.image_id}
							{/if}
							{include file="common_templates/image.tpl" images=$image_pair object_type="detailed_product" link_class="cm-thumbnails-mini" image_width=$th_size image_height=$th_size show_thumbnail="Y" show_detailed_link=false obj_id="`$preview_id`_`$img_id`_mini" make_box=true wrap_image=true}
					{/if}
				{/foreach}
			{/if}
		{/strip}
	    </div>
	{/if}
{/if}


{include file="common_templates/previewer.tpl" rel="preview[product_images_`$preview_id`]"}
{script src="js/product_image_gallery.js"}

<script type="text/javascript" class="cm-ajax-force">
//<![CDATA[
$(function(){$ldelim}
	$.ceProductImageGallery($("#images_preview_{$preview_id}"));
{$rdelim});
//]]>
</script>