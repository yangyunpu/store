 /**
 * 
 * @return 
 * @param 
 * @author zhichao_hu@soolife.com.cn
 * @date 
 */

//点赞发评论
(function(){
	//星粉秀详情-->点赞
	$("#like").click(function(){
		var token        = $(".nav").attr("token");
		var fanshow_id   = $(".nav").attr("fanshow-id");
		var praise_count = $(".nav").attr("praise_count");
		var url_member   = $(".nav").attr("url_member");
		var count        = $(".count").text();
		if(token == 0){
		 	 $.base64.utf8encode = true;
		 	 var url =encodeURIComponent($.base64.btoa(window.location.href));
		 	 window.location.href=url_member+"/login.html?return_url="+url; 
		}else{
			thumbup(fanshow_id,"0",url_member,count);
		}
	});


	// 点赞和取消点赞及登录的方法////////////////////////////////////////////
	function thumbup($fanshow_id,$praise,url_member,count){
		$.ajax({
			url : "/praise.html",
			type : "post",
			data : {
				"fanshow_id" : $fanshow_id,
				"praise" : $praise,
			},
			dataType : "json",
			success : function(d) {
			if (d.success) {
					if(d.data.msg == '点赞成功'){
						$('.share_preson .like p').removeClass('no_img').addClass('yes_img');
						$(".count").text(++count);
					}else{
						$('.share_preson .like p').removeClass('yes_img').addClass('no_img');
						$(".count").text(--count);
					}

				} else {
					return false;		
				}
			}
		});	
	}


	$(".says_btn").click(function(){
		var token      = $(".nav").attr("token");
		var comment    = $(".says_text").val();
		var fanshow_id = $(".nav").attr("fanshow-id");
		var url_member = $(".nav").attr("url_member");
		if(token == 0){
			 	 $.base64.utf8encode = true;
			 	 var url =encodeURIComponent($.base64.btoa(window.location.href));
			 	 window.location.href=url_member+"/login.html?return_url="+url; 
		}else{
			if(comment == ""){
			alert("说点什么吧!");
			return  false;
		}
		$.ajax({
				url : "/comment.html",
				data : {
					"fanshow_id" : fanshow_id,
					"comment" : comment,
				},
				type : "post" ,
				dataType : "json",
				success: function(d){
					window.location.reload();
				}	
			});
		}
				
	});

	//右边返回按钮
	$(".back_r").on("click",function(){
		 $.base64.utf8encode = true;
	 	 window.location.href="/life.html"; 

	});


})();