<div id="content_description_{$group_id}">

<table cellpadding="10" cellspacing="0" border="0" width="100%" >
<tr>
	<td>
	<table cellpadding="0" cellspacing="0" border="0" width="100%">
	<tr>
		<td valign="top" class="center product-image">
			{include file="common_templates/image.tpl" show_detailed_link=true obj_id=$product_configurator_group.group_id images=$product_configurator_group.main_pair object_type="conf_group" rel="pconf_group_`$product_configurator_group.group_id`" show_thumbnail="Y" image_width=$addons.product_configurator.thumbnails_width}</td>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td valign="top" width="100%">
			<div class="product-details-title">{$product_configurator_group.configurator_group_name}</div>
			<p>{$product_configurator_group.full_description|unescape}</p>
		</td>
	</tr>
    </table>
    </td>
</tr>
</table>

{include file="common_templates/previewer.tpl" rel="pconf_group_`$product_configurator_group.group_id`"}

<!--content_description_{$group_id}--></div>