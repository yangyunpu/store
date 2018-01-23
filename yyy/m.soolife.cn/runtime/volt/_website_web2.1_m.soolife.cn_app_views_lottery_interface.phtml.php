<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>如此生活|商品界面</title>
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <link rel="stylesheet" type="text/css" href="/public/ext/css/soo.m.ui.css"/>
    <link rel="stylesheet" href="/public/ext/css/download.css">
    <link rel="stylesheet" href="/public/ext/css/swiper.css">
    <link rel="stylesheet" type="text/css" href="/public/css/lottery/interface.css"/>
</head>
<body class="keBody">
<!-- 头部 -->
<div id="soo-header">
    <div id="header-left"><a onclick = "window.history.go(-1)"> <img border="0" src="../public/img/lottery/shop_back_black@2x.png" alt=""></a></div>
    <div id="header-center">商品界面</div>
    <div id="header-right"><a href="<?= $url_order ?>/index.html"> 
        <div class="goods_kuangj">
            <img class="goods_gou" src="../public/img/lottery/goods_gou@2x.png" alt="">

            <span class="good_qian price">￥<?php if ($data_price['price'] > 9999) { ?>9999+<?php } else { ?><?= $data_price['price'] ?><?php } ?></span>
        </div></a>
    </div>
</div>
<img class="bannera" src="<?= $data['fc_album'] ?>" alt="banner">
<ul class="hkl-good">
    <?php if ($data['goods']) { ?>
        <?php foreach ($data['goods'] as $d) { ?>
        <li>
            <div class="good-img">
                <a href="<?= $url_goods ?>/<?= $d['Sku_ID'] ?>.html">
                    <img src="<?= $d['S_Logo'] ?>">
                </a>
            </div>
            <p class="good-bt"><?= $d['S_Name'] ?></p>
            <p class="good-red">￥<?= $d['S_ShopPrice'] ?></p>
            <p class="good-btm"  data-skuid="<?= $d['Sku_ID'] ?>" data-fullid="<?= $d['fullid'] ?>">加入购物车</p>
        </li>
        <?php } ?>
    <?php } ?>
</ul>   
</body>

</html>

<script src="/public/ext/js/jquery-1.8.3.min.js"></script>
<script src="/public/js/jquery.base64.js"></script>
<script src="/public/js/rem.js"></script>
<script src="/public/js/lottery/interface.js"></script>
<script src="/public/js/m_analytics.js"></script>
<!--<script src="/public/js/sdk.2.2.js"></script>-->
