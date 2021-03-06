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
		<span class="head_title">钱包</span> 
	</div>
	<!-- 下载框 -->
<!-- 	<div class="download_box" id="download-nav">
		<div class="remove" id="download-nav-hide"><img src="../public/img/common/icon_close@3x.png" alt=""></div>
		<div class="logo"><img src="../public/img/common/logo@3x.png" alt=""></div>
		<div class="word">下载如此生活客户端</div>
		<div class="sure" id="download-nav-sure"><div>下载</div></div>
	</div> -->
	<div id="wrap">
		<div class="money_top">
	        <div class="money_bg">
            <?php if ($member) { ?>
	        	<div id="cash_num" class="money_num"><span>钱包余额</span>  <span id="num"><?= $member['money'] ?></span>  <span>元</span></div>
	        	<a  id="cash_change" class="money_change" href="/i/money/rechargelist.html?nickname=<?= $member['nickname'] ?>">充值钱包</a>
	        <?php } ?>
	        </div>
		</div>
        <div class="money_list">
            <?php if ($money) { ?>
	        <div class="record_date">
	        	<p>最近30天记录</p>
	        </div>
	    	<ul class="money_record">
	    		<?php foreach ($money as $d) { ?>
	    		<li>
	    			<div class="record_list">
	    				<p><?= $d['type'] ?></p>
	    				<p><?= $d['time'] ?></p>
	    			</div>
	    			<p class="record_num"><?= $d['pay'] ?></p>
	    		</li>
	    		<?php } ?>
	    	</ul>
	    	<?php } else { ?>
	    	<!-- 没有数据页面 -->
	    	<div class="money_data">
	    		<p class="data_no">暂时没有历史纪录</p>
	    	</div>
	    	<?php } ?>
        </div>
    </div>
</div>
</body>
</html>
<script src="/public/js/rem.js"></script> 
<script src="/public/ext/js/jquery-1.8.3.min.js"></script>
<script src="/public/js/jquery.base64.js"></script>
<script src="/public/ext/js/soo.m.ui.js"></script>
<script src="/public/ext/js/download.js"></script>