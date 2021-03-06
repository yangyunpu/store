<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<link rel="stylesheet" href="/public/mobile/css/lucky/over_star.css">
	<title>活动已结束</title>
</head>
<body>
	<div class="wrap">
		<!-- 头部 -->
		<!-- <div class="header">
			<span><a onclick="history.go(-1)"><img src="/public/mobile/img/lucky/starh.png " class="lefter"></a></span><span class="lj_srt">星集结</span> --><!--  <a href="#"><img src="/public/mobile/img/lucky/stari.png" class="share"></a> -->
		<!-- </div> -->
		<!-- 活动已结束 -->
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
				<p class="lj_time">此次活动已结束</p>
				<p class="lj_residue">敬请期待下次活动</p>
				<!-- <p class="lj_look"><a href="#xing">查看中奖名单</a></p> -->
				<p class="lj_look"><a href="/m/lucky/starold.html">查看中奖名单</a></p>
			</div>

		</div>
		<!-- 套餐详情一 -->
		<?php foreach ($data['promo_detail'] as $i) { ?>
		<div class="lj_set">
			<!-- 主图价格 -->
			<div class="lj_master">
			<div class="mas"><a href="/m/lucky/promo/<?= $i['data'][0]['Goods_ID'] ?>/<?= $data['lucky']['S_LuckyID'] ?>.html"><img src="<?= $i['img'] ?>"></a></div>
				<div class="mas_right">
					<p class="lj_title"><a href="/m/lucky/promo/<?= $i['data'][0]['Goods_ID'] ?>/<?= $data['lucky']['S_LuckyID'] ?>.html"><span><?= $i['data'][0]['G_SuiteName'] ?></span></a></p>
					<p class="rice"><span class="ruling_price">￥<?= $i['act_price'] ?></span> &nbsp;<span class="original_price">￥<?= $i['market_Price'] ?></span></p>
					<div class="title_foot">
						<p class="lj_repertory">库存：<span><?= $i['data'][0]['surplus'] ?>件</span></p>
						<p class="title_btn"><a href="#">已售罄</a></p>
					</div>
				</div>
			</div>
			<!-- 子图展示 -->
			<div class="lj_subplot">
				<ul class="dotey">
				<?php foreach ($i['data'] as $d) { ?>
					<li>
						<img class="open-goods-detail" data-goods-id="<?= $d['G_SkuID'] ?>" src="<?= $d['S_Logo'] ?>">
						<p class="lj_priced">￥<?= $d['S_ShopPrice'] ?></p>
					</li>
				<?php } ?>
				</ul>
			</div>
		</div>
		<?php } ?>
		<!-- 获奖名单公布奖项设置 -->
		<!-- <div class="lj_combo">
			<div class="lj_wid">
				<p class="left_hr"></p>
				<p class="lj_cover">
					<a name="xing">星集结<?= $data['lucky']['month'] ?>月<?= $data['lucky']['day'] ?>日获奖名单公布</a>
				</p>
				<p class="right_hr"></p>
			</div>
		</div> -->
		<!-- <div class="lj_firts">
			<img src="/public/mobile/img/lucky/starsds.png">
			<p>131****5464</p>
		</div>
		<div class="lj_firts">
			<img src="/public/mobile/img/lucky/starsde.png">
			<p><span>133****1254</span><span>155****4578</span></p>
		</div> --> 
		<!-- <?php foreach ($data['winner'] as $v) { ?>
		<div class="lj_firts">
		<div class="lj_secd">
			<img src="<?= $v['S_PrizePic'] ?>">
		</div>
			<?php if ($v['count'] == 1) { ?>
				<!-- 只有一条数据 -->
				<div class="lj_threes">
					<ul>
					<?php if ($v['S_Winners']) { ?>
					<?php foreach ($v['S_Winners'] as $h) { ?>
						<li><span><?= $h['phone'] ?></span></li>
					<?php } ?>
					<?php } ?>
					</ul>
				</div>
				<!-- 只有一条数据end -->
			<?php } else { ?>
				<div class="lj_three">
					<ul>
					<?php if ($v['S_Winners']) { ?>
					<?php foreach ($v['S_Winners'] as $h) { ?>
						<li><span><?= $h['phone'] ?></span></li>
					<?php } ?>
					<?php } ?>
					</ul>
				</div>
			<?php } ?>
		</div>
		<?php } ?>
		<!-- 查看往期活动 -->
		<?php if ($data['lucky']['status'] == 1) { ?>
			<?php if ($data['lucky']['past'] != 0) { ?>
			<div class="lj_check open-new-web" data-new-web-url="<?= $url_sales ?>/m/lucky/past/<?= $data['lucky']['past'] ?>.html"><!-- <a href="/m/lucky/past/<?= $data['lucky']['past'] ?>.html">查看上期活动<!-- </a> --></div>
			<?php } ?>
		<?php } ?>  
	</div>
	<!-- 规则遮罩 -->
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
<script type="text/javascript" src="/public/mobile/js/lucky/rem.js"></script>
<script src="/public/mobile/js/lucky/sdk.2.2.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" src="/public/mobile/js/lucky/jquery.-1.8.3.min.js"></script>
<script type="text/javascript" src="/public/mobile/js/lucky/over_star.js"></script>
</html>