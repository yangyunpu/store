<?php
    require_once ROOT_PATH . "/apps/librarys/weixinshare/jssdk.php";
    $jssdk = new JSSDK("wx6fe7550ec5625a23", "57bdd0bbe290a22b6844673509db0b61");
    $signPackage = $jssdk->GetSignPackage();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta content="black" name=" apple-mobile-web-app-status-bar-style" />
    <!-- <meta itemprop="name" content="品牌招商"/>
    <meta itemprop="image" content="https://sales.soolife.cn/public/mobile/img/question.jpg" />
    <meta name="description" itemprop="description" content="你卖货难吗?如此生活,全新OAO平台,全渠道解决方案,你的货,我来卖!" /> -->
    <title>重磅好礼</title>
    <link rel="stylesheet" href="/public/mobile/css/hot/present.css" />
</head>

<body>
<!-- 微信分享 -->
    <input type="hidden" name="appId" value="<?= $signPackage['appId'] ?>" />
    <input type="hidden" name="timestamp" value="<?= $signPackage['timestamp'] ?>" />
    <input type="hidden" name="nonceStr" value="<?= $signPackage['nonceStr'] ?>" />
    <input type="hidden" name="signature" value="<?= $signPackage['signature'] ?>" />
    <div class="profusion">
        <div class="y_banner">
            <img src="/public/mobile/img/hot/present/banner/one.jpg" alt="" align="top" />
            <img src="/public/mobile/img/hot/present/banner/two.jpg" alt="" align="top" />
            <img src="/public/mobile/img/hot/present/banner/three.jpg" alt="" align="top" />
        </div>



        <div class="y_top">
            <dl>
                <dt class="open-goods-detail" data-goods-id="49639"><img src="/public/mobile/img/hot/present/one_floor/a.png" alt=""></dt>
                <dd>
                    <h1>飞科剃须刀FS870</h1>
                    <p>￥<span class="_price">139</span>元</p>
                    <div class="amount">
                        <span class="jian c_active">-</span>
                        <input class="amount_int" name="amount_int" type="text" value="0" disabled="disabled">
                        <input name="sku_id" type="hidden" value="49639">
                        <span class="add">+</span>
                    </div>
                </dd>
            </dl>
            <dl>
                <dt class="open-goods-detail" data-goods-id="56462"><img src="/public/mobile/img/hot/present/one_floor/b.png" alt=""></dt>
                <dd>
                    <h1>托马斯580ML带套双盖保温水壶</h1>
                    <p>￥<span class="_price">249</span>元</p>
                    <div class="amount">
                        <span class="jian">-</span>
                        <input class="amount_int" name="amount_int" type="text" value="0" disabled="disabled">
                        <input name="sku_id" type="hidden" value="56462">
                        <span class="add">+</span>
                    </div>
                </dd>
            </dl>
            <dl>
                <dt class="open-goods-detail" data-goods-id="54780"><img src="/public/mobile/img/hot/present/one_floor/c.png" alt=""></dt>
                <dd>
                    <h1>清风抽取式面纸（整箱）</h1>
                    <p>￥<span class="_price">139</span>元</p>
                    <div class="amount">
                        <span class="jian">-</span>
                        <input class="amount_int" name="amount_int" type="text" value="0" disabled="disabled">
                        <input name="sku_id" type="hidden" value="54780">
                        <span class="add">+</span>
                    </div>
                </dd>
            </dl>
            <dl>
                <dt class="open-goods-detail" data-goods-id="51102"><img src="/public/mobile/img/hot/present/one_floor/d.png" alt=""></dt>
                <dd>
                    <h1>梦17多胜肽紧致净化面膜</h1>
                    <p>￥<span class="_price">69</span>元</p>
                    <div class="amount">
                        <span class="jian">-</span>
                        <input class="amount_int" name="amount_int" type="text" value="0" disabled="disabled">
                        <input name="sku_id" type="hidden" value="51102">
                        <span class="add">+</span>
                    </div>
                </dd>
            </dl>
            <dl>
                <dt class="open-goods-detail" data-goods-id="35925"><img src="/public/mobile/img/hot/present/one_floor/e.png" alt=""></dt>
                <dd>
                    <h1>力博得电动牙刷成人充电式</h1>
                    <p>￥<span class="_price">129</span>元</p>
                    <div class="amount">
                        <span class="jian">-</span>
                        <input class="amount_int" name="amount_int" type="text" value="0" disabled="disabled">
                        <input name="sku_id" type="hidden" value="35925">
                        <span class="add">+</span>
                    </div>
                </dd>
            </dl>

        </div>
        <div class="y_main">
            <ul>
                <li>
                    <span data-goods-id="48064"></span>
                    <!-- <span data-goods-id="40952"></span> -->

                    <img src="/public/mobile/img/hot/present/two_floor/a.png" alt="">

                </li>
                <li>
                    <span data-goods-id="48063"></span>
                    <img src="/public/mobile/img/hot/present/two_floor/b.png" alt="">
                </li>
                <li>
                    <!-- <span data-goods-id="36837"></span> -->
                    <span data-goods-id="39479"></span>
                    <img src="/public/mobile/img/hot/present/two_floor/c.png" alt="">
                </li>
                <li>
                    <!-- <span data-goods-id="56048"></span> -->
                    <span data-goods-id="56049"></span>
                    <img src="/public/mobile/img/hot/present/two_floor/d.png" alt="">
                </li>
                <li>
                    <!-- <span data-goods-id="21761"></span> -->
                    <span data-goods-id="31102"></span>
                    <img src="/public/mobile/img/hot/present/two_floor/e.png" alt="">
                </li>
            </ul>
        </div>

        <div class="one_floor">
            <img src="/public/mobile/img/hot/present/banner/a.jpg" align="top">
            <img src="/public/mobile/img/hot/present/banner/b.jpg" align="top">
            <!-- 注册地址 -->
            <input type="hidden" id="url_m" value="<?= $url_m ?>">
            <input type="hidden" id="url_order" value="<?= $url_order ?>">
            <!-- 省市区代码 -->
            <input type="hidden" id="region">
            <input type="hidden" id="token">

            <div class="buy">
                <img class="gobuy" src="/public/mobile/img/hot/present/banner/j.png" align="top">
            </div>
        </div>
        <!-- 弹出框 -->
        <div class="_alert">
            <div class="_alert_main">
                <p>你当前商品未满300元</p>
                <p>无法享受赠礼</p>
                <span class="_back">返回添加商品</span>
            </div>
        </div>

        <!-- 三级联动弹框 -->
        <div class="lj_address">
            <div class="lj_wihte">
                <div class="lj_title">
                    <span>收货地址</span>
                    <img class="lj_delect" src="/public/mobile/img/delect.jpg">
                </div>
                <div class="lj_content">
                    <span class="lj_wen">姓 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;名:</span>
                    <div class="lj_names">
                        <input class="lj_name" type="text" name="name" value="">
                    </div>

                </div>
                <div>
                    <span class="lj_wen">联系电话:</span>
                    <div class="lj_tells">
                        <input class="lj_tell" type="text" name="mobile" value="" maxlength="11">
                    </div>

                </div>
                <div class="lj_add">
                    <span class="lj_wens">地&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;址:</span>
                    <div class="lj_xuan" id="demo1">
                        <span id="province">省&nbsp;<img class="lj_down" src="/public/mobile/img/down.jpg"></span>
                         <span id="city">市&nbsp;<img class="lj_down" src="/public/mobile/img/down.jpg"></span>
                         <span id="county">县&nbsp;<img class="lj_down" src="/public/mobile/img/down.jpg"></span>
                    </div>
                </div>
                <div id="site_box">
                    <ul id="province_box"></ul>
                    <ul id="city_box" style="display:none;"></ul>
                    <ul id="county_box" style="display:none;"></ul>
                </div>
                <div class="lj_xiangs">
                    <input class="lj_xiang" type="text" name="address" value="" placeholder="请填入详细地址">
                </div>
                <div class="lj_submit ">
                    提交
                </div>
            </div>
        </div>
        <div id="alert_mark"></div>
    </div>

    <script type="text/javascript" src="/public/mobile/js/investment/rem.js"></script>
    <script type="text/javascript" src="/public/mobile/js/investment/jquery.-1.8.3.min.js"></script>
    <script type="text/javascript" src="/public/mobile/js/sdk.2.2.js"></script>
    <script type="text/javascript" src="/public/mobile/js/hot/onebuy/jquery.base64.js"></script>
    <script type="text/javascript" src="/public/mobile/js/weixin/jssdk.js"></script>
    <script type="text/javascript" src="/public/mobile/js/hot/present/index.js"></script>
    <script type="text/javascript" src="/public/mobile/js/hot/present/wxshare.js"></script>
</body>

</html>