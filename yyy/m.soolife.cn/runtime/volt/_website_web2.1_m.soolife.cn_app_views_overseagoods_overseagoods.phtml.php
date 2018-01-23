<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>如此生活|海外精品</title>
	<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=0">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<link rel="stylesheet" type="text/css" href="/public/ext/css/soo.m.ui.css"/>
	<link rel="stylesheet" type="text/css" href="/public/css/overseagoods/overseagoods.css"/>
	<link rel="stylesheet" href="/public/ext/css/swiper.css">
	<script src="/public/js/rem2.js"></script>
</head>
<body>
<div id="oversea" data-itemurl="<?= $url_goods ?>">
	<!-- 头部 -->
	<div id="head">
		<div id="head-left" onclick="window.history.go(-1)"><img src="/public/img/newcategory/Group22Copy2.png" alt=""></div>
		<div id="head-right" > </div>
		<div id="head-center" class="between">海外精品</div>
	</div>
	
	<div id="top_place"></div>
	<!-- 轮播 -->
	<?php if ($adv['carouselbanner']) { ?>
	<div class="swiper-container margin-b">
		<div class="swiper-wrapper">
			<?php foreach ($adv['carouselbanner'] as $item) { ?>
			<div class="swiper-slide">
					<img  class="open-advs" <?php if ($item['mobile_link'] != 'http://') { ?> data-adv-href="<?= $item['mobile_link'] ?>" <?php } ?> src="<?= $item['picture'] ?>">
			</div>
			<?php } ?>

		</div>
		<!-- 分页效果 -->
		<div class="pagination"></div>
	</div>
	<?php } ?>
	<?php if ($overseaindex) { ?>
	<?php if (isset($overseaindex['today']) && !empty($overseaindex['today']) || isset($overseaindex['tomorrow']) && !empty($overseaindex['tomorrow'])):?>
	    
	    <div class="title bg-white">限时折扣</div>
		
		<?php if (isset($overseaindex['today']) && isset($overseaindex['tomorrow']) && !empty($overseaindex['today']) && !empty($overseaindex['tomorrow'])):?>
			<div class="titlebtn clear-f bg-white">
				<div class="item active float-l" id="tobtn">今日</div>
				<div class="item float-l" id="tmwbtn">明日</div>
			</div>
		<?php else: ?>
			<div class="titlebtn clear-f bg-white">
				<?php if ($overseaindex['today']) { ?>
				<div class="item active float-l only_item" id="tobtn">今日</div>
				<?php } ?>
				<?php if ($overseaindex['tomorrow']) { ?>
				<div class="item active float-l only_item" id="tmwbtn">明日</div>
				<?php } ?>
			</div>
		<?php endif ?>
	<?php endif ?>
	<?php } ?>



	<?php if ($overseaindex) { ?>
		<?php if (isset($overseaindex['today']) && isset($overseaindex['tomorrow']) && !empty($overseaindex['today']) && !empty($overseaindex['tomorrow'])): ?>

			<div id="main1" class="main bg-white">
				<div class="titlep" id="todytime">
					<input type="hidden" class="stamp" name="" data-index="0" value="<?= $overseaindex['today']['end_date'] ?>"  />
					<span>距离结束还有  </span>
					<span class="timestamp0"></span>
				</div>
				<div class="slide-stage">
				<?php foreach ($overseaindex['today']['details'] as $item) { ?>
					<div class="item">
						<a href="<?= $url_goods ?>/<?= $item['sku_id'] ?>.html">
						<a class="open-goods-detail" data-goods-id="<?= $item['sku_id'] ?>">
							<div class="imgbox"><img src="<?= $item['good_logo'] ?>" alt=""></div>
						</a>
						<p class="name"><?= $item['good_name'] ?></p>
						<p class="nowpiece">¥<?= $item['act_price'] ?></p>
						<p class="oldpiece">¥<?= $item['shop_price'] ?></p>
					</div>
				<?php } ?>
				</div>
				<a href="/overseagoods/today.html?type=1"><p class="titlep">查看更多</p></a>
			</div>
			<div id="main2" class="main bg-white" style="display:none">
				<p class="titlep col">即将开启 敬请期待</p>
				<div class="slide-stage">
				<?php foreach ($overseaindex['tomorrow']['details'] as $item) { ?>
					<div class="item">
						<a class="open-goods-detail" data-goods-id="<?= $item['sku_id'] ?>">
							<div class="imgbox"><img src="<?= $item['good_logo'] ?>" alt=""></div>
						</a>
						<p class="name"><?= $item['good_name'] ?></p>
						<p class="nowpiece">¥<?= $item['act_price'] ?></p>
						<p class="oldpiece">¥<?= $item['shop_price'] ?></p>
					</div>
				<?php } ?>
				</div>
				<a href="/overseagoods/tomorrow.html?type=2"><p class="titlep">查看更多</p></a>
			</div>

		<?php else: ?>

			<?php if ($overseaindex['today']) { ?>
			<div id="main1" class="main bg-white">
				<div class="titlep" id="todytime">
					<input type="hidden" class="stamp" name="" data-index="0" value="<?= $overseaindex['today']['end_date'] ?>"  />
					<span>距离结束还有  </span>
					<span class="timestamp0"></span>
				</div>
				<div class="slide-stage">
				<?php foreach ($overseaindex['today']['details'] as $item) { ?>
					<div class="item">
						<a href="<?= $url_goods ?>/<?= $item['sku_id'] ?>.html">
						<a class="open-goods-detail" data-goods-id="<?= $item['sku_id'] ?>">
							<div class="imgbox"><img src="<?= $item['good_logo'] ?>" alt=""></div>
						</a>
						<p class="name"><?= $item['good_name'] ?></p>
						<p class="nowpiece">¥<?= $item['act_price'] ?></p>
						<p class="oldpiece">¥<?= $item['shop_price'] ?></p>
					</div>
				<?php } ?>
				</div>
				<a href="/overseagoods/today.html?type=1"><p class="titlep">查看更多</p></a>
			</div>
			<?php } ?>
			<?php if ($overseaindex['tomorrow']) { ?>
			<div id="main2" class="main bg-white">
				<p class="titlep col">即将开启 敬请期待</p>
				<div class="slide-stage">
				<?php foreach ($overseaindex['tomorrow']['details'] as $item) { ?>
					<div class="item">
						<a class="open-goods-detail" data-goods-id="<?= $item['sku_id'] ?>">
							<div class="imgbox"><img src="<?= $item['good_logo'] ?>" alt=""></div>
						</a>
						<p class="name"><?= $item['good_name'] ?></p>
						<p class="nowpiece">¥<?= $item['act_price'] ?></p>
						<p class="oldpiece">¥<?= $item['shop_price'] ?></p>
					</div>
				<?php } ?>
				</div>
				<a href="/overseagoods/tomorrow.html?type=2"><p class="titlep">查看更多</p></a>
			</div>
			<?php } ?>

		<?php endif ?>
	<?php } ?>







	<div class="advs clear-f margin-b">
		<?php if ($adv['leftcolumn']) { ?>
		<div class="item float-l">
			<a  class="open-advs" <?php if ($adv['leftcolumn'][0]['mobile_link'] != 'http://') { ?> data-adv-href="<?= $adv['leftcolumn'][0]['mobile_link'] ?>" <?php } ?> >
			<img src="<?= $adv['leftcolumn'][0]['picture'] ?>" alt="">
			</a>
		</div>
		<?php } ?>
		<?php if ($adv['rightcolumn']) { ?>
		<div class="item float-l">
			<a class="open-advs" <?php if ($adv['rightcolumn'][0]['mobile_link'] != 'http://') { ?>   data-adv-href="<?= $adv['rightcolumn'][0]['mobile_link'] ?>" <?php } ?>>
			<img src="<?= $adv['rightcolumn'][0]['picture'] ?>" alt="">
			</a>
		</div>
		<?php } ?>
	</div>
	<!-- 品牌特惠 -->
	<?php if ($adv['si']) { ?>
	<?php foreach ($adv['si'] as $item) { ?>
	<div class="brandadv margin-b bg-white">
		<?php if ($item['banner']) { ?>
		<div class="banner"><a class="open-advs" <?php if ($item['banner']['mobile_link'] != 'http://') { ?>  data-adv-href="<?= $item['banner']['mobile_link'] ?>" <?php } ?>><img src="<?= $item['banner']['picture'] ?>"></a></div>
		<?php } ?>
		<div class="brandadvitem slide-stage">
			<?php if ($item['lslide']) { ?>
			<div class="item">
				<a class="open-advs" <?php if ($item['lslide']['mobile_link'] != 'http://') { ?>  data-adv-href="<?= $item['lslide']['mobile_link'] ?>" <?php } ?>><img src="<?= $item['lslide']['picture'] ?>" alt=""></a>
			</div>
			<?php } ?>
			<?php if ($item['mslide']) { ?>
			<div class="item">
				<a class="open-advs" <?php if ($item['mslide']['mobile_link'] != 'http://') { ?> data-adv-href="<?= $item['mslide']['mobile_link'] ?>" <?php } ?>><img src="<?= $item['mslide']['picture'] ?>" alt=""></a>
			</div>
			<?php } ?>
			<?php if ($item['rslide']) { ?>
			<div class="item">
				<a class="open-advs" <?php if ($item['rslide']['mobile_link'] != 'http://') { ?> data-adv-href="<?= $item['rslide']['mobile_link'] ?>" <?php } ?>><img src="<?= $item['rslide']['picture'] ?>" alt=""></a>
			</div>
			<?php } ?>
		</div>
	</div>
	<?php } ?>
	<?php } ?>
	<!-- 全球热卖 -->
	<div class="recommend">
		<div class="rtitle"><span>全球热卖</span></div>
	</div>
	<div class="inlinestyle">
		<?php if ($hot) { ?>
	    <input type="hidden" id="hidden" value="<?= $hot['index'] ?>" name="" />
 		<?php foreach ($hot['goods'] as $item) { ?>
 		<a class="open-goods-detail" data-goods-id="<?= $item['sku_id'] ?>">
	 		<div class="item bg-white margin-b">
	 			<div class="img_box float-l">
	 				<!-- <a href="<?= $url_goods ?>/<?= $item['sku_id'] ?>.html"> -->
	 					<img src="<?= $item['logo'] ?>">
	 				<!-- <p class="tag">海外精品</p>   -->
	 			</div>
	 			<div class="wen_box float-l">
	 				<p class="name"><?= $item['name'] ?></p>
	 				 <!-- <p class="smalltag"><span>海外精品</span></p>  -->
	 				<!-- <p class="sales">销量:132</p> -->
	 				<p class="piece">￥<?= $item['shop_price'] ?></p>
	 			</div>
	 		</div>
 		</a>
 		<?php } ?>
		<?php } ?>
 	</div>
 	<p id="hidden" style="text-align:center;width: 100%;float: left;">没有更多商品了...</p>
</div>

</body>
</html>
<script type="text/javascript"  src="/public/ext/js/jquery-1.8.3.min.js"></script>
<script type="text/javascript"  src="/public/js/overseagoods/header.js"></script>
<script type="text/javascript" src="/public/ext/js/swiper.min.js"></script>
<script type="text/javascript"  src="/public/js/overseagoods/overseagoods.js"></script>
<script type="text/javascript" src="/public/js/sdk.2.2.js"></script>