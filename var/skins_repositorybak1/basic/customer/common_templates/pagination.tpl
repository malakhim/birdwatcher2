{assign var="id" value=$id|default:"pagination_contents"}
{if $smarty.capture.pagination_open != "Y"}
	{if ($settings.DHTML.customer_ajax_based_pagination == "Y" || $force_ajax ) && $pagination.total_pages > 1 }
		{script src="lib/js/history/jquery.history.js"}
	{/if}
	<div class="pagination-container" id="{$id}">

	{if $save_current_page}
	<input type="hidden" name="page" value="{$search.page|default:$smarty.request.page}" />
	{/if}

	{if $save_current_url}
	<input type="hidden" name="redirect_url" value="{$config.current_url}" />
	{/if}
{/if}

{if $pagination.total_pages > 1}
	{if $settings.Appearance.top_pagination == "Y" && $smarty.capture.pagination_open != "Y" || $smarty.capture.pagination_open == "Y"}
	{assign var="current_url" value=$config.current_url|fn_query_remove:"page":"result_ids"|escape}

	{if $settings.DHTML.customer_ajax_based_pagination == "Y" || $force_ajax}
		{assign var="ajax_class" value="cm-ajax cm-ajax-force"}
	{else}
		{assign var="current_url" value=$current_url|fn_query_remove:"is_ajax"}
	{/if}

	{if $smarty.capture.pagination_open == "Y"}
	<div class="pagination-bottom">
	{/if}
	<div class="pagination cm-pagination-wraper">
		{if $pagination.prev_range}
			<a name="pagination" href="{"`$current_url`&amp;page=`$pagination.prev_range``$extra_url`"|fn_url}{$extra_url}" rel="{$pagination.prev_range}" class="cm-history prev {$ajax_class}" rev="{$id}">{$pagination.prev_range_from} - {$pagination.prev_range_to}</a>
		{/if}
		<a name="pagination" class="prev {if $pagination.prev_page}cm-history {$ajax_class}{/if}" {if $pagination.prev_page}href="{"`$current_url`&amp;page=`$pagination.prev_page`"|fn_url}" rel="{$pagination.prev_page}" rev="{$id}"{/if}><i class="text-arrow">&larr;</i>&nbsp;{$lang.prev_page}</a>

		{foreach from=$pagination.navi_pages item="pg"}
			{if $pg != $pagination.current_page}
				<a name="pagination" href="{"`$current_url`&amp;page=`$pg``$extra_url`"|fn_url}" rel="{$pg}" class="cm-history {$ajax_class}" rev="{$id}">{$pg}</a>
			{else}
				<span class="pagination-selected-page">{$pg}</span>
			{/if}
		{/foreach}
		<span class="lowercase"><a name="pagination" class="next {if $pagination.next_page}cm-history {$ajax_class}{/if}" {if $pagination.next_page}href="{"`$current_url`&amp;page=`$pagination.next_page``$extra_url`"|fn_url}" rel="{$pagination.next_page}" rev="{$id}"{/if}>{$lang.next}&nbsp;<i class="text-arrow">&rarr;</i></a></span>

		{if $pagination.next_range}
			<a name="pagination" href="{"`$current_url`&amp;page=`$pagination.next_range``$extra_url`"|fn_url}" rel="{$pagination.next_range}" class="cm-history next {$ajax_class}" rev="{$id}">{$pagination.next_range_from} - {$pagination.next_range_to}</a>
		{/if}
	</div>
	{if $smarty.capture.pagination_open == "Y"}
	</div>
	{/if}
	{else}
	<div class="cm-pagination-wraper"><a name="pagination" href="" rel="{$pg}" rev="{$id}" class="hidden"></a></div>
	{/if}
{/if}

{if $smarty.capture.pagination_open == "Y"}
	<!--{$id}--></div>
	{capture name="pagination_open"}N{/capture}
{elseif $smarty.capture.pagination_open != "Y"}
	{capture name="pagination_open"}Y{/capture}
{/if}