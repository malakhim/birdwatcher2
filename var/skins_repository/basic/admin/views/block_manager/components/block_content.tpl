{strip}
	{if $block_scheme.content}
		{foreach from=$block_scheme.content item=setting_data key=name}
			{if $setting_data.type != 'function'}
				{include file="views/block_manager/components/setting_element.tpl" option=$setting_data name=`$name` block=$block html_id="block_`$block.block_id`_content_`$name`" html_name="block_data[content][`$name`]" editable=$editable value=$block.content.$name}
			{/if}
		{/foreach}
	{/if}
{/strip}