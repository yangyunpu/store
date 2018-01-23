$(function() {
	// 下拉刷新
	window.onscroll=function(){
	    var skip =$("#hidden").val();
	    var docheight = $(document).height();               //整个网页的文档高度
	    var screenheight = $(window).height();             //浏览器可视窗口的高度
	    var scroll = $(window).scrollTop();               //浏览器可视窗口顶端距离网页顶端的高度（垂直偏移）
	    if(screenheight+scroll >= docheight){
	        $.ajax({
	            url: '/lifehui/showMore.html',
	            type: 'POST',
	            dataType: 'json',
	            data : {
	                "skip": skip,
	            },
	            success:function(res){
	            	// console.log(res)
	                var data = res.data.data;
	                var str = '';
	                if(data != ""){
	                	$("#hidden").val(res.data.skip);
	                	for(var i=0;i<data.length;i++){
                            str += '<li>'
							str+=		'<a href="/lifehui/showdetail.html?fanshow_id='+data[i].fanshow_id+'">'
							str+=			'<div id="nick">'
							str+=				'<img src="'+data[i].photo+'">'
							str+=				'<span>'+data[i].nickname+'666666</span>'
							str+=			'</div>'
						 	str+=			'<div id="imglist">'
											for(var j=0; j<data[i].photos.length; j++){

							str+=				'<img src="'+data[i].photos[j].pic+'">'
											}
							str+=			'</div>'
							str+=			'<p id="txt">'+data[i].memo+'</p>'
							str+=			'<p id="date">'+data[i].time+'</p>'
							str+=			'<div id="good">'
							str+=				'<div class="like">'
							str+=					'<img class="praise" src="/public/img/lifehui/good.png">'
							str+=					'<span>'+data[i].praise+'</span>'
							str+=				'</div>'
							str+=				'<div class="edit">'
							str+=					'<img src="/public/img/lifehui/Group 9.png">'
							str+=					'<img class="hide" src="/public/img/lifehui/pinglun_xz.png">'
							str+=					'<span>'+data[i].comment+'</span>'
							str+=				'</div>'
							str+=			'</div>'
							str+=		'</a>'
							str+=	'</li>'
	                	}

	                	$('#comment').append(str);
	                }
	            }
	        });

	    }
	}
})