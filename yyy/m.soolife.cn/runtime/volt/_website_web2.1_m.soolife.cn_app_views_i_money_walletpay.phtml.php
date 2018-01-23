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
		<span class="head_title">支付中心</span> 
	</div>
	<!-- 下载框 -->
<!-- 	<div class="download_box" id="download-nav">
		<div class="remove" id="download-nav-hide"><img src="../public/img/common/icon_close@3x.png" alt=""></div>
		<div class="logo"><img src="../public/img/common/logo@3x.png" alt=""></div>
		<div class="word">下载如此生活客户端</div>
		<div class="sure" id="download-nav-sure"><div>下载</div></div>
	</div> -->
	<div id="wrap">
    
        <?php if ($orderNo) { ?>
        <input id="order_id"  type="hidden" value="<?= $orderNo ?>" />
        <?php } ?>
        <?php if ($openid) { ?>
        <input  type="hidden" value="<?= $openid ?>" />
        <?php } ?>


        <div class="pay_wrap">
       	    <img class="pay_img" src="/public/img/i/mine_zhifu_chenggong@3x.png">
       	    <p class="pay_suc">订单提交成功</p>
       	    <p class="pay_warn">请您在提交订单后24小时内完成支付,否则订单会自动取消。</p>
            <?php if ($create_time) { ?>
            <p class="pay_date"><?= $create_time ?></p>
            <?php } ?>
        </div>
        <div class="pay_money">
	       	<span>应付金额</span>
          <?php if ($pay_fee) { ?>
	       	<span>¥<?= $pay_fee ?></span>
          <?php } ?>
        </div>
        <div class="pay_way">
       	    <div class="pay_pay">
       	     	<img class="way_img" src="/public/img/i/mine_zhifu_zhifubao@3x.png">
       	     	<span class="way_txt">支付宝支付</span>
       	     	<img class="way_check" src="/public/img/i/mine_zhifu_yuan@3x.png">
       	    </div>
       	    <!-- <div class="pay_pay">
       	     	<img class="way_img" src="/public/img/i/mine_zhifu_weixin@3x.png">
       	     	<span class="way_txt">微信支付</span>
       	     	<img class="way_check" src="/public/img/i/mine_zhifu_yuan@3x.png">
       	    </div> -->
        </div>
        <a class="suc_pay">确认付款</a>
    </div>
    <!-- 蒙板 -->
    <div id="mask_pay" class="hide">
        
    </div>
</div>
</body>
</html>
<script src="/public/js/rem.js"></script> 
<script src="/public/ext/js/jquery-1.8.3.min.js"></script>
<script src="/public/js/jquery.base64.js"></script>
<script src="/public/ext/js/soo.m.ui.js"></script>
<script src="/public/ext/js/download.js"></script>
<script src="/public/js/i/money/walletpay.js"></script> 