(function($){
	// 图形验证码
	var _ranom_key = Math.random()*10000000000000000+'';
	_ranom_key = _ranom_key.substring(0,15);
	$("#image").attr('src','/login/validcode?'+Math.random()+'&key='+_ranom_key);

	//更换图形验证码
	$("#image").click(function(){
		_ranom_key = Math.random()*10000000000000000+'';
		_ranom_key = _ranom_key.substring(0,15);
		$(this).attr('src','/login/validcode?'+Math.random()+'&key='+_ranom_key);
	});

	var register_m = {
		//n:120,
		b_event:function(){
			this.test_btn_click();
			$('.phone_text').blur(function(){
				register_m.judge_phone();
			});
			$(document).keypress(function(e){
				if(e.which == 13){
					$('.submit_button').click();
				}
			});
			$('.password_text').blur(function(){
				register_m.judge_password();
			});
			$('.password_again').blur(function(){
				register_m.judge_password_again();
			});
			$('.submit_button').click(function(){
				register_m.submit_reginfo();
			});
			$('.phone_text,.password_text,.password_again,.vcode').focus(function(){
				register_m.hide_error_msg();
			});
		},
		judge_phone:function(){
			var _phone_text  = $('.phone_text');
			var _t_tag_phone = $('.t_tag_phone');
			var _warn_word   = $('.warn_word');
			var phone_status = false;
			var check_phone  = (function(){
				var phone = _phone_text.val();
				if(!(/^1[3|4|5|7|8]\d{9}$/.test(phone))){
					 _t_tag_phone.attr('src','/public/img/login/error_tag.png');
					 _t_tag_phone.show();
					 _warn_word.html('您输入的手机号码格式不正确！')
					 return false;
				}else{
					phone_status = true;
					 _t_tag_phone.attr('src','/public/img/login/right_tag.png');
					 _t_tag_phone.show();
				}
			})()
			return phone_status;
		},
		judge_image_code:function(){
			var image_code = $(".image_vcode").val();
			if(image_code.length < 4){
				return false;
			}
		},
		judge_code:function(){
			var code_status = false;
			var check_code = (function(){
				var _code = $('.vcode').val();
				if(!(/[0-9]{6}/.test(_code))){
					$('.warn_word').html('请输入正确格式的验证码！');
				}else{
					code_status = true;
				}
			})()
			return code_status;
		},
		judge_password:function(){
			var _password_text  = $('.password_text');
			var _t_tag_password = $('.t_tag_password');
			var _warn_word = $('.warn_word');
			var pass_status = false;
			var check_pass = (function(){
				var password = _password_text.val();
				if(!(/\w{6,16}$/.test(password))){
					_t_tag_password.attr('src','/public/img/login/error_tag.png');
					_t_tag_password.show();
					_warn_word.html('请输入6-15位数字,字母或下划线的密码!');
					pass_status = false;
				}else{
					_t_tag_password.attr('src','/public/img/login/right_tag.png');
					_t_tag_password.show();
					pass_status = true;
				}
			})()
			return pass_status;
		},
		judge_password_again:function(){
			var _password_again = $('.password_again');
			var _password_text = $('.password_text');
			var _t_tag_again = $('.t_tag_again');
			var _warn_word = $('.warn_word');
			var repass_status = false;
			var check_pass_again = (function(){
				var password_a = _password_again.val();
				var password_text = $('.password_text').val();
				if(password_a !==password_text){
					_t_tag_again.attr('src','/public/img/login/error_tag.png');
					_t_tag_again.show();
					_warn_word.html('两次输入密码不一样！')
				}else{
					_t_tag_again.attr('src','/public/img/login/right_tag.png');
					_t_tag_again.show();
					repass_status = true;
				}
			})()
			return repass_status;
		},
		judge_xieyi:function(){
			if($('.checkbox').is(":checked")){
				return true;
			}else{
				$('.warn_word').html('请勾选同意注册协议！');
				return false;
			}
		},
		test_btn_click:function(){
			var _this = this;
			var test_btn = $('.test_btn');
			test_btn.click(function(){
				var phone_val   = $('.phone_text').val();
				if(!_this.judge_phone()){
					return false;
				}
				_this.send_code(phone_val);
			})
		},
		send_code:function(phone){
			var image_Vcode = $(".image_vcode").val();
			$.ajax({
				url  :'/sop/register.html',
				type : "post",
				data : {"phone":phone,"act":1,"image_vcode":image_Vcode,"vcode_key":_ranom_key},
				dataType : "json",
				success: function(d){
					if(d.success){
						$('.warn_word').html('短信验证码已发送，请及时输入！').css('color','green');
						register_m.send_deal(true);
					}else{
						$('.warn_word').html(d.msg);
						register_m.send_deal(false);
					}
				}
			});
		},
		submit_reginfo:function(){
			var _this = this;
			if(_this.judge_phone() && _this.judge_code() && _this.judge_password() && _this.judge_password_again() && _this.judge_xieyi()){
				var phone    = $('.phone_text').val();
				var code     = $('.vcode').val();
				var password = $('.password_text').val();
				var source   = $('.source').val();
				var referrer = $('.referrer').val();
				var unique   = $(".unique").val();
				var data     = {"phone":phone,"act":2,"vcode":code,"password":password,"source":source,"referrer":referrer,"unique":unique};
				$.ajax({
					url  :'/sop/register.html',
					type : "post",
					data : data,
					dataType : "json",
					success: function(d){
						if(d.success){
							location.href='/sop/index.html';
						}
					}
				});
			}
		},
		hide_error_msg:function(){
			$('.warn_word').html('');
		},
		send_deal:function(status){
			if(status){
				var under_time = $('.under_time');
				var under_time_s = $('.under_time>span');
				under_time_s.html(119);
				$('.test_btn').hide();
				under_time.show();
				var n=119;
				var _timer = setInterval(
					function(){
						n -= 1;
						if(n == 0){
							clearInterval(_timer);
							$('.test_btn').show();
							$('.under_time').hide();
						}
						under_time_s.html(n);
					},1000);
			}else{
				return false;
			}
		}
	}
	register_m.b_event();
})($)
