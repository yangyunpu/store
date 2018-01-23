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
	<link rel="stylesheet" type="text/css" href="/public/css/i/msg/index.css"/>
</head>
<body>
<div class="index_wrap">
	<div class="header">
	    <a onclick="window.history.go(-1)"><img class="arrow"  src="/public/img/common/shop_back_black@1x.png " ></a>
		<span class="head_title">订单消息</span> 
	</div>
	<!-- 下载框 -->
<!-- 	<div class="download_box" id="download-nav">
		<div class="remove" id="download-nav-hide"><img src="../public/img/common/icon_close@3x.png" alt=""></div>
		<div class="logo"><img src="../public/img/common/logo@3x.png" alt=""></div>
		<div class="word">下载如此生活客户端</div>
		<div class="sure" id="download-nav-sure"><div>下载</div></div>
	</div> -->
	<div id="wrap">
		<?php if ($order) { ?>
		<input type="hidden" value="<?= $order['skip'] ?>" id="order_skip" />
		<?php if ($order['data']) { ?>
        <ul id="msgorder">
        <?php foreach ($order['data'] as $d) { ?>
        	<li>
                <a href="/orders/details/<?= $d['extras']['id'] ?>.html">
	        		<p class="order_date"><?= $d['createtime'] ?></p>
	        		<div class="order_con">
	        		    <p class="order_title"><span><?= $d['status'] ?></span></p>
	        		    <div class="order_txt">
		        			<img src="<?= $d['content']['logo'] ?>">
		        			<div class="order_msg">
		        				<p class="order_intro"><?= $d['content']['name'] ?></p>
		        				<p class="order_num">运单编号：<?= $d['content']['express_code'] ?></p>
		        			</div>
	        		    </div>
	        		</div>
	            </a>
        	</li>
        <?php } ?>
        </ul> 
        <?php } ?>
        <?php } ?>
        <p id="hidden" style="text-align:center;display:none;">没有更多消息了...</p>
    </div>
</div>
</body>
</html>
<script src="/public/js/rem.js"></script> 
<script src="/public/ext/js/jquery-1.8.3.min.js"></script>
<script src="/public/js/jquery.base64.js"></script>
<script src="/public/ext/js/soo.m.ui.js"></script>
<script src="/public/ext/js/download.js"></script>
<script src="/public/js/i/msg/msgorder.js"></script> 