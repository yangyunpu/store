$(function(){
	var url_m = $(".lcy_getmore").data("url-m");
	var is_login = $('.lcy_getmore').data('is-login');
	var url = window.location.href;
	var a_position = (window.location.href).indexOf('a');
	var url_str = url.substring(a_position+2,a_position+3);
	var is_get = $('.lcy_getmore').data('isget')||0;
	if(url_str == '5'&& is_get==0&&is_login){
		getCoinF();
	}
	//点击领星币遮罩消失
	$('.lcy_getmore .mark #delete_getcoin').click(function(){
		$(".lcy_getmore .mark").hide();
		window.location.reload();
	});
	//点击领星币
	$(".go_complete0").on("click",function(){
		var is_login = $('.lcy_getmore').data('is-login');
		var is_get = $(this).data('status');
		if(is_get){
			return;
		}else if(!is_login){
			go_login(5);
		}else{
			getCoinF();		
		};
	});
	//领星币的ajax
	function getCoinF(){
		$.ajax({
			url      : "/huilife/getcoin.html",
            type     : "post",
            dataType : "json",
            ContentType:"application/x-www-form-urlencoded",
            success : function(data){
            	$(".lcy_getmore .mark").show();
            }
		});	
	}
	//点击星粉秀
	$(".go_complete1").on("click",function(){
		var href = url_m+'/i/show/show.html';
		var is_get = $(this).data('status');
		if(is_get) return;
		judge(href);
	});
	//订单评价领星币
	$(".go_complete2").on("click",function(){
		var href = url_m+'/orders/index.html?status=4';
		var is_get = $(this).data('status');
		if(is_get) return;
		judge(href);
	});
	//完善资料
	$(".go_complete3").on("click",function(){
		var href = url_m+'/setting/message.html';
		var is_get = $(this).data('status');
		if(is_get) return;
		judge(href);
	});







    //判断是否登录后的动作；
    function judge(_href){
    	var is_login = $('.lcy_getmore').data('is-login');
		if(!is_login){
			go_login();
		} else{
			window.location.href=_href;//"http://m2.soolife.loc/huilife/index.html"; 			
		};
    };

	//前去登录，并返回该页面
	function go_login(a){
		var a = a ||'';
		$.base64.utf8encode  = true;
		var url              = $.base64.btoa(window.location.href+'&a='+a);
		window.location.href = url_m+"/logins/login.html?return_url="+url;
    };
	
});//end