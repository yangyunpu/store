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
	<link rel="stylesheet" type="text/css" href="/public/css/orders/mylifeallstyle.css"/>
	<link rel="stylesheet" type="text/css" href="/public/css/orders/font-awesome.min.css"/>
	<link rel="stylesheet" type="text/css" href="/public/css/orders/common.css"/>
	<link rel="stylesheet" type="text/css" href="/public/css/i/common.css"/>
</head>
<body>
<div class="index_wrap">
	<div class="header">
	    <a onclick="window.history.go(-1)">
	        <img class="arrow"  src="/public/img/common/shop_back_black@1x.png " ></a>
		<span class="head_title">订单评价</span> 
	</div>
<!-- <div class="header">
	<span class="headleft" onclick="window.history.go(-1)">
		<a class="back">
		    <img src="/public/mobile/img/mylife/qleft_03.png"/>
		</a>
	</span>
	<span class="headTitle">订单评价</span>
</div> -->
<div class="main" id="comments_main"
	data-order-id="<?= $result->id ?>"
	data-order-url="/orders/comment/<?= $result->id ?>.html"
>

	<?php foreach ($result->items as $vo) { ?>
	<?php if ($vo->comment == 'N') { ?>
	<div class="productparentBox"
		data-order-id = "<?= $result->id ?>"
	>
		<div class="shopName"
			data-sku-id = "<?= $vo->sku_id ?>"
		>
			<?= $vo->shop_name ?>
			
		</div>
		<div class="cartProduct clearfix">
			<div class="ordercommentImg">
				<img src="<?= $vo->logo ?>">
			</div>
			<div class="productName">
				<p>
					<?= $vo->sku_name ?>
				</p>
				<p class="subInfo">
					<?= $vo->specs ?>
				</p>
			</div>
			<div class="productPrice">
				<p>
					<img src="/public/img/starIcon.png">
					<span class="starCount"><?= $vo->coin ?></span> + ¥<?= $vo->act_price ?>
				</p>
				<p class="subInfo">
					×<?= $vo->qty ?>
				</p>
			</div>
		</div>
		<div class="commentBox">
			商品评价
			<span class="star">
				<span class="icon-span">
					<i class="icon-large icon-star">
					</i>
				</span>
				<span class="icon-span">
					<i class="icon-large icon-star" >
					</i>
				</span>
				<span class="icon-span">
					<i class="icon-large icon-star">
					</i>
				</span>
				<span class="icon-span">
					<i class="icon-large icon-star">
					</i>
				</span>
				<span class="icon-span">
					<i class="icon-large icon-star">
					</i>
				</span>
			</span>
			<br />
			<textarea class="commentText" rows="3" placeholder="评价超过15个字,有图片,即可赠送星币"></textarea>			
		</div>
		<div class="orderCommentBox">
		<h2>
			店铺评价
		</h2>
		<ul class="SIrate">
			<li>
				<i class="icon-sign-blank ">
				</i>商品包装
				<span class="star package">
					<span class="icon-span">
						<i class="icon-large icon-star">
						</i>
					</span>
					<span class="icon-span">
						<i class="icon-large icon-star" >
						</i>
					</span>
					<span class="icon-span">
						<i class="icon-large icon-star">
						</i>
					</span>
					<span class="icon-span">
						<i class="icon-large icon-star">
						</i>
					</span>
					<span class="icon-span">
						<i class="icon-large icon-star">
						</i>
					</span>
				</span>
			</li>
			<li>
				<i class="icon-sign-blank deliveriy">
				</i>送货速度
				<span class="star deliveriy">
					<span class="icon-span">
						<i class="icon-large icon-star">
						</i>
					</span>
					<span class="icon-span">
						<i class="icon-large icon-star" >
						</i>
					</span>
					<span class="icon-span">
						<i class="icon-large icon-star">
						</i>
					</span>
					<span class="icon-span">
						<i class="icon-large icon-star">
						</i>
					</span>
					<span class="icon-span">
						<i class="icon-large icon-star">
						</i>
					</span>
				</span>
			</li>
			<li>
				<i class="icon-sign-blank service">
				</i>配送服务
				<span class="star service">
					<span class="icon-span">
						<i class="icon-large icon-star">
						</i>
					</span>
					<span class="icon-span">
						<i class="icon-large icon-star" >
						</i>
					</span>
					<span class="icon-span">
						<i class="icon-large icon-star">
						</i>
					</span>
					<span class="icon-span">
						<i class="icon-large icon-star">
						</i>
					</span>
					<span class="icon-span">
						<i class="icon-large icon-star">
						</i>
					</span>
				</span>
			</li>
		</ul>
	</div>
	<div id="error" class="error"></div>
	<div class="buttonBox">
		<a class="btnCommon btnOrange btnCheck">
			提交评价
		</a>
	</div>
	</div>
	<?php } ?>
	<?php } ?>
	
</div>	
</div>
</body>
</html>
<script src="/public/ext/js/jquery-1.8.3.min.js"></script>
<script src="/public/js/jquery.base64.js"></script>
<script src="/public/ext/js/soo.m.ui.js"></script>
<script src="/public/ext/js/download.js"></script>
<script src="/public/js/orders/view.orders.comment.js"></script>
