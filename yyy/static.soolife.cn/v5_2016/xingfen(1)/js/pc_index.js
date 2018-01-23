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

	var swiper = new Swiper('.h-swiper-l', {
        pagination: '.swiper-pagination',
        //nextButton: '.swiper-button-next',
        //prevButton: '.swiper-button-prev',
        paginationClickable: true,
        spaceBetween: 30,
        centeredSlides: true,
        autoplay: 5000,
        autoplayDisableOnInteraction: false
    });
        var mySwiper = new Swiper('.hxh',{
            pagination: '.hx',
            slidesPerView : 7,
            slidesPerGroup : 1,
            // autoplay : 5000,
            // speed: 1000,
            prevButton:'.hprev',
            nextButton:'.hnext',
            autoplayDisableOnInteraction : false,
            loop : true
        });
        $(".powder img").hover(function(){
                    $(this).css("box-shadow","0px 0px 30px #a7a7a7");
                    $(this).css("z-index","1");
                },function(){
                    $(this).css("box-shadow","0 0 0 #000");
                    $(this).css("z-index","0");
        })
        $('.xingfex1200 img').hover(function(){
            $(this).show().css("box-shadow","0px 0px 30px #a7a7a7")
        })
        $('.grilx240 img').stop().hover(function(){
            $(this).next('p').stop().slideDown(200);
            // $(this).next('p').fadeTo('slow',0.5);
        })
        $('.grilx240').stop().mouseleave(function(){
            $('.grilx240 p').stop().slideUp();
        })

    var l_xingMarket = {
            b_event:function(){
                this.moveLeft1('.banner_xia>ul>picture_1');
                this.moveLeft2('.banner_xia>ul>picture_2');
                this.moveLeft3('.banner_xia>ul>picture_3');
                this.moveLeft4('.hzl1');
                this.moveLeft5('.hzl2');
                this.bottom_click();
                // this.moveLeft_2('.pink>.zhengti>.white_bg>.picture_right>img');
},
            moveLeft1:function(elm){
                $('.banner_xia>ul>li').eq(0).hover(function(){
                    $('.banner_xia>ul>li>a>img').eq(0).stop().animate({
                        'left':'-6px'
                    }, 200);
                },function(){
                    $('.banner_xia>ul>li>a>img').eq(0).stop().animate({
                        'left':'0px'
                    }, 200);
                })
            },
            moveLeft2:function(elm){
                $('.banner_xia>ul>li').eq(1).hover(function(){
                    $('.banner_xia>ul>li>a>img').eq(1).stop().animate({
                        'left':'-6px'
                    }, 200);
                },function(){
                    $('.banner_xia>ul>li>a>img').eq(1).stop().animate({
                        'left':'0px'
                    }, 200);
                })
            },
            moveLeft3:function(elm){
                $('.banner_xia>ul>li').eq(2).hover(function(){
                    $('.banner_xia>ul>li>a>img').eq(2).stop().animate({
                        'left':'-6px'
                    }, 200);
                },function(){
                    $('.banner_xia>ul>li>a>img').eq(2).stop().animate({
                        'left':'0px'
                    }, 200);
                })
            },
            moveLeft4:function(elm){
                $('.hzl1').hover(function(){
                    $('.hzl1>a>img').stop().animate({
                        'left':'-6px'
                    }, 200);
                },function(){
                    $('.hzl1>a>img').stop().animate({
                        'left':'0px'
                    }, 200);
                })
            },
            moveLeft5:function(elm){
                $('.hzl2').hover(function(){
                    $('.hzl2>a>img').stop().animate({
                        'left':'-6px'
                    }, 200);
                },function(){
                    $('.hzl2>a>img').stop().animate({
                        'left':'0px'
                    }, 200);
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