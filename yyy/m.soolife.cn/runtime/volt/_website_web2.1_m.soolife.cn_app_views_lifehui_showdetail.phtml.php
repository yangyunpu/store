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
	<link rel="stylesheet" type="text/css" href="/public/css/lifehui/show.css"/>
</head>
<body>
<div class="index_wrap">
	<div class="header">
	    <a onclick="window.history.go(-1)"><img class="arrow"  src="/public/img/common/shop_back_black@1x.png " ></a>
		<span class="head_title">星粉秀详情</span> 
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
        <?php if ($fandetail) { ?>
        <?php if ($fandetail['fans_show']) { ?>
		<div class="swiper-container">
			<div class="swiper-wrapper">
			<?php foreach ($fandetail['fans_show']['albums'] as $d) { ?>
				<div class="swiper-slide"> 
					<img class="photo" src="<?= $d['photo'] ?>">
				</div>
			<?php } ?>
			</div>
			<!-- 分页效果 -->
			<div class="pagination"></div>
		</div>
		<?php } ?>
		<?php } ?>
		<?php if ($fandetail) { ?>
		<div id="msg">
			<div>
				<img src="<?= $fandetail['fans_show']['avatar'] ?>">
				<span class="txt"><?= $fandetail['fans_show']['nickname'] ?></span>
				<span class="msg_date"><?= $fandetail['fans_show']['time'] ?></span>
			</div>
			<p><?= $fandetail['fans_show']['text'] ?></p>
		</div>
		<?php } ?>
        <?php if ($fandetail) { ?>
        <?php if ($fandetail['fans_show']) { ?>
		<div id="record">
            <?php if ($fandetail['fans_show']['praise_avatar']) { ?>
			<div class="record_img">
			    <?php foreach ($fandetail['fans_show']['praise_avatar'] as $d) { ?>
				<img src="<?= $d['avatar'] ?>">
			    <?php } ?>
			</div>
			<?php } ?>

			<?php if ($fandetail['fans_show']['comments']) { ?>
			<ul id="record_list">
			<?php foreach ($fandetail['fans_show']['comments'] as $d) { ?>
				<li>
					<div>
					    <img src="<?= $d['avatar'] ?>">
						<span class="nick"><?= $d['nick_name'] ?></span>
						<span class="date"><?= $d['create_time'] ?></span>
					</div>
					<p><?= $d['comments'] ?></p>
				</li>
			<?php } ?>
			</ul>
			<?php } ?>
            <?php } ?>
            <?php } ?>
		</div>
		<!-- 蒙版 -->
		<div id="mask">
		    <div class="bg"></div>
			<img class="img" src="/public/img/lifehui/hsh_26.png">
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
<script type="text/javascript" src="/public/ext/js/swiper.min.js"></script>
<script src="/public/js/lifehui/showdetail.js"></script>