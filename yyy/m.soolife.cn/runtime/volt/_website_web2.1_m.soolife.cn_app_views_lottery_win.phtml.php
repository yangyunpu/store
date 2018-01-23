<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>如此生活|付款成功</title>
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <link rel="stylesheet" type="text/css" href="/public/ext/css/soo.m.ui.css"/>
    <link rel="stylesheet" href="/public/ext/css/download.css">
    <link rel="stylesheet" href="/public/ext/css/swiper.css">
    <link rel="stylesheet" type="text/css" href="/public/css/lottery/win.css"/>
</head>
<body class="keBody">
    <!-- 头部 -->
    <div id="soo-header">
        <div id="header-left"><a href="<?= $url_m ?>/mindex/index.html"> <img src="../public/img/lottery/shop_back_black@2x.png" alt=""></a></div>
        <div id="header-center">付款成功</div>
        <!-- <div id="header-right"><a href="regulation.html"> <img src="../public/img/lottery/xingxingsha_share@2x.png" alt=""></a></div> -->
    </div> <!---->
    <img class="win-banner" src="../public/img/lottery/q_fw658@2x.png" alt="">
    <?php $main_order = isset($_GET['m']) ? $_GET['m']:''?>
    <?php if($data==1):?>
        <a class="win-btn" href="/lottery/index/<?= $main_order ?>.html">立即去抽奖</a>
    <?php endif?>
    <div class="hkl-hd">
        <p class="hkl-bor-left"><span></span></p>
        <span class="hd-h">为您推荐</span>
        <p class="hkl-bor-right"><span></span></p>
    </div>

    <ul class="hkl-good">
        <?php foreach ($guesslike as $d) { ?>
        <li><a href="<?= $url_goods ?>/<?= $d['sku_id'] ?>.html">
            <div class="good-img"><img src="<?= $d['logo'] ?>"></div>
            <p class="good-bt"><?= $d['sku_name'] ?></p>
            <p class="good-red">￥<?= $d['act_price'] ?></p></a>
        </li>
        <?php } ?>
    </ul>
</body>

</html>

<script src="/public/ext/js/jquery-1.8.3.min.js"></script>
<script src="/public/js/jquery.base64.js"></script>
<script src="/public/js/rem.js"></script>
<!-- <script src="/public/js/lottery/homepage.js"></script> -->
<script src="/public/js/m_analytics.js"></script>
