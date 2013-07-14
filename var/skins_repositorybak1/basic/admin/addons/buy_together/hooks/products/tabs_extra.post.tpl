
	{assign var="hide_controls" value=false}



{if !"COMPANY_ID"|defined}
	{assign var="hide_controls" value=true}
{/if}


<div id="content_buy_together" class="cm-hide-save-button hidden {if $hide_controls}cm-hide-inputs{/if}">
	<div class="items-container" id="update_chains_list">
		{if $chains}
			{foreach from=$chains item=chain}
				{include file="common_templates/object_group.tpl" id=$chain.chain_id id_prefix="_bt_" text=$chain.name status=$chain.status hidden=false href="buy_together.update?chain_id=`$chain.chain_id`" object_id_name="chain_id" table="buy_together" href_delete="buy_together.delete?chain_id=`$chain.chain_id`" rev_delete="update_chains_list" header_text="`$lang.editing_combination`:&nbsp;`$chain.name`" skip_delete=$hide_controls}
			{/foreach}
		{else}
			<p class="no-items">{$lang.no_data}</p>
		{/if}
	<!--update_chains_list--></div>

	
	<div class="buttons-container">
			{capture name="add_new_picker"}
				<div id="add_new_chain">
						{include file="addons/buy_together/views/buy_together/update.tpl" product_id=`$product_data.product_id` item=""}
				</div>
			{/capture}
			{include file="common_templates/popupbox.tpl" id="add_new_chain" text=$lang.new_combination content=$smarty.capture.add_new_picker link_text=$lang.add_combination act="general"}
	</div>

<!--content_buy_together--></div>