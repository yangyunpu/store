(function(){
	var skip =0;
    var take =10;
	/**
	* 
	* @return 领金币登录
	* @param 
	* @author zhichao_hu@soolife.com.cn
	* @date 
	*/
	var success = $(".star_coin").attr('success');
	var token   = $('.head_nav').attr('token');
	if(success && token != 0){
		$(".mask_layer").css("display",'block');
	}

	$(".login").on("click",function(){
		var url_member       = $(".head_nav").attr("url_member");
		$.base64.utf8encode  = true;
		var url              = $.base64.btoa(window.location.href);
		window.location.href = url_member+"/login.html?return_url="+url;
        
	});


	/**
	* 
	* @return 单击分类变色
	* @param 
	* @author zhichao_hu@soolife.com.cn
	* @date 
	*/
	$(".head_nav ul li:gt(0)").click(function(){
		$(this).siblings().removeClass('active');
		$(this).addClass('active');
		var url_search      = $(".head_nav").attr("url_search");
		var code            = $.trim($(this).attr("code"));
		window.location.href=url_search+"/cat/"+code+".html?is_coin=1";
	});

	(function($) {//懒加载...
        $(document).imageLazyload({
            placeholder: '/public/img/defaultimg.png'
        });  
    })(mui);

    //hide box
	$(".mask_layer .tubi").click(function(){
		$(".mask_layer").hide();
	});

    /**
    * 
    * @return 星换购
    * @param 
    * @author zhichao_hu@soolife.com.cn
    * @date 
    */
    $("#star_sale_nav li").eq(0).addClass('actived');
	$("#star_sale_nav li").click(function(){
		$(this).siblings().removeClass('actived');
        $(this).addClass('actived');
		var url_goods = $("#star_sale_nav").attr("url_goods");
		var text      = $(this).text();
		var post      = getRange(text);
	    skip  =0;
        take  =10;
		post.skip =skip;
        post.take =take;
		$.ajax({
			url      : "/sale.html",
            type     : "post",
            dataType : "json",
            ContentType:"application/x-www-form-urlencoded",
            data     : post,
            success : function(data){
            	$("#xing_hot_slider #item1mobile").remove();
            	var num         = "0";
            	var data_list   = '';
                data_list       = data.data['items'];
            	var append_data = '';
            	if(data_list == ''){
            		append_data += '<div class="not"><img src="/public/img/life/zanwushuju.png"></div>';
            	}else{
            		for(var i in data_list){
            			if(data_list[i].promo){
                               append_data += '<div class="xing_hot_goods_1"><div class="img_box"><a href="'+url_goods+'/'+data_list[i].id+'.html"><img  src="'+data_list[i].logo+'" alt="" class="img_t"></a></div><p>'+data_list[i].name+'</p><p class="piece"><img src="/public/img/tag1.png" alt=""><span class="piece_big">'+data_list[i].promo.coin+'</span>&nbsp;+<span  class="piece_small">￥'+data_list[i].promo.price+'</span></p></div>';
	                    }else{
	                           append_data += '<div class="xing_hot_goods_1"><div class="img_box"><a href="'+url_goods+'/'+data_list[i].id+'.html"><img  src="'+data_list[i].logo+'" alt="" class="img_t"></a></div><p>'+data_list[i].name+'</p><p class="piece"><img src="/public/img/tag1.png" alt=""><span class="piece_big">'+num+'</span>&nbsp;+<span  class="piece_small">￥'+data_list[i].price+'</span></p></div>';
	                    }

            		}
            	}
            	append_mata = '<div id="item1mobile" class="mui-control-content mui-active">'+append_data+'</div>';
            	$('#xing_hot_slider').append(append_mata);
            }

		});


	});


	/**
	* 
	* @return 
	* @param  download
	* @author zhichao_hu@soolife.com.cn
	* @date 
	*/
    $(window).scroll(function(){
        var totalheight = parseInt($(this).height())+parseInt($(this).scrollTop());
        var documentHeight =  $(document).height();
        if(totalheight >= documentHeight){
        if($('.searhloading').attr('value') == 1){
            return false;
        }
        var url_goods = $("#star_sale_nav").attr("url_goods");
        var text  = $(".actived").text();
        var post  = getRange(text);
        skip      = skip+10;
        post.skip =skip;
        post.take =take; 
        scroll_load(post,url_goods);
     }

    });

    function scroll_load(post,url_goods)
    {
    	$.ajax({
			url      : "/sale.html",
            type     : "post",
            dataType : "json",
            ContentType:"application/x-www-form-urlencoded",
            data     : post,
            beforeSend:function(){
            $('#item1mobile').append('<div class="searhloading" value="1" style="text-align:center;border:1x solid #ccc;height:50px;line-height:50px;font-size:14px"><i class="icon-spin icon-spinner"></i>正在加载中...</div>');
            },
            success : function(data){
            	setTimeout
            	$(".searhloading").remove();
            	var num         = "0";
            	var data_list   = '';
            	data_list   = data.data['items'];
            	var append_data = '';
            	if(data_list == ''){
            		$(".evaluate").remove();
            		append_data += '<div class="evaluate nomore" style="text-align:center;border:1x solid #ccc;height:50px;line-height:50px;font-size:14px">&nbsp;&nbsp;没有更多商品了！！！</div>';
            	}else{
            		for(var i in data_list){
            			if(data_list[i].promo){
                               append_data += '<div class="xing_hot_goods_1"><div class="img_box"><a href="'+url_goods+'/'+data_list[i].id+'.html"><img  src="'+data_list[i].logo+'" alt="" class="img_t"></a></div><p>'+data_list[i].name+'</p><p class="piece"><img src="/public/img/tag1.png" alt=""><span class="piece_big">'+data_list[i].promo.coin+'</span>&nbsp;+<span  class="piece_small">￥'+data_list[i].promo.price+'</span></p></div>';
	                    }else{
	                           append_data += '<div class="xing_hot_goods_1"><div class="img_box"><a href="'+url_goods+'/'+data_list[i].id+'.html"><img  src="'+data_list[i].logo+'" alt="" class="img_t"></a></div><p>'+data_list[i].name+'</p><p class="piece"><img src="/public/img/tag1.png" alt=""><span class="piece_big">'+num+'</span>&nbsp;+<span  class="piece_small">￥'+data_list[i].price+'</span></p></div>';
	                    }

            		}
            	}
            	$('#item1mobile').append(append_data);
            }

		});

    }


	function getRange(text)
	{
		var post = {};
		switch (text)
		{
		case "全部":
		  post.coin_min =0;post.coin_max =00;post.skip =0;post.take =10;  
		  break;
		case "0--100":
		  post.coin_min =0;post.coin_max =100;post.skip =0;post.take =10;  
		  break;
		case "100--500":
		  post.coin_min =100;post.coin_max =500;post.skip =0;post.take =10;  
		  break;
		case "500--1000":
		  post.coin_min =500;post.coin_max =1000;post.skip =0;post.take =10;  
		  break;
		case "1000以上":
		  post.coin_min =1000;post.coin_max =00;post.skip =0;post.take =10;  
		  break;
		  default:
		  post.coin_min =0;post.coin_max =00;post.skip =0;post.take =10;  
		}
        return post;
	}



})();