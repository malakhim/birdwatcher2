{if $discussion && !$discussion.is_empty}

<div class="cm-hide-save-button" id="content_discussion">
	
{assign var="posts" value=$discussion.thread_id|fn_get_discussion_posts:$smarty.request.page}

<form action="{""|fn_url}" method="POST" class="cm-form-highlight {if $discussion.object_type == "M" && "COMPANY_ID"|defined}cm-hide-inputs{/if}" name="update_posts_form">
<input type="hidden" name="redirect_url" value="{$config.current_url}&amp;selected_section=discussion" />
<input type="hidden" name="selected_section" value="" />

{if $posts}

{include file="common_templates/pagination.tpl" save_current_page=true id="pagination_discussion"}
<div class="posts-container">

{foreach from=$posts item="post"}
<div class="{cycle values="manage-row, "} posts {if $discussion.object_type == "O"}{if $post.user_id == $user_id}incoming{else}outgoing{/if}{/if}">
{hook name="discussion:items_list_row"}
	<div class="clear">
		<div class="valign float-left">
			<input type="text" name="posts[{$post.post_id}][name]" value="{$post.name|escape}" size="40" class="input-text valign strong" /><span class="valign">&nbsp;|&nbsp;{$lang.ip_address}:&nbsp;{$post.ip_address}</span>
		</div>
		{if $discussion.type == "R" || $discussion.type == "B"}
		<div class="float-right">

			<strong class="valign">{$lang.rating}:</strong>
			<select class="valign" name="posts[{$post.post_id}][rating_value]">
				<option value="5" {if $post.rating_value == "5"}selected="selected"{/if}>{$lang.excellent}</option>
				<option value="4" {if $post.rating_value == "4"}selected="selected"{/if}>{$lang.very_good}</option>
				<option value="3" {if $post.rating_value == "3"}selected="selected"{/if}>{$lang.average}</option>
				<option value="2" {if $post.rating_value == "2"}selected="selected"{/if}>{$lang.fair}</option>
				<option value="1" {if $post.rating_value == "1"}selected="selected"{/if}>{$lang.poor}</option>
			</select>

		</div>
		{/if}
	</div>

	{hook name="discussion:update_post"}
	{if $discussion.type == "C" || $discussion.type == "B"}
		<textarea name="posts[{$post.post_id}][message]" class="input-textarea-long" cols="80" rows="5">{$post.message|escape}</textarea>
	{/if}
	{/hook}

<p>
	<span class="strong italic">{$post.timestamp|date_format:"`$settings.Appearance.date_format`, `$settings.Appearance.time_format`"}</span>
	&nbsp;-&nbsp;
	{strip}	
	[&nbsp;&nbsp<span class="select-field"><input type="checkbox" name="delete_posts[{$post.post_id}]" id="delete_checkbox_{$post.post_id}"  class="checkbox cm-item" value="Y" /><label for="delete_checkbox_{$post.post_id}">{$lang.delete}</label></span>
	{if $discussion.object_type != "O"}
	|&nbsp;&nbsp;
	<span class="select-field">
		<input type="hidden" name="posts[{$post.post_id}][status]" value="{$post.status}" />
		<input type="checkbox" class="checkbox" name="posts[{$post.post_id}][status]" id="dis_approve_post_{$post.post_id}" value="{if $post.status == "A"}D{else}A{/if}" />
		<label for="dis_approve_post_{$post.post_id}">{if $post.status == "A"}{$lang.disapprove}{else}{$lang.approve}{/if}</label>
	</span>{/if}]{if $discussion.object_type != "O"}&nbsp;-&nbsp;{if $post.status == "A"}<span class="approved-text">{$lang.approved}{else}<span class="not-approved-text">{$lang.not_approved}{/if}</span>{/if}
	{/strip}
</p>
{/hook}
</div>
{/foreach}
</div>
{include file="common_templates/pagination.tpl" id="pagination_discussion"}

{else}
	<p class="no-items">{$lang.no_data}</p>
{/if}

<div class="buttons-container buttons-bg">
{if $discussion.object_type == "M" && "COMPANY_ID"|defined}
	<a href={"companies.manage"|fn_url} class="underlined tool-link">Cancel</a>
{else}
{if $posts}
	<div class="float-left cm-no-hide-inputs">
		{capture name="tools_list"}
		<ul>
			<li><a name="dispatch[discussion.delete]" class="cm-process-items cm-confirm" rev="update_posts_form">{$lang.delete_selected}</a></li>
		</ul>
		{/capture}
		{include file="buttons/save.tpl" but_name="dispatch[discussion.update]" but_role="button_main"}
		{include file="common_templates/tools.tpl" prefix="main" hide_actions=true tools_list=$smarty.capture.tools_list display="inline" link_text=$lang.choose_action}
	</div>
{/if}
	{if "discussion_manager"|fn_check_view_permissions}
		<div class="float-right cm-no-hide-inputs">
			{include file="common_templates/popupbox.tpl" id="add_new_post" link_text=$lang.add_post act="general"}
		</div>
	{/if}	
{/if}
</div>


</form>

{if "discussion_manager"|fn_check_view_permissions}
	{capture name="add_new_picker"}
	<form action="{""|fn_url}" method="POST" name="add_post_form" class="cm-form-highlight">

	<div class="tabs cm-j-tabs">
		<ul>
			<li id="tab_add_post" class="cm-js cm-active"><a>{$lang.general}</a></li>
		</ul>
	</div>

	<div class="cm-tabs-content" id="content_tab_add_post">
	<input type ="hidden" name="post_data[thread_id]" value="{$discussion.thread_id}" />
	<input type ="hidden" name="redirect_url" value="{$config.current_url}&amp;selected_section=discussion" />

	<div class="form-field">
		<label for="post_data_name" class="cm-required">{$lang.name}:</label>
		<input type="text" name="post_data[name]" id="post_data_name" value="{if $auth.user_id}{$user_info.firstname} {$user_info.lastname}{/if}" size="40" class="input-text-large main-input" />
	</div>

	{if $discussion.type == "R" || $discussion.type == "B"}
	<div class="form-field">
		<label for="rating_value">{$lang.your_rating}:</label>
		<select name="post_data[rating_value]" id="rating_value">
			<option value="5" selected="selected">{$lang.excellent}</option>
			<option value="4">{$lang.very_good}</option>
			<option value="3">{$lang.average}</option>
			<option value="2">{$lang.fair}</option>
			<option value="1">{$lang.poor}</option>
		</select>
	</div>
	{/if}

	{hook name="discussion:add_post"}
	{if $discussion.type == "C" || $discussion.type == "B"}
	<div class="form-field">
		<label for="message">{$lang.your_message}:</label>
		<textarea name="post_data[message]" id="message" class="input-textarea-long" cols="70" rows="8"></textarea>
	</div>
	{/if}
	{/hook}
	</div>

	<div class="buttons-container">
		{include file="buttons/save_cancel.tpl" but_text=$lang.add but_name="dispatch[discussion.add]" cancel_action="close" hide_first_button=false}
	</div>
	</form>
	{/capture}
	{include file="common_templates/popupbox.tpl" id="add_new_post" text=$lang.new_post content=$smarty.capture.add_new_picker act="fake"}
{/if}

</div>

{elseif $discussion.is_empty}

{eval var=$lang.text_enabled_testimonials_notice|unescape}

{/if}