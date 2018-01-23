$(function(){
	/**
	* 
	* @return 
	* @param  领取星币
	* @author zhichao_hu@soolife.com.cn
	* @date 
	* 签到
	*/
	$(".go_get_coin").on("click",function(){
		$.ajax({
			url      : "/huilife/getcoin.html",
            type     : "post",
            dataType : "json",
            ContentType:"application/x-www-form-urlencoded",
            success : function(data){
            	console.log(data);
            	$(".lcy_getcoin .mark").show();
            }

		});
	});
	$('.lcy_getcoin .mark #delete_getcoin').click(function(){
		$(".lcy_getcoin .mark").hide();
		window.location.reload();
	});
    
    /**
    * 
    * @return 
    * @param login
    * @author zhichao_hu@soolife.com.cn
    * @date
    * 登录 
    */
	$(".login").on("click",function(){
		go_login();
	});

	/**
	* 
	* @return 
	* @param  签到领星币
	* @author zhichao_hu@soolife.com.cn
	* @date 
	*/
	$(".go_complete0").on("click",function(){
		var is_login = $(this).attr('data-is-login');
		var iscomplete = $(this).attr('data-iscomplete');
		if(iscomplete) {
			return;
		}else if(is_login=='0'){
			go_login();
		}else{
			$.ajax({
				url      : "/huilife/getcoin.html",
		        type     : "post",
		        dataType : "json",
		        ContentType:"application/x-www-form-urlencoded",
		        success : function(data){
		        	$(".lcy_getcoin .mark").show();
		        }
			});
		};
	});


    
    /**
	* 
	* @return 
	* @param  星粉秀领星币
	* @author zhichao_hu@soolife.com.cn
	* @date 
	*/
	$(".go_complete1").on("click",function(){
		var is_login = $(this).attr('data-is-login');
		var iscomplete = $(this).attr('data-iscomplete');
		var url_m       = $(".lcy_hui").attr("data-url-m");
        if(is_login=='0'){
        	go_login();
        }else{
        	window.location.href = url_m + "/i/show/show.html"
			// if(iscomplete){
			// 	window.location.reload();
			// }
        }

		// var url_m       = $(".lcy_hui").attr("data-url-m");
		// window.location.href = url_m+"/exist/mystarshow.html";
		
	});
	 /**
	* 
	* @return 
	* @param  订单评价领星币
	* @author zhichao_hu@soolife.com.cn
	* @date 
	*/
	$(".go_complete2").on("click",function(){
		var is_login = $(this).attr('data-is-login');
		var iscomplete = $(this).attr('data-iscomplete');
		var url_m       = $(".lcy_hui").attr("data-url-m")
		if(is_login=='0'){
        	go_login();
        }else{
        	window.location.href = url_m + "/orders/index.html?status=4"
		}
		// if(iscomplete) return;
		// var url_m       = $(".lcy_hui").attr("data-url-m");
		// window.location.href = url_m+"/orders.html?status=4";
		
	});


    /**
    * 
    * @return 
    * @param  登录并且调回当前页面
    * @author zhichao_hu@soolife.com.cn
    * @date 
    */
	function go_login(){
		var url_m       = $(".login").attr("data-url-m");
		$.base64.utf8encode  = true;
		var url              = $.base64.btoa(window.location.href);
		window.location.href = url_m+"/logins/login.html?return_url="+url;
    }





$.ajax({
		url      : "/huilife/timer.html",
        type     : "get",
        dataType : "json",
        ContentType:"application/x-www-form-urlencoded",
        success : function(data){
        	// console.log(data.data);
        	$.each(data.data,function(i,item) {
				switch (i){
						case 'app.coin.exchange.top':
						  startTime('.time-top',item.items[0].start_date);
						  // startTime('.time-top',"86719");
						  break;
						case 'app.coin.exchange.left':
						  startTime('.time-left',item.items[0].start_date);
						  break;
						case 'app.coin.exchange.right001':
						  startTime('.time-right001',item.items[0].start_date);
						  break;
						case 'app.coin.exchange.right002':
						  startTime('.time-right002',item.items[0].start_date);
						  break;
				}
        	});
        }

	});

	var time = ""//倒计时计时器
	$(".time_count_down").each(function(){
		var _time =parseInt($(this).val())*1000;
		var _index =  $(this).data("index");
		time = setInterval(function(){
	    	countDown(_time,_index);
	    },1000)
	})


	// 倒计时
	function countDown(obj,_index){
		var startTime = new Date();
		var endTime = new Date(obj);
		var differ = endTime-startTime;
		var differSec= parseInt(differ/1000);
		var countDay = Math.floor(differSec/(24*60*60));
		var countHour = Math.floor((differSec-countDay*24*60*60)/(60*60));
		var countmin = Math.floor((differSec-countDay*24*60*60-countHour*60*60)/60);
	    var countsec = Math.floor(differSec-countDay*24*60*60-countHour*60*60-countmin*60);
	    if(countDay<0){
            $(".timestamp"+_index+"").html("<span>00</span>"+" : "+"<span>00</span>"+" : "+"<span>00</span>");
            $(".timestamp"+_index+"").hide();
            return;
	    }
	    if(countDay<10){
	        countDay = "0"+countDay;
	    }
	    if(countHour<10){
	        countHour = "0"+countHour;
	    }
	    if(countmin<10){
	        countmin = "0"+countmin;
	    }
	    if(countsec<10){
	        countsec = "0"+countsec;
	    }
	    if(countDay=="00"){
	    	$(".timestamp"+_index+"").html("<span>"+countHour+"</span>"+" : "+"<span>"+countmin+"</span>"+" : "+"<span>"+countsec+"</span>")
	    }else{
	    	$(".timestamp"+_index+"").html("<span>"+countDay+"</span>"+" 天 "+"<span>"+countHour+"</span>"+" : "+"<span>"+countmin+"</span>"+" : "+"<span>"+countsec+"</span>")
	    }
	    if(countDay=="00"&&countHour=="00"&&countmin=="00"&&countsec=="00"){
	    	$(".timestamp"+_index+"").html("<span>00</span>"+" : "+"<span>00</span>"+" : "+"<span>00</span>");
	    }     
	}

});