var isFirst = true;
$(function(){
	console.log("onload........");
	var index=1;
	var temp = $(".navOrders .navActive").attr('class');
	if(temp.indexOf('complete') > -1)
	{
		var status='';
	}else if(temp.indexOf('obligation') > -1)
	{
        var status=1;
	}else if(temp.indexOf('dropshipping') > -1)
	{
		var status=3;
	}else if(temp.indexOf('achieve') > -1)
	{
		var status=4;
	}else if(temp.indexOf('abolish') > -1)
	{
		var status=6;
	}
	//取消订单
	$(".middle_aera").on("click",".cancel",function(){
		var order_id = $(this).attr("orderno"),
			type     = $(this).attr("data-type");
		//var cancel_url = "/orders/cancel/" + order_id + ".html";
		var cancel_url = "/orders/cancel/" + order_id+"/"+type+".html";
		$.ajax({
			url : cancel_url,	
			dataType : 'json',
			success : function (d){
				if(d.success){
					alert(d.data.msg);
					window.location.reload();
				}else{
					alert("取消失败!");
				}
			}	
		});	
	});
	//去支付
	$(".middle_aera").on("click",".pay",function(){
		var order_id    = $(this).attr("order_id");
		var url_order =$(".orderButtons").attr("url_order");
		var order_url = url_order+"/order/orderpay.html?order_id="+order_id;
		location.href = order_url;
	});
	
	//确认收货
	$(".middle_aera").on("click",".affirm",function(){
		var order_id = $(this).attr("data-order-id");
		var cancel_url = "/orders/confirm/" + order_id + ".html";
		$.ajax({
			url: cancel_url,
			dataType : 'json',
			success : function(d){
				if(d.success){
					alert("确认收货成功!");
					window.location.reload();
				}else{
					alert("确认失败!");
				}
			}	
		});	
	});
	
	//订单评论
	$(".middle_aera").on("click",".comment",function(){
		var orderno = $(this).attr("data-order-id");
		var cancel_url = "/orders/comment/" + orderno + ".html";
		window.location.href = cancel_url;
		});	
		
	//订单详情页
	$(".middle_aera").on("click",".goods_details",function(){
		var order_id = $(this).attr("order-no");
		window.location.href ="/orders/details/" + order_id + ".html";
	});
		
	//全部订单
	$(".complete").click(function(){
		status = '';
		$(this).addClass("navActive").siblings().removeClass("navActive");
		condition(status);
	});
	
	//代付款
	$(".obligation").click(function(){
		status = 1;
		$(this).addClass("navActive").siblings().removeClass("navActive");
		condition(status);
		
	});
	
	//代发货
	$(".dropshipping").click(function(){
		status = 3;
		$(this).addClass("navActive").siblings().removeClass("navActive");
		condition(status);
		
	});
	
	//交易完成
	$(".achieve").click(function(){
		status = 4;
		$(this).addClass("navActive").siblings().removeClass("navActive");
		condition(status);
		
	});
	
	//交易取消
	$(".abolish").click(function(){
		status =6;
		$(this).addClass("navActive").siblings().removeClass("navActive");
		condition(status);	
	});

	//订单状态
	function condition(status){
		//$(".middle_aera").empty();
		$(".perOrderBox").remove();
		index=1;
		$.ajax({
				url : "/orders/index.html?act=1",
				data : {
				'status' : status,
			},
			success: function(result){ 
				//console.log(result.trim().length);
	            if(result.trim().length !=0)
	            $(".middle_aera").html(result); 
	            else
	            $(".middle_aera").html('<div class="searchno" style="width:70%;"><img src="/public/mobile/img/sss_03.png" /><br /><br /><b>暂无订单</b></div>'); 
	         }
		});
	}

    //下拉加载更多
	$(window).scroll(function(){
		var totalheight = parseInt($(this).height())+parseInt($(this).scrollTop());
        var documentHeight =  $(document).height();
        if(totalheight >= documentHeight){
        if($('.searhloading').attr('value') == 1){
            return false;
        }
         index++;
         scroll_load();
     }
	});

	function scroll_load(){
		if($('.middle_aera').children().last().is('.nomore')){
	        return;
	    }
	    $.ajax({
	    	url : "/orders/index.html?scroll=1&status="+status,
	    	type : "post",
	    	data : {
	    		"index" :index,
	    	},
	    	beforeSend:function(){
	    		$('.main').append('<div class="searhloading" value="1" style="height:30px;font-size:15px;text-align:center;line-height:30px;"><i class="icon-spin icon-spinner"></i>正在加载中...</div>');
	    	},
	    	success : function(result){
	    		console.log(result);
	    		        $(".searhloading").remove();
	    	            if(result.trim().length == 113) {
	    	            if(isFirst == true){
	    	            	$('.main').append('<div class="evaluate nomore" style="text-align:center;border:1x solid #ccc;height:50px;line-height:50px;font-size:14px">&nbsp;&nbsp;没有更多订单了！！！</div>');
	    	            	window.setTimeout(function(){ 
							   $('.evaluate') .remove();
							}, 4000); 
	    	            	isFirst = false;
	    	            }    
					     return;
					   }else{
					   	$('.middle_aera').append(result);
					  }			   
	    		}
	    })
	}

});

