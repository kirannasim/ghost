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
		$('form.'+f).addClass('active');
	})
	$('.cryptos li').click(function() {
		$('.cryptos .active').removeClass('active');
		$(this).addClass('active');
		$('#exchange').val($(this).find('b').text());
	});
	
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
			$('#form-paypal').submit();
		}			
	});	
	$(document).on('click', 'form',function() {
		$('.invalid').removeClass('invalid');
	});


	if($('.slider-row').is('*')) {
		$('.slider-row').each(function() {
			var slider = $(this).get(0);
			let isDown = false;
			let startX = slider.offsetLeft;
			let scrollLeft;
			slider.addEventListener('mousedown', (e) => {
				isDown = true;
				slider.classList.add('active');
				startX = e.pageX - slider.offsetLeft;
				scrollLeft = slider.scrollLeft;
			});
			slider.addEventListener('mouseleave', () => {
				isDown = false;
				slider.classList.remove('active');
			});
			slider.addEventListener('mouseup', () => {
				isDown = false;
				slider.classList.remove('active');
			});
			slider.addEventListener('mousemove', (e) => {
			if(!isDown) return;
				e.preventDefault();
				const x = e.pageX - slider.offsetLeft;
				const walk = (x - startX) * 1; //scroll-fast
				slider.scrollLeft = scrollLeft - walk;
			});

			var p = $(slider).closest('.wrap-slider');
			p.find('.arrows svg').click(function(e) {
				var to_left = $(this).hasClass('icon-larrow');
				var step = 281 * 3;
				var walk = to_left ? slider.scrollLeft - step : slider.scrollLeft + step
				slider.scroll({
					left: walk,
					top: 0,
					behavior: 'smooth'
				});
			})
		});	
	}


});
