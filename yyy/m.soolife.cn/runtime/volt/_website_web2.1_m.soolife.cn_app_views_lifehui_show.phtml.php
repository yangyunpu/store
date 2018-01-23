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
	<link rel="stylesheet" type="text/css" href="/public/css/lifehui/common.css"/>
	<link rel="stylesheet" type="text/css" href="/public/css/lifehui/show.css"/>
</head>
<body>
<div class="index_wrap">
	<div class="header">
	    <a href="/lifehui/index.html"><img class="arrow"  src="/public/img/common/shop_back_black@1x.png " ></a>
		<span class="head_title">星粉秀列表</span> 
		 <a href="/lifehui/download.html?msg_txt=3"><span class="publish">发布</span></a>
	</div>
	<!-- 下载框 -->
	<!-- <div class="download_box" id="download-nav">
		<div class="remove" id="download-nav-hide"><img src="../public/img/common/icon_close@3x.png" alt=""></div>
		<div class="logo"><img src="../public/img/common/logo@3x.png" alt=""></div>
		<div class="word">下载如此生活客户端</div>
		<div class="sure" id="download-nav-sure"><div>下载</div></div>
	</div> -->

	<input type="hidden" value=" <?= $fan['skip'] ?>" id="hidden" name="">

	<div id="wrap">
        <?php if ($fan) { ?>
        <?php if ($fan['data']) { ?>
		<ul id="comment">
		<?php foreach ($fan['data'] as $d) { ?>
			<li>
				<a href="/lifehui/showdetail.html?fanshow_id=<?= $d['fanshow_id'] ?>">
					<div id="nick">
						<img src="<?= $d['photo'] ?>">
						<span><?= $d['nickname'] ?></span>
					</div>
	 				<div id="imglist">
	                <?php foreach ($d['photos'] as $res) { ?>
						<img src="<?= $res['pic'] ?>">
	                <?php } ?>
					</div>
					<p id="txt"><?= $d['memo'] ?></p>
					<p id="date"><?= $d['time'] ?></p>
					<div id="good">
						<div class="like">
							<img class="praise" src="/public/img/lifehui/good.png">
							<span><?= $d['praise'] ?></span>
						</div>
						<div class="edit">
							<img src="/public/img/lifehui/Group 9.png">
							<img class="hide" src="/public/img/lifehui/pinglun_xz.png">
							<span><?= $d['comment'] ?></span>
						</div>
					</div>
				</a>
			</li>
		<?php } ?>
		</ul>
        <?php } ?>
        <?php } ?>
	</div>
</div>
</body>
</html>
<script src="/public/js/rem.js"></script> 
<script src="/public/ext/js/jquery-1.8.3.min.js"></script>
<script src="/public/js/jquery.base64.js"></script>
<script src="/public/ext/js/soo.m.ui.js"></script>
<script src="/public/ext/js/download.js"></script>
<script src="/public/js/lifehui/showmore.js"></script>