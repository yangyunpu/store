$(function  () {
	$("#classfy_go").click(function(){
		$(".go_wrap").show();
        $(".buy_wrap").hide();
        $(this).addClass("exchange");
        $(this).siblings().removeClass("exchange");
	})
	$("#classfy_buy").click(function(){
        $(".go_wrap").hide();
		$(".buy_wrap").show();
        $(this).addClass("exchange");
        $(this).siblings().removeClass("exchange");
	}) 
	// 继续杀
	$(".stamp").each(function(){
		var _time =parseInt($(this).val())*1000;
		var _index =  $(this).data("index");
		setInterval(function(){
	    	countkill(_time,_index);
	    },1000)
	})
	// 立即购买
	$(".buystamp").each(function(){
		var _time =parseInt($(this).val())*1000;
		var _key =  $(this).data("index");
		setInterval(function(){
	    	buykill(_time,_key);
	    },1000)
	})
	// 继续杀
	function countkill(obj,_index){
		var startTime = new Date();
		var endTime = new Date(obj);
		var differ = endTime-startTime;
		var differSec= parseInt(differ/1000);
		var countDay = Math.floor(differSec/(24*60*60));
		var countHour = Math.floor((differSec-countDay*24*60*60)/(60*60));
		var countmin = Math.floor((differSec-countDay*24*60*60-countHour*60*60)/60)
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
	// 立即购买
	function buykill(obj,_index){
		var startTime = new Date();
		var endTime = new Date(obj);
		var differ = endTime-startTime;
		var differSec= parseInt(differ/1000);
		var countDay = Math.floor(differSec/(24*60*60));
		var countHour = Math.floor((differSec-countDay*24*60*60)/(60*60));
		var countmin = Math.floor((differSec-countDay*24*60*60-countHour*60*60)/60);
	    var countsec = Math.floor(differSec-countDay*24*60*60-countHour*60*60-countmin*60);
	    if(countDay<0){
           $(".buystamp"+_index+"").html("00"+":"+"00"+":"+"00");
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
		    $(".buystamp"+_index+"").html(countHour+":"+countmin+":"+countsec)
	    }else{
		    $(".buystamp"+_index+"").html(countDay+"天"+countHour+":"+countmin+":"+countsec)
	    }
	    if(countDay=="00"&&countHour=="00"&&countmin=="00"&&countsec=="00"){
	    	$(".buystamp"+_index+"").html("00"+":"+"00"+":"+"00");
	    } 
	}
	
    // 填充背景色宽度
    $(".active_progress").each(function(){
    	var maxWidth = $(this).width();//外部框线
	    var lifePrice =$(this).next("ul").find("#life_price").html();//原价
	    var floorPrice = $(this).next("ul").find("#floor_price").html();//低价
	    var rule =Math.ceil($(this).find("#rule").val()) ;//规则
	    var num = (lifePrice-floorPrice)/rule;//次数
	    var range = maxWidth/num;//幅度
	    var count =$(this).siblings(".active_btn").find("#qtyCount").html();//人数

	    var pre =$(this).find("#pre").val() ;//规则

	    var fillWidth = maxWidth*pre;

	    if(fillWidth>=maxWidth){
            fillWidth=maxWidth;
            $(this).siblings(".active_btn").find(".target_go").hide();
            $(this).siblings(".active_btn").find(".target_suc").show();
	    }else{
	    	$(this).siblings(".active_btn").find(".target_go").show();
            $(this).siblings(".active_btn").find(".target_suc").hide();
	    }

	    $(this).find(".progress").css({
   	    	"width":fillWidth
   	    })
    })
})