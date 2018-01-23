(function(){
	var lcy_moneydetail = {
		b_event:function(){
			this.btn();
			this.go_top();
		},
		btn:function(){
			console.log(11);
			var body = $('.lcy_moneydetail')
			var back2_btn = $('.lcy_moneydetail .head .back2');
			var back2_mark = $('.lcy_moneydetail .head .back2 .mark');
			var goods_intro = $('.lcy_moneydetail .goods_data .goods_intro');
			var goods_standard = $('.lcy_moneydetail .goods_data .goods_standard');
			var goods_para = $('.lcy_moneydetail .goods_data .goods_para');
			var li_btn = $('.lcy_moneydetail .goods_data ul li');
			back2_btn.click(function(e){
				e.stopPropagation();
				back2_mark.show();
			});
			body.click(function(){
			 	back2_mark.hide();
			});
			li_btn.eq(0).click(function(){
				$(this).find('a').addClass('active');
				$(this).siblings().find('a').removeClass('active');
				goods_intro.show();
				goods_standard.hide();
				goods_para.hide();
			});
			li_btn.eq(1).click(function(){
				$(this).find('a').addClass('active');
				$(this).siblings().find('a').removeClass('active');
				goods_standard.show();
				goods_intro.hide();
				goods_para.hide();
			});
			li_btn.eq(2).click(function(){
				$(this).find('a').addClass('active');
				$(this).siblings().find('a').removeClass('active');
				goods_para.show();
				goods_standard.hide();
				goods_intro.hide();
			});
		},
		go_top:function(){
			var timer;
			var go_top_btn = $('.lcy_moneydetail .go_top');
			go_top_btn.click(function(){
				clearInterval(timer);
				timer = setInterval(function(){
					scrollTop = document.documentElement.scrollTop||document.body.scrollTop;
					var speed = (0 - scrollTop)/10;
					speed = speed > 0?Math.ceil(speed):Math.floor(speed);
					if(scrollTop == 0){
						clearInterval(timer);
					}
					document.documentElement.scrollTop = scrollTop + speed;
					document.body.scrollTop = scrollTop + speed;
				}, 30);
			});
		}

	}
	lcy_moneydetail.b_event();
})()