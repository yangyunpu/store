isApp = /SoolifeApp/i.test(navigator.userAgent);
if(isApp) {
	$(".header").hide();
	$(".void").hide();
}else{
    $(".header").show();
    $(".void").show();
}

$(function(){


	$(".styles>ul").find("li").first().attr('class','red');
	$(".wrap").on("click",".styles ul li",function(){
		$(this).addClass('red').siblings('').removeClass("red");
		var code = $(this).find("input").val();
		codeAjax(code);
	});
	function codeAjax(code){
		$.ajax({
			url: '/starmodel/cloth',
			type: 'POST',
			dataType: 'json',
			data: {
				"code": code,
			},
			success:function(res){
				// console.log(res);
				if(res.success){
					$("#hidden").val(res.data.skip);
					append_data(res);
					webSdk.b_event();
					webSdk.openGoodsDetail();
				}else{
					console.log('没有更多数据...');
				};
			}
		});
};

	// //////////添加拼接字符串////////////////////////////////////
	function append_data(res){
        var data = res.data.items;
        var str = '';
        if(res.msg){
        	if(data){
	            for(var i=0;i<data.length;i++){
	                     str +='<div class="code open-goods-detail" data-goods-id='+data[i].id+'>'
	                         +'<div class="code_img">'
	                         +'<img src="'+ data[i].logo+'">'
	                         +'</div>'
	                         +'<div class="code_title">'
	                         +'<p>'+ data[i].name+'</p>'
	                         +'<div class="voids"></div>'
	                         +'<div class="pricsd">'
	                         +'<span class="ruling">￥'+ data[i].price+'</span><span class="original">￥'+data[i].market_price+'</span>'
	                         +'</div>'
	                         +'</div>'
	                         +'</div>';
	            };
        	}else{
        		str="<img class='no_data' src='/public/img/starmodel/zanwushuju.png'>";
        	}
        }
        $('.fg_h').html('').append(str);
        $('#hidden').val(res.data.skip);
    };


// 下拉刷新
    window.onscroll=function(){
        var hidden =$("#hidden").val();
        var skip =$("#skip").val();
        var docheight = $(document).height();               //整个网页的文档高度
        var screenheight = $(window).height();             //浏览器可视窗口的高度
        var scroll = $(window).scrollTop();               //浏览器可视窗口顶端距离网页顶端的高度（垂直偏移）
        if(typeof(skip) != "undefined" && hidden == ''){
        	hidden = skip;
        }
        if(hidden == ''){
        	hidden = 0;
        }
        var code = $(".red").find(".code").val();
        if(screenheight+scroll >= docheight){
            $.ajax({
                url: '/starmodel/categories.html',
                type: 'POST',
                dataType: 'json',
                async:false,
                data : {
                    "hidden": hidden,
                    "code": code,
                },
                success:function(res){
			        if(res.success){
	                	var data = res.data.items;
				        var str = '';
			        	if(data.length > 0){
				            for(var i=0;i<data.length;i++){
				                     str +='<div class="code open-goods-detail" data-goods-id='+data[i].id+'>'
				                         +'<div class="code_img">'
				                         +'<img src="'+ data[i].logo+'">'
				                         +'</div>'
				                         +'<div class="code_title">'
				                         +'<p>'+ data[i].name+'</p>'
				                         +'<div class="voids"></div>'
				                         +'<div class="pricsd">'
				                         +'<span class="ruling">￥'+ data[i].price+'</span><span class="original">￥'+data[i].market_price+'</span>'
				                         +'</div>'
				                         +'</div>'
				                         +'</div>';
				            };
					        $('.fg_h').append(str);
					        webSdk.b_event();
			        	}else{
				        	$("#none").show();
				        	return;
			        	}
				        $('#hidden').val(res.data.skip);
			        }else{
		        		str="<img class='no_data' src='/public/img/starmodel/zanwushuju.png'>";
				        $('.fg_h').html('').append(str);
			        }
		        }
            });

        }
    }



});




