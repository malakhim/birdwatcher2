<div id="content_tags">

{script src="addons/tags/js/tags_autocomplete.js"}

<fieldset>
	<div class="form-field">
		<label>{$lang.popular_tags}:</label>
		{if $object.tags.popular}
			{foreach from=$object.tags.popular item="tag" name="tags"}
				{$tag.tag}({$tag.popularity}) {if !$smarty.foreach.tags.last},{/if}
			{/foreach}
		{else}
			{$lang.none}
		{/if}
	</div>

	<div class="form-field cm-no-hide-input">
		<label>{$lang.my_tags}:</label>
		<input id="elm_my_tags" type="text" class="input-text-large " name="{$input_name}[tags]" value="{foreach from=$object.tags.user item="tag" name="tags"}{$tag.tag}{if !$smarty.foreach.tags.last}, {/if}{/foreach}" />
	</div>
</fieldset>

</div>