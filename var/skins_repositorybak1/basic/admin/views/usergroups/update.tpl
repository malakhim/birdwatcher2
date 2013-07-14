{if $usergroup.usergroup_id}
	{assign var="id" value=$usergroup.usergroup_id}
{else}
	{assign var="id" value=0}
{/if}

<div id="content_group{$id}">

<form action="{""|fn_url}" method="post" name="update_usergroups_form_{$id}" class="cm-form-highlight">
<input type="hidden" name="usergroup_id" value="{$id}" />

{capture name="tabsbox"}
	<div id="content_general_{$id}">
		<div class="form-field">
			<label class="cm-required" for="elm_usergroup">{$lang.usergroup}:</label>
			<input type="text" id="elm_usergroup" name="usergroup_data[usergroup]" size="35" value="{$usergroup.usergroup}" class="input-text-large main-input" />
		</div>

		<div class="form-field">
			<label for="elm_usergroup_type">{$lang.type}:</label>
			{if $smarty.const.RESTRICTED_ADMIN == 1}
			<input type="hidden" name="usergroup_data[type]" value="C" />
			{$lang.customer}
			{else}
			<select id="elm_usergroup_type" name="usergroup_data[type]">
				<option value="C"{if $usergroup.type == "C"} selected="selected"{/if}>{$lang.customer}</option>
				<option value="A"{if $usergroup.type == "A"} selected="selected"{/if}>{$lang.administrator}</option>
			</select>
			{/if}
		</div>

		{include file="common_templates/select_status.tpl" input_name="usergroup_data[status]" id="usergroup_data_`$id`" obj=$usergroup hidden=true}
	</div>
	
	{if $usergroup.type == "A"}
		<div id="content_privilege_{$id}">
			<input type="hidden" name="usergroup_data[privileges]" value="" />
			<table cellpadding="0" cellspacing="0" border="0" width="100%" class="table table-group">
			<tr>
				<th width="1%" class="table-group-checkbox">
					<input type="checkbox" name="check_all" value="Y" title="{$lang.check_uncheck_all}" class="checkbox cm-check-items" /></th>
				<th width="100%" colspan="5">{$lang.privilege}</th>
			</tr>

			{foreach from=$privileges item=privilege}
			<tr class="table-group-header">
				<td colspan="6">{$privilege.0.section}</td>
			</tr>

			{split data=$privilege size=3 assign="splitted_privilege"}
			{math equation="floor(100/x)" x=3 assign="cell_width"}
			{foreach from=$splitted_privilege item=sprivilege}
			<tr class="object-group-elements">
				{foreach from=$sprivilege item="p"}
					{assign var="pr_id" value=$p.privilege}
					{if $p.description}
						<td width="1%" class="table-group-checkbox">
							<input type="checkbox" name="usergroup_data[privileges][{$pr_id}]" value="Y" {if $usergroup_privileges.$pr_id}checked="checked"{/if} class="checkbox cm-item" id="set_privileges_{$pr_id}" /></td>
						<td width="{$cell_width}%"><label for="set_privileges_{$pr_id}">{$p.description}</label></td>
					{else}
						<td colspan="2">&nbsp;</td>
					{/if}
				{/foreach}
			</tr>
			{/foreach}
			{/foreach}
			</table>
		</div>
	{/if}
	{hook name="usergroups:tabs_content"}{/hook}
{/capture}
{include file="common_templates/tabsbox.tpl" content=$smarty.capture.tabsbox}

<div class="buttons-container">
	{include file="buttons/save_cancel.tpl" but_name="dispatch[usergroups.update]" cancel_action="close"}
</div>


</form>

<!--content_group{$id}--></div>