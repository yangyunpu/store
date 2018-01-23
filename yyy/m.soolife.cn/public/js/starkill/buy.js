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
	// 立即购买

		var _time =parseInt($(".buystamp").val())*1000;
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
		var countmin = Math.floor((differSec-countDay*24*60*60-countHour*60*60)/60)
	    var countsec = Math.floor(differSec-countDay*24*60*60-countHour*60*60-countmin*60)
	    if(countDay<0){
            $(".stamp").html("00"+":"+"00"+":"+"00");
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
	    	$(".stamp").html(countHour+":"+countmin+":"+countsec)
	    }else{
		    $(".stamp").html(countDay+"天"+countHour+":"+countmin+":"+countsec)
	    }
	    if(countDay=="00"&&countHour=="00"&&countmin=="00"&&countsec=="00"){
	    	$(".stamp").html("00"+":"+"00"+":"+"00");
	    } 
	}
	// 弹框出现
	$(".detail_buy").click(function(){
		$(".alert_wrap").show();

		var rule = $(".rule").val();//现价
		$(".coin_sum").html(rule)
       // 初始化底层页面
		document.body.removeEventListener('touchmove',handler,false);
        document.body.removeEventListener('wheel',handler,false);
		
	})
    // 弹框消失
	$(".alert_bg").click(function(){
		$(".alert_wrap").hide();
		// 更改底层页面
		document.body.addEventListener('touchmove',handler,false);
        document.body.addEventListener('wheel',handler,false);

		$("#result").val(1);

	})

	// 加减号
	function coinCount (){
		var sumMoney='';//实付金额
		var num ='';//购买件数
		var rule = $(".rule").val();//现价
		rule = rule.replace(",","")
        // 初始化
        $("#result").val(1);
		$(".coin_sum").html(rule)

		$("#plus").click(function(){
			num = $(this).siblings("input").val();
			num++;
			sum = rule*num;
			sum = sum.toFixed(2);
			$(this).siblings("input").val(num);
			$(".coin_sum").html(sum);
		})
		$("#minus").click(function(){
			num = $(this).siblings("input").val();
            num--;
            sum = rule*num;
			sum = sum.toFixed(2);
            if(num>0){
				$(this).siblings("input").val(num);
				$(".coin_sum").html(sum);
            }
		})
		// input输入框
		$("#result").blur(function(){
			num = $(this).val();
			if(num<1){
                $(this).val(1);
                num=1;
			}
			sum = rule*num;
			sum = sum.toFixed(2);
			$(this).val(num);
		    $(".coin_sum").html(sum);
		})
	}
	// 调用加减号
	coinCount ();
    // 确认购买
	$("#suc_buy").click(function(){
        var qty = parseInt($("#result").val());//购买件数
        var sku_id = $(".starkill_id").val();
        var redeem_code = $(".redeem_code").val();//兑换码
        var url = $("#url").val();
        var limitQty = parseInt($("#qty_num").html());
        if(qty>limitQty){
        	$("#alert_coin").show();
            $("#alert_coin").html("不能购买更多了!")
			setTimeout(function(){
                $("#alert_coin").hide();
            },1000)
        }else{
        	window.location.href=url+"/order/index.html?skuid="+sku_id+"&qty="+qty+"&type=1&order_type=true&redeem_code="+redeem_code;
        }
	})
})