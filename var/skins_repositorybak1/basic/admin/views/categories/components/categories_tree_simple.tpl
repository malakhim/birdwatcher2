{* --------- CATEGORY TREE --------------*}
{math equation="rand()" assign="rnd_value"}
{assign var="random" value=$random|default:$rnd_value}
{if $parent_id}
<div class="hidden" id="cat_{$parent_id}_{$random}">
{/if}
{foreach from=$categories_tree item=cur_cat}
{assign var="cat_id" value=$cur_cat.category_id}
{assign var="comb_id" value="cat_`$cur_cat.category_id`_`$random`"}
{assign var="title_id" value="category_`$cur_cat.category_id`"}

<table cellpadding="0" cellspacing="0" border="0" width="100%" class="table">
{if $header && !$parent_id}
{assign var="header" value=""}
<tr>
	<th class="center first-column" width="20">
	{if $display != "radio"}
		<input type="checkbox" name="check_all" value="Y" title="{$lang.check_uncheck_all}" class="checkbox cm-check-items" />
	{/if}
	</th>
	<th width="97%">
		{if $show_all}
		<div class="float-left">
			<img src="{$images_dir}/plus_minus.gif" width="13" height="12" border="0" id="on_cat" alt="{$lang.expand_collapse_list}" title="{$lang.expand_collapse_list}" class="hand cm-combinations-cat {if $expand_all}hidden{/if}"  />
			<img src="{$images_dir}/minus_plus.gif" width="13" height="12" border="0" id="off_cat" alt="{$lang.expand_collapse_list}" title="{$lang.expand_collapse_list}" class="hand cm-combinations-cat {if !$expand_all}hidden{/if}" />
		</div>
		{/if}
		&nbsp;{$lang.categories}
	</th>
	{if !"COMPANY_ID"|defined}
	<th class="right">{$lang.products}</th>
	{/if}
</tr>
{/if}

{if $cur_cat.disabled}
{assign var="level" value=$cur_cat.level|default:0}
<tr {if $level != "0"}{cycle values="class=\"table-row\", "}{else}{cycle values="" reset=1}class="manage-root-row"{/if}>
   	{math equation="x*14" x=$level assign="shift"}
	<td class="center first-column" width="20">&nbsp;</td>
	<td width="97%">
		{if $cur_cat.subcategories}
			{math equation="x+10" x=$shift assign="_shift"}
		{else}
			{math equation="x+21" x=$shift assign="_shift"}
		{/if}
		<table cellpadding="0" cellspacing="0" width="100%"	border="0">
		<tr>
			<td class="nowrap" style="padding-left: {$_shift}px;">
				{if $cur_cat.has_children || $cur_cat.subcategories}
					{if $show_all}
					<img src="{$images_dir}/plus.gif" width="14" height="9" border="0" alt="{$lang.expand_sublist_of_items}" title="{$lang.expand_sublist_of_items}" id="on_{$comb_id}" class="hand cm-combination-cat cm-uncheck {if isset($path.$cat_id) || $expand_all}hidden{/if}" />
					{else}
					{if $except_id}
						{assign var="_except_id" value="&except_id=`$except_id`"}
					{/if}
					<img src="{$images_dir}/plus.gif" width="14" height="9" border="0" alt="{$lang.expand_sublist_of_items}" title="{$lang.expand_sublist_of_items}" id="on_{$comb_id}" class="hand cm-combination-cat cm-uncheck {if (isset($path.$cat_id))}hidden{/if}" onclick="if (!$('#{$comb_id}').children().length) $.ajaxRequest('{"categories.picker?category_id=`$cur_cat.category_id`&random=`$random`&display=`$display`&checkbox_name=`$checkbox_name``$_except_id`"|fn_url:'A':'rel':'&'}', {$ldelim}result_ids: '{$comb_id}'{$rdelim})" />
					{/if}
					<img src="{$images_dir}/minus.gif" width="14" height="9" border="0" alt="{$lang.collapse_sublist_of_items}" title="{$lang.collapse_sublist_of_items}" id="off_{$comb_id}" class="hand cm-combination-cat cm-uncheck {if !isset($path.$cat_id) && (!$expand_all || !$show_all)}hidden{/if}" />
				{else}
					&nbsp;
				{/if}</td>
			<td width="100%">
				<strong id="category_{$cur_cat.category_id}">{$cur_cat.category}</strong>{if $cur_cat.status == "N"}&nbsp;<span class="small-note">-&nbsp;[{$lang.disabled}]</span>{/if}
			</td>
		</tr>
		</table>
	</td>
	{if !"COMPANY_ID"|defined}
	<td class="right">&nbsp;</td>
	{/if}
</tr>
{else}

{assign var="level" value=$cur_cat.level|default:0}
<tr {if $level != "0"}{cycle values="class=\"table-row\", "}{else}{cycle values="" reset=1}class="manage-root-row"{/if}>
   	{math equation="x*14" x=$level assign="shift"}
	<td class="center first-column" width="20">
		{if $cur_cat.company_categories}
			&nbsp;
			{assign var="comb_id" value="comp_`$cur_cat.company_id`_`$random`"}
			{assign var="title_id" value="c_company_`$cur_cat.company_id`"}
		{else}
			{if $display == "radio"}
			<input type="radio" name="{$checkbox_name}" value="{$cur_cat.category_id}" class="radio cm-item" />
			{else}
			<input type="checkbox" name="{$checkbox_name}[{$cur_cat.category_id}]" value="{$cur_cat.category_id}" class="checkbox cm-item" />
			{/if}
		{/if}
	</td>
	<td width="97%">
		{if $cur_cat.subcategories}
			{math equation="x+10" x=$shift assign="_shift"}
		{else}
			{math equation="x+21" x=$shift assign="_shift"}
		{/if}
		<table cellpadding="0" cellspacing="0" width="100%"	border="0">
		<tr>
			<td class="nowrap" style="padding-left: {$_shift}px;">
				{if $cur_cat.has_children || $cur_cat.subcategories}
					{if $show_all}
					<img src="{$images_dir}/plus.gif" width="14" height="9" border="0" alt="{$lang.expand_sublist_of_items}" title="{$lang.expand_sublist_of_items}" id="on_{$comb_id}" class="hand cm-combination-cat cm-uncheck {if isset($path.$cat_id) || $expand_all}hidden{/if}" />
					{else}
					{if $except_id}
						{assign var="_except_id" value="&except_id=`$except_id`"}
					{/if}
					<img src="{$images_dir}/plus.gif" width="14" height="9" border="0" alt="{$lang.expand_sublist_of_items}" title="{$lang.expand_sublist_of_items}" id="on_{$comb_id}" class="hand cm-combination-cat cm-uncheck {if (isset($path.$cat_id))}hidden{/if}" onclick="if (!$('#{$comb_id}').children().length) $.ajaxRequest('{"categories.picker?category_id=`$cur_cat.category_id`&random=`$random`&display=`$display`&checkbox_name=`$checkbox_name``$_except_id`"|fn_url:'A':'rel':'&'}', {$ldelim}result_ids: '{$comb_id}'{$rdelim})" />
					{/if}
					<img src="{$images_dir}/minus.gif" width="14" height="9" border="0" alt="{$lang.collapse_sublist_of_items}" title="{$lang.collapse_sublist_of_items}" id="off_{$comb_id}" class="hand cm-combination-cat cm-uncheck {if !isset($path.$cat_id) && (!$expand_all || !$show_all)}hidden{/if}" />
				{else}
					&nbsp;
				{/if}</td>
			<td width="100%">
				<strong id="{$title_id}">{$cur_cat.category} {*include file="views/companies/components/company_name.tpl" company_name=$cur_cat.company_name company_id=$cur_cat.company_id*}</strong>{if $cur_cat.status == "N"}&nbsp;<span class="small-note">-&nbsp;[{$lang.disabled}]</span>{/if}
			</td>
		</tr>
		</table>
	</td>
	{if !"COMPANY_ID"|defined}
	<td class="right">
		{if $cur_cat.company_categories}
			&nbsp;
		{else}
			{$cur_cat.product_count}&nbsp;&nbsp;&nbsp;
		{/if}
	</td>
	{/if}
</tr>

{/if}

</table>

{if $cur_cat.has_children || $cur_cat.subcategories}
	<div{if !$expand_all} class="hidden"{/if} id="{$comb_id}">
	{if $cur_cat.subcategories}
		{include file="views/categories/components/categories_tree_simple.tpl" categories_tree=$cur_cat.subcategories parent_id=false}
	{/if}
	<!--{$comb_id}--></div>
{/if}
{/foreach}
{if $parent_id}<!--cat_{$parent_id}_{$random}--></div>{/if}
{* --------- /CATEGORY TREE --------------*}
