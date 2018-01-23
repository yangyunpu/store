<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>领星币|如此生活</title>
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">   
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <link rel="stylesheet" href="/public/ext/css/soo.m.ui.css">
    <link rel="stylesheet" href="/public/ext/css/download.css">
    <link rel="stylesheet" href="/public/css/huilife/common.css">
    <link rel="stylesheet" href="/public/css/huilife/index.css">
</head>
<body>


<!-- 头部 -->
<div id="soo-header">
	<div id="header-left"><a onclick="window.history.go(-1)"> <img src="../public/img/common/shop_back_black@2x.png" alt=""></a></div>
	<div id="header-center">领星币</div>
	<div id="header-right"></div>
</div>
<!-- 下载框 -->
<div class="download_box" id="download-nav">
	<div class="remove" id="download-nav-hide"><img src="../public/img/common/icon_close@3x.png" alt=""></div>
	<div class="logo"><img src="../public/img/common/logo@3x.png" alt=""></div>
	<div class="word">下载如此生活客户端</div>
	<div class="sure" id="download-nav-sure"><div>下载</div></div>
</div>
<div class="lcy_getcoin lcy_hui" data-url-m = <?= $url_m ?>>
<!--头像... -->
<?php if(!empty($coinExplain)) { ?>
		<div class="message">
			<div class="title">
				<a href="/huilife/coinrule.html"><span>星币说明</span></a>				 
				<!--<span class="tag float-r">修改提示</span>-->
			</div>
	<?php if($coinExplain['is_login'] == true) { ?>
			<div class="main clear-f" >
				<div class="float-l">
					<img src="<?php echo $coinExplain['avatar']; ?>" alt=""></div>
				<div class="float-l words">
					<p><span><?php echo $coinExplain['coin']; ?></span>星币</p>
					<p>星币可抵<?php echo $coinExplain['rmb']; ?>元</p>
					<p>连续签到可获取更多</p>
				</div>
				<div class="float-r sign bg-white">
			      	<?php if ($coinExplain['is_get'] == true) { ?>
			      	<p class = "geted_coin">已签到</p> 
			        <?php } else { ?>
			      	<p class="go_get_coin">签到</p>
			      	<?php } ?>
				</div>		
			</div>
	<?php  }else{ ?>
			<div class="main clear-f">
				<div class="float-l">
					<img src="/public/img/huilife/headimg.png">
				</div>
				<div class="float-l no_login">
					<p>登录签到获取更多</p>
				</div>
				<div class="float-r sign bg-white">
					<p class= "login" data-url-m = <?= $url_m ?>>未登录</p>
				</div>		
			</div>
	<?php  } ?>
		</div>
		<div class="buttom clear-f">
		<?php foreach ($coinExplain['data'] as $i => $d) { ?>
			<div class="<?php if ($i == 0 && $coinExplain['is_get'] == true) { ?>float-l geted<?php } else { ?>float-l <?php } ?>"><p>+<?= $d['coin'] ?></p><div><?php if ($i == 0) { ?>今天<?php } else { ?> <?= $d['date'] ?> <?php } ?></div></div>
		<?php } ?>
		</div>
<?php }  ?><!-- emptyend -->

<div class="task">
    <?php if ($coinTask) { ?>
    <?php foreach ($coinTask['data'] as $i => $d) { ?>
	<div class="item clear-f go_complete<?= $i ?>" data-iscomplete="<?= $d['status'] ?>" data-is-login = "<?= (empty($coinExplain['is_login']) ? (0) : ($coinExplain['is_login'])) ?>">
		<div class="img_box float-l"><img src="<?= $d['image'] ?>" alt=""></div>
		<div class="float-l word">
			<p class="title"><?= $d['title'] ?></p>
			<p class="mess"><?= $d['content'] ?></p>
			<p class="coin"><?= $d['reward'] ?></p>
		</div>
		<div class="float-r signbtn" >
		    <?php if ($d['status'] == true) { ?>
			<p class="bg-white">已完成</p>
			<?php } else { ?>
			<p class="bg-white bg_retived">去完成</p>
			<?php } ?>
		</div>
	</div>
	<?php if($i == 2) break; ?>
	<?php } ?>
	<?php } ?>	
</div>

<div class="more">
	<a href="/huilife/getmore.html?login=<?= (empty($coinExplain['is_login']) ? (0) : ($coinExplain['is_login'])) ?>">
		<span>领取更多</span>
		<img src="../public/img/huilife/goods_next@2x.png" alt="">
	</a>
</div>
<!-- <div class="route">
	<img src="../public/img/huilife/getstar_dazhuanpan@2x.png" class="img-w">
</div> -->

<?php  if(!empty($adscoin)) { ?>
<!-- 星兑换 -->
<div class="route">
	<?php  if(!empty($app_coin_exchange['app.coin.exchange.banner']['items'][0]['picture'])) { ?>
		<a href="/huilife/starchange.html">
			<img src="<?php echo $app_coin_exchange['app.coin.exchange.banner']['items'][0]['picture']; ?>" class="img-w">	
		</a>
	<?php } ?>
</div>
<div class="goods">
	<div class="bg-white soo-row">
	<!-- 上边 -->
		<?php  if(!empty($app_coin_exchange['app.coin.exchange.top']['items'])) { ?>
		<div class="soo-col-12 bg-white good1 hei1">		
			<div class="timer">
			    <input data-index="0" class="time_count_down" type="hidden" value="<?php echo $app_coin_exchange['app.coin.exchange.top']['items'][0]['start_date']; ?>" name=""/>
				<div class="timestamp0"><span>00</span>：<span>00</span>：<span>00</span></div>
			</div>
			<a href="<?php echo $app_coin_exchange['app.coin.exchange.top']['items'][0]['mobile_link']; ?>">				
				<img src="<?php echo $app_coin_exchange['app.coin.exchange.top']['items'][0]['picture']; ?>" alt="">	
			</a>
		</div>
		<?php } ?>
<!-- 左侧 -->
		<?php  if(!empty($app_coin_exchange['app.coin.exchange.left']['items'])) { ?>
		<div class="soo-col-6 bg-white hei2">				
			<div class="timer">
			    <input data-index="1" class="time_count_down" type="hidden" value="<?php echo $app_coin_exchange['app.coin.exchange.left']['items'][0]['start_date']; ?>" name=""/>
				<div class="timestamp1"><span>00</span>：<span>00</span>：<span>00</span></div>
			</div>
			<a href="<?php echo $app_coin_exchange['app.coin.exchange.left']['items'][0]['mobile_link']; ?>">
				<img src="<?php echo $app_coin_exchange['app.coin.exchange.left']['items'][0]['picture']; ?>" alt="">					
			</a>
		</div>
		<?php } ?>
<!-- 右上 -->
		<?php  if(!empty($app_coin_exchange['app.coin.exchange.right001']['items'])) { ?>
		<div class="soo-col-6 good1 good3 bg-white hei3">				
			<div class="timer">
			    <input data-index="2" class="time_count_down" type="hidden" value="<?php echo $app_coin_exchange['app.coin.exchange.right001']['items'][0]['start_date']; ?>" name=""/>
				<div class="timestamp2"><span>00</span>：<span>00</span>：<span>00</span></div>
			</div> 
			<a href="<?php echo $app_coin_exchange['app.coin.exchange.right001']['items'][0]['mobile_link']; ?>">
				<img src="<?php echo $app_coin_exchange['app.coin.exchange.right001']['items'][0]['picture']; ?>" alt="">
			</a>	
		</div>
		<?php } ?>
<!-- 右下 -->
		<?php  if(!empty($app_coin_exchange['app.coin.exchange.right002']['items'])) { ?>
		<div class="soo-col-6 good3 bg-white hei3">				
		 	<div class="timer">
		 	    <input data-index="3" class="time_count_down" type="hidden" value="<?php echo $app_coin_exchange['app.coin.exchange.right002']['items'][0]['start_date']; ?>" name=""/>
				<div class="timestamp3"><span>00</span>：<span>00</span>：<span>00</span></div>
			</div>
			<a href="<?php echo $app_coin_exchange['app.coin.exchange.right002']['items'][0]['mobile_link']; ?>">
				<img src="<?php echo $app_coin_exchange['app.coin.exchange.right002']['items'][0]['picture']; ?>" alt="">				
			</a>
		</div>
		<?php } ?>
	</div>
</div>
<!-- 星换购 -->
<div class="route">
	<?php  if(!empty($app_coin_ex_buy['app.coin.ex_buy.banner']['items'][0]['picture'])) { ?>
		<a href="/huilife/starpurchase.html">
			<img src="<?php echo $app_coin_ex_buy['app.coin.ex_buy.banner']['items'][0]['picture']; ?>" class="img-w">
		</a>
	<?php } ?>
	<!-- <div class="content">
		<p class="title title_color">星换购</p>
		<p class="word word_color">星币换购享半价</p>
		<a href="/huilife/starpurchase.html"><button class="btn_color">查看更多</button></a>
	</div> -->
</div>
<div class="goods">
	<div class="bg-white soo-row">
	    <?php  if(!empty($app_coin_ex_buy['app.coin.ex_buy.top']['items'][0]['picture'])) { ?>
		<div class="soo-col-12 bg-white good1 hei1">	
			<a href="<?php echo $app_coin_ex_buy['app.coin.ex_buy.top']['items'][0]['mobile_link']; ?>">	
				<img src="<?php echo $app_coin_ex_buy['app.coin.ex_buy.top']['items'][0]['picture']; ?>" alt="">
			</a>	
		</div>
		<?php } ?>

		<?php  if(!empty($app_coin_ex_buy['app.coin.ex_buy.left']['items'][0]['picture'])) { ?>
		<div class="soo-col-6 bg-white hei2">	
			<a href="<?php echo $app_coin_ex_buy['app.coin.ex_buy.left']['items'][0]['mobile_link']; ?>">			
				<img src="<?php echo $app_coin_ex_buy['app.coin.ex_buy.left']['items'][0]['picture']; ?>" alt="">
			</a>	
		</div>
		<?php } ?>

		<?php  if(!empty($app_coin_ex_buy['app.coin.ex_buy.right001']['items'][0]['picture'])) { ?>
		<div class="soo-col-6 good1 good3 bg-white hei3">	
			<a href="<?php echo $app_coin_ex_buy['app.coin.ex_buy.right001']['items'][0]['mobile_link']; ?>">			
				<img src="<?php echo $app_coin_ex_buy['app.coin.ex_buy.right001']['items'][0]['picture']; ?>" alt="">
			</a>	
		</div>
		<?php } ?>

		<?php  if(!empty($app_coin_ex_buy['app.coin.ex_buy.right002']['items'][0]['picture'])) { ?>
		<div class="soo-col-6 good3 bg-white hei3">		
			<a href="<?php echo $app_coin_ex_buy['app.coin.ex_buy.right002']['items'][0]['mobile_link']; ?>">		
				<img src="<?php echo $app_coin_ex_buy['app.coin.ex_buy.right002']['items'][0]['picture']; ?>" alt="">
			</a>
		</div>
		<?php } ?>
	</div>
</div>
<?php } ?>
<!-- 领星币的遮罩层 -->
<div class="mark">
	<img src="../public/img/huilife/delete_white@3x.png" alt="" id="delete_getcoin">
	<img src="../public/img/huilife/mylife.gif" alt="">
	<?php if ($coinExplain['data']) { ?>
		<p>今天领取<?= $coinExplain['data'][0]['coin'] ?>个星币，明天可领取<?= $coinExplain['data'][1]['coin'] ?>个星币</p>
	<?php } ?>
</div>
</div><!--main-end -->

<script>
	var _hmt = _hmt || [];
	(function() {
	  var hm = document.createElement("script");
	  hm.src = "https://hm.baidu.com/hm.js?826cba0598fb59fb393282dd20e7d118";
	  var s = document.getElementsByTagName("script")[0]; 
	  s.parentNode.insertBefore(hm, s);
	})();
</script>
<script src="/public/ext/js/rem.js"></script>
<script src="/public/ext/js/jquery-1.8.3.min.js"></script>
<script src="/public/ext/js/download.js"></script>
<script src="/public/ext/js/soo.m.ui.js"></script>
<script src="/public/ext/js/jquery.base64.js"></script>
<script src="/public/js/huilife/life.index.js"></script>
</body>
</html>