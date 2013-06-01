{hook name="blocks:topmenu_dropdown"}

{if $items}
	<div class="wrap-dropdown-multicolumns">
	    <ul class="dropdown-multicolumns clearfix">
		
		{hook name="blocks:topmenu_dropdown_top_menu"}
		
		{foreach from=$items item="item1" name="item1"}
			{assign var="item1_url" value=$item1|fn_form_dropdown_object_link:$block.type}
			{assign var="unique_elm_id" value=$item1_url|md5}
			{assign var="unique_elm_id" value="topmenu_`$block.block_id`_`$unique_elm_id`"}
			<li class="{if !$item1.$childs}nodrop{elseif $item1.$childs|count >= 6 && ($item1.$childs|count % 6 == 0 || $item1.$childs|count % 6 == 5) && $item1.$childs|fn_check_second_level_child_array:$childs}fullwidth{/if}{if $item1.active || $item1|fn_check_is_active_menu_item:$block.type} cm-active{/if}">
				<a{if $item1_url} href="{$item1_url}"{/if}{if $item1.$childs} class="drop"{/if}>{$item1.$name}</a>

			{if $item1.$childs}

				{if !$item1.$childs|fn_check_second_level_child_array:$childs}
				{* Only two levels. Vertical output *}

				<div class="dropdown-1column">

						<div class="col-1 firstcolumn lastcolumn">
							<ul>
							
							{hook name="blocks:topmenu_dropdown_2levels_elements"}
							
							{foreach from=$item1.$childs item="item2" name="item2"}
								{assign var="item_url2" value=$item2|fn_form_dropdown_object_link:$block.type}
								<li{if $item2.active || $item2|fn_check_is_active_menu_item:$block.type} class="cm-active"{/if}><a{if $item_url2} href="{$item_url2}"{/if}>{$item2.$name}</a></li>
							{/foreach}
							{if $item1.show_more && $item1_url}
								<li class="alt-link"><a href="{$item1_url}">{$lang.text_topmenu_view_more}</a></li>
							{/if}
							
							{/hook}
							
							</ul> 

						</div>
					</div>
					
				{else}
				{* Three levels. Full output *}
				
					{assign var="subitems_count" value=$item1.$childs|count}
					{math assign="divider" equation="ceil(x / 6)" x=$subitems_count}
					{math assign="cols" equation="ceil(x / y)" x=$subitems_count y=$divider}

					{if $cols == 1}
						{assign var="dropdown_class" value="dropdown-1column"}
					{elseif $cols == 6}
						{assign var="dropdown_class" value="dropdown-fullwidth"}
					{else}
						{assign var="dropdown_class" value="dropdown-`$cols`columns"}
					{/if}

					<div class="{$dropdown_class}{if $smarty.foreach.item1.index > 4 && $smarty.foreach.item1.last} drop-left{/if}" id="{$unique_elm_id}">
						{hook name="blocks:topmenu_dropdown_3levels_cols"}
						
						{foreach from=$item1.$childs item="item2" name="item2"}
							<div class="col-1{if $smarty.foreach.item2.index % $cols == 0 || $smarty.foreach.item2.first} firstcolumn{elseif $smarty.foreach.item2.index % $cols == ($cols - 1) || $smarty.foreach.item2.last} lastcolumn{/if}">
								{assign var="item2_url" value=$item2|fn_form_dropdown_object_link:$block.type}
								<h3{if $item2.active || $item2|fn_check_is_active_menu_item:$block.type} class="cm-active"{/if}><a{if $item2_url} href="{$item2_url}"{/if}>{$item2.$name}</a></h3>

								{if $item2.$childs}
								<ul>
								{hook name="blocks:topmenu_dropdown_3levels_col_elements"}
								{foreach from=$item2.$childs item="item3" name="item3"}
									{assign var="item3_url" value=$item3|fn_form_dropdown_object_link:$block.type}
									<li{if $item3.active || $item3|fn_check_is_active_menu_item:$block.type} class="cm-active"{/if}><a{if $item3_url} href="{$item3_url}"{/if}>{$item3.$name}</a></li>
								{/foreach}
								{if $item2.show_more && $item2_url}
									<li class="alt-link"><a href="{$item2_url}">{$lang.text_topmenu_view_more}</a></li>
								{/if}
								{/hook}
								</ul> 
								{/if}
							</div>

							{if $smarty.foreach.item2.index % $cols == ($cols - 1) && !$smarty.foreach.item2.first && !$smarty.foreach.item2.last}
							<div class="clear"></div><!-- Need for ie7 -->
							{/if}

						{/foreach}

						{if $item1.show_more && $item1_url}
						<div class="dropdown-bottom">
							<a href="{$item1_url}">{$lang.text_topmenu_more|replace:"[item]":$item1.$name}</a>
						</div>
						{/if}
						
						{/hook}

					</div>

				{/if}

			{/if}
			</li>
		{/foreach}
		
		{/hook}
		</ul>
		<div class="clear"></div>
	</div>
{/if}

{/hook}

{literal}
<script type="text/javascript">
//<![CDATA[
$(function(){
	// set dropdown menu width
	$('.dropdown-1column').each(function() {
		var p = $(this).parents('li:first');
		if (p.length) {
			$(this).css('min-width', (p.width() + 10) + 'px');
		}
	});
	var global_offset = $('.wrap-dropdown-multicolumns').offset().top;
	$('.dropdown-fullwidth').each(function(){
		var offset = $(this).parent('.fullwidth').offset().top;
		$(this).css('top', offset - global_offset + 25 + 'px');
	});
});
//]]>
</script>
{/literal}
