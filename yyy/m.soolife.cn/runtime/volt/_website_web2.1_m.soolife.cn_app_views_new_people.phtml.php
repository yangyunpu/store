<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>新人专场|如此生活</title>
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">   
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <link rel="stylesheet" href="/public/ext/css/soo.m.ui.css">
    <!-- <link rel="stylesheet" href="/public/css/huilife/common.css"> -->
    <!-- <link rel="stylesheet" href="/public/css/huilife/index.css"> -->
	<link rel="stylesheet" href="/public/css/new/people.css">
</head>
<body id="new-people">


<!-- 头部 -->
<div id="pe-new-header">
	<div class="header-left fl-left">
		<a onclick="window.history.go(-1)"> <img src="../public/img/common/shop_back_black@2x.png" alt=""></a>
	</div>
	<!-- <div id="header-center">领星币</div> -->
	<div class="header-center fl-left">新人专场</div>
	<div class="header-right"></div>
</div>
<div class="pe_subject">
	<div class="header_link">
	<img class="link" src="<?= $data['picture']['banner'] ?>">
	<img class="coupon" src="<?= $data['picture']['ticket'] ?>">
	</div>
	<div class="explosive_goods">
		<div class="e-title"><?php if(!empty($data['title_a'])){ echo $data['title_a']; }?></div>
	</div>
	<?php if(!empty($data['sale'])){ ?>
	<?php foreach ($data['sale'] as $vo) { ?>
	<div class="burst">
		<div class="open-goods-detail" data-goods-id="<?= $vo['skuid'] ?>">
			<img src="<?= $vo['picture'] ?>">	
			<div class="price">
				<p >券后价：</p><p>￥<?= $vo['price'] ?></p>
			</div>
			<p><?= $vo['goods_name'] ?></p>
		</div>
		<!-- <p>5L 新西兰原装进口</p> -->
		<div class="purchase open-instant-buy" data-goods-id="<?= $vo['skuid'] ?>">立即购买</div>
	</div>
	<?php } ?>
	<?php } ?>
	<div class="explosive_goods">
		<div class="e-title"><?php if(!empty($data['title_b'])){ echo $data['title_b']; }?></div>
	</div>
	<?php if(!empty($data['discounts'])){ ?>
	<?php foreach ($data['discounts'] as $vo) { ?>
	<div class="burst">
		<div class="open-goods-detail" data-goods-id="<?= $vo['skuid'] ?>">	
			<img src="<?= $vo['picture'] ?>">
			<div class="price">
				<p ></p><p>￥<?= $vo['price'] ?></p>
			</div>
			<p><?= $vo['goods_name'] ?></p>
		</div>
		<!-- <p>5L 新西兰原装进口</p> -->
		<div class="purchase open-instant-buy" data-goods-id="<?= $vo['skuid'] ?>">立即购买</div>
	</div>
	<?php } ?>
	<?php } ?>
</div>
<script>

</script>
<script src="/public/ext/js/rem.js"></script>
<script type="text/javascript" src="/public/js/sdk.2.2.js"></script>
</body>
</html>