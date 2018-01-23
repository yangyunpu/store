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
		<div class="item active float-l item_today">今日</div>
		<a href="/overseagoods/tomorrow.html?type=2"><div class="item float-l item_tomorrow">明日</div></a>
	</div>
	<?php if ($todaydata) { ?>
	<input type="hidden" id="hidden" value="<?= $todaydata['index'] ?>">
	<?php if ($todaydata['goods']) { ?>
	<div class="inlinestyle" id="today" data-itemurl="<?= $url_goods ?>">
		<?php if(array_key_exists('goods', $todaydata)):?>
 		<?php foreach ($todaydata['goods'] as $k => $item) { ?>
	 		<div class="alltitle">
	 			<input type="hidden" class="stamp" name="" data-index="<?= $k ?>" value="<?= $item['end_date'] ?>"  />
	 			<span>距离结束还有  </span>
	 			<span class="timestamp<?= $k ?>"></span>
	 		</div>
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
 					<div class="imgbox car add-carts" data-goods-id="<?= $i['sku_id'] ?>" data-goodid="<?= $i['sku_id'] ?>"><img src="/public/img/newcategory/gouwu.png"></div>
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
	<div id="alert_mark" style="display:none;"></div>
</body>
</html>
<script src="/public/ext/js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="/public/js/overseagoods/header.js"></script>
<script type="text/javascript" src="/public/ext/js/swiper.min.js"></script>
<script type="text/javascript" src="/public/js/sdk.2.2.js"></script>
<script type="text/javascript" src="/public/js/overseagoods/today.js"></script>