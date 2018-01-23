function settime(time){ 
	if (time == 0) {
		$('#testboxh').hide();    
		$('#testboxs').show();
        time = time; 
        return;
    }else{  
		$('#testboxh').show();    
		$('#testboxs').hide();
        $("#testboxh").html(time + "s"); 
        time--; 
    }; 
	setTimeout(function(){ 
    	settime(time);
	},1000);
};
$('#testboxs').click(function(){
	var phone = $("[name|='phone']").val();
	if(!(/^(1[0-9][0-9]|14[5|7]|15[0|1|2|3|5|6|7|8|9]|18[0|1|2|3|5|6|7|8|9])\d{8}$/.test(phone))){
		alert_mark('手机号码输入不正确',3000);
		return;
	};  
	getSms(phone);
});
$('#sure').click(function(){
	var phone = $("[name|='phone']").val();
	var vcode = $("[name|='vcode']").val();
	var password = $("[name|='password']").val();
	var unique = $("[name|='unique']").val();
	var source = $("[name|='source']").val();
	var referrer = $("[name|='referrer']").val();
	if(!(/^((13[0-9])|(147)|(15[0-9])|(17[0-9])|(18[0-9]))[0-9]{8}$/.test(phone))){
		alert_mark('手机号码输入不正确',3000);
		return;
	};
	if(!(/^\d{6}$/.test(vcode))){
		alert_mark('验证码格式输入不正确',3000);
		return;
	};
	if(!(/^\w{6,15}$/.test(password))){
		alert_mark('密码格式输入不正确',3000);
		return;
	}; 
	registerAjax(phone,vcode,password,unique,source,referrer);
});
//获取消息
function getSms(phone){
	$.ajax({
		url: '/Regift/registerSms',
		type: 'GET',
		dataType: 'json',
		data: {
			"phone": phone
		},
		success:function(res){ 
			// console.log(res);
			if(res.data.success){
				alert_mark(res.data.msg,3000);
				$('#btn').hide();
				$('#s_box').show();
				settime(60);				
			}else{
				alert_mark(res.data.msg,3000);
			};
		},
		error:function(res){
			alert_mark('请求失败！',3000);
		}
	});
};
//注册 
function registerAjax(phone,rvcode,password,unique,source,referrer){
	$.ajax({
		url: '/Regift/registerAjax',
		type: 'POST',
		dataType: 'json',
		data: {
			"mobile": phone,
			"password" : password,
			"vcode" : rvcode,
			"source" : source,
			"referrer" : referrer,
			"unique" : unique
		},
		success:function(res){
                    console.log(res.data);
			if(res.data.code==104){                            
				$('#xing').html(res.data.login_info.coin);
				$('#xian').html(res.data.login_info.cash);
				$('#qian').html(res.data.login_info.m_money);
				$('#you').html(res.data.login_info.coupon);
                                if(res.data.login_info.coin==0 && res.data.login_info.cash==0 && res.data.login_info.m_money==0 && res.data.login_info.coupon==0){
                                    window.location.href = "/i/index/index.html?memberid="+res.data.login_info.member_id;
                                }else{                                  
                                   $('#mark').show();  
                                }
                                
//				$("#mark").click(function  () {
//					$('#mark').hide();
//					window.location.href = "/i/index/index.html?memberid="+res.data.login_info.member_id;
//				})
			}else{
				alert_mark(res.data.entry.msg,3000);
			};
		}
	});
};
$('#download-nav-hide').click(function(){
    $('#download-nav').hide();
})
//提示框 实例
function alert_mark(str,time){
  $('#alert_mark').html(str);
  $('#alert_mark').show();
  setTimeout(function(){$('#alert_mark').hide();},time);
};