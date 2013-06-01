{capture name="view_tools"}
	<div class="float-right next-prev">
		{if $prev_id}
			{if $links_label}
			<a href="{"`$url``$prev_id`"|fn_url}">&laquo;&nbsp;{$links_label}&nbsp;{if $show_item_id}#{$prev_id}{/if}</a>&nbsp;&nbsp;&nbsp;
			{else}
			<a class="lowercase" href="{"`$url``$prev_id`"|fn_url}">&laquo;&nbsp;{$lang.previous}</a>&nbsp;&nbsp;&nbsp;
			{/if}
		{/if}

		{if $next_id}
			{if $links_label}
			<a href="{"`$url``$next_id`"|fn_url}">{$links_label}&nbsp;{if $show_item_id}#{$next_id}{/if}&nbsp;&raquo;</a>
			{else}
			<a class="lowercase" href="{"`$url``$next_id`"|fn_url}">{$lang.next}&nbsp;&raquo;</a>
			{/if}
			
		{/if}
	</div>
{/capture}