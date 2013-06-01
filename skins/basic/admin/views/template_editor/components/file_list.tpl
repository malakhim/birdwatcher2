<table cellspacing="0" cellpadding="1" border="0" width="100%">
<tr>
	{foreach from=$columns item="col" name="it"}
	<td valign="top" width="50%">
		<table cellspacing="0" cellpadding="2" border="0" width="100%">
		{foreach from=$col item="item" name="it"}
		{assign var="forbidden" value=false}
		{if $item.type == "F"}
			{assign var="file_ext" value=""}
			{if $item.ext == "gif"}{assign var="file_ext" value="gif"}{/if}
			{if $item.ext == "jpg"}{assign var="file_ext" value="jpg"}{/if}
			{if $item.ext == "png"}{assign var="file_ext" value="png"}{/if}
			{if $item.ext == "html" || $item.ext == "htm"}{assign var="file_ext" value="html"}{/if}
			{if $item.ext == "tgz" || $item.ext == "zip" || $item.ext == "zip2" || $item.ext == "gz" || $item.ext == "bz" || $item.ext == "rar"}{assign var="file_ext" value="zip"}{/if}
			{if $item.ext == "tpl" || $item.ext == "txt"}{assign var="file_ext" value="tpl"}{/if}
			{if $item.ext == "php"}{assign var="file_ext" value="php"}{/if}
			{if $item.ext == "css"}{assign var="file_ext" value="css"}{/if}
			{if $item.ext == "js"}{assign var="file_ext" value="js"}{/if}
			{if $item.ext|in_array:$config.forbidden_file_extensions}{assign var="forbidden" value=true}{/if}
		{/if}
		{if $file_ext == 'gif' || $file_ext == 'jpg' || $file_ext == 'png'}
			{assign var="image_id" value="image"|uniqid}
			{include file="common_templates/previewer.tpl" rel=$image_id}
		{else}
			{assign var="image_id" value=false}
		{/if}
		<tr id="row_{$item.name}" title="{$item.perms}" class="items">
			<td onclick="template_editor.select_file('{$item.name|escape:javascript}', '{$item.type}')" {if !$image_id}ondblclick="{if $item.type == "D"}template_editor.chdir('{$item.name|escape:javascript}');{elseif !$forbidden}template_editor.show_content('{$item.name|escape:javascript}');{/if}"{/if} align="center">
				{if $image_id}<a id="image_{$image_id}" href="{$config.current_location}{$current_path}/{$item.name|escape:javascript}" class="cm-previewer" rel="{$image_id}">{else}<a href="javascript:{if $item.type == "D"}template_editor.chdir('{$item.name|escape:javascript}');{elseif !$forbidden}template_editor.show_content('{$item.name|escape:javascript}');{/if}">{/if}<img src="{$images_dir}/icons/icon_{if $item.type == "D"}folder{$item.skin_type}{if $item.name == ".."}_up{/if}{else}{$file_ext|default:"file"}{/if}.png" alt="" border="0" /></a>
			</td>
			<td onclick="template_editor.select_file('{$item.name|escape:javascript}', '{$item.type}')" {if !$image_id}ondblclick="{if $item.type == "D"}template_editor.chdir('{$item.name|escape:javascript}');{elseif !$forbidden}template_editor.show_content('{$item.name|escape:javascript}');{/if}"{/if} width="100%">
				{if !$forbidden}<div class="float-right hidden cm-download"><a href="javascript: template_editor.get_file();"><img src="{$images_dir}/icons/icon_download.png" width="16" height="16" border="0" alt="{$lang.download}" title="{$lang.download}" align="middle" /></a></div>{/if}
				{if $image_id}
				<a class="cm-external-click" rev="image_{$image_id}">{$item.name}</a>
				{else}
				<a href="javascript: void(0);">{$item.name}</a>
				{/if}
			</td>
		</tr>
		{/foreach}
		</table>
	</td>
	{/foreach}
</tr>
</table>