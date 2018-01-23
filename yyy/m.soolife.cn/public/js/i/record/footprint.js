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
			
		}else{
			$(this).html("编辑");
			$(this).parents(".header").next("#wrap").find(".record>li").find(".check").remove();
			$(this).parents(".header").next("#wrap").find(".record>li").find(".atten_bg").attr("class","edit_bg");
			$(this).parents(".header").next("#wrap").find(".record>li").find(".logo").attr("class","edit_logo");
			$(this).parents(".header").next("#wrap").find(".record>li").find(".txt").attr("class","edit_txt");
			$("#cancel").hide();
		}
	})
	// 点击筛选
	$(".record").on("click",".check",function(){
		var _src = $(this).attr("src");
     	var _src1 = "/public/img/i/mine_zhifu_yuan@3x.png";
     	var _src2 = "/public/img/i/mine_zhifu_d_yuan@3x.png";
     	if(_src == _src1 ){
     	    $(this).attr("src",_src2)
     	}else{
     		$(this).attr("src",_src1)
     	}
	})
	// 删除足迹
    $("#cancel").click(function(){
    	var check = [];
    	var _src2 = "/public/img/i/mine_zhifu_d_yuan@3x.png";
    	var _this = '';
    	$("#atten_baby li").each(function(){
    		if($(this).find(".check").attr("src") == _src2 ){
                check.push($(this).find("a").attr("data-id")) ;
    		}
    	})
    	$.ajax({
    	    url: '/i/record/delfootprint.html',
    	    type: 'POST',
    	    async: false,
    	    dataType: 'json',
    	    data: {'skuid':check},
    	    success:function(res){
    	        if(res.success == true){
                    $(".his_link").each(function(){
                    	if(check.indexOf($(this).attr("data-id")) != "-1" ){
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
    })
    // 下拉刷新
    window.onscroll=function(){
        var skip =$("#hidden").val();
        var docheight = $(document).height();               //整个网页的文档高度
        var screenheight = $(window).height();             //浏览器可视窗口的高度
        var scroll = $(window).scrollTop();               //浏览器可视窗口顶端距离网页顶端的高度（垂直偏移）
        var head_edit = $(".head_edit").html();
        if(screenheight+scroll >= docheight){
            $.ajax({
                url: '/i/footprintAjax',
                type: 'POST',
                dataType: 'json',
                data : {
                    "skip": skip,
                },
                success:function(res){
                    var data = res.data.items;
                    var str = '';
                    if(data !=""){
                        $("#hidden").val(res.data.skip);
                        for(var i=0;i<data.length;i++){
                            str= '<li>'
                                +    '<img class="check" src="/public/img/i/mine_zhifu_yuan@3x.png">'
                                +    '<a class="his_link" data-id="'+data[i].sku_id+'"  href=" '+data[i].url+'/'+data[i].sku_id+'.html ">'
                                +       '<div class="atten_bg" >'
                                +          '<img class="logo" src="'+data[i].logo+'">'
                                +            '<div class="txt">'
                                +               '<p class="title">'+data[i].name+'</p>'
                                +                 '<div id="footprint_num">'
                                +                    '<span>¥'+data[i].shop_price+'</span>'
                                +                    '<span>¥'+data[i].market_price+'</span>'
                                +                    '<span></span>'
                                +                '</div>'
                                +            '</div>'
                                +        '</div>'
                                +    '</a>'
                                +'</li>'
                            if(head_edit == "完成"){
                                $('#atten_baby').append(str);
                            }else{
                                $('#atten_baby').append(str);
                                $(".check").remove();
                                $(".atten_bg").attr("class","edit_bg");
                                $(".logo").attr("class","edit_logo");
                                $(".txt").attr("class","edit_txt");
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
})