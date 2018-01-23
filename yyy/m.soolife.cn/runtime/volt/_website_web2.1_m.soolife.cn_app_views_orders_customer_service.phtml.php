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
	<link rel="stylesheet" type="text/css" href="/public/css/orders/popLayer.css"/>
	<link rel="stylesheet" type="text/css" href="/public/css/orders/foot.css"/>
	<link rel="stylesheet" type="text/css"  href="/public/css/me/index.css">
</head>
<body>
<div class="index_wrap">
	<div class="header">
	    <a onclick="window.history.go(-1)">
	        <img class="arrow"  src="/public/img/common/shop_back_black@1x.png " ></a>
		<span class="head_title">申请售后</span> 
	</div>
	<div class="careful">
		<p class="examine">请如实填写下方内容，以便如此生活顺利进行审核</p>
		<p class="return">如果您的商品有任何质量问题，可以进行退货；海外精品暂不支持无理由退货</p>
	</div>
	<?php foreach ($data as $d) { ?>
	<form class="form-horizontal" id="singleproduct_form" style="margin-bottom: 44px;background-color: #fff;">
	<div class="goods_detail">
		<div class="img_box"><img src="<?= $d['logo'] ?>" alt=""></div>
		<div class="word"><?= $d['shop_name'] ?></div>
		<div class="num">
			<p class="piece">￥<span><?= $d['act_price'] ?></span>+<img src="/public/img/xingbi.png" alt="" class="xingb"><span><?= $d['coin'] ?></span></p>
			<p class="count">x<?= $d['qty'] ?></p>
		</div>
	</div>

	<div class="bug_n">
		<p class="tag">申请数量</p>
		<div class="bug_btn">
			<p class="no_border" ttl_count=<?= $d['qty'] ?>>+</p>
			<p class ="m_ttl_count"><?= $d['qty'] ?></p>
			<p class="reduce">-</p>
		</div>
	</div>



	<div class="bug_n">
		<p class="tag_radio entry">申请类型</p>
		<div class="bug_radio">
			<input type="radio" name="entry" value="1" <?php if ($d['is_sku_overseas'] == 1) { ?> checked="true" <?php } ?>>退货
			<?php if ($d['is_sku_overseas'] == 0) { ?><input type="radio" name="entry" checked="true" value="2">换货<?php } ?>
			<?php if ($d['is_sku_overseas'] == 0) { ?><input type="radio" name="entry" value="3">维修<?php } ?>
		</div>
	</div>
	<div class="bug_n" style="border-bottom:none;height:20px; line-height:20px !important;">
	     <p class="tag_radio entry adsstring" style="border-top: 0 none;">收货地址</p>
	</div>
	<div class="main" address_id="" style="background:#fff;padding-top:0px;padding-bottom:0px;">
		<div class="addressBox" style="border-top: 0 none;">
			<p style="border: 0 none;line-height:30px;">
				<label><span class="danger">*</span>收货人</label>
				<input type="text" name="consignee"  value="<?= $result['consignee'] ?>" />
			</p>
			<p style="border: 0 none;line-height:30px;">
				<label><span class="danger">*</span>手机号码</label>
				<input type="text" name="phone"  value="<?= $result['mobile'] ?>" />
			</p >
			<p style="border: 0 none;line-height:30px;">
				<label><span class="danger">*</span>省&nbsp;&nbsp;市&nbsp;&nbsp;区</label>
				<span id="pcd"  name="province" class="province">&nbsp;<?= $result['region_text'] ?></span>
				<!-- <input type="hidden" type="text" value="<?= $result['region'] ?>" /> -->
			</p>
			<p style="border: 0 none;line-height:30px;">
				<label><span class="danger">*</span>详细地址</label>
				<input type="text" name="address"  value="<?= $result['address'] ?>" />
			</p>
		</div>
	</div>




	<div class="bug_n no_border">
		<p class="tag_problem question">问题描述</p>
	</div>
	<div class="problem_w">
		<textarea cols="2" rows="5" name="description" class="says_text" placeholder="说一下你遇到的问题..."></textarea>
	</div>

	<!-- <input type="button" value="提交" class="customer_btn"> -->
	      <!--  <button type="submit" class="btn btn-warning ">
								<i class="customer_btn"></i>
								保存
							</button> -->
			<button type="submit" class="btn btn-warning lq_btn">保存</button>
	<input name='sku_id'   type="hidden" value="<?= $d['sku_id'] ?>">
	<input name='qty'   type="hidden" value="<?= $d['qty'] ?>">
	<?php } ?>


	<input name='order_no'   type="hidden" value="<?= $result['order_no'] ?>">
	<div class="cd-popup" role="alert">
		<div class="cd-popup-container">
			<div class="pcdBox">
				<label>省份：</label>
				<select id="province" name="" class="province2 sel" data-value="" data-id="<?= $result['province'] ?>"></select>
			</div>
			<div class="pcdBox">
				<label>城市：</label>
				<select id="city" name="" class="city2 sel" data-value="" data-id="<?= $result['city'] ?>"></select>
			</div>
			<div class="pcdBox">
				<label>区县：</label>
				<select id="region" name="region" class="region2 sel" data-value="" data-id="<?= $result['region_no'] ?>"></select>
			</div>
			<a id="addaddress-sure" class="btnCommon btnDanger btnCheckPcd">
				确定
			</a>
		</div>
	</div>
	</form>
</div>
</body>
</html>
<script src="/public/ext/js/jquery-1.8.3.min.js"></script>
<script src="/public/js/jquery.base64.js"></script>
<script src="/public/ext/js/jquery.validate.min.js"></script>
<script src="/public/js/orders/view.orders.customer_service.js"></script>