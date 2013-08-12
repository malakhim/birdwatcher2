<div class="form-field {if !$non_editable}cm-no-hide-input{/if}">
	<label for="discussion_type">{$title}:</label>
	{assign var="discussion" value=$object_id|fn_get_discussion:$object_type}
	<select name="{$prefix}[discussion_type]" id="discussion_type">
		<option {if $discussion.type == "B"}selected="selected"{/if} value="B">{$lang.communication} {$lang.and} {$lang.rating}</option>
		<option {if $discussion.type == "C"}selected="selected"{/if} value="C">{$lang.communication}</option>
		<option {if $discussion.type == "R"}selected="selected"{/if} value="R">{$lang.rating}</option>
		<option {if $discussion.type == "D" || !$discussion}selected="selected"{/if} value="D">{$lang.disabled}</option>
	</select>
</div>