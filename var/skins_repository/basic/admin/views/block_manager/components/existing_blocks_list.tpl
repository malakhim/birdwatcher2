{foreach name="existing_blocks" from=$unique_blocks item="block"}
	{if $block_types[$block.type]}
		<div class="select-block select-block-{$block.type|replace:"_":"-"} cm-add-block bm-action-existing-block {if $manage == "Y"}bm-manage{/if}">
			<input type="hidden" name="block_id" value="{$block.block_id}" />
			<input type="hidden" name="grid_id" value="{$grid_id|default:"0"}" />
			<input type="hidden" name="type" value="{$block.type}" />
			<a class="select-block-remove cm-remove-block" title="{$lang.delete_block}"></a>
			<div class="select-block-box">
				<div class="select-block-icon"></div>
			</div>
			<div class="select-block-description">
				<strong title="{$block.name}">{$block.name|truncate:25:"&hellip;":true}</strong>
				{assign var="block_description" value="block_`$block.type`_description"}
				<p>{$lang[$block_description]}</p>
			</div>
		</div>
	{/if}
{/foreach}
