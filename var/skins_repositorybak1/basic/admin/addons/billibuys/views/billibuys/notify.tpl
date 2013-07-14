{capture name="mainbox"}

	Please enter the keywords, separated by commas, that you wish to use to search by.
	<br />
	<br />
	<form action="{""|fn_url}" method="post" name="category_tree_form" class="{if ""|fn_check_form_permissions}cm-hide-inputs{/if}">
	<input type="text" name="bb_data[keywords]" size="7" class="input-text-medium" />
	{include file="buttons/button.tpl" but_text=$lang.submit but_name="dispatch[billibuys.notify]" but_role="submit"}
	</form>
{/capture}

{include file="common_templates/mainbox.tpl" title=$lang.billibuys content=$smarty.capture.mainbox title_extra=$smarty.capture.title_extra tools=$smarty.capture.tools}