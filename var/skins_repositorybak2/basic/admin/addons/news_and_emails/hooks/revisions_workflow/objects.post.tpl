{if $workflow.object == "news"}
	{include file="addons/news_and_emails/pickers/news_picker.tpl" input_name="workflow_data[elements]" data_id="added_news" multiple=true item_ids=$workflow.elements_data no_item_text=$lang.text_all_items_included|replace:"[items]":$lang.news}
{/if}