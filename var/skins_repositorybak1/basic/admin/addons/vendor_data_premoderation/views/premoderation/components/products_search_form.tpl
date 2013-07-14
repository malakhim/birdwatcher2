{capture name="section"}
<form action="{"`$index_script`"|fn_url}" name="pre_moderation_search_form" method="get" class="cm-disable-empty">

{if $smarty.request.redirect_url}
<input type="hidden" name="redirect_url" value="{$smarty.request.redirect_url}" />
{/if}
{if $selected_section != ""}
<input type="hidden" id="selected_section" name="selected_section" value="{$selected_section}" />
{/if}

{$extra}

<table cellspacing="0" border="0" class="search-header">
<tr>
	<td class="nowrap search-field">
		<label>{$lang.find_results_with}:</label>
		<div class="break">
			<input type="text" name="q" size="20" value="{$search.q}" class="search-input-text" />
			{include file="buttons/search_go.tpl" search="Y" but_name="$dispatch"}&nbsp;
			<select name="match">
				<option value="any" {if $search.match == "any"}selected="selected"{/if}>{$lang.any_words}</option>
				<option value="all" {if $search.match == "all"}selected="selected"{/if}>{$lang.all_words}</option>
				<option value="exact" {if $search.match == "exact"}selected="selected"{/if}>{$lang.exact_phrase}</option>
			</select>
		</div>
	</td>
	<td class="nowrap search-field">
		<label>{$lang.search_in_category}:</label>
		<div class="break clear correct-picker-but">
		{if "categories"|fn_show_picker:$smarty.const.CATEGORY_SHOW_ALL}
			{if $search.cid}
				{assign var="s_cid" value=$search.cid}
			{else}
				{assign var="s_cid" value="0"}
			{/if}
			{include file="pickers/categories_picker.tpl" data_id="location_category" input_name="cid" item_ids=$s_cid hide_link=true hide_delete_button=true show_root=true default_name=$lang.all_categories extra=""}
		{else}
			<select	name="cid">
				<option	value="0" {if $category_data.parent_id == "0"}selected="selected"{/if}>- {$lang.all_categories} -</option>
				{foreach from=0|fn_get_plain_categories_tree:false item="search_cat"}
					<option	value="{$search_cat.category_id}" {if $search_cat.disabled}disabled="disabled"{/if} {if $search.cid == $search_cat.category_id}selected="selected"{/if}>{$search_cat.category|indent:$search_cat.level:"&#166;&nbsp;&nbsp;&nbsp;&nbsp;":"&#166;--&nbsp;"}</option>
				{/foreach}
			</select>
		{/if}
		</div>
	</td>
	<td class="nowrap search-field">
		<label>{$lang.vendor}:</label>
		<div class="break">
			<input type="hidden" name="vendor" id="search_hidden_vendor" value="{$search.vendor|default:'all'}" />
			{include file="common_templates/ajax_select_object.tpl" data_url="companies.get_companies_list?show_all=Y" text=$search.vendor|fn_get_company_name result_elm="search_hidden_vendor" id="company_search"}
		</div>
	</td>
	<td class="nowrap search-field">
		<label>{$lang.status}:</label>
		<div class="break">
			<select name="approval_status">
				<option value="all" {if $search.approval_status == "all"}selected="selected"{/if}>{$lang.all}</option>
				<option value="Y" {if $search.approval_status == "Y"}selected="selected"{/if}>{$lang.approved}</option>
				<option value="P" {if $search.approval_status == "P"}selected="selected"{/if}>{$lang.pending}</option>
				<option value="N" {if $search.approval_status == "N"}selected="selected"{/if}>{$lang.disapproved}</option>
			</select>
		</div>
	</td>
	<td class="buttons-container">
		{include file="buttons/search.tpl" but_name="dispatch[$dispatch]" but_role="submit"}
	</td>
</tr>
</table>

</form>

{/capture}
{include file="common_templates/section.tpl" section_content=$smarty.capture.section}