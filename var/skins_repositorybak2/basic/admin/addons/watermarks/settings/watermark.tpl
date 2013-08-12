{* $Id: manage.tpl 9517 2010-05-19 14:02:43Z klerik $ *}
{literal}
<style type="text/css">
.wt_position_bg{
	border:1px solid #dadbd1;
	background-color:#f5f6ea;
	height:74px;
	width:150px;
}
.wt_td_radio_position{
	text-align:center;
	vertical-align:middle;
	height:10px;
	width:25px;
}
</style>
{/literal}


<div class="form-field">
	<label for="type" class="cm-required">{$lang.type}:</label>
	<select name="wt_settings[type]" id="type" class="input-text" onchange="$('#wt_graphic_watermark').switchAvailability();  $('#wt_text_watermark').switchAvailability();">
		<option {if $wt_settings.type == "G"}selected="selected"{/if} value="G">{$lang.wt_graphic_watermark}</option>
		<option {if $wt_settings.type == "T"}selected="selected"{/if} value="T">{$lang.wt_text_watermark}</option>
	</select>
</div>

<div class="form-field" id="wt_graphic_watermark">
	<label>{$lang.wt_watermark_image}:</label>
	<div class="float-left">
		{include file="common_templates/attach_images.tpl" image_name="wt_image" image_object_type="watermark" image_pair=$wt_settings.image_pair image_object_id=$smarty.const.WATERMARK_IMAGE_ID icon_title=$lang.wt_watermark_icon detailed_title=$lang.wt_watermark_detailed hide_alt=true}
	</div>
</div>

<div id="wt_text_watermark">
<div class="form-field">
	<label for="text" class="cm-required">{$lang.wt_watermark_text}:</label>
	<input type="text" name="wt_settings[text]" id="text" value="{$wt_settings.text}" size="25" class="input-text-large" />
</div>

<div class="form-field">
	<label for="wt_font" class="">{$lang.wt_font}:</label>
	<select name="wt_settings[font]" id="wt_font">
		{foreach from=$wt_fonts item="font" key="f"}
		<option {if $wt_settings.font == $f}selected="selected"{/if} value="{$f}">{$font}</option>
		{/foreach}
	</select>
</div>

<div class="form-field">
	<label for="wt_font_color" class="">{$lang.wt_font_color}:</label>
	<select name="wt_settings[font_color]" id="wt_font_color">
		{foreach from=$wt_font_colors item="color" key="c"}
		<option {if $wt_settings.font_color == $c}selected="selected"{/if} value="{$c}">{$color}</option>
		{/foreach}
	</select>
</div>

<div class="form-field">
	<label for="wt_font_size" class="">{$lang.wt_font_size_icon}:</label>
	<select name="wt_settings[font_size_icon]" id="wt_font_size">
		{foreach from=$wt_font_sizes item="size"}
		<option {if $wt_settings.font_size_icon == $size}selected="selected"{/if} value="{$size}">{$size}px</option>
		{/foreach}
	</select>
</div>

<div class="form-field">
	<label for="wt_font_size" class="">{$lang.wt_font_size_detailed}:</label>
	<select name="wt_settings[font_size_detailed]" id="wt_font_size">
		{foreach from=$wt_font_sizes item="size"}
		<option {if $wt_settings.font_size_detailed == $size}selected="selected"{/if} value="{$size}">{$size}px</option>
		{/foreach}
	</select>
</div>
</div>

<script type="text/javascript">
	//<![CDATA[
	$(function(){$ldelim}
		{if $wt_settings.type == "T"}
			$('#wt_graphic_watermark').switchAvailability(true);
		{else}
			$('#wt_text_watermark').switchAvailability(true);
		{/if}
	{$rdelim});
	//]]>
</script>

<div class="form-field">
	<label for="position">{$lang.wt_watermark_position}:</label>
	<div class="select-field wt_position_bg">
<table cellpadding="0" cellspacing="0" border="0" width="100%">
<tr>
	<td class="wt_td_radio_position"><input name="wt_settings[position]" type="radio" value="left_top" {if $wt_settings.position == "left_top"}checked="checked"{/if}></td>
	<td class="wt_td_radio_position"></td>
	<td class="wt_td_radio_position"><input name="wt_settings[position]" type="radio" value="center_top" {if $wt_settings.position == "center_top"}checked="checked"{/if}></td>
	<td class="wt_td_radio_position"></td>
	<td class="wt_td_radio_position"><input name="wt_settings[position]" type="radio" value="right_top" {if $wt_settings.position == "right_top"}checked="checked"{/if}></td>
</tr>
<tr><td class="wt_td_radio_position"></td></tr>
<tr>
	<td class="wt_td_radio_position"><input name="wt_settings[position]" type="radio" value="left_center" {if $wt_settings.position == "left_center"}checked="checked"{/if}></td>
	<td class="wt_td_radio_position"></td>
	<td class="wt_td_radio_position"><input name="wt_settings[position]" type="radio" value="center_center" {if $wt_settings.position == "center_center"}checked="checked"{/if}></td>
	<td class="wt_td_radio_position"></td>
	<td class="wt_td_radio_position"><input name="wt_settings[position]" type="radio" value="right_center" {if $wt_settings.position == "right_center"}checked="checked"{/if}></td>
</tr>
<tr><td class="wt_td_radio_position"></td></tr>
<tr>
	<td class="wt_td_radio_position"><input name="wt_settings[position]" type="radio" value="left_bottom" {if $wt_settings.position == "left_bottom"}checked="checked"{/if}></td>
	<td class="wt_td_radio_position"></td>
	<td class="wt_td_radio_position"><input name="wt_settings[position]" type="radio" value="center_bottom" {if $wt_settings.position == "center_bottom"}checked="checked"{/if}></td>
	<td class="wt_td_radio_position"></td>
	<td class="wt_td_radio_position"><input name="wt_settings[position]" type="radio" value="right_bottom" {if !$wt_settings.position || $wt_settings.position == "right_bottom"}checked="checked"{/if}></td>
</tr>
</table>

	</div>
</div>



