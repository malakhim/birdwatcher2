{capture name="mainbox"}

{capture name="extra_tools"}
<a href="{"profiles.update?user_id=`$partner.user_id`"|fn_url}" class="tool-link">{$lang.edit_affiliate}</a>
{/capture}

<table cellpadding="0" cellspacing="0" border="0" width="100%">
<tr valign="top">
	<td width="50%">
	{include file="common_templates/subheader.tpl" title=$lang.personal_information}
	
	<div class="details-block">
		<div class="form-field">
			<label>{$lang.active}:</label>
			<span>{if $partner.status == "A"}{$lang.yes}{else}{$lang.no}{/if}</span>
		</div>
		
		{if $settings.General.use_email_as_login != "Y"}
		<div class="form-field">
			<label>{$lang.username}:</label>
			<span>{$partner.user_login}</span>
		</div>
		{/if}
		
		{if $partner.title_descr}
		<div class="form-field">
			<label>{$lang.title}:</label>
			<span>{$partner.title_descr}</span>
		</div>
		{/if}

		<div class="form-field">
			<label>{$lang.first_name}:</label>
			<span>{$partner.firstname}</span>
		</div>
		
		<div class="form-field">
			<label>{$lang.last_name}:</label>
			<span>{$partner.lastname}</span>
		</div>
		
		{if $partner.company}
		<div class="form-field">
			<label>{$lang.company}:</label>
			<span>{$partner.company}</span>
		</div>
		{/if}
		
		{if $partner.email}
		<div class="form-field">
			<label>{$lang.email}:</label>
			<a href="mailto:{$partner.email|escape:url}" class="strong">{$partner.email}</a>
		</div>
		{/if}
		
		{if $partner.phone}
		<div class="form-field">
			<label>{$lang.phone}:</label>
			<span>{$partner.phone}</span>
		</div>
		{/if}
		
		{if $partner.fax}
		<div class="form-field">
			<label>{$lang.fax}:</label>
			<span>{$partner.fax}</span>
		</div>
		{/if}
	</div>
	
	{include file="common_templates/subheader.tpl" title=$lang.affiliate_information}

	{if $settings.General.use_email_as_login != "Y"}
		{assign var="user_login_query" value="&amp;user_login=`$partner.user_login`"}
	{/if}
	
	<div class="details-block">
		<div class="form-field">
			{assign var="partner_email" value=$partner.email|escape:url}
			<label>{$lang.status}:</label>
			<span>{if $partner.approved == "A"}{$lang.approved}{elseif $partner.approved == "D"}{$lang.declined}{else}{$lang.awaiting_approval}{/if}</span> (<a href="{"partners.manage?user_type=P&amp;name=`$partner.firstname``$user_login_query`&amp;email=`$partner_email`"|fn_url}">{$lang.change}</a>)
		</div>

		{if $addons.affiliate.show_affiliate_code == "Y"}
		<div class="form-field">
			<label>{$lang.affiliate_code}:</label>
			<span>{$partner.user_id|fn_dec2any}</span>
		</div>
		{/if}
		
		{if $partner.plan}
		<div class="form-field">
			<label>{$lang.plan}:</label>
			<a href="{"affiliate_plans.update?plan_id=`$partner.plan_id`"|fn_url}" class="strong">{$partner.plan}</a> (<a href="{"partners.manage.reset_search?user_type=P&amp;name=`$partner.firstname``$user_login_query`&amp;email=`$partner_email`"|fn_url}">{$lang.change}</a>)
		</div>
		{/if}
		
		<div class="form-field">
			<label>{$lang.balance_account}:</label>
			<span>{include file="common_templates/price.tpl" value=$partner.balance}</span>
		</div>
		
		<div class="form-field">
			<label>{$lang.total_payouts}:</label>
			<form action="{""|fn_url}" method="POST" name="partner_payouts_form">
				<input type="hidden" name="payout_search[partner_id]" value="{$partner.user_id}" />
				<span>{include file="common_templates/price.tpl" value=$partner.total_payouts}{if $partner.total_payouts}</span> (<a href="{"payouts.manage?partner_id=`$partner.user_id`&amp;period=A"|fn_url}">{$lang.view}</a>){/if}
			</form>
		</div>
	</div>
	</td>
	<td class="details-block-container" width="50%">
	
	{include file="common_templates/subheader.tpl" title=$lang.commissions_of_last_periods}
	
	<table cellpadding="2" cellspacing="1" border="0">
		{foreach from=$last_payouts item=period}
		<tr>
			<td>
			{assign var="time_from" value=$period.range.start|date_format:"`$settings.Appearance.date_format`"|escape:url}
			{assign var="time_to" value=$period.range.end|date_format:"`$settings.Appearance.date_format`"|escape:url}
			{if $period.amount > 0}<a href="{"aff_statistics.approve?partner_id=`$partner.user_id`&amp;plan_id=`$partner.plan_id`&amp;period=C&amp;time_from=`$time_from`&amp;time_to=`$time_to`"|fn_url}">{/if}{$period.range.start|date_format:$settings.Appearance.date_format}{if $period.amount > 0}</a>{/if}</td>
			<td>{include file="views/sales_reports/components/graph_bar.tpl" bar_width="300px" value_width=$period.amount/$max_amount*100|round}</td>
			<td align="right">{include file="common_templates/price.tpl" value=$period.amount}</td>
		</tr>
		{/foreach}
		<tr>
			<td colspan="3" align="right"><p>{$lang.total_commissions}:&nbsp;<span>{include file="common_templates/price.tpl" value=$total_commissions}</span></p></td>
		</tr>
	</table>
	</td>
</tr>
</table>

{include file="common_templates/subheader.tpl" title=$lang.affiliate_tree}
<div class="items-container multi-level">
{include file="addons/affiliate/views/partners/components/partner_tree.tpl" partners=$partners header=1 level=0}
</div>
{/capture}
{include file="common_templates/view_tools.tpl" url="partners.update?user_id="}
{include file="common_templates/mainbox.tpl" title="`$lang.viewing_affiliate`: `$partner.firstname` `$partner.lastname`" content=$smarty.capture.mainbox extra_tools=$smarty.capture.extra_tools tools=$smarty.capture.view_tools}

</form>