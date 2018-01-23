$(function(){
	// 点击获取验证码 
	$('#btn').click(function(){ 
		var mobile = $(".numberf").val()
		console.log(mobile);
		var code =  $("#code").val();
		// console.log(phone);
		// console.log(code);
		if(!(/^(1[0-9][0-9]|14[5|7]|15[0|1|2|3|5|6|7|8|9]|18[0|1|2|3|5|6|7|8|9])\d{8}$/.test(mobile))){
			alert_mark('手机号码输入不正确',3000);
			return;
		}else{
			settime(60);
			alert_mark('验证码正在发送...',3000);
		}
		messagesAjax(mobile);
		 
	});

	//手机号中间4位变星星
	var tel = $('.number').html();  
    var mtel = tel.substring(0, 3) + '****' + tel.substring(7); 
    $('.number').text(mtel);  
 	//获取验证码input 变化
    $('#code').bind('input propertychange', function() {  
    	$(".text").css("background","#EC6D65"); 
	});  
	//点击提交修改密码
    $(".text").click(function(){
    	var mobile = $(".numberf").val();
	    var number1 = $("#number1").val();
	    var number2 = $("#number2").val();
	    var vcode =$("#code").val();
    	if(number1 != number2){
    		$(".der").show();
    		return;
    	}
    	console.log(mobile+'shouji'+number1);
      enrollAjax(mobile,vcode);
      revampAjax(mobile,number2);
    }) 
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
					console.log(res);
					if(res.code == 200){
						alert_mark("短信发送成功!",3000);
					}
					//  var key = res.data.key;
					//  if(key !=''){
					//  	$(".security").show();
					//  	entryAjax(key);
					//  	//点击图片验证码切换
					// 	 $(".img_code2").click(function(){
					// 		entryAjax(key);
					// 	 });
					//  }
					// return;
				}
			});
		};
 //d短信验证
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
				console.log(res);
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
							// $(".jianxi").hide();
							// $(".jianxi2").show();
							break;
					 }
				 } else{
				 	alert_mark("请输入账号或密码!",3000);
				 }
				
			}
		});
	};
//修改密码 
	function revampAjax(mobile,password){
		$.ajax({
			url: '/setting/revamp',
			type: 'POST',
			dataType: 'json',
			data: {
				"mobile": mobile, 
				"password" : password
			},
			success:function(res){
				console.log(res);
				// return;
				if(res.code == 200){
					alert_mark('密码修改成功',3000);
					window.location.href ='/setting/safeset.html';					
					 // switch(res.data.code){
					 // 	case 104:
						//  	alert_mark('密码修改成功',3000);
						//  	window.location.href ='http://m.soolife.cn';
						//  	break;
					 // 	case 106:
						//  	alert_mark('重新输入密码',3000);
						//  	break;
					 // }
				 } 
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
    
});