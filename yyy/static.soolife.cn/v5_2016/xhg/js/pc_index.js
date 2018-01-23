$(function() {
	$('[data-toggle="tooltip"]').tooltip();

	$(".catalogmenu ul>li").mouseenter(function() {
		var tindex = $(this).index();
		$(this).addClass('selected').siblings().removeClass('selected');
		$(this).prev().addClass('selected-prev').siblings().removeClass('selected-prev');
		var catPtop = (tindex) * 40;
		$('.catalogpannel').css('top', catPtop);
		$(".catalogpannel .pannel").eq(tindex).show().siblings().hide();
		$(".catalogpannel").animate({
			width: '950px'
		}, 500);
	});
	$(".catalogshow").mouseleave(function() {
		$(".catalogpannel").stop(true);
		$(".catalogpannel .pannel").hide();
		$(".catalogmenu ul li").removeClass("selected");
		$(".catalogmenu ul li").removeClass("selected-prev");
		$(".catalogpannel").css('width', '0px');
	});

	var swiper = new Swiper('.swiper-container', {
		pagination: '.swiper-pagination',
		//nextButton: '.swiper-button-next',
		//prevButton: '.swiper-button-prev',
		paginationClickable: true,
		spaceBetween: 30,
		centeredSlides: true,
		autoplay: 5000,
		autoplayDisableOnInteraction: false
	});

	$('.picture500x320').hover(function() {
		$(this).css("box-shadow", "0px 0px 30px #a7a7a7");
	}, function() {
		$(this).css("box-shadow", "0 0 0 #000");
	});


	$('.sliding_a').on('mouseenter', function() {

		$(this).find('.crzy_beside_box').animate({
			left: -6
		}, 100);
	}).on('mouseleave', function() {
		$(this).find('.crzy_beside_box').animate({
			left: 0
		}, 100);
	});

	var widy = $('.left_gjg').width();
	var wide = $('.right_gjg').width();
	$('.left_gjg').mouseover(function() {
		$('.left_gjg').stop().animate({
			'width': widy
		}, 500);
		$('.right_gjg').stop().animate({
			'width': wide
		}, 500);
		$('.one').css('display', 'block');
		$('.two').css('display', 'none');
		$('.four').css('display', 'none');
		$('.three').css('display', 'block');
	})
	$('.right_gjg').mouseover(function() {
		$('.right_gjg').stop().animate({
			'width': widy
		}, 500);
		$('.left_gjg').stop().animate({
			'width': wide
		}, 500);
		$('.three').css('display', 'none');
		$('.four').css('display', 'block');
		$('.one').css('display', 'none');
		$('.two').css('display', 'block');
	})

});