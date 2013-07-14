{include file="common_templates/subheader.tpl" title=$lang.promotions}

{foreach from=$promotions item="promotion" name="pfe" key="promotion_id"}
<h5 class="info-field-title">{$promotion.name}</h5>

{foreach from=$order_info.promotions.$promotion_id.bonuses item="bonus"}
{if $bonus.bonus == "give_coupon"}
<div class="form-field">
	<label>{$lang.coupon_code}:</label>
	{$bonus.coupon_code}
</div>
{/if}
{/foreach}


<div class="info-field-body">{$promotion.short_description|unescape}</div>
{/foreach}