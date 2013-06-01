function fn_banners_add_js_item(data)
{
	if (data.var_prefix == 'b') {
		data.append_obj_content = data.object_html.str_replace('{banner_id}', data.var_id).str_replace('{banner}', data.item_id);
	}
}