<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>如此生活|会员中心</title>
	<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no" />
	<meta name="apple-mobile-web-app-status-bar-style" content="black">	
    <link rel="stylesheet" href="/public/ext/css/soo.m.ui.css">
    <link rel="stylesheet" href="/public/ext/css/download.css">
	<link rel="stylesheet" type="text/css" href="/public/css/i/common.css"/>
	<link rel="stylesheet" type="text/css" href="/public/css/i/coupon/coupon.css"/>
    <link rel="stylesheet" type="text/css" href="/public/css/setting/cash.css"/>
    <link rel="stylesheet" type="text/css" href="/public/css/setting/bindbank.css"/>
</head>
<body>
<div class="index_wrap">
	<div class="header">
	    <a onclick="window.history.go(-1)"><img class="arrow"  src="/public/img/common/shop_back_black@1x.png " ></a>
		<span class="head_title">绑定银行卡</span> 
	</div>
	<!-- 下载框 -->
<!-- 	<div class="download_box" id="download-nav">
		<div class="remove" id="download-nav-hide"><img src="../public/img/common/icon_close@3x.png" alt=""></div>
		<div class="logo"><img src="../public/img/common/logo@3x.png" alt=""></div>
		<div class="word">下载如此生活客户端</div>
		<div class="sure" id="download-nav-sure"><div>下载</div></div>
	</div> -->
	<div id="wrap">
        <div class="active_num"> 
            <?php if ($banklist['data']['bank_account']) { ?>
        	<div class="num_wrap change">
        	    <p class="num_title">姓名</p>
        	    <input class="num_input hide" type="text" value="" />
        	    <p class="num_num who"><?= $banklist['data']['bank_account'] ?></p>
        	</div>
            <?php } else { ?>
            <div class="num_wrap ">
                <p class="num_title">姓名</p>
                <input class="num_input hide" type="text" value="" />
                <p class="num_num who hide"></p>
            </div>
            <?php } ?>
            <?php if ($banklist['data']['bank_name']) { ?>
            <div class="num_wrap change">
                <p class="num_title">开户行</p>
                <input class="num_input hide" type="text" value="" />
                <p class="num_num bank_name"><?= $banklist['data']['bank_name'] ?></p>
            </div>
            <?php } else { ?>
            <div class="num_wrap ">
                <p class="num_title">开户行</p>
                <input class="num_input hide" type="text" value="" />
                <p class="num_num bank_name hide"></p>
            </div>
            <?php } ?>
            <?php if ($banklist['data']['bank_no']) { ?>
            <div class="num_wrap change">
                <p class="num_title">银行卡号</p>
                <input class="num_input hide" type="text" value="" />
                <p class="num_num bank_number"><?= $banklist['data']['bank_no'] ?></p>
            </div>
            <?php } else { ?>
            <div class="num_wrap ">
                <p class="num_title">银行卡号</p>
                <input class="num_input hide" type="text" value="" />
                <p class="num_num bank_number hide"></p>
            </div>
            <?php } ?>
            <div class="num_wrap hide ">
                <p class="num_title">手机号码</p>
                <input class="num_input hide" type="text" value="" />
                <p class="num_num mobile hide"><?= $phone ?></p>
            </div>
        	<div class="iphone">  
                <div class="iphones3">
                    <input id="code" type="text" name="vcode" maxlength="6" placeholder="验证码" autoComplete='off' value="" />
                    <div id="btn" name="" >获取验证码</div>
                    <div id="s_box" ></div>
                </div>
            </div>
        </div>
        <div class="flag">温馨提示：请仔细确认您绑定的银行账号，如果绑定错误，将会导致现金额转出有误，无法转账！
        </div>
        <a class="active_instant" type = "<?= $type ?>">绑定</a>
    </div>

    <!-- 弹框 -->
    <div id="mask_title" class="hide">
    </div>
</div>
</body>
</html>
<script src="/public/js/rem.js"></script> 
<script src="/public/ext/js/jquery-1.8.3.min.js"></script>
<script src="/public/js/jquery.base64.js"></script>
<script src="/public/ext/js/soo.m.ui.js"></script>
<script src="/public/ext/js/download.js"></script>
<script src="/public/js/setting/bindbank.js"></script>