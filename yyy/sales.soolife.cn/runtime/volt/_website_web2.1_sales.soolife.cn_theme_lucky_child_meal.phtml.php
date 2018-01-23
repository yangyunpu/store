<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<link rel="stylesheet" type="text/css" href="/public/mobile/css/lucky/child_meal.css">
	<title>子套餐详情</title>
</head>
<body>
	<div class="wrap">
		<!-- 头部 -->
	<!-- 	<div class="header">
			<span>
				<a onclick="history.go(-1)">
					<img src="/public/mobile/img/lucky/starh.png" class="lefter">
				</a>
			</span>
			<span class="lj_srt">套餐一</span> -->
				<!-- <a href="#"><img src="/public/mobile/img/lucky/stari.png" class="share">
			</a> -->
		<!-- </div> -->
		<div class="lj_set">
			<!-- 主图价格 -->
			<div class="lj_master">
				<div class="mas"><img src="<?= $data['promo']['img'] ?>"></div>
				<div class="mas_right">
					<p class="lj_title"><a href="#"><span><?= $data['promo']['S_Name'] ?></span> </a></p>
					<p class="rice"><span class="ruling_price">￥<?= $data['promo']['price'] ?></span> <span class="original_price">￥<?= $data['promo']['shop_price'] ?></span></p>
					<div class="title_foot">
						<p class="lj_repertory">
						库存：<span><?= $data['promo']['num'] ?>件</span>
						</p>
					</div>
				</div>
			</div>
		</div>
		<?php foreach ($data['details'] as $i) { ?>
		<div class="lj_sets">
			<div class="lj_master">
				<div class="mas"><img class="open-goods-detail" data-goods-id="<?= $i['G_SkuID'] ?>" src="<?= $i['S_Logo'] ?>"></div>
				<div class="mas_right">
					<p class="lj_title"><a href="#"><span><?= $i['S_Name'] ?></span> </a></p>
					<p class="rice"><span class="ruling_price">￥<?= $i['G_ActPrice'] ?></span> <span class="original_price">￥<?= $i['S_ShopPrice'] ?></span></p>
				</div>
			</div>
			<!-- 尺码展示 -->
			<!-- <div class="lj_subplot">
				<?php foreach ($i['specs'] as $d) { ?>
				<p class="lj_size"><?= $d['name'] ?></p>
				<div class="size_modl">
					<ul>
					<?php foreach ($d['value'] as $v) { ?>
						<?php if ($v['status'] == 1) { ?>
						<li class="lj_m"><?= $v['vv'] ?></li>
						<?php } else { ?>
						<li><?= $v['vv'] ?></li>
						<?php } ?>
					<?php } ?>
					</ul>
				</div>
				<?php } ?>
			</div> -->
		</div>
		<?php } ?>
		</div>
		<div class="lj_setd">
				<!-- <p class="lj_num">数量</p> -->
				<!-- <p class="lj_subs">1</p> -->
			<!-- <div class="lj_add"> -->
			    <!-- <span class="jian"><strong><img src="/public/mobile/img/lucky/-@2x.png"></strong></span> -->
				<!-- <input type="text" value="1" name="" class="num"> -->
				<!-- <span class="adds"><strong><img src="/public/mobile/img/lucky/+@2x.png"></strong></span> -->
			<!-- </div> -->
			<div class="lj_join">
			<p>每多购买一次套餐,就能多获得一个抽奖号码,</p>
			<p>次数越多,获得的抽奖号码越多</p>
			</div>
		</div>
		<?php if ($data['promo']['status'] == 0) { ?>
			<div class="lj_sale">即将开售</div>
		<?php } elseif ($data['promo']['status'] == 1) { ?>
			<div class="lj_sale">已售罄</div>
		<?php } else { ?>
			<div class="lj_shoping open-instant-buy" data-goods-id="<?= $data['promo']['Goods_ID'] ?>">立即购买</div>
		<?php } ?>
	</div>
</body>
<script type="text/javascript" src="/public/mobile/js/lucky/rem.js"></script>
<script src="/public/mobile/js/lucky/sdk.2.2.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" src="/public/mobile/js/lucky/jquery.-1.8.3.min.js"></script>
<script type="text/javascript" src="/public/mobile/js/lucky/child_meal.js"></script>
</html>