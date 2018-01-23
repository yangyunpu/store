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
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta itemprop="name" content="十万火急"/>
    <meta itemprop="image" content="https://sales.soolife.cn/public/mobile/img/hot/cash.png" />
    <meta name="description" itemprop="description" content='充值立赠好礼，加入如此生活会员，立即开启购物"星"旅程!' />
    <title>十万火急</title>
    <link rel="stylesheet" href="/public/mobile/css/hot/cashcard.css" />
</head>

<body>
<!-- 微信分享 -->
    <input type="hidden" name="appId" value="<?= $signPackage['appId'] ?>" />
    <input type="hidden" name="timestamp" value="<?= $signPackage['timestamp'] ?>" />
    <input type="hidden" name="nonceStr" value="<?= $signPackage['nonceStr'] ?>" />
    <input type="hidden" name="signature" value="<?= $signPackage['signature'] ?>" />
    <div class="profusion">
        <div class="y_banner">
            <img src="/public/mobile/img/hot/cashcard/banner/one.jpg" alt="" align="top" />
            <img src="/public/mobile/img/hot/cashcard/banner/two.jpg" alt="" align="top" />
            <img src="/public/mobile/img/hot/cashcard/banner/three.jpg" alt="" align="top" />
            <img src="/public/mobile/img/hot/cashcard/banner/four.jpg" alt="" align="top" />
            <img src="/public/mobile/img/hot/cashcard/banner/five.jpg" alt="" align="top" />
        </div>

        <form id="form1" class="y_main">
            <ul>
                <li>
                    <div class="radio"> 
                        <span  data-goods-id="48064" class="choose"></span>
                    </div>
                    <img class="open-goods-detail" data-goods-id="48064"  src="/public/mobile/img/hot/cashcard/one_floor/a.png" alt="">
                    <p></p>
                </li>
                <li>
                        <div class="radio"><span  data-goods-id="36912"></span></div>
                        <img  class="open-goods-detail" data-goods-id="36912" src="/public/mobile/img/hot/cashcard/one_floor/b.png" alt="">
                    <p></p>
                </li>
                <li>
                    <div class="radio"><span  data-goods-id="36837"></span></div>
                        <img class="open-goods-detail" data-goods-id="36837" src="/public/mobile/img/hot/cashcard/one_floor/c.png" alt="">
                    <p></p>
                </li>
                <li>
                    <div class="radio"><span  data-goods-id="56048"></span></div>
                        <img class="open-goods-detail" data-goods-id="56048" src="/public/mobile/img/hot/cashcard/one_floor/d.png" alt="">
                    <p></p>
                </li>
                <li>
                    <div class="radio"><span  data-goods-id="21761"></span></div>
                        <img  class="open-goods-detail" data-goods-id="21761" src="/public/mobile/img/hot/cashcard/one_floor/e.png" alt="">
      
                </li>
            </ul>
        </form>
        <div class="one_floor">
            <img src="/public/mobile/img/hot/cashcard/banner/a.jpg" align="top">
            <img src="/public/mobile/img/hot/cashcard/banner/b.jpg" align="top">
            
            <div class="buy">
                <img class="lj_buys get-token-value" src="/public/mobile/img/hot/cashcard/banner/j.png" align="top">
            </div>

        <!-- 收货地址 -->
        <div class="contet">

            <div class="take">
                <div class="takes">
                    <p style="text-align: center;color: #000000;">收货地址</p>
                </div>
            </div>
            <div class="take">
                <div class="takes">
                    <div class="head">
                        <span class="symbol">＊</span>
                        <span class="person">收货人</span>
                    </div> 
                    <div class="iphones2">
                        <p>收货人</p>
                        <p> <input id="number1" type="text" name="consignee"  ></p>
                    </div>
                </div>
            </div>
            <div class="take">
                <div class="takes">
                    <div class="head">
                        <span class="symbol">＊</span>
                        <span class="person">手机号码</span>
                    </div>
                    <div class="iphones2">
                        <p>手机号码</p>
                        <p> <input id="number1" type="text" name="mobile" maxlength="11"  ></p>
                    </div>
                </div>
            </div>
            <div class="take">
                <div class="takes">
                    <div class="head">
                        <span class="symbol">＊</span>
                        <span class="person"> 省市区</span> 
                        <p class="tou">
                            <img src="/public/mobile/img/hot/cashcard/banner/mine_xiayiye@2x.png">
                        </p>
                    </div>
                    <!-- <div class="head3">
                    <input type="text" name="">
                        <p class="tou"><img src="/public/img/setting/mine_xiayiye@2x.png"></p>
                    </div> -->
                    <div class="iphones2">
                        <p>省市区</p>
                        <p> <input id="demo1" type="text" name="regionno" readonly="" placeholder="点击选择省市区"></p>
                        <!-- <div class="tou"><img src="/public/img/setting/mine_xiayiye@2x.png"></div> -->
                    </div>
                </div>
            </div>
            <div class="take">
                <div class="takes">
                    <div class="head">
                        <span class="symbol">＊</span>
                        <span class="person">详细地址</span>
                    </div>
                    <div class="iphones2">
                        <p>详细地址</p>
                        <p> <input id="number1" type="text" name="address"   ></p>
                    </div>
                </div>
            </div> 
        </div>
        <div id="mark">
        <div id="main" class="bg-white">
            <div id="title">请选所在地区
                <img src="/public/mobile/img/hot/cashcard/banner/delete@2x.png" alt="">
            </div>
            <div id="site_text">
                <div id="text_box">
                    <p id="province">省</p>
                    <p id="city">市辖区</p>
                    <p id="county">县</p>
                </div>
                <div id="site_box">
                    <ul id="province_box"></ul>
                    <ul id="city_box" style="display:none;"></ul>
                    <ul id="county_box" style="display:none;"></ul>
                </div>
            </div>
        </div>
    </div>
    <div id="alert_mark"></div> 



            <img src="/public/mobile/img/hot/cashcard/banner/c.jpg" align="top">
            <img src="/public/mobile/img/hot/cashcard/banner/d.jpg" align="top">
            <!-- 注册地址 -->
            <input type="hidden" id="url_m" value="<?= $url_m ?>">
            <input type="hidden" id="url_order" value="<?= $url_order ?>">
            <input type="hidden" id="unique" value="<?PHP echo isset($_GET['unique']) ? $_GET['unique'] : 0 ?>">
            <!-- 省市区代码 -->
            <input type="hidden" id="region">

            
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
                <div class="lj_wen">姓 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;名:</div>
                <div class="lj_names">
                    <input class="lj_name" type="text" name="name" value="">
                </div>
            </div>
            <div style="margin-top: 0.2rem;">
                <div class="lj_wen">联系电话:</div>
                <div class="lj_tells">
                    <input class="lj_tell" type="text" name="mobile" value="" maxlength="11">
                </div>
            </div>
            <div class="lj_add">
                <div class="lj_wens">地&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;址:</div>
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
            <!-- open-pay-center -->
            <div class="lj_submit ">
                提交
            </div>
        </div>
    </div>
    <div id="alert_mark"></div>
</body>
    <script type="text/javascript" src="/public/mobile/js/investment/rem.js"></script>
    <script type="text/javascript" src="/public/mobile/js/investment/jquery.-1.8.3.min.js"></script>
    <script type="text/javascript" src="/public/mobile/js/hot/jquery.base64.js"></script>
    <script type="text/javascript" src="/public/mobile/js/sdk.2.2.js"></script>
    <script type="text/javascript" src="/public/mobile/js/weixin/jssdk.js"></script>
    <script type="text/javascript" src="/public/mobile/js/hot/cashcard/cashcard.js"></script>
    <script type="text/javascript" src="/public/mobile/js/hot/cashcard/wxshare.js"></script>
</html>