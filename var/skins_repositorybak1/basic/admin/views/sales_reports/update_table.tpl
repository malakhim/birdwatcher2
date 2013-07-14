{if $smarty.request.table_id}
	{assign var="table_id" value=$smarty.request.table_id}
{else}
	{assign var="table_id" value=0}
{/if}

{assign var="report_id" value=$smarty.request.report_id}

{capture name="mainbox"}

<form action="{""|fn_url}" method="post" name="statistics_table" class="cm-form-highlight">
<input type="hidden" name="report_id" value="{$report_id}" />
<input type="hidden" name="table_id" value="{$table_id}" />
<input type="hidden" name="table_data[report_id]" value="{$report_id}" />
<input type="hidden" name="selected_section" value="" />

{notes}
{$lang.check_items_text}
{/notes}

{if $table_id}
	{assign var="select_languages" value="true"}
	{capture name="extra_tools"}
		{include file="buttons/button.tpl" but_text=$lang.view_report but_href="sales_reports.view?report_id=$report_id&table_id=`$table_id`" but_role="tool"}&nbsp;|&nbsp;
		{include file="buttons/button.tpl" but_text=$lang.clear_conditions but_href="sales_reports.clear_conditions?table_id=`$table_id`&report_id=`$report_id`" but_role="tool"}
	{/capture}
{/if}

{capture name="tabsbox"}

<div id="content_general">

<fieldset>
<div class="form-field">
	<label for="elm_table_description" class="cm-required">{$lang.name}:</label>
	<input type="text" name="table_data[description]" id="elm_table_description" value="{$table.description}" size="70" class="input-text-large main-input" />
</div>

<div class="form-field">
	<label for="elm_table_position">{$lang.position}:</label>
	<input type="text" name="table_data[position]" id="elm_table_position" value="{$table.position}" size="3" class="input-text-short" />
</div>

<div class="form-field">
	<label for="elm_table_type">{$lang.type}:</label>
	<select	name="table_data[type]" id="elm_table_type">
		<option	value="T">{$lang.table}</option>
		<option	value="B" {if $table.type == "B"}selected="selected"{/if}>{$lang.graphic} [{$lang.bar}] </option>
		<option	value="P" {if $table.type == "P"}selected="selected"{/if}>{$lang.graphic} [{$lang.pie_3d}] </option>
		<option	value="C" {if $table.type == "C"}selected="selected"{/if}>{$lang.graphic} [{$lang.pie}] </option>
	</select>
</div>

<div class="form-field">
	<label for="elm_update_element_element_id">{$lang.parameter}:</label>
	{if $table_id}
	{foreach from=$table.elements item=element}
		<select name="table_data[elements][{$element.element_hash}][element_id]" id="elm_update_element_element_id">
		{foreach from=$report_elements.parameters item=parameter}
		{assign var="element_id" value=$parameter.element_id}
		{assign var="parameter_name" value="reports_parameter_$element_id"}
		<option	value="{$parameter.element_id}" {if $element.element_id==$parameter.element_id}selected="selected"{/if}>{$lang.$parameter_name}</option>
		{/foreach}
		</select>
	{/foreach}
	{else}
	<select name="table_data[elements][element_id]" id="elm_update_element_element_id">
		{foreach from=$report_elements.parameters item=parameter}
		{assign var="element_id" value=$parameter.element_id}
		{assign var="parameter_name" value="reports_parameter_$element_id"}
		<option	value="{$parameter.element_id}" {if $element.element_id==$parameter.element_id}selected="selected"{/if}>{$lang.$parameter_name}</option>
		{/foreach}
	</select>
	{/if}
</div>

<div class="form-field">
	<label for="elm_table_display">{$lang.value_to_display}:</label>
	<select	name="table_data[display]" id="elm_table_display">
		{foreach from=$report_elements.values item=element}
		{assign var="element_id" value=$element.element_id}
		{assign var="element_name" value="reports_parameter_$element_id"}
		<option	value="{$element.code}" {if $table.display == $element.code}selected="selected"{/if}>{$lang.$element_name}</option>
		{/foreach}
	</select>
</div>

{if $table.type != "C" && $table.type != "P"}
<div class="form-field">
	<label for="elm_table_interval_id">{$lang.time_interval}:</label>
	<select name="table_data[interval_id]" id="elm_table_interval_id">
		{foreach from=$intervals item=interval}
		{assign var="interval_id" value=$interval.interval_id}
		{assign var="interval_name" value="reports_interval_$interval_id"}
		<option	value="{$interval.interval_id}" {if $table.interval_id==$interval.interval_id}selected="selected"{/if}>{$lang.$interval_name}</option>
		{/foreach}
	</select>
</div>
{/if}

{foreach from=$table.elements item=element}
<div class="form-field">
	<label for="elm_limit_auto">{$lang.limit}:</label>
	<input type="text" name="table_data[elements]{if $table_id}[{$element.element_hash}]{/if}[limit_auto]" value="{if $table_id}{$element.limit_auto}{else}5{/if}" size="3" class="input-text" id="elm_limit_auto" />
</div>

<div class="form-field">
	<label for="elm_dependence">{$lang.dependence}:</label>
	<select name="table_data[elements]{if $table_id}[{$element.element_hash}]{/if}[dependence]" id="elm_dependence">
		<option	value="max_n" {if $element.dependence == "max_n"}selected="selected"{/if}>{$lang.max_item}</option>
		<option	value="max_p" {if $element.dependence == "max_p"}selected="selected"{/if}>{$lang.max_amount}</option>
	</select>
</div>
{/foreach}
</fieldset>
<!--id="content_general"--></div>

{************************************************** P A Y M E N T ****************************************}
<div id="content_payment" class="hidden">

	<input name="table_data[conditions][payment]" value="" type="hidden" />
	<table cellpadding="0" cellspacing="0" border="0" width="100%" class="table">
	<tr>
		<th width="1%">
		<input type="checkbox" name="check_all" value="Y" title="{$lang.check_uncheck_all}" class="checkbox cm-check-items-payment" /></th>
		<th width="100%">{$lang.payment}</th>
		<th width="1%">{$lang.processor}</th>
		
		<th width="1%">{$lang.usergroup}</th>
		
	</tr>
	{foreach from=$payments item=payment name="pf"}
	<tr {cycle values="class=\"table-row\", "}>
		<td>
			<input type="checkbox" name="table_data[conditions][payment][]" value="{$payment.payment_id}" {if $conditions.payment[$payment.payment_id]}checked="checked"{/if} class="checkbox cm-item-payment" /></td>
		<td>
			{$payment.payment}</td>
		<td nowrap class="center">
				{foreach from=$payment_processors item="processor"}
					{if $payment.processor_id == $processor.processor_id}{$processor.processor}{/if}
				{/foreach}
		</td>
		
		<td class="center">
			{if $payment.usergroup}{$payment.usergroup}{else}-{$lang.all}-{/if}
		</td>
		
	</tr>
	{foreachelse}
	<tr class="no-items">
		<td colspan="4"><p>{$lang.no_items}</p></td>
	</tr>
	{/foreach}
	</table>
<!--id="content_payment"--></div>

{************************************************** L O C A T I O N ****************************************}
<div id="content_location" class="hidden">
	
	<input name="table_data[conditions][location]" value="" type="hidden" />
	<table cellpadding="0" cellspacing="0" border="0" class="table">
	<tr>
		<th width="1%">
			<input type="checkbox" name="check_all" value="Y" title="{$lang.check_uncheck_all}" class="checkbox cm-check-items-location" /></th>
		<th>{$lang.name}</th>
	</tr>
	{foreach from=$destinations item=destination}
	<tr {cycle values="class=\"table-row\", "}>
		<td class="center">
			<input name="table_data[conditions][location][]" value="{$destination.destination_id}" type="checkbox" {if $conditions.location[$destination.destination_id]}checked="checked"{/if} class="checkbox cm-item-location" /></td>
		<td>
			{$destination.destination}</td>
	</tr>
	{foreachelse}
	<tr class="no-items">
		<td colspan="2"><p>{$lang.no_items}</p></td>
	</tr>
	{/foreach}
	</table>
<!--id="content_location"--></div>

{************************************************** S T A T U S ****************************************}
<div id="content_status" class="hidden">
	<input name="table_data[conditions][status]" value="" type="hidden" />
	<table cellpadding="0" cellspacing="0" border="0" class="table">
	<tr>
		<th width="1%">
			<input type="checkbox" name="check_all" value="Y" title="{$lang.check_uncheck_all}" class="checkbox cm-check-items-status" /></th>
		<th>{$lang.status}</th>
	</tr>
	{foreach from=$order_status_descr key=id item=status}
	<tr {cycle values="class=\"table-row\", "}>
		<td class="center">
			<input name="table_data[conditions][status][]" value="{$id}" type="checkbox" {if $conditions.status.$id}checked="checked"{/if} class="checkbox cm-item-status" /></td>
		<td>
			{$status}</td>
	</tr>
	{foreachelse}
	<tr class="no-items">
		<td><p>{$lang.no_items}</p></td>
	</tr>
	{/foreach}
	</table>
<!--id="content_status"--></div>

{************************************************** C A T E G O R Y ****************************************}
<div id="content_category" class="hidden">
	{include file="pickers/categories_picker.tpl" input_name="table_data[conditions][category]" data_id="categories_list" item_ids=$conditions.category no_item_text=$lang.no_items category_id=$c_ids multiple=true}
</div>


{************************************************** O R D E R ****************************************}
<div id="content_order" class="hidden">
	{include file="pickers/orders_picker.tpl" item_ids=$conditions.order no_item_text=$lang.no_items data_id="order_items" input_name="table_data[conditions][order]"}
</div>


{************************************************** P R O D U C T ****************************************}
<div id="content_product" class="hidden">
	{include file="pickers/products_picker.tpl" input_name="table_data[conditions][product]" data_id="added_products" item_ids=$conditions.product type="links"}
</div>


{************************************************** U S E R ****************************************}
<div id="content_user" class="hidden">
	{include file="views/profiles/components/profiles_scripts.tpl"}
	{include file="pickers/users_picker.tpl" no_item_text=$lang.no_items data_id="sales_rep_users" input_name="table_data[conditions][user]" item_ids=$conditions.user}
</div>

{/capture}
{include file="common_templates/tabsbox.tpl" content=$smarty.capture.tabsbox active_tab=$smarty.request.selected_section track=true}


<div class="buttons-container buttons-bg">
	{include file="buttons/save_cancel.tpl" but_name="dispatch[sales_reports.update_table]" hide_second_button=true}
</div>

</form>
{/capture}

{if $table_id}
	{assign var="_title" value="`$lang.editing_chart`: `$table.description`"}
{else}
	{assign var="_title" value=$lang.new_chart}
{/if}
{include file="common_templates/mainbox.tpl" title=$_title content=$smarty.capture.mainbox extra_tools=$smarty.capture.extra_tools select_languages=true}