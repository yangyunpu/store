<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>我的账单|如此生活</title>
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">   
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <link rel="stylesheet" href="/public/ext/css/soo.m.ui.css">
    <!-- <link rel="stylesheet" href="/public/css/huilife/common.css"> -->
    <!-- <link rel="stylesheet" href="/public/css/huilife/index.css"> -->
	<link rel="stylesheet" href="/public/css/me/index.css">
</head>
<body id="bill_me_cash">


<!-- 头部 -->
<div id="ba-new-header"  class="back_f7">
	<div class="header-left fl-left">
		<a onclick="window.history.go(-1)"> <img src="../public/img/common/shop_back_black@2x.png" alt=""></a>
	</div>
	<!-- <div id="header-center">领星币</div> -->
	<div class="header-center fl-left">我的账单</div>
	<div class="header-right"></div>
</div>
<div class="b_link">
	<?php if (!empty($res)) { ?>
	<?php foreach ($res as $vo) { ?>
		<div class="bar">
		<?php if ($vo['type'] == 1) { ?>
			<a href="./billdetails.html?type=<?= $vo['type'] ?>&id=<?= $vo['id'] ?>">
		<?php }elseif ($vo['type'] == 2) { ?>
			<a href="./withdrawalsdetails.html?type=<?= $vo['type'] ?>&id=<?= $vo['id'] ?>">
		<?php }else{ ?>
			<a href="./billrecharge.html?type=<?= $vo['type'] ?>&id=<?= $vo['id'] ?>">
		<?php } ?>
			<div class="tit fl-left">
				<p class="remark"><?= $vo['msg'] ?>:</p>
				<p class="time"><?= $vo['time'] ?></p>
			</div>
			<div class="go">
				<p  class="w-price"><?= $vo['money'] ?></p>
				<?php if ($vo['type'] == 2) { ?>
					<?php if ($vo['status'] == 1 || $vo['status'] == 5) { ?>
						<p class="time">提现中</p>
					<?php }elseif ($vo['status'] == 3) { ?>
						<p class="time">提现成功</p>
					<?php }else{ ?>
						<p class="time">提现失败</p>
						<?php } ?>
				<?php } ?>
			</div>
			</a>
		</div>
	<?php } ?>
	<?php } ?>
   
</div>
<?php if (count($res) >= 15): ?>
	<p class="more text_c">加载更多...</p>
<?php endif ?>

<script>

</script>

<script src="/public/ext/js/jquery-1.8.3.min.js"></script>
<script src="/public/ext/js/download.js"></script>
<script src="/public/ext/js/soo.m.ui.js"></script>
<script src="/public/ext/js/jquery.base64.js"></script>
<script src="/public/js/huilife/life.index.js"></script>
<script src="/public/ext/js/rem.js"></script>
<script src="/public/js/me/index.js"></script>
</body>
</html>