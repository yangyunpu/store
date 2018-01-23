	<body class="l_register">
		<div class="headers">
			<div class="logo-con w clearfix">
				<a href="" class="logo"></a>
				<div class="logo-title"><img src="/public/img/login/reg_center.png" alt="" /></div>
			</div>
		</div>
		<!--主体内容-->
		<div class="middle">
			<div class="font_size">
				<div class="register">欢迎注册</div>
				<div class="wire_two">|</div>
				<div class="wire_sb">已有账号？现在去<a href="<?= $url_intranet ?>/sop/login.html">登录</a></div>
			</div>
			<div class="register-bd">
				<div class="register-bd-con ">
					<form action="" id="frm_register" class="register-from" novalidate="novalidate" method="post">
						<div class="register-line clearfix">
							<dl class="line-input-dl">
								<dt class="line-input-tit">手机号：</dt>
								<dd class="line-input-con">
									<input type="text" name="username" class="phone_text" placeholder="建议常用手机号" />
									<img src="/public/img/login/right_tag.png" alt="" class="t_tag t_tag_phone">
								</dd>
							</dl>
						</div>

						<div class="register-line clearfix text_box_h">
							<dl class="line-input-dl">
								<dt class="line-input-tit">验证码：</dt>
								<dd class="line-input-con">
									<input type="text" name="image_vcode"  placeholder="请输入验证码" class="test_again image_vcode"/>
									<div class="test_word"><img src="" id="image" style="width:140px;"></div>
								</dd>
							</dl>
						</div>

						<div class="register-line clearfix">
							<dl class="line-input-dl">
								<dt class="line-input-tit">短信验证码：</dt>
								<dd class="line-input-con">
									<input type="text" name="username" class="frame vcode" />
									<input type="button" name="获取验证码" value="获取验证码" class="test_btn"/>
									<div class="under_time"><span></span>s后重新获取</div>
								</dd>
							</dl>
						</div>
						<div class="register-line clearfix">
							<dl class="line-input-dl">
								<dt class="line-input-tit">密码：</dt>
								<dd class="line-input-con">
									<input type="password" name="username"  placeholder="输入密码" class="password_text"/>
									<img src="/public/img/login/right_tag.png" alt="" class="t_tag t_tag_password">
								</dd>
							</dl>
						</div>
						<div class="register-line clearfix">
							<dl class="line-input-dl">
								<dt class="line-input-tit">确认密码：</dt>
								<dd class="line-input-con">
									<input type="password" name="username"  placeholder="再次确认密码" class="password_again"/>
									<img src="/public/img/login/right_tag.png" alt="" class="t_tag t_tag_again">

								</dd>
							</dl>
						</div>

						<input type="hidden" name="source"   class="source"   value="<?= (empty($source) ? ('') : ($source)) ?>" />
						<input type="hidden" name="unique"   class="unique"   value="<?= (empty($unique) ? ('') : ($unique)) ?>" />
						<input type="hidden" name="referrer" class="referrer" value="<?= (empty($referrer) ? ('') : ($referrer)) ?>" />

						<div class="register-line clearfix">
							<div class="line-protocol">
								<span class="warn_word"></span>
								<input type="checkbox" class="checkbox" checked="checked" />
								<label>我已经认真阅读并同意<a href="<?= $url_intranet ?>/sop/agreement.html" target="_blank">《如此生活服务协议》</a></label>
							</div>
						</div>
						<div class="register-line clearfix" id="immediately">
							<input type="button" class="submit_button" value="立即注册"type="submit"/>
						</div>
					</form>
				</div>
			</div>

		</div>
	</body>
<?php
$css = $this -> assets -> get('header');
$css -> addCss("public/css/p/view.register.css");
$js = $this -> assets -> get('footer');
$js -> addJs("public/js/p/view.register.js");
?>