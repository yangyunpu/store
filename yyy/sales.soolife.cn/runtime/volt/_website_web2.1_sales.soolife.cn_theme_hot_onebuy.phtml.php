<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <title>一元购</title>
    <link rel="stylesheet" href="/public/mobile/css/hot/onebuy.css" />
</head>

<body>
    <div class="profusion">
        <div class="y_banner">
            <img src="/public/mobile/img/hot/onebuy/banner/one.jpg" alt="" align="top" />
            <img src="/public/mobile/img/hot/onebuy/banner/two.jpg" alt="" align="top" />
            <img src="/public/mobile/img/hot/onebuy/banner/three.jpg" alt="" align="top" />
            <img src="/public/mobile/img/hot/onebuy/banner/four.jpg" alt="" align="top" />
        </div>
        <div class="one_floor">
            <img src="/public/mobile/img/hot/onebuy/one_floor/a.jpg" align="top">
            <img src="/public/mobile/img/hot/onebuy/one_floor/b.jpg" align="top">
            <img src="/public/mobile/img/hot/onebuy/one_floor/c.jpg" align="top">
            <img src="/public/mobile/img/hot/onebuy/one_floor/d.jpg" align="top">
            <!-- 注册地址 -->
            <input type="hidden" id="url_m" value="<?= $url_m ?>">
            <input type="hidden" id="url_order" value="<?= $url_order ?>">
            <!-- 省市区代码 -->
            <input type="hidden" id="region">
            <div class="buy">
                <img class="immediately get-token-value" src="/public/mobile/img/hot/onebuy/one_floor/j.png" align="top">
            </div>
        </div>
    </div>
    <!-- 弹框 -->
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
            <div class="lj_submit">
                提交
            </div>
        </div>
    </div>
    <div id="alert_mark"></div>
</body>
<script type="text/javascript" src="/public/mobile/js/investment/rem.js"></script>
<script type="text/javascript" src="/public/mobile/js/investment/jquery.-1.8.3.min.js"></script>
<script type="text/javascript" src="/public/mobile/js/hot/onebuy/jquery.base64.js"></script>
<script type="text/javascript" src="/public/mobile/js/sdk.2.2.js"></script>
<script type="text/javascript" src="/public/mobile/js/hot/onebuy/view.onebuy.js"></script>
</html>