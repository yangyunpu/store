(function(){
	var _ipt_text = $('.ipt_text');
	var _ipt_password = $('.ipt_password');
	var _m_ipt_phone = $('.m_ipt_phone');
	var _btn_normal = document.getElementById('btn_normal');
	var _btn_move = document.getElementById('btn_move');
	var type;
	$('.ipt_text').focus();
//////////////////////点击二维码登录来回切换页面///////////////////////////////////////////
	$('.btn_move').on('click',function(){
		var _src = $(this).find("img").attr("src");
     	var _src1 = "/public/img/login/iconfont-erweima-(2).png";
     	var _src2 = "/public/img/login/computer.png";
		var text = $(".btn_normal").html();
		if(text == '普通登录'&& _src == _src1 ){
			$(".btn_normal").html('扫码登录');
			$(this).find('img').attr("src",_src2);
			$('.normal_main').hide();
			$('.move_main').show();
			scanAjax();

		}else{
			$(".btn_normal").html('普通登录');
			$(this).find('img').attr("src",_src1)
			$('.normal_main').show();
			$('.move_main').hide();
		}
		// 动态登录中的密码登录
		$(".lj_password").click(function(){
			$(".btn_normal").html('普通登录');
			$(this).find('img').attr("src",_src1)
			$('.normal_main').show();
			$('.move_main').hide();
		})
		// 点击返回二维码登录
		$(".return2").click(function(){
				$(".lj_success").hide();
				$(".success2").hide();
				$(".lj_code").show();
				$(".iphone_socd").show();
				scanAjax();
		})
	});

	//获取二维码图片
	function scanAjax(){
			$.ajax({
			url: '/login/scanlogin',
			type: 'POST',
			dataType: 'json',
			success:function(res){
				$(".codes1").attr('src',res.img_src);
			    var code = res.qrcode;
			    $(".coder").val(code);
			    nowAjax(1);
			}
		});
	}
	// 实时获取二维码图片
	function nowAjax(type){
		var code = $("input[name=coder]").val();
		var _url = '/login/nowlogin';
		$.ajax({
			url: _url,
			type: 'POST',
			data:{"qrcode":code,"type":type},
			dataType: 'json',
			success:function(res){
				if(res.status !==400){
					switch(res.status){
						case 0:
							$("#lose_eff").show();
							// 点击二维码失效页面
							$("#lose_eff").click(function(){
							 	$(this).hide();
							 	scanAjax();
							 })
						break;
						case 1:
							nowAjax(1);
						break;
						case 2:
							var url = $(".go_url").val();
							window.location.href = "/sop/index.html";
						break;
						case 3:
							$(".lj_success").show();
							$(".success2").show();
							$(".lj_code").hide();
							$(".iphone_socd").hide();
							nowAjax(2);
						break;
						case 4:
							window.location.reload();
						break;
					}
				}
			}
		});
	}


//////////////////////点击二维码扫码登录////////////////////////////////////////////////////
	//点击 X 时的效果；
	$('.error_text_img').click(function(){
		_ipt_text.val('');
		$(this).hide();
		$('.ipt_text_img').attr('src','/public/img/login/entertext_0.png');
	})
	$('.error_password_img').click(function(){
		_ipt_password.val('');
		$(this).hide();
		$('.ipt_password_img').attr('src','/public/img/login/enterpasword_0.png');
	})
	$('.error_phone_img').click(function(){
		_m_ipt_phone.val('');
		$(this).hide();
	})

	//输入密码时，得到焦点和失去焦点的判断；
	$('.ipt_text').focus(function(){
		$('.ipt_text_img').attr('src','/public/img/login/entertext_3.png');
		$('.error_text_img').show();
	})
	$('.ipt_text').blur(function(){
		if(_ipt_text.val() == ""){
		 	$('.ipt_text_img').attr('src','/public/img/login/entertext_0.png');
		}
		setTimeout(function(){
			$('.error_text_img').css('display','none');
		},150);
	})
	//输入密码时，得到焦点和失去焦点的判断；
	$('.ipt_password').focus(function(){
		$('.ipt_password_img').attr('src','/public/img/login/enterpassword_3.png');
		$('.error_password_img').css('display','block');
		$('#error_msg_one').text('');
	})

	$('.ipt_password').blur(function(){
		if(_ipt_password.val() == ""){
		 	$('.ipt_password_img').attr('src','/public/img/login/enterpasword_0.png')
		}
		setTimeout(function(){
			$('.error_password_img').hide();
		},150);
	})
	//动态登录的文本框得到焦点和失去焦点
	$('.m_ipt_phone,.m_ipt_test').focus(function(){
		$('#error_msg').text('');
	});
	$('.m_ipt_phone').blur(function(){
		setTimeout(function(){
			$('.error_phone_img').hide();
		},150);
	});
	$('.error_phone_img').click(function(){
		$('.m_ipt_phone').val('');
	});

	//登录enter按键事件
	$(document).keypress(function(e){
		if(e.which == 13){
			if($('.normal_main').is(':visible')){
				$('.normal_submit').click();
			}else if($('.move_main').is(':visible')){
				$('.activity_submit').click();
			}
		}
	});

	//普通登录-------------------------------------------------------------------------------
	var status = false;
	var _ranom_key = Math.random()*10000000000000000+'';
	_ranom_key = _ranom_key.substring(0,15);;
	var err_num = $('.normal_form').attr('data-err');

	if(err_num > 3){
		status = true;
		$('.error_test_box').show().find('.error_test_word img').attr('src','/tools/validcode?'+Math.random()+'&key='+_ranom_key);
	}
	// 点击登录
	$('.normal_submit').click(function(){
		var username = $('.ipt_text').val();
		var password = $('.ipt_password').val();
		var remember = $("input[name='remember']").is(":checked") ? '1' : '0';
		if(status)
		{
			var vcode = $('.error_testword_text').val();
			if(check_name(username) && check_pass(password) && check_vcode(vcode))
			{
				normal_submit_login(username,password,remember,vcode,_ranom_key);
			}else{
				$('#error_msg_one').html('请输入正确的用户名、密码与验证码！');
			}
			return;
		}else{
			if(check_name(username) && check_pass(password)){
				normal_submit_login(username,password,remember);
			}else{
				$('#error_msg_one').html('请输入正确的用户名与密码！');
			}
			return;
		}
	});
	//刷新验证码
	/*$('.error_test_word,.changeone').click(function(){
		refresh_vcode($('.error_test_box .error_test_word img'));
	});
*/
	function check_name(name){
		// var name_pattern = /^[@\._a-zA-Z0-9\u4E00-\u9FA5]{2,16}$/;
		var name_pattern = /(.*){2,30}/;
		return name_pattern.test(name);
	}
	function check_pass(password){
		var pass_len = $.trim(password).length;
		return pass_len < 4 ? false : (pass_len < 16 ? true : false);
	}
	//提交普通登录
	function normal_submit_login(username,password,remember,vcode,random_key){
		if(typeof vcode =='undefined'){
			var data = {"username":username,"password":password,"remember":remember};
		}else{
			var data = {"username":username,"password":password,"remember":remember,"vcode":vcode,"vcode_key":random_key};
		}
		var normal_submit_action = $('.normal_form').attr('action');

		$.ajax({
			url      : normal_submit_action,
			type     : "post",
			data     : data,
			dataType : "json",
			success: function(d) {
				if (d.success == false) {
					$("#error_msg_one").text(d.msg);
					if(_ranom_key == ''){
						_ranom_key = Math.random()*10000000000000000+'';
						_ranom_key = _ranom_key.substring(0,15);
					}
					if(d.data == 101){
						//生成随机数，唯一标识，用于服务端识别  验证码  属主
						status = true;
						$('.error_test_box').show().find('.error_test_word img').attr('src','/tools/validcode?'+Math.random()+'&key='+_ranom_key);
					}else if(d.data == 103){
						status = true;
						$('.error_test_box').show().find('.error_test_word img').attr('src','/tools/validcode?'+Math.random()+'&key='+_ranom_key);
						$("#error_msg_one").text(d.msg);
					}
				} else {
					window.location.href = d.data;
				}
			}
		});
	}
	//刷新验证码
	$('.error_test_word,.changeone').click(function(){
		refresh_vcode($('.error_test_box .error_test_word img'));
	});
	function refresh_vcode(obj){
		var vcode_src = '/tools/validcode?'+Math.random()+'&key='+_ranom_key;
		obj.attr('src',vcode_src);
	}
	function check_vcode(vcode){
		return vcode.length = 4 ? true : false;
	}

	//动态登录--------------------------------------------------------------------------------------------------------
	//获取验证码
	var _timer;
	var n;
	$('.timer_btn').click(function(){
		var tele_num = $('.m_ipt_phone').val();
		if(valid_phone(tele_num)){
			get_vcode(tele_num);
		}else{
			$('#error_msg').html('请输入正确的手机号码！');
		}
	});
	//执行登录操作
	$('.activity_submit').click(function(){
		var tele_num = $('.m_ipt_phone').val();
		var vcode = $('.m_ipt_test').val();
		if(valid_phone(tele_num) && valid_vcode(vcode)){
			submit_act_login(tele_num,vcode);
		}else{
			$('#error_msg').html('请出入正确的手机号码与验证码！');
		}
	});

	//提交登录验证
	function submit_act_login(tele,vcode){
		$.ajax({
			url:'/account/activitylogin',
			type:'post',
			data:{"tele":tele,"vcode":vcode,"act":2},
			success:function(d){
				var d = JSON.parse(d);
				if(d.success){
					location.href = d.data;
				}else{
					$('#error_msg').html('验证码错误，请重新输入');
				}
			}
		});
	}
	//获取验证码
	function get_vcode(tele){
		$.ajax({
			url  :'/account/activitylogin',
			type :'post',
			data :{"tele":tele,"act":1},
			success:function(d){
				var d = JSON.parse(d);
				if(d.success){
					show_second();
				}
				else{
					$('#error_msg').html(d.msg);
				}
			}
		});
	}
	//验证手机号码
	function valid_phone(tele){
		var tele_patten = /^1[3|4|5|7|8]\d{9}$/;
		if(tele_patten.test(tele)){
			return true;
		}
		return false;
	}
	//初步验证验证码
	function valid_vcode(vcode){
		var vcode_pattern = /\d{6}/;
		if(vcode_pattern.test(vcode)){
			return true;
		}
		return false;
	}
	//显示计时
	function show_second(){
		$('.countTime').html('119');
	    n = 119;
		$('.timer_btn').hide();
		_timer = setInterval(countTime,1000);
		$('.timer').show();
	}
	function countTime(){
		n -= 1;
		if(n == 0){
			clearInterval(_timer);
			$('.timer_btn').show();
			$('.timer').hide();
		}
		$('.countTime').html(n);
	}
})();