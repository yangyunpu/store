$(function() {
	// $('[data-toggle="tooltip"]').tooltip();

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

	var l_xingMarket = {
			b_event:function(){
				this.changeSize_Img('.banner_bottom>ul>li');
//				this.moveLeft('.middlex1200>.ylcpp>img');
//				this.changeSize_width('.crzy>ul>li>div>a>div');
				this.shadow();
				this.bottom_click();
			},

			changeSize_Img:function(elm){/*移入时，元素会变大，其他会变小,有图片切换*/
				var num = ['img/banner_up/picture1_03.jpg','img/banner_up/picture1_05.jpg','img/banner_up/picture1_03.jpg','img/banner_up/picture1_07.jpg','img/banner_up/picture1_09.jpg'];	
				$(elm).mouseenter(function(){

					$(this).siblings().stop().animate({
						'width': '178px'
					}, 800);

					$(this).stop().animate({
						'width': '480px'
					}, 800);


					$(this).siblings().find('img').stop().animate({
						'position': 'relative',
			    		'top': '25px',
					    'width': '142px',
					    'height': '207px'
					}, 800);

					$(this).find('img').stop().animate({
						'position': 'relative',
			    		'top': '0px',
						'width': '480px',
						'height': '260px'
					}, 800);
					$('.banner_bottom>ul>.green1').find('img').attr('src', num[0]);
					$('.banner_bottom>ul>.green2').find('img').attr('src', num[1]);
					$('.banner_bottom>ul>.green3').find('img').attr('src', num[2]);
					$('.banner_bottom>ul>.green4').find('img').attr('src', num[3]);
					$('.banner_bottom>ul>.green5').find('img').attr('src', num[4]);
					$(this).find('img').attr('src','img/banner_up/picture4.jpg');
				
				});

			},
			moveLeft:function(elm){
				$(elm).hover(function(){
					$(this).stop().animate({
						'left':'-6px'
					}, 200);
				},function(){
					$(this).stop().animate({
						'left':'0px'
					}, 200);
				})
			},
			moveLeft_2:function(elm){
				$(elm).hover(function(){
					$(this).stop().animate({
						'right':'6px'
					}, 200);
				},function(){
					$(this).stop().animate({
						'right':'0px'
					}, 200);
				})
			},
			changeSize_width:function(elm){
				$(elm).mouseenter(function(){					
					$(this).stop().animate({
						'left':'-100px'
					}, 200)
					$(this).prevAll().stop().animate({
						'left':'-100px'
					}, 200);
					if($(this).css('left')== '-100px'){
						$(this).nextAll().stop().animate({
						'left':'0'
						}, 200)
					}
				});
			},
			shadow:function(){
				$('.ylcpp').hover(function(){
					$(this).css("box-shadow","0px 0px 20px #a7a7a7");
				},function(){
					$(this).css("box-shadow","0 0 0 #5d5e5f");
				})
			},
			
			bottom_click:function(){
				$('.biaot').click(function () {
					$('.catalogshow').stop().slideToggle(300);
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
			
	};
	l_xingMarket.b_event();
});