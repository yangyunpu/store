$(function  () {
	var take = 10;
	var status = '';
	$(".coupon_classly>span").click(function(){
		// 初始化
		$("#nocoupon").html("");
		$("#skip").val(0);
		var _html = $(this).html();
		var skip = $("#skip").val();
		$(this).addClass("coupon_color");
		$(this).siblings("span").removeClass("coupon_color")
		if(_html == "未使用" ){
			status = 0;
			$(".right_img").attr("src","/public/img/i/mine_coupon_use@3x.png")
		}else if (_html == "已使用" ){
			status = 1;
			$(".right_img").attr("src","/public/img/i/bg_youhuiquan@3x.png")
		}else{
			status = 2;
			$(".right_img").attr("src","/public/img/i/bg_youhuiquan@3x.png")
		}
	    coupon(skip,take,status)
	})
 // 下拉刷新
    window.onscroll=function(){
        var skip =$("#skip").val();
        status = $(".coupon_color").html();
        if(status == "未使用" ){
        	status =0;
        }else if(status == "已使用"){
        	status =1;
        }else{
        	status =2;
        }
        var docheight = $(document).height();               //整个网页的文档高度
        var screenheight = $(window).height();             //浏览器可视窗口的高度
        var scroll = $(window).scrollTop();               //浏览器可视窗口顶端距离网页顶端的高度（垂直偏移）
        
        if(screenheight+scroll >= docheight){
        	skip = Number(skip)+10;
            coupon(skip,take,status)
        }
    }
    function coupon(skip,take,status){
    	    $.ajax({
    	        url: '/i/couponAjax',
    	        type: 'POST',
    	        dataType: 'json',
    	        async: false,
    	        data : {
    	            "skip": skip,
    	            "take": take,
    	            "status": status,
    	        },
    	        success:function(res){
    	        	// console.log(res)
    	        	$("#skip").val(res.data.skip);
    	        	if(res.data.data.length>0){
	    	        	var str = '';
	    	        	var data = res.data.data;
	    	        	var status_title = '';
	    	        	if(res.data.status==0){
	    	        		status_title = "使用"
	    	        		status_src = "/public/img/i/mine_coupon_use@3x.png"
	    	        	}else if(res.data.status==1){
	    	        		status_title = "已使用"
	    	        		status_src = "/public/img/i/bg_youhuiquan@3x.png"
	    	        	}else{
	    	        		status_title = "已过期"
	    	        		status_src = "/public/img/i/bg_youhuiquan@3x.png"
	    	        	}
	    	        	if(res.success == true){
	    	        		for (var i =0; i <data.length; i++) {
	    	        			if(data[i].shop_name != ""){
	    	        				data[i].shop_name = "商家券 | "+data[i].shop_name;
	    	        			}
	    	        			if(data[i].ways == 1){
	    	        				data[i].shop_name = "平台券 | 全场通用"
	    	        			}else{
	    	        				data[i].shop_name = "平台券 | 部分通用"
	    	        			}
	    	                    str = '<li>'
	    			            	+	'<div class="coupon_left">'
	    			            	+		'<div class="coupon_title">'+data[i].shop_name+'</div>'
	    			            	+		'<div class="coupon_money">'
	    			            	+			'<div class="coupon_face">'
	    			                +               '<div class="face_num">'+data[i].face_value+'</div>'
	    			                +				'<div class="face_unit">'
	    			                +                   '<p class="face_yuan">元</p>' 
	    			                +                   '<p class="face_quan">优惠券</p>'           
	    			                +                '</div>'
	    			            	+			'</div>'
	    			            	+			'<div class="coupon_term">'
	    			            	+				'<p class="term_full">满'+data[i].coupon_limit+'减'+data[i].face_value+'</p>'
	    			                +                '<p class="term_date">有效期:'+data[i].begin_date+'-'+data[i].end_date+'</p>'
	    			            	+			'</div>'
	    			            	+		'</div>'
	    			            	+	'</div>'
	    			            	+	'<div class="coupon_right">'
	    			            	+		'<img class="right_img" src='+status_src+'>'
	    			                +        '<div class="right_title">'+status_title+' </div>'
	    			            	+	'</div>'
	    			            	+'</li>'
	    			            	$("#nocoupon").append(str);
	    	        		};
	    	        	}
    	        	}else{
                        return;
    	        	}
    	      	}
    	    })
    }
})