{assign var="id" value=$div_id|default:"pagination_contents"}
{assign var="qstring" value=$smarty.server.QUERY_STRING|fn_query_remove:"page":"result_ids"}

{if $smarty.capture.pagination_open != "Y"}
<div id="{$id}">
{/if}

{if $object_type}
	{assign var="pagination" value=$pagination_objects.$object_type}
{/if}

{if $pagination}
	{script src="lib/js/history/jquery.history.js"}
	{literal}
		<script type="text/javascript">
		//<![CDATA[
		$(function() {
			$.initHistory();
		});
		//]]>
		</script>
	{/literal}

	{if $save_current_page}
		<input type="hidden" name="page" value="{$search.page|default:$smarty.request.page|default:1}" />
	{/if}

	{if $save_current_url}
		<input type="hidden" name="redirect_url" value="{$config.current_url}" />
	{/if}

	{if !$disable_history}
		{assign var="history_class" value=" cm-history"}
	{else}
		{assign var="history_class" value=" cm-ajax-cache"}
	{/if}

	<div class="pagination clear cm-pagination-wraper{if $smarty.capture.pagination_open != "Y"} top-pagination{/if}">
		{if $pagination.total_pages > 1}
		<div class="float-left">
			<label>{$lang.go_to_page|escape:html}:</label>
			<input type="text" class="input-text-short valign cm-pagination{$history_class}" value="{if $smarty.request.page > $pagination.total_pages}1{else}{$smarty.request.page|default:1}{/if}" />
			<img src="{$images_dir}/icons/pg_right_arrow.gif" class="pagination-go-button hand cm-pagination-button" alt="{$lang.go|escape:html}" title="{$lang.go|escape:html}" />
		</div>
		{else}
		<div class="float-left pagination-disabled">
			<label>{$lang.go_to_page|escape:html}:</label>
			<span>1</span>
		</div>
		{/if}

		<div class="float-right">
		{if $pagination.current_page != "full_list" && $pagination.total_pages > 1}
			<span class="lowercase"><a name="pagination" class="{if $pagination.prev_page}cm-ajax{/if}{$history_class}" {if $pagination.prev_page}href="{"`$index_script`?`$qstring`&amp;page=`$pagination.prev_page`"|fn_url}" rel="{$pagination.prev_page}" rev="{$id}"{/if}>&laquo;&nbsp;{$lang.previous}</a></span>

			{foreach from=$pagination.navi_pages item="pg" name="f_pg"}
				{if $smarty.foreach.f_pg.first && $pg > 1 }
				<a name="pagination" class="cm-ajax{$history_class}" href="{"`$index_script`?`$qstring`&amp;page=1`"|fn_url}" rel="1" rev="{$id}">1</a>
				{if $pg != 2}<a name="pagination" class="{if $pagination.prev_range}cm-ajax{/if} prev-range{$history_class}" {if $pagination.prev_range}href="{"`$index_script`?`$qstring`&amp;page=`$pagination.prev_range`"|fn_url}" rel="{$pagination.prev_range}" rev="{$id}"{/if}>&nbsp;...&nbsp;</a>{/if}
				{/if}
				{if $pg != $pagination.current_page}<a name="pagination" class="cm-ajax{$history_class}" href="{"`$index_script`?`$qstring`&amp;page=`$pg`"|fn_url}" rel="{$pg}" rev="{$id}">{$pg}</a>{else}<span class="strong">{$pg}</span>{/if}
				{if $smarty.foreach.f_pg.last && $pg < $pagination.total_pages}
				{if $pg != $pagination.total_pages-1}<a name="pagination" class="{if $pagination.next_range}cm-ajax{/if} next-range{$history_class}" {if $pagination.next_range}href="{"`$index_script`?`$qstring`&amp;page=`$pagination.next_range`"|fn_url}" rel="{$pagination.next_range}" rev="{$id}"{/if}>&nbsp;...&nbsp;</a>{/if}<a name="pagination" class="cm-ajax{$history_class}" href="{"`$index_script`?`$qstring`&amp;page=`$pagination.total_pages`"|fn_url}" rel="{$pagination.total_pages}" rev="{$id}">{$pagination.total_pages}</a>
				{/if}
			{/foreach}

			<span class="lowercase"><a name="pagination" class="{if $pagination.next_page}cm-ajax{/if}{$history_class}" {if $pagination.next_page}href="{"`$index_script`?`$qstring`&amp;page=`$pagination.next_page`"|fn_url}" rel="{$pagination.next_page}" rev="{$id}"{/if}>{$lang.next}&nbsp;&raquo;</a></span>
		{/if}

		{if $pagination.total_items}
			<span class="pagination-total-items">&nbsp;{$lang.total_items}:&nbsp;</span><span>{$pagination.total_items}&nbsp;/</span>
			
			{capture name="pagination_list"}
				<ul>
					<li class="strong">{$lang.items_per_page}:</li>
					{assign var="range_url" value=$qstring|fn_query_remove:"items_per_page"}
					{foreach from=$pagination.per_page_range item="step"}
						<li><a name="pagination" class="cm-ajax{$history_class}" href="{"`$index_script`?`$range_url`&amp;items_per_page=`$step`"|fn_url}" rev="{$id}">{$step}</a></li>
					{/foreach}
				</ul>
			{/capture}
			{math equation="rand()" assign="rnd"}
			{include file="common_templates/tools.tpl" prefix="pagination_`$rnd`" hide_actions=true tools_list=$smarty.capture.pagination_list display="inline" link_text=$pagination.items_per_page override_meta="pagination-selector" skip_check_permissions="true"}
		{/if}

		</div>
	</div>
{/if}


{if $smarty.capture.pagination_open == "Y"}
	<!--{$id}--></div>
	{capture name="pagination_open"}N{/capture}
{elseif $smarty.capture.pagination_open != "Y"}
	{capture name="pagination_open"}Y{/capture}
{/if}
