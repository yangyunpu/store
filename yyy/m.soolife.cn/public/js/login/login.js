//登录验证
$(".sure").click(function(){
	var phone = $(".iphone").find("input").val();
	var password = $("#password").find('input').val();
	var xcode = $("#xcode").val();
	var xcode_key = $("#xcode_key").val();
	var url = $("#url").val();
/*	console.log(phone);
	console.log(password);
	console.log(xcode);
	console.log(xcode_key);*/
	if(!(/^((13[0-9])|(147)|(15[0-9])|(17[0-9])|(18[0-9]))[0-9]{8}$/.test(phone))){
		alert_mark('手机号码输入不正确',3000);
		return;
	}
	loginAjax(phone,password,xcode,xcode_key,url);
});
   //登录提交
	function loginAjax(phone,password,xcode,xcode_key,url){
		$.ajax({
			url: '/logins/login',
			type: 'POST',
			dataType: 'json',
			data: {
				"mobile": phone,
				"password" :password,
				"xcode" :xcode,
				"xcode_key":xcode_key,
				"url":url
			},
			success:function(res){
				// console.log(res);
				/*return;*/
				if(res.data != 400){
					 switch(res.data.code){
					 	case 100:
						 	alert_mark(res.data.entry.msg,3000);
						 	break;
					 	case 101:
						 	 alert_mark("登录错误次数超过三次",3000);
						 	 var key = res.data.entry.key;
						 	 $("#xcode_key").val(key);
						 	 entryAjax(key);
						 	 $(".security").show();
						 	 //点击图片验证码切换
							 $(".img_code2").click(function(){
								entryAjax(key);
							 })
						 	 break;
						case 103:
							var key = res.data.entry.key;
							entryAjax(key);
							alert_mark("图片验证码错误!",3000);
							break; 
						case 104:
							 window.location.href = res.data.return_url;	 
							 break;
					 }
				 } else{
				 	alert_mark("请输入账号或密码!",3000);
				 }
				// if(res.data.token){
				// 	alert_mark("登录成功",3000); 
				// 	window.location.href = return_url;
				// }else{
				// 	alert_mark(res.data.msg,3000);	
				// 	alert("密码不正确");			
				// };
			}
		});
	};
//检查登录次数
	function err_numAjax(){
		$.ajax({
			url: '/logins/err_num',
			type: 'POST',
			dataType: 'json',
			data: '',
			success:function(res){
				 var key = res.data.key;
				 if(key !=''){
				 	$(".security").show();
				 	entryAjax(key);
				 	//点击图片验证码切换
					 $(".img_code2").click(function(){
						entryAjax(key);
					 });
					 $("#xcode_key").val(key);
				 }
				return;
			}
		});
	};
err_numAjax();

// 请求图片ajax
	function entryAjax(xcode_key){
		$.ajax({
			url: '/logins/entry',
			type: 'POST',
			dataType: 'json',
			data: { 
				"xcode_key":xcode_key
			},
			success:function(res){
				console.log(res.data);
				var img = '<img  src="data:image/png;base64,'+ res.data.img+' ">';
				$(".img_code2").html(img);
				return;

			}
		});
	};


	//cookie操作
function setCookie(cname,cvalue,path,exdays){
	var d = new Date();
	d.setTime(d.getTime()+(exdays*24*60*60*1000));
	var expires = "expires="+d.toGMTString();
	document.cookie = encodeURIComponent(cname)+"="+encodeURIComponent(cvalue)+"; expires="+expires+"; path="+path;
};

// 弹出框
function alert_mark(str,time){
  $('#exceed').html(str);
  $('#exceed').show();
  setTimeout(function(){$('#exceed').hide();},time);
};//alert_mark('库存不足');