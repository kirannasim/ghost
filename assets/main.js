var stripeKey = "pk_test_51JRk8NDVZh2Lq3ZogcoKAvg8G9jLOqUPY1xKWxq9wX1arpW102ru0ezBvA52CkFjBpxK4pZGEn8wbjP3QGIzk1Ue000Lidpbvr";

$(function() {
      
	function resize_block($el, $gap) {
		$($el).css("max-height","calc(100vh - "+($($el).offset().top+$gap)+"px)");
	}
	$('.rest_page_hegiht').each(function(){
		resize_block($(this), 30);
	});
	$('.p-methods .pm').click(function() {
		$('.p-methods .active, .pay-tabs form.active').removeClass('active');
		$(this).addClass('active');
		var f = $(this).data('target');
		console.log('form.'+f);
		$('form.'+f).addClass('active');
	})
	$('.cryptos li').click(function() {
		$('.cryptos .active').removeClass('active');
		$(this).addClass('active');
		$('#exchange').val($(this).find('b').text());
	});

	// $('.slider .prod').each(function() {
	// 	var that = $(this);
	// 	$(this).get(0).addEventListener('animationend', () => {
	// 		console.log($(that).hasClass('animate__backOutLeft'));
	// 		if($(that).hasClass('animate__backOutLeft')) $(that).removeClass('active animate__backOutLeft');
	// 	});
	// })
	$('.slider .arrows').click(function() {
		var toleft = $(this).hasClass('ar-left');
		var slider = $(this).closest('.slider');
		if(toleft) {
			var next = slider.find('.active').next().is('*') ? slider.find('.active').next() : $(slider).find('.slide').first();
		} else {
			var next = slider.find('.active').prev().is('*') ? slider.find('.active').prev() : $(slider).find('.slide').last();
		}
		if(toleft) {
			slider.find('.active').removeClass('active animate__backInLeft animate__backInRight');
			$(next).addClass('active animate__animated animate__backInLeft');
		} else {
			slider.find('.active').removeClass('active animate__backInRight animate__backInLeft');
			$(next).addClass('active animate__animated animate__backInRight');
		}
		$('form input[name="prod"]').val($(next).data('price'));
	});
	$('.notice .close').click(function() {
		$(this).closest('.notice').addClass('animate__animated animate__bounceOutRight');
	});
	$('.page-checkout .buy').click(function(e) {
		if ($('#form-paypal').hasClass('active')) {
			$('#form-paypal').attr('action', '/payments/paypal/create-order.php');
			$('#form-paypal').submit();
		}
			
	});	
	$(document).on('click', 'form',function() {
		$('.invalid').removeClass('invalid');
	});
})