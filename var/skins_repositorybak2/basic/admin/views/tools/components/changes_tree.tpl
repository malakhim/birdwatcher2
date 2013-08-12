{if $parent_id}
<div class="hidden" id="changes_{$parent_id}">
{/if}
{foreach from=$changes_tree item=item key=item_id}
<table cellpadding="0" cellspacing="0" border="0" width="100%" class="table table-fixed">
{if $header && !$parent_id}
{assign var="header" value=""}
<tr>
	<th>
		{if $show_all}
		<div class="float-left">
			<img src="{$images_dir}/plus_minus.gif" width="13" height="12" border="0" alt="{$lang.expand_collapse_list}" title="{$lang.expand_collapse_list}" id="on_cat" class="hand cm-combinations{if $expand_all} hidden{/if}" />
			<img src="{$images_dir}/minus_plus.gif" width="13" height="12" border="0" alt="{$lang.expand_collapse_list}" title="{$lang.expand_collapse_list}" id="off_cat" class="hand cm-combinations{if !$expand_all} hidden{/if}" />
		</div>
		{/if}
		&nbsp;{$lang.changes}
	</th>
</tr>
{/if}
<tr {if $item.level % 2}class="multiple-table-row"{/if}>
   	{math equation="x*14" x=$item.level|default:"0" assign="shift"}
	<td{if $item.action} class="snapshot-{$item.action}"{/if}>
	{strip}
		<span style="padding-left: {$shift}px;">
			{if $item.content}
				{if $show_all}
					<img src="{$images_dir}/plus.gif" width="14" height="9" border="0" alt="{$lang.expand_sublist_of_items}" title="{$lang.expand_sublist_of_items}" id="on_changes_{$item_id}" class="hand cm-combination {if $expand_all}hidden{/if}" />
				{else}
					<img src="{$images_dir}/plus.gif" width="14" height="9" border="0" alt="{$lang.expand_sublist_of_items}" title="{$lang.expand_sublist_of_items}" id="on_changes_{$item_id}" class="hand cm-combination" />
				{/if}
				<img src="{$images_dir}/minus.gif" width="14" height="9" border="0" alt="{$lang.collapse_sublist_of_items}" title="{$lang.collapse_sublist_of_items}" id="off_changes_{$item_id}" class="hand cm-combination{if !$expand_all || !$show_all} hidden{/if}" />&nbsp;
			{else}
				&nbsp;
			{/if}
			<span {if !$item.content} style="padding-left: 14px;"{/if}>{$item.name}</span>
		</span>
	{/strip}
	</td>
</tr>
</table>
{if $item.content}
	<div{if !$expand_all} class="hidden"{/if} id="changes_{$item_id}">
	{if $item.content}
		{include file="views/`$controller`/components/changes_tree.tpl" changes_tree=$item.content parent_id=false}
	{/if}
	<!--changes_{$item_id}--></div>
{/if}
{/foreach}
{if $parent_id}<!--changes_{$parent_id}--></div>{/if}