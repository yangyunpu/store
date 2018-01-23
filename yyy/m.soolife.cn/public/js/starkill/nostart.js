$(function  () {
	var mySwiper = new Swiper('.swiper-container',{
		pagination: '.pagination',
		autoplay : 2000,
		speed:300,
		loop:true,
		autoplayDisableOnInteraction : false
	})
	$(".rule_btn").click(function(){
		$(".rule_wrap").removeClass("hide")
	})
	$(".rule_close").click(function(){
		$(".rule_wrap").addClass("hide")
	})
	// 倒计时
	// 活动未开始--> 活动未开始
	// 活动开始 -->活动结束
	// 活动结束 --> 过期
	var time = "";
	$(".stamp").each(function(){
		var _time =parseInt($(this).val())*1000;
		var _index =  $(this).data("index");
		time = setInterval(function(){
	    	countDown(_time,_index);
	    },1000) 
	})
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
            $(".timestamp"+_index+"").html("00"+":"+"00"+":"+"00");
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
	    	$(".timestamp"+_index+"").html(countHour+":"+countmin+":"+countsec)
	    }else{
	    	$(".timestamp"+_index+"").html(countDay+"天"+countHour+":"+countmin+":"+countsec)
	    }
	    if(countDay=="00"&&countHour=="00"&&countmin=="00"&&countsec=="00"){
	    	$(".timestamp"+_index+"").html("00"+":"+"00"+":"+"00");
	    }  
	}
	
})