<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>如此生活|二级频道</title>
	<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=0">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<link rel="stylesheet" type="text/css" href="/public/ext/css/soo.m.ui.css"/>
	<link rel="stylesheet" type="text/css" href="/public/css/second/secondindex.css"/>
	<link rel="stylesheet" href="/public/ext/css/swiper.css">
	<script src="/public/js/rem2.js"></script>
</head>
<body>
<!-- 搜索框页面 -->
<!-- <div id="search_box" style="display:none;" data-firstcode="<?= $urlcode['firstcode'] ?>">
	<div id="head">
		<div id="head-left"><img src="/public/img/newcategory/Group22Copy2.png" alt=""></div>
		<div id="head-right">搜索</div>
		<div id="head-center"><input type="text" id="inputbox" placeholder="搜索商品"/><img src="/public/img/newcategory/ser.png"></div>
	</div>
	<div id="top_place"></div>
	<div class="search_display">
		<p id="new">最近搜索</p>
		<div id="newbox">
			<div id="box"></div>
			<div id="remove">清除</div>
		</div>
		<p id="new">热门搜索</p>
		<div id="newbox">
		<?php if ($search) { ?>
			<?php foreach ($search as $d) { ?>
				<span class="hot"><?= $d['name'] ?></span>
		    <?php } ?>
		<?php } ?>
		</div>
	</div>
	<ul class="search_display_list">
	
	</ul>
</div> -->
<input type="hidden" id="firstcode" value="<?= $firstcode ?>">
<input type="hidden" id="twocode" value="<?= $twocode ?>">
<input type="hidden" id="brand_id" value="<?= $brand_id ?>">
<input type="hidden" id="shop_id" value="<?= $shop_id ?>">
<input type="hidden" id="countries" value="<?= $countries ?>">
<input type="hidden" id="specs" value="<?= $specs ?>">
<input type="hidden" id="_kai" value="<?= $_kai ?>">
<input type="hidden" id="_jie" value="<?= $_jie ?>">
<input type="hidden" id="span_str" value="<?= $span_str ?>">
<div id="threecate" data-csstag="<?= $csstag ?>" data-itemurl="<?= $url_goods ?>">
	 <!-- 头部	 -->
	<div id="head">
		<div id="head-left" onclick="window.history.go(-1)"><img src="/public/img/newcategory/Group22Copy2.png" alt=""></div>
		<div id="head-right" ><a href="/search.html"><img src="/public/img/newcategory/Group3Copy.png" alt=""></a></div>
		<div id="head-center" class="between">
			<?php foreach ($categoryresult as $k => $item) { ?>
				<?php if ($item['id'] == $urlcode['firstcode']) { ?>
					<?= $item['name'] ?>
					<?php break ?>
				<?php } ?>
			<?php } ?>
		</div>
	</div>
	<div id="top_place"></div>
	<?php foreach ($categoryresult as $item) { ?>
		<?php if ($item['id'] == $urlcode['firstcode']) { ?>
		<div id="top_place2"></div>
		<?php } ?>
	<?php } ?>

	<?php foreach ($categoryresult as $item) { ?>
		<?php if ($item['id'] == $urlcode['firstcode']) { ?>

				<div id="nav" class="slide-stage">
					<a href="/second/secondindex.html?firstcode=<?= $urlcode['firstcode'] ?>"><div class="item <?php if (!$urlcode['twocode']) { ?> active <?php } ?>">全部</div></a>
				<?php foreach ($item['items'] as $it) { ?>
				<a href="/newcategory/threecate.html?firstcode=<?= $urlcode['firstcode'] ?>&twocode=<?= $it['id'] ?>"><div class="item <?php if ($it['id'] == $urlcode['twocode']) { ?> active <?php } ?>"><?= $it['name'] ?></div></a>
				<?php } ?>
				</div>

			<?php break ?>
		<?php } ?>
	<?php } ?>



 	<?php if(isset($adv[0])){ ?>
	<?php if ($adv[0]['items']) { ?>
	<div class="swiper-container">
		<div class="swiper-wrapper">
			<?php foreach ($adv[0]['items'] as $item) { ?>
			<div class="swiper-slide">
				<a href="<?= $item['mobile_link'] ?>">
					<img src="<?= $item['picture'] ?>">
				</a>
			</div>
			<?php } ?>
		</div>
		<!-- 分页效果 -->
		<div class="pagination"></div>
	</div>
	<?php } ?>
 	<?php } ?>
	<!-- 今天存在 -->
<?php if ($time) { ?>
	<?php if ($time['begin'] && !$time['not_begin']) { ?>
	<div id="timelimit" class="bg-white">
		<?php if(array_key_exists('begin', $time)):?>
		<?php if ($time['begin']) { ?>
		<div class="timebtn active" id="nowbtn" style="width:100%;">
			<p>限时折扣</p>
			<p>SLALS</p>
		</div>
		<?php } ?>
		<?php endif?>
		<?php if(array_key_exists('begin', $time)):?>
		<?php if ($time['begin']) { ?>
		<div id="now" class="timemain">
			<div class="timemain_left">
				<input type="hidden" value="<?= $time['begin']['end_date'] ?>" name="" class="stamp"  data-index="0"/>
				<p class="text">距结束还有</p>
				<p class="time time2 timestamp0" data-endtime="<?= $time['begin']['end_date'] ?>" data-begintime="<?= $time['begin']['begin_date'] ?>">
				    <span>00</span>&nbsp;:&nbsp;<span>00</span>&nbsp;:&nbsp;<span>00</span>
				</p>
				<p class="name"><?= $time['begin']['good_name'] ?></p>
				<p class="piece piece2"><span>￥<?= $time['begin']['details'][0]['act_price'] ?></span><del>￥<?= $time['begin']['details'][0]['shop_price'] ?></del></p>
			</div>
			<div class="timemain_right">
				<a href="<?= $url_goods ?>/<?= $time['begin']['sku_id'] ?>.html"><img src="<?= $time['begin']['good_logo'] ?>" alt=""></a>
			</div>
			<a href="/second/limit/<?= $timekey ?>.html"><div class="more">查看更多</div></a>
		</div>
		<?php } ?>
		<?php endif?>
	</div>
	<?php } ?>
<?php } ?>


	<!-- 下期存在 -->
<?php if ($time) { ?>
	<?php if (!$time['begin'] && $time['not_begin']) { ?>
	<div id="timelimit" class="bg-white">
		<?php if(array_key_exists('not_begin', $time)):?>
		<?php if ($time['not_begin']) { ?>
		<div class="timebtn" id="nextbtn" style="width:100%;">
			<p>下期预告</p>
			<p>NEXT</p>
		</div>
		<?php } ?>
		<?php endif?>
		<?php if(array_key_exists('not_begin', $time)):?>
		<?php if ($time['not_begin']) { ?>
		<div id="next" class="timemain">
			<div class="timemain_left">
				<input type="hidden" value="<?= $time['not_begin']['begin_date'] ?>" name="" class="next_stamp"  data-index="0"/>
				<p class="text">距开始还有</p>
				<p class="time next_timestamp0" data-endtime="<?= $time['not_begin']['end_date'] ?> " data-begintime="<?= $time['not_begin']['begin_date'] ?>">
				    <span>00</span>&nbsp;:&nbsp;<span>00</span>&nbsp;:&nbsp;<span>00</span>
				</p>
				<!-- <p class="text">距开始还有</p>
				<p class="time" data-endtime="<?= $time['not_begin']['end_date'] ?>" data-begintime="<?= $time['not_begin']['begin_date'] ?>"><span>00</span>&nbsp;:&nbsp;<span>00</span>&nbsp;:&nbsp;<span>00</span></p> -->
				<p class="name"><?= $time['not_begin']['good_name'] ?></p>
				<p class="piece"><span>￥<?= $time['not_begin']['details'][0]['act_price'] ?></span><del>￥<?= $time['not_begin']['details'][0]['shop_price'] ?></del></p>
			</div>
			<div class="timemain_right">
				<a href="<?= $url_goods ?>/<?= $time['not_begin']['sku_id'] ?>.html"><img src="<?= $time['not_begin']['good_logo'] ?>" alt=""></a>
			</div>
			<a href="/second/next/<?= $timekey ?>.html"><div class="more">查看更多</div></a>
		</div>
		<?php } ?>
		<?php endif?>
	</div>
	<?php } ?>
<?php } ?>

	<!-- 下期和今天都存在 -->
<?php if ($time) { ?>
	<?php if ($time['begin'] && $time['not_begin']) { ?>
	<div id="timelimit" class="bg-white">
		<?php if(array_key_exists('begin', $time)):?>
		<?php if ($time['begin']) { ?>
		<div class="timebtn active" id="nowbtn">
			<p>限时折扣</p>
			<p>SLALS</p>
		</div>
		<?php } ?>
		<?php endif?>
		 <?php if(array_key_exists('not_begin', $time)):?>
		<?php if ($time['not_begin']) { ?>
		<div class="timebtn" id="nextbtn">
			<p>下期预告</p>
			<p>NEXT</p>
		</div>
		<?php } ?>
		<?php endif?>

		 <?php if(array_key_exists('begin', $time)):?>
		<?php if ($time['begin']) { ?>
		<div id="now" class="timemain">
			<div class="timemain_left">
				<input type="hidden" value="<?= $time['begin']['end_date'] ?>" name="" class="stamp"  data-index="0"/>
				<p class="text">距结束还有</p>
				<p class="time time2 timestamp0" data-endtime="<?= $time['begin']['end_date'] ?>" data-begintime="<?= $time['begin']['begin_date'] ?>">
				    <span>00</span>&nbsp;:&nbsp;<span>00</span>&nbsp;:&nbsp;<span>00</span>
				</p>
				<!-- <p class="text">距结束还有</p>
				<p class="time time2" data-endtime="<?= $time['begin']['end_date'] ?>" data-begintime="<?= $time['begin']['begin_date'] ?>"><span>00</span>&nbsp;:&nbsp;<span>00</span>&nbsp;:&nbsp;<span>00</span></p> -->
				<p class="name"><?= $time['begin']['good_name'] ?></p>
				<p class="piece piece2"><span>￥<?= $time['begin']['details'][0]['act_price'] ?></span><del>￥<?= $time['begin']['details'][0]['shop_price'] ?></del></p>
			</div>
			<div class="timemain_right">
				<a href="<?= $url_goods ?>/<?= $time['begin']['sku_id'] ?>.html"><img src="<?= $time['begin']['good_logo'] ?>" alt=""></a>
			</div>
			<a href="/second/limit/<?= $timekey ?>.html"><div class="more">查看更多</div></a>
		</div>
		<?php } ?>
		<?php endif?>
		 <?php if(array_key_exists('not_begin', $time)):?>
		<?php if ($time['not_begin']) { ?>
		<div id="next" class="timemain" style="display:none">
			<div class="timemain_left">
				<input type="hidden" value="<?= $time['not_begin']['begin_date'] ?>" name="" class="next_stamp"  data-index="0"/>
				<p class="text">距开始还有</p>
				<p class="time next_timestamp0" data-endtime="<?= $time['not_begin']['end_date'] ?> " data-begintime="<?= $time['not_begin']['begin_date'] ?>">
				    <span>00</span>&nbsp;:&nbsp;<span>00</span>&nbsp;:&nbsp;<span>00</span>
				</p>
				<!-- <p class="text">距开始还有</p>
				<p class="time" data-endtime="<?= $time['not_begin']['end_date'] ?>" data-begintime="<?= $time['not_begin']['begin_date'] ?>"><span>00</span>&nbsp;:&nbsp;<span>00</span>&nbsp;:&nbsp;<span>00</span></p> -->
				<p class="name"><?= $time['not_begin']['good_name'] ?></p>
				<p class="piece"><span>￥<?= $time['not_begin']['details'][0]['act_price'] ?></span><del>￥<?= $time['not_begin']['details'][0]['shop_price'] ?></del></p>
			</div>
			<div class="timemain_right">
				<a href="<?= $url_goods ?>/<?= $time['not_begin']['sku_id'] ?>.html"><img src="<?= $time['not_begin']['good_logo'] ?>" alt=""></a>
			</div>
			<a href="/second/next/<?= $timekey ?>.html"><div class="more">查看更多</div></a>
		</div>
		<?php } ?>
		<?php endif?>
	</div>
	<?php } ?>
<?php } ?>


	<!-- 星范儿 -->
	<!-- 四个广告位 -->
	<?php  if(isset($adv[1])){ ?>
	<?php if ($adv[1]['items']) { ?>
	<div class="adv"><a href="<?= $adv[1]['items'][0]['mobile_link'] ?>"><img src="<?= $adv[1]['items'][0]['picture'] ?>" alt=""></a></div>
	<?php } ?>
	<?php } ?>
	<?php  if(isset($adv[2])){ ?>
	<?php if ($adv[2]['items']) { ?>
	<div class="adv"><a href="<?= $adv[2]['items'][0]['mobile_link'] ?>"><img src="<?= $adv[2]['items'][0]['picture'] ?>" alt=""></a></div>
	<?php } ?>
	<?php } ?>
	<?php  if(isset($adv[3])){ ?>
	<?php if ($adv[3]['items']) { ?>
	<div class="fans"><a href="<?= $adv[3]['items'][0]['mobile_link'] ?>"><img src="<?= $adv[3]['items'][0]['picture'] ?>" alt=""></a></div>
	<?php } ?>
	<?php } ?>
	<?php  if(isset($adv[4])&&isset($adv[5])&&isset($adv[6])&&isset($adv[7])){ ?>
	<?php if ($adv[4]['items'] && $adv[5]['items'] && $adv[6]['items'] && $adv[7]['items']) { ?>
	<div id="adv">
		<?php if ($adv[4]['items']) { ?>
		<div class="adv_left"><a href="<?= $adv[4]['items'][0]['mobile_link'] ?>"><img src="<?= $adv[4]['items'][0]['picture'] ?>" alt=""></a></div>
		<?php } ?>
		<?php if ($adv[5]['items']) { ?>
		<div class="adv_right1"><a href="<?= $adv[5]['items'][0]['mobile_link'] ?>"><img src="<?= $adv[5]['items'][0]['picture'] ?>" alt=""></a></div>
		<?php } ?>
		<?php if ($adv[6]['items']) { ?>
		<div class="adv_right2"><a href="<?= $adv[6]['items'][0]['mobile_link'] ?>"><img src="<?= $adv[6]['items'][0]['picture'] ?>" alt=""></a></div>
		<?php } ?>
		<?php if ($adv[7]['items']) { ?>
		<div class="adv_right3"><a href="<?= $adv[7]['items'][0]['mobile_link'] ?>"><img src="<?= $adv[7]['items'][0]['picture'] ?>" alt=""></a></div>
		<?php } ?>
	</div>
	<?php } ?>
	<?php } ?>
	<!-- 星主题 -->
	<?php foreach ($starthemeresult as $key => $items) { ?>
	<?php if ($key == $categoryword) { ?>
	<div class="star_theme bg-white">
		<div class="banner"><a href="<?= $url_m2 ?>/startheme/themechild/<?= $items['id'] ?>.html"><img src="<?= $items['banner'] ?>" alt=""></a></div>
		<div class="theme_box slide-stage">
			<?php foreach ($items['goods'] as $item) { ?>
			<div class="item">
				<a href="<?= $url_goods ?>/<?= $item['sku_id'] ?>.html"><img src="<?= $item['sku_img'] ?>" alt=""></a>
				<p>￥<?= $item['price'] ?></p>
			</div>
			<?php } ?>
		</div>
		<?php break ?>
	</div>
	<?php } ?>
	<?php } ?>
 	<div id="catebtn_box" data-categories="<?= $categories ?>">
	 	<div id="catebtn" class="soo-row bg-white margin-b">
	 		<div class="soo-col-2 filter_btn active" data-sort="hot_desc"><span>人气 </span></div>
	 		<div class="soo-col-2 filter_btn" data-sort="sale_desc"><span>销量</span></div>
	 		<div class="soo-col-2 filter_btn" data-sort="new_desc"><span>新品</span></div>
	 		<div class="soo-col-2" id="filter_piece">
		 		<span>价格</span>
		 		<img src="/public/img/newcategory/jiage(1).png" id="piecea">
		 		<img src="/public/img/newcategory/jiage(2).png" style="display:none" id="piecev">
		 	</div>
	 		<div class="soo-col-2" id="filter_view">
	 			<div class="border_l">
		 		<img src="/public/img/newcategory/shanxuh.png" class="inlienb">
		 		<img src="/public/img/newcategory/shanxuk.png" style="display:none;" class="blockb">
	 			</div>
	 		</div>
	 		<div class="soo-col-2" id="filter_lou"><span>筛选</span><img src="/public/img/newcategory/loudou.png"></div>
	 	</div>
 	</div>
 	<!-- 删选之后 -->
 	<?php if ($spandata) { ?>
 	<div id="filtered" class="slide-stage">
 		<?php foreach ($spandata as $item) { ?>
 		<span><?= $item ?></span>
 		<?php } ?>
 	</div>
 	<?php } ?>
	<!-- 人气 -->
 	<div id="sentiment" class="blockstyle">
 	<?php if ($goodsresult) { ?>
	 	<?php if ($goodsresult['items']) { ?>
	 		<?php foreach ($goodsresult['items'] as $items) { ?>
	 		<div class="item bg-white margin-b">
	 			<div class="img_box float-l">
	 				<a href="<?= $url_goods ?>/<?= $items['items'][0]['id'] ?>.html"><img src="<?= $items['items'][0]['logo'] ?>"></a>
	 				<?php if ($items['items'][0]['type'] == 1) { ?>
	 				<p class="tag">海外精品</p>
	 				<?php } ?>
	 			</div>
	 			<div class="wen_box float-l">
	 				<p class="name"><?= $items['items'][0]['name'] ?></p>
	 				<?php if ($items['items'][0]['type'] == 1) { ?><p class="smalltag"><span>海外精品</span></p><?php } ?>
	 				<!-- <p class="sales">销量:132</p> -->
	  				<?php if ($items['items'][0]['promo']['type'] == 0) { ?>
	 				<p class="piece">￥<?= $items['items'][0]['promo']['price'] ?><?php if ($items['items'][0]['promo']['coin'] != 0) { ?> +<?= $items['items'][0]['promo']['coin'] ?>星币 <?php } ?></p>
	 				<?php } else { ?>
	 				<!-- <p class="piece">￥<?= $items['items'][0]['promo']['price'] ?>+<?= $items['items'][0]['promo']['coin'] ?>星币</p>  -->
	 				<p class="piece">￥<?= $items['items'][0]['promo']['price'] ?><?php if ($items['items'][0]['promo']['coin'] != 0) { ?> +<?= $items['items'][0]['promo']['coin'] ?>星币 <?php } ?></p>
	 				<?php } ?>
	 			</div>
	 		</div>
	 		<?php } ?>
		<?php } else { ?>
			<img src="/public/img/huilife/no_goods.png" alt="" style="margin:0 auto;width:60%">
	 	<?php } ?>
 	<?php } ?>
 	</div>
</div>
<script>
	var categoryjson = <?= $categoryjson ?>;
	var parms = <?= $parms ?>;
</script>
</body>
</html>
<script src="/public/ext/js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="/public/ext/js/swiper.min.js"></script>
<script src="/public/js/jquery.base64.js"></script>
<script src="/public/js/second/secondindex.js"></script>