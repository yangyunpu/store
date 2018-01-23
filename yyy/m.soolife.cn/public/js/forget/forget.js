$('#btn').click(function(){
	var mobile = $("#iphone").find("input").val();
	if(!(/^(1[0-9][0-9]|14[5|7]|15[0|1|2|3|5|6|7|8|9]|18[0|1|2|3|5|6|7|8|9])\d{8}$/.test(mobile))){
			alert_mark('手机号码输入不正确',3000);
			return;
	}else{
		// settime(60);
		// alert_mark('验证码正在发送...',3000);
		messagesAjax(mobile); 
	}		
});


//发送短信	
		function messagesAjax(mobile){
			$.ajax({
				url: '/forgets/messages',
				type: 'POST',
				dataType: 'json',
				data: {
					"mobile": mobile
				},
				success:function(res){
					// console.log(res);
					var _alert_msg = res.data.msg;
					// console.log(_alert_msg)
					if(res.code == 200){
						alert_mark(_alert_msg,3000);
						if(_alert_msg.indexOf("未注册") == -1){
							settime(60);
							alert_mark('验证码正在发送...',3000);
						}
					} 
				}
			});
		};
//忘记密码确定按钮
$(".sure1").click(function(){
	var vcode = $("#code").val();
	var mobile = $("#iphone").find("input").val();
	if( mobile == ''){
		alert_mark('请输入手机号',3000);
		return false;
	} 
	if(vcode == ''){
		alert_mark('请输入验证码',3000);
		return false;
	} 
	enrollAjax(mobile,vcode); 
})
//修改新密码
$(".sure2").click(function(){
	var password1 = $('#password1').val();
	var password2 = $('#password2').val();
	var mobile = $("#iphone").find("input").val();
	if(password1 == ''){
		alert_mark('请输入新密码...',3000);
		return;
	}
	if(password2 == ''){
		alert_mark('请再次输入新密码...',3000);
		return;
	}
	if(password1 !== password2){
		alert_mark('两次密码不一致...',3000);
		return;
	}
	if(!(/^[0-9a-zA-Z]{6,20}$/.test(password1))){
			alert_mark('密码不少于6个字符',3000);
			return;
		}
	revampAjax(mobile,password1);
});
//忘记修改密码 
	function revampAjax(mobile,password){
		$.ajax({
			url: '/forgets/revamp',
			type: 'POST',
			dataType: 'json',
			data: {
				"mobile": mobile, 
				"password" : password
			},
			success:function(res){
				// console.log(res);
				// return;
				if(res.data != 400){
					 switch(res.data.code){
					 	case 104:
						 	alert_mark('密码修改成功',3000);
						 	window.location.href ='/i/index/index.html';
						 	break;
					 	case 106:
						 	alert_mark(res.data.entry.msg,3000);
						 	break;
					 }
				 } 
			}
		});
	};

 //忘记密码验证
	function enrollAjax(mobile,vcode){
		$.ajax({
			url: '/forgets/verify',
			type: 'POST',
			dataType: 'json',
			data: {
				"mobile": mobile, 
				"vcode" : vcode
			},
			success:function(res){
				// console.log(res);
				// return;
				if(res.data != 400){
					 switch(res.data.code){
					 	case 100:
						 	alert_mark('手机号码格式不正确',3000);
						 	break; 
						case 101:
							alert_mark('短信验证码错误!',3000);
							break;
						case 106:
							alert_mark('验证通过!',3000);
							$(".jianxi").hide();
							$(".jianxi2").show();
							break;
					 }
				 } else{
				 	alert_mark("请输入账号或密码!",3000);
				 }
				
			}
		});
	};

// 短信倒计时
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

// 弹出框
function alert_mark(str,time){
  $('#alert_mark').html(str);
  $('#alert_mark').show();
  setTimeout(function(){$('#alert_mark').hide();},time);
};//alert_mark('库存不足');