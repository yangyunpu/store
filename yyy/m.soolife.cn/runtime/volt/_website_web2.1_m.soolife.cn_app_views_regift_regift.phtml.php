<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>如此生活|注册送礼</title>
	<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=0">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">	
	<link rel="stylesheet" type="text/css" href="/public/ext/css/soo.m.ui.css"/> 
	<link rel="stylesheet" href="/public/ext/css/download.css"> 
	<link rel="stylesheet" type="text/css" href="/public/css/regift/regift.css"/>
	<script src="/public/js/rem2.js"></script> 
</head>
<body>
<div id="regift">
	 <!-- 头部 -->
	<div id="head">
		<!-- <div id="head-left"><img src="/public/img/newcategory/Group22Copy2.png" alt=""></div><div id="head-right" ></div> -->
		<div id="head-center" class="between">注册送礼</div>
	</div>
	<!-- 下载框 -->
	<div class="download_box" id="download-nav">
		<div class="remove" id="download-nav-hide"><img src="../public/img/common/icon_close@3x.png" alt=""></div>
		<div class="logo"><img src="../public/img/common/logo@3x.png" alt=""></div>
		<div class="word">注册送大礼</div>
		<div class="sure"><div><a href="/i/show/download.html?msg=4" style="color:#fff;">注册</a></div></div>
	</div>
	<div id="top_place"></div> 
	<!-- banner  -->
	<div class="banner">
		<img src="/public/img/regift/banner (3).jpg" alt="">
		<img src="/public/img/regift/banner (1).jpg" alt="">
		<img src="/public/img/regift/banner (2).jpg" alt="">
	</div>
	<!-- main -->
	<div id="main">
		<div id="box">

			<div class="name"><input type="text" name="phone" placeholder="请输入你的手机号码" maxlength="11"></div>
			<div>
				<input type="text" name="vcode" placeholder="请输入短信验证码" id="testword" maxlength="6"/>
				<input type="hidden" name="unique" value="<?php echo isset($_GET['unique']) ? $_GET['unique']:'';?>" />
				<input type="hidden" name="source" value="<?php echo isset($_GET['source']) ? $_GET['source']:'';?>" />
				<input type="hidden" name="referrer" value="<?php echo isset($_GET['referrer']) ? $_GET['referrer']:'';?>" />
				<p id="testboxs" class="testbox">短信验证码</p>
				<p id="testboxh" class="testbox hide" style="display:none">短信验证码</p>
			</div>
			<div class="password"><input type="password" name="password" placeholder="输入6-15位的密码" minlength="6"></div>
			<div id="sure">立即注册</div>
		</div>
	</div>
</div>
<div id="mark" style="display:none">
	<div id="markmain">
		<a href="<?= $url_m2 ?>"><img src="../public/img/common/delete@2x.png"></a>
		<div id="mtitle">恭喜您，成功领取注册领包</div>
		<div id="qianbao">大礼包正在飞往您的钱包</div>
		<div class="dongtai">
		<p>星币<span id="xing"></span>个</p>
		<p>现金<span id="xian"></span>元</p>
	<!-- 	<p>钱包<span id="qian"></span>元</p> -->
		<p>优惠券<span id="you"></span>张</p>
		</div>
		
		<div class="mengxin"><a href="/new/people.html" style="text-decoration:none;color: #fff;">我是萌新</a></div>
	</div>
</div>
<div id="alert_mark" style="display:none;"></div>

</body>
</html>
<script src="/public/ext/js/jquery-1.8.3.min.js"></script>  
<script src="/public/ext/js/download.js"></script> 
<script src="/public/js/regift/regift.js"></script>