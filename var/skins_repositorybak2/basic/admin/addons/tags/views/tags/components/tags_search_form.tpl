{capture name="section"}

<form action="{""|fn_url}" name="tags_search_form" method="get">

<table cellspacing="0" border="0" class="search-header">
<tr>
	<td class="nowrap search-field">
		<label for="elm_tag">{$lang.tag}:</label>
		<div class="break">
			<input type="text" id="elm_tag" name="tag" size="20" value="{$search.tag}" onfocus="this.select();" class="input-text" />
		</div>
	</td>
	<td class="nowrap search-field">
		<label for="tag_status_identifier">{$lang.show}:</label>
		<div class="break">
			<select name="status" id="tag_status_identifier">
				<option value="">{$lang.all}</option>
				<option value="A"{if $search.status == "A"} selected="selected"{/if}>{$lang.approved}</option>
				<option value="D"{if $search.status == "D"} selected="selected"{/if}>{$lang.disapproved}</option>
				<option value="P"{if $search.status == "P"} selected="selected"{/if}>{$lang.pending}</option>
			</select>
		</div>
	</td>
	<td class="buttons-container">
		{include file="buttons/search.tpl" but_name="dispatch[tags.manage]" but_role="submit"}
	</td>
</tr>
</table>

{capture name="advanced_search"}

<div class="search-field">
	<label>{$lang.period}:</label>
	{include file="common_templates/period_selector.tpl" period=$search.period form_name="tags_search_form"}
</div>

{hook name="tags:search_form"}
{/hook}

{/capture}

{include file="common_templates/advanced_search.tpl" content=$smarty.capture.advanced_search dispatch=$dispatch view_type="tags"}

</form>

{/capture}
{include file="common_templates/section.tpl" section_content=$smarty.capture.section}