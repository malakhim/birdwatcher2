<html>
<head></head>
{literal}
<style type="text/css">
body,th,td,tt,div,span,p {
	font-family: Arial, sans-serif;
	font-size: 13px;
	padding: 0px;
	margin: 0px;
}
</style>
{/literal}
<body>
{include file="common_templates/scripts.tpl"}
	<table  width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td align="center">
				
				<table cellpadding="0" cellspacing="0" width="600px" style="background-color: #1396ee;">
					<tr height="81px" valign="top" background="{$images_dir}/certificat_h.png">
						<td>

							<table>
								<tr>
									<td width="325px">
										<img src="{$images_dir}/{$manifest.Gift_certificate_logo.filename}" width="$manifest.Gift_certificate_logo.width}" height="{$manifest.Gift_certificate_logo.height}" border="0" alt="{$manifest.Gift_certificate_logo.alt}" style="margin: 20px 0px 8px 18px;" />
									</td>

									<td>
										<h4 style="padding: 17px 0px 0px 0px; margin: 0px; text-transform: uppercase; color: #7f7f80; font-weight: normal">{$lang.gift_cert_code}</h4>
										<h1 style="padding: 0px; margin: 0px; font-size: 23px;">
											{$gift_cert_data.gift_cert_code}
										</h1>
									</td>
								</tr>
							</table>

						</td>
					</tr>

					<tr>
						<td background="{$images_dir}/certificat_bg.png">
							
							<table cellpadding="0" cellspacing="0" width="100%">
								<tr>
									<td width="340px" valign="top">
										<div style="padding: 15px 0px 0px 18px; color: #ffffff">
											<h1 style="padding: 0; margin: 0; font: bold 25px Arial; text-transform: uppercase">{$lang.gift_certificate}
											</h1>
											<p style="color: #ffffff; padding: 10px 0px 0px 0px; margin: 0px">
												{$lang.gift_cert_from}: {$gift_cert_data.sender}
											</p>
											<p style="color: #ffffff; padding: 5px 0px 10px 0px; margin: 0px; border-bottom: 1px dashed #72c0f5;">
												{$lang.gift_cert_to}: {$gift_cert_data.recipient}

												{if $gift_cert_data.send_via == 'P'}
												{$gift_cert_data.address}<br />
												{if $gift_cert_data.address_2}{$gift_cert_data.address_2}<br />{/if}
												{if $gift_cert_data.phone}{$gift_cert_data.phone}<br />{/if}
												{$gift_cert_data.city},&nbsp;{$gift_cert_data.descr_country},&nbsp;{$gift_cert_data.descr_state}<br />
												{$gift_cert_data.zipcode}
												{/if}
											</p>

											{if $gift_cert_data.message}
											<div style="color: #afdbf9; padding: 10px 0px 0px 0px; margin: 0px;">
												{$gift_cert_data.message|unescape}
											</div>
											{/if}

										</div>
									</td>
									<td align="left" width="300px" height="210px" valign="top"  background="{$images_dir}/certificate_cart2.png" style="background-repeat: no-repeat">
										<h1 style="padding: 64px 125px 0px 35px; margin: 0; text-align: center; color: black; font-size: 40px">
											{include file="common_templates/price.tpl" value=$gift_cert_data.amount}
										</h1>
									</td>
								</tr>
							</table>

							<table>
								<tr>
									<td style="padding-left: 5px">
										{if $gift_cert_data.products && $addons.gift_certificates.free_products_allow == 'Y'}
										<div style="margin: 12px 0px 0px 10px;">
											<h5 style="text-transform: uppercase; padding: 0px 0px 10px 0px; margin: 0; font-size: 15px; color: #ffffff;">{$lang.free_products}:</h5>
											<table border="0" cellpadding="10" cellspacing="10">
												{foreach from=$gift_cert_data.products item="product"}
												<tr valign="top">
													<td><span style="color: #ffffff; line-height: 20px; font-weight: bold">{$product.amount}</span>&nbsp;</td><td><a href="{$gift_cert_data.http_location}/{"products.view?product_id=`$product.product_id`"|fn_url:'C':'rel':'&'}" class="product-link" style="color: #ffffff; line-height: 20px;">{$product.product}</a><br />
													<span style="color: #afdbf9">
													{include file="common_templates/options_info.tpl" product_options=$product.product_options_value}</span><br /></td>
													{/foreach}
												</tr>
											</table>
										</div>
										{/if}											
									</td>
								</tr>	
							</table>

							<table cellspacing="0" cellpadding="0" width="100%">
								<tr>
									<td background="{$images_dir}/gift_m.png" style="background-repeat: no-repeat; height: 52px;">
										<div style="text-align: right;color: #ffffff; padding: 30px 5px 5px 0px">
											<b>{$lang.shop_now}:</b>&nbsp;<a href="{$gift_cert_data.http_location}" target="_blank" class="action-text-button" style="white-space: nowrap; margin-right: 1px; text-decoration: underline; padding: 2px 5px 2px 0px; color: #ffffff;">{$gift_cert_data.http_location}</a>
										</div>
									</td>
								</tr>
							</table>

						</td>
					</tr>

					<tr height="5px">
						<td background="{$images_dir}/certificat_b.png"></td>
					</tr>
				</table>

			</td>
		</tr>
	</table>
</body>
</html>