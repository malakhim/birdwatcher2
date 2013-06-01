{capture name="mainbox"}

{capture name="tabsbox"}
{** /Item menu section **}

{assign var="categories_company_id" value=$product_data.company_id}



{if $product_data.product_id}
	{assign var="id" value=$product_data.product_id}
{else}
	{assign var="id" value=0}
{/if}

<form action="{""|fn_url}" method="post" name="product_update_form" class="cm-form-highlight cm-disable-empty-files {if ""|fn_check_form_permissions || ("COMPANY_ID"|defined && $product_data.shared_product == "Y" && $product_data.company_id != $smarty.const.COMPANY_ID)} cm-hide-inputs{/if}" enctype="multipart/form-data"> {* product update form *}
<input type="hidden" name="fake" value="1" />
<input type="hidden" class="{$no_hide_input_if_shared_product}" name="selected_section" id="selected_section" value="{$smarty.request.selected_section}" />
<input type="hidden" class="{$no_hide_input_if_shared_product}" name="product_id" value="{$id}" />

{** Product description section **}

<div class="product-manage" id="content_detailed"> {* content detailed *}

{** General info section **}
<fieldset>

{include file="common_templates/subheader.tpl" title=$lang.information}

<div class="form-field {$no_hide_input_if_shared_product}">
	<label for="product_description_product" class="cm-required">{$lang.name}:</label>
	<span class="input-helper"><input type="text" name="product_data[product]" id="product_description_product" size="55" value="{$product_data.product}" class="input-text-large main-input" /></span>
	{include file="buttons/update_for_all.tpl" display=$show_update_for_all object_id='product' name="update_all_vendors[product]"}
</div>

{hook name="companies:product_details_fields"}
	
	{if $mode != "add"}
		{assign var="reload_form" value=true}
	{/if}
	

	{include file="views/companies/components/company_field.tpl" title=$lang.vendor name="product_data[company_id]" id="product_data_company_id" selected=$product_data.company_id tooltip=$companies_tooltip reload_form=$reload_form}
	<input type="hidden" value="product_categories" name="result_ids">
{/hook}

<div class="form-field {$no_hide_input_if_shared_product}" id="product_categories">
	{math equation="rand()" assign="rnd"}
	{if $smarty.request.category_id}
		{assign var="request_category_id" value=","|explode:$smarty.request.category_id}
	{else}
		{assign var="request_category_id" value=""}
	{/if}
	<label for="ccategories_{$rnd}_ids" class="cm-required{if $product_data.shared_product == "Y"} cm-no-tooltip{/if}">{$lang.categories}:</label>

	<div class="select-field categories">{include file="pickers/categories_picker.tpl" hide_input=$product_data.shared_product company_ids=$categories_company_id rnd=$rnd data_id="categories" input_name="product_data[categories]" radio_input_name="product_data[main_category]" main_category=$product_data.main_category item_ids=$product_data.category_ids|default:$request_category_id hide_link=true hide_delete_button=true display_input_id="category_ids" disable_no_item_text=true view_mode="list"}</div>
<!--product_categories--></div>

<div class="form-field {$no_hide_input_if_shared_product}">
	<label for="price_price" class="cm-required">{$lang.price} ({$currencies.$primary_currency.symbol}):</label>
	<input type="text" name="product_data[price]" id="price_price" size="10" value="{$product_data.price|default:"0.00"|fn_format_price:$primary_currency:null:false}" class="input-text-medium" />
	{include file="buttons/update_for_all.tpl" display=$show_update_for_all object_id='price' name="update_all_vendors[price]"}
</div>

<div class="form-field cm-no-hide-input">
	<label for="product_full_descr">{$lang.full_description}:</label>
	<textarea id="product_full_descr" name="product_data[full_description]" cols="55" rows="8" class="cm-wysiwyg input-textarea-long">{$product_data.full_description}</textarea>
	{include file="buttons/update_for_all.tpl" display=$show_update_for_all object_id='full_description' name="update_all_vendors[full_description]"}
</div>
{** /General info section **}

{include file="common_templates/select_status.tpl" input_name="product_data[status]" id="product_data" obj=$product_data hidden=true}

<div class="form-field">
	<label>{$lang.images}:</label>
	{include file="common_templates/attach_images.tpl" image_name="product_main" image_object_type="product" image_pair=$product_data.main_pair icon_text=$lang.text_product_thumbnail detailed_text=$lang.text_product_detailed_image no_thumbnail=true}
</div>
</fieldset>


<fieldset>

{include file="common_templates/subheader.tpl" title=$lang.options_settings}

<div class="form-field">
	<label for="product_options_type">{$lang.options_type}:</label>
	<select name="product_data[options_type]" id="options_type">
		<option value="P" {if $product_data.options_type == "P"}selected="selected"{/if}>{$lang.simultaneous}</option>
		<option value="S" {if $product_data.options_type == "S"}selected="selected"{/if}>{$lang.sequential}</option>
	</select>
</div>
<div class="form-field">
	<label for="product_exceptions_type">{$lang.exceptions_type}:</label>
	<select name="product_data[exceptions_type]" id="exceptions_type">
		<option value="F" {if $product_data.exceptions_type == "F"}selected="selected"{/if}>{$lang.forbidden}</option>
		<option value="A" {if $product_data.exceptions_type == "A"}selected="selected"{/if}>{$lang.allowed}</option>
	</select>
</div>
</fieldset>


<fieldset>

{include file="common_templates/subheader.tpl" title=$lang.pricing_inventory}

<div class="form-field">
	<label for="product_product_code">{$lang.product_code}:</label>
	<input type="text" name="product_data[product_code]" id="product_product_code" size="20" maxlength="32"  value="{$product_data.product_code}" class="input-text-medium" />
</div>

<div class="form-field">
	<label for="product_list_price">{$lang.list_price} ({$currencies.$primary_currency.symbol}) :</label>
	<input type="text" name="product_data[list_price]" id="product_data_list_price" size="10" value="{$product_data.list_price|default:"0.00"}" class="input-text-medium" />
</div>

<div class="form-field">
	<label for="product_amount">{$lang.in_stock}:</label>
	{if $product_data.tracking == "O"}
		{include file="buttons/button.tpl" but_text=$lang.edit but_href="product_options.inventory?product_id=`$id`" but_role="edit"}
	{else}
		<input type="text" name="product_data[amount]" id="product_amount" size="10" value="{$product_data.amount|default:"1"}" class="input-text-short" />
	{/if}
</div>

<div class="form-field">
	<label for="zero_price_action">{$lang.zero_price_action}:</label>
	<select name="product_data[zero_price_action]" id="zero_price_action">
		<option value="R" {if $product_data.zero_price_action == "R"}selected="selected"{/if}>{$lang.zpa_refuse}</option>
		<option value="P" {if $product_data.zero_price_action == "P"}selected="selected"{/if}>{$lang.zpa_permit}</option>
		<option value="A" {if $product_data.zero_price_action == "A"}selected="selected"{/if}>{$lang.zpa_ask_price}</option>
	</select>
</div>

<div class="form-field">
	<label for="product_tracking">{$lang.inventory}:</label>
	<select name="product_data[tracking]" id="product_tracking" {if $settings.General.inventory_tracking == "N"}disabled="disabled"{/if}>
		{if $product_options}
			<option value="O" {if $product_data.tracking == "O" && $settings.General.inventory_tracking == "Y"}selected="selected"{/if}>{$lang.track_with_options}</option>
		{/if}
		<option value="B" {if $product_data.tracking == "B" && $settings.General.inventory_tracking == "Y"}selected="selected"{/if}>{$lang.track_without_options}</option>
		<option value="D" {if $product_data.tracking == "D" || $settings.General.inventory_tracking == "N"}selected="selected"{/if}>{$lang.dont_track}</option>
	</select>
</div>

<div class="form-field">
	<label for="min_qty">{$lang.min_order_qty}:</label>
	<input type="text" name="product_data[min_qty]" size="10" id="min_qty" value="{$product_data.min_qty|default:"0"}" class="input-text-short" />
</div>

<div class="form-field">
	<label for="max_qty">{$lang.max_order_qty}:</label>
	<input type="text" name="product_data[max_qty]" id="max_qty" size="10" value="{$product_data.max_qty|default:"0"}" class="input-text-short" />
</div>

<div class="form-field">
	<label for="qty_step">{$lang.quantity_step}:</label>
	<input type="text" name="product_data[qty_step]" id="qty_step" size="10" value="{$product_data.qty_step|default:"0"}" class="input-text-short" />
</div>

<div class="form-field">
	<label for="list_qty_count">{$lang.list_quantity_count}:</label>
	<input type="text" name="product_data[list_qty_count]" id="list_qty_count" size="10" value="{$product_data.list_qty_count|default:"0"}" class="input-text-short" />
</div>

<div class="form-field">
	<label for="products_tax_id">{$lang.taxes}:</label>
	<div class="select-field">
		<input type="hidden" name="product_data[tax_ids]" value="" />
		{foreach from=$taxes item="tax"}
			<input type="checkbox" name="product_data[tax_ids][{$tax.tax_id}]" id="product_data_{$tax.tax_id}" {if $tax.tax_id|in_array:$product_data.taxes || $product_data.taxes[$tax.tax_id]}checked="checked"{/if} class="checkbox" value="{$tax.tax_id}" />
			<label for="product_data_{$tax.tax_id}">{$tax.tax}</label>
		{foreachelse}
			&ndash;
		{/foreach}
	</div>
</div>
</fieldset>

<fieldset>

{include file="common_templates/subheader.tpl" title=$lang.seo_meta_data}

<div class="form-field {$no_hide_input_if_shared_product}">
	<label for="product_page_title">{$lang.page_title}:</label>
	<input type="text" name="product_data[page_title]" id="product_page_title" size="55" value="{$product_data.page_title}" class="input-text-large" />
	{include file="buttons/update_for_all.tpl" display=$show_update_for_all object_id='page_title' name="update_all_vendors[page_title]"}
</div>

<div class="form-field {$no_hide_input_if_shared_product}">
	<label for="product_meta_descr">{$lang.meta_description}:</label>
	<textarea name="product_data[meta_description]" id="product_meta_descr" cols="55" rows="2" class="input-textarea-long">{$product_data.meta_description}</textarea>
	{include file="buttons/update_for_all.tpl" display=$show_update_for_all object_id='meta_description' name="update_all_vendors[meta_description]"}	
</div>

<div class="form-field {$no_hide_input_if_shared_product}">
	<label for="product_meta_keywords">{$lang.meta_keywords}:</label>
	<textarea name="product_data[meta_keywords]" id="product_meta_keywords" cols="55" rows="2" class="input-textarea-long">{$product_data.meta_keywords}</textarea>
	{include file="buttons/update_for_all.tpl" display=$show_update_for_all object_id='meta_keywords' name="update_all_vendors[meta_keywords]"}
</div>
</fieldset>

<fieldset>

{include file="common_templates/subheader.tpl" title=$lang.availability}

<div class="form-field">
	<label>{$lang.usergroups}:</label>
		<div class="select-field">
			{include file="common_templates/select_usergroups.tpl" id="ug_id" name="product_data[usergroup_ids]" usergroups="C"|fn_get_usergroups:$smarty.const.DESCR_SL usergroup_ids=$product_data.usergroup_ids input_extra="" list_mode=false}
		</div>
</div>

<div class="form-field">
	<label for="date_holder">{$lang.creation_date}:</label>
	{include file="common_templates/calendar.tpl" date_id="date_holder" date_name="product_data[timestamp]" date_val=$product_data.timestamp|default:$smarty.const.TIME start_year=$settings.Company.company_start_year}
</div>

<div class="form-field">
	<label for="date_avail_holder">{$lang.available_since}:</label>
	{include file="common_templates/calendar.tpl" date_id="date_avail_holder" date_name="product_data[avail_since]" date_val=$product_data.avail_since|default:"" start_year=$settings.Company.company_start_year}
</div>

<div class="form-field">
	<label for="out_of_stock_actions">{$lang.out_of_stock_actions}:</label>
	<select name="product_data[out_of_stock_actions]" id="product_out_of_stock_actions">
		<option value="N" {if $product_data.out_of_stock_actions == "N"}selected="selected"{/if}>{$lang.none}</option>
		<option value="B" {if $product_data.out_of_stock_actions == "B"}selected="selected"{/if}>{$lang.buy_in_advance}</option>
		<option value="S" {if $product_data.out_of_stock_actions == "S"}selected="selected"{/if}>{$lang.sign_up_for_notification}</option>
	</select>
</div>
</fieldset>

<fieldset>

{include file="common_templates/subheader.tpl" title=$lang.extra}

<div class="form-field">
	<label for="details_layout">{$lang.product_details_layout}:</label>
	<select id="details_layout" name="product_data[details_layout]">
		{foreach from=$id|fn_get_product_details_views key="layout" item="item"}
			<option {if $product_data.details_layout == $layout}selected="selected"{/if} value="{$layout}">{$item}</option>
		{/foreach}
	</select>
</div>

<div class="form-field">
	<label for="product_feature_comparison">{$lang.feature_comparison}:</label>
	<input type="hidden" name="product_data[feature_comparison]" value="N" />
	<input type="checkbox" name="product_data[feature_comparison]" id="product_feature_comparison" value="Y" {if $product_data.feature_comparison == "Y"}checked="checked"{/if} class="checkbox" />
</div>

<div class="form-field">
	<label for="product_is_edp">{$lang.downloadable}:</label>
	<input type="hidden" name="product_data[is_edp]" value="N" />
	<input type="checkbox" name="product_data[is_edp]" id="product_is_edp" value="Y" {if $product_data.is_edp == "Y"}checked="checked"{/if} onclick="$('#edp_shipping').toggleBy(); $('#edp_unlimited').toggleBy();" class="checkbox" />
</div>

<div class="form-field {if $product_data.is_edp != "Y"}hidden{/if}" id="edp_shipping">
	<label for="product_edp_shipping">{$lang.edp_enable_shipping}:</label>
	<input type="hidden" name="product_data[edp_shipping]" value="N" />
	<input type="checkbox" name="product_data[edp_shipping]" id="product_edp_shipping" value="Y" {if $product_data.edp_shipping == "Y"}checked="checked"{/if} class="checkbox" />
</div>

<div class="form-field {if $product_data.is_edp != "Y"}hidden{/if}" id="edp_unlimited">
	<label for="product_edp_unlimited">{$lang.time_unlimited_download}:</label>
	<input type="hidden" name="product_data[unlimited_download]" value="N" />
	<input type="checkbox" name="product_data[unlimited_download]" id="product_edp_unlimited" value="Y" {if $product_data.unlimited_download == "Y"}checked="checked"{/if} class="checkbox" />
</div>

{include file="views/localizations/components/select.tpl" data_from=$product_data.localization data_name="product_data[localization]"}

<div class="form-field {$no_hide_input_if_shared_product}">
	<label for="product_short_descr">{$lang.short_description}:</label>
	<textarea id="product_short_descr" name="product_data[short_description]" cols="55" rows="2" class="cm-wysiwyg input-textarea-long">{$product_data.short_description}</textarea>
	{include file="buttons/update_for_all.tpl" display=$show_update_for_all object_id='short_description' name="update_all_vendors[short_description]"}
</div>

<div class="form-field">
	<label for="product_popularity">{$lang.popularity}:</label>
	<input type="text" name="product_data[popularity]" id="product_popularity" size="55" value="{$product_data.popularity|default:0}" class="input-text-medium" />
</div>

<div class="form-field {$no_hide_input_if_shared_product}">
	<label for="product_search_words">{$lang.search_words}:</label>
	<textarea name="product_data[search_words]" id="product_search_words" cols="55" rows="2" class="input-textarea-long">{$product_data.search_words}</textarea>
	{include file="buttons/update_for_all.tpl" display=$show_update_for_all object_id='search_words' name="update_all_vendors[search_words]"}
</div>
</fieldset>
<!--content_detailed--></div> {* /content detailed *}

{** /Product description section **}

{** Product images section **}
<div id="content_images" class="hidden"> {* content images *}
<fieldset>
	{include file="common_templates/subheader.tpl" title=$lang.additional_images}
	{if $product_data.image_pairs}
	{include file="common_templates/sortable_position_scripts.tpl" sortable_id="additional_images" sortable_table="images_links" sortable_id_name="pair_id" handle_class="cm-sortable-handle"}
	<div class="cm-sortable" id="additional_images">
	{assign var="new_image_position" value="0"}
	{foreach from=$product_data.image_pairs item=pair name="detailed_images"}
		<div class="cm-row-item cm-sortable-id-{$pair.pair_id} cm-sortable-box">
			<div class="cm-sortable-handle sortable-bar"><img src="{$images_dir}/icons/icon_sort_bar.gif" width="26" height="25" border="0" title="{$lang.sort_images}" alt="{$lang.sort}" class="valign" /></div>
			<div class="sortable-item">
			{include file="common_templates/attach_images.tpl" image_name="product_additional" image_object_type="product" image_key=$pair.pair_id image_type="A" image_pair=$pair icon_title=$lang.additional_thumbnail detailed_title=$lang.additional_popup_larger_image icon_text=$lang.text_additional_thumbnail detailed_text=$lang.text_additional_detailed_image delete_pair=true no_thumbnail=true}
			</div>
			<div class="clear"></div>
		</div>
		{if $new_image_position <= $pair.position}
			{assign var="new_image_position" value=$pair.position}
		{/if}
	{/foreach}
	</div>
	{/if}

</fieldset>

<div id="box_new_image" class="margin-top">
	<div class="clear cm-row-item">
		<input type="hidden" name="product_add_additional_image_data[][position]" value="{$new_image_position}" class="cm-image-field" />
		<div class="float-left">{include file="common_templates/attach_images.tpl" image_name="product_add_additional" image_object_type="product" image_type="A" icon_title=$lang.additional_thumbnail detailed_title=$lang.additional_popup_larger_image icon_text=$lang.text_additional_thumbnail detailed_text=$lang.text_additional_detailed_image no_thumbnail=true}</div>
		<div class="buttons-container">{include file="buttons/multiple_buttons.tpl" item_id="new_image"}</div>
	</div>
	<hr />
</div>

</div> {* /content images *}
{** /Product images section **}

{** Shipping settings section **}
<div id="content_shippings" class="hidden"> {* content shippings *}
	{include file="views/products/components/products_shipping_settings.tpl"}
</div> {* /content shippings *}
{** /Shipping settings section **}

{** Quantity discounts section **}
{hook name="products:update_qty_discounts"}
	{include file="views/products/components/products_update_qty_discounts.tpl"}
{/hook}
{** /Quantity discounts section **}
{** Product features section **}
{include file="views/products/components/products_update_features.tpl"}
{** /Product features section **}


<div id="content_addons">
{hook name="products:detailed_content"}
{/hook}
</div>


{hook name="products:tabs_content"}
{/hook}

{** Form submit section **}

<div class="buttons-container cm-toggle-button buttons-bg">
	{include file="buttons/save_cancel.tpl" but_name="dispatch[products.update]"}
</div>
{** /Form submit section **}

</form> {* /product update form *}

{hook name="products:tabs_extra"}{/hook}

{if $id}
{** Product options section **}
<div class="cm-hide-save-button hidden" id="content_options">
	{include file="views/products/components/products_update_options.tpl"}
</div>
{** /Product options section **}

{** Products files section **}
<div id="content_files" class="cm-hide-save-button hidden">
	{hook name="products:content_files"}
		{include file="views/products/components/products_update_files.tpl"}
	{/hook}
</div>
{** /Products files section **}

{** Subscribers section **}
<div id="content_subscribers" class="cm-hide-save-button hidden">
	{include file="views/products/components/product_subscribers.tpl" product_id=$id}
</div>
{** /Subscribers section **}
{/if}

{/capture}
{include file="common_templates/tabsbox.tpl" content=$smarty.capture.tabsbox group_name=$controller active_tab=$smarty.request.selected_section track=true}

{/capture}
{if !$id}
	{include file="common_templates/mainbox.tpl" title=$lang.new_product content=$smarty.capture.mainbox}
{else}
	{include file="common_templates/view_tools.tpl" url="products.update?product_id="}
	
	{capture name="preview"}
		
		{assign var="view_uri" value="products.view?product_id=`$id`"}
		{assign var="view_uri_escaped" value="`$view_uri`&amp;action=preview"|fn_url:'C':'http':'&':$smarty.const.DESCR_SL|escape:"url"}
		
		

		<a target="_blank" class="tool-link" title="{$view_uri|fn_url:'C':'http':'&':$smarty.const.DESCR_SL}" href="{$view_uri|fn_url:'C':'http':'&':$smarty.const.DESCR_SL}">{$lang.preview}</a>
		<a target="_blank" class="tool-link" title="{$view_uri|fn_url:'C':'http':'&':$smarty.const.DESCR_SL}" href="{"profiles.act_as_user?user_id=`$auth.user_id`&amp;area=C&amp;redirect_url=`$view_uri_escaped`"|fn_url}">{$lang.preview_as_admin}</a>
	{/capture}
	{include file="common_templates/mainbox.tpl" title="`$lang.editing_product`:&nbsp;`$product_data.product`"|unescape|strip_tags content=$smarty.capture.mainbox select_languages=true tools=$smarty.capture.view_tools}
{/if}