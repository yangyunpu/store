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
	<link rel="stylesheet" type="text/css" href="/public/css/i/common.css"/>
	<link rel="stylesheet" type="text/css" href="/public/css/i/coupon/coupon.css"/>
</head>
<body>
<div class="index_wrap">
	<div class="header">
	    <a onclick="window.history.go(-1)"><img class="arrow"  src="/public/img/common/shop_back_black@1x.png " ></a>
		<span class="head_title">优惠券</span> 
        <a href="/i/coupon/active.html"><span class="head_active">激活</span></a>
	</div>
	<!-- 下载框 -->
<!-- 	<div class="download_box" id="download-nav">
		<div class="remove" id="download-nav-hide"><img src="../public/img/common/icon_close@3x.png" alt=""></div>
		<div class="logo"><img src="../public/img/common/logo@3x.png" alt=""></div>
		<div class="word">下载如此生活客户端</div>
		<div class="sure" id="download-nav-sure"><div>下载</div></div>
	</div> -->
	<div id="wrap">
        <div class="coupon_classly">
        	<span class="coupon_color">未使用</span>
        	<span>已使用</span>
        	<span>已过期</span>
        </div> 
        <?php if ($coupon) { ?>
            <input type="hidden" value="<?= $coupon['skip'] ?>" name=""  id="skip" />
            <?php if ($coupon['data']) { ?>
            <ul id="nocoupon" class="coupon_list">
            <?php foreach ($coupon['data'] as $d) { ?>
            	<li>
            		<div class="coupon_left">
            			<div class="coupon_title">
                        <?php if ($d['shop_name']) { ?>
            				商家券 | <?= $d['shop_name'] ?>
                        <?php } else { ?>
                        <?php if ($d['ways'] == 1) { ?>
                            平台券 | 全场通用
                        <?php } else { ?>
                            平台券 | 部分通用
                        <?php } ?>
                        <?php } ?>
            			</div>
            			<div class="coupon_money">
            				<div class="coupon_face">
                                <div class="face_num">
                                  <?= $d['face_value'] ?> 
                                </div>
                				<div class="face_unit">
                                    <p class="face_yuan">元</p> 
                                    <p class="face_quan">优惠券</p>           
                                </div>
            				</div>
            				<div class="coupon_term">
            					<p class="term_full">满<?= $d['coupon_limit'] ?>减<?= $d['face_value'] ?></p>
                                <p class="term_date">有效期:<?= $d['begin_date'] ?>-<?= $d['end_date'] ?></p>
            				</div>
            			</div>
            		</div>
            		<div class="coupon_right">
            			<img class="right_img" src="/public/img/i/mine_coupon_use@3x.png">
                        <div class="right_title">
                            <?php if ($d['status'] == 0) { ?>
                            使用
                            <?php } elseif ($d['status'] == 1) { ?>
                            已使用
                            <?php } else { ?>
                            已过期
                            <?php } ?>
                        </div>
            		</div>
            	</li>
            <?php } ?>
            </ul>
            <?php } ?>
        <?php } ?>
    </div>
</div>
</body>
</html>
<script src="/public/js/rem.js"></script> 
<script src="/public/ext/js/jquery-1.8.3.min.js"></script>
<script src="/public/js/jquery.base64.js"></script>
<script src="/public/ext/js/soo.m.ui.js"></script>
<script src="/public/ext/js/download.js"></script>
<script src="/public/js/i/coupon/coupon.js"></script>