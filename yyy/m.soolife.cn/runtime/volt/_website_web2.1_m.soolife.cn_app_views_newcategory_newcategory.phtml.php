<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>如此生活|分类</title>
	<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=0">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<link rel="stylesheet" type="text/css" href="/public/ext/css/soo.m.ui.css"/>
	<link rel="stylesheet" type="text/css" href="/public/css/newcategory/newcategory.css"/>
	<script src="/public/js/rem2.js"></script>
</head>
<body>
<!-- 搜索框页面 -->
<!-- <div id="search_box" style="display:none;">
	<div id="head">
		<div id="head-left"><img src="/public/img/newcategory/Group22Copy2.png" alt=""></div>
		<div id="head-right" >搜索</div>
		<div id="head-center"><input type="text" placeholder="搜索商品" id="inputbox" /><img src="/public/img/newcategory/ser.png"></div>
	</div>
	<div id="top_place"></div>
	<div class="search_display">
		<p id="new">最近搜索</p>
		<div id="newbox">
			<div id="box"></div>
			<div id="remove">清除</div>
		</div>
		<p id="new">热门搜索</p>
		<div id="newbox">
		<?php if ($hot) { ?>
		<?php foreach ($hot as $d) { ?>
			<a href="/newcategory/threecate.html?firstcode=&keyword=<?= $d['name'] ?>&csstag=9"><span><?= $d['name'] ?></span></a>
		<?php } ?>
		<?php } ?>
		</div>
	</div>
	<ul class="search_display_list">
		
	</ul>
</div> -->
<div id="newcategory" >
	 <!-- 头部	 -->
	<div id="head">
		<!-- <div id="head-left" onclick="window.history.go(-1)"><img src="/public/img/newcategory/Group22Copy2.png" alt=""></div> -->
		<div id="head-right"><a href="/search.html"><img src="/public/img/newcategory/Group3Copy.png" alt=""></a></div>
		<div id="head-center" class="between maintitle">分类</div>
	</div>
	<div id="top_place"></div>
	<!-- nav -->
	<div id="nav" class="soo-row">
		<?php if ($categoryresult) { ?>
		<?php foreach ($categoryresult as $i => $item) { ?>
		 <div class="soo-slice-5 <?php if ($i == 'cloth') { ?>active<?php } ?>" data-btncode="<?= $item['id'] ?>"><?= $item['name'] ?></div>
		<?php } ?>
		<?php } ?>
	</div>
	<div id="mian">
		<!-- 主要部分 衣-->
		<?php if(array_key_exists('cloth', $categoryresult)):?>
		<div class="mianbody">
			<a href="/second/secondindex.html?firstcode=<?= $categoryresult['cloth']['id'] ?>"><div class="banner margin-b">
				<div class="box"><img src="<?= $categoryresult['cloth']['img'] ?>"></div>
				<img src="/public/img/newcategory/Home_Dress@2x.png" alt="" class="classify_btn">
			</div></a>
			<?php foreach ($categoryresult['cloth']['items'] as $item) { ?>
			<div class="mian soo-row">
				<a href="/newcategory/threecate.html?firstcode=<?= $categoryresult['cloth']['id'] ?>&twocode=<?= $item['id'] ?>"><div class="box2" data-twocode=""><img src="<?= $item['img'] ?>" ></div></a>
				<div class="goods_box clear-f margin-b">
					<?php foreach ($item['items'] as $it) { ?>
					<div class="soo-col-4 goods">
						<a href="/newcategory/threecate.html?firstcode=<?= $categoryresult['cloth']['id'] ?>&twocode=<?= $item['id'] ?>&threecode=<?= $it['id'] ?>"><div class="imgbox"><img src="<?= $it['img'] ?>" alt=""></div></a>
						<p><?= $it['name'] ?></p>
					</div>
					<?php } ?>
				</div>
			</div>
			<?php } ?>
		</div>
		<?php endif?>
		<!-- 主要部分 食-->
		<?php if(array_key_exists('cloth', $categoryresult)):?>
		<div class="mianbody" style="display:none">
			<a href="/second/secondindex.html?firstcode=<?= $categoryresult['foods']['id'] ?>"><div class="banner margin-b">
				<div class="box"><img src="<?= $categoryresult['foods']['img'] ?>"></div>
				<img src="/public/img/newcategory/shi.png" alt="" class="classify_btn">
			</div></a>
			<?php foreach ($categoryresult['foods']['items'] as $item) { ?>
			<div class="mian soo-row">
				<a href="/newcategory/threecate.html?firstcode=<?= $categoryresult['foods']['id'] ?>&twocode=<?= $item['id'] ?>"><div class="box2" data-twocode=""><img src="<?= $item['img'] ?>" ></div></a>
				<div class="goods_box clear-f margin-b">
					<?php foreach ($item['items'] as $it) { ?>
					<div class="soo-col-4 goods">
						<a href="/newcategory/threecate.html?firstcode=<?= $categoryresult['foods']['id'] ?>&twocode=<?= $item['id'] ?>&threecode=<?= $it['id'] ?>"><div class="imgbox"><img src="<?= $it['img'] ?>" alt=""></div></a>
						<p><?= $it['name'] ?></p>
					</div>
					<?php } ?>
				</div>
			</div>
			<?php } ?>
		</div>
		<?php endif?>
		<!-- 主要部分 住-->
		<?php if(array_key_exists('cloth', $categoryresult)):?>
		<div class="mianbody" style="display:none">
			<a href="/second/secondindex.html?firstcode=<?= $categoryresult['live']['id'] ?>"><div class="banner margin-b">
				<div class="box"><img src="<?= $categoryresult['live']['img'] ?>"></div>
				<img src="/public/img/newcategory/zhu.png" alt="" class="classify_btn">
			</div></a>
			<?php foreach ($categoryresult['live']['items'] as $item) { ?>
			<div class="mian soo-row">
				<a href="/newcategory/threecate.html?firstcode=<?= $categoryresult['live']['id'] ?>&twocode=<?= $item['id'] ?>"><div class="box2" data-twocode=""><img src="<?= $item['img'] ?>" ></div></a>
				<div class="goods_box clear-f margin-b">
					<?php foreach ($item['items'] as $it) { ?>
					<div class="soo-col-4 goods">
						<a href="/newcategory/threecate.html?firstcode=<?= $categoryresult['live']['id'] ?>&twocode=<?= $item['id'] ?>&threecode=<?= $it['id'] ?>"><div class="imgbox"><img src="<?= $it['img'] ?>" alt=""></div></a>
						<p><?= $it['name'] ?></p>
					</div>
					<?php } ?>
				</div>
			</div>
			<?php } ?>
		</div>
		<?php endif?>
		<!-- 主要部分 行-->
		<?php if(array_key_exists('cloth', $categoryresult)):?>
		<div class="mianbody" style="display:none">
			<a href="/second/secondindex.html?firstcode=<?= $categoryresult['walk']['id'] ?>"><div class="banner margin-b">
				<div class="box"><img src="<?= $categoryresult['walk']['img'] ?>"></div>
				<img src="/public/img/newcategory/xing.png" alt="" class="classify_btn">
			</div></a>
			<?php foreach ($categoryresult['walk']['items'] as $item) { ?>
			<div class="mian soo-row">
				<a href="/newcategory/threecate.html?firstcode=<?= $categoryresult['walk']['id'] ?>&twocode=<?= $item['id'] ?>"><div class="box2" data-twocode=""><img src="<?= $item['img'] ?>" ></div></a>
				<div class="goods_box clear-f margin-b">
					<?php foreach ($item['items'] as $it) { ?>
					<div class="soo-col-4 goods">
						<a href="/newcategory/threecate.html?firstcode=<?= $categoryresult['walk']['id'] ?>&twocode=<?= $item['id'] ?>&threecode=<?= $it['id'] ?>"><div class="imgbox"><img src="<?= $it['img'] ?>" alt=""></div></a>
						<p><?= $it['name'] ?></p>
					</div>
					<?php } ?>
				</div>
			</div>
			<?php } ?>
		</div>
		<?php endif?>
		<!-- 主要部分 娱-->
		<?php if(array_key_exists('cloth', $categoryresult)):?>
		<div class="mianbody" style="display:none">
			<a href="/second/secondindex.html?firstcode=<?= $categoryresult['amusement']['id'] ?>"><div class="banner margin-b">
				<div class="box"><img src="<?= $categoryresult['amusement']['img'] ?>"></div>
				<img src="/public/img/newcategory/yu.png" alt="" class="classify_btn">
			</div></a>
			<?php foreach ($categoryresult['amusement']['items'] as $item) { ?>
			<div class="mian soo-row">
				<a href="/newcategory/threecate.html?firstcode=<?= $categoryresult['amusement']['id'] ?>&twocode=<?= $item['id'] ?>"><div class="box2" data-twocode=""><img src="<?= $item['img'] ?>" ></div></a>
				<div class="goods_box clear-f margin-b">
					<?php foreach ($item['items'] as $it) { ?>
					<div class="soo-col-4 goods">
						<a href="/newcategory/threecate.html?firstcode=<?= $categoryresult['amusement']['id'] ?>&twocode=<?= $item['id'] ?>&threecode=<?= $it['id'] ?>"><div class="imgbox"><img src="<?= $it['img'] ?>" alt=""></div></a>
						<p><?= $it['name'] ?></p>
					</div>
					<?php } ?>
				</div>
			</div>
			<?php } ?>
		</div>
		<?php endif?>


	</div>
	<div style="height:2.133333rem;width:100%;"></div>
</div>
<footer class="navigation">
			<ul>
				<li>
					<a href="/mindex/index.html">
						<img src="../public/img/mindex/Tab_Home@2x.png">
						<p >首页</p>
					</a>
				</li>
				<li>
					<a href="/newcategory.html">
						<img src="../public/img/mindex/Tab_Menu_pre@2x.png">
						<p class="footer_bottom_color">分类</p>
					</a>
				</li>
				<li>
					<a href="/lifehui/index.html">
						<img src="../public/img/mindex/Tab_Life@2x.png">
						<p>惠生活</p>
					</a>
				</li>
				<li>
					<a href="<?= $url_order ?>/index.html">
						<img src="../public/img/mindex/Tab_Shop@2x.png">
						<p>购物车</p>
						<span class="shopping_car">1</span>
					</a>
				</li>
				<li>
					<a href="/i/index/index.html">
						<img src="../public/img/mindex/Tab_Me@2x.png">
						<p>我的</p>
					</a>
				</li>
			</ul>
		</footer>
<script type="text/javascript" >
	var categoryjson = <?= $categoryjson ?>;
</script>
</body>
</html>
<script  type="text/javascript" src="/public/ext/js/jquery-1.8.3.min.js"></script>
<script  type="text/javascript" src="/public/js/jquery.base64.js"></script>
<script  type="text/javascript" src="/public/js/newcategory/newcategory.js"></script>