a:2:{s:4:"data";s:1054:"<products>
	<item title="bb_billibuys" dispatch="billibuys.view" />
</products>
<customers>
	<item title="vendor_administrators" dispatch="profiles.manage" extra="user_type=V" position="250" />
</customers>

<products>
	<item title="bb_billibuys" links_group="products" dispatch="billibuys.view" position="10" />
	<!--item title="bb_packages" links_group="products" dispatch="billibuys.packages_view" position="20" -->
</products>

<vendors>
	<item title="vendors" links_group="vendors" dispatch="companies.manage" position="100" />

	<side>
		<item group="companies.update" title="view_vendor_products" href="%INDEX_SCRIPT?dispatch=products.manage&amp;company_id=%COMPANY_ID" />
		<item group="companies.update" title="view_vendor_users" href="%INDEX_SCRIPT?dispatch=profiles.manage&amp;company_id=%COMPANY_ID" />
		<item group="companies.update" title="view_vendor_orders" href="%INDEX_SCRIPT?dispatch=orders.manage&amp;company_id=%COMPANY_ID" />
	</side>
	<item title="vendor_account_balance" dispatch="companies.balance" position="200" />
</vendors>
";s:6:"expiry";i:0;}