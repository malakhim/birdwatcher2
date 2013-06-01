$(function(){

	function split( val )
	{
		return val.split( /,\s*/ );
	}

	function extractLast(term)
	{
		return split(term).pop();
	}

	$('#elm_my_tags').autocomplete({
		source: function( request, response ) {
			$.ajaxRequest(fn_url('tags.list?q=' + extractLast(request.term)), {callback: function(data) {
				response(data.autocomplete);
			}});
		},
		search: function() {
			// custom minLength
			var term = extractLast( this.value );
			if ( term.length < 2 ) {
				return false;
			}
		},
		focus: function() {
			// prevent value inserted on focus
			return false;
		},
		select: function( event, ui ) {
			var terms = split( this.value );
			// remove the current input
			terms.pop();
			// add the selected item
			terms.push( ui.item.value );
			// add placeholder to get the comma-and-space at the end
			terms.push( "" );
			this.value = terms.join( ", " );
			return false;
		}
	});
});