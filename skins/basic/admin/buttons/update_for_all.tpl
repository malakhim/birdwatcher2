{if $display}
	{if $hide_element}
		{assign var="title_act" value=$lang.update_for_all_hid_act}
		{assign var="title_dis" value=$lang.update_for_all_hid_dis}
	{else}
		{assign var="title_act" value=$lang.update_for_all_act}
		{assign var="title_dis" value=$lang.update_for_all_dis}
	{/if}
	{if $settings.Stores.default_state_update_for_all == 'active'}
		{assign var="title" value=$title_act}
		{assign var="visible" value="visible"}
	{else}
		{assign var="title" value=$title_dis}
	{/if}
	<a class="cm-update-for-all-icon {$visible}" title="{$title}" title_act="{$title_act}" title_dis="{$title_dis}" rev="{$object_id}" {if $hide_element}hide_element="{$hide_element}"{/if}></a>
	<input type="hidden" class="cm-no-hide-input" id="hidden_update_all_vendors_{$object_id}" name="{$name}" value="Y" {if $settings.Stores.default_state_update_for_all == 'not_active'}disabled="disabled"{/if} />
{else}
&nbsp;
{/if} 
