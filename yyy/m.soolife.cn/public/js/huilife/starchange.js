$(function(){
	var good_url = $('#soo-header').data('url');
	var n = 0;
	var door = 0;
	var dataParm = {
            "skip":"0",
            "take":"10",
            "category":"",
            "just_coin":true,
            "coin_min":"",
            "coin_max":""
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
	//点击选项（衣食住行);
	$('.classify .nav').find('.btn_item').click(function(){
		selectBoxHide();
		$(this).addClass('btn_active');
		$(this).siblings().removeClass('btn_active');
		var code = $(this).data('code');
		$('.classify').attr('data-btn-code',code);
		$.ajax({
			url: '/Huilife/starchangeAjax',
			type: 'POST',
			dataType: 'json',
			data: {
	            "skip":"0",
	            "take":"10",
	            "category":code,
	            "just_coin":true,
	            "coin_min":"",
	            "coin_max":""
			},
			success:function(res){
				return_data(res);
				detaltime();
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
	            "skip":"0",
	            "take":"10",
	            "category":code,
	            "just_coin":true,
	            "coin_min":min,
	            "coin_max":max
		};
		$.ajax({
			url: '/Huilife/starchangeAjax',
			type: 'POST',
			dataType: 'json',
			data: data,
			success:function(res){
				return_data(res);
				detaltime();
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
		var stra= '';
		var strb= '';
		var strc= '';
		if(data){
			for(var i=0;i<data.length;i++){
				stra= '';
				strb= '';
				strc= '<p class="coin">'+data[i].coin+'星币</p>';
				if(data[i].limit==1){ strc='<p class="coin">￥'+data[i].price+'</p>'}
				if(data[i].status==1) stra='<img src="../public/img/huilife/zhong.png" class="teimg">';
				if(data[i].status==3) stra='<img src="../public/img/huilife/guang.png" class="teimg">';
				if(data[i].status==2) strb=	'<div class="daotime">'+
												'<p class="timel float-l">距开启还有</p>'+
												'<p class="timer float-r" data-begintime="'+data[i].begintime+'">'+
													'<span>29</span>&nbsp;天&nbsp;<span>23</span>&nbsp;:&nbsp;<span>59</span>&nbsp;:&nbsp;<span>59</span>'+
												'</p>'+
											'</div>';
				str +=  strb+
						'<div class="item clear-f">'+stra+
							'<div class="img float-l"><a href="'+good_url+'/'+data[i].skuid+'.html"><img src="'+data[i].logo+'" alt=""></a></div>'+
							'<div class="wen float-l">'+
								'<p class="mess">'+data[i].name+'</p>'+
								strc+
								'<p class="piece">市场参考价：￥'+data[i].marketprice+'</p>'+
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
		var code = $('.classify').attr("data-btn-code");
		if(door == 1) return;
		if(a+e == c){
			n++;
			dataParm.skip = n*10;
			dataParm.category = code;
			$.ajax({
				url: '/Huilife/starchangeAjax',
				type: 'POST',
				dataType: 'json',
				data: dataParm,
				success:function(res){
					append_data(res);
					detaltime();
				}
			});
			return;
		};
	};
	// 下拉刷新 处理ajax
	function append_data(res){
		var data = res.data;
		var str = '';
		var strb = '';
		var strc = '';
		if(data){
			for(var i=0;i<data.length;i++){
				stra= '';
				strb= '';
				strc= '<p class="coin">'+data[i].coin+'星币</p>';
				if(data[i].limit==1){ strc='<p class="coin">￥'+data[i].price+'</p>'}
				if(data[i].status==1) stra='<img src="../public/img/huilife/zhong.png" class="teimg">';
				if(data[i].status==3) stra='<img src="../public/img/huilife/guang.png" class="teimg">';
				if(data[i].status==2) strb=	'<div class="daotime">'+
												'<p class="timel float-l">距开启还有</p>'+
												'<p class="timer float-r" data-begintime="'+data[i].begintime+'">'+
													'<span>29</span>&nbsp;天&nbsp;<span>23</span>&nbsp;:&nbsp;<span>59</span>&nbsp;:&nbsp;<span>59</span>'+
												'</p>'+
											'</div>';
				str +=  strb+
						'<div class="item clear-f">'+stra+
							'<div class="img float-l"><a href="'+good_url+'/'+data[i].skuid+'.html"><img src="'+data[i].logo+'" alt=""></a></div>'+
							'<div class="wen float-l">'+
								'<p class="mess">'+data[i].name+'</p>'+
								strc+
								'<p class="piece">市场参考价：￥'+data[i].marketprice+'</p>'+
							'</div>'+
						'</div>';
			};
		}else{
			door = 1;
			str = '<p style="text-align:center;">没有更多商品了...</p>';
		};
		$('.lcy_starchange .goods').append(str);
	};

});
//倒计时
	var nowtime = parseInt(+new Date()/1000);
	var beginTime = +$('.timer').data('begintime');
	var _time=  beginTime-nowtime;

	function makeTime(option,value) {
	    var m = parseInt(value);
	    var min = 0;
	    var h = 0;
	    var d = 0;
	    if(m > 60) {
	        min = parseInt(m/60);
	        m = parseInt(m%60);
	        if(min > 60) {
	            h = parseInt(min/60);
	            min = parseInt(min%60);
	        };
	    };
	    if(h>24){
	    	d=parseInt(h/24);
	    	h = h%24;
	    };
	    if(h<10){
	    	h='0'+h;
	    };
	    if(min<10){
	    	min='0'+min;
	    };
	    if(m<10){
	    	m='0'+m;
	    };
	    var str = '<span>'+d+'</span>&nbsp;天&nbsp;<span>'+h+'</span>&nbsp;:&nbsp;<span>'+min+'</span>&nbsp;:&nbsp;<span>'+m+'</span>';
	    $(option).html(str);
	};
	function startTime(option,n){
		var _timer = setInterval(function(){
				n -= 1;
				makeTime(option,n);
				if(n <= 0){
					var endstr = '<span>00</span>&nbsp;天&nbsp;<span>00</span>&nbsp;:&nbsp;<span>00</span>&nbsp;:&nbsp;<span>00</span>';
					$(option).html(endstr);
					clearInterval(_timer);
				}
		},1000);
	};
	function detaltime(){
		var timer = $('.timer').length;
		for(var i=0;i<timer;i++){
			var nowtime = parseInt(+new Date()/1000);
			var begintime = +$('.timer').eq(i).data('begintime');
			var _time = begintime-nowtime;
			startTime($('.timer').eq(i),_time);
		};
	};
	detaltime();