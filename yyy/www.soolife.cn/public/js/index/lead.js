// (function(){
// 	var lcy_moneyagreement = {
// 		b_event:function(){
// 			this.btn_click();
// 		},
// 		btn_click:function(){
// 			var check_btn = $('.check');
// 			var go_detail_btn = $('.lcy_moneyagreement .money_ad .agreement_box .box .btn');
// 			var agreement_box = $('.lcy_moneyagreement .money_ad .agreement_box');
// 			var money_ad = $('.lcy_moneyagreement .money_ad');
// 			check_btn.change(function(){
// 				if(check_btn.is(':checked')){
// 					go_detail_btn.css('background-color','#ff7c36');
// 				}else{
// 					go_detail_btn.css('background-color','#a9a7a6');
// 				}
// 			});
// 			go_detail_btn.click(function(){
// 				if(check_btn.is(':checked')){
// 					agreement_box.hide();
// 					$('.lcy_moneyagreement .money_ad').hide();
// 			        $('.lcy_moneyagreement .money_main').show();
// 				}
// 			});
// 			$('.lcy_moneyagreement .money_ad .ad .btn_go').click(function(){
// 				agreement_box.show();
// 			});
// 			agreement_box.on('touchmove',function(e){
// 				e.stopPropagation();
// 			});
// 		}
// 	}
// 	lcy_moneyagreement.b_event();
// })()
