(function(){
	var lcy_agree = {
		b_event:function(){
			this.btn_click();
		},
		btn_click:function(){
			var check_btn = $('.lcy_agree .bottom_btn .check');
			var go_detail_btn = $('.lcy_agree .bottom_btn .btn');
			var agreement_box = $('.lcy_agree .agreement_box');
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
					$('.lcy_agree').hide();
			        $('.lcy_agree .money_main').show();
				}
			});
		}
	}
	lcy_agree.b_event();
})()
