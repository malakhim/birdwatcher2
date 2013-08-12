{if $smarty.const.CONTROLLER == "products" && $smarty.const.MODE == "options"}
	{include file="addons/recurring_billing/views/products/components/recurring_plans.tpl" obj_id=$obj_id}
{/if}