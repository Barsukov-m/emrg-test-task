(function($) {

	const showPopup = (html) => {
		if (!html) {
			console.error('No product data found');
			return
		}

		$('.product-popup .popup-content').html(html);
		$('.product-popup').show().css('display', 'flex');
	}

	$(document).ready(function() {
		$('.show-more-info-btn').on('click', async function(e) {
			e.preventDefault();

			const product_id = $(this).data('product_id');
			
			try {
				const response = await $.ajax({
					type: 'POST',
					url: tth_ajax.ajax_url,
					data: {
						action: 'fetch_product_info',
						product_id,
						nonce: tth_ajax.nonce
					}
				});

				if (response.success) {
					showPopup(response.data.html);
				}
			} catch (error) {
				console.error('Error fetching product info:', error);
			}
		});

		$('.product-popup').on('click', '.overlay, .close', function(e) {
			$(e.delegateTarget).hide();
		})
	});
	
})(jQuery);
