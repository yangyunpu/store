<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<link rel="stylesheet" type="text/css" href="/public/mobile/css/lucky/star_home.css">
	<title>进行中</title>
</head>
<body>
	<div class="wrap">
		<!-- 头部 -->
		<!-- <div class="header">
			<span><a onclick="history.go(-1)"><img src="/public/mobile/img/lucky/starh.png " class="lefter" onclick="history.go(-1)"></a></span><span class="lj_srt">星集结</span> --> <!-- <a href="#"><img src="/public/mobile/img/lucky/stari.png" class="share"></a> -->
	<!-- 	</div> -->
		<!-- 倒计时 -->
		<div class="lj_count">
			<div class="lj_bg">
				<?php if ($pic) { ?>
					<img src="<?= $pic ?>">
				<?php } else { ?>
					<img src="/public/mobile/img/lucky/starbg.png">
				<?php } ?>
			</div>
			<div class="lj_wen">
				<p class="lj_rule">规则</p>
				<?php if ($t != -3) { ?>
			  	  <div style="display: none;" id="hide_time"><?= $t ?></div>
			  	<?php } ?>
				<p class="lj_time">倒计时</p>
				<p class="lj_residue">还剩 <span class="lj_num"><?= $data['lucky']['S_Surplus'] ?></span> 位即可开奖</p>
				<p class="lj_shop">购买任意套餐可获得抽奖机会一次</p>
				<div class="lj_iphone">
					<ul>
					<?php foreach ($data['package_record'] as $i) { ?>
						<li><span><?= $i['S_BuyersPhone'] ?></span> &nbsp;<span><?= $i['mistiming'] ?></span>前购买了<span><?= $i['S_SuitName'] ?>套餐</span></li>
					<?php } ?>
					</ul>
				</div>
			</div>

		</div>
		<!-- 奖项布置 -->
		<div class="lj_awards">
			<?php foreach ($data['prize'] as $i) { ?>
			<div class="first_prize">
				<img src="<?= $i['S_PrizePic'] ?>">
			</div>
			<?php } ?>
		</div>
		<!-- 套餐详情 -->
		<div class="lj_combo">
			<div class="lj_wid">
				<p class="left_hr"></p>
				<p class="lj_cover">幸福集结套餐</p>
				<p class="right_hr"></p>
			</div>
		</div>
		<!-- 套餐一 -->
		<?php foreach ($data['promo_detail'] as $d) { ?>
		<div class="lj_set">
			<!-- 主图价格 -->
			<div class="lj_master">
				<div class="mas"><a href="/m/lucky/promo/<?= $d['data'][0]['Goods_ID'] ?>/<?= $data['lucky']['S_LuckyID'] ?>.html"><img src="<?= $d['img'] ?>"></a></div>
				<div class="mas_right">
					<p class="lj_title"><a href="/m/lucky/promo/<?= $d['data'][0]['Goods_ID'] ?>/<?= $data['lucky']['S_LuckyID'] ?>.html"><span><?= $d['data'][0]['G_SuiteName'] ?></span></a></p>
					<p class="rice"><span class="ruling_price">￥<?= $d['act_price'] ?></span>&nbsp;<span class="original_price">￥<?= $d['market_Price'] ?></span></p>
					<div class="title_foot">
						<p class="lj_repertory">库存：<span><?= $d['data'][0]['surplus'] ?>件</span></p>
						<?php if ($d['data'][0]['status'] == 1) { ?>
						<p class="title_btn"><a href="#">已售罄</a></p>
						<?php } else { ?>
						<p class="title_btnred open-instant-buy" data-goods-id="<?= $d['data'][0]['Goods_ID'] ?>">立即抢购</p>
						<?php } ?>
					</div>
				</div>
			</div>
			<!-- 子图展示 -->
			<div class="lj_subplot">
				<ul class="dotey">
				<?php foreach ($d['data'] as $v) { ?>
					<li>
						<img class="open-goods-detail" data-goods-id="<?= $v['G_SkuID'] ?>" src="<?= $v['S_Logo'] ?>">
						<p class="lj_priced">￥<?= $v['S_ShopPrice'] ?></p>
					</li>
				<?php } ?>
				</ul>
			</div>
		</div>
		<?php } ?>
		<!-- 查看往期活动 -->
		<?php if ($data['lucky']['past'] != 0) { ?>
		<div class="lj_check open-new-web" data-new-web-url="<?= $url_sales ?>/m/lucky/past/<?= $data['lucky']['past'] ?>.html"><!-- <a href="/m/lucky/past/<?= $data['lucky']['past'] ?>.html"> -->查看上期活动<!-- </a> --></div>
		<?php } ?>
	</div>
	<div class="rules">
		<div class="lj_act">
			<img src="/public/mobile/img/lucky/delet.png" class="lj_cha">
			<p class="lj_acter">活动规则</p>
			<div class="matter">
				<p class="titls">1、什么是星集结？</p>
				<p>星粉（如此生活注册会员）购买本页面中任意套餐一份，即可获得一次抽奖机会。</p>
				<p class="titls">2、什么时候开始抽奖？</p>
				<p>当购买人数达到规定数量后，系统自动开始进行抽奖，机会均等哦！</p>
				<p class="titls">3、如何增加中奖率？</p>
				<p>购买次数越多，中奖率越高哦！</p>
				<p class="titls">4、如何知道是否中奖？</p>
				<p>抽奖结果，我们将实时显示在页面上。</p>
				<p class="titls">5、中奖后，怎么领取奖品？</p>
				<p>抽奖结束后，如此生活客服将在5个工作日内，电话联系中奖的星粉（如此生活注册会员）领取奖品。</p>
				<p>特别说明：本活动为如此生活平台举办，与Apple Inc.无关。</p>
			</div>
		</div>
	</div>
</body>
<script src="/public/mobile/js/lucky/rem.js" type="text/javascript" charset="utf-8"></script>
<script src="/public/mobile/js/lucky/sdk.2.2.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" src="/public/mobile/js/lucky/jquery.-1.8.3.min.js"></script>
<script type="text/javascript" src="/public/mobile/js/lucky/star_home.js"></script>
</html>