<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>如此生活|满额抽奖</title>
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <link rel="stylesheet" type="text/css" href="/public/ext/css/soo.m.ui.css"/>
    <link rel="stylesheet" href="/public/ext/css/download.css">
    <link rel="stylesheet" href="/public/ext/css/swiper.css">
    <link rel="stylesheet" type="text/css" href="/public/css/lottery/expect.css"/>
</head>
<body class="keBody">
<!-- 头部 -->
<div id="soo-header">
    <div id="header-left"><a onclick = "window.history.go(-1)"> <img src="../public/img/lottery/shop_back_black@2x.png" alt=""></a></div>
    <div id="header-center">满额抽奖</div>
</div>
<!--抽奖卡牌-->
<div class="swiper-container" id="dd">
    <span class="hl-banner">规则</span>
    <div class="swiper-wrapper">

    <?php if(isset($link['app.fullaward.banner.001']['items'])) { ?>
        <?php foreach ($link['app.fullaward.banner.001']['items'] as $d) { ?>
            <a href="<?= $d['mobile_link'] ?>" class="swiper-slide"><img class="bannera" src="<?= $d['picture'] ?>" alt="banner"></a>
        <?php } ?>
    <?php } else { ?>
 <!--        <div class="swiper-slide"><img class="bannera" src="/public/img/lottery/group8.png" alt="banner"></div>
        <div class="swiper-slide"><img class="bannera" src="/public/img/lottery/group8.png" alt="banner"></div>
        <div class="swiper-slide"><img class="bannera" src="/public/img/lottery/group8.png" alt="banner"></div> -->
    <?php } ?>
    </div>
     <div class="pagination"></div>
</div>
<div class="hl-backimg">
    <ul id="lottery">
        <li>
            <div class="list flip hl-img">
                <img src="/public/img/lottery/fulldraw_comeback.png">
            </div>
        </li>
        <li>
            <div class="list flip hl-img">
                <img src="/public/img/lottery/fulldraw_comeback.png">
            </div>
        </li>
        <li>
            <div class="list flip hl-img">
                <img src="/public/img/lottery/fulldraw_comeback.png">
            </div>
        </li>
        <li>
            <div class="list flip hl-img">
                <img src="/public/img/lottery/fulldraw_comeback.png">
            </div>
        </li>
        <li class="hl-btn" id="box" class="box viewport-flip">
            <img class="hkl-block" src="/public/img/lottery/fulldraw_look@2x.png">
        </li>
        <li>
            <div class="list flip hl-img">
                <img src="/public/img/lottery/fulldraw_comeback.png">
            </div>
        </li>
        <li>
            <div class="list flip hl-img">
                <img src="/public/img/lottery/fulldraw_comeback.png">
            </div>
        </li>
        <li>
            <div class="list flip hl-img">
                <img src="/public/img/lottery/fulldraw_comeback.png">
            </div>
        </li>
        <li>
            <div class="list flip hl-img">
                <img src="/public/img/lottery/fulldraw_comeback.png">
            </div>
        </li>
    </ul>
</div>
<div class="hkl-fex"></div>
<div class="hkl-neir">
    <img class="neir-img" src="/public/img/lottery/delete@2x.png" alt="">
    <p class="hkl-head">规则</p>
    <p class="regula-text">1、订单支付完成后,用户直接获得抽奖机会提示,可以参与抽奖;</p>
    <p class="regula-text">2、若用户点击关闭抽奖提示页面,则视为放弃此次抽奖机会,将不再显示抽奖;</p>
    <p class="regula-text">3、每次订单只有一次抽奖机会;</p>
    <p class="regula-text">4、若用户在抽中奖品后,发起退款申请,则需将奖品及购买商品一起返还,否则无法通过退款;</p>
    <p class="regula-text">5、抽奖商品无法提供相应发票;</p>
    <p class="regula-text">6、在法律允许范围内,如此生活拥有活动的最终解释权;</p>
</div>
</body>

</html>
<script src="/public/js/rem.js"></script> 
<script src="/public/ext/js/jquery-1.8.3.min.js"></script>
<script src="/public/ext/js/download.js"></script>
<script src="/public/js/jquery.base64.js"></script>
<script type="text/javascript" src="/public/ext/js/swiper.min.js"></script>
<script src="/public/js/lottery/expect.js"></script>
