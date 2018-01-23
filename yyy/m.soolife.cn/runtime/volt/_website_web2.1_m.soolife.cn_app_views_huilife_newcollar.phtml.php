<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>领星币|如此生活</title>
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">   
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <link rel="stylesheet" href="/public/ext/css/soo.m.ui.css">
    <!-- <link rel="stylesheet" href="/public/css/huilife/common.css"> -->
    <!-- <link rel="stylesheet" href="/public/css/huilife/index.css"> -->
	<link rel="stylesheet" href="/public/css/huilife/newcollar.css">
</head>
<body id="new-collar">


<!-- 头部 -->
<div id="soo-new-header">
	<div id="header-left">
		<a href="/index.html"> <img src="../public/img/common/shop_back_black@2x.png" alt=""></a>
	</div>
	<!-- <div id="header-center">领星币</div> -->
	<div id="header-center"><img src="../public/img/newcoller/lingxingbi.png" name="<?= $coinExplain['is_login'] ?>" url="<?= $url_m ?>" alt=""></div>
	<a href="/huilife/newcoinrule.html"><div id="header-right">星币说明</div></a>
</div>
<!-- 下载框 -->
<!-- <div class="download_box" id="download-nav">
	<div class="remove" id="download-nav-hide"><img src="../public/img/common/icon_close@3x.png" alt=""></div>
	<div class="logo"><img src="../public/img/common/logo@3x.png" alt=""></div>
	<div class="word">下载如此生活客户端</div>
	<div class="sure" id="download-nav-sure"><div>下载</div></div>
</div> -->
<div class="led">
<div  class="led-img">
	<img src="../public/img/newcoller/baoxiang@2x.png">
	<?php if ($coinExplain['is_login'] == 1){ ?>
		<div class="sign">签到</div>	
	<?php }else{ ?>
		<div class="sign">未登录</div>	
	<?php } ?>
	<input type="text" style="display: none;" name="<?= $coinExplain['is_get'] ?>">
</div>
<div class="collectibles-remark">
	<?php if ($coinExplain['is_login'] == 1){ ?>
		<p class="surplus"><?= $coinExplain['coin'] ?>星币</p>
		<p class="offset">可抵扣<?= $coinExplain['rmb'] ?>元</p>
	<?php }else{ ?>
		<p class="offset">登录签到获取更多</p>
	<?php } ?>
</div>
</div>
<div class="lcy_getcoin lcy_hui" data-url-m = <?= $url_m ?>>
<div class="flow">
	<ul>
	<?php foreach ($coinExplain['data'] as $i => $d) { ?>
		<li>
		<div>
		<p class="remark"><?= $d['coin'] ?>星币</p>
		<?php if ($i == 0) { ?>
			<p class="ring-b"></p>
		<?php } else { ?>
		 <p class="ring-bl"></p>
		 <?php } ?>
		<p class="remark-d"><?php if ($i == 0) { ?>今天<?php } else { ?> <?= $d['date'] ?> <?php } ?></p>
		</div></li>
	<?php } ?>
	</ul>
</div>
<div class="link">
<div class="to-complete">
    <?php if ($coinTask) { ?>
    <?php foreach ($coinTask['data'] as $i => $k) { ?>
    <?php if ($k['type'] == 'document' && $k['status'] == true) {
 			
    }else{ ?> 
		<div class="la go_complete_new<?= $i ?>"" data = "k['status']">
				<img src="<?= $k['image'] ?>">	
			<p class="remark"><?= $k['title'] ?></p>
			    <?php if ($k['status'] == true) { ?>
				<p class="complete-b huise">已完成</p>
				<?php } else { ?>
                                <?php if ($coinExplain['is_login']) { ?>
                                <?php switch ($k['type']) {
                                    case 'evaluate':
                                ?>        
                                        <p class="complete-b "><a href="<?= $url_login ?>/orders/index.html?status=4">去完成</a></p>
                                <?php        
                                         break;
                                    case 'document':
                                ?>          
                                        <p class="complete-b "><a href="<?= $url_login ?>/setting/message.html">去完成</a></p>
                                <?php             
                                         break;
                                    case 'code':
                                ?>         
                                        <p class="complete-b "><a href="<?= $url_login ?>/lifehui/download.html?msg_txt=1">去完成</a></p>
                                <?php        
                                         break;

                                 }  ?>                            
                                <?php } else { ?>
                                <p class="complete-b "><a href="<?= $url_login ?>/logins/login.html?return_url=<?= $rerurn_url ?>">去完成</a></p>
                                <?php } ?>
				<?php } ?>
		</div>
	<?php } ?>
	<?php if($i == 2) break; ?>
	<?php } ?>
	<?php } ?>	
</div>
	<div class="exchange">
		<div class="e-title">
			星兑换
		</div>
    <div class="e-link">
		<div class="exchange-a-1 position">
		<input type="text" style="display: none" value="<?= $adscoin['app.coin.collectibles.top']['use_time'] ?>" name="endtime" placeholder="结束时间">
		<a href="<?= $adscoin['app.coin.collectibles.top']['mobile_link'] ?>">
		<p class="time">期待下一期</p>

		<img class="" src="<?= $adscoin['app.coin.collectibles.top']['picture'] ?>">
		</a>
			<!-- <div class="e-details">
			
				<p class="iphone">iPhone 7 128G</p>
				<p class="price">6188星币</p>
			</div>
			<div class="pictures">
				
			</div> -->
		</div>
		<div class="exchange-a-2 position">
		<input type="text" style="display: none" value="<?= $adscoin['app.coin.collectibles.middleleft']['use_time'] ?>" name="endtime" placeholder="结束时间">
		<a href="<?= $adscoin['app.coin.collectibles.middleleft']['mobile_link'] ?>">
		<p class="time">期待下一期</p>
		<img src="<?= $adscoin['app.coin.collectibles.middleleft']['picture'] ?>">
		</a>
		<!-- 	<div class="e-details">
		
		 <p class="time">期待下一期</p>
			<p class="iphone">匡威高帮开口笑经典帆布鞋啦啦啦</p>
			<p class="price">6188星币</p>
		</div>
		<div class="pictures">
			
		</div> -->
		</div>
		<div class="right">
			<div class="exchange-a-3 position">
			<input style="display: none" type="text" value="<?= $adscoin['app.coin.collectibles.middlerighttop']['use_time'] ?>" name="endtime" placeholder="结束时间">
			<a href="<?= $adscoin['app.coin.collectibles.middlerighttop']['mobile_link'] ?>">
			<p class="time">期待下一期</p>
			<img src="<?= $adscoin['app.coin.collectibles.middlerighttop']['picture'] ?>">
			</a>
			<!-- <div class="e-details">
			 <p class="time">期待下一期</p>
				<p class="iphone">匡威</p>
				<p class="price">6188星币</p>
			</div>
			<div class="pictures">
				
			</div> -->
		</div>
			<div class="exchange-a-3 position">
			<input style="display: none" type="text" value="<?= $adscoin['app.coin.collectibles.middlerightbottom']['use_time'] ?>" name="endtime" placeholder="结束时间">
			<a href="<?= $adscoin['app.coin.collectibles.middlerightbottom']['mobile_link'] ?>">
			<p class="time">期待下一期</p>
			<img src="<?= $adscoin['app.coin.collectibles.middlerightbottom']['picture'] ?>">
			</a>
			<!-- <div class="e-details">
			 <p class="time">期待下一期</p>
				<p class="iphone">匡威</p>
				<p class="price">6188星币</p>
			</div>
			<div class="pictures">
				<img src="../public/img/newcoller/w.png">
			</div> -->
		</div>
		</div>

		<div class="exchange-a-4 position">
		<input type="text" style="display: none" value="<?= $adscoin['app.coin.collectibles.bottomleft']['use_time'] ?>" name="endtime" placeholder="结束时间">
		<a href="<?= $adscoin['app.coin.collectibles.bottomleft']['mobile_link'] ?>">
		<p class="time">期待下一期</p>
		<img src="<?= $adscoin['app.coin.collectibles.bottomleft']['picture'] ?>">
		</a>
			<!-- <div class="e-details">
			 <p class="time">期待下一期</p>
				<p class="iphone">匡威</p>
				<p class="price">6188星币</p>
			</div>
			<div class="pictures">
				<img src="../public/img/newcoller/Rectangle 8s.png">
			</div> -->
		</div>
			<div class="right">
		<div class="exchange-a-4 position">
		<input type="text" style="display: none" value="<?= $adscoin['app.coin.collectibles.bottomright']['use_time'] ?>" name="endtime" placeholder="结束时间">
		<a href="<?= $adscoin['app.coin.collectibles.bottomright']['mobile_link'] ?>">
		<p class="time">期待下一期</p>
		<img src="<?= $adscoin['app.coin.collectibles.bottomright']['picture'] ?>">
		</a>
			<!-- <div class="e-details">
			 <p class="time">期待下一期</p>
				<p class="iphone">匡威</p>
				<p class="price">6188星币</p>
			</div>
			<div class="pictures">
				<img src="../public/img/newcoller/Rectangle 8s.png">
			</div> -->
		</div>
		</div>
		
	 </div>
	</div>
   <div class="buy">
		<div class="e-title">
			星换购
		</div>
		<div class="content">
		<?php if (!empty($goods)){ ?>
			<?php foreach ($goods as $vo) { ?>
				<div class="merchandise open-goods-detail" data-goods-id="<?= $vo['id'] ?>">
					<img src="<?= $vo['img_url'] ?>">
					<div class="remark">
						<p class="name"><?= $vo['name'] ?></p>
						<p class="tiaojian">￥<?= $vo['price'] ?>+<?= $vo['coin'] ?>星币</p>
						<p class="price">￥<?= $vo['marketprice'] ?></p>
					</div>
				</div>
			<?php } ?>
		<?php } ?>

		</div>
   </div>
   <?php if (!empty($goods)){ ?>
   	<div class="no">没有更多了</div>
   <?php } ?>

</div>
  <!--领星币的遮罩层 -->
  
<div class="mask" style="display: none;">
	 <img src="../public/img/newindex/GIF-3.gif" alt="" id="delete_getcoin">
	<p>+<?= $coinExplain['data'][0]['coin'] ?></p>
</div> 
<script>

</script>
<script src="/public/ext/js/rem.js"></script>
<script src="/public/ext/js/jquery-1.8.3.min.js"></script>
<!-- <script src="/public/ext/js/download.js"></script> -->
<!-- <script src="/public/ext/js/soo.m.ui.js"></script> -->
<script src="/public/ext/js/jquery.base64.js"></script>
<!-- <script src="/public/js/huilife/life.index.js"></script> -->
<script src="/public/js/huilife/newcollar.js"></script>
<script type="text/javascript" src="/public/js/sdk.2.2.js"></script>
</body>
</html>