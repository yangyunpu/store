<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>如此生活|惠生活</title>
	<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">	
    <link rel="stylesheet" href="/public/ext/css/soo.m.ui.css">
    <link rel="stylesheet" href="/public/ext/css/download.css">
    <link rel="stylesheet" href="/public/ext/css/swiper.css">
	<link rel="stylesheet" type="text/css" href="/public/css/lifehui/common.css"/>
	<link rel="stylesheet" type="text/css" href="/public/css/lifehui/index.css"/>
    <link rel="stylesheet" type="text/css" href="/public/css/lifehui/foot.css"/>
</head>
<body>
<div class="index_wrap">
	<div class="header">
	    <!-- <a href=""><img class="arrow"  src="/public/img/common/shop_back_black@1x.png " ></a> -->
		<span class="head_title">惠生活</span> 
		<a href="/lifehui/download.html?msg_txt=2">
            <img class="coupon"  src="/public/img/lifehui/order.png" >
        </a>
	</div>
	<!-- 下载框 -->
<!-- 	<div class="download_box" id="download-nav">
		<div class="remove" id="download-nav-hide"><img src="../public/img/common/icon_close@3x.png" alt=""></div>
		<div class="logo"><img src="../public/img/common/logo@3x.png" alt=""></div>
		<div class="word">下载如此生活客户端</div>
		<div class="sure" id="download-nav-sure"><div>下载</div></div>
	</div> -->
	<div id="wrap">
		<!-- 轮播 -->
        <?php if ($link) { ?>
		<div class="swiper-container">
			<div class="swiper-wrapper">
            <?php if ($link['app.chlife.banner']['children']['app.chlife.banner.001']['items']) { ?>
                <?php foreach ($link['app.chlife.banner']['children']['app.chlife.banner.001']['items'] as $d) { ?>
				<div class="swiper-slide"> 
					<a href="<?= $d['mobile_link'] ?>">
						<img src="<?= $d['picture'] ?>">
					</a> 
				</div>
                <?php } ?>
            <?php } ?>
			</div>
			<!-- 分页效果 -->
			<div class="pagination"></div>
		</div>
        <?php } ?>
        <div id="news">
            <div class="head">SOO快报</div>
        	<div class="item">
            <?php if ($soo) { ?>
           <?php  if(!empty($soo['data'])) { ?>
                <ul class="item_list">
                <?php foreach ($soo['data'] as $i => $res) { ?>
            		<li><?= $res['str'] ?></li>
            		<li><?= $res['str1'] ?></li>
                <?php if($num >= 3 && $i == 2) break; ?> 
                <?php } ?>
                </ul>
            <?php  } ?>
            <?php } ?>
        	</div>
        </div>

        <?php if ($shop) { ?>
        <?php if ($shop['service']) { ?>
        <ul id="exlist"> 
        <?php foreach ($shop['service'] as $i => $key) { ?>
        	<li>
        		<a href="/lifehui/download.html?msg_txt=1">
                    <img src="<?= $key['logo'] ?>">
            		<p><?= $key['name'] ?></p>
            		<a class="buy" href="/lifehui/download.html?msg_txt=1" class="down">免费兑换</a>
                </a>
        	</li>
        <?php if($count < 2) break; ?>
        <?php if($count >= 2 && $count < 4 && $i == 1) break; ?>
        <?php if($count >= 4  && $i == 3) break;   ?>
        <?php } ?> 
        </ul>
        <?php } ?>
        <?php } ?>
        <?php if ($store) { ?>
        <div id="store">
            <?php if ($store) { ?>
            <a href="/lifehui/storedetail.html?store_id=<?= $store['list']['0']['store_id'] ?>">
        	    <img class="logo" src="<?= $store['list']['0']['logo'] ?>">
                <div id="mask_name"><span class="mask_line"></span><span class="mask_title"><?= $store['list']['0']['store_name'] ?></span><span class="mask_line"></span></div>
            </a>
            <?php } ?>
            <div id="triangle-up"></div>
            <?php if ($shop) { ?>
            <?php if ($shop['service']) { ?>
            <ul id="classify">
            <a href="/lifehui/storedetail.html?store_id=<?= $shop['store_id'] ?>">
                <?php foreach ($shop['service'] as $d) { ?>
	        	<li>
	        		<img src="<?= $d['logo'] ?>">
	        		<p><?= $d['coin'] ?>星币／份</p>
	        	</li>

                <?php } ?>
            </a>
            </ul>
            <?php } ?>
            <?php } ?>
        </div> 
        <?php } ?>
        <a href="/lifehui/store.html">
        	<div id="search">
                <img class="left" src="/public/img/lifehui/life_Location.png">
                <p>查找体验店</p>
    		    <img class="right"  src="/public/img/lifehui/life_more.png">
        	</div>
        </a>
    	<div id="show"><span>星粉秀</span></div>
    	<div id="pic">
    		<div class="piclist">
            <?php if ($fan) { ?>
                <a href="/lifehui/showdetail.html?fanshow_id=<?= $fan['data']['0']['fanshow_id'] ?>">
        			<div class="left">
        				<img src="<?= $fan['data']['0']['photo'] ?>">
        				<p class="txt"><?= $fan['data']['0']['memo'] ?>！</p>
        			</div>
                </a>
    			<ul class="right">
                <?php foreach ($fan['data'] as $i => $d) { ?>
                <?php  if($i == 0) continue; ?>
    				<li>
                        <a href="/lifehui/showdetail.html?fanshow_id=<?= $d['fanshow_id'] ?>">
        					<img src="<?= $d['photo'] ?>">
                        </a>
    				</li>
                <?php } ?>
    			</ul>
            <?php } ?>
    		</div>
    		<div class="more">
    			<a href="/lifehui/show.html">
                    <span>查看更多</span>
    			    <img src="/public/img/lifehui/life_more.png">
                </a>
    		</div>
    	</div>
	</div>
    <!-- 底部导航 -->
        <footer class="navigation">
            <ul> 
                <li>
                    <a href="/mindex/index.html">
                        <img src="/public/img/mindex/Tab_Home@2x.png">
                        <p>首页</p>
                    </a>
                </li>
                <li>
                    <a href="/newcategory.html">
                        <img src="/public/img/mindex/Tab_Menu@2x.png">
                        <p >分类</p>
                    </a>
                </li>
                <li>
                    <a href="/lifehui/index.html">
                        <img src="/public/img/mindex/Tab_Life_pre@2x.png">
                        <p class="footer_bottom_color">惠生活</p>
                    </a>
                </li>
                <li>
                    <a href="<?= $url_order ?>/index.html">
                        <img src="/public/img/mindex/Tab_Shop@2x.png">
                        <p>购物车</p>
                        <span class="shopping_car">1</span>
                    </a>
                </li>
                <li>
                    <a href="/i/index/index.html">
                        <img src="/public/img/mindex/Tab_Me@2x.png">
                        <p>我的</p>
                    </a>
                </li>
            </ul>
        </footer>
</div>
</body>
</html>
<script src="/public/js/rem.js"></script> 
<script src="/public/ext/js/jquery-1.8.3.min.js"></script>
<script src="/public/js/jquery.base64.js"></script>
<script src="/public/ext/js/soo.m.ui.js"></script>
<script src="/public/ext/js/download.js"></script>
<script type="text/javascript" src="/public/ext/js/swiper.min.js"></script>
<script src="/public/js/lifehui/index.js"></script>