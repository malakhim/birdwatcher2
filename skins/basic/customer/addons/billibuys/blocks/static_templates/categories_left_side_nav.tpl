{literal}
<script src="addons/billibuys/js/left_nav.js" type="text/javascript"></script>
{/literal}

{assign var="bb_cats" value=""|fn_bb_get_categories}
{*$bb_cats|var_dump*}
<div class="cat-left-side-nav">
<div id="cat-header">{$lang.categories}</div>
{foreach from=$bb_cats item="cat"}
	{if $cat.status == 'A'}
		{if $cat.parent_category_id == 0}
			<div class="root-lvl-cat" cat_id="{$cat.bb_request_category_id}">
				{$cat.category_name}
				{if $cat.children_categories}<div class="left-side-nav-img" width="10px"></div>{/if}
			</div>
		{else}
			<div class="second-lvl-cat" cat_id="{$cat.bb_request_category_id}">{$cat.category_name}</div>
		{/if}
	{/if}
{/foreach}
</div>