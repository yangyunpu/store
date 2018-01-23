$(function  () {
	var handler = function () {
        event.preventDefault();
        event.stopPropagation();
    };
	var mySwiper = new Swiper('.swiper-container',{
		pagination: '.pagination',
		autoplay : 2000,
		speed:300,
		loop:true,
		autoplayDisableOnInteraction : false
	})
	// 弹框出现
	$("#start_kill").click(function(){
		// 初始化
		$("#plus").attr("disable","false");
		$(".alert_wrap").show();


		var rule = Math.ceil($(".rule").val());//后台设置的杀机数量
		$(".coin_sum").html(rule);



		// 初始化底层页面
		document.body.addEventListener('touchmove',handler,false);
        document.body.addEventListener('wheel',handler,false);

		
	})
	$(".alert_bg").click(function(){
		$(".alert_wrap").hide();
		$("#result").val(1);
		// 更改底层页面
		document.body.removeEventListener('touchmove',handler,false);
        document.body.removeEventListener('wheel',handler,false);

	})
	// 加减法
	function coinCount (){
		var sum='';//杀价总量
		var res ='';//杀价次数
		var rule = Math.ceil($(".rule").val());//后台设置的杀机数量
		var memberSum = $(".alert_total").find("span").html();//会员星币总量
        // 初始化
		$(".coin_sum").html(rule)
		$("#plus").click(function(){
			res = $(this).siblings("input").val();
			++res;
			sum = rule*res;
			if(sum>memberSum){
				$("#alert_coin").show();
				$("#alert_coin").html("您的星币不足!")
				setTimeout(function(){
                    $("#alert_coin").hide();
                },1000)
				$("#plus").attr("disable","true");
				res = Math.floor(memberSum/rule);
				if(res==0){
                    sum = rule;
                    res = 1;
				}else{
					sum = Math.floor(memberSum/rule)*rule;
				}
			}
			$(this).siblings("input").val(res);
			$(".coin_sum").html(sum);
		})
		$("#minus").click(function(){
			$("#plus").attr("disable","false");
			res = $(this).siblings("input").val();
            if(res>1){
            	res--;
            	if(res>1){

	                if(sum>memberSum){
					    $(this).siblings("input").val(1);
					    $(".coin_sum").html(rule);
					}else{
						var sum = rule*res;
					}
            	}else{
                    $(this).siblings("input").val(1);
					$(".coin_sum").html(rule);
            	} 
            }else {
            	$(this).siblings("input").val(1);
				$(".coin_sum").html(rule);
            }
			$(this).siblings("input").val(res);
			$(".coin_sum").html(sum);
		})
		// input输入框
		$("#result").blur(function(){
			res = $(this).val();
			if(res<1){
                $(this).val(1);
                res=1;
			}
			sum = rule*res;
			if(sum>memberSum){
				$("#alert_coin").show();
				$("#alert_coin").html("您的星币不足!!")
			    setTimeout(function(){
                    $("#alert_coin").hide();
                },1000)
				$("#plus").attr("disable","true");
				sum = Math.floor(memberSum/rule)*rule;
				res = Math.floor(memberSum/rule);
			}
			$(this).val(res);
		    $(".coin_sum").html(sum);
		})
	}
	// 调用加减法
		coinCount ();
    // 确认购买
	$("#suc_buy").click(function(){
        var qty = $("#result").val();
        var starkill_id = $(".starkill_id").val();
        var rule = Math.ceil($(".rule").val());//后台设置的杀机数量
        var sum = $(".coin_sum").html()
        var memberSum =parseInt($(".alert_total").find("span").html());//会员星币总量


        var preQty  = $("#pre_qty").val() ;      //会员杀价现在的数量
        var limitQty = $("#limit_ation").val() ;     //会员杀价限制的数量
        var differ = limitQty-preQty;

        if(qty>differ){
        	$("#alert_coin").show();
            $("#alert_coin").html("不能购买更多了!")
			setTimeout(function(){
                $("#alert_coin").hide();
            },1000)
        }else{
        	if(qty==1&&sum>memberSum){
	        	$("#alert_coin").show();
	            $("#alert_coin").html("您的星币不足!")
				setTimeout(function(){
	                $("#alert_coin").hide();
	            },1000)
	        }else{
	            $(".coin_sum").html(rule);
	            window.location.href="/starkill/order.html?starkill_id="+starkill_id+"&qty="+qty+"";
	        } 
        }

         
	})
	// 倒计时
    var _time = parseInt($(".stamp").val())*1000;
    setInterval(function(){
    	countDown(_time);
    },1000)
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
            $(".timestamp").html("00"+":"+"00"+":"+"00");
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
	    	$(".timestamp").html(countHour+":"+countmin+":"+countsec)
	    }else{
	    	$(".timestamp").html(countDay+"天"+countHour+":"+countmin+":"+countsec)
	    }
	    if(countDay=="00"&&countHour=="00"&&countmin=="00"&&countsec=="00"){
	    	$(".timestamp").html("00"+":"+"00"+":"+"00");
	    } 
	    
	}

	// 填充背景色宽度
    function progressLen(){
	    var maxWidth = $(".active_progress").width();//外部框线
	    var lifePrice = $("#life_price").html();//原价
	    var floorPrice = $("#floor_price").html();//低价
	    var rule = Math.ceil($("#rule").val());//规则
	    var num = (lifePrice-floorPrice)/rule;//次数
	    var range = maxWidth/num;//幅度
	    var count = $("#qtyCount").html();;//人数

	    var pre = $("#pre").val();

	    var fillWidth = maxWidth*pre; 
	    if(fillWidth>=maxWidth){
            fillWidth=maxWidth;
            $(".target_go").hide();
            $(".target_suc").show();
	    }else{
	    	$(".target_go").show();
            $(".target_suc").hide();
	    }
	    $(".progress").css({
   	    	"width":fillWidth
   	    })
    }
    progressLen();
})