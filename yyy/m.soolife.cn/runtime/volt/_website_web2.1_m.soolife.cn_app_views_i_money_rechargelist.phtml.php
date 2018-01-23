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
	<link rel="stylesheet" type="text/css" href="/public/css/i/common.css"/>
	<link rel="stylesheet" type="text/css" href="/public/css/i/money/view.money.css"/>
</head>
<body>
<div class="index_wrap">
	<div class="header">
	    <a onclick="window.history.go(-1)"><img class="arrow"  src="/public/img/common/shop_back_black@1x.png " ></a>
		<span class="head_title">现金</span> 
	</div>
	<!-- 下载框 -->
<!-- 	<div class="download_box" id="download-nav">
		<div class="remove" id="download-nav-hide"><img src="../public/img/common/icon_close@3x.png" alt=""></div>
		<div class="logo"><img src="../public/img/common/logo@3x.png" alt=""></div>
		<div class="word">下载如此生活客户端</div>
		<div class="sure" id="download-nav-sure"><div>下载</div></div>
	</div> -->
	<div id="wrap">
        <!-- <div class="swiper-container">
        	<div class="swiper-wrapper">
        		<div class="swiper-slide"> 
        			<img class="photo" src="/public/img/i/mine_xianjin@3x.png">
        		</div>
        		<div class="swiper-slide"> 
        			<img class="photo" src="/public/img/i/mine_xianjin@3x.png">
        		</div>
        	</div>
        	<div class="pagination"></div>
        </div> -->
        <div class="photo_logo">
            <?php if ($img_url) { ?><img  src="<?= $img_url ?>"><?php } ?>
        </div>
        <div class="recharge">
        	<div class="recharge_nickname">
            <?php if ($nickname) { ?>
        		<span>昵称</span>  <span><?= $nickname ?></span>
            <?php } ?> 
        	</div>
            <?php if ($recharglist) { ?>
            <?php if ($recharglist['data']) { ?>
            <div class="recharge_val">
                <?php foreach ($recharglist['data'] as $d) { ?>
        		    <span  class="face_val " data-item = "<?= $d['pay_value'] ?>" data-id ="<?= $d['virtualgoods_id'] ?>"><?= $d['name'] ?></span>
                <?php } ?>
            </div>    
            <?php } ?>
            <?php } ?>
        	<div class="recharge_active hide">
        		<span>优惠价:  ¥</span><span id="face_actual"></span> 
        	</div>
        	<div class="recharge_instant">
        		<a id="instant_pay">立即充值</a>
        	</div>
        </div>
    </div>
    <!-- 蒙板 -->
    <div id="mask_pay" class="hide">
        请选择充值金额!
    </div>
</div>
</body>
</html>
<script src="/public/js/rem.js"></script> 
<script src="/public/ext/js/jquery-1.8.3.min.js"></script>
<script src="/public/js/jquery.base64.js"></script>
<script src="/public/ext/js/soo.m.ui.js"></script>
<script src="/public/ext/js/download.js"></script>
<script type="text/javascript" src="/public/ext/js/swiper.min.js"></script>
<script src="/public/js/i/money/rechargelist.js"></script>