<div class="subheader">
	{if $product.ekey && $no_capture}
		<a href="{"orders.download?ekey=`$product.ekey`&product_id=`$product.product_id`"|fn_url}"></a>
	{/if}
		{$product.product|unescape}
	{if $product.ekey && $no_capture}</a>{/if}
	
	{if $no_capture && !$hide_order}
	&nbsp;(<a href="{"orders.details?order_id=`$product.order_id`"|fn_url}">{$lang.order}# {$product.order_id}</a>)
	{/if}
</div>

<table cellspacing="0" cellpadding="0" class="table" width="100%">
<thead>
	<tr>
		<th>
			{$lang.filename}
		</th>
		<th>{$lang.filesize}</th>
	</tr>
</thead>

{foreach from=$product.files key="products_key" item="file"}
<tr {cycle values=",class=\"table-row\""}>
	<td>
		{if $file.ekey && ($file.activation_type !== "M" || $file.active == "Y") && $file.edp_info && (!$file.max_downloads || $file.downloads < $file.max_downloads)}<a href="{"orders.get_file?ekey=`$file.ekey`&product_id=`$product.product_id`&file_id=`$file.file_id`"|fn_url}" class="download-link">{$file.file_name}</a>{else}{$file.file_name}{/if}
		{if $file.activation_type == "M" && $file.active == "N"}<p>{$lang.notice}: {$lang.not_active_file_notice}</p>{elseif $file.max_downloads && $file.downloads >= $file.max_downloads}<p>{$lang.notice}: {$lang.file_download_limit_exceeded|replace:"[limit]":$file.max_downloads}</p>{elseif !$file.edp_info}<p>{$lang.download_link_expired}</p>{elseif !$file.ekey}<p>{if $file.activation_type == "P"}{$lang.file_avail_after_payment}{else}{$lang.download_link_expired}{/if}</p>{/if}
	</td>
	<td class="nowrap" width="20%">
		{$file.file_size|number_format:0:"":" "}&nbsp;{$lang.bytes}
	</td>
</tr>
{foreachelse}
<tr>
	<td><p class="no-items">{$lang.no_items}</p></td>
</tr>
{/foreach}

</table>

{capture name="mainbox_title"}{$lang.download}{/capture}