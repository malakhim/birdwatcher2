{if $cart.use_gift_certificates}
<input type="hidden" name="cert_code" value="" />
{foreach from=$cart.use_gift_certificates item="ugc" key="ugc_key"}
	<tr>
		<td class="right nowrap"><a href="{"order_management.delete_use_certificate?gift_cert_code=`$ugc_key`"|fn_url}"><img src="{$images_dir}/icons/icon_delete.gif" width="12" height="18" border="0" alt="" align="bottom" />{$lang.delete}</a>&nbsp;<span>{$lang.gift_certificate}</span>&nbsp;(<a href="{"gift_certificates.update?gift_cert_id=`$ugc.gift_cert_id`"|fn_url}">{$ugc_key}</a>)&nbsp;<span>:</span></td>
		<td>&nbsp;</td>
		<td class="right nowrap">{include file="common_templates/price.tpl" value=$ugc.cost}</td>
	</tr>
{/foreach}
{/if}