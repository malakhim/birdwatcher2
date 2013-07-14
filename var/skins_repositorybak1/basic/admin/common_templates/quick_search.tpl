{hook name="index:global_search"}
	<form id="global_search" method="get" action="{""|fn_url}">
		<input type="hidden" name="dispatch" value="search.results" />
		<input type="hidden" name="compact" value="Y" />
		<div>
			<button type="submit" id="search_button">{$lang.go}</button>
			<label for="gs_text"><a><input type="text" class="cm-tooltip cm-autocomplete-off" id="gs_text" name="q" value="{$smarty.request.q}" title="{$lang.search_tooltip}" /></a></label>
		</div>
	</form>
{/hook}