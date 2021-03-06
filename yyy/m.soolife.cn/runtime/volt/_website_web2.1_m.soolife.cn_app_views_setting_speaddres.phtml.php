<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>如此生活|新增收货地址</title>
	<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<link rel="stylesheet" type="text/css" href="/public/css/setting/speaddres.css"/>
	<!-- <link rel="stylesheet" type="text/css" href="/public/css/setting/LArea.css"/> -->
</head>
<body>

<!-- 当前用户设置的地址的条数 -->
<?php if ($dataCount) { ?>
<input type="hidden" class="dataCount" value="<?= $dataCount ?>" name="">
<?php } ?>

	<div class="wrap">
		<div class="header" id="header">
			<span onclick="window.history.go(-1)">
				<img   src="/public/img/brandhui/xingxingsha_back@2x.png " class="lefter">
			</span>
			<span class="lj_srt">新增收货地址</span>  
		</div>
		<div class="void"></div>
		<div class="contet">
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
							<img src="/public/img/setting/mine_xiayiye@2x.png">
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
		<div class="btn_sure">确认</div>
	</div>
	<div id="mark">
		<div id="main" class="bg-white">
			<div id="title">请选所在地区
				<img src="/public/img/common/delete@2x.png" alt="">
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
</body>
<script src="/public/js/rem.js"></script> 
<script src="/public/ext/js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="/public/js/setting/speaddres.js"></script>
<!-- <script type="text/javascript" src="/public/js/setting/LArea.js"></script>
<script type="text/javascript" src="/public/js/setting/LAreaData1.js"></script>   -->
</html>