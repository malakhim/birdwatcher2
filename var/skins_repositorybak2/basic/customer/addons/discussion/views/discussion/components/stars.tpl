<p class="nowrap stars">
{if $controller == "products" && $mode == "view"}<a onclick="$('#discussion').click(); return false;">{/if}
{section name="full_star" loop=$stars.full}<img src="{$images_dir}/icons/star_full.png" width="16" height="16" alt="*" />{/section}
{if $stars.part}<img src="{$images_dir}/icons/star_{$stars.part}.png" width="16" height="16" alt="" />{/if}
{section name="full_star" loop=$stars.empty}<img src="{$images_dir}/icons/star_empty.png" width="16" height="16" alt="" />{/section}
{if $controller == "products" && $mode == "view"}</a>{/if}

</p>