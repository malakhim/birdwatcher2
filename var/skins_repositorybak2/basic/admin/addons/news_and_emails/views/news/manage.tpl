{** news section **}

{capture name="mainbox"}

<div id="content_manage_news">
<form action="{""|fn_url}" method="post" name="news_form" class="cm-hide-inputs">
<input type="hidden" name="fake" value="1" />

{include file="common_templates/pagination.tpl" save_current_page=true div_id=$smarty.request.content_id}

<table cellpadding="0" cellspacing="0" border="0" width="100%" class="table hidden-inputs">
<tr>    
	<th>
		<input type="checkbox" name="check_all" value="Y" class="checkbox cm-check-items cm-no-hide-input" /></th>
	<th>{$lang.date}</th>
	<th>{$lang.news}</th>
	<th>{$lang.separate_page}</th>
    
	<th width="100%">{$lang.status}</th>
	<th>&nbsp;</th>
</tr>
{foreach from=$news item=n}
<tr {cycle values="class=\"table-row\", "} valign="top" >    
	{if "COMPANY_ID"|defined && $n.company_id != $smarty.const.COMPANY_ID}
		{assign var="no_hide_input" value=""}
	{else}
		{assign var="no_hide_input" value="cm-no-hide-input"}
	{/if}
	<td class="center {$no_hide_input}">
		<input type="checkbox" name="news_ids[]" value="{$n.news_id}" class="checkbox cm-item" /></td>
	<td class="news-date nowrap {$no_hide_input}">
		{include file="common_templates/calendar.tpl" date_id="news_date_`$n.news_id`" date_name="news[`$n.news_id`][date]" date_val=$n.date start_year=$settings.Company.company_start_year}</td>
	<td width="100%" class="{$no_hide_input}">
		<input type="text" name="news[{$n.news_id}][news]" value="{$n.news}" size="20" class="input-text input-text-100" /></td>
	<td class="center {$no_hide_input}	">
		<input type="hidden" name="news[{$n.news_id}][separate]" value="N" />
		<input type="checkbox" name="news[{$n.news_id}][separate]" value="Y" {if $n.separate == "Y"}checked="checked"{/if} /></td>
   
	<td>
		{include file="common_templates/select_popup.tpl" id=$n.news_id status=$n.status hidden="" object_id_name="news_id" table="news" popup_additional_class=$no_hide_input}
	</td>
	<td class="nowrap">
		{capture name="tools_items"}
		{assign var=hide_delete value=false}		

		{if !$hide_delete}
			<li><a class="cm-confirm" href="{"news.delete?news_id=`$n.news_id`"|fn_url}">{$lang.delete}</a></li>
		{/if}
		{/capture}
		{include file="common_templates/table_tools_list.tpl" prefix=$n.news_id tools_list=$smarty.capture.tools_items href="news.update?news_id=`$n.news_id`"}
	</td>
</tr>
{foreachelse}
<tr class="no-items">
	<td colspan="6"><p>{$lang.no_items}</p></td>
</tr>
{/foreach}
</table>

{include file="common_templates/pagination.tpl" div_id=$smarty.request.content_id}

{if $news}
<div class="buttons-container buttons-bg">
	<div class="float-left">		
		{capture name="tools_list"}
		<ul>
			<li><a name="dispatch[news.delete]" class="cm-process-items cm-confirm" rev="news_form">{$lang.delete_selected}</a></li>
		</ul>
		{/capture}

		{include file="buttons/save.tpl" but_name="dispatch[news.m_update]" but_role="button_main"}
		{include file="common_templates/tools.tpl" prefix="main`$smarty.request.content_id`" hide_actions=true tools_list=$smarty.capture.tools_list display="inline" link_text=$lang.choose_action}
	</div>
</div>
{/if}

</form>
<!--content_manage_news--></div>

{capture name="tools"}
	{include file="common_templates/tools.tpl" tool_href="news.add" prefix="top" link_text=$lang.add_news hide_tools=true}
{/capture}

{/capture}
{include file="common_templates/mainbox.tpl" title=$lang.news content=$smarty.capture.mainbox tools=$smarty.capture.tools select_languages=true}
