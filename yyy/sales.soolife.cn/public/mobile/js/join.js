$(function(){
	$('.joins').click(function(){
		var lucky_id = $(this).parent().attr("data-val");
		var _id = $(this).parent().attr("data-goods-id");
		$.ajax({
			url:"/m/lucky/judgePromo.html",
			type:"post",
			data:{
				'lucky_id' : lucky_id
			},
			contentType:'application/x-www-form-urlencoded',
			dataType:'json',
			success : function(d) {
				if (d.data == 1) {
					var buyT = 2;
					var buyN = 1;
					var _href = 'http://orders.soolife.web/m/order/index.html?skuid='+_id+'&qty='+buyN+'&type='+buyT+'&order_type=true';
					appSDK.openInstantBuy({instant_item_type:buyT, instant_item_id:_id, instant_item_qty:buyN}, _href);
				}else{
					alert('啊哦！活动下线了。。。');
					window.location.reload();
				}
			}
		});
	});
});

