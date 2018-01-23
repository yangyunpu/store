$(function  () {
	// 下拉刷新
	window.onscroll=function(){
	    var skip =$("#asset_skip").val();

	    var docheight = $(document).height();               //整个网页的文档高度
	    var screenheight = $(window).height();             //浏览器可视窗口的高度
	    var scroll = $(window).scrollTop();               //浏览器可视窗口顶端距离网页顶端的高度（垂直偏移）
	    
	    if(screenheight+scroll >= docheight){
	        $.ajax({
	            url: '/i/msgassetAjax',
	            type: 'POST',
	            dataType: 'json',
	            data : {
	                "skip": skip,
	            },
	            success:function(res){
	            	
	                var data = res.data.data;
	                var str = '';
	                if(res.success){
	                    $("#asset_skip").val(res.data.skip);
	                    for(var i=0;i<data.length;i++){
	                        str= '<li>'
					        	+	'<p class="asset_date">'+data[i].createtime+'</p>'
					        	+	'<div class="asset_con">'
					        	+		'<p class="asset_title">'+data[i].content.title+'</p>'
					        	+		'<div class="asset_txt">'
					            +            '<p class="asset_noimg">'+data[i].content.details+'</p>'
					        	+		'</div>'
					        	+		'<div class="asset_more">'
						        +			'<a href="'+data[i].url+'">'
						        +				'<p>查看详情'+i+'</p>'
						        +				'<img src="/public/img/i/mine_xiayiye@3x.png">'
						        +			'</a>'
					        	+		'</div>'
					        	+	'</div>'
					        	+'</li>'
	                        $('#msgasset').append(str);
	                    }
	                }else{
	                    $("#hidden").show();
	                    return;
	                }
	            }
	        });

	    }
	}
})