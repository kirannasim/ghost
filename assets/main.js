$(function() {
	function resize_block($el, $gap) {
		$($el).css("max-height","calc(100vh - "+($($el).offset().top+$gap)+"px)");
	}
	$('.rest_page_hegiht').each(function(){
		resize_block($(this), 30);
	});	
})