$(function(){
	// 点击获取验证码 
	$('#btn').click(function(){ 
		var mobile = $("#mobile").val()
		var code =  $("#code").val();

		if(!(/^(1[0-9][0-9]|14[5|7]|15[0|1|2|3|5|6|7|8|9]|18[0|1|2|3|5|6|7|8|9])\d{8}$/.test(mobile))){
			alert_mark('手机号码输入不正确',3000);
			return;
		}else{
			settime(60);
		}
		 messagesAjax(mobile);
	});

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
    // 点击切换输入样式
    $(".iphones").on("click",function(){
    	$(this).hide();
    	$(this).siblings(".iphones2").show().focus();
    	$(this).siblings(".iphones2").find("input").focus();
    })

    $(".text").click(function(){
    	var bank_name     = $("#bank_name").val();
    	var bank_account  = $("#bank_account").val();
    	var bank_no       = $("#bank_no").val();
    	var vcode         = $("#code").val();
    	var mobile        = $("#mobile").val();


		$.ajax({
		    url: '/setting/cashAjax.html',
		    type: 'post',
		    async: false,
		    dataType: 'json',
		    data: {
		    	'bank_name':bank_name,
		    	'bank_account':bank_account,
		    	'bank_no':bank_no,
		    	'vcode' : vcode,
		    	'mobile' : mobile
		    },
		    success:function(res){
		        if(res.success == true){
	                $("#title").show();
	                $("#title").html(res.data.msg);
	                setTimeout(function(){
	                	$("#title").hide();
	                },2000)
		        }
		    }
		})

	});





//发送短信	
function messagesAjax(mobile){
	var mobile  = $("#mobile").val();
	$.ajax({
		url: '/setting/vcodeAjax.html',
		type: 'POST',
		dataType: 'json',
		data: {
			"mobile": mobile
		},
		success:function(res){
			if(res.code == 200){
				$("#title").show();
				$("#title").html(res.data.msg);
				setTimeout(function(){
					$("#title").hide();
				}, 3000)
			}
		}
	});
};

})