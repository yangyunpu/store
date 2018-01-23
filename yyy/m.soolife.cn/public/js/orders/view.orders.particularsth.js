$(function(){
	$(".bianju").click(function(){	
		countersign("1");
	});
	$(".fr").click(function(){	
		countersign("2");
	});
});
function countersign($status){
	var aftersales_id = $(".particularsth").attr("aftersales-id");
	$.ajax({
			url : "/orders/problem.html",
			data : {
				'aftersales_id' : aftersales_id,
				'status' : $status,
			},
			dataType : 'json',
			success: function(d){
				if(d.success){
					alert("确认成功!");
					window.location.href="/orders/aftersale.html";
				}else{
					alert("确认失败!");
				}
			}
		});	
}
