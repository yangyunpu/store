$(function(){
	$(".complete").click(function(){   //全部售后列表
		var status = 0;
		$(this).addClass("navActive").siblings().removeClass('navActive');
		condition(status);
	});
	
	
	$(".proceed").click(function(){  //售后进行中
		var status = 1;
		$(this).addClass("navActive").siblings().removeClass('navActive');
		condition(status);
	});
		
	$(".achieve").click(function(){  //售后已完成
		var status = 2;
		$(this).addClass("navActive").siblings().removeClass('navActive');
		condition(status);
	});
	
	$(".picture_adsd").click(function(){   
		aftersales_id = $(this).attr("aftersales-id");
		window.location.href="/orders/particularsth/" + aftersales_id + ".html";	
	});
	//取消售后
	$(".botom_dsjahd").on("click",function(){
		var aftersales_id = $(this).attr('aftersales_id');
		countersign(aftersales_id);
	})
});

function condition(status){
	$.ajax({
		url : "/orders/aftersale.html",
		data : {
			'status' : status,
		},
		success : function(result){
			$(document.body).html(result);
		}
	});
}

//取消售后
function countersign(aftersales_id){
	$.ajax({
			url : "/orders/editstatus.html",
			data : {
				'aftersales_id' : aftersales_id,
			},
			dataType : 'json',
			success: function(d){
				if(d.success){
					alert("取消成功!");
					location.reload(); 
				}else{
					alert("取消失败!");
				}
			}
		});	
}
