{if $display == "text"}
	<span class="view-status">
		{if $status == "A"}
			{$lang.active}
		{elseif $status == "H"}
			{$lang.hidden}
		{elseif $status == "D"}
			{$lang.disabled}
		{elseif $status == "P"}
			{$lang.pending}
		{elseif $status == "N"}
			{$lang.new}
		{/if}
	</span>
{else}
	{assign var="prefix" value=$prefix|default:"select"}
	<div class="select-popup-container {$popup_additional_class}">
		{if !$hide_for_vendor}
		<div {if $id}id="sw_{$prefix}_{$id}_wrap"{/if} class="{if $statuses[$status].color}selected-status-base{else}selected-status status-{if $suffix}{$suffix}-{/if}{$status|lower}{/if}{if $id} cm-combo-on cm-combination{/if}">
			<a {if $id}class="cm-combo-on{if !$popup_disabled} cm-combination{/if}"{/if}>
		{/if}
			{if $items_status}
				{if !$items_status|is_array}
					{assign var="items_status" value=$items_status|fn_from_json}
				{/if}
				{$items_status.$status}
			{else}
				{if $status == "A"}
					{$lang.active}
				{elseif $status == "D"}
					{$lang.disabled}
				{elseif $status == "H"}
					{$lang.hidden}
				{elseif $status == "P"}
					{$lang.pending}
				{elseif $status == "N"}
					{$lang.new}
				{/if}
			{/if}
		{if !$hide_for_vendor}
			</a>
			{if $statuses[$status].color}
			<span class="selected-status-icon" style="background-color: #{$statuses[$status].color}">&nbsp;</span>
			{/if}

		</div>
		{/if}
		{if $id && !$hide_for_vendor}
			{assign var="_update_controller" value=$update_controller|default:"tools"}
			{if $table && $object_id_name}{capture name="_extra"}&amp;table={$table}&amp;id_name={$object_id_name}{/capture}{/if}
			<div id="{$prefix}_{$id}_wrap" class="popup-tools cm-popup-box cm-smart-position hidden">
				<div class="status-scroll-y">
				<ul class="cm-select-list">
				{if $items_status}
					{foreach from=$items_status item="val" key="st"}
					<li><a class="{if $confirm}cm-confirm {/if}status-link-{$st|lower} {if $status == $st}cm-active{else}cm-ajax{/if}"{if $status_rev} rev="{$status_rev}"{/if} href="{"`$_update_controller`.update_status?id=`$id`&amp;status=`$st``$smarty.capture._extra``$extra`"|fn_url}" onclick="return fn_check_object_status(this, '{$st|lower}', '{if $statuses}{$statuses[$st].color|default:''}{/if}');" name="update_object_status_callback">{$val}</a></li>
					{/foreach}
				{else}
					<li><a class="{if $confirm}cm-confirm {/if}status-link-a {if $status == "A"}cm-active{else}cm-ajax{/if}"{if $status_rev} rev="{$status_rev}"{/if} href="{"`$_update_controller`.update_status?id=`$id`&amp;table=`$table`&amp;id_name=`$object_id_name`&amp;status=A`$dynamic_object`"|fn_url}" onclick="return fn_check_object_status(this, 'a', '');" name="update_object_status_callback">{$lang.active}</a></li>
					<li><a class="{if $confirm}cm-confirm {/if}status-link-d {if $status == "D"}cm-active{else}cm-ajax{/if}"{if $status_rev} rev="{$status_rev}"{/if} href="{"`$_update_controller`.update_status?id=`$id`&amp;table=`$table`&amp;id_name=`$object_id_name`&amp;status=D`$dynamic_object`"|fn_url}" onclick="return fn_check_object_status(this, 'd', '');" name="update_object_status_callback">{$lang.disabled}</a></li>
					{if $hidden}
					<li><a class="{if $confirm}cm-confirm {/if}status-link-h {if $status == "H"}cm-active{else}cm-ajax{/if}"{if $status_rev} rev="{$status_rev}"{/if} href="{"`$_update_controller`.update_status?id=`$id`&amp;table=`$table`&amp;id_name=`$object_id_name`&amp;status=H`$dynamic_object`"|fn_url}" onclick="return fn_check_object_status(this, 'h', '');" name="update_object_status_callback">{$lang.hidden}</a></li>
					{/if}
					{* if vendor is new, let admin change status to pending *}
					{if $status == "N"}
					<li><a class="{if $confirm}cm-confirm {/if}status-link-p {if $status == "P"}cm-active{else}cm-ajax{/if}"{if $status_rev} rev="{$status_rev}"{/if} href="{"`$_update_controller`.update_status?id=`$id`&amp;table=`$table`&amp;id_name=`$object_id_name`&amp;status=P`$dynamic_object`"|fn_url}" onclick="return fn_check_object_status(this, 'p', '');" name="update_object_status_callback">{$lang.pending}</a></li>
					{/if}
				{/if}
				</ul>
				</div>
				{capture name="list_items"}
				{if $notify}
					<li class="select-field">
						<input type="checkbox" name="__notify_user" id="{$prefix}_{$id}_notify" value="Y" class="checkbox" checked="checked" onclick="$('input[name=__notify_user]').attr('checked', this.checked);" />
						<label for="{$prefix}_{$id}_notify">{$notify_text|default:$lang.notify_customer}</label>
					</li>
				{/if}
				{if $notify_department}
					<li class="select-field notify-department">
						<input type="checkbox" name="__notify_department" id="{$prefix}_{$id}_notify_department" value="Y" class="checkbox" checked="checked" onclick="$('input[name=__notify_department]').attr('checked', this.checked);" />
						<label for="{$prefix}_{$id}_notify_department">{$lang.notify_orders_department}</label>
					</li>
				{/if}
				
				{if $notify_supplier}
					<li class="select-field notify-department">
						<input type="checkbox" name="__notify_supplier" id="{$prefix}_{$id}_notify_supplier" value="Y" class="checkbox" checked="checked" onclick="$('input[name=__notify_supplier]').attr('checked', this.checked);" />
						<label for="{$prefix}_{$id}_notify_supplier">{if $smarty.const.PRODUCT_TYPE == "MULTIVENDOR" || $smarty.const.PRODUCT_TYPE == "ULTIMATE"}{$lang.notify_vendor}{else}{$lang.notify_supplier}{/if}</label>
					</li>
				{/if}
				
				{/capture}
				
				{if $smarty.capture.list_items|trim}
				<ul class="cm-select-list select-list-tools">
					{$smarty.capture.list_items}
				</ul>
				{/if}
			</div>
			{if !$smarty.capture.avail_box}
			<script type="text/javascript">
			//<![CDATA[
			{literal}
			function fn_check_object_status(obj, status, color) 
			{
				if ($(obj).hasClass('cm-active')) {
					$(obj).removeClass('cm-ajax');
					return false;
				}
				fn_update_object_status(obj, status, color);
				return true;
			}
			function fn_update_object_status_callback(data, params) 
			{
				if (data.return_status && params.obj) {
					var color = data.color ? data.color : '';
					fn_update_object_status(params.obj, data.return_status.toLowerCase(), color);
				}
			}
			function fn_update_object_status(obj, status, color)
			{
				var upd_elm_id = $(obj).parents('.cm-popup-box:first').attr('id');
				var upd_elm = $('#' + upd_elm_id);
				upd_elm.hide();
				$(obj).attr('href', fn_query_remove($(obj).attr('href'), ['notify_user', 'notify_department']));
				if ($('input[name=__notify_user]:checked', upd_elm).length) {
					$(obj).attr('href', $(obj).attr('href') + '&notify_user=Y');
				}
				if ($('input[name=__notify_department]:checked', upd_elm).length) {
					$(obj).attr('href', $(obj).attr('href') + '&notify_department=Y');
				}
				
				if ($('input[name=__notify_supplier]:checked', upd_elm).length) {
					$(obj).attr('href', $(obj).attr('href') + '&notify_supplier=Y');
				}
				
				$('.cm-select-list li a', upd_elm).removeClass('cm-active').addClass('cm-ajax');
				$('.status-link-' + status, upd_elm).addClass('cm-active');
				$('#sw_' + upd_elm_id + ' a').text($('.status-link-' + status, upd_elm).text());
				if (color) {
					$('#sw_' + upd_elm_id).removeAttr('class').addClass('selected-status-base ' + $('#sw_' + upd_elm_id + ' a').attr('class'));
					$('#sw_' + upd_elm_id).children('.selected-status-icon:first').css('background-color', '#' + color);
				} else {
					{/literal}
					$('#sw_' + upd_elm_id).removeAttr('class').addClass('selected-status status-{if $suffix}{$suffix}-{/if}' + status + ' ' + $('#sw_' + upd_elm_id + ' a').attr('class'));
					{literal}
				}
			}
			{/literal}
			//]]>
			</script>
			{capture name="avail_box"}Y{/capture}
			{/if}
		{/if}
	</div>
{/if}