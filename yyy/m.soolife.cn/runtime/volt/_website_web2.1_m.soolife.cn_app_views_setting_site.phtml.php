<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>如此生活|收货地址</title>
	<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<link rel="stylesheet" type="text/css" href="/public/css/setting/site.css"/>
</head>
<body>
	<div class="wrap">
		<div class="header" id="header">
			<span onclick="window.history.go(-1)">
				<img src="/public/img/brandhui/xingxingsha_back@2x.png " class="lefter">
			</span>
			<span class="lj_srt">收货地址</span>
		</div>
		<div class="void"></div>
		<?php if ($result) { ?>
		<?php foreach ($result as $d) { ?>
		<div class="address">
			<p class="pessage">
				<span class="name"><?= $d['consignee'] ?></span>
				<span class="iphone"><?= $d['mobile'] ?></span>
			</p>
			<div class="ad_content">
				<p class="adds"> <?= $d['region_text'] ?><?= $d['address'] ?> </p>
			 	<div class="arrows"><img src="/public/img/setting/mine_xiayiye@2x.png"></div>
			</div>

			<div class="foot">
				<div class="approve">
				<?php if ($d['default_address'] == 1) { ?>
					<img class="no_sle" src="/public/img/setting/Group 21@2x.png" data-value="<?= $d['id'] ?>">
				<?php } else { ?>
					<img class="no_sle" src="/public/img/setting/Rectangle 5 Copy@2x.png" data-value="<?= $d['id'] ?>">
				<?php } ?>
				</div>
				<span class="mosure">默认地址</span>
				<span class="compile"><a href="/setting/remaddres/<?= $d['id'] ?>.html">编辑</a></span>
				<span class="select" data-value="<?= $d['id'] ?>"> 删除 </span>
			</div>
		</div>
		<?php } ?>
		<?php } ?>
	</div>
	<div class="footer"></div>
	<a href="/setting/speaddres.html"><div class="addsite">新增收货地址</div></a>
	<div id="alert_mark"></div>
</body>
<script src="/public/js/rem.js"></script>
<script src="/public/ext/js/jquery-1.8.3.min.js"></script>
<script src="/public/js/setting/site.js"></script>
</html>