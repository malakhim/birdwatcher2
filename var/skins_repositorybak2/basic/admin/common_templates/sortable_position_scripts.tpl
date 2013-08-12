<script type="text/javascript">
//<![CDATA[
$(function() {$ldelim}
	var params = {$ldelim}{$rdelim};
		params.text_position_updating = '{$lang.text_position_updating}';
		params.update_sortable_url = '{"tools.update_position?table=`$sortable_table`&id_name=`$sortable_id_name`"|fn_url:'A':'rel':'&'}';
		params.handle_class = '{$handle_class}';

	var sortable_id = '{if $sortable_id}#{$sortable_id}{else}{/if}';
	
	$(sortable_id + '.cm-sortable').ceSortable(params);
{$rdelim});

//]]>
</script>