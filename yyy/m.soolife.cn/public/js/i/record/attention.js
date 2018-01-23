$(function  () {
	var check = '<img class="check" src="/public/img/i/mine_zhifu_yuan@3x.png">';
	$(".head_edit").click(function(){
		var _this = $(this).html();
		
		if(_this == "编辑"){
			$(this).html("完成");
			$(this).parents(".header").next("#wrap").find(".record>li").prepend(check);
			$(this).parents(".header").next("#wrap").find(".record>li").find(".edit_bg").attr("class","atten_bg");
			$(this).parents(".header").next("#wrap").find(".record>li").find(".edit_logo").attr("class","logo");
			$(this).parents(".header").next("#wrap").find(".record>li").find(".edit_txt").attr("class","txt");
			$("#cancel").show();
			$("#store").hide();
			$(".head_title").hide()
			$(".head_title").each(function(){
				if($(this).is(".color")){
					$(this).show();
				}
			})
			
		}else{
			$(this).html("编辑");
			$(this).parents(".header").next("#wrap").find(".record>li").find(".check").remove();
			$(this).parents(".header").next("#wrap").find(".record>li").find(".atten_bg").attr("class","edit_bg");
			$(this).parents(".header").next("#wrap").find(".record>li").find(".logo").attr("class","edit_logo");
			$(this).parents(".header").next("#wrap").find(".record>li").find(".txt").attr("class","edit_txt");
			$("#cancel").hide();
			$("#store").show();
			$(".head_title").show()
		}
	})
	//点击切换宝贝与店铺
	$("#baby").click(function(){
        $("#atten_baby").show();
        $("#atten_store").hide();
        $("#atten_baby").addClass("record");
        $("#atten_store").removeClass("record");
        $("#baby").addClass("color");
        $("#store").removeClass("color");
	})
	$("#store").click(function(){
		$("#atten_baby").hide();
		$("#atten_store").show();
		$("#atten_baby").removeClass("record");
        $("#atten_store").addClass("record");
        $("#baby").removeClass("color");
        $("#store").addClass("color");
	})
	// 点击筛选
	$("#wrap").on("click",".check",function(){
		var _src = $(this).attr("src");
     	var _src1 = "/public/img/i/mine_zhifu_yuan@3x.png";
     	var _src2 = "/public/img/i/mine_zhifu_d_yuan@3x.png";
     	if(_src == _src1 ){
     	    $(this).attr("src",_src2)
     	}else{
     		$(this).attr("src",_src1)
     	}
	})

	// 取消关注
	$("#cancel").click(function(){
		var _html = $(".color").html();
		var _src2 = "/public/img/i/mine_zhifu_d_yuan@3x.png";
		var goodId = [];
		var shopId = [];
		if(_html == "宝贝"){
            $(".check").each(function(){
                if($(this).attr("src") == _src2){
                    goodId.push($(this).next("a").attr("data-id"));
                }
            })
        	$.ajax({
        	    url: '/i/record/delgoods.html',
        	    type: 'post',
        	    async: false,
        	    dataType: 'json',
        	    data: {'goodId':goodId},
        	    success:function(res){
        	        if(res.success == true){
                        $(".goods_link").each(function(){
                        	if(goodId.indexOf($(this).attr("data-id")) != "-1" ){
                        		$(this).parents("li").hide();
                        	}
                        })
                        $("#title").show();
                        $("#title").html(res.msg);
                        setTimeout(function(){
                        	$("#title").hide();
                        },2000)
        	        }
        	    }
        	});
 
		}else if(_html == "店铺"){
			$(".check").each(function(){
			    if($(this).attr("src") == _src2){
			        shopId.push($(this).next("a").attr("data-id"));
			    }
			})
			$.ajax({
			    url: '/i/record/delshop.html',
			    type: 'post',
			    async: false,
			    dataType: 'json',
			    data: {'shopId':shopId},
			    success:function(res){
			        if(res.success == true){
		                $(".shop_link").each(function(){
		                	if(shopId.indexOf($(this).attr("data-id")) != "-1" ){
		                		$(this).parents("li").hide();
		                	}
		                })
		                $("#title").show();
		                $("#title").html(res.msg);
		                setTimeout(function(){
		                	$("#title").hide();
		                },2000)
			        }
			    }
			});

		}
	})


    //  下拉刷新
    window.onscroll=function(){
    	var _html = $(".color").html();

        var good_skip =$(".good_skip").val();//商品
        var shop_skip =$(".shop_skip").val();//店铺

        var docheight = $(document).height();               //整个网页的文档高度
        var screenheight = $(window).height();             //浏览器可视窗口的高度
        var scroll = $(window).scrollTop();               //浏览器可视窗口顶端距离网页顶端的高度（垂直偏移）
        
        if(screenheight+scroll >= docheight){
            if(_html == "宝贝"){
            	var head_edit = $(".head_edit").html();
            	$.ajax({
            	    url: '/i/attentionGoods',
            	    type: 'POST',
            	    dataType: 'json',
            	    data : {
            	        "skip": good_skip,
            	    },
            	    success:function(res){
            	        var data = res.data.items;
            	        var str = '';
            	        if(data !=""){
            	            $(".good_skip").val(res.data.skip);
            	            for(var i=0;i<data.length;i++){
            	                str= '<li>'
            	                    +    '<img class="check" src="/public/img/i/mine_zhifu_yuan@3x.png">'
							        +    '<a class="goods_link"  data-id = "'+data[i].sku_id+'" href="'+data[i].url+'/'+data[i].sku_id+'.html">'
							        +		'<div class="atten_bg" >'
							        +			'<img class="logo" src="'+data[i].logo+'">'
								    +    		'<div class="txt">'
								    +   			'<p class="title">'+data[i].name+'</p>'
								    +    			'<div class="num">'
								    +    				'<span>¥'+data[i].market_price+'</span>'
								    +    				'<span>¥'+data[i].shop_price+'</span>'
								    +    			'</div>'
								    +    		'</div>'
							        +		'</div>'
							        +    '</a>'
						        	+'</li>'

									if(head_edit == "编辑"){
		                                $('#atten_baby').append(str);
		                                $(".check").remove();
		                                $(".atten_bg").attr("class","edit_bg");
		                                $(".logo").attr("class","edit_logo");
		                                $(".txt").attr("class","edit_txt");
									}else{
										$('#atten_baby').append(str);
									}
	            	            }
            	        }else{
            	            $("#none").show();
                            return;
            	        }
            	    }
            	});

            }else if(_html == "店铺"){
            	var head_edit = $(".head_edit").html();
                $.ajax({
                    url: '/i/attentionShops',
                    type: 'POST',
                    dataType: 'json',
                    data : {
                        "skip": shop_skip,
                    },
                    success:function(res){
                        var data = res.data.items;
                        var str = '';
                        if(data !=""){
                            $(".shop_skip").val(res.data.skip);
                            for(var i=0;i<data.length;i++){
                                str='<li>'
                                    +    '<img class="check" src="/public/img/i/mine_zhifu_yuan@3x.png">'
							        +    '<a class="shop_link"  data-id = "'+data[i].shop_id+'"  href="'+data[i].url+'/'+data[i].shop_id+'.html">'
							        +		'<div class="atten_bg" >'
							        +			'<img class="logo" src="'+data[i].logo+'">'
								    +   		'<div class="txt">'
								    +    			'<p class="title">'+data[i].name+'</p>'
								    +    			'<div class="num">'
								    +    				'<span class="date">'+data[i].create_time+'</span>'
								    +    			'</div>'
								    +    		'</div>'
							        +		'</div>'
						        	+	'</a>'
						        	+'</li> '
									if(head_edit == "编辑"){
		                                $('#atten_store').append(str);
		                                $(".check").remove();
		                                $(".atten_bg").attr("class","edit_bg");
		                                $(".logo").attr("class","edit_logo");
		                                $(".txt").attr("class","edit_txt");
									}else{
										$('#atten_store').append(str);
									}
                            }
                        }else{
                            $("#none").show();
                            return;
                        }
                    }
                });
            }

        }
    }
})