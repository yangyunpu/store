<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>如此生活|会员中心</title>
	<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">	
    <link rel="stylesheet" href="/public/ext/css/soo.m.ui.css">
    <link rel="stylesheet" href="/public/ext/css/download.css">
    <link rel="stylesheet" href="/public/ext/css/swiper.css">
	<link rel="stylesheet" type="text/css" href="/public/css/i/common.css"/>
	<link rel="stylesheet" type="text/css" href="/public/css/i/money/view.money.css"/>
</head>
<body>
<div class="index_wrap">
	<div class="header">
	    <a onclick="window.history.go(-1)"><img class="arrow"  src="/public/img/common/shop_back_black@1x.png " ></a>
		<span class="head_title">充值钱包</span> 
	</div>
	<!-- 下载框 -->
<!-- 	<div class="download_box" id="download-nav">
		<div class="remove" id="download-nav-hide"><img src="../public/img/common/icon_close@3x.png" alt=""></div>
		<div class="logo"><img src="../public/img/common/logo@3x.png" alt=""></div>
		<div class="word">下载如此生活客户端</div>
		<div class="sure" id="download-nav-sure"><div>下载</div></div>
	</div> -->
	<div id="wrap">
	    <div id="cash_wrap">
            <?php if ($cashTotal) { ?>
			<p class="cash_balance"><span>现金余额 :</span><span class="cash_total"><?= $cashTotal ?></span><span>元</span></p>
            <?php } ?>
			<div class="cash_way">
				<div class="cash_re">
					<p class="cash_name">充值余额</p>
					<div class="cash_num">
						<input  class="cash_input hide" type="text"   value="" />
					    <p class="num cash"></p>
					</div>
				</div>
				<div class="cash_re">
					<p class="cash_name">支付密码</p>
					<div class="cash_num">
						<input class="cash_pw hide" type="password"  value="" />
					    <p class="num pw" data-item = ""></p>
					</div>
				</div>
			</div>
			<a class="cash_pay" type="<?= $type ?>">充值</a>
	    </div>
    </div>
    <div id="cash_mask" class="hide">
    	
    </div>
</div>
</body>
</html>
<script src="/public/js/rem.js"></script> 
<script src="/public/ext/js/jquery-1.8.3.min.js"></script>
<script src="/public/js/jquery.base64.js"></script>
<script src="/public/ext/js/soo.m.ui.js"></script>
<script src="/public/ext/js/download.js"></script>
<script src="/public/js/i/money/cashrecharge.js"></script> 