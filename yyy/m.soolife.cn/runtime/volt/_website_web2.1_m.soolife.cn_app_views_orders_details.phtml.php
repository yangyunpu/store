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
	<link rel="stylesheet" type="text/css" href="/public/css/orders/mylifeallstyle.css"/>
</head>
<body>
<div class="index_wrap">
	<div class="header">
	    <a onclick="window.history.go(-1)"><img class="arrow"  src="/public/img/common/shop_back_black@1x.png " ></a>
		<span class="head_title">订单详情</span> 
	</div>
<?php if ($result['items']) { ?>
<div class="main">
	<div class="orderStatus">
		<span><?= $result['status_text'] ?></span>
		<span class="orderNo">订单号：<?= $result['order_no'] ?></span>
	</div>
	<?php if ($result['delivery_type'] != 5) { ?>
	<div class="reciverBox detailod-box">
		<h2>
			收货信息
		</h2>
		<div class="buyerBox">
			<div class="locationImg">
				<img src="/public/img/location.png">
			</div>
			<div class="buyerInfo">
				<p>
					<span>收件人：<?= $result['consignee'] ?></span>
					<span class="subInfo buyerTel"><?= $result['mobile'] ?></span>
				</p>
				<p class="subInfo">
					<?= $result['region_text'] ?><?= $result['address'] ?>
				</p>
			</div>
			<div class="clear">
			</div>
			<div class="orderdetailbuyerBg">
			</div>
		</div>
	</div>
	<div class="deliverBox detailod-box">
		<h2>
			物流详情
		</h2>
		<div class="deliverDetail">
			<ul>
				<li>
					<span>物流方式</span>
					<span class="" style="float:right;"><?= ($result['delivery_type_text'] == ' ' ? '无' : $result['delivery_type_text']) ?></span>
				</li>
				<li>
					<span>物流公司</span>
					<span class="deliverInfo"><?= ($result['express_name'] == ' ' ? '无' : $result['express_name']) ?></span>
				</li>
				<li>
					<span>运单号码</span>
					<span class="deliverInfo"><?= ($result['express_code'] == ' ' ? '无' : $result['express_code']) ?></span>
				</li>

				<li style="border-bottom: 0 none;">
					<span>物流信息</span>

					<span class="" style="float:right;">
						<?php if ($result['logs']) { ?>
						<?php foreach ($result['logs'] as $k => $v) { ?>
						<a href="deliverinfo/<?= $result['id'] ?>.html">
							<?php if ($k == 0) { ?>
							<!-- <?= date('Y-m-d H:i:s', $v['create_time']) ?> <?= $v['record'] ?> -->
							查看物流消息
							<?php } ?>
							<i class="icon-angle-right"></i>
						</a>
						<?php } ?>
						<?php } else { ?>
							现在还没有物流信息
						<?php } ?>
					</span>
				</li>
			</ul>
		</div>
	</div>
	<div class="deliverBox detailod-box">
		<h2>
			其它
		</h2>
		<div class="deliverDetail">
			<ul>
				<li>
					<!-- <span>备注：</span> -->
					<p class="deliverInfo"><span>备注：</span><span><?= $result['remark'] ?></span></p>
				</li>
				<li>
					<!-- <span>发票：</span> -->
					<p class="deliverInfo"><span>发票：</span><?= $result['invoice_title'] ?></p>
				</li>
			</ul>
		</div>
	</div>
	<?php } ?>
	<div class="productBox">
		<div class="shopName">
			<?= $result['shop_name'] ?>
		</div>
		<?php foreach ($result['items'] as $vo) { ?>
		<div class="cartProduct clearfix">
			<div class="productImage">
				<a href="<?= $url_goods ?>/<?= $vo['sku_id'] ?>.html"><img src="<?= $vo['logo'] ?>"></a>
			</div>
			<div class="productName">
				<p>
					<?= $vo['sku_name'] ?>
				</p>
				<p class="subInfo">
					<?= $vo['specs'] ?>
				</p>
			</div>
			<div class="productPrice">
				<p>
					<img src="/public/img/starIcon.png">
					<span class="starCount"><?= $vo['coin'] ?></span> + ¥<?= $vo['act_price'] ?>
				</p>
				<p class="subInfo">
					×<?= $vo['qty'] ?>
				</p>
			</div>
		</div>
		<?php } ?>
		<div class="p-box">
			<span>商品金额</span>
			<span class="pInfo-box">&yen;<?= $result['goods_fee'] ?></span>
		</div>
		<div class="p-box">
			<span>运费</span>
			<span class="pInfo-box">&yen;<?= $result['delivery_fee'] ?></span>
		</div>
		<div class="p-box">
			<span>星币</span>
			<span class="pInfo-box" style="color: #e97e20;">
				<img src="/public/img/starIcon.png">
				<?= $result['ttl_coin'] ?>
			</span>
		</div>
		<div class="p-box">
			<span>优惠</span>
			<span class="pInfo-box">&yen;<?= $result['discount_fee'] ?></span>
		</div>
		<div class="p-box" style="border-bottom: 0 none;">
			<span>总金额</span>
			<span class="pInfo-box" style="color: #ce362c;font-size: 1.5rem;font-weight: bold;">&yen;<?= $result['pay_fee'] ?></span>
		</div>
	</div>
	<!-- <div class="orderTimeBox">
		<ul>
			<li>
				下单时间：<span><?= date('Y-m-d h:i:s', $result['create_time']) ?></span>
			</li>
		</ul>
	</div> -->
	<div class="buttonBox">
		<?php if ($result['delivery_type'] == 2) { ?>
		<a class="btnCommon btnOrange btnCheck">
			生成二维码
		</a>
		<?php } ?>
	</div>
	<!-- 二维码 -->
	<div class="twopassword">
		<div class="twopassword_hide"></div>
		<div class="img_box">
			<img src="<?= $img_url ?>" alt="">
		</div>
	</div>
</div>
<?php } else { ?>
	<div class="searchno">
		<img src="/public/img/orders/sss_03.png" width="100"/>
		<br />
		<br />
	</div>
<?php } ?>
<script src="/public/ext/js/jquery-1.8.3.min.js"></script>
<script src="/public/js/jquery.base64.js"></script>
<script src="/public/ext/js/soo.m.ui.js"></script>
<script src="/public/ext/js/download.js"></script>
<script src="/public/js/orders/view.orders.details.js"></script>

