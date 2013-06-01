{foreach name="new_blocks" from=$block_types key="type" item="block"}
	<div class="select-block select-block-{$block.type|replace:"_":"-"} cm-add-block bm-action-new-block {if $manage == "Y"}bm-manage{/if}">
		<input type="hidden" name="block_data[type]" value="{$type}" />
		<input type="hidden" name="block_data[grid_id]" value="{$grid_id}" />
		
		<div class="select-block-box">
			<div class="select-block-icon"></div>
		</div>
                
		<div class="select-block-description">
			<strong title="{$block.name}">{$block.name|truncate:25:"&hellip;":true}</strong>
			{assign var="block_description" value="block_`$block.type`_description"}
			<p>{$lang[$block_description]}</p>
		</div>
	</div>
{/foreach}