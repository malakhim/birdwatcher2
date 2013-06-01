{capture name="mainbox"}
{assign var="show_latest_orders" value="orders"|fn_check_permissions:'manage':'admin'}
{assign var="show_orders" value="sales_reports"|fn_check_permissions:'reports':'admin'}
{assign var="show_inventory" value="products"|fn_check_permissions:'manage':'admin'}
{assign var="show_users" value="profiles"|fn_check_permissions:'manage':'admin'}
{hook name="index:index"}
<table cellpadding="0" cellspacing="0" border="0" width="100%" class="table-fixed">
<tr valign="top">
<td width="80%">
{if $show_orders}
<div class="statistics-box overall">
	<div class="statistics-body">
		<a href="{"orders.manage?time_from=`$date.today`&time_to=`$date.TIME`&period=C"|fn_url}" class="section"><span class="price">{include file="common_templates/price.tpl" value=$orders_stats.daily_orders.totals.total_paid} </span><u>{$lang.today}</u> <span class="block">{$lang.prev} {include file="common_templates/price.tpl" value=$orders_stats.daily_orders.prev_totals.total_paid} <span class="percent-{if $orders_stats.daily_orders.totals.profit >= 0}up{else}down{/if}">{if $orders_stats.daily_orders.totals.profit}({if $orders_stats.daily_orders.totals.profit >= 0}+{/if}{$orders_stats.daily_orders.totals.profit}%){/if}</span></span></a>
		
		<a href="{"orders.manage?time_from=`$date.week`&time_to=`$date.TIME`&period=C"|fn_url}" class="section"><span class="price">{include file="common_templates/price.tpl" value=$orders_stats.weekly_orders.totals.total_paid} </span><u>{$lang.week}</u> <span class="block">{$lang.prev} {include file="common_templates/price.tpl" value=$orders_stats.weekly_orders.prev_totals.total_paid} <span class="percent-{if $orders_stats.weekly_orders.totals.profit >= 0}up{else}down{/if}">{if $orders_stats.weekly_orders.totals.profit}({if $orders_stats.weekly_orders.totals.profit >= 0}+{/if}{$orders_stats.weekly_orders.totals.profit}%){/if}</span></span></a>
		
		<a href="{"orders.manage?time_from=`$date.month`&time_to=`$date.TIME`&period=C"|fn_url}" class="section last"><span class="price">{include file="common_templates/price.tpl" value=$orders_stats.monthly_orders.totals.total_paid} </span><u>{$lang.month}</u> <span class="block">{$lang.prev} {include file="common_templates/price.tpl" value=$orders_stats.monthly_orders.prev_totals.total_paid} <span class="percent-{if $orders_stats.monthly_orders.totals.profit >= 0}up{else}down{/if}">{if $orders_stats.monthly_orders.totals.profit}({if $orders_stats.monthly_orders.totals.profit >= 0}+{/if}{$orders_stats.monthly_orders.totals.profit}%){/if}</span></span></a>
	</div>
</div>
{/if}
{if $show_latest_orders}
<div class="statistics-box orders">
	{include file="common_templates/subheader_statistic.tpl" title=$lang.latest_orders}
	{assign var="order_status_descr" value=$smarty.const.STATUSES_ORDER|fn_get_statuses:true:true:true}
	<div class="statistics-body">
		{if $latest_orders}
		<table cellpadding="0" cellspacing="0" border="0" width="100%">
			{assign var="order_statuses_data" value=$smarty.const.STATUSES_ORDER|fn_get_statuses:false:$get_additional_statuses:true}
			{foreach from=$latest_orders item="order"}
			<tr valign="top">
				<td width="17%">
					{assign var="status_descr" value=$order.status}
					<span class="order-status" style="background-color: #{$order_statuses_data[$order.status].color}"><em>{$order_status_descr.$status_descr}</em></span>
					<p class="order-date">{$order.timestamp|date_format:"`$settings.Appearance.date_format`, `$settings.Appearance.time_format`"}</p>
				</td>
				<td width="83%" class="order-description">
					<span class="total">{include file="common_templates/price.tpl" value=$order.total}</span> <a href="{"orders.details?order_id=`$order.order_id`"|fn_url}">{$lang.order}&nbsp;#{$order.order_id}</a> {$lang.by} {if $order.user_id}<a href="{"profiles.update?user_id=`$order.user_id`"|fn_url}">{/if}{$order.firstname} {$order.lastname}{if $order.user_id}</a>{/if}
					<div class="product-name">
						{capture name="order_products"}
							{strip}
							{foreach name="order_items" from=$order.items item="product"}
								{$product.product} x {$product.amount}
								{if !$smarty.foreach.order_items.last}, {/if}
							{/foreach}
							{/strip}
						{/capture}
						{$smarty.capture.order_products|truncate:70:"...":true}
					</div>
				</td>
			</tr>
			{/foreach}
		</table>
		{else}
			<p class="no-items">{$lang.no_items}</p>
		{/if}
	</div>
</div>
{/if}

{if $show_orders && false} {* Hide section for a while *}
<div class="statistic">
	<table cellpadding="0" cellspacing="0" border="0" width="100%" class="table">
	<tr>
		<th>{$lang.status}</th>
		<th class="center">{$lang.this_day}</th>
		<th class="center">{$lang.this_week}</th>
		<th class="center">{$lang.this_month}</th>
		<th class="center">{$lang.this_year}</th>
	</tr>
	{foreach from=$order_statuses item="status" key="_status"}
	<tr {cycle values="class=\"table-row\", "}>
		<td>{include file="common_templates/status.tpl" status=$_status display="view"}</td>
		<td class="center">{if $orders_stats.daily_orders.$_status.amount}<a href="{"orders.manage?status%5B%5D=`$_status`&amp;period=D"|fn_url}">{$orders_stats.daily_orders.$_status.amount}</a>{else}0{/if}</td>
		<td class="center">{if $orders_stats.weekly_orders.$_status.amount}<a href="{"orders.manage?status%5B%5D=`$_status`&amp;period=W"|fn_url}">{$orders_stats.weekly_orders.$_status.amount}</a>{else}0{/if}</td>
		<td class="center">{if $orders_stats.monthly_orders.$_status.amount}<a href="{"orders.manage?status%5B%5D=`$_status`&amp;period=M"|fn_url}">{$orders_stats.monthly_orders.$_status.amount}</a>{else}0{/if}</td>
		<td class="center">{if $orders_stats.year_orders.$_status.amount}<a href="{"orders.manage?status%5B%5D=`$_status`&amp;period=Y"|fn_url}">{$orders_stats.year_orders.$_status.amount}</a>{else}0{/if}</td>
	</tr>
	{/foreach}
	<tr {cycle values="class=\"table-row\", "}>
		<td><span>{$lang.total_orders}</span></td>
		<td class="center">{if $orders_stats.daily_orders.totals.amount}<a href="{"orders.manage?period=D"|fn_url}">{$orders_stats.daily_orders.totals.amount}</a>{else}0{/if}</td>
		<td class="center">{if $orders_stats.weekly_orders.totals.amount}<a href="{"orders.manage?period=W"|fn_url}">{$orders_stats.weekly_orders.totals.amount}</a>{else}0{/if}</td>
		<td class="center">{if $orders_stats.monthly_orders.totals.amount}<a href="{"orders.manage?period=M"|fn_url}">{$orders_stats.monthly_orders.totals.amount}</a>{else}0{/if}</td>
		<td class="center">{if $orders_stats.year_orders.totals.amount}<a href="{"orders.manage?period=Y"|fn_url}">{$orders_stats.year_orders.totals.amount}</a>{else}0{/if}</td>
	</tr>
	<tr class="strong">
		<td>{$lang.gross_total}</td>
		<td class="center">{include file="common_templates/price.tpl" value=$orders_stats.daily_orders.totals.total|default:"0"}</td>
		<td class="center">{include file="common_templates/price.tpl" value=$orders_stats.weekly_orders.totals.total|default:"0"}</td>
		<td class="center">{include file="common_templates/price.tpl" value=$orders_stats.monthly_orders.totals.total|default:"0"}</td>
		<td class="center">{include file="common_templates/price.tpl" value=$orders_stats.year_orders.totals.total|default:"0"}</td>
	</tr>
	<tr class="strong">
		<td>{$lang.totally_paid}</td>
		<td class="center valued-text">{include file="common_templates/price.tpl" value=$orders_stats.daily_orders.totals.total_paid|default:"0"}</td>
		<td class="center valued-text">{include file="common_templates/price.tpl" value=$orders_stats.weekly_orders.totals.total_paid|default:"0"}</td>
		<td class="center valued-text">{include file="common_templates/price.tpl" value=$orders_stats.monthly_orders.totals.total_paid|default:"0"}</td>
		<td class="center valued-text">{include file="common_templates/price.tpl" value=$orders_stats.year_orders.totals.total_paid|default:"0"}</td>
	</tr>

	</table>
</div>
{/if}

{hook name="index:extra"}
{/hook}

</td>

<td width="30px">&nbsp;</td>

<td width="360px">
{if $show_inventory}
<div class="statistics-box inventory">
	
	<div class="statistics-body">
		<p class="strong">{$lang.category_inventory}</p>
		<div class="clear">
			<ul>
				<li>{$lang.total}:&nbsp;{if $category_stats.total}{$category_stats.total}{else}0{/if}</li>
				<li>{$lang.active}:&nbsp;{if $category_stats.status.A}{$category_stats.status.A}{else}0{/if}</li>
			</ul>
			<ul>
				<li>{$lang.hidden}:&nbsp;{if $category_stats.status.H}{$category_stats.status.H}{else}0{/if}</li>
				<li>{$lang.disabled}:&nbsp;{if $category_stats.status.D}{$category_stats.status.D}{else}0{/if}</li>
			</ul>
		</div>
		
		<p class="strong product-inventory">{$lang.product_inventory}</p>
		<div class="clear">
			<ul>
				<li>{$lang.total}:&nbsp;{if $product_stats.total}<a href="{"products.manage"|fn_url}">{$product_stats.total}</a>{else}0{/if}</li>
				{hook name="index:inventory"}
				{/hook}
				<li>{$lang.in_stock}:&nbsp;{if $product_stats.in_stock}<a href="{"products.manage?amount_from=1&amp;amount_to=&amp;tracking[]=B&amp;tracking[]=O"|fn_url}">{$product_stats.in_stock}</a>{else}0{/if}</li>
				<li>{$lang.active}:&nbsp;{if $product_stats.status.A}<a href="{"products.manage?status=A"|fn_url}">{$product_stats.status.A}</a>{else}0{/if}</li>
				<li>{$lang.disabled}:&nbsp;{if $product_stats.status.D}<a href="{"products.manage?status=D"|fn_url}">{$product_stats.status.D}</a>{else}0{/if}</li>
			</ul>
			<ul>
				<li>{$lang.downloadable}:&nbsp;{if $product_stats.downloadable}<a href="{"products.manage?downloadable=Y"|fn_url}">{$product_stats.downloadable}</a>{else}0{/if}</li>
				<li>{$lang.text_out_of_stock}:&nbsp;{if $product_stats.out_of_stock}<a href="{"products.manage?amount_from=&amp;amount_to=0&amp;tracking[]=B&amp;tracking[]=O"|fn_url}">{$product_stats.out_of_stock}</a>{else}0{/if}</li>
				<li>{$lang.hidden}:&nbsp;{if $product_stats.status.H}<a href="{"products.manage?status=H"|fn_url}">{$product_stats.status.H}</a>{else}0{/if}</li>

				<li>{$lang.free_shipping}:&nbsp;{if $product_stats.free_shipping}<a href="{"products.manage?free_shipping=Y"|fn_url}">{$product_stats.free_shipping}</a>{else}0{/if}</li>
			</ul>
		</div>
	</div>
</div>
{/if}

{if !"COMPANY_ID"|defined && !"RESTRICTED_ADMIN"|defined}
{if $show_users}
<div class="statistics-box users">
	{include file="common_templates/subheader_statistic.tpl" title=$lang.users}
	
	<div class="statistics-body clear">
	<ul>
		<li class="customer-users">
			<span>{$lang.customers}:</span>
			<em>{if $users_stats.total.C}<a href="{"profiles.manage?user_type=C"|fn_url}">{$users_stats.total.C}</a>{else}0{/if}</em>
		</li>

		{if $usergroups_type.C}
		<li>
			<span>{$lang.not_a_member}:</span>
			<em>{if $users_stats.not_members.C}<a href="{"profiles.manage?usergroup_id=0&amp;user_type=C"|fn_url}">{$users_stats.not_members.C}</a>{else}0{/if}</em>
		</li>
		{/if}
		
		{foreach from=$usergroups key="mem_id" item="mem_name"}
		{if $mem_name.type == "C"}
			<li>
				<span>{$mem_name.usergroup}:</span>
				<em>{if $users_stats.usergroup.C.$mem_id}<a href="{"profiles.manage?usergroup_id=`$mem_id`"|fn_url}">{$users_stats.usergroup.C.$mem_id}</a>{else}0{/if}</em>
			</li>
		{/if}
		{/foreach}
		
		<li class="staff-users">
			<span>{$lang.staff}:</span>

			
			{assign var="staff_total" value="`$users_stats.total.A+$users_stats.total.V`"}
			<em>{if $staff_total}<a href="{"profiles.manage?user_types[]=A&user_types[]=V"|fn_url}">{$staff_total}</a>{else}0{/if}</em>
			
		</li>

		{if $usergroups_type.A}
		<li>
			<span>{$lang.root_administrators}:</span>

			
			{assign var="not_members_total" value="`$users_stats.not_members.A+$users_stats.not_members.V`"}
			<em>{if $not_members_total}<a href="{"profiles.manage?usergroup_id=0&amp;user_types[]=A&amp;user_types[]=V"|fn_url}">{$not_members_total}</a>{else}0{/if}</em>
			
		</li>
		{/if}
		
		{foreach from=$usergroups key="mem_id" item="mem_name"}
		{if $mem_name.type == "A"}
			<li>
				<span>{$mem_name.usergroup}:</span>
				<em>{if $users_stats.usergroup.A.$mem_id}<a href="{"profiles.manage?usergroup_id=`$mem_id`"|fn_url}">{$users_stats.usergroup.A.$mem_id}</a>{else}0{/if}</em>
			</li>
		{/if}
		{/foreach}
		
		{hook name="index:users"}
		{/hook}
		<li class="total-users">
			<span>{$lang.total}:</span>
			<em>{if $users_stats.total_all}<a href="{"profiles.manage"|fn_url}">{$users_stats.total_all}</a>{else}0{/if}</em>
		</li>

		<li class="disabled-users">
			<span>{$lang.disabled}:</span>
			<em>{if $users_stats.not_approved}<a href="{"profiles.manage?status=D"|fn_url}">{$users_stats.not_approved}</a>{else}0{/if}</em>
		</li>
	</ul>
	</div>
</div>
{/if}
{assign var="show_shippings" value="shippings"|fn_check_permissions:'manage':'admin'}
{assign var="show_payments" value="payments"|fn_check_permissions:'manage':'admin'}
{assign var="show_settings" value="settings"|fn_check_permissions:'manage':'admin'}
{assign var="show_database" value="database"|fn_check_permissions:'manage':'admin'}
{assign var="show_add_page" value="pages"|fn_check_permissions:'manage':'admin':'POST'}
{assign var="show_blocks" value="block_manager"|fn_check_permissions:'manage':'admin'}
{if $show_inventory || $show_shippings || $show_payments || $show_settings || $show_database || $show_add_page ||  $show_blocks}
<div class="statistics-box shortcuts">
	{include file="common_templates/subheader_statistic.tpl" title=$lang.shortcuts}

	<div class="statistics-body clear">
		<ul class="arrow-list float-left">
			{if $show_inventory}<li><a href="{"products.manage"|fn_url}">{$lang.manage_products}</a></li>{/if}
			{if $show_inventory}<li><a href="{"categories.manage"|fn_url}">{$lang.manage_categories}</a></li>{/if}
			{if $show_shippings}<li><a href="{"shippings.manage"|fn_url}">{$lang.shipping_methods}</a></li>{/if}
			{if $show_payments}<li><a href="{"payments.manage"|fn_url}">{$lang.payment_methods}</a></li>{/if}
		</ul>

		<ul class="arrow-list float-left">
			{if $show_settings}<li><a href="{"settings.manage"|fn_url}">{$lang.general_settings}</a></li>{/if}
			{if $show_database}<li><a href="{"database.manage"|fn_url}">{$lang.db_backup_restore}</a></li>{/if}
			{if $show_add_page}<li><a href="{"pages.add?parent_id=0"|fn_url}">{$lang.add_inf_page}</a></li>{/if}
			{if $show_blocks}<li><a href="{"block_manager.manage"|fn_url}">{$lang.manage_blocks}</a></li>{/if}
		</ul>
	</div>
</div>
{/if}
{/if}

</td>
</tr>
</table>
{/hook}

{capture name="tools"}

	{if $settings.General.feedback_type == 'manual' && !"COMPANY_ID"|defined && !"RESTRICTED_ADMIN"|defined}
		<div class="tools-container">
		{include file="common_templates/object_group.tpl" link_text="`$lang.send_feedback`&nbsp;&#155;&#155;" content=$smarty.capture.update_block id="feedback" no_table=true header_text=$lang.feedback_values but_name="dispatch[feedback.send]" href="feedback.prepare" opener_ajax_class="cm-ajax" link_class="cm-ajax-force" picker_meta="cm-clear-content" act='edit'}
		</div>
	{/if}

{/capture}
{/capture}
{include file="common_templates/mainbox.tpl" title=$lang.dashboard content=$smarty.capture.mainbox tools=$smarty.capture.tools}