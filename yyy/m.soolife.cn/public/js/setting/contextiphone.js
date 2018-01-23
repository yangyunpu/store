// 点击获取验证码 
	$('#btn').click(function(){ 
		var mobile = $(".iphone1").val();
		var code =  $(".code_one").val();
		console.log(mobile);
		console.log(code);
		if(!(/^(1[0-9][0-9]|14[5|7]|15[0|1|2|3|5|6|7|8|9]|18[0|1|2|3|5|6|7|8|9])\d{8}$/.test(mobile))){
			alert_mark('手机号码输入不正确',3000);
			return;
		}else{
			settime(60);
			alert_mark('验证码正在发送...',3000);
		}
		messagesAjax(mobile,"1");
		 
	});
	//点击下一步
	$("#next").click(function(){
		var mobile = $(".iphone1").val();
		var vcode = $('.code_one').val();
		if((mobile=='' || mobile==undefined || mobile==null) || (vcode=='' || vcode==undefined || vcode==null)){
			alert_mark("请输入手机号和验证码!",3000);
			return;
		}
		enrollAjax(mobile,vcode);
	})

	//发送短信	
	//step 1 第一个页面发送短信
	//step 2 第二个页面获取验证码
	//step 3 绑定按钮
						/*$(".bound").hide();
					$(".bound2").show();
*/		function messagesAjax(mobile,step,vcode=""){
			$.ajax({
				url: '/setting/bindiphone',
				type: 'POST',
				dataType: 'json',
				data: {
					"mobile": mobile,
					"step"  : step,
					"vcode" : vcode
				},
				success:function(res){
					console.log(res);
					if(!res.data.success){
						switch (res.data.id)
						{
							case 101:
							  alert_mark("用户未绑定手机,请直接前往绑定手机!",3000);
							  break;
						  	case 102:
							  alert_mark("您已绑定过手机,请先验证原手机号码!",3000);
							  break;
							case 103:
							  alert_mark("请稍后再尝试获取短信!",3000);
							  break;
							case 104:
							  alert_mark("原手机验证失败,请先验证原手机号码!",3000);
							  break;
							case 105:
							  alert_mark("手机号码格式不正确!",3000);
							  break;
							case 106:
							  alert_mark("该手机已绑定过其他帐号,请更换绑定手机!",3000);
							  break;
						}
					}else{
						 alert_mark(res.data.msg,3000); 
						window.location.herf="/setting/safeset.html";
					}
					// if(res.code == 200){
					// 	alert_mark("短信发送成功!",3000);
					// }
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
			url: '/setting/verify',
			type: 'POST',
			dataType: 'json',
			data: {
				"mobile": mobile, 
				"vcode" : vcode
			},
			success:function(res){
				if(res.success){
					alert_mark('验证通过!',3000); 
					$(".bound").hide();
					$(".bound2").show();
				 } else{
				 	alert_mark("验证码错误!",3000);
				 }
				
			}
		});
	};


// 绑定新手机号码
	$('.btn').click(function(){
		// alert(11);
		
		var mobiles = $(".number2").val();
		var codes =  $(".code").val();
		console.log(mobiles);
		// console.log(code);
		if(!(/^(1[0-9][0-9]|14[5|7]|15[0|1|2|3|5|6|7|8|9]|18[0|1|2|3|5|6|7|8|9])\d{8}$/.test(mobiles))){
			alert_mark('手机号码输入不正确',3000);
			return;
		}else{
			settimes(60);
			alert_mark('验证码正在发送...',3000);
		}
		messagesAjax(mobiles,"2");
		 
	});
	//绑定按钮点击
	$('#text2').click(function(){
		var mobile = $(".number2").val();
		var vcode = $(".code_two").val();
		console.log(vcode);
		//enrolltwoAjax(mobile,vcode);
		messagesAjax(mobile,"3",vcode);
	})


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
//绑定新手机号倒计时
function settimes(time) { 
	if (time == 0) {
		$('.btn').show();
		$('.s_box').hide();    
        time = time; 
        return;
    }else{
    	$('.btn').hide();
		$('.s_box').show(); 
        $('.s_box').html(time + "s"); 
        time--; 
    }; 
	setTimeout(function(){ 
    	settimes(time);
	},1000);
};


		//d短信验证
	/*function enrolltwoAjax(mobile,vcode){
		$.ajax({
			url: '/setting/bindiphone',
			type: 'POST',
			dataType: 'json',
			data: {
				"mobile": mobile, 
				"vcode" : vcode
			},
			success:function(res){
				console.log(res);
				// return;
				if(res.code == 200){
					alert_mark('验证通过!',3000); 
					window.location.href="/setting/safeset.html";
					 // switch(res.data.code){
					 // // 	case 100:
						// //  	alert_mark('手机号码格式不正确',3000);
						// //  	break; 
						// // case 101:
						// // 	alert_mark('短信验证码错误!',3000);
						// // 	break;
						// case 106:
						// 	// alert_mark('验证通过!',3000); 
						// 	// window.location.herf="/setting/safeset.html";
						// 	// alert(11); 
						// 	break;
					 // }
				 } else{
				 	alert_mark("请输入账号或密码!",3000);
				 }
				
			}
		});
	};*/