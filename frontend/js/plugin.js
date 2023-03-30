(function($) {
	$(function() {
		let page = $("body").data("page");

		if(page!=="undefined" && page===1) {
			let config = $('#product-configurator')
				.closest('form')
				.find('input[type="radio"], input[type="text"], input[type="checkbox"], input[type="number"], select');

			config.on("click", function() {
				let $el = $(this);
				let $container = $el.parents(".js-cfg-group-collapse").find(".group-description");

				if($('#buy_form').length > 0) {
					let form = $.evo.io().getFormValues('buy_form');
					form.value = $(this).attr("value");
					form.group = $(this).parents(".cfg-group").data("id");

					let context = {};
					$.evo.io().call("loadConfigurationImage", [form], context, function(error, data) {
						$container.empty().html(data.image);
					});
				}
			});
		}
	});
})(jQuery);