<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>如此生活|星主题</title>
	<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	
	<link rel="stylesheet" type="text/css" href="/public/ext/css/soo.m.ui.css"/>
	<link rel="stylesheet" href="/public/ext/css/download.css">
	<link rel="stylesheet" type="text/css" href="/public/css/startheme/themechild.css"/>
</head>
<body>
	<div class="wrap">
		<div class="header" id="header">
			<span onclick="window.history.go(-1)">
				<img src="/public/img/startheme/xingfaner_back@1x.png " class="lefter">
			</span>
			<!-- <span class="share">
				<img src="/public/img/startheme/xingxingsha_share@2x.png">
			</span> -->
		</div>
		<div class="void" id="void"></div>
		<!-- 下载框 -->
		<div class="download_box" id="download-nav">
			<div class="remove" id="download-nav-hide"><img src="/public/img/common/icon_close@3x.png" alt=""></div>
			<div class="logo"><img src="/public/img/common/logo@3x.png" alt=""></div>
			<div class="word">下载如此生活客户端</div>
			<div class="sure" id="download-nav-sure"><div>下载</div></div>
		</div>
		<?php if ($child) { ?>
		<?php if ($child['sname']) { ?>
		<div class="title"><?= $child['sname'] ?></div>
		<?php } ?>
		<div class="look">
			<span class="eyes">
				<img src="/public/img/startheme/eye.png">
			</span>
			<?php if ($child['spageviews']) { ?>
			<span class="num"><?= $child['spageviews'] ?></span>
			<?php } ?>
		</div>
		<div class="banner">
			<?php if ($child['sbanner']) { ?>
			<img src="<?= $child['sbanner'] ?>">
			<?php } ?>
		</div>
		
		<!-- <div class="artice">
			以前对MK的包包没什么大感觉，周末去奕欧来逛逛突然看到这款MK的小猪包，颜色是大象灰的特别好搭，打折下来只要2000出头一点，美美的奕欧来和甜甜的画糖😊美滋滋😊…...啦啦啦啦啦啦啦啦
		</div> -->
		<?php if ($child['starthemestory']) { ?>
		<?php foreach ($child['starthemestory'] as $d) { ?>
			<div class="story">
				<?= $d['sskustory'] ?>
			</div>
			
			<?php foreach ($d['sstarthemesku_dels'] as $c) { ?>
			 <!-- 星主题子页 -->
				<div class="explain2">
					<div class="shops2">
						<img class="open-goods-detail" data-goods-id="<?= $c['skuid'] ?>" src="<?= $c['showimg'] ?>">
					</div>
					<div class="shops3">
						<p class="open-goods-detail" data-goods-id="<?= $c['skuid'] ?>" ><?= $c['sname'] ?></p>
						<div class="price2">￥<?= $c['sprice'] ?></div>
						<div class="shops4 open-instant-buy" data-goods-id="<?= $c['skuid'] ?>" >立即购买</div>
					</div>
				</div>
			<?php } ?>
		<?php } ?>
		<?php } ?>
		<?php } ?>
		<!-- 推荐 -->
		<div class="guess">
			<div class="like"><span>推荐</span></div>
		</div>

		<div class="lj_like">
           <ul>
            <?php foreach ($datalike as $d) { ?>
	           	<li class="items open-goods-detail" data-goods-id="<?= $d['sku_id'] ?>">  
						<div class="imgs">
							<img src="<?= $d['logo'] ?>">
						</div>
						<div class="words">
							<p><?= $d['sku_name'] ?></p>
							<p>￥<?= $d['act_price'] ?></p>
						</div> 
	           	</li>
	           	<?php } ?>
           </ul>
	</div>
		
	</div>
</body>
</html>
<script>
		var isApp = /SoolifeApp/i.test(navigator.userAgent);
		if(isApp){
			document.getElementById('header').style.display = "none";
			document.getElementById('void').style.display = "none";
			document.getElementById('download-nav').style.display = "none";
		};
</script>
<script src="/public/js/rem.js"></script> 
<script src="/public/ext/js/jquery-1.8.3.min.js"></script>
<script src="/public/ext/js/download.js"></script>
<script src="/public/ext/js/soo.m.ui.js"></script>
<script src="/public/js/jquery.base64.js"></script>
<script src="/public/js/sdk.2.2.js"></script>
