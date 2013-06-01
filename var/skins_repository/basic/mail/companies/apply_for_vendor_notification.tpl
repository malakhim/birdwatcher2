{assign var="company_update_url" value="companies.update?company_id=`$company_id`"|fn_url:'A':'http':'&':$smarty.const.CART_LANGUAGE:true}
{$lang.vendor_candidate_notification|replace:'<a>':"<a href=$company_update_url>"}

<br/><br/>

<table>
	<tr>
		<td class="form-field-caption" nowrap>{$lang.company_name}:&nbsp;</td>
		<td >{$company.company}</td>
	</tr>
	{if $company.company_description}
	<tr>
		<td class="form-field-caption" nowrap>{$lang.description}:&nbsp;</td>
		<td >{$company.company_description}</td>
	</tr>
	{/if}
	{if $company.request_account_name}
	<tr>
		<td class="form-field-caption" nowrap>{$lang.account_name}:&nbsp;</td>
		<td >{$company.request_account_name}</td>
	</tr>
	{/if}
	{if $company.admin_firstname}
	<tr>
		<td class="form-field-caption" nowrap>{$lang.first_name}:&nbsp;</td>
		<td >{$company.admin_firstname}</td>
	</tr>
	{/if}
	{if $company.admin_lastname}
	<tr>
		<td class="form-field-caption" nowrap>{$lang.last_name}:&nbsp;</td>
		<td >{$company.admin_lastname}</td>
	</tr>
	{/if}
	<tr>
		<td class="form-field-caption" nowrap>{$lang.email}:&nbsp;</td>
		<td >{$company.email}</td>
	</tr>
	<tr>
		<td class="form-field-caption" nowrap>{$lang.phone}:&nbsp;</td>
		<td >{$company.phone}</td>
	</tr>
	<tr>
	{if $company.url}
		<td class="form-field-caption" nowrap>{$lang.url}:&nbsp;</td>
		<td >{$company.url}</td>
	</tr>
	{/if}
	{if $company.fax}
	<tr>
		<td class="form-field-caption" nowrap>{$lang.fax}:&nbsp;</td>
		<td >{$company.fax}</td>
	</tr>
	{/if}
	<tr>
		<td class="form-field-caption" nowrap>{$lang.address}:&nbsp;</td>
		<td >{$company.address}</td>
	</tr>
	<tr>
		<td class="form-field-caption" nowrap>{$lang.city}:&nbsp;</td>
		<td >{$company.city}</td>
	</tr>
	<tr>
		<td class="form-field-caption" nowrap>{$lang.country}:&nbsp;</td>
		<td >{$company.country}</td>
	</tr>
	<tr>
		<td class="form-field-caption" nowrap>{$lang.state}:&nbsp;</td>
		<td >{$company.state}</td>
	</tr>
	<tr>
		<td class="form-field-caption" nowrap>{$lang.zip_postal_code}:&nbsp;</td>
		<td >{$company.zipcode}</td>
	</tr>
</table>