<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>如此生活|登录</title>
		<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<link rel="stylesheet" type="text/css" href="/public/css/logins/login.css"/>

	</head>
<body>
	<div class="wrap">
		<div class="header" id="header">
			<span onclick="window.history.go(-1)">
				<img src="/public/img/brandhui/xingxingsha_back@2x.png " class="lefter">
			</span>
			<span class="lj_srt">登录</span> 
		</div>
		<div class="void"></div>
		<div id="con">
			<div class="logo">
				<img src="/public/img/login/logo@2x.png">
			</div>
			
				<div class="iphone">
					<input type="text" name="" maxlength="11" placeholder="手机号">
					<input type="hidden" id="url" value="<?= $return_url ?>">
				</div>
			
				<div class="iphone" id ="password">
					<input type="password" name="" placeholder="密码">
				</div>

			<!-- 图形验证码 -->
			<div class="iphone  security">  
				<input id ="xcode" type="text" name="" placeholder="输入图片验证码" >
				<!-- <img class="img_code" src="/public/img/login/timg@2x.png"> -->
				<div class="img_code2"></div>
				<input id="xcode_key" type="hidden" name="xcode_key" value="" >

			</div>
			<div class="sure">登录</div>
			<div class="forgets">
				<a href="/forgets/forget.html"><span>忘记密码?</span></a>
				<a href="/enroll/enroll.html<?php echo isset($_GET['return_url']) ? '?return_url=' . $_GET['return_url'] : '' ?>"><span>注册</span></a>
			</div>


		</div>
		<!-- <div class="guess">
			<div class="like"><span>第三方账号直接登录</span></div>
		</div>
		<div class="tencent">
			<div class="wechat">
				<img src="/public/img/login/wechart.png">
				<p>微信登录</p>
			</div>
			<div class="qq">
				<img src="/public/img/login/QQ(3)@2x.png">
				<p>QQ登录</p>
			</div>
		</div> -->
	</div>	
	
	<div id="exceed"></div>
</body>
</html>

<script src="/public/js/rem.js"></script> 
<script src="/public/ext/js/jquery-1.8.3.min.js"></script>
<script src="/public/js/login/view.login.js"></script>