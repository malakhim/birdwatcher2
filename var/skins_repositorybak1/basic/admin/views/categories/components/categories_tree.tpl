{if $parent_id}
<div class="hidden" id="cat_{$parent_id}">
{/if}
{foreach from=$categories_tree item=category}
{assign var="comb_id" value="cat_`$category.category_id`"}
<table cellpadding="0" cellspacing="0" border="0" width="100%" class="table table-tree">
{if $header && !$parent_id}
{assign var="header" value=""}
<tr>
	<th class="center" width="3%">
		<input type="checkbox" name="check_all" value="Y" title="{$lang.check_uncheck_all}" class="checkbox cm-check-items" /></th>
	<th width="5%">{$lang.position_short}</th>
	<th width="57%">
		{if $show_all && !$smarty.request.b_id}
		<div class="float-left">
			<img src="{$images_dir}/plus_minus.gif" width="13" height="12" border="0" alt="{$lang.expand_collapse_list}" title="{$lang.expand_collapse_list}" id="on_cat" class="hand cm-combinations{if $expand_all} hidden{/if}" />
			<img src="{$images_dir}/minus_plus.gif" width="13" height="12" border="0" alt="{$lang.expand_collapse_list}" title="{$lang.expand_collapse_list}" id="off_cat" class="hand cm-combinations{if !$expand_all} hidden{/if}" />
		</div>
		{/if}
		&nbsp;{$lang.name}
	</th>
	<th class="right" width="15%">{$lang.products}</th>
	<th width="10%">{$lang.status}</th>
	<th width="10%" class="nowrap">&nbsp;</th>
</tr>
{/if}

{if $category.disabled}
<tr {if $category.level > 0}class="multiple-table-row"{/if}>
   	{math equation="x*14" x=$category.level|default:"0" assign="shift"}
	<td class="center" width="3%">&nbsp;</td>
	<td width="5%">&nbsp;</td>
	<td width="57%">
	{strip}
		<span class="strong" style="padding-left: {$shift}px;">
			{if $category.has_children || $category.subcategories}
				{if $show_all}
					<img src="{$images_dir}/plus.gif" width="14" height="9" border="0" alt="{$lang.expand_sublist_of_items}" title="{$lang.expand_sublist_of_items}" id="on_{$comb_id}" class="hand cm-combination {if $expand_all}hidden{/if}" />
				{else}
					<img src="{$images_dir}/plus.gif" width="14" height="9" border="0" alt="{$lang.expand_sublist_of_items}" title="{$lang.expand_sublist_of_items}" id="on_{$comb_id}" class="hand cm-combination" onclick="if (!$('#{$comb_id}').children().get(0)) $.ajaxRequest('{"categories.manage?category_id=`$category.category_id`"|fn_url:'A':'rel':'&'}', {$ldelim}result_ids: '{$comb_id}'{$rdelim})" />
				{/if}
				<img src="{$images_dir}/minus.gif" width="14" height="9" border="0" alt="{$lang.collapse_sublist_of_items}" title="{$lang.collapse_sublist_of_items}" id="off_{$comb_id}" class="hand cm-combination{if !$expand_all || !$show_all} hidden{/if}" />&nbsp;
			{/if}
			{$category.category}{if $category.status == "N"}&nbsp;<span class="small-note">-&nbsp;[{$lang.disabled}]</span>{/if}
		</span>
	{/strip}
	</td>
	<td width="15%" class="nowrap right">&nbsp;</td>
	<td width="10%">&nbsp;</td>
	<td width="10%" class="nowrap">&nbsp;</td>
</tr>

{else}

<tr {if $category.level > 0}class="multiple-table-row"{/if}>
   	{math equation="x*14" x=$category.level|default:"0" assign="shift"}
	{if $category.company_categories}
		{assign var="comb_id" value="comp_`$category.company_id`"}
		<td class="center" width="3%">
			&nbsp;</td>
		<td width="5%">
			&nbsp;</td>
		<td width="57%">
		{strip}
			<span class="strong" style="padding-left: {$shift}px;">
					{if $show_all}
						<img src="{$images_dir}/plus.gif" width="14" height="9" border="0" alt="{$lang.expand_sublist_of_items}" title="{$lang.expand_sublist_of_items}" id="on_{$comb_id}" class="hand cm-combination {if $expand_all}hidden{/if}" />
					{else}
						<img src="{$images_dir}/plus.gif" width="14" height="9" border="0" alt="{$lang.expand_sublist_of_items}" title="{$lang.expand_sublist_of_items}" id="on_{$comb_id}" class="hand cm-combination" onclick="if (!$('#{$comb_id}').children().get(0)) $.ajaxRequest('{"categories.manage?category_id=`$category.category_id`"|fn_url:'A':'rel':'&'}', {$ldelim}result_ids: '{$comb_id}'{$rdelim})" />
					{/if}
					<img src="{$images_dir}/minus.gif" width="14" height="9" border="0" alt="{$lang.collapse_sublist_of_items}" title="{$lang.collapse_sublist_of_items}" id="off_{$comb_id}" class="hand cm-combination{if !$expand_all || !$show_all} hidden{/if}" />&nbsp;
				<a href="{"companies.update?company_id=`$category.company_id`"|fn_url}">{$category.category}</a>
			</span>
		{/strip}
		</td>
		<td width="15%" class="nowrap right">
			&nbsp;</td>
		<td width="10%">
			&nbsp;</td>
		<td width="10%" class="nowrap">
			&nbsp;</td>
	{else}
		<td class="center" width="3%">
			<input type="checkbox" name="category_ids[]" value="{$category.category_id}" class="checkbox cm-item" /></td>
		<td width="5%">
			<input type="text" name="categories_data[{$category.category_id}][position]" value="{$category.position}" size="3" class="input-text-short" /></td>
		<td width="57%">
		{strip}
			<span class="strong" style="padding-left: {$shift}px;">
				{if $category.has_children || $category.subcategories}
					{if $show_all}
						<img src="{$images_dir}/plus.gif" width="14" height="9" border="0" alt="{$lang.expand_sublist_of_items}" title="{$lang.expand_sublist_of_items}" id="on_{$comb_id}" class="hand cm-combination {if $expand_all}hidden{/if}" />
					{else}
						<img src="{$images_dir}/plus.gif" width="14" height="9" border="0" alt="{$lang.expand_sublist_of_items}" title="{$lang.expand_sublist_of_items}" id="on_{$comb_id}" class="hand cm-combination" onclick="if (!$('#{$comb_id}').children().get(0)) $.ajaxRequest('{"categories.manage?category_id=`$category.category_id`"|fn_url:'A':'rel':'&'}', {$ldelim}result_ids: '{$comb_id}'{$rdelim})" />
					{/if}
					<img src="{$images_dir}/minus.gif" width="14" height="9" border="0" alt="{$lang.collapse_sublist_of_items}" title="{$lang.collapse_sublist_of_items}" id="off_{$comb_id}" class="hand cm-combination{if !$expand_all || !$show_all} hidden{/if}" />&nbsp;
				{/if}
				<a href="{"categories.update?category_id=`$category.category_id`"|fn_url}"{if $category.status == "N"} class="manage-root-item-disabled"{/if}{if !$category.subcategories} style="padding-left: 14px;" class="normal"{/if} >{$category.category} {*include file="views/companies/components/company_name.tpl" company_name=$category.company_name company_id=$category.company_id*}</a>{if $category.status == "N"}&nbsp;<span class="small-note">-&nbsp;[{$lang.disabled}]</span>{/if}
			</span>
		{/strip}
		</td>
		<td width="15%" class="nowrap right">
			<a href="{"products.manage?cid=`$category.category_id`"|fn_url}" class="num-items">{if "COMPANY_ID"|defined}{$lang.manage_products}{else}<span>&nbsp;{$category.product_count}&nbsp;</span>{/if}</a>&nbsp;
			{include file="buttons/button.tpl" but_text=$lang.add but_href="products.add?category_id=`$category.category_id`" but_role="add"}
		</td>
		<td width="10%">
			{include file="common_templates/select_popup.tpl" id=$category.category_id status=$category.status hidden=true object_id_name="category_id" table="categories"}
		</td>
		<td width="10%" class="nowrap">
			{capture name="tools_items"}
			<li><a class="cm-confirm" href="{"categories.delete?category_id=`$category.category_id`"|fn_url}">{$lang.delete}</a></li>
			{/capture}
			{include file="common_templates/table_tools_list.tpl" prefix=$category.category_id tools_list=$smarty.capture.tools_items href="categories.update?category_id=`$category.category_id`"}
		</td>
	{/if}
</tr>

{/if}

</table>
{if $category.has_children || $category.subcategories}
	<div{if !$expand_all} class="hidden"{/if} id="{$comb_id}">
	{if $category.subcategories}
		{include file="views/categories/components/categories_tree.tpl" categories_tree=$category.subcategories parent_id=false}
	{/if}
	<!--{$comb_id}--></div>
{/if}
{/foreach}
{if $parent_id}<!--cat_{$parent_id}--></div>{/if}
