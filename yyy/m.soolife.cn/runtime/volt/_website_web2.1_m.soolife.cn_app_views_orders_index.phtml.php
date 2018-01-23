<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>如此生活|会员中心</title>
	<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">	
    <link rel="stylesheet" href="/public/ext/css/soo.m.ui.css">
    <link rel="stylesheet" href="/public/ext/css/download.css">
    <link rel="stylesheet" href="/public/ext/css/swiper.css">
	<link rel="stylesheet" type="text/css" href="/public/css/orders/common.css"/>
	<link rel="stylesheet" type="text/css" href="/public/css/i/common.css"/>
	<link rel="stylesheet" type="text/css" href="/public/css/orders/mylifeallstyle.css"/
</head>
<body>

<div class="index_wrap">

	<div class="header">
	    <a onclick="window.history.go(-1)">
	        <img class="arrow"  src="/public/img/common/shop_back_black@1x.png " ></a>
		<span class="head_title">我的订单</span> 
	</div>
	<div class="main">
		<div class="navOrdersBox">
			<ul class="navOrders clearfix">
				<li class="complete <?= ($status === '' ? 'navActive' : '') ?>">
					全部
				</li>
				<li class="obligation <?= ($status === '1' ? 'navActive' : '') ?>">
					待付款
				</li>
				<li class="dropshipping <?= ($status == 3 ? 'navActive' : '') ?>">
					待收货
				</li>
				<li class="achieve <?= ($status == 4 ? 'navActive' : '') ?>">
					交易完成
				</li>
				<li class="abolish <?= ($status == 6 ? 'navActive' : '') ?>">
					交易取消
				</li>
			</ul>
		</div>
		<div class="middle_aera">
			<?= $this->partial('orders/index_middle') ?>
		</div>
	</div>
</div>
</body>
</html>
<script src="/public/ext/js/jquery-1.8.3.min.js"></script>
<script src="/public/js/jquery.base64.js"></script>
<script src="/public/ext/js/soo.m.ui.js"></script>
<script src="/public/ext/js/download.js"></script>
<script src="/public/js/orders/view.orders.comment.js"></script>
<script src="/public/js/orders/view.orders.index.js"></script>
<script src="/public/js/orders/view.orders.index.middle.js"></script>