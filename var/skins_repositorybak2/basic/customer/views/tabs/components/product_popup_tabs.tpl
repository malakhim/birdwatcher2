{capture name="popupsbox"}
	{foreach from=$tabs item="tab" key="tab_id"}
		{if $tab.show_in_popup == "Y" && $tab.status == "A"}
			{assign var="product_tab_id" value="product_tab_`$tab.tab_id`"}
			{assign var="tab_content_capture" value="tab_content_capture_`$tab_id`"}

			{capture name=$tab_content_capture}
				{if $tab.tab_type == 'B'}
					{block block_id=$tab.block_id dispatch="products.view"}
				{elseif $tab.tab_type == 'T'}
					{include file=$tab.template product_tab_id=$product_tab_id force_ajax=true}
				{/if}
			{/capture}

			{if $smarty.capture.$tab_content_capture|trim}
				
				<li><a id="opener_content_block_popup_{$tab_id}" class="cm-dialog-opener" rev="content_block_popup_{$tab_id}">{$tab.name}</a></li>
				<div id="content_block_popup_{$tab_id}" class="hidden" title="{$tab.name}">
					{$smarty.capture.$tab_content_capture}
				</div>
			{/if}
		{/if}
	{/foreach}
{/capture}

{capture name="popupsbox_content"}
{if $smarty.capture.popupsbox|trim}
<ul class="popup-tabs">
{$smarty.capture.popupsbox}
</ul>
{/if}
{/capture}