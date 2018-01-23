<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>如此生活|限时折扣</title>
	<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=0">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">	
	<link rel="stylesheet" type="text/css" href="/public/ext/css/soo.m.ui.css"/>  
	<link rel="stylesheet" type="text/css" href="/public/css/second/next.css"/> 
	<script src="/public/js/rem2.js"></script> 
</head>
<body>
 
<div id="nextlimit" data-itemurl="<?= $url_goods ?>">
	 <!-- 头部	 -->
	<div id="head">
		<div id="head-left" onclick="window.history.go(-1)"><img src="/public/img/newcategory/Group22Copy2.png" alt=""></div>
		<a href="<?= $url_order ?>/index.html"><div id="head-right" ><img src="/public/img/newcategory/gouwu1.png" alt=""></div></a>
		<div id="head-center" class="between">限时折扣</div>
	</div>
	<div id="top_place"></div>
	<input type="hidden" id="timekey" value="<?= $timekey ?>">
	<?php if ($limitdata) { ?>
	<input type="hidden" value="<?= $limitdata['index'] ?>" name="" id="hidden" />
	<?php if ($limitdata['goods']) { ?>
 	<div id="sentiment" class="inlinestyle"> 
 	<?php foreach ($limitdata['goods'] as $i => $items) { ?>
	 	<div class="alltitle">
	 	    <input type="hidden" class="stamp" value="<?= $items['end_date'] ?>" name="" data-index = "<?= $i ?>"/>
	 		<span>距离结束还有  </span>
	 		<span class="timestamp<?= $i ?>"></span>
	 	</div>
 		<!-- <p  data-begintime="<?= $items['begin_date'] ?>" data-endtime="<?= $items['end_date'] ?>"> 23:59:59 </p> -->
 		<?php foreach ($items['details'] as $item) { ?>	
 		<div class="item bg-white margin-b">
 			<div class="img_box float-l">
 				<a href="<?= $url_goods ?>/<?= $item['sku_id'] ?>.html"><img src="<?= $item['good_logo'] ?>"></a>
 				<!-- <p class="tag">海外精品</p>   -->
 			</div>
 			<div class="wen_box float-l">
 				<p class="name"><?= $item['good_name'] ?></p>
 				 <!-- <p class="smalltag"><span>海外精品</span></p>  -->
 				<!-- <p class="sales">销量:132</p> -->
 				<p class="piece">￥<?= $item['act_price'] ?><span class="oldpiece">￥<?= $item['shop_price'] ?></span></p>
 				<div class="imgbox car" data-goodid="<?= $item['sku_id'] ?>"><img src="/public/img/newcategory/gouwu.png"></div>
 			</div>
 		</div> 
 		<?php } ?>
 	<?php } ?>
 	</div>
 	<?php } ?>
 	<?php } ?>
</div> 
	<div id="alert_mark" style="display:none;"></div> 
</body>
</html>
<script src="/public/ext/js/jquery-1.8.3.min.js"></script>  
<script src="/public/js/second/limit.js"></script>