$(function () {
	var express_name = $("#express_name").val();
	if(express_name.indexOf("全峰") != -1){
		$(".deliverMethod").find("img").attr("src","/public/img/orders/quanfeng@3x.png")
	}else if(express_name.indexOf("申通") != -1){
		$(".deliverMethod").find("img").attr("src","/public/img/orders/shentong@3x.png")

	}else if(express_name.indexOf("顺丰") != -1){
		$(".deliverMethod").find("img").attr("src","/public/img/orders/shunfeng@3x.png")

	}else if(express_name.indexOf("天天") != -1){
		$(".deliverMethod").find("img").attr("src","/public/img/orders/tiantian@3x.png")

	}else if(express_name.indexOf("邮政") != -1){
		$(".deliverMethod").find("img").attr("src","/public/img/orders/youzheng@3x.png")

	}else if(express_name.indexOf("圆通") != -1){
		$(".deliverMethod").find("img").attr("src","/public/img/orders/yuantong@3x.png")

	}else if(express_name.indexOf("韵达") != -1){
		$(".deliverMethod").find("img").attr("src","/public/img/orders/yunda@3x.png")

	}else {
		$(".deliverMethod").find("img").attr("src","/public/img/orders/order_deli@3x.png")

	}

})