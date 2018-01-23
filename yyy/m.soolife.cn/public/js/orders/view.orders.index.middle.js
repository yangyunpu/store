$(function(){
$(".cancel").click(function(){
		var order_id = $(this).attr("data-order-id");
		var cancel_url = "/orders/cancel/" + order_id + ".html";
		$.ajax({
			url : cancel_url,	
			dataType : 'json',
			success : function (d){
				if(d.success){
					alert("取消成功!");
					window.location.reload();
				}else{
					alert("取消失败!");
				}
			}	
		});	
	});
	//去支付
	$(".pay").click(function(){
		var sku_id    = $(this).attr("sku_id");
		var qty       = $(this).attr("qty");
		var url_order =$(".orderButtons").attr("url_order");
		var order_url = url_order+"/order/index.html?skuid="+sku_id+"&qty="+qty+"&type=1&order_type=true";
		if(order_url)
		location.href = order_url;
	});
	
	//确认收货
	$(".affirm").click(function(){
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
	$(".comment").click(function(){
		var orderno = $(this).attr("orderno");
		var cancel_url = "/orders/comment/" + orderno + ".html";
		window.location.href = cancel_url;
	});	
		
	//订单详情页
	$(".orderProduct").click(function(){
		var order_id = $(this).attr("order-no");
		window.location.href ="/orders/details/" + order_id + ".html";
	});
});
