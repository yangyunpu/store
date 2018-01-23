<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>如此生活|个人信息</title>
	<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<link rel="stylesheet" type="text/css" href="/public/css/setting/message.css"/>
	<link rel="stylesheet" type="text/css" href="/public/css/setting/LCalendar.css"/>
	<!-- <link rel="stylesheet" type="text/css" href="/public/css/setting/LArea.css"/> -->
</head>
<body>
	<div class="wrap">
		<div class="header" id="header">
			<span onclick="window.history.go(-1)">
				<img src="/public/img/brandhui/xingxingsha_back@2x.png " class="lefter">
			</span>
			<span class="lj_srt">个人信息</span>
			<span class="share">保存</span>
		</div>
		<div class="void"></div>
		<div class="content">
			<ul>
				<li>
					<span>性别</span>
					<div class="birsty" id="birsty_sex">
						<span class="enter2" id="sex">
							<img src="/public/img/setting/mine_xiayiye@2x.png">
						</span>
						<span class="person" ><input id="gend" type="text" name="sex" readonly="" placeholder="选择性别" value="<?php if($result['sex'] == 0){ echo '女'; }else{ echo '男'; } ?>">
						<input class="sexed" type="hidden" name="sexde" value="<?php echo $result['sex']; ?>"></span>
					</div>
				</li>
				<li>
					<span>生日</span>
					<div class="birsty">
						<span class="enter2" >
							<img src="/public/img/setting/mine_xiayiye@2x.png">
						</span>
						<span class="person" >
						<!-- <input id="demo1"  type="text" name="input_date" readonly="" placeholder=" 选择生日" value=" <?= $result['birthday'] ?>" > -->
						<input id="demo1" type="text" readonly="" placeholder="选择生日" data-lcalendar="2016-05-11,2016-05-11"  value="<?= $result['birthday'] ?>" />
						</span>
					</div>

				</li>
				<li>
					<span>所在地区</span>
					<div class="birsty3">
						<span class="enter2">
							<img src="/public/img/setting/mine_xiayiye@2x.png">
						</span>
						<span class="person3">
							<input id="demos" type="text" name="region" readonly="" placeholder="选择城市" value="<?= $result['reginText'] ?>">
							<input id="value2" type="hidden" name="" value="<?= $result['region'] ?>" >
						</span>
					</div>

				</li>
			</ul>
		</div>
	</div>
	<!-- 弹出框性别 -->
	<div class="lj_mark2">
		<ul>
			<li class="boy" data-id="1">男</li>
			<li class="girl" data-id="0">女</li>
		</ul>
	</div>
	<!-- 弹出框地区 -->
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
<script type="text/javascript" src="/public/js/setting/LCalendar.js"></script>
<!-- <script type="text/javascript" src="/public/js/setting/LArea.js"></script>
<script type="text/javascript" src="/public/js/setting/LAreaData1.js"></script>   -->
<script type="text/javascript" src="/public/js/setting/message.js"></script>
</html>
