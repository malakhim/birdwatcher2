{script src="lib/js/colorpicker/js/colorpicker.js"}

<script type="text/javascript" class="cm-ajax-force">
//<![CDATA[
{literal}
$.loadCss(['/lib/js/colorpicker/css/colorpicker.css']);
$(function(){
	$('.cm-colorpicker').each(function() {
		var elm = $(this);
		var id_inut = elm.attr('id').replace(/select_/, '');
		var color_input = $('#' + id_inut);

		if (elm.parents('.cm-hide-inputs').length == 0) {
			elm.ColorPicker(
			{
				onSubmit: function(hsb, hex, rgb, el) {
					$(el).css('background-color', '#' + hex);
					color_input.val(hex);
					$(el).ColorPickerHide();
				},
				onShow: function (ev) {
					var cal = $('#' + $(this).data('colorpickerId'));
					cal.css({'z-index': 1010});
				},
				onBeforeShow: function () {
					$(this).ColorPickerSetColor(color_input.val());
				}
			});
		};

		color_input.bind('keyup', function() {
			var  color = $(this).val();
			elm.ColorPickerSetColor(color);
			elm.css('background-color', '#' + color);
		});
		// hide picker on escape
		$(document).keydown(function(e) {
			if (e.keyCode == 27) {
				elm.ColorPickerHide();
			}
		});
	});
});
{/literal}
//]]>
</script>