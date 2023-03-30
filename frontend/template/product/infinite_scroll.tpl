{if $loadInfiniteScroll == 2}
	{row class="row bth_more justify-content-center"}
		{col cols=12 md=4 xl=3}
			{button variant="primary" type="button" block=true}
				See more products
			{/button}
		{/col}
	{/row}
{/if}
<input type="hidden" id="pause" value="false">
{inline_script}<script>
$(".productlist-pagination, .productlist-item-info").hide();
{if $loadInfiniteScroll == 1}
	$(window).scroll(function() {
		var pause = $('#pause').val();
		
		if(($(this).scrollTop() + $(this).height()) > ($(".product-list").offset().top + $('.product-list').height()) && pause == 'false') {
			$('#pause').val('true');
			load_more();
		}
	});
{else}
	var url = $(".js-pagination-ajax[aria-label=next],.js-pagination-ajax[aria-label='weiter']").attr('href');
	if(!url){
		$('.bth_more button').attr('disabled','disabled');
	}
	$(".bth_more button" ).click(function() {
		$(this).attr('disabled','disabled');	
		load_more();
	});
{/if}
function load_more()
{
	var url = $(".js-pagination-ajax[aria-label=next],.js-pagination-ajax[aria-label='weiter']").attr('href');
	if(url) {
		$.ajax({
			url: url, 
			data: 'isAjax',
			success: function(result){
				history.pushState(null, null, url);
				var new_pagination = $(result).find('.productlist-pagination').html();
				var new_product_list = $(result).find('#product-list').html();
				$(".productlist-pagination").html(new_pagination);
				$("#product-list").append(new_product_list);
				$(".productlist-pagination, .productlist-item-info").hide();
				
				{if $loadInfiniteScroll == 1}
					$('#pause').val('false');
				{else}
					if($(result).find(".js-pagination-ajax[aria-label=next],.js-pagination-ajax[aria-label='weiter']").attr('href')){
						$('.bth_more button').removeAttr('disabled');
					}
				{/if}
			}
		});
	}
}
</script>{/inline_script}