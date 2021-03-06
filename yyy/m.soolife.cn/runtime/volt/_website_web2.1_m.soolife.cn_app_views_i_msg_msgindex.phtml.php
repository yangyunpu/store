<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>如此生活-我的消息|会员中心</title>
	<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">	
    <link rel="stylesheet" href="/public/ext/css/soo.m.ui.css">
    <link rel="stylesheet" href="/public/ext/css/download.css">
	<link rel="stylesheet" type="text/css" href="/public/css/i/common.css"/>
	<link rel="stylesheet" type="text/css" href="/public/css/i/msg/index.css"/>
</head>
<body>
<div class="index_wrap">
	<div class="header">
	    <a onclick="window.history.go(-1)"><img class="arrow"  src="/public/img/common/shop_back_black@1x.png " ></a>
		<span class="head_title">消息</span> 
	</div>
	<!-- 下载框 -->
<!-- 	<div class="download_box" id="download-nav">
		<div class="remove" id="download-nav-hide"><img src="../public/img/common/icon_close@3x.png" alt=""></div>
		<div class="logo"><img src="../public/img/common/logo@3x.png" alt=""></div>
		<div class="word">下载如此生活客户端</div>
		<div class="sure" id="download-nav-sure"><div>下载</div></div>
	</div> -->
	<div id="wrap">
		<ul id="msglist">
			<li>
				<a href="/i/msg/msgsystem.html">
					<img class="list_img" src="/public/img/i/mine_oredr_xitong@3x.png">
					<div class="list_txt">
						<p class="list_title">系统消息</p>
						<?php if ($systemmsg) { ?>
						<p class="list_details"><?= $systemmsg['0']['content']['title'] ?></p>
						<?php } else { ?>
						<p class="list_details"></p>
						<?php } ?>
					</div>
					<?php if ($systemmsg) { ?>
					<div class="list_date"><?= $systemmsg['0']['createtime'] ?></div>
					<?php } ?>
				</a>
			</li>
	<!-- 		<li>
				<a href="/i/msg/msgactive.html">
					<img class="list_img" src="/public/img/i/Group 13@3x.png">
					<div class="list_txt">
						<p class="list_title">活动消息</p>
						<?php if ($salesmsg) { ?>
						<p class="list_details"></p>
						<?php } else { ?>
						<p class="list_details"></p>
						<?php } ?>
					</div>
					<?php if ($salesmsg) { ?>
					<div class="list_date"><?= $salesmsg['0']['createtime'] ?></div>
					<?php } ?>
				</a>	
			</li> -->
			<li>
				<a href="/i/msg/msgorder.html">
					<img class="list_img" src="/public/img/i/mine_new_order@3x.png">
					<div class="list_txt">
					    <p class="list_title">订单消息</p>
					    <?php if ($ordermsg) { ?>
						<p class="list_details"><?= $ordermsg['0']['content']['status'] ?><?= $ordermsg['0']['content']['name'] ?></p>
						<?php } else { ?>
						<p class="list_details"></p>
						<?php } ?>
					</div>
					<?php if ($ordermsg) { ?>
					<div class="list_date"><?= $ordermsg['0']['createtime'] ?></div>
					<?php } ?>
				</a>
			</li>
			<li>
				<a href="/i/msg/msgasset.html">
					<img class="list_img" src="/public/img/i/Group 5@3x.png">
					<div class="list_txt">
						<p class="list_title">资产消息</p>
						<?php if ($assetmsg) { ?>
						<p class="list_details"><?= $assetmsg['0']['content']['title'] ?></p>
						<?php } else { ?>
						<p class="list_details"></p>
						<?php } ?>
					</div>
					<?php if ($assetmsg) { ?>
					<div class="list_date"><?= $assetmsg['0']['createtime'] ?></div>
					<?php } ?>
				</a>
			</li>
			<li>
				<a href="/i/msg/msgservice.html">
					<img class="list_img" src="/public/img/i/mine_new_shouhou@3x.png">
					<div class="list_txt">
						<p class="list_title">售后消息</p>
						<?php if ($aftermsg) { ?>
						<p class="list_details"><?= $aftermsg['0']['content']['status'] ?>[<?= $aftermsg['0']['content']['name'] ?>]</p>
						<?php } else { ?>
						<p class="list_details"></p>
						<?php } ?>
					</div>
					<?php if ($aftermsg) { ?>
					<div class="list_date"><?= $aftermsg['0']['createtime'] ?></div>
					<?php } ?>
				</a>
			</li>
		</ul>
	</div>
	
</div>
</body>
</html>
<script src="/public/js/rem.js"></script> 
<script src="/public/ext/js/jquery-1.8.3.min.js"></script>
<script src="/public/js/jquery.base64.js"></script>
<script src="/public/ext/js/soo.m.ui.js"></script>
<script src="/public/ext/js/download.js"></script>