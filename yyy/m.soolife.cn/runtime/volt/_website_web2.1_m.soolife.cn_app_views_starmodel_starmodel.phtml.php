<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>如此生活|星范儿</title>
	<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	
	<link rel="stylesheet" type="text/css" href="/public/ext/css/soo.m.ui.css"/>
	<link rel="stylesheet" href="/public/ext/css/download.css">
	<link rel="stylesheet" type="text/css" href="/public/css/starmodel/starmodel.css"/>
</head>
<body>
	<div class="wrap">
		<div class="header">
			<span onclick="window.history.go(-1)">
				<img src="../public/img/starmodel/Group 22 Copy 2@1x.png " class="lefter">
			</span>
			<span class="lj_srt">星范儿</span> 
			<!-- <span class="message">
				<img src="../public/img/starmodel/Group 7.png">
			</span>
			<span class="scan">
				<img src="../public/img/starmodel/Group.png ">
			</span> -->
		</div>
		<div class="void"></div>
		<!-- 下载框 -->
	<!-- 	<div class="download_box" id="download-nav">
			<div class="remove" id="download-nav-hide">
				<img src="../public/img/common/icon_close@3x.png" alt="">
			</div>
			<div class="logo">
				<img src="../public/img/common/logo@3x.png" alt="">
			</div>
			<div class="word">下载如此生活客户端</div>
			<div class="sure" id="download-nav-sure"><div>下载</div></div>
		</div> -->
		<div class="lj_banner">
			<?php if ($data['app.starfans.index']['children']['app.starfans.index.banner']['items']) { ?>
			<img class="open-advs" <?php if ($data['app.starfans.index']['children']['app.starfans.index.banner']['items']['0']['mobile_link'] != 'http://') { ?> data-adv-href="<?= $data['app.starfans.index']['children']['app.starfans.index.banner']['items']['0']['mobile_link'] ?>" <?php } ?>  src="<?= $data['app.starfans.index']['children']['app.starfans.index.banner']['items']['0']['picture'] ?>">
			<?php } ?>
		</div>
		<!-- 产品分类 -->
		<div class="navigation">
			<ul> 
				<?php if ($data['app.starfans.index']['children']['app.starfans.index.category01']['items']) { ?>
				<li  class="open-advs" <?php if ($data['app.starfans.index']['children']['app.starfans.index.category01']['items']['0']['mobile_link'] != 'http://') { ?> data-adv-href="<?= $data['app.starfans.index']['children']['app.starfans.index.category01']['items']['0']['mobile_link'] ?>" <?php } ?>>
					<img src="<?= $data['app.starfans.index']['children']['app.starfans.index.category01']['items']['0']['picture'] ?>">
					<p>香水彩妆</p>
				</li>
				<?php } ?>
				<?php if ($data['app.starfans.index']['children']['app.starfans.index.category02']['items']) { ?>
				<li class="open-advs" <?php if ($data['app.starfans.index']['children']['app.starfans.index.category02']['items']['0']['mobile_link'] != 'http://') { ?> data-adv-href="<?= $data['app.starfans.index']['children']['app.starfans.index.category02']['items']['0']['mobile_link'] ?>" <?php } ?>> 
					<img src="<?= $data['app.starfans.index']['children']['app.starfans.index.category02']['items']['0']['picture'] ?>">
					<p >精品男装</p> 
				</li>
				<?php } ?>
				<?php if ($data['app.starfans.index']['children']['app.starfans.index.category03']['items']) { ?>
				<li class="open-advs" <?php if ($data['app.starfans.index']['children']['app.starfans.index.category03']['items']['0']['mobile_link'] != 'http://') { ?> data-adv-href="<?= $data['app.starfans.index']['children']['app.starfans.index.category03']['items']['0']['mobile_link'] ?>" <?php } ?>>
					<img src="<?= $data['app.starfans.index']['children']['app.starfans.index.category03']['items']['0']['picture'] ?>">
					<p>珠宝首饰</p>
				</li>
				<?php } ?>
				<?php if ($data['app.starfans.index']['children']['app.starfans.index.category04']['items']) { ?>
				<li class="open-advs" <?php if ($data['app.starfans.index']['children']['app.starfans.index.category04']['items']['0']['mobile_link'] != 'http://') { ?> data-adv-href="<?= $data['app.starfans.index']['children']['app.starfans.index.category04']['items']['0']['mobile_link'] ?>" <?php } ?>>
					<img src="<?= $data['app.starfans.index']['children']['app.starfans.index.category04']['items']['0']['picture'] ?>">
					<p>时尚箱包</p>
				</li>
				<?php } ?>
				<?php if ($data['app.starfans.index']['children']['app.starfans.index.category05']['items']) { ?>
				<li class="open-advs" <?php if ($data['app.starfans.index']['children']['app.starfans.index.category05']['items']['0']['mobile_link'] != 'http://') { ?> data-adv-href="<?= $data['app.starfans.index']['children']['app.starfans.index.category05']['items']['0']['mobile_link'] ?>" <?php } ?>>
					<img src="<?= $data['app.starfans.index']['children']['app.starfans.index.category05']['items']['0']['picture'] ?>">
					<p>精品鞋靴</p>
				</li>
				<?php } ?>
				<?php if ($data['app.starfans.index']['children']['app.starfans.index.category06']['items']) { ?>
				<li class="open-advs" <?php if ($data['app.starfans.index']['children']['app.starfans.index.category06']['items']['0']['mobile_link'] != 'http://') { ?> data-adv-href="<?= $data['app.starfans.index']['children']['app.starfans.index.category06']['items']['0']['mobile_link'] ?>" <?php } ?>>
					<img src="<?= $data['app.starfans.index']['children']['app.starfans.index.category06']['items']['0']['picture'] ?>">
					<p>炫酷运动</p>
				</li>
				<?php } ?>
				<?php if ($data['app.starfans.index']['children']['app.starfans.index.category07']['items']) { ?>
				<li class="open-advs" <?php if ($data['app.starfans.index']['children']['app.starfans.index.category07']['items']['0']['mobile_link'] != 'http://') { ?> data-adv-href="<?= $data['app.starfans.index']['children']['app.starfans.index.category07']['items']['0']['mobile_link'] ?>" <?php } ?>>
					<img src="<?= $data['app.starfans.index']['children']['app.starfans.index.category07']['items']['0']['picture'] ?>">
					<p>百搭配饰</p>
				</li>
				<?php } ?>
				<?php if ($data['app.starfans.index']['children']['app.starfans.index.category08']['items']) { ?>
				<li class="open-advs" <?php if ($data['app.starfans.index']['children']['app.starfans.index.category08']['items']['0']['mobile_link'] != 'http://') { ?> data-adv-href="<?= $data['app.starfans.index']['children']['app.starfans.index.category08']['items']['0']['mobile_link'] ?>" <?php } ?>>
					<img src="<?= $data['app.starfans.index']['children']['app.starfans.index.category08']['items']['0']['picture'] ?>">
					<p>浪漫女装</p>
				</li>
				<?php } ?>
				<?php if ($data['app.starfans.index']['children']['app.starfans.index.category09']['items']) { ?>
				<li class="open-advs" <?php if ($data['app.starfans.index']['children']['app.starfans.index.category09']['items']['0']['mobile_link'] != 'http://') { ?> data-adv-href="<?= $data['app.starfans.index']['children']['app.starfans.index.category09']['items']['0']['mobile_link'] ?>" <?php } ?>>
					<img src="<?= $data['app.starfans.index']['children']['app.starfans.index.category09']['items']['0']['picture'] ?>">
					<p>丽人美妆</p>
				</li>
				<?php } ?>
				<?php if ($data['app.starfans.index']['children']['app.starfans.index.category10']['items']) { ?>
				<li class="open-advs" <?php if ($data['app.starfans.index']['children']['app.starfans.index.category10']['items']['0']['mobile_link'] != 'http://') { ?> data-adv-href="<?= $data['app.starfans.index']['children']['app.starfans.index.category10']['items']['0']['mobile_link'] ?>" <?php } ?>>
					<img src="<?= $data['app.starfans.index']['children']['app.starfans.index.category10']['items']['0']['picture'] ?>">
					<p>原创新品</p>
				</li>
				<?php } ?>
			</ul>
		</div>
		<div class="fansbanner">
			<ul>

				<?php if ($data['app.starfans.index']['children']['app.starfans.index.downleft']['items']) { ?>
				<li class="open-advs" <?php if ($data['app.starfans.index']['children']['app.starfans.index.downleft']['items']['0']['mobile_link'] != 'http://') { ?> data-adv-href="<?= $data['app.starfans.index']['children']['app.starfans.index.downleft']['items']['0']['mobile_link'] ?>" <?php } ?>>
					<img src="<?= $data['app.starfans.index']['children']['app.starfans.index.downleft']['items']['0']['picture'] ?>" alt="">
				</li>
				<?php } ?>
				<?php if ($data['app.starfans.index']['children']['app.starfans.index.downright']['items']) { ?>
				<li class="open-advs" <?php if ($data['app.starfans.index']['children']['app.starfans.index.downright']['items']['0']['mobile_link'] != 'http://') { ?> data-adv-href="<?= $data['app.starfans.index']['children']['app.starfans.index.downright']['items']['0']['mobile_link'] ?>" <?php } ?>>
					<img src="<?= $data['app.starfans.index']['children']['app.starfans.index.downright']['items']['0']['picture'] ?>" alt="">
				</li>
				<?php } ?>

			</ul>
		</div>
		<!-- 我最搭 -->
		<div class="guess">
			<div class="like"><span>我最搭</span></div>
		</div>
		<?php if ($star) { ?>
		<?php foreach ($star as $i => $d) { ?>
		<div class="content">
			<div class="lj_ban">
				<img src="<?= $d['sbanner'] ?>" class="open-new-web" data-new-web-url="<?= $url_m ?>/startheme/themechild/<?= $d['starthemeid'] ?>.html" >
				<div id="triangle-up"></div>
			</div>
			<div class="lj_sale">
				<ul>
				<?php foreach ($d['sstarthemesku_dels'] as $c) { ?>
					<li>
						<img src="<?= $c['showimg'] ?>" class="open-goods-detail" data-goods-id="<?= $c['skuid'] ?>">
						<p>￥<?= $c['sprice'] ?></p>
					</li> 
				<?php } ?>
				</ul>
			</div>
		</div> 
		<?php if(count($star) >= 2 && $i==1) break;?> 
		<?php } ?>
		<?php } ?>
		<div class="guess2">
			<div class="like2"><span>时尚弄潮儿</span></div>
		</div>

		<?php if ($clothcode) { ?>
		<div class="styles">
			<ul>
				<?php foreach ($clothcode as $d) { ?>
				<li><?= $d['name'] ?> <input type="hidden" class="code" value="<?= $d['code'] ?>"></li>
				<?php } ?>
			</ul>
		</div>
		<?php } ?>

		<input type="hidden" id="hidden" value="" />
		<?php if ($cloth) { ?>
		<?php if ($cloth['items']) { ?>
		<div class="fg_h">
		<input type="hidden" id="skip" value="<?= $cloth['skip'] ?>" />
			<?php foreach ($cloth['items'] as $d) { ?>
			<div class="code open-goods-detail" data-goods-id="<?= $d['id'] ?>" >
				<div class="code_img">
					<img src="<?= $d['logo'] ?>">
				</div>
				<div class="code_title">
					<p><?= $d['name'] ?></p>
					<div class="voids"></div>
					<div class="pricsd">
						<span class="ruling">￥<?= $d['price'] ?></span><span class="original">￥<?= $d['market_price'] ?></span>
						<!-- <span class="amount">销量:80</span> -->
					</div>
				</div>
			</div>
			<?php } ?>
		</div>
	    <?php } else { ?>
	    <div class="fg_h">
	        <!-- <img class='no_data' src='/public/img/starmodel/zanwushuju.png'> -->
	    </div>
	    <?php } ?>
	    <?php } ?>
	    <p id="none" style="text-align:center;display:none;">没有更多商品了...</p>
	</div>

</body>
</html>
<script type="text/javascript">
	var isApp = /SoolifeApp/i.test(navigator.userAgent);
	if(isApp){
		document.getElementById('header').style.display = "none";
		document.getElementById('void').style.display = "none";
		document.getElementById('download-nav').style.display = "none";
	};
</script>
<script type="text/javascript" src="/public/js/rem.js"></script> 
<script type="text/javascript" src="/public/ext/js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="/public/ext/js/download.js"></script>
<script type="text/javascript" src="/public/js/jquery.base64.js"></script>
<script type="text/javascript" src="/public/js/sdk.2.2.js"></script>
<script type="text/javascript" src="/public/js/starmodel/starmodel.js"></script>