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

	var bottom_click=function(){
				$('.biaot').click(function () {
					$('.catalogmenu').stop().slideToggle(200);
					$('#triangle').toggleClass(function () {
						if ($('#triangle').hasClass('arrow1')) {
							$('#triangle').removeClass('arrow1');
								return 'arrow2';
						} else {
							$('#triangle').removeClass('arrow2');
							return 'arrow1';
						}
					});
				});			
		}
	bottom_click();

});