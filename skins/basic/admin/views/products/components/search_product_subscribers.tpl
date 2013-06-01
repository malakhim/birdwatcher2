{capture name="section"}

<form action="{""|fn_url}" name="subscribers_search_form" method="get">

<table cellspacing="0" border="0" class="search-header">
<tr>
	<td class="nowrap search-field">
		<label>{$lang.email}:</label>
		<div class="break">
			<input type="text" name="email" size="20" value="{$search.email}" class="search-input-text" />
			<input type="hidden" name="product_id" value="{$product_id}" />
			<input type="hidden" name="selected_section" value="subscribers" />
			{include file="buttons/search_go.tpl" search="Y" but_name="$dispatch"}&nbsp;
		</div>
	</td>
	<td class="buttons-container">
		{include file="buttons/search.tpl" but_role="submit"}
	</td>
</tr>
</table>

</form>

{/capture}
{include file="common_templates/section.tpl" section_content=$smarty.capture.section}