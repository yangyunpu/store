<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>如此生活|分类</title>
	<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<link rel="stylesheet" type="text/css" href="/public/css/mui.min.css"/>
	<link rel="stylesheet" type="text/css" href="/public/css/category.css"/>
</head>

	<body class="lcy_category header_top" url_search=<?= $url_search ?>>
		<header class="head_bar">
			<input type="text" placeholder="搜索..." class="search_box" id="text">
		</header>
		<div class="mui-content mui-row mui-fullscreen">
			<div class="mui-col-xs-3">
				<div id="segmentedControls" class="mui-segmented-control mui-segmented-control-inverted mui-segmented-control-vertical">
				<?php if(!empty($data)) { ?>
				<?php foreach ($data as $i => $v) { ?>
					<a class="mui-control-item" href="#item<?= $i ?>"><?= $v['name'] ?></a>
				<?php } ?>
				</div>
			</div>
			<div id="segmentedControlContents" class="mui-col-xs-9">
                 <?php foreach ($data as $i => $v) { ?>
                 <?php if ($this->length($v['children']) > 0) { ?>
				<div id="item<?= $i ?>" class="<?= ($i == 0 ? 'mui-control-content mui-active' : 'mui-control-content') ?>">
					<p><?= $v['name'] ?></p>
					<!-- 商品 -->
					<div class="mui-content">
					    <ul class="mui-table-view mui-grid-view">
					        <?php foreach ($v['children'] as $k => $v1) { ?>
					        <li class="aa mui-table-view-cell mui-media mui-col-xs-4" code=<?= $v1['code'] ?>>
					            <a href="#">
					                <img class="mui-media-object" src="<?= $v1['icon'] ?>">
					                <div class="mui-media-body"><?= $v1['name'] ?></div>
					                </a>
					        </li>
							<?php } ?>
					    </ul>    
					</div>
				</div>
				<?php } ?>
				<?php } ?>
				<?php  } ?>
		</div>
      
	
		<!-- 底部导航 -->
<footer class="navigation">
	<ul> 
		<li>
			<a href="<?= $url_m ?>/mindex/index.html">
				<img src="../public/img/mindex/Tab_Home@2x.png">
				<p >首页</p>
			</a>
		</li>
		<li>
			<a href="<?= $url_m ?>/newcategory.html">
				<img src="../public/img/mindex/Tab_Menu_pre@2x.png">
				<p class="footer_bottom_color">分类</p>
			</a>
		</li>
		<li>
			<a href="<?= $url_m ?>/huilife/index.html">
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
			<a href="<?= $url_member ?>/index.html">
				<img src="../public/img/mindex/Tab_Me@2x.png">
				<p>我的</p> 
			</a>
		</li>
	</ul>
</footer>
</body>
</html>
<script src="/public/ext/js/jquery-1.8.3.min.js"></script>
<script src="/public/js/jquery.base64.js"></script>
<script src="/public/js/mui.min.js"></script>
<!-- <script src="/public/js/index/soolife.index.js"></script> -->
<script src="/public/js/category/soolife.category.js"></script>
<script src="/public/js/m_analytics.js"></script>
