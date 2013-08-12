{if $order_info.total|floatval}

{if $smarty.request.payment_id}
{literal}
<script type="text/javascript">
//<![CDATA[
	$(function() {
		$.scrollToElm($('#repay_order'));
	});
//]]>
</script>
{/literal}
{/if}
{script src="js/cc_validator.js"}
<h2 class="step-title-active clearfix" id="repay_order"><span class="title">{$lang.repay_order}</span></h2>
<p>
	{include file="views/orders/components/payment_methods.tpl" order_payment_id=$order_payment_id|default:$order_info.payment_id}
</p>
{/if}