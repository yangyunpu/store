$(function() {

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

    $(document).ready(function() {
        $('.carousel').carousel({
            interval: 5000
        })
    });

    var l_xingMarket = {
            b_event:function(){
                this.moveLeft1('.c-mid>ul>li>.pic-box>img');
                this.moveLeft2('.c-lef>ul>li>.pic-box>img');
                this.moveLeft3('.c-rig>ul>li>.pic-box>img');
                this.bottom_click();
},
            moveLeft1:function(elm){
                $('.c-mid>ul>li>.pic-box>img').hover(function(){
                    $(this).stop().animate({
                        'left':'-6px',
                    }, 200);
                },function(){
                    $(this).stop().animate({
                        'left':'0px'
                    }, 200);
                })
            },
            moveLeft2:function(elm){
                $('.c-lef>ul>li>.pic-box>img').hover(function(){
                    $(this).stop().animate({
                        'left':'-6px',
                    }, 200);
                },function(){
                    $(this).stop().animate({
                        'left':'0px'
                    }, 200);
                })
            }, 
            moveLeft3:function(elm){
                $('.c-rig>ul>li>.pic-box>img').hover(function(){
                    $(this).stop().animate({
                        'left':'-6px',
                    }, 200);
                },function(){
                    $(this).stop().animate({
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