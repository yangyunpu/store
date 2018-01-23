(function(){
	var lcy_money = {
		b_event:function(){
			this.btn_click();
			this.addgood();
		},
		btn_click:function(){
			var li_num_btn = $('.lcy_money .money_main .addgoods .classify li');
			var nav_li = $('.lcy_money .money_main .head_nav ul li');
			
			nav_li.click(function(){
				$(this).addClass('active');
				$(this).siblings().removeClass('active');
			});			
			li_num_btn.click(function(){
				$(this).find('a').addClass('active_num');
				$(this).siblings().find('a').removeClass('active_num');
			});
		},
		addgood:function(){
			$('.add').on('click', function(event) {
				if($('.fly_good')){
					$('.fly_good').remove();
				}
				var _src = $(this).parents('.goodsbox').find('img').attr('src')
				var start_l = $(this).offset().left - $(window).scrollLeft() + ($(this).width())/2-10; 
				var start_t = $(this).offset().top - $(window).scrollTop() - ($(this).height())/2+10;
				var end_l = $('#end').offset().left - $(window).scrollLeft(); 
				var end_t = $('#end').offset().top - $(window).scrollTop();
				var _img = '<img class="fly_good" src="'+_src+'">';
				var flyer = $(_img);
				flyer.fly({
						    start: {
						        left:  start_l,
						        top:  start_t
						        },
						    end: {
						        left: end_l,
						        top: end_t,
						        width: 0,
						        height: 0,
						       }
				});
			})
		}
	}
	lcy_money.b_event();
})()
