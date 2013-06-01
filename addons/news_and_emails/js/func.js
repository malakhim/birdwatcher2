//
// $Id: func.js 6929 2009-02-20 07:01:33Z zeke $
//

function fn_news_and_emails_add_js_item(data)
{
	if (data.var_prefix == 'n') {
		data.append_obj_content = data.object_html.str_replace('{news_id}', data.var_id).str_replace('{news}', data.item_id);
	}
}

$(function(){
	$('.cm-news-subscribe').live('click', function(e) {
		var elms = $(this).parents('.subscription-container').find('.cm-news-subscribe');
		var params = '';

		if (elms.length > 0) {
			elms.each(function(){
				if ($(this).attr('name').length > 0) {
					if ($(this).is(':checked')) {
						params += $(this).attr('name') + '=' + $(this).val() + '&';
					}
				}
			});
		}

		if (!params) {
			params = 'mailing_lists=';
		}

		$.ajaxRequest(fn_url('checkout.subscribe_customer?' + params), {method: 'post', result_ids: 'subsciption*'});
	});
});