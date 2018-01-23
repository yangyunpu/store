
var isApp = /SoolifeApp/i.test(navigator.userAgent);
if(isApp){
	 $(".header").hide();
}else{
	$(".header").show();
}

var xcode_key =$("#xcode_key").val();
	// 点击获取验证码
	$('#btn').click(function(){
		var mobile = $(".iphone").find('input').val()
		var code =  $("#code").val();
		if(!(/^(1[0-9][0-9]|14[5|7]|15[0|1|2|3|5|6|7|8|9]|18[0|1|2|3|5|6|7|8|9])\d{8}$/.test(mobile))){
			alert_mark('手机号码输入不正确',3000);
			return;
		}else{
			// settime(60);
			// alert_mark('验证码正在发送...',3000);
		}
		messagesAjax(mobile);

	});
	 //点击注册
	$(".ensure").click(function(){
	 	var mobile = $(".iphone").find('input').val()
		var vcode =  $("#code").val();
	 	var xcode = $("#xcode").val();
	 	var xcode_key =$("#xcode_key").val();
		var password1 = $(".pass1").find('input').val();
		var password2 = $(".pass2").find('input').val();
		var return_url = $("#return_url").val();

		if(!(/^(?!\D+$)(?![^0-9a-zA-Z]+$)\S{6,20}$/.test(password1))){
		// if(!(/^(?=.{6,16}$)(?![0-9]+$)(?!.*(.).*\1)[0-9a-zA-Z]+$/.test(password1))){
			alert_mark('密码格式不正确',3000);
			return false;
		}
		if(password1 != password2){
			alert_mark('两次密码不一致...',3000); 
			setTimeout(function(){
				$(".pass2").find('input').val("");
			},1000)
			return false;
		}
		enrollAjax(mobile,password1,vcode,xcode,xcode_key,return_url);


	 })
	//发送短信
		function messagesAjax(mobile){
			$.ajax({
				url: '/enroll/messages',
				type: 'POST',
				dataType: 'json',
				data: {
					"mobile": mobile
				},
				success:function(res){
					if(res.data.success == true ){
						alert_mark(res.data.msg,3000);
						settime(60);
					}else if(res.data.success == false){
						alert_mark(res.data.msg,3000);
					}
				}
			});
		};
// 注册ajax
 //注册提交
	function enrollAjax(mobile,password,vcode,xcode,xcode_key,return_url){
		$.ajax({
			url: '/enroll/enroll',
			type: 'POST',
			dataType: 'json',
			data: {
				"mobile": mobile,
				"password" :password,
				"vcode" :vcode,
				"xcode" :xcode,
				"xcode_key":xcode_key
			},
			success:function(res){
				// console.log(res);
				// return;
				if(res.data != 400){
					 switch(res.data.code){
					 	case 100:
						 	alert_mark('手机号码格式不正确',3000);
						 	break;
						case 103:
							 alert_mark("短信验证码不正确",3000);
							 break;
						case 101 :
							alert_mark("输入信息不全",3000);
							break;
						case 102:
							alert_mark("手机号码已注册",3000);
							break;
						case 106:
							alert_mark("短信验证码错误次数过多，请输入图片验证码",3000);
							$(".security").show();
							var xcode_key = res.data.entry.key;
							$("#xcode_key").val(xcode_key);
							entryAjax(xcode_key);
							$(".img_code2").click(function(){
								entryAjax(xcode_key);
							 })
							break;
						case 107:
							var xcode_key = res.data.entry.key;
							entryAjax(xcode_key);
							alert_mark("图片验证码不正确",3000);
							break;
						case 105:
							alert_mark("请输入正确信息",3000);
							break;
						case 104:
							alert_mark("注册成功",3000);
							if(return_url == ''){
								window.location.href ='/i/index/index.html?msg=success';
							} else {
								return_url = $.base64.decode(return_url);
								window.location.href = return_url+"?msg=success";
							}
							break;
					 }
				 } else{
				 	alert_mark("请输入账号或密码!",3000);
				 }

			}
		});
	};
	//注册成功送礼
	var cash = '';
	var coin = '';
	var couponno = '';
	var money = '';
	var _url = '';
	function seedAjax(){
	 	$.ajax({
				url: '/enroll/ljseed',
				type: 'get',
				dataType: 'json',
				data: '',
				success:function(res){
					 console.log(res);
					 cash = res.cash;
					 coin = res.coin;
					 couponno = res.couponNo;
					 money = res.money;
					 _url = '/i/index/index.html?cash='+cash+'&coin='+coin+'&couponno='+couponno;
					return;
				}
			});
	}
	//检查注册次数
	function err_numsAjax(){
			$.ajax({
				url: '/enroll/err_nums',
				type: 'POST',
				dataType: 'json',
				data: '',
				success:function(res){
					// console.log(res.data.key);
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
	err_numsAjax();

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

	// 弹出框
	function alert_mark(str,time){
	  $('#alert_mark').html(str);
	  $('#alert_mark').show();
	  setTimeout(function(){$('#alert_mark').hide();},time);
	};//alert_mark('库存不足');

	//验证码倒计时
	function settime(time) {
		if (time == 0) {
			$('#btn').show();
			$('#s_box').hide();
	        time = time;
	        return;
	    }else{
	    	$('#btn').hide();
			$('#s_box').show();
	        $('#s_box').html(time + "s");
	        time--;
	    };
		setTimeout(function(){
	    	settime(time);
		},1000);
	};