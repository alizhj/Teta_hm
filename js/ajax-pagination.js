var $ = jQuery;

$(document).ready(function() {

	function find_page_number( element ) {
		element.find('span').remove();
		return parseInt( element.html() );
	}

	$('.nav-links a').on('click', function(e) {
		e.preventDefault();
		console.log('clicked link');

		page = find_page_number( $(this).clone() );

		$.ajax({
			url: ajaxpagination.ajaxurl,
			type: 'post',
			data: {
				action: 'ajax_pagination',
				query_vars: ajaxpagination.query_vars,
				page: page
			},
			success: function( html ) {
				$('.mix').find( '#clothes' ).remove();
				$('.mix nav').remove();
				$('.mix #clothes').append( html );
			}
		});
	});
});
