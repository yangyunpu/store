<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>如此生活|星星杀</title>
	<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">	
	<link rel="stylesheet" type="text/css" href="/public/ext/css/soo.m.ui.css"/>
	<link rel="stylesheet" href="/public/ext/css/download.css">
	<link rel="stylesheet" href="/public/ext/css/swiper.css">
	<link rel="stylesheet" type="text/css" href="/public/css/starkill/common.css"/>
</head>
<body>
<div class="details_wrap">
	<div class="header">
		<a href="/starkill/nostart.html"><img class="arrow"  src="/public/img/starkill/icon/Group 36.png " ></a>
		<span class="head_title">星星杀</span> 
	</div>
	<!-- 下载框 -->
	<!-- <div class="download_box" id="download-nav">
		<div class="remove" id="download-nav-hide"><img src="../public/img/common/icon_close@3x.png" alt=""></div>
		<div class="logo"><img src="../public/img/common/logo@3x.png" alt=""></div>
		<div class="word">下载如此生活客户端</div>
		<div class="sure" id="download-nav-sure"><div>下载</div></div>
	</div> -->
	<?php if ($details['data']) { ?>
	<div class="state_con">
    	<!-- 轮播 -->
    	<?php if ($details['data']['details_pictures']) { ?>
		<div class="swiper-container details-container">
			<div class="swiper-wrapper">
				<?php foreach ($details['data']['sku_album'] as $d) { ?>
				<div class="swiper-slide"> 
					<a href="">
						<img class="state_img" src="<?= $d ?>">
					</a> 
				</div>
				<?php } ?>		
			</div>
			<!-- 分页效果 -->
			<div class="pagination"></div>
		</div>
		<?php } ?>
        <div>
        	<p class="active_title"><?= $details['data']['name'] ?></p>
			<div class="active_txt">
			    <input name="" type="hidden" value="<?= $details['data']['pre_begin_date'] ?>" class="stamp" />
				<span class="differ_txt">距活动开启还有:</span>
				<span class="timestamp differ_time"></span>
			</div>
			<p class="detail_low">最低￥<?= $details['data']['floor_price'] ?></p>
			<p class="detail_price">原价￥<?= $details['data']['life_price'] ?></p>
        </div>
        <div class="details_img">
    	    <?= $details['data']['spu_pictures'] ?>
        </div>
    </div>
    <?php } ?>
    <a class="detail_buy" href="<?= $details['data']['url'] ?>/<?= $details['data']['sku_id'] ?>.html">原价购买</a>
</div>
</body>
</html>
<script src="/public/js/rem.js"></script> 
<script src="/public/ext/js/jquery-1.8.3.min.js"></script>
<script src="/public/ext/js/download.js"></script>
<script src="/public/js/jquery.base64.js"></script>
<script type="text/javascript" src="/public/ext/js/swiper.min.js"></script>
<script src="/public/js/starkill/details.js"></script>