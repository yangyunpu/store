$(function  () {
	// 下拉刷新
	window.onscroll=function(){
	    var skip =$("#service_skip").val();

	    var docheight = $(document).height();               //整个网页的文档高度
	    var screenheight = $(window).height();             //浏览器可视窗口的高度
	    var scroll = $(window).scrollTop();               //浏览器可视窗口顶端距离网页顶端的高度（垂直偏移）
	    
	    if(screenheight+scroll >= docheight){
	        $.ajax({
	            url: '/i/msgserviceAjax',
	            type: 'POST',
	            dataType: 'json',
	            data : {
	                "skip": skip,
	            },
	            success:function(res){
	                var data = res.data.data;
	                var str = '';
	                if(res.success){
	                    $("#service_skip").val(res.data.skip);
	                    for(var i=0;i<data.length;i++){
	                        str= '<li>'
					        	+	'<a href="/orders/particularsth/'+data[i].content.apply_no+'.html">'
						        +		'<p class="order_date">'+data[i].createtime+' </p>'
						        +		'<div class="order_con">'
						        +		    '<p class="service_title">'+data[i].content.status+'</p>'
						        +		    '<div class="order_txt">'
							    +    			'<img src="'+data[i].content.logo+'">'
							    +    			'<div class="order_msg">'
							    +    				'<p class="order_intro">'+data[i].content.name+'</p>'
							    +    				'<p class="order_num">申请单编号:  '+data[i].content.apply_no+'</p>'
							    +    			'</div>'
						        +		    '</div>'
						        +		'</div>'
					        	+	'</a>'
					        	+'</li>'
	                        $('#msgorder').append(str);
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