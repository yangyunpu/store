(function(){
	lcy_statistics = {
		b_event:function(){
			this.visit_stat();
			this.show_btn();
			this.d_btn_click();
		},
		visit_stat:function(){//访问量
					var visitData = [
									{
										value: 40,
										color:"#F7464A",
										label: "QQ"
									},
									{
										value: 50,
										color: "#46BFBD",
										label: "微信"
									},
									{
										value: 100,
										color: "#FDB45C",
										label: "微博"
									},
									{
										value: 40,
										color: "#949FB1",
										label: "手机浏览器"
									}

								];


						var ctx = document.getElementById("chart").getContext("2d");
						var visitor = $('.lcy_statistics .stat_main .visitors');
						window.myPie = new Chart(ctx).Pie(visitData);
						var str = '';
						for(var i=0;i<visitData.length;i++){
							str += '<div class="visit"><div style="background:'+visitData[i].color+'"></div><span>'+visitData[i].label+'</span></div>'
						}
						visitor.html(str);			
		},
		sale_stat:function(){//销售量
						var saleData = [
										{
											value: 40,
											color:"#F7464A",
											label: "QQ"
										},
										{
											value: 50,
											color: "#46BFBD",
											label: "微信"
										},
										{
											value: 100,
											color: "#FDB45C",
											label: "微博"
										},
										{
											value: 40,
											color: "#949FB1",
											label: "手机浏览器"
										},
										{
											value: 40,
											color: "#ff0",
											label: "pc"
										}

									];

							var ctx = document.getElementById("chart_sale").getContext("2d");
							var sale_box = $('.lcy_statistics .stat_sale .stat_sale_box .sale_box');
							window.myPie = new Chart(ctx).Pie(saleData);
							var str = '';
							for(var i=0;i<saleData.length;i++){
								str += '<div class="visit"><div style="background:'+saleData[i].color+'"></div><span>'+saleData[i].label+'</span></div>'
							}
							sale_box.html(str);			
		},
		show_btn:function(){
			var that = this;
			var li_btn_1 = $('.lcy_statistics .nav .nav_list li').eq(0);
			var li_btn_2 = $('.lcy_statistics .nav .nav_list li').eq(1);
			var stat_main = $('.lcy_statistics .stat_main');
			var stat_sale = $('.lcy_statistics .stat_sale');
			li_btn_1.click(function(){
				$(this).addClass('active');
				$(this).siblings().removeClass('active');
				stat_main.show();
				stat_sale.hide();
				that.visit_stat();
			});
			li_btn_2.click(function(){
				$(this).addClass('active');
				$(this).siblings().removeClass('active');
				stat_main.hide();
				stat_sale.show();
				that.sale_stat();
			});
		},
		d_btn_click:function(){
				var d_btn = $('.lcy_statistics .stat_sale .sale_detail .title .d_btn');
				var goods_big_box = $('.lcy_statistics .stat_sale .sale_detail .goods_big_box');
				d_btn.click(function () {
					goods_big_box.stop().slideToggle(0);
					d_btn.toggleClass(function () {
						if (d_btn.hasClass('vv')) {
							d_btn.removeClass('vv');
								return 'aa';
						} else {
							d_btn.removeClass('aa');
							return 'vv';
						}
					});
				});			
		}
	}
	lcy_statistics.b_event();
})()




