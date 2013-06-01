// $Id:$

$.extend({
	vendorDataPremoderationDispatchSubmit: function(e)
	{
		if ($('form.cm-vendor-changes-confirm').formIsChanged()) {
			if (confirm(lang.text_vendor_profile_changes_notice) == false) {
				return false;
			}
		}
	}
});

$(document).submit('submit', function(e) {
	return $.vendorDataPremoderationDispatchSubmit(e);
});
