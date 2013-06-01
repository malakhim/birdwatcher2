<div id="content_tags_tab">
	
	{script src="addons/tags/js/tags_autocomplete.js"}

    <form action="{""|fn_url}" method="post" name="add_tags_form">
		<input type="hidden" name="redirect_url" value="{$config.current_url}" />
		<input type="hidden" name="tags_data[object_type]" value="{$object_type}" />
		<input type="hidden" name="tags_data[object_id]" value="{$object_id}" />
		<input type="hidden" name="selected_section" value="{$product_tab_id}" />
		<div class="form-field">
			<label>{$lang.popular_tags}</label>
			{if $object.tags.popular}
				{foreach from=$object.tags.popular item="tag" name="tags"}
					{assign var="tag_name" value=$tag.tag|escape:url}
					<a href="{"tags.view?tag=`$tag_name`"|fn_url}">{$tag.tag}</a> {if !$smarty.foreach.tags.last},{/if}
				{/foreach}
			{else}
				{$lang.none}
			{/if}
		</div>

		<div class="form-field">
			<label>{$lang.my_tags}</label>
			{if $auth.user_id}
				<input id="elm_my_tags" type="text" class="input-text-large" name="tags_data[values]" value="{foreach from=$object.tags.user item="tag" name="tags"}{$tag.tag}{if !$smarty.foreach.tags.last}, {/if}{/foreach}" />

			{else}
				{assign var="return_current_url" value=$config.current_url|escape:url}
				<a class="text-button" href="{if $controller == "auth" && $mode == "login_form"}{$config.current_url|fn_url}{else}{"auth.login_form?return_url=`$return_current_url`"|fn_url}{/if}">{$lang.sign_in_to_enter_tags}</a>
			{/if}
		</div>
		
		{if $auth.user_id}
			<div class="buttons-container">
				{include file="buttons/button.tpl" but_text=$lang.save_tags but_name="dispatch[tags.update]" but_role="submit"}
			</div>
		{/if}
	</form>
</div>