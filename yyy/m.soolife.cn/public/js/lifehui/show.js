$(function() {
	$(".praise").click(function(){
		var _src = $(this).attr("src");
		var _this = $(this);
		var fanshow_id = $(this).attr('fanshow_id');
			$.ajax({
	        url : "/lifehui/praise.html",
	        type : "post",
	        dataType :"json",
	        data : {
	        	"fanshow_id" : fanshow_id,
	        },
	        success : function(data){
	        	console.log(data)
	        	if(data.success){	
	        		console.log(data.success)
	        		if(data.data.msg == "当前用户已退出登录,请重新登录"){
	        			go_login();
	        		}else{
	        			console.log(1111)
	        			console.log(_src)
	        			_this.attr("src","/public/img/lifehui/dianzan_xz.png")
	        		}
	        	}else{
	        		console.log(2222)
	        		go_login();
	        	}
	        }

        })
		
	})


    /**
    *
    * @return
    * @param  登录并且调回当前页面
    * @author zhichao_hu@soolife.com.cn
    * @date
    */
	function go_login(){
		var url_member       = $("#wrap").attr("url_member");
		$.base64.utf8encode  = true;
		var url              = $.base64.btoa(window.location.href);
		window.location.href = url_member+"/login.html?return_url="+url;
    }
})