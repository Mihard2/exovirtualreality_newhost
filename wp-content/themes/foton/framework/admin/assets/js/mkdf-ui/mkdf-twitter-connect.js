(function($) {
    "use strict";

	$(document).ready(function () {
		mkdfTwitterRequestToken();
	});
	
	function mkdfTwitterRequestToken() {
		var twButton = $('#mkdf-tw-request-token-btn');
		
		if (twButton.length) {
			twButton.on('click', function (e) {
				e.preventDefault();
				
				var thisButton = $(this),
					currentPageUrl = $('input[data-name="current-page-url"]').val();
				
				//@TODO get this from data attr
				thisButton.text('Working...');
				
				var data = {
					action: 'mkdf_twitter_obtain_request_token',
					currentPageUrl: currentPageUrl
				};
				
				$.ajax({
					type: 'POST',
					url: ajaxurl,
					data: data,
					dataType: 'json',
					success: function (response) {
						if (typeof response.status !== 'undefined' && response.status) {
							thisButton.text('Redirect to Twitter...');
							
							if (typeof response.redirectURL !== 'undefined' && response.redirectURL !== '') {
								window.location = response.redirectURL;
							}
						} else {
							alert(response.message);
						}
					}
				});
			});
		}
	}
	
})(jQuery);