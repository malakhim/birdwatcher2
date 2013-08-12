{if $carrier == "USP"}
	{assign var="url" value="http://trkcnfrm1.smi.usps.com/PTSInternetWeb/InterLabelInquiry.do?strOrigTrackNum=`$tracking_number`"}
	{assign var="carrier_name" value=$lang.usps}
{elseif $carrier == "UPS"}
	{assign var="url" value="http://wwwapps.ups.com/WebTracking/processInputRequest?AgreeToTermsAndConditions=yes&amp;tracknum=`$tracking_number`"}
	{assign var="carrier_name" value=$lang.ups}
{elseif $carrier == "FDX"}
	{assign var="url" value="http://fedex.com/Tracking?action=track&amp;tracknumbers=`$tracking_number`"}
	{assign var="carrier_name" value=$lang.fedex}
{elseif $carrier == "AUP"}
	<form name="tracking_form{$shipment_id}" target="_blank" action="http://ice.auspost.com.au/display.asp?ShowFirstScreenOnly=FALSE&ShowFirstRecOnly=TRUE" method="post">
		<input type="hidden"  name="txtItemNumber" maxlength="13" value="{$tracking_number}" />
	</form>
	{assign var="url" value="javascript: document.tracking_form`$shipment_id`.submit();"}
	{assign var="carrier_name" value=$lang.australia_post}
{elseif $carrier == "DHL" || $shipping.carrier == "ARB"}
	<form name="tracking_form{$shipment_id}" target="_blank" method="post" action="http://track.dhl-usa.com/TrackByNbr.asp?nav=Tracknbr">
		<input type="hidden" name="txtTrackNbrs" value="{$tracking_number}" />
	</form>
	{assign var="url" value="javascript: document.tracking_form`$shipment_id`.submit();"}
	{assign var="carrier_name" value=$lang.dhl}
{elseif $carrier == "CHP"}
	{assign var="url" value="http://www.post.ch/swisspost-tracking?formattedParcelCodes=`$tracking_number`"}
	{assign var="carrier_name" value=$lang.chp}
{/if}

{capture name="carrier_name"}
{$carrier_name}
{/capture}

{capture name="carrier_url"}
{$url}
{/capture}