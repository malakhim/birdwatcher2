<div align="right" id="balance_total" class="clear">
	<ul class="statistic-list">
		<li>
			<em>{$lang.balance_carried_forward}:</em>
			<span class="{if $total.BCF > 0}negative-price{else}positive-price{/if}"><span>{include file="common_templates/price.tpl" value=$total.BCF}</span></span>
		</li>
		<li>
			<em>{$lang.sales_period_total}:</em>
			<span class="positive-price"><span>{include file="common_templates/price.tpl" value=$total.NO}</span></span>
		</li>
		<li>
			<em>{$lang.total_period_payout}:</em>
			<span>{include file="common_templates/price.tpl" value=$total.TPP}</span>
		</li>
		<li>
			<em>{$lang.total_amount_due}:</em>
			<span>{include file="common_templates/price.tpl" value=$total.LPM}</span>
		</li>
		<li>
			<em>{$lang.total_unpaid_balance}:</em>
			<span class="{if $total.TOB > 0}negative-price{else}positive-price{/if}"><span>{include file="common_templates/price.tpl" value=$total.TOB}</span></span>
		</li>
	</ul>
<!--balance_total--></div>