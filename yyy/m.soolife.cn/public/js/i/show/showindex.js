$(function  () {
	var handler = function () {
	    event.preventDefault();
	    event.stopPropagation();
    };
  
    // 隐藏蒙版
	$("#show_mask").click(function(){
		$("#show_mask").hide();
		// 更改底层页面
		document.body.removeEventListener('touchmove',handler,false);
        document.body.removeEventListener('wheel',handler,false);
	})
	// 加载更多  星粉秀
	// 下拉刷新
	window.onscroll=function(){
	    var skip =$("#hidden").val();
	    var docheight = $(document).height();               //整个网页的文档高度
	    var screenheight = $(window).height();             //浏览器可视窗口的高度
	    var scroll = $(window).scrollTop();               //浏览器可视窗口顶端距离网页顶端的高度（垂直偏移）
        // console.log(skip)

	    if(screenheight+scroll >= docheight){
	        $.ajax({
	            url: '/i/show/showMore.html',
	            type: 'POST',
	            dataType: 'json',
	            data : {
	                "skip": skip,
	            },
	            success:function(res){
	            	// console.log(res);
	                var data = res.data.data;
	                var str = '';
	                var str1 = '';
	                if(data !=""){
	                    $("#hidden").val(res.data.skip);
	                    for(var i=0;i<data.length;i++){
                        // console.log(data[i].audit_status)
                            if(data[i].audit_status == 0){
		                        str= '<li>'
						        	+	'<img class="show_img" src="'+data[i].photo+'">'
						        	+	'<div class="show_con" data-id = "'+data[i].id+'">'
						        	+		'<p class="show_date">'+data[i].create_time+'</p>'
						        	+		'<p class="show_txt">'+data[i].memo+'</p>'
						        	+		'<div class="show_bottom">'
                                    +       '<p class="show_check">待审核</p>'
                                    +		'</div>'
                                    +	'</div>'
                                    +'</li>'
                            }else if(data[i].audit_status == 1){
    	                        str= '<li>'
    					        	+	'<img class="show_img" src="'+data[i].photo+'">'
    					        	+	'<div class="show_con" data-id = "'+data[i].id+'">'
    					        	+		'<p class="show_date">'+data[i].create_time+'</p>'
    					        	+		'<p class="show_txt">'+data[i].memo+'</p>'
    					        	+		'<div class="show_bottom">'
    					        	+	    '<p class="check">已审核发布</p>'
	    					        +		'</div>'
	    					        +	'</div>'
	    					        +'</li>'
                            }else{
    	                        str= '<li>'
    					        	+	'<img class="show_img" src="'+data[i].photo+'">'
    					        	+	'<div class="show_con" data-id = "'+data[i].id+'">'
    					        	+		'<p class="show_date">'+data[i].create_time+'</p>'
    					        	+		'<p class="show_txt">'+data[i].memo+'</p>'
    					        	+		'<div class="show_bottom">'
    	        		            +        '<p class="show_check">审核未通过</p>'
    	        		            +        '<a class="show_btn" data-item="'+data[i].audit_status_text+'">查看原因</a>'
    					        	+		'</div>'
    					        	+	'</div>'
    					        	+'</li>'

                            }
	                        $("#showlist").append(str);
	                        alertMask();
	                    }
	                }else{
	                    $("#none").show();
	                    return;
	                }
	            }
	        });

	    }
	}


    function alertMask(){

		$("#showlist").on("click",".show_btn",function(){
			var _text = $(this).attr("data-item");
			var _txt = _text+",无法正常发布展示,如有疑问,请联系我们."
			$(".mask_con>p").html(_txt)
			$("#show_mask").show();
			// 初始化底层页面
			document.body.addEventListener('touchmove',handler,false);
	        document.body.addEventListener('wheel',handler,false);
		})
	    
	    // 链接跳转
	    $("#showlist>li").each(function(){
	    	var _html = $(this).find(".show_bottom>p").html();
	    	if(_html == "待审核"){
	    		$(this).click(function(){
					$(".mask_con>p").html("该星粉秀正在审核中,不要心急哦~");
					$("#show_mask").show();
					// 初始化底层页面
					document.body.addEventListener('touchmove',handler,false);
			        document.body.addEventListener('wheel',handler,false);
	    		})

	    	}else if(_html == "已审核发布"){
	            $(this).click(function(){
	            	var fanshow_id = $(this).find(".show_con").data("id");
	            	window.location.href = "/lifehui/showdetail.html?fanshow_id="+fanshow_id;
	            })
	 
	    	}else if(_html == "审核未通过"){
	    		$(this).click(function(){
	    			console.log(3333333333)
					var _text = $(this).find(".show_btn").attr("data-item");
					var _txt = _text+",无法正常发布展示,如有疑问,请联系我们."
					$(".mask_con>p").html(_txt)
					$("#show_mask").show();
					// 初始化底层页面
					document.body.addEventListener('touchmove',handler,false);
			        document.body.addEventListener('wheel',handler,false);
	    		})
	    		
	    	}

	    })
    }
    alertMask();



    // 判断浏览器
    function browserRedirect() {
    	var sUserAgent = navigator.userAgent.toLowerCase();
    	var bIsIpad = sUserAgent.match(/ipad/i) == "ipad";
    	var bIsIphoneOs = sUserAgent.match(/iphone os/i) == "iphone os";
    	var bIsMidp = sUserAgent.match(/midp/i) == "midp";
    	var bIsUc7 = sUserAgent.match(/rv:1.2.3.4/i) == "rv:1.2.3.4";
    	var bIsUc = sUserAgent.match(/ucweb/i) == "ucweb";
    	var bIsAndroid = sUserAgent.match(/android/i) == "android";
    	var bIsCE = sUserAgent.match(/windows ce/i) == "windows ce";
    	var bIsWM = sUserAgent.match(/windows mobile/i) == "windows mobile";
    	if(bIsIpad || bIsIphoneOs || bIsMidp || bIsUc7 || bIsUc || bIsAndroid || bIsCE || bIsWM) {
    		$("#show_mask").find(".a_tel").attr("href","tel:400—068—5151")
    	} else {
    		$("#show_mask").find(".a_tel").removeAttr("href")
    	}
    }

    browserRedirect(); 
})