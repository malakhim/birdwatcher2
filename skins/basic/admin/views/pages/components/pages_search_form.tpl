{capture name="section"}

<form action="{""|fn_url}" name="pages_search_form" method="get" class="{$form_meta}">
<input type="hidden" name="get_tree" value="" />

{if $put_request_vars}
{foreach from=$smarty.request key="k" item="v"}
{if $v}
<input type="hidden" name="{$k}" value="{$v}" />
{/if}
{/foreach}
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
		<label>{$lang.type}:</label>
		<div class="break">
			<select name="page_type">
				<option value="">--</option>
				{foreach from=$page_types key="t" item="p"}
				<option value="{$t}" {if $search.page_type == $t}selected="selected"{/if}>{$lang[$p.name]}</option>
				{/foreach}
			</select>
		</div>
	</td>
	<td class="nowrap search-field">
		<label>{$lang.parent_page}:</label>
		<div class="break clear correct-picker-but">
		{if "pages"|fn_show_picker:$smarty.const.PAGE_THRESHOLD}
			{include file="pickers/pages_picker.tpl" data_id="location_page" input_name="parent_id" item_ids=$search.parent_id hide_link=true hide_delete_button=true show_root=true default_name=$lang.all_pages extra=""}
		{else}
			<select	name="parent_id">
				<option	value="">- {$lang.all_pages} -</option>
				{foreach from=""|fn_get_pages_plain_list item="p"}
					<option	value="{$p.page_id}" {if $search.parent_id == $p.page_id}selected="selected"{/if}>{$p.page|escape|indent:$p.level:"&#166;&nbsp;&nbsp;&nbsp;&nbsp;":"&#166;--&nbsp;"}</option>
				{/foreach}
			</select>
		{/if}
		</div>
	</td>
	<td class="buttons-container">
		{include file="buttons/search.tpl" but_name="dispatch[$dispatch]" but_role="submit"}
	</td>
</tr>
</table>

{capture name="advanced_search"}

<div class="search-field">
	<label>{$lang.search_in}:</label>
	<table cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td class="select-field"><input type="checkbox" value="Y" {if $search.pname == "Y"}checked="checked"{/if} name="pname" id="pname" class="checkbox" /><label for="pname">{$lang.page_name}</label></td>
		<td>&nbsp;&nbsp;&nbsp;</td>

		<td class="select-field"><input type="checkbox" value="Y" {if $search.pdescr == "Y"}checked="checked"{/if} name="pdescr" id="pdescr" class="checkbox" /><label for="pdescr">{$lang.description}</label></td>
		<td>&nbsp;&nbsp;&nbsp;</td>

		<td class="select-field"><input type="checkbox" value="Y" {if $search.subpages == "Y"}checked="checked"{/if} name="subpages" class="checkbox" id="subpages" /><label for="subpages">{$lang.subpages}</label></td>
	</tr>
	</table>
</div>
<hr />

{if $smarty.const.PRODUCT_TYPE == "MULTIVENDOR" || $smarty.const.PRODUCT_TYPE == "ULTIMATE"}
	{math equation="rand()" assign="random_value"}
	{include file="common_templates/select_supplier_vendor.tpl" id="company_id_`$random_value`"}
{/if}

{hook name="pages:search_form"}
{/hook}

<div class="search-field">
	<label>{$lang.status}:</label>
	<select name="status">
		<option value="">--</option>
		<option value="A" {if $search.status == "A"}selected="selected"{/if}>{$lang.active}</option>
		<option value="H" {if $search.status == "H"}selected="selected"{/if}>{$lang.hidden}</option>
		<option value="D" {if $search.status == "D"}selected="selected"{/if}>{$lang.disabled}</option>
	</select>
</div>

{/capture}

{include file="common_templates/advanced_search.tpl" content=$smarty.capture.advanced_search dispatch=$dispatch view_type="pages"}

</form>

{/capture}

<div class="search-form-wrap">
{include file="common_templates/section.tpl" section_content=$smarty.capture.section}
</div>