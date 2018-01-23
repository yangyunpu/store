$(function() {
	$(".star .icon-span").hover(function() {
		var a, b = $(this).index();
		for ($(this).parent().children().children("i").removeClass("icon-star").addClass("icon-star-empty"), a = 0; b >= a; a++)
		{
			$(this).parent().children().eq(a).children("i").addClass("icon-star").removeClass("icon-star-empty");
		}
		
	});
	
	$(".btnCommon").click(function(){	
		//需要评论的商品列表
        console.log("需要评论的商品列表")
        var main = $(this).parents(".productparentBox"),      
        	sku_id = main.children(".shopName").attr("data-sku-id"),    //商品SKU_ID
        	content = main.find(".commentText").val(),					//商品评论
        	grade = main.find(".commentBox .star .icon-star").length,	//商品的评价	
		    order_id = main.attr("data-order-id"),                      //订单ID
	        grade_package = main.find(".orderCommentBox .package .icon-star").length, //商品包装满意度
		    grade_deliveriy = main.find(".orderCommentBox .deliveriy .icon-star").length, //送货速度
		    grade_service = main.find(".orderCommentBox .service .icon-star").length; //服务（配送人员的服务满意度）
		console.log(main);
		console.log(sku_id);
		console.log(content);
		console.log(grade);
		console.log(order_id);
		console.log(grade_package);
		console.log(grade_deliveriy);
		console.log(grade_service);
		var data = {
			"order_id" : order_id,
			"grade_package" : grade_package,
			"grade_deliveriy" : grade_deliveriy,
			"grade_service" : grade_service,
			"sku_id"     :sku_id,
			"content"  : content,
			"grade" : grade
		};
		var data_order_url = $("#comments_main").attr("data-order-url");
		console.log(data_order_url)
		$.ajax({
			url : data_order_url,
			type : 'post',
			data : data,
			dataType : 'json',
			success : function(d) {
				console.log(d)
				if (d.success) {
					//alert("评价超过15个字,有图片,即可赠送星币");
					alert("评论成功");
					window.location.href="/orders/index.html";
				} else {
					$("#error").html(d['data']['Message']);
				}
			}	
		});	
	});	
});