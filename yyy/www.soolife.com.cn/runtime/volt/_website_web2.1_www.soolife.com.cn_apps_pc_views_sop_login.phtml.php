		<style type="text/css">
			*{
				margin:0;
				padding:0;
				font-family:"Microsoft YaHei","arial";
			}
		</style>
	<body class="l_enterIndex">
		<div class="headers" >
			<div class="logo-con w clearfix">
				<a href="#" class="logo"></a>
				<div class="logo-title"><img src="/public/img/login/enter(2)_03.png" alt="" /></div>
			</div>
		</div>
		<!-- 登录的主体部分 -->
		<div class="main_body_content">
			<div class="main_box">
				<div class="enter_content">
				<ul >
					<li class="btn_normal">普通登录</li>
					<li class="btn_move"> <img src="/public/img/login/iconfont-erweima-(2).png" alt="" class="new_tag"></li>
				</ul>
	<!-- 正常登录状态 -->
				<div class="normal_main">
					<form action="/sop/login.html?return_url=<?= $return_url ?>" data-err="<?= $error_num ?>" class="normal_form" onsubmit="return false;">
					<!-- 用户名 -->
							<input type="text" value="" placeholder="手机号" class="ipt ipt_text">
							<img src="/public/img/login/entertext_0.png" alt="" class="ipt_text_img">
					<!-- 密码 -->
							<input type="password" placeholder="密码" class="ipt ipt_password">
							<img src="/public/img/login/enterpasword_0.png" alt="" class="ipt_password_img">
					<!-- 掩藏的验证码 -->
							<div class="error_test_box">
						       <input type="text" placeholder="验证码" class="error_testword_text">
						       <div class="error_test_word"><img src=""></div>
						       <a href="javascript:void(0)" class="changeone">换一张</a>
							</div>
					</form>
					<p id="error_msg_one"></p>
					<p class="ipt_checkbox">
						<input type="checkbox" name="remember" value="1" checked="checked">记住用户名
						<a href="<?= $url_member ?>/account/forgot?s=1" target="_blank">忘记密码</a>
					</p>
					<input type="button" value="登&nbsp;录" class="ipt_btn normal_submit" >
					<span class="bottom_word">
						没有账号？30S快速&nbsp;<a href="/sop/register.html" class="zhu">注册</a>
					</span>
					<div class="partner">
						<span>使用合作网站账号登录:</span>
						<ul>
							<li><a href="/login/thirdlogin/qq"><img src="/public/img/login/b_2.png" alt="">QQ</a></li>
							<li><a href="/login/thirdlogin/wechat" id="wechat"><img src="/public/img/login/b_3.png" alt="">微信</a></li>
						</ul>
					</div>
				</div>
				<div class="move_main">
				<!-- 二维码显示 -->
					<div class="lj_code">
						<img class="codes1" src="">
						<input class="coder" type="hidden" name="coder" value="">
						<div id="lose_eff">
							<p>二维码失效</p>
							<p class="fclick">请点击刷新</p>
						</div>
					</div>
					<input type="hidden" value="<?= $url_website ?>" class="go_url">
					<!-- 成功确认 -->
					<div class="lj_success">
						<img class="codes2" src="/public/img/login/scan_success.png">
					</div>
					<div class="success2">
						<p>请在手机上确认登录</p>
						<p class="return2">返回二维码登录</p>
					</div>
					<!-- 二维码显示下方列表 -->
					<div class="iphone_socd">
						<img src="/public/img/login/icon_scan.png">
						<p class="lj_open">打开   “如此生活”  APP</p>
						<p class="lj_lead">扫一扫登录</p>
					</div>
					<div class="footder">
						<div class="lj_foot">
							<span class="lj_password"><a href="">密码登录</a></span>
							<span class="lj_free"><a href="/register.html">免费注册</a></span>
						</div>
					</div>
				</div>
				<div class="shadow"></div>
			</div>
			</div>
		</div>
		<br><br><br><br><br><br><br><br>
	</body>
</html>
<?php
$css = $this -> assets -> get('header');
$css -> addCss("public/css/p/view.login.css");

$js = $this -> assets -> get('footer');
$js -> addJs("public/js/p/view.login.js");
?>