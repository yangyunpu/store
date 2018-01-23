<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>如此生活|海外精品</title>
	<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=0">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<link rel="stylesheet" type="text/css" href="/public/ext/css/soo.m.ui.css"/>
	<link rel="stylesheet" type="text/css" href="/public/css/overseagoods/more.css"/>
	<script src="/public/js/rem2.js"></script>
</head>
<body>
<div id="oversea">
	<!-- 头部 -->
	<div id="head">
		<div id="head-left" onclick="window.history.go(-1)"><img src="/public/img/newcategory/Group22Copy2.png" alt=""></div>
		<div id="head-right" >
			<a href="<?= $url_order ?>/index.html">
			    <img src="/public/img/newcategory/gouwu1.png">
			    <!-- <span id="head_num">0</span> -->
			</a>
		</div>
		<div id="head-center" class="between">限时折扣</div>
	</div>
	<div id="top_place"></div>
	<div class="morebtn clear-f bg-white">
		<a href="/overseagoods/today.html?type=1"><div class="item float-l item_today">今日</div></a>
		<div class="item active float-l item_tomorrow">明日</div>
	</div>
	<?php if ($tomorrow) { ?>
	<input type="hidden" id="hidden" value="<?= $tomorrow['index'] ?>">
	<?php if ($tomorrow['goods']) { ?>
	<div class="inlinestyle" id="torrow" data-itemurl="<?= $url_goods ?>">
 		<p id="alltitle">即将开启 敬请期待</p>
		<?php if(array_key_exists('goods', $tomorrow)):?>
 		<?php foreach ($tomorrow['goods'] as $item) { ?>
 		<?php foreach ($item['details'] as $i) { ?>
 		<div class="item bg-white margin-b">
 			<div class="img_box float-l">
 				<!-- <a href="<?= $url_goods ?>/<?= $i['sku_id'] ?>.html"> -->
 				<a class="open-goods-detail" data-goods-id="<?= $i['sku_id'] ?>">
 					<img src="<?= $i['good_logo'] ?>"></a>
 				<!-- <p class="tag">海外精品</p>   -->
 			</div>
 			<div class="wen_box float-l">
 				<p class="name"><?= $i['good_name'] ?></p>
 				 <!-- <p class="smalltag"><span>海外精品</span></p>  -->
 				<!-- <p class="sales">销量:132</p> -->
 				<p class="piece">￥<?= $i['act_price'] ?><span class="oldpiece">￥<?= $i['shop_price'] ?></span></p>
 			</div>
 		</div>
 		<?php } ?>
 		<?php } ?>
		<?php endif?>
 	</div>
 	<?php } else { ?>
 	<img class="no_data" src="/public/img/zanwushuju.png">
 	<?php } ?>
 	<?php } ?>
</div>

</body>
</html>
<script src="/public/ext/js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="/public/js/overseagoods/header.js"></script>
<script type="text/javascript" src="/public/ext/js/swiper.min.js"></script>
<script type="text/javascript" src="/public/js/sdk.2.2.js"></script>
<script type="text/javascript"src="/public/js/overseagoods/tomorrow.js"></script>