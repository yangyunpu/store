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
	<link rel="stylesheet" type="text/css" href="/public/css/orders/common.css"/>
	<link rel="stylesheet" type="text/css" href="/public/css/i/common.css"/>
	<link rel="stylesheet" type="text/css" href="/public/css/orders/mylifeallstyle.css"/>

</head>
<body>
	<div class="index_wrap">
		<div class="header">
		    <a onclick="window.history.go(-1)"><img class="arrow"  src="/public/img/common/shop_back_black@1x.png " ></a>
			<span class="head_title">售后/退款</span> 
		</div>
	<!-- <div class="header">
		<span class="headleft" onclick="window.history.go(-1)">
			<a class="back">
			    <img src="/public/mobile/img/mylife/qleft_03.png"/>
			</a>
		</span>
		<span class="headTitle">售后/退款</span>
	</div> -->

	<div class="top-re">
		<ul class="re-top">
			<li class="<?= ($status == 0 ? 'navActive' : 'complete') ?>">
				全部
			</li>
			<li class="<?= ($status == 1 ? 'navActive' : 'proceed') ?>">
				进行中
			</li>
			<li class="<?= ($status == 2 ? 'navActive' : 'achieve') ?>">
				已完成
			</li>
		</ul>
	</div>
	<?php if ($result->items) { ?>
	<?php foreach ($result->items as $vo) { ?>
	<div class="baner">
		<div class="banertop_qwe">
			<span>服务单号:<?= $vo->order_no ?></span>
			<?php if ($vo->status == 3) { ?> 
				<div class="banerimg"><img src="/public/img/orders/shouhou_yiquxiao@3x.png" /></div>
			<?php } elseif ($vo->type == 1) { ?>
			    <div class="banerimg"><img src="/public/img/orders/myorder_return@3x.png" /></div>
			<?php } elseif ($vo->type == 2) { ?>
				<div class="banerimg"><img src="/public/img/orders/myorder_exchange@3x.png" /></div>
			<?php } elseif ($vo->type == 3) { ?>
				<div class="banerimg"><img src="/public/img/orders/myorder_maintain@3x.png" /></div>
			<?php } ?>
		</div>
		<div class="picture_adsd"
			aftersales-id = <?= $vo->id ?>
		>
			<div class="logo_qwe">
				<img src="<?= $vo->logo ?>" width="60px">
			</div>
			<div class="title_shd">
				<p class="name_ads">
					<?= $vo->goods_name ?>
				</p>
				<p>
					<?= $vo->specs ?>
				</p>
			</div>
			<div class="qwewre">
				<p>
					¥<?= $vo->price ?>
				</p>
				<p class="price">
					x<?= $vo->qty ?>
				</p>
			</div>
		</div>
		<div class="apply">
			<span>状态: <?= $vo->status_text ?></span>
		</div>
		<div class="applytime">
			<span>申请时间: <?= date('Y-m-d H:i:s', $vo->create_time) ?></span>
		</div>
		<div class="problem clearfix">
			<p class="bottomem_asdsf">问题描述: <?= $vo->description ?></p>
			<?php if ($vo->status != 3) { ?>
			<p class="botom_dsjahd fr" aftersales_id=<?= $vo->id ?>>取消申请</p>
			<?php } ?>
		</div>
	</div>
	<?php } ?>
	<?php } else { ?>
		<div class="searchno">
			<img src="/public/img/orders/sss_03.png" width="100"/>
			<br />
			<br />
			<b>您目前还没有记录哦 </b>
		</div>
	<?php } ?>
	<div class="bottom"></div>

</div>
</body>
</html>
<script src="/public/ext/js/jquery-1.8.3.min.js"></script>
<script src="/public/js/jquery.base64.js"></script>
<script src="/public/ext/js/soo.m.ui.js"></script>
<script src="/public/ext/js/download.js"></script>
<script src="/public/js/orders/view.orders.aftersale.js"></script>
