<script type="text/javascript" class="cm-ajax-force">
//<![CDATA[
{literal}
$(function(){
	//Dropdown states
	$('.cm-dropdown-title').hover(
		function () {
			$(this).addClass('hover');
		},function () {
			$(this).removeClass('hover');
	});
	$('.cm-dropdown-content').hide();
	$('.cm-dropdown-title').click(function () {
		var hideDropDown = function(e) {
			var jelm = $(e.target);

			if (e.data.elm.hasClass('click') && !jelm.parents('.cm-dropdown-content').length && !jelm.parents('.cm-dropdown-title.click').length) {
				$(document).unbind('mousedown', hideDropDown);
				e.data.elm.click();
			}
		}
		$(this).toggleClass('click').next('.cm-dropdown-content').slideToggle("fast");

		if ($(this).hasClass('click')) {
			$(document).bind('mousedown', {elm: $(this)}, hideDropDown);
		} else {
			$(document).unbind('mousedown', hideDropDown);
		}
		return false;
	});
});
{/literal}
//]]>
</script>

<div class="dropdown-container">
{if $search.sort_order == 'asc'}
{assign var="sort_label" value="sort_by_`$search.sort_by`_desc"}
{else}
{assign var="sort_label" value="sort_by_`$search.sort_by`_asc"}
{/if}
	<span class="cm-dropdown-title sort-dropdown dropdown-wrap-left"><a class="dropdown-wrap-right">{$lang.$sort_label}</a></span>
	<ul class="cm-dropdown-content">
		{foreach from=$sorting key="option" item="value"}
			{if $search.sort_by == $option}
				{assign var="sort_order" value=$search.sort_order}
			{else}
				{if $value.default_order}
					{assign var="sort_order" value=$value.default_order}
				{else}
					{assign var="sort_order" value="asc"}
				{/if}
			{/if}
			{foreach from=$sorting_orders item="sort_order"}
				{if $search.sort_by != $option || $search.sort_order == $sort_order}
					{assign var="sort_label" value="sort_by_`$label_pref``$option`_`$sort_order`"}
					{assign var="sort_class" value="sort-by-`$class_pref``$option`-`$sort_order`"}
					{assign var="sort_key" value="`$option`-`$sort_order`"}
					{if !$avail_sorting || $avail_sorting[$sort_key] == 'Y'}
					<li class="{$sort_class}"><a class="{$ajax_class}" rev="{$pagination_id}" href="{"`$curl`&amp;sort_by=`$option`&amp;sort_order=`$sort_order`"|fn_url}" rel="nofollow" name="sorting_callback">{$lang.$sort_label}</a></li>
					{/if}
				{/if}
			{/foreach}
		{/foreach}
	</ul>
</div>