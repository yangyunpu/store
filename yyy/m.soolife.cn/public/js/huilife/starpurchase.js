$(function(){
	var good_url = $('#soo-header').data('url');
	var n = 0;
	var door = 0;
	var dataParm = {
				"categories":"",
                "brand_id": "",
                "price_min": 0,
                "price_max": 0,
                "specs": "",
                "is_oversea": 0,
                "is_coin": true,
                "just_coin":false,
                "countries": "",
                "keyword": "",
                "debug": false,
                "coin_min":"",
                "coin_max":"",
                "sort": "",
                "skip": 0,
                "take": 20
		};
	//点击筛选
	var selectDown = $('.select .filter_down');
	var selectUp = $('.select .filter_up');
	var interval = $('.interval');
	function selectBoxShow(){
		selectDown.hide();
		selectUp.show();
		interval.show();
	};
	function selectBoxHide(){
		selectUp.hide();
		selectDown.show();
		interval.hide();		
	};
	selectDown.click(function(){
		selectBoxShow();
	});
	selectUp.click(function(){
		selectBoxHide();
	});
	//点击选项（全部、衣、食、住、行);
	$('.classify .nav').find('.btn_item').click(function(){
		selectBoxHide();
		$(this).addClass('btn_active');
		$(this).siblings().removeClass('btn_active');
		var code = $(this).data('code');
		$.ajax({
			url: '/Huilife/starexBuyAjax',
			type: 'POST',
			dataType: 'json',
			data: {
				"categories": code,
                "brand_id": "",
                "price_min": 0,
                "price_max": 0,
                "specs": "",
                "is_oversea": 0,
                "is_coin": true,
                "just_coin":false,
                "countries": "",
                "keyword": "",
                "debug": false,
                "sort": "",
                "skip": 0,
                "take": 20
			},
			success:function(res){
				return_data(res);
				n = 0;
				door = 0;
				dataParm.categories = code;
			}
		});
	});
	//点击区间
	$('.classify .interval').find('.interval_s').click(function(){
		var isSpan = $(this).data('span') == "yes";
		if(isSpan){
			var min = $(this).data('coin-min');
			var max = $(this).data('coin-max');
		}else{
			var min = $('#min_text').val();
			var max = $('#max_text').val();
			if(max == '0') {
				$('.lcy_starchange .goods').html('');
				return;
			};
		};
		var code = $('.classify .nav').find('.btn_active').data('code')||'';
		var data = {
				"categories": code,
                "brand_id": "",
                "price_min": 0,
                "price_max": 0,
                "specs": "",
                "is_oversea": 0,
                "is_coin": true,
                "just_coin":false,
                "countries": "",
                "keyword": "",
                "debug": false,
                "coin_min":min,
                "coin_max":max,
                "sort": "",
                "skip": 0,
                "take": 20
		};
		$.ajax({
			url: '/Huilife/starexBuyAjax',
			type: 'POST',
			dataType: 'json',
			data: data,
			success:function(res){
				return_data(res);
				n = 0;
				door = 0;
				dataParm.categories = code;
				dataParm.coin_min = min;
				dataParm.coin_max = max;				
				$('#min_text').val('');
				$('#max_text').val('');
			}
		});
		
	});
	 //点击衣食住行和星币区间Ajax请求后数据处理
	function return_data(res){
		var data = res.data;
		var str = '';
		if(data){
			for(var i=0;i<data.length;i++){
				str +=  '<div class="item clear-f">'+
								'<div class="img float-l"><a href="'+good_url+'/'+res.data[i].items[0].id+'.html"><img src="'+res.data[i].items[0].logo+'" alt=""></a></div>'+
								'<div class="wen float-l">'+
									'<p class="mess">'+res.data[i].items[0].name+'</p>'+
									'<p class="coin">￥'+res.data[i].items[0].promo.price+'+'+res.data[i].items[0].promo.coin+'星币</p>'+
									'<p class="piece">市场参考价：￥'+res.data[i].items[0].market_price+'</p>'+
								'</div>'+
							'</div>';											
			};					
		}else{
			str = '<div class="no_goods">'
					+'<img src="../public/img/huilife/no_goods.png" alt="">'
				+'</div>';
		};
		$('.lcy_starchange .goods').html(str);
	 };
	 //下拉刷新////////////////////////////////////////////////////////////////////////////
	window.onscroll=function(){
		var a = $(window).height(); 
		var c = $(document).height();
		var e = $(document).scrollTop();
		if(door == 1) return;
		if(a+e == c){
			n++;
			dataParm.skip = n*20;
			$.ajax({
				url: '/Huilife/starexBuyAjax',
				type: 'POST',
				dataType: 'json',
				data: dataParm,
				success:function(res){
					append_data(res)
				}
			});
			return;
		};
	};
	// 下拉刷新 处理ajax
	function append_data(res){
		var data = res.data;
		var str = '';
		if(data){
			for(var i=0;i<data.length;i++){
				str +=  '<div class="item clear-f">'+
								'<div class="img float-l"><a href="'+good_url+'/'+res.data[i].items[0].id+'.html"><img src="'+res.data[i].items[0].logo+'" alt=""></a></div>'+
								'<div class="wen float-l">'+
									'<p class="mess">'+res.data[i].items[0].name+'</p>'+
									'<p class="coin">￥'+res.data[i].items[0].promo.price+'+'+res.data[i].items[0].promo.coin+'星币</p>'+
									'<p class="piece">市场参考价：￥'+res.data[i].items[0].market_price+'</p>'+
								'</div>'+
							'</div>';											
			};					
		}else{
			door = 1;
			str = '<p style="text-align:center;">没有更多商品了...</p>';
		};
		$('.lcy_starchange .goods').append(str);
	};



})//end;
