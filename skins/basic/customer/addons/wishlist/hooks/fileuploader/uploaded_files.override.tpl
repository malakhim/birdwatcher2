{if $image.location == "wishlist"}
	<input type="hidden" name="{$name}[custom_files][uploaded][{$image.file}][product_id]" value="{$id}" />
	<input type="hidden" name="{$name}[custom_files][uploaded][{$image.file}][option_id]" value="{$po.option_id}" />
	<input type="hidden" name="{$name}[custom_files][uploaded][{$image.file}][name]" value="{$image.name}" />
	<input type="hidden" name="{$name}[custom_files][uploaded][{$image.file}][path]" value="{$image.file}" />
	
	{assign var="delete_link" value="wishlist.delete_file?cart_id=`$id`&amp;option_id=`$po.option_id`&amp;file=`$image_id`&amp;redirect_mode=cart"}
	{if $delete_link}<a class="cm-ajax" href="{$delete_link|fn_url}">{/if}{if !($po.required == "Y" && $images|count == 1)}<img src="{$images_dir}/icons/icon_delete.gif" width="12" height="12" border="0" hspace="3" id="clean_selection_{$id_var_name}_{$image.file}" alt="{$lang.remove_this_item}" title="{$lang.remove_this_item}" onclick="fileuploader.clean_selection(this.id); {if $multiupload != "Y"}fileuploader.toggle_links('{$id_var_name}', 'show');{/if} fileuploader.check_required_field('{$id_var_name}', '{$label_id}');" class="hand valign" />{/if}{if $delete_link}</a>{/if}<span>{if $download_link}<a href="{$download_link}">{/if}{$image.name}{if $download_link}</a>{/if}</span>
{/if}