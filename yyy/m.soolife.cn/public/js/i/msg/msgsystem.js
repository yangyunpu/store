$(function  () {
	$("#wrap").on("click",".system_more",function(){
		var _html = $(this).find("p").html()
		if(_html=="查看全部"){
			$(this).parents(".system_txt").find(".system_change").removeClass("system_intro");
			$(this).parents(".system_txt").find(".system_change").addClass("system_all");
			$(this).find("p").html("收起")
		}else{
			$(this).parents(".system_txt").find(".system_change").removeClass("system_all");
			$(this).parents(".system_txt").find(".system_change").addClass("system_intro");
			$(this).find("p").html("查看全部")
		}
	})

    // 获取文档的高度
	function height(){
	    $(".system_change>p").each(function(){
	    	var _height = $(this).innerHeight();
	    	if(_height > 42){
	    		$(this).parent(".system_change").next(".system_more").show();
	    		$(this).addClass("height");
	    	}else{
	    		$(this).parent(".system_change").next(".system_more").hide();
	    		$(this).removeClass("height");
	    	}
	    })
	}
	height();

	// 下拉刷新
	window.onscroll=function(){
	    var skip =$("#system_skip").val();

	    var docheight = $(document).height();               //整个网页的文档高度
	    var screenheight = $(window).height();             //浏览器可视窗口的高度
	    var scroll = $(window).scrollTop();               //浏览器可视窗口顶端距离网页顶端的高度（垂直偏移）
	    
	    if(screenheight+scroll >= docheight){
	        $.ajax({
	            url: '/i/msgsystemAjax',
	            type: 'POST',
	            dataType: 'json',
	            data : {
	                "skip": skip,
	            },
	            success:function(res){
	                var data = res.data.data;
	                var str = '';
	                if(res.success){
	                    $("#system_skip").val(res.data.skip);
	                    for(var i=0;i<data.length;i++){
	                        str= '<li>'
					       	    +	'<p class="system_date">'+data[i].createtime+'</p>'
					       	    +	'<div class="system_txt">'
					       	    +		'<p class="title">'+data[i].content.title+'</p>'
					       	    +        '<div class="system_change system_intro">'
					       	    +		     '<p>'+data[i].content.details+'</p>'
					       	    +        '</div>'
					       	    +		'<div class="system_more">'
						       	+    		'<p>查看全部</p>'
						       	+    		'<img src="/public/img/i/mine_xiayiye@3x.png">'
					       	    +		'</div>'
					       	    +	'</div>'
					       	    +'</li>'
	                        $('#system').append(str);
	                    }
	                   height(); 
	                }else{
	                    $("#hidden").show();
	                    return;
	                }
	            }
	        });

	    }
	}



})