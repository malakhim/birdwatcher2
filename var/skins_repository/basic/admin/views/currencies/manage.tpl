{script src="js/tabs.js"}

{capture name="mainbox"}
{include file="common_templates/sortable_position_scripts.tpl" sortable_table="currencies" sortable_id_name="currency_code"}

{assign var="r_url" value=$config.current_url|escape:url}

<div class="items-container cm-sortable {if !""|fn_allow_save_object:"":true} cm-hide-inputs{/if}" id="manage_currencies_list">
{foreach from=$currencies_data item="currency"}
	{if $currency.is_primary == "Y"}
		{assign var="_href_delete" value=""}
	{else}
		{assign var="_href_delete" value="currencies.delete?currency_code=`$currency.currency_code`"}
	{/if}
	{assign var="currency_details" value="<span>`$currency.currency_code`</span>, `$lang.currency_rate`: <span>`$currency.coefficient`</span>, `$lang.currency_sign`: <span>`$currency.symbol`</span>"}
	{include file="common_templates/object_group.tpl" id=$currency.currency_code text=$currency.description details=$currency_details|unescape href="currencies.update?currency_code=`$currency.currency_code`&amp;return_url=$r_url" href_delete=$_href_delete rev_delete="manage_currencies_list" header_text="`$lang.editing_currency`:&nbsp;`$currency.description`" table="currencies" object_id_name="currency_code" status=$currency.status additional_class="cm-sortable-row cm-sortable-id-`$currency.currency_code`"}
{foreachelse}

	<p class="no-items">{$lang.no_data}</p>

{/foreach}
<!--manage_currencies_list--></div>

<div class="buttons-container">
	{capture name="extra_tools"}
		{hook name="currencies:import_rates"}{/hook}
	{/capture}
</div>

{if ""|fn_allow_save_object:"":true}
	{capture name="tools"}
		{capture name="add_new_picker"}
			{include file="views/currencies/update.tpl" mode="add" currency=""}
		{/capture}
		
		{include file="common_templates/popupbox.tpl" id="add_new_currency" text=$lang.new_currency content=$smarty.capture.add_new_picker link_text=$lang.add_currency act="general"}
	{/capture}
{/if}

{/capture}

{include file="common_templates/mainbox.tpl" title=$lang.currencies content=$smarty.capture.mainbox tools=$smarty.capture.tools title_extra=$smarty.capture.title_extra select_languages=true extra_tools=$smarty.capture.extra_tools|trim}