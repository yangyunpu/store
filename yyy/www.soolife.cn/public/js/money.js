(function(){
	var lcy_money = {
		b_event:function(){
			this.btn_click();
			this.addgood();
		},
		btn_click:function(){
			var check_btn = $('.check');
			var go_detail_btn = $('.lcy_money .money_ad .agreement_box .box .btn');
			var agreement_box = $('.lcy_money .money_ad .agreement_box');
			var li_num_btn = $('.lcy_money .money_main .addgoods .classify li');
			var money_ad = $('.lcy_money .money_ad');
			check_btn.change(function(){
				if(check_btn.is(':checked')){
					go_detail_btn.css('background-color','#ff7c36');
				}else{
					go_detail_btn.css('background-color','#a9a7a6');
				}
			});
			go_detail_btn.click(function(){
				if(check_btn.is(':checked')){
					agreement_box.hide();
					$('.lcy_money .money_ad').hide();
			        $('.lcy_money .money_main').show();
				}
			});
			$('.lcy_money .money_ad .ad .btn_go').click(function(){
				agreement_box.show();
			});
			agreement_box.on('touchmove',function(e){
				e.stopPropagation();
			});
			li_num_btn.click(function(){
				$(this).find('a').addClass('active_num');
				$(this).siblings().find('a').removeClass('active_num');
			});
		},
		addgood:function(){
			$('.add').on('click', function(event) {
				if($('.fly_good')){
					
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
				 setTimeout(function(){
				 	$('.fly_good').remove();
				 },10000)
			})
		}
	}
	lcy_money.b_event();
})()
