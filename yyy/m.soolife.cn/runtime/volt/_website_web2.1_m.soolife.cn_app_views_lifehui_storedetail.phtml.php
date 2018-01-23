<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>如此生活|惠生活</title>
	<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">	
    <link rel="stylesheet" href="/public/ext/css/soo.m.ui.css">
    <link rel="stylesheet" href="/public/ext/css/download.css">
    <link rel="stylesheet" href="/public/ext/css/swiper.css">
	<link rel="stylesheet" type="text/css" href="/public/css/lifehui/common.css"/>
	<link rel="stylesheet" type="text/css" href="/public/css/lifehui/store.css"/>
</head>
<body>
<div class="index_wrap">
	<div class="header">
	    <a onclick="window.history.go(-1)"><img class="arrow"  src="/public/img/common/shop_back_black@1x.png " ></a>
        <?php if ($shop) { ?>
		<span class="head_title"><?= $shop['store_name'] ?></span> 
        <?php } ?>
	</div>
	<!-- 下载框 -->
	<!-- <div class="download_box" id="download-nav">
		<div class="remove" id="download-nav-hide"><img src="../public/img/common/icon_close@3x.png" alt=""></div>
		<div class="logo"><img src="../public/img/common/logo@3x.png" alt=""></div>
		<div class="word">下载如此生活客户端</div>
		<div class="sure" id="download-nav-sure"><div>下载</div></div>
	</div> -->
	<div id="wrap">
		<!-- 轮播 -->
		<?php if ($shop) { ?>
		<div class="swiper-container">
			<div class="swiper-wrapper">
            <?php foreach ($shop['albums'] as $d) { ?>
				<div class="swiper-slide"> 
					<a href="">
						<img src="<?= $d ?>">
					</a> 
				</div>
            <?php } ?>
			</div>
			<!-- 分页效果 -->
			<div class="pagination"></div>
		</div>
        <?php } ?>
        <?php if ($shop) { ?>
        <div id="msg">
            <p class="store"><?= $shop['store_name'] ?></p>
            <div id="telphone" class="tel">
	            <p><a>电话:</a><a class="a_tel" href="tel:<?= $shop['telphone'] ?>"><span><?= $shop['telphone'] ?></span></a></p>
                <a class="a_tel" href="tel:<?= $shop['telphone'] ?>">
                    <img class="more" src="/public/img/lifehui/life_more.png">
                </a>
            </div>
            <div class="adress">
            	<p><?= $shop['address'] ?></p>
            	<!-- <img class="more" src="/public/img/lifehui/life_Shape.png"> -->
            </div>
            <div class="require">
            	<p class="limit">
            		<span class="txt">限时</span>
            		<span>消费券仅限购买当日使用</span>
            	</p>
            	<p class="order">
            		<span class="txt">今日首单</span>
            		<span>今日消费首单优惠</span>
            	</p>
            </div>
        </div>
        <?php } ?>
        <?php if ($shop) { ?>
        <div id="banner">
        	<img src="<?= $shop['logo'] ?>">
        </div>
        <?php } ?>
        <div id="service"><span>所有服务</span></div>
        <?php if ($shop) { ?>
        <?php if ($shop['service']) { ?>
        <ul id="service_list">
        <?php foreach ($shop['service'] as $d) { ?>
        	<li>
        		<img src="<?= $d['logo'] ?>">
        		<p class="title"><?= $d['name'] ?></p>
               
        		<!-- <p class="first">今日首单</p>
        		<p class="coin"><?= $d['coin'] ?>星币</p>
                <a href="/lifehui/download.html?msg_txt=1" id="btn">免费兑换</a> -->
             
                <p class="first"><?= $d['promo_name'] ?></p>
                <p class="coin">
                <?php if ($d['price'] != 0 && $d['coin'] != 0) { ?>
                    ￥<?= $d['price'] ?> + <?= $d['coin'] ?>星币
                <?php } elseif ($d['price'] == 0 && $d['coin'] != 0) { ?>
                    <?= $d['coin'] ?>星币
                <?php } elseif ($d['price'] != 0 && $d['coin'] == 0) { ?>
                    <?= $d['price'] ?>星币
                <?php } ?>
                </p>
                <a href="/lifehui/download.html?msg_txt=1" id="btn">立即购买</a>
        	</li>
        <?php } ?>
        </ul>
        <?php } ?>
        <?php } ?>
	</div>
</div>
</body>
</html>
<script type="text/javascript" src="/public/js/rem.js"></script> 
<script type="text/javascript" src="/public/ext/js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="/public/js/jquery.base64.js"></script>
<script type="text/javascript" src="/public/ext/js/soo.m.ui.js"></script>
<script type="text/javascript" src="/public/ext/js/download.js"></script>
<script type="text/javascript" src="/public/ext/js/swiper.min.js"></script>
<script type="text/javascript" src="/public/js/lifehui/storedetail.js"></script>